<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2017/8/5
 * Time: 19:40
 */

/**
 *      网络基础：
 *     网线知识：
 *     568a 和 568b     现在一般用568b ：  线序  橙白  橙   绿白   蓝     蓝白   绿   棕白  棕
 *
 *      交换机的特点和说明：
 *      1.在一个交换机的端口上所链接的所有终端设备，均在一个网段上(称之为一个广播域)
 *      并且一个网段会有一个统一的网络标识，会产生广播消耗和cpu资源损耗
 *      2.交换机可以隔离冲突域，每一个端口就是一个冲突域
 *      3.终端用户的设备接入
 *      4.基本的安全功能
 *      5，广域网的隔离(vlan)
 *      6.两个不同的广播域之间是不能相互通信的，因为所属于两个不同的网段之中
 *
 *      点播和组播
 *      点播： 一个点对一个点进行传输
 *      组播： 一个点对一个组进行传播
 *
 *
 *
 *      路由器的特点和说明：
 *      1.路由器是链接网络局域网和广域网的设备，它会根据信道的情况自动选择和设定路由，
 *      以最佳路径，按照前后顺序发送信号。其中有的路由协议是ospf路由协议，大企业rip协议
 *      静态路由 route
 *      2.路由器不转发私网地址。
 *      3.路由器的实质是隔离广播域，也就是使两个广播域之间的信息产生互通
 *      4.路由器的每个口都是链接一个广播域，每个口之间的通信不会产生类似广播风暴式的通信
 *        都是点到点的通信。
 *      5.会自动生成路由表，以最短的路径进行路由转发
 *      6.一般路由器会作为网关，一般作为网络出口的位置摆放一台路由器
 *      7.广域网链路的支持
 *
 *      网络osi七层模型：
 *      应用层：  应用程序接口， 提供应用的接口比如 ftp http 等等
 *               (pdu数据单元)
 *
 *      表示层：  对数据进行转换加密和压缩，
 *               (pdu数据单元)
 *
 *      会话层：  建立管理和终止会话
 *               (pdu数据单元)
 *
 *      传输层：  提供可靠的端到端的报文传输和差错控制。 实质上就是负责建立链接的。
 *                tcp和udp建立可靠和非可靠的链接，将上层数据进行分段处理
 *               (segment 段)
 *
 *      网络层：  将分组从源端传送到目标端。  提供网络互联。  实际上就是路由寻址 通过ip
 *                协议将上层数据进行分段打包
 *                (packet 包)
 *
 *      数据链路层：   将数据封装成帧，提过节点到节点方式的传输。 帧就是本地局域网中传输
 *                    数据的一个单元，负责局域网内部点到点的寻址
 *                 (frame 帧)
 *
 *      物理层：  在媒体上传输bite，
 *                 (bite  比特)
 *
 *     ip 是由网路号和主机号组成的，统一个网络号就是同一个网段
 *
 *
 *     网络传输过程：
 *      假设a用户传输数据给b用户，并且a用户和b用户是在两个不同的网段中的
 *      1.请求数据从a的应用层发出，经过表示层进行编译，加密，压缩等工作。
 *      2.表示层将数据发送到会话层，
 *      3.传输层由端口号的概念识别上层的服务，并且将上层的服务进行分段，并且用于保持
 *        a-b之间的通讯链接，以及链接的可靠性
 *      4.在网络层将数据进行打包，并且定义源ip地址和目标ip地址
 *      5.在数据链路层进行加工，并且定义源mac地址和目标mac地址
 *      6.在物理层转化为bite的二进制数据进行传输，
 *      7.数据到了路由器会对数据进行转发，会一次解压数据信息到第三层网络层，获得
 *        目标的ip网段，路由器根据目标的ip网段进行数据转发
 *      8.根据路由器的路由表确认传输进口之后，会将数据打包好变成bite之后再进行传输
 *      9.b收到包后进行依次的解包读取数据
 *
 *
 *     tcp和udp
 *      tcp: 是一种面向链接的，可靠的全双工的链接
 *      udp: 是一种面试事物的，不可靠的链接
 *
 *      313课：
 *      端口的概念：
 *      1.源端口一般为随机分配，目标端口为指定的知名端口
 *      2.客户端使用的源端口号一般为系统中未使用的且大于1023的随机端口
 *
 *
 *      tcp三次握手：
 *      报文信息：
 *      source port ： 源端口
 *      destination port ：   目标端口
 *      sequence Number :    序列号
 *      acknow number ：    认证号
 *      Data offset :
 *      reserved  :
 *                URG
 *                ACK : 标识验证字段
 *                PSH
 *                RST
 *                SYN ：位数置1， 表示建立链接
 *                FIN ：位数置1， 表示断开链接
 *
 *     三次握手建立过程说明：
 *          1. 由主机a发送建立tcp链接的请求报文，其中报文中包含seq序列号，由发送端
 *          随机生成，并且还将报文中的syn 字段设置为1 ，表示需要建立tcp链接
 *          2. 主机b会回复主机a发送的tcp请求，其中包含seq序列号，是由回复端随机生成的，
 *          并且将回复的报文的syn字段设置为1，并且产生ack字段，ack字段的值是主机a
 *          发送过来的seq序列号的基础上加1进行回复。以便a收到信息时，知晓自己的tcp建立
 *          请求已经得到了验证。
 *          3. a端收到b端回复的tcp请求之后，会使自己的seq序列号加1显示，并且再次回复akg
 *          验证请求，就是在b端回复的seq加上1进行显示，最后不会发送syn了，加1的seq会在data中一起发出
 *
 *
 *     四次挥手的建立过程说明：
 *          1. 主机a发送断开tcp链接请求的报文，其中报文中包含seq序列号，是发送端随机生成的，
 *          并且将报文中的fin字段设置为1，表示需要断开tcp链接。
 *          2. 主机b会回复a发送的tcp断开请求报文，其中包含seq序列号，是由回复端随机生成的，
 *          并且产生ack字段，ack字段的值是a主机seq的值加上1进行回复。
 *          3. 主机b会确保a的数据传输完毕之后，就会将报文的fin字段设置为1，并且产生随机的seq序列号
 *          4. 主机a收到主机b的tcp断开请求后，会回复主机b的断开请求，包含随机生成的seq和ack，
 *              ack字段会在b的tcp请求基础上加1进行验证回复
 *
 *
 *     arp协议：
 *          1. 将ipv4 地址解析为 mac 地址
 *          2. 维护映射的缓存
 *       ps: 网络层对应的是ip地址，是跨网段使用的，链路层对应的是mac地址，是局域网内部使用的
 *           mac地址就像是自己的小名一样，只对本地的局域网有效
 *
 *    arp过程：
 *         1. 链接外网首先通过网关， 主机a知道自己的mac和ip，知道已经配置好的网关ip，
 *         但是不知道网关的mac地址，所以发送广播通知交换机的所有设备，网关收到后返回mac地址信息
 *         给a主机，并且在本地arp表中记录a的mac和ip，其他设备不反回任何信息，但是会记录a的ip和mac地址
 *         ps: 发送最开始网关的mac是0000 全零显示，知道网关返回mac信息，返回是单播返回
 *             如果已经有了mac地址就不会全网广播了
 *
 *         2. 信息到达目标网段的路由器后，路由器会发送arp广播，根据IP地址找到目标网段中的b机器的
 *         ip地址，然后吧数据封装成bite，传输给目标b机器
 *
 *
 *     ip地址分类于子网划分 ：
 *          A类地址：一个网络位，三个主机位    1.0.0.0 --- 126.255.255.254
 *          B类地址：两个网络位，两个主机位    128.0.0.1 --- 191.255.255.254
 *          C类地址：三个网络位，一个主机位    192.0.0.1 --- 223.255.255.254
 *          D类地址：用于组播地址             224.0.0.1 --- 239.255.255.254
 *          E类地址：用于研究院地址
 *
 *     特殊地址：
 *          127.0.0.1    代表本地回环地址   不能使用
 *          如果主机位是全零的，代表网络地址
 *          如果主机位是255的 ，代表是广播地址
 *
 *     私网地址：
 *          a类私网：  10.0.0.0  ---  10.255.255.255
 *          b类私网：  172.16.0.0 --- 172.31.0.0
 *          c类私网：  192.168.0.0 ---  192.168.255.255
 *          c类私网：  169.254.0.0 --- 169.254.255.255
 *
 *
 *     nat技术： 地址转换技术，把局域网中的私网地址映射成公网地址在互联网中传播
 *
 *     可以分配的主机位的个数：  2的n次方 -  2      最后一个2代表0和255不可以分配
 *        n次方代表主机位的个数， a类地址有8x3个主机位
 *
 *     子网掩码：
 *        1. 通过网络地址的类型可以找到默认的掩码个数， /8/16/32
 *        2. 变更掩码，即进行子网划分
 *        3. 根据借用的主机位，可以判断出可用的子网信息
 *        4. 根据剩余的主机为，可以判断出可用的主机地址
 *        5. 得出主机范围，也就得出了网络地址和广播地址
 *
 *     可以划分的子网数就是2的n次方   n就是借用的主机位
 *
 *
 *      用户访问网站的流程：
 *        1. 用户输入域名，为了获取这个域名对应的ip ，首先查找hosts本地dns文件
 *           如果没有查找本地dns的缓存
 *        2. 如果没有，则查找自己配置的dns服务器ip地址 ，local DNS
 *        3. localDNS 如果有本地缓存则返回信息， 如果没有信息 则会查找全球13台根
 *           服务器中的一台。  根会返回存放.com 后缀地址的服务器并返回ip给localDNS
 *        4. localDNS 会查找.com的域名服务器，域名服务器会返回baidu.com的ip服务器给dns
 *        5. 最终查看www.baidu.com 的ip返回
 *
 *
 *     linux 相关网络命令：
 *        查看dns的整个解析流程：
 *          dig @8.8.8.8 www.baidu.com +trace
 *        查看一个域名由哪个服务器进行解析和域名的ip
 *          nslookup
 *          host
 *
 *      brige模式：相当于局域网中的一台主机
 *      nat模式：使用的是宿主主机的vmware8的网卡
 *      http://blog.csdn.net/kyjl888/article/details/74295634
 *
 *
 *     网卡的详细配置信息：   vim /etc/sysconfig/network-scripts/eth0    ||  setup-network config
 *        DEVICE=eth0                 逻辑设备名，代表第一块网卡
 *        HWADDR=00:...               网卡的mac地址，如果是vmware克隆的虚拟机可以毫不犹豫的删除此项
 *        TYPE=Ethernet               类型以太网卡
 *        UUID=123...                 通用唯一识别码，如果是vmware克隆的虚拟机可以毫不犹豫的删除此项
 *        ONBOOT=yes                  开机自动激活网卡
 *        NM_CONTROLLED=yes           是否通过networkManager管理网卡设备
 *        BOOTPROTO=none              启动协议获取配置方式，有 static|bootp|dhcp 三种方式
 *        IPADDR=192.168.1.1          虚拟机的桥接模式用于配置局域网中的linux固定ip
 *        NETMASK=255.255.255.0       配置子网掩码
 *        DNS1=8.8.8.8                主dns，默认优先级别高于/etc/resolv.conf
 *        DNS2=                       附属dns
 *        GATEWAY=                    局域网上网的网关地址
 *        IPV6INIT=no                 是否配置ipv6协议的ip地址
 *
 *      网卡的启动和生效：
 *        针对单个网卡：
 *            ifdown eth0
 *            ifup   eth0
 *
 *        针对所有网卡进行生效
 *        /etc/init.d/network restart
 *
 *      修改主机名的规范步骤：
 *        setup         网络配置-dns配置   通过图形化修改主机名
 *
 *        hostname hostname    这种是临时修改主机名的命令
 *        vi /etc/sysconfig/network             修改配置文件永久修改
 *        vi /etc/hosts                         修改本地的host文件更改回环接口
 *
 *      默认网关配置：
 *        第一生效文件：
 *        vim /etc/sysconfi/networkp-scripts/ifcfg-eth0       第一生效配置文件
 *        第二生效文件：
 *        vim /etc/sysconfig/network                          第二生效配置文件
 *        临时配置命令：
 *        route del default gw 10.10....                      删除网关命令
 *        route add default gw 10.10....                      添加默认网关
 *      查看网关
 *      route -n  || netstat -rn                       检查网关
 *
 *      配置别名ip：
 *        配置别名ip/虚拟ip
 *        ifconfig  eth1:0 10.0.0.0/24  up       只有临时生效   虚拟ip
 *
 *      永久生效：写成配置文件  /etc/sysconfig/network-scripts/ifcfg-eth0:1     写成配置文件
 *
 *      已知一个端口，查看端口上配置了什么服务
 *        lsof -i tcp:12123
 *        lsof | grep del             查看上回删除了什么东西
 *
 *
 *      网络故障排查思路：
 *        1. ping www.baidu.com
 *           首先ping一个网站，如果ping没通的话，看icmp协议有没有通。
 *
 *        2. traceroute -d www.baidu.com
 *            路由跟踪，查看路由一跳一跳是否进行了路由跟踪
 *
 *        3. telnet www.baidu.com 80
 *            查看一个网站的端口有没有开启
 *            如果不通：
 *             1.80服务没有开启或者端口不存在
 *             2.fw防火墙阻挡了
 *             3.服务监听的端口不再链接的ip上
 *             4.运营商默认不开，申请开端口
 *
 *       抓包监听
 *             tcpdump -n icmp -i eth1           监听的协议和网卡
 *
 *
 *
 *
 *       网站排查流程：
 *             首先ping 对方服务器 。如果通但是还不能上网可能是浏览器问题或者中毒问题
 *             然后ping 网关，排查局域网的物理线路问题
 *             如果ping 局域网内的其他机器是通的，但是ping网关不通的情况下，可能是
 *                      自身ip设置的问题，或者是网关把自己屏蔽了
 *
 *             如果ping 网关通的情况下，但是ping百度不通，可能是dns的设置问题
 *
 *
 *       面试题：
 *             1. 查看当前系统内网络的链接数
 *                     netstat -an | grep "ESTABLISHED"   ..sort ...uniq
 *             2. *****  端口服务文件
 *                     /etc/services
 *             3. 请列出linux系统下常用的集中文件系统的格式，并比较各自的特点
 *                     /lib/modules/2.6.32....x86_64/kernel/fs/    默认支持的所有文件格式
 *
 *             4. 配置静态路由  如果不配置静态路由会由网关出发
 *                    route add -net 192.186.0.0/24 gw 10.10.10.2    前面是目的地 后面是网关
 *
 *
 *      ******************没学完
 *
 *
 *
 *      awk： ***************没学完
 *          查看awk 版本    awk --version
 *
 *          内置变量：
 *              NR 代表记录的个数
 *              $NF  代表最后一个区域
 *              NF  区域的个数
 *              RS 每个记录读入时候的分隔符
 *              ORS  输出时候的分隔符
 *              FS(-F)  每个区域的分隔符
 *
 *          区域：
 *              $1 代表  第一个区域
 *              $0 代表  一整行
 *              $NF  代表最后一个区域
 *
 *
 *          记录：  默认一行就为一个记录
 *
 *
 *
 *
 *        集群搭建：
 *             负载1：  外网： 10.0.0.5/24       内网： 172.16.1.5/24       lb01
 *             负载2：  外网： 10.0.0.6/24       内网： 172.16.1.6/24       lb01
 *             apache：  外网： 10.0.0.7/24     内网： 172.16.1.7/24        web01
 *             nginx：  外网： 10.0.0.8/24      内网： 172.16.1.8/24        web01
 *             mysql：                          内网： 172.16.1.51/24      db01
 *             nfs:                             内网： 172.16.1.31/24      nfs01
 *             rsync:                                  172.16.1.41/24      backup
 *             管理服务器：  10.0.0.61/24               172.16.1.61/24      m01
 *      
 *
 *         ******  集群规划和优化
 *
 *         1.  备份服务器  ：  rsync  服务器
 *              resync特性：
 *                   1. 支持拷贝特殊文件，如链接文件，设备等。
 *                   2. 可以有排除指定文件或者目录同步的功能。
 *                   3. 可以保持源文件的目录属性均不改变
 *                   4. 可以实现增量同步，即只同步发生了变化的数据。因此数据传输效率很高
 *                   5. 可以使用rcp，rsh，ssh等方式来配合传输文件。rsync本身对数据不加密
 *                   6. 可以通过socket方式传输文件或者数据
 *                   7. 支持无需系统用户的进程的传输模式
 *
 *
 *          rsync的工作方式：
 *              1. 本地方式    相当于cp
 *
 *              2. 远程  ssh方式
 *                 pull      推
 *                 push      拉
 *
 *              3. 进程方式
 *                 服务端   rsync  占用 873端口
 *                 客户端   rsync  命令
 *
 *           1.本地备份
 *              rsync  file  file1                      备份
 *              rsync -vzrtopg  file  file1             保持属性备份
 *              rsync -avz --delete dir dir1          如果本地没有的文件   远端也没有
 *
 *              -avz   (相比vzrtopg 还多了Dl)    D：保持设备文件信息   l:保留软连接
 *              --exclude=file                  排除指定的文件
 *              --exclude-from=file             从一个文件列表中进行排除
 *
 *           ps:  /opt/ 的意思是，仅仅吧/opt/目录的内容同步过来，opt目录本身并不同步
 *                /opt  的意思是, 把opt目录和里面的内容都同步过来
 *
 *           2. ssh方式
 *              rsync -avz /hosts -e 'ssh -p 22' huan0000@192.168.x.x:/mnt/
 *
 *
 *           3. 守护进程方式
 *              备份服务器端：
 *                  配置文件  ： /etc/rsyncd.conf
 *
 *                  文件详解：
 *                     uid = rsync              创建虚拟用户  (客户端命令链接过来的时候使用rsync用户访问backup目录)
 *                     gid = rsync
 *                     use chroot = no          安全相关
 *                     max connections = 200    最大连接数
 *                     timeout = 300            超时时间
 *                     pid file = /var/run/rsyncd.pid     进程对应的进程号文件
 *                     lock file = /var/run/rsync.lock    锁文件
 *                     log file = /var/log/rsyncd.log     日志文件
 *                     [backup]
 *                     path = /backup        服务器端提供访问的目录
 *                     ignore errors         忽略错误
 *                     read only = false     可写
 *                     list = false          不能使用列表  例如 ls  ll
 *                     hosts allow = 192.xxx.xxx.xxx/24    哪个主机可以访问
 *                     hosts deny = 0.0.0.0/32           拒绝哪个主机访问  (没有拒绝)
 *                     auth users = rsync_backup       虚拟用户
 *                     secrets file = /etc/rsync.password       虚拟用户对应的账号密码
 *
 *
 *
 *              搭建服务：
 *                1. 创建用户
 *                     useradd rsync -s /sbin/nologin -M           指定登陆shell  并且不设定家目录
 *                2. 启动服务
 *                     rsync --daemon            启动后台服务
 *                3. 修改目录权限
 *                     chown -R rsync.rsync  /backup
 *                4. 编辑密码文件
 *                     vim /etc/rsync.password
 *                       rsync_backup:oldboy
 *                      chmod 600 /etc/rsync.passwd            必须使用600权限才可以使用
 *
 *                5. lsof -i ：873       查看端口  服务是否启用
 *
 *                6. 加入开机自动启动
 *                   echo "/usr/bin/rsync --daemon" >> /etc/rc.local
 *
 *               客户端配置：
 *                  1.配置密码
 *                   chmod 600 /etc/rsync.password
 *                   echo "oldboy" >> /etc/rsync.password    只写入密码  就行
 *
 *                  2.建立本地的临时目录文件
 *                   /backup
 *
 *                  3. 往服务器端进行推送
 *                   方法1
 *                   rsync -avz /tmp rsync_backup@192.xx.xx.xx::backup --password-file=/etc/password
 *                              本地推送目录  服务端用户@ip::服务端模块
 *                   方法2
 *                   rsync -avz /tmp rsync://rsync_backup@192.xx.xx.xx/backup/ --password-file=/etc/password
 *
 *                  从服务端拉取：
 *                   rsync -avz rsync_backup@192.xx.xx.xx::backup /tmp/ --password-file=/etc/rsync.password
 *                   rsync -avz rsync://rsync_backup@192.xx.xx.xx/backup/ /tmp/ --password-file=/etc/rsync.password
 *
 *
 *             ps: kill 对应的是pid  pkill对应的是命令
 *
 *             客户端推动和拉取时候排除同步：
 *             排除同步  rsync -avz --exclude= a    ...          排除a文件不同步
 *             排除同步  rsync -avz --exclude= {a,b}    ...          排除两个文件不同步
 *             排除同步  rsync -avz --exclude-from = paichu.org    ...    通过一个文件进行排除
 *
 *             服务端排除同步 ： 配置文件中添加参数
 *
 *             无差异同步：
 *             rsync -avz --delete ...
 *
 *             限速：
 *             rsync -avz --bwlimit=100 ...         每秒限制多少k
 *
 *             全网服务器备份解决方案实战：http://edu.51cto.com//center/course/lesson/index?id=58907
 *             1. 先搭建客户端和服务端 ，并且测试推送是否成功
 *             2. 客户端webserver 实现本地打包脚本
 *                cd / && tar zcvf  file1  file2   file3   dir1  dir2     打包一些文件
 *                cd / && tar zcvf www_$(date +%F).tar.gz /var/html/www/      打包网站
 *             3. 创建脚本目录， 创建脚本
 *                 1. mkdir -p /server/scripts； touch ./backup.sh
 *                 2. 编写脚本
 *                     #！/bin/sh
 *                    (获取ip)
 *                    IP=$(ifconfig eth1 | awk -F '[ :]+' 'NR==2 {print $4}')
 *                    Path="/backup/$IP"
 *                    [ ! -d /backup/$IP ] && mkdir /backup/$ip -p      (如果文件目录不存在则创建)
 *                    (打包文件)
 *                     cd / &&\
 *                     tar zcvf $Path/....
 *                    (添加验证标识)
 *                     touch $Path/flag_$(date +F)
 *                    (为文件生成md5值)
 *                     find /backup/ -type f -name '*$(date +%f).tar.gz' | xargs md5sum>/backup/flag_$(data +F)
 *                    (本地删除七天前数据)
 *                     find /backup -type f -name "*.tar.gz" -mtime +7 | xargs rm -f
 *              4. 配置定时任务
 *                 crontab -e
 *                 00 00 * * * /bin/sh /server/scripts/backup.sh &>/dev/null  (&> == 2>&1)
 *                 crontab -l     (检查一下)
 *
 *              5. 服务器端删除180天以前的文件
 *                 vim /server/scripts/del.sh
 *                  /bin/find /backup -type -f -name "*.tar.gz" -mtime +180 | xargs rm -f
 *                  (然后加入到定时任务即可)
 *             ps:
 *                  rm -r  递归的删除所有的文件
 *                  rm -f  忽略不存在的文件并且不提示错误信息
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 *
 */