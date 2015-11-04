<?php  
/* CAT:Bar Chart */

 /* pChart library inclusions */
 include("pChart/class/pData.class.php");
 include("pChart/class/pDraw.class.php");
 include("pChart/class/pImage.class.php");

 session_start();    
     
 $latency=$_SESSION['latency'];
 $clients=$_SESSION['nClients'];

 for ($i = 0; $i < $clients; $i++) {
     $latset[$i] = $latency[$i];
     $id[$i]=$i+1;
 }

 
 /* Create and populate the pData object */
 $MyData = new pData();  
 $MyData->addPoints($latset);
 $MyData->addPoints($id,"IDs");
 $MyData->setAxisName(0,"Latency");
 $MyData->setSerieDescription("IDs","ID");
 $MyData->setAbscissa("IDs");

 /* Create the pChart object */
 $myPicture = new pImage(700,230,$MyData);

 /* Turn of Antialiasing */
 $myPicture->Antialias = FALSE;

 /* Add a border to the picture */
 $myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0));

 /* Set the default font */
 $myPicture->setFontProperties(array("FontName"=>"pChart/fonts/pf_arma_five.ttf","FontSize"=>13));

 /* Define the chart area */
 $myPicture->setGraphArea(90,40,650,200);

 /* Draw the scale */
 $scaleSettings = array("GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE,"Mode"=>SCALE_MODE_START0);
 $myPicture->drawScale($scaleSettings);


 /* Write the chart legend */
 //$myPicture->drawLegend(550,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

 /* Turn on shadow computing */ 
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

 /* Draw the chart */
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
 $settings = array("Gradient"=>TRUE,"GradientMode"=>GRADIENT_EFFECT_CAN,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
 $myPicture->drawBarChart();

 /* Render the picture (choose the best way) */
 $myPicture->render("latency.png");
     

?>  