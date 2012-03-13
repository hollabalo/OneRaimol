<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Staff functionality of
 * Accounts module.
 * 
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Accounts_Staff extends Controller_Cms_Accounts {
        
        /**
         * @var ORM staff Container for staff information pulled from the DB
         * @access private
         */
        private $staff;
        
        /**
         * @var ORM role Container for staff roles pulled from the DB
         * @access private
         */
        private $role;
        
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
            
            $this->leftSelection = $this->config['msg']['leftselection']['staff'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status Defines how the form will act on the performed action.
         */
        public function action_index($status ='') {
            
            $this->template->body->pageDescription = $this->config['desc']['accounts']['staff']['description'];
            $this->template->body->pageNote = $this->config['desc']['accounts']['staff']['note'];
            
            $this->pageSelectionDesc = $this->config['msg']['page']['acctmgmt']['staff'];
            
  
            
            // Display the searchbox on the top bar
            $this->template->header->searchbox = $this->_get_current_url('search');
            
            // Pagination limit
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            
            // For form action messages
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
                $this->template->body->bodyContents->success = 'activated';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::DISABLE) {
                $this->template->body->bodyContents->success = 'deactivated';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::ACTIVATED) {
                $this->template->body->bodyContents->success = 'activated';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::NOT_ACTIVATED) {
                $this->template->body->bodyContents->success = 'not activated';
            }
        }
        
        /**
         * Shows the paginated grid view
         * @param string $limit The limit to be set to the paginator
         */
        public function action_limit($limit, ORM $searchquery = NULL) {   
            // Display the searchbox on the top bar
            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->template->body->bodyContents = View::factory('cms/accounts/staff/grid')
                                                         ->bind('staffs', $this->staff);
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['acctmgmt']['staff'];
                $this->template->body->pageDescription = $this->config['desc']['accounts']['staff']['description'];
                $this->template->body->pageNote = $this->config['desc']['accounts']['staff']['note'];
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('staff'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('staff'), 'limit', $limit);
                }
                $currentid = $this->session->get('userid');
                
                $this->staff = ORM::factory('staff')
                                        ->where('staff_id', '!=', $currentid)
                                        ->order_by( 'staff_id', 'ASC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }
        
        /**
         * Shows the add form.
         */
        public function action_add() {
            $this->pageSelectionDesc = $this->config['msg']['actions']['newstaff'];
            $this->formstatus = Constants_FormAction::ADD;

            $this->template->body->bodyContents = View::factory('cms/accounts/staff/form')
                                                        ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_edit($record = '') {
            
            $this->staff = ORM::factory('staff')
                            ->where('staff_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['editstaff'];
            $this->formstatus = Constants_FormAction::EDIT;
            
            $this->template->body->bodyContents = View::factory('cms/accounts/staff/editform')
                                                     ->set('staff', $this->staff)
                                                     ->set('url', $this->request->uri())
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Processes the record manipulated in the shared form.
         * @param string $record The record to be processed.
         */
        public function action_process_form($record = '') {
            
            $flag = false; 
            
            $this->staff = ORM::factory('staff');
          
            $this->role = ORM::factory('staffrole');
            
            
            
            if($_POST['formstatus'] == Constants_FormAction::ADD) {

                $this->staff->where('username', '=', $_POST['username'])
                         ->find();
                                            
                if(! $this->staff->loaded()) {

                    $this->email = ORM::factory('staff')
                               ->where('primary_email', '=', $_POST['primary_email'])
                               ->or_where('secondary_email', '=', $_POST['primary_email'])
                               ->or_where('primary_email', '=', $_POST['secondary_email'])
                               ->or_where('secondary_email', '=', $_POST['secondary_email'])
                               ->find();

                    if($this->email->loaded()) {
                        $this->json['failmessage'] = $this->config['err']['account']['email'];
                    }
                    else {
                        $flag = true;

                        $this->json['action'] = Constants_FormAction::ADD;
                    }
                }
                else {
                    $this->json['failmessage'] = $this->config['err']['account']['username'];
                }
                //Log activity
                $this->_save_activity_stafflog( 'newstaff', $this->staff->username);
            }
            else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                // Email flags
                $primary = FALSE;
                $secondary = FALSE;
                
                $this->staff->where('staff_id', '=', Helper_Helper::decrypt($record))
                            ->find();
                
                if( $this->staff->loaded()) {
                    // Check if primary email POST data is the same in database
                    if($this->staff->primary_email == $_POST['primary_email'])
                            $primary = TRUE;
                    
                    // Check if secoondary email POST data is the same in database
                    if($this->staff->secondary_email == $_POST['secondary_email'])
                            $secondary = TRUE;
                    
                    // If one or both are not the same
                    if(! $primary || ! $secondary) {
                        // Check if primary and secondary email address is just switched places
                        $switchflag = FALSE;
                        
                        if($this->staff->secondary_email == $_POST['primary_email']) {
                            if($this->staff->primary_email == $_POST['secondary_email'])
                                    $switchflag = TRUE;
                        }
                        if($this->staff->primary_email == $_POST['secondary_email']) {
                            if($this->staff->secondary_email == $_POST['primary_email'])
                                    $switchflag = TRUE;
                        }
                        
                        // No switching happened
                        if(! $switchflag) {
                            $this->email = ORM::factory('staff')
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
                $this->_save_activity_stafflog( 'editstaff', $this->staff->username); 
            }
           
            if($flag) {
                    if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                      $this->staff->values($_POST); 
                      //$this->staff->save();
                    }
                    else if ($_POST['formstatus'] == Constants_FormAction::ADD) {
                        $this->staff->values($_POST);

                        $this->staff->password = sha1($_POST['password']);
                        //$this->staff->save();
                    }
                    
                        if($_POST['formstatus'] == Constants_FormAction::EDIT) {

                           $querydelete = 'DELETE FROM staff_role_tb
                                                WHERE staff_id =' .  Helper_Helper::decrypt($record);

                            $staffrole = DB::query(Database::DELETE, $querydelete)->execute();

                        }   
                            
                            $role_flag = FALSE;
                        
                            foreach($_POST['role'] as $staffrole){
                                
                                $this->rolecount = DB::select('staff_tb.*', 'staff_role_tb.*', 'role_tb.*', array(DB::expr('COUNT(role_tb.name)'), 'role_count'))
                                                    ->from('staff_tb')
                                                    ->join('staff_role_tb')
                                                    ->on('staff_tb.staff_id', '=', 'staff_role_tb.staff_id')
                                                    ->join('role_tb')
                                                    ->on('staff_role_tb.role_id', '=', 'role_tb.role_id')
                                                    ->group_by('role_tb.name')
                                                    ->where('staff_tb.status', '=', '1')
                                                    ->and_where('staff_role_tb.role_id', '=', $staffrole)
                                                    ->as_object()
                                                    ->execute();
                                
                                $seed = ORM::factory('rolelimit')
                                            ->where('role_id', '=', $staffrole)
                                                        ->find();
                                
                                
                                if($this->rolecount->get('role_count') < $seed->limit) {
                                     $this->staff->save();
                                    
                                     $this->role = ORM::factory('staffrole');
                                     $this->role->role_id = $staffrole;
                                     $this->role->staff_id = $this->staff->staff_id;
                                     
                                     $this->role->save();
                                     
                                     $role_flag = TRUE;
                                }
            
                            }
                            
                            if($role_flag) {
                                $this->json['success'] = true;
                            }
                            else {
                                $this->json['success'] = false;
                                $this->json['failmessage'] = $this->config['err']['account']['role'];
                            }

                }
                //may mga error na nadetect
                else {
                    $this->json['success'] = false;
                }
            

            $this->_json_encode();
        }
        
        /**
         * Deletes records from the DB.
         */
        public function action_delete() {
            foreach( $_POST['id'] as $id ) {
                
                $this->staff = ORM::factory('staff')
                            ->where('staff_id', '=', Helper_Helper::decrypt($id))
                            ->find();
  
                if( $this->staff->loaded() ) {
                    //Log activity
                    $this->_save_activity_stafflog( 'deletestaff', $this->staff->username);
                    $this->staff->delete();
                }
            }

            $this->json['success'] = true;
            $this->_json_encode();
        }
        
        /**
         * Enables records from the DB.
         */
        public function action_enable() {
            $role_flag = FALSE;
            foreach( $_POST['id'] as $id ) {
                $this->staff = ORM::factory('staff')
                            ->where('staff_id', '=', Helper_Helper::decrypt($id))
                            ->find();
                
                $this->staffrole = ORM::factory('staffrole')
                            ->where('staff_id', '=', $this->staff->staff_id)
                            ->find();
                
                $this->rolecount = DB::select('staff_tb.*', 'staff_role_tb.*', 'role_tb.*', array(DB::expr('COUNT(role_tb.name)'), 'role_count'))
                                    ->from('staff_tb')
                                    ->join('staff_role_tb')
                                    ->on('staff_tb.staff_id', '=', 'staff_role_tb.staff_id')
                                    ->join('role_tb')
                                    ->on('staff_role_tb.role_id', '=', 'role_tb.role_id')
                                    ->group_by('role_tb.name')
                                    ->where('staff_tb.status', '=', '1')
                                    ->and_where('staff_role_tb.role_id', '=', $this->staffrole->role_id)
                                    ->as_object()
                                    ->execute();

                $seed = ORM::factory('rolelimit')
                                    ->where('role_id', '=', $this->staffrole->role_id)
                                    ->find();
                
                                        
                    if($this->rolecount->get('role_count') < $seed->limit) {
                        //Log activity
                        $this->_save_activity_stafflog( 'enablestaff', $this->staff->username);
                        $this->staff->status = 1;
                        $this->staff->save();
                        $role_flag = TRUE;
                    }
                    else{
                        $this->json['failmessage'] = $this->config['err']['account']['roleactivatefail'];
                    }
 

            }
            if($role_flag) {
                $this->json['success'] = true;
                $this->json['action'] = Constants_FormAction::ACTIVATED;
            }
            else {
                $this->json['success'] = false;
                $this->json['action'] = Constants_FormAction::NOT_ACTIVATED;
            }
            //$this->json['success'] = true;
            $this->_json_encode();
        }
        
        /**
         * Disables records from the DB.
         */
        public function action_disable() {
            foreach( $_POST['id'] as $id ) {
                $this->staff = ORM::factory('staff')
                            ->where('staff_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $this->staff->loaded() ) {
                    //Log activity
                    $this->_save_activity_stafflog( 'disablestaff', $this->staff->username);
                    $this->staff->status = 0;
                    $this->staff->save();
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
            $this->pageSelectionDesc = $this->config['msg']['actions']['search'] . $this->config['msg']['page']['acctmgmt']['staff'];
            
            $this->template->body->bodyContents = View::factory('cms/accounts/staff/grid');
            
            // Gotta be immune from SQL injection attacks. :)
            $this->staff = ORM::factory('staff')
                                      ->where(DB::expr("MATCH(first_name,last_name)"), 'AGAINST', DB::expr("('+$record* +$record*' IN BOOLEAN MODE)"));
            
            // Paginate the result set
            $this->action_limit($limit, $this->staff);
            
            // Set offset and item per page from the pagination object
            $this->staff->order_by( 'staff_id', 'ASC' )
                             ->limit( $this->pagination->items_per_page )
                             ->offset( $this->pagination->offset );
            
            $this->template->body->bodyContents->set('staffs', $this->staff->find_all());
             
        }
        
        
        /**
         * Shows change password page  
         * @param string $record The record to be edited
         */
        public function action_changepassword($record = '') {
            
            //iisang view ang gagamitin ng mga change passwords
            //di ko tiningnann ang view, pero iredo mo yung mga vars sa view para 'record' lang ang tingnan nung viwe
            $this->pageSelectionDesc = $this->config['msg']['actions']['changepw'];
            $this->template->body->bodyContents = View::factory('cms/accounts/changepassword/staff-form')
                                                         ->bind('staff', $this->staff)
                                                         ->set('staff_id', $record);
            
            //alamin kung anong record ang icchange password
            $this->staff = ORM::factory('staff')
                                     ->where('staff_id', '=', Helper_Helper::decrypt($record))
                                     ->find();
            
        }
        
        /**
         * Processes the execution of change password of account
         * @param string $record The record to be processed
         */
        public function action_processchangepw($record = '') {
                $this->json['action'] = Constants_FormAction::EDIT;
                
                $old_password = $_POST['old_password'];
                $flag = false;

                $users = ORM::factory('staff')
                        ->where('staff_id', '=', Helper_Helper::decrypt($record))
                        ->find();

                $flag = true;

                if( $users->loaded() ) {
                        if( $users->password == sha1($old_password) ) {
                            $users->password = sha1($_POST['password']);
                            $users->save();

                            $this->json['success'] = TRUE;
                            //Log activity
                            $this->_save_activity_stafflog( 'changepw', $users->staff->username);
                        } else {
                            $this->json['success'] = FALSE;
                            $this->json['failmessage'] = $this->config['err']['account']['password'];
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
            $this->staff = ORM::factory('staff')
                            ->where('staff_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['viewstaff'] . $this->staff->full_name();
            $this->formstatus = Constants_FormAction::VIEW;
            
            //..tapos iloload sa variable na visible sa view, $customer
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/reports/accounts/staff/viewreport')
                                                     ->set('staff', $this->staff)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        public function action_generatepdf($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            
            $this->staff = ORM::factory('staff')
                            ->where('staff_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();  
            $filename = date("Y-m-d") . "-" . $this->staff->full_name() . "'s Information";
            $html = View::factory('cms/reports/accounts/staff/pdf-report')
                           ->set('staff', $this->staff);      
            $html->render();

            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");  
            $dompdf->render();
            $dompdf->stream($filename .".pdf", array('Attachment' => 1));
        }
        
        public function action_generatepdflist() {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->staff = ORM::factory('staff')
                            ->find_all();  
            $filename = date("Y-m-d") . "-" . "List of Staff Information";
            $html = View::factory('cms/reports/accounts/staff/grid-pdf-report')
                           ->set('staff', $this->staff);      
            
            $html->render();
            //Log activity
            $this->_save_activity_stafflog( 'saveliststaff', $this->session->get('username'));
            
            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");
            $dompdf->render();
            $dompdf->stream($filename . ".pdf", array('Attachment' => 1));

        }
    }