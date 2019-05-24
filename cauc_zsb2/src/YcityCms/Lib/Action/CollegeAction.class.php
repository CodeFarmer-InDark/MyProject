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
class CollegeAction extends HomeAction
{
    public $dao;
    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('college');
    }
    /**
     * 列表
     *
     */
    public function index()
    {
        $id=intval($_GET['id']);
        $condition['id']=array('eq',$id);
        empty($condition) && parent::_message('error', '参数丢失');
        $contentDetail = $this->dao->Where($condition)->find();
        empty($contentDetail) && parent::_message('error', '记录不存在');

        $categorylist=M('category')->where($condition)->field('title,parent_id,description')->find();

        $this->assign('contenttitle', $categorylist['title']);
        $this->assign('moduleTitle', $categorylist['description']);
        $this->assign('plist', $categorylist['description']);

        $this->assign('id',$id);

        $this-> newsCollege();
        $this->display();
    }

    public function detail()
    {
        $id=intval($_GET['id']);
        $this->assign('id',$id);
        $condition['id']=array('eq',$id);
        empty($condition) && parent::_message('error', '参数丢失');
        $contentDetail = $this->dao->Where($condition)->find();
        empty($contentDetail) && parent::_message('error', '记录不存在');

        $this->assign('plist','学院介绍');
        $this->assign('contenttitle', '院系设置');
        $this->assign('moduleTitle', '学院介绍');

        $contentDetail= $this->dao->where($condition)->find();
        $this->assign('contentDetail',$contentDetail);
        if ($contentDetail['parent_id']==0){
            $this->assign('detailtitle', '学院介绍');
        }else{
            $this->assign('detailtitle', '专业介绍');
        }
        $this->newsCollege();

        if ($contentDetail['parent_id'] == 0){
            $where['parent_id'] = array('eq',$id);
            $where['status'] = array('neq',1);
            $defaultMajor = $this->dao->order('display_order DESC,id ASC')->where($where)->select();
            $this->assign('defaultMajor',$defaultMajor);
            $this->assign('collegeName',$contentDetail['title']);
        }else{
            $pid=$contentDetail['parent_id'];
            $where['parent_id'] = array('eq',$pid);
            $where['status'] = array('neq',1);
            $defaultMajor = $this->dao->order('display_order DESC,id ASC')->where($where)->select();

            $cid = $defaultMajor[0]['parent_id'];
            $where1['id'] = $cid;
            $collegeName = $this->dao->where($where1)->find();

            $this->assign('defaultMajor',$defaultMajor);
            $this->assign('collegeName',$collegeName['title']);

        }
        $this->display();
    }

    public function major(){
        set_time_limit(0);
        $id = intval($_GET['id']);
        if ($id == 14){
            $id = 45;
        }else{
            $id=intval($_GET['id']);
        }
        $this->assign('id',$id);
        $condition['id']=array('eq',$id);
        empty($condition) && parent::_message('error', '参数丢失');

        $this->assign('contenttitle', '专业一览');
        $this->assign('moduleTitle', '学院介绍');
        $this->assign('plist', '学院介绍');

        $appArr = M('Config')->field('appid,appsecret')->find();
        $appid = $appArr['appid'];
        $appsecret = $appArr['appsecret'];
        $random = mt_rand(1,1000000);
        $timestamp = time();
        $sign = $random.$timestamp.$id.$appsecret;//签名

        $ch = curl_init();
        $url = C('S_ZS_DOMAIN')."Api/Inquire/getTarget?appid=".$appid."&random=".$random."&current=".$timestamp."&categoryId=".$id."&sign=".$sign;

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        $res = curl_exec($ch);
        curl_close($ch);

        
        $res_decode = json_decode($res,true);
       
        switch ($res_decode['msg']){
            case 0 : $error = '验证超时，请重新提交';break;
            case 2 : $error = '暂无数据';break;
            case 3 : $error = '验证失败，请重新提交';break;
        }
        $majorList = $res_decode['info'];
        $this->assign('error',$error);
        $this->assign('remark',$res_decode['remark']);
        $this->assign('dataList',$majorList);
        C('TOKEN_ON',false);
        

       $dataList = M('major')->order('id asc')->select();
       $remark = M('remark')->where('category_id=14')->order('id desc')->find();
       $this->assign('remark',$remark['content']);
       $this->assign('dataList',$dataList);

       //dump($dataList);
       $this->display();
    }

    /**
     * 学院模块列表
     * @param $more
     */
    public function newsCollege( )
    {
        $List=$this->dao->order('display_order DESC,id ASC')->where('status != 1')->select();
        foreach ( $List as $k => $v) {
            if ($v['parent_id'] == 0){
                $college[] = $v;
            }else{
                $major[]=$v;
            }
        }
        foreach ($college as $key=>$value){
            foreach ($major as $ke => $val){
               if ($val['parent_id'] == $value['id']){
                  $college[$key]['field'][]=$val;
               }
            }
        }
        $this->assign('collegeList',$college);
    }
}