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
	<small>Συνθήκες λειτουργίας</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-university"></i> Βιβλιοθήκες</a></li>
	<li class="active">Συνθήκες λειτουργίας</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

<!-- Select boxes -->
<div class="row">
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">Συνθήκες λειτουργίας θερμικής ζώνης</div>
			<div class="panel-body">
		<form class="form-inline" role="form">
		<i class="fa fa-search" aria-hidden="true"></i> :
		<select class="form-control" id="synthikes_gen_xrisi" onchange="get_synthikes()">
			<?php
				echo create_select_optionsid("vivliothiki_conditions_general","name");
			?>
		</select>
		<select class="form-control" id="synthikes_type" onchange="get_synthikes()">
			<option value=1>Ωράριο λειτουργίας</option>
			<option value=2>Θερμοκρασία/Σχετική Υγρασία</option>
			<option value=3>Απαιτούμενος νωπός αέρας</option>
			<option value=4>Στάθμες φωτισμού</option>
			<option value=5>Ζεστό νερό χρήσης</option>
			<option value=6>Χρήστες</option>
			<option value=7>Εξοπλισμός</option>
		</select>
		</form>
		</div><!--/panel-body-->
	</div><!--/panel-->
	</div><!--col-md-12-->	
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
<div class="col-md-12">
	<div class="box">
		<div class="box-header">
		<h3 class="box-title">Πίνακας συνθηκών λειτουργίας</h3>

		<div class="box-tools">
		<div class="input-group input-group-sm" style="width: 150px;">
		<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

		<div class="input-group-btn">
		<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
		</div>
		</div>
		</div>
		</div>
		<!-- /.box-header -->
		  <div class="box-body table-responsive no-padding">
			<div id="synthikes_text"></div>
			<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>

			<script>
			function get_synthikes(){
				document.getElementById('wait').style.display="inline";
				var gen_xrisi = document.getElementById('synthikes_gen_xrisi').value;
				var type = document.getElementById('synthikes_type').value;
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_vivliothikes.php?gen_xrisi="+gen_xrisi+"&type="+type ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("synthikes_text").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
				}else{
					document.getElementById("synthikes_text").innerHTML=xmlhttp.statusText;
				}}
			}
			get_synthikes();
			</script>
			<?php
				//echo create_library_synthikes(0,1);
			?>
		</div>
		<!-- /.box-body -->
		<div class="box-footer clearfix">
			<span class="no-margin pull-right">(ΤΟΤΕΕ-20701-1 - Κεφ.3: Συνθήκες λειτουργίας Κτιρίου)</span>
		</div>
		</div>
	<!-- /.box -->
</div><!--col-md-12-->	
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->