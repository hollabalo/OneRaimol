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

CREATE DATABASE `db_oneraimol`;

USE `db_oneraimol`;

CREATE TABLE `customer_logs_tb` (
  `customer_logs_id` INT(11) NOT NULL AUTO_INCREMENT,
  `customer_id` INT(11) NOT NULL,
  `action` VARCHAR(1000) NOT NULL,
  `time_of_action` TIME NOT NULL,
  `ip_address` VARCHAR(100) NOT NULL,
  `date_of_action` DATE NOT NULL,
  `status` TINYINT(1) DEFAULT NULL,
  PRIMARY KEY (`customer_logs_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `customer_tb` (
  `customer_id` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(20) NOT NULL,
  `middle_name` VARCHAR(20) DEFAULT NULL,
  `last_name` VARCHAR(20) NOT NULL,
  `sex` VARCHAR(10) NOT NULL,
  `company_address` VARCHAR(200) NOT NULL,
  `primary_email` VARCHAR(50) NOT NULL,
  `secondary_email` VARCHAR(50) DEFAULT NULL,
  `birth_date` DATE NOT NULL,
  `telephone_no` VARCHAR(20) DEFAULT NULL,
  `mobile_no` VARCHAR(20) DEFAULT NULL,
  `username` VARCHAR(20) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  `company` VARCHAR(100) DEFAULT NULL,
  `status` TINYINT(1) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `delivery_receipt_tb` (
  `dr_id` VARCHAR(20) NOT NULL,
  `so_id` VARCHAR(20) DEFAULT NULL,
  `po_id` VARCHAR(20) DEFAULT NULL,
  `prepared_by_flag` INT(11) DEFAULT NULL,
  `checked_by_flag` INT(11) DEFAULT NULL,
  `approved_by_flag` INT(11) DEFAULT NULL,
  `released_by_flag` INT(11) DEFAULT NULL,
  `received_by` VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (`dr_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `formula_detail_tb` (
  `formula_item_id` INT(11) NOT NULL AUTO_INCREMENT,
  `formula_id` INT(11) NOT NULL,
  `material_id` INT(11) NOT NULL,
  `vol_per_liter` INT(5) DEFAULT NULL,
  PRIMARY KEY (`formula_item_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `formula_tb` (
  `formula_id` INT(11) NOT NULL AUTO_INCREMENT,
  `po_item_id` INT(11) NOT NULL,
  `date_created` DATE DEFAULT NULL,
  `ceo_approved` TINYINT(1) DEFAULT '0',
  `chemist` INT(11) DEFAULT NULL,
  PRIMARY KEY (`formula_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `material_category_tb` (
  `category_id` INT(11) NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(35) DEFAULT NULL,
  `parent_category_1` INT(11) DEFAULT NULL,
  `parent_category_2` INT(11) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MYISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `material_category_tb` */

INSERT  INTO `material_category_tb`(`category_id`,`description`,`parent_category_1`,`parent_category_2`) VALUES (1,'Industrial',NULL,NULL),(2,'Lubricants',1,NULL),(3,'Compressor Oils',1,2),(4,'Gear Oils',1,2),(5,'Hydraulic Oils',1,2),(6,'Slideway Oils',1,2),(7,'Spindle Oils',1,2),(8,'Turbine Oils',1,2),(9,'Refrigeration Oils',1,2),(10,'Metal Working Fluid',1,NULL),(11,'Stamping Oils',1,NULL),(12,'Die Casting',1,NULL),(13,'Cleaners',1,NULL),(14,'Corrosion Preventive',1,NULL),(15,'Transformer Oil',1,NULL),(16,'Automotive',NULL,NULL),(17,'Motorcycle Oils',16,NULL),(18,'Gasoline Engine Oil',16,NULL),(19,'Diesel Engine Oil',16,NULL),(20,'Automatic Transmission',16,NULL),(21,'Gear Oils',16,NULL),(22,'Marine',NULL,NULL),(23,'Greases',NULL,NULL),(24,'Aerosols',NULL,NULL);

CREATE TABLE `material_stock_level_tb` (
  `stock_id` INT(11) NOT NULL AUTO_INCREMENT,
  `material_id` INT(11) NOT NULL,
  `stock_taking_date` DATE NOT NULL,
  `quantity` INT(5) NOT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `material_supply_tb` (
  `material_supply_id` INT(11) NOT NULL AUTO_INCREMENT,
  `material_id` INT(11) DEFAULT NULL,
  `supplier_id` INT(11) DEFAULT NULL,
  `price` INT(9) DEFAULT NULL,
  PRIMARY KEY (`material_supply_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `material_tb` (
  `material_id` INT(11) NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(30) NOT NULL,
  `material_category_id` INT(11) DEFAULT NULL,
  `reorder_level` INT(5) DEFAULT NULL,
  PRIMARY KEY (`material_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `payment_method_tb` (
  `method_id` INT(5) NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`method_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `product_tb` (
  `product_id` INT(10) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(40) NOT NULL,
  `material_category_id` INT(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MYISAM AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

/*Data for the table `product_tb` */

INSERT  INTO `product_tb`(`product_id`,`name`,`material_category_id`) VALUES (1,'Compro 32',3),(2,'Compro 46',3),(3,'Compro 68',3),(4,'Compro 100',3),(5,'Compro 150',3),(6,'Gear 68',4),(7,'Gear 100',4),(8,'Gear 150',4),(9,'Gear 220',4),(10,'Gear 320',4),(11,'Gear 460',4),(12,'Reindro 10W',5),(13,'Reindro 22',5),(14,'Reindro 32',5),(15,'Reindro 46',5),(16,'Reindro 68',5),(17,'Reindro SWG',5),(18,'Waylube 32',6),(19,'Waylube 46',6),(20,'Waylube 68',6),(21,'Waylube 100',6),(22,'Waylube 150',6),(23,'Spindle Oils',7),(24,'Low Tox',8),(25,'Hydro T32',8),(26,'Hydro T46',8),(27,'Hydro T68',8),(28,'Hydro TS68',8),(29,'Refro 32',9),(30,'Refro 68',9),(31,'Refro 100',9),(32,'Lubricool EM',10),(33,'Lubricool FS',10),(34,'Lubricool SS',10),(35,'Lubricool ST',10),(36,'Qbath',10),(37,'Hono',10),(38,'FD Stamp',11),(39,'SD Stamp',11),(40,'OT Stamp',11),(41,'P-Lube',12),(42,'NS Die Lube',12),(43,'Deg WS',13),(44,'Degsol',13),(45,'Antiro',14),(46,'Antiro-ax',14),(47,'Trans',15),(48,'Flash 4T and 2T',16),(49,'Gelo Super20W50',17),(50,'Lubro SAE40 CF-4 & CD',18),(51,'Lubro 15W40 CF-4',18),(52,'Merd-X',19),(53,'Spiro 90',20),(54,'Spiro 140',20),(55,'Bio 21',21),(56,'Low Tox',21),(57,'Lubro M30r',21),(58,'Lubro M40r',21),(59,'Lubro M50r',21),(60,'Multi-Purpose Grease',22),(61,'Chassis Grease',22),(62,'Lithium Complex EP Grease',22),(63,'Non-Melt Grease',22),(64,'Food Machinery Grease',22),(66,'Contact Cleaner',23),(67,'Penetrating Oil',23),(68,'Anti-Rust Oil',23),(69,'Brake Cleaner',23);

CREATE TABLE `production_batch_ticket_item_tb` (
  `pbt_item_id` INT(11) NOT NULL AUTO_INCREMENT,
  `pbt_id` VARCHAR(20) NOT NULL,
  `formula_item_id` INT(11) NOT NULL,
  `ref_no` VARCHAR(20) DEFAULT NULL,
  `req_qty` INT(5) DEFAULT NULL,
  `actual_qty` INT(5) DEFAULT NULL,
  `req_unit` VARCHAR(10) DEFAULT NULL,
  `actual_unit` VARCHAR(10) DEFAULT NULL,
  `remarks` VARCHAR(50) DEFAULT NULL,
  `stock_id` INT(11) DEFAULT NULL,
  PRIMARY KEY (`pbt_item_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `production_batch_ticket_tb` (
  `pbt_id` VARCHAR(20) NOT NULL,
  `pwo_item_id` INT(11) NOT NULL,
  `formula_id` INT(11) NOT NULL,
  `release_date` DATE DEFAULT NULL,
  `released_by` VARCHAR(50) DEFAULT NULL,
  `blending_time_required` VARCHAR(10) DEFAULT NULL,
  `amount_per_qty` INT(5) DEFAULT NULL,
  `py_theoretical` INT(5) DEFAULT NULL,
  `py_actual` INT(5) DEFAULT NULL,
  `machine_desc` VARCHAR(100) DEFAULT NULL,
  `blending_time` VARCHAR(10) DEFAULT NULL,
  `production_performed_by` VARCHAR(50) DEFAULT NULL,
  `date_produced` DATE DEFAULT NULL,
  `production_staff_approved` INT(11) DEFAULT NULL,
  `qa_approved` INT(11) DEFAULT NULL,
  `chemist_approved` INT(11) DEFAULT NULL,
  `qa_head_approved` INT(11) DEFAULT NULL,
  PRIMARY KEY (`pbt_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `production_work_order_item_tb` (
  `pwo_item_id` INT(11) NOT NULL AUTO_INCREMENT,
  `product_code` VARCHAR(15) DEFAULT NULL,
  `po_item_id` INT(11) NOT NULL,
  `pbt_id` VARCHAR(20) DEFAULT NULL,
  `dr_flag` TINYINT(1) DEFAULT NULL,
  `invoice_flag` TINYINT(1) DEFAULT NULL,
  `remarks` VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (`pwo_item_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `production_work_order_tb` (
  `pwo_id` VARCHAR(20) NOT NULL,
  `issued_by_approved` INT(11) DEFAULT NULL,
  `noted_by_approved` INT(11) DEFAULT NULL,
  `approved_by_approved` INT(11) DEFAULT NULL,
  `received_by_approved` INT(11) DEFAULT NULL,
  PRIMARY KEY (`pwo_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `purchase_order_item_tb` (
  `po_item_id` INT(11) NOT NULL AUTO_INCREMENT,
  `po_id` VARCHAR(20) NOT NULL,
  `po_no` VARCHAR(20) DEFAULT NULL,
  `product_description` VARCHAR(60) NOT NULL,
  `qty` INT(5) NOT NULL,
  `unit_material` INT(11) NOT NULL,
  PRIMARY KEY (`po_item_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `purchase_order_tb` (
  `po_id` VARCHAR(20) NOT NULL,
  `customer_id` INT(11) NOT NULL,
  `terms` VARCHAR(15) DEFAULT NULL,
  `delivery_address` VARCHAR(200) DEFAULT NULL,
  `delivery_date` DATE DEFAULT NULL,
  `order_date` DATE NOT NULL,
  `vat_exclusive` TINYINT(1) DEFAULT NULL,
  `so_id` VARCHAR(20) DEFAULT NULL,
  `pwo_id` VARCHAR(20) DEFAULT NULL,
  `dr_id` VARCHAR(20) DEFAULT NULL,
  `status` TINYINT(1) DEFAULT NULL,
  PRIMARY KEY (`po_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `role_tb` (
  `role_id` INT(8) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(1000) NOT NULL,
  `description` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `sales_order_item_tb` (
  `so_item_id` INT(11) NOT NULL AUTO_INCREMENT,
  `so_id` VARCHAR(20) NOT NULL,
  `po_item_id` INT(11) NOT NULL,
  `tax_code_id` INT(5) NOT NULL,
  PRIMARY KEY (`so_item_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `sales_order_tb` (
  `so_id` VARCHAR(20) NOT NULL,
  `tax_id` VARCHAR(15) DEFAULT NULL,
  `po_id` VARCHAR(20) NOT NULL,
  `payment_method` INT(5) DEFAULT NULL,
  `tracking_no` VARCHAR(20) DEFAULT NULL,
  `sales_representative` VARCHAR(50) DEFAULT NULL,
  `sc_approved` INT(11) DEFAULT NULL,
  `gm_approved` INT(11) DEFAULT NULL,
  `acc_credit_approved` INT(11) DEFAULT NULL,
  `acc_collection_approved` INT(11) DEFAULT NULL,
  PRIMARY KEY (`so_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `staff_role_tb` (
  `staff_role_id` INT(8) NOT NULL AUTO_INCREMENT,
  `staff_id` INT(11) NOT NULL,
  `role_id` INT(8) DEFAULT NULL,
  PRIMARY KEY (`staff_role_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `staff_tb` (
  `staff_id` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(20) NOT NULL,
  `middle_name` VARCHAR(20) DEFAULT NULL,
  `last_name` VARCHAR(20) NOT NULL,
  `sex` VARCHAR(10) NOT NULL,
  `address` VARCHAR(200) NOT NULL,
  `primary_email` VARCHAR(50) NOT NULL,
  `secondary_email` VARCHAR(50) DEFAULT NULL,
  `telephone_no` VARCHAR(20) DEFAULT NULL,
  `mobile_no` VARCHAR(20) DEFAULT NULL,
  `birth_date` DATE DEFAULT NULL,
  `signature` BINARY(255) DEFAULT NULL,
  `date_created` DATE NOT NULL,
  `username` VARCHAR(50) DEFAULT NULL,
  `password` VARCHAR(50) DEFAULT NULL,
  `status` TINYINT(1) DEFAULT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `supplier_tb` (
  `supplier_id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `telephone_no` VARCHAR(20) DEFAULT NULL,
  `mobile_no` VARCHAR(20) DEFAULT NULL,
  `email` VARCHAR(20) DEFAULT NULL,
  `address` VARCHAR(60) DEFAULT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `tax_code_tb` (
  `tax_code_id` INT(5) NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(15) NOT NULL,
  `child_tax_code` INT(5) DEFAULT NULL,
  `rate` INT(5) DEFAULT NULL,
  PRIMARY KEY (`tax_code_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

CREATE TABLE `unit_material_type_tb` (
  `um_id` INT(5) NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`um_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;