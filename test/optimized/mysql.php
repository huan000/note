<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/8/23
 * Time: 12:38
 */

/**
 *  优化方法
 */
//  表设计
//  索引技术的使用
//  相关功能的配置 (最大链接数，myisam的缓冲，innodb的缓冲池)
//  特定语句优化的措施
//  架构方面的优化  (复制，读写分离，负载均衡)


//   选择合适的存储引擎
//    myisam   数据和索引是分开保存的  .MYI(索引) .MID(存储引擎)  .frm (结构)
//    myisam   不支持事务和外键约束
//    myisam   在数据插入的时候会按照插入的顺序插入
//    myisam   实现的是表级的锁定
//    myisam   插入和读取的时候比innodb的速度快  (索引放在内存中)
//    myisam   支持全文索引

//    myisam工具    myisamPack  (压缩的是数据不是索引)
//    cmd 中进入myi的目录  myisamPack myisam_1(表名)
//    压缩之后重新建立索引  myisamchk -rq myisam_1
//    刷新该表             flush table myisam_1
//    压缩之后的后果：导致该表变成只读的了
//    如果想重新编辑该表    myisamchk --unpack myisam_1



//    innodb   数据和索引是保存在一起的 ibdate1(数据和索引) .frm (结构)
//    innodb   支持数据的完整行，支持 事务 和 外键约束
//    innodb   在数据插入的时候会按照索引的顺序插入，不会按照插入的顺序
//    innodb   采用表空间来统一管理，需要更大的存储空间
//    innodb   实现的是行级的锁定
//    innodb   因为是行级别锁定，并发性高，适合大量更新的操作

//    列类型的选择
//    能用数值类型就不用字符串的类型


//    纪录查询时间  利用profiling机制
//    set profiling          开启该机制
//    show profiles\G        查看每条语句的执行时间





/**
 *    索引的使用
 */
//    大批量的数据插入的时候 对于myisam
//    alter table table_name disable keys;       先禁用所有的key
//    insert
//    alter table table_name enable keys;        插入完数据之后再打开keys
//    大批量的数据插入的时候 对于innodb
//    将要导入的数据按照主键排序
//    set unique_checks=0;                       关闭唯一性校验
//    set autocommit=0；                         关闭自动提交
//    alter table table_name drop foreign key fk_symbol    关闭外键







/**
 *    mysql相关性能配置
 */
//    max_connections=100               最大的链接数  统一时刻最大支持的链接数，并发用

//    key_buffer_size=55m               myisam的键缓冲   可以将索引缓冲到内存的大小

//    table_open_cache                  用户打开缓存表的数量

//    innodb_buffer_pool_size=106m      innodb的缓冲池  例如 事物的预写

//    innodb_additional_mem_pool_size   innodb的表数据和索引数据的最大内存缓冲区的大小


/**
 * mysql查询缓冲
 *
 */
//  当mysql服务器需要执行一条select语句时，会首先检索查询缓存内，是否存在该条语句
//  的执行结果，一旦存在，则直接从查询缓存中获取结果即可
//  查询缓存的命中依据就是依赖于sql语句的，如果结果中存在动态数据，查询结果也不会缓冲的

//  查询缓存，需要配置后才能起作用
//  set query_cache_type =0 | 1          配置文件中设置关闭还是开启
//  set global query_cache_size=1024*n   设置查询缓冲的大小
//  reset query cache；                  重置缓冲 (清空)
//  flush query cahce；                  整理缓冲 (整理碎片)
//  show variables like "%query_cache%"  查询缓冲的设置情况
//  show status like "%Qache"            查询查询缓冲的状态

//  一旦查询缓冲对应的表的数据发生了变化， 响应的查询缓冲的数据立即杯销毁


/**
 *  mysql 分表(分区，水平分表，partition  )
 */
//  将在一个表中的数据，放入到多个表中完成
//  我们在定义表的结构的时候可以指定表应该划分的分区

//  create table table_name(字段定义)
//  partition by 分区算法(数据) ( 详细的每个分区的细节 )；


//  mysql 支持四种分区算法  hash，key ，range，list
//  hash key  采用取模轮询算法
//  range， list  采用的是条件算法

//  里面的字段必须是主键的一部分  hash 必须通过一个整形的主键进行分区
//  partition by hash(goods_id) partition 5;

//  key 通过一个字段自动进行取模分区
//  partition by key(goods_sn) partition 5;

//  range
//  partition by range(goods_id)(
//             partition p0 less then (1000),
//             partition p1 less then (2000),
//             partition p2 more then maxvalue,
//     )

//  list
// partition by list(goods_id)(
//     partition p0 values in(1,3,5,7,9),
//    )


// 维护分区：
//  range list
// alter table add partition(partition p3 values less then (2000));
// alter table table_name drop partition p3

//  hash key
//  alter table clients add partition partitions n
//  alter table clients coalesce partitions n


//  垂直分表
//  如果表中的字段过多， 可以将常用的和非常用的分开到多个表中
//  实际上就是两个表



/**
 *   mysql 主从复制(读写分离 ，其实就是复制技术)
 */
//  读操作和写操作分布到不同的服务器上
//  写服务器是主服务器   读是从服务器
//  原理：  主服务器 将操作记录到二进制日志中
//         从服务器 将主服务器的二进制日志中的操作，在从服务器中再操作一遍


//  主服务器配置
//  log-bin=mysql-bin             开启二进制日志
//  server-id=1                   服务器的id是1 是唯一的
//  在主服务器上为从服务器配置一个账号并配置密码
//  grant replication slave(权限) on *.*(任何表) to 'name' @ '%' identified by "pass"
//  查看主服务器的状态
//  show master status；



//  从服务器配置
//  log-bin=mysql-bin
//  server-id=2
//  链接主服务器
//  change master to master_host="", master_user="name" , master_password="pass"
//  master_log_file="" , master_log_pos= ;
//  开始复制
//  start slave




























































