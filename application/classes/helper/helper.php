<?php

    class Helper_Helper {
        public static function encrypt( $data = '' ) {
            $config = Kohana::config('paths');

            return base64_encode( $config['hash'] . $data );
        }

        public static function decrypt( $data = '' ) {
            $config = Kohana::config('paths');

            $decoded_string = base64_decode( $data );

            return str_replace( $config['hash'], '', $decoded_string );
        }
    }