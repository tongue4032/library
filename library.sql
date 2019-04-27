/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50638
 Source Host           : localhost:3306
 Source Schema         : library

 Target Server Type    : MySQL
 Target Server Version : 50638
 File Encoding         : 65001

 Date: 27/04/2019 17:15:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ci_sessions
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) CHARACTER SET utf8 NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8 NOT NULL,
  `timestamp` int(3) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of ci_sessions
-- ----------------------------
BEGIN;
INSERT INTO `ci_sessions` VALUES ('b0c4cf29c117bbda3dc83b069d3f979660b55f17', '127.0.0.1', 1556356459, 0x5F5F63695F6C6173745F726567656E65726174657C693A313535363335323335333B747970657C613A323A7B693A303B613A323A7B733A323A226964223B733A313A2231223B733A31323A2270726F66657373696F6E616C223B733A31333A2241646D696E6973747261746F72223B7D693A313B613A323A7B733A323A226964223B733A313A2232223B733A31323A2270726F66657373696F6E616C223B733A31393A2253757065722041646D696E6973747261746F72223B7D7D61646D696E7C613A323A7B733A383A2261646D696E5F6964223B733A313A2232223B733A31303A2261646D696E5F6E616D65223B733A363A2261646D696E32223B7D757365727C613A353A7B733A383A2261646D696E5F6964223B733A313A2231223B733A31303A2261646D696E5F6E616D65223B733A363A2261646D696E31223B733A393A2261646D696E5F707764223B733A33323A223031393230323361376262643733323530353136663036396466313862353030223B733A31323A2270726F66657373696F6E616C223B733A31393A2253757065722041646D696E6973747261746F72223B733A31353A226C6173745F6C6F67696E5F64617465223B733A31393A22323031392D30342D32352031373A32363A3530223B7D74797065737C613A323A7B693A303B613A323A7B733A323A226964223B733A313A2231223B733A31323A2270726F66657373696F6E616C223B733A373A2254656163686572223B7D693A313B613A323A7B733A323A226964223B733A313A2232223B733A31323A2270726F66657373696F6E616C223B733A373A2253747564656E74223B7D7D75736572737C613A323A7B733A373A22757365725F6964223B733A313A2232223B733A383A22757365726E616D65223B733A363A225472656B6572223B7D7573657C613A323A7B733A373A22757365725F6964223B733A313A2233223B733A383A22757365726E616D65223B733A343A22546F6E79223B7D);
COMMIT;

-- ----------------------------
-- Table structure for lib_admin
-- ----------------------------
DROP TABLE IF EXISTS `lib_admin`;
CREATE TABLE `lib_admin` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `admin_pwd` varchar(200) COLLATE utf8_bin NOT NULL,
  `professional` varchar(50) COLLATE utf8_bin NOT NULL,
  `last_login_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`admin_id`) USING BTREE,
  KEY `admintype` (`professional`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='管理员表';

-- ----------------------------
-- Records of lib_admin
-- ----------------------------
BEGIN;
INSERT INTO `lib_admin` VALUES (1, 'admin1', '0192023a7bbd73250516f069df18b500', 'Super Administrator', '2019-04-25 17:26:50');
INSERT INTO `lib_admin` VALUES (2, 'admin2', '0192023a7bbd73250516f069df18b500', 'Administrator', '2019-04-27 16:44:03');
INSERT INTO `lib_admin` VALUES (3, 'admin3', '0192023a7bbd73250516f069df18b500', 'Administrator', '2019-04-27 16:43:52');
INSERT INTO `lib_admin` VALUES (4, 'admin4', '0192023a7bbd73250516f069df18b500', 'Administrator', '2019-03-28 17:39:06');
INSERT INTO `lib_admin` VALUES (5, 'admin5', '0192023a7bbd73250516f069df18b500', 'Super Administrator', '2019-04-03 16:04:00');
INSERT INTO `lib_admin` VALUES (6, 'admin6', '0192023a7bbd73250516f069df18b500', 'Administrator', '2019-03-28 17:39:45');
INSERT INTO `lib_admin` VALUES (7, 'admin7', '0192023a7bbd73250516f069df18b500', 'Super Administrator', '2019-04-27 13:00:23');
INSERT INTO `lib_admin` VALUES (9, 'admin9', '0192023a7bbd73250516f069df18b500', 'Super Administrator', '2019-04-09 17:14:48');
INSERT INTO `lib_admin` VALUES (10, 'admin10', '0192023a7bbd73250516f069df18b500', 'Super Administrator', '2019-04-03 16:04:33');
INSERT INTO `lib_admin` VALUES (96, 'admin11', '0192023a7bbd73250516f069df18b500', 'Administrator ', '2019-04-16 11:24:39');
INSERT INTO `lib_admin` VALUES (97, 'admin12', '0192023a7bbd73250516f069df18b500', 'Administrator ', '2019-04-17 10:50:25');
COMMIT;

-- ----------------------------
-- Table structure for lib_admin_permission
-- ----------------------------
DROP TABLE IF EXISTS `lib_admin_permission`;
CREATE TABLE `lib_admin_permission` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  `permisson_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin` (`admin_id`),
  KEY `role` (`role_id`),
  KEY `permission` (`permisson_id`),
  CONSTRAINT `admin` FOREIGN KEY (`admin_id`) REFERENCES `lib_admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission` FOREIGN KEY (`permisson_id`) REFERENCES `lib_permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role` FOREIGN KEY (`role_id`) REFERENCES `lib_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for lib_bookinfo
-- ----------------------------
DROP TABLE IF EXISTS `lib_bookinfo`;
CREATE TABLE `lib_bookinfo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `barcode` varchar(30) CHARACTER SET utf8 NOT NULL,
  `bookname` varchar(70) CHARACTER SET utf8 NOT NULL,
  `author` varchar(30) CHARACTER SET utf8 NOT NULL,
  `press` varchar(20) CHARACTER SET utf8 NOT NULL,
  `publish_date` date NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `barcode` (`barcode`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='书籍信息表';

-- ----------------------------
-- Records of lib_bookinfo
-- ----------------------------
BEGIN;
INSERT INTO `lib_bookinfo` VALUES (2, '102', '夏摩山谷', '庆山', '江苏凤凰文艺出版社', '2019-03-09', '《夏摩山谷》是一部关于爱情的小说，亦关乎\"观察\"和\"觉知\"。三个女人在时间和空间的交错中相遇在夏摩山谷，每一个人都有自己的故事：如真曾一心追求真爱，却总是收获伤心，好在后来在自己的小茶馆里遇见解...');
INSERT INTO `lib_bookinfo` VALUES (3, '103', '得未曾有', '庆山', '北京十月文艺出版社', '2014-06-17', '《得未曾有》是著名作家安妮宝贝改笔名“庆山”后首次发表的*散文集。\r\n新的笔名意味着状态和心境的变化，她如此解释道：“这次改名不代表安妮宝贝这个名字的消失。所有新的发生，建立于原先，而不是离开自己...');
INSERT INTO `lib_bookinfo` VALUES (4, '104', '摆渡人', '克莱儿·麦克福尔', '百花洲文艺出版社', '2011-09-10', '单亲女孩迪伦，15岁的世界一片狼藉：与母亲总是无话可说，在学校里经常受到同学的捉弄，*谈得来的好友也因为转学离开了。这一切都让迪伦感到无比痛苦。\r\n　　她决定去看望久未谋面的父亲，然而，路上突发交通事故。等她拼命爬出火车残骸之后，却惊恐地发现，自己是*的幸存者，而眼前，竟是一片荒原。\r\n　　此时，迪伦看到不远处的山坡上一个男孩的身影。\r\n　　男孩将她带...');
INSERT INTO `lib_bookinfo` VALUES (5, '105', '云边有个小卖部', '张嘉佳', '湖南文艺出版社', '2013-08-11', '让刘十三陪着你，走进云边镇的春夏秋冬，见证每一场相遇与离别。“有些人刻骨铭心，没几年会遗忘。有些人不论生死，都陪在身旁。”圆满镇开着桔梗，蒲公英飞得比石榴树还高，一直飘进山脚的稻海。在大多数人心中，自己的故乡后来会成为一个点，如同亘古不变的孤岛。外婆说，什么叫故乡，祖祖辈...');
INSERT INTO `lib_bookinfo` VALUES (7, '107', '社会心理学', '戴维.迈尔斯', '人民邮电出版社', '2006-01-10', '社会心理学（第8版）中文版被美国700多所大学/学院心理系所采用，是这一领域的主导教材，已经成为评价其他教材的标准。\r\n社会心理学（第8版）中文版将基础研究与实践应用完美地结合在一起，以富有逻辑性的组织结构引领学生了解人们是如何思索、影响他');
INSERT INTO `lib_bookinfo` VALUES (8, '108', '人际交往心理学', '牧之', '江西美术出版社', '2017-05-09', '《人际交往心理学》从心理学的角度对人际交往进行全新梳理，别具匠心。它结合日常生活中的实际案例和经典故事，对人际交往中的各种心理现象进行了较为详尽的分析，并提供了简单易行的操作思路和方法，有助于我...');
INSERT INTO `lib_bookinfo` VALUES (11, '110', '编译原理', '阿霍', '机械工业出版社', '2008-12-00', '本书全面、深入地探讨了编译器设计方面的重要主题，包括词法分析、语法分析、语法制导定义和语法制导翻译、运行时刻环境、目标代码生成、代码优化技术、并行性检测以及过程间分析技术，并在相关章节中给出大量的实例。与上一版相比，本书进行了全面修订，涵盖了编译器开发方面*进展。每...');
INSERT INTO `lib_bookinfo` VALUES (12, '111', '代码整洁之道', 'Robert C', '人民邮电出版社', '2009-12-00', ' 软件质量，不但依赖于架构及项目管理，而且与代码质量紧密相关。这一点，无论是敏捷开发流派还是传统开发流派，都不得不承认。\n   　本书提出一种观念：代码质量与其整洁度成正比。干净的代码，既在质量上较为可靠，也为后期维护、升级奠定了良好基础。作为编程领域的佼佼者，本书作者给出了一系列行之有效的整洁代码操作实践。这些实践在本书中体现为一条条规则(或称“启示”)，并辅以来自现实项目的正、反两面...');
INSERT INTO `lib_bookinfo` VALUES (13, '112', '流浪地球', '王德广发', '广西人民出版社', '2019-01-00', '本书全面记录了国产科幻巨制《流浪地球》从开发策划、建组筹备、开机拍摄，再到后期视效合成的制作全流程。你将看到导演郭帆集结的一支年轻且富有创新精神的专业团队；将看到中国科幻电影如何从西方叙事语境中破壁而出...');
INSERT INTO `lib_bookinfo` VALUES (14, '113', '边度系稳人', '史蒂芬·霍金', '稳笨人民出版社', '1998-09-12', '《摆渡人》是一篇灵魂治愈小说，它那史诗般的动人故事、完全意想不到的情节构思、作者高超的写作技巧和多重主题的相与交融，不但使作品别具一格，值得瞩目，而且又不失其内涵和令人深思的空间，通过解析富有浓郁哲理的三重主题，引导读者体会到小说表面上看。');
INSERT INTO `lib_bookinfo` VALUES (20, '967', '冇人稳你', '梅德水', '稳笨人民出版社', '2019-03-25', '阿卡丽积分可拉伸机离开房间爱上了；解放路卡我哈佛卡拉洛杉矶的福利卡减肥就拉屎');
INSERT INTO `lib_bookinfo` VALUES (21, '879', '乜事啊你', '吴德兴', '冇人理你出版社', '2014-06-01', '按揭付款了时间到了犯贱按理说');
INSERT INTO `lib_bookinfo` VALUES (79, '78699', '庆山安妮宝贝', '史蒂芬·霍金', '山西教育出版社', '2019-03-09', 'bgljgjkgjk');
COMMIT;

-- ----------------------------
-- Table structure for lib_borrow
-- ----------------------------
DROP TABLE IF EXISTS `lib_borrow`;
CREATE TABLE `lib_borrow` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `barcode` varchar(30) NOT NULL,
  `user_id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `bookname` varchar(100) NOT NULL,
  `author` varchar(30) NOT NULL,
  `borrow_time` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lib_borrow
-- ----------------------------
BEGIN;
INSERT INTO `lib_borrow` VALUES (4, '102', 1, 'user', '夏摩山谷', '庆山', '2019-04-25');
COMMIT;

-- ----------------------------
-- Table structure for lib_permission
-- ----------------------------
DROP TABLE IF EXISTS `lib_permission`;
CREATE TABLE `lib_permission` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NOT NULL,
  `action_code` varchar(32) COLLATE utf8_bin NOT NULL,
  `cn_name` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='权限表';

-- ----------------------------
-- Records of lib_permission
-- ----------------------------
BEGIN;
INSERT INTO `lib_permission` VALUES (1, 0, 'books', '图书管理');
INSERT INTO `lib_permission` VALUES (2, 0, 'reader', '用户管理');
INSERT INTO `lib_permission` VALUES (3, 1, 'books_add', '图书添加');
INSERT INTO `lib_permission` VALUES (4, 1, 'books_edit', '图书编辑');
INSERT INTO `lib_permission` VALUES (5, 1, 'books_del', '图书删除');
INSERT INTO `lib_permission` VALUES (6, 1, 'books_return', '还书');
INSERT INTO `lib_permission` VALUES (7, 1, 'books_borrow', '借书');
INSERT INTO `lib_permission` VALUES (8, 2, 'reader_add', '增加读者');
INSERT INTO `lib_permission` VALUES (9, 2, 'reader_edit', '编辑读者');
INSERT INTO `lib_permission` VALUES (10, 2, 'reader_del', '删除读者');
INSERT INTO `lib_permission` VALUES (11, 3, 'admin_user_add', '增加管理员');
INSERT INTO `lib_permission` VALUES (12, 3, 'admin_user_edit', '编辑管理员');
INSERT INTO `lib_permission` VALUES (13, 3, 'admin_user_del', '删除管理员');
INSERT INTO `lib_permission` VALUES (14, 3, 'books_cat_edit', '编辑图书分类');
INSERT INTO `lib_permission` VALUES (15, 3, 'books_cat_add', '添加图书分类');
INSERT INTO `lib_permission` VALUES (16, 3, 'books_cat_del', '删除图书分类');
COMMIT;

-- ----------------------------
-- Table structure for lib_role
-- ----------------------------
DROP TABLE IF EXISTS `lib_role`;
CREATE TABLE `lib_role` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `action_list` text COLLATE utf8_bin,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色表（不同的管理员有不同的角色和权限）';

-- ----------------------------
-- Records of lib_role
-- ----------------------------
BEGIN;
INSERT INTO `lib_role` VALUES (1, 'reader', 'books_return,books_borrow', '2012-10-19 12:38:42', '2012-10-19 12:38:42');
INSERT INTO `lib_role` VALUES (2, 'superadmin', 'books_add,books_edit,books_del,books_return,books_borrow,reader_add,reader_edit,reader_del,admin_user_add,admin_user_edit,admin_user_del,admin_role_add,admin_role_edit,admin_role_del', '2012-11-18 02:36:42', '2012-11-18 02:36:42');
INSERT INTO `lib_role` VALUES (3, 'admin', 'books_add,books_edit,books_del,books_return,books_borrow,reader_add,reader_edit,reader_del', '2012-10-09 04:04:49', '2012-10-09 04:04:49');
COMMIT;

-- ----------------------------
-- Table structure for lib_type
-- ----------------------------
DROP TABLE IF EXISTS `lib_type`;
CREATE TABLE `lib_type` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `professional` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `name` (`professional`),
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='读者类型表';

-- ----------------------------
-- Records of lib_type
-- ----------------------------
BEGIN;
INSERT INTO `lib_type` VALUES (1, 'Administrator');
INSERT INTO `lib_type` VALUES (2, 'Super Administrator');
COMMIT;

-- ----------------------------
-- Table structure for lib_user
-- ----------------------------
DROP TABLE IF EXISTS `lib_user`;
CREATE TABLE `lib_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `telephone` varchar(20) CHARACTER SET utf8 NOT NULL,
  `professional` varchar(10) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`) USING BTREE,
  KEY `professionalkey` (`professional`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='读者表';

-- ----------------------------
-- Records of lib_user
-- ----------------------------
BEGIN;
INSERT INTO `lib_user` VALUES (1, 'user', 'b5b73fae0d87d8b4e2573105f8fbe7bc', '13129207435', 'Teacher', '2046817306@qq.com', '2019-03-08 11:23:30');
INSERT INTO `lib_user` VALUES (2, 'Treker', '8d7e49e84d01cb14d2e8d17c469620cc', '12345678901', 'Student', '', '2019-03-08 11:48:11');
INSERT INTO `lib_user` VALUES (3, 'Tony', 'e0b7eae7ce51554ae2d396e4f0af27d0', '', 'Teacher', 'tongue4032@163.com', '2019-03-13 19:59:37');
INSERT INTO `lib_user` VALUES (4, 'Amy', '24ffe7b9d753c8f9ea30969e07f8dd7e', '12345678901', 'Student', 'tongue4032@outlook.com', '2019-03-13 20:01:35');
INSERT INTO `lib_user` VALUES (5, 'Pandora', '6ad14ba9986e3615423dfca256d04e3f', '13508808958', 'Teacher', 'ro2bp2a@gmail.com', '2019-03-28 17:07:00');
INSERT INTO `lib_user` VALUES (6, 'Deborah', '6ad14ba9986e3615423dfca256d04e3f', '13203424433', 'Student', 'z7ld1k@0355.net', '2019-03-28 17:07:48');
INSERT INTO `lib_user` VALUES (7, 'Elliot', '6ad14ba9986e3615423dfca256d04e3f', '13801674266', 'Teacher', 'skruidr3m@yahoo.com.cn', '2019-03-28 17:09:05');
INSERT INTO `lib_user` VALUES (8, 'Hugh', '6ad14ba9986e3615423dfca256d04e3f', '13406928250', 'Teacher', 'ntv7xe@yahoo.com', '2019-03-28 17:10:35');
INSERT INTO `lib_user` VALUES (9, 'Deirdre', '6ad14ba9986e3615423dfca256d04e3f', '', 'Teacher', '5xan4w4z@msn.com', '2019-03-28 17:11:30');
INSERT INTO `lib_user` VALUES (10, 'Burton', '6ad14ba9986e3615423dfca256d04e3f', '', 'Student', 'dnbngx@gmail.com', '2019-03-28 17:12:02');
INSERT INTO `lib_user` VALUES (11, 'Bart', '6ad14ba9986e3615423dfca256d04e3f', '', 'Student', '89zrduk55@yeah.net', '2019-03-28 17:12:36');
INSERT INTO `lib_user` VALUES (12, 'Michelle', '6ad14ba9986e3615423dfca256d04e3f', '13603453666', 'Student', 'qdlbiqrhx@hotmail.com', '2019-03-28 17:13:22');
INSERT INTO `lib_user` VALUES (13, 'Myra', '6ad14ba9986e3615423dfca256d04e3f', '15704247606', 'Teacher', 'f8gdfz99d@gmail.com', '2019-03-28 17:16:37');
INSERT INTO `lib_user` VALUES (14, 'Harlan', '6ad14ba9986e3615423dfca256d04e3f', '13501174903', 'Student', 'bu2tq9@yahoo.com', '2019-03-28 17:17:24');
INSERT INTO `lib_user` VALUES (15, 'Penelope', '6ad14ba9986e3615423dfca256d04e3f', '15600433637', '', 'ukbmju@sohu.com', '2019-03-28 17:18:07');
INSERT INTO `lib_user` VALUES (16, 'Chad', '6ad14ba9986e3615423dfca256d04e3f', '', '', 'fmjukv@163.com', '2019-03-28 17:18:59');
INSERT INTO `lib_user` VALUES (17, 'Armand', '6ad14ba9986e3615423dfca256d04e3f', '', '', 'yb1vtw9@msn.com', '2019-03-28 17:19:33');
INSERT INTO `lib_user` VALUES (18, 'Darnell', '6ad14ba9986e3615423dfca256d04e3f', '15306408016', '', 'fmzvlw2nm@0355.net', '2019-03-28 17:21:06');
INSERT INTO `lib_user` VALUES (20, 'Tracy', '6ad14ba9986e3615423dfca256d04e3f', '', '', '8640244@163.com', '2019-03-28 17:24:26');
INSERT INTO `lib_user` VALUES (21, 'Carey', '6ad14ba9986e3615423dfca256d04e3f', '', '', '217997@msn.com', '2019-03-28 17:25:02');
INSERT INTO `lib_user` VALUES (22, 'Gavin', '6ad14ba9986e3615423dfca256d04e3f', '13801276128', '', '5602111@163.net', '2019-03-28 17:26:21');
INSERT INTO `lib_user` VALUES (23, 'York', '6ad14ba9986e3615423dfca256d04e3f', '13205762641', 'Student', '9111624@hotmail.com', '2019-03-28 17:30:37');
INSERT INTO `lib_user` VALUES (24, 'Walter', '6ad14ba9986e3615423dfca256d04e3f', '13001097627', '', '855447@sohu.com', '2019-03-28 17:31:19');
INSERT INTO `lib_user` VALUES (29, 'Wendy', '79c74d66d6fac761bb028162e5208949', '15803722142', '', '280980591@sohu.com', '2019-04-16 17:33:22');
COMMIT;

-- ----------------------------
-- Table structure for lib_userType
-- ----------------------------
DROP TABLE IF EXISTS `lib_userType`;
CREATE TABLE `lib_userType` (
  `id` int(11) NOT NULL,
  `professional` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lib_userType
-- ----------------------------
BEGIN;
INSERT INTO `lib_userType` VALUES (1, 'Teacher');
INSERT INTO `lib_userType` VALUES (2, 'Student');
COMMIT;

-- ----------------------------
-- Table structure for lib_user_permission
-- ----------------------------
DROP TABLE IF EXISTS `lib_user_permission`;
CREATE TABLE `lib_user_permission` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role_id` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `permission_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_premission` (`role_id`),
  KEY `user_premission` (`user_id`),
  KEY `permission1` (`permission_id`),
  CONSTRAINT `permission1` FOREIGN KEY (`permission_id`) REFERENCES `lib_permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_premission` FOREIGN KEY (`role_id`) REFERENCES `lib_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_premission` FOREIGN KEY (`user_id`) REFERENCES `lib_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

SET FOREIGN_KEY_CHECKS = 1;
