/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50542
 Source Host           : localhost
 Source Database       : inspired

 Target Server Type    : MySQL
 Target Server Version : 50542
 File Encoding         : utf-8

 Date: 02/08/2016 08:14:08 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `contact`
-- ----------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `data_of_birth` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` decimal(10,0) DEFAULT NULL,
  `contact_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_type` (`contact_type`),
  CONSTRAINT `contactType` FOREIGN KEY (`contact_type`) REFERENCES `contact_type` (`contact_type`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `contact`
-- ----------------------------
BEGIN;
INSERT INTO `contact` VALUES ('1', 'Wyatt', 'Marks', null, 'wyattmarksy4c@teleosaurs.xyz', '831000876', 'Office'), ('2', 'Maria', 'Hemmings', null, 'maria.hemmings@gmail.com', null, null), ('3', 'Rose', 'Russell', null, 'rose.russell@gmail.com', null, null), ('4', 'Alan', 'Smith', null, 'alan.smith@gmail.com', null, null), ('5', 'Theresa', 'Baker', null, 'theresa.baker@gmail.com', null, null), ('6', 'Amanda', 'Bell', null, 'amanda.bell@gmail.com', null, null), ('7', 'Isaac', 'Vance', null, 'isaac.vance@gmail.com', null, null), ('8', 'Michael', 'Lee', null, 'michael.lee@gmail.com', null, null), ('9', 'Wendy', 'Jones', null, 'wendy.jones@gmail.com', null, null), ('10', 'Amanda', 'Oliver', null, 'amanda.oliver@gmail.com', null, null), ('11', 'Lillian', 'Young', null, 'lillian.young@gmail.com', null, null), ('12', 'Richard', 'Miller', null, 'richard.miller@gmail.com', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `contact_type`
-- ----------------------------
DROP TABLE IF EXISTS `contact_type`;
CREATE TABLE `contact_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_type` (`contact_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `contact_type`
-- ----------------------------
BEGIN;
INSERT INTO `contact_type` VALUES ('1', 'Home'), ('2', 'Office'), ('3', 'Other');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
