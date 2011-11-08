<?php
class Model_Supplier extends ORM {

        protected $_table_name  = 'supplier_tb';
        protected $_primary_key = 'supplier_id';
       
        protected $_has_many = array(
            'materials' => array(
                'model' => 'material',
                'foreign_key' => 'material_id'
            )
        );
}