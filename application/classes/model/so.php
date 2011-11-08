<?php
class Model_So extends ORM {

    //CHECK IF purchaseorders will work (probably not)
    
        protected $_table_name  = 'sales_order_tb';
        protected $_primary_key = 'so_id';
        
        protected $_has_many = array(
            'soitems' => array(
                'model' => 'soitem',
                'foreign_key' => 'so_item_id'
            ),
            'purchaseorders' => array(
                'model' => 'po',
                'foreign_key' => 'po_id'
            ),
            'deliveryreceipts' => array(
                'model' => 'deliveryreceipt',
                'foreign_key' => 'dr_id'
            )
        );
        
        protected $_belongs_to = array(
            'purchaseorders' => array(
                'model' => 'po',
                'foreign_key' => 'po_id'
            ),
            'salescoordinator' => array(
                'model' => 'staff',
                'foreign_key' => 'sc_approved'
            ),
            'generalmanager' => array(
                'model' => 'staff',
                'foreign_key' => 'gm_approved'
            ),
            'credit' => array(
                'model' => 'staff',
                'foreign_key' => 'acc_credit_approved'
            ),
            'collection' => array(
                'model' => 'staff',
                'foreign_key' => 'acc_collection_approved'
            )
        );
}