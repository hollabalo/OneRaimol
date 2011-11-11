<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Index controller for Production module.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Production_Index extends Controller_Cms_Production {
        
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
         */
        public function action_index() {
            $this->template->body->bodyContents = 'TRACKING HOME';
        }
        
    }