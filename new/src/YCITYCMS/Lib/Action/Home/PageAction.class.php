<?php
/**
 * 
 * 单页
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
if(!defined("YCITYCMS")) exit("Access Denied"); 
class PageAction extends HomeAction
{
    public $dao,$link_label;

    function _initialize()
    {
        parent::_initialize();
        $this->dao = M('page');
        $this->link_label=htmlCv(dhtml($_GET['link_label']));
        
        $this->assign('link_label',$this->link_label);
        if (!isset($this->link_label)){parent::_message('error','参数错误');};
    }

    /**
     * 详细信息
     *
     */
    public function detail()
    {
        $conditions['link_label']=array('eq',$this->link_label);
        empty($conditions) && parent::_message('errorUri', '查询条件丢失', U('Index/index'));
        $contentDetail = $this->dao->Where($conditions)->find();
        empty($contentDetail) && parent::_message('errorUri', '记录不存在', U('Index/index'));
        $where['a.description']=array('eq',$contentDetail['description']);
        $muslist= M('category')->Table( C('DB_PREFIX').'category a')->Join(C('DB_PREFIX').'page b on a.title=b.title')->Field( 'a.id,a.module,a.title,a.description,b.link_label' )->order('a.id asc')->Where($where)->select();
        $this->assign('museList',$muslist);

        //更新查看次数
        $this->dao->Where($conditions)->setInc("view_count", 1);
        $this->assign('plist',$contentDetail['description']);
        $this->assign('contentDetail', $contentDetail);
        $this->assign('contenttitle',$contentDetail['title']);
        $this->assign('moduleTitle',$contentDetail['description']);
        $this->display();
    }
}