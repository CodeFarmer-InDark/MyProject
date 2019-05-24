<?php
/**
 * 
 * 通知公告
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
if(!defined("YCITYCMS")) exit("Access Denied"); 
class ListAction extends HomeAction
{
    public $dao;
    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('content');
    }
    /**
     * 列表
     */
    public function index()
    {
        //id不为数字的时候，禁止访问
        if (!is_numeric($_GET['id'])) {
            parent::_message('error','记录不存在');
        }
        $id=intval($_GET['id']);
        $id = dHtml(htmlCv($id));
        $this->assign('id',$id);
        $conn['id']=array('eq',$id);
        $lid = array(13,15,40,19,20,21,22,23,24,25,26);
        if (!in_array($id,$lid)){
            parent::_message('error', '记录不存在');
        }

        $condition1['id'] = array('eq',$id);
        $categorylist=M('category')->where($condition1)->field('title,parent_id')->find();
        $this->assign('typeName',$categorylist['title']);

        $pid=$categorylist['parent_id'];
        $condition2['id'] = array('eq',$pid);
        $plist=M('category')->where($condition2)->field('title')->find();

        $condition['parent_id']=array('eq',$categorylist['parent_id']);
        $tName = array(27,18);
        if (in_array($categorylist['parent_id'], $tName)){
            $where['parent_id']= array('eq',27);
            $typelist= M('category')->where($where)->field('parent_id,title,id,groupID,module,description')->order('id asc')->select();//获取菜单名称

            $muslist= M('category')->where($condition)->field('parent_id,title,id,groupID,module,description')->order('id asc')->select();//获取菜单名称
            $this->assign('museList',$muslist);

            $this->assign('plist',$plist['title']);
            $this->assign('contenttitle', $categorylist['title']);
            $this->assign('moduleTitle', $plist['title']);

            if ($categorylist['title']=='招生快讯'){
                $this->newopenList($id);
            }else{
                $this-> newsortList($id);
            }

            $con['status'] = array('neq',1);//隐藏
            if($categorylist['title'] = '招生类型'){
                for($i=19;$i<27;$i++){
                    $con['category_id'] = array('eq',$i);
                    $topNews[] = $this->dao->order('istop desc,create_time DESC,id desc')->where($con)->field('id,category_id,title')->find();
                }
                foreach ($typelist as $k=>$v){
                    foreach ($topNews as $key => $value){
                        if ($v['id'] == $value['category_id']){
                            $typelist[$k]['topNews']=$value['title'];
                            $typelist[$k]['topId']=$value['id'];
                        }
                    }
                }
            }
            $this->assign('typelist',$typelist);

        }elseif($categorylist['title']=='招生章程' || $categorylist['title']=='信息公开'){
            $where['parent_id']= array('eq',27);
            $typelist= M('category')->where($where)->field('parent_id,title,id,groupID,module')->order('id asc')->select();//获取菜单名称
            $this->assign('typelist',$typelist);
            $condition['parent_id']=array('eq',18);
            $muslist= M('category')->where($condition)->field('parent_id,title,id,groupID,module')->order('id asc')->select();//获取菜单名称
            $this->assign('museList',$muslist);

            $this->assign('plist',$categorylist['title']);
            $this->assign('moduleTitle', $categorylist['title']);

            if ($categorylist['title']=='信息公开'){
                $this->newopenList($id);
            }else{
                $this-> newsortList($id);
            }
        }
        $this->display();

    }

    /**
     * 信息公开
     */
    public function open(){
        $id=intval($_GET['id']);
        if (!isset($_GET['id']) || $id!=34){parent::_message('error','参数错误');};
        $this->assign('plist','信息公开');
        $this->assign('moduleTitle', '信息公开');
        $this->newopenList($id);
        $this->display();
    }

    public function detail(){
        $cid=intval($_GET['id']);
        $con['id']=array('eq',$cid);
        empty($con) && parent::_message('error', '参数丢失');
        $con && $contentDetail = $this->dao->Where($con)->find();
        empty($contentDetail) && parent::_message('error', '记录不存在');

        $condition['c.id']=array('eq',intval($_GET['id']));
        $data= $this->dao->Table( C('DB_PREFIX').'content c')->Join(C('DB_PREFIX').'category s on c.category_id=s.id')->Field( 's.title as gtitle,s.parent_id,c.*' )-> Where($condition)->find();
        //多附件分割
        $data['attach_file'] = explode(',', $data['attach_file']);

        $this->assign("data",$data);
        $this->assign('id',$data['category_id']);

        /* 招生咨询 */
        if ($data['parent_id'] == 33 ){
            $this->assign('plist','招生咨询');
            $this->assign('moduleTitle','招生咨询');
            $contenttitle = $data['gtitle'];
            $this->assign('contenttitle',$contenttitle);

            $where['a.parent_id']= array('eq',33);
            $muslist= M('category')->Table( C('DB_PREFIX').'category a')->Join(C('DB_PREFIX').'page b on a.title=b.title')->Field( 'a.id,a.module,a.parent_id,a.title,a.description,b.link_label' )->order('a.id asc')->Where($where)->select();
            $this->assign('museList',$muslist);

        }
        /* 招生章程 */
        if ($data['category_id']==40){
            $this->assign('moduleTitle','招生章程');
            $this->assign('plist','招生章程');
            
            $where['parent_id'] = array('eq',18);
            $muslist= M('category')->where($where)->field('parent_id,title,id,module')->order('id asc')->select();//获取菜单名称
            $this->assign('museList',$muslist);

        }
        /* 激励政策 */
        if ($data['category_id']==15){
            $this->assign('moduleTitle','报考指南');
            $this->assign('plist','报考指南');
            $this->assign('contenttitle','激励政策');
            $this->assign("id", 15);
            if ($data['publish'] == 3 || $data['publish'] == 1) {//同时发布或发布到招生快讯
                $this->assign("id", 15);
            }

            $where['parent_id'] = array('eq',18);
            $muslist= M('category')->where($where)->field('parent_id,title,id,module')->order('id asc')->select();//获取菜单名称
            $this->assign('museList',$muslist);
        }
        /* 招生类型 */
        if ($data['parent_id']==27){
            $this->assign('moduleTitle','招生类型');
            $this->assign('plist','招生类型');
            $this->assign('contenttitle',$data['gtitle']);
            $this->assign("id", $data['category_id']);

            $cond['id'] = array('eq',$data['category_id']);
            $categorylist1=M('category')->where($cond)->field('title,parent_id')->find();
            $this->assign('typeName',$categorylist1['title']);

            $where1['parent_id'] = array('eq',$data['parent_id']);
            $muslist= M('category')->where($where1)->field('parent_id,title,id,groupID,module,description')->order('id asc')->select();//获取菜单名称

            for($i=19;$i<27;$i++){
                $con1['category_id'] = array('eq',$i);
                $topNews[] = $this->dao->order('istop desc,create_time DESC,id desc')->where($con1)->field('id,category_id,title')->find();
            }
            foreach ($muslist as $k=>$v){
                foreach ($topNews as $key => $value){
                    if ($v['id'] == $value['category_id']){
                        $muslist[$k]['topNews']=$value['title'];
                        $muslist[$k]['topId']=$value['id'];
                    }
                }
            }
            $this->assign('typelist',$muslist);

            if ($data['publish'] == 3 || $data['publish'] == 1) {//同时发布或发布到招生快讯
                $this->assign("id", $data['category_id']);
            }
        }

        $where2['id'] = array('eq',intval($_GET['id']));
        $this->dao->Where($where2)->setInc('view_count',1);
        $this->display();
    }

    /* 咨询页 */
    public function consult()
    {
        $id=intval($_GET['id']);
        $this->assign('id',$id);
        if (!isset($_GET['id'])){parent::_message('error','参数错误');};

        $cid = array(31,32);
        if (!in_array($id,$cid)){
            parent::_message('error', '记录不存在');
        }

        $condition['id'] = array('eq',$id);
        $categorylist=M('category')->where($condition)->field('title,parent_id')->find();
        $this->assign('contenttitle',$categorylist['title']);
        $this->assign('plist','招生咨询');

        $where['a.parent_id']= array('eq',33);
        $muslist= M('category')->Table( C('DB_PREFIX').'category a')->Join(C('DB_PREFIX').'page b on a.title=b.title')->Field( 'a.id,a.module,a.parent_id,a.title,a.description,b.link_label' )->order('a.id asc')->Where($where)->select();
        $this->assign('museList',$muslist);
        
        $this->newsortList($id);
        $this->display();

    }

    /**
     * 独立发布文章模块列表
     * @param $more
     */
    public function newsortList( $id )
    {
        $condition['category_id'] = array('eq', $id);

        $count = $this->dao->where($condition)->count();
        $p = new page($count, 12,"&id=".$id);
        $page  = $p->show();

        $condition['status'] = array('neq',1);//隐藏
        $dataList1= $this->dao->where($condition)->order('istop desc,display_order desc,create_time DESC,id desc')->limit($p->firstRow,12)->select();
        $this->assign('dataContentList',$dataList1);

        if($dataList1 !== false)
        {
            $this->assign('pageBar', $page);
        }
        $this->assign('pageContentBar', $page);
    }

    /**
     * 信息公开、招生快讯模块列表
     * @param $id
     */
    public function newopenList($id)
    {
        $condition['publish'] = array('neq','0');
        $flash=array(1,3);
        $open=array(2,3);
        if ($id==13){
            $condition['publish']=array('in',$flash);
        }
        if ($id==34){
            $condition['publish']=array('in',$open);
        }

        $count = $this->dao->where($condition)->count();

        $p = new page($count, 12,"&id=".$id);

        $page  = $p->show();

        $condition['status'] = array('neq',1);//隐藏
        $dataList1= $this->dao->where($condition)->order('istop desc,display_order desc,create_time DESC,id desc')->limit($p->firstRow,12)->select();
        $this->assign('dataContentList',$dataList1);


        if($dataList1 !== false)
        {
            $this->assign('pageBar', $page);
        }
        $this->assign('pageContentBar', $page);
    }


}