<?php
// namespace Home\Controller;
// use Think\Controller;
// use Think\Log;
// use function PHPSTORM_META\type;
class LocalAction extends AuthAction {
    public function index()
    {
        // $data['phone'] = '18920820654';
        // $data['type'] = 'forgotpassword';
        // $idCard = '622123199607090654';
        // $res = $this->_sendSMS($data['phone'],$data['type'],60,$idCard);
        // if($res){
        //     echo 'success';
        // }
        // else{
        //     echo 'fail';
        // }
        echo 'dd';
    }

    /**
     * @param $aa
     * @return string
     */
    public function ceshi($aa='')
    {
        $_POST['type'] = 'forgotPassword';
        $_POST['phone'] = '18920820654';
        $_POST['sfzh'] = '622123199607090654';
        $_POST['verify_code'] = 'forgotPassword';
        parent::sendSMS();
    }

    public function interfacsTest(){
        $_POST['user_name'] = '张健';
        $_POST['id_number'] = '622123199607090654';
        $_POST['phone'] = '18920820654';

        $A = parent::getWebList();
        dump($A);
    }
}