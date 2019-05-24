<?php
if (!defined('YCITYCMS')) die('Access Denied');
$database = require ('./db.config.php');
$sysConfig =  require (DATA.'/sys.config.php');
$config = array(
		'DEFAULT_THEME'		=> 'Default',
		'DEFAULT_CHARSET' => 'utf-8',
		'URL_ROUTER_ON' => false,
//		'URL_ROUTE_RULES' => array(//定义路由规则
//			'Page/:link_label' => 'Page/detail','link_label',
//		),
		//'APP_GROUP_LIST' => 'Home,Member,Mobile',
		//'DEFAULT_GROUP' =>'Home',
		//'APP_SUB_DOMAIN_DEPLOY'=>1, // 开启子域名配置
		/*子域名配置
		*格式如: '子域名'=>array('分组名/[模块名]','var1=a&var2=b');
		*/
		//'APP_SUB_DOMAIN_RULES'=>array(
			//'admin'=>array('Admin/'),  // admin域名指向Admin分组
		//	'm'=>array('Mobile/'),  // m域名指向Mobile分组
		//),
		//'DEFAULT_LANG'   => 'cn',
		//'LANG_SWITCH_ON'		=> true, //是否开启多语言功能，默认false(关闭)
		//'LANG_LIST'=>'cn,zh-cn,en',
		//'TAGLIB_LOAD' => true, //是否使用内置标签库之外的其它标签库，默认true(进行自动检测)
		//'TAGLIB_PRE_LOAD' =>'YC',
		'TMPL_ACTION_ERROR' => APP_PATH.'Tpl/Default/Public/error.html',//错误跳转模板文件
//		'TMPL_ACTION_SUCCESS' =>  APP_PATH.'Tpl/Default/Public/error.html',//成功跳转模板文件
		//'TMPL_ACTION_SUCCESS' =>  APP_PATH.'Tpl/Home/Default/Public/success.html',//成功跳转模板文件
		'COOKIE_PREFIX'=>'YC_',
		'COOKIE_EXPIRE'=>'',
		'VAR_PAGE' => 'p',
        'PAGE_BREAK_TAG' => '_baidu_page_break_tag_',
		'LAYOUT_ON'=>false,
		//'TMPL_EXCEPTION_FILE' => APP_PATH.'Tpl/Default/Public/exception.html',//异常模板



		'S_ZS_IP' => 'http://localhost/cauc_zs3/lqgl/',
		'S_ZS_DOMAIN' => 'http://localhost/cauc_zs3/lqgl/',


        'TMPL_PARSE_STRING'  =>array(
            '__UPLOAD__' => '/Uploads', // 增加新的上传路径替换规则
 )
);
return array_merge($database, $config, $sysConfig);