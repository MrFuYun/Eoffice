<?php
// 处理删除操作的页面 
require "../dbconfig.php";
// 连接mysql
		    $con  = mysqli_connect(HOST,USER,PASS,DBNAME,PORT) or die("提示：数据库连接失败！");
                       mysqli_query($con,"SET NAMES UTF8");
                       mysqli_query($con,"set character_set_client=utf8"); 
                      mysqli_query($con,"set character_set_results=utf8");
                      if (mysqli_connect_errno($con)) //判断是否连接上数据库服务器
{ 
    echo "连接数据库服务器失败 " .  iconv('gbk', 'utf-8', mysqli_connect_error()) ;
} 							

// 选择数据库

// 编码设置
$id = $_GET['id'];
$sql="DELETE FROM attend_mobile_records WHERE record_id='{$id}'";

//删除指定数据  
echo $sql;
$result = mysqli_query($con,$sql)or die('删除数据出错：'.mysqli_error($con));

				mysqli_free_result($result);
				mysqli_close($con);

	//echo "执行结果".$result."\n";
	
            if ($result=1){
            echo "<script > alert('删除成功!');</script>";
            }else{
              echo "<script> alert('删除失败!');</script>";
            }

	
				
				// 5. 释放结果集
// 删除完跳转到新闻页
header("Location:../");  

                      
		
