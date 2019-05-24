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
class LifeAction extends HomeAction
{
    public $dao;

    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('life');
        $this->assign('plist','走进航大');
        $this->assign('moduleTitle','走进航大');
        
        
    }

    public function photo(){
        $where['parent_id']= array('eq',27);
        $typelist= M('category')->where($where)->field('parent_id,title,id,groupID,module,keyword')->order('id asc')->select();//获取菜单名称
        $this->assign('typelist',$typelist);

//        $lifelist= M('category')->where('parent_id=53')->order('id asc')->field('title,id')->select();
        $photoList=$this->dao->order('display_order desc,create_time desc,id desc')->select();
        $this->assign('photoList',$photoList);

        $this->display();
    }
}