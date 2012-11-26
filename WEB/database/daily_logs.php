<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="jquery-1.6.2.min.js"></script>
    <script type="text/javascript">
    
    google.load("visualization", "1", {packages:["annotatedtimeline"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable(
<?php
$username = "brisingr";
$password = "7140";
$host = "localhost";
$db = "assignment3";
$link = mysql_connect($host,$username,$password);//connecting with the database
mysql_select_db($db,$link);
$res = mysql_query("select * from daily_logs");
$rows = mysql_num_rows($res);
$columns = mysql_num_fields($res);
$dataTable = "{'cols':[{'type':'date','label':'Date'},{'type':'number','label':'count'}],'rows':[";
$prev = mysql_fetch_row($res);	
while($rows = mysql_fetch_row($res)){
	$date = explode("-",$rows[0]);
	$date_prev = explode("-",$prev[0]);
	if($date_prev[2] == $date[2]){
		$rows[2] = $rows[2] + $prev[2];
		$prev = $rows;
		}else{
			$dataTable = $dataTable."{'c':[{'v': new Date(".$date_prev[0].",".($date_prev[1]-1).",".$date_prev[2].")},{'v':".$prev[2]."}]},";
			$prev = $rows;
			}
	}
$date_prev = explode("-",$prev[0]);
$dataTable = $dataTable."{'c':[{'v': new Date(".$date_prev[0].",".($date_prev[1]-1).",".$date_prev[2].")},{'v':".$prev[2]."}]}";
mysql_close($link); 
$dataTable = $dataTable."]}";
$table = $dataTable;
echo $table; 
?>
);  
var chart = new google.visualization.AnnotatedTimeLine(document.getElementById('chart_div'));
        chart.draw(data, {
			thickness: 2,
			displayAnnotations: true
			});
      }
</script>
</head>
<body>
<div id='chart_div' style='width: 700px; height: 240px;'></div>
</body>
</html>