<?php 

session_start();    
     
$band=$_SESSION['bandwidth'];
$Time=$_SESSION['nTimes'];


for ($i = 0; $i < $Time; $i++) {
     $bandset[$i] = $band[$i];
     $x[$i]=$x[$i-1]+10; // 10 em 10 min = FREQUENCY OF THE LOGS
 }


$myPowersData = new pData();
$myPowersData->addPoints($bandset,"Band");
$myPowersData->setSerieOnAxis("Band",0);
$myPowersData->setAxisName(0,"Bandwidth");


/* Bind a data serie to the X axis */
$myPowersData->addPoints($x,"Times");
$myPowersData->setSerieDescription("Times","Minutes");
$myPowersData->setAbscissa("Times");
$myPowersData->setAbscissaName("Minutes");

$myPowersData->setPalette("Band",
    array("R" => 32,"G" => 16, "B" =>256, "Alpha" => 100));


$myPowersImage = new pImage(500,300, $myPowersData);


$myPowersImage->setFontProperties(array("FontName"=>"pChart/fonts/verdana.ttf","FontSize"=>13));
$myPowersImage->drawText(250,30,"Bandwidth",array("FontSize"=>15,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

/* Turn of Antialiasing */
$myPowersImage->Antialias = FALSE;

$myPowersImage->setGraphArea(65,40, 460,250);
$scaleSettings = array("GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE,"Mode"=>SCALE_MODE_START0);
$myPowersImage->drawScale($scaleSettings);


$myPowersImage->drawLineChart();

/* Turn on shadow computing */ 
$myPowersImage->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

/* Draw the chart */
$myPowersImage->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
$settings = array("Gradient"=>TRUE,"GradientMode"=>GRADIENT_EFFECT_CAN,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);

/* Render the picture (choose the best way) */
 $myPowersImage->render("sBand.png");

?>