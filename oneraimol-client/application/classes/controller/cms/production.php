<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Parent controller for Production module.
 * All controllers for production module extend this controller.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Cms_Production extends Controller_Cms {
        
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
            
            $this->template->title = 'Production | OneRaimol';
            
            $this->template->header = View::factory('common/header')
                                        ->set('topSelection', 'production')
                                        ->set('imgpath', $this->config['images'])
                                        ->set('img', $this->config['msg']['crumb']['img']['production'])
                                        ->set('pageDesc', $this->config['msg']['crumb']['desc']['production'])
                                        ->set('moduleURL', Constants_ModulePath::PRODUCTION);
            
            $this->template->leftmenu = View::factory('common/leftmenu/production')
                                          ->set('moduleURL', Constants_ModulePath::PRODUCTION)
                                          ->bind('leftSelection', $this->leftSelection);
            
            $this->template->body = View::factory('common/body')
                                          ->bind('pageSelectionDesc', $this->pageSelectionDesc);
            
            $this->template->formmessages = $this->_ajax_messages('formmessages');
            
            // Flag for module access
            $accessflag = FALSE;
            
            $pos = array (
                Constants_UserType::PRESIDENT,
                Constants_UserType::SALES_COORDINATOR,
                Constants_UserType::HEAD_CHEMIST,
                Constants_UserType::GENERAL_MANAGER,
                Constants_UserType::ACCOUNTANT,
                Constants_UserType::INVENTORY_CONTROLLER,
                Constants_UserType::ADMIN
                
            );
            
            foreach($pos as $position) {
                $accessflag = Helper_Helper::check_access_right($this->session->get('roles'), $position);
                if($accessflag == TRUE) break;
            }
            
            if(!$accessflag) {
                Request::current()->redirect(
                    URL::site( 'cms' , $this->_protocol )
                );
            }
        }
    }