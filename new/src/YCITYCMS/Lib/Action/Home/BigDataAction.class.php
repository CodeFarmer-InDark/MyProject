<?php
/**
 * 
 * 搜索
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
if(!defined("YCITYCMS")) exit("Access Denied"); 
class BigDataAction extends HomeAction
{
    public $dao;
    function _initialize()
    {
        parent::_initialize();
    }


    public function index(){
        $id=intval($_GET['id']);
        $this->assign('id',$id);
        if (!isset($_GET['id']) || $id!=59){parent::_message('error','参数错误');};

        //取配置
        if(fileExit('./cms.config.php')){
            $sysConfig = getContent('cms.config.php', '.');
        }else{
            $sysConfig = M('Config')->where('id=1')->find();
        }
      
        $this->assign('year',$sysConfig['static_year']);
        $this->assign('plist','新生大数据统计');
        $this->assign('moduleTitle','新生大数据统计');
        $this->assign('moduleName',$this->getActionName());
        $this->assign('actionName',ACTION_NAME);

        C('TOKEN_ON',false);
        $this->display();
    }

}