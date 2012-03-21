<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Formula approvals of Signatories module.
 * 
 * @category   Controller
 * @filesource classes/controller/cms/signatories/formula.php
 * @package    OneRaimol Client
 * @author     DCDGLP
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Signatories_Formula extends Controller_Cms_Signatories {
        
        /**
         * @var ORM $formula Holds the formula record from the DB.
         * @access private
         */
        private $formula;
        
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
                if($role == Constants_UserType::PRESIDENT) {
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
            
            $this->leftSelection = $this->config['msg']['leftselection']['formula'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI..
         * @param string $status The status message to be displayed
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['signatories']['formulas'];
            $this->template->body->pageDescription = $this->config['desc']['signatories']['formula']['description'];
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
            
            $this->template->body->bodyContents = View::factory('cms/signatories/formula/grid')  
                                                       ->bind('formula', $this->formula); 
            
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
                $this->pageSelectionDesc = $this->config['msg']['page']['signatories']['formulas'];
                $this->template->body->pageDescription = $this->config['desc']['signatories']['formula']['description'];
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination($this->_where_roles(ORM::factory('formula'), 'limit'));
                }
                // Display paginated limits
                else {
                    $this->_pagination($this->_where_roles(ORM::factory('formula'), 'limit', $limit));
                }
                
                $this->formula = $this->_where_roles(ORM::factory('formula'))
                                        ->order_by( 'formula_id', 'DESC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();
            }
        }
        
        /**
         * Displays the formula details page.
         * @param string $record The record to be viewed
         */
        public function action_details($record = '', $status = '') {
            $this->template->body->bodyContents = View::factory('cms/signatories/formula/form')
                                                        ->bind('formula', $this->formula)
                                                        ->bind('formuladetail', $this->formuladetail);
            
            $this->formuladetail = ORM::factory('formuladetail')
                                     ->where('formula_id', '=', Helper_Helper::decrypt($record))
                                     ->find_all();
            
            $this->formula = ORM::factory('formula')
                                    ->where('formula_id', '=', Helper_Helper::decrypt($record))
                                    ->find();
            
            if($this->formula->loaded()) {
                $this->pageSelectionDesc = $this->config['msg']['page']['signatories']['formuladetails'] . $this->formula->formula_id_string . " of " . $this->formula->poitems->product_description;
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
            
            $this->formula = ORM::factory('formula')
                                      ->where('formula_id', '=', Helper_Helper::decrypt($_POST['formula_id']))
                                      ->find();
            
            
            if($this->formula->loaded()) {
                // Get the role of logged in staff
                if($current_role == Constants_UserType::PRESIDENT) {
                    $this->formula->ceo_approved = $this->session->get('userid');
                    $this->formula->ceo_approved_date = Helper_Helper::date();
                }
                
                if(strtolower($_POST['action']) == Constants_FormAction::APPROVE) {
                    if($current_role == Constants_UserType::PRESIDENT) {
                        $this->formula->ceo_approved_status = 1;
                    }
                    $this->json['approve'] = TRUE;
                   //Log activity
                   $this->_save_activity_stafflog( 'formulaapprove', $this->formula->formula_id_string);
                }
                else if(strtolower($_POST['action']) == Constants_FormAction::DISAPPROVE) {
                    if($current_role == Constants_UserType::PRESIDENT) {
                        $this->formula->ceo_approved_status = 2;
                        $this->formula->ceo_disapproved_comment = $_POST['comment'];
                    }
                    $this->json['approve'] = FALSE;
                   //Log activity
                   $this->_save_activity_stafflog( 'formuladisapprove', $this->formula->formula_id_string);
                }
                $this->formula->save();
                
                $productionbatchticket = array (
                    'date_created' => $this->formula->date_created,
                    'formula_id' => $this->formula->formula_id,
                    'pbt_id_string' => Helper_Helper::set_pk(Constants_DocType::PRODUCTION_BATCH_TICKET),
                    'release_flag' => '1'
                );
                $this->productionbatchticket = ORM::factory('pbt')->values($productionbatchticket)->save();
                
                $pwoitems = array (
                    'pbt_id' => $this->productionbatchticket->pbt_id
                );
                
                DB::update('production_work_order_item_tb')
                        ->set($pwoitems)
                        ->where('pwo_item_id', '=', $this->formula->pwoitems->pwo_item_id)
                        ->execute();
                
                $this->json['success'] = TRUE;
            }
            else {
                $this->json['failmessage'] = '';
                $this->json['success'] = FALSE;
            }
            
            $this->_json_encode();
        }
        
    }