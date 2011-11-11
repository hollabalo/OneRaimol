<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Customer model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Customer extends ORM {

        protected $_table_name  = 'customer_tb';
        protected $_primary_key = 'customer_id';
        
        protected $_has_many = array(
            'logs' => array(
                'model' => 'customerlog',
                'foreign_key' => 'customer_logs_id'
            ),
            'purchaseorders' => array(
                'model' => 'po',
                'foreign_key' => 'po_id'
            )
        );
        
        public function set_password() {
            if( strlen( $this->password ) != 30 ) {
                $this->password = SHA1( $this->password );
            }

            return $this;
        }
        
        /**
         * Gets the full name.
         * @return string 
         */
        public function full_name() {
            return $this->first_name . ' ' . $this->last_name;
        }
       
        /**
         * Gets the record status
         * @return string 
         */
        public function status() {
            return $this->status == 1 ? 'Active' : 'Inactive';
        }

        /**
         * Gets the record status for display
         * @return string 
         */
        public function color_status() {
            return $this->status == 1 ? 'green' : 'red';
        }

}