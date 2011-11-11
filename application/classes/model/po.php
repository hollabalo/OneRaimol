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
                'foreign_key' => 'po_item_id'
            )
        );
        
        protected $_belongs_to = array(
            'customers' => array(
                'model' => 'customer',
                'foreign_key' => 'customer_id'
            ),
            'productionworkorders' => array(
                'model' => 'pwo',
                'foreign_key' => 'pwo_id'
            ),
            'salesorders' => array(
                'model' => 'so',
                'foreign_key' => 'so_id'
            ),
            'deliveryreceipts' => array(
                'model' => 'deliveryreceipt',
                'foreign_key' => 'dr_id'
            )
        );
        
}