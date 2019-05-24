-- Y-cityCMS SQL Dump
-- Time:2013-11-20 13:05:50
-- http://www.y-city.net.cn 

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
INSERT INTO `ycity_audition` VALUES ('1328585593','22','0','0','0');
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
-- 表的结构 `ycity_comment`
-- 
DROP TABLE IF EXISTS `ycity_comment`;
CREATE TABLE `ycity_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` char(20) NOT NULL DEFAULT 'News' COMMENT '模块',
  `title_id` int(11) unsigned NOT NULL COMMENT '文章ID',
  `title` varchar(255) NOT NULL COMMENT '文章标题',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `ip` char(15) NOT NULL DEFAULT '' COMMENT 'ip',
  `content` text NOT NULL COMMENT '评论内容',
  `reply_content` text NOT NULL COMMENT '评论回复',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '提交时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='评论';
-- 
-- 导出表中的数据 `ycity_comment`
--
INSERT INTO `ycity_comment` VALUES ('1','News','1','测试评论测试评论','mchunt','nz8864@sian.com','192.168.0.100','测试评论测试评论测试评论测试评论测试评论测试评论测试评论测试评论测试评论测试评论测试评论测试评论测试评论测试评论','asdasdasdad','0','1319514931','1319526199');
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
-- 表的结构 `ycity_download`
-- 
DROP TABLE IF EXISTS `ycity_download`;
CREATE TABLE `ycity_download` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '软件名称',
  `title_style` varchar(255) NOT NULL DEFAULT '' COMMENT '样式',
  `title_style_serialize` varchar(255) NOT NULL COMMENT '样式序列化',
  `category_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '类别',
  `keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `run_system` varchar(255) NOT NULL DEFAULT 'windows' COMMENT '运行系统',
  `extension` varchar(10) NOT NULL DEFAULT 'zip' COMMENT '扩展名',
  `file_size` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '大小',
  `file_size_unit` char(10) NOT NULL DEFAULT 'KB' COMMENT '大小单位',
  `download_url` text NOT NULL COMMENT '下载地址1',
  `link_url` varchar(100) NOT NULL COMMENT '外链',
  `description` text NOT NULL COMMENT '简单描述',
  `content` text NOT NULL COMMENT '介绍',
  `tags` varchar(255) NOT NULL COMMENT 'tags',
  `template` varchar(100) NOT NULL COMMENT '模板文件',
  `file_attach` varchar(50) NOT NULL DEFAULT '' COMMENT '附件地址',
  `attach` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '附件',
  `attach_image` varchar(50) NOT NULL DEFAULT '' COMMENT '附件大图',
  `attach_thumb` varchar(50) NOT NULL DEFAULT '' COMMENT '缩略图',
  `view_count` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '查看次数',
  `istop` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '置顶',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '推荐',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `display_order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='下载';
-- 
-- 导出表中的数据 `ycity_download`
--
INSERT INTO `ycity_download` VALUES ('1','1','泄露个人信息 铁道部坦承是个问题 ','','','15','','','zip','0','KB','test','','泄露个人信息 铁道部坦承是个问题 ','<p style=\"text-indent: 2em\">环球网记者范凌志报道，台湾前&ldquo;副总统&rdquo;吕秀莲本周访问美国华府。她在与美方人士会面时称，美国虽然持续对台军售，但不能忽略台湾&ldquo;自我防卫&rdquo;的需求，应该&ldquo;尽快考虑出售F16C/D型战机&rdquo;。</p>\r\n<p style=\"text-indent: 2em\">据台湾&ldquo;中央社&rdquo;24日消息，吕秀莲此行已与美国国务院、美国在台协会（AIT）官员见面，并拜会了美国多位涉台机构官员。</p>\r\n<p style=\"text-indent: 2em\">吕秀莲称，对于美国政府决定新一波的对台军售，台湾当然&ldquo;很感谢&rdquo;，但&ldquo;遗憾的是F16C/D型战机仍未纳入&rdquo;。美方亲台官员与议员还说，洛克希德马丁公司（LockheedMartin）万一关闭F16生产线，台湾要取得F-35战机将&ldquo;更为困难&rdquo;。</p>\r\n<p style=\"text-indent: 2em\">同时，&ldquo;台湾连线&rdquo;共同主席、共和党籍众议员狄亚士巴拉特（Lincoln Diaz-Balart）等人承诺&ldquo;将发动国会连署&rdquo;要求行政部门尽快决定F16C/D的军售案。</p>\r\n<p style=\"text-indent: 2em\">此前，美联社及路透两大国际通讯社在22日都在台北发布新闻，指根据美国政府最新公布的报告指出，台湾在与大陆进行战斗时，&ldquo;可供作战的战机数量将不敷使用，也凸显台湾空防战力已有&lsquo;不堪一击&rsquo;的危机&rdquo;。</p>\r\n<p style=\"text-indent: 2em\">路透认为，这份报告可能促成美国在肯定触怒北京的情况下，对台提供新的军售，以确保台海情势稳定；美联社则点出，美国防部强烈怀疑：台湾是否拥有足够</p>','','','','0','','','0','0','0','0','0','1266940800','0');
INSERT INTO `ycity_download` VALUES ('2','1','广西公务员考试涉嫌试题泄露 已立案调查 ','color:#800080;font-weight:bold','a:2:{s:5:\"color\";s:7:\"#800080\";s:4:\"bold\";s:4:\"bold\";}','15','','','zip','0','KB','http://test.com\r\nhttp://www.sss.com','http://www.sss.com','','<p style=\"text-indent: 2em\">吕秀莲称，对于美国政府决定新一波的对台军售，台湾当然&ldquo;很感谢&rdquo;，但&ldquo;遗憾的是F16C/D型战机仍未纳入&rdquo;。美方亲台官员与议员还说，洛克希德马丁公司（LockheedMartin）万一关闭F16生产线，台湾要取得F-35战机将&ldquo;更为困难&rdquo;。</p>\r\n<p style=\"text-indent: 2em\">同时，&ldquo;台湾连线&rdquo;共同主席、共和党籍众议员狄亚士巴拉特（Lincoln Diaz-Balart）等人承诺&ldquo;将发动国会连署&rdquo;要求行政部门尽快决定F16C/D的军售案。</p>\r\n<p style=\"text-indent: 2em\">此前，美联社及路透两大国际通讯社在22日都在台北发布新闻，指根据美国政府最新公布的报告指出，台湾在与大陆进行战斗时，&ldquo;可供作战的战机数量将不敷使用，也凸显台湾空防战力已有&lsquo;不堪一击&rsquo;的危机&rdquo;。</p>\r\n<p style=\"text-indent: 2em\">路透认为，这份报告可能促成美国在肯定触怒北京的情况下，对台提供新的军售，以确保台海情势稳定；美联社则点出，美国防部强烈怀疑：台湾是否拥有足够抵御大陆攻击的能力。</p>\r\n<p style=\"text-indent: 2em\">台空军对此表示，美方正在评估台湾采购F-16C/D的可行性，目前台方尚未取得这份报告，因此不便对媒体报道评论。而台当局高层官员则分析称，美国官方刻意将这份报告提供给国际媒体并选在台北发出，是向两岸发出极为明显的政治讯息，可能是为宣布出售F-16C/D给台湾进行&ldquo;暖身铺路&rdquo;，台湾静观这项发展，并&ldquo;将会做好准备&rdquo;。</p>','了修正,55,aaaxxx','','','0','','','0','0','0','0','0','1266940800','0');
INSERT INTO `ycity_download` VALUES ('3','1','fsg','','','17','','','zip','0','MB','fsg','','fasdf','<p>fsg</p>','fsdf','','','1','Download/201003/4b910457af736.jpg','Download/201003/4b910457af736_s.jpg','0','0','0','0','0','1267718400','0');
INSERT INTO `ycity_download` VALUES ('4','1','asdf','','','15','','','zip','0','MB','asdf','','','<p>fasdf</p>','','','','1','Download/201003/4b91048378829.gif','Download/201003/4b91048378829_s.gif','0','0','0','0','0','1267718400','0');
INSERT INTO `ycity_download` VALUES ('5','1','ccc','','','15','','','zip','0','MB','cc','','','<p>cc</p>','了修正,55,fadsf,hghdf','','','0','','','0','0','0','0','0','1267891200','0');
-- 
-- 表的结构 `ycity_forum`
-- 
DROP TABLE IF EXISTS `ycity_forum`;
CREATE TABLE `ycity_forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `content` text NOT NULL COMMENT '留言内容',
  `reply_content` text NOT NULL COMMENT '回复内容',
  `status` smallint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `ip` char(15) NOT NULL DEFAULT '0' COMMENT '留言IP',
  `reply_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '回复时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '留言时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='留言';
-- 
-- 导出表中的数据 `ycity_forum`
--
INSERT INTO `ycity_forum` VALUES ('1','3','提问题问题提问题问题提问题问题提问题问题提问题问题提问题问题提问题问题提问题问题提问题问题提问题问题提问题问题提问题问题提问题问题提问题问题提问题问题提问题问题提问题问题提问题问题提问题问题提问题问题','回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复回复','1','127.0.0.1','1327163768','1319111537','0');
INSERT INTO `ycity_forum` VALUES ('2','2','商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购商品求购','','1','127.0.0.1','1329163768','1319163768','0');
INSERT INTO `ycity_forum` VALUES ('3','3','短发三翻四复sere他依然有图与i一你爸爸女女','','0','127.0.0.1','0','1351686250','0');
INSERT INTO `ycity_forum` VALUES ('4','3','tiwenyixia','','0','192.168.0.111','0','1351752268','0');
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
-- 表的结构 `ycity_instruction`
-- 
DROP TABLE IF EXISTS `ycity_instruction`;
CREATE TABLE `ycity_instruction` (
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='新闻';
-- 
-- 导出表中的数据 `ycity_instruction`
--
INSERT INTO `ycity_instruction` VALUES ('1','0','1','admin','一、免费注册','','','','','','','','<p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">1</span><span style=\"font-size:12.0pt;font-family:宋体\">、注册前请考生准备好常用邮箱、本人身份证、明确高考所在地。注册提交后将无法修改上述信息。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">2</span><span style=\"font-size:12.0pt;font-family:宋体\">、每位考生的身份证号码只能注册一次，请考生本人认真填写相关内容（严禁代报）。</span></p>','','','','0','0','0','7','0','1384790400','1384912991');
INSERT INTO `ycity_instruction` VALUES ('2','0','1','admin','二、登录报名','','','','','','','','<p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">注：请考生如实填写网报信息，凡不按公告要求报名、网报信息误填、错填或填报虚假信息而造成不能考试的，后果由考生本人承担。（红色字体标注）</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span>1.</span><span style=\"font-size:12.0pt;font-family:宋体\">问：如何进行网上报名<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：首先需要免费注册为乘务学院招生信息网用户，点击主页面用户注册按钮，按照提示及要求进行注册。注册成功后，请登陆注册邮箱，查询是否收到用户激活码，确认收到后，点击页面菜单栏中的<span>&quot;</span>登录报名<span>&quot;</span>链接，输入激活码，即可确认注册。登录后，产生<span>10</span>位数字的用户识别号，点击在线缴费，核实个人信息无误后，即可确认提交。请牢记注册邮箱、登陆密码和用户识别号等信息。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　注意：请牢记用户识别号，如果当前状态为未报名，须点击在线缴费，进行网上缴费，缴费成功后才算报名成功。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>2.</span>问：报考空中乘务专业及民航空中安全保卫专业是否必须进行网上报名<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：<span>2014</span>年中国民航大学空中乘务专业及民航空中安全保卫专业的专业报名全面实行网上报名，所有中国民航大学独立组织专业测试的省份地区的考生都应该参加网上报名。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">将按照重庆市教育考试院的统一安排进行选拔。重庆市的考生不必在我校招生网站中注册报名。重庆市考生请密切关注重庆市教育考试院公布的具体要求及日程安排。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>3.</span>问：网上注册报名的有效时间<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：网上缴费截止时间：自网络报名开通之日起至各地区报名考试当天初试结束（以考试日程公布时间为准）。截至时间以后，考生无法参加考试，缴费无效。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>4.</span>问：我校未涉及招收空中乘务专业及民航空中安全保卫专业的省份地区的考生可以网上报名吗<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：<span>2014</span>年我校在全国<span>22</span>个省份地区招收空中乘务专业及民航空中安全保卫专业，未涉及地区考生不得报考，一旦报考，不予退费。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>5.</span>问：姓名不能正常显示<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：考生姓名或家庭地址在填写报考信息的时候可以使用打字法输入，但是保存以后却成了“<span>??</span>”或“？”。出现缘由：由于部分考生姓名或家庭地址中含有部分生僻字，即：比较少见的字，导致在网页中无法正常显示。解决办法：网上报名的时候不用处理，在现场确认个人报考信息的时候申请修改。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>6.</span>问：在注册过程中未收到邮箱注册激活码，但显示用户邮箱已注册或身份证信息已注册，如何处理？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：注册中确认未收到激活码，如果确认是自己的身份证号被报过名，可以将本人手持身份证照片及身份证扫描件，发送至<span>cwxy@cauc.edu.cn,</span>并致电<span>022-24092909</span>，经核实后进行处理。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">，</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span>7.</span><span style=\"font-size:12.0pt;font-family:宋体\">问：忘记登陆密码，如何处理？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">答：已在本系统中注册过的用户需要使用注册过的邮箱和密码登陆。忘记密码请点击“忘记密码”输入注册邮箱及姓名，将自动发送新的密码到注册邮箱。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;</span><span style=\"\">&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">注意：用户注册所填写的电子邮箱地址是找回密码的重要途径，请认真填写有效电子邮件地址，使用英文半角输入。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span>8.</span><span style=\"font-size:12.0pt;font-family:宋体\">问：页面无法显示，如何处理？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">答：请关闭或卸载有窗口拦截功能的软件，例如：<span>IE</span>用户必须关闭“弹出窗口阻止程序”。（关闭方法：打开<span>Internet&nbsp;Explorer</span>，在“工具”菜单中，指向“弹出窗口阻止程序”，然后单击“关闭弹出窗口阻止程序”即可）；强烈建议使用<span>IE7.0</span>及以上版本兼容浏览器。&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">9.</span><span style=\"font-size:12.0pt;font-family:宋体\">问：注册须知页面中，考生高考所在地区、身份证号码及姓名不可修改，怎么办<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：考生在注册页面中，应正确选择高考报考所在地，若个人原因选择错误，或填写错误，可以将所提问题，本人手持身份证照片、身份证扫描件或用户识别号，发送至<span>cwxy@cauc.edu.cn,</span>并致电<span>022-24092909</span>。</span></p>','','','','0','0','0','6','0','1384790400','0');
INSERT INTO `ycity_instruction` VALUES ('3','0','1','admin','三、现场确认','','','','','','','','<p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>1.</span>问：现场确认程序如何<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　现场确认程序如下：</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　考生携带本人第二代居民身份证（原件）、中国民航大学专业测试登记表、近期一寸彩色照片<span>2</span>张，按照我校考试日程中公布的时间地点，由我校工作人员进行审核确认。报考点工作人员发现伪造证件时应通知公安机关并配合公</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">安机关暂扣相关证件，并上报当地招生教育考试部门。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　注意：（<span>1</span>）所有考生均要对本人网上报名信息进行认真核对并确认。经考生确认的报名信息在考试、复试及录取阶段一律不作修改，因考生填写错误引起的一切后果由其自行承担。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　（<span>2</span>）按艺术类招生的各地区考生须携带各省市招办发放的艺术类准考证原件和复印件。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span>2.</span><span style=\"font-size:12.0pt;font-family:宋体\">问：现场确认时二代身份证遗失或正补办中如何处理？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">答：考生可在所在地户籍管理部门开具户籍证明，或在火车站、机场等派出所开具临时身份证明。</span></p><p><br /></p>','','','','0','0','0','5','0','1384790400','0');
INSERT INTO `ycity_instruction` VALUES ('4','0','1','admin','四、报考及考试方式','','','','','','','','<p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">1</span><span style=\"font-size:12.0pt;font-family:宋体\">、凡有意报考的考生，请详细阅读我校招生简章上的内容。注册报名之前请确认如下事项：你是否能够参加<span>2014</span>年高考（秋季），确认我校是否在你高考所在地区有招生计划；是否你的身高在我校标准范围内；是否你符合我校在你所高考在地区的招生类别要求。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">2</span><span style=\"font-size:12.0pt;font-family:宋体\">、我校空中乘务专业仅限女生报考，民航空中安全保卫专业仅限男生报考，上述两个专业学历层次为专科。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">3</span><span style=\"font-size:12.0pt;font-family:宋体\">、实行“订单式”校企联合招生的地区，具体招生条件及要求以我校招生网公布信息为准。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">4.</span><span style=\"font-size:12.0pt;font-family:宋体\">问：普通文理类考生有专业测试成绩吗<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：按照普通文理类招生的地区，考生无专业成绩，只有合格。按照普通文、理类招生的地区，根据考生填报我校志愿顺序，按照高考成绩，由高分到低分择优录取，相同分数下，根据</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">高考英语成绩由高到低择优录取。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">5.</span><span style=\"font-size:12.0pt;font-family:宋体\">问：艺术类地区考生专业成绩如何测算<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：专业测试成绩总分为<span>120</span>分（面试成绩<span>100</span>分，英语语言能力<span>20</span>分）</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">6.</span><span style=\"font-size:12.0pt;font-family:宋体\">问：我校投放招生计划地区，但由当地招生教育主管部门统一实行联考，如何报名考试？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">答：<span>2014</span>年仅重庆地区实行统一考试。我校将不单独组织考试，我校将参加重庆市教育考试院的联考，我校将按照重庆市教育考试院的统一安排进行选拔。重庆市的考生不必在我校招生网站中注册报名。重庆市考生请密切关注重庆市教育考试院公布的具体要求及日程安排。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">7.</span><span style=\"font-size:12.0pt;font-family:宋体\">校企联合培养注意事项？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">答：<span>2014</span>年我校分别与中国南方航空股份有限公司、山东航空股份有限公司、中国东方航空股份有限公司和天津航空有限责任公司在全国<span>10</span>个省市联合招收“订单式”联合培养学生，具体招生简章请关注网站通知公告。在校企合作招生地区，凡通过我校复试环节的考生，均有资格自愿参加各航空公司组织的“联合培养学生”资格选拔，取得航空公司联合培养资格的考生，须与航空公司签订确认书，公司终审当天需要一位考生家长陪同，请考生和家长提前做好准备。</span></p>','','','','0','0','0','4','0','1384790400','0');
INSERT INTO `ycity_instruction` VALUES ('5','0','1','admin','五、填写个人基本信息','','','','','','','','<p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>1.</span>问：网报过程中，填写考生姓名时应注意什么<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：输入姓名时要输入真实汉语名字，顶格书写，汉字与汉字中间不可有空格，输入法中无法找到的汉字，可用<span>&quot;?&quot;</span>代替，一个<span>&quot;?&quot;</span>代替一个汉字。少数民族考生名字中的点，请输入英文状态下的小数点就可以。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>2.</span>问：姓名拼音项规则<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：最多输入<span>80</span>个字节的半角字符。要求顶格连续填写，并且不可有空格，大小写均可。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>3.</span>问：证件类型填写事项<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：仅限大陆居民第二代身份证，身份证最后一位为<span>X</span>为小写。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　考生需持合法有效的证件至报考点进行现场确认和参加考试。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>4.</span>问：考生通讯地址一项重要吗<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：通讯地址为考生接收专业合格通知书、录取通知书的有效地址，考生必须准确填写。如须更改请将本人手持身份证照片、身份证扫描件或用户识别号，发送至<span>cwxy@cauc.edu.cn,</span>并</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">致电<span>022-24092909</span>。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>5.</span>问：考生联系方式重要吗<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：十分重要。请填写可随时联系的电话。考生在填写固定电话时应注意区号、分机号可以用<span>&quot;-&quot;</span>分开。多个电话可以用逗号“，”分开，最多可输入<span>40&nbsp;</span>个字节的字符。填写移动电话最多输入<span>11</span>个字节的数字。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>6.</span>问：如何填写毕业院校名称<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：毕业学校为你学籍所在学校，最多输入<span>50</span>个字节的字符。</span></p>','','','','0','0','0','3','1','1384790400','0');
INSERT INTO `ycity_instruction` VALUES ('6','0','1','admin','六、关于网上缴费','','','','','','','','<p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　问：如何判断网报是否已成功交费<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>(1)</span>通过登陆邮箱和密码登录到报名系统中当前状态应该为报名完成。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>(2)</span>查看银行卡消费记录，已扣费即已成功缴费，特殊情况下，乘务学院招生信息网状态可能没有变为已交费状态，请考生不用担心。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">（<span>3</span>）本缴费系统，仅支持支付宝缴费，缴费之前请确认支付宝内账户余额充足。否则无法报名缴费。如出现支付宝扣款已完成，报名系统提示当天状态为：未缴费。将您的身份证号码、</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">姓名、支付宝扣款成功的截图发邮件到<span>cwxy@cauc.edu.cn</span>，并致电<span>022-24092909</span>。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">问：网上缴费是否有时间限制？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">答：网上缴费截止时间：自网络报名开通之日起至各地区报名考试当天初试结束（以考试日程公布时间为准）。截至时间以后，考生无法参加考试，缴费无效。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">问：网上支付是否一定要用本人的银行卡或支付宝账号？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">答：只要是有效的银行卡都可以进行网上支付，详情请咨询银行卡所属银行。只须确认支付宝余额充足即可缴费。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">问：因个人原因无法参加考试是否退款？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">答：因个人原因无法参加考试的考生，无法退款，请考生报名缴费前慎重选择。</span></p>','','','','0','0','0','2','1','1384790400','0');
INSERT INTO `ycity_instruction` VALUES ('7','0','1','admin','七、重要提醒','','','','','','','','<p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">《中国民航大学<span>2014</span>年空中乘务及民航空中安全保卫专业招生简章》<span>)</span>已于今天公布。针对<span>2014</span>年新的报考方式，乘务学院招生信息网整理几点重要提醒，望考生多加留意。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　一、招生省份及招生类别的变化</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>2014</span>年面向全国<span>22</span>个省市地区招生，计划按照艺术类招生地区：辽宁、山东、陕西、吉林、江西，艺术文、艺术理兼收，播音主持、音乐、美术、模特等专业考生均可报考。计划按照普通文、理类招生地区：北京、天津、上海、重庆、江苏、四川、湖南、湖北、山西、浙江、河北、云南、安徽、贵州、广西、内蒙古、黑龙江，文、理兼收。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　提醒：<span>1</span>、凡<span>2014</span>年未涉及招生地区的考生一律不得报考；<span>2014</span>年江苏、黑龙江根据当地招生主管部门统一要求，按照普通文理类进行招生。按照普通文理类招生地区的艺术类考生，若要报考上述两专业，须兼报普通文理类后，方可报考。<span>2</span>、我校<span>2014</span>年中乘务专业、民航空中安全保卫专业实行统一计划，《<span>2014</span>年简章》中计划数为预计划数，我校将根据各省考生报考面试情况分配各省（市）计划。具体各专业计划数以各省（市）考试院<span>(</span>招办<span>)</span>实际公布计划为准。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　二、<span>2014</span>年全面实行网络报名</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>2014</span>年中国民航大学乘务学院招生信息网升级改造完成，全面推行网络报名，网络缴费。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">提醒：<span>1</span>、请考生根据报考条件慎重选择是否报考，因报考涉及缴费，一旦报考后，因个人原因无法参加考试，不予退款。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">2</span><span style=\"font-size:12.0pt;font-family:宋体\">、重庆地区：我校不单独组织校考，将参加重庆市教育招生考试院组织的联考，重庆考生不须参加我校网络报名，具体相关事宜，将按照重庆市教育招生考试院统一安排进行。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　三、报名注意事项</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　网上报名需要填写或选择的内容以及要求，除明确说明可不填写外，其他均为必填选项，考生要提前准备，以免在网报期间由于单个页面停滞时间过长导致报名失败。用户注册所填写的电子邮箱地址是找回密码的重要途径，请认真填写有效电子邮件地址，使用英文半角输入。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　<span><span style=\"\">&nbsp;&nbsp;&nbsp;</span></span>四、报考条件及要求</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">请报考考生参照《中国民航大学<span>2014</span>年空中乘务及民航空中安全保卫专业招生简章》上的条件及要求报考。凡不符合简章中相应要求的考生，请勿报考，因此造成的后果，由考生本人承担。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">五、现场确认要求</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　考生携带本人第二代居民身份证（原件）、中国民航大学专业测试登记表、近期一寸彩色照片<span>2</span>张，按照我校考试日程中公布的时间地点，由我校工作人员进行审核确认。报考点工作人员发现伪造证件时应通知公安机关并配合公</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">安机关暂扣相关证件，并上报当地招生教育考试部门。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　注意：<span>1</span>、所有考生均要对本人网上报名信息进行认真核对并确认。经考生确认的报名信息在考试、复试及录取阶段一律不作修改，因考生填写错误引起的一切后果由其自行承担。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>2</span>、按艺术类招生的各地区考生须携带各省市招办发放的艺术类准考证原件和复印件。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　六、咨询方式</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>1.</span>中国民航大学乘务学院招生网官方微博</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>2.</span>中国民航大学乘务学院招生官方公众微信号</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span>3.</span><span style=\"font-size:12.0pt;font-family:宋体\">咨询邮箱：<span>cwxy@cauc.edu.cn<span style=\"\">&nbsp;&nbsp;&nbsp;</span></span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span>4.</span><span style=\"font-size:12.0pt;font-family:宋体\">联系电话：<span>022-24092909<span style=\"\">&nbsp;&nbsp;</span></span>（咨询时间：周一至周五早<span>9</span>：<span>00-11</span>：<span>30&nbsp;</span>，下午<span>14</span>：<span>00-16</span>：<span>30</span>）</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">七、乘务学院招生信息网为中国民航大学官方唯一授权网站，本网站中涉及的招生工作未与任何教育培训机构或个人达成任何委托或授权协议，凡假借我校名义开展的各类招生培训及承诺协助入学等违法活动，我校将保留对此类行为的法律追诉权利。请广大考生及家长注意！</span></p>','','','','0','0','0','1','3','1384790400','1384913000');
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
-- 表的结构 `ycity_link`
-- 
DROP TABLE IF EXISTS `ycity_link`;
CREATE TABLE `ycity_link` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '网站名称',
  `title_style` varchar(255) NOT NULL COMMENT '标题样式',
  `title_style_serialize` varchar(255) NOT NULL COMMENT '标题样式序列化',
  `category_id` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '链接类型：首页，内页，论坛,文字',
  `link_type` enum('text','image') NOT NULL DEFAULT 'text' COMMENT '链接类型',
  `link_url` varchar(255) NOT NULL DEFAULT '' COMMENT '地址',
  `description` text NOT NULL COMMENT '简介',
  `attach_image` varchar(50) NOT NULL DEFAULT '' COMMENT '附件图片',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '首页显示、内页显示等显示方式',
  `display_order` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '排序数值，越小排得越前',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '录入时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '重新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='链接';
-- 
-- 导出表中的数据 `ycity_link`
--
INSERT INTO `ycity_link` VALUES ('1','新城网络','color:#ff0000;font-weight:bold','a:2:{s:5:\"color\";s:7:\"#ff0000\";s:4:\"bold\";s:4:\"bold\";}','1','text','http://www.y-city.net.cn','','','0','0','1266392534','0');
INSERT INTO `ycity_link` VALUES ('2','天津IDC','font-weight:bold','a:1:{s:4:\"bold\";s:4:\"bold\";}','36','text','http://www.idctj.com','','','0','0','1266392534','1319440723');
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
INSERT INTO `ycity_member` VALUES ('1332382972','349026384@qq.com','18d59bc4391f88c806fce28ef7d8fb54027ec7e9','叶海军','2','1988-10-02','340826198810022650','13622048617','11','00fJRZHpbe9Vc8jTLfGa','4','1384912262','0','0','0.0.0.0','0');
INSERT INTO `ycity_member` VALUES ('1332397662','285783013@qq.com','e7d96213f37045c60997842343f2c38ecec0e018','姚晓峰','2','1986-11-11','120102198611112354','13662086010','65','O0uaRPwSO9fGUcOQ0tG0','3','1384914503','0','0','0.0.0.0','0');
-- 
-- 表的结构 `ycity_menu`
-- 
DROP TABLE IF EXISTS `ycity_menu`;
CREATE TABLE `ycity_menu` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '标题',
  `title_style` varchar(255) NOT NULL COMMENT '标题样式',
  `title_style_serialize` varchar(255) NOT NULL COMMENT '标题模式序列化',
  `parent_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '上级',
  `link_url` varchar(100) NOT NULL DEFAULT '' COMMENT '跳转URL',
  `target` varchar(10) NOT NULL DEFAULT '_blank' COMMENT '新窗口',
  `display_order` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '录入时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='导航';
-- 
-- 导出表中的数据 `ycity_menu`
--
INSERT INTO `ycity_menu` VALUES ('1','新城网络','','','0','http://www.y-city.net.cn','_blank','0','0','1267540911','1267541659');
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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='信息列表';
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
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='模块';
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
INSERT INTO `ycity_module` VALUES ('17','案例管理','Case','浏览=Product_index|录入=Product_insert|编辑=Product_modify|批量操作=Product_command|移动类别=Product_move','0','1','','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('106','服务管理','Service','浏览=Service_index|录入=Service_insert|编辑=Service_modify|批量操作=Service_command','0','1','ycity','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('107','推广管理','Promotion','浏览=Promotion_index|录入=Promotion_insert|编辑=Promotion_modify|批量操作=Promotion_command','0','1','ycity','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('18','订单管理','Order','浏览=Order_index|编辑=Order_modify|批量操作=Order_command','0','1','ycity','2.0','0','0','0','0');
INSERT INTO `ycity_module` VALUES ('108','建站管理','Website','浏览=Website_index|录入=Website_insert|编辑=Website_modify|批量操作=Website_command','0','1','ycity','2.0','0','0','0','0');
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
) ENGINE=MyISAM AUTO_INCREMENT=135 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='新闻';
-- 
-- 导出表中的数据 `ycity_news`
--
INSERT INTO `ycity_news` VALUES ('134','0','1','admin','电风扇斯蒂芬斯蒂芬斯蒂芬','','','','','','','','<p>f斯蒂芬第三方的手法色粉第三方的手法三国的法规和投入和家人团聚日</p>','','','','0','0','0','0','2','1381939200','0');
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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='公告';
-- 
-- 导出表中的数据 `ycity_notice`
--
INSERT INTO `ycity_notice` VALUES ('19','1','aaaa','','','','','','','<p>测试测试测试测试<br /></p>','','','2012-11-19','2012-12-19','Notice/50a99a192f51c.doc','','1','0','0','1353292313','0');
INSERT INTO `ycity_notice` VALUES ('20','1','个太热太热太热太热太热特特我惹是非','','','','','','','<p>vg的法规的好地方合法途径研究院统计at热啊</p>','','','2013-10-17','2013-11-16','','','0','0','0','1381980977','0');
-- 
-- 表的结构 `ycity_order`
-- 
DROP TABLE IF EXISTS `ycity_order`;
CREATE TABLE `ycity_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '主题ID',
  `realname` varchar(255) NOT NULL DEFAULT '' COMMENT '收货人',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '地址',
  `zipcode` varchar(50) NOT NULL DEFAULT '' COMMENT '邮编',
  `telephone` varchar(255) NOT NULL DEFAULT '' COMMENT '电话',
  `fax` varchar(50) NOT NULL COMMENT '传真',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '电子邮件',
  `introduction` text NOT NULL COMMENT '详细内容',
  `remark` text NOT NULL COMMENT '备注',
  `status` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '状态(0未处理 1已处理)',
  `ip` char(15) NOT NULL DEFAULT '127.0.0.1' COMMENT 'IP',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '订货日期',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='订单';
-- 
-- 导出表中的数据 `ycity_order`
--
INSERT INTO `ycity_order` VALUES ('18','2','test','0','121233','313213','1321331','3112313','dcfszcfd@fsdf.com','adasdadad','','0','127.0.0.1','1267899050','0');
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
INSERT INTO `ycity_page` VALUES ('1','学院简介','about','','','<p><strong>一、乘务学院介绍</strong></p><p style=\"text-indent: 2em;\">中国民航大学乘务学院成立于2001年，是教育部和中国民用航空局批准首家设立空中乘务专业的院校，2011年增设民航空中安全保卫专业。建院10多年来,乘务学院在办学规模、办学理念、师资队伍、教学和学生管理等方面，已形成自身独特的办学优势和特色，被誉为“国内规模最大的培养乘务人才的摇篮”，先后为国内外50余家航空公司输送近5千名合格的乘务人才。在学生日常管理中，乘务学院实施准军事化管理，注重学生的组织纪律性、团队意识和必备的职业素养培养。教学中，注重夯实基础知识和专业理论知识，占地2600平米的试验实训设备为培养学生职业技能搭建了有力的平台。&nbsp;</p><p><strong>二、培养目标</strong></p><p style=\"text-indent: 2em;\">“十二五”期间，乘务学院致力于培养具有<strong>“高尚的职业道德、良好的人文素养、扎实的专业知识和技能、较强的安全和服务意识、熟练的语言交际能力且身心健康的空中乘务人才”</strong>。民航空中安全保卫专业以切实满足民航安全保卫工作需要为宗旨，紧密结合行业发展的趋势，培养<strong>“具有较高的政治思想素质、扎实的专业知识和技能、较强的身体能力和实战技能、且作风顽强、纪律严明的高素质民航空中安全保卫人才”</strong>。</p><p><strong>三<strong>、</strong>空中乘务专业介绍</strong></p><p><strong>四<strong>、</strong>民航空中安全保卫专业介绍</strong></p><p><br /></p>','','','','','0','0','1384840000','1384916623');
INSERT INTO `ycity_page` VALUES ('2','联系我们','contact','','','<p>1.中国民航大学乘务学院招生网官方微博&nbsp;<br /></p><p>2.中国民航大学乘务学院招生官方公众微信号</p><p>3.咨询邮箱：cwxy@cauc.edu.cn&nbsp;&nbsp;&nbsp;</p><p>4.联系电话：022-24092909&nbsp;&nbsp;（咨询时间：周一至周五早9：00-11：30&nbsp;，下午14：00-16：30）&nbsp;&nbsp;&nbsp;</p><p>5.联系地址：天津市东丽区津北公路2898号，中国民航大学北区北教25教学楼330室</p><p><br /></p>','','','','','0','0','1970','1384916967');
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
INSERT INTO `ycity_province` VALUES ('65','新疆','2013.1.10','红桥区西青道与闸桥北路交口金兴科技大厦1511 ','2013.2.20','2013.3.15','1','2','1','1384915716');
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
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 COMMENT='考生问答';
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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='管理员角色';
-- 
-- 导出表中的数据 `ycity_role`
--
INSERT INTO `ycity_role` VALUES ('1','超级管理','Menu_index,Menu_insert,Menu_modify,Menu_command,Category_index,Category_modify,Category_update,News_index,News_modify,News_insert,News_move,News_command,Product_index,Product_insert,Product_modify,Product_command,Product_order,Product_move,Download_index,Download_insert,Download_modify,Download_command,Download_move,Feedback_index,Feedback_insert,Feedback_modify,Feedback_command,Job_index,Job_insert,Job_modify,Job_resume,Job_command,Notice_index,Notice_insert,Notice_modify,Notice_command,Link_index,Link_insert,Link_modify,Link_command,Page_index,Page_insert,Page_modify,Page_command,Ad_index,Ad_insert,Ad_modify,Ad_command,Tags,Comment_index,Comment_modify,Comment_command,Admin_index,Admin_insert,Admin_modify,Admin_command,Template,AdminRole_index,AdminRole_insert,AdminRole_modify,AdminRole_command','1','0','0');
INSERT INTO `ycity_role` VALUES ('2','禁止访问','disable','1','0','0');
INSERT INTO `ycity_role` VALUES ('3','普通管理','News_index,News_modify,News_insert,News_move,News_command,File_modify,File_index,File_command,Archive_index','1','0','1317994448');
INSERT INTO `ycity_role` VALUES ('10','学生用户','disable','0','1352080854','1352080854');
INSERT INTO `ycity_role` VALUES ('11','公司用户','disable','0','1352080854','1352080854');
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
INSERT INTO `ycity_signup` VALUES ('1332382972','1','安徽省程集中学','246523','安徽省宿松县程集中学','0556-7962717','246523','叶海军','13622048617','Signup/201311/528c15aa42180.jpg','Signup/201311/528c15aa42180_s.jpg','1384912298','0','2013112058317642','TRADE_SUCCESS','RqPnCoPT3K9%2Fvwbh3I75K68r2L3tJKmPFxnGbzf%2BurCoPnGEJUt0s3gmqIyuwA8Jyc%2F5','2013-11-20 09:51:59','y_city@163.com');
INSERT INTO `ycity_signup` VALUES ('1332397662','2','天津城建','300384','天津城建','13662086010','300384','叶海军','13622048617','Signup/201311/528c1e9f93b94.jpg','Signup/201311/528c1e9f93b94_s.jpg','1384914591','0','','','','','');
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
INSERT INTO `ycity_user` VALUES ('1','1','admin','d9637d9c684ba63b5b1b05e1f578495a80a0a25a','系统管理员','男','0','05560000000','13900000000','022-58018980','20020573@163.com','5565907','2','','164','1306847872','1306847872','0.0.0.0','1384913998','0');
INSERT INTO `ycity_user` VALUES ('2','11','mchunt','d9637d9c684ba63b5b1b05e1f578495a80a0a25a','mchunt','男','0','','','','','','2','','20','1306847872','1306847872','0.0.0.0','1353656577','0');
-- 
-- 表的结构 `ycity_video`
-- 
DROP TABLE IF EXISTS `ycity_video`;
CREATE TABLE `ycity_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `username` varchar(20) NOT NULL COMMENT '发布者',
  `category_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '分类ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '产品名称',
  `title_style` varchar(255) NOT NULL DEFAULT '' COMMENT '标题样式',
  `title_style_serialize` varchar(255) NOT NULL COMMENT '标题样式序列化',
  `keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` text NOT NULL COMMENT '描述',
  `videoUrl` varchar(100) NOT NULL COMMENT '视频地址',
  `content` text NOT NULL COMMENT '产品说明',
  `tags` varchar(255) NOT NULL COMMENT 'tags',
  `template` varchar(100) NOT NULL COMMENT '模板文件',
  `attach` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否附件 1是0否',
  `attach_image` varchar(100) NOT NULL COMMENT '图片',
  `attach_thumb` varchar(100) NOT NULL COMMENT '缩略图',
  `link_url` varchar(100) NOT NULL COMMENT '外链接',
  `istop` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '置顶',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否审核',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `display_order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `view_count` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '点击次数',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='就业视频';
-- 
-- 导出表中的数据 `ycity_video`
--
INSERT INTO `ycity_video` VALUES ('7','1','admin','0','百家讲坛：身边的礼仪(1)','','','','','./Uploads/2010/0604/百家讲坛：身边的礼仪(1).交往的艺术－金正昆..flv','<p><br /></p>','','','1','Video/201211/509f6473c86b0.jpg','Video/201211/509f6473c86b0_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('8','1','admin','0','百家讲坛：身边的礼仪(2)','','','','','./Uploads/2010/0604/百家讲坛：身边的礼仪(2).商务交往的技巧－金正昆.flv','<p><br /></p>','','','1','Video/201211/509f649be9c69.jpg','Video/201211/509f649be9c69_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('9','1','admin','0','百家讲坛_金正昆谈礼仪(3)','','','','','./Uploads/2010/0604/百家讲坛_金正昆谈礼仪(3)-人际交往法则(上)-金正昆.flv','<p><br /></p>','','','1','Video/201211/509f64c627ae4.jpg','Video/201211/509f64c627ae4_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('10','1','admin','0','百家讲坛_金正昆谈礼仪(4)','','','','','./Uploads/2010/0604/百家讲坛_金正昆谈礼仪(4)-人际交往法则(下)-金正昆.flv','<p><br /></p>','','','1','Video/201211/509f64ee0bd7c.jpg','Video/201211/509f64ee0bd7c_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('11','1','admin','0','百家讲坛_金正昆谈礼仪(5)','','','','','./Uploads/2010/0604/百家讲坛_金正昆谈礼仪(5)-仪表礼仪-金正昆.flv','<p><br /></p>','','','1','Video/201211/509f650e3d828.jpg','Video/201211/509f650e3d828_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('12','1','admin','0','如何做好创业规划','','','','','./Uploads/2010/0604/如何做好创业规划.flv','<p><br /></p>','','','1','Video/201211/509f65406afc8.jpg','Video/201211/509f65406afc8_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('13','1','admin','0','盛大网络总裁唐骏采访','','','','','./Uploads/2010/0604/盛大网络总裁唐骏采访.flv','<p><br /></p>','','','1','Video/201211/509f6573d5756.jpg','Video/201211/509f6573d5756_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('14','1','admin','0','第五届西湖论剑--IT七剑共话天下','','','','','./Uploads/2010/0604/第五届西湖论剑--IT七剑共话天下比尔克林顿.杨致远.马云.马化腾.汪延.丁磊.张朝阳2.flv','<p><br /></p>','','','1','Video/201211/509f65aed28d0.jpg','Video/201211/509f65aed28d0_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('15','1','admin','0','求职礼仪','','','','','./Uploads/2010/0604/如何做好创业规划.flv','<p><br /></p>','','','1','Video/201211/509f6611666b5.jpg','Video/201211/509f6611666b5_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('16','1','admin','0','阿里巴巴十周年庆典马云演讲','','','','','./Uploads/2010/0604/十周年庆典马云演讲 又傻又天真的精神让阿里巴巴走了十年.flv','<p><br /></p>','','','1','Video/201211/509f663fbfb58.jpg','Video/201211/509f663fbfb58_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('17','1','admin','0','鲁豫有约 打工之王 唐骏（上）','','','','','./Uploads/2010/0605/鲁豫有约 2008-07-04 唐骏 打工之王(上).flv','<p><br /></p>','','','1','Video/201211/509f66734b84c.jpg','Video/201211/509f66734b84c_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('18','1','admin','0','鲁豫有约 唐骏 打工之王(下)','','','','','./Uploads/2010/0605/鲁豫有约 2008-07-04 唐骏 打工之王(下).flv','<p><br /></p>','','','1','Video/201211/509f66a693a06.jpg','Video/201211/509f66a693a06_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('19','1','admin','0','百家讲坛_金正昆谈礼仪','','','','','./Uploads/2010/0605/百家讲坛_金正昆谈礼仪06-服饰礼仪-金正昆..flv','<p><br /></p>','','','1','Video/201211/509f66cc121fc.jpg','Video/201211/509f66cc121fc_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('20','1','admin','0','鲁豫有约 李开复','','','','','./Uploads/2010/0605/李开复：dygod 下载.flv','<p><br /></p>','','','1','Video/201211/509f670735e88.jpg','Video/201211/509f670735e88_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('21','1','admin','0','鲁豫有约 李开复','','','','','./Uploads/2010/0605/李开复2：dygod 下载.flv','<p><br /></p>','','','1','Video/201211/509f67213a847.jpg','Video/201211/509f67213a847_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('22','1','admin','0','赢在中国第三赛季_商业实战_04','','','','','./Uploads/2010/0605/赢在中国第三赛季_商业实战_04.flv','<p><br /></p>','','','1','Video/201211/509f674f8726a.jpg','Video/201211/509f674f8726a_s.jpg','','0','0','0','0','1','1352563200','0');
INSERT INTO `ycity_video` VALUES ('23','1','admin','0','国航及飞行学员简介','','','','','./Uploads/2011/1018/VTS_01_1.flv','<p><br /></p>','','','1','Video/201211/509f67ba0fed3.jpg','Video/201211/509f67ba0fed3_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('24','1','admin','0','国航及飞行学员简介','','','','','./Uploads/2011/1018/VTS_01_2.flv','<p><br /></p>','','','1','Video/201211/509f67dc4dc81.jpg','Video/201211/509f67dc4dc81_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('25','1','admin','0','天津市建工工程总承包有限公司成立10周年纪录片','','','','','./Uploads/2011/1021/VTS_01_1.flv','<p><br /></p>','','','1','Video/201211/509f6822e56aa.jpg','Video/201211/509f6822e56aa_s.jpg','','0','0','0','0','0','1352563200','0');
INSERT INTO `ycity_video` VALUES ('26','1','admin','0','天津市建工工程总承包有限公司简介','','','','','./Uploads/2011/1021/ VTS_02_1.flv','<p><br /></p>','','','1','Video/201211/509f686c636c2.jpg','Video/201211/509f686c636c2_s.jpg','','0','0','0','0','0','1352563200','0');