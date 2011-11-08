<?php defined('SYSPATH') or die('No direct script access.');
 
    class Controller_Error extends Controller { 
        protected $_requested_page; 
        protected $_message; 

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
                $this->_requested_page = Arr::get($_SERVER, 'REQUEST_URI'); 
            } 

            $this->response->status((int) $this->request->action()); 
        } 
        
        public function _set_page_defaults() {
            //templating
        }

        public function action_404() { 
            $this->template = View::factory('error/404'); 
            
            $this->_set_page_defaults();
            
        } 

        public function action_500() { 
            $this->template = View::factory('error/500'); 
            
            $this->_set_page_defaults();
            
        }
        
        public function action_403() {
            $this->template = View::factory('error/500'); 
            
            $this->_set_page_defaults();
        }
    } 
?>