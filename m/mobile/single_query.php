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
			<a href="../">单人查询</a>
			<a href="../m">手机端查询</a>
		</div>
		<table width="100%" border="1">
			<tr>
<th>考勤用户</th>
<th>外勤记录ID</th>
<th>考勤用户Id</th>
<th>考勤日期</th>
<th>考勤时间</th>
<th>考勤IP</th>
<th>经度</th>
<th>纬度</th>
<th>考勤地址</th>
<th>wifi mac</th>
<th>wifi名称</th>
<th>客户ID（用于外勤）</th>
<th>考勤平台（1pc，2app，3微信，4钉钉）</th>
<th>1正常考勤，0外勤</th>
<th>1签到，2签退，0外勤</th>
<th>1定位打卡，2wifi打卡</th>
<th>备注</th>
<th>创建时间</th>
<th>更新时间</th>

			</tr>

			<?php
				// 1.导入配置文件
				require "../dbconfig.php";

				// 2. 连接mysql
			    $con  = mysqli_connect(HOST,USER,PASS,DBNAME,PORT) or die("提示：数据库连接失败！");
                       mysqli_query($con,"SET NAMES UTF8");
                       mysqli_query($con,"set character_set_client=utf8"); 
                      mysqli_query($con,"set character_set_results=utf8");
                      if (mysqli_connect_errno($con)) //判断是否连接上数据库服务器
{ 
    echo "连接数据库服务器失败 " .  iconv('gbk', 'utf-8', mysqli_connect_error()) ;
} 							


$name = $_POST['name'];
$lag_date = $_POST['lag_date'];
			// 3. 从DBNAME中查询到news数据库，返回数据库结果集,并按照addtime降序排列  
			//	$sql = 'select user.user_name,attend_records.* from attend_records join user on attend_records.user_id=user.user_id WHERE attend_records.sign_date>="'.$lag_date.'" and user.user_name="'.$name. '" and (attend_records.is_lag="1" or sign_out_time="")';
				$sql = 'select user.user_name,attend_mobile_records.* from attend_mobile_records join user on attend_mobile_records.user_id=user.user_id WHERE attend_mobile_records.sign_date>="'.$lag_date.'" and user.user_name="'.$name. '" ';
				//echo $sql;
				//attend_simple_records
				// 结果集
                      $result = mysqli_query($con,$sql);
				// var_dump($result);die;


//UPDATE `eoffice10`.`attend_simple_records` SET `sign_time` = '2021-08-13 08:50:14', `created_at` = '2021-08-13 08:50:14', `updated_at` = '2021-08-13 08:50:14' WHERE `record_id` = 52735
				// 解析结果集,$row为所有数据，$newsNum为新闻数目
				$newsNum=mysqli_num_rows($result);  

				for($i=0; $i<$newsNum; $i++){
					$row = mysqli_fetch_assoc($result);
					echo "<tr>";
echo "<td>{$row['user_name']}</td>";
echo "<td>{$row['record_id']}</td>";
echo "<td>{$row['user_id']}</td>";
echo "<td>{$row['sign_date']}</td>";
echo "<td>{$row['sign_time']}</td>";
echo "<td>{$row['ip']}</td>";
echo "<td>{$row['long']}</td>";
echo "<td>{$row['lat']}</td>";
echo "<td>{$row['address']}</td>";
echo "<td>{$row['wifi_mac']}</td>";
echo "<td>{$row['wifi_name']}</td>";
echo "<td>{$row['customer_id']}</td>";
echo "<td>{$row['platform']}</td>";
echo "<td>{$row['sign_type']}</td>";
echo "<td>{$row['sign_status']}</td>";
echo "<td>{$row['sign_category']}</td>";
echo "<td>{$row['remark']}</td>";
echo "<td>{$row['created_at']}</td>";
echo "<td>{$row['updated_at']}</td>";
					echo "<td>
							<a href='javascript:del({$row['record_id']})'>删除</a>
							<a href='edit_attend_records.php?id={$row['record_id']}'>修改</a>
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


