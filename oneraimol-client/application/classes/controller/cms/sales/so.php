<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Sales Order functionality of
 * Sales module.
 * 
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Sales_So extends Controller_Cms_Sales {
        
        /**
         * @var ORM customer Holds the customer record from the DB.
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
            
            $this->leftSelection = $this->config['msg']['leftselection']['so'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status Defines how the form will act on the performed action.
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['sales']['so'];
            
            $this->template->body->pageDescription = $this->config['desc']['sales']['salesorders']['description'];
            
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
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::EDIT) {
                $this->template->body->bodyContents->success = 'edited';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::DELETE) {
                $this->template->body->bodyContents->success = 'deleted';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::ENABLE) {
                $this->template->body->bodyContents->success = 'enabled';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::DISABLE) {
                $this->template->body->bodyContents->success = 'disabled';
            }
        }
        
        /**
         * Shows the paginated grid view
         * @param string $limit The limit to be set to the paginator
         */
        public function action_limit($limit, ORM $searchquery = NULL) {
            // Display the searchbox on the top bar
//            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->template->body->bodyContents = View::factory('cms/sales/so/grid')   //set yung html page
                                                       ->bind('salesorder', $this->salesorder);     // var to iterate yung customer records  
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['sales']['so'];
                $this->template->body->pageDescription = $this->config['desc']['sales']['salesorders']['description'];
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('so'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('so'), 'limit', $limit);
                }

                $this->salesorder = ORM::factory('so')
                                        ->order_by( 'so_id', 'DESC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
                
//                $this->salesorder = DB::select('purchase_order_tb.*', 'purchase_order_item_tb.*', 'sales_order_tb.*', array(DB::expr('COUNT(purchase_order_item_tb.po_id)'), 'total_items'))
//                                        ->from('purchase_order_tb')
//                                        ->join('purchase_order_item_tb')
//                                        ->on('purchase_order_item_tb.po_id', '=', 'purchase_order_tb.po_id')
//                                        ->join('sales_order_tb')
//                                        ->on('sales_order_tb.po_id', '=', 'purchase_order_tb.po_id')
//                                        ->group_by('purchase_order_item_tb.po_id')
//                                        ->where('dr_id', '=', NULL)
//                                        ->as_object()
                                   //     ->execute();
            }
        }
        
        /**
         * Displays the sales order details page.
         * @param string $record The record to be viewed
         */
        public function action_details($record = '') {
            
            $this->salesorder = ORM::factory('so')
                                     ->where('so_id', '=', Helper_Helper::decrypt($record))
                                     ->find();
            
            $this->purchaseorder = ORM::factory('po')
                                    ->where('so_id', '=', Helper_Helper::decrypt($record))
                                    ->find();
            
            if($this->salesorder->loaded()) {
                $this->pageSelectionDesc = $this->config['msg']['page']['sales']['sodetail'] . $this->salesorder->so_id_string;
                
                // Find logged in user roles
                $this->roles = $this->session->instance()->get('roles');
                
                $this->template->body->bodyContents = View::factory('cms/sales/so/form')
                                                             ->set('salesorder', $this->salesorder)
                                                             ->set('purchaseorder', $this->purchaseorder)
                                                             ->set('roles', $this->roles);

            }
        }
        /**
         * Shows the add form.
         */
        public function action_add() {
            $this->pageSelectionDesc = $this->config['msg']['actions']['newso'];
            $this->formstatus = Constants_FormAction::ADD;
            //since iisang form lang ang ginagamit sa add at edit, kelangan lang
            //bigyan ng state yung form kung add o edit ba sya,
            //kaya yun ang trabaho ng formStatus
            $this->template->body->bodyContents = View::factory('cms/accounts/customer/form')
                                                        ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_edit($record = '') {
            
            //hahanapin yung record tapos...
            $this->customer = ORM::factory('customer')
                            ->where('customer_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
           
            $this->pageSelectionDesc = $this->config['msg']['actions']['editcustomer'];
            $this->formstatus = Constants_FormAction::EDIT;
            
            //..tapos iloload sa variable na visible sa view, $customer
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/accounts/customer/editform')
                                                     ->set('customer', $this->customer)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Processes the record manipulated in the shared form.
         * @param string $record The record to be processed.
         */
        public function action_process_form($record = '') {
            
            $flag = false; //gagamitan ng flag para hindi magulo
            
            $this->customer = ORM::factory('customer');
            
            //security na rin kaya specified yung condition since
            //kung may kumag na user na maalam sa mga ganto, pwede nyang palitan ang value
            //ng formstatus na hidden field dun sa form
            if($_POST['formstatus'] == Constants_FormAction::ADD) {
                //kelangang itest kung used na yung username
                //kasi diba hindi pwedeng magpareho ang username
                $this->customer->where('username', '=', $_POST['username'])
                         ->find();
                if(! $this->customer->loaded()) {
                    //check rin for duplicate emails
                    $this->email = ORM::factory('customer')
                               ->where('username', 'is not', null)
                               ->and_where('primary_email', '=', $_POST['primary_email'])
                               ->or_where('secondary_email', '=', $_POST['primary_email'])
                               ->or_where('primary_email', '=', $_POST['secondary_email'])
                               ->or_where('primary_email', '=', $_POST['secondary_email'])
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
            }
            else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                $this->customer->where('customer_id', '=', Helper_Helper::decrypt($record))
                         ->find();
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::EDIT;
            }
           
            //kung walang error
            if($flag) {

                        if($_POST['formstatus'] == Constants_FormAction::EDIT) {


                           $querydelete = 'DELETE FROM delivery_address_tb
                                                WHERE customer_id =' .  Helper_Helper::decrypt($record);

                            $deliveryaddress = DB::query(Database::DELETE, $querydelete)->execute();


                                //$this->staff->remove('roles', $staffrole);

                        } 
                            if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                              $this->customer->values($_POST); 
                              $this->customer->save();
                            }
                            else if ($_POST['formstatus'] == Constants_FormAction::ADD) {
                                $this->customer->values($_POST);
                                $this->customer->password = sha1($_POST['password']);
                                $this->customer->save();
                            }
                    

                            foreach($_POST['id'] as $id => $ids) {
                                    $address = $_POST['address'];
                                    $province = $_POST['province'];
                                    $city = $_POST['city'];
                                    $country = $_POST['country'];

                                    $array = array (
                                        'address' => $address[$id],
                                        'province' => $province[$id],
                                        'city' => $city[$id],
                                        'country' => $country[$id],
                                        'customer_id' => $this->customer->customer_id
                                    );

                                    $this->deliveryaddress = ORM::factory('deliveryaddress')
                                                       ->values($array)
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
         * Deletes records from the DB.
         */
        public function action_delete() {
            foreach( $_POST['id'] as $id ) {
                $this->customer = ORM::factory('customer')
                            ->where('customer_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $this->customer->loaded() ) {
                    $this->customer->delete();
                }
            }

            $this->json['success'] = true;
            $this->_json_encode();
        }
        
        /**
         * Enables records from the DB.
         */
        public function action_enable() {
            foreach( $_POST['id'] as $id ) {
                $this->customer = ORM::factory('customer')
                            ->where('customer_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $this->customer->loaded() ) {
                    $this->customer->status = 1;
                    $this->customer->save();
                }
            }

            $this->json['success'] = true;
            $this->_json_encode();
        }
        
        /**
         * Disables records from the DB.
         */
        public function action_disable() {
            foreach( $_POST['id'] as $id ) {
                $this->customer = ORM::factory('customer')
                            ->where('customer_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $this->customer->loaded() ) {
                    $this->customer->status = 0;
                    $this->customer->save();
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
            $this->pageSelectionDesc = $this->config['msg']['actions']['search'] . $this->config['msg']['page']['acctmgmt']['customer'];
            
            $this->template->body->bodyContents = View::factory('cms/accounts/customer/grid');
            
            // Gotta be immune from SQL injection attacks. :)
            $this->customer = ORM::factory('customer')
                                      ->where(DB::expr("MATCH(first_name,last_name)"), 'AGAINST', DB::expr("('+$record* +$record*' IN BOOLEAN MODE)"))
                                      ->or_where(DB::expr("MATCH(company)"), 'AGAINST', DB::expr("('+$record*' IN BOOLEAN MODE)"));
            
            // Paginate the result set
            $this->action_limit($limit, $this->customer);
            
            // Set offset and item per page from the pagination object
            $this->customer->order_by( 'customer_id', 'ASC' )
                             ->limit( $this->pagination->items_per_page )
                             ->offset( $this->pagination->offset );
            
            $this->template->body->bodyContents->set('customers', $this->customer->find_all());
             
        }
        
        //same rin to sa staff
        public function action_changepassword($record = '') {
            
            //iisang view ang gagamitin ng mga change passwords
            //di ko tiningnann ang view, pero iredo mo yung mga vars sa view para 'record' lang ang tingnan nung viwe
            $this->pageSelectionDesc = $this->config['msg']['actions']['changepw'];
            $this->template->body->bodyContents = View::factory('cms/accounts/changepassword/customer-form')
                                                         ->bind('customer', $this->customer)
                                                         ->set('customer_id', $record);
            
            //alamin kung anong record ang icchange password
            $this->customer = ORM::factory('customer')
                                     ->where('customer_id', '=', Helper_Helper::decrypt($record))
                                     ->find();
            
        }
        
        public function action_processchangepw($record = '') {
                $this->json['action'] = Constants_FormAction::EDIT;
                
                $old_password = $_POST['old_password'];
                $flag = false;

                $users = ORM::factory('customer')
                        ->where('customer_id', '=', Helper_Helper::decrypt($record))
                        ->find();

                $flag = true;

                if( $users->loaded() ) {
                        if( $users->password == sha1($old_password) ) {
                            $users->password = sha1($_POST['password']);
                            $users->save();

                            $this->json['success'] = TRUE;
                        } else {
                            $this->json['success'] = FALSE;
                            $this->json['failmessage'] = $this->config['err']['account']['password'];
                        }
                }
                
                $this->_json_encode();
        } 
        
        /**
         * Populates the Unit material to the select box
         * @param int $record The request
         */
        public function action_populate_address($record = '') {
            $delivery_address = ORM::factory('deliveryaddress')->find_all();
            
            echo View::factory('cms/accounts/customer/delivery_address')->set('delivery_address', $delivery_address);
            
            exit(0);
        }    
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_viewreport($record = '') {
            
            //hahanapin yung record tapos...
            $this->salesorder = ORM::factory('so')
                            ->where('so_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $this->staff = ORM::factory('staff')
                            ->find();
            
            $this->purchaseorder = ORM::factory('po')
                            ->where('so_id', '=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['viewso'] . $this->salesorder->so_id_string;
            $this->formstatus = Constants_FormAction::VIEW;
            
            //..tapos iloload sa variable na visible sa view, $customer
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/reports/sales/so/viewreport')
                                                     ->set('salesorder', $this->salesorder)
                                                     ->set('staff', $this->staff)
                                                     ->set('purchaseorder', $this->purchaseorder)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        public function action_generatepdf($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->salesorder = ORM::factory('so')
                            ->where('so_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $filename = $this->salesorder->so_id_string . "--" . date("Y-m-d");
            $html = View::factory('cms/reports/sales/so/pdf-report')
                           ->set('salesorder', $this->salesorder);      
            
            $html->render();
            //Log activity
            $this->_save_activity_stafflog( 'savesoaspdf', $this->salesorder->so_id_string);
            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");
            $dompdf->render();
            $dompdf->stream($filename . ".pdf", array('Attachment' => 1));
        }
    }