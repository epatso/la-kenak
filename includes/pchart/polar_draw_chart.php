<?php

	date_default_timezone_set('Europe/Athens');
	$today = date("d.m.Y-H:i:s");

 /* Create and populate the pData object */
 $MyData1 = new pData();   
 $MyData1->addPoints($array_sun,"Ηλιακό ύψος"); 
 //$MyData1->addPoints(array(20,40,50,12,10,30,40,50,60),"ScoreB"); 
 $MyData1->setSerieDescription("Ηλιακό ύψος","Ηλιακό ύψος");
 //$MyData1->setSerieDescription("ScoreB","Coverage B");

 /* Define the absissa serie */
 $MyData1->addPoints($array_azi,"Coord");
 $MyData1->setAbscissa("Coord");

 /* Create the pChart object */
 $MyPicture1 = new pImage(700,230,$MyData1);

 /* Draw a solid background */
 $Settings1 = array("R"=>179, "G"=>217, "B"=>91, "Dash"=>1, "DashR"=>199, "DashG"=>237, "DashB"=>111);
 $MyPicture1->drawFilledRectangle(0,0,700,230,$Settings1);

 /* Overlay some gradient areas */
 $Settings1 = array("StartR"=>194, "StartG"=>231, "StartB"=>44, "EndR"=>43, "EndG"=>107, "EndB"=>58, "Alpha"=>50);
 $MyPicture1->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,$Settings1);
 $MyPicture1->drawGradientArea(0,0,700,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>100));

 /* Add a border to the picture */
 $MyPicture1->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0));

 /* Write the picture title */ 
 $MyPicture1->setFontProperties(array("FontName"=>"includes/pchart/fonts/calibri.ttf","FontSize"=>10));
 $MyPicture1->drawText(10,13,"Ωριαίο ύψος/αζιμούθιο - Σήμερα $today",array("R"=>255,"G"=>255,"B"=>255));

 /* Set the default font properties */ 
 $MyPicture1->setFontProperties(array("FontName"=>"includes/pchart/fonts/calibri.ttf","FontSize"=>10,"R"=>80,"G"=>80,"B"=>80));

 /* Enable shadow computing */ 
 $MyPicture1->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

 /* Create the pRadar object */ 
 $SplitChart = new pRadar();

 /* Draw a polar chart */ 
 $MyPicture1->setGraphArea(10,25,340,225);
 $Options1 = array("BackgroundGradient"=>array("StartR"=>255,"StartG"=>255,"StartB"=>255,"StartAlpha"=>100,"EndR"=>207,"EndG"=>227,"EndB"=>125,"EndAlpha"=>50), "FontName"=>"includes/pchart/fonts/calibri.ttf","FontSize"=>6);
 $SplitChart->drawPolar($MyPicture1,$MyData1,$Options1);

 /* Draw a polar chart */ 
 $MyPicture1->setGraphArea(350,25,690,225);
 $Options = array("LabelPos"=>RADAR_LABELS_HORIZONTAL,"BackgroundGradient"=>array("StartR"=>255,"StartG"=>255,"StartB"=>255,"StartAlpha"=>50,"EndR"=>32,"EndG"=>109,"EndB"=>174,"EndAlpha"=>30),"AxisRotation"=>0,"DrawPoly"=>TRUE,"PolyAlpha"=>50, "FontName"=>"includes/pchart/fonts/calibri.ttf","FontSize"=>6);
 $SplitChart->drawPolar($MyPicture1,$MyData1,$Options);

 /* Write the chart legend */ 
 $MyPicture1->setFontProperties(array("FontName"=>"includes/pchart/fonts/calibri.ttf","FontSize"=>6));
 $MyPicture1->drawLegend(270,205,array("Style"=>LEGEND_BOX,"Mode"=>LEGEND_HORIZONTAL));

 /* Render the picture (choose the best way) */
 imagePNG ($MyPicture1->render("includes/PDF/polar_sunpath.png"));
?>