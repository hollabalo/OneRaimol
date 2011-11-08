<?php
class Model_Unitmaterialtype extends ORM {

        protected $_table_name  = 'unit_material_type_tb';
        protected $_primary_key = 'um_id';
       
        protected $_has_many = array(
            'poitems' => array(
                'model' => 'poitem',
                'foreign_key' => 'po_item_id'
            )
        );
}