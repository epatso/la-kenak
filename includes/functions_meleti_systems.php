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
//type=0 όλο το κτίριο, 1: ζώνες, 2: μθχ
function systems_calc_ea($zone_id=0){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb_xwroi = "meletes_xwroi";
	$tb_walls = "meletes_zone_adiafani";
	$tb_floors = "meletes_zone_dapeda";
	$tb_roofs = "meletes_zone_orofes";
	$col = "*";
	
	if($zone_id==0){
		//μόνο ζώνες
		$session_array=array("AND"=>array(
			"user_id"=>$_SESSION['user_id'],
			"meleti_id"=>$_SESSION['meleti_id'],
			"zone_id[!]"=>0
			)
		);
	}else{
		$session_array=array("AND"=>array(
			"user_id"=>$_SESSION['user_id'],
			"meleti_id"=>$_SESSION['meleti_id'],
			"zone_id"=>$zone_id
			)
		);
	}
	
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

//Υπολογισμός Um
//Εκτύπωση πίνακα U αδιαφανών
//type: 1: Επαφή σε άερα, 2: Επαφή με ΜΘΧ, 3: Επαφή σε έδαφος
function systems_calc_um($zone_id=0){
	$database = new medoo(DB_NAME);
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	
	//Γενικά στοιχεία μελέτης
	$where_meleti=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$tb_meleti = "user_meletes";
	$select_meleti = $database->select($tb_meleti, $col, $where_meleti);
	$zwni = $select_meleti[0]["zone"];
	$bld_type = $select_meleti[0]["type"];
	
	//Στοιχεία ζώνης
	$tb_zones = "meletes_zones";
	$tb_walls="meletes_zone_adiafani";
	$table_windows="meletes_zone_diafani";
	$tb_zone_dapeda = "meletes_zone_dapeda";
	$tb_zone_orofes = "meletes_zone_orofes";
	$tb_zone_thermo = "meletes_zone_thermo";
	
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$tb_ummax = "vivliothiki_ummax_new";
	if($zwni==0){$col_umax="a";}
	if($zwni==1){$col_umax="b";}
	if($zwni==2){$col_umax="c";}
	if($zwni==3){$col_umax="d";}
	
	$array_thermo_dbs = array(
		0=>"ksg",
		1=>"sg",
		2=>"ss",
		3=>"ds",
		4=>"dp",
		5=>"oe",
		6=>"dy",
		7=>"ed",
		8=>"df",
		9=>"pr",
		10=>"lp",
		11=>"yp"
	);
	
	$bld_ua_adiafani=0;
	$bld_ua_diafani=0;
	$bld_ua_orizontia=0;
	$bld_psi=0;
	$bld_ua=0;
	$bld_a=0;
	$bld_e=0;
	$bld_v=0;
	
	$i=1;	
	
	foreach($select_zones as $zone){
	if($zone_id==0 OR ($zone_id==$zone["id"])){
		$zone_ua_adiafani=0;
		$zone_ua_diafani=0;
		$zone_ua_orizontia=0;
		$zone_ua_psi=0;
		$zone_ua=0;
		
		$where_walls=array(
			"AND"=>array(
				"user_id"=>$_SESSION['user_id'],
				"meleti_id"=>$_SESSION['meleti_id'],
				"zone_id"=>$zone["id"]
			)
		);
		$walls = $database->select($tb_walls, $col, $where_walls );
		$count_walls = $database->count($tb_walls, $where_walls );
		
		if($count_walls>0){
		
		foreach($walls as $wall){
			
			$wall_l = $wall["l"];
			$wall_h = $wall["h"];
			$wall_d = $wall["d"];
			$wall_dy = $wall["dy"];
			$wall_dx = $wall["dx"];
			
			$psi_dok_l = 0;
			$psi_yp_l = 0;
			$psi_syr_l = 0;
			$psi_array = explode("^", $wall["psi"]);
			$psi_array_dap = explode("|", $psi_array[0]);
			$psi_array_or = explode("|", $psi_array[1]);
			$psi_array_dok = explode("|", $psi_array[2]);
			$psi_array_yp = explode("|", $psi_array[3]);
			$psi_array_syr = explode("|", $psi_array[4]);
			
			$tb_thermo_dap = "vivliothiki_thermo_".$array_thermo_dbs[$psi_array_dap[0]];
			$tb_thermo_or = "vivliothiki_thermo_".$array_thermo_dbs[$psi_array_or[0]];
			$tb_thermo_dok = "vivliothiki_thermo_".$array_thermo_dbs[$psi_array_dok[0]];
			$tb_thermo_yp = "vivliothiki_thermo_".$array_thermo_dbs[$psi_array_yp[0]];
			$tb_thermo_syr = "vivliothiki_thermo_".$array_thermo_dbs[$psi_array_syr[0]];
			
			$data_psi_dap = $database->select($tb_thermo_dap,"*",array("id"=>$psi_array_dap[1]) );
			$data_psi_or = $database->select($tb_thermo_or,"*",array("id"=>$psi_array_or[1]) );
			$data_psi_dok = $database->select($tb_thermo_dok,"*",array("id"=>$psi_array_dok[1]) );
			$data_psi_yp = $database->select($tb_thermo_yp,"*",array("id"=>$psi_array_yp[1]) );
			$data_psi_syr = $database->select($tb_thermo_syr,"*",array("id"=>$psi_array_syr[1]) );
			
			$psi_dap_name=$data_psi_dap[0]["name"];
			$psi_dap_y=$data_psi_dap[0]["y"];
			$psi_or_name=$data_psi_or[0]["name"];
			$psi_or_y=$data_psi_or[0]["y"];
			$psi_dok_name=$data_psi_dok[0]["name"];
			$psi_dok_y=$data_psi_dok[0]["y"];
			$psi_yp_name=$data_psi_yp[0]["name"];
			$psi_yp_y=$data_psi_yp[0]["y"];
			$psi_syr_name=$data_psi_syr[0]["name"];
			$psi_syr_y=$data_psi_syr[0]["y"];
			
			//Συντελεστές U - Χρειάζεται διόρθωση
			// u δρομικό
			if($wall["u"]!=0){
				$u=$wall["u"];
			}else{
				$data_u = $database->select("user_adiafani","u",array("id"=>$wall['u_id']) );
				$u=$data_u[0];
			}
			
			// u υποστυλωμάτων
			if($wall["yp_u_id"]!=0){
				$data_yp_u = $database->select("user_adiafani","u",array("id"=>$wall['yp_u_id']) );
				$yp_u=$data_yp_u[0];
			}else{
				$yp_u=$wall["yp_u"];
			}
			
			// u δοκών	
			if($wall["dok_u_id"]!=0){
				$data_dok_u = $database->select("user_adiafani","u",array("id"=>$wall['dok_u_id']) );
				$dok_u=$data_dok_u[0];
			}else{
				$dok_u=$wall["dok_u"];
			}
			
			// u συρομένων	
			if($wall["syr_u_id"]!=0){
				$data_syr_u = $database->select("user_adiafani","u",array("id"=>$wall['syr_u_id']) );
				$syr_u=$data_syr_u[0];
			}else{
				$syr_u=$wall["syr_u"];
			}
			
			if($wall["type"]==0){
				$uis=$u;
				$dok_uis=$dok_u;
				$yp_uis=$yp_u;
				$syr_uis=$syr_u;
			}
			if($wall["type"]==1){
				$b=0.5;
				$uis=$u*$b;
				$dok_uis=$dok_u*$b;
				$yp_uis=$yp_u*$b;
				$syr_uis=$syr_u*$b;
			}
			if($wall["type"]==2){
				$z1=$wall['z1'];
				$z2=$wall['z2'];
				$uis=isodynamos_katakoryfoy($u, $z1, $z2);
				$dok_uis=isodynamos_katakoryfoy($dok_u, $z1, $z2);
				$yp_uis=isodynamos_katakoryfoy($yp_u, $z1, $z2);
				$syr_uis=isodynamos_katakoryfoy($syr_u, $z1, $z2);
			}
			
			//Εμβαδόν σύνολο
			$wall_e_sum = $wall_l*$wall_h + ($wall_l*$wall_dy)/2;
			$bld_a+=$wall_e_sum;
			
			//Φέρων οργανισμός
			$per = $wall["per"];
			if($per==0){
				//Δοκοί	
				$data_dok = explode("^", $wall["dok"]);
				$dok_e_sum = 0;
				$dok_h_sum = 0;
				$dok_ua=0;
					for($doki=1; $doki<=count($data_dok)-1; $doki++){
					$dok = explode("|", $data_dok[$doki-1]);
						$dok_h = $dok[0];
						$dok_ar = $dok[1];
						$dok_e = $dok_h*$wall_l;
						$dok_ua = $dok_uis*$dok_e;
						$dok_e_sum += $dok_e;
						$dok_h_sum += $dok_h;
						$zone_ua_adiafani+=$dok_ua;
						
						$psi_dok_l+=$wall_l*2;
						
					}
				
				//Υποστηλώματα
				$data_yp = explode("^", $wall["yp"]);
				$yp_e_sum = 0;
				$yp_ua=0;
					for($ypi=1; $ypi<=(count($data_yp)-1); $ypi++){
					$yp = explode("|", $data_yp[$ypi-1]);
						$yp_l = $yp[0];
						$yp_h = ($wall_h-$dok_h_sum);
						$yp_e = $yp_l*($wall_h-$dok_h_sum);
						$yp_ua = $yp_uis*$yp_e;
						$yp_e_sum += $yp_e;
						$zone_ua_adiafani+=$yp_ua;
						
						$psi_yp_l+=$yp_h*2;
						$psi_dok_l-=$yp_l*2;
					}
			}
			
			//Συρόμενα
			$data_syr = explode("^", $wall["syr"]);
			$syr_e_sum = 0;
			$syr_ua = 0;
				for($syri=1; $syri<=count($data_syr)-1; $syri++){
				$syr = explode("|", $data_syr[$syri-1]);
					$syr_l = $syr[0];
					$syr_h = $syr[1];
					$syr_e = $syr[0]*$syr[1];
					$syr_ua = $syr_uis*$syr_e;
					$syr_e_sum += $syr_e;
					$zone_ua_adiafani+=$syr_ua;
					
					$psi_syr_l=2*$syr_l + 2*$syr_h;
				}
			
			//με ποσοστό φέρων οργανισμού
			if($per!=0){
				$dok_e_sum=0;
				$dok_ua=0;
				$yp_e_sum=$wall_e_sum*$per/100;
				$yp_ua=$yp_uis*$yp_e_sum;
				$syr_e_sum=0;
				$syr_ua=0;
				$zone_ua_adiafani+=$yp_ua;
				
				$psi_dok_l=0;
				$psi_syr_l=0;
			}
			
			$window_sume=0;
			//Παράθυρα
			$data_window = $database->select($table_windows,"*",array("wall_id"=>$wall['id']) );
			foreach($data_window as $window){
				$window_ua=0;
				$window_w=$window["w"];
				$window_h=$window["h"];
				$window_e=$window["w"]*$window["h"];
				$window_u=$window["u"];
				$window_psi_l = $window["psi_l"];
				$window_psi_a = $window["psi_a"];
				
					if($wall["type"]==0){
						$window_uis=$window_u;
					}
					if($wall["type"]==1){
						$b=0.5;
						$window_uis=$window_u*$b;
					}
					if($wall["type"]==2){
						$b=0.5;
						$window_uis=$window_u*$b;
					}
					$window_ua=$window_uis*$window_e;
					$window_sume += $window_e;			
			
					$data_thermo_l = $database->select("vivliothiki_thermo_lp","*",array("id"=>$window_psi_l) );
					$data_thermo_ak = $database->select("vivliothiki_thermo_yp","*",array("id"=>$window_psi_a) );
					
					$psi_lam_name=$data_thermo_l[0]["name"];
					$psi_lam=$data_thermo_l[0]["y"];
					$psi_anw_name=$data_thermo_ak[0]["name"];
					$psi_anw=$data_thermo_ak[0]["y"];
					
					$psi_lam_l=2*$window_h;
					$psi_anw_l=2*$window_w;
					
					$psi_lampas = $psi_lam_l*$psi_lam;
					$psi_anwkasi = $psi_anw_l*$psi_anw;
					$psi_window = $psi_lampas+$psi_anwkasi;
					
					$zone_ua_psi+=$psi_window;
					
					//Χρειάζεται διόρθωση για τις αδιαφανείς πόρτες
					$zone_ua_diafani+=$window_ua;
			}
			
			//Καθαρό εμβαδόν τοίχου
			$wall_e_adiafanes = $wall_e_sum - $window_sume;//Ο τοίχος χωρίς παράθυρα
			$wall_e = $wall_e_sum - $syr_e_sum - $yp_e_sum - $dok_e_sum - $window_sume;//Ο τοίχος χωρίς φέρων/παράθυρα
			$u_sum = ($wall_e*$u + $syr_e_sum*$syr_u + $yp_e_sum*$yp_u + $dok_e_sum*$dok_u)/$wall_e_adiafanes;//Μέσος συντελεστής
			$wall_ua=$uis*$wall_e;
			$zone_ua_adiafani+=$wall_ua;
			
			//Θερμογέφυρες
			if($wall["type"]==1){
				$psi_b=0.5;
			}else{
				$psi_b=1;
			}
			$psi_dap=$psi_dap_y*$wall_l*$psi_b;
			$psi_or=$psi_or_y*$wall_l*$psi_b;
			$psi_yp=$psi_yp_y*$psi_yp_l*$psi_b;
			$psi_dok=$psi_dok_y*$psi_dok_l*$psi_b;
			$psi_syr=$psi_syr_y*$psi_syr_l*$psi_b;
			$psi_wall=$psi_dap+$psi_or+$psi_yp+$psi_dok+$psi_syr;
			$zone_ua_psi+=$psi_wall;
		}//για κάθε τοίχο
		
		}//Υπάρχουν τοίχοι
		
		//ΔΑΠΕΔΑ ΖΩΝΗΣ
		$where_dapeda=array(
			"AND"=>array(
				"user_id"=>$_SESSION['user_id'],
				"meleti_id"=>$_SESSION['meleti_id'],
				"zone_id"=>$zone["id"]
			)
		);
		$select_zone_dapeda = $database->select($tb_zone_dapeda, $col, $where_dapeda);
		$count_zone_dapeda = $database->count($tb_zone_dapeda, $where_dapeda);
		if($count_zone_dapeda!=0){
			foreach($select_zone_dapeda as $dapeda){
				$dapeda_ua=0;
				if($dapeda["u"]!=0){
					$dapeda_u=$dapeda["u"];
				}else{
					$dapeda_u_data = $database->select("user_adiafani","u",array("id"=>$dapeda["u_id"]) );
					$dapeda_u=$dapeda_u_data[0];
				}
				
				if($dapeda["type"]==2){
					$dapeda_uis=$dapeda_u;
				}
				if($dapeda["type"]==1){
					$b=0.5;
					$dapeda_uis=$dapeda_u*$b;
				}
				if($dapeda["type"]==0){
					$z=$dapeda['z'];
					$xar=2*$dapeda["e"]/$dapeda['p'];
					$dapeda_uis=isodynamos_dapedoy($dapeda_u, $z, $xar);
				}
				
				$dapeda_ua=$dapeda_uis*$dapeda["e"];
				$zone_ua_orizontia+=$dapeda_ua;
				
				$bld_a+=$dapeda["e"];
			}//Για κάθε δάπεδο
			
		}//Υπάρχουν δάπεδα
		
		//ΟΡΟΦΕΣ ΖΩΝΗΣ
		$where_orofes=array(
			"AND"=>array(
				"user_id"=>$_SESSION['user_id'],
				"meleti_id"=>$_SESSION['meleti_id'],
				"zone_id"=>$zone["id"]
			)
		);
		$select_zone_orofes = $database->select($tb_zone_orofes, $col, $where_orofes);
		$count_zone_orofes = $database->count($tb_zone_orofes, $where_orofes);
		if($count_zone_orofes!=0){
			foreach($select_zone_orofes as $orofes){
				$orofes_ua=0;
				if($orofes["u"]!=0){
					$orofes_u=$orofes["u"];
				}else{
					$orofes_u_data = $database->select("user_adiafani","u",array("id"=>$orofes["u_id"]) );
					$orofes_u=$orofes_u_data[0];
				}
				
				if($orofes["type"]==0){
					$b=1;
				}
				if($orofes["type"]==1){
					$b=0.5;
				}
				
				$window_sume=0;
				//Παράθυρα οροφών
				$data_windowor = $database->select($table_windows,"*",array("roof_id"=>$orofes['id']) );
				foreach($data_windowor as $window){
					$window_name=$window["name"];
					$window_w=$window["w"];
					$window_h=$window["h"];
					$window_e=$window["w"]*$window["h"];
					$window_u=$window["u"];
					
					$window_sume+=$window_e;
					
					$window_ub=$window_u*$b;
					$window_ua=$window_ub*$window_e;
					$zone_ua_orizontia+=$window_ua;
					$zone_ua_orizontia_diaf+=$window_ua;
				}//Παράθυρα οροφών
				
				$roof_e=0;
				$roof_e=$orofes["e"]-$window_sume;
				
				$orofes_uis=$orofes_u*$b;
				$orofes_ua=$orofes_uis*$roof_e;
				$zone_ua_orizontia+=$orofes_ua;
				
				$bld_a+=$orofes["e"];
			}//για κάθε οροφή
		}//Υπάρχουν οροφές
		
		//ΘΕΡΜΟΓΕΦΥΡΕΣ ΣΤΟ ΜΕΝΟΥ ΖΩΝΗΣ - ΕΚΤΟΣ ΤΟΙΧΩΝ ΟΡΟΦΩΝ
		$select_zone_thermo = $database->select($tb_zone_thermo, $col, array("zone_id"=>$zone["id"]) );
		$count_zone_thermo = $database->count($tb_zone_thermo, array("zone_id"=>$zone["id"]));
		$zone_yl = 0;
		if($count_zone_thermo!=0){
			foreach($select_zone_thermo as $thermo){
				$vivliothiki_thermo = "vivliothiki_thermo_".$array_thermo_dbs[$thermo["type"]];
				$data_u = $database->select($vivliothiki_thermo,"*",array("id"=>$thermo["u"]) );
				$data_yl = $data_u[0]["y"]*$thermo["n"]*$thermo["h"];
				
				$zone_yl += $data_yl;
			}//για κάθε θερμογέφυρα
		}//έλεγχος μήπως δεν υπάρχει καμία
		$zone_ua_psi+=$zone_yl;
		//ΘΕΡΜΟΓΕΦΥΡΕΣ ΣΤΟ ΜΕΝΟΥ ΖΩΝΗΣ - ΕΚΤΟΣ ΤΟΙΧΩΝ ΟΡΟΦΩΝ
		
		
		$zone_ua=$zone_ua_adiafani+$zone_ua_diafani+$zone_ua_orizontia+$zone_ua_psi;		
		
		$bld_ua_adiafani+=$zone_ua_adiafani;
		$bld_ua_diafani+=$zone_ua_diafani;
		$bld_ua_orizontia+=$zone_ua_orizontia;
		$bld_psi+=$zone_ua_psi;
		$bld_ua+=$zone_ua;
		
		$data_zone_ev=teyxos_zone_ev($zone["id"]);
		$zone_e=$data_zone_ev[0];
		$zone_v=$data_zone_ev[1];
		$bld_e+=$zone_e;
		$bld_v+=$zone_v;
	
		$i++;
	}
	}//για κάθε ζώνη
	
	if($bld_a!=0){
		$bld_um = $bld_ua/$bld_a;
	}else{
		$bld_um = 0;
	}
	if($bld_v!=0){
		$bld_av = $bld_a/$bld_v;
	}else{
		$bld_av = 0;
	}
	$ummax=get_ummax($col_umax, $bld_av, $bld_type);
	
	return array($bld_um,$bld_av,$ummax);
}

//Εύρεση pgen ανά ζώνη
function systems_calc_pgen(){
	$database = new medoo(DB_NAME);
	$col = "*";
	$tb_zones = "meletes_zones";
	$tb_meleti = "user_meletes";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$where_meleti=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	
	$select_meleti = $database->select($tb_meleti, $col, $where_meleti);
	$zwni = $select_meleti[0]["zone"];
	if($zwni==0){$dt=18;}
	if($zwni==1){$dt=20;}
	if($zwni==2){$dt=23;}
	if($zwni==3){$dt=28;}
	
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$array = array();
	
	$i=0;
	foreach($select_zones as $zone){
		$zone_ea=systems_calc_ea($zone["id"]);
		$zone_e=$zone_ea[0];
		$zone_a=$zone_ea[1];
		$zone_ump=systems_calc_um($zone["id"]);
		$zone_um=$zone_ump[0];
		
		$zone_data = $database->select("vivliothiki_conditions_zone","*",array("id"=>$zone["xrisi"]));
		$air=$zone_data[0]["air_perm2"];
		
		$zone_pgen = ( ($zone_a * $zone_um * 1.5) +  ($zone_e*$air)/3 )* $dt /1000;
		
		$array[$i]["name"]=$zone["name"];
		$array[$i]["a"]=round($zone_a,2);
		$array[$i]["e"]=round($zone_e,2);
		$array[$i]["pgen"]=round($zone_pgen,2);
	$i++;
	}
	
	return $array;
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
			$query_aerp["r_h"] = 0;
			$query_aerp["q_r_h"] = 0;
			$query_aerp["f_c"] = $aerp_w;
			$query_aerp["r_c"] = 0;
			$query_aerp["q_r_c"] = 0;
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