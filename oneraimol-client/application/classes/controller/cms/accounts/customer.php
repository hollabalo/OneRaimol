<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Customer functionality of
 * Accounts module.
 * 
 * @category   Controller
 * @filesource classes/controller/cms/accounts/customer.php
 * @package    OneRaimol Client
 * @author     DCDGLP
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Accounts_Customer extends Controller_Cms_Accounts {
        
        /**
         * @var ORM customer Holds the customer record from the DB.
         * @access private
         */
        private $customer;
        
        /**
         * @var ORM email For ORM use as a validator for duplicate emails
         * @access private
         */
        private $email;
        
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
            
            $this->leftSelection = $this->config['msg']['leftselection']['customer'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status Defines how the form will act on the performed action.
         */
        public function action_index($status = '') {

            $this->pageSelectionDesc = $this->config['msg']['page']['acctmgmt']['customer'];
            
            $this->template->body->pageDescription = $this->config['desc']['accounts']['customer']['description'];
            $this->template->body->pageNote = $this->config['desc']['accounts']['customer']['note'];
            
            // Pagination limit
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            
            $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            
            // Display the searchbox on the top bar
            $this->template->header->searchbox = $this->_get_current_url('search');
                      
            // Display appropriate action messages to grid page
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
            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->template->body->bodyContents = View::factory('cms/accounts/customer/grid')   //set yung html page
                                                       ->bind('customers', $this->customer);     // var to iterate yung customer records  
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['acctmgmt']['customer'];
                $this->template->body->pageDescription = $this->config['desc']['accounts']['customer']['description'];
                $this->template->body->pageNote = $this->config['desc']['accounts']['customer']['note'];
                
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('customer'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('customer'), 'limit', $limit);
                }

                $this->customer = ORM::factory('customer')
                                        ->order_by( 'customer_id', 'ASC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }
        
        /**
         * Shows the add form.
         */
        public function action_add() {
            $this->pageSelectionDesc = $this->config['msg']['actions']['newcustomer'];
            $this->formstatus = Constants_FormAction::ADD;
            
            // Set HTML for page viewing
            $this->template->body->bodyContents = View::factory('cms/accounts/customer/form')
                                                        ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_edit($record = '') {
            
            $this->customer = ORM::factory('customer')
                            ->where('customer_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['editcustomer'];
            $this->formstatus = Constants_FormAction::EDIT;
            
            // Set HTML for page viewing
            $this->template->body->bodyContents = View::factory('cms/accounts/customer/editform')
                                                     ->set('customer', $this->customer)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Processes the record manipulated in the shared form.
         * @param string $record The record to be processed.
         */
        public function action_process_form($record = '') {
            // Flag for form processing
            $flag = false;
            
            $this->customer = ORM::factory('customer');
            
            // Process if form action is ADD
            if($_POST['formstatus'] == Constants_FormAction::ADD) {
                // Check if username is already userd
                $this->customer->where('username', '=', $_POST['username'])
                         ->find();
                if(! $this->customer->loaded()) {
                    // Check if email has been used
                    $email = '';
                    if(trim($_POST['secondary_email']) != '') {
                        $email = ORM::factory('customer')
                                   ->where('username', 'is not', null)
                                   ->and_where('primary_email', '=', $_POST['primary_email'])
                                   ->or_where('secondary_email', '=', $_POST['primary_email']);
                    }
                    else {
                        $email = ORM::factory('customer')
                                   ->where('username', 'is not', null)
                                   ->and_where('primary_email', '=', $_POST['primary_email'])
                                   ->or_where('secondary_email', '=', $_POST['primary_email'])
                                   ->or_where('primary_email', '=', $_POST['secondary_email'])
                                   ->or_where('secondary_email', '=', $_POST['secondary_email']);
                    }
                    
                    $this->email = $email;
                    
                    $this->email->find();
                    
                    // Found existing email
                    if($this->email->loaded()) {
                        $this->json['failmessage'] = $this->config['err']['account']['email'];
                    }
                    else {
                        $flag = true;
                        // Set action for appropriate jquery JSON response
                        $this->json['action'] = Constants_FormAction::ADD;
                    }
                    
                }
                // Errors detected, duplicate username
                else {
                    $this->json['failmessage'] = $this->config['err']['account']['username'];
                }
            }
            else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                // Email flags
                $primary = FALSE;
                $secondary = FALSE;
                
                $this->customer->where('customer_id', '=', Helper_Helper::decrypt($record))
                            ->find();
                
                if( $this->customer->loaded()) {
                    // Check if primary email POST data is the same in database
                    if($this->customer->primary_email == $_POST['primary_email'])
                            $primary = TRUE;
                    
                    // Check if secoondary email POST data is the same in database
                    if($this->customer->secondary_email == $_POST['secondary_email'])
                            $secondary = TRUE;
                    
                    // If one or both are not the same
                    if(! $primary || ! $secondary) {
                        // Check if primary and secondary email address is just switched places
                        $switchflag = FALSE;
                        
                        if($this->customer->secondary_email == $_POST['primary_email']) {
                            if($this->customer->primary_email == $_POST['secondary_email'])
                                    $switchflag = TRUE;
                        }
                        if($this->customer->primary_email == $_POST['secondary_email']) {
                            if($this->customer->secondary_email == $_POST['primary_email'])
                                    $switchflag = TRUE;
                        }
                        
                        // No switching happened
                        if(! $switchflag) {
                            $this->email = ORM::factory('customer')
                                   ->where('primary_email', '=', $_POST['primary_email'])
                                   ->or_where('secondary_email', '=', $_POST['primary_email'])
                                   ->or_where('primary_email', '=', $_POST['secondary_email'])
                                   ->or_where('secondary_email', '=', $_POST['secondary_email'])
                                   ->find();

                            if($this->email->loaded()) {
                                $this->json['failmessage'] = $this->config['err']['account']['email'];
                            }
                            else {
                                $flag = TRUE;
                                $this->json['action'] = Constants_FormAction::EDIT;
                            }
                        }
                        // The emails are just switched: allow database save
                        else {
                            $flag = TRUE;
                            $this->json['action'] = Constants_FormAction::EDIT;
                        }
                    }
                    else {
                        $flag = true;
                        $this->json['action'] = Constants_FormAction::EDIT;
                    }
                }
                else {
                    $this->json['failmessage'] = $this->config['err']['account']['username'];
                }
                //Log activity
                $this->_save_activity_stafflog( 'editcustomer', $this->customer->username);
                
            }
           
            // Process form submit if no errors are detected
            if($flag) {

                if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                    $querydelete = 'DELETE FROM delivery_address_tb
                                        WHERE customer_id =' .  Helper_Helper::decrypt($record);

                    $deliveryaddress = DB::query(Database::DELETE, $querydelete)->execute();
                } 
                if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                  $this->customer->values($_POST); 
                  $this->customer->save();
                }
                else if ($_POST['formstatus'] == Constants_FormAction::ADD) {
                    $this->customer->values($_POST);
                    $this->customer->password = sha1($_POST['password']);
                    $this->customer->save();
                    //Log activity
                    $this->_save_activity_stafflog( 'newcustomer', $this->customer->username);
                    
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
            // Error detected
            else {
                $this->json['success'] = false;
            }

            // Encode array to JSON for AJAX processing
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
                    //Log activity
                    $this->_save_activity_stafflog( 'deletecustomer', $this->customer->username);
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
                    //Log activity
                    $this->_save_activity_stafflog( 'enablecustomer', $this->customer->username);
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
                    //Log activity
                    $this->_save_activity_stafflog( 'disablecustomer', $this->customer->username);
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
        
        /**
         * Shows the change password form
         * @param string $record The account password to be changed
         */
        public function action_changepassword($record = '') {
            
            // Set HTML defaults
            $this->pageSelectionDesc = $this->config['msg']['actions']['changepw'];
            $this->template->body->bodyContents = View::factory('cms/accounts/changepassword/customer-form')
                                                         ->bind('customer', $this->customer)
                                                         ->set('customer_id', $record);
            
            // Find record to be password changed
            $this->customer = ORM::factory('customer')
                                     ->where('customer_id', '=', Helper_Helper::decrypt($record))
                                     ->find();
            
        }
        
        /**
         * Processes the change password form
         * @param string $record The record to be processed
         */
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
                            //Log activity
                            $this->_save_activity_stafflog( 'changepw', $users->customers->username);
                        } else {
                            $this->json['success'] = FALSE;
                            $this->json['failmessage'] = $this->config['err']['account']['password'];
                        }
                }
                // Encode to JSON for AJAX
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
            
            $this->customer = ORM::factory('customer')
                            ->where('customer_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['viewcustomer'] . $this->customer->full_name();
            $this->formstatus = Constants_FormAction::VIEW;
            
            // Set HTML page defaults
            $this->template->body->bodyContents = View::factory('cms/reports/accounts/customer/viewreport')
                                                     ->set('customer', $this->customer)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Generates PDF from the DB
         * @param string $record The record to be PDF generated
         */
        public function action_generatepdf($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->customer = ORM::factory('customer')
                            ->where('customer_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            
            $filename = date("Y-m-d") . "-" . $this->customer->full_name() . "'s Information";
            $html = View::factory('cms/reports/accounts/customer/pdf-report')
                           ->set('customer', $this->customer);      
            
            $html->render();

            
            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");
            $dompdf->render();
            $dompdf->stream($filename . ".pdf", array('Attachment' => 1));
        }
        
        /**
         * Generates PDF of all accounts
         */
        public function action_generatepdflist() {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->customer = ORM::factory('customer')
                            ->find_all();  
            $filename = date("Y-m-d") . "-" . "List of Customer Information";
            $html = View::factory('cms/reports/accounts/customer/grid-pdf-report')
                           ->set('customer', $this->customer);      
            
            $html->render();

            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");
            $dompdf->render();
            $dompdf->stream($filename . ".pdf", array('Attachment' => 1));
        }
    }