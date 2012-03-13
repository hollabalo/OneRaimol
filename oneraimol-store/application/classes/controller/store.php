<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Public controller for OneRaimol.
 * This will be accessible to all, (eg. Client) without the need
 * of knowing specific access URL or system usage right/access level.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
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
            $this->session->destroy();
            
            Request::current()->redirect(
                URL::site( 'store' , $this->_protocol )
            );
        }
        
        /**
         * Method to limit grid record output per page
         * @param ORM $model The model to be paginated
         * @param string $searchmethod The controller method for pagination limiting (Default for every controller is action_limit()
         * @param int $record The record to be shown per page
         */
        protected function _pagination(ORM $model, $searchmethod = NULL, $record = NULL, $customsearch = FALSE) {
            $totalrecords = $model->find_all()->count();
            
            if(is_null($record)) {
                $record = 'all';
                
                $this->pagination = Pagination::factory(array(
                                        'items_per_page' => $totalrecords,
                                        'view' => 'pagination/bootstrap',
                                        'total_items' => $totalrecords,
                                    ));
            }
            else {
                $this->pagination = Pagination::factory(array(
                                        'items_per_page' => Helper_Helper::decrypt($record),
                                        'view' => 'pagination/bootstrap',
                                        'total_items' => $totalrecords,
                                    ));
            }
            
            $this->template->body->bodyContents->pageselector = View::factory('common/pagination')
                                                                        ->bind('pageselector', $this->pageselector)
                                                                        ->set('recordcount', $record);
            // The pagination request from a custom search?
            if($customsearch) {
               $this->template->body->bodyContents->pageselector->set('refURL', $this->_get_current_url(TRUE, TRUE));
            }
            // The pagination request is not a custom search
            // Ergo, pagination of a result set without WHERE clause
            else {
                $this->template->body->bodyContents->pageselector->set('refURL', $this->_get_current_url())
                                                                 ->set('searchmethod', $searchmethod );
            }
            
            // Render and display the pagination links and limiters to the webpage
            $this->pageselector = $this->pagination->render();
        }
        
        /**
         * Shows the page expired page.
         */
        protected function _expire_page() {
            Request::current()->redirect(
                URL::site( 'expire?from='. Helper_Helper::encrypt($this->_base_url . $this->request->detect_uri()) , $this->_protocol )
            );
        }
 
    }