<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/8/22
 * Time: 15:09
 */
// nginx 官方网站    nginx.org     wiki.nginx.org

// 提前安装gcc 和pcre
// yum -install pcre pcre-devel  zlib-devel  gcc

// 编译安装
// make && make install

// 启动nginx
//  cd /usr/local/nginx/


// 查看当前进程
// cat /nginx/logs/nginx.pid

// 检查当前的配置文件是否出错
// /usr/local/nginx -t


/**
 *  nginx
 *   信号控制
 */
//  kill TERN | INT               快速关闭进程
//  kill QUIT  进程               等所有请求请求完毕之后在关闭进程
//  kill HUP                      平滑的加载配置文件
//  kill USR1  进程               重新使用新的access.log
//  kill USR2  进程               平滑的升级
//  kill WINCH                    平滑的关闭进程 配合usr2


/**
 * nginx 配置文件
 */
// 全局区：
// workprogress 1；                有几个工作的子进程(可以自行修改，一般设置为cpu数 X 核数 )

// events 区
// work_connections                一个子进程最大允许多少个链接

// http 段
//

// http -server 段(配置虚拟主机)
// listen 80；                     监听的端口
// server_name localhost;          监听的域名

// location / {
//    root  z.com；                默认的访问根目录 (可以写相对路径 negix根目录)
//    index  index.html  index.php       如果没有输入文件名默认的主页
//
// }




/**
 *  nginx 日志管理
 */
// 默认采用main格式   在 logs/access.log 目录下

// 手动配置
// 在server段    access_log  logs/huancom.access.log  main;



/**
 *  local 匹配目录
 */

//1 location /            普通匹配

//2 location ~            正则匹配

//3 location =            精确匹配



/**
 *  rewrite 重写
 */
//  系统变量
//  conf/fastcgi.conf


//  通过ie浏览器访问的都定向到ie.html
//  if ($http_user_agent ~ MSIE) { rewrite ^.*$ /ie.html break; }

//  当访问的页面不存在的时候返回404页面
//  if (!-e $document_root$fastcgi_script_name) { rewrite ^.*$ /404.html break; }
//  *****  服务器内部rewrite和302定向不一样  302的话url都变了从新请求， 但是rewrite上下文不变

//  ecshop的商城实战
//  location /ecshop{
//    rewrite "goods-(\d{1,7})\.html" /ecshop/goods.php?id=1
//}






/**
 *  nginx 链接 php
 */
//  编译php的时候要使用--enable-fpm   当作独立模块的方式进行编译

//

//  nginx通过fastcgi模式 ，把php后缀的文件转发给9000端口的php进行处理
//  location ~ \.php$ {
//      fastcgi_pass   127.0.0.1:9000;
//      fastcgi_index  index.php
//      fastcgi_param  SCRIPT_NAME  $document_root$fastcgi_script_name;
//      include        fastcgi_params;
//  }


//  cp 配置文件
//  cp /mnt/php/php.ini /usr/local/php/lib/php.ini
//  修改fpm文件的名字
//  cp /etc/php-fpm.conf.default etc/php-fpm.conf
//  运行 php-fpm.conf


//  php链接mysql
//  在linux下面通过localhost链接mysql时候   php不是通过tcp来链接的  是通过socket链接的
//  解决方法：  修改php.ini    mysql.default_socket=/var/lib/mysql/mysql.sock



/**
 * nginx
 */
// 浏览器请求的时候携带可以接受的请求方式
// Accept-Encoding:gzip,deflate,sdch(google自己的压缩方式)
// 压缩流程
// 服务器->压缩->二进制文件->浏览器->解码->展现

// gzip配置的常用参数
// gzip  on|off
// gzip_buffers 32 4K|16            压缩在内存中缓冲几块,每块多大
// gzip_comp_level [1-9]            推荐6  级别越高，压缩力度越大，越浪费压缩资源
// gzip_disable 正则                    什么样的uri不进行正则
// gzip_min_length 200              开始压缩的最小长度，如果再小就不要压缩了，意义不大
// gzip_http_version 1.0|1.1        开始压缩的http协议的版本
// gzip_proxied                     设置请求者如果是代理服务器，该如何缓存内容
// gzip_types text/plain  application/xml     对什么类型来时进行压缩
// gzip_vary on|off                           是否传输gzip压缩标志

// 将以上信息写入server里面



/**
 * nginx的expire缓存设置  提高网站性能呢
 */
// 对于网站的图片，尤其是新闻站，图片一旦发布，改动的可能性是很小的
// 我们希望当用户访问一次以后，图片的缓存在用户的浏览器端，且时间比较长的缓存
// 可以用到 nginx的expire设置
// location image{
//     root html；
//     expires  5d；
//}



/**
 *  nginx做proxy做反向代理(动静分离)和upstream用来做反向代理和负载均衡
 */
//  location ~ \.php$ { proxy-pass http://xxx.xxx.xx.x:8080}

//  负载均衡
//  server {
//     listen 81；
//     server_name localhost;
//     root html;
//  }
//  server {
//     listen 82；
//     server_name localhost;
//     root html;
//  }
//  upstream imageserver{
//     server xxx.xxx.xx.x:81 weight=1  fail_timeout=3  max_fails=2;
//     server xxx.xxx.xx.x:82 weight=1  fail_timeout=3  max_fails=2;
//  }
//  location ~*\.(jpg|jpeg|gif|png){
//       proxy_set_header X-Forwarded-For $remote_addr;
//       proxy_pass http://imageserver;
//  }
//
//

/**
 *   nginx 直接传递给mem数据
 */
//   location / {
//      set $memcached_key "$uri"
//      memcached_pass 127.0.0.1:11211
//      error_page 404  /error.php
//   }






















