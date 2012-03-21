<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Production Work Orders of Sales module
 * 
 * @category   Controller
 * @filesource classes/controller/cms/production/pwo.php
 * @package    OneRaimol Client
 * @author     DCDGLP
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Production_Pwo extends Controller_Cms_Production {
        
        /**
         * @var ORM $purchaseorder Holds the purchase order record from the DB.
         * @access private
         */
        private $productionworkorder;
        
        /**
         * @var int initialpagelimit Holds the default page limit from the system setting
         */
        private $initialpagelimit;
        /**
         * @var ORM $salesorder Holds the sales order record from the DB.
         * @access private
         */
        private $salesorder;
        
        /**
         * @var ORM $pwoitem The PWO item from the database 
         * @access private
         */
        private $pwoitem;
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = $this->config['msg']['leftselection']['pwo'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI..
         * @param string $status The status message to be displayed
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['sales']['pwo'];
            
            $this->template->body->pageDescription = $this->config['desc']['production']['productionworkorders']['description'];
            $this->template->body->pageNote = $this->config['desc']['production']['productionworkorders']['note'];
            
            // Display the searchbox on the top bar
//            $this->template->header->searchbox = $this->_get_current_url('search');
            
            // Pagination
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            
            // Form action messages response
            if(Helper_Helper::decrypt($status) == Constants_FormAction::APPROVE) {
                $this->template->body->bodyContents->success = 'approved';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::DISAPPROVE) {
                $this->template->body->bodyContents->success = 'disapproved';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::ADD) {
                $this->template->body->bodyContents->success = 'added';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::EDIT) {
                $this->template->body->bodyContents->success = 'edited';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::DELETE) {
                $this->template->body->bodyContents->success = 'deleted ';
            }
        }
        
        /**
         * Shows the paginated grid view
         * @param string $limit The limit to be set to the paginator
         * @param ORM $searchquery The query result to be paginated
         */
        public function action_limit($limit, ORM $searchquery = NULL) {
            // Display the searchbox on the top bar
//            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->template->body->bodyContents = View::factory('cms/production/pwo/grid')  
                                                       ->bind('productionworkorder', $this->productionworkorder); 
            
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
            // Paginating a result set without WHERE clause? (In short, in SQL, select all records)
            else {
                $this->pageSelectionDesc = $this->config['msg']['page']['sales']['pwo'];
                $this->template->body->pageDescription = $this->config['desc']['production']['productionworkorders']['description'];
                $this->template->body->pageNote = $this->config['desc']['production']['productionworkorders']['note'];
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('pwo'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('pwo'), 'limit', $limit);
                }
                
                $this->productionworkorder = ORM::factory('pwo')
                                        ->order_by( 'pwo_id', 'DESC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }

        /**
         * Displays the purchase order details page.
         * @param string $record The record to be viewed
         */
        public function action_add($record = '') {
            $this->template->body->bodyContents = View::factory('cms/production/pwo/form')
                                                        ->bind('productionworkorder', $this->productionworkorder)
                                                        ->bind('salesorder', $this->salesorder)
                                                        ->bind('formStatus', $this->formstatus);
            
            $this->formstatus = Constants_FormAction::ADD;

            $this->pageSelectionDesc = $this->config['msg']['page']['sales']['pwodetail'];
            

                        
            $this->salesorder = ORM::factory('so')
                                ->join('sales_order_item_tb')
                                // IF upped..
                                // ->on('so.so_id', '=', 'sales_order_item_tb.so_id')
                                ->on('sales_order_tb.so_id', '=', 'sales_order_item_tb.so_id')
                                ->where('pwo_id', '=', NULL)
                                 ->and_where_open()
                                 
                                 ->and_where('sc_approved_status', '=', 1)
                                 ->and_where('gm_approved_status', '=', 1)
                                 ->and_where('accountant_approved_status', '=', 1)
                                 ->and_where('ceo_approved_status', '=', 1)
                                 ->and_where_close()
                                 ->group_by('so_id')
                                 ->find_all();
                
        }
        
        /**
         * Deletes records from the DB.
         */
        public function action_delete() {
            foreach( $_POST['id'] as $id ) {
                $this->productionworkorder = ORM::factory('pwo')
                            ->where('pwo_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $this->productionworkorder->loaded() ) {
                    //Log activity
                    $this->_save_activity_stafflog( 'deletepwo', $this->productionworkorder->pwo_id_string);
                    $this->productionworkorder->delete();
                }
                
                $this->pwoitems = ORM::factory('pwoitem')
                            ->where('pwo_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $this->pwoitems->loaded() ) {
                    $this->pwoitems->delete();
                }
            }

            $this->json['success'] = true;
            $this->_json_encode();
        }
        
        /**
         * Displays the purchase order details page.
         * @param string $record The record to be viewed
         */
        public function action_details($record = '') {
            $this->template->body->bodyContents = View::factory('cms/production/pwo/formdetails')
                                                        ->bind('productionworkorder', $this->productionworkorder)
                                                        ->bind('salesorder', $this->salesorder)
                                                        ->bind('purchaseorder', $this->purchaseorder)
                                                        ->bind('formStatus', $this->formstatus);
            
            $this->productionworkorder = ORM::factory('pwo')
                                     ->where('pwo_id', '=', Helper_Helper::decrypt($record))
                                     ->find();
            
            $this->formstatus = Constants_FormAction::EDIT;
                if($this->productionworkorder->loaded()) {
                        $this->pageSelectionDesc = $this->config['msg']['page']['sales']['pwodetail'] . $this->productionworkorder->pwo_id_string;


                        $this->salesorder = ORM::factory('poitem')
                                             ->where('pwo_id', '=', Helper_Helper::decrypt($record) )
                                             ->find_all();
                
            }
        }
   
        /**
         * Populates the Sales Order to the grid
         * @param int $record The request
         */
        public function action_populate_so($record = '') {
            $salesorderitem = ORM::factory('soitem')
                    ->where('so_item_id', '=', ($record))
                    ->find();
            
            echo View::factory('cms/production/pwo/addso')
                    ->set('salesorderitem', $salesorderitem);
            
            exit(0);
        }
        
        /**
         * Populates the Sales Order to the grid
         * @param int $record The request
         */
        public function action_remove_so($record = '') {
            $salesorderitem = ORM::factory('soitem')
                    ->where('so_item_id', '=', ($record))
                    ->find();
            
            echo View::factory('cms/production/pwo/removeso')
                    ->set('salesorderitem', $salesorderitem);
            
            exit(0);
        }
        
        /**
         * Processes the record manipulated in the shared form.
         * @param string $record The record to be processed.
         */
        public function action_process_form($record = '') {
            
            $flag = false; //gagamitan ng flag para hindi magulo
            
            $this->productionworkorder = ORM::factory('pwo');
            
            //security na rin kaya specified yung condition since
            //kung may kumag na user na maalam sa mga ganto, pwede nyang palitan ang value
            //ng formstatus na hidden field dun sa form
            if($_POST['formstatus'] == Constants_FormAction::ADD) {

//                $this->productionworkorder->where('pwo_id', '=', Helper_Helper::decrypt($_POST['pwo_id_encrypt']))
//                         ->find();
                
                $flag = true;
                
                $this->json['action'] = Constants_FormAction::ADD;
            }
            else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                $this->productionworkorder->where('pwo_id', '=', Helper_Helper::decrypt($record))
                         ->find();
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::EDIT;
                //Log activity
                $this->_save_activity_stafflog( 'editpwo', $this->productionworkorder->pwo_id_string);
            } 
            
            if($flag) {
                
                $array = array (
                    'pwo_id_string' => Helper_Helper::set_pk(Constants_DocType::PRODUCTION_WORK_ORDER),
                    'date_created' => date("Y-m-d")
                );
                $this->productionworkorder->values($array);
                $this->productionworkorder->save();
                
                foreach($_POST['so_item_id'] as $id => $ids) {
                    
                    $batch = $this->productionworkorder->pwoitems->soitems->poitems->variants->products->materialcategory;
                    $batch_no = '';
                    if($batch->description == Constants_Category::ADDITIVES) {
                        $batch_no = Helper_Helper::batch_no(Constants_Category::ADDITIVES);
                    }
                    elseif($batch->description == Constants_Category::BASE_OIL) {
                        $batch_no = Helper_Helper::batch_no(Constants_Category::BASE_OIL);
                    }
                    else {
                        $batch_no = Helper_Helper::batch_no(Constants_Category::FINISHED_GOODS);
                    }
                            
                        $array2 = array (
                            'pwo_id' => $this->productionworkorder->pwo_id,
                            'so_item_id' => $ids,
                            'invoice_flag' => '1',
                            'batch_no' => $batch_no


                        );
                        $this->pwoitem = ORM::factory('pwoitem')
                                            ->values($array2)
                                            ->save();
                        
                        $this->salesorderitem = ORM::factory('soitem')
                                            ->where('so_item_id', '=', $_POST['so_item_id'][$id])
                                            ->find();
                        
                        $this->salesorderitem->pwo_id = $this->productionworkorder->pwo_id;
                        $this->salesorderitem->save();
                    
                        $this->purchaseorderitems = ORM::factory('poitem')
                                           ->where('so_item_id', '=', $_POST['so_item_id'][$id])
                                           ->find();
                       
                        $this->purchaseorderitems->pwo_id = $this->productionworkorder->pwo_id;
                        $this->purchaseorderitems->save();
                        
                }   
                
                if($_POST['formstatus'] == Constants_FormAction::ADD) {
                   //Log activity
                    $this->_save_activity_stafflog( 'newpwo', $this->productionworkorder->pwo_id_string);
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
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_viewreport($record = '') {
            
            //hahanapin yung record tapos...
            $this->productionworkorder = ORM::factory('pwo')
                            ->where('pwo_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['viewpwo'] . $this->productionworkorder->pwo_id_string;
            $this->formstatus = Constants_FormAction::VIEW;
            
            //..tapos iloload sa variable na visible sa view, $customer
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/reports/production/pwo/viewreport')
                                                     ->set('productionworkorder', $this->productionworkorder)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Generates PDF
         * @param string $record The record to be generated
         */
        public function action_generatepdf($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->productionworkorder = ORM::factory('pwo')
                            ->where('pwo_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $filename = $this->productionworkorder->pwo_id_string . "--" . date("Y-m-d");
            
            $html = View::factory('cms/reports/production/pwo/pdf-report')
                           ->set('productionworkorder', $this->productionworkorder);      
            
            $html->render();
            
            //Log activity
            $this->_save_activity_stafflog( 'savepwoaspdf', $this->productionworkorder->pwo_id_string);
            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("legal", "landscape");
            $dompdf->render();
            $dompdf->stream($filename . ".pdf", array('Attachment' => 1));
        }
    }