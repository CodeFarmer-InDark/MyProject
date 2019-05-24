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

class MajorAction extends AdminAction
{
    public $dao;
	public function _initialize()
	{
		parent::_initialize();
		$this->dao = D('Major');
	}

    /**
     * 列表
     *
     */
	public function index()
	{
		parent::_checkPermission('College_index');
        $count = $this->dao->count();
        $p = new page($count, 20);
        $dataList = $this->dao->Order("id asc")->Limit($p->firstRow.','.$p->listRows)->select();
        $page = $p->show();

		$dao=D('Remark');
		$remark = $dao->where('category_id=14')->order('id desc')->find();
		$this->assign('remark',$remark['content']);

		if($dataList!=false){
			$this->assign('pageBar', $page);
			$this->assign('dataList', $dataList);
		}
		parent::_sysLog('index');
		$this->display();
	}

	/**
	 * 导入CSV文件
	 */
    public function doImport(){
        parent::_checkPermission('College_import');
        $filename = $_FILES['file']['tmp_name'];
        $dataList = inputCsv($filename,'college,major,length,type,target,fee,demand,achievement');//解析CSV
		unset($dataList[0]);
        foreach($dataList as $k=>$v){
			$u["college"] = $v['college'];
            $u["major"] = $v['major'];
            $u["length"] = $v['length'];
            $u["type"] = $v['type'];
            $u["target"] = $v['target'];
			$u["fee"] = $v['fee'];
            $u["demand"] = $v['demand'];
			$u["achievement"] = $v['achievement'];
			$u["create_time"] = time();
            $daoAdd = $this->dao->data($u)->add();
		}
		
		$dao=D('Remark');
		$dao->content = $_POST['remark'];
		$dao->category_id = 14;//专业一览的备注
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
		$this->display();
	}

	/**
     * 提交编辑
     *
     */
	public function doModify()
	{
        parent::_checkPermission('College_modify');
	    parent::_setMethod('post');
		$item = intval($_POST['id']);
		empty($item) && parent::_message('error', 'ID获取错误,未完成编辑');

		if($this->dao->create()) {

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
		parent::_checkPermission('College_command');

		if(getMethod() == 'get'){
			$operate = trim($_GET['operate']);
		}elseif(getMethod() == 'post'){
			$operate = trim($_POST['operate']);
		}else{
			parent::_message('error', '只支持POST,GET数据');
		}
		
		switch ($operate){
			case 'delete': parent::_delete('Major', 0, array('attach_image', 'attach_thumb'),$_POST);
			break;
			default: parent::_message('error', '操作类型错误') ;
		}
	}

	/** 清除专业Major所有数据 */
	public function deleteAll()
	{
		parent::_checkPermission('College_command');

		if(getMethod() == 'get')
		{
			parent::_deleteAll('Major');
		}
	}

}
