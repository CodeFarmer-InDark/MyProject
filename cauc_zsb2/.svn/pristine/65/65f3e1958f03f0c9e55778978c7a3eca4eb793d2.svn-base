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

class PlanAction extends AdminAction
{
    public $dao;
	public function _initialize()
	{
		parent::_initialize();
		$this->dao = D('Plan');
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

		$dataList = inputCsv($filename,'year,province,batch,major,direction,plantype,type,target,fee,demand');//解析CSV
		unset($dataList[0]);
		foreach($dataList as $k=>$v){
			$u["year"] = $v['year'];
			$u["province"] = $v['province'];
			$u["batch"] = $v['batch'];
			if ($v['direction']){
				$u["major"] = $v['major']."（".$v['direction']."）";
			}else{
				$u["major"] = $v['major'];
			}
			$u["plantype"] = $v['plantype'];
			$u["type"] = $v['type'];
			$u["target"] = $v['target'];
			$u["fee"] = $v['fee'];
			$u["demand"] = $v['demand'];
			$u["create_time"] = time();
			$daoAdd = $this->dao->data($u)->add();
		}
		$dao=D('Remark');
		$remark=$_POST['remark'];
		$dao->content = $remark;
		$dao->category_id = 37;//报考科目的备注
		$dao->add();

		if (false !== $daoAdd){
			parent::_message('success','导入成功');
		}else{
			parent::_message('error','导入失败');
		}
	}

	/**
	 * 清空指定年份信息
	 */
	public function delete(){
		parent::_checkPermission('Search_command');
		$year = D('Plan')->distinct(true)->field('year')->order('year desc')->select();
		$this->assign('yearExt',$year);
		$this->display();
	}

	/**
	 * 清空指定年份信息操作
	 */
	public function doDelete(){
		parent::_checkPermission('Search_command');
		$year = htmlCv(dHtml($_POST['yearExist']));

		if ($year == '0'){
			parent::_message('error','年份必须选择');
		}
		$condition['year'] = array('eq',$year);
		$daoDelet = $this->dao->where($condition)->delete();

		if (false !== $daoDelet){
			parent::_message('success',"{$year}年记录清空成功");
		}else{
			parent::_message('error','清空失败');
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
			case 'delete': parent::_delete('plan', 0, array('attach_image', 'attach_thumb'),$_POST);break;
			default: parent::_message('error', '操作类型错误') ;
		}
	}

}
