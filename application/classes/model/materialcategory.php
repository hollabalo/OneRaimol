<?php
class Model_Materialcategory extends ORM {

        protected $_table_name  = 'material_category_tb';
        protected $_primary_key = 'category_id';
       
        protected $_has_many = array(
            'materials' => array(
                'model' => 'material',
                'foreign_key' => 'material_id'
            )  
        );
        
}