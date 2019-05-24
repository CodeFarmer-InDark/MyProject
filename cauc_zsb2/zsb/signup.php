<?php
/**
 *
 * index(系统首页)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

//if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
header("Content-type: text/html; charset=UTF-8");
if (!file_exists('./db.config.php')) die('<html><head><title>新城网络企业网站管理系统</title></head><body style="text-align:center; background-color: #F7F7F7;"><div style="width:600px; height:80px; text-align:center; margin:140px auto 0; padding:100px 0; background-color: #FFFFFF; border: 1px solid #DFDFDF; color: #666666;"><p>系统尚未安装，请执行install.php开始安装系统</p><p><a href="./Data/Install/install.php">点此安装系统</a></p></div></body></html>');
define('APPLICATION', '../src/SignUp/Application');
define('DATA', './Data');
define('YCITYDATA','./Data');
define('Uploads_PATH','./Uploads');
define('APP_NAME', 'Application');
define('YCITYCMS', '../src/SignUp/Application/');
define('APP_PATH', '../src/SignUp/Application/');
define('THINK_PATH', '../src/SignUp/Core/');
define('APP_DEBUG',true);//开启调试
// session_start();
// var_dump($_SESSION);return;
require(THINK_PATH."/Core.php");