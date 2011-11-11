<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Parent controller for Reports module.
 * All controllers for reports module extend this controller.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Reports extends Controller_Cms {
        
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
    }