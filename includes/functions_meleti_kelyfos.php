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

//Ζώνες
if (isset($_GET['getzonedapeda'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_zone_dapeda($page);
	echo $tb;
	exit;
}
if (isset($_GET['getzoneorofes'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_zone_orofes($page);
	echo $tb;
	exit;
}
if (isset($_GET['getzoneadiafani'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_zone_adiafani($page);
	echo $tb;
	exit;
}
if (isset($_GET['getzonediafani'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_zone_diafani($page);
	echo $tb;
	exit;
}

//ΜΘΧ
if (isset($_GET['getmthxdapeda'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_mthx_dapeda($page);
	echo $tb;
	exit;
}
if (isset($_GET['getmthxorofes'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_mthx_orofes($page);
	echo $tb;
	exit;
}
if (isset($_GET['getmthxadiafani'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_mthx_adiafani($page);
	echo $tb;
	exit;
}
if (isset($_GET['getmthxdiafani'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_mthx_diafani($page);
	echo $tb;
	exit;
}

require("include_check.php");
//require("functions_meleti_general.php");

// ######################################### ΚΕΛΥΦΟΣ ΘΕΡΜΙΚΗΣ ΖΩΝΗΣ ###########################################
// ##################################################### ΔΑΠΕΔΑ ###############################################
//Εκτύπωση πίνακα ΔΑΠΕΔΑ ΘΖ
function create_meletes_zone_dapeda($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_dapeda";
	$col = "*";
	$array_type = array(
		0=>"Επί εδάφους",
		1=>"Σε ΜΘΧ/Ηλιακό χώρο (διαχ. επιφάνεια)",
		2=>"Σε αέρα (πυλωτή)"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_kelyfos = $database->select($tb,$col,$where);
	
	
	$count_kelyfos = count($data_kelyfos);
	$total_pages = ceil($count_kelyfos/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_kelyfos<$count_end){$count_end=$count_kelyfos;}
	$new_page=ceil(($count_kelyfos+1)/10);
	
	$kelyfos = "<div class=\"panel panel-solar\">";
	$kelyfos .= "<div class=\"panel-heading\">";
	$kelyfos .= "<button class=\"btn btn-solar\" type=\"button\" onclick=\"form_zone_dapeda(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέου δαπέδου ΘΖ</button>";
	$kelyfos .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-eye-open\"></span> Θερμική ζώνη</h6></div></div>";
	$kelyfos .= "<div class=\"box-body table-responsive no-padding\">";
	$kelyfos .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"solar\" style=\"vertical-align: middle;text-align:center;\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει το δάπεδο\">Ζώνη</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Τύπος επαφής δαπέδου - ΜΘΧ/Ηλιακός χώρος επαφής\">Επαφή</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα\">Όνομα</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Εμβαδόν\">E</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Συντελεστής θερμοπερατότητας\">U</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Απορροφητικότητα α/Συντελεστής εκπομπής ε\">α/ε</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Επιλογές επαφής (ανάλογα με την επαφή του δαπέδου)\">z / F</a></td>";
	$kelyfos .= "
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" a href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_kelyfos as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$kelyfos .= "<tr style=\"vertical-align: middle;text-align:center;\">";
		$kelyfos .= "<td><span class=\"label label-solar\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$kelyfos .= "<td>".$data_zone[0]."</td>";
			
			if($data['mthx_id']!=0){
				$data_mthx = $database->select("meletes_mthx","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['mthx_id'])) );
				$mthx=" με το χώρο: ".$data_mthx[0];
			}else{
				$mthx="";
			}
		$kelyfos .= "<td>".$array_type[$data["type"]].$mthx."</td>";
		$kelyfos .= "<td>".$data["name"]."</td>";
		$kelyfos .= "<td>".$data["e"]."</td>";
		
			if($data['u_id']!=0){
				$data_u = $database->select("user_adiafani",array("name","u"),array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$data['u_id'])) );
				$u="(".$data_u[0]["name"].") ".$data_u[0]["u"];
			}else{
				$u=$data["u"];
			}
		$kelyfos .= "<td>".$u."</td>";
			$data_ap = $database->select("vivliothiki_adiafani_a","a",array("id"=>$data['ap']) );
			$ap=$data_ap[0];
			$data_ek = $database->select("vivliothiki_adiafani_e","e",array("id"=>$data['ek']) );
			$ek=$data_ek[0];
		$kelyfos .= "<td>α:".$ap."/ε:".$ek."</td>";
			if($data["type"]==0){
				$prostheta = "z:".$data["z"]."<br/>"."Π:".$data["p"];
			}else{
				$prostheta = "Fhor_h:".$data["fhor_h"]."<br/>"."Fhor_c:".$data["fhor_c"]."<br/>".
						 "Fov_h:".$data["fov_h"]."<br/>"."Fov_c:".$data["fov_c"]."<br/>".
						 "Ffin_h:".$data["ffin_h"]."<br/>"."Ffin_c:".$data["ffin_c"];
			}
		$kelyfos .= "<td><a href=\"#\" class=\"tip-top\" title=\"".$prostheta."\" data-content=\"".$prostheta."\"><i class=\"fa fa-list-alt fa-2x\" aria-hidden=\"true\"></i></a></td>";
		$kelyfos .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_zone_dapeda(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$kelyfos .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_zone_dapeda(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$kelyfos .= "</tr>";
		}
	$i++;
	}
	$kelyfos .= "</table></div><div class=\"panel-footer\">";
	
	if($count_kelyfos!=0){
		$kelyfos .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_kelyfos." δαπέδων ΘΖ.";
	}else{
		$kelyfos .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$kelyfos .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_zone_dapeda(".$previous_page.")\"";}
	$kelyfos .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$kelyfos .= "<li".$disabled."><a href=\"#\" onclick=\"get_zone_dapeda(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_zone_dapeda(".$next_page.")\"";}
	$kelyfos .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$kelyfos .= "</ul></div></div>";
	
	return $kelyfos;	
}

// ##################################################### ΟΡΟΦΕΣ ###############################################
//Εκτύπωση πίνακα ΟΡΟΦΕΣ ΘΖ
function create_meletes_zone_orofes($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_orofes";
	$col = "*";
	$array_type = array(
		0=>"Σε αέρα",
		1=>"Σε ΜΘΧ/Ηλιακό χώρο (διαχ. επιφάνεια)"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_kelyfos = $database->select($tb,$col,$where);
	
	
	$count_kelyfos = count($data_kelyfos);
	$total_pages = ceil($count_kelyfos/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_kelyfos<$count_end){$count_end=$count_kelyfos;}
	$new_page=ceil(($count_kelyfos+1)/10);
	
	$kelyfos = "<div class=\"panel panel-solar\">";
	$kelyfos .= "<div class=\"panel-heading\">";
	$kelyfos .= "<button class=\"btn btn-solar\" type=\"button\" onclick=\"form_zone_orofes(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέας οροφής ΘΖ</button>";
	$kelyfos .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-eye-open\"></span> Θερμική ζώνη</h6></div></div>";
	$kelyfos .= "<div class=\"box-body table-responsive no-padding\">";
	$kelyfos .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"solar\" style=\"vertical-align: middle;text-align:center;\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει η οροφή\">Ζώνη</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Τύπος επαφής οροφής - ΜΘΧ/Ηλιακός χώρος επαφής\">Τύπος επαφής</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Όνομα\">Όνομα</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Προσανατολισμός / Κλίση\">γ/β</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Εμβαδόν\">E</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Συντελεστής θερμοπερατότητας\">U</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Απορροφητικότητα α/Συντελεστής εκπομπής ε\">α/ε</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Επιλογές επαφής (συντελεστές σκίασης)\">F</a></td>";
	$kelyfos .= "
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_kelyfos as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$kelyfos .= "<tr style=\"vertical-align: middle;text-align:center;\">";
		$kelyfos .= "<td><span class=\"label label-solar\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$kelyfos .= "<td>".$data_zone[0]."</td>";
			
			if($data['mthx_id']!=0){
				$data_mthx = $database->select("meletes_mthx","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['mthx_id'])) );
				$mthx=" με το χώρο: ".$data_mthx[0];
			}else{
				$mthx="";
			}
		$kelyfos .= "<td>".$array_type[$data["type"]].$mthx."</td>";	
		$kelyfos .= "<td>".$data["name"]."</td>";
		$kelyfos .= "<td>".$data["g"]."/".$data["b"]."</td>";
		$kelyfos .= "<td>".$data["e"]."</td>";
		
			if($data['u_id']!=0){
				$data_u = $database->select("user_adiafani",array("name","u"),array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$data['u_id'])) );
				$u="(".$data_u[0]["name"].") ".$data_u[0]["u"];
			}else{
				$u=$data["u"];
			}
		$kelyfos .= "<td>".$u."</td>";
			$data_ap = $database->select("vivliothiki_adiafani_a","a",array("id"=>$data['ap']) );
			$ap=$data_ap[0];
			$data_ek = $database->select("vivliothiki_adiafani_e","e",array("id"=>$data['ek']) );
			$ek=$data_ek[0];
		$kelyfos .= "<td>".$ap." / ".$ek."</td>";
		$prostheta = "Fhor_h:".$data["fhor_h"]."<br/>"."Fhor_c:".$data["fhor_c"]."<br/>".
					"Fov_h:".$data["fov_h"]."<br/>"."Fov_c:".$data["fov_c"]."<br/>".
					"Ffin_h:".$data["ffin_h"]."<br/>"."Ffin_c:".$data["ffin_c"];
		$kelyfos .= "<td><a href=\"#\" class=\"tip-top\" title=\"".$prostheta."\" data-content=\"".$prostheta."\"><i class=\"fa fa-list-alt fa-2x\" aria-hidden=\"true\"></i></a></td>";
		$kelyfos .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_zone_orofes(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$kelyfos .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_zone_orofes(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$kelyfos .= "</tr>";
		}
	$i++;
	}
	$kelyfos .= "</table></div><div class=\"panel-footer\">";
	
	if($count_kelyfos!=0){
		$kelyfos .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_kelyfos." οροφών ΘΖ.";
	}else{
		$kelyfos .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$kelyfos .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_zone_orofes(".$previous_page.")\"";}
	$kelyfos .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$kelyfos .= "<li".$disabled."><a href=\"#\" onclick=\"get_zone_orofes(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_zone_orofes(".$next_page.")\"";}
	$kelyfos .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$kelyfos .= "</ul></div></div>";
	
	return $kelyfos;	
}

// ##################################################### ΑΔΙΑΦΑΝΗ ###############################################
//Εκτύπωση πίνακα ΑΔΙΑΦΑΝΗ ΘΖ
function create_meletes_zone_adiafani($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_adiafani";
	$col = "*";
	$array_g = array(
		1=>"Β<img src=\"images/interface/arrows/up.png\">",
		2=>"Α<img src=\"images/interface/arrows/right.png\">",
		3=>"Ν<img src=\"images/interface/arrows/down.png\">",
		4=>"Δ<img src=\"images/interface/arrows/left.png\">"
	);
	$array_type = array(
		0=>"Σε αέρα",
		1=>"Σε ΜΘΧ/Ηλιακό χώρο (διαχ. επιφάνεια)",
		2=>"Σε έδαφος",
		3=>"Μεσοτοιχία"
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
	$array_thermo = array(
		0=>"ΔΑΠ:",
		1=>"ΟΡ:",
		2=>"ΥΠ:",
		3=>"ΔΟΚ:",
		4=>"ΣΥΡ:"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_kelyfos = $database->select($tb,$col,$where);
	
	
	$count_kelyfos = count($data_kelyfos);
	$total_pages = ceil($count_kelyfos/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_kelyfos<$count_end){$count_end=$count_kelyfos;}
	$new_page=ceil(($count_kelyfos+1)/10);
	
	$kelyfos = "<div class=\"panel panel-solar\">";
	$kelyfos .= "<div class=\"panel-heading\">";
	$kelyfos .= "<button class=\"btn btn-solar\" type=\"button\" onclick=\"form_zone_adiafani(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέου τοίχου ΘΖ</button>";
	$kelyfos .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-eye-open\"></span> Θερμική ζώνη</h6></div></div>";
	$kelyfos .= "<div class=\"box-body table-responsive no-padding\">";
	$kelyfos .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"solar\" style=\"vertical-align: middle;text-align:center;\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει ο τοίχος\">Ζώνη</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα τοιχοποιίας (περιγραφή)\">Όνομα</a></td>
	<td width=9%><a class=\"tip-top\" href=\"#\" title=\"Προσανατολισμός ως προς το Βορρά/Κλίση ως προς την κατακόρυφο\">γ/β</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Τύπος επαφής τοίχου - ΜΘΧ/Ηλιακός χώρος επαφής\">Επαφή</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Μήκος (l)/Ύψος (h)/Πάχος (d)\">Διαστ.</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Συντελεστής θερμοπερατότητας <br/> Δρομικό/Υποστύλωμα<br/> Δοκός/Με διάκενο\">U</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Απορροφητικότητα α / Συντελεστής εκπομπής ε\">α/ε</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Φέρων οργανισμός / Συρόμενα στοιχεία με διάκενο\">Φ-Σ</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Σκιάσεις\">F</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Θερμογέφυρες\">Ψ</a></td>";
	$kelyfos .= "
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	
	$i=1;
	foreach($data_kelyfos as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$kelyfos .= "<tr style=\"vertical-align: middle;text-align:center;\">";
		$kelyfos .= "<td><span class=\"label label-solar\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
		
		$kelyfos .= "<td>".$data_zone[0]."</td>";
		$kelyfos .= "<td>".$data["name"]." - <i class=\"fa fa-picture-o\" aria-hidden=\"true\" onclick=zone_adiafani_showimg(".$data["id"].");></i></td>";
			if($data["g_type"]==0){
				$g=$data["g"];
			}else{
				$g=$array_g[$data["g_type"]];
			}
		$kelyfos .= "<td>".$g." / ".$data["b"]."</td>";
			
			if($data['mthx_id']!=0){
				$data_mthx = $database->select("meletes_mthx","*",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['mthx_id'])) );
					if($data_mthx[0]["type"]==0){
						$mthx_type = "ΜΘΧ";
					}else{
						$mthx_type = "Ηλιακό";
					}
				$mthx="Σε ".$mthx_type." : ".$data_mthx[0]["name"];
			}else{
				$mthx=$array_type[$data["type"]];
			}
		$kelyfos .= "<td>".$mthx."</td>";
		$kelyfos .= "<td>
		<i class=\"fa fa-arrows-h\" aria-hidden=\"true\"></i>: ".number_format($data["l"],2).
		" <i class=\"fa fa-arrows-v\" aria-hidden=\"true\"></i>: ".number_format($data["h"],2).
		" <i class=\"fa fa-eraser\" aria-hidden=\"true\"></i>: ".number_format($data["d"],2)."</td>";
		
		$u = "";
			if($data['u_id']!=0){
				$data_u = $database->select("user_adiafani","u",array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$data['u_id'])) );
				$u.="<i class=\"fa fa-square-o\" aria-hidden=\"true\"></i>: ".number_format($data_u[0],2)."-";
			}else{
				$u.="<i class=\"fa fa-square-o\" aria-hidden=\"true\"></i>: ".number_format($data["u"],2)."-";
			}
			if($data['yp_u_id']!=0){
				$data_u = $database->select("user_adiafani","u",array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$data['yp_u_id'])) );
				$u.="<i class=\"fa fa-square\" aria-hidden=\"true\"></i>: ".number_format($data_u[0],2)."-";
			}else{
				$u.="<i class=\"fa fa-square\" aria-hidden=\"true\"></i>: ".number_format($data["yp_u"],2)."-";
			}
			if($data['dok_u_id']!=0){
				$data_u = $database->select("user_adiafani","u",array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$data['dok_u_id'])) );
				$u.="<i class=\"fa fa-minus-square\" aria-hidden=\"true\"></i>: ".number_format($data_u[0],2)."-";
			}else{
				$u.="<i class=\"fa fa-minus-square\" aria-hidden=\"true\"></i>: ".number_format($data["dok_u"],2)."-";
			}
			if($data['syr_u_id']!=0){
				$data_u = $database->select("user_adiafani","u",array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$data['syr_u_id'])) );
				$u.="<i class=\"fa fa-dot-circle-o\" aria-hidden=\"true\"></i>: ".number_format($data_u[0],2)."-";
			}else{
				$u.="<i class=\"fa fa-dot-circle-o\" aria-hidden=\"true\"></i>: ".number_format($data["syr_u"],2)."-";
			}
		$kelyfos .= "<td>".$u."</td>";
		
			$data_ap = $database->select("vivliothiki_adiafani_a","a",array("id"=>$data['ap']) );
			$ap=$data_ap[0];
			$data_ek = $database->select("vivliothiki_adiafani_e","e",array("id"=>$data['ek']) );
			$ek=$data_ek[0];
		$kelyfos .= "<td>".$ap."/".$ek."</td>";
			if($data["yp"]!=0){
				$yp = explode("^", $data["yp"]);
				$count_yp = count($yp)-1;
			}else{
				$count_yp = "-";
			}
			if($data["dok"]!=0){
				$dok = explode("^", $data["dok"]);
				$count_dok = count($dok)-1;
			}else{
				$count_dok = "-";
			}
			if($data["syr"]!=0){
				$syr = explode("^", $data["syr"]);
				$count_syr = count($syr)-1;
			}else{
				$count_syr = "-";
			}
			$ferwn_txt="Υπ:".$count_yp."<br/>Δοκ:".$count_dok."<br/>Συρ:".$count_syr;
		$kelyfos .= "<td>".$data["per"]."% / <a href=\"#\" class=\"tip-top\" title=\"".$ferwn_txt."\"><i class=\"fa fa-columns\" aria-hidden=\"true\"></i></a></td>";
		
			$f_type = $data["f_type"];
			$fhor = explode("|",$data["fhor"]);
			$fov = $data["fov"];
			$fovt = explode("|",$data["fovt"]);
			$ffin_l = explode("|",$data["ffin_l"]);
			$ffin_r = explode("|",$data["ffin_r"]);
			$fsh = explode("|",$data["fsh"]);
			$f_txt = "";
			
			if($f_type==0){
				if($fhor[1]!=0){
				$f_txt .= "F<sub>hor</sub>";
				}
				if($fov!=0){
				$f_txt .= ",F<sub>ov</sub>";
				}
				if($fovt[0]!=0){
				$f_txt .= ",F<sub>ovt</sub>";
				}
				if($ffin_l[1]!=0){
				$f_txt .= ",F<sub>fin_l</sub>";
				}
				if($ffin_r[1]!=0){
				$f_txt .= ",F<sub>fin_r</sub>";
				}
				if($fsh[1]!=0){
				$f_txt .= ",F<sub>fsh</sub>";
				}
			}else{
				if($f_type==1){
					$f_txt .= "Ολική";
				}
				if($f_type==2){
					$f_txt .= "Ασκίαστος";
				}
				if($f_type==3){
					$f_txt .= "U<0.6";
				}
				
			}
			
		$kelyfos .= "<td>".$f_txt."</td>";
		
		$psi_array = explode("^", $data["psi"]);
		$thermo_txt = "";
			for($z=0;$z<=4;$z++){
			$psi_values = explode("|", $psi_array[$z]);
			$tb_thermo = "vivliothiki_thermo_".$array_dbs[$psi_values[0]];
			$data_thermo = $database->select($tb_thermo,"name",array("id"=>$psi_values[1]) );
			
			$thermo_txt .= $array_thermo[$z].$data_thermo[0]."<br/>";
			}
		$kelyfos .= "<td><a href=\"#\" class=\"tip-top\" title=\"".$thermo_txt."\" data-content=\"".$thermo_txt."\"><i class=\"fa fa-list-alt fa-2x\" aria-hidden=\"true\"></i></a></td>";
		
		$kelyfos .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_zone_adiafani(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$kelyfos .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_zone_adiafani(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$kelyfos .= "</tr>";
		}
	$i++;
	}
	$kelyfos .= "</table></div><div class=\"panel-footer\">";
	
	if($count_kelyfos!=0){
		$kelyfos .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_kelyfos." αδιαφανών ΘΖ.";
	}else{
		$kelyfos .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$kelyfos .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_zone_adiafani(".$previous_page.")\"";}
	$kelyfos .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$kelyfos .= "<li".$disabled."><a href=\"#\" onclick=\"get_zone_adiafani(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_zone_adiafani(".$next_page.")\"";}
	$kelyfos .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$kelyfos .= "</ul></div></div>";
	
	return $kelyfos;	
}

// ##################################################### ΔΙΑΦΑΝΗ ###############################################
//Εκτύπωση πίνακα ΔΙΑΦΑΝΗ ΘΖ
function create_meletes_zone_diafani($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_diafani";
	$col = "*";
	$array_g = array(
		1=>"Β<img src=\"images/interface/arrows/up.png\">",
		2=>"Α<img src=\"images/interface/arrows/right.png\">",
		3=>"Ν<img src=\"images/interface/arrows/down.png\">",
		4=>"Δ<img src=\"images/interface/arrows/left.png\">"
	);
	$array_type = array(
		0=>"Αδιαφανής πόρτα",
		1=>"Ανοιγόμενο παράθυρο",
		2=>"Ανοιγόμενη πόρτα μονή",
		3=>"Ανοιγόμενη πόρτα διπλή",
		4=>"Συρόμενο παράθυρο μονό",
		5=>"Συρόμενο παράθυρο διπλό",
		6=>"Συρόμενη πόρτα μονή",
		7=>"Συρόμενη πόρτα διπλή",
		8=>"Επάλληλη πόρτα",
		9=>"Μη ανοιγόμενο κούφωμα",
		10=>"Υαλότουβλα"
	);
	$array_plaisio = array(
		1=>"Μεταλλικό πλαίσιο χωρίς θερμο",
		2=>"Μεταλλικό πλαίσιο με θερμο 12mm",
		3=>"Μεταλλικό πλαίσιο με θερμο 24mm",
		4=>"Συνθετικό πλαίσιο",
		5=>"Ξύλινο πλαίσιο",
		6=>"Διπλό παράθυρο (ξύλινο)",
		7=>"Μεταλλική πόρτα",
		8=>"Συνθετική πόρτα",
		9=>"Ξύλινη πόρτα"
	);
	
	$array_yalo = array(
		1=>"Χωρίς υαλοπίνακα σε αέρα",
		2=>"Χωρίς υαλοπίνακα σε ΜΘΧ",
		3=>"Μονός",
		3=>"Δίδυμος υαλοπίνακας με διάκενο αέρα 6mm",
		3=>"Δίδυμος υαλοπίνακας με διάκενο αέρα 12mm",
		3=>"Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 6mm",
		3=>"Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 12mm",
		3=>"Μονός",
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_kelyfos = $database->select($tb,$col,$where);
	
	
	$count_kelyfos = count($data_kelyfos);
	$total_pages = ceil($count_kelyfos/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_kelyfos<$count_end){$count_end=$count_kelyfos;}
	$new_page=ceil(($count_kelyfos+1)/10);
	
	$kelyfos = "<div class=\"panel panel-solar\">";
	$kelyfos .= "<div class=\"panel-heading\">";
	$kelyfos .= "<button class=\"btn btn-solar\" type=\"button\" onclick=\"form_zone_diafani(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέου ανοίγματος ΘΖ</button>";
	$kelyfos .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-eye-open\"></span> Θερμική ζώνη</h6></div></div>";
	$kelyfos .= "<div class=\"box-body table-responsive no-padding\">";
	$kelyfos .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"solar\" style=\"vertical-align: middle;text-align:center;\">
	<td width=5%><a class=\"tip-top\" href=\"#\" data-toggle=\"popover\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ζώνης που ανήκει το άνοιγμα\">Ζώνη</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα τοίχου που ανήκει το άνοιγμα\">Τοίχος</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ανοίγματος (περιγραφή)\">Όνομα</a></td>
	<td width=6%><a class=\"tip-top\" href=\"#\" title=\"Προσανατολισμός ως προς το Βορρά/Κλίση ως προς την κατακόρυφο\">Προσ/Κλίση</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Μήκος (l)/Ύψος (h)/Ποδιά (p)/Φύλλα(f)\">Διαστ.</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Συντελεστής θερμοπερατότητας\">U</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Διαπερατότητα gw\">g<sub>w</sub></a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Σκιάσεις - Αερισμός\">F/V</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Θερμογέφυρες\">Ψ</a></td>";
	$kelyfos .= "
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	
	$i=1;
	foreach($data_kelyfos as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$kelyfos .= "<tr style=\"vertical-align: middle;text-align:center;\">";
		$kelyfos .= "<td><span class=\"label label-solar\">".$i."</span></td>";
			
			$data_zone = $database->select("meletes_zones","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['zone_id'])) );
			
			if($data['wall_id']!=0){
			$belonging_table="meletes_zone_adiafani";
			$belonging_id=$data['wall_id'];
			}
			if($data['roof_id']!=0){
			$belonging_table="meletes_zone_orofes";
			$belonging_id=$data['roof_id'];
			}
			
			$data_belonging = $database->select($belonging_table,"*",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$belonging_id)) );
			$belonging = $data_belonging[0]["name"];
		
		$kelyfos .= "<td>".$data_zone[0]."</td>";
		$kelyfos .= "<td>".$belonging."</td>";
		$kelyfos .= "<td>".$data["name"]."</td>";
		if($data['wall_id']!=0){
			if($data_belonging[0]["g_type"]==0){
				$g=$data_belonging[0]["g"];
			}else{
				$g=$array_g[$data_belonging[0]["g_type"]];
			}
		}else{
			$g=$data_belonging[0]["g"];
		}
		$type = "";
		if($data['u_id']=="u_manual"){
			$type .= "Χειροκίνητη εισαγωγή";
		}
		if($data['u_id']=="u_bytype"){
			$type .= $array_type[$data["type"]]."<br/>";
			$type .= $array_plaisio[$data["plaisio"]]."<br/>";
			$type .= "%:".$data["plaisioper"]."<br/>";
			$type .= $array_yalo[$data["yalopinakas"]]."<br/>";
		}
		if($data['u_id']!="u_manual" AND $data['u_id']!="u_bytype"){
			$type .= "Άνοιγμα αν. υπολογισμού";
		}
			
		//$kelyfos .= "<td>".$type."</td>";
		$kelyfos .= "<td>".$g." / ".$data_belonging[0]["b"]."</td>";
		$kelyfos .= "<td>
		<i class=\"fa fa-arrows-h\" aria-hidden=\"true\"></i>: ".$data["w"].
		" <i class=\"fa fa-arrows-v\" aria-hidden=\"true\"></i>: ".$data["h"].
		" <i class=\"fa fa-long-arrow-down\" aria-hidden=\"true\"></i>: ".$data["p"].
		" <i class=\"fa fa-pause\" aria-hidden=\"true\"></i>: ".$data["f"].
		" <i class=\"fa fa-long-arrow-right\" aria-hidden=\"true\"></i>: ".$data["apoar"]."</td>";
		
		$u = "";
			if($data['u_id']=="u_manual"){
				$u.="<a class=\"tip-top\" href=\"#\" title=\"Η εισαγωγή έγινε χειροκίνητα\">";
			}
			
			if($data['u_id']=="u_bytype"){
				$u.="<a class=\"tip-top\" href=\"#\" title=\"Από τύπο παραθύρου: <br/>".$type."\">";
			}
			
			if($data['u_id']!="u_manual" AND $data['u_id']!="u_bytype"){
				$data_u = $database->select("user_diafani","*",array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$data['u_id'])) );
				$data_u_no = explode("|", $data_u[0]["a"]);
				$u.="<a class=\"tip-top\" href=\"#\" title=\"Από αναλυτικό υπολογισμό: <br/>".$data_u[0]["name"]." <br/>".$data_u_no[$data["u_id_no"]]."\">";
			}
		$u.=$data["u"]."</a>";	
			
		$kelyfos .= "<td>".$u."</td>";
		
		$kelyfos .= "<td>".$data["g_w"]."</td>";
		
			$f_type = $data["f_type"];
			$fhor = explode("|",$data["fhor"]);
			$fov = $data["fov"];
			$fovt = explode("|",$data["fovt"]);
			$ffin_l = explode("|",$data["ffin_l"]);
			$ffin_r = explode("|",$data["ffin_r"]);
			$fsh = explode("|",$data["fsh"]);
			$f_txt = "";
			
			if($f_type==0){
				if($fhor[1]!=0){
				$f_txt .= "F<sub>hor</sub>";
				}
				if($fov!=0){
				$f_txt .= ",F<sub>ov</sub>";
				}
				if($fovt[0]!=0){
				$f_txt .= ",F<sub>ovt</sub>";
				}
				if($ffin_l[1]!=0){
				$f_txt .= ",F<sub>fin_l</sub>";
				}
				if($ffin_r[1]!=0){
				$f_txt .= ",F<sub>fin_r</sub>";
				}
				if($fsh[1]!=0){
				$f_txt .= ",F<sub>fsh</sub>";
				}
			}else{
				if($f_type==1){
					$f_txt .= "Ολική";
				}
				if($f_type==2){
					$f_txt .= "Ασκίαστο";
				}
				if($f_type==3){
					$f_txt .= "Από τοίχο";
				}
				
			}
			
		$kelyfos .= "<td>".$f_txt." - V:".$data["wind"]."</td>";
		
			$thermo_txt = "";
			$data_thermo_lp = $database->select("vivliothiki_thermo_lp","name",array("id"=>$data["psi_l"]) );
			$data_thermo_yp = $database->select("vivliothiki_thermo_yp","name",array("id"=>$data["psi_a"]) );
			$thermo_txt .= "".$data_thermo_lp[0]." - ";
			$thermo_txt .= "".$data_thermo_yp[0]."";
		$kelyfos .= "<td>".$thermo_txt."</td>";
		
		$kelyfos .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_zone_diafani(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$kelyfos .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_zone_diafani(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$kelyfos .= "</tr>";
		}
	$i++;
	}
	$kelyfos .= "</table></div><div class=\"panel-footer\">";
	
	if($count_kelyfos!=0){
		$kelyfos .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_kelyfos." διαφανών ΘΖ.";
	}else{
		$kelyfos .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$kelyfos .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_zone_diafani(".$previous_page.")\"";}
	$kelyfos .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$kelyfos .= "<li".$disabled."><a href=\"#\" onclick=\"get_zone_diafani(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_zone_diafani(".$next_page.")\"";}
	$kelyfos .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$kelyfos .= "</ul></div></div>";
	
	return $kelyfos;	
}


// ######################################### ΚΕΛΥΦΟΣ ΜΘΧ #####################################################
// ##################################################### ΔΑΠΕΔΑ ###############################################
//Εκτύπωση πίνακα ΔΑΠΕΔΑ ΜΘΧ
function create_meletes_mthx_dapeda($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_mthx_dapeda";
	$col = "*";
	$array_type = array(
		0=>"Επί εδάφους",
		1=>"Σε αέρα (πυλωτή)"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_kelyfos = $database->select($tb,$col,$where);
	
	
	$count_kelyfos = count($data_kelyfos);
	$total_pages = ceil($count_kelyfos/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_kelyfos<$count_end){$count_end=$count_kelyfos;}
	$new_page=ceil(($count_kelyfos+1)/10);
	
	$kelyfos = "<div class=\"panel panel-znx\">";
	$kelyfos .= "<div class=\"panel-heading\">";
	$kelyfos .= "<button class=\"btn btn-znx\" type=\"button\" onclick=\"form_mthx_dapeda(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέου δαπέδου ΜΘΧ</button>";
	$kelyfos .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-eye-open\"></span> Μη θερμαινόμενος χώρος</h6></div></div>";
	$kelyfos .= "<div class=\"box-body table-responsive no-padding\">";
	$kelyfos .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"znx\" style=\"vertical-align: middle;text-align:center;\">
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα ΜΘΧ που ανήκει το δάπεδο\">ΜΘΧ</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Τύπος επαφής δαπέδου\">Επαφή</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Όνομα\">Όνομα</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Εμβαδόν\">E</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Συντελεστής θερμοπερατότητας\">U</a></td>
	<td width=5%><a class=\"tip-top\" href=\"#\" title=\"Απορροφητικότητα α/Συντελεστής εκπομπής ε\">α/ε</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Επιλογές επαφής (ανάλογα με την επαφή του δαπέδου)\">z/F</a></td>";
	$kelyfos .= "
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_kelyfos as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$kelyfos .= "<tr style=\"vertical-align: middle;text-align:center;\">";
		$kelyfos .= "<td><span class=\"label label-znx\">".$i."</span></td>";
			
			$data_mthx = $database->select("meletes_mthx","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['mthx_id'])) );
		
		$kelyfos .= "<td>".$data_mthx[0]."</td>";
			
		$kelyfos .= "<td>".$array_type[$data["type"]].$mthx."</td>";
		$kelyfos .= "<td>".$data["name"]."</td>";
		$kelyfos .= "<td>".$data["e"]."</td>";
		
			if($data['u_id']!=0){
				$data_u = $database->select("user_adiafani",array("name","u"),array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$data['u_id'])) );
				$u="(".$data_u[0]["name"].") ".$data_u[0]["u"];
			}else{
				$u=$data["u"];
			}
		$kelyfos .= "<td>".$u."</td>";
			$data_ap = $database->select("vivliothiki_adiafani_a","a",array("id"=>$data['ap']) );
			$ap=$data_ap[0];
			$data_ek = $database->select("vivliothiki_adiafani_e","e",array("id"=>$data['ek']) );
			$ek=$data_ek[0];
		$kelyfos .= "<td>".$ap." / ".$ek."</td>";
			if($data["type"]==0){
			$prostheta = "z:".$data["z"]."<br/>"."Π:".$data["p"];
			}else{
			$prostheta = "Fhor_h:".$data["fhor_h"]."<br/>"."Fhor_c:".$data["fhor_c"]."<br/>".
						 "Fov_h:".$data["fov_h"]."<br/>"."Fov_c:".$data["fov_c"]."<br/>".
						 "Ffin_h:".$data["ffin_h"]."<br/>"."Ffin_c:".$data["ffin_c"];
			}
		$kelyfos .= "<td><a href=\"#\" class=\"tip-top\" title=\"".$prostheta."\" data-content=\"".$prostheta."\"><i class=\"fa fa-list-alt fa-2x\" aria-hidden=\"true\"></i></a></td>";
		$kelyfos .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_mthx_dapeda(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$kelyfos .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_mthx_dapeda(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$kelyfos .= "</tr>";
		}
	$i++;
	}
	$kelyfos .= "</table></div><div class=\"panel-footer\">";
	
	if($count_kelyfos!=0){
		$kelyfos .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_kelyfos." δαπέδων ΜΘΧ.";
	}else{
		$kelyfos .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$kelyfos .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_mthx_dapeda(".$previous_page.")\"";}
	$kelyfos .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$kelyfos .= "<li".$disabled."><a href=\"#\" onclick=\"get_mthx_dapeda(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_mthx_dapeda(".$next_page.")\"";}
	$kelyfos .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$kelyfos .= "</ul></div></div>";
	
	return $kelyfos;	
}

// ##################################################### ΟΡΟΦΕΣ ###############################################
//Εκτύπωση πίνακα ΟΡΟΦΕΣ ΜΘΧ
function create_meletes_mthx_orofes($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_mthx_orofes";
	$col = "*";
	$array_type = array(
		0=>"Σε αέρα"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_kelyfos = $database->select($tb,$col,$where);
	
	
	$count_kelyfos = count($data_kelyfos);
	$total_pages = ceil($count_kelyfos/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_kelyfos<$count_end){$count_end=$count_kelyfos;}
	$new_page=ceil(($count_kelyfos+1)/10);
	
	$kelyfos = "<div class=\"panel panel-znx\">";
	$kelyfos .= "<div class=\"panel-heading\">";
	$kelyfos .= "<button class=\"btn btn-znx\" type=\"button\" onclick=\"form_mthx_orofes(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέας οροφής ΜΘΧ</button>";
	$kelyfos .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-eye-open\"></span> Μη θερμαινόμενος χώρος</h6></div></div>";
	$kelyfos .= "<div class=\"box-body table-responsive no-padding\">";
	$kelyfos .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"znx\" style=\"vertical-align: middle;text-align:center;\">
	<td width=5%><a class=\"tooltipui\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tooltipui\" href=\"#\" title=\"Όνομα ΜΘΧ που ανήκει η οροφή\">ΜΘΧ</a></td>
	<td width=20%><a class=\"tooltipui\" href=\"#\" title=\"Τύπος επαφής οροφής\">Τύπος επαφής</a></td>
	<td width=15%><a class=\"tooltipui\" href=\"#\" title=\"Όνομα\">Όνομα</a></td>
	<td width=5%><a class=\"tooltipui\" href=\"#\" title=\"Προσανατολισμός / Κλίση\">Προς/Κλίση</a></td>
	<td width=5%><a class=\"tooltipui\" href=\"#\" title=\"Εμβαδόν\">E</a></td>
	<td width=15%><a class=\"tooltipui\" href=\"#\" title=\"Συντελεστής θερμοπερατότητας\">U</a></td>
	<td width=5%><a class=\"tooltipui\" href=\"#\" title=\"Απορροφητικότητα α/Συντελεστής εκπομπής ε\">α/ε</a></td>
	<td width=2%><a class=\"tooltipui\" href=\"#\" title=\"Επιλογές επαφής (συντελεστές σκίασης)\">F</a></td>";
	$kelyfos .= "
	<td width=2%><a class=\"tooltipui\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tooltipui\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($data_kelyfos as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$kelyfos .= "<tr style=\"vertical-align: middle;text-align:center;\">";
		$kelyfos .= "<td><span class=\"label label-znx\">".$i."</span></td>";
			
			$data_mthx = $database->select("meletes_mthx","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['mthx_id'])) );
		
		$kelyfos .= "<td>".$data_mthx[0]."</td>";
		$kelyfos .= "<td>".$array_type[$data["type"]]."</td>";	
		$kelyfos .= "<td>".$data["name"]."</td>";
		$kelyfos .= "<td>".$data["g"]." / ".$data["b"]."</td>";
		$kelyfos .= "<td>".$data["e"]."</td>";
		
			if($data['u_id']!=0){
				$data_u = $database->select("user_adiafani",array("name","u"),array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$data['u_id'])) );
				$u="(".$data_u[0]["name"].") ".$data_u[0]["u"];
			}else{
				$u=$data["u"];
			}
		$kelyfos .= "<td>".$u."</td>";
			$data_ap = $database->select("vivliothiki_adiafani_a","a",array("id"=>$data['ap']) );
			$ap=$data_ap[0];
			$data_ek = $database->select("vivliothiki_adiafani_e","e",array("id"=>$data['ek']) );
			$ek=$data_ek[0];
		$kelyfos .= "<td>".$ap." / ".$ek."</td>";
		$prostheta = "Fhor_h:".$data["fhor_h"]."<br/>"."Fhor_c:".$data["fhor_c"]."<br/>".
					"Fov_h:".$data["fov_h"]."<br/>"."Fov_c:".$data["fov_c"]."<br/>".
					"Ffin_h:".$data["ffin_h"]."<br/>"."Ffin_c:".$data["ffin_c"];
		$kelyfos .= "<td><a href=\"#\" class=\"tooltipui\" title=\"".$prostheta."\" data-content=\"".$prostheta."\"><i class=\"fa fa-list-alt fa-2x\" aria-hidden=\"true\"></i></a></td>";
		$kelyfos .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_mthx_orofes(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$kelyfos .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_mthx_orofes(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$kelyfos .= "</tr>";
		}
	$i++;
	}
	$kelyfos .= "</table></div><div class=\"panel-footer\">";
	
	if($count_kelyfos!=0){
		$kelyfos .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_kelyfos." οροφών ΘΖ.";
	}else{
		$kelyfos .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$kelyfos .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_mthx_orofes(".$previous_page.")\"";}
	$kelyfos .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$kelyfos .= "<li".$disabled."><a href=\"#\" onclick=\"get_mthx_orofes(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_mthx_orofes(".$next_page.")\"";}
	$kelyfos .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$kelyfos .= "</ul></div></div>";
	
	return $kelyfos;	
}

// ##################################################### ΑΔΙΑΦΑΝΗ ###############################################
//Εκτύπωση πίνακα ΑΔΙΑΦΑΝΗ ΜΘΧ
function create_meletes_mthx_adiafani($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_mthx_adiafani";
	$col = "*";
	$array_g = array(
		1=>"Β<img src=\"images/interface/arrows/up.png\">",
		2=>"Α<img src=\"images/interface/arrows/right.png\">",
		3=>"Ν<img src=\"images/interface/arrows/down.png\">",
		4=>"Δ<img src=\"images/interface/arrows/left.png\">"
	);
	$array_type = array(
		0=>"Σε αέρα",
		1=>"Σε έδαφος",
		2=>"Μεσοτοιχία"
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
	$array_thermo = array(
		0=>"ΔΑΠ:",
		1=>"ΟΡ:",
		2=>"ΥΠ:",
		3=>"ΔΟΚ:",
		4=>"ΣΥΡ:"
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_kelyfos = $database->select($tb,$col,$where);
	
	
	$count_kelyfos = count($data_kelyfos);
	$total_pages = ceil($count_kelyfos/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_kelyfos<$count_end){$count_end=$count_kelyfos;}
	$new_page=ceil(($count_kelyfos+1)/10);
	
	$kelyfos = "<div class=\"panel panel-znx\">";
	$kelyfos .= "<div class=\"panel-heading\">";
	$kelyfos .= "<button class=\"btn btn-znx\" type=\"button\" onclick=\"form_mthx_adiafani(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέου τοίχου ΜΘΧ</button>";
	$kelyfos .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-eye-open\"></span> Θερμική ζώνη</h6></div></div>";
	$kelyfos .= "<div class=\"box-body table-responsive no-padding\">";
	$kelyfos .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"znx\" style=\"vertical-align: middle;text-align:center;\">
	<td width=5%><a class=\"tooltipui\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tooltipui\" href=\"#\" title=\"Όνομα ΜΘΧ που ανήκει ο τοίχος\">ΜΘΧ</a></td>
	<td width=10%><a class=\"tooltipui\" href=\"#\" title=\"Όνομα τοιχοποιίας (περιγραφή)\">Όνομα</a></td>
	<td width=9%><a class=\"tooltipui\" href=\"#\" title=\"Προσανατολισμός ως προς το Βορρά/Κλίση ως προς την κατακόρυφο\">γ/β</a></td>
	<td width=15%><a class=\"tooltipui\" href=\"#\" title=\"Τύπος επαφής τοίχου\">Επαφή</a></td>
	<td width=10%><a class=\"tooltipui\" href=\"#\" title=\"Μήκος (l)/Ύψος (h)/Πάχος (d)\">Διαστ.</a></td>
	<td width=15%><a class=\"tooltipui\" href=\"#\" title=\"Συντελεστής θερμοπερατότητας <br/> Δρομικό/Υποστύλωμα<br/> Δοκός/Με διάκενο\">U</a></td>
	<td width=5%><a class=\"tooltipui\" href=\"#\" title=\"Απορροφητικότητα α / Συντελεστής εκπομπής ε\">α/ε</a></td>
	<td width=5%><a class=\"tooltipui\" href=\"#\" title=\"Φέρων οργανισμός / Συρόμενα στοιχεία με διάκενο\">Φ-Σ</a></td>
	<td width=10%><a class=\"tooltipui\" href=\"#\" title=\"Σκιάσεις\">F</a></td>
	<td width=2%><a class=\"tooltipui\" href=\"#\" title=\"Θερμογέφυρες\">Ψ</a></td>";
	$kelyfos .= "
	<td width=2%><a class=\"tooltipui\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tooltipui\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	
	$i=1;
	foreach($data_kelyfos as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$kelyfos .= "<tr style=\"vertical-align: middle;text-align:center;\">";
		$kelyfos .= "<td><span class=\"label label-znx\">".$i."</span></td>";
			
			$data_mthx = $database->select("meletes_mthx","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['mthx_id'])) );
		
		$kelyfos .= "<td>".$data_mthx[0]."</td>";
		$kelyfos .= "<td>".$data["name"]." - <i class=\"fa fa-picture-o\" aria-hidden=\"true\" onclick=mthx_adiafani_showimg(".$data["id"].");></td>";
			if($data["g_type"]==0){
				$g=$data["g"];
			}else{
				$g=$array_g[$data["g_type"]];
			}
		$kelyfos .= "<td>".$g." / ".$data["b"]."</td>";
		$kelyfos .= "<td>".$array_type[$data["type"]]."</td>";
		$kelyfos .= "<td>
		<i class=\"fa fa-arrows-h\" aria-hidden=\"true\"></i>: ".number_format($data["l"],2).
		" <i class=\"fa fa-arrows-v\" aria-hidden=\"true\"></i>: ".number_format($data["h"],2).
		" <i class=\"fa fa-eraser\" aria-hidden=\"true\"></i>: ".number_format($data["d"],2)."</td>";
		
		$u = "";
			if($data['u_id']!=0){
				$data_u = $database->select("user_adiafani","u",array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$data['u_id'])) );
				$u.="<i class=\"fa fa-square-o\" aria-hidden=\"true\"></i>: ".number_format($data_u[0],2)."-";
			}else{
				$u.="<i class=\"fa fa-square-o\" aria-hidden=\"true\"></i>: ".number_format($data["u"],2)."-";
			}
			if($data['yp_u_id']!=0){
				$data_u = $database->select("user_adiafani","u",array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$data['yp_u_id'])) );
				$u.="<i class=\"fa fa-square\" aria-hidden=\"true\"></i>: ".number_format($data_u[0],2)."-";
			}else{
				$u.="<i class=\"fa fa-square\" aria-hidden=\"true\"></i>: ".number_format($data["yp_u"],2)."-";
			}
			if($data['dok_u_id']!=0){
				$data_u = $database->select("user_adiafani","u",array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$data['dok_u_id'])) );
				$u.="<i class=\"fa fa-minus-square\" aria-hidden=\"true\"></i>: ".number_format($data_u[0],2)."-";
			}else{
				$u.="<i class=\"fa fa-minus-square\" aria-hidden=\"true\"></i>: ".number_format($data["dok_u"],2)."-";
			}
			if($data['syr_u_id']!=0){
				$data_u = $database->select("user_adiafani","u",array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$data['syr_u_id'])) );
				$u.="<i class=\"fa fa-dot-circle-o\" aria-hidden=\"true\"></i>: ".number_format($data_u[0],2)."-";
			}else{
				$u.="<i class=\"fa fa-dot-circle-o\" aria-hidden=\"true\"></i>: ".number_format($data["syr_u"],2)."-";
			}
		$kelyfos .= "<td>".$u."</td>";
		
			$data_ap = $database->select("vivliothiki_adiafani_a","a",array("id"=>$data['ap']) );
			$ap=$data_ap[0];
			$data_ek = $database->select("vivliothiki_adiafani_e","e",array("id"=>$data['ek']) );
			$ek=$data_ek[0];
		$kelyfos .= "<td>".$ap."/".$ek."</td>";
			if($data["yp"]!=0){
				$yp = explode("^", $data["yp"]);
				$count_yp = count($yp)-1;
			}else{
				$count_yp = "-";
			}
			if($data["dok"]!=0){
				$dok = explode("^", $data["dok"]);
				$count_dok = count($dok)-1;
			}else{
				$count_dok = "-";
			}
			if($data["syr"]!=0){
				$syr = explode("^", $data["syr"]);
				$count_syr = count($syr)-1;
			}else{
				$count_syr = "-";
			}
			$ferwn_txt="Υπ:".$count_yp."<br/>Δοκ:".$count_dok."<br/>Συρ:".$count_syr;
		$kelyfos .= "<td>".$data["per"]."% / <a href=\"#\" class=\"tooltipui\" title=\"".$ferwn_txt."\"><i class=\"fa fa-columns\" aria-hidden=\"true\"></i></a></td>";
		
			$f_type = $data["f_type"];
			$fhor = explode("|",$data["fhor"]);
			$fov = $data["fov"];
			$fovt = explode("|",$data["fovt"]);
			$ffin_l = explode("|",$data["ffin_l"]);
			$ffin_r = explode("|",$data["ffin_r"]);
			$fsh = explode("|",$data["fsh"]);
			$f_txt = "";
			
			if($f_type==0){
				if($fhor[1]!=0){
				$f_txt .= "F<sub>hor</sub>";
				}
				if($fov!=0){
				$f_txt .= ",F<sub>ov</sub>";
				}
				if($fovt[0]!=0){
				$f_txt .= ",F<sub>ovt</sub>";
				}
				if($ffin_l[1]!=0){
				$f_txt .= ",F<sub>fin_l</sub>";
				}
				if($ffin_r[1]!=0){
				$f_txt .= ",F<sub>fin_r</sub>";
				}
				if($fsh[1]!=0){
				$f_txt .= ",F<sub>fsh</sub>";
				}
			}else{
				if($f_type==1){
					$f_txt .= "Ολική";
				}
				if($f_type==2){
					$f_txt .= "Ασκίαστος";
				}
				if($f_type==3){
					$f_txt .= "U<0.6";
				}
				
			}
			
		$kelyfos .= "<td>".$f_txt."</td>";
		
		$psi_array = explode("^", $data["psi"]);
		$thermo_txt = "";
			for($z=0;$z<=4;$z++){
			$psi_values = explode("|", $psi_array[$z]);
			$tb_thermo = "vivliothiki_thermo_".$array_dbs[$psi_values[0]];
			$data_thermo = $database->select($tb_thermo,"name",array("id"=>$psi_values[1]) );
			
			$thermo_txt .= $array_thermo[$z].$data_thermo[0]."<br/>";
			}
		$kelyfos .= "<td><a href=\"#\" class=\"tooltipui\" title=\"".$thermo_txt."\" data-content=\"".$thermo_txt."\"><i class=\"fa fa-list-alt fa-2x\" aria-hidden=\"true\"></i></a></td>";
		
		$kelyfos .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_mthx_adiafani(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$kelyfos .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_mthx_adiafani(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$kelyfos .= "</tr>";
		}
	$i++;
	}
	$kelyfos .= "</table></div><div class=\"panel-footer\">";
	
	if($count_kelyfos!=0){
		$kelyfos .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_kelyfos." αδιαφανών ΜΘΧ.";
	}else{
		$kelyfos .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$kelyfos .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_mthx_adiafani(".$previous_page.")\"";}
	$kelyfos .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$kelyfos .= "<li".$disabled."><a href=\"#\" onclick=\"get_mthx_adiafani(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_mthx_adiafani(".$next_page.")\"";}
	$kelyfos .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$kelyfos .= "</ul></div></div>";
	
	return $kelyfos;	
}

// ##################################################### ΔΙΑΦΑΝΗ ###############################################
//Εκτύπωση πίνακα ΔΙΑΦΑΝΗ ΘΖ
function create_meletes_mthx_diafani($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_mthx_diafani";
	$col = "*";
	$array_g = array(
		1=>"Β<img src=\"images/interface/arrows/up.png\">",
		2=>"Α<img src=\"images/interface/arrows/right.png\">",
		3=>"Ν<img src=\"images/interface/arrows/down.png\">",
		4=>"Δ<img src=\"images/interface/arrows/left.png\">"
	);
	$array_type = array(
		0=>"Αδιαφανής πόρτα",
		1=>"Ανοιγόμενο παράθυρο",
		2=>"Ανοιγόμενη πόρτα μονή",
		3=>"Ανοιγόμενη πόρτα διπλή",
		4=>"Συρόμενο παράθυρο μονό",
		5=>"Συρόμενο παράθυρο διπλό",
		6=>"Συρόμενη πόρτα μονή",
		7=>"Συρόμενη πόρτα διπλή",
		8=>"Επάλληλη πόρτα",
		9=>"Μη ανοιγόμενο κούφωμα",
		10=>"Υαλότουβλα"
	);
	$array_plaisio = array(
		1=>"Μεταλλικό πλαίσιο χωρίς θερμο",
		2=>"Μεταλλικό πλαίσιο με θερμο 12mm",
		3=>"Μεταλλικό πλαίσιο με θερμο 24mm",
		4=>"Συνθετικό πλαίσιο",
		5=>"Ξύλινο πλαίσιο",
		6=>"Διπλό παράθυρο (ξύλινο)",
		7=>"Μεταλλική πόρτα",
		8=>"Συνθετική πόρτα",
		9=>"Ξύλινη πόρτα"
	);
	
	$array_yalo = array(
		1=>"Χωρίς υαλοπίνακα σε αέρα",
		2=>"Χωρίς υαλοπίνακα σε ΜΘΧ",
		3=>"Μονός",
		3=>"Δίδυμος υαλοπίνακας με διάκενο αέρα 6mm",
		3=>"Δίδυμος υαλοπίνακας με διάκενο αέρα 12mm",
		3=>"Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 6mm",
		3=>"Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 12mm",
		3=>"Μονός",
	);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_kelyfos = $database->select($tb,$col,$where);
	
	
	$count_kelyfos = count($data_kelyfos);
	$total_pages = ceil($count_kelyfos/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_kelyfos<$count_end){$count_end=$count_kelyfos;}
	$new_page=ceil(($count_kelyfos+1)/10);
	
	$kelyfos = "<div class=\"panel panel-znx\">";
	$kelyfos .= "<div class=\"panel-heading\">";
	$kelyfos .= "<button class=\"btn btn-znx\" type=\"button\" onclick=\"form_mthx_diafani(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέου ανοίγματος ΜΘΧ</button>";
	$kelyfos .= "<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-eye-open\"></span> Θερμική ζώνη</h6></div></div>";
	$kelyfos .= "<div class=\"box-body table-responsive no-padding\">";
	$kelyfos .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"znx\" style=\"vertical-align: middle;text-align:center;\">
	<td width=5%><a href=\"#\" data-content=\"Α\" data-toggle=\"popover\" title=\"Αρίθμηση\" onclick=\"$(this).popover({ html:true, trigger:'click' });\">α/α</a></td>
	<td width=10%><a class=\"tooltipui\" href=\"#\" title=\"Όνομα ΜΘΧ που ανήκει το άνοιγμα\">ΜΘΧ</a></td>
	<td width=10%><a class=\"tooltipui\" href=\"#\" title=\"Όνομα τοίχου που ανήκει το άνοιγμα\">Τοίχος</a></td>
	<td width=10%><a class=\"tooltipui\" href=\"#\" title=\"Όνομα ανοίγματος (περιγραφή)\">Όνομα</a></td>
	<td width=6%><a class=\"tooltipui\" href=\"#\" title=\"Προσανατολισμός ως προς το Βορρά/Κλίση ως προς την κατακόρυφο\">Προσ/Κλίση</a></td>
	<td width=20%><a class=\"tooltipui\" href=\"#\" title=\"Μήκος (l)/Ύψος (h)/Ποδιά (p)/Φύλλα(f)\">Διαστ.</a></td>
	<td width=5%><a class=\"tooltipui\" href=\"#\" title=\"Συντελεστής θερμοπερατότητας\">U</a></td>
	<td width=5%><a class=\"tooltipui\" href=\"#\" title=\"Διαπερατότητα gw\">g<sub>w</sub></a></td>
	<td width=10%><a class=\"tooltipui\" href=\"#\" title=\"Σκιάσεις - Αερισμός\">F/V</a></td>
	<td width=15%><a class=\"tooltipui\" href=\"#\" title=\"Θερμογέφυρες\">Ψ</a></td>";
	$kelyfos .= "
	<td width=2%><a class=\"tooltipui\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tooltipui\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	
	$i=1;
	foreach($data_kelyfos as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$kelyfos .= "<tr style=\"vertical-align: middle;text-align:center;\">";
		$kelyfos .= "<td><span class=\"label label-znx\">".$i."</span></td>";
			
			$data_mthx = $database->select("meletes_mthx","name",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$data['mthx_id'])) );
			
			if($data['wall_id']!=0){
			$belonging_table="meletes_mthx_adiafani";
			$belonging_id=$data['wall_id'];
			}
			if($data['roof_id']!=0){
			$belonging_table="meletes_mthx_adiafani";
			$belonging_id=$data['roof_id'];
			}
			
			$data_belonging = $database->select($belonging_table,"*",array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"id"=>$belonging_id)) );
			$belonging = $data_belonging[0]["name"];
		
		$kelyfos .= "<td>".$data_mthx[0]."</td>";
		$kelyfos .= "<td>".$belonging."</td>";
		$kelyfos .= "<td>".$data["name"]."</td>";
			if($data_belonging[0]["g_type"]==0){
				$g=$data_belonging[0]["g"];
			}else{
				$g=$array_g[$data_belonging[0]["g_type"]];
			}
			
		$type = "";
		if($data['u_id']=="u_manual"){
			$type .= "-";
		}
		if($data['u_id']=="u_bytype"){
			$type .= $array_type[$data["type"]]."<br/>";
			$type .= $array_plaisio[$data["plaisio"]]."<br/>";
			$type .= "%:".$data["plaisioper"]."<br/>";
			$type .= $array_yalo[$data["yalopinakas"]]."<br/>";
		}
		if($data['u_id']!="u_manual" AND $data['u_id']!="u_bytype"){
			$type .= "Άνοιγμα αν. υπολογισμού";
		}
			
		//$kelyfos .= "<td>".$type."</td>";
		$kelyfos .= "<td>".$g." / ".$data_belonging[0]["b"]."</td>";
		$kelyfos .= "<td>
		<i class=\"fa fa-arrows-h\" aria-hidden=\"true\"></i>: ".$data["w"].
		" <i class=\"fa fa-arrows-v\" aria-hidden=\"true\"></i>: ".$data["h"].
		" <i class=\"fa fa-long-arrow-down\" aria-hidden=\"true\"></i>: ".$data["p"].
		" <i class=\"fa fa-pause\" aria-hidden=\"true\"></i>: ".$data["f"].
		" <i class=\"fa fa-long-arrow-right\" aria-hidden=\"true\"></i>: ".$data["apoar"]."</td>";
		
		$u = "";
			if($data['u_id']=="u_manual"){
				$u.="<a class=\"tooltipui\" href=\"#\" title=\"Η εισαγωγή έγινε χειροκίνητα\">";
			}
			
			if($data['u_id']=="u_bytype"){
				$u.="<a class=\"tooltipui\" href=\"#\" title=\"Από τύπο παραθύρου: <br/>".$type."\">";
			}
			
			if($data['u_id']!="u_manual" AND $data['u_id']!="u_bytype"){
				$data_u = $database->select("user_diafani","*",array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$data['u_id'])) );
				$data_u_no = explode("|", $data_u[0]["a"]);
				$u.="<a class=\"tooltipui\" href=\"#\" title=\"Από αναλυτικό υπολογισμό: <br/>".$data_u[0]["name"]." <br/>".$data_u_no[$data["u_id_no"]]."\">";
			}
		$u.=$data["u"]."</a>";	
			
		$kelyfos .= "<td>".$u."</td>";
		
		$kelyfos .= "<td>".$data["g_w"]."</td>";
		
			$f_type = $data["f_type"];
			$fhor = explode("|",$data["fhor"]);
			$fov = $data["fov"];
			$fovt = explode("|",$data["fovt"]);
			$ffin_l = explode("|",$data["ffin_l"]);
			$ffin_r = explode("|",$data["ffin_r"]);
			$fsh = explode("|",$data["fsh"]);
			$f_txt = "";
			
			if($f_type==0){
				if($fhor[1]!=0){
				$f_txt .= "F<sub>hor</sub>";
				}
				if($fov!=0){
				$f_txt .= ",F<sub>ov</sub>";
				}
				if($fovt[0]!=0){
				$f_txt .= ",F<sub>ovt</sub>";
				}
				if($ffin_l[1]!=0){
				$f_txt .= ",F<sub>fin_l</sub>";
				}
				if($ffin_r[1]!=0){
				$f_txt .= ",F<sub>fin_r</sub>";
				}
				if($fsh[1]!=0){
				$f_txt .= ",F<sub>fsh</sub>";
				}
			}else{
				if($f_type==1){
					$f_txt .= "Ολική";
				}
				if($f_type==2){
					$f_txt .= "Ασκίαστο";
				}
				if($f_type==3){
					$f_txt .= "Από τοίχο";
				}
				
			}
			
		$kelyfos .= "<td>".$f_txt." - V:".$data["wind"]."</td>";
		
			$thermo_txt = "";
			$data_thermo_lp = $database->select("vivliothiki_thermo_lp","name",array("id"=>$data["psi_l"]) );
			$data_thermo_yp = $database->select("vivliothiki_thermo_yp","name",array("id"=>$data["psi_a"]) );
			$thermo_txt .= "".$data_thermo_lp[0]." - ";
			$thermo_txt .= "".$data_thermo_yp[0]."";
		$kelyfos .= "<td>".$thermo_txt."</td>";
		
		$kelyfos .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_mthx_diafani(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$kelyfos .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_mthx_diafani(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$kelyfos .= "</tr>";
		}
	$i++;
	}
	$kelyfos .= "</table></div><div class=\"panel-footer\">";
	
	if($count_kelyfos!=0){
		$kelyfos .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_kelyfos." διαφανών ΜΘΧ.";
	}else{
		$kelyfos .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$kelyfos .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_mthx_diafani(".$previous_page.")\"";}
	$kelyfos .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$kelyfos .= "<li".$disabled."><a href=\"#\" onclick=\"get_mthx_diafani(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_mthx_diafani(".$next_page.")\"";}
	$kelyfos .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$kelyfos .= "</ul></div></div>";
	
	return $kelyfos;	
}


function create_treenav(){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb_zone = "meletes_zones";
	$tb_mthx = "meletes_mthx";
	$tb_zone_adiafani = "meletes_zone_adiafani";
	$tb_zone_dapeda = "meletes_zone_dapeda";
	$tb_zone_orofes = "meletes_zone_orofes";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	
	$data_zones = $database->select($tb_zone,$col,$where);
	$data_mthx = $database->select($tb_mthx,$col,$where);
	$data_zone_adiafani = $database->select($tb_zone_adiafani,$col,$where);
	$data_zone_dapeda = $database->select($tb_zone_dapeda,$col,$where);
	$data_zone_orofes = $database->select($tb_zone_orofes,$col,$where);
	
	$tree = "";
	$tree.= "<ul class=\"nav nav-pills nav-stacked nav-tree\" id=\"myTree\" data-toggle=\"nav-tree\">";
	 $tree.= "<li><a href=\"#\" onclick=\"get_meleti_preview(9,0);\"><i class=\"fa fa-university\"></i> Γενικά στοιχεία</a>";
    $tree.= "<li><a href=\"#\" onclick=\"get_meleti_preview(0,0);\"><i class=\"fa fa-building\"></i> Κτίριο</a>";
		$tree.= "<ul class=\"nav nav-pills nav-stacked nav-tree\">";
			//Ζώνες
			foreach($data_zones as $data){
			$tree.= "<li><a href=\"#\" onclick=\"get_meleti_preview(1,".$data["id"].");\"><i class=\"fa fa-cubes\"></i>Ζώνη:".$data["name"]."</a>";
				$tree.= "<ul class=\"nav nav-pills nav-stacked nav-tree\">";
				$tree.= "<li>";//κέλυφος
					$tree.= "<a href=\"#preview_kelyfos\" onclick=\"get_meleti_preview(2,".$data["id"].");\"><i class=\"fa fa-object-group\"></i> Κέλυφος</a>";
					$tree.= "<ul class=\"nav nav-pills nav-stacked nav-tree\">";
					$tree.= "<li>";
						foreach($data_zone_dapeda as $diaxoristikes_dap){
						if($diaxoristikes_dap["zone_id"]==$data["id"] AND $diaxoristikes_dap["type"]==1){
						$tree.= "<a href=\"#preview_dia\" onclick=\"get_meleti_preview(3,".$data["id"].");\"><i class=\"fa fa-align-center\"></i> Διαχωριστική επιφάνεια</a>";
						}
						}
						foreach($data_zone_orofes as $diaxoristikes_or){
						if($diaxoristikes_or["zone_id"]==$data["id"] AND $diaxoristikes_or["type"]==1){
						$tree.= "<a href=\"#preview_dia\" onclick=\"get_meleti_preview(3,".$data["id"].");\"><i class=\"fa fa-align-center\"></i> Διαχωριστική επιφάνεια</a>";
						}
						}
						foreach($data_zone_adiafani as $diaxoristikes_ad){
						if($diaxoristikes_ad["zone_id"]==$data["id"] AND $diaxoristikes_ad["type"]==1){
						$tree.= "<a href=\"#preview_dia\" onclick=\"get_meleti_preview(3,".$data["id"].");\"><i class=\"fa fa-align-center\"></i> Διαχωριστική επιφάνεια</a>";
						}
						}
					$tree.= "</li>";
					$tree.= "</ul>";
				$tree.= "</li>";
				$tree.= "<li>";//Συστήματα
					$tree.= "<a href=\"#preview_systems\" onclick=\"get_meleti_preview(4,".$data["id"].");\"><i class=\"fa fa-snowflake-o\"></i> Συστήματα</a>";
				$tree.= "</li>";
				$tree.= "</ul>";//Kέλυφος - Συστήματα
			}
			//ΜΘΧ - Ηλιακοί χώροι
			foreach($data_mthx as $data){
				if($data["type"]==0){
					$mthx_type = "ΜΘΧ: ";
				}else{
					$mthx_type = "Ηλιακός χώρος: ";
				}
			$tree.= "<li><a href=\"#\" onclick=\"get_meleti_preview(5,".$data["id"].");\"><i class=\"fa fa-cube\"></i>".$mthx_type.$data["name"]."</a>";
			}
		$tree.= "</ul>";//Ζώνες - ΜΘΧ
	$tree.= "</li>";//Κτίριο
	$tree.= "</ul>";//Λίστα
	
	return $tree;
	
}

?>