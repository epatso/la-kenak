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
if(confirm_admin()){
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
	<h1>
	La-kenak
	<small>Διαχειριστής</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-black-tie"></i> Διαχειριστής</a></li>
	<li class="active">Βιβλιοθήκες</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- Main row -->
<div class="row">

	<div class="col-md-2">
			<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Βιβλιοθήκες</h4>
			Επεξεργασία βιβλιοθηκών λογισμικού. Μπορείτε να επεξεργαστείτε μόνο τις βιβλιοθήκες που δεν περιέχονται στις 
			διαθέσιμες ΤΟΤΕΕ. Όλα τα δεδομένα των ΤΟΤΕΕ θεωρούνται σταθερά και δεν αλλάζουν.
			</div>
	</div>
	
	<div class="col-md-10">
	<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab">Λειτουργία κτιρίου</a></li>
			<li><a href="#tabs-2" data-toggle="tab">Συντελεστές U</a></li>
			<li><a href="#tabs-3" data-toggle="tab">Κλιματικά δεδομένα</a></li>
			<li><a href="#tabs-4" data-toggle="tab">Σκιάσεις</a></li>
			<li><a href="#tabs-5" data-toggle="tab">Νομοθεσία</a></li>
			<li><a href="#tabs-6" data-toggle="tab">Υλικά</a></li>
		</ul>
		
		<div class="tab-content">
		
			<div class="tab-pane active" id="tabs-1">
				<div class="tab-pane active">
					<div class="tabbable tabs-left">
						<ul class="nav nav-tabs">
						<li class="active"><a href="#tab11" data-toggle="tab">Κατηγορίες χρήσεων</a></li>
						<li><a href="#tab12" data-toggle="tab">Χρήσεις κτιρίων</a></li>
						<li><a href="#tab13" data-toggle="tab">Χρήσεις ζωνών</a></li>
						</ul>

						<div class="tab-content">
							<div class="tab-pane active" id="tab11">
								<?php include("menu_admin_libraries_xriseis.php");?>
							</div><!--tab11-->
							<div class="tab-pane" id="tab12">
								<?php include("menu_admin_libraries_xriseisbld.php");?>
							</div><!--tab12-->
							<div class="tab-pane" id="tab13">
								<?php include("menu_admin_libraries_xriseiszone.php");?>
							</div><!--tab13-->
						</div><!--tab-content-->
						
					</div><!--"tabbable tabs-left-->
				</div><!--"tab inside-->	
			</div>
			<!--tabs-1-->
		
			<div class="tab-pane" id="tabs-2">
				<div class="tab-pane active">
					<div class="tabbable tabs-left">
						<ul class="nav nav-tabs">
						<li class="active"><a href="#tab21" data-toggle="tab">Απαιτήσεις</a></li>
						<li><a href="#tab22" data-toggle="tab">Κατακόρυφα</a></li>
						<li><a href="#tab23" data-toggle="tab">Οριζόντια</a></li>
						<li><a href="#tab24" data-toggle="tab">Διαφανή</a></li>
						<li><a href="#tab25" data-toggle="tab">U<sub>max</sub> (νέα)</a></li>
						<li><a href="#tab26" data-toggle="tab">U<sub>max</sub> (ριζικά αν.)</a></li>
						<li><a href="#tab27" data-toggle="tab">A/V</a></li>
						<li><a href="#tab28" data-toggle="tab">ΚΘΚ</a></li>
						<li><a href="#tab29" data-toggle="tab">U' Οριζόντια</a></li>
						<li><a href="#tab210" data-toggle="tab">U' Κατακόρυφα</a></li>
						<li><a href="#tab211" data-toggle="tab">a/e</a></li>
						<li><a href="#tab212" data-toggle="tab">Φέρων</a></li>
						</ul>

						<div class="tab-content">
							<div class="tab-pane active" id="tab21">
							
							</div><!--tab11-->
							<div class="tab-pane" id="tab22">
							
							</div><!--tab11-->
							<div class="tab-pane" id="tab23">
							
							</div><!--tab11-->
						</div><!--tab-content-->
						
					</div><!--"tabbable tabs-left-->
				</div><!--"tab inside-->
			</div>
			<!--tabs-2-->
			
			<div class="tab-pane" id="tabs-3">
		
			</div>
			<!--tabs-3-->
			
			<div class="tab-pane" id="tabs-4">
				<div class="tab-pane active">
					<div class="tabbable tabs-left">
						<ul class="nav nav-tabs">
						<li class="active"><a href="#tab41" data-toggle="tab">Ορίζοντα</a></li>
						<li><a href="#tab42" data-toggle="tab">Προβόλου</a></li>
						<li><a href="#tab43" data-toggle="tab">Αριστερά</a></li>
						<li><a href="#tab44" data-toggle="tab">Δεξιά</a></li>
						<li><a href="#tab45" data-toggle="tab">Περσίδες</a></li>
						</ul>

						<div class="tab-content">
							<div class="tab-pane active" id="tab41">
							
							</div><!--tab41-->
							<div class="tab-pane" id="tab42">
							
							</div><!--tab42-->
							<div class="tab-pane" id="tab43">
							
							</div><!--tab43-->
							<div class="tab-pane" id="tab44">
							
							</div><!--tab44-->
							<div class="tab-pane" id="tab45">
							
							</div><!--tab45-->
						</div><!--tab-content-->
						
					</div><!--"tabbable tabs-left-->
				</div><!--"tab inside-->
			</div>
			<!--tabs-4-->
			
			<div class="tab-pane" id="tabs-5">
		
			</div>
			<!--tabs-5-->
			
			<div class="tab-pane" id="tabs-6">
		
			</div>
			<!--tabs-6-->
	
		</div>
		<!--/tab-content-->
	
		</div>
		<!--/tabbable tabs-->
	</div>
	<!--/col-md-10-->
</div>
 <!-- /.row (main row) -->
	
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
}
?>