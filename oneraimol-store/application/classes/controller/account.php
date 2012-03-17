<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Base controller for Account module. All controllers for account module extends this controller.
 * 
 * @category   Controller
 * @filesource classes/controller/account.php
 * @package    OneRaimol Store
 * @author     DCDGLP
 * @copyright  (c) 2012 DCDGLP
 */
    class Controller_Account extends Controller_Store {
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            // Prevent page access if not logged in
            if(! $this->session->get('userid')) {
                $this->_expire_page();
            }
        }
        
    } // End Controller_Account