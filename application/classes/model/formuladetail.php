<?php
class Model_Formuladetail extends ORM {

        protected $_table_name  = 'formula_detail_tb';
        protected $_primary_key = 'formula_item_id';
        
        protected $_has_many = array(
            'pbtitems' => array(
                'model' => 'pbtitem',
                'foreign_key' => 'pbt_item_id'
            )
        );
        
        protected $_belongs_to = array(
            'materials' => array(
                'model' => 'material',
                'foreign_key' => 'material_id'
            ),
            'formulas' => array(
                'model' => 'formula',
                'foreign_key' => 'formula_id'
            )
        );
        
}