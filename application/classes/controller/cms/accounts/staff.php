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
            $this->pageSelectionDesc = $this->config['msg']['page']['acctmgmt']['staff'];
            
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
        public function action_limit($limit) {   
            $this->pageSelectionDesc = $this->config['msg']['page']['acctmgmt']['staff'];
            
            $this->template->body->bodyContents = View::factory('cms/accounts/staff/grid')
                                                         ->bind('staffs', $this->staff);
            // Display all records
            if($limit == Constants_FormAction::ALL) {
                $this->_pagination('staff', 'limit');
            }
            // Display paginated limits
            else {
                $this->_pagination('staff', 'limit', $limit);
            }
                
            $this->staff = ORM::factory('staff')
                                    ->order_by( 'staff_id', 'ASC' )
                                    ->limit( $this->pagination->items_per_page )
                                    ->offset( $this->pagination->offset )
                                    ->find_all();
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
            
            $this->template->body->bodyContents = View::factory('cms/accounts/staff/form')
                                                     ->set('staff', $this->staff)
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
                               ->or_where('primary_email', '=', $_POST['secondary_email'])
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

            }
            else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                $this->staff->where('staff_id', '=', Helper_Helper::decrypt($record))
                            ->find();
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::EDIT;
            }
           
            if($flag) {
                $this->staff->values($_POST);

                $this->staff->password = sha1($_POST['password']);
                $this->staff->save();
               
                if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                    foreach($this->staff->roles->find_all() as $staffrole) {
                        $this->staff->remove('roles', $staffrole);
                    }
                }   
                foreach($_POST['role'] as $staffrole){                        
                     $this->role = ORM::factory('staffrole');
                     $this->role->role_id = $staffrole;
                     $this->role->staff_id = $this->staff->staff_id;
                     
                     $this->role->save();
                }
                
                $this->json['success'] = true;
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
            foreach( $_POST['id'] as $id ) {
                $this->staff = ORM::factory('staff')
                            ->where('staff_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $this->staff->loaded() ) {
                    $this->staff->status = 1;
                    $this->staff->save();
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
                $this->staff = ORM::factory('staff')
                            ->where('staff_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $this->staff->loaded() ) {
                    $this->staff->status = 0;
                    $this->staff->save();
                }
            }

            $this->json['success'] = true;
            $this->_json_encode();
        }
         
    }