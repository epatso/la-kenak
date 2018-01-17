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

if (isset($_GET['save_senaria'])){
	$active = $_GET['active'];
	$perigrafi = $_GET['perigrafi'];
	$u = $_GET['u'];
	$thermp = $_GET['thermp'];
	$coldp = $_GET['coldp'];
	$znxp = $_GET['znxp'];
	$light = $_GET['light'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = meleti_save_senaria($active,$perigrafi,$u,$thermp,$coldp,$znxp,$light);
	echo $tb;
	exit;
}
if (isset($_GET['insert_senaria'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = meleti_insert_senaria();
	echo $tb;
	exit;
}

//Το αρχείο δεν εκτελείται μόνο του
require("include_check.php");

//Σώζει τα σενάρια
function meleti_save_senaria($active,$perigrafi,$u,$thermp,$coldp,$znxp,$light){

	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$tb = "meletes_senaria";
	$where_parameters=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$update_parameters = array();
	
	$update_parameters["active"]=$active;
	$update_parameters["perigrafi"]=$perigrafi;
	$update_parameters["u"]=$u;
	$update_parameters["thermp"]=$thermp;
	$update_parameters["coldp"]=$coldp;
	$update_parameters["znxp"]=$znxp;
	$update_parameters["light"]=$light;
	
	
	$update = $database->update($tb, $update_parameters, $where_parameters);
	return "<div class=\"alert alert-solar\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
	Επιτυχής αποθήκευση σεναρίων</div>";
}

//Δημιουργεί τυπικά σενάρια
function meleti_insert_senaria(){
	
}


?>