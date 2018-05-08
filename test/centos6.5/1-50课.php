<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2017/6/18
 * Time: 12:10
 */

/**
 *  1-50 课
 *    27：
 *    bios芯片作用：
 *       负责主板通电后各部件自检，设置，保存，一切正常后才能启动操作系统 。
 *
 *    30：
 *    企业内部常用的服务器品牌 ： dell ， hp ，ibm
 *    1u = 4.45cm
 *    1u R420/430   2u r720/r730
 *
 *    31：
 *    程序： 代码文件，静态的，放在磁盘里的数据
 *    进程： 正在运行着的程序，进程运行就是系统把程序放在内存中运行
 *    守护进程： 持续保持运行着的程序
 *
 *    32：
 *    在一些做大并发项目的时候 ，比如微博 ，sns ，秒杀
 *    通常会把数据放入内存中，储存一定量之后，统一写入硬盘中
 *    为了防止断电，会在主板上安装蓄电池，断电的时候把数据写入
 *
 *    写入数据到内存里这个数据空间叫做缓冲区   buffer
 *    从内存中读取数据，这个存数据的内存空间成为 缓存区  cache
 *
 *    34-35 raid磁盘阵列：
 *    raid0 ：
 *         raid0 支持多块盘的操作  1-n 块盘的操作
 *         三块10g的硬盘组成一个30g的硬盘  容量没有损失
 *         有点：  读写数据很快 超过单块盘的速度
 *         缺点：  没有数据冗余 ，如果一块盘坏了  ，整个数据都会丢失
 *
 *    raid1：
 *         raid1 只能支持两块盘
 *         两块盘的大小可以不一样，组成raid1 之后容量会跟小的盘的大小一样
 *         两块10g的硬盘组成raid1 之后，大小还是10g。 另外一块盘做备份完整复制
 *         raid1 支持100% 冗余 ， 如果坏了一个  数据不丢失
 *         有点： 支持全部备份
 *         缺点： 速度慢，浪费空间
 *
 *    raid5：
 *         raid5 最少三块盘
 *         三块10g的盘组合成raid5   容量为 10*(n-1)   不管多少快盘组合起来，只会损失一块盘的容量
 *         通过奇偶校验数据， 如果一块盘坏了，会用一块备份盘进行填补
 *         特点： 读写性能一般 介于raid0-raid1之间   读还可以，写不太好，是一个中庸之道的办法
 *
 *    raid10：
 *         最少是4块盘  容量也是二分之一和raid0 一样
 *         先把两块盘做raid0  在把两个raid0的做raid1  可以备份100%的数据
 *          特点：损失二分之一  ，最多可以坏两块盘。读写性能一般，成本高。
 *
 *    类型	读写性能	安全性	磁盘利用率	成本	应用方面
    RAID0	最好（因并行性而提高）	最差（完全无安全保障）	最高（100％）	最低	个人用户
    RAID1	读和单个磁盘无分别，写则要写两边	最高（提供数据的百分之百备份）	差（50％）	最高	适用于存放重要数据，如服务器和数据库存储等领域。
    RAID5	读：RAID 5＝RAID 0（相近似的数据读取速度）

    写：RAID 5<对单个磁盘进行写入操作（多了一个奇偶校验信息写入）
    RAID 5<RAID 1	RAID 5>RAID 1	RAID 5<RAID 1	是一种存储性能、数据安全和存储成本兼顾的存储解决方案。
    RAID10	读：RAID10＝RAID0

    写：RAID10＝RAID1
    RAID10＝RAID1	RAID10＝RAID1（50％）	RAID10＝RAID1	集合了RAID0，RAID1的优点，但是空间上由于使用镜像，而不是类似RAID5的“奇偶校验信息”，磁盘利用率一样是50％
 *
 *   应用举例：
 *     单台服务器：很重要，数据不多，一般选择raid1. 特别是系统盘一般选择raid1
 *     如果数据量大一些 ，会选择raid10， 类似于raid1 只不过成本大
 *
 *     一般企业数据库主库一般会选择raid10 ， 从库一般选择raid5(为了保存一致一般也会选择raid10)
 *
 *   http://blog.chinaunix.net/uid-639516-id-2692517.html
 *
 *
 *    北桥芯片控制cpu内存，南桥芯片控制i/o总线之间的通信。如pci总线，usb线，lan线等等
 *
 *      
 *    45：
 *    gnu： gnu是一组组件，有gcc编译工具，bash命令解释程序，gawk等等
 *          linux 内核是基于gnu通用公共许可的。但是linux内核并不是gnu计划的一部分。
 *    gpl： 中文名为通用公共许可协议，开源社区最著名的linux内核就是在gpl
 *          gpl许可的核心，是保证任何人有共享和修改自由软件的自由。
 *
 *
 *    54课：
 *          使用桥接网络，网络相当与一台真实的物理机，根宿主机的ip不一样，会和宿主机抢ip
 *          使用nat模式： 使用宿主机的ip进行链接网络
 *
 *
 *
 *   60课：
 *          mkdir 创建目录
 *          cd /；mkdir；             将两行命令在一行显示
 *          ls -ld                    只查看目录
 *          touch                     创建文件  如果文件不存在则创建，如果存在更改文件的时间戳
 *
 *   61课：
 *          echo '';                  吃什么吐什么
 *          echo 123 > test.txt       覆盖写入    叫做重定向
 *          echo 123 >> test.txt       追加写入
 *
 *          cat > test.txt
 *          写入内容
 *          ctrl+c                      退出
 *
 *          cat >> test.txt << eof      进行多行追加
 *            123213
 *          eof
 *
 *
 *   62课
 *    > 或者 1>   输出重定向  把前面的内容输出到文件中
 *    >> 或者 1>>   追加输出重定向
 *    0< 或者 <   输入重定向，输入重定向用于改变命令的输入，后面指定输入内容，前面跟文件名
 *    0<< 或者 0<<   追加输入重定向
 *    2>          错误从定向：把错误信息输出到后面的文件中，会删除文件原来的内容
 *    2>>         错误追加从定向
 *
 *    数字说明：
 *    stdin 代码为0   标准输入
 *    stdout   代码为1   标准输出
 *    stderr   代码为2   错误输出
 *
 *    例子：
 *    echo 123 > 1.txt 2>&1          让2的错误输出跟1一样
 *    echo 123 &> 1.txt              同上  把正确的和错误的都放到a里
 *
 *   64课：
 *    使用find的方式删除文件
 *  1.  find /data -type f -name "oldboy.text" -exec rm {} \;
 *    {}    表示前面查找到的结果   \;  转义分号
 *    ps: 等于前面的内容都在括号里
 * 
 *
 *  2.  find /data -type f -name "*.txt" |xargs rm -f
 *      通过管道把查到的内容显示在最后
 *      xargs 把查询出来的内容放在一行显示
 *
 *  3. mv `find /data -type f -name "*.txt"` /root
 *     ``  里面的内容叫做源
 *
 *
 *  66课：
 *    grep -v ''              排除某字符串打印出来
 *    grep ''                 只查询出来某字符串
 *
 *    如果文件名相同，如何覆盖还不提示
 *    \cp /mnt/text.txt /root/text/txt       1. 加反斜线
 *    /bin/cp /mnt/text.txt /root/text.txt   2. 写命令的全路径
 *
 *    alias                    查看命令别名
 *    unalias cp               删除一个命令的别名 （临时生效）
 *    alias rm='echo this is alias'               设置一个别名(临时生效)
 *    /etc/profile             放入别名永久生效
 *    ~/.bashrc                使别名临时生效
 *
 *
 *  68课：
 *    seq 序列      seq 1 2 10        //从1-10  间隔是2
 *    sed -n '20,30'p test.txt       // -n  取消默认打印   p打印出来
 *
 *    grep 10 -A num                     //除了显示匹配的一行之外，并显示该行之后的num行
 *    grep 10 -B num                    //除了显示匹配的一行之外，并显示该行之前的num行
 *    grep 10 -C num                    //除了显示匹配的一行之外，并显示该行之前后的num行
 *
 *  69课：
 *    sed     ******   查看学习资料  详解
 *
 *  70课：符号详解
 *    history                 查看历史操作命令
 *    ！336                   执行历史操作336行的内容
 *    cd -                    进入上一次的目录
 *
 *    find命令或者的关系
 *    find /oldboy -type f -name "test.sh" -o -name "leo.sh"    //或者
 *    -a        // and  并且
 *
 *
 *   71课：
 *    ctrl + c                终止命令
 *    ctrl + d                退出ssh
 *    ctrl + shift + c        复制
 *    ctrl + shift + c        粘贴
 *    ctrl + e                到达一行的结尾
 *    ctrl + a                到达一行的开头
 *    ctrl + u                清除前面输入的字符
 *    ctrl + k                清除后面输入的字符
 *    ctrl + r                搜索命令
 *    ctrl + w                清除当前行
 *
 *
 *
 *   76课：分区
 *    一块硬盘可以有主分区，扩展分区，逻辑分区
 *    主分区+拓展分区的数量<=4 个
 *    其中一个主分区可以用一个拓展分区代替，拓展分区最多只能有一个
 *    拓展分区不能直接使用，还需要在上面创建逻辑分区，逻辑分区可以有多个
 *    主分区+拓展分区的编号是1-4  逻辑分区的编号只能从5开始
 *
 *   80课：
 *     pwd详解
 *     pwd $PWD pwd -L       作用是一样的
 *     pwd -P                显示路径是链接文件的源路径  ls -l 也可以查看源路径
 *
 *     cd -L                 就是进入当前路径
 *     cd -P                 进入最终地址
 *
 *     cd -  ==  cd $OLDPWD          环境变量
 *
 *
 *   81课 ：
 *     tree -a               查看隐藏文件
 *     tree -d               只显示目录不显示文件
 *     tree -L               指定显示的层级
 *     tree -f               显示的是绝对路径
 *     tree -i               不显示树枝的横线
 *     tree -F               普通文件后面没有任何东西   目录后面会有斜杠
 *
 *   82课：
 *     stat filename         可以查看文件的访问，修改，改变时间
 *     touch -a filename     改变文件的访问时间   不管访问还是修改改变了  改变时间都会改变
 *     touch -m filename     改变文件的修改时间
 *
 *   92:
 *     互联网上的计算机 都会有一个唯一的32位的地址，
 *     我们访问服务器，就必须通过这个ip地址
 *     局域网里也有ip地址，局域网的ip地址也是唯一的
 *     nat模式，电脑宿主机的ip在局域网中是唯一的，虚拟机就是一个新的虚拟网络 (私有网络)
 *
 *     端口：
 *     访问服务的大门
 *
 *     使用ssh协议访问服务器
 *     ssh (加密协议)  22端口
 *     telnet (不加密)   23端口
 *
 *     ps -ef | grep ssh            //查看ssh服务
 *     netstat -lnutp  | grep ssh         //查看ssh的端口
 *
 *     客户端工具： srt ， putty ，xshell
 *     服务端服务： 进程名ssh， 软件 openssh ， openssl (加密用)
 *
 *
 *     故障排查：
 *
 *     //检查网络
 *     1.两个机器之间是否通畅，看物理网络(网线，网卡，ip)  都是否正确
 *     ifconfig eth0                    查看ip
 *     ping ip                          查看网络通不通
 *
 *     //检查服务
 *     2.客户端输入telnet命令     (如果没有这个命令  windows查找教程打开此功能)
 *     telnet ip 端口             测试这个服务是不是通的
       不同的原因：
 *     1.防火墙阻挡了              /etc/init.d/iptables stop   (关闭防火墙)
 *     2.服务器端没有监听这个端口

 *     linux 的上传和下载：
 *     rz 上传命令    sz 下载命令
 *     安装命令  ：  yum install lrzsz -y
 *
 *     rz：
 *     rz -y    覆盖上传
 *
 *     sz:
 *     需要先配置好下载的路径 (xmodem zmodem)
 *
 *     使用rz sz注意事项
 *     只能上传文件而不能上传目录，如果是目录需要打包后再传  必须是zip
 *     上传的文件可以是电脑里的任意文件，下载是指定目录
 *
 *
 *     用户：
 *     管理用户 root
 *     普通用户
 *     虚拟用户  系统里的傀儡，固定存在，满足linux里面服务进程及程序属主的要求而存在的。
 *               进程和程序都必须属于用户
 *
 *     超级用户切换到普通用户不需要密码
 *     普通用户切换到超级用户需要密码
 *
 *
 *
 *     94课linux 调优：
 *     selinux  是一种安全机制  这种安全机制一般是关闭的  采用其他方式代替
 *     cat /etc/selinux/config                   这个是selinux的配置文件  路径
 *     配置文件中：
 *     SELINUX=enforcing           (默认是开启状态的)
 *     SELINUX=disabled            (彻底关掉)
 *
 *     getenforce                  查看selinux状态
 *     setenforce 0                临时更改 (因为不能重启所以临时更改 一旦重启配置文件已经改完了)
 *
 *     运行级别：
 *     vi /etc/inittab             运行级别的配置文件
 *     runlevel                    查看当前的运行级别
 *     init 5                      切换运行级别  (切换主机)
 *
 *     关机：
 *     shutdown -h now             现在关机
 *     init 0                      关机
 *     shutdown -r                 重启
 *     reboot                      重启
 *
 *     关闭iptables防火墙
 *     /etc/init.d/iptables stop       关闭防火墙
 *     /etc/init.d/iptables status     查看防火墙状态
 *     chkconfig iptables off          永久关闭防火墙
 *
 *     调整linux系统的字符集
 *     cat /etc/sysconfig/i18n         调整字符集的配置文件
 *     LANG="en_US.UTF-8"              默认的英文字符集
 *     LANG="zh_CN.UTF-8"              改成支持中文的模式
 *     echo $LANG                      查看现在的字符集
 *     source /etc/sysconfig/i18n      使配置文件立即生效
 *
 *     设置账号的超时时间
 *     export TMOUT=10                 十秒钟远程链接退出
 *     history -c                      清空历史纪录
 *     history -d 5                    删除指定纪录
 *     export HISTSIZE=5               控制历史纪录的数量
 *     cat ~./bash_history             个人目录的历史纪录
 *     export HISTFILESIZE=5           控制家目录对应文件的记录数字
 *
 *     echo 'export TMOUT=3' >> /etc/profile     追加到此文件后永久生效  (环境变量配置文件)
 *     source /etc/profile             重新加载这个配置文件
 *
 *     cat /etc/issue                  设置登陆时系统信息的配置文件
 *
 *     解决克隆主机无法上网的问题：
 *     vim /etc/sysconfig/network-scripts/ifcfg-eth0        网卡配置文件
 *     1.  删除配置文件中的两行数据
 *         dd    HWADDR
 *         dd    UUID
 *     2.  清空一个文件
 *         > /etc/udev/rules.d/70-presistent-net.rules
 *     3.  重启克隆机器
 *
 *
 */