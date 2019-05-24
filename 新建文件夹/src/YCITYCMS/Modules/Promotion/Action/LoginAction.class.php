<?php
/**
 *
 * Login(前台会员中心模块)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
if(!defined("YCITYCMS")) exit("Access Denied");
class LoginAction extends GlobalAction{

    function _initialize()
    {
        parent::_initialize();
        $this->dao = D('Teacher');
        //$this->dao1 = M('Member');
        $this->assign('moduleTitle', '教师登录');
    }
    function index()
    {
        if($_COOKIE['YC_userid']){
            $this->_message(success,'登录成功',U('Index/index'));
        }else{
            $this->display();
        }
    }
    function dologin()
    {
        $username = dHtml(htmlCv(trim($_POST['username'])));
        $password = dHtml(htmlCv(trim($_POST['password'])));

        if(empty($username) || empty($password)){
            echo 'emptyInfo';
            exit();
        }

        // LDAP variables
        /*$ldap['user'] = $username;
        $ldap['pass'] = $password;
        $ldap['host'] = 'ldap://10.3.1.13';
        $ldap['dn'] = $ldap['user'].'@cauc.edu.cn';
        $ldap['base'] = 'ou=CAUC,dc=cauc,dc=edu,dc=cn';

        // connecting to ldap
        $ldap['conn'] = ldap_connect($ldap['host']) or die( "Could not connect to server {$ldap['host']} ");

        // binding to ldap
        $ldap['bind'] = ldap_bind( $ldap['conn'], $ldap['dn'], $ldap['pass'] );
        if( !$ldap['bind'] ){
            echo 'false';
            exit();
        }else {*/
        $condition = array();
        $condition['username'] = $username;
        $record = $this->dao->where($condition)->find();
        if (false == $record) { //教师信息不存在，登录失败
            echo 'false';
            exit();
        } else {
            if (!in_array($record['status'], [1, 3])) {
                echo 'falseAccess'; //禁止访问
                exit();
            } else {
                $yc_auth_key = sysmd5($this->sysConfig['ADMIN_ACCESS'] . $_SERVER['HTTP_USER_AGENT']);
                $yc_auth = authcode($record['id'] . "-" . $record['username'] . "-" . $record['college'], 'ENCODE', $yc_auth_key);

                cookie('auth', $yc_auth);
                cookie('userid', $record['id']);
                cookie('username', $record['username']);
                cookie('usercollege', $record['college']);

                //Load('extend');
                //保存登录信息
                $data = array();
                $data['id'] = $record['id'];
                $data['last_login_time'] = time();
                $data['last_ip'] = get_client_ip();
                $data['login_count'] = array('exp', 'login_count+1');
                $this->dao->save($data);

                echo 'loginSuccess';
                exit();
            }
        }
        //}
    }

    /**
     * 登出
     */
    function logout(){
        if($this->_userid) {
            cookie(null,C('COOKIE_PREFIX'));
            parent::_message(success,'已经退出登录',U('Login/index'));
        }else {
            parent::_message(error,'尚未登录');
        }
    }
}