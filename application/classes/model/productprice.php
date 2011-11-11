<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Product price model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Productprice extends ORM {

        protected $_table_name  = 'product_price_tb';
        protected $_primary_key = 'product_price_id';
       
        protected $_belongs_to = array(
            'product' => array(
                'model' => 'product',
                'foreign_key' => 'product_id'
            ),
            'unitmaterial' => array(
                'model' => 'unitmaterialtype',
                'foreign_key' => 'um_id'
            )
        );
        
}