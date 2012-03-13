<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Delivery address model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Deliveryaddress extends ORM {

        protected $_table_name  = 'delivery_address_tb';
        protected $_primary_key = 'delivery_address_id';
        
        protected $_belongs_to = array(
            'customers' => array(
                'model' => 'customer',
                'foreign_key' => 'customer_id'
            )
        );
        
        protected $_has_many = array(
            'purchaseorders' => array(
                'model' => 'purchaseorder',
                'foreign_key' => 'delivery_address_id'
            )
        );
        
        /**
         * Gets the complete address for display
         * @return string
         */
        public function complete_address() {
            return $this->address . ', ' . $this->city . ', ' . $this->province . ', ' . $this->country;
        }
}