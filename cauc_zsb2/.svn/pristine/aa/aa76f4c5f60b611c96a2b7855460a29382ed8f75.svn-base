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

class UserAction extends BaseAction
{
    public $dao;
	public function _initialize()
	{
		parent::_initialize();
		$this->dao = D('User');
	}
	/**
     * 编辑
     *
     */
	public function modify()
	{
		$item = intval($_GET["id"]);
		$adminId = parent::_getAdminUid();
		if($item !== $adminId){
			parent::_message('error', '当前角色组无权限进行此操作，请联系管理员授权',0,10);
		}
		$jumpUri = trim($_GET['jumpUri']);
		//编辑自己资料时跳过权限检测，可以编辑自己帐户信息
		//if($item != parent::_getAdminUid()) parent::_checkPermission();
		$record = $this->dao->Where('id='.$item)->find();
		if (empty($item) || empty($record)) parent::_message('error', '记录不存在');
		$college = M('College')->where('id='.$record['college'])->find();
		$roleList = M('Role')->Order("id")->select();
		empty($roleList) && parent::_message('error', '当前无角色组，请先录入角色组');
		$this->assign('college', $college);
		$this->assign('roleList', $roleList);
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
	    parent::_setMethod('post');
		$item = intval($_POST['id']);
		//在无管理员管理权限的情况下，可以编辑自己帐户信息
		if($item != parent::_getAdminUid()) parent::_checkPermission('Admin_modify');
		empty($item) && parent::_message('error', 'ID获取错误,未完成编辑');
		$password = $_POST['password'];
		$opassword = $_POST['opassword'];
		if($password !== $opassword){
			parent::_message('error','两次输入密码不一致');
		}

		if($this->dao->create()) {
			if(!empty($password)){
				$this->dao->password = sysmd5($password);
			}else{
                unset($this->dao->password);
            }
			//return false;
			if($item == 1) {
				//防止修改默认用户所属组导致不能登录
				$this->dao->role_id = 1;
			}
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
     * 批量操作
     *
     */
	public function doCommand()
	{
		parent::_checkPermission('Admin_command');
		if(getMethod() == 'get'){
			$operate = trim($_GET['operate']);
		}elseif(getMethod() == 'post'){
			$operate = trim($_POST['operate']);
		}else{
			parent::_message('error', '只支持POST,GET数据');
		}
		switch ($operate){
			case 'delete': parent::_delete();break;
			case 'update': parent::_batchModify(0, $_POST, array('realname')); break;
			default: parent::_message('error', '操作类型错误') ;
		}
	}
	/**
	 * 提交导入
	 *
	 */
	public function doImport(){
		parent::_checkPermission('Member_import');
		ini_set("memory_limit","128M");
		$field = $this->dao->TABLE(C('DB_PREFIX').'field')->Field('id,name')->select();
		if(isset($_FILES["excel"]) && ($_FILES["excel"]["error"] == 0)){ 
            $result = $this->Import_Execl($_FILES["excel"]["tmp_name"]);
            if($this->Execl_Error[$result["error"]] == 0){ 
                $execl_data = $result["data"][0]["Content"]; 
                unset($execl_data[1]);
                foreach($execl_data as $k=>$v){
					$this->dao = D('User');
					$u["role_id"] = 10;
                    $u["username"] = $v[1]; 
					$u["password"] = sysmd5(substr($v[8],-8)); 
                    $u["status"] = 2; 
                    $u["reg_ip"] = get_client_ip(); 
                    $u["create_time"] = time(); 
                    $daoAdd = $this->dao->data($u)->add();
					$m["uid"] = $daoAdd;
					$m["name"] = $v[2];
					$m["gender"] = ($v[3] == '男')?1:0;
					$m["ethnic"] = $v[6];
					$m["birthday"] = substr($v[7],0,4).'-'.substr($v[7],4,2).'-'.substr($v[7],-2);
					$m["degree"] = $v[12];
					$m["educational_system"] = $v[11];
					$m["college"] = $v[4];
					foreach($field as $key=>$value){
						if($field[$key]["name"] == $v[5]){
							$m["field"] = intval($field[$key]["id"]);
						}
					}
					$m["source_place"] = $v[9];
					$m["admission_time"] = substr($v[13],0,4).'-'.substr($v[13],4,2).'-'.substr($v[13],-2);
					$m["graduate_time"] = substr($v[14],0,4).'-'.substr($v[14],4,2).'-'.substr($v[14],-2);
					$m["student_id"] = $v[0];
					$m["political"] = $v[10];
					$m["training_method"] = $v[16];
					$m["remark"] = $v[17];
					$this->dao = D('Member_student');
					$daoAdd2 = $this->dao->data($m)->add();
					$this->dao = D('Resume');
					$r["uid"] = $daoAdd;
					$r["foreign_language"] = $v[15];
					$r["update_time"] = time();
					$daoAdd3 = $this->dao->data($r)->add();
                }
				$this->success($this->Execl_Error[$result["error"]]); 
            }else{ 
                $this->error($this->Execl_Error[$result["error"]]); 
            } 
		}else{ 
            $this->error("上传文件失败"); 
        } 
    }
	
	protected function Import_Execl($file){ 
        if(!file_exists($file)){ 
            return array("error"=>1); 
        } 
        Vendor("PHPExcel.PHPExcel"); 
        $PHPExcel = new PHPExcel();   
        $PHPReader = new PHPExcel_Reader_Excel2007();           
        if(!$PHPReader->canRead($file)){       
            $PHPReader = new PHPExcel_Reader_Excel5();  
            if(!$PHPReader->canRead($file)){       
                return array("error"=>2); 
            } 
        } 
        $PHPExcel = $PHPReader->load($file); 
        $SheetCount = $PHPExcel->getSheetCount(); 
        for($i=0;$i<$SheetCount;$i++){ 
            $currentSheet = $PHPExcel->getSheet($i); 
            $allColumn = $this->ExcelChange($currentSheet->getHighestColumn());    
            $allRow = $currentSheet->getHighestRow();   
            $array[$i]["Title"] =  $currentSheet->getTitle(); 
            $array[$i]["Cols"] = $allColumn; 
            $array[$i]["Rows"] = $allRow; 
            $arr = array(); 
            for($currentRow = 1 ;$currentRow<=$allRow;$currentRow++){ 
                $row = array(); 
                for($currentColumn=0;$currentColumn<$allColumn;$currentColumn++){ 
                    $row[$currentColumn] = $currentSheet->getCellByColumnAndRow($currentColumn,$currentRow)->getValue(); 
                } 
                $arr[$currentRow] = $row; 
            } 
            $array[$i]["Content"] = $arr; 
        } 
        spl_autoload_register(array('Think','autoload'));//必须的，不然ThinkPHP和PHPExcel会冲突 
        unset($currentSheet); 
        unset($PHPReader); 
        unset($PHPExcel);        
        unlink($file);   
        return array("error"=>0,"data"=>$array); 
    } 
     
    protected function ExcelChange($str){//配合Execl批量导入的函数 
        $len = strlen($str)-1; 
        $num = 0; 
        for($i=$len;$i>=0;$i--){ 
            $num += (ord($str[$i]) - 64)*pow(26,$len-$i); 
        } 
        return $num; 
    } 
	protected $Execl_Error = array("数据导入成功","找不到文件","Execl文件格式不正确"); 

}
