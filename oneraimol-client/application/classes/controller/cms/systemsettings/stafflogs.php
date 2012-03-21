<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Logs functionality of
 * System Settings module.
 * 
 * @category   Controller
 * @filesource classes/controller/cms/systemsettings/stafflogs.php
 * @package    OneRaimol Client
 * @author     DCDGLP
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Systemsettings_Stafflogs extends Controller_Cms_Systemsettings {
        
        /**
         * @var ORM systemsettings Holds the customer record from the DB.
         * @access private
         */
        private $systemsettings;
       
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
            
            $this->leftSelection = $this->config['msg']['leftselection']['stafflogs'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status Defines how the form will act on the performed action.
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['systems']['stafflogs'];
            
            // Pagination limit
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            
            $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            

        }
        /**
         *
         * @param type $record 
         */
        public function action_view($record = '') {
            $this->template->body->bodyContents = View::factory('cms/systemsettings/logs/usergrid')
                                            ->bind('stafflog', $this->stafflog);

            $this->stafflog = ORM::factory('stafflog')
                                ->join('staff_tb')
                                ->on('staff_tb.staff_id', '=', 'staff_logs_tb.staff_id')
                                ->where('staff_tb.staff_id', '=', Helper_Helper::decrypt($record))
                                ->find_all();
            
            // Pagination limit
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            
            //$this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            // Display the searchbox on the top bar
//            $this->template->header->searchbox = $this->_get_current_url('search');
            
        }
        /**
         * Shows the paginated grid view
         * @param string $limit The limit to be set to the paginator
         */
        public function action_limit($limit, ORM $searchquery = NULL) {
            $this->template->body->bodyContents = View::factory('cms/systemsettings/logs/grid')   //set yung html page
                                                       ->bind('stafflog', $this->stafflog)    // var to iterate yung customer records  
                                                       ->bind('stafflogcount', $this->stafflogcount)
                                                       ->bind('countaction', $countaction);
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
            else {
                $this->pageSelectionDesc = $this->config['msg']['page']['systems']['stafflogs'];
                
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('stafflog'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('stafflog'), 'limit', $limit);
                }
                
                $this->stafflog = ORM::factory('stafflog')
                                        ->order_by( 'staff_log_id', 'DESC' )
                                        ->limit(5)
                                        ->find_all();

                $this->stafflogcount = DB::select('staff_tb.*', array(DB::expr('COUNT(staff_tb.username)'), 'total_action'))
                            ->from('staff_logs_tb')
                            ->join('staff_tb')
                            ->on('staff_tb.staff_id', '=', 'staff_logs_tb.staff_id')
                            //->join('staff_role_tb')
                            //->on('staff_role_tb.staff_id', '=', 'staff_logs_tb.staff_id')
                            ->group_by('staff_tb.username')
                            ->as_object()
                            ->execute();
            }
        }
        

        /**
         * Makes a search then populates the result
         * into the data grid.
         * @param string $record The search keyword
         * @param string $limit Number of search result records per page
         */
        public function action_search($record, $limit = NULL) {
            $this->pageSelectionDesc = $this->config['msg']['actions']['search'] . $this->config['msg']['page']['systems']['stafflogs'];
            
            $this->template->body->bodyContents = View::factory('cms/accounts/customer/grid');
            
            // Gotta be immune from SQL injection attacks. :)
            $this->customer = ORM::factory('customer')
                                      ->where(DB::expr("MATCH(first_name,last_name)"), 'AGAINST', DB::expr("('+$record* +$record*' IN BOOLEAN MODE)"))
                                      ->or_where(DB::expr("MATCH(company)"), 'AGAINST', DB::expr("('+$record*' IN BOOLEAN MODE)"));
            
            // Paginate the result set
            $this->action_limit($limit, $this->customer);
            
            // Set offset and item per page from the pagination object
            $this->customer->order_by( 'customer_id', 'ASC' )
                             ->limit( $this->pagination->items_per_page )
                             ->offset( $this->pagination->offset );
            
            $this->template->body->bodyContents->set('customers', $this->customer->find_all());
             
        }


    }