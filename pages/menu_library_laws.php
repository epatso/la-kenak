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
	<small>Νομοθετικό πλαίσιο</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-university"></i> Βιβλιοθήκες</a></li>
	<li class="active"> Νομοθετικό πλαίσιο</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
	<div class="col-md-12">	
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab">Νομοθεσία</a></li>
		</ul>
			
			<div class="tab-content">
			<div class="tab-pane active" id="tabs-1">
			
			<div class="panel panel-default">
			<div class="panel-heading">Συνολικός πίνακας νομοθεσίας / Ευρωπαϊκών προτύπων / Οδηγιών</div>
				<div class="panel-body">
			<form class="form-inline" role="form">
			<b>Αναζήτηση:</b> 
			Τύπος <select class="form-control" id="law_type" name="law_type" onchange="get_laws()">
					<option value="0" selected="selected">Επιλέξτε είδος....</option>
					<option value="1">Νομοθετικό πλαίσιο</option>
					<option value="2">Τεχνική οδηγία</option>
					<option value="3">Ευρωπαϊκά πρότυπα</option>
					<option value="4">Σύνδεσμος</option>
			</select> 
			Όνομα: <input class="form-control" type="text" id="law_like" onkeyup="get_laws();">
			</form>
				</div>
			</div>		  
			  
			<div id="laws_text"></div>
			<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>

			<script>
			function get_laws(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				var select = document.getElementById('law_type').value;
				var like = document.getElementById('law_like').value;
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_vivliothikes.php?law_type="+select+"&page="+page+"&like="+like ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("laws_text").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
				}}
			}
			get_laws();
			</script>
			
			</div>
			</div>
			</div>
		</div><!--col-md-12-->	
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

