<?php
class IndexController extends Controller{
    /**
     * 类的初始化
     */




    public function index(){
     $modelobj =  M('testuser');
//        $result = $modelobj->where('username="leo"')->delete();
//        echo '<pre>';
//        var_dump($result);


    }

    public function test(){
        $this->success('自定义跳转中','http://www.baidu.com',3);
    }
}