<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$username = "vaibhav";
$password = "7140";
$host = "localhost";
$db = "stud";
$link = mysql_connect($host,$username,$password);//connecting with the database
mysql_select_db($db,$link);

$f = file_get_contents("comm.csv");
$s = explode("\n", $f);
for($i = 1; $i < 2500; $i++){
	$str = explode(',',$s[$i]);
	mysql_query("insert into friends(Node,f1,f2,f3,f4) values($str[0],$str[1],$str[2],$str[3],$str[4])");
	}
?>
</body>
</html>