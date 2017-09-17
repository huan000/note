<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2017/9/4
 * Time: 21:03
 */


class Log{

    /**
     * @param $msg      错误信息
     * @param string $level  错误级别
     * @param int $type    错误类型
     * @param null $dest   储存位置
     */
    public static function write($msg,$level='ERROR',$type=3,$dest=NULL){
        //如果没有开启日志则终止
        if(!C('SAVE_LOG'))return;

        //设置存储路径
        if(is_null($dest)){
            $dest = LOG_PATH . DIRECTORY_SEPARATOR . date('Y-m-d') .'.log';
        }
        //进行日志记录
        if(is_dir(LOG_PATH)) error_log("[time]:".date('Y-m-d H:i:s')."{$level}:{$msg}\r\n",$type,$dest);
    }










}