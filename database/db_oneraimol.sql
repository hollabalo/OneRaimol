/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50141
Source Host           : localhost:3306
Source Database       : db_oneraimol

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2012-03-21 19:05:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `customer_logs_tb`
-- ----------------------------
DROP TABLE IF EXISTS `customer_logs_tb`;
CREATE TABLE `customer_logs_tb` (
  `customer_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `action` varchar(1000) NOT NULL,
  `time_of_action` time NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `date_of_action` date NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`customer_log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customer_logs_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `customer_tb`
-- ----------------------------
DROP TABLE IF EXISTS `customer_tb`;
CREATE TABLE `customer_tb` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `primary_email` varchar(50) NOT NULL,
  `secondary_email` varchar(50) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `telephone_no` varchar(20) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `bank_name` varchar(50) DEFAULT NULL,
  `bank_account_no` varchar(50) DEFAULT NULL,
  `credit_limit` varchar(10) DEFAULT NULL,
  `confirmation_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customer_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `delivery_address_tb`
-- ----------------------------
DROP TABLE IF EXISTS `delivery_address_tb`;
CREATE TABLE `delivery_address_tb` (
  `delivery_address_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `type_address` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`delivery_address_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of delivery_address_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `delivery_receipt_tb`
-- ----------------------------
DROP TABLE IF EXISTS `delivery_receipt_tb`;
CREATE TABLE `delivery_receipt_tb` (
  `dr_id` int(11) NOT NULL AUTO_INCREMENT,
  `dr_id_string` varchar(20) DEFAULT NULL,
  `so_id` varchar(20) DEFAULT NULL,
  `po_id` varchar(20) DEFAULT NULL,
  `sc_approved` int(11) DEFAULT NULL,
  `gm_approved` int(11) DEFAULT NULL,
  `pm_approved` int(11) DEFAULT NULL,
  `ic_approved` int(11) DEFAULT NULL,
  `labanalyst_approved` int(11) DEFAULT NULL,
  `sc_approved_date` datetime DEFAULT NULL,
  `gm_approved_date` datetime DEFAULT NULL,
  `pm_approved_date` datetime DEFAULT NULL,
  `ic_approved_date` datetime DEFAULT NULL,
  `labanalyst_approved_date` datetime DEFAULT NULL,
  `sc_approved_status` tinyint(1) DEFAULT NULL,
  `gm_approved_status` tinyint(1) DEFAULT NULL,
  `ic_approved_status` tinyint(1) DEFAULT NULL,
  `labanalyst_approved_status` tinyint(1) DEFAULT NULL,
  `pm_approved_status` tinyint(1) DEFAULT NULL,
  `sc_disapproved_comment` varchar(255) DEFAULT NULL,
  `gm_disapproved_comment` varchar(255) DEFAULT NULL,
  `pm_disapproved_comment` varchar(255) DEFAULT NULL,
  `ic_disapproved_comment` varchar(255) DEFAULT NULL,
  `labanalyst_disapproved_comment` varchar(255) DEFAULT NULL,
  `dr_status` varchar(1) DEFAULT NULL,
  `delivered_date` date DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `confirmation_code` varchar(255) DEFAULT NULL,
  `order_receive_status` tinyint(1) DEFAULT NULL,
  `date_order_received` date DEFAULT NULL,
  `archive_flag` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`dr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of delivery_receipt_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `formula_detail_tb`
-- ----------------------------
DROP TABLE IF EXISTS `formula_detail_tb`;
CREATE TABLE `formula_detail_tb` (
  `formula_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `formula_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `dosage` decimal(11,2) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `liters` int(11) DEFAULT NULL,
  PRIMARY KEY (`formula_item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of formula_detail_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `formula_tb`
-- ----------------------------
DROP TABLE IF EXISTS `formula_tb`;
CREATE TABLE `formula_tb` (
  `formula_id` int(11) NOT NULL AUTO_INCREMENT,
  `formula_id_string` varchar(20) DEFAULT NULL,
  `po_item_id` int(11) NOT NULL,
  `pwo_item_id` int(11) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `ceo_approved` tinyint(1) DEFAULT NULL,
  `chemist_approved` int(11) DEFAULT NULL,
  `ceo_approved_date` datetime DEFAULT NULL,
  `chemist_approved_date` datetime DEFAULT NULL,
  `ceo_approved_status` tinyint(1) DEFAULT NULL,
  `chemist_approved_status` tinyint(1) DEFAULT NULL,
  `ceo_disapproved_comment` varchar(255) DEFAULT NULL,
  `chemist_disapproved_comment` varchar(255) DEFAULT NULL,
  `direct_material_cost` int(11) DEFAULT NULL,
  `selling_price` int(11) DEFAULT NULL,
  `net_price` int(11) DEFAULT NULL,
  `opex` int(11) DEFAULT NULL,
  `archive_flag` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`formula_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of formula_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `material_category_tb`
-- ----------------------------
DROP TABLE IF EXISTS `material_category_tb`;
CREATE TABLE `material_category_tb` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(35) DEFAULT NULL,
  `parent_category_1` int(11) DEFAULT NULL,
  `parent_category_2` int(11) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of material_category_tb
-- ----------------------------
INSERT INTO `material_category_tb` VALUES ('27', 'Aerosols', null, null);
INSERT INTO `material_category_tb` VALUES ('28', 'Automatic Transmission Fluid', null, null);
INSERT INTO `material_category_tb` VALUES ('29', 'Automotive Gear Oils', null, null);
INSERT INTO `material_category_tb` VALUES ('30', 'Brake Fluid', null, null);
INSERT INTO `material_category_tb` VALUES ('31', 'Cleaners', null, null);
INSERT INTO `material_category_tb` VALUES ('32', 'Compressor Oils', null, null);
INSERT INTO `material_category_tb` VALUES ('33', 'Corrosion Preventive', null, null);
INSERT INTO `material_category_tb` VALUES ('34', 'Cutting Oils', null, null);
INSERT INTO `material_category_tb` VALUES ('35', 'Die Casting Oils', null, null);
INSERT INTO `material_category_tb` VALUES ('36', 'Diesel Engine Oils', null, null);
INSERT INTO `material_category_tb` VALUES ('37', 'Gasoline Engine Oils', null, null);
INSERT INTO `material_category_tb` VALUES ('38', 'Greases', null, null);
INSERT INTO `material_category_tb` VALUES ('39', 'Hydraulic Oils', null, null);
INSERT INTO `material_category_tb` VALUES ('40', 'Industrial Gear Oils', null, null);
INSERT INTO `material_category_tb` VALUES ('41', 'Marine Oils', null, null);
INSERT INTO `material_category_tb` VALUES ('42', 'Metal Working Fluids', null, null);
INSERT INTO `material_category_tb` VALUES ('43', 'Motorcycle Oils', null, null);
INSERT INTO `material_category_tb` VALUES ('44', 'Slideway Oils', null, null);
INSERT INTO `material_category_tb` VALUES ('45', 'Spindle Oils', null, null);
INSERT INTO `material_category_tb` VALUES ('46', 'Stamping Oils', null, null);
INSERT INTO `material_category_tb` VALUES ('47', 'Transformer Oil', null, null);
INSERT INTO `material_category_tb` VALUES ('48', 'Turbine Oils', null, null);
INSERT INTO `material_category_tb` VALUES ('49', 'Base Oil', null, null);
INSERT INTO `material_category_tb` VALUES ('50', 'Additives', null, null);

-- ----------------------------
-- Table structure for `material_stock_level_tb`
-- ----------------------------
DROP TABLE IF EXISTS `material_stock_level_tb`;
CREATE TABLE `material_stock_level_tb` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_supply_id` int(11) NOT NULL,
  `stock_taking_date` date NOT NULL,
  `liters` int(5) NOT NULL,
  `expiration_date` date NOT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of material_stock_level_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `material_stock_usage_tb`
-- ----------------------------
DROP TABLE IF EXISTS `material_stock_usage_tb`;
CREATE TABLE `material_stock_usage_tb` (
  `material_stock_usage_id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_id` int(11) DEFAULT NULL,
  `liters` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`material_stock_usage_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of material_stock_usage_tb
-- ----------------------------
INSERT INTO `material_stock_usage_tb` VALUES ('1', '0', '0', '0000-00-00');

-- ----------------------------
-- Table structure for `material_supply_tb`
-- ----------------------------
DROP TABLE IF EXISTS `material_supply_tb`;
CREATE TABLE `material_supply_tb` (
  `material_supply_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `price` int(9) DEFAULT NULL,
  PRIMARY KEY (`material_supply_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of material_supply_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `material_tb`
-- ----------------------------
DROP TABLE IF EXISTS `material_tb`;
CREATE TABLE `material_tb` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(30) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `critical_level` int(5) DEFAULT NULL,
  PRIMARY KEY (`material_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of material_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `payment_method_tb`
-- ----------------------------
DROP TABLE IF EXISTS `payment_method_tb`;
CREATE TABLE `payment_method_tb` (
  `method_id` int(5) NOT NULL AUTO_INCREMENT,
  `description` varchar(15) NOT NULL,
  PRIMARY KEY (`method_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payment_method_tb
-- ----------------------------
INSERT INTO `payment_method_tb` VALUES ('1', 'COD');
INSERT INTO `payment_method_tb` VALUES ('2', 'Check');

-- ----------------------------
-- Table structure for `production_batch_ticket_item_tb`
-- ----------------------------
DROP TABLE IF EXISTS `production_batch_ticket_item_tb`;
CREATE TABLE `production_batch_ticket_item_tb` (
  `pbt_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `pbt_id` varchar(20) NOT NULL,
  `formula_item_id` int(11) NOT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `stock_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pbt_item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of production_batch_ticket_item_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `production_batch_ticket_tb`
-- ----------------------------
DROP TABLE IF EXISTS `production_batch_ticket_tb`;
CREATE TABLE `production_batch_ticket_tb` (
  `pbt_id` int(11) NOT NULL AUTO_INCREMENT,
  `pbt_id_string` varchar(20) NOT NULL,
  `formula_id` int(11) NOT NULL,
  `product_code` varchar(70) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `released_by` varchar(50) DEFAULT NULL,
  `blending_time_required` varchar(10) DEFAULT NULL,
  `amount_per_qty` int(5) DEFAULT NULL,
  `py_theoretical` int(5) DEFAULT NULL,
  `py_actual` int(5) DEFAULT NULL,
  `variance` int(5) DEFAULT NULL,
  `machine_desc` varchar(100) DEFAULT NULL,
  `blending_time` varchar(10) DEFAULT NULL,
  `production_performed_by` varchar(50) NOT NULL,
  `date_produced` date DEFAULT NULL,
  `labanalyst_approved` int(11) DEFAULT NULL,
  `qa_approved` int(11) DEFAULT NULL,
  `hc_approved` int(11) DEFAULT NULL,
  `qa_head_approved` int(11) DEFAULT NULL,
  `labanalyst_approved_date` datetime DEFAULT NULL,
  `qa_approved_date` datetime DEFAULT NULL,
  `hc_approved_date` datetime DEFAULT NULL,
  `qa_head_approved_date` datetime DEFAULT NULL,
  `labanalyst_approved_status` tinyint(1) DEFAULT NULL,
  `qa_approved_status` tinyint(1) DEFAULT NULL,
  `hc_approved_status` tinyint(1) DEFAULT NULL,
  `qa_head_approved_status` tinyint(1) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `labanalyst_disapproved_comment` varchar(255) DEFAULT NULL,
  `qa_disapproved_comment` varchar(255) DEFAULT NULL,
  `qa_head_disapproved_comment` varchar(255) DEFAULT NULL,
  `hc_disapproved_comment` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `release_flag` tinyint(1) DEFAULT NULL,
  `archive_flag` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`pbt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of production_batch_ticket_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `production_work_order_item_tb`
-- ----------------------------
DROP TABLE IF EXISTS `production_work_order_item_tb`;
CREATE TABLE `production_work_order_item_tb` (
  `pwo_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `pwo_id` int(11) DEFAULT NULL,
  `product_code` varchar(15) DEFAULT NULL,
  `so_item_id` int(11) NOT NULL,
  `pbt_id` varchar(20) DEFAULT NULL,
  `dr_flag` tinyint(1) DEFAULT NULL,
  `invoice_flag` tinyint(1) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `batch_no` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`pwo_item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of production_work_order_item_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `production_work_order_tb`
-- ----------------------------
DROP TABLE IF EXISTS `production_work_order_tb`;
CREATE TABLE `production_work_order_tb` (
  `pwo_id` int(20) NOT NULL AUTO_INCREMENT,
  `pwo_id_string` varchar(20) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `hc_approved` int(11) DEFAULT NULL,
  `sc_approved` int(11) DEFAULT NULL,
  `accountant_approved` int(11) DEFAULT NULL,
  `hc_approved_date` datetime DEFAULT NULL,
  `sc_approved_date` datetime DEFAULT NULL,
  `accountant_approved_date` datetime DEFAULT NULL,
  `hc_approved_status` tinyint(1) DEFAULT NULL,
  `sc_approved_status` tinyint(1) DEFAULT NULL,
  `accountant_approved_status` tinyint(1) DEFAULT NULL,
  `hc_disapproved_comment` varchar(255) DEFAULT NULL,
  `sc_disapproved_comment` varchar(255) DEFAULT NULL,
  `accountant_disapproved_comment` varchar(255) DEFAULT NULL,
  `archive_flag` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pwo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of production_work_order_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `product_price_tb`
-- ----------------------------
DROP TABLE IF EXISTS `product_price_tb`;
CREATE TABLE `product_price_tb` (
  `product_price_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `sku` varchar(11) DEFAULT NULL,
  `package_size` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `um_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_price_id`)
) ENGINE=MyISAM AUTO_INCREMENT=261 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_price_tb
-- ----------------------------
INSERT INTO `product_price_tb` VALUES ('101', '101', '1', '18', '2178', '2');
INSERT INTO `product_price_tb` VALUES ('102', '101', '1', '20', '2400', '7');
INSERT INTO `product_price_tb` VALUES ('103', '101', '1', '200', '22000', '1');
INSERT INTO `product_price_tb` VALUES ('104', '102', '1', '18', '2376', '2');
INSERT INTO `product_price_tb` VALUES ('105', '102', '1', '20', '2620', '7');
INSERT INTO `product_price_tb` VALUES ('106', '102', '1', '200', '24200', '1');
INSERT INTO `product_price_tb` VALUES ('107', '103', '1', '18', '2574', '2');
INSERT INTO `product_price_tb` VALUES ('108', '103', '1', '20', '2840', '7');
INSERT INTO `product_price_tb` VALUES ('109', '103', '1', '200', '26400', '1');
INSERT INTO `product_price_tb` VALUES ('110', '104', '1', '18', '2592', '2');
INSERT INTO `product_price_tb` VALUES ('140', '115', '1', '20', '156', '7');
INSERT INTO `product_price_tb` VALUES ('112', '0', '21', '1', '440', '5');
INSERT INTO `product_price_tb` VALUES ('113', '105', '1', '18', '2628', '2');
INSERT INTO `product_price_tb` VALUES ('114', '105', '1', '20', '2900', '7');
INSERT INTO `product_price_tb` VALUES ('139', '115', '1', '18', '157', '2');
INSERT INTO `product_price_tb` VALUES ('116', '109', '1', '18', '10512', '2');
INSERT INTO `product_price_tb` VALUES ('117', '109', '1', '20', '11660', '2');
INSERT INTO `product_price_tb` VALUES ('118', '109', '1', '200', '114000', '1');
INSERT INTO `product_price_tb` VALUES ('119', '109', '24', '1', '590', '4');
INSERT INTO `product_price_tb` VALUES ('120', '109', '12', '1', '592', '5');
INSERT INTO `product_price_tb` VALUES ('121', '109', '6', '4', '2336', '3');
INSERT INTO `product_price_tb` VALUES ('122', '110', '1', '18', '8712', '2');
INSERT INTO `product_price_tb` VALUES ('123', '110', '1', '20', '9660', '7');
INSERT INTO `product_price_tb` VALUES ('124', '110', '1', '200', '94000', '1');
INSERT INTO `product_price_tb` VALUES ('125', '110', '24', '1', '490', '4');
INSERT INTO `product_price_tb` VALUES ('126', '110', '12', '1', '492', '5');
INSERT INTO `product_price_tb` VALUES ('127', '110', '6', '4', '1936', '3');
INSERT INTO `product_price_tb` VALUES ('128', '106', '1', '18', '2376', '2');
INSERT INTO `product_price_tb` VALUES ('129', '106', '1', '20', '2620', '2');
INSERT INTO `product_price_tb` VALUES ('130', '106', '1', '200', '24000', '1');
INSERT INTO `product_price_tb` VALUES ('131', '107', '1', '18', '2396', '2');
INSERT INTO `product_price_tb` VALUES ('132', '107', '1', '20', '2620', '7');
INSERT INTO `product_price_tb` VALUES ('133', '107', '1', '200', '24400', '1');
INSERT INTO `product_price_tb` VALUES ('134', '108', '1', '18', '2412', '2');
INSERT INTO `product_price_tb` VALUES ('135', '108', '1', '20', '2660', '7');
INSERT INTO `product_price_tb` VALUES ('136', '108', '1', '200', '24800', '1');
INSERT INTO `product_price_tb` VALUES ('138', '115', '24', '1', '163', '4');
INSERT INTO `product_price_tb` VALUES ('141', '115', '1', '200', '151', '1');
INSERT INTO `product_price_tb` VALUES ('157', '116', '1', '20', '143', '7');
INSERT INTO `product_price_tb` VALUES ('156', '116', '1', '18', '144', '2');
INSERT INTO `product_price_tb` VALUES ('144', '144', '1', '20', '160', '7');
INSERT INTO `product_price_tb` VALUES ('155', '116', '24', '1', '150', '4');
INSERT INTO `product_price_tb` VALUES ('146', '146', '66', '66', '66', '1');
INSERT INTO `product_price_tb` VALUES ('147', '0', '55', '55', '88', '3');
INSERT INTO `product_price_tb` VALUES ('148', '0', '44', '44', '44', '1');
INSERT INTO `product_price_tb` VALUES ('149', '0', '88', '8', '888', '5');
INSERT INTO `product_price_tb` VALUES ('151', '0', '338', '33', '333', '1');
INSERT INTO `product_price_tb` VALUES ('159', '116', '24', '1', '155', '4');
INSERT INTO `product_price_tb` VALUES ('152', '0', '1', '12', '12', '3');
INSERT INTO `product_price_tb` VALUES ('158', '116', '1', '200', '138', '1');
INSERT INTO `product_price_tb` VALUES ('160', '116', '1', '18', '149', '2');
INSERT INTO `product_price_tb` VALUES ('161', '116', '1', '20', '148', '7');
INSERT INTO `product_price_tb` VALUES ('162', '116', '1', '200', '143', '1');
INSERT INTO `product_price_tb` VALUES ('163', '122', '1', '18', '144', '2');
INSERT INTO `product_price_tb` VALUES ('164', '122', '1', '20', '143', '7');
INSERT INTO `product_price_tb` VALUES ('165', '122', '1', '200', '133', '1');
INSERT INTO `product_price_tb` VALUES ('166', '123', '1', '18', '132', '2');
INSERT INTO `product_price_tb` VALUES ('167', '123', '1', '20', '131', '5');
INSERT INTO `product_price_tb` VALUES ('168', '123', '1', '200', '122', '1');
INSERT INTO `product_price_tb` VALUES ('169', '125', '1', '18', '134', '2');
INSERT INTO `product_price_tb` VALUES ('170', '125', '1', '20', '133', '7');
INSERT INTO `product_price_tb` VALUES ('171', '125', '1', '200', '124', '1');
INSERT INTO `product_price_tb` VALUES ('172', '128', '1', '18', '157', '2');
INSERT INTO `product_price_tb` VALUES ('173', '128', '1', '20', '156', '7');
INSERT INTO `product_price_tb` VALUES ('174', '128', '1', '200', '147', '1');
INSERT INTO `product_price_tb` VALUES ('175', '129', '1', '20', '165', '7');
INSERT INTO `product_price_tb` VALUES ('176', '129', '1', '200', '155', '1');
INSERT INTO `product_price_tb` VALUES ('177', '130', '1', '20', '278', '7');
INSERT INTO `product_price_tb` VALUES ('178', '130', '1', '200', '268', '1');
INSERT INTO `product_price_tb` VALUES ('179', '131', '1', '20', '234', '7');
INSERT INTO `product_price_tb` VALUES ('180', '131', '1', '200', '224', '1');
INSERT INTO `product_price_tb` VALUES ('181', '132', '1', '18', '148', '2');
INSERT INTO `product_price_tb` VALUES ('182', '132', '1', '20', '147', '7');
INSERT INTO `product_price_tb` VALUES ('183', '132', '1', '200', '138', '1');
INSERT INTO `product_price_tb` VALUES ('184', '133', '11', '20', '190', '7');
INSERT INTO `product_price_tb` VALUES ('185', '133', '1', '200', '180', '1');
INSERT INTO `product_price_tb` VALUES ('186', '134', '11', '20', '180', '7');
INSERT INTO `product_price_tb` VALUES ('187', '134', '1', '200', '170', '1');
INSERT INTO `product_price_tb` VALUES ('188', '135', '24', '1', '172', '4');
INSERT INTO `product_price_tb` VALUES ('189', '135', '6', '4', '166', '3');
INSERT INTO `product_price_tb` VALUES ('190', '135', '1', '0', '166', '2');
INSERT INTO `product_price_tb` VALUES ('191', '135', '1', '20', '165', '7');
INSERT INTO `product_price_tb` VALUES ('192', '135', '1', '200', '160', '1');
INSERT INTO `product_price_tb` VALUES ('193', '136', '24', '1', '145', '4');
INSERT INTO `product_price_tb` VALUES ('194', '136', '6', '4', '139', '3');
INSERT INTO `product_price_tb` VALUES ('195', '136', '1', '18', '139', '2');
INSERT INTO `product_price_tb` VALUES ('196', '136', '1', '20', '138', '7');
INSERT INTO `product_price_tb` VALUES ('197', '136', '1', '200', '133', '1');
INSERT INTO `product_price_tb` VALUES ('198', '137', '24', '1', '160', '4');
INSERT INTO `product_price_tb` VALUES ('199', '137', '6', '4', '154', '3');
INSERT INTO `product_price_tb` VALUES ('200', '137', '1', '18', '154', '2');
INSERT INTO `product_price_tb` VALUES ('201', '137', '1', '20', '153', '7');
INSERT INTO `product_price_tb` VALUES ('202', '137', '1', '200', '148', '1');
INSERT INTO `product_price_tb` VALUES ('203', '147', '1', '18', '121', '2');
INSERT INTO `product_price_tb` VALUES ('204', '147', '1', '20', '120', '7');
INSERT INTO `product_price_tb` VALUES ('205', '147', '1', '200', '110', '1');
INSERT INTO `product_price_tb` VALUES ('206', '148', '1', '18', '121', '2');
INSERT INTO `product_price_tb` VALUES ('207', '148', '1', '20', '120', '7');
INSERT INTO `product_price_tb` VALUES ('208', '148', '1', '200', '110', '1');
INSERT INTO `product_price_tb` VALUES ('209', '149', '12', '18', '132', '2');
INSERT INTO `product_price_tb` VALUES ('210', '149', '1', '20', '131', '7');
INSERT INTO `product_price_tb` VALUES ('211', '149', '11', '200', '121', '1');
INSERT INTO `product_price_tb` VALUES ('212', '150', '1', '18', '143', '2');
INSERT INTO `product_price_tb` VALUES ('213', '150', '1', '20', '142', '7');
INSERT INTO `product_price_tb` VALUES ('214', '150', '1', '200', '132', '1');
INSERT INTO `product_price_tb` VALUES ('215', '156', '1', '18', '144', '2');
INSERT INTO `product_price_tb` VALUES ('216', '156', '1', '20', '143', '7');
INSERT INTO `product_price_tb` VALUES ('217', '156', '1', '200', '133', '1');
INSERT INTO `product_price_tb` VALUES ('218', '157', '1', '18', '144', '2');
INSERT INTO `product_price_tb` VALUES ('219', '157', '1', '20', '143', '7');
INSERT INTO `product_price_tb` VALUES ('220', '157', '1', '200', '133', '1');
INSERT INTO `product_price_tb` VALUES ('221', '158', '1', '18', '144', '2');
INSERT INTO `product_price_tb` VALUES ('222', '158', '1', '20', '143', '7');
INSERT INTO `product_price_tb` VALUES ('223', '158', '1', '200', '133', '1');
INSERT INTO `product_price_tb` VALUES ('224', '159', '1', '18', '146', '2');
INSERT INTO `product_price_tb` VALUES ('225', '159', '1', '20', '145', '7');
INSERT INTO `product_price_tb` VALUES ('226', '159', '1', '200', '135', '1');
INSERT INTO `product_price_tb` VALUES ('227', '165', '1', '20', '140', '7');
INSERT INTO `product_price_tb` VALUES ('228', '165', '1', '200', '130', '1');
INSERT INTO `product_price_tb` VALUES ('229', '166', '1', '18', '144', '2');
INSERT INTO `product_price_tb` VALUES ('230', '166', '1', '20', '143', '7');
INSERT INTO `product_price_tb` VALUES ('231', '166', '1', '200', '133', '1');
INSERT INTO `product_price_tb` VALUES ('232', '167', '60', '200', '110', '1');
INSERT INTO `product_price_tb` VALUES ('233', '167', '24', '1', '114', '4');
INSERT INTO `product_price_tb` VALUES ('234', '167', '1', '18', '113', '2');
INSERT INTO `product_price_tb` VALUES ('235', '167', '1', '200', '108', '1');
INSERT INTO `product_price_tb` VALUES ('236', '168', '24', '1', '148', '4');
INSERT INTO `product_price_tb` VALUES ('237', '168', '1', '18', '142', '2');
INSERT INTO `product_price_tb` VALUES ('238', '168', '1', '20', '141', '7');
INSERT INTO `product_price_tb` VALUES ('240', '168', '1', '200', '136', '1');
INSERT INTO `product_price_tb` VALUES ('241', '175', '1', '18', '112', '2');
INSERT INTO `product_price_tb` VALUES ('242', '175', '1', '20', '111', '7');
INSERT INTO `product_price_tb` VALUES ('243', '175', '1', '200', '102', '1');
INSERT INTO `product_price_tb` VALUES ('244', '176', '1', '20', '210', '7');
INSERT INTO `product_price_tb` VALUES ('245', '176', '1', '200', '200', '1');
INSERT INTO `product_price_tb` VALUES ('246', '177', '1', '20', '200', '7');
INSERT INTO `product_price_tb` VALUES ('247', '177', '1', '200', '190', '1');
INSERT INTO `product_price_tb` VALUES ('248', '172', '1', '18', '132', '2');
INSERT INTO `product_price_tb` VALUES ('249', '172', '1', '20', '131', '7');
INSERT INTO `product_price_tb` VALUES ('250', '172', '1', '200', '122', '1');
INSERT INTO `product_price_tb` VALUES ('251', '181', '1', '18', '151', '2');
INSERT INTO `product_price_tb` VALUES ('252', '181', '1', '20', '150', '7');
INSERT INTO `product_price_tb` VALUES ('253', '181', '1', '200', '140', '1');
INSERT INTO `product_price_tb` VALUES ('254', '182', '1', '18', '151', '2');
INSERT INTO `product_price_tb` VALUES ('255', '182', '1', '20', '150', '7');
INSERT INTO `product_price_tb` VALUES ('256', '182', '1', '200', '140', '1');
INSERT INTO `product_price_tb` VALUES ('257', '183', '1', '18', '151', '2');
INSERT INTO `product_price_tb` VALUES ('258', '183', '1', '20', '150', '7');
INSERT INTO `product_price_tb` VALUES ('259', '183', '1', '200', '140', '1');
INSERT INTO `product_price_tb` VALUES ('260', '112', '12', '1', '440', '5');

-- ----------------------------
-- Table structure for `product_stock_level_tb`
-- ----------------------------
DROP TABLE IF EXISTS `product_stock_level_tb`;
CREATE TABLE `product_stock_level_tb` (
  `product_stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `stock_taking_date` date NOT NULL,
  `liters` int(5) NOT NULL,
  `expiration_date` date NOT NULL,
  PRIMARY KEY (`product_stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of product_stock_level_tb
-- ----------------------------
INSERT INTO `product_stock_level_tb` VALUES ('1', '111', '2011-03-06', '5000', '2012-03-04');
INSERT INTO `product_stock_level_tb` VALUES ('2', '112', '2012-03-04', '5000', '2013-03-04');
INSERT INTO `product_stock_level_tb` VALUES ('3', '112', '2012-07-09', '3000', '2013-06-09');

-- ----------------------------
-- Table structure for `product_tb`
-- ----------------------------
DROP TABLE IF EXISTS `product_tb`;
CREATE TABLE `product_tb` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `material_category_id` int(11) DEFAULT NULL,
  `picture` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=185 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_tb
-- ----------------------------
INSERT INTO `product_tb` VALUES ('117', 'RAIMOLâ„¢ SPIRO 140', 'SPIRO Gear Oil SAE 140 GL5 is a high quality manual transmission gear lubricants specially formulated to provide excellent extreme pressure protection for heavy duty service.                                                    ', '29', null);
INSERT INTO `product_tb` VALUES ('116', 'RAIMOLâ„¢ SPIRO 90', 'SPIRO 90 Gear Oil SAE 90 GL5 is a high quality manual transmission gear lubricants specially formulated to provide excellent extreme pressure protection for heavy duty service.                                                    ', '29', null);
INSERT INTO `product_tb` VALUES ('114', 'RAIMOLâ„¢ AERO 888', 'Multi-purpose brake cleaner                                                    ', '27', null);
INSERT INTO `product_tb` VALUES ('115', 'RAIMOLâ„¢ MERD-X', 'Premium ATF Dexron III. MERD-X is a premium automatic transmission fluid that offers excellent low temperature fluidity, high temperature stability, and rust, corrosion, and wear protection for longer engine service life. It is dyed red for easy leak dete', '28', null);
INSERT INTO `product_tb` VALUES ('113', 'RAIMOLâ„¢ AERO 501', 'Multi-purpose anti-rust oil                                                    ', '27', null);
INSERT INTO `product_tb` VALUES ('112', 'RAIMOLâ„¢ AERO 313 ', 'Multi-purpose penetrating oil              ', '27', null);
INSERT INTO `product_tb` VALUES ('111', 'RAIMOLâ„¢ AERO 307', 'Bullshrek', '27', null);
INSERT INTO `product_tb` VALUES ('118', 'RAIMOLâ„¢ DOT3', 'Heavy duty brake fluid                                                    ', '30', null);
INSERT INTO `product_tb` VALUES ('119', 'RAIMOLâ„¢ DOT4', 'Heavy duty brake fluid                                                    ', '30', null);
INSERT INTO `product_tb` VALUES ('120', 'RAIMOLâ„¢ DEG WS ', 'RAIMOL DEG WS is a multi-purpose, water soluble liquid cleaner/degreaser formulated with a balanced blend of ionic and non-ionic detergents, wetting agents, and water softeners for effective cleaning performance.                                           ', '31', null);
INSERT INTO `product_tb` VALUES ('121', 'RAIMOLâ„¢ DEGSOL', 'RAIMOL DEGSOL is a versatile cleaner and degreaser for machined work pieces of different materials. Removes grease, oil, wax, adhesives, traces of coolants, grinding oils and other contaminants.                                                    ', '31', null);
INSERT INTO `product_tb` VALUES ('122', 'RAIMOLâ„¢ LUBRICLEAN ', 'Flushing Oil                                                    ', '31', null);
INSERT INTO `product_tb` VALUES ('123', 'RAIMOLâ„¢ COMPRO 32', 'COMPRO 32 High Performance Air Compressor Oils are blended from selected high quality paraffinic base oils and additives that include a special ashless high temperature anti-oxidant which eliminates carbon deposits from air discharge valves.              ', '32', null);
INSERT INTO `product_tb` VALUES ('124', 'RAIMOLâ„¢ COMPRO 68', 'COMPRO 68 High Performance Air Compressor Oils are blended from selected high quality paraffinic base oils and additives that include a special ashless high temperature anti-oxidant which eliminates carbon deposits from air discharge valves.              ', '32', null);
INSERT INTO `product_tb` VALUES ('125', 'RAIMOLâ„¢ COMPRO 100', 'COMPRO 100 High Performance Air Compressor Oils are blended from selected high quality paraffinic base oils and additives that include a special ashless high temperature anti-oxidant which eliminates carbon deposits from air discharge valves.             ', '32', null);
INSERT INTO `product_tb` VALUES ('126', 'RAIMOLâ„¢ COMPRO 150', 'COMPRO 150 High Performance Air Compressor Oils are blended from selected high quality paraffinic base oils and additives that include a special ashless high temperature anti-oxidant which eliminates carbon deposits from air discharge valves.             ', '32', null);
INSERT INTO `product_tb` VALUES ('127', 'RAIMOLâ„¢ ANTIRO', 'ANTIRO anti-rust oil is a non-staining, non-emulsifiable and water displacing rust preventive which does not emulsify even in the presence of alkali. It deposits a thin, colorless film, which is practically invisible, not messy to handle, and will not ble', '33', null);
INSERT INTO `product_tb` VALUES ('128', 'RAIMOLâ„¢ ANTIRO-AX', 'ANTIRO-AX Dewatering Fluid is a non-staining, non-emulsifiable and water displacing rust preventive which does not emulsify even in the presence of alkali. It deposits a thin, colorless film, which is practically invisible, not messy to handle. Provide mu', '33', null);
INSERT INTO `product_tb` VALUES ('129', 'RAIMOLâ„¢ LUBRICOOL EM', 'LUBRICOOL EM is premium water soluble non-silicon cutting oil that forms a stable milky emulsion with water and was developed for use as a general purpose metalworking fluid for ferrous and non-ferrous metals and produces especially good results in alumin', '34', null);
INSERT INTO `product_tb` VALUES ('130', 'RAIMOLâ„¢ LUBRICOOL FS', 'LUBRICOOL FS is a water-extendable, fully synthetic, cutting fluid developed for cutting and grinding specially made for aluminum. This product was specifically formulated to be bio stable and suit the demand for a coolant with no oil content, very clean ', '34', null);
INSERT INTO `product_tb` VALUES ('131', 'RAIMOLâ„¢ LUBRICOOL SS', 'LUBRICOOL SS is a top quality water dilutable, semi-synthetic, heavy duty cutting and grinding fluid concentrate formulated to suit the demand for a high performance metal working fluid with low oil content, long sump life, very good rust protection, and ', '34', null);
INSERT INTO `product_tb` VALUES ('132', 'RAIMOLâ„¢ LUBRICOOL ST', 'LUBRICOOL ST is a superior quality straight (neat) cutting fluid made from high quality refined mineral oils fortified with a balanced combination of friction reducing additives, extreme pressure additive, and corrosion inhibitors.                        ', '34', null);
INSERT INTO `product_tb` VALUES ('133', 'RAIMOLâ„¢ NS-DIE LUBE', 'NS-DIE LUBE is a high performance non-silicon die release agent. It is formulated for the aluminum and zinc die caster with complex or detailed molds and where a totally silicon free product is required. NS-DIE LUBE forms a micro-stable solution in both h', '35', null);
INSERT INTO `product_tb` VALUES ('134', 'RAIMOLâ„¢ P-LUBE', 'P-LUBE is a straight oil release agent to be used neat or diluted with a solvent carrier. P-LUBE is formulated from a highly refined paraffinic base stock.                                                    ', '35', null);
INSERT INTO `product_tb` VALUES ('135', 'RAIMOLâ„¢ LUBRO 15W40 CI4/SL', 'LUBRO 15W40 CI4/SL is fully formulated multigrade performance engine oil made from new technology high viscosity base oil and high performance additives designed for longer oil drain performance on heavy duty diesel and gasoline engines.                  ', '36', null);
INSERT INTO `product_tb` VALUES ('136', 'RAIMOLâ„¢ LUBRO 40 CF4/SG', 'LUBRO 40 CF4/SG is diesel engine oil especially designed for lubrication of medium and high speed trunk piston engines. It consists of premium quality, hydro cracked mineral base oils and additives for premium service performance.                         ', '36', null);
INSERT INTO `product_tb` VALUES ('137', 'RAIMOLâ„¢ GELO SUPER 20W50', 'GELO SUPER 20W50 is premium-grade motor oil formulated from high viscosity index base oil and high performance additives designed to provide excellent engine protection and cleaner engine to assure longer engine service life.                              ', '37', null);
INSERT INTO `product_tb` VALUES ('138', 'RAIMOLâ„¢ GELO SUPER 20W40', 'GELO SUPER 20W40 is premium-grade motor oil formulated from high viscosity index base oil and high performance additives designed to provide excellent engine protection and cleaner engine to assure longer engine service life.                              ', '37', null);
INSERT INTO `product_tb` VALUES ('139', 'RAIMOLâ„¢ GELO SAE50', 'GELO SAE50 is premium-grade motor oil formulated from high viscosity index base oil and high performance additives designed to provide excellent engine protection and cleaner engine to assure longer engine service life.                                    ', '37', null);
INSERT INTO `product_tb` VALUES ('140', 'RAIMOLâ„¢ CHASSIS GREASE', 'Calcium-based grease formulated to meet a wide variety of lubrication functions. Manufactured using a special process, which allows the product to retain its consistency and oil retention properties overtime. The product demonstrates exceptional stability', '38', null);
INSERT INTO `product_tb` VALUES ('141', 'RAIMOLâ„¢ FOOD MACHINERY GREASE', 'Composed entirely of ingredients that meet the requirements of Section 21 CFR 178.3570 of the US Food and Drug Administration regulations. It fully qualifies as a NSF Type H-1 food grade lubricant. It is white, odorless and tasteless.                     ', '38', null);
INSERT INTO `product_tb` VALUES ('142', 'RAIMOLâ„¢ LITHIUM COMPLEX EP GREASE', 'Premium lithium complex, extreme pressure, high-temperature grease. It has excellent performance properties at both high and low temperatures.                                                    ', '38', null);
INSERT INTO `product_tb` VALUES ('143', 'RAIMOLâ„¢ MULTI-PURPOSE GREASE', 'Medium consistency calcium-based or lithium-based grease with good mechanical stability and excellent water-resistant properties. Heavy bodied and smooth textured; it clings tenaciously to surfaces to resist grease throw-out.                              ', '38', null);
INSERT INTO `product_tb` VALUES ('144', 'RAIMOLâ„¢ NON-MELT', 'High quality, high temperature clay-based greases, which do not melt. Also will not run or drip even at temperature up to 260ÂºC. Contains special additive to help it adhered to the surfaces to which is applied.                                            ', '38', null);
INSERT INTO `product_tb` VALUES ('145', 'RAIMOLâ„¢ REINDRO 10', 'REINDRO 10 (Hydraulic Oil ISO VG 10)is formulated from a very high quality paraffinic, high viscosity index base oils and a balanced blend of synergistic and protective additives to give them superior performance over ordinary hydraulic fluids.           ', '39', null);
INSERT INTO `product_tb` VALUES ('146', 'RAIMOLâ„¢ REINDRO 22', 'REINDRO 22 (Hydraulic Oil ISO VG 22) is formulated from a very high quality paraffinic, high viscosity index base oils and a balanced blend of synergistic and protective additives to give them superior performance over ordinary hydraulic fluids.          ', '39', null);
INSERT INTO `product_tb` VALUES ('147', 'RAIMOLâ„¢ REINDRO 32', 'REINDRO 32 (Hydraulic Oil ISO VG 32) is formulated from a very high quality paraffinic, high viscosity index base oils and a balanced blend of synergistic and protective additives to give them superior performance over ordinary hydraulic fluids.          ', '39', null);
INSERT INTO `product_tb` VALUES ('148', 'RAIMOLâ„¢ REINDRO 46', 'REINDRO 46 (Hydraulic Oil ISO VG 46) is formulated from a very high quality paraffinic, high viscosity index base oils and a balanced blend of synergistic and protective additives to give them superior performance over ordinary hydraulic fluids.          ', '39', null);
INSERT INTO `product_tb` VALUES ('149', 'RAIMOLâ„¢ REINDRO 68', 'REINDRO 68 (Hydraulic Oil ISO VG 68) is formulated from a very high quality paraffinic, high viscosity index base oils and a balanced blend of synergistic and protective additives to give them superior performance over ordinary hydraulic fluids.          ', '39', null);
INSERT INTO `product_tb` VALUES ('150', 'RAIMOLâ„¢ REINDRO 100', 'REINDRO 100 (Hydraulic Oil ISO VG 100) is formulated from a very high quality paraffinic, high viscosity index base oils and a balanced blend of synergistic and protective additives to give them superior performance over ordinary hydraulic fluids.        ', '39', null);
INSERT INTO `product_tb` VALUES ('151', 'RAIMOLâ„¢ REINDRO 150 ', 'REINDRO 150 (Hydraulic Oil ISO VG 150) is formulated from a very high quality paraffinic, high viscosity index base oils and a balanced blend of synergistic and protective additives to give them superior performance over ordinary hydraulic fluids.        ', '39', null);
INSERT INTO `product_tb` VALUES ('152', 'RAIMOLâ„¢ REINDRO 220', 'REINDRO 220 (Hydraulic Oil ISO VG 220) is formulated from a very high quality paraffinic, high viscosity index base oils and a balanced blend of synergistic and protective additives to give them superior performance over ordinary hydraulic fluids.        ', '39', null);
INSERT INTO `product_tb` VALUES ('153', 'RAIMOLâ„¢ REINDRO SWG', 'REINDRO SWG is a water-glycol fire resistant fluid developed specially to serve the needs of the die casting industry. It contains adequate water to prevent fire propagation should a hydraulic line break, and has the necessary lubricating and anti-wear pr', '39', null);
INSERT INTO `product_tb` VALUES ('154', 'RAIMOLâ„¢ GEAR 68', 'RAIMOL GEAR 68 is a high quality manual transmission gear lubricants specially formulated to provide excellent extreme pressure protection for heavy duty service.                                                    ', '40', null);
INSERT INTO `product_tb` VALUES ('155', 'RAIMOLâ„¢ GEAR 100', 'RAIMOL GEAR 100 is a high quality manual transmission gear lubricants specially formulated to provide excellent extreme pressure protection for heavy duty service.                                                    ', '40', null);
INSERT INTO `product_tb` VALUES ('156', 'RAIMOLâ„¢ GEAR 150', 'RAIMOL GEAR 150 is a high quality manual transmission gear lubricants specially formulated to provide excellent extreme pressure protection for heavy duty service.                                                    ', '40', null);
INSERT INTO `product_tb` VALUES ('157', 'RAIMOLâ„¢ GEAR 220 ', 'RAIMOL GEAR 220 is a high quality manual transmission gear lubricants specially formulated to provide excellent extreme pressure protection for heavy duty service.                                                    ', '40', null);
INSERT INTO `product_tb` VALUES ('158', 'RAIMOLâ„¢ GEAR 320', 'RAIMOL GEAR 320 is a high quality manual transmission gear lubricants specially formulated to provide excellent extreme pressure protection for heavy duty service.                                                    ', '40', null);
INSERT INTO `product_tb` VALUES ('159', 'RAIMOLâ„¢ GEAR 460', 'RAIMOL GEAR 460 is a high quality manual transmission gear lubricants specially formulated to provide excellent extreme pressure protection for heavy duty service.                                                    ', '40', null);
INSERT INTO `product_tb` VALUES ('160', 'RAIMOLâ„¢ LUBRO M30R', 'LUBRO M30R is a SAE 30 12 TBN marine diesel engine oil especially designed for lubrication of medium and high speed trunk piston engines. It consists of premium quality, high-viscosity mineral base oils and additives for premium service performance.      ', '41', null);
INSERT INTO `product_tb` VALUES ('161', 'RAIMOLâ„¢ LUBRO M40R', 'LUBRO M40R is a SAE 40 12 TBN marine diesel engine oil especially designed for lubrication of medium and high speed trunk piston engines. It consists of premium quality, high-viscosity mineral base oils and additives for premium service performance.      ', '41', null);
INSERT INTO `product_tb` VALUES ('162', 'RAIMOLâ„¢ LUBRO M50R', 'LUBRO M50R is a SAE 50 12 TBN marine diesel engine oil especially designed for lubrication of medium and high speed trunk piston engines. It consists of premium quality, high-viscosity mineral base oils and additives for premium service performance.      ', '41', null);
INSERT INTO `product_tb` VALUES ('163', 'RAIMOLâ„¢ BIO 21', 'BIO 21 is a high performance, high viscosity lubricant developed especially for the lubrication of all type of stern tube bearings used in ships. RAIMOL BIO 21 is formulated from relatively high viscosity index base oils combined with emulsifiers, surface', '41', null);
INSERT INTO `product_tb` VALUES ('164', 'RAIMOLâ„¢ LOW TOX', 'LOW TOX is a low toxicity turbine oil with advanced product technology that exceeds the performance of premium turbine oils, yet affords low eco-toxicity to address environmental concerns.                                                    ', '41', null);
INSERT INTO `product_tb` VALUES ('165', 'RAIMOLâ„¢ HONO', 'RAIMOL HONO is a premium quality straight (neat) metalworking fluid blended from high quality, low viscosity, highly refined mineral oils and neutral fatty oils, fortified with anti-wear additive, and rust inhibitors.                                      ', '42', null);
INSERT INTO `product_tb` VALUES ('166', 'RAIMOLâ„¢ QBATH', 'QBATH Quenching Oil is based on a low viscosity, high flash point, refined mineral fortified synthetic additives. It is free from ingredients such as asphalt.                                                    ', '42', null);
INSERT INTO `product_tb` VALUES ('167', 'RAIMOLâ„¢ FLASH 2T', 'FLASH 2T is a premium grade engine oil developed for the lubrication of all two-stroke (2T) cycle motorcycle oil API TA gasoline engines. Paraffinic, high viscosity oil blended with special additives.                                                    ', '43', null);
INSERT INTO `product_tb` VALUES ('168', 'RAIMOLâ„¢ FLASH 4T', 'FLASH 4T is a premium grade engine oil developed for the lubrication of all four-stroke (4T) cycle motorcycle oil API SJ gasoline engines. Paraffinic, high viscosity oil blended with special additives.                                                    ', '43', null);
INSERT INTO `product_tb` VALUES ('169', 'RAIMOLâ„¢ DASH 4T', 'DASH 4T is a SAE 20W50 grade motorcycle oil developed for the lubrication of all four-stroke engines. Formulated from high viscosity mineral oils blended with additives to provide quality performance in four-stoke motorcycle engines.                      ', '43', null);
INSERT INTO `product_tb` VALUES ('170', 'RAIMOLâ„¢ WAYLUBE32', 'WAYLUBE 32 is special oil designed for the lubrication of machine tool slides and tables. It is based on high viscosity index, highly refined mineral oils that contain additives to enhance tackiness and anti-wear characteristics and resistance to returns ', '44', null);
INSERT INTO `product_tb` VALUES ('171', 'RAIMOLâ„¢ WAYLUBE46 ', 'WAYLUBE 46 is special oil designed for the lubrication of machine tool slides and tables. It is based on high viscosity index, highly refined mineral oils that contain additives to enhance tackiness and anti-wear characteristics and resistance to returns ', '44', null);
INSERT INTO `product_tb` VALUES ('172', 'RAIMOLâ„¢ WAYLUBE68', 'WAYLUBE 68 is special oil designed for the lubrication of machine tool slides and tables. It is based on high viscosity index, highly refined mineral oils that contain additives to enhance tackiness and anti-wear characteristics and resistance to returns ', '44', null);
INSERT INTO `product_tb` VALUES ('173', 'RAIMOLâ„¢ WAYLUBE100', 'WAYLUBE 100 is special oil designed for the lubrication of machine tool slides and tables. It is based on high viscosity index, highly refined mineral oils that contain additives to enhance tackiness and anti-wear characteristics and resistance to returns', '44', null);
INSERT INTO `product_tb` VALUES ('174', 'RAIMOLâ„¢ WAYLUBE150', 'WAYLUBE 150 is special oil designed for the lubrication of machine tool slides and tables. It is based on high viscosity index, highly refined mineral oils that contain additives to enhance tackiness and anti-wear characteristics and resistance to returns', '44', null);
INSERT INTO `product_tb` VALUES ('175', 'RAIMOLâ„¢ SPINLUBE 22', 'SPINLUBE 22 spindle oil is a premium quality lubricant to meet the stringent requirements of high speed spinning machine elements like spindles found in the machines of textile industries.                                                    ', '45', null);
INSERT INTO `product_tb` VALUES ('176', 'RAIMOLâ„¢ FD STAMP', 'FD STAMP fast dry stamping oil is a premium quality, low viscosity, oil base lubricant specially formulated for stamping operations on thin metal sheets. It evaporates fast, leaving a very thin and non-greasy film which will protect the stamped parts from', '46', null);
INSERT INTO `product_tb` VALUES ('177', 'RAIMOLâ„¢ SD STAMP ', 'SD STAMP slow dry stamping oil is a premium quality oil base lubricant specially formulated for stamping operations on extremely hard and thick board materials. It is also high lubricating.                                                    ', '46', null);
INSERT INTO `product_tb` VALUES ('178', 'RAIMOLâ„¢ OT STAMP', 'OT STAMP or oil type stamping oil is a slow drying and high lubricating. It is especially designed for extremely hard and thick board materials, also suitable for repititive stamping and cutting processes.                                                  ', '46', null);
INSERT INTO `product_tb` VALUES ('179', 'RAIMOLâ„¢ TRANS', 'Highly refined, inhibited and non-inhibited, naphthenic transformer oils for use where insulating oils meeting ASTM D3487 Type II(inhibited) and Type I (non-inhibited) transformer oil specifications are recommended. It is used in oil-filled transformers, ', '47', null);
INSERT INTO `product_tb` VALUES ('180', 'RAIMOLâ„¢ TRANS SUPER', 'TRANS SUPER is an uninhibited insulating transformer oil, meeting IEC 60296 (03) General specifications.                                                    ', '47', null);
INSERT INTO `product_tb` VALUES ('181', 'RAIMOLâ„¢ HYDRO T32 ', 'HYDRO T32 (Turbine Oil ISO VG 32) is based on a blend of specially chosen highly refined lubricating oil with selected additives to enhance their rust and oxidation properties.                                                    ', '48', null);
INSERT INTO `product_tb` VALUES ('182', 'RAIMOLâ„¢ HYDRO T46', 'HYDRO T46 (Turbine Oil ISO VG 46) is based on a blend of specially chosen highly refined lubricating oil with selected additives to enhance their rust and oxidation properties.                                                    ', '48', null);
INSERT INTO `product_tb` VALUES ('183', 'RAIMOLâ„¢ HYDRO T68', 'HYDRO T68 (Turbine Oil ISO VG 68) is based on a blend of specially chosen highly refined lubricating oil with selected additives to enhance their rust and oxidation properties.                                                    ', '48', null);
INSERT INTO `product_tb` VALUES ('184', 'RAIMOLâ„¢ HYDRO TS68', 'HYDRO TS68 (Synthetic Turbine Oil ISO VG68) is based on a blend of specially chosen highly refined mineral oils with selected additives to enhance their rust and oxidation properties.                                                    ', '48', null);

-- ----------------------------
-- Table structure for `purchase_order_item_tb`
-- ----------------------------
DROP TABLE IF EXISTS `purchase_order_item_tb`;
CREATE TABLE `purchase_order_item_tb` (
  `po_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id` int(11) NOT NULL,
  `pwo_id` int(11) DEFAULT NULL,
  `product_description` varchar(60) NOT NULL,
  `qty` int(5) NOT NULL,
  `unit_material` int(11) NOT NULL,
  `product_price_id` int(11) DEFAULT NULL,
  `unit_price` decimal(11,2) DEFAULT NULL,
  `so_item_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`po_item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchase_order_item_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `purchase_order_tb`
-- ----------------------------
DROP TABLE IF EXISTS `purchase_order_tb`;
CREATE TABLE `purchase_order_tb` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id_string` varchar(20) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `delivery_address_id` int(11) DEFAULT NULL,
  `order_amount` decimal(10,2) DEFAULT NULL,
  `terms` varchar(15) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `order_date` date NOT NULL,
  `so_id` int(11) DEFAULT NULL,
  `dr_id` varchar(20) DEFAULT NULL,
  `sc_approved` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `payment_method` varchar(30) DEFAULT NULL,
  `disapproved_comment` text,
  `date_created` date DEFAULT NULL,
  `order_comment` varchar(255) DEFAULT NULL,
  `store_flag` tinyint(1) DEFAULT NULL,
  `archive_flag` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`po_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchase_order_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `role_limit_tb`
-- ----------------------------
DROP TABLE IF EXISTS `role_limit_tb`;
CREATE TABLE `role_limit_tb` (
  `role_limit_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `limit` int(11) DEFAULT NULL,
  PRIMARY KEY (`role_limit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of role_limit_tb
-- ----------------------------
INSERT INTO `role_limit_tb` VALUES ('1', '1', '2');
INSERT INTO `role_limit_tb` VALUES ('2', '2', '3');
INSERT INTO `role_limit_tb` VALUES ('3', '3', '2');
INSERT INTO `role_limit_tb` VALUES ('4', '4', '2');
INSERT INTO `role_limit_tb` VALUES ('5', '5', '3');
INSERT INTO `role_limit_tb` VALUES ('6', '6', '1');
INSERT INTO `role_limit_tb` VALUES ('7', '7', '2');
INSERT INTO `role_limit_tb` VALUES ('8', '8', '4');
INSERT INTO `role_limit_tb` VALUES ('9', '9', '2');
INSERT INTO `role_limit_tb` VALUES ('10', '10', '2');
INSERT INTO `role_limit_tb` VALUES ('11', '11', '2');
INSERT INTO `role_limit_tb` VALUES ('12', '12', '2');
INSERT INTO `role_limit_tb` VALUES ('13', '13', '4');
INSERT INTO `role_limit_tb` VALUES ('14', '14', '2');

-- ----------------------------
-- Table structure for `role_tb`
-- ----------------------------
DROP TABLE IF EXISTS `role_tb`;
CREATE TABLE `role_tb` (
  `role_id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of role_tb
-- ----------------------------
INSERT INTO `role_tb` VALUES ('1', 'President', 'President');
INSERT INTO `role_tb` VALUES ('2', 'Vice President', 'Vice President');
INSERT INTO `role_tb` VALUES ('3', 'Sales Coordinator', 'Sales Coordinator');
INSERT INTO `role_tb` VALUES ('4', 'Head Chemist', 'Head Chemist');
INSERT INTO `role_tb` VALUES ('5', 'Laboratory Analyst', 'Laboratory Analyst');
INSERT INTO `role_tb` VALUES ('6', 'Production Worker', 'Production Worker');
INSERT INTO `role_tb` VALUES ('7', 'General Manager', 'General Manager');
INSERT INTO `role_tb` VALUES ('8', 'Accounting', 'Accounting');
INSERT INTO `role_tb` VALUES ('9', 'Product Manager', 'Product Manager');
INSERT INTO `role_tb` VALUES ('10', 'Quality Assurance Head', 'Quality Assurance Head');
INSERT INTO `role_tb` VALUES ('11', 'Quality Assurance', 'Quality Assurance');
INSERT INTO `role_tb` VALUES ('12', 'Production Staff', 'Production Staff');
INSERT INTO `role_tb` VALUES ('13', 'Inventory Controller', 'Inventory Controller');
INSERT INTO `role_tb` VALUES ('14', 'Admin', 'Admin');

-- ----------------------------
-- Table structure for `sales_order_item_tb`
-- ----------------------------
DROP TABLE IF EXISTS `sales_order_item_tb`;
CREATE TABLE `sales_order_item_tb` (
  `so_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `so_id` varchar(20) NOT NULL,
  `po_item_id` int(11) NOT NULL,
  `pwo_id` int(11) DEFAULT NULL,
  `tax_code_id` int(5) NOT NULL,
  `amount` int(20) DEFAULT NULL,
  `gross_amount` int(20) DEFAULT NULL,
  `tax_amount` int(20) DEFAULT NULL,
  PRIMARY KEY (`so_item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sales_order_item_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `sales_order_tb`
-- ----------------------------
DROP TABLE IF EXISTS `sales_order_tb`;
CREATE TABLE `sales_order_tb` (
  `so_id` int(11) NOT NULL AUTO_INCREMENT,
  `so_id_string` varchar(20) DEFAULT NULL,
  `tax_id` varchar(15) DEFAULT NULL,
  `po_id` varchar(20) NOT NULL,
  `payment_method` int(5) DEFAULT NULL,
  `tracking_no` varchar(20) DEFAULT NULL,
  `sales_representative` varchar(50) DEFAULT NULL,
  `sc_approved` int(11) DEFAULT NULL,
  `gm_approved` int(11) DEFAULT NULL,
  `accountant_approved` int(11) DEFAULT NULL,
  `ceo_approved` int(11) DEFAULT NULL,
  `sc_approved_date` datetime DEFAULT NULL,
  `gm_approved_date` datetime DEFAULT NULL,
  `accountant_approved_date` datetime DEFAULT NULL,
  `ceo_approved_date` datetime DEFAULT NULL,
  `sc_approved_status` tinyint(1) DEFAULT NULL,
  `gm_approved_status` tinyint(1) DEFAULT NULL,
  `accountant_approved_status` tinyint(1) DEFAULT NULL,
  `ceo_approved_status` tinyint(1) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `ceo_disapproved_comment` varchar(255) DEFAULT NULL,
  `sc_disapproved_comment` varchar(255) DEFAULT NULL,
  `gm_disapproved_comment` varchar(255) DEFAULT NULL,
  `accountant_disapproved_comment` varchar(255) DEFAULT NULL,
  `ceo_approved_comment` varchar(255) DEFAULT NULL,
  `archive_status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`so_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sales_order_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `staff_logs_tb`
-- ----------------------------
DROP TABLE IF EXISTS `staff_logs_tb`;
CREATE TABLE `staff_logs_tb` (
  `staff_log_id` int(9) NOT NULL AUTO_INCREMENT,
  `staff_id` int(9) NOT NULL,
  `action` varchar(1000) NOT NULL,
  `time_of_action` datetime DEFAULT '0000-00-00 00:00:00',
  `ip_add` varchar(100) NOT NULL,
  `date_created` datetime DEFAULT '0000-00-00 00:00:00',
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`staff_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of staff_logs_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `staff_role_tb`
-- ----------------------------
DROP TABLE IF EXISTS `staff_role_tb`;
CREATE TABLE `staff_role_tb` (
  `staff_role_id` int(8) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `role_id` int(8) DEFAULT NULL,
  PRIMARY KEY (`staff_role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of staff_role_tb
-- ----------------------------
INSERT INTO `staff_role_tb` VALUES ('1', '1', '1');
INSERT INTO `staff_role_tb` VALUES ('2', '2', '2');
INSERT INTO `staff_role_tb` VALUES ('3', '3', '2');
INSERT INTO `staff_role_tb` VALUES ('4', '4', '3');
INSERT INTO `staff_role_tb` VALUES ('5', '5', '4');
INSERT INTO `staff_role_tb` VALUES ('6', '6', '5');
INSERT INTO `staff_role_tb` VALUES ('7', '7', '5');
INSERT INTO `staff_role_tb` VALUES ('8', '8', '7');
INSERT INTO `staff_role_tb` VALUES ('9', '9', '8');
INSERT INTO `staff_role_tb` VALUES ('10', '10', '8');
INSERT INTO `staff_role_tb` VALUES ('12', '11', '9');
INSERT INTO `staff_role_tb` VALUES ('13', '12', '10');
INSERT INTO `staff_role_tb` VALUES ('14', '13', '11');
INSERT INTO `staff_role_tb` VALUES ('15', '14', '12');
INSERT INTO `staff_role_tb` VALUES ('16', '15', '13');
INSERT INTO `staff_role_tb` VALUES ('17', '16', '13');
INSERT INTO `staff_role_tb` VALUES ('18', '17', '13');
INSERT INTO `staff_role_tb` VALUES ('19', '18', '14');
INSERT INTO `staff_role_tb` VALUES ('155', '104', '13');
INSERT INTO `staff_role_tb` VALUES ('154', '104', '12');
INSERT INTO `staff_role_tb` VALUES ('153', '104', '11');
INSERT INTO `staff_role_tb` VALUES ('152', '104', '10');
INSERT INTO `staff_role_tb` VALUES ('151', '104', '9');
INSERT INTO `staff_role_tb` VALUES ('150', '104', '8');
INSERT INTO `staff_role_tb` VALUES ('149', '104', '7');
INSERT INTO `staff_role_tb` VALUES ('148', '104', '6');
INSERT INTO `staff_role_tb` VALUES ('147', '104', '5');
INSERT INTO `staff_role_tb` VALUES ('146', '104', '4');
INSERT INTO `staff_role_tb` VALUES ('145', '104', '3');
INSERT INTO `staff_role_tb` VALUES ('144', '104', '2');
INSERT INTO `staff_role_tb` VALUES ('156', '104', '14');
INSERT INTO `staff_role_tb` VALUES ('143', '104', '1');

-- ----------------------------
-- Table structure for `staff_tb`
-- ----------------------------
DROP TABLE IF EXISTS `staff_tb`;
CREATE TABLE `staff_tb` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `primary_email` varchar(50) NOT NULL,
  `secondary_email` varchar(50) DEFAULT NULL,
  `telephone_no` varchar(20) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `signature` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `date_created` date NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of staff_tb
-- ----------------------------
INSERT INTO `staff_tb` VALUES ('1', 'Zeus', 'Scott', 'Hernandez', 'Male', '810-5223 Mattis St.', 'White Plains', 'Virginia', 'Qatar', 'vel.vulputate@lectus.ca', 'vel.vulputate@lectus.cad', '(435) 675-4103      ', '1 23 272 7466-2312', '2016-04-11', '1331197601.president_sig.jpg', '2015-03-12', 'Wing', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('2', 'Baker', 'Quintessa', 'Griffin', 'Male', 'P.O. Box 416, 1864 Libero. Av.', 'Rock Island', 'YT', 'French Guiana', 'dis.parturient.montes@lacuspede.edu', 'enim.Sed.nulla@lectusrutrum.edu', '(783) 184-7167', '1 19 226 1194-2216', '2006-09-11', '1331197621.vpres_sig.jpg', '2001-10-11', 'Salvador', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('3', 'Wallace', 'Meghan', 'Patton', 'Male', 'Ap #973-584 Pede, St.', 'Woburn', 'SK', 'Bahrain', 'habitant.morbi@viverraDonectempus.com', 'urna.Nunc@dignissimtempor.edu', '(782) 361-9361', '1 63 263 2479-4745', '2011-11-11', '1331197634.vpres_sig.jpg', '2013-03-12', 'Orson', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('4', 'Burton', 'Scarlet', 'Guzman', 'Female', '9720 Conubia Avenue', 'Rehoboth Beach', 'New Brunswick', 'Saint Helena', 'vel@ligula.org', 'magna.a.tortor@Aliquameratvolutpat.com', '(781) 249-3221      ', '1 52 259 4737-0084', '2018-07-11', '1331197648.salescoord_sig.jpg', '2013-07-11', 'George', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('5', 'Chandler', 'Barclay', 'Frank', 'Female', '545-5644 Felis Ave', 'Jeannette', 'Yukon', 'Namibia', 'imperdiet@aptenttacitisociosqu.com', 'Duis.cursus.diam@mollis.com', '(221) 663-7925', '1 65 119 7126-4872', '2007-10-11', '1331174968.74090_1572681791687_1074793203_31671000_6317306_ns.jpg', '2023-02-12', 'Nash', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('6', 'Amir', 'Kylynn', 'Kelly', 'Female', 'P.O. Box 849, 8721 Amet Rd.', 'Coral Springs', 'NS', 'Singapore', 'tristique.senectus.et@Suspendisse.edu', 'Etiam@urnanec.com', '(830) 200-6573      ', '1 27 209 7559-0370', '2025-12-11', '1331197664.labanalyst_sig.jpg', '2031-12-11', 'Lucius', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('7', 'Lane', 'Flavia', 'Stout', 'Male', '664-7460 Vulputate Road', 'Loudon', 'Quebec', 'Guyana', 'Vestibulum.ut.eros@dui.org', 'Donec@pellentesque.org', '(203) 369-6513      ', '1 96 961 7471-8194', '2018-07-11', '1331197678.labanalyst_sig.jpg', '2006-02-12', 'Davis', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('8', 'Zeph', 'Arthur', 'Hewitt', 'Female', '539-1555 Morbi St.', 'Newburyport', 'QC', 'Qatar', 'et.magnis.dis@egestaslacinia.edu', 'felis.Donec@felisNulla.org', '(426) 856-8931', '1 16 622 4087-4557', '2017-05-11', '1331197711.genmanager_sig.jpg', '2023-10-11', 'Tate', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('9', 'Dorian', 'Rhona', 'Goff', 'Female', '703-8377 Porttitor Rd.', 'Cedar City', 'Northwest Territories', 'Cape Verde', 'neque.In@euerosNam.org', 'enim@etrisusQuisque.com', '(348) 131-8691', '1 24 805 3436-8513', '2005-06-11', '1331197727.accountant_sig.jpg', '2009-05-12', 'Ferdinand', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('10', 'Dane', 'Arsenio', 'Henry', 'Female', 'P.O. Box 224, 7470 Metus. Street', 'York', 'AZ', 'Burkina Faso', 'vestibulum@accumsansed.edu', 'diam@nisidictum.edu', '(411) 744-7816', '1 23 793 9040-7627', '2020-10-11', '1331197742.accountant_sig.jpg', '2030-09-12', 'Christian', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('11', 'Dolan', 'Rajah', 'Grimes', 'Female', 'Ap #659-463 Tincidunt Avenue', 'Seward', 'NS', 'Israel', 'dictum.augue.malesuada@inconsequatenim.com', 'Mauris@parturientmontes.com', '(316) 939-7750      ', '1 62 660 9130-5761', '2024-07-11', '1331197762.prodmanager_sig.jpg', '2006-09-11', 'James', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('12', 'Brennan', 'Lev', 'Lucas', 'Female', '3195 Nullam St.', 'Dallas', 'New Brunswick', 'Estonia', 'nec@fringillaestMauris.org', 'tempor.est@Nullasempertellus.ca', '(735) 440-5060', '1 17 949 6740-7728', '2020-05-11', '1331197790.qahead_sig.jpg', '2017-06-12', 'Martin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('13', 'Lane', 'Logan', 'Duffy', 'Male', '511 Volutpat St.', 'Glendale', 'Northwest Territories', 'Slovakia', 'Fusce@elitpharetraut.edu', 'eget@metuseu.com', '(781) 968-5206      ', '1 60 664 1017-0991', '2030-04-11', '1331197806.qa-sig.jpg', '2006-04-12', 'Theodore', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('14', 'Ulysses', 'Curran', 'Daniel', 'Female', 'P.O. Box 651, 676 Metus. Street', 'Fredericksburg', 'Delaware', 'Cayman Islands', 'ipsum.cursus.vestibulum@Sed.edu', 'vehicula.et@lorem.edu', '(481) 571-7996', '1 20 224 8959-9675', '2007-03-11', '1331197821.productionstaff_sig.jpg', '2022-12-12', 'Valentine', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('15', 'Brian', 'Nerea', 'Mccormick', 'Female', '3254 Libero. Road', 'DuBois', 'Delaware', 'Tonga', 'a@gravida.com', 'ut.eros@auctor.edu', '(227) 877-9436', '1 47 579 5596-1873', '2008-10-11', '1331197833.inventorycontroller_sig.jpg', '2006-02-11', 'Travis', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('16', 'Stuart', 'Norman', 'Doyle', 'Male', 'Ap #110-8240 Lectus Rd.', 'Gaithersburg', 'NU', 'Greenland', 'blandit.at@mattis.com', 'ut@utpharetrased.edu', '(178) 466-0919', '1 56 939 8906-0315', '2021-02-11', '1331197847.inventorycontroller_sig.jpg', '2022-02-11', 'Hasad', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('17', 'Amos', 'Reece', 'Jensen', 'Male', 'Ap #703-2297 Venenatis Road', 'Hopkinsville', 'Arkansas', 'Costa Rica', 'nulla@liberoduinec.org', 'ultrices.mauris.ipsum@euismodet.com', '(626) 276-9115      ', '1 67 381 3723-6439', '2005-05-11', '1331197859.inventorycontroller_sig.jpg', '2028-05-11', 'Elijah', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('18', 'Gannon', 'Nehru', 'Coleman', 'Male', 'Ap #965-3516 Magnis St.', 'Fulton', 'AB', 'Burkina Faso', 'erat.neque@atrisusNunc.org', 'sit@risusquis.org', '(169) 103-7250', '1 32 165 2652-9687', '2030-08-11', '1331198194.productionstaff_sig.jpg', '2022-04-11', 'Kane', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('104', 'Theodore Earl', 'Gonzales', 'Dizon', 'Male', '12 Gov. Licaros', 'Las Pinas', 'Metro Manila', 'Philippines', 'theodore_dizon@yahoo.com', 'cj_esmejarda@yahoo.com', '828282', '9292828', '0000-00-00', '1331194771.sign.jpg', '2012-02-28', 'theodoredizon', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');

-- ----------------------------
-- Table structure for `supplier_tb`
-- ----------------------------
DROP TABLE IF EXISTS `supplier_tb`;
CREATE TABLE `supplier_tb` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(30) NOT NULL,
  `telephone_no` varchar(20) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `middle_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of supplier_tb
-- ----------------------------

-- ----------------------------
-- Table structure for `system_settings_tb`
-- ----------------------------
DROP TABLE IF EXISTS `system_settings_tb`;
CREATE TABLE `system_settings_tb` (
  `id` int(11) NOT NULL,
  `records_per_page` int(11) DEFAULT NULL,
  `po_seed` int(4) DEFAULT NULL,
  `pwo_seed` int(4) DEFAULT NULL,
  `so_seed` int(4) DEFAULT NULL,
  `formula_seed` int(4) DEFAULT NULL,
  `pbt_seed` int(4) DEFAULT NULL,
  `dr_seed` int(4) DEFAULT NULL,
  `fg_seed` int(4) DEFAULT NULL,
  `baseoil_seed` int(4) DEFAULT NULL,
  `additives_seed` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of system_settings_tb
-- ----------------------------
INSERT INTO `system_settings_tb` VALUES ('1', '15', '1', '1', '1', '1', '1', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for `tax_code_tb`
-- ----------------------------
DROP TABLE IF EXISTS `tax_code_tb`;
CREATE TABLE `tax_code_tb` (
  `tax_code_id` int(5) NOT NULL AUTO_INCREMENT,
  `description` varchar(15) NOT NULL,
  `child_tax_code` int(5) DEFAULT NULL,
  `rate` int(5) DEFAULT NULL,
  PRIMARY KEY (`tax_code_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tax_code_tb
-- ----------------------------
INSERT INTO `tax_code_tb` VALUES ('1', 'VAT-PH:S-PH', null, '12');
INSERT INTO `tax_code_tb` VALUES ('2', 'NON-VAT', null, '0');
INSERT INTO `tax_code_tb` VALUES ('3', 'VAT-PH:Z-PH', null, null);

-- ----------------------------
-- Table structure for `unit_material_type_tb`
-- ----------------------------
DROP TABLE IF EXISTS `unit_material_type_tb`;
CREATE TABLE `unit_material_type_tb` (
  `um_id` int(5) NOT NULL AUTO_INCREMENT,
  `description` varchar(15) NOT NULL,
  `size_liters` int(11) DEFAULT NULL,
  `box_per_sku` int(11) DEFAULT NULL,
  PRIMARY KEY (`um_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of unit_material_type_tb
-- ----------------------------
INSERT INTO `unit_material_type_tb` VALUES ('1', 'Drum', '200', null);
INSERT INTO `unit_material_type_tb` VALUES ('2', 'Pail', '18', null);
INSERT INTO `unit_material_type_tb` VALUES ('3', 'Box', '4', '6');
INSERT INTO `unit_material_type_tb` VALUES ('4', 'Box', '1', '24');
INSERT INTO `unit_material_type_tb` VALUES ('5', 'Box', '1', '12');
INSERT INTO `unit_material_type_tb` VALUES ('7', 'Pail', '20', null);
