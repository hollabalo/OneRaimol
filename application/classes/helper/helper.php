<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Generic helper class for OneRaimol.
 * 
 * @category   Helper
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
    class Helper_Helper {
        
        /**
         * Encryts data supplied in the param into base64 using the
         * information from the config file.
         * 
         * @param string $data The data to be encoded.
         * @return string 
         */
        public static function encrypt( $data = '' ) {
            $config = Kohana::config('paths');

            return base64_encode( $config['hash'] . $data );
        }

        /**
         * Decrypts data supplied in the param from base64 to regular string 
         * using the information from the config file.
         * 
         * @param string $data The data to be encoded.
         * @return string 
         */
        public static function decrypt( $data = '' ) {
            $config = Kohana::config('paths');

            $decoded_string = base64_decode( $data );

            return str_replace( $config['hash'], '', $decoded_string );
        }
    }