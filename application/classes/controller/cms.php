<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Cms extends Controller_Template {
        
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->template->title = 'OneRaimol CMS Home';
            
            $this->config['msg'] = Kohana::message('childmessages');
            $this->config['err'] = Kohana::message('errors');
            
            if(! $this->session->get('userid')) {
                Request::current()->redirect(
                    URL::site( 'auth' , $this->_protocol )
                );
            }
        }
   
        public function action_logout() {
            $this->session->delete('userid');
            
            Request::current()->redirect(
                URL::site( 'auth' , $this->_protocol )
            );
        }
    }