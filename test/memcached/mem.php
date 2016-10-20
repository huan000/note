<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/8/24
 * Time: 16:11
 */

//  win下启动memcahce
//  进入mem目录     mem.exe -p(端口)  -d(安装成服务)   -m(占用内存)  -u(linux的用户)
//  -f (内存区域的增长因子)

//  mem客户端与服务器端的通信比较简单，使用基于文本的协议

//  memcache 服务开启后的链接
//   telnet 127.0.0.1 11211

//  添加一个数据
//  add key flag(压缩标识)  expire(有效期)   length(长度)      value
//  expire  0  不设置有效期(按照最长常量默认是30天)   从现在开始以后的秒数    设置时间戳(开团的提醒)


//  获取一个数据
//  get key

//  删除一个数据
//  delete key  秒数（n秒中不能使用这个键）  短期内代谢完毕

//  替换一个数据
//  replace key flag expire length value

//  添加和替换一个数据
//  set key flag expire length value

//  增加值 减少值
//  incr key num                    decr key num
//  应用场景： 秒杀商品功能   set count 0 0 4 1000       decr count 1
//  在内存中先进行设置一共有多少， 然后程序判断在进行抢单

//  查看mem的设置状态
//  stats
//  命中率的指定  get_hits/ (get_hits+get_misses)

//  fluse_all    清空所有数据对象


//  key  value 的参数限制
//  对key的限制在250个字节         value 1M  


//  memcache的删除机制
//  当某个值过期时 ， 其实并没有从内存中删掉
//  当取其值的时候判断有没有过期，如果过期了，则返回空  并且删除
//  如果当前的值没有get过，当有新值插入的时候，当成chunk来占用
//  这个称为惰性失效
//  如果122大小的chunk都满了，也没有过期数据，利用lru机制，删除最近最少使用的


//  linux的编译安装memcache
//  cd /usr/local/memcache
//  编译加载模块
//  /usr/local/php/bin/phpize --with-php-config=/usr/local/php/bin/php-config
//  编译安装memcache
//  ./config --with-php-config=/usr/loca/php/bin/php-config
//  修改php.ini
//  extension=/usr/local/php/lib/php/extension/no-debug-non-zts-12313131/memcache



//  分布式算法
//  采用取模轮询算法  如果一台服务器坏掉之后  数据命中率下降到  1/(n-1)

//  一致性哈希算法************
//  当一台服务器宕机之后，剩下的缓存会均匀的分配给集群中其他的服务器中

//  缓存的雪崩现象
//  不要把所有缓存生命周期建立的一样，因为同时失效之后会加大mysql的负载
//  或者让缓存在夜里负载低的时候失效


//  缓存无底洞现象
//  当服务器增多的时候，获得一个人的数据所要链接的mem服务器也就越多
//  解决方案：把某一组key， 按照其前缀的共同特征来进行分布，缓存都落在同一个key上的时候，可以减少连接数


//  永久数据被踢现象
//  当一段chunk满了之后要添加新的数据，不会首先踢出已经惰性删除的数据，因为没有get的时候
//  mem服务器不知道这些数据已经失效，所以会提出永久有效的数据
//  官方解决方案:永久数据和定时数据分开放




























