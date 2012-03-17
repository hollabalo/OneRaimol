<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Static controller for expire page
 * 
 * @category   Controller
 * @filesource classes/controller/template.php
 * @package    OneRaimol Store
 * @author     DCDGLP
 * @copyright  (c) 2012 DCDGLP
 */
    class Controller_Expire extends Controller_Store {
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            // Prevent direct access without the GET variable FROM
            if(! $this->request->query('from')) {
                Request::current()->redirect(
                    URL::site( '/' , $this->_protocol )
                );
            }
        }
        
        // Set page defaults
        public function action_index() {
           
            $this->template->title = 'Page Expired | Raimol&trade; Energized Lubricants Purchase Order';
            
            $this->template->bodyContents = View::factory('common/expire')
                                                      ->set('url', Helper_Helper::decrypt($this->request->query('from')));
            
        }
    } // End Controller_Expire