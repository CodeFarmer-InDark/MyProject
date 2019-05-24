<?php
/**
 * 
 * 单页
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
if(!defined("YCITYCMS")) exit("Access Denied"); 
class ContactAction extends HomeAction
{
    public $dao,$link_label;

    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('page');
        
        $this->assign('link_label','contact');
    }

    public function index()
    {
        $conditions['link_label']=array('eq','contact');
        empty($conditions) && parent::_message('errorUri', '查询条件丢失', U('Index/index'));
        $contentDetail = $this->dao->Where($conditions)->find();
        empty($contentDetail) && parent::_message('errorUri', '记录不存在', U('Index/index'));

        //更新查看次数
        $this->dao->Where($conditions)->setInc("view_count", 1);
        $this->assign('plist','联系我们');
        $this->assign('contentDetail', $contentDetail);
        
        $this->assign('moduleTitle','联系我们');
        $this->display();
    }
}