<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Index controller for Account module.
 * 
 * @category   Controller
 * @filesource classes/controller/account/index.php
 * @package    OneRaimol Store
 * @author     DCDGLP
 * @copyright  (c) 2012 DCDGLP
 */
    class Controller_Account_Index extends Controller_Account {
       
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
        }
        
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         * @param string $record The record to be searched
         */
        public function action_index($record = NULL) {
            $this->template->title = 'Account Dashboard | Raimol&trade; Energized Lubricants Purchase Order';
            
            $this->template->bodyContents = View::factory('store/accounts/dashboard');
        }
    } // End Controller_Account_Index