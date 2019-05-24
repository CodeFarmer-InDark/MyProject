<?php
/**
 *
 * 首页
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
namespace Promotion\Controller;
use Boris\DumpInspector;
use Think\Controller;
if(!defined("YCITYCMS")) exit("Access Denied");
class SignSecondController extends GlobalController
{
    function _initialize()
    {
        parent::_initialize();
        $this->dao = D('Plan');
        $this->dao1 = D('Apply');
        if(!$this->_userid || !$this->_usercollege){
            cookie(null,C('COOKIE_PREFIX'));
            parent::_message('errorUri','尚未登录',U('Login/index'),3);
        }

        if($this->sysConfig['signup_status'] != 2){
            parent::_message('error','报名关闭',U('Index/index'));
        }

        if(CONTROLLER_NAME.'/'.ACTION_NAME != 'Index/info'){
            $ustatus = D('Teacher')->where(['id'=>$this->_userid])->getField('status');
            if ($ustatus == 3){
                parent::_message('errorUri','请先确认所属部门',U('Index/info'));
            }
        }
        
        $this->assign('moduleTitle', '报名');
        $this->assign('year',date('Y'));
    }

    //选择省份
    public function select(){
        $map1 = [];
        $map1['username'] = $this->_username;
        $map1['year'] = date('Y');
        $maxScore = D('Score')->where($map1)->max('score');

        $url = $this->sysConfig['exam_url'];
        if (false == $maxScore) { //未报名，先答题
            if(empty($url) || !preg_match('/https:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is',$url)){
                parent::_message('errorUri','未设置考试链接地址或地址不合法，请联系管理员',U('Index/index'));
            }else{
                redirect($url);
            }
        }else{
            $fraction = D('Config')->where("name = 'fraction'")->getField('value');//规定分数
            if ($maxScore < intval($fraction)){
                parent::_message('errorUri','您的分数低于省份规定分数无法报名，请重新考试',$url,5);
            }
        }
        $this->display();
    }
    //返回各省计划数
    public function showCount(){
        $planList = $this->dao->where(['year'=>date('Y'),'status'=>1])->select();
        $planArr = [];
        foreach ($planList as $k=>$v){
            $planArr[$v['province']]['num']++;
            $allowList[] = $v['province'];
        }
        if (false != $planArr){
            $data['msg'] = 1;
            $data['infoList'] = $planArr;
            $data['allowList'] = $allowList;
        }else{
            $data['msg'] = 2;
            $data['infoList'] = '';
            $data['allowList'] = '';
        }
        echo json_encode($data);
        exit;
    }

    //第二阶段展示全部计划列表
    public function index()
    {
        $map1 = [];
        $map1['username'] = $this->_username;
        $map1['year'] = date('Y');
        $maxScore = D('Score')->where($map1)->max('score');

        $url = $this->sysConfig['exam_url'];
        if (false == $maxScore) { //未报名，先答题
            if(empty($url) || !preg_match('/https:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is',$url)){
                parent::_message('errorUri','未设置考试链接地址或地址不合法，请联系管理员',U('Index/index'));
            }else{
                redirect($url);
            }
        }else{
            $fraction = D('Config')->where("name = 'fraction'")->getField('value');//规定分数
            if ($maxScore < intval($fraction)){
                parent::_message('errorUri','您的分数低于省份规定分数无法报名，请重新考试',$url,5);
            }
        }
        
        $map = $condition = [];
        $province = intval(I('get.province'));
        if ($province != 0){
            $map['id'] = $province;
            $has = M('Province')->where($map)->select();
            if (false == $has){
               parent::_message('error','省份不存在');
            }else{
                $pname = M('Province')->where(['id'=>$province])->getField('name');
                $this->assign('pid',$province);
                $this->assign('pname',$pname);

                $condition['province'] = $province;
            }
        }

        $condition['year'] = date('Y');
        $condition['status'] = 1;
        $count =  $this->dao->where($condition)->count();
        $listRows = 15;
        $p = new \Think\Page1($count, $listRows,'province='.$province);
        $dataList = $this->dao->where($condition)->Limit($p->firstRow.','.$p->listRows)->order('id desc')->select();

        foreach ($dataList as $k=>$v){
            $condition = [];
            $condition['planid'] = $v['id'];
            $dataList[$k]['bmCount'] = $this->dao1->where($condition)->count();//计划报名人数
            $condition['status'] = 4;
            $dataList[$k]['checkCount'] = $this->dao1->where($condition)->count();//通过审批人数

            $xc_time = date("H",$v['xc']);
            if ($xc_time > 0 && $xc_time < 12){
                $dataList[$k]['xc'] = date('Y年m月d日',$v['xc']).'上午';
            }
            if ($xc_time >= 12 && $xc_time <= 24){
                $dataList[$k]['xc'] = date('Y年m月d日',$v['xc']).'下午';
            }
        }
        $page  = $p->show();

        if (false != $dataList){
            $this->assign('count',$count);
            $this->assign('pageBar', $page);
            $this->assign('dataList', $dataList);
        }
        $this->display();
    }

    /*
     * 报名提交
     */
    public function doCommand()
    {
        if(getMethod() == 'get'){
            $operate = trim($_GET['operate']);
        }elseif(getMethod() == 'post'){
            $operate = trim($_POST['operate']);
        }else{
            parent::_message('error', '只支持POST,GET数据');
        }
        parent::_add('apply',U('SignSecond/index'));
        
    }

    /**
     * 获取学院分派省份
     * @return array
     */
    public function getProvince(){
        $mapCollege['cid'] = $this->_usercollege;
        $record = M('College')->where($mapCollege)->getField('province');

        if (!empty($record)){//本学院分派省份
            $allow = explode(',',$record);
            return $allow;
        }else{
            parent::_message('errorUri','学院未分派省份',U('Index/index'));
        }
    }
    
    /**
     * 接收地图选择省份
     */
    public function getMap(){
        $province = intval(I('post.province'));
        if ($province == 0){
            $data['msg'] = 1;
            $data['province'] = 0;
            $data['num'] = 0;
            echo json_encode($data);
            exit;
        }
        $planList = $this->dao->where(['year'=>date('Y'),'status'=>1,'province'=>$province])->select();
        if (false != $planList){
            $data['msg'] = 2;
            $data['province'] = $province;
            $data['num'] = count($planList);
        }else{
            $data['msg'] = 3;
            $data['province'] = 0;
            $data['num'] = 0;
        }
        echo json_encode($data);
        exit;
    }
}