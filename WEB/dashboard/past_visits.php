<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Dashboard | Team Brisingr</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
   
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <!-- BEGIN: load jqplot -->
    <link rel="stylesheet" type="text/css" href="css/jquery.jqplot.min.css" />
    <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="js/jqPlot/excanvas.min.js"></script><![endif]-->
    <script language="javascript" type="text/javascript" src="js/jqPlot/jquery.jqplot.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.barRenderer.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.pieRenderer.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.highlighter.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.pointLabels.min.js"></script>
    <!-- END: load jqplot -->
    <script src="js/setup.js" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            setupDashboardChart('chart1');
            setupLeftMenu();
			setSidebarHeight();


        });
    </script>
    
    
    
    
 <!---------------------------------------script begins--------------------------------------------------------------------------------------->   
    
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="jquery-1.6.2.min.js"></script>
<script type="text/javascript">
    
    google.load("visualization", "1", {packages:["annotatedtimeline"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable(
<?php
$username = "vaibhav";
$password = "7140";
$host = "localhost";
$db = "stud";
$link = mysql_connect($host,$username,$password);//connecting with the database
mysql_select_db($db,$link);
$node = "0";
$node = $_REQUEST['t1'];// the selected node i.e the node that has logged in
$res = mysql_query("select * from daily_interaction where Node = $node");// selecting data corresponding to that node
$rows = mysql_num_rows($res);
$columns = mysql_num_fields($res);

//datatable is the string that contains the array data to be fed into the google charts
$dataTable = "{'cols':[{'type':'date','label':'Date'},{'type':'number','label':'count'}],'rows':[";
$prev = mysql_fetch_row($res);	
//feeding into datatable
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
    
    
<!-----------------------------------------------------------script ends---------------------------------------------------------------------->
    
    
    
    
    
</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft">
                    <img src="img/logo.png" alt="Logo" /></div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello Admin</li>
                            <li><a href="#">Config</a></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                        <br />
                        <span class="small grey">Last Login: 3 hours ago</span>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="dashboard2.php"><span>Dashboard</span></a> </li>
				<li class="ic-charts"><a href="charts.html"><span>Charts & Graphs</span></a></li>
                <li class="ic-grid-tables"><a href="table.html"><span>Data Table</span></a></li>
                <li class="ic-gallery dd"><a href="javascript:"><span>Image Galleries</span></a>
               		 <ul>
                        <li><a href="image-gallery.html">Pretty Photo</a> </li>
                        <li><a href="gallery-with-filter.html">Gallery with Filter</a> </li>
                    </ul>
                </li>
                <li class="ic-form-style"><a href="typography.html"><span>Typography</span></a></li>
                <li class="ic-notifications"><a href="notifications.html"><span>Notifications</span></a></li>

            </ul>
        </div>
        <div class="clear">
        </div>
        <div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">
                        <li><a class="menuitem">Graphs And Charts</a>
                            <ul class="submenu">
                                <li><a href = "dashboard2.php">Net Interaction</a> </li>
                                <li><a href = "topic_trends.php">Topic-wise trends</a> </li>
                              	<li><a href = "topic_motion.php">Topic-wise comparison</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Menu 2</a>
                            <ul class="Visualizations">
                                <li><a>Social Network</a> </li>
                                <li><a>Topic-wise spread</a> </li>
                                <li><a href = "top_topics.php">Top Topics</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Menu 3</a>
                            <ul class="Tables and Data">
                                <li><a href = "heirarchial.php">Hierarchical Filter</a> </li>
                                <li><a href = "table.html">Table 1</a> </li>
                                <li><a>Table 2</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Menu 4</a>
                            <ul class="Animations">
                                <li><a>Clusters</a> </li>
                                <li><a href = "motion-chart.php">Motion Charts</a> </li>
                                <li><a href = "past_visits.php">Time Graph</a> </li>                    
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="grid_10">
            <div class="box round first">
                <h2>
                                        
                    
                    
                    
    <!-----------------------------------------------------node picking code here----------------------------------------------------->                
                    
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css" />
    <script>
    $(function() {
        $( "#from" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            onClose: function( selectedDate ) {
                $( "#to" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $( "#to" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3,
            onClose: function( selectedDate ) {
                $( "#from" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    });
    </script>
<form action="past_visits.php" method="post">
<input name="t1" type="text"/>
<input type="submit" name="s1" value="Get Data" class="btn btn-navy"/>
</form>
                    
                    
     <!-----------------------------------------------node picking ending-------------------------------------------------------------->                
                    
                    
                    
                    <br/>
                    <br/>
                	Your past visits and interaction:
                    </h2>
					<div class="block">
                    <div id='chart_div' style='width: 1050px; height: 320px;'></div>
                    </div>
                </div>
            </div>
            <div class="box round">
                <h2>
                    Friend Suggestions</h2>
                <div class="block">
                    <div class="stat-col">
                        <span>Suggested Friend 1</span>
                        <p class="purple">
                            <?php
							$username = "vaibhav";
							$password = "7140";
							$host = "localhost";
							$db = "stud";
							$link = mysql_connect($host,$username,$password);//connecting with the database
							mysql_select_db($db,$link);
							$node = $_REQUEST['t1'];
							$res = mysql_query("select * from friends where node = $node");
							$rows = mysql_fetch_row($res);
							echo $rows[1];
							?></p>
                    </div>
                    <div class="stat-col">
                        <span>Suggested Friend 2</span>
                        <p class="yellow">
                            <?php
							$username = "vaibhav";
							$password = "7140";
							$host = "localhost";
							$db = "stud";
							$link = mysql_connect($host,$username,$password);//connecting with the database
							mysql_select_db($db,$link);
							$node = $_REQUEST['t1'];
							$res = mysql_query("select * from friends where node = $node");
							$rows = mysql_fetch_row($res);
							echo $rows[3];
							?></p>
                    </div>
                    
                    
                    <!---<div class="stat-col last">
                        <span>----------</span>
                        <p class="darkblue">
                            -----------</p>
                    </div>--->
                    <div class="clear">
                    </div>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <div id="site_info">
        <p>
            Copyright <a href="#">Brisingr Admin</a>. All Rights Reserved.
        </p>
    </div>
</body>
</html>















