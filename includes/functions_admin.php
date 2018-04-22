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


//ΣΥΣΤΗΜΑ ΥΠΟΣΤΗΡΙΞΗΣ
//ajax call για την επιστροφή των ticket υποστήριξης - ΔΙΑΧΕΙΡΙΣΤΗΣ
if (isset($_GET['get_admin_tickets'])){
	$state = $_GET['state'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	if(confirm_admin()){
		$tb = get_admintickets($state);
		echo $tb;
		exit;
	}
}
//ajax call για τον σχολιασμό ticket - ΔΙΑΧΕΙΡΙΣΤΗΣ
if (isset($_GET['admintickets_comment'])){
	$id = $_GET['id'];
	$text = $_GET['text'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	if(confirm_admin()){
		$tb = admintickets_comment($id,$text);
		echo $tb;
		exit;
	}
}
//ajax call για την εναλλαγή ticket - ΔΙΑΧΕΙΡΙΣΤΗΣ
if (isset($_GET['admintickets_toggle'])){
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	if(confirm_admin()){
		$tb = admintickets_toggle($id);
		echo $tb;
		exit;
	}
}
//ajax call για την διαγραφή σχολίου ενός ticket - ΔΙΑΧΕΙΡΙΣΤΗΣ
if (isset($_GET['admintickets_delcomment'])){
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	if(confirm_admin()){
		$tb = admintickets_delcomment($id);
		echo $tb;
		exit;
	}
}
//ajax call για στατιστικά - ΔΙΑΧΕΙΡΙΣΤΗΣ
if (isset($_GET['admintickets_stats'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	if(confirm_admin()){
		$tb = admintickets_stats();
		echo $tb;
		exit;
	}
}

//ΤΕΥΧΗ - ΕΝΤΥΠΑ
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

//ΧΡΗΣΤΕΣ
//εκτύπωση πίνακα χρηστών
if (isset($_GET['get_allusers'])){
		//$id = $_GET["id"];
		define('INCLUDE_CHECK',true);
		require("medoo.php");
		require("session.php");
		confirm_logged_in();
	if(confirm_admin()){
		$tb = get_allusers();
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


//ΣΥΣΤΗΜΑ ΥΠΟΣΤΗΡΙΞΗΣ - ΔΙΑΧΕΙΡΙΣΤΗΣ
//Επιστροφη των ticket από τη βάση - ΔΙΑΧΕΙΡΙΣΤΗΣ
//state: 1 ανοικτά, 2: κλειστά
function get_admintickets($state=0){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$col = "*";
	$tb_users= "core_users";
	$tb_tickets= "user_tickets";
	$tb_responses= "user_tickets_response";
	chdir("../");
	
	if($state==0){
		$data_tickets = $database->select($tb_tickets,$col);
	}else{
		$where=array("state"=>$state);
		$data_tickets = $database->select($tb_tickets,$col,$where);
	}
	
	
	$txt="";
	
	$array_state=array(
		1=>'<i class="fa fa-envelope-open-o" aria-hidden="true"></i> Ανοικτό',
		2=>'<i class="fa fa-envelope-o" aria-hidden="true"></i> Κλειστό'
	);
	$array_state_class=array(
		1=>'badge bg-red',
		2=>'badge bg-green'
	);
	$array_state_color=array(
		1=>'red',
		2=>'green'
	);
	$array_state_img=array(
		1=>'',
		2=>'<i class="fa fa-thumbs-o-up" aria-hidden="true"></i>'
	);
	
	foreach($data_tickets as $ticket){
		$txt.='<div class="box box-widget collapsed-box">';
		$txt.='<div class="box-header with-border">';
		$txt.='<div class="user-block">';
		
			$user_image_location = "includes/file_upload/server/php/files/user_".$_SESSION['user_id']."/user_image.jpg";
			if(file_exists($user_image_location)){
				$txt.='<img class="img-circle" src="'.$user_image_location.'" alt="User Image">';
			}else{
				$txt.='<img class="img-circle" src="dist/img/avatar5.png" alt="User Image">';
			}
		$txt.='<span class="username"><font color="'.$array_state_color[$ticket["state"]].'">'.$ticket["title"].' '.$array_state_img[$ticket["state"]].'</font></span>';
			$user_data=$database->select($tb_users,$col,array("id"=>$ticket["user_id"]));
		$txt.='<span class="description">Δημιουργήθηκε από: ';
		$txt.=$user_data[0]["usr"].' - '.$user_data[0]["onoma"].' '.$user_data[0]["epwnymo"].'</span>';
		$txt.='</div>';
		
			$where_responses=array("ticket_id"=>$ticket["id"]);
			$data_responses = $database->select($tb_responses,$col,$where_responses);
			$count_responses = $database->count($tb_responses,$where_responses);
		
		$txt.='<div class="box-tools">';
		$txt.='<span class="label label-default"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$ticket["datetime"].'</span> ';
		$txt.='<span class="label label-primary"><i class="fa fa-reply" aria-hidden="true"></i> '.$count_responses.'</span> ';
		$txt.='<span class="'.$array_state_class[$ticket["state"]].'">'.$array_state[$ticket["state"]].'</span> ';
		$txt.='<button type="button" class="btn btn-box-tool" data-widget="collapse">';
		$txt.='<i class="fa fa-plus"></i>';
		$txt.='</button>';
		$txt.='</div>';
		$txt.='</div>';
				
		$txt.='<div class="box-body" style="display:none;">';
		$txt.='<p>'.$ticket["text"].'</p>';
		$txt.='</div>';
			
		$txt.='<div class="box-footer box-comments" style="display:none;">';
			
			if($count_responses>0){
			foreach($data_responses as $response){
				$txt.='<div class="box-comment">';
					$responder_image_location = "includes/file_upload/server/php/files/user_".$response["responder_id"]."/user_image.jpg";
					if(file_exists($responder_image_location)){
						$txt.='<img class="img-circle img-sm" src="'.$responder_image_location.'" alt="User Image">';
					}else{
						$txt.='<img class="img-circle img-sm" src="dist/img/avatar5.png" alt="User Image">';
					}

				$txt.='<div class="comment-text">';
					$responder_data=$database->select($tb_users,$col,array("id"=>$response["responder_id"]));
				$txt.='<span class="username">'.$responder_data[0]["usr"].' - '.$responder_data[0]["onoma"].' '.$responder_data[0]["epwnymo"];
				$txt.='<span class="text-muted pull-right">';
				$txt.='<i class="fa fa-clock-o" aria-hidden="true"></i> '.$response["datetime"].' ';
				$txt.='<a href="#" onclick="admintickets_delcomment('.$response["id"].');"><i class="fa fa-trash" aria-hidden="true"></i> Διαγραφή</a>';
				$txt.='</span>';
				$txt.='</span>';
				$txt.=$response["text"];
				$txt.='</div>';
				$txt.='</div>';
			}
			}else{
				$txt.='Δεν υπάρχουν απαντήσεις. Σύντομα θα απαντήσει κάποιος διαχειριστής.';
			}
				
		$txt.='</div>';
			
		$txt.='<div class="box-footer" style="display:none;">';
			if(file_exists($user_image_location)){
				$txt.='<img class="img-responsive img-circle img-sm" src="'.$user_image_location.'" alt="Alt Text">';
			}else{
				$txt.='<img class="img-responsive img-circle img-sm" src="dist/img/avatar5.png" alt="Alt Text">';
			}
		
		$txt.='<div class="img-push">';
		
		$txt.='<div class="input-group">';
		$txt.='<input type="text" class="form-control input-sm" placeholder="Απαντήστε στο ticket" id="admintickets_comment'.$ticket["id"].'">';
		$txt.='<div class="input-group-btn">';
		$txt.='<button type="button" class="btn btn-sm btn-success" onclick="admintickets_comment('.$ticket["id"].');">Υποβολή απάντησης</button>';
		$txt.='<button type="button" class="btn btn-sm btn-warning" onclick="admintickets_toggle('.$ticket["id"].');">Εναλλαγή κατάστασης</button>';
		$txt.='</div>';//input-group-btn
		$txt.='</div>';//input-group
		
		$txt.='</div>';//img-push
		$txt.='</div>';
				
		$txt.='</div>';
	}
	
	return $txt;
}

//Σχολιασμός ticket στη βάση - ΔΙΑΧΕΙΡΙΣΤΗΣ
function admintickets_comment($id,$text){
	confirm_logged_in();
	
	require("functions_interface.php");//check_input($value, $type)
	
	$database = new medoo(DB_NAME);
	$col = "*";
	$tb_users= "core_users";
	$tb_responses= "user_tickets_response";
	
	date_default_timezone_set('Europe/Athens');
	$datetime = date("Y-m-d H:i:s");
	
	$insert_array=array(
		"ticket_id"=>$id,
		"responder_id"=>$_SESSION['user_id'],
		"text"=>check_input($text, "string"),
		"datetime"=>$datetime
	);
	$insert = $database->insert($tb_responses, $insert_array);
	
	$return = "<div class=\"alert alert-success alert-dismissable\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				Προσθέσατε ένα σχόλιο στο ticket. Τώρα ο χρήστης μπορεί να το δεί. </div>";
	
	return $return;
}

//Εναλλαγή ticket στη βάση - ΔΙΑΧΕΙΡΙΣΤΗΣ
function admintickets_toggle($id){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$col = "*";
	$tb_users= "core_users";
	$tb_tickets= "user_tickets";
	$where_ticket=array("id"=>$id);
	
	$select = $database->select($tb_tickets, $col, $where_ticket);
	$state=$select[0]["state"];
	if($state==1){
		$update_array=array("state"=>2);
	}
	if($state==2){
		$update_array=array("state"=>1);
	}
	
	
	$update = $database->update($tb_tickets, $update_array, $where_ticket);
	
	$return = "<div class=\"alert alert-success alert-dismissable\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				Η κατάσταση του ticket άλλαξε.</div>";
	
	return $return;
}

//Διαγραφή σχολίου από ticket - ΔΙΑΧΕΙΡΙΣΤΗΣ
function admintickets_delcomment($id){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$col = "*";
	$tb_responses= "user_tickets_response";
	
	$where_comment=array("id"=>$id);
	$delete = $database->delete($tb_responses, $where_comment);
	
	$return = "<div class=\"alert alert-danger alert-dismissable\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				Διαγράφηκε η απάντηση στο συγκεκριμένο ticket.</div>";
	
	return $return;
}

//Στατιστικά ticket - ΔΙΑΧΕΙΡΙΣΤΗΣ
function admintickets_stats(){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb_tickets= "user_tickets";
	$where_open=array("state"=>1);
	$where_close=array("state"=>2);
	$count_open = $database->count($tb_tickets,$where_open);
	$count_close = $database->count($tb_tickets,$where_close);
	$count_total = $count_open + $count_close;
	
	$return=array($count_total,$count_open,$count_close);
	return json_encode($return);
}


//ΤΕΥΧΗ - ΕΝΤΥΠΑ
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

//ΧΡΗΣΤΕΣ
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
	require("functions_salt.php");//create_hash($value)
	require("functions_interface.php");//check_input($value, $type)
	
	$database = new medoo(DB_NAME);
	$table = "core_users";
	$array = array();
	
		//τιμές
		$array["usr"] = check_input($values[0], "string");
		if($values[1]!=""){$array["pass"] = create_hash($values[1]);}
		if($values[2]!=""){$array["email"] = check_input($values[2], "email");}
		$array["onoma"] = check_input($values[3], "string");
		$array["epwnymo"] = check_input($values[4], "string");
		$array["eidikotita"] = check_input($values[5], "integer");
		$array["address"] = check_input($values[6], "string");
		$array["address_x"] = check_input($values[7], "string");
		$array["address_y"] = check_input($values[8], "string");
		$array["address_z"] = check_input($values[9], "string");
		$array["tel"] = check_input($values[10], "integer");
		$array["fax"] = check_input($values[11], "integer");
		$array["taytotita"] = check_input($values[12], "string");
		$array["afm"] = check_input($values[13], "integer");
		$array["meletes_max"] = check_input($values[14], "integer");
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