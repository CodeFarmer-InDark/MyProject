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

class UserAction extends AdminAction
{
    public $dao;
	public function _initialize()
	{
		parent::_initialize();
		$this->dao = D('User');

		//根据角色ID，判断输出模板
		$roleList = M('Role')->Order("id DESC")->select();
		empty($roleList) && parent::_message('error', '用户组丢失，请检查');
		$this->assign('roleList', $roleList);
	}

    /**
     * 列表
     *
     */
	public function index()
	{
		parent::_checkPermission();
		$condition = array();
		$username = formatQuery($_GET['username']);
		$userId = intval($_GET['userId']);
		$orderBy = trim($_GET['orderBy']);
		$orderType = trim($_GET['orderType']);
		$setOrder = setOrder(array(array('loginCount', 'a.login_count'), array('id', 'a.id')), $orderBy, $orderType);
		$pageSize = intval($_GET['pageSize']);
		$roleId = intval($_GET['roleId']);

		$username &&  $condition['a.username'] = array('like', '%'.$username.'%');
		$userId &&  $condition['a.id'] = array('eq', $userId);
		$roleId && $condition['a.role_id'] = array('eq',$roleId);
		$count = $this->dao->where($condition)->count();
		$listRows = empty($pageSize) || $pageSize > 100 ? 15 : $pageSize ;
		$p = new page($count, $listRows);
		$dataList = $this->dao->Table(C('DB_PREFIX').'user a')->Join(C('DB_PREFIX').'role b on a.role_id=b.id')->Field('a.*,b.role_name as role_name')->Order($setOrder)->Where($condition)->Limit($p->firstRow.','.$p->listRows)->select();

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
		parent::_checkPermission('User_insert');
		parent::_setMethod('post');
		if(!isEnglist($_POST['username'])) parent::_message('error', '用户名必须为英文或英文数字的组合');
		if (trim($_POST['password']) != trim($_POST['opassword'])){
			parent::_message('error', '两次输入密码不一致');
		}
		if($daoCreate = $this->dao->create()) {
			$this->dao->password = sysmd5($_POST['password']);
			$this->dao->prower = empty($_POST['prower']) ? 'allno' : implode(',', $_POST['prower']) ;
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
		//获取角色ID
		$rollId = parent::_getRoleId();
		$this->assign('jumpUri', $jumpUri);
		$this->assign('vo', $record);

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
        parent::_checkPermission('User_modify');
	    parent::_setMethod('post');
		$item = intval($_POST['id']);
		//在无管理员管理权限的情况下，可以编辑自己帐户信息
		if($item != parent::_getAdminUid()) parent::_checkPermission('Admin_modify');
		empty($item) && parent::_message('error', 'ID获取错误,未完成编辑');
		$password = $_POST['password'];
		$opassword = $_POST['opassword'];
		if($password !== $opassword){
			parent::_message('error','两次输入密码不一致');
		}
		if($this->dao->create()) {
			if ($password !== null){
				$this->dao->password = sysmd5(trim($_POST['password']));
			}
			if($item == 1) {
				//防止修改默认用户所发属组导致不能登录
				$this->dao->role_id = 1;
			}
			$this->dao->prower = empty($_POST['prower']) ? 'allno' : implode(',', $_POST['prower']) ;
			if($_POST['id']==1)
			{
				$this->dao->prower = empty($_POST['prower']) ? 'all' : implode(',', $_POST['prower']) ;
			}
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
		parent::_checkPermission('User_command');
		if(getMethod() == 'get'){
			$operate = trim($_GET['operate']);
		}elseif(getMethod() == 'post'){
			$operate = trim($_POST['operate']);
		}else{
			parent::_message('error', '只支持POST,GET数据');
		}
		switch ($operate){
			case 'delete':
				parent::_delete('user', 0, array('attach_image', 'attach_thumb'),$_POST);
				break;
			case 'update': parent::_batchModify('user', $_POST, array('realname')); break;
			default: parent::_message('error', '操作类型错误') ;
		}
	}
}
