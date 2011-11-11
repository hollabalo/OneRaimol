<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Parent controller for Sales module.
 * All controllers for sales module extend this controller.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Sales extends Controller_Cms {
        
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
    }