<html>
<body>

<?php
set_time_limit(-1);
$con = mysql_connect("localhost","vaibhav","7140");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  
mysql_select_db("stud", $con);

$input = file_get_contents("pointer.txt");
if($input < 10){
	$str = "log-comm.0".$input.".out";
	}else{
	$str = "log-comm.".$input.".out";
	}

$input_string = file_get_contents($str);//getting file contents
$input_array = explode("\n",$input_string);
$months=array("Jan"=>01,"Feb"=>02,"Mar"=>03,"Apr"=>04,"May"=>05,"Jun"=>06,"Jul"=>07,"Aug"=>8,"Sep"=>9,"Oct"=>10,"Nov"=>11,"Dec"=>12); 

mysql_query("create table logcomm_nodes(Time varchar(10), Node int, topic varchar(20))");
for($i=0; $i < sizeof($input_array)-1; $i++) {

	$entry = explode(", ",substr($input_array[$i],24));
	$date = explode(" ",substr($entry[0],0));
	$nodes = explode("-",substr($entry[1],0));
	$time = $date[5]. "-" .$months[$date[1]]. "-" . $date[2];
	//echo $date[0]. " " . $time . " " . $nodes[0]. " ".$nodes[1]. " " . $entry[2]. " "."<br/>";
	mysql_query("INSERT INTO logcomm_nodes(Time, Node ,topic) VALUES ( '$time', $nodes[0] ,'$entry[2]' )");//creating a temporary table
	mysql_query("INSERT INTO logcomm_nodes(Time, Node ,topic) VALUES ( '$time', $nodes[1] ,'$entry[2]' )");// inserting into temporary table
}
mysql_query("create table daily_interaction(Time varchar(10), Node int, count int)");
mysql_query("insert into daily_interaction SELECT Time, Node, count(*) FROM `logcomm_nodes` GROUP BY Time, Node");//creating the final table that 			
																												//contains node wise daily data 
mysql_query("drop table logcomm_nodes");//drop the temporary table

mysql_close($con);
?> 
</body>
</html> 