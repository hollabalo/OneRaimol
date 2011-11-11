<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Unit material type model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Unitmaterialtype extends ORM {

        protected $_table_name  = 'unit_material_type_tb';
        protected $_primary_key = 'um_id';
       
        protected $_has_many = array(
            'poitems' => array(
                'model' => 'poitem',
                'foreign_key' => 'po_item_id'
            ),
            'productprice' => array(
                'model' => 'productprice',
                'foreign_key' => 'product_price_id'
            )
        );
}