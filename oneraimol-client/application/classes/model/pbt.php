<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Production batch ticket model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Pbt extends ORM {

        protected $_table_name  = 'production_batch_ticket_tb';
        protected $_primary_key = 'pbt_id';
     
        protected $_has_many = array(
            'pbtitems' => array(
                'model' => 'pbtitem',
                'foreign_key' => 'pbt_item_id'
            )
        );
        
        protected $_belongs_to = array(
            'formulas' => array(
                'model' => 'formula',
                'foreign_key' => 'formula_id'
            ),
            'prepared' => array(
                'model' => 'staff',
                'foreign_key' => 'labanalyst_approved'
            ),
            'checked_one' => array(
                'model' => 'staff',
                'foreign_key' => 'qa_approved'
            ),
            'checked_two' => array(
                'model' => 'staff',
                'foreign_key' => 'hc_approved'
            ),
            'noted' => array(
                'model' => 'staff',
                'foreign_key' => 'qa_head_approved'
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
            
            if ($this->release_flag == 1) {
                $str = 'Please Update PBT';
            }
            else if($this->release_flag == 3) {
                $str = 'PBT released';
            }
            else if($this->labanalyst_approved_status == 1 && $this->qa_approved_status == 1
                    && $this->hc_approved_status == 1 && $this->qa_head_approved_status ==1) {
                $str = 'Approved';
            }
            else if($this->labanalyst_approved_status == 2 && $this->qa_approved_status == 2
                    && $this->hc_approved_status == 2 && $this->qa_head_approved_status == 2 ) {
                $str = 'Disapproved';
                    }
             else $str = 'Pending Signatories';
             
             return $str;
        }
        
        public function doccolor_status() {
            $str = '';
            
            if ($this->release_flag == 1) {
                $str = 'blue';
            }
            else if($this->release_flag == 3) {
                $str = 'green';
            }
            else if($this->labanalyst_approved_status == 1 && $this->qa_approved_status ==1
                    && $this->hc_approved_status == 1 && $this->qa_head_approved_status ==1) {
                $str = 'green';
            }
            else if($this->labanalyst_approved_status == 2 && $this->qa_approved_status == 2
                    && $this->hc_approved_status == 2 && $this->qa_head_approved_status == 2 ) {
                $str = 'red';
                    }
             else $str = 'blue';
             
             return $str;
        }
}