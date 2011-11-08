/*
SQLyog Ultimate - MySQL GUI v8.22 
MySQL - 5.1.41 : Database - db_oneraimol
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_oneraimol` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_oneraimol`;

/*Table structure for table `customer_logs_tb` */

DROP TABLE IF EXISTS `customer_logs_tb`;

CREATE TABLE `customer_logs_tb` (
  `customer_logs_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `action` varchar(1000) NOT NULL,
  `time_of_action` time NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `date_of_action` date NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`customer_logs_id`),
  KEY `FK_customer_logs_tb` (`customer_id`),
  CONSTRAINT `FK_customer_logs_tb` FOREIGN KEY (`customer_id`) REFERENCES `customer_tb` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `customer_logs_tb` */

/*Table structure for table `customer_tb` */

DROP TABLE IF EXISTS `customer_tb`;

CREATE TABLE `customer_tb` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `company_address` varchar(200) NOT NULL,
  `primary_email` varchar(50) NOT NULL,
  `secondary_email` varchar(50) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `telephone_no` varchar(20) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `customer_tb` */

/*Table structure for table `delivery_receipt_tb` */

DROP TABLE IF EXISTS `delivery_receipt_tb`;

CREATE TABLE `delivery_receipt_tb` (
  `dr_id` varchar(20) NOT NULL,
  `so_id` varchar(20) DEFAULT NULL,
  `po_id` varchar(20) DEFAULT NULL,
  `prepared_by_flag` int(11) DEFAULT NULL,
  `checked_by_flag` int(11) DEFAULT NULL,
  `approved_by_flag` int(11) DEFAULT NULL,
  `released_by_flag` int(11) DEFAULT NULL,
  `received_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`dr_id`),
  KEY `FK_delivery_receipt_tb` (`so_id`),
  KEY `FK_delivery_receipt2_tb` (`po_id`),
  KEY `FK_delivery_1_tb` (`released_by_flag`),
  KEY `FK_delivery_2_tb` (`approved_by_flag`),
  KEY `FK_delivery_3_tb` (`checked_by_flag`),
  KEY `FK_delivery_4_tb` (`prepared_by_flag`),
  CONSTRAINT `FK_delivery_1_tb` FOREIGN KEY (`released_by_flag`) REFERENCES `staff_tb` (`staff_id`),
  CONSTRAINT `FK_delivery_2_tb` FOREIGN KEY (`approved_by_flag`) REFERENCES `staff_tb` (`staff_id`),
  CONSTRAINT `FK_delivery_3_tb` FOREIGN KEY (`checked_by_flag`) REFERENCES `staff_tb` (`staff_id`),
  CONSTRAINT `FK_delivery_4_tb` FOREIGN KEY (`prepared_by_flag`) REFERENCES `staff_tb` (`staff_id`),
  CONSTRAINT `FK_delivery_receipt2_tb` FOREIGN KEY (`po_id`) REFERENCES `purchase_order_tb` (`po_id`),
  CONSTRAINT `FK_delivery_receipt_tb` FOREIGN KEY (`so_id`) REFERENCES `sales_order_tb` (`so_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `delivery_receipt_tb` */

/*Table structure for table `formula_detail_tb` */

DROP TABLE IF EXISTS `formula_detail_tb`;

CREATE TABLE `formula_detail_tb` (
  `formula_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `formula_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `vol_per_liter` int(5) DEFAULT NULL,
  PRIMARY KEY (`formula_item_id`),
  KEY `FK_formula_detail_tb` (`formula_id`),
  KEY `FK_formula_detail2_tb` (`material_id`),
  CONSTRAINT `FK_formula_detail2_tb` FOREIGN KEY (`material_id`) REFERENCES `material_tb` (`material_id`),
  CONSTRAINT `FK_formula_detail_tb` FOREIGN KEY (`formula_id`) REFERENCES `formula_tb` (`formula_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `formula_detail_tb` */

/*Table structure for table `formula_tb` */

DROP TABLE IF EXISTS `formula_tb`;

CREATE TABLE `formula_tb` (
  `formula_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_item_id` int(11) NOT NULL,
  `date_created` date DEFAULT NULL,
  `ceo_approved` tinyint(1) DEFAULT '0',
  `chemist` int(11) DEFAULT NULL,
  PRIMARY KEY (`formula_id`),
  KEY `FK_formula_tb` (`po_item_id`),
  CONSTRAINT `FK_formula_tb` FOREIGN KEY (`po_item_id`) REFERENCES `purchase_order_item_tb` (`po_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `formula_tb` */

/*Table structure for table `material_category_tb` */

DROP TABLE IF EXISTS `material_category_tb`;

CREATE TABLE `material_category_tb` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(35) DEFAULT NULL,
  `parent_category_1` int(11) DEFAULT NULL,
  `parent_category_2` int(11) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `material_category_tb` */

insert  into `material_category_tb`(`category_id`,`description`,`parent_category_1`,`parent_category_2`) values (1,'Industrial',NULL,NULL),(2,'Lubricants',1,NULL),(3,'Compressor Oils',1,2),(4,'Gear Oils',1,2),(5,'Hydraulic Oils',1,2),(6,'Slideway Oils',1,2),(7,'Spindle Oils',1,2),(8,'Turbine Oils',1,2),(9,'Refrigeration Oils',1,2),(10,'Metal Working Fluid',1,NULL),(11,'Stamping Oils',1,NULL),(12,'Die Casting',1,NULL),(13,'Cleaners',1,NULL),(14,'Corrosion Preventive',1,NULL),(15,'Transformer Oil',1,NULL),(16,'Automotive',NULL,NULL),(17,'Motorcycle Oils',16,NULL),(18,'Gasoline Engine Oil',16,NULL),(19,'Diesel Engine Oil',16,NULL),(20,'Automatic Transmission',16,NULL),(21,'Gear Oils',16,NULL),(22,'Marine',NULL,NULL),(23,'Greases',NULL,NULL),(24,'Aerosols',NULL,NULL);

/*Table structure for table `material_stock_level_tb` */

DROP TABLE IF EXISTS `material_stock_level_tb`;

CREATE TABLE `material_stock_level_tb` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_id` int(11) NOT NULL,
  `stock_taking_date` date NOT NULL,
  `quantity` int(5) NOT NULL,
  PRIMARY KEY (`stock_id`),
  KEY `FK_material_stock_level_tb` (`material_id`),
  CONSTRAINT `FK_material_stock_level_tb` FOREIGN KEY (`material_id`) REFERENCES `material_tb` (`material_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `material_stock_level_tb` */

/*Table structure for table `material_supply_tb` */

DROP TABLE IF EXISTS `material_supply_tb`;

CREATE TABLE `material_supply_tb` (
  `material_supply_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `price` int(9) DEFAULT NULL,
  PRIMARY KEY (`material_supply_id`),
  KEY `FK_material_suhpply_tb` (`material_id`),
  KEY `FK_material_supply_tb` (`supplier_id`),
  CONSTRAINT `FK_material_supply_tb` FOREIGN KEY (`supplier_id`) REFERENCES `supplier_tb` (`supplier_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_material_suhpply_tb` FOREIGN KEY (`material_id`) REFERENCES `material_tb` (`material_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `material_supply_tb` */

/*Table structure for table `material_tb` */

DROP TABLE IF EXISTS `material_tb`;

CREATE TABLE `material_tb` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(30) NOT NULL,
  `material_category_id` int(11) DEFAULT NULL,
  `reorder_level` int(5) DEFAULT NULL,
  PRIMARY KEY (`material_id`),
  KEY `FK_material_tb` (`material_category_id`),
  CONSTRAINT `FK_material_tb` FOREIGN KEY (`material_category_id`) REFERENCES `material_category_tb` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `material_tb` */

/*Table structure for table `payment_method_tb` */

DROP TABLE IF EXISTS `payment_method_tb`;

CREATE TABLE `payment_method_tb` (
  `method_id` int(5) NOT NULL AUTO_INCREMENT,
  `description` varchar(15) NOT NULL,
  PRIMARY KEY (`method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `payment_method_tb` */

/*Table structure for table `product_tb` */

DROP TABLE IF EXISTS `product_tb`;

CREATE TABLE `product_tb` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `material_category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `FK_product_tb` (`material_category_id`),
  CONSTRAINT `FK_product_tb` FOREIGN KEY (`material_category_id`) REFERENCES `material_category_tb` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

/*Data for the table `product_tb` */

insert  into `product_tb`(`product_id`,`name`,`material_category_id`) values (1,'Compro 32',3),(2,'Compro 46',3),(3,'Compro 68',3),(4,'Compro 100',3),(5,'Compro 150',3),(6,'Gear 68',4),(7,'Gear 100',4),(8,'Gear 150',4),(9,'Gear 220',4),(10,'Gear 320',4),(11,'Gear 460',4),(12,'Reindro 10W',5),(13,'Reindro 22',5),(14,'Reindro 32',5),(15,'Reindro 46',5),(16,'Reindro 68',5),(17,'Reindro SWG',5),(18,'Waylube 32',6),(19,'Waylube 46',6),(20,'Waylube 68',6),(21,'Waylube 100',6),(22,'Waylube 150',6),(23,'Spindle Oils',7),(24,'Low Tox',8),(25,'Hydro T32',8),(26,'Hydro T46',8),(27,'Hydro T68',8),(28,'Hydro TS68',8),(29,'Refro 32',9),(30,'Refro 68',9),(31,'Refro 100',9),(32,'Lubricool EM',10),(33,'Lubricool FS',10),(34,'Lubricool SS',10),(35,'Lubricool ST',10),(36,'Qbath',10),(37,'Hono',10),(38,'FD Stamp',11),(39,'SD Stamp',11),(40,'OT Stamp',11),(41,'P-Lube',12),(42,'NS Die Lube',12),(43,'Deg WS',13),(44,'Degsol',13),(45,'Antiro',14),(46,'Antiro-ax',14),(47,'Trans',15),(48,'Flash 4T and 2T',16),(49,'Gelo Super20W50',17),(50,'Lubro SAE40 CF-4 & CD',18),(51,'Lubro 15W40 CF-4',18),(52,'Merd-X',19),(53,'Spiro 90',20),(54,'Spiro 140',20),(55,'Bio 21',21),(56,'Low Tox',21),(57,'Lubro M30r',21),(58,'Lubro M40r',21),(59,'Lubro M50r',21),(60,'Multi-Purpose Grease',22),(61,'Chassis Grease',22),(62,'Lithium Complex EP Grease',22),(63,'Non-Melt Grease',22),(64,'Food Machinery Grease',22),(66,'Contact Cleaner',23),(67,'Penetrating Oil',23),(68,'Anti-Rust Oil',23),(69,'Brake Cleaner',23);

/*Table structure for table `production_batch_ticket_item_tb` */

DROP TABLE IF EXISTS `production_batch_ticket_item_tb`;

CREATE TABLE `production_batch_ticket_item_tb` (
  `pbt_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `pbt_id` varchar(20) NOT NULL,
  `formula_item_id` int(11) NOT NULL,
  `ref_no` varchar(20) DEFAULT NULL,
  `req_qty` int(5) DEFAULT NULL,
  `actual_qty` int(5) DEFAULT NULL,
  `req_unit` varchar(10) DEFAULT NULL,
  `actual_unit` varchar(10) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `stock_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pbt_item_id`),
  KEY `FK_production_batch_ticket_item_tb` (`formula_item_id`),
  KEY `FK_production_batch_item_tb` (`stock_id`),
  KEY `fdhfg` (`pbt_id`),
  CONSTRAINT `fdhfg` FOREIGN KEY (`pbt_id`) REFERENCES `production_batch_ticket_tb` (`pbt_id`),
  CONSTRAINT `FK_production_batch_item_tb` FOREIGN KEY (`stock_id`) REFERENCES `material_stock_level_tb` (`stock_id`),
  CONSTRAINT `FK_production_batch_ticket_item_tb` FOREIGN KEY (`formula_item_id`) REFERENCES `formula_detail_tb` (`formula_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `production_batch_ticket_item_tb` */

/*Table structure for table `production_batch_ticket_tb` */

DROP TABLE IF EXISTS `production_batch_ticket_tb`;

CREATE TABLE `production_batch_ticket_tb` (
  `pbt_id` varchar(20) NOT NULL,
  `pwo_item_id` int(11) NOT NULL,
  `formula_id` int(11) NOT NULL,
  `release_date` date DEFAULT NULL,
  `released_by` varchar(50) DEFAULT NULL,
  `blending_time_required` varchar(10) DEFAULT NULL,
  `amount_per_qty` int(5) DEFAULT NULL,
  `py_theoretical` int(5) DEFAULT NULL,
  `py_actual` int(5) DEFAULT NULL,
  `machine_desc` varchar(100) DEFAULT NULL,
  `blending_time` varchar(10) DEFAULT NULL,
  `production_performed_by` varchar(50) DEFAULT NULL,
  `date_produced` date DEFAULT NULL,
  `production_staff_approved` int(11) DEFAULT NULL,
  `qa_approved` int(11) DEFAULT NULL,
  `chemist_approved` int(11) DEFAULT NULL,
  `qa_head_approved` int(11) DEFAULT NULL,
  PRIMARY KEY (`pbt_id`),
  KEY `FK_production_batch_ticket_tb` (`pwo_item_id`),
  KEY `FK_production_batch_ticket2_tb` (`formula_id`),
  KEY `FK_production_batch_ticket3_tb` (`production_staff_approved`),
  KEY `FK_production_batch_ticke3t_tb` (`qa_approved`),
  KEY `FK_production_batc3h_ticket_tb` (`chemist_approved`),
  KEY `FK_production_3batch_ticket_tb` (`qa_head_approved`),
  CONSTRAINT `FK_production_3batch_ticket_tb` FOREIGN KEY (`qa_head_approved`) REFERENCES `staff_tb` (`staff_id`),
  CONSTRAINT `FK_production_batc3h_ticket_tb` FOREIGN KEY (`chemist_approved`) REFERENCES `staff_tb` (`staff_id`),
  CONSTRAINT `FK_production_batch_ticke3t_tb` FOREIGN KEY (`qa_approved`) REFERENCES `staff_tb` (`staff_id`),
  CONSTRAINT `FK_production_batch_ticket2_tb` FOREIGN KEY (`formula_id`) REFERENCES `formula_tb` (`formula_id`),
  CONSTRAINT `FK_production_batch_ticket3_tb` FOREIGN KEY (`production_staff_approved`) REFERENCES `staff_tb` (`staff_id`),
  CONSTRAINT `FK_production_batch_ticket_tb` FOREIGN KEY (`pwo_item_id`) REFERENCES `production_work_order_item_tb` (`pwo_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `production_batch_ticket_tb` */

/*Table structure for table `production_work_order_item_tb` */

DROP TABLE IF EXISTS `production_work_order_item_tb`;

CREATE TABLE `production_work_order_item_tb` (
  `pwo_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(15) DEFAULT NULL,
  `po_item_id` int(11) NOT NULL,
  `pbt_id` varchar(20) DEFAULT NULL,
  `dr_flag` tinyint(1) DEFAULT NULL,
  `invoice_flag` tinyint(1) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`pwo_item_id`),
  KEY `FK2_production_work_order_item_tb` (`pbt_id`),
  KEY `FK_production_wem_tb` (`po_item_id`),
  CONSTRAINT `FK2_production_work_order_item_tb` FOREIGN KEY (`pbt_id`) REFERENCES `production_batch_ticket_tb` (`pbt_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_production_wem_tb` FOREIGN KEY (`po_item_id`) REFERENCES `purchase_order_item_tb` (`po_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `production_work_order_item_tb` */

/*Table structure for table `production_work_order_tb` */

DROP TABLE IF EXISTS `production_work_order_tb`;

CREATE TABLE `production_work_order_tb` (
  `pwo_id` varchar(20) NOT NULL,
  `issued_by_approved` int(11) DEFAULT NULL,
  `noted_by_approved` int(11) DEFAULT NULL,
  `approved_by_approved` int(11) DEFAULT NULL,
  `received_by_approved` int(11) DEFAULT NULL,
  PRIMARY KEY (`pwo_id`),
  KEY `FK_production_work_order_tb` (`issued_by_approved`),
  KEY `gfd` (`noted_by_approved`),
  KEY `fs` (`approved_by_approved`),
  KEY `ds` (`received_by_approved`),
  CONSTRAINT `ds` FOREIGN KEY (`received_by_approved`) REFERENCES `staff_tb` (`staff_id`),
  CONSTRAINT `FK_production_work_order_tb` FOREIGN KEY (`issued_by_approved`) REFERENCES `staff_tb` (`staff_id`),
  CONSTRAINT `fs` FOREIGN KEY (`approved_by_approved`) REFERENCES `staff_tb` (`staff_id`),
  CONSTRAINT `gfd` FOREIGN KEY (`noted_by_approved`) REFERENCES `staff_tb` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `production_work_order_tb` */

/*Table structure for table `purchase_order_item_tb` */

DROP TABLE IF EXISTS `purchase_order_item_tb`;

CREATE TABLE `purchase_order_item_tb` (
  `po_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id` varchar(20) NOT NULL,
  `po_no` varchar(20) DEFAULT NULL,
  `product_description` varchar(60) NOT NULL,
  `qty` int(5) NOT NULL,
  `unit_material` int(11) NOT NULL,
  PRIMARY KEY (`po_item_id`),
  KEY `FK_purchase_order_item_tb` (`po_id`),
  KEY `ter` (`unit_material`),
  CONSTRAINT `FK_purchase_order_item_tb` FOREIGN KEY (`po_id`) REFERENCES `purchase_order_tb` (`po_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ter` FOREIGN KEY (`unit_material`) REFERENCES `unit_material_type_tb` (`um_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `purchase_order_item_tb` */

/*Table structure for table `purchase_order_tb` */

DROP TABLE IF EXISTS `purchase_order_tb`;

CREATE TABLE `purchase_order_tb` (
  `po_id` varchar(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `terms` varchar(15) DEFAULT NULL,
  `delivery_address` varchar(200) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `order_date` date NOT NULL,
  `vat_exclusive` tinyint(1) DEFAULT NULL,
  `so_id` varchar(20) DEFAULT NULL,
  `pwo_id` varchar(20) DEFAULT NULL,
  `dr_id` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`po_id`),
  KEY `FK_purchase_order_tb` (`so_id`),
  KEY `FK_purchase_order2_tb` (`pwo_id`),
  KEY `FK_purchase_order22_tb` (`customer_id`),
  KEY `FK_purchase_or2_tb` (`dr_id`),
  CONSTRAINT `FK_purchase_or2_tb` FOREIGN KEY (`dr_id`) REFERENCES `delivery_receipt_tb` (`dr_id`),
  CONSTRAINT `FK_purchase_order22_tb` FOREIGN KEY (`customer_id`) REFERENCES `customer_tb` (`customer_id`),
  CONSTRAINT `FK_purchase_order2_tb` FOREIGN KEY (`pwo_id`) REFERENCES `production_work_order_tb` (`pwo_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `FK_purchase_order_tb` FOREIGN KEY (`so_id`) REFERENCES `sales_order_tb` (`so_id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `purchase_order_tb` */

/*Table structure for table `role_tb` */

DROP TABLE IF EXISTS `role_tb`;

CREATE TABLE `role_tb` (
  `role_id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `role_tb` */

/*Table structure for table `sales_order_item_tb` */

DROP TABLE IF EXISTS `sales_order_item_tb`;

CREATE TABLE `sales_order_item_tb` (
  `so_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `so_id` varchar(20) NOT NULL,
  `po_item_id` int(11) NOT NULL,
  `tax_code_id` int(5) NOT NULL,
  PRIMARY KEY (`so_item_id`),
  KEY `FK_sales_order_item_tb` (`so_id`),
  KEY `FK_sales_order_item2_tb` (`po_item_id`),
  KEY `ghh` (`tax_code_id`),
  CONSTRAINT `FK_sales_order_item2_tb` FOREIGN KEY (`po_item_id`) REFERENCES `purchase_order_item_tb` (`po_item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_sales_order_item_tb` FOREIGN KEY (`so_id`) REFERENCES `sales_order_tb` (`so_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ghh` FOREIGN KEY (`tax_code_id`) REFERENCES `tax_code_tb` (`tax_code_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sales_order_item_tb` */

/*Table structure for table `sales_order_tb` */

DROP TABLE IF EXISTS `sales_order_tb`;

CREATE TABLE `sales_order_tb` (
  `so_id` varchar(20) NOT NULL,
  `tax_id` varchar(15) DEFAULT NULL,
  `po_id` varchar(20) NOT NULL,
  `payment_method` int(5) DEFAULT NULL,
  `tracking_no` varchar(20) DEFAULT NULL,
  `sales_representative` varchar(50) DEFAULT NULL,
  `sc_approved` int(11) DEFAULT NULL,
  `gm_approved` int(11) DEFAULT NULL,
  `acc_credit_approved` int(11) DEFAULT NULL,
  `acc_collection_approved` int(11) DEFAULT NULL,
  PRIMARY KEY (`so_id`),
  KEY `FK_sales_order_tb` (`po_id`),
  KEY `dsa` (`sc_approved`),
  KEY `da` (`gm_approved`),
  KEY `r` (`acc_credit_approved`),
  KEY `y` (`acc_collection_approved`),
  CONSTRAINT `da` FOREIGN KEY (`gm_approved`) REFERENCES `staff_tb` (`staff_id`),
  CONSTRAINT `dsa` FOREIGN KEY (`sc_approved`) REFERENCES `staff_tb` (`staff_id`),
  CONSTRAINT `FK_sales_order_tb` FOREIGN KEY (`po_id`) REFERENCES `purchase_order_tb` (`po_id`),
  CONSTRAINT `r` FOREIGN KEY (`acc_credit_approved`) REFERENCES `staff_tb` (`staff_id`),
  CONSTRAINT `y` FOREIGN KEY (`acc_collection_approved`) REFERENCES `staff_tb` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sales_order_tb` */

/*Table structure for table `staff_role_tb` */

DROP TABLE IF EXISTS `staff_role_tb`;

CREATE TABLE `staff_role_tb` (
  `staff_role_id` int(8) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `role_id` int(8) DEFAULT NULL,
  PRIMARY KEY (`staff_role_id`),
  KEY `FK_staff_role_tb` (`staff_id`),
  KEY `FK_staff_role3_tb` (`role_id`),
  CONSTRAINT `FK_staff_role3_tb` FOREIGN KEY (`role_id`) REFERENCES `role_tb` (`role_id`),
  CONSTRAINT `FK_staff_role_tb` FOREIGN KEY (`staff_id`) REFERENCES `staff_tb` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `staff_role_tb` */

/*Table structure for table `staff_tb` */

DROP TABLE IF EXISTS `staff_tb`;

CREATE TABLE `staff_tb` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  `primary_email` varchar(50) NOT NULL,
  `secondary_email` varchar(50) DEFAULT NULL,
  `telephone_no` varchar(20) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `signature` binary(255) DEFAULT NULL,
  `date_created` date NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `staff_tb` */

/*Table structure for table `supplier_tb` */

DROP TABLE IF EXISTS `supplier_tb`;

CREATE TABLE `supplier_tb` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `telephone_no` varchar(20) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `address` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `supplier_tb` */

/*Table structure for table `tax_code_tb` */

DROP TABLE IF EXISTS `tax_code_tb`;

CREATE TABLE `tax_code_tb` (
  `tax_code_id` int(5) NOT NULL AUTO_INCREMENT,
  `description` varchar(15) NOT NULL,
  `child_tax_code` int(5) DEFAULT NULL,
  `rate` int(5) DEFAULT NULL,
  PRIMARY KEY (`tax_code_id`),
  KEY `FK_tax_code_tb` (`child_tax_code`),
  CONSTRAINT `FK_tax_code_tb` FOREIGN KEY (`child_tax_code`) REFERENCES `tax_code_tb` (`tax_code_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tax_code_tb` */

/*Table structure for table `unit_material_type_tb` */

DROP TABLE IF EXISTS `unit_material_type_tb`;

CREATE TABLE `unit_material_type_tb` (
  `um_id` int(5) NOT NULL AUTO_INCREMENT,
  `description` varchar(15) NOT NULL,
  PRIMARY KEY (`um_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `unit_material_type_tb` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
