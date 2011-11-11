<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Parent controller for Admin side of OneRaimol.
 * All admin side controllers extend from this controller.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms extends Controller_Template {
        
        /**
         * @var HTML pagination Pagination for gridviews 
         */
        protected $pagination;
        
        /**
         *
         * @var HTML pageselector Show the pagination boxes 
         */
        protected $pageselector;
        
        /**
         * @var 
         */
        protected $search;
        
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
                                        'view' => 'pagination/boxes',
                                        'total_items' => $totalrecords,
                                    ));
            }
            else {
                $this->pagination = Pagination::factory(array(
                                        'items_per_page' => Helper_Helper::decrypt($record),
                                        'view' => 'pagination/boxes',
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
            
            $this->pageselector = $this->pagination
                                       ->render();
        }
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->template->title = 'OneRaimol CMS Home';
            
            // Set message files to variables for controllers' use
            $this->config['msg'] = Kohana::message('childmessages');
            $this->config['err'] = Kohana::message('errors');
            
            // Prevents page access if no session is set
            if(! $this->session->get('userid')) {
                Request::current()->redirect(
                    URL::site( 'auth' , $this->_protocol )
                );
            }
        }
   
        /**
         * Destroys the session and logs the user out.
         * After the session is destroyed, the request will be put to redirection
         * to the login page.
         */
        public function action_logout() {
            $this->session->delete('userid');
            
            Request::current()->redirect(
                URL::site( 'auth' , $this->_protocol )
            );
        }
    }