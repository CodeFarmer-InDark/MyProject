<?php 
/**
 * 
 * RecruitCompany(参加招聘会公司)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

class RegisterAction extends BaseAction
{
    public $dao;
	public function _initialize()
	{
		parent::_initialize();
		$this->dao = D('Register');

		$province = M('province')->order('id asc')->select();
		$this->assign('province',$province);
	}

    /*
     * 列表
     *
     */
	public function index()
	{
		parent::_checkPermission('Manager_index');
		$condition = array();
		$name = formatQuery($_GET['name']);
		$province = intval($_GET['province']);
		$id_no = formatQuery($_GET['id_no']);
		
		$name &&  $condition['a.name'] = array('like', '%'.$name.'%');
		$province &&  $condition['a.province'] = array('like', '%'.$province.'%');
		$id_no &&  $condition['a.id_no'] = array('like', '%'.$id_no.'%');
		$count = $this->dao->where($condition)->count();
		$p = new page($count, 15);
		// $dataList = $this->dao->Field('id,name,contact,mobile,contact_tel,recruitment')->Order("id DESC")->Where($condition)->Limit($p->firstRow.','.$p->listRows)->findAll();
		$dataList = $this->dao->Table(C('DB_PREFIX').'register a')->Join(C('DB_PREFIX').'province b on a.province=b.id')->field('a.*,b.province as pName')->Order("a.id DESC")->Where($condition)->Limit($p->firstRow.','.$p->listRows)->select();
		$page = $p->show();
		if($dataList!=false){
			$this->assign('pageBar', $page);
			$this->assign('dataList', $dataList);
		}
		parent::_sysLog('index');
		$this->display();
	}


	/**
     * 编辑
     *
     */
	public function modify()
	{
		parent::_checkPermission('Manager_modify');
		$item = intval($_GET["id"]);
		$jumpUri = trim($_GET['jumpUri']);
		// $record = $this->dao->Where('id='.$item)->find();
		$record = $this->dao->Where('id='.$item)->find();

		if (empty($item) || empty($record)) parent::_message('error', '记录不存在');
		$this->assign('jumpUri', $jumpUri);
		$this->assign('vo', $record);
		$this->display();
	}

	/**
     * 提交编辑
     *
     */
	public function doModify()
	{
		parent::_checkPermission('Manager_modify');
	    parent::_setMethod('post');
		$item = intval($_POST['id']);
		empty($item) && parent::_message('error', 'ID获取错误,未完成编辑');
		if($this->dao->create()) {
			$this->dao->update_time = time();
			$daoSave = $this->dao->save();
			if(false !== $daoSave)
			{
				//防止无权限操作情况下，修改自身资料跳转死循环
				$jumpUri = empty($_POST['jumpUri']) ? 0 : U('Index/index');
				parent::_sysLog('modify', "编辑:$item");
				parent::_message('success', '更新成功', $jumpUri);
			}else
			{
				parent::_message('error', '更新失败');
			}
		}else{
			parent::_message('error', $this->dao->getError());
		}
	}

	/**
	 * 数据导出
	 *
	 */
	public function doExport(){
		parent::_checkPermission('Manager_export');
		set_time_limit(60);
		ini_set("memory_limit","256M");
		$excelInfo = $this->dao->order('province ASC,score DESC,id ASC')->select();

		Vendor("PHPExcel.PHPExcel");
		$PHPExcel = new PHPExcel();
		$PHPWriter = new PHPExcel_Writer_Excel5($PHPExcel);
		$PHPProps = $PHPExcel->getProperties();
		$PHPExcel->setActiveSheetIndex(0);
		$PHPActSheet = $PHPExcel->getActiveSheet();
		spl_autoload_register(array('Think','autoload'));
		//格式化统计表头
		$PHPExcel->getActiveSheet(0)->setCellValue('A1', '姓名');
		$PHPExcel->getActiveSheet(0)->setCellValue('B1', '性别');
		$PHPExcel->getActiveSheet(0)->setCellValue('C1', '出生日期');
		$PHPExcel->getActiveSheet(0)->setCellValue('D1', '身份证号');
		$PHPExcel->getActiveSheet(0)->setCellValue('E1', '考生号');
		$PHPExcel->getActiveSheet(0)->setCellValue('F1', '高考所在地');
		$PHPExcel->getActiveSheet(0)->setCellValue('G1', '高考成绩');
		$PHPExcel->getActiveSheet(0)->setCellValue('H1', '手机号');
		$PHPExcel->getActiveSheet(0)->setCellValue('I1', 'QQ号');
		foreach($excelInfo as $key => $value){
			static $i = 2;
			$name[$i]['name'] =  $value['name'];
			$name[$i]['gender'] =  $value['gender'] == 1 ?'男':'女';
			$name[$i]['birthday'] =  strlen($value['id_no'])==15 ? ('19' . substr($value['id_no'], 6, 6)) : substr($value['id_no'], 6, 8);
			$name[$i]['id_no'] =  $value['id_no'];
			$name[$i]['candidate_no'] =  $value['candidate_no'];
			$mapProvince['id'] = array('eq',$value['province']);
			$province_name = M('province')->where($mapProvince)->getField('province');
			$name[$i]['province'] =  $province_name;
			$name[$i]['score'] =  $value['score'];
			$name[$i]['mobilephone'] =  $value['mobilephone'];
			$name[$i]['qq'] =  $value['qq'];

			$mapPro['province'] = array('eq',$value['province']);
			$scoreline = M('Scoreline')->where($mapPro)->getField('scoreline');
			if (intval($value['score']) < intval($scoreline)){
				$PHPExcel->getActiveSheet()->getStyle('A' . $i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
				$PHPExcel->getActiveSheet()->getStyle('B' . $i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
				$PHPExcel->getActiveSheet()->getStyle('C' . $i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
				$PHPExcel->getActiveSheet()->getStyle('D' . $i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
				$PHPExcel->getActiveSheet()->getStyle('E' . $i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
				$PHPExcel->getActiveSheet()->getStyle('F' . $i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
				$PHPExcel->getActiveSheet()->getStyle('G' . $i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
				$PHPExcel->getActiveSheet()->getStyle('H' . $i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
				$PHPExcel->getActiveSheet()->getStyle('I' . $i)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
			}
			$PHPExcel->getActiveSheet(0)->setCellValue('A' . $i, $name[$i]['name']);
			$PHPExcel->getActiveSheet(0)->setCellValue('B' . $i, $name[$i]['gender']);
			$PHPExcel->getActiveSheet(0)->setCellValue('C' . $i, $name[$i]['birthday']);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);
			$PHPExcel->getActiveSheet(0)->setCellValueExplicit('C' . $i, $name[$i]['birthday'],PHPExcel_Cell_DataType::TYPE_STRING);
			$PHPExcel->getActiveSheet(0)->setCellValue('D' . $i, $name[$i]['id_no']);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);
			$PHPExcel->getActiveSheet(0)->setCellValueExplicit('D' . $i, $name[$i]['id_no'],PHPExcel_Cell_DataType::TYPE_STRING);
			$PHPExcel->getActiveSheet(0)->setCellValue('E' . $i, $name[$i]['candidate_no']);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);
			$PHPExcel->getActiveSheet(0)->setCellValueExplicit('E' . $i, $name[$i]['candidate_no'],PHPExcel_Cell_DataType::TYPE_STRING);
			$PHPExcel->getActiveSheet(0)->setCellValue('F' . $i, $name[$i]['province']);
			$PHPExcel->getActiveSheet(0)->setCellValue('G' . $i, $name[$i]['score']);
			$PHPExcel->getActiveSheet(0)->setCellValue('H' . $i, $name[$i]['mobilephone']);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('H')->setAutoSize(true);
			$PHPExcel->getActiveSheet(0)->setCellValueExplicit('H' . $i, $name[$i]['mobilephone'],PHPExcel_Cell_DataType::TYPE_STRING);
			$PHPExcel->getActiveSheet(0)->setCellValue('I' . $i, $name[$i]['qq']);
			$PHPExcel->getActiveSheet(0)->getColumnDimension('I')->setAutoSize(true);
			$PHPExcel->getActiveSheet(0)->setCellValueExplicit('I' . $i, $name[$i]['qq'],PHPExcel_Cell_DataType::TYPE_STRING);
			$i++;
		}
		$filename = "Register_".date('Y-m-d',time()).".xls";
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename='.$filename);
		header('Cache-Control: max-age=0');
		$PHPWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
		$PHPWriter->save('php://output');
		parent::_sysLog('export', "导出花名册");
		exit;
	}
}
