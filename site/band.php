<?php  
/* CAT:Bar Chart */

 session_start();    
     
 $band=$_SESSION['bandwidth'];
 $clients=$_SESSION['nClients'];

 for ($i = 0; $i < $clients; $i++) {
     $bandset[$i] = $band[$i];
     $IDs[$i]=$i+1;
 }
 
 /* Create and populate the pData object */
 $MyData = new pData();  
 $MyData->addPoints($bandset);
 $MyData->addPoints($IDs,"Bs");
 $MyData->setAxisName(0,"MB/s");
 $MyData->setSerieDescription("Bs","B");
 $MyData->setAbscissa("Bs");

 /* Will replace the whole color scheme by the "shade" palette */
 $MyData->loadPalette("pChart/palettes/autumn.color", TRUE);

 /* Create the pChart object */
 $myPicture = new pImage(700,230,$MyData);

 /* Turn of Antialiasing */
 $myPicture->Antialias = FALSE;

 /* Add a border to the picture */
 $myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0));

 /* Set the default font */
 $myPicture->setFontProperties(array("FontName"=>"pChart/fonts/verdana.ttf","FontSize"=>13));
 $myPicture->drawText(350,30,"Bandwidth per Client",array("FontSize"=>15,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

 /* Define the chart area */
 $myPicture->setGraphArea(90,40,650,200);

 /* Draw the scale */
 $scaleSettings = array("GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE,"Mode"=>SCALE_MODE_START0);
 $myPicture->drawScale($scaleSettings);

 /* Turn on shadow computing */ 
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

 /* Draw the chart */
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
 $settings = array("Gradient"=>TRUE,"GradientMode"=>GRADIENT_EFFECT_CAN,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
 $myPicture->drawBarChart();

 /* Render the picture (choose the best way) */
 $myPicture->render("band.png");
     

?>  