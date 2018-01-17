<?php   
 /* CAT:Bar Chart */

 /* Create and populate the pData object */
 $MyData = new pData();  
 
 $chart_znx_iliaka = array(number_format(${"pososto_iliaka_jan".$z}*100,2,".",","),number_format(${"pososto_iliaka_feb".$z}*100,2,".",","),
 number_format(${"pososto_iliaka_mar".$z}*100,2,".",","),number_format(${"pososto_iliaka_apr".$z}*100,2,".",","),
 number_format(${"pososto_iliaka_may".$z}*100,2,".",","),number_format(${"pososto_iliaka_jun".$z}*100,2,".",","),
 number_format(${"pososto_iliaka_jul".$z}*100,2,".",","),number_format(${"pososto_iliaka_aug".$z}*100,2,".",","),
 number_format(${"pososto_iliaka_sep".$z}*100,2,".",","),number_format(${"pososto_iliaka_okt".$z}*100,2,".",","),
 number_format(${"pososto_iliaka_nov".$z}*100,2,".",","),number_format(${"pososto_iliaka_dec".$z}*100,2,".",","));
 
 $chart_znx_petr = array(number_format(${"pososto_petr_jan".$z}*100,2,".",","),number_format(${"pososto_petr_feb".$z}*100,2,".",","),
 number_format(${"pososto_petr_mar".$z}*100,2,".",","),number_format(${"pososto_petr_apr".$z}*100,2,".",","),
 number_format(${"pososto_petr_may".$z}*100,2,".",","),number_format(${"pososto_petr_jun".$z}*100,2,".",","),
 number_format(${"pososto_petr_jul".$z}*100,2,".",","),number_format(${"pososto_petr_aug".$z}*100,2,".",","),
 number_format(${"pososto_petr_sep".$z}*100,2,".",","),number_format(${"pososto_petr_okt".$z}*100,2,".",","),
 number_format(${"pososto_petr_nov".$z}*100,2,".",","),number_format(${"pososto_petr_dec".$z}*100,2,".",","));
 
 $MyData->addPoints($chart_znx_iliaka,"Ποσοστό από ηλιακά (%) ");
 $MyData->addPoints($chart_znx_petr,"Υπόλοιπο από πετρέλαιο (%) ");
 $MyData->setAxisName(0,"Ποσοστό (%)");
 $MyData->addPoints(array("IAN","ΦΕΒ","ΜΑΡ","ΑΠΡ","ΜΑΙ","ΙΟΥΝ","ΙΟΥΛ","ΑΥΓ","ΣΕΠ","ΟΚΤ","ΝΟΕ","ΔΕΚ"),"Months");
 $MyData->setSerieDescription("Months","Month");
 $MyData->setAbscissa("Months");

 /* Create the pChart object */
 $myPicture = new pImage(700,230,$MyData);
 $myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
 $myPicture->drawGradientArea(0,0,700,230,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));
 $myPicture->setFontProperties(array("FontName"=>"includes/pchart/fonts/calibri.ttf","FontSize"=>8));

 /* Draw the scale  */
 $myPicture->setGraphArea(50,30,680,200);
 $myPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10));

 /* Turn on shadow computing */ 
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

 /* Draw the chart */
 $settings = array("Gradient"=>TRUE,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
 $myPicture->drawBarChart($settings);

 /* Write the chart legend */
 $myPicture->drawLegend(400,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

 /* Render the picture (choose the best way) */
 imagePNG ($myPicture->render("includes/PDF/user".$_SESSION['user_id']."-znxchart".$z.".png"));
?>
