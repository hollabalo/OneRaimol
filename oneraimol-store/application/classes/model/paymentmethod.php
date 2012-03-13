<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Payment method model.
 * 
 * @category   Model
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
class Model_Paymentmethod extends ORM {

        protected $_table_name  = 'payment_method_tb';
        protected $_primary_key = 'method_id';
       
        protected $_has_many = array(
            'salesorders' => array(
                'model' => 'so',
                'foreign_key' => 'so_id'
            )
        );
        
}