<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Store Controller wrapper for the store subdirectory.
 * 
 * @category   Controller
 * @filesource classes/controller/catalog/list.php
 * @package    OneRaimol Store
 * @author     DCDGLP
 * @copyright  (c) 2012 DCDGLP
 */
    class Controller_Catalog_List extends Controller_Store {
        
        /**
         * The items in the catalog
         * @var ORM 
         */
        protected $items;
        
        /**
         * The category
         * @var ORM 
         */
        protected $category;
        
        /**
         * The purchase order to be created from the item list request.
         * @var ORM 
         */
        protected $purchaseorder;
        
        /**
         * The product from the catalog
         * @var ORM
         */
        protected $product;
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * @param string $record The record to be searched
         */
        public function action_index($record = '') {
            // Allow only arguments in URI
            if($record != '') {
                $this->items = ORM::factory('product')
                                      ->where('material_category_id', '=', Helper_Helper::decrypt($record))
                                      ->find_all();

                $this->category = ORM::factory('materialcategory')
                                        ->where('category_id', '=', Helper_Helper::decrypt($record))
                                        ->find();
                
                // Set page defaults if loaded
                if($this->category->loaded()) {
                    $this->template->bodyContents = View::factory('store/catalog/list')
                                                            ->set('items', $this->items)
                                                            ->set('category', $this->category);
                }
                // Page not found
                else {
                    throw new HTTP_Exception_404('Record not found');
                }
            }
            // Show expire page
            else {
                $this->_expire_page();
            }
        }
        
        /**
         * Displays the product page of the store
         * @param string $record The product to be displayed
         */
        public function action_view($record = '') {
            
            $this->items = ORM::factory('product')
                                 ->where('product_id', '=', Helper_Helper::decrypt($record))
                                 ->find();
            
            if($this->items->loaded()) {
                $this->template->bodyContents = View::factory('store/catalog/item')
                                                        ->set('item', $this->items);

                // Display login box if not logged in or
                // the add item box if user is logged in
                if($this->session->get('userid')) {
                    $this->template->bodyContents->cartbox = View::factory('store/cart/additem')
                                                                    ->set('item', $this->items);
                }
                else {
                    $this->template->bodyContents->cartbox = View::factory('store/cart/login');
                }                
            }
            // Page not found
            else {
                throw new HTTP_Exception_404('Record not found');
            }
        }
        
        /**
         * Processes the item record to be added in the cart.
         */
        public function action_process_form() {            
            // If purchase order is present in the session
            if($this->session->get('items')) {
   
                // Get the cart items from the session
                $haystack = $this->session->get('items');
                
                // Gets and sets the pointer of the cart item for delete or quantity update
                $cartseed = count(array_keys($haystack));
                
                // Point the pointer to the end of the array
                end($haystack);
                $cartseed = (int)(key($haystack) + 1);
                // Reset the array pointer
                reset($haystack);
                
                // Build the single item entry into an array
                $array = array(
                    'product_price_id' => $_POST['product'],
                    'product_id' => $_POST['product_id'],
                    'qty' => $_POST['qty'],
                    'seed' => $cartseed
                );
                
                // Add the array to array.
                array_push($haystack, $array);
                
                $this->session->set('items', $haystack);
            }
            // If no purchase order in the session
            else {
                // Build the single item entry into an array
                $array = array( 
                    '0' => array(
                        'product_price_id' => $_POST['product'],
                        'product_id' => $_POST['product_id'],
                        'qty' => $_POST['qty'],
                        'seed' => 0 
                    )
                );
                
                $this->session->set('items', $array);
            }
            
            // Redirect to cart
            Request::current()->redirect(
                URL::site( 'catalog/list/cart' , $this->_protocol )
            );
        }
        
        /**
         * Displays the cart page of the user.
         */
        public function action_cart() {
            
            $this->product = ORM::factory('productprice');
            
            
            if($this->session->get('items')) {
                $this->template->bodyContents = View::factory('store/cart')
                                                    ->set('items', $this->session->get('items'))
                                                    ->set('product', $this->product);
                
                // Sets appropriate page messages
                if($this->request->query('action')) {
                    $action = $this->request->query('action');
                    
                    if($action == Constants_Request::DELETE) {
                        $this->template->bodyContents->set('action', Constants_Request::DELETE);
                    }
                    else if($action == Constants_Request::QTY) {
                        $this->template->bodyContents->set('action', Constants_Request::QTY);
                    }
                    else if($action == Constants_Request::CARTQTY) {
                        $this->template->bodyContents->set('action', Constants_Request::CARTQTY);
                    }
                }
                
            }
            // Show empty cart if empty
            else {
                if($this->session->get('userid')) {
                    $this->template->bodyContents = View::factory('store/cartempty');
                }
                else {
                    $this->_expire_page();
                }
            }
            
        }
        
        /**
         * Deletes an item to the cart
         * @param string $record The cart item to be deleted
         */
        public function action_process_deleteitem($record = '') {
            
            // Check if item is existing in the cart
            if($this->session->get('items')) {
                $cartitem = $this->session->get('items');
                
                // Remove item from the cart
                unset($cartitem[Helper_Helper::decrypt($record)]);
  
                $this->session->set('items', $cartitem);
                
                // Show action message
                Request::current()->redirect(
                    URL::site( 'catalog/list/cart?action='.Constants_Request::DELETE, $this->_protocol )
                );
            }
            else {
                throw new HTTP_Exception_404('Unauthorized access');
            }
        }
        
        /**
         * Processes the item change quantity
         * @param string $record The item to be changed qty
         */
        public function action_process_edititemqty($record = '', $index = '') {
            
            if($record == '' && $this->request->query('all')) {
                
            }
            else {
                if($this->session->get('items')) {
                    $cartitems = $this->session->get('items');
                    
                    $cartitems[Helper_Helper::decrypt($record)]['qty'] = $index;
                    
                    $this->session->set('items', $cartitems);
                    
                    Request::current()->redirect(
                        URL::site( 'catalog/list/cart?action=' . Constants_Request::QTY, $this->_protocol )
                    );
                }
                else {
                    throw new HTTP_Exception_404('Unauthorized access');
                }
            }
        }
        
        /**
         * Deletes the cart from session
         */
        public function action_emptycart() {
            
            $this->session->delete('items');
            
            $this->template->bodyContents = View::factory('store/cartempty');
            
        }
        
        /**
         * Search the catalog
         */
        public function action_search() {
            
            if($this->request->query('query')) {
                $this->items = ORM::factory('product')
                                      ->where('name', 'LIKE', '%' . $this->request->query('query') . '%')
                                      ->or_where('description', 'LIKE', '%' . $this->request->query('query') . '%')
                                      ->find_all();
                
                
                if($this->items->count() > 0) {
                    
                    $count = $this->items->count();
                    
                    // Paginate database result
                    $this->pagination = Pagination::factory(array(
                                            'items_per_page' => 10,
                                            'view' => 'pagination/basic',
                                            'total_items' => $count
                                        ));
                    
                    $paginated = ORM::factory('product')
                                      ->where('name', 'LIKE', '%' . $this->request->query('query') . '%')
                                      ->or_where('description', 'LIKE', '%' . $this->request->query('query') . '%')
                                      ->limit( $this->pagination->items_per_page )
                                      ->offset( $this->pagination->offset )
                                      ->find_all();
                    
                    $this->template->bodyContents = View::factory('store/catalog/list')
                                                            ->set('items', $paginated)
                                                            ->set('search', TRUE)
                                                            ->set('pagination', $this->pagination->render());
                }
                else {
                    $this->template->bodyContents = View::factory('store/searchempty');
                }
            }
            else {
                $this->template->bodyContents = View::factory('store/searchempty');
            }
            
        }
       
    } // End Controller_Catalog_List