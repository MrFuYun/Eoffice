<?php $users_part=array('guest'=>'@@@@@123'); include 'authorization.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>泛微OA考勤修正系统</title>
</head>
<style type="text/css">
.wrapper {width: 100%;margin: 1px auto;font-size:5px;}
h2 {text-align: center;}
.add {margin-bottom: 0px;}
.add a {text-decoration: none;color: #fff;background-color: green;padding: 6px;border-radius: 5px;}
td {text-align: center;}
</style>
<body>
	<div class="wrapper">
		<h2>考勤修正系统</h2>


<?php
//接收POST数据
				
$record_id=$_REQUEST['record_id'];
$user_id=$_REQUEST['user_id'];
$sign_date=$_REQUEST['sign_date'];
$sign_time=$_REQUEST['sign_time'];
$year=$_REQUEST['year'];
$month=$_REQUEST['month'];
$sign_type=$_REQUEST['sign_type'];
$platform=$_REQUEST['platform'];
$ip=$_REQUEST['ip'];
$long=$_REQUEST['long'];
$lat=$_REQUEST['lat'];
$address=$_REQUEST['address'];
$remark=$_REQUEST['remark'];
$created_at=$_REQUEST['created_at'];
$updated_at=$_REQUEST['updated_at'];


				require "../dbconfig.php";

				// 2. 连接mysql
			    $con  = mysqli_connect(HOST,USER,PASS,DBNAME,PORT) or die("提示：数据库连接失败！");
                       mysqli_query($con,"SET NAMES UTF8");
                       mysqli_query($con,"set character_set_client=utf8"); 
                      mysqli_query($con,"set character_set_results=utf8");
                      if (mysqli_connect_errno($con))
                       //判断是否连接上数据库服务器
{ 
    echo "连接数据库服务器失败 " .  iconv('gbk', 'utf-8', mysqli_connect_error()) ;
} 							








				// 3. 从DBNAME中查询到news数据库，返回数据库结果集,并按照addtime降序排列  

$sql='UPDATE attend_simple_records SET sign_date= "'.$sign_date.'",	sign_time= "'.$sign_time.'",	year= "'.$year.'",	month= "'.$month.'",	sign_type= "'.$sign_type.'",	platform= "'.$platform.'",	ip= "'.$ip.'",	`long`= "'.$long.'",	lat= "'.$lat.'",	address= "'.$address.'",	remark= "'.$remark.'",	created_at= "'.$created_at.'",	updated_at= "'.$updated_at.'" WHERE record_id="'.$record_id.'"';				
				//echo $sql."\n";
				// 结果集
                      $result = mysqli_query($con,$sql);
                      
			//echo "执行结果".$result."\n";
            if ($result=1){
            echo "<font color='Green' size='20'>修正成功!</font>";
            }else{
              echo "<font color='red’ size='20'>修正失败!</font>";
            }

	
				
				// 5. 释放结果集
				mysqli_free_result($result);
				mysqli_close($con);
				
				
			?>		
		
	<div id="content">
		<div id="infowrap">
			<div id="box">
				<h3>操作成功，<span id="time" name="time">3</span>秒钟后自动跳转到上一页</h3>


				

			</div>
		</div>
	</div>

<script language="javascript">
	
var t = 3;
	var time = document.getElementById("time");
	function fun() {
		t--;
		time.innerHTML = t;
		if (t <= 0) {
			location.href = document.referrer;
			clearInterval(inter);
		}
	}
	var inter = setInterval("fun()", 1000);
	
</script>
</body>
</html>

