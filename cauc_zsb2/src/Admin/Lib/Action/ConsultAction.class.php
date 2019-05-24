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

class ConsultAction extends AdminAction
{
    protected $dao;
    function _initialize()
    {
        parent::_initialize();
       
        $this->dao = D('Consult');
    }

    /**
     * 列表
     *
     */
    public function index()
    {
        parent::_checkPermission();

        $count = $this->dao->count();
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
        parent::_checkPermission();
        $this->display();
    }

    /**
     * 提交录入
     *
     */
    public function doInsert()
    {
        parent::_checkPermission('Consult_insert');
        parent::_setMethod('post');
        if($daoCreate = $this->dao->create())
        {
            $this->dao->create_time = strtotime($_POST['create_time']);
            $daoAdd = $this->dao->add();

            if(false !== $daoAdd){
                parent::_tags('insert', $_POST['tags'], $daoAdd);
                parent::_sysLog('insert', "录入:$daoAdd");
                parent::_message('success', '录入成功');
            }else{
                parent::_message('error', '录入失败');
            }
        }else{
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

        //dump($record);return;
        $this->assign('vo', $record);
        $this->display();
    }

    /**
     * 提交编辑
     *
     */
    public function doModify()
    {

        
        parent::_checkPermission('Consult_modify');
        parent::_setMethod('post');
        $item = intval($_POST['id']);
        empty($item) && parent::_message('error', '记录不存在');
        if($daoCreate = $this->dao->create()){
            //如果页面的更新日期和当前日期不同，则存页面的更新日期
            if($_POST['update_time'] == date("Y-m-d",time()))
            {
                $uptime = time();
            }else{
                $uptime = strtotime($_POST['update_time']);
            }
            $this->dao->update_time = $uptime;
            $daoSave = $this->dao->save();
            if(false !== $daoSave){
                parent::_tags('modify', $_POST['tags'], $item);
                parent::_sysLog('modify', "编辑:$item");
                parent::_message('success', '更新完成');
            }else{
                parent::_message('error', '更新失败');
            }
        }else{
            parent::_message('error', $this->dao->getError());
        }

    }

    public function doDelete()
    {

        parent::_checkPermission('Consult_delete');
        parent::_setMethod('post');
        $item = intval($_POST['id']);
        empty($item) && parent::_message('error', '记录不存在');
        parent::_delete('content', $_POST, array('attach_image', 'attach_thumb'));
        //  $daoResult=$dao->where($condition)->delete();
    }

    /**
     * 批量操作
     *
     */
    /**
     * 批量操作
     *
     */
    public function doCommand()
    {
        parent::_checkPermission('Consult_command');
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
                parent::_tagsDelete('consult');
                parent::_delete('consult', 0, array('attach_image', 'attach_thumb'),$_POST);
                break;
            case 'setTop': parent::_setTop('set','consult');break;
            case 'unSetTop': parent::_setTop('unset','consult');break;
            case 'update': parent::_batchModify('consult', $_POST, array('title','display_order'));break;
            default: parent::_message('error', '操作类型错误') ;
        }
    }
}
