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
	<small>Σκιάσεις</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-university"></i> Βιβλιοθήκες</a></li>
	<li class="active"> Σκιάσεις</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
	<div class="col-md-12">	
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs-1" data-toggle="tab">Ορίζοντα</a></li>
				<li><a href="#tabs-2" data-toggle="tab">Προβόλου/Τέντας</a></li>
				<li><a href="#tabs-3" data-toggle="tab">Περσίδων</a></li>
				<li><a href="#tabs-4" data-toggle="tab">Από αριστερά</a></li>
				<li><a href="#tabs-5" data-toggle="tab">Από δεξιά</a></li>
				<li><a href="#tabs-6" data-toggle="tab">Από δεξιά και αριστερά</a></li>
			</ul>
			
		<div class="tab-content">
			<div class="tab-pane active" id="tabs-1">
			<img src="images/shading/orizontas.png" height="180px"><br/>
			<?php
			echo create_library_shading("hor");
			?>
			</div>
			
			<div class="tab-pane" id="tabs-2">
			<img src="images/shading/provolos.png" height="180px"><br/>
			<?php
			echo create_library_shading("ov");
			?>
			</div>
			
			<div class="tab-pane" id="tabs-3">
			<img src="images/shading/persides.png" height="180px"><br/>
			<?php
			echo create_library_shading("per");
			?>
			</div>
			
			<div class="tab-pane" id="tabs-4">
			<img src="images/shading/pleyrika_left.png" height="180px"><br/>
			<?php
			echo create_library_shading("left");
			?>
			</div>
			
			<div class="tab-pane" id="tabs-5">
			<img src="images/shading/pleyrika.png" height="180px"><br/>
			<?php
			echo create_library_shading("right");
			?>
			</div>
			
			<div class="tab-pane" id="tabs-6">
			<img src="images/shading/pleyrika_2.png" height="180px"><br/>
			Στην περίπτωση σκίασης από 2 πλευρικά εμπόδια οι συντελεστές σκίασης για τις περιόδους θέρμανσης και ψύξης προκύπτουν ως γινόμενο των 
			συντελεστών σκίασης από αριστερό εμπόδιο και από δεξί εμπόδιο (πχ F_fin_h=F_fin_h_left * F_fin_h_right). Χρησιμοποιούνται δηλαδή και οι δύο πίνακες των πλευρικών εμποδίων:
			<ul>
			<li>Πίνακας σκίασης από αριστερές πλευρικές προεξοχές: Πίνακας 3.20a της ΤΟΤΕΕ 20701-1.</li>
			<li>Πίνακας σκίασης από δεξιές πλευρικές προεξοχές: Πίνακας 3.20b της ΤΟΤΕΕ 20701-1. </li>
			</ul>
			</div>
			
			
			<script>
			function create_chart_shade(pros, from){
				
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_create_image.php?getchart_shade=1&pros="+pros+"&from="+from ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("shade_modal_body").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
				}}
				
				$("#modal_shade").modal("show");
			}
			</script>
			<!-- ###################### Κρυφό modal_climate για εμφάνιση ###################### -->
			<div id="modal_shade" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h6 id="myModalLabel">Εμφάνιση μεταβολής σκίασης σε σχέση με τη γωνία</h6>
				</div>

				<div class="modal-body">
				<span id="shade_modal_body"></span>
				</div>	
				
				<div class="modal-footer">	
					<button class="btn" data-dismiss="modal" aria-hidden="true">OK</button>
				</div>
				</div>
			</div>
			</div>
			<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
	</div><!--col-md-12-->	
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

