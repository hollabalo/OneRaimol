<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Auth extends Controller_Template {
        public function before($ssl_required = FALSE) {
            $this->template = 'common/cmshome';  
            parent::before($ssl_required);
            
            $this->template->title = 'OneRaimol CMS Login';
                        
            $this->template->body = View::factory('cms/loginstaff');
            
            $this->config['err']=Kohana::message('errors');
            
            $this->template->formmessages = $this->_ajax_messages('formmessages');
            
            $this->session = Session::instance();
        }
        
        public function action_index() {
            if( $this->session->get('userid') ) {
                Request::current()->redirect(
                    URL::site( 'cms' , $this->_protocol )
                );
            }
        }
        
        public function action_login() {
            $user = ORM::factory('staff')
                        ->where('username', '=', $_POST['username'])
                        ->and_where('password', '=', sha1($_POST['password']))
                        ->find();
            
            if($user->loaded()) {
                $this->session->set('userid', $user->staff_id);
           
                $this->json['success'] = true;
            }
            else {
                $this->json['success'] = false;
                $this->json['failmessage'] = $this->config['err']['login']['fail'];
            }
            
            $this->_json_encode();
        }
    }