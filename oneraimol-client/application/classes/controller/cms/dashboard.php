<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Parent controller for Dashboard.
 * 
 * @category   Controller
 * @filesource classes/controller/cms/dashboard.php
 * @package    OneRaimol Client
 * @author     DCDGLP
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Dashboard extends Controller_Cms {
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        public function before($ssl_required = FALSE) {
            $this->template = 'common/cmshome';
            parent::before($ssl_required);
            
        }
       
        /**
         * The initial page that is shown when no action is explicitly called
         * on the URI.
         */
        public function action_index() {
         $this->template->body = View::factory('cms/dashboard')
                                    ->bind('staff', $staff)
                                    ->bind('role', $role);
            
         // Find staff
         $staff = ORM::factory('staff')
                ->where('staff_id', '=', $this->session->get('userid'))
                ->find();

         // Find roles
         $role = ORM::factory('staffrole')
                        ->where('staff_id', '=', $staff->pk())
                        ->find_all();
       
        }
       
    }