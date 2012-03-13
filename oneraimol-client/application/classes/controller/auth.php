<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Admin side authentication of OneRaimol.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Auth extends Controller_Template {
        
        /**
         * @var ORM user Holds user information from DB for login authentication.
         * @access private
         */
        private $user;
        
        /**
         * @var ORM accesslevel Holds the access levels list from the DB for access level verification
         * @access private
         */
        private $accesslevel;
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            // Parent page template
            $this->template = 'common/cmshome'; 
            // Required call by Kohana
            parent::before($ssl_required);
            
            // Page title
            $this->template->title = 'OneRaimol CMS Login';
                        
            // Sets inner view to be displayed inside the parent template
            $this->template->body = View::factory('cms/loginstaff');
            
            // Binds error messages from a message file
            $this->config['err']=Kohana::message('errors');
            
            // binds javascript messages to template for use in
            // AJAX message responses
            $this->template->formmessages = $this->_ajax_messages('formmessages');
            
            // Begins an instance of a $_SESSION
            $this->session = Session::instance();
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         */
        public function action_index() {
            // Prevents page access if session is active
            if( $this->session->get('userid') ) {
                Request::current()->redirect(
                    URL::site( 'cms' , $this->_protocol )
                );
            }
        }
        
        /**
         * Processes the authentication.
         * Checks the login information entered in the form to the DB.
         */
        public function action_login() {
            $this->user = ORM::factory('staff')
                        ->where('username', '=', $_POST['username'])
                        ->and_where('password', '=', sha1($_POST['password']))
                        ->find();
            
            if($this->user->loaded()) {
                // Set user to session
                $this->session->set('userid', $this->user->staff_id);
                $this->session->set('username', $this->user->username);
                
                $this->accesslevel = ORM::factory('staffrole')
                                            ->where('staff_id', '=', $this->user->staff_id)
                                            ->find_all();
                
                // If staff has multiple roles, get all the roles and
                // put it in an array then set it to session. Else,
                // set the single role to session.
                if($this->accesslevel->count() > 0) {
                    $array = array();
                    
                    foreach($this->accesslevel as $roles) {
                        array_push($array, $roles->role_id);
                    }
                    
                    // Set role to session
                    $this->session->set('roles', $array);
                }
                else {
                    $this->session->set('roles', '');
                }
                
                $this->json['success'] = true;
            }
            else {
                $this->json['success'] = false;
                $this->json['failmessage'] = $this->config['err']['login']['fail'];
            }
            
            $this->_json_encode();
        }
    }