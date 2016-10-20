<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/8/13
 * Time: 14:01
 */
   /*图片处理函数*/
/*
 *1.做出基本样式  参照 万年历.html
 *
 *
 *
 *
 *
 *
 * */
//当前年
  $year = @$_GET['Y'] ? @$_GET['Y'] : date('Y') ;

//当前月
  $month = isset($_GET['m'])?$_GET['m']:date('m');

//当前月第一天的时间戳
  $firstday = strtotime("{$year}-{$month}-1");

//当月一共有多少天
  $days = date('t',$firstday);

//当前月第一天是周几    w代表是数字型的星期几
  $week=date('w',$firstday);

//下一年和下一月
$nextyear = $year;
$nextmonth = $month+1;
if($nextmonth>12){
    $nextmonth=1;
    $nextyear=$year+1;
}

//上一年和上一月
$prevyear = $year;
$prevmonth = $month-1;
if($prevmonth<1){
   $prevmonth=12;
   $prevyear=$year-1;
}



     




require "cala.html";






















