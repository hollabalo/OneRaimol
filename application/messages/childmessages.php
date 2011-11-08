<?php

    return array(
        'leftselection' => array(
            'customer' => 'customer',
            'staff' => 'staff',
            'po' => 'po',
            'so' => 'so',
            'pwo' => 'pwo',
            'pbt' => 'pbt',
            'formula' => 'formula'
        ),
        'crumb' => array (
            'img' => array (
                'acctmgmt' => 'menu-account.png',
                'inventory' => 'menu-inventory.png',
                'sales' => 'menu-formula.png',
                'signatories' => 'menu-signatories.png',
                'production' => 'menu-tracking.png',
                'reports' => 'menu-reports.png'
            ),
            'desc' => array (
                'acctmgmt' => 'Accounts Management',
                'inventory' => 'Materials Inventory',
                'sales' => 'Sales',
                'signatories' => 'Signatories',
                'production' => 'Production',
                'reports' => 'Reports'
            )
        ),
        'page' => array(
            'acctmgmt' => array(
                'customer' => 'Customer Accounts',
                'staff' => 'Staff Accounts'
            ),
            'inventory' => array(
                'raw' => 'Raw Materials',
                'inventory' => 'Inventory',
                'suppliers' => 'Suppliers',
                'rawcat' => 'Raw Material Categories',
                'productcat' => 'Product Categories'
            ),
            'sales' => array(
                'so' => 'Sales Orders',
                'po' => 'Purchase Orders',
                'pwo' => 'Production Work Orders'
            ),
            'signatories' => array(
                'so' => 'Sales Orders',
                'pwo' => 'Production Work Orders',
                'pbt' => 'Production Batch Tickets',
                'formulas' => 'Formulas'
            ),
            'production' => array(
                'pbt' => 'Production Batch Ticket',
                'formulas' => 'Formulas'
            ),
        ),
        'actions' => array(
            'newstaff' => 'New Staff Account',
            'editstaff' => 'Edit Customer Account',
            'newcustomer' => 'New Customer Account',
            'editcustomer' => 'Edit Customer Account',
        )
    );