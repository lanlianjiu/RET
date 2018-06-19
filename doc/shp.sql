/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : shp

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-06-19 17:54:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_log
-- ----------------------------
DROP TABLE IF EXISTS `admin_log`;
CREATE TABLE `admin_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `controller_id` varchar(20) DEFAULT NULL COMMENT '控制器ID',
  `action_id` varchar(20) DEFAULT NULL COMMENT '方法ID',
  `url` varchar(200) DEFAULT NULL COMMENT '访问地址',
  `module_name` varchar(50) DEFAULT NULL COMMENT '模块',
  `func_name` varchar(50) DEFAULT NULL COMMENT '功能',
  `right_name` varchar(50) DEFAULT NULL COMMENT '方法',
  `client_ip` varchar(15) DEFAULT NULL COMMENT '客户端IP',
  `create_user` varchar(50) DEFAULT NULL COMMENT '用户',
  `create_date` datetime DEFAULT NULL COMMENT '时间',
  PRIMARY KEY (`id`),
  KEY `index_create_date` (`create_date`),
  KEY `index_create_index` (`create_user`),
  KEY `index_url` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=5558 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_log
-- ----------------------------
INSERT INTO `admin_log` VALUES ('5557', 'admin-log', 'delete', 'admin-log/delete', '日志管理', '操作日志', '操作', '无法获取ip', 'admin', '2018-06-19 11:54:07');

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(50) NOT NULL COMMENT 'code',
  `menu_name` varchar(200) NOT NULL COMMENT '名称',
  `module_id` int(11) NOT NULL COMMENT '模块id',
  `display_label` varchar(200) DEFAULT NULL COMMENT '显示名',
  `des` varchar(400) DEFAULT NULL COMMENT '描述',
  `display_order` int(5) DEFAULT NULL COMMENT '显示顺序',
  `entry_right_name` varchar(50) DEFAULT NULL COMMENT '入口地址名称',
  `entry_url` varchar(200) NOT NULL COMMENT '入口地址',
  `action` varchar(50) NOT NULL COMMENT '操作ID',
  `controller` varchar(100) NOT NULL COMMENT '控制器ID',
  `has_lef` varchar(1) NOT NULL DEFAULT 'n' COMMENT '是否有子',
  `create_user` varchar(50) DEFAULT NULL COMMENT '创建人',
  `create_date` datetime DEFAULT NULL COMMENT '创建时间',
  `update_user` varchar(50) DEFAULT NULL COMMENT '修改人',
  `update_date` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_code` (`code`),
  KEY `fk_module_id` (`module_id`),
  CONSTRAINT `fk_module_id` FOREIGN KEY (`module_id`) REFERENCES `admin_module` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES ('1', 'menu_manger', '菜单管理', '1', '菜单管理', '菜单管理', '1', '菜单管理', 'admin-module/index', 'index', 'backend\\controllers\\AdminMenuController', 'n', 'admin', '2016-08-11 16:44:11', 'admin', '2018-05-20 09:32:26');
INSERT INTO `admin_menu` VALUES ('2', 'menu_role', '角色管理', '1', '角色管理', '角色管理', '2', '角色管理', 'admin-role/index', 'index', 'backend\\controllers\\AdminRoleController', 'n', 'admin', '2016-08-11 16:51:56', 'admin', '2016-08-11 16:51:56');
INSERT INTO `admin_menu` VALUES ('3', 'menu_user', '用户管理', '1', '用户管理', '用户管理', '3', '用户管理', 'admin-user/index', 'index', 'backend\\controllers\\AdminUserController', 'n', 'admin', '2016-08-11 16:58:43', 'admin', '2016-08-11 16:58:43');
INSERT INTO `admin_menu` VALUES ('4', 'coazaorizhi', '操作日志', '2', '操作日志', '操作日志', '1', '', 'admin-log/index', 'index', 'backend\\controllers\\AdminLogController', 'n', 'test', '2016-08-14 06:54:17', 'test', '2016-08-14 06:54:17');
INSERT INTO `admin_menu` VALUES ('8', 'web_message_list', '留言列表', '7', '留言列表', '客户留言列表', '1', '留言列表', 'web-message/index', 'index', 'backend\\controllers\\WebMessageController', 'n', 'test', '2018-05-13 10:13:38', 'test', '2018-05-13 10:13:38');
INSERT INTO `admin_menu` VALUES ('9', 'web_nav_list', '导航列表', '8', '导航列表', '前台导航列表', '1', '导航列表', 'web-nav/index', 'index', 'backend\\controllers\\WebNavController', 'n', 'admin', '2018-05-14 03:48:36', 'admin', '2018-05-14 13:11:04');
INSERT INTO `admin_menu` VALUES ('12', 'web_user_list', '会员列表', '10', '会员列表', '会员列表', '1', '会员列表', 'web-user/index', 'index', 'backend\\controllers\\WebUserController', 'n', 'admin', '2018-05-20 08:39:20', 'admin', '2018-05-20 08:39:20');
INSERT INTO `admin_menu` VALUES ('13', 'goods_category', '商品分类', '12', '商品分类', '商品分类', '1', '商品分类', 'goods-category/index', 'index', 'backend\\controllers\\GoodsCategoryController', 'n', 'admin', '2018-06-16 13:24:21', 'admin', '2018-06-16 13:24:21');
INSERT INTO `admin_menu` VALUES ('14', 'goods_brand', '品牌管理', '12', '品牌管理', '品牌管理', '2', '品牌管理', 'goods-brand/index', 'index', 'backend\\controllers\\GoodsBrandController', 'n', 'admin', '2018-06-16 13:37:48', 'admin', '2018-06-16 13:37:48');
INSERT INTO `admin_menu` VALUES ('15', 'goods_list', '商品列表', '12', '商品列表', '商品列表', '3', '商品列表', 'goods/index', 'index', 'backend\\controllers\\GoodsController', 'n', 'admin', '2018-06-16 13:38:30', 'admin', '2018-06-16 13:38:30');

-- ----------------------------
-- Table structure for admin_message
-- ----------------------------
DROP TABLE IF EXISTS `admin_message`;
CREATE TABLE `admin_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `msg` varchar(1000) DEFAULT NULL COMMENT '留言内容',
  `expiry_days` int(5) unsigned DEFAULT NULL COMMENT '有效天数',
  `create_user` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_user` varchar(50) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_message
-- ----------------------------
INSERT INTO `admin_message` VALUES ('1', '测试文本', '1', 'admin', '2014-11-21 18:47:20', 'admin', '2014-11-21 18:47:27');

-- ----------------------------
-- Table structure for admin_module
-- ----------------------------
DROP TABLE IF EXISTS `admin_module`;
CREATE TABLE `admin_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(50) NOT NULL COMMENT 'code',
  `display_label` varchar(200) NOT NULL COMMENT '显示名称',
  `has_lef` varchar(1) NOT NULL DEFAULT 'n' COMMENT '是否有子',
  `des` varchar(400) DEFAULT NULL COMMENT '描述',
  `entry_url` varchar(100) DEFAULT NULL COMMENT '入口地址',
  `display_order` int(5) DEFAULT NULL COMMENT '顺序',
  `create_user` varchar(50) DEFAULT NULL COMMENT '创建人',
  `create_date` datetime DEFAULT NULL COMMENT '创建时间',
  `update_user` varchar(50) DEFAULT NULL COMMENT '修改人',
  `update_date` datetime DEFAULT NULL COMMENT '修改时间',
  `meun_icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_module
-- ----------------------------
INSERT INTO `admin_module` VALUES ('1', 'menu_manage', '组织管理', 'n', '菜单管理', '', '1', 'admin', '2016-08-11 15:26:21', 'admin', '2018-05-20 08:41:49', 'fa-sitemap');
INSERT INTO `admin_module` VALUES ('2', 'rizhimaanage', '日志管理', 'n', '日志管理', '', '6', 'test', '2016-08-14 06:53:13', 'admin', '2018-05-14 04:34:11', 'fa-list-alt');
INSERT INTO `admin_module` VALUES ('7', 'web_message', '留言管理', 'n', '客户留言', null, '2', 'test', '2018-05-13 10:12:38', 'test', '2018-05-13 10:12:38', 'fa-envelope');
INSERT INTO `admin_module` VALUES ('8', 'web_nav', '服务管理', 'n', '前台导航服务管理', null, '4', 'admin', '2018-05-14 03:47:37', 'admin', '2018-05-14 04:50:19', 'fa-tasks');
INSERT INTO `admin_module` VALUES ('10', 'web_user', '会员管理', 'n', '会员管理', null, '5', 'admin', '2018-05-20 08:38:28', 'admin', '2018-05-21 03:33:12', 'fa-users');
INSERT INTO `admin_module` VALUES ('11', 'statistics_mange', '统计管理', 'n', '', null, '6', 'test', '2018-05-25 10:22:37', 'test', '2018-05-25 10:22:37', 'fa-bar-chart');
INSERT INTO `admin_module` VALUES ('12', 'goods_manage', '商品管理', 'n', '商品管理', null, '3', 'test', '2018-06-16 13:16:37', 'test', '2018-06-16 13:16:37', 'fa-briefcase');

-- ----------------------------
-- Table structure for admin_right
-- ----------------------------
DROP TABLE IF EXISTS `admin_right`;
CREATE TABLE `admin_right` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `menu_id` int(11) NOT NULL COMMENT '功能主键',
  `right_name` varchar(200) NOT NULL COMMENT '名称',
  `display_label` varchar(200) DEFAULT NULL COMMENT '显示名',
  `des` varchar(200) DEFAULT NULL COMMENT '描述',
  `display_order` int(5) DEFAULT NULL COMMENT '显示顺序',
  `has_lef` varchar(1) NOT NULL DEFAULT 'n' COMMENT '是否有子',
  `create_user` varchar(50) DEFAULT NULL COMMENT '创建人',
  `create_date` datetime DEFAULT NULL COMMENT '创建时间',
  `update_user` varchar(50) DEFAULT NULL COMMENT '修改人',
  `update_date` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `FK_admin_right` (`menu_id`),
  KEY `index_menu_id` (`menu_id`),
  CONSTRAINT `FK_admin_right` FOREIGN KEY (`menu_id`) REFERENCES `admin_menu` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_right
-- ----------------------------
INSERT INTO `admin_right` VALUES ('4', '2', '角色操作', '角色操作', '角色操作', '1', 'n', 'admin', '2016-08-13 17:04:40', 'test', '2018-05-17 17:12:35');
INSERT INTO `admin_right` VALUES ('5', '2', '分配用户', '分配用户', '分配用户', '2', 'n', 'admin', '2016-08-13 17:05:04', 'test', '2018-05-19 08:33:30');
INSERT INTO `admin_right` VALUES ('6', '2', '分配权限', '分配权限', '分配权限', '3', 'n', 'admin', '2016-08-13 17:05:24', 'admin', '2016-08-13 17:05:24');
INSERT INTO `admin_right` VALUES ('7', '3', '用户操作', '用户操作', '用户操作', '1', 'n', 'admin', '2016-08-13 17:05:57', 'test', '2018-06-06 17:53:01');
INSERT INTO `admin_right` VALUES ('8', '4', '操作', '操作', '操作', '1', 'n', 'test', '2016-08-14 06:54:38', 'admin', '2018-05-17 05:45:11');
INSERT INTO `admin_right` VALUES ('13', '1', '一级菜单查看', '一级菜单查看', '一级菜单查看', '1', 'n', 'test', '2016-08-16 15:52:45', 'admin', '2018-05-20 03:31:17');
INSERT INTO `admin_right` VALUES ('14', '1', '一级菜单添加', '一级菜单添加', '一级菜单添加', '2', 'n', 'test', '2016-08-16 15:53:10', 'test', '2016-08-16 15:58:30');
INSERT INTO `admin_right` VALUES ('15', '1', '一级菜单删除', '一级菜单删除', '一级菜单删除', '3', 'n', 'test', '2016-08-16 15:53:44', 'test', '2016-08-16 15:53:44');
INSERT INTO `admin_right` VALUES ('16', '1', '二级菜单查看', '二级菜单查看', '二级菜单查看', '4', 'n', 'test', '2016-08-16 15:55:02', 'admin', '2018-05-20 03:31:27');
INSERT INTO `admin_right` VALUES ('17', '1', '二级菜单添加', '二级菜单修改', '二级菜单添加', '5', 'n', 'test', '2016-08-16 15:55:21', 'test', '2016-08-16 15:58:50');
INSERT INTO `admin_right` VALUES ('18', '1', '二级菜单删除', '二级菜单删除', '二级菜单删除', '6', 'n', 'test', '2016-08-16 15:55:58', 'test', '2016-08-16 15:55:58');
INSERT INTO `admin_right` VALUES ('19', '1', '路由查看', '路由查看', '路由查看', '7', 'n', 'test', '2016-08-16 15:56:32', 'admin', '2018-05-20 03:31:45');
INSERT INTO `admin_right` VALUES ('20', '1', '路由添加', '路由添加', '路由添加', '8', 'n', 'test', '2016-08-16 15:57:46', 'test', '2016-08-16 15:57:46');
INSERT INTO `admin_right` VALUES ('21', '1', '路由删除', '路由删除', '路由删除', '9', 'n', 'test', '2016-08-16 15:58:05', 'test', '2016-08-16 15:58:05');
INSERT INTO `admin_right` VALUES ('26', '8', '留言列表', '留言列表', '留言列表URL', '1', 'n', 'test', '2018-05-13 10:14:15', 'test', '2018-05-17 16:21:57');
INSERT INTO `admin_right` VALUES ('27', '9', '导航列表路由', '导航列表路由', '导航列表路由', '1', 'n', 'admin', '2018-05-14 03:50:10', 'admin', '2018-05-17 13:27:25');
INSERT INTO `admin_right` VALUES ('29', '12', '会员信息', '会员信息', '会员信息', '1', 'n', 'admin', '2018-05-20 08:39:50', 'admin', '2018-05-20 10:42:26');
INSERT INTO `admin_right` VALUES ('30', '13', '商品类别查看', '商品类别查看', '商品类别查看', '1', 'n', 'admin', '2018-06-16 13:36:33', 'admin', '2018-06-17 03:37:25');
INSERT INTO `admin_right` VALUES ('31', '14', '品牌查看', '品牌查看', '品牌查看', '1', 'n', 'admin', '2018-06-16 13:39:10', 'admin', '2018-06-17 04:59:04');
INSERT INTO `admin_right` VALUES ('32', '15', '商品列表页面', '列表查看', '商品列表页面', '1', 'n', 'admin', '2018-06-16 13:39:57', 'admin', '2018-06-17 10:25:10');
INSERT INTO `admin_right` VALUES ('33', '14', '品牌新增', '品牌新增', '品牌新增', '2', 'n', 'admin', '2018-06-17 04:59:30', 'admin', '2018-06-17 04:59:30');
INSERT INTO `admin_right` VALUES ('34', '14', '图片上传', '图片上传', 'logo上传', '3', 'n', 'admin', '2018-06-17 05:01:24', 'admin', '2018-06-17 09:09:02');
INSERT INTO `admin_right` VALUES ('35', '14', '品牌修改', '品牌修改', '品牌修改', '4', 'n', 'admin', '2018-06-17 08:57:32', 'admin', '2018-06-17 08:57:32');
INSERT INTO `admin_right` VALUES ('36', '14', '品牌删除', '品牌删除', '品牌删除', '5', 'n', 'admin', '2018-06-17 09:02:45', 'admin', '2018-06-17 09:03:01');
INSERT INTO `admin_right` VALUES ('37', '15', '商品列表', '商品列表', '商品列表', '2', 'n', 'admin', '2018-06-17 10:23:31', 'admin', '2018-06-17 10:25:18');
INSERT INTO `admin_right` VALUES ('38', '15', '获取分类', '获取分类', '获取分类', '3', 'n', 'admin', '2018-06-18 04:21:33', 'admin', '2018-06-18 06:07:04');
INSERT INTO `admin_right` VALUES ('39', '15', '新增商品', '新增商品', null, '4', 'n', 'admin', '2018-06-18 07:00:35', 'admin', '2018-06-18 07:00:35');
INSERT INTO `admin_right` VALUES ('40', '13', '获取分类品牌', '获取分类品牌', '获取分类品牌', '2', 'n', 'admin', '2018-06-18 08:44:20', 'admin', '2018-06-18 08:44:20');
INSERT INTO `admin_right` VALUES ('41', '13', '分类新增', '分类新增', '分类新增', '3', 'n', 'admin', '2018-06-19 04:51:22', 'admin', '2018-06-19 04:51:22');
INSERT INTO `admin_right` VALUES ('42', '13', '分类修改', '分类修改', '分类修改', '4', 'n', 'admin', '2018-06-19 04:51:47', 'admin', '2018-06-19 04:51:47');
INSERT INTO `admin_right` VALUES ('43', '13', '分类删除', '分类删除', '分类删除', '5', 'n', 'admin', '2018-06-19 04:52:08', 'admin', '2018-06-19 04:52:08');
INSERT INTO `admin_right` VALUES ('44', '13', '品牌插件', '品牌插件', '品牌插件', '6', 'n', 'admin', '2018-06-19 11:18:07', 'admin', '2018-06-19 11:20:59');
INSERT INTO `admin_right` VALUES ('45', '13', '新增品牌', '新增品牌', null, '7', 'n', 'admin', '2018-06-19 11:21:31', 'admin', '2018-06-19 11:21:31');
INSERT INTO `admin_right` VALUES ('46', '13', '删除品牌', '删除品牌', '删除品牌', '8', 'n', 'admin', '2018-06-19 11:22:00', 'admin', '2018-06-19 11:22:00');

-- ----------------------------
-- Table structure for admin_right_url
-- ----------------------------
DROP TABLE IF EXISTS `admin_right_url`;
CREATE TABLE `admin_right_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `right_id` int(11) NOT NULL COMMENT 'right主键',
  `url` varchar(200) DEFAULT NULL COMMENT 'url',
  `para_name` varchar(40) DEFAULT NULL COMMENT '参数名',
  `para_value` varchar(40) DEFAULT NULL COMMENT '参数值',
  `create_user` varchar(50) DEFAULT NULL COMMENT '创建人',
  `create_date` datetime DEFAULT NULL COMMENT '创建时间',
  `update_user` varchar(50) DEFAULT NULL COMMENT '修改人',
  `update_date` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `FK_admin_right_url` (`right_id`),
  KEY `index_right_id` (`right_id`),
  CONSTRAINT `FK_admin_right_url` FOREIGN KEY (`right_id`) REFERENCES `admin_right` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=289 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_right_url
-- ----------------------------
INSERT INTO `admin_right_url` VALUES ('30', '6', 'admin-role/index', 'admin-role', 'index', 'admin', '2016-08-13 17:05:24', 'admin', '2016-08-13 17:05:24');
INSERT INTO `admin_right_url` VALUES ('31', '6', 'admin-role/view', 'admin-role', 'view', 'admin', '2016-08-13 17:05:24', 'admin', '2016-08-13 17:05:24');
INSERT INTO `admin_right_url` VALUES ('32', '6', 'admin-role/create', 'admin-role', 'create', 'admin', '2016-08-13 17:05:24', 'admin', '2016-08-13 17:05:24');
INSERT INTO `admin_right_url` VALUES ('33', '6', 'admin-role/update', 'admin-role', 'update', 'admin', '2016-08-13 17:05:24', 'admin', '2016-08-13 17:05:24');
INSERT INTO `admin_right_url` VALUES ('34', '6', 'admin-role/delete', 'admin-role', 'delete', 'admin', '2016-08-13 17:05:24', 'admin', '2016-08-13 17:05:24');
INSERT INTO `admin_right_url` VALUES ('35', '6', 'admin-role/get-all-rights', 'admin-role', 'get-all-rights', 'admin', '2016-08-13 17:05:24', 'admin', '2016-08-13 17:05:24');
INSERT INTO `admin_right_url` VALUES ('36', '6', 'admin-role/save-rights', 'admin-role', 'save-rights', 'admin', '2016-08-13 17:05:24', 'admin', '2016-08-13 17:05:24');
INSERT INTO `admin_right_url` VALUES ('115', '15', 'admin-module/delete', 'admin-module', 'delete', 'test', '2016-08-16 15:53:44', 'test', '2016-08-16 15:53:44');
INSERT INTO `admin_right_url` VALUES ('122', '18', 'admin-menu/delete', 'admin-menu', 'delete', 'test', '2016-08-16 15:55:58', 'test', '2016-08-16 15:55:58');
INSERT INTO `admin_right_url` VALUES ('128', '20', 'admin-right/create', 'admin-right', 'create', 'test', '2016-08-16 15:57:46', 'test', '2016-08-16 15:57:46');
INSERT INTO `admin_right_url` VALUES ('129', '20', 'admin-right/update', 'admin-right', 'update', 'test', '2016-08-16 15:57:46', 'test', '2016-08-16 15:57:46');
INSERT INTO `admin_right_url` VALUES ('130', '21', 'admin-right/delete', 'admin-right', 'delete', 'test', '2016-08-16 15:58:05', 'test', '2016-08-16 15:58:05');
INSERT INTO `admin_right_url` VALUES ('131', '14', 'admin-module/create', 'admin-module', 'create', 'test', '2016-08-16 15:58:30', 'test', '2016-08-16 15:58:30');
INSERT INTO `admin_right_url` VALUES ('132', '14', 'admin-module/update', 'admin-module', 'update', 'test', '2016-08-16 15:58:30', 'test', '2016-08-16 15:58:30');
INSERT INTO `admin_right_url` VALUES ('133', '17', 'admin-menu/create', 'admin-menu', 'create', 'test', '2016-08-16 15:58:51', 'test', '2016-08-16 15:58:51');
INSERT INTO `admin_right_url` VALUES ('134', '17', 'admin-menu/update', 'admin-menu', 'update', 'test', '2016-08-16 15:58:51', 'test', '2016-08-16 15:58:51');
INSERT INTO `admin_right_url` VALUES ('160', '8', 'admin-log/index', 'admin-log', 'index', 'admin', '2018-05-17 05:45:11', 'admin', '2018-05-17 05:45:11');
INSERT INTO `admin_right_url` VALUES ('161', '8', 'admin-log/table', 'admin-log', 'table', 'admin', '2018-05-17 05:45:11', 'admin', '2018-05-17 05:45:11');
INSERT INTO `admin_right_url` VALUES ('162', '8', 'admin-log/view', 'admin-log', 'view', 'admin', '2018-05-17 05:45:11', 'admin', '2018-05-17 05:45:11');
INSERT INTO `admin_right_url` VALUES ('163', '8', 'admin-log/create', 'admin-log', 'create', 'admin', '2018-05-17 05:45:11', 'admin', '2018-05-17 05:45:11');
INSERT INTO `admin_right_url` VALUES ('164', '8', 'admin-log/update', 'admin-log', 'update', 'admin', '2018-05-17 05:45:11', 'admin', '2018-05-17 05:45:11');
INSERT INTO `admin_right_url` VALUES ('165', '8', 'admin-log/delete', 'admin-log', 'delete', 'admin', '2018-05-17 05:45:11', 'admin', '2018-05-17 05:45:11');
INSERT INTO `admin_right_url` VALUES ('166', '27', 'web-nav/index', 'web-nav', 'index', 'admin', '2018-05-17 13:27:25', 'admin', '2018-05-17 13:27:25');
INSERT INTO `admin_right_url` VALUES ('167', '27', 'web-nav/table', 'web-nav', 'table', 'admin', '2018-05-17 13:27:25', 'admin', '2018-05-17 13:27:25');
INSERT INTO `admin_right_url` VALUES ('168', '27', 'web-nav/view', 'web-nav', 'view', 'admin', '2018-05-17 13:27:25', 'admin', '2018-05-17 13:27:25');
INSERT INTO `admin_right_url` VALUES ('169', '27', 'web-nav/create', 'web-nav', 'create', 'admin', '2018-05-17 13:27:25', 'admin', '2018-05-17 13:27:25');
INSERT INTO `admin_right_url` VALUES ('170', '27', 'web-nav/update', 'web-nav', 'update', 'admin', '2018-05-17 13:27:25', 'admin', '2018-05-17 13:27:25');
INSERT INTO `admin_right_url` VALUES ('171', '27', 'web-nav/delete', 'web-nav', 'delete', 'admin', '2018-05-17 13:27:25', 'admin', '2018-05-17 13:27:25');
INSERT INTO `admin_right_url` VALUES ('172', '26', 'web-message/index', 'web-message', 'index', 'test', '2018-05-17 16:21:58', 'test', '2018-05-17 16:21:58');
INSERT INTO `admin_right_url` VALUES ('173', '26', 'web-message/table', 'web-message', 'table', 'test', '2018-05-17 16:21:58', 'test', '2018-05-17 16:21:58');
INSERT INTO `admin_right_url` VALUES ('174', '26', 'web-message/view', 'web-message', 'view', 'test', '2018-05-17 16:21:58', 'test', '2018-05-17 16:21:58');
INSERT INTO `admin_right_url` VALUES ('175', '26', 'web-message/delete', 'web-message', 'delete', 'test', '2018-05-17 16:21:58', 'test', '2018-05-17 16:21:58');
INSERT INTO `admin_right_url` VALUES ('182', '4', 'admin-role/index', 'admin-role', 'index', 'test', '2018-05-17 17:12:35', 'test', '2018-05-17 17:12:35');
INSERT INTO `admin_right_url` VALUES ('183', '4', 'admin-role/table', 'admin-role', 'table', 'test', '2018-05-17 17:12:35', 'test', '2018-05-17 17:12:35');
INSERT INTO `admin_right_url` VALUES ('184', '4', 'admin-role/view', 'admin-role', 'view', 'test', '2018-05-17 17:12:35', 'test', '2018-05-17 17:12:35');
INSERT INTO `admin_right_url` VALUES ('185', '4', 'admin-role/create', 'admin-role', 'create', 'test', '2018-05-17 17:12:35', 'test', '2018-05-17 17:12:35');
INSERT INTO `admin_right_url` VALUES ('186', '4', 'admin-role/update', 'admin-role', 'update', 'test', '2018-05-17 17:12:35', 'test', '2018-05-17 17:12:35');
INSERT INTO `admin_right_url` VALUES ('187', '4', 'admin-role/delete', 'admin-role', 'delete', 'test', '2018-05-17 17:12:35', 'test', '2018-05-17 17:12:35');
INSERT INTO `admin_right_url` VALUES ('188', '4', 'admin-role/get-all-rights', 'admin-role', 'get-all-rights', 'test', '2018-05-17 17:12:35', 'test', '2018-05-17 17:12:35');
INSERT INTO `admin_right_url` VALUES ('189', '4', 'admin-role/save-rights', 'admin-role', 'save-rights', 'test', '2018-05-17 17:12:35', 'test', '2018-05-17 17:12:35');
INSERT INTO `admin_right_url` VALUES ('190', '5', 'admin-user-role/index', 'admin-user-role', 'index', 'test', '2018-05-19 08:33:31', 'test', '2018-05-19 08:33:31');
INSERT INTO `admin_right_url` VALUES ('191', '5', 'admin-user-role/table', 'admin-user-role', 'table', 'test', '2018-05-19 08:33:31', 'test', '2018-05-19 08:33:31');
INSERT INTO `admin_right_url` VALUES ('192', '5', 'admin-user-role/view', 'admin-user-role', 'view', 'test', '2018-05-19 08:33:31', 'test', '2018-05-19 08:33:31');
INSERT INTO `admin_right_url` VALUES ('193', '5', 'admin-user-role/create', 'admin-user-role', 'create', 'test', '2018-05-19 08:33:31', 'test', '2018-05-19 08:33:31');
INSERT INTO `admin_right_url` VALUES ('194', '5', 'admin-user-role/update', 'admin-user-role', 'update', 'test', '2018-05-19 08:33:31', 'test', '2018-05-19 08:33:31');
INSERT INTO `admin_right_url` VALUES ('195', '5', 'admin-user-role/delete', 'admin-user-role', 'delete', 'test', '2018-05-19 08:33:31', 'test', '2018-05-19 08:33:31');
INSERT INTO `admin_right_url` VALUES ('196', '13', 'admin-module/index', 'admin-module', 'index', 'admin', '2018-05-20 03:31:17', 'admin', '2018-05-20 03:31:17');
INSERT INTO `admin_right_url` VALUES ('197', '13', 'admin-module/table', 'admin-module', 'table', 'admin', '2018-05-20 03:31:17', 'admin', '2018-05-20 03:31:17');
INSERT INTO `admin_right_url` VALUES ('198', '13', 'admin-module/view', 'admin-module', 'view', 'admin', '2018-05-20 03:31:17', 'admin', '2018-05-20 03:31:17');
INSERT INTO `admin_right_url` VALUES ('199', '16', 'admin-menu/index', 'admin-menu', 'index', 'admin', '2018-05-20 03:31:27', 'admin', '2018-05-20 03:31:27');
INSERT INTO `admin_right_url` VALUES ('200', '16', 'admin-menu/view', 'admin-menu', 'view', 'admin', '2018-05-20 03:31:27', 'admin', '2018-05-20 03:31:27');
INSERT INTO `admin_right_url` VALUES ('201', '16', 'admin-menu/table', 'admin-menu', 'table', 'admin', '2018-05-20 03:31:27', 'admin', '2018-05-20 03:31:27');
INSERT INTO `admin_right_url` VALUES ('202', '19', 'admin-right/index', 'admin-right', 'index', 'admin', '2018-05-20 03:31:45', 'admin', '2018-05-20 03:31:45');
INSERT INTO `admin_right_url` VALUES ('203', '19', 'admin-right/view', 'admin-right', 'view', 'admin', '2018-05-20 03:31:45', 'admin', '2018-05-20 03:31:45');
INSERT INTO `admin_right_url` VALUES ('204', '19', 'admin-right/table', 'admin-right', 'table', 'admin', '2018-05-20 03:31:45', 'admin', '2018-05-20 03:31:45');
INSERT INTO `admin_right_url` VALUES ('205', '19', 'admin-right/right-action', 'admin-right', 'right-action', 'admin', '2018-05-20 03:31:45', 'admin', '2018-05-20 03:31:45');
INSERT INTO `admin_right_url` VALUES ('235', '29', 'web-user/index', 'web-user', 'index', 'admin', '2018-05-20 10:42:26', 'admin', '2018-05-20 10:42:26');
INSERT INTO `admin_right_url` VALUES ('236', '29', 'web-user/table', 'web-user', 'table', 'admin', '2018-05-20 10:42:26', 'admin', '2018-05-20 10:42:26');
INSERT INTO `admin_right_url` VALUES ('237', '29', 'web-user/update', 'web-user', 'update', 'admin', '2018-05-20 10:42:26', 'admin', '2018-05-20 10:42:26');
INSERT INTO `admin_right_url` VALUES ('238', '29', 'web-user/delete', 'web-user', 'delete', 'admin', '2018-05-20 10:42:26', 'admin', '2018-05-20 10:42:26');
INSERT INTO `admin_right_url` VALUES ('253', '7', 'admin-user/upload', 'admin-user', 'upload', 'test', '2018-06-06 17:53:01', 'test', '2018-06-06 17:53:01');
INSERT INTO `admin_right_url` VALUES ('254', '7', 'admin-user/index', 'admin-user', 'index', 'test', '2018-06-06 17:53:01', 'test', '2018-06-06 17:53:01');
INSERT INTO `admin_right_url` VALUES ('255', '7', 'admin-user/table', 'admin-user', 'table', 'test', '2018-06-06 17:53:01', 'test', '2018-06-06 17:53:01');
INSERT INTO `admin_right_url` VALUES ('256', '7', 'admin-user/view', 'admin-user', 'view', 'test', '2018-06-06 17:53:01', 'test', '2018-06-06 17:53:01');
INSERT INTO `admin_right_url` VALUES ('257', '7', 'admin-user/create', 'admin-user', 'create', 'test', '2018-06-06 17:53:01', 'test', '2018-06-06 17:53:01');
INSERT INTO `admin_right_url` VALUES ('258', '7', 'admin-user/update', 'admin-user', 'update', 'test', '2018-06-06 17:53:01', 'test', '2018-06-06 17:53:01');
INSERT INTO `admin_right_url` VALUES ('259', '7', 'admin-user/delete', 'admin-user', 'delete', 'test', '2018-06-06 17:53:01', 'test', '2018-06-06 17:53:01');
INSERT INTO `admin_right_url` VALUES ('263', '30', 'goods-category/index', 'goods-category', 'index', 'admin', '2018-06-17 03:37:25', 'admin', '2018-06-17 03:37:25');
INSERT INTO `admin_right_url` VALUES ('264', '30', 'goods-category/tree', 'goods-category', 'tree', 'admin', '2018-06-17 03:37:25', 'admin', '2018-06-17 03:37:25');
INSERT INTO `admin_right_url` VALUES ('265', '31', 'goods-brand/index', 'goods-brand', 'index', 'admin', '2018-06-17 04:59:04', 'admin', '2018-06-17 04:59:04');
INSERT INTO `admin_right_url` VALUES ('266', '31', 'goods-brand/table', 'goods-brand', 'table', 'admin', '2018-06-17 04:59:04', 'admin', '2018-06-17 04:59:04');
INSERT INTO `admin_right_url` VALUES ('267', '33', 'goods-brand/create', 'goods-brand', 'create', 'admin', '2018-06-17 04:59:30', 'admin', '2018-06-17 04:59:30');
INSERT INTO `admin_right_url` VALUES ('269', '35', 'goods-brand/update', 'goods-brand', 'update', 'admin', '2018-06-17 08:57:32', 'admin', '2018-06-17 08:57:32');
INSERT INTO `admin_right_url` VALUES ('270', '36', 'goods-brand/delete', 'goods-brand', 'delete', 'admin', '2018-06-17 09:03:01', 'admin', '2018-06-17 09:03:01');
INSERT INTO `admin_right_url` VALUES ('271', '34', 'goods-brand/upload', 'goods-brand', 'upload', 'admin', '2018-06-17 09:09:02', 'admin', '2018-06-17 09:09:02');
INSERT INTO `admin_right_url` VALUES ('274', '32', 'goods/index', 'goods', 'index', 'admin', '2018-06-17 10:25:10', 'admin', '2018-06-17 10:25:10');
INSERT INTO `admin_right_url` VALUES ('275', '37', 'goods/index', 'goods', 'index', 'admin', '2018-06-17 10:25:18', 'admin', '2018-06-17 10:25:18');
INSERT INTO `admin_right_url` VALUES ('276', '37', 'goods/table', 'goods', 'table', 'admin', '2018-06-17 10:25:18', 'admin', '2018-06-17 10:25:18');
INSERT INTO `admin_right_url` VALUES ('278', '38', 'goods/get-category', 'goods', 'get-category', 'admin', '2018-06-18 06:07:04', 'admin', '2018-06-18 06:07:04');
INSERT INTO `admin_right_url` VALUES ('279', '38', 'goods/category-to-brand', 'goods', 'category-to-brand', 'admin', '2018-06-18 06:07:04', 'admin', '2018-06-18 06:07:04');
INSERT INTO `admin_right_url` VALUES ('280', '39', 'goods/create', 'goods', 'create', 'admin', '2018-06-18 07:00:35', 'admin', '2018-06-18 07:00:35');
INSERT INTO `admin_right_url` VALUES ('281', '40', 'goods-category/category-to-brand', 'goods-category', 'category-to-brand', 'admin', '2018-06-18 08:44:20', 'admin', '2018-06-18 08:44:20');
INSERT INTO `admin_right_url` VALUES ('282', '41', 'goods-category/create-category', 'goods-category', 'create-category', 'admin', '2018-06-19 04:51:22', 'admin', '2018-06-19 04:51:22');
INSERT INTO `admin_right_url` VALUES ('283', '42', 'goods-category/update-category', 'goods-category', 'update-category', 'admin', '2018-06-19 04:51:47', 'admin', '2018-06-19 04:51:47');
INSERT INTO `admin_right_url` VALUES ('284', '43', 'goods-category/delete-category', 'goods-category', 'delete-category', 'admin', '2018-06-19 04:52:08', 'admin', '2018-06-19 04:52:08');
INSERT INTO `admin_right_url` VALUES ('286', '44', 'goods-category/category-cbrand', 'goods-category', 'category-cbrand', 'admin', '2018-06-19 11:21:00', 'admin', '2018-06-19 11:21:00');
INSERT INTO `admin_right_url` VALUES ('287', '45', 'goods-category/create-c2b', 'goods-category', 'create-c2b', 'admin', '2018-06-19 11:21:31', 'admin', '2018-06-19 11:21:31');
INSERT INTO `admin_right_url` VALUES ('288', '46', 'goods-category/delete-c2b', 'goods-category', 'delete-c2b', 'admin', '2018-06-19 11:22:01', 'admin', '2018-06-19 11:22:01');

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(50) NOT NULL COMMENT '角色编号',
  `name` varchar(50) NOT NULL COMMENT '角色名称',
  `des` varchar(400) DEFAULT NULL COMMENT '角色描述',
  `create_user` varchar(50) DEFAULT NULL COMMENT '创建人',
  `create_date` datetime DEFAULT NULL COMMENT '创建时间',
  `update_user` varchar(50) DEFAULT NULL COMMENT '更新人',
  `update_date` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_role
-- ----------------------------
INSERT INTO `admin_role` VALUES ('1', 'superadmin', '超级管理员', '拥有所有权限', 'test', '2016-08-12 15:33:01', 'test', '2016-08-12 15:33:01');
INSERT INTO `admin_role` VALUES ('2', 'testuser', '测试人员', '测试人员', 'test', '2016-08-12 15:33:45', 'test', '2016-08-12 15:33:45');

-- ----------------------------
-- Table structure for admin_role_right
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_right`;
CREATE TABLE `admin_role_right` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `role_id` int(11) NOT NULL COMMENT '角色主键',
  `right_id` int(11) NOT NULL COMMENT '权限主键',
  `full_path` varchar(250) DEFAULT NULL COMMENT '全路径',
  `create_user` varchar(50) DEFAULT NULL COMMENT '创建人',
  `create_date` datetime DEFAULT NULL COMMENT '创建时间',
  `update_user` varchar(50) DEFAULT NULL COMMENT '修改人',
  `update_date` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `index_role_id` (`role_id`),
  KEY `index_right_id` (`right_id`),
  CONSTRAINT `admin_role_right_ibfk_1` FOREIGN KEY (`right_id`) REFERENCES `admin_right` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=694 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_role_right
-- ----------------------------
INSERT INTO `admin_role_right` VALUES ('417', '2', '13', null, 'test', '2018-06-13 16:08:04', 'test', '2018-06-13 16:08:04');
INSERT INTO `admin_role_right` VALUES ('418', '2', '14', null, 'test', '2018-06-13 16:08:04', 'test', '2018-06-13 16:08:04');
INSERT INTO `admin_role_right` VALUES ('419', '2', '15', null, 'test', '2018-06-13 16:08:04', 'test', '2018-06-13 16:08:04');
INSERT INTO `admin_role_right` VALUES ('420', '2', '16', null, 'test', '2018-06-13 16:08:04', 'test', '2018-06-13 16:08:04');
INSERT INTO `admin_role_right` VALUES ('421', '2', '17', null, 'test', '2018-06-13 16:08:04', 'test', '2018-06-13 16:08:04');
INSERT INTO `admin_role_right` VALUES ('422', '2', '18', null, 'test', '2018-06-13 16:08:04', 'test', '2018-06-13 16:08:04');
INSERT INTO `admin_role_right` VALUES ('423', '2', '19', null, 'test', '2018-06-13 16:08:04', 'test', '2018-06-13 16:08:04');
INSERT INTO `admin_role_right` VALUES ('424', '2', '20', null, 'test', '2018-06-13 16:08:04', 'test', '2018-06-13 16:08:04');
INSERT INTO `admin_role_right` VALUES ('425', '2', '21', null, 'test', '2018-06-13 16:08:04', 'test', '2018-06-13 16:08:04');
INSERT INTO `admin_role_right` VALUES ('426', '2', '4', null, 'test', '2018-06-13 16:08:04', 'test', '2018-06-13 16:08:04');
INSERT INTO `admin_role_right` VALUES ('427', '2', '5', null, 'test', '2018-06-13 16:08:04', 'test', '2018-06-13 16:08:04');
INSERT INTO `admin_role_right` VALUES ('428', '2', '6', null, 'test', '2018-06-13 16:08:04', 'test', '2018-06-13 16:08:04');
INSERT INTO `admin_role_right` VALUES ('429', '2', '7', null, 'test', '2018-06-13 16:08:04', 'test', '2018-06-13 16:08:04');
INSERT INTO `admin_role_right` VALUES ('430', '2', '8', null, 'test', '2018-06-13 16:08:04', 'test', '2018-06-13 16:08:04');
INSERT INTO `admin_role_right` VALUES ('431', '2', '26', null, 'test', '2018-06-13 16:08:04', 'test', '2018-06-13 16:08:04');
INSERT INTO `admin_role_right` VALUES ('432', '2', '27', null, 'test', '2018-06-13 16:08:04', 'test', '2018-06-13 16:08:04');
INSERT INTO `admin_role_right` VALUES ('433', '2', '29', null, 'test', '2018-06-13 16:08:04', 'test', '2018-06-13 16:08:04');
INSERT INTO `admin_role_right` VALUES ('660', '1', '13', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('661', '1', '14', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('662', '1', '15', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('663', '1', '16', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('664', '1', '17', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('665', '1', '18', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('666', '1', '19', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('667', '1', '20', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('668', '1', '21', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('669', '1', '4', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('670', '1', '5', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('671', '1', '6', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('672', '1', '7', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('673', '1', '8', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('674', '1', '26', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('675', '1', '27', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('676', '1', '29', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('677', '1', '30', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('678', '1', '40', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('679', '1', '41', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('680', '1', '42', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('681', '1', '43', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('682', '1', '44', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('683', '1', '45', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('684', '1', '46', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('685', '1', '31', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('686', '1', '33', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('687', '1', '34', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('688', '1', '35', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('689', '1', '36', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('690', '1', '32', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('691', '1', '37', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('692', '1', '38', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');
INSERT INTO `admin_role_right` VALUES ('693', '1', '39', null, 'admin', '2018-06-19 11:22:30', 'admin', '2018-06-19 11:22:30');

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) NOT NULL COMMENT '用户名',
  `password` varchar(200) NOT NULL COMMENT '密码',
  `auth_key` varchar(50) DEFAULT NULL COMMENT '自动登录key',
  `last_ip` varchar(50) DEFAULT NULL COMMENT '最近一次登录ip',
  `is_online` char(1) DEFAULT 'n' COMMENT '是否在线',
  `domain_account` varchar(100) DEFAULT NULL COMMENT '域账号',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT '状态',
  `create_user` varchar(100) NOT NULL COMMENT '创建人',
  `create_date` datetime NOT NULL COMMENT '创建时间',
  `update_user` varchar(101) NOT NULL COMMENT '更新人',
  `update_date` datetime NOT NULL COMMENT '更新时间',
  `head_img_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('156', 'admin', '$2y$13$9O6bKJieocg//oSax9fZOOuljAKarBXknqD8.RyYg60FfNjS7SoqK', null, '无法获取ip', 'n', null, '10', 'admin', '2014-07-07 00:05:47', 'admin', '2014-09-03 12:19:12', null);
INSERT INTO `admin_user` VALUES ('158', 'test', '$2y$13$IECQQTzV687FOk9D1y1x8uWvWrw9g6b9yQjEPm5ZFcFWZW0CJbrQ2', null, '无法获取ip', 'n', null, '10', 'admin', '2014-09-03 12:19:52', 'admin', '2014-11-21 19:19:22', null);
INSERT INTO `admin_user` VALUES ('159', 'test001', '$2y$13$G6v7vHPff10aEuiG909C4eVtESvDacEeeYg9Y9WzPS93QV.1nGPk2', null, 'Unknown', 'n', '', '10', 'test', '2018-05-13 06:06:27', 'test', '2018-05-13 06:06:27', null);

-- ----------------------------
-- Table structure for admin_user_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_role`;
CREATE TABLE `admin_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` bigint(20) unsigned NOT NULL COMMENT '用户id',
  `role_id` int(11) NOT NULL COMMENT '角色',
  `create_user` varchar(50) DEFAULT NULL COMMENT '创建人',
  `create_date` datetime DEFAULT NULL COMMENT '创建时间',
  `update_user` varchar(50) DEFAULT NULL COMMENT '修改人',
  `update_date` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `index_user_id` (`user_id`),
  KEY `index_role_id` (`role_id`),
  CONSTRAINT `admin_user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `admin_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `admin_user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `admin_role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin_user_role
-- ----------------------------
INSERT INTO `admin_user_role` VALUES ('1', '156', '1', 'admin', '2016-08-12 17:03:13', 'admin', '2016-08-12 17:03:13');
INSERT INTO `admin_user_role` VALUES ('3', '158', '2', 'test', '2018-05-13 06:10:19', 'test', '2018-06-05 14:44:01');
INSERT INTO `admin_user_role` VALUES ('4', '159', '2', 'test', '2018-06-05 14:44:26', 'test', '2018-06-05 14:44:26');

-- ----------------------------
-- Table structure for shp_category2brand
-- ----------------------------
DROP TABLE IF EXISTS `shp_category2brand`;
CREATE TABLE `shp_category2brand` (
  `category2brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`category2brand_id`),
  KEY `SHP_R_11` (`category_id`),
  KEY `SHP_R_12` (`brand_id`),
  CONSTRAINT `SHP_R_11` FOREIGN KEY (`category_id`) REFERENCES `shp_goods_category` (`category_id`),
  CONSTRAINT `SHP_R_12` FOREIGN KEY (`brand_id`) REFERENCES `shp_goods_brand` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shp_category2brand
-- ----------------------------
INSERT INTO `shp_category2brand` VALUES ('1', '2', '1001');
INSERT INTO `shp_category2brand` VALUES ('2', '3', '1101');

-- ----------------------------
-- Table structure for shp_color
-- ----------------------------
DROP TABLE IF EXISTS `shp_color`;
CREATE TABLE `shp_color` (
  `color_id` int(11) NOT NULL AUTO_INCREMENT,
  `color_name` varchar(20) NOT NULL,
  `is_used` int(11) DEFAULT NULL,
  `color_value` varchar(20) NOT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shp_color
-- ----------------------------
INSERT INTO `shp_color` VALUES ('1', '红色', '1', 'red');
INSERT INTO `shp_color` VALUES ('2', '蓝色', '1', 'blue');

-- ----------------------------
-- Table structure for shp_goods
-- ----------------------------
DROP TABLE IF EXISTS `shp_goods`;
CREATE TABLE `shp_goods` (
  `goods_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `goods_name` varchar(64) NOT NULL,
  `is_used` int(11) NOT NULL,
  `goods_price` decimal(10,2) DEFAULT NULL,
  `goods_color_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`goods_id`),
  KEY `SHP_R_13` (`category_id`),
  KEY `SHP_R_14` (`brand_id`),
  KEY `SHP_R_15` (`goods_color_id`),
  CONSTRAINT `SHP_R_13` FOREIGN KEY (`category_id`) REFERENCES `shp_goods_category` (`category_id`),
  CONSTRAINT `SHP_R_14` FOREIGN KEY (`brand_id`) REFERENCES `shp_goods_brand` (`brand_id`),
  CONSTRAINT `SHP_R_15` FOREIGN KEY (`goods_color_id`) REFERENCES `shp_color` (`color_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shp_goods
-- ----------------------------
INSERT INTO `shp_goods` VALUES ('1', '3', '赛琪短袖', '1', '1000.00', null, '1001');
INSERT INTO `shp_goods` VALUES ('2', '3', '阿迪达斯裤子', '1', '500.00', null, '1101');

-- ----------------------------
-- Table structure for shp_goods2color
-- ----------------------------
DROP TABLE IF EXISTS `shp_goods2color`;
CREATE TABLE `shp_goods2color` (
  `goods_id` int(11) NOT NULL AUTO_INCREMENT,
  `goods2color_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  PRIMARY KEY (`goods2color_id`),
  KEY `SHP_R_26` (`goods_id`),
  KEY `SHP_R_27` (`color_id`),
  CONSTRAINT `SHP_R_26` FOREIGN KEY (`goods_id`) REFERENCES `shp_goods` (`goods_id`),
  CONSTRAINT `SHP_R_27` FOREIGN KEY (`color_id`) REFERENCES `shp_color` (`color_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shp_goods2color
-- ----------------------------

-- ----------------------------
-- Table structure for shp_goodsextend
-- ----------------------------
DROP TABLE IF EXISTS `shp_goodsextend`;
CREATE TABLE `shp_goodsextend` (
  `goods_extend_id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_stock_num` int(11) DEFAULT NULL,
  `goods_sales_num` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  PRIMARY KEY (`goods_extend_id`),
  KEY `SHP_R_18` (`goods_id`),
  KEY `SHP_R_28` (`color_id`),
  CONSTRAINT `SHP_R_18` FOREIGN KEY (`goods_id`) REFERENCES `shp_goods` (`goods_id`),
  CONSTRAINT `SHP_R_28` FOREIGN KEY (`color_id`) REFERENCES `shp_color` (`color_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shp_goodsextend
-- ----------------------------

-- ----------------------------
-- Table structure for shp_goods_brand
-- ----------------------------
DROP TABLE IF EXISTS `shp_goods_brand`;
CREATE TABLE `shp_goods_brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(20) NOT NULL,
  `brand_icon` varchar(255) DEFAULT NULL,
  `is_used` int(11) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shp_goods_brand
-- ----------------------------
INSERT INTO `shp_goods_brand` VALUES ('2', '阿迪达斯', '/SHP/backend/web/uploadimg/20180618/1529293901125523.jpg', '1');
INSERT INTO `shp_goods_brand` VALUES ('3', '赛琪', '/SHP/backend/web/uploadimg/20180618/1529293883102759.png', '1');

-- ----------------------------
-- Table structure for shp_goods_category
-- ----------------------------
DROP TABLE IF EXISTS `shp_goods_category`;
CREATE TABLE `shp_goods_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_p_id` int(11) DEFAULT NULL,
  `category_name` varchar(20) NOT NULL,
  `is_used` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1116 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shp_goods_category
-- ----------------------------
INSERT INTO `shp_goods_category` VALUES ('1', null, '商品分类', '0');
INSERT INTO `shp_goods_category` VALUES ('10', '1', '女装 /内衣', '1');
INSERT INTO `shp_goods_category` VALUES ('11', '1', '男装 /运动户外', '1');
INSERT INTO `shp_goods_category` VALUES ('1001', '10', '女装', '1');
INSERT INTO `shp_goods_category` VALUES ('1101', '11', '男装', '1');
INSERT INTO `shp_goods_category` VALUES ('1102', '1', '童装/室内', '1');
INSERT INTO `shp_goods_category` VALUES ('1104', '1102', '外套/披风', '1');

-- ----------------------------
-- Table structure for shp_goods_pic
-- ----------------------------
DROP TABLE IF EXISTS `shp_goods_pic`;
CREATE TABLE `shp_goods_pic` (
  `goods_pic_id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_pic_url` varchar(255) NOT NULL,
  `is_used` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  PRIMARY KEY (`goods_pic_id`),
  KEY `SHP_R_17` (`goods_id`),
  CONSTRAINT `SHP_R_17` FOREIGN KEY (`goods_id`) REFERENCES `shp_goods` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shp_goods_pic
-- ----------------------------

-- ----------------------------
-- Table structure for web_content
-- ----------------------------
DROP TABLE IF EXISTS `web_content`;
CREATE TABLE `web_content` (
  `web_nav_id` int(11) NOT NULL COMMENT '主键',
  `web_content` varchar(255) DEFAULT NULL COMMENT '内容',
  `create_user` varchar(32) NOT NULL COMMENT '创建用户',
  `create_date` datetime NOT NULL COMMENT '创建时间',
  `update_user` varchar(32) DEFAULT NULL COMMENT '更新用户',
  `update_date` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`web_nav_id`),
  CONSTRAINT `web_content_ibfk_1` FOREIGN KEY (`web_nav_id`) REFERENCES `web_nav` (`web_nav_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_content
-- ----------------------------
INSERT INTO `web_content` VALUES ('1', null, 'admin', '2018-05-14 20:38:50', 'admin', '2018-05-16 14:32:27');
INSERT INTO `web_content` VALUES ('2', null, 'admin', '2018-05-14 20:39:49', 'admin', '2018-05-16 14:32:41');
INSERT INTO `web_content` VALUES ('3', null, 'admin', '2018-05-14 20:39:58', 'admin', '2018-05-16 14:32:53');
INSERT INTO `web_content` VALUES ('4', null, 'admin', '2018-05-14 20:40:06', 'admin', '2018-05-16 14:33:04');
INSERT INTO `web_content` VALUES ('5', null, 'admin', '2018-05-14 20:40:18', 'admin', '2018-05-16 14:33:13');
INSERT INTO `web_content` VALUES ('6', null, 'admin', '2018-05-16 14:28:36', null, null);
INSERT INTO `web_content` VALUES ('7', null, 'admin', '2018-05-14 20:40:34', null, null);
INSERT INTO `web_content` VALUES ('8', null, 'admin', '2018-05-14 20:40:42', null, null);
INSERT INTO `web_content` VALUES ('9', null, 'admin', '2018-05-14 20:40:50', null, null);
INSERT INTO `web_content` VALUES ('10', null, 'admin', '2018-05-14 20:40:57', 'admin', '2018-05-20 04:26:47');
INSERT INTO `web_content` VALUES ('11', null, 'admin', '2018-05-14 20:41:04', null, null);
INSERT INTO `web_content` VALUES ('12', null, 'admin', '2018-05-14 20:41:12', null, null);
INSERT INTO `web_content` VALUES ('13', null, 'admin', '2018-05-14 20:41:18', null, null);
INSERT INTO `web_content` VALUES ('14', null, 'admin', '2018-05-14 20:41:26', null, null);
INSERT INTO `web_content` VALUES ('15', null, 'admin', '2018-05-14 20:41:36', null, null);
INSERT INTO `web_content` VALUES ('16', null, 'admin', '2018-05-14 20:41:45', null, null);
INSERT INTO `web_content` VALUES ('17', null, 'admin', '2018-05-14 20:41:53', null, null);
INSERT INTO `web_content` VALUES ('18', null, 'admin', '2018-05-14 20:42:01', null, null);
INSERT INTO `web_content` VALUES ('19', null, 'admin', '2018-05-14 20:42:09', null, null);

-- ----------------------------
-- Table structure for web_message
-- ----------------------------
DROP TABLE IF EXISTS `web_message`;
CREATE TABLE `web_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `connet_name` varchar(32) NOT NULL,
  `connet_phone` varchar(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `address` varchar(255) NOT NULL,
  `message_content` varchar(255) NOT NULL,
  `create_date` datetime(6) NOT NULL,
  `is_look` smallint(6) NOT NULL DEFAULT '0',
  `feedback_img_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_message
-- ----------------------------
INSERT INTO `web_message` VALUES ('1', '13123213', '5555', '345345@是我说的', '方式发顺丰', '34543554565646464', '2018-05-15 16:04:07.000000', '0', null);
INSERT INTO `web_message` VALUES ('2', '3', '3', '3', '3', '3', '2018-06-05 21:14:43.000000', '0', null);
INSERT INTO `web_message` VALUES ('3', '4', '4', '4', '4', '4', '2018-06-05 21:15:00.000000', '0', null);
INSERT INTO `web_message` VALUES ('5', '6', '6', '6', '6', '6', '2018-06-05 21:15:21.000000', '0', null);

-- ----------------------------
-- Table structure for web_nav
-- ----------------------------
DROP TABLE IF EXISTS `web_nav`;
CREATE TABLE `web_nav` (
  `web_nav_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `web_navType_id` int(11) NOT NULL COMMENT '导航类型ID',
  `web_nav_name` varchar(32) NOT NULL COMMENT '类型名称',
  `url` varchar(255) NOT NULL COMMENT '视图URL',
  `controller` varchar(255) NOT NULL COMMENT '控制器',
  PRIMARY KEY (`web_nav_id`),
  KEY `web_navType_id` (`web_navType_id`),
  CONSTRAINT `web_nav_ibfk_1` FOREIGN KEY (`web_navType_id`) REFERENCES `web_nav_type` (`web_navType_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_nav
-- ----------------------------
INSERT INTO `web_nav` VALUES ('1', '1', '公司首页', 'web-content/index', 'frontend\\controllers\\WebContentController');
INSERT INTO `web_nav` VALUES ('2', '1', '公司简介', 'web-content/profile', 'frontend\\controllers\\WebContentController');
INSERT INTO `web_nav` VALUES ('3', '1', '公司资质', 'web-content/qualification', 'frontend\\controllers\\WebContentController');
INSERT INTO `web_nav` VALUES ('4', '1', '工程案列', 'web-content/project', 'frontend\\controllers\\WebContentController');
INSERT INTO `web_nav` VALUES ('5', '1', '联系我们', 'web-content/contact', 'frontend\\controllers\\WebContentController');
INSERT INTO `web_nav` VALUES ('6', '1', '客户留言', 'web-content/feedback', 'frontend\\controllers\\WebContentController');
INSERT INTO `web_nav` VALUES ('7', '2', '清洗服务', '', '');
INSERT INTO `web_nav` VALUES ('8', '2', '清洗地毯', '', '');
INSERT INTO `web_nav` VALUES ('9', '2', '日常托管式保洁', '', '');
INSERT INTO `web_nav` VALUES ('10', '2', '地面清洗养护', '', '');
INSERT INTO `web_nav` VALUES ('11', '2', '家庭开荒保洁', '', '');
INSERT INTO `web_nav` VALUES ('12', '2', '公司开荒保洁', '', '');
INSERT INTO `web_nav` VALUES ('13', '2', '石材翻新养护', '', '');
INSERT INTO `web_nav` VALUES ('14', '2', '地板打蜡', '', '');
INSERT INTO `web_nav` VALUES ('15', '2', '油烟机、油烟管道清洗', '', '');
INSERT INTO `web_nav` VALUES ('16', '2', '沙发清洗', '', '');
INSERT INTO `web_nav` VALUES ('17', '2', '管道疏通', '', '');
INSERT INTO `web_nav` VALUES ('18', '2', '室内装潢', '', '');
INSERT INTO `web_nav` VALUES ('19', '2', '耐磨地坪密封固化处理', '', '');

-- ----------------------------
-- Table structure for web_nav_type
-- ----------------------------
DROP TABLE IF EXISTS `web_nav_type`;
CREATE TABLE `web_nav_type` (
  `web_navType_id` int(11) NOT NULL COMMENT '主键',
  `web_navType_name` varchar(32) NOT NULL COMMENT '导航类型名称',
  PRIMARY KEY (`web_navType_id`),
  KEY `web_navType_id` (`web_navType_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_nav_type
-- ----------------------------
INSERT INTO `web_nav_type` VALUES ('1', '首页导航条');
INSERT INTO `web_nav_type` VALUES ('2', '服务导航条');

-- ----------------------------
-- Table structure for web_pic
-- ----------------------------
DROP TABLE IF EXISTS `web_pic`;
CREATE TABLE `web_pic` (
  `pic_id` int(11) NOT NULL,
  `pic_type_id` int(11) NOT NULL,
  `pic_url` varchar(32) NOT NULL,
  PRIMARY KEY (`pic_id`),
  KEY `pic_type_id` (`pic_type_id`),
  CONSTRAINT `web_pic_ibfk_1` FOREIGN KEY (`pic_type_id`) REFERENCES `web_pic_type` (`pic_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_pic
-- ----------------------------
INSERT INTO `web_pic` VALUES ('1', '1', '23423424');
INSERT INTO `web_pic` VALUES ('2', '1', '3434534');

-- ----------------------------
-- Table structure for web_pic_type
-- ----------------------------
DROP TABLE IF EXISTS `web_pic_type`;
CREATE TABLE `web_pic_type` (
  `pic_type_id` int(11) NOT NULL,
  `pic_type_name` varchar(11) NOT NULL,
  PRIMARY KEY (`pic_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_pic_type
-- ----------------------------
INSERT INTO `web_pic_type` VALUES ('1', '右边轮播图');
INSERT INTO `web_pic_type` VALUES ('2', '内容轮播图');
INSERT INTO `web_pic_type` VALUES ('4', 'flash图');

-- ----------------------------
-- Table structure for web_user
-- ----------------------------
DROP TABLE IF EXISTS `web_user`;
CREATE TABLE `web_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `auth_key` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_vaidate_token` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` smallint(6) NOT NULL,
  `status` smallint(6) NOT NULL,
  `avator` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vip_1v` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL COMMENT '会员表',
  `head_img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of web_user
-- ----------------------------
INSERT INTO `web_user` VALUES ('1', 'test', '2aF4Cn7blkSOrr-NgdL5nmAC6cLFUfZx', '$2y$13$afRlhaEVAIjOt6Yr07uCxeyn3vfjSXW8rNSaFijBbD.h7uthz0rOm', 'BsF3tN-g8stfw8QNU1G08mRV3CcpkBPf_1498364564', null, '123456@qq.com', '0', '10', null, '0', '1494753615', '1498364564', null);
INSERT INTO `web_user` VALUES ('2', 'test01', 'JfB2pHXFulOwYT56QTPXmXT6Tk-v_K-I', '$2y$13$pbMtt.q5MQMY5DEDszlCru2xMb4JGxhzhyBB1tvZ8KRv7g5XEM78a', null, null, '234234@qq.com', '0', '10', null, '0', '1494758236', '1494758236', null);
INSERT INTO `web_user` VALUES ('3', '345345', '7C3ffE0uI_je8cSCxCUF73Df8K2FelRD', '$2y$13$sTse4.8yrmjDj8LYJ/WyJOiikykchsjI6Jm.du2CLrkzVizEXxBEy', null, null, '34534543@qq.com', '0', '10', null, '0', '1527233338', '1527233338', null);
