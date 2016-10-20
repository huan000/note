<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/9/3
 * Time: 21:36
 */

/**
 * 原子 (普通的字符)
 *1)  a~z   A~Z  0~9                代表一个普通的字符
 *
 *
 *2)  模式单元
 *  (abc)                           这一个单元代表一个普通的原子
 *  (?:abc)                         这个时候模式单元就不存储了
 *  (he(ll)o)                       如果括号嵌套的话是从外往里计算的
 *
 *
 *3)  原子表
 *  [xcy]                           原子表中的原子必须匹配一个
 *  [^xcy]                          除了xcy的进行匹配 如果^在后面就成字符了
 *  [a-z]                           简化写法
 *
 *
 *
 *4)  重新使用模式单元
 *  \\1   \\2
 *
 *5)  普通转义字符
 *  \d                              0-9 的数字
 *  \D                              除了  0-9  的数字
 *  \w                              大小写字母   数字  下划线
 *  \W                              除了大小写字母  数字  下划线
 *  \s                              匹配普通的空格
 *  \S                              除了空格以外的


 *6)  模式选择符号
 * /hellw world|earth/              相当与两个正则表达式
 *
 */

/**
 *  转义元字符
 *  1)  字符串边界限制
 *  ^ $  \A \Z                     字符串边界限制
 *
 *  2)  单词边界限制
 *  \babc                          只要有单词以abc开头或者结尾就可以
 *  \Babc                           不以abc开头的，但是abc要出现的单词
 *
 *  3)  重复匹配
 *  ?                              匹配 0-1次
 *  +                              1-无穷   至少要出现一次
 *  *                              0-无穷
 *  {3}                            指定前面的原子出现的次数
 *
 *
 *  4)  代表任何一个字符
 *  .                              除了换行符，可以匹配任何一个字符
 */


/**
 *  模式修正符
 *  i                              可以同时匹配大小写字母
 *  x                              忽略空白字符
 *  U                              匹配最近的字符串(禁止贪婪匹配)
 *  s                              将字符串视为单行
 *  S
 *  m                              将字符串视为多行
 *
 */


/**
 * pcre 函数
 *   preg_match($ze,$str,$arr,PREG_OFFSET_CAPTURE);
 *                                 正则是否匹配这个字符串
 *                                 匹配成功返回1  失败返回0
 *                                 第三个参数如果匹配成功返回成功的第一个元素
 *                                 如果有模式单元还会取出模式单元的内容
 *                                 第四个参数返回偏移量
 *
 *
 *   preg_match_all($ze,$str,$arr);   会把匹配所有的全部取出来
 *                                    如果有模式单元也会全匹配出来
 *
 *
 *
 *   preg_grep('//',$arr);         把这个数组中所有匹配的留下，不匹配的过滤掉
 *                                 返回过滤后的数组
 *
 *   preg_split($ze,$str,2,常量);  按照正则的匹配进行拆分
 *                                 返回拆分后的数组
 *                                 第三个参数指定最大的拆分个数
 *                                 0是尽最大可能性拆分
 *                                 第四个参数
 *                                 PREG_SPLIT_NO_EMPTY,不要空白符
 *                                 PREG_SPLIT_DELIM_CAPTURE,将模式单元的内容也保留下来
 *                                 PREG_SPLIT_OFFSET_CAPTURE,将偏移值也拆分出来
 *
 *   preg_replace($ze,$replace,$str);   把正则匹配到的内容替换成replace
 *                                 返回替换后的字符串
 *   preg_replace(array('',''),array('',''),$str);
 *
 *
 *
 *
 *
 */

