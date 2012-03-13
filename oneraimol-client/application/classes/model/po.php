<?php  defined('SYSPATH') or die('No direct script access.');

/**
 * Purchase order model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Po extends ORM {

        //CHECK IF salesorders will work (probably not)
    
        protected $_table_name  = 'purchase_order_tb';
        protected $_primary_key = 'po_id';
       
        protected $_has_many = array(
            'salesorders' => array(
                'model' => 'so',
                'foreign_key' => 'so_id'
            ),
            'poitems' => array(
                'model' => 'poitem',
                'foreign_key' => 'po_id'
            )
        );
        
        protected $_belongs_to = array(
            'customers' => array(
                'model' => 'customer',
                'foreign_key' => 'customer_id'
            ),
            'deliveryreceipts' => array(
                'model' => 'deliveryreceipt',
                'foreign_key' => 'dr_id'
            ),
            'salesorders' => array (
                'model' => 'so',
                'foreign_key' => 'so_id'
            ),
            'deliveryaddresses' => array(
                'model' => 'deliveryaddress',
                'foreign_key' => 'delivery_address_id'
            )
        );
        
        /**
         * Gets the record status
         * @return string 
         */
        public function status() {
            $str = '';
            
            if($this->status == 1) $str = 'Approved';
            elseif($this->status == 2) $str = 'Disapproved';
            else $str = 'Pending';
            
            return $str;
        }

        /**
         * Gets the record status for display
         * @return string 
         */
        public function color_status() {
            $str = '';
            
            if($this->status == 1) $str = 'green';
            elseif($this->status == 2) $str = 'red';
            else $str = 'blue';
            
            return $str;
        }   
        
}