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
require("include_check.php");
//confirm_logged_in();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
	<h1>
	La-kenak
	<small>Βιβλιοθήκες Εξοικονομώ Ι</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-university"></i> Βιβλιοθήκες</a></li>
	<li class="active"> Εξοικονομώ Ι</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
<div class="col-md-12">		
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab">Επιλέξιμες παρεμβάσεις</a></li>
		</ul>
			
			<!--ΠΑΡΕΜΒΑΣΕΙΣ-->
			<div class="tab-content">
			<div class="tab-pane active" id="tabs-1">
			<?php
			/*
			//Με χρήση jtable μόνο για προβολή
			
				$ped="vivliothiki_paremvaseis";
				$dig="0|0|0|0|0|2";
				$tb_name="vivliothiki_paremvaseis";
				$tb_title = "Επιλέξιμες παρεμβάσεις στο πρόγραμμα εξοικονομώ κατ οίκον";
				$fields="fields: {
					id: {key: true,create: false,edit: false,list: false},
					category: {create: false,edit: false,list: true, title: 'Κατηγορία',width: '20%',listClass: 'center',options: 
						{
						'1':'1. Αντικατάσταση κουφωμάτων και συστημάτων σκίασης',
						'2':'2.Τοποθέτηση θερμομόνωσης στο κέλυφος του κτηρίου συμπεριλαμβανομένου του δώματος / στέγης και της πιλοτής',
						'3':'3.Αναβάθμιση συστήματος θέρμανσης και συστήματος παροχής ζεστού νερού χρήσης'
						}},
					subcategory: {create: false,edit: false,list: false, title: 'Υποκατηγορία',width: '20%',listClass: 'center'},
					name: {create: false,edit: false,list: true, title: 'Παρέμβαση',width: '25%',listClass: 'center'},
					desc: {create: false,edit: false,list: true, title: 'Περιγραφή',width: '25%',listClass: 'center'},
					value: {create: false,edit: false,list: true, title: '€',width: '10%',listClass: 'center'}		
				}";
				include('includes/jtable_nouser.php');
			*/
			
			//Με χρήση βιβλιοθήκης μόνο για προβολή
			//αρχείο functions_vivliothikes.php
			echo create_library_parembvaseis();	
			?>

			</div>
			<!--ΠΑΡΕΜΒΑΣΕΙΣ-->
			
	</div><!--tab content-->
			</div><!--tabs-->
</div><!--col-md-12-->
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->