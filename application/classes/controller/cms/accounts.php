<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Parent controller for Accounts module.
 * All controllers for accounts module extend this controller.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Accounts extends Controller_Cms {
        
        /**
         * @var string leftSelection The left menu indicator of "selected" CSS class of current controller/action.
         */
        protected $leftSelection;
        
        /**
         * @var string pageSelectionDesc The string identifier of a displayed page. 
         */
        protected $pageSelectionDesc;
        
        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
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