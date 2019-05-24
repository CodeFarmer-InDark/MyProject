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
namespace Home\Controller;
use Think\Controller;
use Think\Log;
class GlobalController extends Controller
{
   
    /**
     * 验证校验码
     * @param $name string 手机号或邮箱
     * @param string $type 类型，默认"mobile"手机，可选"email"邮箱
     * @param $activation integer 短信验证码
     * @return bool
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
    protected function _sendSMSIp($mobile,$type='reset',$expired=600,$idCard){
        $data['mobile'] = $mobile;
        $data['time'] = time();
        $data['interval'] = $data['time']-60;//时间间隔60秒
        $today = strtotime(date('Y-m-d'));
        $condition['ip'] = $addData['ip'] = get_client_ip();
        $condition['time'] = array('between', $data['interval'] . ',' . $data['time']);
        $count = M('Activation')->where($condition)->count();//60秒内发送数量
        /*if ($count) {//60秒内发送数量>0
           return false;
        } else {
            $condition['time'] = array('between', $today . ',' . $data['time']);
            $count = M('Activation')->where($condition)->count();//当日发送总数量
            if ($count >= 10) {//当日发送总数量大于等于10条
                return false;
            } else {*/
        $data['mobile'] = $mobile;
        $data['activation'] = rand_string(6, 1);
        $data['ip'] = get_client_ip();
        $data['time'] = time() + $expired;
        $daoAdd = M('Activation')->add($data);
        $exp = $expired / 60;//有效时间，换算分钟
        if (false !== $daoAdd) {

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://sms-api.luosimao.com/v1/send.json");

            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, TRUE);
            curl_setopt($ch, CURLOPT_SSLVERSION, 3);

            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, 'api:key-0');//03254a3e83e9d7bb06d51046bb4559fa


            curl_setopt($ch, CURLOPT_POST, TRUE);

            //curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $data['mobile'], 'message' => '您的短信验证码为：' . $data['activation'] . '，30分钟内有效，仅限本次使用。【乘务学院】'));

//                    curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $data['mobile'],'message' => '验证码：'.$data['activation'].'，有效时间'.$exp.'分钟。'.'您正在重置天津城建大学创.就业信息网的密码，如非本人操作，请忽略本短信。【天城大就业办】'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $data['mobile'],'message' => '验证码：'.$data['activation'].'，有效时间'.$exp.'分钟。'.'您正在登录中国民航大学网上报名系统，如非本人操作，请忽略本短信。【中国民航大学】'));

            $res = curl_exec($ch);
            curl_close($ch);
            //$res  = curl_error( $ch );


            $res_decode = json_decode($res,true);
            //return $res;exit;
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
            return $res_decode;
        } else {
            return false;
        }
        //}
        //}
    }
    protected function _sendSMS($mobile,$type='reset',$expired=600,$idCard){
        $data['mobile'] = $mobile;
        $data['time'] = time();
        $data['interval'] = $data['time']-60;//时间间隔60秒
        $today = strtotime(date('Y-m-d'));
        $condition['idCard'] = $data['idCard'] = $idCard;
        //$condition['ip'] = $addData['ip'] = get_client_ip();
        if(idcard_check($condition['idCard'])) {
            $condition['time'] = array('between', $data['interval'] . ',' . $data['time']);
            $count = M('Activation')->where($condition)->count();//60秒内发送数量
            if ($count) {//60秒内发送数量>0
                return false;
            } else {
                $condition['time'] = array('between', $today . ',' . $data['time']);
                $count = M('Activation')->where($condition)->count();//当日发送总数量
                if ($count >= 10) {//当日发送总数量大于等于10条
                    return false;
                }else{
                    $data['mobile'] = $mobile;
                    $data['activation'] = rand_string(6, 1);
                    $data['idCard'] = $idCard;
                    $data['time'] = time() + $expired;
                    $daoAdd = M('Activation')->add($data);
                    $exp = $expired / 60;//有效时间，换算分钟
                    if (false !== $daoAdd) {
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "http://sms-api.luosimao.com/v1/send.json");

                        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                        curl_setopt($ch, CURLOPT_HEADER, FALSE);

                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, TRUE);
                        curl_setopt($ch, CURLOPT_SSLVERSION, 3);

                        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                        curl_setopt($ch, CURLOPT_USERPWD, 'api:key-03254a3e83e9d7bb06d51046bb4559fa');//03254a3e83e9d7bb06d51046bb4559fa


                        curl_setopt($ch, CURLOPT_POST, TRUE);

                        //curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $data['mobile'], 'message' => '您的短信验证码为：' . $data['activation'] . '，30分钟内有效，仅限本次使用。【乘务学院】'));

                        //                    curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $data['mobile'],'message' => '验证码：'.$data['activation'].'，有效时间'.$exp.'分钟。'.'您正在重置天津城建大学创.就业信息网的密码，如非本人操作，请忽略本短信。【天城大就业办】'));
                        if($type == 'register'){
                            curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $data['mobile'],'message' => '验证码：'.$data['activation'].'，有效时间'.$exp.'分钟。'.'您正在登录中国民航大学网上报名系统，如非本人操作，请忽略本短信。【中国民航大学】'));
                        }elseif($type == 'forgotPassword'){
                            curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $data['mobile'],'message' => '验证码：'.$data['activation'].'，有效时间'.$exp.'分钟。'.'您正在修改中国民航大学网上报名系统的登陆密码，如非本人操作，请忽略本短信。【中国民航大学】'));
                        }else{
                            curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $data['mobile'],'message' => '验证码：'.$data['activation'].'，有效时间'.$exp.'分钟。'.'您正在修改中国民航大学网上报名系统的登陆手机号，如非本人操作，请忽略本短信。【中国民航大学】'));
                        }

                        $res = curl_exec($ch);
                        curl_close($ch);
                        //$res  = curl_error( $ch );


                        $res_decode = json_decode($res,true);
                        //return $res;exit;
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
                        return $res_decode;
                    } else{
                        return false;
                    }
                }
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
    protected function _sendSMS_localhost($mobile,$type='reset',$expired=600,$idCard){
        $data['mobile'] = $mobile;
        $data['time'] = time();
        $data['interval'] = $data['time']-60;//时间间隔60秒
        $today = strtotime(date('Y-m-d'));
        //$condition['ip'] = $addData['ip'] = get_client_ip();
        $condition['idCard'] = $data['idCard'] = $idCard;
        if(idcard_check($condition['idCard'])) {
            $condition['time'] = array('between', $data['interval'] . ',' . $data['time']);
            $count = M('Activation')->where($condition)->count();//60秒内发送数量
            if ($count) {//60秒内发送数量>0
                return false;
            } else {
                $condition['time'] = array('between', $today . ',' . $data['time']);
                $count = M('Activation')->where($condition)->count();//当日发送总数量
                if ($count >= 10) {//当日发送总数量大于等于10条
                    return false;
                } else {
                    $data['mobile'] = $mobile;
                    $data['activation'] = rand_string(6, 1);
                    $data['idCard'] = $idCard;
                    $data['time'] = time() + $expired;
                    $daoAdd = M('Activation')->add($data);
                    $exp = $expired / 60;//有效时间，换算分钟
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
                        curl_setopt($ch, CURLOPT_USERPWD, 'api:key-03254a3e83e9d7bb06d51046bb4559fa');//03254a3e83e9d7bb06d51046bb4559fa 乘务


                        curl_setopt($ch, CURLOPT_POST, TRUE);

                        //curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $data['mobile'], 'message' => '您的短信验证码为：' . $data['activation'] . '，30分钟内有效，仅限本次使用。【乘务学院】'));

//                    curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $data['mobile'],'message' => '验证码：'.$data['activation'].'，有效时间'.$exp.'分钟。'.'您正在重置天津城建大学创.就业信息网的密码，如非本人操作，请忽略本短信。【天城大就业办】'));
                        curl_setopt($ch, CURLOPT_POSTFIELDS, array('mobile' => $data['mobile'],'message' => '验证码：'.$data['activation'].'，有效时间'.$exp.'分钟。'.'您正在登录中国民航大学网上报名系统，如非本人操作，请忽略本短信。【中国民航大学】'));


                        $res = curl_exec($ch);
                        curl_close($ch);
                        //$res  = curl_error( $ch );
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
                        return $res_decode;
                    } else {
                        return false;
                    }
                }
            }
        }else{
            return false;
        }
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
    
    //api返回
    protected function ApiReturn($code,$msg,$data=null) {
        $arr['code']=$code;
        $arr['msg']=$msg;
        if(empty($data)&&!is_array($data)){
            $data=array();
        }
        //$data = str_replace(null,"",$data);
        $arr['data']=$data;
        $arr['time']=time();
        echo str_replace('\/',"/",json_encode($arr));
        die();
    }
    
    /**
     * host 生成链接地址
     * level 容错级别
     * size 图片大小
     */
    public function qrcode($url='',$level=3,$size=4)
    {
//        $url = authcode('411526199309156310','ENCODE','123');
        Vendor('phpqrcode.phpqrcode');
        $errorCorrectionLevel =intval($level) ;//容错级别
        $matrixPointSize = intval($size);//生成图片大小
        //生成二维码图片
        //echo $_SERVER['REQUEST_URI'];
        $object = new \QRcode();
        $path = './lqgl/Public/code/';
        $imgName = $url.'.png';
        $object->png($url, false, $errorCorrectionLevel, $matrixPointSize, 2);
    }

    protected function _sysLog($action = '',$message = '',$userid,$username = '',$uri = NULL)
    {
        $formatMessage = empty($message) ?'': " ({$message})";
        $getConfig = getContent('cms.config.php','.');
        $sysLog = $getConfig['sys_log'];
        $sysLogExt = $getConfig['sys_log_ext'];
        if(!empty($action) &&!empty($sysLog) &&in_array($action,explode(',',$sysLogExt)))
        {
            $getUri =  empty($uri) ?formatQuery($_SERVER['REQUEST_URI']) : $uri ;
            $dao = D('AdminLog');
            $dao->user_id = $userid;
            $dao->username = $username;
            $dao->action = $getUri .$formatMessage;
            $dao->ip = get_client_ip();
            $dao->create_time = time();
            $daoAdd = $dao->add();
            $lastSql = $dao->getLastSql();
            if(false === $daoAdd)
            {
                //self::_message('error',"日志写入失败:<br />{$lastSql}",0,30);
            }
        }
    }
}

