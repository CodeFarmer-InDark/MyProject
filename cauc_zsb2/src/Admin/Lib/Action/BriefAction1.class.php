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

class BriefAction extends AdminAction
{
    public $dao,$dot,$upload,$finalPath;
	public function _initialize()
	{
		parent::_initialize();

		$this->dao = D('Brief1');
		import('ORG.NET.UploadFile');
		$this->upload = new UploadFile();
		$this->upload->maxsize = 20480; //附件上传大小20M
		$this->upload->allowExts = array('pdf');

		$time = time();
		$this->upload->saveRule = 'BriefIntro'.$time;

		$this->dot = '/';
		$setFolder = 'Brief1/' ;
		$setUserPath = '';
		$finalPath = UPLOAD_PATH.$this->dot.$setFolder.$setUserPath;;
		$this->upload->savePath =  $finalPath;
	}

    /**
     * 列表
     *
     */
	public function index()
	{
		parent::_checkPermission();

		if (file_exists(UPLOAD_PATH.$this->dot.'Brief1')){
			$this->assign('flag','存在');
		}
		parent::_sysLog('index');
		$this->display();
	}

	/**
	 * 导入
	 */
	public function doImport(){
		parent::_checkPermission('Brief_import');

		if (!empty($_FILES['file']['name'])){
			if (!$this->upload->upload()){
				$this->error($this->upload->getErrorMsg());
			} //上传错误提示信息
			else {
				parent::_message('success',"文件上传成功");
			}
		}
	}

}
