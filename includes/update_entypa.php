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

if (isset($_GET['updateentypa'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require("functions_meleti_general.php");
	confirm_logged_in();
	$tb = update_meleti_entypa();
	echo $tb;
	exit;
}
if (isset($_POST['saveentypa'])){
	for($i=1;$i<=3;$i++){
	${"entypo".$i} = str_replace("|^|","&",$_POST["entypo".$i]);
	}
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = save_meleti_entypa($entypo1,$entypo2,$entypo3);
	echo $tb;
	exit;
}

//Το αρχείο δεν εκτελείται μόνο του
require("include_check.php");

//Σώζει το τα έντυπα της μελέτης
function save_meleti_entypa($entypo1,$entypo2,$entypo3){

	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_entypa";
	$where_parameters=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$update_parameters = array();
	
	for($i=1;$i<=3;$i++){
	$update_parameters["entypo".$i]=${"entypo".$i};
	}
	$update = $database->update($tb, $update_parameters, $where_parameters);
	return "Επιτυχής αποθήκευση εντύπων μελέτης. Τώρα μπορείτε τυπώσετε τα έντυπα.";
}

//Δημιουργεί το τα έντυπα από πρότυπα έντυπα
function update_meleti_entypa(){

	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$table="meletes_entypa";
	$where_parameters=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$count = $database->count($table, $where_parameters);
	$protypa = $database->select("vivliothiki_entypa", "*");
	
	$update_parameters = array();
	
	foreach($protypa as $protypo){
		$update_parameters["entypo".$protypo["entypo"]]=$protypo["text"];
	}
	$update_parameters = calculate_entypa($update_parameters);
	
	if($count==0){
		$update_parameters["user_id"]=$_SESSION['user_id'];
		$update_parameters["meleti_id"]=$_SESSION['meleti_id'];
		$insert = $database->insert($table, $update_parameters);
	}else{
		$update = $database->update($table, $update_parameters, $where_parameters);
	}
	
	return "Επιτυχής δημιουργία εντύπων από πρότυπα έντυπα.";
}

//Εκτελεί όλους τους υπολογισμούς και τοποθετεί στις θέσεις του κειμένου τα αποτελέσματα
//Η array που δέχεται έχει τη μορφή array[entypo1]="Κείμενο 1", array[entypo2]="Κείμενο 2" έως 3.
//Χρησιμοποιείται στη δημιουργία του τεύχους από το πρότυπο. Στην update_meleti_entypa() παραπάνω.
function calculate_entypa($array){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$col = "*";
	
	$where_user=array("id"=>$_SESSION['user_id']);
	$where_meleti=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	//Μελετητής
	$tb_users = "core_users";
	$tb_meleti = "user_meletes";
	$user = $database->select($tb_users, $col, $where_user);
	$user=$user[0];
	$meleti = $database->select($tb_meleti, $col, $where_meleti);
	$meleti=$meleti[0];
	
	$user_name = $user["onoma"];
	$user_lastname = $user["epwnymo"];
	$user_address = $user["address"];
	$user_afm = $user["afm"];
	$eidikotita_id = $user["eidikotita"];
	$eidikotita = $database->select("core_eidikotitesmhx", "name", array("id"=>$eidikotita_id));
	$user_eidikotita=$eidikotita[0];
	
	$array_type=array(
		0=>"Μελέτη",
		1=>"ΠΕΑ",
		2=>"Εξοικονομώ"
	);
	$array_zone=array(
		0=>"Α",
		1=>"Β",
		2=>"Γ",
		3=>"Δ"
	);
	
	//Γενικά στοιχεία μελέτης
	$meleti_name = $meleti["name"];
	$meleti_perigrafi = $meleti["perigrafi"];
	$meleti_type = $meleti["type"];
	$meleti_type=$array_type[$meleti_type];
	$meleti_address = $meleti["address"];
	$meleti_x = $meleti["address_x"];
	$meleti_y = $meleti["address_y"];
	$meleti_z = $meleti["address_z"];
	$meleti_kaek = $meleti["kaek"];
	$meleti_tmima = $meleti["tmima"];
	$meleti_tmima_ar = $meleti["tmima_ar"];
	$xrisi_id = $meleti["xrisi"];
	$xrisi = $database->select("vivliothiki_conditions_building", "name", array("id"=>$xrisi_id));
	$meleti_xrisi=$xrisi[0];
	$climate_id = $meleti["climate"];
	$climate = $database->select("vivliothiki_climate_places", "place", array("id"=>$climate_id+1));
	$meleti_climate=$climate[0];
	$meleti_height = $meleti["height"];
	$meleti_zone = $meleti["zone"];
	$meleti_zone = $array_zone[$meleti_zone];
	$meleti_idioktitis = $meleti["idioktitis"];
	$meleti_idio_kathestos = $meleti["idio_kathestos"];
	$meleti_ypeythinos_type = $meleti["ypeythinos_type"];
	$meleti_ypeythinos_name = $meleti["ypeythinos_name"];
	$meleti_ypeythinos_tel = $meleti["ypeythinos_tel"];
	$meleti_ypeythinos_mail = $meleti["ypeythinos_mail"];
	
	$zones=$database->count("meletes_zones",$where);
	$mthx=$database->count("meletes_mthx",$where);
	
	//Στοιχεία - Γενικά στοιχεία (χώροι, εμβαδά)
	$building_xwroi = $database->select("meletes_xwroi","*",$where);
	//Εμβαδόν και Όγκος κτιρίου
	$building_e=0;
	$building_v=0;
	$building_e_heat=0;
	$building_v_heat=0;
	foreach($building_xwroi as $xwros){
		if($xwros["type"]==0){//Μετράει και εμβαδόν και όγκος
			$xwros_e=$xwros["l"]*$xwros["w"];
			$xwros_v=$xwros_e*$xwros["h"];
		}else{//Μετράει μόνο όγκος (4κλινής σκεπή)
			$xwros_e=0;
			$xwros_v=(1/6)*$xwros["w"]*$xwros["h"]*(2*$xwros["w"]+3*($xwros["l"]-$xwros["w"]));
		}
		$building_e+=$xwros_e;
		$building_v+=$xwros_v;
		if($xwros["zone_id"]!=0){
			$building_e_heat+=$xwros_e;
			$building_v_heat+=$xwros_v;
		}
	}
	
	if (isset($_GET['updateentypa'])){
		$directory = "file_upload/server/php/files/user_".$_SESSION['user_id']."/meleti_".$_SESSION['meleti_id']."/";
	}
	if (!isset($_GET['updateentypa'])){
		$directory = "includes/file_upload/server/php/files/user_".$_SESSION['user_id']."/meleti_".$_SESSION['meleti_id']."/";
	}
		$pics="";	
		$images = scandir($directory);
		$ignore = Array(".", "..");
		foreach($images as $curimg){
			if(!in_array($curimg, $ignore)) {
				if (strpos($curimg, 'JPG') !== false OR strpos($curimg, 'jpg') !== false){
					$pics.="<img width=\"400px\" src=\"".APPLICATION_FOLDER."includes/".$directory.$curimg."\"></img><br>";
				}
			}
		}
	
	$exoikonomo = get_meletes_stats();
	$exoikonomo1="".$exoikonomo;
	$exoikonomo = json_decode($exoikonomo);
	$kostos_syn = $exoikonomo[1]*280 + $exoikonomo[4]*50 + $exoikonomo[5]*50 + $exoikonomo[6]*50 + $exoikonomo[7]*50;
	$kostos_syn += $exoikonomo[16]*40 + $exoikonomo[13]*40 + $exoikonomo[14]*40;
	$z1[41]=$exoikonomo[16]*40;
	$z1[42]=$exoikonomo[13]*40;
	$z1[43]=$exoikonomo[14]*40;
	$z1[44]=$exoikonomo[0]*50;
	
	//Array αντιμετάθεσης
	$z = array();
	$z1 = array();

	$z[0]="{NAME}";
	$z[1]="{TYPE}";
	$z[2]="{PERIGRAFI}";
	$z[3]="{IDIOKTITIS}";
	$z[4]="{TEL}";
	$z[5]="{ADDRESS}";
	$z[6]="{KAEK}";
	$z[7]="{XY}";
	$z[8]="{TMIMA}";
	$z[9]="{XRISI}";
	$z[10]="{CLIMATE}";
	$z[11]="{ZONE}";
	$z[12]="{ZONES}";
	$z[13]="{MTHX}";
	$z[14]="{SPACE_TOTAL}";
	$z[15]="{VOLUME_TOTAL}";
	$z[16]="{SPACE_HEAT}";
	$z[17]="{VOLUME_HEAT}";
	$z[18]="{DATE}";
	$z[19]="{MIX_NAME}";
	$z[20]="{MIX_EIDIKOTITA}";
	$z[21]="{MIX_ADDRESS}";
	$z[22]="{MIX_AFM}";
	$z[23]="{IDIO_NAME}";
	$z[24]="{IDIO_ADDRESS}";
	$z[25]="{IDIO_AFM}";
	$z[26]="{IMG}";
	$z[27]="{E_AN}";
	$z[28]="{E_T_B}";
	$z[29]="{E_T_A}";
	$z[30]="{E_T_N}";
	$z[31]="{E_T_D}";
	$z[32]="{E_ORO_AIR}";
	$z[33]="{E_DAP_AIR}";
	$z[34]="{E_DAP_GROUND}";
	$z[35]="{E_T}";
	$z[36]="{KOSTOS_AN}";
	$z[37]="{KOSTOS_T_B}";
	$z[38]="{KOSTOS_T_A}";
	$z[39]="{KOSTOS_T_N}";
	$z[40]="{KOSTOS_T_D}";
	$z[41]="{KOSTOS_ORO_AIR}";
	$z[42]="{KOSTOS_DAP_AIR}";
	$z[43]="{KOSTOS_DAP_GROUND}";
	$z[44]="{KOSTOS_T}";
	$z[45]="{KOSTOS_SYN}";

	$z1[0]=$meleti_name;
	$z1[1]=$meleti_type;
	$z1[2]=$meleti_perigrafi;
	$z1[3]=$meleti_idioktitis;
	$z1[4]=$meleti_ypeythinos_tel;
	$z1[5]=$meleti_address;
	$z1[6]=$meleti_kaek;
	$z1[7]=$meleti_x."-".$meleti_y;
	$z1[8]=$meleti_tmima_ar;
	$z1[9]=$meleti_xrisi;
	$z1[10]=$meleti_climate;
	$z1[11]=$meleti_zone;
	$z1[12]=$zones;
	$z1[13]=$mthx;
	$z1[14]=$building_e;
	$z1[15]=$building_v;
	$z1[16]=$building_e_heat;
	$z1[17]=$building_v_heat;
	$z1[18]=date("d/m/y");
	$z1[19]=$user_name." ".$user_lastname;
	$z1[20]=$user_eidikotita;
	$z1[21]=$user_address;
	$z1[22]=$user_afm;
	$z1[23]=$meleti_idioktitis;
	$z1[24]=$meleti_address;
	$z1[25]="..........";
	$z1[26]=$pics;
	$z1[27]=$exoikonomo[1];
	$z1[28]=$exoikonomo[4];
	$z1[29]=$exoikonomo[5];
	$z1[30]=$exoikonomo[6];
	$z1[31]=$exoikonomo[7];
	$z1[32]=$exoikonomo[16];
	$z1[33]=$exoikonomo[13];
	$z1[34]=$exoikonomo[14];
	$z1[35]=$exoikonomo[0];
	$z1[36]=$exoikonomo[1]*280;
	$z1[37]=$exoikonomo[4]*50;
	$z1[38]=$exoikonomo[5]*50;
	$z1[39]=$exoikonomo[6]*50;
	$z1[40]=$exoikonomo[7]*50;
	$z1[41]=$exoikonomo[16]*40;
	$z1[42]=$exoikonomo[13]*40;
	$z1[43]=$exoikonomo[14]*40;
	$z1[44]=$exoikonomo[0]*50;
	$z1[45]=$kostos_syn;

	for($i=1;$i<=3;$i++){
		$array["entypo".$i] = str_replace($z, $z1, $array["entypo".$i]);
	}
	
	return $array;
	
}

?>