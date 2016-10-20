<?php

/*//初始化redis连接redis
$redis = new redis();
$redis->connect('127.0.0.1','6379');

//给redis设置一个key
$redis->set('name','liuhuanshuo');*/

$redis = new Redis();
$redis->connect('127.0.0.1',6379);


