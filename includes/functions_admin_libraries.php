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

//Στοιχεία μενού
if (isset($_GET['get_menudata'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	if(confirm_admin()){
		$tb = create_menudata($page);
		echo $tb;
		exit;
	}
}
//Κατηγορίες χρήσεων
if (isset($_GET['get_genxriseis'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	if(confirm_admin()){
		$tb = create_genxriseis($page);
		echo $tb;
		exit;
	}
}
//Χρήσεις κτιρίων
if (isset($_GET['get_xriseisbld'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	if(confirm_admin()){
		$tb = create_xriseisbld($page);
		echo $tb;
		exit;
	}
}
//Χρήσεις ζωνών
if (isset($_GET['get_xriseiszone'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	if(confirm_admin()){
		$tb = create_xriseiszone($page);
		echo $tb;
		exit;
	}
}

//ajax call για την επιστροφή τιμών μιας γραμμής
if (isset($_GET['get_id'])){
	$table = $_GET['table'];
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	if(confirm_admin()){
		$tb = get_id($table, $id);
		echo $tb;
		exit;
	}
}
//ajax call για την προσθήκη μιας γραμμής
if (isset($_GET['insert_id'])){
	$table = $_GET['table'];
	$action = $_GET['action'];
	$id = $_GET['id'];
	$values = explode("|", $_GET['values']);
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require("functions_meleti_general.php");//getcolumnnames()
	confirm_logged_in();
	if(confirm_admin()){
		$tb = insert_id($table,$action,$id,$values);
		echo $tb;
		exit;
	}
}
//ajax call για την διαγραφή μιας γραμμής
if (isset($_GET['del_id'])){
	$table = $_GET['table'];
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	if(confirm_admin()){
		$tb = del_id($table, $id);
		echo $tb;
		exit;
	}
}

require("include_check.php");

// ############################################### ΜΕΝΟΥ ΛΟΓΙΣΜΙΚΟΥ #########################################
//Εκτύπωση πίνακα
function create_menudata($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "core_menu";
	$col = "*";
	$where_categories=array(
		"AND"=>array("is_category"=>1,"category_id"=>0),
		"ORDER"=>array(
			"order"=>"ASC"
		)
	);
	
	//Σύνολο εγγραφών στη βάση
	$count_data=$database->count($tb);
	//Επιλογή μόνο της σελίδας $page με LIMIT $db_rows OFFSET $db_offset
	$db_offset = ($page-1)*10;
	$db_rows = 10;
	$where["LIMIT"]=array($db_offset,$db_rows);
	$tb_data=$database->select($tb,$col,$where);
	//echo $database->last_query();
	
	//Σύνολο σελίδων
	$total_pages = ceil($count_data/10);
	$count_start = $db_offset+1;
	$count_end = $db_offset+10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_data<$count_end){$count_end=$count_data;}
	$new_page=ceil(($count_data+1)/10);
	
	$array_tick=array(
		0=>"<font color=red><i class=\"fa fa-ban\"></i></font>",
		1=>"<font color=green><i class=\"fa fa-check\"></i></font>"
	);
	
	$array_access=array(
		0=>"Επισκέπτης",
		1=>"Χρήστης",
		2=>"Διαχειριστής",
		3=>"Μελέτη"
	);
	
	$txt = "<div class=\"box panel-info\">";
	$txt .= "<div class=\"box-header\"> Μενού λογισμικού </div>";
	$txt .= "<div class=\"box-body table-responsive no-padding\">";
	$txt = "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"active\">
	<th width=5% style=\"text-align:center;\"><span class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</span></th>
	<th width=15% style=\"text-align:center;\"><span class=\"tip-top\" href=\"#\" title=\"Όνομα όπως εμφανίζεται στο μενού\">Όνομα</span></th>
	<th width=10% style=\"text-align:center;\"><span class=\"tip-top\" href=\"#\" title=\"Εάν πρόκειται για κατηγορία ή όχι\">Κατηγορία</span></th>
	<th width=10% style=\"text-align:center;\"><span class=\"tip-top\" href=\"#\" title=\"Κατηγορία που ανήκει το στοιχείο\">Ανήκει</span></th>
	<th width=10% style=\"text-align:center;\"><span class=\"tip-top\" href=\"#\" title=\"Σειρά εμφάνισης στα μενού\">Σειρά</span></th>
	<th width=10% style=\"text-align:center;\"><span class=\"tip-top\" href=\"#\" title=\"Σύνδεσμος που οδηγεί το μενού\">Σύνδεσμος</span></th>
	<th width=10% style=\"text-align:center;\"><span class=\"tip-top\" href=\"#\" title=\"Εικονίδιο όπως φαίνεται στο μενού\">Εικόνα</span></th>
	<th width=10% style=\"text-align:center;\"><span class=\"tip-top\" href=\"#\" title=\"Πρόσβαση χρηστών\">Πρόσβαση</span></th>
	<th width=10% style=\"text-align:center;\"><span class=\"tip-top\" href=\"#\" title=\"Ενεργοποιημένο/Απενεργοποιημένο στοιχείο\">Ενεργό</span></th>
	<th width=2% style=\"text-align:center;\"><span class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></span></th>
	<th width=2% style=\"text-align:center;\"><span class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></span></th>
	</tr>";
	
	$i=1;
	foreach($tb_data as $data){
	$txt .= "<tr>";
	$txt .= "<td style=\"text-align:center;\"><span class=\"label label-default\">".($db_offset+$i)."</span></td>";
	$txt .= "<td style=\"text-align:center;\">".$data["name"]."</td>";
	$txt .= "<td style=\"text-align:center;\">".$array_tick[$data["is_category"]]."</td>";
		if($data["category_id"]!=0){
			$category_id = $database->select($tb,"name",array("id"=>$data["category_id"]));
			$txt .= "<td>".$category_id[0]."</td>";
		}else{
			$txt .= "<td>Μητρικό</td>";
		}
	
	$level;
	if($data["category_id"]==0){$level="";}//level0
	if($data["category_id"]!=0){
		$category_idtmp1 = $database->select($tb,"category_id",array("id"=>$data["category_id"]));
		if($category_idtmp1[0]!=0){
			$level=" - - - - ";//level2
		}else{
			$level=" - - ";//level1
		}
	}
	$txt .= "<td>".$level.$data["order"]."</td>";
	$txt .= "<td>".$data["link"]."</td>";
	$txt .= "<td style=\"text-align:center;\"><i class=\"".$data["icon"]."\"></i></td>";
	$txt .= "<td style=\"text-align:center;\">".$array_access[$data["accesslevel"]]."</td>";
	$txt .= "<td style=\"text-align:center;\">".$array_tick[$data["active"]]."</td>";
	$txt .= "<td><button class=\"btn btn-xs btn-warning\" type=\"button\" onclick=\"form_menudata(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
	$txt .= "<td><button class=\"btn btn-xs btn-danger\" type=\"button\" onclick=\"formdel_menudata(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
	$txt .= "</tr>";
	$i++;
	}
	$txt .= "</table></div><div class=\"box-footer clearfix no-border\">";
	
	if($count_data!=0){
		$txt .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_data." στοιχείων.";
	}else{
		$txt .= "Δεν βρέθηκαν αποτελέσματα με βάση το όνομα που δηλώσατε.";
	}
	
	//PAGINATION
	$txt .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_menudata(".$previous_page.")\"";}
	$txt .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
	if($total_pages<=10){
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_menudata(".$j.")\">".$j."</a></li>";
		}
	}else{
		if($page>3){
			$txt .= "<li><a href=\"#\" onclick=\"get_menudata(1)\">1</a></li>";
			$txt .= "<li class=\"disabled\"><a href=\"#\">...</a></li>";
		}
		for($j=$page-2; $j<=$page+2; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			if($j>0 AND $j<=$total_pages){
				$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_menudata(".$j.")\">".$j."</a></li>";
			}
		}
		if($page<$total_pages-3){
			$txt .= "<li class=\"disabled\"><a href=\"#\">...</a></li>";
			$txt .= "<li><a href=\"#\" onclick=\"get_menudata(".$total_pages.")\">".$total_pages."</a></li>";
		}
	}
		
	if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_menudata(".$next_page.")\"";}
	$txt .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$txt .= "</ul></div>";
	//PAGINATION
	$txt .= "</div>";
	
	return $txt;
	
}
// ############################################### ΜΕΝΟΥ ΛΟΓΙΣΜΙΚΟΥ #########################################


// ############################################### ΓΕΝΙΚΕΣ ΧΡΗΣΕΙΣ ΚΤΙΡΙΟΥ #########################################
//Εκτύπωση πίνακα
function create_genxriseis($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "vivliothiki_conditions_general";
	$col = "*";
	$tb_data = $database->select($tb,$col);
	
	$count = count($tb_data);
	$total_pages = ceil($count/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count<$count_end){$count_end=$count;}
	$new_page=ceil(($count+1)/10);
	
	$txt = "<div class=\"box box-info\">";
	$txt .= "<div class=\"box-header\">";
	$txt .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_genxriseis(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη</button>";
	$txt .= "</div><div class=\"box-body table-responsive no-padding\">";
	$txt .= "<table class=\"table table-hover\">
	<tr class=\"info\">
	<td width=6%><a href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=90%><a href=\"#\" title=\"Όνομα\">Όνομα</a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($tb_data as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$txt .= "<tr>";
		$txt .= "<td><span class=\"label label-info\">".$i."</span></td>";
		$txt .= "<td>".$data["name"]."</td>";
		$txt .= "<td><button class=\"btn btn-xs btn-warning\" type=\"button\" onclick=\"form_genxriseis(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$txt .= "<td><button class=\"btn btn-xs btn-danger\" type=\"button\" onclick=\"formdel_genxriseis(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$txt .= "</tr>";
		}
	$i++;
	}
	$txt .= "</table></div><div class=\"box-footer\">";
	
	if($count!=0){
		$txt .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count.".";
	}else{
		$txt .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$txt .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_genxriseis(".$previous_page.")\"";}
	$txt .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_genxriseis(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_genxriseis(".$next_page.")\"";}
	$txt .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$txt .= "</ul></div></div>";
	
	return $txt;	
}
// ############################################### ΓΕΝΙΚΕΣ ΧΡΗΣΕΙΣ ΚΤΙΡΙΟΥ #########################################

// ############################################### ΧΡΗΣΕΙΣ ΚΤΙΡΙΟΥ #########################################
//Εκτύπωση πίνακα
function create_xriseisbld($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "vivliothiki_conditions_building";
	$col = "*";
	$tb_data = $database->select($tb,$col);
	
	$count = count($tb_data);
	$total_pages = ceil($count/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count<$count_end){$count_end=$count;}
	$new_page=ceil(($count+1)/10);
	
	$txt = "<div class=\"box box-info\">";
	$txt .= "<div class=\"box-header\">";
	$txt .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_xriseisbld(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη</button>";
	$txt .= "</div><div class=\"box-body table-responsive no-padding\">";
	$txt .= "<table class=\"table table-hover\">
	<tr class=\"info\">
	<td width=6%><a href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=45%><a href=\"#\" title=\"Κατηγορία χρήσης\">Κατηγορία</a></td>
	<td width=45%><a href=\"#\" title=\"Όνομα\">Όνομα</a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($tb_data as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$txt .= "<tr>";
		$txt .= "<td><span class=\"label label-info\">".$i."</span></td>";
			$category = $database->select("vivliothiki_conditions_general","name",array("id"=>$data["gen_id"]));
		$txt .= "<td>".$category[0]."</td>";
		$txt .= "<td>".$data["name"]."</td>";
		$txt .= "<td><button class=\"btn btn-xs btn-warning\" type=\"button\" onclick=\"form_xriseisbld(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$txt .= "<td><button class=\"btn btn-xs btn-danger\" type=\"button\" onclick=\"formdel_xriseisbld(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$txt .= "</tr>";
		}
	$i++;
	}
	$txt .= "</table></div><div class=\"box-footer\">";
	
	if($count!=0){
		$txt .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count.".";
	}else{
		$txt .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$txt .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_xriseisbld(".$previous_page.")\"";}
	$txt .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_xriseisbld(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_xriseisbld(".$next_page.")\"";}
	$txt .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$txt .= "</ul></div></div>";
	
	return $txt;	
}
// ############################################### ΧΡΗΣΕΙΣ ΚΤΙΡΙΟΥ #########################################

// ############################################### ΧΡΗΣΕΙΣ ΖΩΝΩΝ #########################################
//Εκτύπωση πίνακα
function create_xriseiszone($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "vivliothiki_conditions_zone";
	$col = "*";
	$tb_data = $database->select($tb,$col);
	
	$count = count($tb_data);
	$total_pages = ceil($count/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count<$count_end){$count_end=$count;}
	$new_page=ceil(($count+1)/10);
	
	$txt = "<div class=\"box box-info\">";
	$txt .= "<div class=\"box-header\">";
	$txt .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_xriseiszone(0,".$new_page.");\"><i class=\"fa fa-plus-circle\"></i> Προσθήκη</button>";
	$txt .= "</div><div class=\"box-body table-responsive no-padding\">";
	$txt .= "<table class=\"table table-hover\">
	<tr class=\"info\">
	<td width=6%><a href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=45%><a href=\"#\" title=\"Κατηγορία χρήσης\">Κατηγορία</a></td>
	<td width=45%><a href=\"#\" title=\"Όνομα\">Όνομα</a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($tb_data as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$txt .= "<tr>";
		$txt .= "<td><span class=\"label label-info\">".$i."</span></td>";
			$category = $database->select("vivliothiki_conditions_general","name",array("id"=>$data["gen_id"]));
		$txt .= "<td>".$category[0]."</td>";
		$txt .= "<td>".$data["name"]."</td>";
		$txt .= "<td><button class=\"btn btn-xs btn-warning\" type=\"button\" onclick=\"form_xriseiszone(".$data["id"].",".$page.");\"><i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$txt .= "<td><button class=\"btn btn-xs btn-danger\" type=\"button\" onclick=\"formdel_xriseiszone(".$data["id"].",".$page.");\"><i class=\"fa fa-times\"></i></button></td>";
		$txt .= "</tr>";
		}
	$i++;
	}
	$txt .= "</table></div><div class=\"box-footer\">";
	
	if($count!=0){
		$txt .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count.".";
	}else{
		$txt .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$txt .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_xriseiszone(".$previous_page.")\"";}
	$txt .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_xriseiszone(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_xriseiszone(".$next_page.")\"";}
	$txt .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$txt .= "</ul></div></div>";
	
	return $txt;	
}
// ############################################### ΧΡΗΣΕΙΣ ΖΩΝΩΝ #########################################



//Δέχεται τον πίνακα και το id και επιστρέφει σε json φορματ την array της γραμμής
//Καλείται με το πλήκτρο "επεξεργασία" για την φόρτωση των τιμών της γραμμής στα κελιά.
function get_id($table, $id){
	$database = new medoo(DB_NAME);
	$columns = "*";
	if($id!=0){
		$where=array("id"=>$id);
		$data = $database->select($table,$columns,$where);
	}else{
		$data = $database->select($table,$columns);
	}
	
	if(count($data)!=0){
		//επιστρέφει array για javascript
		return json_encode($data[0]);
	}
}

//Δέχεται τον πίνακα, την μεταβλητή action με τιμές create/update και το id και την $array τιμών
//Προσθέτει η κάνει update την array τιμών στις στήλες μετά το id
//Παρόμοια της insert_iddata στο function_meleti_general.php - Διαχείριση
function insert_id($table,$action,$id,$array){
	
	require("functions_interface.php");//check_input($value, $type)
	
	$database = new medoo(DB_NAME);
	$columns = "*";
	$return = "";
	
	$column_names = array_slice(get_columnnames($table), 1);
	
	if( count($column_names)==count($array) ){//Έλεγχος ότι οι στήλες είναι όσες οι τιμές που δηλώθηκαν. 
	
	$query = array();
	for($i=0; $i<count($column_names); $i++){
		if($array[$i]==""){$array[$i]=0;}
		$query[$column_names[$i]] = check_input($array[$i], "string");
	}
	
	if($action == "create" AND $id==0){
		$insert = $database->insert($table, $query);
		$return = "<div class=\"alert alert-success alert-dismissable\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				Επιτυχής προσθήκη</div>";
	}
	
	if($action == "update"){
		$where=array("id"=>$id);
		$update = $database->update($table, $query, $where);
		$return = "<div class=\"alert alert-warning alert-dismissable\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
			Επιτυχής επεξεργασία</div>";
	}
	
	}//Έλεγχος ισότητας array
	
	return $return;
}

//Δέχεται τον πίνακα και το id και διαγράφει την γραμμή που βρίσκεται το id
function del_id($table, $id){
	$columns = "*";
	$database = new medoo(DB_NAME);
	$where=array("id"=>$id);
	$data = $database->select($table,$columns,$where);
	
	if(count($data)!=0){
		$data_table = $database->delete($table,$where);
		return "<div class=\"alert alert-danger alert-dismissable\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				Επιτυχής διαγραφή</div>";
	}
}


?>