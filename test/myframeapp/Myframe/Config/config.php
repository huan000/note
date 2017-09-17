<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2017/8/27
 * Time: 16:36
 */

/**
 *  配置文件  返回配置项目
 *
 */
return array(
    'CODE_LEN'=>4,           //验证码长度
    'DEFAULT_TIME_ZONE'=>'PRC',  //设置默认时区
    'SESSION_AUTO_START'=>TRUE, //默认是否开启session
    'DEFAULT_CONTROLLER'=>'c',   //定义默认的控制器
    'DEFAULT_ACTION'=>'a', //定义默认的方法

    'SAVE_LOG' => TRUE, //默认是否开启日志
    'ERROR_URL' => NULL,    // 默认错误的跳转地址
    'ERROR_MSG' => '网站出错误了，这个是默认的错误信息',       // 默认的错误信息

    'AUTO_LOAD_FILE' => array('fun1.php','class1.php'),

    'DB_HOST' => '127.0.0.1',
    'DB_PORT' => '3306',
    'DB_CHARSET' => 'utf8',
    'DB_USER' => 'root',
    'DB_PASSWD' => '',
    'DB_DATABASE' => 'test',
    'DB_PREFIX' =>'',



);