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
            self::_init();

      }


      /**
       * 初始化框架
       */
      private static function _init(){
            //加载配置项到内存
            C(include CONFIG_PATH.DIRECTORY_SEPARATOR.'config.php');
            //用户的配置项
            $userconfigpath = APP_CONFIG_PATH.DIRECTORY_SEPARATOR.'config.php';
            
      }





}