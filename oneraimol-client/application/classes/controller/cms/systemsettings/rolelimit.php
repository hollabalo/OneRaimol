<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller for Role Limit functionality of
 * System Settings module.
 * 
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Systemsettings_Rolelimit extends Controller_Cms_Systemsettings {
        
        /**
         * @var ORM rolelimit Holds the rolelimit record from the DB.
         * @access private
         */
        private $rolelimit;
       
        /**
         * @var int initialpagelimit Holds the default page limit from the system setting
         */
        private $initialpagelimit;
        
        /**
         * @var string formstatus Defines how the shared form will handle the request
         * @access private
         */
        private $formstatus;
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = $this->config['msg']['leftselection']['rolelimit'];
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status Defines how the form will act on the performed action.
         */
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['systems']['rolelimit'];
            
            // Pagination limit
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            
            $this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            
            // For form action messages
            if(Helper_Helper::decrypt($status) == Constants_FormAction::ADD) {
                $this->template->body->bodyContents->success = 'created';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::EDIT) {
                $this->template->body->bodyContents->success = 'edited';
            }
        }
        
        /**
         * Shows the add form.
         */
        public function action_add() {
            $this->pageSelectionDesc = $this->config['msg']['actions']['newrole'];
            $this->formstatus = Constants_FormAction::ADD;

            $this->template->body->bodyContents = View::factory('cms/systemsettings/rolelimit/form')
                                                        ->set('formStatus', $this->formstatus);
        }
        
        /**
         *
         * @param type $record 
         */
        public function action_edit($record = '') {
            $this->rolelimit = ORM::factory('rolelimit')
                                       ->where('role_limit_id', '=', Helper_Helper::decrypt($record))
                                       ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['actions']['editrole'];
            $this->formstatus = Constants_FormAction::EDIT;
            
            $this->template->body->bodyContents = View::factory('cms/systemsettings/rolelimit/form')
                                            ->set('rolelimit', $this->rolelimit)
                                            ->set('formStatus', $this->formstatus);
        }
        /**
         * Shows the paginated grid view
         * @param string $limit The limit to be set to the paginator
         */
        public function action_limit($limit, ORM $searchquery = NULL) {
            
            $this->template->body->bodyContents = View::factory('cms/systemsettings/rolelimit/grid')   //set yung html page
                                                       ->bind('rolelimit', $this->rolelimit);   // var to iterate yung customer records  
                                                     
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
                $this->pageSelectionDesc = $this->config['msg']['page']['systems']['rolelimit'];
                
                // Display all records
                if($limit == Constants_FormAction::ALL) {
                    $this->_pagination(ORM::factory('rolelimit'), 'limit');
                }
                // Display paginated limits
                else {
                    $this->_pagination(ORM::factory('rolelimit'), 'limit', $limit);
                }
                
                $this->rolelimit = ORM::factory('rolelimit')
                                        ->order_by( 'role_limit_id', 'ASC' )
                                        ->limit( $this->pagination->items_per_page )
                                        ->offset( $this->pagination->offset )
                                        ->find_all();


            }
        }
        
        /**
         * Processes the record manipulated in the shared form.
         * @param string $record The record to be processed.
         */
        public function action_process_form($record = '') {
            
            $flag = false; //gagamitan ng flag para hindi magulo
            
            $this->rolelimit = ORM::factory('rolelimit');
            
            //security na rin kaya specified yung condition since
            //kung may kumag na user na maalam sa mga ganto, pwede nyang palitan ang value
            //ng formstatus na hidden field dun sa form
            if($_POST['formstatus'] == Constants_FormAction::ADD) {
                //kelangang itest kung used na yung username
                //kasi diba hindi pwedeng magpareho ang username
//                $this->product->where('name', '=', $_POST['name'])
//                         ->find();
                
               $flag = true;
               $this->json['action']=Constants_FormAction::ADD;
              
          
            }
            else if($_POST['formstatus'] == Constants_FormAction::EDIT) {
                $this->rolelimit->where('role_limit_id', '=', Helper_Helper::decrypt($record))
                         ->find();
                
                $flag = true;
                $this->json['action'] = Constants_FormAction::EDIT;
                //Log activity
                $this->_save_activity_stafflog( 'editrole', $this->rolelimit->roles->name);     
            }
             if($flag) {
                 $this->rolelimit->limit = $_POST['limit'];
                 $this->rolelimit->save();

                
                if($_POST['formstatus'] == Constants_FormAction::ADD){
                   $array = array (
                            'name' => $_POST['name'],
                            'description' => $_POST['name']
                        );

                        $this->role = ORM::factory('role')
                                           ->values($array)
                                           ->save();
                        $this->rolelimit->role_id = $this->role->role_id;
                        $this->rolelimit->limit = $_POST['limit'];
                        $this->rolelimit->save();
                        

                //Log activity
               $this->_save_activity_stafflog( 'newrole', $this->rolelimit->roles->name);  
                }                
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
         * Makes a search then populates the result
         * into the data grid.
         * @param string $record The search keyword
         * @param string $limit Number of search result records per page
         */
        public function action_search($record, $limit = NULL) {
            $this->pageSelectionDesc = $this->config['msg']['actions']['search'] . $this->config['msg']['page']['acctmgmt']['customer'];
            
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