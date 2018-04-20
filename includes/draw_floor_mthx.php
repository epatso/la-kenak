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
	$hatch1='../images/hatch/brick3.png';
	$hatch2='../images/hatch/concrete2.png';
	$hatch3='../images/hatch/tile.png';
	$hatch4='../images/hatch/glass.png';
	$hatch5='../images/hatch/granitis.png';
	$font = './verdana.ttf';
	
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require("functions_meleti_draw.php");
	require("functions_meleti_systems.php");

//ΚΑΤΟΨΗ ΟΡΟΦΟΥ
if (isset($_GET['floor'])){$floor=$_GET["floor"];}

	$scale=100;
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	
	$building_data = $database->select("user_meletes","*",array("id"=>$_SESSION['meleti_id']));
	$building_g = $building_data[0]["pros"];
	
	$table="meletes_mthx_adiafani";
	$table_win="meletes_mthx_diafani";
	$columns="*";
	$where=array(
		"AND"=>array(
			"user_id"=>$_SESSION['user_id'],
			"meleti_id"=>$_SESSION['meleti_id'],
			"roof"=>$floor
			),
		"ORDER"=>array(
			"draw_order"=>"ASC"
			)
		);
	$data_wall = $database->select($table,$columns,$where);
	$count = $database->count($table,$where);
	
	
	//Εύρεση αρχικά των ορίων του κτιρίου σε X,Y
	//Θέτω αρχικά X,Y=0 και βρίσκω το μεγαλύτερο x,y και το μικρότερο x,y
	//Έτσι ξέρω που να ξεκινήσω να σχεδιάζω και που τελειώνει η εικόνα
	$current_x=0;
	$current_y=0;
	$x_min=0;
	$y_min=0;
	$x_max=0;
	$y_max=0;
	
	
	$c_win=1;
	
	foreach ($data_wall as $wall){
		$fhor=explode("|",$wall["fhor"]);
		if($wall["g_type"]==0){
				$wall_g = $wall["g"];
			}else{
				if($wall["g_type"]==1){
				$wall_g = $building_g;
				}
				if($wall["g_type"]==2){
				$wall_g = $building_g+90;
				}
				if($wall["g_type"]==3){
				$wall_g = $building_g+180;
				}
				if($wall["g_type"]==4){
				$wall_g = $building_g+270;
				}
			}
			if($wall_g>=360){
				$wall_g=$wall_g-360;
			}
			$wall_l=$wall["l"]*$scale;
			
			$x2=$current_x+$wall_l* cos(deg2rad(360-$wall_g));
			$y2=$current_y-$wall_l* sin(deg2rad(360-$wall_g));
			
			if($x2>$x_max){$x_max=$x2;}
			if($y2>$y_max){$y_max=$y2;}
			
			if($x2<$x_min){$x_min=$x2;}
			if($y2<$y_min){$y_min=$y2;}
		$current_x = $x2;
		$current_y = $y2;
	}
	
	if($x_min==0){$x_min=0;}else{$x_min=0-$x_min;}
	if($y_min==0){$y_min=0;}else{$y_min=0-$y_min;}
	//Πλάτος εικόνας: x_min (πχ -100px εάν έχει περιστροφή), x_max (το όριο του κτιρίου δεξιά) 
	//scale*2 για περιθώρια δεξιά και αριστερά μιάς και η εικόνα ξεκινάει από την περιστροφή του x + scale
	//+ 150 για το σήμα του βορά
	$image_x=$x_min+$x_max+$scale*4 + 150+100;//μικρότερο χ, μεγαλύτερο χ + 4 φορές scale (περιθώριο) + σύμβολο βορρά + πινακίδα + πίνακας ανοιγμάτων
	$image_y=$y_min+$y_max+$scale*4;
	//ΤΕΛΟΣ ΟΡΙΩΝ ΕΙΚΟΝΑΣ
	
	
	//Αρχή σχεδίασης
	$array_type=array(
		0=>"Αέρας",
		1=>"Έδαφος"
	);
	
	$image = imageCreateTrueColor ($image_x, $image_y);
	
	$white = imagecolorallocate($image, 255, 255, 255);
	$black = imagecolorallocate($image, 0, 0, 0);
	$magenda = imagecolorallocate($image, 103, 16, 81);
	$red = imagecolorallocate($image, 255, 0, 0);
	$grey = imagecolorallocate($image, 201, 197, 197);
	$orange = imagecolorallocate($image, 255, 136, 108);
	$light_cyan = imagecolorallocate($image, 219, 244, 243);
	$fill_color = imagecolorallocatealpha($image, 220, 235, 249,98);
	//imagecolortransparent ($image , $fill_color);
	
	$north = imagecreatefromPNG('../images/style/compass.png');
	$arr_right = imagecreatefromPNG('../images/interface/arrows/right.png');
	$arr_left = imagecreatefromPNG('../images/interface/arrows/left.png');
	$arr_up = imagecreatefromPNG('../images/interface/arrows/up.png');
	$arr_down = imagecreatefromPNG('../images/interface/arrows/down.png');
	imagefilledrectangle($image, 0, 0, $image_x, $image_y, $white);
	
	//ΓΡΑΜΜΗ ΔΙΑΧΩΡΙΣΜΟΥ
	imageBoldLine($image, $image_x-165, 200, $image_x-165, 280+40*$count, $grey, 4);
	//Πίνακας ορίζοντα
	imagefttext($image, 6, 0, $image_x-160, 200, $black, $font, "Fhor" );
	imageline($image, $image_x-160, 200, $image_x, 200, $grey);
	imagefilledrectangle($image, $image_x-160, 200, $image_x, 200+10*$count, $light_cyan);
	//Πίνακας προβόλων
	imagefttext($image, 6, 0, $image_x-160, 220+10*$count, $black, $font, "Fov" );
	imageline($image, $image_x-160, 220+10*$count, $image_x, 220+10*$count, $grey);
	imagefilledrectangle($image, $image_x-160, 220+10*$count, $image_x, 220+20*$count, $light_cyan);
	//Πίνακας προβόλων
	imagefttext($image, 6, 0, $image_x-160, 240+20*$count, $black, $font, "Ffin_l" );
	imageline($image, $image_x-160, 240+20*$count, $image_x, 240+20*$count, $grey);
	imagefilledrectangle($image, $image_x-160, 240+20*$count, $image_x, 240+30*$count, $light_cyan);
	//Πίνακας προβόλων
	imagefttext($image, 6, 0, $image_x-160, 260+30*$count, $black, $font, "Ffin_r" );
	imageline($image, $image_x-160, 260+30*$count, $image_x, 260+30*$count, $grey);
	imagefilledrectangle($image, $image_x-160, 260+30*$count, $image_x, 260+40*$count, $light_cyan);
	//Πίνακας ανοιγμάτων
	imagefttext($image, 6, 0, $image_x-280, 200, $black, $font, "Ανοίγματα (μήκος x υψος)" );
	imageline($image, $image_x-280, 205, $image_x-180, 205, $grey);
	imagefilledrectangle($image, $image_x-280, 200, $image_x-170, 400, $light_cyan);
	
	
	$current_x =$x_min+$scale;
	$current_y = $y_min+$scale;
	$x0=$current_x;
	$y0=$current_y;
	$i=1;
	$e_sum=0;
	$points=array($current_x,$current_y);
	
	imagecopy($image, $north, $image_x-150, 0, 0, 0, 150, 151);
	
	foreach ($data_wall as $wall){
		$name = $wall["name"];
		$epafi="Επαφή:".$array_type[$wall["type"]];
		$g = round($wall["g"]);
		$g_type = $wall["g_type"];
		$draw_order = $wall["draw_order"];
		$fhor=explode("|",$wall["fhor"]);
		$fov=$wall["fov"];
		$ffin_l=explode("|",$wall["ffin_l"]);
		$ffin_r=explode("|",$wall["ffin_r"]);
		$pros="γ=".$g."/l=".round($wall["l"],2)."m";
		
		if($wall["g_type"]==0){
				$wall_g = $wall["g"];
			}else{
				if($wall["g_type"]==1){
				$wall_g = $building_g;
				}
				if($wall["g_type"]==2){
				$wall_g = $building_g+90;
				}
				if($wall["g_type"]==3){
				$wall_g = $building_g+180;
				}
				if($wall["g_type"]==4){
				$wall_g = $building_g+270;
				}
			}
			if($wall_g>=360){
				$wall_g=$wall_g-360;
			}
			$wall_l=$wall["l"]*$scale;
			
			$x1=$current_x;
			$y1=$current_y;
			
			$x2=$current_x+$wall_l* cos(deg2rad(360-$wall_g));
			$y2=$current_y-$wall_l* sin(deg2rad(360-$wall_g));
			$text_x = $current_x +($wall_l/2) * cos(deg2rad(360-$wall_g));
			$text_y = $current_y -($wall_l/2)* sin(deg2rad(360-$wall_g));
				if($fhor[0]!=0){
					$x1_hor=$x1 + ($fhor[0]*$scale) * cos(deg2rad( (360-$wall_g)-270 ) );
					$y1_hor=$y1 - ($fhor[0]*$scale) * sin(deg2rad( (360-$wall_g)-270 ) );
					$x2_hor=$x2 + ($fhor[0]*$scale) * cos(deg2rad( (360-$wall_g)-270 ) );
					$y2_hor=$y2 - ($fhor[0]*$scale) * sin(deg2rad( (360-$wall_g)-270 ) );
				}
				if($fov!=0){
					$x1_ov=$x1 + ($fov*$scale) * cos(deg2rad( (360-$wall_g)-270 ) );
					$y1_ov=$y1 - ($fov*$scale) * sin(deg2rad( (360-$wall_g)-270 ) );
					$x2_ov=$x2 + ($fov*$scale) * cos(deg2rad( (360-$wall_g)-270 ) );
					$y2_ov=$y2 - ($fov*$scale) * sin(deg2rad( (360-$wall_g)-270 ) );
				}
			
			$x1y2_y1x2=$x1*$y2 - $y1*$x2;
			$e_sum+=$x1y2_y1x2;
			
			array_push($points,$x2);
			array_push($points,$y2);
			
			//Βέλη
			//imagecopy($image, $arr_up, $text_x-7, $y1-3, 0, 0, 16, 16);
			//imagecopy($image, $arr_down, $text_x-7, $y2-11, 0, 0, 16, 16);	
			//imagecopy($image, $arr_right, $x2-13, $text_y-8, 0, 0, 16, 16);
			//imagecopy($image, $arr_left, $x1-3, $text_y-8, 0, 0, 16, 16);
			
			//Γραμμή διάστασης
			//imageline($image, $text_x, $y1, $text_x, $text_y-20, $grey);
			//imageline($image, $text_x, $text_y+20, $text_x, $y2, $grey);
			
			//Κύκλος αρχή τοίχου
			imagearc($image, $x1, $y1, 5, 5, 0, 360, $magenda);
			//Γραμμή τοίχου
			imageline($image, $x1, $y1, $x2, $y2, $black);
			//Κύκλος τέλος τοίχου
			imagearc($image, $x2, $y2, 5, 5, 0, 360, $magenda);
			//Κείμενα
			imagefttext($image, 8, 0, $text_x, $text_y, $black, $font, $name);
			imagefttext($image, 8, 0, $text_x, $text_y+10, $black, $font, $epafi);
			imagefttext($image, 8, 0, $text_x, $text_y+20, $black, $font, $pros);
			
			//imagefttext($image, 8, 0, $x1, $y1, $black, $font, "x1:". round($x1,2)."-y1:".round($y1,2));
			//imagefttext($image, 8, 0, $x2, $y2, $black, $font, "x2:". round($x2,2)."-y2:".round($y2,2));
			//imagefttext($image, 6, 0, $x1_hor, $y1_hor, $black, $font, $name."-Fhor:L=".round($fhor[0],1)."-h=".round($fhor[1],1) );
			
			//Γραμμή εμποδίου ορίζοντα
			if($fhor[0]!=0){
				imageline($image, $x1_hor, $y1_hor, $x2_hor, $y2_hor, $grey);
			}
			//Γραμμή εμποδίου προβόλου
			if($fov!=0){
				//imageline($image, $x1_ov, $y1_ov, $x2_ov, $y2_ov, $orange);
				//imageBoldLine($image, $x1_ov, $y1_ov, $x2_ov, $y2_ov, $orange, 2);
				imagelinedotted ($image, $x1_ov, $y1_ov, $x2_ov, $y2_ov, 4, $orange);
			}
			//Τα εμπόδια πλευρικών δεν σχεδιάζονται γιατί συνήθως συμπίπτουν με τους ίδιους τοίχους
			
			//Πίνακας ορίζοντα
			imagefttext($image, 6, 0, $image_x-160, 200+$draw_order*10, $black, $font, $name.":L=".round($fhor[0],1)."-h=".round($fhor[1],1) );
			//Πίνακας προβόλων
			imagefttext($image, 6, 0, $image_x-160, 220+10*$count+$draw_order*10, $black, $font, $name.":L=".round($fov,1) );
			//Πίνακας πλευρικών αριστερά
			imagefttext($image, 6, 0, $image_x-160, 240+20*$count+$draw_order*10, $black, $font, $name.":dx=".round($ffin_l[0],1)."-L=".round($ffin_l[1],1) );
			//Πίνακας πλευρικών δεξιά
			imagefttext($image, 6, 0, $image_x-160, 260+30*$count+$draw_order*10, $black, $font, $name.":dx=".round($ffin_r[0],1)."-L=".round($ffin_r[1],1) );
			
		//Το τέλος τοίχου η αρχή του επόμενου
		$current_x = $x2;
		$current_y = $y2;
		
		//ΑΝΟΙΓΜΑΤΑ ΤΟΙΧΟΥ
		$where_win=array(
		"AND"=>array(
			"user_id"=>$_SESSION['user_id'],
			"meleti_id"=>$_SESSION['meleti_id'],
			"wall_id"=>$wall["id"]
			)
		);
		$data_win = $database->select($table_win,$columns,$where_win);
		foreach($data_win as $window){

			$leftside_x=$x2;
			$leftside_y=$y2;

			$win_name=$window["name"]."(".round($window["w"],2)." x ".round($window["h"],2).")";
			$win_l=$window["w"]*$scale;
			$win_apoar=$window["apoar"]*$scale;
			
			$win_x1=$leftside_x+$win_apoar* cos(deg2rad(360-$wall_g-180));
			$win_y1=$leftside_y-$win_apoar* sin(deg2rad(360-$wall_g-180));
			$win_x2=$win_x1+$win_l* cos(deg2rad(360-$wall_g-180));
			$win_y2=$win_y1-$win_l* sin(deg2rad(360-$wall_g-180));
			$text_win_x = $win_x1+($win_l/2)* cos(deg2rad(360-$wall_g-180));
			$text_win_y = $win_y1-($win_l/2)* sin(deg2rad(360-$wall_g-180));
			
			//Γραμμή παραθύρου
			imageline($image, $win_x1, $win_y1, $win_x2, $win_y2, $red);
			
			//Όνομα παραθύρου
			imagefttext($image, 6, 0, $text_win_x, $text_win_y, $red, $font, $win_name);
			
			//Πίνακας ανοιγμάτων
			imagefttext($image, 6, 0, $image_x-280, 200+15*$c_win, $black, $font, $win_name );
		
		$c_win++;
		}//Για κάθε παράθυρο
		
		$i++;
	}//Για κάθε τοίχο
			
	if(count($points)>6){
		imagefilledpolygon($image, $points ,$i-1 ,$fill_color);
	}
	
	$e_sum=$e_sum+($current_x*$y0-$current_y*$x0);
	$ev=(abs($e_sum)/2)/($scale*($scale/100)*100);
	
	/*
	//'Ελεγχος για συμφωνία εμβαδού
	$bld_ea=systems_calc_ea();
	$bld_ev1=$bld_ea[0];
	if($bld_ev1!=$ev){
		$ev=$bld_ev1;
	}
	*/
	
	//ΥΠΟΜΝΗΜΑ
	imagefttext($image, 8, 0, 5, $image_y-50, $black, $font, "Τοιχοποιία: ΟΝΟΜΑ/ΕΠΑΦΗ/ΠΡΟΣΑΝΑΤΟΛΙΣΜΟΣ");
	imagefttext($image, 8, 0, 5, $image_y-40, $red, $font, "Ανοίγματα: ΟΝΟΜΑ");
	imagefttext($image, 8, 0, 5, $image_y-30, $black, $font, "Fhor (L: Απόσταση εμποδίου, h:σχετικό ύψος εμποδίου)" );
	imagefttext($image, 8, 0, 5, $image_y-20, $black, $font, "Fov (L:μήκος προβόλου)" );
	imagefttext($image, 8, 0, 5, $image_y-10, $black, $font, "Ffin (L:Mήκος εμποδίου, dx: απόσταση από τοίχο)" );
	//imagefttext($image, 8, 0, $image_x-200, 180, $magenda, $font, "x_max=".round($x_max,2)." - y_max".round($y_max,2));
	//imagefttext($image, 8, 0, $image_x-200, 200, $magenda, $font, "x_min=".round($x_min,2)." - y_min".round($y_min,2));
	imagefttext($image, 8, 0, $image_x-90, 160, $magenda, $font, "E=".round($ev,2)."m2");
	
	//ΠΙΝΑΚΙΔΑ
	//imagefilledrectangle($image, $image_x-5, $image_y-5, $image_x-$scale, $image_y-$scale, $light_cyan);
	$path = "file_upload/server/php/files/user_".$_SESSION["user_id"]."/meleti_".$_SESSION["meleti_id"]."/mthx_".$floor.".png";
	$create=imagepng ($image,$path);
	Header("Content-type: image/png");
	imagePNG ($image);
	imagedestroy($image);
?>

