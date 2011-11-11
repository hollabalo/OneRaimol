<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Sales Order approvals of Signatories module.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
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
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['signatories']['so'];
            
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
            $this->pageSelectionDesc = $this->config['msg']['page']['signatories']['so'];
            
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
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('so'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('so'), 'limit', $limit);
                }
                
                $this->salesorder = ORM::factory('so')
                                        ->order_by( 'so_id', 'ASC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }
        
        /**
         * Approves the document.
         * The signatory is defined through the active session.
         * @param string $record The record to be approved
         */
        public function action_approve($record = '') {    
            // :( :( :(((((((( >:(
        }
        
        /**
         * Disapproves the document.
         * The signatory is defined through the active session.
         * @param string $record The record to be approved
         */
        public function action_disapprove($record = '') {
            // :( :( :(((((((( >:(
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
            
            // Paginate the result set
            $this->action_limit($limit, $this->salesorder);
            
            // Set offset and item per page from the pagination object
            $this->salesorder->order_by( 'so_id', 'ASC' )
                             ->limit( $this->pagination->items_per_page )
                             ->offset( $this->pagination->offset );
            
            $this->template->body->bodyContents->set('salesorder', $this->salesorder->find_all());
             
        }
    }