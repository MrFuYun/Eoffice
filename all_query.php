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
			<a href="/kq">单人查询</a>
		</div>
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



				// 3. 从DBNAME中查询到news数据库，返回数据库结果集,并按照addtime降序排列  
				$sql = 'select user.user_name,attend_records.*
from attend_records 
join user
on attend_records.user_id=user.user_id
WHERE 1=1 and (attend_records.is_lag="1" or sign_out_time="")';
				// 结果集
                      $result = mysqli_query($con,$sql);
			//	 var_dump($result);die;

				// 解析结果集,$row为新闻所有数据，$newsNum为新闻数目
				$newsNum=mysqli_num_rows($result);  

				for($i=0; $i<$newsNum; $i++){
					$row = mysqli_fetch_assoc($result)
					echo "<tr>";
echo "<td>{$row['record_id']}</td>";
echo "<td>{$row['user_name']}</td>";
echo "<td>{$row['user_id']}</td>";
echo "<td>{$row['sign_date']}</td>";
echo "<td>{$row['sign_in_time']}</td>";
echo "<td>{$row['sign_in_normal']}</td>";
echo "<td>{$row['sign_out_time']}</td>";
echo "<td>{$row['sign_out_normal']}</td>";
echo "<td>{$row['lag_time']}</td>";
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
echo "<td>{$row['original_sign_in_time']}</td>";
echo "<td>{$row['original_sign_out_time']}</td>";

					echo "<td>
							<a href='javascript:del({$row['user_id']})'>删除</a>
							<a href='edit_attend_records.php?id={$row['user_id']}'>修改</a>
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

