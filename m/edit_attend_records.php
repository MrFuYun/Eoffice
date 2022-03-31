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
<th>考勤用户</th>
<th>记录id</th>
<th>用户id</th>
<th>考勤日期</th>
<th>考勤时间</th>
<th>考勤年</th>
<th>考勤月</th>
<th>考勤类型,0外勤，1签到，2签退</th>
<th>考勤平台</th>
<th>考勤ip</th>
<th>经度</th>
<th>纬度</th>
<th>考勤地址</th>
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


$id = $_REQUEST['id'];





				// 3. 从DBNAME中查询到news数据库，返回数据库结果集,并按照addtime降序排列  
				$sql = 'select user.user_name,attend_simple_records.*
from attend_simple_records 
join user
on attend_simple_records.user_id=user.user_id
WHERE attend_simple_records.record_id  = "'.$id.'"';
				
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
echo "<td><input type='text' value='{$row['user_name']}' id='user_name' name='user_name'></td>";
echo "<td><input type='text' value='{$row['record_id']}' id='record_id' name='record_id'></td>";
echo "<td><input type='text' value='{$row['user_id']}' id='user_id' name='user_id'></td>";
echo "<td><input type='text' value='{$row['sign_date']}' id='sign_date' name='sign_date'></td>";
echo "<td><input type='text' value='{$row['sign_time']}' id='sign_time' name='sign_time'></td>";
echo "<td><input type='text' value='{$row['year']}' id='year' name='year'></td>";
echo "<td><input type='text' value='{$row['month']}' id='month' name='month'></td>";
echo "<td><input type='text' value='{$row['sign_type']}' id='sign_type' name='sign_type'></td>";
echo "<td><input type='text' value='{$row['platform']}' id='platform' name='platform'></td>";
echo "<td><input type='text' value='{$row['ip']}' id='ip' name='ip'></td>";
echo "<td><input type='text' value='{$row['long']}' id='long' name='long'></td>";
echo "<td><input type='text' value='{$row['lat']}' id='lat' name='lat'></td>";
echo "<td><input type='text' value='{$row['address']}' id='address' name='address'></td>";
echo "<td><input type='text' value='{$row['remark']}' id='remark' name='remark'></td>";
echo "<td><input type='text' value='{$row['created_at']}' id='created_at' name='created_at'></td>";
echo "<td><input type='text' value='{$row['updated_at']}' id='updated_at' name='updated_at'></td>";







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

