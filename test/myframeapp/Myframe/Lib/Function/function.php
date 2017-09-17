<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2017/8/27
 * Time: 15:57
 */

/**
 * 系统函数文件
 */


/**
 * 打印函数
 *  ***********学习php中所有的打印函数
 */
function p($arr){
    if(is_null($arr)){
        var_dump(null);
    }
    if(is_bool($arr)){
        var_dump($arr);
    }
     echo "<pre style='paddint:10px;border-redius:5px; background-color:#f5f5f5; border: 1px solid #ccc;'>";
        print_r($arr);
     echo "</pre>";
}


/**
 *  1.加载配置项  首先加载系统  然后加载用户 C($sysconfig);
 *  2. 读取配置项  C('CODE_LEN');
 *  3. 临时更改配置项  C('CODE_LEN','20');
 *  4. 读取所有的配置项  C();
 */
function C($var = null,$value = null){
    static $config = array();       //静态变量，多次调用可以保存起来
    //如果传递的是数组就是加载配置项
    if(is_array($var)){
        $config = array_merge($config,array_change_key_case($var,CASE_UPPER));
        return;   //终止程序执行
    }

    //如果是读取配置项或者更改配置项
    if(is_string($var)){
        $var = strtoupper($var);
        if(!is_null($value)){
            $config[$var] = $value;
            return;
        }elseif(is_null($value)){
            return isset($config[$var]) ? $config[$var]: null;
        }
    }

    //如果什么都不传就是获取
    if(is_null($var) && is_null($value)){
        return $config;
    }
}


/**
 * @param $url 要跳转的地址
 * @param int $time  等待时间
 * @param string $msg   提示语言
 */
function go($url,$time=0,$msg=''){

        if(!headers_sent()){
             //还没有发送header的时候
            $time == 0 ? header("Location:$url"): header("refresh:{$time};url={$url}"); die($msg);
        }else{
            echo "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
            if($time) die($msg);
        }
}

/**
 * @param $error   错误提示
 * @param string $level 错误标题
 * @param int $type     错误模式
 * @param null $dest    保存路径
 */
function halt($error,$level='ERROR',$type=3,$dest=null){
        // 错误写入日志
        if(is_array($error)){
            //如果传递过来的数组
            Log::write($error['message'],$level,$type,$dest);           // 写入日志
        }else{
            Log::write($error,$level,$type,$dest);                      // 写入日志
        }

        $e = [];    //保存错误信息
        if(DEBUG){
               //记录错误信息 代码追踪
            if(!is_array($error)){
                    //如果不是数组
                    $trace = debug_backtrace();
                    $e['message'] = $error;
                    $e['file'] = $trace[0]['file'];
                    $e['line'] = $trace[0]['line'];
                    $e['class'] = isset($trace[0]['class'])?$trace[0]['class']:null;
                    $e['function'] = isset($trace[0]['function'])?$trace[0]['function']:null;
                    ob_start();
                    debug_print_backtrace();
                    $e['trace'] = htmlspecialchars(ob_get_clean());
            }else{
                    $e = $error;         //自己组合数据
            }
        }else{
                //没有开启debug的情况下   不显示错误，直接跳转
                    if(!is_null(C('ERROR_URL'))){
                        $url = C('ERROR_URL');
                        go($url);
                    }else{
                        $e['message'] = C('ERROR_MSG');
                    }
        }
            include DATA_PATH.'/Tpl/halt.html';
            die;
}

/**
 * 打印框架中所有的常量
 */
function print_const(){
    $const = get_defined_constants(true);
    p($const);
}


/**
 * 快速实例化模型类
 */
function M($table){
    $modelobj =  Model::getinstance($table);
    return $modelobj;
}













