<?php
require("includes/session.php");//Συνεδρία χρήστη
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

//Να εμφανίζονται τα λάθη για να βλέπω τι συμβαίνει - ΟΣΟ ΔΙΑΡΚΕΙ ΤΟ DEVELOPMENT
//ini_set('display_errors',1); 
//error_reporting(E_ALL);
error_reporting(0);
//Αποθήκευση της χρονικής σήμανσης που ξεκινά να φορτώνει η σελίδα.
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;

//Ορίζω μια μεταβλητή μόνο στις σελίδες που βλέπει ο χρήστης.
// Τα αρχεία php εκτελούνται μόνο εκεί που ορίζεται το INCLUDE_CHECK.
//Έτσι πχ αν ζητήσει κάποιος στο browser το includes/medoo.php αυτό δεν εκτελείται.
define('INCLUDE_CHECK',true);

//Το αρχείο αυτό εκτελείται
require("includes/include_check.php");
//Σύνδεση με βάση δεδομένων
require("includes/medoo.php");

//Function του προγράμματος
require("includes/functions_salt.php");
require("includes/functions_interface.php");
require("includes/functions_math.php");
require("includes/functions_network.php");
require("includes/functions_calc.php");
require("includes/functions_skiaseis.php");
require("includes/functions_vivliothikes.php");
require("includes/functions_meleti_general.php");
require("includes/functions_meleti_gendata.php");
require("includes/functions_meleti_zone.php");
require("includes/functions_meleti_kelyfos.php");
require("includes/functions_meleti_systems.php");
require("includes/functions_xml.php");
require("includes/functions_dxf.php");
require("includes/functions_teyxos.php");
require("includes/update_teyxos.php");
require("includes/update_entypa.php");
require("includes/classes.php");
include("includes/forms_user.php");

//require("includes/update_teyxos.php");
//require("includes/update_entypa.php");
?>


<!DOCTYPE html>
<html>
<?php
//το header της σελίδας
include("pages/components/header_index.php");
?>
<body class="skin-green sidebar-mini fixed">
<div class="wrapper">
	<!-- map style -->
	<style>
		#mapCanvas {
		width: 100%;
		height: 400px;
		}
		#mapCanvas img {
		max-width: none;
		}
		#overmapdiv {
		position:absolute;
		left:30%;
		top: 60px;
		z-index:3;
	}
		
		#dialog-ktimatologio-link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
		#dialog-ktimatologio-link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
		ul#icons {margin: 0; padding: 0;}
		ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
		ul#icons span.ui-icon {float: left; margin: 0 4px;}
		
		li.ui-state-default.ui-state-hidden[role=tab]:not(.ui-tabs-active) {
		display: none;
		}
	</style>
<script type="text/javascript">
if ( window.self !== window.top ) {
    window.top.location.href=window.location.href;
}
</script>
	<!-- map style-->
	<?php

	//############### ΕΛΕΓΧΟΣ OFFLINE ################
	if(confirm_admin()){//Για διαχειριστή πάντα ανοικτό λογισμικό
		$offline=0;
	}else{//Για όλους τους άλλους check για online
		if($prefs_offline==1){//Κλειστό λογισμικό από ρύθμιση προτιμήσεων
			$offline=1;
		}else{//Ανοικτό λογισμικό από ρύθμιση προτιμήσεων
			$offline=0;
		}
	}
	//############### ΕΛΕΓΧΟΣ OFFLINE ################
	
	
	//############### ΜΕΝΟΥ ################
	//top bar
	include("pages/components/page_header.php");
	//Sidebar left
	include("pages/components/sidebar_left.php");
	//############### ΜΕΝΟΥ ################
	
	
	//############### ΦΟΡΤΩΣΗ ΣΕΛΙΔΩΝ ################
	if($offline!=1){//Ανοικτό λογισμικό
	//Όλη η εφαρμογή βρίσκεται στο αρχείο index.php
	//Ανάλογα με τιμή της μεταβλητής _GET["nav"] δηλαδή τη σελίδα που βλέπει ο χρήστης
	//γίνεται έλεγχος αν ο χρήστης είναι συνδεδεμένος ή/και έχει επιλέξει και μελέτη εργασίας. 
	//Κύριος χώρος φόρτωσης
	if (isset($_GET["nav"])){
	$filename = "pages/menu_".$_GET["nav"].".php";
		if(file_exists($filename)){
		include($filename);
		}else{
		include("pages/menu_404.php");
		}
	}else{
	include("pages/menu_index.php");
	}
	
	}else{//κλειστό λογισμικό
		include("pages/menu_user_login.php");
	}
	//############### ΦΟΡΤΩΣΗ ΣΕΛΙΔΩΝ ################

	//Υποσέλιδο
	include("pages/components/page_footer.php");
	
	//Sidebar right
	include("pages/components/sidebar_right.php");
	
	//Footer JS
	include("pages/components/footer_index.php");
	?>
</div>
<!-- ./wrapper -->
</body>
</html>