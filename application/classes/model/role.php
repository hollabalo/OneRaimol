<?php
class Model_Role extends ORM {

        protected $_table_name  = 'role_tb';
        protected $_primary_key = 'role_id';
        
        protected $_has_many = array(
            'staffs' => array(
                'model' => 'staffrole',
                'foreign_key' => 'role_id'
            )
        );
        
}