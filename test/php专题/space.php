<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/7/3
 * Time: 13:26
 */
namespace beijing\haidian\xisanqi;
 const USER='root';

namespace liaoning\shenyang\shenhe;
 const USER = 'admin';

 //访问当前空间元素  非限定名称方式访问元素
   echo USER;

 //访问其他空间元素   完全限定名称访问方式
   echo \beijing\haidian\xisanqi\USER;


 