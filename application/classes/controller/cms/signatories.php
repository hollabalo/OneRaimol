<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Cms_Signatories extends Controller_Cms {
        
        protected $leftSelection;
        protected $pageSelectionDesc;
        
        public function before($ssl_required = FALSE) {
            $this->template = 'common/cmschild';
            parent::before($ssl_required);
            
            $this->template->title = 'Signatories | OneRaimol';
            
            $this->template->header = View::factory('common/header')
                                        ->set('topSelection', 'signatories')
                                        ->set('imgpath', $this->config['images'])
                                        ->set('img', $this->config['msg']['crumb']['img']['signatories'])
                                        ->set('pageDesc', $this->config['msg']['crumb']['desc']['signatories'])
                                        ->set('moduleURL', Constants_ModulePath::SIGNATORIES);
            
            $this->template->leftmenu = View::factory('common/leftmenu/signatories')
                                          ->set('moduleURL', Constants_ModulePath::SIGNATORIES)
                                          ->bind('leftSelection', $this->leftSelection);
            
            $this->template->body = View::factory('common/body')
                                          ->bind('pageSelectionDesc', $this->pageSelectionDesc);
        }
        
        public function action_index() {
            $this->template->body->bodyContents = 'teka lang wala pang laman';
        }
    }