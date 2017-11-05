<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2017/8/5
 * Time: 19:40
 */

/**
 *     网络基础：
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
 *             mysql：                         内网： 172.16.1.51/24      db01
 *             nfs:                            内网： 172.16.1.31/24      nfs01
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
 *                   rsync -avz /tmp rsync_backup@192.xx.xx.xx::backup/ --password-file=/etc/password
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
 *      // 搭建nfs 共享服务器
 *             nfs 服务器端：
 *            1. 软件1： nfs-utils     主程序
 *            2. 软件2： rpcbind       记录端口的中介程序，必须先开启
 *
 *            安装软件
 *            yum -y install nfs-utils rpcbind
 *            检查安装
 *            rpm -qa nfg-utils rpcbind
 *
 *
 *
 *       rpcbind：
 *            启动rpcbind服务
 *            /etc/init.d/rpcbind start
 *
 *            检查rpcbind服务端口
 *            netstat -lnutp | grep rpc         占用111端口
 *
 *            查看rpcbind 中介记录的端口
 *            rpcinfo -p  localhost
 *
 *      nfs：
 *            启动nfs 服务
 *            /etc/init.d/nfs start           占用主端口2049
 *            nfs会自动创建用户：
 *            id nfsnobody                    自动创建nfsnobody用户
 *
 *
 *            nfs 配置(服务器端)：  配置文件: /var/lib/nfs/etab  配置了nfsnobody的默认信息
 *            nfs配置文件: /etc/exports        默认是一个空文件
 *            1. 创建共享的目录   mkdir /data -p
 *            2. /data 目录的权限是通过 nfsnobody 用户来进行访问的 ，客户端链接过来的身份就是nfsnobody
 *            3. 改变目录的属主和属组  chown -R nfsnobody.nfsnobody /data
 *
 *            文件:
 *            # this is conf
 *            /data localhost(ip)(rw,sync)       sync： 直接写入到磁盘 ，不写是写入到缓冲区
 *                                               all_squash:  访问客户端共享目录的时候，不论登陆用户是谁都会变成nfsnobody
 *                                                            (客户端必须创建uid相同的nfsnobody)
 *                                                            /data 10.0.0.0/24(rw,sync,all_squash,anonuid=xxx,anongid=xxx)
 *
 *            配置文件平滑重启:
 *            /etc/init.d/nfs reload     新的请求享受新的配置文件。旧的请求下次享受新的配置文件
 *            检查配置文件是否重启：
 *            showmount -e localhost
 *
 *            ps：是否可以访问服务端文件权限是由  /etc/exports  和 目录的权限共同决定的
 *
 *
 *          nfs配置(客户端)
 *            客户端需要有rpc服务，可以没有nfs服务。因为不需要提供共享。
 *            1. 创建本地共享目录  mkdir -p /mnt
 *            2. 检查是否可以挂载   showmount -e  xxx.xxx.xxx.xx
 *            3. 挂载到远程共享目录中    mount -t nfs xxx.xxx.xxx.xx:/data /mnt
 *            4. 设置开机自动启动  echo "mount -t nfs xxx.xxx.xxx.xx:/data /mnt" >> /etc/rc.local
 *               ps： 不可以放在fstab之中进行挂载。 因为是网络挂载。 启动fstab的时候网络还没有开启
 *               chkconfig netfs on  启动该服务之后，可以在网络之前挂载了就
 *            5. 查看客户端的挂载情况：  cat /proc/mounts    防止df -h 延迟
 *
 * ***************************** 实例搭建 和  发送邮件没有学
 *
 *          客户端挂载的详细参数：
 *              -o     挂载的时候加上-o
 *              fg     前台挂载 (default)
 *              bg     后台挂载不会影响到前台的操作  (建议)
 *              soft   如果timeout延时后停止。(不建议)
 *              hard   会持续尝试进行挂载。 (建议)
 *              intr   防止一直挂载锁死
 *              rsize  一次读多少k
 *              wsize  一次写多少k
 *              suid | nosuid    挂载后文件不可以使用suid权限
 *              exec | noexec    是否可执行
 *              atime | noatime  是否记录访问时间。如果不记录访问事件会提高性能
 *
 *
 *
 *
 *
 *      ps: 对于 rpm/yum安装的软件
 *           service nfs start 这种启动方式和 /etc/init.d/nfs start 的启动方式是一样的
 *          删除一个目录七天之前的文件
 *           find /backup/ -type f -mtime -7 \(-name "*.log" -o -name "*.tar.gz"\)
 *
 *          linux 发送邮件：
 *           mail -s "标题" 邮件地址 < 文件路径
 *           echo "正文" | mail -s "标题" 邮件地址
 *
 *
 *
 *      inotify 简介:
 *          是一个强大的，细粒度的，异步的文件系统事件监控机制。 linux 内核从2.6.13
 *          加入了对inotify的支持。
 *
 *          inotify 是在客户端上配置的
 *          1. 查看版本信息是否支持inotify
 *                   uname -r
 *             查看 ll /proc/sys/fs/inotify       如果目录存在即为支持
 *
 *          2. 安装软件
 *                  yum install inotify-tools -y
 *
 *          3. 安装后一共产生两个核心命令
 *                  witch inotifywait             监控某个目录变化的命令
 *                  which inotifywatch            收集被监视的文件系统做统计的
 *
 *              inotifywait 参数:
 *                  -m   监听
 *                  -d   后台运行
 *                  -r   递归进行所有的监听
 *                  -e   事件
 *
 *              监控脚本：
 *                  #！/bin/bash
 *                  Path=/data
 *                  Ip=xxx.xx.xx.xx
 *                  /usr/bin/inotifywait -mrq --format '%w%f' -e close_write,delete $Path \
 *                  |while read file
 *                   do
 *                      cd $Path &&\
 *                      rsync -az ./ --delete rsync_backup@Ip::nfsbackup --password-file=/etc/rsync.password
 *                   done
 *
 *
 ************************************410 - 452 没看
 *
 *                web服务基础：
 *                  用户访问网站流程:
 *                    1. 输入一个域名 www.baidu.com 会首先找本地的host和缓存。
 *                    2. 会把一个域名找到对应的ip来访问。如果host找到了ip就访问ip。 没有就通过dns做解析
 *
 *                命令：
 *                    dig +trace www.baidu.com       查看一个地址和ip的映射路径
 *
 *                    http 1.1 简介:
 *                    建立了持久链接，也就是说一个tcp链接上可以建立多个http链接，不用每次都断开tcp链接了
 *
 *
 *
 *                网站浏览度量：
 *                  IP：每日有多少个ip进行访问。一个局域网内通过一个公网ip进行访问算一个
 *                      相同的ip 每天只算一次访问
 *                      度量方法：  1.通过js，记录用户的ip进行保存
 *                                 2.通过第三方的统计工具。GA(谷歌统计工具)
 *
 *                  PV: 每一个页面被访问一次就记录一个pv，与ip无关
 *
 *                  uv: 每一个设备终端一天访问一次就是一个uv
 *
 *
 *                代理相关软件:
 *                     lvs , haproxy , nginx , apache
 *                高可用相关软件:
 *                     keepalived, heartbeat
 *                网站缓存相关(cdn使用的软件，在服务器前端缓存):
 *                     squid,nginx,varnish
 *
 *                nginx:
 *                      nginx软件是一个实现http协议的实现软件产品化
 *                      nginx是一个web软件。同时还是一个反向代理负载均衡，和缓存软件。
 *
 *
 *                nginx实战安装:
 *                      1.首先安装pcre库。 官方站点是http://www.pcre.org/
 *                        安装pcre库是为了使nginx支持具备uri重写的功能Rewrite模块
 *                        安装:
 *                            国内镜像地址:http://mirrors.aliyun.com/help/centos
 *                            yum install pcre pcre-devel -y
 *                            yum install openssl openssl-devel -y    支持https
 *                            yum -y install gcc                      安装编译工具
                              yum -y install gcc-c++
 *
 *                      2.下载 nginx 源码包
 *                        wget -q http://nginx.org/download/nginx-1.8.1.zip   -q 不进行提示
 *                                                                            -O 将下载的文件重新命名
 *                            tar zxvf  nginx    解压
 *                      3.安装
 *                        ./configure --user=WWW --group=WWW --with-http_ssl_module
 *                        --prefix=/usr/local/nginx1.8
 *
 *                        nginx -t  检查配置文件语法是否正确
 *                        nginx -V  查看版本以及编译时候的配置
 *                        nginx/logs/error.log     web软件的错误日志
 *
 *                      4.添加用户
 *                        useradd WWW -s /sbin/nologin -M
 *
 *                      5.检查安装是否成功
 *                        netstat -lnutp | grep 80     检查端口
 *                        lsof -i :80                  检查端口监听
 *                        ps -ef |grep nginx           检查服务
 *
 *                      6.平滑重启加载配置文件  nginx -s reload
 *
 *                  ps:
 *                  rpm -qa 根据指定的安装包查看是否安装
 *                  rpm -qf 根据指定的命令查看这个命令的安装包
 *                  rpl -ql 查看一个包里有那些文件
 *
 *          nginx 结合燕十八：
 *               十八第二课： 信号控制
 *                  关闭进程： kill -INT 26652(主进程号) == ./nginx -s stop  -INT 当前正在处理中的进程处理完才杀掉
 *                            kill -9 ..     强制杀死所有进程
 *                            kill -QUIT == ./nginx -s quit  等进程完毕才进行关闭
 *                            kill -HUP  == ./nginx -s reload  (主进程不重启)  先开启新的线程读取新配置文件，旧的等结束时候在关闭
 *                            kill -USR1 == ./nginx -s reopen   不重启 重新加载配置文件中的日志文件
 *                            kill -USR2    不重启 进行平滑的升级
 *                            kill -WINCH   配合usr2 进行优雅的关闭旧的版本的进程
 *
 *
 *              nginx 配置文件:
 *                   全局区域
 *                 worker_processes 1;    工作的子进程有几个  一般设置为 cpu数 * 核心数
 *
 *
 *
 *                   event区域 ：配置进程的链接特性
 *                 event{
                        worker_connections 1024;     一个进程可以产生多少个链接
 *
 *                  }
 *
 *
 *
 *                   http区域 : 主要配置的就是http相关的信息
 *                 http{
 *                      server{                                     多个server如果没有匹配则指向第一个
                            listen 80;                              监听的端口
 *                          server_name localhost;                  监听的域名(客户端请求头中的地址)
 *                          server_name 192.xxx.xx.xx'              根据ip配置的虚拟主机
 *                      }
 *                  }
 *
 *
 *              nginx的相关变量：
 *                  /conf/fastcgi_param
 *
 *
 *              日志管理:
 *                  可以出现在所有的server虚拟主机标签中。
 *                  access_log logs/access.log main;
 *                  main : 格式信息定义在http段当中。
 *
 *              切割日志：
 *                  LOGPATH=/usr/local/nginx/logs/access.log        日志地址
 *                  BATHPATH=/data                                  备份地址
 *                  bak=$BATHPATH/$(date -d yesterday +%Y%m&d).new.access.log   新的日志文件
 *                  mv $LOGPATH $BAK;
 *                  touch $LOGPATH;
 *                  KILL -USR1 'cat /usr/local/nginx/logs/nginx.pid';
 *                     **  加入crontab
 *
 *               location 匹配模式:
 *                  location = patt {}             精准匹配 优先级最高
 *                  ps:  如果 location = /{
                        index index.html
 *                  }
 *                  则会根据index.html 这个uri进行继续的location匹配，而不是在自身匹配完成
 *
 *                  location ~                     正则匹配
 *                  location ^                     禁止正则匹配
 *                  location patt                  普通匹配
 *                  ps:  两个相同的普通匹配， 哪个匹配的长哪个优先级更高
 *
 *
 *          nginx rewrite 重写:
 *                  写入方位: 可以在server 和 location 段中写
 *                  if 语法格式:
 *                  if 空格 (条件){ 重写模式 }
 *                     重写模式:    '='     来判断相等，用于字符串的比较
 *                                  '~'     用正则来判断，此处的正则区分大小写
 *                                  '~*'    用正则来判断，不区分大小写
 *                                  -f -d -e    判断是否为文件，目录 ，是否存在
 *
 *                  return 语法 : return 403;  返回403信息
 *                  rewrite 语法:  重新转发
 *                  break   语法: 跳出循环
 *                  set    语法: 设置变量
 *
 *              例:    if ($remote_addr = xxx.xxx.xx.xx) { return 403;}
 *              例；   if ($http_user_agent ~ MSIE) { rewrite ^.*$ /ie.html break;}
 *              例:    if (!-e $document_root$fastcgi_script_name) { rewrite ^.*$ /404.html break;}
 *                  观察日志， 日志中显示访问路径依然是 GET /wrong.html HTTP/1.1
 *                       服务器内部的rewrite 和 302 跳转不一样， 跳转的话会改变url 从新发起
 *                       请求，而rewrite 的请求没有变化，指示重新找到一个文件
 *
 *
 *             nginx编译php *****************:
 *                  apache 一般是把php当做自己的一个模块来启动的。
 *                  而nginx则是把http请求变量 转发给PHP进程。 即php独立进程。
 *                  这种通信方式叫做fastcgi运行方式
 *
 *
 *             nginx 压缩 gzip:
 *                  原理 :
 *                    1.浏览器通过请求头中的声明，声明可以接受压缩
 *                     Accept-Encoding：gzip,deflate,sdch
 *                    2.服务器回应，把内容用gzip方式压缩，发送给浏览器
 *                    3.浏览器解码  gzip，  接受解码后内容
 *
 *              gzip配置的常用参数:
 *                   上下文 : http , server ,location ,if
 *
 *                    gzip on|off;     是否开启gzip
 *                    gzip_buffers 32 4k|8K    缓冲(压缩缓存在内存中，缓存几块就开始输出?每块多大?)
 *                    gzip_comp_level [1-9]   推荐6 ，级别越高压缩的越小，但是性能消耗越大
 *                    gzip_disable      正则，什么不进行压缩
 *                    gzip_min_length 200    开始压缩的最小字节，再小就不进行压缩了
 *                    gzip_http_version 1.0|1.1   http协议的版本
 *                    gzip_proxied             设置请求代理服务器如何缓存
 *                    gzip_types text/plain    对哪些类型的文件进行压缩
 *                    gzip_vary on|off         是否开启gzip压缩标志
 *              ps:图片和mp3这种的没有必要压缩， 因为压缩比比较小，而且还会耗费cpu资源
 *                  /nginx/conf/mime.types     显示所有的类型
 *
 *              如果压缩了:响应头会显示 Content-Type：text/html;  text/html 默认会进行压缩
 *
 *
 *           nginx exprie：
 *               上下文: 在location里面或这if段里面写
 *                       expires 30s;
 *                       expries 20m;
 *                       expries 20h;
 *                       expries 20d;
 *
 *              ps：如果没有开启expires，并且文件没有改变，会返回304modifed.
 *                  但是还是会请求服务器。  原理是：响应头会显示etag(内容的签名，内容变了则变)
 *                  和last_modified_since 2个标签值
 *                  浏览器下次请求时，头信息要发送这两个标签，如果文件没有发送变化，则直接返回304头信息
 *                  并且不反回内容
 *
 *                  如果开启了expires，响应头会有expires信息。
 *
 *              ps: php编译成apache模块  --with-apxs2=/usr/local/httpd/bin/apxs
 *                  php编译成nginx模块 --enable-fpm
 *
 *
 *            proxy 反向代理：
 *                  location ~ \.php$ {
                        proxy_pass http://xxx.xxx.xxx.xx:8080
 *
 *                  }
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