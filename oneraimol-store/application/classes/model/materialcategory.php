<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Materials category model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Materialcategory extends ORM {

        protected $_table_name  = 'material_category_tb';
        protected $_primary_key = 'category_id';
       
        protected $_has_many = array(
            'materials' => array(
                'model' => 'material',
                'foreign_key' => 'material_id'
            ),
            'products' => array(
                'model' => 'product',
                'foreign_key' => 'material_category_id'
            )
        );
        
        public function get_pk() {
            return 'CAT' . $this->pk();
        }
}