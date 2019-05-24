<?php
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
//  if(attachTrue($_FILES[$attachFields]['name'])){
//      $globalConfig = getContent('cms.config.php','.');
//      $globalAttachSize = intval($globalConfig['global_attach_size']);
//      $globalAttachSuffix = $globalConfig['global_attach_suffix'];
//      $dot = '/';
//      $setFolder = empty($model) ?'file/': $model .$dot ;
//      $setUserPath = empty($path) ?'': makeFolderName($path) ;
//      $finalPath = UPLOAD_PATH.$dot.$setFolder.$setUserPath;
//      if(!is_dir($finalPath)){
//          @mk_dir($finalPath);
//      }
//      import("ORG.Net.UploadFile");
//      $upload = new UploadFile();
//      $upload->maxSize = empty($fileSize) ?$globalAttachSize : intval($fileSize) ;
//      $upload->allowExts = empty($allowExts) ?explode(',',$globalAttachSuffix) : explode(',',$allowExts) ;
//      $upload->savePath = $finalPath;
//        /* //缩略图使用
//      $upload->saveRule = 'uniqid';
//      switch ($model){
//          case 'News':
//              $globalThumbStatus = intval($globalConfig['news_thumb_status']);;
//              $globalThumbSize = trim($globalConfig['news_thumb_size']);
//              break;
//          case 'Product':
//              $globalThumbStatus = intval($globalConfig['product_thumb_status']);;
//              $globalThumbSize = trim($globalConfig['product_thumb_size']);
//              break;
//          case 'Download':
//              $globalThumbStatus = intval($globalConfig['download_thumb_status']);;
//              $globalThumbSize = trim($globalConfig['download_thumb_size']);
//              break;
//          default:
//              $globalThumbStatus = intval($globalConfig['global_thumb_status']);;
//              $globalThumbSize = trim($globalConfig['global_thumb_size']);
//              break;
//      }
//      $globalThumbSizeExplode = explode(',',$globalThumbSize);
//      $userThumbSizeExplode = explode(',',$thumbSize);
//      if(!empty($globalThumbStatus) &&!empty($thumbStatus)){
//          $upload->thumb = true;
//      }else{
//          $upload->thumb = false;
//      }
//      if(!empty($thumbStatus) &&!empty($thumbSize)){
//          $upload->thumbMaxWidth = $userThumbSizeExplode[0] ;
//          $upload->thumbMaxHeight = $userThumbSizeExplode[1] ;
//      }else{
//          $upload->thumbMaxWidth = $globalThumbSizeExplode[0] ;
//          $upload->thumbMaxHeight = $globalThumbSizeExplode[1] ;
//      }
//      $upload->thumbPrefix = '';
//      $upload->thumbSuffix = '_s';
//        */
//      if(!$upload->upload()){
//          echo ($upload->getErrorMsg());
//      }else{
//          return $upload->getUploadFileInfo();
//      }
//  }
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
        $writeData = "<?php\n/** \n* cache.{$fileName}.php\n*\n* @package       Y-city Corp\n* @author          Y-city <y_city@qeeyang.com>\n* @copyright       Copyright (c) 2008-2012  (http://www.y-city.net.cn)\n* @version         YCITYCMS v2.2.0 2012-03-26 Y-city $\n   \n*/\n\nif (!defined('YCITYCMS')) exit();\n\nreturn ";
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
    $writeDataHeader = "<?php\n/** \n* cache.{$fileName}.php\n*\n* @package         Y-city Corp\n* @author          Y-city <y_city@qeeyang.com>\n* @copyright       Copyright (c) 2008-2012  (http://www.y-city.net.cn)\n* @version         YCITYCMS v2.2.0 2012-03-26 Y-city $\n*/\n\nif (!defined('YCITYCMS')) exit();\n\nreturn array(\r\n";
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
function getContent($file = NULL,$path = NULL){
        $gFile = empty($file) ?exit('error function getFile: file is LOST') : $file ;
        $getPath = empty($path) ?DATA : $path ;
        $getFile = $getPath .'/'.$gFile;
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


function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }


    /**
     * 使用curl获取远程数据
     * @param  string $url url连接
     * @return string      获取到的数据
     */
    function curl_get_contents($url){
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);                //设置访问的url地址
        // curl_setopt($ch,CURLOPT_HEADER,1);               //是否显示头部信息
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);               //设置超时
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);   //用户访问代理 User-Agent
        curl_setopt($ch, CURLOPT_REFERER,$_SERVER['HTTP_HOST']);        //设置 referer
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);          //跟踪301
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        //返回结果
        $r=curl_exec($ch);
        curl_close($ch);
        return $r;
    }


function encrypt($string,$operation,$key=''){
    $key=md5($key);
    $key_length=strlen($key);
    $string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,8).$string;
    $string_length=strlen($string);
    $rndkey=$box=array();
    $result='';
    for($i=0;$i<=255;$i++){
        $rndkey[$i]=ord($key[$i%$key_length]);
        $box[$i]=$i;
    }
    for($j=$i=0;$i<256;$i++){
        $j=($j+$box[$i]+$rndkey[$i])%256;
        $tmp=$box[$i];
        $box[$i]=$box[$j];
        $box[$j]=$tmp;
    }
    for($a=$j=$i=0;$i<$string_length;$i++){
        $a=($a+1)%256;
        $j=($j+$box[$a])%256;
        $tmp=$box[$a];
        $box[$a]=$box[$j];
        $box[$j]=$tmp;
        $result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
    }
    if($operation=='D'){
       if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8)){
           return substr($result,8);
      }else{
           return'';
      }
    }else{
        return str_replace('=','',base64_encode($result));
    }
}
/**
 * 去除多维数组中的空值
 * @author
 * @param $arr array 目标数组
 * @param array $values 去除的值  默认 去除  '',null,false,0,'0',[]
 * @return mixed
 */
function filter_array($arr, $values = ['', null, false, 0, '0',[]]) {
    foreach ($arr as $k => $v) {
        if (is_array($v) && count($v)>0) {
            $arr[$k] = filter_array($v, $values);
            foreach ($values as $value) {
                if ($arr[$k] === $value) {
                    unset($arr[$k]);
                    break;
                }
            }
        }
        foreach ($values as $value) {
            if ($v === $value) {
                unset($arr[$k]);
                break;
            }
        }
    }
    return $arr;
}

//生成正确专业名称
function correctZyname($zy){
    //根据配置项特殊处理重复专业代码的专业
    /*$getConfig = getContent('cms.config.php','.');
    $special_zydm = explode(',',str_replace('，',',',$getConfig['zyfx']));//配置中特殊项
    if (in_array($zy['zydm'],$special_zydm)){
        $zyname = $zy['zymc'];
    }else{
        $condition = [];
        $condition['year'] = $zy['year'];
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
    return $zyname;*/

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
        }elseif($zy['zydm'] == '600401'){
            if ($zy['year'] < 2018){
                if(strpos($zy['zymc'], '地面')){
                    $zyname = '民航运输（地面服务）';
                }elseif(strpos($zy['zymc'], '机场')||strpos($zy['zymc'], '指挥')){
                    $zyname = '民航运输（机场指挥）';
                }elseif(strpos($zy['zymc'], '通航')||strpos($zy['zymc'], '服务')){
                    $zyname = '民航运输（通航综合航务）';
                }else{
                    $zyname = '民航运输';
                }
            }else{
                $zyname = '民航运输';
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