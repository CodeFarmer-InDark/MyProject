<?php 
/**
 * 
 * Contact(联系我们)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

class ContactAction extends AdminAction
{
    public $dao;
	function _initialize()
	{
		parent::_initialize();
		$this->dao = D('Page');
	}
	/**
     * 编辑
     *
     */
	public function modify(){

		parent::_checkPermission();
		$item = 2;
		$dao = D("Page");
		$record = $this->dao->where('id='.$item)->find();
		if (empty($item) || empty($record)) parent::_message('error', '记录不存在');
		$this->assign('vo', $record);
		$this->display();
	}

	/**
     * 提交编辑
     *
     */
	public function doModify()
	{
		parent::_checkPermission('Contact_modify');
		parent::_setMethod('post');
		$item = intval($_POST['id']);
		empty($item) && parent::_message('error', 'ID获取错误,未完成编辑');
		if($daoCreate = $this->dao->create())
		{
			$uploadFile = upload($this->getActionName());
			if ($uploadFile)
			{
				$this->dao->attach_image = formatAttachPath($uploadFile[0]['savepath'],'../Uploads/') . $uploadFile[0]['savename'];
				$this->dao->attach_thumb = fileExit($uploadFile[0]['savepath'] . splitThumb($uploadFile[0]['savename'])) ? formatAttachPath($uploadFile[0]['savepath'],'../Uploads/') . splitThumb($uploadFile[0]['savename']) : '' ;
				$this->dao->attach_ext = $uploadFile[0]['extension'];
				@unlink('./'.$this->upload.$_POST['old_image']);
				@unlink('./'.$this->upload.$_POST['old_thumb']);
			}
			$daoSave = $this->dao->save();
			if(false !== $daoSave)
			{
				parent::_sysLog('modify', "编辑:$item");
				parent::_message('success', '更新成功', U('Contact/modify'));
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
