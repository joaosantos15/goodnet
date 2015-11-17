<?php  
/* CAT:Bar Chart */

 session_start();

 $latNOS=$_SESSION['latNOS'];
 $latMEO=$_SESSION['latMEO'];
 $latOPT=$_SESSION['latOPT'];
 $operators=$_SESSION['operator'];

 $operators=array_unique($operators);

 /* Create and populate the pData object */
 $MyData = new pData();
 if($latNOS !=null ){
 	$MyData->addPoints($latNOS);
 }
 
 if($latOPT !=null ){
 	$MyData->addPoints($latOPT);
 }

 if($latMEO !=null ){
 	$MyData->addPoints($latMEO);
 }

 $MyData->addPoints($operators,"Rators");
 $MyData->setAxisName(0,"ms");
 $MyData->setSerieDescription("Rators","Rator");
 $MyData->setAbscissa("Rators");

 /* Will replace the whole color scheme by the "light" palette */
 $MyData->loadPalette("pChart/palettes/light.color", TRUE);

 /* Create the pChart object */
 $myPicture = new pImage(700,230,$MyData);

 /* Turn of Antialiasing */
 $myPicture->Antialias = FALSE;

 /* Add a border to the picture */
 $myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0));

 /* Set the default font */
 $myPicture->setFontProperties(array("FontName"=>"pChart/fonts/verdana.ttf","FontSize"=>13));
 $myPicture->drawText(350,30,"Latency per Operator",array("FontSize"=>15,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

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
 $myPicture->render("latencyPP.png");
     
?>  