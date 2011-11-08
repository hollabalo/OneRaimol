<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Public extends Controller_Template {
        
        public function before($ssl_required = FALSE) {
            $this->template = 'wala-pang-public-view-ah';
            parent::before($ssl_required);
        }
        
        public function action_login() {
           
        }
        
        public function action_index() {

          
        }
        
    }