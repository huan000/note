<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2017/9/13
 * Time: 20:35
 */

/**
 * Class Model 基础模型类
 */
class Model{
   private static $link = null;    // 静态资源，多次使用是同一个对象
   private static $instance = null;   // 静态对象

   protected $table = null;         //保存表名
   private $opt;                    //初始化表信息
   public static $sqls = array();   //记录发送过的sql


   public static function getinstance($table){
        if( !self::$instance instanceof self){
            //如果不是这个类的实例
            self::$instance = new self($table);
        }
       return self::$instance;

   }

   private function __construct($table=null)
   {

       //设置表名
       $this->table = is_null($this->table) ? C('DB_PREFIX').$table : C('DB_PREFIX').$this->table;

       //链接数据库
       $this->connect();        //初始化链接
       //初始化sql
       $this->_opt();

   }

   private function connect(){
        if(is_null(self::$link)){
            //还没进行数据库链接的时候
            $db = C('DB_DATABASE');
            if(empty($db)) die('请先配置数据库');
            $link = new mysqli(C('DB_HOST'),C('DB_USER'),C('DB_PASSWORD'),$db,C('DB_PORT'));
            if($link->connect_error) die('数据库链接错误');

            // 链接成功设置字符集
            $link->set_charset(C('DB_CHARSET'));
            self::$link = $link;     //将资源赋值给属性

        }
   }

   //初始化sql信息
   private function _opt(){
       $this->opt = array(
            'field' => '*',
            'where' => '',
            'group' => '',
            'having' => '',
            'order' => '',
            'limit' => ''
       );
   }

    //发送sql
    public function query($sql){
        self::$sqls[] = $sql;   //记录发送过的sql
        $link = self::$link;
        $result = $link->query($sql);
        if($link->errno) die("sql语句有错误$this->error");
        $rows = array();
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        $result->free();        //释放结果集
        $this->_opt();          //回复查询条件
        return $rows;
    }

    public function All(){
        $sql = "SELECT ".$this->opt['field']." FROM ". $this->table . $this->opt['where'] . $this->opt['group'] . $this->opt['having'] . $this->opt['order'] . $this->opt['limit'];
        return $this->query($sql);
    }

    /**
     * 获得没有查询结果集的数据
     */
    public function exec($sql){
        self::$sqls[] = $sql;           //记录查询语句
        $link = self::$link;            //获取mysqli的查询对象
        $bool = $link->query($sql);     //发送数据
        $this->_opt();                  //查询条件归位
//        var_dump($sql);die;
        if(is_object($bool)){
            //如果包含了查询结果集
            die('请用query方法发送数据');
        }
        if($bool){
            //发送成功
            return $link->insert_id ? $link->insert_id : $link->affected_rows;  //如果增加返回id，修改和删除返回受影响的条数
        }else{
            //发送失败
            die('数据发送失败');
        }
    }

    /**
     * 添加操作
     */

    
    

    /**
     * 删除操作
     */
    public function delete(){
        $sql = "DELETE FROM ". $this->table . $this->opt['where'];
        $this->_opt();
        return $this->exec($sql);
    }

    /**
     * 只取一条数据获取以为数组
     */
    public function find(){
        $data = $this->limit(1)->All();
        return $data[0];
    }

    /**
     * 更改部分查询条件
     */
    public function field($field){
            $this->opt['field'] = $field;
            return $this;
    }
    public function where($where){
            $this->opt['where'] =' WHERE '. $where;
            return $this;
    }  
    public function group($group){
        $this->opt['group'] = $group;
        return $this;
    }
    public function order($order){
        $this->opt['order'] = $order;
        return $this;
    }
    public function limit($limit){
        $this->opt['limit'] = " LIMIT ". $limit;
        return $this;
    }









   private function __clone(){}


}