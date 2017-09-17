<?php
/**
 *  这个是框架的核心类
 */


/**
 * Class Framecore  最终类  不用继承任何类
 */
final class Framecore{
    public static function run(){
        //检测入口文件是否设置了debug ，如果没设置则默认设置一个
        defined('DEBUG') || define('DEBUG',false);          //默认为关闭

        //创建常量
        self::_set_const();
        if(DEBUG){
            //开启调试模式没有上线
            //创建应用文件夹
            self::_create_dir();
        }else{
            //上线之后不报告错误
            error_reporting(0);
        }

        //载入框架所需文件
        self::_import_file();
        //进行 application类的调用
        Application::run();
    }

    /**
     * 设置常量
     */
    private static function _set_const(){
        //定义框架路径
        $path =  str_replace('\\','/',__FILE__);
        define('FRAME_PATH',dirname($path));
        //定义配置目录
        define('CONFIG_PATH',FRAME_PATH.DIRECTORY_SEPARATOR.'Config');
        //定义模板目录
        define('DATA_PATH',FRAME_PATH.DIRECTORY_SEPARATOR.'Data');
        //定义框架的类库文件目录
        define('LIB_PATH',FRAME_PATH.DIRECTORY_SEPARATOR.'Lib');
        //定义核心类文件
        define('CORE_PATH',LIB_PATH.DIRECTORY_SEPARATOR.'Core');
        //定义加载函数的目录
        define('FUNCTION_PATH',LIB_PATH.DIRECTORY_SEPARATOR.'Function');

        //定义项目的路径
        define('ROOT_PATH',dirname(FRAME_PATH));
        /**
         * 应用目录  自动可以创建
         */
        //定义前台或者后台的目录
        define('APP_PATH',ROOT_PATH.DIRECTORY_SEPARATOR.APP_NAME);
        //定义应用的配置项目
        define('APP_CONFIG_PATH',APP_PATH.DIRECTORY_SEPARATOR.'Config');
        //定义控制器目录
        define('APP_CONTROLLER_PATH',APP_PATH.DIRECTORY_SEPARATOR.'Controller');
        //定义视图目录
        define('APP_VIEW_PATH',APP_PATH.DIRECTORY_SEPARATOR.'View');
        //定义试图公共文件目录
        define('APP_PUBLIC_PATH',APP_VIEW_PATH.DIRECTORY_SEPARATOR.'Public');

        //定义公共文件夹目录
        define('COMMON_PATH',ROOT_PATH.DIRECTORY_SEPARATOR.'Common');
        //定义公共配置项文件夹
        define('COMMON_CONFIG_PATH',COMMON_PATH.DIRECTORY_SEPARATOR.'Config');
        //定义公共的模型
        define('COMMON_MODEL_PATH',COMMON_PATH.DIRECTORY_SEPARATOR.'Model');
        //公共库文件夹
        define('COMMON_LIB_PATH',COMMON_PATH.DIRECTORY_SEPARATOR.'Lib');

        //定义框架拓展类库目录
        define('EXTENDS_PATH',FRAME_PATH.DIRECTORY_SEPARATOR.'Extends');
        //定义第三方插件目录
        define('ORG_PATH',EXTENDS_PATH.DIRECTORY_SEPARATOR.'Org');
        //定义工具类拓展目录
        define('TOOL_PATH',EXTENDS_PATH.DIRECTORY_SEPARATOR.'Tool');

        //定义临时目录的路径
        define('TEMP_PATH',ROOT_PATH.DIRECTORY_SEPARATOR.'Temp');
        //定义日志目录
        define('LOG_PATH',TEMP_PATH.DIRECTORY_SEPARATOR.'Log');

        //定义判断请求常量
        define('IS_POST',($_SERVER['REQUEST_METHOD'] == 'POST')?TRUE:FALSE);
        if(isset($_SERVER['HTTP_X_REQUEST_WITH']) && $_SERVER['HTTP_X_REQUEST_WITH'] == 'XMLHttpRequest'){
            define('IS_AJAX',TRUE);
        }else{
            define('IS_AJAX',FALSE);
        }


        //测试区
    }

    /**
     * 创建应用目录
     */
   public static function _create_dir(){
       $arr = array(
           COMMON_CONFIG_PATH,              //公共配置文件夹
           COMMON_MODEL_PATH,               //公共模型文件夹
           COMMON_LIB_PATH,                 //公共类库文件夹
             APP_PATH,
             APP_CONFIG_PATH,
             APP_CONTROLLER_PATH,
             APP_VIEW_PATH,
             APP_PUBLIC_PATH,
             TEMP_PATH,         //定义临时目录
             LOG_PATH,          //定义日志目录
       );
       //创建目录
           foreach($arr as $v){
               //如果目录不存在则创建目录
               if(!is_dir($v)){
                   mkdir($v,0777,true);
               }
           }
       //创建成功或者失败的模板文件
           $noticestr = <<<str
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

</body>
</html>
str;
            //创建成功的模板
           is_file(APP_VIEW_PATH.DIRECTORY_SEPARATOR.'success.html') || file_put_contents(APP_VIEW_PATH.DIRECTORY_SEPARATOR.'success.html',$noticestr);
            //创建失败的模板
           is_file(APP_VIEW_PATH.DIRECTORY_SEPARATOR.'error.html') || file_put_contents(APP_VIEW_PATH.DIRECTORY_SEPARATOR.'error.html',$noticestr);

       /**
        * 函数补充：
        *   is_dir()             判断目录是否存在
        *   is_file();           判断文件是否存在
        *   mkdir();             创建目录
        *   file_exists()        判断文件或者目录是否存在，效率比较低
        */
   }
    
    
   /**
    *  载入系统的核心文件
    */
   public static function _import_file(){
        $filearr = array(
            CORE_PATH.DIRECTORY_SEPARATOR.'Log.class.php',        //加载日志类
            FUNCTION_PATH.DIRECTORY_SEPARATOR.'function.php',            //加载函数文件
            CORE_PATH.DIRECTORY_SEPARATOR.'Controller.class.php',        //加载总控制器类
            CORE_PATH.DIRECTORY_SEPARATOR.'Application.class.php'        //加载系统启动类
        );
        //加载系统必要的文件
        foreach($filearr as $value){
            require_once $value;
        }
   }
}
Framecore::run();
