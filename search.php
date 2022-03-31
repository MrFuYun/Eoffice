<?php

header("Content-Type: text/html;charset=utf-8"); 
//header('Content-type: application/json');
//请把db_name修改成你数据库的名称，db_psd修改成你数据库的密码
$con = mysqli_connect("127.0.0.1","root","1234567890", "eoffice10","3310");
mysqli_query($con,"SET NAMES UTF8");
mysqli_query($con,"set character_set_client=utf8"); 
mysqli_query($con,"set character_set_results=utf8");
if (mysqli_connect_errno($con)) //判断是否连接上数据库服务器
{ 
    echo "连接数据库服务器失败 " .  iconv('gbk', 'utf-8', mysqli_connect_error()) ;
} 							


$sql = "SELECT * FROM user";
$result = mysqli_query($con,$sql);
var_dump(mysqli_fetch_array($result));


?>