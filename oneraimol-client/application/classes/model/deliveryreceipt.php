<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Delivery receipt model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Deliveryreceipt extends ORM {

    // CHECK IF purchaseorders will work (probably not)
    
        protected $_table_name  = 'delivery_receipt_tb';
        protected $_primary_key = 'dr_id';
        
        protected $_has_many = array(
            'purchaseorders' => array(
                'model' => 'po',
                'foreign_key' => 'po_id'
            )
        );
        
        protected $_belongs_to = array(
            'salesorders' => array(
                'model' => 'so',
                'foreign_key' => 'so_id'
            ),
            'purchaseorders' => array(
                'model' => 'po',
                'foreign_key' => 'po_id'
            ),
            'prepared' => array(
                'model' => 'staff',
                'foreign_key' => 'sc_approved'
            ),
            'checked' => array(
                'model' => 'staff',
                'foreign_key' => 'labanalyst_approved'
            ),
            'approved' => array(
                'model' => 'staff',
                'foreign_key' => 'gm_approved'
            ),
            'released' => array(
                'model' => 'staff',
                'foreign_key' => 'ic_approved'
            ),
            'received' => array(
                'model' => 'staff',
                'foreign_key' => 'pm_approved'
            )
        );
        
        /**
         * Gets the record status
         * @return string 
         */
        public function status() {
            $str = '';
            
            if($this->dr_status == 1) {
                $str = 'Pending for Approvals';
                }
            else if ($this->dr_status == 2) {
                $str = 'Ready for Delivery';
            }
            else if ($this->dr_status == 3) {
                $str = 'Delivered';
            }
            
            return $str;
        }

        /**
         * Gets the record status for display
         * @return string 
         */
        public function color_status() {
            $str = '';
            
            if($this->dr_status == 1) $str = 'blue';
            elseif($this->dr_status == 2) $str = 'red';
            else $str = 'green';
            
            return $str;
        } 
        
        /**
         * Gets the record status for display
         * @return string 
         */
        public function colorrole_status($role = '') {
            $str = '';
            
            if($this->$role == 1) $str = 'green';
            elseif($this->$role == 2) $str = 'red';
            else $str = 'blue';
            
            return $str;
        }  
        
        
        public function role_status($column = '') {
            $str = '';
                     
            if($this->$column == 1) $str = 'Approved';
            elseif($this->$column == 2) $str = 'Disapproved';
            else $str = 'Pending';
            
            return $str;  
        }
        
}