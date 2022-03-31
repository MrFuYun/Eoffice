<?php 
session_start();//启用session
header("Content-type:text/html;charset=utf-8");//设置编码格式为utf-8
date_default_timezone_set('PRC'); //调整时区
//判断是否点击了登录按钮
if (isset($_POST["login"])) {
 $name = $_POST["name"];//用户名
 $pas = $_POST["pas"];//密码
 $role = $_POST["role"];//用户身份
 $time = date("Y:m:d H:i:s",time());//获取登录时的时间
 $ip = $_SERVER["SERVER_ADDR"];//接收ip位置
 //判断是否为空
 if ($name==""&&$pas=="") {
 echo "<script>alert('用户名和密码不能为空！')</script>";
 header("location:login.php");
 }else{
 //判断用户身份是否为管理员
 if ($role=="admin"&&$name=="Rarin") {
  //如果是管理员，并且用户名是Rarin,那么则把他们输入进session里
  $_SESSION["name"] = $name;
  $_SESSION["pas"] = $pas;
  $_SESSION["role"] = $role;
  $_SESSION["ip"] = $ip;
  $_SESSION["time"] = $time;
  header("location:index.php"."?role=$role");//成功后返回index.php页面并保存role值
 }elseif ($pas=="2002"&&($role=="hr"||$role=="clerk")) {
  //不是管理员，是老师或者学生的时候，并且密码为2002,那么把他们输入进cookie里
  setcookie("name",$name,time()+3600);//创建cookie并给他输入值
  setcookie("pas",$pas,time()+3600);
  setcookie("role",$role,time()+3600);
  setcookie("ip",$ip,time()+3600);
  setcookie("time",$time,time()+3600);
  header("location:index.php"."?role=$role");
 }
 }
}