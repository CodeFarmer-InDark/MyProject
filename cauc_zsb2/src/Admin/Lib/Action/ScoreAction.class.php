<?php 
/**
 * 
 * User(会员)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */

class ScoreAction extends AdminAction
{
    public $dao;
	public function _initialize()
	{
		parent::_initialize();
		$this->dao = D('Score');
	}

    /**
     * 列表
     *
     */
	public function index()
	{
		parent::_checkPermission('Search_index');
        $count = $this->dao->count();
        $p = new page($count, 20);
        $dataList = $this->dao->Order("id desc")->Limit($p->firstRow.','.$p->listRows)->select();
        $page = $p->show();

		/* 备注 */
		$dao=D('Remark');
		$remark = $dao->where('category_id=42')->order('id desc')->find();
		$this->assign('remark',$remark['content']);

		if($dataList!=false){
			$this->assign('pageBar', $page);
			$this->assign('dataList', $dataList);
		}
		parent::_sysLog('index');
		$this->display();
	}

	public function import(){
		$this->display();
	}

	/**
	 * 导入
	 */
	public function doImport(){
		set_time_limit(0); //六分钟
		//ini_set('memory_limit','2000M');
		parent::_checkPermission('Search_import');
		$filename = $_FILES['file']['tmp_name'];
		if ($filename == ''){
			parent::_message('error','请选择要导入的CSV文件');
		}

		/*线上*/
		$dataList = inputCsv($filename,'year,province,batch,major,type,topScore,lowScore');//解析CSV
		unset($dataList[0]);

		foreach($dataList as $k=>$v){
			if ($v['year'] !== ''){
				$u['year'] = $v['year'];
				$u['province'] = $v['province'];
				$u['batch'] = $v['batch'];
				$output = str_replace("(","（",$v['major']);
				$output1 = str_replace(")","）",$output);
				preg_match_all ("|（(.*)）|U", $output1, $major);
				$u['zyfx'] = $major[1][0]?$major[1][0]:''; //取专业方向
				$u['major'] = preg_replace('/\（.*?\）/', '', $output1);//剔除专业名称中的专业方向
				$u['type'] = $v['type'];
				$u['topScore'] = $v['topScore'];
				$u['lowScore'] = $v['lowScore'];
				$u['aveScore'] = intval(($v['topScore'] + $v['lowScore']) / 2);

				$u["create_time"] = time();
				$daoAdd = $this->dao->data($u)->add();
			}
		}
		/**/


		$dataList = inputCsv($filename,'year,province,batch,major,type,score');//解析CSV
		unset($dataList[0]);

		foreach($dataList as $k=>$v){
			$year[] = $v['year'];
			$province[] = $v['province'];
			$batch[] = $v['batch'];
			$major[] = $v['major'];
			$type[] = $v['type'];
			$score[] = $v['score'];
			$totalData[] = $v['year'].$v['province'].$v['batch'].$v['major'].$v['type'];
		}
		$count = count($year);
		for ($i=0;$i<$count;$i++) {
			for ($j=0;$j<count($totalData);$j++){
				if ($year[$i] == $year[$j] && $province[$i] == $province[$j] && $batch[$i] == $batch[$j] && $major[$i] == $major[$j] && $type[$i] == $type[$j]) {
					$data[$j][] = $year[$j].'-'.$province[$j].'-'.$batch[$j].'-'.$major[$j].'-'.$type[$j].'-'.$score[$i];
				}
			}
		}
		foreach ($data as $v) {
			$v = join(",",$v); //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
			$temp[] = $v;
		}
		$temp = array_unique($temp); //去掉重复的字符串,也就是重复的一维数组
		foreach ($temp as $k => $v) {
			$temp[$k] = explode(",",$v); //再将拆开的数组重新组装
		}
		foreach ($temp as $key => $val){
			for ($i=0;$i<count($val);$i++){
				$scoreArr[] = explode('-',$val[$i])[5];
			}
			$finalArr['year'] = explode('-',$val[0])[0];
			$finalArr['province'] = explode('-',$val[0])[1];
			$finalArr['batch'] = explode('-',$val[0])[2];
			$finalArr['major'] = explode('-',$val[0])[3];
			$finalArr['type'] = explode('-',$val[0])[4];
			$topScore = $scoreArr[array_search(max($scoreArr), $scoreArr)];
			$lowScore =  $scoreArr[array_search(min($scoreArr), $scoreArr)];
			$finalArr['topScore'] = $topScore;
			$finalArr['lowScore'] = $lowScore;
			$finalArr['aveScore'] = intval(($finalArr['topScore'] + $finalArr['lowScore']) / 2);
			$final[] = $finalArr;
			unset($scoreArr);
		}
		$daoAdd = M('Score_bak')->addAll($final);

		$dao = D('Remark');
		$dao->content = $_POST['remark'];
		$dao->category_id = 42;//历年分数的备注
		$dao->add();

		if (false !== $daoAdd){
			parent::_message('success','导入成功');
		}else{
			parent::_message('error','导入失败');
		}
	}

	/**
	 * 清空指定年份信息
	 */
	public function delete(){
		parent::_checkPermission('Search_command');
		$year = $this->dao->distinct(true)->field('year')->order('year desc')->select();
		$this->assign('yearExt',$year);
		$this->display();
	}

	/**
	 * 清空指定年份信息操作
	 */
	public function doDelete(){
		parent::_checkPermission('Search_command');
		$year = htmlCv(dHtml($_POST['yearExist']));

		if ($year == '0'){
			parent::_message('error','年份必须选择');
		}
		$condition['year'] = array('eq',$year);
		$daoDelet = $this->dao->where($condition)->delete();

		if (false !== $daoDelet){
			parent::_message('success',"{$year}年记录清空成功");
		}else{
			parent::_message('error','清空失败');
		}
	}


	/**
     * 批量操作
     *
     */
	public function doCommand()
	{
		parent::_checkPermission('Search_command');
		if(getMethod() == 'get'){
			$operate = trim($_GET['operate']);
		}elseif(getMethod() == 'post'){
			$operate = trim($_POST['operate']);
		}else{
			parent::_message('error', '只支持POST,GET数据');
		}
		switch ($operate){
			case 'delete': parent::_delete('score', 0, array('attach_image', 'attach_thumb'),$_POST);break;
			default: parent::_message('error', '操作类型错误') ;
		}
	}
}
