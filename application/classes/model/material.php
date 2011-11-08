<?php
class Model_Material extends ORM {

        protected $_table_name  = 'material_tb';
        protected $_primary_key = 'material_id';
       
        protected $_has_many = array(
            'stocklevels' => array(
                'model' => 'materialstocklevel',
                'foreign_key' => 'stock_id'
            ),           
            'formuladetails' => array(
                'model' => 'formuladetail',
                'foreign_key' => 'formula_item_id'
            )
        );
        
        protected $_belongs_to = array(
            'materialcategories' => array(
                'model' => 'materialcategory',
                'foreign_key' => 'material_category_id'
            ),
            'suppliers' => array(
                'model' => 'supplier',
                'foreign_key' => 'supplier_id'
            )
        );
        
}