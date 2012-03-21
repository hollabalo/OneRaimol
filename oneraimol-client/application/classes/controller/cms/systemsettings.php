<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Parent controller for System Settings module.
 * All controllers for system settings module extend this controller.
 * 
 * @category   Controller
 * @filesource classes/controller/cms/systemsettings.php
 * @package    OneRaimol Client
 * @author     DCDGLP
 * @copyright  (c) 2012 DCDGLP
 */
    class Controller_Cms_Systemsettings extends Controller_Cms {
        
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
            
            $this->template->title = 'System Settings | OneRaimol';
            
            $this->template->header = View::factory('common/header')
                                        ->set('imgpath', $this->config['images'])
                                        ->set('img', $this->config['msg']['crumb']['img']['systems'])
                                        ->set('pageDesc', $this->config['msg']['crumb']['desc']['systems'])
                                        ->set('moduleURL', Constants_ModulePath::SYSTEMSETTINGS);
            
            $this->template->leftmenu = View::factory('common/leftmenu/systemsettings')
                                          ->set('moduleURL', Constants_ModulePath::SYSTEMSETTINGS)
                                          ->bind('leftSelection', $this->leftSelection);
            
            $this->template->body = View::factory('common/body')
                                          ->bind('pageSelectionDesc', $this->pageSelectionDesc);
            
            $this->template->formmessages = $this->_ajax_messages('formmessages');
        }
    }