<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Account info controller for Account module.
 * 
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @author     Laban, John Emmanuel B.
 * @author     Panganiban, John Emmanuel B.
 * @copyright  (c) 2012 DCDGLP
 */
    class Controller_Account_Info extends Controller_Account {
       
        /**
         * Also holds the customer record from the database.
         * (Confusion haha)
         * @var ORM 
         */
        private $customer;
        
        /**
         * Email duplicates holder
         * @var ORM
         */
        private $email;
        
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
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * @param string $record The record to be searched
         */
        public function action_index($record = NULL) {
            $this->user = ORM::factory('customer')
                                  ->where('customer_id', '=', Helper_Helper::decrypt($this->session->get('userid')))
                                  ->find();
            
            $this->template->bodyContents = View::factory('store/accounts/customer/form')
                                                   ->set('formStatus', Constants_FormAction::EDIT)
                                                   ->set('customer', $this->user);

            if($this->request->query('success') == 'true') $this->template->bodyContents->set('success', TRUE);
        }
        
        /**
         * Processes the form for add or edit.
         */
        public function action_process_form() {
            
            $flag = false; //gagamitan ng flag para hindi magulo
            
            $this->customer = ORM::factory('customer');
            
            if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                // Email flags
                $primary = FALSE;
                $secondary = FALSE;
                
                $this->customer->where('customer_id', '=', Helper_Helper::decrypt($this->session->get('userid')))
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
                                               ->and_where_open()
                                               ->where('primary_email', '=', $_POST['secondary_email'])
                                               ->or_where('secondary_email', '=', $_POST['secondary_email'])
                                               ->and_where_close()
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
                
            }
           
            //kung walang error
            if($flag) {

                $this->customer->values($_POST);
                if($_POST['primary_email'] == '') $this->customer->primary_email = NULL;
                if($_POST['secondary_email'] == '') $this->customer->secondary_email = NULL;
                $this->customer->save();
                
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
         * 
         */
        public function action_changepassword() {
            $this->template->bodyContents = View::factory('store/accounts/changepassword/customer-form')
                                                         ->bind('customer', $this->customer)
                                                         ->set('customer_id', $this->session->get('userid'));
            
            if($this->request->query('success') == 'true') $this->template->bodyContents->set('success', TRUE);
            
            $this->customer = ORM::factory('customer')
                                     ->where('customer_id', '=', Helper_Helper::decrypt($this->session->get('userid')))
                                     ->find();
        }
        
        /**
         * 
         */
        public function action_process_changepassword() {
                $this->json['action'] = Constants_FormAction::EDIT;
                
                $old_password = $_POST['old_password'];
                $flag = false;

                $this->customer = ORM::factory('customer')
                        ->where('customer_id', '=', Helper_Helper::decrypt($this->session->get('userid')))
                        ->find();

                $flag = true;

                if( $this->customer->loaded() ) {
                        if( $this->customer->password == sha1($old_password) ) {
                            $this->customer->password = sha1($_POST['password']);
                            
                            if($this->customer->save()) {
                                
                                $changepass = array(
                                  'name'        => $this->customer->full_name(),
                                  'username'    => $this->customer->username,
                                  'password'    => $_POST['password']
                                );

                                $body = View::factory('email/parent');

                                $body->mail_content = View::factory('email/account/changepassword')
                                                ->bind('changepass', $changepass);


                                $mailer = Swift_Mailer::newInstance(Swift_MailTransport::newInstance());

                                $message = Swift_Message::newInstance()
                                            ->setSubject($this->config['msg']['email']['changepassword'])
                                            ->setFrom(array('administrator@raimol.com' => 'RAIMOL Energized Lubricants'))
                                            ->setTo(array($this->customer->primary_email => $this->customer->full_name()))
                                            ->setBody($body, 'text/html');

                                $mailer->send($message);
                                
                                if(!is_null($this->customer->secondary_email) && ($this->customer->secondary_email != '')) {
                                    $mailer = Swift_Mailer::newInstance(Swift_MailTransport::newInstance());

                                    $message = Swift_Message::newInstance()
                                                ->setSubject($this->config['msg']['email']['changepassword'])
                                                ->setFrom(array('administrator@raimol.com' => 'RAIMOL Energized Lubricants'))
                                                ->setTo(array($this->customer->secondary_email => $this->customer->full_name()))
                                                ->setBody($body, 'text/html');

                                    $mailer->send($message);
                                }
                                
                                $this->json['success'] = TRUE;
                            }
                            else {
                                $this->json['success'] = FALSE;
                                $this->json['failmessage'] = $this->config['err']['account']['passwordchangefail'];
                            }
                            
                        } else {
                            $this->json['success'] = FALSE;
                            $this->json['failmessage'] = $this->config['err']['account']['password'];
                        }
                }
                
                $this->_json_encode();
        }
        
    }