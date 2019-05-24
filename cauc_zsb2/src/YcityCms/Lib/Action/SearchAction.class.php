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

        $majorArr = M('Zy')->where('parent_id != 0 and status != 1')->order('id desc')->select();
        foreach($majorArr as $k=>$v){
//			if($v['zyfx'] != ''){
//				$majorArr[$k]['title'] = $v['title'].'('.$v['zyfx'].')';
//			}
			$majorArr[$k]['title'] = $v['title'];
		}
		$this->assign('major',$majorArr);

        $major1 = M('Major')->field('id,major')->select();
        $this->assign('major1',$major1);

        $provinceArr = M('province')->where('id > 0')->order('id asc')->select();
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
//            for ($i=1;$i<4;$i++){
//                $yearArr[$i] = (string)($currentYear - $i);
//            }
        }
        $this->assign('year',$yearArr);

        $dao =M('plan');
        $pid= intval($_GET['province']);
        $this->assign('pid',$pid);
        if($pid){
            $this->assign('msg','暂无数据');
            $condition = array();

			$year1 = dHtml(htmlCv($_GET['year1']));
			 $year2 = dHtml(htmlCv($_GET['year2']));
			  $year3 = dHtml(htmlCv($_GET['year3']));
			  if($year1 || $year2 || $year3){
				  $year_s_arr = array($year1,$year2,$year3);
			  }else{
				  $year_s_arr = '';
			  }
			
            if (is_array($year_s_arr)){
                $this->assign('year_selected',$year_s_arr);
				 $this->assign('year_selected1',implode(',',$year_s_arr));
                foreach ($year_s_arr as $key => $val) {
                    if ($val == '') {
                        unset($year_s_arr[$key]);
                    }
                }
				 $condition['year'] = array('in',$year_s_arr);
            }else{
                $currentMonth = date("m",time());
                if ($currentMonth < 6){
                    $currentYear = date("Y",time());
                    $condition['year'] = array('neq',$currentYear);
                }
				$condition['year'] = array('in',$yearArr);
            }
            /*$year = htmlCv(dHtml($_GET['year']));
            if ($year){
                $this->assign('year_selected',$year);
            }else{
                $currentMonth = date("m",time());
                if ($currentMonth < 6){
                    $currentYear = date("Y",time());
                    $condition['year'] = array('neq',$currentYear);
                }
            }*/


            $mid = intval($_GET['major']); //获取的是major表专业的id
            if ($mid){
                $this->assign('major_id_selected',$mid);
            }
            $condition1['id'] = array('like',$mid);
//            $major_select = M('Zy')->where($condition1)->find();
            $major_select = M('Major')->where($condition1)->find();

            $major_name_select = $major_select['major'];
//            $this->assign('major_name_selected',$major_name_select);

            //$year && $condition['year'] = array('eq',$year);
            $major_name_select = explode('（',$major_name_select)[0];
            $major_name_select && $condition['major'] = array('eq',$major_name_select);
            $condition2['id'] = array('eq',$pid);
            $province = M('province')->where($condition2)->find();
            $pName = $province['province'];
            $this->assign('province_selected',$pName);
            $pName && $condition['province'] = array('eq',$pName);
            $count = $dao->where($condition)->count();
            $listRows = empty($pageSize) || $pageSize > 100 ? 30 : $pageSize ;
            $p = new page($count, $listRows);
            $dataList = $dao->Order( 'year desc,batch desc,id desc')->Where($condition)->Limit($p->firstRow.','.$p->listRows)->select();
            //线上修改--暂时区分文科理科
            foreach ($dataList as $key => $val) {
                if ($val['type'] == '文理综合') {
                    if (strstr($val['batch'],'文科') !== false) {
                        $dataList[$key]['type'] = '文科';
                    }
                    if (strstr($val['batch'],'理科') !== false) {
                        $dataList[$key]['type'] = '理科';
                    }
                } else {
                    if (strstr($val['type'],'文') !== false) {
                        $dataList[$key]['type'] = '文科';
                    }
                    if (strstr($val['type'],'理') !== false) {
                        $dataList[$key]['type'] = '理科';
                    }
                }
            }

            /* 分页参数 */
            $conditions = array();
            $conditions['id'] = 37;
           
           $year1 && $conditions['year1']=$year1;
		    $year2 && $conditions['year2']=$year2;
			 $year3 && $conditions['year3']=$year3;
            $province && $conditions['province']=$pid;
            $mid && $conditions['major']=$mid;
          
            foreach($conditions as $key=>$val) {
                $p->parameter   .= '&'."$key=".urlencode($val);
            }
            $page = $p->show();
            if ($dataList !== null)
            {
                $this->assign('pageBar', $page);
                $this->assign('dataList', $dataList);
            }
        }else{
            $this->assign('msg','省份必选');
        }

        $condition3['category_id'] = 37;
        $remark = M('remark')->where($condition3)->order('id desc,create_time desc')->find();
        $this->assign('remark',$remark['content']);
        C('TOKEN_ON',false);
        $this->display();
    }
    public function scorenav()
    {
        $this->display();
    }
    /**
     * 已弃用
     */
    public function score(){
        $id=intval($_GET['id']);
        $this->assign('id',$id);
        $this->assign('zydm',$_GET['major']);
        $this->assign('kldm',$_GET['kldm']);
        if (!isset($_GET['id']) || $id!=42){parent::_message('error','参数错误');};
        $this->assign('plist','历年分数');
        $this->assign('moduleTitle','历年分数');
        $this->assign('moduleName',$this->getActionName());
        $this->assign('actionName',ACTION_NAME);

        //科类
        $kl_arr = [
            1   =>  '理科',
            2   =>  '文科',
            3   =>  '综合改革',
        ];
        $this->assign('kl',$kl_arr);
		 //线上更新判断当前年数据
        $currentYear = date('Y');
        $mapCurrent['year'] = array('eq',$currentYear);
        $has = M('Score')->where($mapCurrent)->field('id')->select();
        if (false != $has){
            //有当年数据
            $yearArr[0] = $currentYear;
            $yearArr[1] = $currentYear - 1;
            $yearArr[2] = $currentYear - 2;
        }else{
            $yearArr[0] = $currentYear - 1;
            $yearArr[1] = $currentYear - 2;
            $yearArr[2] = $currentYear - 3;
        }
        $this->assign('year',$yearArr);
//        $dao =M('score');
        $pid= intval($_GET['province']);
        $this->assign('pid',$pid);
        //接口获取score数据
        $appArr = M('Config')->field('appid,appsecret')->find();
        $appid = $appArr['appid'];
        $appsecret = $appArr['appsecret'];
//        $flag = $this->checkCurrentData('score',$appid,$appsecret);
//        if ($flag == '1'){
//            $currentYear = date("Y",time())+1;
//        }else{
//            $currentYear = date("Y",time());
//        }
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
            }
            $random = mt_rand(1,1000000);
            $timestamp = time();
            $sign = $random.$timestamp.$id.$pid.$kldm.$year1.$year2.$year3.$zydm.$appsecret;//签名
            $ch = curl_init();//初始化一个新的会话，返回一个cURL句柄，供curl_setopt(), curl_exec()和curl_close() 函数使用。 
            //$url = C('S_ZS_DOMAIN')."Api/Inquire/getScore?appid=".$appid."&random=".$random."&now=".$timestamp."&province=".$pid."&kldm=".$kldm."&year1=".$year1."&year2=".$year2."&year3=".$year3."&zydm=".$zydm."&categoryId=".$id."&sign=".$sign;
            /** zj 这个api调用不成功 */
            //$url = "www.squality.com/lqgl/index.php/Api/Inquire/getScore?appid=".$appid."&random=".$random."&now=".$timestamp."&province=".$pid."&kldm=".$kldm."&year1=".$year1."&year2=".$year2."&year3=".$year3."&zydm=".$zydm."&categoryId=".$id."&sign=".$sign;
            $url = "127.0.0.1/job/cauc_zs3/lqgl/index.php/Api/Inquire/getScore?appid=".$appid."&random=".$random."&now=".$timestamp."&province=".$pid."&kldm=".$kldm."&year1=".$year1."&year2=".$year2."&year3=".$year3."&zydm=".$zydm."&categoryId=".$id."&sign=".$sign;
            //echo $url;die;
            //            echo '<a href="'.$url.'" target="_blank">测试</a>';
            //            die();
            // 设置访问的URL地址
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            //不接受头信息
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            $res = curl_exec($ch);
            curl_close($ch);
            $res_decode = json_decode($res,true);
            switch ($res_decode['msg']){
                case 0 : $error = '验证超时，请重新提交'.$res_decode['msg'];break;
                case 2 : $error = '暂无数据';break;
                case 3 : $error = '验证失败，请确保凭证正确';break;
            }
            $this->assign('msg',$error);
            $scoreList = $res_decode['info'];
            //排序--把专科的批次放到最后面
            $end_arr = array();
            foreach ($scoreList as $key => $val) {
                if (strpos($val['pcname'],'专科') !== false) {
                    $end_arr[] = $val;
                    unset($scoreList[$key]);
                }
            }
            $scoreList = array_merge($scoreList,$end_arr);


            /* 数组分页 */
            $count = count($scoreList);
            $Page = new Page($count,20,'&id=42&province='.$pid.'&kldm='.$kldm.'&major='.$zydm.'&year1='.$year1.'&year2='.$year2.'&year3='.$year3);
            $show  = $Page->show();
            $list = array_slice($scoreList,$Page->firstRow,$Page->listRows);
            $this->assign('data',$list);// 赋值数据集
            $this->assign('page',$show);// 赋值分页输出
            $this->assign('count',$count);

            $this->assign('remark',$res_decode['remark']);
//            $this->assign('msg','暂无数据');
//            $condition = array();
//
//            $year1 = dHtml(htmlCv($_GET['year1']));
//			 $year2 = dHtml(htmlCv($_GET['year2']));
//			  $year3 = dHtml(htmlCv($_GET['year3']));
//			  if($year1 || $year2 || $year3){
//				  $year_s_arr = array($year1,$year2,$year3);
//			  }else{
//				  $year_s_arr = '';
//			  }
//
//            if (is_array($year_s_arr)){
//                $this->assign('year_selected',$year_s_arr);
//				 $this->assign('year_selected1',implode(',',$year_s_arr));
//				 $condition['year'] = array('in',$year_s_arr);
//            }else{
//                $currentMonth = date("m",time());
//                if ($currentMonth < 6){
//                    $currentYear = date("Y",time());
//                    $condition['year'] = array('neq',$currentYear);
//                }
//				$condition['year'] = array('in',$yearArr);
//            }
//
//            $mid = intval($_GET['major']); //获取的是major表专业的id
//            if ($mid && $mid !=0){
//                $this->assign('major_id_selected',$mid);
//            }
//            $condition1['id'] = array('like',$mid);
////            $major_select = M('Zy')->where($condition1)->find();
//            $major_select = M('Major')->where($condition1)->find();
//            $major_name_select = $major_select['major'];
//			 $major_zyfx_select = $major_select['zyfx'];
////            $this->assign('major_name_selected',$major_name_select);
//
//
//            //科类
//            $kldm = $_GET['kldm'];
//            $kldm_arr = [
//                1   =>  '%理%',
//                2   =>  '%文%',
//                3   =>  '%综合改革%'
//            ];
//            //$year && $condition['year'] = array('eq',$year);
//            $major_name_select = explode('（',$major_name_select)[0];
//            $major_name_select && $condition['major'] = array('eq',$major_name_select);
//            $kldm && $condition['type'] = array('like',$kldm_arr[$kldm]);
////			$major_zyfx_select && $condition['zyfx'] = array('eq',$major_zyfx_select);
//
//            $condition2['id'] = array('eq',$pid);
//            $province = M('province')->where($condition2)->find();
//            $pName = $province['province'];
//            $this->assign('province_selected',$pName);
//            $pName && $condition['province'] = array('eq',$pName);
//
////			$condition['year'] = array('in',$yearArr);
//			/*if($year){
//				$condition['year']=array('eq',$year);
//			}else{
//				$condition['year'] = array('in',$yearArr);
//			}*/
//            $count = $dao->where($condition)->count();
//            $listRows = empty($pageSize) || $pageSize > 100 ? 30 : $pageSize ;
//            $p = new page($count, $listRows);
//            $dataList = $dao->Order( 'year DESC,id DESC')->Where($condition)->Limit($p->firstRow.','.$p->listRows)->select();
//
//            //线上修改--暂时区分文科理科
//            foreach ($dataList as $key => $val) {
//                if ($val['type'] == '文理综合') {
//                    if (strstr($val['batch'],'文科') !== false) {
//                        $dataList[$key]['type'] = '文科';
//                    }
//                    if (strstr($val['batch'],'理科') !== false) {
//                        $dataList[$key]['type'] = '理科';
//                    }
//                } else {
//                    if (strstr($val['type'],'文') !== false) {
//                        $dataList[$key]['type'] = '文科';
//                    }
//                    if (strstr($val['type'],'理') !== false) {
//                        $dataList[$key]['type'] = '理科';
//                    }
//                }
//            }
//
//            /* 分页参数 */
//            $conditions = array();
//            $conditions['id'] = 42;
//
//           $year1 && $conditions['year1']=$year1;
//		    $year2 && $conditions['year2']=$year2;
//			 $year3 && $conditions['year3']=$year3;
//            $province && $conditions['province']=$pid;
//            $mid && $conditions['major']=$mid;
//
//            foreach($conditions as $key=>$val) {
//				$p->parameter   .= '&'."$key=".urlencode($val);
//            }
//
//            $page = $p->show();
//            if ($dataList !== false)
//            {
//                $this->assign('page', $page);
//				//var_dump($dataList);die();
//                $this->assign('data', $dataList);
//            }
        }else{
            $this->assign('msg','省份必选');

        }

//        $condition3['category_id'] = array('eq',42);
//        $remark = M('remark')->where($condition3)->order('id desc,create_time desc')->find();
//        $this->assign('remark',$remark['content']);
        C('TOKEN_ON',false);
        $this->display();
    }
    //按照专业查询
    public function score1()
    {
        $id=intval($_GET['id']);
        $this->assign('id',$id);
        $this->assign('zydm',$_GET['major']);
        $this->assign('kldm',$_GET['kldm']);
        if (!isset($_GET['id']) || $id!=42){parent::_message('error','参数错误');};
        $this->assign('plist','历年分数');
        $this->assign('moduleTitle','历年分数');
        $this->assign('moduleName',$this->getActionName());
        $this->assign('actionName',ACTION_NAME);

        //科类
        $kl_arr = [
            1   =>  '理科',
            2   =>  '文科',
            3   =>  '综合改革',
        ];
        $this->assign('kl',$kl_arr);
        //线上更新判断当前年数据
        $currentYear = date('Y');
        $mapCurrent['year'] = array('eq',$currentYear);
        $has = M('Score')->where($mapCurrent)->field('id')->select();
        if (false != $has){
            //有当年数据
            $yearArr[0] = $currentYear;
            $yearArr[1] = $currentYear - 1;
            $yearArr[2] = $currentYear - 2;
        }else{
            $yearArr[0] = $currentYear - 1;
            $yearArr[1] = $currentYear - 2;
            $yearArr[2] = $currentYear - 3;
        }
        $this->assign('year',$yearArr);
//        $dao =M('score');
        $pid= intval($_GET['province']);
        $this->assign('pid',$pid);
        //接口获取score数据
        $appArr = M('Config')->field('appid,appsecret')->find();
        $appid = $appArr['appid'];
        $appsecret = $appArr['appsecret'];
//        $flag = $this->checkCurrentData('score',$appid,$appsecret);
//        if ($flag == '1'){
//            $currentYear = date("Y",time())+1;
//        }else{
//            $currentYear = date("Y",time());
//        }
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
            }
            $random = mt_rand(1,1000000);
            $timestamp = time();
            $sign = $random.$timestamp.$id.$pid.$kldm.$year1.$year2.$year3.$zydm.$appsecret;//签名
            $ch = curl_init();
//            $url = 'http://10.30.1.170/lqgl/'."Api/Inquire/getScore?appid=".$appid."&random=".$random."&now=".$timestamp."&province=".$pid."&kldm=".$kldm."&year1=".$year1."&year2=".$year2."&year3=".$year3."&zydm=".$zydm."&categoryId=".$id."&sign=".$sign;
            //$url = "www.squality.com/lqgl/index.php/Api/Inquire/getScore?appid=".$appid."&random=".$random."&now=".$timestamp."&province=".$pid."&kldm=".$kldm."&year1=".$year1."&year2=".$year2."&year3=".$year3."&zydm=".$zydm."&categoryId=".$id."&sign=".$sign;
            $url = "localhost/job/cauc_zs3/lqgl/index.php/Api/Inquire/getScore?appid=".$appid."&random=".$random."&now=".$timestamp."&province=".$pid."&kldm=".$kldm."&year1=".$year1."&year2=".$year2."&year3=".$year3."&zydm=".$zydm."&categoryId=".$id."&sign=".$sign;
//            echo '<a href="'.$url.'" target="_blank">跳转</a>';
//            die();
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
            $scoreList = $res_decode['info'];

            //dump($scoreList);return;
            //模糊排序--把专科的批次放到最后面
//            $end_arr = array();
//            foreach ($scoreList as $key => $val) {
//                if (strpos($val['pcname'],'专科') !== false) {
//                    $end_arr[] = $val;
//                    unset($scoreList[$key]);
//                }
//            }
//            $scoreList = array_merge($scoreList,$end_arr);

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
    //按照批次查询
    public function score2()
    {
        $id=intval($_GET['id']);
        $pc = strval($_GET['pc']);
        if (!isset($_GET['id']) || $id!=42){parent::_message('error','参数错误');};
        $this->assign('pcdm',$pc);
        $this->assign('id',$id);
        $this->assign('plist','历年分数');
        $this->assign('moduleTitle','历年分数');
        $this->assign('moduleName',$this->getActionName());
        $this->assign('actionName',ACTION_NAME);

        //线上更新判断当前年数据
        $currentYear = date('Y');
        $mapCurrent['year'] = array('eq',$currentYear);
        $has = M('Score')->where($mapCurrent)->field('id')->select();
        if (false != $has){
            //有当年数据
            $yearArr[0] = $currentYear;
            $yearArr[1] = $currentYear - 1;
            $yearArr[2] = $currentYear - 2;
        }else{
            $yearArr[0] = $currentYear - 1;
            $yearArr[1] = $currentYear - 2;
            $yearArr[2] = $currentYear - 3;
        }
        $this->assign('year',$yearArr);
        $pid= intval($_GET['province']);
        $this->assign('pid',$pid);
        //接口获取score数据
        $appArr = M('Config')->field('appid,appsecret')->find();
        $appid = $appArr['appid'];
        $appsecret = $appArr['appsecret'];
//        $flag = $this->checkCurrentData('score',$appid,$appsecret);
//        if ($flag == '1'){
//            $currentYear = date("Y",time())+1;
//        }else{
//            $currentYear = date("Y",time());
//        }
        $yearArr[0] =$currentYear - 1;
        $yearArr[1] =$currentYear - 2;
        $yearArr[2] =$currentYear - 3;
        $this->assign('year',$yearArr);
        $pid= dHtml(htmlCv($_GET['province']));
        $year1 = intval($_GET['year1']);
        $year2 = intval($_GET['year2']);
        $year3 = intval($_GET['year3']);
        if($pid){
            $this->assign('pid',$pid);
            if($year1 || $year2 || $year3){
                $year_s_arr = array($year1,$year2,$year3);
            }else{
                $year_s_arr = '';
            }
            if (is_array($year_s_arr)){
                $this->assign('year_selected',$year_s_arr);
                $this->assign('year_selected1',implode(',',$year_s_arr));
            }
            $random = mt_rand(1,1000000);
            $timestamp = time();
            $sign = $random.$timestamp.$id.$pid.$year1.$year2.$year3.$pc.$appsecret;//签名
            $ch = curl_init();
//            $url = 'http://10.30.1.170/lqgl/'."Api/Inquire/getScoreByPc?appid=".$appid."&random=".$random."&now=".$timestamp."&province=".$pid."&year1=".$year1."&year2=".$year2."&year3=".$year3."&pc=".$pc."&categoryId=".$id."&sign=".$sign;
            //$url = "www.squality.com/lqgl/index.php/Api/Inquire/getScoreByPc?appid=".$appid."&random=".$random."&now=".$timestamp."&province=".$pid."&year1=".$year1."&year2=".$year2."&year3=".$year3."&pc=".$pc."&categoryId=".$id."&sign=".$sign;
            $url = "localhost/job/cauc_zs3/lqgl/index.php/Api/Inquire/getScoreByPc?appid=".$appid."&random=".$random."&now=".$timestamp."&province=".$pid."&year1=".$year1."&year2=".$year2."&year3=".$year3."&pc=".$pc."&categoryId=".$id."&sign=".$sign;
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
            $scoreList = $res_decode['info'];

            /* 数组分页 */
            $count = count($scoreList);
            $Page = new Page($count,20,'&id=42&province='.$pid.'&year1='.$year1.'&year2='.$year2.'&year3='.$year3.'&pc='.$pc);
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

    /* 历年分数折线图表数据 */
    public function charts(){
//		$currentYear = date("Y",time());
		$currentYear = intval(date("Y",time()));
			 //线上更新判断当前年数据
//        $mapCurrent['year'] = array('eq',$currentYear);
//        $has = M('Score')->where($mapCurrent)->field('id')->select();
        $year = $_GET['year'];
        if (!$year){
            //有当年数据
            $yearArr[0] = $currentYear -1;
            $yearArr[1] = $currentYear - 2;
            $yearArr[2] = $currentYear - 3;
        }else{
            $yearArr = explode(',',$year);
            foreach ($yearArr as $key => $val) {
                if ($val == '') {
                    unset($yearArr[$key]);
                }
            }
        }
        /*if ($currentMonth > 5){
            $yearArr[0] =$currentYear;
            $yearArr[1] =$currentYear - 1;
            $yearArr[2] =$currentYear - 2;
//            for ($i=1;$i<3;$i++){
//                $yearArr[$i] = (string)($currentYear - $i);
//            }
        }else{*/
           /* $yearArr[0] =$currentYear - 1;
            $yearArr[1] =$currentYear - 2;
            $yearArr[2] =$currentYear - 3;*/
//            for ($i=1;$i<4;$i++){
//                $yearArr[$i] = (string)($currentYear - $i);
//            }
        /*}*/
		
        $dao =M('score');
        $condition = array();

        $pid = intval($_GET['province']);
        $mid = intval($_GET['zydm']);
        if ($pid){
            //科类
            $kldm = $_GET['kldm'];
            $kldm_arr = [
                1   =>  '%理%',
                2   =>  '%文%',
                3   =>  '%综合改革%'
            ];

            $where0['id'] = array('eq',$pid);
            $province = M('province')->where($where0)->find();
            $pName = $province['province'];
            $condition['province'] = $pName;
            $where['id']= array('like',$mid);
            $major = M('Major')->where($where)->find();
            var_dump($major,$where);
            die();
            $mName = $major['major'];
            $mName = explode('（',$mName)[0];
            $mName && $condition['major'] = array('eq',$mName);
            $kldm && $condition['type'] = array('like',$kldm_arr[$kldm]);
			$condition['year'] = array('in',$yearArr);
			//最终数据查询
            $dataList = $dao->Order('year asc')->field('id,zyfx,batch,year,province,major,topScore,lowScore,aveScore')->Where($condition)->select();
			$array = array();
            if ($dataList == null){
                $data = "{error:0}";
                echo $data;
            }else{
                foreach ($dataList as $key => $value) {
                    $array['year'][]=$value['year'].'（'.$value['batch'].'）'.($value['zyfx']? "({$value['zyfx']})":'');
                    $array['topScore'][]=$value['topScore'];
                    $array['lowScore'][]=$value['lowScore'];
                    $array['aveScore'][]=$value['aveScore'];
                }
                $data = json_encode($array);
                echo $data;
            }
        }
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
        $dataYear = M('subject')->Field('year')->Distinct(true)->Order('year asc')->select();
        foreach($dataYear as $val)
        {
            $years[] = $val['year'];
        }
        $this->assign('years',$years);
        if (!isset($_GET['id']) || $id!=39){parent::_message('error','参数错误');};

        $this->assign('plist','选考科目');
        $this->assign('moduleTitle','选考科目');
        $this->assign('moduleName',$this->getActionName());
        $this->assign('actionName',ACTION_NAME);

        $this->assign('zjid',33);
        $this->assign('shid',31);
        
        $dao =M('subject');

        $pid= intval($_GET['province']);
        $this->assign('pid',$pid);
        if($pid){
            $this->assign('msg','暂无数据');
            $condition = array();

            $year = htmlCv(dHtml($_GET['year']));
            if ($year){
                $this->assign('year_selected',$year);
            }
            $mid = intval($_GET['major']); //获取的是major表专业的id
            if ($mid){
                $this->assign('major_id_selected',$mid);
            }
            $condition1['id'] = array('eq',$mid);
            $major_select = M('Zy')->where($condition1)->find();
            $major_name_select = $major_select['title'];
            $this->assign('major_name_selected',$major_name_select);

            $type = htmlCv(dHtml($_GET['type']));
            if ($type){
                $this->assign('type_selected',$type);
            }
            $year && $condition['year'] = array('eq',$year);
            $major_name_select && $condition['major'] = array('eq',$major_name_select);
            $type && $condition['type'] = array('eq',$type);
            $condition2['id'] = array('eq',$pid);
            $province = M('province')->where($condition2)->find();
            $pName = $province['province'];
            $this->assign('province_selected',$pName);
            $this->assign('year',$year);
            $pName && $condition['province'] = array('eq',$pName);
            $count = $dao->where($condition)->count();
            $listRows = empty($pageSize) || $pageSize > 100 ? 30 : $pageSize ;
            $p = new page($count, $listRows);
            $dataList = $dao->Order( 'id DESC')->Where($condition)->Limit($p->firstRow.','.$p->listRows)->select();

            /* 分页参数 */
            $conditions = array();
            $conditions['id']=39;
            $year && $conditions['year']=$year;
            $province && $conditions['province']=$pid;
            $mid && $conditions['major']=$mid;
            $type &&$conditions['type']=$type;
            foreach($conditions as $key=>$val) {
                $p->parameter   .= '&'."$key=".urlencode($val);
            }
            $page = $p->show();

            if ($dataList !== false)
            {
                $this->assign('pageBar', $page);
                $this->assign('dataList', $dataList);
            }
        }else{
            $this->assign('msg','省份必选');

        }
        $condition3['category_id'] = array('eq',39);
        $remark = M('remark')->where($condition3)->order('id desc,create_time desc')->find();
        $this->assign('remark',$remark['content']);
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
        $url = "http://10.30.1.170/lqgl/Api/Inquire/getAdmission";

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
}