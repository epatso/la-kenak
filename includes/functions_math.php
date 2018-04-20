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
if (isset($_GET['get_climatedistance'])){
	$climate_id = $_GET['climate_id'];
	$address_x = $_GET['address_x'];
	$address_y = $_GET['address_y'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$distanse = calc_distance_fromclimate($climate_id, $address_x, $address_y);
	echo $distanse;
	exit;
}

if (isset($_GET['get_zoneofclimate'])){
	$climate_id = $_GET['climate_id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$zone = calc_getzoneofclimate($climate_id);
	echo $zone;
	exit;
}

if (isset($_GET['closer_climate'])){
	$address_x = $_GET['address_x'];
	$address_y = $_GET['address_y'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$array = find_closer_climate($address_x, $address_y);
	echo json_encode($array); 
	exit;
}

require("include_check.php");

//Γραμμική παρεμβολή
function paremvoli($y1, $y2, $x1, $x2, $y0) {
	
	$timi = $x1 + (($x2-$x1)/($y2-$y1))*($y0-$y1);
	
	return $timi;
}


//Μετατροπή μιας στήλης από ένα πίνακα της βάσης σε Array με προεραιτική χρήση συνθήκης.
function turn_col_into_array($column, $table,$condition){
if (!$condition){
$result = mysql_query("SELECT ".$column." FROM ".$table." WHERE user_id=".$_SESSION['user_id']." AND meleti_id=".$_SESSION['meleti_id']);
}else{
$result = mysql_query("SELECT ".$column." FROM ".$table." WHERE user_id=".$_SESSION['user_id']." AND meleti_id=".$_SESSION['meleti_id']." AND ".$condition);
}
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	$array[] = $row[0];
	}
//εδώ μπορεί να προστεθεί και implode για να επιστρέφονται κατευθείαν τιμές διαχωρισμένες με κόμμα.
return $array;
}	


//Επιστρέφει την στήλη/ες στην array των στηλών με βάση ενδιάμεση τιμή
function array_lowhigh($array, $value) {

//Σε αύξουσα σειρά
sort($array); 
  
	//Εάν η τιμή μικρότερη από την πρώτη
	if($value < $array[0]){
		$value_low = $array[0];
	}
	
	//Εάν η τιμή μεγαλύτερη από την τελευταία
	if($value > count($array)-1){
		$value_high = $array[count($array)-1];
	}	
	
	//Εάν η τιμή ίση με κάποια τιμή
	foreach($array as $num){
		if($value == $num){
			$value_low = $num;
		}
	}
	
	//Εάν η τιμή ενδιάμεση δύο τιμών
	for ($i=0; $i<=count($array)-1; $i++){
		if($value>$array[$i] AND $value<$array[$i+1]){
			$value_low = $array[$i];
			$value_high = $array[$i+1];
		}
	}
	
	//Εάν κάποια τιμή (η μικρή ή η μεγάλη) δεν οριστεί τότε και οι 2 τιμές ίδιες
	if(!isset($value_low)){$value_low=$value_high;}
	if(!isset($value_high)){$value_high=$value_low;}
	
	return array($value_low,$value_high);
}


function calc_mapdistance($lat1, $lng1, $lat2, $lng2){
	$pi80 = M_PI / 180;
	$lat1 *= $pi80;
	$lng1 *= $pi80;
	$lat2 *= $pi80;
	$lng2 *= $pi80;
	 
	$r = 6372.797; // Ακτίνα της Γης σε km
	$dlat = $lat2 - $lat1;
	$dlng = $lng2 - $lng1;
	$a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
	$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
	$km = $r * $c;
	 
	$return_value = $km;
	return $return_value;
}

function calc_distance_fromclimate($climate_id, $lat2, $lng2){
	$database = new medoo(DB_NAME);
//Εύρεση των συντεταγμένων με βάση το id των κλιματικών δεδομένων
	$db_table = "vivliothiki_climate_places";
	$db_columns = "*";
	$where_id = array("id" => $climate_id);
	$select_climate = $database->select($db_table,$db_columns,$where_id);
	
	$lat1 = $select_climate[0]["x"];
	$lng1 = $select_climate[0]["y"];
			
	$return_value = calc_mapdistance($lat1, $lng1, $lat2, $lng2);
	return $return_value;
}


function calc_getzoneofclimate($climate_id){
$database = new medoo(DB_NAME);
$db_table = "vivliothiki_climate_places";
$db_columns = "zone";
$where_id = array("id" => $climate_id);
$select_climate = $database->select($db_table,$db_columns,$where_id);
	$zone = $select_climate[0];
	if($zone=="a"){$return=0;}
	if($zone=="b"){$return=1;}
	if($zone=="c"){$return=2;}
	if($zone=="d"){$return=3;}
return $return;
}


function find_closer_climate($lat2, $lng2){

	$database = new medoo(DB_NAME);
//Εύρεση των συντεταγμένων με βάση το id των κλιματικών δεδομένων
	$db_table = "vivliothiki_climate_places";
	$db_columns = "*";
	$select_climate = $database->select($db_table,$db_columns);
	
	$distance_arr = array();
	
	$i=1;
	foreach($select_climate as $data){
		$lat1 = $data["x"];
		$lng1 = $data["y"];
		$return_value = calc_mapdistance($lat1, $lng1, $lat2, $lng2);
		$distance_arr[$i]=$return_value;
	$i++;
	}
	$climate_id = array_keys($distance_arr, min($distance_arr));
	

	$where_id = array("id" => $climate_id[0]);
	$select_climate = $database->select($db_table,$db_columns,$where_id);
	$name = $select_climate[0]["place"];
	$emy = $select_climate[0]["emy"];
	
	
	return array($climate_id[0],$name,$emy);
}

//Μετατροπή συντεταγμένων από μοίρες, λεπτά, δεύτερα σε δεκαδικό
function DMStoDEC($deg,$min,$sec){

// Converts DMS ( Degrees / minutes / seconds ) 
// to decimal format longitude / latitude

    return $deg+((($min*60)+($sec))/3600);
}    

//Μετατροπή συντεταγμένων από δεκαδικό σε μοίρες, λεπτά, δεύτερα
function DECtoDMS($dec){

// Converts decimal longitude / latitude to DMS
// ( Degrees / minutes / seconds ) 

// This is the piece of code which may appear to 
// be inefficient, but to avoid issues with floating
// point math we extract the integer part and the float
// part by using a string function.

    $vars = explode(".",$dec);
    $deg = $vars[0];
    $tempma = "0.".$vars[1];

    $tempma = $tempma * 3600;
    $min = floor($tempma / 60);
    $sec = $tempma - ($min*60);

    return array("deg"=>$deg,"min"=>$min,"sec"=>$sec);
} 

//Επιστημονική μορφοποίηση αριθμού
function formatScientific($someFloat){
	$power = ($someFloat % 10) - 1;
	return ($someFloat / pow(10, $power)) . "e" . $power;
}


?>