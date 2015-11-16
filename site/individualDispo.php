<?php 

session_start();

$uptime=$_SESSION['upTime'];
$downtime=$_SESSION['downTime'];
$Time =$_SESSION['nTimes'];


for ($i = 0; $i < $Time; $i++) {
     $upset[$i] = $uptime[$i]/10;
     $downset[$i]= $downtime[$i]/10;
     $x[$i]=$x[$i-1]+10; // 10 em 10 min = FREQUENCY OF THE LOGS
 }


$myPowersData = new pData();
$myPowersData->addPoints($upset,"Uptime");
$myPowersData->setSerieOnAxis("Uptime",0);
$myPowersData->setAxisName(0,"Uptime/Downtime");

$myPowersData->addPoints($downset,"Downtime");
$myPowersData->setSerieOnAxis("Downtime",0);


/* Bind a data serie to the X axis */
$myPowersData->addPoints($x,"Times");
$myPowersData->setSerieDescription("Times","Minutes");
$myPowersData->setAbscissa("Times");
$myPowersData->setAbscissaName("Minutes");

$myPowersData->setPalette("Uptime",
    array("R" => 16,"G" => 252, "B" =>16, "Alpha" => 100));
$myPowersData->setPalette("Downtime",
    array("R" => 240,"G" => 16, "B" =>16, "Alpha" => 100));

$myPowersImage = new pImage(500,300, $myPowersData);


$myPowersImage->setFontProperties(array("FontName"=>"pChart/fonts/verdana.ttf","FontSize"=>13));
$myPowersImage->drawText(250,30,"Uptime & Downtime",array("FontSize"=>15,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

/* Turn of Antialiasing */
$myPowersImage->Antialias = FALSE;

$myPowersImage->setGraphArea(65,40, 460,250);
$scaleSettings = array("Mode"=>SCALE_MODE_MANUAL,"ManualScale"=>array(0=>array("Min"=>0,"Max"=>1)),"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
$myPowersImage->drawScale($scaleSettings);


$myPowersImage->drawLineChart();

/* Turn on shadow computing */ 
$myPowersImage->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

/* Draw the chart */
$myPowersImage->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
$settings = array("Gradient"=>TRUE,"GradientMode"=>GRADIENT_EFFECT_CAN,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);

/* Render the picture (choose the best way) */
 $myPowersImage->render("sDispo.png");

?>