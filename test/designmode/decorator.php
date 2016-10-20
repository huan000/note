<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/7/29
 * Time: 17:12
 */

/**
 *    装饰器模式 ：decorator
 *
 *
 */

// 普通装饰文章： 会造成子类繁多，子类继承子类的局面


/**
 *  使用装饰器装饰文章
 */
class BaseArt{
     protected $content;
     public function __construct($content){   //new对象的时候接收文章
        $this->content = $content;
     }
     public function decorator(){
         return $this->content;
     }
}



