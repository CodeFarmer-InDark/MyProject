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

class PrintController extends HomeBaseController
{
    public $dao;
    function _initialize()
    {
        parent::_initialize();
//        $allow_origin = array(
//            'http://www.cauc.edu.cn/zsb',
//            'http://localhost/cauc_zsb2/zsb',
//        );
//        $allow_origin = 'http://www.cauc.edu.cn/zsb';
//        header('Access-Control-Allow-Origin:'.$allow_origin);   // 指定允许其他域名访问
//        header('Access-Control-Allow-Headers:x-requested-with,content-type');// 响应头设置
//        header('Access-Control-Allow-Methods: GET, POST, PUT');
    }

    /**
     * 登陆
     *
     */
    public function login(){
        $username = dHtml(htmlCv(trim(I('post.username'))));
        $password = dHtml(htmlCv(trim(I('post.password'))));

        if(empty($username) || empty($password)){
            $res['code'] = 0;
            $res['msg'] = '用户名，密码必须填写';
            $this->ajaxReturn($res,'JSON');
        }
        // LDAP variables
        /*$ldap['user'] = $username;
        $ldap['pass'] = $password;
        $ldap['host'] = 'ldap://10.3.1.13';
        $ldap['dn'] = $ldap['user'].'@cauc.edu.cn';
        $ldap['base'] = 'ou=CAUC,dc=cauc,dc=edu,dc=cn';

        // connecting to ldap
        $ldap['conn'] = ldap_connect($ldap['host']) or die( "Could not connect to server {$ldap['host']} ");

        // binding to ldap
        $ldap['bind'] = ldap_bind( $ldap['conn'], $ldap['dn'], $ldap['pass'] );
        if( !$ldap['bind'] ){
            $res['code'] = 0;
            $res['msg'] = '用户信息不存在，登录失败';
        }else{*/
            $condition = array();
            $dao = D('User');
            $condition["username"] = $username;
            $record = $dao->where($condition)->find();
            if(false == $record)
            {
                $res['code'] = 0;
                $res['msg'] = '用户信息不存在，登录失败';
            }else{
                if ($record['role_id'] == 2 || $record['status'] == 2) {
                    $res['code'] = 0;
                    $res['msg'] = '当前用户被限制登录，请联系管理员';
                    $this->ajaxReturn($res,'JSON');
                }
                $roleDao = D('Role');
                $getRole = $roleDao->where("id={$record['role_id']}")->find();
                if(empty($getRole)){
                    $res['code'] = 0;
                    $res['msg'] = '角色组不存在，请联系管理员';
                    $this->ajaxReturn($res,'JSON');
                }
                if($record['role_id'] == 7 || $record['role_id'] == 1){ //打印管理员组
                    $dao = D('User');
                    $data = array();
                    $data['id'] = intval($record['id']);
                    $data['last_login_time'] = time();
                    $data['last_ip'] = get_client_ip();
                    $data['login_count'] = array('exp','login_count+1');
                    $dao->save($data);

                    $res['code'] = 1;
                    $res['msg'] = '登陆成功';

                }else{
                    $res['code'] = 0;
                    $res['msg'] = '当前用户无相关操作权限，请联系管理员';
                }
            //}
        }
        self::_sysLog('login');
        $this->ajaxReturn($res,'JSON');
    }

    /**
     * 获取批次下拉
     */
    public function getPc(){
        $pc = M('Pc')->field('id,pc')->select();
        if (false != $pc){
            $temp = array('id'=>0,'pc'=>'不限');
            $pc[0] = $temp;
            $res['code'] = 1;
            $res['pcList'] = $pc;
        }else{
            $res['code'] = 2;
            $res['pcList'] = '';
        }
        $this->ajaxReturn($res,'JSON');
    }

    public function showZyname($zy){//$zy包含year、provinceid、zydm、zymc、jhxz
        //根据配置项特殊处理重复专业代码的专业
        $getConfig = getContent('cms.config.php','.');
        $special_zydm = explode(',',str_replace('，',',',$getConfig['zyfx']));//配置中特殊项
        if (in_array($zy['zydm'],$special_zydm)){
            $zyname = $zy['zymc'];
        }else{
            $zymc = str_replace('（','(',$zy['zymc']);
            $zymc =  str_replace('）',')',$zymc);
            $temp = explode('(',$zymc);
            $zyname = is_null($temp[0])?'':$temp[0];
        }
        if ($zy['provinceid'] == 65){ //删除新疆专业名称后特殊#e#h
            if (mb_substr(mb_substr($zyname,-2),0,1) == '#'){
                $zyname = mb_substr(mb_substr($zyname,0,-1),0,-1);
            }
        }
        if ((strstr($zy['zymc'],'定向')) OR ($zy['provinceid'] == 15 and $zy['jhxz'] == 1)){//定向
            $zyname = str_replace('定向','',$zyname);
            $zyname = $zyname.'（定向）';
        }
        //判断专业名称前是否有 国家专项|
        if (mb_substr($zyname,0,5) == '国家专项|'){
            $zyname = mb_substr($zyname,5);
        }
        return $zyname;
    }

    /*
     * 获取学生信息
     */
    public function getStudentData(){
        $year = intval(I('post.year'));
        $source_id = intval(I('post.source_id'));
        $print_state = intval(I('post.print_state'));
        $assign_state = intval(I('post.assign_state')); //0全部1分配2未分配
        $express_state = intval(I('post.express_state'));//面单是否打印
        $pc = intval(I('post.pc'));

        if ($year){
            $fileName = 'T_tdd_final'.$year;
            $db_name = C('DB_PREFIX').strtolower($fileName);
            $Model = new \Think\Model();
            $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
            if($m){
                $dao = D($fileName);
                $condition = [];
                $condition['year'] = array('eq',$year);
                $source_id && $condition['provinceid'] = array('eq',$source_id);
                $pc && $condition['pc'] = array('eq',$pc);

                //对应招生系统状态
                switch ($print_state){
                    case 1:$pstatus = 1;break;
                    case 2:$pstatus = 0;break;}
                $print_state && $condition['tzssfdy'] = array('eq',$pstatus);

                switch ($assign_state){
                    case 1:$condition['mdh'] = array('neq','');break;
                    case 2:$condition['mdh'] = array('eq','');break;
                }
                switch ($express_state){
                    case 1:$estatus = 1;break;
                    case 2:$estatus = 0;break;}
                $express_state && $condition['mdsfdy'] = array('eq',$estatus);

                $provinceArr = M('Province')->field('id,name')->select();
                $provinceArr[99]['id'] = 99;
                $provinceArr[99]['name'] = '港澳台';
                $province = [];
                foreach ($provinceArr as $k=>$v){
                    $province[$v['id']] = $v['name'];
                }
                $result = $dao->where($condition)->field('id,xm,ksh,jtdz,mdh,mdsfdy,tzssfdy,sjr,lxsj,lxdh,lqzy,provinceid,yzbm')->order('ksh asc,lqzy asc')->select();
                foreach ($result as $key=>$val){
                    if ($val['sjr'] == ''){
                        $result[$key]['sjr'] = $val['xm'];
                    }
                    $result[$key]['name'] = $province[$val['provinceid']];

                    $major = $val['lqzy'];
                    $zy = M('tJhk')->where('year='.$year.' AND provinceid='.$val['provinceid']." AND zydh='$major'")->field('year,provinceid,jhxz,zydm,zymc')->find();
                    $zyname = $this->showZyname($zy);
                    /*$zy = M('tJhk')->where('year='.$year.' AND provinceid='.$val['provinceid']." AND zydh='$major'")->getField('zymc');
                    $zydm = M('tJhk')->where('year='.$year.' AND provinceid='.$val['provinceid']." AND zydh='$major'")->getField('zydm');
                    if ($zydm == '600409'){
                        $tempZymc = $zy;
                    }else{
                        $zymc = str_replace('（','(',$zy);
                        $zymc =  str_replace('）',')',$zymc);
                        $temp = explode('(',$zymc);
                        $tempZymc = is_null($temp[0])?'':$temp[0];
                    }

                    if ($val['provinceid'] == 65){ //删除新疆专业名称后特殊#e#h
                        if (mb_substr(mb_substr($tempZymc,-2),0,1) == '#'){
                            $tempZymc = mb_substr(mb_substr($tempZymc,0,-1),0,-1);
                        }
                    }
                    //判断专业名称前是否有 国家专项|
                    if (mb_substr($tempZymc,0,5) == '国家专项|'){
                        $tempZymc = mb_substr($tempZymc,5);
                    }
                    $result[$key]['zymc'] = $tempZymc;*/
                    $result[$key]['zymc'] = $zyname;

                    unset($result[$key]['provinceid']);
                    unset($result[$key]['lqzy']);
                }
            }else{
                $result = [];
            }
        }else{
            $result = [];
        }
        self::_sysLog('index');
        $this->ajaxReturn($result,'JSON');
    }

    /**
     * 根据省份id获取学生数量
     */
    public function getStudentCount(){
        $year = intval(I('post.year'));
        $source_id = intval(I('post.source_id'));
        $pc = intval(I('post.pc'));
        $print_state = intval(I('post.print_state'));
        $assign_state = intval(I('post.assign_state')); //0全部1分配2未分配
        $express_state = intval(I('post.express_state'));//面单是否打印

        if ($year){
            $fileName = 'T_tdd_final'.$year;
            $db_name = C('DB_PREFIX').strtolower($fileName);
            $Model = new \Think\Model();
            $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
            if($m){
                $dao = D($fileName);
                $condition = [];
                $condition['year'] = array('eq',$year);
                $source_id && $condition['provinceid'] = array('eq',$source_id);
                $pc && $condition['pc'] = array('eq',$pc);

                //对应招生系统状态
                switch ($print_state){
                    case 1:$pstatus = 1;break;
                    case 2:$pstatus = 0;break;}
                $print_state && $condition['tzssfdy'] = array('eq',$pstatus);

                switch ($assign_state){
                    case 1:$condition['mdh'] = array('neq','');break;
                    case 2:$condition['mdh'] = array('eq','');break;
                }
                switch ($express_state){
                    case 1:$estatus = 1;break;
                    case 2:$estatus = 0;break;}
                $express_state && $condition['mdsfdy'] = array('eq',$estatus);

                $result = $dao->where($condition)->count();
                $res['count'] = $result;
            }else{
                $res['count'] = 0;
            }
        }else{
            $res['count'] = 0;
        }
        self::_sysLog('index');
        $this->ajaxReturn($res,'JSON');
    }

    /*
    * 根据考生id获取学生信息
    */
    public function getStudentByID(){
        $student_id = intval(I('post.id'));
        $year = intval(I('post.year'));

        $fileName = 'T_tdd_final'.$year;
        $db_name = C('DB_PREFIX').strtolower($fileName);
        $Model = new \Think\Model();
        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
        if($m){
            $dao = D($fileName);
            $condition = [];
            $condition['id'] = array('eq',$student_id);
            $result = $dao->where($condition)->field('id,xm,ksh,jtdz,lqzy,provinceid,sjr,lxsj,lxdh,yzbm')->select();
            if (false != $result){
                foreach ($result as $key=>$val){
                    if ($val['sjr'] == ''){
                        $result[$key]['sjr'] = $val['xm'];
                    }
                    $major = $val['lqzy'];
                    $zy = M('tJhk')->where('year='.$year.' AND provinceid='.$val['provinceid']." AND zydh='$major'")->field('year,provinceid,jhxz,zydm,zymc')->find();
                    $zyname = $this->showZyname($zy);
                    $result[$key]['zymc'] = $zyname;
                    //$result[$key]['zymc'] = is_null($temp[0])?'':$temp[0];

                    unset($result[$key]['provinceid']);
                    unset($result[$key]['lqzy']);
                }
            }else{
                $result = [];
            }
        }else{
            $result = [];
        }
        self::_sysLog('index');
        $this->ajaxReturn($result,'JSON');
    }

    /*
     * 分页查找学生信息
     */
    public function searchStudentData(){
        $year = intval(I('post.year'));
        $source_id = intval(I('post.source_id'));
        $page = intval(I('post.page'));
        $pc = intval(I('post.pc'));
        $print_state = intval(I('post.print_state'));
        $assign_state = intval(I('post.assign_state')); //0全部1分配2未分配
        $express_state = intval(I('post.express_state'));//面单是否打印
        $pageSize = intval(I('post.page_size'));
        $listRows = empty($pageSize) ? 50 : $pageSize ;

        if ($year){
            $fileName = 'T_tdd_final'.$year;
            $db_name = C('DB_PREFIX').strtolower($fileName);
            $Model = new \Think\Model();
            $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
            if($m){
                $dao = D($fileName);
                $condition = [];
                $condition['year'] = array('eq',$year);
                $source_id && $condition['provinceid'] = array('eq',$source_id);
                $pc && $condition['pc'] = array('eq',$pc);

                //对应招生系统状态
                switch ($print_state){
                    case 1:$pstatus = 1;break;
                    case 2:$pstatus = 0;break;}
                $print_state && $condition['tzssfdy'] = array('eq',$pstatus);

                switch ($assign_state){
                    case 1:$condition['mdh'] = array('neq','');break;
                    case 2:$condition['mdh'] = array('eq','');break;
                }
                switch ($express_state){
                    case 1:$estatus = 1;break;
                    case 2:$estatus = 0;break;}
                $express_state && $condition['mdsfdy'] = array('eq',$estatus);

                $provinceArr = M('Province')->field('id,name')->select();
                $provinceArr[99]['id'] = 99;
                $provinceArr[99]['name'] = '港澳台';
                $province = [];
                foreach ($provinceArr as $k=>$v){
                    $province[$v['id']] = $v['name'];
                }

                $nowPage = empty($page) ? 1 : $page;
                $nowPage = $nowPage > 0 ? $nowPage : 1;
                $firstRow = $listRows * ($nowPage - 1);
                $result = $dao->where($condition)->field('id,xm,ksh,jtdz,mdh,mdsfdy,tzssfdy,sjr,lxsj,lxdh,lqzy,provinceid,yzbm')->order('ksh asc,lqzy asc')->Limit($firstRow.','.$listRows)->select();
                if (false != $result){
                    foreach ($result as $key=>$val){
                        if ($val['sjr'] == ''){
                            $result[$key]['sjr'] = $val['xm'];
                        }
                        $result[$key]['name'] = $province[$val['provinceid']];
                        $result[$key]['pid'] = $val['provinceid'];

                        $major = $val['lqzy'];
                        $zy = M('tJhk')->where('year='.$year.' AND provinceid='.$val['provinceid']." AND zydh='$major'")->field('year,provinceid,jhxz,zydm,zymc')->find();
                        $zyname = $this->showZyname($zy);
                        $result[$key]['zymc'] = $zyname;
                        //$result[$key]['zymc'] = is_null($temp[0])?'':$temp[0];

                        unset($result[$key]['provinceid']);
                        unset($result[$key]['lqzy']);
                    }
                }else{
                    $result = [];
                }
            }else{
                $result = [];
            }
        }else{
            $result = [];
        }
        self::_sysLog('index');
        $this->ajaxReturn($result,'JSON');
    }

    /**
     * 获取省份信息
     */
    public function getSourcePlace()
    {
        $result = M('Province')->where('id <> 0')->field('id,name')->select();
        if (false == $result){
            $res = [];
        }else{
            $temp = array(array('id'=>0,'name'=>'不限'));
            $res = array_merge($temp,$result);
            $temp1 = array('id'=>99,'name'=>'港澳台');
            $res[] = $temp1;
        }
      
        self::_sysLog('index');
        $this->ajaxReturn($res, 'JSON');
    }

    /**
     * 获取面单信息
     */
    public function searchExpressInfo(){
        $status = intval(I('post.status'));
        $page = intval(I('post.page'));
        $page_size = intval(I('post.page_size'));
        
        $listRows = empty($page_size) ? 20 : $page_size ;
        //对应招生系统状态
        switch ($status){
            case 1:$md_status = 1;break;
            case 2:$md_status = 0;break;}
        $status && $condition['sfysy'] = array('eq',$md_status);

        $nowPage = empty($page) ? 1 : $page;
        $nowPage = $nowPage > 0 ? $nowPage : 1;
        $firstRow = $listRows * ($nowPage - 1);
        $result = M('Md')->Where($condition)->Order('id desc')->Limit($firstRow.','.$listRows)->select();
        if (false == $result){
            $result = [];
        }
        self::_sysLog('index');
        $this->ajaxReturn($result,'JSON');
    }

    /**
     * 获取面单数量
     */
    public function getExpressCount(){
        $status = intval(I('post.status'));
        //对应招生系统状态
        switch ($status){
            case 1:$md_status = 1;break;
            case 2:$md_status = 0;break;}
        $status && $condition['sfysy'] = array('eq',$md_status);
        $result = M('Md')->Where($condition)->count();
        $res['count'] = $result;
        $this->ajaxReturn($res,'JSON');
    }

    /**
     * 检查面单是否已存在(t_tdd)
     * return 0存在 1不存在
     */
    public function isExpNoExits(){
        $express_no = I('post.express_no');
        $condition = [];
        $condition['mdh'] = array('eq',$express_no);
        $result = M('Md')->where($condition)->field('mdh')->select();
        if (false != $result){
            $res['code'] = 0;
        }else{
            $res['code'] = 1;
        }
        $this->ajaxReturn($res,'JSON');
    }

    /**
     * 新增面单信息
     * return 1添加成功 0失败
     */
    public function addExpressInfo(){
        $express_no = dHtml(htmlCv(I('post.express_no')));
        $data = [];
        $data['mdh'] = $express_no;
        $data['sfysy'] = 0;
        $data['id'] = $express_no;
        $daoAdd = M('Md')->add($data);
        if (false != $daoAdd){
            $res['code'] = 1;
        }else{
            $res['code'] = 0;
        }
        self::_sysLog('insert');
        $this->ajaxReturn($res,'JSON');
    }

    /**
     * 分配面单号
     */
    public function assignStudentExpressNo(){
        $student_no = I('post.student_no'); //考生号数组
        $year = intval(I('post.year'));

        $studentArr = explode(',',$student_no);

        $count = 0;
        $fileName = 'result'.$year;
        $db_name = C('DB_PREFIX').strtolower($fileName);
        $Model = new \Think\Model();
        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");

        $fileName1 = 't_tdd_final'.$year;
        $db_name1 = C('DB_PREFIX').strtolower($fileName1);
        $m1 = $Model->query("SHOW TABLES LIKE '%$db_name1%'");
        if($m && $m1){
            $dao = D($fileName);
            $daoFinal = D($fileName1);
            $condition = [];
            $condition['ksh'] = array('in',$studentArr);
            $condition['year'] = array('eq',$year);
            $studentList = $daoFinal->where($condition)->field('ksh')->select();

            if (false != $studentList){
                $studentcount = count($studentList);
                $mdList = M('Md')->where('sfysy = 0')->field('id,mdh')->limit($studentcount)->select(); //取出数量等于学生数的未使用面单号
                $finalStudent = array_values($studentList);
                $finalMd = array_values($mdList);

                foreach ($finalMd as $k=>$v){
                    $data = [];
                    $data['mdh'] = $v['mdh'];
                    $thisStudent = $daoFinal->where('ksh = '.$finalStudent[$k]['ksh'])->field('provinceid,pc')->find();
                    if ($thisStudent['provinceid'] == 99 || $thisStudent['pc'] == 7){//港澳台及预科
                        $daoSaveFinal = $daoFinal->where('ksh = '.$finalStudent[$k]['ksh'])->save($data);
                        $update = [];
                        $update['sfysy'] = 1;
                        $daoSaveMd = M('Md')->where('id = '.$v['id'])->save($update);
                        if (false != $daoSaveMd && false != $daoSaveFinal) {
                            $count += 1;
                        }
                    }else{
                        $daoSave = $dao->where('ksh = '.$finalStudent[$k]['ksh'])->save($data);
                        $daoSaveFinal = $daoFinal->where('ksh = '.$finalStudent[$k]['ksh'])->save($data);
                        $update = [];
                        $update['sfysy'] = 1;
                        $daoSaveMd = M('Md')->where('id = '.$v['id'])->save($update);
                        if (false != $daoSave && false != $daoSaveMd && false != $daoSaveFinal) {
                            $count += 1;
                        }
                    }
                }
            }
        }
        $res['count'] = $count;
        self::_sysLog('update');
        $this->ajaxReturn($res,'JSON');
    }

    /*
     * 重新分配面单号
     */
    public function reassignStudentExpressNo(){
        $student_no = I('post.student_no'); //考生号数组
        $year = intval(I('post.year'));
        $studentArr = explode(',',$student_no);

        $count = 0;
        $fileName = 'result'.$year;
        $db_name = C('DB_PREFIX').strtolower($fileName);
        $Model = new \Think\Model();
        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");

        $fileName1 = 't_tdd_final'.$year;
        $db_name1 = C('DB_PREFIX').strtolower($fileName1);
        $m1 = $Model->query("SHOW TABLES LIKE '%$db_name1%'");
        if($m && $m1){
            $dao = D($fileName);
            $daoFinal = D($fileName1);
            $condition = [];
            $condition['ksh'] = array('in',$studentArr);
            $condition['year'] = array('eq',$year);
            $studentList = $daoFinal->where($condition)->field('ksh')->select();

            if (false != $studentList){
                $studentcount = count($studentList);
                $mdList = M('Md')->where('sfysy = 0')->field('id,mdh')->limit($studentcount)->select(); //取出数量等于学生数的未使用面单号
                $finalStudent = array_values($studentList);
                $finalMd = array_values($mdList);

                $nullData = $nullWhere = [];
                $nullWhere['ksh'] = array('in',$studentArr);
                $nullData['mdh'] = '';
                $dao->where($nullWhere)->save($nullData);
                $daoFinal->where($nullWhere)->save($nullData);

                foreach ($finalMd as $k=>$v){
                    $data = [];
                    $data['mdh'] = $v['mdh'];
                    $thisStudent = $daoFinal->where('ksh = '.$finalStudent[$k]['ksh'])->field('provinceid,pc')->find();
                    if ($thisStudent['provinceid'] == 99 || $thisStudent['pc'] == 7){//港澳台及预科
                        $daoSaveFinal = $daoFinal->where('ksh = '.$finalStudent[$k]['ksh'])->save($data);
                        $update = [];
                        $update['sfysy'] = 1;
                        $daoSaveMd = M('Md')->where('id = '.$v['id'])->save($update);
                        if (false != $daoSaveMd && false != $daoSaveFinal) {
                            $count += 1;
                        }
                    }else{
                        $daoSave = $dao->where('ksh = '.$finalStudent[$k]['ksh'])->save($data);
                        $daoSaveFinal = $daoFinal->where('ksh = '.$finalStudent[$k]['ksh'])->save($data);
                        $update = [];
                        $update['sfysy'] = 1;
                        $daoSaveMd = M('Md')->where('id = '.$v['id'])->save($update);
                        if (false != $daoSave && false != $daoSaveMd && false != $daoSaveFinal) {
                            $count += 1;
                        }
                    }
                }
            }
        }
        $res['count'] = $count;
        self::_sysLog('update');
        $this->ajaxReturn($res,'JSON');
    }

    /**
     * 取消更新面单
     */
    public function cancelAssignStudentExpressNo(){
        $student_no = I('post.student_no'); //考生号数组
        $year = intval(I('post.year'));
        $studentArr = explode(',',$student_no);

        $count = 0;
        $fileName = 'result'.$year;
        $db_name = C('DB_PREFIX').strtolower($fileName);
        $Model = new \Think\Model();
        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");

        $fileName1 = 't_tdd_final'.$year;
        $db_name1 = C('DB_PREFIX').strtolower($fileName1);
        $m1 = $Model->query("SHOW TABLES LIKE '%$db_name1%'");
        if($m && $m1){
            $dao = D($fileName);
            $daoFinal = D($fileName1);
            $condition = [];
            $condition['ksh'] = array('in',$studentArr);
            $condition['year'] = array('eq',$year);
            $studentList = $daoFinal->where($condition)->field('ksh,mdh,mdsfdy,tzssfdy,pc,provinceid')->select();

            if (false != $studentList){
                $nullData['mdh'] = '';
                foreach ($studentList as $k=>$v){
                    if($v['pc'] == 7 || $v['provicneid'] == 99){
                        $daoFinalSave = $daoFinal->where('ksh = '.$v['ksh'])->save($nullData);
                        $mdStatusArr['sfysy'] = 0;
                        $daoMdSave = M('Md')->where('mdh = '.$v['mdh'])->save($mdStatusArr);
                        if (false != $daoFinalSave && false != $daoMdSave){
                            $count++;
                        }
                    }else{
                        $daoResultSave = $dao->where('ksh = '.$v['ksh'])->save($nullData);
                        $daoFinalSave = $daoFinal->where('ksh = '.$v['ksh'])->save($nullData);
                        $mdStatusArr['sfysy'] = 0;
                        $daoMdSave = M('Md')->where('mdh = '.$v['mdh'])->save($mdStatusArr);
                        if (false != $daoResultSave && false != $daoFinalSave && false != $daoMdSave){
                            $count++;
                        }
                    }

                }
            }
        }
        $res['count'] = $count;
        self::_sysLog('update');
        $this->ajaxReturn($res,'JSON');
    }

    /**
     * 根据考生id更新学生寄件地址
     */
    public function updateStudentPostInfoById(){
        $student_id = intval(I('post.student_id'));
        $year = intval(I('post.year'));
        $address = dHtml(htmlCv(I('post.address')));
        $lxdh = dHtml(htmlCv(I('post.lxdh'))); //联系方式
        $yzbm = dHtml(htmlCv(I('post.yzbm')));
        $lxsj = dHtml(htmlCv(I('post.lxsj')));

        $fileName = 'T_tdd_final'.$year;
        $db_name = C('DB_PREFIX').strtolower($fileName);
        $Model = new \Think\Model();
        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
        if($m){
            $dao = D($fileName);
            $condition = [];
            $condition['id'] = array('eq',$student_id);
            $condition['year'] = array('eq',$year);
            $data['jtdz'] = $address;
            $data['lxdh'] = $lxdh;
            $data['yzbm'] = $yzbm;
            $data['lxsj'] = $lxsj;
            $daoSave = $dao->where($condition)->save($data);
            if (false != $daoSave){
                $res['code'] = 1;
            }else{
                $res['code'] = 0;
            }
        }else{
            $res['code'] = 0;
        }
        self::_sysLog('update');
        $this->ajaxReturn($res,'JSON');
    }

    /**
     * 根据考生号更新面单打印状态
     */
    public function updateStudentPrintStatusByKsh(){
        $student_no = I('post.student_no');
        $year = intval(I('post.year'));
        $status = intval(I('post.status'));

        $fileName = 'T_tdd_final'.$year;
        $db_name = C('DB_PREFIX').strtolower($fileName);
        $Model = new \Think\Model();
        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
        if($m){
            $dao = D($fileName);
            $condition = [];
            $condition['ksh'] = array('eq',$student_no);
            $condition['year'] = array('eq',$year);
            $data['mdsfdy'] = $status;
            $daoSave = $dao->where($condition)->save($data);
            if (false != $daoSave){
                $res['code'] = 1;
            }else{
                $res['code'] = 0;
            }
        }else{
            $res['code'] = 0;
        }
        self::_sysLog('update');
        $this->ajaxReturn($res,'JSON');
    }

    /**
     * 根据考生号更新通知书打印状态
     */
    public function updateAdmissionPrintStatusByKsh(){
        $student_no = I('post.student_no');
        $year = intval(I('post.year'));
        $status = intval(I('post.status'));

        $fileName = 'T_tdd_final'.$year;
        $db_name = C('DB_PREFIX').strtolower($fileName);
        $Model = new \Think\Model();
        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
        if($m){
            $dao = D($fileName);
            $condition = [];
            $condition['ksh'] = array('eq',$student_no);
            $condition['year'] = array('eq',$year);
            $data['tzssfdy'] = $status;
            $daoSave = $dao->where($condition)->save($data);
            if (false != $daoSave){
                $res['code'] = 1;
            }else{
                $res['code'] = 0;
            }
        }else{
            $res['code'] = 0;
        }
        self::_sysLog('update');
        $this->ajaxReturn($res,'JSON');
    }

    /*
    * 通过考生号获取考生信息
    */
    public function getStudentInfoByKsh(){
        $student_no = I('post.student_no');
        $year = intval(I('post.year'));

        $fileName = 'T_tdd_final'.$year;
        $db_name = C('DB_PREFIX').strtolower($fileName);
        $Model = new \Think\Model();
        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
        if($m){
            $dao = D($fileName);
            $condition = [];
            $condition['ksh'] = array('eq',$student_no);
            $condition['year'] = array('eq',$year);
            $result = $dao->where($condition)->field('xm,ksh,sfzh,lqzy,jtdz,provinceid,yhkh')->find();

            /* 根据专业基础zy表修正jhk中专业方向缺失问题 */
            $mapJhk = [];
            $mapJhk['year'] = $year;
            $mapJhk['provinceid'] = $result['provinceid'];
            $mapJhk['zydh'] = $result['lqzy'];

            $zy = M('tJhk')->where($mapJhk)->field('year,provinceid,jhxz,zydm,zymc')->find();
            $zyname = $this->showZyname($zy);
            $result['lqzy'] = $zyname;
            //$result['lqzy'] = is_null($temp[0])?'':$temp[0];
            unset($result['provinceid']);
            if (false == $result){
                $result = [];
            }
        }else{
            $result = [];
        }
        self::_sysLog('index');
        $this->ajaxReturn($result,'JSON');
    }

    /*
     * 获取考生信息
     */
    public function getMatchInfo(){
        $source_id = intval(I('post.source_id'));
        $year = intval(I('post.year'));
        $pc = intval(I('post.pc'));

        $fileName = 'T_tdd_final'.$year;
        $db_name = C('DB_PREFIX').strtolower($fileName);
        $Model = new \Think\Model();
        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
        if($m){
            $dao = D($fileName);
            $condition = [];
            $source_id && $condition['provinceid'] = array('eq',$source_id);
            $pc && $condition['pc'] = array('eq',$pc);
            $condition['year'] = array('eq',$year);
            $result = $dao->where($condition)->field('xm,ksh,sfzh,lqzy,jtdz,provinceid,yhkh,mdh')->select();
            if (false != $result){
                /* 根据专业基础zy表修正jhk中专业方向缺失问题 */
                $mapJhk = [];
                $mapJhk['year'] = $year;
                foreach ($result as $k=>$v){
                    $mapJhk['provinceid'] = $v['provinceid'];
                    $mapJhk['zydh'] = $v['lqzy'];
                    $zy = M('tJhk')->where($mapJhk)->field('year,provinceid,jhxz,zydm,zymc')->find();
                    $zyname = $this->showZyname($zy);
                    $result[$k]['lqzy'] = $zyname;
                    //$result[$k]['lqzy'] = is_null($temp[0])?'':$temp[0];
                }
            }else{
                $result = [];
            }
        }else{
            $result = [];
        }
        self::_sysLog('index');
        $this->ajaxReturn($result,'JSON');
    }

    /*
     * 通过面单号获取考生信息
     */
    public function getStudentInfoByMdh(){
        $express_no = I('post.express_no');
        $year = intval(I('post.year'));

        $fileName = 'T_tdd_final'.$year;
        $db_name = C('DB_PREFIX').strtolower($fileName);
        $Model = new \Think\Model();
        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
        if($m){
            $dao = D($fileName);
            $condition = [];
            $condition['mdh'] = array('eq',$express_no);
            $condition['year'] = array('eq',$year);
            $result = $dao->where($condition)->field('xm,ksh,sfzh,lqzy,jtdz,provinceid')->find();

            if (false != $result){
                /* 根据专业基础zy表修正jhk中专业方向缺失问题 */
                $mapJhk = [];
                $mapJhk['year'] = $year;
                $mapJhk['provinceid'] = $result['provinceid'];
                $mapJhk['zydh'] = $result['lqzy'];
                $zy = M('tJhk')->where($mapJhk)->field('year,provinceid,jhxz,zydm,zymc')->find();
                $zyname = $this->showZyname($zy);
                $result['lqzy'] = $zyname;
                //$result['lqzy'] = is_null($temp[0])?'':$temp[0];
                unset($result['provinceid']);
            }else{
                $result = [];
            }
        }else{
            $result = [];
        }
        self::_sysLog('index');
        $this->ajaxReturn($result,'JSON');
    }

    /*
     * 根据年份省份获取制卡信息数据
     */
    public function getCardInfo(){
        $year = intval(I('post.year'));
        $source_id = intval(I('post.source_id'));
        $pc = intval(I('post.pc'));

        if ($year){
            $fileName = 'T_tdd_final'.$year;
            $db_name = C('DB_PREFIX').strtolower($fileName);
            $Model = new \Think\Model();
            $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
            if($m){
                $dao = D($fileName);
                $condition = [];
                $condition['year'] = array('eq',$year);
                $source_id && $condition['provinceid'] = array('eq',$source_id);
                $pc && $condition['pc'] = array('eq',$pc);

                $result = $dao->where($condition)->field('xm,xbdm,sfzh,ksh,provinceid,pc')->order('ksh asc')->select();
                $result = array_values($result);

                $provinceList = M('Province')->where('id <> 0')->field('id,name')->select();
                $provinceList[99]['id'] = 99;
                $provinceList[99]['name'] = '港澳台';
                $province = [];
                foreach ($provinceList as $k=>$v){
                    $province[$v['id']] = $v['name'];
                }
                $pcList = M('Pc')->field('id,pc')->select();
                $xnpc = [];
                foreach ($pcList as $k=>$v){
                    $xnpc[$v['id']] = $v['pc'];
                }

                //生成范围内随机日期
                $stimestamp = strtotime('2022-01-01');
                $etimestamp = strtotime('2028-01-01');
                // 计算日期段内有多少天
                $days = ($etimestamp-$stimestamp)/86400+1;
                // 保存每天日期
                $date = array();
                for($i=0; $i<$days; $i++){
                    $date[] = date('Y-m-d', $stimestamp+(86400*$i));
                }
                foreach ($result as $key=>$val){
                    $result[$key]['id'] = $key;
                    $result[$key]['position'] = '学生';
                    $result[$key]['hy'] = '教育';
                    $result[$key]['gj'] = '中国';
                    $result[$key]['xb'] =($val['xbdm'] == 1)?'男':'女';;
                    $result[$key]['zjlx'] = '身份证';
                    $result[$key]['jzrq'] = $date[array_rand($date)];
                    $result[$key]['address'] = '天津市东丽区驯海路100号';
                    $result[$key]['yzbm'] = '300300';
                    $result[$key]['lxdh'] = '24092136';
                    $result[$key]['info'] = '仅为中国税收公民';
                    $result[$key]['province'] = $province[$val['provinceid']];
                    $result[$key]['pc'] = $xnpc[$val['pc']];
                }
            }else{
                $result = [];
            }
        }else{
            $result = [];
        }
        self::_sysLog('index');
        $this->ajaxReturn($result,'JSON');
    }

    /*
     * 根据年份更新学生银行卡
     */
    public function assignBankCardNumberBySfzh(){
        $dataList = I('post.card_info');
        $year = intval(I('post.year'));

//        $year = 2017;
//        $dataList = '120225199910306348,6217000060002475893;120225199802265219,6228480028098757777';

        $fileName = 'T_tdd_final'.$year;
        $db_name = C('DB_PREFIX').strtolower($fileName);
        $Model = new \Think\Model();
        $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
        if($m){
            $dao = D($fileName);
            $condition = [];
            $condition['year'] = array('eq',$year);
            $result = explode(';',$dataList);
            if (false != $result){
                $count = 0;
                foreach ($result as $k=>$v){
                    $cardInfo = explode(',',$v);
                    if (idcard_check($cardInfo[0])){
                        $condition['sfzh'] = $cardInfo[0];
                        $data['yhkh'] = $cardInfo[1];
                        $data['update_time'] = time();
                        $daoSave = $dao->where($condition)->save($data);
                        if (false != $daoSave){
                            $count ++;
                        }
                    }
                }
                $res['count'] = $count;
            }else{
                $res['count'] = 0;
            }
        }else{
            $res['count'] = 0;
        }
        self::_sysLog('update');
        $this->ajaxReturn($res,'JSON');
    }

    /**
     * 返回邮局需要的考生最终数据
     */
    public function getPostInfo(){
        $year = intval(I('post.year'));
        $source_id = intval(I('post.source_id'));
        $pc = intval(I('post.pc'));

        if ($year){
            $fileName = 'T_tdd_final'.$year;
            $db_name = C('DB_PREFIX').strtolower($fileName);
            $Model = new \Think\Model();
            $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
            if($m){
                $dao = D($fileName);
                $condition = [];
                $condition['year'] = array('eq',$year);
                $source_id && $condition['provinceid'] = array('eq',$source_id);
                $pc && $condition['pc'] = array('eq',$pc);

                $provinceArr = M('Province')->field('id,name')->select();
                $provinceArr[99]['id'] = 99;
                $provinceArr[99]['name'] = '港澳台';
                $province = [];
                foreach ($provinceArr as $k=>$v){
                    $province[$v['id']] = $v['name'];
                }
                $result = $dao->where($condition)->field('provinceid,ksh,xm,lxdh,lxsj,mdh,yzbm,jtdz,sjr')->order('ksh asc')->select();
                foreach ($result as $key=>$val){
                    $result[$key]['syd'] = $province[$val['provinceid']];
                }
            }else{
                $result = [];
            }
        }else{
            $result = [];
        }
        self::_sysLog('index');
        $this->ajaxReturn($result,'JSON');
    }

    /**
     * 根据指定的检索条件获取日志数量
     */
    public function getLogCount(){
        $username = I('post.username');
        $timestampStart = I('post.timeStampStart');
        $timestampEnd = I('post.timeStampEnd');
        $condition = [];
        $condition['username'] = array('eq',$username);
        $condition['create_time'] = array('between',array($timestampStart,$timestampEnd));
        $result = M('AdminLog')->Where($condition)->count();
        if (false != $result){
            $res['count'] = $result;
        }else{
            $res['code'] = 0;
        }
        self::_sysLog('index');
        $this->ajaxReturn($res,'JSON');
    }

    /**
     * 获取日志记录集
     */
    public function logGet(){
        $username = I('post.username');
        $timestampStart = I('post.timeStampStart');
        $timestampEnd = I('post.timeStampEnd');
        $page = intval(I('post.page'));
        $page_size = intval(I('post.page_sSize'));

        $listRows = empty($page_size) ? 20 : $page_size ;
        $nowPage = empty($page) ? 1 : $page;
        $nowPage = $nowPage > 0 ? $nowPage : 1;
        $firstRow = $listRows * ($nowPage - 1);

        $condition = [];
        $condition['username'] = array('eq',$username);
        $condition['create_time'] = array('between',array($timestampStart,$timestampEnd));
        $result = M('AdminLog')->Where($condition)->Order('id desc')->Limit($firstRow.','.$listRows)->field('user_id,username,ip,action,create_time')->select();
        if (false == $result){
            $result = [];
        }
        self::_sysLog('index');
        $this->ajaxReturn($result,'JSON');
    }

//    /**
//     * 删除日志记录
//     */
//    public function logDelete(){
//        $idArr = I('post.idArr');
//        $condition = [];
//        $condition['id'] = array('in',$idArr);
//        $result = M('AdminLog')->Where($condition)->delete();
//        if (false != $result){
//            $res['code'] = 0;
//        }else{
//            $res['code'] = 1;
//        }
//        $this->ajaxReturn($res,'JSON');
//    }
//
//    /**
//     * 新增日志记录
//     */
//    public function logAdd(){
//        $username = I('post.username');
//        $action = I('post.action');
//        $ip = I('post.ip');
//        $mapUser = [];
//        $mapUser['username'] = $username;
//        $userid = M('User')->where($mapUser)->getField('id');
//
//        $data = [];
//        $data['user_id'] = $userid;
//        $data['username'] = $username;
//        $data['action'] = $action;
//        $data['ip'] = $ip;
//        $data['create_time'] = time();
//        $result = M('AdminLog')->add($data);
//        if (false != $result){
//            $res['code'] = 1;
//        }else{
//            $res['code'] = 0;
//        }
//        $this->ajaxReturn($res,'JSON');
//    }



}