<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Production work order model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Pwo extends ORM {

        protected $_table_name  = 'production_work_order_tb';
        protected $_primary_key = 'pwo_id';
       
        protected $_has_many = array(
            'purchaseorders' => array( 
                'model' => 'po',
                'foreign_key' => 'po_id'
            ),
            'pwoitems' => array(
                'model' => 'pwoitem',
                'foreign_key' => 'pwo_id'
            ),
            'soitems' => array (
                'model' => 'soitem',
                'foreign_key' => 'so_item_id'
            ),
            'poitems' => array (
                'model' => 'poitem',
                'foreign_key' => 'po_item_id'
            )
        );
        
        protected $_belongs_to = array(
            'prepared' => array(
                'model' => 'staff',
                'foreign_key' => 'sc_approved'
            ),
            'noted' => array(
                'model' => 'staff',
                'foreign_key' => 'accountant_approved'
            ),
            'approved' => array(
                'model' => 'staff',
                'foreign_key' => 'hc_approved'
            )
        );
        
        /**
         * Gets the record status for display
         * @return string 
         */
        public function color_status($role = '') {
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
        
        public function doc_status() {
            $str = '';
            
            if($this->accountant_approved_status == 1 && $this->sc_approved_status == 1
               && $this->hc_approved_status == 1) {
                $str = 'Approved';
            }
            else if($this->accountant_approved_status == 2 && $this->sc_approved_status == 2
                    && $this->hc_approved_status == 2) {
                $str = 'Disapproved';
                    }
             else $str = 'Pending Signatories';
             
             return $str;
        }
        
        public function doccolor_status() {
            $str = '';
            
            if($this->accountant_approved_status == 1 && $this->sc_approved_status == 1
               && $this->hc_approved_status == 1) {
                $str = 'green';
            }
            else if($this->accountant_approved_status == 2 && $this->sc_approved_status == 2
                    && $this->hc_approved_status == 2) {
                $str = 'red';
                    }
             else $str = 'blue';
             
             return $str;
        }
}