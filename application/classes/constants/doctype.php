<?php defined('SYSPATH') or die('No direct script access.');

/**
 * ENUM of document types.
 * 
 * @category   Constants
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
    class Constants_DocType {
        
        /**
         * @name Purchase Order type
         */
        const PURCHASE_ORDER = 1;
        
        /**
         * @name Sales order type
         */
        const SALES_ORDER = 2;
        
        /**
         * @name Production work order type
         */
        const PRODUCTION_WORK_ORDER = 3;
        
        /**
         * @name Formula type
         */
        const FORMULA = 4;
        
        /**
         * @name Production batch ticket type
         */
        const PRODUCTION_BATCH_TICKET = 5;
        
        /**
         * @name Delivery receipt type
         */
        const DELIVERY_RECEIPT = 6;
    }