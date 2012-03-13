<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Supplier functionality oooof
 * Inventory module.
 * 
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Inventory_SuppliesStock extends Controller_Cms_Inventory {
        
        /**
         * @var ORM $materialstocklevel Holds the materialstocklevel record from the DB.
         * @access private
         */
        private $materialstocklevel;
        /**
         * @var ORM $materialsupply Holds the materialsupply record from the DB
         * @access private
         */
        private $materialsupply;
        /**
         * @var string formstatus Defines how the shared form will handle the request
         * @access private
         */
        private $formstatus;
        
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
            
            $this->leftSelection = $this->config['msg']['leftselection']['supplies'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status Defines how the form will act on the performed action.
         */

        public function action_view($record = '', $status= ''){
            
            $this->template->body->bodyContents = View::factory('cms/inventory/supplies/stock/grid')
                                            ->bind('materialsupply', $this->materialsupply)
                                            ->bind('materialstocklevel', $this->materialstocklevel)
                                            ->set('formStatus', $this->formstatus);
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
            
            $this->materialsupply = ORM::factory('materialsupply')
                                    ->where('material_supply_id', '=', Helper_Helper::decrypt($record))
                                    ->find();
            
            $this->materialstocklevel = $this->materialsupply->materialstocklevel->find_all();
                                  
        }
        
        /**
         * Shows the paginated grid view
         * @param string $limit The limit to be set to the paginator
         */
        public function action_limit($limit, ORM $searchquery = NULL) {
            // Display the searchbox on the top bar
            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->template->body->bodyContents = View::factory('cms/inventory/supplies/stock/grid')
                                            ->bind('materialsupply', $this->materialsupply)
                                            ->bind('materialstocklevel', $this->materialstocklevel);
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['inventory']['supplies'];
                
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('materialstocklevel'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('materialstocklevel'), 'limit', $limit);
                }

                $this->materialstocklevel = ORM::factory('materialstocklevel')
                                        ->order_by( 'material_supply_id', 'ASC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }
        /**
         * Shows the add form.
         */
        public function action_add($record = '') {
            $this->pageSelectionDesc = $this->config['msg']['actions']['newstock'];
            $this->formstatus = Constants_FormAction::ADD;
            //since iisang form lang ang ginagamit sa add at edit, kelangan lang
            //bigyan ng state yung form kung add o edit ba sya,
            //kaya yun ang trabaho ng formStatus
            $this->materialsupply = ORM::factory('materialsupply')
                            ->where('material_supply_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            $this->template->body->bodyContents = View::factory('cms/inventory/supplies/stock/form')
                                                        ->set('materialsupply', $this->materialsupply)
                                                        ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_edit($record = '') {
            
            //hahanapin yung record tapos...
            $this->materialstocklevel = ORM::factory('materialstocklevel')
                            ->where('stock_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['editstock'];
            $this->formstatus = Constants_FormAction::EDIT;
            
            //..tapos iloload sa variable na visible sa view, $supplier
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/inventory/supplies/stock/form')
                                                     ->set('materialstocklevel', $this->materialstocklevel)
                                                     ->set('materialsupply', TRUE)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Processes the record manipulated in the shared form.
         * @param string $record The record to be processed.
         */
        public function action_process_form($record = '') {
            
            $flag = false; //gagamitan ng flag para hindi magulo
            
            if($_POST['formstatus'] == Constants_FormAction::ADD) {
                $this->materialstocklevel = ORM::factory('materialstocklevel');
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::ADD;

            }
            else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                $this->materialstocklevel = ORM::factory('materialstocklevel')
                                            ->where('stock_id', '=', Helper_Helper::decrypt($record))
                                            ->find();
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::EDIT;
               //Log activity
               $this->_save_activity_stafflog( 'editstock', $this->materialstocklevel->stock_id);
            } 
            
            if($flag) {
                $this->materialstocklevel->values(array( 
                                              'liters' => $_POST['liters'],
                                              'stock_taking_date' => $_POST['stock_taking_date'],
                                              'expiration_date' => $_POST['expiration_date'],
                                              'material_supply_id' => Helper_Helper::decrypt($_POST['material_supply_id'])
                                            ));
                $this->materialstocklevel->save();
                if($_POST['formstatus'] == Constants_FormAction::ADD) {
                   //Log activity
                   $this->_save_activity_stafflog( 'newstock', $this->materialstocklevel->stock_id);
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
         * Deletes records from the DB.
         */
        public function action_delete() {
            foreach( $_POST['id'] as $id ) {
                $this->materialstocklevel = ORM::factory('materialstocklevel')
                            ->where('stock_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $this->materialstocklevel->loaded() ) {
                   //Log activity
                   $this->_save_activity_stafflog( 'deletestock', $this->materialstocklevel->stock_id);
                    $this->materialstocklevel->delete();
                }
            }

            $this->json['success'] = true;
            $this->_json_encode();
        }
                  
        /**
         * Makes a search then populates the result
         * into the data grid.
         * @param string $record The search keyword
         * @param string $limit Number of search result records per page
         */
        public function action_search($record, $limit = NULL) {
            $this->pageSelectionDesc = $this->config['msg']['actions']['search'] . $this->config['msg']['page']['inventory']['supplier'];
            
            $this->template->body->bodyContents = View::factory('cms/inventory/supplier/grid');
            
            // Gotta be immune from SQL injection attacks. :)
            $this->materialstocklevel = ORM::factory('materialstocklevel')
                                      ->where(DB::expr("MATCH(name)"), 'AGAINST', DB::expr("('+$record* +$record*' IN BOOLEAN MODE)"))
                                      ->or_where(DB::expr("MATCH(address)"), 'AGAINST', DB::expr("('+$record*' IN BOOLEAN MODE)"));
            
            // Paginate the result set
            $this->action_limit($limit, $this->materialstocklevel);
            
            // Set offset and item per page from the pagination object
            $this->materialstocklevel->order_by( 'stock_id', 'ASC' )
                             ->limit( $this->pagination->items_per_page )
                             ->offset( $this->pagination->offset );
            
            $this->template->body->bodyContents->set('materialstocklevel', $this->materialstocklevel->find_all());
             
        }       
    }