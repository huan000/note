<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/8/13
 * Time: 18:11
 */

/*
 *使用场景：
 *   1.验证码
 *   2.缩放
 *   3.裁剪
 *   4.水印
 *
 *
 *
   1.创建画布资源
   2.准备颜色
   3.在画布上画图像或者文字
   4.输出最终图像或者文字
   5.释放画布资源
 */

//1创建画布资源
    //1.1   创建一个基于调色变的256颜色画板
    //  imagecreate();
    //1.2   创建一个真彩色画布  256^3
    //  $img = imagecreatetruecolor(300,200);


//2 准备颜色
    //  $black = imagecolorallocate($img,0,0,0);
    //  $white = imagecolorallocate($img,255,255,255);


//3 在画布上画布
     //3.1 填充画布
     //  imagefill($img,0,0,$black);

     //3.2 画一个被填充的椭圆
     //  imagefilledellipse($img,圆心x,圆心Y,水平直径,垂直直径);

     //3.3 画一个线条的椭圆
     //  imageellipse($img,圆心x,圆心Y,水平直径,垂直直径);

     //3.4 画一个像素
     //  imagesetpixel($img,x,y,$white);

     //3.5 随机画500个点
        /* for($i=0;$i<500;$i++){
             imagesetpixel($img,mt_rand(0,500),mt_rand(0,500),$white);
         }*/

     //3.6 画线和线干扰素
          /* for($i=0;$i<100;$i++){
              imageline($img,起始x,起始y,结束x,结束y,$white);
           }*/


     //3.7 画一个线条的矩形
    //      imagerectangle($img,起始x,起始y,结束x,结束y,$white);



     //3.8 画一个多边形 (三个点 也可以画四个点五个点等等)  可以选择填充还是不填充
     //  imagefilledpolygon($img,x1,y1,x2,y2,x3,y3,$white);


     //3.9 画一个圆形
     //  imageellipse($img,圆心x,圆心Y,半径,$white);


     //3.10 画一个弧线
     //  imagearc($img,圆心x,圆心Y,水平直径,垂直直径，其实角度，结束角度,$color);


     //3.11 画一个扇区
     //  imagefilledarc($img,圆心x,圆心Y,水平直径,垂直直径,起始角度，结束角度,$color,IMG_ARC_PRE);


     //3.12 画一个线条的椭圆
     //  imageellipse($img,圆心x,圆心Y,水平直径,垂直直径);


     //3.13 画一个字符串
     //  imagestring($img,1-5,x,y,str,$white);


     //3.14 画一个ttf字符串   坐标是第一个字的左下角坐标
     //  imagettftext();




//4 输出或者保存画布
      //  header('Content-type:image/jpg');
      //  imagejpeg($img);     //如果第二个参数写了就保存


//5 销毁画布
//  imagedestroy($img);


















