<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/7/30
 * Time: 16:18
 */

/**
 * 桥接模式
 */

//  创建一个发送接口  一个类只发送一种信息
interface  Msg{
     public function send($to,$content);
}

class zn implements Msg{
     public function send($to, $content)
     {
         // TODO: Implement send() method.
         echo '站内信'.$to.'内容是：'.$content;
     }
}

class email implements Msg{
    public function send($to, $content)
    {
        // TODO: Implement send() method.
        echo '站内信'.$to.'内容是：'.$content;
    }
}




