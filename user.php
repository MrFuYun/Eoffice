<?php
session_save_path('./session');
session_start();

if (isset($_SESSION['user'])) {
    header('Content-Type: application/json');
    $user = $_SESSION['user'];
    echo json_encode($user);
} else {
     header('HTTP/1.0 401 Authorization Required');
      header('www-Authenticate: Basic realm= "backdoor"'); 
      header('Content-Type: text/html; charset=UTF-8'); 
    echo '登录后才能访问: <a href="login.htm">立即登录</a>';
     die();
}