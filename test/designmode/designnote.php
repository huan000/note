<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/7/28
 * Time: 18:13
 */

/*
 *  php的设计模式 (典型场景的典型设计方案)
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 */

abstract class Tiger{
       public abstract function climb();
}

class Xtiger extends Tiger{
      public function climb()
      {
          // TODO: Implement climb() method.
          echo '可以爬上去';
      }
}

class Ttiger extends Tiger{
      public function climb()
      {
          // TODO: Implement climb() method.
          echo '爬不上去';
      }
}

class Client{
     public static function call($obj){
          $obj->climb();
     }
}

Client::call(new Xtiger());
echo '<br>';
Client::call(new Ttiger());


