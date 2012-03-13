<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Production batch ticket approvals of Signatories module.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Signatories_Pbt extends Controller_Cms_Signatories {
        
        /**
         * @var ORM $productionbatchticket Holds the production batch ticket record from the DB.
         * @access private
         */
        private $productionbatchticket;
        
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
                if($role == Constants_UserType::LABORATORY_ANALYST) {
                    $orm->or_where('labanalyst_approved' , 'IS', NULL);
                }
                else if($role == Constants_UserType::QUALITY_ASSURANCE) {
                    $orm->or_where('qa_approved' , 'IS', NULL);
                }
                else if($role == Constants_UserType::QUALITY_ASSURANCE_HEAD) {
                    $orm->or_where('qa_head_approved' , 'IS', NULL);
                }
                else if($role == Constants_UserType::HEAD_CHEMIST) {
                    $orm->or_where('hc_approved' , 'IS', NULL);
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
            
            $this->leftSelection = $this->config['msg']['leftselection']['pbt'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI..
         * @param string $status The status message to be displayed
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['signatories']['pbt'];
            $this->template->body->pageDescription = $this->config['desc']['signatories']['productionbatchticket']['description'];
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
            
            $this->template->body->bodyContents = View::factory('cms/signatories/pbt/grid')  
                                                       ->bind('productionbatchticket', $this->productionbatchticket); 
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['signatories']['pbt'];
                $this->template->body->pageDescription = $this->config['desc']['signatories']['productionbatchticket']['description'];
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination($this->_where_roles(ORM::factory('pbt'), 'limit'));
                }
                // Display paginated limits
                else {
                    $this->_pagination($this->_where_roles(ORM::factory('pbt'), 'limit', $limit));
                }
                
                $this->productionbatchticket = $this->_where_roles(ORM::factory('pbt'))
                                        ->order_by( 'pbt_id', 'DESC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }
        
        /**
         * Displays the sales order details page.
         * @param string $record The record to be viewed
         */
        public function action_details($record = '', $status = '') {
            $this->template->body->bodyContents = View::factory('cms/signatories/pbt/form')
                                                        ->bind('productionbatchticket', $this->productionbatchticket);
            
            $this->productionbatchticket = ORM::factory('pbt')
                                     ->where('pbt_id', '=', Helper_Helper::decrypt($record))
                                     ->find();
            
            if($this->productionbatchticket->loaded()) {
                $this->pageSelectionDesc = $this->config['msg']['page']['signatories']['pbtdetail'] . $this->productionbatchticket->pbt_id_string . " of " . $this->productionbatchticket->formulas->formula_id_string . " of " . $this->productionbatchticket->formulas->poitems->product_description;
            
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
        public function action_approve($role = '', $accounting = '') {
            
            $current_role = Helper_Helper::decrypt($role);
            
            $this->productionbatchticket = ORM::factory('pbt')
                                      ->where('pbt_id', '=', Helper_Helper::decrypt($_POST['pbt_id']))
                                      ->find();
            
            if($this->productionbatchticket->loaded()) {
                // Get the role of logged in staff
                if($current_role == Constants_UserType::LABORATORY_ANALYST) {
                    $this->productionbatchticket->labanalyst_approved = $this->session->get('userid');
                    $this->productionbatchticket->labanalyst_approved_date = Helper_Helper::date();
                }
                else if($current_role == Constants_UserType::QUALITY_ASSURANCE) {
                    $this->productionbatchticket->qa_approved = $this->session->get('userid');
                    $this->productionbatchticket->qa_approved_date = Helper_Helper::date();
                }
                else if($current_role == Constants_UserType::HEAD_CHEMIST) {
                    $this->productionbatchticket->hc_approved = $this->session->get('userid');
                    $this->productionbatchticket->hc_approved_date = Helper_Helper::date();
                }
                else if($current_role == Constants_UserType::QUALITY_ASSURANCE_HEAD) {
                    $this->productionbatchticket->qa_head_approved = $this->session->get('userid');
                    $this->productionbatchticket->qa_head_approved_date = Helper_Helper::date();
                }
                
                if(strtolower($_POST['action']) == Constants_FormAction::APPROVE) {
                    if($current_role == Constants_UserType::LABORATORY_ANALYST) {
                        $this->productionbatchticket->labanalyst_approved_status = 1;
                    }
                    else if($current_role == Constants_UserType::QUALITY_ASSURANCE) {
                        $this->productionbatchticket->qa_approved_status = 1;
                    }
                    else if($current_role == Constants_UserType::HEAD_CHEMIST) {
                        $this->productionbatchticket->hc_approved_status = 1;
                    }
                    else if($current_role == Constants_UserType::QUALITY_ASSURANCE_HEAD) {
                        $this->productionbatchticket->qa_head_approved_status = 1;
                    }
                    $this->json['approve'] = FALSE;
                   //Log activity
                   $this->_save_activity_stafflog( 'pbtapprove', $this->productionbatchticket->pbt_id_string);
                }
                else if(strtolower($_POST['action']) == Constants_FormAction::DISAPPROVE) {
                    if($current_role == Constants_UserType::LABORATORY_ANALYST) {
                        $this->productionbatchticket->hc_approved_status = 2;
                        $this->productionbatchticket->qa_approved_status = 2;
                        $this->productionbatchticket->labanalyst_approved_status = 2;
                        $this->productionbatchticket->qa_head_approved_status = 2;
                        $this->productionbatchticket->labanalyst_disapproved_comment = $_POST['comment'];
                    }
                    else if($current_role == Constants_UserType::QUALITY_ASSURANCE) {
                        $this->productionbatchticket->qa_approved_status = 2;
                        $this->productionbatchticket->hc_approved_status = 2;
                        $this->productionbatchticket->labanalyst_approved_status = 2;
                        $this->productionbatchticket->qa_head_approved_status = 2;
                        $this->productionbatchticket->qa_disapproved_comment = $_POST['comment'];
                    }
                    else if($current_role == Constants_UserType::HEAD_CHEMIST) {
                        $this->productionbatchticket->hc_approved_status = 2;
                        $this->productionbatchticket->labanalyst_approved_status = 2;
                        $this->productionbatchticket->qa_approved_status = 2;
                        $this->productionbatchticket->qa_head_approved_status = 2;
                        $this->productionbatchticket->hc_disapproved_comment = $_POST['comment'];
                    }
                    else if($current_role == Constants_UserType::QUALITY_ASSURANCE_HEAD) {
                        $this->productionbatchticket->qa_head_approved_status = 2;
                        $this->productionbatchticket->hc_approved_status = 2;
                        $this->productionbatchticket->qa_approved_status = 2;
                        $this->productionbatchticket->labanalsyt_approved_status = 2;
                        $this->productionbatchticket->qa_head_disapproved_comment = $_POST['comment'];
                    }
                    $this->json['approve'] = FALSE;
                   //Log activity
                   $this->_save_activity_stafflog( 'pbtdisapprove', $this->productionbatchticket->pbt_id_string);
                }
                
                $this->productionbatchticket->save();
                
                $this->json['success'] = TRUE;
            }
            else {
                $this->json['failmessage'] = '';
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
            $this->pageSelectionDesc = $this->config['msg']['actions']['search'] . $this->config['msg']['page']['signatories']['pbt'];
            
            $this->template->body->bodyContents = View::factory('cms/signatories/pbt/grid');
            
            // Gotta be immune from SQL injection attacks. :)
            $this->productionworkorder = ORM::factory('pbt');
            
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
            $this->action_limit($limit, $this->productionbatchticket);
            
            // Set offset and item per page from the pagination object
            $this->productionbatchticket->order_by( 'pbt_id', 'ASC' )
                             ->limit( $this->pagination->items_per_page )
                             ->offset( $this->pagination->offset );
            
            $this->template->body->bodyContents->set('productionbatchticket', $this->productionbatchticket->find_all());
             
        }
        
    }