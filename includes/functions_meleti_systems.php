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


if (isset($_GET['getthermp'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_thermp($page);
	echo $tb;
	exit;
}
if (isset($_GET['getthermd'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_thermd($page);
	echo $tb;
	exit;
}
if (isset($_GET['getthermt'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_thermt($page);
	echo $tb;
	exit;
}
if (isset($_GET['getthermv'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_thermv($page);
	echo $tb;
	exit;
}

if (isset($_GET['getcoldp'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_coldp($page);
	echo $tb;
	exit;
}
if (isset($_GET['getcoldd'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_coldd($page);
	echo $tb;
	exit;
}
if (isset($_GET['getcoldt'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_coldt($page);
	echo $tb;
	exit;
}
if (isset($_GET['getcoldv'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_coldv($page);
	echo $tb;
	exit;
}

if (isset($_GET['getznxp'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_znxp($page);
	echo $tb;
	exit;
}
if (isset($_GET['getznxd'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_znxd($page);
	echo $tb;
	exit;
}
if (isset($_GET['getznxt'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_znxt($page);
	echo $tb;
	exit;
}
if (isset($_GET['getznxv'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_znxv($page);
	echo $tb;
	exit;
}

if (isset($_GET['getygrp'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_ygrp($page);
	echo $tb;
	exit;
}
if (isset($_GET['getygrd'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_ygrd($page);
	echo $tb;
	exit;
}
if (isset($_GET['getygrt'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_ygrt($page);
	echo $tb;
	exit;
}

if (isset($_GET['getsolar'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_solar($page);
	echo $tb;
	exit;
}
if (isset($_GET['getlight'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_light($page);
	echo $tb;
	exit;
}
if (isset($_GET['getaerp'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sys_aerp($page);
	echo $tb;
	exit;
}

if (isset($_GET['systems_theoretical'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = systems_theoretical();
	echo $tb;
	exit;
}
if (isset($_GET['systems_remove'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = systems_remove();
	echo $tb;
	exit;
}
if (isset($_GET['systems_zonee'])){
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$e = systems_zone_e($id);
	echo $e;
	exit;
}



require("include_check.php");
//require("functions_meleti_general.php");

//Υπολογισμός παράπλευρης Α
function systems_calc_ea(){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb_xwroi = "meletes_xwroi";
	$tb_walls = "meletes_zone_adiafani";
	$tb_floors = "meletes_zone_dapeda";
	$tb_roofs = "meletes_zone_orofes";
	$col = "*";
	$session_array=array("AND"=>array(
		"user_id"=>$_SESSION['user_id'],
		"meleti_id"=>$_SESSION['meleti_id']
		)
	);
	
	//Εμβαδόν Ε
	$bld_e = 0;
	$select_xwroi = $database->select($tb_xwroi, $col, $session_array);
	foreach($select_xwroi as $xwroi){
		if($xwroi["type"]==0){//Μετράει και εμβαδόν και όγκος
			$xwros_e = $xwroi["l"]*$xwroi["w"];
		}else{//Μετράει μόνο όγκος (4κλινής σκεπή)
			$xwros_e=0;
		}
	$bld_e += $xwros_e;
	}
	
	//Παράπλευρη Α
	$bld_a = 0;
	
	//Τοιχοποιία (περιλαμβάνει και τα παράθυρα
	$select_walls = $database->select($tb_walls, $col, $session_array);
	foreach($select_walls as $wall){
		if($wall["type"]>=0 AND $wall["type"]<=2){//Δεν είναι 3 δηλαδή μεσοτοιχία
			$wall_e = $wall["l"]*$wall["h"] +$wall["l"]*$wall["dy"]*0.5;
		}else{//είναι 3 δηλαδή μεσοτοιχία
			$wall_e=0;
		}
	$bld_a += $wall_e;
	}
	
	//Δάπεδα
	$select_floors = $database->select($tb_floors, $col, $session_array);
	foreach($select_floors as $floor){
		$floor_e = $floor["e"];
	$bld_a += $floor_e;
	}
	
	//Οροφές
	$select_roofs = $database->select($tb_roofs, $col, $session_array);
	foreach($select_roofs as $roof){
		$roof_e = $roof["e"];
	$bld_a += $roof_e;
	}
	return array($bld_e,$bld_a);
}

//Εισαγωγή θεωρητικών συστημάτων για όλες τις ζώνες του κτιρίου
function systems_theoretical(){
	confirm_logged_in();
	
	//Διαγράφει όλα τα συστήματα
	systems_remove();
	
	$database = new medoo(DB_NAME);
	$tb_synthikes = "vivliothiki_conditions_zone";
	$tb_meletes = "user_meletes";
	$tb_zones = "meletes_zones";
	$tb_xwroi = "meletes_xwroi";
	$tb_thermp = "meletes_zone_sys_thermp";
	$tb_thermd = "meletes_zone_sys_thermd";
	$tb_thermt = "meletes_zone_sys_thermt";
	$tb_thermv = "meletes_zone_sys_thermv";
	$tb_coldp = "meletes_zone_sys_coldp";
	$tb_coldd = "meletes_zone_sys_coldd";
	$tb_coldt = "meletes_zone_sys_coldt";
	$tb_coldv = "meletes_zone_sys_coldv";
	$tb_znxp = "meletes_zone_sys_znxp";
	$tb_znxd = "meletes_zone_sys_znxd";
	$tb_znxt = "meletes_zone_sys_znxt";
	$tb_znxv = "meletes_zone_sys_znxv";
	$tb_solar = "meletes_zone_sys_solar";
	$tb_light = "meletes_zone_sys_light";
	$tb_aerp = "meletes_zone_sys_aerp";
	$tb_ygrp = "meletes_zone_sys_ygrp";
	$tb_ygrd = "meletes_zone_sys_ygrd";
	$tb_ygrt = "meletes_zone_sys_ygrt";
	$col = "*";
	
	$months = array(
		0=>"jan",
		1=>"feb",
		2=>"mar",
		3=>"apr",
		4=>"may",
		5=>"jun",
		6=>"jul",
		7=>"aug",
		8=>"sep",
		9=>"okt",
		10=>"nov",
		11=>"dec"
	);
	$session_array=array(
		"user_id"=>$_SESSION['user_id'],
		"meleti_id"=>$_SESSION['meleti_id']
	);
	
	$txt="";
	
	//Επιλογές select = Η 1η αφορά τα στοιχεία ζώνης, η 2η τον πίνακα μελετών.
	$where_session=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$whereid_session=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	
	//Επιλογή μελέτης - στοιχεία ζώνης και χρήσης
	$meletes = $database->select($tb_meletes,$col,$whereid_session);
	$zone=$meletes[0]["zone"];//Κλιματική ζώνη
	$xrisi=$meletes[0]["xrisi"];//Η χρήση του κτιρίου - Δεν χρησιμοποιείται πουθενά εδώ-Επιλογή με βάση χρήσεις θερμικής ζώνης παρακάτω
	
	//Συντελεστές μηνών από πίνακες - Επιλογή πινάκων με βάση κλιματική ζώνη
	if($zone==0 OR $zone==1){
		$tb_months_heat = "vivliothiki_monthsoff_heat_a";
		$tb_months_cold = "vivliothiki_monthsoff_cold_a";
	}else{
		$tb_months_heat = "vivliothiki_monthsoff_heat_c";
		$tb_months_cold = "vivliothiki_monthsoff_cold_c";
	}
	
	//Επιλογή ζώνων και loop για κάθε ζώνη
	$zones = $database->select($tb_zones,$col,$where_session);
	foreach ($zones as $zone){
		$where_zone=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$zone["id"]));
		$xwroi = $database->select($tb_xwroi,$col,$where_zone);
		$zone_e=0;
		foreach($xwroi as $xwros){
			if($xwros["type"]==0){//Μετράει και εμβαδόν και όγκος
				$xwros_e=$xwros["l"]*$xwros["w"];
				$xwros_v=$xwros_e*$xwros["h"];
			}else{//Μετράει μόνο όγκος (4κλινής σκεπή)
				$xwros_e=0;
				$xwros_v=(1/6)*$data["w"]*$data["h"]*(2*$data["w"]+3*($data["l"]-$data["w"]));
			}
			$zone_e+=$xwros_e;
		}
		
		//Συντελεστές μηνών σε array με βάση τη χρήση
		$month_values_heat = $database->select($tb_months_heat,$col,array("xrisi"=>$zone["xrisi"]));
		$month_values_cold = $database->select($tb_months_cold,$col,array("xrisi"=>$zone["xrisi"]));
		$month_values_heat=$month_values_heat[0];
		$month_values_cold=$month_values_cold[0];
		
		//Επιλογή συντελεστών συνθηκών με βάση τη χρήση
		$synthikes = $database->select($tb_synthikes,$col,array("id"=>$zone["xrisi"]));
		$synthikes = $synthikes[0];
		
		//ΘΕΡΜΑΝΣΗ
		//Θέρμανση παραγωγή
		$query_thermp = $session_array;
		$query_thermp["zone_id"] = $zone["id"];
		$query_thermp["type"] = 7;
		$query_thermp["pigi"] = 2;
		$query_thermp["w"] = 0;
		$query_thermp["n"] = 1;
		$query_thermp["cop"] = 1;
			foreach($months as $month){
				$query_thermp[$month]=$month_values_heat[$month];
			}
		$query_thermp = array_map('strval', $query_thermp);//array όλες οι τιμές σε string
		$insert = $database->insert($tb_thermp, $query_thermp);
		
		//Θέρμανση διανομή
		$query_thermd = $session_array;
		$query_thermd["zone_id"] = $zone["id"];
		$query_thermd["d_w"] = 0;
		$query_thermd["d_type"] = 0;
		$query_thermd["d_n"] = 1;
		$query_thermd["a_type"] = 0;
		$query_thermd["a_insulation"] = 0;
		$query_thermd = array_map('strval', $query_thermd);//array όλες οι τιμές σε string
		$insert = $database->insert($tb_thermd, $query_thermd);
		
		//Θέρμανση τερματικές
		$query_thermt = $session_array;
		$query_thermt["zone_id"] = $zone["id"];
		$query_thermt["type"] = 0;
		$query_thermt["n"] = 0.94;
		$query_thermt = array_map('strval', $query_thermt);//array όλες οι τιμές σε string
		$insert = $database->insert($tb_thermt, $query_thermt);
		
		//Θέρμανση βοηθητικές
		$query_thermv = $session_array;
		$query_thermv["zone_id"] = $zone["id"];
		$query_thermv["type"] = 0;
		$query_thermv["n"] = 0;
		$query_thermv["w"] = 0;
		$query_thermv = array_map('strval', $query_thermv);//array όλες οι τιμές σε string
		$insert = $database->insert($tb_thermv, $query_thermv);
		
		//ΨΥΞΗ
		//Ψύξη παραγωγή
		$query_coldp = $session_array;
		$query_coldp["zone_id"] = $zone["id"];
		$query_coldp["type"] = 3;
		$query_coldp["pigi"] = 2;
		$query_coldp["w"] = 0;
		$query_coldp["n"] = 1;
			if($zone["xrisi"]==1){
				$coldp_eer=1.7;
				$n_mon=0.5;
			}else{
				$coldp_eer=2.2;
				$n_mon=1;
			}
		$query_coldp["eer"] = $coldp_eer;
			foreach($months as $month){
				$query_coldp[$month]=$month_values_cold[$month]*$n_mon;
			}
		$query_coldp = array_map('strval', $query_coldp);//array όλες οι τιμές σε string
		$insert = $database->insert($tb_coldp, $query_coldp);
		
		//Ψύξη διανομή
		$query_coldd = $session_array;
		$query_coldd["zone_id"] = $zone["id"];
		$query_coldd["d_w"] = 0;
		$query_coldd["d_type"] = 0;
			if($zone["xrisi"]==1){
				$coldd_n=1;
			}else{
				$coldd_n=0.95;
			}
		$query_coldd["d_n"] = $coldd_n;
		$query_coldd["a_type"] = 0;
		$query_coldd["a_insulation"] = 0;
		$query_coldd = array_map('strval', $query_coldd);//array όλες οι τιμές σε string
		$insert = $database->insert($tb_coldd, $query_coldd);
		
		//Ψύξη τερματικές
		$query_coldt = $session_array;
		$query_coldt["zone_id"] = $zone["id"];
		$query_coldt["type"] = 0;
		$query_coldt["n"] = 0.93;
		$query_coldt = array_map('strval', $query_coldt);//array όλες οι τιμές σε string
		$insert = $database->insert($tb_coldt, $query_coldt);
		
		//Ψύξη βοηθητικές
		$query_coldv = $session_array;
		$query_coldv["zone_id"] = $zone["id"];
		$query_coldv["type"] = 0;
		$query_coldv["n"] = 1;
			if($zone["xrisi"]==1){
				$coldv_w=0;
			}else{
				$coldv_w=$zone_e*0.005;
			}
		$query_coldv["w"] = $coldv_w;
		$query_coldv = array_map('strval', $query_coldv);//array όλες οι τιμές σε string
		$insert = $database->insert($tb_coldv, $query_coldv);
		
		
		//ZNX
		//ZNX παραγωγή
		$query_znxp = $session_array;
		$query_znxp["zone_id"] = $zone["id"];
		$query_znxp["type"] = 4;
		$query_znxp["pigi"] = 2;
		$query_znxp["w"] = 0;
		$query_znxp["n"] = 1;
			foreach($months as $month){
				$query_znxp[$month]=1;
			}
		$query_znxp = array_map('strval', $query_znxp);//array όλες οι τιμές σε string
		$insert = $database->insert($tb_znxp, $query_znxp);
		
		//ZNX διανομή
		$query_znxd = $session_array;
		$query_znxd["zone_id"] = $zone["id"];
		$query_znxd["type"] = 0;
		$query_znxd["ana"] = 0;
		$query_znxd["dieleysi"] = 0;
		$query_znxd["n"] = 1;
		$query_znxd = array_map('strval', $query_znxd);//array όλες οι τιμές σε string
		$insert = $database->insert($tb_znxd, $query_znxd);
		
		//ZNX τερματικές
		$query_znxt = $session_array;
		$query_znxt["zone_id"] = $zone["id"];
		$query_znxt["type"] = 0;
		$query_znxt["n"] = 0.98;
		$query_znxt = array_map('strval', $query_znxt);//array όλες οι τιμές σε string
		$insert = $database->insert($tb_znxt, $query_znxt);
		
		//ZNX βοηθητικές
		$query_znxv = $session_array;
		$query_znxv["zone_id"] = $zone["id"];
		$query_znxv["type"] = 0;
		$query_znxv["n"] = 1;
		$query_znxv["w"] = 0;
		$query_znxv = array_map('strval', $query_znxv);//array όλες οι τιμές σε string
		$insert = $database->insert($tb_znxv, $query_znxv);
		
		$txt.="<br/><br/>Για τη ζώνη:".$zone["name"]." προστέθηκαν συστήματα:<br/>";
		$txt.="Θέρμανση<br/>";
		$txt.="Ψύξη<br/>";
		$txt.="ΖΝΧ<br/>";
		
		//ΦΩΤΙΣΜΟΣ
		if($zone["xrisi"]>1){//Μόνο σε τριτογενή τομέα
			$light_w = ($synthikes["light_kw"]/1000)*$zone_e;
			//Φωτισμός παραγωγή
			$query_light = $session_array;
			$query_light["zone_id"] = $zone["id"];
			$query_light["w"] = $light_w;
			$query_light["e_per"] = 0;
			$query_light["auto_ff"] = 1;
			$query_light["auto_move"] = 0;
			$query_light["active_heat"] = 0;
			$query_light["active_safety"] = 1;
			$query_light["active_backup"] = 0;
			$query_light["wff"] = 0;
			$query_light["wpar"] = 0;
			$query_light["wffpar"] = 0;
			$query_light["zoneper"] = "0^0^0^0^0^0^0^";
			$query_light["zonem"] = "0^0^0^0^0^0^0^";
			$query_light = array_map('strval', $query_light);//array όλες οι τιμές σε string
			$insert = $database->insert($tb_light, $query_light);
			
		$txt.="Φωτισμός<br/>";
		}
		
		//ΜΗΧΑΝΙΚΟΣ ΑΕΡΙΣΜΟΣ
		if($zone["xrisi"]>1){//Μόνο σε τριτογενή τομέα
			$aerp_w = $synthikes["air_perm2"]*$zone_e;
			//Φωτισμός παραγωγή
			$query_aerp = $session_array;
			$query_aerp["zone_id"] = $zone["id"];
			$query_aerp["type"] = 0;
			$query_aerp["active_h"] = 0;
			$query_aerp["f_h"] = $aerp_w;
			$query_aerp["r_h"] = 1;
			$query_aerp["q_r_h"] = 1;
			$query_aerp["f_c"] = $aerp_w;
			$query_aerp["r_c"] = 1;
			$query_aerp["q_r_c"] = 1;
			$query_aerp["active_y"] = 0;
			$query_aerp["h_r"] = 0;
			$query_aerp["filters"] = 0;
			$query_aerp["e_vent"] = 1;
			$query_aerp = array_map('strval', $query_aerp);//array όλες οι τιμές σε string
			$insert = $database->insert($tb_aerp, $query_aerp);
		
		$txt.="ΚΚΜ<br/><br/>";
		}

	}//Για κάθε ζώνη
	
	return "<div class=\"alert alert-success alert-dismissable\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
			Επιτυχής προσθήκη θεωρητικών συστημάτων (χρήση για ΠΕΑ)<br/>".$txt."</div>";
}

//Διαγράφει όλα τα συστήματα μιας μελέτης
function systems_remove(){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tables = array(
		"meletes_zone_sys_thermp",
		"meletes_zone_sys_thermd",
		"meletes_zone_sys_thermt",
		"meletes_zone_sys_thermv",
		"meletes_zone_sys_coldp",
		"meletes_zone_sys_coldd",
		"meletes_zone_sys_coldt",
		"meletes_zone_sys_coldv",
		"meletes_zone_sys_znxp",
		"meletes_zone_sys_znxd",
		"meletes_zone_sys_znxt",
		"meletes_zone_sys_znxv",
		"meletes_zone_sys_solar",
		"meletes_zone_sys_light",
		"meletes_zone_sys_aerp",
		"meletes_zone_sys_ygrp",
		"meletes_zone_sys_ygrd",
		"meletes_zone_sys_ygrt"
	);
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	foreach ($tables as $table){
		$data_delete = $database->delete($table,$where);
	}
	return "<div class=\"alert alert-danger alert-dismissable\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
			Επιτυχής διαγραφή όλων των συστημάτων</div>";
}


//Επιστροφή εμβαδού ζώνης
function systems_zone_e($id){
	$database = new medoo(DB_NAME);
	$tb_xwroi = "meletes_xwroi";
	$col = "*";
	$zone_e = 0;
	
	$select_xwroi = $database->select($tb_xwroi, $col, array("zone_id"=>$id));
	foreach($select_xwroi as $xwroi){
		if($xwroi["type"]==0){//Μετράει και εμβαδόν και όγκος
			$xwros_e = $xwroi["l"]*$xwroi["w"];
		}else{//Μετράει μόνο όγκος (4κλινής σκεπή)
			$xwros_e=0;
		}
	$zone_e += $xwros_e;
	}
	return $zone_e;
}

// ##################################################### ΘΕΡΜΑΝΣΗ ###############################################
//Εκτύπωση πίνακα ΣΥΣΤΗΜΑΤΟΣ ΠΑΡΑΓΩΓΗΣ ΘΕΡΜΑΝΣΗΣ
function create_meletes_sys_thermp($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_thermp";
	$tb_meletes = "user_meletes";
	$col = "*";
	$months_en = array(
		0=>"jan",
		1=>"feb",
		2=>"mar",
		3=>"apr",
		4=>"may",
		5=>"jun",
		6=>"jul",
		7=>"aug",
		8=>"sep",
		9=>"okt",
		10=>"nov",
		11=>"dec"
	);
	$months_gr = array(
		0=>"Ιαν",
		1=>"Φεβ",
		2=>"Μαρ",
		3=>"Απρ",
		4=>"Μαι",
		5=>"Ιούν",
		6=>"Ιούλ",
		7=>"Αυγ",
		8=>"Σεπ",
		9=>"Οκτ",
		10=>"Νοε",
		11=>"Δεκ"
	);
	$array_type = array(
		0=>"Λέβητας",
		1=>"Κεντρική υδρόψυκτη Α.Θ.",
		2=>"Κεντική αερόψυκτη Α.Θ.",
		3=>"Τοπική αερόψυκτη Α.Θ.",
		4=>"Γεωθερμική Α.Θ. με οριζόντιο εναλλάκτη",
		5=>"Γεωθερμική Α.Θ. με κατακόρυφο εναλλάκτη",
		6=>"Κεντρική άλλου τύπου Α.Θ.",
		7=>"Τοπικές ηλεκτρικές μονάδες (καλοριφέρ ή θερμοπομποί ή άλλο)",
		8=>"Τοπικές μονάδες αερίου ή υγρού καυσίμου",
		9=>"Ανοικτές εστίες καύσης",
		10=>"Τηλεθέρμανση",
		11=>"ΣΗΘ",
		12=>"Μονάδα παραγωγής άλλου τύπου"
	);
	$array_pigi = array(
		0=>"Υγραέριο",
		1=>"Φυσικό αέριο",
		2=>"Ηλεκτρισμός",
		3=>"Πετρέλαιο θέρμανσης",
		4=>"Πετρέλαιο κίνησης",
		5=>"Τηλεθέρμανση (ΔΕΗ)",
		6=>"Τηλεθέρμανση (ΑΠΕ)",
		7=>"Βιομάζα",
		8=>"Βιομάζα τυποποιημένη",
		9=>"ΣΗΘ1",
		10=>"ΣΗΘ2",
		11=>"ΣΗΘ3",
		12=>"ΣΗΘ4",
		13=>"ΣΗΘ5",
		14=>"ΣΗΘ6",
		15=>"ΣΗΘ7",
		16=>"ΣΗΘ8",
		17=>"ΣΗΘ9",
		18=>"ΣΗΘ10"
	);
	
	
	//Εύρεση κλιματικής ζώνης και μηνών OFF - ΑΡΧΗ - #########
	$whereid=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$meletes = $database->select($tb_meletes,$col,$whereid);
	$zone=$meletes[0]["zone"];//Κλιματική ζώνη
	
	//Συντελεστές μηνών από πίνακες - Επιλογή πινάκων με βάση κλιματική ζώνη
	if($zone==0 OR $zone==1){
		$tb_months_heat = "vivliothiki_monthsoff_heat_a";
		$tb_months_cold = "vivliothiki_monthsoff_cold_a";
	}else{
		$tb_months_heat = "vivliothiki_monthsoff_heat_c";
		$tb_months_cold = "vivliothiki_monthsoff_cold_c";
	}
	//Εύρεση κλιματικής ζώνης και μηνών OFF - ΤΕΛΟΣ - #########
	
	
	//Επιλογή μονάδων παραγωγής
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_sysp = $database->select($tb,$col,$where);
	
	
	$count_sysp = count($data_sysp);
	$total_pages = ceil($count_sysp/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_sysp<$count_end){$count_end=$count_sysp;}
	
	$sysp = "<div class=\"panel panel-danger\">";
	$sysp .= "<div class=\"panel-heading\">";
	$sysp .= "<button class=\"btn btn-danger\" type=\"button\" onclick=\"form_thermp(0);\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέας μονάδας παραγωγής</button>";
	$sysp .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-fire\"></span> Θέρμανση - Μονάδες παραγωγής</h6></div></div>";
	$sysp .= "<div class=\"box-body table-responsive no-padding\">";
	$sysp .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"danger\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει η μονάδα παραγωγής\">Ζώνη</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Καύσιμο\">Πηγή ενέργειας</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Ισχύς\">P</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Βαθμός επίδοσης\">cop</a></td>";
	for ($i=0; $i<=11; $i++){
	$sysp .= "<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Συντελεστής ".$months_gr[$i]."\">".$months_gr[$i]."</a></td>";
	}
	$sysp .= "
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_sysp as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$sysp .= "<tr ondblclick=\"form_thermp(".$data["id"].");\">";
		$sysp .= "<td><span class=\"label label-primary\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones",$col,array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
			$data_zone=$data_zone[0];
		
		$sysp .= "<td>".$data_zone["name"]."</td>";
		$sysp .= "<td>".$array_type[$data["type"]]."</td>";
		$sysp .= "<td>".$array_pigi[$data["pigi"]]."</td>";
		$sysp .= "<td>".$data["w"]."</td>";
		$sysp .= "<td>".$data["n"]."</td>";
		$sysp .= "<td>".$data["cop"]."</td>";
		
		//Συντελεστές μηνών σε array με βάση τη χρήση για τη θερμική ζώνη με συγκεκριμένη χρήση
		$month_values_heat = $database->select($tb_months_heat,$col,array("xrisi"=>$data_zone["xrisi"]));
		$month_values_cold = $database->select($tb_months_cold,$col,array("xrisi"=>$data_zone["xrisi"]));
		$month_values_heat=$month_values_heat[0];
		$month_values_cold=$month_values_cold[0];
		
			for ($j=0; $j<=11; $j++){
				if($month_values_heat[$months_en[$j]]==0){
					$month_style=" style=\"background-color: #e9e9e9;\"";
				}else{
					$month_style=" style=\"background-color: #fbe1e0;\"";
				}
			$sysp .= "<td".$month_style.">".$data[$months_en[$j]]."</td>";
			}
		$sysp .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_thermp(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$sysp .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_thermp(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$sysp .= "</tr>";
		}
	$i++;
	}
	$sysp .= "</table></div><div class=\"panel-footer\">";
	
	if($count_sysp!=0){
		$sysp .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_sysp." μονάδων παραγωγής.";
	}else{
		$sysp .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$sysp .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_thermp(".$previous_page.")\"";}
	$sysp .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$sysp .= "<li".$disabled."><a href=\"#\" onclick=\"get_thermp(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_thermp(".$next_page.")\"";}
	$sysp .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$sysp .= "</ul></div></div>";
	
	return $sysp;	
}

//Εκτύπωση πίνακα ΔΙΚΤΥΟΥ ΔΙΑΝΟΜΗΣ ΘΕΡΜΑΝΣΗΣ
function create_meletes_sys_thermd($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_thermd";
	$col = "*";
	$array_type = array(
		0=>"Εσωτερικοί ή έως 20% σε εξωτερικούς",
		1=>"Πάνω από 20% σε εξωτερικούς"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_sysd = $database->select($tb,$col,$where);

	$count_sysd = count($data_sysd);
	$total_pages = ceil($count_sysd/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_sysd<$count_end){$count_end=$count_sysd;}
	
	$sysd = "<div class=\"panel panel-danger\">";
	$sysd .= "<div class=\"panel-heading\">";
	$sysd .= "<button class=\"btn btn-danger\" type=\"button\" onclick=\"form_thermd(0);\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέου δικτύου διανομής</button>";
	$sysd .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-fire\"></span> Θέρμανση - Δίκτυα διανομής</h6></div></div>";
	$sysd .= "<div class=\"box-body table-responsive no-padding\">";
	$sysd .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"danger\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει το δίκτυο διανομής\">Ζώνη</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Ισχύς\">P</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Χώρος διέλευσης δικτύου διανομής\">Διέλευση</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Μόνωση δικτύου διανομής\">Μόνωση</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_sysd as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$sysd .= "<tr ondblclick=\"form_thermd(".$data["id"].");\">";
		$sysd .= "<td rowspan=\"2\"><span class=\"label label-primary\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$sysd .= "<td rowspan=\"2\">".$data_zone[0]."</td>";
		$sysd .= "<td>Δίκτυο διανονομής θερμ. μέσου</td>";
		$sysd .= "<td>".$data["d_w"]."</td>";
		$sysd .= "<td>".$array_type[$data["d_type"]]."</td>";
		$sysd .= "<td>".$data["d_n"]."</td>";
		$sysd .= "<td style=\"background-color:#E8E8E8;\"></td>";

		$sysd .= "<td rowspan=\"2\"><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_thermd(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$sysd .= "<td rowspan=\"2\"><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_thermd(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$sysd .= "</tr>";
		$sysd .= "<tr>";
		$sysd .= "<td>Αεραγωγοί</td>";
		$sysd .= "<td style=\"background-color:#E8E8E8;\"></td>";
		$sysd .= "<td>".$array_type[$data["a_type"]]."</td>";
		$sysd .= "<td style=\"background-color:#E8E8E8;\"></td>";
			if($data["a_insulation"]==0){$insulation="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["a_insulation"]==1){$insulation="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$sysd .= "<td>".$insulation."</td>";
		$sysd .= "</tr>";
		}
	$i++;
	}
	$sysd .= "</table></div><div class=\"panel-footer\">";
	
	if($count_sysd!=0){
		$sysd .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_sysd." δικτύων διανομής.";
	}else{
		$sysd .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$sysd .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_thermd(".$previous_page.")\"";}
	$sysd .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$sysd .= "<li".$disabled."><a href=\"#\" onclick=\"get_thermd(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_thermd(".$next_page.")\"";}
	$sysd .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$sysd .= "</ul></div></div>";
	
	return $sysd;	
}

//Εκτύπωση πίνακα ΤΕΡΜΑΤΙΚΩΝ ΜΟΝΑΔΩΝ ΘΕΡΜΑΝΣΗΣ
function create_meletes_sys_thermt($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_thermt";
	$col = "*";
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_syst = $database->select($tb,$col,$where);

	$count_syst = count($data_syst);
	$total_pages = ceil($count_syst/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_syst<$count_end){$count_end=$count_syst;}
	
	$syst = "<div class=\"panel panel-danger\">";
	$syst .= "<div class=\"panel-heading\">";
	$syst .= "<button class=\"btn btn-danger\" type=\"button\" onclick=\"form_thermt(0);\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέας τερματικής μονάδας</button>";
	$syst .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-fire\"></span> Θέρμανση - Τερματικές μονάδες</h6></div></div>";
	$syst .= "<div class=\"box-body table-responsive no-padding\">";
	$syst .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"danger\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει η τερματική μονάδα\">Ζώνη</a></td>
	<td width=50%><a class=\"tip-top\" href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
	<td width=30%><a class=\"tip-top\" href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_syst as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$syst .= "<tr ondblclick=\"form_thermt(".$data["id"].");\">";
		$syst .= "<td><span class=\"label label-primary\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$syst .= "<td>".$data_zone[0]."</td>";
		$syst .= "<td>".$data["type"]."</td>";
		$syst .= "<td>".$data["n"]."</td>";
		$syst .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_thermt(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$syst .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_thermt(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$syst .= "</tr>";
		}
	$i++;
	}
	$syst .= "</table></div><div class=\"panel-footer\">";
	
	if($count_syst!=0){
		$syst .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_syst." τερματικών μονάδων.";
	}else{
		$syst .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$syst .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_thermt(".$previous_page.")\"";}
	$syst .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$syst .= "<li".$disabled."><a href=\"#\" onclick=\"get_thermt(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_thermt(".$next_page.")\"";}
	$syst .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$syst .= "</ul></div></div>";
	
	return $syst;	
}

//Εκτύπωση πίνακα ΒΟΗΘΗΤΙΚΩΝ ΜΟΝΑΔΩΝ ΘΕΡΜΑΝΣΗΣ
function create_meletes_sys_thermv($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_thermv";
	$col = "*";
	
	$array_type = array(
		0=>"Αντλίες",
		1=>"Κυκλοφορητές",
		2=>"Ηλεκτροβάνες",
		3=>"Ανεμιστήρες"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_sysv = $database->select($tb,$col,$where);

	$count_sysv = count($data_sysv);
	$total_pages = ceil($count_sysv/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_sysv<$count_end){$count_end=$count_sysv;}
	
	$sysv = "<div class=\"panel panel-danger\">";
	$sysv .= "<div class=\"panel-heading\">";
	$sysv .= "<button class=\"btn btn-danger\" type=\"button\" onclick=\"form_thermv(0);\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέας βοηθητικής μονάδας</button>";
	$sysv .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-fire\"></span> Θέρμανση - Βοηθητικές μονάδες</h6></div></div>";
	$sysv .= "<div class=\"box-body table-responsive no-padding\">";
	$sysv .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"danger\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει η βοηθητική μονάδα\">Ζώνη</a></td>
	<td width=25%><a class=\"tip-top\" href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
	<td width=25%><a class=\"tip-top\" href=\"#\" title=\"Πλήθος\">Πλήθος</a></td>
	<td width=25%><a class=\"tip-top\" href=\"#\" title=\"Ισχύς (KW)\">Ισχύς</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_sysv as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$sysv .= "<tr ondblclick=\"form_thermv(".$data["id"].");\">";
		$sysv .= "<td><span class=\"label label-primary\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$sysv .= "<td>".$data_zone[0]."</td>";
		$sysv .= "<td>".$array_type[$data["type"]]."</td>";
		$sysv .= "<td>".$data["n"]."</td>";
		$sysv .= "<td>".$data["w"]."</td>";
		$sysv .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_thermv(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$sysv .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_thermv(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$sysv .= "</tr>";
		}
	$i++;
	}
	$sysv .= "</table></div><div class=\"panel-footer\">";
	
	if($count_sysv!=0){
		$sysv .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_sysv." βοηθητικών μονάδων.";
	}else{
		$sysv .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$sysv .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_thermv(".$previous_page.")\"";}
	$sysv .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$sysv .= "<li".$disabled."><a href=\"#\" onclick=\"get_thermv(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_thermv(".$next_page.")\"";}
	$sysv .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$sysv .= "</ul></div></div>";
	
	return $sysv;	
}

// ##################################################### ΨΥΞΗ ###############################################
//Εκτύπωση πίνακα ΣΥΣΤΗΜΑΤΟΣ ΠΑΡΑΓΩΓΗΣ ΨΥΞΗΣ
function create_meletes_sys_coldp($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_coldp";
	$tb_meletes="user_meletes";
	$col = "*";
	$months_en = array(
		0=>"jan",
		1=>"feb",
		2=>"mar",
		3=>"apr",
		4=>"may",
		5=>"jun",
		6=>"jul",
		7=>"aug",
		8=>"sep",
		9=>"okt",
		10=>"nov",
		11=>"dec"
	);
	$months_gr = array(
		0=>"Ιαν",
		1=>"Φεβ",
		2=>"Μαρ",
		3=>"Απρ",
		4=>"Μαι",
		5=>"Ιούν",
		6=>"Ιούλ",
		7=>"Αυγ",
		8=>"Σεπ",
		9=>"Οκτ",
		10=>"Νοε",
		11=>"Δεκ"
	);
	$array_type = array(
		0=>"Αερόψυκτος ψύκτης",
		1=>"Υδρόψυκτος ψύκτης",
		2=>"Υδρόψυκτη Α.Θ.",
		3=>"Αερόψυκτη Α.Θ.",
		4=>"Γεωθερμική Α.Θ. με οριζόντιο εναλλάκτη",
		5=>"Γεωθερμική Α.Θ. με κατακόρυφο εναλλάκτη",
		6=>"Προσρόφησης Απορρόφησης Α.Θ.",
		7=>"Κεντρική άλλου τύπου Α.Θ.",
		8=>"Μονάδα παραγωγής άλλου τύπου"
	);
	$array_pigi = array(
		0=>"Υγραέριο",
		1=>"Φυσικό αέριο",
		2=>"Ηλεκτρισμός",
		3=>"Πετρέλαιο θέρμανσης",
		4=>"Πετρέλαιο κίνησης",
		5=>"Τηλεθέρμανση (ΔΕΗ)",
		6=>"Τηλεθέρμανση (ΑΠΕ)",
		7=>"Βιομάζα",
		8=>"Βιομάζα τυποποιημένη",
		9=>"ΣΗΘ1",
		10=>"ΣΗΘ2",
		11=>"ΣΗΘ3",
		12=>"ΣΗΘ4",
		13=>"ΣΗΘ5",
		14=>"ΣΗΘ6",
		15=>"ΣΗΘ7",
		16=>"ΣΗΘ8",
		17=>"ΣΗΘ9",
		18=>"ΣΗΘ10"
	);
	
	//Εύρεση κλιματικής ζώνης και μηνών OFF - ΑΡΧΗ - #########
	$whereid=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$meletes = $database->select($tb_meletes,$col,$whereid);
	$zone=$meletes[0]["zone"];//Κλιματική ζώνη
	
	//Συντελεστές μηνών από πίνακες - Επιλογή πινάκων με βάση κλιματική ζώνη
	if($zone==0 OR $zone==1){
		$tb_months_heat = "vivliothiki_monthsoff_heat_a";
		$tb_months_cold = "vivliothiki_monthsoff_cold_a";
	}else{
		$tb_months_heat = "vivliothiki_monthsoff_heat_c";
		$tb_months_cold = "vivliothiki_monthsoff_cold_c";
	}
	//Εύρεση κλιματικής ζώνης και μηνών OFF - ΤΕΛΟΣ - #########
	
	//Επιλογή μονάδων παραγωγής
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_sysp = $database->select($tb,$col,$where);
	
	
	$count_sysp = count($data_sysp);
	$total_pages = ceil($count_sysp/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_sysp<$count_end){$count_end=$count_sysp;}
	
	$sysp = "<div class=\"panel panel-info\">";
	$sysp .= "<div class=\"panel-heading\">";
	$sysp .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_coldp(0);\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέας μονάδας παραγωγής</button>";
	$sysp .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-random\"></span> Ψύξη</h6></div></div>";
	$sysp .= "<div class=\"box-body table-responsive no-padding\">";
	$sysp .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"info\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει η μονάδα παραγωγής\">Ζώνη</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Καύσιμο\">Πηγή ενέργειας</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Ισχύς\">P</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Βαθμός επίδοσης\">eer</a></td>";
	for ($i=0; $i<=11; $i++){
	$sysp .= "<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Συντελεστής ".$months_gr[$i]."\">".$months_gr[$i]."</a></td>";
	}
	$sysp .= "
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_sysp as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$sysp .= "<tr ondblclick=\"form_coldp(".$data["id"].");\">";
		$sysp .= "<td><span class=\"label label-primary\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones",$col,array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
			$data_zone=$data_zone[0];
		
		$sysp .= "<td>".$data_zone["name"]."</td>";
		$sysp .= "<td>".$array_type[$data["type"]]."</td>";
		$sysp .= "<td>".$array_pigi[$data["pigi"]]."</td>";
		$sysp .= "<td>".$data["w"]."</td>";
		$sysp .= "<td>".$data["n"]."</td>";
		$sysp .= "<td>".$data["eer"]."</td>";
		
		//Συντελεστές μηνών σε array με βάση τη χρήση για τη θερμική ζώνη με συγκεκριμένη χρήση
		$month_values_heat = $database->select($tb_months_heat,$col,array("xrisi"=>$data_zone["xrisi"]));
		$month_values_cold = $database->select($tb_months_cold,$col,array("xrisi"=>$data_zone["xrisi"]));
		$month_values_heat=$month_values_heat[0];
		$month_values_cold=$month_values_cold[0];
		
			for ($j=0; $j<=11; $j++){
				if($month_values_cold[$months_en[$j]]==0){
					$month_style=" style=\"background-color: #e9e9e9;\"";
				}else{
					$month_style=" style=\"background-color: #e5effd;\"";
				}
			$sysp .= "<td".$month_style.">".$data[$months_en[$j]]."</td>";
			}
		$sysp .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_coldp(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$sysp .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_coldp(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$sysp .= "</tr>";
		}
	$i++;
	}
	$sysp .= "</table></div><div class=\"panel-footer\">";
	
	if($count_sysp!=0){
		$sysp .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_sysp." μονάδων παραγωγής.";
	}else{
		$sysp .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$sysp .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_coldp(".$previous_page.")\"";}
	$sysp .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$sysp .= "<li".$disabled."><a href=\"#\" onclick=\"get_coldp(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_coldp(".$next_page.")\"";}
	$sysp .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$sysp .= "</ul></div></div>";
	
	return $sysp;	
}

//Εκτύπωση πίνακα ΔΙΚΤΥΟΥ ΔΙΑΝΟΜΗΣ ΨΥΞΗΣ
function create_meletes_sys_coldd($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_coldd";
	$col = "*";
	$array_type = array(
		0=>"Εσωτερικοί ή έως 20% σε εξωτερικούς",
		1=>"Πάνω από 20% σε εξωτερικούς"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_sysd = $database->select($tb,$col,$where);

	$count_sysd = count($data_sysd);
	$total_pages = ceil($count_sysd/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_sysd<$count_end){$count_end=$count_sysd;}
	
	$sysd = "<div class=\"panel panel-info\">";
	$sysd .= "<div class=\"panel-heading\">";
	$sysd .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_coldd(0);\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέου δικτύου διανομής</button>";
	$sysd .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-random\"></span> Ψύξη</h6></div></div>";
	$sysd .= "<div class=\"box-body table-responsive no-padding\">";
	$sysd .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"info\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει το δίκτυο διανομής\">Ζώνη</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Ισχύς\">P</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Χώρος διέλευσης δικτύου διανομής\">Διέλευση</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Μόνωση δικτύου διανομής\">Μόνωση</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_sysd as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$sysd .= "<tr ondblclick=\"form_coldd(".$data["id"].");\">";
		$sysd .= "<td rowspan=\"2\"><span class=\"label label-primary\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$sysd .= "<td rowspan=\"2\">".$data_zone[0]."</td>";
		$sysd .= "<td>Δίκτυο διανονομής ψυχρού μέσου</td>";
		$sysd .= "<td>".$data["d_w"]."</td>";
		$sysd .= "<td>".$array_type[$data["d_type"]]."</td>";
		$sysd .= "<td>".$data["d_n"]."</td>";
		$sysd .= "<td style=\"background-color:#E8E8E8;\"></td>";

		$sysd .= "<td rowspan=\"2\"><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_coldd(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$sysd .= "<td rowspan=\"2\"><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_coldd(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$sysd .= "</tr>";
		$sysd .= "<tr>";
		$sysd .= "<td>Αεραγωγοί</td>";
		$sysd .= "<td style=\"background-color:#E8E8E8;\"></td>";
		$sysd .= "<td>".$array_type[$data["a_type"]]."</td>";
		$sysd .= "<td style=\"background-color:#E8E8E8;\"></td>";
			if($data["a_insulation"]==0){$insulation="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["a_insulation"]==1){$insulation="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$sysd .= "<td>".$insulation."</td>";
		$sysd .= "</tr>";
		}
	$i++;
	}
	$sysd .= "</table></div><div class=\"panel-footer\">";
	
	if($count_sysd!=0){
		$sysd .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_sysd." δικτύων διανομής.";
	}else{
		$sysd .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$sysd .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_coldd(".$previous_page.")\"";}
	$sysd .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$sysd .= "<li".$disabled."><a href=\"#\" onclick=\"get_coldd(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_coldd(".$next_page.")\"";}
	$sysd .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$sysd .= "</ul></div></div>";
	
	return $sysd;	
}

//Εκτύπωση πίνακα ΤΕΡΜΑΤΙΚΩΝ ΜΟΝΑΔΩΝ ΨΥΞΗΣ
function create_meletes_sys_coldt($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_coldt";
	$col = "*";
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_syst = $database->select($tb,$col,$where);

	$count_syst = count($data_syst);
	$total_pages = ceil($count_syst/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_syst<$count_end){$count_end=$count_syst;}
	
	$syst = "<div class=\"panel panel-info\">";
	$syst .= "<div class=\"panel-heading\">";
	$syst .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_coldt(0);\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέας τερματικής μονάδας</button>";
	$syst .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-random\"></span> Ψύξη</h6></div></div>";
	$syst .= "<div class=\"box-body table-responsive no-padding\">";
	$syst .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"info\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει η τερματική μονάδα\">Ζώνη</a></td>
	<td width=50%><a class=\"tip-top\" href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
	<td width=30%><a class=\"tip-top\" href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_syst as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$syst .= "<tr ondblclick=\"form_coldt(".$data["id"].");\">";
		$syst .= "<td><span class=\"label label-primary\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$syst .= "<td>".$data_zone[0]."</td>";
		$syst .= "<td>".$data["type"]."</td>";
		$syst .= "<td>".$data["n"]."</td>";
		$syst .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_coldt(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$syst .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_coldt(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$syst .= "</tr>";
		}
	$i++;
	}
	$syst .= "</table></div><div class=\"panel-footer\">";
	
	if($count_syst!=0){
		$syst .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_syst." τερματικών μονάδων.";
	}else{
		$syst .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$syst .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_coldt(".$previous_page.")\"";}
	$syst .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$syst .= "<li".$disabled."><a href=\"#\" onclick=\"get_coldt(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_coldt(".$next_page.")\"";}
	$syst .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$syst .= "</ul></div></div>";
	
	return $syst;	
}

//Εκτύπωση πίνακα ΒΟΗΘΗΤΙΚΩΝ ΜΟΝΑΔΩΝ ΨΥΞΗΣ
function create_meletes_sys_coldv($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_coldv";
	$col = "*";
	
	$array_type = array(
		0=>"Αντλίες",
		1=>"Κυκλοφορητές",
		2=>"Ηλεκτροβάνες",
		3=>"Ανεμιστήρες",
		4=>"Πύργος ψύξης"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_sysv = $database->select($tb,$col,$where);

	$count_sysv = count($data_sysv);
	$total_pages = ceil($count_sysv/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_sysv<$count_end){$count_end=$count_sysv;}
	
	$sysv = "<div class=\"panel panel-info\">";
	$sysv .= "<div class=\"panel-heading\">";
	$sysv .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_coldv(0);\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέας βοηθητικής μονάδας</button>";
	$sysv .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-random\"></span> Ψύξη</h6></div></div>";
	$sysv .= "<div class=\"box-body table-responsive no-padding\">";
	$sysv .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"info\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει η βοηθητική μονάδα\">Ζώνη</a></td>
	<td width=25%><a class=\"tip-top\" href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
	<td width=25%><a class=\"tip-top\" href=\"#\" title=\"Πλήθος\">Πλήθος</a></td>
	<td width=25%><a class=\"tip-top\" href=\"#\" title=\"Ισχύς (KW)\">Ισχύς</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_sysv as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$sysv .= "<tr ondblclick=\"form_coldv(".$data["id"].");\">";
		$sysv .= "<td><span class=\"label label-primary\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$sysv .= "<td>".$data_zone[0]."</td>";
		$sysv .= "<td>".$array_type[$data["type"]]."</td>";
		$sysv .= "<td>".$data["n"]."</td>";
		$sysv .= "<td>".$data["w"]."</td>";
		$sysv .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_coldv(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$sysv .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_coldv(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$sysv .= "</tr>";
		}
	$i++;
	}
	$sysv .= "</table></div><div class=\"panel-footer\">";
	
	if($count_sysv!=0){
		$sysv .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_sysv." βοηθητικών μονάδων.";
	}else{
		$sysv .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$sysv .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_coldv(".$previous_page.")\"";}
	$sysv .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$sysv .= "<li".$disabled."><a href=\"#\" onclick=\"get_coldv(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_coldv(".$next_page.")\"";}
	$sysv .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$sysv .= "</ul></div></div>";
	
	return $sysv;	
}


// ##################################################### ZNX ###############################################
//Εκτύπωση πίνακα ΣΥΣΤΗΜΑΤΟΣ ΠΑΡΑΓΩΓΗΣ ZNX
function create_meletes_sys_znxp($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_znxp";
	$col = "*";
	$months_en = array(
		0=>"jan",
		1=>"feb",
		2=>"mar",
		3=>"apr",
		4=>"may",
		5=>"jun",
		6=>"jul",
		7=>"aug",
		8=>"sep",
		9=>"okt",
		10=>"nov",
		11=>"dec"
	);
	$months_gr = array(
		0=>"Ιαν",
		1=>"Φεβ",
		2=>"Μαρ",
		3=>"Απρ",
		4=>"Μαι",
		5=>"Ιούν",
		6=>"Ιούλ",
		7=>"Αυγ",
		8=>"Σεπ",
		9=>"Οκτ",
		10=>"Νοε",
		11=>"Δεκ"
	);
	$array_type = array(
		0=>"Λέβητας",
		1=>"Τηλεθέρμανση",
		2=>"ΣΗΘ",
		3=>"Αντλία θερμότητας (Α.Θ.)",
		4=>"Τοπικός ηλεκτρικός θερμαντήρας",
		5=>"Τοπική μονάδα φυσικού αερίου",
		6=>"Μονάδα παραγωγής (κεντρική) άλλου τύπου"
	);
	$array_pigi = array(
		0=>"Υγραέριο",
		1=>"Φυσικό αέριο",
		2=>"Ηλεκτρισμός",
		3=>"Πετρέλαιο θέρμανσης",
		4=>"Πετρέλαιο κίνησης",
		5=>"Τηλεθέρμανση (ΔΕΗ)",
		6=>"Τηλεθέρμανση (ΑΠΕ)",
		7=>"Βιομάζα",
		8=>"Βιομάζα τυποποιημένη",
		9=>"ΣΗΘ1",
		10=>"ΣΗΘ2",
		11=>"ΣΗΘ3",
		12=>"ΣΗΘ4",
		13=>"ΣΗΘ5",
		14=>"ΣΗΘ6",
		15=>"ΣΗΘ7",
		16=>"ΣΗΘ8",
		17=>"ΣΗΘ9",
		18=>"ΣΗΘ10"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_sysp = $database->select($tb,$col,$where);
	
	
	$count_sysp = count($data_sysp);
	$total_pages = ceil($count_sysp/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_sysp<$count_end){$count_end=$count_sysp;}
	
	$sysp = "<div class=\"panel panel-znx\">";
	$sysp .= "<div class=\"panel-heading\">";
	$sysp .= "<button class=\"btn btn-znx\" type=\"button\" onclick=\"form_znxp(0);\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέας μονάδας παραγωγής</button>";
	$sysp .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-filter\"></span> ZNX</h6></div></div>";
	$sysp .= "<div class=\"box-body table-responsive no-padding\">";
	$sysp .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"znx\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει η μονάδα παραγωγής\">Ζώνη</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Καύσιμο\">Πηγή ενέργειας</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Ισχύς\">P</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>";
	for ($i=0; $i<=11; $i++){
	$sysp .= "<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Συντελεστής ".$months_gr[$i]."\">".$months_gr[$i]."</a></td>";
	}
	$sysp .= "
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_sysp as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$sysp .= "<tr ondblclick=\"form_znxp(".$data["id"].");\">";
		$sysp .= "<td><span class=\"label label-primary\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$sysp .= "<td>".$data_zone[0]."</td>";
		$sysp .= "<td>".$array_type[$data["type"]]."</td>";
		$sysp .= "<td>".$array_pigi[$data["pigi"]]."</td>";
		$sysp .= "<td>".$data["w"]."</td>";
		$sysp .= "<td>".$data["n"]."</td>";
			for ($j=0; $j<=11; $j++){
			$sysp .= "<td>".$data[$months_en[$j]]."</td>";
			}
		$sysp .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_znxp(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$sysp .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_znxp(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$sysp .= "</tr>";
		}
	$i++;
	}
	$sysp .= "</table></div><div class=\"panel-footer\">";
	
	if($count_sysp!=0){
		$sysp .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_sysp." μονάδων παραγωγής.";
	}else{
		$sysp .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$sysp .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_znxp(".$previous_page.")\"";}
	$sysp .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$sysp .= "<li".$disabled."><a href=\"#\" onclick=\"get_znxp(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_znxp(".$next_page.")\"";}
	$sysp .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$sysp .= "</ul></div></div>";
	
	return $sysp;	
}

//Εκτύπωση πίνακα ΔΙΚΤΥΟΥ ΔΙΑΝΟΜΗΣ ZNX
function create_meletes_sys_znxd($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_znxd";
	$col = "*";
	$array_type = array(
		0=>"Εσωτερικοί ή έως 20% σε εξωτερικούς",
		1=>"Πάνω από 20% σε εξωτερικούς"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_sysd = $database->select($tb,$col,$where);

	$count_sysd = count($data_sysd);
	$total_pages = ceil($count_sysd/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_sysd<$count_end){$count_end=$count_sysd;}
	
	$sysd = "<div class=\"panel panel-znx\">";
	$sysd .= "<div class=\"panel-heading\">";
	$sysd .= "<button class=\"btn btn-znx\" type=\"button\" onclick=\"form_znxd(0);\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέου δικτύου διανομής</button>";
	$sysd .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-filter\"></span> ZNX</h6></div></div>";
	$sysd .= "<div class=\"box-body table-responsive no-padding\">";
	$sysd .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"znx\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει το δίκτυο διανομής\">Ζώνη</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Ανακυκλοφορία\">Ανακυκλοφορία</a></td>
	<td width=30%><a class=\"tip-top\" href=\"#\" title=\"Χώρος διέλευσης δικτύου διανομής\">Διέλευση</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_sysd as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$sysd .= "<tr ondblclick=\"form_znxd(".$data["id"].");\">";
		$sysd .= "<td><span class=\"label label-primary\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$sysd .= "<td>".$data_zone[0]."</td>";
		$sysd .= "<td>".$data["type"]."</td>";
			if($data["ana"]==0){$ana="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["ana"]==1){$ana="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$sysd .= "<td>".$ana."</td>";
		$sysd .= "<td>".$array_type[$data["dieleysi"]]."</td>";
		$sysd .= "<td>".$data["n"]."</td>";
		$sysd .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_znxd(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$sysd .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_znxd(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$sysd .= "</tr>";
		}
	$i++;
	}
	$sysd .= "</table></div><div class=\"panel-footer\">";
	
	if($count_sysd!=0){
		$sysd .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_sysd." δικτύων διανομής.";
	}else{
		$sysd .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$sysd .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_znxd(".$previous_page.")\"";}
	$sysd .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$sysd .= "<li".$disabled."><a href=\"#\" onclick=\"get_znxd(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_znxd(".$next_page.")\"";}
	$sysd .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$sysd .= "</ul></div></div>";
	
	return $sysd;	
}

//Εκτύπωση πίνακα ΑΠΟΘΗΚΕΥΤΙΚΩΝ ΜΟΝΑΔΩΝ ZNX
function create_meletes_sys_znxt($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_znxt";
	$col = "*";
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_syst = $database->select($tb,$col,$where);

	$count_syst = count($data_syst);
	$total_pages = ceil($count_syst/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_syst<$count_end){$count_end=$count_syst;}
	
	$syst = "<div class=\"panel panel-znx\">";
	$syst .= "<div class=\"panel-heading\">";
	$syst .= "<button class=\"btn btn-znx\" type=\"button\" onclick=\"form_znxt(0);\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέας αποθηκευτικής μονάδας</button>";
	$syst .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-filter\"></span> ZNX</h6></div></div>";
	$syst .= "<div class=\"box-body table-responsive no-padding\">";
	$syst .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"znx\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει η τερματική μονάδα\">Ζώνη</a></td>
	<td width=50%><a class=\"tip-top\" href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
	<td width=30%><a class=\"tip-top\" href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_syst as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$syst .= "<tr ondblclick=\"form_znxt(".$data["id"].");\">";
		$syst .= "<td><span class=\"label label-primary\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$syst .= "<td>".$data_zone[0]."</td>";
		$syst .= "<td>".$data["type"]."</td>";
		$syst .= "<td>".$data["n"]."</td>";
		$syst .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_znxt(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$syst .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_znxt(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$syst .= "</tr>";
		}
	$i++;
	}
	$syst .= "</table></div><div class=\"panel-footer\">";
	
	if($count_syst!=0){
		$syst .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_syst." αποθηκευτικών μονάδων.";
	}else{
		$syst .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$syst .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_znxt(".$previous_page.")\"";}
	$syst .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$syst .= "<li".$disabled."><a href=\"#\" onclick=\"get_znxt(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_znxt(".$next_page.")\"";}
	$syst .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$syst .= "</ul></div></div>";
	
	return $syst;	
}

//Εκτύπωση πίνακα ΒΟΗΘΗΤΙΚΩΝ ΜΟΝΑΔΩΝ ZNX
function create_meletes_sys_znxv($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_znxv";
	$col = "*";
	
	$array_type = array(
		0=>"Αντλίες",
		1=>"Κυκλοφορητές",
		2=>"Ηλεκτροβάνες",
		3=>"Άλλου τύπου"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_sysv = $database->select($tb,$col,$where);

	$count_sysv = count($data_sysv);
	$total_pages = ceil($count_sysv/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_sysv<$count_end){$count_end=$count_sysv;}
	
	$sysv = "<div class=\"panel panel-znx\">";
	$sysv .= "<div class=\"panel-heading\">";
	$sysv .= "<button class=\"btn btn-znx\" type=\"button\" onclick=\"form_znxv(0);\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέας βοηθητικής μονάδας</button>";
	$sysv .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-filter\"></span> ZNX</h6></div></div>";
	$sysv .= "<div class=\"box-body table-responsive no-padding\">";
	$sysv .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"znx\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει η βοηθητική μονάδα\">Ζώνη</a></td>
	<td width=25%><a class=\"tip-top\" href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
	<td width=25%><a class=\"tip-top\" href=\"#\" title=\"Πλήθος\">Πλήθος</a></td>
	<td width=25%><a class=\"tip-top\" href=\"#\" title=\"Ισχύς (KW)\">Ισχύς</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_sysv as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$sysv .= "<tr ondblclick=\"form_znxv(".$data["id"].");\">";
		$sysv .= "<td><span class=\"label label-inverse\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$sysv .= "<td>".$data_zone[0]."</td>";
		$sysv .= "<td>".$array_type[$data["type"]]."</td>";
		$sysv .= "<td>".$data["n"]."</td>";
		$sysv .= "<td>".$data["w"]."</td>";
		$sysv .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_znxv(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$sysv .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_znxv(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$sysv .= "</tr>";
		}
	$i++;
	}
	$sysv .= "</table></div><div class=\"panel-footer\">";
	
	if($count_sysv!=0){
		$sysv .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_sysv." βοηθητικών μονάδων.";
	}else{
		$sysv .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$sysv .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_znxv(".$previous_page.")\"";}
	$sysv .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$sysv .= "<li".$disabled."><a href=\"#\" onclick=\"get_znxv(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_znxv(".$next_page.")\"";}
	$sysv .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$sysv .= "</ul></div></div>";
	
	return $sysv;	
}


// ##################################################### ΥΓΡΑΝΣΗ ###############################################
//Εκτύπωση πίνακα ΣΥΣΤΗΜΑΤΟΣ ΠΑΡΑΓΩΓΗΣ ΥΓΡΑΝΣΗ
function create_meletes_sys_ygrp($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_ygrp";
	$col = "*";
	$months_en = array(
		0=>"jan",
		1=>"feb",
		2=>"mar",
		3=>"apr",
		4=>"may",
		5=>"jun",
		6=>"jul",
		7=>"aug",
		8=>"sep",
		9=>"okt",
		10=>"nov",
		11=>"dec"
	);
	$months_gr = array(
		0=>"Ιαν",
		1=>"Φεβ",
		2=>"Μαρ",
		3=>"Απρ",
		4=>"Μαι",
		5=>"Ιούν",
		6=>"Ιούλ",
		7=>"Αυγ",
		8=>"Σεπ",
		9=>"Οκτ",
		10=>"Νοε",
		11=>"Δεκ"
	);
	$array_type = array(
		0=>"Ατμολέβητας κεντρικής παροχής",
		1=>"Τοπική μονάδα ψεκασμού",
		2=>"Τοπική μονάδα παραγωγής ατμού",
		3=>"Τοπική μονάδα άλλου τύπου"
	);
	$array_pigi = array(
		0=>"Υγραέριο",
		1=>"Φυσικό αέριο",
		2=>"Ηλεκτρισμός",
		3=>"Πετρέλαιο θέρμανσης",
		4=>"Πετρέλαιο κίνησης",
		5=>"Τηλεθέρμανση (ΔΕΗ)",
		6=>"Τηλεθέρμανση (ΑΠΕ)",
		7=>"Βιομάζα",
		8=>"Βιομάζα τυποποιημένη",
		9=>"ΣΗΘ1",
		10=>"ΣΗΘ2",
		11=>"ΣΗΘ3",
		12=>"ΣΗΘ4",
		13=>"ΣΗΘ5",
		14=>"ΣΗΘ6",
		15=>"ΣΗΘ7",
		16=>"ΣΗΘ8",
		17=>"ΣΗΘ9",
		18=>"ΣΗΘ10"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_sysp = $database->select($tb,$col,$where);
	
	
	$count_sysp = count($data_sysp);
	$total_pages = ceil($count_sysp/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_sysp<$count_end){$count_end=$count_sysp;}
	
	$sysp = "<div class=\"panel panel-success\">";
	$sysp .= "<div class=\"panel-heading\">";
	$sysp .= "<button class=\"btn btn-success\" type=\"button\" onclick=\"form_ygrp(0);\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέας μονάδας παραγωγής</button>";
	$sysp .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-tint\"></span> Ύγρανση</h6></div></div>";
	$sysp .= "<div class=\"box-body table-responsive no-padding\">";
	$sysp .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"success\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει η μονάδα παραγωγής\">Ζώνη</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Καύσιμο\">Πηγή ενέργειας</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Ισχύς\">P</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>";
	for ($i=0; $i<=11; $i++){
	$sysp .= "<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Συντελεστής ".$months_gr[$i]."\">".$months_gr[$i]."</a></td>";
	}
	$sysp .= "
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_sysp as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$sysp .= "<tr ondblclick=\"form_ygrp(".$data["id"].");\">";
		$sysp .= "<td><span class=\"label label-primary\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$sysp .= "<td>".$data_zone[0]."</td>";
		$sysp .= "<td>".$array_type[$data["type"]]."</td>";
		$sysp .= "<td>".$array_pigi[$data["pigi"]]."</td>";
		$sysp .= "<td>".$data["w"]."</td>";
		$sysp .= "<td>".$data["n"]."</td>";
			for ($j=0; $j<=11; $j++){
			$sysp .= "<td>".$data[$months_en[$j]]."</td>";
			}
		$sysp .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_ygrp(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$sysp .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_ygrp(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$sysp .= "</tr>";
		}
	$i++;
	}
	$sysp .= "</table></div><div class=\"panel-footer\">";
	
	if($count_sysp!=0){
		$sysp .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_sysp." μονάδων παραγωγής.";
	}else{
		$sysp .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$sysp .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_ygrp(".$previous_page.")\"";}
	$sysp .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$sysp .= "<li".$disabled."><a href=\"#\" onclick=\"get_ygrp(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_ygrp(".$next_page.")\"";}
	$sysp .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$sysp .= "</ul></div></div>";
	
	return $sysp;	
}

//Εκτύπωση πίνακα ΔΙΚΤΥΟΥ ΔΙΑΝΟΜΗΣ ΥΓΡΑΝΣΗ
function create_meletes_sys_ygrd($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_ygrd";
	$col = "*";
	$array_type = array(
		0=>"Εσωτερικοί ή έως 20% σε εξωτερικούς",
		1=>"Πάνω από 20% σε εξωτερικούς"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_sysd = $database->select($tb,$col,$where);

	$count_sysd = count($data_sysd);
	$total_pages = ceil($count_sysd/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_sysd<$count_end){$count_end=$count_sysd;}
	
	$sysd = "<div class=\"panel panel-success\">";
	$sysd .= "<div class=\"panel-heading\">";
	$sysd .= "<button class=\"btn btn-success\" type=\"button\" onclick=\"form_ygrd(0);\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέου δικτύου διανομής</button>";
	$sysd .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-tint\"></span> Ύγρανση</h6></div></div>";
	$sysd .= "<div class=\"box-body table-responsive no-padding\">";
	$sysd .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"success\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει το δίκτυο διανομής\">Ζώνη</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
	<td width=30%><a class=\"tip-top\" href=\"#\" title=\"Χώρος διέλευσης δικτύου διανομής\">Διέλευση</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_sysd as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$sysd .= "<tr ondblclick=\"form_ygrd(".$data["id"].");\">";
		$sysd .= "<td><span class=\"label label-primary\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$sysd .= "<td>".$data_zone[0]."</td>";
		$sysd .= "<td>".$data["type"]."</td>";
		$sysd .= "<td>".$array_type[$data["dieleysi"]]."</td>";
		$sysd .= "<td>".$data["n"]."</td>";
		$sysd .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_ygrd(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$sysd .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_ygrd(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$sysd .= "</tr>";
		}
	$i++;
	}
	$sysd .= "</table></div><div class=\"panel-footer\">";
	
	if($count_sysd!=0){
		$sysd .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_sysd." δικτύων διανομής.";
	}else{
		$sysd .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$sysd .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_ygrd(".$previous_page.")\"";}
	$sysd .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$sysd .= "<li".$disabled."><a href=\"#\" onclick=\"get_ygrd(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_ygrd(".$next_page.")\"";}
	$sysd .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$sysd .= "</ul></div></div>";
	
	return $sysd;	
}

//Εκτύπωση πίνακα ΑΠΟΘΗΚΕΥΤΙΚΩΝ ΜΟΝΑΔΩΝ ΥΓΡΑΝΣΗ
function create_meletes_sys_ygrt($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_ygrt";
	$col = "*";
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_syst = $database->select($tb,$col,$where);

	$count_syst = count($data_syst);
	$total_pages = ceil($count_syst/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_syst<$count_end){$count_end=$count_syst;}
	
	$syst = "<div class=\"panel panel-success\">";
	$syst .= "<div class=\"panel-heading\">";
	$syst .= "<button class=\"btn btn-success\" type=\"button\" onclick=\"form_ygrt(0);\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέου συστήματος διοχέτευσης</button>";
	$syst .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-tint\"></span> Ύγρανση</h6></div></div>";
	$syst .= "<div class=\"box-body table-responsive no-padding\">";
	$syst .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"success\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει η τερματική μονάδα\">Ζώνη</a></td>
	<td width=50%><a class=\"tip-top\" href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
	<td width=30%><a class=\"tip-top\" href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_syst as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$syst .= "<tr ondblclick=\"form_ygrt(".$data["id"].");\">";
		$syst .= "<td><span class=\"label label-primary\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$syst .= "<td>".$data_zone[0]."</td>";
		$syst .= "<td>".$data["type"]."</td>";
		$syst .= "<td>".$data["n"]."</td>";
		$syst .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_ygrt(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$syst .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_ygrt(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$syst .= "</tr>";
		}
	$i++;
	}
	$syst .= "</table></div><div class=\"panel-footer\">";
	
	if($count_syst!=0){
		$syst .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_syst." αποθηκευτικών μονάδων.";
	}else{
		$syst .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$syst .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_ygrt(".$previous_page.")\"";}
	$syst .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$syst .= "<li".$disabled."><a href=\"#\" onclick=\"get_ygrt(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_ygrt(".$next_page.")\"";}
	$syst .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$syst .= "</ul></div></div>";
	
	return $syst;	
}


// ##################################################### ΗΛΙΑΚΟΣ ###############################################
//Εκτύπωση πίνακα ΗΛΙΑΚΟΣ
function create_meletes_sys_solar($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_solar";
	$col = "*";
	$array_type = array(
		0=>"Χωρίς κάλυμα",
		1=>"Απλός επίπεδος",
		2=>"Επιλεκτικός επίπεδος",
		3=>"Κενού",
		4=>"Συγκεντρωτικός"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_sysp = $database->select($tb,$col,$where);
	
	
	$count_sysp = count($data_sysp);
	$total_pages = ceil($count_sysp/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_sysp<$count_end){$count_end=$count_sysp;}
	
	$sysp = "<div class=\"panel panel-solar\">";
	$sysp .= "<div class=\"panel-heading\">";
	$sysp .= "<button class=\"btn btn-solar\" type=\"button\" onclick=\"form_solar(0);\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέου ηλιακού</button>";
	$sysp .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-th\"></span> Ηλιακός</h6></div></div>";
	$sysp .= "<div class=\"box-body table-responsive no-padding\">";
	$sysp .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"solar\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει η μονάδα παραγωγής\">Ζώνη</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Τύπος συλλέκτη\">Τύπος</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Χρήση για Θέρμανση\">Θέρμανση</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Χρήση για ΖΝΧ\">ΖΝΧ</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Συντελεστής αξιοποίησης για ΖΝΧ\">συνα</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Συντελεστής αξιοποίησης για Θέρμανση\">συνβ</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Επιφάνεια συλλέκτη\">E</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Προσανατολισμός\">γ</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Κλίση συλλέκτη\">β</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Σκίαση συλλέκτη\">fs</a></td>";
	$sysp .= "
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_sysp as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$sysp .= "<tr ondblclick=\"form_solar(".$data["id"].");\">";
		$sysp .= "<td><span class=\"label label-primary\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$sysp .= "<td>".$data_zone[0]."</td>";
		$sysp .= "<td>".$array_type[$data["type"]]."</td>";
			if($data["active_h"]==0){$active_h="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["active_h"]==1){$active_h="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$sysp .= "<td>".$active_h."</td>";
			if($data["active_z"]==0){$active_z="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["active_z"]==1){$active_z="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$sysp .= "<td>".$active_z."</td>";
		$sysp .= "<td>".$data["syna"]."</td>";
		$sysp .= "<td>".$data["synb"]."</td>";
		$sysp .= "<td>".$data["e"]."</td>";
		$sysp .= "<td>".$data["g"]."</td>";
		$sysp .= "<td>".$data["b"]."</td>";
		$sysp .= "<td>".$data["fs"]."</td>";
		$sysp .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_solar(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$sysp .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_solar(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$sysp .= "</tr>";
		}
	$i++;
	}
	$sysp .= "</table></div><div class=\"panel-footer\">";
	
	if($count_sysp!=0){
		$sysp .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_sysp." ηλιακών.";
	}else{
		$sysp .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$sysp .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_solar(".$previous_page.")\"";}
	$sysp .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$sysp .= "<li".$disabled."><a href=\"#\" onclick=\"get_solar(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_solar(".$next_page.")\"";}
	$sysp .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$sysp .= "</ul></div></div>";
	
	return $sysp;	
}


// ##################################################### ΦΩΤΙΣΜΟΣ ###############################################
//Εκτύπωση πίνακα ΦΩΤΙΣΜΟΣ
function create_meletes_sys_light($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_light";
	$col = "*";
	$array_ff = array(
		0=>"1. Αυτόματος",
		1=>"2. Χειροκίνητος"
	);
	$array_move = array(
		0=>"1. Χειροκίνητος διακόπτης (αφής/σβέσης)",
		1=>"2. Χειροκίνητος διακόπτης (αφής/σβέσης) και αισθητήρας παρουσίας",
		2=>"3. Ανίχνευση με αυτόματη έναυση / ρύθμιση φωτεινής ροής (dimming)",
		3=>"4. Ανίχνευση με αυτόματη έναυση και σβέση",
		4=>"5. Ανίχνευση με χειροκίνητη έναυση / ρύθμιση φωτεινής ροής (dimming)",
		5>"6. Ανίχνευση με χειροκίνητη έναυση / αυτόματη σβέση"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_sysp = $database->select($tb,$col,$where);
	
	
	$count_sysp = count($data_sysp);
	$total_pages = ceil($count_sysp/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_sysp<$count_end){$count_end=$count_sysp;}
	
	$sysp = "<div class=\"panel panel-success\">";
	$sysp .= "<div class=\"panel-heading\">";
	$sysp .= "<button class=\"btn btn-success\" type=\"button\" onclick=\"form_light(0);\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέου φωτισμού</button>";
	$sysp .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-certificate\"></span> Φωτισμός</h6></div></div>";
	$sysp .= "<div class=\"box-body table-responsive no-padding\">";
	$sysp .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"success\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει η μονάδα παραγωγής\">Ζώνη</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Εγκατεστημένη ισχύς φωτιστικών σωμάτων\">Ισχύς</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Περιοχή ΦΦ\">Περιοχή ΦΦ</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Αυτοματισμοί ελέγχου\">Αυτ. ελέγχου</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Αυτοματισμοί ανίχνευσης κίνησης\">Αυτ. αν. κίνησης</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Σύστημα απομάκρυνσης θερμότητας\">Απομ. θερμότητας</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Φωτισμός ασφαλείας\">Φωτισμός ασφαλείας</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Σύστημα εφεδρείας\">Σύστημα εφεδρείας</a></td>";
	$sysp .= "
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_sysp as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$sysp .= "<tr ondblclick=\"form_light(".$data["id"].");\">";
		$sysp .= "<td><span class=\"label label-primary\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$sysp .= "<td>".$data_zone[0]."</td>";
		$sysp .= "<td>".$data["w"]."</td>";
		$sysp .= "<td>".$data["e_per"]."</td>";
		$sysp .= "<td>".$array_ff[$data["auto_ff"]]."</td>";
		$sysp .= "<td>".$array_move[$data["auto_move"]]."</td>";
			if($data["active_heat"]==0){$active_heat="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["active_heat"]==1){$active_heat="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$sysp .= "<td>".$active_heat."</td>";
			if($data["active_safety"]==0){$active_safety="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["active_safety"]==1){$active_safety="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$sysp .= "<td>".$active_safety."</td>";
			if($data["active_backup"]==0){$active_backup="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["active_backup"]==1){$active_backup="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$sysp .= "<td>".$active_backup."</td>";
		$sysp .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_light(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$sysp .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_light(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$sysp .= "</tr>";
		}
	$i++;
	}
	$sysp .= "</table></div><div class=\"panel-footer\">";
	
	if($count_sysp!=0){
		$sysp .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_sysp." συστημάτων φωτισμού.";
	}else{
		$sysp .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$sysp .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_light(".$previous_page.")\"";}
	$sysp .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$sysp .= "<li".$disabled."><a href=\"#\" onclick=\"get_light(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_light(".$next_page.")\"";}
	$sysp .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$sysp .= "</ul></div></div>";
	
	return $sysp;	
}

// ##################################################### ΜΗΧΑΝΙΚΟΣ ΑΕΡΙΣΜΟΣ ###############################################
//Εκτύπωση πίνακα ΜΗΧΑΝΙΚΟΣ ΑΕΡΙΣΜΟΣ
function create_meletes_sys_aerp($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_sys_aerp";
	$col = "*";
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_sysp = $database->select($tb,$col,$where);
	
	
	$count_sysp = count($data_sysp);
	$total_pages = ceil($count_sysp/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_sysp<$count_end){$count_end=$count_sysp;}
	
	$sysp = "<div class=\"panel panel-kkm\">";
	$sysp .= "<div class=\"panel-heading\">";
	$sysp .= "<button class=\"btn btn-kkm\" type=\"button\" onclick=\"form_aerp(0);\"><i class=\"fa fa-plus-circle\"></i>Προσθήκη νέας μονάδας μηχ. αερισμού</button>";
	$sysp .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-flag\"></span> Μηχανικός αερισμός</h6></div></div>";
	$sysp .= "<div class=\"box-body table-responsive no-padding\">";
	$sysp .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"kkm\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει η μονάδα παραγωγής\">Ζώνη</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Τύπος (ονομασία)\">Τύπος</a></td>
	<td width=7%><a class=\"tip-top\" href=\"#\" title=\"Ενεργό τμήμα θέρμανσης\">Τμ. θέρμανσης</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Παροχή αέρα - τμήμα θέρμανσης\">F_h</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Συντελεστής ανακυκλοφορίας αέρα - τμήμα θέρμανσης\">R_h</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Συντελεστής ανάκτησης θερμότητας - τμήμα θέρμανσης\">Q_R_h</a></td>
	<td width=7%><a class=\"tip-top\" href=\"#\" title=\"Ενεργό τμήμα θέρμανσης\">Τμ. ψύξης</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Παροχή αέρα - τμήμα ψύξης\">F_c</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Συντελεστής ανακυκλοφορίας αέρα - τμήμα ψύξης\">R_c</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Συντελεστής ανάκτησης θερμότητας - τμήμα ψύξης\">Q_R_c</a></td>
	<td width=7%><a class=\"tip-top\" href=\"#\" title=\"Ενεργό τμήμα ύγρανσης\">Τμ. ύγρανσης</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Συντελεστής ανάκτησης υγρασίας - τμήμα ύγρανσης\">H_r</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Φίλτρα\">Φίλτρα</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Ειδική ηλεκτρική ισχύς\">E_vent</a></td>";
	$sysp .= "
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_sysp as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$sysp .= "<tr ondblclick=\"form_aerp(".$data["id"].");\">";
		$sysp .= "<td><span class=\"label label-kkm\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$sysp .= "<td>".$data_zone[0]."</td>";
		$sysp .= "<td>".$data["type"]."</td>";
			if($data["active_h"]==0){$active_h="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["active_h"]==1){$active_h="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$sysp .= "<td>".$active_h."</td>";
		$sysp .= "<td>".$data["f_h"]."</td>";
		$sysp .= "<td>".$data["r_h"]."</td>";
		$sysp .= "<td>".$data["q_r_h"]."</td>";
			if($data["active_c"]==0){$active_c="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["active_c"]==1){$active_c="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$sysp .= "<td>".$active_c."</td>";
		$sysp .= "<td>".$data["f_c"]."</td>";
		$sysp .= "<td>".$data["r_c"]."</td>";
		$sysp .= "<td>".$data["q_r_c"]."</td>";
			if($data["active_y"]==0){$active_y="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["active_y"]==1){$active_y="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$sysp .= "<td>".$active_y."</td>";
		$sysp .= "<td>".$data["h_r"]."</td>";
			if($data["filters"]==0){$filters="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["filters"]==1){$filters="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$sysp .= "<td>".$filters."</td>";
		$sysp .= "<td>".$data["e_vent"]."</td>";
		$sysp .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_aerp(".$data["id"].");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$sysp .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_aerp(".$data["id"].");\"><i class=\"fa fa-times\"></i></button></td>";
		$sysp .= "</tr>";
		}
	$i++;
	}
	$sysp .= "</table></div><div class=\"panel-footer\">";
	
	if($count_sysp!=0){
		$sysp .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_sysp." συστημάτων μηχανικού αερισμού.";
	}else{
		$sysp .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$sysp .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_aerp(".$previous_page.")\"";}
	$sysp .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$sysp .= "<li".$disabled."><a href=\"#\" onclick=\"get_aerp(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_aerp(".$next_page.")\"";}
	$sysp .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$sysp .= "</ul></div></div>";
	
	return $sysp;	
}

?>