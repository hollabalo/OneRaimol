<?php
class Model_Staffrole extends ORM {

        protected $_table_name  = 'staff_role_tb';
        
        protected $_belongs_to = array(
            'roles' => array(
                'model' => 'role',
                'foreign_key' => 'role_id'
            ), 
            'staffs' => array(
                'model' => 'staff',
                'foreign_key' => 'staff_id'
            )
        );
        
}