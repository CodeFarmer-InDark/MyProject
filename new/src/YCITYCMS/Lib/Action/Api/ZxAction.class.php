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
//namespace Api\Controller;
//use Admin\Controller\EditfieldController;
//use Common\Controller\HomeBaseController;

class ZxAction extends HomeBaseAction
{
    public $dao;
    function _initialize()
    {
        parent::_initialize();
//        $allow_origin = array(
//            'http://www.cauc.edu.cn/zsb',
//            'http://localhost/cauc_zsb2/zsb',
//        );
        /*$allow_origin = 'http://www.cauc.edu.cn/zsb';
        header('Access-Control-Allow-Origin:'.$allow_origin);   // 指定允许其他域名访问
        header('Access-Control-Allow-Headers:x-requested-with,content-type');// 响应头设置
        header('Access-Control-Allow-Methods: GET, POST, PUT');*/
    }

    /**
     * 返回宣传系统前台录取人数查询数据
     * AdmissionData/index
     */
    public function getZxListForAdmission()
    {
        $province =dHtml(htmlCv($_POST['province']));
        $random =intval($_POST['random']);
        $timestamp = intval($_POST['current']);
        $dao = D('Zxdm');

        $appidGet = dHtml(htmlCv($_POST['appid']));
        $mapAppid['appid'] = $appidGet;
        $appsecretGet = M('Proof')->where($mapAppid)->getField('appsecret');
        $signCheck = md5($province.$random.$timestamp.$appsecretGet);

        $sign = md5(dHtml(htmlCv($_POST['sign'])));
        if ($sign === $signCheck){
            $now = time();
            if (($now - $timestamp) > 600){ //十分钟
                $data["msg"]="0"; //超时验证失败
                echo json_encode($data);
                exit;
            }else{
                $condition['zxdm'] = array('neq','');
                $condition['provinceid'] = array('in', explode(',',$province));
                $dataList = $dao->field('zxdm,zxmc,provinceid')->where($condition)->order('provinceid asc')->select();

                //最近三年中学录取人数
                for ($i=0;$i<3;$i++){
                    $fileName = 'T_tdd_final'.(date('Y')-$i);
                    $db_name = C('DB_PREFIX').strtolower($fileName);
                    $Model = new \Think\Model();
                    $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
                    if($m){
                        $daoTdd = D($fileName);
                        $tddList = $daoTdd->field('zxdm')->where("zxdm != ''")->select();
                        $tdd = [];
                        foreach ($tddList as $k=>$v){
                            $tdd[$v['zxdm']]++;
                        }
                        foreach ($dataList as $k=>$v){
                            $dataList[$k]['num'.$i] = $tdd[$v['zxdm']]?$tdd[$v['zxdm']]:0;
                        }
                    }else{
                        foreach ($dataList as $k=>$v){
                            $dataList[$k]['num'.$i] = 0;
                        }
                    }
                }
                if (false != $dataList){
                    $data["msg"]="1"; //状态码
                    $data['info'] = $dataList; //计划列表
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
     * 返回宣传系统录取人数查询专业人数分布
     * AdmissionData/detail
     */
    public function getZxDetailForAdmission()
    {
        $zxdm =dHtml(htmlCv($_POST['zxdm']));
        $year =intval($_POST['year']);
        $province =intval($_POST['province']);
        if ($zxdm == '' || !$year || $year == 0 || $province == 0 || !$province){
            $data["msg"]="2"; //暂无数据
            echo json_encode($data);
            exit;
        }else{
            $random =intval($_POST['random']);
            $timestamp = intval($_POST['current']);

            $appidGet = dHtml(htmlCv($_POST['appid']));
            $mapAppid['appid'] = $appidGet;
            $appsecretGet = M('Proof')->where($mapAppid)->getField('appsecret');
            $signCheck = md5($random.$timestamp.$appsecretGet);

            $sign = md5(dHtml(htmlCv($_POST['sign'])));
            if ($sign === $signCheck){
                $now = time();
                if (($now - $timestamp) > 600){ //十分钟
                    $data["msg"]="0"; //超时验证失败
                    echo json_encode($data);
                    exit;
                }else{
                    $fileName = 'T_tdd_final'.$year;
                    $db_name = C('DB_PREFIX').strtolower($fileName);
                    $Model = new \Think\Model();
                    $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
                    if($m){
                        $dao = D($fileName);
                        $condition['zxdm'] = array('eq',$zxdm);
                        $condition['provinceid'] = array('eq',$province);
                        $dataList = $dao->where($condition)->field('zxdm,zxmc,lqzy,year,provinceid')->select();
                        if (false != $dataList){
                            $final = [];
                            foreach ($dataList as $k=>$v){
                                $final[$v['lqzy']]['zy'] = $v;
                                $final[$v['lqzy']]['num']++;
                            }

                            $mapJhk['year'] = $year;
                            $mapJhk['provinceid'] = $province;
                            $zyArr = M('tJhk')->where($mapJhk)->field('year,provinceid,zydm,zymc,jhxz,zydh')->select();
                            $jhkArr = [];
                            foreach ($zyArr as $k=>$v){
                                $jhkArr[$year.'-'.$v['provinceid'].'-'.$v['zydh']]['zydm'] = $v['zydm'];
                                $jhkArr[$year.'-'.$v['provinceid'].'-'.$v['zydh']]['zymc'] = $v['zymc'];
                                $jhkArr[$year.'-'.$v['provinceid'].'-'.$v['zydh']]['jhxz'] = $v['jhxz'];
                                $jhkArr[$year.'-'.$v['provinceid'].'-'.$v['zydh']]['provinceid'] = $v['provinceid'];
                            }
                            foreach ($final as $k=>$v){
                                $zy = $jhkArr[$v['zy']['year'].'-'.$v['zy']['provinceid'].'-'.$v['zy']['lqzy']];
                                $zy['year'] = $year;
                                $final[$k]['zyname'] = correctZyname($zy);
                            }
                            $data["msg"]="1"; //状态码
                            $data['info'] = $final; //计划列表
                            echo json_encode($data);
                            exit;
                        }else{
                            $data["msg"]="2"; //暂无数据
                            echo json_encode($data);
                            exit;
                        }
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

    /**
     * 宣传系统后台获取中学信息列表
     * HighSchool模块
     */
    public function getZxList()
    {
        $provinceid =intval($_POST['provinceid']);
        $zxmc =dHtml(htmlCv($_POST['zxmc']));
        $zxdm =dHtml(htmlCv($_POST['zxdm']));
        $status =intval($_POST['status']);
        $pageSize =intval($_POST['pagesize']);
        $type =intval($_POST['type']);
        $random =intval($_POST['random']);
        $timestamp = intval($_POST['current']);
        $fileName = 'Zxdm';
        $dao = D($fileName);

        $appidGet = dHtml(htmlCv($_POST['appid']));
        $mapAppid['appid'] = $appidGet;
        $appsecretGet = M('Proof')->where($mapAppid)->getField('appsecret');
        $signCheck = md5($random.$timestamp.$appsecretGet);

        $sign = md5(dHtml(htmlCv($_POST['sign'])));
        if ($sign === $signCheck){
            $now = time();
            if (($now - $timestamp) > 600){ //十分钟
                $data["msg"]="0"; //超时验证失败
                echo json_encode($data);
                exit;
            }else{
                $condition = array();
                if ($zxdm){
                    $condition['zxdm'] = array('eq',$zxdm);
                }else{
                    $condition['zxdm'] = array('neq','');
                }
                $zxmc &&  $condition['zxmc'] = array('like', '%'.$zxmc.'%');
                $status && $condition['status'] = array('eq', $status);
                $provinceid && $condition['provinceid'] = array('eq', $provinceid);
                $count = $dao->where($condition)->count();

                $page = intval($_POST['p']);//获取前台传过来的页码
                if ($page == 0){
                    $page = 1;
                }
                $start=($page-1)*30; //从第几条开始取记录
                if ($type == 1){
                    $dataList = $dao->field('zxdm,zxmc,provinceid,status')->where($condition)->order('provinceid asc')->select();
                }else{
                    $dataList = $dao->field('zxdm,zxmc,provinceid,status')->where($condition)->order('provinceid asc')->Limit($start.','.$pageSize)->select();
                }

                if ($type == 2){
                    //最近三年中学录取人数
                    for ($i=0;$i<3;$i++){
                        $fileName = 'T_tdd_final'.(date('Y')-$i);
                        $db_name = C('DB_PREFIX').strtolower($fileName);
                        $Model = new \Think\Model();
                        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
                        if($m){
                            $daoTdd = D($fileName);
                            $tddList = $daoTdd->field('zxdm')->where("zxdm != ''")->select();
                            $tdd = [];
                            foreach ($tddList as $k=>$v){
                                $tdd[$v['zxdm']]++;
                            }
                            foreach ($dataList as $k=>$v){
                                $dataList[$k]['num'.$i] = $tdd[$v['zxdm']]?$tdd[$v['zxdm']]:0;
                            }
                        }else{
                            foreach ($dataList as $k=>$v){
                                $dataList[$k]['num'.$i] = 0;
                            }
                        }
                    }
                }

                if (false != $dataList){
                    $data["msg"]="1"; //状态码
                    $data['info'] = $dataList; //计划列表
                    $data['count'] = $count; //记录数
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

    
    public function getZxDetail()
    {
        $provinceid =intval($_POST['provinceid']);
        $zxmc =dHtml(htmlCv($_POST['zxmc']));
        $zxdm =dHtml(htmlCv($_POST['zxdm']));
        $status =intval($_POST['status']);
        $pageSize =intval($_POST['pagesize']);
        $type =intval($_POST['type']);
        $random =intval($_POST['random']);
        $timestamp = intval($_POST['current']);
        $fileName = 'Zxdm';
        $dao = D($fileName);

        $appidGet = dHtml(htmlCv($_POST['appid']));
        $mapAppid['appid'] = $appidGet;
        $appsecretGet = M('Proof')->where($mapAppid)->getField('appsecret');
        $signCheck = md5($random.$timestamp.$appsecretGet);

        $sign = md5(dHtml(htmlCv($_POST['sign'])));
        if ($sign === $signCheck){
            $now = time();
            if (($now - $timestamp) > 600){ //十分钟
                $data["msg"]="0"; //超时验证失败
                echo json_encode($data);
                exit;
            }else{
                $condition = array();
                if ($zxdm){
                    $condition['zxdm'] = array('eq',$zxdm);
                }else{
                    $condition['zxdm'] = array('neq','');
                }
                $zxmc &&  $condition['zxmc'] = array('like', '%'.$zxmc.'%');
                $status && $condition['status'] = array('eq', $status);
                $provinceid && $condition['provinceid'] = array('eq', $provinceid);
                $count = $dao->where($condition)->count();

                $page = intval($_POST['p']);//获取前台传过来的页码
                if ($page == 0){
                    $page = 1;
                }
                $start=($page-1)*30; //从第几条开始取记录
                if ($type == 1){
                    $dataList = $dao->field('zxdm,zxmc,provinceid,status')->where($condition)->order('provinceid asc')->select();
                }else{
                    $dataList = $dao->field('zxdm,zxmc,provinceid,status')->where($condition)->order('provinceid asc')->Limit($start.','.$pageSize)->select();
                }
                if (false != $dataList){
                    $data["msg"]="1"; //状态码
                    $data['info'] = $dataList; //计划列表
                    $data['count'] = $count; //记录数
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