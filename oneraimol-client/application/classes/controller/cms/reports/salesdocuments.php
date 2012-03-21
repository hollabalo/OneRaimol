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
        
        /**
         * Purchase order criterias
         * @param ORM $orm
         * @return ORM 
         */
        protected function _criteria_po(ORM $orm) {
            // Note: none
            
            if(isset($_POST['criteria1'])) { 
                $orm->where('status', '=', $_POST['status']);
            }
            if(isset($_POST['criteria2'])) {
                $orm->and_where('order_date', 'BETWEEN', array($_POST['from_date'], $_POST['to_date']));
            }
            if(isset($_POST['criteria3'])) {
                $orm->and_where('delivery_date', 'BETWEEN', array($_POST['from_date2'], $_POST['to_date2']));
            }
            
            return $orm;
        }
        
        /**
         *
         * @param ORM $orm
         * @return ORM 
         */
        protected function _criteria_so(ORM $orm) {
            // Note: change all 'sales_order_tb' into
            //       'so' before upping.
            
            $orm->join('purchase_order_tb')
                 ->on('sales_order_tb.po_id', '=', 'purchase_order_tb.po_id');

            if(isset($_POST['criteria1'])) {
                $orm->and_where_open();
                
                $orm->where('sales_order_tb.sc_approved_status', '=', $_POST['status'])
                    ->and_where('sales_order_tb.gm_approved_status', '=', $_POST['status'])
                    ->and_where('sales_order_tb.accountant_approved_status', '=', $_POST['status'])
                    ->and_where('sales_order_tb.ceo_approved_status', '=', $_POST['status']);
                
                $orm->and_where_close();
            }
            if(isset($_POST['criteria2'])) {
                $orm->and_where('purchase_order_tb.order_date', 'BETWEEN', array($_POST['from_date'], $_POST['to_date']));
            }
            if(isset($_POST['criteria3'])) {
                $orm->and_where('purchase_order_tb.delivery_date', 'BETWEEN', array($_POST['from_date2'], $_POST['to_date2']));
            }
            
            return $orm;
        }
        
        /**
         *
         * @param ORM $orm
         * @return ORM 
         */
        protected function _criteria_dr(ORM $orm) {
            // Note: change all 'delivery_receipt_tb' into
            //       'deliveryreceipt' before upping.
            
            $orm->join('purchase_order_tb')
                ->on('delivery_receipt_tb.po_id', '=', 'purchase_order_tb.po_id')
                ->join('sales_order_tb')
                ->on('delivery_receipt_tb.so_id', '=', 'sales_order_tb.so_id');
            
            if(isset($_POST['criteria1'])) {
                $orm->and_where_open();
                
                $orm->where('delivery_receipt_tb.sc_approved_status', '=', $_POST['status'])
                    ->and_where('delivery_receipt_tb.gm_approved_status', '=', $_POST['status'])
                    ->and_where('delivery_receipt_tb.pm_approved_status', '=', $_POST['status'])
                    ->and_where('delivery_receipt_tb.ic_approved_status', '=', $_POST['status'])
                    ->and_where('delivery_receipt_tb.labanalyst_approved_status', '=', $_POST['status']);
                
                $orm->and_where_close();
            }
            if(isset($_POST['criteria2'])) {
                $orm->and_where('purchase_order_tb.order_date', 'BETWEEN', array($_POST['from_date'], $_POST['to_date']));
            }
            if(isset($_POST['criteria3'])) {
                $orm->and_where('purchase_order_tb.delivery_date', 'BETWEEN', array($_POST['from_date2'], $_POST['to_date2']));
            }
            
            return $orm;
        }
        

        public function action_generatepdf() {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            if($_POST['doctype'] == "po") {
                
                $this->purchaseorder = $this->_criteria_po(ORM::factory('po'))
                                             ->order_by('po_id', "DESC")
                                             ->find_all();
                        
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
                $this->salesorder = $this->_criteria_so(ORM::factory('so'))
                                         ->order_by('sales_order_tb.so_id', "DESC")
                                         ->find_all();          

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
                $this->deliveryreceipt = $this->_criteria_dr(ORM::factory('deliveryreceipt'))
                                              ->order_by('delivery_receipt_tb.dr_id', "DESC")
                                              ->find_all();

                $filename = date("Y-m-d") . "-List of Delivery Receipt";
                $html = View::factory('cms/reports/sales/dr/pdf-report-list')
                               ->set('deliveryreceipt', $this->deliveryreceipt);      

                $html->render();
                
                $dompdf = new DOMPDF();
                $dompdf->load_html($html);
                $dompdf->set_paper("a4");
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
    