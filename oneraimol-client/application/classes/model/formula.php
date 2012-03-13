<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Formula model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Formula extends ORM {

        protected $_table_name  = 'formula_tb';
        protected $_primary_key = 'formula_id';
        
        protected $_has_many = array(
            'productionbatchtickets' => array(
                'model' => 'pbt',
                'foreign_key' => 'pbt_id'
            ),
            'formuladetails' => array(
                'model' => 'formuladetail',
                'foreign_key' => 'formula_id'
            )
        );
        
        protected $_belongs_to = array(
            'poitems' => array(
                'model' => 'poitem',
                'foreign_key' => 'po_item_id'
            ),
            'pwoitems' => array (
                'model' => 'pwoitem',
                'foreign_key' => 'pwo_item_id'
            ),
            'approved' => array(
                'model' => 'staff',
                'foreign_key' => 'ceo_approved'
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
            
            if($this->ceo_approved_status == 1) {
                $str = 'Approved';
            }
            else if($this->ceo_approved_status == 2) {
                $str = 'Disapproved';
                    }
             else $str = 'Pending Signatories';
             
             return $str;
        }
        
        public function doccolor_status() {
            $str = '';
            
            if($this->ceo_approved_status == 1) {
                $str = 'green';
            }
            else if($this->ceo_approved_status == 2) {
                $str = 'red';
                    }
             else $str = 'blue';
             
             return $str;
        }
}