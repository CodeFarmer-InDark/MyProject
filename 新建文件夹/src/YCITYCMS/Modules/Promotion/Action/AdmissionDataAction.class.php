<?php
/**
 *
 * 首页
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
if(!defined("YCITYCMS")) exit("Access Denied");
class AdmissionDataAction extends GlobalAction
{
    function _initialize()
    {
        parent::_initialize();
        $this->dao = D('Plan');
        $this->dao1 = D('Apply');
        if(!$this->_userid || !$this->_usercollege){
            cookie(null,C('COOKIE_PREFIX'));
            parent::_message('errorUri','尚未登录',U('Login/index'),3);
        }

        $this->assign('actionName',CONTROLLER_NAME);
        $this->assign('moduleTitle', '历史报名');
        $this->assign('year',date('Y'));

        for ($i=0;$i<3;$i++){
            $yearList[$i] = date('Y') - $i;
        }
        $this->assign('yearList',$yearList);
    }

    /**
     * 报名历史列表
     */
    public function index(){
        $dao = M('Zxdm');
        /*$condition['id'] = array('eq',$this->_usercollege);
        $allowProvince = M('College')->where($condition)->getField('province');*/
        $mapApply = [];
        $mapApply['a.teacherid'] = array('eq',$this->_userid);
        $mapApply['a.status'] = array('eq',2);
        $allowProvince = D('Apply')->Table(C('DB_PREFIX').'apply a')->join(C('DB_PREFIX').'plan b on a.planid = b.id')->where($mapApply)->field('b.province')->select();
        $allowProvince = array_column($allowProvince,'province');
        $allowProvince = implode(',',$allowProvince);
        if ($allowProvince) {
            $yearArr[0] = date('Y');
            $yearArr[1] = date('Y') - 1;
            $yearArr[2] = date('Y') - 2;
            $this->assign('yearArr',$yearArr);

            /*$result = parent::_curlPost($allowProvince);
            if ($result['msg'] == 1){*/
            $map['provinceid'] = array('in', explode(',',$allowProvince));
            $count = $dao->where($map)->count();
            $listRows = 15;
            $p = new \Think\Page1($count, $listRows);
            $result = $dao->where($map)->Limit($p->firstRow.','.$p->listRows)->select();
            $page = $p->show();
            if (false != $result){
                $provinceList = M('Province')->field('id,name')->select();
                $provinceArr = [];
                foreach ($provinceList as $k=>$v){
                    $provinceArr[$v['id']] = $v['name'];
                }
                foreach ($result as $k=>$v){
                    $result[$k]['pname'] = $provinceArr[$v['provinceid']];
                }

                //最近三年中学录取人数
                for ($i=0;$i<3;$i++){
                    $fileName = 'T_tdd_final'.(date('Y')-$i);
                    $db_name = C('DB_PREFIX').strtolower($fileName);
                    $Model = new \Think\Model();
                    $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
                    if($m){
                        $daoTdd = D($fileName);
                        $tddList = $daoTdd->field('zxdm')->where("zxdm != ''")->select();
                        $tdd = [];
                        foreach ($tddList as $k=>$v){
                            $tdd[$v['zxdm']]++;
                        }
                        foreach ($result as $k=>$v){
                            $result[$k]['num'.$i] = $tdd[$v['zxdm']]?$tdd[$v['zxdm']]:0;
                        }
                    }else{
                        foreach ($result as $k=>$v){
                            $result[$k]['num'.$i] = 0;
                        }
                    }
                }

                $p = intval(I('get.p'));
                if ($p == 0){$p = 1;}
                $this->assign('p',$p);
                $this->assign('data',$result);// 赋值数据集
                $this->assign('page',$page);// 赋值分页输出
                $this->assign('count',$count);
            }
            $this->display();
        }else{
            parent::_message('errorUri','暂无可查询省份，操作失败。',U('Index/index'),3);
        }
    }

    /*
     * 历史报名详情
     */
    public function detail(){
        $mapApply = [];
        $mapApply['a.teacherid'] = array('eq',$this->_userid);
        $mapApply['a.status'] = array('eq',2);
        $allowProvince = D('Apply')->Table(C('DB_PREFIX').'apply a')->join(C('DB_PREFIX').'plan b on a.planid = b.id')->where($mapApply)->field('b.province')->select();
        $allowProvince = array_column($allowProvince,'province');
        $allowProvince = implode(',',$allowProvince);
        if ($allowProvince){
            $zxdm = dHtml(htmlCv(I('get.zxdm')));
            $year = intval(I('get.year'));
            $province = intval(I('get.province'));
            $p = intval(I('get.p'));
            if (empty($zxdm) || !$year || $year == 0 || $province == 0 || !$province){
                parent::_message('error', '参数错误');
            }else{
                /*$result = parent::_curlPostDetail($year,$zxdm,$province);
                if ($result['msg'] == 1){
                    $list = array_values($result['info']);
                    $this->assign('thisInfo',$list[0]['zy']);
                    $this->assign('data',$list);// 赋值数据集
                    if ($p == 0){$p = 1;}
                    $this->assign('p',$p);*/
                $fileName = 'T_tdd_final'.$year;
                $db_name = C('DB_PREFIX').strtolower($fileName);
                $Model = new \Think\Model();
                $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
                if($m){
                    $dao = D($fileName);
                    $condition['zxdm'] = array('eq',$zxdm);
                    $condition['provinceid'] = array('eq',$province);
                    $dataList = $dao->where($condition)->field('zxdm,zxmc,lqzy,year,provinceid')->select();
                    if (false != $dataList){
                        $final = [];
                        foreach ($dataList as $k=>$v){
                            $final[$v['lqzy']]['zy'] = $v;
                            $final[$v['lqzy']]['num']++;
                        }

                        $mapJhk['year'] = $year;
                        $mapJhk['provinceid'] = $province;
                        $zyArr = M('tJhk')->where($mapJhk)->field('year,provinceid,zydm,zymc,jhxz,zydh')->select();
                        $jhkArr = [];
                        foreach ($zyArr as $k=>$v){
                            $jhkArr[$year.'-'.$v['provinceid'].'-'.$v['zydh']]['zydm'] = $v['zydm'];
                            $jhkArr[$year.'-'.$v['provinceid'].'-'.$v['zydh']]['zymc'] = $v['zymc'];
                            $jhkArr[$year.'-'.$v['provinceid'].'-'.$v['zydh']]['jhxz'] = $v['jhxz'];
                            $jhkArr[$year.'-'.$v['provinceid'].'-'.$v['zydh']]['provinceid'] = $v['provinceid'];
                        }
                        foreach ($final as $k=>$v){
                            $zy = $jhkArr[$v['zy']['year'].'-'.$v['zy']['provinceid'].'-'.$v['zy']['lqzy']];
                            $zy['year'] = $year;
                            $final[$k]['zyname'] = correctZyname($zy);
                        }
                        if (false != $final){
                            $list = array_values($final);
                            $this->assign('thisInfo',$list[0]['zy']);
                            $this->assign('data',$list);// 赋值数据集
                            if ($p == 0){$p = 1;}
                            $this->assign('p',$p);
                        }
                    }
                }
            }
            $this->display();
        }else{
            parent::_message('errorUri','暂无可查询省份，操作失败。',U('Index/index'),3);
        }
    }

    /**
     * 导出excel
     */
    public function doExport()
    {
        /*$condition['id'] = array('eq',$this->_usercollege);
        $allowProvince = M('College')->where($condition)->getField('province');*/
        $mapApply = [];
        $mapApply['a.teacherid'] = array('eq',$this->_userid);
        $mapApply['a.status'] = array('eq',2);
        $allowProvince = D('Apply')->Table(C('DB_PREFIX').'apply a')->join(C('DB_PREFIX').'plan b on a.planid = b.id')->where($mapApply)->field('b.province')->select();
        $allowProvince = array_column($allowProvince,'province');
        $allowProvince = implode(',',$allowProvince);
        if ($allowProvince) {
            $yearArr[0] = date('Y');
            $yearArr[1] = date('Y') - 1;
            $yearArr[2] = date('Y') - 2;

            $title = '各中学录取人数表';
            $cellName = array('中学名称','省份',$yearArr[0].'年录取人数',$yearArr[1].'年录取人数',$yearArr[2].'年录取人数');

            /*$result = parent::_curlPost($allowProvince);
            if ($result['msg'] == 1){*/
            $dao = M('Zxdm');
            $map['provinceid'] = array('in', explode(',',$allowProvince));
            $result = $dao->where($map)->select();
            if (false != $result){
                $provinceList = M('Province')->field('id,name')->select();
                $provinceArr = [];
                foreach ($provinceList as $k=>$v){
                    $provinceArr[$v['id']] = $v['name'];
                }
                foreach ($result as $k=>$v){
                    $result[$k]['pname'] = $provinceArr[$v['provinceid']];
                }

                //最近三年中学录取人数
                for ($i=0;$i<3;$i++){
                    $fileName = 'T_tdd_final'.(date('Y')-$i);
                    $db_name = C('DB_PREFIX').strtolower($fileName);
                    $Model = new \Think\Model();
                    $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
                    if($m){
                        $daoTdd = D($fileName);
                        $tddList = $daoTdd->field('zxdm')->where("zxdm != ''")->select();
                        $tdd = [];
                        foreach ($tddList as $k=>$v){
                            $tdd[$v['zxdm']]++;
                        }
                        foreach ($result as $k=>$v){
                            $result[$k]['num'.$i] = $tdd[$v['zxdm']]?$tdd[$v['zxdm']]:0;
                        }
                    }else{
                        foreach ($result as $k=>$v){
                            $result[$k]['num'.$i] = 0;
                        }
                    }
                }
            }

            Vendor('PHPExcel.PHPExcel');
            $objPHPExcel = new \PHPExcel();
            //定义配置
            $topNumber = 1;//表头有几行占用
            $xlsTitle = iconv('utf-8', 'gb2312', $title);//文件名称
            $fileName = $title.date('_YmdHis');//文件名称
            $cellKey = array(
                'A','B','C','D','E'
            );
            //处理表头
            foreach ($cellName as $k=>$v)
            {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellKey[$k].$topNumber, $v);//设置表头数据
                $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].$topNumber)->getFont()->setBold(true);//设置是否加粗
                $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].$topNumber)->getAlignment()->setVertical('center');//垂直居中
                $objPHPExcel->getActiveSheet()->getColumnDimension($cellKey[$k])->setWidth('25');//设置列宽度
            }
            //处理数据
            foreach ($result as $k=>$v)
            {
                $objPHPExcel->getActiveSheet()->setCellValue("A".($k+1+$topNumber), $v['zxmc']);
                $objPHPExcel->getActiveSheet()->setCellValue("B".($k+1+$topNumber), $v['pname']);
                $objPHPExcel->getActiveSheet()->setCellValue("C".($k+1+$topNumber), $v['num0']);
                $objPHPExcel->getActiveSheet()->setCellValue("D".($k+1+$topNumber), $v['num1']);
                $objPHPExcel->getActiveSheet()->setCellValue("E".($k+1+$topNumber), $v['num2']);
            }

            //导出execl
            header('pragma:public');
            header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
            header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            print_r($objWriter);
            exit;
        }else{
            parent::_message('errorUri','暂无可查询省份，操作失败。',U('Index/index'),3);
        }
    }
}