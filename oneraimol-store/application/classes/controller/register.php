<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Public controller for OneRaimol.
 * This will be accessible to all, (eg. Client) without the need
 * of knowing specific access URL or system usage right/access level.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Register extends Controller_Store {
        
        /**
         * Holds customer data from the database
         * @var ORM 
         */
        private $customer;
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->template->title = 'Register | Raimol&trade; Energized Lubricants Purchase Order';
            
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
            else {
                $this->template->bodyContents=View::factory('store/accounts/registration/form')
                                                  ->set('formStatus', Constants_FormAction::ADD);
            }
        }
        
        /**
         * Processes the register form of the register page
         */
        public function action_process_form() {
           
            $flag = false;
            
            $this->customer = ORM::factory('customer');
            
            if($_POST['formstatus'] == Constants_FormAction::ADD) {
                //kelangang itest kung used na yung username
                //kasi diba hindi pwedeng magpareho ang username
                $this->customer->where('username', '=', $_POST['username'])
                         ->find();
                if(! $this->customer->loaded()) {
                    //check rin for duplicate emails
                    $this->email = ORM::factory('customer')
                               ->where('username', 'is not', null)
                               ->and_where('primary_email', 'is not', null)
                               ->and_where('secondary_email', 'is not', null)
                               ->and_where('primary_email', '!=', '')
                               ->and_where('secondary_email', '!=', '')
                               ->and_where_open()
                               ->where('primary_email', '=', $_POST['primary_email'])
                               ->or_where('secondary_email', '=', $_POST['primary_email'])
                               ->or_where('primary_email', '=', $_POST['secondary_email'])
                               ->or_where('secondary_email', '=', $_POST['secondary_email'])
                               ->and_where_close()
                               ->find();
                    //kung may nakitang record na me ganung email, fail
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

            if($flag) {
                  $this->customer->values($_POST);
                  $this->customer->password = sha1($_POST['password']);
                  $this->customer->status = 0;
                  $this->customer->confirmation_code = Helper_Helper::encrypt(time()) . Helper_Helper::encrypt($_POST['username']);
                  if($_POST['primary_email'] == '') $this->customer->primary_email = NULL;
                  if($_POST['secondary_email'] == '') $this->customer->secondary_email = NULL;
                  
                  if($this->customer->save()) {
                      
                        $registration = array(
                          'name'        => $this->customer->full_name(),
                          'confirmation'     => $this->customer->confirmation_code
                        );

                        $body = View::factory('email/parent');

                        $body->mail_content = View::factory('email/account/resendregistration')
                                        ->bind('registration', $registration);

                        $mailer = Swift_Mailer::newInstance(Swift_MailTransport::newInstance());

                        $message = Swift_Message::newInstance()
                                    ->setSubject($this->config['msg']['email']['register'])
                                    ->setFrom(array('administrator@raimol.com' => 'RAIMOL Energized Lubricants'))
                                    ->setTo(array($_POST['primary_email'] => $this->customer->full_name()))
                                    ->setBody($body, 'text/html');

                        $mailer->send($message);
                        
                        $this->json['success'] = TRUE;
                        $this->json['token'] = Helper_Helper::encrypt($this->customer->username);
                      
                  }
                  else {
                      $this->json['success'] = FALSE;
                      $this->json['failmessage'] = $this->config['err']['register']['fail'];
                  }
            }

            $this->_json_encode();
        }
        
        public function action_verifymsg() {
            
            if(! $this->session->get('userid')) {
                if($this->request->query('token')) {

                    $this->customer = ORM::factory('customer')
                                            ->where('username', '=', Helper_Helper::decrypt($this->request->query('token')))
                                            ->and_where('status', '=', 0)
                                            ->find();

                    if($this->customer->loaded()) {
                        $this->template->title = 'Registration Verification | Raimol&trade; Energized Lubricants Purchase Order Site';
                        
                        $this->template->bodyContents=View::factory('store/accounts/registration/verify');
                    }
                    else {
                        Request::current()->redirect(
                            URL::site( 'expire?from='. Helper_Helper::encrypt($this->request->detect_uri()) , $this->_protocol )
                        );
                    }

                }
                else {
                    $this->_expire_page();
                } 
            }
            else {
                $this->_expire_page();
            }
            
        }
        
        public function action_success() {
            
            if(! $this->session->get('userid')) {
                if($this->request->query('token')) {

                    $this->customer = ORM::factory('customer')
                                            ->where('customer_id', '=', Helper_Helper::decrypt($this->request->query('token')))
                                            ->and_where('confirmation_code' , '=', '')
                                            ->and_where('status', '=', 1)
                                            ->find();

                    if($this->customer->loaded()) {
                        $this->template->title = 'Registration Success | Raimol&trade; Energized Lubricants Purchase Order Site';
                        
                        $this->template->bodyContents=View::factory('store/accounts/registration/success');
                    }
                    else {
                        $this->_expire_page();
                    }

                }
                else {
                    $this->_expire_page();
                } 
            }
            else {
                $this->_expire_page();
            }
        }
        
        public function action_verify($record = '') {
            
            if($record != '') {
                
                $this->customer = ORM::factory('customer')
                                       ->where('confirmation_code', '=', $record)
                                       ->and_where('status', '=', 0)
                                       ->find();
                
                if($this->customer->loaded()) {
                    $this->customer->status = 1;
                    $this->customer->confirmation_code = '';
                    
                    $this->customer->save();
                    
                    $registration = array(
                      'name'        => $this->customer->full_name(),
                      'username'    => $this->customer->username
                    );

                    $body = View::factory('email/parent');

                    $body->mail_content = View::factory('email/account/register')
                                    ->bind('registration', $registration);

                    $mailer = Swift_Mailer::newInstance(Swift_MailTransport::newInstance());

                    $message = Swift_Message::newInstance()
                                ->setSubject($this->config['msg']['email']['register'])
                                ->setFrom(array('administrator@raimol.com' => 'RAIMOL Energized Lubricants'))
                                ->setTo(array($this->customer->primary_email => $this->customer->full_name()))
                                ->setBody($body, 'text/html');

                    $mailer->send($message);
                    
                    if($this->customer->secondary_email != '' && !is_null($this->customer->secondary_email)) {

                        $mailer = Swift_Mailer::newInstance(Swift_MailTransport::newInstance());

                        $message = Swift_Message::newInstance()
                                    ->setSubject($this->config['msg']['email']['register'])
                                    ->setFrom(array('administrator@raimol.com' => 'RAIMOL Energized Lubricants'))
                                    ->setTo(array($this->customer->secondary_email => $this->customer->full_name()))
                                    ->setBody($body, 'text/html');

                        $mailer->send($message);
                    }
                    
                    Request::current()->redirect(
                        URL::site( 'register/success?token='. Helper_Helper::encrypt($this->customer->pk()) , $this->_protocol )
                    );
                    
                }
                else {
                    throw new HTTP_Exception_404('Record not loaded');
                }
                
                
            }
            else {
                throw new HTTP_Exception_404('No param');
            }
            
        }
        
    }