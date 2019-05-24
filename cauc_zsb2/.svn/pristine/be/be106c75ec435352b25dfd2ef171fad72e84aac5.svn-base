<?php
namespace Promotion\Controller;
use Think\Controller;
class WjxController extends Controller {
    public function index(){
        $wjx = json_decode(file_get_contents("php://input"),true);
        if(!empty($wjx)){
            $data['username'] = $wjx['thirdusername'];
            $data['score'] = $wjx['totalvalue'];
            $data['year'] = date('Y');
            $data['create_time'] = time();
            $daoAdd = M('Score',C('DB_CONFIG1')['DB_PREFIX'],'DB_CONFIG1')->add($data);
            if(false !== $daoAdd){
                echo 'success';
            }else{
                @header("http/1.1 404 not found");
                @header("status: 404 not found");
                echo 'error';
            }
        }else{
            @header("http/1.1 404 not found");
            @header("status: 404 not found");
            echo 'error';
        }

    }
}