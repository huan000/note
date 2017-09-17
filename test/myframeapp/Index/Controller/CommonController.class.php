<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2017/9/4
 * Time: 20:46
 */

class CommonController extends Controller{
     public function _auto(){
         echo 'this is common init';
     }

    public function index(){
        echo 'welcome to my commoncontroller';
    }


}