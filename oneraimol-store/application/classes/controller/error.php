<?php defined('SYSPATH') or die('No direct script access.');
 
/**
 * Static controller for expire page
 * 
 * @category   Controller
 * @filesource classes/controller/error.php
 * @package    OneRaimol Store
 * @author     DCDGLP
 * @copyright  (c) 2012 DCDGLP
 */
    class Controller_Error extends Controller_Store { 
        /**
         * The requested page
         * @var mixed The requested page 
         */
        protected $_requested_page; 
        
        /**
         * The message
         * @var mixed The message
         */
        protected $_message; 

        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before( $ssl_required = FALSE ) { 
            parent::before( $ssl_required ); 

            //Sub requests only! 
            if ( ! $this->request->is_initial()) { 
                if ($message = rawurldecode($this->request->param('message'))) { 
                    $this->_message = $message; 
                } 
            
                if ($requested_page = rawurldecode($this->request->param('origuri'))) { 
                    $this->_requested_page = $requested_page; 
                } 
            } 
            else { 
                // This one was directly requested, don't allow 
                $this->request->action(404); 

                // Set the requested page accordingly 
                $this->_requested_page = Arr::get($_SERVER, 'PHP_SELF'); 
            } 

            $this->response->status((int) $this->request->action()); 
        } 

        // Set page defaults for 404 error
        public function action_404() { 
            $this->template->title = 'Page Not Found | Raimol&trade; Energized Lubricants Purchase Order';
            
            $this->template->bodyContents = View::factory('error/404')
                                                    ->set('error_message', $this->_message) 
                                                    ->set('requested_page', $this->_requested_page);
        } 

        // Set page defaults for 500 error
        public function action_500() { 
            $this->template->title = 'Page Not Found | Raimol&trade; Energized Lubricants Purchase Order';
            
            $this->template->bodyContents = View::factory('error/500'); 
        }
    } // End Controller_Error