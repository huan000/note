<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/7/31
 * Time: 21:46
 */



/*
 第九课：
   变量的类型：
      1. 用户自定义变量
      2. 系统变量   不可以修改的变量
         $#  可以打印出参数的个数
         $0  获取当前脚本的脚本名
         $*  打印参数列表
         $?  上一条结果如果成功显示为0

      3. 位置变量   传入参数
          可以接受九个参数的位置变量
          $1 - $9  位置变量接收

    分支匹配语句：
      case $1 in
         start)
            echo 'start....'
         ;;
         stop)
            echo 'stop....'
         ;;
         *)
            echo '....'
         ;;
      esac

     循环语句
       for i in $*;do
          echo $i
          sleep 1
       done

       while [ $num -gt 0 ]
       do
          echo 'yes'
       done


       for((i=0;i<10;i++))
       do
          echo 'yes '
       done

     结束循环：
       break；           结束整个循环
       continue；        结束本次循环



     if判断语句
       if [ $? == 0 ]; then
          echo '上一条命令执行成功'
          elif [] && []；then
          echo '上面的条件'
          else
          echo '上一条命令执行失败'
       fi


     变量的加减乘除：
       1.  expr  $1 + $2
           运算符号：
            + - \* /

       2.  echo $(($1+$2))




     第十课：
     shell中的输入于输出
       echo -n        代码最后不进行换行
       echo -e        代码中可以解析转义字符
       read name      等待键盘输入
       echo $name
       read -p  name  实现代码最后不换行
       echo $name

     shell 中的其他输出命令
       cat /etc/passwd | more     如果看不完就一点一点往后看
       cat /etc/passwd | head     看一个文件的前十行
       cat /etc/passwd | tail     看一个文件的后十行
       cat<<x                     heredoc  字符串输出的一种形式
           sdfsadf
                 sadf
       x
       |tee         输出的同时还可以保存一份
       |nl          打印出来的东西加上行号


     shell中的颜色控制  ********************！！！！！！！！！！！！！！！
       \033[前景色；背景色m
       \033[0m                        恢复到系统默认的颜色

     前景色： 30-37    黑红绿棕蓝紫青白
     背景色： 30-37    黑红绿棕蓝紫青白

     第十一课：
        条件测试操作：
          1. 测试文件状态
              [ 操作符 文件或目录 ]
           常用的测试操作符：
              -d：  测试是否为一个目录
              -e：  测试文件或者目录是否存在
              -f：  测试是否为文件
              -r:   测试当前用户是否有权限读取
              -w:   测试当前用户是否有权限写入
              -x:   测试当前用户是否可以执行该文件
              -L：  测试是否为符号链接文件

            执行后的命令用$? 来接收
            &>/dev/null        把所有输出的数据重定向到一个黑洞设备中

          2. 条件测试操作
             -eq         等于
             -neq        不等于
             -gt         大于
             -lt         小于
             -ge         大于等于
             -le         小于等于

          3. 字符串判断
             =           等于
             ！=         不等于
             -z          为空


          4. 逻辑判断
             -a &&       逻辑与
             -o ||       逻辑或
             ！          逻辑非


         第十五课：
             数据的迁移
               shift     循环的时候如果shift了  参数会删除掉第一个  第二个变成第一个

             函数的应用：
               定义函数  function name(){}
               调用函数  name()

         第十六课：
             shell文本操作
                 find文件查找操作：
                   1.find . -name '*.txt'        查找当前目录下.txt结尾的数据
                   2.find . -name 'file[1-2]*'   支持正则查找
                   3.find / -name
                   3.find / -perm 755            在根目录下找属性为755的文件
                   4.find . -user root           在当前目录下找属于root用户创建的文件
                   5.find . -type f  l  d        找到当前目录下面的文件
                   6.find . -mtime -5            在五天以内被更改或者创建的文件
                   7.find . -mtime +5            在五天以前的文件
                   8.find . -size +1000000c      大于1m的文件
                   9.find . -name '.txt' | xargs rm -rf         把前面的文件放到后面去处理

            






 */