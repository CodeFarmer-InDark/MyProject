<?php
namespace Home\Controller;
use Think\Controller;
use Think\Log;
use function PHPSTORM_META\type;
class LocalController extends IndexController {
    public function index()
    {
        $data['phone'] = '18920820654';
        $data['type'] = 'forgotpassword';
        $idCard = '622123199607090654';
        $res = $this->_sendSMS($data['phone'],$data['type'],60,$idCard);
        if($res){
            echo 'success';
        }
        else{
            echo 'fail';
        }
    }

    /**
     * @param $aa
     * @return string
     */
    public function ceshi($aa='')
    {
        $data = [1,2,3,4];
        list($a,$b,$c,$d) = $data;
        echo $a.$b.$c.$d;
    }
}