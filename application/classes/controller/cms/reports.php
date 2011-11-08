<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Cms_Reports extends Controller_Cms {
        
        protected $leftSelection;
        protected $pageSelectionDesc;
        
        public function before($ssl_required = FALSE) {
            $this->template = 'common/cmschild';
            parent::before($ssl_required);
            
            $this->template->title = 'Reports | OneRaimol';
            
            $this->template->header = View::factory('common/header')
                                        ->set('topSelection', 'reports')
                                        ->set('imgpath', $this->config['images'])
                                        ->set('img', $this->config['msg']['crumb']['img']['reports'])
                                        ->set('pageDesc', $this->config['msg']['crumb']['desc']['reports'])
                                        ->set('moduleURL', Constants_ModulePath::REPORTS);
            
            $this->template->leftmenu = View::factory('common/leftmenu/reports')
                                          ->set('moduleURL', Constants_ModulePath::REPORTS)
                                          ->bind('leftSelection', $this->leftSelection);
            
            $this->template->body = View::factory('common/body')
                                          ->bind('pageSelectionDesc', $this->pageSelectionDesc);
        }
        
        public function action_index() {
            $this->template->body->bodyContents = 'teka lang wala pang laman';
        }
    }