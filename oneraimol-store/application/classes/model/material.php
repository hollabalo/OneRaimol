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
            'materialsupply' => array(
                'model' => 'materialsupply',
                'foreign_key' => 'material_id'
            ),
            'materialstocklevel' => array(
                'model' => 'materialstocklevel',
                'foreign_key' => 'stock_id'
            )
        );
        
        protected $_belongs_to = array(
            'materialcategories' => array(
                'model' => 'materialcategory',
                'foreign_key' => 'material_category_id'
            )
        );
        
        public function get_pk() {
            return 'MAT' . $this->pk();
        }
}