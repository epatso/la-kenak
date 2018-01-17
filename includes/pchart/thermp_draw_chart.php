<?php   
 /* CAT:Bar Chart */

 /* Create and populate the pData object */
 $ThermData = new pData();  
 
 $chart_thermp = array(number_format(${"thermp_jan".$z.$i}*100,2,".",","),number_format(${"thermp_feb".$z.$i}*100,2,".",","),
 number_format(${"thermp_mar".$z.$i}*100,2,".",","),number_format(${"thermp_apr".$z.$i}*100,2,".",","),
 number_format(${"thermp_may".$z.$i}*100,2,".",","),number_format(${"thermp_jun".$z.$i}*100,2,".",","),
 number_format(${"thermp_jul".$z.$i}*100,2,".",","),number_format(${"thermp_aug".$z.$i}*100,2,".",","),
 number_format(${"thermp_sep".$z.$i}*100,2,".",","),number_format(${"thermp_okt".$z.$i}*100,2,".",","),
 number_format(${"thermp_nov".$z.$i}*100,2,".",","),number_format(${"thermp_decem".$z.$i}*100,2,".",","));
 
 $ThermData->addPoints($chart_thermp,"Μονάδα παραγωγής θέρμανσης (%) ");
 $ThermData->setAxisName(0,"Ποσοστό (%)");
 $ThermData->addPoints(array("IAN","ΦΕΒ","ΜΑΡ","ΑΠΡ","ΜΑΙ","ΙΟΥΝ","ΙΟΥΛ","ΑΥΓ","ΣΕΠ","ΟΚΤ","ΝΟΕ","ΔΕΚ"),"Months");
 $ThermData->setSerieDescription("Months","Month");
 $ThermData->setAbscissa("Months");

 /* Create the pChart object */
 $thermPicture = new pImage(700,230,$ThermData);
 $thermPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
 $thermPicture->drawGradientArea(0,0,700,230,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));
 $thermPicture->setFontProperties(array("FontName"=>"includes/pchart/fonts/calibri.ttf","FontSize"=>8));

 /* Draw the scale  */
 $thermPicture->setGraphArea(50,30,680,200);
 $thermPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10));

 /* Turn on shadow computing */ 
 $thermPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

 /* Draw the chart */
 $thermSettings = array("Gradient"=>TRUE,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
 $thermPicture->drawBarChart($thermSettings);

 /* Write the chart legend */
 $thermPicture->drawLegend(400,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

 /* Render the picture (choose the best way) */
 imagePNG ($thermPicture->render("includes/PDF/user".$_SESSION['user_id']."-thermpchart".$z.$i.".png"));
?>
