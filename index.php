<?php $users_part=array('guest'=>'@@@@@123'); include 'authorization.php'; ?>

<!DOCTYPE html>  
<html>  
<head lang="en">  
    <meta charset="UTF-8">  
    <title>考勤修正系统</title>  
</head>
<style type="text/css">
	form{
		margin: 20px;
	}
</style>
<body>
<form action="single_query.php" method="post">  
    <label>姓名：</label><input type="text" name="name">  

    <label>迟到时间：</label><input type="date" name="lag_date">  

    <input type="submit" value="提交">  
</form>  
</body>  
</html>