<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/8/15
 * Time: 15:29
 */

//图片的缩放和裁剪和水印

    //图片的缩放和裁剪
    $src_image = imagecreatefromjpeg();
    $src_image1 = imagecreatefrompng();
    $src_image2 = imagecreatefromgif();

    $dst_image = imagecreatetruecolor(50,50);

    //进行图片的缩放
    imagecopyresampled('目标资源','原始资源','目标起始点x','目标起始点y','原图起始x','原图起始y','目标结束x','目标结束y','原图结束x','原图结束y');




//  图片的水印
    imagecopy('目标大图','原图小图','目标大图x','目标大图y','原图小图起始x','原图小图起始y','原图小图结束x','原图小图结束y');

//  其他图片处理函数
    imagesx();    //  获取图片的宽
    imagesy();    //  获取图片的高
    getimagesize();    //不用资源传入路径即可


/*
 *  图片缩放完整的函数
 *
 *      
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 * */




