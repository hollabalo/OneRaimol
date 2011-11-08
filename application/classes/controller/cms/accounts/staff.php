<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Cms_Accounts_Staff extends Controller_Cms_Accounts {
        //entity properties
        private $staff;
        private $role;
        private $email;
        
        
        //logic properties
        private $formstatus;
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = $this->config['msg']['leftselection']['staff'];
        }
        
        public function action_index($status ='') {
            $this->pageSelectionDesc = $this->config['msg']['page']['acctmgmt']['staff'];
            
            $staffs = ORM::factory('staff')
                          ->find_all();
            
            $this->template->body->bodyContents = View::factory('cms/accounts/staff/grid')
                                                       ->set('staffs', $staffs);
            
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
        
        public function action_add() {
            $this->pageSelectionDesc = $this->config['msg']['actions']['newstaff'];
            $this->formstatus = Constants_FormAction::ADD;

            $this->template->body->bodyContents = View::factory('cms/accounts/staff/form')
                                                        ->set('formStatus', $this->formstatus);
        }
        
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
//                    $roles = ORM::factory('staffrole')
//                                      ->where('staff_id', '=', $_POST['staff_id'])
//                                      ->and_where('role_id', '=', $staffrole)
//                                      ->find();
//                    if($roles->loaded()) {
//                            $roles->delete();
//                        }
                        
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