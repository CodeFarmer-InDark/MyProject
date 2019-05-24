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
class SignupAction extends GlobalAction
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

        if($this->sysConfig['signup_status'] != 1){
            parent::_message('error','报名关闭',U('Index/index'));
        }
        $this->assign('moduleTitle', '报名');
        $this->assign('year',date('Y'));
    }

    //本学院的中学列表
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

        $pid = intval(I('get.province'));
        $start = strtotime(I('get.start'));
        $end = strtotime(I('get.end'));
        $start && $this->assign('start',date('Y-m-d H:i:s',$start));
        $end && $this->assign('end',date('Y-m-d H:i:s',$end));
        $this->assign('province',$pid);

        //判断报名列表是否全部可见 ↓
        $map = [];
        $config = D('PlanConfig')->where('id = 1')->find();
        if ($config['status'] == 1){ //全部可见
            $mapProvince['id'] = array('neq',0);
        }elseif($config['status'] == 2){ //不全部可见
            $allow = $this->getProvince();
            $map['province'] = $mapProvince['id'] = array('in', $allow);

            if ($pid && !in_array($pid,$allow)){
                parent::_message('error','无报名该省份行程权限，请联系管理员');
            }
        }else{
            parent::_message('errorUri','系统错误，请联系管理员',U('Index/index'));
        }
        //↑

        $provinceList = M('Province')->where($mapProvince)->field('id,name')->select();
        $this->assign('provinceList',$provinceList);

        $pid && $map['province'] = array('eq',$pid);
        $map['status'] = array('eq',1);
        $map['isshow'] = array('eq',1);
        $map['year'] = date('Y');
        $start && $map['start'] = array('egt',$start);
        $end && $map['end'] = array('elt',$end);
        $count =  $this->dao->where($map)->count();
        $listRows = 15;
        $p = new \Think\Page1($count, $listRows,'province='.$pid.'&start='.I('get.start').'&end='.I('get.end'));
        $dataList = $this->dao->where($map)->Limit($p->firstRow.','.$p->listRows)->order('id desc')->select();

        //该教师已报名的行程id
        $hasBm = $this->dao1->where(['teacherid'=>$this->_userid])->field('planid')->select();
        if (false != $hasBm){
            $bmIdArr = array_column($hasBm,'planid');
        }

        //省份arr
        $provinceList = M('Province')->field('id,name')->select();
        foreach ($provinceList as $k=>$v){
            $provinceArr[$v['id']] = $v['name'];
        }

        foreach ($dataList as $k=>$v){
            $dataList[$k]['pname'] = $provinceArr[$v['province']];

            $condition = [];
            $condition['planid'] = $v['id'];
            $dataList[$k]['bmCount'] = $this->dao1->where($condition)->count();//计划报名人数
            $condition['status'] = 2;
            $dataList[$k]['checkCount'] = $this->dao1->where($condition)->count();//通过审批人数
            $dataList[$k]['zxlb'] = str_replace(';',' | ',$v['zxlb']);

            $start_time = date("H",$v['start']);
            if ($start_time > 0 && $start_time < 12){
                $xc = date('Y年m月d日',$v['start']).'上午';
            }
            if ($start_time >= 12 && $start_time <= 24){
                $xc = date('Y年m月d日',$v['start']).'下午';
            }
            $end_time = date("H",$v['end']);
            if ($end_time > 0 && $end_time < 12){
                $xc1 = date('Y年m月d日',$v['end']).'上午';
            }
            if ($end_time >= 12 && $end_time <= 24){
                $xc1 = date('Y年m月d日',$v['end']).'下午';
            }
            $dataList[$k]['xc'] = $xc.'~'.$xc1;

           if (false != $hasBm){
               if (in_array($v['id'],$bmIdArr)){
                   $dataList[$k]['has'] = 1;//已报名
               }
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
        parent::_add('apply',U('Signup/index'));
        
    }

    /**
     * 报名历史列表
     */
    /*public function history(){
        $this->assign('controllerName','SignupHistory');
        $this->assign('moduleTitle', '历史报名');
        $condition = [];
        $condition['teacherid'] = $this->_userid;

        $count =  $this->dao1->where($condition)->count();
        $listRows = 15 ;
        $p = new \Think\Page($count, $listRows);
        $dataList = $this->dao1->where($condition)->Limit($p->firstRow.','.$p->listRows)->select();
        foreach ($dataList as $k=>$v){
            $zxdm = $this->dao->where('id = '.$v['planid'])->getField('zxdm');
            $dataList[$k]['zxmc'] = M('Zxdm')->where('zxdm = '.$zxdm)->getField('zxmc');

            $map = [];
            $map['planid'] = $v['planid'];
            $dataList[$k]['bmCount'] = $this->dao1->where($map)->count();//计划报名人数
            $map['self_status'] = $map['other_status'] = 2;
            $dataList[$k]['checkCount'] = $this->dao1->where($map)->count();//计划审批人数 已通过

            if ($v['self_status'] == 2 && $v['other_status'] == 2){
                $dataList[$k]['status'] = 2;
            }elseif($v['self_status'] == 3 || $v['other_status'] == 3){
                $dataList[$k]['status'] = 3;
            }else{
                $dataList[$k]['status'] = 1;
            }
        }
        $page  = $p->show();
        if (false != $dataList){
            $this->assign('count',$count);
            $this->assign('pageBar', $page);
            $this->assign('dataList',$dataList);
        }
        $this->display();
    }*/

    /*
     * 历史报名详情
     */
    /*public function detail(){
        $this->assign('controllerName','SignupHistory');
        $this->assign('moduleTitle', '历史报名');
        $item = I('get.id');
        $condition['id'] = $item;
        $record = $this->dao1->where($condition)->find();
        if (empty($item) || empty($record)) parent::_message('error', '记录不存在');

        if ($record['self_status'] == 2 && $record['other_status'] == 2){
            $record['status'] = 2;
        }elseif($record['self_status'] == 3 || $record['other_status'] == 3){
            $record['status'] = 3;
        }else{
            $record['status'] = 1;
        }
        $planinfo = $this->dao->where('id = '.$record['planid'])->find();
        $record['year'] = $planinfo['year'];
        $record['pname'] = M('Province')->where('id = '.$planinfo['province'])->getField('name');
        $record['zxdm'] = $planinfo['zxdm'];
        $record['zxmc'] = M('Zxdm')->where('zxdm = '.$record['zxdm'])->getField('zxmc');
        $this->assign('vo', $record);
        $this->display();
    }*/

    /**
     * 获取学院分派省份
     * @return array
     */
    public function getProvince(){
        $mapCollege['cid'] = cookie('usercollege');
        $record = M('College')->where($mapCollege)->getField('province');

        if (!empty($record)){//本学院分派省份
            $allow = explode(',',$record);
            return $allow;
        }else{
            parent::_message('errorUri','学院未分派省份',U('Index/index'));
        }
    }
}