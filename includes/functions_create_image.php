<?php
/*
Copyright (C) 2013 - Labros kenak v.4.0 beta
Author: Labros Karoyntzos 

Labros kenak v.4.0 beta from Labros Karountzos is free software: 
you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, version 3 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License version 3
along with this program.  If not, see http://www.gnu.org/licenses/gpl-3.0.html.

Το παρόν με την ονομασία Labros kenak v.4.0 beta με δημιουργό τον Λάμπρο Καρούντζο
στοιχεία επικοινωνίας info@chem-lab.gr www.chem-lab.gr
είναι δωρεάν λογισμικό. Μπορείτε να το τροποποιήσετε και επαναδιανείμετε υπό τους
όρους της άδειας GNU General Public License όπως δίδεται από το Free Software Foundation
στην έκδοση 3 αυτής της άδειας.
Το παρόν σχόλιο πρέπει να παραμένει ως έχει ώστε να τηρείται η παραπάνω άδεια κατά τη διανομή.
*/

if (isset($_GET['getchartclimate'])){
	$table = $_GET['table'];
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require("pchart/class/pData.class.php");
	require("pchart/class/pDraw.class.php");
	require("pchart/class/pImage.class.php");
	$tb = create_image_climate($table,$id);
	echo $tb;
	exit;
}

if (isset($_GET['getchartclimate_b'])){
	$place = $_GET['place'];
	$column = $_GET['column'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require("pchart/class/pData.class.php");
	require("pchart/class/pDraw.class.php");
	require("pchart/class/pImage.class.php");
	$tb = create_image_climate_b($place,$column);
	echo $tb;
	exit;
}

if (isset($_GET['getchartclimate_omvrotherm'])){
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require("pchart/class/pData.class.php");
	require("pchart/class/pDraw.class.php");
	require("pchart/class/pImage.class.php");
	$tb = create_image_climate_omvrotherm($id);
	echo $tb;
	exit;
}

if (isset($_GET['getchart_shade'])){
	$pros = $_GET['pros'];
	$from = $_GET['from'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require("pchart/class/pData.class.php");
	require("pchart/class/pDraw.class.php");
	require("pchart/class/pImage.class.php");
	$tb = create_chart_shade($pros,$from);
	echo $tb;
	exit;
}


//Δημιουργία διαγράμματος περιοχής
function create_image_climate($table,$id){

$filename = "images/climate/".$table."/climate_table".$table."_id".$id.".png";

	if(!file_exists($filename)){
		$database = new medoo(DB_NAME);
		$tb = "vivliothiki_climate".$table;
		$data_table = $database->select($tb,"*",array("id"=>$id));

		if($table==31){$title="Μέση μηνιαία Τ 24ώρου [oC]";}
		if($table==32){$title="Μέση μηνιαία Τ (περ. ηλιοφάνειας) [oC]";}
		if($table==33){$title="Μέση μηνιαία μέγιστη Τ [oC]";}
		if($table==34){$title="Μέση μηνιαία ελάχιστη Τ [oC]";}
		if($table==35){$title="Μέση μηνιαία απολύτως μέγιστη Τ [oC]";}
		if($table==36){$title="Μέση μηνιαία απολύτως ελάχιστη Τ [oC]";}
		if($table==37){$title="Βαθμοημέρες θέρμανσης [d]";}
		if($table==38){$title="Βαθμοώρες ψύξης [h]";}
		if($table==39){$title="Μέση μηνιαία σχετική υγρασία [%]";}
		if($table==310){$title="Μέση μηνιαία ειδική υγρασία [%]";}
		if($table==311){$title="Μέση ταχύτητα ανέμου [m/s]";}
		if($table==41){$title="Μέση μηνιαία ολική ακτινοβολία (οριζόντιο) [kWh/m2.mo]";}
		if($table==42){$title="Μέση μηνιαία διάχυτη ακτινοβολία (οριζόντιο) [kWh/m2.mo]";}
		if($table==43){$title="Μέσος μηνιαίος συντελεστής αιθριότητας kt";}
		if($table==44){$title="Μηνιαία ηλ. ακτινοβολία Φ/Β (βέλτιστη) [kWh/m2.mo]";}
		if($table==61){$title="Θερμοκρασίες νερού δικτύου (ΕΛΟΤ) [oC]";}
		if($table==62){$title="Θερμοκρασίες νερού δικτύου (ΚΕΝΑΚ) [oC]";}

		$ThermData = new pData();  
		$chart_thermp = array(
							$data_table[0]["jan"],
							$data_table[0]["feb"],
							$data_table[0]["mar"],
							$data_table[0]["apr"],
							$data_table[0]["may"],
							$data_table[0]["jun"],
							$data_table[0]["jul"],
							$data_table[0]["aug"],
							$data_table[0]["sep"],
							$data_table[0]["okt"],
							$data_table[0]["nov"],
							$data_table[0]["dec"]
						);

		$ThermData->addPoints($chart_thermp,$data_table[0]["place"]);
		$ThermData->setAxisName(0,$title);
		$ThermData->addPoints(array("IAN","ΦΕΒ","ΜΑΡ","ΑΠΡ","ΜΑΙ","ΙΟΥΝ","ΙΟΥΛ","ΑΥΓ","ΣΕΠ","ΟΚΤ","ΝΟΕ","ΔΕΚ"),"Months");
		$ThermData->setSerieDescription("Months","Month");
		$ThermData->setAbscissa("Months");

		//Create the pChart object
		$thermPicture = new pImage(700,230,$ThermData);
		$thermPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
		$thermPicture->drawGradientArea(0,0,700,230,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));
		$thermPicture->setFontProperties(array("FontName"=>"pchart/fonts/calibri.ttf","FontSize"=>8));

		//Draw the scale
		$thermPicture->setGraphArea(50,30,680,200);
		$thermPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10));

		//Turn on shadow computing
		$thermPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

		//Draw the chart
		$thermSettings = array("Gradient"=>TRUE,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
		$thermPicture->drawBarChart($thermSettings);

		//Write the chart legend
		$thermPicture->drawLegend(400,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

		//Render the picture (choose the best way)
		$thermPicture->render("../images/climate/".$table."/climate_table".$table."_id".$id.".png");
	}	
	return "<img src=\"images/climate/".$table."/climate_table".$table."_id".$id.".png\">";

//$thermimg = $thermPicture->autoOutput("example.png");
//return "<img src=\"".$thermimg."\">";

}

//Δημιουργία διαγράμματος περιοχής (ηλιακή ακτινοβολία)
function create_image_climate_b($place,$column){

	$database = new medoo(DB_NAME);
	$tb = "vivliothiki_climate_b";
	$data_id = $database->select("vivliothiki_climate_places","id",array("place"=>$place));
	$id = $data_id[0];
		if($place=="Τρίκαλα"){$id=55;}//Επιλογή για τρίκαλα Θεσαλλίας
$filename = "images/climate/b/climate".$id."_column".$column.".png";
	
	if(!file_exists($filename)){
	$data_table = $database->select($tb,$column,array("place"=>$place));
	
	$ThermData = new pData();
	$chart_thermp = $data_table;
	
	$ThermData->addPoints($chart_thermp,$place);
		$ThermData->setAxisName(0,$column);
		$ThermData->addPoints(array("IAN","ΦΕΒ","ΜΑΡ","ΑΠΡ","ΜΑΙ","ΙΟΥΝ","ΙΟΥΛ","ΑΥΓ","ΣΕΠ","ΟΚΤ","ΝΟΕ","ΔΕΚ"),"Months");
		$ThermData->setSerieDescription("Months","Month");
		$ThermData->setAbscissa("Months");

		//Create the pChart object
		$thermPicture = new pImage(700,230,$ThermData);
		$thermPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
		$thermPicture->drawGradientArea(0,0,700,230,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));
		$thermPicture->setFontProperties(array("FontName"=>"pchart/fonts/calibri.ttf","FontSize"=>8));

		//Draw the scale
		$thermPicture->setGraphArea(50,30,680,200);
		$thermPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10));

		//Turn on shadow computing
		$thermPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

		//Draw the chart
		$thermSettings = array("Gradient"=>TRUE,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
		$thermPicture->drawBarChart($thermSettings);

		//Write the chart legend
		$thermPicture->drawLegend(400,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

		//Render the picture (choose the best way)
		$thermPicture->render("../images/climate/b/climate".$id."_column".$column.".png");
	}	
	return "<img src=\"images/climate/b/climate".$id."_column".$column.".png\">";	
}

//Δημιουργία διαγράμματος περιοχής (ηλιακή ακτινοβολία)
function create_image_climate_omvrotherm($id){

	$database = new medoo(DB_NAME);
	$data_temp = $database->select("vivliothiki_climate31","*",array("id"=>$id));
	$data_rain = $database->select("vivliothiki_climate999","*",array("id"=>$id));
	$place = $data_temp[0]["place"];
	
	$months_en = array("jan","feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "okt", "nov", "dec");
	$chart_temp = array();
	$chart_rain = array();
	foreach($months_en as $month){
		array_push($chart_temp, $data_temp[0][$month]);
		array_push($chart_rain, $data_rain[0][$month]);
	}
	
	if($place=="Τρίκαλα"){$id=55;}//Επιλογή για τρίκαλα Θεσαλλίας
	$filename = "images/climate/omvrotherm/omvro".$id.".png";
	
	if(!file_exists($filename)){
	
	$ThermData = new pData();
	
		$ThermData->addPoints($chart_temp,"Serie1");
		$ThermData->addPoints($chart_rain,"Serie2");
		$ThermData->setSerieOnAxis("Serie1",0);
		$ThermData->setSerieOnAxis("Serie2",1);
		$ThermData->setAxisName(0,"Μέση μηνιαία θερμοκρασία (oC)");
		$ThermData->setAxisName(1,"Μέση μηνιαία βροχόπτωση (mm)");
		$ThermData->setAxisPosition(1,AXIS_POSITION_RIGHT);
		$ThermData->addPoints(array("IAN","ΦΕΒ","ΜΑΡ","ΑΠΡ","ΜΑΙ","ΙΟΥΝ","ΙΟΥΛ","ΑΥΓ","ΣΕΠ","ΟΚΤ","ΝΟΕ","ΔΕΚ"),"Months");
		$ThermData->setSerieDescription("Months","Μήνες");
		$ThermData->setSerieDescription("Serie1","Μέση μηνιαία θερμοκρασία (oC)");
		$ThermData->setSerieDescription("Serie2","Μέση μηνιαία βροχόπτωση (mm)");
		$ThermData->setAbscissa("Months");
		$ThermData->setAbscissaName("Μήνες");
		
		//χρώματα
		$serieSettings1 = array("R"=>250,"G"=>0,"B"=>0);
		$ThermData->setPalette("Serie1",$serieSettings1);
		$serieSettings2 = array("R"=>0,"G"=>0,"B"=>250);
		$ThermData->setPalette("Serie2",$serieSettings2);

		//Create the pChart object
		$thermPicture = new pImage(720,400,$ThermData);
		$thermPicture->drawGradientArea(0,0,720,400,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
		$thermPicture->drawGradientArea(0,0,720,400,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));
		$thermPicture->setFontProperties(array("FontName"=>"pchart/fonts/calibri.ttf","FontSize"=>8));

		//$ThermData->setSerieDrawable("Serie2", FALSE);
		$thermPicture->setGraphArea(50,30,660,350);
		$thermPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10));
		$thermPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
		$thermSettings1 = array("Gradient"=>TRUE,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
		$thermPicture->drawSplineChart($thermSettings1);
		
		
		//$thermPicture->clearScale();
		//$ThermData->setSerieDrawable("Serie1", FALSE);
		//$ThermData->setSerieDrawable("Serie2", TRUE);
		$thermPicture->setGraphArea(50,30,660,350);
		$thermPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10));
		$thermSettings2 = array("Gradient"=>TRUE,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>50,"DisplayShadow"=>TRUE,"Surrounding"=>10);
		$thermPicture->drawSplineChart($thermSettings2);
		
		$ThermData->setSerieDrawable("Serie1", TRUE);
		$ThermData->setSerieDrawable("Serie2", TRUE);
		//Write the chart legend
		$thermPicture->drawLegend(400,12,array("Style"=>LEGEND_ROUND,"Mode"=>LEGEND_HORIZONTAL));
		$thermPicture->drawText(20,10,"Ομβροθερμικό: ".$place,array("FontSize"=>10,"Align"=>TEXT_ALIGN_LEFT));

		//Render the picture (choose the best way)
		$thermPicture->render("../images/climate/omvrotherm/omvro".$id.".png");
	}
	return "<img src=\"images/climate/omvrotherm/omvro".$id.".png\">";		
}

//Δημιουργία διαγράμματος συντελεστής σκίασης - γωνία εμποδίου
function create_chart_shade($pros = "b",$from = "hor"){

	$filename = "images/shading/".$from."_pros".$pros.".png";
	
	if(!file_exists($filename)){
	$database = new medoo(DB_NAME);
	if($from=="hor"){$table="vivliothiki_f_hor";}
	if($from=="ov"){$table="vivliothiki_f_ov";}
	if($from=="left"){$table="vivliothiki_f_fin_left";}
	if($from=="right"){$table="vivliothiki_f_fin_right";}
	if($from=="per"){$table="vivliothiki_f_per";}
	$data_f_h = $database->select($table,$pros, array("periode"=>"Θέρμανσης"));
	$data_f_c = $database->select($table,$pros, array("periode"=>"Ψύξης"));
	$data_deg = $database->select($table,"deg", array("periode"=>"Θέρμανσης"));
	
	$array_f_h = $data_f_h;
	$array_f_c = $data_f_c;
	$array_deg = $data_deg;
	
	$ChartData = new pData();
	$ChartData->addPoints($array_f_h,"F".$from."_".$pros."_h");
	$ChartData->addPoints($array_f_c,"F".$from."_".$pros."_c");
	
		$ChartData->setAxisName(0,"Συντελεστής σκίασης");
		$ChartData->addPoints($array_deg,"Deg");
		$ChartData->setSerieDescription("Deg","Deg");
		$ChartData->setAbscissa("Deg");
		
		//Create the pChart object
		$ChartPicture = new pImage(700,350,$ChartData);
		$ChartPicture->drawGradientArea(0,0,700,350,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100));
		$ChartPicture->drawGradientArea(0,0,700,350,DIRECTION_HORIZONTAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>20));
		$ChartPicture->setFontProperties(array("FontName"=>"pchart/fonts/calibri.ttf","FontSize"=>8));

		//Draw the scale
		$ChartPicture->setGraphArea(50,30,680,330);
		$ChartPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10));

		//Turn on shadow computing
		$ChartPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

		//Draw the chart
		$ChartSettings = array("Gradient"=>TRUE,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
		$ChartPicture->drawLineChart($ChartSettings);

		//Write the chart legend
		$ChartPicture->drawLegend(400,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));
		
		//Render the picture (choose the best way)
		$ChartPicture->render("../images/shading/".$from."_pros".$pros.".png");
		}
		return "<img src=\"images/shading/".$from."_pros".$pros.".png\">";
}
?>