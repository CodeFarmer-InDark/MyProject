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
if(defined('APP_PATH')!='./YcityCms' && !defined("YCITYCMS"))  exit("Access Denied");
class HomeAction extends Action
{
    public $globalCategory, $globalMenu, $sysConfig;
    /**
     * 初始化
     *
     */
    function _initialize()
    {
        //取配置
        if(fileExit('./cms.config.php')){
            $this->sysConfig = @require_once('./cms.config.php');
        }else{
            $this->sysConfig = M('Config')->where('id=1')->find();
        }

        //检测是否停止
        $this->assign('sysConfig', $this->sysConfig);
        if($this->sysConfig['web_status'] == 1){
            $this->display('Home:Public:stop');
            exit();
        }
        //QQ客服
        $qq = array(
            1 => array(
                'qq' => $this->sysConfig['qq'],
                'name' => $this->sysConfig['qqName'],
            ),
            2 => array(
                'qq' => $this->sysConfig['qq2'],
                'name' => $this->sysConfig['qq2Name'],
            ),
            3 => array(
                'qq' => $this->sysConfig['qq3'],
                'name' => $this->sysConfig['qq3Name'],
            ),
            4 => array(
                'qq' => $this->sysConfig['qq4'],
                'name' => $this->sysConfig['qq4Name'],
            )
        );
        $this->assign('qq_status', $this->sysConfig['qq_status']);
        $this->assign('qq', $qq);

        //取分类
        $this->globalCategory = getCache('Category');

        //取导航
        $this->globalMenu = getCache('Menu');
        $this->assign('globalMenu', $this->globalMenu);

        //导入函数
        Load('extend');
        //导入分页类
        import("@.ORG.Util.Page");
        $this->assign('moduleName', MODULE_NAME);
		
        //取热搜关键字
        $hotSearch = M('Tags')->field('tag_name')->limit(6)->order('total_count DESC')->select();
        $this->assign('hotSearch',$hotSearch);
        
//		//获取cookies信息
//        if($_COOKIE[C('COOKIE_PREFIX').'auth']){
//            $yc_auth_key = sysmd5(C('ADMIN_ACCESS').$_SERVER['HTTP_USER_AGENT']);
//            list($user['id'],$user['mobile'],$user['name']) = explode("-", authcode($_COOKIE[C('COOKIE_PREFIX').'auth'], 'DECODE', $yc_auth_key));
//            $member['uid'] = $this->_uid = intval($user['id']);
//            if(is_numeric($user['mobile'])){
//                $member['mobile'] = $this->_mobile = $user['mobile'];
//            }else{
//                $member['mobile'] = $this->_mobile = 0;
//            }
//            $member['name'] = $this->_name = htmlCv($user['name']);
//            $condition['id'] = $this->_uid;
//            $user = M('Member')->where($condition)->Field('status,SSID')->find();
//            if($user['SSID'] !== session_id()){
//                cookie(null,C('COOKIE_PREFIX'));
//                $this->_message('errorUri','登录超时，请重新登录',U('Member/Login/index'));                
//            }
//            $member['status'] = $this->_status = intval($user['status']);
//            $condition['id'] = $member['uid'];
//            $data['lastAccessTime'] = time();
//            $daoSave = M('Member')->where($condition)->save($data);
//            //$this->_email = $_COOKIE['YC_email'];
//        }else{
//            $member['uid'] = $this->_uid = 0;
//        }
//        $this->assign('member',$member);
    }

    /**
     * 数据列表
     *
     * @param $conditions 条件
     * @param $orders 排序
     * @param $listRows 每页显示数量
     * @param $joind 是否表关联
     * @param $table 关联表
     * @param $join 
     * @param $fields 取字段
     */
    public function getList($conditions = '', $orders = '' , $listRows = '')
    {   
        $condition = !empty($conditions) ? $conditions : '' ;
        $pageCount = $this->dao->where($condition)->count();
        $listRows = empty($listRows) ? 15 : $listRows;
        $orderd = empty($orders) ? 'id DESC' : $orders;
        $paged = new page($pageCount, $listRows);
        $dataContentList = $this->dao->Where($condition)->Order($orderd)->Limit($paged->firstRow.','.$paged->listRows)->select();
        $pageContentBar = $paged->show();
        $this->assign('dataContentList', $dataContentList);
        $this->assign('pageContentBar', $pageContentBar);
        $this->display();
    }

    /**
     * 数据列表,表关联
     *
     * @param $conditions 条件
     * @param $orders 排序
     * @param $listRows 每页显示数量
     * @param $joind 是否表关联
     * @param $table 关联表
     * @param $join 
     * @param $fields 取字段
     */
    public function getJoinList($conditions = '', $orders = '' , $listRows = '', $table = '', $join = '', $fields = '')
    {
        $condition = !empty($conditions) ? $conditions : '' ;
        $pageCount = $this->dao->Where($condition)->Table($table)->Join($join)->Field($fields)->count();
        $listRows = empty($listRows) ? 15 : $listRows;
        $orderd = empty($orders) ? 'id DESC' : $orders;
        $paged = new page($pageCount, $listRows);
        $dataContentList = $this->dao->Table($table)->join($join)->field($fields)->Where($condition)->Order($orderd)->Limit($paged->firstRow.','.$paged->listRows)->select();
        $pageContentBar = $paged->show();
        $this->assign('dataContentList', $dataContentList);
        $this->assign('pageContentBar', $pageContentBar);
        $this->display();
    }

    /**
     * 数据集
     *
     * @param $conditions 条件
	 *
     */
    public function getDetail($conditions = '', $viewCount = false)
    {
        empty($conditions) && self::_message('errorUri', '查询条件丢失', U('Index/index'));
        $contentDetail = $this->dao->Where($conditions)->find();
        empty($contentDetail) && self::_message('errorUri', '记录不存在', U('Index/index'));
		//更新查看次数
		$viewCount && $this->dao->Where($conditions)->setInc($viewCount);
        $this->assign('contentDetail', $contentDetail);
        $this->display($contentDetail['template']);
    }

    /**
     * 数据集,表关联
     * 此处查询条件可能为数组
     * @param $conditions 条件
     * @param $joind 是否表关联
     * @param $table 关联表
     * @param $join 
     * @param $fields 取字段
     */
    public function getJoinDetail($conditions = '', $viewCount = false, $table = '', $join = '', $fields = '')
    {
        empty($conditions) && self::_message('errorUri', '查询条件丢失', U('Index/index'));
		
		$condition1 = is_array($conditions) ? $conditions[0] : $conditions;
		$condition2 = is_array($conditions) ? $conditions[1] : $conditions;

        $contentDetail = $this->dao->Table($table)->Join($join)->Field($fields)->Where($condition1)->find();
        empty($contentDetail) && self::_message('errorUri', '记录不存在', U('Index/index'));
		//更新查看次数
		$viewCount && $this->dao->Where($condition2)->setInc($viewCount);
        $this->assign('contentDetail', $contentDetail);
        $this->display($contentDetail['template']);
    }
    /**
     * 数据集,表关联
     * 此处查询条件可能为数组
     * @param $conditions 条件
     * @param $joind 是否表关联
     * @param $table 关联表
     * @param $join
     * @param $fields 取字段
     */
    public function getJustDetail($conditions = '', $viewCount = false, $table = '', $join = '', $fields = '')
    {
        empty($conditions) && self::_message('errorUri', '查询条件丢失', U('Index/index'));

        $condition1 = is_array($conditions) ? $conditions[0] : $conditions;
        $condition2 = is_array($conditions) ? $conditions[1] : $conditions;

        $contentDetail = $this->dao->Table($table)->Join($join)->Field($fields)->Where($condition1)->find();
        empty($contentDetail) && self::_message('errorUri', '记录不存在', U('Index/index'));
        //更新查看次数
        $viewCount && $this->dao->setInc($viewCount, $condition2);
        // $this->assign('contentDetail', $contentDetail);
        return $contentDetail;
    }
    /**
     * 输出信息
     *
     * @param $type
     * @param $content
     * @param $jumpUrl
     * @param $time
     * @param $ajax
     */
    protected function _message($type = 'success', $content = '更新成功', $jumpUrl = __URL__, $time = 3, $ajax = false)
    {
        $jumpUrl = empty($jumpUrl) ? __URL__ : $jumpUrl ;
        switch ($type){
            case 'success':
                $this->assign('jumpUrl', $jumpUrl);
                $this->assign('waitSecond', $time);
                $this->success($content, $ajax);
                break;
            case 'error':
                header('HTTP/1.1 404 Not Found');
                header("status: 404 Not Found");
                $this->assign('jumpUrl', 'javascript:history.back(-1);');
                $this->assign('waitSecond', $time);
                $this->assign('error', $content);
                $this->error($content, $ajax);
                break;
            case 'errorUri':
                header('HTTP/1.1 404 Not Found');
                header("status: 404 Not Found");
                $this->assign('jumpUrl', $jumpUrl);
                $this->assign('waitSecond', $time);
                $this->assign('error', $content);
                $this->error($content, $ajax);
                break;
            default:
                die('error type');
                break;
        }
    }

//    /**
//    * 首页部分类别数据检索
//    */
//    protected function getMultiNews($parent_id='',$limit=''){
//        $categoryArray['id'] = M('Category')->where('`parent_id`='.$parent_id)->field('id')->select();
//        if($categoryArray['id'] != false){
//            for($i=0;$i<count($categoryArray['id']);$i++){
//                $ca[$i] = $categoryArray['id'][$i]['id'];
//            }
//            $condition['category_id'] = array('IN',implode(',', $ca)); 
//        }else{
//            $condition['category_id'] = array('eq',$parent_id);
//        }
//        $order = 'istop DESC,display_order DESC,startTime DESC,id DESC';
//        $dataContentList = M('News')->Where($condition)->Order($order)->Limit($limit)->select();
//        return $dataContentList;
//    }
}

