<?php
if (!defined('YCITYCMS')) die('Access Denied');
return array(
    'URL_MODEL' => 0,
    'URL_PATHINFO_DEPR' => '/',
    'URL_HTML_SUFFIX' => '.html',
    'TOKEN_ON' => true,
    'TOKEN_NAME' => '__hash__',
    'TOKEN_TYPE' => 'md5',
    'TMPL_CACHE_ON' => false,
    'TMPL_CACHE_TIME' => -1,
    'SHOW_PAGE_TRACE' => false,
	'SHOW_RUN_TIME'    => false, // 运行时间显示
 	'SHOW_ADV_TIME'    => true, // 显示详细的运行时间
 	'SHOW_DB_TIMES'    => true, // 显示数据库查询和写入次数
 	'SHOW_CACHE_TIMES' => true, // 显示缓存操作次数
 	'SHOW_USE_MEM'     => true, // 显示内存开销
 	'SHOW_LOAD_FILE'   => true, // 显示加载文件数
 	'SHOW_FUN_TIMES'   => true, // 显示函数调用次数
);