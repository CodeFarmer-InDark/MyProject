<?php
namespace Home\Controller;
class AuthController extends GlobalController {
   
    protected $memberdb;
    protected function _initialize()
    {
        $this->memberdb = M('member');
        $redirect_uri = I('get.redirect_uri');
        if (!session('login_redirect_uri')) session('login_redirect_uri',U('Index/index'));
        if ($redirect_uri) {
            if (ACTION_NAME == 'modifyPhone') {
                session('modifyPhone',1);
            }
            session('login_redirect_uri',$redirect_uri);
        }
    
//        echo session('login_redirect_uri');die;
    }
    
    //登陆页
    public function login()
    {
        $cabinUrl = I('get.redirect_uri');
        if ($cabinUrl){
            session('login_redirect_uri',$cabinUrl);
        }
        //echo session('login_redirect_uri');
        //die;
        if (IS_POST) {
            $data = I('post.');
            $code = -1;
            $msg = '参数错误';
            $info = [];
            if (!empty($data['phone']) && !empty($data['password'])) {
                /*if ($_SESSION['user_name']){
                    $msg = '您已登录';
                    $code = 1;
                    $info['url'] = session('login_redirect_uri') == U('Index/index') ?
                        session('login_redirect_uri') :
                        (session('modifyPhone') ?
                            session('login_redirect_uri').'?token='.session('token').'&phone='.$data['phone'] :
                            session('login_redirect_uri').'?token='.session('token'));
                    session('login_redirect_uri',null);
                    session('modifyPhone',null);
                    $this->ApiReturn($code,$msg,$info);
                }*/
                try {

                    $where = ['phone'=>$data['phone']];
                    $user_info = $this->memberdb->where($where)->find();
                    $msg = '账号不存在';
                    if ($user_info != false) {
                        $msg = '密码错误';
                        if ($user_info['password'] == md5($data['password'])) {
                            $code = 1;
                            $msg = '登录成功';
                            $this->get_token($data['phone'],$data['password'],$user_info['id']);
                            session('user_name',$user_info['user_name']);
                            $info['url'] = session('login_redirect_uri') == U('Index/index') ?
                                session('login_redirect_uri') :
                                (session('modifyPhone') ?
                                    session('login_redirect_uri').'?token='.session('token').'&phone='.$data['phone'] :
                                    session('login_redirect_uri').'?token='.session('token'));
                            session('login_redirect_uri',null);
                            session('modifyPhone',null);
                        }
                    }
                } catch (\Exception $e) {
                    $msg = '系统错误';
                }
            }
            $this->ApiReturn($code,$msg,$info);
        } else {
            $this->display();
        }
    }
    //注册
    public function register()
    {
        if (IS_POST) {
            $data = I('post.');
            if (!empty($data['phone']) && !empty($data['id_number']) && !empty($data['user_name']) && !empty($data['password']) && !empty($data['opassword']) && !empty($data['sms_code']) && !empty($data['verify_code'])) {
                if ($this->_varifyActivation($data['phone'],'mobile',$data['sms_code'])) {
                    if ($data['password'] == $data['opassword']){
                        if (strpos($data['id_number'],'x')){
                            $data['id_number'] = str_replace('x','X',$data['id_number']);
                        }
                        if (isCreditNo($data['id_number']) != false) {
                            if (!check_verify($data['verify_code'])){
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
                                        $msg = '注册失败';
                                        if ($mid != false) {
                                            $code = 1;
                                            $msg = '注册成功';
                                            $info['url'] = U('Auth/login');
                                        }
                                    } catch (\Exception $e) {
                                        $msg = '系统错误';
                                    }
                                }else{
                                    $code = -1;
                                    $msg = '该身份证号已注册';
                                    $info = [];
                                }
                            }else{
                                $code = -1;
                                $msg = '图形验证码错误';
                                $info = [];
                            }
                        }else{
                            $code = -1;
                            $msg = '无效身份证编号';
                            $info = [];
                        }
                    }else{
                        $code = -1;
                        $msg = '两次输入密码不一致';
                        $info = [];
                    }
                }else{
                    $code = -1;
                    $msg = '短信验证码错误';
                    $info = [];
                }
            }else{
                $code = -1;
                $msg = '参数错误';
                $info = [];
            }
            $this->ApiReturn($code,$msg,$info);
        } else {
            $this->assign('header_css',CONTROLLER_NAME.'/'.ACTION_NAME);
            $this->display();
        }
    }
    
    //忘记密码--确认修改
    public function forgotPassword()
    {
        if (IS_POST) {
            $phone = I('post.phone');
            $password = I('post.password');
            $onfirmPassword = I('post.onfirmPassword');
            $code = -1;
            $msg = '缺少参数';
            if ($phone) {
                $msg = '两次密码不同，请重新输入';
                if ($password == $onfirmPassword) {
                    $msg = '没有任何修改';
                    if ($this->memberdb->where(['phone'=>$phone])->setField('password',md5($password))) {
                        $code = 1;
                        $msg = '修改成功';
                        session('user_name',null);
                        session('token',null);
                        $info['url'] = U('Auth/login');
                    }
                }
            }
            $this->ApiReturn($code,$msg,$info);
        } else {
            if($_SESSION['auth']){
                $yc_auth_key = sysmd5(C('ADMIN_ACCESS').$_SERVER['HTTP_USER_AGENT']);
                list($user['id'],$user['mobile'],$user['name'],$user['token']) = explode("-", authcode($_SESSION['auth'], 'DECODE', $yc_auth_key));
                $sfzh = M('Member')->where(['phone'=>$user['mobile']])->getField('id_number');
                $this->assign('sfzh',$sfzh);
            }
            $this->display('forgotpassword');
        }
    }
    //获取登录信息（空乘/空保）
    public function getWebInfo()
    {
        $token = I('post.token');
        $code = -1;
        $msg = 'token无效';
        if (!empty($token)) {
            $info = [];
            $mid = S($token);
            $msg = 'token过期';
            if ($mid) {
                try {
                    $msg = '用户不存在';
                    $memberInfo = $this->memberdb->where(['id'=>$mid])->field('password,create_time,updatetime',true)->find();
                    if ($memberInfo) {
                        $code = 1;
                        $msg = '成功';
                        $info = $memberInfo;
                    }
                } catch (\Exception $e) {
                    $msg = '系统错误';
                }
            }
        }
        $this->ApiReturn($code,$msg,$info);
    }
    //乘务后台列表及详情数据接口
    public function getWebList()
    {
        $name = dHtml(htmlCv(I('post.user_name')));
        $idCard = dHtml(htmlCv(I('post.id_number')));
        $phone = dHtml(htmlCv(I('post.phone')));
        $condition = [];
        $name && $condition['user_name'] = array('like','%'.$name.'%');
        $idCard && $condition['id_number'] = array('eq',$idCard);
        $phone && $condition['phone'] = array('like','%'.$phone.'%');
        $memberInfo = $this->memberdb->where($condition)->field('id,user_name,phone,id_number')->select();
        if (false != $memberInfo) {
            $code = 1;
            $msg = '成功';
            $info = $memberInfo;
        }else{
            $code = 2;
            $msg = '暂无数据';
            $info = '';
        }
        $this->ApiReturn($code,$msg,$info);
    }
    //乘务后台列表及详情数据接口
    public function getWebListByPage()
    {
        $idArr = json_decode($_POST['id']);
        $name = dHtml(htmlCv(I('post.user_name')));
        $idCard = dHtml(htmlCv(I('post.id_number')));
        $phone = dHtml(htmlCv(I('post.phone')));
        $condition = [];
        $name && $condition['user_name'] = array('like','%'.$name.'%');
        $idCard && $condition['id_number'] = array('eq',$idCard);
        $phone && $condition['phone'] = array('like','%'.$phone.'%');
        //id的json串是数组，而且不能为空
        if (!is_null($idArr) && is_array($idArr)){
            if ($name!='' || $idCard!='' || $phone!=''){

            }else{
                $condition['id'] = array('in',$idArr);
            }
            $memberInfo = $this->memberdb->where($condition)->field('id,user_name,phone,id_number')->select();
            if (false != $memberInfo) {
                $code = 1;
                $msg = '成功';
                $info = $memberInfo;
            }else{
                $code = 2;
                $msg = '暂无数据';
                $info = '';
            }
        }else{
            $code = 3;
            $msg = '参数错误';
            $info = '';
        }
        $this->ApiReturn($code,$msg,$info);
    }
    //乘务后台导入复检信息列表
    public function getWebListByIdCard()
    {
        $idCardArr = json_decode($_POST['idCard']);
        $condition = [];
        if (!is_null($idCardArr) && is_array($idCardArr)){
            $condition['id_number'] = array('in',$idCardArr);
            $memberInfo = $this->memberdb->where($condition)->field('id,user_name,phone,id_number')->select();
            if (false != $memberInfo) {
                $code = 1;
                $msg = '成功';
                $info = $memberInfo;
            }else{
                $code = 2;
                $msg = '暂无数据';
                $info = '';
            }
        }else{
            $code = 3;
            $msg = '参数错误';
            $info = '';
        }
        $this->ApiReturn($code,$msg,$info);
    }
    //获取member表中的某个用户(单个)
    public function getWebDetail()
    {
        $id = intval(I('post.id'));
        $condition = [];
        $condition['id'] = array('eq',$id);
        $memberInfo = $this->memberdb->where($condition)->field('user_name,phone,id_number,password')->find();
        if (false != $memberInfo) {
            $code = 1;
            $msg = '成功';
            $info = $memberInfo;
        }else{
            $code = 2;
            $msg = '暂无数据';
            $info = '';
        }
        $this->ApiReturn($code,$msg,$info);
    }
    public function getWebUpdate()
    {
        $id = intval(I('post.id'));
        $data = [];
        $data['id_number'] = I('post.idCard');
        $data['phone'] = I('post.mobile');
        $data['user_name'] = I('post.name');
        $data['password'] = I('post.password');
        $data['updatetime'] = time();

        $check = [];
        $check['id_number'] = $data['id_number'];//身份证号
        $check['id'] = array('neq',$id);//用户id
        $check1['phone'] = $data['phone'];//手机号
        $check1['id'] = array('neq',$id);//用户id
        $has = $this->memberdb->where($check)->select();
        //判断要更改的身份证号是否被注册
        if (false != $has){
            $code = 2;
            $msg = '身份证号已注册';
            $info = '';
            $this->ApiReturn($code,$msg,$info);
        }
        //判断要更改的手机号是否被注册
        $has1 = $this->memberdb->where($check1)->select();
        if (false != $has1){
            $code = 2;
            $msg = '手机号已注册';
            $info = '';
            $this->ApiReturn($code,$msg,$info);
        }
        $condition = [];
        $condition['id'] = array('eq',$id);
        $memberInfo = $this->memberdb->where($condition)->save($data);
        if (false != $memberInfo) {
            $code = 1;
            $msg = '成功';
            $info = $memberInfo;
        }else{
            $code = 2;
            $msg = '暂无数据';
            $info = '';
        }
        $this->ApiReturn($code,$msg,$info);
    }
    //通过身份证号返回乘务member的id、姓名、身份证号、电话
    public function getWebByIdCard()
    {
        $idCard = I('post.idCard');
        if (idcard_check($idCard)){
            $condition['id_number'] = array('eq',$idCard);
            $memberInfo = $this->memberdb->where($condition)->field('id,user_name,phone,id_number')->find();
            if (false != $memberInfo) {
                $code = 1;
                $msg = '成功';
                $info = $memberInfo;
            }else{
                $code = 2;
                $msg = '暂无数据';
                $info = '';
            }
        }else{
            $code = 3;
            $msg = '无效身份证号';
        }
        $this->ApiReturn($code,$msg,$info);
    }
    //退出登录
    public function exitLogin()
    {
        $token = I('post.token');
        if ($token) {
            if (!empty(S($token))) {

                /*session('user_name',null);
                session('token',null);
                S($token,null);*/

                $url = C('S_IP').'Member/Login/logoutApi';//乘务退出登录的接口地址
                $data = array('token'=> $token);

                $re = json_decode($this->httpPsot($url,$data),true);
                if ($re['code'] == 1) {
                    session('user_name',null);
                    session('token',null);
                    S($token,null);
                    //$this->redirect('Auth/login');
                }
            }
            $this->ApiReturn(1,'退出成功',[]);
        } else {
            /*$url = 'http://localhost/cabin/cabin/Member/Login/logoutApi';//乘务退出登录的接口地址
            $data = array('token'=> session('token'));
            if (!empty($url) && !empty($data['token'])) {
                $re = json_decode($this->httpPsot($url,$data),true);
                if ($re['code'] == 1) {
                    session('user_name',null);
                    session('token',null);
                    S($token,null);
                    $this->redirect('Auth/login');
                }
            }*/
            $data = array('token'=> session('token'));
            if (!empty($data['token'])) {
                session('user_name',null);
                session('token',null);
                S($token,null);
                $this->redirect('Auth/login');
            }
        }
    }
    
    
    protected function httpPsot($url,$data)
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
    //发送短信
    public function sendSMS()
    {
        $data = I('post.');
        $code = -1;
        $msg = '参数错误';
        //忘记密码
        if ($data['type'] == 'forgotPassword'){
            if (empty($data['phone']) || empty($data['type']) || empty($data['verify_code'])) $this->ApiReturn($code,$msg);
            $data['sfzh'] = $this->getIdCard($data['phone']);
        }else{
            if (empty($data['phone']) || empty($data['type']) || empty($data['verify_code']) || empty($data['sfzh'])) $this->ApiReturn($code,$msg);
        }
        switch ($data['type']) {
            case 'register': //注册
                $msg='该手机号已经注册';
                if ($this->checkPhone($data['phone']))
                    $this->ApiReturn($code,$msg);
                break;
            case 'forgotPassword': //忘记密码
                $msg='该手机号未注册，不可找回密码';
                if (!$this->checkPhone($data['phone']))
                    $this->ApiReturn($code,$msg);
                break;
            case 'modifyPhone': //忘记密码
                $msg='该手机号已经注册';
                if ($this->checkPhone($data['phone']))
                    $this->ApiReturn($code,$msg);
                break;
        }
        if (!check_verify($data['verify_code'])){
            $msg='图形验证码错误';
            $this->ApiReturn($code,$msg);
        }
        if (strpos($data['sfzh'],'x')){
            $idCard = str_replace('x','X',$data['sfzh']);
        }else{
            $idCard = $data['sfzh'];
        }
        $res = $this->_sendSMS($data['phone'],$data['type'],60,$idCard);
        if(false == $res){
            $msg = '发送失败';
        }else{
//            if ($res['error'] == 0) {
//                $code = 1;
//                //$msg = '发送成功';
//                $msg = $res['msg'];
//            }else{
//                $msg = '未知原因发送失败';
//            }

            switch($res['error'])
            {
                case 0:
                    $code = 1;
                    $msg = '发送成功';
                    break;
                case -10:
                    $msg = '验证信息失败';
                    break;
                case -20:
                    $msg = '短信余额不足';
                    break;
                case -30:
                    $msg = '短信内容为空';
                    break;
                case -31:
                    $msg = '短信内容存在敏感词';
                    break;
                case -32:
                    $msg = '短信内容缺少签名信息';
                    break;
                case -40:
                    $msg = '错误的手机号';
                    break;
                case -50:
                    $msg = '请求发送IP不在白名单内';
                    break;
                default:
                    $msg = '发送错误';
            }
        }
        $this->ApiReturn($code,$msg);
    }
    //验证短信码
    public function checkSMSCode()
    {
        $phone = I('post.phone');
        $sms_code = I('post.sms_code');
        $code = -1;
        $msg = '短息验证码错误';
        if ($this->_varifyActivation($phone,'mobile',$sms_code)) {
            $code = 1;
            $msg = '短息验证码正确';
        }
        $this->ApiReturn($code,$msg);
    }
    //获取手机号是否已注册
    protected function checkPhone($phone)
    {
        if ($this->memberdb->where(['phone'=>$phone])->find()) {
            return true;
        }else{
            return false;
        }
    }
    //获取身份证号
    protected function getIdCard($phone)
    {
        $idNumber = $this->memberdb->where(['phone'=>$phone])->getField('id_number');
        if ($idNumber) {
            return $idNumber;
        }else{
            return '';
        }
    }
}