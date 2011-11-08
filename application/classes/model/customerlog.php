<?php
class Model_Customerlog extends ORM {

        protected $_table_name  = 'customer_logs_tb';
        protected $_primary_key = 'customer_logs_id';
        
        protected $_belongs_to = array(
            'customers' => array(
                'model' => 'customer',
                'foreign_key' => 'customer_id'
            )
        );
        
}