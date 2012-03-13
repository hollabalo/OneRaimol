<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Staff logs model.
 * 
 * @category   Model
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Stafflog extends ORM {

        protected $_table_name  = 'staff_logs_tb';
        protected $_primary_key = 'staff_log_id';
        
        protected $_belongs_to = array(
            'staffs' => array(
                'model' => 'staff',
                'foreign_key' => 'staff_id'
            )
        );
        
}