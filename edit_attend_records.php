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
		<div class="add">
			单人查询</a>
		</div>
		<form action="update_recrod.php" name="edit_record" id="edit_record" method="post">
		<table width="100%" border="1">
			<tr>
<th>考勤记录ID</th>
<th>考勤用户</th>
<th>考勤用户Id</th>
<th>考勤日期</th>
<th>签到时间</th>
<th>正常签到时间</th>
<th>签退时间</th>
<th>正常签退时间</th>
<th>迟到时间</th>
<th>早退时间</th>
<th>应出勤时间</th>
<th>签到考勤IP</th>
<th>签到经度</th>
<th>签到纬度</th>
<th>签到考勤地址</th>
<th>签到平台（1pc，2app，3微信，4钉钉）</th>
<th>签退考勤IP</th>
<th>签退经度</th>
<th>签退纬度</th>
<th>签退考勤地址</th>
<th>签退平台（1pc，2app，3微信，4钉钉）</th>
<th>是否迟到</th>
<th>是否早退</th>
<th>校验状态,1提交2批准3退回</th>
<th>审批次数</th>
<th>校验理由</th>
<th>校验时间</th>
<th>考勤校准通过时间</th>
<th>第几次考勤（签到或签退）</th>
<th>班次ID</th>
<th>是否抵消（0否，1是）</th>
<th>迟到抵消历史信息</th>
<th>抵消早退历史</th>
<th>1工作日考勤，2休息日考勤</th>
<th>是否补卡</th>
<th>补卡时长</th>
<th>备注</th>
<th>创建时间</th>
<th>更新时间</th>
<th>需要校准的异常卡，1校准签到和签退，2校准签到，3校准签退</th>
<th>原始签到时间</th>
<th>原始签退时间</th>

			</tr>

			<?php
				// 1.导入配置文件
				require "dbconfig.php";

				// 2. 连接mysql
			    $con  = mysqli_connect(HOST,USER,PASS,DBNAME,PORT) or die("提示：数据库连接失败！");
                       mysqli_query($con,"SET NAMES UTF8");
                       mysqli_query($con,"set character_set_client=utf8"); 
                      mysqli_query($con,"set character_set_results=utf8");
                      if (mysqli_connect_errno($con)) //判断是否连接上数据库服务器
{ 
    echo "连接数据库服务器失败 " .  iconv('gbk', 'utf-8', mysqli_connect_error()) ;
} 							


$id = $_REQUEST['id'];





				// 3. 从DBNAME中查询到news数据库，返回数据库结果集,并按照addtime降序排列  
				$sql = 'select user.user_name,attend_records.*
from attend_records 
join user
on attend_records.user_id=user.user_id
WHERE attend_records.record_id  = "'.$id.'"';
				
				//echo $sql;
				// 结果集
                      $result = mysqli_query($con,$sql);
			//	 var_dump($result);die;

				// 解析结果集,$row为新闻所有数据，$newsNum为新闻数目
				$newsNum=mysqli_num_rows($result);  

				for($i=0; $i<$newsNum; $i++){
					$row = mysqli_fetch_assoc($result);
//				$lag_time=round($row['lag_time']/3600,1);
					echo "<tr>";

echo "<td><input type='text' value='{$row['record_id']}' id='record_id' name='record_id'></td>";
echo"<td><input type='text' value='{$row['user_name']}'id= 'user_name' name= 'user_name'></td>";
echo "<td><input type='text' value='{$row['user_id']}' id='user_id' name='user_id'></td>";
echo "<td><input type='text' value='{$row['sign_date']}' id='sign_date' name='sign_date'></td>";
echo "<td><input type='text' value='{$row['sign_in_time']}' id='sign_in_time' name='sign_in_time'></td>";
echo "<td><input type='text' value='{$row['sign_in_normal']}' id='sign_in_normal' name='sign_in_normal'></td>";
echo "<td><input type='text' value='{$row['sign_out_time']}' id='sign_out_time' name='sign_out_time'></td>";
echo "<td><input type='text' value='{$row['sign_out_normal']}' id='sign_out_normal' name='sign_out_normal'></td>";
echo "<td><input type='text' value='{$row['lag_time']}' id='lag_time' name='lag_time'></td>";
echo "<td><input type='text' value='{$row['leave_early_time']}' id='leave_early_time' name='leave_early_time'></td>";
echo "<td><input type='text' value='{$row['must_attend_time']}' id='must_attend_time' name='must_attend_time'></td>";
echo "<td><input type='text' value='{$row['in_ip']}' id='in_ip' name='in_ip'></td>";
echo "<td><input type='text' value='{$row['in_long']}' id='in_long' name='in_long'></td>";
echo "<td><input type='text' value='{$row['in_lat']}' id='in_lat' name='in_lat'></td>";
echo "<td><input type='text' value='{$row['in_address']}' id='in_address' name='in_address'></td>";
echo "<td><input type='text' value='{$row['in_platform']}' id='in_platform' name='in_platform'></td>";
echo "<td><input type='text' value='{$row['out_ip']}' id='out_ip' name='out_ip'></td>";
echo "<td><input type='text' value='{$row['out_long']}' id='out_long' name='out_long'></td>";
echo "<td><input type='text' value='{$row['out_lat']}' id='out_lat' name='out_lat'></td>";
echo "<td><input type='text' value='{$row['out_address']}' id='out_address' name='out_address'></td>";
echo "<td><input type='text' value='{$row['out_platform']}' id='out_platform' name='out_platform'></td>";
echo "<td><input type='text' value='{$row['is_lag']}' id='is_lag' name='is_lag'></td>";
echo "<td><input type='text' value='{$row['is_leave_early']}' id='is_leave_early' name='is_leave_early'></td>";
echo "<td><input type='text' value='{$row['calibration_status']}' id='calibration_status' name='calibration_status'></td>";
echo "<td><input type='text' value='{$row['calibration_count']}' id='calibration_count' name='calibration_count'></td>";
echo "<td><input type='text' value='{$row['calibration_reason']}' id='calibration_reason' name='calibration_reason'></td>";
echo "<td><input type='text' value='{$row['calibration_time']}' id='calibration_time' name='calibration_time'></td>";
echo "<td><input type='text' value='{$row['calibration_aprove_time']}' id='calibration_aprove_time' name='calibration_aprove_time'></td>";
echo "<td><input type='text' value='{$row['sign_times']}' id='sign_times' name='sign_times'></td>";
echo "<td><input type='text' value='{$row['shift_id']}' id='shift_id' name='shift_id'></td>";
echo "<td><input type='text' value='{$row['is_offset']}' id='is_offset' name='is_offset'></td>";
echo "<td><input type='text' value='{$row['offset_lag_history']}' id='offset_lag_history' name='offset_lag_history'></td>";
echo "<td><input type='text' value='{$row['offset_early_history']}' id='offset_early_history' name='offset_early_history'></td>";
echo "<td><input type='text' value='{$row['attend_type']}' id='attend_type' name='attend_type'></td>";
echo "<td><input type='text' value='{$row['is_repair']}' id='is_repair' name='is_repair'></td>";
echo "<td><input type='text' value='{$row['repair_time']}' id='repair_time' name='repair_time'></td>";
echo "<td><input type='text' value='{$row['remark']}' id='remark' name='remark'></td>";
echo "<td><input type='text' value='{$row['created_at']}' id='created_at' name='created_at'></td>";
echo "<td><input type='text' value='{$row['updated_at']}' id='updated_at' name='updated_at'></td>";
echo "<td><input type='text' value='{$row['calibration_sign']}' id='calibration_sign' name='calibration_sign'></td>";
echo "<td><input type='text' value='{$row['original_sign_in_time']}' id='original_sign_in_time' name='original_sign_in_time'></td>";
echo "<td><input type='text' value='{$row['original_sign_out_time']}' id='original_sign_out_time' name='original_sign_out_time'></td>";





				echo "</tr>";
				}
				// 5. 释放结果集
				mysqli_free_result($result);
				mysqli_close($con);
			?>
<tr>			
			<td><input type="submit"></td>
</tr>

		</table>
	</div>
</form>
	<script type="text/javascript">
		function del (id) {
			if (confirm("确定删除这条记录吗？")){
				window.location = "action-del.php?id="+id;
			}
		}
	</script>
</body>
</html>

