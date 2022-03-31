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
			<a href="/qc">单人查询</a>
		</div>
		<table width="100%" border="1">
			<tr>
				<th>系统序号</th>
				<th>用户姓名</th>
				<th>用户ID</th>
				<th>考勤日期</th>
				<th>签到时间</th>	
				<th>排班签到时间</th>
				<th>签退时间</th>
				<th>排班签退时间</th>
				<th>迟到时长(小时)</th>
				<th>早退时间</th>
	       		<th>应出勤时长(</th>
				<th>签到IP地址</th>	
				<th>签到地图经度</th>	
				<th>签到地图纬度</th>	
				<th>签到地点</th>	
				<th>签到平台</th>	
				<th>签退IP地址</th>	
				<th>签退地图经度</th>	
				<th>签退地图纬度</th>	
				<th>签退地点</th>	
				<th>签退平台</th>	
				<th>是否迟到</th>	
				<th>是否早退</th>	
				<th>校准状态</th>	
				<th>校准次数</th>	
				<th>校准原因</th>	
				<th>校准时间</th>	
				<th>校准批准时间</th>	
				<th>SIGN时间</th>	
				<th>转移ID</th>	
				<th>是否抵消</th>
				<th>抵消迟到历史</th>	
				<th>抵消早退历史</th>	
				<th>出席类型</th>	
				<th>是否修复</th>	
				<th>修复时间</th>	
				<th>评论</th>	
				<th>创建时间</th>	
				<th>更新时间</th>	
				<th>校准SIGN</th>	
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
				
				echo $sql;
				// 结果集
                      $result = mysqli_query($con,$sql);
			//	 var_dump($result);die;

				// 解析结果集,$row为新闻所有数据，$newsNum为新闻数目
				$newsNum=mysqli_num_rows($result);  

				for($i=0; $i<$newsNum; $i++){
					$row = mysqli_fetch_assoc($result);
				$lag_time=round($row['lag_time']/3600,1);
					echo "<tr>";
echo "<td>{$row['record_id']}</td>";
echo "<td>{$row['user_name']}</td>";
echo "<td>{$row['user_id']}</td>";
echo "<td>{$row['sign_date']}</td>";
echo "<td>{$row['sign_in_time']}</td>";
echo "<td>{$row['sign_in_normal']}</td>";
echo "<td>{$row['sign_out_time']}</td>";
echo "<td>{$row['sign_out_normal']}</td>";
echo "<td>{$lag_time}</td>";
echo "<td>{$row['leave_early_time']}</td>";
echo "<td>{$row['must_attend_time']}</td>";
echo "<td>{$row['in_ip']}</td>";
echo "<td>{$row['in_long']}</td>";
echo "<td>{$row['in_lat']}</td>";
echo "<td>{$row['in_address']}</td>";
echo "<td>{$row['in_platform']}</td>";
echo "<td>{$row['out_ip']}</td>";
echo "<td>{$row['out_long']}</td>";
echo "<td>{$row['out_lat']}</td>";
echo "<td>{$row['out_address']}</td>";
echo "<td>{$row['out_platform']}</td>";
echo "<td>{$row['is_lag']}</td>";
echo "<td>{$row['is_leave_early']}</td>";
echo "<td>{$row['calibration_status']}</td>";
echo "<td>{$row['calibration_count']}</td>";
echo "<td>{$row['calibration_reason']}</td>";
echo "<td>{$row['calibration_time']}</td>";
echo "<td>{$row['calibration_aprove_time']}</td>";
echo "<td>{$row['sign_times']}</td>";
echo "<td>{$row['shift_id']}</td>";
echo "<td>{$row['is_offset']}</td>";
echo "<td>{$row['offset_lag_history']}</td>";
echo "<td>{$row['offset_early_history']}</td>";
echo "<td>{$row['attend_type']}</td>";
echo "<td>{$row['is_repair']}</td>";
echo "<td>{$row['repair_time']}</td>";
echo "<td>{$row['remark']}</td>";
echo "<td>{$row['created_at']}</td>";
echo "<td>{$row['updated_at']}</td>";
echo "<td>{$row['calibration_sign']}</td>";

					echo "<td>
							<a href='javascript:del({$row['record_id']})'>删除</a>
							<a href='editnews.php?id={$row['record_id']}'>修改</a>
						  </td>";
					echo "</tr>";
				}
				// 5. 释放结果集
				mysqli_free_result($result);
				mysqli_close($con);
			?>

		</table>
	</div>

	<script type="text/javascript">
		function del (id) {
			if (confirm("确定删除这条记录吗？")){
				window.location = "action-del.php?id="+id;
			}
		}
	</script>
</body>
</html>

