<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Index controller for Inventory module.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Inventory_Index extends Controller_Cms_Inventory {
        
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
            $this->template->body->bodyContents = View::factory('common/image')
                                                        ->set('imgpath', $this->config['images'])
                                                       ->set('image', $this->config['msg']['intro']['inventory']);
        }
        
    }