<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Cms_Sales extends Controller_Cms {
        
        protected $leftSelection;
        protected $pageSelectionDesc;
        
        public function before($ssl_required = FALSE) {
            $this->template = 'common/cmschild';
            parent::before($ssl_required);
            
            $this->template->title = 'Sales | OneRaimol';
            
            $this->template->header = View::factory('common/header')
                                        ->set('topSelection', 'sales')
                                        ->set('imgpath', $this->config['images'])
                                        ->set('img', $this->config['msg']['crumb']['img']['sales'])
                                        ->set('pageDesc', $this->config['msg']['crumb']['desc']['sales'])
                                        ->set('moduleURL', Constants_ModulePath::SALES);
            
            $this->template->leftmenu = View::factory('common/leftmenu/sales')
                                          ->set('moduleURL', Constants_ModulePath::SALES)
                                          ->bind('leftSelection', $this->leftSelection);
            
            $this->template->body = View::factory('common/body')
                                          ->bind('pageSelectionDesc', $this->pageSelectionDesc);
        }
        
        public function action_index() {
            $this->template->body->bodyContents = 'teka lang wala pang laman';
        }
    }