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
	<small>Βιβλιοθήκες συστημάτων</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-university"></i> Βιβλιοθήκες</a></li>
	<li class="active"> Συστήματα</li>
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
			<li class="active"><a href="#tabs-1" data-toggle="tab">Επιλέξιμες Α.Θ. (ΕΚΟ Ι)</a></li>
			<li><a href="#tabs-2" data-toggle="tab">Αντλίες θερμότητας</a></li>
			<li><a href="#tabs-3" data-toggle="tab">Λέβητες</a></li>
			<li><a href="#tabs-4" data-toggle="tab">Ηλιακοί</a></li>
			<li><a href="#tabs-5" data-toggle="tab">Φ/Β Πάνελ</a></li>
			<li><a href="#tabs-6" data-toggle="tab">Τερματικές θέρμανσης</a></li>
		</ul>
			
		<div class="tab-content">
			<!--ΑΝΤΛΙΕΣ ΘΕΡΜΟΤΗΤΑΣ (ΕΞΟΙΚΟΝΟΜΩ)-->
			<div class="tab-pane active" id="tabs-1">
			<br/>
			<div class="panel panel-default">
			<div class="panel-heading">Φίλτρο αναζήτησης (Αφορά το πρόγραμμα "Εξοικονόμηση κατ' οίκον Ι")</div>
			<div class="panel-body">
			
				<div class="row">
				<div class="col-md-2">
				Εταιρία:
				<select class="form-control" id="exoikonomw_manufacturer" onchange="get_heatpumps_ex();">
					<option value="">Όλες οι εταιρίες...</option>
					<?php
					echo create_select_options("vivliothiki_exoikonomw_heatpumps","company");
					?>		
				</select>
				</div>
				<div class="col-md-2">
				Όνομα: <input class="form-control" type="text" id="exoikonomw_like" onkeyup="get_heatpumps_ex();">
				</div>
				<div class="col-md-2">
				Εξωτερική μονάδα: <input class="form-control" type="text" id="exoikonomw_outdoor" onkeyup="get_heatpumps_ex();">
				</div>
				</div>
				
			</div>
			</div>
			<br/>
			<div id="div_heatpumpsex"></div>

			<script>
			function get_heatpumps_ex(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				var manufacturer = document.getElementById('exoikonomw_manufacturer').value;
				var outdoor = document.getElementById('exoikonomw_outdoor').value;
				var like = document.getElementById('exoikonomw_like').value;
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_vivliothikes.php?get_heatpumpsex=1&manufacturer="+manufacturer+"&outdoor="+outdoor+"&like="+like+"&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("div_heatpumpsex").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
				}}
			}
			get_heatpumps_ex();
			
			</script>
			
			<blockquote>
			<small>Τελευταία ενημέρωση: 12/11/2013</small>
			</blockquote>
			
			</div>
			<!--ΑΝΤΛΙΕΣ ΘΕΡΜΟΤΗΤΑΣ (ΕΞΟΙΚΟΝΟΜΩ)-->
			
			<!--ΑΝΤΛΙΕΣ ΘΕΡΜΟΤΗΤΑΣ-->
			<div class="tab-pane" id="tabs-2">
			<br/>
			<div class="panel panel-default">
			<div class="panel-heading">Φίλτρο αναζήτησης (Βιβλιοθήκη la-kenak)</div>
			<div class="panel-body">
			Κατασκευαστής:
				<select id="heatpumps_manufacturer" name="heatpumps_manufacturer">
					<option value="">Όλοι οι κατασκευαστές</option>
					<?php
					echo create_select_options("vivliothiki_heat_pumps","manufacturer");
					?>
				</select>
			Τύπος:
				<select id="heatpumps_type" name="heatpumps_type">
					<option value="0">Όλοι οι τύποι</option>
					<option value="1">Αερόψυκτη</option>
					<option value="2">Γεωθερμική</option>
				</select>	
			</div>
			</div>
			<br/>	


			<script>

			</script>
			</div>
			<!--ΑΝΤΛΙΕΣ ΘΕΡΜΟΤΗΤΑΣ-->
			
			
			
			
			<!--ΛΕΒΗΤΕΣ-->
			<div class="tab-pane" id="tabs-3">
			<br/>
			<div class="panel panel-default">
			<div class="panel-heading">Φίλτρο αναζήτησης (Βιβλιοθήκη la-kenak)</div>
			<div class="panel-body">
			Κατασκευαστής:
				<select id="boilermanufacturer" name="boilermanufacturer">
					<option value="" selected="selected">Όλοι οι κατασκευαστές</option>
					<?php
					echo create_select_options("vivliothiki_heat_boilers","manufacturer");
					?>
				</select>
			</div>
			</div>
			<br/>


			<script>

			</script>
			</div>
			<!--ΛΕΒΗΤΕΣ-->
			
			
			
			
			
			<!--ΗΛΙΑΚΟΙ-->
			<div class="tab-pane" id="tabs-4">
			<br/>
			<div class="panel panel-default">
			<div class="panel-heading">Φίλτρο αναζήτησης (Βιβλιοθήκη la-kenak)</div>
			<div class="panel-body">
			Τύπος:
				<select id="solarheaters_type" name="solarheaters_type">
					<option value="0">Όλοι οι τύποι</option>
					<option value="1">Θέρμανση αέρα</option>
					<option value="2">Θέρμανση νερού - Ηλιακός</option>
				</select>
			</div>
			</div>
			<br/>	
			<?php
			/*
				$ped="vivliothiki_heat_solarheaters";
				$dig="0|0|0|3|3|3|3|3|3|0";
				$tb_name="vivliothiki_heat_solarheaters";
				$tb_title = "Ηλιακοί";
				$fields="fields: {
					id: {key: true,create: false,edit: false,list: false},
					type: {create: false,edit: false,list: true, title: 'Τύπος',width: '20%',listClass: 'center',options: {'1':'Θέρμανση αέρα','2':'Θέρμανση νερού - Ηλιακός'}},
					manufacturer: {create: false,edit: false,list: true, title: 'Κατασκευαστής',width: '10%',listClass: 'center'},
					model: {create: false,edit: false,list: true, title: 'Μοντέλο',width: '10%',listClass: 'center'},
					gross_per_solar: {create: false,edit: false,list: true, title: 'Gross area per solar collector (m<sup>2</sup>)',width: '10%',listClass: 'center'},
					area_per_solar: {create: false,edit: false,list: true, title: 'Aperture area per solar collector (m<sup>2</sup>)',width: '10%',listClass: 'center'},
					fr: {create: false,edit: false,list: true, title: 'Fr (tay alpha) coefficient (-)',width: '10%',listClass: 'center'},
					fr_ul: {create: false,edit: false,list: true, title: 'Fr UL Coefficient (W/m<sup>2</sup>/<sup>o</sup>C)',width: '10%',listClass: 'center'},
					t_fr_ul: {create: false,edit: false,list: true, title: 'Temperature coefficient for Fr UL (W/m<sup>2</sup>/<sup>o</sup>C<sup>2</sup>)',width: '10%',listClass: 'center'},
					source: {create: false,edit: false,list: true, title: 'source (-)',width: '10%',listClass: 'center'}
				}";
				include('includes/jtable_nouser.php');
			*/
			?>
			<!--
			<script>
			$('#solarheaters_type').change(function () {
				$('#<?php echo $tb_name;?>').jtable('load', {
					type: $('#solarheaters_type').val()
				});
			});
			</script>
			-->
			</div>
			<!--ΗΛΙΑΚΟΙ-->
			
			<!--ΦΒ-->
			<div class="tab-pane" id="tabs-5">
			<br/>
			<div class="panel panel-default">
			<div class="panel-heading">Φίλτρο αναζήτησης (Βιβλιοθήκη la-kenak)</div>
			<div class="panel-body">
			Κατασκευαστής:
				<select id="pv_manufacturer" name="pv_manufacturer">
					<option value="">Όλοι οι κατασκευαστές</option>
					<?php
					echo create_select_options("vivliothiki_heat_pv","manufacturer");
					?>
				</select>
			Τύπος:
				<select id="pv_type" name="pv_type">
					<option value="0">Όλοι οι τύποι</option>
					<option value="1">a-Si</option>
					<option value="2">CdTe</option>
					<option value="3">CIS</option>
					<option value="4">Mono-Si</option>
					<option value="5">Poly-Si</option>
					<option value="6">Spherical-Si</option>
				</select>	
			</div>
			</div>
			<br/>		


			<script>

			</script>
			</div>
			<!--ΦΒ-->
			
			<!--ΤΕΡΜΑΤΙΚΕΣ ΘΕΡΜΑΝΣΗΣ-->
			<div class="tab-pane" id="tabs-6">
			<br/>
			<div class="panel panel-default">
			<div class="panel-heading">Φίλτρο αναζήτησης (Βιβλιοθήκη la-kenak)</div>
			<div class="panel-body">
			Κατασκευαστής:
				<select id="terminals_manufacturer" name="terminals_manufacturer">
					<option value="">Όλοι οι κατασκευαστές</option>
					<?php
					echo create_select_options("vivliothiki_heat_swmata","manufacturer");
					?>
				</select>
			</div>
			</div>
			<br/>		


			<script>

			</script>
			</div>
			<!--ΤΕΡΜΑΤΙΚΕΣ ΘΕΡΜΑΝΣΗΣ-->
		
		</div><!--tab content-->
			</div><!--tabs-->
</div><!--col-md-12-->
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->