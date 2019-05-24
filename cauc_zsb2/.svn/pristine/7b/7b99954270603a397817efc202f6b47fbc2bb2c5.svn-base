<?php 
/**
 * 
 * User(会员)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

class LineAction extends BaseAction
{
    public $dao;
	public function _initialize()
	{
		parent::_initialize();
		$this->dao = D('Scoreline');

		$province = M('Province')->order('id asc')->select();
		$this->assign('province',$province);
	}

    /**
     * 列表
     *
     */
	public function index()
	{
		parent::_checkPermission('Manager_index');
		$condition = array();
		$province = intval($_GET['province']);
		$province &&  $condition['a.province'] = array('like', '%'.$province.'%');

		$count = $this->dao->where($condition)->count();
		$p = new page($count, 15);
		$dataList = $this->dao->Table(C('DB_PREFIX').'scoreline a')->Join(C('DB_PREFIX').'province b on a.province=b.id')->field('a.*,b.province as pName')->Order("a.id DESC")->Where($condition)->Limit($p->firstRow.','.$p->listRows)->select();
		$page = $p->show();
		if($dataList!=false){
			$this->assign('pageBar', $page);
			$this->assign('dataList', $dataList);
		}
		parent::_sysLog('index');
		$this->display();
	}

	/**
	 * 新增字段
	 *
	 */
	public function insert()
	{
		parent::_checkPermission('Manager_insert');
		$this->display();
	}

	/**
	 * 提交新增
	 */
	public function doInsert(){
		parent::_checkPermission('Manager_insert');
		parent::_setMethod('post');

		$pid = intval($_POST['province']);
		$mapProvince['province'] = $pid;
		$isExist = $this->dao->where($mapProvince)->getField('id');
		if (!empty($isExist)){
			parent::_message('errorUri','已添加该省市分数线，如需修改请在页面跳转后点击该省份右侧编辑按钮',U('Line/index'),5);
		}

		if($daoCreate = $this->dao->create())
		{
			$this->dao->create_time = time();
			$daoAdd = $this->dao->add();
			if(false !== $daoAdd)
			{
				parent::_sysLog('insert', "录入:$daoAdd");
				parent::_message('success', '录入成功');
			}else
			{
				parent::_message('error', '录入失败');
			}
		}else
		{
			parent::_message('error', $this->dao->getError());
		}
	}

	/**
	 * 编辑字段
	 *
	 */
	public function modify()
	{
		parent::_checkPermission('Manager_modify');
		$item = intval($_GET["id"]);
		$jumpUri = trim($_GET['jumpUri']);
		$record = $this->dao->Where('id='.$item)->find();
		if (empty($item) || empty($record)) parent::_message('error', '记录不存在');
		$this->assign('jumpUri', $jumpUri);
		$this->assign('vo', $record);
		$pName = M('Province')->where('id='.$record['province'])->getField('province');
		$this->assign('pName',$pName);
		$this->display();
	}

	/**
	 * 提交编辑
	 *
	 */
	public function doModify()
	{
		parent::_checkPermission('Manager_modify');
		parent::_setMethod('post');
		$item = intval($_POST['id']);
		empty($item) && parent::_message('error', 'ID获取错误,未完成编辑');
		if($this->dao->create()) {
			$this->dao->update_time = time();
			$daoSave = $this->dao->save();
			if(false !== $daoSave )
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
	 * 清空全部分数线
	 */
	public function delete(){
		parent::_checkPermission('Manager_delete');

		$data['scoreline'] = '';
		$data['update_time'] = time();
		$daoSave = $this->dao->where('1=1')->save($data);
		if(false !== $daoSave )
		{
			//防止无权限操作情况下，修改自身资料跳转死循环
			$jumpUri = empty($_POST['jumpUri']) ? 0 : U('Index/index');
			parent::_sysLog('delete', "清空");
			parent::_message('success', '已成功清除全部分数线', $jumpUri);
		}else
		{
			parent::_message('error', '清空失败');
		}

	}

	/**
     * 批量操作
     *
     */
	public function doCommand()
	{
		parent::_checkPermission('Manager_command');
		if(getMethod() == 'get'){
			$operate = trim($_GET['operate']);
		}elseif(getMethod() == 'post'){
			$operate = trim($_POST['operate']);
		}else{
			parent::_message('error', '只支持POST,GET数据');
		}
		switch ($operate){
			case 'update': parent::_batchModify('scoreline', $_POST, array('scoreline'),__URL__,'Scoreline'); break;
			default: parent::_message('error', '操作类型错误') ;
		}
	}
}
