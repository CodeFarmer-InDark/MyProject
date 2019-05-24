<?php
/** 
* cache.role.php
*
* @package      	Y-city Corp
* @author          Y-city <y_city@qeeyang.com>
* @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
* @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $
   
*/

if (!defined('YCITYCMS')) exit();

return array (
  0 => 
  array (
    'id' => '1',
    'role_name' => '超级管理',
    'role_permission' => 'Config_index,Config_modify,Config_coreIndex,Config_coreModify,User_index,User_insert,User_modify,User_command,Role_index,Role_insert,Role_modify,Role_command,AdminLog,Adv_index,Adv_insert,Adv_modify,Adv_command,Link_index,Link_insert,Link_modify,Link_command,News_index,News_modify,News_insert,News_command,Page_index,Page_insert,Page_modify,Page_command,Course_index,Course_insert,Course_modify,Course_command',
    'category_permission' => 'all',
    'system' => '1',
    'create_time' => '0',
    'update_time' => '0',
  ),
  1 => 
  array (
    'id' => '2',
    'role_name' => '禁止访问',
    'role_permission' => 'disable',
    'category_permission' => '',
    'system' => '1',
    'create_time' => '0',
    'update_time' => '0',
  ),
  2 => 
  array (
    'id' => '3',
    'role_name' => '普通管理',
    'role_permission' => 'Manager_index,Manager_modify,Manager_insert,Manager_delete,Manager_command,Manager_export',
    'category_permission' => '',
    'system' => '1',
    'create_time' => '0',
    'update_time' => '0',
  ),
  3 => 
  array (
    'id' => '14',
    'role_name' => '飞行学院',
    'role_permission' => 'all',
    'category_permission' => 'all',
    'system' => '0',
    'create_time' => '1520496224',
    'update_time' => '1521280811',
  ),
  4 => 
  array (
    'id' => '13',
    'role_name' => '乘务学院',
    'role_permission' => 'News_index,News_modify,News_insert,News_delete,News_command',
    'category_permission' => '40,23,22',
    'system' => '0',
    'create_time' => '1520496197',
    'update_time' => '1520926602',
  ),
  5 => 
  array (
    'id' => '15',
    'role_name' => '11',
    'role_permission' => 'Config_index',
    'category_permission' => 'all',
    'system' => '0',
    'create_time' => '1520927276',
    'update_time' => '0',
  ),
);