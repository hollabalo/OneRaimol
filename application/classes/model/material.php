<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Materials model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Material extends ORM {

        protected $_table_name  = 'material_tb';
        protected $_primary_key = 'material_id';
       
        protected $_has_many = array(          
            'formuladetails' => array(
                'model' => 'formuladetail',
                'foreign_key' => 'formula_item_id'
            ),
            'materialsupply' => array(
                'model' => 'materialsupply',
                'foreign_key' => 'material_supply_id'
            )
        );
        
        protected $_belongs_to = array(
            'materialcategories' => array(
                'model' => 'materialcategory',
                'foreign_key' => 'material_category_id'
            )
        );
        
}