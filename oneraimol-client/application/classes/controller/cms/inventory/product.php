<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Product functionality of
 * Inventory module.
 * 
 * @category   Controller
 * @filesource classes/controller/cms/inventory/product.php
 * @package    OneRaimol Client
 * @author     DCDGLP
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Inventory_Product extends Controller_Cms_Inventory {
        
        /**
         * @var ORM $productprice Holds the product record from the DB.
         * @access private
         */
        private $productprice;
        
         /**
         * @var ORM $product Holds the product record from the DB.
         * @access private
         */
        private $product;
        /**
         * @var string formstatus Defines how the shared form will handle the request
         * @access private
         */
        private $formstatus;
        
        /**
         * @var string tae
         * @access private
         */
        private $productstock;
        
        /**
         * @var int initialpagelimit Holds the default page limit from the system setting
         */
        private $initialpagelimit;

        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = $this->config['msg']['leftselection']['product'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status Defines how the form will act on the performed action.
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['inventory']['product'];
            
            $this->template->body->pageDescription = $this->config['desc']['inventory']['finishedproducts']['description'];
            
            // Pagination limit
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            
            $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            
            // Display the searchbox on the top bar
            $this->template->header->searchbox = $this->_get_current_url('search');
                      
            // kailangang may notification sa grid index kung successful ba yung operation
            // ng add, edit, o delete
            // lalabas yung confirmation box dun sa successful action ng user
            if(Helper_Helper::decrypt($status) == Constants_FormAction::ADD) {
                $this->template->body->bodyContents->success = 'created';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::EDIT) {
                $this->template->body->bodyContents->success = 'edited';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::DELETE) {
                $this->template->body->bodyContents->success = 'deleted';
            }
         }
        
        /**
         * Shows the paginated grid view
         * @param string $limit The limit to be set to the paginator
         */
        public function action_limit($limit, ORM $searchquery = NULL) {
            // Display the searchbox on the top bar
            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->template->body->bodyContents = View::factory('cms/inventory/product/grid')   //set yung html page
                                                       ->bind('product', $this->product);     // var to iterate yung product records  
            
            // Paginating a result set with WHERE clause?
            if(!is_null($searchquery)) {
                // Important! Else, incorrect result will display. Or the query won't work.
                $queryclone = clone $searchquery;
                
                // Check if limit is supplied on the URI, else, don't paginate
                if(is_null($limit)) {
                    $this->_pagination($queryclone, 'limit', NULL, TRUE);
                }
                else {
                    $this->_pagination($queryclone, 'limit', $limit, TRUE);
                }
            }
            else {
                $this->pageSelectionDesc = $this->config['msg']['page']['inventory']['product'];
                $this->template->body->pageDescription = $this->config['desc']['inventory']['finishedproducts']['description'];
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('product'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('product'), 'limit', $limit);
                }

                $this->product = ORM::factory('product')
                                        ->order_by( 'product_id', 'ASC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }
        
        /**
         * Displays the product details page.
         * @param string $record The record to be viewed
         */
         public function action_details($record = '', $status = '') {
            $this->formstatus = Constants_FormAction::MULTIPLE;

            
            $this->product = ORM::factory('product')
                                     ->where('product_id', '=', Helper_Helper::decrypt($record))
                                     ->find();
            
            
            $this->productprice = ORM::factory('productprice')
                                     ->where('product_id', '=', Helper_Helper::decrypt($record))
                                     ->find_all();
            
            $this->productstock = ORM::factory('productstock')
                                    ->where('product_id', '=', Helper_Helper::decrypt($record))
                                    ->find_all();
            
             $cats = ORM::factory('materialcategory')
                           ->where('parent_category_1', 'IS', NULL)
                           ->and_where('parent_category_2', 'IS', NULL)
                           ->find_all();
            $this->template->body->bodyContents = View::factory('cms/inventory/product/form')
                                                        ->set('productprice', $this->productprice)
                                                        ->set('product', $this->product)
                                                        ->set('productstock', $this->productstock)
                                                        ->set('url', $this->request->uri())
                                                        ->set('formStatus', $this->formstatus)
                                                        ->set('parentcat', $cats);
            
        }
        
        /**
         * Shows the add form.
         */
        public function action_add($record = '') {
            //san ba uli ung msg?..
            $this->pageSelectionDesc = $this->config['msg']['actions']['newproduct'];
            $this->formstatus = Constants_FormAction::ADD;
            //since iisang form lang ang ginagamit sa add at edit, kelangan lang
            //bigyan ng state yung form kung add o edit ba sya,
            //kaya yun ang trabaho ng formStatus
            $this->product = ORM::factory('product')
                            ->where('product_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $cats = ORM::factory('materialcategory')
                           ->where('parent_category_1', 'IS', NULL)
                           ->and_where('parent_category_2', 'IS', NULL)
                           ->find_all();
            
            $this->template->body->bodyContents = View::factory('cms/inventory/product/formproduct')
                                                        ->set('product', $this->product)
                                                        ->set('formStatus', $this->formstatus)
                                                        ->set('parentcat', $cats);
        }
        /**
         * Shows the add form.
         */
        public function action_addprice($record = '') {
            //san ba uli ung msg?..
            $this->pageSelectionDesc = $this->config['msg']['actions']['newproduct'];
            $this->formstatus = Constants_FormAction::ADD;
            //since iisang form lang ang ginagamit sa add at edit, kelangan lang
            //bigyan ng state yung form kung add o edit ba sya,
            //kaya yun ang trabaho ng formStatus
            $this->product= ORM::factory('product')
                            ->where('product_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->template->body->bodyContents = View::factory('cms/inventory/product/formprice')
                                                        ->set('product', $this->product)
                                                        ->set('formStatus', $this->formstatus)
                                                        ->set('product_id', $record);
        }
        
        /**
         * Shows the add form.
         */
        public function action_addstock($record = '') {
 
            $this->pageSelectionDesc = $this->config['msg']['actions']['newstock'];
            $this->formstatus = Constants_FormAction::ADD;
            //since iisang form lang ang ginagamit sa add at edit, kelangan lang
            //bigyan ng state yung form kung add o edit ba sya,
            //kaya yun ang trabaho ng formStatus
            $this->product = ORM::factory('product')
                            ->where('product_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            
            $this->template->body->bodyContents = View::factory('cms/inventory/product/formstock')
                                                        ->set('product', $this->product)
                                                        ->set('product_id', $record)
                                                        ->set('formStatus', $this->formstatus);
        }
         /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_edit($record = '') {
            
            //hahanapin yung record tapos...
            $this->productprice = ORM::factory('productprice')
                            ->where('product_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['editproduct'];
            $this->formstatus = Constants_FormAction::EDIT;
            
            //..tapos iloload sa variable na visible sa view, $supplier
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/inventory/product/form')
                                                     ->set('productprice', $this->productprice)
                                                     ->set('formStatus', $this->formstatus);
        }
          
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_editprice($record = '') {
            
            //hahanapin yung record tapos...
            $this->productprice = ORM::factory('productprice')
                            ->where('product_price_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['editproduct'];
            $this->formstatus = Constants_FormAction::EDIT;
            
            //..tapos iloload sa variable na visible sa view, $product
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/inventory/product/formprice')
                                                     ->set('productprice', $this->productprice)
                                                     ->set('product_id', $record)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_editstock($record = '') {
            
            //hahanapin yung record tapos...
            $this->productstock = ORM::factory('productstock')
                            ->where('product_stock_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['editproduct'];
            $this->formstatus = Constants_FormAction::EDIT;
            
            //..tapos iloload sa variable na visible sa view, $product
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/inventory/product/formstock')
                                                     ->set('productstock', $this->productstock)
                                                     ->set('product_id', $record)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Processes the record manipulated in the shared form.
         * @param string $record The record to be processed.
         */
        public function action_process_form($record = '') {
            
            $flag = false; //gagamitan ng flag para hindi magulo
            
            $this->product = ORM::factory('product');
            
            //security na rin kaya specified yung condition since
            //kung may kumag na user na maalam sa mga ganto, pwede nyang palitan ang value
            //ng formstatus na hidden field dun sa form
            if($_POST['formstatus'] == Constants_FormAction::ADD) {
                //kelangang itest kung used na yung username
                //kasi diba hindi pwedeng magpareho ang username
                $this->product->where('name', '=', $_POST['name'])
                         ->find();
                
               $flag = true;
               $this->json['action']=Constants_FormAction::ADD;
              
          
            }
            else if($_POST['formstatus'] == Constants_FormAction::MULTIPLE) {
                $this->product->where('product_id', '=', Helper_Helper::decrypt($record))
                         ->find();
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::EDIT;
                //Log activity
                $this->_save_activity_stafflog( 'editproduct', $this->product->name);     
            }
             if($flag) {
                $this->product->values($_POST);
                $this->product->material_category_id = Helper_Helper::decrypt($_POST['material_category_id']);
                $this->product->save();
                
                if($_POST['formstatus'] == Constants_FormAction::ADD){
                    //Log activity
                    $this->_save_activity_stafflog( 'newproduct', $this->product->name);  
                }      
                
                $this->json['success'] = true; 
              
            }
            //may mga error na nadetect
            else {
                $this->json['success'] = false;
            }          
            //since ajax ang method ng pagssubmit ng form, kelangang pasahan ng
            //json encoded message yung page para mamanipulate thru javascript yung
            //gagawin ng form kapag nasubmit na yung form
            $this->_json_encode();
        }
        
        /**
         * Processes the record manipulated in the shared form.
         * @param string $record The record to be processed.
         */
        public function action_process_formprice($record = '') {
            
            $flag = false; //gagamitan ng flag para hindi magulo
            
            $this->productprice = ORM::factory('productprice');
            
            //security na rin kaya specified yung condition since
            //kung may kumag na user na maalam sa mga ganto, pwede nyang palitan ang value
            //ng formstatus na hidden field dun sa form
            if($_POST['formstatus'] == Constants_FormAction::ADD) {

                $flag = true;
                $this->json['action'] = Constants_FormAction::ADD;
                
            }
            else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                $this->productprice->where('product_price_id', '=', Helper_Helper::decrypt($record))
                         ->find();
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::EDIT;
            }
             if($flag) {
                $this->productprice->values($_POST);
                $this->productprice->product_id = Helper_Helper::decrypt($_POST['product_id']);
                $this->productprice->save();
                
                $this->json['success'] = true;
            }
            //may mga error na nadetect
            else {
                $this->json['success'] = false;
            }          
            //since ajax ang method ng pagssubmit ng form, kelangang pasahan ng
            //json encoded message yung page para mamanipulate thru javascript yung
            //gagawin ng form kapag nasubmit na yung form
            $this->_json_encode();
        }
        
        /**
         * Processes the record manipulated in the shared form.
         * @param string $record The record to be processed.
         */
        public function action_process_formstock($record = '') {
            
            $flag = false; //gagamitan ng flag para hindi magulo
            
            $this->productstock = ORM::factory('productstock');
            
            //security na rin kaya specified yung condition since
            //kung may kumag na user na maalam sa mga ganto, pwede nyang palitan ang value
            //ng formstatus na hidden field dun sa form
            if($_POST['formstatus'] == Constants_FormAction::ADD) {

//                $this->productstock->where('product_stock_id', '=', Helper_Helper::decrypt($_POST['product_stock_id']))
//                                    ->find();

                $flag = true;
                $this->json['action'] = Constants_FormAction::ADD;
                
            }
            else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                $this->productstock->where('product_stock_id', '=', Helper_Helper::decrypt($record))
                         ->find();
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::EDIT;
            }
             if($flag) {
                $this->productstock->values($_POST);
                $this->productstock->product_id = Helper_Helper::decrypt($_POST['product_id']);
                
                $this->productstock->save();
                
                $this->json['success'] = true;
            }
            //may mga error na nadetect
            else {
                $this->json['success'] = false;
            }          
            //since ajax ang method ng pagssubmit ng form, kelangang pasahan ng
            //json encoded message yung page para mamanipulate thru javascript yung
            //gagawin ng form kapag nasubmit na yung form
            $this->_json_encode();
        }
        /**
         * Deletes records from the DB.
         */
        public function action_delete() {
            foreach( $_POST['id'] as $id ) {
                $this->product = ORM::factory('product')
                            ->where('product_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $this->product->loaded() ) {
                    //Log activity
                    $this->_save_activity_stafflog( 'deleteproduct', $this->product->name);  
                    $this->product->delete();
                }
            }

            $this->json['success'] = true;
            $this->_json_encode();
        }
            
        /**
         * Deletes records from the DB.
         */
        public function action_deleteprice() {
            foreach( $_POST['id'] as $id ) {
                $this->productprice = ORM::factory('productprice')
                            ->where('product_price_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $this->productprice->loaded() ) {
                    $this->productprice->delete();
                }
            }

            $this->json['success'] = true;
            $this->_json_encode();
        }        
        /**
         * Deletes records from the DB.
         */
        public function action_deletestock() {
            foreach( $_POST['id'] as $id ) {
                $this->productstock = ORM::factory('productstock')
                            ->where('product_stock_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $this->productstock->loaded() ) {
                    $this->productstock->delete();
                }
            }

            $this->json['success'] = true;
            $this->_json_encode();
        }    
        
        /**
         * Populates categories 1 into DOM elements
         * @param string $arg The method argument
         */
        public function action_subcat1($arg = '') {
            $cat = ORM::factory('materialcategory')
                         ->where('parent_category_1', '=', Helper_Helper::decrypt($arg))
                         ->and_where('parent_category_2', 'IS', NULL)
                         ->find_all();
            
            if($cat->count() > 0) {
                echo View::factory('common/categorybox')
                            ->set('record', $cat)
                            ->set('subcatno', 1);
            }
            
            exit(0);
        }
        
        /**
         * Populates categories 2 into DOM element
         * @param string $arg 
         */
        public function action_subcat2($arg = '') {
            $cat = ORM::factory('materialcategory')
                         ->where('parent_category_2', '=', Helper_Helper::decrypt($arg))
                         ->find_all();
            
            if($cat->count() > 0) {
                echo View::factory('common/categorybox')
                            ->set('record', $cat)
                            ->set('subcatno', 2);
            }
            
            exit(0);
        }
        
        /**
         * Makes a search then populates the result
         * into the data grid.
         * @param string $record The search keyword
         * @param string $limit Number of search result records per page
         */
        public function action_search($record, $limit = NULL) {
            $this->pageSelectionDesc = $this->config['msg']['actions']['search'] . $this->config['msg']['page']['inventory']['product'];
            
            $this->template->body->bodyContents = View::factory('cms/inventory/product/grid');
            
            // Gotta be immune from SQL injection attacks. :)
            $this->product = ORM::factory('product')
                                      ->where(DB::expr("MATCH(name)"), 'AGAINST', DB::expr("('+$record* +$record*' IN BOOLEAN MODE)"));
                                     
            
            // Paginate the result set
            $this->action_limit($limit, $this->product);
            
            // Set offset and item per page from the pagination object
            $this->product->order_by( 'product_id', 'ASC' )
                             ->limit( $this->pagination->items_per_page )
                             ->offset( $this->pagination->offset );
            
            $this->template->body->bodyContents->set('product', $this->product->find_all());
             
        }
         
    }