<?php defined('SYSPATH') or die('No direct script access.');

    return array(
        'leftselection' => array(
            'customer' => 'customer',
            'staff' => 'staff',
            'po' => 'po',
            'so' => 'so',
            'pwo' => 'pwo',
            'pbt' => 'pbt',
            'dr' => 'dr',
            'formula' => 'formula',
            'supplier' => 'supplier',
            'material' => 'material',
            'product' => 'product',
            'stock' => 'stock',
            'unit' => 'unit',
            'supplies' => 'supplies',
            'changepw' => 'change password',
            'stafflogs' => 'stafflogs',
            'rolelimit' => 'rolelimit',
            'salesdocuments' => 'salesdocuments'
        ),
        'intro' => array(
            'acctmgmt' => 'intro-accounts.png',
            'inventory' => 'intro-inventory.png',
            'sales' => 'intro-sales.png',
            'signatories' => 'intro-signatories.png',
            'production' => 'intro-production.png',
            'reports' => 'intro-reports.png',
            'systems' => 'system-settings.png'
        ),
        'crumb' => array (
            'img' => array (
                'acctmgmt' => 'menu-account.png',
                'inventory' => 'menu-inventory.png',
                'sales' => 'menu-sales.png',
                'signatories' => 'menu-signatories.png',
                'production' => 'menu-production.png',
                'reports' => 'menu-reports.png',
                'systems' => 'systemsettings.png',
                'profile' => 'profile.png',
                'error' => 'errorpage.png'
            ),
            'desc' => array (
                'acctmgmt' => 'Accounts Management',
                'inventory' => 'Materials Inventory',
                'sales' => 'Sales',
                'signatories' => 'Signatories',
                'production' => 'Production',
                'reports' => 'Reports',
                'systems' => 'System Settings',
                'rolelimit' => 'Role Limit',
                'profile' => 'Profile',
                'error' => array(
                    '404' => 'Page Not Found',
                    '500' => 'Internal Server Error'
                )
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
                'supplier' => 'Suppliers',
                'material' => 'Raw Materials',
                'product' => 'Products',
                'stock' => 'Stocks',
                'rawcat' => 'Raw Material Categories',
                'productcat' => 'Product Categories',
                'unit' => 'Unit of Measure',
                'supplies' => 'Supplies'
            ),
            'sales' => array(
                'so' => 'Sales Orders',
                'po' => 'Purchase Orders',
                'pwo' => 'Production Work Orders',
                'dr' => 'Delivery Receipt',
                'podetail' => 'Purchase Order Detail: #',
                'sodetail' => 'Sales Order Detail: #',
                'pwodetail' => 'Production Work Order',
                'salesdocuments' => 'Sales Documents'
            ),
            'signatories' => array(
                'so' => 'Sales Orders Approval',
                'pwo' => 'Production Work Orders Approval',
                'pbt' => 'Production Batch Tickets Approval',
                'formulas' => 'Formula Approval',
                'sodetail' => 'Sales Order Detail: #',
                'pwodetail' => 'Production Work Order Detail: #',
                'pbtdetail' => 'Production Batch Ticket Detail: #',
                'formuladetails' => 'Formula Detail: #',
                'drdetail' => 'Delivery Receipt Detail: # ',
            ),
            'production' => array(
                'pbt' => 'Production Batch Ticket',
                'pbtdetail' => 'Production Batch Ticket #',
                'formulas' => 'Formula',
                'formuladetails' => 'Formula Detail: # '
            ),
            'systems' => array (
                'stafflogs' => 'Site Activity Logs',
                'rolelimit' => 'Role Limit'
            ),
            'profile' => array (
                'staff' => 'Staff Profile'
            ),
            'reports' => array(
                'accounts' => array(
                    'customers' => 'List of Customers',
                    'staff' => 'List of Staffs'
                ),
                'inventory' => array(
                    'material' => 'Availability of Materials',
                    'product' => 'List of Products',
                    'stock' => 'List of Stocks',
                    'suppliers' => 'List of Suppliers'
                ),
                'production' => array(
                    'pbtapprove' => 'Approved Production Batch Tickets',
                    'pbtdisapprove' => 'Disapproved Production Batch Tickets',
                    'pbtpending' => 'Pending Production Batch Tickets'
                ),
                'sales' => array(
                    'poapprove' => 'Approved Purhcase Orders',
                    'soapprove' => 'Approved Sales Order',
                    'pwoapprove' => 'Approved Production Work Order',
                    'podisapprove' => 'Dispproved Purhcase Orders',
                    'sodisapprove' => 'Disapproved Sales Order',
                    'pwodisapprove' => 'Disapproved Production Work Order',
                    'popending' => 'Pending Purhcase Orders',
                    'sopending' => 'Pending Sales Order',
                    'pwopending' => 'Pending Production Work Order',
                ),
            ),
        ),
        'actions' => array(
            //staff
            'newstaff' => 'New Staff Account',
            'editstaff' => 'Edit Staff Account',
            'deletestaff' => 'Delete Staff Account',
            'enablestaff' => 'Enable Staff Account',
            'disablestaff' => 'Disable Staff Account',
            'viewstaff' => 'Staff ',
            'saveliststaff' => 'Save List of Staffs',
            //customer
            'newcustomer' => 'New Customer Account',
            'editcustomer' => 'Edit Customer Account',
            'deletecustomer' => 'Delete Customer Account',
            'enablecustomer' => 'Enable Customer Account',
            'disablecustomer' => 'Disable Customer Account',
            'viewcustomer' => 'Customer ',
            //search
            'search' => 'Search Result: ',
            //supplier
            'newsupplier' => 'New Supplier',
            'editsupplier' => 'Edit Supplier',
            'deletesupplier' => 'Delete Supplier',
            'viewsupplier' => 'Supplier ',
            'savesupplieraspdf' => 'Save Supplier as PDF',
            //material
            'newmaterial' => 'New Material',
            'editmaterial' => 'Edit Material',
            'viewmaterial' => 'List of Materials',
            'savematerialaspdf' => 'Save Materials as PDF',
            //product
            'newproduct' => 'New Product',
            'editproduct' => 'Edit Product',
            'deleteproduct' => 'Delete Product',
            //unit
            'newunit' => 'New Unit',
            'editunit' => 'Edit Unit',
            'deleteunit' => 'Delete Unit',
            'viewunit' => 'List of Units',
            'saveunitaspdf' => 'Save Unit of Measures as PDF',
            //supplies
            'newsupplies' => 'New Supplies',
            'editsupplies' => 'Edit Supplies',
            'deletesupplies' =>'Delete Supplies',
            'viewsupplies' => 'List of Supplies',
            'savesuppliesaspdf' => 'Save Supplies as PDF',
            //stock
            'newstock' => 'New Stock',
            'editstock' => 'Edit Stock',
            'deletestock' => 'Delete Stock',
            'viewstock' => 'List of Stocks',
            'savestockaspdf' => 'Save Stock as PDF',
            //changepw
            'changepw' => 'Change Password',
            
            'newpo' => 'New Purchase Order',
            'editpo' => 'Edit Purchase Order',
            'viewpo' => 'Purchase Order # ',
            'savepoaspdf' => 'Save Purchase Order as PDF',
            //so
            'soapprove' => 'Sales Order Approved ',
            'sodisapprove' => 'Sales Order Disapproved ',
            'viewso' => 'Sales Order # ',
            'savesoaspdf' => 'Save Sales Order as PDF',
            //pwo
            'pwoapprove' => 'Production Work Order Approved ',
            'pwodisapprove' => 'Production Work Order Disapproved ',
            'newpwo' => 'New Production Work Order',
            'editpwo' => 'Edit Production Work Order',
            'deletepwo' => 'Production Work Order Deleted',
            'viewpwo' => 'Production Work Order # ',
            'savepwoaspdf' => 'Save Production Work Order as PDF',
            //formula
            'newformula' => 'New Formula',
            'editformula' => 'Edit Formula',
            'formulaapprove' => 'Formula Approved ',
            'formuladisapprove' => 'Formula Disapproved ',
            'viewformula' => 'Formula # ',
            'saveformulaaspdf' => 'Save Formula as PDF',
            //pbt
            'updatepbt' => 'Update Production Batch Ticket',
            'pbtapprove' => 'Production Batch Ticket Approved ',
            'pbtdisapprove' => 'Production Batch Ticket Disapproved ',
            'viewpbt' => 'Production Batch Ticket # ',
            'savepbtaspdf' => 'Save Production Batch Ticket as PDF',
            //dr
            'newdr' => 'New Delivery Receipt',
            'drapprove' => 'Delivery Receipt Approved ',
            'drdisapprove' => 'Delivery Receipt Disapproved ',
            'viewdr' => 'Delivery Receipt # ',
            'savedraspdf' => 'Save Delivery Receipt as PDF',
            
            //role
            'newrole' => 'New Role',
            'editrole' => 'Edit Role'
        )
    );