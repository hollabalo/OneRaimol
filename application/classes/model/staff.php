<?php
class Model_Staff extends ORM {

        protected $_table_name  = 'staff_tb';
        protected $_primary_key = 'staff_id';

        protected $_created_column = array('column' => 'date_created', 'format' => 'Y:m:d H:m:s');
        
        protected $_has_many = array(
            'roles' => array(
                'model' => 'staffrole',
                'foreign_key' => 'staff_id'
            ),
            
            // START SO
            'so_genaralmanager' => array(
                'model' => 'so',
                'foreign_key' => 'so_id'
            ),
            'so_salescoordinator' => array(
                'model' => 'so',
                'foreign_key' => 'so_id'
            ),
            'so_credit' => array(
                'model' => 'so',
                'foreign_key' => 'so_id'
            ),
            'so_collection' => array(
                'model' => 'so',
                'foreign_key' => 'so_id'
            ),
            // END SO
            
            // START PWO
            'pwo_issued' => array(
                'model' => 'pwo',
                'foreign_key' => 'pwo_id'
            ),
            'pwo_noted' => array(
                'model' => 'pwo',
                'foreign_key' => 'pwo_id'
            ),
            'pwo_approved' => array(
                'model' => 'pwo',
                'foreign_key' => 'pwo_id'
            ),
            'pwo_received' => array(
                'model' => 'pwo',
                'foreign_key' => 'pwo_id'
            ),
            // END PWO
            
            // START PBT
            'pbt_productionstaff' => array(
                'model' => 'pbt',
                'foreign_key' => 'pbt_id'
            ),
            'pbt_qa' => array(
                'model' => 'pbt',
                'foreign_key' => 'pbt_id'
            ),
            'pbt_chemist' => array(
                'model' => 'pbt',
                'foreign_key' => 'pbt_id'
            ),
            'pbt_qahead' => array(
                'model' => 'pbt',
                'foreign_key' => 'pbt_id'
            ),
            // END PBT
            
            // START DELIVERY RECEIPT
            'dr_prepared' => array(
                'model' => 'deliveryreceipt',
                'foreign_key' => 'dr_id'
            ),
            'dr_checked' => array(
                'model' => 'deliveryreceipt',
                'foreign_key' => 'dr_id'
            ),
            'dr_approved' => array(
                'model' => 'deliveryreceipt',
                'foreign_key' => 'dr_id'
            ),
            'dr_released' => array(
                'model' => 'deliveryreceipt',
                'foreign_key' => 'dr_id'
            ),
            // END DELIVERY RECEIPT
            
            
        );
        
        public function staff_id() {
            $trail = 4 - strlen($this->staff_id);
            $id = '';
            
            for($i=0;$i<$trail;$i++) $id .= 0;
            
            return 's' . $id;
        }
        
        public function full_name() {
            return ucfirst($this->first_name) . ' ' . ucfirst($this->middle_name) . ' ' . ucfirst($this->last_name);
        }
        
        public function status() {
            return $this->status == 1 ? 'Active' : 'Inactive';
        }

        public function color_status() {
            return $this->status == 1 ? 'green' : 'red';
        }

}