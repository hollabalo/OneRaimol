<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Cms_Production extends Controller_Cms {
        
        protected $leftSelection;
        protected $pageSelectionDesc;
        
        public function before($ssl_required = FALSE) {
            $this->template = 'common/cmschild';
            parent::before($ssl_required);
            
            $this->template->title = 'Production | OneRaimol';
            
            $this->template->header = View::factory('common/header')
                                        ->set('topSelection', 'production')
                                        ->set('imgpath', $this->config['images'])
                                        ->set('img', $this->config['msg']['crumb']['img']['production'])
                                        ->set('pageDesc', $this->config['msg']['crumb']['desc']['production'])
                                        ->set('moduleURL', Constants_ModulePath::INVENTORY);
            
            $this->template->leftmenu = View::factory('common/leftmenu/production')
                                          ->set('moduleURL', Constants_ModulePath::PRODUCTION)
                                          ->bind('leftSelection', $this->leftSelection);
            
            $this->template->body = View::factory('common/body')
                                          ->bind('pageSelectionDesc', $this->pageSelectionDesc);
        }
        
        public function action_index() {
            $this->template->body->bodyContents = 'teka lang wala pang laman';
        }
    }