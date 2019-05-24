<?php
/**
 *
 * Page(单页)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

class RemarkAction extends AdminAction
{
	public $dao;
	function _initialize()
	{
		parent::_initialize();
		$this->dao = D('Remark');
	}
	/**
	 * 列表
	 *
	 */
	public function index()
	{
		parent::_checkPermission();
		$condition = array();
		$condition['category_id'] = array('in',array(55,56,57,58));
		$pageSize = intval($_GET['pageSize']);
		$count = $this->dao->where($condition)->count();
		$listRows = empty($pageSize) || $pageSize > 100 ? 10 : $pageSize ;
		$p = new page($count,$listRows);
		$dataList = $this->dao->Where($condition)->Limit($p->firstRow.','.$p->listRows)->order('id desc')->select();
		foreach ($dataList as $k=>$v){
			$dataList[$k]['categoryName'] = M('Category')->where('id = '.$v['category_id'])->getField('title');
		}

		$page = $p->show();
		if($dataList !== false){
			$this->assign('count',$count);
			$this->assign('pageBar', $page);
			$this->assign('dataList', $dataList);
		}
		parent::_sysLog('index');
		$this->display();
	}
	
	/**
	 * 编辑
	 *
	 */
	public function modify()
	{
		parent::_checkPermission();
		$item = intval($_GET["id"]);
		$record = $this->dao->where('id='.$item)->find();
		if (empty($item) || empty($record)) parent::_message('error', '记录不存在');
		$record['categoryName'] = M('Category')->where('id = '.$record['category_id'])->getField('title');
		$this->assign('vo', $record);
		$this->display();
	}

	/**
	 * 提交编辑
	 *
	 */
	public function doModify()
	{
		parent::_checkPermission('Remark_modify');
		parent::_setMethod('post');
		$item = intval($_POST['id']);
		empty($item) && parent::_message('error', 'ID获取错误,未完成编辑');
		if($daoCreate = $this->dao->create())
		{
			$this->dao->update_time = strtotime(date('Y-m-d H:i:s'));
			$daoSave = $this->dao->save();
			if(false !== $daoSave)
			{
				parent::_sysLog('modify', "编辑:$item");
				parent::_message('success', '更新成功');
			}else
			{
				parent::_message('error', '更新失败');
			}
		}else
		{
			parent::_message('error', $this->dao->getError());
		}
	}
}
