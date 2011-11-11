<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Customer functionality of
 * Accounts module.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
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
            
            // Pagination limit
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            
            $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
                      
            // kailangang may notification sa grid index kung successful ba yung operation
            // ng add, edit, o delete
            // lalabas yung confirmation box dun sa successful action ng user
            // try mong magadd, edit, yung delete wala pa
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
            $this->pageSelectionDesc = $this->config['msg']['page']['acctmgmt']['customer'];
            
            $this->template->body->bodyContents = View::factory('cms/accounts/customer/grid')   //set yung html page
                                                       ->bind('customers', $this->customer);     // var to iterate yung customer records  
            
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
        
        /**
         * Shows the add form.
         */
        public function action_add() {
            $this->pageSelectionDesc = $this->config['msg']['actions']['newcustomer'];
            $this->formstatus = Constants_FormAction::ADD;
            //since iisang form lang ang ginagamit sa add at edit, kelangan lang
            //bigyan ng state yung form kung add o edit ba sya,
            //kaya yun ang trabaho ng formStatus
            $this->template->body->bodyContents = View::factory('cms/accounts/customer/form')
                                                        ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Shows the edit form.
         * @param string $record The record to be edited.
         */
        public function action_edit($record = '') {
            
            //hahanapin yung record tapos...
            $this->customer = ORM::factory('customer')
                            ->where('customer_id' ,'=', Helper_Helper::decrypt($record))
                            ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['editcustomer'];
            $this->formstatus = Constants_FormAction::EDIT;
            
            //..tapos iloload sa variable na visible sa view, $customer
            //may formStatus rin
            $this->template->body->bodyContents = View::factory('cms/accounts/customer/form')
                                                     ->set('customer', $this->customer)
                                                     ->set('formStatus', $this->formstatus);
        }
        
        /**
         * Processes the record manipulated in the shared form.
         * @param string $record The record to be processed.
         */
        public function action_process_form($record = '') {
            
            $flag = false; //gagamitan ng flag para hindi magulo
            
            $this->customer = ORM::factory('customer');
            
            //security na rin kaya specified yung condition since
            //kung may kumag na user na maalam sa mga ganto, pwede nyang palitan ang value
            //ng formstatus na hidden field dun sa form
            if($_POST['formstatus'] == Constants_FormAction::ADD) {
                //kelangang itest kung used na yung username
                //kasi diba hindi pwedeng magpareho ang username
                $this->customer->where('username', '=', $_POST['username'])
                         ->find();
                if(! $this->customer->loaded()) {
                    //check rin for duplicate emails
                    $this->email = ORM::factory('customer')
                               ->where('username', 'is not', null)
                               ->and_where('primary_email', '=', $_POST['primary_email'])
                               ->or_where('secondary_email', '=', $_POST['primary_email'])
                               ->or_where('primary_email', '=', $_POST['secondary_email'])
                               ->or_where('primary_email', '=', $_POST['secondary_email'])
                               ->find();
                    //kung may nakitang record na me ganung email, fail
                    if($this->email->loaded()) {
                        $this->json['failmessage'] = $this->config['err']['account']['email'];
                    }
                    else {
                        $flag = true;
                        //kelangang sabihin kung ano bang action ang ginagawa ng
                        //current form submission since iisang method lang rin
                        //ang ginagamit sa form submission, so kelangan nito para
                        //malaman ang current form action
                        $this->json['action'] = Constants_FormAction::ADD;
                    }
                    
                }
                else {
                    $this->json['failmessage'] = $this->config['err']['account']['username'];
                }
            }
            else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                $this->customer->where('customer_id', '=', Helper_Helper::decrypt($record))
                         ->find();
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::EDIT;
            }
           
            //kung walang error
            if($flag) {
                $this->customer->values($_POST);
                //kelangang imano-mano na sabihin at iset ang value ng password since
                //kelangan pang iencrypt yung password bago iistore sa db
                $this->customer->password = sha1($_POST['password']);
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
         * Deletes records from the DB.
         */
        public function action_delete() {
            foreach( $_POST['id'] as $id ) {
                $this->customer = ORM::factory('customer')
                            ->where('customer_id', '=', Helper_Helper::decrypt($id))
                            ->find();

                if( $this->customer->loaded() ) {
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
                    $this->customer->status = 0;
                    $this->customer->save();
                }
            }

            $this->json['success'] = true;
            $this->_json_encode();
        }
         
    }