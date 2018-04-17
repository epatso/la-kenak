<?php
/*
Copyright (C) 2012 - Labros KENAK v.4.0 
Author: Labros Karoyntzos 

Labros KENAK v.4.0 from Labros Karountzos is free software: 
you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, version 3 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License version 3
along with this program.  If not, see http://www.gnu.org/licenses/gpl-3.0.html.

Το παρόν με την ονομασία Labros KENAK v.4.0. με δημιουργό τον Λάμπρο Καρούντζο
στοιχεία επικοινωνίας info@chem-lab.gr www.chem-lab.gr
είναι δωρεάν λογισμικό. Μπορείτε να το τροποποιήσετε και επαναδιανείμετε υπό τους
όρους της άδειας GNU General Public License όπως δίδεται από το Free Software Foundation
στην έκδοση 3 αυτής της άδειας.
Το παρόν σχόλιο πρέπει να παραμένει ως έχει ώστε να τηρείται η παραπάνω άδεια κατά τη διανομή.
*/
require("include_check.php");
confirm_logged_in();
confirm_meleti_isset();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
	<h1>
	La-kenak
	<small>Θερμικές ζώνες/ΜΘΧ</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-edit"></i> Μελέτη ΚΕΝΑΚ</a></li>
	<li class="active"> Θερμικές ζώνες/ΜΘΧ</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
<script>
	$(function() {
		$('.tooltipui').tooltip({
			track: true,
			html: true,
			animation: true
		});
		$('.tooltip').tooltip({
			track: true,
			html: true,
			animation: true
		});
		$('.popover').popover();
		$('.popoverui').popover({ placement:'top',html:true, trigger:'click' });
		setUpToolTipHelpers();
	});
	
	function setUpToolTipHelpers() {
		$(".tip-top").tooltip({
			placement: 'top',
			html: true,
			animation: true
		});
		$(".tip-right").tooltip({
			placement: 'right',
			html: true,
			animation: true
		});
		$(".tip-bottom").tooltip({
			placement: 'bottom',
			html: true,
			animation: true
		});
		$(".tip-left").tooltip({
			placement: 'left',
			html: true,
			animation: true
		});
	}
</script>	
<!-- Main row -->
<div class="row">
	
		<div class="col-md-2">
			    <div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Ζώνες</h4>
				Δηλώστε τις θερμικές ζώνες του κτιρίου.
				</div>
				<div class="alert alert-znx">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>ΜΘΧ/Ηλιακοί χώροι</h4>
				Δηλώστε τους μη θερμαινόμενους χώρους και τους ηλιακούς χώρους του κτιρίου.
				</div>
				<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Εμβαδόν / Όγκος</h4>
				Για τυπικούς χώρους υπολογίζεται το εμβαδόν και ο όγκος ως εξής. <br/>Εάν υπάρχει και τρίγωνο (πχ δίριχτη στέγη προσθέστε 
				στο ύψος το μισό του ύψους της σκεπής με βάση τον τύπο: 
				E<sub>συνολικό</sub>=μήκος x πλάτος x (ύψος<sub>κάτω από σκεπή</sub>+1/2ύψος<sub>σκεπής</sub>).  
				<ul>
					<li>E<sub>χώρου</sub>= μήκος x πλάτος</li>
					<li>V<sub>χώρου</sub>= μήκος x πλάτος x ύψος</li>
				</ul>
				Για τετρακλινή σκεπή (πχ εμφανής) ΔΕΝ υπολογίζεται εμβαδόν και μετρά μόνο ο όγκος
				<ul>
					<li>Μήκος<sub>χώρου</sub>=Α= Η μεγάλη διάσταση</li>
					<li>Πλάτος<sub>χώρου</sub>=Β= Η μικρή διάσταση</li>
					<li>E<sub>χώρου</sub>= δεν υπολογίζεται</li>
					<li>V<sub>χώρου</sub>= 1/6*Βh[(2B+3(A-B)]</li>
				</ul>
				Σε περίπτωση που χρειάζεται να προστεθεί μόνο εμβαδόν (πχ έχει υπολογιστεί ο όγκος σε άλλο τμήμα) μπορεί να εισαχθεί κανονικά με 
				το ύψος μηδέν. 
				</div>
		</div>
		
		<div class="col-md-10">
		
			<div class="nav-tabs-custom">
			<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs-1" data-toggle="tab"><i class="fa fa-cubes"></i> Ζώνες</a></li>
				<li><a href="#tabs-2" data-toggle="tab"><i class="fa fa-cube"></i> ΜΘΧ/Ηλιακοί χώροι</a></li>
				<li><a href="#tabs-3" data-toggle="tab"><i class="fa fa-cubes"></i> Εμβαδά/Όγκος</a></li>
				<li><a href="#tabs-4" data-toggle="tab"><i class="fa fa-cubes"></i> Θερμογέφυρες</a></li>
			</ul>
			
			<div class="tab-content">
			<div class="tab-pane active" id="tabs-1"><!-- ΖΩΝΕΣ -->
			
			<div id="zones_table"></div>
			<div id="zones_info"></div>
			
			
			
			<script>
			get_zones();
			
			//Εμφάνιση πίνακα με όλες τις θερμικές ζώνες του χρήστη
			function get_zones(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_zone.php?getzones=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("zones_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές της ζώνης για επεξεργασία
			function form_zone(id,page){
				page = typeof page !== 'undefined' ? page : 1;
			var prefix = "editzone_";
				if(id==0){
				document.getElementById(prefix+"name").value = "";
				document.getElementById(prefix+"xrisi").selectedIndex = 0;
				document.getElementById(prefix+"klines").value = "";
				document.getElementById(prefix+"hotel").value = 0;
				document.getElementById(prefix+"hospital").value = 0;
				document.getElementById(prefix+"thermo").selectedIndex = 0;
				document.getElementById(prefix+"auto_heat").selectedIndex = 0;
				document.getElementById(prefix+"auto_cold").selectedIndex = 0;
				document.getElementById(prefix+"kaminades").value = "";
				document.getElementById(prefix+"thyrides").value = "";
				document.getElementById(prefix+"ekswthyres").value = "";
				document.getElementById(prefix+"anemistires").value = "";
				document.getElementById(prefix+"auto_znx").checked = false;
				allow_options();
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zones&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
						document.getElementById(prefix+"name").value = arr["name"];
						document.getElementById(prefix+"xrisi").value = arr["xrisi"];
						document.getElementById(prefix+"klines").value = arr["klines"];
						document.getElementById(prefix+"hotel").value = arr["hotel"];
						document.getElementById(prefix+"hospital").value = arr["hospital"];
						document.getElementById(prefix+"thermo").value = arr["thermo"];
						document.getElementById(prefix+"auto_heat").value = arr["auto_heat"];
						document.getElementById(prefix+"auto_cold").value = arr["auto_cold"];
						document.getElementById(prefix+"kaminades").value = arr["kaminades"];
						document.getElementById(prefix+"thyrides").value = arr["thyrides"];
						document.getElementById(prefix+"ekswthyres").value = arr["ekswthyres"];
						document.getElementById(prefix+"anemistires").value = arr["anemistires"];
						if(arr["auto_znx"]!=0){
							document.getElementById(prefix+"auto_znx").checked = true;
						}else{
							document.getElementById(prefix+"auto_znx").checked = false;
						}
						document.getElementById('wait').style.display="none";
						allow_options();
					}}
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_zone('+id+','+page+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία θερμικής ζώνης';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_zone('+id+','+page+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη νέας θερμικής ζώνης';
				}
				document.getElementById("edit_button_zone").innerHTML = button;
				document.getElementById("edit_header_zone").innerHTML = edit_header;
				$("#modal_form_zone").modal("show");
			}
			
			
			function formdel_zone(id,page){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_zone('+id+','+page+');">Διαγραφή</button>';
				document.getElementById("del_button_zone").innerHTML = button;
				$("#modal_del_zone").modal("show");
			}
			
			//Υποβολή της φόρμας για θερμική ζώνη
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_zone(id,page){
			var prefix = "editzone_";
				var name = document.getElementById(prefix+"name").value;
				var xrisi = document.getElementById(prefix+"xrisi").value;
				var klines = document.getElementById(prefix+"klines").value;
				var hotel = document.getElementById(prefix+"hotel").value;
				var hospital = document.getElementById(prefix+"hospital").value;
				var thermo = document.getElementById(prefix+"thermo").value;
				var auto_heat = document.getElementById(prefix+"auto_heat").value;
				var auto_cold = document.getElementById(prefix+"auto_cold").value;
				var kaminades = document.getElementById(prefix+"kaminades").value;
				var thyrides = document.getElementById(prefix+"thyrides").value;
				var ekswthyres = document.getElementById(prefix+"ekswthyres").value;
				var anemistires = document.getElementById(prefix+"anemistires").value;
				var auto_znx;
					if(document.getElementById(prefix+"auto_znx").checked==true){
						auto_znx=1;
					}else{
						auto_znx=0;
					}
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_zones";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+name+","+xrisi+","+klines+","+hotel+","+hospital+","+thermo+","+auto_heat+","+auto_cold+","+kaminades+","+thyrides+","+ekswthyres+","+anemistires+","+auto_znx;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("zones_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_zones(page);
				}}
			}
			
			//Διαγραφή θερμικής ζώνης
			function del_zone(id,page){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zones&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("zones_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_zones(page);
				}}
			}
			
			//ΧΩΡΙΣ ΧΡΗΣΗ - Προηγούμενος ΚΕΝΑΚ
			//Εναλλαγή Input κλινών ανάλογα με τη χρήση
			function allow_klines(){
			var xrisi = document.getElementById('editzone_xrisi').value;
			var klines = document.getElementById('editzone_klines');

				if(xrisi==0){klines.disabled = true;}
				
				if(xrisi>=1 && xrisi<=15){klines.disabled = false;}
				if(xrisi>=16 && xrisi<=33){klines.disabled = true;}
				if(xrisi>=34 && xrisi<=36){klines.disabled = false;}
				if(xrisi>=37 && xrisi<=41){klines.disabled = true;}
				if(xrisi==42){klines.disabled = false;}
				if(xrisi>42){klines.disabled = true;}
			}
			
function allow_options(){
var xrisi = document.getElementById('editzone_xrisi').value;
var div_klines = document.getElementById('div_klines');
var div_hotel = document.getElementById('div_hotel');
var div_hospital = document.getElementById('div_hospital');
var klines = document.getElementById("editzone_klines").value;
var hotel = document.getElementById('editzone_hotel').value;
var hospital = document.getElementById('editzone_hospital').value;
	
	if(xrisi!=0){
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","includes/functions_calc.php?id_xrisi="+xrisi+"&hotel="+hotel+"&hospital="+hospital ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var arr = JSON.parse(xmlhttp.responseText);
			var has_znx=arr["has_znx"];
			var znx_calc_type=arr["znx_calc_type"];
				if(znx_calc_type==0){//Τρόπος υπολογισμού != δομημένη επιφάνεια
					div_klines.style.display = "none";
					div_hotel.style.display = "none";
					div_hospital.style.display = "none";
				}
				if(znx_calc_type==1){//Τρόπος υπολογισμού = Ξενοδοχεία
					div_klines.style.display = "block";
					div_hotel.style.display = "none";
					div_hospital.style.display = "none";
				}
				if(znx_calc_type==2){//Τρόπος υπολογισμού = Ξενοδοχεία
					div_klines.style.display = "block";
					div_hotel.style.display = "block";
					div_hospital.style.display = "none";
				}
				if(znx_calc_type==3){//Τρόπος υπολογισμού = Νοσοκομεία
					div_klines.style.display = "block";
					div_hotel.style.display = "none";
					div_hospital.style.display = "block";
				}

		}//Return OK
	}//ajax call
	
	}else{//xrisi==0
		div_klines.style.display = "none";
		div_hotel.style.display = "none";
		div_hospital.style.display = "none";
	}
}
			
			</script>
			
<!-- ###################### Κρυφό modal_form_zone για εμφάνιση ###################### -->
<div id="modal_form_zone" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_zone"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info" style="text-align: center;">
			<th style="text-align: center;" colspan=2>Όνομα - Χρήση - ΖΝΧ</th>
		</tr>
		<tr>
			<td width=50%>
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-keyboard-o"></i> Όνομα</span>
				<input type="text" class="form-control input-sm" id="editzone_name" pattern="[^,|\^]+"><!--όλα εκτός ,|^ που χρησιμοποιούνται ως delimeters-->
				</div>
			</td>
			<td width=50%>
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-building-o"></i> Χρήση</span>
				<select class="form-control input-sm" id="editzone_xrisi" onchange="allow_options();" onkeyup="allow_options();">
				<?php
				echo create_select_optionsid("vivliothiki_conditions_zone","name");
				?>
				</select>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group" id="div_klines" style="display: none;">
				<span class="input-group-addon" style="background-color: #C1FFC1"><i class="fa fa-bed" aria-hidden="true"></i> Κλίνες</span>
				<input type="text" class="form-control input-sm" id="editzone_klines" pattern="[^,|\^]+">
				</div>
				<div class="input-group" id="div_hotel" style="display: none;">
				<span class="input-group-addon" style="background-color: #ffcfdf"><i class="fa fa-plane" aria-hidden="true"></i> Ξενοδοχείο</span>
				<select class="form-control input-sm" id="editzone_hotel">
					<option value=0>Άλλη χρήση</option>
					<option value=1>LUX</option>
					<option value=2>Α ή Β</option>
					<option value=3>Γ</option>
				</select>
				</div>
				<div class="input-group" id="div_hospital" style="display: none;">
				<span class="input-group-addon" style="background-color: #eed9fa"><i class="fa fa-hospital-o" aria-hidden="true"></i> Νοσοκομείο</span>
				<select class="form-control input-sm" id="editzone_hospital">
					<option value=0>Όχι</option>
					<option value=1>Νοσοκομείο <500 κλίνες </option>
					<option value=2>Νοσοκομείο >500 κλίνες </option>
					<option value=3>Κλινική</option>
				</select>
				</div>
			</td>
			<td style="text-align: center; vertical-align: middle;">
				<div class="input-group">
				<label>
				<input type="checkbox" id="editzone_auto_znx"> Διατάξεις αυτόματου ελέγχου ΖΝΧ</label>
				</div>
			</td>
		</tr>
		<tr class="info" style="text-align: center;">
			<th style="text-align: center;" colspan=2>Θερμοχωρητικότητα 
			<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#popup_thermo"><i class="fa fa-info-circle"></i></button> 
			- Αυτοματισμοί 
			<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#popup_auto"><i class="fa fa-info-circle"></i></button> 
			- Αερισμός
			</th>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon" style="background-color: #e9ebe9"><i class="fa fa-microchip"></i> Κατηγορία</span>
				<select class="form-control input-sm" id="editzone_thermo">
					<option style="background-color: #e9ebe9" value=80>Κατηγορία 1 (80 KJ/m2.K)</option>
					<option style="background-color: #d3d8d3" value=110>Κατηγορία 2 (110 KJ/m2.K)</option>
					<option style="background-color: #bdc4bd" value=165>Κατηγορία 3 (165 KJ/m2.K)</option>
					<option style="background-color: #a7b1a7" value=230>Κατηγορία 4 (230 KJ/m2.K)</option>
					<option style="background-color: #919e91" value=280>Κατηγορία 5 (280 KJ/m2.K)</option>
					<option style="background-color: #7b8a7b" value=300>Κατηγορία 6 (300 KJ/m2.K)</option>
				</select>
			</td>
			<td>
				<div class="row">
				<div class="col-md-6">
				<div class="input-group">
				<span class="input-group-addon" style="background-color: #ffd8d8"><i class="fa fa-fire"></i> Θέρμανση</span>
				<select class="form-control input-sm" id="editzone_auto_heat">
					<option style="background-color: #ff6666" value=0>Τύπος Α</option>
					<option style="background-color: #ff8c8c" value=1>Τύπος Β</option>
					<option style="background-color: #ffb2b2" value=2>Τύπος Γ</option>
					<option style="background-color: #ffd8d8" value=3>Τύπος Δ</option>
				</select>
				</div>
				</div><!--col-md-6-->
				<div class="col-md-6">
				<div class="input-group">
				<span class="input-group-addon" style="background-color: #62e4f4"><i class="fa fa-snowflake-o"></i> Ψύξη</span>
				<select class="form-control input-sm" id="editzone_auto_cold">
					<option style="background-color: #62e4f4" value=0>Τύπος Α</option>
					<option style="background-color: #89ebf7" value=1>Τύπος Β</option>
					<option style="background-color: #b0f1f9" value=2>Τύπος Γ</option>
					<option style="background-color: #d7f8fc" value=3>Τύπος Δ</option>
				</select>
				</div>
				</div><!--col-md-6-->
				</div><!--row-->
			</td>
		</tr>
		<tr>
			<td>
				<div class="row">
				<div class="col-md-6">
					<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-free-code-camp"></i> Καμινάδες</span>
					<input type="text" class="form-control input-sm" id="editzone_kaminades" pattern="[^,|\^]+">
					</div>
				</div>
				<div class="col-md-6">
					<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-flag-o"></i> Θυρίδες</span>
					<input type="text" class="form-control input-sm" id="editzone_thyrides" pattern="[^,|\^]+">
					</div>
				</div>
				</div>
			</td>
			<td>
				<div class="row">
				<div class="col-md-6">
					<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-window-maximize"></i> Εξώθυρες</span>
					<input type="text" class="form-control input-sm" id="editzone_ekswthyres" pattern="[^,|\^]+">
					</div>
				</div>
				<div class="col-md-6">
					<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-flag-checkered"></i> Ανεμιστήρες</span>
					<input type="text" class="form-control input-sm" id="editzone_anemistires" pattern="[^,|\^]+">
					</div>
				</div>
				</div>
			</td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_zone"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό zone_del για εμφάνιση ###################### -->
<div id="modal_del_zone" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή θερμικής ζώνης</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	Μαζί με τη θερμική ζώνη διαγράφονται και όλα τα στοιχεία που περιέχονται σε αυτήν δηλαδή 
	όλο το κέλυφος και τα συστήματά της. <br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_zone"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
			
			</div><!-- ζώνες -->	
			
			
			
			<div class="tab-pane" id="tabs-2"><!-- ΜΘΧ -->
			
			<div id="mthx_table"></div>
			<div id="mthx_info"></div>
			
			<script>
			get_mthx();
			
			//Εμφάνιση πίνακα με όλους τους ΜΘΧ του χρήστη
			function get_mthx(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_zone.php?getmthx=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("mthx_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές τo ΜΘΧ για επεξεργασία
			function form_mthx(id,page){
				page = typeof page !== 'undefined' ? page : 1;
			var prefix = "editmthx_";
				if(id==0){
				document.getElementById(prefix+"type").selectedIndex = 0;
				document.getElementById(prefix+"name").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_mthx&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
						document.getElementById(prefix+"type").selectedIndex = arr["type"];
						document.getElementById(prefix+"name").value = arr["name"];
						document.getElementById('wait').style.display="none";
					}}
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_mthx('+id+','+page+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία ΜΘΧ/Ηλιακού χώρου';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_mthx('+id+','+page+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη νέου ΜΘΧ/Ηλιακού χώρου';
				}
				document.getElementById("edit_button_mthx").innerHTML = button;
				document.getElementById("edit_header_mthx").innerHTML = edit_header;
				$("#modal_form_mthx").modal("show");
			}
			
			
			function formdel_mthx(id,page){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_mthx('+id+','+page+');">Διαγραφή</button>';
				document.getElementById("del_button_mthx").innerHTML = button;
				$("#modal_del_mthx").modal("show");
			}
			
			//Υποβολή της φόρμας για ΜΘΧ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_mthx(id,page){
			var prefix = "editmthx_";
				var type = document.getElementById(prefix+"type").selectedIndex;
				var name = document.getElementById(prefix+"name").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_mthx";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+type+","+name;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("mthx_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_mthx(page);
				}}
			}
			
			//Διαγραφή ΜΘΧ
			function del_mthx(id,page){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_mthx&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("mthx_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_mthx(page);
				}}
			}
			
			</script>
			
<!-- ###################### Κρυφό modal_form_mthx για εμφάνιση ###################### -->
<div id="modal_form_mthx" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_mthx"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info">
			<td style="text-align: center;" colspan=2>Στοιχεία ΜΘΧ/Ηλιακού χώρου</td>
		</tr>
		<tr>
			<td width=70%>
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-th"></i> Τύπος</span>
				<select class="form-control input-sm" id="editmthx_type">
					<option value=0>Μη θερμαινόμενος χώρος</option>
					<option value=1>Ηλιακός χώρος</option>
				</select>
				</div>
			</td>
			<td rowspan=2 width=30%>
				Προσθέστε Μη θερμαινόμενους χώρους ή ηλιακούς χώρους δίνοντάς τους χαρακτηριστικό όνομα. 
			</td>
		</tr>
		<tr>
		<td>
			<div class="input-group">
			<span class="input-group-addon"><i class="fa fa-keyboard-o"></i> Όνομα</span>
			<input type="text" class="form-control input-sm" id="editmthx_name" pattern="[^,|\^]+">
			</div>
		</td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_mthx"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_mthx για εμφάνιση ###################### -->
<div id="modal_del_mthx" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή ΜΘΧ/Ηλιακού χώρου</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	Μαζί με το Μη θερμαινόμενο χώρο ή τον ηλιακό χώρο διαγράφονται και όλα τα στοιχεία που περιέχονται σε αυτόν δηλαδή 
	όλο το κέλυφος του. <br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_mthx"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
			
			</div><!-- ΜΘΧ -->		
			
			
			
			<div class="tab-pane" id="tabs-3"><!-- ΕΜΒΑΔΑ -->
			<div id="xwroi_table"></div>
			<div id="xwroimthx_table"></div>
			<div id="xwroi_info"></div>
			
			<script>
			get_xwroi(0);
			get_xwroi(1);
			
			//Εμφάνιση πίνακα με όλους τους χώρους των θερμικών ζωνών του χρήστη
			function get_xwroi(type,page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_zone.php?getxwroi=1&type="+type+"&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					if(type==0){
					document.getElementById("xwroi_table").innerHTML=xmlhttp.responseText;
					}
					if(type==1){
					document.getElementById("xwroimthx_table").innerHTML=xmlhttp.responseText;
					}
					setUpToolTipHelpers();
					document.getElementById('wait').style.display="none";
				}}
			}
			
			function xwroi_get_zones(type,zone_id){
			var prefix = "editxwroi_";
			//Εμφάνιση select ανάλογα με τον τύπο (ΖΩΝΕΣ η ΜΘΧ)
				var link1 = "includes/functions_meleti_general.php?getavailablezones=1&type="+type;
				var xmlhttp1=new XMLHttpRequest();
				xmlhttp1.open("GET",link1 ,true);
				xmlhttp1.send();
				xmlhttp1.onreadystatechange=function()  {
				if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
					document.getElementById(prefix+"zone_id").innerHTML = xmlhttp1.responseText;
					if(zone_id!=0){
					document.getElementById(prefix+"zone_id").value = zone_id;
					}
				}}
			}
			
			
			//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία χωρου θερμικής ζώνης
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές του χώρου της ζώνης για επεξεργασία
			function form_xwroi(type,id,page){
				page = typeof page !== 'undefined' ? page : 1;
			var prefix = "editxwroi_";
			var header_zone;
				if(type==0){
					document.getElementById(prefix+"zonetitle").innerHTML = "<i class=\"fa fa-cubes\"></i> Ζώνη";
					header_zone="θερμικής ζώνης";
				}
				if(type==1){
					document.getElementById(prefix+"zonetitle").innerHTML = "<i class=\"fa fa-cube\"></i> ΜΘΧ/Ηλιακός χώρος";
					header_zone="ΜΘΧ/Ηλιακού χώρου";
				}
				xwroi_get_zones(type,0);
				
				if(id==0){
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"name").value = "";				
				document.getElementById(prefix+"l").value = "";
				document.getElementById(prefix+"w").value = "";
				document.getElementById(prefix+"h").value = "";
				document.getElementById(prefix+"type").value = 0;
				xwroi_change_info();
				}
				if(id!=0){
					
					//Εισαγωγή των τιμών του χώρου
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_xwroi&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
							if(type==0){
								xwroi_get_zones(type,arr["zone_id"]);
							}
							if(type==1){
								xwroi_get_zones(type,arr["mthx_id"]);
							}
						document.getElementById(prefix+"name").value = arr["name"];
						document.getElementById(prefix+"l").value = arr["l"];
						document.getElementById(prefix+"w").value = arr["w"];
						document.getElementById(prefix+"h").value = arr["h"];
						document.getElementById(prefix+"type").value = arr["type"];
						document.getElementById('wait').style.display="none";
						
						xwroi_change_info();
					}}
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_xwroi('+type+','+id+','+page+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία χώρου '+header_zone;
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_xwroi('+type+','+id+','+page+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη χώρου '+header_zone;
				}
				document.getElementById("edit_button_xwroi").innerHTML = button;
				document.getElementById("edit_header_xwroi").innerHTML = edit_header;
				$("#modal_form_xwroi").modal("show");
			}
			
			
			function formdel_xwroi(type,id,page){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_xwroi('+type+','+id+','+page+');">Διαγραφή</button>';
				document.getElementById("del_button_xwroi").innerHTML = button;
				$("#modal_del_xwroi").modal("show");
			}
			
			//Υποβολή της φόρμας για χώρο θερμικής ζώνης
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_xwroi(type,id,page){
			var prefix = "editxwroi_";
				var zone_id = document.getElementById(prefix+"zone_id").value;
				var name = document.getElementById(prefix+"name").value;
				var l = document.getElementById(prefix+"l").value;
				var w = document.getElementById(prefix+"w").value;
				var h = document.getElementById(prefix+"h").value;
				var type_xwros = document.getElementById(prefix+"type").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_xwroi";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values=";
					if(type==0){
					link += zone_id+",0,";
					}
					if(type==1){
					link += "0,"+zone_id+",";
					}
				link += name+","+l+","+w+","+h+","+type_xwros;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("xwroi_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_xwroi(type,page);
				}}
			}
			
			//Διαγραφή χώρου θερμικής ζώνης
			function del_xwroi(type,id,page){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_xwroi&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("xwroi_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_xwroi(type,page);
				}}
			}
			
			//Ανάλογα με την επιλογή της ζώνης να περνάει το όνομα της ζώνης και στο όνομα του χώρου
			function xwroi_change_name(){
			var zone_name = document.getElementById("editxwroi_zone_id").options[document.getElementById("editxwroi_zone_id").selectedIndex].text;
			document.getElementById("editxwroi_name").value = zone_name+" - Χώρος";
			}
			
			function xwroi_change_info(){
			var l = document.getElementById("editxwroi_l").value;
			var w = document.getElementById("editxwroi_w").value;
			var h = document.getElementById("editxwroi_h").value;
			var type = document.getElementById("editxwroi_type").value;
			var e;
			var v;
			var txt;
			if(type==0){
				e = l*w;
				v = e*h;
				txt ="Εμβαδόν:"+e+"m<sup>2</sup><br/>"+"Όγκος:"+v+"m<sup>3</sup><br/>"
				txt += "<img src=\"images/style/ogkos.png\">";
			}
			if(type==1){
				e=0;
				v=(1/6)*w*h*(2*w+3*(l-w));
				txt = "Εμβαδόν:Δεν λαμβάνεται υπ' όψη<br/>"+"Όγκος:"+v+"m<sup>3</sup><br/>";
				txt += "<img src=\"images/style/4klinis.png\">";
			}
			document.getElementById("editxwroi_info").innerHTML = txt;
			}
			</script>
<!-- ###################### Κρυφό modal_form_xwroi για εμφάνιση ###################### -->
<div id="modal_form_xwroi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_xwroi"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info">
			<th  style="text-align: center;" width=50%>Στοιχεία χώρου</th>
			<th  style="text-align: center;" width=50%>Προεπισκόπηση</th>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon"><span id="editxwroi_zonetitle"></span></span>
				<select class="form-control input-sm" id="editxwroi_zone_id" onchange="xwroi_change_name();">
				<option value=""></option>
				</select>
				</div>
			</td>
			<td rowspan="6">
			<span id="editxwroi_info"></span>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-keyboard-o"></i> Όνομα</span>
				<input type="text" class="form-control input-sm" id="editxwroi_name" pattern="[^,|\^]+">
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-arrows-h"></i> Μήκος (Α)</span>
				<input type="text" class="form-control input-sm" id="editxwroi_l" onchange="xwroi_change_info();" pattern="[^,|\^]+">
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-arrows-h"></i> Πλάτος (Β)</span>
				<input type="text" class="form-control input-sm" id="editxwroi_w" onchange="xwroi_change_info();" pattern="[^,|\^]+">
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-arrows-v"></i> Ύψος (h)</span>
				<input type="text" class="form-control input-sm" id="editxwroi_h" onchange="xwroi_change_info();" pattern="[^,|\^]+">
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-th"></i> Τύπος</span>
				<select class="form-control input-sm" id="editxwroi_type" onchange="xwroi_change_info();">
					<option value=0>Τυπικός χώρος</option>
					<option value=1>Τετρακλινής στέγη (εμφανής)</option>
				</select>
				</div>
			</td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_xwroi"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό zone_del για εμφάνιση ###################### -->
<div id="modal_del_xwroi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή χώρου</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_xwroi"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
			</div><!-- ΕΜΒΑΔΑ -->	
			
			
			
			<div class="tab-pane" id="tabs-4"><!-- ΘΕΡΜΟΓΕΦΥΡΕΣ -->
			<div id="thermo_table"></div>
			<div id="thermo_info"></div>
			<script>
			get_thermo();
			
			//Εμφάνιση πίνακα με όλες τις ΘΕΡΜΟΓΕΦΥΡΕΣ για τη ζώνη
			function get_thermo(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_zone.php?getthermo=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("thermo_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function thermo_getzones(zone_id){
			var prefix = "editthermo_";
			
			//Εμφάνιση select ανάλογα με τον τύπο (ΖΩΝΕΣ η ΜΘΧ). Εδώ ενδιαφέρουν οι ζώνες
			var link1 = "includes/functions_meleti_general.php?getavailablezones=1&type="+0;
			var xmlhttp1=new XMLHttpRequest();
			xmlhttp1.open("GET",link1 ,true);
			xmlhttp1.send();
			xmlhttp1.onreadystatechange=function()  {
			if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
				document.getElementById(prefix+"zone_id").innerHTML = xmlhttp1.responseText;
				if(zone_id!=0){
				document.getElementById(prefix+"zone_id").value = zone_id;
				}
			}}
			}
			
			
			//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές ΘΕΡΜΟΓΕΦΥΡΑΣ
			function form_thermo(id,page){
			page = typeof page !== 'undefined' ? page : 1;
			var prefix = "editthermo_";

				if(id==0){
				thermo_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"type").selectedIndex = 0;
				thermo_change_u();
				document.getElementById(prefix+"u").selectedIndex = 0;
				document.getElementById(prefix+"n").value = "";
				document.getElementById(prefix+"h").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_thermo&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
							document.getElementById(prefix+"type").value = arr["type"];
							
							thermo_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"n").value = arr["n"];
							document.getElementById(prefix+"h").value = arr["h"];
							
							thermo_change_u(arr["u"]);
							
							
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_thermo('+id+','+page+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία θερμογεφυρών';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_thermo('+id+','+page+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη θερμογεφυρών';
				}
				document.getElementById("edit_button_thermo").innerHTML = button;
				document.getElementById("edit_header_thermo").innerHTML = edit_header;
				$("#modal_form_thermo").modal("show");
			}
			
			
			function formdel_thermo(id,page){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_thermo('+id+','+page+');">Διαγραφή</button>';
				document.getElementById("del_button_thermo").innerHTML = button;
				$("#modal_del_thermo").modal("show");
			}
			
			//Υποβολή της φόρμας για ΘΕΡΜΟΓΕΦΥΡΑ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_thermo(id,page){
			var prefix = "editthermo_";
				var zone_id = document.getElementById(prefix+"zone_id").value;
				var type = document.getElementById(prefix+"type").value;
				var u = document.getElementById(prefix+"u").value;
				var n = document.getElementById(prefix+"n").value;
				var h = document.getElementById(prefix+"h").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_zone_thermo";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+zone_id+","+type+","+u+","+n+","+h;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("thermo_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_thermo(page);
				}}
			}
			
			//Διαγραφή ΘΕΡΜΟΓΕΦΥΡΑΣ
			function del_thermo(id,page){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_thermo&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("thermo_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_thermo(page);
				}}
			}
			
			//Αλλαγή διαθέσιμων θερμογεφυρών ανάλογα με τον τύπο
			function thermo_change_u(u){
				var prefix = "editthermo_";
					
				var type = document.getElementById(prefix+"type").selectedIndex;
				var link1 = "includes/functions_meleti_general.php?getthermoselect=1&type="+type;
				var xmlhttp1=new XMLHttpRequest();
				xmlhttp1.open("GET",link1 ,true);
				xmlhttp1.send();
				xmlhttp1.onreadystatechange=function()  {
				if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
					document.getElementById(prefix+"u").innerHTML = xmlhttp1.responseText;
					
					if(u!=0){
						document.getElementById(prefix+"u").value = u;
						thermo_change_img();
					}
				}}	
			}
			
			//Αλλαγή εικόνας θερμογεφυρών ανάλογα με την θερμογέφυρα
			function thermo_change_img(){
				var prefix = "editthermo_";
				var type_array=["ksg","sg","ss","ds","dp","oe","dy","ed","df","pr","lp","yp"];
				var desc_array=[
					"Εξωτερικών γωνιών (οριζόντια τομή)",
					"Εσωτερικών γωνιών (οριζόντια τομή)",
					"Ενώσεων δομικών στοιχείων (οριζόντια τομή)",
					"Δώματος / οροφής σε προεξοχή (κατακόρυφη τομή)",
					"Δαπέδου σε προεξοχή / δαπέδου επάνω από πυλωτή (κατακόρυφη τομή)",
					"Οροφή σε εσοχή (κατακόρυφη τομή)",
					"Δάπεδο σε εσοχή (κατακόρυφη τομή)",
					"Ενδιάμεσο δάπεδο (κατακόρυφη τομή)",
					"Δαπέδου που εδράζεται στο έδαφος (κατακόρυφη τομή)",
					"Περιδέσμου ενίσχυσης (κατακόρυφη τομή)",
					"Λαμπά κουφώματος (οριζόντια τομή)",
					"Ανωκάσι/κατωκάσι κουφώματος (κατακόρυφη τομή)"
					];
				
				var type = document.getElementById(prefix+"type").value;
				var u = document.getElementById(prefix+"u").value;
				var img = "<img src=\"images/thermo/"+type_array[type]+"/"+type_array[type]+u+".jpg\">";
				document.getElementById(prefix+"img").innerHTML = img;	
				document.getElementById(prefix+"typedesc").innerHTML = desc_array[type];	
			}
			
			</script>
			
<!-- ###################### Κρυφό modal_form_thermo για εμφάνιση ###################### -->
<div id="modal_form_thermo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_thermo"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info">
			<th style="text-align: center;" width=50%>Τιμή</th>
			<th style="text-align: center;" width=50%>Προεπισκόπηση</th>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-cubes"></i> Ζώνη</span>
				<select class="form-control input-sm" id="editthermo_zone_id">
					<option value=0></option>
				</select>
				</div>
			</td>
			<td rowspan="5" style="text-align:center">
			<span id="editthermo_typedesc"></span><br/>
			<span id="editthermo_img"></span>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-archive"></i> Τύπος</span>
				<select class="form-control input-sm" id="editthermo_type" onchange="thermo_change_u();">
					<option value=0>ΞΓ</option>
					<option value=1>ΣΓ</option>
					<option value=2>ΣΣ</option>
					<option value=3>ΔΣ</option>
					<option value=4>ΔΠ</option>
					<option value=5>ΟΕ</option>
					<option value=6>ΔΥ</option>
					<option value=7>ΕΔ</option>
					<option value=8>ΔΦ</option>
					<option value=9>ΠΡ</option>
					<option value=10>ΛΠ</option>
					<option value=11>ΥΠ</option>
				</select>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-object-group"></i> Ψ</span>
				<select class="form-control input-sm" id="editthermo_u" onchange="thermo_change_img();" onkeyup="thermo_change_img();">
				<option value=0></option>
				</select>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-sort"></i> Πλήθος</span>
				<input type="text" class="form-control input-sm" id="editthermo_n" pattern="[^,|\^]+">
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-arrows-v"></i> Μήκος</span>
				<input type="text" class="form-control input-sm" id="editthermo_h" pattern="[^,|\^]+">
				</div>
			</td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_thermo"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_thermo για εμφάνιση ###################### -->
<div id="modal_del_thermo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή θερμογέφυρας</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_thermo"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
			
			</div><!-- ΘΕΡΜΟΓΕΦΥΡΕΣ -->	
			
			
			
			
			
			<!-- modals -->
			<?php
			$button_xrisi = '<a href="#popup_xrisi" id="button_xrisi" data-toggle="modal" title="Χρήση κτιρίου"><i class="icon-question-sign"></i></a>';
			$button_klines = '<a href="#popup_klines" id="button_klines" data-toggle="modal" title="Κλίνες"><i class="icon-question-sign"></i></a>';
			$button_thermo = '<a href="#popup_thermo" id="button_thermo" data-toggle="modal" title="Θερμοχωρητικότητα"><i class="icon-question-sign"></i></a>';
			$button_auto = '<a href="#popup_auto" id="button_auto" data-toggle="modal" title="Αυτοματισμοί"><i class="icon-question-sign"></i></a>';
			$button_kaminades = '<a href="#popup_kaminades" id="button_kaminades" data-toggle="modal" title="Καμινάδες"><i class="icon-question-sign"></i></a>';
			$button_thyrides = '<a href="#popup_thyrides" id="button_thyrides" data-toggle="modal" title="Θυρίδες εξαερισμού"><i class="icon-question-sign"></i></a>';
			$button_anemistires = '<a href="#popup_anemistires" id="button_anemistires" data-toggle="modal" title="Ανεμιστήρες οροφής"><i class="icon-question-sign"></i></a>';
			$button_xwroi = '<a href="#popup_xwroi" id="button_xwroi" data-toggle="modal" title="Υπολογισμός εμβαδών/όγκου ζώνης"><i class="icon-question-sign"></i></a>';
			?>
			
			<!-- ###################### Κρυφό popup_xrisi για εμφάνιση ###################### -->
			<div id="popup_xrisi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 id="myModalLabel">
					<?php
					echo APPLICATION_NAME." - v.".APPLICATION_VERSION." - Χρήση κτιρίου";
					?>
					</h4>
				</div>

				<div class="modal-body">
					<input type="text" id="klines">
				</div>	
				<div class="modal-footer">			
					<button class="btn" data-dismiss="modal" aria-hidden="true" onclick="close_klines();">ΟΚ</button>
				</div>
			</div>
			</div>
			</div>
			<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
			<!-- ###################### Κρυφό popup_klines για εμφάνιση ###################### -->
			<div id="popup_klines" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 id="myModalLabel">
					<?php
					echo APPLICATION_NAME." - v.".APPLICATION_VERSION." - Κλίνες";
					?>
					</h4>
				</div>

				<div class="modal-body">
					<input type="text" id="klines">
				</div>	
				<div class="modal-footer">			
					<button class="btn" data-dismiss="modal" aria-hidden="true" onclick="close_klines();">ΟΚ</button>
				</div>
			</div>
			</div>
			</div>
			<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
			<!-- ###################### Κρυφό popup_thermo για εμφάνιση ###################### -->
			<div id="popup_thermo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 id="myModalLabel">
					<?php
					echo APPLICATION_NAME." - v.".APPLICATION_VERSION." - Ανηγμ. Θερμ.";
					?>
					</h4>
				</div>

				<div class="modal-body">
					<?php
						echo create_library_ktiriocm();
					?>
				</div>	
				<div class="modal-footer">			
					<button class="btn" data-dismiss="modal" aria-hidden="true" onclick="close_klines();">ΟΚ</button>
				</div>
			</div>
			</div>
			</div>
			<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
			<!-- ###################### Κρυφό popup_auto για εμφάνιση ###################### -->
			<div id="popup_auto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 id="myModalLabel">
					<?php
					echo APPLICATION_NAME." - v.".APPLICATION_VERSION." - Αυτοματισμοί";
					?>
					</h4>
				</div>

				<div class="modal-body">
					<?php
						echo create_library_aytomatismoi();
					?>
				</div>	
				<div class="modal-footer">			
					<button class="btn" data-dismiss="modal" aria-hidden="true" onclick="close_klines();">ΟΚ</button>
				</div>
			</div>
			</div>
			</div>
			<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
			<!-- ###################### Κρυφό popup_kaminades για εμφάνιση ###################### -->
			<div id="popup_kaminades" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 id="myModalLabel">
					<?php
					echo APPLICATION_NAME." - v.".APPLICATION_VERSION." - Καμινάδες";
					?>
					</h4>
				</div>

				<div class="modal-body">
					<?php
					
					?>
				</div>	
				<div class="modal-footer">			
					<button class="btn" data-dismiss="modal" aria-hidden="true" onclick="close_klines();">ΟΚ</button>
				</div>
			</div>
			</div>
			</div>
			<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
			<!-- ###################### Κρυφό popup_thyrides για εμφάνιση ###################### -->
			<div id="popup_thyrides" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 id="myModalLabel">
					<?php
					echo APPLICATION_NAME." - v.".APPLICATION_VERSION." - Θυρίδες";
					?>
					</h4>
				</div>

				<div class="modal-body">
					<?php
					
					?>
				</div>	
				<div class="modal-footer">			
					<button class="btn" data-dismiss="modal" aria-hidden="true" onclick="close_klines();">ΟΚ</button>
				</div>
			</div>
			</div>
			</div>
			<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
			<!-- ###################### Κρυφό popup_anemistires για εμφάνιση ###################### -->
			<div id="popup_anemistires" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 id="myModalLabel">
					<?php
					echo APPLICATION_NAME." - v.".APPLICATION_VERSION." - Ανεμιστήρες";
					?>
					</h4>
				</div>

				<div class="modal-body">
					<?php
					
					?>
				</div>	
				<div class="modal-footer">			
					<button class="btn" data-dismiss="modal" aria-hidden="true" onclick="close_klines();">ΟΚ</button>
				</div>
			</div>
			</div>
			</div>
			<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
			<!-- ###################### Κρυφό popup_type για εμφάνιση ###################### -->
			<div id="popup_type" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h6 id="myModalLabel">
					<?php
					echo APPLICATION_NAME." - v.".APPLICATION_VERSION." - Τύπος χώρου";
					?>
					</h6>
				</div>

				<div class="modal-body">
					<?php
					
					?>
				</div>	
				<div class="modal-footer">			
					<button class="btn" data-dismiss="modal" aria-hidden="true" onclick="close_klines();">ΟΚ</button>
				</div>
			</div>
			</div>
			</div>
			<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
			<!-- ###################### Κρυφό popup_name για εμφάνιση ###################### -->
			<div id="popup_name" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h6 id="myModalLabel">
					<?php
					echo APPLICATION_NAME." - v.".APPLICATION_VERSION." - Όνομα ΜΘΧ/Ηλιακού χώρου";
					?>
					</h6>
				</div>

				<div class="modal-body">
					<?php
					
					?>
				</div>	
				<div class="modal-footer">			
					<button class="btn" data-dismiss="modal" aria-hidden="true" onclick="close_klines();">ΟΚ</button>
				</div>
			</div>
			</div>
			</div>
			<!-- ######################### Κρυφό div για εμφάνιση ######################### -->			
		
	</div><!--tab content-->
			</div><!--tabs-->

</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->