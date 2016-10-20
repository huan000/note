<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/8/15
 * Time: 20:27
 */

/*
 *  目录操作：
 * 创建目录
 *     mkdir($dir);
 *
 * 移动目录
 *     copy($sfile,$dfile);
 *     unlink($sfile);
 *
 * 删除一个空目录
 *     rmdir($dir);
 *
 *   遍历目录：
 * 打开目录
 *     opendir($dir);
 *
 * 读取目录
 *     readdir($handle);
 *
 * 关闭目录
 *     closedir($handle);
 *
 *     $handle = opendir('../gd');
       while($file = readdir($handle)){
         if($file=='.' || $file=='..'){
              continue;
         }
         echo $file;
         echo '<br>';
        }
       closedir($handle);

 *
 *
 *
 * 综合遍历目录
 *     scandir($dir);
 *   $arr = scandir('../gd');
      foreach($arr as $value){
           if($value == '.' || $value== '..'){
            continue;
           }
         echo $value;
         echo '<br>';
      }
 *
 *
 * 递归删除目录
 *
         function delDir($dir){
               $arr = scandir($dir);
               foreach($arr as $value){
                     if($value == '.' || $value == '..'){
                          continue;
                     }
                   $file = $dir.'/'.$value;
                   if(is_dir($file)){
                         delDir($file);
                   }else{
                         unlink($file);
                   }
               }
               rmdir($dir);
         }
         delDir('../del');



 *
 *
 *  递归复制目录
 *     function copydir($dir1,$dir2){
            @mkdir($dir2);
            $arr =  scandir($dir1);
            foreach($arr as $value){
                 if($value == '.' || $value == '..' ){
                         continue;
                 }
                $file1 = $dir1.'/'.$value;
                $file2 = $dir2.'/'.$value;
                if(is_dir($file1)){
                    copydir($file1,$file2);
                }else{
                    copy($file1,$file2);
                }
            }
     }
copydir('../gd','../gd1');


     移动目录
    移动之后删除掉原来的目录
 *
 *
 */

/*
 *  接收文件：
 *   $_FILE;
 *
 *  文件上传：
 *    move_uploaded_file($tmpurl,$durl)；
 *
 *  文件上传的错误码：
 *    0 ： 正确
 *    1 :  上传大小超过了上传框的最大限制
 *    4 ： 没有上传任何文件
 *
 *  文件上传限制：
 *    file_uploads                   是否允许文件上传    on
 *    upload_tmp_dir                 指定上传的临时文件     默认
 *    post_max_size                  post方式最大的传输      8M
 *    upload_max_filesize            文件框最大限制          2M
 *    max_input_time                 最大接收时间
 *    memory_limit                   内存最大使用额度 应该大于post_max_size   128M
 *    max_execution_time             脚本最大执行时间        30s
 *
 *
 *
 *  文件的下载：(只要找到完整的路径就可以了)
 *    输出一个文件之前
 *      header('Content-type:image/jpg');      输出
 *    以二进制流输出
 *      header('content-type:application/octet-stream');
 *    让文件以一个附件的形式进行下载
 *      header('content-disposition:attachment;filename={$file}');
 *    手动显示文件的大小
 *      filesiaze = filesize($file);
 *      header('content-length:{$filesize}');
 *    显示图片
 *      readfile($file);
 *
 *
 * */


$arr = array(345,4,17,6,52,16,58,69,32,8,234);
for($i=1;$i<count($arr);$i++){
    for($j=count($arr)-1;$j>=$i;$j--){
        if($arr[$j]<$arr[$j-1]){
            $temp = $arr[$j-1];
            $arr[$j-1] = $arr[$j];
            $arr[$j] = $temp;
        }
    }
}

for($i=0; $i<count($arr); $i++){
     for($j=count($arr)-1; $j<=$i; $j--){
         if($arr[$j]<$arr[$j-1]){
            $temp = $arr[$j-1];
            $arr[$j-1] = $arr[$j];
            $arr[$j] = $temp;
         }
     }
}


