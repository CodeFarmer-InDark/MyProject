<?php 
/**
 * 
 * News(新闻)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

class AdvAction extends AdminAction
{
    protected $category , $dao;
    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('adv');
    }

    /**
	 * 列表
	 *
	 */
    public function index()
    {
        parent::_checkPermission('Adv_index');

        $count = $this->dao->count();//'Sortid<>9 AND Sortid<>10'
        $listRows = empty($pageSize) || $pageSize > 100 ? 15 : $pageSize ;
        $p = new page($count, $listRows);
        $dataList = $this->dao->Order( 'id DESC')->Limit($p->firstRow.','.$p->listRows)->select();
        $page = $p->show();
        if ($dataList !== false)
        {
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
    public function insert()
    {
        parent::_checkPermission('Adv_insert');
        $category = D('Sort')->Field('SortID,ParentID,SortName')->where(' SortID<>8 and SortID<>231 and SortID<>97 and SortID<>98 and SortID<>96 and SortID<>222')->Order('SortID DESC')->select();
        foreach ((array)$category as $row){
            if($row['ParentID'] == '0'){
                $parentId = $row['SortID'];
            }
        }
        //取主ID下属分类
        $this->assign('parentId', 0);

        $this->assign('category', $category);
        $this->display();
    }

    /**
     * 提交录入
     *
     */
    public function doInsert()
    {
        parent::_checkPermission('Adv_insert');
        parent::_setMethod('post');
        if($daoCreate = $this->dao->create())
        {
            $this->dao->user_id = parent::_getAdminUid();
            $this->dao->username = parent::_getAdminName();
            $uploadFile = upload($this->getActionName());
            if ($uploadFile)
            {
                $this->dao->attach = 1;
                $this->dao->attach_file = formatAttachPath($uploadFile[0]['savepath'],'../Uploads/') . $uploadFile[0]['savename'];
                // $this->dao->attach_thumb = fileExit($uploadFile[0]['savepath'] . splitThumb($uploadFile[0]['savename'])) ? formatAttachPath($uploadFile[0]['savepath']) . splitThumb($uploadFile[0]['savename']) : '' ;
            }else{ parent::_message('error', '未上传图片');}
            $this->dao->create_time = strtotime($_POST['create_time']);
            $daoAdd = $this->dao->add();
            if(false !== $daoAdd)
            {
                parent::_tags('insert', $_POST['tags'], $daoAdd);
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
     * 编辑
     *
     */
    public function modify()
    {
        parent::_checkPermission('Adv_modify');

        $item = intval($_GET["id"]);

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
        parent::_checkPermission('Adv_modify');
        parent::_setMethod('post');
        $item = intval($_POST['id']);
        empty($item) && parent::_message('error', '记录不存在');
        if($daoCreate = $this->dao->create())
        {
            $uploadFile = upload($this->getActionName());
            if ($uploadFile)
            {
                $this->dao->attach_file = formatAttachPath($uploadFile[0]['savepath'],'../Uploads/') . $uploadFile[0]['savename'];
                if($_POST['deleteFile'] == 1){
                    @unlink('././Uploads/'.$_POST['old_file']);
                }
            }
            if($_POST['deleteFile'] == 1 && !$uploadFile){
                @unlink('././Uploads/'.$_POST['old_file']);
                $this->dao->attach_file='';
                $this->dao->attach='';
            }
            $this->dao->title = $_POST['title'];
            $this->dao->OutLink = $_POST['link_url'];
            $this->dao->SortID = $_POST['id'];
            $this->dao->create_time = strtotime($_POST['create_time']);
            $this->dao->update_time = strtotime(date('Y-m-d H:i:s'));
            $daoSave = $this->dao->save();
            if(false !== $daoSave)
            {
                parent::_tags('modify', $_POST['tags'], $item);
                parent::_sysLog('modify', "编辑:$item");
                parent::_message('success', '更新完成');
            }else
            {
                parent::_message('error', '更新失败');
            }
        }else
        {
            parent::_message('error', $this->dao->getError());
        }
    }

    public function doDelete()
    {

        parent::_checkPermission('Adv_delete');
        parent::_setMethod('post');
        $item = intval($_POST['id']);
        empty($item) && parent::_message('error', '记录不存在');
      //  $daoResult=$dao->where($condition)->delete();
    }

    /**
     * 批量操作
     *
     */
    public function doCommand()
    {
        parent::_checkPermission('Adv_command');
        if(getMethod() == 'get'){
            $operate = trim($_GET['operate']);
        }elseif(getMethod() == 'post'){
            $operate = trim($_POST['operate']);
        }else{
            parent::_message('error', '只支持POST,GET数据');
        }
        $newCategory = intval($_POST['newCategory']);
        switch ($operate){
            case 'delete':
                parent::_delete('adv', 0, array('attach_file', 'attach_thumb'));
                break;
            case 'recommend': parent::_recommend('set','adv');break;
            case 'unRecommend': parent::_recommend('unset','adv');break;
            case 'setTop': parent::_setTop('set','adv');break;
            case 'unSetTop': parent::_setTop('unset','adv');break;
            case 'setStatus': parent::_setStatus('set','adv');break;
            case 'unSetStatus': parent::_setStatus('unset','adv');break;
            case 'update': parent::_batchModify('adv', $_POST, array('display_order'), __URL__,'Adv', 'display_order DESC,id DESC');break;
            case 'move': parent::_move($newCategory);break;
            default: parent::_message('error', '操作类型错误') ;
        }
    }
}
