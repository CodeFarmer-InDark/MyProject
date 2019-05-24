<?php
/**
 *
 * Video(视频)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
namespace Api\Controller;
use Common\Controller\HomeBaseController;

class DataController extends HomeBaseController
{
    public $dao,$year,$filename;
    function _initialize()
    {
        parent::_initialize();
//        $allow_origin = array(
//            'http://www.cauc.edu.cn/zsb',
//            'http://localhost/cauc_zsb2/zsb',
//        );
        $allow_origin = 'http://www.cauc.edu.cn/zsb';
        header('Access-Control-Allow-Origin:'.$allow_origin);   // 指定允许其他域名访问
        header('Access-Control-Allow-Headers:x-requested-with,content-type');// 响应头设置
        header('Access-Control-Allow-Methods: GET, POST, PUT');

        $this->year = intval($_GET['year']);
        if (!$this->year || $this->year == 0){
            $this->year = date('Y');
        }
        $fileName = 't_tdd_final'.$this->year;
        $db_name = C('DB_PREFIX').strtolower($fileName);
        $Model = new \Think\Model();
        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");

        $fileName1 = 'plan'.$this->year;
        $db_name1 = C('DB_PREFIX').strtolower($fileName1);
        $m1 = $Model->query("SHOW TABLES LIKE '%$db_name1%'");
        if ($m && $m1){
            $this->dao = D($fileName);
            $this->filename = strtolower($fileName);
            $this->dao1 = D($fileName1);
        }else{
            $jsonp = htmlspecialchars($_GET["callback"]);
            $result['msg'] = 'noData';//数据表不存在
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($result).")";
                exit;
            }
        }
    }

    /**
     * 0 本专科统计
     * 1 性别统计
     * 2 考生类别统计
     * 3 人数最多5个省份
     * 4 各科类考生数及比例
     * 5 各批次考生数及比例
     * 6 出生年月
     * 7 人数最多五个中学
     * 8 姓氏最多
     */
    public function charts1()
    {
        $jsonp = htmlspecialchars($_GET["callback"]);
        $condition = [];
        $condition['a.pc'] = array('neq',7);
        $dataList = $this->dao->Table(C('DB_PREFIX')."$this->filename a")->Join(C('DB_PREFIX').'t_jhk b on b.zydh=a.lqzy')->where($condition)->field('a.id,a.xm,a.pc,a.xbdm,a.kslbdm,a.csny,a.provinceid,a.zxdm,a.zxmc,a.kldm,a.pc,b.zydm')->select();
        if (false != $dataList){
            $total_count = count($dataList);

            $pcList = M('Pc')->field('id,pc')->select();
            $pcArr = [];
            foreach ($pcList as $k=>$v){
                $pcArr[$v['id']] = $v['pc'];
            }

            $zyList = M('Zy')->where(['year'=>$this->year])->field('ccdm,zydm')->select();
            $zyArr = [];
            foreach ($zyList as $k=>$v) {
                $zyArr[$v['zydm']] = $v['ccdm'];
            }

            $final_list = [];
            $total = 0;
            $surname = [];
            foreach ($dataList as $k=>$v){
                if ($v['zydm'] == '120200'){
                    $v['zydm'] = '1202';
                }
                if ($zyArr[$v['zydm']] == 1){ //筛选出本科
                    $final_list[] = $v;
                }elseif($zyArr[$v['zydm']] == 2){
                    $total+=1;
                }
                $surname[] = mb_substr($v['xm'],0,1);
            }
            $name = array_count_values($surname);
            $maxKey = array_search(max($name),$name);//8
            //unset($dataList);

            $provinceList = M('Province')->field('id,name')->select();
            $provinceArr = [];
            foreach ($provinceList as $k=>$v){
                $provinceArr[$v['id']] = $v['name'];
            }

            $kldmList = M('tdKldm')->where(['year'=>$this->year])->field('kldm,klmc,provinceid')->select();
            $kldmArr = [];
            foreach ($kldmList as $k=>$v){
                $kldmArr[$v['kldm'].'-'.$v['provinceid']] = $v['klmc'];
            }

            $info[0][0]['name'] = '本科';
            $info[0][0]['value'] = count($final_list);
            $info[0][1]['name'] = '专科';
            $info[0][1]['value'] = $total;

            $data = $data1 = $data2 = $data3 = $data4 = [];
            foreach ($dataList as $k=>$v){
                if ($v['xbdm'] == 1){
                    $info[1][0]['name'] = '男生';
                    $info[1][0]['value'] += 1;
                }elseif($v['xbdm'] == 2){
                    $info[1][1]['name'] = '女生';
                    $info[1][1]['value'] += 1;
                }

                if (in_array($v['kslbdm'],array(1,3))){ //城镇往届应届
                    $info[2]['city'] += 1;
                }elseif(in_array($v['kslbdm'],array(2,4))){ //农村往届应届
                    $info[2]['countryside'] += 1;
                }elseif(!in_array($v['kslbdm'],array(1,2,3,4))){
                    $info[2]['other'] += 1;
                }

                $data[$v['provinceid']] += 1;

                $final_list[$k]['klmc'] = $kldmArr[$v['kldm'].'-'.$v['provinceid']];

                if (in_array($v['pc'],array(8,14))){
                    $info[5]['xn']['value'] += 1;
                    $info[5]['xn']['name'] = '西藏内高班';
                }elseif(in_array($v['pc'],array(12,15))){
                    $info[5]['nd']['value'] += 1;
                    $info[5]['nd']['name'] = '南疆单列计划';
                }elseif(in_array($v['pc'],array(13,16))){
                    $info[5]['ng']['value'] += 1;
                    $info[5]['ng']['name'] = '新疆内高班';
                }else{
                    $info[5][$v['pc']]['value'] += 1;
                    $info[5][$v['pc']]['name'] = $pcArr[$v['pc']];
                }

                $temp = explode('-',$v['csny']);
                if ($temp[0] != 0000){
                    $data2[$temp[0]] += 1;
                }
                if ($v['csny'] != '0000-00-00'){
                    $data3[$v['csny']] += 1;
                }
            }
            foreach ($final_list as $k=>$v){//中学数top5 排除专科
                if ($v['zxdm'] != ''){
                    $data4[$v['zxdm']]['zxmc'] = $v['zxmc'];
                    $data4[$v['zxdm']]['pid'] = $v['provinceid'];
                    $data4[$v['zxdm']]['num'] += 1;
                }
            }

            arsort($data);//保留键值从大到小排序
            $i = 0;
            $maxnum = 4;
            foreach ($data as $k=>$v){ //循环五次
                if ($i++ > $maxnum){
                    break;
                }
                $info[3][$k]['name'] = $provinceArr[$k];
                $info[3][$k]['num'] = $v;
            }
            $info[3] = array_values($info[3]);//3

            $info[5] = array_values($info[5]);//5

            foreach ($final_list as $k=>$v){
                $data1[$v['klmc']]['num'] += 1;
                $data1[$v['klmc']]['klmc'] = $v['klmc'];
            }
            $finalData = [];
            foreach ($data1 as $k=>$v){
                if (!strstr($v['kldm'],'文理') && strstr($v['klmc'],'理')){
                    $finalData['kldm5'] += $v['num'];
                }elseif(!strstr($v['kldm'],'文理') && strstr($v['klmc'],'文')){
                    $finalData['kldm1'] += $v['num'];
                }else{
                    $finalData['z'] += $v['num'];
                }
            }//4

            $mostDay = iconv('UTF-8', 'GBK', array_search(max($data3),$data3)); //人数最多的天
            $mostDay = substr_replace($mostDay,'年',4,1);
            $mostDay = str_replace('-','月',$mostDay).'日';
            ksort($data2);//根据键值从小到大排序
            foreach ($data2 as $k=>$v){
                $yearArr[] = $k;
                $num[] = $v;
            }
            $info[6]['list'] = $data2;
//            $info[6]['year'] = $yearArr;
//            $info[6]['num'] = $num;
            $info[6]['remark'] = '其中，'.$mostDay.'出生的考生最多。'."<br/>姓氏为 ".$maxKey.' 的学生最多，达'.max($name).'人。';//6

            // 取得列的列表
            foreach ($data4 as $key => $row)
            {
                $num[$key]  = $row['num'];
            }
            $res = $this->arraySort($data4,'num','desc');
            $final_Data = [];
            $j = 0;
            $maxnumj = 4;
            foreach ($res as $k=>$v){ //循环五次
                if ($j++ > $maxnumj){
                    break;
                }
                $final_Data[$k]['zxmc'] = $v['zxmc'];
                $final_Data[$k]['pname'] = $provinceArr[$v['pid']];
                $final_Data[$k]['num'] = $v['num'];
            }
            $info[7]['info'] = array_values($final_Data);
            $info[7]['remark'] = $this->year.'年，共有'.count($data4).'所中学为我校提供生源。'; //7

            $result['count'] = count($final_list);
            if ($result['count'] != 0){
                $info[0][0]['name'] .= $info[0][0]['value'].'人，占'.round(($info[0][0]['value'] / $total_count) * 100,2).'%';
                $info[0][1]['name'] .= $info[0][1]['value'].'人，占'.round(($info[0][1]['value'] / $total_count) * 100,2).'%';

                $info[1][0]['name'] .= $info[1][0]['value'].'人，占'.round(($info[1][0]['value'] / $result['count']) * 100,2).'%';
                $info[1][1]['name'] .= $info[1][1]['value'].'人，占'.round(($info[1][1]['value'] / $result['count']) * 100,2).'%';

                $info[2]['other'] = $info[2]['other']?$info[2]['other']:0;
                $info[2]['city_percent'] = round(($info[2]['city'] / $result['count']) * 100,2).'%';
                $info[2]['countryside_percent'] = round(($info[2]['countryside'] / $result['count']) * 100,2).'%';
                $info[2]['other_percent'] = round(($info[2]['other'] / $result['count']) * 100,2).'%';

                $info[4]['kldm5'] = '理工类考生'.$finalData['kldm5'].'人，占'.round(($finalData['kldm5'] / $result['count']) * 100,2).'%';
                $info[4]['kldm1'] = '文史类考生'.$finalData['kldm1'].'人，占'.round(($finalData['kldm1'] / $result['count']) * 100,2).'%';
                $info[4]['z'] = '不分文理考生'.$finalData['z'].'人，占'.round(($finalData['z'] / $result['count']) * 100,2).'%';;
            }
            $result['msg'] = '1'; //成功
            $result['info'] = $info;
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($result).")";
                exit;
            }
        }else{
            $result['msg'] = '2';
            $result['info'] = '';
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($result).")";
                exit;
            }
        }

    }

    /**
     * 获取各学院男女比例
     */
    public function charts3()
    {
        $jsonp = htmlspecialchars($_GET["callback"]);
        $condition = [];
        $condition['a.pc'] = array('neq',7);
        $dataList = $this->dao->Table(C('DB_PREFIX')."$this->filename a")->Join(C('DB_PREFIX').'t_jhk b on b.zydh=a.lqzy')->where($condition)->field('a.id,a.xbdm,b.zydm')->select();
        if (false != $dataList){
            $zyList = M('Zy')->where(['year'=>$this->year])->field('ccdm,zydm,college')->select();
            $zyArr = [];
            foreach ($zyList as $k=>$v) {
                $zyArr[$v['zydm']] = $v['college'];
            }
            $collegeList = M('College')->where('type = 1')->field('cid,name')->select();
            $collegeArr = [];
            foreach ($collegeList as $k=>$v){
                $collegeArr[$v['cid']] = $v['name'];
            }

            foreach ($dataList as $k=>$v){
                if ($v['zydm'] == '120200'){
                    $v['zydm'] = '1202';
                }
                $dataList[$k]['cid'] = $zyArr[$v['zydm']];
                $dataList[$k]['name'] = $collegeArr[$zyArr[$v['zydm']]];
            }

            $data = $data1 = [];
            foreach ($dataList as $k=>$v){
                $data[$v['cid']]['name'] = $data1[$v['cid']]['name'] = $v['name'];
                if ($v['xbdm'] == 1){
                    $data[$v['cid']]['sex1'] += 1;
                }else{
                    $data[$v['cid']]['sex2'] += 1;
                }

                $data1[$v['cid']]['num'] += 1;
            }
            foreach ($data as $k=>$v){
                $data[$k]['xbdm1'] = round(($v['sex1'] / ($v['sex1']+$v['sex2'])) * 100,2);
                $data[$k]['xbdm2'] = round(($v['sex2'] / ($v['sex1']+$v['sex2'])) * 100,2);
            }
            $data = $this->arraySort($data,'xbdm1','desc');
            $data = array_values($data);

            $data1 = $this->arraySort($data1,'num','desc');
            $data1 = array_values($data1);

            $result = [];
            foreach ($data as $k=>$v){
                $result[1]['count'] += 1;
                $result[1]['name'][] = $v['name'];
                $result[1]['xbdm1'][] = $v['xbdm1'];
                $result[1]['xbdm2'][] = $v['xbdm2'];
            }
            foreach ($data1 as $k=>$v){
                $result[2]['count'] += 1;
                $result[2]['name'][] = $v['name'];
                $result[2]['num'][] = $v['num'];
            }
            $result['msg'] = '1'; //成功
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($result).")";
                exit;
            }
        }else{
            $result['msg'] = '2';
            $result['info'] = '';
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($result).")";
                exit;
            }
        }

    }

    /**
     * 获取各民族
     */
    public function charts4()
    {
        $jsonp = htmlspecialchars($_GET["callback"]);
        $condition['a.mzdm'] = array('neq','01');
        $condition['a.pc'] = array('neq',7);
        $dataList = $this->dao->Table(C('DB_PREFIX')."$this->filename a")->Join(C('DB_PREFIX').'mzdm b on b.mzdm=a.mzdm')->where($condition)->field('a.mzdm,b.mzmc')->select();
        if (false != $dataList){
            $data = [];
            foreach ($dataList as $k=>$v){//去除民族名称中的（区内）
                $v['mzmc'] = str_replace('(','（',$v['mzmc']);
                if(strpos($v['mzmc'],'（')){
                    $mzmc = explode('（',$v['mzmc']);
                    $v['mzmc'] = $mzmc[0];
                }
                $data[$v['mzdm']]['name'] = $v['mzmc'];
                $data[$v['mzdm']]['value'] += 1;
            }
            $finalData = [];
            foreach ($data as $k=>$v){
                if ($v['value'] >= 20){
                    $finalData[$k]['name'] = $v['name'].' '.$v['value'].'人';
                    $finalData[$k]['value'] = $v['value'];
                }else{
                    $final['name'] = '其他民族（其他民族均在20人以下）';
                    $final['value'] += $v['value'];
                }
            }
            $finalData[] = $final;
            $result['remark'] = '共'.count($data).'个少数民族，'.count($dataList).'名少数民族学生。';
            $result['msg'] = '1'; //成功

            $result['info'] = array_values($finalData);
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($result).")";
                exit;
            }
        }else{
            $result['msg'] = '2';
            $result['info'] = '';
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($result).")";
                exit;
            }
        }
    }

    /**
     * 获取最热五个专业
     */
    public function table5()
    {
        $jsonp = htmlspecialchars($_GET["callback"]);
        $map['a.pc'] = array('neq',7);
        $dataList = $this->dao->Table(C('DB_PREFIX')."$this->filename a")->Join(C('DB_PREFIX').'t_jhk b on b.zydh=a.zymc_b')->where($map)->field('a.id,a.zymc_b,b.zydm,b.zymc')->select();
        if (false != $dataList){
            $zyList = M('Zy')->where(['year'=>$this->year])->field('ccdm,zydm')->select();
            $zyArr = [];
            foreach ($zyList as $k=>$v) {
                $zyArr[$v['zydm']] = $v['ccdm'];
            }

            $final_list = [];
            foreach ($dataList as $k=>$v){
                if ($v['zydm'] == '120200'){
                    $v['zydm'] = '1202';
                }
                if ($zyArr[$v['zydm']] == 1){ //筛选出本科
                    $final_list[] = $v;
                }
            }
            unset($dataList);

            $data = [];
            foreach ($final_list as $k=>$v){
                if ($v['zydm'] == '600409'){
                    //直升机
                    if (strstr($v['zymc'],'直升机')){
                        $data['600409z'] += 1;
                    }else{
                        $data['600409'] += 1;
                    }
                }else{
                    $data[$v['zydm']] += 1;
                }
            }
            foreach ($data as $k=>$v){
                $zydmArr[] = $k;
            }
            $condition['zydm'] = array('in',$zydmArr);
            $planList = $this->dao1->where($condition)->field('zydm,zymc,zyfx,target')->select();
            $planArr = [];
            foreach ($planList as $k=>$v){
                if ($v['zyfx'] == '直升机'){
                    $planArr['600409z']['target'] += $v['target'];
                    $planArr['600409z']['zymc'] = $v['zymc'];
                    $planArr['600409z']['zyfx'] = $v['zyfx'];
                }else{
                    $planArr[$v['zydm']]['target'] += $v['target'];
                    $planArr[$v['zydm']]['zymc'] = $v['zymc'];
                    $planArr[$v['zydm']]['zyfx'] = $v['zyfx'];
                }
            }
            $temp = [];
            foreach ($data as $k=>$v){
                foreach ($planArr as $k1=>$v1){
                    if ($k === $k1){
                        if(($v / $v1['target']) >= 1){///一专业报考：计划大于等于1
                            $temp[$k]['zyname'] = $v1['zyfx'] ? $v1['zymc'].'（'.$v1['zyfx'].'）':$v1['zymc'];
                            $temp[$k]['tdd'] = $v;
                            $temp[$k]['plan'] = $v1['target'];
                            $temp[$k]['bl'] = round($v / $v1['target'],2);
                        }
                    }
                }
            }
            unset($data);
            unset($planArr);

            // 取得列的列表
            foreach ($temp as $key => $row)
            {
                $bl[$key]  = $row['bl'];
            }
            $res = $this->arraySort($temp,'bl','desc');

            $finalData = [];
            $i = 0;
            $maxnum = 4;
            foreach ($res as $k=>$v){ //循环五次
                if ($i++ > $maxnum){
                    break;
                }
                $finalData[$k]['zyname'] = $v['zyname'];
                $finalData[$k]['tdd'] = $v['tdd'];
                $finalData[$k]['plan'] = $v['plan'];
                $finalData[$k]['bl'] = $v['bl'];
            }
            $result['msg'] = '1';
            $result['info'] = array_values($finalData);

            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($result).")";
                exit;
            }
        }else{
            $result['msg'] = '2';
            $result['info'] = '';
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($result).")";
                exit;
            }
        }
    }

    /**
     * 获取录取分差≥60的省份
     */
    public function table6()
    {
        $jsonp = htmlspecialchars($_GET["callback"]);
        $type = intval(I('get.type'));
        if ($type == 0){
            $result['msg'] = '2';
            $result['info'] = '';
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($result).")";
                exit;
            }
        }
        $map['a.pc'] = array('not in',array(1,7));
        $map['a.provinceid'] = array('neq',99);
        $dataList = $this->dao->Table(C('DB_PREFIX')."$this->filename a")->Join(C('DB_PREFIX').'t_jhk b on b.zydh=a.zymc_b')->field('a.id,a.tdcj,a.kldm,a.provinceid,a.tddw,b.zydm')->where($map)->order('a.provinceid desc')->select();
        if (false != $dataList){
            $zyList = M('Zy')->where(['year'=>$this->year])->field('ccdm,zydm')->select();
            $zyArr = [];
            foreach ($zyList as $k=>$v) {
                $zyArr[$v['zydm']] = $v['ccdm'];
            }

            $provinceList = M('Province')->field('id,name')->select();
            $provinceArr = [];
            foreach ($provinceList as $k=>$v){
                $provinceArr[$v['id']] = $v['name'];
            }

            //$condition['kldm'] = array('eq',$type);
            $mapKldm['year'] = $this->year;
            $tddwList = M('CorrectTddw')->where($mapKldm)->field('provinceid,tddw,kldm')->select();
            $tddwArr = [];
            foreach ($tddwList as $k=>$v){
                $tddwArr[$this->year.'-'.$v['provinceid'].'-'.$v['tddw']] = $v['kldm'];
            }
            $klList = M('CorrectKldm')->where($mapKldm)->field('provinceid,kldm_origin,kldm')->select();
            $kldmArr = [];
            foreach ($klList as $k=>$v){
                $kldmArr[$this->year.'-'.$v['provinceid'].'-'.$v['kldm_origin']] = $v['kldm'];
            }
            //省控线
            $skxList = M('Skx')->where($mapKldm)->field('province,kldm,skx')->select();
            $skxArr = [];
            foreach ($skxList as $k=>$v){
                $skxArr[$this->year.'-'.$v['province'].'-'.$v['kldm']] = $v['skx'];
            }

            $final_list = [];
            foreach ($dataList as $k=>$v){
                if ($v['zydm'] == '120200'){
                    $v['zydm'] = '1202';
                }
                if ($zyArr[$v['zydm']] == 1){ //筛选出本科
                    $final_list[] = $v;
                }
            }
            unset($dataList);

            $res = [];
            foreach ($final_list as $k=>$v){
                $tddwkldm = $tddwArr[$this->year.'-'.$v['provinceid'].'-'.$v['tddw']];
                $final_list[$k]['kldm'] = $tddwkldm?$tddwkldm:$v['kldm'];//纠正个别省份科类文理综合分文理

                $xnkldm = $kldmArr[$this->year.'-'.$v['provinceid'].'-'.$v['kldm']];
                $final_list[$k]['kldm'] = ($xnkldm!='')?$xnkldm:$final_list[$k]['kldm']; //纠正个别省份科类代码

                $skx = $skxArr[$this->year.'-'.$v['provinceid'].'-'.$final_list[$k]['kldm']];//保证有省控线
                if (($final_list[$k]['kldm'] == $type) && $skx){ //理工为例
                    $res[$k]['tdcj'] = $v['tdcj'];
                    $res[$k]['provinceid'] = $v['provinceid'];
                    $res[$k]['skx'] = $skx;
                }
            }

            $final = [];
            foreach ($res as $k=>$v){
                $final[$v['provinceid']][] = $v;
            }
            $final_data = [];
            foreach ($final as $k=>$v){
                $low = $this->arraySort($v,'tdcj','asc');
                $diff = array_values($low)[0]['tdcj'] - array_values($low)[0]['skx'];
                if ($diff >= 60){
                    $final_data[$k]['tdcj'] = array_values($low)[0]['tdcj'];
                    $final_data[$k]['skx'] = array_values($low)[0]['skx'];
                    $final_data[$k]['diff'] = ceil($diff);
                    $final_data[$k]['province'] = $provinceArr[$k];
                }
            }
            $final_final = $this->arraySort($final_data,'diff','desc');
            $result['msg'] = '1';
            $result['info'] = array_values($final_final);
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($result).")";
                exit;
            }
        }else{
            $result['msg'] = '2';
            $result['info'] = '';
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($result).")";
                exit;
            }
        }
    }

    /**
     * 获取各专业平均高于重点线
     */
    public function table7()
    {
        $jsonp = htmlspecialchars($_GET["callback"]);
        $type = intval(I('get.type'));
        if ($type == 0){
            $result['msg'] = '2';
            $result['info'] = '';
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($result).")";
                exit;
            }
        }
        $map['a.pc'] = array('neq',7);
        $dataList = $this->dao->Table(C('DB_PREFIX')."$this->filename a")->Join(C('DB_PREFIX').'t_jhk b on b.zydh=a.zymc_b')->where($map)->field('a.id,a.zymc_b,a.tdcj,a.kldm,a.provinceid,a.tddw,b.zydm,b.zymc,b.jhxz')->select();
        if (false != $dataList){
            $zyList = M('Zy')->where(['year'=>$this->year])->field('ccdm,zydm')->select();
            $zyArr = [];
            foreach ($zyList as $k=>$v) {
                $zyArr[$v['zydm']] = $v['ccdm'];
            }

            $final_list = [];
            foreach ($dataList as $k=>$v){
                if ($v['zydm'] == '120200'){
                    $v['zydm'] = '1202';
                }
                if ($zyArr[$v['zydm']] == 1){ //筛选出本科
                    $final_list[] = $v;
                }
            }
            unset($dataList);
            //$condition['kldm'] = array('eq',$type);
            $mapKldm['year'] = $this->year;
            $tddwList = M('CorrectTddw')->where($mapKldm)->field('provinceid,tddw,kldm')->select();
            $tddwArr = [];
            foreach ($tddwList as $k=>$v){
                $tddwArr[$this->year.'-'.$v['provinceid'].'-'.$v['tddw']] = $v['kldm'];
            }
            $klList = M('CorrectKldm')->where($mapKldm)->field('provinceid,kldm_origin,kldm')->select();
            $kldmArr = [];
            foreach ($klList as $k=>$v){
                $kldmArr[$this->year.'-'.$v['provinceid'].'-'.$v['kldm_origin']] = $v['kldm'];
            }
            //省控线
            $skxList = M('Skx')->where($mapKldm)->field('province,kldm,skx')->select();
            $skxArr = [];
            foreach ($skxList as $k=>$v){
                $skxArr[$this->year.'-'.$v['province'].'-'.$v['kldm']] = $v['skx'];
            }

            $zyList = M('Zy')->where(['year'=>$this->year])->field('zydm,zymc,zyfx')->select();
            $zyArr = [];
            foreach ($zyList as $k=>$v){
                $zyArr[$v['zydm']]['zymc'] = $v['zymc'];
                $zyArr[$v['zydm']]['zyfx'] = $v['zyfx'];
            }

            $res = [];
            foreach ($final_list as $k=>$v){
                $tddwkldm = $tddwArr[$this->year.'-'.$v['provinceid'].'-'.$v['tddw']];
                $final_list[$k]['kldm'] = $tddwkldm?$tddwkldm:$v['kldm'];//纠正个别省份科类文理综合分文理

                $xnkldm = $kldmArr[$this->year.'-'.$v['provinceid'].'-'.$v['kldm']];
                $final_list[$k]['kldm'] = ($xnkldm!='')?$xnkldm:$final_list[$k]['kldm']; //纠正个别省份科类代码

                $skx = $skxArr[$this->year.'-'.$v['provinceid'].'-'.$final_list[$k]['kldm']];//保证有省控线
                if (($final_list[$k]['kldm'] == $type) && $skx){ //理工为例
                    if ($v['zydm'] != '2009'){
                        $res[$k]['tdcj'] = $v['tdcj'];
                        $res[$k]['zydm'] = $v['zydm'] == '120200' ? '1202' : $v['zydm'];
                        $res[$k]['zymc'] =$zyArr[$v['zydm']]['zyfx']?$zyArr[$v['zydm']]['zymc'].'（'.$zyArr[$v['zydm']]['zyfx'].'）':$zyArr[$v['zydm']]['zymc'];
                        $res[$k]['skx'] = $skx;
                    }
                }
            }

            $res1 = [];
            foreach ($res as $k=>$v){
                //$res1[$v['zydm']]['diff'] = round($v['tdcj'] - $v['skx'],2);
                $res1[$v['zydm']]['zymc'] = $v['zymc'];
                $res1[$v['zydm']]['diff_total'] += round($v['tdcj']-$v['skx'],2);
                $res1[$v['zydm']]['count'] += 1;
            }
            foreach ($res1 as $k=>$v){
                $res1[$k]['res_diff'] = round($v['diff_total'] / $v['count'],2);
            }
            $temp = $this->arraySort($res1,'res_diff','desc');

            $finalData = [];
            $i = 0;
            $maxnum = 4;
            foreach ($temp as $k=>$v){ //循环五次
                if ($i++ > $maxnum){
                    break;
                }
                if ($v['res_diff'] > 0){
                    $finalData[$k]['zymc'] = $v['zymc'];
                    $finalData[$k]['diff'] = $v['res_diff'];
                }
            }
            $result['msg'] = '1';
            $result['info'] = array_values($finalData);
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($result).")";
                exit;
            }
        }else{
            $result['msg'] = '2';
            $result['info'] = '';
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($result).")";
                exit;
            }
        }
    }


    /**
     * @desc arraySort php二维数组排序 按照指定的key 对数组进行排序
     * @param array $arr 将要排序的数组
     * @param string $keys 指定排序的key
     * @param string $type 排序类型 asc | desc
     * @return array
     */
    public function arraySort($arr, $keys, $type = 'asc') {
        $keysvalue = $new_array = array();
        foreach ($arr as $k => $v){
            $keysvalue[$k] = $v[$keys];
        }
        $type == 'asc' ? asort($keysvalue) : arsort($keysvalue);
        reset($keysvalue);
        foreach ($keysvalue as $k => $v) {
            $new_array[$k] = $arr[$k];
        }
        return $new_array;
    }

}