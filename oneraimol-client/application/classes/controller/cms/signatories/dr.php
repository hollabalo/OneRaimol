<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Delivery Receipt approvals of Signatories module.
 * 
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Signatories_Dr extends Controller_Cms_Signatories {
        
        /**
         * @var ORM $deliveryreceipt Holds the sales order record from the DB.
         * @access private
         */
        private $deliveryreceipt;
        
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
                else if($role == Constants_UserType::PRODUCT_MANAGER) {
                    $orm->or_where('pm_approved' , 'IS', NULL);
                }
                else if($role == Constants_UserType::INVENTORY_CONTROLLER) {
                    $orm->or_where('ic_approved' , 'IS', NULL);
                }
                else if($role == Constants_UserType::LABORATORY_ANALYST) {
                    $orm->or_where('labanalyst_approved' , 'IS', NULL);
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
            
            $this->leftSelection = $this->config['msg']['leftselection']['dr'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status The resulting status of controller action
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['sales']['dr'];
            
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
            
            $this->template->body->bodyContents = View::factory('cms/signatories/dr/grid')  
                                                       ->bind('deliveryreceipt', $this->deliveryreceipt); 
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['sales']['dr'];
                
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination($this->_where_roles(ORM::factory('deliveryreceipt')), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination($this->_where_roles(ORM::factory('deliveryreceipt')), 'limit', $limit);
                }
                
                $this->deliveryreceipt = $this->_where_roles(ORM::factory('deliveryreceipt'))
                                        ->order_by( 'dr_id', 'DESC' )
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
        public function action_approve($role = '') {
            
            $current_role = Helper_Helper::decrypt($role);
            
            $this->deliveryreceipt = ORM::factory('deliveryreceipt')
                                      ->where('dr_id', '=', Helper_Helper::decrypt($_POST['dr_id']))
                                      ->find();
            
            if($this->deliveryreceipt->loaded()) {
                // Get the role of logged in staff
                if($current_role == Constants_UserType::SALES_COORDINATOR) {
                    $this->deliveryreceipt->sc_approved = $this->session->get('userid');
                    $this->deliveryreceipt->sc_approved_date = Helper_Helper::date();
                }
                else if($current_role == Constants_UserType::GENERAL_MANAGER) {
                    $this->deliveryreceipt->gm_approved = $this->session->get('userid');
                    $this->deliveryreceipt->gm_approved_date = Helper_Helper::date();
                }
                else if($current_role == Constants_UserType::PRODUCT_MANAGER) {
                    $this->deliveryreceipt->pm_approved = $this->session->get('userid');
                    $this->deliveryreceipt->pm_approved_date = Helper_Helper::date();
                }
                else if($current_role == Constants_UserType::INVENTORY_CONTROLLER) {
                    $this->deliveryreceipt->ic_approved = $this->session->get('userid');
                    $this->deliveryreceipt->ic_approved_date = Helper_Helper::date();
                }
                else if($current_role == Constants_UserType::LABORATORY_ANALYST) {
                    $this->deliveryreceipt->labanalyst_approved = $this->session->get('userid');
                    $this->deliveryreceipt->labanalyst_approved_date = Helper_Helper::date();
                }
                
                
                if(strtolower($_POST['action']) == Constants_FormAction::APPROVE) {
                    if($current_role == Constants_UserType::SALES_COORDINATOR) {
                        $this->deliveryreceipt->sc_approved_status = 1;
                    }
                    else if($current_role == Constants_UserType::GENERAL_MANAGER) {
                        $this->deliveryreceipt->gm_approved_status = 1;
                    }
                    else if($current_role == Constants_UserType::PRODUCT_MANAGER) {
                            $this->deliveryreceipt->pm_approved_status = 1;
                    }
                     else if($current_role == Constants_UserType::INVENTORY_CONTROLLER) {
                        $this->deliveryreceipt->ic_approved_status = 1;
                    }
                     else if($current_role == Constants_UserType::LABORATORY_ANALYST) {
                        $this->deliveryreceipt->labanalyst_approved_status = 1;
                    }
                    
                    $this->json['approve'] = TRUE;
                   //Log activity
                   $this->_save_activity_stafflog( 'drapprove', $this->deliveryreceipt->dr_id_string);
                    
                }

                else if(strtolower($_POST['action']) == Constants_FormAction::DISAPPROVE) {
                    if($current_role == Constants_UserType::SALES_COORDINATOR) {
                        $this->deliveryreceipt->sc_approved_status = 2;
                        $this->deliveryreceipt->gm_approved_status = 2;
                        $this->deliveryreceipt->pm_approved_status = 2;
                        $this->deliveryreceipt->ic_approved_status = 2;
                        $this->deliveryreceipt->labanalyst_approved_status = 2;
                        $this->deliveryreceipt->sc_disapproved_comment = $_POST['comment'];
                    }
                    else if($current_role == Constants_UserType::GENERAL_MANAGER) {
                        $this->deliveryreceipt->gm_approved_status = 2;
                        $this->deliveryreceipt->sc_approved_status = 2;
                        $this->deliveryreceipt->pm_approved_status = 2;
                        $this->deliveryreceipt->ic_approved_status = 2;
                        $this->deliveryreceipt->labanalyst_approved_status = 2;
                        $this->deliveryreceipt->gm_disapproved_comment = $_POST['comment'];
                    }
                    else if($current_role == Constants_UserType::PRODUCT_MANAGER) {
                            $this->deliveryreceipt->pm_approved_status = 2;
                            $this->deliveryreceipt->sc_approved_status = 2;
                            $this->deliveryreceipt->gm_approved_status = 2;
                            $this->deliveryreceipt->ic_approved_status = 2;
                            $this->deliveryreceipt->labanalyst_approved_status = 2;
                            $this->deliveryreceipt->pm_disapproved_comment = $_POST['comment'];
                    }
                    else if($current_role == Constants_UserType::INVENTORY_CONTROLLER) {
                        $this->deliveryreceipt->ic_approved_status = 2;
                        $this->deliveryreceipt->sc_approved_status = 2;
                        $this->deliveryreceipt->gm_approved_status = 2;
                        $this->deliveryreceipt->pm_approved_status = 2;
                        $this->deliveryreceipt->labanalyst_approved_status = 2;
                        $this->deliveryreceipt->ic_disapproved_comment = $_POST['comment'];
                    }
                    else if($current_role == Constants_UserType::LABORATORY_ANALYST) {
                        $this->deliveryreceipt->labanalyst_approved_status = 2;
                        $this->deliveryreceipt->sc_approved_status = 2;
                        $this->deliveryreceipt->gm_approved_status = 2;
                        $this->deliveryreceipt->pm_approved_status = 2;
                        $this->deliveryreceipt->ic_approved_status = 2;
                        $this->deliveryreceipt->labanalyst_disapproved_comment = $_POST['comment'];
                    }
                    
                    $this->json['approve'] = FALSE;
                   //Log activity
                   $this->_save_activity_stafflog( 'drdisapprove', $this->deliveryreceipt->dr_id_string);
                }
                if($this->deliveryreceipt->sc_approved_status == 1 && 
                     $this->deliveryreceipt->gm_approved_status == 1 && 
                     $this->deliveryreceipt->pm_approved_status == 1 && 
                     $this->deliveryreceipt->ic_approved_status == 1 && 
                     $this->deliveryreceipt->labanalyst_approved_status == 1){
                    
                    $this->deliveryreceipt->dr_status = 2;
                    $this->deliveryreceipt->save();
                }
                
                $this->deliveryreceipt->save();
                

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
            
            
            $this->deliveryreceipt = ORM::factory('deliveryreceipt')
                                     ->where('dr_id', '=', Helper_Helper::decrypt($record))
                                     ->find();
            
            $this->purchaseorder = ORM::factory('po')
                                    ->where('dr_id', '=', Helper_Helper::decrypt($record))
                                    ->find();
            
            if($this->deliveryreceipt->loaded()) {
                $this->pageSelectionDesc = $this->config['msg']['page']['signatories']['drdetail'] . $this->deliveryreceipt->dr_id_string;
                
                // Find logged in user roles
                $this->roles = $this->session->instance()->get('roles');
                
                $this->template->body->bodyContents = View::factory('cms/signatories/dr/form')
                                                             ->set('deliveryreceipt', $this->deliveryreceipt)
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
        
        /**
         * Makes a search then populates the result
         * into the data grid.
         * @param string $record The search keyword
         * @param string $limit Number of search result records per page
         */
        public function action_search($record, $limit = NULL) {
            $this->pageSelectionDesc = $this->config['msg']['actions']['search'] . $this->config['msg']['page']['signatories']['so'];
            
            $this->template->body->bodyContents = View::factory('cms/signatories/so/grid');
            
            // The query is exact or not. Mimics the double quote searches in Google
//            if($_POST['stringmatch'] == TRUE) {
//                $record = Helper_Helper::decrypt($record);
//            }
//            else {
//                $record = Helper_Helper::decrypt($record) . '%';
//            }
            
            // Gotta be immune from SQL injection attacks. :)
            $this->salesorder = ORM::factory('so')
                                     ->join('purchase_order_tb')
                                     ->on('sales_order_tb.so_id', '=', 'purchase_order_tb.so_id')
                                     ->join('customer_tb')
                                     ->on('purchase_order_tb.customer_id', '=', 'customer_tb.customer_id');
            
            // Build the search conditions based on the selected criteria from the form
            if(0 == Constants_FormAction::COMPANY) {
                $this->salesorder->where('customer_tb.company', 'LIKE', $record . '%');
            }
//            else if($_POST['searchtype'] == Constants_FormAction::ORDER_DATE) {
//                $this->salesorder->where('purchase_order_tb.order_date', 'LIKE', $record);
//            }
//            else if($_POST['searchtype'] == Constants_FormAction::DELIVERY_DATE) {
//                $this->salesorder->where('purchase_order_tb.delivery_date', 'LIKE', $record);
//            }
//            
//            
//            if($_POST['approvefilter'] == Constants_FormAction::APPROVE) {
//                if(is_array($this->session->get('roles'))) {
//                    
//                }
//                else {
//                    
//                }
//            }
//            else if($_POST['approvefilter'] == Constants_FormAction::DISAPPROVE) {
//                $this->salesorder->and_where('', '=', '');
//            }
            
            
            // Ensure to select only the unapproved documents by proper signatories
            $this->salesorder = $this->_where_roles($this->salesorder);
            
            // Paginate the result set
            $this->action_limit($limit, $this->salesorder);
            
            // Set offset and item per page from the pagination object
            $this->salesorder->order_by( 'so_id', 'ASC' )
                             ->limit( $this->pagination->items_per_page )
                             ->offset( $this->pagination->offset );
            
            $this->template->body->bodyContents->set('salesorder', $this->salesorder->find_all());
             
        }
    }