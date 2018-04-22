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

//προβολή ή εισαγωγή στο shoutbox
if (isset($_GET['shoutbox'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
		$message = $_GET['message'];
	$return = kenak_shoutbox($message);
	echo $return;
	exit;
}

require("include_check.php");

//Ανανεώνει το shoutbox η προσθέτει κείμενο
function kenak_shoutbox($message){
	
	require("functions_interface.php");//check_input($value, $type)
	
	$database = new medoo(DB_NAME);	
	date_default_timezone_set('Europe/Athens');
	$datetime=date("Y-m-d H:i:s");
	
	if($message!="0"){
		confirm_logged_in();
		$insert_array=array(
			"user_id"=>$_SESSION['user_id'],
			"message"=>check_input($message, "string"),
			"datetime"=>$datetime
		);
		$insert_shout = $database->insert("shoutbox",$insert_array);
	}
	
	$select_where=array("ORDER"=>array("datetime" => "DESC"),"LIMIT"=>10);
	$data_shout = $database->select("shoutbox","*",$select_where);
	
	$return = "";
	foreach($data_shout as $data){
		$return .= "<div class=\"item\">";
		
		$user_image_location = "file_upload/server/php/files/user_".$data["user_id"]."/user_image.jpg";
		if(file_exists($user_image_location)){
			$user_image_tag="<img src=\"includes/".$user_image_location."\" class=\"online\" alt=\"User Image\">";
		}else{
			$user_image_tag="<img src=\"dist/img/avatar5.png\" class=\"online\" alt=\"User Image\">";
		}
		
		
		$return .= $user_image_tag;
		$return .= "<p class=\"message\">";
		$return .= "<a href=\"#\" class=\"name\">";
		$return .= "<small class=\"text-muted pull-right\"><i class=\"fa fa-clock-o\"></i> ".$data["datetime"]."</small>";
		
			$data_user = $database->select("core_users","*",array("id"=>$data["user_id"]));
			$data_user = $data_user[0];
		
		$return .= $data_user["onoma"]." ".$data_user["epwnymo"]." ";
		if($data["user_id"]==APPLICATION_ADMIN_ID){
			$return .= " <span class=\"label bg-yellow\">Διαχειριστής<span>";
		}
		$return .= "</a>".$data["message"];
		$return .= "</p></div>";	
	}

	return $return;
	
	
}

function is_connected(){
    //Έλεγχος σε τοπική εγκατάσταση εάν υπάρχει και internet
    $connected = @fsockopen("www.google.com", 80);
    if ($connected){
        $is_conn = true;
        fclose($connected);
    }else{
        $is_conn = false;
    }
    return $is_conn;
   
}//end is_connected function 

function getRealIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
  return $ipaddress;
}


?>