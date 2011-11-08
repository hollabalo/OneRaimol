<?php defined('SYSPATH') or die('No direct script access.');

    class Controller_Cms_Accounts extends Controller_Cms {
        
        protected $leftSelection;
        protected $pageSelectionDesc;
        
        public function before($ssl_required = FALSE) {
            $this->template = 'common/cmschild';
            parent::before($ssl_required);
            
            $this->template->title = 'Accounts | OneRaimol';
            
            $this->template->header = View::factory('common/header')
                                        ->set('topSelection', 'accounts')
                                        ->set('imgpath', $this->config['images'])
                                        ->set('img', $this->config['msg']['crumb']['img']['acctmgmt'])
                                        ->set('pageDesc', $this->config['msg']['crumb']['desc']['acctmgmt'])
                                        ->set('moduleURL', Constants_ModulePath::ACCOUNTS);
            
            $this->template->leftmenu = View::factory('common/leftmenu/acctmgmt')
                                          ->set('moduleURL', Constants_ModulePath::ACCOUNTS)
                                          ->bind('leftSelection', $this->leftSelection);
            
            $this->template->body = View::factory('common/body')
                                          ->bind('pageSelectionDesc', $this->pageSelectionDesc);
            
            $this->template->formmessages = $this->_ajax_messages('formmessages');
        }
        
    }