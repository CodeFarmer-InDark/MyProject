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
class ScoreDataAction extends GlobalAction
{
    function _initialize()
    {
        parent::_initialize();
        $this->dao = D('Teacher');
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
        $mapApply = [];
        $mapApply['a.teacherid'] = array('eq',$this->_userid);
        $mapApply['a.status'] = array('eq',2);
        $allowProvince = D('Apply')->Table(C('DB_PREFIX').'apply a')->join(C('DB_PREFIX').'plan b on a.planid = b.id')->where($mapApply)->field('b.province')->select();
        $allowProvince = array_column($allowProvince,'province');
        $allowProvince = implode(',',$allowProvince);

        /*$condition['id'] = array('eq',$this->_usercollege);
        $allowProvince = M('College')->where($condition)->getField('province');*/
        if ($allowProvince){
            //判断当前年是否有分数数据
            $year = date('Y');
            $fileName1 = 'Score'.$year;
            $db_name1 = C('DB_PREFIX').strtolower($fileName1);
            $Model = new \Think\Model();
            $m1 = $Model->query("SHOW TABLES LIKE '%$db_name1%'");
            if($m1){
                $dao = D($fileName1);
                $dataList = $dao->field('id')->select();
                if (false != $dataList){
                    $currentYear = date("Y",time())+1;
                }else{
                    $currentYear = date("Y",time());
                }
            }else{
                $currentYear = date("Y",time());
            }
            //年份checkbox数据
            $yearArr[0] =$currentYear - 1;
            $yearArr[1] =$currentYear - 2;
            $yearArr[2] =$currentYear - 3;

            //可管理省份下拉列表
            $mapProvince['id'] = array('in',explode(',',$allowProvince));
            $provinceList = M('Province')->where($mapProvince)->field('id,name')->select();
            foreach ($provinceList as $k=>$v){
                $provinceArr[$v['id']] = $v['name'];
            }
            $this->assign('province',$provinceList);
            $this->assign('year',$yearArr);

            $pid= dHtml(htmlCv($_GET['province']));
            $zydm = dHtml(htmlCv($_GET['major']));
            $kldm = dHtml(htmlCv($_GET['kldm']));
            $year1 = intval($_GET['year1']);
            $year2 = intval($_GET['year2']);
            $year3 = intval($_GET['year3']);
            if($pid){
                if (!in_array($pid,explode(',',$allowProvince))){
                    parent::_message('errorUri','无权限，操作失败。',U('ScoreData/index'),3);
                }
                $this->assign('pid',$pid);
                $this->assign('zydm',$zydm);
                $this->assign('kldm',$kldm);
                if($year1 || $year2 || $year3){$year_s_arr = array($year1,$year2,$year3);}else{$year_s_arr = '';}
                if (is_array($year_s_arr)){
                    $this->assign('year_selected',$year_s_arr);
                    $this->assign('year_selected1',implode(',',$year_s_arr));
                }

                //省内批次、科类及专业省控线
                $pcdmList = M('tdPcdm')->field('year,provinceid,pcdm,pcmc')->select();
                $pcdmArr = [];
                foreach ($pcdmList as $k=>$v){
                    $pcdmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['pcdm']] = $v['pcmc'];
                }
                $kldmList = M('tdKldm')->field('year,provinceid,kldm,klmc')->select();
                $kldmArr = [];
                foreach ($kldmList as $k=>$v){
                    $kldmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['kldm']] = $v['klmc'];
                }
                $zyList = M('Zy')->field('year,zydm,zymc,zyfx,ccdm')->select();
                $zyArr = [];
                foreach ($zyList as $k=>$v){
                    $zyArr[$v['year'].'-'.$v['zydm']]['zymc'] = $v['zymc'];
                    if ($v['ccdm'] == 1){
                        $zyArr[$v['year'].'-'.$v['zydm']]['zyfx'] = $v['zyfx'];
                    }
                }
                $skxList = M('Skx')->select();
                $skxArr = [];
                foreach ($skxList as $k=>$v){
                    $skxArr[$v['year'].'-'.$v['province'].'-'.$v['kldm']] = $v['skx'];
                }
                $tddwList = M('CorrectTddw')->select();
                foreach ($tddwList as $k=>$v){
                    $tddwArr[$v['year'].'-'.$v['provinceid'].'-'.$v['tddw']] = $v['kldm'];
                }
                $ckldmList = M('CorrectKldm')->select();
                foreach ($ckldmList as $k=>$v){
                    $ckldmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['kldm_origin']] = $v['kldm'];
                }

                if (!$year_s_arr){
                    $conditionYear = $yearArr;
                }else{
                    $conditionYear = $year_s_arr;
                }
                for ($i=0;$i<count($conditionYear);$i++){
                    $fileName = 'Score'.$conditionYear[$i];
                    $db_name = C('DB_PREFIX').strtolower($fileName);
                    $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
                    if($m){
                        $dao = D($fileName);
                        $condition = array();
                        $pid && $condition['province'] = array('eq', $pid);
                        ($kldm!='') && $condition['kldm'] = array('eq',$kldm);
                        if (strlen($zydm) == 4){ //部分专业合并为大类，查询时均查出
                            $mapZy = array();
                            $mapZy['zydm'] = array('like',$zydm.'%');
                            $tempZydm = M('Zy')->where($mapZy)->field('zydm')->select();
                            $zydm && $condition['queryzydm'] = array('in', array_column($tempZydm,'zydm'));
                        }else{
                            if (strpos($zydm,'-') !== false){
                                $zydmArr = explode('-',$zydm);
                                switch($zydmArr[1]){
                                    case '机场指挥':$lqzy =  substr($conditionYear[$i],-2).$pid.'Z016';break;
                                    case '通航综合航务':$lqzy =  substr($conditionYear[$i],-2).$pid.'Z022';break;
                                    case '地面服务':$lqzy =  substr($conditionYear[$i],-2).$pid.'Z030';break;
                                }
                                $lqzy && $condition['lqzy'] = array('eq', $lqzy);
                            }else{
                                $zydm && $condition['queryzydm'] = array('eq', $zydm);
                            }
                        }
                        $scoreList[] = $dao->where($condition)->order('pc asc,id desc')->select();
                    }
                }
                //三维数组转二维数组
                foreach($scoreList as $value){
                    foreach($value as $v){
                        $lastList[]=$v;
                    }
                }
                //销毁$arr3
                unset($scoreList,$value,$v);
                if (false != $lastList) {
                    foreach ($lastList as $key => $val) {
                        $lastList[$key]['pcname'] = $pcdmArr[$val['year'].'-'.$val['province'].'-'.$val['pcdm']];
                        $lastList[$key]['tname'] = $kldmArr[$val['year'].'-'.$val['province'].'-'.$val['kldm']];
                        $lastList[$key]['zyname'] = $zyArr[$val['year'].'-'.$val['queryzydm']]['zymc'];
                        $lastList[$key]['zyfx'] = $zyArr[$val['year'].'-'.$val['queryzydm']]['zyfx'];
                        $lastList[$key]['pname'] = $provinceArr[$val['province']];

                        $tddwkldm = $tddwArr[$val['year'].'-'.$val['province'].'-'.$val['tddw']];
                        $lastList[$key]['kldm'] = $tddwkldm?$tddwkldm:$val['kldm'];//纠正个别省份科类文理综合分文理

                        $xnkldm = $ckldmArr[$val['year'].'-'.$val['province'].'-'.$lastList[$key]['kldm']];
                        $lastList[$key]['kldm'] = ($xnkldm!='')?$xnkldm: $lastList[$key]['kldm']; //纠正个别省份科类代码
                        $lastList[$key]['skx'] = $skxArr[$val['year'].'-'.$val['province'].'-'.$lastList[$key]['kldm']];
                        if ($lastList[$key]['skx'] && $lastList[$key]['skx'] != 0){
                            $lastList[$key]['diff'] = $lastList[$key]['lowscore'] - $lastList[$key]['skx'];
                        }
                    }
                    $mapRemark['category_id'] = 42;
                    $remark = M('Remark')->where($mapRemark)->getField('content');
                    $scoreList = $lastList;
                }else{
                    $error = '暂无数据';
                }
                $this->assign('msg',$error);

                /* 数组分页 */
                $count = count($scoreList);
                $Page = new \Think\Page1($count,15,'province='.$pid.'&kldm='.$kldm.'&major='.$zydm.'&year1='.$year1.'&year2='.$year2.'&year3='.$year3);
                $show  = $Page->show();
                $list = array_slice($scoreList,$Page->firstRow,$Page->listRows);
                $this->assign('data',$list);// 赋值数据集
                $this->assign('page',$show);// 赋值分页输出
                $this->assign('count',$count);
                $this->assign('remark',$remark);
            }else{
                $this->assign('msg','省份必选');
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
            //判断当前年是否有分数数据
            $year = date('Y');
            $fileName1 = 'Score'.$year;
            $db_name1 = C('DB_PREFIX').strtolower($fileName1);
            $Model = new \Think\Model();
            $m1 = $Model->query("SHOW TABLES LIKE '%$db_name1%'");
            if($m1){
                $dao = D($fileName1);
                $dataList = $dao->field('id')->select();
                if (false != $dataList){
                    $currentYear = date("Y",time())+1;
                }else{
                    $currentYear = date("Y",time());
                }
            }else{
                $currentYear = date("Y",time());
            }
            //年份checkbox数据
            $yearArr[0] =$currentYear - 1;
            $yearArr[1] =$currentYear - 2;
            $yearArr[2] =$currentYear - 3;

            $mapProvince['id'] = array('in',explode(',',$allowProvince));
            $provinceList = M('Province')->where($mapProvince)->field('id,name')->select();
            foreach ($provinceList as $k=>$v){
                $provinceArr[$v['id']] = $v['name'];
            }

            $pid= dHtml(htmlCv($_GET['province']));
            $zydm = dHtml(htmlCv($_GET['major']));
            $kldm = dHtml(htmlCv($_GET['kldm']));
            $year1 = intval($_GET['year1']);
            $year2 = intval($_GET['year2']);
            $year3 = intval($_GET['year3']);
            if($pid){
                if (!in_array($pid,explode(',',$allowProvince))){
                    parent::_message('errorUri','无权限，操作失败。',U('ScoreData/index'),3);
                }
                if($year1 || $year2 || $year3){$year_s_arr = array($year1,$year2,$year3);}else{$year_s_arr = '';}
                //省内批次、科类及专业省控线
                $pcdmList = M('tdPcdm')->field('year,provinceid,pcdm,pcmc')->select();
                $pcdmArr = [];
                foreach ($pcdmList as $k=>$v){
                    $pcdmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['pcdm']] = $v['pcmc'];
                }
                $kldmList = M('tdKldm')->field('year,provinceid,kldm,klmc')->select();
                $kldmArr = [];
                foreach ($kldmList as $k=>$v){
                    $kldmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['kldm']] = $v['klmc'];
                }
                $zyList = M('Zy')->field('year,zydm,zymc,zyfx,ccdm')->select();
                $zyArr = [];
                foreach ($zyList as $k=>$v){
                    $zyArr[$v['year'].'-'.$v['zydm']]['zymc'] = $v['zymc'];
                    if ($v['ccdm'] == 1){
                        $zyArr[$v['year'].'-'.$v['zydm']]['zyfx'] = $v['zyfx'];
                    }
                }
                $skxList = M('Skx')->select();
                $skxArr = [];
                foreach ($skxList as $k=>$v){
                    $skxArr[$v['year'].'-'.$v['province'].'-'.$v['kldm']] = $v['skx'];
                }
                $tddwList = M('CorrectTddw')->select();
                foreach ($tddwList as $k=>$v){
                    $tddwArr[$v['year'].'-'.$v['provinceid'].'-'.$v['tddw']] = $v['kldm'];
                }
                $ckldmList = M('CorrectKldm')->select();
                foreach ($ckldmList as $k=>$v){
                    $ckldmArr[$v['year'].'-'.$v['provinceid'].'-'.$v['kldm_origin']] = $v['kldm'];
                }

                if (!$year_s_arr){
                    $conditionYear = $yearArr;
                }else{
                    $conditionYear = $year_s_arr;
                }
                for ($i=0;$i<count($conditionYear);$i++){
                    $fileName = 'Score'.$conditionYear[$i];
                    $db_name = C('DB_PREFIX').strtolower($fileName);
                    $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
                    if($m){
                        $dao = D($fileName);
                        $condition = array();
                        $pid && $condition['province'] = array('eq', $pid);
                        ($kldm!='') && $condition['kldm'] = array('eq',$kldm);
                        if (strlen($zydm) == 4){ //部分专业合并为大类，查询时均查出
                            $mapZy = array();
                            $mapZy['zydm'] = array('like',$zydm.'%');
                            $tempZydm = M('Zy')->where($mapZy)->field('zydm')->select();
                            $zydm && $condition['queryzydm'] = array('in', array_column($tempZydm,'zydm'));
                        }else{
                            if (strpos($zydm,'-') !== false){
                                $zydmArr = explode('-',$zydm);
                                switch($zydmArr[1]){
                                    case '机场指挥':$lqzy =  substr($conditionYear[$i],-2).$pid.'Z016';break;
                                    case '通航综合航务':$lqzy =  substr($conditionYear[$i],-2).$pid.'Z022';break;
                                    case '地面服务':$lqzy =  substr($conditionYear[$i],-2).$pid.'Z030';break;
                                }
                                $lqzy && $condition['lqzy'] = array('eq', $lqzy);
                            }else{
                                $zydm && $condition['queryzydm'] = array('eq', $zydm);
                            }
                        }
                        $scoreList[] = $dao->where($condition)->order('pc asc,id desc')->select();
                    }
                }
                //三维数组转二维数组
                foreach($scoreList as $value){
                    foreach($value as $v){
                        $lastList[]=$v;
                    }
                }
                //销毁$arr3
                unset($scoreList,$value,$v);
                if (false != $lastList) {
                    foreach ($lastList as $key => $val) {
                        $lastList[$key]['pcname'] = $pcdmArr[$val['year'].'-'.$val['province'].'-'.$val['pcdm']];
                        $lastList[$key]['tname'] = $kldmArr[$val['year'].'-'.$val['province'].'-'.$val['kldm']];
                        $lastList[$key]['zyname'] = $zyArr[$val['year'].'-'.$val['queryzydm']]['zymc'];
                        $lastList[$key]['zyfx'] = $zyArr[$val['year'].'-'.$val['queryzydm']]['zyfx'];
                        $lastList[$key]['pname'] = $provinceArr[$val['province']];

                        $tddwkldm = $tddwArr[$val['year'].'-'.$val['province'].'-'.$val['tddw']];
                        $lastList[$key]['kldm'] = $tddwkldm?$tddwkldm:$val['kldm'];//纠正个别省份科类文理综合分文理

                        $xnkldm = $ckldmArr[$val['year'].'-'.$val['province'].'-'.$lastList[$key]['kldm']];
                        $lastList[$key]['kldm'] = ($xnkldm!='')?$xnkldm: $lastList[$key]['kldm']; //纠正个别省份科类代码
                        $lastList[$key]['skx'] = $skxArr[$val['year'].'-'.$val['province'].'-'.$lastList[$key]['kldm']];
                        if ($lastList[$key]['skx'] && $lastList[$key]['skx'] != 0){
                            $lastList[$key]['diff'] = $lastList[$key]['lowscore'] - $lastList[$key]['skx'];
                        }
                    }
                    $scoreList = $lastList;
                }
            }

            $title = '历年分数表';
            $cellName = array('年份','省份','批次名称','专业名称','专业方向','科类','最高分','最低分','平均分','省控线','最低分与省控线差值');

            Vendor('PHPExcel.PHPExcel');
            $objPHPExcel = new \PHPExcel();
            //定义配置
            $topNumber = 1;//表头有几行占用
            $xlsTitle = iconv('utf-8', 'gb2312', $title);//文件名称
            $fileName = $title.date('_YmdHis');//文件名称
            $cellKey = array(
                'A','B','C','D','E','F','G','H','I','J','K'
            );
            //处理表头
            foreach ($cellName as $k=>$v)
            {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellKey[$k].$topNumber, $v);//设置表头数据
                $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].$topNumber)->getFont()->setBold(true);//设置是否加粗
                $objPHPExcel->getActiveSheet()->getStyle($cellKey[$k].$topNumber)->getAlignment()->setVertical('center');//垂直居中
                $objPHPExcel->getActiveSheet()->getColumnDimension($cellKey[$k])->setWidth('20');//设置列宽度
            }
            //处理数据
            foreach ($scoreList as $k=>$v)
            {
                $objPHPExcel->getActiveSheet()->setCellValue("A".($k+1+$topNumber), $v['year']);
                $objPHPExcel->getActiveSheet()->setCellValue("B".($k+1+$topNumber), $v['pname']);
                $objPHPExcel->getActiveSheet()->setCellValue("C".($k+1+$topNumber), $v['pcname']);
                $objPHPExcel->getActiveSheet()->setCellValue("D".($k+1+$topNumber), $v['zyname']);
                $objPHPExcel->getActiveSheet()->setCellValue("E".($k+1+$topNumber), $v['zyfx']);
                $objPHPExcel->getActiveSheet()->setCellValue("F".($k+1+$topNumber), $v['tname']);
                $objPHPExcel->getActiveSheet()->setCellValue("G".($k+1+$topNumber), $v['topscore']);
                $objPHPExcel->getActiveSheet()->setCellValue("H".($k+1+$topNumber), $v['lowscore']);
                $objPHPExcel->getActiveSheet()->setCellValue("I".($k+1+$topNumber), $v['avescore']);
                $objPHPExcel->getActiveSheet()->setCellValue("J".($k+1+$topNumber), $v['skx']);
                $objPHPExcel->getActiveSheet()->setCellValue("K".($k+1+$topNumber), $v['diff']);
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

    /**
     * 根据年份获取专业及科类
     */
    public function getMajorByYear(){
        $year = dHtml(htmlCv($_GET['year']));
        $provinceid = intval($_GET['province']);
        if (!$year || $year == ''){
            //判断当前年是否有分数数据
            $year = date('Y');
            $fileName1 = 'Score'.$year;
            $db_name1 = C('DB_PREFIX').strtolower($fileName1);
            $Model = new \Think\Model();
            $m1 = $Model->query("SHOW TABLES LIKE '%$db_name1%'");
            if($m1){
                $dao = D($fileName1);
                $dataList = $dao->field('id')->select();
                if (false != $dataList){
                    $currentYear = date("Y",time())+1;
                }else{
                    $currentYear = date("Y",time());
                }
            }else{
                $currentYear = date("Y",time());
            }
            //年份checkbox数据
            $yearArr[0] =$currentYear - 1;
            $yearArr[1] =$currentYear - 2;
            $yearArr[2] =$currentYear - 3;
        }else{
            $yearArr = explode(',',$year);
            for ($i=0;$i<count($yearArr);$i++){
                if ($yearArr[$i] == 0){
                    unset($yearArr[$i]);
                }
            }
        }
        $condition['year'] = array('in',$yearArr);
        $zyList = M('Zy')->where($condition)->field('zydm,zymc')->order('ccdm asc,zydm asc')->select();
        $condition['provinceid'] = array('eq',$provinceid);
        $kldmList = M('tdKldm')->where($condition)->field('kldm,klmc')->select();
        if (false != $zyList && false != $kldmList){
            $dataList = [];
            foreach ($zyList as $k=>$v){
                $dataList[$v['zydm']]['zydm'] = $v['zydm'];
                $dataList[$v['zydm']]['zymc'] = $v['zymc'];
            }
            $dataList1 = [];
            foreach ($kldmList as $k=>$v){
                $dataList1[$v['kldm']]['kldm'] = $v['kldm'];
                $dataList1[$v['kldm']]['klmc'] = $v['klmc'];
            }
            $dataList = array_values($dataList);
            $data['msg'] = '1'; //成功
            $data['scoreList'] = $dataList;
            $data['kldmList'] = $dataList1;
            echo json_encode($data);
            exit;
        }elseif(false != $zyList && false == $kldmList){
            $dataList = [];
            foreach ($zyList as $k=>$v){
                $dataList[$v['zydm']]['zydm'] = $v['zydm'];
                $dataList[$v['zydm']]['zymc'] = $v['zymc'];
            }
            $dataList = array_values($dataList);
            $data['msg'] = '1'; //成功
            $data['scoreList'] = $dataList;
            $data['kldmList'] = '';
            echo json_encode($data);
            exit;
        }elseif(false == $zyList && false != $kldmList){
            $dataList1 = [];
            foreach ($kldmList as $k=>$v){
                $dataList1[$v['kldm']]['kldm'] = $v['kldm'];
                $dataList1[$v['kldm']]['klmc'] = $v['klmc'];
            }
            $data['msg'] = '1'; //成功
            $data['scoreList'] = '';
            $data['kldmList'] = $dataList1;
            echo json_encode($data);
            exit;
        } else{
            $data['msg'] = '2';//无数据
            echo json_encode($data);
            exit;
        }
    }

    /**
     * 根据年份省份，返回对应历年分数
     */
    public function charts()
    {
        if((!isset($_GET['province']) || empty($_GET['province'])) || (!isset($_GET['zydm']) || empty($_GET['zydm']))) {
            $data['msg'] = '3';
            echo json_encode($data);
            exit;
        }
        $year = intval($_GET['year']);
        if (!$year){
            //判断当前年是否有分数数据
            $year = date('Y');
            $fileName1 = 'Score'.$year;
            $db_name1 = C('DB_PREFIX').strtolower($fileName1);
            $Model = new \Think\Model();
            $m1 = $Model->query("SHOW TABLES LIKE '%$db_name1%'");
            if($m1){
                $dao = D($fileName1);
                $dataList = $dao->field('id')->select();
                if (false != $dataList){
                    $yearArr[0] =date('Y');
                    $yearArr[1] =date('Y') - 1;
                    $yearArr[2] =date('Y') - 2;
                }else{
                    $yearArr[0] =date('Y') - 1;
                    $yearArr[1] =date('Y') - 2;
                    $yearArr[2] =date('Y') - 3;
                }
            }else{
                $yearArr[0] =date('Y') - 1;
                $yearArr[1] =date('Y') - 2;
                $yearArr[2] =date('Y') - 3;
            }
        }else{
            $yearArr[0] = $year;
            $yearArr[1] = $year - 1;
            $yearArr[2] = $year - 2;
        }
        $provinceid = dHtml(htmlCv($_GET['province']));
        $zydm = dHtml(htmlCv($_GET['zydm']));
        $kldm = dHtml(htmlCv($_GET['kldm']));
        $where = array();
        $provinceid && $where['province'] = array('eq',$provinceid);
        $kldm && $where['kldm'] = array('eq',$kldm);

        for ($i=0;$i<2;$i++){
            $fileName = 'Score'.$yearArr[$i];
            $db_name = C('DB_PREFIX').strtolower($fileName);
            $Model = new \Think\Model();
            $m = $Model->query("SHOW TABLES LIKE '%$db_name%'");
            if ($m){
                $dao = D($fileName);
                if (strpos($zydm,'-') !== false){
                    $zydmArr = explode('-',$zydm);
                    switch($zydmArr[1]){
                        case '机场指挥':$lqzy =  substr($yearArr[$i],-2).$provinceid.'Z016';break;
                        case '通航综合航务':$lqzy =  substr($yearArr[$i],-2).$provinceid.'Z022';break;
                        case '地面服务':$lqzy =  substr($yearArr[$i],-2).$provinceid.'Z030';break;
                    }
                    $where['lqzy'] = array('eq', $lqzy);
                }else{
                    $where['queryzydm'] = array('eq', $zydm);
                }
                $scoreList[] = $dao->where($where)->field('year,topScore,lowScore,aveScore')->find();
            }
        }
        if (false != $scoreList){
            //根据年份从小到大排序
            $last_years = array_column($scoreList,'year');
            array_multisort($last_years,SORT_ASC,$scoreList);

            foreach ($scoreList as $key => $value) {
                if ($value['year'] != null){
                    $array['year'][]=$value['year'];
                    $array['topScore'][]=$value['topscore'];
                    $array['lowScore'][]=$value['lowscore'];
                    $array['aveScore'][]=$value['avescore'];
                }
            }
            $data['msg'] = '1'; //成功
            $data['scoreList'] = $array;
            echo json_encode($data);
            exit;
        }else{
            $data['msg'] = '2';//无数据
            echo json_encode($data);
            exit;

        }
    }

}