# Host: localhost  (Version: 5.5.53)
# Date: 2018-04-18 19:00:02
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "alpha_menu"
#

DROP TABLE IF EXISTS `alpha_menu`;
CREATE TABLE `alpha_menu` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `module` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '模块',
  `controller` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '控制器',
  `method` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '操作名称',
  `data` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '额外参数',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '菜单类型 1：权限认证；0：只作为菜单',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态，1显示，0禁用',
  `name` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '菜单名称',
  `icon` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT '菜单图标',
  `remark` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '备注',
  `listorder` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序ID',
  `nav_list` varchar(255) CHARACTER SET utf8 DEFAULT '0' COMMENT '层级关系',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `parentid` (`parentid`),
  KEY `model` (`controller`)
) ENGINE=InnoDB AUTO_INCREMENT=349 DEFAULT CHARSET=utf8mb4 COMMENT='后台菜单表';

#
# Data for table "alpha_menu"
#

INSERT INTO `alpha_menu` VALUES (211,249,'admin','core/menu','index','',0,1,'后台菜单','fa fa-sitemap','',2,'249-211'),(216,0,'admin','Default','default','',0,1,'管理组','fa fa-users','12323',0,'216'),(217,216,'admin','core.Admin','home_page','',0,1,'管理员','fa fa-user','',0,'216-217'),(218,216,'admin','core/role','index','',0,1,'角色管理','fa fa-map-marker','',0,'216-218'),(249,0,'admin','Default','default','',0,1,'设置','fa fa-gears','',0,'249'),(250,249,'admin','core.Setting','home_page','',0,1,'网站信息','fa fa-cog','',0,'249-250'),(252,249,'admin','core.Dblist','home_page','',0,1,'数据库备份','fa fa-cloud-download','',0,'249-252'),(265,0,'admin','Default','default','',0,1,'公告管理','fa fa-rss-square','',0,'265'),(266,265,'admin','core.Posts','home_page_posts','',0,1,'文章管理','fa fa-file-text','',0,'265-266'),(267,265,'admin','core.Posts','home_page_term','',0,1,'文章分类','fa fa-code-fork','',0,'265-267'),(304,249,'admin','core.Imgs','home_page','',0,1,'系统图库','glyphicon glyphicon-picture','',0,'249-304'),(305,217,'admin','core.Admin','add_think','',1,1,'管理员添加逻辑','','',0,'216-217-305'),(306,217,'admin','core.Admin','edit_think','',1,1,'管理员编辑逻辑','','',0,'216-217-306'),(307,217,'admin','core.Admin','del_think','',1,1,'管理员删除逻辑','','',0,'216-217-307'),(308,218,'admin','core.Role','add_think','',1,1,'角色添加逻辑','','',0,'216-218-308'),(309,218,'admin','core.Role','del_think','',1,1,'角色删除逻辑','','',0,'216-218-309'),(310,218,'admin','core.Role','edit_think','',1,1,'角色编辑逻辑','','',0,'216-218-310'),(311,250,'admin','core.Setting','save_sites','',1,1,'存储网站配置信息','','',0,'249-250-311'),(312,250,'admin','core.Setting','save_seo','',1,1,'存储完整seo','','',0,'249-250-312'),(313,266,'admin','core.Posts','edit_think_posts','',1,1,'文章编辑逻辑','','',0,'265-266-313'),(314,266,'admin','core.Posts','del_think_posts','',1,1,'文章删除逻辑','','',0,'265-266-314'),(315,266,'admin','core.Posts','add_think_posts','',1,1,'文章添加逻辑','','',0,'265-266-315'),(316,211,'admin','core/menu','del','',1,1,'后台菜单删除逻辑','','',0,'249-211-316'),(317,211,'admin','core/menu','add','',1,1,'后台菜单添加逻辑','','',0,'249-211-317'),(318,211,'admin','core/menu','edit','',1,1,'后台菜单编辑逻辑','','',0,'249-211-318'),(319,252,'admin','core.Dblist','export_more','',1,1,'多表导出逻辑','','',0,'249-252-319'),(320,252,'admin','core.Dblist','export_one','',1,1,'单表导出逻辑','','',0,'249-252-320'),(321,252,'admin','core.Dblist','del','',1,1,'删除文件','','',0,'249-252-321'),(322,304,'admin','core.Imgs','del_think','',1,1,'删除图库文件','','',0,'249-304-322'),(323,267,'admin','core.Posts','add_think_term','',1,1,'文章分类添加逻辑','','',0,'265-267-323'),(324,267,'admin','core.Posts','del_think_term','',1,1,'文章分类删除逻辑','','',0,'265-267-324'),(325,267,'admin','core.Posts','edit_think_term','',1,1,'文章分类编辑逻辑','','',0,'265-267-325'),(326,328,'admin','core.Upload','upload_sigle','',1,1,'单图片上传逻辑','','',0,'328-326'),(327,328,'admin','core.Upload','del_sigle_file','',1,1,'单图片删除逻辑','','',0,'328-327'),(328,0,'admin','Default','default','',0,0,'功能模块','','',0,'328'),(329,252,'admin','core.Dblist','download','',1,1,'数据文件下载','','',0,'249-252-329'),(330,252,'admin','core.Dblist','restore','',1,1,'数据库文件执行','','',0,'249-252-330'),(331,249,'admin','core.Setting','plugins_home','',0,1,'插件库','fa fa-dropbox','微信、淘宝、短信接口参数',0,'249-331'),(345,0,'admin','Default','default','',0,1,'模板','','',0,'345'),(346,345,'admin','Test','homePage','',0,1,'模板1','','',0,'345-346'),(347,345,'admin','Test2','homePage','',0,1,'模板2','','',0,'345-347');

#
# Structure for table "alpha_role"
#

DROP TABLE IF EXISTS `alpha_role`;
CREATE TABLE `alpha_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '角色名称',
  `pid` smallint(6) DEFAULT NULL COMMENT '父角色ID',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '0禁用 1开启',
  `remark` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '备注',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `listorder` int(3) NOT NULL DEFAULT '0' COMMENT '排序字段',
  `rules` text CHARACTER SET utf8 COMMENT '拥有的权限规则',
  `nav_list` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '该角色对应首页导航',
  PRIMARY KEY (`id`),
  KEY `parentId` (`pid`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='角色表';

#
# Data for table "alpha_role"
#

INSERT INTO `alpha_role` VALUES (23,'超级管理员',0,1,'',1513757032,1516688138,0,'216,218,310,309,308,217,307,306,305,249,331,304,322,252,330,329,321,320,319,250,312,311,211,318,317,316,265,267,325,324,323,266,315,314,313,328,327,326','216-217'),(24,'运营',213,1,'',1517386880,1517386929,0,'216,218,310,309,308,217,307,306,305','249-211');

#
# Structure for table "alpha_role_user"
#

DROP TABLE IF EXISTS `alpha_role_user`;
CREATE TABLE `alpha_role_user` (
  `role_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`role_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='角色用户关联表';

#
# Data for table "alpha_role_user"
#

INSERT INTO `alpha_role_user` VALUES (14,39,2),(16,1,23);

#
# Structure for table "alpha_test"
#

DROP TABLE IF EXISTS `alpha_test`;
CREATE TABLE `alpha_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-one 1-two 2-three',
  `name` varchar(8) DEFAULT NULL,
  `c_time` int(11) NOT NULL COMMENT '创建时间',
  `u_time` int(11) NOT NULL COMMENT '编辑时间',
  `d_time` int(11) NOT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='模板表,其余表按这张表字段编写';

#
# Data for table "alpha_test"
#

INSERT INTO `alpha_test` VALUES (1,0,'',1499229055,0,0),(2,1,'',1499229055,0,0),(3,0,'',1499229055,0,0),(4,1,'',1499229055,0,0),(5,0,'',1499229055,0,0),(6,1,'',1499229055,0,0),(7,0,'',1499229055,0,0),(8,1,'',1499229055,0,0),(9,0,'',1499229055,0,0),(10,1,'',1499229055,0,0),(11,0,'',1499229055,0,0),(12,1,'',1499229055,0,0),(13,0,'',1499229055,0,0),(17,0,'345345',1516688852,0,0);

#
# Structure for table "alpha_users"
#

DROP TABLE IF EXISTS `alpha_users`;
CREATE TABLE `alpha_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '用户名',
  `avatar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `user_pass` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '登录密码；sp_password加密',
  `user_pass_salt` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '密码验证',
  `user_nicename` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '用户美名',
  `user_email` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '登录邮箱',
  `last_login_ip` varchar(16) CHARACTER SET utf8 DEFAULT NULL COMMENT '最后登录ip',
  `last_login_time` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `create_time` int(11) DEFAULT NULL COMMENT '注册时间',
  `user_status` int(11) NOT NULL DEFAULT '0' COMMENT '用户状态 0：禁用； 1：正常 ；2：未验证',
  `mobile` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '手机号',
  `user_hits` int(11) DEFAULT '0' COMMENT '登陆次数',
  PRIMARY KEY (`id`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT COMMENT='用户表';

#
# Data for table "alpha_users"
#

INSERT INTO `alpha_users` VALUES (1,'admin','','f354bc916f4979959bb4c274e8e92976','aZKZBygJtL','admin','dc_wen663@163.com','127.0.0.1',1524018361,1517207080,1489155324,1,'',17);
