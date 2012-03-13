<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Role model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Role extends ORM {

        protected $_table_name  = 'role_tb';
        protected $_primary_key = 'role_id';
        
        protected $_has_many = array(
            'staffs' => array(
                'model' => 'staffrole',
                'foreign_key' => 'role_id'
            ),
            'rolelimits' => array(
                'model' => 'rolelimit',
                'foreign_key' => 'role_id'
            )
        );
        
}