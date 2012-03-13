<?php
class Model_Categoryproduct extends ORM {

        protected $_table_name  = 'category_product_tb';
        protected $_primary_key = 'category_id_1';
        

        protected $_has_many = array(
            'products' => array(
                'model' => 'product',
                'foreign_key' => 'product_id'
            )
        );
        
       
}