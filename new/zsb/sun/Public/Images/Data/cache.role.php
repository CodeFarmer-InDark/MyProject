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
    'system' => '1',
    'create_time' => '0',
    'update_time' => '0',
  ),
  1 => 
  array (
    'id' => '2',
    'role_name' => '禁止访问',
    'role_permission' => 'disable',
    'system' => '1',
    'create_time' => '0',
    'update_time' => '0',
  ),
  2 => 
  array (
    'id' => '21',
    'role_name' => '内容管理',
    'role_permission' => 'Config_index,News_index,News_modify,News_insert,News_delete,News_command,Page_index,Page_insert,Page_modify,Page_command,Download_index,Download_insert,Download_modify,Download_command',
    'system' => '0',
    'create_time' => '1490927913',
    'update_time' => '0',
  ),
  3 => 
  array (
    'id' => '22',
    'role_name' => '1',
    'role_permission' => 'Adv_index,Adv_modify,Adv_insert,Adv_delete,Adv_command',
    'system' => '0',
    'create_time' => '1491805620',
    'update_time' => '0',
  ),
);