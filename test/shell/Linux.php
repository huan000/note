<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/7/26
 * Time: 22:06
 */

//1.  桥接模式：  虚拟机和本机虚拟的连上一根网线  配置同网段就可以形成通信
//               虚拟机使用的是真实的网卡
//2.  host-only：   使用vmnet1 虚拟网卡 不可以和外界通信只可以和本机通信
//3.  NAT:       使用vmnet8 虚拟网卡


//   更改默认的启动界面(计算机运行级别):
//   vi etc/inittab   关机0   字符界面是3   图形界面是5   重启6

//   曾经执行过的命令历史
//   history     清空历史： history -c


/*
1. linux 常用操作
      ls *                     查看文件
      ls -l                    查看文件详细信息
      pwd                      当前目录
      ctrl+c                   强制中断
      ctrl+u                   清除当前的指令
      clear  || ctrl+l         清空屏幕
      ifconfig                 查看网卡ip地址
      service sendmail stop|start     打开或者关闭sendmail服务
      mount /dev/cdrom /media/cdrom   把硬件cdrom挂载到media文件夹当中
      umount /media/cdrom             取消挂载
      df                              查看挂载
      df -Th                          显示类型并且打印空间成M
      which ls                        查找ls命令在哪
      rpm -qa|grep xx                 查看系统安装的rpm包
      rpm -ql|grep xx                 查看一个文件都装在了哪里
      date "+%Y-%m-%d %H：%M：%s"     打印出本地的时间
      date "+%w"                      这是星期几  
      date -s "2014/1/2"              修改本地时间
      hostname                        查看主机名
      vi etc/sysconfig/network        修改主机名（永久修改）
      vi etc/fstab                    查看文件系统表
      who                             查看同时在线的用户
      who | wc -l                     查看一共有几个数据
      |grep boot                      把文件中含有boot的一行拿出来
      wget  url                       远程下载文件
      clock -w                        把date修改的时间卸载bios中



*/

/*
2. linux 根目录下面的目录
      /root                     root用户的家目录
      /home                     普通用户的家目录
      /dev                      硬件设备存在的地方
      /media                    空文件夹可以做光盘挂载使用
      /mnt                      空目录，仅供测试使用
      /boot                     启动文件  内核
      /var                      日志文件
      /tmp                      临时文件夹
      /bin                      所有用户都可以执行的程序
      /sbin                     root用户可以执行的程序
      /etc                      放配置文件
      /usr                      不是系统默认的可执行程序


3.   文件管理
      touch 1.txt               创建文件
      rm  1.txt                 删除文件
      rm -rf  *                 强制删除文件
      vi  1.txt                 修改文件
      cat 1.txt|more            查看文件
      head  1.txt               查看一个文件的前10行
      tail-3  1.txt               查看一个文件的后10行
      cp 1.txt /media             复制一个文件到指定目录
      mv 1.txt /media             剪切一个文件到指定目录
      mv 1.txt 2.txt              文件改名(移动到相同的目录下就是改名字)
      find / -name http.conf      在/目录下查找一个文件
      located http.conf           会建立一个索引数据库  查询速度非常快
                                   ps:前提先执行updatedb
      cat /etc/passwd |grep xx     查询文件中的内容

      chkconfig --level 3 httpd on      设置一个应用程序在某个级别下是否启动（源代码不再rc.d）



4.    目录管理
      mkdir                       创建一个文件夹
      mkdir -p 1/b/3/             递归的创建一个目录
      rmdir                       删除一个非空的文件夹
      rm -rf                      删除一切
      mv dir1 dir2                重命名文件夹  剪切操作


5.    用户管理 ******************
      useradd username            添加一个用户
      passwd  userpass            给用户设置一个密码
      userdel -r username         删除一个用户(-r把于用户有关的全部删除)
      id username                 查看用户的信息 和 用户的组信息
      cat /etc/passwd username    查看用户的信息

6.    压缩包的使用
      gz压缩包
      tar czf  file.tar.gz        制作一个压缩包
      tar tf file                 查看一个压缩包都有多少问价
      tar xzf file.tar.gz -C /mnt     解压到指定的文件夹

      bz2压缩包
      tar -cjf file.tar.bz2 *.jpg      压缩有所得图片到bz2
      tar -xjz file.tar.bz2

      zip压缩包
      zip file.zip file            制作一个压缩包
      unzip -l file.zip           查看一个压缩包
      unzip file                  解压一个压缩包


7.    网络设置
      ifconfig eth0 ip             临时改变一个ip
      vi /etc/sysconfig/network-scripts/ifcfg-eth0      永久设置网络信息
      service network restart                           模拟启动后的生效


8.    防火墙设置
      1.iptables  (网络级别的防火墙)
        iptalbes -L                 查看防火墙
        iptalbes -F                 临时清空防火墙
        service iptables save       保存防火墙设置(永久)
        /etc/sysconfig/iptables     防火墙策略表

      2.selinux  (文件级别的第二级防火墙)
        sestatus                    查看防火墙
        vi /etc/selinux/config      关闭防火墙 (需要重启机器)
        SELINUX=disabled



*/

/*
     Linux系统启动流程
       1. bios找到磁盘上的mbr主引导扇区
       2. 进入grub界面选择相应的启动内核
       3. 读取kernel内核文件 -/boot/vmlinuz-*
       4. 读取init镜像文件 -/boot/initrd-*
       5. init去读取inittab
       6. 读取启动级别 (id:3:initdefault)
       7. 读取/etc/rc.d/rc.sysinit，完成时钟设置，主机名的设置，分区表的挂载(/etc/fstab)
       8. 读取/etc/rc.d/rc 脚本，通过该脚本吸收3级别，然后
          启动/etc/rc.d/rc3.d所有以s开头的服务，不启动该目录下以k开头的服务
       9. 进入登陆界面


       第十一课：
        rpm单个软件安装：
             rpm -ivh xxx                       安装一个软件
             rpm -Uvh xxx                       升级一个软件
             rpm -e xxx --nodeps                卸载一个软件
             rpm -qpi xxx                       查看一个软件的详细信息
             rpm -qf xxx                        查看某个文件是属于哪个rpm包的
             rpm -qpl xxx                       查询一个rpm包会向文件里写入哪个文件
             rpm -qa |grep -i mysql             查看mysql是否安装

         yum安装方式(自动解决依赖性)
        yum解决依赖安装软件：
             yum list                           查看资源库中可以安装或者可以更新的包
             yum l.list httpd*                    查看资源库中以httpd开头的软件
             yum list updates                   列出资源库中所有可以更新的软件
             yum list installed                 列出所有安装的rpm包
             yum list extras                    列出已经安装的但是不再资源库中的rpm包

             yum info                           列出资源库中所有可以安装或者更新的包信息
             ******                             同上吧list变为info

             yum search perl                    在包名称，包描述中搜索
             yum provides realplay              搜索包中指定的特定文件的包

             yum -y install xx                  安装包
             yum remove xxx                     卸载包

             yum check-update                   检查所有可以更新的rpm包
             yum update                         更新所有的rpm包
             yum update xxx xxx                 更新指定的rpm包




              1.准备yum仓库   也叫yum源
                    进行光盘的挂载
                     1.mount  /dev/cdrom /media      将光盘挂载到media目录下
                     2.df -Th                        查看光盘是否挂载成功
                     3.vi /etc/fstab
                       /dev/cdrom  /media iso9660 defaults  0 0       开机的时候自动挂载

              2.修改yum的配置文件 (找到yum仓库)
                     /etc/yum.repos.d/               找到yum的配置文件
                     cat CentOS-Media.repo           修改光盘源的配置文件

                     配置文件：
                        baseurl=file：///media
                        gpgcheck=0                   不要不对官方签名
                        enabled=1                    开启这个仓库

                     查看yum仓库
                        yum list
              3.yum安装
                      yum -y install  ***            默认全部回复y的房子是



         用户与权限：

           chmod：
              所有人群  a=u+g+o
              目录的 rwx    r:查看文件    w：写入和删除文件   x:进入目录
              文件的 rwx    r:查看内容    w: 写入内容        x:执行

              把一个用户加入到xx组
               gpasswd -a yujie root
              把一个用户从xx组删除
               gpasswd -d yujie root

              锁定一个用户
               usermod -L user
              解锁一个用户
               usermod -U user

           sodo：
              设置sudo权限
              vi etc/soduers               设置sodu权限   但是不建议使用
              visudo                       用这条命令开启权限配置文件

              设置权限
              huan localhost=/usr/sbin/useradd

              使用权限
              sudo /usr/sbin/useradd


            切换用户：
              su root                      切换到root用户  但是不改变环境变量
              su - root                    切换到root用户  改变环境变量


            ACL权限分配：
              1.添加权限
               setfacl -m u：huan：rwx /mnt/rootdir
               setfacl -m d:u:huan:rwx /mnt/rootdir      设定默认的继承权限
                递归设置
               setfacl -m u：huan:rwx -R rootdir
              2.删除权限
               setfacl -x u:yujie rootdir
               setfacl -b rootdir                 (把该文件夹上所有的权限都擦除掉)
              3.查看权限
               getfacl rootdir

            光盘挂载：
               mount /dev/cdrom /media         挂载光盘
               umount /media                   卸载挂载
               mount -a                        测试光盘的自动挂载


            服务进程：
               ps -ef                          查看所有的进程
                进程执行者   进行id  进程父id
               ps -e  |grep httpd              查看所有进程的进程号
               ps -ef |grep httpd              查看指定进程
               pstree |grep httpd              查看进程树
               pstree -p |grep httpd           展开进程树查看进程


               netstat -tunpl                  查看端口和进程
               netstat -ant                    查看端口

               pkill httpd                     结束进程

               top                             实时的跟踪计算机中的程序

               uptime                          查看系统简要信息（平均负载）
               last                            查看服务器最后的重要操作

               who                             查看现在登陆的用户


            cronttab  任务计划
               cronttab -e                     执行计划
               cronttab -l                     查看任务计划
               cronttab -r                     删除任务计划

               分  时  日  月  周  /sbin/init 0       执行任务计划
               在 分钟后/5                            每隔五分钟执行一次
               1 1 * * 1-5                            周一到周五的一点一分
               1 1 * * 1，3，4                        每周1 ，3  ，4  执行

             






           








*/




