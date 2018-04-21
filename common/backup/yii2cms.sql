# Host: localhost  (Version: 5.5.53)
# Date: 2018-04-21 17:15:52
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "alpha_imgs"
#

DROP TABLE IF EXISTS `alpha_imgs`;
CREATE TABLE `alpha_imgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_size` varchar(255) DEFAULT NULL,
  `upload_date` varchar(255) DEFAULT NULL COMMENT '上传日期',
  `user_id` varchar(255) DEFAULT NULL COMMENT '操作者',
  `ip` varchar(255) DEFAULT NULL COMMENT '操作ip',
  `img_path` varchar(255) DEFAULT NULL COMMENT '图片路径',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '来源0-本地1-七牛',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='图片管理';

#
# Data for table "alpha_imgs"
#

INSERT INTO `alpha_imgs` VALUES (2,'80.765KB','1523760228','','171.214.234.87','http://p2otxz81j.bkt.clouddn.com/5011b394ab55b684c3bfdb25790e7ef2.jpg',1),(3,'166.445KB','1523765413','','112.44.105.221','http://p2otxz81j.bkt.clouddn.com/7faee630c5cfe7ebb2bb9d52642648d3.jpg',1),(4,'252.103KB','1523765426','','112.44.105.221','http://p2otxz81j.bkt.clouddn.com/8844b63cf5f82a982e253a0ff740f02e.jpg',1),(5,'154.563KB','1523765473','','112.44.105.221','http://p2otxz81j.bkt.clouddn.com/369f5395c6797fc6d99a94ed388864fd.jpg',1),(6,'252.147KB','1523765487','','112.44.105.221','http://p2otxz81j.bkt.clouddn.com/f2994df6d89353362b9dc0df41253a00.jpg',1),(7,'127.007KB','1523767148','','171.210.230.213','http://p2otxz81j.bkt.clouddn.com/6968314726c092ade029c070969c5f66.png',1);

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
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '排序ID',
  `nav_list` varchar(255) CHARACTER SET utf8 DEFAULT '0' COMMENT '层级关系',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `parentid` (`parentid`),
  KEY `model` (`controller`)
) ENGINE=InnoDB AUTO_INCREMENT=348 DEFAULT CHARSET=utf8mb4 COMMENT='后台菜单表';

#
# Data for table "alpha_menu"
#

INSERT INTO `alpha_menu` VALUES (211,249,'admin','core/menu','index','',0,1,'后台菜单','fa fa-sitemap','',2,'249-211'),(216,0,'admin','Default','default','',0,1,'管理组','fa fa-users','12323',0,'216'),(217,216,'admin','core/admin','index','',0,1,'管理员','fa fa-user','',0,'216-217'),(218,216,'admin','core/role','index','',0,1,'角色管理','fa fa-map-marker','',0,'216-218'),(249,0,'admin','Default','default','',0,1,'设置','fa fa-gears','',0,'249'),(304,249,'admin','core/imgs','index','',0,1,'系统图库','glyphicon glyphicon-picture','',0,'249-304'),(305,217,'admin','core/admin','add','',1,1,'管理员添加逻辑','','',0,'216-217-305'),(306,217,'admin','core/admin','edit','',1,1,'管理员编辑逻辑','','',0,'216-217-306'),(307,217,'admin','core/admin','del','',1,1,'管理员删除逻辑','','',0,'216-217-307'),(308,218,'admin','core/role','add','',1,1,'角色添加逻辑','','',0,'216-218-308'),(309,218,'admin','core/role','del','',1,1,'角色删除逻辑','','',0,'216-218-309'),(310,218,'admin','core/role','edit','',1,1,'角色编辑逻辑','','',0,'216-218-310'),(316,211,'admin','core/menu','del','',1,1,'后台菜单删除逻辑','','',0,'249-211-316'),(317,211,'admin','core/menu','add','',1,1,'后台菜单添加逻辑','','',0,'249-211-317'),(318,211,'admin','core/menu','edit','',1,1,'后台菜单编辑逻辑','','',0,'249-211-318'),(322,304,'admin','core/imgs','del','',1,1,'删除图库文件','','',0,'249-304-322'),(326,328,'admin','core/upload','upload-sigle','',1,1,'单图片上传逻辑','','',0,'328-326'),(327,328,'admin','core/upload','del-sigle-file','',1,1,'单图片删除逻辑','','',0,'328-327'),(328,0,'admin','Default','default','',0,0,'功能模块','','',0,'328'),(345,0,'admin','Default','default','',0,1,'模板','','',0,'345'),(346,345,'admin','test','index','',0,1,'模板1','fa fa-gift','',0,'345-346'),(347,345,'admin','test2','index','',0,1,'模板2','fa fa-gift','',0,'345-347'),(348,345,'','widget','index','',0,1,'组件模块','fa fa-anchor','',0,'345-348');

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COMMENT='角色表';

#
# Data for table "alpha_role"
#

INSERT INTO `alpha_role` VALUES (25,'超级管理员',NULL,1,'',1523759170,1523759201,0,'216,218,310,308,249,304,322,211,318,317,316,328,327,326,345,347,346','216-217'),(26,'123',NULL,1,'213',1524298922,0,0,NULL,NULL);

#
# Structure for table "alpha_role_user"
#

DROP TABLE IF EXISTS `alpha_role_user`;
CREATE TABLE `alpha_role_user` (
  `role_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`role_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COMMENT='角色用户关联表';

#
# Data for table "alpha_role_user"
#

INSERT INTO `alpha_role_user` VALUES (14,39,2),(15,1,25);

#
# Structure for table "alpha_test"
#

DROP TABLE IF EXISTS `alpha_test`;
CREATE TABLE `alpha_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-one 1-two 2-three',
  `name` varchar(8) DEFAULT NULL,
  `c_time` int(11) DEFAULT '0' COMMENT '创建时间',
  `u_time` int(11) DEFAULT '0' COMMENT '编辑时间',
  `d_time` int(11) DEFAULT '0' COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COMMENT='模板表,其余表按这张表字段编写';

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
  `last_login_time` varchar(255) CHARACTER SET utf8 DEFAULT '0' COMMENT '最后登录时间',
  `update_time` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` varchar(255) CHARACTER SET utf8 DEFAULT '0' COMMENT '注册时间',
  `user_status` int(11) NOT NULL DEFAULT '0' COMMENT '用户状态 0：禁用； 1：正常 ；2：未验证',
  `mobile` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '手机号',
  `user_hits` int(11) DEFAULT '0' COMMENT '登陆次数',
  PRIMARY KEY (`id`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='用户表';

#
# Data for table "alpha_users"
#

INSERT INTO `alpha_users` VALUES (1,'admin',NULL,'','aZKZBygJtL','admin','dc_wen663@163.com','127.0.0.1','1524275434','1524293211','1489155324',1,'',4);
