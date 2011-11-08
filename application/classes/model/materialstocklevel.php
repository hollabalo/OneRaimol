<?php
class Model_Materialstocklevel extends ORM {

        protected $_table_name  = 'material_stock_level_tb';
        protected $_primary_key = 'stock_id';
       
        protected $_belongs_to = array(
            'materials' => array(
                'model' => 'material',
                'foreign_key' => 'material_id'
            )
        );
        
        protected $_has_many = array(
            'pbtitems' => array(
                'model' => 'pbtitem',
                'foreign_key' => 'pbt_item_id'
            )
        );
        
}