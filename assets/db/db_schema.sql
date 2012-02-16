/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50154
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50154
File Encoding         : 65001

Date: 2012-02-10 08:36:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `connections`
-- ----------------------------
DROP TABLE IF EXISTS `connections`;
CREATE TABLE `connections` (
  `connection_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `connection_rank` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`connection_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of connections
-- ----------------------------

-- ----------------------------
-- Table structure for `items`
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(300) NOT NULL,
  `item_link` text,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of items
-- ----------------------------

-- ----------------------------
-- Table structure for `item_types`
-- ----------------------------
DROP TABLE IF EXISTS `item_types`;
CREATE TABLE `item_types` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of item_types
-- ----------------------------

-- ----------------------------
-- Table structure for `tags`
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tags
-- ----------------------------
