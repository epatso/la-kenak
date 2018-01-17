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


if (isset($_GET['getzones'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_zones($page);
	echo $tb;
	exit;
}
if (isset($_GET['deletezone'])){
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = delete_meletes_zonedata($id);
	echo $tb;
	exit;
}

if (isset($_GET['getmthx'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_mthx($page);
	echo $tb;
	exit;
}
if (isset($_GET['deletemthx'])){
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = delete_meletes_mthxdata($id);
	echo $tb;
	exit;
}


if (isset($_GET['getxwroi'])){
	$type = $_GET['type'];
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_xwroi($type,$page);
	echo $tb;
	exit;
}
if (isset($_GET['getthermo'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_thermo($page);
	echo $tb;
	exit;
}


require("include_check.php");
//require("functions_meleti_general.php");

// ##################################################### ΖΩΝΕΣ ###############################################
//Εκτύπωση πίνακα ζωνών
function create_meletes_zones($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zones";
	$col = "*";
	$array_thermo = array(
		80=>"Κατηγορία 1 (80 KJ/m2.K)",
		110=>"Κατηγορία 2 (110 KJ/m2.K)",
		165=>"Κατηγορία 3 (165 KJ/m2.K)",
		230=>"Κατηγορία 4 (230 KJ/m2.K)",
		280=>"Κατηγορία 5 (280 KJ/m2.K)",
		300=>"Κατηγορία 6 (300 KJ/m2.K)"
	);
	$array_auto = array(
		0=>"Τύπος Α",
		1=>"Τύπος Β",
		2=>"Τύπος Γ",
		3=>"Τύπος Δ"
	);
	$array_hotel = array(
		0=>"ΟΧΙ",
		1=>"LUX",
		2=>"Α ή Β",
		3=>"Γ"
	);
	$array_hospital = array(
		0=>"ΟΧΙ",
		1=>"Νοσοκομείο <500 κλίνες",
		2=>"Νοσοκομείο >500 κλίνες",
		3=>"Κλινική"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_zones = $database->select($tb,$col,$where);
	
	
	$count_zones = count($data_zones);
	$total_pages = ceil($count_zones/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_zones<$count_end){$count_end=$count_zones;}
	$new_page=ceil(($count_zones+1)/10);
	
	$zones = "<div class=\"panel panel-solar\">";
	$zones .= "<div class=\"panel-heading\">";
	$zones .= "<button class=\"btn btn-solar\" type=\"button\" onclick=\"form_zone(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέας ΘΖ</button>";
	$zones .= "</div>";
	$zones .= "<div class=\"box-body table-responsive no-padding\">";
	$zones .= "<table class=\"table table-bordered table-hover\">
	<tr class=\"solar\" style=\"vertical-align: middle;text-align:center;\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Χαρακτηριστικό όνομα της ζώνης\">Όνομα</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Χρήση θερμικής ζώνης\">Χρήση</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Κλίνες, κατηγορία ξενοδοχείου ή κλινικής (ΖΝΧ)\">ΖΝΧ</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Ανηγμένη θερμοχωρητικότητα\">Αν. θερμ.</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Διατάξεις αυτόματου ελέγχουΘέρμανσης-Ψύξης\">Αυτομ Θ-Ψ</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Καμινάδες\">Κ</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Θυρίδες εξαερισμού\">Θ</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Εξώθυρες\">Ε</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Ανεμιστήρες οροφής\">Α</a></td>
	<td width=8%><a class=\"tip-top\" href=\"#\" title=\"Αυτόματες διατάξεις ελέγχου ΖΝΧ\">Αυτ. ΖΝΧ</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_zones as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$zones .= "<tr style=\"vertical-align: middle;text-align:center;\">";
		$zones .= "<td><span class=\"label label-solar\">".$i."</span></td>";
		$zones .= "<td>".$data["name"]."</td>";
		
			$data_xrisi = $database->select("vivliothiki_conditions_zone","*",array("id"=>$data["xrisi"]));
		$zones .= "<td>".$data_xrisi[0]["name"]."</td>";
			if($data_xrisi[0]["has_znx"]!=0){
				if($data_xrisi[0]["znx_calc_type"]==0){//Με βάση δομημένη επιφάνεια
					$znx_txt="Από Ε(m<sup>2</sup>)";
				}
				if($data_xrisi[0]["znx_calc_type"]==1){//Με βάση κλίνες
					$znx_txt="Κλίνες: ".$data["klines"];
				}
				if($data_xrisi[0]["znx_calc_type"]==2){//Με βάση κλίνες και τύπο ξενοδοχείου
					$znx_txt="Κλίνες: ".$data["klines"]." , Ξενοδοχείο κατηγορίας: ".$array_hotel[$data["hotel"]];
				}
				if($data_xrisi[0]["znx_calc_type"]==3){//Με βάση κλίνες και τύπο κλινικής
					$znx_txt="Κλίνες: ".$data["klines"]." , Τύπος νοσοκομείου: ".$array_hospital[$data["hospital"]];
				}
			}else{
				$znx_txt="Όχι";
			}
		$zones .= "<td>".$znx_txt."</td>";
		$zones .= "<td>".$array_thermo[$data["thermo"]]."</td>";
		$zones .= "<td>".$array_auto[$data["auto_heat"]]." - ".$array_auto[$data["auto_cold"]]."</td>";
		$zones .= "<td>".$data["kaminades"]."</td>";
		$zones .= "<td>".$data["thyrides"]."</td>";
		$zones .= "<td>".$data["ekswthyres"]."</td>";
		$zones .= "<td>".$data["anemistires"]."</td>";
			if($data["auto_znx"]==0){$auto_znx="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["auto_znx"]==1){$auto_znx="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$zones .= "<td>".$auto_znx."</td>";
		$zones .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_zone(".$data["id"].",".$page.");\"><span class=\"fa fa-pencil-square-o\"></span></button></td>";
		$zones .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_zone(".$data["id"].",".$page.");\"><span class=\"fa fa-times\"></span></button></td>";
		$zones .= "</tr>";
		}
	$i++;
	}
	$zones .= "</table></div>";
	$zones .= "<div class=\"panel-footer\">";
	
	if($count_zones!=0){
		$zones .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_zones." θερμικών ζωνών.";
	}else{
		$zones .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$zones .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_zones(".$previous_page.")\"";}
	$zones .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$zones .= "<li".$disabled."><a href=\"#\" onclick=\"get_zones(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_zones(".$next_page.")\"";}
	$zones .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$zones .= "</ul></div></div>";
	
	return $zones;	
}

//Διαγραφή ζώνης
function delete_meletes_zonedata($id){
	
	$database = new medoo(DB_NAME);
	$table = "meletes_zones";
	$where_user=array("AND"=>array("id"=>$id,"user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_inuser = $database->select($table,$columns,$where_user);
	
	if(count($data_inuser)!=0){
		$where_id = array("id"=>$id);
		$data_table = $database->delete($table,$where_id);
		return "<div class=\"alert alert-error\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				Επιτυχής διαγραφή της ζώνης</div>";
	}
}


// ##################################################### ΜΘΧ ###############################################
//Εκτύπωση πίνακα ΜΘΧ
function create_meletes_mthx($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_mthx";
	$col = "*";
	$array_type = array(
		0=>"ΜΘΧ",
		1=>"Ηλιακός χώρος"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_mthx = $database->select($tb,$col,$where);
	
	
	$count_mthx = count($data_mthx);
	$total_pages = ceil($count_mthx/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_mthx<$count_end){$count_end=$count_mthx;}
	$new_page=ceil(($count_mthx+1)/10);
	
	$mthx = "<div class=\"panel panel-znx\">";
	$mthx .= "<div class=\"panel-heading\">";
	$mthx .= "<button class=\"btn btn-znx\" type=\"button\" onclick=\"form_mthx(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέου ΜΘΧ/Ηλιακού χώρου</button>";
	$mthx .= "</div>";
	$mthx .= "<div class=\"box-body table-responsive no-padding\">";
	$mthx .= "<table class=\"table table-bordered table-hover\">
	<tr class=\"znx\">
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=25%><a class=\"tip-top\" href=\"#\" title=\"Είδος του χώρου\">Είδος</a></td>
	<td width=60%><a class=\"tip-top\" href=\"#\" title=\"Χαρακτηριστικό όνομα του χώρου\">Όνομα</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_mthx as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$mthx .= "<tr>";
		$mthx .= "<td><span class=\"label label-info\">".$i."</span></td>";
		$mthx .= "<td>".$array_type[$data["type"]]."</td>";
		$mthx .= "<td>".$data["name"]."</td>";
		$mthx .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_mthx(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$mthx .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_mthx(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$mthx .= "</tr>";
		}
	$i++;
	}
	$mthx .= "</table></div>";
	$mthx .= "<div class=\"panel-footer\">";
	
	if($count_mthx!=0){
		$mthx .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_mthx." ΜΘΧ/Ηλιακών χώρων.";
	}else{
		$mthx .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$mthx .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_mthx(".$previous_page.")\"";}
	$mthx .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$mthx .= "<li".$disabled."><a href=\"#\" onclick=\"get_mthx(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_mthx(".$next_page.")\"";}
	$mthx .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$mthx .= "</ul></div></div>";
	
	return $mthx;	
}

//Διαγραφή ΜΘΧ
function delete_meletes_mthxdata($id){
	
	$database = new medoo(DB_NAME);
	$table = "meletes_mthx";
	$where_user=array("AND"=>array("id"=>$id,"user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_inuser = $database->select($table,$columns,$where_user);
	
	if(count($data_inuser)!=0){
		$where_id = array("id"=>$id);
		$data_table = $database->delete($table,$where_id);
		return "<div class=\"alert alert-error\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				Επιτυχής διαγραφή του ΜΘΧ/Ηλιακού χώρου</div>";
	}
}


// ##################################################### ΧΩΡΟΙ ###############################################
//Εκτύπωση πίνακα χώρων θερμικών ζωνών
function create_meletes_xwroi($type,$page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_xwroi";
	$col = "*";
	
		if($type==0){
			$table_zone="meletes_zones";
			$column_zone="zone_id";
			$button_text=" Προσθήκη νέου χώρου ΘΖ";
			$table_th="<td width=20%><a href=\"#\" title=\"Ζώνη που ανήκει ο χώρος\">Ζώνη</a></td>";
			$table_caption="<caption>Εμβαδά / Όγκος θερμικών ζωνών</caption>";
			$class="solar";
		}
		if($type==1){
			$table_zone="meletes_mthx";
			$column_zone="mthx_id";
			$button_text=" Προσθήκη νέου χώρου ΜΘΧ/Ηλιακού";
			$table_th="<td width=20%><a href=\"#\" title=\"ΜΘΧ/Ηλιακός χώρος που ανήκει ο χώρος\">ΜΘΧ/Ηλιακός χώρος</a></td>";
			$table_caption="<caption>Εμβαδά / Όγκος ΜΘΧ/Ηλιακών χώρων</caption>";
			$class="znx";
		}
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],$column_zone."[!]"=>0));
	$data_xwroi = $database->select($tb,$col,$where);
	
	$count_xwroi = count($data_xwroi);
	$total_pages = ceil($count_xwroi/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_xwroi<$count_end){$count_end=$count_xwroi;}
	$new_page=ceil(($count_xwroi+1)/10);
	
	$button_new="<button class=\"btn btn-".$class."\" type=\"button\" onclick=\"form_xwroi(".$type.",0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i>".$button_text."</button>";
	
	$xwroi = "<div class=\"panel panel-".$class."\">";
	$xwroi .= "<div class=\"panel-heading\">";
	$xwroi .= $button_new;
	$xwroi .= "</div>";
	$xwroi .= "<div class=\"box-body table-responsive no-padding\">";
	$xwroi .= "<table class=\"table table-bordered table-hover\">";
	$xwroi .= "<tr class=\"".$class."\">
	<td width=10%><a href=\"#\" title=\"Αρίθμηση\">α/α</a></td>";
	$xwroi .= $table_th;
	$xwroi .= "<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Όνομα χώρου (πχ ισόγειο)\">Όνομα</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Μήκος χώρου\">Μήκος</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Πλάτος χώρου\">Πλάτος</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Ύψος χώρου\">Ύψος</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Τύπος\">Τύπος-Μέτρηση</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_xwroi as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$xwroi .= "<tr>";
		$xwroi .= "<td><span class=\"label label-info\">".$i."</span></td>";
		
			$data_zone = $database->select($table_zone,"name",array("id"=>$data[$column_zone]));
			
		$xwroi .= "<td>".$data_zone[0]."</td>";
		$xwroi .= "<td>".$data["name"]."</td>";	
		$xwroi .= "<td>".$data["l"]."</td>";
		$xwroi .= "<td>".$data["w"]."</td>";
		$xwroi .= "<td>".$data["h"]."</td>";
			
			if($data["type"]==0){
				$xwros_e=$data["l"]*$data["w"];
				$xwros_v=$xwros_e*$data["h"];
				$xwros_type="Τυπικός-Ε=".$xwros_e.",V=".$xwros_v;
			}else{
				$xwros_v=(1/6)*$data["w"]*$data["h"]*(2*$data["w"]+3*($data["l"]-$data["w"]));
				$xwros_type="4κλινής στέγη,V=".$xwros_v;
			}
		$xwroi .= "<td>".$xwros_type."</td>";
		$xwroi .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_xwroi(".$type.",".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$xwroi .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_xwroi(".$type.",".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$xwroi .= "</tr>";
		}
	$i++;
	}
	$xwroi .= "</table></div>";
	$xwroi .= "<div class=\"panel-footer\">";
	
	if($count_xwroi!=0){
		$xwroi .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_xwroi." χώρων.";
	}else{
		$xwroi .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$xwroi .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_xwroi(".$type.",".$previous_page.")\"";}
	$xwroi .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$xwroi .= "<li".$disabled."><a href=\"#\" onclick=\"get_xwroi(".$type.",".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_xwroi(".$type.",".$next_page.")\"";}
	$xwroi .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$xwroi .= "</ul></div></div>";
	
	return $xwroi;	
}


// ##################################################### ΘΕΡΜΟΓΕΦΥΡΕΣ ###############################################
//Εκτύπωση πίνακα ΘΕΡΜΟΓΕΦΥΡΑΣ
function create_meletes_thermo($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_thermo";
	$col = "*";
	$array_type = array(
		0=>"ΞΓ",
		1=>"ΣΓ",
		2=>"ΣΣ",
		3=>"ΔΣ",
		4=>"ΔΠ",
		5=>"ΟΕ",
		6=>"ΔΥ",
		7=>"ΕΔ",
		8=>"ΔΦ",
		9=>"ΠΡ",
		10=>"ΛΠ",
		11=>"ΥΠ"
	);
	$array_dbs = array(
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
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_thermo = $database->select($tb,$col,$where);
	
	
	$count_thermo = count($data_thermo);
	$total_pages = ceil($count_thermo/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_thermo<$count_end){$count_end=$count_thermo;}
	$new_page=ceil(($count_thermo+1)/10);
	
	$thermo = "<div class=\"panel panel-solar\">";
	$thermo .= "<div class=\"panel-heading\">";
	$thermo .= "<button class=\"btn btn-solar\" type=\"button\" onclick=\"form_thermo(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέας θερμογέφυρας</button>";
	$thermo .= "</div>";
	$thermo .= "<div class=\"box-body table-responsive no-padding\">";
	$thermo .= "<table class=\"table table-bordered table-hover\">
	<tr class=\"solar\">
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει η θερμογέφυρα\">Ζώνη</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Τύπος θερμογέφυρας\">Τύπος</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Είδος/συντελεστής ανάλογα με το είδος της θερμογέφυρας\">Είδος/ψ</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Πλήθος θερμογεφυρών\">Πλήθος</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Διάσταση της κάθε θερμογέφυρας\">Διάσταση</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Σχηματική αναπαράσταση από την ΤΟΤΕΕ\">Εικ.</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_thermo as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$thermo .= "<tr>";
		$thermo .= "<td><span class=\"label label-info\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$thermo .= "<td>".$data_zone[0]."</td>";
		$thermo .= "<td>".$array_type[$data["type"]]."</td>";
			
			$tb_thermo = "vivliothiki_thermo_".$array_dbs[$data["type"]];
			$data_u = $database->select($tb_thermo,"name",array("id"=>$data['u']) );
		
		$thermo .= "<td>".$data_u[0]."</td>";
		$thermo .= "<td>".$data["n"]."</td>";
		$thermo .= "<td>".$data["h"]."</td>";
		$thermo .= "<td><img width=\"48\" height=\"48\" src=\"images/thermo/".$array_dbs[$data["type"]]."/".$array_dbs[$data["type"]].$data['u'].".jpg\"></td>";
		$thermo .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_thermo(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$thermo .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_thermo(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$thermo .= "</tr>";
		}
	$i++;
	}
	$thermo .= "</table></div>";
	$thermo .= "<div class=\"panel-footer\">";
	
	if($count_thermo!=0){
		$thermo .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_thermo." θερμογεφυρών.";
	}else{
		$thermo .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$thermo .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_thermo(".$previous_page.")\"";}
	$thermo .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$thermo .= "<li".$disabled."><a href=\"#\" onclick=\"get_thermo(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_thermo(".$next_page.")\"";}
	$thermo .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$thermo .= "</ul></div></div>";
	
	return $thermo;	
}



?>