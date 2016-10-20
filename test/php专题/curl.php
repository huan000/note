<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/7/22
 * Time: 14:01
 */

class Curl{
     private $url;

     public function __construct($url)
     {
         $this->url =$url;
     }

    public function file_get_contents($url){
          $content = file_get_contents($url);
          echo htmlspecialchars($content);
     }

     public function fget($url){
           $hanle = fopen($url,'r');
           $content = '';
           while($re = (fgets($hanle,1024))!==false){
              $content += $re;
           }
           fclose($hanle);
           echo $content;
     }

     public function curl(){
         $ch = curl_init();
// 2. 设置选项，包括URL
         curl_setopt($ch,CURLOPT_URL,$this->url);
         curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
         curl_setopt($ch,CURLOPT_HEADER,1);
// 3. 执行并获取HTML文档内容
         $output = curl_exec($ch);
         if($output === FALSE ){
             echo "CURL Error:".curl_error($ch);
         }
         echo htmlspecialchars($output);


// 4. 释放curl句柄
         curl_close($ch);

     }


}

$ch = curl_init('http://www.baidu.com');
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,0);
curl_setopt($ch,CURLOPT_PROXY,'108.28.248.15:8080');
curl_setopt($ch,CURLOPT_PROXYUSERPWD,'vpn:vpn');

$content = curl_exec($ch);


curl_close($ch);













