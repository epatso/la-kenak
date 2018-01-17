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


if (isset($_GET['getadeies'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_oikad($page);
	echo $tb;
	exit;
}

if (isset($_GET['getowners'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_owners($page);
	echo $tb;
	exit;
}
if (isset($_GET['getsith'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_sith($page);
	echo $tb;
	exit;
}
if (isset($_GET['getpv'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_pv($page);
	echo $tb;
	exit;
}
if (isset($_GET['getwindturbine'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_windturbine($page);
	echo $tb;
	exit;
}
if (isset($_GET['getkatanalwseis'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_katanalwseis($page);
	echo $tb;
	exit;
}
if (isset($_GET['getydreysi'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_ydreysi($page);
	echo $tb;
	exit;
}
if (isset($_GET['getanelkystires'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_meletes_anelkystires($page);
	echo $tb;
	exit;
}

require("include_check.php");
//require("functions_meleti_general.php");



// ##################################################### ΟΙΚΟΔΟΜΙΚΕΣ ΑΔΕΙΕΣ ###############################################
//Εκτύπωση πίνακα ΟΙΚΟΔΟΜΙΚΕΣ ΑΔΕΙΕΣ
function create_meletes_oikad($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_oikad";
	$col = "*";
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$tb_data = $database->select($tb,$col,$where);
	
	
	$count = count($tb_data);
	$total_pages = ceil($count/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count<$count_end){$count_end=$count;}
	$new_page=ceil(($count+1)/10);
	
	$txt = "<div class=\"panel panel-info\">";
	$txt .= "<div class=\"panel-heading\">";
	$txt .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_oikad(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νέας άδειας</button>";
	$txt .= "</div>";
	$txt .= "<table class=\"table table-bordered table-hover\">
	<tr class=\"info\">
	<td width=5%><a href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=20%><a href=\"#\" title=\"Κατάσταση κατασκευής\">Κατάσταση κατασκευής</a></td>
	<td width=30%><a href=\"#\" title=\"Συνοπτική περιγραφή\">Συνοπτική περιγραφή</a></td>
	<td width=20%><a href=\"#\" title=\"Πηγή\">Πηγή</a></td>
	<td width=10%><a href=\"#\" title=\"Έτος οικοδομικής αδείας\">Έτος οικ. αδ.</a></td>
	<td width=10%><a href=\"#\" title=\"Έτος\">Έτος</a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($tb_data as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$txt .= "<tr>";
		$txt .= "<td><span class=\"label label-info\">".$i."</span></td>";
		$txt .= "<td>".$data["condition"]."</td>";		
		$txt .= "<td>".$data["desc"]."</td>";
		$txt .= "<td>".$data["datasource"]."</td>";
		$txt .= "<td>".$data["yearpermit"]."</td>";
		$txt .= "<td>".$data["year"]."</td>";
		$txt .= "<td><button class=\"btn btn-small btn-warning\" type=\"button\" onclick=\"form_oikad(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$txt .= "<td><button class=\"btn btn-small btn-danger\" type=\"button\" onclick=\"formdel_oikad(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$txt .= "</tr>";
		}
	$i++;
	}
	$txt .= "</table><div class=\"panel-footer\">";
	
	if($count!=0){
		$txt .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count." οικοδ. αδειών.";
	}else{
		$txt .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$txt .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_oikad(".$previous_page.")\"";}
	$txt .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_oikad(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_oikad(".$next_page.")\"";}
	$txt .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$txt .= "</ul></div></div>";
	
	return $txt;	
}

// ##################################################### ΙΔΙΟΚΤΗΤΕΣ ###############################################
//Εκτύπωση πίνακα ΙΔΙΟΚΤΗΤΕΣ
function create_meletes_owners($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_owners";
	$col = "*";
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$tb_data = $database->select($tb,$col,$where);
	
	
	$count = count($tb_data);
	$total_pages = ceil($count/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count<$count_end){$count_end=$count;}
	$new_page=ceil(($count+1)/10);
	
	$txt = "<div class=\"panel panel-info\">";
	$txt .= "<div class=\"panel-heading\">";
	$txt .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_owners(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη ιδιοκτήτη</button>";
	$txt .= "</div>";
	$txt .= "<table class=\"table table-bordered table-hover\">
	<tr class=\"info\">
	<td width=5%><a href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=5%><a href=\"#\" title=\"Ποσοστό συμμετοχής\">%</a></td>
	<td width=5%><a href=\"#\" title=\"Όνομα\">Όνομα</a></td>
	<td width=5%><a href=\"#\" title=\"Επώνυμο\">Επώνυμο</a></td>
	<td width=5%><a href=\"#\" title=\"Πατρώνυμο\">Πατρώνυμο</a></td>
	<td width=5%><a href=\"#\" title=\"Μητρώνυμο\">Μητρώνυμο</a></td>
	<td width=5%><a href=\"#\" title=\"Διεύθυνση\">Διεύθυνση</a></td>
	<td width=5%><a href=\"#\" title=\"ΑΦΜ\">ΑΦΜ</a></td>
	<td width=5%><a href=\"#\" title=\"ΔΟΥ\">ΔΟΥ</a></td>
	<td width=5%><a href=\"#\" title=\"Ταυτότητα\">ΑΔΤ</a></td>
	<td width=5%><a href=\"#\" title=\"Τηλέφωνο\">Τηλ.</a></td>
	<td width=5%><a href=\"#\" title=\"Mail\">@</a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($tb_data as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$txt .= "<tr>";
		$txt .= "<td><span class=\"label label-info\">".$i."</span></td>";
		$txt .= "<td>".$data["pososto"]."</td>";
		$txt .= "<td>".$data["firstname"]."</td>";
		$txt .= "<td>".$data["lastname"]."</td>";
		$txt .= "<td>".$data["fathername"]."</td>";
		$txt .= "<td>".$data["mothername"]."</td>";
		$txt .= "<td>".$data["address"]."</td>";
		$txt .= "<td>".$data["afm"]."</td>";
		$txt .= "<td>".$data["doy"]."</td>";
		$txt .= "<td>".$data["taytotita"]."</td>";
		$txt .= "<td>".$data["tel"]."</td>";
		$txt .= "<td>".$data["mail"]."</td>";
		$txt .= "<td><button class=\"btn btn-small btn-warning\" type=\"button\" onclick=\"form_owners(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$txt .= "<td><button class=\"btn btn-small btn-danger\" type=\"button\" onclick=\"formdel_owners(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$txt .= "</tr>";
		}
	$i++;
	}
	$txt .= "</table><div class=\"panel-footer\">";
	
	if($count!=0){
		$txt .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count." ιδιοκτητών.";
	}else{
		$txt .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$txt .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_owners(".$previous_page.")\"";}
	$txt .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_owners(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_owners(".$next_page.")\"";}
	$txt .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$txt .= "</ul></div></div>";
	
	return $txt;	
}

// ##################################################### ΣΗΘ ###############################################
//Εκτύπωση πίνακα ΣΗΘ
function create_meletes_sith($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_sith";
	$col = "*";
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$tb_data = $database->select($tb,$col,$where);
	
	$array_sith_type=array(
		0=>"Κυψέλες καυσίμου",
		1=>"Μηχανή Stirling",
		2=>"Μηχανή OTTO",
		3=>"Μηχανή DIESEL",
		4=>"Μικροτουρμπίνα",
		5=>"Ατμοστρόβιλος απομάστευσης",
		6=>"Αεριοστρόβιλος με λέβητα ανάκτησης"
	);
	$array_sith_pigi=array(
		0=>"Υγραέριο (LPG)",
		1=>"Φυσικο αέριο",
		2=>"Ηλεκτρισμός",
		3=>"Πετρέλαιο θέρμανσης",
		4=>"Πετρέλαιο κίνησης",
		5=>"Τηλεθέρμανση (ΑΠΕ)",
		6=>"Τηλεθέρμανση (ΔΕΗ)",
		7=>"Βιομάζα",
		8=>"Βιομάζα τυποποιημένη"
	);
	
	$count = count($tb_data);
	$total_pages = ceil($count/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count<$count_end){$count_end=$count;}
	$new_page=ceil(($count+1)/10);
	
	$txt = "<div class=\"panel panel-info\">";
	$txt .= "<div class=\"panel-heading\">";
	$txt .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_sith(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη ΣΗΘ</button>";
	$txt .= "</div>";
	$txt .= "<table class=\"table table-bordered table-hover\">
	<tr class=\"info\">
	<td width=5%><a href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=5%><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
	<td width=5%><a href=\"#\" title=\"Πηγή\">Πηγή</a></td>
	<td width=5%><a href=\"#\" title=\"Βαθμός ηλεκτρικής απόδοσης συστήματος (-)\">n_elec</a></td>
	<td width=5%><a href=\"#\" title=\"Βαθμός θερμικής απόδοσης συστήματος (-)\">n_therm</a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($tb_data as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$txt .= "<tr>";
		$txt .= "<td><span class=\"label label-info\">".$i."</span></td>";
		$txt .= "<td>".$array_sith_type[$data["type"]]."</td>";
		$txt .= "<td>".$array_sith_pigi[$data["pigi"]]."</td>";
		$txt .= "<td>".$data["n_elec"]."</td>";
		$txt .= "<td>".$data["n_therm"]."</td>";
		$txt .= "<td><button class=\"btn btn-small btn-warning\" type=\"button\" onclick=\"form_sith(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$txt .= "<td><button class=\"btn btn-small btn-danger\" type=\"button\" onclick=\"formdel_sith(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$txt .= "</tr>";
		}
	$i++;
	}
	$txt .= "</table><div class=\"panel-footer\">";
	
	if($count!=0){
		$txt .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count." ΣΗΘ.";
	}else{
		$txt .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$txt .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_sith(".$previous_page.")\"";}
	$txt .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_sith(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_sith(".$next_page.")\"";}
	$txt .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$txt .= "</ul></div></div>";
	
	return $txt;	
}

// ##################################################### PV ###############################################
//Εκτύπωση πίνακα PV
function create_meletes_pv($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_pv";
	$col = "*";
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$tb_data = $database->select($tb,$col,$where);
	
	$array_pv=array(
		0=>"Μονοκρυσταλλικό",
		1=>"Πολυκρυσταλλικό",
		2=>"Λεπτού υμένα άμορφο a-S",
		3=>"Λεπτού υμένα μικρομορφικό μ-Si",
		4=>"Λεπτού υμένα CIS-CIGS",
		5=>"Λεπτού υμένα Cd-Te",
		6=>"Τριπλής επαφής (Triple junction)"
	);
	$array_connection=array(
		0=>"Με συμψηφισμό",
		1=>"Χωρίς συμψηφισμό"
	);
	
	
	$count = count($tb_data);
	$total_pages = ceil($count/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count<$count_end){$count_end=$count;}
	$new_page=ceil(($count+1)/10);
	
	$txt = "<div class=\"panel panel-info\">";
	$txt .= "<div class=\"panel-heading\">";
	$txt .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_pv(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη Φ/Β</button>";
	$txt .= "</div>";
	$txt .= "<table class=\"table table-bordered table-hover\">
	<tr class=\"info\">
	<td width=5%><a href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=5%><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
	<td width=5%><a href=\"#\" title=\"Συντελεστής αξιοποίησης ηλιακής ακτινοβολίας (-\">συν.</a></td>
	<td width=5%><a href=\"#\" title=\"Επιφάνεια (m2)\">Ε (m<sup>2</sup>)</a></td>
	<td width=5%><a href=\"#\" title=\"Ισχύς (kW)\">P (KW)</a></td>
	<td width=5%><a href=\"#\" title=\"Προσανατολισμός\">Προς</a></td>
	<td width=5%><a href=\"#\" title=\"Κλίση\">Κλίση</a></td>
	<td width=5%><a href=\"#\" title=\"Συντελεστής Σκίασης\">F_s</a></td>
	<td width=5%><a href=\"#\" title=\"Τύπος σύνδεσης\">Σύνδεση</a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($tb_data as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$txt .= "<tr>";
		$txt .= "<td><span class=\"label label-info\">".$i."</span></td>";
		$txt .= "<td>".$array_pv[$data["type"]]."</td>";
		$txt .= "<td>".$data["n"]."</td>";
		$txt .= "<td>".$data["e"]."</td>";
		$txt .= "<td>".$data["p"]."</td>";
		$txt .= "<td>".$data["g"]."</td>";
		$txt .= "<td>".$data["b"]."</td>";
		$txt .= "<td>".$data["f_s"]."</td>";
		$txt .= "<td>".$array_connection[$data["connection"]]."</td>";
		$txt .= "<td><button class=\"btn btn-small btn-warning\" type=\"button\" onclick=\"form_pv(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$txt .= "<td><button class=\"btn btn-small btn-danger\" type=\"button\" onclick=\"formdel_pv(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$txt .= "</tr>";
		}
	$i++;
	}
	$txt .= "</table><div class=\"panel-footer\">";
	
	if($count!=0){
		$txt .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count." Φ/Β.";
	}else{
		$txt .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$txt .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_pv(".$previous_page.")\"";}
	$txt .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_pv(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_pv(".$next_page.")\"";}
	$txt .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$txt .= "</ul></div></div>";
	
	return $txt;	
}


// ##################################################### windturbine ###############################################
//Εκτύπωση πίνακα windturbine
function create_meletes_windturbine($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_anemogenitries";
	$col = "*";
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$tb_data = $database->select($tb,$col,$where);
	
	$array_wind=array(
		0=>"Αυτόνομο",
		1=>"Διασυνδεδεμένο"
	);
	
	$count = count($tb_data);
	$total_pages = ceil($count/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count<$count_end){$count_end=$count;}
	$new_page=ceil(($count+1)/10);
	
	$txt = "<div class=\"panel panel-info\">";
	$txt .= "<div class=\"panel-heading\">";
	$txt .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_windturbine(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη Ανεμογεννήτριας</button>";
	$txt .= "</div>";
	$txt .= "<table class=\"table table-bordered table-hover\">
	<tr class=\"info\">
	<td width=5%><a href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=5%><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
	<td width=5%><a href=\"#\" title=\"Ισχύς (kW)\">P (KW)</a></td>
	<td width=5%><a href=\"#\" title=\"Συντελεστής Ισχύος (-)\">n (-)</a></td>
	<td width=5%><a href=\"#\" title=\"Χώρος τοποθέτησης\">Χώρος</a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($tb_data as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$txt .= "<tr>";
		$txt .= "<td><span class=\"label label-info\">".$i."</span></td>";
		$txt .= "<td>".$array_wind[$data["type"]]."</td>";
		$txt .= "<td>".$data["p"]."</td>";
		$txt .= "<td>".$data["n"]."</td>";
		$txt .= "<td>".$data["xwros"]."</td>";
		$txt .= "<td><button class=\"btn btn-small btn-warning\" type=\"button\" onclick=\"form_windturbine(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$txt .= "<td><button class=\"btn btn-small btn-danger\" type=\"button\" onclick=\"formdel_windturbine(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$txt .= "</tr>";
		}
	$i++;
	}
	$txt .= "</table><div class=\"panel-footer\">";
	
	if($count!=0){
		$txt .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count." Ανεμογεννητριών.";
	}else{
		$txt .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$txt .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_windturbine(".$previous_page.")\"";}
	$txt .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_windturbine(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_windturbine(".$next_page.")\"";}
	$txt .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$txt .= "</ul></div></div>";
	
	return $txt;	
}

// ##################################################### katanalwseis ###############################################
//Εκτύπωση πίνακα katanalwseis
function create_meletes_katanalwseis($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_katanalwseis";
	$col = "*";
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$tb_data = $database->select($tb,$col,$where);
	
	$array_katanalwsi=array(
	0=>"Ηλεκτρική",
	1=>"Πετρέλαιο θέρμανσης",
	2=>"Πετρέλαιο κίνησης",
	3=>"Φυσικο αέριο",
	4=>"Υγραέριο",
	5=>"Βιομάζα",
	6=>"Τηλεθέρμανση"
	);
	$array_monades=array(
	0=>"kWh",
	1=>"lt",
	2=>"lt",
	3=>"Nm<sup>3</sup>",
	4=>"Nm<sup>3</sup>",
	5=>"Kg",
	6=>"kWh"
	);
	
	
	$count = count($tb_data);
	$total_pages = ceil($count/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count<$count_end){$count_end=$count;}
	$new_page=ceil(($count+1)/10);
	
	$txt = "<div class=\"panel panel-info\">";
	$txt .= "<div class=\"panel-heading\">";
	$txt .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_katanalwseis(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη κατανάλωσης</button>";
	$txt .= "</div>";
	$txt .= "<table class=\"table table-bordered table-hover\">
	<tr class=\"info\">
	<td width=5%><a href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=5%><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
	<td width=5%><a href=\"#\" title=\"Θέρμανση\">Θέρμανση</a></td>
	<td width=5%><a href=\"#\" title=\"Ψύξη\">Ψύξη</a></td>
	<td width=5%><a href=\"#\" title=\"Αερισμός\">Αερισμός</a></td>
	<td width=5%><a href=\"#\" title=\"ΖΝΧ\">ΖΝΧ</a></td>
	<td width=5%><a href=\"#\" title=\"Φωτισμός\">Φωτισμός</a></td>
	<td width=5%><a href=\"#\" title=\"Συσκευές\">Συσκευές</a></td>
	<td width=5%><a href=\"#\" title=\"Κατανάλωση\">Κατανάλωση</a></td>
	<td width=5%><a href=\"#\" title=\"Μονάδες\">Μονάδες</a></td>
	<td width=5%><a href=\"#\" title=\"Περίοδος\">Περίοδος</a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($tb_data as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$txt .= "<tr>";
		$txt .= "<td><span class=\"label label-info\">".$i."</span></td>";
		$txt .= "<td>".$array_katanalwsi[$data["pigi"]]."</td>";
			if($data["therm"]==0){$therm="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["therm"]==1){$therm="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$txt .= "<td>".$therm."</td>";
			if($data["cold"]==0){$cold="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["cold"]==1){$cold="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$txt .= "<td>".$cold."</td>";
			if($data["air"]==0){$air="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["air"]==1){$air="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$txt .= "<td>".$air."</td>";
			if($data["znx"]==0){$znx="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["znx"]==1){$znx="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$txt .= "<td>".$znx."</td>";
			if($data["lights"]==0){$lights="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["lights"]==1){$lights="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$txt .= "<td>".$lights."</td>";
			if($data["syskeyes"]==0){$syskeyes="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["syskeyes"]==1){$syskeyes="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$txt .= "<td>".$syskeyes."</td>";
		$txt .= "<td>".$data["katanalwsi"]."</td>";
		$txt .= "<td>".$array_monades[$data["pigi"]]."</td>";
		$txt .= "<td>".$data["periodos"]."</td>";
		$txt .= "<td><button class=\"btn btn-small btn-warning\" type=\"button\" onclick=\"form_katanalwseis(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$txt .= "<td><button class=\"btn btn-small btn-danger\" type=\"button\" onclick=\"formdel_katanalwseis(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$txt .= "</tr>";
		}
	$i++;
	}
	$txt .= "</table><div class=\"panel-footer\">";
	
	if($count!=0){
		$txt .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count." δεδομένων κατανάλωσης.";
	}else{
		$txt .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$txt .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_katanalwseis(".$previous_page.")\"";}
	$txt .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_katanalwseis(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_katanalwseis(".$next_page.")\"";}
	$txt .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$txt .= "</ul></div></div>";
	
	return $txt;	
}

// ##################################################### ydreysi ###############################################
//Εκτύπωση πίνακα ydreysi
function create_meletes_ydreysi($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_ydreysi";
	$col = "*";
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$tb_data = $database->select($tb,$col,$where);
	
	$array_ydreysi=array(
		0=>"Ύδρευση",
		1=>"Άρδευση",
		2=>"Αποχέτευση"
	);
	
	$count = count($tb_data);
	$total_pages = ceil($count/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count<$count_end){$count_end=$count;}
	$new_page=ceil(($count+1)/10);
	
	$txt = "<div class=\"panel panel-info\">";
	$txt .= "<div class=\"panel-heading\">";
	$txt .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_ydreysi(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη νερών/αποχέτευσης</button>";
	$txt .= "</div>";
	$txt .= "<table class=\"table table-bordered table-hover\">
	<tr class=\"info\">
	<td width=5%><a href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=5%><a href=\"#\" title=\"Τύπος δικτύου\">Τύπος δικτύου</a></td>
	<td width=5%><a href=\"#\" title=\"Αριθμός\">Αριθμός</a></td>
	<td width=5%><a href=\"#\" title=\"Ισχύς (kW)\">P (KW)</a></td>
	<td width=5%><a href=\"#\" title=\"Χρόνος λειτουργίας (hr)\">Χρόνος λειτουργίας (hr)</a></td>
	<td width=5%><a href=\"#\" title=\"Ρύθμιση στροφών\">Ρύθμιση στροφών</a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($tb_data as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$txt .= "<tr>";
		$txt .= "<td><span class=\"label label-info\">".$i."</span></td>";
		$txt .= "<td>".$array_ydreysi[$data["type"]]."</td>";
		$txt .= "<td>".$data["n"]."</td>";
		$txt .= "<td>".$data["p"]."</td>";
		$txt .= "<td>".$data["t"]."</td>";
			if($data["s"]==0){$s="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["s"]==1){$s="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$txt .= "<td>".$s."</td>";
		$txt .= "<td><button class=\"btn btn-small btn-warning\" type=\"button\" onclick=\"form_ydreysi(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$txt .= "<td><button class=\"btn btn-small btn-danger\" type=\"button\" onclick=\"formdel_ydreysi(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$txt .= "</tr>";
		}
	$i++;
	}
	$txt .= "</table><div class=\"panel-footer\">";
	
	if($count!=0){
		$txt .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count." νερού/αποχέτευσης.";
	}else{
		$txt .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$txt .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_ydreysi(".$previous_page.")\"";}
	$txt .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_ydreysi(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_ydreysi(".$next_page.")\"";}
	$txt .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$txt .= "</ul></div></div>";
	
	return $txt;	
}


// ##################################################### anelkystires ###############################################
//Εκτύπωση πίνακα anelkystires
function create_meletes_anelkystires($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_anelkystires";
	$col = "*";
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$tb_data = $database->select($tb,$col,$where);
	
	$array_anelkystires=array(
		0=>"Μηχανικός ανελκυστήρας",
		1=>"Υδραυλικός ανελκυστήρας",
		2=>"Κυλιόμενες σκάλες",
		3=>"Κυλιόμενοι διάδρομοι"
	);
	
	$count = count($tb_data);
	$total_pages = ceil($count/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count<$count_end){$count_end=$count;}
	$new_page=ceil(($count+1)/10);
	
	$txt = "<div class=\"panel panel-info\">";
	$txt .= "<div class=\"panel-heading\">";
	$txt .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_anelkystires(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη ανελκυστήρα</button>";
	$txt .= "</div>";
	$txt .= "<table class=\"table table-bordered table-hover\">
	<tr class=\"info\">
	<td width=5%><a href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=5%><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
	<td width=5%><a href=\"#\" title=\"Αριθμός\">Αριθμός</a></td>
	<td width=5%><a href=\"#\" title=\"Ισχύς (kW)\">P (KW)</a></td>
	<td width=5%><a href=\"#\" title=\"Χρόνος λειτουργίας (hr)\">Χρόνος λειτουργίας (hr)</a></td>
	<td width=5%><a href=\"#\" title=\"Αυτοματισμοί\">Αυτοματισμοί</a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($tb_data as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$txt .= "<tr>";
		$txt .= "<td><span class=\"label label-info\">".$i."</span></td>";
		$txt .= "<td>".$array_anelkystires[$data["type"]]."</td>";
		$txt .= "<td>".$data["n"]."</td>";
		$txt .= "<td>".$data["p"]."</td>";
		$txt .= "<td>".$data["t"]."</td>";
			if($data["a"]==0){$a="<font color=red><i class=\"fa fa-ban\"></i></font>";}
			if($data["a"]==1){$a="<font color=green><i class=\"fa fa-check\"></i></font>";}
		$txt .= "<td>".$a."</td>";
		$txt .= "<td><button class=\"btn btn-small btn-warning\" type=\"button\" onclick=\"form_anelkystires(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$txt .= "<td><button class=\"btn btn-small btn-danger\" type=\"button\" onclick=\"formdel_anelkystires(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$txt .= "</tr>";
		}
	$i++;
	}
	$txt .= "</table><div class=\"panel-footer\">";
	
	if($count!=0){
		$txt .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count." ανελκυστήρων.";
	}else{
		$txt .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$txt .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_anelkystires(".$previous_page.")\"";}
	$txt .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_anelkystires(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_anelkystires(".$next_page.")\"";}
	$txt .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$txt .= "</ul></div></div>";
	
	return $txt;	
}
?>