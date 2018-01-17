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

require("class_staticmap.php");

if (isset($_GET['updateteyxos'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require("functions_math.php");
	require("functions_calc.php");
	require("functions_teyxos.php");
	require("functions_skiaseis.php");
	confirm_logged_in();
	$tb = update_meleti_teyxos();
	echo $tb;
	exit;
}

if (isset($_GET['recreateprotypo'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = recreate_meleti_protypo();
	echo $tb;
	exit;
}

if (isset($_POST['saveprotypo'])){
	for($i=1;$i<=8;$i++){
	${"kef".$i} = str_replace("|^|","&",$_POST["kef".$i]);
	}
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = save_meleti_protypo($kef1,$kef2,$kef3,$kef4,$kef5,$kef6,$kef7,$kef8);
	echo $tb;
	exit;
}

if (isset($_POST['saveteyxos'])){
	for($i=1;$i<=8;$i++){
	${"kef".$i} = str_replace("|^|","&",$_POST["kef".$i]);
	}
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = save_meleti_teyxos($kef1,$kef2,$kef3,$kef4,$kef5,$kef6,$kef7,$kef8);
	echo $tb;
	exit;
}

//Το αρχείο δεν εκτελείται μόνο του
require("include_check.php");

//Δημιουργεί το τεύχος από το πρότυπο τεύχος μελέτης υπολογίζοντας όλα τα στοιχεία της μελέτης
function update_meleti_teyxos(){

	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$teyxos_table = "meletes_teyxos";
	$protypo_table = "meletes_teyxos_p";
	$col = "*";
	$where_parameters=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$count_teyxos = $database->count($teyxos_table, $where_parameters);
	$select_protypo = $database->select($protypo_table, $col, $where_parameters);
	$protypo = $select_protypo[0];
	
	$update_parameters = array();
	
	for($i=1;$i<=8;$i++){
		$update_parameters["kef".$i]=$protypo["kef".$i];
	}
	$update_parameters = calculate_teyxos($update_parameters);
	
	if($count_teyxos==0){
		$update_parameters["user_id"]=$_SESSION['user_id'];
		$update_parameters["meleti_id"]=$_SESSION['meleti_id'];
		$insert_teyxos = $database->insert($teyxos_table, $update_parameters);
	}else{
		$update_teyxos = $database->update($teyxos_table, $update_parameters, $where_parameters);
	}
	
	return "Επιτυχής δημιουργία τεύχους από το πρότυπο τεύχος μελέτης.";
	//return $database->last_query();
}

//Επαναφέρει το πρότυπο τεύχος στην αρχική του μορφή με βάση το τεύχος που υπάρχει στη βιβλιοθήκη
function recreate_meleti_protypo(){

	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$vivliothiki_table = "vivliothiki_teyxos";
	$protypo_table = "meletes_teyxos_p";
	$col = "*";
	$where_parameters=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$count_protypo = $database->count($protypo_table, $where_parameters);
	$select_vivliothiki = $database->select($vivliothiki_table, $col);
	
	$update_parameters = array();
	
	$i=1;
	foreach($select_vivliothiki as $vivliothiki){
		$update_parameters["kef".$i]=$vivliothiki["text"];
	$i++;	
	}
	
	if($count_protypo==0){
		$update_parameters["user_id"]=$_SESSION['user_id'];
		$update_parameters["meleti_id"]=$_SESSION['meleti_id'];
		$insert_teyxos = $database->insert($protypo_table, $update_parameters);
	}else{
		$update_teyxos = $database->update($protypo_table, $update_parameters, $where_parameters);
	}
	
	return "Επιτυχής επαναδημιουργία προτύπου τεύχους μελέτης";
}

//Σώζει το πρότυπο τεύχος της μελέτης
function save_meleti_protypo($kef1,$kef2,$kef3,$kef4,$kef5,$kef6,$kef7,$kef8){

	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_teyxos_p";
	$where_parameters=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$update_parameters = array();
	
	for($i=1;$i<=8;$i++){
	$update_parameters["kef".$i]=${"kef".$i};
	}
	$update = $database->update($tb, $update_parameters, $where_parameters);
	return "Επιτυχής αποθήκευση πρότυπου τεύχους μελέτης. Τώρα μπορείτε να επαναδημιουργήσετε το τεύχος με βάση το νέο πρότυπο.";
}

//Σώζει το τεύχος της μελέτης
function save_meleti_teyxos($kef1,$kef2,$kef3,$kef4,$kef5,$kef6,$kef7,$kef8){

	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_teyxos";
	$where_parameters=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$update_parameters = array();
	
	for($i=1;$i<=8;$i++){
	$update_parameters["kef".$i]=${"kef".$i};
	}
	$update = $database->update($tb, $update_parameters, $where_parameters);
	return "<div class=\"alert alert-success\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
	Επιτυχής αποθήκευση τελικού τεύχους μελέτης. Τώρα μπορείτε να εγκαταλείψετε τη σελίδα ή να τυπώσετε το τεύχος.
	</div>";
}



//Εκτελεί όλους τους υπολογισμούς και τοποθετεί στις θέσεις του κειμένου τα αποτελέσματα
//Η array που δέχεται έχει τη μορφή array[kef1]="Κείμενο 1", array[kef2]="Κείμενο 2" κλπ
//Χρησιμοποιείται στη δημιουργία του τεύχους από το πρότυπο. Στην update_meleti_teyxos() παραπάνω.
function calculate_teyxos($teyxos){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$col = "*";
	
	$where_user=array("id"=>$_SESSION['user_id']);
	//Μελετητής
	$tb_users = "core_users";
	$select_meleti = $database->select($tb_users, $col, $where_user);
	
	$user_onoma = $select_meleti[0]["onoma"];
	$user_epwnymo = $select_meleti[0]["epwnymo"];
	$user_eidikotita = $select_meleti[0]["eidikotita"];
	
	$user_fullname = $user_onoma." ".$user_epwnymo;
	
	$where_meleti=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	//Γενικά στοιχεία μελέτης
	$tb_meleti = "user_meletes";
	$tb_meleti_gendata = "meletes_stoixeiameleti";
	$select_meleti = $database->select($tb_meleti, $col, $where_meleti);
	$select_meleti_gendata = $database->select($tb_meleti_gendata, $col, $where);
	$select_meleti_gendata=$select_meleti_gendata[0];
	
	$meleti_name = $select_meleti[0]["name"];
	$meleti_perigrafi = $select_meleti[0]["perigrafi"];
	$meleti_type = $select_meleti[0]["type"];
	$meleti_address = $select_meleti[0]["address"];
	$meleti_address_x = $select_meleti[0]["address_x"];
	$meleti_address_y = $select_meleti[0]["address_y"];
	$meleti_address_z = $select_meleti[0]["address_z"];
	$meleti_kaek = $select_meleti[0]["kaek"];
	$meleti_tmima = $select_meleti[0]["tmima"];
	$meleti_tmima_ar = $select_meleti[0]["tmima_ar"];
	$meleti_xrisi = $select_meleti[0]["xrisi"];
	$meleti_climate = $select_meleti[0]["climate"];
	$meleti_height = $select_meleti[0]["height"];
	$meleti_zone = $select_meleti[0]["zone"];
	$meleti_idioktitis = $select_meleti[0]["idioktitis"];
	$meleti_idio_kathestos = $select_meleti[0]["idio_kathestos"];
	$meleti_ypeythinos_type = $select_meleti[0]["ypeythinos_type"];
	$meleti_ypeythinos_name = $select_meleti[0]["ypeythinos_name"];
	$meleti_ypeythinos_tel = $select_meleti[0]["ypeythinos_tel"];
	$meleti_ypeythinos_mail = $select_meleti[0]["ypeythinos_mail"];
	
	$place_id = $meleti_climate+1; //selectedIndex+1
	$data_place = $database->select("vivliothiki_climate_places","place",array("id"=>$place_id));
	$place = $data_place[0];
	$data_lat = $database->select("vivliothiki_climate_places","x",array("id"=>$place_id));
	$place_lat = $data_lat[0];
	$placez=round($meleti_address_z);
	
	$data_xrisi = $database->select("vivliothiki_conditions_building","name",array("id"=>$meleti_xrisi));
	$bld_xrisi = $data_xrisi[0];
	
	$array_meleti_zone = array(
		0=>"A",
		1=>"Β",
		2=>"Γ",
		3=>"Δ"
	);
	$climatezone=$array_meleti_zone[$meleti_zone];
	
	$array_odos = array(
		0=>"αγροτική",
		1=>"δημοτική",
		2=>"κοινοτική",
		3=>"επαρχιακή",
		4=>"εθνική"
	);
	$array_sxedio = array(
		0=>"εντός",
		1=>"εκτός"
	);
	
	$sxedio=$array_sxedio[$select_meleti_gendata["sxedio"]];
	$odos=$array_odos[$select_meleti_gendata["odos"]];
	$apostaseisoik=$select_meleti_gendata["apostaseis"];
	
$tb_zones = "meletes_zones";
$tb_mthx = "meletes_mthx";
$tb_xwroi = "meletes_xwroi";
$select_zones = $database->select($tb_zones, $col, $where);
$select_mthx = $database->select($tb_mthx, $col, $where);

$f1 = "";
//ΠΙΝΑΚΑΣ ζωνών
$f1 .= teyxos_zones();

//ΠΙΝΑΚΑΣ ΜΘΧ
$f1 .= teyxos_mthx();

//Δημιουργία ΠΙΝΑΚΑΣ χώρων/εμβαδού/όγκου
$f1 .= teyxos_buildinge();

//ΠΙΝΑΚΑΣ ΔΑΠΕΔΩΝ - ΟΡΟΦΩΝ
$f2 = teyxos_daporo();

//ΠΙΝΑΚΑΣ ΘΕΡΜΟΓΕΦΥΡΩΝ ΚΤΙΡΙΟΥ
$f3 = teyxos_thermo();

//ΕΙΚΟΝΕΣ ΚΛΙΜΑΤΙΚΩΝ ΔΕΔΟΜΕΝΩΝ
$imgzone = teyxos_imgzone();


//F13 -FCHARTS - Κεφ. 8 // functions_calc.php
$f13 = "";
foreach($select_zones as $zone){
	
	$xrisi=$zone["xrisi"];
	$klines=$zone["klines"];
	$zone_ev=teyxos_zone_ev($zone["id"]);
	$zone_e=$zone_ev[0];
	$zone_v=$zone_ev[1];
	$g=180;
	$b=45;
	$t_znx=45;
	
	$f13 .= "Ζώνη: ".$zone["name"]."<br/><br/>";
	
	$tb_zone_sys_solar = "meletes_zone_sys_solar";
	$tb_zone_sys_znxt = "meletes_zone_sys_znxt";
	$where_solar=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$zone["id"]));
	if($database->count($tb_zone_sys_solar, $where_solar)>0){
		$select_solar = $database->select($tb_zone_sys_solar, $col, $where_solar);
		$solar_g=round($select_solar[0]["g"],0);
		$solar_b=round($select_solar[0]["b"],0);
		$solar_e=$select_solar[0]["e"];
		if($select_solar[0]["type"]==0){$fcharts_type="4";}
		if($select_solar[0]["type"]==1){$fcharts_type="1";}
		if($select_solar[0]["type"]==2 OR $select_solar[0]["type"]==4){$fcharts_type="2";}
		if($select_solar[0]["type"]==3){$fcharts_type="3";}
		
		if($database->count($tb_zone_sys_znxt, $where_solar)>0){
			$select_boiler = $database->select($tb_zone_sys_znxt, $col, $where_solar);
			$boiler_capacity=$select_boiler[0]["type"];
			if($boiler_capacity>0){
				$boiler_capacity=$boiler_capacity;
			}else{
				$boiler_capacity="160";
			}
		}
		
		$f13 .= teyxos_fcharts($place, $xrisi, $klines, $zone_e, "$solar_g", "$solar_b", $t_znx, "$solar_e", "$boiler_capacity", $fcharts_type);
	}else{
		$f13 .= "Δεν υπάρχει ηλιακός στη ζώνη είτε γιατί υπολογίστηκαν σε άλλη ζώνη οι καταναλώσεις είτε γιατί δεν υπάρχει απαίτηση κάλυψης αναγκών ΖΝΧ";
	}
	
	$f13 .= "<br/><br/>";
}//για κάθε ζώνη


//F14 - ΦΥΣΙΚΟΣ ΑΕΡΙΣΜΟΣ
$f14 = teyxos_zoneswind();

//F15 - ΦΥΣΙΚΟΣ ΦΩΤΙΣΜΟΣ
$f15 = teyxos_zoneslight();

//Αναλυτικός υπολογισμός U
//Εύρεση των συντελεστών (τα id) από τους υπολογισμούς που χρησιμοποιούνται στη μελέτη
$array_adiafani_uids = teyxos_getadiafaniuids();
$array_diafani_uids = teyxos_getdiafaniuids();

//Εκτύπωση υπολογισμών συντελεστών θερμοπερατότητας αδιαφανών
$analysiu = "";
if (!empty($array_adiafani_uids)) {
foreach($array_adiafani_uids as $id){
	$analysiu .= teyxos_adiafaniu($id);
}//Για κάθε id της array με υπολογισμούς αδιαφανών που χρησιμοποιήθηκαν στη μελέτη
}//Εάν η array με τους υπολογισμούς αδιαφανών δεν είναι κενή - έχουν χρησιμοποιηθεί υπολογισμοί στη μελέτη


//Συντελεστές θερμοπερατότητας διαφανών
if (!empty($array_diafani_uids)) {
foreach($array_diafani_uids as $id){
	$analysiu_win = teyxos_diafaniu($id);
}//Για κάθε id της array με υπολογισμούς ανοιγμάτων που χρησιμοποιήθηκαν στη μελέτη
}//Εάν η array με τους υπολογισμούς ανοιγμάτων δεν είναι κενή - έχουν χρησιμοποιηθεί υπολογισμοί στη μελέτη


//ΤΟΙΧΟΠΟΙΙΑ ΖΩΝΗΣ - ΕΜΒΑΔΑ
$txt_walls = teyxos_wallse();

//ΥΠΟΛΟΓΙΣΜΟΣ ΘΕΡΜΟΓΕΦΥΡΩΝ ΣΤΑ ΔΟΜΙΚΑ ΣΤΟΙΧΕΙΑ
//ΤΟΙΧΟΠΟΙΙΑ ΖΩΝΗΣ
$txt_wallpsi = teyxos_wallspsi();



//ΥΠΟΛΟΓΙΣΜΟΣ ΘΕΡΜΟΓΕΦΥΡΩΝ ΣΤΑ ΔΟΜΙΚΑ ΣΤΟΙΧΕΙΑ
//ΑΝΟΙΓΜΑΤΑ ΖΩΝΗΣ
$tb_walls="meletes_zone_adiafani";
$table_windows="meletes_zone_diafani";
$txt_windowpsi = teyxos_windowspsi();

$txt_wallpsi .= $txt_windowpsi;


//Συντελεστές ΠΡΟΣ - ΚΑΤΑΚΟΡΥΦΟ - α/ε
$txt_gbae = teyxos_wallsbg();


//ΠΙΝΑΚΕΣ - ΣΚΙΑΣΕΙΣ 
$txt_fhor = teyxos_wallsf(0);
$txt_fov = teyxos_wallsf(1);
$txt_ffin = teyxos_wallsf(2);

$kef42pin43 = teyxos_adiafani_u(1);
$kef42pin44 = teyxos_adiafani_u(2);
$kef42pin44 .= teyxos_adiafani_u(3);
$kef43pin45 = teyxos_diafani_u();

$win_standar = teyxos_win_standar();

$kef43_winumax=$win_standar[0];
$kef43_winplaisio=$win_standar[1];
$kef43_winuf=$win_standar[2];
$kef43_winmmp=$win_standar[3];
$kef43_winyal=$win_standar[4];
$kef43_winug=$win_standar[5];

$kef44pin46 = teyxos_adiafani_checkum();

//ΚΕΦΑΛΑΙΟ 5
//Κείμενα θέρμσνης
$kef5_therm=teyxos_kef5_therm();
$kef5thermp_type = $kef5_therm[0];
$kef5thermp_pigi = $kef5_therm[1];
$kef5thermp_n = $kef5_therm[2];
$kef5thermp_cop = $kef5_therm[3];
$kef5thermp_kw = $kef5_therm[4];
$kef5thermp_kcal = $kef5_therm[5];
//Κείμενα ψυξης
$kef5_cold=teyxos_kef5_cold();
$kef5coldp_type = $kef5_cold[0];
$kef5coldp_pigi = $kef5_cold[1];
$kef5coldp_n = $kef5_cold[2];
$kef5coldp_cop = $kef5_cold[3];
$kef5coldp_kw = $kef5_cold[4];
$kef5coldp_btu = $kef5_cold[5];
//Κείμενα ΖΝΧ
$kef5_znx=teyxos_kef5_znx();
$kef5znxp_type = $kef5_znx[0];
$kef5znxp_pigi = $kef5_znx[1];
$kef5znxp_znxm3m2 = $kef5_znx[2];
$kef5znxp_vd = $kef5_znx[3];
$kef5znxp_vstore = $kef5_znx[4];
$kef5znxp_qd = $kef5_znx[5];
$kef5znxp_boiler = $kef5_znx[6];
$kef5znxp_pnkw = $kef5_znx[7];
$kef5znxp_pnkw13 = $kef5_znx[8];
$kef5znxp_pnkcal = $kef5_znx[9];
//Κείμενα Ηλιακού
$kef5_solar=teyxos_kef5_solar();
$kef5solar_b = $kef5_solar[0];
$kef5solar_g = $kef5_solar[1];
$kef5solar_e = $kef5_solar[2];
$kef5solar_syna = $kef5_solar[3];

//ΚΕΦΑΛΑΙΟ 6
//Πίνακας ζωνών
$kef6xrisi = "Χρήση κτιρίου: ".teyxos_bld_xrisi();
$kef6zones = teyxos_zones();
$kef6ktirio = teyxos_kef6ktirio();
$kef6air = teyxos_kef6air();
$kef6conditions = teyxos_kef6conditions();
$kef6zonechapter = teyxos_kef6zonechapter();


//Εικόνες τοίχων
$txt_wallimg = "";
foreach($select_zones as $zone){
	$where_zone=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$zone["id"]));
	$walls = $database->select($tb_walls, $col, $where_zone );
	foreach($walls as $wall){
		$draw_wall = teyxos_img_wall($wall["id"]);
		
		$txt_wallimg .= "<p style=\"text-align: center;\">";
		$txt_wallimg .= $draw_wall;
		$txt_wallimg .= "</p><br/>";
		
	}	
}//για κάθε ζώνη


//Array αντιμετάθεσης
$z = array();
$z1 = array();


$z[0]="{NEWPAGE}";
$z[1]="{PROJECT}";
$z[2]="{PLACE}";
$z[3]="{OWNER}";
$z[4]="{ENGS}";
$z[5]="{SXEDIO}";
$z[6]="{PLACEZ}";
$z[7]="{XRISIKTIRIO}";
$z[8]="{ODOS}";
$z[9]="{APOSTASEISOIK}";
$z[10]="{KEF8ZONES}";
$z[11]="{KEF8THERMO}";
$z[12]="{KEF8DAPORO}";
$z[13]="{IMGZONE}";
$z[14]="{KEF8UADIAFANI}";
$z[15]="{KEF8UDIAFANI}";
$z[16]="{KEF8TOIXOI}";
$z[17]="{KEF8TOIXOIE}";
$z[18]="{KEF8TOIXOIIMG}";
$z[19]="{KEF8TOIXOIPSI}";
$z[20]="{KEF8TOIXOIFHOR}";
$z[21]="{KEF8TOIXOIFOV}";
$z[22]="{KEF8TOIXOIFFIN}";
$z[23]="{KEF8FCHARTS}";
$z[24]="{KEF8AIR}";
$z[25]="{KEF8LIGHT}";
$z[26]="{KEF42PIN43}";
$z[27]="{KEF42PIN44}";
$z[28]="{KEF43PIN45}";

$z[29]="{KEF43_WINUMAX}";
$z[30]="{KEF43_WINPLAISIO}";
$z[31]="{KEF43_WINUF}";
$z[32]="{KEF43_WINMMP}";
$z[33]="{KEF43_WINYAL}";
$z[34]="{KEF43_WINUG}";

$z[35]="{KEF44PIN46}";

$z[36]="{THERMPTYPE1}";
$z[37]="{THERMPPIGI1}";
$z[38]="{THERMPN1}";
$z[39]="{THERMPCOP1}";
$z[40]="{THER2}";
$z[41]="{THER1}";

$z[42]="{COLDPTYPE1}";
$z[43]="{COLDPPIGI1}";
$z[44]="{COLDPN1}";
$z[45]="{COLDPEER1}";
$z[46]="{COLD2}";
$z[47]="{COLD1}";

$z[48]="{ZNXPTYPE1}";
$z[49]="{ZNXPPIGI1}";
$z[50]="{SYNTZNX1}";
$z[51]="{ZNX}";
$z[52]="{ZNX1}";
$z[53]="{ZNX2}";
$z[54]="{ZNX3}";
$z[55]="{ZNX4}";
$z[56]="{ZNX5}";

$z[57]="{SOLARB}";
$z[58]="{SOLARG}";
$z[59]="{SOLARE}";
$z[60]="{SOLARSYNA}";
$z[61]="{VELTKLISI1}";


$z[62]="{KEF6XRISI}";
$z[63]="{KEF6ZONES}";
$z[64]="{KEF6KTIRIO}";
$z[65]="{KEF6AIR}";
$z[66]="{KEF6CONDITIONS}";
$z[67]="{KEF6ZONECHAPTER}";
$z[68]="{ZWNI}";
$z[69]="{XRISIKTIRIO1}";
$z[70]="<table>";


$z1[0]="<p style=\"page-break-before:always;\"></p>";
$z1[1]=$meleti_perigrafi;
$z1[2]=$meleti_address;
$z1[3]=$meleti_idioktitis;
$z1[4]=$user_fullname;
$z1[5]=$sxedio;
$z1[6]=$placez;
$z1[7]=$bld_xrisi;
$z1[8]=$odos;
$z1[9]=$apostaseisoik;
$z1[10]=$f1;
$z1[11]=$f3;
$z1[12]=$f2;
$z1[13]=$imgzone;
$z1[14]=$analysiu;
$z1[15]=$analysiu_win;
$z1[16]=$txt_gbae;
$z1[17]=$txt_walls;
$z1[18]=$txt_wallimg;
$z1[19]=$txt_wallpsi;
$z1[20]=$txt_fhor;
$z1[21]=$txt_fov;
$z1[22]=$txt_ffin;
$z1[23]=$f13;
$z1[24]=$f14;
$z1[25]=$f15;
$z1[26]=$kef42pin43;
$z1[27]=$kef42pin44;
$z1[28]=$kef43pin45;

$z1[29]=$kef43_winumax;
$z1[30]=$kef43_winplaisio;
$z1[31]=$kef43_winuf;
$z1[32]=$kef43_winmmp;
$z1[33]=$kef43_winyal;
$z1[34]=$kef43_winug;

$z1[35]=$kef44pin46;

$z1[36]=$kef5thermp_type;
$z1[37]=$kef5thermp_pigi;
$z1[38]=$kef5thermp_n;
$z1[39]=$kef5thermp_cop;
$z1[40]=$kef5thermp_kw;
$z1[41]=$kef5thermp_kcal;

$z1[42]=$kef5coldp_type;
$z1[43]=$kef5coldp_pigi;
$z1[44]=$kef5coldp_n;
$z1[45]=$kef5coldp_cop;
$z1[46]=$kef5coldp_kw;
$z1[47]=$kef5coldp_btu;

$z1[48]=$kef5znxp_type;
$z1[49]=$kef5znxp_pigi;
$z1[50]=$kef5znxp_znxm3m2;
$z1[51]=$kef5znxp_vd;
$z1[52]=$kef5znxp_vstore;
$z1[53]=$kef5znxp_boiler;
$z1[54]=$kef5znxp_pnkw;
$z1[55]=$kef5znxp_pnkw13;
$z1[56]=$kef5znxp_pnkcal;

$z1[57]=$kef5solar_b;
$z1[58]=$kef5solar_g;
$z1[59]=$kef5solar_e;
$z1[60]=$kef5solar_syna;
$z1[61]=round($place_lat,0);

$z1[62]=$kef6xrisi;
$z1[63]=$kef6zones;
$z1[64]=$kef6ktirio;
$z1[65]=$kef6air;
$z1[66]=$kef6conditions;
$z1[67]=$kef6zonechapter;
$z1[68]=$climatezone;
$z1[69]=$kef6xrisi;
$z1[70]="<table border=\"1\" cellpadding=\"5\" cellspacing=\"0\" style=\"width:100%;\" >";


	for($i=1;$i<=8;$i++){
		
		$n=" rgb(255, 160, 122);";
		$n1="#ffa07a;";
		$teyxos["kef".$i] = str_replace($n, $n1, $teyxos["kef".$i]);
		
		$n="#ffa07a; ";
		$n1="#ffa07a;";
		$teyxos["kef".$i] = str_replace($n, $n1, $teyxos["kef".$i]);
		
		$m = array();
		preg_match_all("/\{[A-Z,0-9]*\}/",$teyxos["kef".$i],$m);
		for ($k=1;$k<=count($m[0]);$k++){
		$teyxos["kef".$i] = preg_replace("/<span style=\"background-color:\#ffa07a;\">\{[A-Z,0-9]*\}<\/span>/",$m[0][$k-1],$teyxos["kef".$i],1);
		}
		
	
		$teyxos["kef".$i] = str_replace($z, $z1, $teyxos["kef".$i]);
	}
	
return $teyxos;
}

?>