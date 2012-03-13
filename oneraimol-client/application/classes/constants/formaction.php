<?php defined('SYSPATH') or die('No direct script access.');

/**
 * ENUM of form actions.
 * 
 * @category   Constants
 * @author     Gerona, John Michael D.
 * @copyright  (c) 2011 DCDGLP
 */
    class Constants_FormAction {
        
        /**
         * @name Add form action
         */
        const ADD = 'add';
        
        /**
         * @name Edit form action
         */
        const EDIT = 'edit';
        
        /**
         * @name Delete form action
         */
        const DELETE = 'delete';
        
        /**
         * @name View form action
         */
        const VIEW = 'view';
        /**
         * @name Enable form action
         */
        const ENABLE = 'enable';
        /**
         * @name Multiple form action
         */
        const MULTIPLE = 'multiple';
        /**
         * @name Disable form action
         */
        const DISABLE = 'disable';
        
        /**
         * @name Approve form action
         */
        const APPROVE = 'approve';
        
        /**
         * @name Disapprove form action
         */
        const DISAPPROVE = 'disapprove';
        
        /**
         * @name Activated form action
         */
        const ACTIVATED = 'activated';
        /**
         * @name Not Activated form action
         */
        const NOT_ACTIVATED = 'not activated';
        /**
         * @name Search by Company
         */
        const COMPANY = 0;
        
        /**
         * @name Search by Order date
         */
        const ORDER_DATE = 1;
        
        /**
         * @name Search by Delivery date
         */
        const DELIVERY_DATE = 2;
        
        /**
         * @name All Display all records
         */
        const ALL = 'all';
    }