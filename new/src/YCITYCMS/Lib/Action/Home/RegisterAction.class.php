<?php
/**
 * 
 * 搜索
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
if(!defined("YCITYCMS")) exit("Access Denied"); 
class RegisterAction extends HomeAction
{
    public $dao;
    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('Register');

        $provinceArr = M('province')->order('id asc')->select();
        $this->assign('province',$provinceArr);
    }

    public function index(){
        $id=intval($_GET['id']);
        $this->assign('id',$id);
        if (!isset($_GET['id']) || $id!=54){parent::_message('error','参数错误');};
        
        $this->assign('plist','中欧学院招生选拔报名');
        $this->assign('moduleTitle','中欧学院招生选拔报名');

        $this->display();
    }

    public function doInsert(){
        $name = htmlCv(dhtml(trim($_POST['name'])));
        $gender = intval($_POST['gender']);
        $id_no = htmlCv(dhtml(trim($_POST['id_no'])));
        $candidate_no = htmlCv(dhtml(trim($_POST['candidate_no'])));
        $province = intval($_POST['province']);
        $score = htmlCv(dhtml(trim($_POST['score'])));
        $mobilephone = htmlCv(dhtml(trim($_POST['mobilephone'])));
        $qq = htmlCv(dhtml(trim($_POST['qq'])));

        $mapIdno['id_no'] = $id_no;
        $exist = $this->dao->where($mapIdno)->getfield('id');
        if (!empty($exist)){
            echo 'isExist';
            exit();
        }
        if(empty($name)){
            // $this->_message(error,'请填写帐号密码');
            echo 'emptyName';
            exit();
        }
        if(empty($id_no)){
            // $this->_message(error,'请填写帐号密码');
            echo 'emptyIdno';
            exit();
        }
        if(empty($candidate_no)){
            // $this->_message(error,'请填写帐号密码');
            echo 'emptyCandidateno';
            exit();
        }
        if ($province == 0 ){
            echo 'emptyProvince';
            exit();
        }
        if(empty($score)){
            // $this->_message(error,'请填写帐号密码');
            echo 'emptyScore';
            exit();
        }
        if(empty($mobilephone)){
            // $this->_message(error,'请填写帐号密码');
            echo 'emptyMobile';
            exit();
        }
        if(empty($qq)){
            // $this->_message(error,'请填写帐号密码');
            echo 'emptyQq';
            exit();
        }

        $data = array();
        $data['name'] = $name;
        $data['gender'] = $gender;
        $data['id_no'] = $id_no;
        $data['candidate_no'] = $candidate_no;
        $data['province'] = $province;
        $data['score'] = $score;
        $data['mobilephone'] = $mobilephone;
        $data['qq'] = $qq;
        $data['create_time'] = time();
        $daoAdd = $this->dao->data($data)->add();
        if ($daoAdd != false){
            echo 'Success';
            exit();
        }
    }
}