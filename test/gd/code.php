<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/8/14
 * Time: 21:32
 */

//验证码的制作

/*
   $img = imagecreatetruecolor(200,50);
   $black = imagecolorallocate($img,0,0,0);
   $white = imagecolorallocate($img,255,255,255);
   $usercolor = imagecolorallocate($img,122,122,44);
   imagefill($img,0,0,$black);



   //画字
   $arr = array_merge(range(0,9),range('a','z'),range('A','Z'));
   shuffle($arr);
   $str = implode('   ',array_slice($arr,0,4));
   imagettftext($img,20,0,20,35,$white,'1.ttf',$str);
   //画干扰素
   for($i=0;$i<3;$i++){
       imagearc($img,mt_rand(0,200),mt_rand(0,50),mt_rand(0,200),mt_rand(0,50),mt_rand(0,360),mt_rand(0,360),$usercolor);
   }


   header('content-type:image/png');
   imagepng($img);
   imagedestroy($img);*/

   $img = imagecreatetruecolor(200,50);
   $black = imagecolorallocate($img,0,0,0);
   $white = imagecolorallocate($img,255,255,255);
   imagefill($img,0,0,$black);

   //设计随机字符串
   $arr = array_merge(range(0,9),range('a','z'),range('A','Z'));
   shuffle($arr);
   $str = implode(' ',array_slice($arr,0,4));

   //画字
   imagettftext($img,30,0,10,35,$white,'1.ttf',$str);
   //话干扰素
   for($i=0;$i<5;$i++){
       imagearc($img,mt_rand(0,200),mt_rand(0,50),mt_rand(0,200),mt_rand(0,50),mt_rand(0,360),mt_rand(0,360),$white);
   }


   header('Content-Type:image/png');
   imagepng($img);
   imagedestroy($img);