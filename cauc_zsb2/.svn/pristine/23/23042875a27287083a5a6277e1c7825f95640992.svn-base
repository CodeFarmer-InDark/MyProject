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
class SearchAction extends HomeAction
{
    public $dao;
    function _initialize()
    {
        parent::_initialize();
        $provinceArr = M('province')->order('id asc')->where('id <> 0')->select();
        $this->assign('province',$provinceArr);
    }

    public function index(){
        $id=intval($_GET['id']);
        $this->assign('id',$id);
        if (!isset($_GET['id']) || $id!=37){parent::_message('error','参数错误');};

        $this->assign('plist','招生计划');
        $this->assign('moduleTitle','招生计划');
        $this->assign('moduleName',$this->getActionName());
        $this->assign('actionName',ACTION_NAME);

        $currentYear = date("Y",time());
        $currentMonth = date("m",time());
        if ($currentMonth > 5){
            $yearArr[0] =$currentYear;
            $yearArr[1] =$currentYear - 1;
            $yearArr[2] =$currentYear - 2;
        }else{
            $yearArr[0] =$currentYear - 1;
            $yearArr[1] =$currentYear - 2;
            $yearArr[2] =$currentYear - 3;
        }
        $this->assign('year',$yearArr);

        //$dao =M('plan');
        $page = (intval($_GET['p'])==0) ? 1 : intval($_GET['p']);
        $province= dHtml(htmlCv($_GET['province']));
        $this->assign('pname',$province);

        $year = dHtml(htmlCv($_GET['year']));

        if (!$year || $year == 0) {
            $this->assign('error','年份必选');
        }else{
            $this->assign('year_selected',$year);
            if($province == ''){
                $this->assign('error','省份必选');
            } else{
                $major = dHtml(htmlCv($_GET['major']));
                $this->assign('mname',$major);
                $type = dHtml(htmlCv($_GET['type']));
                $this->assign('tname',$type);

                $appArr = M('Config')->field('appid,appsecret')->find();
                $appid = $appArr['appid'];
                $appsecret = $appArr['appsecret'];
                $random = mt_rand(1,1000000);
                $timestamp = time();
                $sign = $random.$timestamp.$id.$province.$year.$major.$type.$appsecret;//签名

                $ch = curl_init();
//                $url = C('S_ZS_DOMAIN')."Api/Inquire/getPlan?appid=".$appid."&random=".$random."&current=".$timestamp."&province=".$province."&p=".$page."&year=".$year."&major=".$major."&type=".$type."&categoryId=".$id."&sign=".$sign;
                $url = "www.squality.com/lqgl/index.php/Api/Inquire/getPlan?appid=".$appid."&random=".$random."&current=".$timestamp."&province=".$province."&p=".$page."&year=".$year."&major=".$major."&type=".$type."&categoryId=".$id."&sign=".$sign;

                curl_setopt($ch, CURLOPT_URL, $url);

                curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);

                $res = curl_exec($ch);
//                var_dump($res);
//                die();
                curl_close($ch);
                $res_decode = json_decode($res,true);

               
                switch ($res_decode['msg']){
                    case 0 : $error = '验证超时，请重新提交';break;
                    case 2 : $error = '暂无数据';break;
                    case 3 : $error = '验证失败，请重新提交';break;
                    case 4 : $error = '年份必选';break;
                }
                $planList = $res_decode['info'];
                $this->assign('error',$error);
                $this->assign('total',$res_decode['total']);
                $this->assign('count',$res_decode['count']);
                $this->assign('remark',$res_decode['remark']);
                $this->assign('planList',$planList);
            }
        }
        C('TOKEN_ON',false);
        $this->display();
    }


    /*调取录取系统接口*/
    private function checkCurrentData($model,$appid,$appsecret){
        $random = mt_rand(1,1000000);
        $timestamp = time();
        $sign = $random.$timestamp.$model.$appsecret;//签名

        $ch = curl_init();
        $url = C('S_ZS_DOMAIN')."Api/Inquire/getCheckCurrentData?appid=".$appid."&random=".$random."&current=".$timestamp."&model=".$model."&sign=".$sign;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        $res = curl_exec($ch);
        curl_close($ch);

        $res_decode = json_decode($res,true);
        return $res_decode['msg'];
    }

    public function score(){
        $id=intval($_GET['id']);
        $this->assign('id',$id);
        if (!isset($_GET['id']) || $id!=42){parent::_message('error','参数错误');};

        $this->assign('plist','历年分数');
        $this->assign('moduleTitle','历年分数');
        $this->assign('moduleName',$this->getActionName());
        $this->assign('actionName',ACTION_NAME);

        //线上更新判断当前年数据
        $current = date('Y');
        $mapCurrent['year'] = array('eq',$current);
        $has = M('Score')->where($mapCurrent)->field('id')->select();
        if (false != $has){
            //有当年数据
            $yearArr[0] = $current;
            $yearArr[1] = $current - 1;
            $yearArr[2] = $current - 2;
        }else{
            $yearArr[0] = $current - 1;
            $yearArr[1] = $current - 2;
            $yearArr[2] = $current - 3;
        }

        $appArr = M('Config')->field('appid,appsecret')->find();
        $appid = $appArr['appid'];
        $appsecret = $appArr['appsecret'];
        $flag = $this->checkCurrentData('score',$appid,$appsecret);
        if ($flag == '1'){
            $currentYear = date("Y",time())+1;
        }else{
            $currentYear = date("Y",time());
        }
        $yearArr[0] =$currentYear - 1;
        $yearArr[1] =$currentYear - 2;
        $yearArr[2] =$currentYear - 3;
        $this->assign('year',$yearArr);

        $pid= dHtml(htmlCv($_GET['province']));
        $zydm = dHtml(htmlCv($_GET['major']));
        $kldm = dHtml(htmlCv($_GET['kldm']));
        $year1 = intval($_GET['year1']);
        $year2 = intval($_GET['year2']);
        $year3 = intval($_GET['year3']);
        if($pid){
            $this->assign('pid',$pid);
            $this->assign('zydm',$zydm);
            $this->assign('kldm',$kldm);
            if($year1 || $year2 || $year3){
                $year_s_arr = array($year1,$year2,$year3);
            }else{
                $year_s_arr = '';
            }
            if (is_array($year_s_arr)){
                $this->assign('year_selected',$year_s_arr);
                $this->assign('year_selected1',implode(',',$year_s_arr));
                //$condition['year'] = array('in',$year_s_arr);
            }

            $random = mt_rand(1,1000000);
            $timestamp = time();
            $sign = $random.$timestamp.$id.$pid.$kldm.$year1.$year2.$year3.$zydm.$appsecret;//签名

            $ch = curl_init();
//            $url = C('S_ZS_DOMAIN')."Api/Inquire/getScore?appid=".$appid."&random=".$random."&current=".$timestamp."&province=".$pid."&kldm=".$kldm."&year1=".$year1."&year2=".$year2."&year3=".$year3."&zydm=".$zydm."&categoryId=".$id."&sign=".$sign;
            $url = "www.squality.com/lqgl/index.php/Api/Inquire/getScore?appid=".$appid."&random=".$random."&current=".$timestamp."&province=".$pid."&kldm=".$kldm."&year1=".$year1."&year2=".$year2."&year3=".$year3."&zydm=".$zydm."&categoryId=".$id."&sign=".$sign;
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);

            $res = curl_exec($ch);
            curl_close($ch);
//            var_dump($res);
//            die();

            $res_decode = json_decode($res,true);
            switch ($res_decode['msg']){
                case 0 : $error = '验证超时，请重新提交';break;
                case 2 : $error = '暂无数据';break;
                case 3 : $error = '验证失败，请确保凭证正确';break;
            }
            $this->assign('msg',$error);
            $scoreList = $res_decode['info'];

            /* 数组分页 */
            $count = count($scoreList);
            $Page = new Page($count,20,'&id=42&province='.$pid.'&kldm='.$kldm.'&major='.$zydm.'&year1='.$year1.'&year2='.$year2.'&year3='.$year3);
            $show  = $Page->show();
            $list = array_slice($scoreList,$Page->firstRow,$Page->listRows);
            $this->assign('data',$list);// 赋值数据集
            $this->assign('page',$show);// 赋值分页输出
            $this->assign('count',$count);

            $this->assign('remark',$res_decode['remark']);
        }else{
            $this->assign('msg','省份必选');
        }
        C('TOKEN_ON',false);
        $this->display();
    }

    /**
     * 网上报名
     */
    public function apply(){
        $id=intval($_GET['id']);
        if (!isset($_GET['id']) || $id!=38){parent::_message('error','参数错误');};
        $this->assign('plist','网上报名');
        $this->assign('moduleTitle','网上报名');
        $this->display();
    }

    /**
     * 选考科目
     */
    public function subject(){
        $id=intval($_GET['id']);
        $this->assign('id',$id);
        if (!isset($_GET['id']) || $id!=39){parent::_message('error','参数错误');};

        $this->assign('plist','选考科目');
        $this->assign('moduleTitle','选考科目');
        $this->assign('moduleName',$this->getActionName());
        $this->assign('actionName',ACTION_NAME);

        $this->assign('zjid',33);
        $this->assign('shid',31);
        $currentYear = date("Y",time());
        $currentMonth = date("m",time());
        if ($currentMonth < 6) {
            $yearArr[0] =$currentYear - 1;
            $yearArr[1] =$currentYear - 2;
            $yearArr[2] =$currentYear - 3;
        }else{
            $yearArr[0] =$currentYear;
            $yearArr[1] =$currentYear - 1;
            $yearArr[2] =$currentYear - 2;
        }
        $this->assign('year',$yearArr);

        $page = (intval($_GET['p'])==0) ? 1 : intval($_GET['p']);
        $pid= intval($_GET['province']);
        $mapProvince['id'] = $pid;
        $province = M('Province')->where($mapProvince)->getField('name');
        $this->assign('pname',$province);
        $this->assign('pid',$pid);
        $year= intval($_GET['year']);
      
        $this->assign('year_selected',$year);
        if($pid){
            $appArr = M('Config')->field('appid,appsecret')->find();
            $appid = $appArr['appid'];
            $appsecret = $appArr['appsecret'];
            $random = mt_rand(1,1000000);
            $timestamp = time();
            $sign = $random.$timestamp.$id.$province.$year.$appsecret;//签名

            $ch = curl_init();
            $url = C('S_ZS_DOMAIN')."Api/Inquire/getSubject?appid=".$appid."&random=".$random."&current=".$timestamp."&province=".$province."&year=".$year."&p=".$page."&categoryId=".$id."&sign=".$sign;
//            $url = "http://www.squality.com/lqgl/index.php/Api/Inquire/getSubject?appid=".$appid."&random=".$random."&current=".$timestamp."&province=".$province."&year=".$year."&p=".$page."&categoryId=".$id."&sign=".$sign;
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);

            $res = curl_exec($ch);
            curl_close($ch);

            $res_decode = json_decode($res,true);
            switch ($res_decode['msg']){
                case 0 : $error = '验证超时，请重新提交';break;
                case 2 : $error = '暂无数据';break;
                case 3 : $error = '验证失败，请确保凭证正确';break;
            }
            $this->assign('msg',$error);
            $this->assign('total',$res_decode['total']);
            $this->assign('count',$res_decode['count']);
            $this->assign('dataList',$res_decode['info']);
            $this->assign('remark',$res_decode['remark']);
        }else{
            $this->assign('msg','省份必选');
        }
        C('TOKEN_ON',false);
        $this->display();
    }


    /**
     * 录取结果查询
     */
    public function admission(){
        set_time_limit(60);
        $id=intval($_GET['id']);
        $this->assign('id',$id);
        if (!isset($_GET['id']) || $id!=55){parent::_message('error','参数错误');};

        $mapRemark['category_id'] = 58;
        $remark = M('Remark')->where($mapRemark)->getField('content');
        if ($remark != ''){
            $this->assign('remark',$remark);
        }

        $this->assign('plist','录取结果');
        $this->assign('moduleTitle','录取结果');
        $this->assign('moduleName',$this->getActionName());
        $this->assign('actionName',ACTION_NAME);

        $ksh= dHtml(htmlCv(trim($_POST['ksh'])));
        $sfzh= dHtml(htmlCv(trim($_POST['sfzh'])));
        $this->assign('ksh',$ksh);
        $this->assign('sfzh',$sfzh);
        
        $appArr = M('Config')->field('appid,appsecret,isadmission,admission_remark')->where('id = 1')->find();
        if ($appArr['isadmission'] != 1){
            if ($appArr['admission_remark'] == ''){
                $appArr['admission_remark'] = '录取工作尚未开始或已经结束';
            }
            parent::_message('errorUri',$appArr['admission_remark'],U('Index/index'),10);
        }
        $appid = $appArr['appid'];
        $appsecret = $appArr['appsecret'];
        $random = mt_rand(1,1000000);
        $timestamp = time();
        $sign = $random.$timestamp.$id.$ksh.$sfzh.$appsecret;//签名

        $ch = curl_init();
        $url = C('S_ZS_DOMAIN')."index.php/Api/Inquire/getAdmission";

        $post_data = [];
        $post_data['appid'] = $appid;
        $post_data['random'] = $random;
        $post_data['current'] = $timestamp;
        if ($ksh || $sfzh){
            $this->assign('showResult',1);
            $post_data['ksh'] = $ksh;
            $post_data['sfzh'] = $sfzh;
        }else{
            $mapRemark['category_id'] = 55;
            $remark = M('Remark')->where($mapRemark)->getField('content');
            if ($remark != ''){
                $this->assign('remarkProgress',$remark);
            }
        }

        $post_data['categoryId'] = $id;
        $post_data['sign'] = $sign;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        $res = curl_exec($ch);
        curl_close($ch);

        $res_decode = json_decode($res,true);

        switch ($res_decode['msg']){
            case 2 : $error = '录取结果尚未公布或您未被我校录取';break;
            case 20 : $error = '考生号必填';break;
            case 30 : $error = '身份证号必填';break;
            case 40 : $error = '身份证号码填写有误，请重新填写';break;
            case 50 : $error = '考生号必须为14位国家统一考生编号，广东省为10位';break;
            case 4 : $error = '验证超时，请刷新页面';break;
            case 'progress2' : $error = '暂无数据';break;
            case 3 : $error = '验证失败，请刷新页面';break;
        }
        if ($res_decode['isimg'] == '2'){
            $this->assign('isimg','未导入照片');
        }
        $content = $res_decode['info'];
        //$this->assign('vo',$content);

        $pcList = $res_decode['pcList'];
        $dataYear = $res_decode['year'];
        $this->assign('datayear',$dataYear);
        $this->assign('error',$error);

        if ($res_decode['msg'] == 1){
            $remarksuccess = M('Remark')->where('category_id = 56')->getField('content');
            if ($remarksuccess != ''){
                $this->assign('remarksuccess',$remarksuccess);
            }
            $this->assign('pcList',$pcList);
            $this->assign('dataList',$content);
        }else{
            $remarksuccess = M('Remark')->where('category_id = 57')->getField('content');
            if ($remarksuccess != ''){
                $this->assign('remarkfalse',$remarksuccess);
            }
        }

        C('TOKEN_ON',false);
        $this->display();
    }

    /* 获取下拉专业 */
    public function getMajor(){
        $yearStr = dHtml(htmlCv($_POST['year']));
        $condition = [];
        $condition['status'] = array('eq',0);
        if (empty($yearStr)){
            if($_GET['type'] == 1){
                $currentyear = date('Y',time());
            }else{
                $currentyear = date('Y',time()) - 1;
            }
            $condition['year'] = array('eq',$currentyear);
            $dataList = M('Zy')->where($condition)->field('id,title')->select();
            if (false != $dataList){
                $res['code'] = 2;
                $res['data'] = $dataList;
            }else{
                $res['code'] = 1;
                $res['data'] = '';
            }
        }else{
            $yearArr = explode(',',$yearStr);
            $condition['year'] = array('in',$yearArr);
            $dataList = M('Zy')->where($condition)->field('id,title')->select();

            $result = [];
            foreach ($dataList as $k=>$v){
                //根据专业名称去重
                $result[$v['title']] = $v;
            }
            if (false != $result){
                $res['code'] = 2;
                $res['data'] = $result;
            }else{
                $res['code'] = 1;
                $res['data'] = '';
            }
        }
        echo json_encode($res);
    }
    /*public function getMajor(){
        $operateList = M('ZyOperate')->select();
        foreach ($operateList as $k=>$v){
            $origin = explode(',',$v['origin']);
            for ($i=0;$i<count($origin);$i++){
                $operate[$origin[$i]]['year'] = $v['year'];
                $operate[$origin[$i]]['type'] = $v['type'];
                $operate[$origin[$i]]['direct'] = $v['direct'];
            }
        }

        $yearStr = dHtml(htmlCv($_POST['year']));
        $condition = [];
        $condition['status'] = array('eq',0);
        if (empty($yearStr)){
            if($_GET['type'] == 1){
                $currentyear = date('Y',time());
            }else{
                $currentyear = date('Y',time()) - 1;
            }
            $dataList = M('Zy')->where($condition)->field('id,title')->select();
            foreach ($dataList as $k=>$v){
                $data[$v['id']] = $v;
            }
            foreach ($data as $key=>$val) {
                $info = $operate[$val['id']];
                if ($info) {
                    if ($currentyear >= $info['year']){
                        //当前年大于或等于专业操作生效年份 则剔除合并及隐藏的专业
                        unset($data[$key]);
                    }else{
                        //当前年小于专业操作生效年份 则剔除合并的专业
                        unset($data[$info['direct']]);
                    }
                }
            }
            if (false != $data){
                $res['code'] = 2;
                $res['data'] = $data;
            }else{
                $res['code'] = 1;
                $res['data'] = '';
            }
        }else{
            $yearArr = explode(',',$yearStr);
            $dataList = M('Zy')->where($condition)->field('id,title')->select();
            foreach ($dataList as $k=>$v){
                $data[$v['id']] = $v;
            }
            foreach ($data as $key=>$val) {
                $info = $operate[$key];
                if ($info) {
                    foreach ($operate as $key1=>$val1){
                        if (max($yearArr) < $val1['year']){
                            //查询条件的最大年份小于操作年份时 剔除合并的专业
                            unset($data[$info['direct']]);
                        }
                        if (min($yearArr) >= $val1['year']){
                            //查询条件的最小年份大于或等于操作年份时 剔除剔除合并及隐藏的专业
                            unset($data[$key]);
                        }
                    }
                }
            }

            if (false != $data){
                $res['code'] = 2;
                $res['data'] = $data;
            }else{
                $res['code'] = 1;
                $res['data'] = '';
            }
        }
        echo json_encode($res);
    }*/

}