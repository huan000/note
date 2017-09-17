<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2017/8/27
 * Time: 16:00
 */


/**
 *  执行应用类
 */
final class Application{
    /**
     * 启动
     */
      public static function run(){
            self::_init();  // 加载三个个配置项
            set_error_handler(array(__CLASS__,'_myerror'));        //致命错误不能接受：加载用户自定义的错误配置
            register_shutdown_function(array(__CLASS__,'_myfateerror'));
            self::_user_import();      //加载用户自己定义的文件
            self::_set_url();    //设置外部路径
            //定义自动加载方法
            spl_autoload_register(array(__CLASS__,'_myautoload'));
            //创建初始化控制器
            self::_create_demo();
            //进行路由调度 实例化控制器
            self::_app_run();


      }

      /**
       * 定义自己的错误项
       */
      public static function _myerror($errno,$errmsg,$errfile,$errline){
            switch($errno){
                  //致命性错误开始
                  case E_ERROR:
                  case E_PARSE:
                  case E_CORE_ERROR:
                  case E_COMPILE_ERROR:
                  case E_USER_ERROR:
                  //致命错误结束

                  case E_STRICT:                //编码标准化警告
//                    break;

                  case E_USER_WARNING:
//                    break;

                  CASE E_NOTICE:
//                    break;
                  default:
                        if(DEBUG){
                              //如果开启了则载入模板
                              include DATA_PATH.'/Tpl/notice.html';
                        }
                    break;
            }
      }


      /**
       * 定义致命错误的处理: 如果没有错误之后也会触发
       */
      public static function _myfateerror(){
            if($e = error_get_last()){          //如果有错误就是真
                  self::_myerror($e['type'],$e['message'],$e['file'],$e['line']);
            }
      }


      /**
       * 定义自己的自动载入方法
       */
      private static function _myautoload($className){
            switch (true){
                  //判断是否是控制器
                  case substr($className,-10) == 'Controller':
                        $path = APP_CONTROLLER_PATH.DIRECTORY_SEPARATOR.$className.'.class.php';
                        if(!is_file($path)){
                              // 没有这个控制器
                              halt($path.'控制器未找到');
                        }
                        require $path;
                    break;



                  //判断是否是框架的类库拓展  Tool目录
                  default :
                        $path = TOOL_PATH.DIRECTORY_SEPARATOR.$className.'.class.php';
                        if(!is_file($path)){
                              //没有这个框架工具类
                              halt($path.'框架工具类未找到');
                        }
                        require $path;
                    break;
            }




      }

      /**
       * 定义默认控制器
       */
      private static function _create_demo(){
            $path = APP_CONTROLLER_PATH.DIRECTORY_SEPARATOR.'IndexController.class.php';
            $constr = <<<str
            <?php
            class IndexController extends Controller{
                  public function index(){
                       echo 'welcome to my default index controller';            
                  }
            }
str;
            //如果有默认控制器就继续，没有默认控制器就创建
            is_file($path) || file_put_contents($path,$constr);
      }


      /**
       *  进行调度 实例化控制器
       */
      private static function _app_run(){
            $c = isset($_GET[C('DEFAULT_CONTROLLER')])?$_GET[C('DEFAULT_CONTROLLER')]:'index';
            $c .= 'Controller';
            $a = isset($_GET[C('DEFAULT_ACTION')])?$_GET[C('DEFAULT_ACTION')]:'index';

            //把控制器和方法加入常量
            define('CONTROLLER',substr($c,0,-10));
            define('ACTION',$a);

            //实例化控制器和方法
            $controllerobj = new $c();
            $controllerobj->$a();
      }



      /**
       * 初始化框架
       */
      private static function _init(){
            //加载配置项到内存
            C(include CONFIG_PATH.DIRECTORY_SEPARATOR.'config.php');
            //加载公共的配置项
            $commonConfigPath = COMMON_CONFIG_PATH.DIRECTORY_SEPARATOR.'Config.php';
            $commonConfigStr = <<<str
<?php
            //生成用户配置项
            return array(
            
            );
str;
            is_file($commonConfigPath) || file_put_contents($commonConfigPath,$commonConfigStr);
            C(include $commonConfigPath);
            //用户的配置项
            $userconfigpath = APP_CONFIG_PATH.DIRECTORY_SEPARATOR.'config.php';
            //生成用户配置文件
            $userConfig = <<<str
            <?php
            //生成用户配置项
            return array(
            
            );
str;
            //判断是否生成用户配置项
            is_file($userconfigpath) || file_put_contents($userconfigpath,$userConfig);
            //加载用户的配置项
            C(include $userconfigpath);
            //设置默认时区
            date_default_timezone_set(C('DEFAULT_TIME_ZONE'));
            //是否开启session
            C('SESSION_AUTO_START') && session_start();
      }

      private static function _set_url(){
            /**
             * $_SERVER['REQUEST_URI'];  会加查询字符串，如果index.php隐藏不会显示
             * $_SERVER['SCRIPT_NAME'];  不会加查询字符串，如果index.php隐藏会显示
             * $_SERVER['SCRIPT_FILENAME'];  显示文件的绝对路径
             * $_SERVER['PHP_SELF'];     会显示控制器动作，不会显示查询字符串，如果index.php隐藏会显示
             */

            // 获得首页的路径
            $path = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
            // 转化斜杠
            $path  = str_replace('\\','/',$path);
            // 得到程序根目录
            define('__APP__',$path);
            // 得到根链接  不包含index.php
            define('__ROOT__',__APP__);
            // 定义模板路径
            define('__TPL__',__ROOT__.DIRECTORY_SEPARATOR.APP_NAME.DIRECTORY_SEPARATOR.'VIEW');
            //定义public 目录
            define('__PUBLIC__',__TPL__.DIRECTORY_SEPARATOR.'Public');
      }

      /**
       * 加载用户的自定义文件
       */
      private static function _user_import(){
            $fileArr = C('AUTO_LOAD_FILE');
            if(is_array($fileArr) && !empty($fileArr)){
                  foreach($fileArr as $value){
                        require_once COMMON_LIB_PATH.DIRECTORY_SEPARATOR.$value;
                  }
            }
      }









}