<?php 
/**
 * 
 * Link(友情链接)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

class LinkAction extends AdminAction
{
    public $dao;
    function _initialize()
    {
        parent::_initialize();
        $this->dao = D('links');
    }
    /**
	 * 列表
	 *
	 */
    public function index()
    {
        parent::_checkPermission('Link_index');
        $condition = array();
        
        $count = $this->dao->Table(C('DB_PREFIX').'links c')->Join(C('DB_PREFIX').'category s on c.LinkType = s.id')->where($condition)->count();
        $listRows = empty($pageSize) || $pageSize > 100 ? 15 : $pageSize ;
        $p = new page($count, $listRows);
        $dataList = $this->dao->Table(C('DB_PREFIX').'links c')->Join(C('DB_PREFIX').'category s on c.LinkType = s.id')->Field('s.title as gtitle,c.*')->Order( 'c.id DESC')->Where($condition)->Limit($p->firstRow.','.$p->listRows)->select();
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
     * 录入
     *
     */
    public function insert()
    {
        parent::_checkPermission('Link_insert');
        $this->display();
    }
    /**
     * 提交录入
     *
     */
    public function doInsert()
    {
        parent::_checkPermission('Link_insert');
        parent::_setMethod('post');
        $LinkType=trim($_POST['LinkType']);
        if ($LinkType){
            $dataList = M('Category')->where("title='$LinkType'")->field('id')->find();
        }
        if($daoCreate = $this->dao->create())
        {
            $this->dao->LinkType = intval($dataList['id']);
            $daoAdd = $this->dao->add();
            if(false !== $daoAdd)
            {
                writeCache('Link');
                parent::_sysLog('insert', "录入:$daoAdd");
                parent::_message('success', '录入成功');
            }else
            {
                parent::_message('error', '录入成功');
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
        parent::_checkPermission('Link_modify');
        $item = intval($_GET["id"]);
        $record = $this->dao->Where('id='.$item)->find();
        if (empty($item) || empty($record)) parent::_message('error', '记录不存在');
        $this->assign('vo',$record);
        $LinkType=$record['LinkType'];
        $dataList = M('Category')->where("id='$LinkType'")->field('title')->find();
        $this->assign('type',$dataList['title']);
        $this->display();
    }

    /**
     * 提交编辑
     *
     */
    public function doModify()
    {
        parent::_checkPermission('Link_modify');
        parent::_setMethod('post');
        $item = intval($_POST['id']);
        $LinkType=trim($_POST['LinkType']);
        if ($LinkType){
            $dataList = M('Category')->where("title='$LinkType'")->field('id')->find();
        }
        empty($item) && parent::_message('error', 'ID获取错误,未完成编辑');
        if($daoCreate = $this->dao->create())
        {
            $this->dao->LinkType = intval($dataList['id']);
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

    public function doDelete()
    {

        parent::_checkPermission('News_delete');
        parent::_setMethod('post');
        $item = intval($_POST['id']);
        empty($item) && parent::_message('error', '记录不存在');
        parent::_delete('links', $_POST, array('attach_image', 'attach_thumb'));
        //  $daoResult=$dao->where($condition)->delete();
    }

    /**
     * 批量操作
     *
     */
    public function doCommand()
    {
        parent::_checkPermission('Link_command');
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
                parent::_delete('links', 0, array('attach_image', 'attach_thumb'),$_POST);
                break;
            case 'setStatus': parent::_setStatus('set');break;
            case 'unSetStatus': parent::_setStatus('unset');break;
            case 'update': parent::_batchModify('links', $_POST, array('LinkText', 'LinkURL', ));break;
            default: parent::_message('error', '操作类型错误') ;
        }
    }
}
