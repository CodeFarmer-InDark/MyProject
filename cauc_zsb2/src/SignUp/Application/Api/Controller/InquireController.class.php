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

class InquireController extends HomeBaseController
{
    public $dao;
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
    }

    /**
     * @param $year
     * @return array
     * 根据参数获取科类或批次
     */
    public function getPlanKl($year,$province,$field1,$field2)
    {
        $fileName = 'Plan'.$year;
        $db_name = C('DB_PREFIX').strtolower($fileName);
        $Model = new \Think\Model();
        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
        if($m){
            //$this->_message('errorUri','数据不存在，请先完成导入操作',U('Plan/import',array('year'=>$year)));
            //科类下拉
            $mapKl['provinceid'] = $province;
            $dbKlData =  D($fileName)->field("$field1,$field2")->where($mapKl)->select();
            foreach ($dbKlData as $k=>$v) {
                if ($v[$field1] != ''){
                    $v = join(",",$v);
                    $tempKl[$k] = $v;
                }
            }
            $tempKl = array_unique($tempKl);
            foreach ($tempKl as $k => $v) {
                $array=explode(",",$v);
                $tempKl2[$k][$field1] =$array[0];
                $tempKl2[$k][$field2] =$array[1];
            }
            $resKl = array();
            foreach ($tempKl2 as $value) {
                if(isset($resKl[$value[$field1]])){
                    unset($value[$field1]);
                } else{
                    $resKl[$value[$field1]] = $value;
                }
            }
            return $resKl;
        }
    }
    /**
     * @param $year
     * @return array
     * 获取专业
     */
    public function getPlanZy($year,$province)
    {
        $fileName = 'Plan'.$year;
        $filename = strtolower($fileName);
        $db_name = C('DB_PREFIX').strtolower($fileName);
        $Model = new \Think\Model();
        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
        if($m){
            //$this->_message('errorUri','数据不存在，请先完成导入操作',U('Plan/import',array('year'=>$year)));
            //科类下拉
            $mapZy['provinceid'] = $province;
            $dbKlData =  D($fileName)->field('zydm,zymc,zyfx')->where($mapZy)->select();
            foreach ($dbKlData as $k=>$v) {
                if ($v['zydm'] != ''){
                    $v = join(",",$v);
                    $tempKl[$k] = $v;
                }
            }
            $tempKl = array_unique($tempKl);
            foreach ($tempKl as $k => $v) {
                $array=explode(",",$v);
                $tempKl2[$k]["zydm"] =$array[0];
                $tempKl2[$k]["zymc"] =$array[1];
                $tempKl2[$k]["zyfx"] =$array[2];
            }
            return $tempKl2;
        }
    }

    /**
     * 获取专业、科类、计划类别下拉列表
     */
    public function getPlanParam(){
        $year = intval($_GET['year']);
        $province = dHtml(htmlCv($_GET['province']));
        $resKl = $this->getPlanKl($year,$province,'kldm','klmc');
        $resZy = $this->getPlanZy($year,$province);

        //$zyList = M('Zy')->/*where('college!=0')->*/field('id,zydm,zymc,zyfx,college')->select();
        $data['msg'] = '1';
        $data['klList'] = $resKl;
        $data['zyList'] = $resZy;
        
        $jsonp =  htmlspecialchars($_GET["callback"]);
        if (!empty($jsonp)){
            echo $jsonp."(".json_encode($data).")";
            exit;
        }
    }

    /**
     * 接收招生计划查询参数，返回查询结果
     *
     */
    public function getPlan()
    {
        $random =intval($_GET['random']);
        $timestamp = intval($_GET['current']);

        $id = intval($_GET['categoryId']);
        $province = dHtml(htmlCv($_GET['province']));
        $year = dHtml(htmlCv($_GET['year']));
        if (!$year){
            $data["msg"]="4"; //年份未选
            echo json_encode($data);
            exit;
        }else{
            $fileName = 'Plan'.$year;
            $db_name = C('DB_PREFIX').strtolower($fileName);
            $Model = new \Think\Model();
            $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
            if(!$m){
                $data["msg"]="2"; //暂无数据
                echo json_encode($data);
                exit;
            }else{
                $dao = D($fileName);
                $major = dHtml(htmlCv($_GET['major']));
                $majorArr = explode('-',$major);
                $zydm = $majorArr[0];
                $zyfx = $majorArr[1];
                $type = dHtml(htmlCv($_GET['type']));
                //$jhlb = dHtml(htmlCv($_GET['jhlb']));

                $appidGet = dHtml(htmlCv($_GET['appid']));
                $mapAppid['appid'] = $appidGet;
                $appsecretGet = M('Proof')->where($mapAppid)->getField('appsecret');
                $signCheck = md5($random.$timestamp.$id.$province.$year.$major.$type.$appsecretGet);

                $sign = md5(dHtml(htmlCv($_GET['sign'])));
                if ($sign === $signCheck){
                    $now = time();
                    if (($now - $timestamp) > 600){ //十分钟
                        $data["msg"]="0"; //超时验证失败
                        echo json_encode($data);
                        exit;
                    }else{
                        $condition = array();
                        ($province!='') && $condition['provinceid'] = array('eq',$province);
                        $year && $condition['year'] = array('eq',$year);
                        $zydm && $condition['zydm'] = array('eq',$zydm);
                        $zyfx && $condition['zyfx'] = array('eq',$zyfx);
                        ($type!='') && $condition['kldm'] = array('eq',$type);
                        //($jhlb!='') && $condition['jhlbdm'] = array('eq',$jhlb);
                        $count = $dao->where($condition)->count();

                        $page = intval($_GET['p']);//获取前台传过来的页码
                        $pageSize=30;  //设置每页显示的条数
                        $start=($page-1)*30; //从第几条开始取记录
                        $totalPage = ceil($count / $pageSize); //总页数
                        $planList = $dao->field('province,year,ccmc,jhxz,zymc,zyfx,klmc,jhlbmc,batch,target,fee')->where($condition)->order('ccmc asc,pcdm asc,kldm asc,id desc')->Limit($start.','.$pageSize)->select();
                        if (false != $planList){
                            $data["msg"]="1"; //状态码
                            $data['total'] = $totalPage; //总页数
                            $data['info'] = $planList; //计划列表
                            $data['count'] = $count; //记录数

                            $mapRemark = array();
                            $mapRemark['category_id'] = array('eq',$id);
                            $mapRemark['year'] = array('eq',$year);
                            $remark = M('Remark')->where($mapRemark)->getField('content');
                            $data['remark'] = $remark;
                            echo json_encode($data);
                            exit;
                        }else{
                            $data["msg"]="2"; //暂无数据
                            echo json_encode($data);
                            exit;
                        }
                    }
                }else{
                    $data["msg"]="3"; //sign验证失败
                    echo json_encode($data);
                    exit;
                }
            }
        }
    }

    /**
     * 根据年份省份查询参数，返回对应数据（批次、科类）列表
     */
    public function getZs()
    {
        $jsonp = htmlspecialchars($_GET["callback"]);

        $resPc = M('Pc')->order('id asc')->field('dm,pc')->select();
        $resKl = M('Kl')->order('id asc')->field('kldm,klmc')->select();
        $resZy = M('Zy')->order('zydm asc')->field('zydm,zymc,zyfx')->select();
        foreach ($resZy as $k=>$v){
            if ($v['zydm'] == '600401'){
                $resZy[$k]['zydm'] = $v['zydm'].'-'.$v['zyfx'];
            }
        }
        $data['msg'] = '2';
        $data['klList'] = $resKl;
        $data['majorList'] = $resZy;
        $data['pcList'] = $resPc;

        if (!empty($jsonp)){
            echo $jsonp."(".json_encode($data).")";
            exit;
        }

    }
//    public function getZs()
//    {
//        $jsonp = htmlspecialchars($_GET["callback"]);
//        if((!isset($_GET['province']) || empty($_GET['province'])) || (!isset($_GET['year']) || empty($_GET['year']))) {
//            $data['msg'] = '1';
//            echo $jsonp."(".json_encode($data).")";
//            exit;
//        }
//
//        $year = intval($_GET['year']);
//        $province = dHtml(htmlCv($_GET['province']));
//
//        $where = array();
//        $where['provinceid'] = array('eq',$province);
//        $where['year'] = array('eq',$year);
//        $resPc = M('tdPcdm')->order('id asc')->where($where)->field('pcdm,pcmc')->select();
//        $resKl = M('tdKldm')->order('id asc')->where($where)->field('kldm,klmc')->select();
//        $resZy = M('tJhk')->order('id asc')->where($where)->field('zydm,zymc,provinceid')->select();
//        foreach ($resZy as $k=>$v){
//            $resZy[$k]['zyname'] = correctZyname($v,$v['provinceid']);
//        }
//
////        $resKl = $this->getPlanKl($year,$province,'kldm','klmc');
////        $resZy = $this->getPlanZy($year,$province);
////        $resPc = $this->getPlanKl($year,$province,'pcdm','batch');
//
//        //$zyList = M('Zy')->/*where('college!=0')->*/field('id,zydm,zymc,zyfx,college')->select();
//        $data['msg'] = '2';
//        $data['klList'] = $resKl;
//        $data['majorList'] = $resZy;
//        $data['pcList'] = $resPc;
//
//        if (!empty($jsonp)){
//            echo $jsonp."(".json_encode($data).")";
//            exit;
//        }
//
//    }

 /**
     * 根据接收到的年份、省份、批次、科类、专业代码等参数获取对应历年分数
     */
    /*public function getScore(){
        $random =intval($_GET['random']);
        $timestamp = intval($_GET['current']);

        $id = intval($_GET['categoryId']);
        $province =dHtml(htmlCv($_GET['province']));
        $year1 = intval($_GET['year1']);
        $year2 = intval($_GET['year2']);
        $year3 = intval($_GET['year3']);
        $zydm = dHtml(htmlCv($_GET['zydm']));
        $kldm = dHtml(htmlCv($_GET['kldm']));
        $type = intval($_GET['type']);

        $appidGet = dHtml(htmlCv($_GET['appid']));
        $mapAppid['appid'] = $appidGet;
        $appsecretGet = M('Proof')->where($mapAppid)->getField('appsecret');
        $signCheck = md5($random.$timestamp.$id.$province.$kldm.$year1.$year2.$year3.$zydm.$appsecretGet);
        $sign = md5(dHtml(htmlCv($_GET['sign'])));
        if ($sign === $signCheck){
            $now = time();
            if (($now - $timestamp) > 600){ //十分钟
                $data["msg"]="0"; //超时验证失败
                echo json_encode($data);
                exit;
            }else{
                if($year1 || $year2 || $year3){
                    $year_s_arr = array($year1,$year2,$year3);
                }else{
                    $year_s_arr = '';
                }

                if($this->checkCurrentData('score') == 1){
                    $yearArr[0] =date('Y');
                    $yearArr[1] =date('Y') - 1;
                    $yearArr[2] =date('Y') - 2;
                }else{
                    $yearArr[0] =date('Y') - 1;
                    $yearArr[1] =date('Y') - 2;
                    $yearArr[2] =date('Y') - 3;
                }

                $provinceList = M('Province')->select();
                foreach ($provinceList as $k=>$v){
                    $provinceArr[$v['id']] = $v['name'];
                }
                $pcdmList = M('tdPcdm')->field('year,provinceid,pcdm,pcmc')->select();
                $pcdmArr = [];
                foreach ($pcdmList as $k=>$v){
                    $pcdmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['pcdm']] = $v['pcmc'];
                }
                $kldmList = M('tdKldm')->field('year,provinceid,kldm,klmc')->select();
                $kldmArr = [];
                foreach ($kldmList as $k=>$v){
                    $kldmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['kldm']] = $v['klmc'];
                }
                $zyList = M('Zy')->field('year,zydm,zymc,zyfx,ccdm')->select();
                $zyArr = [];
                foreach ($zyList as $k=>$v){
                    $zyArr[$v['year'].'-'.$v['zydm']]['zymc'] = $v['zymc'];
                    if ($v['ccdm'] == 1){
                        $zyArr[$v['year'].'-'.$v['zydm']]['zyfx'] = $v['zyfx'];
                    }
                }
                if ($type == 1){
                    $skxList = M('Skx')->select();
                    $skxArr = [];
                    foreach ($skxList as $k=>$v){
                        $skxArr[$v['year'].'-'.$v['province'].'-'.$v['kldm']] = $v['skx'];
                    }

                    $tddwList = M('CorrectTddw')->select();
                    foreach ($tddwList as $k=>$v){
                        $tddwArr[$v['year'].'-'.$v['provinceid'].'-'.$v['tddw']] = $v['kldm'];
                    }
                    $ckldmList = M('CorrectKldm')->select();
                    foreach ($ckldmList as $k=>$v){
                        $ckldmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['kldm_origin']] = $v['kldm'];
                    }
                }

                if (!$year_s_arr){
                    $conditionYear = $yearArr;
                }else{
                    $conditionYear = $year_s_arr;
                }
                for ($i=0;$i<count($conditionYear);$i++){
                    $fileName = 'Score'.$conditionYear[$i];
                    $db_name = C('DB_PREFIX').strtolower($fileName);
                    $Model = new \Think\Model();
                    $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
                    if($m){
                        $dao = D($fileName);
                        $condition = array();
                        $province && $condition['province'] = array('eq', $province);
                        ($kldm!='') && $condition['kldm'] = array('eq',$kldm);
                        if (strlen($zydm) == 4){ //部分专业合并为大类，查询时均查出
                            $mapZy = array();
                            $mapZy['zydm'] = array('like',$zydm.'%');
                            $tempZydm = M('Zy')->where($mapZy)->field('zydm')->select();
                            $zydm && $condition['queryzydm'] = array('in', array_column($tempZydm,'zydm'));
                        }else{
                            if (strpos($zydm,'-') !== false){
                                $zydmArr = explode('-',$zydm);
                                switch($zydmArr[1]){
                                    case '机场指挥':$lqzy =  substr($conditionYear[$i],-2).$province.'Z016';break;
                                    case '通航综合航务':$lqzy =  substr($conditionYear[$i],-2).$province.'Z022';break;
                                    case '地面服务':$lqzy =  substr($conditionYear[$i],-2).$province.'Z030';break;
                                }
                                $lqzy && $condition['lqzy'] = array('eq', $lqzy);
                            }else{
                                $zydm && $condition['queryzydm'] = array('eq', $zydm);
                            }
                        }
                        $scoreList[] = $dao->where($condition)->order('pc asc,id desc')->select();
                    }
                }
                //三维数组转二维数组
                foreach($scoreList as $value){
                    foreach($value as $v){
                        $lastList[]=$v;
                    }
                }
                //销毁$arr3
                unset($scoreList,$value,$v);
                if (false != $lastList) {
                    foreach ($lastList as $key => $val) {
                        $lastList[$key]['pcname'] = $pcdmArr[$val['year'].'-'.$val['province'].'-'.$val['pcdm']];
                        $lastList[$key]['tname'] = $kldmArr[$val['year'].'-'.$val['province'].'-'.$val['kldm']];
                        $lastList[$key]['zyname'] = $zyArr[$val['year'].'-'.$val['queryzydm']]['zymc'];
                        $lastList[$key]['zyfx'] = $zyArr[$val['year'].'-'.$val['queryzydm']]['zyfx'];
                        $lastList[$key]['pname'] = $provinceArr[$val['province']];

                        if ($type == 1){
                            $tddwkldm = $tddwArr[$val['year'].'-'.$val['province'].'-'.$val['tddw']];
                            $lastList[$key]['kldm'] = $tddwkldm?$tddwkldm:$val['kldm'];//纠正个别省份科类文理综合分文理

                            $xnkldm = $ckldmArr[$val['year'].'-'.$val['province'].'-'.$lastList[$key]['kldm']];
                            $lastList[$key]['kldm'] = ($xnkldm!='')?$xnkldm: $lastList[$key]['kldm']; //纠正个别省份科类代码
                            $lastList[$key]['skx'] = $skxArr[$val['year'].'-'.$val['province'].'-'.$lastList[$key]['kldm']];
                            if ($lastList[$key]['skx'] && $lastList[$key]['skx'] != 0){
                                $lastList[$key]['diff'] = $lastList[$key]['lowscore'] - $lastList[$key]['skx'];
                            }
                        }
                    }
                    $data["msg"] = "1"; //状态码
                    $data['info'] = $lastList; //计划列表
                    $mapRemark['category_id'] = $id;
                    //$mapRemark['year'] = $year;
                    $remark = M('Remark')->where($mapRemark)->getField('content');
                    $data['remark'] = $remark;
                    echo json_encode($data);
                    exit;
                }else{
                    $data["msg"] = "2"; //暂无数据
                    echo json_encode($data);
                    exit;
                }
            }
        }else{
            $data["msg"]="3"; //sign验证失败
            echo json_encode($data);
            exit;
        }
    }*/




    /**
     * 根据接收到的年份、省份、科类、专业代码等参数获取对应历年分数
     */
    public function getScore(){
        $random =intval($_GET['random']);
        $timestamp = intval($_GET['now']);
        $id = intval($_GET['categoryId']);
        $province =dHtml(htmlCv($_GET['province']));
        $year1 = intval($_GET['year1']);
        $year2 = intval($_GET['year2']);
        $year3 = intval($_GET['year3']);
        $zydm = dHtml(htmlCv($_GET['zydm']));
        $kldm = dHtml(htmlCv($_GET['kldm']));
        $type = intval($_GET['type']);

        $appidGet = dHtml(htmlCv($_GET['appid']));
        $mapAppid['appid'] = $appidGet;
        $appsecretGet = M('Proof')->where($mapAppid)->getField('appsecret');
        $signCheck = md5($random.$timestamp.$id.$province.$kldm.$year1.$year2.$year3.$zydm.$appsecretGet);
        $sign = md5(dHtml(htmlCv($_GET['sign'])));
        if ($sign === $signCheck){
            $now = time();
            if (($now - $timestamp) > 600){ //十分钟
                $data["msg"]="0"; //超时验证失败
                echo json_encode($data);
                exit;
            }else{
                if($year1 || $year2 || $year3){
                    $year_s_arr = array($year1,$year2,$year3);
                }else{
                    $year_s_arr = '';
                }

                if($this->checkCurrentData('score') == 1){
                    $yearArr[0] =date('Y');
                    $yearArr[1] =date('Y') - 1;
                    $yearArr[2] =date('Y') - 2;
                }else{
                    $yearArr[0] =date('Y') - 1;
                    $yearArr[1] =date('Y') - 2;
                    $yearArr[2] =date('Y') - 3;
                }

                $provinceList = M('Province')->select();
                foreach ($provinceList as $k=>$v){
                    $provinceArr[$v['id']] = $v['name'];
                }
                $pcdmList = M('tdPcdm')->field('year,provinceid,pcdm,pcmc,pcid')->select();
                $pcdmArr = [];
                foreach ($pcdmList as $k=>$v){
                    if ($v['year'] == '2017' && $v['provinceid'] == 54) {
                        $pcdmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['pcdm'].'-'.$v['pcid']] = $v['pcmc'];
                    } else {
                        $pcdmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['pcdm']] = $v['pcmc'];
                    }
                }
//                $kldmList = M('tdKldm')->field('year,provinceid,kldm,klmc')->select();
//                $kldmArr = [];
//                foreach ($kldmList as $k=>$v){
//                    $kldmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['kldm']] = $v['klmc'];
//                }
                $zyList = M('Zy')->field('year,zydm,zymc,zyfx,ccdm')->select();
                $zyArr = [];
                foreach ($zyList as $k=>$v){
                    $zyArr[$v['year'].'-'.$v['zydm']]['zymc'] = $v['zymc'];
                    if ($v['ccdm'] == 1){
                        $zyArr[$v['year'].'-'.$v['zydm']]['zyfx'] = $v['zyfx'];
                    }
                }
                //if ($type == 1){
                    $skxList = M('Skx')->select();
                    $skxArr = [];
                    foreach ($skxList as $k=>$v){
                        $skxArr[$v['year'].'-'.$v['province'].'-'.$v['kldm']] = $v['skx'];
                    }
                    $tddwList = M('CorrectTddw')->select();
                    foreach ($tddwList as $k=>$v){
                        $tddwArr[$v['year'].'-'.$v['provinceid'].'-'.$v['tddw']] = $v['kldm'];
                    }
                    $ckldmList = M('CorrectKldm')->select();
                    foreach ($ckldmList as $k=>$v){
                        if (in_array($v['status'],[3,2])){ //统计列表或全部时
                            $ckldmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['kldm_origin']] = $v['kldm'];
                        }
                    }
                //}

                if (!$year_s_arr){
                    $conditionYear = $yearArr;
                }else{
                    $conditionYear = $year_s_arr;
                }

                //确定查询科类的范围
                $kldm = $_GET['kldm'];
                $kldm_arr = [
                    1   =>  '%理%',
                    2   =>  '%文%',
                    3   =>  '%综合改革%'
                ];
                if ($kldm && in_array($kldm,[1,2,3])) {
                    $last_kldm = M('Kl')->where("klmc like '$kldm_arr[$kldm]'")->field('kldm')->select();
                    $last_kldm = array_column(array_values($last_kldm),'kldm');
                    $origin_kldm = $last_kldm;
                    //存在纠正科类代码的话就使用origin_kldm
                    foreach ($conditionYear as $key => $val) {
                        if (!$val) {
                            unset($conditionYear[$key]);
                        }
                    }
                    $conditionYear = array_values($conditionYear);
                    $query_kldm_condition['year'] = array('in',$conditionYear);
                    $query_kldm_condition['kldm'] = array('in',$last_kldm);
                    $query_kldm_condition['provinceid'] = array('eq',$province);
                    $query_kldm = M('CorrectKldm')
                        ->where($query_kldm_condition)
                        ->field('kldm_origin')
                        ->select();
                    if ($query_kldm) {
                        $origin_kldm = array_unique(array_column(array_values($query_kldm),'kldm_origin'));
                    }
                }



                //查询计划库中的tddw--用来区分部分省份(例如：广西)的文理综合
                $tddw = M('TJhk')->where('year',array('in',$conditionYear))->field('tddw,zydh,zydm,zymc,year')->select();
                $tddw_new = array();
                //区分民航运输和飞机机电设备维修
                $spec_zyfx = array();
                foreach ($tddw as $key => $val) {
                    $tddw_new[$val['zydh']] = $val['tddw'];
                    if (($val['year'] == '2017' && $val['zydm'] == '600401') ||( $val['zydm'] == '600409')) {
                        $spec_zyfx[$val['zydh']] = $val['zymc'];
                    }
                }
                unset($tddw);

                //按照选择的年份来查询分数数据
                for ($i=0;$i<count($conditionYear);$i++){
                    $fileName = 'Score'.$conditionYear[$i];
                    $db_name = C('DB_PREFIX').strtolower($fileName);
                    $Model = new \Think\Model();
                    $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
                    if($m){
                        $dao = D($fileName);
                        $condition = array();
                        $province && $condition['province'] = array('eq', $province);

//                        $kldm && $condition['kldm'] = array('eq',$kldm);
                        if ($kldm) {
                            if (isset($origin_kldm) && $province != 32) {
                                $kldm && $condition['kldm'] = array('in',$origin_kldm);
                            }
                            if ($province == 32) {
                                //江西理科的kldm = 2，文科kldm = 1
                                if ($kldm == 1) {
                                    $condition['kldm'] = array('eq',2);
                                }
                                if ($kldm) {
                                    $condition['kldm'] = array('eq',1);
                                }
                            }
                        }
                        if (strlen($zydm) == 4){ //部分专业合并为大类，查询时均查出
                            $mapZy = array();
                            $mapZy['zydm'] = array('like',$zydm.'%');
                            $tempZydm = M('Zy')->where($mapZy)->field('zydm')->select();
                            $zydm && $condition['queryzydm'] = array('in', array_column($tempZydm,'zydm'));
                        }else{
                            if (strpos($zydm,'-') !== false){
                                $zydmArr = explode('-',$zydm);
                                switch($zydmArr[1]){
                                    case '机场指挥':$lqzy =  substr($conditionYear[$i],-2).$province.'Z016';break;
                                    case '通航综合航务':$lqzy =  substr($conditionYear[$i],-2).$province.'Z022';break;
                                    case '地面服务':$lqzy =  substr($conditionYear[$i],-2).$province.'Z030';break;
                                }
                                $lqzy && $condition['lqzy'] = array('eq', $lqzy);
                            }else{
                                $zydm && $condition['queryzydm'] = array('eq', $zydm);
                            }
                        }
                        $scoreList[] = $dao->where($condition)->order('year desc,pcdm asc,kldm,lowscore desc')->select();
                    }
                }
                //三维数组转二维数组
                foreach($scoreList as $value){
                    foreach($value as $v){
                        $lastList[]=$v;
                    }
                }
                //销毁$arr3
                unset($scoreList,$value,$v);
                if (false != $lastList) {
                    foreach ($lastList as $key => $val) {
                        $lastList[$key]['pcname'] = $pcdmArr[$val['year'].'-'.$val['province'].'-'.$val['pcdm']];
                        //17年部分省份还要多加一个pcid进行判断
                        if ($val['year'] == '2017' && $val['province'] == 54) {
                            $lastList[$key]['pcname'] = $pcdmArr[$val['year'].'-'.$val['province'].'-'.$val['pcdm'].'-'.$val['pc']];
                        }
                        //$lastList[$key]['tname'] = $kldmArr[$val['year'].'-'.$val['province'].'-'.$val['kldm']];
                        $lastList[$key]['zyname'] = $zyArr[$val['year'].'-'.$val['queryzydm']]['zymc'];
                        $lastList[$key]['zyfx'] = $zyArr[$val['year'].'-'.$val['queryzydm']]['zyfx'];
                        if ($val['queryzydm'] == '600401' && $val['year'] == 2017) {
                            $temp_zyfx = $spec_zyfx[$val['lqzy']];
                            if (strpos($temp_zyfx,'机场指挥')) {
                                $lastList[$key]['zyfx'] = '机场指挥';
                            } elseif (strpos($temp_zyfx,'通航综合航务')) {
                                $lastList[$key]['zyfx'] = '通航综合航务';
                            }elseif (strpos($temp_zyfx,'地面服务')) {
                                $lastList[$key]['zyfx'] = '地面服务';
                            }
                        }
                        if ($val['queryzydm'] == '600409') {
                            $temp_zyfx = $spec_zyfx[$val['lqzy']];
                            if (strpos($temp_zyfx,'直升机')) {
                                $lastList[$key]['zyfx'] = '直升机';
                            }
                        }
                        $lastList[$key]['pname'] = $provinceArr[$val['province']];

                        //if ($type == 1){
                        if($val['province'] == 32){
                            if ($lastList[$key]['kldm'] == 2){
                                $lastList[$key]['tname'] = '理科';
                            }elseif($lastList[$key]['kldm'] == 1){
                                $lastList[$key]['tname'] = '文科';
                            }
                        }else{
                            $tddwkldm = $tddwArr[$val['year'].'-'.$val['province'].'-'.$tddw_new[$val['lqzy']]];
                            $lastList[$key]['kldm'] = $tddwkldm?$tddwkldm:$val['kldm'];//纠正个别省份科类文理综合分文理

                            $xnkldm = $ckldmArr[$val['year'].'-'.$val['province'].'-'.$lastList[$key]['kldm']];
                            $lastList[$key]['kldm'] = ($xnkldm!='')?$xnkldm: $lastList[$key]['kldm']; //纠正个别省份科类代码
                            if ($lastList[$key]['kldm'] == 5){
                                $lastList[$key]['tname'] = '理科';
                            }elseif($lastList[$key]['kldm'] == 1){
                                $lastList[$key]['tname'] = '文科';
                            }elseif($lastList[$key]['kldm'] == '0'){
                                $lastList[$key]['tname'] = '文理综合';
                            }elseif($lastList[$key]['kldm'] == 'Z'){
                                $lastList[$key]['tname'] = '综合改革';
                            }
                        }

                        $lastList[$key]['skx'] = $skxArr[$val['year'].'-'.$val['province'].'-'.$lastList[$key]['kldm']];
                        if ($lastList[$key]['skx'] && $lastList[$key]['skx'] != 0){
                            $lastList[$key]['diff'] = $lastList[$key]['lowscore'] - $lastList[$key]['skx'];
                        }
                        //}
                    }
                    $data["msg"] = "1"; //状态码
                    $data['info'] = $lastList; //计划列表
                    $mapRemark['category_id'] = $id;
                    //$mapRemark['year'] = $year;
                    $remark = M('Remark')->where($mapRemark)->getField('content');
                    $data['remark'] = $remark;
                    echo json_encode($data);
                    exit;
                }else{
                    $data["msg"] = "2"; //暂无数据
                    echo json_encode($data);
                    exit;
                }
            }
        }else{
            $data["msg"]="3"; //sign验证失败
            echo json_encode($data);
            exit;
        }
    }

    //根据省份、年份、批次获取获取历年分数
    public function getScoreByPc(){
        $random =intval($_GET['random']);
        $timestamp = intval($_GET['now']);
        $id = intval($_GET['categoryId']);
        $province =dHtml(htmlCv($_GET['province']));
        $year1 = intval($_GET['year1']);
        $year2 = intval($_GET['year2']);
        $year3 = intval($_GET['year3']);
        $pc = dHtml(htmlCv($_GET['pc']));
//        $type = intval($_GET['type']);

        $appidGet = dHtml(htmlCv($_GET['appid']));
        $mapAppid['appid'] = $appidGet;
        $appsecretGet = M('Proof')->where($mapAppid)->getField('appsecret');
        $signCheck = md5($random.$timestamp.$id.$province.$year1.$year2.$year3.$pc.$appsecretGet);
        $sign = md5(dHtml(htmlCv($_GET['sign'])));
        if ($sign === $signCheck){
            $now = time();
            if (($now - $timestamp) > 600){ //十分钟
                $data["msg"]="0"; //超时验证失败
                echo json_encode($data);
                exit;
            }else{
                if($year1 || $year2 || $year3){
                    $year_s_arr = array($year1,$year2,$year3);
                }else{
                    $year_s_arr = '';
                }

                if($this->checkCurrentData('score') == 1){
                    $yearArr[0] =date('Y');
                    $yearArr[1] =date('Y') - 1;
                    $yearArr[2] =date('Y') - 2;
                }else{
                    $yearArr[0] =date('Y') - 1;
                    $yearArr[1] =date('Y') - 2;
                    $yearArr[2] =date('Y') - 3;
                }

                $provinceList = M('Province')->select();
                foreach ($provinceList as $k=>$v){
                    $provinceArr[$v['id']] = $v['name'];
                }
                $pcdmList = M('tdPcdm')->field('year,provinceid,pcdm,pcmc,pcid')->select();
                $pcdmArr = [];
                foreach ($pcdmList as $k=>$v){
                    $pcdmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['pcdm']] = $v['pcmc'];
                    if ($v['year'] == '2017' && $v['provinceid'] == 54) {
                        $pcdmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['pcdm'].'-'.$v['pcid']] = $v['pcmc'];
                    }
                }
                $tddwList = M('CorrectTddw')->select();
                foreach ($tddwList as $k=>$v){
                    $tddwArr[$v['year'].'-'.$v['provinceid'].'-'.$v['tddw']] = $v['kldm'];
                }
                $ckldmList = M('CorrectKldm')->select();
                foreach ($ckldmList as $k=>$v){
                    if (in_array($v['status'],[3,2])){ //统计列表或全部时
                        $ckldmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['kldm_origin']] = $v['kldm'];
                    }
                }
                //}

                if (!$year_s_arr){
                    $conditionYear = $yearArr;
                }else{
                    $conditionYear = $year_s_arr;
                }

                //查询历年分数数据
                for ($i=0;$i<count($conditionYear);$i++){
                    $fileName = 'Score_pc'.$conditionYear[$i];
                    $db_name = C('DB_PREFIX').strtolower($fileName);
                    $Model = new \Think\Model();
                    $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
                    if($m){
                        $dao = D($fileName);
                        $condition = array();
                        $province && $condition['province'] = array('eq', $province);
                        $pc != '' && $condition['pcdm'] = array('eq',$pc);
                        $scoreList[] = $dao->where($condition)->order('year desc,pcdm asc,lowscore desc')->select();
                    }
                }
                //三维数组转二维数组
                foreach($scoreList as $value){
                    foreach($value as $v){
                        $lastList[]=$v;
                    }
                }
                //销毁$arr3
                unset($scoreList,$value,$v);
                $spec_ccdm_arr = [
                    'A' =>  '（本科）',
                    'B' =>  '（专科）',
                ];
                if (false != $lastList) {
                    foreach ($lastList as $key => $val) {
                        //浙江省省内批次通过生成分数时候自定义的标识来区分本科和专科
                        if ($province == 33) {
                            $is_spec = explode('|',$val['pcdm']);
                            count($is_spec) == 2? $lastList[$key]['pcname'] = $pcdmArr[$val['year'].'-'.$val['province'].'-'.$is_spec[0]].$spec_ccdm_arr[$is_spec[1]]:$lastList[$key]['pcname'] = $pcdmArr[$val['year'].'-'.$val['province'].'-'.$val['pcdm']];
                        }else{
                            if ($province == 54 && $val['year'] == '2017' && $val['pcdm'] == 4) {
                                $lastList[$key]['pcname'] = $pcdmArr[$val['year'].'-'.$val['province'].'-'.$val['pcdm'].'-10'];
                            }else{
                                $lastList[$key]['pcname'] = $pcdmArr[$val['year'].'-'.$val['province'].'-'.$val['pcdm']];
                            }
                        }
                        //$lastList[$key]['tname'] = $kldmArr[$val['year'].'-'.$val['province'].'-'.$val['kldm']];
                        $lastList[$key]['pname'] = $provinceArr[$val['province']];

                        //if ($type == 1){
                        if($val['province'] == 32){
                            if ($lastList[$key]['kldm'] == 2){
                                $lastList[$key]['tname'] = '理科';
                            }elseif($lastList[$key]['kldm'] == 1){
                                $lastList[$key]['tname'] = '文科';
                            }
                        }else{
                            //-----此处不需要在进行个别省份的文理综合分离，因为生成批次分数数据的时候已经进行了分离

                            //纠正别的省份科类代码
                            $xnkldm = $ckldmArr[$val['year'].'-'.$val['province'].'-'.$lastList[$key]['kldm']];
                            $lastList[$key]['kldm'] = ($xnkldm!='')?$xnkldm: $lastList[$key]['kldm']; //纠正个别省份科类代码
                            if ($lastList[$key]['kldm'] == 5){
                                $lastList[$key]['tname'] = '理科';
                            }elseif($lastList[$key]['kldm'] == 1){
                                $lastList[$key]['tname'] = '文科';
                            }elseif($lastList[$key]['kldm'] == '0'){
                                $lastList[$key]['tname'] = '文理综合';
                            }elseif($lastList[$key]['kldm'] == 'Z'){
                                $lastList[$key]['tname'] = '综合改革';
                            }
                        }
                        //}
                    }
                    $data["msg"] = "1"; //状态码
                    $data['info'] = $lastList; //计划列表
                    $mapRemark['category_id'] = $id;
                    //$mapRemark['year'] = $year;
                    $remark = M('Remark')->where($mapRemark)->getField('content');
                    $data['remark'] = $remark;
                    echo json_encode($data);
                    exit;
                }else{
                    $data["msg"] = "2"; //暂无数据
                    echo json_encode($data);
                    exit;
                }
            }
        }else{
            $data["msg"]="3"; //sign验证失败
            echo json_encode($data);
            exit;
        }
    }
    //获取校内批次
    public function getPc(){
        $jsonp = htmlspecialchars($_GET["callback"]);
        if (empty($jsonp)){
            header('HTTP/1.1 404 Not Found');
            header("status: 404 Not Found");
            exit();
        }
        //年份和省份
        $years = dHtml(htmlCv($_GET['years']));
        $province = intval(dHtml(htmlCv($_GET['province'])));
        $years = explode(',',$years);
        if (!$years || !$province) {
            $data['msg'] = '2';//参数错误
            echo $jsonp."(".json_encode($data).")";
            exit;
        }
        //查询省内批次
        $con['year'] = array('in',$years);
        $con['provinceid'] = array('eq',$province);
        $pcList = M('tdPcdm')->field('year,pcdm,pcmc')->where($con)->select();
        if (false != $pcList){
            $dataList = [];
            foreach ($pcList as $k=>$v){
                $dataList[$v['pcdm']]['pcdm'] = $v['pcdm'];
                $dataList[$v['pcdm']]['pcmc'] = $v['pcmc'];
            }
            $dataList = array_values($dataList);
            $data['msg'] = '1'; //成功
            $data['scoreList'] = $dataList;
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        } else{
            $data['msg'] = '2';//无数据
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        }
    }



	/**
     * 根据年份获取专业及科类
     */
    public function getMajorByYear(){
        $jsonp = htmlspecialchars($_GET["callback"]);
        if (empty($jsonp)){
            header('HTTP/1.1 404 Not Found');
            header("status: 404 Not Found");
        }
        $year = dHtml(htmlCv($_GET['year']));
        $provinceid = intval($_GET['province']);
        if (!$year || $year == ''){
            if($this->checkCurrentData('score') == 1){
                $yearArr[0] =date('Y');
                $yearArr[1] =date('Y') - 1;
                $yearArr[2] =date('Y') - 2;
            }else{
                $yearArr[0] =date('Y') - 1;
                $yearArr[1] =date('Y') - 2;
                $yearArr[2] =date('Y') - 3;
            }
        }else{
            $yearArr = explode(',',$year);
            for ($i=0;$i<count($yearArr);$i++){
                if ($yearArr[$i] == 0){
                    unset($yearArr[$i]);
                }
            }
        }
        $condition['year'] = array('in',$yearArr);
        $zyList = M('Zy')->where($condition)->field('zydm,zymc')->order('ccdm asc,zydm asc')->select();
//        $condition['provinceid'] = array('eq',$provinceid);
//        $kldmList = M('tdKldm')->where($condition)->field('kldm,klmc')->select();
        if (false != $zyList){
            $dataList = [];
            foreach ($zyList as $k=>$v){
                $dataList[$v['zydm']]['zydm'] = $v['zydm'];
                $dataList[$v['zydm']]['zymc'] = $v['zymc'];
            }
            $dataList = array_values($dataList);
            $data['msg'] = '1'; //成功
            $data['scoreList'] = $dataList;
//            $data['kldmList'] = $dataList1;
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        } else{
            $data['msg'] = '2';//无数据
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        }
    }
    private function checkCurrentData($model){
        $fileName = $model.date('Y');
        $db_name = C('DB_PREFIX').strtolower($fileName);
        $Model = new \Think\Model();
        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
        if($m){
            $dao = D($fileName);
            $dataList = $dao->field('id')->select();
            if (false != $dataList){
                return 1;
            }else{
                return 2;
            }
        }else{
            return 2;
        }
    }
    public function getMajorByYearBake(){
        $jsonp = htmlspecialchars($_GET["callback"]);
        if (empty($jsonp)){
            header('HTTP/1.1 404 Not Found');
            header("status: 404 Not Found");
        }
        $year = dHtml(htmlCv($_GET['year']));
        $provinceid = intval($_GET['province']);
        if (!$year || $year == ''){
            if($this->checkCurrentData('score') == 1){
                $yearArr[0] =date('Y');
                $yearArr[1] =date('Y') - 1;
                $yearArr[2] =date('Y') - 2;
            }else{
                $yearArr[0] =date('Y') - 1;
                $yearArr[1] =date('Y') - 2;
                $yearArr[2] =date('Y') - 3;
            }
        }else{
            $yearArr = explode(',',$year);
            for ($i=0;$i<count($yearArr);$i++){
                if ($yearArr[$i] == 0){
                    unset($yearArr[$i]);
                }
            }
        }
        $condition['year'] = array('in',$yearArr);
        $zyList = M('Zy')->where($condition)->field('zydm,zymc')->order('ccdm asc,zydm asc')->select();
        $condition['provinceid'] = array('eq',$provinceid);
        $kldmList = M('tdKldm')->where($condition)->field('kldm,klmc')->select();
        if (false != $zyList && false != $kldmList){
            $dataList = [];
            foreach ($zyList as $k=>$v){
                $dataList[$v['zydm']]['zydm'] = $v['zydm'];
                $dataList[$v['zydm']]['zymc'] = $v['zymc'];
            }
            $dataList1 = [];
            foreach ($kldmList as $k=>$v){
                $dataList1[$v['kldm']]['kldm'] = $v['kldm'];
                $dataList1[$v['kldm']]['klmc'] = $v['klmc'];
            }
            $dataList = array_values($dataList);
            $data['msg'] = '1'; //成功
            $data['scoreList'] = $dataList;
            $data['kldmList'] = $dataList1;
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        }elseif(false != $zyList && false == $kldmList){
            $dataList = [];
            foreach ($zyList as $k=>$v){
                $dataList[$v['zydm']]['zydm'] = $v['zydm'];
                $dataList[$v['zydm']]['zymc'] = $v['zymc'];
            }
            $dataList = array_values($dataList);
            $data['msg'] = '1'; //成功
            $data['scoreList'] = $dataList;
            $data['kldmList'] = '';
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        }elseif(false == $zyList && false != $kldmList){
            $dataList1 = [];
            foreach ($kldmList as $k=>$v){
                $dataList1[$v['kldm']]['kldm'] = $v['kldm'];
                $dataList1[$v['kldm']]['klmc'] = $v['klmc'];
            }
            $data['msg'] = '1'; //成功
            $data['scoreList'] = '';
            $data['kldmList'] = $dataList1;
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        } else{
            $data['msg'] = '2';//无数据
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        }
    }

	
    /**
     * 根据年份省份，返回对应历年分数
     */
    public function charts()
    {
        $jsonp = htmlspecialchars($_GET["callback"]);
        if((!isset($_GET['province']) || empty($_GET['province'])) || (!isset($_GET['zydm']) || empty($_GET['zydm']))) {
            $data['msg'] = '3';
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        }
        $year = $_GET['year'];
        if (!$year){
            if($this->checkCurrentData('score') == 1){
                $yearArr[0] =date('Y');
                $yearArr[1] =date('Y') - 1;
                $yearArr[2] =date('Y') - 2;
            }else{
                $yearArr[0] =date('Y') - 1;
                $yearArr[1] =date('Y') - 2;
                $yearArr[2] =date('Y') - 3;
            }
        }else{
			$yearArr = explode(',', $year);
            foreach ($yearArr as $key => $val) {
                if ($val == '') {
                    unset($yearArr[$key]);
                }
            }
            //$yearArr[0] = $year;
            //$yearArr[1] = $year - 1;
            //$yearArr[2] = $year - 2;
        }
        $provinceid = dHtml(htmlCv($_GET['province']));
        $zydm = dHtml(htmlCv($_GET['zydm']));
        //确定查询科类的范围
        $kldm = dHtml(htmlCv($_GET['kldm']));
        $kldm_arr = [
            1   =>  '%理%',
            2   =>  '%文%',
            3   =>  '%综合改革%'
        ];
        if ($kldm && in_array($kldm,[1,2,3])) {
            $last_kldm = M('Kl')->where("klmc like '$kldm_arr[$kldm]'")->field('kldm')->select();
            $last_kldm = array_column(array_values($last_kldm),'kldm');
            $origin_kldm = $last_kldm;
            //存在纠正科类代码的话就使用origin_kldm
            $query_kldm_condition['year'] = array('in',$yearArr);
            $query_kldm_condition['kldm'] = array('in',$last_kldm);
            $query_kldm_condition['provinceid'] = array('eq',$provinceid);
            $query_kldm = M('CorrectKldm')
                ->where($query_kldm_condition)
                ->field('kldm_origin')
                ->select();
            if ($query_kldm) {
                $origin_kldm = array_unique(array_column(array_values($query_kldm),'kldm_origin'));
            }
        }
        $where = array();
        $provinceid && $where['province'] = array('eq',$provinceid);
        $kldm && $where['kldm'] = array('in',$origin_kldm);

        $tddwList = M('CorrectTddw')->select();
        foreach ($tddwList as $k=>$v){
            $tddwArr[$v['year'].'-'.$v['provinceid'].'-'.$v['tddw']] = $v['kldm'];
        }
        $ckldmList = M('CorrectKldm')->select();
        foreach ($ckldmList as $k=>$v){
            if (in_array($v['status'],[3,2])){ //统计列表或全部时
                $ckldmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['kldm_origin']] = $v['kldm'];
            }
        }

        //查询计划库中的tddw--用来区分部分省份(例如：广西)的文理综合
        $tddw = M('TJhk')->where('year',array('in',$yearArr))->field('tddw,zydh')->select();
        $tddw_new = array();
        foreach ($tddw as $key => $val) {
            $tddw_new[$val['zydh']] = $val['tddw'];
        }
        unset($tddw);


        for ($i=0;$i<count($yearArr);$i++){
            $fileName = 'Score'.$yearArr[$i];
            $db_name = C('DB_PREFIX').strtolower($fileName);
            $Model = new \Think\Model();
            $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
            if ($m){
                $dao = D($fileName);
                if (strpos($zydm,'-') !== false){
                    $zydmArr = explode('-',$zydm);
                    switch($zydmArr[1]){
                        case '机场指挥':$lqzy =  substr($yearArr[$i],-2).$provinceid.'Z016';break;
                        case '通航综合航务':$lqzy =  substr($yearArr[$i],-2).$provinceid.'Z022';break;
                        case '地面服务':$lqzy =  substr($yearArr[$i],-2).$provinceid.'Z030';break;
                    }
                    $where['lqzy'] = array('eq', $lqzy);
                }else{
                    $where['queryzydm'] = array('eq', $zydm);
                }
				$where['year'] = array('in',$yearArr);
                $scoreList[] = $dao->where($where)->field('lqzy,kldm,year,topScore,lowScore,aveScore')->select();
            }
        }
        if (false != $scoreList){
            //降维
            $score_temp = array();
            foreach ($scoreList as $key => $val) {
                $score_temp = array_merge($score_temp,$val);
            }
            //为年份添加上科类
            $scoreList = array();
            foreach ($score_temp as $key => $val) {
                if($provinceid == 32){
                    if ($val['kldm'] == 2){
                        $val['year'] .= '--理';
                    }elseif($val['kldm'] == 1){
                        $val['year'] .= '--文';
                    }
                }else{
                    $tddwkldm = $tddwArr[$val['year'].'-'.$val['province'].'-'.$tddw_new[$val['lqzy']]];
                    $val['kldm'] = $tddwkldm?$tddwkldm:$val['kldm'];//纠正个别省份科类文理综合分文理

                    $xnkldm = $ckldmArr[$val['year'].'-'.$val['province'].'-'.$val['kldm']];
                    $lastList[$key]['kldm'] = ($xnkldm!='')?$xnkldm: $val['kldm']; //纠正个别省份科类代码
                    if ($val['kldm'] == 5){
                        $val['year'] .= '-理';
                    }elseif($val['kldm'] == 1){
                        $val['year'] .= '-文';
                    }elseif($val['kldm'] == '0'){
                        $val['year'] .= '-文理综合';
                    }elseif($val['kldm'] == 'Z'){
                        $val['year'] .= '-综合改革';
                    }
                }
                $scoreList[] = $val;
            }
            unset($score_temp);
            //根据年份从小到大排序
            $last_years = array_column($scoreList,'year');
            array_multisort($last_years,SORT_ASC,$scoreList);
            
            foreach ($scoreList as $key => $value) {
                if ($value['year'] != null){
                    $array['year'][]=$value['year'];
                    $array['topScore'][]=$value['topscore'];
                    $array['lowScore'][]=$value['lowscore'];
                    $array['aveScore'][]=$value['avescore'];
                }
            }
            $data['msg'] = '1'; //成功
            $data['scoreList'] = $array;
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        }else{
            $data['msg'] = '2';//无数据
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        }


    }

    /**
     * 根据省内批次查询，返回对应历年分数
     */
    public function chartsByPc()
    {
        $jsonp = htmlspecialchars($_GET["callback"]);
        if((!isset($_GET['province']) || empty($_GET['province'])) || (!isset($_GET['pcdm']) || empty($_GET['pcdm']))) {
            $data['msg'] = '3';
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        }
        $year = $_GET['year'];
        if (!$year){
            if($this->checkCurrentData('score') == 1){
                $yearArr[0] =date('Y');
                $yearArr[1] =date('Y') - 1;
                $yearArr[2] =date('Y') - 2;
            }else{
                $yearArr[0] =date('Y') - 1;
                $yearArr[1] =date('Y') - 2;
                $yearArr[2] =date('Y') - 3;
            }
        }else{
            $yearArr = explode(',', $year);
            foreach ($yearArr as $key => $val) {
                if ($val == '') {
                    unset($yearArr[$key]);
                }
            }
            //$yearArr[0] = $year;
            //$yearArr[1] = $year - 1;
            //$yearArr[2] = $year - 2;
        }
        $provinceid = dHtml(htmlCv($_GET['province']));
        $pcdm = dHtml(htmlCv($_GET['pcdm']));
        $where = array();
        $provinceid && $where['province'] = array('eq',$provinceid);
        $pcdm != '' && $where['pcdm'] = array('eq',$pcdm);

        $tddwList = M('CorrectTddw')->select();
        foreach ($tddwList as $k=>$v){
            $tddwArr[$v['year'].'-'.$v['provinceid'].'-'.$v['tddw']] = $v['kldm'];
        }
        $ckldmList = M('CorrectKldm')->select();
        foreach ($ckldmList as $k=>$v){
            if (in_array($v['status'],[3,2])){ //统计列表或全部时
                $ckldmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['kldm_origin']] = $v['kldm'];
            }
        }


//        //查询计划库中的tddw--用来区分部分省份(例如：广西)的文理综合
//        $tddw = M('TJhk')->where('year',array('eq',$yearArr))->field('tddw,zydh')->select();
//        $tddw_new = array();
//        foreach ($tddw as $key => $val) {
//            $tddw_new[$val['zydh']] = $val['tddw'];
//        }
//        unset($tddw);


        for ($i=0;$i<count($yearArr);$i++){
            $fileName = 'Score_pc'.$yearArr[$i];
            $db_name = C('DB_PREFIX').strtolower($fileName);
            $Model = new \Think\Model();
            $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
            if ($m){
                $dao = D($fileName);
                $where['year'] = array('in',$yearArr);
                $scoreList[] = $dao->where($where)->field('kldm,year,topScore,lowScore,aveScore')->select();
            }
        }
        if (false != $scoreList){
            //降维
            $score_temp = array();
            foreach ($scoreList as $key => $val) {
                $score_temp = array_merge($score_temp,$val);
            }
            //为年份添加上科类
            $scoreList = array();
            foreach ($score_temp as $key => $val) {
                if($provinceid == 32){
                    if ($val['kldm'] == 2){
                        $val['year'] .= '--理';
                    }elseif($val['kldm'] == 1){
                        $val['year'] .= '--文';
                    }
                }else{
//                    $tddwkldm = $tddwArr[$val['year'].'-'.$val['province'].'-'.$tddw_new[$val['lqzy']]];
//                    $val['kldm'] = $tddwkldm?$tddwkldm:$val['kldm'];//纠正个别省份科类文理综合分文理

                    $xnkldm = $ckldmArr[$val['year'].'-'.$val['province'].'-'.$val['kldm']];
                    $lastList[$key]['kldm'] = ($xnkldm!='')?$xnkldm: $val['kldm']; //纠正个别省份科类代码
                    if ($val['kldm'] == 5){
                        $val['year'] .= '-理';
                    }elseif($val['kldm'] == 1){
                        $val['year'] .= '-文';
                    }elseif($val['kldm'] == '0'){
                        $val['year'] .= '-文理综合';
                    }elseif($val['kldm'] == 'Z'){
                        $val['year'] .= '-综合改革';
                    }
                }
                $scoreList[] = $val;
            }
            unset($score_temp);
            //根据年份从小到大排序
            $last_years = array_column($scoreList,'year');
            array_multisort($last_years,SORT_ASC,$scoreList);

            foreach ($scoreList as $key => $value) {
                if ($value['year'] != null){
                    $array['year'][]=$value['year'];
                    $array['topScore'][]=$value['topscore'];
                    $array['lowScore'][]=$value['lowscore'];
                    $array['aveScore'][]=$value['avescore'];
                }
            }
            $data['msg'] = '1'; //成功
            $data['scoreList'] = $array;
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        }else{
            $data['msg'] = '2';//无数据
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        }


    }


    /**
     * 根据接收到的年份、省份、批次、科类、专业代码等参数获取对应历年分数
     */
    /*public function getScore(){
        $random =intval($_GET['random']);
        $timestamp = intval($_GET['current']);

        $id = intval($_GET['categoryId']);
        $province =dHtml(htmlCv($_GET['province']));
        $year1 = intval($_GET['year1']);
        $year2 = intval($_GET['year2']);
        $year3 = intval($_GET['year3']);
        $zydm = dHtml(htmlCv($_GET['zydm']));

        $appidGet = dHtml(htmlCv($_GET['appid']));
        $mapAppid['appid'] = $appidGet;
        $appsecretGet = M('Proof')->where($mapAppid)->getField('appsecret');
        $signCheck = md5($random.$timestamp.$id.$province.$year1.$year2.$year3.$zydm.$appsecretGet);
        $sign = md5(dHtml(htmlCv($_GET['sign'])));
        if ($sign === $signCheck){
            $now = time();
            if (($now - $timestamp) > 600){ //十分钟
                $data["msg"]="0"; //超时验证失败
                echo json_encode($data);
                exit;
            }else{
                if($year1 || $year2 || $year3){
                    $year_s_arr = array($year1,$year2,$year3);
                }else{
                    $year_s_arr = '';
                }
                if (!$year_s_arr){
                    $yearArr[0] =date('Y') - 1;
                    $yearArr[1] =date('Y') - 2;
                    $yearArr[2] =date('Y') - 3;

                    for ($i=0;$i<count($yearArr);$i++){
                        $fileName = 'Score'.$yearArr[$i];
                        $db_name = C('DB_PREFIX').strtolower($fileName);
                        $Model = new \Think\Model();
                        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
                        if($m){
                            $dao = D($fileName);
                            $provinceList = M('Province')->select();
                            foreach ($provinceList as $k=>$v){
                                $provinceArr[$v['id']]['id'] = $v['id'];
                                $provinceArr[$v['id']]['name'] = $v['name'];
                            }
                            $condition = array();
                            $province && $condition['province'] = array('eq', $province);
                            if (strlen($zydm) == 4){ //部分专业合并为大类，查询时均查出
                                $mapZy = array();
                                $mapZy['zydm'] = array('like',$zydm.'%');
                                $tempZydm = M('Zy')->where($mapZy)->field('zydm')->select();
                                $zydm && $condition['queryzydm'] = array('in', array_column($tempZydm,'zydm'));
                            }else{
                                if (strpos($zydm,'-') !== false){
                                    $zydmArr = explode('-',$zydm);
                                    switch($zydmArr[1]){
                                        case '机场指挥':$lqzy =  substr($yearArr[$i],-2).$province.'Z016';break;
                                        case '通航综合航务':$lqzy =  substr($yearArr[$i],-2).$province.'Z022';break;
                                        case '地面服务':$lqzy =  substr($yearArr[$i],-2).$province.'Z030';break;
                                    }
                                    $lqzy && $condition['lqzy'] = array('eq', $lqzy);
                                }else{
                                    $zydm && $condition['queryzydm'] = array('eq', $zydm);
                                }
                            }
                            $scoreList[] = $dao->where($condition)->order('id desc')->select();
                        }
                    }

                    //三维数组转二维数组
                    foreach($scoreList as $value){
                        foreach($value as $v){
                            $lastList[]=$v;
                        }
                    }
                    //销毁$arr3
                    unset($scoreList,$value,$v);
                }else{
                    for ($i=0;$i<count($year_s_arr);$i++){
                        $fileName = 'Score'.$year_s_arr[$i];
                        $db_name = C('DB_PREFIX').strtolower($fileName);
                        $Model = new \Think\Model();
                        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
                        if($m){
                            $dao = D($fileName);
                            $provinceList = M('Province')->select();
                            foreach ($provinceList as $k=>$v){
                                $provinceArr[$v['id']]['id'] = $v['id'];
                                $provinceArr[$v['id']]['name'] = $v['name'];
                            }
                            $condition = array();
                            $condition['province'] = array('eq', $province);
                            $zydm && $condition['queryzydm'] = array('eq',$zydm);
                            if (strlen($zydm) == 4){ //部分专业合并为大类，查询时均查出
                                $mapZy = array();
                                $mapZy['zydm'] = array('like',$zydm.'%');
                                $tempZydm = M('Zy')->where($mapZy)->field('zydm')->select();
                                $zydm && $condition['queryzydm'] = array('in', array_column($tempZydm,'zydm'));
                            }else{
                                if (strpos($zydm,'-') !== false){
                                    $zydmArr = explode('-',$zydm);
                                    switch($zydmArr[1]){
                                        case '机场指挥':$lqzy =  substr($yearArr[$i],-2).$province.'Z016';break;
                                        case '通航综合航务':$lqzy =  substr($yearArr[$i],-2).$province.'Z022';break;
                                        case '地面服务':$lqzy =  substr($yearArr[$i],-2).$province.'Z030';break;
                                    }
                                    $lqzy && $condition['lqzy'] = array('eq', $lqzy);
                                }else{
                                    $zydm && $condition['queryzydm'] = array('eq', $zydm);
                                }
                            }
                            $lastList[] = $dao->where($condition)->order('id desc')->select();
                        }
                    }

                    $fileName = 'Score'.$year;
                    $db_name = C('DB_PREFIX').strtolower($fileName);
                    $Model = new \Think\Model();
                    $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
                    if($m){
                        $dao = D($fileName);
                        $provinceList = M('Province')->select();
                        foreach ($provinceList as $k=>$v){
                            $provinceArr[$v['id']]['id'] = $v['id'];
                            $provinceArr[$v['id']]['name'] = $v['name'];
                        }
                        $condition = array();
                        $province && $condition['province'] = array('eq', $province);

                        if (strlen($zydm) == 4){ //部分专业合并为大类，查询时均查出
                            $mapZy['zydm'] = array('like',$zydm.'%');
                            $tempZydm = M('Zy')->where($mapZy)->field('zydm')->select();
                            $zydm && $condition['queryzydm'] = array('in', array_column($tempZydm,'zydm'));
                        }else{
                            if (strpos($zydm,'-') !== false){
                                $zydmArr = explode('-',$zydm);
                                switch($zydmArr[1]){
                                    case '机场指挥':$lqzy =  substr($year,-2).$province.'Z016';break;
                                    case '通航综合航务':$lqzy =  substr($year,-2).$province.'Z022';break;
                                    case '地面服务':$lqzy =  substr($year,-2).$province.'Z030';break;
                                }
                                $lqzy && $condition['lqzy'] = array('eq', $lqzy);
                            }else{
                                $zydm && $condition['queryzydm'] = array('eq', $zydm);
                            }
                        }
                        $lastList = $dao->where($condition)->order('id desc')->select();
                    }
                }
                if (false != $lastList) {
                    $result = [];
                    foreach ($lastList as $key => $val) {
                        foreach ($val as $key1=>$val1){
                            $result[$key1] = $val1;
                            $major = $val1['lqzy'];
                            $result[$key1]['pname'] = $provinceArr[$val1['province']]['name'];
                            $result[$key1]['pcname'] = M('Pc')->where('dm=' . $val1['pc'])->getField('pc');
                            $result[$key1]['tname'] = M('Kl')->where('kldm=' . "'".$val1['kldm']."'")->getField('klmc');

                            $zy = M('tJhk')->where('year='.$val1['year'].' AND provinceid='.$val1['province']." AND zydh='$major'")->field('zydm,zymc')->find();
                            preg_match_all("/(?:<)(.*)(?:>)/i",correctZyname($zy,$val1['province']), $final_zy);
                            echo json_encode($final_zy);
                            exit;
                            $result[$key1]['zyname'] = '';
                            $result[$key1]['zyfx'] = '';
                        }
                    }

                    $data["msg"] = "1"; //状态码
                    $data['info'] = $result; //计划列表
                    $mapRemark['category_id'] = $id;
                    //$mapRemark['year'] = $year;
                    $remark = M('Remark')->where($mapRemark)->getField('content');
                    $data['remark'] = $remark;
                    echo json_encode($data);
                    exit;
                }else{
                    $data["msg"] = "2"; //暂无数据
                    echo json_encode($data);
                    exit;
                }
            }
        }else{
            $data["msg"]="3"; //sign验证失败
            echo json_encode($data);
            exit;
        }
    }*/

    /**
     * 根据年份省份，返回对应历年分数
     */
    /*public function charts()
    {
        $jsonp = htmlspecialchars($_GET["callback"]);
        if((!isset($_GET['province']) || empty($_GET['province'])) || (!isset($_GET['zydm']) || empty($_GET['zydm']))) {
            $data['msg'] = '3';
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        }
        $year = intval($_GET['year']);
        if (!$year){
            if (date('m') < 6) {
                $yearArr[0] =date('Y') - 1;
                $yearArr[1] =date('Y') - 2;
                $yearArr[2] =date('Y') - 3;
            }else{
                $yearArr[0] =date('Y');
                $yearArr[1] =date('Y') - 1;
                $yearArr[2] =date('Y') - 2;
            }
        }else{
            $yearArr[0] = $year;
            $yearArr[1] = $year - 1;
            $yearArr[2] = $year - 2;
        }
        $provinceid = dHtml(htmlCv($_GET['province']));
        $pcdm = dHtml(htmlCv($_GET['pcdm']));
        $kldm = dHtml(htmlCv($_GET['kldm']));
        $zydm = dHtml(htmlCv($_GET['zydm']));
        $where = array();
        $provinceid && $where['province'] = array('eq',$provinceid);
        $pcdm && $where['pc'] = array('eq',$pcdm);
        ($kldm!='') && $where['kldm'] = array('eq',$kldm);

        for ($i=0;$i<2;$i++){
            $fileName = 'Score'.$yearArr[$i];
            $db_name = C('DB_PREFIX').strtolower($fileName);
            $Model = new \Think\Model();
            $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
            if ($m){
                $dao = D($fileName);
                if (strpos($zydm,'-') !== false){
                    $zydmArr = explode('-',$zydm);
                    switch($zydmArr[1]){
                        case '机场指挥':$lqzy =  substr($yearArr[$i],-2).$provinceid.'Z016';break;
                        case '通航综合航务':$lqzy =  substr($yearArr[$i],-2).$provinceid.'Z022';break;
                        case '地面服务':$lqzy =  substr($yearArr[$i],-2).$provinceid.'Z030';break;
                    }
                    $where['lqzy'] = array('eq', $lqzy);
                }else{
                    $where['queryzydm'] = array('eq', $zydm);
                }
                $scoreList[] = $dao->where($where)->field('year,topScore,lowScore,aveScore')->find();
            }
        }
        foreach ($scoreList as $key => $value) {
            if ($value['year'] != null){
                $array['year'][]=$value['year'];
                $array['topScore'][]=$value['topscore'];
                $array['lowScore'][]=$value['lowscore'];
                $array['aveScore'][]=$value['avescore'];
            }
        }
        if (false != $scoreList){
            $data['msg'] = '1'; //成功
            $data['scoreList'] = $array;
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        }else{
            $data['msg'] = '2';//无数据
            if (!empty($jsonp)){
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        }


    }*/
//    public function charts()
//    {
//        $jsonp = htmlspecialchars($_GET["callback"]);
//        if((!isset($_GET['province']) || empty($_GET['province'])) || (!isset($_GET['zydm']) || empty($_GET['zydm']))) {
//            $data['msg'] = '3';
//            if (!empty($jsonp)){
//                echo $jsonp."(".json_encode($data).")";
//                exit;
//            }
//        }
//        $year = intval($_GET['year']);
//        if (!$year){
//            if (date('m') < 6) {
//                $year =date('Y') - 1;
//                $year1 =date('Y') - 2;
//                $year2 =date('Y') - 3;
//            }else{
//                $year =date('Y');
//                $year1 =date('Y') - 1;
//                $year2 =date('Y') - 2;
//            }
//        }else{
//            $year1 =$year - 1;
//            $year2 =$year - 2;
//        }
//
//        $fileName = 'Score'.$year;
//        $db_name = C('DB_PREFIX').strtolower($fileName);
//        $Model = new \Think\Model();
//        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
//        if(!$m){
//            $data["msg"]="2"; //暂无数据
//            echo json_encode($data);
//            exit;
//        }else {
//            $dao = D($fileName);
//            for ($i=0;$i<2;$i++){
//                $fileName1 = 'Score'.$year1;
//                $fileName2 = 'Score'.$year2;
//                $db_name1 = C('DB_PREFIX').strtolower($fileName1);
//                $db_name2 = C('DB_PREFIX').strtolower($fileName2);
//                $m1 = $Model->query("SHOW TABLES LIKE '%$db_name1%'");
//                $m2 = $Model->query("SHOW TABLES LIKE '%$db_name2%'");
//
//                $provinceid = dHtml(htmlCv($_GET['province']));
//                $pcdm = dHtml(htmlCv($_GET['pcdm']));
//                $kldm = dHtml(htmlCv($_GET['kldm']));
//                $zydm = dHtml(htmlCv($_GET['zydm']));
//                $where = array();
//                $provinceid && $where['province'] = array('eq',$provinceid);
//                $pcdm && $where['pc'] = array('eq',$pcdm);
//                ($kldm!='') && $where['kldm'] = array('eq',$kldm);
//
//                if (strpos($zydm,'-') !== false){
//                    $zydmArr = explode('-',$zydm);
//                    switch($zydmArr[1]){
//                        case '机场指挥':$lqzy =  substr($year,-2).$provinceid.'Z016';break;
//                        case '通航综合航务':$lqzy =  substr($year,-2).$provinceid.'Z022';break;
//                        case '地面服务':$lqzy =  substr($year,-2).$provinceid.'Z030';break;
//                    }
//                    $where['lqzy'] = array('eq', $lqzy);
//                }else{
//                    $where['queryzydm'] = array('eq', $zydm);
//                }
//
//                $scoreList = $dao->where($where)->field('year,topScore,lowScore,aveScore')->find();
//                if ($m1){
//                    $daoPrev = D($fileName1);
//                    $scoreListPrev = $daoPrev->where($where)->field('year,topScore,lowScore,aveScore')->find();
//                }
//                if ($m2){
//                    $daoPrev1 = D($fileName2);
//                    $scoreListPrev1 = $daoPrev1->where($where)->field('year,topScore,lowScore,aveScore')->find();
//                }
//            }
//            $fileName1 = 'Score'.$year1;
//            $fileName2 = 'Score'.$year2;
//            $db_name1 = C('DB_PREFIX').strtolower($fileName1);
//            $db_name2 = C('DB_PREFIX').strtolower($fileName2);
//            $m1 = $Model->query("SHOW TABLES LIKE '%$db_name1%'");
//            $m2 = $Model->query("SHOW TABLES LIKE '%$db_name2%'");
//
//            $provinceid = dHtml(htmlCv($_GET['province']));
//            $pcdm = dHtml(htmlCv($_GET['pcdm']));
//            $kldm = dHtml(htmlCv($_GET['kldm']));
//            $zydm = dHtml(htmlCv($_GET['zydm']));
//            $where = array();
//            $provinceid && $where['province'] = array('eq',$provinceid);
//            $pcdm && $where['pc'] = array('eq',$pcdm);
//            ($kldm!='') && $where['kldm'] = array('eq',$kldm);
//
//            if (strpos($zydm,'-') !== false){
//                $zydmArr = explode('-',$zydm);
//                switch($zydmArr[1]){
//                    case '机场指挥':$lqzy =  substr($year,-2).$provinceid.'Z016';break;
//                    case '通航综合航务':$lqzy =  substr($year,-2).$provinceid.'Z022';break;
//                    case '地面服务':$lqzy =  substr($year,-2).$provinceid.'Z030';break;
//                }
//                $where['lqzy'] = array('eq', $lqzy);
//            }else{
//                $where['queryzydm'] = array('eq', $zydm);
//            }
//
//            $scoreList = $dao->where($where)->field('year,topScore,lowScore,aveScore')->find();
//            if ($m1){
//                $daoPrev = D($fileName1);
//                $scoreListPrev = $daoPrev->where($where)->field('year,topScore,lowScore,aveScore')->find();
//            }
//            if ($m2){
//                $daoPrev1 = D($fileName2);
//                $scoreListPrev1 = $daoPrev1->where($where)->field('year,topScore,lowScore,aveScore')->find();
//            }
//            $union[0] = $scoreListPrev1;
//            $union[1] = $scoreListPrev;
//            $union[2] = $scoreList;
//            foreach ($union as $key => $value) {
//                if ($value['year'] != null){
//                    $array['year'][]=$value['year'];
//                    $array['topScore'][]=$value['topscore'];
//                    $array['lowScore'][]=$value['lowscore'];
//                    $array['aveScore'][]=$value['avescore'];
//                }
//            }
//            if (false != $scoreList){
//                $data['msg'] = '1'; //成功
//                $data['scoreList'] = $array;
//                if (!empty($jsonp)){
//                    echo $jsonp."(".json_encode($data).")";
//                    exit;
//                }
//
//            }else{
//                $data['msg'] = '2';//无数据
//                if (!empty($jsonp)){
//                    echo $jsonp."(".json_encode($data).")";
//                    exit;
//                }
//            }
//
//        }
//    }

    /**
     * 接收选考科目查询参数，返回查询结果
     *
     */
    public function getSubject()
    {
        $dao = M('Subject');
        $random =intval($_GET['random']);
        $timestamp = intval($_GET['current']);

        $id = intval($_GET['categoryId']);
        $province = dHtml(htmlCv($_GET['province']));
        $year = intval($_GET['year']);

        $appidGet = dHtml(htmlCv($_GET['appid']));
        $mapAppid['appid'] = $appidGet;
        $appsecretGet = M('Proof')->where($mapAppid)->getField('appsecret');
        $signCheck = md5($random.$timestamp.$id.$province.$year.$appsecretGet);

        $sign = md5(dHtml(htmlCv($_GET['sign'])));
        if ($sign === $signCheck){
            $now = time();
            if (($now - $timestamp) > 600){ //十分钟
                $data["msg"]="0"; //超时验证失败
                echo json_encode($data);
                exit;
            }else{
                $condition = array();
                $province && $condition['province'] = array('eq',$province);
                $year && $condition['year'] = array('eq',$year);
                $count = $dao->where($condition)->count();

                $page = intval($_GET['p']);//获取前台传过来的页码
                $pageSize=20;  //设置每页显示的条数
                $start=($page-1)*20; //从第几条开始取记录
                $totalPage = ceil($count / $pageSize); //总页数
                $subjectList = $dao->where($condition)->order('year desc,province desc,id desc')->Limit($start.','.$pageSize)->select();
                if (false != $subjectList){
                    $data["msg"]="1"; //状态码
                    $data['total'] = $totalPage; //总页数
                    $data['info'] = $subjectList; //计划列表
                    $data['count'] = $count; //记录数
                    $mapRemark['category_id'] = $id;
                    $remark = M('Remark')->where($mapRemark)->getField('content');
                    $data['remark'] = $remark; //备注
                    echo json_encode($data);
                    exit;
                }else{
                    $data["msg"]="2"; //暂无数据
                    echo json_encode($data);
                    exit;
                }
            }
        }else{
            $data["msg"]="3"; //sign验证失败
            echo json_encode($data);
            exit;
        }
    }

    /**
     * 实时发布当年分数
     */
    public function getMark()
    {
        $jsonp = htmlspecialchars($_GET["callback"]);
        if (!empty($jsonp)){
            $year = date('Y');
            $where = array();
            $where['a.year'] = array('eq',$year);
            $scoreList = M('Score')->Table(C('DB_PREFIX').'score a')->Join(C('DB_PREFIX').'t_jhk b on b.zydh=a.lqzy')->Field("a.*,b.zymc")->order('a.province asc')->where($where)->select();
            if (false != $scoreList){
                $data['msg'] = '1';
                $data['info'] = $scoreList;
                echo $jsonp."(".json_encode($data).")";
                exit;
            }else{
                $data['msg'] = '2';
                $data['info'] = '';
                echo $jsonp."(".json_encode($data).")";
                exit;
            }
        }else{
            $data['msg'] = '3';
            echo $jsonp."(".json_encode($data).")";
            exit;
        }
    }

    /**
     * 获取专业一览
     *
     */
    public function getTarget()
    {
        set_time_limit(60);
        $random =intval($_GET['random']);
        $timestamp = intval($_GET['current']);

        $mouth = date('m');
        if ($mouth < 6){
            $currentyear = date('Y') - 1;
        }else{
            $currentyear = date('Y');
        }
        for ($i=0;$i<20;$i++){
            $cateyear = $currentyear - $i;
            $fileName = 'Plan'.($currentyear - $i);
            $db_name = C('DB_PREFIX').strtolower($fileName);
            $Model = new \Think\Model();
            $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
            if($m){break;}
        }
        $id = intval($_GET['categoryId']);
        $dao = D($fileName);

        $appidGet = dHtml(htmlCv($_GET['appid']));
        $mapAppid['appid'] = $appidGet;
        $appsecretGet = M('Proof')->where($mapAppid)->getField('appsecret');
        $signCheck = md5($random.$timestamp.$id.$appsecretGet);

        $sign = md5(dHtml(htmlCv($_GET['sign'])));
        if ($sign === $signCheck){
            $now = time();
            if (($now - $timestamp) > 600){ //十分钟
                $data["msg"]="0"; //超时验证失败
                echo json_encode($data);
                exit;
            }else{
                $collegeList = M('Zy')->field('zydm,college')->select();
                foreach ($collegeList as $k=>$v){
                    $collegeArr[$v['zydm']]['zydm'] = $v['zydm'];
                    $collegeArr[$v['zydm']]['college'] = $v['college'];
                }
                $college = M('College')->select();
                foreach ($college as $k=>$v){
                    $collegeTrueArr[$v['cid']]['cid'] = $v['cid'];
                    $collegeTrueArr[$v['cid']]['name'] = $v['name'];
                }
                $planList = $dao->field('id,zydm,zymc,zyfx,kldm,klmc,target,fee,xz,demand,achieve')->order('zydm asc')->select();
                foreach ($planList as $k=>$v){
                    $kldm[] = $v['kldm'];
                    $zydm[] = $v['zydm'];
                    $zyfx[] = $v['zyfx'];
                    $target[] = $v['target'];
                    if ($v['kldm'] == ''){
                        $planList[$k]['klmc'] = '预留计划';
                    }
                }
                for ($i=0;$i<count($planList);$i++){
                    $planList[$i]['check'] = $kldm[$i].$zydm[$i].$zyfx[$i];
                    $planList[$i]['college'] = $collegeTrueArr[$collegeArr[$zydm[$i]]['college']]['name'];
                    for ($j=0;$j<count($planList);$j++){
                        if ($kldm[$i] == $kldm[$j] && $zydm[$i] == $zydm[$j] && $zyfx[$i] == $zyfx[$j]){
                            $planList[$i]['total'] += $target[$j];
                        }
                    }
                }
                $res = array();
                foreach ($planList as $value) { //根据kldm、zydm及zyfx去重
                    if(isset($res[$value['check']])){
                        unset($value['check']);
                    }else{
                        $res[$value['check']] = $value;
                    }
                }

                //考虑计划调整
                $mapAdjust = array();
                $mapAdjust['year'] = array('eq',$cateyear);
                $mapAdjust['status'] = array('eq',2);
                $adjustArr = M('Adjust')->where($mapAdjust)->field('source,direction,number')->select();

                $sid = $did = array();
                foreach ($adjustArr as $k=>$v){
                    $source = explode(',',$v['source']);
                    $sid[$source[6]]['number'] += -$v['number'];
                    $direction = explode(',',$v['direction']);
                    $did[$direction[6]]['number'] += $v['number'];
                }
                foreach ($res as $k=>$v){
                    if ($sid[$v['id']]['number']){
                        $res[$k]['total'] = $v['total'] + $sid[$v['id']]['number'];
                    }
                    if ($did[$v['id']]['number']){
                        $res[$k]['total'] = $v['total'] + $did[$v['id']]['number'];
                    }
                }

                //按学院排序
                $sort = array(
                    'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
                    'field'     => 'zydm',       //排序字段
                );
                $arrSort = array();
                foreach($res AS $uniqid => $row){
                    foreach($row AS $key=>$value){
                        $arrSort[$key][$uniqid] = $value;
                    }
                }
                if($sort['direction']){
                    array_multisort($arrSort[$sort['field']], constant($sort['direction']), $res);
                }
                foreach ($res as $k=>$v){
                    if ($v['kldm'] == ''){
                        unset($res[$k]);
                    }
                }
                if (false != $res){
                    $data["msg"]="1"; //状态码
                    $data['info'] = $res; //计划列表
                    $mapRemark = array();
                    $mapRemark['category_id'] = array('eq',$id);
                    $mapRemark['year'] = array('eq',$cateyear);
                    $remark = M('Remark')->where($mapRemark)->getField('content');
                    $data['remark'] = $remark;
                    echo json_encode($data);
                    exit;
                }else{
                    $data["msg"]="2"; //暂无数据
                    echo json_encode($data);
                    exit;
                }
            }
        }else{
            $data["msg"]="3"; //sign验证失败
            echo json_encode($data);
            exit;
        }
    }

    /**
     * 接收考生查询参数，返回结果
     *
     */
    public function getAdmission()
    {
        $random = intval($_POST['random']);
        $timestamp = intval($_POST['current']);
        $id = intval($_POST['categoryId']);
        $ksh = dHtml(htmlCv($_POST['ksh']));
        $sfzh = dHtml(htmlCv($_POST['sfzh']));


        $currentyear = date('Y');

        if ($ksh || $sfzh){
            if ($ksh == ''){
                $data["msg"]="20";
                echo json_encode($data);
                exit;
            }
            if (!in_array(strlen($ksh),array(10,14))){
                $data["msg"]="50";
                echo json_encode($data);
                exit;
            }
            if ($sfzh == ''){
                $data["msg"]="30";
                echo json_encode($data);
                exit;
            }
            if (!idcard_check($sfzh)){
                $data["msg"]="40";
                echo json_encode($data);
                exit;
            }
            $fileName = 'result'.$currentyear;
            $filename = strtolower($fileName);
            $db_name = C('DB_PREFIX').strtolower($fileName);
            $Model = new \Think\Model();
            $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");

            $fileName1 = 't_tdd_final'.$currentyear;
            $db_name1 = C('DB_PREFIX').strtolower($fileName1);
            $m1 = $Model->query("SHOW TABLES LIKE '%$db_name1%'");
            if(!$m || !$m1){
                $data["msg"]="2"; //暂无数据
                echo json_encode($data);
                exit;
            }else {
                $dao = D($fileName);
                $daoFinal = D($fileName1);
                $appidGet = dHtml(htmlCv($_POST['appid']));
                $mapAppid['appid'] = $appidGet;
                $appsecretGet = M('Proof')->where($mapAppid)->getField('appsecret');
                $signCheck = md5($random . $timestamp . $id . $ksh . $sfzh . $appsecretGet);

                $sign = md5(dHtml(htmlCv($_POST['sign'])));
                if ($sign === $signCheck) {
                    $now = time();
                    if (($now - $timestamp) > 600) { //十分钟
                        $data["msg"] = "4"; //超时验证失败
                        echo json_encode($data);
                        exit;
                    } else {
                        $condition = array();
                        $condition['ksh'] = array('eq', $ksh);
                        $condition['sfzh'] = array('eq', $sfzh);

                        $info = $dao->field('xm,ksh,sfzh,xb,lqzy,province,mdh')->where($condition)->find();

                        if (false != $info) {
                            $thisPc = $daoFinal->where($condition)->getField('pc');
                            $info['provinceid'] =  $daoFinal->where($condition)->getField('provinceid');
                            $progressStatus = M('ProgressStatus')->where('year = '.$currentyear . ' and provinceid = '.$info['provinceid'] . ' and pc = '.$thisPc)->getField('status');
                            $progressStatus = intval($progressStatus);
                            if ($progressStatus == 2) {
                                $info['provinceid'] = M('Province')->where('name = ' . "'" . $info['province'] . "'")->getField('id');
                                //考生照片路径
                                $globalConfig = getContent('cms.config.php', '.');
                                $url = trim($globalConfig['picture_url']);
                                $duoyu = strlen(substr($url, 0, strrpos($url, 'kszp')));
                                $trueUrl = substr($url, $duoyu);
                                $appHost = empty($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : $_SERVER['HTTP_HOST'];
                                if ($info['provinceid'] == 44) { //广东十位考生号前拼上年份后两位及省份id
                                    $info['path'] = 'http://www.cauc.edu.cn/lqgl' . '/' . $trueUrl . $currentyear . '/' . $info['provinceid'] . '/' . substr($currentyear, 2, 2) . $info['provinceid'] . $info['ksh'] . '.jpg';
                                    $checkKsh = substr($currentyear, 2, 2) . $info['provinceid'] . $info['ksh'];
                                } else {
                                    $info['path'] = 'http://www.cauc.edu.cn/lqgl' . '/' . $trueUrl . $currentyear . '/' . $info['provinceid'] . '/' . $info['ksh'] . '.jpg';
                                    $checkKsh = $info['ksh'];
                                }

                                $path = $url . $currentyear . '/' . $info['provinceid'] . '/';
                                $path = substr($path, 1);
                                if (is_dir($path)) {
                                    $filearr = scandir("$path");
                                }
                                for ($i = 0; $i < count($filearr); $i++) {
                                    $filearr[$i] = strtolower($filearr[$i]);
                                }

                                if (!in_array($checkKsh . '.jpg', $filearr)) {
                                    $data["isimg"] = "2"; //考生照片不在
                                } else {
                                    $data["isimg"] = "1"; //考生照片在
                                }
                                $data["msg"] = "1"; //考生照片不在
                                $data['info'] = $info; //计划列表
                                echo json_encode($data);
                                exit;
                            }else {
                                $data["msg"] = "2"; //暂无数据
                                echo json_encode($data);
                                exit;
                            }
                        } else {
                            $data["msg"] = "2"; //暂无数据
                            echo json_encode($data);
                            exit;
                        }
                    }
                } else {
                    $data["msg"] = "3"; //sign验证失败
                    echo json_encode($data);
                    exit;
                }
            }
        }else{
            $appidGet = dHtml(htmlCv($_POST['appid']));
            $mapAppid['appid'] = $appidGet;
            $appsecretGet = M('Proof')->where($mapAppid)->getField('appsecret');
            $signCheck = md5($random.$timestamp.$id.$appsecretGet);

            $sign = md5(dHtml(htmlCv($_POST['sign'])));
            if ($sign === $signCheck){
                $now = time();
                if (($now - $timestamp) > 600){ //十分钟
                    $data["msg"]="4"; //超时验证失败
                    echo json_encode($data);
                    exit;
                }else{
                    /*$mapProgressStatus['year'] = $currentyear;
                    $statusList = M('ProgressStatus')->Table(C('DB_PREFIX').'progress_status a')->join(C('DB_PREFIX').'province b on a.provinceid = b.id')->where($mapProgressStatus)->field('a.*,b.name as pname')->select();
                    if (false != $statusList){
                        $finalShow = [];
                        foreach ($statusList as $k=>$v){
                            $finalShow[$v['provinceid']][0] = $v['pname'];
                            $finalShow[$v['provinceid']][$v['pc']] = $v['status'];
                        }
                    }else{
                        $mapProgressStatus['year'] = $currentyear-1;
                        $statusList = M('ProgressStatus')->Table(C('DB_PREFIX').'progress_status a')->join(C('DB_PREFIX').'province b on a.provinceid = b.id')->where($mapProgressStatus)->field('a.*,b.name as pname')->select();
                        $finalShow = [];
                        foreach ($statusList as $k=>$v){
                            $finalShow[$v['provinceid']][0] = $v['pname'];
                            $finalShow[$v['provinceid']][$v['pc']] = $v['status'];
                        }
                    }*/
					$noAllowPcList = M('Pc')->where('isprogress != 1')->select();
                    $noAllowPc = array_column($noAllowPcList,'id');
                    $mapProgressStatus = [];
                    $mapProgressStatus['year'] = $currentyear;
                    $mapProgressStatus['pc'] = array('not in',$noAllowPc);
                    $statusList = M('ProgressStatus')->Table(C('DB_PREFIX').'progress_status a')->join(C('DB_PREFIX').'province b on a.provinceid = b.id')->where($mapProgressStatus)->field('a.*,b.name as pname')->select();
                    if (false != $statusList){
                        $finalShow = [];
                        foreach ($statusList as $k=>$v){
                            $finalShow[$v['provinceid']][0] = $v['pname'];
                            $finalShow[$v['provinceid']][$v['pc']] = $v['status'];
                        }
                    }else{
                        $mapProgressStatus['year'] = $currentyear-1;
                        $statusList = M('ProgressStatus')->Table(C('DB_PREFIX').'progress_status a')->join(C('DB_PREFIX').'province b on a.provinceid = b.id')->where($mapProgressStatus)->field('a.*,b.name as pname')->select();
                        $finalShow = [];
                        foreach ($statusList as $k=>$v){
                            $finalShow[$v['provinceid']][0] = $v['pname'];
                            $finalShow[$v['provinceid']][$v['pc']] = $v['status'];
                        }
                    }

                    $pcList = M('Pc')->where('isprogress = 1')->select();
                    $data["year"]=$currentyear;
                    if (false != $finalShow){
                        if (false != $pcList){
                            $data["msg"]="1";
                            $data['info'] = $finalShow;
                            $data['pcList'] = $pcList;
                            echo json_encode($data);
                            exit;
                        }else{
                            $data["msg"]="progress2";
                            echo json_encode($data);
                            exit;
                        }
                    }else{
                        $data["msg"]="progress2"; //暂无数据
                        echo json_encode($data);
                        exit;
                    }
                }
            }else{
                $data["msg"]="progress2"; //sign验证失败
                echo json_encode($data);
                exit;
            }
        }
    }

}