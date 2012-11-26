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
    
    
    
 <!-------------------------------------------------script starts--------------------------------------------------------->   
    
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="jquery-1.6.2.min.js"></script>
    <script type="text/javascript">
    
    google.load("visualization", "1", {packages:["table"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable(
<?php
$username = "brisingr";
$password = "7140";
$host = "localhost";
$db = "assignment3";
$link = mysql_connect($host,$username,$password);
mysql_select_db($db,$link);
$res = mysql_query("select * from topic_trend");
$rows = mysql_num_rows($res);
$columns = mysql_num_fields($res);
//printing the heirarchial filter
$dataTable = "{'cols':[{'type':'string','label':'Topic'},{'type':'number','label':'Day1'},{'type':'number','label':'Day2'},{'type':'number','label':'Day3'},{'type':'number','label':'Day4'},{'type':'number','label':'Day5'},{'type':'number','label':'Day6'},{'type':'number','label':'Day7'},{'type':'number','label':'Week2'},{'type':'number','label':'Week3'},{'type':'number','label':'Week4'},{'type':'number','label':'Month2'},{'type':'number','label':'Month3'},{'type':'number','label':'Month4'},{'type':'number','label':'Quater2'},{'type':'number','label':'Quater3'}],'rows':[";	
while($rows = mysql_fetch_row($res)){
	//datatabkle is the string that feed the data to the google charts
	$topic = trim($rows[0]);
	$dataTable = $dataTable."{'c':[{'v':'".$topic."'},{'v':".$rows[1]."},{'v':".$rows[2]."},{'v':".$rows[3]."},{'v':".$rows[4]."},{'v':".$rows[5]."},{'v':".$rows[6]."},{'v':".$rows[7]."},{'v':".$rows[8]."},{'v':".$rows[9]."},{'v':".$rows[10]."},{'v':".$rows[11]."},{'v':".$rows[12]."},{'v':".$rows[13]."},{'v':".$rows[14]."},{'v':".$rows[15]."}]},";
	}

mysql_close($link); 
$dataTable = $dataTable."]}";
$table = $dataTable;
echo $table; 
?>
);  
var chart = new google.visualization.Table(document.getElementById('chart_div'));
chart.draw(data, {page:'enable',pageSize:25,width:1045,height:800});
      }

    </script>
    
<!------------------------------------------------script ends here------------------------------------------------------------------->
    
    
    
    
    
    
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
                                <li><a href = "map2.php">Social Network (Map View)</a> </li>
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
                                <li><a href = "mashup/sanatproject.html">Clusters (Mashup)</a> </li>
                                <li><a>Motion Charts</a> </li>
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
                                        
                    
                    
                    
    <!--------------------------------------Date picking code here---------------------------------->                
                    
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
                    
                    
     <!------------------------------------------date picking ending-------------------------------------->                
                    
                    
                    
                    
                	<br/>
                    <br/>
                	Hierarchial filter data structure:
                    </h2>
					<div class="block">
                    <div id='chart_div' style='width: 1045px; height: 700px;'></div>
                    </div>
                </div>
            </div>
            
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


















