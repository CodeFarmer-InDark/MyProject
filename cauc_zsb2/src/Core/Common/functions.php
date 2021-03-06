<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

/**
 * Think 标准模式公共函数库
 * @category   Think
 * @package  Common
 * @author   liu21st <liu21st@gmail.com>
 */

/**
 * 导入CSV文件
 *
 * @param string $string 文件名字资源
 * @param string $string 字段名，以“,”分隔
 *
 * @return Array
 */
function inputCsv($filename,$field) {
    $fieldArray = explode(',',$field);
    $handle = fopen($filename, 'r');
    $out = array ();
    $n = 0;
    while ($data = fgetcsv($handle, 10000)) {
        
        $num = count($data);//行
        for ($i = 0; $i < $num; $i++) {
            $out[$n][$fieldArray[$i]] = iconv('GBK',"UTF-8//TRANSLIT//IGNORE", $data[$i]);
        }
        $n++;
    }
    fclose($handle); //关闭指针
    return $out;
}

/**
 * 错误输出
 * @param mixed $error 错误
 * @return void
 */
function halt($error) {
    $e = array();
    if (APP_DEBUG) {
        //调试模式下输出错误信息
        if (!is_array($error)) {
            $trace          = debug_backtrace();
            $e['message']   = $error;
            $e['file']      = $trace[0]['file'];
            $e['line']      = $trace[0]['line'];
            ob_start();
            debug_print_backtrace();
            $e['trace']     = ob_get_clean();
        } else {
            $e              = $error;
        }
    } else {
        //否则定向到错误页面
        $error_page         = C('ERROR_PAGE');
        if (!empty($error_page)) {
            redirect($error_page);
        } else {
            if (C('SHOW_ERROR_MSG'))
                $e['message'] = is_array($error) ? $error['message'] : $error;
            else
                $e['message'] = C('ERROR_MESSAGE');
        }
    }
    // 包含异常页面模板
    include C('TMPL_EXCEPTION_FILE');
    exit;
}

/**
 * 自定义异常处理
 * @param string $msg 异常消息
 * @param string $type 异常类型 默认为ThinkException
 * @param integer $code 异常代码 默认为0
 * @return void
 */
function throw_exception($msg, $type='ThinkException', $code=0) {
    if (class_exists($type, false))
        throw new $type($msg, $code);
    else
        halt($msg);        // 异常类型不存在则输出错误信息字串
}

/**
 * 浏览器友好的变量输出
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
function dump($var, $echo=true, $label=null, $strict=true) {
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    }else
        return $output;
}

/**
 * 404处理 
 * 调试模式会抛异常 
 * 部署模式下面传入url参数可以指定跳转页面，否则发送404信息
 * @param string $msg 提示信息
 * @param string $url 跳转URL地址
 * @return void
 */
function _404($msg='',$url='') {
    APP_DEBUG && throw_exception($msg);
    if($msg && C('LOG_EXCEPTION_RECORD')) Log::write($msg);
    if(empty($url) && C('URL_404_REDIRECT')) {
        $url    =   C('URL_404_REDIRECT');
    }
    if($url) {
        redirect($url);
    }else{
        send_http_status(404);
        exit;
    }
}

/**
 * 设置当前页面的布局
 * @param string|false $layout 布局名称 为false的时候表示关闭布局
 * @return void
 */
function layout($layout) {
    if(false !== $layout) {
        // 开启布局
        C('LAYOUT_ON',true);
        if(is_string($layout)) { // 设置新的布局模板
            C('LAYOUT_NAME',$layout);
        }
    }else{// 临时关闭布局
        C('LAYOUT_ON',false);
    }
}

/**
 * URL组装 支持不同URL模式
 * @param string $url URL表达式，格式：'[分组/模块/操作#锚点@域名]?参数1=值1&参数2=值2...'
 * @param string|array $vars 传入的参数，支持数组和字符串
 * @param string $suffix 伪静态后缀，默认为true表示获取配置值
 * @param boolean $redirect 是否跳转，如果设置为true则表示跳转到该URL地址
 * @param boolean $domain 是否显示域名
 * @return string
 */
function U($url='',$vars='',$suffix=true,$redirect=false,$domain=false) {
    // 解析URL
    $info   =  parse_url($url);
    $url    =  !empty($info['path'])?$info['path']:ACTION_NAME;
    if(isset($info['fragment'])) { // 解析锚点
        $anchor =   $info['fragment'];
        if(false !== strpos($anchor,'?')) { // 解析参数
            list($anchor,$info['query']) = explode('?',$anchor,2);
        }        
        if(false !== strpos($anchor,'@')) { // 解析域名
            list($anchor,$host)    =   explode('@',$anchor, 2);
        }
    }elseif(false !== strpos($url,'@')) { // 解析域名
        list($url,$host)    =   explode('@',$info['path'], 2);
    }
    // 解析子域名
    if(isset($host)) {
        $domain = $host.(strpos($host,'.')?'':strstr($_SERVER['HTTP_HOST'],'.'));
    }elseif($domain===true){
        $domain = $_SERVER['HTTP_HOST'];
        if(C('APP_SUB_DOMAIN_DEPLOY') ) { // 开启子域名部署
            $domain = $domain=='localhost'?'localhost':'www'.strstr($_SERVER['HTTP_HOST'],'.');
            // '子域名'=>array('项目[/分组]');
            foreach (C('APP_SUB_DOMAIN_RULES') as $key => $rule) {
                if(false === strpos($key,'*') && 0=== strpos($url,$rule[0])) {
                    $domain = $key.strstr($domain,'.'); // 生成对应子域名
                    $url    =  substr_replace($url,'',0,strlen($rule[0]));
                    break;
                }
            }
        }
    }

    // 解析参数
    if(is_string($vars)) { // aaa=1&bbb=2 转换成数组
        parse_str($vars,$vars);
    }elseif(!is_array($vars)){
        $vars = array();
    }
    if(isset($info['query'])) { // 解析地址里面参数 合并到vars
        parse_str($info['query'],$params);
        $vars = array_merge($params,$vars);
    }
    
    // URL组装
    $depr = C('URL_PATHINFO_DEPR');
    if($url) {
        if(0=== strpos($url,'/')) {// 定义路由
            $route      =   true;
            $url        =   substr($url,1);
            if('/' != $depr) {
                $url    =   str_replace('/',$depr,$url);
            }
        }else{
            if('/' != $depr) { // 安全替换
                $url    =   str_replace('/',$depr,$url);
            }
            // 解析分组、模块和操作
            $url        =   trim($url,$depr);
            $path       =   explode($depr,$url);
            $var        =   array();
            $var[C('VAR_ACTION')]       =   !empty($path)?array_pop($path):ACTION_NAME;
            $var[C('VAR_MODULE')]       =   !empty($path)?array_pop($path):MODULE_NAME;
            if($maps = C('URL_ACTION_MAP')) {
                if(isset($maps[strtolower($var[C('VAR_MODULE')])])) {
                    $maps    =   $maps[strtolower($var[C('VAR_MODULE')])];
                    if($action = array_search(strtolower($var[C('VAR_ACTION')]),$maps)){
                        $var[C('VAR_ACTION')] = $action;
                    }
                }
            }
            if($maps = C('URL_MODULE_MAP')) {
                if($module = array_search(strtolower($var[C('VAR_MODULE')]),$maps)){
                    $var[C('VAR_MODULE')] = $module;
                }
            }            
            if(C('URL_CASE_INSENSITIVE')) {
                $var[C('VAR_MODULE')]   =   parse_name($var[C('VAR_MODULE')]);
            }
            if(!C('APP_SUB_DOMAIN_DEPLOY') && C('APP_GROUP_LIST')) {
                if(!empty($path)) {
                    $group                  =   array_pop($path);
                    $var[C('VAR_GROUP')]    =   $group;
                }else{
                    if(GROUP_NAME != C('DEFAULT_GROUP')) {
                        $var[C('VAR_GROUP')]=   GROUP_NAME;
                    }
                }
                if(C('URL_CASE_INSENSITIVE') && isset($var[C('VAR_GROUP')])) {
                    $var[C('VAR_GROUP')]    =  strtolower($var[C('VAR_GROUP')]);
                }
            }
        }
    }

    if(C('URL_MODEL') == 0) { // 普通模式URL转换
        $url        =   __APP__.'?'.http_build_query(array_reverse($var));
        if(!empty($vars)) {
            $vars   =   urldecode(http_build_query($vars));
            $url   .=   '&'.$vars;
        }
    }else{ // PATHINFO模式或者兼容URL模式
        if(isset($route)) {
            $url    =   __APP__.'/'.rtrim($url,$depr);
        }else{
            $url    =   __APP__.'/'.implode($depr,array_reverse($var));
        }
        if(!empty($vars)) { // 添加参数
            foreach ($vars as $var => $val){
                if('' !== trim($val))   $url .= $depr . $var . $depr . urlencode($val);
            }                
        }
        if($suffix) {
            $suffix   =  $suffix===true?C('URL_HTML_SUFFIX'):$suffix;
            if($pos = strpos($suffix, '|')){
                $suffix = substr($suffix, 0, $pos);
            }
            if($suffix && '/' != substr($url,-1)){
                $url  .=  '.'.ltrim($suffix,'.');
            }
        }
    }
    if(isset($anchor)){
        $url  .= '#'.$anchor;
    }
    if($domain) {
        $url   =  (is_ssl()?'https://':'http://').$domain.$url;
    }
    if($redirect) // 直接跳转URL
        redirect($url);
    else
        return $url;
}

/**
 * 渲染输出Widget
 * @param string $name Widget名称
 * @param array $data 传入的参数
 * @param boolean $return 是否返回内容 
 * @param string $path Widget所在路径
 * @return void
 */
function W($name, $data=array(), $return=false,$path='') {
    $class      =   $name . 'Widget';
    $path       =   empty($path) ? BASE_LIB_PATH : $path;
    require_cache($path . 'Widget/' . $class . '.class.php');
    if (!class_exists($class))
        throw_exception(L('_CLASS_NOT_EXIST_') . ':' . $class);
    $widget     =   Think::instance($class);
    $content    =   $widget->render($data);
    if ($return)
        return $content;
    else
        echo $content;
}

/**
 * 过滤器方法 引用传值
 * @param string $name 过滤器名称
 * @param string $content 要过滤的内容
 * @return void
 */
function filter($name, &$content) {
    $class      =   $name . 'Filter';
    require_cache(BASE_LIB_PATH . 'Filter/' . $class . '.class.php');
    $filter     =   new $class();
    $content    =   $filter->run($content);
}

/**
 * 判断是否SSL协议
 * @return boolean
 */
function is_ssl() {
    if(isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))){
        return true;
    }elseif(isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'] )) {
        return true;
    }
    return false;
}

/**
 * URL重定向
 * @param string $url 重定向的URL地址
 * @param integer $time 重定向的等待时间（秒）
 * @param string $msg 重定向前的提示信息
 * @return void
 */
function redirect($url, $time=0, $msg='') {
    //多行URL地址支持
    $url        = str_replace(array("\n", "\r"), '', $url);
    if (empty($msg))
        $msg    = "系统将在{$time}秒之后自动跳转到{$url}！";
    if (!headers_sent()) {
        // redirect
        if (0 === $time) {
            header('Location: ' . $url);
        } else {
            header("refresh:{$time};url={$url}");
            echo($msg);
        }
        exit();
    } else {
        $str    = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
        if ($time != 0)
            $str .= $msg;
        exit($str);
    }
}

/**
 * 缓存管理
 * @param mixed $name 缓存名称，如果为数组表示进行缓存设置
 * @param mixed $value 缓存值
 * @param mixed $options 缓存参数
 * @return mixed
 */
function S($name,$value='',$options=null) {
    static $cache   =   '';
    if(is_array($options) && empty($cache)){
        // 缓存操作的同时初始化
        $type       =   isset($options['type'])?$options['type']:'';
        $cache      =   Cache::getInstance($type,$options);
    }elseif(is_array($name)) { // 缓存初始化
        $type       =   isset($name['type'])?$name['type']:'';
        $cache      =   Cache::getInstance($type,$name);
        return $cache;
    }elseif(empty($cache)) { // 自动初始化
        $cache      =   Cache::getInstance();
    }
    if(''=== $value){ // 获取缓存
        return $cache->get($name);
    }elseif(is_null($value)) { // 删除缓存
        return $cache->rm($name);
    }else { // 缓存数据
        if(is_array($options)) {
            $expire     =   isset($options['expire'])?$options['expire']:NULL;
        }else{
            $expire     =   is_numeric($options)?$options:NULL;
        }
        return $cache->set($name, $value, $expire);
    }
}
// S方法的别名 已经废除 不再建议使用
function cache($name,$value='',$options=null){
    return S($name,$value,$options);
}

/**
 * 快速文件数据读取和保存 针对简单类型数据 字符串、数组
 * @param string $name 缓存名称
 * @param mixed $value 缓存值
 * @param string $path 缓存路径
 * @return mixed
 */
function F($name, $value='', $path=DATA_PATH) {
    static $_cache  = array();
    $filename       = $path . $name . '.php';
    if ('' !== $value) {
        if (is_null($value)) {
            // 删除缓存
            return false !== strpos($name,'*')?array_map("unlink", glob($filename)):unlink($filename);
        } else {
            // 缓存数据
            $dir            =   dirname($filename);
            // 目录不存在则创建
            if (!is_dir($dir))
                mkdir($dir,0755,true);
            $_cache[$name]  =   $value;
            return file_put_contents($filename, strip_whitespace("<?php\treturn " . var_export($value, true) . ";?>"));
        }
    }
    if (isset($_cache[$name]))
        return $_cache[$name];
    // 获取缓存数据
    if (is_file($filename)) {
        $value          =   include $filename;
        $_cache[$name]  =   $value;
    } else {
        $value          =   false;
    }
    return $value;
}

/**
 * 取得对象实例 支持调用类的静态方法
 * @param string $name 类名
 * @param string $method 方法名，如果为空则返回实例化对象
 * @param array $args 调用参数
 * @return object
 */
function get_instance_of($name, $method='', $args=array()) {
    static $_instance = array();
    $identify = empty($args) ? $name . $method : $name . $method . to_guid_string($args);
    if (!isset($_instance[$identify])) {
        if (class_exists($name)) {
            $o = new $name();
            if (method_exists($o, $method)) {
                if (!empty($args)) {
                    $_instance[$identify] = call_user_func_array(array(&$o, $method), $args);
                } else {
                    $_instance[$identify] = $o->$method();
                }
            }
            else
                $_instance[$identify] = $o;
        }
        else
            halt(L('_CLASS_NOT_EXIST_') . ':' . $name);
    }
    return $_instance[$identify];
}

/**
 * 根据PHP各种类型变量生成唯一标识号
 * @param mixed $mix 变量
 * @return string
 */
function to_guid_string($mix) {
    if (is_object($mix) && function_exists('spl_object_hash')) {
        return spl_object_hash($mix);
    } elseif (is_resource($mix)) {
        $mix = get_resource_type($mix) . strval($mix);
    } else {
        $mix = serialize($mix);
    }
    return md5($mix);
}

/**
 * XML编码
 * @param mixed $data 数据
 * @param string $root 根节点名
 * @param string $item 数字索引的子节点名
 * @param string $attr 根节点属性
 * @param string $id   数字索引子节点key转换的属性名
 * @param string $encoding 数据编码
 * @return string
 */
function xml_encode($data, $root='think', $item='item', $attr='', $id='id', $encoding='utf-8') {
    if(is_array($attr)){
        $_attr = array();
        foreach ($attr as $key => $value) {
            $_attr[] = "{$key}=\"{$value}\"";
        }
        $attr = implode(' ', $_attr);
    }
    $attr   = trim($attr);
    $attr   = empty($attr) ? '' : " {$attr}";
    $xml    = "<?xml version=\"1.0\" encoding=\"{$encoding}\"?>";
    $xml   .= "<{$root}{$attr}>";
    $xml   .= data_to_xml($data, $item, $id);
    $xml   .= "</{$root}>";
    return $xml;
}

/**
 * 数据XML编码
 * @param mixed  $data 数据
 * @param string $item 数字索引时的节点名称
 * @param string $id   数字索引key转换为的属性名
 * @return string
 */
function data_to_xml($data, $item='item', $id='id') {
    $xml = $attr = '';
    foreach ($data as $key => $val) {
        if(is_numeric($key)){
            $id && $attr = " {$id}=\"{$key}\"";
            $key  = $item;
        }
        $xml    .=  "<{$key}{$attr}>";
        $xml    .=  (is_array($val) || is_object($val)) ? data_to_xml($val, $item, $id) : $val;
        $xml    .=  "</{$key}>";
    }
    return $xml;
}

/**
 * session管理函数
 * @param string|array $name session名称 如果为数组则表示进行session设置
 * @param mixed $value session值
 * @return mixed
 */
function session($name,$value='') {
    $prefix   =  C('SESSION_PREFIX');
    if(is_array($name)) { // session初始化 在session_start 之前调用
        if(isset($name['prefix'])) C('SESSION_PREFIX',$name['prefix']);
        if(C('VAR_SESSION_ID') && isset($_REQUEST[C('VAR_SESSION_ID')])){
            session_id($_REQUEST[C('VAR_SESSION_ID')]);
        }elseif(isset($name['id'])) {
            session_id($name['id']);
        }
        ini_set('session.auto_start', 0);
        if(isset($name['name']))            session_name($name['name']);
        if(isset($name['path']))            session_save_path($name['path']);
        if(isset($name['domain']))          ini_set('session.cookie_domain', $name['domain']);
        if(isset($name['expire']))          ini_set('session.gc_maxlifetime', $name['expire']);
        if(isset($name['use_trans_sid']))   ini_set('session.use_trans_sid', $name['use_trans_sid']?1:0);
        if(isset($name['use_cookies']))     ini_set('session.use_cookies', $name['use_cookies']?1:0);
        if(isset($name['cache_limiter']))   session_cache_limiter($name['cache_limiter']);
        if(isset($name['cache_expire']))    session_cache_expire($name['cache_expire']);
        if(isset($name['type']))            C('SESSION_TYPE',$name['type']);
        if(C('SESSION_TYPE')) { // 读取session驱动
            $class      = 'Session'. ucwords(strtolower(C('SESSION_TYPE')));
            // 检查驱动类
            if(require_cache(EXTEND_PATH.'Driver/Session/'.$class.'.class.php')) {
                $hander = new $class();
                $hander->execute();
            }else {
                // 类没有定义
                throw_exception(L('_CLASS_NOT_EXIST_').': ' . $class);
            }
        }
        // 启动session
        if(C('SESSION_AUTO_START'))  session_start();
    }elseif('' === $value){ 
        if(0===strpos($name,'[')) { // session 操作
            if('[pause]'==$name){ // 暂停session
                session_write_close();
            }elseif('[start]'==$name){ // 启动session
                session_start();
            }elseif('[destroy]'==$name){ // 销毁session
                $_SESSION =  array();
                session_unset();
                session_destroy();
            }elseif('[regenerate]'==$name){ // 重新生成id
                session_regenerate_id();
            }
        }elseif(0===strpos($name,'?')){ // 检查session
            $name   =  substr($name,1);
            if(strpos($name,'.')){ // 支持数组
                list($name1,$name2) =   explode('.',$name);
                return $prefix?isset($_SESSION[$prefix][$name1][$name2]):isset($_SESSION[$name1][$name2]);
            }else{
                return $prefix?isset($_SESSION[$prefix][$name]):isset($_SESSION[$name]);
            }
        }elseif(is_null($name)){ // 清空session
            if($prefix) {
                unset($_SESSION[$prefix]);
            }else{
                $_SESSION = array();
            }
        }elseif($prefix){ // 获取session
            if(strpos($name,'.')){
                list($name1,$name2) =   explode('.',$name);
                return isset($_SESSION[$prefix][$name1][$name2])?$_SESSION[$prefix][$name1][$name2]:null;  
            }else{
                return isset($_SESSION[$prefix][$name])?$_SESSION[$prefix][$name]:null;                
            }            
        }else{
            if(strpos($name,'.')){
                list($name1,$name2) =   explode('.',$name);
                return isset($_SESSION[$name1][$name2])?$_SESSION[$name1][$name2]:null;  
            }else{
                return isset($_SESSION[$name])?$_SESSION[$name]:null;
            }            
        }
    }elseif(is_null($value)){ // 删除session
        if($prefix){
            unset($_SESSION[$prefix][$name]);
        }else{
            unset($_SESSION[$name]);
        }
    }else{ // 设置session
        if($prefix){
            if (!is_array($_SESSION[$prefix])) {
                $_SESSION[$prefix] = array();
            }
            $_SESSION[$prefix][$name]   =  $value;
        }else{
            $_SESSION[$name]  =  $value;
        }
    }
}

/**
 * Cookie 设置、获取、删除
 * @param string $name cookie名称
 * @param mixed $value cookie值
 * @param mixed $options cookie参数
 * @return mixed
 */
function cookie($name, $value='', $option=null) {
    // 默认设置
    $config = array(
        'prefix'    =>  C('COOKIE_PREFIX'), // cookie 名称前缀
        'expire'    =>  C('COOKIE_EXPIRE'), // cookie 保存时间
        'path'      =>  C('COOKIE_PATH'), // cookie 保存路径
        'domain'    =>  C('COOKIE_DOMAIN'), // cookie 有效域名
    );
    // 参数设置(会覆盖黙认设置)
    if (!is_null($option)) {
        if (is_numeric($option))
            $option = array('expire' => $option);
        elseif (is_string($option))
            parse_str($option, $option);
        $config     = array_merge($config, array_change_key_case($option));
    }
    // 清除指定前缀的所有cookie
    if (is_null($name)) {
        if (empty($_COOKIE))
            return;
        // 要删除的cookie前缀，不指定则删除config设置的指定前缀
        $prefix = empty($value) ? $config['prefix'] : $value;
        if (!empty($prefix)) {// 如果前缀为空字符串将不作处理直接返回
            foreach ($_COOKIE as $key => $val) {
                if (0 === stripos($key, $prefix)) {
                    setcookie($key, '', time() - 3600, $config['path'], $config['domain']);
                    unset($_COOKIE[$key]);
                }
            }
        }
        return;
    }
    $name = $config['prefix'] . $name;
    if ('' === $value) {
        if(isset($_COOKIE[$name])){
            $value =    $_COOKIE[$name];
            if(0===strpos($value,'think:')){
                $value  =   substr($value,6);
                return array_map('urldecode',json_decode(MAGIC_QUOTES_GPC?stripslashes($value):$value,true));
            }else{
                return $value;
            }
        }else{
            return null;
        }
    } else {
        if (is_null($value)) {
            setcookie($name, '', time() - 3600, $config['path'], $config['domain']);
            unset($_COOKIE[$name]); // 删除指定cookie
        } else {
            // 设置cookie
            if(is_array($value)){
                $value  = 'think:'.json_encode(array_map('urlencode',$value));
            }
            $expire = !empty($config['expire']) ? time() + intval($config['expire']) : 0;
            setcookie($name, $value, $expire, $config['path'], $config['domain']);
            $_COOKIE[$name] = $value;
        }
    }
}

/**
 * 加载动态扩展文件
 * @return void
 */
function load_ext_file() {
    // 加载自定义外部文件
    if(C('LOAD_EXT_FILE')) {
        $files      =  explode(',',C('LOAD_EXT_FILE'));
        foreach ($files as $file){
            $file   = COMMON_PATH.$file.'.php';
            if(is_file($file)) include $file;
        }
    }
    // 加载自定义的动态配置文件
    if(C('LOAD_EXT_CONFIG')) {
        $configs    =  C('LOAD_EXT_CONFIG');
        if(is_string($configs)) $configs =  explode(',',$configs);
        foreach ($configs as $key=>$config){
            $file   = CONF_PATH.$config.'.php';
            if(is_file($file)) {
                is_numeric($key)?C(include $file):C($key,include $file);
            }
        }
    }
}

/**
 * 获取客户端IP地址
 * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
 * @return mixed
 */
function get_client_ip($type = 0) {
	$type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos    =   array_search('unknown',$arr);
        if(false !== $pos) unset($arr[$pos]);
        $ip     =   trim($arr[0]);
    }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip     =   $_SERVER['HTTP_CLIENT_IP'];
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

/**
 * 发送HTTP状态
 * @param integer $code 状态码
 * @return void
 */
function send_http_status($code) {
    static $_status = array(
        // Informational 1xx
        100 => 'Continue',
        101 => 'Switching Protocols',
        // Success 2xx
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        // Redirection 3xx
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Moved Temporarily ', // 1.1
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        // 306 is deprecated but reserved
        307 => 'Temporary Redirect',
        // Client Error 4xx
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        // Server Error 5xx
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        509 => 'Bandwidth Limit Exceeded'
    );
    if(isset($_status[$code])) {
        header('HTTP/1.1 '.$code.' '.$_status[$code]);
        // 确保FastCGI模式下正常
        header('Status:'.$code.' '.$_status[$code]);
    }
}

// 过滤表单中的表达式
function filter_exp(&$value){
    if (in_array(strtolower($value),array('exp','or'))){
        $value .= ' ';
    }
}
//自定义函数
// 循环创建目录
function mk_dir($dir, $mode = 0777) {
    if (is_dir($dir) || @mkdir($dir, $mode))
        return true;
    if (!mk_dir(dirname($dir), $mode))
        return false;
    return @mkdir($dir, $mode);
}

function upload($model='',$path = 1,$fileSize = 0,$thumbStatus = 1,$thumbSize = 0,$allowExts = 0,$attachFields = 'attach_file'){
    if(attachTrue($_FILES[$attachFields]['name'])){
        $globalConfig = getContent('cms.config.php','../');
        $globalAttachSize = intval($globalConfig['global_attach_size']);
        $globalAttachSuffix = $globalConfig['global_attach_suffix'];
        $dot = '/';
        $setFolder = empty($model) ?'file/': $model .$dot ;
        $setUserPath = empty($path) ?'': makeFolderName($path) ;
        $finalPath = UPLOAD_PATH.$dot.$setFolder.$setUserPath;
        if(!is_dir($finalPath)){
            @mk_dir($finalPath);
        }
        import("ORG.Net.UploadFile");
        $upload = new UploadFile();
        $upload->maxSize = empty($fileSize) ?$globalAttachSize : intval($fileSize) ;
        $upload->allowExts = empty($allowExts) ?explode(',',$globalAttachSuffix) : explode(',',$allowExts) ;
        $upload->savePath = $finalPath;
        $upload->saveRule = 'uniqid';
        switch ($model){
            case 'Life':
                $globalThumbStatus = intval($globalConfig['Life_thumb_status']);;
                $globalThumbSize = trim($globalConfig['Life_thumb_size']);
                break;
            case 'Picture':
                $globalThumbStatus = intval($globalConfig['Picture_thumb_status']);;
                $globalThumbSize = trim($globalConfig['Picture_thumb_size']);
                break;
            case 'Video':
                $globalThumbStatus = intval($globalConfig['Video_thumb_status']);;
                $globalThumbSize = trim($globalConfig['Video_thumb_size']);
                break;
//            default:
//                $globalThumbStatus = intval($globalConfig['global_thumb_status']);;
//                $globalThumbSize = trim($globalConfig['global_thumb_size']);
        }
        $globalThumbSizeExplode = explode(',',$globalThumbSize);
        $userThumbSizeExplode = explode(',',$thumbSize);
        if(!empty($globalThumbStatus) &&!empty($thumbStatus)){
            $upload->thumb = true;
        }else{
            $upload->thumb = false;
        }
        if(!empty($thumbStatus) &&!empty($thumbSize)){
            $upload->thumbMaxWidth = $userThumbSizeExplode[0] ;
            $upload->thumbMaxHeight = $userThumbSizeExplode[1] ;
        }else{
            $upload->thumbMaxWidth = $globalThumbSizeExplode[0] ;
            $upload->thumbMaxHeight = $globalThumbSizeExplode[1] ;
        }
        $upload->thumbPrefix = '';
        $upload->thumbSuffix = '_s';
        if(!$upload->upload()){
            echo ($upload->getErrorMsg());
        }else{
            return $upload->getUploadFileInfo();
        }
    }
}

function webupload(){
    // Make sure file is not cached (as it happens for example on iOS devices)
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");


// Support CORS
// header("Access-Control-Allow-Origin: *");
// other CORS headers if any...
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        exit; // finish preflight CORS requests here
    }


    if ( !empty($_REQUEST[ 'debug' ]) ) {
        $random = rand(0, intval($_REQUEST[ 'debug' ]) );
        if ( $random === 0 ) {
            header("HTTP/1.0 500 Internal Server Error");
            exit;
        }
    }

// header("HTTP/1.0 500 Internal Server Error");
// exit;


// 5 minutes execution time
    @set_time_limit(5 * 60);

// Uncomment this one to fake upload time
// usleep(5000);

// Settings
// $targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
    $targetDir = 'upload_tmp';
    $uploadDir = 'Uploads';

    $cleanupTargetDir = true; // Remove old files
    $maxFileAge = 5 * 3600; // Temp file age in seconds


// Create target dir
    if (!file_exists($targetDir)) {
        @mkdir($targetDir);
    }

// Create target dir
    if (!file_exists($uploadDir)) {
        @mkdir($uploadDir);
    }

// Get a file name
    if (isset($_REQUEST["name"])) {
        $fileName = $_REQUEST["name"];
    } elseif (!empty($_FILES)) {
        $fileName = $_FILES["file"]["name"];
    } else {
        $fileName = uniqid("file_");
    }

    $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
    $uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;

// Chunking might be enabled
    $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
    $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;


// Remove old temp files
    if ($cleanupTargetDir) {
        if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
        }

        while (($file = readdir($dir)) !== false) {
            $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

            // If temp file is current file proceed to the next
            if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
                continue;
            }

            // Remove temp file if it is older than the max age and is not the current file
            if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
                @unlink($tmpfilePath);
            }
        }
        closedir($dir);
    }


// Open temp file
    if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
        die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
    }

    if (!empty($_FILES)) {
        if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
        }

        // Read binary input stream and append it to temp file
        if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
        }
    } else {
        if (!$in = @fopen("php://input", "rb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
        }
    }

    while ($buff = fread($in, 4096)) {
        fwrite($out, $buff);
    }

    @fclose($out);
    @fclose($in);

    rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");

    $index = 0;
    $done = true;
    for( $index = 0; $index < $chunks; $index++ ) {
        if ( !file_exists("{$filePath}_{$index}.part") ) {
            $done = false;
            break;
        }
    }
    if ( $done ) {
        if (!$out = @fopen($uploadPath, "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if ( flock($out, LOCK_EX) ) {
            for( $index = 0; $index < $chunks; $index++ ) {
                if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
                    break;
                }

                while ($buff = fread($in, 4096)) {
                    fwrite($out, $buff);
                }

                @fclose($in);
                @unlink("{$filePath}_{$index}.part");
            }

            flock($out, LOCK_UN);
        }
        @fclose($out);
    }

// Return Success JSON-RPC response
    die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
}
//function upload($model='',$path = 1,$fileSize = 0,$thumbStatus = 1,$thumbSize = 0,$allowExts = 0,$attachFields = 'attach_file'){
//	if(attachTrue($_FILES[$attachFields]['name'])){
//		$globalConfig = getContent('cms.config.php','.');
//		$globalAttachSize = intval($globalConfig['global_attach_size']);
//		$globalAttachSuffix = $globalConfig['global_attach_suffix'];
//		$dot = '/';
//		$setFolder = empty($model) ?'file/': $model .$dot ;
//		$setUserPath = empty($path) ?'': makeFolderName($path) ;
//		$finalPath = UPLOAD_PATH.$dot.$setFolder.$setUserPath;
//		if(!is_dir($finalPath)){
//			@mk_dir($finalPath);
//		}
//		import("ORG.Net.UploadFile");
//		$upload = new UploadFile();
//		$upload->maxSize = empty($fileSize) ?$globalAttachSize : intval($fileSize) ;
//		$upload->allowExts = empty($allowExts) ?explode(',',$globalAttachSuffix) : explode(',',$allowExts) ;
//		$upload->savePath = $finalPath;
//        /* //缩略图使用
//		$upload->saveRule = 'uniqid';
//		switch ($model){
//			case 'News':
//				$globalThumbStatus = intval($globalConfig['news_thumb_status']);;
//				$globalThumbSize = trim($globalConfig['news_thumb_size']);
//				break;
//			case 'Product':
//				$globalThumbStatus = intval($globalConfig['product_thumb_status']);;
//				$globalThumbSize = trim($globalConfig['product_thumb_size']);
//				break;
//			case 'Download':
//				$globalThumbStatus = intval($globalConfig['download_thumb_status']);;
//				$globalThumbSize = trim($globalConfig['download_thumb_size']);
//				break;
//			default:
//				$globalThumbStatus = intval($globalConfig['global_thumb_status']);;
//				$globalThumbSize = trim($globalConfig['global_thumb_size']);
//				break;
//		}
//		$globalThumbSizeExplode = explode(',',$globalThumbSize);
//		$userThumbSizeExplode = explode(',',$thumbSize);
//		if(!empty($globalThumbStatus) &&!empty($thumbStatus)){
//			$upload->thumb = true;
//		}else{
//			$upload->thumb = false;
//		}
//		if(!empty($thumbStatus) &&!empty($thumbSize)){
//			$upload->thumbMaxWidth = $userThumbSizeExplode[0] ;
//			$upload->thumbMaxHeight = $userThumbSizeExplode[1] ;
//		}else{
//			$upload->thumbMaxWidth = $globalThumbSizeExplode[0] ;
//			$upload->thumbMaxHeight = $globalThumbSizeExplode[1] ;
//		}
//		$upload->thumbPrefix = '';
//		$upload->thumbSuffix = '_s';
//        */
//		if(!$upload->upload()){
//			echo ($upload->getErrorMsg());
//		}else{
//			return $upload->getUploadFileInfo();
//		}
//	}
//}

function isEnglist($param){
	if (!eregi("^[A-Z0-9]{1,26}$",$param)) {
		return false;
	}else {
		return true;
	}
}

function safe_b64encode($string){
	$data = base64_encode($string);
	$data = str_replace(array('+','/','='),array('-','_',''),$data);
	return $data;
}

function safe_b64decode($string){
	$data = str_replace(array('-','_'),array('+','/'),$string);
	$mod4 = strlen($data) %4;
	if ($mod4){
		$data .= substr('====',$mod4);
	}
	return base64_decode($data);
}

function dHtml($string){
	if(is_array($string)){
		foreach($string as $key =>$val){
			$string[$key] = dhtml($val);
		}
	}else{
		$string = str_replace(array('"','\'','<','>',"\t","\r",'{','}'),array('&quot;','&#39;','&lt;','&gt;','&nbsp;&nbsp;','','&#123;','&#125;'),$string);
	}
	return $string;
}

function cvHttp($http){
	if ($http == ''){
		return '';
	}else{
		$link = substr($http,0,7) == "http://"?$http : 'http://'.$http;
		return $link;
	}
}

function htmlCv($string){
	$pattern = array('/(javascript|jscript|js|vbscript|vbs|about):/i','/on(mouse|exit|error|click|dblclick|key|load|unload|change|move|submit|reset|cut|copy|select|start|stop)/i','/<script([^>]*)>/i','/<iframe([^>]*)>/i','/<frame([^>]*)>/i','/<link([^>]*)>/i','/@import/i');
	$replace = array('','','&lt;script${1}&gt;','&lt;iframe${1}&gt;','&lt;frame${1}&gt;','&lt;link${1}&gt;','');
	$string = preg_replace($pattern,$replace,$string);
	$string = str_replace(array('</script>','</iframe>','&#'),array('&lt;/script&gt;','&lt;/iframe&gt;','&amp;#'),$string);
	return stripslashes($string);
}

function splitThumb($attach){
	$splitAttach = explode('.',$attach);
	$thumb =  $splitAttach[0].'_s.'.$splitAttach[1];
	return $thumb;
}

function formatAttachPath($path,$find = './Uploads/',$replace =''){
	if(!empty($path)){
		return str_replace($find,$replace,$path);
	}
}

function string2checked($sring,$param,$split = ','){
	$splitParam = explode($split,$sring);
	if (in_array($param,$splitParam)) $result = ' checked=checked';
	return $result;
}

function array2string($data = array(),$split = ','){
	if (is_array($data)) {
		return implode($split,$data);
	}else{
		return $data;
	}
}

function selected($string,$param =1,$type = 'select'){
	$returnString = '';
	if ($string == $param){
		$returnString = $type == 'select'?'selected="selected"': 'checked="checked"';
	}
	return $returnString;
}

function a2bc($a,$param =1,$b = '',$c = ''){
	$returnString = $a == $param ?$b : $c;
	return $returnString;
}

function disable($param,$typeParam =1,$stringParam = array(' disabled="disabled"','')){
	return $param == $typeParam ?$stringParam[0] : '';
}

function getMethod(){
	return  strtolower($_SERVER['REQUEST_METHOD']);
}

function getDir($dirname){
	$files = array();
	if(is_dir($dirname)){
		$fileHander = opendir($dirname);
		while (($file = readdir($fileHander)) !== false){
			$filepath = $dirname .'/'.$file;
			if (strcmp($file,'.') == 0 ||strcmp($file,'..') == 0 ||is_file($filepath)){
				continue;
			}
			$files[] = auto_charset($file,'GBK','UTF8');;
		}
		closedir($fileHander);
	}else{
		$files = false;
	}
	return $files;
}

function getFile($dirname){
	$files = array();
	if(is_dir($dirname)){
		$fileHander = opendir($dirname);
		while (($file = readdir($fileHander)) !== false){
			$filepath = $dirname .'/'.$file;
			if (strcmp($file,'.') == 0 ||strcmp($file,'..') == 0 ||is_dir($filepath) ){
				continue;
			}
			$files[] = auto_charset($file,'GBK','UTF8');;
		}
		closedir($fileHander);
	}else{
		$files = false;
	}
	return $files;
}

function formatQuery($string){
	return $string;
}

function makeFolderName($type =0,$prefix=1){
	$setPrefix = empty($prefix) ?'': '/';
	switch ($type){
		case 1: $result = date('Ym').$setPrefix ;break ;
		case 2: $result = date('Y-m').$setPrefix ;break ;
		case 3: $result = date('Ymd').$setPrefix ;break ;
		case 4: $result = date('Y-m-d').$setPrefix ;break ;
		case 5: $result = date('Y').$setPrefix ;break ;
		default: $result = date('Ym').$setPrefix ;break ;
	}
	return $result;
}

function attachTrue($fields,$trueNum = 0){
	if(is_array($fields)){
		foreach ($fields as $value) {
			if(!empty($value)){
				$trueNum = $trueNum+1;
			}
		}
	}else {
		if(empty($fields)){
			$trueNum = 0;
		}else {
			$trueNum = 1;
		}
	}
	return $trueNum;
}

function statusIcon($data = 1,$status = 1,$folder = 0,$icon = 'hidden.png',$alt = '显示',$condition = 'eq'){
	$strStart = '<img src="';
	$strMiddle = $folder.'/Public/Admin/'.$icon;
	$strEnd = '" alt="'.$alt.'" align="absmiddle" />';
	if ($condition == 'eq'){
		if($data == $status){
			return $strStart.$strMiddle.$strEnd;
		}
	}elseif($condition == 'neq'){
		if($data != (int)$status){
			return $strStart .$strMiddle .$strEnd;
		}
	}
}

function attachStatus($data = 1,$status = 1,$folder = 0,$icon = 'hidden.png',$alt = '显示'){
	$string = '<img src="'.$folder.'/Public/Admin/'.$icon.'" alt="'.$alt.'" align="absmiddle" />';
	switch ($status){
		case '1':
		$returnString = !empty($data) ?$string : '';
		break;
		case '0':
		$returnString = empty($data) ?$string : '';
		break;
		default:
		$returnString = $data == $status ?$string : '';
		break;
	}
	return $returnString;
}

function str2time($string,$time = 0){
	if(!empty($string)){
		return strtotime($string);
	}
}

function createStyle($data,$style = array(),$styleArray = array()){
	$dataStyle = '';
	if($data){
		if(strtolower($data['style_color']) != '#ffffff'&&!empty($data['style_color'])){
			$style['color'] = $data['style_color'];
			$styleArray[] = 'color:'.$data['style_color'];
		}
		if(!empty($data['style_bold'])){
			$style['bold'] = $data['style_bold'];
			$styleArray[] = 'font-weight:bold';
		}
		if(!empty($data['style_underline'])){
			$style['underline'] = $data['style_underline'];
			$styleArray[] = 'TEXT-DECORATION: underline';
		}
		$dataStyle['title_style'] = empty($styleArray) ?'': implode(';',$styleArray);
		$dataStyle['title_style_serialize'] = empty($style) ?'': serialize($style);
	}
	return $dataStyle;
}

function string2Checkbox($string = '',$emptyString = '未定义'){
	if(empty($string)){
		$resultString = $emptyString;
	}else{
		$stringSplit = explode(',',$string);
		foreach ($stringSplit as $row){
			$resultString .= '<input name="run_system[]" type="checkbox" id="run_system[]" value="'.$row.'"/>'.$row;
		}
	}
	return $resultString;
}

function string2checkboxSelect($string = '',$param = '',$emptyString = '未定义'){
	if(empty($string)){
		$resultString = $emptyString;
	}else{
		$stringSplit = explode(',',$string);
		foreach ($stringSplit as $row){
			if(in_array($row,explode(',',$param))){
				$resultString.='<input name="run_system[]" type="checkbox" id="run_system[]" value="'.$row.'" checked="checked"/> '.$row.' ';
			}else{
				$resultString.='<input name="run_system[]" type="checkbox" id="run_system[]" value="'.$row.'"/> '.$row.' ';
			}
		}
	}
	return $resultString;
}

function setOrder($orderFields = 0,$selectField = 'id',$orderType = 'DESC',$join = NULL){
	$orderValue = empty($join) ?'id': 'a.id';
	foreach ((array)$orderFields as $value){
		if(is_array($value)){
			if($value[0] == $selectField){
				$orderValue = $value[1];
			}
		}else{
			if($value == $selectField){
				$orderValue = $value;
			}
		}
	}
	$orderByValue = empty($orderValue) ?'id': $orderValue ;
	$orderByType = empty($orderType) ?'DESC': $orderType ;
	return $orderByValue.' '.$orderByType;
}

function setTime($time = 0,$time1 = 0){
	$createTime = empty($time) ?0 : strtotime($time) ;
	$createTime1 = strtotime($time1) ;
	if(!empty($time1)){
		return $createTime.','.$createTime1;
	}
}

function setViewCount($count = 0,$count1 = 0){
	$viewCount = empty($count) ?0 : $count ;
	$viewCount1 = $count1 ;
	if(!empty($count1)){
		return $viewCount.','.$viewCount1;
	}
}

function styleSelected($titelStyle = 0,$type = 'color',$returnString = 'checked="checked"'){
	$result = '';
	if(!empty($titelStyle)){
		$unserialize = unserialize($titelStyle);
		switch ($type) {
			case 'color':
				$result = empty($unserialize['color']) ?'#ffffff': $unserialize['color'];
				break;
			case 'bold':
				$result = empty($unserialize['bold']) ?'': $returnString ;
				break;
			case 'underline':
				$result = empty($unserialize['underline']) ?'': $returnString ;
				break;
			default:
				break;
		}
	}
	return $result;
}
function formatTags($data){
	if(!empty($data)){
		$tagCount = 0;
		$tag = explode(',',$data);
		foreach ($tag as $value){
			if(!empty($value)){
				$tags[] = $value;
				$tagCount ++;
				if($tagCount >4) {
					unset($tag);
					break;
				}
			}
		}
		return implode(',',$tags);
	}else {
		return '';
	}
}

function tagsGet($tags,$module = ''){
	if(!empty($tags)){
		$str = '';
		$format = explode(',',$tags);
		foreach ((array)$format as $row){
			$str .= '<a href="'.U("Tags/getList",array('module'=>$module,'name'=>urlencode($row))).'" target="_blank">'.$row.'</a> ';
		}
		echo $str;
	}
}

function fileExit($file){
	return file_exists($file) ?true : false ;
}

function explodeRole($permission,$inData = '',$field = 'role_permission'){
	if(!empty($permission)){
		$str = '';
		$pmArray = explode('|',$permission);
		foreach ((array)$pmArray as $row){
			$subRow = explode('=',$row);
			if(in_array($subRow[1],explode(',',$inData))){
				$str .= '<span style="float:left; width:20%;"><input name="'.$field.'[]" type="checkbox" id="'.$field.'[]" value="'.trim($subRow[1]).'" class="checkbox" checked="checked"/>'.trim($subRow[0]).'</span>';
			}else{
				$str .= '<span style="float:left; width:20%;"><input name="'.$field.'[]" type="checkbox" id="'.$field.'[]" value="'.trim($subRow[1]).'" class="checkbox"/>'.trim($subRow[0]).'</span>';
			}
		}
		return $str;
	}
}
function explodeRole1($permission,$inData = '',$field = 'category_permission'){
    if(!empty($permission)){
        $str = '';
        $pmArray = explode('|',$permission);
        foreach ((array)$pmArray as $row){
            $subRow = explode('=',$row);
            if(in_array($subRow[1],explode(',',$inData))){
                $str .= '<span style="float:left; width:20%;"><input name="'.$field.'[]" type="checkbox" id="'.$field.'[]" value="'.trim($subRow[1]).'" class="checkbox" checked="checked"/>'.trim($subRow[0]).'</span>';
            }else{
                $str .= '<span style="float:left; width:20%;"><input name="'.$field.'[]" type="checkbox" id="'.$field.'[]" value="'.trim($subRow[1]).'" class="checkbox"/>'.trim($subRow[0]).'</span>';
            }
        }
        return $str;
    }
}

function splitsql($sql) {
	$sql = str_replace("\r","\n",$sql);
	$returnSql = array();
	$num = 0;
	$queryArray = explode(";\n",trim($sql));
	unset($sql);
	foreach($queryArray as $query) {
		$queries = explode("\n",trim($query));
		foreach($queries as $query) {
			$returnSql[$num] .= $query[0] == "#"||$query[0].$query[1] == '--'?NULL : $query;
		}
		$num ++;
	}
	return($returnSql);
}

if(!function_exists('file_put_contents')) {
	function file_put_contents($filename,$data) {
		if($fp = @fopen($filename,'w') === false){
			exit($filename.'if not writeable');
		}else {
			$bytes = fwrite($fp,$contents);
			fclose($fp);
		}
	}
}

function writeCache($name = NULL,$data = NULL,$order = '',$where = '',$path = '../Data/'){
	if(empty($data)){
		$dao = M($name);
		$getData = $dao->where($where)->order($order)->select();
		$fileName = strtolower($name);
		$writeData = "<?php\n/** \n* cache.{$fileName}.php\n*\n* @package      	Y-city Corp\n* @author          Y-city <y_city@qeeyang.com>\n* @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)\n* @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $\n   \n*/\n\nif (!defined('YCITYCMS')) exit();\n\nreturn ";
		$writeData .= var_export($getData,true);
		$writeData .= ';';
	}else{
		$writeData = $data;
	}
	$writeFile = 'cache.'.$fileName.'.php';
	@file_put_contents($path .$writeFile,$writeData);
	return $writeData;
}

function configCache($id = 1,$data = NULL,$file = NULL,$path = NULL){
	$writePath = empty($path) ?'./': $path ;
	$writeFile = empty($file) ?'fcms.config.php': $file ;
	$writeDataHeader = "<?php\n/** \n* cache.{$fileName}.php\n*\n* @package      	Y-city Corp\n* @author          Y-city <y_city@qeeyang.com>\n* @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)\n* @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $\n*/\n\nif (!defined('YCITYCMS')) exit();\n\nreturn array(\r\n";
	$writeDataFooter =  ');';
	if(empty($data)){
		$configDao = D('Config');
		$getConfig = $configDao->where("id=1")->find();
		foreach((array)$getConfig as $key =>$value){
			if(strtolower($value) == "true"||strtolower($value) == "false"||is_numeric($value)){
				$data .= "    '".$key."' => ".dadds($value).",\r\n";
			}else{
				$data .= "    '".$key."' => '".dadds($value)."',\r\n";
			}
		}
		$writeData = $writeDataHeader .$data .$writeDataFooter;
	}else {
		$writeData = $writeDataHeader .$data .$writeDataFooter;
	}
	@file_put_contents($writePath .$writeFile,$writeData);
	return $getConfig;
}

function clearCore(){
	delFile('./'.APP_PATH.'/Runtime/Cache');
	delFile('./'.APP_PATH.'/Runtime/Data');
	delFile('./'.APP_PATH.'/Runtime/Logs');
	delFile('./'.APP_PATH.'/Runtime/Temp');
	@unlink('./'.APP_PATH.'/Runtime/~app.php');
	@unlink('./'.APP_PATH.'/Runtime/~runtime.php');
	delFile('./'.YCITYCMS.'/Runtime/Cache/Home');
	delFile('./'.YCITYCMS.'/Runtime/Cache/Member');
	delFile('./'.YCITYCMS.'/Runtime/Data');
	delFile('./'.YCITYCMS.'/Runtime/Logs');
	delFile('./'.YCITYCMS.'/Runtime/Temp');
	@unlink('./'.YCITYCMS.'/Runtime/~app.php');
	@unlink('./'.YCITYCMS.'/Runtime/~runtime.php');
}

function delDir($directory,$subdir=true){
	if (is_dir($directory) != false){
		$handle = opendir($directory);
		while (($file = readdir($handle)) !== false){
			if ($file != "."&&$file != ".."){
				is_dir("$directory/$file")?
				delDir("$directory/$file"):
				unlink("$directory/$file");
			}
		}
		if (readdir($handle) == false){
			closedir($handle);
			rmdir($directory);
		}
	}
}

function delFile($directory){
	if (is_dir($directory) != false){
		$handle = opendir($directory);
		while (($file = readdir($handle)) !== false){
			if ($file != "."&&$file != ".."&&is_file("$directory/$file")){
				unlink("$directory/$file");
			}
		}
		closedir($handle);
	}
}

function getCache($name = '',$root = './Data/',$returnData = ''){
	$formatName = strtolower($name);
	$getFile = $root .'cache.'.$formatName .'.php';
	if(fileExit($getFile)){
		$returnData = @require($getFile);
	}else{
		switch ($formatName){
			case 'adminrole': $returnData = writeCache('AdminRole') ;break;
			case 'config': $returnData = configCache(1);break;
			case 'category': $returnData = writeCache('Category',0,'display_order DESC,id DESC') ;break;
			case 'link': $returnData = writeCache('Link',0,'display_order DESC,id DESC');break;
			case 'menu': $returnData = writeCache('Menu',0,'display_order DESC,id DESC');break;
			case 'module': $returnData = writeCache('Module');break;
		}
	}
	return $returnData;
}
/**2019.5.7 zhangjian 改，加了zsb/ */
function getContent($file = NULL,$path = NULL){
	$gFile = empty($file) ?exit('error function getFile: file is LOST') : $file ;
	$getPath = empty($path) ?DATA : $path ;//$path = ../    DATA=./Data
    $getFile = $getPath . '../zsb/'.$gFile;        //$gFile=cms.config.php     最终得是“../zsb/cmd.config.php”

    //$getFile = realpath($getFile);
	if(!file_exists($getFile)) die("file:$getFile is LOST");
	return @require($getFile);
}

function putContent($data,$file = NULL,$path = NULL){
	$pFile = empty($file) ?exit('error function getFile: file is LOST') : $file ;
	$pPath = empty($path) ?DATA : $path ;
	if ($path != '.'){
		if(!is_dir($pPath)){
			@mk_dir($pPath);
		}
	}
	$putFile = $pPath.'/'.$pFile;
	@file_put_contents($putFile,$data);
}

function xCopy($source,$dest,$child = 0){
	if(!is_dir($source)){
		echo("Error:the $source is not a direction!");
		exit();
	}
	if(!is_dir($dest)){
		@mk_dir($dest,0777);
	}
	$fileHander = opendir($source);
	while (($file = readdir($fileHander)) !== false){
		$filepath = $source .'/'.$file;
		if (strcmp($file,'.') == 0 ||strcmp($file,'..') == 0 ){
			continue;
		}
		if(is_dir($filepath)){
			if($child) xCopy($source."/".$file,$dest."/".$file,$child);
		}else{
			copy($source."/".$file,$dest."/".$file);
		}
	}
}

function copyDir($source,$dest,$child = 0){
	if(!is_dir($source)){
		echo("Error:the $source is not a direction!");
		exit();
	}
	if(!is_dir($dest)){
		@mk_dir($dest,0777);
	}
	$fileHander = opendir($source);
	while (($file = readdir($fileHander)) !== false){
		$filepath = $source .'/'.$file;
		if (strcmp($file,'.') == 0 ||strcmp($file,'..') == 0 ) continue;
		if(is_dir($filepath)){
			if($child) xCopy($source."/".$file,$dest."/".$file,$child);
		}
	}
}


function getCategory($array,$parentid = 0,$level = 0,$add = 2,$repeat = '　') {
	$str_repeat = '';
	if($level) {
		for($j=0;$j<$level;$j++) {
		$str_repeat .= $repeat;
		}
	}
	$newarray = array();
	$temparray = array();

	foreach((array)$array as $v) {
		if($v['parent_id'] == $parentid) {
			$newarray[] = array(
				'id'=>$v['id'],
				'title'=>$v['title'],
                'zyfx'=>$v['zyfx'],
                'level'=>$level,
				'parent_id'=>$v['parent_id'],
                'str_repeat'=>$str_repeat,
                'display_order'=>$v['display_order'],
                'create_time'=>$v['create_time'],
                'update_time'=>$v['update_time']
			);
			$temparray = getCategory($array,$v['id'],($level +$add));
			if($temparray) {
				$newarray = array_merge($newarray,$temparray);
			}
		}
	}
	return $newarray;
}

function bgStyle($data,$param = 1,$color = '#00F'){
	if($data == $param){
		return $color;
	}
}

function buildSelect($data,$parentId = 0,$selected = 0,$str = ''){
	$formatArray = getCategory($data,$parentId);
	foreach ((array)$formatArray as $row){
		if($row['id'] == $selected){
			$str .= '<option value="'.$row['id'] .'" selected="selected">'.$row['str_repeat'] .$row['title'] .'</option>';
		}else{
			$str .= '<option value="'.$row['id'] .'">'.$row['str_repeat'] .$row['title'] .'</option>';
		}
	}
	return $str;
}

function moduleTitle($name = '',$file = NULL,$path = NULL){
	$getData = getCache('Module');
	foreach ((array)$getData as $key=>$value){
		if($value['module_name'] == $name){
			echo $value['module_title'];
		}
	}
}

function dadds($str){
	$content = (!get_magic_quotes_gpc ()) ?addslashes($str) : $str;
	return trim($content);
}

function daddslashes($string, $force = 0, $strip = FALSE) {
    //字符串或数组  是否强制  是否去除
    //如果魔术引用未开启 或 $force不为0
    if(!MAGIC_QUOTES_GPC || $force) {
        if(is_array($string)) { //如果其为一个数组则循环执行此函数
            foreach($string as $key => $val) {
                $string[$key] = daddslashes($val, $force);
            }
        } else {
        //如果魔术引用开启或$force为0
        //下面是一个三元操作符，如果$strip为true则执行stripslashes去掉反斜线字符，再执行addslashes
        //$strip为true的，也就是先去掉反斜线字符再进行转义的为$_GET,$_POST,$_COOKIE和$_REQUEST $_REQUEST数组包含了前三个数组的值
        //这里为什么要将＄string先去掉反斜线再进行转义呢，因为有的时候$string有可能有两个反斜线，stripslashes是将多余的反斜线过滤掉
            $string = addslashes($strip ? stripslashes($string) : $string);
        }
    }
    return $string;
}

function categoryModule($data){
	foreach ((array)$data as $row){
		if(in_array($row['module_name'],array('News','Product','Download','Job','Link','Ad'))){
			$datas[] = $row;
		}
	}
	return $datas;
}

function selectCategory($slid){
	$category = getCache('Category');
	foreach ((array)$category as $c){
		if($c['id'] == $slid){
			echo $c['title'];
		}
	}
}

function selectCategoryId($slid){
	$category = getCache('Category');
	foreach ((array)$category as $c){
		if($c['id'] == $slid){
			echo $c['id'];
		}
	}
}

function explodeUrl($url,$img = ''){
	$str = empty($url) ?'': explode("\n",$url);
	foreach ((array)$str as $key=>$row){
		$key = $key+1;
		$result .= "<a href='$row' target='_blank'><img src='$img' align='absmiddle'/>下载地址 $key</a><br />";
	}
	echo $result;
}

function sysmd5($str,$key='',$type='sha1'){
	$key =  $key ?  $key : C('ADMIN_ACCESS');
	return hash ( $type, $str.$key );
}

/**
* @param string $string 原文或者密文
* @param string $operation 操作(ENCODE | DECODE), 默认为 DECODE
* @param string $key 密钥
* @param int $expiry 密文有效期, 加密时候有效， 单位 秒，0 为永久有效
* @return string 处理后的 原文或者 经过 base64_encode 处理后的密文
*
* @example
*
*  $a = authcode('abc', 'ENCODE', 'key');
*  $b = authcode($a, 'DECODE', 'key');  // $b(abc)
*
*  $a = authcode('abc', 'ENCODE', 'key', 3600);
*  $b = authcode('abc', 'DECODE', 'key'); // 在一个小时内，$b(abc)，否则 $b 为空
*/
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) 
{
	$ckey_length = 4;   
	// 随机密钥长度 取值 0-32;
	// 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
	// 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
	// 当此值为 0 时，则不产生随机密钥

	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);
	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);
	$result = '';
	$box = range(0, 255);
	$rndkey = array();
	for($i = 0; $i <= 255; $i++){
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}
	for($j = $i = 0; $i < 256; $i++){
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}
	for($a = $j = $i = 0; $i < $string_length; $i++){
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}
	if($operation == 'DECODE'){
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)){
			return substr($result, 26);
		} 
		else{
			return '';
		}
	} 
	else{
		return $keyc.str_replace('=', '', base64_encode($result));
	}
}
/**
* @param string $string 原文或者密文
* @param string $operation 操作(ENCODE | DECODE), 默认为 ENCODE
* @param string $key 密钥
*/
function url_auth($txt, $operation = 'ENCODE', $key = ''){
    $key    = $key ? $key : C('ADMIN_ACCESS');
    $txt    = $operation == 'ENCODE' ? $txt : base64_decode($txt);
    $len    = strlen($key);
    $code    = '';
    for($i=0; $i<strlen($txt); $i++){
        $k        = $i % $len;
        $code  .= $txt[$i] ^ $key[$k];
    }
    $code = $operation == 'DECODE' ? $code : base64_encode($code);
    return $code;
}
// 计算身份证校验码，根据国家标准GB 11643-1999 
function idcard_verify_number($idcard_base) { 
	if(strlen($idcard_base) != 17) { 
		return false; 
	} 
	//加权因子 
	$factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2); 
	//校验码对应值 
	$verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'); 
	$checksum = 0; 
	for ($i = 0; $i < strlen($idcard_base); $i++) { 
		$checksum += substr($idcard_base, $i, 1) * $factor[$i]; 
	} 
	$mod = $checksum % 11; 
	$verify_number = $verify_number_list[$mod]; 
	return $verify_number; 
}
// 18位身份证校验码有效性检查 
function idcard_check($idcard){ 
	if (strlen($idcard) != 18){ return false; } 
	$idcard_base = substr($idcard, 0, 17); 
	if (idcard_verify_number($idcard_base) != strtoupper(substr($idcard, 17, 1))){ 
		return false; 
	}else{
		return true; 
	} 
}
/**
 * pkcs7补码
 *
 * @param string $string  明文
 * @param int $blocksize Blocksize , 以 byte 为单位
 *
 * @return String
 */ 
function addPkcs7Padding($string, $blocksize = 32) {
    $len = strlen($string); //取得字符串长度
    $pad = $blocksize - ($len % $blocksize); //取得补码的长度
    $string .= str_repeat(chr($pad), $pad); //用ASCII码为补码长度的字符， 补足最后一段
    return $string;
}
/**
 * 加密然后base64转码
 * 
 * @param String 明文
 * @param 加密的初始向量（IV的长度必须和Blocksize一样， 且加密和解密一定要用相同的IV）
 * @param $key 密钥
 */
function aes256cbcEncrypt($str, $iv, $key ) {	
	return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, addPkcs7Padding($str) , MCRYPT_MODE_CBC, $iv));
}
/**
 * 除去pkcs7 padding
 * 
 * @param String 解密后的结果
 * 
 * @return String
 */
function stripPkcs7Padding($string){
    $slast = ord(substr($string, -1));
    $slastc = chr($slast);
    $pcheck = substr($string, -$slast);
    if(preg_match("/$slastc{".$slast."}/", $string)){
        $string = substr($string, 0, strlen($string)-$slast);
        return $string;
    } else {
        return false;
    }
}
/**
 * 解密
 * 
 * @param String $encryptedText 二进制的密文 
 * @param String $iv 加密时候的IV
 * @param String $key 密钥
 * 
 * @return String
 */
function aes256cbcDecrypt($encryptedText, $iv, $key) {
	$encryptedText =base64_decode($encryptedText);
	return stripPkcs7Padding(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $encryptedText, MCRYPT_MODE_CBC, $iv));
}

function content_page($content,$id){
    $contents=split(C('PAGE_BREAK_TAG'),$content);
    $totalsize=count($contents);
    import('ORG.Util.Page');
    $pagesize=1;
    $PageParam = C("VAR_PAGE");
    $page = new Page($totalsize,$pagesize);
    //$page->setLinkWraper("li");
    //$page->SetPager('default', $pagetpl, array("listlong" => "6", "first" => "首页", "last" => "尾页", "prev" => "上一页", "next" => "下一页", "list" => "*", "disabledclass" => ""));
    $page->parameter   .=   $id.'/';
    $content=$contents[$page->firstRow];
    $data['content']=$content;
    if(1 !== count($contents)){
        $data['page']=$page->show();
    }
    return $data;
}
function htmlSubString($content,$maxlen=300){
    //把字符按HTML标签变成数组。
    $content = preg_split("/(<[^>]+?>)/si",$content, -1,PREG_SPLIT_NO_EMPTY| PREG_SPLIT_DELIM_CAPTURE);
    $wordrows=0; //中英字数
    $outstr="";  //生成的字串
    $wordend=false; //是否符合最大的长度
    $beginTags=0; //除<img><br><hr>这些短标签外，其它计算开始标签，如<div*>
    $endTags=0;  //计算结尾标签，如</div>，如果$beginTags==$endTags表示标签数目相对称，可以退出循环。
    //print_r($content);
    foreach($content as $value){
        if (trim($value)=="") continue; //如果该值为空，则继续下一个值
        if (strpos(";$value","<")>0){
            //如果与要载取的标签相同，则到处结束截取。
            if (trim($value)==$maxlen) {
                $wordend=true;
                continue;
            }
            if ($wordend==false){
                $outstr.=$value;
                if (!preg_match("/<img([^>]+?)>/is",$value) && !preg_match("/<param([^>]+?)>/is",$value) && !preg_match("/<!([^>]+?)>/is",$value) && !preg_match("/<br([^>]+?)>/is",$value) && !preg_match("/<hr([^>]+?)>/is",$value)) {
                    $beginTags++; //除img,br,hr外的标签都加1
                }
            }else if (preg_match("/<\/([^>]+?)>/is",$value,$matches)){
                $endTags++;
                $outstr.=$value;
                if ($beginTags==$endTags && $wordend==true) break; //字已载完了，并且标签数相称，就可以退出循环。
            }else{
                if (!preg_match("/<img([^>]+?)>/is",$value) && !preg_match("/<param([^>]+?)>/is",$value) && !preg_match("/<!([^>]+?)>/is",$value) && !preg_match("/<br([^>]+?)>/is",$value) && !preg_match("/<hr([^>]+?)>/is",$value)) {
                    $beginTags++; //除img,br,hr外的标签都加1
                    $outstr.=$value;
                }
            }
        }else{
            if (is_numeric($maxlen)){ //截取字数
                $curLength=getStringLength($value);
                $maxLength=$curLength+$wordrows;
                if ($wordend==false){
                    if ($maxLength>$maxlen){ //总字数大于要截取的字数，要在该行要截取
                        $outstr.=subString($value,0,$maxlen-$wordrows);
                        $wordend=true;
                    }else{
                        $wordrows=$maxLength;
                        $outstr.=$value;
                    }
                }
            }else{
                if ($wordend==false) $outstr.=$value;
            }
        }
    }
    //循环替换掉多余的标签，如<p></p>这一类
    while(preg_match("/<([^\/][^>]*?)><\/([^>]+?)>/is",$outstr)){
        $outstr=preg_replace_callback("/<([^\/][^>]*?)><\/([^>]+?)>/is","strip_empty_html",$outstr);
    }
    //把误换的标签换回来
    if (strpos(";".$outstr,"[html_")>0){
        $outstr=str_replace("[html_&lt;]","<",$outstr);
        $outstr=str_replace("[html_&gt;]",">",$outstr);
    }
    //echo htmlspecialchars($outstr);
    return $outstr;
}
//取得字符串的长度，包括中英文。
function getStringLength($text){
    if (function_exists('mb_substr')) {
        $length=mb_strlen($text,'UTF-8');
    } elseif (function_exists('iconv_substr')) {
        $length=iconv_strlen($text,'UTF-8');
    } else {
        preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $text, $ar);
        $length=count($ar[0]);
    }
    return $length;
}
/***********按一定长度截取字符串（包括中文）*********/
function subString($text, $start=0, $limit=12) {
    if (function_exists('mb_substr')) {
        $more = (mb_strlen($text,'UTF-8') > $limit) ? TRUE : FALSE;
        $text = mb_substr($text, 0, $limit, 'UTF-8');
        $text = $text.'...';
        return $text;
    } elseif (function_exists('iconv_substr')) {
        $more = (iconv_strlen($text,'UTF-8') > $limit) ? TRUE : FALSE;
        $text = iconv_substr($text, 0, $limit, 'UTF-8');
        $text = $text.'...';
        //return array($text, $more);
        return $text;
    } else {
        preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $text, $ar);
        if(func_num_args() >= 3) {
            if (count($ar[0])>$limit) {
                $more = TRUE;
                $text = join("",array_slice($ar[0],0,$limit));
            } else {
                $more = FALSE;
                $text = join("",array_slice($ar[0],0,$limit));
            }
        } else {
            $more = FALSE;
            $text =  join("",array_slice($ar[0],0));
        }
        return $text;
    }
}