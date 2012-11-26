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
  
mysql_select_db("assignment3", $con);	//connecting to the database

$input = file_get_contents("pointer.txt");
if($input < 10){
	$str = "log-comm.0".$input.".out";
	}else{
	$str = "log-comm.".$input.".out";
	}

$input_string = file_get_contents($str);//getting file contents
$input_array = explode("\n",$input_string);
$months=array("Jan"=>01,"Feb"=>02,"Mar"=>03,"Apr"=>04,"May"=>05,"Jun"=>06,"Jul"=>07,"Aug"=>8,"Sep"=>9,"Oct"=>10,"Nov"=>11,"Dec"=>12); 

for($i=0; $i < sizeof($input_array)-1; $i++) {

	$entry = explode(", ",substr($input_array[$i],24));
	$date = explode(" ",substr($entry[0],0));
	$nodes = explode("-",substr($entry[1],0));
	$yyyymmdd = $date[5]. "-" .$months[$date[1]]. "-" . $date[2];
	//echo $date[0]. " " . $time . " " . $nodes[0]. " ".$nodes[1]. " " . $entry[2]. " "."<br/>";
	mysql_query("INSERT INTO logcomm(Time, Day ,topic) VALUES ( '$yyyymmdd', '$date[0]' ,'$entry[2]' )");//inserting into the temporary table
	
}

mysql_query("create table topic_temp(Time varchar(10), Topic varchar(40), count int)");
mysql_query("insert into topic_temp SELECT Time, Topic, count(*) FROM `logcomm` GROUP BY Time, Topic");//grouping on the basis of date and topic

mysql_query("delete from logcomm");		//deleting the temp teble
//mysql_query("drop table topic_temp");
?>
</body>
</html>