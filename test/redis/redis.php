<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/8/26
 * Time: 15:40
 */
// redis官网  redis.io


// redis和memcache的区别
// 1.  redis可以用来做数据的持久化，而mem是用来做缓存的
// 2.  redis存储的数据有结构， 而mem存储的数据只能是字符串

// redis的编译安装
// cd /usr/local/redis
// make && make PREIFX=/usr/local/redis install
// 复制redis的配置文件
// cp /usr/local/src/redis/redis.conf  /usr/local/redis
// 启动redis
// ./bin/redis-server ./redis/conf


//配置文件的修改
//  让redis以后台进程的方式运行
//  daemonize yes
//  数据库一共的大小
//  database


/**
 *  redis 通用类型操作
 */
// keys * |perg              查询当前都有哪些key
// randomkey                返回随机的key
// exists key                查看一个key是否存在
// del key                   删除一个key
// rename key                重命名一个key
// renamenx  key newkey      如果newkey不存在才可以改名
// select database           选择数据库
// ttl key                   查询key的生命周期
// expire key  秒            设置一个有生命周期的key
// presist key               设置一个已经有生命周期的key为永久有效




/**
 *   redis 数据结构 -string
 */
// set key value  nex  npx  nx  xx
//  如果ex 和 px 同时写 以后面的为准  nx不存在才做这个操作  xx  存在的时候才做操作

// mset  k1 v1 k2 v2                 一次设置多个值
// mget  k1 v1                       一次获取多个值
// setrange k1 2 xx                  从第二个开始变成xx
// getrange key start stop           获取一个字符串中的以小部分
// append key str                    追加字符操作
// getset old new                    返回的是old的值，然后设置new值
// incr  key                         key值上增加一个
// decr  key                         key值上减少一个
// incrby  key  num                  key值上增加几个
// decrby  key  num                  key值上减少几个



/**
 *   redis  数据结构-list  链表
 */
// lpush key value                   从左侧插入一个值
// rpush key value                   从右侧插入一个值
// lrange key start stop             截取链表中的值  如果是 0 -1  则查询所有
// lpop key                          从左侧弹出一个值并删除
// rpop key                          从右侧弹出一个值并删除
// lrem key +|-count value           从链表中删除指定的值count个,如果count是-则从后面往前删
// ltrim key start end               截取出一段内容  其余的都删除
// lindex key index                  返回索引上的值
// llen key                          查看链表的长度
// linsert key after|before tag value     在指定的tag前面或者后面插入指定的值
// rpoplpush  alist blist                 从alist的右边取出一个放入blist的左边
// brpop  blpop key time                  等待多少秒进行删除


/**
 *  位图法
 */

/**
 *  redis 数据结构 set集合
 */
//  1. 无序性   像一个大麻袋  装了许多的值没有顺序
//  2. 唯一性   集合里面的值是不重复的独一无二的
//  3. 确定性

//  sadd  key  value              集合中添加元素
//  smembers  key                 查看集合中所有的元素
//  srem  key  value              删除集合中的一个元素
//  spop key                      返回并删除集合中的一个元素
//  srandmember key               随机得到一个值但是不删除
//  sismember key value           查询这个值在不在集合中
//  scard key                     查询集合中总共有多少元素
//  smove source  dest  value     把source集合中的value删除并添加到dest集合中
//  sinter set1 set2 poly         求两个集合中的交集
//  sunion set1 set2 poly         求两个集合中的并集
//  sdiff set1 set2               求set1的差集
//  sxxxstore result  set1 set3   将结果集存储才result中


/**
 *   order set 有序集合
 */
// zadd key score1 value1  score2 value2       添加元素并且给元素设置权重
// zrange key  start  stop   withscores        按照权重取出指定区间的值
// zrangebyscore  key  start  stop  limit 1 2  按照权重取出权重区间的值
// zrank key value                             给定一个值查出他的排名
// zrevrank key  value                         给定一个值查出他的降序排名
// zremrangebyscore key start stop             按照权重区间删除指定的值【start，stop】
// zremrangebyrank key start stop              按照排名删除区间的值
// zrem key value                              删除一个指定的值
// zcard key                                   统计这个集合中有几个人
// zcount key start stop                       统计指定权重区间值的数量
// zinterstore   zunionstore



/**
 *    hash 数据结构
 */
// hset key field value                        设置一个域和值
// hmset key tield value  field2 value2        设置多个域和值
// hget key field                              得到一个域和值
// hmget key filed1 field2                     得到多个域和值
// hgetall key                                 返回key中所有的域和值
// hdel key field                              删除一个key中的一个值
// hlen key                                    查看一个key的长度
// hexists key field                           key中的域是否存在
// hincrby key field num                       将一个数字进行增长
// hincrbyfloat key field num                  将一个浮点数进行增长
// hkeys key                                   返回key中所有的field
// hvals key                                   返回key中所有的value


/**
 *  redis中的事务的特性
 */
// multi                            开启事务
// exec                             执行事务
// watch                            监控一个key， 如果key改变了则exec不成功
// Unwatch                          如果exec执行成功，则取消监视







