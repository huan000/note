<?php
/**
 *  这个是框架的核心类
 */


/**
 * Class Framecore  最终类  不用继承任何类
 */
final class Framecore{
    public static function run(){
        //创建常量
        self::_set_const();
        //创建应用文件夹
        self::_create_dir();
        //载入框架所需文件
        self::_import_file();
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
        //测试区
    }

    /**
     * 创建应用目录
     */
   public static function _create_dir(){
       $arr = array(
             APP_PATH,
             APP_CONFIG_PATH,
             APP_CONTROLLER_PATH,
             APP_VIEW_PATH,
             APP_PUBLIC_PATH
       );
       //创建目录
           foreach($arr as $v){
               //如果目录不存在则创建目录
               if(!is_dir($v)){
                   mkdir($v,0777,true);
               }
           }
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
            FUNCTION_PATH.DIRECTORY_SEPARATOR.'function.php',     //加载函数文件
            CORE_PATH.DIRECTORY_SEPARATOR.'Application.class.php'       //加载系统启动类
        );
        //加载系统必要的文件
        foreach($filearr as $value){
            require_once $value;
        }
   }
    

    
}


Framecore::run();
Application::run();

