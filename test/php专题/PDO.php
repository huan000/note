<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/8/11
 * Time: 14:29
 */

//  实例化一个pdo对象
     $pdo = new PDO('mysql:host=localhost;dbname=test','root','');

/*
 *   设置客户端字符集是utf-8
 *   $pdo->exec("set names utf8");
 *
 *
 *
 *
 * */

/*************************查********************************/
/*
 *   编写sql语句
     $sql = "select * from testuser";
     执行sql获得结果集   返回statement对象
     $stm = $pdo->query($sql);

     处理结果集使用statement对象   取出所有数据


     $rows = $stm->fetchAll(PDO::FETCH_NUM); 获得索引数组
     $rows = $stm->fetchAll(PDO::FETCH_ASSOC); 获得关联数组
     $rows = $stm->fetchAll(PDO::FETCH_ALL); 获得关联和索引的混合数组
     $rows = $stm->fetchColumn(0);  获得第一行的第一个数据
     $rows = $stm->fetch(PDO::FETCH_ASSOC); 获得第一行的数据


 * */




/*************************增********************************/
/*
 *    $sql = "insert into testuser(username,userpass) VALUES ('user4','4444444')";
      执行sql语句 ，返回被插入的行数
      echo  $pdo->exec($sql);
 *
 * */


/*************************删*********************************/
/*
$sql = "delete from testuser where id = 4";
   echo $pdo->exec($sql);

 * */

/*************************改*********************************/
/*
$sql = "update testuser set username = 'aaa' where id = 1";
$pdo->exec($sql);

执行成功返回条数，如果更改后相同返回0影响条数
 * */

/*************************预处理执行mysql********************************/
/*
     预处理：先准备一条sql语句，放在服务器上，但是并不执行，只有发送执行命令的
     时候才执行；   如果第二次传送一样的sql语句，则还用上回准备的sql进行执行

     预处理的根本优点： 提高sql注入的安全性


     $sql = "insert into testuser(username,userpass) values('liuhuanshuo',?)";
     准备预处理语句
     $smt = $pdo->prepare($sql);
     $smt->bindValue(1,'000');                 //往第一个问号上绑定之后然后执行

     执行预处理语句通过预处理对象
     if($smt->execute()){
               $tot = $smt->rowCount()；     返回影响的行数
               echo "执行预处理成功";
     }else{
               echo "执行预处理失败";
     }

*/

/*********************pdo的默认设置***********************/
/*
默认设置属性：
     $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);  设置默认的获取模式是关联数组
     $pdo->getAttribute(PDO::ATTR_DEFAULT_FETCH_MODE);    获取默认的获取模式是多少
     $pdo->setAttribute(PDO::ATTR_ERRMODE,ERRMODE_EXCEPTION);    设置错误可以被异常捕捉到




PDO:
    query();                         //执行有返回结果集的语句
    exec();                          //执行没有返回结果集的语句
    prepare();                       //执行预处理语句
    lastInsertId()；                 //获取最后一次插入的id
    setAttribute();                  //设置默认的pdo属性
    getAttribute();                  //获取默认的pdo属性

pdostatment:
    fetchAll();                      //返回所有的结果集
    fetch();                         //返回一行结果集
    fetchColumn();                   //返回一列结果集
    execute();                       //执行预处理语句
    rowCount();                      //返回受影响的行数
    bindValue();                     //绑定预处理语句
 */


/*********************pdo事务处理***********************/
/*
PDO类的补充方法:
       beginTransaction();
       commit();
       rollBack();

PDOException类:
       getMessage();                   返回错误信息
       getFile();                      返回错误的文件
       getLine();                      返回错误的行数


示例：
$pdo->beginTransaction();
try{
     $sql = " delete from user where id=1 ";
     $stm = $pdo->prepare($sql);
     $stm->execute();

     $sql = " delete form user where id=2";    //这句有错误默认已经被pdo抛出错误
     $stm = $pdo->prepare($sql);
     $stm->execute();

     // 上面代码都执行成功
     $pdo->commit();

}catch(PDOException $e){
     $pdo->rollback();             //执行撤回
     echo $e->getMessage();        //输出错误信息
     echo '<br>';
     echo $e->getLine();
}
















*/




