<?php
/**
 *  这个是项目的单入口文件
 *
 *  流程图
 *    单入口  ->  核心类  -> 设置常量  --  创建文件夹 -- 载入文件 -- （执行应用类）->
 *    初始化框架 --  设置外部路径 -- 自动载入 -- 创建demo -- 实例化控制器
 */

//定义前台目录
define('APP_NAME','Index');

//加载框架的核心类
require './Myframe/Framecore.php';

