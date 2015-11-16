
<?php
/* pChart library inclusions */
include("pChart/class/pPie.class.php");

session_start();    
     
$downtime=$_SESSION['downTime'];
$uptime=$_SESSION['upTime'];

$totalUptime=array_sum($uptime);
$totalDowntime=array_sum($downtime);


/* Create and populate the pData object */
$MyData = new pData();   
$MyData->addPoints(array($totalDowntime,$totalUptime),"ScoreA");  
$MyData->setSerieDescription("ScoreA","Application A");

/* Define the absissa serie */
$MyData->addPoints(array($totalDowntime,$totalUptime),"lol");
$MyData->addPoints(array("Downtime","Uptime"),"Labels");
$MyData->setAbscissa("Labels");

/* Create the pChart object */
$myPicture = new pImage(300,260,$MyData);

/* Overlay with a gradient */
$Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);
$myPicture->drawGradientArea(0,0,300,260,DIRECTION_VERTICAL,$Settings);

/* Write the picture title */ 
$myPicture->setFontProperties(array("FontName"=>"pChart/fonts/verdana.ttf","FontSize"=>13));
$myPicture->drawText(150,24,"Availability",array("FontSize"=>15,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

/* Set the default font properties */ 
$myPicture->setFontProperties(array("FontName"=>"pChart/fonts/verdana.ttf","FontSize"=>10,"R"=>80,"G"=>80,"B"=>80));

/* Create the pPie object */ 
$PieChart = new pPie($myPicture,$MyData);

/* Draw an AA pie chart */ 
$PieChart->draw3DPie(145,160,array("WriteValues"=>TRUE,"ValueG"=>16,"ValueB"=>16,"ValueR"=>16,"Radius"=>80,"DrawLabels"=>TRUE,"Border"=>TRUE));

/* Write the legend box */ 
$myPicture->setShadow(FALSE);
$PieChart->drawPieLegend(15,40,array("Alpha"=>20));

/* Render the picture (choose the best way) */
$myPicture->render("sDowntime.png");
?>