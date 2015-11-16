<?php

 session_start();

 $uptime=$_SESSION['upTime'];
 $downtime=$_SESSION['downTime'];
 $nClients =$_SESSION['nClients'];
 
 for ($i = 0; $i < $nClients; $i++) {
	 $dispo[$i]=$uptime[$i]/($uptime[$i]+$downtime[$i]);
	 $newdisp[$i]=round($dispo[$i],4,PHP_ROUND_HALF_UP);
	 $cli[$i]=$i+1;
 }

 /* Create and populate the pData object */
 $MyData = new pData();
 

echo 'hi:' .$newdisp[0]. '<br/>';


 $MyData->addPoints($newdisp);
 $MyData->addPoints($cli,"Clis");
 $MyData->setAxisName(0,"%");
 $MyData->setSerieDescription("Clis","Cli");
 $MyData->setAbscissa("Clis");

 /* Will replace the whole color scheme by the "light" palette */
 $MyData->loadPalette("pChart/palettes/spring.color", TRUE);

 /* Create the pChart object */
 $myPicture = new pImage(700,230,$MyData);

 /* Turn of Antialiasing */
 $myPicture->Antialias = FALSE;

 /* Add a border to the picture */
 $myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0));

 /* Set the default font */
 $myPicture->setFontProperties(array("FontName"=>"pChart/fonts/verdana.ttf","FontSize"=>13));
 $myPicture->drawText(350,30,"Availability per Client",array("FontSize"=>15,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

 /* Define the chart area */
 $myPicture->setGraphArea(90,40,650,200);

 /* Draw the scale */
 $scaleSettings = array("Mode"=>SCALE_MODE_MANUAL,"ManualScale"=>array(0=>array("Min"=>0,"Max"=>1)),"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
 $myPicture->drawScale($scaleSettings);

 /* Turn on shadow computing */ 
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

 /*Draw Treshhold*/
 $myPicture->drawThreshold(0.95,array("Alpha"=>70,"NoMargin"=>TRUE,"Ticks"=>4,"R"=>0,"G"=>0,"B"=>255));

 /* Draw the chart */
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
 $settings = array("DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
 $myPicture->drawBarChart($settings);

 /* Render the picture (choose the best way) */
 $myPicture->render("dispo.png");
     
?>  