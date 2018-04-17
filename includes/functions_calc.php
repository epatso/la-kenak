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

if (isset($_GET['adiafani_save'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$id=$_GET['id'];
	$name=$_GET['name'];
	$zwni=$_GET['zwni'];
	$type=$_GET['type'];
	$rira=$_GET['rira'];
	$ru=$_GET['ru'];
	$rd1=$_GET['rd1'];
	$rd2=$_GET['rd2'];
	$rd3=$_GET['rd3'];
	$paxos=$_GET['paxos'];
	$category=$_GET['category'];
	$subcategory=$_GET['subcategory'];
	$strwsi=$_GET['strwsi'];
	$u=$_GET['u'];
	
	$select_ylika = adiafani_save($id,$name,$zwni,$type,$rira,$ru,$rd1,$rd2,$rd3,$paxos,$category,$subcategory,$strwsi,$u);
	echo $select_ylika;
	exit;
}

if (isset($_GET['adiafani_getselectsid'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$category=$_GET['category'];
	$subcategory=$_GET['subcategory'];
	$material_id=$_GET['material_id'];
	$select_ylika = adiafani_getselectsid($category,$subcategory,$material_id);
	echo $select_ylika;
	exit;
}

if (isset($_GET['adiafani_load'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$id=$_GET['id'];
	$select_ylika = adiafani_load($id);
	echo $select_ylika;
	exit;
}

if (isset($_GET['adiafani_find'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$id=$_GET['id'];
	$select_ylika = adiafani_find($id);
	echo $select_ylika;
	exit;
}

if (isset($_GET['adiafani_makeselect'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$select_ylika = adiafani_makeselect();
	echo $select_ylika;
	exit;
}

if (isset($_GET['adiafani_find_subcategory'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$category=$_GET['category'];
	$select_ylika = adiafani_find_subcategory($category);
	echo $select_ylika;
	exit;
}

if (isset($_GET['adiafani_find_ylika'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$category=$_GET['category'];
	$subcategory=$_GET['subcategory'];
	$select_ylika = adiafani_find_ylika($category,$subcategory);
	echo $select_ylika;
	exit;
}

if (isset($_GET['adiafani_find_ylikacl'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$category=$_GET['category'];
	$material_id=$_GET['material_id'];
	$select_ylika = adiafani_find_ylikacl($category,$material_id);
	echo $select_ylika;
	exit;
}

if (isset($_GET['adiafani_find_rira'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$rira_type=$_GET['rira_type'];
	$select_ylika = adiafani_find_rira($rira_type);
	echo $select_ylika;
	exit;
}

if (isset($_GET['adiafani_find_umax'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$rira_type=$_GET['rira_type'];
	$zwni=$_GET['zwni'];
	$type=$_GET['type'];
	$select_ylika = adiafani_find_umax($type,$zwni,$rira_type);
	echo $select_ylika;
	exit;
}

if (isset($_GET['adiafani_find_rd'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$rd_d=$_GET['rd_d'];
	$rd_flow=$_GET['rd_flow'];
	$rd_e=$_GET['rd_e'];
	$select_ylika = adiafani_find_rd($rd_d,$rd_flow,$rd_e);
	echo $select_ylika;
	exit;
}


if (isset($_GET['diafani_save'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$id=$_GET['id'];
	$name=$_GET['name'];
	$epafi=$_GET['epafi'];
	$zwni=$_GET['zwni'];
	$type=$_GET['type'];
	$uf=$_GET['plaisio_uf'];
	$mpp=$_GET['plaisio_mpp'];
	$yekp=$_GET['yalo_ekp'];
	$ydias=$_GET['yalo_dias'];
	$yaer=$_GET['yalo_aer'];
	$cg_best=$_GET['cg_best'];
	$roll_type=$_GET['roll_type'];
	$roll_h=$_GET['roll_h'];
	$eks_type=$_GET['eks_type'];
	$eks_ekp=$_GET['eks_ekp'];
	$a=$_GET['a'];
	$aw=$_GET['aw'];
	$ah=$_GET['ah'];
	$af=$_GET['af'];
	$yw=$_GET['yw'];
	$yh=$_GET['yh'];
	$gw=$_GET['gw'];
	$uw=$_GET['uw'];
	$uwrb=$_GET['uwrb'];
	$uwr=$_GET['uwr'];
	
	$select_ylika = diafani_save($id,$name,$epafi,$zwni,$type,$uf,$mpp,$yekp,$ydias,$yaer,$cg_best,$roll_type,$roll_h,$eks_type,$eks_ekp,$a,$aw,$ah,$af,$yw,$yh,$gw,$uw,$uwrb,$uwr);
	echo $select_ylika;
	exit;
}

if (isset($_GET['diafani_getselectsid'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$pl_type=$_GET['pl_type'];
	$yal_ekp=$_GET['yal_ekp'];
	$yal_dims=$_GET['yal_dims'];
	$yal_air=$_GET['yal_air'];
	$cg_best=$_GET['cg_best'];
	$eks_type=$_GET['eks_type'];
	$eks_ekp=$_GET['eks_ekp'];
	$select_ylika = diafani_getselectsid($pl_type,$yal_ekp,$yal_dims,$yal_air,$cg_best,$eks_type,$eks_ekp);
	echo $select_ylika;
	exit;
}

if (isset($_GET['diafani_load'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$id=$_GET['id'];
	$select_ylika = diafani_load($id);
	echo $select_ylika;
	exit;
}

if (isset($_GET['diafani_find'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$id=$_GET['id'];
	$select_ylika = diafani_find($id);
	echo $select_ylika;
	exit;
}

if (isset($_GET['diafani_makeselect'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$select_ylika = diafani_makeselect();
	echo $select_ylika;
	exit;
}

if (isset($_GET['diafani_get_umax'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$zwni=$_GET['zwni'];
	$type=$_GET['type'];
	$epafi=$_GET['epafi'];
	$select_ylika = diafani_get_umax($zwni,$type,$epafi);
	echo $select_ylika;
	exit;
}

if (isset($_GET['diafani_get_uf'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$uf_type=$_GET['uf_type'];
	$select_ylika = diafani_get_uf($uf_type);
	echo $select_ylika;
	exit;
}

if (isset($_GET['diafani_get_ug'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$type_ekp=$_GET['type_ekp'];
	$diastasi=$_GET['diastasi'];
	$air=$_GET['air'];
	$select_ylika = diafani_get_ug($type_ekp,$diastasi,$air);
	echo $select_ylika;
	exit;
}

if (isset($_GET['diafani_get_cg'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$plaisio=$_GET['plaisio'];
	$type_apostati=$_GET['type_apostati'];
	$ekp=$_GET['ekp'];
	$select_ylika = diafani_get_cg($plaisio,$type_apostati,$ekp);
	echo $select_ylika;
	exit;
}

if (isset($_GET['diafani_get_rrb'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$type=$_GET['type'];
	$ekp=$_GET['ekp'];
	$select_ylika = diafani_get_rrb($type,$ekp);
	echo $select_ylika;
	exit;
}

if (isset($_GET['ufb'])){
	require("functions_math.php");
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$dapedo_ufb=$_GET['ufb'];
	$vathos=$_GET['z'];
	$xaraktiristiki=$_GET['b'];
	$result = isodynamos_dapedoy($dapedo_ufb, $vathos, $xaraktiristiki);
	echo $result;
	exit;
}

if (isset($_GET['utb'])){
	require("functions_math.php");
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$utb=$_GET['utb'];
	$z1=$_GET['z1'];
	$z2=$_GET['z2'];
	$result = isodynamos_katakoryfoy($utb, $z1, $z2);
	echo $result;
	exit;
}

if (isset($_GET['id_xrisi'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$id_xrisi=$_GET['id_xrisi'];
	$hotel=$_GET['hotel'];
	$hospital=$_GET['hospital'];
	$result = get_synthikes($id_xrisi,$hotel,$hospital);
	echo $result;
	exit;
}

if (isset($_GET['has_znx'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$id_xrisi=$_GET['id_xrisi'];
	$result = get_hasznx($id_xrisi);
	echo $result;
	exit;
}

if (isset($_GET['thermp_ng'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require("functions_math.php");
	$pgen=$_GET['pgen'];
	$pn=$_GET['pn'];
	$boilertype=$_GET['boilertype'];
	$instype=$_GET['instype'];
	$nsath=$_GET['nsath'];
	$nsthd=$_GET['nsthd'];
	$nmg2=$_GET['nmg2'];
	$result = get_therm_ng($pgen, $pn, $boilertype, $instype,$nsath,$nsthd,$nmg2);
	echo $result;
	exit;
}

if (isset($_GET['dianomi_p'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$dianomi_p=$_GET['dianomi_p'];
	$dianomi_t=$_GET['dianomi_t'];
	$dianomi_dieleysi=$_GET['dianomi_dieleysi'];
	$dianomi_monwsi=$_GET['dianomi_monwsi'];
	$result = get_therm_dianomi_n($dianomi_p, $dianomi_t, $dianomi_dieleysi, $dianomi_monwsi);
	echo $result;
	exit;
}

if (isset($_GET['dianomi_cold_p'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$dianomi_cold_p=$_GET['dianomi_cold_p'];
	$dianomi_cold_dieleysi=$_GET['dianomi_cold_dieleysi'];
	$dianomi_cold_monwsi=$_GET['dianomi_cold_monwsi'];
	$result = get_cold_dianomi_n($dianomi_cold_p, $dianomi_cold_dieleysi, $dianomi_cold_monwsi);
	echo $result;
	exit;
}

if (isset($_GET['dianomi_znx_lt'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$p=$_GET['dianomi_znx_lt'];
	$anakykloforia=$_GET['dianomi_znx_ana'];
	$monwsi=$_GET['dianomi_znx_monwsi'];
	$result = get_znx_dianomi_n($p, $anakykloforia, $monwsi);
	echo $result;
	exit;
}

if (isset($_GET['solar_xrisi'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require("functions_math.php");
	$xrisi=$_GET['solar_xrisi'];
	$type=$_GET['solar_type'];
	$deg=$_GET['solar_deg'];
	$place=$_GET['solar_place'];
	$result = get_solar_syna($xrisi, $type, $place, $deg);
	echo $result;
	exit;
}

if (isset($_GET['get_fcharts_table'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require("functions_math.php");
	
	$f_ac=$_GET['f_ac'];
	$f_climate=$_GET['f_climate'];
	$f_g=$_GET['f_g'];
	$f_b=$_GET['f_b'];
	$f_xrisi=$_GET['f_xrisi'];
	$f_zone_e=$_GET['f_zone_e'];
	$f_klines=$_GET['f_klines'];
	$f_t_znx=$_GET['f_t_znx'];
	$f_calctype=$_GET['f_calctype'];//χωρίς χρήση ακόμα
	$f_solartype=$_GET['f_solartype'];
	$f_enallaktis=$_GET['f_enallaktis'];
	$f_m=$_GET['f_m'];
	
	$result = get_fcharts_table($f_climate, $f_xrisi, $f_klines, $f_zone_e, $f_g, $f_b, $f_t_znx, $f_ac, $f_m, $f_solartype, $f_enallaktis);
	echo $result;
	exit;
}

require("include_check.php");


//ΔΙΑΦΑΝΗ ΥΠΟΛΟΓΙΣΜΟΣ
//Αποθήκευση διαφανών
function diafani_save($id,$name,$epafi,$zwni,$type,$uf,$mpp,$yekp,$ydias,$yaer,$cg_best,$roll_type,$roll_h,$eks_type,$eks_ekp,$a,$aw,$ah,$af,$yw,$yh,$gw,$uw,$uwrb,$uwr){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$table = "user_diafani";
	$columns = "*";
	$where = array("AND"=>array("id"=>$id,"user_id"=>$_SESSION['user_id']));
	
	$insert = array(
		"user_id"=>$_SESSION['user_id'],
		"name"=>$name,
		"epafi"=>$epafi,
		"zwni"=>$zwni,
		"type"=>$type,
		"plaisio_uf"=>$uf,
		"plaisio_mpp"=>$mpp,
		"yalo_ekp"=>$yekp,
		"yalo_dias"=>$ydias,
		"yalo_aer"=>$yaer,
		"cg_best"=>$cg_best,
		"roll_type"=>$roll_type,
		"roll_h"=>$roll_h,
		"eks_type"=>$eks_type,
		"eks_ekp"=>$eks_ekp,
		"a"=>$a,
		"aw"=>$aw,
		"ah"=>$ah,
		"af"=>$af,
		"yw"=>$yw,
		"yh"=>$yh,
		"gw"=>$gw,
		"uw"=>$uw,
		"uwrb"=>$uwrb,
		"uwr"=>$uwr,
	);
	
	//Ελέγχω αν υπάρχει γραμμή με το ίδιο ID. Εάν υπάρχει γίνεται update. 
	//Εάν υπάρχει σίγουρα ανήκει στο χρήστη γιατί "user_id"=>$_SESSION['user_id']
	$count = $database->count($table,$where);
	if($count==0){
		$insert = $database->insert($table,$insert);
		$return = "προστέθηκε";
	}else{
		$update = $database->update($table,$insert,$where);
		$return = "ενημερώθηκε";
	}
	return $return;
}
//Εύρεση όλων των select
function diafani_getselectsid($pl_type,$yal_ekp,$yal_dims,$yal_air,$cg_best,$eks_type,$eks_ekp){
	$cg_best=$cg_best+1;
	$val1=diafani_get_uf((int)$pl_type);
	$val2=diafani_get_ug((int)$yal_ekp,(int)$yal_dims,(int)$yal_air);
	$val3=diafani_get_cg((int)$pl_type,(int)$cg_best,(int)$yal_ekp);
	$val4=diafani_get_rrb((int)$eks_type,(int)$eks_ekp);
	$return=array(
		0=>$val1,
		1=>$val2,
		2=>$val3,
		3=>$val4
	);
	
	return json_encode($return);
}
//Φόρτωση διαφανών
function diafani_load($id){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$table = "user_diafani";
	$columns = "*";
	$where = array("AND"=>array("id"=>$id,"user_id"=>$_SESSION['user_id']));
	
	$select = $database->select($table,$columns,$where);
	$count = $database->count($table,$where);
	
	if($count==1){
		$return = json_encode($select[0]);
	}else{
		$return = "";
	}
	return $return;
}
//Φόρτωση διαφανών
function diafani_find($id){
	confirm_logged_in();
	
		$database = new medoo(DB_NAME);
		$table = "user_diafani";
		$columns = "*";
		$where = array("AND"=>array("id"=>$id,"user_id"=>$_SESSION['user_id']));
		$count = $database->count($table,$where);
		
		if($count==0){
			$return = "Προσθήκη";
		}else{
			$return = "Επεξεργασία";
		}
	return $return;
}
//Δημιουργία του select διαφανών για το χρήστη
function diafani_makeselect(){
	confirm_logged_in();
	
	$database = new medoo(DB_NAME);
	$table = "user_diafani";
	$columns = "*";
	$where = array("user_id"=>$_SESSION['user_id']);
	
	$select = $database->select($table,$columns,$where);
	$count = $database->count($table);
	$return = "";
	
	if($count==0){
		$return .= "";
	}else{
		foreach($select as $data){
		$return .= "<option value=\"".$data["id"]."\">".$data["name"]."</option>";
		}
	}
	return $return;
}
//Εύρεση Umax
function diafani_get_umax($zwni,$type,$epafi){
	$database = new medoo(DB_NAME);
	//Επιλογή πίνακα από τύπο κτιρίου
	if($type==1){//Νέο κτίριο
		$tb_umax = "vivliothiki_umax_new";
	}
	if($type==2){//Ριζική ανακαίνιση κτίριο
		$tb_umax = "vivliothiki_umax_old";
	}
	$zone_array=array("a","b","g","d");
	$col_umax=$zone_array[$zwni];
	
	$where_array=array(
		"",
		array("AND"=>array("epafi"=>1,"type"=>4)),
		array("AND"=>array("epafi"=>1,"type"=>5)),
		array("AND"=>array("epafi"=>2,"type"=>4)),
		array("AND"=>array("epafi"=>2,"type"=>5))
	);
	$where = $where_array[$epafi];
	
	$select = $database->select($tb_umax,$col_umax,$where);
	
	return $select[0];
}
//Εύρεση Uf
function diafani_get_uf($id){
	$database = new medoo(DB_NAME);
	$table = "vivliothiki_uf";
	$columns = "uf";
	$where = array("id"=>$id);
	
	$select = $database->select($table,$columns,$where);
	
	return $select[0];
}
//Εύρεση Ug
function diafani_get_ug($type_ekp,$diastasi,$air){
	$database = new medoo(DB_NAME);
	$table = "vivliothiki_ug";
	$column_array=array("","air","ar","kr");
	$column=$column_array[$air];
	$where = array("AND"=>array("type_ekmp"=>$type_ekp,"diastasi"=>$diastasi));
	
	$select = $database->select($table,$column,$where);
	
	return $select[0];
}
//Εύρεση cg
function diafani_get_cg($plaisio,$type_apostati,$ekp){
	$database = new medoo(DB_NAME);
	$table = "vivliothiki_ug_psi";
	
	if($ekp==1){$column="nolowe";}//0.89
	if($ekp==2 OR $ekp==3){$column="lowe";}//0.05 ή 0.10
	
	if($plaisio==1){$type=1;}//με θερμο
	if($plaisio==2){$type=2;}//χωρίς θερμο
	if($plaisio>=3 AND $plaisio<=6){$type=3;}//συνθετικό
	if($plaisio>=7 AND $plaisio<=10){$type=4;}//ξύλινο
	
	$where = array("AND"=>array("type_apostati"=>$type_apostati,"type"=>$type));
	
	$select = $database->select($table,$column,$where);
	
	return $select[0];
}
//Εύρεση rrb
function diafani_get_rrb($type,$ekp){
	$database = new medoo(DB_NAME);
	$table = "vivliothiki_uw_rrb";
	
	if($ekp==1){$column="low";}
	if($ekp==2){$column="middle";}
	if($ekp==3){$column="high";}
	
	$where = array("type"=>$type);
	
	$select = $database->select($table,$column,$where);
	
	return $select[0];
}

//ΑΔΙΑΦΑΝΗ ΥΠΟΛΟΓΙΣΜΟΣ
//Αποθήκευση αδιαφανών
function adiafani_save($id,$name,$zwni,$type,$rira,$ru,$rd1,$rd2,$rd3,$paxos,$category,$subcategory,$strwsi,$u){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$table = "user_adiafani";
	$columns = "*";
	$where = array("AND"=>array("id"=>$id,"user_id"=>$_SESSION['user_id']));
	
	$insert = array(
		"user_id"=>$_SESSION['user_id'],
		"name"=>$name,
		"zwni"=>$zwni,
		"type"=>$type,
		"rira"=>$rira,
		"ru"=>$ru,
		"rd1"=>$rd1,
		"rd2"=>$rd2,
		"rd3"=>$rd3,
		"paxos"=>$paxos,
		"category"=>$category,
		"subcategory"=>$subcategory,
		"strwsi"=>$strwsi,
		"u"=>$u
	);
	
	//Ελέγχω αν υπάρχει γραμμή με το ίδιο ID. Εάν υπάρχει γίνεται update. 
	//Εάν υπάρχει σίγουρα ανήκει στο χρήστη γιατί "user_id"=>$_SESSION['user_id']
	$count = $database->count($table,$where);
	if($count==0){
		$insert = $database->insert($table,$insert);
		$return = "προστέθηκε";
	}else{
		$update = $database->update($table,$insert,$where);
		$return = "ενημερώθηκε";
	}
	return $return;
}

//Φόρτωση αδιαφανών
function adiafani_load($id){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$table = "user_adiafani";
	$columns = "*";
	$where = array("AND"=>array("id"=>$id,"user_id"=>$_SESSION['user_id']));
	
	$select = $database->select($table,$columns,$where);
	$count = $database->count($table,$where);
	
	if($count==1){
		$return = json_encode($select[0]);
	}else{
		$return = "";
	}
	return $return;
}

//Εύρεση όλων των select και του λ από το υλικό
function adiafani_getselectsid($category,$subcategory,$material_id){
	
	$val1=adiafani_find_subcategory((int)$category);
	$val2=adiafani_find_ylika((int)$category,(int)$subcategory);
	$val3=adiafani_find_ylikacl((int)$category,(int)$material_id);
	$return=array(
		0=>$val1,
		1=>$val2,
		2=>$val3
	);
	
	return json_encode($return);
}

//Φόρτωση αδιαφανών
function adiafani_find($id){
	confirm_logged_in();
	
		$database = new medoo(DB_NAME);
		$table = "user_adiafani";
		$columns = "*";
		$where = array("AND"=>array("id"=>$id,"user_id"=>$_SESSION['user_id']));
		$count = $database->count($table,$where);
		
		if($count==0){
			$return = "Προσθήκη";
		}else{
			$return = "Επεξεργασία";
		}
	return $return;
}

//Δημιουργία του select αδιαφανών για το χρήστη
function adiafani_makeselect(){
	confirm_logged_in();
	
	$database = new medoo(DB_NAME);
	$table = "user_adiafani";
	$columns = "*";
	$where = array("user_id"=>$_SESSION['user_id']);
	
	$select = $database->select($table,$columns,$where);
	$count = $database->count($table);
	$return = "";
	
	if($count==0){
		$return .= "";
	}else{
		foreach($select as $data){
		$return .= "<option value=\"".$data["id"]."\">".$data["name"]."</option>";
		}
	}
	return $return;
}

//Δημιουργία select options της υποκατηγορίας όταν έχει δηλωθεί η κατηγορία
function adiafani_find_subcategory($category){
	
	$return = "<option value=0></option>";
	
	if($category<10){//Εάν είναι η νο10 δεν έχει υποκατηγορία (υλικά χρήστη)
		$database = new medoo(DB_NAME);
		$tb = "vivliothiki_domika_subcategory";
		$col = "*";
		$where = array("category" => $category);
		$data_select = $database->select($tb,$col,$where);
		foreach($data_select as $data){
			$return .= "<option value=\"".$data["subcategory"]."\">".$data["name"]."</option>";
		}	
	}else{
		$return .= "<option value=\"0\" selected>Χωρίς κατηγορία</option>";
	}
	
	return $return;
}

//Δημιουργία select options για υλικά με βάση την κατηγορία και υποκατηγορία
function adiafani_find_ylika($category,$subcategory){
	$database = new medoo(DB_NAME);
	$col = "*";
	$return = "<option value=0></option>";
	
	if($category<10){
		$db_table = "vivliothiki_domika";
		$db_parameters = array("AND" => array("category" => $category,"subcategory" => $subcategory));
		$data_select = $database->select($db_table,$col,$db_parameters);
	}else{
		$db_table = "user_domika";
		$db_parameters = array("user_id" => $_SESSION['user_id']);
		$data_select = $database->select($db_table,$col,$db_parameters);
	}
	
	foreach($data_select as $data){
	$return .= "<option value=\"".$data["id"]."\">".$data["material"]."</option>";
	}
	return $return;
}

//Εύρεση του λ από το id της στρώσης υλικών
function adiafani_find_ylikacl($category,$material_id){
	$database = new medoo(DB_NAME);
	$col = "*";
	
	if($category<10){
		$tb = "vivliothiki_domika";
		$where = array("AND"=>array("category" => $category,"id" => $material_id));
		$data_select = $database->select($tb,$col,$where);
	}else{
		$tb = "user_domika";
		$where = array("id" => $material_id);
		$data_select = $database->select($tb,$col,$where);
	}
		
	$return = $data_select[0]["l"];
	return $return;
}

//Εύρεση των Ri και Ra από το ID
function adiafani_find_rira($rira_type){
	$database = new medoo(DB_NAME);
	$tb = "vivliothiki_u_rira";
	$col = "*";
	$where = array("id" => $rira_type);
	$data_select = $database->select($tb,$col,$where);

	$return = array(
		"ri"=>$data_select[0]["ri"],
		"ra"=>$data_select[0]["ra"]
	);
	return json_encode($return);
}

//Εύρεση του Umax από τον τύπο Ri και Ra, τον τύπο κτιρίου και τη ζώνη
function adiafani_find_umax($type,$zwni,$rira_type){
	$database = new medoo(DB_NAME);
	$col = "*";
	
	//Επιλογή τύπου Ri και Ra για επαφή (σε αέρα, ΜΘΧ ή έδαφος) και τύπο στοιχείου (τοίχος, οροφή, δάπεδο)
	$tb_rira = "vivliothiki_u_rira";
	$where_rira = array("id" => $rira_type);
	$select_rira = $database->select($tb_rira,$col,$where_rira);
	
	$epafi=$select_rira[0]["epafi"];//Επαφή
	$type_dom=$select_rira[0]["type"];//Τύπος στοιχείου
	
	//Επιλογή πίνακα από τύπο κτιρίου
	if($type==1){//Νέο κτίριο
		$tb_umax = "vivliothiki_umax_new";
	}
	if($type==2){//Ριζική ανακαίνιση κτίριο
		$tb_umax = "vivliothiki_umax_old";
	}
	
	$zone_array=array("a","b","g","d");
	$col_umax=$zone_array[$zwni];
	$where_umax=array("AND"=>array("type"=>$type_dom,"epafi"=>$epafi));
	
	$select_umax  = $database->select($tb_umax,$col_umax,$where_umax);
	$return =$select_umax[0];
	
	return $return;
}

//Εύρεση του Rδ από το πάχος, ροή και ε ανακλαστικής
function adiafani_find_rd($rd_d,$rd_flow,$rd_e){
	$database = new medoo(DB_NAME);
	
	if($rd_flow==1){$col = "rd_horizontal";}
	if($rd_flow==2){$col = "rd_verticalup";}
	if($rd_flow==3){$col = "rd_verticaldown";}
	
	$tb = "vivliothiki_u_rd";
	$where = array("AND"=>array("type" => $rd_e,"d"=>$rd_d));
	$select = $database->select($tb,$col,$where);
	
	$return = $select[0];
	return $return;
}

//Δημιουργία select options για κατηγορίες αδιαφανών - ΔΕΝ ΧΡΗΣΙΜΟΠΟΙΕΙΤΑΙ (create_select_optionsid από βάση mysql)
function select_adiafani_categories(){
	$return = "
	<option value=\"\" selected=\"selected\"> </option>
	<option value=\"1\">1. Ανόργανα δομικά υλικά</option>
	<option value=\"2\">2. Ξύλα</option>
	<option value=\"3\">3. Μέταλλα/Γυαλί</option>
	<option value=\"4\">4. Υποστρώματα/Επιστρώσεις</option>
	<option value=\"5\">5. Συνθετικά/ρητίνες/σιλικόνες</option>
	<option value=\"6\">6. Βερνίκια και βαφές</option>
	<option value=\"7\">7. Θερμομονωτικά</option>
	<option value=\"8\">8. Αέρια</option>
	<option value=\"9\">9. Νερό</option>
	<option value=\"10\">10. Υλικά χρήστη</option>";
	return $return;
}

//ΕΠΙΛΟΓΗ ΣΤΗΛΩΝ - ΓΡΑΜΜΩΝ
// Γραμμές πριν και μετά το A/V.
function get_lines_av($av){
	if ($av <= 0.2) {
	$grammi1 = 0.2;
	}
	if ($av == 0.3) {
	$grammi1 = 0.3;
	}
	if ($av == 0.4) {
	$grammi1 = 0.4;
	}
	if ($av == 0.5) {
	$grammi1 = 0.5;
	}
	if ($av == 0.6) {
	$grammi1 = 0.6;
	}
	if ($av == 0.7) {
	$grammi1 = 0.7;
	}
	if ($av == 0.8) {
	$grammi1 = 0.8;
	}
	if ($av >= 0.9) {
	$grammi1 = 0.9;
	}
	if ($av >= 1) {
	$grammi1 = 1.0;
	}
	if ($av > 0.2 && $av < 0.3) {
	$grammi1 = 0.2;
	$grammi2 = 0.3;
	}
	if ($av > 0.3 && $av < 0.4) {
	$grammi1 = 0.3;
	$grammi2 = 0.4;
	}
	if ($av > 0.4 && $av < 0.5) {
	$grammi1 = 0.4;
	$grammi2 = 0.5;
	}
	if ($av > 0.5 && $av < 0.6) {
	$grammi1 = 0.5;
	$grammi2 = 0.6;
	}
	if ($av > 0.6 && $av < 0.7) {
	$grammi1 = 0.6;
	$grammi2 = 0.7;
	}
	if ($av > 0.7 && $av < 0.8) {
	$grammi1 = 0.7;
	$grammi2 = 0.8;
	}
	if ($av > 0.8 && $av < 0.9) {
	$grammi1 = 0.8;
	$grammi2 = 0.9;
	}
	if ($av > 0.9 && $av < 1) {
	$grammi1 = 0.9;
	$grammi2 = 1.0;
	}
	
	if(!isset($grammi2)){$grammi2="";}
	return array ($grammi1,$grammi2);
}

//Επιλογή γραμμών Ufb για οριζόντιο στοιχείο σε έδαφος
function get_lines_ufb($ufb){
		if ($ufb >= 4.5) {
		$grammi1 = 4.5;
		}
		if ($ufb == 3) {
		$grammi1 = 3;
		}
		if ($ufb == 2) {
		$grammi1 = 2;
		}
		if ($ufb == 1.5) {
		$grammi1 = 1.5;
		}
		if ($ufb == 1) {
		$grammi1 = 1;
		}
		if ($ufb == 0.9) {
		$grammi1 = 0.9;
		}
		if ($ufb == 0.8) {
		$grammi1 = 0.8;
		}
		if ($ufb == 0.7) {
		$grammi1 = 0.7;
		}
		if ($ufb == 0.6) {
		$grammi1 = 0.6;
		}
		if ($ufb <= 0.5) {
		$grammi1 = 0.5;
		}
		if ($ufb > 0.5 && $ufb < 0.6) {
		$grammi1 = 0.5;
		$grammi2 = 0.6;
		}
		if ($ufb > 0.6 && $ufb < 0.7) {
		$grammi1 = 0.6;
		$grammi2 = 0.7;
		}
		if ($ufb > 0.7 && $ufb < 0.8) {
		$grammi1 = 0.7;
		$grammi2 = 0.8;
		}
		if ($ufb > 0.8 && $ufb < 0.9) {
		$grammi1 = 0.8;
		$grammi2 = 0.9;
		}
		if ($ufb > 0.9 && $ufb < 1) {
		$grammi1 = 0.9;
		$grammi2 = 1;
		}
		if ($ufb > 1 && $ufb < 1.5) {
		$grammi1 = 1;
		$grammi2 = 1.5;
		}
		if ($ufb > 1.5 && $ufb < 2) {
		$grammi1 = 1.5;
		$grammi2 = 2;
		}
		if ($ufb > 2 && $ufb < 3) {
		$grammi1 = 2;
		$grammi2 = 3;
		}
		if ($ufb > 3 && $ufb < 4.5) {
		$grammi1 = 3;
		$grammi2 = 4.5;
		}
		
		if(!isset($grammi2)){$grammi2="";}
		return array ($grammi1,$grammi2);
}

//Επιλογή στηλών Utb για κατακόρυφο στοιχείο σε έδαφος
//αφορά ονόματα στηλών και οι τιμές βρίσκονται σε ""
function get_columns_utb($utb){
		if ($utb >= 4.5) {
		$grammi1 = "4.5";
		}
		if ($utb == 3) {
		$grammi1 = "3";
		}
		if ($utb == 2) {
		$grammi1 = "2";
		}
		if ($utb == 1.5) {
		$grammi1 = "1.5";
		}
		if ($utb == 1) {
		$grammi1 = "1";
		}
		if ($utb == 0.9) {
		$grammi1 = "0.9";
		}
		if ($utb == 0.8) {
		$grammi1 = "0.8";
		}
		if ($utb == 0.7) {
		$grammi1 = "0.7";
		}
		if ($utb == 0.6) {
		$grammi1 = "0.6";
		}
		if ($utb == 0.5) {
		$grammi1 = "0.5";
		}
		if ($utb == 0.4) {
		$grammi1 = "0.4";
		}
		if ($utb <= 0.3) {
		$grammi1 = "0.3";
		}
		if ($utb > 0.3 && $utb < 0.4) {
		$grammi1 = "0.3";
		$grammi2 = "0.4";
		}
		if ($utb > 0.4 && $utb < 0.5) {
		$grammi1 = "0.4";
		$grammi2 = "0.5";
		}
		if ($utb > 0.5 && $utb < 0.6) {
		$grammi1 = "0.5";
		$grammi2 = "0.6";
		}
		if ($utb > 0.6 && $utb < 0.7) {
		$grammi1 = "0.6";
		$grammi2 = "0.7";
		}
		if ($utb > 0.7 && $utb < 0.8) {
		$grammi1 = "0.7";
		$grammi2 = "0.8";
		}
		if ($utb > 0.8 && $utb < 0.9) {
		$grammi1 = "0.8";
		$grammi2 = "0.9";
		}
		if ($utb > 0.9 && $utb < 1) {
		$grammi1 = "0.9";
		$grammi2 = "1";
		}
		if ($utb > 1 && $utb < 1.5) {
		$grammi1 = "1";
		$grammi2 = "1.5";
		}
		if ($utb > 1.5 && $utb < 2) {
		$grammi1 = "1.5";
		$grammi2 = "2";
		}
		if ($utb > 2 && $utb < 3) {
		$grammi1 = "2";
		$grammi2 = "3";
		}
		if ($utb > 3 && $utb < 4.5) {
		$grammi1 = "3";
		$grammi2 = "4.5";
		}
		
		if(!isset($grammi2)){$grammi2="";}
		return array ($grammi1,$grammi2);
}

//Επιλογή στηλών χαρακτηριστικής διάστασης πλάκας για οριζόντια δομικά στοιχεία σε έδαφος.
function get_columns_xaraktiristiki($xaraktiristiki){
		if ($xaraktiristiki <= 2) {
		$grammi1 = "2";
		}
		if ($xaraktiristiki == 3) {
		$grammi1 = "3";
		}
		if ($xaraktiristiki == 4) {
		$grammi1 = "4";
		}
		if ($xaraktiristiki == 5) {
		$grammi1 = "5";
		}
		if ($xaraktiristiki == 6) {
		$grammi1 = "6";
		}
		if ($xaraktiristiki == 7) {
		$grammi1 = "7";
		}
		if ($xaraktiristiki == 8) {
		$grammi1 = "8";
		}
		if ($xaraktiristiki == 9) {
		$grammi1 = "9";
		}
		if ($xaraktiristiki == 10) {
		$grammi1 = "10";
		}
		if ($xaraktiristiki == 12) {
		$grammi1 = "12";
		}
		if ($xaraktiristiki == 14) {
		$grammi1 = "14";
		}
		if ($xaraktiristiki == 18) {
		$grammi1 = "18";
		}
		if ($xaraktiristiki == 22) {
		$grammi1 = "22";
		}
		if ($xaraktiristiki == 26) {
		$grammi1 = "26";
		}
		if ($xaraktiristiki >= 30) {
		$grammi1 = "30";
		}
		if ($xaraktiristiki > 2 && $xaraktiristiki < 3) {
		$grammi1 = "2";
		$grammi2 = "3";
		}
		if ($xaraktiristiki > 3 && $xaraktiristiki < 4) {
		$grammi1 = "3";
		$grammi2 = "4";
		}
		if ($xaraktiristiki > 4 && $xaraktiristiki < 5) {
		$grammi1 = "4";
		$grammi2 = "5";
		}
		if ($xaraktiristiki > 5 && $xaraktiristiki < 6) {
		$grammi1 = "5";
		$grammi2 = "6";
		}
		if ($xaraktiristiki > 6 && $xaraktiristiki < 7) {
		$grammi1 = "6";
		$grammi2 = "7";
		}
		if ($xaraktiristiki > 7 && $xaraktiristiki < 8) {
		$grammi1 = "7";
		$grammi2 = "8";
		}
		if ($xaraktiristiki > 8 && $xaraktiristiki < 9) {
		$grammi1 = "8";
		$grammi2 = "9";
		}
		if ($xaraktiristiki > 9 && $xaraktiristiki < 10) {
		$grammi1 = "9";
		$grammi2 = "10";
		}
		if ($xaraktiristiki > 10 && $xaraktiristiki < 12) {
		$grammi1 = "10";
		$grammi2 = "12";
		}
		if ($xaraktiristiki > 12 && $xaraktiristiki < 14) {
		$grammi1 = "12";
		$grammi2 = "14";
		}
		if ($xaraktiristiki > 14 && $xaraktiristiki < 18) {
		$grammi1 = "14";
		$grammi2 = "18";
		}
		if ($xaraktiristiki > 18 && $xaraktiristiki < 22) {
		$grammi1 = "18";
		$grammi2 = "22";
		}
		if ($xaraktiristiki > 22 && $xaraktiristiki < 26) {
		$grammi1 = "22";
		$grammi2 = "26";
		}
		if ($xaraktiristiki > 26 && $xaraktiristiki < 30) {
		$grammi1 = "26";
		$grammi2 = "30";
		}
		
		if(!isset($grammi2)){$grammi2="";}
		return array ($grammi1,$grammi2);
}

//Επιλογή γραμμών Z για οριζόντια στοιχεία σε έδαφος
function get_lines_dapedovathos($vathos){
		if ($vathos == 0) {
		$grammi1 = 0;
		}
		if ($vathos == 0.5) {
		$grammi1 = 0.5;
		}
		if ($vathos == 1) {
		$grammi1 = 1;
		}
		if ($vathos == 1.5) {
		$grammi1 = 1.5;
		}
		if ($vathos == 2) {
		$grammi1 = 2;
		}
		if ($vathos == 2.5) {
		$grammi1 = 2.5;
		}
		if ($vathos == 3) {
		$grammi1 = 3;
		}
		if ($vathos == 4) {
		$grammi1 = 4;
		}
		if ($vathos == 5) {
		$grammi1 = 5;
		}
		if ($vathos >= 6) {
		$grammi1 = 6;
		}
		if ($vathos >= 9) {
		$grammi1 = 9;
		}
		if ($vathos > 0 && $vathos < 0.5) {
		$grammi1 = 0;
		$grammi2 = 0.5;
		}
		if ($vathos > 0.5 && $vathos < 1) {
		$grammi1 = 0.5;
		$grammi2 = 1;
		}
		if ($vathos > 1 && $vathos < 1.5) {
		$grammi1 = 1;
		$grammi2 = 1.5;
		}
		if ($vathos > 1.5 && $vathos < 2) {
		$grammi1 = 1.5;
		$grammi2 = 2;
		}
		if ($vathos > 2 && $vathos < 2.5) {
		$grammi1 = 2;
		$grammi2 = 2.5;
		}
		if ($vathos > 2.5 && $vathos < 3) {
		$grammi1 = 2.5;
		$grammi2 = 3;
		}
		if ($vathos > 3 && $vathos < 4) {
		$grammi1 = 3;
		$grammi2 = 4;
		}
		if ($vathos > 4 && $vathos < 5) {
		$grammi1 = 4;
		$grammi2 = 5;
		}
		if ($vathos > 5 && $vathos < 6) {
		$grammi1 = 5;
		$grammi2 = 6;
		}
		if ($vathos > 6 && $vathos < 9) {
		$grammi1 = 6;
		$grammi2 = 9;
		}
		
		if(!isset($grammi2)){$grammi2="";}
		return array ($grammi1,$grammi2);
}

//Επιλογή γραμμών Z για κατακόρυφα στοιχεία σε έδαφος
function get_lines_toixosvathos($vathos){
		if ($vathos <= 0.5) {
		$grammi1 = 0.5;
		}
		if ($vathos == 1) {
		$grammi1 = 1;
		}
		if ($vathos == 1.5) {
		$grammi1 = 1.5;
		}
		if ($vathos == 2) {
		$grammi1 = 2;
		}
		if ($vathos == 2.5) {
		$grammi1 = 2.5;
		}
		if ($vathos == 3) {
		$grammi1 = 3;
		}
		if ($vathos == 4.5) {
		$grammi1 = 4.5;
		}
		if ($vathos == 6) {
		$grammi1 = 6;
		}
		if ($vathos >= 9) {
		$grammi1 = 9;
		}
		if ($vathos > 0.5 && $vathos < 1) {
		$grammi1 = 0.5;
		$grammi2 = 1;
		}
		if ($vathos > 1 && $vathos < 1.5) {
		$grammi1 = 1;
		$grammi2 = 1.5;
		}
		if ($vathos > 1.5 && $vathos < 2) {
		$grammi1 = 1.5;
		$grammi2 = 2;
		}
		if ($vathos > 2 && $vathos < 2.5) {
		$grammi1 = 2;
		$grammi2 = 2.5;
		}
		if ($vathos > 2.5 && $vathos < 3) {
		$grammi1 = 2.5;
		$grammi2 = 3;
		}
		if ($vathos > 3 && $vathos < 4.5) {
		$grammi1 = 3;
		$grammi2 = 4.5;
		}
		if ($vathos > 4.5 && $vathos < 6) {
		$grammi1 = 4.5;
		$grammi2 = 6;
		}
		if ($vathos > 6 && $vathos < 9) {
		$grammi1 = 6;
		$grammi2 = 9;
		}
		
		if(!isset($grammi2)){$grammi2="";}
		return array ($grammi1,$grammi2);
}

//Εύρεση τιμών στον πίνακα vivliothiki_domika9a για το δάπεδο επί εδάφους
function get_ufb($xaraktiristiki, $vathos, $ufb){
	$database = new medoo(DB_NAME);
	$tb = "vivliothiki_domika9a";
	$col = "*";
	$vathos=(string)($vathos);
	$ufb=(string)($ufb);	
	$where=array("AND"=>array("Ufb"=>$ufb,"z"=>$vathos));
	$data_table = $database->select($tb,$col,$where);
	$zitoymeno = $data_table[0][$xaraktiristiki];
	return $zitoymeno;
}

//Εύρεση τιμών στον πίνακα vivliothiki_domika9b για το κατακόρυφο επί εδάφους
function get_utb($vathos, $utb){
	$database = new medoo(DB_NAME);
	$tb = "vivliothiki_domika9b";
	$col = "*";
	$vathos=(string)($vathos);
	$data_table = $database->select($tb,$col, array("z"=>$vathos) );
	$zitoymeno = $data_table[0][$utb];
	return $zitoymeno;
}

//Εύρεση Um,max στον πίνακα vivliothiki_ummax
//type:0 παλιό, 1 ριζ. ανακ. (παλίος κενακ), 2 νέο (παλίος κενακ), 3 ριζ. ανακ. (νέος κενακ), 4 νέο (νέος κενακ)
function get_ummax($zwni, $aprosv, $bld_type=0){
	$database = new medoo(DB_NAME);
	if($bld_type<=3){
		$tb = "vivliothiki_ummax_old";
	}
	if($bld_type==4){
		$tb = "vivliothiki_ummax_new";
	}
	$zwni=(string)($zwni);
	$col = $zwni;
	
	$lines = get_lines_av($aprosv);
	$line1=$lines[0];
	$line2=$lines[1];
	if ($line2==""){ //Το a/v ακριβώς
		$ummax = $database->select($tb,$col, array("a_pros_v"=>(string)$line1) );
		$ummax=$ummax[0];
	}else{
		$ummax1 = $database->select($tb,$col, array("a_pros_v"=>(string)$line1) );
		$ummax1=$ummax1[0];
		$ummax2 = $database->select($tb,$col, array("a_pros_v"=>(string)$line2) );
		$ummax2=$ummax2[0];
		$ummax = paremvoli($line1, $line2, $ummax1, $ummax2, $aprosv);
	}
	
	return $ummax;
}

//Υπολογισμός ισοδύναμου συντελεστή δαπέδου. Ορίζεται ο ονομαστικός, το βάθος και η χαρακτηριστική και επιστρέφει τον ισοδύναμο
function isodynamos_dapedoy($ufb, $z, $b){
	$database = new medoo(DB_NAME);
	$tb = "vivliothiki_domika9a";
	
	$ufb_times = get_lines_ufb($ufb);
	$ufb1=$ufb_times[0];
	$ufb2 = $ufb_times[1];
	
	$stiles=get_columns_xaraktiristiki($b);
	$b1 = $stiles[0];
	$b2 = $stiles[1];
	$grammes=get_lines_dapedovathos($z);
	$z1 = $grammes[0];
	$z2 = $grammes[1];
	
	//Για το 1ο Ufb
	$ufb=$ufb1;
	if ($b2==""){ //Οι στήλες (χαρακτηριστική) ακριβώς
		if ($z2=="") { //Οι γραμμές (βάθος) ακριβώς
			$u = get_ufb($b1, $z1, $ufb);
		}else{//Οι γραμμές (βάθος) έχουν 2 γραμμές
			$u1 = get_ufb($b1, $z1, $ufb);
			$u2 = get_ufb($b1, $z2, $ufb);
			$u = paremvoli($z1, $z2, $u1, $u2, $z);
		}//γραμμές
	}else{ //Οι στήλες (χαρακτηριστική) έχει 2 στήλες
		if ($z2=="") { //Οι γραμμές (βάθος) ακριβώς
			$u1 = get_ufb($b1, $z1, $ufb);
			$u2 = get_ufb($b2, $z1, $ufb);
			$u = paremvoli($b1, $b2, $u1, $u2, $b);
		}else{//Οι γραμμές (βάθος) έχουν 2 γραμμές
			$u1_1 = get_ufb($b1, $z1, $ufb);
			$u1_2 = get_ufb($b1, $z2, $ufb);
			$u1 = paremvoli($z1, $z2, $u1_1, $u1_2, $z);
			$u2_1 = get_ufb($b2, $z1, $ufb);
			$u2_2 = get_ufb($b2, $z2, $ufb);
			$u2 = paremvoli($z1, $z2, $u2_1, $u2_2, $z);
			$u = paremvoli($b1, $b2, $u1, $u2, $b);
		}//γραμμές
	}//Στήλες
	
	$ufb1_u=$u;
		
	if($ufb2!=""){
	$ufb=$ufb2;
		if ($b2==""){ //Οι στήλες (χαρακτηριστική) ακριβώς
			if ($z2=="") { //Οι γραμμές (βάθος) ακριβώς
				$u = get_ufb($b1, $z1, $ufb);
			}else{//Οι γραμμές (βάθος) έχουν 2 γραμμές
				$u1 = get_ufb($b1, $z1, $ufb);
				$u2 = get_ufb($b1, $z2, $ufb);
				$u = paremvoli($z1, $z2, $u1, $u2, $z);
			}//γραμμές
		}else{ //Οι στήλες (χαρακτηριστική) έχει 2 στήλες
			if ($z2=="") { //Οι γραμμές (βάθος) ακριβώς
				$u1 = get_ufb($b1, $z1, $ufb);
				$u2 = get_ufb($b2, $z1, $ufb);
				$u = paremvoli($b1, $b2, $u1, $u2, $b);
			}else{//Οι γραμμές (βάθος) έχουν 2 γραμμές
				$u1_1 = get_ufb($b1, $z1, $ufb);
				$u1_2 = get_ufb($b1, $z2, $ufb);
				$u1 = paremvoli($z1, $z2, $u1_1, $u1_2, $z);
				$u2_1 = get_ufb($b2, $z1, $ufb);
				$u2_2 = get_ufb($b2, $z2, $ufb);
				$u2 = paremvoli($z1, $z2, $u2_1, $u2_2, $z);
				$u = paremvoli($b1, $b2, $u1, $u2, $b);
			}//γραμμές
		}//Στήλες
		
		$ufb2_u=$u;
	}else{//δεν υπάρχει 2η γραμμή για Ufb
		$ufb2_u=$ufb1_u;
	}
	
	//Έλεγχος των 2 τιμών Ufb
	if($ufb1_u!=$ufb2_u){
		$u = paremvoli($ufb1, $ufb2, $ufb1_u, $ufb2_u, $ufb);
	}else{
		$u=$ufb1_u;
	}
	
	return $u;
}

//Υπολογισμός ισοδύναμου συντελεστή κατακόρυφου στοιχείου σε έδαφος. Ορίζεται ο ονομαστικός, τα βάθη και επιστρέφει τον ισοδύναμο
function isodynamos_katakoryfoy($utb, $z1, $z2){
	$stiles = get_columns_utb($utb);
	$stiles1 = $stiles[0];
	$stiles2 = $stiles[1];	
	
	//#################################################################################
	//################# Υπολογισμός για το κατώτερο βάθος z1 ##############################
	$z1grammes = get_lines_toixosvathos($z1);
	$grammes1 = $z1grammes[0];
	$grammes2 = $z1grammes[1];
		if ($stiles2==""){ //Το utb ακριβώς
			if ($grammes2=="") { //Το z1 ακριβώς
			$timiu_vathos1 = get_utb($grammes1, $stiles1);
			}
			
			if ($grammes2!="") { //Το z1 δεν πέφτει ακριβώς
			$timiu1 = get_utb($grammes1, $stiles1);
			$timiu2 = get_utb($grammes2, $stiles1);
			$timiu_vathos1 = paremvoli($grammes1, $grammes2, $timiu1, $timiu2, $z1);
			}
		}else{ //Το utb δεν πέφτει ακριβώς
			if ($grammes2=="") { //Το z1 ακριβώς
			$timiu1 = get_utb($grammes1, $stiles1);
			$timiu2 = get_utb($grammes1, $stiles2);
			$timiu_vathos1 = paremvoli($stiles1, $stiles2, $timiu1, $timiu2, $utb);
			}
			
			if ($grammes2!="") { //Το z1 δεν πέφτει ακριβώς
			$timiu11 = get_utb($grammes1, $stiles1);
			$timiu12 = get_utb($grammes2, $stiles1);
			$timiu1 = paremvoli($grammes1, $grammes2, $timiu11, $timiu12, $z1);
			$timiu21 = get_utb($grammes1, $stiles2);
			$timiu22 = get_utb($grammes2, $stiles2);
			$timiu2 = paremvoli($grammes1, $grammes2, $timiu21, $timiu22, $z1);
			$timiu_vathos1 = paremvoli($stiles1, $stiles2, $timiu1, $timiu2, $utb);
			}
		}
	

	if($z2!=$z1){
		$z2grammes = get_lines_toixosvathos($z2);
		$grammes1 = $z2grammes[0];
		$grammes2 = $z2grammes[1];
		///#################################################################################
		//################# Υπολογισμός για το ανώτερο βάθος ##############################
			if ($stiles2==""){ //Το Ufb ακριβώς
				if ($grammes2=="") { //Το z2 ακριβώς
				$timiu_vathos2 = get_utb($grammes1, $stiles1);
				}
				
				if ($grammes2!="") { //Το z2 δεν πέφτει ακριβώς
				$timiu1 = get_utb($grammes1, $stiles1);
				$timiu2 = get_utb($grammes2, $stiles1);
				$timiu_vathos2 = paremvoli($grammes1, $grammes2, $timiu1, $timiu2, $z2);
				}
			}else{ //Το Ufb δεν πέφτει ακριβώς
				if ($grammes2=="") { //Το z2 ακριβώς
				$timiu1 = get_utb($grammes1, $stiles1);
				$timiu2 = get_utb($grammes1, $stiles2);
				$timiu_vathos2 = paremvoli($stiles1, $stiles2, $timiu1, $timiu2, $utb);
				}
				
				if ($grammes2!="") { //Το $z2 δεν πέφτει ακριβώς
				$timiu11 = get_utb($grammes1, $stiles1);
				$timiu12 = get_utb($grammes2, $stiles1);
				$timiu1 = paremvoli($grammes1, $grammes2, $timiu11, $timiu12, $z2);
				$timiu21 = get_utb($grammes1, $stiles2);
				$timiu22 = get_utb($grammes2, $stiles2);
				$timiu2 = paremvoli($grammes1, $grammes2, $timiu21, $timiu22, $z2);
				$timiu_vathos2 = paremvoli($stiles1, $stiles2, $timiu1, $timiu2, $utb);
				}
			}
	}
	
	
	if ($z2==$z1){
	return $timiu_vathos1;
	}else{
	$u_sun = (($z2*$timiu_vathos2)-($z1*$timiu_vathos1))/($z2-$z1);
	return $u_sun;
	}
	
}

//Επιστροφή τιμών συνθηκών λειτουργίας
function get_synthikes($id_xrisi,$hotel=1,$hospital=1){
	
	$database = new medoo(DB_NAME);
	$table = "vivliothiki_conditions_zone";
	$columns = "*";
	$where = array("id"=>$id_xrisi);
	
	$data_table = $database->select($table,$columns,$where);
	
	//Όνομα γενικής χρήσης αντί για id
	$data_genxrisi = $database->select("vivliothiki_conditions_general","name",array("id"=>$data_table[0]["gen_id"]));
	$data_table[0]["gen_id"]=$data_genxrisi[0];
	
	//Εάν ο τύπος ΖΝΧ είναι υπολογισμός με βάση τον τύπο του ξενοδοχείου
	if($data_table[0]["znx_calc_type"]==2){
		if($data_table[0]["id"]==2 OR $data_table[0]["id"]==3){
			$hotel_type=1;
		}
		if($data_table[0]["id"]==5 OR $data_table[0]["id"]==6){
			$hotel_type=2;
		}
		if($data_table[0]["id"]==8 OR $data_table[0]["id"]==9){
			$hotel_type=3;
		}
		$where_hotel=array("AND"=>array("hotel_type"=>$hotel_type,"category"=>$hotel));
		$data_hotels = $database->select("vivliothiki_conditions_znx_hotels",$columns,$where_hotel);
		$data_table[0]["znx_lt_perperson"]=$data_hotels[0]["znx_lt_perperson"];
		$data_table[0]["znx_lt_perm2"]=$data_hotels[0]["znx_lt_perm2"];
		$data_table[0]["znx_m3_perroom"]=$data_hotels[0]["znx_m3_perroom"];
		$data_table[0]["znx_m3_perm2"]=$data_hotels[0]["znx_m3_perm2"];
	}
	
	//Εάν ο τύπος ΖΝΧ είναι υπολογισμός με βάση τον τύπο κλινικής - νοσοκομείου
	if($data_table[0]["znx_calc_type"]==3){
		$where_hospital=array("id"=>$hospital);
		$data_hospitals = $database->select("vivliothiki_conditions_znx_hospitals",$columns,$where_hospital);
		$data_table[0]["znx_lt_perperson"]=$data_hospitals[0]["znx_lt_perperson"];
		$data_table[0]["znx_lt_perm2"]=$data_hospitals[0]["znx_lt_perm2"];
		$data_table[0]["znx_m3_perroom"]=$data_hospitals[0]["znx_m3_perroom"];
		$data_table[0]["znx_m3_perm2"]=$data_hospitals[0]["znx_m3_perm2"];
	}
	
	//επιστρέφει array για javascript
	return json_encode($data_table[0]);
}

//Επιστροφή των ngm,ng0,ng1,ng2
function get_therm_ng($pgen, $pn, $boilertype=1, $instype=1,$nsath,$nsthd,$nmg2){
	$database = new medoo(DB_NAME);
	$table_ngm = "vivliothiki_therm_p_ngm";
	$table_ng1 = "vivliothiki_therm_p_ng1";
	$table_ng2 = "vivliothiki_therm_p_ng2";
	$columns = "*";
	$where_ngm =array("id"=>$boilertype);
	if($instype==1){
		$where_ng2 =array("type_insulation"=>$instype);
	}else{
		$where_ng2 =array("AND"=>array("type_insulation"=>$instype,"type_boiler"=>$boilertype));
	}
	
	//NGM - NG0
	$data_ngm = $database->select($table_ngm,$columns,$where_ngm);
	
	$ngm=$data_ngm[0]["ngm"];
	if($pn<=25){
		$ngo=$data_ngm[0]["ngo_1"];
	}
	if($pn>25 AND $pn<=100){
		$ngo=$data_ngm[0]["ngo_2"];
	}
	if($pn>100 AND $pn<=400){
		$ngo=$data_ngm[0]["ngo_3"];
	}
	if($pn>400){
		$ngo=$data_ngm[0]["ngo_4"];
	}
	
	//NG1
	$data_ng1 = $database->select($table_ng1,$columns,$where_ngm);
	
	if($nsthd!=0){//λέβητας με σήμανση
		$nskth=$nsath*($nsthd+0.03);
	}else{//λέβητας με φύλλο
		if($nmg2!=0 AND $nmg2!=""){
			$nskth=$nmg2*$ngo;
		}else{
			$nskth=$ngm*$ngo;
		}
	}
	$pm=$pn*$nskth;
	$ng1_per=$pm/$pgen;
	
	$help_txt="Pm=Pn x ΝsΚΘ=".$pn." x ".$nskth."=".$pm."KW - Υπερδιαστασιολόγηση: Pm/Pgen=".$pm."/".$pgen."=".round($ng1_per,3);
	
	if($ng1_per<=1){
		$column1="ng100";
		$ng1=$data_ng1[0]["ng100"];
	}
	if($ng1_per==1.25){
		$column1="ng125";
		$ng1=$data_ng1[0]["ng125"];
	}
	if($ng1_per==1.50){
		$column1="ng150";
		$ng1=$data_ng1[0]["ng150"];
	}
	if($ng1_per==2){
		$column1="ng200";
		$ng1=$data_ng1[0]["ng200"];
	}
	if($ng1_per==4){
		$column1="ng400";
		$ng1=$data_ng1[0]["ng400"];
	}
	if($ng1_per>=5){
		$column1="ng500";
		$ng1=$data_ng1[0]["ng500"];
	}
	if($ng1_per>1 AND $ng1_per<1.25){
		$ng1_1=$data_ng1[0]["ng100"];
		$ng1_2=$data_ng1[0]["ng125"];
		$ng1 = paremvoli(1, 1.25, $ng1_1, $ng1_2, $ng1_per);
	}
	if($ng1_per>1.25 AND $ng1_per<1.50){
		$ng1_1=$data_ng1[0]["ng125"];
		$ng1_2=$data_ng1[0]["ng150"];
		$ng1 = paremvoli(1.25, 1.50, $ng1_1, $ng1_2, $ng1_per);
	}
	if($ng1_per>1.50 AND $ng1_per<2){
		$ng1_1=$data_ng1[0]["ng150"];
		$ng1_2=$data_ng1[0]["ng200"];
		$ng1 = paremvoli(1.5, 2, $ng1_1, $ng1_2, $ng1_per);
	}
	if($ng1_per>2 AND $ng1_per<4){
		$ng1_1=$data_ng1[0]["ng200"];
		$ng1_2=$data_ng1[0]["ng400"];
		$ng1 = paremvoli(2, 4, $ng1_1, $ng1_2, $ng1_per);
	}
	if($ng1_per>4 AND $ng1_per<5){
		$ng1_1=$data_ng1[0]["ng400"];
		$ng1_2=$data_ng1[0]["ng500"];
		$ng1 = paremvoli(4, 5, $ng1_1, $ng1_2, $ng1_per);
	}
	
	//NG2
	$data_ng2 = $database->select($table_ng2,$columns,$where_ng2);
	$ng2_a = $data_ng2[0]["a"];
	$ng2_b = $data_ng2[0]["b"];
	$ng2 = ($ng2_a*$ng1_per) + $ng2_b;
	
	//NGEN
	$ngen=$ngm*$ngo*$ng1*$ng2;
	
	$return = array(
		$ngm,
		$ngo,
		round($ng1_per,3),
		round($ng1,3),
		$ng2_a,
		$ng2_b,
		round($ng2,3),
		$help_txt
	);
	//επιστρέφει array για javascript
	return json_encode($return);
}

//Επιστροφή βαθμού απόδοσης δικτύου διανομής ΘΕΡΜΑΝΣΗΣ
//$p: Ισχύς
//$t: 1-T>60οC, 2-T<60οC
//$dieleysi: 1-εσωτερικά 2-εξωτερικά
//$monwsi: 1-Κτιρίου αναφορά 2-Ίση με ακτίνα σωλήνα 3- Ανεπαρκής 4-χωρίς μονωση
function get_therm_dianomi_n($p, $t, $dieleysi, $monwsi){

//Ισχύς δικτύου	
	if($p>0 AND $p<=100){$p=1;}
	if($p>100 AND $p<=200){$p=2;}
	if($p>200 AND $p<=300){$p=3;}
	if($p>300 AND $p<=400){$p=4;}
	if($p>400){$p=5;}

//Διέλευση
	if($dieleysi==1){$dieleysi="esw";}
	if($dieleysi==2){$dieleysi="eksw";}

	$database = new medoo(DB_NAME);
	$table = "vivliothiki_therm_d";
	$columns = $dieleysi.$monwsi;
	$where = array("AND"=>array("p"=>$p,"t"=>$t));
	
	$data_table = $database->select($table,$columns,$where);	
	
	$n=(100-$data_table[0])/100;
	//επιστρέφει μία τιμή
	return $n;
	
}

//Επιστροφή βαθμού απόδοσης δικτύου διανομής ΨΥΞΗΣ
//$p: Ισχύς
//$dieleysi: 1-εσωτερικά 2-εξωτερικά
//$monwsi: 1-Κτιρίου αναφορά 2-Ίση με ακτίνα σωλήνα 3- Ανεπαρκής 4-χωρίς μονωση
function get_cold_dianomi_n($p, $dieleysi, $monwsi){

//Ισχύς δικτύου	
	if($p>0 AND $p<=100){$p=1;}
	if($p>100 AND $p<=200){$p=2;}
	if($p>200 AND $p<=300){$p=3;}
	if($p>300 AND $p<=400){$p=4;}
	if($p>400){$p=5;}

//Διέλευση
	if($dieleysi==1){$dieleysi="esw";}
	if($dieleysi==2){$dieleysi="eksw";}

	$database = new medoo(DB_NAME);
	$table = "vivliothiki_cold_d";
	$columns = $dieleysi.$monwsi;
	$where = array("p"=>$p);
	
	$data_table = $database->select($table,$columns,$where);	
	
	$n=(100-$data_table[0])/100;
	//επιστρέφει μία τιμή
	return $n;	
}

//Επιστροφή βαθμού απόδοσης δικτύου διανομής ΖΝΧ
//$p: Ισχύς
//$anakykloforia: 1-xwris 2-me
//$monwsi: 1-Κτιρίου αναφορά 2- Ανεπαρκής 3-χωρίς μονωση
function get_znx_dianomi_n($p, $anakykloforia, $monwsi){

//Ισχύς δικτύου	
	if($p>0 AND $p<=200){$p=1;}
	if($p>200 AND $p<=1000){$p=2;}
	if($p>1000 AND $p<=4000){$p=3;}
	if($p>4000 AND $p<=7000){$p=4;}
	if($p>7000){$p=5;}

//Διέλευση
	if($anakykloforia==1){$anakykloforia="xwris";}
	if($anakykloforia==2){$anakykloforia="me";}

	$database = new medoo(DB_NAME);
	$table = "vivliothiki_znx_d";
	$columns = $anakykloforia.$monwsi;
	$where = array("p"=>$p);
	
	$data_table = $database->select($table,$columns,$where);	
	
	$n=(100-$data_table[0])/100;
	//επιστρέφει μία τιμή
	return $n;
}

//Επιστροφή συντελεστή αξιοποίησης για ΖΝΧ από συλλέκτη
//$xrisi: 1 - Κατοικίες, 2 - Τριτογενής
//$type: Τύπος συλλέκτη
//$place: το id του πίνακα συνα για περιοχή
//$deg: γωνία κλίσης ως προς την κατακόρυφο του ηλιακού συλλέκτη
function get_solar_syna($xrisi, $type, $place, $deg){

//Χρήση
	if($xrisi==1){
		$table = "vivliothiki_syna_ktiria";
	}
	if($xrisi==2){
		$table = "vivliothiki_syna_3genis";
	}

//Γωνία κλίσης
$deg_array = array();
	if($deg<=15){
		$stili1=15;
	}
	if($deg>15 AND $deg<45){
		$stili1=15;
		$stili2=45;
	}
	if($deg==45){
		$stili1=45;
	}
	if($deg>45 AND $deg<65){
		$stili1=45;
		$stili2=65;
	}
	if($deg>=65){
		$stili1=65;
	}
	
	if(!isset($stili2)){
	$stili2 = "";
	}

//Τύπος συλλέκτη
	if($type==1){
		$type="simple";
	}
	if($type==2){
		$type="select";
	}
	if($type==3){
		$type="vacum";
	}

	//Χρήση medoo
	$database = new medoo(DB_NAME);
	$where = array("id"=>$place);
	
	if($stili2 == ""){
		$columns = $type.$stili1;
		$data_table = $database->select($table,$columns,$where);
		$return = $data_table[0];
	}else{
		$columns1 = $type.$stili1;
		$columns2 = $type.$stili2;
		$data_table1 = $database->select($table,$columns1,$where);
		$data_table2 = $database->select($table,$columns2,$where);
		$timi1 = $data_table1[0];
		$timi2 = $data_table2[0];
		
		$return = paremvoli($stili1, $stili2, $timi1, $timi2, $deg);
	}

	//επιστρέφει μία τιμή
	return $return;
}

//Επιστροφή πίνακα καμπυλών f
//$ac : επιφάνεια συλλέκτη
//$place : το όνομα από τον πίνακα κλιματικών δεδομένων
//$xrisi : Χρήση κτιρίου
//$zone_synt : Εμβαδόν ζώνης ή κλίνες ζώνης
//$deg , $pros : προσανατολισμός, κλίση
//$xrisi_syl = χρήση συλλέκτη, 1-ΖΝΧ, 2-Θέρμανση
//$t : θερμοκρασία
//$m : μέγεθος μποιλερ
//$fr , $ul , $fr , $type , $tan : χαρακτηριστικά συλλέκτη
function get_fcharts_table($place, $xrisi, $klines, $zone_e=100, $g=180, $b=45, $t_znx=45, $ac=1, $m=160, $solar_type=1, $ennalaktis=0){

	$nmonths = array(0,"Ιαν","Φεβ","Μαρ","Απρ","Μαι","Ιουν","Ιούλ","Αυγ","Σεπ","Οκτ","Νοε","Δεκ");
	$nmonths_en = array(0,"jan","feb","mar","apr","may","jun","jul","aug","sep","okt","nov","dec");
	$ndays = array(0,31,28,31,30,31,30,31,31,30,31,30,31);
	$water_r=1;//Πυκνότητα νερού
	$water_cp=4.19;//Ειδική θερμότητα νερού
	$t_anaf=100;
	if($m==0){$m=75;}
	$k1=pow((75/$m),0.25);
	
	$database = new medoo(DB_NAME);
	
	if($solar_type==1){
		$frtan = 0.82;
		$frul = 7.5;
		for($i=1;$i<=12;$i++){
			$data_tatan = $database->select("vivliothiki_solarta_single",$b,array("id"=>$i) );
			${"tatan".$i} = $data_tatan[0];
		}
	}
	
	if($solar_type==2){
		$frtan = 0.75;
		$frul = 5;
		for($i=1;$i<=12;$i++){
			$data_tatan = $database->select("vivliothiki_solarta_double",$b,array("id"=>$i) );
			${"tatan".$i} = $data_tatan[0];
		}
	}
	
	if($solar_type==3){
		$frtan = 0.57;
		$frul = 1.82;
		for($i=0;$i<=11;$i++){
			${"tatan".$i}=0.99;
		}
	}
	
	if($solar_type==3){
		$frtan = 0.86;
		$frul = 21.5;
		for($i=0;$i<=11;$i++){
			${"tatan".$i}=0.99;
		}
	}
	
	if($ennalaktis==0){$frfr = 1;}
	if($ennalaktis==1){$frfr = 0.85;}
	
	
	//Υπολογισμός κατανάλωσης ζεστού νερού με βάση τη χρήση κτιρίου
	//$xrisi=intval($xrisi);
	$data_conditions = $database->select("vivliothiki_conditions","*",array("id"=>$xrisi) );
	
	$znx_m2 = ($data_conditions[0]["atoma"]*$zone_e/100) * $data_conditions[0]["znx_l_p_d"]; //υπολογισμός με m2 και άτομα/100m2 σε lt/d
	$znx_klines = round(($data_conditions[0]["znx_m3_sq_y"]*$klines) * (1000/365),2); //Υπολογισμός με κλίνες και m3/y και μετατροπή σε lt/d
	
	if($xrisi>=1 && $xrisi<=17){$hkznx = $znx_klines;}
	if($xrisi>=18 && $xrisi<=33){$hkznx = $znx_m2;}
	if($xrisi>=34 && $xrisi<=40){$hkznx = $znx_klines;}
	if($xrisi==41){$hkznx = $znx_m2;}
	if($xrisi==42){$hkznx = $znx_klines;}
	if($xrisi>=42){$hkznx = $znx_m2;}
	
	
	//Εύρεση ζώνης από την περιοχή
	$data_zone = $database->select("vivliothiki_climate_places","*",array("place"=>$place) );
	$zone = $data_zone[0]["zone"];
	$zone_name = $data_zone[0]["place"];
	
	$data_t_water = $database->select("vivliothiki_nerodiktyoy","*",array("zwni"=>$zone) );
	$data_t_mesi = $database->select("vivliothiki_climate31","*",array("place"=>$zone_name) );
	$data_solar_mesi = $database->select("vivliothiki_climate_b","*",array("place"=>$zone_name) );
	
	$data_dd = $database->select("vivliothiki_climate37","*",array("place"=>$zone_name) );
	
	$xrisi_name = $database->select("vivliothiki_conditions", "xrisi", array("id"=>$xrisi) );
	$xrisi_name=$xrisi_name[0];
	$txt = "";
	
	$txt .= "Περιοχή τοποθέτησης: ".$place."<br/>";
	$txt .= "Χρήση: ".$xrisi_name." (".$data_conditions[0]["znx_m3_sq_y"]."m3/κλίνη/y ή ".$data_conditions[0]["znx_l_p_d"]."l/άτομο/d)<br/>";
	$txt .= "Ac (επιφάνεια συλλέκτη): ".$ac." m<sup>2</sup><br/>";
	$txt .= "Μ (Χωρητικότητα θερμαντήρα): ".$m." l<br/>";
	$txt .= "Κλίνες / m2: ".$klines." / ".$zone_e." <br/>";
	$txt .= "HKznx (Μέση ημερήσια κατανάλωση ΖΝΧ): ".$hkznx." l/day <br/>";
	$txt .= "Tznx (Επιθυμητή θερμοκρασία ΖΝΧ): ".$t_znx." <sup>o</sup>C<br/>";
	$txt .= "Χαρακτηριστικά μεγέθη συλλέκτη: FRUL=".$frul." , FR(τα)n=".$frtan." , (τα)/(τα)n=ανά μήνα<br/>";
	$txt .= "FR'/FR (εάν παρεμβάλλεται εναλλάκτης): ".$frfr."<br/>";
	$txt .= "k<sub>1</sub> (διορθωτικός συντελεστής δεξαμενής)= (75/".$m.")<sup>0.25</sup>=".round($k1,2)."<br/>";
	$txt .= "k<sub>3</sub> (διορθωτικός συντελεστής εναλλάκτη): 1 (για ΖΝΧ)<br/><br/>";
	$txt .="<table class=\"table table-bordered\">				
		<tr class=\"success\">";
	$txt .="<th>Παράμετρος</th>";
		for($i=1;$i<=12;$i++){
			$txt .="<th>".$nmonths[$i]."</th>";
		}
	$txt .="<th>ΣΥΝ</th>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td>Ημέρες μήνα</td>";
	for($i=1;$i<=12;$i++){
			$txt .="<td>".$ndays[$i]."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td>Τκ Νερό δικτύου</td>";
		for($i=1;$i<=12;$i++){
			$txt .="<td>".$data_t_water[0][$nmonths_en[$i]]."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	
	$txt .="<tr>";
	$txt .="<td>Ta Μέση θερμοκρασία 24ώρου</td>";
		for($i=1;$i<=12;$i++){
			$txt .="<td>".$data_t_mesi[0][$nmonths_en[$i]]."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td>Ηβ Μέση μηνιαία ηλιακή ακτινοβολία (κλιση 45 - προς 180)</td>";
		for($i=0;$i<=11;$i++){
			$txt .="<td>".$data_solar_mesi[$i]["b45g180"]."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td>Lznx (Μέσο μηνιαίο θερμικό φορτίο) (J)</td>";
		$lznx=0;
		for($i=1;$i<=12;$i++){
		${"lznx".$i} = $ndays[$i]*$hkznx*$water_r*$water_cp*($t_znx-$data_t_water[0][$nmonths_en[$i]])*1000;
		$lznx += ${"lznx".$i};

			$txt .="<td>".${"lznx".$i}."</td>";
		}
	$txt .="<td>".$lznx."</td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td>DD Βαθμοημέρες θέρμανσης</td>";
		for($i=1;$i<=12;$i++){
			$txt .="<td>".$data_dd[0][$nmonths_en[$i]]."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	
	$txt .="<tr>";
	$txt .="<td>k<sub>2</sub> (διορθωτικός συντελεστής)</td>";
		//Υπολογισμός Κ2 για μεγάλες καταναλώσεις
		for($i=1;$i<=12;$i++){
			${"k2".$i}=(11.6 + 1.18*$t_znx + 3.86*$data_t_water[0][$nmonths_en[$i]] - 2.32*$data_t_mesi[0][$nmonths_en[$i]]) / (100-$data_t_mesi[0][$nmonths_en[$i]]);
			${"k2".$i} = round(${"k2".$i},2);
			$txt .="<td>".${"k2".$i}."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td>(τα)/(τα)n</td>";
		for($i=1;$i<=12;$i++){
			$txt .="<td>".${"tatan".$i}."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	
	$txt .="<tr>";
	$txt .="<td>Χ</td>";
		for($i=1;$i<=12;$i++){
		${"x".$i} = ($ac/${"lznx".$i}) * $frul * $frfr * ($t_anaf-$data_t_mesi[0][$nmonths_en[$i]]) * ($ndays[$i]*24*60*60) * $k1 * ${"k2".$i};
		${"x".$i} = round(${"x".$i},2);
			$txt .="<td>".${"x".$i}."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td>Υ</td>";
		for($i=1;$i<=12;$i++){
		${"y".$i} = ($ac/${"lznx".$i}) * $frtan * $frfr * ${"tatan".$i} * ($data_solar_mesi[$i-1]["b45g180"]*3600*1000) * 1;
		${"y".$i} = round(${"y".$i},2);
			$txt .="<td>".${"y".$i}."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td>f (Ποσοστό κάλυψης από ηλιακά)</td>";
		for($i=1;$i<=12;$i++){
		${"f".$i} = 1.029*${"y".$i} - 0.065*${"x".$i} - 0.245*pow(${"y".$i},2) + 0.0018*pow(${"x".$i},2) + 0.0215*pow(${"y".$i},3);
		${"f".$i} = round(${"f".$i},2);
			if(${"f".$i}>1){${"f".$i}=1;}
			$txt .="<td class=\"success\">".${"f".$i}."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td>1-f (Υπόλοιπο από λέβητα)</td>";
		for($i=1;$i<=12;$i++){
		${"flev".$i} = 1-${"f".$i};
			$txt .="<td class=\"warning\">".${"flev".$i}."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td>f*l</td>";
		$fl=0;
		for($i=1;$i<=12;$i++){
		${"fl".$i} = ${"f".$i}*${"lznx".$i};
		$fl += ${"fl".$i};
		
			$txt .="<td>".${"fl".$i}."</td>";
		
		}
	$txt .="<td >".$fl."</td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td colspan=13>Κάλυψη f</td>";
	$f = $fl / $lznx;
	$f = round($f,2);
	$f_percent = $f*100;
	$txt .="<td class=\"success\">".$f." ή ".$f_percent."%</td>";
	$txt .="</tr>";
	
	$txt .="</table><br/>";
	
	$txt .="O ηλιακός συλλέκτης καλλύπτει το ".$f_percent."% των απαιτήσεων σε ΖΝΧ.<br/>";
	if($f_percent<=96){
	$txt .= "<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-success\" style=\"width: ".$f_percent."%;\">".$f_percent."%</div></div>";
	}else{
	$txt .= "<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-success\" style=\"width: ".$f_percent."%;\"></div></div>";
	}

return $txt;	
	
	
}


//Εξισώσεις ηλιακής τροχιάς
//Χαρακτηριστική μέρα για κάθε μήνα
function solar_day($month=1){
	$day=array(0, 17, 47, 75, 105, 135, 162, 198, 228, 258, 289, 320, 351);
	return $day[$month];
}

//Ηλιακή απόκλιση
function solar_apoklisi($month){
	$day=solar_day($month);
	$d=23.45*sin(360*(($day+284)/365));
	return $d;
}

//ωριαία γωνία
//f: γεωγρ. πλάτος, b: κλίση επιφάνειας, d: ηλιακή απόκλιση
function solar_time($f, $b, $month){
	$d = solar_apoklisi($month);
	$w1 = acos(-tan($f)*tan($d));
	$w2 = acos(-tan($f-$b)*tan($d));
	if($w1<$w2){$w=$w1;}else{$w=$w2;}
	return $w;
}

//ηλιακό ύψος
function solar_height($f, $b, $month){
	$d = solar_apoklisi($month);
	$w = solar_time($f,$b, $month);
	$a = asin( sin($d)*sin($f)+cos($d)*cos($f)*cos($w) );
	return $a;
}

//Ηλιακό αζιμούθιο
function solar_azimuth(){
	if(($f-$d)<0){$c2=-1;}
	if(($f-$d)>=0){$c2=1;}
	
	$gw = $c1*$c2*asin(sin($w)*cos($d)/sin($a))+$c3*180*(1-$c1*$c2)/2;
	return $gw;
}
?>