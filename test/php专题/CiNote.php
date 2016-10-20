<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/5/25
 * Time: 20:40
 */
//ci 的默认url模式是pathinfo模式

/**
 * 连接数据库
 */
//自动模式
// 在autoload.php 中， autoload['libraries']=array('database'); 即可

//手动模式
// 在需要数据库操作类的时候使用$this->load->database(); 即可


/**
 * 基础url的配置
 */
//配置url辅助函数
//在config.php 中， $config['base_url'] ='http://localhost/ci'

//自动模式
// 在autoload.php中， autoload['helper'] = array('url');


//手动模式
//
