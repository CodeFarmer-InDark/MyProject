<?php

$database = require('./db.config.php');
$config = array(
    'TMPL_ACTION_ERROR' => 'Public:success',//错误跳转模板文件
    'TMPL_ACTION_SUCCESS' => 'Public:success',
    'COOKIE_PREFIX' => 'YC_',
    'DEFAULT_CONTROLLER' => 'Login'
);
return array_merge($database, $config);