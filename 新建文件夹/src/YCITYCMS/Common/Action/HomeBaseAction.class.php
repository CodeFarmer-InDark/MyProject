<?php

/**
 * Class HomeBaseAction
 * Home基类控制器
 */
class HomeBaseAction extends BaseAction{
    /**
     * 初始化方法
     */
    public function _initialize(){
        parent::_initialize();

    }
    protected function _sysLog($action = '',$message = '',$uri = NULL)
    {
        $formatMessage = empty($message) ?'': " ({$message})";
        $getConfig = getContent('cms.config.php','.');
        $sysLog = $getConfig['sys_log'];
        $sysLogExt = $getConfig['sys_log_ext'];
        if(!empty($action) &&!empty($sysLog) &&in_array($action,explode(',',$sysLogExt)))
        {
            $getUri =  empty($uri) ?formatQuery($_SERVER['REQUEST_URI']) : $uri ;
            $dao = D('AdminLog');

            $printUsername = $_COOKIE['printusername'];
            if (isset($printUsername) && $printUsername != ''){
                $map['username'] = $printUsername;
                $adminId = M('User')->where($map)->getField('id');

                $dao->user_id = intval($adminId);
                $dao->username = $printUsername;
                $dao->action = $getUri .$formatMessage;
                $dao->ip = get_client_ip();
                $dao->create_time = time();
                $daoAdd = $dao->add();
            }
            //$lastSql = $dao->getLastSql();
//			if(false === $daoAdd)
//			{
//				self::_message('error',"日志写入失败:<br />{$lastSql}",0,30);
//			}
        }
    }
}