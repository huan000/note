<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2017/8/27
 * Time: 15:57
 */

/**
 * 系统函数文件
 */


/**
 * 打印函数
 */
function p($arr){
     echo "<pre>";
        print_r($arr);
     echo "</pre>";
}


/**
 *  1.加载配置项  首先加载系统  然后加载用户 C($sysconfig);
 *  2. 读取配置项  C('CODE_LEN');
 *  3. 临时更改配置项  C('CODE_LEN','20');
 *  4. 读取所有的配置项  C();
 */
function C($var = null,$value = null){
    static $config = array();       //静态变量，多次调用可以保存起来
    //如果传递的是数组就是加载配置项
    if(is_array($var)){
        $config = array_merge($config,array_change_key_case($var,CASE_UPPER));
        return;   //终止程序执行
    }

    //如果是读取配置项或者更改配置项
    if(is_string($var)){
        $var = strtoupper($var);
        if(!is_null($value)){
            $config[$var] = $value;
            return;
        }elseif(is_null($var)){
            return isset($config[$var]) ? $config[$var]: null;
        }
    }

    //如果什么都不传就是获取
    if(is_null($var) && is_null($value)){
        return $config;
    }
}
