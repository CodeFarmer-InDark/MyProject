<?php
//namespace Promotion\Controller;
//use Think\Controller;

class IndexAction extends GlobalAction {

    function _initialize()
    {
        parent::_initialize();
        if(!$this->_userid || !$this->_username){
            cookie(null,C('COOKIE_PREFIX'));
            parent::_message('errorUri','尚未登录',U('Login/index'),5);
        }
        $this->assign('userid',$this->_userid);
        $this->assign('UPLOADS','Public/Uploads');
        $this->assign('moduleTitle', '教师中心');
    }
    
    /*
     * 选择操作
     */
    public function index()
    {
        $collegeList = M('College')->field('cid,name')->order('type asc,id asc')->select();
        $this->assign('collegeList',$collegeList);

        $condition = [];
        $condition['id'] = $this->_userid;
        $contentDetail = D('Teacher')->where($condition)->find();
        if (false != $contentDetail){
            $contentDetail['collegeName'] = M('College')->where('cid = '.$contentDetail['college'])->getField('name');

            /*$map['b.start'] = array('glt',time()); //开始时间大于现在

            $map['b.end'] = array('gt',time()); //结束时间大于现在
            $map['b.start'] = array('elt',time()); //开始时间小于等于现在*/

            $map['_string'] = "b.start >= ".time()." OR b.end > ".time()." AND b.start <= ".time();
            $map['a.teacherid'] = $this->_userid;
            $map['a.status'] = array('eq',2); //已审批
            $xcList = D('Apply')->Table(C('DB_PREFIX').'apply a')->join(C('DB_PREFIX').'plan b on a.planid = b.id')->join(C('DB_PREFIX').'province c on b.province = c.id')->where($map)->field('a.id as aid,a.status as astatus,a.back_status,b.*,c.name as pname')->order('b.start asc')->find(); //开始日期排序
            if (false != $xcList){
                $xcList['zxlb'] = str_replace(';',' | ',$xcList['zxlb']);

                $start_time = date("H",$xcList['start']);
                if ($start_time > 0 && $start_time < 12){
                    $xc = date('Y年m月d日',$xcList['start']).'上午';
                }
                if ($start_time >= 12 && $start_time <= 24){
                    $xc = date('Y年m月d日',$xcList['start']).'下午';
                }
                $end_time = date("H",$xcList['end']);
                if ($end_time > 0 && $end_time < 12){
                    $xc1 = date('Y年m月d日',$xcList['end']).'上午';
                }
                if ($end_time >= 12 && $end_time <= 24){
                    $xc1 = date('Y年m月d日',$xcList['end']).'下午';
                }
                $xcList['xc'] = $xc.' 至 '.$xc1;
                $this->assign('xcdetail',$xcList);
            }
            $collegeList = M('College')->field('cid,name')->order('type asc,id asc')->select();
            $this->assign('vo',$contentDetail);
            $this->assign('college',$contentDetail['college']);
            $this->assign('sfzh',$contentDetail['sfzh']);
            $this->assign('collegeList',$collegeList);
            $this->display();
        }else{
            cookie(null,C('COOKIE_PREFIX'));
            parent::_message('errorUri','系统错误，请重新登录',U('Login/index'),5);
        }
    }

    /*
     * 个人资料
     */
    public function info(){
        $this->assign('controllerName', 'IndexInfo');
        $this->assign('moduleTitle', '联系方式');

        $contentDetail = D('Page')->where('id = 1')->find();
        if (false == $contentDetail){parent::_message('error','记录不存在');}
        $this->assign('contentDetail',$contentDetail);
        $this->display();
    }

    /**
     * 提交编辑
     *
     */
    public function doModify()
    {
        $sfzh = I('post.sfzh');
        $college = intval(I('post.college'));
        if (!idcard_check($sfzh)){
            parent::_message('error','请输入有效身份证号');
        }
        $has = M('College')->where(['cid'=>$college])->field('id')->select();
        if (false == $has || $college == ''){
            parent::_message('error','部门提交失败，请重试');
        }

        $map['id'] = array('eq',$this->_userid);
        $data = [];
        $data['status'] = 1;
        $data['college'] = $college;
        $data['sfzh'] = $sfzh;
        $data['update_time'] = time();
        $daoSave = D('Teacher')->where($map)->save($data);
        if (false != $daoSave){
            cookie('usercollege', $college);
            parent::_message('success','核对成功',U('Index/index'));
        }else{
            parent::_message('error','操作失败，请重试');
        }
    }
}