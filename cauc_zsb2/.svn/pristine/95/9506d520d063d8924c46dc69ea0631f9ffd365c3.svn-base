<?php
if (!defined('YCITYDATA')) die('Access Denied');
$database = require ('./db.config.php');
$config = array(
//    'URL_MODEL' => 2,
    'URL_MODEL' => 1,
    'URL_PATHINFO_DEPR' => '/',
    'URL_HTML_SUFFIX' => '.html',
    'TOKEN_ON' => true,
    'TOKEN_NAME' => '__hash__',
    'TOKEN_TYPE' => 'md5',
    'TMPL_CACHE_ON' => false,
    'TMPL_CACHE_TIME' => -1,
    'SHOW_PAGE_TRACE' => false,
    'SHOW_RUN_TIME'    => true, // 运行时间显示
    'SHOW_ADV_TIME'    => true, // 显示详细的运行时间
    'SHOW_DB_TIMES'    => true, // 显示数据库查询和写入次数
    'SHOW_CACHE_TIMES' => true, // 显示缓存操作次数
    'SHOW_USE_MEM'     => true, // 显示内存开销
    'SHOW_LOAD_FILE'   => true, // 显示加载文件数
    'SHOW_FUN_TIMES'   => true, // 显示函数调用次数
    'TMPL_PARSE_STRING'  =>array(
        '__STATIC__'     => __ROOT__.'/Public/Static', // 增加新的静态文件路径替换规则
        '__UPLOAD__' => __ROOT__.'/Public/Uploads', // 增加新的上传路径替换规则
        '__KSZP__' => __ROOT__.'/kszp', // 增加学生照片路径替换规则
    ),
    'DEFAULT_CHARSET' => 'utf-8',

    'TMPL_ACTION_ERROR' => 'Home@Meeting/Public:success',//错误跳转模板文件
    'TMPL_ACTION_SUCCESS' => 'Home@Meeting/Public:success',

    'MODULE_ALLOW_LIST'    =>    array('Home','Promotion','Api'),
    'DEFAULT_MODULE'       =>    'Home',
    'MODULE_DENY_LIST' =>  array('Common','Runtime'),
    'URL_CASE_INSENSITIVE' => false,

    'LOG_RECORD'            =>  true,   // 默认不记录日志
    'LOG_TYPE'              =>  'File', // 日志记录类型 默认为文件方式
    'LOG_LEVEL'             =>  'EMERG,ALERT,CRIT,ERR',// 允许记录的日志级别
    'LOG_FILE_SIZE'         =>  2097152, // 日志文件大小限制
    'LOG_EXCEPTION_RECORD'  =>  true,    // 是否记录异常信息日志
);
return array_merge($database, $config);
