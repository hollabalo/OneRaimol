<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Production Batch Ticket functionality of
 * Production module.
 * 
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Production_Pbt extends Controller_Cms_Production {
        
        /**
         * @var ORM $productionbatchticket Holds the productionbatchticket record from the DB.
         * @access private
         */
        private $productionbatchticket;

        /**
         * @var string formstatus Defines how the shared form will handle the request
         * @access private
         */
        private $formstatus;
        
        /**
         * @var int initialpagelimit Holds the default page limit from the system setting
         * @access private
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
            
            $this->leftSelection = $this->config['msg']['leftselection']['pbt'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status Defines how the form will act on the performed action.
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['production']['pbt'];
            
            $this->template->body->pageDescription = $this->config['desc']['production']['productionbatchticket']['description'];
            
            // Pagination limit
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            
            $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            
            // Display the searchbox on the top bar
//            $this->template->header->searchbox = $this->_get_current_url('search');
                      
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
//            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->template->body->bodyContents = View::factory('cms/production/pbt/grid')   //set yung html page
                                                       ->bind('productionbatchticket', $this->productionbatchticket);     // var to iterate yung productionbatchticket records  
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['production']['pbt'];
                $this->template->body->pageDescription = $this->config['desc']['production']['productionbatchticket']['description'];
            
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('pbt'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('pbt'), 'limit', $limit);
                }

                $this->productionbatchticket = ORM::factory('pbt')
                                        ->order_by( 'pbt_id', 'DESC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }
        
        
        /**
         * Processes the record manipulated in the shared form.
         * @param string $record The record to be processed.
         */
        public function action_process_form($record = '') {
            
            $flag = false; //gagamitan ng flag para hindi magulo
            
            $this->productionbatchticket = ORM::factory('pbt');
            
 
            if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                $this->productionbatchticket->where('pbt_id', '=', Helper_Helper::decrypt($record))
                         ->find();
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::EDIT;
                //Log activity
                $this->_save_activity_stafflog( 'updatepbt', $this->productionbatchticket->pbt_id_string);
            } 
            
            if($flag) {
                    $pbt = array (
//                        'release_date' => Helper_Helper::date,
//                        'released_by' => $_POST['released_by'],
                        'product_code' => $_POST['product_code'],
                        'blending_time_required' => $_POST['blending_time_required'],
                        'amount_per_qty' => $_POST['qty_required'],
                        'py_theoretical' => $_POST['py_theoretical'],
                        'py_actual' => $_POST['py_actual'],
                        'machine_desc' => $_POST['machine_desc'],
                        'blending_time' => $_POST['blending_time'],
                        'variance' => $_POST['variance'],
                        'production_performed_by' => $_POST['production_performed_by'],
                        'date_produced' => Helper_Helper::date($_POST['date_produced']),
                         'remarks' => $_POST['remarks'],
                        'release_flag' => '2'
                    );
                    DB::update('production_batch_ticket_tb')
                            ->set($pbt)
                            ->where('pbt_id', '=', $this->productionbatchticket->pbt_id)
                            ->execute();
                    
                    $this->formuladetails = ORM::factory('formuladetail')
                                        ->where('formula_id', '=', $this->productionbatchticket->formula_id)
                                        ->find_all();
                    foreach ($this->formuladetails as $result) {
                        $pbtitems = array(
                            'pbt_id' => $this->productionbatchticket->pbt_id,
                            'formula_item_id' => $result->formula_item_id,
                            'stock_id' => $result->materialstocklevels->stock_id,
                            'date_created' => $result->formulas->date_created
                        );
                        $this->productionbatchticketitems = ORM::factory('pbtitem')
                                                    ->values($pbtitems)
                                                    ->save();
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
         * Shows the add form.
         */
        public function action_update($record = '') {
            
            $this->productionbatchticket = ORM::factory('pbt')
                                     ->where('pbt_id', '=', Helper_Helper::decrypt($record))
                                     ->find();
            
            $this->staffrole = ORM::factory('staffrole')
                                ->where('role_id', '=', Constants_UserType::LABORATORY_ANALYST)
                                ->find_all();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['updatepbt'] . " " . $this->productionbatchticket->pbt_id_string . " of " . $this->productionbatchticket->formulas->formula_id_string . " of " . $this->productionbatchticket->formulas->poitems->product_description;
            $this->formstatus = Constants_FormAction::EDIT;
            //since iisang form lang ang ginagamit sa add at edit, kelangan lang
            //bigyan ng state yung form kung add o edit ba sya,
            //kaya yun ang trabaho ng formStatus
            $this->template->body->bodyContents = View::factory('cms/production/pbt/form')
                                                        ->set('productionbatchticket', $this->productionbatchticket)
                                                        ->set('staffrole', $this->staffrole)
                                                        ->set('formStatus', $this->formstatus);
             

        }
        
        /**
         * Displays the sales order details page.
         * @param string $record The record to be viewed
         */
        public function action_details($record = '') {
            $this->template->body->bodyContents = View::factory('cms/production/pbt/formdetails')
                                                        ->bind('productionbatchticket', $this->productionbatchticket);
            
            $this->productionbatchticket = ORM::factory('pbt')
                                     ->where('pbt_id', '=', Helper_Helper::decrypt($record))
                                     ->find();
            
            if($this->productionbatchticket->loaded()) {
                $this->pageSelectionDesc = $this->config['msg']['page']['signatories']['pbtdetail'] . $this->productionbatchticket->pbt_id_string . " of " . $this->productionbatchticket->formulas->formula_id_string . " of " . $this->productionbatchticket->formulas->poitems->product_description;
            }
        }
        
        /**
         * Ready for release of PBT
         * @param string $record the record to be a production batch ticket
         */
        public function action_releasepbt() {
            foreach( $_POST['id'] as $id ) {
                $this->productionbatchticket = ORM::factory('pbt')
                            ->where('pbt_id', '=', Helper_Helper::decrypt($id))
                            ->and_where('release_flag', '=', '2')
                            ->and_where_open()
                            ->and_where('labanalyst_approved_status', '=', "1")
                            ->and_where('qa_approved_status', '=', "1")
                            ->and_where('hc_approved_status', '=', "1")
                            ->and_where('qa_head_approved_status', '=', "1")
                            ->and_where_close()
                            ->find();


                if( $this->productionbatchticket->loaded()  ) {
                    $pbt = array (
                        'release_flag' => '3'
                    );
                                  
                    DB::update('production_batch_ticket_tb')
                                ->set($pbt)
                                ->where('pbt_id', '=', Helper_Helper::decrypt($id))
                                ->execute();
                    
                    $this->json['success'] = true;
                }
                else {
                    $this->json['success'] = FALSE;
                    $this->json['failmessage'] = $this->config['err']['production']['pbt']['release'];
                }
            }

            
            $this->_json_encode();
        }
        /**
         * Makes a search then populates the result
         * into the data grid.
         * @param string $record The search keyword
         * @param string $limit Number of search result records per page
         */
        public function action_search($record, $limit = NULL) {
            $this->pageSelectionDesc = $this->config['msg']['actions']['search'] . $this->config['msg']['page']['production']['formulas'];
            
            $this->template->body->bodyContents = View::factory('cms/production/formula/grid');
            
            // Gotta be immune from SQL injection attacks. :)
            $this->formula = ORM::factory('formula')
                                      ->where(DB::expr("MATCH(formula_id)"), 'AGAINST', DB::expr("('+$record* +$record*' IN BOOLEAN MODE)"));
                                      
            
            // Paginate the result set
            $this->action_limit($limit, $this->supplier);
            
            // Set offset and item per page from the pagination object
            $this->formula->order_by( 'formula_id', 'ASC' )
                             ->limit( $this->pagination->items_per_page )
                             ->offset( $this->pagination->offset );
            
            $this->template->body->bodyContents->set('formula', $this->formula->find_all());
             
        }
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_viewreport($record = '') {
            
            //hahanapin yung record tapos...
            $this->productionbatchticket = ORM::factory('pbt')
                            ->where('pbt_id' ,'=', Helper_Helper::decrypt($record))
                            ->find(); 
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['viewpbt']. $this->productionbatchticket->pbt_id_string;
            $this->formstatus = Constants_FormAction::VIEW;
            
            //..tapos iloload sa variable na visible sa view, $customer
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/reports/production/pbt/viewreport')
                                                     ->set('productionbatchticket', $this->productionbatchticket)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        public function action_generatepdf($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->productionbatchticket = ORM::factory('pbt')
                            ->where('pbt_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $filename = $this->productionbatchticket->pbt_id_string . "--" . date("Y-m-d");
            
            $html = View::factory('cms/reports/production/pbt/pdf-report')
                           ->set('productionbatchticket', $this->productionbatchticket);      
            
            $html->render();
            //Log activity
            $this->_save_activity_stafflog( 'savepbtaspdf', $this->productionbatchticket->pbt_id_string);
            
            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");            
            $dompdf->render();
            $dompdf->stream($filename . ".pdf", array('Attachment' => 1));
        }
    }