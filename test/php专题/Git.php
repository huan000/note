<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2016/5/26
 * Time: 19:59
 */

/*
 * 基本概念
 *
 * */
//  文件的三个状态
//  1. working directory  本地目录
//  2. staging area       临时工作状态
//  3. git directory      本地仓库状态
//  4. blssed remote directory    远程仓库

//  文件的四个生命周期
//  1. untracked          没有收到跟踪的文件
//  2. unmodified         已经提交还没有被修改的
//  3. modified           已经被修改的
//  4. staged             放到临时仓库的文件


//  git官方网站下载
//  git-scm.com







/**
 * 设置身份
 */
// git config --global user.name "huan shuo"
// git config --global user.email huan@admin.com


/**
 * 把当前的文件夹变成一个git仓库（建立本地仓库）
 */
// git init


/**
 * 建立远程仓库
 */
// git clone git：//github.com/git/hello-world.git




/**
 * 把文件提交到 stage area （并没有提交到本地仓库，其实保存到了index的二进制文件中 ）
 */
// git add ./



/**
 * 把文件真正的提交到版本仓库中  （-a 指令可以不进行add操作）
 */
// git commit hello -a -m "log message"


/**
 * 查看与远程仓库之间的联系 (查看与仓库之间的关系)
 */
// git remote -v



/**
 * 查看项目状态
 */
// git status


/**
 * 如果不想把文件上传到服务器
 */
//  创建一个文件 .gitignore    文件里面把要忽略的文件名写进去

/**
 * 比较代码差异
 */
// 比较workspace 和  staged
// git diff --staged

// 比较staged 和 local repol
// git diff --cached








/**
 * 文件的移动和删除
 */
// 文件删除 （staged 区域）
// git rm filename

// 文件删除 （staged 区域 && local repol区域）
// git rm filename
// git commit -a -m "delete forver"


// 从local repol 回复这个文件
// git checkout -- filename


/**
 * 观察和比较
 */
// git log
// git diff




/**
 * 本地仓库local repol 和远程 remote  的通信
 */
//从remote 下载代码并且合并
// get pull 远程地址


//从remote下载代码建立到新的分支上面
// git fetch 远程地址

//把本地local repol 的代码push到 remote 上
// git push 远程地址 master


//如果上传remote仓库之后没有权限可以打补丁
// git format-patch origin/master


/**
 * 远程仓库信息
 */
// git remote     显示远程仓库
// git remote -v      显示远程仓库详细信息
// git remote show origin    显示仓库的详细信息


// 添加远程仓库
// git remote add pbname git://xxxx
// git remote rename pbname pb
// git remote rm pb





/**
 * 分支
 */
// 查看当前的分支
// git branch



// 建立一个新的分支
// git branch newbranch

// 切换分支
// git checkout master

// 查看连个个分支之间的差异
// git show-branch

// 比较两个分支之间的差异
// git diff master newbranch

// 合并两个分支
// git merge "merge" HEAD huan0000

/**
 *  创建版本标签
 */
// git tag -a BETA1 -m "this is beta1"

// git tag BETA1                          切换回当前的版本







































