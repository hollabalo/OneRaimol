<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Role Limit model.
 * 
 * @category   Model
 * @author     Dizon, Theodore Earl G.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Rolelimit extends ORM {

        protected $_table_name  = 'role_limit_tb';
        protected $_primary_key = 'role_limit_id';
        
        protected $_belongs_to = array(
            'roles' => array(
                'model' => 'role',
                'foreign_key' => 'role_id'
            )
        );
        
}