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
class VideoAction extends HomeAction
{
    public $dao, $orderDao;
    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('Video');
        $this->assign('plist','招生视频');
        $this->assign('moduleTitle', '视频列表');
    }
    
    /**
     * 视频列表
     *
     */
    public function index()
    {
        parent::getList('status!=1','istop desc,display_order desc,create_time DESC,id desc', 15);
    }
    
    /**
     * 浏览内容页
     *
     */
    public function detail(){
        $this->assign('contenttitle','招生视频');
        $titleId = intval($_GET['id']);
        $where2['id'] = array('eq',$titleId);
        $this->dao->Where($where2)->setInc('view_count',1);
        $con['id']=array('eq',$titleId);
        empty($con) && parent::_message('error', '参数丢失');
        $con && $contentDetail = $this->dao->Where($con)->find();
        empty($contentDetail) && parent::_message('error', '记录不存在');
        $this->assign('contentDetail',$contentDetail);
        $this->display();
    }
}