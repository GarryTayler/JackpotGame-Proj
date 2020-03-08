/*
Navicat MySQL Data Transfer

Source Server         : 로컬서버
Source Server Version : 100410
Source Host           : localhost:3306
Source Database       : jackpot

Target Server Type    : MYSQL
Target Server Version : 100410
File Encoding         : 65001

Date: 2020-02-26 10:19:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for chats
-- ----------------------------
DROP TABLE IF EXISTS `chats`;
CREATE TABLE `chats` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CHAT_TYPE` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `CREATE_TIME` int(12) NOT NULL,
  `UPDATE_TIME` int(12) NOT NULL,
  `MSG` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `IPADDRESS` varchar(24) COLLATE utf8_unicode_ci DEFAULT '0.0.0.0',
  `DEL_YN` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `USERID` bigint(20) DEFAULT NULL,
  `CHANNEL` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'ENG',
  PRIMARY KEY (`ID`) USING BTREE,
  KEY `FK_USERS_TO_CHATS` (`USERID`) USING BTREE,
  CONSTRAINT `FK_USERS_TO_CHATS` FOREIGN KEY (`USERID`) REFERENCES `users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of chats
-- ----------------------------
INSERT INTO `chats` VALUES ('1', 'jackpot', '1582488099', '1582488099', 'resr\n', '192.168.99.107', 'N', '1', 'ENG');
INSERT INTO `chats` VALUES ('2', 'jackpot', '1582609921', '1582609921', 'test\n', '192.168.99.107', 'N', '1', 'ENG');
INSERT INTO `chats` VALUES ('3', 'jackpot', '1582712092', '1582712092', 'werwer', '::1', 'N', '1', 'ENG');

-- ----------------------------
-- Table structure for cron
-- ----------------------------
DROP TABLE IF EXISTS `cron`;
CREATE TABLE `cron` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `CREATE_TIME` int(12) DEFAULT NULL,
  `DATE` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of cron
-- ----------------------------

-- ----------------------------
-- Table structure for jackpot_game
-- ----------------------------
DROP TABLE IF EXISTS `jackpot_game`;
CREATE TABLE `jackpot_game` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'GAME_UNIQ_ID',
  `CREATE_TIME` int(11) DEFAULT NULL,
  `UPDATE_TIME` int(11) DEFAULT NULL,
  `HASH` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TOTAL_PLAYERS` bigint(20) DEFAULT 0,
  `TOTAL_PROFIT` decimal(20,2) DEFAULT NULL,
  `DEL_YN` char(1) COLLATE utf8_unicode_ci DEFAULT 'N',
  `TOTAL_BETTING_AMOUNT` decimal(20,2) DEFAULT 0.00,
  `WINNER` bigint(10) DEFAULT 0 COMMENT '// the winner',
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of jackpot_game
-- ----------------------------
INSERT INTO `jackpot_game` VALUES ('1', '1575764968', '1575764968', '0e8383b9fdba3a1bba4942ec719cd59f', '0', '0.00', 'N', '0.00', '1');
INSERT INTO `jackpot_game` VALUES ('2', '1575764994', '1575764994', 'bea25df672e93e985f6c3819874d6c3a', '0', '0.00', 'N', '0.00', '1');
INSERT INTO `jackpot_game` VALUES ('3', '1575765096', '1575765096', 'bf7ab570ce8f30bd0aaf367d0be3d447', '0', '0.00', 'N', '0.00', '2');
INSERT INTO `jackpot_game` VALUES ('4', '1575765119', '1575765119', '47cb15135031c236e8f6a748afc39eb4', '0', '0.00', 'N', '0.00', '2');
INSERT INTO `jackpot_game` VALUES ('5', '1575766209', '1575766209', 'd64e9634e5c448a3c26c1c0151392d85', '0', '0.00', 'N', '0.00', '2');
INSERT INTO `jackpot_game` VALUES ('9', '1579720547', '1579720547', 'a465d0295ff48047e84b3ecf580ca225', '1', null, 'N', '1000.00', '0');

-- ----------------------------
-- Table structure for jackpot_game_log
-- ----------------------------
DROP TABLE IF EXISTS `jackpot_game_log`;
CREATE TABLE `jackpot_game_log` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CREATE_TIME` int(11) DEFAULT NULL,
  `UPDATE_TIME` int(11) DEFAULT NULL,
  `BET_AMOUNT` decimal(20,2) DEFAULT NULL,
  `GAMEID` bigint(20) DEFAULT NULL,
  `USERID` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  KEY `FK_ROULETTE_GAME_TO_ROULETTE_GAME_LOG` (`GAMEID`) USING BTREE,
  KEY `FK_USERS_TO_ROULETTE_GAME_LOG` (`USERID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of jackpot_game_log
-- ----------------------------
INSERT INTO `jackpot_game_log` VALUES ('1', '1575489848', null, '1000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('2', '1575489987', null, '11000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('3', '1575490156', null, '1000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('4', '1575490242', null, '1000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('5', '1575490357', null, '1000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('6', '1575490378', null, '1000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('7', '1575490402', null, '2000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('8', '1575490451', null, '2000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('9', '1575490529', null, '3000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('10', '1575490566', null, '4000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('11', '1575490608', null, '2000.00', '1', '2');
INSERT INTO `jackpot_game_log` VALUES ('12', '1575490731', null, '1000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('13', '1575490759', null, '1000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('14', '1575491030', null, '1000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('15', '1575491036', null, '11000.00', '1', '3');
INSERT INTO `jackpot_game_log` VALUES ('16', '1575491697', null, null, '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('17', '1575491865', null, null, '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('18', '1575491867', null, null, '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('19', '1575491874', null, null, '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('20', '1575491900', null, '1000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('21', '1575491920', null, '1000.00', '1', '5');
INSERT INTO `jackpot_game_log` VALUES ('22', '1575491961', null, '1000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('23', '1575492471', null, '1000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('24', '1575492497', null, '1000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('25', '1575492586', null, '1000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('26', '1575492591', null, '1000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('27', '1575492592', null, '1000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('28', '1575492592', null, '1000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('29', '1575492592', null, '1000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('30', '1575492698', null, '100.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('31', '1575493694', null, '50000.00', '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('32', '1575541468', null, null, '1', '1');
INSERT INTO `jackpot_game_log` VALUES ('33', '1575724555', null, '1000.00', '2', '1');
INSERT INTO `jackpot_game_log` VALUES ('34', '1575724797', null, '10000.00', '2', '1');
INSERT INTO `jackpot_game_log` VALUES ('35', '1575724814', null, '11000.00', '2', '1');
INSERT INTO `jackpot_game_log` VALUES ('36', '1575724891', null, '1000.00', '2', '1');
INSERT INTO `jackpot_game_log` VALUES ('37', '1575725031', null, '1000.00', '2', '2');
INSERT INTO `jackpot_game_log` VALUES ('38', '1575725036', null, '101000.00', '2', '2');
INSERT INTO `jackpot_game_log` VALUES ('39', '1575725146', null, '102000.00', '3', '2');
INSERT INTO `jackpot_game_log` VALUES ('40', '1575725154', null, '10000.00', '3', '1');
INSERT INTO `jackpot_game_log` VALUES ('41', '1575725159', null, '110000.00', '3', '1');
INSERT INTO `jackpot_game_log` VALUES ('42', '1575725269', null, '1000.00', '4', '2');
INSERT INTO `jackpot_game_log` VALUES ('43', '1575725271', null, '120000.00', '4', '1');
INSERT INTO `jackpot_game_log` VALUES ('44', '1575725279', null, '11000.00', '4', '2');
INSERT INTO `jackpot_game_log` VALUES ('45', '1575725284', null, '121000.00', '4', '1');
INSERT INTO `jackpot_game_log` VALUES ('46', '1575725290', null, '11000.00', '4', '2');
INSERT INTO `jackpot_game_log` VALUES ('47', '1575725297', null, '12000.00', '4', '1');
INSERT INTO `jackpot_game_log` VALUES ('48', '1575725459', null, '1000.00', '5', '2');
INSERT INTO `jackpot_game_log` VALUES ('58', '1576109566', null, '1000.00', '7', '1');
INSERT INTO `jackpot_game_log` VALUES ('59', '1576109806', null, '1000.00', '7', '1');
INSERT INTO `jackpot_game_log` VALUES ('60', '1576109849', null, '1000.00', '7', '2');
INSERT INTO `jackpot_game_log` VALUES ('61', '1582712367', null, '1000.00', '9', '1');

-- ----------------------------
-- Table structure for queue
-- ----------------------------
DROP TABLE IF EXISTS `queue`;
CREATE TABLE `queue` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `CREATE_TIME` int(12) DEFAULT NULL,
  `UPDATE_TIME` int(12) DEFAULT NULL,
  `TYPE` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'roulette\r\n	crash\r\n	jackpot\r\n	ladder\r\n	',
  `ACTION` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PARAM` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `USERID` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  KEY `FK_USERS_TO_QUEUE` (`USERID`) USING BTREE,
  CONSTRAINT `FK_USERS_TO_QUEUE` FOREIGN KEY (`USERID`) REFERENCES `users` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of queue
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PASSWORD` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `CREATE_TIME` int(11) DEFAULT NULL,
  `UPDATE_TIME` int(11) DEFAULT NULL,
  `DEL_YN` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `IPADDRESS` varchar(50) COLLATE utf8_unicode_ci DEFAULT '0.0.0.0',
  `EMAIL_VERIFIED_YN` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `STATE` int(3) NOT NULL DEFAULT 0 COMMENT '0: active\r\n	1: stop\r\n	2: block\r\n	',
  `COUNTRY` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AVATAR` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AVATAR_SMALL` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AVATAR_MEDIUM` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SNS_USER_YN` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `M_TOKEN` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `USER_LEVEL` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LAST_IPADDRESS` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WALLET` decimal(20,2) DEFAULT 0.00,
  `API_TOKEN` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WALLET_BLOCK` decimal(20,2) DEFAULT 0.00,
  `WALLET_AVAILABLE` decimal(20,2) DEFAULT 0.00,
  PRIMARY KEY (`ID`) USING BTREE,
  UNIQUE KEY `UIX_USERS` (`USERNAME`,`EMAIL`,`ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Test Accoun', 'b59c67bf196a4758191e42f76670ceba', 'test@test.com', null, '1558829905', 'N', '0.0.0.0', 'Y', '0', null, 'avatar_120200225210818.jpg', 'avatar_120200225210818.jpg', 'avatar_120200225210818.jpg', 'N', null, 'LEVEL1', '::1', '2251040.00', '9faG1Lp9PypxY6DoMAQ4OXjR', '184515.00', '2066525.00');
INSERT INTO `users` VALUES ('2', 'Michale Jackson', 'b59c67bf196a4758191e42f76670ceba', 'Michale@test.com', null, null, 'N', '0.0.0.0', 'N', '0', null, 'avatar_220200225215453.jpg', 'avatar_220200225215453.jpg', 'avatar_220200225215453.jpg', 'N', null, 'LEVEL1', '192.168.99.107', '1129040.00', '0PBT7IazEdDEYO7nTtcsMEY7', '-74024.00', '1203064.00');
SET FOREIGN_KEY_CHECKS=1;
