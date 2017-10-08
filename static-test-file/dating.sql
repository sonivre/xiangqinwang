
create database dating;

-- 用户表

create table if not exists `xqw_user` (
  `user_id` int unsigned not null auto_increment,
  `group_id` smallint unsigned not null default 0,
  `username` varchar(50) not null default '',
  `email` varchar(50) not null default '',
  `realname` varchar(50) not null default '' comment '真实用户姓名',
  `password` varchar(100) not null default '' comment '用户密码',
  `birthyear` smallint unsigned not null default '1970',
  `birthmonth` tinyint unsigned not null default '01',
  `birthday` tinyint unsigned not null default '01',
  `zodiac` varchar(20) not null default '' comment '生肖,自动计算',
  `gender` tinyint not null default '1' comment '性别, 1男, 2女, 3保密',
  `education` tinyint unsigned not null default 0 comment '学历',
  `resideprovince` int not null default 0 comment '居住省份id',
  `residecity` int not null default 0 comment '居住城市id',
  `residearea` int not null default 0 comment '居住的区id',
  `residecommunity` varchar(255) not null default '' comment '居住的小区',
  `revenue` smallint unsigned not null default 0 comment '关联收入表id',
  `graduateschool` varchar(100) not null default '' comment '毕业院校',
  `company` varchar(100) not null default '' comment '公司名称',
  `occupation` varchar(100) not null default '' comment '职业',
  `bloodtype` enum('A', 'B', 'AB', 'O') not null default 'A' comment '血型',
  `height` smallint not null default 0 comment '身高',
  `weight` smallint not null default 0 comment '体重,单位:斤',
  `alipay` varchar(100) not null default '' comment '支付宝账号',
  `mobile` varchar(30) not null default '' comment '手机号',
  `qq` varchar(60) not null default '',
  `msn` varchar(60) not null default '',
  `taobao` varchar(60) not null default '',
  `site` varchar(100) not null default '' comment '个人站点',
  `salt` varchar(50) comment '密码杂质',
  `regdate` datetime not null default CURRENT_TIMESTAMP comment '注册时间',
  `credits` int unsigned not null default 0 comment '花田币',
  `emailstatus` tinyint not null default 0 comment '邮件是否认证',
  `avatar` varchar(255) not null default '' comment '头像',
  primary key(`user_id`),
  unique key `username` (`username`),
  key `email` (`email`),
  key `group_id` (`group_id`)
)engine=innodb default charset=utf8;

-- 用户状态表
create table if not exists xqw_user_status(
  `user_id` int unsigned not null,
  `regip` char(15) not null default '' comment '注册ip',
  `lastip` char(15) not null default '' comment '最后登录ip',
  `isvisible` tinyint not null default 0 comment '是否隐身登录',
  `profile_progress` tinyint unsigned not null default 0 comment '个人资料完成度',
  primary key (`user_id`)
)engine=innodb default charset=utf8;

-- 用户url访问日志表
create table if not exists xqw_user_url_access_log(
  `user_id` int unsigned not null,
  `url` varchar(255) not null default '' comment '访问的url',
  `access_time` datetime comment '访问时间',
  primary key (user_id)
)engine=innodb default charset=utf8;

-- 测试数据
insert into xqw_user (username) values ('test');
insert into xqw_user (username) values ('测试');

-- 学历表
create table if not exists `xqw_education` (
  `eduid` tinyint unsigned not null auto_increment,
  `name` varchar(30) not null default '' comment '学历名称',
  primary key `eduid_key`(`eduid`)
)engine=innodb default charset=utf8;

-- 收入表
create table if not exists `xqw_revenue_range` (
  `rev_id` smallint unsigned not null auto_increment,
  `revenue` varchar(50) not null default '' comment '收入范围',
  primary key (`rev_id`)
)engine=innodb default charset=utf8;


-- 地址表, 等待导入淘宝相关api的数据, 无须手动插入

-- 省
create table if not exists `xqw_province` (
  `id` int not null auto_increment,
  `code` varchar(30) not null comment '编码',
  `name` varchar(50) not null,
  primary key (`id`)
)engine=innodb default charset=utf8;

-- 市
create table if not exists `xqw_city` (
  `id` int not null auto_increment,
  `code` varchar(30) not null comment '编码',
  `name` varchar(50) not null,
  `provincecode` varchar(30) not null,
  primary key (`id`)
)engine=innodb default charset=utf8;

-- 区
create table if not exists `xqw_area` (
  `id` int not null auto_increment,
  `code` varchar(30) not null comment '编码',
  `name` varchar(50) not null,
  `citycode` varchar(30) not null,
  primary key (`id`)
)engine=innodb default charset=utf8;

-- 管理员表
create table `xqw_admin` (
	`admin_id` smallint unsigned not null auto_increment,
	`username` varchar(50) not null default '',
	`password` varchar(255) not null default '',
	`super` tinyint not null default 0 comment '是否是超级管理员',
	`salt` varchar(50) not null default '' comment '杂质',
	`flag` tinyint not null default 1 comment '是否可用',
	`last_login` datetime comment '最后一次登录时间',
	`login_times` int unsigned not null default 0 comment '登录次数',
	`create_time` datetime comment '创建时间',
	`loginip` char(15) not null default '' comment '最后一次登录ip',
	primary key prk_index(`admin_id`)
)engine=innodb default charset=utf8;

-- 默认系统管理员 admin 密码: 123456
-- insert into xqw_admin (`username`, `password`, `salt`, `super`) values ('admin', '9391a098312698a442c211ad26dccbc5ac91fc0004ee9164ed6ac828d8340efd', '5cee835f2336eaec', 1);

create table `xqw_admin_log`(
	`id` int unsigned NOT NULL AUTO_INCREMENT,
	`content` varchar(50) NOT NULL COMMENT '操作内容',
	`createtime` datetime DEFAULT NULL COMMENT '发生时间',
	`admin_name` varchar(30) NOT NULL COMMENT '管理员',
	`admin_id` smallint unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID',
	`ip` char(15) NOT NULL COMMENT 'IP',
	`url` varchar(100) NOT NULL DEFAULT '' COMMENT 'route',
	primary key `pk_id` (`id`)
)engine=innodb default charset=utf8;

-- rbac

CREATE TABLE `xqw_menus` (
  `menu_id` int unsigned NOT NULL AUTO_INCREMENT,
  `menu_parent_id` int unsigned NOT NULL DEFAULT '0',
  `permission_id` int unsigned NOT NULL DEFAULT '0',
  `menu_name` varchar(50) NOT NULL DEFAULT '',
  `menu_route` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- 后台权限相关

create table xqw_admin_permissions(
	`permission_id` int auto_increment,
	`parent_id` int not null default 0,
	`action_user_id` int not null default 0,
	`permission_name_en` varchar(50) not null default '',
	`permission_name_zh` varchar(50) not null default '',
	`create_time` datetime,
	`update_time` datetime,
	primary key `permission_id` (`permission_id`)
)engine=innodb default charset=utf8;

-- 角色表

create table xqw_admin_roles(
	`role_id` int auto_increment,
	`action_user_id` int not null default 0,
	`role_name` varchar(100) not null default '',
	`create_time` datetime,
	`update_time` datetime,
	primary key `role_id` (`role_id`)
)engine=innodb default charset=utf8;

-- 角色权限表

create table xqw_admin_role_permission(
	`id` int auto_increment,
	`role_id` int not null default 0,
	`permission_id` int not null default 0,
	primary key `pk_id` (`id`)
)engine=innodb default charset=utf8;

-- 用户角色表

create table xqw_admin_user_role(
	`id` int auto_increment,
	`action_user_id` int not null default 0,
	`admin_id` int not null default 0,
	`role_id` int not null default 0,
	primary key `pk_id` (`id`)
)engine=innodb default charset=utf8;

-- 发送用户短信记录

create table xqw_mobile_verify_code(
  `id` int unsigned auto_increment,
  `agent` VARCHAR(150) COMMENT '设备信息',
  `mobile_number` VARCHAR(20),
  `code` VARCHAR(10) COMMENT '验证码',
  `type` VARCHAR(30) COMMENT '类型，注册，密码找回等',
  `add_time` DATETIME default CURRENT_TIMESTAMP,
  `expire_time` DATETIME COMMENT '过期时间',
  PRIMARY KEY `pk_id` (`id`)
)engine=innodb default charset=utf8;


