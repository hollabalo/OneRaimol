<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Index controller for Profile module.
 * 
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Profile_Staff extends Controller_Cms_Profile {
        
        /**
         * @var ORM rolelimit Holds the rolelimit record from the DB.
         * @access private
         */
        private $rolelimit;
       
        /**
         * @var int initialpagelimit Holds the default page limit from the system setting
         */
        private $initialpagelimit;
        
        /**
         * @var string formstatus Defines how the shared form will handle the request
         * @access private
         */
        private $formstatus;
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
        }
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_edit() {
            
            $this->staff = ORM::factory('staff')
                            ->where('staff_id' ,'=', $this->session->get('userid'))
                            ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['editstaff'] . " of " . $this->staff->full_name();
            $this->formstatus = Constants_FormAction::EDIT;
            
            $this->template->body->bodyContents = View::factory('cms/profile/editform')
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
                $this->_save_activity_stafflog( 'newstaff', $this->session->get('username'));
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
                $this->_save_activity_stafflog( 'editstaff', $this->session->get('username')); 
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
         * Shows change password page  
         * @param string $record The record to be edited
         */
        public function action_changepassword() {
            
            //iisang view ang gagamitin ng mga change passwords
            //di ko tiningnann ang view, pero iredo mo yung mga vars sa view para 'record' lang ang tingnan nung viwe
            $this->pageSelectionDesc = $this->config['msg']['actions']['changepw'];
            $this->template->body->bodyContents = View::factory('cms/profile/changepassword/staff-form')
                                                         ->bind('staff', $this->staff);
                                                         //->set('staff_id', $this->session->get('userid'));
            
            //alamin kung anong record ang icchange password
            $this->staff = ORM::factory('staff')
                                     ->where('staff_id', '=', $this->session->get('userid'))
                                     ->find();
            
        }
        /**
         * Processes the execution of change password of account
         * @param string $record The record to be processed
         */
        public function action_processchangepw() {
                $this->json['action'] = Constants_FormAction::EDIT;
                
                $old_password = $_POST['old_password'];
                $flag = false;

                $users = ORM::factory('staff')
                        ->where('staff_id', '=', $this->session->get('userid'))
                        ->find();

                $flag = true;

                if( $users->loaded() ) {
                        if( $users->password == sha1($old_password) ) {
                            $users->password = sha1($_POST['password']);
                            $users->save();

                            $this->json['success'] = TRUE;
                            //Log activity
                            $this->_save_activity_stafflog( 'changepw', $this->session->get('username'));
                        } else {
                            $this->json['success'] = FALSE;
                            $this->json['failmessage'] = $this->config['err']['account']['password'];
                        }
                }
                $this->_json_encode();
        } 
        
        /**
         * Generates PDF
         * @param string $record The record to be generated
         */
        public function action_generatepdf($record = '') {
            require Kohana::find_file('vendor/dompdf', 'dompdf/dompdf_config.inc');
            
            $this->staff = ORM::factory('staff')
                            ->where('staff_id' ,'=', $this->session->get('userid'))
                            ->find();  
            $filename = $this->staff->full_name() . "--" . date("Y-m-d");
            $html = View::factory('cms/profile/staff-pdf-report')
                           ->set('staff', $this->staff);      
            
            $html->render();

            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");  
            $dompdf->render();
            $dompdf->stream($filename . ".pdf", array('Attachment' => 1));
        }
    }