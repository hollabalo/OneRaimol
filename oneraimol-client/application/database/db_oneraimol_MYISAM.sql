/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50141
Source Host           : localhost:3306
Source Database       : db_oneraimol

Target Server Type    : MYSQL
Target Server Version : 50141
File Encoding         : 65001

Date: 2012-02-24 01:58:01
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
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customer_tb
-- ----------------------------
INSERT INTO `customer_tb` VALUES ('1', 'Emma', 'Faith', 'Butler', 'Male', 'Nam.ligula@Ut.ca', 'Curabitur@sagittisfelis.ca', '0000-00-00', '1-753-330-7732', '(419) 659-4825', 'Skyler', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Borland', '0');
INSERT INTO `customer_tb` VALUES ('2', 'Alana', 'Katell', 'Gregory', 'Male', 'amet.risus.Donec@mattis.edu', 'Integer@molestietellusAenean.com', '0000-00-00', '1-835-924-2170', '(873) 800-9052', 'Hyacinth', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Google', '1');
INSERT INTO `customer_tb` VALUES ('3', 'Vincent', 'Christen', 'Frederick', 'Male', 'non@incursus.edu', 'tristique.aliquet@tristique.edu', '0000-00-00', '1-758-466-3658', '(216) 386-8781', 'Rama', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Microsoft', '0');
INSERT INTO `customer_tb` VALUES ('4', 'Bell', 'Lillian', 'Levy', 'Female', 'pretium.neque.Morbi@utmi.org', 'sem@pede.ca', '0000-00-00', '1-191-365-9126', '(759) 129-0345', 'Dylan', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Yahoo', '1');
INSERT INTO `customer_tb` VALUES ('5', 'Isaac', 'Petra', 'Rowland', 'Male', 'libero.nec@vestibulum.org', 'dui@fringillaeuismodenim.edu', '0000-00-00', '1-373-191-0921', '(850) 807-4442', 'Lael', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Finale', '0');
INSERT INTO `customer_tb` VALUES ('6', 'Levi', 'Savannah', 'Macias', 'Female', 'orci.Phasellus@miloremvehicula.edu', 'hendrerit.a@Morbineque.edu', '0000-00-00', '1-188-710-4827', '(766) 816-0746', 'Julian', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Apple Systems', '1');
INSERT INTO `customer_tb` VALUES ('7', 'Kiona', 'Nina', 'Scott', 'Male', 'sagittis.felis@lobortisrisusIn.org', 'Aliquam.ornare@ipsumdolor.ca', '0000-00-00', '1-906-363-1169', '(996) 504-1619', 'Sylvia', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Apple Systems', '1');
INSERT INTO `customer_tb` VALUES ('8', 'Tiger', 'Destiny', 'Moreno', 'Female', 'consectetuer@acorci.org', 'eu.tempor.erat@Vivamusnon.ca', '0000-00-00', '1-262-143-4498', '(442) 123-9156', 'Adam', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Chami', '1');
INSERT INTO `customer_tb` VALUES ('9', 'Alea', 'Cassidy', 'Neal', 'Female', 'Sed.nunc@tellus.com', 'vestibulum.Mauris@adipiscingfringilla.edu', '0000-00-00', '1-564-914-4471', '(524) 881-5832', 'Ocean', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Apple Systems', '0');
INSERT INTO `customer_tb` VALUES ('10', 'Aspen', 'Gay', 'Snow', 'Male', 'Nam.tempor.diam@etmagnis.ca', 'facilisi.Sed.neque@ullamcorpermagnaSed.com', '0000-00-00', '1-607-444-5456', '(714) 473-4763', 'Yvonne', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Apple Systems', '1');
INSERT INTO `customer_tb` VALUES ('11', 'Upton', 'Keiko', 'Livingston', 'Female', 'nec@ante.com', 'a.odio@Fusce.com', '0000-00-00', '1-259-763-2977', '(773) 303-2987', 'Leonard', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Finale', '0');
INSERT INTO `customer_tb` VALUES ('12', 'Brody', 'Ella', 'Chambers', 'Female', 'facilisis.Suspendisse.commodo@imperdiet.ca', 'Sed.eu@nasceturridiculusmus.com', '0000-00-00', '1-538-296-2663', '(780) 773-1852', 'Peter', '5baa61e4q9b93f3f0682250b6ff8331b7ee68fd8', 'Sibelius', '0');
INSERT INTO `customer_tb` VALUES ('13', 'Zena', 'Nina', 'Sanford', 'Male', 'dui.augue@aenim.com', 'arcu.Nunc.mauris@posuere.org', '0000-00-00', '1-987-968-3091', '(753) 323-4202', 'MacKenzie', '5baa61e4n9b93f3f0682250b6wf8331b7ee68fd8', 'Macromedia', '0');
INSERT INTO `customer_tb` VALUES ('14', 'Meredith', 'Iris', 'Bates', 'Female', 'tempor@fringilla.ca', 'elit.erat@ac.edu', '0000-00-00', '1-708-770-3642', '(289) 413-5875', 'Margaret', '5baa61e4x9b93f3f0682250b6df8331b7ee68fd8', 'Chami', '1');
INSERT INTO `customer_tb` VALUES ('15', 'Tobias', 'Iliana', 'Houston', 'Male', 'auctor.ullamcorper@ipsum.com', 'sed.dui@eu.edu', '0000-00-00', '1-801-631-9328', '(518) 465-3598', 'Patrick', '5baa61e4m9b93f3f0682250b6df8331b7ee68fd8', 'Apple Systems', '0');
INSERT INTO `customer_tb` VALUES ('16', 'Dillon', 'Desirae', 'Logan', 'Male', 'pede.nec.ante@eratSednunc.com', 'Aenean.egestas@NullamnislMaecenas.com', '0000-00-00', '1-784-529-8173', '(148) 276-3099', 'Cairo', '5baa61e4r9b93f3f0682250b6qf8331b7ee68fd8', 'Macromedia', '1');
INSERT INTO `customer_tb` VALUES ('17', 'Sophia', 'Camilla', 'Ramsey', 'Male', 'turpis@Mauris.ca', 'vestibulum.lorem.sit@tristique.org', '0000-00-00', '1-221-300-7296', '(844) 844-7365', 'Karyn', '5baa61e4v9b93f3f0682250b6tf8331b7ee68fd8', 'Lycos', '1');
INSERT INTO `customer_tb` VALUES ('18', 'Tamara', 'Kristen', 'Macdonald', 'Female', 'adipiscing.elit@aliquet.com', 'tortor.at@auctorMaurisvel.com', '0000-00-00', '1-301-818-1850', '(242) 754-3409', 'Alyssa', '5baa61e4k9b93f3f0682250b6yf8331b7ee68fd8', 'Microsoft', '1');
INSERT INTO `customer_tb` VALUES ('19', 'Jenna', 'Serena', 'Henson', 'Male', 'sem@nonummyultriciesornare.com', 'augue@intempuseu.edu', '0000-00-00', '1-950-103-6455', '(304) 343-1925', 'Hillary', '5baa61e4h9b93f3f0682250b6lf8331b7ee68fd8', 'Borland', '1');
INSERT INTO `customer_tb` VALUES ('20', 'Fletcher', 'Mara', 'Fulton', 'Female', 'Nullam.nisl.Maecenas@non.ca', 'quis.tristique@InloremDonec.ca', '0000-00-00', '1-203-311-6491', '(752) 114-8501', 'Guinevere', '5baa61e4y9b93f3f0682250b6pf8331b7ee68fd8', 'Cakewalk', '1');
INSERT INTO `customer_tb` VALUES ('21', 'Branden', 'Quon', 'Sweeney', 'Male', 'sed.est@egettincidunt.org', 'lobortis.mauris.Suspendisse@Vivamus.org', '0000-00-00', '1-582-206-3574', '(196) 840-7676', 'Stephen', '5baa61e4h9b93f3f0682250b6df8331b7ee68fd8', 'Finale', '1');
INSERT INTO `customer_tb` VALUES ('22', 'Rogan', 'Penelope', 'Mills', 'Male', 'justo.Proin.non@ipsumcursusvestibulum.edu', 'Vivamus.euismod.urna@arcuVestibulumante.edu', '0000-00-00', '1-601-998-2265', '(406) 648-5261', 'Kevin', '5baa61e4k9b93f3f0682250b6tf8331b7ee68fd8', 'Yahoo', '0');
INSERT INTO `customer_tb` VALUES ('23', 'Ila', 'Ima', 'Alvarado', 'Female', 'Cras.convallis.convallis@rutrumlorem.com', 'Proin.ultrices@ipsumleoelementum.edu', '0000-00-00', '1-357-746-2713', '(135) 546-8908', 'Sybill', '5baa61e4t9b93f3f0682250b6xf8331b7ee68fd8', 'Apple Systems', '0');
INSERT INTO `customer_tb` VALUES ('24', 'Garrett', 'Vanna', 'Macias', 'Female', 'vulputate.nisi.sem@semper.com', 'parturient.montes.nascetur@Integer.edu', '0000-00-00', '1-260-774-8640', '(687) 409-7392', 'Andrew', '5baa61e4x9b93f3f0682250b6ff8331b7ee68fd8', 'Cakewalk', '0');
INSERT INTO `customer_tb` VALUES ('25', 'Knox', 'Alma', 'Slater', 'Female', 'nulla.In@magnaCras.org', 'Sed.congue@risus.edu', '0000-00-00', '1-211-457-5266', '(263) 146-4972', 'Kitra', '5baa61e4l9b93f3f0682250b6bf8331b7ee68fd8', 'Google', '0');
INSERT INTO `customer_tb` VALUES ('26', 'Vernon', 'Lareina', 'Reeves', 'Female', 'sem.eget.massa@placerategetvenenatis.ca', 'fermentum.fermentum@arcuiaculisenim.org', '0000-00-00', '1-365-302-5201', '(409) 832-9276', 'Shoshana', '5baa61e4m9b93f3f0682250b6cf8331b7ee68fd8', 'Adobe', '1');
INSERT INTO `customer_tb` VALUES ('27', 'Signe', 'Mallory', 'Snyder', 'Male', 'neque@imperdieteratnonummy.edu', 'arcu@ipsumnunc.com', '0000-00-00', '1-434-153-4000', '(903) 536-2231', 'Dale', '5baa61e4j9b93f3f0682250b6zf8331b7ee68fd8', 'Lavasoft', '0');
INSERT INTO `customer_tb` VALUES ('28', 'Joshua', 'Claire', 'Copeland', 'Female', 'faucibus@VivamusrhoncusDonec.org', 'imperdiet.non@temporeratneque.edu', '0000-00-00', '1-111-333-5197', '(403) 205-3575', 'Bradley', '5baa61e4y9b93f3f0682250b6vf8331b7ee68fd8', 'Microsoft', '0');
INSERT INTO `customer_tb` VALUES ('29', 'Bethany', 'Yoko', 'Chambers', 'Female', 'eu.nulla@elit.com', 'et.risus.Quisque@magnaDuisdignissim.com', '0000-00-00', '1-941-916-4787', '(512) 360-4706', 'Neil', '5baa61e4l9b93f3f0682250b6vf8331b7ee68fd8', 'Sibelius', '0');
INSERT INTO `customer_tb` VALUES ('30', 'Charde', 'Ori', 'Ware', 'Female', 'amet@eu.ca', 'consectetuer@Sedeget.org', '0000-00-00', '1-364-364-0544', '(822) 302-4203', 'Carla', '5baa61e4g9b93f3f0682250b6mf8331b7ee68fd8', 'Finale', '0');
INSERT INTO `customer_tb` VALUES ('31', 'Jade', 'Kylynn', 'Nichols', 'Female', 'Vivamus.nibh@viverra.edu', 'netus.et@ante.com', '0000-00-00', '1-468-730-2099', '(403) 243-3880', 'Rana', '5baa61e4g9b93f3f0682250b6bf8331b7ee68fd8', 'Yahoo', '0');
INSERT INTO `customer_tb` VALUES ('32', 'Marcia', 'Whitney', 'Dillard', 'Female', 'enim@porttitorinterdumSed.org', 'habitant@Sednunc.ca', '0000-00-00', '1-439-419-7116', '(582) 721-0802', 'Jolene', '5baa61e4k9b93f3f0682250b6pf8331b7ee68fd8', 'Sibelius', '0');
INSERT INTO `customer_tb` VALUES ('33', 'Kaitlin', 'Inez', 'Martinez', 'Male', 'libero.Integer.in@tellusnon.org', 'pretium.et@nibhvulputate.ca', '0000-00-00', '1-193-576-1358', '(999) 562-8164', 'Erin', '5baa61e4n9b93f3f0682250b6wf8331b7ee68fd8', 'Google', '0');
INSERT INTO `customer_tb` VALUES ('34', 'Nathaniel', 'Pascale', 'Barton', 'Female', 'dolor.nonummy.ac@vitaepurus.org', 'ipsum.dolor.sit@variusNamporttitor.com', '0000-00-00', '1-982-797-8675', '(191) 945-4124', 'Petra', '5baa61e4y9b93f3f0682250b6lf8331b7ee68fd8', 'Google', '0');
INSERT INTO `customer_tb` VALUES ('35', 'Cleo', 'Unity', 'Farmer', 'Female', 'eleifend@Integersemelit.org', 'Nam.porttitor@penatibusetmagnis.ca', '0000-00-00', '1-662-872-9893', '(466) 199-5198', 'Violet', '5baa61e4y9b93f3f0682250b6cf8331b7ee68fd8', 'Apple Systems', '1');
INSERT INTO `customer_tb` VALUES ('36', 'Vivian', 'Cheyenne', 'Mercer', 'Male', 'et.ultrices@laciniaatiaculis.edu', 'ante.ipsum.primis@aultricies.edu', '0000-00-00', '1-381-268-4944', '(151) 554-1567', 'Roanna', '5baa61e4f9b93f3f0682250b6bf8331b7ee68fd8', 'Yahoo', '0');
INSERT INTO `customer_tb` VALUES ('37', 'Kyla', 'Beatrice', 'Love', 'Male', 'metus@mus.org', 'at.fringilla@faucibus.org', '0000-00-00', '1-946-728-5332', '(526) 738-8894', 'Vaughan', '5baa61e4d9b93f3f0682250b6pf8331b7ee68fd8', 'Yahoo', '1');
INSERT INTO `customer_tb` VALUES ('38', 'MacKensie', 'Anne', 'Wall', 'Female', 'ac.ipsum@orcitincidunt.org', 'id.ante@tinciduntadipiscing.org', '0000-00-00', '1-331-413-1661', '(895) 603-1630', 'Jaquelyn', '5baa61e4y9b93f3f0682250b6hf8331b7ee68fd8', 'Borland', '0');
INSERT INTO `customer_tb` VALUES ('39', 'Andrew', 'Sarah', 'Brooks', 'Male', 'libero.mauris@mollisDuissit.edu', 'Vivamus@molestietortornibh.com', '0000-00-00', '1-237-254-4961', '(911) 102-5106', 'Elvis', '5baa61e4t9b93f3f0682250b6sf8331b7ee68fd8', 'Borland', '1');
INSERT INTO `customer_tb` VALUES ('40', 'Derek', 'Lydia', 'Monroe', 'Male', 'odio.Etiam@malesuadavel.ca', 'enim.consequat.purus@loremegetmollis.ca', '0000-00-00', '1-365-362-4971', '(831) 317-2339', 'Rachel', '5baa61e4x9b93f3f0682250b6sf8331b7ee68fd8', 'Macromedia', '0');
INSERT INTO `customer_tb` VALUES ('41', 'Jana', 'Deanna', 'Austin', 'Female', 'velit@Cumsociisnatoque.org', 'Donec.non@variusultricesmauris.org', '0000-00-00', '1-772-927-0910', '(486) 488-7307', 'Tyrone', '5baa61e4d9b93f3f0682250b6df8331b7ee68fd8', 'Google', '1');
INSERT INTO `customer_tb` VALUES ('42', 'Dara', 'Rinah', 'Pittman', 'Male', 'cursus@tinciduntduiaugue.com', 'Aenean.gravida.nunc@iaculislacuspede.edu', '0000-00-00', '1-791-447-5434', '(150) 879-3970', 'Cora', '5baa61e4z9b93f3f0682250b6sf8331b7ee68fd8', 'Apple Systems', '1');
INSERT INTO `customer_tb` VALUES ('43', 'Nell', 'Kim', 'Day', 'Male', 'Proin.dolor@egestas.com', 'congue@egetlaoreet.ca', '0000-00-00', '1-795-757-6583', '(569) 680-5457', 'Margaret', '5baa61e4c9b93f3f0682250b6pf8331b7ee68fd8', 'Borland', '0');
INSERT INTO `customer_tb` VALUES ('44', 'Kasimir', 'Cassandra', 'Castro', 'Female', 'interdum.feugiat@faucibusMorbivehicula.org', 'at.fringilla.purus@iaculis.org', '0000-00-00', '1-741-691-6157', '(268) 854-1063', 'Valentine', '5baa61e4h9b93f3f0682250b6cf8331b7ee68fd8', 'Lycos', '0');
INSERT INTO `customer_tb` VALUES ('45', 'Marshall', 'Ivy', 'Osborne', 'Male', 'nulla.Integer@velit.ca', 'enim.Etiam@torquent.ca', '0000-00-00', '1-958-705-2421', '(365) 468-4221', 'Martina', '5baa61e4w9b93f3f0682250b6pf8331b7ee68fd8', 'Cakewalk', '0');
INSERT INTO `customer_tb` VALUES ('46', 'Jade', 'Rachel', 'Downs', 'Female', 'risus@augue.com', 'non@imperdietornareIn.edu', '0000-00-00', '1-416-331-7175', '(728) 241-2894', 'Kai', '5baa61e4b9b93f3f0682250b6kf8331b7ee68fd8', 'Macromedia', '0');
INSERT INTO `customer_tb` VALUES ('47', 'Zena', 'Madaline', 'Camacho', 'Female', 'lobortis@sagittis.ca', 'fermentum.convallis@justofaucibus.com', '0000-00-00', '1-246-894-5305', '(806) 131-5376', 'Salvador', '5baa61e4b9b93f3f0682250b6bf8331b7ee68fd8', 'Cakewalk', '1');
INSERT INTO `customer_tb` VALUES ('48', 'Alisa', 'Nicole', 'Russo', 'Female', 'varius.et@commodo.edu', 'euismod.mauris@metusIn.ca', '0000-00-00', '1-418-576-1011', '(676) 929-6264', 'Sawyer', '5baa61e4h9b93f3f0682250b6jf8331b7ee68fd8', 'Lavasoft', '1');
INSERT INTO `customer_tb` VALUES ('49', 'Barclay', 'Jane', 'Phillips', 'Male', 'molestie@feugiatLoremipsum.org', 'lectus.Nullam.suscipit@tellusAeneanegestas.edu', '0000-00-00', '1-873-868-2898', '(834) 738-3420', 'Melyssa', '5baa61e4l9b93f3f0682250b6nf8331b7ee68fd8', 'Cakewalk', '0');
INSERT INTO `customer_tb` VALUES ('50', 'Azalia', 'Aiko', 'Bowman', 'Female', 'sodales.nisi.magna@malesuadaInteger.ca', 'Nulla@tempor.ca', '0000-00-00', '1-994-436-7275', '(370) 653-7638', 'Kasimir', '5baa61e4f9b93f3f0682250b6jf8331b7ee68fd8', 'Borland', '1');
INSERT INTO `customer_tb` VALUES ('51', 'Guy', 'Halla', 'Griffith', 'Female', 'Vivamus.sit@amet.org', 'Cras@pede.ca', '0000-00-00', '1-770-741-8046', '(573) 533-0774', 'Mariam', '5baa61e4k9b93f3f0682250b6nf8331b7ee68fd8', 'Altavista', '0');
INSERT INTO `customer_tb` VALUES ('52', 'Maggie', 'Tanya', 'William', 'Male', 'pellentesque.massa@velitjusto.edu', 'Morbi@eratvelpede.com', '0000-00-00', '1-409-160-0136', '(449) 728-1871', 'Brady', '5baa61e4f9b93f3f0682250b6wf8331b7ee68fd8', 'Chami', '0');
INSERT INTO `customer_tb` VALUES ('53', 'Brennan', 'Fallon', 'Rogers', 'Female', 'Sed.id@nonfeugiatnec.com', 'lectus.convallis@Maurismolestie.org', '0000-00-00', '1-544-252-9693', '(299) 500-9137', 'Tatiana', '5baa61e4b9b93f3f0682250b6zf8331b7ee68fd8', 'Microsoft', '0');
INSERT INTO `customer_tb` VALUES ('54', 'Galena', 'Chloe', 'Wiley', 'Female', 'massa.Vestibulum@malesuadavel.ca', 'lacinia.mattis.Integer@nunc.org', '0000-00-00', '1-115-649-8272', '(602) 447-4794', 'Justine', '5baa61e4h9b93f3f0682250b6kf8331b7ee68fd8', 'Altavista', '1');
INSERT INTO `customer_tb` VALUES ('55', 'Shay', 'Remedios', 'Payne', 'Male', 'blandit.congue@Crasvulputate.edu', 'nisl@sedfacilisisvitae.org', '0000-00-00', '1-530-644-5484', '(825) 821-7084', 'Danielle', '5baa61e4j9b93f3f0682250b6gf8331b7ee68fd8', 'Apple Systems', '1');
INSERT INTO `customer_tb` VALUES ('56', 'Amir', 'Zelenia', 'Huber', 'Female', 'ornare.placerat.orci@rhoncus.ca', 'purus@mollis.ca', '0000-00-00', '1-331-846-5803', '(194) 340-9503', 'Arsenio', '5baa61e4x9b93f3f0682250b6bf8331b7ee68fd8', 'Altavista', '1');
INSERT INTO `customer_tb` VALUES ('57', 'Minerva', 'Chanda', 'Taylor', 'Male', 'habitant@nibhsit.com', 'malesuada.augue@consectetuermaurisid.ca', '0000-00-00', '1-958-217-4278', '(396) 509-3712', 'Rama', '5baa61e4j9b93f3f0682250b6cf8331b7ee68fd8', 'Borland', '1');
INSERT INTO `customer_tb` VALUES ('58', 'Shelly', 'Isabelle', 'Flynn', 'Female', 'sapien.imperdiet@nonenim.com', 'dolor.Fusce@sed.org', '0000-00-00', '1-878-252-0755', '(786) 528-0123', 'Stacey', '5baa61e4x9b93f3f0682250b6rf8331b7ee68fd8', 'Macromedia', '0');
INSERT INTO `customer_tb` VALUES ('59', 'Bianca', 'Deanna', 'Wood', 'Female', 'et.eros.Proin@purus.edu', 'Nam@ultricies.ca', '0000-00-00', '1-225-425-0861', '(250) 354-6766', 'Haley', '5baa61e4s9b93f3f0682250b6nf8331b7ee68fd8', 'Altavista', '1');
INSERT INTO `customer_tb` VALUES ('60', 'Lila', 'Kylie', 'Klein', 'Female', 'a.scelerisque.sed@acfermentumvel.org', 'vel@Vestibulumaccumsan.com', '0000-00-00', '1-758-474-1443', '(256) 513-3798', 'Ivor', '5baa61e4q9b93f3f0682250b6yf8331b7ee68fd8', 'Adobe', '1');
INSERT INTO `customer_tb` VALUES ('61', 'Charissa', 'Cassady', 'Cleveland', 'Male', 'velit.egestas@non.ca', 'in.tempus@auctorodio.edu', '0000-00-00', '1-109-255-6749', '(208) 405-1263', 'Phoebe', '5baa61e4b9b93f3f0682250b6df8331b7ee68fd8', 'Cakewalk', '1');
INSERT INTO `customer_tb` VALUES ('62', 'Hedda', 'Francesca', 'Cabrera', 'Male', 'Phasellus.vitae@ac.com', 'Aliquam.nec.enim@eleifendvitae.com', '0000-00-00', '1-335-325-7306', '(566) 632-3754', 'Blythe', '5baa61e4b9b93f3f0682250b6rf8331b7ee68fd8', 'Macromedia', '1');
INSERT INTO `customer_tb` VALUES ('63', 'Mason', 'Harriet', 'Middleton', 'Male', 'cubilia.Curae;.Phasellus@consequatenimdiam.org', 'scelerisque@arcuVestibulum.edu', '0000-00-00', '1-577-866-7611', '(289) 279-7424', 'Paloma', '5baa61e4d9b93f3f0682250b6rf8331b7ee68fd8', 'Chami', '1');
INSERT INTO `customer_tb` VALUES ('64', 'Nerea', 'Ocean', 'Bolton', 'Female', 'Curabitur.massa.Vestibulum@iaculisodioNam.org', 'vel.convallis.in@eu.com', '0000-00-00', '1-819-571-4071', '(585) 775-7427', 'Gloria', '5baa61e4f9b93f3f0682250b6sf8331b7ee68fd8', 'Borland', '0');
INSERT INTO `customer_tb` VALUES ('65', 'Fleur', 'TaShya', 'Contreras', 'Male', 'ultrices.iaculis@egetodioAliquam.ca', 'Cras.vulputate@semPellentesque.org', '0000-00-00', '1-792-816-8217', '(639) 928-3575', 'Ali', '5baa61e4c9b93f3f0682250b6qf8331b7ee68fd8', 'Lavasoft', '1');
INSERT INTO `customer_tb` VALUES ('66', 'Desirae', 'Scarlet', 'Norris', 'Male', 'neque.Nullam@porttitorscelerisqueneque.com', 'In.condimentum.Donec@ridiculusmusProin.com', '0000-00-00', '1-968-983-4828', '(472) 327-8465', 'Kennedy', '5baa61e4c9b93f3f0682250b6rf8331b7ee68fd8', 'Altavista', '1');
INSERT INTO `customer_tb` VALUES ('67', 'Cameron', 'Barbara', 'Stuart', 'Male', 'venenatis.lacus@neque.ca', 'Curae;@Curabiturvel.com', '0000-00-00', '1-979-428-7476', '(841) 214-8247', 'Elton', '5baa61e4b9b93f3f0682250b6lf8331b7ee68fd8', 'Macromedia', '1');
INSERT INTO `customer_tb` VALUES ('68', 'Reed', 'Patricia', 'Hess', 'Male', 'egestas.blandit@pharetrafelis.ca', 'est.arcu.ac@sed.com', '0000-00-00', '1-548-131-7980', '(840) 644-3217', 'Michael', '5baa61e4t9b93f3f0682250b6qf8331b7ee68fd8', 'Apple Systems', '1');
INSERT INTO `customer_tb` VALUES ('69', 'Asher', 'Ingrid', 'Padilla', 'Male', 'metus@imperdiet.org', 'eu.eros@ultricesposuerecubilia.ca', '0000-00-00', '1-544-709-9376', '(207) 732-6463', 'Kitra', '5baa61e4w9b93f3f0682250b6mf8331b7ee68fd8', 'Apple Systems', '0');
INSERT INTO `customer_tb` VALUES ('70', 'Sybill', 'acqueline', 'Schroeder', 'Male', 'sem@ipsum.edu', 'nisi.Cum@eleifendnecmalesuada.ca', '0000-00-00', '1-302-162-3404', '(139) 226-2160', 'Martina', '5baa61e4t9b93f3f0682250b6yf8331b7ee68fd8', 'Apple Systems', '1');
INSERT INTO `customer_tb` VALUES ('71', 'Josephine', 'Sara', 'Mendoza', 'Female', 'vulputate.lacus.Cras@DonecnibhQuisque.edu', 'penatibus.et@purusMaecenas.com', '0000-00-00', '1-193-954-3739', '(746) 969-5181', 'Allen', '5baa61e4t9b93f3f0682250b6df8331b7ee68fd8', 'Adobe', '0');
INSERT INTO `customer_tb` VALUES ('72', 'Aileen', 'Stacy', 'Myers', 'Male', 'odio.sagittis@estac.org', 'enim.Suspendisse@utnullaCras.com', '0000-00-00', '1-914-807-3149', '(715) 677-8855', 'Riley', '5baa61e4g9b93f3f0682250b6sf8331b7ee68fd8', 'Adobe', '0');
INSERT INTO `customer_tb` VALUES ('73', 'Germane', 'Teegan', 'Salazar', 'Male', 'Vivamus.nibh@ametloremsemper.org', 'Aliquam.ultrices@posuerecubilia.org', '0000-00-00', '1-442-827-8194', '(411) 118-4572', 'Tana', '5baa61e4l9b93f3f0682250b6gf8331b7ee68fd8', 'Yahoo', '0');
INSERT INTO `customer_tb` VALUES ('74', 'Jaden', 'Karyn', 'Garrett', 'Female', 'dolor.Fusce.mi@SuspendisseduiFusce.org', 'neque.vitae.semper@Duis.org', '0000-00-00', '1-208-967-3320', '(601) 365-5198', 'Xander', '5baa61e4x9b93f3f0682250b6lf8331b7ee68fd8', 'Lycos', '1');
INSERT INTO `customer_tb` VALUES ('75', 'Priscilla', 'Hedwig', 'Schmidt', 'Female', 'pede.et.risus@sit.org', 'nec.tempus@duilectus.org', '0000-00-00', '1-630-611-3447', '(381) 122-6054', 'Sarah', '5baa61e4p9b93f3f0682250b6kf8331b7ee68fd8', 'Borland', '0');
INSERT INTO `customer_tb` VALUES ('76', 'Ashton', 'Serena', 'Odonnell', 'Female', 'rutrum@ultricesposuerecubilia.ca', 'eros@tristiquepellentesquetellus.com', '0000-00-00', '1-636-505-8516', '(728) 892-1007', 'Stephanie', '5baa61e4h9b93f3f0682250b6jf8331b7ee68fd8', 'Altavista', '1');
INSERT INTO `customer_tb` VALUES ('77', 'Rajah', 'Serina', 'Abbott', 'Male', 'quis.diam@lorem.edu', 'dui.Fusce@faucibus.com', '0000-00-00', '1-285-136-1759', '(412) 704-6836', 'Elvis', '5baa61e4w9b93f3f0682250b6xf8331b7ee68fd8', 'Microsoft', '0');
INSERT INTO `customer_tb` VALUES ('78', 'Nero', 'Montana', 'Santana', 'Female', 'mi@idnuncinterdum.edu', 'Nulla.dignissim@pharetraNamac.ca', '0000-00-00', '1-258-779-8436', '(492) 951-1289', 'Tiger', '5baa61e4y9b93f3f0682250b6xf8331b7ee68fd8', 'Macromedia', '1');
INSERT INTO `customer_tb` VALUES ('79', 'Maite', 'Pandora', 'Farmer', 'Male', 'in@sapienNunc.org', 'at.augue@rutrumurnanec.edu', '0000-00-00', '1-840-609-8177', '(272) 145-0122', 'Gary', '5baa61e4l9b93f3f0682250b6nf8331b7ee68fd8', 'Apple Systems', '1');
INSERT INTO `customer_tb` VALUES ('80', 'Jonah', 'Lacota', 'Hart', 'Male', 'Cras.pellentesque.Sed@Crasvulputate.org', 'velit@NullaaliquetProin.edu', '0000-00-00', '1-185-827-2991', '(685) 459-0044', 'Emery', '5baa61e4f9b93f3f0682250b6qf8331b7ee68fd8', 'Yahoo', '0');
INSERT INTO `customer_tb` VALUES ('81', 'Amelia', 'Hanna', 'Cooper', 'Male', 'egestas.Aliquam.nec@afacilisisnon.org', 'montes.nascetur.ridiculus@estmauris.edu', '0000-00-00', '1-936-838-7171', '(163) 547-8400', 'Noble', '5baa61e4c9b93f3f0682250b6df8331b7ee68fd8', 'Lycos', '0');
INSERT INTO `customer_tb` VALUES ('82', 'Sydney', 'Amber', 'Compton', 'Male', 'quam@facilisis.com', 'neque@turpisnonenim.com', '0000-00-00', '1-525-972-0763', '(899) 508-9991', 'Walter', '5baa61e4z9b93f3f0682250b6bf8331b7ee68fd8', 'Altavista', '0');
INSERT INTO `customer_tb` VALUES ('83', 'John', 'Elaine', 'Reyes', 'Female', 'massa@hendreritDonecporttitor.org', 'eleifend.non@nisidictumaugue.org', '0000-00-00', '1-657-919-2107', '(554) 499-5413', 'Dorian', '5baa61e4h9b93f3f0682250b6bf8331b7ee68fd8', 'Altavista', '1');
INSERT INTO `customer_tb` VALUES ('84', 'Callum', 'Althea', 'Sellers', 'Female', 'metus.Vivamus@lacus.com', 'tellus@lectusquismassa.ca', '0000-00-00', '1-167-155-7990', '(198) 897-6084', 'Uriel', '5baa61e4k9b93f3f0682250b6vf8331b7ee68fd8', 'Lycos', '1');
INSERT INTO `customer_tb` VALUES ('85', 'Noelani', 'Anjolie', 'Sherman', 'Female', 'pharetra@aultricies.org', 'semper.dui@etultricesposuere.ca', '0000-00-00', '1-757-988-4663', '(359) 640-4113', 'Ursa', '5baa61e4g9b93f3f0682250b6ff8331b7ee68fd8', 'Lycos', '0');
INSERT INTO `customer_tb` VALUES ('86', 'Quincy', 'Grace', 'Ramos', 'Male', 'vel.sapien@Mauris.org', 'penatibus@perinceptoshymenaeos.ca', '0000-00-00', '1-841-450-3164', '(702) 949-9127', 'Eliana', '5baa61e4w9b93f3f0682250b6bf8331b7ee68fd8', 'Microsoft', '1');
INSERT INTO `customer_tb` VALUES ('87', 'Barclay', 'Ursula', 'Holt', 'Female', 'Cum.sociis@loremvehiculaet.ca', 'luctus.felis.purus@pede.edu', '0000-00-00', '1-482-789-2459', '(101) 879-5889', 'Jayme', '5baa61e4l9b93f3f0682250b6nf8331b7ee68fd8', 'Chami', '1');
INSERT INTO `customer_tb` VALUES ('88', 'Stephen', 'Gwendolyn', 'Kaufman', 'Female', 'sit.amet@nullaatsem.com', 'commodo.auctor.velit@montes.org', '0000-00-00', '1-601-905-1402', '(103) 161-9553', 'Giacomo', '5baa61e4x9b93f3f0682250b6xf8331b7ee68fd8', 'Borland', '0');
INSERT INTO `customer_tb` VALUES ('89', 'Caldwell', 'Indigo', 'Calderon', 'Male', 'tempor.diam@vehiculaetrutrum.ca', 'justo.faucibus.lectus@aliquetProin.ca', '0000-00-00', '1-726-138-1029', '(539) 938-0521', 'Walter', '5baa61e4t9b93f3f0682250b6jf8331b7ee68fd8', 'Google', '0');
INSERT INTO `customer_tb` VALUES ('90', 'Fleur', 'Medge', 'Gamble', 'Male', 'placerat@tincidunt.edu', 'consequat@nectellus.com', '0000-00-00', '1-505-227-7917', '(439) 555-5818', 'Cally', '5baa61e4h9b93f3f0682250b6pf8331b7ee68fd8', 'Chami', '0');
INSERT INTO `customer_tb` VALUES ('91', 'Matthew', 'Abra', 'Delaney', 'Male', 'ante.Nunc@lectus.edu', 'mattis.semper.dui@Loremipsumdolor.com', '0000-00-00', '1-129-555-8075', '(843) 234-2044', 'Gregory', '5baa61e4w9b93f3f0682250b6bf8331b7ee68fd8', 'Cakewalk', '0');
INSERT INTO `customer_tb` VALUES ('92', 'Kibo', 'Imani', 'Sloan', 'Male', 'sit@diamlorem.org', 'ligula.eu.enim@duisemper.edu', '0000-00-00', '1-110-782-1136', '(754) 327-4712', 'Todd', '5baa61e4j9b93f3f0682250b6qf8331b7ee68fd8', 'Microsoft', '1');
INSERT INTO `customer_tb` VALUES ('93', 'Reuben', 'Sopoline', 'Wynn', 'Male', 'dapibus.rutrum@interdumNuncsollicitudin.ca', 'Mauris.nulla@etultrices.org', '0000-00-00', '1-502-874-2038', '(327) 784-3633', 'Carol', '5baa61e4y9b93f3f0682250b6yf8331b7ee68fd8', 'Altavista', '1');
INSERT INTO `customer_tb` VALUES ('94', 'Perry', 'Charity', 'Armstrong', 'Female', 'lectus.pede@loremluctus.edu', 'penatibus.et.magnis@AeneanmassaInteger.edu', '0000-00-00', '1-109-196-7291', '(255) 317-9899', 'Kato', '5baa61e4l9b93f3f0682250b6jf8331b7ee68fd8', 'Microsoft', '1');
INSERT INTO `customer_tb` VALUES ('95', 'Forrest', 'Calista', 'Tillman', 'Male', 'semper@faucibus.org', 'leo.in.lobortis@nequeMorbi.org', '0000-00-00', '1-118-984-6184', '(523) 882-7136', 'Malik', '5baa61e4r9b93f3f0682250b6ff8331b7ee68fd8', 'Chami', '1');
INSERT INTO `customer_tb` VALUES ('96', 'Vera', 'Dominique', 'Mcbride', 'Male', 'neque.non.quam@nislQuisquefringilla.org', 'ipsum.Donec.sollicitudin@aptenttacitisociosqu.edu', '0000-00-00', '1-592-210-6038', '(671) 912-7052', 'Helen', '5baa61e4g9b93f3f0682250b6df8331b7ee68fd8', 'Yahoo', '0');
INSERT INTO `customer_tb` VALUES ('97', 'Tyler', 'Jenette', 'Oneill', 'Female', 'sodales.nisi.magna@mattisvelitjusto.org', 'quis@convalliserat.ca', '0000-00-00', '1-180-168-0653', '(765) 198-3830', 'Leonard', '5baa61e4j9b93f3f0682250b6pf8331b7ee68fd8', 'Lavasoft', '1');
INSERT INTO `customer_tb` VALUES ('98', 'Thor', 'Giselle', 'Fitzgerald', 'Male', 'non@enimSuspendissealiquet.ca', 'blandit.at.nisi@ullamcorperDuisat.org', '0000-00-00', '1-430-861-3585', '(365) 242-9352', 'Lewis', '5baa61e4r9b93f3f0682250b6gf8331b7ee68fd8', 'Apple Systems', '0');
INSERT INTO `customer_tb` VALUES ('99', 'Giselle', 'Kylie', 'Bennett', 'Female', 'lectus.Cum.sociis@odiosemper.edu', 'sed.facilisis.vitae@inceptoshymenaeos.com', '0000-00-00', '1-195-466-4955', '(879) 870-9050', 'Yolanda', '5baa61e4l9b93f3f0682250b6tf8331b7ee68fd8', 'Adobe', '0');
INSERT INTO `customer_tb` VALUES ('100', 'Christine', 'Althea', 'Mcdowell', 'Female', 'nec.diam.Duis@arcuvelquam.edu', 'aliquet.lobortis.nisi@libero.org', '0000-00-00', '1-174-622-7752', '(685) 156-1767', 'Keegan', '5baa61e4p9b93f3f0682250b6cf8331b7ee68fd8', 'Altavista', '0');

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
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of delivery_address_tb
-- ----------------------------
INSERT INTO `delivery_address_tb` VALUES ('103', '1', '133-8285 Lorem St.', 'Oshkosh', 'QC', 'Somalia', null);
INSERT INTO `delivery_address_tb` VALUES ('2', '17', 'P.O. Box 317, 6942 Ultricies Rd.', 'Moreno Valley', 'ME', 'Finland', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('3', '62', '590-4853 A Road', 'Tok', 'NB', 'Saint Helena', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('4', '49', 'Ap #917-6626 Et St.', 'Palmdale', 'NL', 'Azerbaijan', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('5', '25', '2460 Lobortis Rd.', 'Williamsport', 'QC', 'Saint Vincent and The Grenadines', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('6', '7', '3484 Fringilla Rd.', 'Areceibo', 'NJ', 'Belize', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('7', '94', '2823 Nec Street', 'Manassas Park', 'NJ', 'Niue', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('8', '26', 'P.O. Box 585, 8020 In Ave', 'Sunbury', 'AZ', 'Cook Islands', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('9', '21', 'P.O. Box 827, 5707 Nibh. St.', 'Kansas City', 'Delaware', 'Grenada', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('10', '48', 'Ap #833-8501 Sit St.', 'Rhinelander', 'ON', 'Sudan', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('11', '90', 'P.O. Box 928, 4608 Sapien. Road', 'Edina', 'NE', 'Oman', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('12', '54', 'P.O. Box 116, 5374 Non, Road', 'Rancho Cordova', 'NL', 'Bhutan', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('13', '34', 'P.O. Box 982, 3483 Vulputate, Avenue', 'Gary', 'New York', 'Faroe Islands', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('14', '69', 'P.O. Box 976, 2713 Euismod Av.', 'Darlington', 'QC', 'Italy', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('15', '21', 'Ap #525-5270 Dictum Rd.', 'Rosemead', 'LA', 'Palestinian Territory, Occupied', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('16', '49', 'P.O. Box 931, 9882 Gravida St.', 'Hayward', 'New Brunswick', 'Marshall Islands', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('17', '23', '567-3012 Fusce Ave', 'Williamsburg', 'MI', 'Sri Lanka', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('18', '35', '4885 At, Av.', 'Vineland', 'Northwest Territories', 'Central African Republic', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('19', '20', '4519 Nec Rd.', 'Leominster', 'WA', 'Albania', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('20', '60', '326-7742 Tellus Road', 'Watertown', 'Wisconsin', 'Sri Lanka', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('21', '95', '3417 Rhoncus St.', 'Escondido', 'Virginia', 'Myanmar', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('22', '82', 'Ap #148-3799 Dui Avenue', 'Yukon', 'MA', 'Guatemala', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('23', '63', 'Ap #894-8305 Ipsum. Ave', 'Minot', 'Manitoba', 'Mayotte', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('24', '30', 'P.O. Box 665, 9333 Libero St.', 'Parker', 'District of Columbia', 'Jordan', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('25', '60', 'P.O. Box 777, 1446 Purus Rd.', 'Rapid City', 'Yukon', 'Cambodia', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('26', '54', '8879 Ac Ave', 'Port Jervis', 'NS', 'Uruguay', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('27', '37', '4840 Lorem, Ave', 'Miami Beach', 'PE', 'United States Minor Outlying Islands', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('28', '75', '9731 Sed Rd.', 'City of Industry', 'Ontario', 'United States Minor Outlying Islands', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('29', '4', '8745 Donec St.', 'Monroe', 'Ontario', 'United Arab Emirates', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('30', '50', '982-2472 Tortor Rd.', 'Sanford', 'SC', 'Kazakhstan', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('31', '25', '891-3170 Tempor Ave', 'Lakewood', 'PA', 'Mongolia', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('32', '99', '999-6567 Proin St.', 'Utica', 'Saskatchewan', 'Lesotho', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('33', '78', 'P.O. Box 805, 9078 Ipsum. St.', 'Fayetteville', 'MB', 'South Georgia and The South Sandwich Islands', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('34', '21', 'P.O. Box 943, 5458 Leo. Road', 'Oro Valley', 'Manitoba', 'France', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('35', '12', '7316 Libero Avenue', 'Bartlesville', 'NS', 'Chile', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('36', '71', '7899 Mauris Av.', 'Decatur', 'VA', 'Bermuda', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('37', '23', 'Ap #571-3191 Lacus. St.', 'Frederick', 'MB', 'Martinique', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('38', '35', '492-2083 In Rd.', 'Casper', 'SC', 'Malawi', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('39', '62', '6450 Vel, Av.', 'Altoona', 'ND', 'Maldives', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('40', '5', '107-9907 Ornare Street', 'Bradbury', 'MS', 'Fiji', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('41', '66', '883-134 Lobortis. Road', 'Columbia', 'AK', 'Maldives', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('42', '39', '763-7175 A Rd.', 'Vermillion', 'Prince Edward Island', 'Ghana', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('43', '99', 'Ap #895-7891 Phasellus Road', 'Agawam', 'Quebec', 'Hong Kong', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('44', '25', 'Ap #104-7242 Mi Street', 'Bellingham', 'NT', 'Anguilla', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('45', '28', '986-5498 Viverra. St.', 'Torrington', 'Newfoundland and Labrador', 'Benin', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('46', '56', '4320 Dui Rd.', 'Temecula', 'Northwest Territories', 'Argentina', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('47', '67', 'P.O. Box 510, 9017 Eleifend Rd.', 'Hampton', 'New Mexico', 'Dominica', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('48', '38', '932-1176 Quis, Rd.', 'Bellflower', 'DC', 'Mauritius', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('49', '14', '7871 Leo, St.', 'Rancho Palos Verdes', 'MD', 'Madagascar', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('50', '58', 'P.O. Box 687, 9205 Tempus Rd.', 'Pocatello', 'FL', 'Guadeloupe', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('51', '75', '513-3139 Sollicitudin Ave', 'New London', 'British Columbia', 'Yemen', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('52', '30', '7909 Dapibus Avenue', 'Merced', 'ND', 'Gabon', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('53', '75', '6346 Risus. Av.', 'Chicago', 'Vermont', 'Thailand', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('54', '3', 'P.O. Box 872, 6166 Libero Street', 'Manitowoc', 'NS', 'Saint Vincent and The Grenadines', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('55', '11', 'Ap #150-929 Ornare, St.', 'Kalamazoo', 'MT', 'Croatia', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('56', '45', '339-7331 Amet Road', 'Lawrenceville', 'WY', 'Greece', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('57', '27', '476-4677 Erat. Street', 'Wichita', 'Nunavut', 'Algeria', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('58', '4', '392-7777 Faucibus Road', 'Watervliet', 'OK', 'Kenya', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('59', '68', '9004 Duis St.', 'Greenfield', 'Indiana', 'Guatemala', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('60', '21', 'P.O. Box 687, 9254 Augue Ave', 'Lubbock', 'Arkansas', 'Singapore', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('61', '56', '386-7618 Dis Avenue', 'Glens Falls', 'NV', 'Lithuania', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('62', '77', '4961 Volutpat Rd.', 'Dearborn', 'BC', 'Hungary', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('63', '35', '7974 Dolor Ave', 'Hazleton', 'AB', 'Uruguay', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('64', '8', 'Ap #415-9755 Amet, St.', 'Kingston', 'YT', 'Belize', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('65', '73', 'Ap #731-8895 Felis Rd.', 'Highland Park', 'LA', 'Korea', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('66', '12', 'P.O. Box 933, 3721 Vehicula St.', 'San Angelo', 'NL', 'China', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('67', '38', 'P.O. Box 667, 1670 Ornare. Rd.', 'Richmond', 'Utah', 'Tunisia', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('68', '47', 'Ap #806-3398 Vivamus St.', 'Salinas', 'Prince Edward Island', 'Slovakia', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('69', '34', 'Ap #329-9126 Dolor. Road', 'Sanford', 'AB', 'Paraguay', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('70', '85', '971-5215 Ac Road', 'Tok', 'Minnesota', 'Djibouti', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('71', '59', '330 Elementum Rd.', 'Aberdeen', 'NB', 'Wallis and Futuna', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('72', '39', '953-2813 Nec Ave', 'Sharon', 'Delaware', 'Cocos (Keeling) Islands', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('73', '47', '3391 Vitae St.', 'Bridgeport', 'MT', 'India', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('74', '32', '962-5143 Nam Road', 'Williamsburg', 'Illinois', 'Lesotho', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('75', '88', 'Ap #953-5563 Ornare Av.', 'Saginaw', 'Saskatchewan', 'American Samoa', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('76', '3', '998-7288 Bibendum Street', 'North Adams', 'Maryland', 'Switzerland', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('77', '42', '854-1011 Rutrum Street', 'Wynne', 'NC', 'Niger', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('78', '67', 'Ap #171-2422 Etiam Avenue', 'Artesia', 'YT', 'Falkland Islands (Malvinas)', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('79', '90', '544-3909 Cursus St.', 'Morgantown', 'Nova Scotia', 'Greece', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('80', '65', '674-7172 Euismod Av.', 'Albany', 'South Carolina', 'Portugal', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('81', '11', '1470 Elementum Street', 'Hackensack', 'Vermont', 'Cuba', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('82', '9', '9931 Et, Av.', 'San Bernardino', 'Newfoundland and Labrador', 'Burkina Faso', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('83', '37', 'P.O. Box 785, 3358 Adipiscing Street', 'Bell Gardens', 'Maine', 'Suriname', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('84', '52', '8908 Ornare, Road', 'Phenix City', 'Prince Edward Island', 'Zimbabwe', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('85', '76', 'P.O. Box 714, 686 Adipiscing St.', 'Fayetteville', 'Tennessee', 'United States Minor Outlying Islands', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('86', '23', '173-6892 Donec Av.', 'Plano', 'Nunavut', 'Belize', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('87', '72', '468-5102 Nec Road', 'MayagÃƒÂ¼ez', 'NU', 'Kenya', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('88', '23', '977-6010 Semper Ave', 'Santa Cruz', 'Colorado', 'Turkmenistan', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('89', '18', '1044 Tortor. Road', 'Pottsville', 'Vermont', 'Seychelles', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('90', '45', 'P.O. Box 462, 5915 Phasellus St.', 'Somerville', 'NC', 'Qatar', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('91', '74', 'Ap #783-1033 Mauris St.', 'Allentown', 'AL', 'Vanuatu', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('92', '30', 'Ap #933-8188 Nulla Rd.', 'Stevens Point', 'Florida', 'Cambodia', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('93', '59', '509-1184 Erat St.', 'Yigo', 'Manitoba', 'Saint Helena', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('94', '9', '509-4130 Euismod Ave', 'Buffalo', 'Oklahoma', 'Paraguay', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('95', '60', 'P.O. Box 744, 7615 Non Ave', 'Liberal', 'Saskatchewan', 'Libyan Arab Jamahiriya', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('96', '47', 'Ap #950-8970 Proin St.', 'Wahoo', 'RI', 'Argentina', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('97', '16', '5829 Vitae Road', 'Burlingame', 'New Brunswick', 'Saint Kitts and Nevis', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('98', '86', 'P.O. Box 358, 6587 Eleifend Road', 'DeKalb', 'NU', 'Ireland', 'Non-Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('99', '79', '197-6100 Fusce Av.', 'Oil City', 'MB', 'Northern Mariana Islands', 'Economic Processing Zone');
INSERT INTO `delivery_address_tb` VALUES ('100', '95', '2365 A St.', 'Mequon', 'NS', 'Slovenia', 'Economic Processing Zone');

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
  `achemist_approved` int(11) DEFAULT NULL,
  `sc_approved_date` date DEFAULT NULL,
  `gm_approved_date` date DEFAULT NULL,
  `pm_approved_date` date DEFAULT NULL,
  `ic_approved_date` date DEFAULT NULL,
  `achemist_approved_date` date DEFAULT NULL,
  `sc_approved_status` tinyint(1) DEFAULT NULL,
  `gm_approved_status` tinyint(1) DEFAULT NULL,
  `ic_approved_status` tinyint(1) DEFAULT NULL,
  `achemist_approved_status` tinyint(1) DEFAULT NULL,
  `pm_approved_status` tinyint(1) DEFAULT NULL,
  `sc_disapproved_comment` varchar(255) DEFAULT NULL,
  `gm_disapproved_comment` varchar(255) DEFAULT NULL,
  `pm_disapproved_comment` varchar(255) DEFAULT NULL,
  `ic_disapproved_comment` varchar(255) DEFAULT NULL,
  `achemist_disapproved_comment` varchar(255) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
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
  `material_id` int(11) NOT NULL,
  `dosage` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`formula_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of formula_detail_tb
-- ----------------------------
INSERT INTO `formula_detail_tb` VALUES ('12', '17', '101', '1', '10');
INSERT INTO `formula_detail_tb` VALUES ('13', '17', '101', '1', '20');

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
  `ceo_approved` tinyint(1) DEFAULT '0',
  `chemist_approved` int(11) DEFAULT NULL,
  `ceo_approved_date` date DEFAULT NULL,
  `chemist_approved_date` date DEFAULT NULL,
  `ceo_approved_status` tinyint(1) DEFAULT NULL,
  `chemist_approved_status` tinyint(1) DEFAULT NULL,
  `ceo_disapproved_comment` varchar(255) DEFAULT NULL,
  `chemist_disapproved_comment` varchar(255) DEFAULT NULL,
  `direct_material_cost` int(11) DEFAULT NULL,
  `selling_price` int(11) DEFAULT NULL,
  `net_price` int(11) DEFAULT NULL,
  `opex` int(11) DEFAULT NULL,
  PRIMARY KEY (`formula_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of formula_tb
-- ----------------------------
INSERT INTO `formula_tb` VALUES ('17', 'F-2012-0020', '33', null, '2012-02-22', '102', null, '2012-02-22', null, '1', null, null, null, '15', '10', '5', '20');

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
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of material_stock_level_tb
-- ----------------------------
INSERT INTO `material_stock_level_tb` VALUES ('101', '101', '2012-02-02', '500', '2013-03-03');

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
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of material_supply_tb
-- ----------------------------
INSERT INTO `material_supply_tb` VALUES ('101', '101', '1', '500');
INSERT INTO `material_supply_tb` VALUES ('102', '101', '1', '5000');
INSERT INTO `material_supply_tb` VALUES ('104', '101', '3', '5225');
INSERT INTO `material_supply_tb` VALUES ('105', '101', '1', '6859');
INSERT INTO `material_supply_tb` VALUES ('106', '101', '1', '5162');

-- ----------------------------
-- Table structure for `material_tb`
-- ----------------------------
DROP TABLE IF EXISTS `material_tb`;
CREATE TABLE `material_tb` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(30) NOT NULL,
  `material_category_id` int(11) DEFAULT NULL,
  `critical_level` int(5) DEFAULT NULL,
  PRIMARY KEY (`material_id`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of material_tb
-- ----------------------------
INSERT INTO `material_tb` VALUES ('101', 'Sample Material', null, '500');

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
  `ref_no` varchar(20) DEFAULT NULL,
  `req_qty` int(5) DEFAULT NULL,
  `actual_qty` int(5) DEFAULT NULL,
  `req_unit` varchar(10) DEFAULT NULL,
  `actual_unit` varchar(10) DEFAULT NULL,
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
  `hc_approved` int(11) DEFAULT NULL,
  `qa_head_approved` int(11) DEFAULT NULL,
  `production_staff_approved_date` date DEFAULT NULL,
  `qa_approved_date` date DEFAULT NULL,
  `hc_approved_date` date DEFAULT NULL,
  `qa_head_approved_date` date DEFAULT NULL,
  `production_staff_approved_status` tinyint(1) DEFAULT NULL,
  `qa_approved_status` tinyint(1) DEFAULT NULL,
  `hc_approved_status` tinyint(1) DEFAULT NULL,
  `qa_head_approved_status` tinyint(1) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `production_staff_disapproved_comment` varchar(255) DEFAULT NULL,
  `qa_disapproved_comment` varchar(255) DEFAULT NULL,
  `qa_head_disapproved_comment` varchar(255) DEFAULT NULL,
  `hc_disapproved_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pbt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of production_batch_ticket_tb
-- ----------------------------
INSERT INTO `production_batch_ticket_tb` VALUES ('1', 'PBT-2012-0001', '17', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2012-02-22', null, null, null, null);

-- ----------------------------
-- Table structure for `production_work_order_item_tb`
-- ----------------------------
DROP TABLE IF EXISTS `production_work_order_item_tb`;
CREATE TABLE `production_work_order_item_tb` (
  `pwo_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `pwo_id` int(11) DEFAULT NULL,
  `product_code` varchar(15) DEFAULT NULL,
  `so_id` int(11) NOT NULL,
  `pbt_id` varchar(20) DEFAULT NULL,
  `dr_flag` tinyint(1) DEFAULT NULL,
  `invoice_flag` tinyint(1) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pwo_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of production_work_order_item_tb
-- ----------------------------
INSERT INTO `production_work_order_item_tb` VALUES ('16', '9', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('17', '10', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('18', '11', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('19', '12', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('20', '13', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('21', '14', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('22', '15', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('23', '16', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('24', '17', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('25', '18', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('26', '19', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('27', '20', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('28', '21', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('29', '22', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('30', '23', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('31', '24', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('32', '25', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('33', '26', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('34', '27', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('35', '28', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('36', '29', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('37', '30', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('38', '31', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('39', '32', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('40', '33', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('41', '34', null, '18', null, null, '1', null, null);
INSERT INTO `production_work_order_item_tb` VALUES ('42', '35', null, '18', null, null, '1', null, null);

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
  `vp_approved` int(11) DEFAULT NULL,
  `pm_approved` int(11) DEFAULT NULL,
  `hc_approved_date` date DEFAULT NULL,
  `sc_approved_date` date DEFAULT NULL,
  `vp_approved_date` date DEFAULT NULL,
  `pm_approved_date` date DEFAULT NULL,
  `hc_approved_status` tinyint(1) DEFAULT NULL,
  `sc_approved_status` tinyint(1) DEFAULT NULL,
  `vp_approved_status` tinyint(1) DEFAULT NULL,
  `pm_approved_status` tinyint(1) DEFAULT NULL,
  `hc_disapproved_comment` varchar(255) DEFAULT NULL,
  `sc_disapproved_comment` varchar(255) DEFAULT NULL,
  `vp_disapproved_comment` varchar(255) DEFAULT NULL,
  `pm_disapproved_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pwo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of production_work_order_tb
-- ----------------------------
INSERT INTO `production_work_order_tb` VALUES ('9', 'PWO-2012-0009', '2012-02-22', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

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
) ENGINE=MyISAM AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;

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
INSERT INTO `product_price_tb` VALUES ('111', '104', '1', '20', '2860', '7');
INSERT INTO `product_price_tb` VALUES ('112', '104', '1', '200', '26600', '1');
INSERT INTO `product_price_tb` VALUES ('113', '105', '1', '18', '2628', '2');
INSERT INTO `product_price_tb` VALUES ('114', '105', '1', '20', '2900', '7');
INSERT INTO `product_price_tb` VALUES ('115', '105', '1', '200', '27000', '1');
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

-- ----------------------------
-- Table structure for `product_tb`
-- ----------------------------
DROP TABLE IF EXISTS `product_tb`;
CREATE TABLE `product_tb` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `material_category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_tb
-- ----------------------------
INSERT INTO `product_tb` VALUES ('101', 'Raimol Reindro ISO VG 32/46', 'Raimol Reindro ISO VG 32/46 is formulated from a very high quality paraffinic, high viscosity index base oils and a balanced blend of synergistic and protective additives to give them superior performance over ordinary hydraulic fluids.', '39');
INSERT INTO `product_tb` VALUES ('102', 'Raimol Reindro ISO VG 68', 'Raimol Reindro ISO VG 68 is formulated from a very high quality paraffinic, high viscosity index base oils and a balanced blend of synergistic and protective additives to give them superior performance over ordinary hydraulic fluids.', '39');
INSERT INTO `product_tb` VALUES ('103', 'Raimol Reindro ISO VG 100', 'Raimol Reindro ISO VG 100 is formulated from a very high quality paraffinic, high viscosity index base oils and a balanced blend of synergistic and protective additives to give them superior performance over ordinary hydraulic fluids.', '39');
INSERT INTO `product_tb` VALUES ('104', 'Raimol Industrial Gear Oil ISO VG 150/22', null, '40');
INSERT INTO `product_tb` VALUES ('105', 'Raimol Industrial Gear Oil ISO VG 460/68', null, '40');
INSERT INTO `product_tb` VALUES ('106', 'Raimol Waylube Slideway Oil 68 ', null, '44');
INSERT INTO `product_tb` VALUES ('107', 'Raimol Compro Compressor Oil 32/46/68', null, '32');
INSERT INTO `product_tb` VALUES ('108', 'Raimol Compro Compressor Oil 100/150', null, '32');
INSERT INTO `product_tb` VALUES ('109', 'Raimol Mega Gold 5W40 SM/CJ4', null, '37');
INSERT INTO `product_tb` VALUES ('110', 'Raimol Flash 1 Gold Racing 4T SAE 10W40 ', null, '43');

-- ----------------------------
-- Table structure for `purchase_order_item_tb`
-- ----------------------------
DROP TABLE IF EXISTS `purchase_order_item_tb`;
CREATE TABLE `purchase_order_item_tb` (
  `po_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id` int(11) NOT NULL,
  `product_description` varchar(60) NOT NULL,
  `qty` int(5) NOT NULL,
  `unit_material` int(11) NOT NULL,
  `product_price_id` int(11) DEFAULT NULL,
  `unit_price` int(11) DEFAULT NULL,
  PRIMARY KEY (`po_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchase_order_item_tb
-- ----------------------------
INSERT INTO `purchase_order_item_tb` VALUES ('33', '18', 'Sample Item', '12', '1', null, '20');
INSERT INTO `purchase_order_item_tb` VALUES ('34', '18', 'Sample Item 2', '20', '2', null, '12');
INSERT INTO `purchase_order_item_tb` VALUES ('35', '19', 'Item 1', '12', '1', null, '23');
INSERT INTO `purchase_order_item_tb` VALUES ('36', '19', 'Item 2', '23', '2', null, '12');

-- ----------------------------
-- Table structure for `purchase_order_tb`
-- ----------------------------
DROP TABLE IF EXISTS `purchase_order_tb`;
CREATE TABLE `purchase_order_tb` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_id_string` varchar(20) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `delivery_address_id` int(11) DEFAULT NULL,
  `terms` varchar(15) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `order_date` date NOT NULL,
  `so_id` varchar(20) DEFAULT NULL,
  `pwo_id` varchar(20) DEFAULT NULL,
  `dr_id` varchar(20) DEFAULT NULL,
  `sc_approved` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `disapproved_comment` text,
  `date_created` date DEFAULT NULL,
  PRIMARY KEY (`po_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of purchase_order_tb
-- ----------------------------
INSERT INTO `purchase_order_tb` VALUES ('18', 'PO-2012-0044', '3', '76', '30 Days', '2011-11-28', '2012-01-21', '18', '35', null, '102', '1', null, '2012-02-22');
INSERT INTO `purchase_order_tb` VALUES ('19', 'PO-2012-0046', '3', '76', '15days', '2011-11-28', '2012-03-03', '19', null, null, '102', '1', null, '2012-02-22');

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
INSERT INTO `role_limit_tb` VALUES ('1', '1', '1');
INSERT INTO `role_limit_tb` VALUES ('2', '2', '2');
INSERT INTO `role_limit_tb` VALUES ('3', '3', '1');
INSERT INTO `role_limit_tb` VALUES ('4', '4', '1');
INSERT INTO `role_limit_tb` VALUES ('5', '5', '2');
INSERT INTO `role_limit_tb` VALUES ('6', '6', '0');
INSERT INTO `role_limit_tb` VALUES ('7', '7', '1');
INSERT INTO `role_limit_tb` VALUES ('8', '8', '2');
INSERT INTO `role_limit_tb` VALUES ('9', '9', '1');
INSERT INTO `role_limit_tb` VALUES ('10', '10', '1');
INSERT INTO `role_limit_tb` VALUES ('11', '11', '1');
INSERT INTO `role_limit_tb` VALUES ('12', '12', '1');
INSERT INTO `role_limit_tb` VALUES ('13', '13', '2');
INSERT INTO `role_limit_tb` VALUES ('14', '14', '1');

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
INSERT INTO `role_tb` VALUES ('5', 'Assistant Chemist', 'Assistant Chemist');
INSERT INTO `role_tb` VALUES ('6', 'Production Worker', 'Production Worker');
INSERT INTO `role_tb` VALUES ('7', 'General Manager', 'General Manager');
INSERT INTO `role_tb` VALUES ('8', 'Accounting', 'Accounting');
INSERT INTO `role_tb` VALUES ('9', 'Product Manager', 'Product Manager');
INSERT INTO `role_tb` VALUES ('10', 'Quality Assurance Head', 'Quality Assurance Head');
INSERT INTO `role_tb` VALUES ('11', 'Quality Assurance', 'Quality Assurance');
INSERT INTO `role_tb` VALUES ('12', 'Production Staff', 'Production Staff');
INSERT INTO `role_tb` VALUES ('13', 'Inventory Clerk', 'Inventory Clerk');
INSERT INTO `role_tb` VALUES ('14', 'Admin', 'Admin');

-- ----------------------------
-- Table structure for `sales_order_item_tb`
-- ----------------------------
DROP TABLE IF EXISTS `sales_order_item_tb`;
CREATE TABLE `sales_order_item_tb` (
  `so_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `so_id` varchar(20) NOT NULL,
  `po_item_id` int(11) NOT NULL,
  `tax_code_id` int(5) NOT NULL,
  `amount` int(20) DEFAULT NULL,
  `gross_amount` int(20) DEFAULT NULL,
  `tax_amount` int(20) DEFAULT NULL,
  PRIMARY KEY (`so_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sales_order_item_tb
-- ----------------------------
INSERT INTO `sales_order_item_tb` VALUES ('33', '18', '33', '1', '18', '20', '2');
INSERT INTO `sales_order_item_tb` VALUES ('34', '18', '34', '1', '11', '12', '1');
INSERT INTO `sales_order_item_tb` VALUES ('35', '19', '35', '1', '21', '23', '2');
INSERT INTO `sales_order_item_tb` VALUES ('36', '19', '36', '1', '11', '12', '1');

-- ----------------------------
-- Table structure for `sales_order_tb`
-- ----------------------------
DROP TABLE IF EXISTS `sales_order_tb`;
CREATE TABLE `sales_order_tb` (
  `so_id` int(11) NOT NULL AUTO_INCREMENT,
  `so_id_string` varchar(20) DEFAULT NULL,
  `tax_id` varchar(15) DEFAULT NULL,
  `po_id` varchar(20) NOT NULL,
  `pwo_status` tinyint(1) DEFAULT NULL,
  `payment_method` int(5) DEFAULT NULL,
  `tracking_no` varchar(20) DEFAULT NULL,
  `sales_representative` varchar(50) DEFAULT NULL,
  `sc_approved` int(11) DEFAULT NULL,
  `gm_approved` int(11) DEFAULT NULL,
  `acc_credit_approved` int(11) DEFAULT NULL,
  `acc_collection_approved` int(11) DEFAULT NULL,
  `ceo_approved` int(11) DEFAULT NULL,
  `sc_approved_date` date DEFAULT NULL,
  `gm_approved_date` date DEFAULT NULL,
  `acc_credit_approved_date` date DEFAULT NULL,
  `acc_collection_approved_date` date DEFAULT NULL,
  `ceo_approved_date` date DEFAULT NULL,
  `sc_approved_status` tinyint(1) DEFAULT NULL,
  `gm_approved_status` tinyint(1) DEFAULT NULL,
  `acc_credit_approved_status` tinyint(1) DEFAULT NULL,
  `acc_collection_approved_status` tinyint(1) DEFAULT NULL,
  `ceo_approved_status` tinyint(1) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `ceo_disapproved_comment` varchar(255) DEFAULT NULL,
  `sc_disapproved_comment` varchar(255) DEFAULT NULL,
  `gm_disapproved_comment` varchar(255) DEFAULT NULL,
  `acc_credit_disapproved_comment` varchar(255) DEFAULT NULL,
  `acc_collection_disapproved_comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`so_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sales_order_tb
-- ----------------------------
INSERT INTO `sales_order_tb` VALUES ('18', 'SO-2012-0018', null, '18', '1', null, null, null, '102', '102', '102', '102', '102', '2012-02-22', '2012-02-22', '2012-02-22', '2012-02-22', '2012-02-22', '1', '1', '1', '1', '1', '2012-02-22', null, null, null, null, null);
INSERT INTO `sales_order_tb` VALUES ('19', 'SO-2012-0019', null, '19', '0', null, null, null, '102', '102', '102', '102', '102', '2012-02-22', '2012-02-22', '2012-02-22', '2012-02-22', '2012-02-22', '1', '1', '1', '1', '1', '2012-02-22', null, null, null, null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of staff_logs_tb
-- ----------------------------
INSERT INTO `staff_logs_tb` VALUES ('1', '2', 'New Stock \'101\'', '2012-02-22 11:59:49', '127.0.0.1', '0000-00-00 00:00:00', '2012-02-22 03:59:25');
INSERT INTO `staff_logs_tb` VALUES ('2', '102', 'Delete Supplies \'103\'', '2012-02-22 14:07:16', '127.0.0.1', '0000-00-00 00:00:00', '2012-02-22 06:06:52');
INSERT INTO `staff_logs_tb` VALUES ('3', '102', 'Edit Supplies \'104\'', '2012-02-22 16:15:46', '127.0.0.1', '0000-00-00 00:00:00', '2012-02-22 08:15:22');
INSERT INTO `staff_logs_tb` VALUES ('4', '102', 'Sales Order Approved  \'SO-2012-0018\'', '2012-02-22 16:20:47', '127.0.0.1', '0000-00-00 00:00:00', '2012-02-22 08:20:23');
INSERT INTO `staff_logs_tb` VALUES ('5', '102', 'Sales Order Approved  \'SO-2012-0018\'', '2012-02-22 16:20:51', '127.0.0.1', '0000-00-00 00:00:00', '2012-02-22 08:20:27');
INSERT INTO `staff_logs_tb` VALUES ('6', '102', 'Sales Order Approved  \'SO-2012-0018\'', '2012-02-22 16:20:57', '127.0.0.1', '0000-00-00 00:00:00', '2012-02-22 08:20:33');
INSERT INTO `staff_logs_tb` VALUES ('7', '102', 'Sales Order Approved  \'SO-2012-0018\'', '2012-02-22 16:21:01', '127.0.0.1', '0000-00-00 00:00:00', '2012-02-22 08:20:37');
INSERT INTO `staff_logs_tb` VALUES ('8', '102', 'Sales Order Approved  \'SO-2012-0018\'', '2012-02-22 16:21:06', '127.0.0.1', '0000-00-00 00:00:00', '2012-02-22 08:20:42');
INSERT INTO `staff_logs_tb` VALUES ('9', '102', 'New Formula \'F-2012-0020\'', '2012-02-22 16:33:23', '127.0.0.1', '0000-00-00 00:00:00', '2012-02-22 08:32:59');
INSERT INTO `staff_logs_tb` VALUES ('10', '102', 'Sales Order Approved  \'SO-2012-0019\'', '2012-02-22 16:50:24', '127.0.0.1', '0000-00-00 00:00:00', '2012-02-22 08:50:00');
INSERT INTO `staff_logs_tb` VALUES ('11', '102', 'Sales Order Approved  \'SO-2012-0019\'', '2012-02-22 16:50:31', '127.0.0.1', '0000-00-00 00:00:00', '2012-02-22 08:50:07');
INSERT INTO `staff_logs_tb` VALUES ('12', '102', 'Sales Order Approved  \'SO-2012-0019\'', '2012-02-22 16:50:35', '127.0.0.1', '0000-00-00 00:00:00', '2012-02-22 08:50:11');
INSERT INTO `staff_logs_tb` VALUES ('13', '102', 'Sales Order Approved  \'SO-2012-0019\'', '2012-02-22 16:50:38', '127.0.0.1', '0000-00-00 00:00:00', '2012-02-22 08:50:14');
INSERT INTO `staff_logs_tb` VALUES ('14', '102', 'Sales Order Approved  \'SO-2012-0019\'', '2012-02-22 16:50:50', '127.0.0.1', '0000-00-00 00:00:00', '2012-02-22 08:50:26');
INSERT INTO `staff_logs_tb` VALUES ('15', '102', 'Formula Approved  \'F-2012-0020\'', '2012-02-22 16:54:43', '127.0.0.1', '0000-00-00 00:00:00', '2012-02-22 08:54:19');

-- ----------------------------
-- Table structure for `staff_role_tb`
-- ----------------------------
DROP TABLE IF EXISTS `staff_role_tb`;
CREATE TABLE `staff_role_tb` (
  `staff_role_id` int(8) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `role_id` int(8) DEFAULT NULL,
  PRIMARY KEY (`staff_role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;

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
  `signature` binary(255) DEFAULT NULL,
  `date_created` date NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of staff_tb
-- ----------------------------
INSERT INTO `staff_tb` VALUES ('1', 'Zeus', 'Scott', 'Hernandez', 'Male', '810-5223 Mattis St.', 'White Plains', 'Virginia', 'Qatar', 'vel.vulputate@lectus.ca', 'vel.vulputate@lectus.cad', '(435) 675-4103      ', '1 23 272 7466-2312', '2016-04-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2015-03-12', 'Wing', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('2', 'Baker', 'Quintessa', 'Griffin', 'Male', 'P.O. Box 416, 1864 Libero. Av.', 'Rock Island', 'YT', 'French Guiana', 'dis.parturient.montes@lacuspede.edu', 'enim.Sed.nulla@lectusrutrum.edu', '(783) 184-7167', '1 19 226 1194-2216', '2006-09-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2001-10-11', 'Salvador', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('3', 'Wallace', 'Meghan', 'Patton', 'Male', 'Ap #973-584 Pede, St.', 'Woburn', 'SK', 'Bahrain', 'habitant.morbi@viverraDonectempus.com', 'urna.Nunc@dignissimtempor.edu', '(782) 361-9361', '1 63 263 2479-4745', '2011-11-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2013-03-12', 'Orson', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('4', 'Burton', 'Scarlet', 'Guzman', 'Female', '9720 Conubia Avenue', 'Rehoboth Beach', 'New Brunswick', 'Saint Helena', 'vel@ligula.org', 'magna.a.tortor@Aliquameratvolutpat.com', '(781) 249-3221      ', '1 52 259 4737-0084', '2018-07-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2013-07-11', 'George', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('5', 'Chandler', 'Barclay', 'Frank', 'Female', '545-5644 Felis Ave', 'Jeannette', 'Yukon', 'Namibia', 'imperdiet@aptenttacitisociosqu.com', 'Duis.cursus.diam@mollis.com', '(221) 663-7925', '1 65 119 7126-4872', '2007-10-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2023-02-12', 'Nash', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('6', 'Amir', 'Kylynn', 'Kelly', 'Female', 'P.O. Box 849, 8721 Amet Rd.', 'Coral Springs', 'NS', 'Singapore', 'tristique.senectus.et@Suspendisse.edu', 'Etiam@urnanec.com', '(830) 200-6573      ', '1 27 209 7559-0370', '2025-12-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2031-12-11', 'Lucius', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('7', 'Lane', 'Flavia', 'Stout', 'Male', '664-7460 Vulputate Road', 'Loudon', 'Quebec', 'Guyana', 'Vestibulum.ut.eros@dui.org', 'Donec@pellentesque.org', '(203) 369-6513      ', '1 96 961 7471-8194', '2018-07-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2006-02-12', 'Davis', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('8', 'Zeph', 'Arthur', 'Hewitt', 'Female', '539-1555 Morbi St.', 'Newburyport', 'QC', 'Qatar', 'et.magnis.dis@egestaslacinia.edu', 'felis.Donec@felisNulla.org', '(426) 856-8931', '1 16 622 4087-4557', '2017-05-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2023-10-11', 'Tate', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('9', 'Dorian', 'Rhona', 'Goff', 'Female', '703-8377 Porttitor Rd.', 'Cedar City', 'Northwest Territories', 'Cape Verde', 'neque.In@euerosNam.org', 'enim@etrisusQuisque.com', '(348) 131-8691', '1 24 805 3436-8513', '2005-06-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2009-05-12', 'Ferdinand', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('10', 'Dane', 'Arsenio', 'Henry', 'Female', 'P.O. Box 224, 7470 Metus. Street', 'York', 'AZ', 'Burkina Faso', 'vestibulum@accumsansed.edu', 'diam@nisidictum.edu', '(411) 744-7816', '1 23 793 9040-7627', '2020-10-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2030-09-12', 'Christian', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('11', 'Dolan', 'Rajah', 'Grimes', 'Female', 'Ap #659-463 Tincidunt Avenue', 'Seward', 'NS', 'Israel', 'dictum.augue.malesuada@inconsequatenim.com', 'Mauris@parturientmontes.com', '(316) 939-7750      ', '1 62 660 9130-5761', '2024-07-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2006-09-11', 'James', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('12', 'Brennan', 'Lev', 'Lucas', 'Female', '3195 Nullam St.', 'Dallas', 'New Brunswick', 'Estonia', 'nec@fringillaestMauris.org', 'tempor.est@Nullasempertellus.ca', '(735) 440-5060', '1 17 949 6740-7728', '2020-05-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2017-06-12', 'Martin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('13', 'Lane', 'Logan', 'Duffy', 'Male', '511 Volutpat St.', 'Glendale', 'Northwest Territories', 'Slovakia', 'Fusce@elitpharetraut.edu', 'eget@metuseu.com', '(781) 968-5206      ', '1 60 664 1017-0991', '2030-04-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2006-04-12', 'Theodore', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('14', 'Ulysses', 'Curran', 'Daniel', 'Female', 'P.O. Box 651, 676 Metus. Street', 'Fredericksburg', 'Delaware', 'Cayman Islands', 'ipsum.cursus.vestibulum@Sed.edu', 'vehicula.et@lorem.edu', '(481) 571-7996', '1 20 224 8959-9675', '2007-03-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2022-12-12', 'Valentine', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('15', 'Brian', 'Nerea', 'Mccormick', 'Female', '3254 Libero. Road', 'DuBois', 'Delaware', 'Tonga', 'a@gravida.com', 'ut.eros@auctor.edu', '(227) 877-9436', '1 47 579 5596-1873', '2008-10-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2006-02-11', 'Travis', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('16', 'Stuart', 'Norman', 'Doyle', 'Male', 'Ap #110-8240 Lectus Rd.', 'Gaithersburg', 'NU', 'Greenland', 'blandit.at@mattis.com', 'ut@utpharetrased.edu', '(178) 466-0919', '1 56 939 8906-0315', '2021-02-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2022-02-11', 'Hasad', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('17', 'Amos', 'Reece', 'Jensen', 'Male', 'Ap #703-2297 Venenatis Road', 'Hopkinsville', 'Arkansas', 'Costa Rica', 'nulla@liberoduinec.org', 'ultrices.mauris.ipsum@euismodet.com', '(626) 276-9115      ', '1 67 381 3723-6439', '2005-05-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2028-05-11', 'Elijah', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('18', 'Gannon', 'Nehru', 'Coleman', 'Male', 'Ap #965-3516 Magnis St.', 'Fulton', 'AB', 'Burkina Faso', 'erat.neque@atrisusNunc.org', 'sit@risusquis.org', '(169) 103-7250', '1 32 165 2652-9687', '2030-08-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2022-04-11', 'Kane', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');
INSERT INTO `staff_tb` VALUES ('19', 'Phillip', 'India', 'Mccoy', 'Female', 'Ap #934-5451 Nunc Av.', 'Kearney', 'Oklahoma', 'Eritrea', 'sed.orci.lobortis@loremDonec.org', 'in@sedlibero.edu', '(320) 178-4373      ', '1 22 377 3249-0771', '2003-03-11', 0x4E554C4C0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000, '2011-12-11', 'Cooper', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of supplier_tb
-- ----------------------------
INSERT INTO `supplier_tb` VALUES ('1', 'Google', '1-473-150-8608', '(581) 165-8459      ', 'feugiat.Sed@Crassedl', 'Ap #756-1219 Orci Avenue', 'Jacksonville', 'QC', 'Sierra Leone', 'Aretha', 'Alan', 'Santiago');
INSERT INTO `supplier_tb` VALUES ('2', 'Google', '1-352-658-3624      ', '(597) 977-9574', 'et@mauris.com', '175-5654 Justo Road', 'Fontana', 'AL', 'Guinea', 'Hanna', 'Ian', 'Mclaughlin');
INSERT INTO `supplier_tb` VALUES ('3', 'Apple Systems', '1-580-124-1875      ', '(925) 768-1270      ', 'dictum.placerat.augu', 'Ap #233-3869 Mattis. St.', 'Hudson', 'North Carolina', 'Tanzania, United Republic of', 'Ria', 'Gabriel', 'Medina');
INSERT INTO `supplier_tb` VALUES ('4', 'Finale', '1-283-999-0336', '(673) 261-4247', 'arcu@velpedeblandit.', 'Ap #137-2024 Facilisis. Rd.', 'Garland', 'Alberta', 'Namibia', 'Candice', 'Helen', 'Whitney');
INSERT INTO `supplier_tb` VALUES ('5', 'Altavista', '1-261-117-0302', '(473) 534-8228', 'semper@molestie.org', '142-1289 Aenean St.', 'Guthrie', 'Idaho', 'Cuba', 'Hadley', 'Geraldine', 'Estrada');
INSERT INTO `supplier_tb` VALUES ('6', 'Adobe', '1-916-630-6439      ', '(281) 204-5302      ', 'lobortis.quis@nonlac', '5854 Pretium St.', 'Sheboygan', 'Nunavut', 'Dominica', 'Mona', 'Thane', 'Norman');
INSERT INTO `supplier_tb` VALUES ('7', 'Adobe', '1-533-795-6546      ', '(233) 459-2200', 'mi@at.ca', '956-5562 Purus. Ave', 'Blythe', 'DE', 'Antigua and Barbuda', 'Shaeleigh', 'Jaquelyn', 'Hoover');
INSERT INTO `supplier_tb` VALUES ('8', 'Microsoft', '1-398-761-7120', '(172) 970-4250', 'Suspendisse.eleifend', 'P.O. Box 540, 6895 Neque. Avenue', 'Vallejo', 'Nunavut', 'Turkmenistan', 'Deborah', 'Grant', 'Cohen');
INSERT INTO `supplier_tb` VALUES ('9', 'Microsoft', '1-928-219-6894      ', '(569) 651-0754', 'tincidunt.aliquam@li', '6809 Eget Street', 'Buffalo', 'Nebraska', 'Macedonia', 'Kristen', 'Hall', 'Hancock');
INSERT INTO `supplier_tb` VALUES ('10', 'Finale', '1-583-355-2268', '(804) 659-9937      ', 'est.Nunc.laoreet@Pha', '815-6602 Maecenas Ave', 'Greensburg', 'NS', 'Dominican Republic', 'Orli', 'Eric', 'Vinson');
INSERT INTO `supplier_tb` VALUES ('11', 'Chami', '1-947-411-1854      ', '(319) 346-6327      ', 'Quisque@ultricesmaur', 'Ap #799-4688 Molestie Street', 'Gatlinburg', 'Saskatchewan', 'Ecuador', 'Fredericka', 'Sheila', 'Raymond');
INSERT INTO `supplier_tb` VALUES ('12', 'Google', '1-582-718-5512', '(524) 556-3245', 'turpis@Donecporttito', 'P.O. Box 995, 3436 Donec Street', 'Culver City', 'MB', 'Ethiopia', 'Natalie', 'Victor', 'Holman');
INSERT INTO `supplier_tb` VALUES ('13', 'Adobe', '1-822-954-9964      ', '(105) 532-3828', 'et.rutrum@arcuVestib', 'P.O. Box 116, 9136 Massa. St.', 'San Clemente', 'UT', 'Iran, Islamic Republic of', 'Shafira', 'Maxine', 'Becker');
INSERT INTO `supplier_tb` VALUES ('14', 'Adobe', '1-255-376-3642', '(841) 689-2910', 'eu@in.edu', '330-7782 Netus Avenue', 'Hudson', 'NL', 'New Caledonia', 'Blythe', 'Rogan', 'Bradley');
INSERT INTO `supplier_tb` VALUES ('15', 'Microsoft', '1-907-792-9764      ', '(162) 223-0367', 'arcu.Vivamus.sit@eu.', 'P.O. Box 329, 862 Diam Rd.', 'Pendleton', 'BC', 'Qatar', 'Sylvia', 'Sacha', 'Hampton');
INSERT INTO `supplier_tb` VALUES ('16', 'Adobe', '1-870-531-7488      ', '(637) 606-4493', 'fringilla.euismod@te', '4830 Lacinia St.', 'New York', 'NV', 'Saint Kitts and Nevis', 'Noelani', 'Kiayada', 'Crosby');
INSERT INTO `supplier_tb` VALUES ('17', 'Google', '1-483-744-6910', '(346) 123-6480', 'egestas@metus.org', '9453 Egestas. Rd.', 'Sutter Creek', 'NL', 'Brazil', 'Inga', 'Nadine', 'Bartlett');
INSERT INTO `supplier_tb` VALUES ('18', 'Lavasoft', '1-425-131-9395      ', '(664) 778-4831', 'vitae@blanditat.org', 'P.O. Box 145, 5692 Nam Rd.', 'Beverly Hills', 'Saskatchewan', 'Puerto Rico', 'Jeanette', 'Lee', 'Page');
INSERT INTO `supplier_tb` VALUES ('19', 'Cakewalk', '1-265-517-6780', '(645) 819-3896', 'scelerisque@Maecenas', '548-4488 Nonummy Road', 'Derby', 'Alberta', 'Lesotho', 'Sandra', 'Timothy', 'Frost');
INSERT INTO `supplier_tb` VALUES ('20', 'Microsoft', '1-834-867-3199', '(262) 410-3497      ', 'risus@sagittis.ca', 'P.O. Box 130, 9260 Vel Avenue', 'Wichita', 'OR', 'Bosnia and Herzegovina', 'Aretha', 'Bertha', 'Barry');
INSERT INTO `supplier_tb` VALUES ('21', 'Chami', '1-883-675-6655', '(992) 903-0043', 'mus.Donec.dignissim@', 'P.O. Box 864, 7520 A, St.', 'Riverside', 'Nunavut', 'New Zealand', 'Yeo', 'Willow', 'Camacho');
INSERT INTO `supplier_tb` VALUES ('22', 'Apple Systems', '1-262-274-0427      ', '(131) 490-2061', 'varius@amet.org', 'P.O. Box 973, 2698 Feugiat Street', 'Manchester', 'Kentucky', 'El Salvador', 'Imogene', 'Brielle', 'Jenkins');
INSERT INTO `supplier_tb` VALUES ('23', 'Macromedia', '1-910-842-7779      ', '(652) 386-3385', 'iaculis@pharetra.com', '881-5884 Suspendisse Rd.', 'Rome', 'PE', 'Andorra', 'Kay', 'Vera', 'Rollins');
INSERT INTO `supplier_tb` VALUES ('24', 'Apple Systems', '1-846-700-6684', '(451) 666-4300', 'Lorem.ipsum.dolor@qu', '946-414 Integer Rd.', 'Manhattan', 'Northwest Territories', 'Ecuador', 'Clementine', 'Brielle', 'Bernard');
INSERT INTO `supplier_tb` VALUES ('25', 'Sibelius', '1-535-688-5833', '(359) 881-9884', 'arcu.Vestibulum@laci', '5930 Consectetuer Rd.', 'Thousand Oaks', 'Texas', 'Belize', 'Nayda', 'Emmanuel', 'Ware');
INSERT INTO `supplier_tb` VALUES ('26', 'Borland', '1-476-770-5399', '(527) 234-4241', 'nec.orci@Curabitureg', '3985 Vivamus Rd.', 'Signal Hill', 'Hawaii', 'Indonesia', 'Germaine', 'Barry', 'Rodriguez');
INSERT INTO `supplier_tb` VALUES ('27', 'Borland', '1-892-367-0056', '(819) 452-4354      ', 'arcu.et@dapibus.ca', 'P.O. Box 185, 892 Neque Avenue', 'Rolla', 'DC', 'Pitcairn', 'Deborah', 'Orla', 'Dunn');
INSERT INTO `supplier_tb` VALUES ('28', 'Lycos', '1-115-505-5134', '(235) 908-6272', 'Sed.nulla.ante@Lorem', 'P.O. Box 487, 2622 Non, St.', 'Palm Springs', 'NL', 'Samoa', 'Karleigh', 'Madeson', 'Bryan');
INSERT INTO `supplier_tb` VALUES ('29', 'Apple Systems', '1-731-352-7792      ', '(211) 686-2950', 'aliquam.eu@nisisemse', '707-2205 Cursus Ave', 'Alhambra', 'NS', 'Iran, Islamic Republic of', 'Karyn', 'Reed', 'Glass');
INSERT INTO `supplier_tb` VALUES ('30', 'Chami', '1-565-639-2597', '(114) 159-8867', 'ridiculus@Praesent.e', 'P.O. Box 772, 6416 Accumsan Avenue', 'Fall River', 'Utah', 'Saint Helena', 'Catherine', 'Aristotle', 'Pacheco');
INSERT INTO `supplier_tb` VALUES ('31', 'Google', '1-124-115-8780', '(169) 641-6197', 'Morbi.vehicula.Pelle', '725-1128 Curabitur Rd.', 'Ruston', 'NL', 'Slovakia', 'Mechelle', 'Dacey', 'Ochoa');
INSERT INTO `supplier_tb` VALUES ('32', 'Sibelius', '1-215-168-7764      ', '(183) 569-7360', 'sollicitudin.adipisc', '5767 Dignissim Road', 'Des Moines', 'Iowa', 'Aruba', 'Charlotte', 'Jade', 'Schwartz');
INSERT INTO `supplier_tb` VALUES ('33', 'Altavista', '1-218-342-0058      ', '(781) 593-9718      ', 'neque.sed@lorem.edu', '2617 Sed Road', 'North Charleston', 'Florida', 'Equatorial Guinea', 'Jessica', 'Sasha', 'Gamble');
INSERT INTO `supplier_tb` VALUES ('34', 'Lycos', '1-352-586-3126      ', '(608) 432-1629      ', 'et.malesuada.fames@n', '494-1816 Convallis Av.', 'Joplin', 'Florida', 'Guam', 'Lenore', 'Olga', 'Morgan');
INSERT INTO `supplier_tb` VALUES ('35', 'Sibelius', '1-675-657-0627', '(499) 934-6970', 'velit.eu@disparturie', '3633 Et, Road', 'Salem', 'AZ', 'Yemen', 'Shelby', 'Kiara', 'Nguyen');
INSERT INTO `supplier_tb` VALUES ('36', 'Cakewalk', '1-336-599-2378      ', '(328) 727-3885', 'egestas.blandit.Nam@', '940-2887 Lorem, Rd.', 'Hollister', 'NY', 'Venezuela', 'Victoria', 'Warren', 'Patton');
INSERT INTO `supplier_tb` VALUES ('37', 'Lycos', '1-693-257-0712', '(518) 118-0862      ', 'mauris.Morbi.non@Viv', '2767 Vestibulum, St.', 'Yorba Linda', 'Saskatchewan', 'Indonesia', 'Cara', 'Bruce', 'Cooper');
INSERT INTO `supplier_tb` VALUES ('38', 'Macromedia', '1-111-761-6817', '(801) 842-9653      ', 'sapien@Nuncsed.org', 'P.O. Box 566, 8288 Consectetuer Av.', 'Detroit', 'ID', 'Liechtenstein', 'Vera', 'Joelle', 'Montoya');
INSERT INTO `supplier_tb` VALUES ('39', 'Google', '1-213-993-4769      ', '(892) 441-8181', 'tincidunt.dui.augue@', '838-7405 Maecenas Rd.', 'Barre', 'Texas', 'Saint Pierre and Miquelon', 'Emerald', 'Leilani', 'Greer');
INSERT INTO `supplier_tb` VALUES ('40', 'Chami', '1-157-420-2911', '(850) 622-2656      ', 'pede.Suspendisse.dui', '8074 Ut Ave', 'Green River', 'SK', 'Cayman Islands', 'Noel', 'Kirby', 'Carr');
INSERT INTO `supplier_tb` VALUES ('41', 'Cakewalk', '1-589-186-9699', '(595) 802-3201', 'Nulla@eratnequenon.c', 'P.O. Box 618, 2073 Vestibulum Ave', 'Irwindale', 'FL', 'Zambia', 'Chantale', 'Kyra', 'Whitney');
INSERT INTO `supplier_tb` VALUES ('42', 'Adobe', '1-422-495-9190', '(232) 134-6247', 'enim@Aliquamultrices', '4717 Aliquam Street', 'Needham', 'Quebec', 'Saint Kitts and Nevis', 'Xantha', 'Blaine', 'Stephenson');
INSERT INTO `supplier_tb` VALUES ('43', 'Sibelius', '1-410-312-1682      ', '(567) 746-7359      ', 'lacus.Quisque@hendre', 'P.O. Box 456, 7630 Dolor Street', 'Belpre', 'Yukon', 'Guinea-bissau', 'Cheryl', 'Rhona', 'Dorsey');
INSERT INTO `supplier_tb` VALUES ('44', 'Cakewalk', '1-155-276-5572', '(583) 625-4497', 'vitae.nibh@Inatpede.', '231-5781 Est, Rd.', 'Newport', 'IN', 'Tanzania, United Republic of', 'Roary', 'Jescie', 'Morgan');
INSERT INTO `supplier_tb` VALUES ('45', 'Google', '1-540-194-1503      ', '(725) 613-0740', 'et@ullamcorperDuisat', 'Ap #665-9164 Fringilla Street', 'Saint Paul', 'NT', 'Cyprus', 'Halee', 'Wing', 'Ewing');
INSERT INTO `supplier_tb` VALUES ('46', 'Adobe', '1-268-995-5837', '(219) 632-5682      ', 'Proin@Proindolor.org', '2418 Pede. St.', 'San Clemente', 'Newfoundland and Labrador', 'Guadeloupe', 'Cassady', 'Shelley', 'Clements');
INSERT INTO `supplier_tb` VALUES ('47', 'Borland', '1-724-505-2331      ', '(787) 918-8334', 'ac.feugiat.non@feugi', '356-1468 Etiam Road', 'Casper', 'Northwest Territories', 'Cocos (Keeling) Islands', 'Rinah', 'Rhea', 'Matthews');
INSERT INTO `supplier_tb` VALUES ('48', 'Microsoft', '1-646-381-5925      ', '(480) 808-6671      ', 'lacus@nonjusto.ca', 'Ap #584-2466 Eu Rd.', 'Meadville', 'MA', 'Guatemala', 'Xantha', 'Isaac', 'Moody');
INSERT INTO `supplier_tb` VALUES ('49', 'Google', '1-985-733-2684      ', '(308) 848-2030      ', 'nec.leo@consequatpur', '2631 Curabitur Road', 'Nampa', 'Alaska', 'Spain', 'Heather', 'Chastity', 'Hughes');
INSERT INTO `supplier_tb` VALUES ('50', 'Adobe', '1-656-150-8762', '(903) 886-0386      ', 'Mauris@ante.ca', '313 Nam Rd.', 'Manassas', 'WV', 'Netherlands Antilles', 'Yael', 'Larissa', 'Hansen');
INSERT INTO `supplier_tb` VALUES ('51', 'Cakewalk', '1-986-922-7280', '(990) 650-2950', 'urna@Maecenas.org', 'Ap #882-3090 Dictum Rd.', 'Midland', 'Manitoba', 'Mauritius', 'Kalia', 'Perry', 'Haney');
INSERT INTO `supplier_tb` VALUES ('52', 'Macromedia', '1-941-197-9227      ', '(554) 919-6543', 'Nullam.ut.nisi@Namac', '8892 Nisl Rd.', 'Norwalk', 'Massachusetts', 'Bosnia and Herzegovina', 'Carly', 'Robin', 'Hendricks');
INSERT INTO `supplier_tb` VALUES ('53', 'Lycos', '1-551-287-0732      ', '(557) 468-2037', 'dis.parturient.monte', 'P.O. Box 200, 1590 Rhoncus. Street', 'Moline', 'RI', 'Lithuania', 'Rhonda', 'Daquan', 'Terrell');
INSERT INTO `supplier_tb` VALUES ('54', 'Finale', '1-977-698-6143', '(820) 478-6694', 'nec@Nuncsed.com', '152-798 Justo St.', 'Port Washington', 'NE', 'Haiti', 'Deirdre', 'Timothy', 'Shepherd');
INSERT INTO `supplier_tb` VALUES ('55', 'Lycos', '1-745-759-7677', '(412) 254-1408      ', 'massa.non@per.edu', '166-1099 Eros. Ave', 'Norton', 'Nunavut', 'Costa Rica', 'Fleur', 'Robin', 'Vang');
INSERT INTO `supplier_tb` VALUES ('56', 'Cakewalk', '1-584-458-4653', '(278) 491-1914', 'Quisque@Incondimentu', '9657 In Av.', 'Kankakee', 'New Hampshire', 'Sudan', 'Kalia', 'Hasad', 'Jefferson');
INSERT INTO `supplier_tb` VALUES ('57', 'Cakewalk', '1-354-402-1073', '(509) 583-8345      ', 'auctor@egestas.ca', 'Ap #697-174 Fringilla Street', 'Grass Valley', 'ID', 'Antigua and Barbuda', 'Ivy', 'Noel', 'Prince');
INSERT INTO `supplier_tb` VALUES ('58', 'Chami', '1-296-932-6365', '(948) 642-2195', 'Etiam.bibendum.ferme', 'P.O. Box 902, 3922 Erat Rd.', 'Temple City', 'CA', 'Sudan', 'Phoebe', 'Aileen', 'Joyce');
INSERT INTO `supplier_tb` VALUES ('59', 'Microsoft', '1-607-459-3884      ', '(334) 912-9659      ', 'Curabitur.vel@antedi', '672-9852 Torquent Rd.', 'Guthrie', 'Oklahoma', 'Albania', 'Althea', 'Irene', 'Saunders');
INSERT INTO `supplier_tb` VALUES ('60', 'Finale', '1-154-397-9912', '(129) 529-9037', 'arcu@elitpretium.org', 'P.O. Box 695, 1840 Fames Rd.', 'Newton', 'Alabama', 'Swaziland', 'Virginia', 'McKenzie', 'Adkins');
INSERT INTO `supplier_tb` VALUES ('61', 'Adobe', '1-332-494-0117', '(817) 506-1088      ', 'risus@vitae.ca', '252-684 Velit. Street', 'Auburn', 'NT', 'Sao Tome and Principe', 'Ulla', 'Jasmine', 'Strong');
INSERT INTO `supplier_tb` VALUES ('62', 'Altavista', '1-707-930-1406      ', '(835) 214-6009', 'egestas@Aliquamvulpu', '357-5564 Mauris St.', 'Fort Lauderdale', 'Ontario', 'Angola', 'Carol', 'Jameson', 'Blevins');
INSERT INTO `supplier_tb` VALUES ('63', 'Google', '1-878-493-6466', '(266) 268-6769', 'dapibus@Sedcongue.or', '712-8976 Non, Street', 'Pomona', 'TN', 'Turks and Caicos Islands', 'Kellie', 'Abel', 'Maxwell');
INSERT INTO `supplier_tb` VALUES ('64', 'Chami', '1-268-793-4809', '(557) 952-9041', 'egestas@semconsequat', '984-8467 Dui Avenue', 'Marlborough', 'Nova Scotia', 'Puerto Rico', 'Hedwig', 'Drake', 'Potter');
INSERT INTO `supplier_tb` VALUES ('65', 'Google', '1-249-432-3275', '(714) 287-4601      ', 'eu.accumsan.sed@duiS', '3921 Ante. Rd.', 'Sierra Madre', 'TN', 'Pakistan', 'Amena', 'Evan', 'Travis');
INSERT INTO `supplier_tb` VALUES ('66', 'Lycos', '1-220-587-4253', '(882) 752-0408', 'adipiscing@non.ca', 'P.O. Box 436, 4904 Vitae, St.', 'Murray', 'Arizona', 'Iran, Islamic Republic of', 'Kelly', 'Tamekah', 'Willis');
INSERT INTO `supplier_tb` VALUES ('67', 'Chami', '1-561-874-1197      ', '(967) 612-4011      ', 'tempus.eu.ligula@Ves', '5051 Dolor Avenue', 'Riverton', 'MD', 'Benin', 'Rose', 'Adara', 'Fletcher');
INSERT INTO `supplier_tb` VALUES ('68', 'Microsoft', '1-218-637-5857      ', '(891) 709-6374', 'libero.at@eleifendnu', 'Ap #654-3528 Ac Av.', 'Chesapeake', 'ME', 'Saint Helena', 'Urielle', 'Maisie', 'Espinoza');
INSERT INTO `supplier_tb` VALUES ('69', 'Altavista', '1-348-924-5652', '(256) 925-6521      ', 'aliquet.vel.vulputat', 'Ap #501-5057 Cursus Road', 'Oxford', 'YT', 'United States Minor Outlying Islands', 'Christen', 'Ulysses', 'Leonard');
INSERT INTO `supplier_tb` VALUES ('70', 'Cakewalk', '1-162-209-6563', '(619) 811-7668      ', 'Quisque.imperdiet.er', 'Ap #473-7398 Erat, St.', 'Sharon', 'NL', 'Bahrain', 'Hayley', 'Adele', 'Perry');
INSERT INTO `supplier_tb` VALUES ('71', 'Apple Systems', '1-958-654-0224', '(631) 145-1126      ', 'facilisis@quam.org', 'P.O. Box 420, 1059 Lectus Ave', 'Hutchinson', 'Nunavut', 'Norfolk Island', 'Vivian', 'Ira', 'Underwood');
INSERT INTO `supplier_tb` VALUES ('72', 'Altavista', '1-189-450-7640', '(370) 439-8239', 'dui.nec@Vestibulum.e', 'Ap #482-8866 Ut, St.', 'Saint Louis', 'QC', 'Sierra Leone', 'Melinda', 'Amal', 'Ferrell');
INSERT INTO `supplier_tb` VALUES ('73', 'Macromedia', '1-742-247-6351', '(220) 506-5348', 'enim@Donecdignissim.', '8299 Duis Road', 'Merizo', 'District of Columbia', 'Korea', 'Tasha', 'Hayley', 'Schroeder');
INSERT INTO `supplier_tb` VALUES ('74', 'Finale', '1-849-663-5484', '(186) 835-2197', 'eu@nunc.com', 'P.O. Box 274, 3482 Luctus. Rd.', 'MayagÃƒÂ¼ez', 'Quebec', 'Sudan', 'Bree', 'Venus', 'Payne');
INSERT INTO `supplier_tb` VALUES ('75', 'Cakewalk', '1-274-727-8528', '(474) 865-7317', 'Aenean.gravida.nunc@', 'Ap #511-515 Consectetuer Av.', 'Tok', 'Illinois', 'Brunei Darussalam', 'Carissa', 'Kirby', 'Hess');
INSERT INTO `supplier_tb` VALUES ('76', 'Lavasoft', '1-795-382-7803', '(646) 667-1070      ', 'luctus@egestasAliqua', 'Ap #305-4168 Nam Street', 'Ansonia', 'NL', 'Sao Tome and Principe', 'Winifred', 'Amanda', 'Steele');
INSERT INTO `supplier_tb` VALUES ('77', 'Sibelius', '1-230-365-5054', '(416) 695-6783      ', 'purus@rhoncusid.org', '4383 Nec, St.', 'Jordan Valley', 'South Carolina', 'Kyrgyzstan', 'Hermione', 'Ivana', 'Madden');
INSERT INTO `supplier_tb` VALUES ('78', 'Chami', '1-711-302-2570', '(258) 101-5513', 'urna.suscipit@Duisgr', 'P.O. Box 923, 9627 Fermentum Road', 'Biddeford', 'British Columbia', 'Macedonia', 'Desiree', 'Noble', 'Duke');
INSERT INTO `supplier_tb` VALUES ('79', 'Cakewalk', '1-718-659-5402      ', '(622) 774-4073', 'magna.Lorem.ipsum@eg', '531-9776 Lacus St.', 'Wahoo', 'Tennessee', 'Palestinian Territory, Occupied', 'Imogene', 'Bree', 'Olsen');
INSERT INTO `supplier_tb` VALUES ('80', 'Finale', '1-508-211-6017      ', '(286) 850-9266', 'luctus@Pellentesque.', '2144 Auctor Rd.', 'Waukegan', 'MN', 'Brunei Darussalam', 'Mercedes', 'Iola', 'Cruz');
INSERT INTO `supplier_tb` VALUES ('81', 'Chami', '1-974-879-6982', '(697) 503-9211', 'eu.tempor@etnetuset.', 'Ap #393-7074 Metus. Avenue', 'Coatesville', 'NS', 'Mexico', 'Portia', 'Darryl', 'Huber');
INSERT INTO `supplier_tb` VALUES ('82', 'Cakewalk', '1-412-318-5898      ', '(469) 617-8677      ', 'enim@Integer.org', 'P.O. Box 849, 4126 Cras St.', 'Duluth', 'MN', 'French Polynesia', 'Alisa', 'Kylee', 'Fitzgerald');
INSERT INTO `supplier_tb` VALUES ('83', 'Yahoo', '1-316-727-5697      ', '(342) 972-5014', 'et.malesuada.fames@F', 'P.O. Box 523, 5755 Parturient Av.', 'Berkeley', 'Michigan', 'Kenya', 'Wilma', 'Melissa', 'Herrera');
INSERT INTO `supplier_tb` VALUES ('84', 'Apple Systems', '1-771-152-5132', '(807) 856-5934      ', 'ridiculus.mus.Proin@', '4933 Nascetur St.', 'Sonoma', 'New Brunswick', 'Burkina Faso', 'Ocean', 'Suki', 'Estes');
INSERT INTO `supplier_tb` VALUES ('85', 'Cakewalk', '1-329-891-7490', '(754) 161-9920      ', 'porttitor@Sedeueros.', 'Ap #607-6583 Elit, Ave', 'Chula Vista', 'Oregon', 'Cuba', 'Jolene', 'Gwendolyn', 'Cochran');
INSERT INTO `supplier_tb` VALUES ('86', 'Sibelius', '1-158-625-1970', '(888) 702-1272      ', 'et.ultrices.posuere@', '441-2582 Tellus. Ave', 'Brooklyn Park', 'Saskatchewan', 'Mauritania', 'Erin', 'Alfonso', 'Floyd');
INSERT INTO `supplier_tb` VALUES ('87', 'Adobe', '1-388-661-0824', '(725) 877-8017', 'ligula@bibendumDonec', '2489 Nec Avenue', 'Hammond', 'NU', 'Sudan', 'Sara', 'Cooper', 'Patel');
INSERT INTO `supplier_tb` VALUES ('88', 'Lavasoft', '1-528-347-1710', '(337) 515-7864      ', 'Maecenas@magnaDuis.e', 'P.O. Box 785, 5485 Justo. Ave', 'Myrtle Beach', 'Quebec', 'Congo', 'McKenzie', 'Anastasia', 'Garner');
INSERT INTO `supplier_tb` VALUES ('89', 'Google', '1-655-327-0832', '(687) 903-0303', 'Cras@pede.com', 'P.O. Box 887, 5886 Fames Rd.', 'Monterey Park', 'Manitoba', 'Tunisia', 'Quyn', 'Devin', 'Dyer');
INSERT INTO `supplier_tb` VALUES ('90', 'Yahoo', '1-529-380-1356', '(674) 162-2821', 'ut.dolor.dapibus@eu.', 'P.O. Box 190, 8627 Lorem, Rd.', 'Myrtle Beach', 'TX', 'Micronesia', 'Althea', 'Ferdinand', 'Chambers');
INSERT INTO `supplier_tb` VALUES ('91', 'Microsoft', '1-444-385-3719', '(878) 728-0459', 'Donec.vitae@sedsemeg', 'Ap #501-6612 Neque. Street', 'Covina', 'DE', 'Czech Republic', 'Lacey', 'Melyssa', 'Hale');
INSERT INTO `supplier_tb` VALUES ('92', 'Altavista', '1-205-322-7945      ', '(117) 932-6771', 'malesuada.id.erat@Nu', '890 Erat St.', 'Champaign', 'SC', 'Japan', 'Alana', 'Elizabeth', 'Harding');
INSERT INTO `supplier_tb` VALUES ('93', 'Macromedia', '1-656-726-5388', '(696) 246-4803', 'lorem@magnaNamligula', '445-6818 Mi Rd.', 'Richmond', 'MB', 'Benin', 'Germane', 'Ruby', 'Vargas');
INSERT INTO `supplier_tb` VALUES ('94', 'Adobe', '1-597-340-6176', '(413) 826-6181      ', 'dictum@elitpellentes', '489-8995 Tortor Rd.', 'Nacogdoches', 'Quebec', 'Greenland', 'Sarah', 'Jaquelyn', 'Bright');
INSERT INTO `supplier_tb` VALUES ('95', 'Microsoft', '1-229-184-5704      ', '(535) 863-3781', 'ac@tempusnonlacinia.', 'Ap #528-2690 Nam Road', 'Mission Viejo', 'Nunavut', 'Tuvalu', 'Clementine', 'Branden', 'Vazquez');
INSERT INTO `supplier_tb` VALUES ('96', 'Cakewalk', '1-843-889-3159      ', '(606) 108-1948      ', 'Suspendisse@Suspendi', 'Ap #272-7093 Vel Avenue', 'Scottsbluff', 'Manitoba', 'Comoros', 'Ciara', 'Brynn', 'Riddle');
INSERT INTO `supplier_tb` VALUES ('97', 'Sibelius', '1-210-407-5755      ', '(873) 995-0778', 'eu.enim@esttempor.co', '531-2043 Sed Street', 'Gloucester', 'NL', 'Cameroon', 'Lunea', 'Alma', 'Peck');
INSERT INTO `supplier_tb` VALUES ('98', 'Chami', '1-327-942-4651', '(991) 317-3882', 'lorem@dictum.com', '568-7296 Nam Avenue', 'Pocatello', 'YT', 'Palau', 'Fay', 'Abigail', 'Donaldson');
INSERT INTO `supplier_tb` VALUES ('99', 'Chami', '1-738-621-1089', '(938) 391-3252', 'eget.metus@elementum', '783-6079 Gravida St.', 'Schaumburg', 'YT', 'Taiwan, Province of China', 'Gay', 'Cullen', 'Pruitt');
INSERT INTO `supplier_tb` VALUES ('100', 'Lavasoft', '1-660-664-3228      ', '(290) 483-6568', 'Phasellus.fermentum@', 'Ap #303-7292 Lorem Avenue', 'Lahaina', 'Massachusetts', 'United Arab Emirates', 'Rhonda', 'Deacon', 'Chang');

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of system_settings_tb
-- ----------------------------
INSERT INTO `system_settings_tb` VALUES ('1', '5', '47', '36', '20', '21', '2', '1');
INSERT INTO `system_settings_tb` VALUES ('0', null, null, null, null, null, null, null);

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
  PRIMARY KEY (`um_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of unit_material_type_tb
-- ----------------------------
INSERT INTO `unit_material_type_tb` VALUES ('1', '200L Drum');
INSERT INTO `unit_material_type_tb` VALUES ('2', '18L Pail');
INSERT INTO `unit_material_type_tb` VALUES ('3', '6x4 Box');
INSERT INTO `unit_material_type_tb` VALUES ('4', '24x1 Box');
INSERT INTO `unit_material_type_tb` VALUES ('5', '12x1 Box');
INSERT INTO `unit_material_type_tb` VALUES ('7', '20L Pail');
