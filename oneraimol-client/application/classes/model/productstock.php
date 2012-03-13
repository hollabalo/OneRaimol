<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Products Stocks model.
 * 
 * @category   Model
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Productstock extends ORM {

        protected $_table_name  = 'product_stock_level_tb';
        protected $_primary_key = 'product_stock_id';
       

        protected $_belongs_to = array(
            'products' => array(
                'model' => 'product',
                'foreign_key' => 'product_id'
            )  
        );

        
}