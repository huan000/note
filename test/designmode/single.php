<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/7/28
 * Time: 20:20
 */

/**
 *   单例模式    一个类只能实例化一个对象
 */
//  只有当两个对象是一个的时候  才能实现  obj1 === obj2

/**
 *  思想核心： 只要是外部可以执行new操作就可以实现 多个对象的操作
 *     1.  不可以让外部new出对象  封锁new操作
 *         只要外部new了  就会触发内部的__construct();
 *          private __construct();     可以防止外部去new一个对象
 *          使用private 或者final  可以防止一个类在被继承时重写了构造方法
 *
 *     2.  内部留一个接口去可以new出对象 ， 这个接口还可以能在外部使用
 *         所以要使用静态方法
 *         getIns()可以先判断是否new过对象了   如果new过则不再创建对象
 *         这样可以保证只有一个对象
 *         private static $ins = null;
 *         public static function getIns(){
 *              if(self::$ins === null){
 *                 self::$ins = new self();
 *         }
 *              return self::$ins;
 *         }
 *
 *
 *     3.  生明一个方法  private __clone()    这样可以在被继承的时候阻止克隆
 *
 */

class single{
    private static $ins = null;
    public static function getIns(){
        if(self::$ins ===null){
            self ::$ins = new self();
        }
           return self::$ins;
    }
    private function __construct(){}
    private function __clone(){}

}

  $obj1 = single::getIns();
  $obj2 = single::getIns();
  $obj3 = single::getIns();

   var_dump($obj1);
   var_dump($obj2);
   var_dump($obj3);