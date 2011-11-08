<?php
class Model_Pwoitem extends ORM {

        //CHECK IF productionbatchtickets will work (probably not)
    
        protected $_table_name  = 'production_work_order_item_tb';
        protected $_primary_key = 'pwo_item_id';
       
        protected $_has_many = array(
            'productionbatchtickets' => array(
                'model' => 'pbt',
                'foreign_key' => 'pbt_id'
            )
        );
        
        protected $_belongs_to = array(
            'productionbatchtickets' => array(
                'model' => 'pbt',
                'foreign_key' => 'pbt_id'
            ),
            'poitems' => array(
                'model' => 'poitem',
                'foreign_key' => 'po_item_id'
            )
        );
}