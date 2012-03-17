<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Address controller for Account module.
 * 
 * @category   Controller
 * @filesource classes/controller/account/addresses.php
 * @package    OneRaimol Store
 * @author     DCDGLP
 * @copyright  (c) 2012 DCDGLP
 */
    class Controller_Account_Addresses extends Controller_Account {
       
        /**
         * Holds the address record from the database
         * @var ORM 
         */
        private $address;
        
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
        public function action_index() {
            
            $this->template->title = 'Delivery Addresses | Raimol&trade; Energized Lubricants Purchase Order';
            
            $addresscount = ORM::factory('deliveryaddress')
                                     ->where('customer_id', '=', Helper_Helper::decrypt($this->session->get('userid')))
                                     ->find_all()
                                     ->count();
            
            // Paginate database result
            $this->pagination = Pagination::factory(array(
                                    'items_per_page' => 10,
                                    'view' => 'pagination/basic',
                                    'total_items' => $addresscount
                                ));
            
            $this->address = ORM::factory('deliveryaddress')
                              ->where('customer_id', '=', Helper_Helper::decrypt($this->session->get('userid')))
                              ->limit( $this->pagination->items_per_page )
                              ->offset( $this->pagination->offset )
                              ->order_by('delivery_address_id', 'DESC')
                              ->find_all();
            
            // Set page defaults
            $this->template->bodyContents = View::factory('store/accounts/address/grid')
                                                    ->set('addresses', $this->address)
                                                    ->set('pagination', $this->pagination);
            
            // Show appropriate page action
            if($this->request->query('action')) {
                if($this->request->query('action') == Constants_FormAction::ADD &&
                   $this->request->query('success') == 'true') {
                        $this->template->bodyContents->set('msg', Constants_FormAction::ADD);
                }
                else if($this->request->query('action') == Constants_FormAction::EDIT &&
                   $this->request->query('success') == 'true') {
                        $this->template->bodyContents->set('msg', Constants_FormAction::EDIT);
                }
                else if($this->request->query('action') == Constants_FormAction::DELETE &&
                   $this->request->query('success') == 'true') {
                        $this->template->bodyContents->set('msg', Constants_FormAction::DELETE);
                }
            }
        }
        
        /**
         * Displays the delivery address add page
         */
        public function action_add() {
            $this->template->title = 'Add Delivery Address | Raimol&trade; Energized Lubricants Purchase Order';
            
            $this->template->bodyContents = View::factory('store/accounts/address/form')
                                                     ->set('formstatus', Constants_FormAction::ADD);
            
        }
        
        /**
         * Displays the delivery address edit page
         * @param string $record The record to be edited
         */
        public function action_edit($record = '') {
            
            $this->template->title = 'Edit Delivery Address | Raimol&trade; Energized Lubricants Purchase Order';
            
            $this->address = ORM::factory('deliveryaddress')
                                      ->where('delivery_address_id', '=', Helper_Helper::decrypt($record))
                                      ->find();
            
            if($this->address->loaded()) {
                $this->template->bodyContents = View::factory('store/accounts/address/form')
                                                         ->set('formstatus', Constants_FormAction::EDIT)
                                                         ->set('address', $this->address);
            }
            else {
                throw new HTTP_Exception_404('Error');
            }
            
        }
        
        /**
         * Processes the delivery address form for add or edit
         * @param string $record The record to be edited, if present
         */
        public function action_process_form($record = '') {
        
            $this->address = ORM::factory('deliveryaddress');
                                    
            
            $flag = false; 
            
                       
            if($_POST['formstatus'] == Constants_FormAction::ADD) {
                
                $flag = TRUE;
                $this->json['action'] = Constants_FormAction::ADD;

            }
            else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                $this->address->where('delivery_address_id', '=', Helper_Helper::decrypt($record))
                              ->find();
                
                if($this->address->loaded()) {
                    $flag = TRUE; 
                    $this->json['action'] = Constants_FormAction::EDIT;
                }
                else {
                    $this->json['failmessage'] = '';
                    $this->json['success'] = FALSE;
                }

            }
           
            if($flag) {
                
                $this->address->values($_POST)->save();
                
                $this->json['success'] = TRUE;

            }
            //may mga error na nadetect
            else {
                $this->json['success'] = FALSE;
            }
            

            $this->_json_encode();
        }
        
        /**
         * Deletes a delivery address
         * @param string $record The record to be deleted
         */
        public function action_delete($record = '') {
            
            $this->address = ORM::factory('deliveryaddress')
                                   ->where('delivery_address_id', '=', Helper_Helper::decrypt($record))
                                   ->find();
            
            if($this->address->loaded()) {
                $this->address->delete();
                
                $this->request->redirect(URL::site( 'account/addresses?action=delete&success=true' , $this->_protocol ));
            }
            else {
                throw new HTTP_Exception_404('Error');
            }
            
        }
    } // End Controller_Account_Addresses