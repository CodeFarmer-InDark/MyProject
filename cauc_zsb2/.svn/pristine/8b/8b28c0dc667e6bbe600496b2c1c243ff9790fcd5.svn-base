<?php
namespace Home\Controller;
class WxController extends GlobalController {
    protected $AppID;
    protected $AppSecret;
    protected function _initialize()
    {
        //取配置
        if(fileExit('./cms.config.php')){
            $sysConfig = getContent('cms.config.php', '.');
        }else{
            $sysConfig = M('Config')->where('id=1')->find();
        }
        $this->AppID = $sysConfig['appid'];
        $this->AppSecret = $sysConfig['appsecret'];
    }

    public function index()
    {
        //判断是否登录
        if (session('mh_user_info')) {
            $openid = session('mh_user_info');
            $userInfo = D('user')->where(array('openid'=>$openid))->find();
            if ($userInfo) {
                Vendor('jssdk.jssdk');
                $jssdk = new \JSSDK($this->AppID,$this->AppSecret);
                $wx_Config = $jssdk->getSignPackage();
//            print_r($wx_Config);die;
                $this->assign('college',$userInfo['college']);
                $this->assign('wx_Config',$wx_Config);
                $this->assign('kshmsg',I('get.kshmsg'));
                $this->assign('appid',$this->AppID);
                $this->assign('mh_user_roleid',session('mh_user_roleid'));
                $this->display();
            } else {
                session('mh_user_info',null);
                $this->login();
            }
        } else {
            $code = I('get.code');
            if ($code) {
                $WebUser = $this->getWebUser($code);
//                print_r($WebUser);die;
                unset($_GET['code']);
                unset($_GET['state']);
                //没有错误信息
                if (!$WebUser->errcode && $WebUser->openid) {
//                    print_r($WebUser);die;
                    $teacherInfo = D('user')->where(array('openid'=>$WebUser->openid))->find();
                    if ($teacherInfo != false) {
                        session('mh_user_info',$WebUser->openid);
                        //引入类库
                        Vendor('jssdk.jssdk');
                        $jssdk = new \JSSDK($this->AppID,$this->AppSecret);
                        $wx_Config = $jssdk->getSignPackage();
                        $this->assign('wx_Config',$wx_Config);
                        $this->assign('appid',$this->AppID);
                        $this->assign('mh_user_roleid',session('mh_user_roleid'));
                        $this->display();
                    } else {
                        $this->redirect('Wx/login',array('openid'=>$WebUser->openid));
                    }
                }
            } else {
                $url = "http://".$_SERVER['HTTP_HOST'].U('Wx/index');
                $this->OauthUrl($url);
            }
        }
    }

    public function statis()
    {
        //判断是否登录
        if (session('mh_user_info')) {
            /*if(!in_array(session('mh_user_roleid'),array(1,4,5))){
                $this->redirect('Wx/index',array('kshmsg'=>'无权限，操作失败'));
            }*/
            $openid = session('mh_user_info');
            $userInfo = D('user')->where(array('openid'=>$openid))->find();
            if ($userInfo) {

                if(!in_array($userInfo['role_id'],array(1,4,5))){
                    $this->redirect('Wx/index',array('kshmsg'=>'无权限，操作失败'));
                }

                $condition = [];
                $condition['year'] = array('eq',date('Y'));
                $map = [];
                if (session('mh_user_roleid') == 1 || session('mh_user_roleid') == 5){
                    $zyList = M('Zy')->where($condition)->field('zydm,zymc,zyfx')->select();
                    $zyList[] = array('zydm'=>2009,'zymc'=>'预科批','zyfx'=>'');
                }else{
                    if ($userInfo['college'] == 43){
                        $zyList = array(array('zydm'=>1202,'zymc'=>'工商管理类','zyfx'=>''));
                        $map['pc'] = array('eq',6);
                    }elseif($userInfo['college'] == 36){
                        $zyList = array(array('zydm'=>2009,'zymc'=>'预科批','zyfx'=>''));
                    } else{
                        $condition['college'] = array('eq',$userInfo['college']);
                        $zyList = M('Zy')->where($condition)->field('zydm,zymc')->select();
                        $map['pc'] = array('neq',6);
                    }
                }
                if (false != $zyList){
                    $zyArr = [];
                    $final = [];
                    foreach ($zyList as $k=>$v){
                        //$zyArr[$v['zydm']] = ($v['zyfx'] != '')?$v['zymc'].'（'.$v['zyfx'].'）':$v['zymc'];
                        $zyArr[$v['zydm']] = $v['zymc'];
                        $final[$v['zydm']] = $v;
                    }
                    $zydmArr = array_column($zyList,'zydm');
                    $mapJhk = [];
                    if (in_array('1202',$zydmArr)){
                        $zydmArr[] = '120200';
                    }
                    $mapJhk['zydm'] = array('in',$zydmArr);
                    $mapJhk['year'] = array('eq',date('Y'));
                    $jhkList = M('tJhk')->where($mapJhk)->field('zydm,zydh')->select();
                    $jhkArr = [];
                    foreach ($jhkList as $k=>$v){
                        if ($v['zydm'] == 120200){
                            $v['zydm'] = 1202;
                        }
                        $jhkArr[$v['zydh']] = $v['zydm'];
                    }
                    $zydhArr = array_column($jhkList,'zydh');

                    $Model = 't_tdd_final'.date('Y');
                    $filename = strtolower($Model);

                    $map['lqzy'] = array('in',$zydhArr);
                    $dataList = D($filename)->field('id,lqzy,isreport')->where($map)->select();
                    if (false != $dataList){
                        foreach ($dataList as $k=>$v){
                            $dataList[$k]['zydm'] = $jhkArr[$v['lqzy']];
                            $dataList[$k]['zymc'] = $zyArr[$dataList[$k]['zydm']];
                        }

                        $data = [];
                        foreach ($dataList as $k=>$v){
                            $data[$v['zydm']][] = $v;
                        }
                        $final = [];
                        foreach ($data as $k=>$v){
                            foreach ($v as $key=>$val){
                                $final[$k]['name'] = $val['zymc'];
                                $final[$k]['zydm'] = 'zy'.$val['zydm'];
                                $final[$k]['isreport'] = 'status'.$val['isreport'];
                                if ($val['isreport'] == 1){
                                    $final[$k]['num1'] += 1;//未报到
                                }elseif($val['isreport'] == 2){
                                    $final[$k]['num2'] += 1;//报到
                                }elseif($val['isreport'] == 3){
                                    $final[$k]['num3'] += 1;//取消报到
                                }elseif($val['isreport'] == 4){
                                    $final[$k]['num4'] += 1;//请假
                                }elseif($val['isreport'] == 5){
                                    $final[$k]['num5'] += 1;//入伍
                                }elseif($val['isreport'] == 6){
                                    $final[$k]['num6'] += 1;//休学
                                }
                            }
                            $final[$k]['total'] = count($v);
                        }
                        $num1_total = $num2_total = $num3_total = $num4_total = $num5_total = $num6_total = $num_total =0;
                        foreach ($final as $k=>$v){
                            $num1_total += $v['num1'];
                            $num2_total += $v['num2'];
                            $num3_total += $v['num3'];
                            $num4_total += $v['num4'];
                            $num5_total += $v['num5'];
                            $num6_total += $v['num5'];
                            $num_total += $v['total'];
                        }
                        $this->assign('dataList',$final);
                        $this->assign('num1_total',$num1_total);
                        $this->assign('num2_total',$num2_total);
                        $this->assign('num3_total',$num3_total);
                        $this->assign('num4_total',$num4_total);
                        $this->assign('num5_total',$num5_total);
                        $this->assign('num6_total',$num6_total);
                        $this->assign('num_total',$num_total);
                    }
                }
                $this->assign('college',$userInfo['college']);
                $this->assign('mh_user_roleid',session('mh_user_roleid'));
                $this->assign('college',$userInfo['college']);
                $this->assign('mh_user_roleid',session('mh_user_roleid'));
                $this->display();
            } else {
                session('mh_user_info',null);
                $this->login();
            }
        } else {
            $url = "http://".$_SERVER['HTTP_HOST'].U('Wx/index');
            $this->OauthUrl($url);
        }
    }

    /*
     * 学生信息
     */
    public function datalist()
    {
        //判断是否登录
        if (session('mh_user_info')) {
            /*if(!in_array(session('mh_user_roleid'),array(1,4,5))){
                $this->redirect('Wx/index',array('kshmsg'=>'无权限，操作失败'));
            }*/
            $openid = session('mh_user_info');
            $userInfo = D('user')->where(array('openid'=>$openid))->find();
            if ($userInfo) {
                if(!in_array($userInfo['role_id'],array(1,4,5))){
                    $this->redirect('Wx/index',array('kshmsg'=>'无权限，操作失败'));
                }
                $zydm = dHtml(htmlCv(I('get.zydm')));
                $isreport = dHtml(htmlCv(I('get.isreport')));
                $xh = dHtml(htmlCv(I('get.xh')));
                $sfzh = dHtml(htmlCv(I('get.sfzh')));
                if ($zydm){
                    $zydm = substr($zydm,2);
                }
                if ($sfzh){
                    if(!idcard_check($sfzh)){
                        $this->redirect('Wx/datalist',array('kshmsg'=>'请输入正确的身份证号'));
                    }
                }
                if ($isreport){
                    $isreport = substr($isreport,6);
                    if (!in_array($isreport,[1,2,3,4,5,6])){
                        $this->redirect('Wx/datalist',array('kshmsg'=>'操作失败'));
                    }
                }
                $this->assign('zydm',$zydm);
                $this->assign('xh',$xh);
                $this->assign('sfzh',$sfzh);
                $this->assign('isreport',$isreport);

                $condition1 = [];
                $condition1['year'] = array('eq',date('Y'));
                $map = [];
                if (session('mh_user_roleid') == 1 || session('mh_user_roleid') == 5){
                    $zyListAll = M('Zy')->where($condition1)->field('zydm,zymc,zyfx')->select();
                    $zyListAll[] = array('zydm'=>2009,'zymc'=>'预科批','zyfx'=>'');

                    $zydm && $condition1['zydm'] = array('eq',$zydm);
                    if (!$zydm){
                        $zyList = $zyListAll;
                    }else{
                        if ($zydm == 2009){
                            $zyList = array(array('zydm'=>2009,'zymc'=>'预科批','zyfx'=>''));
                        }else{
                            $zyList = M('Zy')->where($condition1)->field('zydm,zymc,zyfx')->select();
                        }
                    }

                    $finalzy = [];
                    foreach ($zyListAll as $k=>$v){
                        $finalzy[$v['zydm']]['zydm'] = $v['zydm'];
                        $finalzy[$v['zydm']]['zymc'] = $v['zymc'];
                    }
                    $this->assign('zyList',$finalzy);
                }else{
                    if ($userInfo['college'] == 43){ //体育部
                        $zyListAll = array(array('zydm'=>1202,'zymc'=>'工商管理类','zyfx'=>''));
                        $map['pc'] = array('eq',6);

                        $zydm && $condition1['zydm'] = array('eq',$zydm);
                        $zyList = $zyListAll;
                    }elseif($userInfo['college'] == 36){ //马克思
                        $zyListAll = array(array('zydm'=>2009,'zymc'=>'预科批','zyfx'=>''));
                        $map['pc'] = array('eq',7);

                        $zydm && $condition1['zydm'] = array('eq',$zydm);
                        $zyList = $zyListAll;
                    } else{
                        $condition1['college'] = array('eq',$userInfo['college']);
                        $zyListAll = M('Zy')->where($condition1)->field('zydm,zymc,zyfx')->select();
                        foreach ($zyListAll as $k=>$v){
                            if ($v['zydm'] == '200900'){
                                $zyListAll[$k]['zydm'] = 2009;
                            }
                        }
                        $map['pc'] = array('neq',6);

                        $zydm && $condition1['zydm'] = array('eq',$zydm);
                        $zyList = M('Zy')->where($condition1)->field('zydm,zymc,zyfx')->select();
                    }
                    $this->assign('zyList',$zyListAll);
                }
                $isreport && $map['isreport'] = array('eq',$isreport);
                if ($xh && $sfzh){
                    $fileName1 = 'info'.date('Y');
                    $db_name1 = C('DB_PREFIX').strtolower($fileName1);
                    $Model = new \Think\Model();
                    $m1 = $Model->query("SHOW TABLES LIKE '%$db_name1%'");
                    if($m1){
                        $thissfzh = D($fileName1)->where(['xh'=>$xh])->getField('sfzh');//根据学号得出身份证号
                        if ($thissfzh){
                            $sfzhArr = array($sfzh,$thissfzh);
                            $map['sfzh'] = array('in',$sfzhArr);
                        }else{
                            $map['sfzh'] = array('eq',110);
                        }
                    }else{
                        $map['sfzh'] = array('eq',110);
                    }
                }elseif($xh){
                    $fileName1 = 'info'.date('Y');
                    $db_name1 = C('DB_PREFIX').strtolower($fileName1);
                    $Model = new \Think\Model();
                    $m1 = $Model->query("SHOW TABLES LIKE '%$db_name1%'");
                    if($m1){
                        $thissfzh = D($fileName1)->where(['xh'=>$xh])->getField('sfzh');//根据学号得出身份证号
                        if ($thissfzh){
                            $map['sfzh'] = array('eq',$thissfzh);
                        }else{
                            $map['sfzh'] = array('eq',110);
                        }
                    }else{
                        $map['sfzh'] = array('eq',110);
                    }
                }elseif($sfzh){
                    $map['sfzh'] = array('eq',$sfzh);
                }

                if (false != $zyList){
                    $zyArr = [];
                    $final = [];
                    foreach ($zyList as $k=>$v){
                        $zyArr[$v['zydm']] = ($v['zyfx'] != '')?$v['zymc'].'（'.$v['zyfx'].'）':$v['zymc'];
                        $final[$v['zydm']] = $v;
                    }
                    $zydmArr = array_column($zyList,'zydm');
                    if ($zydm){
                        if (in_array('1202',$zydmArr)){
                            $zydmArr[] = '120200';
                        }
                        if (!in_array($zydm,$zydmArr)){
                            $this->redirect('Wx/datalist',array('kshmsg'=>'操作失败'));
                        }
                    }else{
                        if (in_array('1202',$zydmArr)){
                            $zydmArr[] = '120200';
                        }
                    }

                    $mapJhk = [];
                    $mapJhk['zydm'] = array('in',$zydmArr);
                    $mapJhk['year'] = array('eq',date('Y'));
                    $jhkList = M('tJhk')->where($mapJhk)->field('year,provinceid,jhxz,zymc,zydm,zydh')->select();
                    $jhkArr = $jhkArr1 = [];
                    foreach ($jhkList as $k=>$v){
                        if ($v['zydm'] == '120200'){
                            $v['zydm'] = 1202;
                        }
                        $jhkArr[$v['zydh']] = $v['zydm'];

                        $jhkArr1[date('Y').'-'.$v['provinceid'].'-'.$v['zydh']]['zydm'] = $v['zydm'];
                        $jhkArr1[date('Y').'-'.$v['provinceid'].'-'.$v['zydh']]['zymc'] = $v['zymc'];
                        $jhkArr1[date('Y').'-'.$v['provinceid'].'-'.$v['zydh']]['jhxz'] = $v['jhxz'];
                    }
                    $zydhArr = array_column($jhkList,'zydh');

                    $Model = 't_tdd_final'.date('Y');
                    $filename = strtolower($Model);
                    $map['lqzy'] = array('in',$zydhArr);
                    $count = D($filename)->where($map)->count();
                    $p = new \Think\Page($count, 20);
                    //分页跳转的时候保证查询条件
                    $zydm && $map1['zydm'] = 'zy'.$zydm;
                    $isreport && $map1['isreport'] = 'status'.$isreport;
                    $xh && $map1['xh'] = $xh;
                    $sfzh && $map1['sfzh'] = $sfzh;
                    foreach($map1 as $key=>$val) {
                        $p->parameter[$key]   =   urlencode($val);
                    }
                    $dataList = D($filename)->field('id,xm,xbdm,sfzh,lqzy,isreport,year,provinceid')->Limit($p->firstRow.','.$p->listRows)->where($map)->select();
                    if (false != $dataList){
                        //根据配置项特殊处理重复专业代码的专业
                        $getConfig = getContent('cms.config.php','.');
                        $special_zydm = explode(',',str_replace('，',',',$getConfig['zyfx']));//配置中特殊项
                        //array_push($special_zydm,'600407','600405');
                        //$zyList_forcorrect = M('Zy')->where(['year'=>date('Y')])->field('zydm,zymc,zyfx')->select();
                        $zyArray_forcorrect = [];
                        foreach ($zyList as $k=>$v){
                            $zyArray_forcorrect[$v['zydm']] = ($v['zyfx'] != '') ? $v['zymc'].'（'.$v['zyfx'].'）' : $v['zymc'];
                        }

                        $fileName1 = 'info'.date('Y');
                        $db_name1 = C('DB_PREFIX').strtolower($fileName1);
                        $Model = new \Think\Model();
                        $m1 = $Model->query("SHOW TABLES LIKE '%$db_name1%'");
                        $xhArr = [];
                        if($m1){
                            $xhList = D($fileName1)->field('sfzh,xh')->select();
                            foreach ($xhList as $k=>$v){
                                $xhArr[$v['sfzh']] = $v['xh'];
                            }
                        }
                        foreach ($dataList as $k=>$v){
                            $dataList[$k]['xh'] = $xhArr[$v['sfzh']];
                            $dataList[$k]['zydm'] = $jhkArr[$v['lqzy']];
                            $lqzy = $jhkArr1[$v['year'].'-'.$v['provinceid'].'-'.$v['lqzy']];
                            $dataList[$k]['zymc'] = $this->correctZynameList($lqzy,$special_zydm,$zyArray_forcorrect);
                        }
                        $page = $p->show();
                        $this->assign('kshmsg',I('get.kshmsg'));
                        $this->assign('pageBar', $page);
                        $this->assign('count',$count);
                        $this->assign('dataList',$dataList);
                    }
                }
                $this->assign('college',$userInfo['college']);
                $this->assign('mh_user_roleid',session('mh_user_roleid'));
                $this->display();
            } else {
                session('mh_user_info',null);
                $this->login();
            }
        } else {
            $url = "http://".$_SERVER['HTTP_HOST'].U('Wx/index');
            $this->OauthUrl($url);
        }
    }

    //学生信息点击跳转详情页
    public function detail()
    {
        if (!in_array(session('mh_user_roleid'),array(1,4,5))){
            $this->redirect('Wx/datalist',array('kshmsg'=>'无权限，操作失败'));
        }
        $sfzh = dHtml(htmlCv(I('get.sfzh')));
        if (!empty($sfzh)) {
            $Model = 't_tdd_final'.date('Y');
            $filename = strtolower($Model);
            $condition = [];
            $condition['sfzh'] = array('eq',$sfzh);
            $info = M($Model)->Table(C('DB_PREFIX')."$filename a")->Join(C('DB_PREFIX').'xbdm b on a.xbdm=b.xbdm')->Join(C('DB_PREFIX').'province c on c.id=a.provinceid')->field('a.id,a.xm,a.sfzh,a.lqzy,a.year,a.provinceid,a.isreport,a.remarks,a.lxdh,a.pc,a.ksh,b.xbmc,c.name as pname')->where($condition)->find();
//            print_r($info);die;
            if ($info == false) {
                $this->redirect('Wx/datalist',array('kshmsg'=>'考生不存在'));
            }
            $major = $info['lqzy'];
            $zy = M('tJhk')->where('year='.$info['year'].' AND provinceid='.$info['provinceid']." AND zydh='$major'")->field('zydm,zymc,jhxz,year,provinceid')->find();
            $info['zyname'] = $this->correctZyname($zy);

            if ($info['pc'] == 6){
                $college = '体育部';
            }elseif($info['pc'] == 7){
                $college = '马克思主义学院
                ';
            } else{
                $mapCollege = [];
                $mapCollege['b.year'] = array('eq',$zy['year']);
                $mapCollege['b.zydm'] = array('eq',$zy['zydm']);
                $college = M('College')->Table(C('DB_PREFIX')."college a")->Join(C('DB_PREFIX').'zy b on a.cid=b.college')->where($mapCollege)->getField('name');
            }
           $info['cname'] = $college?$college:'';

            $globalConfig = getContent('cms.config.php', '.');
            $url = trim($globalConfig['picture_url']);
            //$url = '../kszp/';
            $duoyu = strlen(substr($url, 0, strrpos($url, 'kszp')));
            $trueUrl = substr($url, $duoyu);

            $ksh = $info['ksh'];
            if ($info['provinceid'] == 44){ //广东十位考生号前拼上年份后两位及省份id
                $info['path'] = 'http://www.cauc.edu.cn/lqgl'. '/' . $trueUrl . $info['year'] . '/' . $info['provinceid'] . '/' . substr( $info['year'],2,2).$info['provinceid'].$ksh . '.jpg';
            }else{
                $info['path'] = 'http://www.cauc.edu.cn/lqgl'. '/' . $trueUrl . $info['year'] . '/' . $info['provinceid'] . '/' . $ksh . '.jpg';
            }

            //班级学号信息
            $fileName_info = 'info'.$info['year'];
            $db_name_info = C('DB_PREFIX').strtolower($fileName_info);
            $Model = new \Think\Model();
            $m_info = $Model->query("SHOW TABLES LIKE '%$db_name_info%'");
            if($m_info){
                $daoInfo = D($fileName_info);
                $infoArr = $daoInfo->where(['sfzh'=>$info['sfzh']])->field('xh')->find();
                $info['xh'] = $infoArr['xh'];
            }
            $this->assign('mh_user_roleid',session('mh_user_roleid'));
            $this->assign('info',$info);
            $this->display();
        }

    }

    //登录页
    public function login()
    {
        $openid = I('get.openid');
        if ($openid) {
            $this->assign('openid',$openid);
            $this->display();
        }else {
            $url = "http://".$_SERVER['HTTP_HOST'].U('Wx/index');
            $this->OauthUrl($url);
        }
    }

    //学生信息页
    public function info()
    {
        if (session('mh_user_info')) {
            $openid = session('mh_user_info');
            $userInfo = D('user')->where(array('openid'=>$openid))->find();
            if ($userInfo) {
                $result = I('post.result');
                $ksh = aes256cbcDecrypt($result);
                if (!empty($result)) {
                    $Model = 't_tdd_final'.date('Y');
                    $filename = strtolower($Model);

                    $condition = [];
                    $condition['ksh'] = array('eq',$ksh);
                    $info = M($Model)->Table(C('DB_PREFIX')."$filename a")->Join(C('DB_PREFIX').'xbdm b on a.xbdm=b.xbdm')->Join(C('DB_PREFIX').'province c on c.id=a.provinceid')->field('a.id,a.xm,a.sfzh,a.lqzy,a.year,a.provinceid,a.isreport,a.remarks,a.lxdh,b.xbmc,c.name as pname')->where($condition)->find();
//            print_r($info);die;
                    if ($info == false) {
                        $this->redirect('Wx/index',array('kshmsg'=>'考生号不存在'));
                    }
                    $info['ksh'] = $ksh;
                    $major = $info['lqzy'];
                    $zy = M('tJhk')->where('year='.$info['year'].' AND provinceid='.$info['provinceid']." AND zydh='$major'")->field('zydm,zymc,jhxz,year,provinceid')->find();
                    $info['zyname'] = $this->correctZyname($zy);

                    $mapCollege = [];
                    $mapCollege['b.year'] = array('eq',$zy['year']);
                    $mapCollege['b.zydm'] = array('eq',$zy['zydm']);
                    $college = M('College')->Table(C('DB_PREFIX')."college a")->Join(C('DB_PREFIX').'zy b on a.cid=b.college')->where($mapCollege)->getField('name');
                    $info['cname'] = $college?$college:'';

                    $globalConfig = getContent('cms.config.php', '.');
                    $url = trim($globalConfig['picture_url']);
                    //$url = '../kszp/';
                    $duoyu = strlen(substr($url, 0, strrpos($url, 'kszp')));
                    $trueUrl = substr($url, $duoyu);

                    if ($info['provinceid'] == 44){ //广东十位考生号前拼上年份后两位及省份id
                        $info['path'] = 'http://www.cauc.edu.cn/lqgl'. '/' . $trueUrl . $info['year'] . '/' . $info['provinceid'] . '/' . substr( $info['year'],2,2).$info['provinceid'].$ksh . '.jpg';
                    }else{
                        $info['path'] = 'http://www.cauc.edu.cn/lqgl'. '/' . $trueUrl . $info['year'] . '/' . $info['provinceid'] . '/' . $ksh . '.jpg';
                    }

                    //班级学号信息
                    $fileName_info = 'info'.$info['year'];
                    $db_name_info = C('DB_PREFIX').strtolower($fileName_info);
                    $Model = new \Think\Model();
                    $m_info = $Model->query("SHOW TABLES LIKE '%$db_name_info%'");
                    if($m_info){
                        $daoInfo = D($fileName_info);
                        $infoArr = $daoInfo->where(['sfzh'=>$info['sfzh']])->field('xh')->find();
                        $info['xh'] = $infoArr['xh'];
                    }
                    $this->assign('mh_user_roleid',session('mh_user_roleid'));
                    $this->assign('info',$info);

                    Vendor('jssdk.jssdk');
                    $jssdk = new \JSSDK($this->AppID,$this->AppSecret);
                    $wx_Config = $jssdk->getSignPackage();
                    $this->assign('college',$userInfo['college']);
                    $this->assign('wx_Config',$wx_Config);
                    $this->assign('kshmsg',I('get.kshmsg'));
                    $this->assign('appid',$this->AppID);
                    $this->assign('mh_user_roleid',session('mh_user_roleid'));
                    $this->display();
                }
            } else {
                session('mh_user_info',null);
                $this->login();
            }
        }
    }

    //生成正确专业名称
    public function correctZyname($zy){
        //根据配置项特殊处理重复专业代码的专业
        $getConfig = getContent('cms.config.php','.');
        $special_zydm = explode(',',str_replace('，',',',$getConfig['zyfx']));//配置中特殊项
        if (in_array($zy['zydm'],$special_zydm)){
            if ($zy['zydm'] == '600409'){
                $zy['zymc'] = str_replace('（','(',$zy['zymc']);
                $temp = explode('(',$zy['zymc']);
                if(strstr($zy['zymc'],'直升机')){
                    $zyname = is_null($temp[0])?'':$temp[0].'（直升机）';
                }else{
                    $zyname = is_null($temp[0])?'':$temp[0];
                }
            }else{
                $zyname = $zy['zymc'];
            }

        }else{
            $condition = [];
            $condition['year'] = $zy['year'];
            if ($zy['zydm'] == '120200'){
                $zy['zydm'] = 1202;
            }
            $condition['zydm'] = $zy['zydm'];
            $zymc = M('Zy')->where($condition)->field('zymc,zyfx')->find();
            if ($zymc['zyfx'] != ''){
                $zyname = $zymc['zymc'].'('.$zymc['zyfx'].')';
            }else{
                $zyname = $zymc['zymc'];
            }
        }
        if (($zy['provinceid'] == 15 and $zy['jhxz'] == 1) OR (strstr($zy['zymc'],'定向'))){
            $zyname = str_replace('定向','',$zyname);
            $zyname = $zyname.'（定向）';
        }
        return $zyname;
    }

    //生成正确专业名称
    public function correctZynameList($zy,$special_zydm,$zyArray){
        if (in_array($zy['zydm'],array('600407','600405'))){
            $zy['zymc'] = str_replace('（','(',$zy['zymc']);
            $temp = explode('(',$zy['zymc']);
            $zyname = is_null($temp[0])?'':$temp[0];
        }else{
            if (in_array($zy['zydm'],$special_zydm)){
                if ($zy['zydm'] == '600409'){
                    $zy['zymc'] = str_replace('（','(',$zy['zymc']);
                    $temp = explode('(',$zy['zymc']);
                    if(strstr($zy['zymc'],'直升机')){
                        $zyname = is_null($temp[0])?'':$temp[0].'（直升机）';
                    }else{
                        $zyname = is_null($temp[0])?'':$temp[0];
                    }
                }else{
                    $zyname = $zy['zymc'];
                }

            }else{
                if ($zy['zydm'] == '120200'){
                    $zy['zydm'] = 1202;
                }
                $zyname = $zyArray[$zy['zydm']];
            }
            if (($zy['provinceid'] == 15 and $zy['jhxz'] == 1) OR (strstr($zy['zymc'],'定向'))){
                $zyname = str_replace('定向','',$zyname);
                $zyname = $zyname.'（定向）';
            }
        }
        return $zyname;
    }

    public function doLogin()
    {
        //$user_name = I('post.user_name');
        //$user_pass = I('post.user_pass');
        $user_name = $_POST['user_name'];
        $user_pass = $_POST['user_pass'];
        $sms_code = I('post.sms_code');
        $openid = I('post.openid');
        $ldap['user'] = $user_name;
        $ldap['pass'] = $user_pass;
        $ldap['host'] = 'ldap://10.3.1.13';
        $ldap['dn'] = $ldap['user'].'@cauc.edu.cn';
        $ldap['base'] = 'ou=CAUC,dc=cauc,dc=edu,dc=cn';
        // connecting to ldap
        $ldap['conn'] = ldap_connect($ldap['host']) or die( "Could not connect to server {$ldap['host']} ");
        // binding to ldap
        $ldap['bind'] = ldap_bind( $ldap['conn'], $ldap['dn'], $ldap['pass'] );
        if( !$ldap['bind'] ){
            $code = -1;
            $msg = '用户信息不存在';
            $info = array();
        }else{
            $code = -1;
            $msg = '参数错误';
            $info = array();
            if ($user_name && $sms_code && $openid) {
                $check_verify = check_verify($sms_code);//检查验证码
                $msg = '验证码错误';
                if ($check_verify) {
                    $where = array('role_id'=>array('in',array(1,4,5,20)));
                    $where['username'] = $user_name;
                    $teacherInfo = M('user')->where($where)->find();
                    $msg = '该账号已绑定';
                    if (empty($teacherInfo['openid'])) {
                        $code = 1;
                        $msg = '登录成功';
                        $info['url'] = U('Wx/index');
                        M('user')->where($where)->setField('openid',$openid);
                        session('mh_user_info',$openid);
                        session('mh_user_roleid',$teacherInfo['role_id']);
                    }
                }
            }
        }
        $this->ApiReturn($code,$msg,$info);
    }

    public function confirmationReport()
    {
        $id = I('post.id',0,'intval');
        $ksh = dHtml(htmlCv(I('post.ksh')));
        if ($id && $ksh) {
            $Model = 't_tdd_final'.date('Y');
            if (M($Model)->where(array('id'=>$id))->setField('isreport',2)) {
                $openid = session('mh_user_info');
                $userid = D('user')->where(array('openid'=>$openid))->field('id,username')->find();
                parent::_sysLog('update', "{$id}-2",$userid['id'],$userid['username']);
                $this->ApiReturn(1,'报到成功');
            }else{
                $this->ApiReturn(1,'操作失败');
            }
        }
    }
    public function cancelReport()
    {
        if (!in_array(session('mh_user_roleid'),array(1,4,5))){
            $this->ApiReturn(-1,'无权限，操作失败');
        }
        $id = I('post.id',0,'intval');
        $remarks = dHtml(htmlCv(I('post.remarks')));
        $ksh = dHtml(htmlCv(I('post.ksh')));
        if ($id && $ksh) {
            $ksh_length = strlen($ksh);
            if ($ksh_length == 14){
                $thisKshYear = substr(date('Y'),0,2).substr($ksh,0,2); //当前年前两位拼上考生号前两位（14位考生号前两位为年份后两位）
                $Model = 't_tdd_final'.$thisKshYear;
            }else{
                $Model = 't_tdd_final'.date('Y');
            }
            $save = array('isreport'=>3,'remarks'=>$remarks);
            if (M($Model)->where(array('id'=>$id))->setField($save)) {
                $roleid = session('mh_user_roleid');
                self::_sysLog('update', "{$roleid}-{$ksh}-3");
                $this->ApiReturn(1,'取消报到成功');
            }else{
                $this->ApiReturn(-1,'操作失败');
            }
        }
    }
    /*
     * 学生详情页更新报到状态
     */
    public function updateReport()
    {
        if (!in_array(session('mh_user_roleid'),array(1,4,5))){
            $this->ApiReturn(-1,'无权限，操作失败');
        }
        $id = I('post.id',0,'intval');
        $isreport = I('post.isreport',0,'intval');
        if (!in_array($isreport,[1,2,3,4,5,6])){
            $this->ApiReturn(1,'操作失败');
        }
        if ($id && $isreport) {
            $Model = 't_tdd_final'.date('Y');
            if (M($Model)->where(array('id'=>$id))->setField('isreport',$isreport)) {
                $openid = session('mh_user_info');
                $userid = D('user')->where(array('openid'=>$openid))->field('id,username')->find();
                parent::_sysLog('update', "{$id}-{$isreport}",$userid['id'],$userid['username']);
                $this->ApiReturn(1,'操作成功');
            }else{
                $this->ApiReturn(1,'操作失败');
            }
        }

    }

    /**
     * 微信用户授权
     * @param $url string 授权后重定向的回调链接地址， 请使用 urlEncode 对链接进行处理
     * @param $scope string 应用授权作用域，snsapi_base （不弹出授权页面，直接跳转，只能获取用户openid），snsapi_userinfo （弹出授权页面，可通过openid拿到昵称、性别、所在地。并且， 即使在未关注的情况下，只要用户授权，也能获取其信息 ）
     */
    public function OauthUrl($url,$scope = 'snsapi_base')
    {
        //把地址转换成授权地址
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->AppID."&redirect_uri=".urlencode($url)."&response_type=code&scope=".$scope."&state=1#wechat_redirect";
//        print_r($url);die;
        header('Location: '.$url);exit();
    }

    /**
     * 换取access_token && openid
     * @param $code string
     * @return mixed|object
     */
    public function getWebUser($code)
    {
        //换取access_token && openid
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->AppID."&secret=".$this->AppSecret."&code=".$code."&grant_type=authorization_code";
        $re=json_decode($this->sendMsg($url,''));
        \Think\Log::write('IndexController::getWebUser:'.json_encode($re));
        return $re;
    }

    /**
     * 获取微信用户信息
     * @param $access_token string
     * @param $openId string
     * @return mixed|array
     */
    public function getUserInfo($access_token,$openId){
        //get
        $url="https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openId."&lang=zh_CN";
        $re=json_decode($this->sendMsg($url,''),true);
        \Think\Log::write('re2'.json_encode($re));
        return $re;

    }

    /**
     * 提交数据
     * @param $url string 请求地址
     * @param $data array 数据包
     * @return mixed|object
     */
    public function sendMsg($url,$data)
    {
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
    /**
     * 验证码
     *
     */
    public function verify()
    {
        $length=4;
        if (isset($_GET['length']) && intval($_GET['length'])>2){
            $length = intval($_GET['length']);
        }

        //设置验证码字符库
        $code_set="";
        if(!empty($_GET['charset'])){
            $mletters=str_split($_GET['charset']);
            $mletters=array_unique($mletters);
            if(count($mletters)>5){
                $code_set= trim($_GET['charset']);
            }
        }
        $use_noise=1;
        if(isset($_GET['use_noise'])){
            $use_noise= intval($_GET['use_noise']);
        }

        $use_curve=1;
        if(isset($_GET['use_curve'])){
            $use_curve= intval($_GET['use_curve']);
        }

        $font_size=25;
        if (isset($_GET['font_size']) && intval($_GET['font_size'])){
            $font_size = intval($_GET['font_size']);
        }

        $width=0;
        if (isset($_GET['width']) && intval($_GET['width'])){
            $width = intval($_GET['width']);
        }

        $height=0;

        if (isset($_GET['height']) && intval($_GET['height'])){
            $height = intval($_GET['height']);
        }

        $background=array(243, 251, 254);
        if (isset($_GET['background'])){
            $mbackground=array_map('intval', explode(',', $_GET['background']));
            if(count($mbackground)>2 && $mbackground[0]<=255 && $mbackground[1]<=255 && $mbackground[2]<=255){
                $background=array( $mbackground[0],$mbackground[1],$mbackground[2] );
            }
        }

        $config = array(
            'codeSet'   =>  !empty($code_set)?$code_set:"2345678901",             // 验证码字符集合
            'expire'    =>  1800,            // 验证码过期时间（s）
            'useImgBg'  =>  false,           // 使用背景图片
            'fontSize'  =>  !empty($font_size)?$font_size:25,              // 验证码字体大小(px)
            'useCurve'  =>  $use_curve===0?false:true,           // 是否画混淆曲线
            'useNoise'  =>  $use_noise===0?false:true,            // 是否添加杂点
            'imageH'    =>  $height,               // 验证码图片高度
            'imageW'    =>  $width,               // 验证码图片宽度
            'length'    =>  !empty($length)?$length:4,               // 验证码位数
            'bg'        =>  $background,  // 背景颜色
            'reset'     =>  true,           // 验证成功后是否重置
        );
        ob_clean();
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }
}