<?php defined('SYSPATH') or die('No direct script access.');

    return array (
        'accounts' => array (
            'staff' => array (
                'description' => 'This section shows the list of active and inactive customers and lets you edit the information on the list. ',
                'note' => 'NOTE:  in order to edit the details on customers, you must first click the “edit” icon, fill up the required fields, then click “Save Account” button.'),
            'customer' => array (
                'description' => 'This section shows the list of active and inactive staffs and lets you edit the information on the list. ',
                'note' => 'NOTE:  in order to edit the details on customers, you must first click the “edit” icon, fill up the required fields, then click “Save Account” button. '),
        ),
        'inventory' => array (
            'rawmaterials' => array (
                'description' => 'The list of raw materials and lets you add or delete on the list.',
                'note' => 'NOTE:  in order to edit the details on raw materials, you must first click the “edit” icon, fill up the required fields, then click “Save Material” button.'),
            'suppliers' => array (
                'description' => 'This shows the list and information about the suppliers. You can also edit the information on the list. To view the supplies, click the “Supplies” link.',
                'note' => 'NOTE: in order to edit the details on suppliers, you must first click the “edit” icon, fill up the required fields, then click “Save Supplier” button.',
            
                     'supplies' => array (
                          'description' => 'This shows the list and information about the supplies. You can also edit the information on the list. To view the supplies, click the “Supplies” link.',
                          'note' => 'NOTE: in order to edit the details on supplies, you must first click the “edit” icon, fill up the required fields, then click “Save Material” button.',
                      ),
             ),
            'finishedproducts'=> array (
                'description' => 'List of finished products are shown here. '
            ),
            'unitofmedium' => array (
                'description' => 'You can see the unit of medium of the products here.',
                'note' => 'NOTE: in order to edit the details on the unit of medium, you must first click the “edit” icon, fill up the required fields, then click “Save Unit” button.'),
            'stocks' => array (
                'description' => 'This section shows the information about the stocks available. ',
                'note' => 'NOTE: in order to edit the details on the unit of medium, you must first click the “edit” icon, fill up the required fields, then click “Save Stock” button.',
            ),
        ),
        'sales' => array (
            'purchaseorders' => array (
                'description' => 'You can see the status of all the purchase orders here.  By clicking the dropdown menu, you can filter the viewing options of the purchase orders.'),
            'salesorders' => array (
                'description' => 'This page displays the all the information on Sales orders'),
            'deliveries' => array (
                'description' => 'This page lets you view and add deliveries.'),
            ),
        'signatories' => array(
            'salesorders' => array(
                'description' => 'This page displays the current status of all the Sales Orders that are subject for signing and approval from the proper signatories. To approve or disapprove selected orders, click “details” link'),
            'productionworkorders' => array (
                'description' => 'This page displays the current status of all the Production Work Orders that are subject for signing and approval from the proper signatories. To approve or disapprove selected orders, click “details” link.'),
            'productionbatchticket' => array(
                'description'  => 'This page displays the current status of all the Production Batch Tickets that are subject for signing and approval from the proper signatories. To approve or disapprove selected orders, click “details” link.'),
            'formula' => array(
                'description' => 'This page displays the current status of all the formula created by the chemist that are subject for signing and approval from the proper signatories. To approve or disapprove selected orders, click “details” link.'),
        ),
        'production' => array(
            'productionworkorders' => array(
                'description' => 'Production work orders and the creation date are managed in this section. ',    
                'note' => 'NOTE: To manage each production work order, you must first click the “details”, choose the approved sales order items then click “add”, to add the selected item to the production work order list, then “save”.'),
            'productionbatchticket' => array(
                'description' => 'You can view and manage the list of Production Batch Tickets in this section.'),
            'formulas' => array(
                'description' => 'Formula are computed and formulated here.'),
         ),
         'reports' => array(
             'purchaseorders' => array(
                 'description' => 'This section displays the list of all Purchase Orders'),
             'salesorders' => array(
                 'description' => 'This section displays the list of all approved Sales Orders'),
             'productionworkorders' =>array(
                 'description' => 'This section displays the list of all approved Production Work Orders'),
             'deliveryreceipts' => array (
                 'description' =>'This section displays all delivery receipts'),
        ),          
   );