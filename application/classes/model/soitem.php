<?php
class Model_Soitem extends ORM {

        protected $_table_name  = 'sales_order_item_tb';
        protected $_primary_key = 'so_item_id';
       
        protected $_belongs_to = array(
            'poitems' => array(
                'model' => 'poitem',
                'foreign_key' => 'po_item_id'
            ),
            'taxcodes' => array(
                'model' => 'taxcode',
                'foreign_key' => 'tax_code_id'
            ),
            'salesorders' => array(
                'model' => 'so',
                'foreign_key' => 'so_id'
            )
        );
}