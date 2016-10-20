<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/7/29
 * Time: 16:04
 */

/**
 *    策略模式
 *
 */


interface Math{
     public function calc($op1,$op2);
}

class MathAdd implements Math{
    public function calc($op1,$op2){
          return $op1+$op2;
    }
}

class MathDel implements Math{
    public function calc($op1,$op2){
          return $op1-$op2;
    }
}


/**
 * 策略模式类
 * 好处： 可以直接添加类来实现功能  而不用对类进行修改
 *
 * 
 */
class CMath{
    protected $cals = null;      //子类的集合当作父类中的一个属性
    public function  __construct($type){
           $calc = 'Math'.$type;
           $this->calc = new $calc();
    }
    public function calc($op1,$op2){           //直接通过这个属性来执行方法
           return $this->cals->calc($op1,$op2);
    }
}








