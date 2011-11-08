<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Cms_Inventory extends Controller_Cms {
        
        protected $leftSelection;
        protected $pageSelectionDesc;
        
        public function before($ssl_required = FALSE) {
            $this->template = 'common/cmschild';
            parent::before($ssl_required);
            
            $this->template->title = 'Inventory | OneRaimol';
            
            $this->template->header = View::factory('common/header')
                                        ->set('topSelection', 'inventory')
                                        ->set('imgpath', $this->config['images'])
                                        ->set('img', $this->config['msg']['crumb']['img']['inventory'])
                                        ->set('pageDesc', $this->config['msg']['crumb']['desc']['inventory'])
                                        ->set('moduleURL', Constants_ModulePath::INVENTORY);
            
            $this->template->leftmenu = View::factory('common/leftmenu/inventory')
                                          ->set('moduleURL', Constants_ModulePath::INVENTORY)
                                          ->bind('leftSelection', $this->leftSelection);
            
            $this->template->body = View::factory('common/body')
                                          ->bind('pageSelectionDesc', $this->pageSelectionDesc);
        }
        
        public function action_index() {
            $this->template->body->bodyContents = Request::detect_uri() . '/' . URL::base();
            
        }
    }