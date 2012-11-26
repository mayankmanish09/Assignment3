<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$con = mysql_connect("localhost","brisingr","7140");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  
mysql_select_db("assignment3", $con);

/*$sql = "CREATE TABLE Nodes(
Node int,
Location varchar(15)
)";
mysql_query($sql,$con);*/

$input_string = file_get_contents("log-graph.out");
$input_array = explode("\n",$input_string);

for($i=0;$i<2500;$i++) {
	$entry = explode(", ",substr($input_array[$i],16));
	//echo ($entry[0]." ".$entry[1]."<br/>");
	mysql_query("INSERT INTO nodes(Node, Location) VALUES ( '$entry[0]', '$entry[1]' )");//inserting into nodes table
}

/*$sql2 = "CREATE TABLE Edges(
Source int,
Target int
)";
mysql_query($sql2,$con);*/

for($i=2500; $i<count($input_array)-1 ;$i++) {
	$entry = explode("-",substr($input_array[$i],16));
	//echo $entry[0]. " " . $entry[1]."<br/>";
	mysql_query("INSERT INTO edges(Source, Target) VALUES ( '$entry[0]', '$entry[1]' )");// inserting into edges table
}

mysql_close($con);
?> 
</body>
</html>