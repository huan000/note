<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/8/2
 * Time: 17:26
 */

/*
 *    第十七课：
 *         文件中内容的查找
 *           grep 'linux' ./file             包含linux的行
 *           grep -c 'linux' ./file          到底有几行包含
 *           grep -n 'linux' ./file          打印出行号
 *           grep -i 'linux' ./file          忽略大小写
 *           grep -v 'linux' ./file          不包含linux的行
 *           grep -E                         支持正则
 *
 *         正则表达式的使用
 *           1. ^lin                以lin开头的
 *           2. php$                以php结尾的
 *           3.   .                 匹配任意单个字符
 *           4.   *                 匹配任意多个字符
 *           5. linux | php         包含linux和php的行
 *           6.   +                 匹配一个或者多个字符
 *           7    ^$                没有任何字符的
 *           8.  [0-9]              0-9中的一个字符
 *           9.  (linux)+           出现多次linux
 *          10.  (web){2,4}         出现两次web
 *          11.  \                  转义一个特殊字符使用
 *          12.  [^210]             除了210   箭头写在中口号中的时候
 *
 *
 *
 *     第十八课：
 *          awk -F：'{print $1}'                以冒号作为分割
 *          NR                                  代表行数，是一个常量
 *          NF                                  代表列数，是一个常量
 *          cat file|awk '$1~/192.168.100.1/{print $0}' | wc -l     匹配和不匹配
 *
 *     第二十课：
 *          sed行定位的使用：
 *           nl ./file
 *           cat file |sed -n '5'p              打印出第五行的数据
 *           cat file |sed '5'd                 除了第五行的数据全都打印出来(不会删除原文件)
 *           cat file |sed -n '/aaa/'p          打印出有aaa的行
 *
 *          uniq行定位的使用
 *           uniq -c file                       打印出紧挨着的重复行，并且显示重复的次数
 *           uniq -d file                       把连续出现一次以上的行打印出来
 *
 *          sort排序
 *           sort file                          把文件按字母升序排列
 *           sort -r file                       把文件按字母倒叙进行排列
 *           sort -t: -k1 -r                    根据：进行分割  根据第一列  进行倒叙排序
 *
 *          split行分割
 *           split -5 file spt                  以五行作为一个分割 分割后存于spta sptb
 *
 *
 *         第二十一课：
 *           linux启动流程和服务脚本
 *               1.bios找到磁盘上的mbr主引导扇区
 *               2.进入grub界面选择相应的启动内核
 *               3.读取kernel内核文件 /boot/vmlinuz
 *
 *               4.读取init的镜像文件启动1号进程 /boot/initrd
 *               5.init去读取/etc/inittab    选择启动进程级别
 *                      加载etc/rc.d/rc.sysinit
 *                      进入欢迎页面
 *                      设置时钟
 *                      设置主机名
 *                      挂载文件系统
 *                      挂载光驱
 *                      进入3级别
 *
 *               6.加载/etc/rc.d/rc
 *                      设置防火墙
 *                      检测硬件变化
 *                      启动网络服务
 *                          读取 /rc3.d
 *                      启动3级别下可以启动的所有进程
 *                      进入登陆界面
 *
 *
 *              设置一个服务的启动运行级别：
 *                 chkconfig --level 3 httpd off
 *                 chkconfig --list httpd               在所有运行级别下面的状态
 *
 *
 *
 *         第二十二课
 *              1.自定义服务脚本：
 *                    脚本制作完成之后 放入rc.local  开机会自动执行
 *                    /etc/rc.local =>  /etc/rc.d/rc.local
 *
 *              2.把自定义服务脚本改成标准的rpm脚本
 *                   #chkconfig: 2345 90 20
 *                   #description: test server daemon
 *
 *
 *              3.让执行脚本支持chkconfig
 *                   chkconfig on
 *
 *              4.让执行脚本支持service
 *                    cp test /etc/rc.d/init.d
 *                   ： 只要是程序在init.d中的时候  service可以自动执行
 *
 *
 *        第二十五课：
 *              shell编写字符菜单管理
 *             准备知识：
 *                 1.函数的定义
 *                      function name(){}
 *                 2.函数的调用
 *                      name
 *                 3.cat命令的详细使用
 *                      cat << eof
 *                         sadlkfj
 *                      eof
 *                 4.shell脚本的引用
 *                      . file
 *                 5.接受菜单中的文字
 *                      read -p "please input："name
 *                      echo $name
 *
 *                 6.写一个死循环接受用户的输入
 *                      while ture
 *                      do
 *                         read -p 'please input:'name
 *                        case $name in
 *                          1)
 *                             echo
 *                               ;;
 *                          2)
 *                             echo
 *                               ;;
 *                          3)
 *                             echo
 *                               ;;
 *                          *)
 *                             break
 *                               ;;
 *                          esac
 *                      done
 *
 *
 *           第二十七课：邮件服务测试
 *               1.邮件服务器准备
 *
 *
 *
 *               2.编写web服务器脚本
 *
 *
 *
 *
 *               3.编写mysql数据库监控脚本
 *
 *
 *               4.编写disk空间使用脚本
 *
 *
 *
 *            安装发送邮件服务器
 *               1. 安装postfix 25  发送邮件      dovecot  110  发送邮件
 *                   删除系统中自带的发送邮件服务器
 *                    rpm -qa |grep sendmail
 *                    rpm -e sendmail --nodeps
 *               2. 配置postfix主机名
 *                    1) 修改邮件服务器的主机名
 *                         vi etc/postfix/main.cf     进入配置文件
 *                         myhostname =  xxx.xxx      邮件服务器的主机名
 *
 *                    2)   mydomain = lampym.com      邮件的域名后缀
 *
 *                    3)   myorigin = $myhostname     发件人的域名
 *                         myorigin = $mydomain
 *
 *                    4)   inet_interfaces = all      监听所有的网卡
 *
 *                    5)   mydestination = $myhostname,$mydomain     收件人的后缀
 *
 *                    6)   mynetworks = 192.168.1.0/24     设置邮件服务器的网段 /24代表255.255.255.0
 *
 *                    7)   relay_domains = $mydestination    转发的域名
 *
 *                   启动服务：
 *                      service postfix start
 *                      pstree |grep master        
 *
 *            安装接受邮件的服务器：
 *                   修改配置文件：
 *                      修改支持pop3和pop3s协议
 *                      protocols = imap imaps pop3 pop3s
 *                      支持所有的端口
 *                      imap_listen =  *
 *                      pop3_listen = *
 *
 *                   开启服务：
 *                      service dovecot start
 *
 *
 *
 *            nc探测端口：
 *                   nc -l 192.168.1.1 100000       添加端口
 *                   nc  192.168.1.1 100000         删除端口
 *                   nc -w 3 192.168.1.1 10000      链接指定端口3秒
 *
 *
 *            脚本临时文件的生成和使用：
 *                   实例： 以进程号作为标志的临时文件
 *                 1.获取所有httpd应用程序的进程号
 *                 2.把进程号存入一个临时文件中
 *                 3.从临时文件中取出所有的apache的进程号
 *                 4.使用for循环用kill杀掉所有的进程
 *                 5.删除之前生成的临时文件
 *                 6.输出关闭进程后的消息
 *
 *                 #！/bin/bash
 *                 #createtmp.sh
 *                 tmpfile = $$.txt                  创建一个临时文件
 *                 ps -e|grep httpd|awk '{print $1}' >> $tmpfile       把所有的进程id放入临时文件中
 *
 *                 for pid in `cat $tmpfile`
 *                 do
 *                    echo "apache ${pid} is killed!!!"
 *                 done
 *                 rm -rf $tmpfile
 *                 echo "apache已经成功关闭了!!!"
 *
 *             脚本信号捕捉技术************：
 *                 kill -1    |   kill -HUB  进程号            挂起一个进程
 *                 kill -9                                     无条件杀死进程
 *
 *
 *             用shell操作mysql：
 *                 #！/bin/bash
 *                 mysql = "/usr/local/mysql/bin/mysql -uroot -phuan0000"    链接mysql
 *                 sql = "show tables";                                      sql语句
 *                 $mysql -e "$sql"                                          执行sql
 *                 
 *
 *             apache日志分割：
 *                 创建分割备份日志
 *                 cat /usr/local/apache24/log/access.log
 *                 yesterday = `date -d yesterday +%y%m%d`
 *                 srclog = "/usr/local/apache24/log/access.log"
 *                 dstlog = "/usr/local/apache24/logbak/access_${yusterday}.log"
 *                 mv $srclog $dstlog
 *                 pkill -1 httpd
 *
 *                 把分割备份日志的数据整理到临时文件 上传数据库
 *                 tmpfile = $$.txt
 *                 cat $dstlog | awk '{print $1}' | sort | uniq -c |awk '{print $2 ":" $1}' >$tmpfile
 *
 *                 mysql = "usr/local/mysql/bin/mysql -uroot -p"
 *                 for i in `cat $tmpfile`
 *                 do
 *                     ip = `echo $i|awk -F: '{print $1}'`
 *                     num = `echo $i|awk -F: '{print $2}'`
 *                     sql = "insert into test.countab(date,id,num) values('$yesterday','$id','$num')"
 *                     $mysql -e "$sql"
 *
 *                 done
 *
 *                 rm -rf $tmpfile
 *
 * 
 *
 *
 *
 *
 * */