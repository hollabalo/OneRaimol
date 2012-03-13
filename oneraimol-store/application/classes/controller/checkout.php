<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Admin side authentication of OneRaimol.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Checkout extends Controller_Store {

        /**
         * Holds the purchase order data from the database
         * @var ORM
         */
        private $purchaseorder;
        
        /**
         * Holds the purchase order item data from the database
         * @var ORM 
         */
        private $poitems;
        
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
                    
            if(! $this->session->get('items')) {
                
                if($this->request->action() == 'generatepdf') {
                    if(! $this->session->get('po_id')) {
                        $this->_expire_page();
                    }
                }
                else {
                    Request::current()->redirect(
                        URL::site( 'catalog' , $this->_protocol )
                    );
                }

            }
            else {
                $this->template->title = 'Checkout | Raimol&trade; Energized Lubricants Purchase Order';
            }
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         */
        public function action_index() {
            $this->user = ORM::factory('customer')
                              ->where('customer_id', '=', Helper_Helper::decrypt($this->session->get('userid')))
                              ->find();
        
            // Prevents page access if session is active
            $this->template->bodyContents = View::factory('store/checkout/shippingoptions')
                                                   ->set('items', $this->session->get('items'))
                                                   ->set('product', ORM::factory('productprice'))
                                                   ->set('user', $this->user);
        }
        
        /**
         * Processes the order for confirmation.
         * Order is not placed in the database until it is confirmed
         */
        public function action_place() {

            $array = array(
                         'po_id_string' => Helper_Helper::set_pk(Constants_DocType::PURCHASE_ORDER),
                         'customer_id' => Helper_Helper::decrypt($this->session->get('userid')),
                         'terms' => $_POST['terms'] . ' Days',
                         'delivery_address_id' => Helper_Helper::decrypt($_POST['delivery_address_id']),
                         'delivery_date' => Helper_Helper::date($_POST['delivery_date'], 'Y-m-d'),
                         'order_date' => date("Y-m-d"),
                         'payment_method' => $_POST['payment_method'],
                         'date_created' => date("Y-m-d"),
                         'store_flag' => 1,
                         'order_comment' => $_POST['order_comment'],
                         'order_amount' => $_POST['order_amount']
            );
            
            $this->session->set('purchaseorder', $array);
            
            $this->json['success'] = TRUE;
            
            $this->_json_encode();
           
        }
        
        /**
         * Displays the confirmation page of purchase order
         */
        public function action_confirm() {
            
            $this->user = ORM::factory('customer')
                                 ->where('customer_id', '=', Helper_Helper::decrypt($this->session->get('userid')))
                                 ->find();
            
            $array = $this->session->get('purchaseorder');
            
            $shipping = ORM::factory('deliveryaddress')
                                  ->where('delivery_address_id', '=', $array['delivery_address_id'])
                                  ->find(); 
             
            $this->template->bodyContents = View::factory('store/checkout/confirm')
                                                    ->set('user', $this->user)
                                                    ->set('product', ORM::factory('productprice'))
                                                    ->set('details', $array)
                                                    ->set('shipping', $shipping)
                                                    ->set('items', $this->session->get('items'));
        }
        
        /**
         * Processes the checkout form to create a purchase order entry to the
         * system for company review and approval. (System Client side)
         */
        public function action_process_checkout() {
            
            if(isset($_GET['fromconfirm']) && $this->session->get('items') && $this->session->get('purchaseorder')) {
                // Gets the ordering user
                $this->user = ORM::factory('customer')
                                     ->where('customer_id', '=', Helper_Helper::decrypt($this->session->get('userid')))
                                     ->find();

                if($this->user->loaded()) {
                    // Insert values to database
                    $this->purchaseorder = ORM::factory('po')
                                                 ->values($this->session->get_once('purchaseorder'))
                                                 ->save();

                    // Sets the ORM product property to product table from database
                    $this->product = ORM::factory('product');

                    // Iterate through each item in the cart and save to database
                    foreach($this->session->get('items') as $item) {

                        $this->product->where('product_id', '=', Helper_Helper::decrypt($item['product_id']))
                                      ->find();

                        // Save item details to database
                        $this->poitems = ORM::factory('poitem')
                                                 ->values(array(
                                                     'po_id' => $this->purchaseorder->pk(),
                                                     'product_description' => $this->product->name,
                                                     'qty' => $item['qty'],
                                                     'unit_material' => NULL,
                                                     'product_price_id' => Helper_Helper::decrypt($item['product_price_id'])
                                                 ))
                                                 ->save();

                        // Clear the ORM product property for next item database insert
                        $this->product->clear();
                    }
                   
                    $this->template->title = 'Purchase Order Success | Raimol&trade; Energized Lubricants Purchase Order';
                    
                    $this->template->bodyContents = View::factory('store/checkout/success');
                }

                // Reset carts
                $this->session->delete('items');
                
                //shrek the po id
                $this->session->set('po_id', $this->purchaseorder->pk());
                $this->session->set('po_id_string', $this->purchaseorder->po_id_string);
            }
            
        }
        
        public function action_generatepdf() {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->purchaseorder = ORM::factory('po')
                            ->where('po_id' ,'=', $this->session->get_once('po_id'))
                            ->find();  
            
            if($this->purchaseorder->loaded()) {
                $filename = $this->purchaseorder->po_id_string . "--" . date("Y-m-d");

                $this->session->delete('po_id_string');
                
                $html = View::factory('store/checkout/pdf-report')
                               ->set('purchaseorder', $this->purchaseorder);      

                $html->render();

                $dompdf = new DOMPDF();
                $dompdf->load_html($html);
                $dompdf->set_paper("a4", "portrait");
                $dompdf->render();
                $dompdf->stream($filename . ".pdf", array('Attachment' => 1)); 
            }
 
        }
        
    }