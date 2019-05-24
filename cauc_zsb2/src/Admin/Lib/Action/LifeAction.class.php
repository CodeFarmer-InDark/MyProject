<?php 
/**
 * 
 * Case(案例)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

class LifeAction extends AdminAction
{
    protected $category, $dao;
    function _initialize()
    {
        parent::_initialize();

        $this->dao = D('Life');
    }

    /**
     * 列表
     *
     */
    public function index()
    {
        parent::_checkPermission();
        $condition = array();
        $title = formatQuery($_GET['title']);
        $recommend = intval($_GET['recommend']);

        $status =  intval($_GET['status']);

        $createTime = trim($_GET['createTime']);
        $createTime1 = trim($_GET['createTime1']);
        $viewCount = intval($_GET['viewCount']);
        $viewCount1 = intval($_GET['viewCount1']);

        $setTime = setTime($createTime, $createTime1);
        $setViewCount = setViewCount($viewCount, $viewCount1);
        $pageSize = intval($_GET['pageSize']);
        $title &&  $condition['title'] = array('like', '%'.$title.'%');
        $recommend &&  $condition['recommend'] = array('eq', $recommend);

        $status && $condition['status'] = array('eq', $status);
        $createTime1 && $condition['create_time'] = array('between', $setTime);
        $viewCount1 && $condition['view_count'] = array('between', $setViewCount);
        $count = $this->dao->where($condition)->count();
        $listRows = empty($pageSize) || $pageSize>100 ? 15 : $pageSize ;
        $p = new page($count,$listRows);
        $dataList = $this->dao->Order( 'id DESC')->Where($condition)->Limit($p->firstRow.','.$p->listRows)->select();

        $page = $p->show();
        if($dataList !== false)
        {
            $this->assign('pageBar', $page);
            $this->assign('dataList', $dataList);
        }
        parent::_sysLog('index');
        $this->display();
    }

    /**
     * 写入
     *
     */
    public function insert()
    {
        parent::_checkPermission();
        $this->display();
    }

    /**
     * 提交录入
     *
     */
    public function doInsert()
    {
        parent::_checkPermission('Life_insert');
        if($daoCreate = $this->dao->create())
        {
            $this->dao->user_id = parent::_getAdminUid();
            $this->dao->username = parent::_getAdminName();
            $uploadFile = upload($this->getActionName());
            if ($uploadFile)
            {
                $this->dao->attach = 1;
                $this->dao->attach_image = formatAttachPath($uploadFile[0]['savepath'],'../Uploads/') . $uploadFile[0]['savename'];
                $this->dao->attach_thumb = fileExit($uploadFile[0]['savepath'] . splitThumb($uploadFile[0]['savename'])) ? formatAttachPath($uploadFile[0]['savepath'],'../Uploads/') . splitThumb($uploadFile[0]['savename']) : '' ;
            }

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
        parent::_checkPermission();
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
        parent::_checkPermission('Life_modify');
        parent::_setMethod('post');
        $item = intval($_POST['id']);
        empty($item) && parent::_message('error', '记录不存在');
        if($daoCreate = $this->dao->create())
        {
            $uploadFile = upload($this->getActionName());
            if ($uploadFile)
            {
                $this->dao->attach = 1;
                $this->dao->attach_image = formatAttachPath($uploadFile[0]['savepath'],'../Uploads/') . $uploadFile[0]['savename'];
                $this->dao->attach_thumb = fileExit($uploadFile[0]['savepath'] . splitThumb($uploadFile[0]['savename'])) ? formatAttachPath($uploadFile[0]['savepath'],'../Uploads/') . splitThumb($uploadFile[0]['savename']) : '' ;

                @unlink('./'.$this->upload.$_POST['old_image']);
                @unlink('./'.$this->upload.$_POST['old_thumb']);
            }

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
    /**
     * 批量操作
     *
     */
    public function doCommand()
    {
        parent::_checkPermission('Life_command');
        if(getMethod() == 'get'){
            $operate = trim($_GET['operate']);
        }elseif(getMethod() == 'post'){
            $operate = trim($_POST['operate']);
        }else{
            parent::_message('error', '只支持POST,GET数据');
        }
        $newCategory = intval($_POST['newCategory']);
        switch ($operate){
            case 'delete': parent::_delete('life', 0, array('attach_image', 'attach_thumb'));break;
            case 'setTop': parent::_setTop('set');break;
            case 'unSetTop': parent::_setTop('unset');break;
            case 'update': parent::_batchModify('life', $_POST, array('display_order','title'), __URL__,'Life', 'display_order DESC,id DESC');break;
            default: parent::_message('error', '操作类型错误') ;
        }
    }
}
