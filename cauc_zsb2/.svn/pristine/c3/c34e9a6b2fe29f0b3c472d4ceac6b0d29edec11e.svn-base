<?php
namespace Home\Controller;
use Think\Controller;

class ApiController extends Controller
{
    /**
     * 默认
     */
    public function index()
    {
        $this->_json([
            'code'  =>  200,
            'msg'  =>  '默认接口'
        ]);
    }



    private $memberdb;//实例化model
    //注册接口
    public function registerInfo()
    {
        $data = I('post.');
        //不为空
        if (empty($data['phone']) || empty($data['id_number']) || empty($data['user_name']) || empty($data['password'])) {
            $this->_json([
                'code'  =>  401,
                'msg'  =>  '参数不能为空'
            ]);
        }

        $this->memberdb = M('member');
            if (is_string($data['phone']) && is_string($data['id_number']) && is_string($data['user_name']) && is_string($data['password'])) {
                if (false == $this->memberdb->where(['id_number'=>$data['id_number']])->select()) {
                    $add = [
                        'user_name'=>$data['user_name'],
                        'phone'=>$data['phone'],
                        'password'=>md5($data['password']),
                        'id_number'=>$data['id_number'],
                        'create_time'=>time()
                    ];
                    try {
                        $mid = $this->memberdb->add($add);
                        if ($mid != false) {
                            $code = 1;
                            $msg = '注册成功';
                        }
                    } catch (\Exception $e) {
                        $code = -2;
                        $msg = '注册失败';
                    }
                }else{
                    $code = -1;
                    $msg = '该身份证号已注册';
                }
            }else{
                $code = 401;
                $msg = '参数类型错误';
            }
            //返回
        $this->_json([
            'code'  =>  $code,
            'msg'  =>  $msg
        ]);
    }
    //登陆页接口
    public function login()
    {
        $data = I('post.');
        //不为空
        if (empty($data['phone']) || empty($data['password'])) {
            $this->_json([
                'code'  =>  401,
                'msg'  =>  '参数不为空'
            ]);
        }
        $code = -1;
        $msg = '参数错误';
        $this->memberdb = M('member');
        if (is_string($data['phone']) && is_string($data['password'])) {
            try {
                $where = ['phone'=>$data['phone']];
                $user_info = $this->memberdb->where($where)->find();
                $code = -1;
                $msg = '账号不存在';
                if ($user_info != false) {
                    $code = -2;
                    $msg = '密码错误';
                    if ($user_info['password'] == md5($data['password'])) {
                        $code = 1;
                        $msg = '登录成功';
                        $this->get_token($data['phone'],$data['password'],$user_info['id']);
                        session('user_name',$user_info['user_name']);
                        $info['url'] = session('login_redirect_uri') == U('/index.php/Home/Index/index') ?
                            session('login_redirect_uri') :
                            (session('modifyPhone') ?
                                session('login_redirect_uri').'?token='.session('token').'&phone='.$data['phone'] :
                                session('login_redirect_uri').'?token='.session('token'));
                        session('login_redirect_uri',null);
                        session('modifyPhone',null);
                    }
                }
            } catch (\Exception $e) {
                $code = -3;
                $msg = '登录失败';
            }
        }
        $this->_json([
            'code'  =>  $code,
            'msg'  =>  $msg
        ]);

    }
    //忘记密码--确认修改接口
    public function changePwdForget()
    {
        $phone = I('post.phone');
        $onfirmPassword = I('post.onfirmPassword');
        if (empty($phone)|| empty($onfirmPassword)) {
            $this->_json([
                'code'  =>  401,
                'msg'  =>  '参数不能为空'
            ]);
        }
        if (is_string($phone) && is_string($onfirmPassword)) {
            $msg = '两次密码不同，请重新输入';
            $this->memberdb = M('member');
            if ($this->memberdb->where(['phone'=>$phone])->setField('password',md5($onfirmPassword))) {
                $code = 1;
                $msg = '修改成功';
                session('user_name',null);
                session('token',null);
            }else{
                $code = -1;
                $msg = '修改失败';
            }
            $this->_json([
                'code'  =>  $code,
                'msg'  =>  $msg
            ]);
        }
        $this->_json([
            'code'  =>  401,
            'msg'  =>  '参数类型不正确'
        ]);
    }
    //个人页接口
    public function getInfoById()
    {
        $id = I('post.id');
//        $id = json_decode(file_get_contents('php://input'), true)['id'];
        if (empty($id) || !is_numeric($id)) {
            $this->_json([
                'code'  =>  401,
                'msg'  =>  '参数错误'
            ]);
        }
        $this->memberdb = M('member');
        try {
            $member_info = $this->memberdb->where(['id'=>$id])->field('id,phone,user_name,id_number')->find();
        } catch (\Exception $e) {
            $this->_json([
                'code'  =>  -1,
                'msg'  =>  '查询失败'
            ]);
        }
        $this->_json([
            'code'  =>  1,
            'data'  =>  $member_info
        ]);
    }
    public function getBmOptions()
    {
        $data = M('bm_options')->where(array('bm_type'=>array('in',array(1,2,3,5))))->field('bm_type,registration_switch')->select();
        $this->_json([
            'code'  =>  1,
            'data'  =>  $data
        ]);
    }
    public function checkGsp()
    {
        $id = I('post.mid');
        if (empty($id) || !is_numeric($id)) {
            $this->_json([
                'code'  =>  401,
                'msg'  =>  '参数错误'
            ]);
        }
        //查询
        $has = M('Gspydybm')->where(['mid'=>$id])->field('id')->select();
        if ($has) {
            $this->_json([
                'code'  =>  1,
                'msg'  =>  '已经报名'
            ]);
        }
        $this->_json([
            'code'  =>  1,
            'msg'  =>  '未报名'
        ]);
    }
    //修改手机号接口
    public function changeMobile()
    {

        $phone = I('post.phone');
        $id = I('post.mid');
        if (empty($phone) ||empty($id)) {
            $this->_json([
                'code'  =>  401,
                'msg'  =>  '参数不能为空'
            ]);
        }
        if (is_string($phone) && is_numeric($id)) {
            $this->memberdb = M('member');
            $res = $this->memberdb->where(['id'=>$id])->setField('phone',$phone);
            if ($res) {
                $this->_json([
                    'code'  =>  1,
                    'msg'  =>  '修改成功'
                ]);
            }
            $this->_json([
                'code'  =>  -1,
                'msg'  =>  '修改失败'
            ]);
        }
        $this->_json([
            'code'  =>  401,
            'msg'  =>  '参数类型错误'
        ]);
    }
    //修改密码接口
    public function changePwd()
    {
        $newPassword = I('post.newPassword');
        $mid = I('post.mid');
        if (empty($newPassword) ||empty($mid)) {
            $this->_json([
                'code'  =>  401,
                'msg'  =>  '参数不能为空'
            ]);
        }
        if (is_string($newPassword) && is_numeric($mid)) {
            $this->memberdb = M('member');
            $user_info = $this->memberdb->where(['id'=>$mid])->field('id,phone,password,user_name')->find();
            if (md5($newPassword) == $user_info['password']) {
                $this->_json([
                    'code'  =>  -1,
                    'msg'  =>  '不可与原密码重复'
                ]);
            }
            $res = $this->memberdb->where(['id' => $mid])->setField('password', md5($newPassword));
            if ($res) {
                $this->_json([
                    'code'  =>  1,
                    'msg'  =>  '修改成功'
                ]);
            }
            $this->_json([
                'code'  =>  -2,
                'msg'  =>  '修改失败'
            ]);
        }
        $this->_json([
            'code'  =>  401,
            'msg'  =>  '参数类型错误'
        ]);
    }
    //高水平运动员报名页接口
    public function getHighLevelInfoById()
    {
        $mid = I('post.mid');
        if (empty($mid)) {
            $this->_json([
                'code'  =>  401,
                'msg'  =>  '参数不能为空'
            ]);
        }
        if (is_numeric($mid)) {
            $data = M('Gspydybm')->where('mid',$mid)->find();
            $this->_json([
                'code'  =>  1,
                'data'  =>  $data
            ]);
        }
        $this->_json([
            'code'  =>  401,
            'msg'  =>  '参数类型错误'
        ]);
    }
    public function getBkxm()
    {
        $data = M('gspydybkxm')->where('status = 1')->field('id,xmmc')->select();
        $this->_json([
            'code'  =>  1,
            'msg'  =>  $data
        ]);
    }
    public function getHighLevelStatus()
    {
        $data = M('BmOptions')->where('bm_type = 5')->getField('registration_switch');
        $this->_json([
            'code'  =>  1,
            'data'  =>  $data
        ]);
    }
    //高水平运动员报名--提交接口
    public function submitHighLevelInfo()
    {
        $get = I('post.');
        $get['shgx'] = json_encode(['shgx_fq_mz'=>$get['shgx_fq_mz'],'shgx_fq_dh'=>$get['shgx_fq_dh'],'shgx_fq_gzdw'=>$get['shgx_fq_gzdw'],
            'shgx_mq_mz'=>$get['shgx_mq_mz'],'shgx_mq_dh'=>$get['shgx_mq_dh'],'shgx_mq_gzdw'=>$get['shgx_mq_gzdw']]);
        $get['grjl'] = json_encode($get['grjl']);
        $get['ydcj'] = json_encode($get['ydcj']);
        $get['bm_status'] = 1;
        $get['bm_time'] = time();
        $gspydybm = D('Gspydybm');
        if (!($data = $gspydybm->create($get))) {
            $this->_json([
                'code'  =>  401,
                'msg'  =>  '参数错误'
            ]);
        }
        $res = $gspydybm->add($get);
        if ($res) {
            $this->_json([
                'code'  =>  1,
                'msg'  =>  '报名成功'
            ]);
        }
        $this->_json([
            'code'  =>  -1,
            'msg'  =>  '报名失败'
        ]);
    }
    public function getHighLevelMes()
    {
        $res = M('Message')->where('id =9')->getField('content');
        $this->_json([
            'code'  =>  1,
            'data'  =>  $res
        ]);
    }
    //高水平运动员报名--修改接口
    public function saveHighLevelInfo(){
        $get = I('post.');
        $get['shgx'] = json_encode(['shgx_fq_mz'=>$get['shgx_fq_mz'],'shgx_fq_dh'=>$get['shgx_fq_dh'],'shgx_fq_gzdw'=>$get['shgx_fq_gzdw'],
            'shgx_mq_mz'=>$get['shgx_mq_mz'],'shgx_mq_dh'=>$get['shgx_mq_dh'],'shgx_mq_gzdw'=>$get['shgx_mq_gzdw']]);
        $get['grjl'] = json_encode($get['grjl']);
        $get['ydcj'] = json_encode($get['ydcj']);
        $bmxx = M('Gspydybm')->where(['mid'=>$get['mid']])->find();
        $get['id'] = $bmxx['id'];
        $get['update_time'] = time();
        $get['bm_status'] = 1;
        $gspydybm = D('Gspydybm');
        $res = $gspydybm->save($get);
        if ($res) {
            $this->_json([
                'code'  =>  1,
                'msg'  =>  '编辑成功'
            ]);
        }
        $this->_json([
            'code'  =>  -1,
            'msg'  =>  '编辑失败'
        ]);
    }
    //获取学生信息接口
    public function getMemberInfo()
    {
        $id = I('post.id');
        if (empty($id)) {
            $this->_json([
                'code'  =>  401,
                'msg'  =>  '参数不能为空'
            ]);
        }
        if (is_numeric($id)) {
            $this->memberdb = M('Member');
            $memberInfo = $this->memberdb->where(['id'=>$id])->field('id_number,create_time,phone')->find();
            $this->_json([
                'code'  =>  1,
                'data'  =>  $memberInfo
            ]);
        }
        $this->_json([
            'code'  =>  401,
            'msg'  =>  '参数类型错误'
        ]);
    }
    //报名--转专业接口
    public function getBmZyy()
    {
        $mid = I('post.mid');
        $type = I('post.type');
        $this->mid = $mid;
        if (empty($mid) || empty($type)) {
            $this->_json([
                'code'  =>  401,
                'msg'  =>  '参数不能为空'
            ]);
        }
        if (!(is_numeric($mid) || $type == 1)) {
            $this->_json([
                'code'  =>  401,
                'msg'  =>  '参数类型错误'
            ]);
        }
        $info = $this->get_member_info($this->mid);
        var_dump($info, $this->mid);
        die();
//
//        $thisZymc = str_replace('（','(',$info['zyname']);
//        $temp = explode('(',$thisZymc);
//        $zyname = is_null($temp[0])?'':$temp[0];

        $info['collegeName'] = M('College')->where(['cid'=>$info['college']])->getField('name');
        $user_bm = M('bm')->where(['mid'=>$this->mid,'type'=>1])->find();
        if ($user_bm) {
            $this->_json([
                'code'  =>  -1,
                'msg'  =>  '已经申请过了'
            ]);
        }else{
            $data = M('bm_options')->where(array('bm_type'=>1))->field('end_time')->find();
//            if ($data['end_time'] < time()) {
//                $this->_json([
//                    'code'  =>  -1,
//                    'msg'  =>  '报名时间已经过了'
//                ]);
//            }
            //可转专业列表
            $accessList = M('Accesszzy')->where('year = '.$info['year'])->field('ksh')->select();
            if ($accessList) {
                $accessArr = array_column($accessList,'ksh'); //考生号数组
                if (in_array($info['ksh'],$accessArr)){
                    //不能选自己的专业，且是所有除飞行技术、工科试验班的本科的专业
                    $zy = M('zy')->Table(C('DB_PREFIX')."zy a")->Join(C('DB_PREFIX').'plan'.$info['year'].' b on b.zydm=a.zydm')->where(['a.year = '.$info['year'],'a.ccdm'=>1,'a.zydm'=>array('not in',array($info['zydm'],'081805','00600')),'b.provinceid'=>array('neq',0)])->field('a.id,a.zydm,a.zymc,a.zyfx,b.kldm')->order('a.college desc')->select();

                    $zy_final_ws = $zy_final_lg = $zy_final_zh = $zy_forZ = [];
                    foreach ($zy as $k=>$v){ //文科类考生只能转文科，理科只能转入理工专业
                        if ($v['kldm'] == 1){
                            $zy_final_ws[$v['zydm']] = $v;
                        }
                        $zy_final_lg[$v['zydm']] = $v;
                        /*elseif($v['kldm'] == 5){
                            $zy_final_lg[$v['zydm']] = $v;
                        }*/
                        $zy_forZ[$v['zydm']] = $v;
                    }
                    if ($info['kldm'] == 1){//文史
                        $zy = $zy_final_ws;
                    }elseif($info['kldm'] == 5){ //理工
                        //$zy = M('zy')->where(['year = '.$info['year'],'ccdm'=>1])->field('id,zydm,zymc,zyfx')->order('college desc')->select();
                        $zy = $zy_final_lg;
                        if ($info['zydm'] == '00600'){ //工科实验班如果分数没超过90，只能选择志愿内的专业
                            if (($info['tdcj'] < $info['zgf'])){
                                $map = [];
                                $map['year'] = $info['year'];
                                $map['provinceid'] = $info['provinceid'];
                                $map['zydh'] = array('in',array($info['zymc_b'],$info['zymc_c'],$info['zymc_d'],$info['zymc_e'],$info['zymc_f'],$info['zymc_g']));
                                $zyzyList = M('tJhk')->where($map)->field('zydm')->select();//志愿专业代码列表
                                $zydmArr = array_column($zyzyList,'zydm');
                                $zydmArr = array_merge(array_diff($zydmArr, array($info['zydm'])));//剔除志愿中已录取专业
                                if (empty($zydmArr)){
                                    $this->assign('pc_error',1);
                                    $zy = false;
                                }else{
                                    $zy = M('zy')->where(['year = '.$info['year'],'ccdm'=>1,'zydm'=>array('in',$zydmArr)])->field('id,zydm,zymc,zyfx')->order('college desc')->select();
                                }
                            }
                        }
                    }elseif($info['kldm'] == 'Z'){//综合改革，从选考科目中取符合的专业
                        $myXkkm = explode('*',$info['xkkm']);
                        for ($i=0;$i<count($myXkkm);$i++){
                            $myXkkm[$i] = intval($myXkkm[$i]);
                        }

                        $subjectList = M('Subject')->where(['year'=>$info['year'],'provinceid'=>$info['provinceid'],'zydm'=>array('not in',array('081805','00600',$info['zydm']))])->field('zydm,major as zymc,zyfx,xkkm')->select();
                        $final_zy = [];
                        foreach ($subjectList as $k=>$v){
                            $v['id'] = $zy_forZ[$v['zydm']]['id'];
                            if ($v['xkkm'] == 0){ //选考科目不限，可转
                                $final_zy[] = $v;
                            }else{
                                $xkkmArr = explode('+',$v['xkkm']);
                                for ($i=0;$i<count($xkkmArr);$i++){
                                    $xkkmArr[$i] = intval($xkkmArr[$i]);
                                }
                                $sameArr = array_intersect($myXkkm,$xkkmArr); //该考生选考科目与该科目选考科目公共的科目，即只要有一科满足即可转专业
                                if ($sameArr){
                                    $final_zy[] = $v;
                                }
                            }
                        }
                        $zy = $final_zy;
                    }
                    $remark = M('Remark')->where('category_id = 50')->getField('content');
                    $this->_json([
                        'code'  =>  1,
                        'zy'  =>  $zy,
                        'remark'=>  $remark
                    ]);
                }
            }
            $this->_json([
                'code'  =>  -1,
                'msg'  =>  '不符合条件'
            ]);
        }
    }
    //中欧选拔--申请查询接口
    public function getBm()
    {
        $mid = I('post.mid');
        $type = I('post.type');
        if (empty($mid) || empty($type)) {
            $this->_json([
                'code'  =>  401,
                'msg'  =>  '参数不能为空'
            ]);
        }
        if (is_numeric($mid) && is_numeric($type)) {
            $bm = M('bm')->where(['mid' => $mid, 'type' => 2])->field('id,mid,qq,status')->find();
            if ($bm) {
                $info = $this->get_member_info($mid);
                $accessList = M('Accesszzy')->where('year = '.$info['year'])->field('ksh')->select();
                if ($accessList) {
                    $accessArr = array_column($accessList,'ksh'); //考生号数组
                    if (in_array($info['ksh'],$accessArr)){
                        //不能选自己的专业，且是所有除飞行技术、工科试验班的本科的专业
                        $zy = M('zy')->Table(C('DB_PREFIX')."zy a")->Join(C('DB_PREFIX').'plan'.$info['year'].' b on b.zydm=a.zydm')->where(['a.year = '.$info['year'],'a.ccdm'=>1,'a.zydm'=>array('not in',array($info['zydm'],'081805','00600')),'b.provinceid'=>array('neq',0)])->field('a.id,a.zydm,a.zymc,a.zyfx,b.kldm')->order('a.college desc')->select();

                        $zy_final_ws = $zy_final_lg = $zy_final_zh = $zy_forZ = [];
                        foreach ($zy as $k=>$v){ //文科类考生只能转文科，理科只能转入理工专业
                            if ($v['kldm'] == 1){
                                $zy_final_ws[$v['zydm']] = $v;
                            }
                            $zy_final_lg[$v['zydm']] = $v;
                            /*elseif($v['kldm'] == 5){
                                $zy_final_lg[$v['zydm']] = $v;
                            }*/
                            $zy_forZ[$v['zydm']] = $v;
                        }
                        if ($info['kldm'] == 1){//文史
                            $zy = $zy_final_ws;
                        }elseif($info['kldm'] == 5){ //理工
                            //$zy = M('zy')->where(['year = '.$info['year'],'ccdm'=>1])->field('id,zydm,zymc,zyfx')->order('college desc')->select();
                            $zy = $zy_final_lg;
                            if ($info['zydm'] == '00600'){ //工科实验班如果分数没超过90，只能选择志愿内的专业
                                if (($info['tdcj'] < $info['zgf'])){
                                    $map = [];
                                    $map['year'] = $info['year'];
                                    $map['provinceid'] = $info['provinceid'];
                                    $map['zydh'] = array('in',array($info['zymc_b'],$info['zymc_c'],$info['zymc_d'],$info['zymc_e'],$info['zymc_f'],$info['zymc_g']));
                                    $zyzyList = M('tJhk')->where($map)->field('zydm')->select();//志愿专业代码列表
                                    $zydmArr = array_column($zyzyList,'zydm');
                                    $zydmArr = array_merge(array_diff($zydmArr, array($info['zydm'])));//剔除志愿中已录取专业
                                    if (empty($zydmArr)){
                                        $this->assign('pc_error',1);
                                        $zy = false;
                                    }else{
                                        $zy = M('zy')->where(['year = '.$info['year'],'ccdm'=>1,'zydm'=>array('in',$zydmArr)])->field('id,zydm,zymc,zyfx')->order('college desc')->select();
                                    }
                                }
                            }
                        }elseif($info['kldm'] == 'Z'){//综合改革，从选考科目中取符合的专业
                            $myXkkm = explode('*',$info['xkkm']);
                            for ($i=0;$i<count($myXkkm);$i++){
                                $myXkkm[$i] = intval($myXkkm[$i]);
                            }

                            $subjectList = M('Subject')->where(['year'=>$info['year'],'provinceid'=>$info['provinceid'],'zydm'=>array('not in',array('081805','00600',$info['zydm']))])->field('zydm,major as zymc,zyfx,xkkm')->select();
                            $final_zy = [];
                            foreach ($subjectList as $k=>$v){
                                $v['id'] = $zy_forZ[$v['zydm']]['id'];
                                if ($v['xkkm'] == 0){ //选考科目不限，可转
                                    $final_zy[] = $v;
                                }else{
                                    $xkkmArr = explode('+',$v['xkkm']);
                                    for ($i=0;$i<count($xkkmArr);$i++){
                                        $xkkmArr[$i] = intval($xkkmArr[$i]);
                                    }
                                    $sameArr = array_intersect($myXkkm,$xkkmArr); //该考生选考科目与该科目选考科目公共的科目，即只要有一科满足即可转专业
                                    if ($sameArr){
                                        $final_zy[] = $v;
                                    }
                                }
                            }
                            $zy = $final_zy;
                        }
                        $remark = M('Remark')->where('category_id = 50')->getField('content');
                        $this->_json([
                            'code'  =>  200,
                            'zy'  =>  $zy,
                            'remark'=>  $remark
                        ]);
                    }
                }
                $this->_json([
                    'code'  =>  1,
                    'data'  =>  $bm
                ]);
            }
            $this->_json([
                'code'  =>  401,
                'msg'  =>  '还未申请'
            ]);
        }
        $this->_json([
            'code'  =>  401,
            'msg'  =>  '参数类型错误'
        ]);
    }
    //报名提交接口
    public function submitBm()
    {
        $id = I('post.id');
        $type = I('post.type');
        if (empty($id) || empty($type)) {
            $this->_json([
                'code'  =>  401,
                'msg'  =>  '参数不能为空'
            ]);
        }
        if (is_numeric($id) && is_numeric($type)) {
            if (in_array($type,[1,2])) {
                $data = M('bm_options')->where(array('bm_type'=>$type))->field('end_time')->find();
                if ($data['end_time'] < time()) {
                    $code = -1;
                    $msg = '报名已经结束';
                    $this->_json([
                        'code'  =>  $code,
                        'msg'  =>  $msg
                    ]);
                }
                $add = [
                    'mid'=>$this->mid,
                    'type'=>$type,
                    'create_time'=>time(),
                ];
                if ($type == 1) {
                    $info = $this->get_member_info($this->mid);
                    //是否在导出后台名单中
                    $accessList = M('Accesszzy')->where('year = '.$info['year'])->field('ksh')->select();
                    if (false != $accessList){
                        $accessArr = array_column($accessList,'ksh'); //考生号数组
                        if (in_array($info['ksh'],$accessArr)){
                            $msg = true;
                        }else{
                            $code = -2;
                            $msg = '您不符合转专业报名条件，提交失败';
                        }
                    }else{
                        $code = -3;
                        $msg = '转专业工作暂未开始，提交失败';
                    }
                    if ($msg != true){
                        $this->_json([
                            'code'  =>  $code,
                            'msg'  =>  $msg
                        ]);
                    }

                    $code = 401;
                    $zyid_one = I('post.zyid_one');
                    $zyid_two = I('post.zyid_two');
                    $msg = '请选择则志愿';
                    if (empty($zyid_one) || empty($zyid_two))
                    $this->_json([
                        'code'  =>  $code,
                        'msg'  =>  $msg
                    ]);
                    $add['zyid_one'] = $zyid_one;
                    $add['zyid_two'] = $zyid_two;
                }else if ($type == 2) {
                    $qq = I('post.qq');
                    $msg = '请填写qq号';
                    if (empty($qq)) {
                        $this->_json([
                            'code'  =>  $code,
                            'msg'  =>  $msg
                        ]);
                    }
                    $add['qq'] = $qq;
                }
                try {
                    if (M('bm')->add($add)) {
                        $code = 1;
                        $msg = '提交成功';
                    }
                } catch (\Exception $e) {
                    $this->_json([
                        'code'  =>  -4,
                        'msg'  =>  '提交失败'
                    ]);
                }
                $this->_json([
                    'code'  =>  $code,
                    'msg'  =>  $msg
                ]);
            }
        }
        $this->_json([
            'code'  =>  401,
            'msg'  =>  '参数类型错误'
        ]);
    }




    //获取学生信息
    public function get_member_info($mid)
    {
        $this->memberdb = M('Member');
        $memberInfo = $this->memberdb->where(['id'=>$mid])->field('id_number,create_time,phone')->find();
        $year = date("Y");
        $Model = 't_tdd_final'.$year; //注册时减去一年
        $tdd = D($Model);
        $Model1 = 'cj'.$year; //注册时减去一年
        $tddCj = D($Model1);
        $info = $tdd
            ->join([
                'LEFT JOIN ycity_xbdm ON ycity_'.$Model.'.xbdm = ycity_xbdm.xbdm',
                'LEFT JOIN ycity_province ON ycity_'.$Model.'.provinceid = ycity_province.id',
                'LEFT JOIN ycity_t_jhk ON ycity_'.$Model.'.lqzy = ycity_t_jhk.zydh',
                'LEFT JOIN ycity_zy ON ycity_t_jhk.zydm = ycity_zy.zydm'
            ])
            ->where(['sfzh'=>$memberInfo['id_number']])
            ->field('ycity_'.$Model.'.xm,ycity_'.$Model.'.pc,ycity_'.$Model.'.lqzy,ycity_'.$Model.'.kldm,ycity_'.$Model.'.xkkm,ycity_'.$Model.'.xm,ycity_'.$Model.'.tdcj,ycity_'.$Model.'.ksh,ycity_'.$Model.'.year,ycity_xbdm.xbmc,ycity_xbdm.xbdm,ycity_'.$Model.'.sfzh,ycity_'.$Model.'.ksh,ycity_'.$Model.'.cj,ycity_'.$Model.'.provinceid,ycity_province.name,ycity_'.$Model.'.lxsj,ycity_'.$Model.'.lxdh,ycity_'.$Model.'.tddw,ycity_'.$Model.'.zymc_b,ycity_'.$Model.'.zymc_c,ycity_'.$Model.'.zymc_d,ycity_'.$Model.'.zymc_e,ycity_'.$Model.'.zymc_f,ycity_'.$Model.'.zymc_g,ycity_zy.zymc,ycity_zy.zyfx,ycity_zy.college')
            ->order('ycity_'.$Model.'.id desc')
            ->find();
        if ($info == false) return false;

        $major = $info['lqzy'];
        $zy = M('tJhk')->where('year='.$info['year'].' AND provinceid='.$info['provinceid']." AND zydh='$major'")->field('zydm,zymc,jhxz,year,provinceid')->find();
        $info['zyname'] = correctZyname($zy);
        $info['zydm'] = $zy['zydm'];
        $info['ccdm'] = M('Zy')->where(['year'=>$year,'zydm'=>$zy['zydm']])->getField('ccdm');//本专科
        if (($zy['provinceid'] == 15 and $zy['jhxz'] == 1) OR (strstr($zy['zymc'],'定向'))){
            $info['sfdx'] = 1;//定向
        }else{
            $info['sfdx'] = 2;//非定向
        }
//        print_r($tdd->getLastSql());die;
        if (in_array($info['provinceid'],[31,33])) {
            $xkkm = explode('*',$info['xkkm']);
            //$kl = M('td_cjxdm')->where(['year'=>$info['year'],'provinceid'=>$info['provinceid'],'cjxdm'=>['in',$xkkm]])->getField('cjxmc',true);
            //$info['kl'] = implode(',',$kl);
            $info['cjx_cj'] = $tddCj->where(['ksh'=>$info['ksh'],'cjxdm'=>['in',$xkkm]])->getField('cj',true);//分类成绩
        } else {
            //$info['kl'] = M('td_kldm')->where('kldm = '."'".$info['kldm']."'".' and year = '.$info['year'].' and provinceid ='.$info['provinceid'])->getField('klmc');
        }
        $info['kldm_origin'] = $info['kldm'];

        //纠正科类代码
        if ($info['provinceid'] == 32){
            if ($info['kldm'] == 2){
                $info['kldm'] = 5;
            }
        }else{
            $tddwkldm = M('CorrectTddw')->where(['year'=>$year,'provinceid'=>$info['provinceid'],'tddw'=>$info['tddw']])->getField('kldm');
            $info['kldm'] = $tddwkldm?$tddwkldm:$info['kldm'];//纠正个别省份科类文理综合分文理
            $xnkldm = M('CorrectKldm')->where(['year'=>$year,'provinceid'=>$info['provinceid'],'kldm_origin'=>$info['kldm']])->getField('kldm');
            $info['kldm'] = ($xnkldm!='')?$xnkldm:$info['kldm']; //纠正个别省份科类代码
        }
        switch ($info['kldm']){
            case 5 : $info['kl'] = '理工';break;
            case 1 : $info['kl'] = '文史';break;
            case 'Z' : $info['kl'] = '综合改革';break;
            case 0 : $info['kl'] = '文理综合';break;
        }

        $zgf = M('Zzy')->where(['year'=>$year,'provinceid'=>$info['provinceid'],'kldm'=>$info['kldm']])->getField('fraction');//转专业资格分
        if ($zgf && $zgf != 0){ //省控线
            $info['zgf'] = $zgf;
        }
        /*$skx = M('Skx')->where(['year'=>$year,'province'=>$info['provinceid'],'kldm'=>$info['kldm']])->getField('skx');//保证有省控线
        if ($skx && $skx != 0){ //省控线
            $info['skx'] = $skx;

            $standard_score = M('Standardscore')->where('year = '.$year.' and province = '.$info['provinceid'])->getField('score'); //该省高考总分
            $info['zhcj'] = round(750 * $info['tdcj'] / $standard_score,2); //折后成绩

            $info['zhskx'] = round(750 * $skx / $standard_score,2); //折算成750总分的省控线
            $info['zhfc'] = $info['zhcj'] - $info['zhskx']; //折后分数 - 折后省控线
        }*/

        $xhInfo = M('Info'.$info['year'])->where(['sfzh'=>$info['sfzh']])->find();
        $info['xh'] = $xhInfo['xh'];
        $info['bj'] = $xhInfo['bj'];
        $info['tdcj'] = floor($info['tdcj']);
        $info['phone'] = $memberInfo['phone'];
        return $info;
    }
    //获得TOKEN
    protected function get_token($phone,$password,$id){
        $token=md5($phone.md5($password).time().$this->createNoncestr());
        session('token',$token);
        S($token,$id,86400);
        return $token;
    }
    protected function createNoncestr( $length = 32 )
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str ="";
        for ( $i = 0; $i < $length; $i++ )  {
            $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        }
        return $str;
    }
}