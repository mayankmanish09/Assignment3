<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

set_time_limit(-1); 
$con = mysql_connect("localhost","brisingr","7140");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  
mysql_select_db("assignment3", $con);			//connecting with the database

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
	mysql_query("INSERT INTO logcomm(Time, Day ,topic) VALUES ( '$yyyymmdd', '$date[0]' ,'$entry[2]' )");	//inserting into the temporary table
	
}

mysql_query("create table topic_temp2(Time varchar(10), Topic varchar(20), count int)");	//creating another temporary table
mysql_query("create table topic_trend(Topic varchar(20), Day1 int, Day2 int, Day3 int, Day4 int, Day5 int, Day6 int, Day7 int, Week2 int, Week3 int, Week4 int, Month2 int, Month3 int, Month4 int, Quater2 int, Quater3 int)");		//creating the hierarchial table
mysql_query("insert into topic_temp2 SELECT Time, Topic, count(*) FROM `logcomm` GROUP BY Time, Topic");//grouping on the basis of time and topic

$res = mysql_query("select * from topic_temp2 order by Time asc");
$date = "2012-10-12";
$date = file_get_contents("date.txt");							//reading the last date whose dat has been entered into the table

	while($rows = mysql_fetch_row($res)){ 
	if($rows[0] == $date){//till we have the same date keep inserting in the first column
		$whether_exist = mysql_query("select * from topic_trend where Topic like '".$rows[1]."'");
		if(is_resource($whether_exist) && mysql_num_rows($whether_exist) > 0){
		$new = $rows[2];
		mysql_query("update topic_trend set Day1 = $new where Topic like '".$rows[1]."'");//if the topic is repeated upadate the value
		}else{
			mysql_query("insert into topic_trend(Topic, Day1, Day2, Day3, Day4, Day5, Day6, Day7, Week2, Week3, Week4, Month2, Month3, Month4, Quater2, Quater3) value('$rows[1]', $rows[2],0,0,0,0,0,0,0,0,0,0,0,0,0,0)");	//else insert the value
			}
		}else{			//date is different
						//we need to shift the values to the right
			$date = $rows[0];
			$res2 = mysql_query("select * from topic_trend");
			while($rows2 = mysql_fetch_row($res2)){
				//new values of the columns
				$day1 = $rows[2];
				$day2 = $rows2[1];
				$day3 = $rows2[2];
				$day4 = $rows2[3];
				$day5 = $rows2[4];
				$day6 = $rows2[5];
				$day7 = $rows2[6];
				$week2 = $rows2[7] + (6*$rows2[8]/7);
				$week3 = $rows2[8]/7 + (6*$rows2[9]/7);
				$week4 = $rows2[9]/7 + (6*$rows2[10]/7);
				$month2 = $rows2[10]/7+29*$rows2[11]/30;
				$month3 = $rows2[11]/30+29*$rows2[12]/30;
				$month4 = $rows2[12]/30+29*$rows2[13]/30;
				$quater2 = $rows2[13]/30+119*$rows2[14]/120;
				$quater3 = $rows2[14]/120+119*$rows2[15]/120;
				if($rows2[0] == $rows[1]){
					mysql_query("UPDATE topic_trend SET Day1 = $day1, Day2 = $day2, Day3 = $day3, Day4 = $day4, Day5 = $day5, Day6 = $day6, Day7 = $day7, Week2 = $week2, Week3 = $week3, Week4 = $week4, Month2 = $month2, Month3 = $month3, Month4 = $month4, Quater2 = $quater2, Quater3 = $quater3 WHERE Topic like '".$rows[1]."' ");	//update the values if the row under consideration has the same topic
					}else{
					mysql_query("UPDATE topic_trend SET Day1 = 0, Day2 = $day2, Day3 = $day3, Day4 = $day4, Day5 = $day5, Day6 = $day6, Day7 = $day7, Week2 = $week2, Week3 = $week3, Week4 = $week4, Month2 = $month2, Month3 = $month3, Month4 = $month4, Quater2 = $quater2, Quater3 = $quater3 WHERE Topic like '".$rows2[0]."'");	//update the values if the row under consideration has different topic
						}
				}
		$whether_exist = mysql_query("select * from topic_trend where Topic like '".$rows[1]."'");
		if(is_resource($whether_exist) && mysql_num_rows($whether_exist) > 0){
		}else{
			mysql_query("insert into topic_trend(Topic, Day1, Day2, Day3, Day4, Day5, Day6, Day7, Week2, Week3, Week4, Month2, Month3, Month4, Quater2, Quater3) value('$rows[1]', $rows[2],0,0,0,0,0,0,0,0,0,0,0,0,0,0)");	//insert a new topic
			}
			}	 
	}

$f = fopen('date.txt', 'w');
fwrite($f, $date);
mysql_query("delete from logcomm");
mysql_query("drop table topic_temp2");
//mysql_query("delete from topic_trend");

$file = fopen('pointer.txt', 'w');
$input = $input+1;
fwrite($file, $input);

?>
</body>
</html>