<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/5/25
 * Time: 11:45
 */

/**
 * 持久化功能
 */
//1. snap shotting快照持久化
//该持久化默认是开启的，一次性把redis中的全部的数据，如果数据非常多就不适合频繁的持久化操作

//快照持久化的触发机制
//  save 900 1                  900秒内如果超过一个key被修改（增删改），则发起快照保存
//  save 300 10
//  save 60 10000

//手动发起快照持久化
// ./redis-cli bgsave


// conf
// dbfilename dump.rdb  (文件持久化的名字，最好添加绝对路径，不然在home文件夹中)


//2. append only file  （精细持久化）
//把用户执行的每个增删改 都备份到文件中，还原数据的时候就是执行具体的指令而已（默认是关闭的）
//开启aof持久化会进行清空数据处理


//conf
//appendonly yes      开启精细持久化
//appendfilename appendonly.aof       精细持久化的文件的名字
//appendfsync always  每次收到写指令就立即进行备份，速度最慢，但是保证完全的持久化
//appendfsync everysec    每一秒钟强制写入硬盘中一次
//appendfsync no   完全依赖os，性能最好，但是持久化没有保证

//优化aof文件的大小
// ./redis-cli bgrewriteaof



/**
 * redis的主从模式
 */
// 主redis负责数据的写入  从redis负责数据的读取  (有效降低服务器的压力)

//conf
// 从服务器连接主服务器           slaveof  127.0.0.1 6379
// 从服务器只可以都数据           slave-read-only yes
// 连接主服务器时使用的密码        masterauth admin


/**
 * 其他配置
 */
// 日志文件的级别     loglevel debug|verbose|notice|warning
// 日志的输出文件     logfile /tmp/redis.log
// 为redis设置密码   requirepass password









































