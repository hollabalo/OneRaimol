<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Cms_Dashboard extends Controller_Cms {
        
        public function before($ssl_required = FALSE) {
            $this->template = 'common/cmshome';
            parent::before($ssl_required);
            
        }
       
        public function action_index() {
         $this->template->body = View::factory('cms/dashboard')
                                    ->bind('staff', $staff);
            
            $staff = ORM::factory('staff')
                    ->where('staff_id', '=', $this->session->get('userid'))
                    ->find();
            
           
               
       
        }
       
    }