<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/7/30
 * Time: 15:12
 */

/**
 *  适配器模式
 *  适配器模式通过子类的重写增加新的接口不用改动原来的类
 */


//服务器端代码 (供php客户端使用)
class tianqi{
     public static function show(){
           $today = array('temp'=>'28','wind'=>7,'sun'=>'sunny');
           return  serialize($today);
     }
}

/**
 * Class AdapterTianq  增加一个适配器共java客户端调用
 */
class AdapterTianq extends tianqi{
     public static function show(){
           $today = parent::show();
           $today = unserialize($today);
           return json_encode($today);
     }
}


//客户端调用
echo AdapterTianq::show();

