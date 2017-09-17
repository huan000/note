<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2017/9/3
 * Time: 18:01
 */
class Controller{
    private $var = array();    //用于assign传递模板变量



    /**
     * 类的初始化
     */
    public function __construct()
    {
            /**
         * 如果当前类中有_init方法，则进行执行, 相当于实现了子类的构造方法
         */
        if(method_exists($this,'_init')){
            $this->_init();
        }
    }


    /**  成功跳转提示
     * @param $msg
     * @param null $url  跳转地址
     * @param int $time  跳转时间
     */
    protected function success($msg,$url=NULL,$time=6){
        $url = $url ? "window.location.href='".$url."'" : "window.history.back(-1)";
        include APP_VIEW_PATH.DIRECTORY_SEPARATOR.'success.html';
    }

    protected function error($msg,$url=NULL,$time=6){
        $url = $url ? "window.location.href='".$url."'" : "window.history.back(-1)";
        include APP_VIEW_PATH.DIRECTORY_SEPARATOR.'success.html';
    }


    /** 局部变量的作用域是在函数中 ， 传递变量
     * @param $var
     * @param $value
     */
    protected function assign($var,$value){
        $this->var[$var] = $value;
    }


    /**
     * @param null $tpl  模板路径
     */
    protected function display($tpl=null){
        if(is_null($tpl)){
            //如果没有传入模板路径
            $path = APP_VIEW_PATH.DIRECTORY_SEPARATOR.CONTROLLER.DIRECTORY_SEPARATOR.ACTION.'.html';
        }else{
            $suffix = strrchr($tpl,'.');
            // 根据是否有后缀判断文件路径
            $tpl = empty($suffix) ? $tpl.'.html' : $tpl;
            $path = APP_VIEW_PATH.DIRECTORY_SEPARATOR.CONTROLLER.DIRECTORY_SEPARATOR.$tpl;   // 控制器目录下面的文件
        }
        // 如果文件存在则加载 文件不存在则报错
            if(!is_file($path)) halt($path.'模板文件不存在');

        //  传递assign 过来的变量
            extract($this->var);       //键名作为变量名 值作为变量值
            include $path;
    }


    



}
