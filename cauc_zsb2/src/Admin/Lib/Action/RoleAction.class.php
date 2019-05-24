<?php 
/**
 * 
 * AdminRole(管理角色)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

class RoleAction extends AdminAction
{
    public $dao;
    function _initialize()
    {
        parent::_initialize();
        $this->dao = D('Role');
    }

    /**
     * 列表
     *
     */
    public function index()
    {
        parent::_checkPermission();
        $dataList = $this->dao->Where($condition)->Order('id DESC')->select();
        if($dataList !== false)
        {
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
        $dataList = M('Module')->Where("module_permission!='all'")->select();
        $this->assign('dataList', $dataList);
        $this->display();
    }

    /**
     * 提交录入
     *
     */
    public function doInsert()
    {
        parent::_checkPermission('Role_insert');
        parent::_setMethod('post');
        if($daoCreate = $this->dao->create())
        {
            $this->dao->role_permission = empty($_POST['role_permission']) ? 'all' : implode(',', $_POST['role_permission']) ;
            $this->dao->category_permission = empty($_POST['category_permission']) ? 'all' : implode(',', $_POST['category_permission']) ;
            $daoAdd = $this->dao->add();
            if(false !== $daoAdd)
            {
                writeCache('role');
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
        $item = intval($_GET['id']);
        in_array($item, array(1, 2)) && parent::_message('error', '内置角色组不允许编辑');
        $adminRoleRecord = D('Role')->Where('id='.$item)->find();
        if (empty($item) || empty($adminRoleRecord)) parent::_message('error', '记录不存在');
        $dataList = D('Module')->Where("module_permission!='all'")->select();
        $this->assign('dataList', $dataList);
        $this->assign('vo', $adminRoleRecord);
        $this->display();
    }

    /**
     * 提交编辑
     *
     */
    public function doModify()
    {
        parent::_checkPermission('Role_modify');
        parent::_setMethod('post');
        $item = intval($_POST['id']);
        empty($item) && parent::_message('error', '记录不存在');
        in_array($item, array(1, 2)) && parent::_message('error', '内置角色组不允许编辑');
        if($daoCreate = $this->dao->create())
        {
            $this->dao->role_permission = empty($_POST['role_permission']) ? 'all' : implode(',', $_POST['role_permission']) ;
            $this->dao->category_permission = empty($_POST['category_permission']) ? 'all' : implode(',', $_POST['category_permission']) ;
            $daoSave = $this->dao->save();
            if(false !== $daoSave)
            {
                writeCache('role');
                parent::_sysLog('modify', "编辑:$item");
                parent::_message('success', '编辑成功');
            }else
            {
                parent::_message('error', '编辑失败');
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
        parent::_checkPermission('Role_command');
        if(getMethod() == 'get'){
            $operate = trim($_GET['operate']);
            $item = intval($_GET['id']);
        }elseif(getMethod() == 'post'){
            $operate = trim($_POST['operate']);
            $item = intval($_POST['id']);
        }else{
            parent::_message('error', '只支持POST,GET数据');
        }
        switch ($operate){
            case 'delete':
                $daoModel = D('User');
                //删除用户组会将此组所有用户移动到禁止访问组
                $daoModel->execute('UPDATE __TABLE__ SET `role_id`=2 WHERE `role_id`='.$item);
                parent::_delete1();break;
            default: parent::_message('error', '操作类型错误') ;
        }
    }
}
