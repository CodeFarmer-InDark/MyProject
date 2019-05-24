<?php
/**
 * 
 * Admin(管理员)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

class TeacherAction extends AdminAction
{
    public $dao;
	public function _initialize()
	{
		parent::_initialize();
		$this->dao = D('Teacher');

		$category = D('Category')->where('parent_id=35')->Order('display_order DESC,id desc')->select();
		foreach ($category as $k => $v) {
			if (  $v['module']=='Other') {
				$categoryType[] = $v;
			}
		}
		//取主ID下属分类
		$this->assign('cate_type', $categoryType);

		$category = D('Category')->where('parent_id=44')->Order('display_order DESC,id desc')->select();
		foreach ($category as $k => $v) {
			if (  $v['module']=='Other' && $v['keyword']=='College') {
				$categoryCollege[] = $v;
			}elseif($v['module']=='Other' && $v['keyword']=='') {
				$categoryPosition[] = $v;
			}
		}
		//取主ID下属分类
		$this->assign('cate_college', $categoryCollege);
		$this->assign('cate_position', $categoryPosition);

	}

    /**
     * 列表
     *
     */
	public function index()
	{
		parent::_checkPermission();
		$condition = array();
		$username = formatQuery($_GET['title']);
		
		$orderBy = trim($_GET['orderBy']);
		$orderType = trim($_GET['orderType']);
		$setOrder = setOrder(array(array('loginCount', 'login_count'), array('id', 'id')), $orderBy, $orderType);
		$pageSize = intval($_GET['pageSize']);

		$username &&  $condition['title'] = array('like', '%'.$username.'%');
		$count = $this->dao->where($condition)->count();
		$listRows = empty($pageSize) || $pageSize > 100 ? 15 : $pageSize ;
		$p = new page($count, $listRows);
		$dataList = $this->dao->Order($setOrder)->Where($condition)->Limit($p->firstRow.','.$p->listRows)->select();

		$page = $p->show();
		if($dataList!=false){
			//$this->assign('roleList', $adminRoleList);
			$this->assign('pageBar', $page);
			$this->assign('dataList', $dataList);
		}
		
		parent::_sysLog('index');
		$this->display();
	}

	/**
     * 录入
     *
     */
	public function insert(){
		parent::_checkPermission();
		$this->display();
	}

	/**
     * 提交录入
     *
     */
	public function doInsert()
	{
		parent::_checkPermission('Teacher_insert');
		parent::_setMethod('post');
		if($daoCreate = $this->dao->create()) {
			$this->dao->create_time=strtotime($_POST['create_time']);
			$daoAdd = $this->dao->add();
			if(false !== $daoAdd){
				parent::_sysLog('insert', "录入:$daoAdd");
				parent::_message('success', '录入成功');
			}else{
				parent::_message('error', '录入失败');
			}
		}else{
			parent::_message('error', $this->dao->getError());
		}
	}

	/**
     * 编辑
     *
     */
	public function modify()
	{
        parent::_checkPermission();
        $item = intval($_GET["id"]);
		$jumpUri = trim($_GET['jumpUri']);
		//编辑自己资料时跳过权限检测，可以编辑自己帐户信息
		if($item != parent::_getAdminUid()) parent::_checkPermission();
		$record = $this->dao->Where('id='.$item)->find();
		if (empty($item) || empty($record)) parent::_message('error', '记录不存在');

		$this->assign('jumpUri', $jumpUri);
		$this->assign('vo', $record);

		switch ($record['college']){
			case 112 :$this->assign('college','材料工程系');break;
			case 111 :$this->assign('college','材料化学系');break;
			case 110 :$this->assign('college','材料科学与工程实验中心');break;
		}
		switch ($record['type']){
			case 117 :$this->assign('type','硕士生导师');break;
			case 116 :$this->assign('type','博士生导师');break;
		}
		switch ($record['position']){
			case 113 :$this->assign('position','教授');break;
			case 114 :$this->assign('position','副教授');break;
			case 115 :$this->assign('position','讲师');break;
		}
		
//		$dataList = M('power')->select();
//		$this->assign('dataList', $dataList);
		$this->display();
	}

	/**
     * 提交编辑
     *
     */
	public function doModify()
	{
        parent::_checkPermission('Teacher_modify');
	    parent::_setMethod('post');
		$item = intval($_POST['id']);
		//在无管理员管理权限的情况下，可以编辑自己帐户信息
		if($item != parent::_getAdminUid()) parent::_checkPermission('Admin_modify');
		empty($item) && parent::_message('error', 'ID获取错误,未完成编辑');

		if($this->dao->create()) {
			$this->dao->update_time=strtotime($_POST['update_time']);
			$daoSave = $this->dao->save();
			if(false !== $daoSave)
			{
				//防止无权限操作情况下，修改自身资料跳转死循环
				$jumpUri = empty($_POST['jumpUri']) ? 0 : U('Index/index');
				parent::_sysLog('modify', "编辑:$item");
				parent::_message('success', '更新成功', $jumpUri);
			}else
			{
				parent::_message('error', '更新失败');
			}
		}else{
			parent::_message('error', $this->dao->getError());
		}
	}

	/**
     * 批量操作
     *
     */
	public function doCommand()
	{
		parent::_checkPermission('Teacher_command');
		if(getMethod() == 'get'){
			$operate = trim($_GET['operate']);
		}elseif(getMethod() == 'post'){
			$operate = trim($_POST['operate']);
		}else{
			parent::_message('error', '只支持POST,GET数据');
		}
		switch ($operate){
			case 'delete':
				parent::_tagsDelete('teacher');
				parent::_delete('teacher', 0, array('attach_image', 'attach_thumb'),$_POST);
				break;
			default: parent::_message('error', '操作类型错误') ;
		}
	}
}
