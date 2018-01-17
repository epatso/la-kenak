<?php   
 /* CAT:Bar Chart */

 /* Create and populate the pData object */
 $ColdData = new pData();  
 
 $chart_coldp = array(number_format(${"coldp_jan".$z.$i}*100,2,".",","),number_format(${"coldp_feb".$z.$i}*100,2,".",","),
 number_format(${"coldp_mar".$z.$i}*100,2,".",","),number_format(${"coldp_apr".$z.$i}*100,2,".",","),
 number_format(${"coldp_may".$z.$i}*100,2,".",","),number_format(${"coldp_jun".$z.$i}*100,2,".",","),
 number_format(${"coldp_jul".$z.$i}*100,2,".",","),number_format(${"coldp_aug".$z.$i}*100,2,".",","),
 number_format(${"coldp_sep".$z.$i}*100,2,".",","),number_format(${"coldp_okt".$z.$i}*100,2,".",","),
 number_format(${"coldp_nov".$z.$i}*100,2,".",","),number_format(${"coldp_decem".$z.$i}*100,2,".",","));
 
 $ColdData->addPoints($chart_coldp,"Μονάδα παραγωγής ψύξης (%) ");
 $ColdData->setAxisName(0,"Ποσοστό (%)");
 $ColdData->addPoints(array("IAN","ΦΕΒ","ΜΑΡ","ΑΠΡ","ΜΑΙ","ΙΟΥΝ","ΙΟΥΛ","ΑΥΓ","ΣΕΠ","ΟΚΤ","ΝΟΕ","ΔΕΚ"),"Months");
 $ColdData->setSerieDescription("Months","Month");
 $ColdData->setAbscissa("Months");

 /* Create the pChart object */
 $coldPicture = new pImage(700,230,$ColdData);
 $coldPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
 $coldPicture->drawGradientArea(0,0,700,230,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));
 $coldPicture->setFontProperties(array("FontName"=>"includes/pchart/fonts/calibri.ttf","FontSize"=>8));

 /* Draw the scale  */
 $coldPicture->setGraphArea(50,30,680,200);
 $coldPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10));

 /* Turn on shadow computing */ 
 $coldPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

 /* Draw the chart */
 $coldSettings = array("Gradient"=>TRUE,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
 $coldPicture->drawBarChart($coldSettings);

 /* Write the chart legend */
 $coldPicture->drawLegend(400,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

 /* Render the picture (choose the best way) */
 imagePNG ($coldPicture->render("includes/PDF/user".$_SESSION['user_id']."-coldpchart".$z.$i.".png"));
?>
