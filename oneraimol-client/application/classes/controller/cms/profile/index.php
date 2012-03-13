<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Index controller for Profile module.
 * 
 * @category   Controller
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Profile_Index extends Controller_Cms_Profile {
        
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
            
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * 
         * @param string $status Defines how the form will act on the performed action.
         */
        public function action_index($status = '') {

            
            // Pagination limit
            $this->initialpagelimit = ORM::factory('systemsetting')->find();
            
            //$this->action_limit(Helper_Helper::encrypt($this->initialpagelimit->records_per_page));
            
            // Display the searchbox on the top bar
//            $this->template->header->searchbox = $this->_get_current_url('search');
            
            $this->template->body->bodyContents = View::factory('cms/profile/form')   //set yung html page
                                                          ->bind('staff', $this->staff);   // var to iterate yung customer records  
 
            $this->staff = ORM::factory('staff')
                                    ->where('staff_id', '=', $this->session->get('userid'))
                                    ->find();
            
            $this->pageSelectionDesc = $this->config['msg']['page']['profile']['staff'] . " of " . $this->staff->full_name();
            // For form action messages
            if(Helper_Helper::decrypt($status) == Constants_FormAction::ADD) {
                $this->template->body->bodyContents->success = 'created';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::EDIT) {
                $this->template->body->bodyContents->success = 'edited';
            }
        }
    }