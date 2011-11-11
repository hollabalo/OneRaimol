<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller template for OneRaimol.
 * All application controllers extend from this controller.
 * 
 * @category   Controller
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
    class Controller_Template extends Controller {
	/**
	 * @var  View  page template
	 */
	protected $template;

        /**
         * @var session object
         */
        protected $session = FALSE;

        /**
	 * @var  Config
	 */
	protected $config;

	/**
	 * @var  boolean  auto render template
	 **/
	protected $auto_render = TRUE;

        /**
	 * @var  string base_url
	 **/
        protected $_base_url = '';
        
        /**
	 * @var  string protocol
	 **/
        protected $_protocol = '';

        /**
	 * @var  json data
	 **/
        protected $json = array();


        /**
         * Automatically executed before the controller action.
         * Page initialization takes place here.
         * 
         * Initialization of template, session, paths, and configs
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         * @return object
         */
	public function before( $ssl_required = FALSE ) {

            if ( $this->auto_render === TRUE ) {
                // Load the template
                $this->template = View::factory( $this->template );
            }

            // Gets the base_url and checks whether if it is SSL or Not ...
            $this->_get_base_url( $ssl_required );

            $this->config = Kohana::config( 'paths' );
            
            View::set_global( 'base_url', $this->_base_url );

            $this->session = Session::instance();

            return parent::before();
	}

        /**
         * Checks if the current request is SSL
         * Configure core protected variables
         * 
         * @param boolean $ssl_required The HTTP request. Whether unsecured or secured HTTP.
         */
        protected function _get_base_url( $ssl_required = FALSE ) {

            if( $ssl_required && isset( $_SERVER['HTTP'] ) ) {
                Request::current()->redirect(
                    URL::base('https') . substr( $_SERVER['PATH_INFO'], 1 )
                );
            }

            if( ! $ssl_required && isset( $_SERVER['HTTPS'] ) ) {
                Request::current()->redirect(
                    URL::base('http') . substr( $_SERVER['PATH_INFO'], 1 )
                );
            }

            if( $ssl_required ) {
                $this->_base_url = URL::base('https');
                $this->_protocol = 'https';
            } else {
                $this->_base_url = URL::base('http');
                $this->_protocol = 'http';
            }

        }

        /**
         * Renders the page template
         */
        protected function _render() {
            self::after();
            echo $this->response->body( $this->template->render() );
            exit();
        }
          
        /**
	 * Assigns the template [View] as the request response.
         * @return object
	 */
	public function after()	{
            View::set_global( 'config', $this->config );

            if ( $this->auto_render === TRUE ) {
                $this->response->body( $this->template->render() );
            }

            return parent::after();
	}
        
        /**
         * Gets current URL
         * @param bool $action Appends current action to the return value if set to TRUE
         * @param bool $param Appends param value to the return value if set to TRUE
         * @return string 
         */
        public function _get_current_url($action = FALSE, $param = FALSE) {
            $str = '';
            
            if($action) {
                if($param) {
                    $str = $this->request->directory() . '/'. 
                           $this->request->controller() . '/' . 
                           $this->request->action() . '/' . 
                           $this->request->param('id');
                }
                else {
                    $str = $this->request->directory() . '/'. 
                           $this->request->controller() . '/' . 
                           $this->request->action();
                }
            }
            else {
               $str =  $this->request->directory() . '/'. 
                       $this->request->controller(); 
            }
            
            return $str;
        }
        
        /**
         * Encodes the json array for JSON responses
         */
        protected function _json_encode() {
            echo json_encode( $this->json );
            exit();
        }
        
        /**
         * 
         * @param string $file Filename of message file
         * @return string 
         */
        protected function _ajax_messages($file = '') {
            $msg = '';

            $msgs = Kohana::message($file);

            foreach($msgs as $field => $value) {
                $msg .= " '{$field}' : '{$value}',\n ";
            }

            return substr($msg, 0, -3 );
        }
        
    } // End Controller_Template
