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
if(!defined("YCITYCMS")) exit("Access Denied");
class HistoryAction extends GlobalAction
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

        $this->assign('moduleTitle', '历史报名');
        $this->assign('year',date('Y'));

        for ($i=0;$i<5;$i++){
            $yearList[$i]['id'] = date('Y') - $i;
            $yearList[$i]['name'] =  $yearList[$i]['id'].'-'.($yearList[$i]['id'] + 1).'学年';
        }
        $this->assign('yearList',$yearList);
    }

    /**
     * 报名历史列表
     */
    public function index(){
        $condition = [];
        $year = intval(I('get.year'));
        if ($year){
            $startTimeMap = $year.'-09-01 00:00:00';
            $endTimeMap = ($year+1).'-09-01 00:00:00';
            $startTimeMap = strtotime($startTimeMap);
            $endTimeMap = strtotime($endTimeMap);
            $condition['b.start'] = array('between',[$startTimeMap,$endTimeMap]);
            //$condition['b.year'] = $year;
            $param = 'year='.$year;
        }
        $this->assign('year',$year);

        $condition['a.teacherid'] = $this->_userid;
        $count =  $this->dao1->Table(C('DB_PREFIX').'apply a')->join(C('DB_PREFIX').'plan b on a.planid = b.id')->where($condition)->count();
        $listRows = 15;

        $p = new \Think\Page1($count, $listRows,$param);
        $dataList = $this->dao1->Table(C('DB_PREFIX').'apply a')->join(C('DB_PREFIX').'plan b on a.planid = b.id')->join(C('DB_PREFIX').'province c on b.province = c.id')->where($condition)->field('a.id as aid,a.status as astatus,a.back_status,b.*,c.name as pname')->Limit($p->firstRow.','.$p->listRows)->order('a.create_time desc,a.id desc')->select();
        $page  = $p->show();
        if (false != $dataList){
            foreach ($dataList as $k=>$v){
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
            }
            $this->assign('count',$count);
            $this->assign('page', $page);
            $this->assign('dataList',$dataList);
        }
        $this->display();
    }

    /*
     * 历史报名详情
     */
    public function detail(){
        $item = I('get.id');
        $condition['a.id'] = $item;
        $record = $this->dao1->Table(C('DB_PREFIX').'apply a')->join(C('DB_PREFIX').'plan b on a.planid = b.id')->field('a.back_status,b.*')->where($condition)->find();
        if (empty($item) || empty($record)) parent::_message('error', '记录不存在');

        $record['pname'] = M('Province')->where(['id = '.$record['province']])->getField('name');
        $record['zxlb'] = str_replace(';',' | ',$record['zxlb']);

        $start_time = date("H",$record['start']);
        if ($start_time > 0 && $start_time < 12){
            $xc = date('Y年m月d日',$record['start']).'上午';
        }
        if ($start_time >= 12 && $start_time <= 24){
            $xc = date('Y年m月d日',$record['start']).'下午';
        }
        $end_time = date("H",$record['end']);
        if ($end_time > 0 && $end_time < 12){
            $xc1 = date('Y年m月d日',$record['end']).'上午';
        }
        if ($end_time >= 12 && $end_time <= 24){
            $xc1 = date('Y年m月d日',$record['end']).'下午';
        }
        $record['xc'] = $xc.'～'.$xc1;
        $this->assign('vo', $record);

        if ($record['assignid'] != 0 && $record['status'] == 4){ //分配且审核完成
            $assignInfo = $this->dao->where(['id = '.$record['assignid']])->find();//分配计划信息
            $assign = [];
            $assign['year'] = $assignInfo['year'];
            $assign['pname'] = M('Province')->where(['id = '.$assignInfo['province']])->getField('name');
            $assign['zxdm'] = $assignInfo['zxdm'];
            $assign['zxmc'] = $assignInfo['zxmc'];;
            $assign['remark'] = $assignInfo['remark'];
            $xc_time = date("H",$assignInfo['xc']);
            if ($xc_time > 0 && $xc_time < 12){
                $assign['xc'] = date('Y年m月d日',$assignInfo['xc']).'上午';
            }
            if ($xc_time >= 12 && $xc_time <= 24){
                $assign['xc'] = date('Y年m月d日',$assignInfo['xc']).'下午';
            }
            $this->assign('assign', $assign);
        }
        $this->display();
    }
}