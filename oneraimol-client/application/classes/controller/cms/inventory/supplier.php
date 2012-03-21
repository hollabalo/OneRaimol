<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Supplier functionality of
 * Inventory module.
 * 
 * @category   Controller
 * @filesource classes/controller/cms/inventory/supplier.php
 * @package    OneRaimol Client
 * @author     DCDGLP
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Inventory_Supplier extends Controller_Cms_Inventory {
        
        /**
         * @var ORM $supplier Holds the supplier record from the DB.
         * @access private
         */
        private $supplier;
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
            
            $this->leftSelection = $this->config['msg']['leftselection']['supplier'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status Defines how the form will act on the performed action.
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['inventory']['supplier'];
            
            $this->template->body->pageDescription = $this->config['desc']['inventory']['suppliers']['description'];
            $this->template->body->pageNote = $this->config['desc']['inventory']['suppliers']['note'];
            
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
            
            $this->template->body->bodyContents = View::factory('cms/inventory/supplier/grid')   //set yung html page
                                                       ->bind('supplier', $this->supplier);     // var to iterate yung supplier records  
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['inventory']['supplier'];
                $this->template->body->pageDescription = $this->config['desc']['inventory']['suppliers']['description'];
                $this->template->body->pageNote = $this->config['desc']['inventory']['suppliers']['note'];
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('supplier'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('supplier'), 'limit', $limit);
                }

                $this->supplier = ORM::factory('supplier')
                                        ->order_by( 'supplier_id', 'ASC' )
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
            $this->pageSelectionDesc = $this->config['msg']['actions']['newsupplier'];
            $this->formstatus = Constants_FormAction::ADD;
            //since iisang form lang ang ginagamit sa add at edit, kelangan lang
            //bigyan ng state yung form kung add o edit ba sya,
            //kaya yun ang trabaho ng formStatus
            $this->template->body->bodyContents = View::factory('cms/inventory/supplier/form')
                                                        ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_edit($record = '') {
            
            //hahanapin yung record tapos...
            $this->supplier = ORM::factory('supplier')
                            ->where('supplier_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['editsupplier'];
            $this->formstatus = Constants_FormAction::EDIT;
            
            //..tapos iloload sa variable na visible sa view, $supplier
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/inventory/supplier/form')
                                                     ->set('supplier', $this->supplier)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Processes the record manipulated in the shared form.
         * @param string $record The record to be processed.
         */
        public function action_process_form($record = '') {
            
            $flag = false; //gagamitan ng flag para hindi magulo
            
            $this->supplier = ORM::factory('supplier');
            
            //security na rin kaya specified yung condition since
            //kung may kumag na user na maalam sa mga ganto, pwede nyang palitan ang value
            //ng formstatus na hidden field dun sa form
            if($_POST['formstatus'] == Constants_FormAction::ADD) {
                //kelangang itest kung used na yung company name
                //kasi diba hindi pwedeng magpareho ang company name
                $this->supplier->where('company_name', '=', $_POST['company_name'])
                         ->find();
                if(! $this->supplier->loaded()) {
                    //check rin for duplicate emails
                    $this->email = ORM::factory('supplier')
                               ->where('company_name', 'is not', null)
                               ->and_where('email', '=', $_POST['email'])
                               ->find();
                    //kung may nakitang record na me ganung email, fail
                    if($this->email->loaded()) {
                        $this->json['failmessage'] = $this->config['err']['account']['email'];
                    }
                    else {

                        $flag = true;
                        //kelangang sabihin kung ano bang action ang ginagawa ng
                        //current form submission since iisang method lang rin
                        //ang ginagamit sa form submission, so kelangan nito para
                        //malaman ang current form action
                        $this->json['action'] = Constants_FormAction::ADD;

                    }
                    
                }

                
                else {
                    $this->json['failmessage'] = $this->config['err']['account']['username'];
                }
                //Log activity
                $this->_save_activity_stafflog( 'newsupplier', $this->supplier->full_name());
            }
            else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                $this->supplier->where('supplier_id', '=', Helper_Helper::decrypt($record))
                         ->find();
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::EDIT;
                //Log activity
                $this->_save_activity_stafflog( 'editsupplier', $this->supplier->full_name());
            } 

            
            if($flag) {
                $this->supplier->values($_POST);
                $this->supplier->save();
                
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
                $this->supplier = ORM::factory('supplier')
                            ->where('supplier_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $this->supplier->loaded() ) {
                    //Log activity
                    $this->_save_activity_stafflog( 'deletesupplier', $this->supplier->full_name());
                    $this->supplier->delete();
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
            $this->supplier = ORM::factory('supplier')
                                      ->where(DB::expr("MATCH(company_name)"), 'AGAINST', DB::expr("('+$record* +$record*' IN BOOLEAN MODE)"))
                                      ->or_where(DB::expr("MATCH(address)"), 'AGAINST', DB::expr("('+$record*' IN BOOLEAN MODE)"));
            
            // Paginate the result set
            $this->action_limit($limit, $this->supplier);
            
            // Set offset and item per page from the pagination object
            $this->supplier->order_by( 'supplier_id', 'ASC' )
                             ->limit( $this->pagination->items_per_page )
                             ->offset( $this->pagination->offset );
            
            $this->template->body->bodyContents->set('supplier', $this->supplier->find_all());
             
        }
        
        public function action_supplies($record = ''){
            $this->template->body->bodyContents = View::factory('cms/inventory/supplier/supplies/grid')
                                                        ->bind('materialsupply', $this->materialsupply)
                                                        ->set('formStatus', $this->formstatus);
          
            //para sa form edit
            $this->materialsupply = ORM::factory('materialsupply')
                                     ->where('supplier_id', '=', Helper_Helper::decrypt($record))
                                     ->find_all();

        }
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_viewreport($record = '') {
            
            //hahanapin yung record tapos...
            $this->supplier = ORM::factory('supplier')
                            ->where('supplier_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['viewsupplier'];
            $this->formstatus = Constants_FormAction::VIEW;
            
            //..tapos iloload sa variable na visible sa view, $customer
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/reports/inventory/suppliers/viewreport')
                                                     ->set('supplier', $this->supplier)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        // Generates PDF
        public function action_generatepdf($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->supplier = ORM::factory('supplier')
                            ->where('supplier_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $filename = $this->supplier->company_name . "--" . date("Y-m-d");
            
            $html = View::factory('cms/reports/inventory/suppliers/pdf-report')
                           ->set('supplier', $this->supplier);      
            
            $html->render();
            //Log activity
            $this->_save_activity_stafflog( 'savesupplieraspdf', $this->supplier->company_name);
            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");
            $dompdf->render();
            $dompdf->stream($filename . ".pdf", array('Attachment' => 1));
        }
         
    }