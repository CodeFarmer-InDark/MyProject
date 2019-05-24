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

class SubjectAction extends AdminAction
{
    public $dao;
	public function _initialize()
	{
		parent::_initialize();
		$this->dao = D('Subject');
	}

    /**
     * 列表
     *
     */
	public function index()
	{
		parent::_checkPermission('Search_index');
        $count = $this->dao->count();
        $p = new page($count, 20);
        $dataList = $this->dao->Order("id desc")->Limit($p->firstRow.','.$p->listRows)->select();
        $page = $p->show();

		$dao=D('Remark');
		$remark = $dao->where('category_id=39')->order('id desc')->find();
		$this->assign('remark',$remark['content']);

		if($dataList!=false){
			$this->assign('pageBar', $page);
			$this->assign('dataList', $dataList);
		}
		parent::_sysLog('index');
		$this->display();
	}

	/**
	 * 导入
	 */
	public function doImport(){
		parent::_checkPermission('Search_import');
		$filename = $_FILES['file']['tmp_name'];
		
		if (empty($filename)){
			parent::_message('error','请选择要导入的CSV文件!');
		}
		$dataList = inputCsv($filename,'year,major,direction,level,province,subjectdemand,signdemand');//解析CSV
		unset($dataList[0]);
		foreach($dataList as $k=>$v){
			$u["year"] = $v['year'];
			$u["major"] = $v['major'];
			if ($v['direction']){
				$u["major"] = $v['major']."（".$v['direction']."）";
			}else{
				$u["major"] = $v['major'];
			}
			$u["level"] = $v['level'];
			$u["province"] = $v['province'];
			$u["subjectdemand"] = $v['subjectdemand'];
			$u["signdemand"] = $v['signdemand'];
			$u["create_time"] = time();
			$daoAdd = $this->dao->data($u)->add();
		}

		$dao=D('Remark');
		$dao->content = $_POST['remark'];
		$dao->category_id = 39;//报考科目的备注
		$dao->add();

		if (false !== $daoAdd){
			parent::_message('success','导入成功');
		}else{
			parent::_message('error','导入失败');
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
		$record = $this->dao->Where('id='.$item)->find();
		if (empty($item) || empty($record)) parent::_message('error', '记录不存在');
		$this->assign('jumpUri', $jumpUri);
		$this->assign('vo', $record);

		$dao = M('province');
		$pName = $record['province'];
		$this->assign('pName',$pName);
		$provinceArr = $dao->order('id asc')->select();
		$this->assign('provinceArr',$provinceArr);
		$this->display();
	}

	/**
     * 提交编辑
     *
     */
	public function doModify()
	{
		parent::_checkPermission('Search_modify');
	    parent::_setMethod('post');
		$item = intval($_POST['id']);
		empty($item) && parent::_message('error', 'ID获取错误,未完成编辑');

		if($this->dao->create()) {
		$this->dao->region = $_POST['province'];
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
		parent::_checkPermission('Search_command');
		if(getMethod() == 'get'){
			$operate = trim($_GET['operate']);
		}elseif(getMethod() == 'post'){
			$operate = trim($_POST['operate']);
		}else{
			parent::_message('error', '只支持POST,GET数据');
		}
		switch ($operate){
			case 'delete': parent::_delete('subject', 0, array('attach_image', 'attach_thumb'),$_POST);break;
			default: parent::_message('error', '操作类型错误') ;
		}
	}

}