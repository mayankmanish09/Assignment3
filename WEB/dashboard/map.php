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
                                        
                    
                    
                    
    <!--------------------------------Date picking code here-------------------------------------------------------------------------------------->                
                    
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
    <form action = "map.php" method = "post"><b>Select Month for Month-wise data:</b>    
	<select name=select2 id="s1">			
	<option>Oct</option>
	<option>Nov</option>
    <option>Dec</option>
    <option>Jan</option>
    <option>Feb</option>
    <option>Mar</option>
    <option>Apr</option>
    <option>May</option>
    <option>Jun</option>
	</select>
    <input type = "submit" name = "s2"></input>
	</form>
                    
                    
     <!--------------------------------------------date picking ending---------------------------------------------------------------------------->                
                    
                    
                    
                    <br/>
                    <br/>
                	
                    <!--------------------------------------------Google Charts------------------------------------------------------------------------------------->    
    
    <?php
$year = $_REQUEST['select2'];
if($year=='Oct'){
	 $p = 1976;
	 }else if($year =='Nov'){
	 $p = 1977;
	  }else if($year == 'Dec'){
	  $p = 1978;
	  }else if($year == 'Jan'){
	  $p = 1979;
	  }else if($year == 'Feb'){
	  $p = 1980;
	  }else if($year == 'Mar'){
	  $p = 1981;
	  }else if($year == 'Apr'){
	  $p = 1982;
	  }else if($year == 'May'){
	  $p = 1983;
	  }else if($year == 'Jun'){
	  $p = 1984;
	  }
echo "Total Interaction Per Month between Locations in the month ".$year."
                    </h2>
					<div class=\"block\"><iframe src = \"map.html?year=".$p."\" width = \"1000\" height = \"600\" name=\"myframe\"></iframe>";
?>
    
<!--------------------------------------------------End of the script-------------------------------------------------------------------------->
                    </div>
                </div>
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
