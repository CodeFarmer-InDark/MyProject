<?php
/**
 *
 * Video(视频)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
if(!defined("YCITYCMS")) exit("Access Denied");
class ConsultAction extends HomeAction
{
    public $dao, $orderDao;
    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('consult');
        $this->assign('plist','热点资讯');
        $this->assign('moduleTitle', '考生问答');
    }

    /**
     * 问答列表
     *
     */
    public function index()
    {
        parent::getList('','istop desc,display_order desc,create_time DESC,id desc', 5);
    }
}