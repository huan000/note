<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/9/1
 * Time: 13:39
 */

/**
 * redis 消息发布与订阅
 */
// subscribe news               订阅一个news频道
// psubscripe ^news             以正则订阅一个频道
// publish news                 在news频道发布一个消息，返回值是推送给了几个粉丝

/**
 *  redis 持久化 rdb方式
 */
// 每隔n分钟或者n次增加和修改之后，从内存中dump数据形成rdb文件，压缩
// 放在备份目录

// 修改redis.conf
// save 900 1                   在900秒有一个改变的时候
// save 300 10                  在300秒有10个改变的时候
// save 60 10000
// stop-write-on-bgsave-error yes          在dump数据形成的时候如果出错禁止再写入
// rdbcompression yes                      进行压缩dump数据
// rdbchecksum yes                         如果从硬盘恢复到内存的时候进行检测文件有没有损坏
// dbfilename dump.rdb                     dump文件的文件名
// dir ./                                  dump文件放在哪

// rdb的缺陷，如果连个保存点之间的时候，突然断电了，则中间的数据全部都丢失了



/**
 *  redis aof 日志持久化
 */
// appendonly yes                 打开aof日志功能
// appendfsync always             把每一个命令都写入到文件
// appnedfsync everysec           折衷方案，每秒都写一次
// appendfsync no                 写入工作交给操作系统，由操作系统判断写入
// no-appendfsync-on-rewrite      正在导出rdb的过程中，要不要停止同步aof
// appendfilename /var/rdb/appendonly.aof       把aof文件放在哪
// auto-aof-rewrite-percentage 100              aof文件比起上次重写时候的大小增长100%，重写一次
// auto-aof-rewrite-min-size 64mb               aof文件至少要超过64m大小才进行重写
// bgrewrite                       手动执行aof的重写
//


// 在rdb dump过程中，aof如果停止同步，所有的操作缓存在内存的队列里
// dump完成后，统一操作

// aof从写是指把内存中的数据，逆化成命令，写入到aof日志中

// aof和rdb可以同时使用，推荐这种使用的方法

// rdb和aof相比，rdb的恢复速度要快一些，因为rdb是内存的映射，aof需要逐条执行

// rdb和aof同时存在时，系统恢复的时候首先选择aof

