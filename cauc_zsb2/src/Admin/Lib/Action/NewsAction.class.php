<?php
/**
 *
 * News(新闻)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

class NewsAction extends AdminAction
{
    protected $category , $dao;
    function _initialize()
    {
        parent::_initialize();

        $roleId = intval($_SESSION['roleId']);
        $mapRole['id'] = $roleId;
        $categoryPermission = M('Role')->where($mapRole)->getField('category_permission');
        $categoryPermissionArr = explode(',',$categoryPermission);

        $mapCategory = array();
        $mapCategory['module'] = array('eq','List');
        $mapCategory['keyword'] = array('neq','OPEN');
        if ($categoryPermissionArr[0] != 'all'){
            $mapCategory['id'] = array('in',$categoryPermissionArr);
        }
        $this->category = D('Category')->where($mapCategory)->Order('display_order DESC,id desc')->select();
        //取主ID下属分类
        $this->assign('category', $this->category);
       
        $this->dao = D('content');
    }

    /**
     * 列表
     *
     */
    public function index()
    {
        parent::_checkPermission();
        $condition = array();
        $title = formatQuery($_GET['title']);
        $cid = formatQuery($_GET['cid']);
        $category_id = formatQuery($_GET['category_id']);
        $categoryId = intval($_GET['categoryId']);
        $categoryId &&  $condition['c.category_id'] = array('eq', $categoryId);
        $title &&  $condition['c.title'] = array('like', '%'.$title.'%');
        $cid &&  $condition['c.id'] = array('like', '%'.$cid.'%');
        $category_id &&  $condition['c.category_id'] = array('eq',$category_id);

        $count = $this->dao->Table(C('DB_PREFIX').'content c')->Join(C('DB_PREFIX').'category s on c.category_id = s.id')->where($condition)->count();
        $listRows = empty($pageSize) || $pageSize > 100 ? 15 : $pageSize ;
        $p = new page($count, $listRows);
        //$dataList = $this->dao->Table(C('DB_PREFIX').'content c')->Join(C('DB_PREFIX').'category s on s.id=c.category_id')->Field('s.title as gtitle,s.parent_id,c.*')->Order( 'c.id DESC')->Where($condition)->Limit($p->firstRow.','.$p->listRows)->select();

        //select category_id,id, title,status,attach,istop from ycity_content order by c.id desc
        $dataList = $this->dao->Table(C('DB_PREFIX').'content c')->Field('category_id as gtitle,id, title,status,attach,istop,description,content,create_time,display_order')->Order('id desc')->where($condition)->Limit($p->firstRow.','.$p->listRows)->select();
        

        foreach($dataList as $k => $v)
        {
            //只有一个分类
            if(strpos($v['gtitle'],',') == 0)
            {
                foreach($this->category as $val)
                {
                    if($v['gtitle'] == $val['id'])
                    {
                        $dataList[$k]['gtitle'] = $val['title'];
                        break;
                    }
                }
            }
            //有多个分类
            else{
                $arr = explode(',',$v['gtitle']);
                $categoryName = [];
                foreach($this->category as $val)
                {
                    if(in_array($val['id'],$arr))
                    {
                        $categoryName[] = $val['title'];
                    }
                }
                $dataList[$k]['gtitle'] = implode(',',$categoryName);
                }
        
        }
        $page = $p->show();
        //dump($dataList);return;
        if ($dataList !== false)
        {
            $this->assign('pageBar', $page);
            $this->assign('dataList', $dataList);
        }
        parent::_sysLog('index');
         $this->display();
    }

    /**
     * 录入
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
        parent::_checkPermission('News_insert');
        parent::_setMethod('post');
        $categoryId = $_POST['category_id'];//分类id  选几个有几个  23,24,25
        $roleId = intval($_SESSION['roleId']);
        $mapRole['id'] = $roleId;
        $categoryPermission = M('Role')->where($mapRole)->getField('category_permission');//权限
        if ($categoryPermission != 'all'){
            foreach ($categoryId as $key => $val) {
                if(strpos($categoryPermission,',') == false){ //只有一个分类（一个权限）
                    if ($val != $categoryPermission){
                        parent::_message('error', '当前角色组无权限添加该分类下的文章，请联系管理员授权',0,20);
                    }
                }else{
                    $categoryPermissionArr = explode(',',$categoryPermission);
                    if (!in_array($val,$categoryPermissionArr)){
                        parent::_message('error', '当前角色组无权限添加该分类下的文章，请联系管理员授权',0,20);
                    }
                }
            }
        }
        
        if($daoCreate = $this->dao->create())
        {
            $this->dao->user_id = parent::_getAdminUid();
            $this->dao->username = parent::_getAdminName();
            
            $uploadFile = upload($this->getActionName());
            if ($uploadFile)
            {
                $this->dao->attach = count($uploadFile);
                $file_path = array();
                foreach ($uploadFile as $key => $val) {
                    $file_path[] = formatAttachPath($val['savepath'], '../Uploads/') . $val['savename'];
                }
                $this->dao->attach_file = implode(',',$file_path);
            }
            if ($_POST['flash']){
                $this->dao->publish = 1;
            }
            if ($_POST['open']){
                $this->dao->publish = 2;
            }
            if ($_POST['flash'] && $_POST['open']){
                $this->dao->publish = 3;
            }
            $this->dao->create_time = time();
            //多条数据插入
            $data = $this->dao->data();
            $categorys = [];
            foreach ($categoryId as $key => $val) {
                if(!in_array($val,$categorys)){
                    $categorys[] = $val;
                }
            }
            $data['category_id'] = implode(',',$categorys);
            $daoAdd = $this->dao->add($data);
            if(false !== $daoAdd){
                parent::_tags('insert', $_POST['tags'], $daoAdd);
                parent::_sysLog('insert', "录入:$daoAdd");
                parent::_message('success', '录入成功');
            }else{
                parent::_message('error', '录入失败');
            }
        }else{
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
        $item = intval($_GET["id"]);
        $record = $this->dao->where('id='.$item)->find();
        
        //dump($record);return;
        //多个附件路径分割
        $record['attach'] = explode(',',$record['attach']);
        $record['attach_file'] = explode(',',$record['attach_file']);
        for($i=0; $i<count($record['attach']);$i++)
        {
            //$fileInfo[] = $record['attach'][$i].','.$record['attach_file'][$i];
            $fileInfo[$i]['attach']=$record['attach'][$i];
            $fileInfo[$i]['attach_file']=$record['attach_file'][$i];
        }
        if (empty($item) || empty($record)) parent::_message('error', '记录不存在');
        if($record){
            //查分类
            $id=$record['category_id'];
            //只有一个分类
            if(strpos($id,',') == false)
            {
                $type = D('Category')->Field('title,id,parent_id')->Order('display_order DESC,id asc')->where("id=$id")->select();
                $this->assign('type',$type[0]['id']);
            }
            //多个分类
            else
            {
                $condition['id'] = ['in',$id];
                $type = D('Category')->Field('title,id,parent_id')->Order('display_order DESC,id asc')->where($condition)->select();
                foreach($type as $v)
                {
                    $types['id'][] = $v['id'];
                }
                $this->assign('types',$types['id']);
                
            }
            $this->assign('vo', $record);//这条数据
            $this->assign('fileinfo',$fileInfo);//附件信息
            
        }
        $this->assign('publish',$record['publish']);

        $mapCategory = array();
        $mapCategory['module'] = array('eq','List');
        $mapCategory['keyword'] = array('neq','OPEN');
        //所有类别
        $category = D('Category')->where($mapCategory)->Order('display_order DESC,id desc')->select();
        $this->assign('category',$category);
        $this->display();
    }

    /**
     * 提交编辑
     *
     */
    public function doModify()
    {

        parent::_checkPermission('News_modify');
        parent::_setMethod('post');
        $item = intval($_POST['id']);
        empty($item) && parent::_message('error', '记录不存在');
        //$categoryId = intval($_POST['category_id']);
        //zj改
        $categoryId = $_POST['category_id'];//分类id  选几个有几个  23,24,25
        $roleId = intval($_SESSION['roleId']);
        $mapRole['id'] = $roleId;
        $categoryPermission = M('Role')->where($mapRole)->getField('category_permission');
        // if($categoryPermission != 'all'){
        //     if(strpos($categoryPermission,',') == false){ //只有一个分类
        //         if ($categoryId != $categoryPermission){
        //             parent::_message('error', '当前角色组无权限添加该分类下的文章，请联系管理员授权',0,20);
        //         }
        //     }else{
        //         $categoryPermissionArr = explode(',',$categoryPermission);
        //         if (!in_array($categoryId,$categoryPermissionArr)){
        //             parent::_message('error', '当前角色组无权限添加该分类下的文章，请联系管理员授权',0,20);
        //         }
        //     }
        // }
        if ($categoryPermission != 'all'){
            foreach ($categoryId as $key => $val) 
            {
                if(strpos($categoryPermission,',') == false)
                { //只有一个分类（一个权限）
                    if ($val != $categoryPermission){
                        parent::_message('error', '当前角色组无权限添加该分类下的文章，请联系管理员授权',0,20);
                    }
                }
                else
                {
                    $categoryPermissionArr = explode(',',$categoryPermission);
                    if (!in_array($val,$categoryPermissionArr)){
                        parent::_message('error', '当前角色组无权限添加该分类下的文章，请联系管理员授权',0,20);
                    }
                }
            }
        }
        $categorys = [];
        foreach ($categoryId as $key => $val) {
            if(!in_array($val,$categorys)){
                $categorys[] = $val;
            }
        }
        $data['category_id'] = implode(',',$categorys);
        //查询到文件名和文件路径
        $fileNames = $this->dao->where("id =".$item)->Field('attach,attach_file')->find();
        if($daoCreate = $this->dao->create()){
            $this->dao->category_id = $data['category_id'];
            $uploadFile = upload($this->getActionName());
            if ($uploadFile)
            {
                //dump($uploadFile);die;
                /**循环，将上传的所有文件名赋值给attach_file */
                //dump($uploadFile);die;
                foreach($uploadFile as $v)
                {
                    $attach_files['attach_files'][] = formatAttachPath($v['savepath'],'../Uploads/') . $v['savename'];
                    $attach_files['attach'][] = $v['name'];
                }

                //dump($attach_files);die;
                if(!empty($fileNames['attach_file']) && !empty($fileNames['attach']))
                {
                    $this->dao->attach_file = $fileNames['attach_file'].','.implode(',',$attach_files['attach_files']);
                    $this->dao->attach = $fileNames['attach'].','.implode(',',$attach_files['attach']);
                }else{
                    $this->dao->attach_file = implode(',',$attach_files['attach_files']);
                    $this->dao->attach = implode(',',$attach_files['attach']);
                }
                if($_POST['deleteFile'] == 1){
                    @unlink('././Uploads/'.$_POST['old_file']);
                }
            }
            if($_POST['deleteFile'] == 1 && !$uploadFile){
                @unlink('././Uploads/'.$_POST['old_file']);
                $this->dao->attach_file='';
                $this->dao->attach='';
            }
            if ($_POST['flash'] && $_POST['open']){
                $this->dao->publish = 3;
            }elseif($_POST['flash']){
                $this->dao->publish = 1;
            }elseif($_POST['open']){
                $this->dao->publish = 2;
            }else{
                $this->dao->publish = 0;
            }
            //如果页面的更新日期和当前日期不同，则存页面的更新日期
            if($_POST['update_time'] == date("Y-m-d",time()))
            {
                $uptime = time();
            }else{
                $uptime = strtotime($_POST['update_time']);
            }
            $this->dao->update_time = $uptime;
            $daoSave = $this->dao->save();
            
            if(false !== $daoSave){
                parent::_tags('modify', $_POST['tags'], $item);
                parent::_sysLog('modify', "编辑:$item");
                parent::_message('success', '更新完成');
            }else{
                parent::_message('error', '更新失败');
            }
        }else{
            parent::_message('error', $this->dao->getError());
        }

    }
    //删除单个附件
    public function doDeleteOneFile()
    {
        // 
        // echo json_encode($data);die;
        
        parent::_checkPermission('News_delete');
        parent::_setMethod('post');
        $item = intval($_POST['id']);
        $delFile = $_POST['fileName'];
        empty($item) && parent::_message('error', '记录不存在');
        $condition = ['id' => $item];
        $contentInfo = $this->dao->where($condition)->find();
        $attach = explode(',',$contentInfo['attach']);
        $attach_files = explode(',',$contentInfo['attach_file']); 
        foreach($attach_files as $k=>$v)
        {
            if($v == $delFile)
            {
                unset($attach_files[$k]);
                unset($attach[$k]);
            }
        }
        $attach = implode(',',$attach);
        $attach_files = implode(',',$attach_files); 
        $msg = 'fail';
        if($this->dao->create())
        {
            $this->dao->attach = $attach;
            $this->dao->attach_file = $attach_files;
            @unlink('../Uploads/'.$delFile);
            $daoSave = $this->dao->save();
            if($daoSave !== false)
            {
                $msg = 'success';
            }
        }
        //$item =
        $data = [
            'msg'=>$msg,
            'id'=>$_POST['id']
        ];
        echo json_encode($data);
        //dump($item);
    }
    public function doDelete()
    {

        parent::_checkPermission('News_delete');
        parent::_setMethod('post');
        $item = intval($_POST['id']);
        empty($item) && parent::_message('error', '记录不存在');
        parent::_delete('content', $_POST, array('attach_image', 'attach_thumb'));
        //  $daoResult=$dao->where($condition)->delete();
    }

    /**
     * 批量操作
     *
     */
    /**
     * 批量操作
     *
     */
    public function doCommand()
    {
        parent::_checkPermission('News_command');
        if(getMethod() == 'get'){
            $operate = trim($_GET['operate']);
        }elseif(getMethod() == 'post'){
            $operate = trim($_POST['operate']);
        }else{
            parent::_message('error', '只支持POST,GET数据');
        }
        $newCategory = intval($_POST['newCategory']);
        switch ($operate){
            case 'delete':
                parent::_tagsDelete('content');
                parent::_delete('content', 0, array('attach_image', 'attach_thumb'),$_POST);
                break;
            case 'recommend': parent::_recommend('set','content');break;
            case 'unRecommend': parent::_recommend('unset','content');break;
            case 'setTop': parent::_setTop('set','content');break;
            case 'unSetTop': parent::_setTop('unset','content');break;
            case 'setStatus': parent::_setStatus('set','content');break;
            case 'unSetStatus': parent::_setStatus('unset','content');break;
            case 'update': parent::_batchModify('content', $_POST, array('title','display_order'), __URL__,'Content', 'display_order DESC,id DESC');break;
            case 'move': parent::_move($newCategory,'content');break;
            default: parent::_message('error', '操作类型错误') ;
        }
    }
}
