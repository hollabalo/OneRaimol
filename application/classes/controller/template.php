<?php

    defined('SYSPATH') or die('No direct script access.');

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
	 * Loads the template [View] object.
         * Initialize Variables ...
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

        // Check if the Current Request Is SSL ...
        // Configure Core Protected Variables ...
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

        // Instantly Render The Template Page ...
        protected function _render() {
            self::after();
            echo $this->response->body( $this->template->render() );
            exit();
        }
          
        /**
	 * Assigns the template [View] as the request response.
	 */
	public function after()	{
            View::set_global( 'config', $this->config );

            if ( $this->auto_render === TRUE ) {
                $this->response->body( $this->template->render() );
            }

            return parent::after();
	}
        
        protected function _json_encode() {
            echo json_encode( $this->json );
            exit();
        }
        
        protected function _ajax_messages($file = '') {
            $msg = '';

            $msgs = Kohana::message($file);

            foreach($msgs as $field => $value) {
                $msg .= " '{$field}' : '{$value}',\n ";
            }

            return substr($msg, 0, -3 );
        }
        
        public function action_url() {
            $this->template->body->bodyContents = URL::base(Request::current()) . Request::current()->detect_uri();
        }
    } // End Controller_Template
