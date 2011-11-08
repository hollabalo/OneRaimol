<?php
class Model_Deliveryreceipt extends ORM {

    // CHECK IF purchaseorders will work (probably not)
    
        protected $_table_name  = 'delivery_receipt_tb';
        protected $_primary_key = 'dr_id';
        
        protected $_has_many = array(
            'purchaseorders' => array(
                'model' => 'po',
                'foreign_key' => 'po_id'
            )
        );
        
        protected $_belongs_to = array(
            'salesorders' => array(
                'model' => 'so',
                'foreign_key' => 'so_id'
            ),
            'purchaseorders' => array(
                'model' => 'po',
                'foreign_key' => 'po_id'
            ),
            'prepared' => array(
                'model' => 'staff',
                'foreign_key' => 'prepared_by_flag'
            ),
            'checked' => array(
                'model' => 'staff',
                'foreign_key' => 'checked_by_flag'
            ),
            'approved' => array(
                'model' => 'staff',
                'foreign_key' => 'approved_by_flag'
            ),
            'released' => array(
                'model' => 'staff',
                'foreign_key' => 'released_by_flag'
            )
        );
        
}