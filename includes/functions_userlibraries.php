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


//ajax call για την επιστροφή των ticket υποστήριξης - ΧΡΗΣΤΗΣ
if (isset($_GET['get_usertickets'])){
	$state = $_GET['state'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = get_usertickets($state);
	echo $tb;
	exit;
}
//ajax call για την εισαγωγή νέου ticket - ΧΡΗΣΤΗΣ
if (isset($_GET['insert_usertickets'])){
	$title = $_GET['title'];
	$text = $_GET['text'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = insert_usertickets($title,$text);
	echo $tb;
	exit;
}
//ajax call για τον σχολιασμό ticket - ΧΡΗΣΤΗΣ
if (isset($_GET['comment_usertickets'])){
	$id = $_GET['id'];
	$text = $_GET['text'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = comment_usertickets($id,$text);
	echo $tb;
	exit;
}
//ajax call για το κλείσιμο ticket - ΧΡΗΣΤΗΣ
if (isset($_GET['close_usertickets'])){
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = close_usertickets($id);
	echo $tb;
	exit;
}

//ajax call για την επιστροφή event για το ημερολόγιο - ΧΡΗΣΤΗΣ
if (isset($_GET['get_usercalendar'])){
	$start = $_GET['start'];
	$end = $_GET['end'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = get_usercalendar($start, $end);
	echo $tb;
	exit;
}
//ajax call για την επιστροφή τιμών μιας γραμμής - ΧΡΗΣΤΗΣ
if (isset($_GET['get_iddata_user'])){
	$type = $_GET['type'];
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = get_iddata_user($type, $id);
	echo $tb;
	exit;
}
//ajax call για την προσθήκη μιας γραμμής - ΧΡΗΣΤΗΣ
if (isset($_GET['insert_iddata_user'])){
	$type = $_GET['type'];
	$action = $_GET['action'];
	$id = $_GET['id'];
	$values = explode(",", $_GET['values']);
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = insert_iddata_user($type,$action,$id,$values);
	echo $tb;
	exit;
}
//ajax call για την διαγραφή μιας γραμμής - ΧΡΗΣΤΗΣ
if (isset($_GET['del_iddata_user'])){
	$type = $_GET['type'];
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = del_iddata_user($type, $id);
	echo $tb;
	exit;
}

if (isset($_GET['getusermaterials'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_user_materials($page);
	echo $tb;
	exit;
}
if (isset($_GET['getuseradiafani'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_user_adiafani($page);
	echo $tb;
	exit;
}
if (isset($_GET['getuserdiafani'])){
	$page = $_GET['page'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = create_user_diafani($page);
	echo $tb;
	exit;
}

if (isset($_GET['action']) AND $_GET['action']=="xhr" AND isset($_SERVER['HTTP_X_FILE_NAME'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require('uploadphp/class.upload.php');
	confirm_logged_in();
	
		// set variables
$dir_dest = "file_upload/server/php/files/user_".$_SESSION['user_id']."/";
$dir_pics = $dir_dest;
// ---------- XMLHttpRequest UPLOAD ----------
    // we first check if it is a XMLHttpRequest call
    if (isset($_SERVER['HTTP_X_FILE_NAME']) && isset($_SERVER['CONTENT_LENGTH'])) {

        // we create an instance of the class, feeding in the name of the file
        // sent via a XMLHttpRequest request, prefixed with 'php:'
        $handle = new Upload('php:'.$_SERVER['HTTP_X_FILE_NAME']);

    } else {
        // we create an instance of the class, giving as argument the PHP object
        // corresponding to the file field from the form
        // This is the fallback, using the standard way
        $handle = new Upload($_FILES['my_field']);
    }
	
	$return = "";

    // then we check if the file has been uploaded properly
    // in its *temporary* location in the server (often, it is /tmp)
    if ($handle->uploaded) {

        // yes, the file is on the server
        // now, we start the upload 'process'. That is, to copy the uploaded file
        // from its temporary location to the wanted location
        // It could be something like $handle->Process('/home/www/my_uploads/');
		// save uploaded image with a new name,
	   // resized to 100px wide
	   $handle->file_new_name_body = 'user_image';
	    $handle->file_overwrite = true;
	   $handle->image_resize = true;
	   $handle->image_convert = jpg;
	   $handle->image_x = 120;
	   $handle->image_ratio_y = true;
        $handle->Process($dir_dest);

        // we check if everything went OK
        if ($handle->processed) {
            // everything was fine !
            $return.= '<p class="result">';
            $return.= '  <b>Το αρχείο ανέβηκε με επιτυχία</b><br />';
            $return.= '  Εικόνα(' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB): <img src="includes/'.$dir_pics . $handle->file_dst_name . '">';
            $return.= '</p>';
        } else {
            // one error occured
            $return.= '<p class="result">';
            $return.= '  <b>Το αρχείο δεν ανέβηκε εκεί που πρέπει.</b><br />';
            $return.= '  Error: ' . $handle->error . '';
            $return.= '</p>';
        }

        // we delete the temporary files
        $handle-> Clean();

    } else {
        // if we're here, the upload file failed for some reasons
        // i.e. the server didn't receive the file
        $return.= '<p class="result">';
        $return.= '  <b>Το αρχείο δεν ανέβηκε στο server.</b><br />';
        $return.= '  Error: ' . $handle->error . '';
        $return.= '</p>';
    }
		
		
	echo $return;
}


require("include_check.php");
//require("functions_meleti_general.php");


//TICKETS ΥΠΟΣΤΗΡΙΞΗΣ ΧΡΗΣΤΗ
//Επιστροφη των ticket από τη βάση
//state: 1 ανοικτά, 2: κλειστά
function get_usertickets($state=0){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$col = "*";
	$tb_users= "core_users";
	$tb_tickets= "user_tickets";
	$tb_responses= "user_tickets_response";
	chdir("../");
	
	if($state==0){
		$where_user=array("user_id"=>$_SESSION['user_id']);
	}else{
		$where_user=array("AND"=>array("user_id"=>$_SESSION['user_id'],"state"=>$state));
	}
	
	
	$data_tickets = $database->select($tb_tickets,$col,$where_user);
	
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
				$txt.='<span class="text-muted pull-right"><i class="fa fa-clock-o" aria-hidden="true"></i> '.$response["datetime"].'</span>';
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
		$txt.='<input type="text" class="form-control input-sm" placeholder="Απαντήστε στο ticket" id="tickets_comment'.$ticket["id"].'">';
		$txt.='<div class="input-group-btn">';
		$txt.='<button type="button" class="btn btn-sm btn-success" onclick="comment_ticket('.$ticket["id"].');">Υποβολή απάντησης</button>';
		$txt.='<button type="button" class="btn btn-sm btn-danger" onclick="openmodal_closeticket('.$ticket["id"].');">Κλείσιμο ticket</button>';
		$txt.='</div>';//input-group-btn
		$txt.='</div>';//input-group
		
		$txt.='</div>';//img-push
		$txt.='</div>';
				
		$txt.='</div>';
	}
	
	return $txt;
}

//Εισαγωγή νέου ticket στη βάση
function insert_usertickets($title,$text){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$col = "*";
	$tb_users= "core_users";
	$tb_tickets= "user_tickets";
	
	date_default_timezone_set('Europe/Athens');
	$datetime = date("Y-m-d H:i:s");
	
	$insert_array=array(
		"user_id"=>$_SESSION['user_id'],
		"title"=>$title,
		"text"=>$text,
		"datetime"=>$datetime,
		"state"=>1
	);
	$insert = $database->insert($tb_tickets, $insert_array);
	
	$return = "<div class=\"alert alert-success alert-dismissable\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				Επιτυχής προσθήκη ticket</div>";
	
	return $return;
}

//Σχολιασμός ticket στη βάση
function comment_usertickets($id,$text){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$col = "*";
	$tb_users= "core_users";
	$tb_responses= "user_tickets_response";
	
	date_default_timezone_set('Europe/Athens');
	$datetime = date("Y-m-d H:i:s");
	
	$insert_array=array(
		"ticket_id"=>$id,
		"responder_id"=>$_SESSION['user_id'],
		"text"=>$text,
		"datetime"=>$datetime
	);
	$insert = $database->insert($tb_responses, $insert_array);
	
	$return = "<div class=\"alert alert-success alert-dismissable\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				Προσθέσατε ένα σχόλιο στο ticket.</div>";
	
	return $return;
}

//Κλείσιμο ticket στη βάση
function close_usertickets($id){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$col = "*";
	$tb_users= "core_users";
	$tb_tickets= "user_tickets";
	
	$update_array=array(
		"state"=>2
	);
	
	$where_ticket=array("AND"=>array("id"=>$id,"user_id"=>$_SESSION['user_id']));
	
	$update = $database->update($tb_tickets, $update_array, $where_ticket);
	
	$return = "<div class=\"alert alert-success alert-dismissable\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				Κλείσατε το ticket. Ελπίζουμε το θέμα να λύθηκε.</div>";
	
	return $return;
}




//ΗΜΕΡΟΛΟΓΙΟ ΧΡΗΣΤΗ
function get_usercalendar($start, $end){
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$columns = "*";
	$table_meletes = "user_meletes";
	$table_logs = "user_logs";
	$where_user=array("user_id"=>$_SESSION['user_id']);
	
	$data_meletes = $database->select($table_meletes,$columns,$where_user);
	$data_logs = $database->select($table_logs,$columns,$where_user);
	
	$events = array();
	foreach($data_meletes as $data){
		//$date=substr($event["datetime"], 0 , 10);//αρχή 0, μήκος 10, πχ 2017-12-19 12:00:00
		if($data["type"]==0){
			$color="red";
		}else{
			$color="yellow";
		}
		array_push($events, array("id"=>$data["id"],"title"=>$data["name"],"start"=>$data["datetime"],"allDay"=>"false","color"=>$color,"textColor"=>"black","address"=>$data["address"]));
	}
	
	foreach($data_logs as $logs){
		array_push($events, array("title"=>"Login from-".$logs["regIP"],"start"=>$logs["dt"],"allDay"=>"false","color"=>"green","textColor"=>"black","regIP"=>$data["regIP"]));
	}
	
	return json_encode($events);
}


//ΒΙΒΛΙΟΘΗΚΕΣ ΧΡΗΣΤΗ
//Δέχεται τον πίνακα και το id και επιστρέφει σε json φορματ την array της γραμμής
//Καλείται με το πλήκτρο "επεξεργασία" για την φόρτωση των τιμών της γραμμής στα κελιά.
function get_iddata_user($type, $id){
	if($type=="material"){$table="user_domika";}
	if($type=="adiafani"){$table="user_adiafani";}
	if($type=="diafani"){$table="user_diafani";}
	
	//Μόνο για τους 3 παραπάνω πίνακες του χρήστη
	if(isset($table)){
		$database = new medoo(DB_NAME);
		$columns = "*";
		if($id!=0){
			$where_user=array("AND"=>array("id"=>$id,"user_id"=>$_SESSION['user_id']));
		}else{
			$where_user=array("user_id"=>$_SESSION['user_id']);
		}
		$data_inuser = $database->select($table,$columns,$where_user);
	
		if(count($data_inuser)!=0){
			//επιστρέφει array για javascript
			return json_encode($data_inuser[0]);
		}
	}//Μόνο για 3 πίνακες του χρήστη
}

//ΒΙΒΛΙΟΘΗΚΕΣ ΧΡΗΣΤΗ
//Δέχεται τον πίνακα, την μεταβλητή action με τιμές create/update και το id και την $array τιμών
//Προσθέτει η κάνει update την array τιμών στις στήλες μετά το id,user_id
function insert_iddata_user($type,$action,$id,$array){
	
	$database = new medoo(DB_NAME);
	$columns = "*";	
	if($type=="material"){
		$table="user_domika";
		$query = array(
			"material"=>$array[0],
			"r"=>$array[1],
			"l"=>$array[2],
			"cp"=>$array[3],
			"m_dry"=>$array[4],
			"m_liquid"=>$array[5]
		);
	}
	if($type=="adiafani"){
		$table="user_adiafani";
		$query = array(
			"name"=>$array[0],
			"zwni"=>$array[1]
		);
	}
	if($type=="diafani"){
		$table="user_diafani";
		$query = array(
			"name"=>$array[0],
			"zwni"=>$array[1]
		);
	}
	
	$session_array=array("user_id"=>$_SESSION['user_id']);
	$query_update = $query;
	$query_insert=array_merge($session_array,$query);
	
	
	if($action == "create" AND $id==0){
		$insert = $database->insert($table, $query_insert);
		$return = "<div class=\"alert alert-success alert-dismissable\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				Επιτυχής προσθήκη</div>";
	}
	
	if($action == "update"){
		if($id!=0){
			$where_user=array("AND"=>array("id"=>$id,"user_id"=>$_SESSION['user_id']));
		}else{
			$where_user=array("user_id"=>$_SESSION['user_id']);
		}
		$data_inuser = $database->select($table,$columns,$where_user);
		
		if(count($data_inuser)!=0){
			$update = $database->update($table, $query_update, $where_user);
			$return = "<div class=\"alert alert-warning alert-dismissable\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				Επιτυχής επεξεργασία</div>";
		}
	
	}
	return $return;
}

//ΒΙΒΛΙΟΘΗΚΕΣ ΧΡΗΣΤΗ
//Δέχεται τον πίνακα και το id και διαγράφει την γραμμή που βρίσκεται το id
//Ελέγχει αν η γραμμή ανήκει στο συνδεδεμένο χρήστη πρώτα
function del_iddata_user($type, $id){
	
	$database = new medoo(DB_NAME);
	$columns = "*";	
	if($type=="material"){$table="user_domika";}
	if($type=="adiafani"){$table="user_adiafani";}
	if($type=="diafani"){$table="user_diafani";}
	$where_user=array("AND"=>array("id"=>$id,"user_id"=>$_SESSION['user_id']));
	$data_inuser = $database->select($table,$columns,$where_user);
	
	if(count($data_inuser)!=0){
		$where_id = array("id"=>$id);
		$data_table = $database->delete($table,$where_id);
		return "<div class=\"alert alert-danger alert-dismissable\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				Επιτυχής διαγραφή</div>";
	}
}

// ##################################################### ΥΛΙΚΑ ΧΡΗΣΤΗ ###############################################
//Εκτύπωση πίνακα ΥΛΙΚΑ ΧΡΗΣΤΗ
function create_user_materials($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "user_domika";
	$col = "*";
	$where=array("user_id"=>$_SESSION['user_id']);
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
	$txt .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_usermaterials(0,".$new_page.");\">
	<i class=\"fa fa-plus-circle\"></i> Προσθήκη νέου υλικού</button>";
	$txt .= "</div>";
	$txt .= "<div class=\"box-body table-responsive no-padding\">";
	$txt .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"info\">
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Ονομασία υλικού\">Ονομασία</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Πυκνότητα (Kg/m<sup>3</sup>)\">ρ (Kg/m<sup>3</sup>)</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Αντίσταση λ (W/m.K)\">λ (W/m.K)</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"cp (J/kg.K)\">cp (J/kg.K)</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"μ (ξηρό)\">μ (ξηρό)</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"μ (υγρό)\">μ (υγρό)</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($tb_data as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$txt .= "<tr>";
		$txt .= "<td><span class=\"label label-info\">".$i."</span></td>";
		$txt .= "<td>".$data["material"]."</td>";		
		$txt .= "<td>".$data["r"]."</td>";
		$txt .= "<td>".$data["l"]."</td>";
		$txt .= "<td>".$data["cp"]."</td>";
		$txt .= "<td>".$data["m_dry"]."</td>";
		$txt .= "<td>".$data["m_liquid"]."</td>";
		$txt .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_usermaterials(".$data["id"].",".$page.");\">
		<i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$txt .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_usermaterials(".$data["id"].",".$page.");\">
		<i class=\"fa fa-times\"></i></button></td>";
		$txt .= "</tr>";
		}
	$i++;
	}
	$txt .= "</table></div><div class=\"panel-footer\">";
	
	if($count!=0){
		$txt .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count." υλικών χρήστη.";
	}else{
		$txt .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$txt .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_usermaterials(".$previous_page.")\"";}
	$txt .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_usermaterials(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_usermaterials(".$next_page.")\"";}
	$txt .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$txt .= "</ul></div></div>";
	
	return $txt;	
}


// ##################################################### ΑΔΙΑΦΑΝΗ ΧΡΗΣΤΗ ###############################################
//Εκτύπωση πίνακα ΑΔΙΑΦΑΝΗ ΧΡΗΣΤΗ
function create_user_adiafani($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "user_adiafani";
	$col = "*";
	$where=array("user_id"=>$_SESSION['user_id']);
	$tb_data = $database->select($tb,$col,$where);
	$zone = array(
		0=>"Ζώνη Α",
		1=>"Ζώνη Β",
		2=>"Ζώνη Γ",
		3=>"Ζώνη Δ",
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
	$txt .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_useradiafani(0,".$new_page.");\">
	<i class=\"fa fa-plus-circle\"></i> Προσθήκη νέου υπ. αδιαφανών</button>";
	$txt .= "</div>";
	$txt .= "<div class=\"box-body table-responsive no-padding\">";
	$txt .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"info\">
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Ονομασία υπολογισμού\">Ονομασία υπολογισμού</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Κλιματική Ζώνη\">Ζώνη</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Στρώσεις υλικών\">Στρώσεις</a></td>
	<td width=20%><a class=\"tip-top\" href=\"#\" title=\"Συντελεστής θερμοπερατότητας\">U</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($tb_data as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$txt .= "<tr>";
		$txt .= "<td><span class=\"label label-info\">".$i."</span></td>";
		$txt .= "<td>".$data["name"]."</td>";
		$txt .= "<td>".$zone[$data["zwni"]]."</td>";
			$strwseis = explode("|", $data['paxos']);
			$count_str=0;
			foreach($strwseis as $strwsi){
				if($strwsi!=""){
					$count_str++;
				}
			}
		$txt .= "<td>".$count_str."</td>";
		$txt .= "<td>".$data["u"]."</td>";
		$txt .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_useradiafani(".$data["id"].",".$page.");\">
		<i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$txt .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_useradiafani(".$data["id"].",".$page.");\">
		<i class=\"fa fa-times\"></i></button></td>";
		$txt .= "</tr>";
		}
	$i++;
	}
	$txt .= "</table></div><div class=\"panel-footer\">";
	
	if($count!=0){
		$txt .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count." υπολογισμών αδιαφανών.";
	}else{
		$txt .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$txt .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_useradiafani(".$previous_page.")\"";}
	$txt .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_useradiafani(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_useradiafani(".$next_page.")\"";}
	$txt .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$txt .= "</ul></div></div>";
	
	return $txt;	
}

// ##################################################### ΔΙΑΦΑΝΗ ΧΡΗΣΤΗ ###############################################
//Εκτύπωση πίνακα ΔΙΑΦΑΝΗ ΧΡΗΣΤΗ
function create_user_diafani($page=1){
	
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "user_diafani";
	$col = "*";
	$where=array("user_id"=>$_SESSION['user_id']);
	$tb_data = $database->select($tb,$col,$where);
	$zone = array(
		0=>"Ζώνη Α",
		1=>"Ζώνη Β",
		2=>"Ζώνη Γ",
		3=>"Ζώνη Δ",
	);
	$array_uf=array(
		1=>7,
		2=>2.5,
		3=>2.8,
		4=>2.2,
		5=>2.0,
		6=>1.5,
		7=>2.4,
		8=>2,
		9=>1.7,
		10=>1.5
	);
	$array_type=array(
		0=>"Νέο",
		1=>"Ριζική ανακαίνιση"
	);
	$array_epafi=array(
		1=>"Κούφωμα σε αέρα",
		2=>"Γυάλινη πρόσοψη σε αέρα",
		3=>"Κούφωμα σε ΜΘΧ",
		4=>"Γυάλινη πρόσοψη σε ΜΘΧ"
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
	$txt .= "<button class=\"btn btn-info\" type=\"button\" onclick=\"form_userdiafani(0,".$new_page.");\">
	<i class=\"fa fa-plus-circle\"></i> Προσθήκη νέου υπ. αδιαφανών</button>";
	$txt .= "</div>";
	$txt .= "<div class=\"box-body table-responsive no-padding\">";
	$txt .= "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"info\">
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Αρίθμηση\">α/α</a></td>
	<td width=36%><a class=\"tip-top\" href=\"#\" title=\"Ονομασία υπολογισμού\">Ονομασία υπολογισμού</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Κλιματική Ζώνη\">Ζώνη</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Τύπος κτιρίου\">Τύπος</a></td>
	<td width=15%><a class=\"tip-top\" href=\"#\" title=\"Επαφή δομικών στοιχείων\">Επαφή</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Αριθμός ανοιγμάτων\">Αρ. ανοιγμάτων</a></td>
	<td width=10%><a class=\"tip-top\" href=\"#\" title=\"Uf\">Uf</a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για επεξεργασία\"><i class=\"fa fa-pencil-square-o\"></i></a></td>
	<td width=2%><a class=\"tip-top\" href=\"#\" title=\"Κλικ για διαγραφή\"><i class=\"fa fa-times\"></i></a></td>
	</tr>";
	
	$i=1;
	foreach($tb_data as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$txt .= "<tr>";
		$txt .= "<td><span class=\"label label-info\">".$i."</span></td>";
		$txt .= "<td>".$data["name"]."</td>";		
		$txt .= "<td>".$zone[$data["zwni"]]."</td>";
			$strwseis = explode("|", $data['a']);
			$count_str=0;
			foreach($strwseis as $strwsi){
				if($strwsi!=""){
					$count_str++;
				}
			}
		$txt .= "<td>".$array_type[$data["type"]]."</td>";
		$txt .= "<td>".$array_epafi[$data["epafi"]]."</td>";
		$txt .= "<td>".$count_str."</td>";
		$txt .= "<td>".$array_uf[$data["plaisio_uf"]]."</td>";
		$txt .= "<td><button class=\"btn btn-sm btn-warning\" type=\"button\" onclick=\"form_userdiafani(".$data["id"].",".$page.");\">
		<i class=\"fa fa-pencil-square-o\"></i></button></td>";
		$txt .= "<td><button class=\"btn btn-sm btn-danger\" type=\"button\" onclick=\"formdel_userdiafani(".$data["id"].",".$page.");\">
		<i class=\"fa fa-times\"></i></button></td>";
		$txt .= "</tr>";
		}
	$i++;
	}
	$txt .= "</table></div><div class=\"panel-footer\">";
	
	if($count!=0){
		$txt .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count." υπολογισμών διαφανών.";
	}else{
		$txt .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	$txt .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_userdiafani(".$previous_page.")\"";}
	$txt .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_userdiafani(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_userdiafani(".$next_page.")\"";}
	$txt .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$txt .= "</ul></div></div>";
	
	return $txt;	
}

?>