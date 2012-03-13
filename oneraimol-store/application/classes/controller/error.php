<?php defined('SYSPATH') or die('No direct script access.');
 
    class Controller_Error extends Controller_Store { 
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
                $this->_requested_page = Arr::get($_SERVER, 'PHP_SELF'); 
            } 

            $this->response->status((int) $this->request->action()); 
        } 

        public function action_404() { 
            $this->template->title = 'Page Not Found | Raimol&trade; Energized Lubricants Purchase Order';
            
            $this->template->bodyContents = View::factory('error/404')
                                                    ->set('error_message', $this->_message) 
                                                    ->set('requested_page', $this->_requested_page);
        } 

        public function action_500() { 
            $this->template->title = 'Page Not Found | Raimol&trade; Energized Lubricants Purchase Order';
            
            $this->template->bodyContents = View::factory('error/500'); 
        }
    } 
?>