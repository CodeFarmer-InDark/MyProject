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

class RegisterAction extends AdminAction
{
    protected $category , $dao;
    function _initialize()
    {
        parent::_initialize();

        $this->dao = D('Register');
    }

    /**
     * 列表
     *
     */
    public function index()
    {
        parent::_checkPermission();
        $count = $this->dao->Table(C('DB_PREFIX').'register c')->Join(C('DB_PREFIX').'province s on s.id = c.province')->count();
        $listRows = empty($pageSize) || $pageSize > 100 ? 15 : $pageSize ;
        $p = new page($count, $listRows);
        $dataList = $this->dao->Table(C('DB_PREFIX').'register c')->Join(C('DB_PREFIX').'province s on s.id=c.province')->Order('c.province ASC,c.score DESC,c.create_time DESC,c.id desc')->Limit($p->firstRow.','.$p->listRows)->select();
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
     * 导出
     *
     */
    public function doExport()
    {
        parent::_checkPermission('Register_export');
        //parent::_setMethod('post');
        $dataList = $this->dao->Table(C('DB_PREFIX').'register c')->Join(C('DB_PREFIX').'province s on s.id=c.province')->Order('c.create_time desc,c.id asc')->select();
        $str = "姓名,性别,身份证号,考生号,生源地,高考成绩,手机号,QQ,报名时间\n";
        $str = iconv('utf-8','gb2312',$str);

        foreach($dataList as $key => $value){ //$csv['xx']中的字段必须和field表中的code相同
            $csv['name'] = iconv('utf-8','gbk',$value['name']);
            if ($value['gender'] == 1){
                $gender = '男';
            }else{
                $gender = '女';
            }
            $csv['gender'] = iconv('utf-8','gb2312',$gender);
            $csv['id_no'] = iconv('utf-8','gb2312',"\t".$value['id_no']);
            $csv['province'] = iconv('utf-8','gb2312',$value['province']);
            $csv['candidate_no'] = iconv('utf-8','gb2312',"\t".$value['candidate_no']);
            $csv['score'] = iconv('utf-8','gb2312',$value['score']); //没数据
            $csv['mobilephone'] = iconv('utf-8','gb2312',"\t".$value['mobilephone']);
            $csv['qq'] = iconv('utf-8','gb2312',"\t".$value['qq']);
            $csv['create_time'] = iconv('utf-8','gb2312',date('Y-m-d H:i:s',$value['create_time']));

            $str .= $csv['name'].",".$csv['gender'].",".$csv['id_no'].",".$csv['candidate_no'].",".$csv['province'].",".$csv['score'].",".$csv['mobilephone'].",".$csv['qq'].",".$csv['create_time']."\n"; //用引文逗号分开
            unset($csv);
        }

        $filename = 'Register'.date('Y-m-d',time()).'.csv'; //设置文件名
        self::exportCsv($filename,$str); //导出
        parent::_sysLog('export', "导出中欧选拔报名信息");
        exit;

    }
    protected function exportCsv($filename,$data) {
        header("Content-type:text/csv");
        header("Content-Disposition:attachment;filename=".$filename);
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header('Expires:0');
        header('Pragma:public');
        echo $data;
    }
}
