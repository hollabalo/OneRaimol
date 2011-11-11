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
    class Controller_Public extends Controller_Template {
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            $this->template = 'wala-pang-public-view-ah';
            parent::before($ssl_required);
        }
        
        /**
         * Displays login page.
         */
        public function action_login() {
           
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         */
        public function action_index() {

          
        }
        
    }