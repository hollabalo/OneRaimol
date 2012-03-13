<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for ALL Sales Documents Report functionality of
 * Report module.
 *  
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Reports_Salesdocuments extends Controller_Cms_Reports {
        /**
         * @var ORM customer Holds the customer record from the DB.
         * @access private
         */
        private $purchaseorder;  
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = $this->config['msg']['leftselection']['salesdocuments'];
            
        }
        
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['sales']['salesdocuments'];
            
            //$this->template->body->pageDescription = $this->config['desc']['reports']['purchaseorders']['description'];
            // Pagination limit
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            
            $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            
            // Display the searchbox on the top bar
//            $this->template->header->searchbox = $this->_get_current_url('search');
        }
        
        /**
         * Shows the paginated grid view
         * @param string $limit The limit to be set to the paginator
         */
        public function action_limit($limit, ORM $searchquery = NULL) {
            // Display the searchbox on the top bar
//            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->template->body->bodyContents = View::factory('cms/reports/sales/grid')   //set yung html page
                                                       ->bind('purchaseorder', $this->purchaseorder);     // var to iterate yung customer records  
            
        }
        

        public function action_generatepdf() {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            if($_POST['doctype'] == "po") {
                
                $this->purchaseorder = ORM::factory('po')
                        
//                                ->where('status', '=', "1")
//                                ->find_all();
                ->and_where_open();

                if(isset($_POST['criteria1'])) { 
                    $this->purchaseorder->or_where('status', '=', $_POST['status']);
                }
                if(isset($_POST['criteria2'])) {
                    $this->purchaseorder->or_where('order_date', 'BETWEEN', array($_POST['from_date'], $_POST['to_date']));
                }
                if(isset($_POST['criteria3'])) {
                    $this->purchaseorder->or_where('delivery_date', 'BETWEEN', array($_POST['from_date2'], $_POST['to_date2']));
                }

                $this->purchaseorder->and_where_close();

                        
                $filename = date("Y-m-d") . "-List of Purchase Order";
                $html = View::factory('cms/reports/sales/po/pdf-report-list')
                               ->set('purchaseorder', $this->purchaseorder);      

                $html->render();

                $dompdf = new DOMPDF();
                $dompdf->load_html($html);
                $dompdf->set_paper("a4", "portrait");
                $dompdf->render();
                $dompdf->stream($filename . ".pdf", array('Attachment' => 1));
            }
            else if ($_POST['doctype'] == "so") {
                $this->salesorder = ORM::factory('so')
//                                           ->join('purchase_order_tb')
//                                           ->on('sales_order_tb.po_id', '=', 'purchase_order_tb.po_id')
                                           ;
                                //->or_where_open();

                if(isset($POST['criteria1'])) {
                    $this->salesorder
                            ->and_where('sales_order_tb.sc_approved_status', '=', $_POST['status'])
                            ->and_where('sales_order_tb.gm_approved_status', '=', $_POST['status'])
                            ->and_where('sales_order_tb.accountant_approved_status', '=', $_POST['status'])
                            ->and_where('sales_order_tb.ceo_approved_status', '=', $_POST['status']);
                }
                if(isset($_POST['criteria2'])) {
                    $this->salesorder->or_where('purchase_order_tb.order_date', 'BETWEEN', array($_POST['from_date'], $_POST['to_date']));
                }
                if(isset($_POST['criteria3'])) {
                    $this->salesorder->or_where('purchase_order_tb.delivery_date', 'BETWEEN', array($_POST['from_date2'], $_POST['to_date2']));
                }

                //$this->purchaseorder->or_where_close();

                $filename = date("Y-m-d") . "-List of Sales Order";
                $html = View::factory('cms/reports/sales/so/pdf-report-list')
                               ->set('salesorder', $this->salesorder);      

                $html->render();

                $dompdf = new DOMPDF();
                $dompdf->load_html($html);
                $dompdf->set_paper("a4", "portrait");
                $dompdf->render();
                $dompdf->stream($filename . ".pdf", array('Attachment' => 1));
            }
            else if ($_POST['doctype'] == "dr") {
                $this->deliveryreceipt = ORM::factory('deliveryreceipt')
//                                           ->join('purchase_order_tb')
//                                           ->on('delivery_receipt_tb.po_id', '=', 'purchase_order_tb.po_id')
//                                           ->join('sales_order_tb')
//                                           ->on('delivery_receipt_tb.so_id', '=', 'sales_order_tb.so_id')
                                           ;
                                //->or_where_open();

                if(isset($POST['criteria_1'])) {
                    $this->deliveryreceipt
                            ->and_where('sc_approved_status', '=', $_POST['status'])
                            ->and_where('gm_approved_status', '=', $_POST['status'])
                            ->and_where('pm_approved_status', '=', $_POST['status'])
                            ->and_where('ic_approved_status', '=', $_POST['status'])
                            ->and_where('labanalyst_approved_status', '=', $_POST['status']);
                }
                if(isset($_POST['criteria_2'])) {
                    $this->deliveryreceipt->or_where('order_date', 'BETWEEN', array($_POST['from_date'], $_POST['to_date']));
                }
                if(isset($_POST['criteria_3'])) {
                    $this->deliveryreceipt->or_where('delivery_date', 'BETWEEN', array($_POST['from_date2'], $_POST['to_date2']));
                }

                //$this->purchaseorder->or_where_close();

                $filename = date("Y-m-d") . "-List of Delivery Receipt";
                $html = View::factory('cms/reports/sales/dr/pdf-report-list')
                               ->set('deliveryreceipt', $this->deliveryreceipt);      

                $html->render();

                $dompdf = new DOMPDF();
                $dompdf->load_html($html);
                $dompdf->set_paper("legal", "landscape");
                $dompdf->render();
                $dompdf->stream($filename . ".pdf", array('Attachment' => 1));
            }
        }
        
        /**
         * 
         * @param string $record The record to be edited.
         */
        public function action_masterfile($record = '') {
            
            //hahanapin yung record tapos...
            $this->purchaseorder = ORM::factory('po')
                            ->where('po_id' ,'=', '2')
                            ->find();
            
            $this->pageSelectionDesc = '';
            $this->formstatus = Constants_FormAction::VIEW;
            
            //..tapos iloload sa variable na visible sa view, $customer
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/reports/sales/masterfile/viewreport')
                                                     ->set('purchaseorder', $this->purchaseorder)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        public function action_generatemasterpdf($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->purchaseorder = ORM::factory('po')
                            ->where('po_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $filename = $this->purchaseorder->po_id_string . "--" . date("Y-m-d");
            
            $html = View::factory('cms/reports/sales/masterfile/pdf-report')
                           ->set('purchaseorder', $this->purchaseorder);      
            
            $html->render();
            //Log activity
            $this->_save_activity_stafflog( 'savepoaspdf', $this->purchaseorder->po_id_string);
            
            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");
            $dompdf->render();
            $dompdf->stream($filename . ".pdf", array('Attachment' => 1));
        }
    }
    