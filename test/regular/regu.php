<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>正则测试</title>
</head>
<body>
    <form action="" method="post">
       输入正则匹配字符串：<input type="text" name="str"/>
       <input type="submit" value="匹配">
    </form>
<?php

    $str = $_POST['str'];
    $ze = "/[abcdefg]/";

    if(!empty($str)){
        if(preg_match($ze,$str)){
             echo "正则匹配成功";

        }else{
             echo "正则匹配失败";

        }
    }else{
        echo "请输入字符";
    }




?>



</body>
</html>