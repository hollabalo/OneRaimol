<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Production Work Order approvals of Signatories module.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Signatories_Pwo extends Controller_Cms_Signatories {
        
        /**
         * @var ORM $productionworkorder Holds the sales order record from the DB.
         * @access private
         */
        private $productionworkorder;
        
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
                else if($role == Constants_UserType::HEAD_CHEMIST) {
                    $orm->or_where('hc_approved' , 'IS', NULL);
                }
                else if($role == Constants_UserType::ACCOUNTANT) {
                    $orm->or_where('accountant_approved' , 'IS', NULL);
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
            
            $this->leftSelection = $this->config['msg']['leftselection']['pwo'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI..
         * @param string $status The status message to be displayed
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['signatories']['pwo'];
            $this->template->body->pageDescription = $this->config['desc']['signatories']['productionworkorders']['description'];
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
            
            $this->template->body->bodyContents = View::factory('cms/signatories/pwo/grid')  
                                                       ->bind('productionworkorder', $this->productionworkorder); 
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['signatories']['pwo'];
                $this->template->body->pageDescription = $this->config['desc']['signatories']['productionworkorders']['description'];
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination($this->_where_roles(ORM::factory('pwo'), 'limit'));
                }
                // Display paginated limits
                else {
                    $this->_pagination($this->_where_roles(ORM::factory('pwo'), 'limit', $limit));
                }
                
                $this->productionworkorder = $this->_where_roles(ORM::factory('pwo'))
                                        ->order_by( 'pwo_id', 'DESC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }
        
        /**
         * Displays the production work order details page.
         * @param string $record The record to be viewed
         */
        public function action_details($record = '', $status = '') {
            $this->template->body->bodyContents = View::factory('cms/signatories/pwo/form')
                                                        ->bind('productionworkorder', $this->productionworkorder);
            
            $this->productionworkorder = ORM::factory('pwo')
                                     ->where('pwo_id', '=', Helper_Helper::decrypt($record))
                                     ->find();
            
            if($this->productionworkorder->loaded()) {
                $this->pageSelectionDesc = $this->config['msg']['page']['signatories']['pwodetail'] . $this->productionworkorder->pwo_id_string;
                
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
         * Approves or disapproves the document
         * The signatory is defined through the active session.
         * @param string $record The record to be approved
         */
        public function action_approve($role = '') {
            
            $current_role = Helper_Helper::decrypt($role);
            
            $this->productionworkorder = ORM::factory('pwo')
                                      ->where('pwo_id', '=', Helper_Helper::decrypt($_POST['pwo_id']))
                                      ->find();
            
            $this->soitems = ORM::factory('soitem')
                                ->where('pwo_id', '=', Helper_Helper::decrypt($_POST['pwo_id']))
                                ->find_all();
            
            $this->poitems = ORM::factory('poitem')
                                ->where('pwo_id', '=', Helper_Helper::decrypt($_POST['pwo_id']))
                                ->find_all();
            
            if($this->productionworkorder->loaded()) {
                // Get the role of logged in staff
                if($current_role == Constants_UserType::HEAD_CHEMIST) {
                    $this->productionworkorder->hc_approved = $this->session->get('userid');
                    $this->productionworkorder->hc_approved_date = Helper_Helper::date();
                }
                else if($current_role == Constants_UserType::SALES_COORDINATOR) {
                    $this->productionworkorder->sc_approved = $this->session->get('userid');
                    $this->productionworkorder->sc_approved_date = Helper_Helper::date();
                }
                else if($current_role == Constants_UserType::ACCOUNTANT) {
                    $this->productionworkorder->accountant_approved = $this->session->get('userid');
                    $this->productionworkorder->accountant_approved_date = Helper_Helper::date();
                }

                if(strtolower($_POST['action']) == Constants_FormAction::APPROVE) {
                    if($current_role == Constants_UserType::HEAD_CHEMIST) {
                        $this->productionworkorder->hc_approved_status = 1;
                    }
                    else if($current_role == Constants_UserType::SALES_COORDINATOR) {
                        $this->productionworkorder->sc_approved_status = 1;
                    }
                    else if($current_role == Constants_UserType::ACCOUNTANT) {
                        $this->productionworkorder->accountant_approved_status = 1;
                    }

                   $this->json['approve'] = TRUE;
                   //Log activity
                   $this->_save_activity_stafflog( 'pwoapprove', $this->productionworkorder->pwo_id_string);
                }
                else if(strtolower($_POST['action']) == Constants_FormAction::DISAPPROVE) {
                    if($current_role == Constants_UserType::HEAD_CHEMIST) {
                        $this->productionworkorder->hc_approved_status = 2;
                        $this->productionworkorder->sc_approved_status = 2;
                        $this->productionworkorder->accountant_approved_status = 2;
                        $this->productionworkorder->hc_disapproved_comment = $_POST['comment'];
                        $this->soitems->pwo_id = NULL;
                        $this->poitems->pwo_id = NULL;
                        
                    }
                    else if($current_role == Constants_UserType::SALES_COORDINATOR) {
                        $this->productionworkorder->sc_approved_status = 2;
                        $this->productionworkorder->hc_approved_status = 2;
                        $this->productionworkorder->accountant_approved_status = 2;
                        $this->productionworkorder->sc_disapproved_comment = $_POST['comment'];
                        $this->soitems->pwo_id = NULL;
                        $this->poitems->pwo_id = NULL;
                    }
                    else if($current_role == Constants_UserType::ACCOUNTANT) {
                        $this->productionworkorder->accountant_approved_status = 2;
                        $this->productionworkorder->hc_approved_status = 2;
                        $this->productionworkorder->sc_approved_status = 2;
                        $this->productionworkorder->accountant_disapproved_comment = $_POST['comment'];
                        $this->soitems->pwo_id = NULL;
                        $this->poitems->pwo_id = NULL;
                    }

                    $this->json['approve'] = FALSE;
                   //Log activity
                   $this->_save_activity_stafflog( 'pwodisapprove', $this->productionworkorder->pwo_id_string);
                }
                
                $this->productionworkorder->save();
                
                if(strtolower($_POST['action']) == Constants_FormAction::DISAPPROVE) {
                $this->soitems->save();
                $this->poitems->save();
                }
                
                $this->json['success'] = TRUE;
            }
            else {
                $this->json['failmessage'] = $this->config['err']['signatories']['fail'];
                $this->json['success'] = FALSE;
            }
            
            $this->_json_encode();
        }
        
        /**
         * Makes a search then populates the result
         * into the data grid.
         * @param string $record The search keyword
         * @param string $limit Number of search result records per page
         */
        public function action_search($record, $limit = NULL) {
            $this->pageSelectionDesc = $this->config['msg']['actions']['search'] . $this->config['msg']['page']['signatories']['pwo'];
            
            $this->template->body->bodyContents = View::factory('cms/signatories/pwo/grid');
            
            // Gotta be immune from SQL injection attacks. :)
            $this->productionworkorder = ORM::factory('pwo');
            
            // Build the search conditions based on the selected criteria from the form
            if(0 == Constants_FormAction::COMPANY) {
                $this->productionworkorder->where('pwo_id', 'LIKE', $record . '%');
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
            
            // Paginate the result set
            $this->action_limit($limit, $this->productionworkorder);
            
            // Set offset and item per page from the pagination object
            $this->productionworkorder->order_by( 'pwo_id', 'ASC' )
                             ->limit( $this->pagination->items_per_page )
                             ->offset( $this->pagination->offset );
            
            $this->template->body->bodyContents->set('productionworkorder', $this->productionworkorder->find_all());
             
        }
        
    }