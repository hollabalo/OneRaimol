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
            )
        );
        
        protected $_belongs_to = array(
            'issued' => array(
                'model' => 'staff',
                'foreign_key' => 'issued_by_approved'
            ),
            'noted' => array(
                'model' => 'staff',
                'foreign_key' => 'noted_by_approved'
            ),
            'approved' => array(
                'model' => 'staff',
                'foreign_key' => 'approved_by_approved'
            ),
            'received' => array(
                'model' => 'staff',
                'foreign_key' => 'received_by_approved'
            ),
        );
}