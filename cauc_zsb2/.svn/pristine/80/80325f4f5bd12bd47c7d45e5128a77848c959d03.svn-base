-- Y-cityCMS SQL Dump
-- Time:2013-11-11 13:44:47
-- http://www.y-city.net.cn 

-- 
-- 表的结构 `ycity_admin_log`
-- 
DROP TABLE IF EXISTS `ycity_admin_log`;
CREATE TABLE `ycity_admin_log` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` tinyint(3) unsigned NOT NULL COMMENT '用户ID',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户',
  `action` text NOT NULL COMMENT 'URI',
  `ip` char(15) NOT NULL DEFAULT '127.0.0.1' COMMENT 'IP',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '录入时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='管理员操作日志';
-- 
-- 导出表中的数据 `ycity_admin_log`
--
INSERT INTO `ycity_admin_log` VALUES ('1','1','admin','/admin.php','202.113.88.131','1384055365');
INSERT INTO `ycity_admin_log` VALUES ('2','1','admin','/admin.php/Qa/index','202.113.88.131','1384055379');
INSERT INTO `ycity_admin_log` VALUES ('3','1','admin','/admin.php/Qa','202.113.88.131','1384055390');
INSERT INTO `ycity_admin_log` VALUES ('4','1','admin','/admin.php/Qa/index','202.113.88.131','1384073068');
INSERT INTO `ycity_admin_log` VALUES ('5','1','admin','/admin.php/Membercount/index','202.113.88.131','1384073072');
INSERT INTO `ycity_admin_log` VALUES ('6','1','admin','/admin.php/Member/index','202.113.88.131','1384073075');
INSERT INTO `ycity_admin_log` VALUES ('7','1','admin','/admin.php','202.113.88.131','1384148629');
INSERT INTO `ycity_admin_log` VALUES ('8','1','admin','/admin.php/Database','202.113.88.131','1384148640');
INSERT INTO `ycity_admin_log` VALUES ('9','1','admin','/admin.php/Database/doExport (备份数据库)','202.113.88.131','1384148647');
INSERT INTO `ycity_admin_log` VALUES ('10','1','admin','/admin.php/Database','202.113.88.131','1384148648');
-- 
-- 表的结构 `ycity_audition`
-- 
DROP TABLE IF EXISTS `ycity_audition`;
CREATE TABLE `ycity_audition` (
  `id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL,
  `group` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1为确认通过，2为第一次考试结束，3为第一次考试缺考，4为第二次考试结束，5为第二次考试缺考。需要其他状态再加',
  `result` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='面试';
-- 
-- 导出表中的数据 `ycity_audition`
--
INSERT INTO `ycity_audition` VALUES ('1328585593','13','0','0','0');
-- 
-- 表的结构 `ycity_category`
-- 
DROP TABLE IF EXISTS `ycity_category`;
CREATE TABLE `ycity_category` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `module` char(20) NOT NULL DEFAULT 'N/A' COMMENT '模块',
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '上级目录',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `display_order` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `protected` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否保护',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '录入时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `displayorder` (`display_order`),
  KEY `parentid` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='全局分类';
-- 
-- 导出表中的数据 `ycity_category`
--
INSERT INTO `ycity_category` VALUES ('1','News','0','新闻模块','','','0','0','0','1262410906','1262415121');
INSERT INTO `ycity_category` VALUES ('2','','1','宣讲通知','宣讲通知','宣讲通知','0','0','0','1262410927','1372644067');
INSERT INTO `ycity_category` VALUES ('3','','1','就业指导','就业指导','就业指导','0','0','0','1262410939','1349850052');
INSERT INTO `ycity_category` VALUES ('4','Ad','0','广告模块','','广告模块','0','0','0','1267112377','1267112406');
INSERT INTO `ycity_category` VALUES ('5','','4','公共','','公共','0','0','0','1267112648','0');
INSERT INTO `ycity_category` VALUES ('6','Link','0','链接类型','','链接类型','0','0','0','1267287014','0');
INSERT INTO `ycity_category` VALUES ('7','','6','默认类型','','普通链接','0','0','0','1267287066','1267288647');
-- 
-- 表的结构 `ycity_config`
-- 
DROP TABLE IF EXISTS `ycity_config`;
CREATE TABLE `ycity_config` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `lang` char(20) NOT NULL DEFAULT 'cn' COMMENT '语言',
  `site_name` varchar(100) NOT NULL COMMENT '网站名称',
  `company_name` varchar(200) NOT NULL COMMENT '公司名称',
  `site_url` varchar(200) NOT NULL COMMENT '网站地址',
  `contact_name` varchar(50) NOT NULL COMMENT '联系人',
  `telephone` varchar(50) NOT NULL COMMENT '电话',
  `email` varchar(100) NOT NULL COMMENT 'email',
  `fax` varchar(50) NOT NULL COMMENT '传真',
  `mobile_telephone` varchar(50) NOT NULL COMMENT '手机',
  `address` varchar(200) NOT NULL COMMENT '地址',
  `icp` varchar(20) NOT NULL COMMENT 'icp',
  `qq` varchar(50) NOT NULL COMMENT 'qq',
  `msn` varchar(100) NOT NULL COMMENT 'msn',
  `im` varchar(250) NOT NULL COMMENT '即时通讯工具',
  `web_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '网站状态',
  `status_description` text NOT NULL COMMENT '停止描述',
  `header_content` text NOT NULL COMMENT '头部内容',
  `footer_content` text NOT NULL COMMENT '脚部内容',
  `comment_verify` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否开启留言/评论审核',
  `sys_log` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '系统日志',
  `sys_log_ext` varchar(255) NOT NULL COMMENT '记录日志类型',
  `download_suffix` varchar(255) NOT NULL DEFAULT 'Winndows' COMMENT '下载类型',
  `run_system` varchar(255) NOT NULL COMMENT '运行平台',
  `global_thumb_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '缩略图开关',
  `watermark_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '水印开关',
  `watermark_size` varchar(50) NOT NULL COMMENT '水印尺寸',
  `watermark_position` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '水印位置',
  `watermark_padding` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '水印边距',
  `watermark_trans` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '水印透明度',
  `global_attach_size` int(10) unsigned NOT NULL DEFAULT '2048000' COMMENT '附件大小',
  `global_attach_suffix` varchar(200) NOT NULL COMMENT '允许附件类型',
  `news_thumb_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '新闻缩略图状态',
  `news_thumb_size` varchar(50) NOT NULL COMMENT '新闻缩略图高',
  `product_thumb_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '产品缩略图开关',
  `product_thumb_size` varchar(50) NOT NULL COMMENT '产品缩略图高',
  `download_thumb_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '下载缩略图开关',
  `download_thumb_size` varchar(50) NOT NULL COMMENT '下载缩略图高',
  `global_thumb_size` varchar(50) NOT NULL COMMENT '全局缩略图 尺寸',
  `seo_title` varchar(200) NOT NULL,
  `seo_keyword` varchar(240) NOT NULL,
  `seo_description` varchar(240) NOT NULL,
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '提交时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='系统配置';
-- 
-- 导出表中的数据 `ycity_config`
--
INSERT INTO `ycity_config` VALUES ('1','cn','乘务学院招生信息网','天津启阳新程科技有限公司','http://127.0.0.1/ycity','Y-city','15100000000','admin@admin.com','15100000000','15100000000','address a','津ICP备11003837号-2','5565907','y_city@qeeyang.com','Y-city','0','系统维护中.....','','','1','1','index,delete,modify,insert,update,login','Windows,Linux,Apple,其它','linux,windows','1','1','100x100','0','5','70','2048000','gif,jpg,png,jpeg,swf,zip,rar,chm,7z,pdf,doc,docx,xls,xlsx','1','300,200','1','300,250','1','300,200','300,200','中国民航大学乘务学院招生信息网','中国民航大学乘务学院招生信息网','中国民航大学乘务学院招生信息网','1306847872','1306847872');
-- 
-- 表的结构 `ycity_group`
-- 
DROP TABLE IF EXISTS `ycity_group`;
CREATE TABLE `ycity_group` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL DEFAULT 'all' COMMENT '名称',
  `role_permission` text NOT NULL COMMENT '权限',
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '系统内置',
  `create_time` int(11) unsigned NOT NULL COMMENT '增加时间',
  `update_time` int(11) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='管理员角色';
-- 
-- 导出表中的数据 `ycity_group`
--
INSERT INTO `ycity_group` VALUES ('1','注册用户','Menu_index,Menu_insert,Menu_modify,Menu_command,Category_index,Category_modify,Category_update,News_index,News_modify,News_insert,News_move,News_command,Product_index,Product_insert,Product_modify,Product_command,Product_order,Product_move,Download_index,Download_insert,Download_modify,Download_command,Download_move,Feedback_index,Feedback_insert,Feedback_modify,Feedback_command,Job_index,Job_insert,Job_modify,Job_resume,Job_command,Notice_index,Notice_insert,Notice_modify,Notice_command,Link_index,Link_insert,Link_modify,Link_command,Page_index,Page_insert,Page_modify,Page_command,Ad_index,Ad_insert,Ad_modify,Ad_command,Tags,Comment_index,Comment_modify,Comment_command,Admin_index,Admin_insert,Admin_modify,Admin_command,Template,AdminRole_index,AdminRole_insert,AdminRole_modify,AdminRole_command','1','0','0');
INSERT INTO `ycity_group` VALUES ('2','禁止访问','disable','1','0','0');
INSERT INTO `ycity_group` VALUES ('3','普通用户','Menu_index,Menu_insert,Menu_modify,Menu_command,Category_index,Category_modify,News_index,News_modify,News_insert,News_move,News_command,Product_index,Product_insert,Product_modify,Product_command,Product_order,Product_move,Download_index,Download_insert,Download_modify,Download_command,Download_move,Feedback_index,Feedback_insert,Feedback_modify,Feedback_command,Job_index,Job_insert,Job_modify,Job_resume,Job_command,Notice_index,Notice_insert,Notice_modify,Notice_command,Link_index,Link_insert,Link_modify,Link_command,Page_index,Page_insert,Page_modify,Page_command,Ad_index,Ad_insert,Ad_modify,Ad_command,Tags,Comment_index,Comment_modify,Comment_command,Admin_index,Admin_insert,Admin_modify,Admin_command,Theme,AdminRole_index,AdminRole_insert,AdminRole_modify,AdminRole_command,Module_index,Module_install,Config_index,Config_core,Database_index,Database_export,AdminLog,Tools,Label,Product_index,Product_insert,Product_modify,Product_command,Product_move','1','0','1317994448');
-- 
-- 表的结构 `ycity_label`
-- 
DROP TABLE IF EXISTS `ycity_label`;
CREATE TABLE `ycity_label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `description` text NOT NULL COMMENT '简述',
  `content` text NOT NULL COMMENT '内容',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '录入时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='标签调用';
-- 
-- 导出表中的数据 `ycity_label`
--
-- 
-- 表的结构 `ycity_member`
-- 
DROP TABLE IF EXISTS `ycity_member`;
CREATE TABLE `ycity_member` (
  `id` int(10) NOT NULL,
  `email` varchar(255) NOT NULL COMMENT '电子邮箱',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `name` varchar(20) NOT NULL COMMENT '姓名',
  `gender` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '性别，1为女，2为男',
  `birthday` date NOT NULL DEFAULT '0000-00-00' COMMENT '出生年月',
  `idCard` varchar(50) NOT NULL COMMENT '身份证号码',
  `mobile` varchar(20) NOT NULL COMMENT '联系手机',
  `sourcePlace` tinyint(2) unsigned NOT NULL COMMENT '高考生源地',
  `activation` varchar(20) NOT NULL COMMENT '激活码',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '会员状态，1为已注册，未激活帐号，2为已激活帐号，未报名，3为已报名，未缴费，4为报名完成，未确认身份，5为已确认身份，参加初试，6为初试合格，7为初试不合格，8为体检通过，9为体检未通过，10为考生号反馈，11为高考分数反馈',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后登陆时间',
  `last_ip` varchar(20) NOT NULL DEFAULT '0.0.0.0' COMMENT '最后登陆IP',
  `login_count` int(10) NOT NULL DEFAULT '0' COMMENT '登录次数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户信息';
-- 
-- 导出表中的数据 `ycity_member`
--
INSERT INTO `ycity_member` VALUES ('1331389645','nz8864@sina.com','18d59bc4391f88c806fce28ef7d8fb54027ec7e9','梅家福','2','1988-08-21','330402198808210631','13803002087','12','8jUXXHkZKnHFCp5huJgC','4','1384065171','0','1384143398','202.113.88.131','3');
INSERT INTO `ycity_member` VALUES ('1331379320','349026384@qq.com','18d59bc4391f88c806fce28ef7d8fb54027ec7e9','叶海军','2','1988-10-02','340826198810022650','13622048617','13','F5HNuu9Xh3R7jq8aKrsm','4','1384073108','0','1384076381','202.113.88.131','1');
INSERT INTO `ycity_member` VALUES ('1331483533','wanglin@cauc.edu.cn','3cd124b42bf934bb89c08e2f6cc01b55c9db3ee4','王林','2','1981-10-29','132932198110293615','18822131618','12','OcEAYJrZbUpnhzlBwRER','1','1384133637','0','0','0.0.0.0','0');
INSERT INTO `ycity_member` VALUES ('1331450868','pdeng@cauc.edu.cn','09b0277e1e8782578524814c3ab451e759dda636','邓鹏','2','1987-10-04','612523198710042015','13512810871','12','e6r8Yi1Wv1dR03J0ocaX','2','1384133773','0','0','0.0.0.0','0');
INSERT INTO `ycity_member` VALUES ('1331498782','gnsun@cauc.edu.cn','35039a3d61ecd58304144c8579fc6c000dc8489a','孙关男','2','1980-03-08','230306198003084718','','11','kZauLcTT3XSafZChjO4t','4','1384133795','0','1384148257','115.24.203.160','4');
INSERT INTO `ycity_member` VALUES ('1331488032','1045525605@qq.com','0dd984af22ab25f2ce191b4bc50a31f51577627f','刘未央','1','1989-12-19','120101198912190026','','12','PKoh4HDREbz6ru3wkMV9','3','1384134232','0','0','0.0.0.0','0');
INSERT INTO `ycity_member` VALUES ('1331469413','lwang@cauc.edu.cn','96f42447f3606656f64f3c8f335eed13cf488b2f','段婉婉','1','1994-10-09','342221199410097823','','11','y42Jg3VIkfSgiXRHyyGr','1','1384146080','0','0','0.0.0.0','0');
-- 
-- 表的结构 `ycity_message`
-- 
DROP TABLE IF EXISTS `ycity_message`;
CREATE TABLE `ycity_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(10) unsigned NOT NULL COMMENT '信息id',
  `uid` int(10) unsigned NOT NULL COMMENT '接受者id',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '信息状态，1为未读，2为已读',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='信息列表';
-- 
-- 导出表中的数据 `ycity_message`
--
INSERT INTO `ycity_message` VALUES ('1','1','1326508678','2');
INSERT INTO `ycity_message` VALUES ('2','2','1326508678','2');
INSERT INTO `ycity_message` VALUES ('3','3','1326508678','2');
INSERT INTO `ycity_message` VALUES ('4','4','1326508678','1');
INSERT INTO `ycity_message` VALUES ('5','5','1326508678','1');
INSERT INTO `ycity_message` VALUES ('6','6','1326508678','2');
INSERT INTO `ycity_message` VALUES ('7','7','1326508688','1');
INSERT INTO `ycity_message` VALUES ('8','8','0','2');
INSERT INTO `ycity_message` VALUES ('9','9','1326508678','1');
INSERT INTO `ycity_message` VALUES ('10','10','0','2');
INSERT INTO `ycity_message` VALUES ('11','11','1328585593','1');
INSERT INTO `ycity_message` VALUES ('12','12','0','2');
INSERT INTO `ycity_message` VALUES ('13','1','0','2');
INSERT INTO `ycity_message` VALUES ('14','1','0','2');
INSERT INTO `ycity_message` VALUES ('15','1','0','2');
INSERT INTO `ycity_message` VALUES ('16','1','0','2');
INSERT INTO `ycity_message` VALUES ('17','1','0','2');
INSERT INTO `ycity_message` VALUES ('18','1','0','2');
-- 
-- 表的结构 `ycity_messagetext`
-- 
DROP TABLE IF EXISTS `ycity_messagetext`;
CREATE TABLE `ycity_messagetext` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sid` int(10) unsigned NOT NULL COMMENT '发送人id',
  `title` varchar(255) NOT NULL COMMENT '信息标题',
  `content` text NOT NULL COMMENT '信息内容',
  `pubTime` int(10) unsigned NOT NULL COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='信息内容';
-- 
-- 导出表中的数据 `ycity_messagetext`
--
INSERT INTO `ycity_messagetext` VALUES ('1','1','信息标题测试信息标题测试','<p>信息内容测试信息内容测试</p>','1381374487');
INSERT INTO `ycity_messagetext` VALUES ('2','1','信息标题测试信息标题测试2222','<p>信息内容测试信息内容测试2222</p>','1381374487');
INSERT INTO `ycity_messagetext` VALUES ('3','1','信息标题测试信息标题测试3333','<p>信息内容测试信息内容测试3333</p>','1381374487');
INSERT INTO `ycity_messagetext` VALUES ('4','1','信息标题测试信息标题测试4444','<p>信息内容测试信息内容测试4444</p>','1381374487');
INSERT INTO `ycity_messagetext` VALUES ('5','1','信息标题测试信息标题测试5555','<p>信息内容测试信息内容测试5555</p>','1381374487');
INSERT INTO `ycity_messagetext` VALUES ('6','2','信息标题测试信息标题测试6666','<p>信息内容测试信息内容测试6666</p>','1381374487');
INSERT INTO `ycity_messagetext` VALUES ('7','1','信息标题测试信息标题测试7777','<p>信息内容测试信息内容测试7777</p>','1381374488');
INSERT INTO `ycity_messagetext` VALUES ('8','1','全体站内信测试','<p>全体站内信测试全体站内信测试全体站内信测试</p>','1381475629');
INSERT INTO `ycity_messagetext` VALUES ('9','1','啊啊','啊啊啊啊','1381828017');
INSERT INTO `ycity_messagetext` VALUES ('10','1','啊啊','啊啊啊啊','1381828032');
INSERT INTO `ycity_messagetext` VALUES ('11','1','通知测试','通知测试','1381829097');
INSERT INTO `ycity_messagetext` VALUES ('12','1','果然果然个人','供热供热供热个额','1382255472');
-- 
-- 表的结构 `ycity_module`
-- 
DROP TABLE IF EXISTS `ycity_module`;
CREATE TABLE `ycity_module` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `module_title` varchar(100) NOT NULL COMMENT '中文',
  `module_name` varchar(50) NOT NULL DEFAULT '' COMMENT '模块名称',
  `module_permission` text NOT NULL COMMENT '包含权限',
  `system_module` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否内置',
  `left_menu` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示在管理菜单左侧',
  `developer` text NOT NULL COMMENT '开发者版权',
  `build_version` varchar(255) NOT NULL DEFAULT 'N/A' COMMENT '版本',
  `display_order` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='模块';
-- 
-- 导出表中的数据 `ycity_module`
--
INSERT INTO `ycity_module` VALUES ('4','导航管理','Menu','浏览=Menu_index|录入=Menu_insert|编辑=Menu_modify|批量操作=Menu_command','1','0','ycity','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('7','类别管理','Category','浏览=Category_index|编辑=Category_modify|批量操作=Category_update','1','0','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('8','新闻管理','News','浏览=News_index|编辑=News_modify|录入=News_insert|移动栏目=News_move|批量操作=News_command','1','1','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('9','产品管理','Product','浏览=Product_index|录入=Product_insert|编辑=Product_modify|批量操作=Product_command|订单管理=Product_order|移动类别=Product_move','0','1','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('10','下载管理','Download','浏览=Download_index|录入=Download_insert|编辑=Download_modify|批量操作=Download_command|移动栏目=Download_move','0','1','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('11','留言管理','Feedback','浏览=Feedback_index|录入=Feedback_insert|编辑=Feedback_modify|批量操作=Feedback_command','0','0','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('12','招聘管理','Job','浏览=Job_index|录入=Job_insert|编辑=Job_modify|应聘管理=Job_resume|批量操作=Job_command','0','0','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('13','公告管理','Notice','浏览=Notice_index|录入=Notice_insert|编辑=Notice_modify|批量操作=Notice_command','0','1','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('14','链接管理','Link','浏览=Link_index|录入=Link_insert|编辑=Link_modify|批量操作=Link_command','0','0','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('15','单页管理','Page','浏览=Page_index|录入=Page_insert|编辑=Page_modify|批量操作=Page_command','1','1','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('16','广告管理','Ad','浏览=Ad_index|录入=Ad_insert|编辑=Ad_modify|批量操作=Ad_command','0','0','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('27','Tags','Tags','管理=Tags','1','0','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('28','评论管理','Comment','浏览=Comment_index|回复=Comment_modify|批量操作=Comment_command','0','0','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('29','管理员管理','Admin','浏览=Admin_index|录入=Admin_insert|编辑=Admin_modify|批量操作=Admin_command','1','0','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('31','模板风格','Theme','管理=Theme','1','0','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('30','角色管理','AdminRole','浏览=AdminRole_index|录入=AdminRole_insert|编辑=AdminRole_modify|批量操作=AdminRole_command','1','0','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('32','模块管理','Module','浏览=Module_index|编辑=Module_modify|安装=Module_install|卸载=Module_uninstall','1','0','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('33','系统配置','Config','浏览系统配置=Config_index|编辑系统配置=Config_modify|浏览核心配置=Config_core|编辑核心配置=Config_coreModify','1','0','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('34','数据库管理','Database','浏览=Database_index|执行SQL=Database_query|备份数据库=Database_export|恢复数据库=Database_import','1','0','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('35','操作日志管理','AdminLog','管理=AdminLog','1','0','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('36','工具箱管理','Tools','管理=Tools','1','0','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('37','数据调用','Label','管理=Label','1','0','','','0','0','0','0');
-- 
-- 表的结构 `ycity_news`
-- 
DROP TABLE IF EXISTS `ycity_news`;
CREATE TABLE `ycity_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '类别',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `username` varchar(100) NOT NULL DEFAULT '' COMMENT '发布用户名',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `title_style` varchar(255) NOT NULL DEFAULT '' COMMENT '标题样式',
  `title_style_serialize` varchar(255) NOT NULL COMMENT '标题样式序列化',
  `keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `copy_from` varchar(255) NOT NULL DEFAULT '' COMMENT '来源',
  `from_link` varchar(255) NOT NULL DEFAULT '0' COMMENT '来源链接 ',
  `link_url` varchar(255) NOT NULL DEFAULT '' COMMENT '外链地址',
  `description` text NOT NULL COMMENT '简单描述',
  `content` mediumtext NOT NULL COMMENT '内容',
  `tags` varchar(255) NOT NULL COMMENT 'tags',
  `template` varchar(100) NOT NULL COMMENT '模板文件',
  `attach_file` varchar(100) NOT NULL COMMENT '附件',
  `istop` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '置顶',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '推荐',
  `display_order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `view_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '查看次数',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='新闻';
-- 
-- 导出表中的数据 `ycity_news`
--
INSERT INTO `ycity_news` VALUES ('1','0','1','admin','电风扇斯蒂芬斯蒂芬斯蒂芬','','','','','','','','<p>f斯蒂芬第三方的手法色粉第三方的手法三国的法规和投入和家人团聚日</p>','','','','0','0','0','0','5','1381939200','0');
-- 
-- 表的结构 `ycity_notice`
-- 
DROP TABLE IF EXISTS `ycity_notice`;
CREATE TABLE `ycity_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'udi',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `title_style` varchar(255) NOT NULL COMMENT '标题样式',
  `title_style_serialize` varchar(255) NOT NULL COMMENT '样式序列化',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `come_from` varchar(50) NOT NULL DEFAULT '' COMMENT '来源名称',
  `come_from_url` varchar(255) NOT NULL COMMENT '来源地址',
  `link_url` varchar(100) NOT NULL COMMENT '链接地址',
  `content` text NOT NULL COMMENT '内容',
  `template` varchar(100) NOT NULL COMMENT '模板文件',
  `tags` varchar(255) NOT NULL COMMENT 'tags',
  `fromDate` date NOT NULL DEFAULT '0000-00-00' COMMENT '开始时间',
  `toDate` date NOT NULL DEFAULT '0000-00-00' COMMENT '结束时间',
  `attach_file` varchar(100) NOT NULL DEFAULT '' COMMENT '附件文件',
  `keyword` varchar(250) NOT NULL COMMENT '关键字',
  `view_count` int(11) unsigned NOT NULL COMMENT '查看次数',
  `display_order` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '录入时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='公告';
-- 
-- 导出表中的数据 `ycity_notice`
--
INSERT INTO `ycity_notice` VALUES ('1','1','aaaa','','','','','','','<p>测试测试测试测试<br /></p>','','','2012-11-19','2012-12-19','Notice/50a99a192f51c.doc','','1','0','0','1353292313','0');
INSERT INTO `ycity_notice` VALUES ('2','1','个太热太热太热太热太热特特我惹是非','','','','','','','<p>vg的法规的好地方合法途径研究院统计at热啊</p>','','','2013-10-17','2013-11-16','','','1','0','0','1381980977','0');
-- 
-- 表的结构 `ycity_page`
-- 
DROP TABLE IF EXISTS `ycity_page`;
CREATE TABLE `ycity_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `link_label` char(50) NOT NULL DEFAULT '' COMMENT '链接标识',
  `keyword` varchar(250) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` text NOT NULL COMMENT '简述',
  `content` text NOT NULL COMMENT '内容',
  `template` varchar(100) NOT NULL COMMENT '模板',
  `attach_image` varchar(100) NOT NULL DEFAULT '' COMMENT '附件图片',
  `attach_thumb` varchar(100) NOT NULL DEFAULT '' COMMENT '附件缩略图',
  `attach_ext` varchar(50) NOT NULL COMMENT '附件类型',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否显示',
  `view_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '查看次数',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '录入时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='单页';
-- 
-- 导出表中的数据 `ycity_page`
--
INSERT INTO `ycity_page` VALUES ('1','学校简介','about','','','<p style=\"text-indent: 2em;\">天津启阳新程科技有限公司是一家致力于帮助企业进行信息化建设的高新技术企业。公司专业提供网站建设、网站改版、WEB系统开发、网站推广、网站优化、电子商务解决方案、动画设计制作、域名注册、主机服务、企业邮局注册等互联网服务，旨在降低企业上网的门槛，使更多的企业享受到互联网所带来的广阔市场和商机。</p><p style=\"text-indent: 2em;\">天津启阳新程科技有限公司依托自身完善的服务体系，强大的技术支持力量以及丰富的经验，先后为众多企事业单位提供网站品牌形象策划等网络服务，其中包括中国国家燃气用具质量监督检验中心、天津城市建设学院、<br />天津精卫映画科技有限公司、天津盛天教育信息咨询有限公司、天津市明日达照明工程有限公司等企事业单位。同时，公司亦为付大姐红娘站等社会公益组织提供网络平台。</p><p style=\"text-indent: 2em;\">新城网络自组建以来一直秉承为客户创造最大价值的理念，通过大胆的创新，专业的制作，用心的服务，将新城网络打造成为网络服务知名品牌，为客户提供一流服务。</p><p style=\"text-indent: 2em;\"><br /></p><p>选择我们，您可以：<br />&nbsp;&nbsp;&nbsp;&nbsp;<strong><span style=\"color: rgb(0, 170, 255)\">省心</span></strong>：我们将为您提供从网站策划、制作、维护、优化、域名备案等全方位一条龙服务，让您<strong><span style=\"color: rgb(0, 170, 255)\">省心</span></strong>!<br />&nbsp;&nbsp;&nbsp;&nbsp;<strong><span style=\"color: rgb(0, 204, 34)\">放心</span></strong>：我们为您提供的主机年在线率超过99%，杜绝网络访问时断时续，让您<strong><span style=\"color: rgb(0, 204, 34)\">放心</span></strong>！<br />&nbsp;&nbsp;&nbsp;&nbsp;<strong><span style=\"color: rgb(255, 0, 0)\">安心</span></strong>：我们为您提供的所有服务均包含至少一年的免费维护期，期间出现的一切问题由我们负责解决，让您<strong><span style=\"color: rgb(255, 0, 0)\">安心</span></strong>！<br /></p>','','','','','0','0','1970','1382258608');
INSERT INTO `ycity_page` VALUES ('2','联系我们','contact','','','<p>日前，骆惠宁当选为青海省省长。至此，我国5个“代理”省级地方行政首长均顺利转“正”。其他4位分别为：西藏自治区主席白玛赤林、重庆市市长黄奇帆、吉林省省长王儒林、河北省省长陈全国。</p><p>　　通过对内地31位省级地方行政首长的履历进行统计分析，记者发现，他们参加工作的平均年龄是19.5岁，都是从事基层的工作，大多人的第一份工作并非进入政坛。他们平均在23岁入党、29岁步入政坛，再在政坛经过25年的历练和成长，才能担当地方大员的重任。值得一提的是，在全国恢复高考这一年，至少有1/3人的命运被改变，他们顺利考取大学并毕业后，大多分入政府部门工作，并平步青云。</p><p>　　<strong>平均年龄57岁&nbsp;有两位“60后”</strong></p><p>　　内地现任31名省级地方行政首长中，有两位“60后”，新疆维吾尔自治区主席努尔·白克力，今年48岁，湖南省省长周强则是49岁；“50后”占31省份行政首长中的70%以上，有22人；“40后”有7人，其中最年长的是福建省省长黄小晶、浙江省省长吕祖善、广东省省长黄华华和贵州省省长林树森，均为63岁。</p><p>　　31人平均年龄57岁，正是年富力强，经验丰富的时候。我国规定正部级退休年龄为65岁，因此，在未来近10年，他们当中很多人将继续在我国政治舞台中发挥重要的作用。</p><p>　　据统计，现任31个省份党委“一把手”，有15人曾担任过省级地方行政首长，占近一半；在我国政治核心领导层中，也是如此，现任25名中央政治局委员，曾经担任过省级地方行政首长的有11人；9位中央政治局常委中，就有5人曾担任过省长。</p><p>　　<strong>超七成首份工作并非从政</strong></p><p>　　31名省级地方行政首长，参加工作的平均年龄为19.5岁，值得一提的是，他们当中，只有7人的第一份工作就进入基层的政府部门，只占22.6%；其他大部分人则是下乡当知青或车间工人、窑矿工人、工厂技术员、仓库管理员，还有的是部队服役战士，只有努尔·白克力的起点比较高，大学毕业就到新疆大学政治系任辅导员。</p>','','','','','0','0','1970','1349860800');
INSERT INTO `ycity_page` VALUES ('3','招募英才','job','','','<p>招募英才</p>','','','','','0','0','2010','1323330396');
-- 
-- 表的结构 `ycity_province`
-- 
DROP TABLE IF EXISTS `ycity_province`;
CREATE TABLE `ycity_province` (
  `id` tinyint(2) unsigned NOT NULL,
  `name` varchar(10) CHARACTER SET utf8 NOT NULL COMMENT '省市名称',
  `time` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '考试时间',
  `address` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '考试地点',
  `final_time` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '终审复试时间',
  `physical_time` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '体检时间',
  `recruit` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '是否招生，1为招生，2为不招生',
  `signupStatus` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '报名状态，1为未开始报名，2为开始报名',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '前台显示，0为不显示，1为显示',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='省市';
-- 
-- 导出表中的数据 `ycity_province`
--
INSERT INTO `ycity_province` VALUES ('11','北京','2013年1月27日 随报随考(上午8:30—11:30,下午13:30-16:30)','长沙市今朝大酒店（长沙市车站北路138号）','2013年1月29日  （具体地点考试时告知）','2013年1月28日  （具体地点考试时告知）','1','2','1','1379834621');
INSERT INTO `ycity_province` VALUES ('12','天津','2013年1月29日、1月30日 随报随考(上午8:30—11:30,下午13:30-16:30)','江苏教育学院（南京市鼓楼区北京西路77号）','2013年1月31日 (上午8:30开始，南航组织)','2013年2月1日  （具体地点考试时告知）','1','2','1','1379834625');
INSERT INTO `ycity_province` VALUES ('13','河北','2013.1.10','天津市西青区津静路26号','2013.9.20','2013.1.10','1','2','1','1382255105');
INSERT INTO `ycity_province` VALUES ('14','山西','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('15','内蒙古','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('21','辽宁','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('22','吉林','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('23','黑龙江','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('31','上海','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('32','江苏','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('33','浙江','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('34','安徽','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('35','福建','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('36','江西','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('37','山东','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('41','河南','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('42','湖北','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('43','湖南','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('44','广东','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('45','广西','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('46','海南','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('50','重庆','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('51','四川','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('52','贵州','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('53','云南','2013年1月6日 随报随考（上午8：30-11：30，下午13：30-16：30）','东航云南分公司培训中心（昆明市关上南路90号）','2013.1.3','2013年1月7日 （具体地点考试时告知）','1','2','1','1357093594');
INSERT INTO `ycity_province` VALUES ('54','西藏','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('61','陕西','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('62','甘肃','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('63','青海','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('64','宁夏','','','','','2','1','0','0');
INSERT INTO `ycity_province` VALUES ('65','新疆','2013.1.10','红桥区西青道与闸桥北路交口金兴科技大厦1511 ','2013.2.20','2013.3.15','1','2','1','1382254341');
-- 
-- 表的结构 `ycity_qa`
-- 
DROP TABLE IF EXISTS `ycity_qa`;
CREATE TABLE `ycity_qa` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mid` int(10) unsigned NOT NULL COMMENT '提问id',
  `rid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '回复id',
  `pid` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '省份',
  `title` varchar(38) CHARACTER SET utf8 NOT NULL COMMENT '标题',
  `content` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '提问内容',
  `reply` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '回复内容',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '显示状态，1为不公开显示，2为考生选择不公开显示，3为公开显示',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '提问时间',
  `reply_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '回复时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 COMMENT='考生问答';
-- 
-- 导出表中的数据 `ycity_qa`
--
INSERT INTO `ycity_qa` VALUES ('1','1326508678','1','12','考生问答测试1考生问答测试考生问答测试','考生问答测试考生问答测试考生问答测试','考生问答回复考生问答回复考生问答回复','3','1379831594','1379893594');
INSERT INTO `ycity_qa` VALUES ('2','1326508678','1','12','考生问答测试2考生问答测试考生问答测试考生问答测试考生问答测试考生问答测试考','考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2','考生问答回复2考生问答回复2考生问答回复2考生问答回复2考生问答回复2','3','1379831703','1379893594');
INSERT INTO `ycity_qa` VALUES ('3','1326508678','1','12','考生问答测试3考生问答测试考生问答测试','考生问答测试考生问答测试考生问答测试','考生问答回复考生问答回复考生问答回复','3','1379831594','1379893594');
INSERT INTO `ycity_qa` VALUES ('4','1326508678','1','12','考生问答测试4考生问答测试考生问答测试考生问答测试考生问答测试考生问答测试考','考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2','考生问答回复2考生问答回复2考生问答回复2考生问答回复2考生问答回复2','3','1379831703','1379893594');
INSERT INTO `ycity_qa` VALUES ('5','1326508678','1','12','考生问答测试5考生问答测试考生问答测试','考生问答测试考生问答测试考生问答测试','考生问答回复考生问答回复考生问答回复','3','1379831594','1379893594');
INSERT INTO `ycity_qa` VALUES ('6','1326508678','0','12','考生问答测试6考生问答测试考生问答测试考生问答测试考生问答测试考生问答测试考','考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2','','1','1379831703','0');
INSERT INTO `ycity_qa` VALUES ('7','1326508678','1','12','考生问答测试7考生问答测试考生问答测试','考生问答测试考生问答测试考生问答测试','考生问答回复考生问答回复考生问答回复','3','1379831594','1379893594');
INSERT INTO `ycity_qa` VALUES ('8','1326508678','1','12','考生问答测试8考生问答测试考生问答测试考生问答测试考生问答测试考生问答测试考','考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2','考生问答回复2考生问答回复2考生问答回复2考生问答回复2考生问答回复2','3','1379831703','1379893594');
INSERT INTO `ycity_qa` VALUES ('9','1326508678','1','12','考生问答测试9考生问答测试考生问答测试','考生问答测试考生问答测试考生问答测试','考生问答回复考生问答回复考生问答回复','3','1379831594','1379893594');
INSERT INTO `ycity_qa` VALUES ('10','1326508678','1','12','考生问答测试10考生问答测试考生问答测试考生问答测试考生问答测试考生问答测试','考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2','考生问答回复2考生问答回复2考生问答回复2考生问答回复2考生问答回复2','3','1379831703','1379893594');
INSERT INTO `ycity_qa` VALUES ('11','1326508678','1','12','考生问答测试11考生问答测试考生问答测试','考生问答测试考生问答测试考生问答测试','考生问答回复考生问答回复考生问答回复','1','1379831594','1379893594');
INSERT INTO `ycity_qa` VALUES ('12','1326508678','0','12','考生问答测试12考生问答测试考生问答测试考生问答测试考生问答测试考生问答测试','考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2','','1','1379831703','0');
INSERT INTO `ycity_qa` VALUES ('13','1326508678','0','12','考生问答标题测试考生问答标题测试考生问答标题测试','考生问答内容测试考生问答内容测试考生问答内容测试','','1','0','0');
INSERT INTO `ycity_qa` VALUES ('14','1326508678','0','12','考生问答标题测试考生问答标题测试考生问答标题测试','考生问答内容测试考生问答内容测试考生问答内容测试考生问答内容测试考生问答内容测试','','1','1381685843','0');
INSERT INTO `ycity_qa` VALUES ('15','1326508678','0','12','考生问答标题测试考生问答标题测试考生问答标题测试','考生问答内容测试考生问答内容测试考生问答内容测试考生问答内容测试考生问答内容测试','','2','1381685863','0');
INSERT INTO `ycity_qa` VALUES ('16','1326508678','0','12','xss测试','xss测试','','1','1381686183','0');
INSERT INTO `ycity_qa` VALUES ('18','1326508678','0','12','a&#39; or &#39;1&#39;=&#39;1','sql注入','','1','1381686734','0');
INSERT INTO `ycity_qa` VALUES ('19','1328522063','0','0','我要提问测试','看看看看','','1','1381732957','0');
INSERT INTO `ycity_qa` VALUES ('17','1326508678','0','12','&lt;script&gt;','&lt;script type=&quot;text/javascript&quot; src=&quot;http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js&quot;&gt;&lt;/script&gt;&lt;iframe src=&quot;http://www.cauc.edu.cn/&quot;&gt;&lt;/iframe&gt;','','1','1381686299','0');
INSERT INTO `ycity_qa` VALUES ('20','1328585593','0','53','家用燃气灶','测试测试测试测试测试测试测试测试测试测试测试侧hi','','1','1381733801','0');
INSERT INTO `ycity_qa` VALUES ('21','1328689241','0','13','提问测试','提问测试','','1','1381979672','0');
INSERT INTO `ycity_qa` VALUES ('22','1328689241','0','13','纷纷废物废物','非我非we范围额外范围分为','','1','1381980625','0');
INSERT INTO `ycity_qa` VALUES ('23','1326508678','0','12','不公开不公开','不公开不公开不公开','','2','1382253635','0');
INSERT INTO `ycity_qa` VALUES ('24','1328689241','1','13','提问测试   提问人测试','提问测试   提问人测试提问测试   提问人测试提问测试   提问人测试提问测试   提问人测试提问测试   提问人测试','惹我惹我惹我','3','1382255220','1382256267');
INSERT INTO `ycity_qa` VALUES ('25','1328689241','1','13','特务他惹我','退热贴额头','few纷纷','3','1382256292','1382256305');
INSERT INTO `ycity_qa` VALUES ('26','1326508678','0','12','省份省份省份省份省份省份','省份省份省份省份省份省份省份省份','','1','1382257421','0');
INSERT INTO `ycity_qa` VALUES ('27','1331371153','1','11','问答提问测试1110','问答提问测试问答提问测试问答提问测试问答提问测试问答提问测试','efewfrewfrewfrewfrw','3','1384055339','1384055389');
INSERT INTO `ycity_qa` VALUES ('28','1331450868','0','12','祝顺利！','祝顺利！','','1','1384134451','0');
INSERT INTO `ycity_qa` VALUES ('29','1331498782','0','11','2132323','123213213213131','','1','1384144508','0');
-- 
-- 表的结构 `ycity_role`
-- 
DROP TABLE IF EXISTS `ycity_role`;
CREATE TABLE `ycity_role` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL DEFAULT 'all' COMMENT '名称',
  `role_permission` text NOT NULL COMMENT '权限',
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '系统内置',
  `create_time` int(11) unsigned NOT NULL COMMENT '增加时间',
  `update_time` int(11) unsigned NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='管理员角色';
-- 
-- 导出表中的数据 `ycity_role`
--
INSERT INTO `ycity_role` VALUES ('1','超级管理','Menu_index,Menu_insert,Menu_modify,Menu_command,Category_index,Category_modify,Category_update,News_index,News_modify,News_insert,News_move,News_command,Product_index,Product_insert,Product_modify,Product_command,Product_order,Product_move,Download_index,Download_insert,Download_modify,Download_command,Download_move,Feedback_index,Feedback_insert,Feedback_modify,Feedback_command,Job_index,Job_insert,Job_modify,Job_resume,Job_command,Notice_index,Notice_insert,Notice_modify,Notice_command,Link_index,Link_insert,Link_modify,Link_command,Page_index,Page_insert,Page_modify,Page_command,Ad_index,Ad_insert,Ad_modify,Ad_command,Tags,Comment_index,Comment_modify,Comment_command,Admin_index,Admin_insert,Admin_modify,Admin_command,Template,AdminRole_index,AdminRole_insert,AdminRole_modify,AdminRole_command','1','0','0');
INSERT INTO `ycity_role` VALUES ('2','禁止访问','disable','1','0','0');
INSERT INTO `ycity_role` VALUES ('3','普通管理','News_index,News_modify,News_insert,News_move,News_command,File_modify,File_index,File_command,Archive_index','1','0','1317994448');
-- 
-- 表的结构 `ycity_signup`
-- 
DROP TABLE IF EXISTS `ycity_signup`;
CREATE TABLE `ycity_signup` (
  `id` int(10) unsigned NOT NULL,
  `category` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为文科，2为理科，3为综合',
  `schoolName` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '所在学校',
  `schoolPost` int(6) unsigned NOT NULL COMMENT '学校邮编',
  `mailAddress` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '邮递地址',
  `mailTel` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '邮递电话',
  `mailPost` int(6) unsigned NOT NULL COMMENT '邮递邮编',
  `alternateContact` varchar(10) CHARACTER SET utf8 NOT NULL COMMENT '备用联系人',
  `alternateMobile` bigint(11) unsigned NOT NULL COMMENT '备用联系手机',
  `image` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '照片地址',
  `image_thumb` varchar(255) CHARACTER SET utf8 NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `paymentTradeNo` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '支付接口交易号',
  `paymentTradeStatus` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '支付接口返回的交易状态',
  `paymentNotifyId` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '通知校验ID',
  `paymentNotifyTime` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '通知发送时间',
  `paymentBuyerEmail` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '支付者支付宝帐号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='报名信息';
-- 
-- 导出表中的数据 `ycity_signup`
--
INSERT INTO `ycity_signup` VALUES ('1331389645','1','天津城市建设学院','300384','津静公路26号','022-58018980','300380','叶海军','13622048617','Signup/201311/527f28b9e4f16.JPG','Signup/201311/527f28b9e4f16_s.JPG','1384065209','0','2013111037143118','TRADE_SUCCESS','RqPnCoPT3K9%2Fvwbh3I75K6b8v7aq1%2BWHK3soGxrMdp3nZ%2FpH0mearMxFRHzusfMq7VQN','2013-11-10 14:36:34','20020573@163.com');
INSERT INTO `ycity_signup` VALUES ('1331379320','1','天津城建大学','30084','天津城建大学','1362208617','300383','叶海军','13622048617','Signup/201311/527f47f4ec928.JPG','Signup/201311/527f47f4ec928_s.JPG','1384073204','0','2013111027109842','TRADE_SUCCESS','RqPnCoPT3K9%2Fvwbh3I75K6b9qPiW%2FB0Zw5dnr4%2BRb4PzbWZbJjNPT5V8EKoqz8ehTMDp','2013-11-10 16:47:49','y_city@163.com');
INSERT INTO `ycity_signup` VALUES ('1331498782','1','aoojjafljsa','0','afdfa','adsfasf','0','adfsa','0','Signup/201311/52803613d97fb.jpg','Signup/201311/52803613d97fb_s.jpg','1384134163','0','2013111124747144','TRADE_SUCCESS','RqPnCoPT3K9%2Fvwbh3I75K6c%2BS8Pb90zRZBMsTggZKgTpbAfsUZWIoPcRCNGH3W%2FqC3LR','2013-11-11 09:45:33','13516166596');
INSERT INTO `ycity_signup` VALUES ('1331488032','1','大学','300300','教务科','24092909','300000','教务科','89994858','Signup/201311/5280378803e03.jpg','Signup/201311/5280378803e03_s.jpg','1384134536','0','','','','','');
-- 
-- 表的结构 `ycity_tags`
-- 
DROP TABLE IF EXISTS `ycity_tags`;
CREATE TABLE `ycity_tags` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `tag_name` char(20) NOT NULL DEFAULT '' COMMENT '标签',
  `module` char(20) NOT NULL DEFAULT '' COMMENT '模块',
  `total_count` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '出现主题数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='tag标签';
-- 
-- 导出表中的数据 `ycity_tags`
--
-- 
-- 表的结构 `ycity_tags_cache`
-- 
DROP TABLE IF EXISTS `ycity_tags_cache`;
CREATE TABLE `ycity_tags_cache` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module` char(20) NOT NULL DEFAULT '' COMMENT '模块',
  `tag_name` char(20) NOT NULL COMMENT '标签名',
  `title_id` int(10) unsigned NOT NULL COMMENT '主题ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='tag主题关联';
-- 
-- 导出表中的数据 `ycity_tags_cache`
--
-- 
-- 表的结构 `ycity_user`
-- 
DROP TABLE IF EXISTS `ycity_user`;
CREATE TABLE `ycity_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '角色组',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `alias` varchar(50) NOT NULL COMMENT '别名',
  `sex` char(5) NOT NULL DEFAULT '男' COMMENT '性别',
  `college` varchar(50) NOT NULL COMMENT '学院',
  `telephone` varchar(50) NOT NULL COMMENT '电话',
  `mobile` varchar(50) NOT NULL COMMENT '手机',
  `fax` varchar(50) NOT NULL COMMENT 'FAX',
  `e-mail` varchar(50) NOT NULL COMMENT '电子邮件',
  `qq` varchar(50) NOT NULL COMMENT 'QQ',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '会员状态',
  `reg_ip` varchar(20) NOT NULL DEFAULT '0.0.0.0' COMMENT '注册IP',
  `login_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `last_login_ip` varchar(20) NOT NULL DEFAULT '0.0.0.0' COMMENT '最后登录IP',
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `userid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='管理员';
-- 
-- 导出表中的数据 `ycity_user`
--
INSERT INTO `ycity_user` VALUES ('1','1','admin','d9637d9c684ba63b5b1b05e1f578495a80a0a25a','系统管理员','男','0','05560000000','13900000000','022-58018980','20020573@163.com','5565907','2','','159','1306847872','1306847872','0.0.0.0','1384148629','0');