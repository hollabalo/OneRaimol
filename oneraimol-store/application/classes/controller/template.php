<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Controller template for OneRaimol public side.
 * All application controllers extend from this controller.
 * 
 * @category   Controller
 * @filesource classes/controller/template.php
 * @package    OneRaimol Store
 * @author     DCDGLP
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

            // Gets the cofiguration paths for javascript, images, and css
            $this->config = Kohana::config( 'paths' );
            
            // Sets the base URL to be visible for all the views
            View::set_global( 'base_url', $this->_base_url );

            // Starts a session instance
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

            // Redirects the HTTP request to secured HTTP, if SSL is required
            if( $ssl_required && isset( $_SERVER['HTTP'] ) ) {
                Request::current()->redirect(
                    URL::base('https') . substr( $_SERVER['PATH_INFO'], 1 )
                );
            }

            // Redirects the HTTPS request to normal HTTP, if SSL is not requried
            if( ! $ssl_required && isset( $_SERVER['HTTPS'] ) ) {
                Request::current()->redirect(
                    URL::base('http') . substr( $_SERVER['PATH_INFO'], 1 )
                );
            }

            // Sets core protected variables
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
