<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

	   		$username = "brisingr";
			$password = "7140";
			$host = "localhost";
			$db = "assignment3";
			$link = mysql_connect($host,$username,$password);
			if(!$link){
				die("Could not Connect ".mysql_error());
				}else{
					echo "Database Connected Successfully";
				}
			mysql_select_db($db,$link);
			$query = "delete from nodes";
			$res = mysql_query($query);
			
			$link = mysql_connect($host,$username,$password);
			if(!$link){
				die("Could not Connect ".mysql_error());
				}else{
					echo "Database Connected Successfully";
				}
			mysql_select_db($db,$link);
			$query = "delete from edges";
			$res = mysql_query($query);
		   

?>
</body>
</html>