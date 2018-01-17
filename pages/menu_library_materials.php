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
	<small>Υλικά (ΤΟΤΕΕ)</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-university"></i> Βιβλιοθήκες</a></li>
	<li class="active"> Υλικά (ΤΟΤΕΕ)</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
<div class="col-md-12">		
		<div class="nav-tabs-custom">
		<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs-1" data-toggle="tab">Υλικά</a></li>
			</ul>
			
			<!--ΤΙΜΕΣ Λ - ΥΛΙΚΩΝ-->
			<div class="tab-content">
			<div class="tab-pane active" id="tabs-1">
			
			<br/>
			<div class="panel panel-default">
			<div class="panel-heading">Επιλογή υλικών</div>
			<div class="panel-body">
			<div class="row">
				<div class="col-md-2">
				Κατηγορία:
					<select class="form-control" id="material_category" name="material_category" onchange="change_category();">
						<option value="0" selected="selected">Όλες οι κατηγορίες</option>
						<?php
							echo create_select_optionsid("vivliothiki_domika_category","name");
						?>
					</select>
				</div>
				<div class="col-md-2">
				Υπο-κατηγορία:
					<select class="form-control" id="material_subcategory" name="material_subcategory" onchange="get_materials();">
						<option value="0" selected="selected">Επιλέξτε πρώτα κατηγορία</option>
					</select>
				</div>
				<div class="col-md-2">
				Όνομα: <input class="form-control" type="text" id="material_like" onkeyup="get_materials();">
				</div>
			</div>
			</div>
			<br/>			
			
			<div id="div_materials"></div>
			<script>
			
			function change_category(){
				var cat = document.getElementById('material_category').value;
				
				if (cat!=0){//Έχει επιλεγεί κατηγορία
				//Εύρεση υποκατηγοριών από βάση δεδομένων
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.open("GET","includes/functions_calc.php?adiafani_find_subcategory=1&category="+cat ,true);
				xmlhttp.send();
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById('material_subcategory').innerHTML=xmlhttp.responseText;
				}}
				
				}else{//Δεν έχει επιλεγεί κατηγορία
					document.getElementById('material_subcategory').innerHTML = "<option value=\"0\">Όλες οι υποκατηγορίες</option>";
				}
				get_materials();
			}
			
			function get_materials(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				var category = document.getElementById('material_category').value;
				var subcategory = document.getElementById('material_subcategory').value;
				var like = document.getElementById('material_like').value;
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_vivliothikes.php?get_materials=1&category="+category+"&subcategory="+subcategory+"&page="+page+"&like="+like ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("div_materials").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
				}}
			}
			get_materials();
			
			</script>

			</div>
			<!--ΤΙΜΕΣ Λ - ΥΛΙΚΩΝ-->
		
</div><!--tab content-->
			</div><!--tabs-->
</div><!--col-md-12-->
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->