<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="data/d3.v2.js"></script>
<style>
text {
  font: 10px sans-serif;
}
</style>
</head>

<body>
<div id="chart"></div>
<?php
$file = fopen("data/data3.json","w");
$username = "brisingr";
$password = "7140";
$host = "localhost";
$db = "assignment3";
$link = mysql_connect($host,$username,$password);
mysql_select_db($db,$link);
$res = mysql_query("select * from topic_logs order by count desc");


fwrite($file,"{
 \"name\": \"flare\",
 \"children\": [");
$i = 1;
//topmost topic
fwrite($file,"{\"name\": \"Topmost\" , \"children\": [");
$prev = mysql_fetch_row($res);
$row = trim($prev[0]);
fwrite($file,"{\"name\": \"$row\", \"size\": ".$prev[1]."}]},");
//top 10 topics
$prev = mysql_fetch_row($res);
fwrite($file,"{\"name\": \"Top10\" , \"children\": [");
while($i < 10){
	$rows = mysql_fetch_row($res);
	$row = trim($prev[0]);
	fwrite($file,"{\"name\": \"$row\", \"size\": ".$prev[1]."},");
	$prev = $rows;
	$i++;
	}
	$row = trim($prev[0]);
	fwrite($file,"{\"name\": \"$row\", \"size\": ".$prev[1]."}]},");
$prev = mysql_fetch_row($res);
//remaining topics
fwrite($file,"{\"name\": \"Other\" , \"children\": [");
while($rows = mysql_fetch_row($res)){
	//$rows = mysql_fetch_row($res);
	$row = trim($prev[0]);
	fwrite($file,"{\"name\": \"$row\", \"size\": ".$prev[1]."},");
	$prev = $rows;
	$i++;
	}
	$row = trim($prev[0]);
	fwrite($file,"{\"name\": \"$row\", \"size\": ".$prev[1]."}]}]}");
mysql_close($link);
fclose($file);
?>
<script>
var r = 960,
    format = d3.format(",d"),
    fill = d3.scale.category20c();

var bubble = d3.layout.pack()
    .sort(null)
    .size([r, r])
    .padding(1.5);

var vis = d3.select("#chart").append("svg")
    .attr("width", r)
    .attr("height", r)
    .attr("class", "bubble");

d3.json("data/data3.json", function(json) {
  var node = vis.selectAll("g.node")
      .data(bubble.nodes(classes(json))
      .filter(function(d) { return !d.children; }))
    .enter().append("g")
      .attr("class", "node")
      .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });

  node.append("title")
      .text(function(d) { return d.className + ": " + format(d.value); });

  node.append("circle")
      .attr("r", function(d) { return d.r; })
      .style("fill", function(d) { return fill(d.packageName); });

  node.append("text")
      .attr("text-anchor", "middle")
      .attr("dy", ".3em")
      .text(function(d) { return d.className.substring(0, d.r / 3); });
});

// Returns a flattened hierarchy containing all leaf nodes under the root.
function classes(root) {
  var classes = [];

  function recurse(name, node) {
    if (node.children) node.children.forEach(function(child) { recurse(node.name, child); });
    else classes.push({packageName: name, className: node.name, value: node.size});
  }

  recurse(null, root);
  return {children: classes};
}
</script>
</body>
</html>
