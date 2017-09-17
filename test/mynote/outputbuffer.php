<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2017/7/12
 * Time: 18:44
 */

/**
 *  output_buffering:
 *   1.缓存响应主体
 *   2.默认脚本结束会刷新输出缓冲
 *
 *
 *   ob_flush();                刷出php缓冲区内容
 *
 *   ob_get_contents();         获取php缓冲区内容  (只是获得了副本)
 *   ob_get_clean();            获取php缓冲区内容并清除缓冲区
 *   ob_get_flush()             获取php缓冲区内容并刷出
 *   ob_get_length();           获取php缓冲区内容的长度
 *   ob_get_level();            多个缓冲区显示是第几个级别的
 *
 *   ob_clean();                清除php缓冲区内容
 *   ob_end_clean();            关闭php缓冲区并且清空
 *   ob_end_flush();            关闭php缓冲区并且刷新  (此行代码后面的内容会直接输出)
 *
 *  web_buffer:
 *    程序缓冲  php之后一个函数可以操作程序缓冲
 *    flush();
 *
 *
 *
 *   注意事项：
 *     1. 输出缓冲可以多次开启
 *          ob_start();                 // 开启第一并缓存
 *          echo '111';
 *          ob_start();                // 开启第二并缓存
 *          echo '222';
 *          ob_end_clean();            // 删除第二缓冲 区 (如果不执行end则以后永远操作的都是222)
 *
 *     2. 输出缓冲处理器：
 *          在输出缓冲要被刷新的时候 全部被这个函数作用到。
 *          ob_start(str_tolower());
 *          ob_start(ob_gzhandler);                 //开启压缩
 *
 *
 *
 */