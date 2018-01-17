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

//αποθήκευση προτύπου
if (isset($_POST['saveprotypo'])){
		for($i=1;$i<=8;$i++){
		${"kef".$i} = str_replace("|^|","&",$_POST["kef".$i]);
		}
		define('INCLUDE_CHECK',true);
		require("medoo.php");
		require("session.php");
		confirm_logged_in();
	if(confirm_admin()){
		$tb = save_protypo($kef1,$kef2,$kef3,$kef4,$kef5,$kef6,$kef7,$kef8);
		echo $tb;
		exit;
	}
}

//αποθήκευση εντύπων
if (isset($_POST['savepentypa'])){
		for($i=1;$i<=3;$i++){
		${"entypo".$i} = str_replace("|^|","&",$_POST["entypo".$i]);
		}
		define('INCLUDE_CHECK',true);
		require("medoo.php");
		require("session.php");
		confirm_logged_in();
	if(confirm_admin()){
		$tb = save_entypa($entypo1,$entypo2,$entypo3);
		echo $tb;
		exit;
	}
}

//εκτύπωση πίνακα χρηστών
if (isset($_GET['get_allusers'])){
		$id = $_GET["id"];
		define('INCLUDE_CHECK',true);
		require("medoo.php");
		require("session.php");
		confirm_logged_in();
	if(confirm_admin()){
		$tb = get_allusers($id);
		echo $tb;
		exit;
	}
}

//επιστροφή στοιχείων χρήστη για χρήση σε json
if (isset($_GET['get_userdata'])){
		$id = $_GET["id"];
		define('INCLUDE_CHECK',true);
		require("medoo.php");
		require("session.php");
		confirm_logged_in();
	if(confirm_admin()){
		$tb = get_userdata($id);
		echo $tb;
		exit;
	}
}

//ενημέρωση στοιχείων χρήστη από json
if (isset($_GET['update_userdata'])){
		$action = $_GET['action'];
		$id = $_GET['id'];
		$values = explode("|", $_GET['values']);
		define('INCLUDE_CHECK',true);
		require("medoo.php");
		require("session.php");
		confirm_logged_in();
	if(confirm_admin()){
		$tb = update_userdata($action,$id,$values);
		echo $tb;
		exit;
	}
}

//ΔΙΑΓΡΑΦΗ ΧΡΗΣΤΗ από JSON
if (isset($_GET['delete_user'])){
		$id = $_GET['id'];
		define('INCLUDE_CHECK',true);
		require("medoo.php");
		require("session.php");
		confirm_logged_in();
	if(confirm_admin()){
		$tb = delete_user($id);
		echo $tb;
		exit;
	}
}

//Το αρχείο δεν εκτελείται μόνο του
require("include_check.php");
confirm_admin();


//αποθήκευση προτύπου
function save_protypo($kef1,$kef2,$kef3,$kef4,$kef5,$kef6,$kef7,$kef8){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "vivliothiki_teyxos";
	
	for($i=1;$i<=8;$i++){
	$update = $database->update($tb, array("text"=>${"kef".$i}), array("kefalaio"=>$i));
	}
	return "<div class=\"alert alert-znx\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
	Επιτυχής τροποποίηση προτύπου τεύχους όλων των μελετών</div>";
}

//αποθήκευση εντύπων
function save_entypa($entypo1,$entypo2,$entypo3){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "vivliothiki_entypa";
	
	for($i=1;$i<=3;$i++){
	$update = $database->update($tb, array("text"=>${"entypo".$i}), array("entypo"=>$i));
	}
	return "<div class=\"alert alert-znx\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
	Επιτυχής τροποποίηση εντύπων για όλους τους χρήστες</div>";
}

//επιστροφή πίνακα χρηστών
function get_allusers(){
	confirm_admin();
	//έναρξη επικοινωνίας με τη βάση
	$database = new medoo(DB_NAME);
	$user_table = "core_users";
	$db_columns = "*";
	$data_users = $database->select($user_table,$db_columns);
	$count_users = $database->count($user_table);
	
	$table="";
	$table.="<div class=\"panel panel-warning\">";
	$table.="<div class=\"panel-heading\">";
	$table.="<button class=\"btn btn-warning\" type=\"button\" onclick=modal_useredit(0);><i class=\"fa fa-user-plus\"></i> Προσθήκη νέου χρήστη</button>";
	$table.="<div class=\"pull-right\"><h6><span class=\"glyphicon glyphicon-eye-open\"></span> Πίνακας χρηστών</h6></div></div>";
	$table.="<div class=\"box-body table-responsive no-padding\">";
	$table.="<table class=\"table table-bordered table-condensed table-hover\">";
	$table.="<tr class=\"warning\" style=\"text-align:center;\">";
	$table.="<td width=5%>α/α</td>";
	$table.="<td width=10%>username</td>";
	$table.="<td width=10%>Ονοματεπώνυμο</td>";
	$table.="<td width=10%>Ειδικότητα</td>";
	$table.="<td width=10%>@</td>";
	$table.="<td width=10%>τηλ.</td>";
	$table.="<td width=10%>Μελέτες</td>";
	$table.="<td width=10%>Αρχή</td>";
	$table.="<td width=10%>Λήξη</td>";
	$table.="<td width=15%>Επεξεργασία</td></tr>";
	
	$i=1;
	foreach($data_users as $user){
		$table.= "<tr style=\"text-align:center;\">";
		$table.= "<td><span class=\"label label-default\">".$i."</span><span class=\"label label-default\">user.id=".$user["id"]."</span></td>";
		if($user["google_id"]!=""){
			$usr_icon = "<i class=\"fa fa-google\"></i>";
		}else{
			$usr_icon = "";
		}
		$table.= "<td>".$usr_icon." ".$user["usr"]."</td>";
		$table.= "<td>".$user["onoma"]." ".$user["epwnymo"]."</td>";
			$eidikotita_xristi = $database->select("core_eidikotitesmhx","name",array("id"=>$user["eidikotita"]));
		$table.= "<td>".$eidikotita_xristi[0]."</td>";
		$table.= "<td>".$user["email"]."</td>";
		$table.= "<td>".$user["tel"]."</td>";
		$meletes_xristi = $database->count("user_meletes",array("user_id"=>$user["id"]));
		$table.= "<td>".$meletes_xristi."/".$user["meletes_max"]."</td>";
		$table.= "<td>".$user["subscribtion_start"]."</td>";
		$table.= "<td>".$user["subscribtion_end"]."</td>";
		$table.= "<td>";
		$table.= "<div class=\"btn-group\">";
		$table.= "<a class=\"btn btn-default btn-sm\" role=\"button\" onclick=modal_useredit(".$user["id"].")><i class=\"fa fa-pencil-square-o\"></i> Επεξεργασία</a>";
		$table.= "<button class=\"btn btn-sm dropdown-toggle\" data-toggle=\"dropdown\">";
		$table.= "<span class=\"caret\"></span>";
		$table.= "</button>";
		$table.= "<ul class=\"dropdown-menu\">";
		$table.= "<li><a tabindex=\"1\" role=\"button\" onclick=modal_useredit(".$user["id"].")><i class=\"fa fa-pencil-square-o\"></i> Επεξεργασία</a></li>";
		$table.= "<li class=\"divider\"></li>";
		$table.= "<li><a tabindex=\"2\" onclick=modal_userdelete(".$user["id"].")><i class=\"fa fa-trash\"></i> Διαγραφή</a></li>";
		$table.= "</ul>";
		$table.= "</div></td>";
		$table.= "</tr>";
	$i++;
	}
	$table.= "</table></div><div class=\"panel-footer\">";
	$table.= "<div class=\"panel-footer\">";
	$table.= "Σύνολο χρηστών: ".$count_users;
	$table.= "</div></div>";
	
	return $table;
}

//επιστροφή στοιχείων χρήστη
function get_userdata($id){

	confirm_admin();
	$database = new medoo(DB_NAME);
	$columns = "*";
	$where=array("id"=>$id);
	$data = $database->select("core_users",$columns,$where);
	$return = $data[0];
	
	//επιστρέφει array για javascript
	return json_encode($return);
}

//ενημέρωση στοιχείων χρήστη
function update_userdata($action,$id,$values){
	
	confirm_admin();
	require("functions_salt.php");
	$database = new medoo(DB_NAME);
	$table = "core_users";
	$array = array();
	
		//τιμές
		$array["usr"] = $values[0];
		if($values[1]!=""){$array["pass"] = create_hash($values[1]);}
		if($values[2]!=""){$array["email"] = $values[2];}
		$array["onoma"] = $values[3];
		$array["epwnymo"] = $values[4];
		$array["eidikotita"] = $values[5];
		$array["address"] = $values[6];
		$array["address_x"] = $values[7];
		$array["address_y"] = $values[8];
		$array["address_z"] = $values[9];
		$array["tel"] = $values[10];
		$array["fax"] = $values[11];
		$array["taytotita"] = $values[12];
		$array["afm"] = $values[13];
		$array["meletes_max"] = $values[14];
		$array["subscribtion_start"] = $values[15];
		$array["subscribtion_end"] = $values[16];
		//$datetime = new DateTime();
		//$temp = $datetime->createFromFormat('Y-m-d H:i:s', $values[15]);
	
	if($action == "create" AND $id==0){
		$insert = $database->insert($table, $array);
		$return = "<div class=\"alert alert-success alert-dismissable\">
		<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>Επιτυχής προσθήκη χρήστη ".$array["usr"].". </div>";
	}
	
	if($action == "update" AND $id!=0){
		$update = $database->update($table, $array, array("id"=>$id) );
		$return = "<div class=\"alert alert-success alert-dismissable\">
		<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>Επιτυχής ενημέρωση χρήστη ".$array["usr"].". </div>";
	}

	return $return;
}

//Διαγραφή χρήστη
function delete_user($id){
	confirm_logged_in();
	confirm_admin();
	$database = new medoo(DB_NAME);
	$table = "core_users";
	
	if($id == APPLICATION_ADMIN_ID){
		$return = "<div class=\"alert alert-danger alert-dismissable\">
		<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>Δεν μπορεί να διαγραφεί ο διαχειριστής. </div>";
	}else{
	$delete = $database->delete($table, array("id"=>$id) );
		$return = "<div class=\"alert alert-danger alert-dismissable\">
		<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>Ο χρήστης διαγράφηκε επιτυχώς! </div>";
	}	
		return $return;
}
?>