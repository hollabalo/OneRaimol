<?php defined('SYSPATH') or die('No direct script access.');
 
/**
 * Custom error handler for OneRaimol.
 * We don't want the default Kohana error screen to appear as it poses
 * a great security hole.
 * 
 * @category   Controller
 * @filesource classes/controller/error.php
 * @package    OneRaimol Client
 * @author     DCDGLP
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Error extends Controller_Cms_Dashboard {
        
        /**
         *
         * @var _requeste_page The requested page. 
         */
        protected $_requested_page; 
        
        
        /**
         *
         * @var _message The message. 
         */
        protected $_message; 

        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param type $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before( $ssl_required = FALSE ) { 
            parent::before( $ssl_required ); 

            $this->template = View::factory('common/cmserror');
            
            $this->template->header = View::factory('common/header')
                                    ->set('imgpath', $this->config['images'])
                                    ->set('img', $this->config['msg']['crumb']['img']['error'])
                                    ->set('moduleURL', Constants_ModulePath::ERROR);
            
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
                $this->_requested_page = Arr::get($_SERVER, 'REQUEST_URI'); 
            } 

            $this->response->status((int) $this->request->action()); 
        } 
        
        /**
         * Sets defaults for 404 errors.
         */
        public function action_404() {
            $this->template->title = 'Page Not Found | OneRaimol';
            
            $this->template->header->set('pageDesc', $this->config['msg']['crumb']['desc']['error']['404']);
            
            $this->template->body = View::factory('error/404')
                                    ->set('error_message', $this->_message) 
                                    ->set('requested_page', $this->_requested_page);
        } 

        /**
         * Sets defaults for 500 errors.
         */
        public function action_500() { 
            $this->template->title = 'Internal Server Error | OneRaimol';
            
            $this->template->header->set('pageDesc', $this->config['msg']['crumb']['desc']['error']['500']);
            
            $this->template->body = View::factory('error/500')
                                    ->set('error_message', $this->_message) 
                                    ->set('requested_page', $this->_requested_page);
        }
    } // End Controller_Error