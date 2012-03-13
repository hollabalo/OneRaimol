<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Sales order model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_So extends ORM {

    //CHECK IF purchaseorders will work (probably not)
    
        protected $_table_name  = 'sales_order_tb';
        protected $_primary_key = 'so_id';
        
        protected $_has_many = array(
            'soitems' => array(
                'model' => 'soitem',
                'foreign_key' => 'so_id'
            ),
            'purchaseorders' => array(
                'model' => 'po',
                'foreign_key' => 'po_id'
            ),
            'deliveryreceipts' => array(
                'model' => 'deliveryreceipt',
                'foreign_key' => 'dr_id'
            ),
            'pwoitems' => array(
                'model' => 'pwoitem',
                'foreign_key' => 'pwo_item_id'
            )
        );
        
        protected $_belongs_to = array(
            'purchaseorders' => array(
                'model' => 'po',
                'foreign_key' => 'po_id'
            ),
            'salescoordinator' => array(
                'model' => 'staff',
                'foreign_key' => 'sc_approved'
            ),
            'generalmanager' => array(
                'model' => 'staff',
                'foreign_key' => 'gm_approved'
            ),
            'credit' => array(
                'model' => 'staff',
                'foreign_key' => 'acc_credit_approved'
            ),
            'collection' => array(
                'model' => 'staff',
                'foreign_key' => 'acc_collection_approved'
            ),
            'paymentmethod' => array(
                'model' => 'paymentmethod',
                'foreign_key' => 'payment_method'
            )
        );
        
        /**
         * @var string approvalstatus The Approval status
         */
        public $approvalstatus = '';
        
        /**
         * @var string color The color
         */
        public $color = '';
        
        /**
         * Gets the document status.
         * @return string 
         */
        public function get_status() {
            if($this->purchaseorders->status == Constants_DocType::PURCHASE_ORDER) {
                return 'PO';
            }
            else if($this->purchaseorders->status == Constants_DocType::SALES_ORDER) {
                return 'SO';
            }
            else if($this->purchaseorders->status == Constants_DocType::FORMULA) {
                return 'Formula Pending';
            }
            else if($this->purchaseorders->status == Constants_DocType::PRODUCTION_WORK_ORDER) {
                return 'PWO';
            }
            else if($this->purchaseorders->status == Constants_DocType::PRODUCTION_BATCH_TICKET) {
                return 'PBT';
            }
            else if($this->purchaseorders->status == Constants_DocType::DELIVERY_RECEIPT) {
                return 'DR';
            }
        }
        
//        /**
//         * Gets the record status for display
//         * @return string 
//         */
//        public function color_status() {
//            
//            if(is_array(Session::instance()->get('userid'))) {
//                
//            }
//            
//            return $this->status == 1 ? 'green' : 'red';
//        }
        
 
        
        /**
         * Gets the approval status of the sales order.
         * @return string
         */
        public function get_approval() {

            if(is_array(Session::instance()->get('roles'))) {
                return 'Multiple';
            }
            else {
                $this->approvalstatus = 'Error';
                // Get role
                $role = Session::instance()->get('roles');
                
                if($role == (string)Constants_UserType::SALES_REPRESENTATIVE) {
                    $this->approvalstatus = is_null($this->sc_approved) ? 'No' : 'Yes';
                }
                else if($role == (string)Constants_UserType::GENERAL_MANAGER) {
                    $this->approvalstatus = is_null($this->gm_approved) ? 'No' : 'Yes';
                }
                else if($role == (string)Constants_UserType::ACCOUNTING) {
                    $this->approvalstatus = is_null($this->acc_credit_approved) ? 'No' : 'Yes';
                    $this->approvalstatus = is_null($this->acc_collection_approved) ? 'No' : 'Yes';
                }

                return $this->approvalstatus;
            }
        }
        
        public function get_color() {
            $this->color = $this->approvalstatus == 'Yes' ? 'Green' : 'Red';
        }
        
        
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
        

}