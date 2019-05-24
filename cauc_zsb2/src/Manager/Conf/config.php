<?php
$database = require ('../db.config.php');

$config	= array(
		'URL_MODEL' => 1,//后台admin.php不受rewrite影响
        'DEFAULT_THEME' => 'Default',//后台不受模板影响
		'URL_ROUTER_ON' => false,
		'APP_DEBUG' => false,
		'SHOW_PAGE_TRACE' => false,
		'SYS_VERSION' => 'V2.2.1 Dev',
		'SYS_UPDATETIME' => '20120720',
    	'TMPL_CACHE_ON' => false,
    	'TMPL_CACHE_TIME' => -1,
		'TOKEN_ON' => true,
    	'TOKEN_NAME' => '__hash__',
    	'TOKEN_TYPE' => 'md5',
		'OUTPUT_ENCODE' =>  false,//与导出Excel冲突，后台可关闭
		'TMPL_ACTION_ERROR' => 'Public:success',//错误跳转模板文件
		'TMPL_ACTION_SUCCESS' => 'Public:success',


);
return array_merge($database, $config);