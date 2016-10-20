<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/8/15
 * Time: 18:06
 */

//1  文件 和 目录操作
  /*  判断****************************************
   *  判断文件还是目录的类型    result: file || dir
   *    filetype('url');
   *
   *  判断是否是目录   result:bool
   *    is_dir('url');
   *
   *  判断是否是文件   result:bool
   *    is_file('url');
   *
   *  判断文件是否存在   result:bool
   *    file_exists('url');
   *
   *  判断文件的大小  (目录没有大小)   返回字节
   *    filesize('url');
   *
   *
   *
   *   文件操作**************************************
   *  文件删除
   *    unlink();
   *
   *  文件复制
   *    copy();
   *
   *  文件重命名
   *    rename();
   *
   *  打开文件
   *    fopen();
   *
   *  关闭文件
   *    fclose();
   *
   *  读取文件内容
   *    fread($resource,filesize($file));
   *    r   只读方式打开，文件指针在文件开头
   *    r+  读写方式打开，文件指针在文件开头
   *    w   写入方式打开，先清空文件在写入，如果没有文件则创建
   *    w+  读写文件方式，先清空文件，如果没有文件则创建文件
   *    a   追加写入打开，如果没有文件则创建文件
   *    a+  追加读写方式打开，如果文件不存在则创建文件
   *
   *
   *
   *    readfile();       #不需要资源
   *    file_get_contents();     
   *
   *  写入文件
   *    fwrite();
   *    file_put_contents($file,str,FILE_APPEND);     追加写入 默认是覆盖写入
   *
   *  指针归位
   *    rewind();
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