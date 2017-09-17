<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/9/26
 * Time: 19:41
 */
include_once "./taobao-sdk-PHP-auto_1455552377940-20160607/TopSdk.php";

$code = '7878';

$c = new TopClient;
$c->appkey = '23466397';
$c->secretKey = 'f73bc7a794ca23b186f347deb1061d3d';
$c->format="json";
$req = new AlibabaAliqinFcSmsNumSendRequest;
$req->setExtend("123456");
$req->setSmsType("normal");
$req->setSmsFreeSignName("测试");
$req->setSmsParam("{\"name\":\"1234\",\"code\":\"$code\",\"time\":\"30\"}");
$req->setRecNum("15801620993");
$req->setSmsTemplateCode("SMS_16335189");
$resp = $c->execute($req);

echo '<pre>';
var_dump($resp);

