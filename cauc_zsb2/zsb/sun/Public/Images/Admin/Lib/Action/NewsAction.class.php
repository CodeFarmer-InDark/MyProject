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
        $category = D('Category')->where('groupID=2 and parent_id!=0')->Order('display_order DESC,id desc')->select();

        foreach ($category as $k => $v) {
            if (  $v['module']!='Download') {
                $categoryList[] = $v;
            }
        }
        //取主ID下属分类
        $this->assign('category', $categoryList);

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
        $dataList = $this->dao->Table(C('DB_PREFIX').'content c')->Join(C('DB_PREFIX').'category s on s.id=c.category_id')->Field('s.title as gtitle,s.parent_id,c.*')->Order( 'c.id DESC')->Where($condition)->Limit($p->firstRow.','.$p->listRows)->select();

        $page = $p->show();
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
        if($daoCreate = $this->dao->create())
        {
            $style = createStyle($_POST);
            $this->dao->user_id = parent::_getAdminUid();
            $this->dao->username = parent::_getAdminName();
            $this->dao->title_style = $style['title_style'];
            $this->dao->title_style_serialize = $style['title_style_serialize'];
            $uploadFile = upload($this->getActionName());
            if ($uploadFile)
            {
                $this->dao->attach = 1;
                $this->dao->attach_file = formatAttachPath($uploadFile[0]['savepath']) . $uploadFile[0]['savename'];
            }
            $this->dao->startTime = strtotime($_POST['startTime']);
            $this->dao->endTime = strtotime($_POST['endTime']);
            $this->dao->create_time = strtotime($_POST['create_time']);
            $this->dao->update_time = time();
            $daoAdd = $this->dao->add();
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
        if (empty($item) || empty($record)) parent::_message('error', '记录不存在');
        if($record){
            //查分类
            $id=$record['category_id'];
            $type = D('Category')->Field('title,id')->Order('display_order DESC,id asc')->where("id=$id")->select();
            $this->assign('type',$type[0]);
            $this->assign('vo', $record);
        }
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
        if($daoCreate = $this->dao->create()){
            $style = createStyle($_POST);
            $this->dao->title_style = $style['title_style'];
            $this->dao->title_style_serialize = $style['title_style_serialize'];
            $uploadFile = upload($this->getActionName());
            if ($uploadFile)
            {
                $this->dao->attach_file = formatAttachPath($uploadFile[0]['savepath']) . $uploadFile[0]['savename'];
                if($_POST['deleteFile'] == 1){
                    @unlink('././Uploads/'.$_POST['old_file']);
                }
            }
            if($_POST['deleteFile'] == 1 && !$uploadFile){
                @unlink('././Uploads/'.$_POST['old_file']);
                $this->dao->attach_file='';
                $this->dao->attach='';
            }
            $this->dao->startTime = strtotime($_POST['startTime']);
            $this->dao->endTime = strtotime($_POST['endTime']);
            $this->dao->create_time = strtotime($_POST['create_time']);
            $this->dao->update_time = time();

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
            case 'update': parent::_batchModify('content', $_POST, array('title'));break;
            case 'move': parent::_move($newCategory,'content');break;
            default: parent::_message('error', '操作类型错误') ;
        }
    }
}
