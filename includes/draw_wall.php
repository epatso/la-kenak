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
/*
***********************************************************************
Tsak mods - Κώστας Τσακίρης - πολιτικός μηχανικός - ktsaki@tee.gr     *
                                                                      *
Σχεδίαση τοίχου    (από kenakv3)                                      *
                                                                      *
***********************************************************************
*/
	$hatch1='../images/hatch/brick3.png';
	$hatch2='../images/hatch/concrete2.png';
	$hatch3='../images/hatch/tile.png';
	$hatch4='../images/hatch/glass.png';
	$hatch5='../images/hatch/granitis.png';
	$font = './verdana.ttf';
	
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");


if (isset($_GET['zone']) AND $_GET['zone']==0){
	$table_wall="meletes_zone_adiafani";
	$table_window="meletes_zone_diafani";
}
if (isset($_GET['zone']) AND $_GET['zone']==1){
	$table_wall="meletes_mthx_adiafani";
	$table_window="meletes_mthx_diafani";
}


//ΟΨΗ ΤΟΙΧΟΥ
if(isset($_GET['draw']) AND $_GET['draw']==3){
	confirm_logged_in();
	if (isset($_GET['wall_id'])){$wall_id=$_GET["wall_id"];}
	
	$database = new medoo(DB_NAME);
	$data_wall = $database->select($table_wall,"*",array("id"=>$wall_id));
	$l=$data_wall[0]["l"]*100;
	$h=$data_wall[0]["h"]*100;
	$d=$data_wall[0]["d"]*100;
	$dy=$data_wall[0]["dy"]*100;
	$dx=$data_wall[0]["dx"]*100;
	$epafi=$data_wall[0]["type"];
	
	$yp_txt=$data_wall[0]["yp"];
	$dok_txt=$data_wall[0]["dok"];
	$syr_txt=$data_wall[0]["syr"];
	
	$name=$data_wall[0]["name"];
	
	$dW = $l;
    $dH = $h+$dy;
	$values = array();
	$image = imageCreateTrueColor ($dW, $dH+100);//100 είναι το μαύρο κενό κάτω
	$imagebg = imageCreateFromPNG ($hatch1); 
	$bg   = imagecolorallocate($image, 255, 255, 255);
	$fg = imagecolorallocate($image, 0, 0, 0);
	$grey = imagecolorallocate($image, 62, 62, 62);
	$magenda = imagecolorallocate($image, 103, 16, 81);
	
	//ορθογώνιος τοίχος
	imagefilledrectangle($image, 0, 0, $dW, $dH, $bg);
	imageSetTile ($image, $imagebg);
	$values[0]=0;
	$values[1]=$dy;
	$values[2]=$l;
	$values[3]=$dy;
	$values[4]=$l;
	$values[5]=$dH;
	$values[6]=0;
	$values[7]=$dH;
	imagefilledpolygon($image, $values, 4, IMG_COLOR_TILED);
	imagepolygon($image, $values, 4, $fg);
	
	
	imagedestroy ($imagebg);
	$imagebg = imageCreateFromPNG ($hatch2);
	imageSetTile ($image, $imagebg);
	
	//δοκοί
	$dok = explode("^",$dok_txt);
	for($i=0;$i<count($dok)-1;$i++){
	
		$dok_values = explode("|",$dok[$i]);
		
		$values[0]=0;
		$values[1]=$dok_values[1]*100+$dy;
		$values[2]=0;
		$values[3]=$dok_values[1]*100+$dok_values[0]*100+$dy;
		$values[4]=$l;
		$values[5]=$dok_values[1]*100+$dok_values[0]*100+$dy;
		$values[6]=$l;
		$values[7]=$dok_values[1]*100+$dy;
		imagefilledpolygon($image, $values, 4, IMG_COLOR_TILED);
		//imagepolygon($image, $values, 4, $fg);
	}
	
	//υποστυλώματα
	$yp = explode("^",$yp_txt);
	for($i=0;$i<count($yp)-1;$i++){
	
		$yp_values = explode("|",$yp[$i]);
		
		$values[0]=$yp_values[1]*100;
		$values[1]=$dy;
		$values[2]=$yp_values[1]*100+$yp_values[0]*100;
		$values[3]=$dy;
		$values[4]=$yp_values[1]*100+$yp_values[0]*100;
		$values[5]=$dH;
		$values[6]=$yp_values[1]*100;
		$values[7]=$dH;
		imagefilledpolygon($image, $values, 4, IMG_COLOR_TILED);
		//imagepolygon($image, $values, 4, $fg);
	}
	
	$style = array($bg, $bg, $bg, $bg, $bg, $fg, $fg, $fg, $fg, $fg);
	imagesetstyle($image, $style);
	
	//συρόμενα
	$syr = explode("^",$syr_txt);
	for($i=0;$i<count($syr)-1;$i++){
	
		$syr_values = explode("|",$syr[$i]);
		
		$values[0]=$syr_values[3]*100;
		$values[1]=$h-$syr_values[2]*100+$dy;
		$values[2]=$syr_values[3]*100;
		$values[3]=$h-$syr_values[2]*100-$syr_values[1]*100+$dy;
		$values[4]=$syr_values[3]*100+$syr_values[0]*100;
		$values[5]=$h-$syr_values[2]*100-$syr_values[1]*100+$dy;
		$values[6]=$syr_values[3]*100+$syr_values[0]*100;
		$values[7]=$h-$syr_values[2]*100+$dy;
		//imagefilledpolygon($image, $values, 4, IMG_COLOR_TILED);
		imagepolygon($image, $values, 4, IMG_COLOR_STYLED);
	}
	
	//τρίγωνο πάνω από τοίχο εάν υπάρχει
	$imagebg = imageCreateFromPNG ($hatch1);
	//imagefilledrectangle($image, 0, 0, $dW, $dH, $bg);
	imageSetTile ($image, $imagebg);
	$values[0]=0;
	$values[1]=$dy;
	$values[2]=$dx;
	$values[3]=0;
	$values[4]=$l;
	$values[5]=$dy;
	$values[6]=0;
	$values[7]=$dy;
	imagefilledpolygon($image, $values, 4, IMG_COLOR_TILED);
	imagepolygon($image, $values, 4, $fg);
	
	
	//Παράθυρα
	$data_window = $database->select($table_window,"*",array("wall_id"=>$wall_id) );
		foreach($data_window as $window){
		$wname=$window["name"];
		$ww=$window["w"]*100;
		$wh=$window["h"]*100;
		$wp=$window["p"]*100;
		$apoar=$window["apoar"]*100;
		
		
		$values[0]=$apoar;
		$values[1]=$dH-$wh-$wp;
		$values[2]=$apoar+$ww;
		$values[3]=$dH-$wh-$wp;
		$values[4]=$apoar+$ww;
		$values[5]=$dH-$wp;
		$values[6]=$apoar;
		$values[7]=$dH-$wp;
		
		$imagebg = imageCreateFromPNG ($hatch4);
		imageSetTile ($image, $imagebg);
		imagefilledpolygon($image, $values, 4, IMG_COLOR_TILED);
		$imagebg = imageCreateFromPNG ($hatch5);
		imageSetTile ($image, $imagebg);
		imagepolygon($image, $values, 4, IMG_COLOR_TILED);
		
		imagefttext($image, 8, 0, $apoar+10, $dH-$wh-$wp+15, $magenda, $font, $wname);
		imagefttext($image, 8, 0, $apoar+10, $dH-$wh-$wp+30, $magenda, $font, "Μήκος:".$ww/100);
		imagefttext($image, 8, 0, $apoar+10, $dH-$wh-$wp+45, $magenda, $font, "Ύψος:".$wh/100);
		imagefttext($image, 8, 0, $apoar+10, $dH-$wh-$wp+60, $magenda, $font, "Ποδιά:".$wp/100);
		
		}
	
	//Ονομασίες
	//μήκος
	imagefttext($image, 12, 0, $l/2, $dH-5, $magenda, $font, $l/100);
	imageline ($image, 0, $dH-10, ($l/2)-20, $dH-10, $magenda);
	imageline ($image, ($l/2)+20, $dH-10, $dW, $dH-10, $magenda);
	//ύψος ορθογωνίου
	imagefttext($image, 12, 90, $l-5, $dy+$h/2, $magenda, $font, $h/100);
	imageline ($image, $l-5, $dy, $l-5, $dy+$h/2-10, $magenda);
	imageline ($image, $l-5, $dy+$h/2+10, $l-5, $dH, $magenda);
	//ύψος σκεπής
	imagefttext($image, 12, 90, $l-5, $dy/2, $magenda, $font, $dy/100);
	imageline ($image, $l-5, 0, $l-5, $dy/2-10, $magenda);
	imageline ($image, $l-5, $dy/2+10, $l-5, $dy, $magenda);
	
	//απόσταση από αριστερό άκρο σκεπής (αριστερά)
	imagefttext($image, 12, 0, $dx/2, 15, $magenda, $font, $dx/100);
	imageline ($image, 0, 15, $dx/2-10, 15, $magenda);
	imageline ($image, $dx/2+10, 15, $dx, 15, $magenda);
	
	//απόσταση από αριστερό άκρο σκεπής (δεξιά)
	imagefttext($image, 12, 0, $dx+($l-$dx)/2, 15, $magenda, $font, ($l-$dx)/100);
	imageline ($image, $dx, 15, $dx+($l-$dx)/2-10, 15, $magenda);
	imageline ($image, $dx+($l-$dx)/2+10, 15, $l, 15, $magenda);
	
	//Επαφή με:
	if($epafi==0){$epafi="Σε αέρα";}
	if($epafi==1){$epafi="Σε ΜΘΧ";}
	if($epafi==2){$epafi="Σε έδαφος";}
	if($epafi==3){$epafi="Μεσοτοιχία";}
	imagefttext($image, 11, 0, 15, $dH+18, $grey, $font, "Ονομασία:".$name);
	imagefttext($image, 11, 0, 15, $dH+36, $grey, $font, "Επαφή:".$epafi);
	imagefttext($image, 11, 0, 15, $dH+54, $grey, $font, "Μήκος:".$l/100);
	imagefttext($image, 11, 0, 15, $dH+72, $grey, $font, "Ύψος:".$h/100);
	imagefttext($image, 11, 0, 15, $dH+90, $grey, $font, "Ύψος πάνω από τοίχο:".$dy/100);
	
	
	Header("Content-type: image/png");
	imagePNG ($image);

    imagedestroy ($image);
    imagedestroy ($imagebg);
}

//ΚΑΤΟΨΗ ΤΟΙΧΟΥ
if(isset($_GET['draw']) AND $_GET['draw']==1){
	
	if (isset($_GET['wall_id'])){$wall_id=$_GET["wall_id"];}
	
	$database = new medoo(DB_NAME);
	$data_wall = $database->select("meletes_zone_adiafani","*",array("id"=>$wall_id));
	$l=$data_wall[0]["l"]*100;
	$h=$data_wall[0]["h"]*100;
	$d=$data_wall[0]["d"]*100;
	$dy=$data_wall[0]["dy"]*100;
	$dx=$data_wall[0]["dx"]*100;
	$epafi=$data_wall[0]["type"];
	
	$yp_txt=$data_wall[0]["yp"];
	$dok_txt=$data_wall[0]["dok"];
	$syr_txt=$data_wall[0]["syr"];
	
	$fhor_txt = explode("|",$data_wall[0]["fhor"]);
	$fov_txt = $data_wall[0]["fov"];
	$fovt_txt = explode("|",$data_wall[0]["fovt"]);
	$ffin_l_txt = explode("|",$data_wall[0]["ffin_l"]);
	$ffin_r_txt = explode("|",$data_wall[0]["ffin_r"]);
	$fsh_txt = explode("|",$data_wall[0]["fsh"]);
	
	
	$dW = $l;
    $dH = $d+$ffin_r[1]*100;
	$values = array();
	$image = imageCreateTrueColor ($dW, $dH);
	$imagebg = imageCreateFromPNG ($hatch1); 
	$bg   = imagecolorallocate($image, 255, 255, 255);
	$fg = imagecolorallocate($image, 0, 0, 0);
	
	imagefilledrectangle($image, 0, 0, $dW, $dH, $bg);
	imageSetTile ($image, $imagebg);
	$values[0]=0;
	$values[1]=0;
	$values[2]=$l;
	$values[3]=0;
	$values[4]=$l;
	$values[5]=$d;
	$values[6]=0;
	$values[7]=$d;
	imagefilledpolygon($image, $values, 4, IMG_COLOR_TILED);
	imagepolygon($image, $values, 4, $fg);
	
	imagedestroy ($imagebg);
	$imagebg = imageCreateFromPNG ($hatch2);
	imageSetTile ($image, $imagebg);
	
	$yp = explode("^",$yp_txt);
	for($i=0;$i<count($yp)-1;$i++){
	
		$yp_values = explode("|",$yp[$i]);
		
		$values[0]=$yp_values[1]*100;
		$values[1]=0;
		$values[2]=$yp_values[1]*100+$yp_values[0]*100;
		$values[3]=0;
		$values[4]=$yp_values[1]*100+$yp_values[0]*100;
		$values[5]=$d;
		$values[6]=$yp_values[1]*100;
		$values[7]=$d;
		imagefilledpolygon($image, $values, 4, IMG_COLOR_TILED);
		imagepolygon($image, $values, 4, $fg);
	}
	
	
	Header("Content-type: image/png");
	imagePNG ($image);

    imagedestroy ($image);
    imagedestroy ($imagebg);
}
?>






