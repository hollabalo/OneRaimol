<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Tax cpdes model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Taxcode extends ORM {

    // CHECK IF taxcodes will work (probably not)
    
        protected $_table_name  = 'tax_code_tb';
        protected $_primary_key = 'tax_code_id';
       
        protected $_has_many = array(
            'soitems' => array(
                'model' => 'soitem',
                'foreign_key' => 'so_item_id'
            )
        );
        
        protected $_has_one = array(
            'taxcodes' => array(
                'model' => 'taxcode',
                'foreign_key' => 'tax_code_id'
            )
        );
        
        protected $_belongs_to = array(
            'taxcodes' => array(
                'model' => 'taxcode',
                'foreign_key' => 'tax_code_id'
            )
        );
}