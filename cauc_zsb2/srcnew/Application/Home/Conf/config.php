<?php
$database = require ('../db.config.php');
$config = array(
    '404HTML'=>'<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN"><HTML><HEAD><TITLE>404 Not Found</TITLE></HEAD><BODY><H1>Not Found</H1>The requested URL <!--#echo var="REQUEST_URI" --> was not found on this server.<HR><I><!--#echo var="HTTP_HOST" --></I></BODY></HTML>',
    'DB_NAME'               =>  'cauc_zs',          // 数据库名
);
return array_merge($database, $config);