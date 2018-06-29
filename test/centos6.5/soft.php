<?php

/**
 * 安装lrzsz
 * yum -y install lrzsz
 */

/**
 * 安装 tree
 * yum -y install tree
 */

/**
 *  memcache 软件安装
 *  1. 安装lilbevent 库
 *     ./configure --prefix=/usr   (把lib库安装到usr目录下)
 *      make && make install
 *  2. 安装memcache 库
 *     ./configure--with-libevent=/usr    (指定lib库的安装位置 ， lib > 1.3)
 *     然后make && make install
 */

/**
 *  linux 安装telnet服务端和客户端
 *    yum install telnet                (安装客户端)
 *    yum install telnet-server         (安装服务端)
 *
 *    开启服务端telnet服务
 *       vi /etc/xinetd.d/telnet
 *       修改 disable = yes 为 disable = no
 *
 *    需要激活xinetd服务
 *      service xinetd restart
 *
 *     telnet  默认占用  23号端口 看看服务是否被占用
 *
 */

/**
 *  linux 安装服务
 *  cd /redis        (进入redis的目录)
 *  make             (编译redis)
 *  cd /redis/src    (进入源码目录)
 *  make install     (安装执行程序)
 *
 *  ps: 可以把配置文件和命令统一安装到一个文件中
 */


/**
 *  linux 编译安装mysql 6.5
 * https://www.cnblogs.com/xiongpq/p/3384681.html
 *
 */