<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Cms_Sales_So extends Controller_Cms_Sales {
        
        //entity property
        private $salesorder;
        
        //logic property
        private $formstatus;
        
        public function before($ssl_required = FALSE) {
            parent::before($ssl_required);
            
            $this->leftSelection = $this->config['msg']['leftselection']['so'];
        }
        
        public function action_index($status = '') {
            $this->pageSelectionDesc = $this->config['msg']['page']['sales']['so'];
            
            // to follow nalang ang pagination
            $this->salesorder = ORM::factory('so')
                          ->find_all();
            
            $this->template->body->bodyContents = View::factory('cms/sales/so/grid')   //set yung html page
                                                       ->set('salesorder', $this->salesorder);     // var to iterate yung customer records       
            
            if(Helper_Helper::decrypt($status) == Constants_FormAction::ADD) {
                $this->template->body->bodyContents->success = 'created';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::EDIT) {
                $this->template->body->bodyContents->success = 'edited';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::DELETE) {
                $this->template->body->bodyContents->success = 'deleted';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::ENABLE) {
                $this->template->body->bodyContents->success = 'enabled';
            }
            else if(Helper_Helper::decrypt($status) == Constants_FormAction::DISABLE) {
                $this->template->body->bodyContents->success = 'disabled';
            }
        }
        
    }