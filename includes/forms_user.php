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
//Το αρχείο δεν εκτελείται μόνο του
require("include_check.php");
$script = '';
date_default_timezone_set('Europe/Athens');
//Έλεγχος μήπως επανεκκινήθηκε ο browser και δεν υπάρχει το "να με θυμάσαι" cookie
if(isset($_SESSION['user_id']) && !isset($_COOKIE['kenakv5Remember']) && !$_SESSION['rememberMe']){
	// Εάν ο χρήστης είναι συνδεδεμένος, αλλά δεν υπάρχει το kenakv4Remember cookie (πχ επανεκιννήθηκε ο browser)
	// και δεν επιλέχθηκε το "να με θυμάσαι":

	// Καταστροφή της συνεδρίας
	$_SESSION = array();
	session_destroy();
	
}

//Φόρμα για logout
if(isset($_GET['logoff'])){
	$_SESSION = array();
	session_destroy();
	
	redirect_to("index.php?nav=user_logout");
}

//ΧΡΗΣΤΗΣ
//Φόρμα για σύνδεση
if(isset($_POST['submit']) AND $_POST['submit']=='Login'){
	
	$err = array();
	//Κρατάει τα λάθη
	
	
	if(!$_POST['username'] || !$_POST['password']){
		$err[] = 'Λείπει το όνομα χρήστη ή/και ο κωδικός!';
	}
	if(!count($err)){
		//Έλεγχος πριν την είσοδο στη βάση
		$_POST['username'] = $_POST['username'];
		$_POST['password'] = $_POST['password'];
		if(isset($_POST['rememberMe'])){
			$_POST['rememberMe'] = (int)$_POST['rememberMe'];
		}
		
		//Αυτή η γραμμή ελέγχει το χρήστη στη βάση δεδομένων
		//Για τη σύνδεση σε ήδη υπάρχουσες βάσεις δεδομένων με χρήστες μπορεί να γίνει το εξής:
		//1.Να ελέγχεται ο χρήστης στην βάση του la-kenak για αρχή. 
		//2.Εάν βρεθεί στη βάση του la-kenak να προχωράμε με το login
		//3.Εάν δεν βρεθεί να ελέγχεται ο χρήστης στην άλλη βάση. 
		//4.Εάν βρεθεί στην άλλη βάση να δημιουργείται μια γραμμή στον πίνακα core_users του la-kenak και να επανελέγχεται ο χρήστης στο la-kenak (οπότε θα προχωράει και με το login)
		//Αυτός ο τρόπος ευννοεί την ασφάλεια. Καθώς οι χρήστες κρατώνται μόνο στο la-kenak χωρίς να "κινδυνεύει" η λίστα χρηστών και οι ρυθμίσεις τους στην άλλη βάση. 
		//ΣΗΜΕΙΩΣΗ: Στο la-kenak όπως φαίνεται παρακάτω οι κωδικοί αποθηκεύονται με 256bit
		$database = new medoo(DB_NAME);

		$user_table = "core_users";
		$where_parameters = array ("usr" => $_POST['username']);
		$user_data = $database->select($user_table,"*",$where_parameters);
		
		//Πρέπει να επιστρέφει 1.
		$count_user = $database->count($user_table, $where_parameters);
		
		//Δεν βρέθηκε ο χρήστης
		if($count_user==0){
			$err[]='Το όνομα πρόσβασης είναι λανθασμένο. Διορθώστε το όνομα ή εάν δεν έχετε λογαριασμό χρησιμοποιήστε τη φόρμα εγγραφής.';
		}else{
			
			$correct_hash = $user_data[0]["pass"];
			$password = $_POST['password'];
			
			if(validate_password($password, $correct_hash)){
				$_SESSION['username']=$user_data[0]["usr"];
				$_SESSION['user_id'] = $user_data[0]["id"];
				if(isset($_POST['rememberMe'])){
					$_SESSION['rememberMe'] = $_POST['rememberMe'];
				}
				
				//Ορίζω δεδομένα στο cookie kenakv5Remember
				//Μπήκε στο session στην 1η γραμμή
				//setcookie('kenakv5Remember',$_POST['rememberMe']);
				
				$log_table = "user_logs";
				$dt = date("Y-m-d H:i:s");
				$ip = getRealIpAddr();
				$insert_parameters = array("user_id"=>$user_data[0]["id"],"regIP" => $ip,"dt" => $dt);
				$insert_ip = $database->insert($log_table,$insert_parameters);
				$err[]='Επιστρέψατε επιτυχώς στο la-kenak. Επιτυχής σύνδεση. ';
			}else{
				$err[]='Ο κωδικός πρόσβασης είναι λανθασμένος. Μήπως ξεχάσατε τον κωδικό; Επικοινωνήστε με το διαχειριστή. ';
			}	
		}
		
	}
	
	//Αποθήκευση των λαθών στο session
	if($err){
		$_SESSION['msg']['login-err'] = implode('<br />',$err);
	}
	//header("Location: index.php?nav=user_login");
	//exit;
}

//Φόρμα για εγγραφή
if(isset($_POST['submit']) AND $_POST['submit']=='Register'){//Υποβλήθηκε η φόρμα για εγγραφή
	
	$database = new medoo(DB_NAME);
	$user_table = "core_users";
	
	$where_email = array ("email" => $_POST['email']);
	$count_email = $database->count($user_table,$where_email);
	$where_usr = array ("usr" => $_POST['username']);
	$count_usr = $database->count($user_table,$where_usr);
	
	//$select_prefs = $database->select("core_preferences","*",array("id" => "1"));
	//$registration = $select_prefs[0]["registration"];
	//$meletes_max = $select_prefs[0]["meletes_max"];
	
	$dt_start = date("Y-m-d H:i:s");//ΤΩΡΑ
	$dt_end = date('Y-m-d H:i:s', strtotime('+1 year')); // timestamp 1 χρόνο μετά από ΤΩΡΑ
	
	$err = array();
	//Όνομα χρήστη από 4 έως 32 χαρακτήρες
	if(strlen($_POST['username'])<4 || strlen($_POST['username'])>32){
		$err[]='Το όνομα χρήστη πρέπει να είναι μεταξύ 4ων και 32 χαρακτήρων!';
	}
	//Όνομα χρήστη χωρίς αποδεκτούς χαρακτήρες
	if(preg_match('/[^a-z0-9\-\_\.]+/i',$_POST['username'])){
		$err[]='Το όνομα χρήστη περιέχει μη αποδεκτούς χαρακτήρες!';
	}
	//Αποδεκτό e-mail
	if(!checkEmail($_POST['email'])){
		$err[]='Το e-mail που δηλώσατε δεν είναι σωστό! Διορθώστε το e-mail σας και ξαναπροσπαθήστε. ';
	}
	//Βρέθηκε χρήστης με το ίδιο mail
	if($count_email>0){
		$err[]='Το e-mail που δηλώσατε χρησιμοποιείται ήδη. Επιλέξτε άλλο e-mail ή εάν έχετε ξεχάσει το λογαριασμό σας επικοινωνήστε με το διαχειριστή. ';
	}
	//Βρέθηκε χρήστης με το ίδιο username
	if($count_usr>0){
		$err[]='Το όνομα χρήστη που δηλώσατε χρησιμοποιείται ήδη. Επιλέξτε άλλο όνομα χρήστη ή εάν έχετε ξεχάσει το λογαριασμό σας επικοινωνήστε με το διαχειριστή. ';
	}
	//Ο χρήστης αποδέχεται τους όρους
	if(!isset($_POST['reg_terms'])){
		$err[]='Πρέπει να αποδεχθείτε τους όρους χρήσης του λογισμικού για να κάνετε χρήση ενός λογαριασμού. ';
	}
	
	//o 1ος κωδικός δεν είναι κενός
	if($_POST['pass1']=="" OR strlen($_POST['pass1'])<5){
		$err[]='Ο κωδικός (1ο κελί) δεν μπορεί να είναι κενός ή μικρότερος από 5 χαρακτήρες. ';
	}
	//o 2ος κωδικός δεν είναι κενός
	if($_POST['pass2']=="" OR strlen($_POST['pass2'])<5){
		$err[]='Ο κωδικός (2ο κελί) δεν μπορεί να είναι κενός ή μικρότερος από 5 χαρακτήρες. ';
	}
	//o 1ος κωδικός δεν είναι κενός
	if($_POST['pass1']!=$_POST['pass2']){
		$err[]='Οι 2 κωδικοί δεν μπορεί να είναι διαφορετικοί. Προσθέστε τον ίδιο κωδικό στα 2 κελιά. ';
	}
	
	
	if(!count($err)){//Δεν υπάρχουν λάθη - ΕΓΓΡΑΦΗ
		
		//Χώρος για εγγραφή χρηστών
		
		$insert_array = array();
		$insert_array["usr"] = $_POST['username'];
		$insert_array["pass"] = create_hash($_POST['pass1']);
		$insert_array["is_admin"] = "0";
		$insert_array["email"] = $_POST['email'];
		$insert_array["onoma"] = "";
		$insert_array["epwnymo"] = "";
		$insert_array["eidikotita"] = "1";
		$insert_array["address"] = "";
		$insert_array["address_x"] = "37";
		$insert_array["address_y"] = "22";
		$insert_array["address_z"] = "0";
		$insert_array["tel"] = "";
		$insert_array["fax"] = "";
		$insert_array["taytotita"] = "";
		$insert_array["afm"] = "";
		$insert_array["google_id"] = "";
		$insert_array["meletes_max"] = $prefs_meletes_max;
		$insert_array["subscribtion_start"] = $dt_start;
		$insert_array["subscribtion_end"] = $dt_end;
		
		$insert = $database->insert($user_table, $insert_array);
		
		$email_bd = "";
		$email_bd .= "Το e-mail αυτό είναι μια αυτοματοποιημένη ειδοποίηση για την εγγραφή σας στο ελεύθερο λογισμικό La-kenak.<br/>";
		$email_bd .= "Εάν δεν εγγραφήκατε εσείς επικοινωνήστε με τον διαχειριστή στο email.<br/>";
		$email_bd .= "Πλέον μπορείτε να συνδεθείτε στο La-kenak με τα εξής στοιχεία:<br/><br/>";
		$email_bd .= "Όνομα χρήστη: ".$_POST['username']."<br/>";
		$email_bd .= "Κωδικός χρήστη: ".$_POST['pass1']."<br/>";
		send_mail("la123@otenet.gr",$_POST['email'],"Welcome to La Kenak v.5.0",$email_bd);
		
		$err[]='Επιτυχής εγγραφή χρήστη '.$_POST['username'].'. Πλέον μπορείτε να συνδεθείτε. Ένα e-mail απεστάλη στο e-mail '.$_POST['email'].' που δηλώσατε. ';
		
	}else{
		$err[]='Δεν προχωρήσαμε στην εγγραφή σας στο λογισμικό καθώς υπήρχαν λάθη στη φόρμα εγγραφής. ';
	}

	if(count($err)){
		$_SESSION['msg']['reg-err'] = implode('<br /><br />',$err);
	}
	
	//header("Location: index.php?nav=user_login");
	//exit;
}


//Φόρμα για UPDATE στοιχείων χρήστη
if(isset($_POST['submit']) AND $_POST['submit']=='save-userpref'){
	$database = new medoo(DB_NAME);
	$db_table = "core_users";
	$update_parameters = array(
		"email" => $_POST['email'],
		"onoma" => $_POST['onoma'],
		"epwnymo" => $_POST['epwnymo'],
		"eidikotita" => $_POST['eidikotita'],
		"address" => $_POST['address'],
		"address_x" => $_POST['address_x'],
		"address_y" => $_POST['address_y'],
		"address_z" => $_POST['address_z'],
		"tel" => $_POST['tel'],
		"fax" => $_POST['fax'],
		"taytotita" => $_POST['taytotita'],
		"afm" => $_POST['afm']
		);
	$where_parameters = array ("id" => $_SESSION['user_id']);
	$update_user = $database->update($db_table,$update_parameters,$where_parameters);

	//header("Location: index.php?nav=user_preferences");
	//exit;
}


//Φόρμα για αλλαγή κωδικού
if(isset($_POST['submit']) AND $_POST['submit']=='update-password'){

	$err = array();

	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$newpassword1 = $_POST['newpassword1'];
	$newpassword2 = $_POST['newpassword2'];


	$database = new medoo(DB_NAME);
	$user_table = "core_users";
	$where = array("id"=>$_SESSION['user_id']);
	$user_data = $database->select($user_table,"*",$where);
	$count = $database->count($user_table, $where);

	$correct_hash = $user_data[0]["pass"];

	if($password1==$password2 AND $newpassword1==$newpassword2 AND $count==1){
		if(validate_password($password1, $correct_hash)){
			$new_pass = create_hash($newpassword1);
			$update_parameters = array("pass" => $new_pass);
			$update_user = $database->update($user_table,$update_parameters,$where);
			$err[]="Αλλάξατε τον κωδικό επιτυχώς. ";
		}else{
			$err[]="Ο παλιός κωδικός δεν είναι σωστός. Δεν μπορείτε να αλλάξετε τον κωδικό αν δεν θυμάστε τον παλιό. Ελέγξτε για κεφαλαία, ορθή γλώσσα.";
		}
	}else{
		if($password1!=$password2){
			$err[]="Ο παλιός κωδικός δεν ήταν ίδιος στα δύο κελιά.Παρακαλώ διορθώστε. ";
		}
		if($newpassword1!=$newpassword2){
			$err[]="Ο νέος κωδικός δεν ήταν ίδιος στα δύο κελιά. Παρακαλώ διορθώστε. ";
		}
	}
	
	if(count($err)){
		$_SESSION['msg']['pass-err'] = implode('<br />',$err);
	}	
//header("Location: index.php?nav=user_preferences");
//exit;
}


//Φόρμα για διαγραφή ΟΛΩΝ ΤΩΝ ΜΕΛΕΤΩΝ
if(isset($_POST['submit']) AND $_POST['submit']=='delete_meletesall'){
	//Κρατάει τα λάθη.
	$err = array();

	$database = new medoo(DB_NAME);
	$meleti_tables = array(
		"user_meletes",
		"meletes_anelkystires",
		"meletes_anemogenitries",
		"meletes_katanalwseis",
		"meletes_mthx",
		"meletes_mthx_adiafani",
		"meletes_mthx_dapeda",
		"meletes_mthx_diafani",
		"meletes_mthx_orofes",
		"meletes_oikad",
		"meletes_owners",
		"meletes_pv",
		"meletes_sith",
		"meletes_stoixeiadiastaseis",
		"meletes_stoixeiameleti",
		"meletes_stoixeiapea",
		"meletes_teyxos",
		"meletes_teyxos_p",
		"meletes_xwroi",
		"meletes_ydreysi",
		"meletes_zones",
		"meletes_zone_adiafani",
		"meletes_zone_dapeda",
		"meletes_zone_diafani",
		"meletes_zone_orofes",
		"meletes_zone_pathitika",
		"meletes_zone_sys_aerp",
		"meletes_zone_sys_coldd",
		"meletes_zone_sys_coldp",
		"meletes_zone_sys_coldt",
		"meletes_zone_sys_coldv",
		"meletes_zone_sys_light",
		"meletes_zone_sys_solar",
		"meletes_zone_sys_thermd",
		"meletes_zone_sys_thermp",
		"meletes_zone_sys_thermt",
		"meletes_zone_sys_thermv",
		"meletes_zone_sys_ygrd",
		"meletes_zone_sys_ygrp",
		"meletes_zone_sys_ygrt",
		"meletes_zone_sys_znxd",
		"meletes_zone_sys_znxp",
		"meletes_zone_sys_znxt",
		"meletes_zone_sys_znxv",
		"meletes_zone_thermo",
		"meletes_senaria",
		"meletes_entypa"
	);
	
	//κριτήριο διαγραφής ο χρήστης με το session
	$where_user_id = array("user_id" => $_SESSION['user_id']);
	
	//Επιλογή μελετών και διαγραφή φακέλων
	$select_meletes = $database->select("user_meletes","*",$where_user_id);
	foreach($select_meletes as $meleti){
		//διαγραφή από /PDF
		$filename = "pdf/user".$_SESSION['user_id']."-meleti".$meleti["id"]."-teyxos.pdf";
		if(file_exists($filename)){
		unlink($filename);
		}
		
		//Διαγραφή από φακέλους μελέτης
		$dirname = "includes/file_upload/server/php/files/user_".$_SESSION["user_id"]."/meleti_".$meleti["id"];
		if (!is_dir($dirname)) {
			closedir(opendir($dirname));
			rmdir($dirname);
		}
	}//για κάθε μελέτη
	
	foreach($meleti_tables as $table){
		$delete_meleti = $database->delete($table,$where_user_id);
	}//για κάθε πίνακα

	//διαγραφή session μελέτης
	if ( isset($_SESSION['meleti_id']) ){
		unset($_SESSION['meleti_id']);
	}

}

	
//ΜΕΛΕΤΕΣ
//Φόρμα για νέα μελέτη
if(isset($_POST['submit']) AND $_POST['submit']=='neameleti'){
	$database = new medoo(DB_NAME);
	$db_columns = "*";
	
	//Επιλογή χρήστη
	$table_users = "core_users";
	$where_user = array("id" => $_SESSION['user_id']);
	$select_user = $database->select($table_users,$db_columns,$where_user);
	
	//Όριο μελετών
	$count_meletes = $database->count("user_meletes",array("user_id"=>$_SESSION['user_id']));
	$meletes_max = $select_user[0]["meletes_max"];
	$meletes_left = $meletes_max-$count_meletes;
	if($meletes_left<0){$meletes_left=0;}
		
	//Συνδρομή
	$subscribtion_start = $select_user[0]["subscribtion_start"];
	$subscribtion_end = $select_user[0]["subscribtion_end"];
	//php >5.3
	$date1 = new DateTime($subscribtion_start);
	$date2 = new DateTime($subscribtion_end);
	$datenow = new DateTime();
	$subscribtion_days = $date2->diff($date1)->format("%a");
	$days_left = $date2->diff($datenow)->format("%a");
	if($days_left<0){$days_left=0;}
	
	//Έλεγχος αν ο χρήστης έχει δικαίωμα να προσθέσει μελέτη
	//Ο 1ος έλεγχος πραγματοποιείται με τον αριθμό των μελετών - 
	$priviledge=0;
	if($meletes_max<=1){//Αν οι μέγιστες μελέτες = 1 έλεγχος μόνο με αριθμό μελετών
		if($meletes_left>0){//έχουν απομείνει μελέτες
			$priviledge=1;
			$err[]="Προσθέσατε τη μελέτη που είχατε διαθέσιμη. ";
		}else{//δεν έχουν απομείνει μελέτες
			$priviledge=0;
			$err[]="Δε σας έχουν απομείνει άλλες μελέτες στο λογαριασμό. Δεν προστέθηκε η μελέτη. ";
		}
	}
	if($meletes_max>1){//Αν οι μέγιστες μελέτες >1 έλεγχος και με την ημερομηνία
		if($meletes_left>0){//έχουν απομείνει μελέτες
			if($days_left>0){//έχουν απομείνει μέρες συνδρομής
				$priviledge=1;
				$err[]="Είχατε διαθέσιμες μελέτες και διαθέσιμες μέρες στο λογαριασμό σας. Προστέθηκε μία μελέτη. ";
			}else{//δεν έχουν απομείνει μέρες συνδρομής
				$priviledge=0;
				$err[]="Είχατε διαθέσιμες μελέτες αλλά έχει παρέλθει η περιόδος χρήσης στο λογισμικό. Δεν προστέθηκε η μελέτη. ";
			}
		}else{//δεν έχουν απομείνει μελέτες
			$priviledge=0;
			$err[]="Δεν έχετε διαθέσιμες μελέτες. Ανεξάρτητα της περιόδου χρήσης στο λογισμικό δεν μπορείτε να προσθέσετε νέα μελέτη. Δεν προστέθηκε η μελέτη. ";
		}
	}
	
	if($priviledge!=0){
		$select_user = $database->select("core_users","*",array("id" => $_SESSION['user_id']));	
		$edra_x = $select_user[0]["address_x"];
		$edra_y = $select_user[0]["address_y"];
		$edra_z = $select_user[0]["address_z"];
		
		$db_table = "user_meletes";
		$db_columns = array ("id","name");
		$dt = date("Y-m-d H:i:s");
		$insert_parameters = array(
			"user_id" => $_SESSION['user_id'],
			"name" => $_POST['onoma_meletis'],
			"address_x" => $edra_x,
			"address_y" => $edra_y,
			"address_z" => $edra_z,
			"datetime"=>$dt);
		$select_parameters = array ("AND" => array("name" => $_POST['onoma_meletis'],"user_id" => $_SESSION['user_id']));
		
		//Εισαγωγή στη βάση
		$insert_meleti = $database->insert($db_table,$insert_parameters);
		//Επιλογή από τη βάση
		$select_meleti = $database->select($db_table,$db_columns,$select_parameters);

		//Επιλογή της μελέτης κατευθείαν με την δημιουργία της
		$_SESSION['meleti_id']=$select_meleti[0]["id"];
		$_SESSION['meleti_name']=$select_meleti[0]["name"];

		$insert_sessionids = array("user_id" => $_SESSION['user_id'],"meleti_id" => $select_meleti[0]["id"]);
		//Εισαγωγή πρόσθετων πινάκων (stoixeia_pea, stoixeia_meleti, stoixeia_diastaseis)
		$insert_stoixeiapea = $database->insert("meletes_stoixeiapea",$insert_sessionids);
		$insert_stoixeiamel = $database->insert("meletes_stoixeiameleti",$insert_sessionids);
		$insert_stoixeiadia = $database->insert("meletes_stoixeiadiastaseis",$insert_sessionids);
		$insert_stoixeiadia = $database->insert("meletes_senaria",$insert_sessionids);
		
		//Αρχεία μελέτης
		$folder="includes/file_upload/server/php/files/user_".$_SESSION["user_id"]."/meleti_".$_SESSION["meleti_id"];
		if (!is_dir($folder)) {
			mkdir($folder,0777, true);
			chmod($folder,0777);
		}
		
		$file = fopen($folder."/emptyfolder.txt","w");
		fwrite($file,"Empty userdata folder");
		fclose($file);
	}//υπάρχει δικαίωμα προσθήκης
	
	//Υπάρχουν μηνύματα για εμφάνιση.
	if(count($err)){
		$_SESSION['msg']['reg-err'] = implode('<br />',$err);
	}
	
}


//Φόρμα για Επιλογή μελέτης
if(isset($_GET['action']) AND $_GET['action']=='select_meleti'){
	$database = new medoo(DB_NAME);
	$table = "user_meletes";
	$columns = "*";

	//Έλεγχος ότι η μελέτη ανήκει όντως στο συνδεδεμένο χρήστη
	$where = array ("AND" => array("id" => $_GET['meleti_id'],"user_id" => $_SESSION['user_id']));
	$count = $database->count($table, $where);
	
	if($count==1){
		$_SESSION['meleti_id']=$_GET['meleti_id'];
		$select_meleti = $database->select($table,$columns,$where);
		$_SESSION['meleti_name']=$select_meleti[0]["name"];
		$err[]="Επιλέχθηκε μελέτη εργασίας. Μπορείτε τώρα να μεταβείτε στο μενού μελέτη. Ξεκινήστε από τις <a href=\"index.php?nav=meleti_general\">Γενικές ρυθμίσεις</a> ";
	}	

	//Υπάρχουν μηνύματα για εμφάνιση.
	if(count($err)){
		$_SESSION['msg']['login-err'] = implode('<br />',$err);
	}

}


//Φόρμα για διαγραφή μελέτης
if(isset($_GET['action']) AND $_GET['action']=='delete_meleti'){
	//Κρατάει τα λάθη.
	$err = array();

	$database = new medoo(DB_NAME);
	$db_table = "user_meletes";
	$meleti_tables = array(
		"meletes_anelkystires",
		"meletes_anemogenitries",
		"meletes_katanalwseis",
		"meletes_mthx",
		"meletes_mthx_adiafani",
		"meletes_mthx_dapeda",
		"meletes_mthx_diafani",
		"meletes_mthx_orofes",
		"meletes_oikad",
		"meletes_owners",
		"meletes_pv",
		"meletes_sith",
		"meletes_stoixeiadiastaseis",
		"meletes_stoixeiameleti",
		"meletes_stoixeiapea",
		"meletes_teyxos",
		"meletes_teyxos_p",
		"meletes_xwroi",
		"meletes_ydreysi",
		"meletes_zones",
		"meletes_zone_adiafani",
		"meletes_zone_dapeda",
		"meletes_zone_diafani",
		"meletes_zone_orofes",
		"meletes_zone_pathitika",
		"meletes_zone_sys_aerp",
		"meletes_zone_sys_coldd",
		"meletes_zone_sys_coldp",
		"meletes_zone_sys_coldt",
		"meletes_zone_sys_coldv",
		"meletes_zone_sys_light",
		"meletes_zone_sys_solar",
		"meletes_zone_sys_thermd",
		"meletes_zone_sys_thermp",
		"meletes_zone_sys_thermt",
		"meletes_zone_sys_thermv",
		"meletes_zone_sys_ygrd",
		"meletes_zone_sys_ygrp",
		"meletes_zone_sys_ygrt",
		"meletes_zone_sys_znxd",
		"meletes_zone_sys_znxp",
		"meletes_zone_sys_znxt",
		"meletes_zone_sys_znxv",
		"meletes_zone_thermo",
		"meletes_senaria",
		"meletes_entypa"
	);

	$db_columns = array ("id","user_id","name");
	$select_parameters = array ("AND" => array("id" => $_GET['meleti_id'],"user_id" => $_SESSION['user_id']));
	$delete_parameters = array("id" => $_GET['meleti_id']);
	$delete_parameters1 = array("meleti_id" => $_GET['meleti_id']);
	$select_meleti = $database->select($db_table,$db_columns,$select_parameters);

	//Ελεγχος για το αν όντως η μελέτη ανήκει στο συνδεδεμένο χρήστη.
	if ($select_meleti[0]["user_id"] == $_SESSION['user_id']){

	$delete_meleti = $database->delete($db_table,$delete_parameters);

		foreach($meleti_tables as $table){
		$delete_meleti1 = $database->delete($table,$delete_parameters1);
		}

		$filename = "pdf/user".$select_meleti[0]["user_id"]."-meleti".$_GET['meleti_id']."-teyxos.pdf";
		if(file_exists($filename)){
		unlink($filename);
		
		$dirname = "includes/file_upload/server/php/files/user_".$_SESSION["user_id"]."/meleti_".$_SESSION["meleti_id"];
		if (!is_dir($dirname)) {
			closedir(opendir($dirname));
			rmdir($dirname);
		}
				
		}
	}else{
	exit;
	}

	if (isset($_SESSION['meleti_id']) AND $_SESSION['meleti_id']==$_GET['meleti_id']){
		unset($_SESSION['meleti_id']);
		unset($_SESSION['meleti_name']);
	}

//header("Location: index.php?nav=user_login");
//exit;
}


//Φόρμα για αντιγραφή μελέτης
if(isset($_POST['submit']) AND $_POST['submit']=='copy_meleti'){
	//Κρατάει τα λάθη.
	$err = array();

	$database = new medoo(DB_NAME);
	$tb_meletes = "user_meletes";
	$tb_meletistoix = "meletes_stoixeiameleti";
	$tb_pea = "meletes_stoixeiapea";
	$tb_diastaseis = "meletes_stoixeiadiastaseis";
	$tb_zone_adiafani = "user_meletes";
	$col = "*";
	$where_user = array("id" => $_SESSION['user_id']);
	
	//Πηγή POST
	$source_meleti=$_POST['source_meleti'];
	//ΒΑΣΗ id=POST source_id
	$where_source = array ("AND" => array("id" => $source_meleti,"user_id" => $_SESSION['user_id']));
	
	//Στόχος POST
	$target_meleti=$_POST['target_meleti'];
	//ΒΑΣΗ id=POST target_id
	$where_target = array ("AND" => array("id" => $target_meleti,"user_id" => $_SESSION['user_id']));
	
	//Ονόματα μελετών
	$select_source = $database->select($tb_meletes,$col,$where_source);
	$source_meleti_name = $select_source[0]["name"];
	
	$select_target = $database->select($tb_meletes,$col,$where_target);
	$target_meleti_name = $select_target[0]["name"];
	
	//Αντιγραφή στοιχείων από πίνακα μελέτης USER_MELETES
	$update_meleti_params=array(
		"perigrafi"=>$select_source[0]["perigrafi"],
		"type"=>$select_source[0]["type"],
		"symptiksi"=>$select_source[0]["symptiksi"],
		"address"=>$select_source[0]["address"],
		"address_x"=>$select_source[0]["address_x"],
		"address_y"=>$select_source[0]["address_y"],
		"address_z"=>$select_source[0]["address_z"],
		"ktirio"=>$select_source[0]["ktirio"],
		"kaek"=>$select_source[0]["kaek"],
		"tmima"=>$select_source[0]["tmima"],
		"tmima_ar"=>$select_source[0]["tmima_ar"],
		"xrisi"=>$select_source[0]["xrisi"],
		"climate"=>$select_source[0]["climate"],
		"height"=>$select_source[0]["height"],
		"zone"=>$select_source[0]["zone"],
		"pros"=>$select_source[0]["pros"],
		"idioktitis"=>$select_source[0]["idioktitis"],
		"idio_kathestos"=>$select_source[0]["idio_kathestos"],
		"ypeythinos_type"=>$select_source[0]["ypeythinos_type"],
		"ypeythinos_name"=>$select_source[0]["ypeythinos_name"],
		"ypeythinos_tel"=>$select_source[0]["ypeythinos_tel"],
		"ypeythinos_mail"=>$select_source[0]["ypeythinos_mail"]
	);
	$update_meleti = $database->update($tb_meletes,$update_meleti_params,$where_target);
	
	
	//ΒΑΣΗ meleti_id=POST source_id και ΒΑΣΗ target_id=POST target_id
	$where_source2 = array ("AND" => array("meleti_id" => $source_meleti,"user_id" => $_SESSION['user_id']));
	$where_target2 = array ("AND" => array("meleti_id" => $target_meleti,"user_id" => $_SESSION['user_id']));
	
	//Αντιγραφή στοιχείων από πίνακα μελέτης meletes_stoixeiapea
	$select_source_pea = $database->select($tb_pea,$col,$where_source2);
	$update_pea_params=array(
		"type_u"=>$select_source_pea[0]["type_u"],
		"type_psi"=>$select_source_pea[0]["type_psi"],
		"percent"=>$select_source_pea[0]["percent"],
		"thermo_kat"=>$select_source_pea[0]["thermo_kat"],
		"prostasia"=>$select_source_pea[0]["prostasia"],
		"plaisio"=>$select_source_pea[0]["plaisio"],
		"per_plaisio"=>$select_source_pea[0]["per_plaisio"],
		"yalosi"=>$select_source_pea[0]["yalosi"],
		"aerismos"=>$select_source_pea[0]["aerismos"],
		"piges"=>$select_source_pea[0]["piges"],
		"synthikes"=>$select_source_pea[0]["synthikes"],
		"levels"=>$select_source_pea[0]["levels"],
		"typical_h"=>$select_source_pea[0]["typical_h"],
		"floor_h"=>$select_source_pea[0]["floor_h"],
		"ekthesi"=>$select_source_pea[0]["ekthesi"]
	);
	$update_pea = $database->update($tb_pea,$update_pea_params,$where_target2);
	
	//Αντιγραφή στοιχείων από πίνακα μελέτης meletes_stoixeiameleti
	$select_source_stoixeiamel = $database->select($tb_meletistoix,$col,$where_source2);
	$update_stoixeiamel_params=array(
		"sxedio"=>$select_source_stoixeiamel[0]["sxedio"],
		"odos"=>$select_source_stoixeiamel[0]["odos"],
		"apostaseis"=>$select_source_stoixeiamel[0]["apostaseis"],
		"u_t"=>$select_source_stoixeiamel[0]["u_t"],
		"u_yp"=>$select_source_stoixeiamel[0]["u_yp"],
		"u_dok"=>$select_source_stoixeiamel[0]["u_dok"],
		"u_syr"=>$select_source_stoixeiamel[0]["u_syr"],
		"u_dap"=>$select_source_stoixeiamel[0]["u_dap"],
		"u_or"=>$select_source_stoixeiamel[0]["u_or"],
		"u_an"=>$select_source_stoixeiamel[0]["u_an"],
		"therm_dap"=>$select_source_stoixeiamel[0]["therm_dap"],
		"therm_or"=>$select_source_stoixeiamel[0]["therm_or"],
		"therm_yp"=>$select_source_stoixeiamel[0]["therm_yp"],
		"therm_dok"=>$select_source_stoixeiamel[0]["therm_dok"],
		"therm_syr"=>$select_source_stoixeiamel[0]["therm_syr"],
		"therm_an"=>$select_source_stoixeiamel[0]["therm_an"],
		"therm_kat"=>$select_source_stoixeiamel[0]["therm_kat"],
		"therm_l"=>$select_source_stoixeiamel[0]["therm_l"]
	);
	$update_stoixeiamel = $database->update($tb_meletistoix,$update_stoixeiamel_params,$where_target2);
	
	//Αντιγραφή στοιχείων από πίνακα μελέτης meletes_stoixeiadiastaseis
	$select_source_diastaseis = $database->select($tb_diastaseis,$col,$where_source2);
	$update_diastaseis_params=array(
		"t_l"=>$select_source_diastaseis[0]["t_l"],
		"t_h"=>$select_source_diastaseis[0]["t_h"],
		"t_d"=>$select_source_diastaseis[0]["t_d"],
		"yp_l"=>$select_source_diastaseis[0]["yp_l"],
		"dok_h"=>$select_source_diastaseis[0]["dok_h"],
		"syr_l"=>$select_source_diastaseis[0]["syr_l"],
		"syr_h"=>$select_source_diastaseis[0]["syr_h"],
		"a"=>$select_source_diastaseis[0]["a"],
		"e"=>$select_source_diastaseis[0]["e"],
		"an_l"=>$select_source_diastaseis[0]["an_l"],
		"an_h"=>$select_source_diastaseis[0]["an_h"],
		"an_pod"=>$select_source_diastaseis[0]["an_pod"]
	);
	$update_diastaseis = $database->update($tb_diastaseis,$update_diastaseis_params,$where_target2);
	
	
	$err[] = "Αντιγράφηκαν τα δομικά στοιχεία της μελέτης:";
	$err[] = "<font color=\"red\">".$source_meleti_name."</font>";
	$err[] = "στη μελέτη:";
	$err[] = "<font color=\"blue\">".$target_meleti_name."</font>";
	
	//Υπάρχουν μηνύματα για εμφάνιση.
	if(count($err)){
		$_SESSION['msg']['login-err'] = implode('<br />',$err);
	}
}

//Σύνδεση μέσω GOOGLE_ID
// Η Google περνάει την παράμετρο "code" στο επιστρεφόμενο URL
if(isset($_GET['code'])) {
	
	//Εισαγωγή της class για σύνδεση με OAUTH2.0
	require_once('includes/google_auth/google-login-api.php');
	//Εύρεση των τιμών για την εφαρμογή (google - api)
	//$database = new medoo(DB_NAME);
	//$select_prefs = $database->select("core_preferences","*",array("id" => "1"));
	//$registration = $select_prefs[0]["registration"];
	//$Client_ID = $select_prefs[0]["Client_ID"];
	//$Client_Secret = $select_prefs[0]["Client_Secret"];
	//$Client_Redirect = $select_prefs[0]["Client_Redirect"];
	//$meletes_max = $select_prefs[0]["meletes_max"];
	try {
		$gapi = new GoogleLoginApi();
		
		// Get the access token 
		$data = $gapi->GetAccessToken($prefs_Client_ID, $prefs_Client_Redirect, $prefs_Client_Secret, $_GET['code']);
		
		// Get user information
		$user_info = $gapi->GetUserProfileInfo($data['access_token']);

		$user_email = $user_info["emails"][0]["value"];
		$user_google_id = $user_info["id"];
		$user_name = $user_info["name"]["givenName"];
		$user_surname = $user_info["name"]["familyName"];

		//Επιλογή του χρήστη από τη βάση αν έχει συνδεθεί στο παρελθόν
		$user_table = "core_users";
		$where_parameters = array ("google_id" => $user_google_id);
		$select_user = $database->select($user_table,"*",$where_parameters);
		$count_user = $database->count($user_table, $where_parameters);
		
		if($count_user==0){//Ο χρήστης google δεν υπάρχει στη βάση  - Προσθήκη πρώτα
			$err[]='Είναι η πρώτη φορά που συνδέεστε με το λογαριασμό σας Google Account. Δημιουργήθηκε ένας χρήστης στο la-kenak με βάση τα στοιχεία σας. ';
			
			$dt_start = date("Y-m-d H:i:s");//ΤΩΡΑ
			$dt_end = date('Y-m-d H:i:s', strtotime('+1 year')); // timestamp 1 χρόνο μετά από ΤΩΡΑ
			
			require_once("functions_salt.php");
			$insert_array = array();
			$insert_array["usr"] = $user_name;
			$insert_array["pass"] = create_hash($user_google_id);
			$insert_array["is_admin"] = "0";
			$insert_array["email"] = $user_email;
			$insert_array["onoma"] = $user_name;
			$insert_array["epwnymo"] = $user_surname;
			$insert_array["eidikotita"] = "1";
			$insert_array["address"] = "";
			$insert_array["address_x"] = "37";
			$insert_array["address_y"] = "22";
			$insert_array["address_z"] = "0";
			$insert_array["tel"] = "";
			$insert_array["fax"] = "";
			$insert_array["taytotita"] = "";
			$insert_array["afm"] = "";
			$insert_array["google_id"] = $user_google_id;
			$insert_array["meletes_max"] = $prefs_meletes_max;
			$insert_array["subscribtion_start"] = $dt_start;
			$insert_array["subscribtion_end"] = $dt_end;
			
			$insert = $database->insert($user_table, $insert_array);
			
			$select_user = $database->select($user_table,"*",$where_parameters);
			
		}else{//Ο χρήστης google βρέθηκε στη βάση
			$err[]='Ο χρήστης βρέθηκε. Χαιρόμαστε που επιστρέψατε και συνδεθήκατε ξανά με το λογαριασμό σας Google Account. ';
			
		}//Δε χρειάζεται να προσθέσω χρήστη - Υπάρχει ήδη
		if($err){
			$_SESSION['msg']['login-err'] = implode('<br />',$err);
		}
		
		//Ορίζω δεδομένα στο session
		$_SESSION['username']=$select_user[0]["usr"];
		$_SESSION['user_id'] = $select_user[0]["id"];
		$_SESSION['rememberMe'] = "1";
		//Ορίζω δεδομένα στο cookie kenakv5Remember
		setcookie('kenakv5Remember',"1");
			
		//Καταγραφή στο log table
		$log_table = "user_logs";
		$dt = date("Y-m-d H:i:s");
		$ip = getRealIpAddr();
		$insert_parameters = array("user_id"=>$select_user[0]["id"],"regIP" => $ip,"dt" => $dt);
		$insert_ip = $database->insert($log_table,$insert_parameters);

		//header('Location: index.php?nav=user_login');
	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}



?>
