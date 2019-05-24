<?php 
/**
 * 
 * 后台管理入口
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

//header("Content-type: text/html; charset=UTF-8");
//if (!file_exists('../db.config.php')) die('db.config.php 不存在，请正常安装系统');
//define('YcityCms', '../../src/YcityCms');
//define('DATA', '../Data');
//define('UPLOAD_PATH', '../Uploads');
//define('APP_NAME', 'SignUp');
//define('APP_PATH', '../../src/SignUp/');
//define('THINK_PATH', '../../src/Core/');
//define('APP_DEBUG',TRUE);//开启调试
//require(THINK_PATH.'/Core.php');

if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

//定义数据目录
define('YCITYDATA', './Data');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);

// 定义应用目录
define('APP_PATH','../../src/SignUp/Application/');
//define('YCITYCMS', '../src/SignUp/Application/');
define('YCITYCMS', '../src/SignUp/Application/');
define('UPLOAD_PATH', '../Uploads');
define('THINK_PATH', '../../src/SignUp/Core/');
define('DATA', '../Data');
//echo realpath(APP_PATH);
// 引入ThinkPHP入口文件
require(THINK_PATH."/Core.php");
// 亲^_^ 后面不需要任何代码了 就是如此简单
