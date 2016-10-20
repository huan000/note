<?php
/**
 *  $_SERVER的详解
 */


/*
$_SERVER['PHP_SELF'] 函数用法 #当前正在执行脚本的文件名，与 document root相关。

$_SERVER['argv'] 函数用法 #传递给该脚本的参数。

$_SERVER['argc'] 函数用法 #包含传递给程序的命令行参数的个数（如果运行在命令行模式）。

$_SERVER['GATEWAY_INTERFACE'] 函数用法 #服务器使用的 CGI 规范的版本。例如，“CGI/1.1”。

$_SERVER['SERVER_NAME'] 函数用法 #当前运行脚本所在服务器主机的名称。

$_SERVER['SERVER_SOFTWARE'] 函数用法 #服务器标识的字串，在响应请求时的头部中给出。

$_SERVER['SERVER_PROTOCOL'] 函数用法 #请求页面时通信协议的名称和版本。例如，“HTTP/1.0”。

$_SERVER['REQUEST_METHOD'] 函数用法 #访问页面时的请求方法。例如：“GET”、“HEAD”，“POST”，“PUT”。

$_SERVER['QUERY_STRING'] 函数用法 #查询(query)的字符串。

$_SERVER['DOCUMENT_ROOT'] 函数用法 #当前运行脚本所在的文档根目录。在服务器配置文件中定义。

$_SERVER['HTTP_ACCEPT'] 函数用法 #当前请求的 Accept: 头部的内容。

$_SERVER['HTTP_ACCEPT_CHARSET'] 函数用法 #当前请求的 Accept-Charset: 头部的内容。例如：“iso-8859-1,*,utf-8”。

$_SERVER['HTTP_ACCEPT_ENCODING'] 函数用法 #当前请求的 Accept-Encoding: 头部的内容。例如：“gzip”。

$_SERVER['HTTP_ACCEPT_LANGUAGE'] 函数用法#当前请求的 Accept-Language: 头部的内容。例如：“en”。

$_SERVER['HTTP_CONNECTION'] 函数用法#当前请求的 Connection: 头部的内容。例如：“Keep-Alive”。

$_SERVER['HTTP_HOST'] 函数用法 #当前请求的 Host: 头部的内容。

$_SERVER['HTTP_REFERER'] 函数用法 #链接到当前页面的前一页面的 URL 地址。

$_SERVER['HTTP_USER_AGENT'] 函数用法 #当前请求的 User_Agent: 头部的内容。

$_SERVER['REMOTE_ADDR'] 函数用法 #正在浏览当前页面用户的 IP 地址。

$_SERVER['REMOTE_HOST'] 函数用法 #正在浏览当前页面用户的主机名。

$_SERVER['REMOTE_PORT'] 函数用法 #用户连接到服务器时所使用的端口。

$_SERVER['SCRIPT_FILENAME'] 函数用法 #当前执行脚本的绝对路径名。

$_SERVER['SERVER_ADMIN'] 函数用法 #管理员信息。

$_SERVER['SERVER_PORT'] 函数用法 #服务器所使用的端口。

$_SERVER['SERVER_SIGNATURE'] 函数用法 #包含服务器版本和虚拟主机名的字符串。

$_SERVER['PATH_TRANSLATED'] 函数用法 #当前脚本所在文件系统（不是文档根目录）的基本路径。

$_SERVER['SCRIPT_NAME'] 函数用法 #包含当前脚本的路径。这在页面需要指向自己时非常有用。

$_SERVER['REQUEST_URI'] 函数用法 #访问此页面所需的 URI。例如，“/index.html”。

$_SERVER['PHP_AUTH_USER'] 函数用法 #当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是用户输入的用户名。

$_SERVER['PHP_AUTH_PW'] 函数用法 #当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是用户输入的密码。

$_SERVER['AUTH_TYPE'] 函数用法 #当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是认证的类型。

$_SERVER['PHP_SELF'] 函数用法 #当前正在执行脚本的文件名，与 document root相关。*/