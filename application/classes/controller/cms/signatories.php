<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Parent controller for Signatories module.
 * All controllers for signatories module extend this controller.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Signatories extends Controller_Cms {
        
        /**
         * @var leftSelection The left menu indicator of "selected" CSS class of current controller/action.
         */
        protected $leftSelection;
        
        /**
         * @var pageSelectionDesc The string identifier of a displayed page. 
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
    }