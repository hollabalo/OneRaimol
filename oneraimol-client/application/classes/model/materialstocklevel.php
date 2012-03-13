<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Materials stock level model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Materialstocklevel extends ORM {

        protected $_table_name  = 'material_stock_level_tb';
        protected $_primary_key = 'stock_id';
       
        protected $_belongs_to = array(
            'materialsupply' => array(
                'model' => 'materialsupply',
                'foreign_key' => 'material_supply_id'
            ),
            'materials' => array(
                'model' => 'material',
                'foreign_key' => 'material_id'
            )
        );
        
        protected $_has_many = array(
            'pbtitems' => array(
                'model' => 'pbtitem',
                'foreign_key' => 'pbt_item_id'
            ),
            'formuladetails' => array(
                'model' => 'formuladetail',
                'foreign_key' => 'formula_item_id'
            ),
            'materialstockusages' => array(
                'model' => 'materialstockusage',
                'foreign_key' => 'material_stock_usage'
            ),
        );
        
        public function get_pk() {
            return 'STK' . $this->pk();
        }
        
}