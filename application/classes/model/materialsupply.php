<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Material supply model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Materialsupply extends ORM {

        protected $_table_name  = 'material_supply_tb';
        protected $_primary_key = 'material_supply_id';
       
        protected $_has_many = array(
            'materialstocklevel' => array(
                'model' => 'materialstocklevel',
                'foreign_key' => 'stock_id'
            )
        );
        
        protected $_belongs_to = array(
            'materials' => array(
                'model' => 'material',
                'foreign_key' => 'material_id'
            ),
            'suppliers' => array(
                'model' => 'supplier',
                'foreign_key' => 'supplier_id'
            )
        );
        
}