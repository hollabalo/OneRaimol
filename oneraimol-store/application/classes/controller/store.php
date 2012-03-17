<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Public controller for OneRaimol.
 * This will be accessible to all, (eg. Client) without the need
 * of knowing specific access URL or system usage right/access level.
 * 
 * @category   Controller
 * @filesource classes/controller/store.php
 * @package    OneRaimol Store
 * @author     DCDGLP
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Store extends Controller_Template {
        
        /**
         * Paginates a list of database result
         * @var view 
         * @access protected
         */
        protected $pagination;
        
        /**
         * Holds the pagination view
         * @var view
         * @access protected
         */
        protected $paginationview;
        
        /**
         * @var ORM user Holds user information from DB for login authentication.
         * @access protected
         */
        protected $user;
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            $this->template = 'common/base';
            parent::before($ssl_required);
            
            // Binds error messages from a message file
            $this->config['err']=Kohana::message('errors');
            
            // Binds miscellaneous messages from a message file
            $this->config['msg'] = Kohana::message('childmessages');
            
            // binds javascript messages to template for use in
            // AJAX message responses
            $this->template->formmessages = $this->_ajax_messages('formmessages');
            
            // Begins an instance of a $_SESSION
            $this->session = Session::instance();
            
            $this->template->categories = ORM::factory('materialcategory')
                                          ->order_by('description', 'ASC')
                                          ->find_all();
            
            $this->template->title = 'Raimol&trade; Energized Lubricants Purchase Order';
        }
        
        public function action_index() {
            if($this->session->get('userid')) {
                Request::current()->redirect(
                    URL::site( 'catalog' , $this->_protocol )
                );
            }
            else {
                $this->template->bodyContents = View::factory('store/home');
            }
        }
        
        /**
         * Destroys the session and logs out user
         */
        public function action_logout() {
            // Unset the session object
            $this->session->destroy();
            
            // Redirect to homepage
            Request::current()->redirect(
                URL::site( 'store' , $this->_protocol )
            );
        }
        
        /**
         * Shows the page expired page.
         */
        protected function _expire_page() {
            Request::current()->redirect(
                URL::site( 'expire?from='. Helper_Helper::encrypt($this->_base_url . $this->request->detect_uri()) , $this->_protocol )
            );
        }
 
    } // End Controller_Store