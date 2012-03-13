<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Public side authentication of OneRaimol.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2012 DCDGLP
 */
    class Controller_Auth extends Controller_Store {
        
        /**
         * @var ORM user Holds user information from DB for login authentication.
         * @access private
         */
        protected $user;
        
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->template->title = 'Raimol&trade; Store';
            
            $this->template->bodyContents=View::factory('store/login');
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         */
        public function action_index() {
            // Prevents page access if session is active
            if($this->session->get('userid')) {
                Request::current()->redirect(
                    URL::site( 'store' , $this->_protocol )
                );
            }
        }
        
        /**
         * Processes the authentication.
         * Checks the login information entered in the form to the DB.
         */
        public function action_process_login() {
            
            if(isset($_GET['source'])) {
                $source = Helper_Helper::decrypt($_GET['source']);
                $this->json['redirect'] = TRUE;
                $this->json['url'] = $source;
            }
            
            $this->user = ORM::factory('customer')
                        ->where('username', '=', $_POST['username'])
                        ->and_where('password', '=', sha1($_POST['password']))
                        ->find();
            
            if($this->user->loaded()) {
                
                if($this->user->status == 1) {
                    // Set user to session
                    $this->session->set('userid', Helper_Helper::encrypt($this->user->customer_id));
                    $this->session->set('username', $this->user->username);

                    $this->json['success'] = true;
                }
                else {
                    $this->json['success'] = FALSE;
                    $this->json['failmessage'] = $this->config['err']['login']['unverified'] . ' '. HTML::anchor($this->_base_url . 'auth/resend/' . Helper_Helper::encrypt($this->user->pk()) . '?e=' . Helper_Helper::encrypt($this->user->primary_email), 'Or click here to resend verification.');
                }
                
            }
            else {
                $this->json['success'] = false;
                $this->json['failmessage'] = $this->config['err']['login']['fail'];
            }
            
            $this->_json_encode();
        }
        
        /**
         * Resends the confirmation email to the registered user.
         * @param string $record The account to be checked
         */
        public function action_resend($record = '') {
            if($record != '') {
                if(!$this->session->get('userid')) {

                    $this->user = ORM::factory('customer')
                                         ->where('customer_id', '=', Helper_Helper::decrypt($record))
                                         ->find();
                    
                    if($this->user->loaded()) {
                        if($this->request->query('e')) {
                            
                            if(Helper_Helper::decrypt($this->request->query('e')) == $this->user->primary_email) {
                                $registration = array(
                                  'name'        => $this->user->full_name(),
                                  'confirmation'    => $this->user->confirmation_code
                                );

                                $body = View::factory('email/parent');

                                $body->mail_content = View::factory('email/account/resendregistration')
                                                ->bind('registration', $registration);

                                $mailer = Swift_Mailer::newInstance(Swift_MailTransport::newInstance());

                                $message = Swift_Message::newInstance()
                                            ->setSubject($this->config['msg']['email']['resend'])
                                            ->setFrom(array('administrator@raimol.com' => 'RAIMOL Energized Lubricants'))
                                            ->setTo(array($this->user->primary_email => $this->user->full_name()))
                                            ->setBody($body, 'text/html');

                                $mailer->send($message);
                                
                                Request::current()->redirect(
                                    URL::site( 'auth/resendsuccess?e=' . Helper_Helper::encrypt($this->user->pk()) , $this->_protocol )
                                );
                            }
                            else {
                                throw new HTTP_Exception_404('Invalid email');
                            }
                            
                        }
                        else {
                            throw new HTTP_Exception_404('Get variable e not present');
                        }
                    }
                    else {
                        throw new HTTP_Exception_404('User not found');
                    }
                    
                }
                else {
                    throw new HTTP_Exception_404('User logged in');
                }
            }
            else {
                throw new HTTP_Exception_404('No argument specified');
            }
        }
        
        /**
         * Shows the resend success page if resend is successful.
         */
        public function action_resendsuccess() {
            
            if($this->request->query('e')) {
                
                $a = ORM::factory('customer')
                            ->where('customer_id', '=', Helper_Helper::decrypt($this->request->query('e')))
                            ->and_where('status', '=', 0)
                            ->and_where('confirmation_code' , '=', '')
                            ->find();
                
                if($a->loaded()) {
                    $this->template->title = 'Resend Success | Raimol&trade; Energized Lubricants Purchase Order Site';

                    $this->template->bodyContents = View::factory('store/accounts/registration/resend');
                }
                else {
                    $this->_expire_page();
                }
                
            }
            else {
                $this->_expire_page();
            }
        }
        
        /**
         * Shows the forgot password page.
         */
        public function action_forgotpass() {
            if(!$this->session->get('userid')) {
                $this->template->title = 'Forgot Password | Raimol&trade; Energized Lubricants Purchase Order Site';
                $this->template->bodyContents = View::factory('store/accounts/forgotpassword/index');
            }
            else {
                $this->_expire_page();
            }

        }
        
        /**
         * Processes the forgot password form
         */
        public function action_process_preparereset() {
            if(isset($_POST['email'])) {
                
                $this->user = ORM::factory('customer')
                                    ->where('primary_email', '=', $_POST['email'])
                                    ->find();
                
                if($this->user->loaded()) {
                    if($this->user->status == 1) {
                        $this->user->confirmation_code = Helper_Helper::encrypt(time()) . Helper_Helper::encrypt($this->user->username);

                        $this->user->save();

                        $reset = array(
                          'name'        => $this->user->full_name(),
                          'confirmation'    => $this->user->confirmation_code
                        );

                        $body = View::factory('email/parent');

                        $body->mail_content = View::factory('email/account/passwordreset')
                                        ->bind('reset', $reset);

                        $mailer = Swift_Mailer::newInstance(Swift_MailTransport::newInstance());

                        $message = Swift_Message::newInstance()
                                    ->setSubject($this->config['msg']['email']['reset'])
                                    ->setFrom(array('administrator@raimol.com' => 'RAIMOL Energized Lubricants'))
                                    ->setTo(array($this->user->primary_email => $this->user->full_name()))
                                    ->setBody($body, 'text/html');

                        $mailer->send($message);

                        $this->json['successmessage'] = $this->config['msg']['account']['forgotpassword'];
                        $this->json['success'] = TRUE;
                    }
                    else {
                        $this->json['failmessage'] = $this->config['err']['account']['cantrequestreset'] . ' '. HTML::anchor($this->_base_url . 'auth/resend/' . Helper_Helper::encrypt($this->user->pk()) . '?e=' . Helper_Helper::encrypt($this->user->primary_email), 'Click here to resend verification.');
                        $this->json['success'] = FALSE;
                    }
                    
                }
                else {
                    $this->json['failmessage'] = $this->config['err']['account']['noacctfound'];
                    $this->json['success'] = FALSE;
                }
                
                $this->_json_encode();
                
            }
            else {
                throw new HTTP_Exception_404('No email in post variable');
            }
        }
        
        /**
         * Shows the reset password form
         * @param string $record The account to be password reset
         */
        public function action_resetpassword($record = '') {
            
            if($record != '') {
                
                $this->user = ORM::factory('customer')
                                    ->where('confirmation_code', '=', $record)
                                    ->find();
                
                if($this->user->loaded()) {
                    
                    $this->template->title = 'Reset Password | Raimol&trade; Energized Lubricants Purchase Order Site';
                    $this->template->bodyContents = View::factory('store/accounts/changepassword/reset')
                                                             ->set('token', $record);
                    
                }
                else {
                    $this->_expire_page();
                }
                
            }
            else {
                throw new HTTP_Exception_404('No record on parameter');
            }
            
        }
        
        public function action_process_resetpassword($record) {
            
            if(isset($_POST['password'])) {
                
                $this->user = ORM::factory('customer')
                                     ->where('confirmation_code', '=', $record)
                                     ->find();
                
                if($this->user->loaded()) {
                    
                    $this->user->password = sha1($_POST['password']);
                    $this->user->confirmation_code = '';
                    
                    $this->user->save();
                    
                    $reset = array(
                      'name'        => $this->user->full_name(),
                      'username'    => $this->user->username
                    );

                    $body = View::factory('email/parent');

                    $body->mail_content = View::factory('email/account/passwordresetsuccess')
                                    ->bind('reset', $reset);

                    $mailer = Swift_Mailer::newInstance(Swift_MailTransport::newInstance());

                    $message = Swift_Message::newInstance()
                                ->setSubject($this->config['msg']['email']['reset'])
                                ->setFrom(array('administrator@raimol.com' => 'RAIMOL Energized Lubricants'))
                                ->setTo(array($this->user->primary_email => $this->user->full_name()))
                                ->setBody($body, 'text/html');

                    $mailer->send($message);
                    
                    if(!is_null($this->user->secondary_email) && $this->user->secondary_email != '') {
                        $mailer = Swift_Mailer::newInstance(Swift_MailTransport::newInstance());

                        $message = Swift_Message::newInstance()
                                    ->setSubject($this->config['msg']['email']['reset'])
                                    ->setFrom(array('administrator@raimol.com' => 'RAIMOL Energized Lubricants'))
                                    ->setTo(array($this->user->secondary_email => $this->user->full_name()))
                                    ->setBody($body, 'text/html');

                        $mailer->send($message); 
                    }
                    
                    $this->session->set('userid', Helper_Helper::encrypt($this->user->customer_id));
                    $this->session->set('username', $this->user->username);
                    
                    $this->json['success'] = TRUE;
                    $this->_json_encode();
                }
                else {
                    $this->_expire_page();
                }
                
            }
            else {
                throw new HTTP_Exception_404('No password on post variable');
            }
            
        }
        
    }