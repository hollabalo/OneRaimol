<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Unit functionality of
 * Inventory module.
 * 
 * @category   Controller
 * @filesource classes/controller/cms/inventory/unit.php
 * @package    OneRaimol Client
 * @author     DCDGLP
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Inventory_Unit extends Controller_Cms_Inventory {
        
        /**
         * @var ORM $unit Holds the customer record from the DB.
         * @access private
         */
        private $unit;
        
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
            
            $this->leftSelection = $this->config['msg']['leftselection']['unit'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status Defines how the form will act on the performed action.
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['inventory']['unit'];
            
            $this->template->body->pageDescription = $this->config['desc']['inventory']['unitofmedium']['description'];
            $this->template->body->pageNote = $this->config['desc']['inventory']['unitofmedium']['note'];
            
            // Pagination limit
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            
            $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            
            // Display the searchbox on the top bar
            $this->template->header->searchbox = $this->_get_current_url('search');
                      
            // DIsplay appropriate messages to HTML
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
            
            $this->template->body->bodyContents = View::factory('cms/inventory/unit/grid')   //set yung html page
                                                       ->bind('unit', $this->unit);     // var to iterate yung unit records  
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['inventory']['unit'];
                $this->template->body->pageDescription = $this->config['desc']['inventory']['unitofmedium']['description'];
                $this->template->body->pageNote = $this->config['desc']['inventory']['unitofmedium']['note'];
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('unitmaterialtype'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('unitmaterialtype'), 'limit', $limit);
                }

                $this->unit = ORM::factory('unitmaterialtype')
                                        ->order_by( 'um_id', 'ASC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }
        
        /**
         * Shows the add form.
         */
        public function action_add() {
            //san ba uli ung msg?..
            $this->pageSelectionDesc = $this->config['msg']['actions']['newunit'];
            $this->formstatus = Constants_FormAction::ADD;
            // Set HTML
            $this->template->body->bodyContents = View::factory('cms/inventory/unit/form')
                                                        ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_edit($record = '') {
            
            //hahanapin yung record tapos...
            $this->unit = ORM::factory('unitmaterialtype')
                            ->where('um_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['editunit'];
            $this->formstatus = Constants_FormAction::EDIT;
            
            // Set HTML
            $this->template->body->bodyContents = View::factory('cms/inventory/unit/form')
                                                     ->set('unit', $this->unit)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Processes the record manipulated in the shared form.
         * @param string $record The record to be processed.
         */
        public function action_process_form($record = '') {
            
            $flag = false; //gagamitan ng flag para hindi magulo
            
            $this->unit = ORM::factory('unitmaterialtype');
            
            // If form submit is from ADD form
            if($_POST['formstatus'] == Constants_FormAction::ADD) {
   
                $this->unit->where('description', '=', $_POST['description'])
                         ->find();
                if(! $this->unit->loaded()) {
                    //check rin for duplicate units
                    $this->description = ORM::factory('unitmaterialtype')
                               ->where('description', 'is not', null)
                               ->and_where('description', '=', $_POST['description'])
                               ->find();
                    //kung may nakitang record na me ganung email, fail
                    if($this->description->loaded()) {
                        $this->json['failmessage'] = $this->config['err']['inventory']['unit']['desc'];
                    }
                    else {
                        $flag = true;
                        $this->json['action'] = Constants_FormAction::ADD;
                    }
                    
                }
                else {
                    $this->json['failmessage'] = $this->config['err']['inventory']['unit']['desc'];
                }
            }
            // If form submit is from EDIT form
            else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                $this->unit->where('um_id', '=', Helper_Helper::decrypt($record))
                         ->find();
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::EDIT;
                //Log activity
               $this->_save_activity_stafflog( 'editunit', $this->unit->um_id);  
            } 
            
            // No errors detected
            if($flag) {
                $this->unit->values($_POST);
                $this->unit->save();
                if($_POST['formstatus'] == Constants_FormAction::ADD){
                    //Log activity
                    $this->_save_activity_stafflog( 'newunit', $this->unit->um_id);  
                }
                $this->json['success'] = true;
            }
            //may mga error na nadetect
            else {
                $this->json['success'] = false;
            }
            // Process JSON for AJAX
            $this->_json_encode();
        }
        
        /**
         * Deletes records from the DB.
         */
        public function action_delete() {
            foreach( $_POST['id'] as $id ) {
                $this->unit = ORM::factory('unitmaterialtype')
                            ->where('um_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $this->unit->loaded() ) {
                    $this->unit->delete();
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
            $this->pageSelectionDesc = $this->config['msg']['actions']['search'] . $this->config['msg']['page']['inventory']['unit'];
            
            $this->template->body->bodyContents = View::factory('cms/inventory/unit/grid');
            
            // Gotta be immune from SQL injection attacks. :)
            $this->unit = ORM::factory('unitmaterialtype')
                                      ->where(DB::expr("MATCH(description)"), 'AGAINST', DB::expr("('+$record* +$record*' IN BOOLEAN MODE)"));
                                      
            
            // Paginate the result set
            $this->action_limit($limit, $this->unit);
            
            // Set offset and item per page from the pagination object
            $this->unit->order_by( 'um_id', 'ASC' )
                             ->limit( $this->pagination->items_per_page )
                             ->offset( $this->pagination->offset );
            
            $this->template->body->bodyContents->set('unit', $this->unit->find_all());
             
        }
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_viewreport() {
            // Find record
            $this->unit = ORM::factory('unitmaterialtype')
                             ->find_all();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['viewunit'];
            $this->formstatus = Constants_FormAction::VIEW;
            
            // Set HTML
            $this->template->body->bodyContents = View::factory('cms/reports/inventory/unit/viewreport')
                                                     ->set('unit', $this->unit)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Generates PDF
         */
        public function action_generatepdf() {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->unit = ORM::factory('unitmaterialtype')
                            //->where('um_id' ,'=', Helper_Helper::decrypt($record))
                            ->find_all();  
            
            $filename = "List of Unit of Medium" . "--" . date("Y-m-d");
            
            $html = View::factory('cms/reports/inventory/unit/pdf-report')
                           ->set('unit', $this->unit);      
            
            $html->render();
            //Log activity
            $this->_save_activity_stafflog( 'saveunitaspdf', "List of Unit of Medium");
            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");
            $dompdf->render();
            $dompdf->stream($filename . ".pdf", array('Attachment' => 1));
        }
         
    }