<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Materials stock level model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Materialstockusage extends ORM {

        protected $_table_name  = 'material_stock_usage_tb';
        protected $_primary_key = 'material_stock_usage_id';
       
        protected $_belongs_to = array(
            'materialstocklevels' => array(
                'model' => 'materialstocklevel',
                'foreign_key' => 'stock_id'
            )

        );

}