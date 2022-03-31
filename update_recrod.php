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

/*$record_id=$_REQUEST['record_id'];
//$user_name=$_REQUEST['user_name'];
//$user_id=$_REQUEST['user_id'];
//$sign_date=$_REQUEST['sign_date'];
$sign_in_time=$_REQUEST['sign_in_time'];
$sign_in_normal=$_REQUEST['sign_in_normal'];
$sign_out_time=$_REQUEST['sign_out_time'];
$sign_out_normal=$_REQUEST['sign_out_normal'];
$lag_time=$_REQUEST['lag_time'];
$leave_early_time=$_REQUEST['leave_early_time'];
$must_attend_time=$_REQUEST['must_attend_time'];
$in_ip=$_REQUEST['in_ip'];
$in_address=$_REQUEST['in_address'];
$out_ip=$_REQUEST['out_ip'];
$out_address=$_REQUEST['out_address'];
$lag_time=$_REQUEST['lag_time'];
$is_leave_early=$_REQUEST['is_leave_early'];
//echo $record_id;
//	$sql =  'UPDATE attend_records SET sign_in_time= "'.$sign_in_time.'", lag_time="'.$lag_time.'", is_lag="'.$is_lag.'", $sign_out_time="'.$sign_out_time.' WHERE record_id="'.$record_id.'"';
				
	//			echo $sql;
//				echo $q;
				// 1.导入配置文件
				
	*/			
				
				
$record_id=$_REQUEST['record_id'];
$user_id=$_REQUEST['user_id'];
$sign_date=$_REQUEST['sign_date'];
$sign_in_time=$_REQUEST['sign_in_time'];
$sign_in_normal=$_REQUEST['sign_in_normal'];
$sign_out_time=$_REQUEST['sign_out_time'];
$sign_out_normal=$_REQUEST['sign_out_normal'];
$lag_time=$_REQUEST['lag_time'];
$leave_early_time=$_REQUEST['leave_early_time'];
$must_attend_time=$_REQUEST['must_attend_time'];
$in_ip=$_REQUEST['in_ip'];
$in_long=$_REQUEST['in_long'];
$in_lat=$_REQUEST['in_lat'];
$in_address=$_REQUEST['in_address'];
$in_platform=$_REQUEST['in_platform'];
$out_ip=$_REQUEST['out_ip'];
$out_long=$_REQUEST['out_long'];
$out_lat=$_REQUEST['out_lat'];
$out_address=$_REQUEST['out_address'];
$out_platform=$_REQUEST['out_platform'];
$is_lag=$_REQUEST['is_lag'];
$is_leave_early=$_REQUEST['is_leave_early'];
$calibration_status=$_REQUEST['calibration_status'];
$calibration_count=$_REQUEST['calibration_count'];
$calibration_reason=$_REQUEST['calibration_reason'];
$calibration_time=$_REQUEST['calibration_time'];
$calibration_aprove_time=$_REQUEST['calibration_aprove_time'];
$sign_times=$_REQUEST['sign_times'];
$shift_id=$_REQUEST['shift_id'];
$is_offset=$_REQUEST['is_offset'];
$offset_lag_history=$_REQUEST['offset_lag_history'];
$offset_early_history=$_REQUEST['offset_early_history'];
$attend_type=$_REQUEST['attend_type'];
$is_repair=$_REQUEST['is_repair'];
$repair_time=$_REQUEST['repair_time'];
$remark=$_REQUEST['remark'];
$created_at=$_REQUEST['created_at'];
$updated_at=$_REQUEST['updated_at'];
$calibration_sign=$_REQUEST['calibration_sign'];
$original_sign_in_time=$_REQUEST['original_sign_in_time'];
$original_sign_out_time=$_REQUEST['original_sign_out_time'];

				require "dbconfig.php";

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
//			$sql =  'UPDATE attend_records SET sign_in_time= "'.$sign_in_time.'", lag_time="'.$lag_time.'", is_lag="'.$is_lag.'", sign_out_time="'.$sign_out_time.'" WHERE record_id="'.$record_id.'"';
//$sql='UPDATE attend_records SET sign_in_time= "'.$sign_in_time.'",sign_in_normal= "'.$sign_in_normal.'",sign_out_time= "'.$sign_out_time.'",sign_out_normal= "'.$sign_out_normal.'",lag_time= "'.$lag_time.'", is_lag="'.$is_lag.'",leave_early_time= "'.$leave_early_time.'",must_attend_time= "'.$must_attend_time.'",in_ip= "'.$in_ip.'",in_address= "'.$in_address.'",in_platform="2",out_ip= "'.$out_ip.'",out_address= "'.$out_address.'",out_platform="2",lag_time= "'.$lag_time.'",is_leave_early= "'.$is_leave_early.'" WHERE record_id="'.$record_id.'"';
  $sql='UPDATE attend_records SET sign_in_time= "'.$sign_in_time.'",sign_in_normal= "'.$sign_in_normal.'",sign_out_time= "'.$sign_out_time.'",sign_out_normal= "'.$sign_out_normal.'",lag_time= "'.$lag_time.'",leave_early_time= "'.$leave_early_time.'",must_attend_time= "'.$must_attend_time.'",in_ip= "'.$in_ip.'",in_long= "'.$in_long.'",in_lat= "'.$in_lat.'",in_address= "'.$in_address.'",in_platform= "'.$in_platform.'",out_ip= "'.$out_ip.'",out_long= "'.$out_long.'",out_lat= "'.$out_lat.'",out_address= "'.$out_address.'",out_platform= "'.$out_platform.'",is_lag= "'.$is_lag.'",is_leave_early= "'.$is_leave_early.'",calibration_status= "'.$calibration_status.'",calibration_count= "'.$calibration_count.'",calibration_reason= "'.$calibration_reason.'",calibration_time= "'.$calibration_time.'",calibration_aprove_time= "'.$calibration_aprove_time.'",sign_times= "'.$sign_times.'",shift_id= "'.$shift_id.'",is_offset= "'.$is_offset.'",offset_lag_history= "'.$offset_lag_history.'",offset_early_history= "'.$offset_early_history.'",attend_type= "'.$attend_type.'",is_repair= "'.$is_repair.'",repair_time= "'.$repair_time.'",remark= "'.$remark.'",created_at= "'.$created_at.'",updated_at= "'.$updated_at.'",calibration_sign= "'.$calibration_sign.'",original_sign_in_time= "'.$original_sign_in_time.'",original_sign_out_time= "'.$original_sign_out_time.'" WHERE record_id="'.$record_id.'"';

				
			//	echo $sql."\n";
				// 结果集
                      $result = mysqli_query($con,$sql);
                      
			//echo $result."\n";
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

