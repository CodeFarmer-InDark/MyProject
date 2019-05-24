<?php 
/**
 * 
 * Case(案例)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

class VideoAction extends AdminAction
{
    protected $category, $dao;
    function _initialize()
    {
        parent::_initialize();
        //取所有分类，过滤出新闻模块主ID
        $category = M('Category')->Order('display_order DESC,id DESC')->select();
        foreach ((array)$category as $row){
            if($row['module'] == 'Video'){
                $parentId = $row['id'];
            }
        }
        //取主ID下属分类
        $this->assign('parentId', $parentId);
        $this->assign('category', $category);

        $this->dao = D('Video');
    }

    /**
     * 列表
     *
     */
    public function index()
    {
        parent::_checkPermission();
        $condition = array();
        //$title = formatQuery($_GET['title']);
        $title = iconv("gb2312","utf-8",$_GET['title']);
        $recommend = intval($_GET['recommend']);
        
        $status =  intval($_GET['status']);
        $istop = intval($_GET['istop']);

        $createTime = trim($_GET['createTime']);
        $createTime1 = trim($_GET['createTime1']);
        $viewCount = intval($_GET['viewCount']);
        $viewCount1 = intval($_GET['viewCount1']);

        $setTime = setTime($createTime, $createTime1);
        $setViewCount = setViewCount($viewCount, $viewCount1);
        $pageSize = intval($_GET['pageSize']);
        $title &&  $condition['title'] = array('like', '%'.$title.'%');
        $recommend &&  $condition['recommend'] = array('eq', $recommend);

        $status && $condition['status'] = array('eq', $status);
        $istop &&  $condition['istop'] = array('eq', $istop);
        $createTime1 && $condition['create_time'] = array('between', $setTime);
        $viewCount1 && $condition['view_count'] = array('between', $setViewCount);
        $count = $this->dao->where($condition)->count();
        $listRows = empty($pageSize) || $pageSize>100 ? 15 : $pageSize ;
        $p = new page($count,$listRows);
        
        $dataList = $this->dao->Field('*')->order('istop desc,id desc')->Where($condition)->Limit($p->firstRow.','.$p->listRows)->select();

        $page = $p->show();
        if($dataList !== false)
        {
            $this->assign('pageBar', $page);
            $this->assign('dataList', $dataList);
        }
        parent::_sysLog('index');
        $this->display();
    }

    /**
     * 写入
     *
     */
    public function insert()
    {
        parent::_checkPermission();
        $this->display();
    }

    /**
     * 提交录入
     *
     */
    public function doInsert()
    {
        parent::_checkPermission('Video_insert');
        ini_set('memory_limit','1024M');
        set_time_limit(1000);

        if($daoCreate = $this->dao->create())
        {
            $this->dao->user_id = parent::_getAdminUid();
            $this->dao->username = parent::_getAdminName();

//            $fileurl = stripslashes($_POST['videourl']);
//            if ($fileurl){
//                $videourl = substr($fileurl, 10);  // 从左边第十位截取url 去除./Uploads/
//                $this->dao->videoUrl = $videourl;
//            }else{
//                parent::_message('error','请先上传视频文件');
//            }
            $fileurl = htmlCv(dHtml($_POST['videourl']));
            if ($fileurl == ''){
                parent::_message('error','请先上传视频文件');
            }else{
                $this->dao->videoUrl = $fileurl;
            }
            $uploadFile = upload($this->getActionName());
            if ($uploadFile)
            {
                $this->dao->attach = 1;
                $attach_file = formatAttachPath($uploadFile[0]['savepath']) . $uploadFile[0]['savename'];
                $picurl = substr($attach_file, 1);
                $this->dao->attach_file = $picurl;
            }
            $daoAdd = $this->dao->add();
           
            if(false != $daoAdd)
            {
                parent::_tags('insert', $_POST['tags'], $daoAdd);
                parent::_sysLog('insert', "录入:$daoAdd");
                parent::_message('success', '录入成功');
            }else
            {
                parent::_message('error', '录入失败');
            }
        }else
        {
            parent::_message('error', $this->dao->getError());
        }
    }

    /**
     * 编辑
     *
     */
    public function modify()
    {
        parent::_checkPermission();
//        $rooturl =  ; #localhost
//        $this->assign('rooturl',$rooturl);
        $item = intval($_GET["id"]);
        $record = $this->dao->where('id='.$item)->find();
        if (empty($item) || empty($record)) parent::_message('error', '记录不存在');
        $this->assign('vo', $record);
        $this->display();
    }

    /**
     * 提交编辑
     *
     */
    public function doModify()
    {
        parent::_checkPermission('Video_modify');
        parent::_setMethod('post');
        ini_set('memory_limit','1024M');
        set_time_limit(1000);
        $item = intval($_POST['id']);
        empty($item) && parent::_message('error', '记录不存在');
        if($daoCreate = $this->dao->create())
        {
            $fileurl = htmlCv(dHtml($_POST['videourl']));
            if ($fileurl == ''){
                parent::_message('error','请先上传视频文件');
            }else{
                $this->dao->videoUrl = $fileurl;
            }
            @unlink('./'.$this->upload.$_POST['old_file']);

            $uploadFile = upload($this->getActionName());
            if ($uploadFile)
            {
                $this->dao->attach = 1;
                $attach_file = formatAttachPath($uploadFile[0]['savepath']) . $uploadFile[0]['savename'];
                $picurl = substr($attach_file, 1);
                $this->dao->attach_file = $picurl;

                @unlink('./'.$this->upload.$_POST['old_image']);
            }

            $daoSave = $this->dao->save();
            if(false !== $daoSave)
            {
                parent::_tags('modify', $_POST['tags'], $item);
                parent::_sysLog('modify', "编辑:$item");
                parent::_message('success', '更新完成');
            }else
            {
                parent::_message('error', '更新失败');
            }
        }else
        {
            parent::_message('error', $this->dao->getError());
        }
    }
    /**
     * 批量操作
     *
     */
    public function doCommand()
    {
        parent::_checkPermission('Video_command');
        if(getMethod() == 'get'){
            $operate = trim($_GET['operate']);
        }elseif(getMethod() == 'post'){
            $operate = trim($_POST['operate']);
        }else{
            parent::_message('error', '只支持POST,GET数据');
        }
        $newCategory = intval($_POST['newCategory']);
        switch ($operate){
            case 'delete': parent::_delete('video', 0, array('attach_image', 'attach_thumb'));break;
            case 'setStatus': parent::_setStatus('set','video');break;
            case 'unSetStatus': parent::_setStatus('unset','video');break;
            case 'setTop': parent::_setTop('set');break;
            case 'unSetTop': parent::_setTop('unset');break;
            case 'update': parent::_batchModify('video', $_POST, array('title','display_order'), __URL__,'Video', 'display_order DESC,id DESC');break;
            default: parent::_message('error', '操作类型错误') ;
        }
    }

    /**
     * 大文件切片上传
     */
    public function VideoUpload(){
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
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

        $dot="/";
        $path=1;
        $setFolder = 'Video/';
        $setUserPath = makeFolderName($path) ;
        $uploadDir = UPLOAD_PATH.$dot.$setFolder.$setUserPath;
        $targetDir = $uploadDir.'/upload_tmp';
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        // header("HTTP/1.0 500 Internal Server Error");
        // exit;
        // 5 minutes execution time
        @set_time_limit(5 * 60);
        // Uncomment this one to fake upload time
        // usleep(5000);
        // Settings
        // $targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
        
        // 验证缓存目录是否存在不存在创建
        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }
        // 验证缓存目录是否存在不存在创建
        if (!file_exists($uploadDir)) {
            @mkdir($uploadDir);
        }
        // Get 或 file 方式获取文件名
        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
        } else {
            $fileName = uniqid("file_");
        }
        $oldName = $fileName;//记录文件原始名字
        $filePath = $targetDir . $fileName;
        // $uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;
        // 删除缓存校验
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }
            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir  . $file;
                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
                    continue;
                }
                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.(part|parttmp|mp4)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }
        // 打开并写入缓存文件
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
        //文件全部上传 执行合并文件
        if ( $done ) {
            $pathInfo = pathinfo($fileName);
            $hashStr = substr(md5($pathInfo['basename']),8,16);
            $hashName = time() . $hashStr . '.' .$pathInfo['extension'];
            $uploadPath = $uploadDir .$hashName;
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
            /*/腾讯云--对象存储
            vendor('TencentYun/TencentYunSendFile');
            $Yun = new \TencentYunSendFile();
            $res = $Yun->uploadYun(array('tmp_name'=>$uploadPath,'name'=>$hashName),'video');
            var_dump($res);*/
            //引用第三方类库
            /*vendor('getid3.getid3');
            $getID3 = new \getID3(); //实例化类
            $ThisFileInfo = $getID3->analyze($uploadPath);//分析文件*/
            $response = array(
                'success'=>true,
                'oldName'=>$setFolder.$setUserPath.$hashName,
                //'filePaht'=>$hashName,
                //'filePaht'=>substr($uploadPath,1),
                'fileSuffixes'=>$pathInfo['extension'],
                'time' =>$ThisFileInfo['playtime_string'],
            );
            //删除源文件
            /*unlink($uploadPath);*/
            die(json_encode($response));
        }
        // Return Success JSON-RPC response
        die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
    }

//    public function webupload(){
//        // Make sure file is not cached (as it happens for example on iOS devices)
//        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
//        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
//        header("Cache-Control: no-store, no-cache, must-revalidate");
//        header("Cache-Control: post-check=0, pre-check=0", false);
//        header("Pragma: no-cache");
//
//        // Support CORS
//        // header("Access-Control-Allow-Origin: *");
//        // other CORS headers if any...
//        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//            exit; // finish preflight CORS requests here
//        }
//
//        if ( !empty($_REQUEST[ 'debug' ]) ) {
//            $random = rand(0, intval($_REQUEST[ 'debug' ]) );
//            if ( $random === 0 ) {
//                header("HTTP/1.0 500 Internal Server Error");
//                exit;
//            }
//        }
//
//        // header("HTTP/1.0 500 Internal Server Error");
//        // exit;
//
//        // 5 minutes execution time
//        @set_time_limit(5 * 60);
//
//        // Uncomment this one to fake upload time
//        // usleep(5000);
//        
//        // Settings
//        // $targetDir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
//        
//        $dot="/";
//        $path=1;
//        $setFolder = 'Video/';
//        $setUserPath = makeFolderName($path) ;
//        $uploadDir = UPLOAD_PATH.$dot.$setFolder.$setUserPath;
//        $targetDir = $uploadDir.'/upload_tmp';
//        $cleanupTargetDir = true; // Remove old files
//        $maxFileAge = 5 * 3600; // Temp file age in seconds
//
//        // Create target dir
//        if (!file_exists($targetDir)) {
//            @mkdir($targetDir);
//        }
//
//        // Create target dir
//        if (!file_exists($uploadDir)) {
//            @mkdir($uploadDir);
//        }
//
//        // Get a file name
//        if (isset($_REQUEST["name"])) {
//            $fileName = $_REQUEST["name"];
//        } elseif (!empty($_FILES)) {
//            $fileName = $_FILES["file"]["name"];
//        } else {
//            $fileName = uniqid("file_");
//        }
//
//        $saveName = $this->getSaveName();
//        $filePath = $targetDir . DIRECTORY_SEPARATOR . $saveName;
//        $uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $saveName;
//
//        // Chunking might be enabled
//        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
//        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;
//
//        // Remove old temp files
//        if ($cleanupTargetDir) {
//            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
//                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
//            }
//
//            while (($file = readdir($dir)) !== false) {
//                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;
//
//                // If temp file is current file proceed to the next
//                if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
//                    continue;
//                }
//
//                // Remove temp file if it is older than the max age and is not the current file
//                if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
//                    @unlink($tmpfilePath);
//                }
//            }
//            closedir($dir);
//        }
//
//        // Open temp file
//        if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
//            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
//        }
//
//        if (!empty($_FILES)) {
//            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
//                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
//            }
//
//            // Read binary input stream and append it to temp file
//            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
//                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
//            }
//        } else {
//            if (!$in = @fopen("php://input", "rb")) {
//                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
//            }
//        }
//
//        while ($buff = fread($in, 4096)) {
//            fwrite($out, $buff);
//        }
//        @fclose($out);
//        @fclose($in);
//        rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");
//        $index = 0;
//        $done = true;
//        for( $index = 0; $index < $chunks; $index++ ) {
//            if ( !file_exists("{$filePath}_{$index}.part") ) {
//                $done = false;
//                break;
//            }
//        }
//        if ( $done ) {
//            if (!$out = @fopen($uploadPath, "wb")) {
//                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
//            }
//
//            if ( flock($out, LOCK_EX) ) {
//                for( $index = 0; $index < $chunks; $index++ ) {
//                    if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
//                        break;
//                    }
//
//                    while ($buff = fread($in, 4096)) {
//                        fwrite($out, $buff);
//                    }
//
//                    @fclose($in);
//                    @unlink("{$filePath}_{$index}.part");
//                }
//
//                flock($out, LOCK_UN);
//            }
//            @fclose($out);
//        }
//
//        // Return Success JSON-RPC response
//        //die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
//        $this->ajaxReturn($uploadPath,'json');
//    }
//
//    protected function ajaxReturn($data,$info='',$status=1,$type='') {
//        $result  =  array();
//        $result['status']  =  $status;
//        $result['info'] =  $info;
//        $result['data'] = $data;
//        //扩展ajax返回数据, 在Action中定义function ajaxAssign(&$result){} 方法 扩展ajax返回数据。
//        if(method_exists($this,'ajaxAssign'))
//            $this->ajaxAssign($result);
//        if(empty($type)) $type  =   C('DEFAULT_AJAX_RETURN');
//        if(strtoupper($type)=='JSON') {
//            // 返回JSON数据格式到客户端 包含状态信息
//            header('Content-Type:text/html; charset=utf-8');
//            exit(json_encode($result));
//        }elseif(strtoupper($type)=='XML'){
//            // 返回xml格式数据
//            header('Content-Type:text/xml; charset=utf-8');
//            exit(xml_encode($result));
//        }elseif(strtoupper($type)=='EVAL'){
//            // 返回可执行的js脚本
//            header('Content-Type:text/html; charset=utf-8');
//            exit($data);
//        }else{
//            // TODO 增加其它格式
//        }
//    }

    /**
     * 根据上传文件命名规则取得保存文件名
     * @access private
     * @param string $filename 数据
     * @return string
     */
    private function getSaveName() {
        $rule = 'uniqid';
        $saveName = $rule().'.mp4';
        return $saveName;
    }
    
}
