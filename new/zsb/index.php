<?php
header("Content-type: text/html; charset=UTF-8");
if (!file_exists('./db.config.php')) die('<html><head><title>新城网络企业网站管理系统</title></head><body style="text-align:center; background-color: #F7F7F7;"><div style="width:600px; height:80px; text-align:center; margin:140px auto 0; padding:100px 0; background-color: #FFFFFF; border: 1px solid #DFDFDF; color: #666666;"><p>系统尚未安装，请执行install.php开始安装系统</p><p><a href="./Data/Install/install.php">点此安装系统</a></p></div></body></html>');
define('YCITYCMS', '../src/YCITYCMS');
define('APP_NAME','YCITYCMS');
define('DATA','./DATA');
define('YCITYDATA','./Data');
define('Uploads_PATH','./Uploads');
define('APP_PATH','../src/YCITYCMS/');
define('APP_DEBUG',TRUE);//开启调试
define('THINK_PATH','../src/Core/');
require(THINK_PATH.'Core.php');