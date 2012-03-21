<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Parent controller for Profile module.
 * All controllers for profile module extend this controller.
 * 
 * @category   Controller
 * @filesource classes/controller/cms/profile.php
 * @package    OneRaimol Client
 * @author     DCDGLP
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Profile extends Controller_Cms {
        
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
            
            $this->template->title = 'Profile | OneRaimol';
            
            $this->template->header = View::factory('common/header')
                                        ->set('imgpath', $this->config['images'])
                                        ->set('img', $this->config['msg']['crumb']['img']['profile'])
                                        ->set('pageDesc', $this->config['msg']['crumb']['desc']['profile'])
                                        ->set('moduleURL', Constants_ModulePath::PROFILE);
            
            $this->template->leftmenu = View::factory('common/leftmenu/profile')
                                          ->set('moduleURL', Constants_ModulePath::PROFILE)
                                          ->bind('leftSelection', $this->leftSelection);
            
            $this->template->body = View::factory('common/body')
                                          ->bind('pageSelectionDesc', $this->pageSelectionDesc);
            
            $this->template->formmessages = $this->_ajax_messages('formmessages');
        }
    }