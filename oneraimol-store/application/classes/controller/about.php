<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Static controller for about page.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2012 DCDGLP
 */
    class Controller_About extends Controller_Store {
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
        }
        
        public function action_index() {
            
        }
    }