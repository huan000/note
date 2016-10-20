<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/7/28
 * Time: 19:10
 */

/**
 * 简单工厂模式： 制造对象的类  (隐藏类的信息）
 */
   // **************  服务器端实现功能
   // 创建一个接口
interface DB{
      function conn();
}

  // 继承这个接口
class mysql implements DB{
    public function conn()
    {
        // TODO: Implement conn() method.
         echo 'mysql链接成功';
    }
}

class sqllite implements DB{
    public function conn()
    {
        // TODO: Implement conn() method.
         echo 'sqllite链接成功';
    }
}

//   工厂方法 生产类  可以隐藏类的信息
class SimpleFactory{
     public static function createDB($type){
            if($type == 'mysql'){
               return new mysql();
            }elseif ($type== 'sqllite'){
               return new sqllite();
            }else{
                return null;
            }
     }
}

//   工厂方法  实现新增加类不用更改原来的代码




//********************** 客户端别人调用我写的类

$mysql = SimpleFactory::createDB('mysql');
var_dump($mysql);
$mysql2 = SimpleFactory::createDB('mysql');
var_dump($mysql2);



