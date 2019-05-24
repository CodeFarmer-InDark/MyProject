<?php
/**
 *
 * Global(全局)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
namespace Promotion\Controller;
use Think\Controller;
use Think\Log;
if(defined('APP_PATH')!='./YcityCms' && !defined("YCITYCMS"))  exit("Access Denied");
class GlobalController extends Controller
{
    public $globalCategory, $globalMenu, $userid, $groupid,$sysConfig;
    /**
     * 初始化
     *
     */
    function _initialize()
    {
        //取配置
        $this->sysConfig = F('db.config','','./');
        if(fileExit('./xcms.config.php')){
            $this->sysConfig = @require_once('./xcms.config.php');
            $this->assign('bm_s', $this->sysConfig['signup_status']);
        }else{
            $this->sysConfig = D('Config')->select();
            $this->assign('bm_s', $this->sysConfig[21]['value']);
        }

        //检测是否停止
        $this->assign('cmsConfig', $this->sysConfig);
        if($this->sysConfig['web_status'] == 1){
            $this->display('Home:Public:stop');
            exit();
        }

        //取分类
        $this->globalCategory = getCache('Category');

        //取导航
        $this->globalMenu = getCache('Menu');
        $this->assign('globalMenu', $this->globalMenu);

        //导入函数
        Load('extend');
        //导入分页类
        import("ORG.Util.Page");
        $this->assign('moduleName', MODULE_NAME);
        $this->assign('controllerName', CONTROLLER_NAME);

        //获取cookies信息
        if($_COOKIE['YC_auth']){
            // $yc_auth_key = sysmd5(C('ADMIN_ACCESS').$_SERVER['HTTP_USER_AGENT']);
            $yc_auth_key = sysmd5($this->sysConfig['ADMIN_ACCESS'].$_SERVER['HTTP_USER_AGENT']);
            list($authInfo['userid'],$authInfo['username'],$authInfo['college']) = explode("-", authcode($_COOKIE['YC_auth'], 'DECODE', $yc_auth_key));

            $this->_userid = $authInfo['userid'];
            $this->_username = $authInfo['username'];
            $this->_usercollege = $authInfo['college'];
            $this->assign('userInfo',$authInfo);
        }else{
            $this->_userid = 0;
            $this->_username = '';
            $this->_usercollege = 0;
        }

        $allowAction = ['Index/index','Index/doModify','Login/index','Login/doLogin','Login/logout'];
        $ustatus = D('Teacher')->where(['id'=>$this->_userid])->getField('status');
        if(!in_array(CONTROLLER_NAME.'/'.ACTION_NAME,$allowAction)){
            if ($ustatus == 3) { //首次登陆
                $this->_message('errorUri','请先确认所属部门',U('Index/index'));
            }
        }else{
            if ($ustatus == 3){ //首次登陆
                $this->assign('first_login',1);
            }
        }

    }

    /**
     * 数据列表
     *
     * @param $conditions 条件
     * @param $orders 排序
     * @param $listRows 每页显示数量
     * @param $joind 是否表关联
     * @param $table 关联表
     * @param $join
     * @param $fields 取字段
     */
    public function getList($conditions = '', $orders = '' , $listRows = '' , $fields = '')
    {
        $condition = !empty($conditions) ? $conditions : '' ;
        $pageCount = $this->dao->where($condition)->count();
        $listRows = empty($listRows) ? 15 : $listRows;
        $orderd = empty($orders) ? 'id DESC' : $orders;
        $paged = new page($pageCount, $listRows);
        $dataContentList = $this->dao->field($fields)->Where($condition)->Order($orderd)->Limit($paged->firstRow.','.$paged->listRows)->select();
        $pageContentBar = $paged->show();
        $this->assign('dataContentList', $dataContentList);
        $this->assign('pageContentBar', $pageContentBar);
        $this->display();
    }

    /**
     * 数据列表,表关联
     *
     * @param $conditions 条件
     * @param $orders 排序
     * @param $listRows 每页显示数量
     * @param $joind 是否表关联
     * @param $table 关联表
     * @param $join
     * @param $fields 取字段
     */
    public function getJoinList($conditions = '', $orders = '' , $listRows = '', $table = '', $join = '', $fields = '')
    {
        $condition = !empty($conditions) ? $conditions : '' ;
        $pageCount = $this->dao->Where($condition)->Table($table)->Join($join)->Field($fields)->count();
        $listRows = empty($listRows) ? 15 : $listRows;
        $orderd = empty($orders) ? 'id DESC' : $orders;
        $paged = new page($pageCount, $listRows);
        $dataContentList = $this->dao->Table($table)->join($join)->field($fields)->Where($condition)->Order($orderd)->Limit($paged->firstRow.','.$paged->listRows)->select();
        $pageContentBar = $paged->show();
        $this->assign('dataContentList', $dataContentList);
        $this->assign('pageContentBar', $pageContentBar);
        $this->display();
    }

    /**
     * 数据集
     *
     * @param $conditions 条件
     *
     */
    public function getDetail($conditions = '', $viewCount = false)
    {
        empty($conditions) && self::_message('errorUri', '查询条件丢失', U('Index/index'));
        $contentDetail = $this->dao->Where($conditions)->find();
        empty($contentDetail) && self::_message('errorUri', '记录不存在', U('Index/index'));
        //更新查看次数
        $viewCount && $this->dao->setInc($viewCount, $conditions);
        $this->assign('contentDetail', $contentDetail);
        $this->display($contentDetail['template']);
    }

    /**
     * 数据集,表关联
     * 此处查询条件可能为数组
     * @param $conditions 条件
     * @param $joind 是否表关联
     * @param $table 关联表
     * @param $join
     * @param $fields 取字段
     */
    public function getJoinDetail($conditions = '', $viewCount = false, $table = '', $join = '', $fields = '')
    {
        empty($conditions) && self::_message('errorUri', '查询条件丢失', U('Index/index'));

        $condition1 = is_array($conditions) ? $conditions[0] : $conditions;
        $condition2 = is_array($conditions) ? $conditions[1] : $conditions;

        $contentDetail = $this->dao->Table($table)->Join($join)->Field($fields)->Where($condition1)->find();
        empty($contentDetail) && self::_message('errorUri', '记录不存在', U('Index/index'));
        //更新查看次数
        $viewCount && $this->dao->setInc($viewCount, $condition2);
        $this->assign('contentDetail', $contentDetail);
        $this->display($contentDetail['template']);
    }

    /**
     * 验证码
     *
     */
    function verify()
    {
        import('ORG.Util.Image');
        Image::buildImageVerify();
    }
    /**
     * 字符串转换图形
     *
     */
    public function strToImg(){
        $str = $_GET['str'];
        $str = phpcms_auth($str, 'DECODE');
        import('ORG.Util.Image');
        Image::buildString($str, array(), '', 'png', 0);
    }

    /**
     * 得到新订单号
     * @return string
     */
    protected function _getSn()
    {
        /* 选择一个随机的方案 */
        mt_srand((double) microtime() * 1000000);
        //return date('y') . str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
        //return date('y') .date('z') . substr(microtime(),2,3) . str_pad(mt_rand(1, 99), 2, '0', STR_PAD_LEFT);
        return date('ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }

    /**
     * 输出信息
     *
     * @param $type
     * @param $content
     * @param $jumpUrl
     * @param $time
     * @param $ajax
     */
    protected function _message($type = 'success', $content = '更新成功', $jumpUrl = __URL__, $time = 3, $ajax = false)
    {
        $jumpUrl = empty($jumpUrl) ? __URL__ : $jumpUrl ;
        switch ($type){
            case 'success':
                $this->assign('jumpUrl', $jumpUrl);
                $this->assign('waitSecond', $time);
                $this->success($content, $ajax);
                break;
            case 'error':
                $this->assign('jumpUrl', 'javascript:history.back(-1);');
                $this->assign('waitSecond', $time);
                $this->assign('error', $content);
                $this->error($content, $ajax);
                //$this->error($content, $ajax);
                break;
            case 'errorUri':
                $this->assign('jumpUrl', $jumpUrl);
                $this->assign('waitSecond', $time);
                $this->assign('error', $content);
                $this->error($content, $ajax);
                break;
            default:
                die('error type');
                break;
        }
    }

    /**
     * 验证校验码
     * @param string $name 手机号或邮箱
     * @param string $type 类型，默认"mobile"手机，可选"email"邮箱
     * @param integer $activation 短信验证码
     */
    protected function _varifyActivation($name,$type='mobile',$activation){
        if($type == 'mobile'){
            $condition['mobile'] = $name;
        }else{
            $condition['email'] = $name;
        }
        $condition['status'] = 0;
        $act = M('Activation')->where($condition)->order('id DESC')->Field('time,activation')->find();
        if($act){
            $condition['activation'] = $activation;
            $nowTime = time();
            if($nowTime < intval($act['time']) && $act['activation'] == $condition['activation']){
                $setActivationStatus = M('Activation')->where($condition)->setField('status',1);
                if($setActivationStatus){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    /**
     * 发送短信验证码
     * @param string $mobile 手机号码
     * @param string $type 短信类型，默认reset为重置密码，bind为绑定手机号
     * @param integer $expired 过期时长，默认600
     */
    protected function _sendSMS($mobile,$type='reset',$expired=600){
        $data['mobile'] = $mobile;
        $data['time'] = time();
        $data['interval'] = $data['time']-60;//时间间隔60秒
        $today = strtotime(date('Y-m-d'));
        $condition['ip'] = $addData['ip'] = get_client_ip();
        $condition['time'] = array('between', $data['interval'] . ',' . $data['time']);
        $count = M('Activation')->where($condition)->count();//60秒内发送数量
        if ($count) {//60秒内发送数量>0
            $res = array('error' => 0, 'count' => 0);
            echo json_encode($res);
            exit;
        } else {
            $condition['time'] = array('between', $today . ',' . $data['time']);
            $count = M('Activation')->where($condition)->count();//当日发送总数量
            if ($count >= 10) {//当日发送总数量大于等于10条
                $res = array('error' => 10, 'count' => $count);
                echo json_encode($res);
            } else {
                $data['mobile'] = $mobile;
                $data['activation'] = rand_string(6, 1);
                $data['ip'] = get_client_ip();
                $data['time'] = time() + $expired;
                $daoAdd = M('Activation')->add($data);
                $exp = $expired / 60;//有效时间，换算分钟
                /* 测试开始 */
//                $res['status'] = 0;
//                $res['count'] = $count + 1;
//                echo json_encode($res);
//                exit;
                /* 测试结束 */
                /*if (false !== $daoAdd) {
                    vendor('BayouSmsSender');
                    $sender=new BayouSmsSender();
                    $exp = $expired / 60;//有效时间，换算分钟
                    switch($type){
                        case 'reset':
                            $typemsg = '您正在重置天津城建大学创.就业信息网的密码，';
                            break;
                        case 'bind':
                            $typemsg = '您正在绑定天津城建大学创.就业信息网的账号，';
                            break;
                        default:
                            $typemsg = '';
                    }
                    $msg='验证码'.$data['activation'].'，有效时间'.$exp.'分钟。'.$typemsg.'如非本人操作，请忽略本短信。';
                    $result=$sender->sendsms(C('SMS_USER'),md5(C('SMS_PWD')),$mobile,$msg);
                    $res['status'] = $result['status'];
                    $res['count'] = $count + 1;
                    return $res;
                } else {
                    return false;
                }*/
                if (false !== $daoAdd) {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://sms-api.luosimao.com/v1/send.json");

                    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_HEADER, FALSE);

                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, TRUE);
                    curl_setopt($ch, CURLOPT_SSLVERSION, 3);

                    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    //curl_setopt($ch, CURLOPT_USERPWD, 'api:key-7df28c099da85968c210e8d8d24cb942');
                    curl_setopt($ch, CURLOPT_USERPWD, 'api:key-d6363809d25498b4a831eaabdecff375'); //正确api

                    curl_setopt($ch, CURLOPT_POST, TRUE);

                    //curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $data['mobile'], 'message' => '您的短信验证码为：' . $data['activation'] . '，30分钟内有效，仅限本次使用。【乘务学院】'));

//                    curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $data['mobile'],'message' => '验证码：'.$data['activation'].'，有效时间'.$exp.'分钟。'.'您正在重置天津城建大学创.就业信息网的密码，如非本人操作，请忽略本短信。【天城大就业办】'));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $data['mobile'],'message' => '验证码：'.$data['activation'].'，有效时间'.$exp.'分钟。'.'您正在登录会议管理系统，如非本人操作，请忽略本短信。【煤气与热力】'));


                    $res = curl_exec($ch);
                    curl_close($ch);
                    //$res  = curl_error( $ch );

                    /*----测试返回码---*/
                    //$res = array('error' => 0);
                    //$res['count'] = ($count+1);
                    //$res = json_encode($res);
                    /*----测试返回码---*/
                    $res_decode = json_decode($res,true);
                    $res_decode['count'] = ($count+1);
                    switch ($res_decode->error) {
                        case 0:
                            Log::write('[' . date('Y-m-d h:i:s') . '][' . $mobile . ']短信接口状态码：0，信息发送成功。', Log::INFO);
                            break;
                        case -10:
                            Log::write('[' . date('Y-m-d h:i:s') . '][' . $mobile . ']短信接口状态码：-10，验证信息失败，检查api key是否和各种中心内的一致，调用传入是否正确。', Log::INFO);
                            break;
                        case -20:
                            Log::write('[' . date('Y-m-d h:i:s') . '][' . $mobile . ']短信接口状态码：-20，短信余额不足，进入个人中心购买充值。', Log::INFO);
                            break;
                        case -30:
                            Log::write('[' . date('Y-m-d h:i:s') . '][' . $mobile . ']短信接口状态码：-30，短信内容为空，检查调用传入参数：message。', Log::INFO);
                            break;
                        case -31:
                            Log::write('[' . date('Y-m-d h:i:s') . '][' . $mobile . ']短信接口状态码：-31，短信内容存在敏感词，修改短信内容，更换词语。', Log::INFO);
                            break;
                        case -32:
                            Log::write('[' . date('Y-m-d h:i:s') . '][' . $mobile . ']短信接口状态码：-32，短信内容缺少签名信息，短信内容末尾增加签名信息eg.【公司名称】。', Log::INFO);
                            break;
                        case -40:
                            Log::write('[' . date('Y-m-d h:i:s') . '][' . $mobile . ']短信接口状态码：-40，错误的手机号，检查手机号是否正确。', Log::INFO);
                            break;
                        case -50:
                            Log::write('[' . date('Y-m-d h:i:s') . '][' . $mobile . ']短信接口状态码：-50，请求发送IP不在白名单内，查看触发短信IP白名单的设置。', Log::INFO);
                            break;
                        default:
                            Log::write('[' . date('Y-m-d h:i:s') . '][' . $mobile . ']短信接口状态码：无', Log::INFO);
                    }
                    $res = json_encode($res_decode);
                    echo($res);
                } else {
                    return false;
                }
            }
        }
    }

    /**
     * @param int $model
     * @param int $jumpUri
     * @param int $param
     * @param string $field
     * 批量提交
     */
    protected function _add($model = 0,$jumpUri= 0,$param = 0,$field = 'id')
    {
        if(getMethod() == 'get'){
            $item = intval(I('get.'.$field));
        }elseif(getMethod() == 'post'){
            $item = I('post.'.$field);
        }
        if($item){
            $items = is_array($item) ?implode(',',$item) : $item ;
            $total = count($item);
            //$jumpUri = empty($uri) ?__URL__ : $uri ;
            $daoModel = empty($model)?CONTROLLER_NAME : $model ;
            if(empty($param)){
                $dao = D($daoModel);
                $hasPlan = $dao->where('teacherid = '.$this->_userid)->select();
                if (false != $hasPlan){
                    $check = [];
                    foreach ($hasPlan as $k=>$v){
                        $check[$v['teacherid'].'-'.$v['planid']] = 1;
                    }
                }
                $data = [];
                for ($i=0;$i<count($item);$i++){
                    $has = $this->_userid.'-'.$item[$i];
                    if ($check[$has] != 1){
                        $data[$i]['planid'] = $item[$i];
                        $data[$i]['teacherid'] = $this->_userid;
                        $data[$i]['create_time'] = time();
                    }else{
                        $repeatid[] = $item[$i];
                        $items = implode(',',$repeatid) ;
                    }
                }
                $daoResult = $dao->addAll($data);
                if(false !== $daoResult)
                {
                    $diff = $total - count($data);
                    if ($diff == 0){
                        $this->_message('success',"报名成功",$jumpUri);
                    }else{
                        $this->_message('success',"报名成功 " . count($data) . " 条，其中计划ID：$items 已报名",$jumpUri);
                    }
                }else{
                    $this->_message('error',"报名失败，计划ID：$items 已报名",$jumpUri);
                }
            }
        }else{
            $this->_message('error',"未选择要报名的记录",$jumpUri);
        }
    }

    /*调取录取系统接口*/
    /*protected function _checkCurrentData($model,$appid,$appsecret){
        $random = mt_rand(1,1000000);
        $timestamp = time();
        $sign = $random.$timestamp.$model.$appsecret;//签名

        $ch = curl_init();
        $url = "http://localhost/cauc_zs3/lqgl/Api/Inquire/getCheckCurrentData?appid=".$appid."&random=".$random."&current=".$timestamp."&model=".$model."&sign=".$sign;
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
    }*/
}

