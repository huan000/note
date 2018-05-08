<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2017/6/24
 * Time: 19:43
 */


/**
 *  重要的子目录
 *   /etc
 *     网卡配置文件：
 *     /etc/sysconfig/network-scripts/ifcfg-eth0             网卡配置文件
 *     /etc/init.d/network restart                           重启所有网卡
 *     ifdown eth0 &&  ifup eth0                             重启个别网卡
 *     setup                                                 图形化设置网卡
 *     route -n                                              查看网关
 *
 *
 *     配置项目：
 *     DEVICE=eth0               物理设备名称
 *     HWADDR=...                网卡的mac地址
 *     TYPE=Ethernet             类型是以太网卡
 *     UUID=....                 网卡的唯一标识
 *     ONBOOT=yes                开机是否自动启动
 *     BOOTPROTO=none            none 引导时不适用协议 || static 使用静态ip || bootp 使用这种协议 || dhcp  使用此协议
 *     IPADDR=127.0.0.1          设置ip地址
 *     NETMASK=255.255.255.0     设置子网掩码
 *     DNS2=202.22.22.22         dns地址  就是域名和ip的解析工具
 *     GETWAY=10.10.10           网关
 *
 *
 *     本地dns配置文件
 *     /etc/resolv.conf          本地dns配置文件
 *     网卡中配置的dns 会优先于 resolv.conf    如果重启网络服务，则会覆盖掉resolv.conf
 *
 *     hosts 配置文件
 *     /etc/hosts
 *
 *     配置主机名的目录
 *     /etc/sysconfig/network
 *
 *     开机自动挂载的文件系统
 *     /etc/fstab
 *
 *     开机自启动软件
 *     /etc/rc.local
 *     ps:用于存放开机自启动程序命令的文件（chkconfig常用来管理yum/rpm安装的程序的开机自启动）
 *        自己开发的程序一般把启动命令放入rc.local 实现开机自启动
 *
 *     开机执行运行级别
 *     /etc/inittab
 *
 *     通过yum或rpm工具安装的软件的默认启动程序目录
 *     /etc/init.d  =>  /etc/rc.d/init.d          类似于防火墙，ssh等等
 *
 *     系统全局环境变量
 *     /etc/profile
 *
 *     用户登陆的时候可以加载一些程序和脚本
 *     /etc/profile.d
 *
 *     登陆时候的提示
 *     /etc/issue
 *
 *     登陆后的提示
 *     /etc/motd
 *
 *     显示版本的配置文件
 *     /etc/redhat-release
 *
 *     设定用户的组名和相关信息
 *     /etc/group
 *
 *     账号信息文件
 *     /etc/passwd
 *
 *     账号密码文件
 *     /etc/shadow
 *
 *     组密码文件
 *     /etc/gshadow
 *
 *     可以执行sudu命令的配置文件
 *     /etc/sudoers
 *
 *     设定哪些终端可以登陆root
 *     /etc/securetty
 *
 *     日志配置文件
 *     /etc/syslog.conf       日志设置文件   centos 5.x
 *     /etc/syslog.conf       日志设置文件   centos 6.x
 *
 *
 *     /usr  目录
 *        /usr/local                这个目录一般存放用户源代码安装的软件
 *        /usr/src                  这个目录存放用户的源码包
 *        /usr/local/bin            用户安装的程序和/usr/local目录下应用的符号链接
 *
 *
 *
 *     /var   目录
 *        /var/log                  系统日志的存放地址
 *        /var/log/messages         系统信息的默认日志文件。
 *        /var/log/secure           纪录登入系统存取信息的文件
 *        /var/spool                定时任务的路径
 *        /var/spool/cron/root
 *        /var/spool/mail           系统用户邮件存放目录
 *        /var/spool/clientmqueue   sendmail临时邮件文件目录  centos 5
 *
 *
 *    /proc
 *        /proc/version             内核版本
 *        /proc/sys/kernel          系统内核功能
 *        /proc/mounts              系统挂载的信息
 *        /proc/loadavg             系统挂载的平均值
 *        /proc/ioports             正在使用的io端口
 *        /proc/devices             当前内核运行配置的所有设备清单
 *
 *
 *
 *    考试题：
 *        linux命令行下使用反斜杠“\”调用别名的原命令
 *        xargs -n 1
 *        /etc/profile     /etc/bashrc    ~。/bashrc
 *
 *        如何查找目录
 *        find -maxdepth 1 -type d
 *        ls -F | grep (*\/)       过滤目录带斜线的
 *        ls -lrt                  r代表倒叙  t代表按照修改时间排序
 *        ls -a                    显示隐藏文件
 *        ls -lh  || ll-h          查看文件大小
 *        ll -d                    显示目录时候必须加d
 *        ll -i                    显示文件的inode号
 *
 *        复制文件或者目录
 *        cp -a                    复制文件保持文件属性不变(  a=pdr r代表可以复制目录)
 *        cp -r                    如果源文件是一个目录 则递归的复制目录
 *        cp -f                    覆盖已经存在的目标文件而不给出提示。
 *        cp -i                    与-f正好相反， 覆盖的时候给出提示
 *          
 *
 *
 *
 *        查看这个是目录还是文件
 *        file  dir
 *
 *        从标准输入获取数据并将数据换成命令行参数
 *        标准输入的来历 ：  管道或stdin ， 输入重定向
 *        xargs  -n    指定每一行最多的个数
 *        xargs -i {}   配合 {}来使用注入参数
 *
 *        树形打印
 *        tree -Ld 1      -L 显示层数  -d 显示目录
 *
 *        grep --color=auto        加上颜色乐乐
 *
 *        find -atime n           n天之前被access过的档案
 *        find -ctime n           n天之前被change过的档案
 *        find -mtime n           n天之前杯modife过的档案
 *
 *
 *        tail -2                 显示最后两行的数据
 *        tail -f                 动态查看一个文件的最后几行(具有监视一个文件的作用)
 *        tailf   和 tail -f  一样
 *
 *        cat -n                  显示行号
 *        cat -b                  如果是空白行不显示编号
 *        cat -s 或 –squeeze-blank 当遇到有连续两行以上的空白行，就代换为一行的空白行  但是不显示行号
 *        cat > a.txt             从键盘创建一个新的文件
 *        cat a.txt b.txt >c.txt  合并文件
 *
 *        nl  file                显示行号  （空行不记录行号)
 *               -b ：指定行号指定的方式，主要有两种：
 *               -b a ：表示不论是否为空行，也同样列出行号(类似 cat -n)；
 *               -b t ：如果有空行，空的那一行不要列出行号(默认值)；
 *               -n ：列出行号表示的方法，主要有三种：
 *               -n ln ：行号在萤幕的最左方显示；
 *               -n rn ：行号在自己栏位的最右方显示，且不加 0 ；
 *               -n rz ：行号在自己栏位的最右方显示，且加 0 ；
 *
 *        less -N                 显示行号
 *
 *
 *        wc : 如果不输入显示行数，单词数，字节数
 *           -l 显示总行数
 *           -c 统计字节数。
 *           -l 统计行数。
 *           -m 统计字符数。这个标志不能与 -c 标志一起使用。
 *           -w 统计字数。一个字被定义为由空白、跳格或换行字符分隔的字符串。
 *           -L 打印最长行的长度。
 *
 *
 *
 *     设置开机自启动
 *        第一种配置方法： (方法一会覆盖方法二)
 *            可以把要启动的服务命令放在 /etc/rc.local 里面
 *            例子：  vi /etc/rc.local
 *                    /etc/init.d start             加上这一行就可以开机自启动
 *
 *        第二种配置方法：  (控制下次启动)
 *            chkconfig --list                      查看所有程序在不同运行级别的启动开启于否
 *            chkconfig sshd off                    默认关闭 run level 2345  off
 *            chkconfig --level 23  off             关闭23级别下面的chkconfig
 *
 *        chkconfig  原理 ：
 *            /etc/rc.sysinit                       系统初始化运行脚本
 *            /etc/rc.d                             所有运行级别执行的脚本
 *            执行chkconfig 回向  /etc/rc.d/rc3.d    写入指定命令
 *
 *
 *        使自己的脚本可以通过chkconfig来进行管理
 *            1. 首先将启动程序 selfd 放入/etc/rc.d/init.d
 *            2. 编写开头文件
 *               # chkconfig： 35 24 25           35运行级别    24启动位置   关闭位置
 *               # description：  描述
 *            3. chkconfig --add selfd            加载进chkconfig
 *
 *
 *
 *     课126： linux 启动过程
 *        1.   开机bios 自检
 *        2.   mbr引导   0柱面 0磁道 1扇区 前446字节的grub菜单     一共512字节
 *        3.   grub 引导菜单   /etc/grub.conf
 *        4.   加载内核  kernel
 *        5.   启动第一个启动进程   init
 *        6.   读取文件
 *                 /etc/inittab                     启动级别的文件
 *                 /etc/rc.d/sysinit                初始化系统   (设置主机名，fstab自动挂载等等)
 *                 /etc/rc.d/rcx.d                  执行这个运行级别下面的脚本，启动该级别的程序
 *        7.   启动tty                               启动远程链接
 *
 *
 *      课128： 刚开始必须有的程序  (关掉其余没用的应用 开启这几个应用)
 *        sshd              远程链接
 *        rsyslog           日志收集
 *        notwork           网络服务
 *        crond             定时脚本
 *        sysstat           查看性能的服务
 *
 *      chkconfig --list | grep "3:on"               查看3级别上所有运行的服务
 *
 *      grep -E "123|234"  text.txt                  同时过滤两个字符串
 *      egrep   "123|234"  text.txt                  同时过滤两个字符串
 *
 *
 *      课136：文件属性描述
 *      是一个磁盘可以存放数据经历下面的步骤：
 *      分区-》 格式化 -》存放数据
 *      格式化：  创建文件系统 ，一般过程是两个部分，第一部分是生成inode ， 第二部分是生成block
 *      block是用来存放实际数据的，
 *      inode是用来存放这些属性信息的 (也就是ls -l的结果)，还包含和block的关联信息 ，但是
 *      唯独不包括文件名字
 *
 *      根据inode查找一个文件： find . -inum 324123
 *
 *
 *      dumpe2fs /dev/sda1 |grep -i "inode size"            查看grub分区的大小
 *      dumpe2fs /dev/sda1 |grep -i "inode count"  block    查看inode的总大小
 *
 *      df -i        查看inode 分配情况
 *
 *      inode 在全区是唯一的，除非硬链接的情况，硬链接相当与进入一个窗户的两个门
 *
 *      centos 5  inode 是125k      centos6 inode 是256k
 *      一个block  一般是1-4k   通常是4k
 *
 *      如果改变inode的大小 一般不会这么做  在格式化的时候指定
 *
 *
 *
 *
 *      138课：
 *      block 知识小结
 *      1. 一个文件可能占用多个block，但是每读取一次block就会io开销一次
 *      2. 如果要提升io开销，就要一次尽可能的多读取一些数据
 *      3. 一个block只能放一个文件的内容 ，无论文件多小，如果block是4k，存放一个1k的文件剩余3k就浪费了
 *      4. block根据需求灵活设置大小
 *      5. block的大小设置也是格式化的时候设置的
 *      6. 文件名不再inode 里  在上级目录的block里面
 *
 *      mkfs.ext4 -b2014 -i256 /dev/sdb        -b 是block大小  -i是inode大小
 *
 *
 *      139课： 文件类型
 *      file xxx.txt      通过这个命令来查看
 *
 *      d    目录
 *      -    普通文件
 *      l    符号链接文件
 *      b    表示块设备或者其他外围设备  (磁盘或者光驱)
 *      c    表示字符设备文件   (猫或者串口设备)
 *      s    表示socket文件
 *      p    表示管道文件
 *
 *      - 普通文件
 *      1. 纯文本文件        ascII     可以正常cat等读取
 *      2. 二进制文件        binary    比如/bin/ls   文件
 *      3. 数据格式文件      data      不如lastlog   他的文件  /var/log/lastlog  (存放某些命令的信息) 汇报所有用户的登陆情况
 *                                                     /var/log/wtmp (last命令的数据文件)  查看用户登陆信息
 *
 *
 *     142课：
 *        r  4   w  2  x 1
 *        rwx   读写执行
 *
 *     143课：
 *        ln  创建硬链接
 *        ln -s   创建软连接
 *
 *     硬链接知识小节：
 *        1. 文件的inode节点号相同
 *        2. 删除一个文件 。文件实体并未被删除，只删除了文件的链接
 *        3. 只有删除了源文件和所有对应的硬链接文件，文件实体才会被删除
 *        4. 硬链接也是普通文件
 *        5. 对与静态文件 (没有进程调用的文件)  如果硬链接的数量为0  则该文件就被删除了  ls -l 的第三列
 *        6. 不可以对目录进行硬链接
 *        7. 删除链接文件的源文件，对硬链接文件没有影响
 *        8. 硬链接不能跨目录
 *
 *     软连接知识小节：
 *        1. 属于两个文件  inode 不一样
 *        2. 文件的类型不一样 ，一个是- 一个是l
 *        3. 文件的属性也不一样
 *        4. 改变软连接文件的属性实际上更改了源文件
 *        5. 软链接文件包含的路径指向了源文件的inode 和 block
 *        6. 可以对目录进行软连接
 *        8. 删除链接文件的源文件，软连接文件无法指向了
 *        9. 软连接可以跨目录
 *
 *
 *      文件删除的原理：
 *        文件删除的条件：
 *            1. i_link = 0      硬链接文件和源文件都删除
 *            2. i_count = 0     没有服务进程使用该文件
 *
 *        df -h   显示文件大小  会显示已经删除了的但是进程没有释放的文件的空间
 *        du -sh  显示文件大小  不会显示已经删除但是还有程序调用的非静态文件 (显示文件占用的block大小)
 *        ls -lh  显示文件大小  显示文件的实际大小  结果小于  du -sh
 *        lsof  **********
 *
 *      4 工作中需要注意的地方
 *     (1)当出现du和df差距很大的情况时，考虑是否是有删除文件未完成造成的，方法是lsof命令，然后停止相关进程即可。
 *     (2)可以使用清空文件的方式来代替删除文件，方式是:echo > myfile.iso。
 *     (3)对于经常发生删除问题的日志文件，以改名、清空、删除的顺序操作。
 *     (4)除了rm外，有些命令会间接的删除文件，如gzip命令完成后会删除原来的文件，为了避免删除问题，压缩前先确认没有进程打开该文件。
 *
 *       磁盘满了的提示
 *       no space left on device      代表磁盘满了后者inode满了
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