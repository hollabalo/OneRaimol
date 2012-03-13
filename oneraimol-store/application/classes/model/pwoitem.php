<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Production work order item model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
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
            'formulas' => array(
                'model' => 'formula',
                'foreign_key' => 'formula_id'
            ),
            'salesorders' => array(
                'model' => 'so',
                'foreign_key' => 'so_id'
            ),
            'productionworkorders' => array(
                'model' => 'pwo',
                'foreign_key' => 'pwo_id'
            )
        );
}