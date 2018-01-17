<?php
// Αρχή συνεδρίας
session_start();
//Όνομα συνεδρίας
session_name('kenakv5');
// Το cookie έχει διάρκεια 2 εβδομάδων
session_set_cookie_params(2*7*24*60*60);
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

require("include_check.php");


function logged_in() {
	return isset($_SESSION['user_id']);
}

function confirm_logged_in() {
	if (!logged_in()) {
		redirect_to("index.php?nav=user_login");
	}
}

function meleti_isset() {
	return isset($_SESSION['meleti_id']);
}

function confirm_meleti_isset() {
	if (!meleti_isset()) {
		redirect_to("index.php?nav=user_login");
	}
}

function confirm_admin() {
	if(isset($_SESSION['username'])){
	if ($_SESSION['username']==APPLICATION_ADMIN AND $_SESSION['user_id']==APPLICATION_ADMIN_ID) {
		return true;
	}else{
		return false;
	}
	}else{
		return false;
	}
}

function die_if_not_admin() {
	if (!confirm_admin()) {
		redirect_to("index.php?nav=user_login");
	}
}
?>
