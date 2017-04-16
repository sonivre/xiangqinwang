
create database dating;

-- 用户表

create table if not exists `xqw_user` (
  `user_id` int unsigned not null auto_increment,
  `group_id` smallint unsigned not null default 0,
  `username` varchar(50) not null default '',
  `email` varchar(50) not null default '',
  `realname` varchar(50) not null default '' comment '真实用户姓名',
  `password` char(32) not null default '' comment '用户密码',
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
  `regdate` datetime not null default CURRENT_TIMESTAMP comment '注册时间',
  `credits` int unsigned not null default 0 comment '花田币',
  `emailstatus` tinyint not null default 0 comment '邮件是否认证',
  `avatar` varchar(255) not null default '' comment '头像',
  primary key(`user_id`),
  unique key `username` (`username`),
  key `email` (`email`),
  key `group_id` (`group_id`)
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
create table if not exists `xqw_revenue` (
  `rev_id` smallint unsigned not null auto_increment,
  `type` tinyint not null comment '0 月 | 1 年',
  `revenue` varchar(50) not null default '' comment '收入范围等',
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