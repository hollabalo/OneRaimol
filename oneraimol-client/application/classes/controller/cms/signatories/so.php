<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Sales Order approvals of Signatories module.
 * 
 * @category   Controller
 * @filesource classes/controller/cms/signatories/so.php
 * @package    OneRaimol Client
 * @author     DCDGLP
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Signatories_So extends Controller_Cms_Signatories {
        
        /**
         * @var ORM salesorder Holds the sales order record from the DB.
         * @access private
         */
        private $salesorder;
        
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
         * @var array roles The roles of logged in user
         */
        private $roles;
        
        /**
         * Add user roles to where clause
         * 
         * @param ORM $orm The ORM of roles shrek. XD
         * @param boolean $return Spefify if method will return the orm value
         */
        protected function _where_roles(ORM $orm, $return = TRUE) {
            // Open block of where clause for signatories WHERE checking
            $orm->and_where_open();

            foreach($this->session->get('roles') as $role) {
                if($role == Constants_UserType::SALES_COORDINATOR) {
                    $orm->or_where('sc_approved' , 'IS', NULL);
                }
                else if($role == Constants_UserType::GENERAL_MANAGER) {
                    $orm->or_where('gm_approved' , 'IS', NULL);
                }
                else if($role == Constants_UserType::ACCOUNTANT) {
                    $orm->or_where('accountant_approved' , 'IS', NULL);
                }
                else if($role == Constants_UserType::PRESIDENT) {
                    $orm->or_where('ceo_approved' , 'IS', NULL);
                }
            }

            // Close the blcok of where clause
            return $orm->and_where_close();
        }
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = $this->config['msg']['leftselection']['so'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status The resulting status of controller action
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['signatories']['so'];
            $this->template->body->pageDescription = $this->config['desc']['signatories']['salesorders']['description'];
            // Display the searchbox on the top bar
//            $this->template->header->searchbox = $this->_get_current_url('search');
            
            // Pagination
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            
            // Form action messages response
            if(Helper_Helper::decrypt($status) == Constants_FormAction::APPROVE) {
                $this->template->body->bodyContents->success = 'approved';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::DISAPPROVE) {
                $this->template->body->bodyContents->success = 'disapproved';
            }
        }
        
        /**
         * Shows the paginated grid view
         * @param string $limit The limit to be set to the paginator
         * @param ORM $searchquery The query result to be paginated
         */
        public function action_limit($limit, ORM $searchquery = NULL) {
            // Display the searchbox on the top bar
//            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->template->body->bodyContents = View::factory('cms/signatories/so/grid')  
                                                       ->bind('salesorder', $this->salesorder); 
            
            // Paginating a result set with WHERE clause?
            if(!is_null($searchquery)) {
                // Important! Else, incorrect result will display. Or the query won't work.
                $queryclone = clone $searchquery;
                
                // Check if limit is supplied on the URI, else, don't paginate
                if(is_null($limit)) {
                    $this->_pagination($queryclone, 'limit', NULL, TRUE);
                }
                else {
                    $this->_pagination($queryclone, 'limit', $limit, TRUE);
                }
            }
            // Paginating a result set without WHERE clause? (In short, in SQL, select all records)
            else {
                $this->pageSelectionDesc = $this->config['msg']['page']['signatories']['so'];
                $this->template->body->pageDescription = $this->config['desc']['signatories']['salesorders']['description'];
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination($this->_where_roles(ORM::factory('so')), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination($this->_where_roles(ORM::factory('so')), 'limit', $limit);
                }
                
                $this->salesorder = $this->_where_roles(ORM::factory('so'))
                                        ->order_by( 'so_id', 'DESC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }
        
        /**
         * Approves or disapproves the document
         * The signatory is defined through the active session.
         * 
         * @param string $role The current role of the staff
         * @param int $accounting The accounting role action type
         */
        public function action_approve($role = '', $accounting = '') {
            
            $current_role = Helper_Helper::decrypt($role);
            
            $this->salesorder = ORM::factory('so')
                                      ->where('so_id', '=', Helper_Helper::decrypt($_POST['so_id']))
                                      ->find();
            
            if($this->salesorder->loaded()) {
                // Get the role of logged in staff
                if($current_role == Constants_UserType::SALES_COORDINATOR) {
                    $this->salesorder->sc_approved = $this->session->get('userid');
                    $this->salesorder->sc_approved_date = Helper_Helper::date();
                }
                else if($current_role == Constants_UserType::GENERAL_MANAGER) {
                    $this->salesorder->gm_approved = $this->session->get('userid');
                    $this->salesorder->gm_approved_date = Helper_Helper::date();
                }
                else if($current_role == Constants_UserType::ACCOUNTANT) {
                    $this->salesorder->accountant_approved = $this->session->get('userid');
                    $this->salesorder->accountant_approved_date = Helper_Helper::date();
                }
                else if($current_role == Constants_UserType::PRESIDENT) {
                    $this->salesorder->ceo_approved = $this->session->get('userid');
                    $this->salesorder->ceo_approved_date = Helper_Helper::date();
                }
                
                
                if(strtolower($_POST['action']) == Constants_FormAction::APPROVE) {
                    if($current_role == Constants_UserType::SALES_COORDINATOR) {
                        $this->salesorder->sc_approved_status = 1;
                    }
                    else if($current_role == Constants_UserType::GENERAL_MANAGER) {
                        $this->salesorder->gm_approved_status = 1;
                    }
                    else if($current_role == Constants_UserType::ACCOUNTANT) {
                        $this->salesorder->accountant_approved_status = 1;
                    }
                     else if($current_role == Constants_UserType::PRESIDENT) {
                        $this->salesorder->ceo_approved_status = 1;
                        $this->salesorder->accountant_approved_status = 1;
                        $this->salesorder->gm_approved_status = 1;
                        $this->salesorder->sc_approved_status = 1;
                        $this->salesorder->ceo_approved_comment = $_POST['comment'];
                    }
                    
                    $this->json['approve'] = TRUE;
                   //Log activity
                   $this->_save_activity_stafflog( 'soapprove', $this->salesorder->so_id_string);
                }

                else if(strtolower($_POST['action']) == Constants_FormAction::DISAPPROVE) {
                    if($current_role == Constants_UserType::SALES_COORDINATOR) {
                        $this->salesorder->sc_approved_status = 2;
                        $this->salesorder->gm_approved_status = 2;
                        $this->salesorder->accountant_approved_status = 2;
                        $this->salesorder->ceo_approved_status = 2;
                        $this->salesorder->sc_disapproved_comment = $_POST['comment'];
                    }
                    else if($current_role == Constants_UserType::GENERAL_MANAGER) {
                        $this->salesorder->gm_approved_status = 2;
                        $this->salesorder->sc_approved_status = 2;
                        $this->salesorder->accountant_approved_status = 2;
                        $this->salesorder->ceo_approved_status = 2;
                        $this->salesorder->gm_disapproved_comment = $_POST['comment'];
                    }
                    else if($current_role == Constants_UserType::ACCOUNTANT) {
                            $this->salesorder->accountant_approved_status = 2;
                            $this->salesorder->sc_approved_status = 2;
                            $this->salesorder->gm_approved_status = 2;
                            $this->salesorder->ceo_approved_status = 2;
                            $this->salesorder->accountant_disapproved_comment = $_POST['comment'];

                    }
                    else if($current_role == Constants_UserType::PRESIDENT) {
                        $this->salesorder->ceo_approved_status = 2;
                        $this->salesorder->sc_approved_status = 2;
                        $this->salesorder->gm_approved_status = 2;
                        $this->salesorder->accountant_approved_status = 2;
                        $this->salesorder->ceo_disapproved_comment = $_POST['comment'];
                    }
                    
                    $this->json['approve'] = FALSE;
                   //Log activity
                   $this->_save_activity_stafflog( 'sodisapprove', $this->salesorder->so_id_string);
                }
                
                $this->salesorder->save();

                $this->json['success'] = TRUE;
            }
            else {
                $this->json['failmessage'] = $this->config['err']['signatories']['fail'];
                $this->json['success'] = FALSE;
            }
            
            $this->_json_encode();
        }
        
        /**
         * Disapproves the document.
         * The signatory is defined through the active session.
         * 
         * @TODO This method is experimental. Not yet implemented.
         * @TODO Make the method unified with the action_approve().
         * @param string $record The record to be approved
         */
        public function action_disapprove($record = '') {
            foreach( $_POST['id'] as $id ) {
                $this->customer = ORM::factory('customer')
                            ->where('customer_id', '=', Helper_Helper::decrypt($id))
                            ->find();
                
                // Check if user has multiple roles for document signing
                if(is_array($this->session->get('roles'))) {
                    // Not finished yet....
                }

                if( $this->customer->loaded() ) {
                    $this->customer->delete();
                }
            }

            $this->json['success'] = true;
            $this->_json_encode();
        }
        
        /**
         * Displays the sales order details page.
         * @param string $record The record to be viewed
         */
        public function action_details($record = '', $status = '') {
            
            $this->salesorder = ORM::factory('so')
                                     ->where('so_id', '=', Helper_Helper::decrypt($record))
                                     ->find();
            
            $this->purchaseorder = ORM::factory('po')
                                    ->where('so_id', '=', Helper_Helper::decrypt($record))
                                    ->find();
            
            if($this->salesorder->loaded()) {
                $this->pageSelectionDesc = $this->config['msg']['page']['signatories']['sodetail'] . $this->salesorder->so_id_string;
                
                // Find logged in user roles
                $this->roles = $this->session->instance()->get('roles');
                
                $this->template->body->bodyContents = View::factory('cms/signatories/so/form')
                                                             ->set('salesorder', $this->salesorder)
                                                             ->set('purchaseorder', $this->purchaseorder)
                                                             ->set('roles', $this->roles);
                
                // Form action messages response
                if(Helper_Helper::decrypt($status) == Constants_FormAction::APPROVE) {
                    $this->template->body->bodyContents->success = 'approved';
                }
                else if(Helper_Helper::decrypt($status) == Constants_FormAction::DISAPPROVE) {
                    $this->template->body->bodyContents->success = 'disapproved';
                }
                
            }
        }
    }