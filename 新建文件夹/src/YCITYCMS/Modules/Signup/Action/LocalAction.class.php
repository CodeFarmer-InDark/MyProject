<?php
class LocalAction extends GlobalAction {
	public function index(){
	    $verify = $_GET['verify'];
	    $this->assign("sp",$_SESSION['verify']);
	    $this->assign("spp",md5($verify));
        $this->display();
	}

	public function ceshi(){
	    $data['phone'] = '18920820654';
	    $idCard = '622123199607090654';
        if(parent::_sendSMS($data['phone'],$data['type'],60,$idCard)){
            echo 'sss';
        }
    }

    public function ceshi1(){
        safe_b64encode();
    }
}