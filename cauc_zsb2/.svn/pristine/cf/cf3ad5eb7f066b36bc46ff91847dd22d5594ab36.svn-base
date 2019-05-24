<?php
/**
 *
 * 新闻
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
if(!defined("YCITYCMS")) exit("Access Denied");
class BriefAction extends HomeAction
{
    public $dao;
    function _initialize()
    {
        parent::_initialize();

        $this->dao = M('brief');
        $this->assign('plist','走进航大');
        $this->assign('moduleTitle','走进航大');

    }
    public function index(){
        $data = $this->dao->order('create_time desc,id desc')->find();
        $this->assign('data',$data);
        $this->display();
    }
}