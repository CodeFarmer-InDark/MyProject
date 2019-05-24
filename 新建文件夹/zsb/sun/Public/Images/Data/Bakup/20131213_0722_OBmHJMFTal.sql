-- Y-cityCMS SQL Dump
-- Time:2013-12-13 07:22:55
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
) ENGINE=MyISAM AUTO_INCREMENT=2524 DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC COMMENT='管理员操作日志';
-- 
-- 导出表中的数据 `ycity_admin_log`
--

-- 
-- 表的结构 `ycity_audition`
-- 
DROP TABLE IF EXISTS `ycity_audition`;
CREATE TABLE `ycity_audition` (
  `id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned NOT NULL,
  `group` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '考试进度',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1为确认通过，2为第一次考试就绪，可以显示在pad终端，3为第一次考试结束，4为第一次考试缺考，5为第二次考试结束，6为第二次考试缺考。7为第一次考试合格，需显示在“等待列表”，8为第二次考试就绪，可以显示pad终端，9为复试合格',
  `result` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='面试';
-- 
-- 导出表中的数据 `ycity_audition`
--
INSERT INTO `ycity_audition` VALUES ('1333044887','2','1','7','0');
INSERT INTO `ycity_audition` VALUES ('1332382972','7','2','5','0');
INSERT INTO `ycity_audition` VALUES ('1332909716','3','1','4','0');
INSERT INTO `ycity_audition` VALUES ('1333035699','4','1','7','0');
INSERT INTO `ycity_audition` VALUES ('1333033276','5','1','7','0');
INSERT INTO `ycity_audition` VALUES ('1332991610','6','1','8','0');
INSERT INTO `ycity_audition` VALUES ('1333011426','8','1','5','0');
INSERT INTO `ycity_audition` VALUES ('1333005362','9','1','7','0');
INSERT INTO `ycity_audition` VALUES ('1333034281','10','1','7','0');
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
-- 表的结构 `ycity_examairline`
-- 
DROP TABLE IF EXISTS `ycity_examairline`;
CREATE TABLE `ycity_examairline` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `AirLine` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '航空公司名',
  `Remark` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='航空公司表';
-- 
-- 导出表中的数据 `ycity_examairline`
--
INSERT INTO `ycity_examairline` VALUES ('1','天津航空公司',NULL);
-- 
-- 表的结构 `ycity_examairlineselecting`
-- 
DROP TABLE IF EXISTS `ycity_examairlineselecting`;
CREATE TABLE `ycity_examairlineselecting` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `StudentID` int(10) NOT NULL COMMENT '考生ID',
  `AirLineID` int(10) NOT NULL COMMENT '航空公司ID',
  `Admit` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='考生选择航空公司表';
-- 
-- 导出表中的数据 `ycity_examairlineselecting`
--
INSERT INTO `ycity_examairlineselecting` VALUES ('1','1332397662','1','1');
-- 
-- 表的结构 `ycity_examexpert`
-- 
DROP TABLE IF EXISTS `ycity_examexpert`;
CREATE TABLE `ycity_examexpert` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `LoginID` varchar(25) CHARACTER SET utf8 NOT NULL,
  `Pass` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0不可用 1为可用',
  `Remark` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '可存储评委真实姓名',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `LoginID` (`LoginID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='考试评委';
-- 
-- 导出表中的数据 `ycity_examexpert`
--
INSERT INTO `ycity_examexpert` VALUES ('1','professional1','professional1','1','评委1');
INSERT INTO `ycity_examexpert` VALUES ('2','professional2','professional2','1','评委2');
INSERT INTO `ycity_examexpert` VALUES ('3','professional3','professional3','0','评委3');
-- 
-- 表的结构 `ycity_examfirstvote`
-- 
DROP TABLE IF EXISTS `ycity_examfirstvote`;
CREATE TABLE `ycity_examfirstvote` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `StudentID` int(10) NOT NULL COMMENT '考生ID',
  `ExpertID` varchar(25) CHARACTER SET utf8 NOT NULL COMMENT '评委ID',
  `Status` tinyint(2) NOT NULL COMMENT '0不投票 1投票',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 COMMENT='初试投票记录';
-- 
-- 导出表中的数据 `ycity_examfirstvote`
--
INSERT INTO `ycity_examfirstvote` VALUES ('1','1332382972','professional1','1');
INSERT INTO `ycity_examfirstvote` VALUES ('2','1332382972','professional2','1');
INSERT INTO `ycity_examfirstvote` VALUES ('6','1333005362','professional2','0');
INSERT INTO `ycity_examfirstvote` VALUES ('7','1333005362','professional1','1');
INSERT INTO `ycity_examfirstvote` VALUES ('8','1333011426','professional1','1');
INSERT INTO `ycity_examfirstvote` VALUES ('9','1333011426','professional2','1');
-- 
-- 表的结构 `ycity_examinfo`
-- 
DROP TABLE IF EXISTS `ycity_examinfo`;
CREATE TABLE `ycity_examinfo` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `ExamNO` varchar(10) CHARACTER SET utf8 NOT NULL COMMENT '考试批次',
  `Status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0为初试未开始 1为初试结束 2为复试结束',
  `SysUser` varchar(25) CHARACTER SET utf8 DEFAULT NULL COMMENT '最后更新Status字段用户',
  `Time` date DEFAULT NULL COMMENT '最后更新Status字段时间',
  `ExpertCount` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '本次考试评委人数',
  `FirstPassedVote` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '初试通过票数',
  `SecondPassedVote` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '复试通过票数',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ExamNO` (`ExamNO`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='考试信息';
-- 
-- 导出表中的数据 `ycity_examinfo`
--
INSERT INTO `ycity_examinfo` VALUES ('1','2013','1',NULL,NULL,'11:5-14:3','11:3-14:2','11:3-14:2');
INSERT INTO `ycity_examinfo` VALUES ('2','2014','0',NULL,NULL,NULL,NULL,NULL);
-- 
-- 表的结构 `ycity_examlog`
-- 
DROP TABLE IF EXISTS `ycity_examlog`;
CREATE TABLE `ycity_examlog` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `LoginID` varchar(25) CHARACTER SET utf8 NOT NULL COMMENT '日志记录用户ID',
  `Time` date DEFAULT NULL COMMENT '日志记录时间',
  `IP` varchar(25) CHARACTER SET utf8 DEFAULT NULL COMMENT '日志记录IP',
  `Remark` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '日志记录信息',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COMMENT='考试系统用户日志';
-- 
-- 导出表中的数据 `ycity_examlog`
--
INSERT INTO `ycity_examlog` VALUES ('1','admin','2013-11-20',NULL,NULL);
INSERT INTO `ycity_examlog` VALUES ('2','test','2013-11-27',NULL,NULL);
INSERT INTO `ycity_examlog` VALUES ('3','admin','2013-12-06','','登入系统');
INSERT INTO `ycity_examlog` VALUES ('4','admin','2013-12-06','','选择批次【2013】，选择生源地【山西 北京 】');
INSERT INTO `ycity_examlog` VALUES ('5','admin','2013-12-06','','退出系统');
INSERT INTO `ycity_examlog` VALUES ('6','admin','2013-12-06','','登入系统');
INSERT INTO `ycity_examlog` VALUES ('7','admin','2013-12-06','','选择批次【2013】，选择生源地【北京 】');
INSERT INTO `ycity_examlog` VALUES ('8','admin','2013-12-06','','退出系统');
INSERT INTO `ycity_examlog` VALUES ('9','admin','2013-12-06','','登入系统');
INSERT INTO `ycity_examlog` VALUES ('10','admin','2013-12-06','','选择批次【2013】，选择生源地【山西 北京 】');
INSERT INTO `ycity_examlog` VALUES ('11','admin','2013-12-06','','退出系统');
INSERT INTO `ycity_examlog` VALUES ('12','admin','2013-12-06','','登入系统');
INSERT INTO `ycity_examlog` VALUES ('13','admin','2013-12-06','','选择批次【2013】，选择生源地【北京 】');
INSERT INTO `ycity_examlog` VALUES ('14','admin','2013-12-06','','退出系统');
INSERT INTO `ycity_examlog` VALUES ('15','admin','2013-12-12','','登入系统');
INSERT INTO `ycity_examlog` VALUES ('16','admin','2013-12-12','','选择批次【2013】，选择生源地【北京 】');
INSERT INTO `ycity_examlog` VALUES ('17','admin','2013-12-12','','更新日志文件');
-- 
-- 表的结构 `ycity_examsecondvote`
-- 
DROP TABLE IF EXISTS `ycity_examsecondvote`;
CREATE TABLE `ycity_examsecondvote` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `StudentID` int(10) NOT NULL COMMENT '考生ID',
  `ExpertID` varchar(25) CHARACTER SET utf8 NOT NULL COMMENT '评委ID',
  `Status` tinyint(2) NOT NULL COMMENT '0不投票 1投票',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='复试投票记录';
-- 
-- 导出表中的数据 `ycity_examsecondvote`
--
INSERT INTO `ycity_examsecondvote` VALUES ('1','1332382972','professional1','1');
INSERT INTO `ycity_examsecondvote` VALUES ('2','1332382972','professional2','0');
INSERT INTO `ycity_examsecondvote` VALUES ('3','1332382972','professional3','0');
INSERT INTO `ycity_examsecondvote` VALUES ('4','1333011426','professional3','1');
INSERT INTO `ycity_examsecondvote` VALUES ('5','1333005362','professional3','1');
INSERT INTO `ycity_examsecondvote` VALUES ('6','1333005362','professional2','0');
INSERT INTO `ycity_examsecondvote` VALUES ('7','1333005362','professional1','1');
INSERT INTO `ycity_examsecondvote` VALUES ('8','1333011426','professional1','1');
INSERT INTO `ycity_examsecondvote` VALUES ('9','1333011426','professional2','1');
-- 
-- 表的结构 `ycity_examuser`
-- 
DROP TABLE IF EXISTS `ycity_examuser`;
CREATE TABLE `ycity_examuser` (
  `ID` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增',
  `LoginID` varchar(25) CHARACTER SET utf8 NOT NULL COMMENT '登录ID',
  `Pass` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '登录密码',
  `Status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1可用 0不可用',
  `Remark` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '备注 可存储用户真实姓名',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `LoginID` (`LoginID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='考试系统用户表，admin为超级用户';
-- 
-- 导出表中的数据 `ycity_examuser`
--
INSERT INTO `ycity_examuser` VALUES ('1','admin','000000','1','超级管理员');
INSERT INTO `ycity_examuser` VALUES ('2','test','test','1','测试用户1');
INSERT INTO `ycity_examuser` VALUES ('4','test2','test2','0','测试用户2');
INSERT INTO `ycity_examuser` VALUES ('6','test1','1','1','1');
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
INSERT INTO `ycity_instruction` VALUES ('2','0','1','admin','二、登录报名','','','','','','','','<p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">注：请考生如实填写网报信息，凡不按公告要求报名、网报信息误填、错填或填报虚假信息而造成不能考试的，后果由考生本人承担。（红色字体标注）</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span>1.</span><span style=\"font-size:12.0pt;font-family:宋体\">问：如何进行网上报名<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：首先需要免费注册为乘务学院招生信息网用户，点击主页面用户注册按钮，按照提示及要求进行注册。注册成功后，请登陆注册邮箱，查询是否收到用户激活码，确认收到后，点击页面菜单栏中的<span>&quot;</span>登录报名<span>&quot;</span>链接，输入激活码，即可确认注册。登录后，产生<span>10</span>位数字的用户识别号，点击在线缴费，核实个人信息无误后，即可确认提交。请牢记注册邮箱、登陆密码和用户识别号等信息。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　注意：请牢记用户识别号，如果当前状态为未报名，须点击在线缴费，进行网上缴费，缴费成功后才算报名成功。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>2.</span>问：报考空中乘务专业及民航空中安全保卫专业是否必须进行网上报名<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：<span>2014</span>年中国民航大学空中乘务专业及民航空中安全保卫专业的专业报名全面实行网上报名，所有中国民航大学独立组织专业测试的省份地区的考生都应该参加网上报名。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">将按照重庆市教育考试院的统一安排进行选拔。重庆市的考生不必在我校招生网站中注册报名。重庆市考生请密切关注重庆市教育考试院公布的具体要求及日程安排。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>3.</span>问：网上注册报名的有效时间<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：网上缴费截止时间：自网络报名开通之日起至各地区报名考试当天初试结束（以考试日程公布时间为准）。截至时间以后，考生无法参加考试，缴费无效。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>4.</span>问：我校未涉及招收空中乘务专业及民航空中安全保卫专业的省份地区的考生可以网上报名吗<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：<span>2014</span>年我校在全国<span>22</span>个省份地区招收空中乘务专业及民航空中安全保卫专业，未涉及地区考生不得报考，一旦报考，不予退费。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>5.</span>问：姓名不能正常显示<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：考生姓名或家庭地址在填写报考信息的时候可以使用打字法输入，但是保存以后却成了“<span>??</span>”或“？”。出现缘由：由于部分考生姓名或家庭地址中含有部分生僻字，即：比较少见的字，导致在网页中无法正常显示。解决办法：网上报名的时候不用处理，在现场确认个人报考信息的时候申请修改。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>6.</span>问：在注册过程中未收到邮箱注册激活码，但显示用户邮箱已注册或身份证信息已注册，如何处理？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：注册中确认未收到激活码，如果确认是自己的身份证号被报过名，可以将本人手持身份证照片及身份证扫描件，发送至<span>cwxy@cauc.edu.cn,</span>并致电<span>022-24092909</span>，经核实后进行处理。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">，</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span>7.</span><span style=\"font-size:12.0pt;font-family:宋体\">问：忘记登陆密码，如何处理？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">答：已在本系统中注册过的用户需要使用注册过的邮箱和密码登陆。忘记密码请点击“忘记密码”输入注册邮箱及姓名，将自动发送新的密码到注册邮箱。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;</span><span style=\"\">&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">注意：用户注册所填写的电子邮箱地址是找回密码的重要途径，请认真填写有效电子邮件地址，使用英文半角输入。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span>8.</span><span style=\"font-size:12.0pt;font-family:宋体\">问：页面无法显示，如何处理？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">答：请关闭或卸载有窗口拦截功能的软件，例如：<span>IE</span>用户必须关闭“弹出窗口阻止程序”。（关闭方法：打开<span>Internet&nbsp;Explorer</span>，在“工具”菜单中，指向“弹出窗口阻止程序”，然后单击“关闭弹出窗口阻止程序”即可）；强烈建议使用<span>IE7.0</span>及以上版本兼容浏览器。&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">9.</span><span style=\"font-size:12.0pt;font-family:宋体\">问：注册须知页面中，考生高考所在地区、身份证号码及姓名不可修改，怎么办<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：考生在注册页面中，应正确选择高考报考所在地，若个人原因选择错误，或填写错误，可以将所提问题，本人手持身份证照片、身份证扫描件或用户识别号，发送至<span>cwxy@cauc.edu.cn,</span>并致电<span>022-24092909</span>。</span></p>','','','','0','0','0','6','3','1384790400','0');
INSERT INTO `ycity_instruction` VALUES ('3','0','1','admin','三、现场确认','','','','','','','','<p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>1.</span>问：现场确认程序如何<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　现场确认程序如下：</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　考生携带本人第二代居民身份证（原件）、中国民航大学专业测试登记表、近期一寸彩色照片<span>2</span>张，按照我校考试日程中公布的时间地点，由我校工作人员进行审核确认。报考点工作人员发现伪造证件时应通知公安机关并配合公</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">安机关暂扣相关证件，并上报当地招生教育考试部门。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　注意：（<span>1</span>）所有考生均要对本人网上报名信息进行认真核对并确认。经考生确认的报名信息在考试、复试及录取阶段一律不作修改，因考生填写错误引起的一切后果由其自行承担。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　（<span>2</span>）按艺术类招生的各地区考生须携带各省市招办发放的艺术类准考证原件和复印件。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span>2.</span><span style=\"font-size:12.0pt;font-family:宋体\">问：现场确认时二代身份证遗失或正补办中如何处理？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">答：考生可在所在地户籍管理部门开具户籍证明，或在火车站、机场等派出所开具临时身份证明。</span></p><p><br /></p>','','','','0','0','0','5','0','1384790400','0');
INSERT INTO `ycity_instruction` VALUES ('4','0','1','admin','四、报考及考试方式','','','','','','','','<p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">1</span><span style=\"font-size:12.0pt;font-family:宋体\">、凡有意报考的考生，请详细阅读我校招生简章上的内容。注册报名之前请确认如下事项：你是否能够参加<span>2014</span>年高考（秋季），确认我校是否在你高考所在地区有招生计划；是否你的身高在我校标准范围内；是否你符合我校在你所高考在地区的招生类别要求。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">2</span><span style=\"font-size:12.0pt;font-family:宋体\">、我校空中乘务专业仅限女生报考，民航空中安全保卫专业仅限男生报考，上述两个专业学历层次为专科。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">3</span><span style=\"font-size:12.0pt;font-family:宋体\">、实行“订单式”校企联合招生的地区，具体招生条件及要求以我校招生网公布信息为准。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">4.</span><span style=\"font-size:12.0pt;font-family:宋体\">问：普通文理类考生有专业测试成绩吗<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：按照普通文理类招生的地区，考生无专业成绩，只有合格。按照普通文、理类招生的地区，根据考生填报我校志愿顺序，按照高考成绩，由高分到低分择优录取，相同分数下，根据</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">高考英语成绩由高到低择优录取。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">5.</span><span style=\"font-size:12.0pt;font-family:宋体\">问：艺术类地区考生专业成绩如何测算<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：专业测试成绩总分为<span>120</span>分（面试成绩<span>100</span>分，英语语言能力<span>20</span>分）</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">6.</span><span style=\"font-size:12.0pt;font-family:宋体\">问：我校投放招生计划地区，但由当地招生教育主管部门统一实行联考，如何报名考试？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">答：<span>2014</span>年仅重庆地区实行统一考试。我校将不单独组织考试，我校将参加重庆市教育考试院的联考，我校将按照重庆市教育考试院的统一安排进行选拔。重庆市的考生不必在我校招生网站中注册报名。重庆市考生请密切关注重庆市教育考试院公布的具体要求及日程安排。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">7.</span><span style=\"font-size:12.0pt;font-family:宋体\">校企联合培养注意事项？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">答：<span>2014</span>年我校分别与中国南方航空股份有限公司、山东航空股份有限公司、中国东方航空股份有限公司和天津航空有限责任公司在全国<span>10</span>个省市联合招收“订单式”联合培养学生，具体招生简章请关注网站通知公告。在校企合作招生地区，凡通过我校复试环节的考生，均有资格自愿参加各航空公司组织的“联合培养学生”资格选拔，取得航空公司联合培养资格的考生，须与航空公司签订确认书，公司终审当天需要一位考生家长陪同，请考生和家长提前做好准备。</span></p>','','','','0','0','0','4','0','1384790400','0');
INSERT INTO `ycity_instruction` VALUES ('5','0','1','admin','五、填写个人基本信息','','','','','','','','<p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>1.</span>问：网报过程中，填写考生姓名时应注意什么<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：输入姓名时要输入真实汉语名字，顶格书写，汉字与汉字中间不可有空格，输入法中无法找到的汉字，可用<span>&quot;?&quot;</span>代替，一个<span>&quot;?&quot;</span>代替一个汉字。少数民族考生名字中的点，请输入英文状态下的小数点就可以。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>2.</span>问：姓名拼音项规则<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：最多输入<span>80</span>个字节的半角字符。要求顶格连续填写，并且不可有空格，大小写均可。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>3.</span>问：证件类型填写事项<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：仅限大陆居民第二代身份证，身份证最后一位为<span>X</span>为小写。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　考生需持合法有效的证件至报考点进行现场确认和参加考试。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>4.</span>问：考生通讯地址一项重要吗<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：通讯地址为考生接收专业合格通知书、录取通知书的有效地址，考生必须准确填写。如须更改请将本人手持身份证照片、身份证扫描件或用户识别号，发送至<span>cwxy@cauc.edu.cn,</span>并</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">致电<span>022-24092909</span>。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>5.</span>问：考生联系方式重要吗<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：十分重要。请填写可随时联系的电话。考生在填写固定电话时应注意区号、分机号可以用<span>&quot;-&quot;</span>分开。多个电话可以用逗号“，”分开，最多可输入<span>40&nbsp;</span>个字节的字符。填写移动电话最多输入<span>11</span>个字节的数字。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>6.</span>问：如何填写毕业院校名称<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：毕业学校为你学籍所在学校，最多输入<span>50</span>个字节的字符。</span></p>','','','','0','0','0','3','1','1384790400','0');
INSERT INTO `ycity_instruction` VALUES ('6','0','1','admin','六、关于网上缴费','','','','','','','','<p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　问：如何判断网报是否已成功交费<span>?</span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　答：</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>(1)</span>通过登陆邮箱和密码登录到报名系统中当前状态应该为报名完成。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>(2)</span>查看银行卡消费记录，已扣费即已成功缴费，特殊情况下，乘务学院招生信息网状态可能没有变为已交费状态，请考生不用担心。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">（<span>3</span>）本缴费系统，仅支持支付宝缴费，缴费之前请确认支付宝内账户余额充足。否则无法报名缴费。如出现支付宝扣款已完成，报名系统提示当天状态为：未缴费。将您的身份证号码、</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">姓名、支付宝扣款成功的截图发邮件到<span>cwxy@cauc.edu.cn</span>，并致电<span>022-24092909</span>。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">问：网上缴费是否有时间限制？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">答：网上缴费截止时间：自网络报名开通之日起至各地区报名考试当天初试结束（以考试日程公布时间为准）。截至时间以后，考生无法参加考试，缴费无效。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">问：网上支付是否一定要用本人的银行卡或支付宝账号？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">答：只要是有效的银行卡都可以进行网上支付，详情请咨询银行卡所属银行。只须确认支付宝余额充足即可缴费。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">问：因个人原因无法参加考试是否退款？</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">答：因个人原因无法参加考试的考生，无法退款，请考生报名缴费前慎重选择。</span></p>','','','','0','0','0','2','2','1384790400','0');
INSERT INTO `ycity_instruction` VALUES ('7','0','1','admin','七、重要提醒','','','','','','','','<p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">《中国民航大学<span>2014</span>年空中乘务及民航空中安全保卫专业招生简章》<span>)</span>已于今天公布。针对<span>2014</span>年新的报考方式，乘务学院招生信息网整理几点重要提醒，望考生多加留意。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　一、招生省份及招生类别的变化</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>2014</span>年面向全国<span>22</span>个省市地区招生，计划按照艺术类招生地区：辽宁、山东、陕西、吉林、江西，艺术文、艺术理兼收，播音主持、音乐、美术、模特等专业考生均可报考。计划按照普通文、理类招生地区：北京、天津、上海、重庆、江苏、四川、湖南、湖北、山西、浙江、河北、云南、安徽、贵州、广西、内蒙古、黑龙江，文、理兼收。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　提醒：<span>1</span>、凡<span>2014</span>年未涉及招生地区的考生一律不得报考；<span>2014</span>年江苏、黑龙江根据当地招生主管部门统一要求，按照普通文理类进行招生。按照普通文理类招生地区的艺术类考生，若要报考上述两专业，须兼报普通文理类后，方可报考。<span>2</span>、我校<span>2014</span>年中乘务专业、民航空中安全保卫专业实行统一计划，《<span>2014</span>年简章》中计划数为预计划数，我校将根据各省考生报考面试情况分配各省（市）计划。具体各专业计划数以各省（市）考试院<span>(</span>招办<span>)</span>实际公布计划为准。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　二、<span>2014</span>年全面实行网络报名</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>2014</span>年中国民航大学乘务学院招生信息网升级改造完成，全面推行网络报名，网络缴费。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">提醒：<span>1</span>、请考生根据报考条件慎重选择是否报考，因报考涉及缴费，一旦报考后，因个人原因无法参加考试，不予退款。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">2</span><span style=\"font-size:12.0pt;font-family:宋体\">、重庆地区：我校不单独组织校考，将参加重庆市教育招生考试院组织的联考，重庆考生不须参加我校网络报名，具体相关事宜，将按照重庆市教育招生考试院统一安排进行。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　三、报名注意事项</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　网上报名需要填写或选择的内容以及要求，除明确说明可不填写外，其他均为必填选项，考生要提前准备，以免在网报期间由于单个页面停滞时间过长导致报名失败。用户注册所填写的电子邮箱地址是找回密码的重要途径，请认真填写有效电子邮件地址，使用英文半角输入。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　<span><span style=\"\">&nbsp;&nbsp;&nbsp;</span></span>四、报考条件及要求</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">请报考考生参照《中国民航大学<span>2014</span>年空中乘务及民航空中安全保卫专业招生简章》上的条件及要求报考。凡不符合简章中相应要求的考生，请勿报考，因此造成的后果，由考生本人承担。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">五、现场确认要求</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　考生携带本人第二代居民身份证（原件）、中国民航大学专业测试登记表、近期一寸彩色照片<span>2</span>张，按照我校考试日程中公布的时间地点，由我校工作人员进行审核确认。报考点工作人员发现伪造证件时应通知公安机关并配合公</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">安机关暂扣相关证件，并上报当地招生教育考试部门。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　注意：<span>1</span>、所有考生均要对本人网上报名信息进行认真核对并确认。经考生确认的报名信息在考试、复试及录取阶段一律不作修改，因考生填写错误引起的一切后果由其自行承担。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>2</span>、按艺术类招生的各地区考生须携带各省市招办发放的艺术类准考证原件和复印件。</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　六、咨询方式</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>1.</span>中国民航大学乘务学院招生网官方微博</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　<span>2.</span>中国民航大学乘务学院招生官方公众微信号</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span>3.</span><span style=\"font-size:12.0pt;font-family:宋体\">咨询邮箱：<span>cwxy@cauc.edu.cn<span style=\"\">&nbsp;&nbsp;&nbsp;</span></span></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span>4.</span><span style=\"font-size:12.0pt;font-family:宋体\">联系电话：<span>022-24092909<span style=\"\">&nbsp;&nbsp;</span></span>（咨询时间：周一至周五早<span>9</span>：<span>00-11</span>：<span>30&nbsp;</span>，下午<span>14</span>：<span>00-16</span>：<span>30</span>）</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\">　　</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;font-family:宋体\"><span style=\"\">&nbsp;&nbsp;&nbsp;&nbsp;</span></span><span style=\"font-size:12.0pt;font-family:宋体\">七、乘务学院招生信息网为中国民航大学官方唯一授权网站，本网站中涉及的招生工作未与任何教育培训机构或个人达成任何委托或授权协议，凡假借我校名义开展的各类招生培训及承诺协助入学等违法活动，我校将保留对此类行为的法律追诉权利。请广大考生及家长注意！</span></p>','','','','0','0','0','1','4','1384790400','1384913000');
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
  `first_votes` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '初试票数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户信息';
-- 
-- 导出表中的数据 `ycity_member`
--
INSERT INTO `ycity_member` VALUES ('1332397662','285783013@qq.com','e7d96213f37045c60997842343f2c38ecec0e018','姚晓峰','2','1986-11-11','120102198611112354','13662086010','11','O0uaRPwSO9fGUcOQ0tG0','8','1384914503','0','1386751029','127.0.0.1','4','4');
INSERT INTO `ycity_member` VALUES ('1333012679','419188760@qq.com','c670a97888552029d8fcf929ba3e8e0073596cc3','马宇','1','1995-09-26','371502199509261541','15865768710','37','wL8qeNZSdHgFWD0q0NBc','2','1385546802','0','1385733038','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333083296','1220833602@qq.com','9f943ab698e18cf1f3b9b8812c6d054d0693852b','张茜','1','1994-04-08','530426199404080028','18787707169','53','7XzqbMAw0YsqBnkBHTsM','2','1385546464','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333072894','751058827@qq.com','e21131568f4abca2ca783e51e52340075d999dd1','宗小天','2','1996-11-29','320322199611295910','18751521999','32','AE3AeZwTHU79Uqw3xbD5','2','1385545982','0','1385546155','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333071395','1278020235@qq.com','b09e644ec7a97d0bd82de89823ebba25a83e7117','黄雷','2','1995-10-15','320322199510158650','15862272377','32','i8u1gQCTMPlK3MK4lOOF','2','1385545926','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333031586','550023689@qq.com','5e965029276fa5b6677a4ee42b932e0b129a828f','崔鑫','1','1996-06-19','120106199606190024','15822211737','12','kmppRQaLofWSpc0aB9TY','3','1385545844','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333040938','568620596@qq.com','8988836a54e6f275ac47726552e32b5ac3aca4b0','邢琛','1','1996-01-17','140402199601170467','13835560059','14','Zo1YDO8XJDv92FbJZBG9','2','1385545802','0','1385723083','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333023000','824935615@qq.com','c5f7a6a168aae563fdba793fbb5128fe7c9ae172','王超','1','1996-03-17','220181199603170224','18743274101','22','OKnxGOSUvLf1ZfJOd0FT','4','1385545258','0','1385718929','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333091610','1306437875@qq.com','3ccb779c65c8da0df60a4720cfb1080d52237ded','韩敏杰','1','1997-02-21','320382199702216225','18361566463','32','5lCOJoPEZebMXOPznIGR','2','1385545215','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333094013','913143800@qq.com','c4d3868cfcdee020a5d6231640d03480099c3259','孙娴静','1','1996-03-27','522229199603270025','18585604795','52','TnYVwOlNHDg6PJQMLnIG','2','1385545080','0','1385821277','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333088306','wuhaoxwj@163.com','cd29d3ef2554deed4c439e0640bbaa67dcbba895','吴昊','2','1990-11-08','340827199011080070','','34','3uHCeJSpNOyzzmVymGi4','2','1385545053','0','1385545602','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333086634','996099626@qq.com','6efa6e63253ca9e99f329bbefba8e4597601bf90','徐琳','1','1995-07-04','211282199507042223','18741017347','21','ODBzkwcA2DXR0poh9Et5','2','1385544790','0','1385546205','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333009716','1356141748@qq.com','cc41f7c4ebfc28c12436146a402d3d6f8e455403','杨晓清','1','1995-01-11','530402199501110021','15108708008','53','gfp9bPTar3c8wJLmtrbF','4','1385544567','0','1385721728','10.3.1.20','6','0');
INSERT INTO `ycity_member` VALUES ('1333098443','798118780@qq.com','dddde63840885bac6525990ce2d93d4f5685d6dc','兰梦晗','1','1996-02-04','110224199602043023','18611336440','11','1NjFLjKvlATODDVrLopd','4','1385544317','0','1385720370','10.3.1.20','21','0');
INSERT INTO `ycity_member` VALUES ('1333002717','35478571@qq.com','54e061123213ae1deb346d593eae5ce3b3a1a058','温娆','1','1983-12-12','239005198312121549','','11','eGFtVdOwJ2dv8uxT1tgx','2','1385544033','1385555731','1385598804','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333051815','237248565@qq.com','e4c074313bdfa25f9d8c00d2e7ed0b9d847e0cd2','雷亚鸣','1','1996-02-10','340403199602101627','13516431686','34','zWHZJ2JRGrufFzvjtvff','2','1385543446','0','1385609137','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333016383','835439399@qq.com','d58bd9069b17b6f9475f15d647ac0f48416baf13','李嘉琪','1','1996-02-01','140303199602011629','13103533302','14','sBtPUVQqqCc5yC9wtsIR','4','1385543165','1385548672','1385874749','10.3.1.20','13','0');
INSERT INTO `ycity_member` VALUES ('1333066642','1486247833@qq.com','3f6808ec0399c5fe13907a91413bd049698681c9','国傲','2','1996-06-30','110229199606301319','13552257373','11','Kz4n1W15vjMnoJHTynOF','4','1385542577','0','1385618059','10.3.1.20','7','0');
INSERT INTO `ycity_member` VALUES ('1333043611','1374156278@qq.com','84439f7a93f7cf34c506ab0f15db83a8caaee250','但丽华','1','1996-03-28','510321199603284065','13684325664','51','zZWVZt2hcNyZ0HEzPJxQ','2','1385542115','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333034281','liqiuhong2136@163.com','7a15f327aa868b5ed949248be450c16f6360312c','陶李','1','1996-04-26','110228199604260027','13651192136','11','lHZDDqV22dzz0qJLTt99','2','1385542059','0','1386224464','127.0.0.1','6','0');
INSERT INTO `ycity_member` VALUES ('1333019839','389860673@qq.com','be5c9a45ef22f611ec236c66ab2b3bc98bbae829','杜淑贤','1','1996-07-17','371325199607170022','15589102826','37','thLQkQD4967A8CkJpkRS','4','1385542044','0','1385618934','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333041942','2793636429@qq.com','cb8d164749ce28981809e9bb0495982c1bf6aad7','高斯琪','1','1995-12-22','211302199512221625','15120459386','21','XdtrA5O1Qa973g3aIkRS','2','1385541985','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333011865','1099289863@qq.com','f393ad411ad096b082291a1deec63e962760a021','周广晨','2','1996-01-24','370403199601246133','13969454350','37','FdsCqlQur4jCO0ZXQ9EA','4','1385539601','1385540590','1385714404','10.3.1.20','7','0');
INSERT INTO `ycity_member` VALUES ('1333053605','liu-bing888@sohu.com','9c0874a301a4e6ddf2e256726aefaa2fb9e67351','刘冰','1','1963-06-27','120103196306273845','13516166596','12','nZEOcrpEbcnCR0F0IDql','1','1385536612','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333012187','Lijiaxinhappy@163.com','9d685fb2702302972ef5a064a7cad571fb500cc4','李佳欣','1','1996-02-21','110226199602210541','13331115925','11','0qN8FJsWfD3TdiUX7lh3','2','1385539863','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333044887','253611981@qq.com','cd919ee18a48afcbc6aa7fd728d3f88afcb09c19','蒋欢','1','1995-10-16','511025199510167222','13551516929','51','twFESaaznU2ObuMrYvuP','2','1385541570','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1332909716','favor911@sina.com','9c53a930f1557cd3a05adea786a0710293f617e1','孙关男','2','1980-03-08','230306198003084718','13012348668','11','CNtw6PuC4QJvJIw19rJp','4','1385455475','0','1385639158','10.3.1.20','6','0');
INSERT INTO `ycity_member` VALUES ('1332929698','zksun@cauc.edu.cn','14a6d54e6c10d3c41f395f0999af34522ab7a580','孙重凯','2','1979-11-23','120101197911232015','13312077825','11','f6IgGh6xTwGd6vJ9lMmT','4','1385452863','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333011426','bingfeiliu2@126.com','41b38a874fd7bf73dc02bd8f0aba596eacb699d1','刘翔','2','1995-05-13','130825199505134815','13323367291','13','3vJNGm7iEXCtiPnunqQm','2','1385541464','1385725212','1385731716','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333035699','992245813@qq.com','3918b0baed23449fe64185677308a29d8d3f7029','叶子彤','1','1996-08-17','610122199608170023','13359231782','61','l7jjoq3GVFCxgIKzPhu8','2','1385541013','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333033276','670838714@qq.com','e9f1c4e56a5abf840c0358cec78ba1ba2324b435','何嘉瑜','1','1996-08-18','450802199608188226','18007856783','45','REyuYh9OGxaXNKD69Bx7','2','1385540892','0','1385544025','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1332991610','58367387@qq.com','62802c0da2a18365d6fd686a37ee5f7a76a9cdb8','周琳琳','1','1978-06-01','21100319780601012X','13012348778','12','ZLnkCfHwkpwVDACoy7HO','4','1385464514','0','1385541046','202.113.46.254','5','0');
INSERT INTO `ycity_member` VALUES ('1333005362','2565334720@qq.com','51469f3cab85c25bdbbe296add97bae7c00b8c4d','国奥','2','1996-02-29','110103199602290916','13621155604','11','OkmesmOrKU5Fg1IlLOkE','4','1385540198','0','1385775114','10.3.1.20','20','0');
INSERT INTO `ycity_member` VALUES ('1333015331','672128964@qq.com','6ff6ec29c32c4ca8863973ba96139c2494c2cc3c','李佳芮','1','1995-10-25','513901199510250229','18781619360','51','aiE01YVJprC1GwaXgJhN','2','1385553353','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333036141','390156609@qq.com','22b24074e30102f6dc3a69fbc3362d40fd7bff7f','谢雨尘','2','1996-06-11','110105199606118614','18501170797','11','iv36KttBePLfiTDODBXf','2','1385552838','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333056746','943999606@qq.com','d67a2b5a5cdb6d86bb721d15915476a56d51455d','潘云','1','1995-12-02','320107199512025021','15950467800','32','jflOqA9SnhbDod3RlNJo','2','1385552808','0','1385867900','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333074271','1905955573@qq.com','f118649b6302ce75c75c33c2b9c5ff8a7d818e13','李文贤','1','1996-06-07','37028519960607002X','18687072673','37','1BU2WUOLO66jejCq4bBf','4','1385552711','0','1385787772','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333053984','314531937@qq.com','84003b22a1497f3886b2b6d3fb0e2f03f1e69ea8','丁畅','1','1995-06-13','131082199506130028','13663266237','13','DZRGzhIgi2rffrCBTqEe','4','1385552556','0','1385861399','10.3.1.20','14','0');
INSERT INTO `ycity_member` VALUES ('1333025211','lvqing2008@163.com','6d5b1cee59a2b3c36edebe29da0de1b67ba272a0','段禹彤','1','1996-11-28','110105199611285425','13611167360','11','iPCJPMtWd5tuIaT0l3Yb','4','1385552248','0','1385598141','222.129.49.73','3','0');
INSERT INTO `ycity_member` VALUES ('1333065738','1219948046@qq.com','bfc3cbb23515c6b15d080e0d1eed54e14c43b487','顾嘉宝','1','1995-06-08','371502199506081123','15263556317','37','5lCOJoPEZebMXOPznIGR','2','1385551920','0','1385814379','10.3.1.20','9','0');
INSERT INTO `ycity_member` VALUES ('1333015695','925034181@qq.com','4a708792868343f248fe584b40649aa70a1d7a89','肖京京','1','1996-02-28','612430199602281222','13891533181','61','vaD3ysECorYHjNU3UenY','2','1385551845','0','1385788557','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333027526','1521998324@qq.com','8aa8978835ddaceabc88dfcba4129cec655b530f','蓝婷','1','1996-05-29','452231199605295529','13768952506','45','ixPpE1XnT1y6Q7BJT4OY','2','1385551319','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333092917','ying19960710@vip.qq.com','903fda0dbd5623907038de75d4277b179890455f','桂颍','1','1996-07-10','320811199607100023','15851730822','32','e7Z7aUxSvazvws512u6b','4','1385551085','0','1385645285','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333004444','515443771@qq.com','753e46d75221faa23be45f4012339bf442103e6d','闫瑾','1','1998-11-30','130102199811301228','15130187687','13','euw0zm4da1NACh92Icad','2','1385550898','0','1385557352','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333373432','278359129@qq.com','cb9f5619ab390f9d18dd463ee4200be46c5119ac','王雨萌','1','1995-10-24','370112199510247720','13853101136','37','riNsm7vUi82EP5kgOr1I','2','1385811464','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333029877','838912970@qq.com','eb00e8f7ac08eb8efb2e412dec37b9287a5d4678','范静怡','1','1996-05-19','320323199605195848','13852430967','32','cX4qURD3HEs0pX5AoyOu','2','1385550089','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333034641','498503451@qq.com','54773af8e1c862880b54444d6040ee79b8b6ef79','王庭婷','1','1995-11-23','532131199511230024','18608703625','53','vfproIHDWwKsDdNMSuhX','4','1385550037','0','1385808231','10.3.1.20','10','0');
INSERT INTO `ycity_member` VALUES ('1333018705','1604206836@qq.com','9cc6adc7530fc92a67f0bdee4bd9f94ae35bc58e','孙瑞奇','2','1995-12-15','320311199512154013','18021366342','32','Gire5mqOFwKgfUBncnpo','2','1385549801','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333033344','906192320@qq.com','3cc21468e316de025039b76d231c4d67e56aa9ca','甘晨','2','1995-08-19','340504199508190637','18655532608','34','sMGWAht6qqbCu4cHCZzi','4','1385549737','0','1385554142','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333037906','576705288@qq.com','2282c52f8b02f78286e28c12189abb54a27fbb22','陈姿含','1','1995-08-24','230203199508241424','15546281199','23','Wn6sKVOrT7VAnxrIFgdB','2','1385549662','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333078426','292683527@qq.com','cf47d40a97a9afeffe6e967e2109aa358b4d6933','曾方宣','1','1996-06-04','220203199606042427','','22','WSfWyLQTKrzs3K6Sir3F','4','1385549504','0','1385631217','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333003753','1150826420@qq.com','0a7d526fee79f7e7ee3b2f7a26d23b3675bc093c','刘永','2','1995-05-27','370302199505270019','18264388868','37','rQqvkjDb5upOcdGAOT4h','2','1385549186','0','1385550038','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333096485','632491754@qq.com','671cd312db65b79520ce1acddc147d4b86e0d21f','张雨润','1','1995-09-19','320324199509191886','18344755595','32','QYZO9Q1Cqoe544cblVo7','2','1385546880','0','1385619624','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333029698','819809957@qq.com','34ae4d4a17ab843a66e7079ef7e8387d914826e6','王小川','2','1995-07-20','150104199507200111','13171415661','15','W4TwHsQRO0wLMxz6xZMU','2','1385547722','0','1385548046','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333043370','645413771@qq.com','90c0e824825f86ba6f48bbb0bb69a04363db4d66','王如','1','1996-01-21','610115199601215088','15291413957','61','GEWC3BZHuO39kuWd0e68','2','1385547746','0','1385630099','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333076653','xia570070951@foxmail.com','bf18d72291f5a211cecee17f1a1efc76d7cb8da5','夏红如','1','1995-12-12','342622199512122207','18256540859','34','gACqjCpeYWIJ1jOIdQAx','4','1385547927','0','1385877299','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333077360','wjwyw7175460@163.com','133fd5046679e1326dcdf6e345940e0a028ca994','王明瑞','2','1995-11-27','340827199511270057','15357260238','34','yq6atcOk9KfdmEJmDbyy','4','1385548243','0','1385605478','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333076726','852905714@qq.com','9e465dfada3487d245c4671329e36a31314ad8ce','王宝通','2','1995-09-02','370181199509021110','13969133650','37','OaIxpTDm1fi3B3XIDcEw','4','1385548323','0','1385618156','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333071132','314316153@qq.com','5e21de32f692fff7657d5692f562ee5e3ae8ad6d','卢瑶','1','1996-11-26','450512199611261240','18207797140','45','I85PH9KZramaLvuIoeAF','4','1385548838','0','1385631653','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333062551','mantianxing.95@qq.com','f8f0ded403dd6d072f9fa108bafaa54744ac118b','杨雅洁','1','1995-10-17','130102199510170324','13623310639','13','qW79JCxf5tTjOXUVoKbH','4','1385548933','0','1385810683','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333096212','duanh6053@163.com','d0e08f856a97a763877eb3efbdc6fd6bc30e5cca','王依阁','1','1996-08-06','110108199608060427','13901046053','11','XcLJR2UjsTxRtiE9quM6','4','1385549046','0','1385605753','10.3.1.20','6','0');
INSERT INTO `ycity_member` VALUES ('1333137906','245997288@qq.com','ffb93d8d7144b42157f0de1d484edae90f0de8bc','金珈伊','1','1995-08-26','210404199508261226','18641305941','21','7VhnqGVwELitIzAAqtHw','2','1385597065','0','1385647761','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333192989','2413503754@qq.com','d515e85e2c934ed1fce5185a159f8125f4fe1542','朱开卓','1','1996-06-17','341182199606172043','13215500186','34','PdJYXnv1LVgnOyPjfBa6','1','1385625334','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333166642','1318003863@qq.com','56b582ba90c5115570e5e1925b080f3e153b0d04','朱思绪','1','1997-02-22','32038119970222574X','18811954054','32','GEWC3BZHuO39kuWd0e68','4','1385596807','0','1385690397','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333129698','p2f5cwei@163.com','c9f8033e075f2fbe8211d147ecf897b2d7c413c7','王萌','1','1996-04-18','110107199604181225','13522397201','11','Talure2uBQ8bdycTtey7','4','1385596786','0','1385786594','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333188306','renyue0321@qq.com','7ca0b1055cb2189f092566faedfd134bd9d6e284','任悦','1','1996-07-28','320381199607280329','15862135507','32','cF9t3k4XqO0MiLChu3E3','4','1385596696','1385596798','1385737837','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333129877','1762274232@qq.com','02cda23978edad0be84d4aff8beaea3f414b0682','钱琳','1','1996-01-22','150203199601222420','13664840463','15','55LDWuJs71vbH243LXPd','2','1385596691','0','1385865101','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333273476','1045759075@qq.com','218098cd5349cb7c12335a19b309748f06162ffa','王雅妮','1','1995-05-21','140223199505210044','13152825744','14','IB8TftuSAaxbrmIGWpma','4','1385715855','0','1385771188','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333176726','wangjingxian0105@qq.com','b4c15627cc2d9aa02d6a3891aa9cdb6145df5f68','王晶娴','1','1995-09-11','210881199509113027','18504242155','21','vBHdD5VWc21qR6mohN9X','2','1385596023','0','1385881010','175.167.152.6','2','0');
INSERT INTO `ycity_member` VALUES ('1333178426','13901012187@139.com','f165998a88945c6d2e08629b9877e3663c9af1be','丁帅','1','1995-02-24','110105199502246128','13683034763','11','rQOHkpILug3E8mRvteoG','4','1385595112','0','1385597552','110.96.32.161','2','0');
INSERT INTO `ycity_member` VALUES ('1333177360','807234278@qq.com','6e19c012ce49ea692134aa7b96a8d0bd514dbfcf','李宗','1','1996-01-12','320382199601121622','13776751077','32','VGdC33QRSq8x0MY6UrRk','3','1385594135','0','1385630509','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333120014','1538932193@qq.com','22b2b732a219ecd8b6cba6fba4704a3fabf3f763','王敏','1','1995-02-19','152822199502197227','18704943411','15','kkGeUagbfXtulgZNxltd','2','1385592875','0','1385593563','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333131586','jinlingdcq2981@sina.com','bae8cefcaacf526dd8f3c82c21f49de7c44b494d','章丹馨','1','1995-10-22','320112199510220422','18652042838','32','viMigm3rOt0BD2Zfr4zN','4','1385592394','0','1385724139','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333162551','1098739073@qq.com','ba60b1d45643d18aa091ddf658d8985d1cfc6f4e','王思予','1','1996-01-08','120110199601080365','15620659186','12','CpGCGtLHILwgZzkrBaY2','4','1385591353','0','1385877176','10.3.1.20','15','0');
INSERT INTO `ycity_member` VALUES ('1333134641','1060971780@qq.com','285a223bb5a7aef634d4166681ebc070bf9de34f','赵可心','1','1996-02-18','110223199602184268','18710149153','11','j4XxeMofx7oH0ErOZnTf','4','1385590801','0','1385726642','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333151815','triyado@qq.com','fc1ffe850d085062ab440da270a784fe63b8e1b9','李晓伟','2','1993-11-16','130725199311160833','18612482810','13','dc6uJe9WeCBjjFlYw6KC','2','1385574475','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333176653','50921010@qq.com','a8cf369656d717a44b2b295ec7ccaa1ccf43c87d','马砚芸','1','1996-01-08','510302199601081521','13388336889','51','je8iH14W972Sx6JJtB6O','4','1385573205','0','1385573786','118.124.4.209','1','0');
INSERT INTO `ycity_member` VALUES ('1333135808','1019181418@qq.com','65bc627452f4d72381a89defe024dbbb247b068d','付子叶','1','1996-03-13','150202199603130347','15034710717','15','ef1oSUp3Nhkd48q5wb1C','3','1385569807','1385814853','1385879356','10.3.1.20','33','0');
INSERT INTO `ycity_member` VALUES ('1333021456','1105324486@qq.com','30804cfa1ebb05e97f07d50774cfc12599625233','刘蕾','1','1995-09-25','220202199509252725','15584027087','22','3Q71Z1pH3aFMzBCvBR4K','3','1385553532','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333035808','2464767203@qq.com','c5669373cdac802e84fa5af9411920f1c9dbbb9e','刘洋','2','1995-02-07','340122199502076615','18921167763','34','k78Mux5uwUhPi3d8klH7','4','1385553639','0','1385784856','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333031466','972611021@qq.com','bbc3b49eadad0b5ff7cb51d7a824eeb893a788d7','曹志恒','2','1996-02-15','342222199602153611','15952264788','32','yUflrjkIdVFT4RsDrWUS','2','1385553676','0','1385554289','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333012558','fdmqy2096@sina.com','811f9e0bd3e022d49ee507f9bb662e82eb61cf74','孟文璇','1','1995-11-20','370883199511200469','13905372096','12','7vM3euVqW08JpGLlp9IP','4','1385554953','0','1385796258','10.3.1.20','11','0');
INSERT INTO `ycity_member` VALUES ('1333033732','1179522781@qq.com','292a59d6c62faf68c8523d0c18befb3411f334e9','戴坤','2','1995-05-26','32032419950526593X','15190753382','32','dzvoIYYdxY1whp0ASZxX','3','1385555038','0','1385865148','10.3.1.20','6','0');
INSERT INTO `ycity_member` VALUES ('1333066177','634254589@qq.com','04ba5374abd16eb0b6c43ee1c5756ee0a402a8d3','李旺男','2','1995-07-31','110108199507311434','18201629410','11','kkDnbA65MpVxW1BDlVl0','3','1385555704','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333125211','745355997@qq.com','464c9773dfdbc479f0df124e55fed26c4df07af4','肖彤','1','1995-10-30','120110199510301820','13116012007','12','o7YYawD1fQdRFjYCeHUd','4','1385568065','0','1385818500','10.3.1.20','7','0');
INSERT INTO `ycity_member` VALUES ('1333135699','744288505@qq.com','33d521d6052322571e2f8e7db8ac2615f5cdb9bf','胡羽茜','1','1996-09-26','330122199609263523','','33','Y9quuPl1OlSPU7XbdAc7','1','1385568471','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333144887','1037627698@qq.com','e3cc42e608b27e53f292edd552351c578c691569','戚淑杰','1','1995-10-07','412825199510074940','18987896156','53','JOksh7Ei238QlR1oatOY','2','1385568515','0','1385860538','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333103753','1652018198@qq.com','3990ea384732963ab40311372c85ae2230e288a8','段春喜','1','1996-01-29','53018119960129332X','15608718537','53','XoJuSK2EEra4Ol9fYE5y','2','1385568658','0','1385571976','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333133276','241802422@qq.com','64742ef6e1882aaa5104bc044886c2e597c00851','李一鸣','2','1996-02-03','130403199602030612','15176027922','13','Gr2zD0X6mNEa0mAKAttf','4','1385602463','1385622261','1385737885','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333171395','1018664402@qq.com','b5aac4363fa019ea986a34c91ec81a349bd2a6df','高珊','1','1996-06-14','211204199606140022','18741092013','21','42S3NJrfnQ9iHjiqgGOF','4','1385602078','0','1385800300','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333196485','lihqw@126.com','385d7b929ab6140489f935a54384aaa9d69d8ca3','黄倩雯','1','1996-01-22','530103199601222127','13980603675','51','UZSvKSc5eSudo5KNp0Fc','2','1385601536','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333105362','374611693@qq.com','a83046eec7434ed65e8ff2b2c28bc1531a185082','许鑫萌','1','1995-10-14','110105199510142927','13011142801','11','67OOnsilxuTEGFw4x8Rz','4','1385601525','0','1385874651','61.148.242.132','5','0');
INSERT INTO `ycity_member` VALUES ('1333183296','caoxin235@163.com','353b1536cb36850517cf6fdfa98cf9b350a0c23f','曹嘉欣','1','1994-09-08','130725199409080823','13636392630','13','cRD1CTgkqwWRCAU7JhE5','4','1385601399','0','1385786284','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333153605','982611152@qq.com','e298f6e7db75321aefa1e974ad9821e03bb55f31','索菲娅','1','1996-03-08','130404199603083325','13603100992','13','sMGWAht6qqbCu4cHCZzi','4','1385601022','0','1385867669','10.3.1.20','15','0');
INSERT INTO `ycity_member` VALUES ('1333194013','7464177@qq.com','bcf88a332e7219513267662e361b5aff3988cd7e','刘悦','1','1995-06-12','220202199506122140','13944239123','22','5Nj9DOAHk1B43AW1Lesl','4','1385600819','0','1385813835','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333115331','631975716@qq.com','805a48a654596e922d1b7f3cb1da7d3c44fab4b0','岳鹏程','2','1995-10-18','610104199510183472','','61','kkDnbA65MpVxW1BDlVl0','2','1385600743','0','1385604365','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333174271','531233489@qq.com','f25363062cb759ee91b328c8dfda29d69f4a4b4d','赵君仪','1','1996-06-05','340103199606050023','15305607123','34','OKnxGOSUvLf1ZfJOd0FT','4','1385600343','0','1385873391','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333123000','1436969851@qq.com','6565687ece13d5bbd4f41e0d5b572d781cda4271','曹译丹','1','1996-02-03','210103199602034246','13840263555','21','JLDFusczTOfL1cT99bi8','4','1385600248','0','1385685929','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333136141','baitao6387@163.com','646b67845c2361cd708836b38773c765151fc8e8','张凯玉','1','1995-05-04','150202199505040022','13847256387','15','3vfZ3PMhHCOEKznvEiZA','4','1385599905','1385684925','1385767537','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333116383','1679173748@qq.com','76c942fc28b1eeab33291f690196b20bbeef2fe6','李梦含','1','1996-03-21','320381199603215722','15715222605','32','1Ur5na4hAQ7DYOCPYDdD','4','1385599661','0','1385692523','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333140938','wz3669@163.com','c5e619f50e68884b1d99a5bf13750c025ce52b82','李馨迪','1','1996-06-07','210213199606072520','13842644264','21','NLZOdaMVXs1xPgVvwQrT','4','1385599444','0','1385600367','119.112.75.46','1','0');
INSERT INTO `ycity_member` VALUES ('1333118705','283105765@qq.com','35039a3d61ecd58304144c8579fc6c000dc8489a','胡锐','2','1995-07-31','342427199507310036','13820153211','42','OGY1iU8erTpZJsYxnM2s','2','1385599214','1385609178','1385609197','202.113.41.36','2','0');
INSERT INTO `ycity_member` VALUES ('1333112558','1248244945@qq.com','c6895fa8a7132b1c7dae9cbeab079eb124547656','王璇','1','1996-02-28','320381199602281568','15195491479','32','CpGCGtLHILwgZzkrBaY2','4','1385598982','0','1385708433','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333186634','7451639862@qq.com','8843a8d2815d640488f9b7fca1498285b63e4c79','汤心宇','2','1996-01-13','320382199601130457','13505200031','32','zEC53PCzfQKw7mPft6ZZ','1','1385598727','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333103228','wenyao11@163.com','54e061123213ae1deb346d593eae5ce3b3a1a058','杨婧','1','1996-10-04','110107199610040621','18610313757','11','a6CbFIBugEgnTOS2L5Hr','1','1385597130','0','1385684226','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333143611','yehaijun@syxysoft.com','18d59bc4391f88c806fce28ef7d8fb54027ec7e9','叶卫军','2','1989-06-15','421123198906155638','13622048617','42','B45lYEz9yhMx1Mi08EZa','3','1385597134','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333165738','690977724@qq.com','07ac2e65ff2e87d7d2de5ad209fb6c84d3db8091','钱舒宁','1','1995-06-14','320381199506146024','15190717727','32','taNvbPO4sJDjomFhJ2Oo','4','1385597242','1385598028','1385692088','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333111865','408401929@qq.cm','ac4ab3251c065b278f0e3b86345fd780bd60d0d9','赵维娟','1','1995-06-26','320323199506266022','13585386379','32','QWmEdi97PKWR4Q3Q5IeK','1','1385597284','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333115695','1836274591@qq.com','84bb110d29b0052a35e8c7613639894b0f7f460d','马薇','1','1996-02-09','22020419960209092X','','22','YUSuIoutJwg5y0qENsWs','3','1385597474','0','1385597991','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333171132','354235076@qq.com','e2a77c30c3aa0a9e10a67789a036e8ef10efa84b','余婷靓','1','1996-10-28','452126199610280325','18776882047','45','xteLC8StOgjeE0Ep05XC','3','1385597634','0','1385871452','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333121456','461583241@qq.com','a2f73c61a8ea563c30d0347871bb4be6ab7c265e','朱思晓','1','1996-10-23','210404199610231824','18242366997','21','9pz9MdQmNqnY5i7lj0E7','2','1385597743','0','1385616036','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333134281','450617167@qq.com','f14eb4472c1a9210c7b4372a10d92bfb96d4882e','王禹骁','2','1995-03-08','220204199503081518','18904320010','22','QoMYNna6Wwbdyt3M7T0H','4','1385597768','0','1385634699','10.3.1.20','7','0');
INSERT INTO `ycity_member` VALUES ('1333191610','HWZ82682101@163.com','a921c24e9ed116f3d899bc37d0fb7cf1626572fc','李筝','1','1996-03-23','120224199603230025','18920690050','12','CtnZ2u37CqMmi3nyne38','4','1385598159','0','1385863110','10.3.1.20','9','0');
INSERT INTO `ycity_member` VALUES ('1333198443','1944207473@qq.com','f9cfd56ef1310e29e3d1c4618140f38084f99efc','王雨璇','1','1996-04-09','320323199604095829','18252181879','32','kcs3iOSUMvpXRxPQyaCL','2','1385598383','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333112679','903712425@qq.com','65424d8a1b0647a933ef68947d25f005a13f1b73','吴晓媛','1','1995-10-30','330402199510300022','18967308221','33','K86u1eEzE0zyhT6AM9WP','2','1385598584','0','1385854003','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333153984','910968174@qq.com','bc4751a5d503c57f6723035e375380aa2cf1bbf0','黄梦如','1','1996-05-22','32038119960522522X','15252198875','32','aEv6rMsVa2LO0Oza9m9j','4','1385598598','0','1385693033','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333112187','837556864@qq.com','b1640c4d2c4f8aad82be5c880856cac82375e368','罗煜','1','1995-06-09','532901199506090026','13987237817','53','b0GQJXLQT7rUC7kujBMf','2','1385571378','0','1385736934','10.158.13.169','1','0');
INSERT INTO `ycity_member` VALUES ('1333104444','1220049065@qq.com','1d0b14f474223026fd9198bd2683285b45d5d5fe','王明君','1','1996-01-07','320302199601072021','18652214975','32','GFnv1LXt8a6IksBOYnx5','2','1385602995','0','1385718270','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333133732','6725952@qq.com','3852bd0974c6b1e1dbf92b7d188c9171a4f4337e','何丹荣','2','1996-07-04','321181199607041272','15051137858','32','c1Il7SECfylUj0Mzolwl','4','1385603003','0','1385616734','10.3.1.20','6','0');
INSERT INTO `ycity_member` VALUES ('1333111426','963135203@qq.com','8925d533136882673ed87a0e9f24286a1f0ee73e','解屹鸥','1','1996-05-23','110109199605235240','18210070760','11','BxTO5Ce8dOpHqGrXVt4V','2','1385603822','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333196212','6959074@qq.com','61d9fc5c78fc9e93391cd617b7490ba70b95b271','魏增熠','2','1996-02-01','120106199602010516','','12','NJnpgzWEXoTNC4xGzBvO','4','1385603959','0','1385604518','111.167.173.224','1','0');
INSERT INTO `ycity_member` VALUES ('1333143370','352249003@qq.com','7b39abfb00f810687c6323504c0b78aac3e5d38b','姜立志','2','1995-10-08','231004199510080734','15692292134','12','nuphUZL4Klpn0W2ooAbi','4','1385606027','0','1385715530','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333192917','1207397649@qq.com','b0a1636b2610327ef267da92fea902e46eaa426c','汪美君','1','1997-02-03','340405199702031622','','34','yFIouuofjH9fA6KK4JIr','4','1385604634','0','1385714165','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333172894','1275634543@qq.com','cd2967d4f2c71fca25862dc610c095e1164b8169','王志金','2','1996-11-09','320882199611094215','18352352782','32','qfQ4AzdWMHqbC390kn2T','2','1385604809','0','1385777192','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333156746','736858786@qq.com','87e65c446072fa48175c9a113360a6918d4ece6f','郭若瑜','1','1995-11-25','510183199511250042','13730611678','51','wZeL7or3j0OorO7vIwku','4','1385605084','0','1385866104','10.3.1.20','11','0');
INSERT INTO `ycity_member` VALUES ('1333102717','674299181@qq.com','6f11ff2833c853d92a8f25b1024bf1889b00077f','辛江姗','1','1995-09-20','340825199509203127','15056677013','34','uqPvCtziUMZo2JMTwOqs','2','1385606444','0','1385607305','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333131466','2607055573@qq.com','f7b7a1de88c8e2a5997ae4a6dab92344ce31e6e1','黄梦桥','1','1996-07-16','340825199607163720','13637154155','34','bW0CmVV6mZ8OZ28g2pww','2','1385606635','0','1385606997','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333166177','1575845260@qq.com','02135dd98d0abf32e8c380c6a8982fa27dc2673d','胡美芬','1','1996-09-17','340825199609173922','18726183385','34','dfOr7OLfCRQuCWYVkfwx','2','1385607240','0','1385620214','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333127526','840667376@qq.com','0505b7a8395bdf1887cb23cf0da44048cab0b6f1','金昊潼','1','1994-07-31','120222199407314624','18322768032','12','ds5QTSK5upyTCHr4uQQU','4','1385607326','0','1385872169','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333141942','536756922@qq.com','9d055c8163eaacada26a29dc886056950815645b','蔡焙璇','1','1995-10-14','371002199510140029','18663162262','37','BJ9BRyQqDmCzi632KCuM','4','1385610019','0','1385641371','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333114035','863246088@qq.com','4d9ff53890105b334c06e4b7c9ed408a1d8a5702','张吉玲','1','1995-10-19','530402199510190924','15096787992','53','sd7Z7wE9mcO1TXQ4FICQ','3','1385644246','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333133344','angelaaalcr@hotmail.com','8ca4693f5c8b09b188db6c998396bb0931acc669','李莹','1','1995-01-10','342623199501108166','18501080868','11','QHXJzUzKfQweIRqply7G','4','1385613867','0','1385875853','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333119839','xyq.316029588@qq.com','7b15b1eb8dfc6250d44eb9fb5b0c997dc7c92ad7','杨洋','2','1995-09-09','130423199509092857','15233107972','13','APDfNCD6FUmkd8Ns4Q00','3','1385614303','1385725331','1385724933','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333220312','254892827@qq.com','780415164f2764b47e4fa7dd1ddf35bc4445c636','张允轩','2','1994-07-03','320382199407030217','18451555478','32','PumQqUeMt3TJOMzuMwsK','3','1385736552','0','1385736841','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333126506','tom@cauc.edu.cn','02368059da55765fd6c63c941955ef35999efcea','汤姆','2','1994-01-01','110101199401017574','','42','h0H2WrmrNHdxAaJXpuAi','1','1385644314','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333142171','960539014@qq.com','6bc62f1485567524ef81c923ebdb4dacfe6a6b47','李颖','1','1995-12-28','371325199512280085','15253951983','37','eqbmtAlkAQHHmVcRnFsA','4','1385644355','0','1385801343','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333179662','gaoxiaohan199615@qq.com','6b9299b99ac286181fc563eec9cb8641dc1f91e2','高晓菡','1','1996-01-05','110107199601050326','','11','66VbCwgRnZdwlWGsb6Tv','4','1385644396','0','1385816935','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333190657','784671530@qq.com','b8fa09cb28b255d9f1821beac8a9e315132ac62a','王希宇','1','1996-10-14','320723199610140069','15950764999','32','c7a7XYGp6AwTzuVW4dBS','4','1385644407','1385647904','1385813852','10.3.1.20','9','0');
INSERT INTO `ycity_member` VALUES ('1333196896','t2t2t2t2t2t2t2t2t2t2@foxmail.com','b43d777e7d4fe8213267ceed1ff3f771d755b4c2','沙昱彤','1','1995-08-16','220204199508160629','13904428120','22','bCzZnwqBzWDETUO3BDRj','4','1385644570','0','1385726488','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333150071','13513035047@139.com','4cdabee84b1c5f870ef9dd6b40d0cc1cb7027e42','贾玉营','1','1996-05-15','130929199605150346','13513035047','13','5lCOJoPEZebMXOPznIGR','4','1385644613','0','1385792602','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333198452','459477299@qq.com','4ec55e2bf57fbd9c6e3186b66b988f8bc4b7f26a','于新宇','2','1996-01-23','32081119960123061X','15805234120','32','zESuyTKrdHFWyR5Y1Hpr','4','1385644613','0','1385867862','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333156274','476824892@qq.com','46a6cd99bf9c72b309585fd4bc7a23429a1fb3a7','王婷','1','1996-03-11','61040419960311056X','15592010013','61','otguwvHWTiZAvorJq4AL','2','1385644651','0','1385645390','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333132854','1065047160@qq.com','c1940ec98a7d026d57cbc63262b0c380d1a4e53b','柳永康','2','1995-07-28','610104199507288310','18220192832','61','6nGVJgOH7GEPfq902y2X','2','1385644676','0','1385728222','36.40.184.169','2','0');
INSERT INTO `ycity_member` VALUES ('1333123443','wzq19960104@163.com','aee3291b7477544ac3813688844fe198e18c58b2','王子琦','1','1996-01-04','110105199601045823','13651191663','11','0yKuGlmyqqarIxqhuQhX','4','1385644830','0','1385724471','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333185934','852153266@qq.com','e8249c05ba709712a8666c4c5232f932a6df90e5','吴梦旭','1','1996-11-06','610104199611066144','15991160175','61','AaCOhx8R283A2AYpAmOp','2','1385645066','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333164004','1123249358@qq.com','21efd2ef2583b583fbd4299c7f46e4d7a7ab056b','张欣','1','1996-08-25','320323199608252422','13913457923','32','xpx1wMbI24mKsYUZCOBq','2','1385645074','0','1385803760','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333120334','921472422@qq.com','78e8e2e27e899f742fdb39c6c49c825936157bc5','韩子璇','1','1996-07-05','130102199607052148','','13','bPHhKpeOHaPxanzm3I92','3','1385645097','0','1385692125','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333182828','aem023@sina.com','9e54b3d7e10392312058ca90b327531d7dff6ef8','安奕华','1','1996-08-23','610103199608230429','13909260285','61','rnNK54WO01WLlJm45R2Y','2','1385645125','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333117194','403090811@qq.com','9e738ebb72c53180e26490366a0a966c970d6d96','翟孟妮','1','1996-03-06','120104199603066025','13502052603','12','kkDnbA65MpVxW1BDlVl0','4','1385645151','0','1385734460','10.3.1.20','6','0');
INSERT INTO `ycity_member` VALUES ('1333175077','893707594@qq.com','987f2ae1c20edbe8531dcd813dace2fcf23c4fb5','刘颖','1','1995-10-08','320382199510080247','13776756567','32','eccWLWVCRhltzHEpKdZ5','2','1385645808','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333115612','709286686@qq.com','1f05321d410dff73b8363ff660f662026978398d','刘卉','1','1995-10-08','320382199510080220','13776756567','32','latXQV5U6qeBfUc0p6dU','2','1385645230','0','1385648483','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333178104','734920174@qq.com','64f123d080e7d1cd9d69a15e26fc7b3b6a56d2d7','杨宇博','2','1995-09-07','61010419950907341x','13022982531','61','l7mbi5scyFVJj0kIQ5WI','2','1385645232','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333151583','842440383@qq.com','e4ba6cbc61facd555474c97a33baea3037a2de97','林馨玥','1','1995-08-29','510113199508290028','13699020771','51','Dy0O5WFtGGJpHqmT8WKV','4','1385645256','0','1385717099','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333159319','815280102@qq.com','1a3c65f2fe93503966970a8446674b8e47081e0a','孙振欣','2','1994-07-03','120112199407032119','18222271634','12','5tRe6Q7y9Ji2EoY7CDv0','4','1385645274','1385709776','1385709716','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333107823','346924918@qq.com','4b627f2e24dbb5358a816de30789563622d98234','汪同欣','1','1996-06-06','340122199606062728','13721025760','34','Avct7lA5RYyeTZGPUu4w','4','1385645302','0','1385650302','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333145336','602269596@qq.com','4d905c8843b2fb33f9226fdf1c9846a793419cf1','吕嘉丽','1','1996-10-11','142623199610110022','15835788243','14','ofzax2Ykc9TkQzBuaeca','4','1385645372','0','1385691564','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333187525','974686254@qq.com','cf2e4c64d5d6d9c4cce18ebda53bf70fadcb883d','李梦娇','1','1996-05-21','210281199605216429','15040568307','21','wwec01QlHsLBqYdyz8rK','2','1385645423','0','1385805446','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333137534','352720495@qq.com','2a42483e6fdd488837d34bb2b12f453b17acca5c','刘宁','1','1996-01-24','120107199601246347','15122290363','12','XcLJR2UjsTxRtiE9quM6','4','1385645571','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333160903','','cb92ec2fd879dd53c8f7b507ea28c4d8ce05baf1','','1','1995-10-08','','','0','BKc0l98LsByOHBOtgW2P','1','1385645577','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333168717','449149841@qq.com','4ae62b3afe4560ad091396ef8c7de3d2f01512eb','朱思羽','1','1995-01-17','220381199501170048','13944467873','22','DHm9Oonl9rnumxjpPglz','4','1385645581','0','1385709724','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333109310','','9f8254f317c87b7003d6612d05aa55e6c34da8ae','','1','1996-05-14','','','0','qfQ4AzdWMHqbC390kn2T','1','1385645668','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333184398','','d64e840ab10c42fa9eeb3dd4439c71a04e7d72cf','','1','1995-04-04','','','0','YczYamLCPm1H21hOSZtW','1','1385645682','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333176520','15222013322@163.com','a55bc19aaed791edeb55b9ca291f326162e8e8d9','孙颖','1','1994-05-01','120112199405010928','15222013322','12','4gzeoThpcJD2wRVFyy2E','3','1385645810','0','1385727458','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333154666','www.799020714@qq.com','0edaf49d8d47ea172f316dcf0e0cbff2edb94613','寇超靓','1','1995-09-02','120222199509020029','15122228511','12','vYFSbODyvyTH2FTzUoJd','1','1385645958','0','1385687279','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333171876','1970643909@qq.com','6ce5d3f5add6c8a881ca4478c9c29f53dd84a0c0','石鑫怡','1','1995-10-05','610104199510055729','18392069802','61','E64enAtgwdDJWODpGmmt','2','1385645962','0','1385646233','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333134378','806857730@qq.com','9be7428cd92dcb7ae4d2ff5de04f73a6a13f093a','张雪','1','1994-12-08','120112199412080449','13920741095','12','o0ttBLXmU5dkkQlez127','2','1385646004','0','1385721386','117.136.1.80','5','0');
INSERT INTO `ycity_member` VALUES ('1333135944','','d64e840ab10c42fa9eeb3dd4439c71a04e7d72cf','','1','1995-04-04','','','0','bxkHacIdKFdE7yDw9nrs','1','1385646052','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333143716','1121188083@qq.com','308c56365bc8d9ca026802ef851e533317eaa06f','孙娟娟','1','1996-09-24','340402199609240420','13615541719','34','20RBluXDiFhAYzqiqFIG','2','1385646072','0','1385880541','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333173438','449542415@qq.com','67e61b91595b60e23ecf8f5cebd5384a33beab26','杨佳豫','1','1996-01-08','51090219960108950X','13882558150','51','5tRe6Q7y9Ji2EoY7CDv0','4','1385646179','0','1385824288','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333112541','386497073@qq.com','7fb0fb0151003709bbe9565fd5b69f0da6e8afc2','寇炯晨','2','1995-09-16','61011519950916381X','18089216281','61','4dou6MfCqtDmFdPL2yBs','2','1385646189','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333157874','','0de3d4d7fdfdef1a2ee5cd00b67ea7903dc3fca3','','1','1996-05-20','','','0','dfOr7OLfCRQuCWYVkfwx','1','1385646216','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333110932','1976117053@qq.com','ab0656e85a38ac12c4f352842844c8ed5f429187','聂新强','2','1996-07-09','610104199607092614','13022869623','61','L07ReOpAz1OOH5MeLJNL','2','1385646278','0','1385647097','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333189066','','7d222425385f0f4bbae720deec904a9609e6ee0d','','1','1994-11-17','','','0','Oso1Lrq8rSaOUlQIbMKe','1','1385646430','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333118736','491140061@qq.com','49233d5056a8efb5ca72b554b7527a41361022f2','崔博学','1','1995-10-18','110104199510180425','15001035803','11','i129J5I4SKUedTTgQHTO','3','1385646513','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333100045','2609024141@qq.com','e2ab530a2e7cb5ddc1133adf6f7b27299c302602','张铃艳','1','1996-08-17','120101199608173525','15522323350','12','mwnCTGlLE7zGFAdkVa2O','4','1385646689','0','1385870902','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333125076','1585206575@qq.com','a96ba2e23bc1f981b2d961da9ed743ef5b3d0524','陆德蕊','1','1996-09-07','320381199609070325','18751778885','32','dkhG2ZEfCCPvzAjpxXFv','2','1385646719','0','1385714783','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333146896','775830937@qq.com','d64e840ab10c42fa9eeb3dd4439c71a04e7d72cf','董瑶','1','1995-04-04','340602199504041223','15810956582','11','l7jjoq3GVFCxgIKzPhu8','4','1385646886','0','1385648316','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333165613','944136331@qq.com','7439e60a405cbae432c897339e09d702bce6868c','韩雪菲','1','1995-04-23','500225199504233826','15892927614','51','6gyHWOgCsurwhNFwpHxo','4','1385647161','0','1385737620','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333170332','365806069@qq.com','9faeb244348dc8689a8093a500f29d4b66c9ddae','冉月','1','1996-05-14','110107199605140628','15901062357','11','vg2JSmOdutvnSndcgZb1','2','1385647304','0','1385648303','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333195330','1007898062@qq.com','3f059544f412b67477133cee5560833865a4f282','李莎','1','1996-10-16','330681199610162946','15267566317','33','o7YYawD1fQdRFjYCeHUd','4','1385647476','0','1385732521','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333103113','liuwenyu728@qq.com','4eb7f63eab68c8a77e025df290ee46dff33e169a','刘文钰','1','1995-07-28','140109199507280027','18636673188','14','lHZDDqV22dzz0qJLTt99','3','1385647678','0','1385861528','10.3.1.20','10','0');
INSERT INTO `ycity_member` VALUES ('1333167142','598202611@qq.com','b7c03bc962a17edc3fe1e219a6d408001ea16849','李星','2','1995-07-15','152801199507150012','15148859180','15','xdqp10JpJLS9ddVn9XDB','4','1385647806','0','1385687336','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333140688','652212464@qq.com','c1ac94418e2c4b2a5df2a6de0cb18ae940a3acd4','谢景鹆','2','1996-08-04','610104199608048332','15091446583','61','liHy22GpQTrgtrSjRcqj','2','1385647813','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333121812','381563785@qq.com','d62f77172c82103d0819fea9b8ad2455a7a61dce','舒蕾','1','1996-05-10','610122199605106827','13892818750','61','GjJoO82tzR4Dwp0dT01T','2','1385647834','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333157822','bj-whj@163.com','8905f9ce521128c19e499f2d125410e4010bb226','杨紫璇','1','1995-10-19','110101199510194027','13718986700','11','l5geCBCGDqIlOfPi1fU4','1','1385647910','0','1385865932','10.3.1.20','15','0');
INSERT INTO `ycity_member` VALUES ('1333106236','874000812@qq.com','bdb3626e3417662d0867fa06e01c7a69956048e0','王耀宽','2','1996-11-15','22020219961115331X','15506025730','22','VNE9J3PCVuqdVWGvL1Lu','4','1385648161','0','1385785043','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333139073','zhouyutongtt@126.com','228269ba7ccadedc1a44cc7f2ea5506713759dd5','周雨彤','1','1995-08-16','110101199508162528','15801536979','11','4rYEOM2H77gLm9YxRjs1','4','1385648233','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333128186','652759810@qq.com','1f2d8cb9eed00843a1c70477fa3f34a0d1d7dec7','刘嘉展','2','1996-03-14','612323199603146074','18966924888','61','UkbvQmg5fUJ5pPpMWyPl','2','1385648485','0','1385649669','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333150005','956787248@qq.com','504e561e01df417321beed30b86f52beeeb155e8','李小钰','1','1996-05-09','210103199605092724','15840197059','21','504eHUZB8gddpgULGtHz','2','1385648747','0','1385649579','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333193720','595817784@qq.com','e62ecea7023e44d3454911d230969f457c49e0a7','陈乙嘉','1','1996-05-07','530402199605070028','13708776411','53','Gr2zD0X6mNEa0mAKAttf','3','1385648874','0','1385721489','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333101516','dh9988@163.com','1857d4fc198cdb411f4d2ba37612a0214c0c55ef','董京帅','2','1995-02-12','23010419950212341X','15301688168','23','gsY21hzgqFeurvAFPOAy','4','1385649289','0','1385820613','10.3.1.20','6','0');
INSERT INTO `ycity_member` VALUES ('1333181291','766516954@qq.com','432f9828872680ea22c8adc7e8d64197fc8ad737','孙','1','1996-03-01','230802199603010524','13766661171','23','Zk5rhdvCjFJ7Wln3YZOL','3','1385649384','0','1385863137','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333153113','767704447@qq.com','d447b062d49414f6acc8b614a823507fbe0b7b28','陈琼','1','1995-12-27','320811199512274522','18361478182','32','LekcxW1Kl0C0M9fg4YBI','3','1385649413','0','1385811735','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333162554','913296201@qq.com','67225c8cb34920a99cd1c30a000fcff1ba083831','杨雯淇','1','1995-03-25','210402199503252045','15242336315','21','ZkPpAPKUoTygSEWjdWii','2','1385649421','0','1385649737','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333104666','1852288730@qq.com','76b09ad99a0e72f6b2190d5b21449406fb2ae62d','王展','2','1995-11-26','610102199511260019','15829685688','61','LJ0rtMtsZUJkORVlHneK','2','1385650035','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333148405','597749199@qq.com','82d9542b203ea2ff6822eace82bbb88402a5b025','阴晨雨','1','1994-11-07','51100219941107152X','15183250837','51','LQHUWpR6YqKFz6uU17JC','2','1385651197','0','1385868367','125.65.200.188','2','0');
INSERT INTO `ycity_member` VALUES ('1333131292','569279823@qq.com','9be5c63c3403608a58ba0d2aa125395e965ef211','郑艳','1','1994-09-27','120224199409270023','18222916325','12','oEEZXbwfGGsEbm3e8kCG','1','1385651319','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333267142','770698679@qq.com','27f29b50a50f95a548aa4609ec6742d3b6d51102','吴含东','1','1995-10-28','510183199510280020','13551395005','51','JAiOW53zMWc3Njvxstbd','1','1385654491','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333234378','470575146@qq.com','b78c38d8bd7889e9e30eaa4d6a316e3e04307001','刘旋','1','1995-08-31','320325199508319143','13776756057','32','TGzqynUJKLniZsei1wW7','3','1385654571','1385658235','1385734622','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333284398','www.1714537316@qq.com','26667992d885d6a4cc4477ac261c442fc0b1b424','廖娟','1','1995-11-20','513425199511203946','18380422772','51','I0ON5otGGvBe8D6opin4','1','1385654706','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333275077','74031402@qq.com','e714531891212a274c3c68123a2933f6ddd4d444','徐苇','1','1995-08-30','500384199508303823','15310138528','51','dqJdMHKsaO1Bl9B08TE6','1','1385655760','0','1385820954','113.248.250.74','4','0');
INSERT INTO `ycity_member` VALUES ('1333226506','602429706@qq.com','24fa7bcb8d44a947eceb02dbf1bedb59d9a0f8a2','裴悦','1','1996-11-22','530122199611220845','13108663719','53','XcLJR2UjsTxRtiE9quM6','4','1385655887','0','1385689828','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333271876','838579784@qq.com','44fe152304d20f8908384a0c7ad6b089472fce7d','吴东魁','2','1996-01-31','320382199601310212','18952105083','32','mqQCPzhidPmbb5wv52Jp','2','1385658218','0','1385691338','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333235944','651691414@qq.com','e7c5e1914230502d27934a9b147ae04f41811f55','吴海伦','1','1997-01-15','320123199701153620','15996337834','32','I4RCjza6dYB2T4FUs69O','2','1385658616','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333289066','ttwygz@126.com','690fbde7b7d67a7eb3a6ee775d408b09079abbf0','葛汝樨','1','1996-05-09','211481199605090629','18642918486','21','LYelwJ37M6ra34fU3Y0g','4','1385673418','0','1385800589','10.3.1.20','8','0');
INSERT INTO `ycity_member` VALUES ('1333281291','1044764575@qq.com','dbd61e12cb4ee776523565ed8e32509b857c4af5','朱思婷','1','1996-09-27','430124199609274982','15580022875','43','KIxrOlGGfhtsUYc5FmeG','2','1385674586','0','1385815038','10.3.1.20','9','0');
INSERT INTO `ycity_member` VALUES ('1333279662','861186732@qq.com','cfbbbd0083d4244a6198e7c40ae3c9e45778870e','米雪','1','1996-03-20','320381199603206041','13814412648','32','agn1aMMtJZe7R15Pupua','2','1385675090','0','1385715141','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333204666','alma1023@126.com','a9626ea98da13500384753cf27f6f47c0ecf228e','孙笑荻','1','1994-10-23','120105199410234826','13512871384','12','Q8vyW5c6sUcuuoZOWGce','3','1385676901','1385773008','1385856421','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333232854','1228640703@qq.com','9b23caf7c7995ef1866cac6d732554095153c184','吉洪雁','2','1996-07-25','320882199607253834','13382335750','32','BACy0B9iZN8owMQwY7tP','1','1385680409','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333225076','gu85495392@qq.com','690c419ee1a1ce0a8befb3f26c12754a0d958d7e','顾绪跃','2','1995-12-01','320882199512014216','18505216024','32','MRJylpu0LQjOUE7ssloP','1','1385680578','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333273438','458308678@qq.com','7ca240219fb5f6625915b16ef9802d4e29c54080','王乐','2','1994-05-27','320821199405270115','18351475107','32','GDO0m3E2x4m9GIR5zLpP','4','1385681218','0','1385716643','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333206236','zgmhrsq@163.com','e67e80dc645441793b1abc81ed212ab8f59815ff','任思齐','1','1996-06-10','230321199606100404','13199161377','23','kmppRQaLofWSpc0aB9TY','4','1385682658','0','1385732737','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333296896','d15110174958@163.com','b535323af2d62d5a83351ed1c665ea2f49e9462f','邓佳钰','1','1996-01-19','110221199601198323','15110174958','11','89kqFgyMn7k7xEalew1O','4','1385682952','0','1385723348','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333246896','kedian4101@163.com','112eba148b10e5764e0913f35b3bf520d890324b','高悦','1','1996-07-09','120109199607090024','13820626825','12','HdZzw8ByvVRiem75QLz4','4','1385683222','0','1385686730','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333228186','282638284@qq.com','9df6472d07e5a1092f89ef10775d4976aa29c269','李晓芸','1','1995-11-07','140106199511071229','13835127055','14','JtKNljMvVrP5kZgmwCAs','4','1385683484','0','1385876011','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333298452','905224052@qq.com','9efd1add808c6bc2f84b4db865baa0d78369c84a','闫佩瑶','1','1995-11-23','110105199511236124','13801183162','11','OfET3QFXaT440C1CQyzo','4','1385684006','0','1385725024','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333290657','527565819@qq.com','b71480cf2a6d39dba6082562f413eb3ae087632c','邹笑','1','1995-09-29','370684199509290026','13562516599','37','7NAJkzkQkiJTuxlglkvN','4','1385684581','0','1385882745','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333259319','844399212@qq.com','0a97bcc2050239949770488541e9a8a11e28a135','毛然','1','1995-05-19','120110199505191225','13920806339','12','N5qN23Fbyq5iBsiaQB1O','1','1385684940','0','1385795611','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333201516','929265392@qq.com','48faa50ced1c24d9c6d68dd2c51fce3afcaa29f7','吴双','1','1996-03-21','12011019960321032X','13752750699','12','PbWmUCrAG3oNPgcCNNiP','4','1385685292','0','1385867010','117.10.152.40','5','0');
INSERT INTO `ycity_member` VALUES ('1333214035','mbai@cauc.edu.cn','35039a3d61ecd58304144c8579fc6c000dc8489a','王浩宇','2','1994-08-18','342923199408180012','13829153211','34','irkRzHwtCcwVHA4ofyll','1','1385685340','0','1385689855','202.113.42.225','1','0');
INSERT INTO `ycity_member` VALUES ('1333257822','539855831@qq.com','5d1325fa3310a1d26ac6e1f511b5230b6ffb6a6c','刘欣鑫','1','1996-03-21','230803199603210346','13684541617','23','uMP1sp6Yd84LxgcuaIPq','2','1385685664','0','1385711956','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333229633','2759087635@qq.com','3cc21468e316de025039b76d231c4d67e56aa9ca','王文强','2','1995-09-20','41282719950920267X','15100071024','13','HChf5klsUclSkM8eWUOb','4','1385685763','0','1385879850','10.3.1.20','6','0');
INSERT INTO `ycity_member` VALUES ('1333264004','871272312@qq.com','7e4bc94c0e8dd14fe31d7000becc98689e85ea39','王艺蓉','1','1995-01-29','210403199501291522','13898306793','21','SOvc0T8ZxvPqsYm5POVG','2','1385685767','0','1385686598','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333253113','312530315@qq.com','238a01f707fa67fd69e873b4e76956ac7017bc34','潘子婷','1','1994-12-05','610404199412053523','18291048504','61','QWmEdi97PKWR4Q3Q5IeK','2','1385686235','0','1385686763','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333242171','WFDDUJIAN@163.COM','4a1a986014478f11c1c1861e63c58aec15564f2f','彭榆涵','1','1996-11-03','210281199611030823','18940817797','21','jRN6YDCLYFIiPykOOa1M','1','1385686272','0','1385727258','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333251583','469415349@qq.com','e405384aa4dec69167c345d45597b46b9de090d3','李紫玥','1','1995-06-08','532901199506080047','13988506830','53','oaCGSAGib0Wou6Qq3oG7','4','1385686695','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333293720','renmeizhu@126.com','5419295062e548483f07575c0f002b57bcd73aa5','刘铭琬','1','1995-07-26','370105199507262520','13791044519','37','aiE01YVJprC1GwaXgJhN','4','1385686794','0','1385813081','10.3.1.20','8','0');
INSERT INTO `ycity_member` VALUES ('1333250071','13520508877xq@sina.com','b3c90b572a8a8c3230ebf642e5cab21ae7baf11b','赵一帆','1','1996-03-18','110108199603188421','13520508877','11','i129J5I4SKUedTTgQHTO','4','1385687062','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333231292','1401239000@qq.com','4f74b85c2f3a2d58db90d3bcc4563f05585e7d73','王昊','2','1996-05-23','22020219960523181X','18943245939','22','Lgs3w2PGB8PW9IqT7dFJ','2','1385687358','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333248405','1145790827@qq.com','0ae7797c1bd294308fe5a9096d4a2ea9fa6e9d45','王欣宇','1','1995-09-07','120111199509070523','15902267255','12','MiyjHLdwwO9Ea48a25Qc','4','1385687643','0','1385711690','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333268717','yanli1972@2008.sina.com','d083bf7308bf3d52fe117b5b893ce687653326c8','尹晨艳','1','1996-03-02','110102199603020022','13621186581','11','wZeL7or3j0OorO7vIwku','4','1385688345','0','1385734776','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333265613','724263663@qq.com','35039a3d61ecd58304144c8579fc6c000dc8489a','王青','1','1996-04-02','320826199604020049','15805236353','32','FD4fdvD0yPU0lmVo0svm','4','1385688410','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333207823','798539506@qq.com','973a7289b905f2025c1caead2882cb46df96708e','张玥','1','1995-12-27','120111199512270024','15922298323','12','x4LRCM0ngLtGl0OadTsx','3','1385688618','0','1385813223','10.3.1.20','10','0');
INSERT INTO `ycity_member` VALUES ('1333240688','1010750562@qq.com','eab7e464deea1db03aa7f0ed0d266f4b5fb3fdcd','何民玉','1','1994-12-13','420112199412131526','13098804265','42','JOksh7Ei238QlR1oatOY','4','1385689056','0','1385880795','10.3.1.20','6','0');
INSERT INTO `ycity_member` VALUES ('1333239073','1393592877@qq.com','ea5fa48fb92f21fb567f4b0a45794f3f216dbcd2','林佳萱','1','1996-03-15','210302199603150948','13700122199','21','OsWKlcpw5l6SpMXj1xOX','2','1385689478','0','1385810225','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333292130','jlybzwang@163.com','13c5ccd10b2499091ffdbc0f0bcc6735b3f3a668','安诗雨','1','1995-04-02','220282199504020820','13843337577','22','A7OaLXsd5I8x5aeYhJa9','1','1385689677','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333218736','411640788@qq.com','41f53dbba7b6db52c1f2f732865c10da89c22e6d','杨镕容','1','1993-12-02','13010219931202182X','18932947587','13','GEWC3BZHuO39kuWd0e68','1','1385689686','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333217194','1915165918@qq.com','1c1ec31a5222a38f0eaaa10bcd05a7614424ccc0','李敉乐','1','1996-10-01','32038119961001382X','18260378431','32','bWFk8uAFfAhnPbY2yOLO','2','1385689929','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333270332','604762690@qq.com','2cc01b5af9dba73f0609d31f1a8bf775c4715cd7','曹馨戈','1','1995-06-01','220202199506016022','13578520326','22','M1XTehmb1qWsCpweSoRF','4','1385690061','0','1385715344','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333245336','939264320@qq.com','2e3676c6ad8c629056f64c4dea1862226e2f5f6f','舒琳','1','1994-11-09','320381199411094444','15952193145','32','RXy5HlX2T8ZVRJA5jVsf','2','1385690518','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333220334','1297840607@qq.com','70005d635d9113b23d5b1034b71677a2a4a95e75','宋春颖','1','1995-07-01','320381199507015720','18914867189','32','cZMHIHgMGDT5OxFnauPS','2','1385690680','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333215612','1176705804@qq.com','e8a2186cdc68db0eb5b668594828119eec0a511d','王宇恒','2','1996-07-09','37050219960709001X','18754670270','37','trjG1RcxGR348dsOqMsH','2','1385690803','0','1385691035','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333256274','463979428@qq.com','6589f163ef80fecbb798510bd1a33c6185b278dc','刘钰婕','1','1996-08-28','131082199608280764','13681507605','11','1rlJesaKy7FstuEROGzT','4','1385690997','0','1385866742','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333295330','411650788@qq.com','8569e81649aad9522989c943c4e8bcd9f12cf313','杨镕溶','1','1993-12-02','13010219931202182X','18932947587','13','cqgjrPyr5604nJVht6Yr','3','1385691140','0','1385691995','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333237534','1339260952@qq.com','067b6bf16e6065a885c5ce38aa4eed0540396adf','王逗逗','1','1995-11-18','320381199511184447','15852294926','32','XPgoJpHZ5JYAhophqa67','2','1385691152','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333262554','364318781@qq.com','4558198683e907348a2560ae8bc527f4f19f48fc','张天译','1','1995-12-04','220602199512040987','13943970803','22','45nvKkOqANrDGyeDlCd2','3','1385691592','0','1385692346','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333223443','597317960@qq.com','799e5d6520b1d38112df0688d05f74c92f60948d','吴双','1','1996-10-12','342622199610120627','13865266616','34','clvhYUzTjCK5JgCt0Rpf','2','1385691628','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333287525','1005962645@qq.com','34aac6a55b7078d011f76129e9604521d96141d0','乐佩','1','1996-10-28','420922199610287720','18672297882','42','sBtPUVQqqCc5yC9wtsIR','4','1385691960','0','1385710165','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333278104','645148133@qq.com','fad3a8444ae94e99f623f47cf15fb7e81a4d2235','赵杨洋','1','1996-04-17','110104199604172020','13501398205','11','OEtALmaqIl6PFNkAyLjF','4','1385691995','0','1385710114','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333276520','xzmsmxzmsm@qq.com','965762a8f300dc531493c42cdc9284abba306983','王雅琳','1','1996-07-30','320302199607300822','15862262795','32','fIOPPiDl9UNDOLFqNon9','4','1385692071','0','1385859083','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333210932','935444147@qq.com','9beaf87a6ab60887ba56348ece80d954ccb9376a','金多','1','1996-01-22','230703199601220422','13845899998','23','kkYeTIIxqqawqvSuDSle','4','1385693088','0','1385779216','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333254666','xinmei_ma@126.com','63fa834c0ad39bd35388bf13ddf2a2b0b6ce6d70','马萌阳','1','1997-09-05','11022619970905004X','13911833629','11','a8e5GlV8nRGV05nuajc9','2','1385693175','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333203113','610832947@qq.com','19dc4b682878abd43ecdb52c571b64a24d888566','胡丹丹','1','1994-12-09','220202199412090926','18604324218','22','7PdELz9ope2bmLMvbZjC','4','1385708688','1385786243','1385867423','10.3.1.20','13','0');
INSERT INTO `ycity_member` VALUES ('1333209310','cwcguofei@163.com','ae4d04dc0de25bfc0cddba0ff491917f7f465a23','黄子彧','2','1995-08-28','21050219950828093X','13941408589','21','KlUMVsiC5LRz9ZXLdawa','1','1385709388','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333212541','297318507@qq.com','3cc21468e316de025039b76d231c4d67e56aa9ca','姜若男','1','1995-03-24','152128199503240629','18347038105','15','OE3iqGhEZ3Px1oxBAHeL','4','1385709492','0','1385711179','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333221812','aikoko365@163.com','70898f5ce4c70cccd806fe9beca28ea793bc8c7b','李佳馨','1','1995-12-04','230103199512045527','15590886656','23','6r4gIiCL2YepqL1z7XOS','4','1385709906','0','1385711233','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333200045','wangqingxv3035@qq.com','c747483441c14a62ebf75da19f3e154c196b5915','王卿旭','2','1994-03-31','23060219940331061X','13466749806','11','4g96VZkZhdKyJsXSAbIm','3','1385710209','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333260903','1005085930@qq.com','9728e1065b6477843a6a140294b42a1d7ec6124e','贺信','1','1997-01-02','210114199701021829','13889881057','21','bxkHacIdKFdE7yDw9nrs','4','1385711408','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333240673','1066826055@qq.com','eaf97304326fd7457eca03896807660f45dc1fb3','李先凯','2','1996-05-30','370281199605307616','15092434787','37','W9JiGBt5381d8Fc9YPIE','2','1385713145','0','1385777231','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333217112','mulan.ping@qq.com','ce643dde8c202938608e10bc9f60625f41f125b4','王雪萍','1','1994-10-22','230125199410221823','13142513888','23','epq4cIu6OssI4QMDooGF','2','1385713267','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333234354','www.1018644778@qq.com','f87d20e55ffa868bc746d599bb893b059add121f','胡大伟','2','1995-06-17','320826199506170430','13395203331','32','ONoShMhMEx8woOGxRHeQ','2','1385713288','0','1385722755','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333243716','734873423@qq.com','bf530a7aacb7dc035675fca7600dc857f019f694','杨彤','1','1996-07-07','120103199607074229','13512440800','12','UU0ELi1qVRwerKzG8lzu','4','1385713353','0','1385873334','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333257874','1358479867@qq.com','44b5bbd457d0e0c0b857aa7f0371a3591e00d735','张子扬','2','1995-02-28','15210119950228243X','18647066708','15','YQFUPh4f0dlCDq4BcDhz','2','1385713417','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333239034','1149707421@qq.com','fe270e14353a80f5d98317c953efbd046e39cb28','李孟杰','1','1995-02-03','320826199502030449','15061265739','32','z2egZia3gUuay98NHF2O','4','1385713464','0','1385880784','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333264054','fullluck8023@hotmail.com','d1090eb0142a17d04c7e9fc01056980f0a2b232c','吴仪','1','1996-11-23','142631199611237447','18600193196','11','UVNkdRw0xMJky8HY9FZg','4','1385713604','0','1385713884','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333254613','1105473400@qq.com','1073d37a5ffd960962479a74d33cd311ad74b1bf','罗鸣','1','1996-05-14','510321199605142327','13088326396','51','xKagL9LTsAILYtmn5cH2','4','1385713685','0','1385714750','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333248496','2290872067@qq.com','35039a3d61ecd58304144c8579fc6c000dc8489a','赵奔','2','1994-09-09','342222199409092036','13820153211','34','yDuQ6YMDldWXarvp5RTf','1','1385713693','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333282828','651008927@qq.com','d261cdb23219de0c754f480c68e2825154585ed2','刘珈亦','1','1996-07-02','429001199607020029','15071652656','42','vgu6gcUX7dXQsubgE8Py','2','1385713727','0','1385818267','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333270317','491324408@qq.com','3618ff988a41db91d4e607571e7c10452a20ad7a','刘欢','1','1995-08-10','340122199508105720','15215513853','34','f22F0ZmcrE7oJAPMaalq','4','1385714283','0','1385864836','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333242188','854326131@qq.com','0d0c0a3313b79d8ae35bf85e69f8de7850a8cbbf','田若男','1','1995-11-19','210703199511192225','13704169099','21','rPOc5klBxL7RKcIUcxPL','2','1385714390','0','1385878101','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333268742','13920800207@139.com','b46eff9e28b1ecdeeaa301e3499cbc26c751b6ec','吴冉希','1','1995-11-12','120105199511124829','13920800207','12','yD3GcGRNgOuf8889iaqk','4','1385714495','0','1385877522','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333262503','asmelader@163.com','ec0c5e5fea361edaf2508061b7f9fb7aa3cfebb9','杨雪吟','1','1995-09-05','340421199509050020','13966452228','34','yJehaiBJ3mtgmW1IPdvE','4','1385714526','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333285934','menxue@sina.com','ff16de54d135b5f3f8d97a612a9bb5ebc1deedda','孟钰婷','1','1996-05-18','142402199605187225','18635096881','14','D4qcRt4Cik9Do9DWHjh2','4','1385714535','0','1385773152','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333203116','caideng555@163.com','04e1099afdea1f7221df518a6d00461d0af9de6d','蔡登','2','1995-08-10','321321199508102214','13815772725','32','RyzlN75BxCdHjNJMI5jX','3','1385714563','0','1385818814','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333229686','hyj387506@163.com','ae4d04dc0de25bfc0cddba0ff491917f7f465a23','黄子彧','2','1995-08-28','21050219950828093X','13941408589','21','y4s8p996XAOz1GOG4f8V','2','1385714716','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333207836','743112302@qq.com','951b9e2af575cd8213bbeafe2f0d3ed3f166ad21','陈欢','2','1994-12-25','532128199412252115','13595731915','53','RRPKa3khGhFI9aJ7VMcW','2','1385714799','0','1385729586','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333223412','www.aini.jap@qq.com','00e4a33af990c3b7c6323f1fff2854b63c1eb12c','郭雲霞','1','1995-10-17','522425199510170645','18984110989','52','i6Y0Oclx1nEODOCjpzus','4','1385714859','0','1385872175','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333201545','wangxiaoyu0822@qq.com','88d6b8ececff1c589140189646f1a92175d5402f','王小宇','2','1993-10-04','320323199310045818','13270355639','33','ewjiGjvGC2Zyg7vncVES','2','1385714969','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333209323','895916690@qq.com','291d3066451df1a12ff0ecce6608dbf294b9cda2','张远博','2','1995-02-18','320325199502180232','13905222326','32','VSyjpmFdkM7FkvB1VIRt','2','1385715061','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333275038','guxin3777@126.com','750e0aa4f99d4044993bd448619c7a84a23d503d','杨帆','1','1995-04-29','210521199504290048','18341470520','21','F16ixrGLO4ScHf5Ganux','4','1385715151','1385715674','1385798605','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333225043','w244816313@qq.com','a175e92fa35edcaa45f522035c26a74da4ff3085','丁乐洋','2','1994-11-03','32082619941103601X','15896162884','32','9ZMexZPzEPriZBB2hNO1','3','1385715185','0','1385882448','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333246836','656037195@qq.com','60866806aaf4b73aff3c569b60820d83199478e2','税悦','1','1996-01-27','532127199601270068','15096536811','53','5bfM2x5BX2aQyyjs0wie','4','1385715187','0','1385717081','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333256266','804903728@qq.com','2a3caac3bde93cb60084b948a957a77ec53fd0b9','黄绮雯','1','1995-09-13','310102199509133642','13817525515','31','sGVTgiCmiP0KzcqRBVNF','2','1385715279','0','1385715479','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333276577','1610752469@qq.com','3628137dd01da0d0d9e27a46250d490f35832996','刘郊阳','1','1994-12-06','21142119941206142X','13009292773','21','TlpYzEvLBvEcLcEuGbWa','1','1385715307','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333232892','597897074@qq.com','78df7859fb345cf136424ec964f4c5667759f441','张兮腾','2','1996-08-05','511002199608051514','13118463311','51','xQPJzyBNKGwqiRnbeyKh','2','1385715316','0','1385720947','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333293730','489071629@qq.com','45cde642d853364717de2285f6042ed64c9f131c','秦锐','2','1980-12-02','513101198012020510','13981619233','51','IhmUJY6c6WITxG3f8aZl','2','1385715355','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333260919','xiezhengxu123@qq.com','ce1c09ab5c34e2cb7d33ae19cb461216209c7990','谢正旭','2','1994-09-10','32082619940910161x','18852312613','32','0Oyvhv8LoatR2THT9gVI','4','1385715484','1385767814','1385875925','10.3.1.20','7','0');
INSERT INTO `ycity_member` VALUES ('1333243771','740955702@qq.com','402f82c2d12c25d479efd1f97c18a1d8751892ca','程琳琳','1','1996-06-27','320324199606277024','18606187196','32','9fU1qtPmFsbDpoIJOH57','2','1385715514','0','1385856495','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333271832','985466988@qq.com','bf199930ac9dbc8743fd93841a2f10dc98c53766','张鸽','1','1996-07-19','110229199607190067','13661388820','11','qNWhKkOr7NChpkRUxoWu','2','1385715618','0','1385717835','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333242133','982747994@qq.com','357e897fc29129ed897f40c7af3ccb07d5abe068','谢梦圆','1','1996-06-28','320882199606280080','13952327583','32','yUflrjkIdVFT4RsDrWUS','4','1385734283','0','1385734615','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333290666','1030126931@qq.com','89b521851b0337994a7d8066d799fc3132229b12','胡姗姗','1','1994-12-09','220203199412095424','18604324218','22','x8pOcweCXaPFj5rUa7Fq','3','1385715777','0','1385784475','10.3.1.20','9','0');
INSERT INTO `ycity_member` VALUES ('1333267113','349026384@qq.com','18d59bc4391f88c806fce28ef7d8fb54027ec7e9','叶海军','2','1988-10-02','340826198810022650','13622048617','11','QiGJGqS7E5Fluk7PSn8N','3','1385715914','0','1386058658','127.0.0.1','3','0');
INSERT INTO `ycity_member` VALUES ('1333298496','757069552@qq.com','70aeb8a204c11c8ff6efd30a3ea99eed4ed0f617','朱頔','1','1995-11-06','110229199511060065','13641118839','11','ZMzCL5VTVCvP52mnckSq','3','1385715921','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333282891','1009798751@qq.com','75e3fb69743464ec1848ad9060bf3af942b80b16','刘轩羽','1','1996-02-29','320681199602290225','13867374382','33','FLTyggGnGZkuLY06Im4f','2','1385715991','0','1385883810','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333265604','1610752496@qq.com','3628137dd01da0d0d9e27a46250d490f35832996','刘郊阳','1','1994-12-06','21142119941206142X','13009292773','21','9Jt1eqFFgYb4kvc8VOXF','2','1385716035','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333221834','280806161@qq.com','2ed85ea9d2189f15c516eedd1fff15003dc7f0cb','薛一丹','1','1995-12-19','110105199512199548','13621177153','11','5kgZppV0E1Z0Dbg5bD0O','2','1385716334','0','1385721567','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333231233','544169252@qq.com','b28766ce9be37b8d74709aea657aa9890368eb6e','刘源','2','1996-05-18','32032319960518791x','15351631960','32','vTBGWx8WWKdnaXpA9MMW','2','1385716338','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333218794','1044518037@qq.com','c2169b5f2774bad36f73291ffd4bcd027f2c477c','石峻瑶','1','1996-05-16','120107199605167822','13516281360','12','OhwTMKJdK0hVygYAUaOK','4','1385716428','0','1385728346','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333204613','a0554ab@163.com','efa2d96b416c1b39df2e3872f97f8a5c6adf39fe','邱家鹏','2','1982-12-16','340403198212160010','15055918724','34','xlRyoEpkXXTCucvbyDbK','2','1385716517','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333245316','1070172270@qq.com','917c21614263d7a849d74b4b7ec0fc85210c41fe','苑鹏博','1','1997-02-11','230826199702111428','13159986845','23','0glJq8CnAYpfFQJpWnjj','4','1385716564','0','1385881940','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333228106','978769605@qq.com','33595b3bf0b52a8d8a9ed8dbb1a4a317f0119233','黄晶','1','1996-05-20','360402199605203124','13767213628','36','OhbjP279ZkxelKwVxpfw','2','1385716658','0','1385814749','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333285998','1156803882@qq.com','886b4ca3b44d32eeaa708378945c5c3438ef800b','李夕妍','1','1995-11-30','110106199511306029','13146788199','11','vZ7IXarFb1CsLbXW1wxW','4','1385716754','0','1385868674','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333206266','kexin90hou@163.com','3fa04625280fadc264ed3e74130d59c8b872fba3','陈渴欣','1','1995-12-28','110229199512283164','13683642532','11','oXySfddewCKLzQ01Giuk','4','1385716886','0','1385880387','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333253183','2602432357@qq.com','67c28029efc09d7944b68013f0aab83a9b382877','曹佳','1','1996-09-26','220281199609265043','13147777439','22','fZ0itQbyCnWXEcrJeRka','3','1385717040','0','1385785469','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333292157','lisa19960214@126.com','b5e0594234b8b8d910fc869340e70174acb698af','孙天妤','1','1996-02-14','110101199602141029','15110248685','11','jZmdeGmwZAcvpj9V6G8j','4','1385717303','0','1385877665','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333279604','923422376@qq.com','d4b09706683ff2e2deba949019a2c3a92c8add82','王姝丁','1','1996-08-17','320323199608172828','15150096096','32','DWj8lVJdGPa2wMcOnOuQ','2','1385717351','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333215635','1226405754@qq.com','6ce29f27a6407d37d2a7a68d328441167ed14c87','陶虹','1','1996-02-23','320125199602233126','15195935878','32','BPqZ5O7pHuUSUWgkIpWD','4','1385718496','0','1385808283','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333296830','zm111888@163.com','efa2d96b416c1b39df2e3872f97f8a5c6adf39fe','哲娜','1','1996-03-21','513229199603210021','13541560125','51','38nKmMaXAG2eE8Li1o8K','1','1385717505','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333259322','ziyun085@sina.com','f3e71be7131676d742f7b72d6c21ccc8c3edae84','荣梓芸','1','1996-04-10','110106199604101524','13501220169','11','5vbRaa2dw5m1aPJ6yVss','4','1385717525','0','1385721359','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333295320','798014495@qq.com','d5f596acbe87563fd811ed3f4b05a246df7ec2d1','王忱','1','1996-06-01','130425199606013447','15530040164','13','d2PLBx4cbtBVfHemqN7R','4','1385717797','0','1385809884','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333237544','546352139@qq.com','e1ac3097ecf8246687a562f437d8f190472d328b','孙林','1','1996-01-09','220281199601092221','15843257485','22','16FRe3P7ItoPbwxoDX9X','4','1385717810','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333226576','462007882@qq.com','b6c87bcf45f65ced90b9036d0b66eac6c19bb21b','陈志强','2','1996-08-17','110106199608173015','13426150496','11','ucKcltN8M3FdNUfDPgod','2','1385717891','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333251571','41828423@qq.com','56f94ee4922b0a89f5a8d2c0c6cc07351e4d14f0','王嘉琪','2','1995-01-25','320305199501250010','15150066503','32','wQDQ6L9q377VC8Xp6YJe','4','1385718059','0','1385820114','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333284328','wang.dan.hao.123@qq.com','0e8e4ffebf3504cc0a87b0bc3b6e9eccbed7200d','王丹','1','1994-10-16','610431199410164624','13991886208','61','Q2hgG1TOmPePEWTN3ZHi','2','1385718203','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333287534','353068163@qq.com','6cf75a464238c26a56dde5d609e4c8cd0cae9e3e','张青','1','1995-01-24','310226199501241127','15026415668','31','3DvG1O6I1OT4Uj1gXO18','3','1385718235','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333281262','522031332@qq.com','0e90f9a4fcb727d0d0c261efe7e36009315a9a3a','郝睿语','1','1996-06-28','513122199606282725','15283513542','51','zZWVZt2hcNyZ0HEzPJxQ','4','1385718307','0','1385720961','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333235978','1974290473@qq.com','6b10a1f5289e81265f64e746fa89b3a83dc5e0fc','杨培吉','2','1996-07-22','520203199607220812','18216846770','52','zsoZoxyQOvRfWVHPGiTx','4','1385718468','0','1385786371','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333278120','965676781@qq.com','9fb28b0423d6f5b50b39305386b77b507e0312d9','冯笑笑','1','1996-06-19','320826199606197067','15152383529','32','7B8bZCXf4LKh4OKjLTig','4','1385718470','0','1385877915','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333220336','347461184@qq.com','07558367aca13416d70693ad2be801d31c4a06cf','郑欣','1','1996-04-12','321023199604124022','13651519663','32','Tk42dzPaFRxeapESwD6k','3','1385718832','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333214041','983755636@qq.com','552c7f09bb14ddb77718bd84dc93696c3060bc02','童译瑶','1','1995-12-24','51032119951224050x','15181341309','51','377U3WhpVw91VNOIJFde','2','1385719104','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333210910','359278552@qq.com','ca0aa3478db193376664957ba35726af8b1355fb','舒婷','1','1996-07-28','342425199607286923','13588319837','33','o5frh9iKueimYMpDvMhO','2','1385719239','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333200052','1178740007@qq.com','9167916b9b85d7ff275e08f837b1592ed53c1da0','蔡尚秋','2','1996-09-27','422201199609271539','13377833087','42','4APcfzFJbfjreE294WQp','4','1385719280','0','1385881604','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333250005','952984205@qq.com','162950ff7f1e9ae2277fb38f60c05e4eba7ee30c','赵芮','1','1995-10-21','320323199510216028','15262007615','32','Zfcp9sQDZc4yDMIRI5LC','2','1385719561','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333248436','574924881@qq.com','828148ff17fc77cc1bb2175cfc7b610a75518ff9','王嘉雯','1','1996-01-27','230421199601270020','18646838638','23','FroMWO1ypATSj2O9KZqx','2','1385719657','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333212532','602481812@qq.com','8118d7a29a403074e7d25d9f4c4ce5743b776c64','张子莹','1','1998-01-04','220211199801040320','13614324211','22','Q7RbLqJvc6Smo1kpYafk','4','1385719707','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333231286','15801229030@163.com','33595b3bf0b52a8d8a9ed8dbb1a4a317f0119233','高睿杰','1','1996-05-27','110229199605271349','15801229030','11','4l94WlBYWRMR0BmAaO2l','1','1385719892','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333289025','1156876623@qq.com','3531874a8660e2f06027f3be8a09b3dea44ec2dd','同兴','2','1995-04-05','610502199504053814','13149139370','61','UlBEaiBKtiMsVAMmK37a','2','1385720412','0','1385787019','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333206213','liyou5ld2@163.com','48744e2ce99b542d6095781127dbb3c52c9afe00','刘妍姝','1','1995-09-18','210711199509185624','13704166352','21','WLzg8yyWKdMXa23tJ6nY','4','1385720648','0','1385721496','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333214025','dgsd1111@163.com','65a4f2cf5b83de3fe94ba2e0e690ca8691e7ce6a','路可欣','1','1995-12-28','110108199512282228','18601999266','11','DmlvW07dSBH4FlaVTQOk','4','1385720979','0','1385857816','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333254683','737124156@qq.com','d7696576504a9b760acc00e6a678ef26c7d80435','陈漫妮','1','1996-09-18','210102199609181824','13940063381','21','5JBICWULTEnLXA5DfnAE','4','1385720986','0','1385721395','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333228143','18804357649@163.com','4da1f5f93b5f1ce22c02ce267d4b55a3602d4d6f','赵诗淇','1','1995-06-12','220502199506120424','15943507281','22','fZ0GMcpJfjppn9rmezba','4','1385721353','0','1385723733','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333225012','lwmjch@163.com','35039a3d61ecd58304144c8579fc6c000dc8489a','李雨露','1','1995-08-13','610402199508131204','13720593630','61','Rv9xfdNhzunGjLDYvKod','2','1385721452','0','1385779301','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333210913','songjia317943354@qq.com','91af117235e2cc5c32c6b0dd67c0c708dd982d07','宋佳','1','1994-12-02','130406199412020922','13784201361','13','CU7ModKzCiHMjbjmwkST','2','1385721556','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333210923','15640336403@163.com','fc423949e1c21cb50f81eb51dc2241ee03736075','于盈岑','1','1996-04-23','210124199604230824','13234033322','21','Ga77POQD9uRaqFjjqdW1','2','1385721683','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333240678','853685686@qq.com','d7526c60ab4f2adb57578453dc734416aa09c952','徐宁','1','1996-07-24','340403199607240028','13955406077','34','SgOqB0bp4hVDLKn4zNiv','4','1385721828','0','1385779971','10.3.1.20','8','0');
INSERT INTO `ycity_member` VALUES ('1333242134','284080048@qq.com','b985e8065c5577a32aa016667fe76cf7579f5a43','黄宏达','2','1996-02-15','210703199602157011','13840675757','21','qbSoFUZiQuxLC5UyfNbA','4','1385722152','0','1385879407','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333259366','qianliumt@163.com','f8339103c43aaf177b4caa90883d83b40ac27c6b','刘梦婷','1','1995-08-14','610502199508140624','13689237905','61','Q22VRLCKrzaYT37I71HK','2','1385722689','0','1385722942','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333290625','770898244@qq.com','07fd13b586edac3c4a8af514d8cf2ce3e4f9a9c3','闫瑞','1','1996-05-12','610427199605123924','15319728178','61','asj3b5HCR9BMeVe5jfAu','2','1385722843','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333218712','510099462@qq.com','e7fce4828cee346cd2de8c9f9ca03daabd19e343','郭佚婧','1','1995-11-20','370902199511200028','15552839266','37','qrSLbNY4F3OOLiNIMqk3','3','1385722888','0','1385723055','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333256213','920524178@qq.com','a4225f242509ea3157d5b7953485d72d29b3f047','吴雨晴','1','1995-10-19','320323199510196821','14752127046','32','7lOkeTgcn7JYOHZ6norK','4','1385722955','0','1385881009','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333273442','280091072@qq.com','751f8994b3617466fa8e26728afe0e7bf3c03477','黄何','2','1996-07-04','320311199607046410','15805208758','32','kOUW2ZMd7UhgwVmiZPNq','1','1385723044','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333253133','543567654@qq.com','bfd105cd5f19d804ecd5bdd8195fe80b0a0fde2c','许诺汐','1','1995-09-24','110226199509243621','13810470638','11','eAzIbDr5GaOPznuy4foz','3','1385723662','0','1385871473','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333240633','www.465029317@qq.com','772d4f9272514d2e132903e3eb59fa819e84fbe4','陈莹','1','1996-08-06','420981199608060068','13476495302','42','3bMl5gbIMRVg37p7TwGe','1','1385724090','0','1385725108','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333278177','1308565464@qq.com','6f7c45b49ee77f83959d5c0cd6effa2d288245e3','刘新欣','1','1994-11-30','13040219941130272X','15931036055','13','ONoShMhMEx8woOGxRHeQ','4','1385724116','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333293766','962705529@qq.com','651a6e9bade746a5f9fb51127dd7bd50ab95b901','林洁','1','1995-10-16','421083199510164920','13545025052','42','5NH2lfPOuU9bWe8FnUdn','4','1385724133','0','1385803942','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333226543','13910624858@139.com','296e7d2dfdfcbde326cf7204332a952f4ad09bf9','贾林丽','1','1996-09-01','110109199609010620','13910624858','11','Y8ifkPR3mO6q3GBu7yxp','4','1385724376','0','1385786384','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333276576','742834209@qq.com','09e5124aeee618469d54d54440bcc39408e649c2','张萌','1','1996-02-05','110223199602051422','13520080575','11','lQHShSti4nHNPK4EIUkm','3','1385724562','0','1385725927','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333214023','570741618@qq.com','01e7f64555e25371708c4382de1d74baccf4c5c3','许梦宇','1','1996-05-14','320302199605140028','13407542718','32','rOJOkfKBsexDQXvhfIdV','4','1385724666','0','1385776602','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333271817','963709600@qq.com','7df1e89632c333f3f785a2ee75a13c61dd37719a','韦洋','2','1996-02-07','37132519960207121x','18769937869','37','BgzOLHOZ5Ikl7m6YTWC9','2','1385724861','0','1385774671','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333265654','846300734@qq.com','2e4a3480befebed18d72e74a77ac346073844857','王嘉琪','1','1996-07-03','511123199607030022','18011663282','51','qfQ4AzdWMHqbC390kn2T','2','1385724882','0','1385738026','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333220394','fuxinci0222@163.com','994e8907e4ec7cce10744c08aa1c41d11c3fcbb6','付鑫慈','1','1997-04-22','211203199704222041','13941098930','21','qBEEiuUsjhH7fYyNWi6n','2','1385724971','0','1385875860','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333232833','13811461457sg@sina.com','b819c19261f2b2b99a35ebf90814b18e0be553fc','孙歌','1','1996-03-30','110222199603302928','13811461457','11','sXpwN1DIRBnt2briU5ph','4','1385725363','0','1385780383','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333209319','261650336@qq.com','d335ff1449637d2303cd4ed5a73fd91a3f25ea61','高文静','1','1996-09-15','320723199609154228','13815613958','32','UZSvKSc5eSudo5KNp0Fc','4','1385725523','1385811915','1385811733','10.3.1.20','7','0');
INSERT INTO `ycity_member` VALUES ('1333259306','2508212332@qq.com','b32f5544fec5000cbc7e72e0ca71f89f5a1ce4e4','陈雨晴','1','1996-09-04','340122199609040321','13514993476','34','XabJJP1iF7yLkXEpIUsP','4','1385726286','0','1385811757','10.3.1.20','7','0');
INSERT INTO `ycity_member` VALUES ('1333243743','yiber@live.com','495cae6c464d6d54d9bee0674cc495083f76d28b','柳一伊','1','1995-08-21','110102199508213029','15901557683','11','nPp91XR1vuCLxV1uoWO0','4','1385726514','0','1385879618','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333245371','1147876643@qq.com','7d5baed775b3864da7ac29c3437e05c1e80be37b','韩尧','1','1996-07-04','210282199607048728','13898605080','21','M7AbAkYmmzHliE9Ncr11','1','1385726725','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333265603','www.958567320@qq.com','a9bad52399ec6248b7745d6961ba3255c417f99d','崔钦','1','1996-12-30','130427199612305545','18230220892','13','IgUrGMkMX8TBDXm8hAsu','1','1385726955','0','1385728913','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333251536','89992454@qq.com','c8abe5508f847eecf3c92101d2ad14ed9d6de741','刘嵩','2','1995-05-23','220282199505234134','15144310602','22','OIM1KXq4Owr9hlfVUoys','4','1385727201','1385734368','1385778065','10.3.1.20','13','0');
INSERT INTO `ycity_member` VALUES ('1333242173','979711985@qq.com','a40a935dc896e93bf1c11dac70aadc01815e888c','刘朗','2','1995-06-27','110109199506273612','13522343121','11','ppNT1CCgvD5qhP3shEtH','2','1385727194','0','1385813961','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333243788','jackhsw2008@163.com','cf05e5d9fe57b153bb7cbc740c0c60c3634e1008','张恩希','1','1995-10-21','110226199510211926','13716823918','11','QpK6AJTlWg2pD67JLZC0','4','1385727235','0','1385727769','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333289034','422621368@qq.com','3cfb5a5a5d3029e00ef2609dd7dd4e0c15c63c39','郭欣雨','1','1996-06-28','340826199606288923','13008917089','33','RBi2DV54IZLzvroJ78wC','2','1385727266','0','1385878265','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333251596','630065490@qq.com','f5ee525e711677e6e3eefb51d60bb920ac429f2f','周彬倩','1','1996-04-15','522222199604153280','18585619357','52','5tRe6Q7y9Ji2EoY7CDv0','2','1385727822','0','1385727960','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333296820','912916084@qq.com','809b434e2e88ff8e1c4265082981bfb282146e8a','唐旭','2','1995-09-22','120110199509221516','13114889386','12','tqVB5oVkCTrTYMKeKYRF','4','1385727974','0','1385869350','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333250036','cmn1272422908@qq.com','220cd59e7e68d3bff05d6c2f30c87f54a1624a42','陈梦宁','1','1996-07-30','320105199607301620','13851936732','32','IP2I3hTFCDlV701sXXVE','2','1385728451','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333235933','314311734@qq.com','e9ac0c094af9cec3ded44775421a750d381c99aa','薛薇','1','1995-12-26','360102199512263826','15070015551','36','igJj9HcbhS1hNCf9atmx','2','1385728724','0','1385732834','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333298430','403803478@pp.com','fdab0e167e22b786fdd12c89b09f80eff7fc73fa','于奇玉','1','1996-07-29','370103199607296725','18653117685','37','AO5PehvBfogik81HOs7c','1','1385728795','0','1385819881','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333217141','1285340047@qq.com','d9d35355541ac03201c1d6fab786efdea2e00540','李运','2','1996-09-17','321321199609172238','18205245675','32','oU4hh12O2ayP5uyrC2kg','4','1385728870','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333271833','www.947428879@qq.com','7c2825f6c80052ff38ce6bebde57c09afdf78992','赵洪然','2','1995-09-01','120110199509011535','18722623238','12','EnaHipFz8e90h1pxqgAX','1','1385729581','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333239044','925608567@qq.com','3217f0ef5c87d1d1a8a1dda49a50230d8f3b8239','谷昊悦','2','1995-10-17','130105199510170630','15175124720','13','OSCJEOb4MP6By9ORGBSW','2','1385729704','0','1385815996','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333251533','821731695@qq.com','11dd974e4449a930a7e43729c9a0aa49b1faee10','温凯蒂','1','1994-11-05','150302199411050022','13847355672','15','S5E1MRd78d144k1tfyC6','3','1385729994','0','1385818673','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333223434','422849859@qq.com','34a069dc70a089c9324dabdc98f251e26eeb4386','郭虹','1','1997-01-01','210281199701010025','13889234681','21','ERMTbrk7AsyW6ZV9KSP2','4','1385730514','0','1385731008','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333217120','lovexin1094648149@qq.com','0c5325f79edd04858374657f19d3a88fa216b386','朱慧龙','2','1996-08-01','230103199608010310','18345167899','23','vUMHEOVZQ0HjBuBfCODI','4','1385730732','0','1385731619','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333268733','1147076548@qq.com','4df3fd18d9ae03850051df584ad9b7a4558e9888','马娇','1','1996-01-31','320602199601315325','13912286335','32','BG4Q9TMAk1hFRrxygDZP','4','1385731103','0','1385801781','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333275032','912017895@qq.com','9cd86b3abf282c38e88289ad850c5f0f1285ae23','侯欣泽','1','1996-04-30','11022219960430292X','13693398642','11','60Etyf4BA9trsEYDgHal','2','1385731097','0','1385732626','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333240641','www.765094630@qq.com','f7cbacc2a0e60c9443c13c2f2f32d05c5baa920b','张祾雪','1','1995-10-11','320323199510117927','15152187897','32','e9APtTN8XUqnOTrKMdcD','1','1385731211','0','1385731720','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333264003','1790497645@qq.com','c121aa6b41ae65c13632db49f853fc8471a25d11','齐艺','1','1996-01-09','11010819960109734X','18710004765','11','eWrvh29ErfAx7eE2Gu8p','1','1385731251','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333200030','shenyongjun158@sina.com','42ca8c2b6dd122ddfcca820883affe364e1df5a7','付梦雨','1','1996-06-06','120103199606065427','13802108900','12','ZCf7ZTCc0zz6c4pcc0JU','2','1385731712','0','1385734347','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333245333','291215569@qq.com','bd0b944b3c05414646f3f2d89942d51f9836c0c9','戴子棋','1','1996-08-28','530112199608280529','15887044594','53','Tl5ul21pqlJUK49TEO5x','2','1385732147','0','1385734340','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333273471','923080037@qq.com','a853b064e147ee61bc8b1fc39ce67dd8f85a9dc3','李军怡','1','1996-05-07','522401199605070021','18685185507','52','OIM1KXq4Owr9hlfVUoys','1','1385732144','0','1385732698','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333275076','234480008@qq.com','312b755d49d0fb96ca282abdd7e8d002ded70860','王文慧','1','1995-09-24','370302199509246024','15898779333','37','DxVfgIFF1LORlLqrbsHt','1','1385732610','0','1385733007','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333264036','993912405@qq.com','508cb88bf283a49d47e1110672bc452a152baeeb','陈旭阳','2','1995-08-07','510603199508077678','13550647174','51','jtVqi0nYjuJxvwG1FgYY','4','1385732991','0','1385818959','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333217135','872312562@qq.com','531681c27fc944dbf9aa949495f3da334b211acb','袁彤','1','1995-12-07','320802199512070582','13515236162','32','pDTo55YlBudj3CvRLwew','4','1385733058','0','1385772800','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333287577','838796461@qq.com','e73e9cd0f1c3639c41b7beb5ce9f546b50ecd137','翟杰晨','1','1995-09-26','120110199509261825','15022412068','12','BRPvflzt4pgZ7KzSPjY8','4','1385733211','0','1385871973','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333251505','734315152@qq.com','9af68b4565aaf7eeb5539e885a21c04dcd93be7c','李亚萌','1','1996-12-08','130404199612080329','13031478365','13','oNiTiQLVE73OLbDWcpik','2','1385733672','0','1385734649','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333296857','877762941@qq.com','cd302fd1fcd38a2bc47f369874365a8adf8dadd0','曾梓凇','2','1996-09-23','431281199609231417','15115107850','43','4McMfsPgHj5h6nZt4CjK','3','1385734399','0','1385789548','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333201552','154631701@qq.com','22411a6dbd717ce3acef010d6176312279dc7875','孙晨','1','1996-06-04','110108199606042268','18500291526','11','8iBq2Wpaz1w0bWYHNy2X','1','1385734542','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333259374','xuecuizhang2013@sina.com.cn','ea7541c8d87728c3ba1e459d1050b0ed95edd906','侯晓婧','1','1996-02-18','110107199602180325','13683326351','11','RuBu8tc2SKNL1F7ivU9p','2','1385734584','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333267143','ynyqb@163.com','e0aa10a6ccd43921d62d0c2cd4e6036ed3bfc3e2','张萌','1','1994-10-30','530423199410301625','18708774273','53','HjjtU571V5TEey1AAGYA','4','1385734784','0','1385796871','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333212510','2528841597@qq.com','38bdc01bcdb4164bfe20c6a6811d301d17fcf62f','张旭金','1','1996-03-30','110223199603300048','13436688575','11','AbOEKRkipNTy4gVQTTMe','2','1385734799','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333215641','529698848@qq.com','715b83e2c11c2dbf479656bbb78b840be7dbea85','任韵蔚','1','1995-10-23','513824199510230024','13330900443','51','1fUXrnHkVzZifFaUjRvx','4','1385735035','0','1385804431','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333221836','1309151399@qq.com','3f6abc09a6d200e1a7f4ec595faac3c2157c4ddb','陈姣','1','1994-10-20','510681199410202521','15282869718','51','Ts7nbThAbB4ytDBKYhai','2','1385735834','0','1385801947','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333273432','wangshihan719@163.com','17385eaa11b49d839b6911f580bbfdfe80cccb96','王诗涵','1','1996-07-19','110102199607190424','13301330225','11','wgZ6vybYspV1oKon9w3a','3','1385735866','0','1385816017','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333234392','575690287@qq.com','d7666be38e9571111537d06c64b3d92f9913cdbe','李银琦','1','1995-05-11','510603199505111885','18280526147','51','1pXc3z9IfZc9yyCgFdKw','2','1385736737','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333287598','m18630285748@163.com','62187283577c86ae85eed5aed8d0279c02939cea','马思雨','1','1995-08-10','13062519950810002X','15933444125','13','LH9nhqp2ADe6ohIguXNe','2','1385737102','0','1385737417','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333246871','Huzi20100221@163.com','61327b626011ec62d70cd452ac7a7167661b254b','晁璐','1','1996-11-09','37132519961109232x','13341081563','37','ofeOwHfZESLeOTAoGvHC','3','1385737149','0','1385794499','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333262522','duangengsheng@163.com','8862fae1721e5ee50cd6f6cdc23bdd06518860e6','段梦璐','1','1995-09-26','360622199509260766','13870015497','36','sd7Z7wE9mcO1TXQ4FICQ','3','1385737427','1385792590','1385793086','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333218741','zndxpx@126.com','3b7c56a09d427164df4da2bec0c0df021b3544aa','张文静','1','1989-01-18','610324198901182583','18173116986','61','5Q15s4O1avjTOrZfAvXv','2','1385737863','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333257866','617694869@qq.com','cfa72e252be1cc8837bb1569dad8c0ee6b91c22f','游澄澄','1','1996-08-09','510107199608091280','18081871809','51','rZxiaB6seC3CeMnr958z','3','1385737915','0','1385834383','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333271842','15601266387@163.com','f8d35bfeadfcfd81b95177b04c736595d55fc052','卢珮瑶','1','1995-03-29','341204199503290828','13901163006','11','WSfWyLQTKrzs3K6Sir3F','4','1385737941','0','1385739133','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333287528','303362150@qq.com','60e1fbcc592f006116821b8bd123bbb6bfbe7356','厉雨','2','1994-10-16','32032319941016585x','18052155660','32','EfwOeA8FVuzpZZmkw47J','2','1385738171','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333267198','718757083@qq.com','374877ad092c4316e4d93ac44cd19dca163bde00','柴功浩','2','1996-07-08','120110199607081510','13672182418','12','jtLs5qlYGai5acATU8oE','1','1385738349','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333292166','1017090829@qq.com','ceb3c4b9e24864b1eb8d6bfa6343c002f285b77d','王小婷','1','1995-05-09','362529199505092524','18679434552','36','NSeVJKhLgqG0CQY2vWha','1','1385738747','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333248432','836993443@qq.com','dbce2f533f567a39b007ab672dadfc826783302e','兰天宇','2','1996-05-29','120223199605291239','13102087176','12','roQakgCIuD58fTocQWr3','4','1385739605','0','1385780312','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333332854','cs19961024@126.com','fcc464ed160fa87a10c3336108633365fe53937c','成鸶','1','1996-10-24','110106199610240328','13263203203','11','5j3ovyI6KZAHB11jxLTq','4','1385741499','0','1385743134','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333306236','916316051@qq.com','864aa95a8e9dd7e3c304af1a1bf32eebe7f45332','扎西多吉','2','1991-08-13','542223199108130012','15883382434','51','s4w1QuMw3JUQR9D3jKEP','1','1385741769','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333312541','978115285@qq.com','f58f53d2619e22b0cdfe847c4955098472ee0c9c','王佳琳','1','1996-04-19','110223199604191867','18311050691','11','jH5KJJ61pZu1wO1SJwOV','3','1385742932','0','1385810766','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333364004','1092547406@qq.com','343b25be58de504ea37ec8b8424bed933d951119','范思琦','1','1995-07-09','232127199507090043','18277444000','23','DQ9moFDf1nDqJ2QIMLIC','2','1385743256','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333339073','347149624@qq.com','062fa2c69a54ad54d7f9bfc5dcb7c9a74d0287af','李家兴','1','1996-08-07','110223199608076962','15600197710','11','qN7LKc3LCuf3ZlFJwVBn','4','1385747469','0','1385856209','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333328186','tyb24092544@163.com','dc7cf3f41da5fddb55c137c595b031ec07983971','吴丽娜','1','1992-09-15','340621199209151269','18656121731','34','5qizIwVBBYABmV5Hx0VT','1','1385747482','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333317194','1160628353@qq.com','da695c50740185b7a2fb59d50eef0def8e39d222','钟洪音','1','1996-08-27','511011199608271767','18989117571','51','XAQn2KyoaKrD0tkBUdSd','4','1385766039','0','1385777042','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333392130','www.1048645596@qq.com','2ef2f7263a139b8ab54da1a6f62596ddd3edf207','李佳伟','2','1994-11-15','220221199411156216','15543217172','22','xKagL9LTsAILYtmn5cH2','1','1385768585','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333337534','wo-wangxiaoer@foxmail.com','c5ca8ea8fdeb9c3db00a4779e0855749b1c75609','王赫文','1','1996-01-15','150428199601150824','18248090811','15','CzM2nhkzn7nlOojMYKPg','1','1385768868','0','1385769606','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333345336','923307870@qq.com','6cb67e68a9db722606999de3a8d6a28dcf1b8afe','于淑珍','1','1995-11-30','370502199511300449','18766757833','11','E3lAdqM2Twnny7XPGj05','2','1385770252','0','1385771000','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333323443','1411445047@qq.com','7cf2a90edf7a6c88b6dd3f591f7041a987db5a11','赵晨昊','2','1996-02-05','522502199602051310','18585414206','52','Uz24TZ7lGCQe6CK2muPx','3','1385771201','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333395330','838885874@qq.com','fba28ca67466241781b855d499c44a3a28e6c521','修坤宏','1','1997-09-16','230506199709160722','15246868689','23','Giwp2KLQ9u8B8tOWlpys','4','1385772113','0','1385857835','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333367142','2209339615@qq.com','475e272e0a5834b4f8ba32b868709e16d247c57e','邢瑶','1','1996-01-12','320802199601120027','13861577839','32','3cBPYc0uZridlHn21fBQ','4','1385773029','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333378104','1067331923@qq.com','091999c83efe4bc73b96fe618a4d5965ff045b31','刘林','1','1997-04-10','341203199704100625','13854646526','37','Qnrd8I2EYqSvIacOehZN','2','1385773259','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333387525','286317389@qq.com','c7a505fb38d77e17927eb14be90169cbd459fbee','刘鸿鸣','2','1996-06-28','211282199606282011','15841016116','21','jfzOVLUEObTjSerypKbv','4','1385774073','0','1385817280','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333303113','1959183717@qq.com','fee5ed4c06b7cd992664f0cdf3c25701d9eda173','王姝','1','1995-08-11','370602199508110025','15553532972','37','mpW0z4npw4OkW51nKytm','1','1385774425','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333334378','1021721246@qq.com','3cc54208eb65a406acc35cfcea9e673f0f987536','向明瑟','1','1995-07-14','211004199507143323','18341994566','21','1LfaEF5xQhzyzJ0LSQUR','2','1385774442','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333354666','2528059744@qq.com','7bb609af3aba0e67aae9c24407ca69d9b02f8f1f','朱媛媛','1','1995-09-16','320821199509163920','15996155812','32','QHXJzUzKfQweIRqply7G','4','1385774549','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333396896','396308062@qq.com','76e06b627f6afe1fb5a4d3ea086eaa9865808255','张涵蕾','1','1995-11-20','511124199511200046','18981350938','51','fPxYvFi3250fEKiKLhWz','3','1385774981','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333343716','1585753033@qq.com','c961c3a841f495771800d69d0880609308607f82','方璇','1','1997-01-06','320826199701060245','15896176359','32','7qoj68Fl4FbdC7ZB6ODA','4','1385775864','0','1385791351','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333365613','760718my@163.com','56c51e7e40cf1b6198fce9c6c0f5497a5d89ed4e','黄荣娟','1','1996-07-04','340122199607046762','13637098918','34','tbl1ELfRgdEKQdpJ1kOd','2','1385776237','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333351583','15398166716@163.com','c62c8498ca50000d0d000f773428d2d7841593fb','刘文佳','1','1995-08-20','341221199508208527','15398166716','34','qb2Ll00JlaaglllgzzCF','3','1385776655','0','1385818501','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333398452','cyccwcguofei@163.com','0c6c7a643314d012ce31307d040806b01abc16bd','黄子彧','2','1995-08-28','21050219950828093X','13941408589','21','mI9zDXQEpHTMTNONOvbJ','1','1385776715','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333382828','894734161@qq.com','b1f9e0cbad60e2449f920fabd65123c059917bef','李明璇','1','1995-12-06','32030219951206162x','15150007176','32','xoTxHZS5B91YkiO1chfS','2','1385777210','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333356274','1158211787@qq.com','b1bffe2bf3fb25d3bfc6f2bea859ea1b9483d4d3','郭纪芬','1','1995-01-26','142329199501262328','13191066638','14','lQp35cVb6NpEWHUSfQS5','3','1385777769','0','1385795267','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333379662','554555317@qq.com','e28e314218ba3c717c33f427e598be243201acf2','毛瑞祺','2','1997-05-20','360104199705200410','18607919332','36','76p3phjlYNrzIG0yBVMq','2','1385777919','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333393720','1335037594@qq.com','3b1f7b6dd33e12d851396189209e0b9b82aac8f2','罗梳桐','1','1996-01-23','513123199601234026','15308163920','51','VLPmqsV1eSGEByWcrzKG','3','1385778188','0','1385883269','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333335944','2930496089@qq.com','22ee2646e56ec1cdf08fcfbdcb8ceda92e4755bf','吴梦','1','1996-10-12','152326199610120065','13804758309','15','BKc0l98LsByOHBOtgW2P','4','1385778208','0','1385805020','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333360903','yl568@126.com','9016f55e2915840abd1f6f44c804460d10e7774c','殷伊','1','1995-12-27','110108199512276821','13511085676','11','OVc2OpnCtYMh91qVXwoT','4','1385778402','0','1385871684','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333381291','841762721@qq.com.cn','439e6be06cf00ac0710d99ddc0f674f5abd84536','姜寒','1','1997-01-20','340403199701201623','13866314270','34','iqB1p8IrFlTdbzMnGtnC','1','1385778501','0','1385796930','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333359319','892654805@qq.com','934e58921f35ddfd0bf2a3f26fcd81d22200b64e','赵迪','1','1996-07-19','320811199607194525','18012083345','32','gD8vJCtLUHYxeIhvxOED','2','1385778573','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333357822','www.825262782@qq.com','dea86d0bbe9e148aceef7bffbde43a068e35b63a','随佳','1','1995-02-20','370827199502200028','15232822751','13','58Ahxts6wMt8ezFjEGjA','1','1385778680','0','1385861067','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333300045','1344115713@qq.com','bd62c7e43495569616251acc5dbcce9f573b4305','郭峰','2','1996-09-13','130825199609130034','18631492935','13','gpYM2P3vT2Oqo1DLLlTA','2','1385778813','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333318736','1119073219@qq.com','79747dfd8a605262b871822484cc05031e3e4d5e','颜天翔','2','1996-06-20','210103199606203318','13072443866','21','vtuygRTKJvFiyY82VoVP','2','1385779386','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333371876','wdjm.com@qq.com','18d59bc4391f88c806fce28ef7d8fb54027ec7e9','王代佳美','1','1996-08-14','520103199608144027','13984418612','52','TOYh2TmEF14aoE0WFlup','1','1385779503','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333307823','1241016800@qq.com','16c1eeb17b69fc71cb0018f78bde654efb9b395c','张晶晶','1','1997-12-20','320723199712204828','15366681972','32','Ajo4yuzjsxFoi88fRkAC','2','1385779506','0','1385881989','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333320334','lijunyan2009@sina.com','eebcc330f3ba64e057e5dbe18dbdbc7a543c420e','郑思博','2','1995-03-20','110108199503206311','13641363093','11','Kjv5BUel7lSDROqgNTv9','4','1385779520','0','1385783372','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333315612','sunyue@163.com','2fb5bd36cdbc07e1d8255d5110ee2a35a1ffb6d5','孙悦','1','1995-10-06','371102199510068122','18963377200','37','asj3b5HCR9BMeVe5jfAu','1','1385779524','0','1385815008','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333331292','lyp199664@sina.com','deeb15b09febf3efc385cfac797777468891c135','刘云鹏','2','1996-06-04','110111199606040316','13161218505','11','Ok3BofqIqz2FfiiVQBhE','3','1385780130','0','1385831657','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333314035','474680679@qq.com','08380ea200e2875ad48d7ca4d29b21c5f958c35a','高靓','1','1996-04-10','110221199604100029','13911297699','11','aqN2YZBw7QXT1ZP6kpC0','4','1385780360','0','1385862102','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333321812','www.a438914833@qq.com','b0bb23eeb2ea91ef8da086a8822403a1741f10c3','孙营','2','1995-09-24','130602199509242711','15284226625','13','MMNqA4RZ2z9MUkHB5sfZ','3','1385780382','1385793331','1385881082','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333340688','982756602@qq.com','8ed6b0c6a123270e640660b850888454346b7364','鲍兆坤','2','1996-09-15','320322199609153833','15852156773','32','B1GC4jVyLJQqqgb3qZl3','2','1385780399','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333301516','ngkwgi@qq.com','9199ea145948d8f984d38b723ed2d582d2ab94a8','司政雄','2','1994-05-08','513922199405080290','15282201957','51','21qIj0YJHa6XdXCvQs8Y','2','1385780482','0','1385780566','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333325076','lhmxz@163.com','ae31aef2b6d0750536c75062697448adaee9b6c5','赵依妮','1','1996-06-03','110111199606033028','18611052223','11','Ys0xsS9oAIH2k7pd64MM','4','1385780725','0','1385879823','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333368717','108149318@qq.com','75c6ba6fbc8aa3ada6a91813fe30471ffc9fdd38','宫海瑞','1','1995-11-03','210882199511030681','13840703199','21','31DZrjolDnrObOZYOIGm','4','1385780820','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333342171','1457760962@qq.com','3c71819b89a38fe8aa7801d982d1234dca016b96','高翔','2','1994-10-25','320811199410254010','18762033204','32','W6W1dvxBvZ5vyexYziDY','2','1385781460','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333346896','27870473@qq.com','35039a3d61ecd58304144c8579fc6c000dc8489a','陈兆玥','1','1997-04-04','340521199704040026','13855529299','34','fIOPPiDl9UNDOLFqNon9','4','1385781500','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333348405','731132652@qq.com','93a5ee9bb8a43ad3f4bce401ecce1e7de63bbf52','沈雯雯','1','1996-02-23','330206199602234629','18268641796','33','LlljuVOGxDCPzWtpgQrZ','2','1385782174','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333326506','690456857@qq.com','1bcde557cd58c75aa4f780e324196904c8158043','陆宇婷','1','1995-12-24','330411199512240621','15024353575','33','HJwlDZ40LH0gCKmpUgyp','2','1385782482','0','1385806311','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333384398','352149153@qq.com','490dc5d5af5a0c38aef7ac552470bed7f1ddbb96','王慧','1','1995-07-27','15012419950727276X','18647389908','15','IVqZgnjFKSpO0mm2LsJ0','3','1385782587','0','1385880237','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333385934','625746740@qq.com','719d3318bacd90b97d6ab8f447cd255d76b5dfb6','何东平','1','1995-03-03','452701199503032620','15078605231','45','UHDy0l7BIGOAiibOn95t','4','1385782639','0','1385807173','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333350005','710580136@qq.com','2d027a0957cd49260407d02933dfa2c652f29e8d','齐紫玉','1','1996-11-11','340602199611110423','13955868953','34','xdqp10JpJLS9ddVn9XDB','3','1385783165','0','1385874012','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333329633','952739391@qq.com','36d74d6c3c88166367f50959a3722439bb90d578','李骞','1','1995-02-20','152630199502203323','15247121051','15','rMjZEiOoV3JYfLka7ZMD','2','1385783490','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333346836','1592156799@qq.com','8524cc044cc4f47f1f90d3b9840c549ecaa144ee','刘丽','1','1996-02-25','320104199602252421','13405816071','32','q7rLa6VWa2RTFPqa04c4','2','1385783533','0','1385818029','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333304613','xinyongshang@gmail.com','9fbe0867994998f61544fe75243ab400c8bcb2ec','辛赏','2','1996-01-24','110229199601240019','13811002901','11','UU4tCj35KsdrXs4nV1HP','4','1385783940','0','1385786112','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333398496','240315099@qq.com','d16f1506f126bfcc300a1abfa1ce4f1c5bf020d6','冯爽','1','1996-07-23','120225199607233561','15811590057','11','U1tgzUl0OwV2ltgLukcP','2','1385784209','0','1385797249','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333362554','494664355@qq.com','a9cec1c3aa594ed552abe809a9da4b3634ff957f','熊婉彤','1','1997-02-09','362527199702090023','13854197391','37','bl2EIyych9kB26bGs5im','2','1385784289','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333389066','728972386@qq.com','976c3d38926ba4b11cf1695b85515cd27f78795d','邵芮莹','1','1995-08-04','231181199508040221','15945611200','23','SUfEjFMfTARbxJbAdSsx','2','1385784569','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333301545','935410261@qq.com','2c9d78a90a0b7d8977475732e1815d6a1611e066','邱梦','1','1996-01-14','110223199601146382','13718162473','11','OuOQrlFSyzQHOMBudra0','4','1385784690','0','1385785626','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333350071','1229682208@qq.com','b63e6d80dc6d2c3c0ea83b392daedafc045ec3f6','蒋芮','1','1996-06-23','510125199606235829','15388134320','51','VwPFhBLOEfiQhX5xNgc9','4','1385784951','0','1385863484','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333375077','277024372@qq.com','3951faf45d8a7cb1df3ad041b30a2933a1a92dd4','刘雅昵','1','1996-05-21','37010219960521294X','13791079153','37','Y8v3jynJG03Eo8Oh00GX','3','1385785031','0','1385882699','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333304666','1006560388@qq.com','52a5bfade753028103a4208bc9b25b28d288599c','王素州','2','1996-03-04','320829199603041816','15722951021','32','7oJkfo1ZPt7aEKsLFxH9','3','1385785123','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333370332','892439213@qq.com','942915645d5f28d3029c41bf97c00cce1203c100','王晨','1','1996-09-07','320323199609076029','15162138467','32','fZ0itQbyCnWXEcrJeRka','2','1385785304','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333309310','18701158027@163.com','c4c282e68e4e268c35b2f3b508394622b7dcb5db','张琪','1','1995-09-20','110229199509200049','18701158027','11','E6FbjHHNtUswXOBVrCI0','4','1385785313','0','1385877770','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333390657','675211815@qq.com','bd494563f37401f4fb38b46a0793816923c2ae91','史雅琪','1','1996-02-22','152625199602220023','13633423330','14','rycHjb2PEGRBjIuF5guS','3','1385785580','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333353113','2351510777@qq.com','7979f63c209a3e0ee0e054b3b4af300b681d4923','杨继金','2','1996-10-10','320981199610100731','18914666380','32','aTFbgt0JorVCBzNDDDOs','3','1385785696','0','1385788304','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333342188','524038240@qq.com','1c721c2a9e3e1b3dcebe3729d709c794d226eba2','裴晓蕊','1','1996-03-29','130732199603290027','13623393681','13','1BU2WUOLO66jejCq4bBf','2','1385785795','0','1385786513','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333310932','1124294626@qq.com','35039a3d61ecd58304144c8579fc6c000dc8489a','杨锐','2','1994-12-26','320826199412261235','13852262782','32','U0SSr0Fi4FTcln8lIqPA','2','1385785966','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333315635','670750902@qq.com','35dc17bf5f2982672c42ca7f26926a2223edc8ea','杨春霞','1','1994-12-25','51302919941225176X','18080445670','51','CrKRXqoSOb6L1RMSJema','4','1385786294','0','1385866368','10.3.1.20','8','0');
INSERT INTO `ycity_member` VALUES ('1333368742','512137154@qq.com','867f95e9219f162c4349b344cc7c7893e1d0d641','梁天婵','1','1996-01-30','370102199601304126','13065078300','37','TpaAiZcU04rseJHz2mna','2','1385786354','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333373438','772521754@qq.com','e6285ca95b90523774989ffc344f6924a96991ae','徐立','1','1995-11-23','520102199511233027','13511956831','52','kkFBjxqSkpbbH9hjABGT','3','1385786773','0','1385822553','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333328106','750965942@qq.com','2b5a8e2c739aa4fbe244e3a02544b5ee0a122ba8','许嘉欣','1','1996-01-15','452428199601150026','13978477933','45','3yKEl0S8CIP6hee3C0yp','4','1385786789','0','1385815434','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333367113','SH1Yyy@163.com','4607d61075c9da0ddbe32353f0d278173cf0e423','石玥','1','1995-10-31','150104199510311146','15049135338','15','FSSqxhEHS2iAXI15YOdF','4','1385786805','0','1385865124','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333370317','1004248176@qq.com','9c92c3162719643253dc01ba18b571a08745c078','黄悦','1','1997-01-08','340825199701085028','13855615008','34','2VkU8YsnhrI09L8wsXt9','3','1385787238','0','1385789247','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333334354','www.93305623@qq.com','3cd353b0d17a84bf2f6d0b66cc2209a948f846fa','庄菁晗','1','1995-02-13','320381199502130068','15062062570','32','8CRPROdBBFHzEcciXQCt','1','1385787470','0','1385794829','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333343771','xuduoshang@sina.com','3b225ccea5f8095aae926ef68dece68d447a0d9f','许铎上','2','1997-01-27','610125199701275216','13429779133','61','CJ607gyZPAvcvQikrHSi','2','1385787505','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333339034','1972679574@qq.com','519d17e418ef09c3f2b337963c7f75019f1550c3','章诗悦','1','1996-03-09','210703199603092029','15640620317','21','kTOf9drcoVblFfp54y3k','4','1385788014','0','1385873314','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333340673','1968633715@qq.com','df48b963f59acebad891b78ef9c82bed62bef720','侯跃光','1','1996-01-10','220202199601104821','15143251995','22','mAmMKwCxq6QThOS9Ecw7','4','1385788289','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333396830','2452589078@qq.com','0bb0ea743aacfcbf3f425f5ca7be46af681f8ec6','邱诗雅','1','1996-11-22','210727199611220327','15640619246','21','zrgdnuVcov5s1lApoYIO','4','1385788540','0','1385871702','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333376520','991456475@qq.com','e24c780a94d35b1f43dacab6cec817a14411024a','赵悦含','1','1995-05-20','220204199505200621','13321504325','22','i5D5yfwZZkYLcWmPRmG9','4','1385788927','0','1385790515','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333371832','suhong8212@hotmail.com','80c49304308a1e71b001e826a38d3c639b9f904a','李天夫','2','1994-08-04','130902199408043234','13810364859','13','rN0IMM4ZptWhKqOPwYNM','2','1385789119','0','1385855518','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333335978','1172542941@qq.com','17435b3fdd2183d8ea9780368b469a05bfd218cf','缪曙东','2','1994-10-06','320826199410062291','13651560574','32','4OPsOoOpkE215vkiJ6m9','4','1385789603','0','1385791916','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333331233','563947242@qq.com','3d66fd859af48d237e256914ac527ac06565e3b4','万皓雪','1','1996-07-12','36012119960712692X','15170206357','36','7q0AweNrZ5n6kmvMhY37','2','1385789745','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333360919','www.695783794@qq.com','b535323af2d62d5a83351ed1c665ea2f49e9462f','刘怀煜','2','1994-07-16','120224199407161114','15822812928','12','NWGYKYlHdP3VbtFoARYY','4','1385789854','0','1385793867','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333345316','851203902@qq.com','2fc9c187724a18204d8a3a6a2a86ab4c66cc7e40','唐程','1','1996-07-20','513922199607208168','18708276597','51','g1ai0Bo57M3wGc3epleY','2','1385789936','0','1385874520','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333382891','jixuerao0219@163.com','48a6b1533ea0229d2b84cfdf057f67357723636c','纪雪饶','2','1995-02-19','230524199502191815','13555035860','23','lEB64cNuPjyb1FALoB25','4','1385790100','0','1385795305','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333332892','401743093@qq.com','b8aa5abc2583d6dc078dbaa9518b933051f63119','王瑞','1','1995-05-02','511011199505022522','13158575079','51','1oJ4TS3CmA7twNxuWfBf','4','1385790150','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333300052','747096758@qq.com','5c38fed076a1379f209cd7be1027b2eaf300394b','李浩宇','2','1995-11-09','530402199511090319','15608773810','53','aTFbgt0JorVCBzNDDDOs','4','1385791085','0','1385880141','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333354613','rose1117@qq.com','0035bf1136b61f16812c83b7b4da2833ad186696','王越','1','1996-06-15','210282199606159127','13841156190','21','qs6IVw6FYJp7zcT4Cs4r','4','1385791204','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333471832','2498236474@qq.com','369daaac6298cdfc796fcc8fc6a8d5347e4d512b','苏梦媛','1','1996-08-21','341202199608211329','15556558772','34','OpGierwYKs1BgOgqHlZA','2','1385883580','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333362503','1123658258@qq.com','5ec1860c015a39bc62f6d539ed20d7ba0c7507c0','刘文娜','1','1995-09-03','320323199509036820','15252035547','32','wZRXg8qLJoaLsYHpwV5o','2','1385791897','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333390666','1036754956@qq.com','bded0761d5cc25c3f7790ed011068923355500f3','孙嘉鑫','1','1995-12-11','21102219951211006X','15904193112','21','bculYY8JfO9rUBZWI4Jh','2','1385792101','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333381262','www.1501168377@qq.com','6b77c8de510d4229f5becd80778d6b628642aa69','赵晓琪','1','1996-04-06','370911199604061668','13563806855','37','VNE9J3PCVuqdVWGvL1Lu','1','1385792105','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333306266','1290779099@qq.com','0daac55aecf44d96b87cfd0ad27b5f2fc64d2583','贺晓娇','1','1994-04-24','130402199404243020','15369068875','11','xGKqpbAWs92eojjgF0GF','2','1385792399','1385792678','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333317112','2022792554@qq.com','06b827d87959d7351972018d13e9e9a1e6bba8f7','高溪遥','1','1994-10-20','120104199410200822','18622350207','12','UmFfWHBQp6c0BtUEaIFQ','3','1385792670','0','1385792905','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333320336','thskgh@sina.cn','1c6f1150b255450cbca23447ba48ca433dd7fe2a','冯钰涵','1','1996-11-05','211003199611050120','15041935832','21','K2Ofg0AS5WkUDmLvnOvm','4','1385792832','0','1385795347','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333348496','1025323154@qq.com','59a203be8b65e346b8c9a036a745dfaa40eabc67','邹杨','1','1996-11-19','430725199611190023','13548843882','43','Z2OtghqpTxo8laobYQ8u','2','1385793002','0','1385883743','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333376577','1246908566@qq.com','2a2d70a709bf2c5c3da50c8ffa20f29da8ec54c7','王城秀','1','1997-06-11','51072319970611264X','15983622546','51','gj8iyb36is6FTemkRSeD','2','1385793200','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333312532','770285172@qq.com','880f4aada867c86953d6df60eb9c0f9e3759f83a','高禹萱','1','1995-06-16','320882199506165843','18761018434','32','x4LRCM0ngLtGl0OadTsx','3','1385793888','0','1385820696','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333309323','36054246@qq.com','c7e50af7021888ebace32a1e6944b051b3637b1c','富月明','1','1996-03-26','210103199603261221','15640530033','21','Azqa6g88TkS57NRb2I3G','2','1385793957','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333395320','976315856@qq.com','2a427cf786698f60b9e47d2c7235b09c4ee510dd','靳宇晴','1','1995-10-23','130123199510233622','13472152718','13','RGgc908VgzBqeD8NfDFp','3','1385795481','1385803326','1385873292','10.3.1.20','8','0');
INSERT INTO `ycity_member` VALUES ('1333310910','1356541718@qq.com','9be6cd61370609212741cfa42f398386206a4b24','徐旭阳','1','1995-09-26','330681199509261544','13732480587','33','g5bG6vNXfQwOVfBhXZHO','1','1385795515','0','1385795666','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333321834','995768807@qq.com','c448cb40486b003d5e2c487019fe4849c32560ec','陈思','1','1996-07-30','320723199607304640','18061326508','32','e4kWcroyhYDPAkvrlytx','2','1385795696','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333303116','849890484@QQ.COM','497fee26fa573399e8a35e0b68c030c9df7210ea','冯璐璐','1','1993-12-13','320382199312131947','15852415586','32','9VcCDp7vqxHgkmR681z1','3','1385795876','0','1385796958','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333379604','15881105372@163.com','dcef161ca143ae95ff05a3b490af9daf47d08cbe','曾丽','1','1996-01-24','510112199601240723','15881105372','51','zWsxBWWOYRyVWj7VLiz7','3','1385796296','0','1385830730','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333326576','wy0729@126.com','41ac38877ac19eb41c39a51da8af4ce59fc593fe','王雨','1','1996-07-29','110224199607292424','18801233819','11','O4n8y9jkbkNiVN2hipgK','2','1385796506','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333353183','1421264489@qq.com','f6b60e7417e09e8383673e861334c0cf20be4708','王芳','1','1996-01-02','52012119960102130X','13195106189','52','T4gRxF39hDdDCfvSrUZT','3','1385796641','0','1385797732','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333357874','2225450710@qq.com','b5a80d595d234cba1f43d07d7632b13bd1a1bfc4','祝旋','1','1996-09-03','522121199609031424','15085116763','52','jB183zeFKJPiV9Akv0Y1','3','1385797145','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333356266','1090877994@qq.com','0f66edfaa6a0504db543997a20224edb62502d8b','巫梦琪','1','1996-05-08','360302199605082523','15079034287','36','QV5MhQNMdLOnpUVqEEYt','3','1385797249','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333393730','674786110@qq.com','60005af16ca24ca3f507b9d9d39774a99bf6cc2e','林钰婕','1','1996-11-12','360313199611120062','13979935353','36','bNjRXHflweTnVVXCBYbD','2','1385797250','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333364054','574318278@qq.com','c18e63d921d65bbb6cdb10e16c5afbe50b0bea1b','董博文','1','1996-03-16','371328199603160045','15610701341','37','Qf24g2kCQtADsURLtF80','2','1385797297','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333384328','834886314@QQ.com','12ab572badc707160ba1e4c96996e3a63f9fbb4a','朱姝','1','1995-10-25','320811199510251044','18252352078','32','2pk5jRo3gx9ntxyRtFWn','4','1385797316','0','1385873685','10.3.1.20','7','0');
INSERT INTO `ycity_member` VALUES ('1333387534','1072696567@qq.com','983c519e47dfb97ec681a130ddacaeb9fc057a5c','张燕','1','1996-04-12','360302199604123020','13979916529','36','yDuQ6YMDldWXarvp5RTf','3','1385797329','0','1385797487','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333389025','1169479815@qq.com','0e04531a193280f3e69c33898ca5b2356c08b51e','蒋明娟','1','1996-01-10','360302199601100528','15079054354','36','24rkG6rZpCzMCU1XIRH8','2','1385797362','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333307836','yhsxdqkl@163.com','f42ab9d158f254be8080e4d4db1f6e83c0bb294e','郑彬妤','1','1996-11-20','220104199611200320','13756279619','22','CpGCGtLHILwgZzkrBaY2','3','1385797370','0','1385861660','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333314041','541258038@qq.com','f8e4d74a5732d96d2c01a31fc0dfcb65d7c2fbb6','海娇娇','1','1995-07-24','210211199507245526','15842485436','21','pb0sssGiWCQkmIzSEAqB','2','1385798201','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333329686','295759719@qq.com','0c29e091d16cbbdb0ec0393101b354041336ddba','王艳娜','1','1996-08-14','210111199608143427','18204148105','21','dYLR3QI2W8hyh3pOw3G0','2','1385798202','0','1385863481','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333318794','www.bfwc@qq.com','15b12fdbddad12d4039c0e00b82830b354c1f36b','孟雪妍','1','1995-11-18','210505199511180023','15084267099','21','MDXJz3JKReUz74PZc5za','4','1385798681','0','1385879948','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333351571','524690682@qq.com','d4b92f38fb4417b5b2e1749f2da544e6c6e0bdaa','朱秀楠','1','1996-10-23','230624199610230223','13766777108','23','SOvc0T8ZxvPqsYm5POVG','4','1385798726','0','1385801202','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333378120','1050471974@qq.com','e80748e53a3e3113c1f9192ab726e165f80be0e1','汪雅丽','1','1995-10-13','342622199510135661','18356298195','34','mr9rAkk9jBY1AOkWlIRW','2','1385798736','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333373476','312806843@qq.com','88d18251328572978dec99135bdffc8e55e4d9db','吕苗苗','1','1996-02-09','610121199602090069','15594611415','61','ZkPpAPKUoTygSEWjdWii','2','1385798785','0','1385871968','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333385998','1447437753@qq.com','432e4d22c38558910c2a4461db4999a09fab76e5','黄可','1','1996-11-14','360302199611143564','15070821044','36','PykiasnFQqiGP3rOIAbu','4','1385798941','0','1385799033','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333337544','1245902338@qq.com','2e578897ebf641b923cf4297ab30034473aea0a1','许佳','1','1995-06-09','210504199506090289','15841424382','21','85lLcPscmnZh9vMqv1q2','4','1385799224','0','1385819363','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333365604','530385662@qq.com','8599ac78a42422eff869e34286ebc72bb14511cc','高林','2','1990-12-25','120110199012250012','15900393046','12','taNvbPO4sJDjomFhJ2Oo','2','1385799314','0','1385800442','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333359322','1227950040@QQ.com','70b717818d8d597a50646bd13507a053621d4c55','杨倩宇','1','1997-01-15','511325199701150921','14781743923','51','2wwV8KfkEJbSfkHppeh0','3','1385799329','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333323412','2392201009@qq.com','fc2299fcf427060cb99bae7d28640824273cda45','王羽','1','1996-06-12','110105199606129444','13910128723','11','S2IPRhDpOZXPGdROBDhq','4','1385799484','1385807526','1385819940','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333392157','liaoyulan123@163.com','6948b36508d567500e64bd1b40a68c6a27a35398','廖玉梅','1','1996-03-12','510504199603120647','15682307516','51','B1GC4jVyLJQqqgb3qZl3','4','1385799537','0','1385803129','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333325043','525324008@qq.com','3f035260222871d9a921f81d6677e591729e7c1f','李文雅','1','1994-10-04','320923199410043628','13851054132','32','zP76jkaIpfw9jyJfTu2l','4','1385799557','0','1385799970','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333375038','550794590@qq.com','6b1676f8d23d7505fcb6d3cc242f94bb61ba4cec','蒋靓','1','1995-11-21','360311199511210025','13677996706','36','1aNW2QKpTPcm6a1gGKDE','2','1385799909','0','1385802911','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333312510','707173885@qq.com','6954e3856ce378d08bfe32d56879e1ff28730c3c','冷美玲','1','1996-02-13','510921199602130024','15282559518','51','lb32xc4sXoRcvivehlT2','2','1385799931','0','1385800429','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333384362','478838790@qq.com','50b15626b9dd3e14a1bdb4025d84c721e81860ba','钟欣婷','1','1995-06-15','360323199506151521','13647005023','36','Zgpb1EUrkW4ZFge4iCnG','2','1385800282','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333396857','805563706@qq.com','0368fa26ab282f71b33a7a0b289167258f48efe9','王依雯','1','1996-03-08','230105199603081024','13836177586','23','LzG02RYnagjK5nopkPHN','4','1385800741','0','1385801041','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333384391','www.abcxiaoxuan@qq.com','efb5fdaa36d70a4fba68ccd5ce0b9953ed367989','朱晓旋','2','1994-08-17','211202199408170551','13188408787','21','349H2fawpGRWoFNUKs0M','4','1385800838','0','1385866577','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333340634','1007910693@qq.com','5f41650f2f533978cbef10672a50a013d6bfdd9e','尹如花','1','1995-04-17','533023199504170743','13388829475','53','cqgjrPyr5604nJVht6Yr','2','1385800904','0','1385801084','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333323434','amber499459@foxmail.com','b39cc396e492cec48a4279c15881e6ac661d0d4c','高靖熙','1','1997-03-04','210882199703046442','15042718968','21','VNE9J3PCVuqdVWGvL1Lu','2','1385801399','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333321836','297136439@qq.com','c4c80ce03ae693e7d387f132f643ef2afdcff642','彭俐钧','1','1996-09-26','510923199609262524','15182531363','51','H1s8aX1BAOU2Vw7N8KyT','1','1385801446','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333318712','505054666@qq.com','1e4e67b86ebf254be9881823e94d801925d57ae2','施雨农','1','1996-03-19','211021199603192922','15293136827','21','3Ua2M3jY2xLcanu2dXG1','4','1385801430','0','1385805470','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333353171','1015254089@qq.com','fb02b6216f4a849c61694faafe65f75c1807c4f3','蒋馨乐','1','1995-08-15','510704199508155148','15281612520','51','fg4rH7vWZK8eIyKny9Hh','3','1385802064','0','1385805375','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333390698','hhq841868@163.com','bbc486401c13af65cced5746265ccbda8d669ade','汪莹','1','1996-02-04','330227199602042020','13967831201','33','e9by7bs53Cp90uLPonBp','4','1385802183','0','1385878044','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333384304','625034648@qq.com','022d8c890a28fc3340ec9cdabc8f63e47de9d0c6','王瑶','1','1996-05-27','320902199605277529','13270078516','32','cRD1CTgkqwWRCAU7JhE5','3','1385802426','0','1385802642','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333360922','2387038789@qq.com','0882a41563aa4b0631a52d6f122952978922f5cf','李良琪','1','1996-07-18','210181199607188024','15840090505','21','LOaFGlJqkEo0AtKdXbQb','3','1385802695','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333325012','305880315@qq.com','c4ae27ceea2571df7435a0c11876dbad6b58541e','孙得华','2','1996-02-15','220211199602150615','13039266364','22','vUMHEOVZQ0HjBuBfCODI','2','1385803063','0','1385803564','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333371817','xiaomu94pdw@qq.com','19b357177c89b63d7cd512b7192a6b257736c054','胡笛','1','1996-08-15','430611199608155522','15200294003','43','kKaf9q0erR2O7rjeqIcZ','2','1385803303','0','1385803506','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333309366','2819808799@qq.com','90c7b7679d90852f114c5fa04ea719c83239993d','李根','2','1995-11-28','360311199511282512','15279960422','36','oZCxwGUXF8YjEoPGp2CV','4','1385803660','0','1385804498','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333332810','770255557@qq.com','d001dd784219be61e67d7bed14ab6065877f2d2b','李雪','1','1995-10-02','120110199510020949','15102207871','12','UaBotEMd4Qg2fm9ZSz2E','4','1385803731','0','1385882223','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333362519','254557089@qq.com','7e9566596da9ce13f1e94d896ffbdefcfb4f84d2','张力文','1','1996-01-14','510122199601140020','13982053267','51','MZLKsPzXEIROkcyZLwQS','4','1385804377','0','1385804681','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333329606','543320871@qq.com','18f3e7c8f12dc139698f76e02eccee60e2b9c463','韦乃琪','1','1996-03-01','12010619960301704X','18630927521','12','Q8vyW5c6sUcuuoZOWGce','3','1385804435','1385807200','1385807534','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333370342','594561461@qq.com','56445f8f65a3259789ebf5837ffa93e2144b3ec8','李芳雷','2','1995-02-05','230229199502054330','13514613173','23','yoax0CLIjx9n4qpYSaRG','1','1385804470','0','1385875518','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333381238','1319891444@qq.com','08bbb4b25bc5b82b9b3d302671425e33e93eb5af','段毅然','2','1996-08-01','110105199608019636','13051561605','11','j5kgMYA0FSnNmOJOQANg','1','1385804538','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333331286','1915002855@qq.com','823a2ebf1f3cdaa7e7fef765014e2958d72bd350','李佳欣','1','1996-01-15','211421199601150827','13898781127','12','NWC9NGHd8iDoe5eQOUyO','3','1385804605','0','1385804664','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333307866','595259236@qq.com','e468ddb7f0ba5425696fb52546d5deb3f6aeacf5','黄玲','1','1996-04-30','360313199604301041','18779176332','36','cEOI4zPOGAPYJDBHNSAT','1','1385805102','0','1385805545','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333310916','714913978@qq.com','d3de7dccbca3d91a6a18eec18ce945a1b1a6fe15','伍朝东','2','1994-03-08','520111199403083312','15902503238','52','oXySfddewCKLzQ01Giuk','2','1385805620','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333314032','annie22152@163.com','72075be94f8836d037105ed3deddd6ba2576060f','殷沈杰','2','1995-06-05','320525199506050516','13801551205','32','WX3RRBVYI4lim1OBhJew','2','1385805671','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333339012','842877665@qq.com','8f19bece396a7723ea1cc7f189d6c88db5c509d8','张婉晴','1','1996-08-27','120105199608274225','15822869126','12','4dou6MfCqtDmFdPL2yBs','4','1385805991','0','1385874899','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333351586','jm2jf520@vip.qq.com','8e0b85fd6a74b34ca5a2ca3cd935d2cefd6b93a3','李嘉萌','1','1995-07-31','110222199507312229','18710005180','11','246H6fCJ3lpRHUspIqKq','4','1385806051','0','1385806906','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333381204','1805664158@qq.com','7870a7fc4d069d6e449e1317a90557dea0aa5acc','毛润宣','2','1995-10-17','520102199510172015','13885115054','52','qZ2wadYx8L1YQ5mMRNQR','1','1385806173','0','1385807102','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333317130','452529051@qq.com','44d585d3107cd3afaaf7a1f6030354c9707f98e2','孙晓文','1','1995-12-31','370102199512312546','15864535669','37','FTxsZKF3N76eTVvJf7ER','4','1385806397','0','1385809997','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333357883','765918848@QQ.COM','eeb8a937d2d295879b6fb0965c361d90c8b83307','范乾宪','2','1995-01-16','110222199501160332','13511030456','11','TOpGXJTfXsrKNAhGAVlW','4','1385807085','0','1385815122','10.3.1.20','9','0');
INSERT INTO `ycity_member` VALUES ('1333345371','ab776@qq.com','c7128d890eb13e61abe38d3e79d4a070b0d8c52b','李奕锦','1','1995-07-05','210623199507050048','18641556608','21','6LutNMdbmcELNo8iMn0f','1','1385807447','0','1385808652','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333310966','1299455855@qq.com','5572cf2807677037df0fb2b5b110bda94404e402','曾瑞雪','1','1996-12-22','510132199612225727','15928578392','51','ZSlzMgnZJ4xyBRKrh7tc','2','1385807535','0','1385809473','220.166.198.78','1','0');
INSERT INTO `ycity_member` VALUES ('1333304616','2244112011@qq.com','9b366cce8a85ec567f320b5c823766e5dbc4b09b','石孝琛','1','1995-10-10','120110199510101247','13102215138','12','l014AFV1g3eHQT1vV2C9','4','1385807515','0','1385883739','10.3.1.20','5','0');
INSERT INTO `ycity_member` VALUES ('1333335954','xu1208148706@foxmail.com','2d9f7365f92f3857a7d3be495c1d03fcc2b4b100','许明月','1','1996-03-15','513822199603158145','13388240809','51','sPA27awYmjOmFHrhaUxR','1','1385807889','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333357866','1069755790@qq.com','9aa08533113b9bdef90b827bf92ec919cb580da3','姚聪伟','2','1996-09-16','330424199609162414','15888333364','33','d2PLBx4cbtBVfHemqN7R','2','1385808136','0','1385808187','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333376538','532291703@qq.com','72e2d8d38accbc243c73ee9e8910dc2cdb828632','罗鹏','2','1996-06-11','51010819960611211X','18280137269','51','NQaB6ZPR37OoAnkYietC','4','1385808482','0','1385871671','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333353133','838431891@qq.com','49721262839c1a2a8a1d48728cd796358acfb07a','杨倩','1','1995-05-15','511681199505152820','15185111644','52','OyVqdTEbEn6cslCf3Wpu','4','1385808603','0','1385808720','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333337578','975492549@qq.com','7188e2d24a4d8f68c060173d310b5b87b33709ce','张梓炀','1','1997-01-29','510902199701299328','13568728831','51','7VhnqGVwELitIzAAqtHw','4','1385808594','0','1385813970','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333335910','407809037@qq.com','81f6317c028ea79745933cde8e8cc85c48e8eb34','金凤艳','1','1994-11-17','520112199411172223','15285186518','52','o9gpKsPgB06P99zn7JQt','4','1385809111','0','1385867215','10.3.1.20','6','0');
INSERT INTO `ycity_member` VALUES ('1333331210','775293446@qq.com','02b2f163f35e2a68d6f7983b1a56b70259b00ebc','李心圆','1','1995-10-17','110228199510175446','15510187869','11','JC8xlFxLsp982BQQ2UV9','4','1385809348','0','1385870078','10.3.1.20','8','0');
INSERT INTO `ycity_member` VALUES ('1333353105','1729528662@qq.com','abfd0262157e0cabfd4cf7f10b19bad463a405cd','白晓东','1','1996-07-19','110223199607193120','15201269941','11','MsZ4YzgtTotB1JyMtwLL','1','1385809542','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333365654','453591484@qq.com','4de6e83de3d468696a9e9d2395e0d0d04989aa9f','方鑫','1','1995-09-18','211021199509180028','13842034423','21','HJwlDZ40LH0gCKmpUgyp','2','1385809854','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333350016','461299278@qq.com','9e3dc65e2b7e8196510547c7dc07f8ed787c0c8a','晋楚佳','1','1996-04-21','340104199604210528','13956046333','34','RIkUyx2OlZnb7XAPZ5PF','3','1385811503','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333321896','wodejia515@163.com','d243352a1da8b3fd99f9156ea3303f74937d7e9b','孙艺涵','1','1995-12-11','220203199512114821','15143214048','22','OiXbpzzDzGDN1qA1ixKY','4','1385811579','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333354683','1021991515@qq.com','fff2ac9933fddcc9fda8d94de4adcc77ed441701','李晓清','1','1996-02-05','230103199602054822','13101665008','23','5JBICWULTEnLXA5DfnAE','4','1385811589','0','1385813147','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333364034','2894927144@qq.com','d2098ae400219fd0f29d6ad6d18b0ab117be7b8c','张妮','1','1996-11-25','320723199611254826','18261353587','32','bnEASEYop8im9LcP59EN','4','1385811596','1385856367','1385876865','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333328176','442104876@qq.com','7ad73fc495cd69474d9621214feec1a558004ea9','刘璟涵','1','1996-04-07','32128419960407062X','15189976880','32','fK3YhMGWYXEPoyu2gkYw','1','1385811650','0','1385815195','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333339078','1017099727@qq.com','3fee4584724889a169e4736c0909981335a4fe40','朱红宇','1','1996-09-19','53018119960919262X','13888335098','53','NQgfdsQSCSCCN0JDXeE2','1','1385811697','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333326543','840900430@qq.com','7d52220bb748351501cdb80b609961f3f0e4fed3','黄兰丹','1','1996-12-12','520102199612122449','15285535844','52','zjUiK0tk2TBGxmRakNlp','2','1385812213','0','1385812302','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333343773','1662427041@qq.com','ce30c168cc9901b1630e6c766abbe1925481bebc','李龙月','1','1996-03-03','230203199603030027','15245201753','23','zXqb8BuqOFhpDK1rPRpa','3','1385812656','0','1385870536','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333368713','candice_gao@126.com','117a74a12847065ee3fcfd00aaeed9e1f2e4676f','任可欣','1','1996-01-27','120104199601273821','15900395691','12','te8Tyy5YqofWXUHrFLXI','2','1385812917','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333315641','253293992@qq.com','37b93e1918fa38a6c059f90c6a553c15d54a0d01','严海玉','1','1995-06-02','320826199506021427','15161733679','32','XXnqmMZzXOPB8mSO5igD','1','1385812890','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333393796','2530972963@qq.com','84e69d6532f4a73d4b754439530198c818fb224f','闫祎璐','1','1996-09-12','110229199609121823','18210683254','11','yuBmkd6CwmMAaN4VFsAN','3','1385813219','0','1385859347','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333300013','1821339935@qq.com','4fe8786d06b3e9ad976132a8c3e39256dd6e371f','梅琳','1','1995-10-02','342422199510028080','13395519837','34','mYrwQOJiAY25mH5yuXIf','4','1385813308','0','1385873844','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333376533','www.18352363567@163.com','59950b1bc5517727d4c8dc69758295a83207e033','姜钦元','2','1995-09-20','320826199509206013','18352363567','32','asj3b5HCR9BMeVe5jfAu','1','1385813350','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333390642','1161347781@qq.com','dc4ad724c641c8f955854748598b5cd0eec693df','程维维','1','1998-05-03','342224199805031166','13952196758','32','wGXhYFqR6SHbxn9baFDK','4','1385813289','0','1385883543','10.3.1.20','7','0');
INSERT INTO `ycity_member` VALUES ('1333334310','842547363@qq.com','e4d5ec745c750ce8467d344572b1ed2e2af2075c','梁诗琪','1','1996-07-11','522726199607110043','18786059691','52','yJehaiBJ3mtgmW1IPdvE','1','1385813546','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333364003','1023899318@qq.com','7ad73fc495cd69474d9621214feec1a558004ea9','刘璟涵','1','1996-04-07','32128419960407062X','15189976880','32','b2xSi6fbA3NR0lU9uA4L','1','1385813878','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333326512','750990152@qq.com','247354bfb1f9f80edd847612b9e1fed7a4e16d07','朱文清','1','1995-10-29','130534199510298320','13303198999','13','jtqkstoxtK6MeNoEqXGZ','1','1385814308','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333393732','675439580@qq.com','33a08f91f9e37a709d380fced7a54cdcc9a77753','方晓卉','1','1996-10-05','330702199610051226','13586977487','33','aTFbgt0JorVCBzNDDDOs','4','1385814410','0','1385866263','10.3.1.20','6','0');
INSERT INTO `ycity_member` VALUES ('1333381222','www.821450300@qq.com','ed517c5b08b2ef4429511fb102ed4d96fca99bdf','刘睿','2','1996-05-30','520112199605302516','14785462779','52','FLHhxVYD8xg0UMF9N4VV','1','1385814554','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333317132','329798120@qq.com','721f9c615108eec72dbc3d5e711637f487ea6e20','杨安娜','1','1996-03-17','339005199603178324','13738030002','33','g2RZfMGhg60H3MVhrn61','4','1385814747','0','1385816810','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333360913','jiangmengting0702@foxmail.com','de46e72ef5ab0ce64a470cb8319a52301a47893f','姜梦婷','1','1996-07-02','330702199607021229','13335975562','33','x8pOcweCXaPFj5rUa7Fq','2','1385815013','0','1385881824','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333334332','821115225@qq.com','35579106ad7aa23415e7b428ef8bed566dbd8e97','李倩雪','1','1996-10-27','32012119961027132X','15251775271','32','thxjZzBVMhd542Y3RKzj','2','1385815173','0','1385815678','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333342191','1623293500@qq.com','e1320e89b4698a794553253a96e8ec0364945f0f','邵全荣','2','1995-12-30','520112199512300351','15285140739','52','nuuwr5UOKtgf1aS3hUL3','3','1385815184','0','1385815477','219.141.26.144','1','0');
INSERT INTO `ycity_member` VALUES ('1333342134','2425352343@qq.com','0621eade58e68011c9d782c615fbe6354da7e85c','于小婷','1','1995-05-05','210303199505050325','18684312493','22','oHLfFpvReKpIEsAj9y1d','1','1385815669','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333379620','170192449@qq.com','7ad73fc495cd69474d9621214feec1a558004ea9','刘璟涵','1','1996-04-07','32128419960407062X','15189976880','32','yoax0CLIjx9n4qpYSaRG','4','1385815714','0','1385874920','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333351505','790544907@qq.com','1238f181162bf7b99988edae2a50bc8abc781e0c','冯衍伦','2','1996-06-17','360102199606178016','15170081215','36','dkhG2ZEfCCPvzAjpxXFv','3','1385816349','0','1385870672','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333320396','149848581@qq.com','327a7f0231091862f989cb12d5659260afdc4a4e','董畅','1','1997-02-04','340603199702040420','15956187823','34','igJj9HcbhS1hNCf9atmx','2','1385816413','0','1385869381','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333348476','kitizinla@126.com','a1c09691a4275f4d8925c3a05ae56b037a683873','王雅男','1','1995-11-19','110108199511192722','13522185539','11','c1Il7SECfylUj0Mzolwl','1','1385816407','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333332833','467650734@qq.com','fe54db15c66b296670efacd20e2a5008af87ff7f','高钰迪','1','1996-07-22','370302199607220522','15069353249','37','NsW6b6vOYJ4REIhEGXtM','4','1385816836','0','1385817115','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333329636','2408337895@qq.com','9cd0d18a72deeadc4d37c1fb64e9d9ba39622271','姬晶','1','1996-10-05','340604199610050628','15556129251','34','aVOF4UzHke9nqWHtzR1X','2','1385816930','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333393766','578779832@qq.com','a9d7c966789776bc19ec2c14f32f38808c47663d','赵洋','1','1995-02-24','610302199502240527','13609277659','61','RsFserAtsFm6pWUJLOsE','2','1385817365','0','1385866226','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333342173','zerokingstay@qq.com','5b82511bd944e7cace8eba9a39398789ac139404','张尊','2','1994-12-08','110108199412084013','13641069625','11','5Ij4t9porocMAbvJj1O9','4','1385817665','0','1385865343','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333356213','1540397968@qq.com','ccf0b11fd16128d5d28d66aba143fcb6dda603ef','赵成杰','2','1995-07-17','371325199507175918','13468095778','37','L4Z5R6OyWBQz0kiNvmQw','2','1385817753','0','1385818792','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333375076','326623912@qq.com','d84485707f12e118c5875348fce1b070fa271e06','赵航','1','1996-05-25','21042219960525002X','13238135678','21','zjUiK0tk2TBGxmRakNlp','3','1385817798','0','1385873288','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333390625','2027896508@qq.com','6132ddac81f2ce45083eee243e835d71199ebd43','季节','1','1996-07-09','13010319960709212X','13731180660','13','AOcAaRdOQTPUHlDE4tAO','3','1385817968','0','1385876509','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333314010','1065315557@qq.com','2977cd594369d9f4ae9bd0f86e3dfae944bb99a6','张开元','1','1996-06-18','150204199606181521','15848699276','15','NHKWCafuugqR9hWBvmHx','2','1385818569','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333387538','851449535@QQ.com','618bffda86214b28a9c2801a77bbb17fc7231ec0','降晨曦','1','1996-08-12','110104199608120420','15901335468','11','sSYVR21wYMsoGuTPu2cy','4','1385819630','0','1385820101','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333398430','675123060@qq.com','6eaf08a364a3b2c38987a6ef8b09836af269127d','谭成洪','2','1994-09-26','520113199409261637','18690734210','52','Azqa6g88TkS57NRb2I3G','1','1385820145','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333315632','669194599@qq.com','1dfb096bee7a05a541cde3e688d86572e49e33ac','刘星宇','2','1995-12-24','510184199512241216','18780223731','51','ZEFPxgsJiql7oXNajbAO','4','1385820564','0','1385870168','10.3.1.20','6','0');
INSERT INTO `ycity_member` VALUES ('1333334392','gejiaxu333@sina.com','b79de8848cd81396a2b08c8147f13bc4d5f2f8be','葛嘉旭','1','1995-06-15','222401199506150025','18804333833','22','MBhvCoXmFioO44xZUO1u','3','1385820745','0','1385883211','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333376532','957016519@qq.com','1e88be24b62f5f8c8f82e93e8ce4dcb299a2be3f','崔若旖','1','1994-06-29','130124199406293322','13932139179','13','4APcfzFJbfjreE294WQp','3','1385820835','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333329610','1441211788@qq.com','fa2c9533aa7eaeea2e85683db7f6b6537f3518fc','李林娥','1','1996-01-27','513723199601272949','13699490359','51','eWx5oUa4OvfakvP9r5DK','2','1385821129','0','1385821269','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333317135','957216337@qq.com','6eb5a7b73cb664e65066338dc1cb0161a20c7927','周小炎','1','1997-02-28','430426199702280067','18774230336','43','y0WfJa6vCdsAcBewZkqC','1','1385821447','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333367154','878734908@qq.com','383434c034c99569ddf380433a4ffbff0728e610','李阳','1','1996-08-05','522401199608055329','18085017218','52','I0UCy9OZIEmqJWO22f5a','2','1385821602','0','1385822185','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333387598','zhoumengying.743@foxmail.com','f9f0314d7488758ea8ce70a6695105576d81361e','周梦莹','1','1996-02-18','52010219960218462X','15108503784','52','AE3AeZwTHU79Uqw3xbD5','2','1385821789','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333393757','774061493@qq.com','fd462d70da3753873291f0b6950fb43a510dc1fe','赵若璇','1','1997-04-29','510703199704290420','13989285509','51','qLHG6imWCaAxgkvUvmrb','4','1385823847','0','1385858652','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333337535','1033400739@qq.com','9a6a67b8ece0acda327623ff6b9785880a016955','赵倩','1','1996-09-14','510603199609146185','13990226793','51','VtH6Lf36xDZAHG73DKik','2','1385824308','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333335992','ykx1234567890123@qq.com','0786f88e838157961fef4d88ede9f610090d3c6b','杨邵壬','2','1995-08-22','520123199508221238','13688517758','52','Dx3Ic5umRjkgEtZqBEwn','2','1385824256','0','1385824744','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333354692','sherry982805047@qq.com','51011cf73c93ce0bb06f5283456d5eb33f30226d','王梦雪','1','1995-08-14','513401199508140226','13778666248','51','KGGjA2TrGjmOR2zpOrZ9','2','1385824374','0','1385824689','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333385928','415488263@qq.com','01b6ed54ce828cc34425176130c2f026a9178d71','卢彦君','1','1996-10-06','520112199610060048','18685101790','52','gyeTqljPYTcvNdXZbCEM','4','1385824850','0','1385880702','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333318730','www.2804739884@qq.com','fa1ec1635d83d4e4067ea2b5410e7013c304091e','刘凡','2','1995-09-04','430921199509040016','18096055404','52','rU7gLN83Mm5XRfF0vGSs','1','1385825325','0','1385825515','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333346871','269822414@qq.com','753e21bf4b469ef4f6dde220112985f25b1216f7','李静雪','1','1996-06-19','510123199606194323','18284571358','51','iDrZ9oS1wyqdiRUHCOgF','2','1385826450','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333301596','673443721@qq.com','effa9986b17e7b816d887a4e635d8811ce117cc3','顾晨晨','1','1996-05-14','61230119960514076X','13709160823','61','fIOPPiDl9UNDOLFqNon9','2','1385826585','0','1385828543','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333429633','www.2860409015@qq.com','bce0dd9dd86fe0936119528810e78ee235a21874','黄鹏','2','1995-05-01','513902199505010016','13795702130','51','JKR9bm0mxXBzHGMmP2Tx','1','1385827452','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333445336','406948622@qq.com','2c1d47bb87979fa08ce1dbd0cb66c0effe537be8','彭成思','1','1995-12-06','500101199512066582','18723525902','51','e76UfbdixuikyOUhfagk','1','1385827744','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333437534','827629812@qq.com','a91d52c2bc5e1ec8f708ece02ec9500d0bed6c71','张泽尧','2','1996-07-28','130525199607285714','15632612953','13','ysqEKK5BiYuE9FpQ24Oj','4','1385829471','0','1385860663','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333482828','www.645506274@qq.com','907842af10b9a8d7fee8ac447b00924f7a0f2920','颜小奇','2','1996-01-11','500101199601110215','18723561301','51','qPCHwd9Ntra7MJxICip4','1','1385829852','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333484398','760408627@qq.com','3e618e39c55fb8ee07ac0fe179f74e89f00128e3','陶静怡','1','1996-01-13','230603199601131328','18845935999','23','m95zy6LpmKFcSVFAWZtu','4','1385847614','0','1385870133','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333439073','18090352990@189.cn','20efbc47ca67f6ffa98126cc19c898bd61195cf0','黄燕','1','1996-09-26','511102199609262028','18090352990','51','SHGBOtgBhLD1CaCocC7q','1','1385851209','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333467142','85414897@qq.com','adbb8b578cc4e08b8d23fdb73c14c8392faaaed9','张思捷','1','1996-08-17','110221199608171924','18810797022','11','dc3rKKm74Sdrs3tJ05P3','2','1385852896','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333440688','1024205596@qq.com','87cb6285868dba88efdf6a04278385b95e56f36a','刘子赫','1','1995-07-06','230804199507060049','13624544666','23','Gwu5sKOkaX7IYuoj7K9b','2','1385855276','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333446896','838632413@qq.com','cb14a687caa85917af533870c5fe36ce06ccabb5','苏婷','1','1996-02-24','340404199602240025','18247733372','34','EZyywh8jdmXMhvoRUFh8','2','1385856681','0','1385884006','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333423443','1075624966@qq.com','ed5ac2e707c9a383957dad0bcb4e3dd44acd764c','葛雨彤','1','1996-03-29','210102199603293024','15640538430','21','hDT5Pc1YfPDcYXoteQjZ','2','1385857537','0','1385873294','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333485934','814205705@qq.com','4d4252a38bed2b20d49a7bb5dc56716f67411f9b','余凯霞','1','1995-05-01','520112199505012220','15885010229','52','o2WZkhO0Mf6v7Tf0GySq','4','1385857941','0','1385882749','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333478104','827345291@qq.com','c27a395661bddc34acce8a4a3d55728462a53464','关梦洁','1','1996-03-04','110221199603042429','13520539600','11','c1Il7SECfylUj0Mzolwl','2','1385858489','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333448405','185779598@qq.com','9d7d22b7d1ffd22aa64fe6b0c1ebfb1bbf92f26e','李胜男','1','1995-07-07','230381199507070023','18246760453','23','CNtw6PuC4QJvJIw19rJp','1','1385858533','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333415612','554712366@qq.com','26953d90937c84e16ef4b006b5465a45a744c8ad','李慧慧','1','1998-06-16','510722199806166569','13303222093','13','i2ihKo918dvtrcip6gM8','2','1385859297','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333471876','540250352@qq.com','96728c463d29291fad97f9eff6c180563f757dc2','王宏蕾','1','1994-11-09','140202199411095047','15735206418','14','wVsIHGAqZ8o9n2mLZOcr','3','1385859431','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333401516','www.530380731@qq.com','cb4aa4de8d880476a7d75abdc31a7f021f324277','李菲','1','1996-08-13','421302199608135560','15971928108','42','TI6K59h5lCL08L8Bg4D6','1','1385860432','0','1385860937','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333420334','237696392@qq.com','d1f473153381e52328dc1aa4c119ad84d0a04234','蒋昕瑶','1','1996-01-16','520112199601160020','15985162778','52','336Pp0K2L53Yqo7FO9jG','2','1385861068','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333421812','773604961@qq.com','cc7fcfe71bc1058b33ff7a36130f4d9c88dad697','季英豪','2','1995-05-08','120110199505080613','15620518081','12','E6FbjHHNtUswXOBVrCI0','2','1385861227','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333470332','763496313@qq.com','e8ee2be37837bc246f0f4b365e8bb3b789984a64','张微','1','1996-06-13','520112199606130621','13885156790','52','toA9MM77I1tS5lJBK154','4','1385861347','0','1385874313','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333450071','475639548@qq.com','4bdc7e5b8aea5aaab4bfe79aa1299285d62b6274','杨希','1','1995-10-17','120107199510173023','15822360129','12','mwRx2eUZFlDhXK7IR9tk','4','1385861847','0','1385864632','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333468717','861877599@qq.com','64f177c228778857496222af941daad4461dc89c','李姝杭zouH','1','1996-08-21','510402199608213027','13982324553','51','FJln1XFfcPoeOMDiZ8Uf','2','1385863124','0','1385864475','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333475077','956905461@qq.com','c3cb50a716817de334d07f0d277e7c027d18749e','石子玉','1','1996-02-26','320826199602260022','13952364138','32','TNhWGcOEPxP83CDIsUG5','4','1385863139','0','1385877555','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333465613','1046793916@qq.com','8e9e4bd0db6a58caf84cc608675bfb91f58888f1','黄维维','1','1995-11-19','520103199511196023','18096043073','52','VGdC33QRSq8x0MY6UrRk','4','1385863161','0','1385882018','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333434378','1083286038@qq.com','d535aa7d4dac06eba7fe566ec0baceef38fa2cf8','魏杰','2','1995-11-12','150204199511121518','15049231560','15','xRYB2QbHhsz6nJ1PnJsG','2','1385863362','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333481291','401434074@QQ.com','80ee35bfd7603ca81062f352578b3c53264599ad','朱雅月','1','1996-07-30','321002199607304625','18252731958','32','yUflrjkIdVFT4RsDrWUS','4','1385863886','0','1385883279','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333473438','1107981910@qq.com','f373e31fd95ad89c52849e0fd53d7413c6066304','谭宇','1','1996-04-21','321321199604217425','13401933786','32','DyzPOOYnFLPbAS6FDgIa','1','1385864030','0','1385867091','10.3.1.20','3','0');
INSERT INTO `ycity_member` VALUES ('1333498452','874386520@qq.com','20f07f5652bc49226396f5251c41d781b4340c0a','王雪颖','1','1996-01-01','14010519960101132X','15234102688','14','W3OzXORprFG0r3oF8YOD','4','1385864056','0','1385873621','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333425076','598912821@qq.com','d20d62e0450f5c7183788f6b459d3f208dba9b4b','陈献平','1','1995-05-07','450922199505070920','18776351411','11','wFaEdOPY186bi647QDXI','2','1385864792','0','1385866101','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333403113','1072999654@qq.com','c625a32b798a36c23be9848fe87c58b596426022','陈磊','2','1995-10-23','341124199510236010','18712080897','34','tNZzxYO70IgdoptkSpPk','2','1385864851','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333487525','402116256@qq.com','8ec2228fd31d45bf5e61f8b94feffd88f1cc7bf1','王家琪','1','1996-01-27','513425199601270229','13795601880','51','whzGoXGeotSHrqw1Z7nA','4','1385865236','0','1385866769','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333496896','1159078891@qq.com','6df44fea9c4b6ef3ea3f28b55c00718416d82f4d','陈凯迪','1','1996-05-01','610424199605015529','15929298545','61','T7lSn5cdcQ6BzFNo0FHV','2','1385865764','0','1385866067','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333476520','1272196723@qq.com','7d5767e9ac9affb54fdcf9e22fc00054f624f433','陈媛','1','1989-10-08','320901198910080043','15950299936','32','vaD3ysECorYHjNU3UenY','2','1385865767','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333479662','394902496@qq.com','271e7c51352f5ccccc88632e2342543101b86f2e','孙瑞雪','1','1997-01-15','210781199701150025','15841673266','21','Xj5un6WNaugpd9QD9eHW','1','1385865902','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333489066','576579575@qq.com','6a2395304175b5cc70169b9224ac4106c1e1059c','何雨婷','1','1996-01-03','110223199601038461','13520362728','11','5tRe6Q7y9Ji2EoY7CDv0','4','1385865935','0','1385870539','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333400045','836891963@qq.com','4e328a5454a10024e96e81c9b287ec8d7df3eceb','吴瑜萱','1','1996-07-05','330424199607050021','13967325222','33','RsFserAtsFm6pWUJLOsE','3','1385866229','0','1385876687','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333478120','1299542543@qq.com','b25d36f7f4d2baaf97e042e0fe9064a26f56f01f','尚冉','1','1996-04-15','371522199604150028','15265855660','37','QQ14vJZ0iCPNMOulKPIx','2','1385866405','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333456274','852915879@qq.com','130e968d7254f393ac2d88a192e6b7878e88ab3d','梁仪羚','1','1996-06-10','520112199606100027','15329006017','52','stgtp9kOfBtraH8jeuA0','4','1385866815','0','1385872778','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333406236','598302337@qq.com','de48cf7328ebd6083b1a91f145f78dec60784c1e','冯瑶','1','1995-07-18','511011199507188788','13118069576','51','5zvG44e8Wk21TOlqJE4h','4','1385866881','0','1385881058','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333490657','854987472@qq.com','70cdd8d0394025b8d7c46c1199bdf6c03de7a2bf','陈木丹','1','1997-01-07','421081199701070027','13329770968','43','UOPVrTKiUHvHy56a944x','2','1385867074','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333404666','770721724@qq.com','a0d6f62cbd6f853fe5d1ce0b2aaac8959c6a7289','程俊谕','1','1996-09-22','510681199609221324','15183870419','51','Y1S5YBTnq2pDA6cww4K0','4','1385867379','0','1385875969','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333453113','644988565@qq.com','71a655c20789f03d21553961fd9f706aa1146099','施金呈','1','1996-09-26','33072219960926692X','18006505617','33','Q8vyW5c6sUcuuoZOWGce','3','1385867392','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333475038','664039488@qq.com','9799f799539c5686de08d4a1cfed532a8a6db433','刘慧敏','1','1995-02-16','150124199502160128','15848938596','15','u3wVpHpHsz6nF2jEziKd','1','1385867619','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333407823','994193959@qq.com','a40d65c5a396afee7437c14c87c002361a9e535b','曹宏伟','2','1996-11-10','340503199611100613','13721229330','34','RskdHLAO1ga2E7Ra8UDH','2','1385867757','0','1385870315','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333451583','penjun@sohu.com','4447a1ad80ae2060571a456f77d7d0a871b43e76','彭丽云','1','1996-09-24','342626199609240045','18156568088','34','RQjAqINbNb1DOh34LWke','1','1385867793','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333426506','limnig@126.com','70c76e76db5e25dfc6d06ec438c766da7ab85650','李思蒙','1','1996-02-05','110104199602053028','13911275875','11','h5PQon1wORLLbuC439iN','4','1385867938','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333485998','1961234005@qq.com','ce693f9378641b26356ddb29740beeb0874c0713','周辉','2','1996-08-17','320802199608172030','18757127068','32','6s9g3OsvE3HOJEcArsOJ','4','1385868320','0','1385868416','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333492130','yckxl@163.com','e001ea2487021126a08518c723d13dbda981f91a','陈浩天','2','1996-08-28','320911199608281511','13921848576','32','7K1eKrieHJ8OnhQfCXsF','4','1385868322','0','1385879802','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333493720','425372207@qq.com','fad1d1cf62fab12d5d9a3f7b81011aeca1706352','张喆','1','1995-09-16','110109199509161229','18710045147','11','1Axfyzm1lhCGyb4uoHM4','4','1385868325','0','1385868647','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333493730','1075100645@qq.com','180180bbb4a41f99e3dab10b107b9a581952902d','郭佳欣','1','1997-04-13','511024199704130026','13890515198','51','cK03nXPBzGAggx0LBsoE','2','1385868692','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333495330','1564427912@qq.com','7bf8f5e32d4aced0dd476691c636a7ed80101504','王可倩','1','1996-01-07','210111199601072021','15566136199','21','0gWOku9h86Cm3jkgKdDV','4','1385868744','0','1385871434','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333409310','www.470993928@qq.com','80981b46719d42d00d0524c280ee19c0fadf0602','鲁佳琪','1','1995-07-25','511181199507250048','18284815905','51','OE9APMcTNfNECRgWj9ax','1','1385868895','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333457822','470982821@qq.com','ca5a620caf880b275f6b365bc876aae5616009cf','王月茜','1','1996-05-28','360281199605282146','13979825088','36','4CcaTV7DA32lOTKTW1e4','2','1385868937','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333435944','babyllvoe@qq.com','c474a998c8478cd56ab3ee707512f645037bd598','郭雪峰','2','1995-06-14','130421199506144217','15227929771','13','38UbTUNW3vC2IVfvTQjE','2','1385869033','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333426576','916264674@qq.com','b69004956c3df32402492b504045fd9a33c74177','王楠楠','1','1995-08-21','210102199508216629','15940372100','21','cJDz6aTzWTbOr2L8f9kW','3','1385869161','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333496830','zyb934114914@163.com','9da82cf16c7d3c308c15955dd01bfdc247d71c23','赵毅彬','2','1995-06-15','150204199506151819','13948727126','15','wqDMc7CtqTcZE0l9utJc','4','1385869976','0','1385870257','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333482891','1124109715@qq.com','89dc95304722e9fbf70a26113b4d22554ab99291','凌琳','1','1997-09-08','430321199709081725','13348728828','43','x8pOcweCXaPFj5rUa7Fq','3','1385870228','0','1385882543','10.3.1.20','8','0');
INSERT INTO `ycity_member` VALUES ('1333459319','1303915217@qq.com','8988fa29a14f268548dfd07db7390176fc420f8b','谢金君','1','1995-05-27','532501199505270023','15974710525','53','pto4PR4AAhLUDsFDOrWK','2','1385870455','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333428186','guangning63@126.com','e779f2e7ef936ec4278df030897256c1779d9dba','徐明佳','1','1996-02-26','32010319960226176X','13770646242','32','y2sTCjYxwDnGQGb8nRXW','2','1385870531','0','1385879499','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333454666','405229992@qq.com','b3069c2db44961e9b54bbac1178e984cfcef20b8','刘毅','1','1996-12-22','210282199612229144','13889571779','21','dcbXapoEmAV7y7VlJvBi','4','1385870734','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333460903','157421406@qq.com','ab0ddfbc758ad03a144683277b43b8a25c06fcbe','王昕','1','1995-11-08','34262619951108008x','18356361184','34','R2aHxw3OjLRuQCbLOShD','2','1385870864','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333410932','496003667@qq.com','deec413ebe595d0ed5895166f9b2403b362c4fb4','赵驰','2','1995-07-08','211282199507080617','18647539955','21','REyuYh9OGxaXNKD69Bx7','3','1385870901','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333412541','15922409818@163.com','7b06a2093c556230fd8f3afcc37a0a776b27f03c','管玉静','1','1995-02-17','341226199502173740','15922409818','34','Azqa6g88TkS57NRb2I3G','2','1385870919','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333442171','nzy1023049730@foxmail.com','400442f21c087cced9f581dd0649de513c771fca','钮晨恩','1','1996-06-22','330501199606224422','18757296150','33','sd7Z7wE9mcO1TXQ4FICQ','2','1385871055','0','1385872269','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333414035','595692975@qq.com','09484fccc8232bded68ae898fe79dff2bd06879b','李锦颜','1','1995-11-16','530111199511160428','13678769597','53','yW957yMuDRZVSRTUMjas','4','1385871331','0','1385871560','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333443716','893641453@qq.com','6663826dfce71efb45ada7238109e8ab2a0cf6d4','郭晋吉','1','1996-04-11','120222199604110022','15002298799','12','2ghvqcTp3KwIqELhp4ye','4','1385871526','0','1385874790','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333489025','61871486@qq.com','785d06a8a7d2d41a8dd87369b9e9d05ee3413ad6','吕冬雪','1','1996-01-02','130403199601021220','16233100920','12','d32s3HEBFXSOXedJmkJQ','1','1385871775','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333417194','929329813@qq.com','f89540bd86918340148e0bcd1ca6b4efefb35928','苏曼婷','1','1995-11-29','142723199511293041','18235985111','14','VaHEbPZwmAfzdiQoHwKx','4','1385871887','0','1385875486','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333418736','775808951@qq.com','46c2aa9bb8a389d79fb2cf8b06248c89fa128c30','柴绿漪','1','1995-12-22','330225199512221022','13567875551','33','kkDnbA65MpVxW1BDlVl0','3','1385871937','0','1385873353','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333460919','786683416@qq.com','88d9d4723eddfeccbac527eb719046ab774da279','曹可青','1','1995-10-17','130230199510172726','18833378887','13','MqqRFL1RqGEeMZQ70SOb','4','1385872243','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333431292','1253066579@qq.com','b830014fad2f612c2d344aec190fa46a5aa70529','陆垚颖','1','1995-12-13','140881199512130022','18751983984','32','imJCNkAewDCj3OGlLBCE','3','1385872651','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333432854','956507272@qq.com','16468a2a65ed9a27293f67ec717e81b0c419bc8a','陈玢玢','1','1994-08-29','14230319940829062x','15035889196','14','PDVKFTyhGkENMMZHCdm4','4','1385872652','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333440673','hj2011_happy@foxmail.com','cd67289f4b8941fd982ebe89e469f0a21f99992d','韩娇','1','1995-07-04','110105199507047320','15210475825','11','cYNeK1hfZCcz3hoeoC47','2','1385873023','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333462554','1335090585@qq.com','6e352d47f8a71c8ca7626a46028f4214b1236932','俞冰清','1','1997-02-02','340603199702021027','13705617394','34','yp6YWr2diq3zVD8HGC6A','2','1385873619','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333487534','2472250242@qq.com','69fb3894199eb599939b007fe7386263e573d914','唐乐民','1','1995-04-16','340122199504167967','15056012957','34','w8fx7oybKg9nsj3H4GpT','3','1385873711','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333451571','648621655@qq.com','6ecd44a6544d34f93d87c893048bce4f7d762b83','陈新','1','1995-04-24','510303199504240021','15808244382','51','vVhMGx7AjgyvcWuyHHHM','1','1385873880','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333464054','lixueshanxs@sohu.com','29ba88f275a5dd71e6294914a7a053fe367b3bfe','李雪珊','1','1995-12-15','130429199512151545','13683609974','13','38nKmMaXAG2eE8Li1o8K','3','1385873919','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333429686','1054669641@qq.com','6e2fd6b5665ac47a8fc485d3f6c61ca13a28252c','黄鹭','1','1996-03-30','370802199603301525','18369873922','37','7OV95YxPVcNMPCjIcdUA','2','1385874173','0','1385878869','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333400052','513699330@qq.com','959e137431489d0bdb7e5d676d16f5902b4dbc71','郝韵','1','1995-12-08','652201199512081221','13951995419','32','Mxx8ZNPjze33pKZiNzLL','2','1385874175','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333464004','1416126869@qq.com','3055cd6d12654c2f0d1c64f7ad85c6566d4851fb','丰丽丽','1','1995-02-08','220106199502080625','13943000536','22','RjGEQ68rNadVilNcuNVp','2','1385874858','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333420336','10154473@qq.com','77eec151aa3d9575d204cd59c13a4e4d9626ec41','陈凌杰','2','1996-08-31','510304199608313834','15182600281','51','VNE9J3PCVuqdVWGvL1Lu','2','1385875160','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333409323','769947770@qq.com','18d59bc4391f88c806fce28ef7d8fb54027ec7e9','林娇','1','1996-06-27','522724199606270026','13809441083','52','o8KkcoDO5BYZGAOxJlAm','1','1385875356','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333414041','26310497@qq.com','aa20839690b2044e73f15996deb13d8b9c1788b4','张雨晴','1','1995-11-27','340122199511277961','13805695817','34','3vJNGm7iEXCtiPnunqQm','4','1385875369','0','1385880082','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333456266','164670464@qq.com','ef1953b6d6324abe6cb8d81c4ec3bf88cddcc935','袁梦雅','1','1995-02-13','520122199502131825','18786786412','52','lzJPv7WlCszkpEGhXoVu','4','1385875479','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333431233','nblixiang1995@126.com','0725014048533518f9dd34bbf50ea8eea1c3cf8a','李想','2','1995-07-02','110106199507020319','13552631369','11','Qf24g2kCQtADsURLtF80','2','1385875540','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333418794','956466925@qq.com','4f43af8f55ce5c31d124b6c80d4cbd3967320275','丁绍倩','1','1995-08-11','370682199508110422','13562572095','37','OJPkrWhn9yZ4PWSfn5W9','3','1385875736','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333410910','929665067@qq.com','649d87f71a13da0768c30f3056fbad1464d3ff61','陈媛','1','1995-03-24','320829199503241685','14752369578','32','V7rxP5yKTOBGeXw90XEh','4','1385875847','0','1385883138','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333476577','582263963@qq.com','57bbbecc31603c889ed3524e15728ccfd4db65c4','唐莉','1','1996-08-11','510502199608114729','13548361867','51','gllB6SVWr467zFYpdwC4','2','1385876212','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333423412','465415557@qq.com','ae60717912a51a22418ba5bc4833de0fef2f1218','鲁格格','1','1997-08-27','130702199708270649','13731301638','13','nYsPvnHWH9pZXf89wul0','4','1385876245','0','1385877953','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333406266','120244072@qq.com','1e02c5e848e175218da031551c8b6a50a340249e','肖瑶','1','1997-02-22','51392219970222406X','18190287180','51','KPJIWJGCXLps04remxeW','1','1385876455','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333490666','745444378@qq.com','45e5d53087508a38e58bc2b7c3849981e7fea24a','王亦涵','1','1995-03-18','52262219950318002X','18212288431','52','yPZ9Tnzew8fvOxCzaUe6','3','1385876640','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333479604','1207290932@qq.com','35039a3d61ecd58304144c8579fc6c000dc8489a','王言','2','1995-07-20','110107199507200615','13716458370','11','i3Qr6q1kwksCesBT1Sec','2','1385876803','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333404613','821578073@qq.com','ed4b450849f9d155bf62a9631cc35fe9b1ad6c1e','陈榽曈','1','1997-02-11','500223199702118228','13608171505','51','0hweqHCAbO4OZ5ulb99f','3','1385876993','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333492157','530559013@qq.com','8d0c719963e8471d66d60a84c6cc25943853b8a1','宗楚洁','1','1996-05-02','320106199605021226','13813377877','32','GFnv1LXt8a6IksBOYnx5','2','1385877015','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333434354','418707030@qq.com','2b90580378a4c6c309f9b28994fd88b5f886b6db','王胤力','2','1994-12-26','522101199412263613','13595205548','52','CntVzHc30gfORL8hicpp','4','1385877674','0','1385881177','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333484328','peihuayang@vip.qq.com','b1c5b7789d6bc9a56251900f3916526bc91772f6','裴华阳','2','1995-05-21','320826199505210031','13852493280','32','CJ607gyZPAvcvQikrHSi','1','1385877687','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333470317','804682632@qq.com','6e92d3399373b6d9534dacc5a06558ee24d65a07','蔡鸿江','2','1995-06-24','520113199506242016','13984072243','52','wuZECzr3342nFk5z91n9','2','1385877939','0','1385878391','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333428106','407380123@qq.com','ffaab5bddef9e299940dfdf8a7f1c19bada38825','肖武琴','1','1997-03-25','430321199703250022','15898527747','43','OkmesmOrKU5Fg1IlLOkE','2','1385878149','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333443771','289080886@qq.com','caa6f2bdcea6c4b190d259d48b918c02cd01ec9c','王雨婷','1','1996-04-12','510183199604120028','13668297562','51','vg5k2wQnihBwSULb8OFh','4','1385878499','0','1385880737','10.3.1.20','4','0');
INSERT INTO `ycity_member` VALUES ('1333481262','1336174304@qq.com','21a1b24d5be2842c80d39710c1f94dd8bf155414','屈婧','1','1996-04-16','500103199604166524','15909387043','51','CSO1WkmEcKnxP4TP3tPt','2','1385878530','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333435978','1045139239@qq.com','49db593b2ffc0a6c9d9fb827eab5f8be3507c668','龚祖','1','1995-05-30','340402199505300046','18655486650','34','DDCp1rbjh6sswDdo0bbf','1','1385878549','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333459322','779674390@qq.com','87c1fc018cbd1a40465b8ba05d85f9902de95f7d','李俊潼','2','1995-04-24','210623199504247013','13470065919','21','0tIQfvTUmbvxL5lBT3vO','1','1385878583','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333437544','673853001@qq.com','b4fe637dbdf06acb6c981991e2c11f4a1d2532d7','韩冬','1','1994-10-02','211481199410027822','15242941908','21','IFc918Q6T29NoTBIh8Do','2','1385878924','0','1385880932','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333495320','jr_zyz@sina.com','276f8d5bff3e0f509093757562e7a043fdf68e47','朱文进','1','1996-03-16','321183199603161325','13775381256','32','p3JJSKAhetUtJ7OhJFtQ','2','1385879408','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333468742','690628420@qq.com','596e09b5a4287c913f1aefca0df3d664961a682c','王圣谊','1','1996-02-26','52011219960226004X','15885058097','52','U8tO8SSkogly9Y5w78xV','4','1385879476','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333425043','smile826316232@vip.qq.com','0e08d2453821016c65706278eb881bd46771220e','陈依莲','1','1995-10-24','330481199510242825','15888391711','33','jOM4vlTQ6CAwDspGhsyO','3','1385879651','0','1385882842','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333442188','496356154@qq.com','fac74f0142262042d84503d77ff747efc2736fb4','刘逸璠','2','1995-07-16','610404199507162036','13399207337','61','ykr0Ywm4ebauONwFVSSC','2','1385880050','0','1385880160','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333457874','944587521@qq.com','41cb016a3d8e6215bb834b8088062c79af4d2349','冯钰辉','1','1996-08-20','130429199608203426','18230202781','13','8n6X7qT9EnbSaI2oldJ2','2','1385880353','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333498496','852519395@qq.com','839b782775a5af600deb16c37a0aa0a18f770b1e','王振堂','2','1995-05-03','32082619950503201X','18762713664','32','Un4bZFh55IuriWOYtSd2','4','1385880464','0','1385881947','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333432892','791385271@qq.com','edb7b18dd6ff29a04a342378ebdb49787cc52bc5','王慧','1','1995-07-27','15012419950727276X','18647389908','15','65wZdjrzQAdL4gcmGFS9','4','1385880674','0','1385883772','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333407836','2524106807@qq.com','19854503949c32671c8e218299b9121acf38d1da','田甜','1','1995-10-20','422202199510205722','15072151037','42','s3gqsTERPvqy5u31bRFg','3','1385880829','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333439034','majinchen124@sina.cn','dd03ae42a8185926dd0d8e8e14e7de1a74b4585b','马瑾琛','1','1996-04-06','530426199604060021','15331550412','53','E2YbovTOOODuyNXXA2Lr','4','1385881254','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333417112','2509268406@qq.com','32de76c650eb1dbe8415c2d8425a75b88e216cbe','张欣宇','1','1997-03-07','110111199703070066','13439654808','11','vieFp4mAl3UxzIcL2wUn','3','1385881612','0','1385883040','10.3.1.20','2','0');
INSERT INTO `ycity_member` VALUES ('1333465604','1422840473@qq.com','ddccfca659e70d2b7aa6d587e65e9c26adc41cfc','王静','1','1995-12-14','150121199512147243','13664712011','15','FkXO4NVEpqledbNG1tYU','2','1385882159','0','1385882398','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333446836','370217934@qq.com','02f401238cede6879bad2484c3ed59d6c9eb475d','陈玫羽','1','1996-05-24','520102199605244026','18286069527','52','CmAA9t2XhrPvXn9sFaFA','2','1385882510','0','1385882791','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333412532','2514702665@qq.com','746c2a46d678b21b72f1785e8db5d89016796866','赫铭','1','1995-12-25','210503199512252428','13841445846','21','jmRZ5TvNXBNvwUjAAUJb','1','1385882566','0','1385882875','10.3.1.20','1','0');
INSERT INTO `ycity_member` VALUES ('1333415635','835042237@qq.com','f1765a2fef99fec71968cfa9aa01705ea88d043a','徐莉','1','1995-10-30','320323199510305821','15162266326','32','0GQTz5sZrJTfhB3r9hLf','2','1385882891','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333401545','978814788@qq.com','9fdb60f821ec9a49cac0091ce03b83a87593ff26','吴昊','1','1996-05-14','370902199605142121','15966043925','37','DZRGzhIgi2rffrCBTqEe','2','1385883019','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333421834','506058352@qq.com','2d441e1cea69ea2e1ec4c4c4ac6af26b916f91e9','张桎溢','2','1994-10-11','11010519941011681x','13601015022','11','yWoXh84wyejqZdrvLE3U','1','1385883606','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333445316','847007946@QQ.COM','0a2d84f055d95faa975644b48c79cf37b07748e4','王亦涵','1','1995-03-18','52262219950318002X','18212288431','11','3Ua2M3jY2xLcanu2dXG1','1','1385883634','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333467113','814802700@QQ.COM','0a2d84f055d95faa975644b48c79cf37b07748e4','王亦涵','1','1995-03-18','52262219950318002X','18212288431','52','BGisMQyD405ukputTRjd','3','1385883864','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333473476','346236375@qq.com','c5d1c9e18b0d7c998b1342e7c4b91a61a7170e82','张琳煜','1','1995-11-12','522501199511122420','13885376470','52','zP106yLJn6RMDAsH5lx6','1','1385883949','0','0','0.0.0.0','0','0');
INSERT INTO `ycity_member` VALUES ('1333454613','rose95417@126.com','e191df72ae4c8fbdd3f6b2329895fe4fdf1fd811','刘映辰','1','1995-04-17','11010219950417232x','13601110674','11','FGxCzBM9kTiUu4rFGrHt','1','1385884260','0','0','0.0.0.0','0','0');
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
) ENGINE=MyISAM AUTO_INCREMENT=768 DEFAULT CHARSET=utf8 COMMENT='信息列表';
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
INSERT INTO `ycity_message` VALUES ('18','13','1332382972','1');
INSERT INTO `ycity_message` VALUES ('19','13','1332397662','1');
INSERT INTO `ycity_message` VALUES ('20','13','1332909716','1');
INSERT INTO `ycity_message` VALUES ('21','13','1332929698','1');
INSERT INTO `ycity_message` VALUES ('22','13','1332991610','1');
INSERT INTO `ycity_message` VALUES ('23','13','1333002717','1');
INSERT INTO `ycity_message` VALUES ('24','13','1333003753','1');
INSERT INTO `ycity_message` VALUES ('25','13','1333004444','1');
INSERT INTO `ycity_message` VALUES ('26','13','1333005362','1');
INSERT INTO `ycity_message` VALUES ('27','13','1333009716','1');
INSERT INTO `ycity_message` VALUES ('28','13','1333011426','1');
INSERT INTO `ycity_message` VALUES ('29','13','1333011865','1');
INSERT INTO `ycity_message` VALUES ('30','13','1333012187','1');
INSERT INTO `ycity_message` VALUES ('31','13','1333012558','1');
INSERT INTO `ycity_message` VALUES ('32','13','1333012679','1');
INSERT INTO `ycity_message` VALUES ('33','13','1333015331','1');
INSERT INTO `ycity_message` VALUES ('34','13','1333015695','1');
INSERT INTO `ycity_message` VALUES ('35','13','1333016383','1');
INSERT INTO `ycity_message` VALUES ('36','13','1333018705','1');
INSERT INTO `ycity_message` VALUES ('37','13','1333019839','1');
INSERT INTO `ycity_message` VALUES ('38','13','1333021456','1');
INSERT INTO `ycity_message` VALUES ('39','13','1333023000','1');
INSERT INTO `ycity_message` VALUES ('40','13','1333025211','1');
INSERT INTO `ycity_message` VALUES ('41','13','1333027526','1');
INSERT INTO `ycity_message` VALUES ('42','13','1333029698','1');
INSERT INTO `ycity_message` VALUES ('43','13','1333029877','1');
INSERT INTO `ycity_message` VALUES ('44','13','1333031466','1');
INSERT INTO `ycity_message` VALUES ('45','13','1333031586','1');
INSERT INTO `ycity_message` VALUES ('46','13','1333033276','1');
INSERT INTO `ycity_message` VALUES ('47','13','1333033344','1');
INSERT INTO `ycity_message` VALUES ('48','13','1333033732','1');
INSERT INTO `ycity_message` VALUES ('49','13','1333034281','1');
INSERT INTO `ycity_message` VALUES ('50','13','1333034641','1');
INSERT INTO `ycity_message` VALUES ('51','13','1333035699','1');
INSERT INTO `ycity_message` VALUES ('52','13','1333035808','1');
INSERT INTO `ycity_message` VALUES ('53','13','1333036141','1');
INSERT INTO `ycity_message` VALUES ('54','13','1333037906','1');
INSERT INTO `ycity_message` VALUES ('55','13','1333040938','1');
INSERT INTO `ycity_message` VALUES ('56','13','1333041942','1');
INSERT INTO `ycity_message` VALUES ('57','13','1333043370','1');
INSERT INTO `ycity_message` VALUES ('58','13','1333043611','1');
INSERT INTO `ycity_message` VALUES ('59','13','1333044887','1');
INSERT INTO `ycity_message` VALUES ('60','13','1333051815','1');
INSERT INTO `ycity_message` VALUES ('61','13','1333053605','1');
INSERT INTO `ycity_message` VALUES ('62','13','1333053984','1');
INSERT INTO `ycity_message` VALUES ('63','13','1333056746','1');
INSERT INTO `ycity_message` VALUES ('64','13','1333062551','1');
INSERT INTO `ycity_message` VALUES ('65','13','1333065738','1');
INSERT INTO `ycity_message` VALUES ('66','13','1333066177','1');
INSERT INTO `ycity_message` VALUES ('67','13','1333066642','1');
INSERT INTO `ycity_message` VALUES ('68','13','1333071132','1');
INSERT INTO `ycity_message` VALUES ('69','13','1333071395','1');
INSERT INTO `ycity_message` VALUES ('70','13','1333072894','1');
INSERT INTO `ycity_message` VALUES ('71','13','1333074271','1');
INSERT INTO `ycity_message` VALUES ('72','13','1333076653','1');
INSERT INTO `ycity_message` VALUES ('73','13','1333076726','1');
INSERT INTO `ycity_message` VALUES ('74','13','1333077360','1');
INSERT INTO `ycity_message` VALUES ('75','13','1333078426','1');
INSERT INTO `ycity_message` VALUES ('76','13','1333083296','1');
INSERT INTO `ycity_message` VALUES ('77','13','1333086634','1');
INSERT INTO `ycity_message` VALUES ('78','13','1333088306','1');
INSERT INTO `ycity_message` VALUES ('79','13','1333091610','1');
INSERT INTO `ycity_message` VALUES ('80','13','1333092917','1');
INSERT INTO `ycity_message` VALUES ('81','13','1333094013','1');
INSERT INTO `ycity_message` VALUES ('82','13','1333096212','1');
INSERT INTO `ycity_message` VALUES ('83','13','1333096485','1');
INSERT INTO `ycity_message` VALUES ('84','13','1333098443','1');
INSERT INTO `ycity_message` VALUES ('85','13','1333100045','1');
INSERT INTO `ycity_message` VALUES ('86','13','1333101516','1');
INSERT INTO `ycity_message` VALUES ('87','13','1333102717','1');
INSERT INTO `ycity_message` VALUES ('88','13','1333103113','1');
INSERT INTO `ycity_message` VALUES ('89','13','1333103228','1');
INSERT INTO `ycity_message` VALUES ('90','13','1333103753','1');
INSERT INTO `ycity_message` VALUES ('91','13','1333104444','1');
INSERT INTO `ycity_message` VALUES ('92','13','1333104666','1');
INSERT INTO `ycity_message` VALUES ('93','13','1333105362','1');
INSERT INTO `ycity_message` VALUES ('94','13','1333106236','1');
INSERT INTO `ycity_message` VALUES ('95','13','1333107823','1');
INSERT INTO `ycity_message` VALUES ('96','13','1333109310','1');
INSERT INTO `ycity_message` VALUES ('97','13','1333110932','1');
INSERT INTO `ycity_message` VALUES ('98','13','1333111426','1');
INSERT INTO `ycity_message` VALUES ('99','13','1333111865','1');
INSERT INTO `ycity_message` VALUES ('100','13','1333112187','1');
INSERT INTO `ycity_message` VALUES ('101','13','1333112541','1');
INSERT INTO `ycity_message` VALUES ('102','13','1333112558','1');
INSERT INTO `ycity_message` VALUES ('103','13','1333112679','1');
INSERT INTO `ycity_message` VALUES ('104','13','1333114035','1');
INSERT INTO `ycity_message` VALUES ('105','13','1333115331','1');
INSERT INTO `ycity_message` VALUES ('106','13','1333115612','1');
INSERT INTO `ycity_message` VALUES ('107','13','1333115695','1');
INSERT INTO `ycity_message` VALUES ('108','13','1333116383','1');
INSERT INTO `ycity_message` VALUES ('109','13','1333117194','1');
INSERT INTO `ycity_message` VALUES ('110','13','1333118705','1');
INSERT INTO `ycity_message` VALUES ('111','13','1333118736','1');
INSERT INTO `ycity_message` VALUES ('112','13','1333119839','1');
INSERT INTO `ycity_message` VALUES ('113','13','1333120014','1');
INSERT INTO `ycity_message` VALUES ('114','13','1333120334','1');
INSERT INTO `ycity_message` VALUES ('115','13','1333121456','1');
INSERT INTO `ycity_message` VALUES ('116','13','1333121812','1');
INSERT INTO `ycity_message` VALUES ('117','13','1333123000','1');
INSERT INTO `ycity_message` VALUES ('118','13','1333123443','1');
INSERT INTO `ycity_message` VALUES ('119','13','1333125076','1');
INSERT INTO `ycity_message` VALUES ('120','13','1333125211','1');
INSERT INTO `ycity_message` VALUES ('121','13','1333126506','1');
INSERT INTO `ycity_message` VALUES ('122','13','1333127526','1');
INSERT INTO `ycity_message` VALUES ('123','13','1333128186','1');
INSERT INTO `ycity_message` VALUES ('124','13','1333129698','1');
INSERT INTO `ycity_message` VALUES ('125','13','1333129877','1');
INSERT INTO `ycity_message` VALUES ('126','13','1333131292','1');
INSERT INTO `ycity_message` VALUES ('127','13','1333131466','1');
INSERT INTO `ycity_message` VALUES ('128','13','1333131586','1');
INSERT INTO `ycity_message` VALUES ('129','13','1333132854','1');
INSERT INTO `ycity_message` VALUES ('130','13','1333133276','1');
INSERT INTO `ycity_message` VALUES ('131','13','1333133344','1');
INSERT INTO `ycity_message` VALUES ('132','13','1333133732','1');
INSERT INTO `ycity_message` VALUES ('133','13','1333134281','1');
INSERT INTO `ycity_message` VALUES ('134','13','1333134378','1');
INSERT INTO `ycity_message` VALUES ('135','13','1333134641','1');
INSERT INTO `ycity_message` VALUES ('136','13','1333135699','1');
INSERT INTO `ycity_message` VALUES ('137','13','1333135808','1');
INSERT INTO `ycity_message` VALUES ('138','13','1333135944','1');
INSERT INTO `ycity_message` VALUES ('139','13','1333136141','1');
INSERT INTO `ycity_message` VALUES ('140','13','1333137534','1');
INSERT INTO `ycity_message` VALUES ('141','13','1333137906','1');
INSERT INTO `ycity_message` VALUES ('142','13','1333139073','1');
INSERT INTO `ycity_message` VALUES ('143','13','1333140688','1');
INSERT INTO `ycity_message` VALUES ('144','13','1333140938','1');
INSERT INTO `ycity_message` VALUES ('145','13','1333141942','1');
INSERT INTO `ycity_message` VALUES ('146','13','1333142171','1');
INSERT INTO `ycity_message` VALUES ('147','13','1333143370','1');
INSERT INTO `ycity_message` VALUES ('148','13','1333143611','1');
INSERT INTO `ycity_message` VALUES ('149','13','1333143716','1');
INSERT INTO `ycity_message` VALUES ('150','13','1333144887','1');
INSERT INTO `ycity_message` VALUES ('151','13','1333145336','1');
INSERT INTO `ycity_message` VALUES ('152','13','1333146896','1');
INSERT INTO `ycity_message` VALUES ('153','13','1333148405','1');
INSERT INTO `ycity_message` VALUES ('154','13','1333150005','1');
INSERT INTO `ycity_message` VALUES ('155','13','1333150071','1');
INSERT INTO `ycity_message` VALUES ('156','13','1333151583','1');
INSERT INTO `ycity_message` VALUES ('157','13','1333151815','1');
INSERT INTO `ycity_message` VALUES ('158','13','1333153113','1');
INSERT INTO `ycity_message` VALUES ('159','13','1333153605','1');
INSERT INTO `ycity_message` VALUES ('160','13','1333153984','1');
INSERT INTO `ycity_message` VALUES ('161','13','1333154666','1');
INSERT INTO `ycity_message` VALUES ('162','13','1333156274','1');
INSERT INTO `ycity_message` VALUES ('163','13','1333156746','1');
INSERT INTO `ycity_message` VALUES ('164','13','1333157822','1');
INSERT INTO `ycity_message` VALUES ('165','13','1333157874','1');
INSERT INTO `ycity_message` VALUES ('166','13','1333159319','1');
INSERT INTO `ycity_message` VALUES ('167','13','1333160903','1');
INSERT INTO `ycity_message` VALUES ('168','13','1333162551','1');
INSERT INTO `ycity_message` VALUES ('169','13','1333162554','1');
INSERT INTO `ycity_message` VALUES ('170','13','1333164004','1');
INSERT INTO `ycity_message` VALUES ('171','13','1333165613','1');
INSERT INTO `ycity_message` VALUES ('172','13','1333165738','1');
INSERT INTO `ycity_message` VALUES ('173','13','1333166177','1');
INSERT INTO `ycity_message` VALUES ('174','13','1333166642','1');
INSERT INTO `ycity_message` VALUES ('175','13','1333167142','1');
INSERT INTO `ycity_message` VALUES ('176','13','1333168717','1');
INSERT INTO `ycity_message` VALUES ('177','13','1333170332','1');
INSERT INTO `ycity_message` VALUES ('178','13','1333171132','1');
INSERT INTO `ycity_message` VALUES ('179','13','1333171395','1');
INSERT INTO `ycity_message` VALUES ('180','13','1333171876','1');
INSERT INTO `ycity_message` VALUES ('181','13','1333172894','1');
INSERT INTO `ycity_message` VALUES ('182','13','1333173438','1');
INSERT INTO `ycity_message` VALUES ('183','13','1333174271','1');
INSERT INTO `ycity_message` VALUES ('184','13','1333175077','1');
INSERT INTO `ycity_message` VALUES ('185','13','1333176520','1');
INSERT INTO `ycity_message` VALUES ('186','13','1333176653','1');
INSERT INTO `ycity_message` VALUES ('187','13','1333176726','1');
INSERT INTO `ycity_message` VALUES ('188','13','1333177360','1');
INSERT INTO `ycity_message` VALUES ('189','13','1333178104','1');
INSERT INTO `ycity_message` VALUES ('190','13','1333178426','1');
INSERT INTO `ycity_message` VALUES ('191','13','1333179662','1');
INSERT INTO `ycity_message` VALUES ('192','13','1333181291','1');
INSERT INTO `ycity_message` VALUES ('193','13','1333182828','1');
INSERT INTO `ycity_message` VALUES ('194','13','1333183296','1');
INSERT INTO `ycity_message` VALUES ('195','13','1333184398','1');
INSERT INTO `ycity_message` VALUES ('196','13','1333185934','1');
INSERT INTO `ycity_message` VALUES ('197','13','1333186634','1');
INSERT INTO `ycity_message` VALUES ('198','13','1333187525','1');
INSERT INTO `ycity_message` VALUES ('199','13','1333188306','1');
INSERT INTO `ycity_message` VALUES ('200','13','1333189066','1');
INSERT INTO `ycity_message` VALUES ('201','13','1333190657','1');
INSERT INTO `ycity_message` VALUES ('202','13','1333191610','1');
INSERT INTO `ycity_message` VALUES ('203','13','1333192917','1');
INSERT INTO `ycity_message` VALUES ('204','13','1333192989','1');
INSERT INTO `ycity_message` VALUES ('205','13','1333193720','1');
INSERT INTO `ycity_message` VALUES ('206','13','1333194013','1');
INSERT INTO `ycity_message` VALUES ('207','13','1333195330','1');
INSERT INTO `ycity_message` VALUES ('208','13','1333196212','1');
INSERT INTO `ycity_message` VALUES ('209','13','1333196485','1');
INSERT INTO `ycity_message` VALUES ('210','13','1333196896','1');
INSERT INTO `ycity_message` VALUES ('211','13','1333198443','1');
INSERT INTO `ycity_message` VALUES ('212','13','1333198452','1');
INSERT INTO `ycity_message` VALUES ('213','13','1333200030','1');
INSERT INTO `ycity_message` VALUES ('214','13','1333200045','1');
INSERT INTO `ycity_message` VALUES ('215','13','1333200052','1');
INSERT INTO `ycity_message` VALUES ('216','13','1333201516','1');
INSERT INTO `ycity_message` VALUES ('217','13','1333201545','1');
INSERT INTO `ycity_message` VALUES ('218','13','1333201552','1');
INSERT INTO `ycity_message` VALUES ('219','13','1333203113','1');
INSERT INTO `ycity_message` VALUES ('220','13','1333203116','1');
INSERT INTO `ycity_message` VALUES ('221','13','1333204613','1');
INSERT INTO `ycity_message` VALUES ('222','13','1333204666','1');
INSERT INTO `ycity_message` VALUES ('223','13','1333206213','1');
INSERT INTO `ycity_message` VALUES ('224','13','1333206236','1');
INSERT INTO `ycity_message` VALUES ('225','13','1333206266','1');
INSERT INTO `ycity_message` VALUES ('226','13','1333207823','1');
INSERT INTO `ycity_message` VALUES ('227','13','1333207836','1');
INSERT INTO `ycity_message` VALUES ('228','13','1333209310','1');
INSERT INTO `ycity_message` VALUES ('229','13','1333209319','1');
INSERT INTO `ycity_message` VALUES ('230','13','1333209323','1');
INSERT INTO `ycity_message` VALUES ('231','13','1333210910','1');
INSERT INTO `ycity_message` VALUES ('232','13','1333210913','1');
INSERT INTO `ycity_message` VALUES ('233','13','1333210923','1');
INSERT INTO `ycity_message` VALUES ('234','13','1333210932','1');
INSERT INTO `ycity_message` VALUES ('235','13','1333212510','1');
INSERT INTO `ycity_message` VALUES ('236','13','1333212532','1');
INSERT INTO `ycity_message` VALUES ('237','13','1333212541','1');
INSERT INTO `ycity_message` VALUES ('238','13','1333214023','1');
INSERT INTO `ycity_message` VALUES ('239','13','1333214025','1');
INSERT INTO `ycity_message` VALUES ('240','13','1333214035','1');
INSERT INTO `ycity_message` VALUES ('241','13','1333214041','1');
INSERT INTO `ycity_message` VALUES ('242','13','1333215612','1');
INSERT INTO `ycity_message` VALUES ('243','13','1333215635','1');
INSERT INTO `ycity_message` VALUES ('244','13','1333215641','1');
INSERT INTO `ycity_message` VALUES ('245','13','1333217112','1');
INSERT INTO `ycity_message` VALUES ('246','13','1333217120','1');
INSERT INTO `ycity_message` VALUES ('247','13','1333217135','1');
INSERT INTO `ycity_message` VALUES ('248','13','1333217141','1');
INSERT INTO `ycity_message` VALUES ('249','13','1333217194','1');
INSERT INTO `ycity_message` VALUES ('250','13','1333218712','1');
INSERT INTO `ycity_message` VALUES ('251','13','1333218736','1');
INSERT INTO `ycity_message` VALUES ('252','13','1333218741','1');
INSERT INTO `ycity_message` VALUES ('253','13','1333218794','1');
INSERT INTO `ycity_message` VALUES ('254','13','1333220312','1');
INSERT INTO `ycity_message` VALUES ('255','13','1333220334','1');
INSERT INTO `ycity_message` VALUES ('256','13','1333220336','1');
INSERT INTO `ycity_message` VALUES ('257','13','1333220394','1');
INSERT INTO `ycity_message` VALUES ('258','13','1333221812','1');
INSERT INTO `ycity_message` VALUES ('259','13','1333221834','1');
INSERT INTO `ycity_message` VALUES ('260','13','1333221836','1');
INSERT INTO `ycity_message` VALUES ('261','13','1333223412','1');
INSERT INTO `ycity_message` VALUES ('262','13','1333223434','1');
INSERT INTO `ycity_message` VALUES ('263','13','1333223443','1');
INSERT INTO `ycity_message` VALUES ('264','13','1333225012','1');
INSERT INTO `ycity_message` VALUES ('265','13','1333225043','1');
INSERT INTO `ycity_message` VALUES ('266','13','1333225076','1');
INSERT INTO `ycity_message` VALUES ('267','13','1333226506','1');
INSERT INTO `ycity_message` VALUES ('268','13','1333226543','1');
INSERT INTO `ycity_message` VALUES ('269','13','1333226576','1');
INSERT INTO `ycity_message` VALUES ('270','13','1333228106','1');
INSERT INTO `ycity_message` VALUES ('271','13','1333228143','1');
INSERT INTO `ycity_message` VALUES ('272','13','1333228186','1');
INSERT INTO `ycity_message` VALUES ('273','13','1333229633','1');
INSERT INTO `ycity_message` VALUES ('274','13','1333229686','1');
INSERT INTO `ycity_message` VALUES ('275','13','1333231233','1');
INSERT INTO `ycity_message` VALUES ('276','13','1333231286','1');
INSERT INTO `ycity_message` VALUES ('277','13','1333231292','1');
INSERT INTO `ycity_message` VALUES ('278','13','1333232833','1');
INSERT INTO `ycity_message` VALUES ('279','13','1333232854','1');
INSERT INTO `ycity_message` VALUES ('280','13','1333232892','1');
INSERT INTO `ycity_message` VALUES ('281','13','1333234354','1');
INSERT INTO `ycity_message` VALUES ('282','13','1333234378','1');
INSERT INTO `ycity_message` VALUES ('283','13','1333234392','1');
INSERT INTO `ycity_message` VALUES ('284','13','1333235933','1');
INSERT INTO `ycity_message` VALUES ('285','13','1333235944','1');
INSERT INTO `ycity_message` VALUES ('286','13','1333235978','1');
INSERT INTO `ycity_message` VALUES ('287','13','1333237534','1');
INSERT INTO `ycity_message` VALUES ('288','13','1333237544','1');
INSERT INTO `ycity_message` VALUES ('289','13','1333239034','1');
INSERT INTO `ycity_message` VALUES ('290','13','1333239044','1');
INSERT INTO `ycity_message` VALUES ('291','13','1333239073','1');
INSERT INTO `ycity_message` VALUES ('292','13','1333240633','1');
INSERT INTO `ycity_message` VALUES ('293','13','1333240641','1');
INSERT INTO `ycity_message` VALUES ('294','13','1333240673','1');
INSERT INTO `ycity_message` VALUES ('295','13','1333240678','1');
INSERT INTO `ycity_message` VALUES ('296','13','1333240688','1');
INSERT INTO `ycity_message` VALUES ('297','13','1333242133','1');
INSERT INTO `ycity_message` VALUES ('298','13','1333242134','1');
INSERT INTO `ycity_message` VALUES ('299','13','1333242171','1');
INSERT INTO `ycity_message` VALUES ('300','13','1333242173','1');
INSERT INTO `ycity_message` VALUES ('301','13','1333242188','1');
INSERT INTO `ycity_message` VALUES ('302','13','1333243716','1');
INSERT INTO `ycity_message` VALUES ('303','13','1333243743','1');
INSERT INTO `ycity_message` VALUES ('304','13','1333243771','1');
INSERT INTO `ycity_message` VALUES ('305','13','1333243788','1');
INSERT INTO `ycity_message` VALUES ('306','13','1333245316','1');
INSERT INTO `ycity_message` VALUES ('307','13','1333245333','1');
INSERT INTO `ycity_message` VALUES ('308','13','1333245336','1');
INSERT INTO `ycity_message` VALUES ('309','13','1333245371','1');
INSERT INTO `ycity_message` VALUES ('310','13','1333246836','1');
INSERT INTO `ycity_message` VALUES ('311','13','1333246871','1');
INSERT INTO `ycity_message` VALUES ('312','13','1333246896','1');
INSERT INTO `ycity_message` VALUES ('313','13','1333248405','1');
INSERT INTO `ycity_message` VALUES ('314','13','1333248432','1');
INSERT INTO `ycity_message` VALUES ('315','13','1333248436','1');
INSERT INTO `ycity_message` VALUES ('316','13','1333248496','1');
INSERT INTO `ycity_message` VALUES ('317','13','1333250005','1');
INSERT INTO `ycity_message` VALUES ('318','13','1333250036','1');
INSERT INTO `ycity_message` VALUES ('319','13','1333250071','1');
INSERT INTO `ycity_message` VALUES ('320','13','1333251505','1');
INSERT INTO `ycity_message` VALUES ('321','13','1333251533','1');
INSERT INTO `ycity_message` VALUES ('322','13','1333251536','1');
INSERT INTO `ycity_message` VALUES ('323','13','1333251571','1');
INSERT INTO `ycity_message` VALUES ('324','13','1333251583','1');
INSERT INTO `ycity_message` VALUES ('325','13','1333251596','1');
INSERT INTO `ycity_message` VALUES ('326','13','1333253113','1');
INSERT INTO `ycity_message` VALUES ('327','13','1333253133','1');
INSERT INTO `ycity_message` VALUES ('328','13','1333253183','1');
INSERT INTO `ycity_message` VALUES ('329','13','1333254613','1');
INSERT INTO `ycity_message` VALUES ('330','13','1333254666','1');
INSERT INTO `ycity_message` VALUES ('331','13','1333254683','1');
INSERT INTO `ycity_message` VALUES ('332','13','1333256213','1');
INSERT INTO `ycity_message` VALUES ('333','13','1333256266','1');
INSERT INTO `ycity_message` VALUES ('334','13','1333256274','1');
INSERT INTO `ycity_message` VALUES ('335','13','1333257822','1');
INSERT INTO `ycity_message` VALUES ('336','13','1333257866','1');
INSERT INTO `ycity_message` VALUES ('337','13','1333257874','1');
INSERT INTO `ycity_message` VALUES ('338','13','1333259306','1');
INSERT INTO `ycity_message` VALUES ('339','13','1333259319','1');
INSERT INTO `ycity_message` VALUES ('340','13','1333259322','1');
INSERT INTO `ycity_message` VALUES ('341','13','1333259366','1');
INSERT INTO `ycity_message` VALUES ('342','13','1333259374','1');
INSERT INTO `ycity_message` VALUES ('343','13','1333260903','1');
INSERT INTO `ycity_message` VALUES ('344','13','1333260919','1');
INSERT INTO `ycity_message` VALUES ('345','13','1333262503','1');
INSERT INTO `ycity_message` VALUES ('346','13','1333262522','1');
INSERT INTO `ycity_message` VALUES ('347','13','1333262554','1');
INSERT INTO `ycity_message` VALUES ('348','13','1333264003','1');
INSERT INTO `ycity_message` VALUES ('349','13','1333264004','1');
INSERT INTO `ycity_message` VALUES ('350','13','1333264036','1');
INSERT INTO `ycity_message` VALUES ('351','13','1333264054','1');
INSERT INTO `ycity_message` VALUES ('352','13','1333265603','1');
INSERT INTO `ycity_message` VALUES ('353','13','1333265604','1');
INSERT INTO `ycity_message` VALUES ('354','13','1333265613','1');
INSERT INTO `ycity_message` VALUES ('355','13','1333265654','1');
INSERT INTO `ycity_message` VALUES ('356','13','1333267113','1');
INSERT INTO `ycity_message` VALUES ('357','13','1333267142','1');
INSERT INTO `ycity_message` VALUES ('358','13','1333267143','1');
INSERT INTO `ycity_message` VALUES ('359','13','1333267198','1');
INSERT INTO `ycity_message` VALUES ('360','13','1333268717','1');
INSERT INTO `ycity_message` VALUES ('361','13','1333268733','1');
INSERT INTO `ycity_message` VALUES ('362','13','1333268742','1');
INSERT INTO `ycity_message` VALUES ('363','13','1333270317','1');
INSERT INTO `ycity_message` VALUES ('364','13','1333270332','1');
INSERT INTO `ycity_message` VALUES ('365','13','1333271817','1');
INSERT INTO `ycity_message` VALUES ('366','13','1333271832','1');
INSERT INTO `ycity_message` VALUES ('367','13','1333271833','1');
INSERT INTO `ycity_message` VALUES ('368','13','1333271842','1');
INSERT INTO `ycity_message` VALUES ('369','13','1333271876','1');
INSERT INTO `ycity_message` VALUES ('370','13','1333273432','1');
INSERT INTO `ycity_message` VALUES ('371','13','1333273438','1');
INSERT INTO `ycity_message` VALUES ('372','13','1333273442','1');
INSERT INTO `ycity_message` VALUES ('373','13','1333273471','1');
INSERT INTO `ycity_message` VALUES ('374','13','1333273476','1');
INSERT INTO `ycity_message` VALUES ('375','13','1333275032','1');
INSERT INTO `ycity_message` VALUES ('376','13','1333275038','1');
INSERT INTO `ycity_message` VALUES ('377','13','1333275076','1');
INSERT INTO `ycity_message` VALUES ('378','13','1333275077','1');
INSERT INTO `ycity_message` VALUES ('379','13','1333276520','1');
INSERT INTO `ycity_message` VALUES ('380','13','1333276576','1');
INSERT INTO `ycity_message` VALUES ('381','13','1333276577','1');
INSERT INTO `ycity_message` VALUES ('382','13','1333278104','1');
INSERT INTO `ycity_message` VALUES ('383','13','1333278120','1');
INSERT INTO `ycity_message` VALUES ('384','13','1333278177','1');
INSERT INTO `ycity_message` VALUES ('385','13','1333279604','1');
INSERT INTO `ycity_message` VALUES ('386','13','1333279662','1');
INSERT INTO `ycity_message` VALUES ('387','13','1333281262','1');
INSERT INTO `ycity_message` VALUES ('388','13','1333281291','1');
INSERT INTO `ycity_message` VALUES ('389','13','1333282828','1');
INSERT INTO `ycity_message` VALUES ('390','13','1333282891','1');
INSERT INTO `ycity_message` VALUES ('391','13','1333284328','1');
INSERT INTO `ycity_message` VALUES ('392','13','1333284398','1');
INSERT INTO `ycity_message` VALUES ('393','13','1333285934','1');
INSERT INTO `ycity_message` VALUES ('394','13','1333285998','1');
INSERT INTO `ycity_message` VALUES ('395','13','1333287525','1');
INSERT INTO `ycity_message` VALUES ('396','13','1333287528','1');
INSERT INTO `ycity_message` VALUES ('397','13','1333287534','1');
INSERT INTO `ycity_message` VALUES ('398','13','1333287577','1');
INSERT INTO `ycity_message` VALUES ('399','13','1333287598','1');
INSERT INTO `ycity_message` VALUES ('400','13','1333289025','1');
INSERT INTO `ycity_message` VALUES ('401','13','1333289034','1');
INSERT INTO `ycity_message` VALUES ('402','13','1333289066','1');
INSERT INTO `ycity_message` VALUES ('403','13','1333290625','1');
INSERT INTO `ycity_message` VALUES ('404','13','1333290657','1');
INSERT INTO `ycity_message` VALUES ('405','13','1333290666','1');
INSERT INTO `ycity_message` VALUES ('406','13','1333292130','1');
INSERT INTO `ycity_message` VALUES ('407','13','1333292157','1');
INSERT INTO `ycity_message` VALUES ('408','13','1333292166','1');
INSERT INTO `ycity_message` VALUES ('409','13','1333293720','1');
INSERT INTO `ycity_message` VALUES ('410','13','1333293730','1');
INSERT INTO `ycity_message` VALUES ('411','13','1333293766','1');
INSERT INTO `ycity_message` VALUES ('412','13','1333295320','1');
INSERT INTO `ycity_message` VALUES ('413','13','1333295330','1');
INSERT INTO `ycity_message` VALUES ('414','13','1333296820','1');
INSERT INTO `ycity_message` VALUES ('415','13','1333296830','1');
INSERT INTO `ycity_message` VALUES ('416','13','1333296857','1');
INSERT INTO `ycity_message` VALUES ('417','13','1333296896','1');
INSERT INTO `ycity_message` VALUES ('418','13','1333298430','1');
INSERT INTO `ycity_message` VALUES ('419','13','1333298452','1');
INSERT INTO `ycity_message` VALUES ('420','13','1333298496','1');
INSERT INTO `ycity_message` VALUES ('421','13','1333300013','1');
INSERT INTO `ycity_message` VALUES ('422','13','1333300045','1');
INSERT INTO `ycity_message` VALUES ('423','13','1333300052','1');
INSERT INTO `ycity_message` VALUES ('424','13','1333301516','1');
INSERT INTO `ycity_message` VALUES ('425','13','1333301545','1');
INSERT INTO `ycity_message` VALUES ('426','13','1333301596','1');
INSERT INTO `ycity_message` VALUES ('427','13','1333303113','1');
INSERT INTO `ycity_message` VALUES ('428','13','1333303116','1');
INSERT INTO `ycity_message` VALUES ('429','13','1333304613','1');
INSERT INTO `ycity_message` VALUES ('430','13','1333304616','1');
INSERT INTO `ycity_message` VALUES ('431','13','1333304666','1');
INSERT INTO `ycity_message` VALUES ('432','13','1333306236','1');
INSERT INTO `ycity_message` VALUES ('433','13','1333306266','1');
INSERT INTO `ycity_message` VALUES ('434','13','1333307823','1');
INSERT INTO `ycity_message` VALUES ('435','13','1333307836','1');
INSERT INTO `ycity_message` VALUES ('436','13','1333307866','1');
INSERT INTO `ycity_message` VALUES ('437','13','1333309310','1');
INSERT INTO `ycity_message` VALUES ('438','13','1333309323','1');
INSERT INTO `ycity_message` VALUES ('439','13','1333309366','1');
INSERT INTO `ycity_message` VALUES ('440','13','1333310910','1');
INSERT INTO `ycity_message` VALUES ('441','13','1333310916','1');
INSERT INTO `ycity_message` VALUES ('442','13','1333310932','1');
INSERT INTO `ycity_message` VALUES ('443','13','1333310966','1');
INSERT INTO `ycity_message` VALUES ('444','13','1333312510','1');
INSERT INTO `ycity_message` VALUES ('445','13','1333312532','1');
INSERT INTO `ycity_message` VALUES ('446','13','1333312541','1');
INSERT INTO `ycity_message` VALUES ('447','13','1333314010','1');
INSERT INTO `ycity_message` VALUES ('448','13','1333314032','1');
INSERT INTO `ycity_message` VALUES ('449','13','1333314035','1');
INSERT INTO `ycity_message` VALUES ('450','13','1333314041','1');
INSERT INTO `ycity_message` VALUES ('451','13','1333315612','1');
INSERT INTO `ycity_message` VALUES ('452','13','1333315632','1');
INSERT INTO `ycity_message` VALUES ('453','13','1333315635','1');
INSERT INTO `ycity_message` VALUES ('454','13','1333315641','1');
INSERT INTO `ycity_message` VALUES ('455','13','1333317112','1');
INSERT INTO `ycity_message` VALUES ('456','13','1333317130','1');
INSERT INTO `ycity_message` VALUES ('457','13','1333317132','1');
INSERT INTO `ycity_message` VALUES ('458','13','1333317135','1');
INSERT INTO `ycity_message` VALUES ('459','13','1333317194','1');
INSERT INTO `ycity_message` VALUES ('460','13','1333318712','1');
INSERT INTO `ycity_message` VALUES ('461','13','1333318730','1');
INSERT INTO `ycity_message` VALUES ('462','13','1333318736','1');
INSERT INTO `ycity_message` VALUES ('463','13','1333318794','1');
INSERT INTO `ycity_message` VALUES ('464','13','1333320334','1');
INSERT INTO `ycity_message` VALUES ('465','13','1333320336','1');
INSERT INTO `ycity_message` VALUES ('466','13','1333320396','1');
INSERT INTO `ycity_message` VALUES ('467','13','1333321812','1');
INSERT INTO `ycity_message` VALUES ('468','13','1333321834','1');
INSERT INTO `ycity_message` VALUES ('469','13','1333321836','1');
INSERT INTO `ycity_message` VALUES ('470','13','1333321896','1');
INSERT INTO `ycity_message` VALUES ('471','13','1333323412','1');
INSERT INTO `ycity_message` VALUES ('472','13','1333323434','1');
INSERT INTO `ycity_message` VALUES ('473','13','1333323443','1');
INSERT INTO `ycity_message` VALUES ('474','13','1333325012','1');
INSERT INTO `ycity_message` VALUES ('475','13','1333325043','1');
INSERT INTO `ycity_message` VALUES ('476','13','1333325076','1');
INSERT INTO `ycity_message` VALUES ('477','13','1333326506','1');
INSERT INTO `ycity_message` VALUES ('478','13','1333326512','1');
INSERT INTO `ycity_message` VALUES ('479','13','1333326543','1');
INSERT INTO `ycity_message` VALUES ('480','13','1333326576','1');
INSERT INTO `ycity_message` VALUES ('481','13','1333328106','1');
INSERT INTO `ycity_message` VALUES ('482','13','1333328176','1');
INSERT INTO `ycity_message` VALUES ('483','13','1333328186','1');
INSERT INTO `ycity_message` VALUES ('484','13','1333329606','1');
INSERT INTO `ycity_message` VALUES ('485','13','1333329610','1');
INSERT INTO `ycity_message` VALUES ('486','13','1333329633','1');
INSERT INTO `ycity_message` VALUES ('487','13','1333329636','1');
INSERT INTO `ycity_message` VALUES ('488','13','1333329686','1');
INSERT INTO `ycity_message` VALUES ('489','13','1333331210','1');
INSERT INTO `ycity_message` VALUES ('490','13','1333331233','1');
INSERT INTO `ycity_message` VALUES ('491','13','1333331286','1');
INSERT INTO `ycity_message` VALUES ('492','13','1333331292','1');
INSERT INTO `ycity_message` VALUES ('493','13','1333332810','1');
INSERT INTO `ycity_message` VALUES ('494','13','1333332833','1');
INSERT INTO `ycity_message` VALUES ('495','13','1333332854','1');
INSERT INTO `ycity_message` VALUES ('496','13','1333332892','1');
INSERT INTO `ycity_message` VALUES ('497','13','1333334310','1');
INSERT INTO `ycity_message` VALUES ('498','13','1333334332','1');
INSERT INTO `ycity_message` VALUES ('499','13','1333334354','1');
INSERT INTO `ycity_message` VALUES ('500','13','1333334378','1');
INSERT INTO `ycity_message` VALUES ('501','13','1333334392','1');
INSERT INTO `ycity_message` VALUES ('502','13','1333335910','1');
INSERT INTO `ycity_message` VALUES ('503','13','1333335944','1');
INSERT INTO `ycity_message` VALUES ('504','13','1333335954','1');
INSERT INTO `ycity_message` VALUES ('505','13','1333335978','1');
INSERT INTO `ycity_message` VALUES ('506','13','1333335992','1');
INSERT INTO `ycity_message` VALUES ('507','13','1333337534','1');
INSERT INTO `ycity_message` VALUES ('508','13','1333337535','1');
INSERT INTO `ycity_message` VALUES ('509','13','1333337544','1');
INSERT INTO `ycity_message` VALUES ('510','13','1333337578','1');
INSERT INTO `ycity_message` VALUES ('511','13','1333339012','1');
INSERT INTO `ycity_message` VALUES ('512','13','1333339034','1');
INSERT INTO `ycity_message` VALUES ('513','13','1333339073','1');
INSERT INTO `ycity_message` VALUES ('514','13','1333339078','1');
INSERT INTO `ycity_message` VALUES ('515','13','1333340634','1');
INSERT INTO `ycity_message` VALUES ('516','13','1333340673','1');
INSERT INTO `ycity_message` VALUES ('517','13','1333340688','1');
INSERT INTO `ycity_message` VALUES ('518','13','1333342134','1');
INSERT INTO `ycity_message` VALUES ('519','13','1333342171','1');
INSERT INTO `ycity_message` VALUES ('520','13','1333342173','1');
INSERT INTO `ycity_message` VALUES ('521','13','1333342188','1');
INSERT INTO `ycity_message` VALUES ('522','13','1333342191','1');
INSERT INTO `ycity_message` VALUES ('523','13','1333343716','1');
INSERT INTO `ycity_message` VALUES ('524','13','1333343771','1');
INSERT INTO `ycity_message` VALUES ('525','13','1333343773','1');
INSERT INTO `ycity_message` VALUES ('526','13','1333345316','1');
INSERT INTO `ycity_message` VALUES ('527','13','1333345336','1');
INSERT INTO `ycity_message` VALUES ('528','13','1333345371','1');
INSERT INTO `ycity_message` VALUES ('529','13','1333346836','1');
INSERT INTO `ycity_message` VALUES ('530','13','1333346871','1');
INSERT INTO `ycity_message` VALUES ('531','13','1333346896','1');
INSERT INTO `ycity_message` VALUES ('532','13','1333348405','1');
INSERT INTO `ycity_message` VALUES ('533','13','1333348476','1');
INSERT INTO `ycity_message` VALUES ('534','13','1333348496','1');
INSERT INTO `ycity_message` VALUES ('535','13','1333350005','1');
INSERT INTO `ycity_message` VALUES ('536','13','1333350016','1');
INSERT INTO `ycity_message` VALUES ('537','13','1333350071','1');
INSERT INTO `ycity_message` VALUES ('538','13','1333351505','1');
INSERT INTO `ycity_message` VALUES ('539','13','1333351571','1');
INSERT INTO `ycity_message` VALUES ('540','13','1333351583','1');
INSERT INTO `ycity_message` VALUES ('541','13','1333351586','1');
INSERT INTO `ycity_message` VALUES ('542','13','1333353105','1');
INSERT INTO `ycity_message` VALUES ('543','13','1333353113','1');
INSERT INTO `ycity_message` VALUES ('544','13','1333353133','1');
INSERT INTO `ycity_message` VALUES ('545','13','1333353171','1');
INSERT INTO `ycity_message` VALUES ('546','13','1333353183','1');
INSERT INTO `ycity_message` VALUES ('547','13','1333354613','1');
INSERT INTO `ycity_message` VALUES ('548','13','1333354666','1');
INSERT INTO `ycity_message` VALUES ('549','13','1333354683','1');
INSERT INTO `ycity_message` VALUES ('550','13','1333354692','1');
INSERT INTO `ycity_message` VALUES ('551','13','1333356213','1');
INSERT INTO `ycity_message` VALUES ('552','13','1333356266','1');
INSERT INTO `ycity_message` VALUES ('553','13','1333356274','1');
INSERT INTO `ycity_message` VALUES ('554','13','1333357822','1');
INSERT INTO `ycity_message` VALUES ('555','13','1333357866','1');
INSERT INTO `ycity_message` VALUES ('556','13','1333357874','1');
INSERT INTO `ycity_message` VALUES ('557','13','1333357883','1');
INSERT INTO `ycity_message` VALUES ('558','13','1333359319','1');
INSERT INTO `ycity_message` VALUES ('559','13','1333359322','1');
INSERT INTO `ycity_message` VALUES ('560','13','1333360903','1');
INSERT INTO `ycity_message` VALUES ('561','13','1333360913','1');
INSERT INTO `ycity_message` VALUES ('562','13','1333360919','1');
INSERT INTO `ycity_message` VALUES ('563','13','1333360922','1');
INSERT INTO `ycity_message` VALUES ('564','13','1333362503','1');
INSERT INTO `ycity_message` VALUES ('565','13','1333362519','1');
INSERT INTO `ycity_message` VALUES ('566','13','1333362554','1');
INSERT INTO `ycity_message` VALUES ('567','13','1333364003','1');
INSERT INTO `ycity_message` VALUES ('568','13','1333364004','1');
INSERT INTO `ycity_message` VALUES ('569','13','1333364034','1');
INSERT INTO `ycity_message` VALUES ('570','13','1333364054','1');
INSERT INTO `ycity_message` VALUES ('571','13','1333365604','1');
INSERT INTO `ycity_message` VALUES ('572','13','1333365613','1');
INSERT INTO `ycity_message` VALUES ('573','13','1333365654','1');
INSERT INTO `ycity_message` VALUES ('574','13','1333367113','1');
INSERT INTO `ycity_message` VALUES ('575','13','1333367142','1');
INSERT INTO `ycity_message` VALUES ('576','13','1333367154','1');
INSERT INTO `ycity_message` VALUES ('577','13','1333368713','1');
INSERT INTO `ycity_message` VALUES ('578','13','1333368717','1');
INSERT INTO `ycity_message` VALUES ('579','13','1333368742','1');
INSERT INTO `ycity_message` VALUES ('580','13','1333370317','1');
INSERT INTO `ycity_message` VALUES ('581','13','1333370332','1');
INSERT INTO `ycity_message` VALUES ('582','13','1333370342','1');
INSERT INTO `ycity_message` VALUES ('583','13','1333371817','1');
INSERT INTO `ycity_message` VALUES ('584','13','1333371832','1');
INSERT INTO `ycity_message` VALUES ('585','13','1333371876','1');
INSERT INTO `ycity_message` VALUES ('586','13','1333373432','1');
INSERT INTO `ycity_message` VALUES ('587','13','1333373438','1');
INSERT INTO `ycity_message` VALUES ('588','13','1333373476','1');
INSERT INTO `ycity_message` VALUES ('589','13','1333375038','1');
INSERT INTO `ycity_message` VALUES ('590','13','1333375076','1');
INSERT INTO `ycity_message` VALUES ('591','13','1333375077','1');
INSERT INTO `ycity_message` VALUES ('592','13','1333376520','1');
INSERT INTO `ycity_message` VALUES ('593','13','1333376532','1');
INSERT INTO `ycity_message` VALUES ('594','13','1333376533','1');
INSERT INTO `ycity_message` VALUES ('595','13','1333376538','1');
INSERT INTO `ycity_message` VALUES ('596','13','1333376577','1');
INSERT INTO `ycity_message` VALUES ('597','13','1333378104','1');
INSERT INTO `ycity_message` VALUES ('598','13','1333378120','1');
INSERT INTO `ycity_message` VALUES ('599','13','1333379604','1');
INSERT INTO `ycity_message` VALUES ('600','13','1333379620','1');
INSERT INTO `ycity_message` VALUES ('601','13','1333379662','1');
INSERT INTO `ycity_message` VALUES ('602','13','1333381204','1');
INSERT INTO `ycity_message` VALUES ('603','13','1333381222','1');
INSERT INTO `ycity_message` VALUES ('604','13','1333381238','1');
INSERT INTO `ycity_message` VALUES ('605','13','1333381262','1');
INSERT INTO `ycity_message` VALUES ('606','13','1333381291','1');
INSERT INTO `ycity_message` VALUES ('607','13','1333382828','1');
INSERT INTO `ycity_message` VALUES ('608','13','1333382891','1');
INSERT INTO `ycity_message` VALUES ('609','13','1333384304','1');
INSERT INTO `ycity_message` VALUES ('610','13','1333384328','1');
INSERT INTO `ycity_message` VALUES ('611','13','1333384362','1');
INSERT INTO `ycity_message` VALUES ('612','13','1333384391','1');
INSERT INTO `ycity_message` VALUES ('613','13','1333384398','1');
INSERT INTO `ycity_message` VALUES ('614','13','1333385928','1');
INSERT INTO `ycity_message` VALUES ('615','13','1333385934','1');
INSERT INTO `ycity_message` VALUES ('616','13','1333385998','1');
INSERT INTO `ycity_message` VALUES ('617','13','1333387525','1');
INSERT INTO `ycity_message` VALUES ('618','13','1333387534','1');
INSERT INTO `ycity_message` VALUES ('619','13','1333387538','1');
INSERT INTO `ycity_message` VALUES ('620','13','1333387598','1');
INSERT INTO `ycity_message` VALUES ('621','13','1333389025','1');
INSERT INTO `ycity_message` VALUES ('622','13','1333389066','1');
INSERT INTO `ycity_message` VALUES ('623','13','1333390625','1');
INSERT INTO `ycity_message` VALUES ('624','13','1333390642','1');
INSERT INTO `ycity_message` VALUES ('625','13','1333390657','1');
INSERT INTO `ycity_message` VALUES ('626','13','1333390666','1');
INSERT INTO `ycity_message` VALUES ('627','13','1333390698','1');
INSERT INTO `ycity_message` VALUES ('628','13','1333392130','1');
INSERT INTO `ycity_message` VALUES ('629','13','1333392157','1');
INSERT INTO `ycity_message` VALUES ('630','13','1333393720','1');
INSERT INTO `ycity_message` VALUES ('631','13','1333393730','1');
INSERT INTO `ycity_message` VALUES ('632','13','1333393732','1');
INSERT INTO `ycity_message` VALUES ('633','13','1333393757','1');
INSERT INTO `ycity_message` VALUES ('634','13','1333393766','1');
INSERT INTO `ycity_message` VALUES ('635','13','1333393796','1');
INSERT INTO `ycity_message` VALUES ('636','13','1333395320','1');
INSERT INTO `ycity_message` VALUES ('637','13','1333395330','1');
INSERT INTO `ycity_message` VALUES ('638','13','1333396830','1');
INSERT INTO `ycity_message` VALUES ('639','13','1333396857','1');
INSERT INTO `ycity_message` VALUES ('640','13','1333396896','1');
INSERT INTO `ycity_message` VALUES ('641','13','1333398430','1');
INSERT INTO `ycity_message` VALUES ('642','13','1333398452','1');
INSERT INTO `ycity_message` VALUES ('643','13','1333398496','1');
INSERT INTO `ycity_message` VALUES ('644','13','1333400045','1');
INSERT INTO `ycity_message` VALUES ('645','13','1333400052','1');
INSERT INTO `ycity_message` VALUES ('646','13','1333401516','1');
INSERT INTO `ycity_message` VALUES ('647','13','1333401545','1');
INSERT INTO `ycity_message` VALUES ('648','13','1333403113','1');
INSERT INTO `ycity_message` VALUES ('649','13','1333404613','1');
INSERT INTO `ycity_message` VALUES ('650','13','1333404666','1');
INSERT INTO `ycity_message` VALUES ('651','13','1333405174','1');
INSERT INTO `ycity_message` VALUES ('652','13','1333406236','1');
INSERT INTO `ycity_message` VALUES ('653','13','1333406266','1');
INSERT INTO `ycity_message` VALUES ('654','13','1333407823','1');
INSERT INTO `ycity_message` VALUES ('655','13','1333407836','1');
INSERT INTO `ycity_message` VALUES ('656','13','1333409310','1');
INSERT INTO `ycity_message` VALUES ('657','13','1333409323','1');
INSERT INTO `ycity_message` VALUES ('658','13','1333410910','1');
INSERT INTO `ycity_message` VALUES ('659','13','1333410932','1');
INSERT INTO `ycity_message` VALUES ('660','13','1333412532','1');
INSERT INTO `ycity_message` VALUES ('661','13','1333412541','1');
INSERT INTO `ycity_message` VALUES ('662','13','1333414035','1');
INSERT INTO `ycity_message` VALUES ('663','13','1333414041','1');
INSERT INTO `ycity_message` VALUES ('664','13','1333415612','1');
INSERT INTO `ycity_message` VALUES ('665','13','1333415635','1');
INSERT INTO `ycity_message` VALUES ('666','13','1333417112','1');
INSERT INTO `ycity_message` VALUES ('667','13','1333417194','1');
INSERT INTO `ycity_message` VALUES ('668','13','1333418736','1');
INSERT INTO `ycity_message` VALUES ('669','13','1333418794','1');
INSERT INTO `ycity_message` VALUES ('670','13','1333420334','1');
INSERT INTO `ycity_message` VALUES ('671','13','1333420336','1');
INSERT INTO `ycity_message` VALUES ('672','13','1333421812','1');
INSERT INTO `ycity_message` VALUES ('673','13','1333421834','1');
INSERT INTO `ycity_message` VALUES ('674','13','1333423412','1');
INSERT INTO `ycity_message` VALUES ('675','13','1333423443','1');
INSERT INTO `ycity_message` VALUES ('676','13','1333425043','1');
INSERT INTO `ycity_message` VALUES ('677','13','1333425076','1');
INSERT INTO `ycity_message` VALUES ('678','13','1333426506','1');
INSERT INTO `ycity_message` VALUES ('679','13','1333426576','1');
INSERT INTO `ycity_message` VALUES ('680','13','1333428106','1');
INSERT INTO `ycity_message` VALUES ('681','13','1333428186','1');
INSERT INTO `ycity_message` VALUES ('682','13','1333429633','1');
INSERT INTO `ycity_message` VALUES ('683','13','1333429686','1');
INSERT INTO `ycity_message` VALUES ('684','13','1333431233','1');
INSERT INTO `ycity_message` VALUES ('685','13','1333431292','1');
INSERT INTO `ycity_message` VALUES ('686','13','1333432854','1');
INSERT INTO `ycity_message` VALUES ('687','13','1333432892','1');
INSERT INTO `ycity_message` VALUES ('688','13','1333434354','1');
INSERT INTO `ycity_message` VALUES ('689','13','1333434378','1');
INSERT INTO `ycity_message` VALUES ('690','13','1333435944','1');
INSERT INTO `ycity_message` VALUES ('691','13','1333435978','1');
INSERT INTO `ycity_message` VALUES ('692','13','1333437534','1');
INSERT INTO `ycity_message` VALUES ('693','13','1333437544','1');
INSERT INTO `ycity_message` VALUES ('694','13','1333439034','1');
INSERT INTO `ycity_message` VALUES ('695','13','1333439073','1');
INSERT INTO `ycity_message` VALUES ('696','13','1333440673','1');
INSERT INTO `ycity_message` VALUES ('697','13','1333440688','1');
INSERT INTO `ycity_message` VALUES ('698','13','1333442171','1');
INSERT INTO `ycity_message` VALUES ('699','13','1333442188','1');
INSERT INTO `ycity_message` VALUES ('700','13','1333443716','1');
INSERT INTO `ycity_message` VALUES ('701','13','1333443771','1');
INSERT INTO `ycity_message` VALUES ('702','13','1333445316','1');
INSERT INTO `ycity_message` VALUES ('703','13','1333445336','1');
INSERT INTO `ycity_message` VALUES ('704','13','1333446836','1');
INSERT INTO `ycity_message` VALUES ('705','13','1333446896','1');
INSERT INTO `ycity_message` VALUES ('706','13','1333448405','1');
INSERT INTO `ycity_message` VALUES ('707','13','1333450071','1');
INSERT INTO `ycity_message` VALUES ('708','13','1333451571','1');
INSERT INTO `ycity_message` VALUES ('709','13','1333451583','1');
INSERT INTO `ycity_message` VALUES ('710','13','1333453113','1');
INSERT INTO `ycity_message` VALUES ('711','13','1333454613','1');
INSERT INTO `ycity_message` VALUES ('712','13','1333454666','1');
INSERT INTO `ycity_message` VALUES ('713','13','1333456266','1');
INSERT INTO `ycity_message` VALUES ('714','13','1333456274','1');
INSERT INTO `ycity_message` VALUES ('715','13','1333457822','1');
INSERT INTO `ycity_message` VALUES ('716','13','1333457874','1');
INSERT INTO `ycity_message` VALUES ('717','13','1333459319','1');
INSERT INTO `ycity_message` VALUES ('718','13','1333459322','1');
INSERT INTO `ycity_message` VALUES ('719','13','1333460903','1');
INSERT INTO `ycity_message` VALUES ('720','13','1333460919','1');
INSERT INTO `ycity_message` VALUES ('721','13','1333462554','1');
INSERT INTO `ycity_message` VALUES ('722','13','1333464004','1');
INSERT INTO `ycity_message` VALUES ('723','13','1333464054','1');
INSERT INTO `ycity_message` VALUES ('724','13','1333465604','1');
INSERT INTO `ycity_message` VALUES ('725','13','1333465613','1');
INSERT INTO `ycity_message` VALUES ('726','13','1333467113','1');
INSERT INTO `ycity_message` VALUES ('727','13','1333467142','1');
INSERT INTO `ycity_message` VALUES ('728','13','1333468717','1');
INSERT INTO `ycity_message` VALUES ('729','13','1333468742','1');
INSERT INTO `ycity_message` VALUES ('730','13','1333470317','1');
INSERT INTO `ycity_message` VALUES ('731','13','1333470332','1');
INSERT INTO `ycity_message` VALUES ('732','13','1333471832','1');
INSERT INTO `ycity_message` VALUES ('733','13','1333471876','1');
INSERT INTO `ycity_message` VALUES ('734','13','1333473438','1');
INSERT INTO `ycity_message` VALUES ('735','13','1333473476','1');
INSERT INTO `ycity_message` VALUES ('736','13','1333475038','1');
INSERT INTO `ycity_message` VALUES ('737','13','1333475077','1');
INSERT INTO `ycity_message` VALUES ('738','13','1333476520','1');
INSERT INTO `ycity_message` VALUES ('739','13','1333476577','1');
INSERT INTO `ycity_message` VALUES ('740','13','1333478104','1');
INSERT INTO `ycity_message` VALUES ('741','13','1333478120','1');
INSERT INTO `ycity_message` VALUES ('742','13','1333479604','1');
INSERT INTO `ycity_message` VALUES ('743','13','1333479662','1');
INSERT INTO `ycity_message` VALUES ('744','13','1333481262','1');
INSERT INTO `ycity_message` VALUES ('745','13','1333481291','1');
INSERT INTO `ycity_message` VALUES ('746','13','1333482828','1');
INSERT INTO `ycity_message` VALUES ('747','13','1333482891','1');
INSERT INTO `ycity_message` VALUES ('748','13','1333484328','1');
INSERT INTO `ycity_message` VALUES ('749','13','1333484398','1');
INSERT INTO `ycity_message` VALUES ('750','13','1333485934','1');
INSERT INTO `ycity_message` VALUES ('751','13','1333485998','1');
INSERT INTO `ycity_message` VALUES ('752','13','1333487525','1');
INSERT INTO `ycity_message` VALUES ('753','13','1333487534','1');
INSERT INTO `ycity_message` VALUES ('754','13','1333489025','1');
INSERT INTO `ycity_message` VALUES ('755','13','1333489066','1');
INSERT INTO `ycity_message` VALUES ('756','13','1333490657','1');
INSERT INTO `ycity_message` VALUES ('757','13','1333490666','1');
INSERT INTO `ycity_message` VALUES ('758','13','1333492130','1');
INSERT INTO `ycity_message` VALUES ('759','13','1333492157','1');
INSERT INTO `ycity_message` VALUES ('760','13','1333493720','1');
INSERT INTO `ycity_message` VALUES ('761','13','1333493730','1');
INSERT INTO `ycity_message` VALUES ('762','13','1333495320','1');
INSERT INTO `ycity_message` VALUES ('763','13','1333495330','1');
INSERT INTO `ycity_message` VALUES ('764','13','1333496830','1');
INSERT INTO `ycity_message` VALUES ('765','13','1333496896','1');
INSERT INTO `ycity_message` VALUES ('766','13','1333498452','1');
INSERT INTO `ycity_message` VALUES ('767','13','1333498496','1');
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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='信息内容';
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
INSERT INTO `ycity_messagetext` VALUES ('13','1','全体发信测试','全体发信测试全体发信测试','1385894393');
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
INSERT INTO `ycity_news` VALUES ('134','0','1','admin','电风扇斯蒂芬斯蒂芬斯蒂芬','','','','','','','','<p>f斯蒂芬第三方的手法色粉第三方的手法三国的法规和投入和家人团聚日</p>','','','','0','0','0','0','5','1381939200','0');
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
INSERT INTO `ycity_page` VALUES ('2','联系我们','contact','','','<p>1.中国民航大学乘务学院招生网官方微博<br /></p><p>2.中国民航大学乘务学院招生官方公众微信号</p><p>3.咨询邮箱：cwxy@cauc.edu.cn<br /></p><p>4.联系电话：022-24092909&nbsp;&nbsp;（咨询时间：周一至周五&nbsp;早9：00-11：30&nbsp;，下午14：00-16：30）</p><p>5.联系地址：天津市东丽区津北公路2898号，中国民航大学北区北教二十五(330室)</p><p><br /></p>','','','','','0','0','1970','1385387537');
-- 
-- 表的结构 `ycity_province`
-- 
DROP TABLE IF EXISTS `ycity_province`;
CREATE TABLE `ycity_province` (
  `id` tinyint(2) unsigned NOT NULL,
  `name` varchar(10) CHARACTER SET utf8 NOT NULL COMMENT '省市名称',
  `time` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '考试时间',
  `address` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '考试地点',
  `confirm_time` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '报名确认时间',
  `final_time` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '终审复试时间',
  `payment_deadline` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '缴费截止时间',
  `physical_time` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '体检时间',
  `phy_time` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '体检通知单体检时间',
  `phy_hospital` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '体检通知单体检医院',
  `phy_address` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '体检通知单体检地址',
  `recruit` tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT '是否招生，1为招生，2为不招生',
  `signupStatus` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '报名状态，1为未开始报名，2为开始报名',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '前台显示，0为不显示，1为显示',
  `isArt` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否招收艺术类，0为否，1为是',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='省市';
-- 
-- 导出表中的数据 `ycity_province`
--
INSERT INTO `ycity_province` VALUES ('11','北京','2013年12月15日（随到随考）(上午8:30—11:30,下午13:30-16:30)','中国民航管理干部学院教学楼（朝阳区花家地东路3号）','','','2013年12月15日  下午16:30','2013年12月16日 （具体地点考试时告知）','23日上午8:30','解放军253医院体检中心','呼和浩特市新城区爱民街111号','1','2','1','0','1385386342');
INSERT INTO `ycity_province` VALUES ('12','天津','','','','','','','','','','2','1','0','0','1385386671');
INSERT INTO `ycity_province` VALUES ('13','河北','','','','','','','','','','2','1','0','0','1385386650');
INSERT INTO `ycity_province` VALUES ('14','山西','2013年12月15日（随到随考）(上午8:30—11:30,下午13:30-16:30)','中国民航管理干部学院教学楼（朝阳区花家地东路3号）','','','2013年12月15日  下午16:30','2013年12月16日 （具体地点考试时告知）','','','','1','2','1','0','1385386390');
INSERT INTO `ycity_province` VALUES ('15','内蒙古','2013年12月22日 （随到随考）（上午8:30-11:30，下午：13：30-15:00）','内蒙古自治区呼和浩特市万立国际酒店17楼（呼市新城区兴安南路五号）','','2013年12月22日 （天津航空终审选拔）（下午15:30开始）','2013年12月22日  下午15:00','2013年12月23日 （具体地点考试时告知）','','','','1','2','1','0','1385386426');
INSERT INTO `ycity_province` VALUES ('21','辽宁','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('22','吉林','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('23','黑龙江','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('31','上海','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('32','江苏','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('33','浙江','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('34','安徽','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('35','福建','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('36','江西','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('37','山东','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('41','河南','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('42','湖北','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('43','湖南','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('44','广东','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('45','广西','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('46','海南','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('50','重庆','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('51','四川','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('52','贵州','2013年12月29日（随到随考）(上午8:30—11:30,下午13:30-15:00)','贵州饭店二楼会议中心（贵阳市云岩区 北京路66号 ）','','2013年12月29日（南方航空终审选拔） （下午15:30 开始）','2013年12月29日  下午15:00','2013年12月30日 （具体地点考试时告知）','','','','1','2','1','0','1385386780');
INSERT INTO `ycity_province` VALUES ('53','云南','2013年12月28日（随到随考）(上午9:00—11:30,下午13:30-15:30)','东方航空云南有限公司培训中心（昆明市官渡区巫家巷33号）','','','2013年12月28日  下午15:30','2013年12月29日 （具体地点考试时告知）','','','','1','2','1','0','1385386719');
INSERT INTO `ycity_province` VALUES ('54','西藏','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('61','陕西','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('62','甘肃','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('63','青海','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('64','宁夏','','','','','','','','','','2','1','0','0','0');
INSERT INTO `ycity_province` VALUES ('65','新疆','','','','','','','2013年12月','大黄蜂','','2','1','0','0','1385386738');
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
  `display_order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '提问时间',
  `reply_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '回复时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 COMMENT='考生问答';
-- 
-- 导出表中的数据 `ycity_qa`
--
INSERT INTO `ycity_qa` VALUES ('1','1326508678','1','12','考生问答测试1考生问答测试考生问答测试','考生问答测试考生问答测试考生问答测试','考生问答回复考生问答回复考生问答回复','3','0','1379831594','1379893594');
INSERT INTO `ycity_qa` VALUES ('2','1326508678','1','12','考生问答测试2考生问答测试考生问答测试考生问答测试考生问答测试考生问答测试考','考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2','考生问答回复2考生问答回复2考生问答回复2考生问答回复2考生问答回复2','3','0','1379831703','1379893594');
INSERT INTO `ycity_qa` VALUES ('3','1326508678','1','12','考生问答测试3考生问答测试考生问答测试','考生问答测试考生问答测试考生问答测试','考生问答回复考生问答回复考生问答回复','3','0','1379831594','1379893594');
INSERT INTO `ycity_qa` VALUES ('4','1326508678','1','12','考生问答测试4考生问答测试考生问答测试考生问答测试考生问答测试考生问答测试考','考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2','考生问答回复2考生问答回复2考生问答回复2考生问答回复2考生问答回复2','3','0','1379831703','1379893594');
INSERT INTO `ycity_qa` VALUES ('5','1326508678','1','12','考生问答测试5考生问答测试考生问答测试','考生问答测试考生问答测试考生问答测试','考生问答回复考生问答回复考生问答回复','3','0','1379831594','1379893594');
INSERT INTO `ycity_qa` VALUES ('6','1326508678','0','12','考生问答测试6考生问答测试考生问答测试考生问答测试考生问答测试考生问答测试考','考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2','','1','0','1379831703','0');
INSERT INTO `ycity_qa` VALUES ('7','1326508678','1','12','考生问答测试7考生问答测试考生问答测试','考生问答测试考生问答测试考生问答测试','考生问答回复考生问答回复考生问答回复','3','0','1379831594','1379893594');
INSERT INTO `ycity_qa` VALUES ('8','1326508678','1','12','考生问答测试8考生问答测试考生问答测试考生问答测试考生问答测试考生问答测试考','考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2','考生问答回复2考生问答回复2考生问答回复2考生问答回复2考生问答回复2','3','0','1379831703','1379893594');
INSERT INTO `ycity_qa` VALUES ('9','1326508678','1','12','考生问答测试9考生问答测试考生问答测试','考生问答测试考生问答测试考生问答测试','考生问答回复考生问答回复考生问答回复','3','0','1379831594','1379893594');
INSERT INTO `ycity_qa` VALUES ('10','1326508678','1','12','考生问答测试10考生问答测试考生问答测试考生问答测试考生问答测试考生问答测试','考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2','考生问答回复2考生问答回复2考生问答回复2考生问答回复2考生问答回复2','3','0','1379831703','1379893594');
INSERT INTO `ycity_qa` VALUES ('11','1326508678','1','12','考生问答测试11考生问答测试考生问答测试','考生问答测试考生问答测试考生问答测试','考生问答回复考生问答回复考生问答回复','1','0','1379831594','1379893594');
INSERT INTO `ycity_qa` VALUES ('12','1326508678','0','12','考生问答测试12考生问答测试考生问答测试考生问答测试考生问答测试考生问答测试','考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2考生问答测试2','','1','0','1379831703','0');
INSERT INTO `ycity_qa` VALUES ('13','1326508678','0','12','考生问答标题测试考生问答标题测试考生问答标题测试','考生问答内容测试考生问答内容测试考生问答内容测试','','1','0','0','0');
INSERT INTO `ycity_qa` VALUES ('14','1326508678','0','12','考生问答标题测试考生问答标题测试考生问答标题测试','考生问答内容测试考生问答内容测试考生问答内容测试考生问答内容测试考生问答内容测试','','1','0','1381685843','0');
INSERT INTO `ycity_qa` VALUES ('15','1326508678','0','12','考生问答标题测试考生问答标题测试考生问答标题测试','考生问答内容测试考生问答内容测试考生问答内容测试考生问答内容测试考生问答内容测试','','2','0','1381685863','0');
INSERT INTO `ycity_qa` VALUES ('16','1326508678','0','12','xss测试','xss测试','','1','0','1381686183','0');
INSERT INTO `ycity_qa` VALUES ('18','1326508678','0','12','a&#39; or &#39;1&#39;=&#39;1','sql注入','','1','0','1381686734','0');
INSERT INTO `ycity_qa` VALUES ('19','1328522063','0','0','我要提问测试','看看看看','','1','0','1381732957','0');
INSERT INTO `ycity_qa` VALUES ('17','1326508678','0','12','&lt;script&gt;','&lt;script type=&quot;text/javascript&quot; src=&quot;http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js&quot;&gt;&lt;/script&gt;&lt;iframe src=&quot;http://www.cauc.edu.cn/&quot;&gt;&lt;/iframe&gt;','','1','0','1381686299','0');
INSERT INTO `ycity_qa` VALUES ('20','1328585593','0','53','家用燃气灶','测试测试测试测试测试测试测试测试测试测试测试侧hi','','1','0','1381733801','0');
INSERT INTO `ycity_qa` VALUES ('21','1328689241','0','13','提问测试','提问测试','','1','0','1381979672','0');
INSERT INTO `ycity_qa` VALUES ('22','1328689241','0','13','纷纷废物废物','非我非we范围额外范围分为','','1','0','1381980625','0');
INSERT INTO `ycity_qa` VALUES ('23','1326508678','0','12','不公开不公开','不公开不公开不公开','','2','0','1382253635','0');
INSERT INTO `ycity_qa` VALUES ('24','1328689241','1','13','提问测试   提问人测试','提问测试   提问人测试提问测试   提问人测试提问测试   提问人测试提问测试   提问人测试提问测试   提问人测试','惹我惹我惹我','3','0','1382255220','1382256267');
INSERT INTO `ycity_qa` VALUES ('25','1328689241','1','13','特务他惹我','退热贴额头','few纷纷','3','0','1382256292','1382256305');
INSERT INTO `ycity_qa` VALUES ('26','1326508678','0','12','省份省份省份省份省份省份','省份省份省份省份省份省份省份省份','','1','0','1382257421','0');
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
  `cid` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '高考考生号',
  `score` float(5,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '高考总成绩',
  `englishScore` float(5,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '高考英语成绩',
  `height` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '身高',
  `weight` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '体重',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='报名信息';
-- 
-- 导出表中的数据 `ycity_signup`
--
INSERT INTO `ycity_signup` VALUES ('1332382972','1','安徽省程集中学','246523','安徽省宿松县程集中学','0556-7962717','246523','叶海军','13622048617','Signup/201311/528c15aa42180.jpg','Signup/201311/528c15aa42180_s.jpg','1384912298','0','2013112058317642','TRADE_SUCCESS','RqPnCoPT3K9%2Fvwbh3I75K68r2L3tJKmPFxnGbzf%2BurCoPnGEJUt0s3gmqIyuwA8Jyc%2F5','2013-11-20 09:51:59','y_city@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1332397662','2','城建学院','300384','津静公路26号','13662086010','300384','叶海军','13662048617','Signup/201311/528c1e9f93b94.jpg','Signup/201311/528c1e9f93b94_s.jpg','1386855695','0','','','','','','2147483647','482.50','121.50','178','80');
INSERT INTO `ycity_signup` VALUES ('1333019839','1','费县第二中学','273400','山东省临沂市费县南外环路197号大洋公司家属院3号楼3单元6楼3-11杜淑贤收','15589102826','273400','张桂玲','13370669669','Signup/201311/5295b68d6acfc.png','Signup/201311/5295b68d6acfc_s.png','1385543309','0','2013112764773562','TRADE_SUCCESS','66e86f46459812abff7515aecd7facc75g','2013-11-27 17:15:43','15589102826','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1332931466','1','1中','300000','天津市东丽区津北公路','24092909','300000','李雷','13821622301','Signup/201311/529455dbb71b0.jpg','Signup/201311/529455dbb71b0_s.jpg','1385453019','0','2013112671257115','TRADE_SUCCESS','1dfd600c03465d3b3846ebe24038bdf52u','2013-11-26 16:02:43','da_xia886@sohu.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1332929698','1','中国民航大学','300300','中国民航大学','022-24092894','300300','孙重凯','24092909','Signup/201311/5294565ac65d4.jpg','Signup/201311/5294565ac65d4_s.jpg','1385453146','0','2013112673238007','TRADE_SUCCESS','RqPnCoPT3K9%2Fvwbh3I75KtrjdaZoGxczeRZ29NR%2BVg%2BJ1C7h1MGLc4XiZWvT%2BsU20NTS','2013-11-26 16:30:20','sunzhongkai@263.net','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1332966177','2','1中','300300','天津市东丽区津北公路','24092909','300000','李雷','13821622301','Signup/201311/529458e9e8b25.jpg','Signup/201311/529458e9e8b25_s.jpg','1385453801','0','2013112671296115','TRADE_SUCCESS','2c3399d5d04b4bb0823c6c74c5136c772u','2013-11-26 16:14:58','da_xia886@sohu.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333020014','1','安徽省程集中学1','2465231','安徽省宿松县程集中学1','0556-79627171','2465231','叶海军1','13622048618','Signup/201311/52985795b71b0.JPG','Signup/201311/52985795b71b0_s.JPG','1385539101','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1332991610','2','adfsafas','0','asfdafsd','asdfsafdaf','0','asdfasf','0','Signup/201311/529490bf76417.jpg','Signup/201311/529490bf76417_s.jpg','1385468095','0','2013112672294644','TRADE_SUCCESS','RqPnCoPT3K9%2Fvwbh3I75KtrgisVDUjDzbuoM8aNmhZ0CAmrWZunp91IWlFc4yVu3xMMj','2013-11-26 20:14:37','13516166596','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1332909716','2','北京四中','3333333','343若45453','3453543534543','3535345','3453535','35354','Signup/201311/5298481b39387.JPG','Signup/201311/5298481b39387_s.JPG','1385455683','0','2013112671641844','TRADE_SUCCESS','RqPnCoPT3K9%2Fvwbh3I75KtrjdArdI86WB9790oiqYvp%2F6Fauw8duNHgYGI%2BXdTIOlSg9','2013-11-26 16:48:26','13516166596','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1332919839','1','北京四中','100100','北京四中','18822131618','100100','丁志强','13821287745','Signup/201311/5294614ac28cb.JPG','Signup/201311/5294614ac28cb_s.JPG','1385455946','0','2013112619369266','TRADE_SUCCESS','RqPnCoPT3K9%2Fvwbh3I75KtrjdAQMxhRs4AD%2FZMAvFDeFLxRKDe71gzknHjXnxn2yzWdt','2013-11-26 16:51:57','13012266328','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333034281','1','1中','300000','天津市东丽区津北公路','12345678','300000','李雷','13821622301','Signup/201311/52953ea6a7d8c.jpg','Signup/201311/52953ea6a7d8c_s.jpg','1385512614','0','2013112772890915','TRADE_SUCCESS','RqPnCoPT3K9%2Fvwbh3I75KtvHoo6UhAofD%2BpBEYvlWjYErc%2BQq%2FdhlHlTcBFCEnb1Usc3','2013-11-27 08:53:05','da_xia886@sohu.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333009716','1','玉溪实验中学','653100','云南省玉溪市红塔区诸葛东巷1号','15108708008','653100','米玉玲','15969313099','Signup/201311/5295bcf88583b.jpg','Signup/201311/5295bcf88583b_s.jpg','1385544952','0','2013112734364745','TRADE_SUCCESS','2f78d88c67bb2e08744186af8be3f12b4i','2013-11-27 17:33:39','15108708008','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333016383','1','山西省阳泉市第十五中学校','45008','山西省阳泉市矿区一矿蒙河22号楼31号家','13103533302','45008','翟秀文','15235321677','Signup/201311/5295c86829f63.jpg','Signup/201311/5295c86829f63_s.jpg','1385547880','0','2013112717167340','TRADE_SUCCESS','e049b9f423cc4153815ba572664db83348','2013-11-27 18:42:16','13103533302','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333031586','1','华苑职业学校','300270','天津市红桥区彰武楼12门102','15822211737','300131022','崔鑫','13652128033','Signup/201311/5295c8b5e1113.jpg','Signup/201311/5295c8b5e1113_s.jpg','1385547957','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333077360','2','安徽省安庆市望江县第三中学','246200','安徽省安庆市望江县第三中学','0556-7171268','246200','王宜文','15357260238','Signup/201311/5295cdac98968.jpg','Signup/201311/5295cdac98968_s.jpg','1385549228','0','2013112733084156','TRADE_SUCCESS','00bec1011b6cc9af7bbcf70220c4270754','2013-11-27 18:50:03','wjwyw7175460@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333062551','2','石家庄市第一中学','50000','河北省石家庄市桥东区平安大街石家庄市第一中学高三九班','13623310639','50000','马丽芳','13623310639','Signup/201311/5295d28d98968.jpg','Signup/201311/5295d28d98968_s.jpg','1385550477','0','2013112779265457','TRADE_SUCCESS','74b45f82113f9f40cd7a42acc0d8a80856','2013-11-27 19:07:39','13623310639','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333066642','2','北京市延庆县第二中学','102100','北京市延庆县新城街2号','010-69101374','102100','吕桂芳','13552257373','Signup/201311/5295d5107de29.jpg','Signup/201311/5295d5107de29_s.jpg','1385551120','0','2013112764847569','TRADE_SUCCESS','e5b75a50c9f1d12e65f0caee1ba0c8c25u','2013-11-27 19:59:07','ylyd9195@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333078426','1','吉林省吉林市第二中学','132013','吉林省吉林市龙潭区山前街新山路18号检验科孙丽会收','13843252920','132021','曾雷','13514452243','Signup/201311/5295d6599c671.jpg','Signup/201311/5295d6599c671_s.jpg','1385551449','0','2013112812918000','TRADE_SUCCESS','126b9a2fbce72652e27bf8a08d173b5c20','2013-11-28 17:32:31','15506022007','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333033344','2','安徽省马鞍山市马鞍山中加双语学校','243000','安徽省马鞍山市马向路88号马鞍山中加双语学校高三（22）班','0555-2346112','243000','甘信福','13615558162','Signup/201311/5295df3e4c4b4.jpg','Signup/201311/5295df3e4c4b4_s.jpg','1385553726','0','2013112717410340','TRADE_SUCCESS','68d87d624f26a0009e5cae097898f2de48','2013-11-27 20:02:46','yangjun4372@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333066177','2','北京市昌平区北师特培训学校','102249','北京市昌平区龙水路16号','01056284612','102249','陈凤刚','1056284615','Signup/201311/5295e941e4e1c.jpg','Signup/201311/5295e941e4e1c_s.jpg','1385556289','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333021456','1','吉林二中','132013','吉林省吉林市昌邑区吉林大街444-1-76号','0432-5588001','132001','王苹','15580427087','Signup/201311/5295e9da487ab.jpg','Signup/201311/5295e9da487ab_s.jpg','1385556442','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333033732','2','江苏睢宁宁海外国语学校','221200','江苏省睢宁县梁集镇刘圩村62号','15190753382','221236','戴光义','13852229655','Signup/201311/5295eeac00000.jpg','Signup/201311/5295eeac00000_s.jpg','1385557676','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333005362','2','北京市第十一中学','100062','北京市崇文区永外杨家园路10号（景泰小学）','13621155604','100075','赵耀红','13901155340','Signup/201311/5295f202baeb9.jpg','Signup/201311/5295f202baeb9_s.jpg','1385558530','0','2013112730253855','TRADE_SUCCESS','3633f256926fc0728a01d1a304e8aca852','2013-11-27 21:23:33','121335560@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333053984','1','河北省廊坊三河市第三中学','65200','河北省廊坊三河市三建小区1号楼6单元803室','0316-3309370','65200','丁硕','13663266237','Signup/201311/5295f239ec82e.jpg','Signup/201311/5295f239ec82e_s.jpg','1385558585','0','2013112854733303','TRADE_SUCCESS','a4a07a0d407c3bf72b23b62a9a375e9b26','2013-11-28 18:35:39','13663266237','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333125211','2','天津市河东区育杰高级中学','300163','天津市东丽区昆仑路临月里1号楼3门601','13132090031','300162','王家爽','13116012007','Signup/201311/529618ecaba95.jpg','Signup/201311/529618ecaba95_s.jpg','1385568492','0','2013112814548093','TRADE_SUCCESS','ef1acaa2f95c2c6aa7b1793284e3cbbc76','2013-11-28 00:13:51','13116012007','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333176653','2','自贡市蜀光中学','643000','自贡市自流井区东街蜀光路滨河小区1幢1单元14号','0813-2701396','643000','马永超','13350682127','Signup/201311/52962ce553ec6.jpg','Signup/201311/52962ce553ec6_s.jpg','1385573605','0','2013112829063098','TRADE_SUCCESS','2a6cee1bd6d9a14b29a4a47a7c01dcde7g','2013-11-28 01:32:35','50921010@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333131586','2','江苏省南京市田家炳高级中学','210037','江苏省南京市浦口区高新新华西路458号盘金华府5栋104室','13851958487','210044','陆美华','13851958487','Signup/201311/5296802aa4083.jpg','Signup/201311/5296802aa4083_s.jpg','1385594922','0','2013112830870255','TRADE_SUCCESS','26463a45e4235feb970285dce17aba4652','2013-11-28 07:55:36','15996330882','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333177360','1','江苏省邳州市第一中学','221300','江苏省邳州市聚宝花园10#C座3单元406室','0516-86996298','221300','李奎','13805227881','Signup/201311/5296824f89544.jpg','Signup/201311/5296824f89544_s.jpg','1385595471','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333134281','1','吉林省吉林市第二中学','132000','吉林省吉林市昌邑解放东路89号','18904321757','132001','王卓','18904320010','Signup/201311/5296fbcc487ab.jpg','Signup/201311/5296fbcc487ab_s.jpg','1385626572','0','2013112832839586','TRADE_SUCCESS','355a22aabec519497206c3bd6c4b713c6s','2013-11-28 16:28:58','452120592@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333178426','1','北京市顺义区第一中学','101300','北京市朝阳区姚家园西里5号院1号楼5单元101室','010-85816721','100025','康玉红','13910172166','Signup/201311/529688e4a037a.jpg','Signup/201311/529688e4a037a_s.jpg','1385597156','0','2013112848073583','TRADE_SUCCESS','fdce7a7c5ee4c2cb3c93d47a2e74a5206m','2013-11-28 08:08:14','gaojun1117@sohu.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333143611','1','安徽省程集中学','246523','安徽省宿松县程集中学','0556-7962717','246523','叶海军','13622048617','Signup/201311/5296890d07a12.jpg','Signup/201311/5296890d07a12_s.jpg','1385597197','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333025211','2','中国地质大学附属中学','100083','北京市海淀区西三旗建材城中路2号','13611167360','100096','段立军','13681117536','Signup/201311/52968ad953ec6.jpg','Signup/201311/52968ad953ec6_s.jpg','1385597657','0','2013112865772869','TRADE_SUCCESS','5cb8483536a6c35e4bb35328ae01bf195u','2013-11-28 08:16:15','13611167360','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333115695','1','吉林省吉林市第二中学','132013','吉林省吉林市江南一号20号楼2707室马乐群收','13244321960','132013','马乐群','13244321960','Signup/201311/52968d0ebebc2.jpg','Signup/201311/52968d0ebebc2_s.jpg','1385598222','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333191610','1','天津市宝坻区四中','301800','天津市宝坻区宝平景苑小区24-1-102','022-82682101','301800','马秀梅','13821836278','Signup/201311/529692ad39387.jpg','Signup/201311/529692ad39387_s.jpg','1385599661','0','2013112871156761','TRADE_SUCCESS','45975eb3fed2d2dcc7774e9e6f0ddce05e','2013-11-28 10:10:55','13821836278','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333140938','1','大连前程高级中学','116100','辽宁省大连市金州区站前街道民和村麦家屯224号','13842644264','116100','王朝','13842644264','Signup/201311/5296945bb34a7.jpg','Signup/201311/5296945bb34a7_s.jpg','1385600091','0','2013112857222136','TRADE_SUCCESS','530b1100562a545debef2be76e5c4fae40','2013-11-28 08:55:23','wz3669@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333096212','1','中国地质大学附属中学','100083','北京市海淀区圆明园东路厢白旗甲1号院4-2-302','13901046053','100084','王琪','13381111199','Signup/201311/5296a0d576417.jpg','Signup/201311/5296a0d576417_s.jpg','1385603285','0','2013112873315277','TRADE_SUCCESS','5abad4f16b7c2fccbed17f8c4a1920ac6a','2013-11-28 09:58:41','gd5856@gmail.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333196212','2','天津市方舟实验中学','300123','天津市红桥区邵公庄大街2号','13752538000','300122','贾锦萍','13920066588','Signup/201311/5296a5421312d.jpg','Signup/201311/5296a5421312d_s.jpg','1385604418','0','2013112831573986','TRADE_SUCCESS','5f40f9a65ed0d145fb21019c387200c56s','2013-11-28 10:04:49','284517684@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333133732','2','江苏省丹阳市第六中学','212300','江苏省丹阳市提香花园1期8-1-601','15051137858','212300','李华','13912812362','Signup/201311/5296a6b2baeb9.jpg','Signup/201311/5296a6b2baeb9_s.jpg','1385604786','0','2013112819722634','TRADE_SUCCESS','912df4bb7f41430605e3934b2cc831673w','2013-11-28 11:36:50','15051137858','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333076726','2','章丘高级中学','250200','山东省章丘市辛寨镇一村商业街116号','13805442800','250212','王维富','13969133650','Signup/201311/5296a7909c671.jpg','Signup/201311/5296a7909c671_s.jpg','1385605008','0','2013112834101163','TRADE_SUCCESS','00e03bc9d335e96a2771e6d0e5f4c15f5i','2013-11-28 11:06:01','lyfzhaona@sina.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333192917','1','淮南市第四中学','232000','淮南市第四中学','13335548063','232000','汪美君','18715371706','Signup/201311/5296a875c65d4.jpg','Signup/201311/5296a875c65d4_s.jpg','1385605237','0','2013112802827109','TRADE_SUCCESS','82a8af0a5a79845a0102e89a836bd6b42i','2013-11-28 10:24:00','lmxssj@sina.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333127526','1','天津市南开艺术中学','300133','天津市武清区河西务镇河西务中学','02229439040','301714','白士艳','13072265867','Signup/201311/5296b42416e36.jpg','Signup/201311/5296b42416e36_s.jpg','1385608228','0','2013112812560996','TRADE_SUCCESS','87f0cb9a323ff9bfbb1b3ba4a60f75907c','2013-11-28 11:35:27','18322768032','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333105362','2','北京市东方德才学校','100026','北京市朝阳区周庄嘉园南里14号楼3门301','67491973','100023','乔海英','18611012746','Signup/201311/5296c79189544.jpg','Signup/201311/5296c79189544_s.jpg','1385613201','0','2013112873867077','TRADE_SUCCESS','356b5b6dbf10f987491ef0dc5df411786a','2013-11-28 12:47:11','18611012746','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333011865','1','枣庄八中北校 ','277000','山东省枣庄市高新区世纪凤凰城3号楼2单元502','13969454350','277000','周月泉','15318436312','Signup/201311/5296cce190f56.jpg','Signup/201311/5296cce190f56_s.jpg','1385614561','0','2013112853360348','TRADE_SUCCESS','26024edfc0e23c0416b324ac1fa0a64f4o','2013-11-28 13:28:37','rumengss@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333133344','2','铭师堂学校','100071','北京市海淀区上庄镇白水洼村77号铭师堂学校','18501080868','100071','李全雪','13051067796','Signup/201311/5296cfa6d59f8.jpg','Signup/201311/5296cfa6d59f8_s.jpg','1385615270','0','2013112872952461','TRADE_SUCCESS','fac123ab23aa978447e12916475833e05e','2013-11-28 17:43:37','18610096335','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333098443','1','首都师范大学大兴附属中学','102600','北京市大兴区黄村镇海子角海东路4号（首都师范大学大兴附属中学）','18611336440','102600','丁瑞丽','13522073073','Signup/201311/5296f0a1efa79.jpg','Signup/201311/5296f0a1efa79_s.jpg','1385618653','0','2013112810937916','TRADE_SUCCESS','94938827904272fea293b96060b79d312w','2013-11-28 14:24:45','xiaoenv@tom.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333133276','2','河北省邯郸市第四中学','56011','河北省邯郸市丛台区永平里（西院）2-1-4','15176027922','56002','杨建忠','13703109401','Signup/201311/5296ea4fe1113.jpg','Signup/201311/5296ea4fe1113_s.jpg','1385622095','0','2013112865383789','TRADE_SUCCESS','9e5bd76f21683546bea54d249b49eba86y','2013-11-28 15:22:17','241802422@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333156746','1','四川省邛崃市第一中学校','611530','北环路137号','13730611678','611530','郭洪','13982222557','Signup/201311/5296f16ac28cb.jpg','Signup/201311/5296f16ac28cb_s.jpg','1385623914','0','2013112853798083','TRADE_SUCCESS','682172be9fddc83dc80fa121e4aea18d6m','2013-11-28 15:30:59','13730611678','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333153605','1','河北省邯郸市第三十一中学','56002','河北省邯郸市丛台区和平路中医院北胡同3号楼1单元1号','0310—3017343','56002','牛林芳','13603100992','Signup/201311/5296f1f5a7d8c.jpg','Signup/201311/5296f1f5a7d8c_s.jpg','1385624053','0','2013112860669373','TRADE_SUCCESS','43a56fc62375a08dbe4f6146024a47dd62','2013-11-28 15:38:20','13831085587','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333012558','3','天津市西青区杨柳青第一中学','300380','山东省邹城市东滩路11号邹城丰达公司','13905372096 ，0537-31','273500','刘翠芬','13853798345','Signup/201311/5296f2b41ab3f.jpg','Signup/201311/5296f2b41ab3f_s.jpg','1385624244','0','2013112873277020','TRADE_SUCCESS','caf98865cd462a0a4f91924d2423795a34','2013-11-28 15:37:40','13905372096','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333035808','3','肥西实验高级中学','231200','肥西上派云谷路与翡翠路交叉口','0551-62565611','231200','刘敬泽','13771092605','Signup/201311/5296fddf501bd.jpg','Signup/201311/5296fddf501bd_s.jpg','1385627103','0','2013112845829729','TRADE_SUCCESS','35370d6ffea28fc96b7fa821c87a447b3m','2013-11-28 16:35:26','18256018908','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333141942','1','山东省文登师范学校','264400','山东省威海市环翠区戚谷疃小区26号楼1单元201室','18663162262','264200','王丽靖','13869018286','Signup/201311/52970bcf90f56.jpg','Signup/201311/52970bcf90f56_s.jpg','1385630671','0','2013112818071410','TRADE_SUCCESS','00823a378df569d2a545a62213f11bdf2k','2013-11-28 17:36:04','15953874881','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333071132','1','广西北海市第二中学','536005','广西北海市海城区上海路星海名城一期1-1-0902号','18207797140','536000','朱雪霞','13387792773','Signup/201311/529710c52dc6c.jpg','Signup/201311/529710c52dc6c_s.jpg','1385631941','0','2013112818208010','TRADE_SUCCESS','b0644ce20879ae730a5de523e9d3f2cf2k','2013-11-28 17:46:01','314316153@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333162551','2','四合庄中学','300300','天津市东丽区栖霞道詹宾西里2号楼3门502','15620659186','300300','王思予','13622109566','Signup/201311/52972cc703d09.jpg','Signup/201311/52972cc703d09_s.jpg','1385639111','0','2013112857727583','TRADE_SUCCESS','8c1e9bf0bf73b8eb796af6d213dd772f6m','2013-11-28 19:43:17','15620659186','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333123000','1','沈阳音乐学院附属艺术学校','110168','辽宁省沈阳市浑南新区浑南五东路河畔新城4期2-411-452','13840263555','110180','任天婷','13840263555','Signup/201311/52973dfff0537.jpg','Signup/201311/52973dfff0537_s.jpg','1385643519','0','2013112848536654','TRADE_SUCCESS','26276a5f52cc4f3b37e456f9ad6dadd850','2013-11-28 21:29:14','13840263555','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333092917','1','江苏省淮安市清浦中学','223002','江苏淮安市淮阴区樱花小区A区16栋104','15851730822','223000','王力祥','13861652655','Signup/201311/52974223baeb9.jpg','Signup/201311/52974223baeb9_s.jpg','1385644579','0','2013112838580845','TRADE_SUCCESS','a5f6ecab276b461b4ab68a5e4ec2521c4i','2013-11-28 21:22:41','13861652655','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333142171','1','山东省费县实验中学','273400','山东省费县费城街道办事处平等街481号','15253951983','273400','李学齐','13616495201','Signup/201311/529743c5ca2dd.jpg','Signup/201311/529743c5ca2dd_s.jpg','1385644997','0','2013112853187960','TRADE_SUCCESS','3bd2e109c4044982c924f7f4ff25bbf75c','2013-11-28 21:26:42','15253951983','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333114035','1','云南省玉溪市第二中学','653100','云南省玉溪市红塔区春和街道黑村社区二组十九幢九号','15096787992','653100','张家齐','13988496338','Signup/201311/529744960f424.jpg','Signup/201311/529744960f424_s.jpg','1385645206','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333196896','1','吉林二中','132013','吉林市吉林大街36号','0432 -66911727','132000','1390442812','15944227367','Signup/201311/529745e74c4b4.jpg','Signup/201311/529745e74c4b4_s.jpg','1385645543','0','2013112872707882','TRADE_SUCCESS','9aa9c05b3e0ba1d24076fb3642d6a1806k','2013-11-28 21:34:06','13019273911','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333151583','1','成都市青白江区大弯中学','610300','四川省成都市青白江区大弯中学','13699020771','610300','罗远霞','13708216628','Signup/201311/5297478b2625a.jpg','Signup/201311/5297478b2625a_s.jpg','1385645963','0','2013112878365615','TRADE_SUCCESS','7dcdda67316c07ba7c8458cd5c4688e62u','2013-11-28 21:44:52','13708216628','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333176520','2','天华实验中学','300350','天津市津南区葛沽镇大滩新村6-3-401','022-28695569','300352','刘英芝','13072278576','Signup/201311/52974aae7270e.jpg','Signup/201311/52974aae7270e_s.jpg','1385646766','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333100045','1','天津市第五十五中学','300070','天津市和平区新兴路36号3门403','022-27822257','300070','刘春梅','15522323358','Signup/201311/52974c3807a12.jpg','Signup/201311/52974c3807a12_s.jpg','1385647160','0','2013112926573053','TRADE_SUCCESS','f9c9eb1cd02988b67da6074e435d95f24y','2013-11-29 21:02:11','13752799651','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333146896','1','北京市礼文中学','100049','北京市石景山区赵山小区','15810956582','100041','荣庆云','13520525595','','','1385647448','0','2013112878631044','TRADE_SUCCESS','ac704ff4dc4044b1fb00f8b451289d354g','2013-11-28 22:03:54','15810956582','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333174271','1','合肥市第五中学','230011','合肥市瑶海区恒盛豪庭5#1405','15305607123','230011','赵彬','18955106535','Signup/201311/52974dfe2625a.jpg','Signup/201311/52974dfe2625a_s.jpg','1385647614','0','2013120116425683','TRADE_SUCCESS','3a963747fbb5a4aeae33d8b69380ec526m','2013-12-01 12:54:40','zhaofbin@sina.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333118736','1','北京市回民学校','100053','北京市宣武区厂甸宿舍11号院东平房','010-63177852','100050','崔瑞民','15611028172','Signup/201311/52974e84bebc2.jpg','Signup/201311/52974e84bebc2_s.jpg','1385647748','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333143370','2','天津市五十五中学','300070','天津市河西区沅江道红山里41门702','022-28220702','300211','王丽晶','15692292134','Signup/201311/5297501922551.jpg','Signup/201311/5297501922551_s.jpg','1385648153','0','2013112863618547','TRADE_SUCCESS','aeab304aa8a0c2ad1e78f6c52bfd30b14m','2013-11-28 22:20:34','451666492@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333103113','2','太原市第二实验中学','30024','山西省太原市万柏林区迎泽西大街96号4号楼3单元32号','18636673188','30024','刘宏','18635169157','','','1385648175','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333167142','2','巴彦淖尔市第一中学','15000','巴彦淖尔市临河区五一家园一号楼3单元201室','15148859180','15000','塔娜','15148859181','Signup/201311/529750e957bcf.JPG','Signup/201311/529750e957bcf_s.JPG','1385648361','0','2013112868932617','TRADE_SUCCESS','f0189efaa7682c27fe88ac9ca9a974162y','2013-11-28 22:58:04','lixing9181@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333165613','1','四川省泸州市泸州老窖天府中学','646000','泸州市龙马潭区城北南光路天立春天花园城47-19','0830-2525164','646200','刘米','13619044183','Signup/201311/529751da5b8d8.JPG','Signup/201311/529751da5b8d8_s.JPG','1385648602','0','2013112917183018','TRADE_SUCCESS','b0a7623f806beeca798c1ee15e06377230','2013-11-29 09:43:09','mxh395415602@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333159319','2','天津市第三中学（高补理科班）','300133','天津市津南区辛庄镇鑫旺里20-205','18222271634','300350','张金莉','13002251185','Signup/201311/5297524e29f63.jpg','Signup/201311/5297524e29f63_s.jpg','1385648718','0','2013112934887786','TRADE_SUCCESS','8e3ec061097e74a40d9611d3902e64a76s','2013-11-29 10:38:45','18222271634','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333139073','1','北京市第二十七中学','100006','北京市通州区玉江佳园24号楼1单元152','010-81500067','101111','郭春辉','13716632275','Signup/201311/529753d25f5e1.jpg','Signup/201311/529753d25f5e1_s.jpg','1385649106','0','2013112802444688','TRADE_SUCCESS','23be8528a7f3b2540ea5b0aaf1c4de386w','2013-11-28 22:31:57','15801536979','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333107823','1','安徽省肥西县第三中学','231200','安徽省合肥市蜀山区长江西路660号湖东新村小区3#301','13721025760','230000','汪庆传','13965068674','Signup/201311/5297547caf79e.jpg','Signup/201311/5297547caf79e_s.jpg','1385649276','0','2013112878525215','TRADE_SUCCESS','8726990ccfe93c1f53943b8cd90c9c9b2u','2013-11-28 22:36:25','13956913366','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333076653','1','安徽省庐江中学','231500','安徽省庐江中学高三（17）班','18256540859','231500','夏修飞','13965677258','Signup/201311/52975722e1113.jpg','Signup/201311/52975722e1113_s.jpg','1385649954','0','2013112822637291','TRADE_SUCCESS','a43ddde03c86da0122942749d2c0174472','2013-11-28 22:47:58','18225521273','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333129698','2','北京市第九中学','100041','北京市海淀区复兴路75号国家开放大学国开书苑','13522397201','100039','朱文涛','13718503234','Signup/201311/529758657a120.JPG','Signup/201311/529758657a120_s.JPG','1385650277','0','2013112967024359','TRADE_SUCCESS','e51c1957548e9fc6c73794beb83572685a','2013-11-29 16:36:33','p2f5cwei@sina.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333153113','1','江苏省淮安市清浦中学','223002','江苏省淮安市清浦中学','18705236578','223002','孙鸿英','18705236578','Signup/201311/52975aa3cdfe6.jpg','Signup/201311/52975aa3cdfe6_s.jpg','1385650851','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333226506','2','云南省昆明市晋宁一中','650600','云南省昆明市晋宁县人民政府昆阳街道办事处裴永华收','0871-67800883','650600','裴永华','13987194488','Signup/201311/5297730b1e848.jpg','Signup/201311/5297730b1e848_s.jpg','1385657099','0','2013112976839892','TRADE_SUCCESS','11aef2184db8c000c150ffcbbc0acbd074','2013-11-29 00:50:19','602429706@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333234378','2','江苏省徐州4市邳州市炮车中学','221300','江苏省徐州市邳州市青年东路50号（农业局）','13776756057','221300','刘留','13952105355','Signup/201311/529774b0e4e1c.jpg','Signup/201311/529774b0e4e1c_s.jpg','1385657520','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333194013','1','吉林省吉林市第二中学吉林大街36号','132013','吉林省吉林市吉林大街十一中加油站对面中通速递','13500988391','132001','原洪雅','13166941461','Signup/201311/5297cb6289544.jpg','Signup/201311/5297cb6289544_s.jpg','1385679714','0','2013112969372094','TRADE_SUCCESS','c32fc9c9fb2df8806ade5d5ed15f647278','2013-11-29 07:23:39','13944239123','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333296896','1','北京市昌平区沙河中学','102200','北京市昌平区南环里26号楼二单元302','15110174958','102200','邓超','13901161082','Signup/201311/5297d9e5f0537.jpg','Signup/201311/5297d9e5f0537_s.jpg','1385683429','0','2013112917385779','TRADE_SUCCESS','dc421142c72bbae71ef06db54b1f3abb6e','2013-11-29 19:14:18','13439953376','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333246896','1','天津市滨海新区大港第八中学','300270','天津市滨海新区大港胜利街前光里65-2-201','13820626825','300270','王福荣','13752298914','Signup/201311/5297db7189544.jpg','Signup/201311/5297db7189544_s.jpg','1385683825','0','2013112972427326','TRADE_SUCCESS','49438762ed9227073345f1d3394347d63g','2013-11-29 08:38:40','shifangxia@126.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333298452','1','北京市牛栏山一中实验学校','101300','北京市朝阳区酒仙桥12街坊15楼2单元25号','13801183162','100016','石力','13681154718','Signup/201311/5297df508583b.jpg','Signup/201311/5297df508583b_s.jpg','1385684816','0','2013112955966203','TRADE_SUCCESS','658b5eeb8e8d4ace141455d0825873e126','2013-11-29 08:26:02','sagi_hd@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333150071','1','河北献县第一中学','62250','河北献县北环飞达通讯','13513035047','62250','贾志强','13231794274','Signup/201311/5297e1bb66ff3.jpg','Signup/201311/5297e1bb66ff3_s.jpg','1385685435','0','2013112928160466','TRADE_SUCCESS','47823d35335a56ebbe34fe706a120fb75o','2013-11-29 08:44:17','13513035047@139.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333290657','1','蓬莱一中','265600','山东省烟台市蓬莱市农村信用社南关路160号','13562516599','265600','谭丽洁','15192329999','Signup/201311/5297e95239387.jpg','Signup/201311/5297e95239387_s.jpg','1385687378','0','2013112937049421','TRADE_SUCCESS','534def4fda4ccd6b543f1a7b311fa6b636','2013-11-29 09:11:37','15192329999','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333165738','1','江苏省新沂市瓦窑中学','221438','江苏省新沂市锦绣华庭26号楼4单元401','13852222650','221400','钱宗宇','15190717727','Signup/201311/5297eef2baeb9.jpg','Signup/201311/5297eef2baeb9_s.jpg','1385688818','0','2013112921965639','TRADE_SUCCESS','507bf032287ee177d763faf3e4fda6c446','2013-11-29 10:25:57','15195491479','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333250071','2','北京市私立北方中学','100022','北京海淀区玉泉路16号325楼5单元7号','13621289166','100039','赵龙江','13520508877','Signup/201311/5297efa32625a.jpg','Signup/201311/5297efa32625a_s.jpg','1385688995','0','2013112948127163','TRADE_SUCCESS','16d14221f3697a2fd49bc51838d1673f5i','2013-11-29 09:39:44','13681320670','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333248405','1','天津市西青区杨柳青四中','300380','天津市西青区杨柳青星河湾25-1-301','15902267255','300380','王旋','13920609663','Signup/201311/5297f1c981b32.jpg','Signup/201311/5297f1c981b32_s.jpg','1385689545','0','2013112964286047','TRADE_SUCCESS','641062bb416fdf43c6098591f4c39c184m','2013-11-29 09:48:34','15922298323','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333166642','1','江苏省新沂市瓦窑中学','221438','江苏省新沂市瓦窑镇马庄村一组68号','18811954054','221438','张永艳','15862136957','Signup/201311/5297f2013567e.jpg','Signup/201311/5297f2013567e_s.jpg','1385689601','0','2013112921572539','TRADE_SUCCESS','b358626ffd6eea353a29582fbdfa94d746','2013-11-29 09:58:24','15195491479','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333153984','2','江苏省新沂市瓦窑中学','221438','江苏省新沂市港头镇黄元四组','15252198875','221400','黄绍飞','13813252306','Signup/201311/5297f3ea501bd.jpg','Signup/201311/5297f3ea501bd_s.jpg','1385690090','0','2013112922141239','TRADE_SUCCESS','522dd2cd9e1f83a0c994b85c1f8ffe3046','2013-11-29 10:37:22','15195491479','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333207823','1','天津市西青区扬柳青四中','300380','天津市西青区杨柳青时代华庭1-5-401','15922298323','300380','张国领','13072266069','Signup/201311/5297f4a7d59f8.jpg','Signup/201311/5297f4a7d59f8_s.jpg','1385690279','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333145336','1','临汾市平阳中学','41000','山西省临汾市襄汾县新建中路新城家电维修部','15935338409','41500','吕红忠','13028025808','Signup/201311/5297f546bebc2.JPG','Signup/201311/5297f546bebc2_s.JPG','1385690438','0','2013112904736164','TRADE_SUCCESS','0ae83b7f930710b492ce49a5a776279f5k','2013-11-29 10:12:04','15935338409','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333265613','3','涟水县第一中学','223400','涟水县城今世缘大道268号','15805236353','223400','王彩娥','13016576366','Signup/201311/5297f5d066ff3.jpg','Signup/201311/5297f5d066ff3_s.jpg','1385690576','0','2013112923144849','TRADE_SUCCESS','eaef4d9171e9e43071e6963ce3c007f64q','2013-11-29 10:00:45','15896154331','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333117194','1','天津市第六十三中学','300190','天津市河西区洞庭路20号（美迪亚院内）','13502052603','300220','王冬梅','15922124593','Signup/201311/5297f5dc16e36.jpg','Signup/201311/5297f5dc16e36_s.jpg','1385690588','0','2013112914682541','TRADE_SUCCESS','7ef892f7aad173625a9687170717496b4a','2013-11-29 10:12:38','13502052603','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333251583','1','下关三中','671000','大理市下关人民北路大理州运政管理处宿命','13320558166','671000','姜丽海','13320558166','Signup/201311/5297f81966ff3.JPG','Signup/201311/5297f81966ff3_s.JPG','1385691161','0','2013112955824648','TRADE_SUCCESS','ca6829d83b8a655bba89010ec3addb134o','2013-11-29 10:16:23','13577876636','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333120334','1','石家庄市第六中学','50051','裕华西路27号','0311-87020156','50051','张琨荣','15028112066','Signup/201311/5297fabe0f424.jpg','Signup/201311/5297fabe0f424_s.jpg','1385691838','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333295330','1','北京顺义区九州画室','50035','河北省石家庄市裕华区学苑路精英中学小学部容树平收','18932947587','50035','杨朝辉','13582126189','Signup/201311/5297fafcdd40a.JPG','Signup/201311/5297fafcdd40a_s.JPG','1385691900','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333116383','1','江苏省新沂市瓦窑中学','221438','江苏省新沂市瓦窑镇老街春来饭店','15715222605','221438','李夫松','15162051840','Signup/201311/5297fe3ad1cef.jpg','Signup/201311/5297fe3ad1cef_s.jpg','1385692730','0','2013112922124039','TRADE_SUCCESS','8aab780ddb28b211783e6a321fa861dd46','2013-11-29 10:36:17','15195491479','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333262554','1','吉林身白山市第二中学','134300','吉林省白山市解放中学','13943970803','134300','李晓萍','18643921803','Signup/201311/5298007dbebc2.jpg','Signup/201311/5298007dbebc2_s.jpg','1385693309','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333112558','1','江苏省新沂市瓦窑中学','221438','江苏省新沂市窑湾镇聚福园小区第六排','15195491479','221400','王兆举','15152456999','Signup/201311/529800c231975.jpg','Signup/201311/529800c231975_s.jpg','1385693378','0','2013112922302739','TRADE_SUCCESS','b87a84df6bcc70930b48cfc7c8240e9d46','2013-11-29 10:47:31','15195491479','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333206236','1','黑龙江鸡东县余山高中','158200','黑龙江鸡东县红少年小学','13199161377','158200','李春艳','18246723322','Signup/201311/52983e3703d09.JPG','Signup/201311/52983e3703d09_s.JPG','1385709110','0','2013112914112052','TRADE_SUCCESS','55f8468e7ff246314094acc6e3da0f334w','2013-11-29 15:20:29','a04870367a@126.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333188306','1','江苏省新沂市瓦窑中学','221438','江苏省新沂市马陵山路金色家园2号楼2单元302室','15862135507','221400','任志飞','13852070698','Signup/201311/52983edaa037a.jpg','Signup/201311/52983edaa037a_s.jpg','1385709274','0','2013112926553039','TRADE_SUCCESS','a6f0d7587d4f85b075af35d6a21939d846','2013-11-29 15:18:09','15195491479','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333287525','1','湖北省孝感市大悟县第一中学','432800','湖北省大悟县第一中学高三23班','18672297882','432800','谈保红','13617239927','Signup/201311/52983f10d1cef.jpg','Signup/201311/52983f10d1cef_s.jpg','1385709328','0','2013112978825528','TRADE_SUCCESS','61076df64a8a1d369f4912538a1e184f3k','2013-11-29 15:20:47','18672297882','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333210932','1','伊春市伊春区第二中学','153000','伊春市伊春区旭日街伊春区第二中学','13845899998','153000','王冬零','13796520858','Signup/201311/529840894c4b4.jpg','Signup/201311/529840894c4b4_s.jpg','1385709705','0','2013112950719154','TRADE_SUCCESS','738f065a94158e95b58a70cd9d1afbde50','2013-11-29 15:29:49','13845899998','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333240688','1','武汉大学附属中学','430072','湖北省武汉市武汉大学东湖新村117号','027-87163154','430072','张军华','13098804265','Signup/201311/52984248632ea.png','Signup/201311/52984248632ea_s.png','1385710152','0','2013112970589062','TRADE_SUCCESS','29f32fd4d9eb11187b23fd7fadf9c4615g','2013-11-29 15:37:00','chivas_he@126.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333123443','2','北京第一中学','100009','北京市朝阳区新源街21楼1门203号','010-64602086','100027','刘雪芬','13661088379','Signup/201311/5298424e501bd.jpg','Signup/201311/5298424e501bd_s.jpg','1385710158','0','2013112963746573','TRADE_SUCCESS','414aa05c9183acfb97b0526366b1914162','2013-11-29 15:38:12','ch8823@sina.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333278104','2','北京市太平路中学','100073','北京市丰台区华源二里6-1804','13501398205','100073','赵军','13501398205','Signup/201311/52984290d1cef.JPG','Signup/201311/52984290d1cef_s.JPG','1385710224','0','2013112946736471','TRADE_SUCCESS','e23b97c689db4eee832cb7fceddf14af5y','2013-11-29 15:44:06','13810719961','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333221812','1','哈尔滨市第32中学','150000','哈尔滨市南岗区西大直街215号南岗区妇产医院王明慧转','15590886656、0451-863','150080','王明慧','15590886656','Signup/201311/529843a139387.jpg','Signup/201311/529843a139387_s.jpg','1385710497','0','2013112965680499','TRADE_SUCCESS','644fe17b0346e23f19252594199d99967i','2013-11-29 15:44:59','15590886656','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333212541','1','内蒙古呼伦贝尔市鄂温克旗第二中学','21122','内蒙古呼伦贝尔市鄂温克旗第二中学','18347038105','21122','冯春玲','13722011973','Signup/201311/529843bca7d8c.jpg','Signup/201311/529843bca7d8c_s.jpg','1385710524','0','2013112961520436','TRADE_SUCCESS','4104a23589f1f56b7526201dd272173240','2013-11-29 15:45:20','18347038105','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333168717','2','吉林省公主岭市第一中学','136100','吉林省公主岭市岭西绿色家园八号联排别墅西边第一家','13944467873','136100','卫艳红','18643473440','Signup/201311/52984408af79e.jpg','Signup/201311/52984408af79e_s.jpg','1385710600','0','2013112940550333','TRADE_SUCCESS','164ac905f74b9a0e9ffa3d6689f1e4223u','2013-11-29 15:41:07','18643473440','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333200045','1','北京市通州区第三中学','101117','北京市通州区梨园镇云景里小区9-452','022-80818209','10010','王维军','13810296652','Signup/201311/5298452d7270e.jpg','Signup/201311/5298452d7270e_s.jpg','1385710893','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333289066','2','辽宁省兴城市第一高级中学','125100','辽宁省兴城市安居小区七号楼四单元202室','18642918486','125100','石秀梅','15541499166','Signup/201311/529845d06acfc.jpg','Signup/201311/529845d06acfc_s.jpg','1385711056','0','2013112946753871','TRADE_SUCCESS','3616c169144c804f57aceac61975545a5y','2013-11-29 15:49:12','18642918486','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333136141','1','内蒙古包头市北重三中','14030','内蒙古包头市青山区呼得木林大街4#街坊10栋13号','0472-3129293','14030','白涛','13847256387','Signup/201311/529849be3567e.jpg','Signup/201311/529849be3567e_s.jpg','1385712062','0','2013112908522742','TRADE_SUCCESS','7c82e9b2eca29d77d256421b7e45ade64c','2013-11-29 16:07:38','13847256387','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333260903','1','沈阳市拔萃中学','110011','沈阳市皇姑区鸭绿江街5-4号241','024-86898922','110032','刘波','13842021987','Signup/201311/52984bf63d090.JPG','Signup/201311/52984bf63d090_s.JPG','1385712630','0','2013112968329850','TRADE_SUCCESS','df853667d2582553d9388355b34372d44s','2013-11-29 16:13:58','13998260570','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333273438','2','涟水县第一中学','223400','江苏省淮安市涟水县第一中学','18351475107','223400','戴卫东','15949189958','Signup/201311/529850203567e.jpg','Signup/201311/529850203567e_s.jpg','1385713696','0','2013112911563325','TRADE_SUCCESS','6c420abc12eabf6363ab1ca8526a6edf3e','2013-11-29 16:35:30','18351475107','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333254613','1','四川省自贡市旭川中学','643020','四川省自贡市贡井区和平路15栋2单元2门附1号','13088326396','643020','罗胜利','13881438549','Signup/201311/5298531294c5f.JPG','Signup/201311/5298531294c5f_s.JPG','1385714450','0','2013112963988873','TRADE_SUCCESS','94780f3cfa07dce6518a1e13817fa2f162','2013-11-29 16:49:51','13990060251','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333262503','1','淮南市第二十八中','232180','安徽省凤台县城关镇','13705549855','232100','张传虎','13966452228','Signup/201311/529855a53567e.JPG','Signup/201311/529855a53567e_s.JPG','1385715109','0','2013112925322157','TRADE_SUCCESS','bfc87ef0323b540c25426f1602622d1d56','2013-11-29 16:54:40','13705549855','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333285934','2','山西省太谷县第二中学','30800','山西省介休市国税局','18635096881','32000','孟钰婷','15203545415','Signup/201311/529856c2a4083.jpg','Signup/201311/529856c2a4083_s.jpg','1385715394','0','2013112908750542','TRADE_SUCCESS','7778abe3f603251a94fa98cbf07051c94c','2013-11-29 17:07:05','menxue@sina.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333223412','1','贵阳远洋中学','551400','贵州省清镇市老马河远洋中学','18984110989','551400','郭堂杰','13885134126','Signup/201311/529857159c671.jpg','Signup/201311/529857159c671_s.jpg','1385715477','0','2013112977039520','TRADE_SUCCESS','4291d84ce4a1f63b3c799d75381462c734','2013-11-29 18:09:28','15620824200','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333246836','1','绥江一中','657700','云南省昭通市绥江县B12地块16栋','15096536811','657700','黄玉芹','18608701588','Signup/201311/52985730aba95.jpeg','Signup/201311/52985730aba95_s.jpeg','1385715504','0','2013112939976356','TRADE_SUCCESS','9aee1f788b72c90190de8c3c37327bec54','2013-11-29 17:27:12','15096536811','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333270332','1','吉林省吉林市永吉实验高中','132106','吉林省永吉县口前镇平安御园饭店','13578520326','132100','郎红丽','15144312211','Signup/201311/5298577ae1113.JPG','Signup/201311/5298577ae1113_s.JPG','1385715578','0','2013112951102654','TRADE_SUCCESS','0e2a1bfabf3abb18ab2ffc75051764eb50','2013-11-29 17:15:00','15144312200','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333267113','1','安徽省程集中学','246523','安徽省宿松县程集中学','0556-7962717','246523','叶海军','13622048617','Signup/201311/529858fa40d99.JPG','Signup/201311/529858fa40d99_s.JPG','1385715962','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333260919','2','江苏省淮安市涟水县第一中学','223400','涟水县第一中学','0517-82322339','223400','谢正旭','1885231613','Signup/201311/52985b544c4b4.jpg','Signup/201311/52985b544c4b4_s.jpg','1385716564','0','2013112923546474','TRADE_SUCCESS','6052419f8f65d25c0d2030dc721d8c1964','2013-11-29 18:59:08','18852312613','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333264054','1','北京市中桥外国语学校','100073','北京市海淀区老营房路世纪城春荫园10-5-8G','18600193196','100097','李淑贤','18635726016','Signup/201311/52985f76e4e1c.JPG','Signup/201311/52985f76e4e1c_s.JPG','1385717622','0','2013112934700090','TRADE_SUCCESS','e9f01ffd360674320d473f470f64f5b170','2013-11-29 17:41:40','13903576016','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333273476','1','山西省大同市广灵县第一中学校','37500','山西省大同市广灵县第一中学校','0352-8995059','37500','王雅妮','13152825744','Signup/201311/52985ff240d99.jpg','Signup/201311/52985ff240d99_s.jpg','1385717746','0','2013112926898257','TRADE_SUCCESS','614fd8051c494a77157e7dbbdc51826e56','2013-11-29 18:27:36','13753251918','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333023000','1','吉林市第二中学','132000','吉林省吉林市船营区北宁里市场管理处','18743274101','132000','曹忠勋','13159575681','Signup/201311/52986087e8b25.jpg','Signup/201311/52986087e8b25_s.jpg','1385717895','0','2013112951237154','TRADE_SUCCESS','120d697dbf7b8ab0d7e75d356deb3e1d50','2013-11-29 17:52:12','13614428143','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333237544','1','吉林省吉林市第二中学','132013','吉林省吉林市丰满区中环西街一号楼7单元一楼右门孙林收','15843257485','132013','孙金波','13943292212','Signup/201311/52986243cdfe6.jpg','Signup/201311/52986243cdfe6_s.jpg','1385718339','0','2013112968666750','TRADE_SUCCESS','b09f68ef4240044cad7c254a94217f834s','2013-11-29 17:55:29','15843257485','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333298496','1','北京市延庆县第二中学','102100','北京市延庆县延庆镇下水墨村116号','13641118839','102100','朱江宽','13381272628','Signup/201311/529862bc5b8d8.jpg','Signup/201311/529862bc5b8d8_s.jpg','1385718460','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333295320','1','邯郸市赵都实验中学','56002','邯郸市丛台区联防路亚太康乐苑小区2号楼3单元11号','15530040164','56002','黄利彩','15132036633','Signup/201312/529a804fe1113.jpg','Signup/201312/529a804fe1113_s.jpg','1385718633','0','2013112961745370','TRADE_SUCCESS','38936caacaa0186a8bfce6e562e1c3725w','2013-11-29 17:58:47','15530040164','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333292157','1','北京市东城区第一六五中学','100010','北京市朝阳区十里堡北里31楼2单元503号','010-85837633','100025','孙毓伟','13693579170','Signup/201311/5298647bd59f8.jpg','Signup/201311/5298647bd59f8_s.jpg','1385718907','0','2013112977004120','TRADE_SUCCESS','7abdc694744293dcce1a6b56927a0d9a34','2013-11-29 18:00:25','15110248685','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333281262','1','四川省名山中学','625100','四川省名山县蒙阳镇茶都大道123号1幢2号','15283513542','625100','郝勇','13881610202','Signup/201311/529864fda037a.jpg','Signup/201311/529864fda037a_s.jpg','1385719037','0','2013112923665906','TRADE_SUCCESS','6130ce1423384941c4615e065bb323052c','2013-11-29 18:24:49','13881610202','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333235978','2','贵州省六盘水市六枝特区第一中学','0','贵州省六盘水市六枝特区第一中学','18216846770','553400','但承芳','15086487259','Signup/201311/5298653844aa2.jpg','Signup/201311/5298653844aa2_s.jpg','1385719096','0','2013112966192799','TRADE_SUCCESS','dd2fe75d923230a172e9323adab225cd7i','2013-11-29 18:09:37','18216846770','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333220336','1','江苏省宝应中学','225800','翔宇花园13幢501室','13651519663','225800','郑渡广','13651519663','Signup/201311/529865e7f0537.jpg','Signup/201311/529865e7f0537_s.jpg','1385719271','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333268717','2','北京教育学院附属中学','100035','北京西城区长椿街三庙小区2号楼5门101','13621186581','100053','尹燕东','13521847305','Signup/201311/5298672566ff3.jpg','Signup/201311/5298672566ff3_s.jpg','1385719589','0','2013112938195093','TRADE_SUCCESS','e9a90415821a228e4788e712478e3c1376','2013-11-29 18:13:35','13621186581','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333200052','1','湖北省孝感市英才外国语学校','432000','湖北省孝感市城站路38号建行孝感分行','13377833087','432000','蔡京生','18727550228','Signup/201311/5298686fcdfe6.jpg','Signup/201311/5298686fcdfe6_s.jpg','1385719919','0','2013112964306773','TRADE_SUCCESS','c2d51264fa36a8bb15ea0cb2f6986d6262','2013-11-29 18:16:39','jhhlf@yahoo.cn','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333206266','1','北京市延庆县第二中学','102100','北京市延庆县第二中学','13683642532','102100','陈文生','18911416506','Signup/201311/529868cea4083.JPG','Signup/201311/529868cea4083_s.JPG','1385720014','0','2013113073508417','TRADE_SUCCESS','190727147800c1b9cab8377483e35c342y','2013-11-30 13:17:22','18701630918','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333212532','1','吉林市第二中学','132000','吉林省吉林市丰满区渤海山水云天高层一号楼一单元1602','13614324211','132000','刘宝玲','15572529999','Signup/201311/5298696944aa2.jpg','Signup/201311/5298696944aa2_s.jpg','1385720169','0','2013112951370554','TRADE_SUCCESS','a6dcf7807cecb0d308546f33e65def0d50','2013-11-29 18:22:00','13614428143','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333251571','1','江苏省贾汪中学','221011','江苏省徐州市贾汪区耐火厂南宿舍69号','13952237887','221011','王嘉琪','15150066503','Signup/201311/529869d80f424.jpg','Signup/201311/529869d80f424_s.jpg','1385720280','0','2013112929833439','TRADE_SUCCESS','e331af18b6a71ab7f4e55ea88eb38ea946','2013-11-29 18:25:24','15150066503','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333193720','1','江川一中','652600','云南省玉溪市红塔区龙马华庭2幢2单元602室','13708776411','653100','1398778310','0','','','1385720556','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333287534','2','上海市奉贤区曙光中学','201411','上海市奉贤区江海镇新建西路638弄43号202室','15026415668','201499','张刚强','13564402635','Signup/201311/52986c531312d.jpg','Signup/201311/52986c531312d_s.jpg','1385720915','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333206213','1','辽宁锦州铁路高级中学','121000','辽宁省锦州市古塔区解放路三段19号','0416-3149207','121000','李迪','13704964101','Signup/201311/52986cc144aa2.jpg','Signup/201311/52986cc144aa2_s.jpg','1385721025','0','2013112941719445','TRADE_SUCCESS','0d8fdb90095ee688d32cc444776de4c84i','2013-11-29 18:35:45','liyou5ld2@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333254683','1','辽宁省沈阳市回民中学','110000','沈阳市和平区南五经街20号122','13940063381','110000','陈戈枫','15998128918','Signup/201311/5298720a632ea.jpg','Signup/201311/5298720a632ea_s.jpg','1385722378','0','2013112968397324','TRADE_SUCCESS','52cae4c6767ac8fe5506427b58efdaef3c','2013-11-29 18:59:27','15998128918','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333228143','2','吉林省通化市二道江区通钢一中','134003','吉林省通化市二道江区通钢一中','18804357649','134003','魏亚君','15943507281','Signup/201311/529874710b71b.JPG','Signup/201311/529874710b71b_s.JPG','1385722993','0','2013112930483239','TRADE_SUCCESS','94b9888459d269c0444b172439594e5b46','2013-11-29 19:08:39','18804357649','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333135808','1','呼和浩特铁路局包头职工子弟第一中学','14040','内蒙古包头市东河区工业路西二区一号楼3号底店(天骄烟酒)','15034710717','14040','张素泽','15124899194','Signup/201311/5298773c7a120.jpg','Signup/201311/5298773c7a120_s.jpg','1385723708','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333218712','1','泰山外国语学校','271000','山东省泰安市泰山区南湖小区19号楼 2单元 602室','15552839266','271000','郭佚婧','18653879674','Signup/201311/5298773d5b8d8.JPG','Signup/201311/5298773d5b8d8_s.JPG','1385723709','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333256213','1','徐州经济技术开发区高级中学','221131','徐州经济技术开发区高级中学大黄山镇','051683375213','221131','吴亚','15105215725','Signup/201311/52987a3144aa2.jpg','Signup/201311/52987a3144aa2_s.jpg','1385724465','0','2013113039970486','TRADE_SUCCESS','e5f004f66be3ad92772cb538c4bd7ced6s','2013-11-30 18:35:55','15250945791','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333119839','1','邯郸市第七中学','56000','邯郸市丛台区学步桥沁园小区6-5-10','0310-11185','56000','杨丹丹','13752521671','Signup/201311/52987b4776417.jpg','Signup/201311/52987b4776417_s.jpg','1385724743','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333179662','1','北京市苹果园中学','100041','北京市石景山区金顶街四区4栋85号','13601156699','100041','刘换如','13621367689','Signup/201311/52987bda16e36.JPG','Signup/201311/52987bda16e36_s.JPG','1385724890','0','2013112912453725','TRADE_SUCCESS','deba9f7edf6b8cf0b7d67185da2ded043e','2013-11-30 21:15:01','13717885678','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333278177','2','河北省邯郸市第二中学','56000','河北省邯郸市邯山区马头工业城后刘街9号',' 15931036055 ','56046','刘照','13463034670','Signup/201311/52987bedb71b0.jpg','Signup/201311/52987bedb71b0_s.jpg','1385724909','0','2013112924155974','TRADE_SUCCESS','2fbde016718e27998c87f9417087320664','2013-11-29 19:42:02','422654396@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333276576','1','通州二中','101100','北京市通州区宋庄镇小杨庄','13520080575','101118','张萌','13520080575','Signup/201311/52987d51b34a7.jpg','Signup/201311/52987d51b34a7_s.jpg','1385725265','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333214023','1','江苏省徐州市第36中学','221008','江苏省徐州市泉山区云龙公园北门王陵路1-3-102（请走玻璃门）','13407542718   0516-8','221006','许梦宇','13013985970','Signup/201311/52987d9000000.jpg','Signup/201311/52987d9000000_s.jpg','1385725328','0','2013112971634817','TRADE_SUCCESS','5c97d418550b2fb12c3e9ab82cab36692y','2013-11-29 19:46:49','1123793012@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333134641','1','北京市通州区第二中学','101100','北京市通州区马驹桥镇新海北里7号楼4单元202室','13520843922','101102','赵国强','13701162356','Signup/201311/52987df57a120.jpg','Signup/201311/52987df57a120_s.jpg','1385725429','0','2013112924382558','TRADE_SUCCESS','b424a568e9aecb886c4b7b2c70c0dcea58','2013-11-29 19:58:05','13701162356','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333226543','2','首都师范大学附属中学永定分校','102300','北京市海淀区清河清景园3-2-503','18211098303','100192','贾国华','18210387105','Signup/201311/52987e76d1cef.jpg','Signup/201311/52987e76d1cef_s.jpg','1385725558','0','2013112958446063','TRADE_SUCCESS','2cb052bc6ab2039b8f843b5e7a7f0c8b5i','2013-11-29 19:54:43','13522369757','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333201516','2','天津市四合庄中学','300300','天津市东丽区新立街汇海南里24号楼701','13752750699','300300','李学兰','13752611665','Signup/201311/52988187501bd.jpg','Signup/201311/52988187501bd_s.jpg','1385726343','0','2013112951751454','TRADE_SUCCESS','a7abee5d4974d0c64caea1393e938fb950','2013-11-29 20:04:50','15822034097','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333218794','2','紫云中学','300456','天津市塘沽区紫云园7-1-1102','13516281360','300456','朱锦艳','15522387290','Signup/201311/529884018583b.jpg','Signup/201311/529884018583b_s.jpg','1385726977','0','2013112968172630','TRADE_SUCCESS','5896e1ea5fbc01e8daf1da760061cc003o','2013-11-29 20:24:02','15522387290','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333259306','1','安徽省肥西县实验高级中学','231200','安徽省肥西县实验高级中学','13514993476','231200','陈传如','18297908059','Signup/201311/529888c498968.jpg','Signup/201311/529888c498968_s.jpg','1385728196','0','2013112976982738','TRADE_SUCCESS','d8c1b6e4e6208c352d632d3e0adcfe7e44','2013-11-29 20:34:03','13685514399','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333259322','2','北京一中','100009','北京市东城区青年湖小区东里18号楼407','13501220169','100710','臧秀兰','13718521798','Signup/201311/52988a323d090.jpg','Signup/201311/52988a323d090_s.jpg','1385728562','0','2013112908260509','TRADE_SUCCESS','518b8ae30099686eeddd49e67068632b2i','2013-11-29 20:45:12','13611372085','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333243788','2','牛栏山一中实验学校','101300','北京市昌平区东小口镇华龙苑南里7—4—301','13671266742','102209','何升文','13811295670','Signup/201311/52988a932dc6c.jpg','Signup/201311/52988a932dc6c_s.jpg','1385728659','0','2013112935250898','TRADE_SUCCESS','3e497f29bb72d073efaa8b73ffc62f227g','2013-11-29 20:58:48','13716823918','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333209319','1','江苏省连云港市板浦高级中学','222000','江苏省连云港市新浦区沈圩桥农贸市场F1-08','13815613958','222000','李桂平','13812432559','Signup/201311/52988d5b98968.jpg','Signup/201311/52988d5b98968_s.jpg','1385729371','0','2013112962418770','TRADE_SUCCESS','09c1d080dbb1c172d11b17e78d8b943d5w','2013-11-29 21:22:47','753816266@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333217141','1','江苏省宿迁市马陵中学','223800','宿迁市经济开发区金桂花园小区','18205245675','223800','李斌','13732687257','Signup/201311/52988ed52dc6c.jpg','Signup/201311/52988ed52dc6c_s.jpg','1385729749','0','2013112925782591','TRADE_SUCCESS','476870b8b7807dab9ddc5a369453449a72','2013-11-29 22:02:36','18205245675','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333232833','2','北京市顺义区第九中学','101300','北京市顺义区第九中学','13811461457','101300','罗学军','13693511866','Signup/201311/52988f1bbebc2.jpg','Signup/201311/52988f1bbebc2_s.jpg','1385729819','0','2013113046573927','TRADE_SUCCESS','53ede710d41be4491c6c2a698da083bb3i','2013-11-30 11:32:57','13641089815','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333251536','2','永吉县第四中学','132200','永吉县第四中学','15144310602','132100','1514432060','13944256897','Signup/201311/5298957b81b32.jpg','Signup/201311/5298957b81b32_s.jpg','1385731451','0','2013112976689546','TRADE_SUCCESS','161cc867bc97fc798cb171d5a62fb84b4k','2013-11-29 22:23:37','15126362356','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333223434','1','瓦房店市第四高级中学','116302','辽宁省大连市瓦房店市得利寺镇邮局','13889234681','116301','于传波','15942640519','Signup/201311/529898da0f424.jpg','Signup/201311/529898da0f424_s.jpg','1385732314','0','2013112971553269','TRADE_SUCCESS','4cae5207f0a372c196664ad9a616b6fa5u','2013-11-29 21:48:30','guoguotingting@sina.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333217120','2','哈尔滨第十九中学','150080','哈尔滨市南岗区清滨路11号第十九中学','18345167899','150080','贾长荣','13946008789','Signup/201311/5298993631975.jpg','Signup/201311/5298993631975_s.jpg','1385732406','0','2013112924585306','TRADE_SUCCESS','b2264e8ba0e4ac5cfe8959792962a3432c','2013-11-29 21:47:10','15145099735','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333195330','2','浙江省诸暨市草塔中学','311800','浙江省诸暨市大唐镇方田村1177号','0575-87735022','311800','李伟东','13456586106','Signup/201311/52989d85d59f8.jpg','Signup/201311/52989d85d59f8_s.jpg','1385733509','0','2013112932654923','TRADE_SUCCESS','ea5353e6988e7b4f052e1ffed5222fc03a','2013-11-29 22:11:33','15314752636','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333074271','1','青岛艺术学校','266012','山东省青岛市大连路18号青岛艺术学校','18687072673','266012','王庆辉','15318791182','Signup/201311/52989e2d8d24d.jpg','Signup/201311/52989e2d8d24d_s.jpg','1385733677','0','2013113079251220','TRADE_SUCCESS','a50059a16d39b817a7dc9907859d994e34','2013-11-30 13:37:17','bzshuangshutobby@sohu.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333242133','2','淮安市清浦中学','223002','淮安市清浦区恒大名都5号楼1305室','13952327583','223002','谢晓林','13382332993','Signup/201311/5298a31cd9701.jpg','Signup/201311/5298a31cd9701_s.jpg','1385734940','0','2013112936815237','TRADE_SUCCESS','a9c357fffc1ef4ccca829df0c794630342','2013-11-29 22:26:52','13852358867','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333296857','1','洪江区第一中学','418200','湖南省怀化市洪江区第一中学','15115107850','418200','易争光','13874543387','Signup/201311/5298a3e56ea05.jpg','Signup/201311/5298a3e56ea05_s.jpg','1385735141','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333273432','2','北京市第三中学','100035','北京市西城区马连道中新佳园17号楼3单元803','13301330225','100055','周燕明','13301330699','Signup/201311/5298a98b6ea05.jpg','Signup/201311/5298a98b6ea05_s.jpg','1385736587','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333220312','1','江苏省邳州市官湖高级中学','221300','江苏省邳州市新城区文苑路党校宿舍北楼101室','18451555478','221300','顾玲','15862106395','Signup/201311/5298adeb81b32.jpg','Signup/201311/5298adeb81b32_s.jpg','1385737707','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333271842','2','北京拔萃双语学校','100018','北京市朝阳区单店西路15号院17号楼1单元902室','85379877','100018','张洪霞','13901163006','Signup/201311/5298b04b1ab3f.jpg','Signup/201311/5298b04b1ab3f_s.jpg','1385738315','0','2013112902955880','TRADE_SUCCESS','1b05455e93ca1b2c60a92f26bfd0b4896g','2013-11-29 23:27:00','13901163006','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333267143','1','玉溪市第一中学','653100','玉溪市红塔区太极路21号','0877-3058749','653100','岳秋波','13577065935','Signup/201311/5298b22c5b8d8.jpg','Signup/201311/5298b22c5b8d8_s.jpg','1385738796','0','2013112937912710','TRADE_SUCCESS','3f38b7045135d98d2c959020625a865b2k','2013-11-30 13:49:30','13577065935','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333203113','1','吉林省吉林市田家炳高级中学','132000','吉林省吉林市丰满区华山路888号中环滨江花园Eleven便利店','18604324218','132013','金星','15904325000','','','1385739020','0','2013112969499332','TRADE_SUCCESS','7a9e1ad5973927b89b0aaa047a9f05543s','2013-11-29 23:35:19','wenyan.1986.love@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333262522','1','鹰潭市第一中学','335000','江西省鹰潭市二中宿舍','13870015497','335000','潘建华','18970167292','Signup/201311/5298b848b71b0.jpg','Signup/201311/5298b848b71b0_s.jpg','1385740360','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333229633','1','河北省邯郸市钢苑中学','56001','河北省邯郸市中华南大街109','03103260107','56001','1510007102','13131063228','Signup/201311/5298bd7f76417.jpg','Signup/201311/5298bd7f76417_s.jpg','1385741695','0','2013113013129125','TRADE_SUCCESS','9ab0e1a022838f5b77bdc390786bb39d3e','2013-11-30 00:32:48','15100071024','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333332854','2','首医大附中','100069','北京市韩庄子西里17号楼0704','13811552162','100070','1326320320','13683206611','Signup/201311/5298beebc28cb.jpg','Signup/201311/5298beebc28cb_s.jpg','1385742059','0','2013113000547628','TRADE_SUCCESS','e2b62b642f7191e3e7e5883d61d8efd93k','2013-11-30 00:32:26','13683206611','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333323443','2','贵阳九中','550002','贵阳市小河区山水黔城5组团3栋3单元1402','18585414206','550009','朱艳萍','13511971888','Signup/201311/52993497af79e.jpg','Signup/201311/52993497af79e_s.jpg','1385772183','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333217135','2','淮安市第一中学','223002','江苏省淮安市清浦区槐树路27号百家丽涂料有限公司','13337975005','223002','朱其艳','13337975005','Signup/201311/529938330b71b.jpg','Signup/201311/529938330b71b_s.jpg','1385773107','0','2013113036031739','TRADE_SUCCESS','9a8b3ab7660e1a535a07afc879c98a4246','2013-11-30 09:01:40','13337975005','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333367142','1','江苏省淮安市清浦中学','223002','江苏省淮安市富春花园B01幢三单元606','13770484486','223001','邢宗玉','13952318498','Signup/201311/52993a56a037a.jpg','Signup/201311/52993a56a037a_s.jpg','1385773654','0','2013113007908664','TRADE_SUCCESS','cb9e21727d8f2404e3f5c55ac33b92235k','2013-11-30 09:19:36','18061919301','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333240678','1','安徽省淮南市第四中学','232001','安徽省淮南市朝阳中路42号市环保局徐作社收','13955406077','232001','徐作社','13956435768','Signup/201311/52993afe03d09.jpg','Signup/201311/52993afe03d09_s.jpg','1385773822','0','2013113068756159','TRADE_SUCCESS','c61acf2c3052d77e3960766d53da0f6b5a','2013-11-30 09:15:35','15055400640','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333396896','1','四川省乐山市井研中学','613100','乐山市井研中学','18981350938','613100','张利军','15386545498','Signup/201311/5299405d57bcf.jpg','Signup/201311/5299405d57bcf_s.jpg','1385775197','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333354666','1','淮安市第一中学','223002','江苏省淮安市清浦区化工新村5区10幢503室','15996155812','223002','刘翠萍','15851742862','Signup/201311/529940892625a.jpg','Signup/201311/529940892625a_s.jpg','1385775241','0','2013113001330692','TRADE_SUCCESS','cd8fb0d73c8f73a6f47ef4c40702c0fa74','2013-11-30 09:41:51','13515236162','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333387525','1','铁岭市第四高级中学','112000','铁岭市第四高级中学三年三班','15841016116','112000','刘臣','13304108857','Signup/201311/5299429103d09.jpg','Signup/201311/5299429103d09_s.jpg','1385775761','0','2013113065802573','TRADE_SUCCESS','8f90ad27393dee21580aa6e36313b45162','2013-11-30 09:46:04','18641052227','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333190657','1','江苏省灌云高级中学','222200','江苏省灌云县富园广场13幢三单元405室','0518-88652266','222200','掌迎春','18761339992','Signup/201311/529943240b71b.jpg','Signup/201311/529943240b71b_s.jpg','1385775908','0','2013113020663418','TRADE_SUCCESS','07cd7eea99a713285c6b263aaa2f66fe30','2013-11-30 09:50:44','18761339992','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333293720','1','济南市外国语学校','250107','山东省济南市历城区山大南路27号山东大学经济学院','13791044519','250100','刘庆林','13869117198','Signup/201311/5299472d81b32.jpg','Signup/201311/5299472d81b32_s.jpg','1385776941','0','2013113025123840','TRADE_SUCCESS','1be93448578424e26e220cd4f5ec619b48','2013-11-30 10:21:17','claudia10@sina.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333343716','1','江苏省淮安市涟水县第一中学','223400','涟水县第一中学','0517-82322339','223400','方璇','13852303538','Signup/201311/5299475603d09.jpg','Signup/201311/5299475603d09_s.jpg','1385776982','0','2013113033701374','TRADE_SUCCESS','70965de39c7154ab026771cf25a6044f64','2013-11-30 14:15:05','18852312613','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333317194','2','四川省内江市第六中学','641199','四川省内江市 东兴区 红牌路一巷3号 （加油站对面的冰雪副食店）','18989117571','641199','钟向东','13890564457','Signup/201311/529951ab1312d.jpg','Signup/201311/529951ab1312d_s.jpg','1385779627','0','2013113045953893','TRADE_SUCCESS','ea69992402618c685bcce4ee22789d9776','2013-11-30 10:52:36','duringthelove@foxmail.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333248432','2','静海四中','301600','静海县静海镇东方红路东段益明五金','13102087176','301600','兰健','13163005209','Signup/201311/5299557b07a12.jpg','Signup/201311/5299557b07a12_s.jpg','1385780603','0','2013113076065268','TRADE_SUCCESS','bf8fdd78d28b4569f3aa6124d371f5815s','2013-11-30 11:08:42','13102087176','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333320334','1','牛栏山一中实验学校','101301','北京市海淀区北太平庄路27号铁道部党校工运教研部','13641363093','100088','李晓燕','13662100821','Signup/201311/529957786ea05.jpg','Signup/201311/529957786ea05_s.jpg','1385781112','0','2013113018518000','TRADE_SUCCESS','b74e5f84fe1b3feb1f74393ac129dfaf20','2013-11-30 11:34:49','424186563@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333368717','2','辽宁省营口大石桥市第一高中','115100','辽宁省大石桥市供电局','13514178722','115100','宫绍忠','13840703199','Signup/201311/52995a0429f63.jpg','Signup/201311/52995a0429f63_s.jpg','1385781764','0','2013113076256326','TRADE_SUCCESS','211ad73b16ba7dc7ce33aa114fdd1e803g','2013-11-30 11:59:55','13840703199','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333314035','2','昌平区实验中学','102200','北京市昌平区振兴路','010-69703548','102200','高靓','13311231681','Signup/201311/52995a9281b32.jpeg','Signup/201311/52995a9281b32_s.jpeg','1385781906','0','2013113026886191','TRADE_SUCCESS','ce0051354685ba5c4821cb2d70e4f36072','2013-11-30 12:40:15','13911297699','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333346896','1','当涂二中','243100','安徽省当涂县青莲花园东区7号楼407室','13855529299 ','243100','陈新宏','15955512751','Signup/201311/52995aa1aba95.jpg','Signup/201311/52995aa1aba95_s.jpg','1385781921','0','2013113035076857','TRADE_SUCCESS','612a741ebd6fa2fd2d41096a94f6a35c56','2013-11-30 11:28:40','dongxu84@hotmail.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333304613','2','北京市延庆县第三中学','102100','北京市延庆县第四小学','15910312188','102100','辛建设','13811002901','Signup/201311/529963fdaf79e.JPG','Signup/201311/529963fdaf79e_s.JPG','1385784317','0','2013113000384177','TRADE_SUCCESS','99699c3568298b3e2b821b142e2a5b4a6a','2013-11-30 12:10:03','lizm2008yq@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333290666','1','吉林省吉林市田家炳高级中学','132000','吉林省吉林市丰满区华山路888号中环滨江花园Eleven便利店','18604324218','132013','金星','15904325000','Signup/201311/52996536bebc2.jpg','Signup/201311/52996536bebc2_s.jpg','1385784630','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333301545','2','北京市通州区第三中学','101101','北京市通州区梨园镇专场南里4号楼4083','13718162473','101101','邱振海','13717603018','Signup/201311/5299683bcdfe6.jpg','Signup/201311/5299683bcdfe6_s.jpg','1385785403','0','2013113079105420','TRADE_SUCCESS','c9f676caa22b5575e433f1ac1ad1a76834','2013-11-30 12:27:45','13522867452','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333253183','2','吉林省吉林市第二高级中学','132013','吉林省吉林市昌邑区华滩小区英才楼1-5-15号','13147777439','132013','曹伟峰','13614326201','Signup/201311/529969076acfc.jpg','Signup/201311/529969076acfc_s.jpg','1385785607','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333251533','1','内蒙古乌海市第十中学','16040','内蒙古乌海市海勃湾区北方民爆器材有限公司温海军收','13644733413','16040','温凯蒂','13847355672','Signup/201311/52996a415b8d8.jpg','Signup/201311/52996a415b8d8_s.jpg','1385785921','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333309310','1','北京市延庆县第三中学','102100','北京市延庆县第三中学','18701158027','102100','张根石','15910900706','Signup/201311/52996a9f1e848.jpg','Signup/201311/52996a9f1e848_s.jpg','1385786015','0','2013120146411256','TRADE_SUCCESS','1ad0177cae3b5031a036ce0167c63a5a54','2013-12-01 14:12:04','18701158027','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333375077','1','山东省济南市济南中学','250001','山东省济南市青年东路5号1号楼1单元401','18053157521','250011','袁敏','13791079152','Signup/201311/52996b343d090.jpg','Signup/201311/52996b343d090_s.jpg','1385786164','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333106236','1','吉林省吉林市第二中学','132013','吉林省吉林市高新区恒山西路六号恒山路浴池游泳馆','15506025730','132013','王振伟','15526533300','Signup/201311/52996bb781b32.jpg','Signup/201311/52996bb781b32_s.jpg','1385786295','0','2013113026192406','TRADE_SUCCESS','3e3af567438d0f50ac2341b17abafad92c','2013-11-30 12:42:29','zuojingtao@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333183296','1','河北省张家口市沙城中学','75400','河北省张家口市怀来县沙城中学高三364班','15512316922','75400','曹欣欣','13636392630','Signup/201311/52996ce090f56.jpg','Signup/201311/52996ce090f56_s.jpg','1385786592','0','2013113009918709','TRADE_SUCCESS','c5b9086df835c7d356496ca18394d5ed2i','2013-11-30 12:47:54','caoxin235@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333353113','2','江苏省盐城市东台市第一中学','224200','江苏省东台市茶城花园22号505市','0515-85236771','224200','金玉','18914666380','Signup/201311/52996d4d76417.jpg','Signup/201311/52996d4d76417_s.jpg','1385786701','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333315635','2','成都高新实验中学','610041','四川省成都市高新区紫荆西路27号','18080445670','610041','杨春霞','13678130495','Signup/201311/5299df07d59f8.jpg','Signup/201311/5299df07d59f8_s.jpg','1385787095','0','2013113010015687','TRADE_SUCCESS','80c94e17880e275a01ae1d6680994d756u','2013-11-30 12:55:45','skyclot@sina.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333390657','1','山西省大同三中','37006','金地福苑4-2-901','13633423330','37006','史雅楠','13903525464','Signup/201311/52996f2a487ab.jpg','Signup/201311/52996f2a487ab_s.jpg','1385787178','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333328106','1','广西壮族自治区富川高级中学','542799','广西贺州市富川公路管理局','13978477933','542799','李建丽','18278476161','Signup/201311/52996f301312d.jpg','Signup/201311/52996f301312d_s.jpg','1385787184','0','2013113036872298','TRADE_SUCCESS','c833c729b333b79f7f19b52e90d262897g','2013-11-30 12:57:01','13978477933','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333275038','1','本溪满族自治县高级中学','117100','辽宁省本溪市本溪满族自治县锦绣花园2-601','04146880149','117100','杨巍','13941426497','Signup/201311/52996fd30b71b.jpg','Signup/201311/52996fd30b71b_s.jpg','1385787347','0','2013113069514059','TRADE_SUCCESS','485ae6638640a9f8f6b7386c357086785a','2013-11-30 16:05:39','18698859828','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333351583','1','阜阳市第一中学','236000','阜阳市第一中学高三九班','15398166716','236000','刘宇','13956684368','','','1385788057','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333340673','1','吉林省吉林市第二中学','132013','吉林省吉林市昌邑区运河里小区1号楼三单元5楼右门侯跃光收','13079761618','132001','侯振鹏','13079761618','Signup/201311/529974afec82e.jpg','Signup/201311/529974afec82e_s.jpg','1385788591','0','2013113018929700','TRADE_SUCCESS','0737a4db88ce9c2999e3ce401f96f4e120','2013-11-30 13:19:40','15506022007','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333370317','2','安徽省太湖中学','246400','安徽省太湖县房管局白蚁防治所','0556—4168584','246400','杨燕','13966646988','Signup/201311/529976a122551.jpg','Signup/201311/529976a122551_s.jpg','1385789089','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333304666','1','江苏省淮安市洪泽县第二中学','223100','江苏省淮安市洪泽县共和镇共和村共和组4号','051787581248','223100','1377194012','15722951021','Signup/201311/5299781f8583b.jpg','Signup/201311/5299781f8583b_s.jpg','1385789471','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333331292','1','北京市清华志清中学','100084','北京市房山区良乡拱辰大街10号楼1051号','18201643395','102401','裴秀梅','13161218505','Signup/201311/52997b4eb71b0.JPG','Signup/201311/52997b4eb71b0_s.JPG','1385790286','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333335978','1','江苏省淮安市涟水县第一中学','223400','涟水县红日中学','13651560574','223400','熊士银','13818069500','Signup/201311/52997c31e1113.jpg','Signup/201311/52997c31e1113_s.jpg','1385790513','0','2013113054532378','TRADE_SUCCESS','f4d2d342ee5c8ba0fa62fd40b7cbc2bf6c','2013-11-30 14:05:00','13651560574','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333360919','1','宝坻一中','301800','天津市宝坻区中天城市风景1号楼2单元1102','15822812928','301800','张学芹','13072252277','Signup/201311/52997d128d24d.jpg','Signup/201311/52997d128d24d_s.jpg','1385790738','0','2013113009257235','TRADE_SUCCESS','c8cda41e9525f3d6597d58251e10687c3y','2013-11-30 14:08:35','15822812928','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333382891','2','红兴隆第一高级中学','155811','红兴隆管理局第一高级中学','0469-5560209','155712','刘静','13555035860','','','1385790847','0','2013113068499647','TRADE_SUCCESS','1785588ee6e45b6ff8444b597f0505564m','2013-11-30 14:02:56','13555035860','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333332892','2','内江三中','641000','四川省内江市东兴区东桐路238号','0832-2265531','641000','李丽霞','13118466992','Signup/201311/52997df17270e.jpg','Signup/201311/52997df17270e_s.jpg','1385790961','0','2013113028455153','TRADE_SUCCESS','ee535cfec705444ecdfb4369b2904c7b4y','2013-11-30 14:11:03','13668353776','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333276520','1','江苏省徐州市第三十六中学','221000','江苏省徐州市新建南村129号','0516-87837127','221000','苗士美','15862262695','Signup/201311/52997e8db34a7.jpg','Signup/201311/52997e8db34a7_s.jpg','1385791117','0','2013113013466902','TRADE_SUCCESS','341afac82bfb30976018f7ca1704514c24','2013-11-30 14:03:06','15862262695','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333376520','1','吉林二中','132013','吉林省吉林市船营区天北小区6-3-45','13321504325','132000','赵悦含','13944602016','Signup/201311/529980ab90f56.jpg','Signup/201311/529980ab90f56_s.jpg','1385791659','0','2013113010291387','TRADE_SUCCESS','242c2a671c8b769c50177411209bd2cf6u','2013-11-30 14:20:13','18604470628','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333354613','1','普兰店市高级中学','116200','辽宁省普兰店市普兰店高级中学高三班','13841156190','116200','王琦','18501358620','Signup/201311/529984c5f0537.jpg','Signup/201311/529984c5f0537_s.jpg','1385792709','0','2013113040258297','TRADE_SUCCESS','3c1d4be02230be744f5bac7c869591687e','2013-11-30 14:33:42','miqi1017@gmail.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333321812','2','保定同济中学','71000','河北省保定市千禧园4号楼2单元1201','15284226625','71000','孙蕊','15095260830','Signup/201311/5299864e2dc6c.jpg','Signup/201311/5299864e2dc6c_s.jpg','1385793102','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333317112','2','天津市崇化中学','300120','天津市红桥区本溪花园2号楼3门101','18622350207','300131','韩晓琳','13820395545','Signup/201311/5299866622551.jpg','Signup/201311/5299866622551_s.jpg','1385793126','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333320336','2','辽宁省灯塔市第一高级中学','111300','辽宁省辽阳市白塔区中心路9号汤河水库管理局','15041935832','111000','项丽媛','15941936650','Signup/201311/529987fe22551.jpg','Signup/201311/529987fe22551_s.jpg','1385793534','0','2013113027545591','TRADE_SUCCESS','91a686d98bde937a79519605a8d1368072','2013-11-30 14:42:27','15041935832','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333293766','1','湖北省洪湖市文泉中学','433200','洪湖市玉沙路3号','15571637327','433200','林文方','15571637327','Signup/201311/52998c6c98968.JPG','Signup/201311/52998c6c98968_s.JPG','1385794668','0','2013113077846982','TRADE_SUCCESS','d6cc480c6fc2ea875a1dc598bc4b72986k','2013-11-30 15:03:09','962705529@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333339073','1','北京市通州区第三中学','101100','北京市通州区马驹桥镇南小营村','15600197710','101103','李国银','13693257145','Signup/201311/52998ce7d9701.jpg','Signup/201311/52998ce7d9701_s.jpg','1385794791','0','2013120141231286','TRADE_SUCCESS','e4f4e8c617d33906ca85d056d7e850f76s','2013-12-01 08:09:52','starfiah@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333246871','2','山东平邑实验中学','273300','北京大兴天堂何37楼3单元501','13341081563','102609','向庆利','13601258584','Signup/201311/529990bda4083.JPG','Signup/201311/529990bda4083_s.JPG','1385795773','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333335944','1','内蒙古通辽市奈曼旗第一中学','28300','内蒙古通辽市奈曼旗大镇王府街创正电脑城','13804758309','28300','宋艳东','13847592566','Signup/201311/5299913a3567e.jpg','Signup/201311/5299913a3567e_s.jpg','1385795898','0','2013113037579790','TRADE_SUCCESS','d1347f2c47c6e2d7b2afd41f9c37dde470','2013-11-30 15:40:21','13804758309','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333303116','2','邳州市东方学校','221300','江苏省徐州市邳州市镇北一路东方学校','0516-86626166','221300','冯仰东','13914861878','Signup/201311/5299939890f56.jpeg','Signup/201311/5299939890f56_s.jpeg','1385796504','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333356274','1','岚县高级中学','35200','山西省太原市小店区人民南路19号中铁十二局第二工程有限公司14号楼2单元3楼','13191066638','30032','郭岩君','13989909522','Signup/201311/529994527270e.jpg','Signup/201311/529994527270e_s.jpg','1385796690','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333357874','1','贵州省遵义市遵义县第三中学','563100','贵州省遵义市遵义县第三中学','15085116763','563100','谭涛','18585701424','Signup/201311/529998bac28cb.jpg','Signup/201311/529998bac28cb_s.jpg','1385797818','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333356266','1','安源中学','337055','江西省萍乡市安源区安源镇坝善冲10号','18307092638','337035','1830709263','15079034287','','','1385798039','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333353183','1','贵州省贵阳市清镇市远洋中学','551400','贵州省贵阳市清镇市远洋中学','13195106189','551400','王芳','13195106189','Signup/201311/52999a31ec82e.jpg','Signup/201311/52999a31ec82e_s.jpg','1385798193','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333171395','2','铁岭市第二高级中学','112000','铁岭市第二高级中学三年十班','18741092013','112000','孙瑞清','13898229987','Signup/201311/52999b2c6acfc.jpg','Signup/201311/52999b2c6acfc_s.jpg','1385798444','0','2013113008457181','TRADE_SUCCESS','bb851e167c14c9bc0d00cc682444dc036i','2013-11-30 16:11:58','18741062017','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333387534','1','萍乡中学','337055','江西省萍乡市高坑镇和平村23栋','15070984273','337000','黄竹英','13979916529','Signup/201311/52999b80ca2dd.jpg','Signup/201311/52999b80ca2dd_s.jpg','1385798528','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333384328','1','江苏省淮安市清浦中学','223002','江苏省淮安市清浦区解放西路214号3区2号楼204室','18252352078','223002','陈玉娥','18252352078','Signup/201311/52999bad8583b.jpg','Signup/201311/52999bad8583b_s.jpg','1385798573','0','2013113049302707','TRADE_SUCCESS','3a90a556534528d9ae2dbdd033b907292e','2013-12-01 12:59:54','18252352078','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333256274','1','北京市剑桥中学','101116','北京市朝阳区定福庄西里一号北京电力建设公司焊接公司刘刚收','13681507605','100024','刘刚','13661080521','Signup/201311/52999c3fa037a.jpg','Signup/201311/52999c3fa037a_s.jpg','1385798719','0','2013120101966719','TRADE_SUCCESS','3af3a887ccd88636f80d0723e07e84ac32','2013-12-01 10:56:39','15100657091','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333351571','2','黑龙江省大庆市第28中学','163114','黑龙江省杜尔伯特蒙古族自治县工业和科技信息化局付亚杰','15145927456','166200','朱秀楠','13766777108','Signup/201311/52999e17f0537.jpg','Signup/201311/52999e17f0537_s.jpg','1385799191','0','2013113029451834','TRADE_SUCCESS','12bc689ee4c0ef19e1f6b0ca0b1641973w','2013-11-30 16:16:17','13766777108','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333359322','1','四川省西充县晋城中学','637200','四川省西充县晋城中学高三三班','0817-4221870','637200','杨倩宇','14781743923','Signup/201311/5299a0963d090.jpg','Signup/201311/5299a0963d090_s.jpg','1385799830','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333325043','1','江苏省淮安市涟水县第一中学','223400','江苏省淮安市涟水县第一中学','18901401505','223400','李成学','13851054132','Signup/201311/5299a21a81b32.jpg','Signup/201311/5299a21a81b32_s.jpg','1385800218','0','2013113073005114','TRADE_SUCCESS','b07522ce614dce237a23a31f1135f68d2s','2013-11-30 16:33:49','15216777780','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333385998','2','江西省萍乡市芦溪中学','337200','江西省萍乡市安源区青山镇下柳源村农民街','13979909026','337000','1397990902','13479130057','Signup/201311/5299a366d1cef.jpg','Signup/201311/5299a366d1cef_s.jpg','1385800550','0','2013113071217924','TRADE_SUCCESS','b01c1791b8c8ea9c7bd3d9588253f7913c','2013-11-30 16:40:10','928178300@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333215641','1','四川省绵阳市绵阳一中','621000','四川省绵阳市游仙区沈家坝街17号交通局','08162291280','621000','任韵蔚','13330900443','Signup/201311/5299a379a4083.jpg','Signup/201311/5299a379a4083_s.jpg','1385800569','0','2013113070366159','TRADE_SUCCESS','0a4d8eec3b9d3b416d294ac2653b9a8d5a','2013-11-30 17:30:34','13330900443','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333379604','1','成都经济技术开发区实验高级中学','610100','四川省成都市龙泉驿区龙华二期A区7栋1单元3楼303号','13550099967','610100','1355009996','15928145162','Signup/201311/5299aa3ca4083.jpg','Signup/201311/5299aa3ca4083_s.jpg','1385802300','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333318712','1','辽宁省灯塔市第一高级中学','111300','辽宁省灯塔市盘龙路5-1号楼4单元201室','13274199053（0419-828','111300','董辉','18693194949','Signup/201311/5299ab4d1ab3f.jpg','Signup/201311/5299ab4d1ab3f_s.jpg','1385802573','0','2013113078302782','TRADE_SUCCESS','c4ff437dc56a4449209ff426d57369ac6k','2013-11-30 17:16:05','lovesjl923@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333392157','1','泸县二中','646100','四川省泸州市江阳区龙透关百竹园西区','15682307516','646000','廖玉兰','13548353568','Signup/201311/5299ac4290f56.jpg','Signup/201311/5299ac4290f56_s.jpg','1385802818','0','2013113039660786','TRADE_SUCCESS','1c7a6153159b1516724d5510227ed0146s','2013-11-30 17:16:26','liaoyulan123@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333384304','1','江苏省盐城市田家炳中学','224000','江苏省盐城市亭湖区黄海东路32-1寿疆印字社','13270078516','224000','夏琴','18662013501','Signup/201311/5299acd929f63.jpg','Signup/201311/5299acd929f63_s.jpg','1385802969','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333395320','1','河北省石家庄市正定县弘文中学','50800','河北省石家庄市正定县正华花园28号楼3单元202室','13630836429','50800','王会英','13472152718','Signup/201311/5299ad758d24d.jpg','Signup/201311/5299ad758d24d_s.jpg','1385803125','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333390698','2','城南中学','315191','浙江省宁波市高新区凌云路1177号7号楼一层，兆峰电子有限公司','13967831201','315000','黄红琴','13967831201','Signup/201311/5299adb2f0537.png','Signup/201311/5299adb2f0537_s.png','1385803186','0','2013113070492759','TRADE_SUCCESS','d1c4641be90082640793971134d0ae305a','2013-12-01 09:24:42','13805873954','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333268733','1','南通市第二中学','226000','江苏省南通市崇川区易家桥新村188-706','13912286335','226000','施惠娟','13901483576','Signup/201311/5299ae4b7de29.jpg','Signup/201311/5299ae4b7de29_s.jpg','1385803339','0','2013113047134310','TRADE_SUCCESS','6af2b897d2c4155bb17caa8e5aa4a4b92k','2013-11-30 17:30:55','18206291491','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333396857','1','哈尔滨市第十九中学','150000','哈尔滨市道外区化工路173号','13836177586','150000','王登滨','13936680088','Signup/201311/5299ae9839387.jpg','Signup/201311/5299ae9839387_s.jpg','1385803416','0','2013113028153391','TRADE_SUCCESS','0d7bc6c24e2c83b415bc019d41d2bb4672','2013-11-30 17:29:05','13836177586','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333360922','3','新民市第一高级中学','110300','新民市富康花园1号楼7号门市','024－62272627','110300','王学余','18640491065','Signup/201311/5299af6f3567e.jpg','Signup/201311/5299af6f3567e_s.jpg','1385803631','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333353171','2','绵阳第一中学','621000','四川省绵阳市涪城区警钟街78号','15281612520','621000','罗华','15281615631','Signup/201311/5299b0f6c28cb.jpg','Signup/201311/5299b0f6c28cb_s.jpg','1385804022','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333332810','2','四合庄中学','300300','天津市东丽区新立街城上村三区五排十号','15102207871','300300','向小丽','18722180907','Signup/201311/5299b229a4083.png','Signup/201311/5299b229a4083_s.png','1385804329','0','2013120123028600','TRADE_SUCCESS','98ba8db2818503ae632583f529e5554b20','2013-12-01 15:51:35','15620649418','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333137534','1','塘沽滨海中学','300451','天津市塘沽区吉林路吉安里10-2-502','15122290363','300451','李月芳','13212234210','Signup/201311/5299b37c81b32.jpg','Signup/201311/5299b37c81b32_s.jpg','1385804668','0','2013113040965757','TRADE_SUCCESS','5c5ed299ea1f13442a3b9b9f0edd791f56','2013-11-30 17:47:57','13821420531','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333309366','2','福田中学','337006','2819808799@qq.com','15279960422','337006','1387995907','13767895509','Signup/201311/5299b68700000.jpg','Signup/201311/5299b68700000_s.jpg','1385805447','0','2013113071529724','TRADE_SUCCESS','b5f646ca50a417af4c3fe543812914a23c','2013-11-30 18:01:12','928178300@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333331286','2','辽宁省绥中县利伟高中三年十二班','0','辽宁省绥中县利伟高中三年十七班','13898781127','125200','李佳欣','13898781127','Signup/201311/5299b76989544.jpg','Signup/201311/5299b76989544_s.jpg','1385805673','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333362519','1','双流中学','610200','四川省双流县广场路双流中学','13982053267','610200','刘英','18781996276','Signup/201311/5299b7932625a.jpg','Signup/201311/5299b7932625a_s.jpg','1385805715','0','2013113052656093','TRADE_SUCCESS','e0fbc713db703c7951a15367a797eaa376','2013-11-30 18:10:05','13982053267','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333329606','1','天津市第五十一中学','300121','天津市红桥区西青道15号楼702','022-27716151','300122','吴静','13821645653','Signup/201311/5299bb2b94c5f.jpg','Signup/201311/5299bb2b94c5f_s.jpg','1385806635','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333034641','1','云天化中学','657800','云南省昭通市水富县云天化中学高149班','18608703625','657800','张涛','13700674055','Signup/201311/5299bc3c1e848.jpg','Signup/201311/5299bc3c1e848_s.jpg','1385806908','0','2013113004844985','TRADE_SUCCESS','3b5093b3c1ed74de5134b51ebcf0a8576q','2013-11-30 18:46:52','18608703625','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333214025','2','北京科技大学附属中学','100083','中关村南三街16号','13681135262','100080','路先生','13681135262','Signup/201311/5299be27bebc2.jpg','Signup/201311/5299be27bebc2_s.jpg','1385807399','0','2013113071896432','TRADE_SUCCESS','28abe56c43897429ffc6be834ba614683s','2013-11-30 18:50:54','15611022997','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333198452','1','江苏省淮安市淮阴区棉花中学','223311','江苏省淮安市欧洲城2栋501','0517-83792039','223002','童芳','15996162277','Signup/201311/5299bffb44aa2.jpg','Signup/201311/5299bffb44aa2_s.jpg','1385807867','0','2013113078718282','TRADE_SUCCESS','4f2f1487235b24e7eedea3b2c42c305d6k','2013-12-01 11:13:18','15805234120','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333317130','1','山东省济南市第二中学','250100','山东省济南市市中区经四路济南人民商场振华商厦贵宾室','15854108434','250001','孙捷','15168880662','Signup/201311/5299c2d9baeb9.jpg','Signup/201311/5299c2d9baeb9_s.jpg','1385808601','0','2013113039637837','TRADE_SUCCESS','dfd9fd35d5339d81c7e6ae45a19f469142','2013-11-30 19:02:22','15864535669','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333215635','2','江苏省南京市金陵中学河西分校','210000','江苏省南京市建邺区庐山路华隆兴寓6栋23单元202室','025-57355395','210000','陶虹','15195935878','Signup/201311/5299c460ca2dd.jpg','Signup/201311/5299c460ca2dd_s.jpg','1385808992','0','2013113007572651','TRADE_SUCCESS','057981ef6f075c7224f07ea5428827184u','2013-11-30 19:01:32','abcd121213@126.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333304616','2','天津耀华滨海学校','300163','天津市东丽区华明镇岭昌里7号楼1门401','13102215138','300300','1892026883','13702105068','Signup/201311/5299c56dd9701.jpg','Signup/201311/5299c56dd9701_s.jpg','1385809261','0','2013113059693460','TRADE_SUCCESS','61c0c3684975cf7aeeef814c6044e2245c','2013-11-30 19:33:48','18920268836','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333270317','1','安徽省肥西实验高级中学','231200','安徽省肥西实验高级中学','0551-2565588','231200','程大凤','13695608537','Signup/201311/5299c5ca81b32.jpg','Signup/201311/5299c5ca81b32_s.jpg','1385809354','0','2013120108214476','TRADE_SUCCESS','178537e5a5bf11a8bb7cf1f33bf1a0e468','2013-12-01 10:23:53','ruidong.meng@foxmail.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333337578','1','四川省遂宁市遂宁中学外国语实验学校','629000','四川省遂宁市船山区凯东路凯南四巷遂州宾馆宿舍','18982562328','629000','张梓炀','13568728831','Signup/201311/5299c5d0af79e.jpg','Signup/201311/5299c5d0af79e_s.jpg','1385809360','0','2013113069575347','TRADE_SUCCESS','d80e61abb8819ba091541709772eae824m','2013-11-30 19:06:30','13568728831','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333312541','2','北京市通州区第三中学','101100','北京市通州区物资学院路新建村','18311050691','101100','王强','13717691559','Signup/201311/5299c82a1e848.jpg','Signup/201311/5299c82a1e848_s.jpg','1385809962','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333385934','2',' 广西壮族自治区河池市河池高中','547000','广西壮族自治区河池市河池高中','15078605231','547000','何善南','13517589236','Signup/201311/5299ca0f3d090.jpg','Signup/201311/5299ca0f3d090_s.jpg','1385810447','0','2013113002953028','TRADE_SUCCESS','2220b83f21a557bedc5f7d28e874140f3k','2013-11-30 19:49:56','15078605231','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333353133','1','贵州省贵阳市白云区兴农中学','550014','贵州省贵阳市白云区通化路兴农中学','15185111644','550014','吴建军','18708502325','Signup/201311/5299ccef89544.jpg','Signup/201311/5299ccef89544_s.jpg','1385811183','0','2013113061807601','TRADE_SUCCESS','8ca21436a9b74c0f509cee821f08a0a122','2013-11-30 20:46:32','18925076778','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333376538','1','成都市成飞中学','610091','成都市二仙桥西路5号','028-83249752','610051','罗培俊','13880056566','Signup/201311/5299d0ae66ff3.jpg','Signup/201311/5299d0ae66ff3_s.jpg','1385812142','0','2013120153621339','TRADE_SUCCESS','4de0bd934bb862c9e45aebd0153b0c7a46','2013-12-01 15:38:13','532291703@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333321896','1','吉林市第二中学','132013','吉林市龙潭区金珠乡兴华村二组','15143214048','132104','孙忠华','13894723379','Signup/201311/5299d154a037a.jpg','Signup/201311/5299d154a037a_s.jpg','1385812308','0','2013113069775199','TRADE_SUCCESS','1e06a0a897d3167969e7a6a8c08720d27i','2013-11-30 20:07:42','wodejia515@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333354683','1','哈尔滨市第七十三中学','150086','南岗区保健路130号','13101665008','150086','李淑文','18345167561','Signup/201311/5299d18f8583b.jpg','Signup/201311/5299d18f8583b_s.jpg','1385812367','0','2013113041430197','TRADE_SUCCESS','4f36ccddcce433e754f7b83ea9915c887e','2013-11-30 19:57:08','13101665008','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333331210','1','北京青年政治学院附属中学','100013','北京市朝阳区崔各庄乡东辛店','15510187869','100013','马瑞萍','15801195069','Signup/201311/5299d299ec82e.jpg','Signup/201311/5299d299ec82e_s.jpg','1385812633','0','2013120146204656','TRADE_SUCCESS','c2d9f8df562e43bdf608d1778f80109554','2013-12-01 11:31:16','18801375368','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333339012','1','天津市扶轮中学','300142','天津市河北区王串场六号路71号（津工超市151）','022-26423915','300150','朱学兰','15822869126','Signup/201311/5299d4d429f63.jpg','Signup/201311/5299d4d429f63_s.jpg','1385813204','0','2013113067913973','TRADE_SUCCESS','ac275a0916bd9168a946b8a3a3920d7762','2013-11-30 20:09:55','739008092@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333318794','1','辽宁省本溪市第三高级中学','117014','辽宁省本溪市第三高级中学','0414-3803611','117014','孟雪妍','15084267099','Signup/201311/5299d4dd3567e.jpg','Signup/201311/5299d4dd3567e_s.jpg','1385813213','0','2013113077988468','TRADE_SUCCESS','092fd90efcd34917ff750f83168f29dd5s','2013-11-30 20:18:19','www.bfwc@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333350016','2','合肥六中','230061','安徽省合肥市长江路397号第六中学南区','0551-62858277','230061','彭胜文老师','13966768070','','','1385814500','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333357883','3','北京市顺义区第二中学','101300','北京市顺义区马坡香悦四季三区4号2门102','13511030456','101300','张学英','15810021285','Signup/201311/5299da161312d.jpg','Signup/201311/5299da161312d_s.jpg','1385814550','0','2013113021792875','TRADE_SUCCESS','3fd5a7e62fe1792fe883b4094ed1fcc766','2013-11-30 20:35:21','13511030456','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333300013','1','合肥市第五中学','230051','安徽省合肥市第五中学高三一班梅琳','13355697988','230051','王军','13395519837','Signup/201311/5299dd6d00000.jpg','Signup/201311/5299dd6d00000_s.jpg','1385815405','0','2013120116571183','TRADE_SUCCESS','2d2b7ce652a0dd51c12b3269808301566m','2013-12-01 13:06:03','zhaofbin@sina.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333285998','1','首医大附中','100000','北京市大兴区西红门镇福利农场同华园6号楼6门402','13146788199','100000','李华','13146200492','Signup/201311/5299dd71ec82e.jpg','Signup/201311/5299dd71ec82e_s.jpg','1385815409','0','2013120167149036','TRADE_SUCCESS','6ad2d5fe37b9505639cce2cc37931bfe40','2013-12-01 11:47:57','13146788199','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333268742','1','天津南开艺术中学','300113','天津市南开区黄河道天香水畔19-5','13920800207','300110','马毅','18622152988','Signup/201311/5299dec06ea05.jpg','Signup/201311/5299dec06ea05_s.jpg','1385815744','0','2013113074775569','TRADE_SUCCESS','967c9046c0ad99ec608b7b418f60e5955u','2013-11-30 20:52:36','18622152988','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333317132','1','浙江省杭州市萧山区第五高级中学','311201','浙江省杭州萧山区临浦镇南秀苑11幢202室','13738030002','311251','孔金桥','18958150618','Signup/201311/5299def6dd40a.jpg','Signup/201311/5299def6dd40a_s.jpg','1385815798','0','2013113069932099','TRADE_SUCCESS','330720f5b28101123f07905cd8ad8bb67i','2013-11-30 20:54:22','18958150618','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333342191','2','贵阳市乌当中学','550018','贵阳市乌当区东风镇头堡村六组','15285140739','550018','邵金友','13037827495','Signup/201311/5299e13f29f63.jpg','Signup/201311/5299e13f29f63_s.jpg','1385816383','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333337544','1','辽宁省本溪市第三高级中学','117014','辽宁省本溪市第三高级中学','15841424382','117014','许佳','13504145517','Signup/201311/5299e2c55f5e1.jpg','Signup/201311/5299e2c55f5e1_s.jpg','1385816773','0','2013113011722009','TRADE_SUCCESS','f4ab550af4006336a3cd01c46a4afb1c2i','2013-11-30 21:18:15','13504145517','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333343773','2','齐齐哈尔市恒昌中学','161006','黑龙江省齐齐哈尔市恒昌中学东门','15245201753','161006','杨满','15946489170','Signup/201311/5299e436501bd.jpg','Signup/201311/5299e436501bd_s.jpg','1385817142','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333203116','1','江苏省宿迁市马陵中学','223800','江苏省宿迁市宿城区耿车镇建材路16栋8号','052784213941','223800','蔡广','13815772725','Signup/201311/5299e9691ab3f.jpg','Signup/201311/5299e9691ab3f_s.jpg','1385818473','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333287577','2','天津市第四十五中学','300000','天津市河东区万辛庄大街凤麟公寓2号楼4单元201室','15022412068','300161','窦玉云','13512218125','Signup/201311/5299ea065f5e1.jpg','Signup/201311/5299ea065f5e1_s.jpg','1385818630','0','2013113020801900','TRADE_SUCCESS','bafe4037cc25540c1af92c21fe46636920','2013-11-30 21:41:13','13821212277','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333332833','1','淄川一中','255100','山东省淄博市淄川区雁阳路290号淄博锦宏水泥有限公司五号楼三单元二楼西户','15069353249','255100','高涛','13869387264','Signup/201311/5299ea137270e.jpg','Signup/201311/5299ea137270e_s.jpg','1385818643','0','2013113044954233','TRADE_SUCCESS','8d617737ed4e943a66c534b6c49b22273u','2013-11-30 21:43:51','15949745370','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333350071','2','成都市盐道街外语学校','610225','成都市新都区大丰镇三元大道59号','028-83915232','610504','蒋才能','13308048425','Signup/201311/5299ec48a7d8c.jpg','Signup/201311/5299ec48a7d8c_s.jpg','1385819208','0','2013113072661950','TRADE_SUCCESS','12282cfa073ecfead1b539db7c8735084s','2013-12-01 10:17:27','15388134320','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333173438','1','四川省遂宁市船山区遂宁中学外国语实验学校','629000','四川省遂宁市船山区嘉禾东路国土资源局','13882558150','629000','杨国勇','18682529947','Signup/201311/5299eca33d090.jpg','Signup/201311/5299eca33d090_s.jpg','1385819299','0','2013113072677850','TRADE_SUCCESS','72a3cdab1c0b1735452b1bf98c25c1204s','2013-11-30 22:56:27','13882520353','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333395330','2','黑龙江省双鸭山市三十一中学','155100','黑龙江省双鸭山市三利商城负二层大财海鲜','15246868689','155100','陈春梅','15246868229','Signup/201311/5299eca4baeb9.jpg','Signup/201311/5299eca4baeb9_s.jpg','1385819300','0','2013113020866400','TRADE_SUCCESS','ca81248ea7838f3b3cf0ff1e4aed7a0720','2013-11-30 21:59:06','13555185452','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333264036','2','四川省德阳市第三中学','618000','四川省德阳市旌阳区第三中学','13550647174','618000','马玉凤','18090728816','Signup/201311/5299ecaba4083.jpg','Signup/201311/5299ecaba4083_s.jpg','1385819307','0','2013113015257502','TRADE_SUCCESS','4e259031c7ab494cb7bac40239b100cc24','2013-11-30 22:50:05','15892857525','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333101516','1','哈尔滨德强中学','150038','哈尔滨市道里区尚志胡同35号6栋2单元202室','0451-84684360','150010','董光','15301688168','Signup/201311/5299efb17a120.jpg','Signup/201311/5299efb17a120_s.jpg','1385820081','0','2013113030155653','TRADE_SUCCESS','77140433c04f36c885087ccfe977c9044y','2013-11-30 22:12:33','sdh9988@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333323412','1','北京北大附属实验学校','100070','北京市丰台区草桥欣园一区7楼1-1802','13910128723','100067','王铭利','18686010612','Signup/201311/5299f35c29f63.jpg','Signup/201311/5299f35c29f63_s.jpg','1385821020','0','2013113020951700','TRADE_SUCCESS','fb722e03277810a0238b32a4d3401d6a20','2013-11-30 22:27:05','13910128723','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333312532','1','江苏省淮安市清浦中学','223002','江苏省淮安市经济开发区迎宾大道27号鼎立香榭丽花苑A3一单元','0517-85451259','223005','1351151720','18761018434','Signup/201311/5299f60d2dc6c.jpg','Signup/201311/5299f60d2dc6c_s.jpg','1385821709','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333387538','2','北京第六十三中学','100053','北京市宣武区广外甘石桥远见名苑15号楼1405','15901335468','100055','王连慧','13661098047','Signup/201311/5299fd8957bcf.JPG','Signup/201311/5299fd8957bcf_s.JPG','1385823625','0','2013113068470373','TRADE_SUCCESS','6e76e2f0cbc2e581b8b50b264dbcb77c62','2013-11-30 23:16:12','15901335468','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333373438','1','贵阳市第九中学','550002','贵州省贵阳市南明区遵义路314号（遵义路干休所18楼01号）','13511956831','550002','徐梅','13885039175','Signup/201311/5299fe006acfc.jpg','Signup/201311/5299fe006acfc_s.jpg','1385823744','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333376532','1','河北省石家庄市第十五中学','50061','河北省石家庄市裕华区东风东路205号青园街小学宿舍1-1-501','13932139179','50000','崔振逢','13739767422','Signup/201311/529a01bc76417.jpg','Signup/201311/529a01bc76417_s.jpg','1385824700','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333300052','1','江川县第一中学','652600','云南省玉溪市峨山彝族自治县玉溪市民族中学高三（2）班','15608773810','653200','吴琳','13987791983','Signup/201311/529a03f39c671.jpg','Signup/201311/529a03f39c671_s.jpg','1385825267','0','2013120176836517','TRADE_SUCCESS','5e891cc685b5fcbd856097d2a27406c72y','2013-12-01 14:56:34','15608773810','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333393757','1','绵阳东辰国际学校','621000','绵阳市涪城区剑南路西段16号绵阳供电公司','13989285509','621000','李卫民','13981105130','Signup/201311/529a0481d59f8.jpg','Signup/201311/529a0481d59f8_s.jpg','1385825409','0','2013113041057105','TRADE_SUCCESS','9cd4efc7e34848263f3c5f59197d13672a','2013-11-30 23:33:55','fangfangtu1@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333315632','2','四川省崇州市蜀城中学','611230','四川省崇州市一品江山10栋1单元17楼1号','028-82155462','611230','庹凤祥','18780223731','Signup/201311/529a067c39387.jpg','Signup/201311/529a067c39387_s.jpg','1385825916','0','2013120110829381','TRADE_SUCCESS','74ae0114d587e3691323e04ed382c0916i','2013-12-01 11:51:01','18780295730','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333342173','1','北京市六一中学','100142','北京市复兴路83号西21楼丁门11号','13641069625','100039','刘迪','13683235823','Signup/201312/529a117e0f424.JPG','Signup/201312/529a117e0f424_s.JPG','1385828734','0','2013120145385133','TRADE_SUCCESS','7ea0f06853c5f92ba40235f5d0491b2f3u','2013-12-01 10:42:48','13641069625','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333437534','1','河北隆尧一中','55350','北京市丰台区太平桥东里6号楼2门602','15632612953','100073','许少霞','15601211886','Signup/201312/529a174b89544.jpg','Signup/201312/529a174b89544_s.jpg','1385830219','0','2013120119576716','TRADE_SUCCESS','1aacb08a4775c3137013a73ae19b96832w','2013-12-01 09:27:54','15632612953','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333257866','2','成都高新实验中学','610041','四川省成都市高新区新雅街4号2栋2单元14号','18081871809','610041','母亲','15351228199','Signup/201312/529a286b81b32.jpg','Signup/201312/529a286b81b32_s.jpg','1385834603','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333485934','2','贵阳市乌当中学','550018','贵阳市乌当区温泉路温泉花园（西区）B栋2单元204','15885019229','550018','余光祥','13595108879','Signup/201312/529a878116e36.jpg','Signup/201312/529a878116e36_s.jpg','1385858945','0','2013120173187832','TRADE_SUCCESS','ee30c4c9eab5ac3c0da0278044833b4b3s','2013-12-01 10:04:44','347924509@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333471876','1','山西省大同市同煤二中','352','山西省大同市齿轮厂20-4-9','0352-2420927','352','王红伟','13994455910','Signup/201312/529a8b7c8583b.jpg','Signup/201312/529a8b7c8583b_s.jpg','1385859964','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333393796','1','延庆三中','102100','北京市延庆县旧县镇闫庄村东场街北四巷18号','18210683254','102109','闫红梅','13716122069','','','1385860615','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333181291','1','牡丹江市第二中学','157005','牡丹江市东安区东七条路120号','0453-8915878','157005','蒋云飞','13766661171','Signup/201312/529a908890f56.JPG','Signup/201312/529a908890f56_s.JPG','1385861256','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333307836','2','吉林省实验中学','130022','吉林省长春市吉林省实验中学高三18班1855','13756279619','130022','李延燕','18946660016','Signup/201312/529a933589544.jpg','Signup/201312/529a933589544_s.jpg','1385861941','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333390642','1','徐州市昕昕中学','221000','徐州市建国小区27号楼2单元101室','0516-82154388','221000','爸爸','18796214216','Signup/201312/529a9461a4083.JPG','Signup/201312/529a9461a4083_s.JPG','1385862241','0','2013120112792487','TRADE_SUCCESS','6e8f88a899669844ae347b9fdf44a9bc6u','2013-12-01 09:53:00','13952196758','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333360903','2','北京市私立汇才中学','100037','北京市海淀区双榆树东里13楼4门203号','01082134963','100086','尹琳','13511085676','Signup/201312/529a999598968.jpg','Signup/201312/529a999598968_s.jpg','1385863573','0','2013120179257826','TRADE_SUCCESS','469b6e901ff6650743151e06ec0e21ca3g','2013-12-01 10:22:24','13511085676','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333335910','2','贵州省贵阳市乌当中学','550018','贵州省贵阳市乌当中学高三七班','15285156518','550018','金仕国','13639005768','Signup/201312/529a9cb7d59f8.jpg','Signup/201312/529a9cb7d59f8_s.jpg','1385864375','0','2013120128370331','TRADE_SUCCESS','a0494960d2b460303eb339cfdfc887ff3q','2013-12-01 10:39:35','15285186518','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333367113','1','内蒙古呼和浩特市第十八中学','10020','内蒙古呼和浩特市赛罕区大学西街第十八中学传达室','15049135338','10020','石磊','13171039007','Signup/201312/529a9da966ff3.jpg','Signup/201312/529a9da966ff3_s.jpg','1385864617','0','2013120100868295','TRADE_SUCCESS','c34769d8748a5e80d94e3c19a76341d07a','2013-12-01 10:36:12','13171039007','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333498452','1','太原市第二中学校','30031','山西省太原市小店区晋阳街南三巷2号楼东单元204号','15234102688','30031','刘菊芳','15536504246','Signup/201312/529a9de2a037a.jpg','Signup/201312/529a9de2a037a_s.jpg','1385864674','0','2013120145934933','TRADE_SUCCESS','3f7e78e8fa4d14a7524cbb5557fb22643u','2013-12-01 10:27:39','18235133117','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333450071','3','塘沽二中','300450','天津市塘沽区宁波道远洋里10-6-1702','13821338091','300450','曹建军','13821338091','Signup/201312/529aa21d07a12.jpg','Signup/201312/529aa21d07a12_s.jpg','1385865757','0','2013120106481185','TRADE_SUCCESS','63be16c09ead05fb1cb45ca5b5f70c566q','2013-12-01 10:45:17','15822360129','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333487525','1','四川省凉山州西昌市第一中学','615000','四川省凉山州会理县南街100号','13795601880','615100','裴四玲','15328151966','Signup/201312/529aa48e16e36.jpg','Signup/201312/529aa48e16e36_s.jpg','1385866382','0','2013120166988536','TRADE_SUCCESS','dfc4a4d1f095979f271f3d5ddd5bfecb40','2013-12-01 11:02:21','13795601880','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333393732','1','浙江省金华市第六中学','321000','浙江省金华市婺州街46号申华新村2幢4单元202室','13586977487','321000','方寅','18857904808','Signup/201312/529aa4e99c671.jpg','Signup/201312/529aa4e99c671_s.jpg','1385866473','0','2013120131213353','TRADE_SUCCESS','03f3ac5f3670be4aba7572a6c4bf3a3b4y','2013-12-01 11:07:30','387705170@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333384391','2','铁岭市高级中学','112000','铁岭市高级中学','13188408787','112000','朱瑞','13050835955','Signup/201312/529aa632bebc2.jpg','Signup/201312/529aa632bebc2_s.jpg','1385866802','0','2013120139820198','TRADE_SUCCESS','af3e1d8197064a4006ad1345269235047g','2013-12-01 11:14:22','15141850817','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333406236','1','内江一中','641100','四川省内江市市中区沿江路新宇大厦A栋1701','13118069576','641000','余应芝','13219562662','Signup/201312/529aa9ef632ea.jpg','Signup/201312/529aa9ef632ea_s.jpg','1385867759','0','2013120111534388','TRADE_SUCCESS','1dfac2b11bc36ba20f5978541f60f0d76w','2013-12-01 14:55:20','13118069576','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333453113','3','金华市永康明珠中学','321300','浙江省金华市永康明珠中学','18006505617','321300','施笑容','15058587317','Signup/201312/529aaa8d6ea05.jpeg','Signup/201312/529aaa8d6ea05_s.jpeg','1385867917','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333400045','2','浙江海盐元济高级中学','314300','浙江海盐元济高级中学高三（15）班','13967325222','314300','李瑾','13967325222','Signup/201312/529aaaa78583b.jpg','Signup/201312/529aaaa78583b_s.jpg','1385867943','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333493720','2','首师大附中永定分校','102300','北京市门头沟区永定镇曹各庄村委会','60863320','102300','张新雷','13621169809','Signup/201312/529aae547270e.JPG','Signup/201312/529aae547270e_s.JPG','1385868884','0','2013120102336020','TRADE_SUCCESS','433385bce42c5a658bf37a278613169934','2013-12-01 11:38:51','13621169809','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333485998','1','江苏省宝应县中学','225800','江苏省宝应县国泰花苑12幢四车库','18757127068','225800','周辉','18115491868','Signup/201312/529aaeacaf79e.jpg','Signup/201312/529aaeacaf79e_s.jpg','1385868972','0','2013120144465021','TRADE_SUCCESS','c526cd0c33c08d124b8ee327970eaafc36','2013-12-01 11:41:10','18757127068','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333426506','1','北京市实美','100037','北京市西城区白纸坊建功南里小区5-803','010-83530613','100054','李思蒙','13911275875','Signup/201312/529aaeba1312d.jpg','Signup/201312/529aaeba1312d_s.jpg','1385868986','0','2013120152786339','TRADE_SUCCESS','ad68e7b6785fd531b89486546e2b906546','2013-12-01 11:41:01','13521726596','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333495330','2','辽宁省沈阳市青松中学','110101','沈阳市苏家屯区金桔二路6号231','024-89158383','110102','李景玲','15566136199','Signup/201312/529ab16131975.jpg','Signup/201312/529ab16131975_s.jpg','1385869665','0','2013120101245595','TRADE_SUCCESS','2cf6df653f556f714f2ea3fe44f3b09f7a','2013-12-01 12:15:41','15566136199','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333296820','1','天津市军粮城中学','300301','天津市东丽区无瑕街滨暇里11号楼4门301','13114889386','300301','1392084911','18020016825','Signup/201312/529ab29e44aa2.jpg','Signup/201312/529ab29e44aa2_s.jpg','1385869982','0','2013120128706331','TRADE_SUCCESS','f520e6b5ba69fc500898653e7efc928b3q','2013-12-01 12:00:38','18020016825','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333426576','1','沈阳市回民中学','110001','沈阳市和平区文体西路100-5 413','024-23345010','110001','杜娟','15940372100','Signup/201312/529ab2a3baeb9.jpg','Signup/201312/529ab2a3baeb9_s.jpg','1385869987','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333350005','2','淮北市第十二中学','235037','淮北市第十二中学','0561-3187165','23500','许小芬','18956166849','Signup/201312/529ab2a7b71b0.jpg','Signup/201312/529ab2a7b71b0_s.jpg','1385869991','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333456274','1','贵州省贵阳市乌当区乌当中学','550018','贵州省贵阳市乌当区新创路创新社区服务中心','15329006017','550018','戚宏','13984390944','Signup/201312/529ab36207a12.jpg','Signup/201312/529ab36207a12_s.jpg','1385870178','0','2013120153127839','TRADE_SUCCESS','e4ba4557950bcf35893fdf57ce66290846','2013-12-01 12:04:53','13985422999','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333484398','1','黑龙江省大庆市第四中学','163711','黑龙江省大庆市龙凤区万隆家园2-2-601','18845935999','163711','陶伟峰','13945975888','Signup/201312/529ab4203d090.jpg','Signup/201312/529ab4203d090_s.jpg','1385870368','0','2013120109431651','TRADE_SUCCESS','a6b64d5826ad6b0145700deaa2889dbf4u','2013-12-01 12:12:31','18845935999','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333351586','2','北京市通州区潞州中学','101119','北京市顺义区天竺镇天竺家园12号楼4门602','18710005180','101312','李雪松','13581877087','Signup/201312/529ab4f0d59f8.jpg','Signup/201312/529ab4f0d59f8_s.jpg','1385870576','0','2013120124620318','TRADE_SUCCESS','13e1d9106417fb05be4a6ac45485e97e30','2013-12-01 12:34:58','877758533@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333496830','2','内蒙古包头市第四中学','14030','内蒙古包头市第四中学','13948727126','14030','赵毅彬','15149376624','Signup/201312/529ab52166ff3.jpg','Signup/201312/529ab52166ff3_s.jpg','1385870625','0','2013120169634573','TRADE_SUCCESS','ddb1f2cf7eba55ef2f794d7d920b1fd362','2013-12-01 12:37:24','zyb934114914@163.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333489066','1','北京市第二中学通州分校','101117','北京市通州区于家务乡于家务村四街116号','010-80531783','101127','何德龙','13520362728','Signup/201312/529ab54707a12.jpg','Signup/201312/529ab54707a12_s.jpg','1385870663','0','2013120172535659','TRADE_SUCCESS','885e2851befe2020f625fe6ec1f6cb355a','2013-12-01 12:07:28','13621359461','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333482891','1','湖南省湘潭县云龙实验中学','411218','湘潭县云龙实验中学高中部89班凌琳','13348728828','411218','凌一清','13307320918','Signup/201312/529ab70290f56.jpg','Signup/201312/529ab70290f56_s.jpg','1385871106','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333339034','2','辽宁省锦州市辽西育明高中','121000','辽宁省锦州市辽西育明高中三年四班','15640620317','121000','章兴峰','15640620317','','','1385871232','0','2013120162660108','TRADE_SUCCESS','4428f0b5231bf8dc8e256224eaf548142g','2013-12-01 12:17:09','252292271@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333351505','1','南昌大学附属中学 ','330047','南昌市南京东路236号  南昌大学附属中学 ','0791-82020888','330047','蔡敏','13607006050','Signup/201312/529ab7dc1e848.jpg','Signup/201312/529ab7dc1e848_s.jpg','1385871324','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333454666','1','辽宁省大连市红旗高中','116021','辽宁省大连市甘井子区红旗中路143号3-5-3','0411-84229192','116081','刁慧华','13889571779','Signup/201312/529ab7dc4c4b4.jpg','Signup/201312/529ab7dc4c4b4_s.jpg','1385871324','0','2013120117525925','TRADE_SUCCESS','3af37150650d93867a617ed3e49662e93e','2013-12-01 12:21:41','15811028767','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333410932','2','铁岭市清河高级中学','112003','辽宁省铁岭市开原市哥弟专卖店','024-73822298','112300','田云霞','15241085577','Signup/201312/529ab8133d090.jpg','Signup/201312/529ab8133d090_s.jpg','1385871379','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333253133','2','北京市平谷中学','101200','北京市平谷区园丁小区18号楼5单元10号','010-69952976','101200','卢秀丽','13810470638','Signup/201312/529ab8ac39387.jpg','Signup/201312/529ab8ac39387_s.jpg','1385871532','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333404666','1','四川省广汉市金雁中学','618300','四川省广汉市中山大道南二段广油苑新区40栋2单元602','13890232538','618300','程智','13890232538','Signup/201312/529ab9e39c671.jpg','Signup/201312/529ab9e39c671_s.jpg','1385871843','0','2013120107275280','TRADE_SUCCESS','e2da112e499484822334ddfdcb22d68a6g','2013-12-01 13:40:15','15183870419','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333396830','2','辽宁省锦州市辽西育明高中','121000','辽宁省锦州市辽西育明高中三年四班','15640619246','121000','赵丽','15841677502','','','1385871898','0','2013120162701608','TRADE_SUCCESS','c9ccd137d7895fd5e9bed4ed55c6f3922g','2013-12-01 12:28:06','252292271@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333443716','2','杨村第四中学','301700','天津市武清区杨村团结东里29-2-201','15002298799','301700','郭朝发','13820681813','Signup/201312/529abaa040d99.jpg','Signup/201312/529abaa040d99_s.jpg','1385872032','0','2013120113239809','TRADE_SUCCESS','7d6cdeb269e699a8b20508080bc400ce2i','2013-12-01 12:35:46','13820681813','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333243716','2','天津市微山路中学','300222','天津市河西区小海地双水道川江里10-403','13652083123','300222','杨秀芝','13512438117','Signup/201312/529abaec0f424.JPG','Signup/201312/529abaec0f424_s.JPG','1385872108','0','2013120145135805','TRADE_SUCCESS','1e72ae6fc3d7ddf77e545febed0cc8d62a','2013-12-01 12:34:26','hebe999@126.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333171132','1','广西省南宁市隆安县隆安中学','532799','广西省南宁市隆安县隆安中学','18776882047','532799','余恒倩','13788511297','Signup/201312/529abc1807a12.jpg','Signup/201312/529abc1807a12_s.jpg','1385872408','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333418736','1','宁波滨海学校','315700','浙江省宁波市象山县宁波滨海学校高中部','0574-65837589','315700','朱利君','13567875551','Signup/201312/529abd1eaf79e.jpg','Signup/201312/529abd1eaf79e_s.jpg','1385872670','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333460919','1','河北省唐山市曹妃甸区第一中学','63299','河北省唐山市曹妃甸区世纪花苑8-4-502','0315-8709799','63299','杨晓敏','15030588001','Signup/201312/529abe8fcdfe6.jpg','Signup/201312/529abe8fcdfe6_s.jpg','1385873039','0','2013120101396246','TRADE_SUCCESS','04fe3c212d832400a7d5dcebbbe33ae34k','2013-12-01 12:56:09','15100599658','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333432854','1','汾阳五中','32200','山西省汾阳市贾家庄镇太平村','15035889196','32200','曹彩兰','15935174577','Signup/201312/529abfba2625a.jpg','Signup/201312/529abfba2625a_s.jpg','1385873338','0','2013120102391163','TRADE_SUCCESS','32a2f547f04dce89f0380373b6d9035c5i','2013-12-01 13:01:00','18334822772','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333379620','1','江苏省姜堰第二中学','225500','江苏省姜堰市溱潼镇府东路6-301室','0523-88611886','225508','1518997688','13701626832','Signup/201312/529ac38b2dc6c.jpg','Signup/201312/529ac38b2dc6c_s.jpg','1385874315','0','2013120124972179','TRADE_SUCCESS','6f67a87fb040304f5886d6abd3100d3c6e','2013-12-01 13:10:24','liangliang-love-fangfang@hotmail.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333470332','1','贵阳市乌当中学','550018','贵阳市乌当区温泉路温馨苑','13885156790','550018','张正辉','13985547731','Signup/201312/529ac42081b32.jpg','Signup/201312/529ac42081b32_s.jpg','1385874464','0','2013120117734325','TRADE_SUCCESS','f82ea11e7721ea45577c7b70d3e1558a3e','2013-12-01 13:12:06','38984409@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333414035','1','官渡区第一中学','650214','官渡区第一中学高三七班李锦颜','13678769597','650214','杨云','13759173226','Signup/201312/529ac45c7a120.jpg','Signup/201312/529ac45c7a120_s.jpg','1385874524','0','2013120157745410','TRADE_SUCCESS','7b783df32c3e653c633f19e0716b08f32k','2013-12-01 13:14:21','751650274@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333431292','1','南京师范大学附属实验学校','210046','江苏省南京市栖霞区尧佳路上城风景北苑7栋205','18751983984','21000046','陆垚颖','18751983984','Signup/201312/529ac5017270e.jpg','Signup/201312/529ac5017270e_s.jpg','1385874689','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333487534','2','安徽省合肥市肥西二中','231200','安徽省合肥市肥西县陈岗福乐园小区106号','0551-68842265','231200','唐世春','13721106768','Signup/201312/529ac5691e848.jpg','Signup/201312/529ac5691e848_s.jpg','1385874793','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333475077','1','江苏省郑梁梅高级中学','223400','江苏省涟水县涟城镇金城路1号','13952364138','223400','汪建荣','13952364138','Signup/201312/529ac615d59f8.jpg','Signup/201312/529ac615d59f8_s.jpg','1385874965','0','2013120117870625','TRADE_SUCCESS','1eb5d508f0cbb88d5c8d68ea12c476bb3e','2013-12-01 13:47:30','18351475107','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333464054','1','北京市延庆县延庆镇延庆三中','102100','北京市延庆县延庆镇延庆三中','13683609974','102100','冀想霞','13683606962','Signup/201312/529ac6ce487ab.jpg','Signup/201312/529ac6ce487ab_s.jpg','1385875150','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333375076','2','辽宁省抚顺市新宾满族自治县高级中学','113200','辽宁省抚顺市新宾满族自治县高级中学','024-55035678','113200','刘淑香','18641301776','Signup/201312/529ac7cbf0537.jpg','Signup/201312/529ac7cbf0537_s.jpg','1385875403','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333417194','1','山西省运城市康杰二中','44000','山西省芮城县风陵渡经济开发区黄河招待所','18235985111','44602','苏富斌','13935970868','Signup/201312/529ac91303d09.jpg','Signup/201312/529ac91303d09_s.jpg','1385875731','0','2013120104130077','TRADE_SUCCESS','147b496efec9108f4dea53397c4726b06a','2013-12-01 13:32:37','13603593926','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333410910','1','洪泽第二中学','223100','洪泽第二中学','051780926053','223100','袁翠珍','13801402127','Signup/201312/529acb71aba95.jpg','Signup/201312/529acb71aba95_s.jpg','1385876337','0','2013120172106065','TRADE_SUCCESS','75eda429e7de395c4bfa6066a35e9d255m','2013-12-01 15:35:46','18021923988','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333456266','1','贵阳息烽一中','551100','贵阳市息烽县第一中学','18786786412','551100','袁建锋','13984888646','Signup/201312/529acb8f6ea05.JPG','Signup/201312/529acb8f6ea05_s.JPG','1385876367','0','2013120163034948','TRADE_SUCCESS','2c7251a4e232f0af245a0d13b2d462ea4o','2013-12-01 13:59:49','13984346197','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333418794','2','莱阳一中','265200','山东省莱阳市中心汽车站南200米路西材源帝原木馆','13562572095','265200','丁绍倩','13031630602','Signup/201312/529acc350f424.jpg','Signup/201312/529acc350f424_s.jpg','1385876533','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333414041','1','肥西实验高级中学','231200','合肥市滨湖新区滨湖世纪城蓝鼎售楼部旁合肥晚报社','13805695817 ','231200','李','13965091690','Signup/201312/529acc9e0f424.jpg','Signup/201312/529acc9e0f424_s.jpg','1385876638','0','2013120125015118','TRADE_SUCCESS','7f1f63842198df664c714dfc647b278630','2013-12-01 14:20:01','332301465@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333492130','2','江苏省盐城市时杨中学','224000','江苏省盐城市盐都县秦南中学卫生院','0515-88603705','224021','孔秀兰','13921848576','Signup/201312/529acca0ec82e.jpg','Signup/201312/529acca0ec82e_s.jpg','1385876640','0','2013120143632697','TRADE_SUCCESS','afb01545c5e905527d91105142dd04287e','2013-12-01 13:57:51','13921848576','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333228186','1','山西省太原市清徐县金河中学','30401','山西省太原市劲松北路18号','13835127055','30002','成莉萍','13513518519','Signup/201312/529accab3567e.jpg','Signup/201312/529accab3567e_s.jpg','1385876651','0','2013120163780001','TRADE_SUCCESS','fb79f81d7a51053daef8a570aeeacf1522','2013-12-01 13:49:49','cay21@126.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333465613','1','贵阳市第六中学','550001','贵州贵阳云岩区轮胎厂西山巷26栋2单元2号','18096043073','550008','王开菊','13618591663','Signup/201312/529ace1fe1113.jpg','Signup/201312/529ace1fe1113_s.jpg','1385877023','0','2013120100024168','TRADE_SUCCESS','99cf82246692dbb28d61df7be9fa42a15s','2013-12-01 14:00:38','18096043073','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333490666','1','贵州省黄平县民族中学','556100','贵州省黄平县新州镇红叶相馆','18212288431','556100','岳娴','15085267028','Signup/201312/529ace7316e36.jpg','Signup/201312/529ace7316e36_s.jpg','1385877107','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333325076','2','北京市翠微中学','100036','房山良乡北潞华2号楼1单元302','18611052223','102488','袁凤竹','18611052223','Signup/201312/529acedaaf79e.jpg','Signup/201312/529acedaaf79e_s.jpg','1385877210','0','2013120106129492','TRADE_SUCCESS','99a8b649367add5bb004af614d93eae274','2013-12-01 14:01:41','13911445527','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333278120','1','江苏省涟水县第一中学','223400','江苏省涟水县第一中学','18752424080','223400','戴卫东','15949189958','Signup/201312/529aceeda4083.jpg','Signup/201312/529aceeda4083_s.jpg','1385877229','0','2013120117908025','TRADE_SUCCESS','4e3344613a340c4514c2068227c030663e','2013-12-01 13:57:00','18351475107','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333404613','1','成都市盐道街高中','610021','成都市盐道街4号','028-86665919','610021','陈明','13608171505','Signup/201312/529ad06faf79e.jpg','Signup/201312/529ad06faf79e_s.jpg','1385877615','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333434354','2','贵州省遵义县第一中学','563000','遵义市中华北路金狮山4栋1单元102','13595205548','563000','王科强','18585251218','Signup/201312/529ad486e4e1c.jpg','Signup/201312/529ad486e4e1c_s.jpg','1385878662','0','2013120122861800','TRADE_SUCCESS','5141608ae0000b32f9afa7e22b6b169820','2013-12-01 14:57:49','13984291314','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333423412','1','张家口市第二中学高三（15）班','75000','张家口市高新区纬一路兴胜达物资销售处','0313-5980019','75000','1373130163','13785357345','Signup/201312/529ad4df7de29.jpg','Signup/201312/529ad4df7de29_s.jpg','1385878751','0','2013120171917499','TRADE_SUCCESS','103d0a36ac3074015ae0092433e5c57c7i','2013-12-01 14:27:00','15030333444','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333243743','1','北京市第五十五中学','100027','北京市朝阳区南十里居东风家园15楼601室','15901557683','100016','王卉','13439191755','Signup/201312/529ad9667de29.jpg','Signup/201312/529ad9667de29_s.jpg','1385879910','0','2013120131025891','TRADE_SUCCESS','b5265d76af1e36dafe865bfedbc767b072','2013-12-01 14:43:39','15901557683','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333468742','1','贵阳市乌当中学','550018','贵州省贵阳市乌当区新添寨乌当中学','15885058097','550018','王美慧子','18786675061','Signup/201312/529ad9a49c671.jpg','Signup/201312/529ad9a49c671_s.jpg','1385879972','0','2013120101236367','TRADE_SUCCESS','d1f7cbeb7d274f9f2ace5345adab9e735q','2013-12-01 14:44:22','414327593@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333364034','1','江苏省连云港市灌云县高级中学','222200','江苏省连云港市灌云县美都新城18幢3单元406室','13961355681','222200','张新芹','18261353587','Signup/201312/529ad9ea1312d.jpg','Signup/201312/529ad9ea1312d_s.jpg','1385880042','0','2013120162754407','TRADE_SUCCESS','08ef2a2b1ecb9bc9fb0ee95d5d537dcf2e','2013-12-01 14:57:34','18261353587','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333384398','1','内蒙古呼和浩市第十八中学','10010','内蒙古呼和浩特市第十八中学传达室','18647389908','10010','石玥','15049135338','Signup/201312/529ad9ee44aa2.JPG','Signup/201312/529ad9ee44aa2_s.JPG','1385880046','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333242134','2','辽宁锦州市辽西育明中学高级','121000','辽宁锦州市辽西育明中学高级','0416-4670226','121000','王晓会','13840675757','Signup/201312/529ada0989544.jpg','Signup/201312/529ada0989544_s.jpg','1385880073','0','2013120102790819','TRADE_SUCCESS','908bccd05c29ebe455be12a3b217a6b732','2013-12-01 15:00:34','13841627817','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333443771','1','四川省邛崃市第一中学','61530','邛崃市洪川小区C区9栋2单元3楼6号','13668297562','611530','梁小琼','13308050591','Signup/201312/529adb9c03d09.JPG','Signup/201312/529adb9c03d09_s.JPG','1385880476','0','2013120118075383','TRADE_SUCCESS','2a1d7812f85ca05ff993ba2b3900e4da6m','2013-12-01 14:51:59','13730611678','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333481291','1','江苏省扬州市瓜洲中学','225129','江苏省扬州市广陵区杭集镇龙王村建新组28号','13905270639','225000','丁梅','18252731958','Signup/201312/529adbef3567e.jpg','Signup/201312/529adbef3567e_s.jpg','1385880559','0','2013120109254876','TRADE_SUCCESS','ba285134b7d8f810b8f268e7eff1441068','2013-12-01 15:04:47','18752712328','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333425043','1','浙江省海宁市南苑中学','314400','浙江省海宁市周王庙镇陈桥村三组84号','15958302987','314407','陈时强','15958302987','Signup/201312/529adc5f632ea.jpg','Signup/201312/529adc5f632ea_s.jpg','1385880671','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333498496','2','江苏省淮安市涟水县第一中学','223400','江苏省淮安市涟水县第一中学','18762713664','223400','姚志慧','15261783667','Signup/201312/529add4a6acfc.jpg','Signup/201312/529add4a6acfc_s.jpg','1385880906','0','2013120176193814','TRADE_SUCCESS','274161bd888090538feacc40e7f4d7b62s','2013-12-01 15:16:25','15216777780','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333432892','1','内蒙古呼和浩特市第十八中学','10020','内蒙古呼和浩特市第十八中学传达室','18647389908','10020','石玥','15049135338','Signup/201312/529add6381b32.jpg','Signup/201312/529add6381b32_s.jpg','1385880931','0','2013120103246020','TRADE_SUCCESS','e34d7ce04477a24866e7c2897082795d34','2013-12-01 15:48:17','18647389908','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333245316','2','黑龙江省佳木斯市桦川县第一中学','154300','黑龙江省佳木斯市桦川县英才小区2号楼2单元502','18724233904','154300','宫宝玲','13159986845','Signup/201312/529ade5c40d99.jpg','Signup/201312/529ade5c40d99_s.jpg','1385881180','0','2013120164548503','TRADE_SUCCESS','fa24c9d5153c951571e781848f15d34b26','2013-12-01 15:20:55','306953848@qq.com','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333385928','1','贵阳市乌当中学','550018','贵州省贵阳市乌当区乌当中学','18685101790','550018','王爱莉','13809428530','Signup/201312/529adec51312d.jpg','Signup/201312/529adec51312d_s.jpg','1385881285','0','2013120107473985','TRADE_SUCCESS','92ef936e839e228c5504d8e70c30eeb16q','2013-12-01 15:04:46','18685101790','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333390625','1','河北师范大学附属中学','50011','河北省石家庄市126号信箱东平路8号','13731180660','50011','张淑艳','15833119679','Signup/201312/529adf521312d.JPG','Signup/201312/529adf521312d_s.JPG','1385881426','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333439034','1','云南省玉溪市民族中学','653200','云南省玉溪市峨山县桂峰路39号（县城清真寺）','15331544750','653200','马文旺','13608775738','Signup/201312/529adfe57270e.jpg','Signup/201312/529adfe57270e_s.jpg','1385881573','0','2013120140985190','TRADE_SUCCESS','c6f416e30ec49915c74b2dcecf5ff74170','2013-12-01 15:12:12','15331544750','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333239034','1','涟水第一中学','223400','涟水第一中学','15061265739','223400','戴卫东','15949189958','Signup/201312/529ae24c7a120.jpg','Signup/201312/529ae24c7a120_s.jpg','1385882188','0','2013120118210425','TRADE_SUCCESS','defef803d7a83923b6e7cc793fb91f313e','2013-12-01 15:19:41','18351475107','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333417112','1','首都师范大学附属房山中学','102401','首都师范大学附属房山中学','010-81301719','102401','黄碧芳','13581754808','Signup/201312/529ae2c298968.jpg','Signup/201312/529ae2c298968_s.jpg','1385882306','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333225043','2','涟水第一中学','223400','涟水第一中学','15896162884','223400','戴卫东','15949189958','Signup/201312/529ae3a8aba95.jpg','Signup/201312/529ae3a8aba95_s.jpg','1385882536','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333334392','1','吉林省延吉市第三高级中学','133000','吉林省延吉市第三高级中学高三10班','18804333833','133000','葛延龙','13904433833','Signup/201312/529ae7c2e8b25.jpg','Signup/201312/529ae7c2e8b25_s.jpg','1385883586','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333407836','2','应城市第二高级中学','432400','应城市环水花园12栋西单元东地下室','15072151037','432400','田中新','18213344883','Signup/201312/529ae8eeaba95.JPG','Signup/201312/529ae8eeaba95_s.JPG','1385883886','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333393720','1','荥经中学','625200','四川省雅安市荥经县附城乡南锣坝红旗组','0835-7623122','625200','刘星来','15196566880','Signup/201312/529ae9586ea05.JPG','Signup/201312/529ae9586ea05_s.JPG','1385883992','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333204666','2','天津市第三中学','300131','天津市河北区盛和家园7-1006','13512871384','300000','孙伟','15522847371','Signup/201312/529ae97131975.jpg','Signup/201312/529ae97131975_s.jpg','1385884017','0','','','','','','','0.00','0.00','0','0');
INSERT INTO `ycity_signup` VALUES ('1333467113','1','贵州省黄平县民族中学','556100','贵州省黄平县红叶相馆','18212288431','556100','岳娴','15085267028','Signup/201312/529ae971a037a.jpg','Signup/201312/529ae971a037a_s.jpg','1385884017','0','','','','','','','0.00','0.00','0','0');
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
INSERT INTO `ycity_user` VALUES ('1','1','admin','d9637d9c684ba63b5b1b05e1f578495a80a0a25a','系统管理员','男','0','05560000000','13900000000','022-58018980','20020573@163.com','5565907','2','','179','1306847872','1306847872','0.0.0.0','1386851167','0');
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