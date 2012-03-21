<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Purchase Orders of Sales module
 * 
 * @category   Controller
 * @filesource classes/controller/cms/sales/po.php
 * @package    OneRaimol Client
 * @author     DCDGLP
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Sales_Po extends Controller_Cms_Sales {
        
        /**
         * @var ORM $purchaseorder Holds the purchase order record from the DB.
         * @access private
         */
        private $purchaseorder;
        
        /**
         * @var ORM $poitems Holds the purchase order item record to the DB
         * @access private
         */
        private $poitems;
        
        /**
         * @var ORM $soitems Holds the bullshrek
         * @access private
         */
        private $soitems;
        
        
        /**
         * @var ORM $customers Customers shreks
         * @access private
         */
        private $customers;
        
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
            
            $this->leftSelection = $this->config['msg']['leftselection']['po'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI..
         * @param string $status The status message to be displayed
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['sales']['po'];
            
            $this->template->body->pageDescription = $this->config['desc']['sales']['purchaseorders']['description'];
                       
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
                $this->template->body->bodyContents->success = 'created';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::EDIT) {
                $this->template->body->bodyContents->success = 'edited';
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
            
            $this->template->body->bodyContents = View::factory('cms/sales/po/grid')  
                                                       ->bind('purchaseorder', $this->purchaseorder); 
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['sales']['po'];
                $this->template->body->pageDescription = $this->config['desc']['sales']['purchaseorders']['description'];
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('po')->where('status' ,'=', '0'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('po')->where('status' ,'=', '0'), 'limit', $limit);
                }
                
                $this->purchaseorder = ORM::factory('po')
                                        //->where('status', '!=', '1')
                                        ->order_by( 'po_id', 'DESC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }
        /**
         * Filter purchase orders by pending, approved, disapproved or all 
         * @param string $filter The filter to be set on the page
         */
        public function action_filter($filter = '') {
            
//            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->pageSelectionDesc = $this->config['msg']['page']['sales']['po'];
            
            if($filter == 'all'){
                $this->initialpagelimit = ORM::factory('systemsetting')->find();
                $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page)); 
            }
            else {
                $this->purchaseorder = ORM::factory('po')
                            ->where('status', '=', Helper_Helper::decrypt($filter))
                            ->order_by( 'po_id', 'DESC' )
                            ->find_all();    
                
                $this->template->body->bodyContents = View::factory('cms/sales/po/grid')  
                                                           ->bind('purchaseorder', $this->purchaseorder); 
            }
                $this->template->body->bodyContents->selected = Helper_Helper::decrypt($filter);
                

        }
        
        /**
         * Shows the add form.
         */
        public function action_add() {
            $this->pageSelectionDesc = $this->config['msg']['actions']['newpo'];
            $this->formstatus = Constants_FormAction::ADD;
            // Set HTML
            $this->template->body->bodyContents = View::factory('cms/sales/po/form')
                                                        ->set('formStatus', $this->formstatus)
                                                        ->bind('customers', $this->customers)
                                                        ->bind('pagination', $pagination);
            
            $this->customers = ORM::factory('customer');
            
            $this->pagination = Pagination::factory(array(
                                        'items_per_page' => 5,
                                        'view' => 'pagination/bootstrap',
                                        'total_items' => $this->customers->count_all(),
                                    ));
            
            $this->customers = ORM::factory('customer')
                            ->limit( $this->pagination->items_per_page )
                            ->offset( $this->pagination->offset )
                            ->find_all();

            $pagination = $this->pagination->render();
        }
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_edit($record = '') {
            
            //hahanapin yung record tapos...
            $this->purchaseorder = ORM::factory('po')
                            ->where('po_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['editpo'];
            $this->formstatus = Constants_FormAction::EDIT;
            
            //..tapos iloload sa variable na visible sa view, $customer
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/sales/po/form')
                                                     ->set('purchaseorder', $this->purchaseorder)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Processes the record manipulated in the shared form.
         * @param string $record The record to be processed.
         */
        public function action_process_form($record = '') {
            
            $flag = false; //gagamitan ng flag para hindi magulo
            
            $this->purchaseorder = ORM::factory('po');
            
            
            // If form submit is from ADD
            if($_POST['formstatus'] == Constants_FormAction::ADD) {
                
               $flag = true;
               $this->json['action']=Constants_FormAction::ADD;
                              
          
            }
            // If from EDIT
            else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                $this->purchaseorder->where('po_id', '=', Helper_Helper::decrypt($record))
                         ->find();
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::EDIT;
            }
            // If from APPROVE
            else if($_POST['formstatus'] == Constants_FormAction::APPROVE) {
                $this->purchaseorder->where('po_id', '=', Helper_Helper::decrypt($record))
                         ->find();
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::APPROVE;
            }
            // No errors detected
             if($flag) {
                if($_POST['formstatus'] == Constants_FormAction::ADD) {
                    $this->purchaseorder->values($_POST);
                    $this->purchaseorder->order_date = date('Y-m-d');
                    $this->purchaseorder->terms = $_POST['terms'] . " Days";
                    //$this->purchaseorder->customer_id = $_POST['id'];
                    $this->purchaseorder->date_created = date("Y-m-d");
                    $this->purchaseorder->status = 0;
                    $this->purchaseorder->delivery_date = $_POST['delivery_date'];
//                    $this->purchaseorder->sc_approved = $this->session->get('userid');
                    $this->purchaseorder->delivery_address_id = $_POST['da_text'];
                    $this->purchaseorder->store_flag = "2";
                    $this->purchaseorder->payment_method = $_POST['payment_method'];
                    $this->purchaseorder->save();
                    
                    $totalcost = 0; 
                    foreach($_POST['id'] as $id => $ids) {
                        $item = $_POST['item'];
                        $qty = $_POST['qty'];
                        $uom = $_POST['uom'];
                        $unit_price = $_POST['unitprice'];
                        
                        $array = array (
                            'product_description' => $item[$id],
                            'qty' => $qty[$id],
                            'unit_material' => $uom[$id],
                            'unit_price' => $unit_price[$id],
                            'po_id' => $this->purchaseorder->po_id
                        );
                        
                        $unitmat = ORM::factory('unitmaterialtype')
                                    ->where('um_id', '=', $uom[$id])
                                    ->find();
                        if(is_null($unitmat->box_per_sku)){
                            $totalcost+= ($unit_price[$id] * $unitmat->size_liters) * $qty[$id];
                        }
                        else{
                            $totalcost+= (($unit_price[$id] * $unitmat->size_liters) * $unitmat->box_per_sku) * $qty[$id];
                        }
                        
                            
                        $this->poitems = ORM::factory('poitem')
                                           ->values($array)
                                           ->save();
                    }
                    
                    $order = array (
                        'order_amount' => $totalcost
                    );
                    DB::update('purchase_order_tb')
                            ->set($order)
                            ->where('po_id', '=', $this->purchaseorder->po_id)
                            ->execute();
                }
                else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                    $this->purchaseorder->delivery_date = $_POST['delivery_date'];  
                    
                    $this->purchaseorder->save();
                }
                 
                $this->json['success'] = true;
            }
            //may mga error na nadetect
            else {
                $this->json['success'] = false;
            }          
            // JSON to AJAX
            $this->_json_encode();
        }
        
        /**
         * Displays the purchase order details page.
         * @param string $record The record to be viewed
         */
        public function action_details($record = '') {
            $this->template->body->bodyContents = View::factory('cms/sales/po/form')
                                                        ->bind('purchaseorder', $this->purchaseorder);
            
            $this->purchaseorder = ORM::factory('po')
                                     ->where('po_id', '=', Helper_Helper::decrypt($record))
                                     ->find();
            
            if($this->purchaseorder->loaded()) {
                $this->pageSelectionDesc = $this->config['msg']['page']['sales']['podetail'] . $this->purchaseorder->po_id;
            }
        }
        /**
         * Approve the Purchase Order and Automatically Inserts data to Sales Order table
         * 
         */
        public function action_approve($record = '') {
//            foreach( $_POST['id'] as $id ) {
                $this->purchaseorder = ORM::factory('po')
                            ->where('po_id', '=', Helper_Helper::decrypt($record))
                            ->find();

                
                    if( $this->purchaseorder->loaded() ) {
                        $this->purchaseorder->status = 1;
                        $this->purchaseorder->date_created = date("Y-m-d");
                        $this->purchaseorder->sc_approved = $this->session->get('userid');
                        $this->purchaseorder->delivery_date = $_POST['delivery_date'];
                        $this->purchaseorder->save();

                        $salesorder = array (
                           'po_id' => $this->purchaseorder->po_id,
                           'so_id_string' => Helper_Helper::set_pk(Constants_DocType::SALES_ORDER),
                           'date_created' => $this->purchaseorder->date_created
                        );
                        $this->salesorder = ORM::factory('so')->values($salesorder)->save();   

                        $this->purchaseorder->so_id = $this->salesorder->so_id;
                        $this->purchaseorder->save();
                        
                        //alamin kung galing sa store o hindi
                        
                        $this->store = ORM::factory('po')
                                        ->where('po_id', '=', $this->purchaseorder->po_id)
                                        ->find();
                        
                        if($this->store->store_flag == "1"){
                           // $productprice = $this->purchaseorder->where('po_id', '=', $this->purchaseorder->po_id)->poitems->variants->find_all();
                            $productprice = $this->purchaseorder->where('po_id', '=', $this->purchaseorder->po_id)->poitems->find_all();
                            foreach($productprice as $result) {
                                
                                $amount = '';
                                $gross_amount = '';
                                $tax_amount = '';
                                $type_tax = '';
                                if($this->purchaseorder->deliveryaddresses->type_address == "Economic Processing Zone"){
                                    $gross_amount = (($result->variants->price * $result->variants->package_size) * $result->variants->sku) * $result->qty;
                                    $amount =$gross_amount / 1.12;
                                    $tax_amount = $gross_amount - $amount;
                                    $type_tax = Constants_Tax::VAT;
                                }
                                else if ($this->purchaseorder->deliveryaddresses->type_address == "Non-Economic Processing Zone") {
                                    $gross_amount = (($result->variants->price * $result->variants->package_size) * $result->variants->sku) * $result->qty;
                                    $amount = $gross_amount;
                                    $tax_amount = $gross_amount - $amount;
                                    $type_tax = Constants_Tax::NON_VAT;
                                }
                                else if ($this->purchaseorder->deliveryaddresses->type_address == "Zero Rated Processing Zone") {
                                    $gross_amount = (($result->variants->price * $result->variants->package_size) * $result->variants->sku) * $result->qty;
                                    $amount = $gross_amount;
                                    $tax_amount = $gross_amount - $amount;
                                    $type_tax = Constants_Tax::TAX_EXEMPT;
                                }
                                
                                
                                $array = array (
                                    'so_id' => $this->salesorder->so_id,
                                    'po_item_id' => $result->po_item_id,
                                    'tax_code_id' => $type_tax,
                                    'amount' => $amount,
                                    'gross_amount' => $gross_amount,
                                    'tax_amount' => $tax_amount
                                );

                                $this->soitems = ORM::factory('soitem')
                                                          ->values($array)
                                                          ->save(); 
                                
                               $poitem = ORM::factory('poitem')
                                       ->where('po_id', '=',$this->purchaseorder->pk())
                                       ->and_where('po_item_id', '=', $result)
                                       ->find();

                                $poitem->so_item_id = $this->soitems->so_item_id;
                                $poitem->save();
                                
                            }
                        }
                        else if ($this->store->store_flag == "2"){
                            // SA SO ITO
                            $soitems = $this->purchaseorder->poitems->find_all();

                            $ctr = 0;

                            foreach($soitems as $item) {

                                $amount = '';
                                $gross_amount = '';
                                $tax_amount = '';

                                if($_POST['tax'][$ctr] == Constants_Tax::VAT) {
                                    if(!is_null($item->unitmaterials->box_per_sku)) {
                                        $gross_amount = (($item->unit_price * $item->unitmaterials->size_liters) * $item->unitmaterials->box_per_sku) * $item->qty;
                                        $amount = $gross_amount / 1.12;
                                    }
                                    else {
                                        $gross_amount = ($item->unit_price * $item->unitmaterials->size_liters) * $item->qty;
                                        $amount = $gross_amount / 1.12;
                                    }
                                    $tax_amount = $gross_amount - $amount;
                                }
                                else if ($_POST['tax'][$ctr] == Constants_Tax::NON_VAT || $_POST['tax'][$ctr] == Constants_Tax::TAX_EXEMPT ){
                                    if(!is_null($item->unitmaterials->box_per_sku)) {
                                        $gross_amount = (($item->unit_price * $item->unitmaterials->size_liters) * $item->unitmaterials->box_per_sku) * $item->qty;
                                        $amount = $gross_amount;
                                    }
                                    else {
                                        $gross_amount = ($item->unit_price * $item->unitmaterials->size_liters) * $item->qty;
                                        $amount = $gross_amount;
                                    }
                                    
                                    $tax_amount = $gross_amount - $amount;
                                }

                                $array = array (
                                    'so_id' => $this->salesorder->so_id,
                                    'po_item_id' => $item->po_item_id,
                                    'tax_code_id' => $_POST['tax'][$ctr],
                                    'amount' => $amount,
                                    'gross_amount' => $gross_amount,
                                    'tax_amount' => $tax_amount
                                );

                                $this->soitems = ORM::factory('soitem')
                                                          ->values($array)
                                                          ->save(); 

                                $poitem = ORM::factory('poitem')
                                       ->where('po_id', '=',$this->purchaseorder->pk())
                                       ->and_where('po_item_id', '=', $item->pk())
                                       ->find();

                                $poitem->so_item_id = $this->soitems->so_item_id;
                                $poitem->save();

                                $ctr++;
                            }

                        }

                    }
//            }

            $this->json['action'] = Constants_FormAction::APPROVE;
            $this->json['success'] = true;
            $this->_json_encode();
        }
        
        /**
         * Dispprove the Purchase Order if requirements are not met
         * 
         */
        public function action_disapprove() {
           // foreach( $_POST['id'] as $id ) {
                $this->purchaseorder = ORM::factory('po')
                            ->where('po_id', '=', Helper_Helper::decrypt($_POST['id']))
                            ->find();

                if( $this->purchaseorder->loaded() ) {
                    $this->purchaseorder->status = 2;
                    $this->purchaseorder->date_created = date("Y-m-d");
                    $this->purchaseorder->save();
                    
             $salesorder = array (
               'po_id' => 0,
               'date_created' => $this->purchaseorder->date_created
            );
            $this->salesorder = ORM::factory('so')->values($salesorder)->save();   
            
            $this->purchaseorder->so_id = 0;
            $this->purchaseorder->save();
                }
            //}

            $this->json['success'] = true;
            $this->_json_encode();
        }
        
        /**
         * Populates the Unit material to the select box
         * @param int $record The request
         */
        public function action_populate_um($record = '') {
            $shrek = ORM::factory('unitmaterialtype')->find_all();
            
            echo View::factory('cms/sales/po/unitmaterial')->set('uom', $shrek);
            
            exit(0);
        }
        
        /**
         * Populates the Unit material to the select box
         * @param int $record The request
         */
        public function action_populate_deliveryaddress($record = '') {
            $deliveyaddress = ORM::factory('deliveryaddress')
                    ->where('customer_id', '=', $record)
                    ->find_all();
            
            echo View::factory('cms/sales/po/deliveryaddress')->set('deliveryaddress', $deliveyaddress);
            
            exit(0);
        }
        
        /**
         * View report
         * @param string $record The record to be viewed.
         */
        public function action_viewreport($record = '') {
            
            $this->purchaseorder = ORM::factory('po')
                            ->where('po_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['viewpo'] . $this->purchaseorder->po_id_string;
            $this->formstatus = Constants_FormAction::VIEW;
            
            // Set HTML
            $this->template->body->bodyContents = View::factory('cms/reports/sales/po/viewreport')
                                                     ->set('purchaseorder', $this->purchaseorder)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Generates PDF 
         * @param string $record The record to be PDF generated
         */
        public function action_generatepdf($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->purchaseorder = ORM::factory('po')
                            ->where('po_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $filename = $this->purchaseorder->po_id_string . "--" . date("Y-m-d");
            
            $html = View::factory('cms/reports/sales/po/pdf-report')
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
        
        /**
         * Masterfile page
         * @param string $record The record to be edited.
         */
        public function action_masterfile($record = '') {
            
            //hahanapin yung record tapos...
            $this->purchaseorder = ORM::factory('po')
                            ->where('po_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = '';
            $this->formstatus = Constants_FormAction::VIEW;
            
            // Set HTML
            $this->template->body->bodyContents = View::factory('cms/reports/sales/masterfile/viewreport')
                                                     ->set('purchaseorder', $this->purchaseorder)
                                                     ->set('formStatus', $this->formstatus);
        }
    }