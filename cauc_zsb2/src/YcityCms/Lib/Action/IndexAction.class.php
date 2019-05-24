<?php
/**
 *
 * 首页
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v3.1.2 2012-12-10 Y-city $

 */

if(!defined("YCITYCMS")) exit("Access Denied");
class IndexAction extends HomeAction
{
	function _initialize()
	{
		parent::_initialize();
	}
	public function index()
	{
		$publish = array(1,3);
		$condition['publish'] = array('in', $publish);
		$condition['status'] = array('neq',1);//隐藏
		$flashList = M('content')->where($condition)->order('istop desc,display_order desc,create_time DESC,id desc')->limit(5)->select();
		$this->assign('flashList', $flashList);

		$flashList1 = M('content')->where($condition)->order('istop desc,display_order desc,create_time DESC,id desc')->limit(6)->select();
		$this->assign('flashList1', $flashList1);

		$advlist = M('adv')->field('id,title,link_url,attach_file')->order('display_order desc,create_time desc,id desc')->limit(6)->select();
		$this->assign('advlist', $advlist);
		
		$video = M('video')->order('istop desc,display_order desc,create_time desc,id desc')->where('status!=1')->field('*')->find();
		$this->assign('video',$video);

		$picturelist = M('picture')->order('display_order desc,create_time desc,id desc')->field('*')->limit(4)->select();
		$this->assign('picList',$picturelist);
		$this->display();
	}

	public function nihao()
	{
		$this->display();
	}

}