<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Delivery Receipt functionality of
 * Sales module.
 * 
 * @category   Controller
 * @filesource classes/controller/cms/sales/dr.php
 * @package    OneRaimol Client
 * @author     DCDGLP
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Sales_Dr extends Controller_Cms_Sales {
        
        /**
         * @var ORM salesorder Holds the customer record from the DB.
         * @access private
         */
        private $salesorder;
       
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
            
            $this->leftSelection = $this->config['msg']['leftselection']['dr'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status Defines how the form will act on the performed action.
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['sales']['dr'];
            
            $this->template->body->pageDescription = $this->config['desc']['sales']['deliveries']['description'];
            
            // Pagination limit
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            
            $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            
            // Display the searchbox on the top bar
//            $this->template->header->searchbox = $this->_get_current_url('search');
                      
            // kailangang may notification sa grid index kung successful ba yung operation
            // ng add, edit, o delete
            // lalabas yung confirmation box dun sa successful action ng user
            // try mong magadd, edit, yung delete wala pa
            if(Helper_Helper::decrypt($status) == Constants_FormAction::ADD) {
                $this->template->body->bodyContents->success = 'created';
            }
            else if (Helper_Helper::decrypt($status) == Constants_FormAction::EDIT) {
                $this->template->body->bodyContents->success = 'updated';
            }
        }
         
        /**
         * Shows the paginated grid view
         * @param string $limit The limit to be set to the paginator
         */
        public function action_limit($limit, ORM $searchquery = NULL) {
            // Display the searchbox on the top bar
//            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->template->body->bodyContents = View::factory('cms/sales/dr/dr-grid')   //set yung html page
                                                       ->bind('deliveryreceipt', $this->deliveryreceipt);     // var to iterate yung deliveryreceipt records  
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['sales']['dr'];
                $this->template->body->pageDescription = $this->config['desc']['sales']['deliveries']['description'];
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('deliveryreceipt'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('deliveryreceipt'), 'limit', $limit);
                }

                $this->deliveryreceipt = ORM::factory('deliveryreceipt')
                                        ->order_by( 'dr_id', 'DESC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }

        /**
         * Shows the add grid, lists of sales order.
         */
        public function action_add() {
            $this->pageSelectionDesc = $this->config['msg']['actions']['newdr'];
            $this->formstatus = Constants_FormAction::ADD;

            $this->template->body->bodyContents = View::factory('cms/sales/dr/grid')
                                                        ->set('formStatus', $this->formstatus)
                                                        ->bind('purchaseorder', $this->purchaseorder);

            $this->purchaseorder = DB::select('purchase_order_tb.*', 'purchase_order_item_tb.*', 'sales_order_tb.*', array(DB::expr('COUNT(purchase_order_item_tb.po_id)'), 'total_items'))
                                    ->from('purchase_order_tb')
                                    ->join('purchase_order_item_tb')
                                    ->on('purchase_order_item_tb.po_id', '=', 'purchase_order_tb.po_id')
                                    ->join('sales_order_tb')
                                    ->on('sales_order_tb.po_id', '=', 'purchase_order_tb.po_id')
                                    ->group_by('purchase_order_item_tb.po_id')
                                    ->where('dr_id', '=', NULL)
                                    ->and_where_open()
                                    ->where('sales_order_tb.sc_approved_status' , '=', '1')
                                    ->and_where('sales_order_tb.gm_approved_status' , '=', '1')
                                    ->and_where('sales_order_tb.accountant_approved_status' , '=', '1')
                                    ->and_where('sales_order_tb.ceo_approved_status' , '=', '1')
                                    ->and_where_close()
                                    ->as_object()
                                    ->execute();
        }
        
        /**
         * Displays the sales order details page.
         * @param string $record The record to be viewed
         */
        public function action_details($record = '') {
                       
          
            $this->purchaseorder = ORM::factory('po')
                                    ->where('so_id', '=', Helper_Helper::decrypt($record))
                                    ->find();
           
                
            $this->template->body->bodyContents = View::factory('cms/sales/dr/soform')
                                                             ->set('purchaseorder', $this->purchaseorder);

        }
        
        /**
         * Displays the sales order details page.
         * @param string $record The record to be viewed
         */
        public function action_drdetails($record = '') {
                       
            $this->deliveryreceipt = ORM::factory('deliveryreceipt')
                                    ->where('dr_id', '=', Helper_Helper::decrypt($record))
                                    ->find();
            $this->purchaseorder = ORM::factory('po')
                                    ->where('dr_id', '=', Helper_Helper::decrypt($record))
                                    ->find();
            
            if($this->deliveryreceipt->loaded()) {
                $this->pageSelectionDesc = $this->config['msg']['page']['signatories']['drdetail'] . $this->deliveryreceipt->dr_id_string;
                
                // Set HTML
                $this->template->body->bodyContents = View::factory('cms/sales/dr/form')
                                                             ->set('deliveryreceipt', $this->deliveryreceipt)
                                                             ->set('purchaseorder', $this->purchaseorder);
                
                
            }
        }
        
        /**
         * Creates a Delivery Receipt
         * @param string $record the record to be a delivery receipt
         */
        public function action_create() {
            $this->formstatus = Constants_FormAction::ADD;
            foreach( $_POST['id'] as $id ) {
                $this->salesorder = ORM::factory('so')
                            ->where('so_id', '=', Helper_Helper::decrypt($id))
                            ->find();
                $this->purchaseorder = ORM::factory('po')
                            ->where('so_id', '=', $this->salesorder->so_id)
                            ->find();

                if( $this->salesorder->loaded() && $this->purchaseorder->loaded()) {
                    $dr = array (
                        'dr_id_string' => Helper_Helper::set_pk(Constants_DocType::DELIVERY_RECEIPT),
                        'so_id' => $this->salesorder->so_id,
                        'po_id' => $this->purchaseorder->po_id,
                        'dr_status' => '1',
                        'date_created' => Helper_Helper::date()
                    );
                                  
                    $this->deliveryreceipt = ORM::factory('deliveryreceipt')
                                       ->values($dr)
                                       ->save();
                

                    $po = array (
                        'dr_id' => $this->deliveryreceipt->dr_id
                    );

                    DB::update('purchase_order_tb')
                            ->set($po)
                            ->where('so_id', '=', $this->salesorder->so_id)
                            ->execute();
                }
            }

            $this->json['success'] = true;
            $this->_json_encode();
        }
        
        /**
         * Ready for delivery
         * @param string $record the record to be a delivery receipt
         */
        public function action_readyfordelivery() {
            foreach( $_POST['id'] as $id ) {
                $this->deliveryreceipt = ORM::factory('deliveryreceipt')
                            ->where('dr_id', '=', Helper_Helper::decrypt($id))
                            ->and_where('dr_status', '=', '2')
//                            ->and_where_open()
//                            ->where('pm_approved_status','=', '1')
//                            ->and_where('labanalyst_approved_status','=', '1')
//                            ->and_where('gm_approved_status','=', '1')
//                            ->and_where('sc_approved_status','=', '1')
//                            ->and_where_close()
                            ->find();

                if($this->deliveryreceipt->loaded()) {
                    $customername = substr(Helper_Helper::encrypt($this->deliveryreceipt->purchaseorders->customers->full_name()), 0, 5);
                    $customerpo = substr(Helper_Helper::encrypt($this->deliveryreceipt->purchaseorders->po_id_string), -5);
                    
                    $dr = array (
                        'delivered_date' => date("Y-m-d"),
                        'dr_status' => '3',
                        'confirmation_code' => $customername . $customerpo
                        
                    );
                                  
                    DB::update('delivery_receipt_tb')
                                ->set($dr)
                                ->where('dr_id', '=', Helper_Helper::decrypt($id))
                                ->execute();
                    
                    $this->json['success'] = true;
                }
                else {
                    $this->json['success'] = FALSE;
                    $this->json['failmessage'] = $this->config['err']['sales']['dr']['failreadydeliver'];
                }
            }

            
            $this->_json_encode();
        }
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_viewreport($record = '') {
            
            //hahanapin yung record tapos...
            $this->deliveryreceipt = ORM::factory('deliveryreceipt')
                            ->where('dr_id' ,'=', Helper_Helper::decrypt($record))
                            ->find(); 
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['viewdr'] . $this->deliveryreceipt->dr_id_string;
            $this->formstatus = Constants_FormAction::VIEW;
            
            //..tapos iloload sa variable na visible sa view, $customer
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/reports/sales/dr/viewreport')
                                                     ->set('deliveryreceipt', $this->deliveryreceipt)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Generates PDF export
         * @param string $record The record to be exported
         */
        public function action_generatepdf($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->deliveryreceipt = ORM::factory('deliveryreceipt')
                            ->where('dr_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $filename = $this->deliveryreceipt->dr_id_string . "--" . date("Y-m-d");
            $html = View::factory('cms/reports/sales/dr/pdf-report')
                           ->set('deliveryreceipt', $this->deliveryreceipt);      
            
            $html->render();
            //Log activity
            $this->_save_activity_stafflog( 'savedraspdf', $this->deliveryreceipt->dr_id_string);
            
            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");            
            $dompdf->render();
            $dompdf->stream($filename . ".pdf", array('Attachment' => 1));
        }
        
        /**
         * Confirms DR
         * @param string $record The record to be confirmed
         */
        public function action_confirm($record) {
                $this->deliveryreceipt = ORM::factory('deliveryreceipt')
                                ->where('dr_id', '=', Helper_Helper::decrypt($record))
                                ->find();

                $this->pageSelectionDesc = $this->config['msg']['actions']['viewdr'] . $this->deliveryreceipt->dr_id_string;
                $this->formstatus = Constants_FormAction::EDIT;

                $this->template->body->bodyContents = View::factory('cms/sales/dr/confirmorder')
                                                        ->set('deliveryreceipt', $this->deliveryreceipt)
                                                        ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Processes the confirm
         * @param string $record Processes the confirm
         */    
        public function action_process_confirmorder($record = '') {
                $this->deliveryreceipt = ORM::factory('deliveryreceipt')
                                ->where('dr_id', '=', Helper_Helper::decrypt($record))
                                ->where('confirmation_code', '=', $_POST['confirmation_code'])
                                ->find();

                if($this->deliveryreceipt->loaded()) {
                        $array = array (
                            'confirmation_code' => NULL,
                            'order_receive_status' => 2
                    );
                        $this->deliveryreceipt->values($array);
                        $this->deliveryreceipt->save();
                }
            }
    }