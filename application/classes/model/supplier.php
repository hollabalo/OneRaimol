<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Suppliers model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Supplier extends ORM {

        protected $_table_name  = 'supplier_tb';
        protected $_primary_key = 'supplier_id';
       
        protected $_has_many = array(
            'materialsupply' => array(
                'model' => 'materialsupply',
                'foreign_key' => 'material_supply_id'
            )
        );
}