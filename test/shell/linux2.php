<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/8/6
 * Time: 13:34
 */

/*
 *   查看是否安装了gcc   http://blog.csdn.net/guoxiaojie_415/article/details/50394377
 *                      http://www.cnblogs.com/myjavawork/articles/2004516.html
 *                      http://www.poluoluo.com/server/201406/278541.html
 *         yum -y install gcc  gcc+c
 *         gcc -v
 *
 *   apache源代码编译安装方式:
 *         源代码安装三部曲：
 *              1. 生成编译配置文件  (测试环境生成配置地图)
 *              2. 进行编译
 *              3. 进行安装
 *              4. 修改配置文件
 *              5. 启动服务
 *
 *
 *
 *         1.生成编译配置文件
 *           ./configure --prefix=/usr/local/apache2/       程序安装目录
 *           --sysconfdir=/usr/local/apache2/etc/           配置文件安装目录
 *           --with-included-apr                            支持apr传输
 *           --enable-dav
 *           --enable-ssl                                   支持ssl
 *           --enable-cgi                                   支持cgi
 *           --enable-expires=shared                        支持缓存技术
 *           --enable-deflate=shared
 *           --enable-rewrite                               支持url重写
 *           --with-zlib                                    支持zlib压缩
 *              --with-pcre=/usr/local/pcre
 *              --with-apr=/usr/local/apr
 *              --with-apr-util=/usr/local/apr-util
 *
 *
 *         5.启动服务
 *            apache24/bin/apachectl -k start               启动这个服务
 *
 *         6.重新加载配置文件
 *            pkill -HUB httpd
 *         注：建议公司正在响应的服务器，不要随便重新启动apache，而要让进程重新加载配置文件
 *
 *
 *     apache服务器基础知识：
 *         1.  设置apache服务开机启动
 *                vi etc/rc.d/rc.local
 *                /usr/local/apache24/bin/apachect restart &>/dev/null
 *
 *     apache配置文件：
 *         ServerRoot "/usr/local/apache24"           网站的主目录
 *         ServerName  192.168.1.1：80                网站的ip(可写可不写)
 *         DocumentRoot '/usr/local/apache24/htdocs'  网站文档目录
 *         Listen 80                                  监听的端口
 *         LoadModule php5_module modules/libphp5.so  加载动态模块
 *         User apache                                决定了apache的进程执行者
 *         Group apache
 *
 *         <Directory "/usr/local/apache24/htdocs">
 *            Options Indexes FollowSymLinks
 *            AllowOverride None
 *            Order deny,allow               拒绝所有人，然后允许所有人
 *            Allow from all                 没有拒绝所有人之后允许了所有人
 *         </Directory>
 *            Options None                   如果有首页就打开首页，如果没有首页就报错
 *            Options indexes                没有默认首页可以显示目录列表
 *            FollowSymlinks                 目录中可以显示快捷方式
 *            MultiViews                     多视图，可以不加文件的后缀
 *
 *         DirectoryIndex index.html index.php         显示文章的首页
 *
 *         access_log                        访问者日志
 *         errors_log                        错误日志
 *
 *         解析php脚本：
 *         AddType application/x-httpd-php .php     可以解析php脚本
 *         include etc/extra/httpd-vhosts.conf      加载外部配置文件的脚本
 *         ErrorDocument 404 ""                     默认错误页面的脚本
 *
 *         虚拟目录(访问一个网站根目录之外的目录)：
 *         Alias /mnt "/mnt"                        别人访问mnt其实访问的是根目录的mnt
 *         <Directory "/mnt">
 *
 *
 *         </Directory>
 *
 *         apache虚拟主机：
 *         <VirtualHost 192.168.1.1:80>
 *             DocumentRoot "/web/bbs"
 *             ServerName www.bbs.com
 *             <Directory "/web/bbs">
 *                 Options Indexes
 *                 AllowOverride All
 *                 Order deny,allow
 *                 Allow from all
 *             <Directory>
 *         </VirtualHost>
 *
 *
 *
 *        编译安装php的依赖包：
 *            1. 安装libxml2 依赖包(与xml有关)
 *              ./configure --prefix=/usr/local/libxml2
 *               make && make install
 *
 *            2. 安装libmcrypt 依赖包(与加密有关)
 *              ./configure --prefix=/usr/local/libmcrypt
 *               make && make install
 *               ps: 需要有gcc-c++编译器
 *
 *            3. 安装liblitdl
 *              进入libmcrypt目录   cd进入liblitdl
 *              ./configure --enable-ltdl-install
 *                make && make install
 *
 *            4. 安装zlib 支持网站压缩的
 *              ./configure make && makeinstall
 *              自动安装到usr/local/bin   目录中  方便以后别的程序进行加载
 *
 *            5. 安装libpng
 *              ./configure --prefix=/usr/local/libpng
 *                make && make install
 *
 *            6. 安装jpeg6
 *              mkdir /usr/local/jpeg6
 *              mkdir /usr/local/jpeg6/bin
 *              mkdir /usr/local/jpeg6/lib
 *              mkdir /usr/local/jpeg6/include
 *              mkdir -p /usr/local/jpeg6/man/man1
 *              cd /lamp/jpeg-6b
 *              ./configure --prefix=/usr/local/jpeg6/ --enable-shared --enable-static
 *              make && make install
 *
 *            7. 安装freetype
 *              ./configure --prefix=/usr/local/freetype
 *              make && make install
 *
 *            8. 安装 autoconf
 *              ./configure
 *              make && make install
 *
 *            9. 安装gd2
 *              mkdir /usr/local/gd2
 *              cd /lamp/gd2
 *              vi gd_png.c
 *              #include "/usr/local/libpng/include/png.h"
 *              ./configure --prefix=/usr/local/gd2/ --with-jpeg=/usr/local/jpeg6
 *              --with-freetype=/usr/local/freetype/
 *              --with-png=/usr/local/libpng/
 *
 *          编译安装mysql
 *            安装ncurses:
 *              ./configure --with-shared --with-debug --with-ada --enable-overwrite
 *               make &&  make install
 *
 *
 *
 *            1.useradd mysql               创建一个mysql用户
 *            2.cp /usr/local/mysql/share/mysql/my-medium.cnf
 *              /etc/my.cnf
 *              把mysql的配置文件放在etc目录下    只能这么放置
 *
 *            配置文件：
 *              default-character-set=utf8       客户端字符集
 *              character-set-server=utf8        链接字符集
 *              collation-server=utf8_general_ci 校验字符集
 *              default-storage-engine=innodb    服务器的默认字符集
 *
 *            启动mysql：
 *              用acl权限让mysql用户对/usr/local/mysql 有所有的权限：
 *              Setfacl -m u:mysql:rwx -R /usr/local/mysql
 *              Setfacl -m u:d:mysql:rwx -R /usr/local/mysql
 *
 *              手动安装mysql数据库:
 *              /usr/local/mysql/bin/mysql_install_db --user=mysql
 *
 *              用源代码的方式启动mysql &（&符号的意义是让前面的执行程序在后台执行）
 *              /usr/local/msyql/bin/mysqld_safe --user=mysql &       启动服务端
 *              /usr/local/mysql/bin/mysql                            启动客户端
 *
 *              设置重新启动以后mysql还是生效的
 *              vi /etc/rc.local
 *              /usr/local/mysql/bin/mysqld-safe --user=mysql &
 *
 *              给mysql 的 root用户加上密码kkk
 *              /usr/local/mysql/bin/mysqladmin -uroot password kkk
 *
 *
 *
 *           编译安装php:
 *              编译安装php之前首先确保安装了libtool 和 libtool-ltdl*
 *              yum install libtool*
 *              yum install libtool-ltdl*
 *
 *              编译完成之后：
 *              1.生成php.ini的配置文件
 *              cp /lamp/php-5.2.6/php.ini-dist /usr/local/php/etc/php.ini
 *
 *              2.让apache支持php代码
 *              vi /usr/local/apache2/etc/httpd.conf
 *              AddType application/x-httpd-php .php
 *
 *              3.安装pdo-mysql模块
 *              cd /lamp/PDO_MYSQL-1.0.2/
 *              在当前目录打模块
 *              /usr/local/php/bin/phpize
 *              生成编译文件
 *             ./configure --with-php-config=/usr/local/php/bin/php-config
 *             --with-pdo-mysql=/usr/local/mysql
 *              进行安装
 *              make && make install
 *
 *              4.修改php.ini文件
 *              extension_dir="/usr/local/php/lib/php/extensions/no-debug-non-zts-20060613/"
 *              extension="pdo_mysql.so"
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
 * */