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

if (isset($_GET['save_dxf'])){
	$floor = $_GET['floor'];
	define('INCLUDE_CHECK',true);
	require("session.php");
	require("medoo.php");
	require("class_dxfwriter.php");
	$response = save_dxf($floor);
	echo $response;
	exit;
}
require("include_check.php");



function save_dxf($floor){
	$database = new medoo(DB_NAME);
	$table="meletes_zone_adiafani";
	$table_win="meletes_zone_diafani";
	$columns="*";
	$txt = "";
	$floors=array();
	
	$building_data = $database->select("user_meletes","*",array("id"=>$_SESSION['meleti_id']));
	$building_g = $building_data[0]["pros"];
	
	if($floor==0){
		$where=array(
			"AND"=>array(
				"user_id"=>$_SESSION['user_id'],
				"meleti_id"=>$_SESSION['meleti_id']
			)
		);
		$walls = $database->select($table,$columns,$where);
		foreach ($walls as $wall){
			array_push($floors,$wall["roof"]);
		}
		$floors=array_unique($floors);
	}else{
		$floors[0]=$floor;
	}
	
	foreach($floors as $floor){
	$shape = new DXF();
	$shape->addLayer("walls".$floor, DXF_COLOR_BLUE);
	$shape->addLayer("windows".$floor, DXF_COLOR_RED);	
	
	$where_asc=array(
		"AND"=>array(
			"user_id"=>$_SESSION['user_id'],
			"meleti_id"=>$_SESSION['meleti_id'],
			"roof"=>$floor
			),
		"ORDER"=>array(
			"draw_order"=>"ASC"
			)
		);
	$data_wall = $database->select($table,$columns,$where_asc);
	
	$array_type=array(
		0=>"Αέρας",
		1=>"ΜΘΧ",
		2=>"Έδαφος",
		3=>"Μεσοτοιχία",
	);
	
	$current_x =0;
	$current_y =0;
	
		foreach ($data_wall as $wall){
			$name = $wall["name"];
			$epafi=$array_type[$wall["type"]];
			$g = round($wall["g"]);
			$g_type = $wall["g_type"];
			$l = $wall["l"];
			$draw_order = $wall["draw_order"];
			$pros=$g."o/l=".round($wall["l"])."m";
			
			$wall_l=$wall["l"];
			$h=$wall["h"];
			$d=$wall["d"];
			
			$fhor=explode("|",$wall["fhor"]);
			$fov=$wall["fov"];
			$ffin_l=explode("|",$wall["ffin_l"]);
			$ffin_r=explode("|",$wall["ffin_r"]);
			
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
				
				$x1=$current_x;
				$y1=$current_y;
				$x2=$current_x+$wall_l* cos(deg2rad($wall_g));
				$y2=$current_y-$wall_l* sin(deg2rad($wall_g));
				
				if($fhor[0]!=0){
					$x1_hor=$x1 + $fhor[0] * cos(deg2rad( (90-$wall_g) ) );
					$y1_hor=$y1 + $fhor[0] * sin(deg2rad( (90-$wall_g) ) );
					$x2_hor=$x2 + $fhor[0] * cos(deg2rad( (90-$wall_g) ) );
					$y2_hor=$y2 + $fhor[0] * sin(deg2rad( (90-$wall_g) ) );
					$fhor_h=$fhor[1];
				}
				if($fov!=0){
					$x1_ov=$x1 - $fov * cos(deg2rad( ($wall_g)-270 ) );
					$y1_ov=$y1 + $fov * sin(deg2rad( ($wall_g)-270 ) );
					$x2_ov=$x2 - $fov * cos(deg2rad( ($wall_g)-270 ) );
					$y2_ov=$y2 + $fov * sin(deg2rad( ($wall_g)-270 ) );
				}
			
			//Τοιχοποιία
			$shape->addLine($x1, $y1, 0, $x1, $y1, $h, "walls".$floor);
			$shape->addLine($x2, $y2, 0, $x2, $y2, $h, "walls".$floor);
			$shape->addLine($x1, $y1, 0, $x2, $y2, 0, "walls".$floor);
			$shape->addLine($x1, $y1, $h, $x2, $y2, $h, "walls".$floor);
			
			//Ορίζοντας
			if($fhor[0]!=0){
			$shape->addLine($x1_hor, $y1_hor, 0, $x2_hor, $y2_hor, 0, "hor".$floor);
			$shape->addLine($x1_hor, $y1_hor, 0, $x1_hor, $y1_hor, $fhor[1], "hor".$floor);
			$shape->addLine($x2_hor, $y2_hor, 0, $x2_hor, $y2_hor, $fhor[1], "hor".$floor);
			$shape->addLine($x1_hor, $y1_hor, $fhor[1], $x2_hor, $y2_hor, $fhor[1], "hor".$floor);
			}
			
			//Πρόβολος
			if($fov!=0){
			$shape->addLine($x1_ov, $y1_ov, $h, $x2_ov, $y2_ov, $h, "ov".$floor);
			$shape->addLine($x1, $y1, $h, $x1_ov, $y1_ov, $h, "ov".$floor);
			$shape->addLine($x2, $y2, $h, $x2_ov, $y2_ov, $h, "ov".$floor);
			}
			
			//$shape->addText($x1, $y1, 0, $name." - ".$epafi." - ".$pros, 4, "txt_floor".$floor);
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
				$count_win = $database->count($table_win,$where_win);
				$i=1;
				foreach($data_win as $window){
					$leftside_x=$x2;
					$leftside_y=$y2;

					$win_name=$window["name"];
					$win_l=$window["w"];
					$win_h=$window["h"];
					$win_p=$window["p"];
					$win_apoar=$window["apoar"];
					
					$win_x1=$leftside_x+$win_apoar* cos(deg2rad($wall_g-180));
					$win_y1=$leftside_y-$win_apoar* sin(deg2rad($wall_g-180));
					$win_x2=$win_x1+$win_l* cos(deg2rad($wall_g-180));
					$win_y2=$win_y1-$win_l* sin(deg2rad($wall_g-180));
					
					$i++;
					//Άνοιγμα
					$shape->addLine($win_x1, $win_y1, $win_p, $win_x2, $win_y2, $win_p, "windows".$floor);
					$shape->addLine($win_x1, $win_y1, $win_h+$win_p, $win_x2, $win_y2, $win_h+$win_p, "windows".$floor);
					$shape->addLine($win_x1, $win_y1, $win_p, $win_x1, $win_y1, $win_h+$win_p, "windows".$floor);
					$shape->addLine($win_x2, $win_y2, $win_p, $win_x2, $win_y2, $win_h+$win_p, "windows".$floor);
				}//για κάθε άνοιγμα
		}
	
	$path = "file_upload/server/php/files/user_".$_SESSION["user_id"]."/meleti_".$_SESSION["meleti_id"]."/";
	$filename = "u".$_SESSION["user_id"]."_m".$_SESSION["meleti_id"]."_floor".$floor.".dxf";
	
	$shape->SaveFile($path.$filename);
	
	$txt .= "<a href=\"includes/".$path.$filename."\" download><i class=\"fa fa-download\"></i> Κατέβασμα dxf - Όροφος-".$floor."</a><br/>";
	
	}

return $txt;
}

?>