<html>
<body>

<?php

$con = mysql_connect("localhost","brisingr","7140");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  
mysql_select_db("assignment3", $con);//connecting with the database

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
	$time = $date[5]. "-" .$months[$date[1]]. "-" . $date[2];
	//echo $date[0]. " " . $time . " " . $nodes[0]. " ".$nodes[1]. " " . $entry[2]. " "."<br/>";
	mysql_query("INSERT INTO logcomm(Time, Day ,Topic) VALUES ( '$time', '$date[0]' ,'$entry[2]' )");//inserting into a temporary table
	
}

mysql_query("create table topic_temp2(Topic varchar(20), count int)");
mysql_query("insert into topic_temp2 SELECT Topic, count(*) FROM `logcomm` GROUP BY Topic");//storing the topic wise grouping
mysql_query("delete from logcomm");

$res = mysql_query("select * from topic_temp2");
//$rows = mysql_num_rows($res);	
while($rows = mysql_fetch_row($res)){
	$whether_exist = mysql_query("select * from topic_logs where Topic like '".$rows[0]."'");//taking care whether topics are not repeated
	if(is_resource($whether_exist) && mysql_num_rows($whether_exist) > 0){
		$rows2 = mysql_fetch_row($whether_exist);
		$count2 = $rows[1]+$rows2[1];
		mysql_query("update topic_logs set count = $count2 where Topic like '".$rows[0]."'");	//updating the values of common topics
		}else{
			mysql_query("insert into topic_logs(Topic, count) values('$rows[0]', $rows[1])"); 	//inserting new topics
			}
	}
mysql_query("drop table topic_temp2");
//mysql_query("delete from topic_logs");
mysql_close($con);
?> 
</body>
</html> 