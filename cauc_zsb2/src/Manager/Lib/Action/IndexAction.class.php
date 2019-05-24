<?php 
/**
 * 
 * Index(后台首页)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

class IndexAction extends BaseAction{
    function _initialize()
    {
        parent::_initialize();
        $adminId = parent::_getAdminUid();
        $username = parent::_getAdminName();
        $roleId = parent::_getRoleId();
		$roleName = parent::_getRoleName();
		$realName = parent::_getRealName();
        // if (!$roleId || !$adminId) $this->redirect(U('Public/login'));
        $this->assign('adminId', $adminId);
        $this->assign('username', $username);
        //$this->assign('security', $security);
		$this->assign('roleName', $roleName);
		$this->assign('realName', $realName);
        parent::_checkPermission();
    }

    /**
     * 后台管理首页
     *
     */
    public function index()
    {
        $update = safe_b64encode(serialize($data));
        //获取备忘信息
        //$data['notepad'] = M('Admin')->Where("id=".parent::_getAdminUid())->find();
		//获取用户信息
		$user = D('User')->where('id='.parent::_getAdminUid())->find();//获取用户
		$this->assign('user', $user);
        $this->assign($data);
        $this->assign('update', $update);
        parent::_sysLog('index');
        $this->display();
    }
}
