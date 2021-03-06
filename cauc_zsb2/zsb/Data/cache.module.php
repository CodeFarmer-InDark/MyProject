<?php
/** 
* cache.module.php
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
    'module_title' => '系统配置',
    'module_name' => 'Config',
    'module_permission' => '浏览系统配置=Config_index|编辑系统配置=Config_modify|浏览核心配置=Config_coreIndex|编辑核心配置=Config_coreModify',
    'system_module' => '1',
    'left_menu' => '0',
    'developer' => '',
    'build_version' => '2.0',
    'display_order' => '0',
    'status' => '0',
    'create_time' => '0',
    'update_time' => '0',
  ),
  1 => 
  array (
    'id' => '2',
    'module_title' => '管理员管理',
    'module_name' => 'User',
    'module_permission' => '浏览=User_index|录入=User_insert|编辑=User_modify|批量操作=User_command',
    'system_module' => '1',
    'left_menu' => '0',
    'developer' => '',
    'build_version' => '2.0',
    'display_order' => '0',
    'status' => '0',
    'create_time' => '0',
    'update_time' => '0',
  ),
  2 => 
  array (
    'id' => '3',
    'module_title' => '角色管理',
    'module_name' => 'Role',
    'module_permission' => '浏览=Role_index|录入=Role_insert|编辑=Role_modify|批量操作=Role_command',
    'system_module' => '1',
    'left_menu' => '0',
    'developer' => '',
    'build_version' => '2.0',
    'display_order' => '0',
    'status' => '0',
    'create_time' => '0',
    'update_time' => '0',
  ),
  3 => 
  array (
    'id' => '4',
    'module_title' => '操作日志管理',
    'module_name' => 'AdminLog',
    'module_permission' => '管理=AdminLog',
    'system_module' => '1',
    'left_menu' => '0',
    'developer' => '',
    'build_version' => '2.0',
    'display_order' => '0',
    'status' => '0',
    'create_time' => '0',
    'update_time' => '0',
  ),
  4 => 
  array (
    'id' => '5',
    'module_title' => '数据库管理',
    'module_name' => 'Database',
    'module_permission' => '浏览=Database_index|执行SQL=Database_query|备份数据库=Database_export|恢复数据库=Database_import',
    'system_module' => '1',
    'left_menu' => '0',
    'developer' => '',
    'build_version' => '2.0',
    'display_order' => '0',
    'status' => '0',
    'create_time' => '0',
    'update_time' => '0',
  ),
  5 => 
  array (
    'id' => '6',
    'module_title' => '工具箱管理',
    'module_name' => 'Tools',
    'module_permission' => '管理=Tools',
    'system_module' => '1',
    'left_menu' => '0',
    'developer' => '',
    'build_version' => '2.0',
    'display_order' => '0',
    'status' => '0',
    'create_time' => '0',
    'update_time' => '0',
  ),
  6 => 
  array (
    'id' => '7',
    'module_title' => '类别管理',
    'module_name' => 'Category',
    'module_permission' => '浏览=Category_index|编辑=Category_modify|批量操作=Category_command',
    'system_module' => '1',
    'left_menu' => '0',
    'developer' => '',
    'build_version' => '2.0',
    'display_order' => '0',
    'status' => '0',
    'create_time' => '0',
    'update_time' => '0',
  ),
  7 => 
  array (
    'id' => '8',
    'module_title' => '广告管理',
    'module_name' => 'Ad',
    'module_permission' => '浏览=Ad_index|录入=Ad_insert|编辑=Ad_modify|批量操作=Ad_command',
    'system_module' => '0',
    'left_menu' => '0',
    'developer' => '',
    'build_version' => '2.0',
    'display_order' => '0',
    'status' => '0',
    'create_time' => '0',
    'update_time' => '0',
  ),
  8 => 
  array (
    'id' => '9',
    'module_title' => '友情链接管理',
    'module_name' => 'Link',
    'module_permission' => '浏览=Link_index|录入=Link_insert|编辑=Link_modify|批量操作=Link_command',
    'system_module' => '0',
    'left_menu' => '0',
    'developer' => '',
    'build_version' => '2.0',
    'display_order' => '0',
    'status' => '0',
    'create_time' => '0',
    'update_time' => '0',
  ),
  9 => 
  array (
    'id' => '10',
    'module_title' => '新闻管理',
    'module_name' => 'News',
    'module_permission' => '浏览=News_index|编辑=News_modify|录入=News_insert|批量操作=News_command',
    'system_module' => '1',
    'left_menu' => '1',
    'developer' => '',
    'build_version' => '3.0',
    'display_order' => '0',
    'status' => '0',
    'create_time' => '0',
    'update_time' => '0',
  ),
  10 => 
  array (
    'id' => '11',
    'module_title' => '单页管理',
    'module_name' => 'Page',
    'module_permission' => '浏览=Page_index|录入=Page_insert|编辑=Page_modify|批量操作=Page_command',
    'system_module' => '1',
    'left_menu' => '1',
    'developer' => '',
    'build_version' => '2.0',
    'display_order' => '0',
    'status' => '0',
    'create_time' => '0',
    'update_time' => '0',
  ),
  11 => 
  array (
    'id' => '12',
    'module_title' => '下载管理',
    'module_name' => 'Download',
    'module_permission' => '浏览=Download_index|编辑=Download_modify|录入=Download_insert|批量操作=Download_command',
    'system_module' => '0',
    'left_menu' => '1',
    'developer' => '',
    'build_version' => '2.0',
    'display_order' => '0',
    'status' => '0',
    'create_time' => '0',
    'update_time' => '0',
  ),
  12 => 
  array (
    'id' => '13',
    'module_title' => '栏目管理',
    'module_name' => 'Column',
    'module_permission' => '浏览=Column_index|录入=Column_insert|编辑=Column_modify|批量操作=Column_command',
    'system_module' => '0',
    'left_menu' => '0',
    'developer' => '',
    'build_version' => '2.0',
    'display_order' => '0',
    'status' => '0',
    'create_time' => '0',
    'update_time' => '0',
  ),
  13 => 
  array (
    'id' => '14',
    'module_title' => '通知公告管理',
    'module_name' => 'Notice',
    'module_permission' => '浏览=Notice_index|编辑=Notice_modify|录入=Notice_insert|批量操作=Notice_command',
    'system_module' => '0',
    'left_menu' => '1',
    'developer' => '',
    'build_version' => '2.0',
    'display_order' => '0',
    'status' => '0',
    'create_time' => '0',
    'update_time' => '0',
  ),
);