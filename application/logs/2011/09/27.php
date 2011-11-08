<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-09-27 00:00:37 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'staff_role_tb.staffs_id' in 'where clause' [ SELECT `role_tb`.* FROM `role_tb` JOIN `staff_role_tb` ON (`staff_role_tb`.`role_id` = `role_tb`.`role_id`) WHERE `staff_role_tb`.`staffs_id` = '' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-27 00:07:47 --- ERROR: Kohana_Exception [ 0 ]: The statuss property does not exist in the Model_Staff class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2011-09-27 00:08:17 --- ERROR: Database_Exception [ 1146 ]: Table 'db_oneraimol.staff_role' doesn't exist [ SELECT `role_tb`.* FROM `role_tb` JOIN `staff_role` ON (`staff_role`.`role_id` = `role_tb`.`role_id`) WHERE `staff_role`.`staff_id` = '' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-27 00:15:51 --- ERROR: Database_Exception [ 1146 ]: Table 'db_oneraimol.staff_role' doesn't exist [ SELECT `role_tb`.* FROM `role_tb` JOIN `staff_role` ON (`staff_role`.`role_id` = `role_tb`.`role_id`) WHERE `staff_role`.`staff_id` = '' ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2011-09-27 00:41:05 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: assets/css/jformger.css ~ SYSPATH\classes\kohana\request.php [ 760 ]
2011-09-27 00:53:20 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view cms/accounts/gridindex could not be found ~ SYSPATH\classes\kohana\view.php [ 252 ]
2011-09-27 00:54:05 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view cms/accounts/staff/staffgrid could not be found ~ SYSPATH\classes\kohana\view.php [ 252 ]
2011-09-27 00:59:31 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL cms/inventory/categoriess/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 94 ]
2011-09-27 01:33:07 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: user.jpg ~ SYSPATH\classes\kohana\request.php [ 760 ]
2011-09-27 06:01:25 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: user.jpg ~ SYSPATH\classes\kohana\request.php [ 760 ]