/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.6.12 : Database - clms
*********************************************************************
*/

/*Table structure for table `cl_admin` */

DROP TABLE IF EXISTS `cl_admin`;

CREATE TABLE `cl_admin` (
  `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `gid` tinyint(4) NOT NULL COMMENT 'group id,对应group',
  `uname` varchar(55) NOT NULL COMMENT '用户登陆名',
  `pwd` varchar(55) DEFAULT NULL,
  `nickname` varchar(55) DEFAULT NULL COMMENT '昵称,用于作者',
  `loginip` varchar(15) DEFAULT NULL,
  `lastlogin` varchar(15) DEFAULT NULL,
  `logintime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uname` (`uname`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `cl_admin` */

insert  into `cl_admin`(`id`,`gid`,`uname`,`pwd`,`nickname`,`loginip`,`lastlogin`,`logintime`) values (1,1,'admin','nqp3949on59noor','管理员','127.0.0.1','127.0.0.1',1396838959);

/*Table structure for table `cl_arc_pic` */

DROP TABLE IF EXISTS `cl_arc_pic`;

CREATE TABLE `cl_arc_pic` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  `md5value` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `md5value` (`md5value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `cl_arc_pic` */

/*Table structure for table `cl_article` */

DROP TABLE IF EXISTS `cl_article`;

CREATE TABLE `cl_article` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `summary` varchar(500) NOT NULL DEFAULT '' COMMENT '摘要',
  `content` text NOT NULL COMMENT '正文',
  `click` mediumint(8) NOT NULL DEFAULT '241' COMMENT '点击',
  `author` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '作者id,对应admin',
  `pubdate` int(10) unsigned NOT NULL COMMENT 'publish date,发布日期',
  `addtime` int(10) unsigned NOT NULL COMMENT '添加时间',
  `source` varchar(255) NOT NULL DEFAULT '本站' COMMENT '来源',
  `pics` varchar(100) NOT NULL DEFAULT '' COMMENT '图片id,对应arc_pic',
  `rank` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `cl_article` */

/*Table structure for table `cl_column` */

DROP TABLE IF EXISTS `cl_column`;

CREATE TABLE `cl_column` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(8) unsigned NOT NULL COMMENT 'parent id,父id',
  `path` varchar(255) NOT NULL COMMENT '栏目路径',
  `list` varchar(255) NOT NULL DEFAULT '' COMMENT '列表模板',
  `view` varchar(255) NOT NULL DEFAULT '' COMMENT '详细模板',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT 'seo描述',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT 'seo关键词',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `cl_column` */

/*Table structure for table `cl_flink` */

DROP TABLE IF EXISTS `cl_flink`;

CREATE TABLE `cl_flink` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `pic` varchar(255) NOT NULL DEFAULT '',
  `ispic` tinyint(1) NOT NULL DEFAULT '0',
  `rank` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `cl_flink` */

/*Table structure for table `cl_group` */

DROP TABLE IF EXISTS `cl_group`;

CREATE TABLE `cl_group` (
  `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `gname` varchar(55) NOT NULL COMMENT 'group name,用户组名',
  `limit` varchar(500) NOT NULL COMMENT '权限',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `cl_group` */

insert  into `cl_group`(`id`,`gname`,`limit`) values (1,'管理员组','all');

/*Table structure for table `cl_message` */

DROP TABLE IF EXISTS `cl_message`;

CREATE TABLE `cl_message` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `guestname` varchar(55) NOT NULL COMMENT '留言人昵称',
  `content` mediumtext NOT NULL,
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;
\
