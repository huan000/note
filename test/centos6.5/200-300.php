<?php
/**
 *    crontab 任务计划  ***************************未完待续
 *      系统的任务计划表：
 *        /etc/crontab
 *      用户的任务计划表：
 *        /var/spool/cron
 *      用户允许访问和拒绝的列表
 *        /etc/cron.allow   /etc/cron.deny
 *
 *
 *      特殊符号：
 *      分 时 日 月 周
 *      *               代表每天或者每周
 *      -               17-19 代表一段范围
 *      ，              17，19   代表17点和19点
 *      /10             代表每十分中执行一次
 *
 *
 *      crontab -l         查看当前用户的任务计划
 *      crontab -e         修改当前用户的任务计划
 *      crontab -r         删除当前用户的任务计划
 *      crontab -u -l      查看其他用户的任务计划
 *
 *
 *      //图形化的进行service服务的开启与关闭
 *      ntsysv
 *
 *
 *
 *     用户管理：
 *     /etc/skel 目录  (用户的环境变量目录)
 *     1. 当我们使用useradd 添加一个用户的时候， 在添加的过程当中 相当于  cp /etc/skel  /home
 *        复制这个目录到用户的家目录
 *     2. 如果出现 bash-4.1 切换到出错用户 cp /etc/skel .
 *
 *     /etc/login.defs
 *     1.文件是用来定义创建用户时需要的一些用户配置信息。如创建用户时是否需要家目录，密码有效期等等
 *
 *     /etc/defaults/useradd  (添加用户的时候用户的默认配置信息文件)
 *     GROUP=100   依赖于/etc/login.defs 的USERGROUPS_ENAB参数，如果为no，则由此处控制
 *     HOME=/home  用户的家目录创建在 /home中
 *     INACTIVE=-1  是否启用账号过期停权，-1表示不启用
 *     EXPIRE=      账号终止日期，不设置表示不启用
 *     SHELL=/bin/bash    新用户默认使用的shell类型
 *     SKEL=/etc/skel     配置新用户家目录默认的全局变量文件
 *     CREATE_MAIL_SPOOL=yes    创建用户的mail文件
 *
 *     useradd
 *     -c              新账号的passwd 档的说明栏。  在第五栏
 *     -d              设置homedir(指定家目录)
 *     -e              设置账号何时过期  格式 /MM/DD/YY
 *     -g              指定账号属于的组  (主组)
 *     -G              指定账号属于多个组  (附加组)
 *     -m              创建家目录  (家目录可以不存在)
 *     -M              不建立用户的家目录，优先于/etc/login.defs 文件中的设定
 *     -s              指定用户的shell  如果默认不填写，会根据/etc/default/useradd 预设的值
 *     -u              指定用户的id，id必须唯一，
 *     -f              账户如果不修改密码何时停权，0为立刻停权，-1关闭此功能
 *
 *     usermod (修改用户信息) 和useradd一样
 *     -l              变更用户login时候的login_name
 *     -L              冻结用户密码  实质上就是修改/etc/shadow 在密码处加上！
 *     -U              解除冻结   本质同上
 *     -a              append
 *     -G              修改用户的附加组，和-a 仪器使用的话是追加附加组，而不是替换
 *
 *
 *     groupadd
 *     -g              指定组id
 *
 *     groupdel groupname     删除指定的用户组
 *
 *
 *     gpasswd
 *     gpasswd groupname      为一个用户组设置密码，就是知道该群组密码的人具有暂时可以切换该群组的功能
 *     gpasswd -A username groupname   为一个组设定组管理员
 *     gpasswd -a username groupname   把一个用户添加进一个组中
 *     gpasswd -d username groupname   从一个组中删除一个用户
 *     gpasswd -r groupname            修改一个组的组密码
 *
 *
 *     passwd  (修改当前用户的密码)
 *     passwd username (只有root可以修改别的用户的密码)
 *     echo '123456' | passwd --stdin oldboy
 *     -n 7                       7天以内不能修改密码
 *     -x 60                      60天以后必须修改密码
 *     -w 10                      还剩10天的时候提醒用户需要修改密码了
 *     -i 10                      在密码过期后多少天，用户被禁掉，仅能root操作
 *
 *     修改用户密码属性的
 *     chage -l username    查看用户的过期时间等设置
 *     chage -E "2018/02/02" username   (相当于useradd -E 设置账户的有效期)
 *
 *     userdel 删除用户
 *     -r                   删除用户的家目录
 *
 *
 *      Password expires 的意思
 *           chage 加M 选项有两个作用
 *           一，Last passwrd change + M天数 = Password expires
 *           二，Maximum number of days between password chang=M天数
 *
 *      password inactive  如果expires +  inactive  这个时间用户还是没有修改密码  则账号停用
 *           此时只能联系管理员
 *
 *      http://www.mamicode.com/info-detail-1417735.html
 *
 *
 *      用户查询相关命令：
 *      id     用户组信息  id信息
 *      w      用户登陆信息
 *      who    显示谁登陆了   w命令包含who
 *      last   显示登陆列表    /var/log/wtmp    查这个列表
 *      lastlog      /ver/log/lastlog
 *      groups     查询一个用户在哪个组里
 *
 *
 *
 *      su - huan0000 -c pwd   切换到一个用户执行一个命令再切换回来
 *
 *
 *      sudo 命令
 *      作用： 普通用户想要执行某些命令必须知道root密码 ， 但是通过sudo 可以在不知道
 *      密码的时候可以授权成root用户
 *
 *      sudo 运行流程
 *      运行sudo 命令  -》   检查 /var/db/sudo 下面的时间戳文件 (5分钟起效)  -》
 *      输入密码(针对前面的检测)  =》  检查 /etc/sudoers 配置文件 用户可以执行的命令
 *
 *      visudo 命令 编辑 /etc/sudoers  文件
 *      编辑98行：
 *      huan0000 ALL=(ALL) NOPASSWD:/usr/sbin/useradd
 *      %huan0000  ALL=(ALL) NOPASSWD:/usr/sbin/useradd    对一个用户组进行授权
 *      用户名   可以执行的主机   可以执行的身份     可以执行的命令
 *
 *      编辑13行： 定义主机别名   把几个主机定义在一个别名上
 *      Host_Alias FILESERVERS = fs1, fs2  (注意留3个空格)
 *
 *      编辑20行： 定义用户别名
 *      User_Alias: ADMIN = user1, user2, %group1
 *
 *      Runas_Alias  定义用户身份别名
 *      Runas_Alias some = root
 *
 *      编辑27行： 定义命令别名
 *      Cmnd_Alias some = /sbin/route, /sbin/ifconfig
 *
 *
 *      sudo -l      查看自己拥有哪些权限
 *      sudo -v      查看自己是有可以使用sudo
 *      sudo -u      指定用户的身份
 *      sudo -k      删除时间戳  下回使用命令需要密码
 *
 *
 *      sudo 配置文件注意事项：
 *      ALL              必须都是大写
 *      \                这个是换行的符号
 *      ！/bin           可以是用！进行排除命令
 *
 *      远程sudo命令：
 *      ssh -t hostname sudo       (-t强制远程执行sudo命令)
 *      Defaults requiretty        (注释这行上面可以不用加-t就可以执行)
 *
 *      sudo审计：
 *     1. 安装sudo  和  rsyslog 命令
 *     2. echo "Defaults   logfile=/var/log/sudo.log" >> /etc/sudoers
 *
 *
 *     255 --  263   回头再学
 *
 *     paste 合并文件
 *     chpasswd   用户批量添加用户导入文件
 *
 *
 *
 *     264 -- 295   磁盘管理体系
 *     磁盘的四种接口：
 *       ide： 早期家用磁盘接口，逐渐被淘汰了
 *       scsi：   早期服务器使用接口，逐渐被淘汰了
 *       sata（sas）:    逐渐取代scsi接口的磁盘  通用sas串口   (sas 结合了scsi和sata的有点结合的升级版)
 *       光纤：   高端服务器使用的接口磁盘
 *
 *     磁盘读取数据原理：
 *       先读一个磁道如果没有找到数据在读取同柱面的另一个磁道，如果还没有读取到则更改磁头
 *       位置开始寻道继续读取，写入数据也是同理
 *
 *
 *     分区：
 *        分区信息记录在 0磁头 0磁道 1扇区中， 一共512字节
 *        其中前446字节记录了引导纪录 mbr
 *        剩余64字节纪录了分区表  (16个一组)
 *         一块硬盘只可以分4个主分区(或者拓展分区)
 *         一个主分区或者拓展分区的信息大于16kb
 *
 *        其中拓展分区可以再创建逻辑分区，逻辑分区的分区表和引导分区信息纪录在逻辑分区中。
 *
 *        16字节 分区表
 *        1b   分区状态： 0 未激活    0x80  激活
 *        1b   分区起始磁头号
 *        2b   分区的起始扇区和柱面号
 *        1b   分区类型
 *        1b   分区结束磁头号
 *        2b   分区结束扇区和柱面号
 *        4b   线性寻址方式下分区相对扇区地址
 *        4b   分区大小
 *
 *        分区工具 ：  fdisk，parted 分区工具分区的实质就是改变上述分区表的信息
 *
 *        dd if=/dev/sda  of=mbr.bin bs=512 count=1  (将一个磁盘的512字节做备份)
 *        od -xa mbr.bin        (读取二进制文件)
 *
 *        fdisk 分区工具适合给小于2t的磁盘进行分区，parted可以给大于2t的磁盘进行分区
 *        首选fdisk
 *
 *        1.磁盘分区是按照柱面来划分的 (从磁盘读写原理角度可以理解)
 *        2.拓展分区不能直接使用，还要在拓展分区的基础上创建逻辑分区才可以
 *        3.拓展分区有自己的分区表，因此拓展分区下面的逻辑分区可以有多个
 *        4.一个硬盘只能有一个拓展分区，一个拓展分区可以划分成多个逻辑分区
 *        5.逻辑分区的编号只能从5开始，即使只有一个主分区
 *                              
 *        scsi/sas/sata/usb 设备均以/dev/sd 开头。
 *
 *        fdisk工具的使用：
 *        fdisk -l    查看分区状态
 *
 *        fidsk -cu /dev/sdb                          -c 切换到兼容模式  -u 显示的时候使用扇区(默认是柱面)
 *        n                             添加分区
 *        e / p / l                     添加主分区或者拓展分区或者逻辑分区
 *        +10M                          设定分区大小
 *        p                             查看分区
 *        d                             删除一个分区
 *        w                             保存
 *        q                             退出不保存
 *        l                             查看分区类型
 *        t                             选择分区类型id (可以通过l查看)
 *
 *        partprobe / partx -a          通知内核分区表已经改变
 *        ll /dev/sd*                   查看分区
 *        cat /proc/partitions      查看分区
 *
 *
 *        parted 分区 (针对2t以上的硬盘)
 *        1.   parted /dev/sdb
 *        2.   mklabel gpt                      (将mbr改成gpt)
 *        3.   mkpart primary 0 100             (分100m给一个主分区)
 *        4.   p                                查看分好的分区
 *        5.   mkpart primary linux-swap 11 20 Ignore     (分一个swap分区)
 *        6.   mkpart logical ext4  21 30  Ignore         (不需要拓展分区分逻辑分区)
 *        7.   p                                查看分区
 *        8.   rm 1                             删除第一个分区
 *
 *        创建swap 分区
 *        1. 创建一个普通分区
 *        2. mkswap /dev/sdb1                创建一个swap分区(格式化)
 *        3. free -m                         查看swap分区
 *        4. swapon /dev/sdb1                合并swap分区
 *        5. swapoff /dev/sdb1               关掉其中的swap分区
 *
 *
 *        linux 文件系统：
 *        inode  存放一个文件的属性
 *        block  存放一个文件的数据
 *        superblock(metadate 元数据)   一个磁盘有多少个inode多少分区，多少block ，是superblock记录的。
 *        dumpe2fs /dev/sdb             查看一个分区的元数据
 *
 *        inode 中包含如下信息，
 *        文件的属主和属组。
 *        文件的访问权限。
 *        文件的类型
 *        文件的访问，修改时间等。
 *        文件的大小。
 *        文件的各种标识，如suid ，sgid等
 *        指向文件内容数据块的指针
 *        一个inode大小通常是128字节，ext4文件系统的inode大小是256字节
 *        inode表用于跟踪定位每个文件，包括位置，大小等。但是不包含文件名，一个块组只有一个inode表
 *
 *        什么是块设备：
 *        块设备就是以块 (比如扇区) 为单位收发数据的设备。 他们支持缓冲和随机访问。
 *        块设备包括硬盘，cd-rom等。
 *
 *        什么是字符设备：
 *        字符设备可以进行物理寻址的媒体。 字符设备包括串行端口和磁带设备。只能逐字逐句的读取
 *        这些设备中的数据。
 *
 *        什么是逻辑块：
 *        逻辑块就是我们前面提到的block的概念。
 *        硬盘的最小存储单位是扇区，而数据的最小存储单位是逻辑块
 *
 *
 *        mkfs.ext4 -b 4096 -i 1024 /dev/sdb1        格式化成ext4文件系统
 *        mkfs -t ext4 -b 4096 -i 1024 /dev/sdb1        格式化成ext4文件系统
 *
 *
 *        ext2文件系统：
 *        超级块      块组1          块组2
 *        超级块      （组描述 块位示图    inode位势图   inode区   数据区）  属于快组1
 *
 *
 *        dd                拷贝文件的一部分并指定格式
 *        df -hiT           查看挂载分区的大小和文件系统  （h代表block，i代表inode，t是type）
 *        cat /proc/mounts              查看挂载情况
 *        cat /proc/partitions          查看分区情况
 *        dumpe2fs  /dev/sdb1           查看文件系统的元数据
 *        fsck  -C -f -t ext3 /dev/sdb1      检查磁盘损坏情况 (好的磁盘千万不能使用这个命令)
 *        tune2fs                        修改文件系统信息
 *        megacli                        查看raid信息
 *        ipmitools                      查看硬件系统的信息
 *        resize2fs                      调整文件系统的大小(lvm)
 *
 *        挂载：
 *        mount -t         指定文件系统类型进行挂载
 *        mount /dev/sdb1 /mnt      挂载ext2 和ext3 文件系统
 *        mount -t iso9660 /cdrom /mnt       挂载光盘   (不加-t系统自己测试区挂载)
 *
 *        mkfs -t vfat /dev/fd0            格式化软盘
 *        mount -t fat /dev/fd0 /media/floop    挂载软盘
 *
 *        mount -t vfat -o iocharset=cp950 /dev/sdb1 /tmp/flash   挂载U盘
 *
 *        umount  /dev/sdb1    解除挂载
 *        umount -lF           强制卸载
 *
 *        ps: 解除挂在文件夹占用的问题
 *        fuser                用来显示所有正在使用指定file，file system 或者socket的进程信息
 *                         -u  显示使用该进程的用户
 *                         -v  显示pid等详情信息
 *                         -m  追加程序的流程
 *                         -k  直接杀掉某个程序
 *                         -i  杀掉程序的时候进行提示
 *
 *
 *        结果：
 *        USER        PID ACCESS COMMAND
 *        root       3653 ..c.. (root)bash
 *
 *        ACCESS :  C  此程序在当前目录下
 *                  e  当运行的时候可以执行
 *                  f  打开文件，默认状态下被忽略
 *                  F  打开文件等待被写入
 *                  r  根目录
 *                  m  共享库
 *
 *
 *        开机自动挂载：
 *        vim /etc/fstab
 *        /dev/sdb2   /tmp    ext3    defaults   0(是否备份)    0(是否开机做磁盘检查)
 *
 *        split，paste，sort，wc, dos2unix ,diff       等命令详解
 *
 *        tr命令：
 *        tr 'abc' 'ABC' < ./text           替换单个字符
 *        tr -d 0 < text                    删除文件中所有的0
 *        tr -d -c '0-9' > text             删除所有除了0-9以外的字符
 *
 *        tee命令：
 *        将结果输出到屏幕的同时输入到文件
 *        ls | tee /tmp/test.txt
 *        ls | tee -a /tmp/test.txt             追加写入一个文件之中
 *
 *        
 *
 *
 *
 *
 */




