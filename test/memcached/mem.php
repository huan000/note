<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/8/24
 * Time: 16:11
 */
//https://wenku.baidu.com/view/86032ad87f1922791688e81f.html
//  win下启动memcahce
//  进入mem目录     mem.exe -p(端口)  -d(安装成服务)   -m(占用内存)  -u(linux的用户)
//  -f (内存区域的增长因子)

//  mem客户端与服务器端的通信比较简单，使用基于文本的协议

//  memcache 服务开启后的链接
//   telnet 127.0.0.1 11211

//  添加一个数据
//  add key flag(压缩标识)  expire(有效期)   length(长度)      value
//  expire  0  不设置有效期(按照最长常量默认是30天 2592000秒)   从现在开始以后的秒数    设置时间戳(开团的提醒)
//  超过30天的 用time() + timestamp  时间戳的方式来进行显示

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



//  分布式算法 : 取模轮询
//  采用取模轮询算法  如果一台服务器坏掉之后  数据命中率下降到  1/(n-1)
//  缺点： 添加一台缓存服务器或者减少一台，代价巨大，会从新分配新值，使命中率降低

//  一致性哈希算法************  php分布算法待研究
//  当一台服务器宕机之后，剩下的缓存会均匀的分配给集群中其他的服务器中
//  原理: 按照常用的hash算法，将对应的key哈希到一个具有 2^32-1的 圆形闭环中。
//        然后将主机名也进行hash 映射到这个闭环当中。 所有的key都映射到了这些主机hashkey之间。 key会放入离自己最近的主机hash中
//        如果一台服务器宕机了,他的数据会顺时针转移到下一台服务器上，其他的服务器不受影响
//        如果增加一台服务器，会从中间截断放入新的服务器上，也是只影响一小段的数据

//  分布式是由php的memcache拓展决定的，mem本身是不进行互相通信的
//  大量加入addserver的时候，之后计算了存入哪个服务器之后才真正链接，不会有大量开销

//  数据存储机制: 为memcache分配内存之后，memcache把所有的内存一次性分配出来，然后数据一点一点的写入，保证一个高的效率
//  内存管理机制： slab
//               早期的memcache采用mallo内存分配机制，即动态分配内存，这种方式会造成较大的内存碎片，
//                slab: 提前将分配的大内存分割成若干个slab，大小默认是1m，在slab当中再建立大小相等的chunk，
//                      最后再把数据对象存入到chunk中。 不同的slab里面的chunk是不同的，同一个slab里面的chunk是相同的
//                      chunk的大小是根据调优增长因子进行调优的。 1.1中默认chunk大小是1b ，， 1.2中默认的大小是48b
//                      启动时 -f 可以控制增长因子   默认是1.25 的增长
//                      -n 参数指定chunk 的初始值。  默认是48字节
//                      如果几个slab存满之后，会分配新的page 默认是1m 继续存储

//  对象删除机制： LRU  如果内存满了，删除最近最少使用的数据
//                     使用 -M 参数启动之后  不适用lru 删除数据 ，而是会爆出一个错误



//  查找数据key机制： Hash


//  session 入memcache
//  修改php.ini： session.save_handler = memcahce;          session.save_path = "tcp://192.168.1.1:11211,tcp://xxx"
//  memcache 中存入session的key 是 session_id() ; 如果存入多个值，那么是用数组的形式保存的



//  php图形化界面
//  memadmin-1.0.12.tar.gz


//  memcache 拓展的一致性hash算法实现
//  php.ini 中： Memcache.allow_failover = 1
//               Memcache.hash_strategy = consistent         Memcache.hash_function = crc32

//  memcached 拓展的一致性hash算法的实现
//$mem = new Memcached();
//$mem->setOption(Memcached::OPT_HASH, Memcached::HASH_CRC);
//$mem->setOption(Memcached::OPT_DISTRIBUTION, Memcached::DISTRIBUTION_CONSISTENT);
//$servers = array(
//    array('192.168.20.193', 11211, 33),
//    array('192.168.20.194', 11211, 67)
//);
//$mem->addServers($servers);

// 在存储数组和对象的时候会自动序列化。 如果序列话的是对象，则还原对象的时候必须要找到这个对象的类

// 存入null的时候，get还会得到null
// 存入false的时候. get会得到 '';
// 存入8中值的时候会为false ： false ，0 ，0.0 ， ("0" ,"") , array(), 空的对象（没有任何成员的对象）， null ，空的xml
// 存入一个资源类型 会转化成 0 存入
// 序列化操作无法序列化资源类型， 序列化资源的时候会被转成0 , 反序列化一个类的时候也可以触发自动加载
// 如果反序列话类的时候 通过对象的_wakeup() 方法重新链接资源(因为资源不能被序列化)
// 所以在序列化的时候可以不用保存资源类型


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


//  缓存热点数据: 热点数据一般是由用户频繁更新的数据，例如淘宝卖家更改商品的价格,供很多的使用这来观看价格解决大流量的问题


























