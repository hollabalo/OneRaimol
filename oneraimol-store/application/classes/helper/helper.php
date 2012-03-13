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
        
        /**
         * Sets the primary key of documents.
         * @param int $type The document type
         * @return string 
         */
        public static function set_pk($type = '') {
            
            $seed = ORM::factory('systemsetting')->find();
            
            $bs = 0;
            
            $doctype = '';
            
            if($type == Constants_DocType::PURCHASE_ORDER) {
                $bs = $seed->po_seed;
                $doctype = 'PO';
                $seed->po_seed++;
            }
            elseif($type == Constants_DocType::SALES_ORDER) {
                $bs = $seed->so_seed;
                $doctype = 'SO';
                $seed->so_seed++;   
            }
            elseif($type == Constants_DocType::PRODUCTION_WORK_ORDER) {
                $bs = $seed->pwo_seed;
                $doctype = 'PWO';
                $seed->pwo_seed++;
            }
            elseif($type == Constants_DocType::FORMULA) {
                $bs = $seed->formula_seed;
                $doctype = 'F';
                $seed->formula_seed++;
            }
            elseif($type == Constants_DocType::PRODUCTION_BATCH_TICKET) {
                $bs = $seed->pbt_seed;
                $doctype = 'PBT';
                $seed->pbt_seed++;
            }
            elseif($type == Constants_DocType::DELIVERY_RECEIPT) {
                $bs = $seed->dr_seed;
                $doctype = 'DR';
                $seed->dr_seed++;
            }
            
            $str = strtoupper($doctype) . '-' . date("Y") . '-';
            
            if($bs >= 1 && $bs <=9){
                $str .= '000' . $bs;
            }
            elseif($bs >= 10 && $bs <=99){
                $str .= '00' . $bs;
            }
            elseif($bs >= 100 && $bs <=999){
                $str .= '0' . $bs;
            }
            elseif($bs >=1000){
                $str .= $bs;
            }
            
          
            
            $seed->save();
            
            return $str;
        }
        
        /**
         *
         * @param type $date
         * @param type $format
         * @return type 
         */
        public static function date( $date = '', $format = '' ) {
            $date = ! empty( $date ) ? $date : 'NOW';
            $format = ! empty( $format ) ? $format : 'Y-m-d H:i:s';
            return date( $format, strtotime( $date ) );
        }
        
    /**
     * Searches haystack for needle and 
     * returns an array of the key path if 
     * it is found in the (multidimensional) 
     * array, FALSE otherwise.
     *
     * @mixed array_searchRecursive ( mixed needle, 
     * array haystack [, bool strict[, array path]] )
     */
 
    public static function array_searchRecursive( $needle, $haystack, $strict=false, $path=array() )
    {
        if( !is_array($haystack) ) {
            return false;
        }

        foreach( $haystack as $key => $val ) {
            if( is_array($val) && $subPath =  array_searchRecursive($needle, $val, $strict, $path) ) {
                $path = array_merge($path, array($key), $subPath);
                return $path;
            } elseif( (!$strict && $val == $needle) || ($strict && $val === $needle) ) {
                $path[] = $key;
                return $path;
            }
        }
        return false;
    }
        
        /**
         *
         * @param type $role
         * @return type 
         */
        public static function count_role($role = ''){
            
            
            $limit = ORM::factory('rolelimit')
                            ->where('role_id', '=', $role)
                            ->find();
            
            $count = ORM::factory('staffrole')
                            ->where('role_id', '=', $role)
                            ->find();
            
            if($count >= $limit){
                
            }
            return $count;
        }
        
        /**
         * Checks for access grants of logged in user.
         * @param array $user The user array to be checked 
         */
        public static function check_access_right($user, $position) {
            $result = FALSE;
            
            if(is_array($user)) $result = in_array($position, $user);
            
            return $result;
        }
        
//        public static function check_access_right($user, $position, $array = FALSE) {
//            $result = FALSE;
//            
//            if(is_array($user)) {
//                
//                foreach($position as $shrek) {
//                    $result = array_search($shrek, $user) ? FALSE : TRUE;
//                    break;
//                }
//            }
//            
//            return $result;
//        }
        
        
        /**
         * Converts array to object.
         * @param array $array The array to be passed.11
         */
        public static function array_to_object($array) {
            if(!is_array($array)) {
                return $array;
            }

            $object = new stdClass();
            if (is_array($array) && count($array) > 0) {
              foreach ($array as $name => $value) {
                 $name = strtolower(trim($name));
                 if (!empty($name)) {
                    $object->$name = $this->array_to_object($array);
                 }
              }
              return $object;
            }
            else {
              return FALSE;
            }
        }
 
        
    }