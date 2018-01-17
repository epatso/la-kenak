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
	<small>ΖΝΧ</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li><a href="#"><i class="fa fa-industry"></i> Συστήματα</a></li>
	<li class="active"> ΖΝΧ</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
<div class="col-md-12">		
		<!--tabs-->
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab">Μονάδα παραγωγής</a></li>
			<li><a href="#tabs-2" data-toggle="tab">Δίκτυο διανομής</a></li>
			<li><a href="#tabs-3" data-toggle="tab">Αποθηκευτικές μονάδες</a></li>
			<li><a href="#tabs-4" data-toggle="tab">Πίνακες ΤΟΤΕΕ</a></li>
		</ul>
		<div class="tab-content">	
			<!--Μονάδα παραγωγής-->
			<div class="tab-pane active" id="tabs-1">
			
<table class="table table-bordered">
	<tr class="warning">
	<td colspan="2">Θερμική ισχύς P<sub>n</sub> τοπικού θερμαντήρα</td>
	</tr>
	
	<tr>
	<th>Παράμετρος</th>
	<th>Τιμή</th>
	</tr>
	
	<tr>
	<td>Ζητούμενο ημερήσιο φορτίο V<sub>d</sub> (l/day)</td>
	<td>
		<input class="form-control" type="text" id="znxp_vd" onkeyup=calc_pn(); onchange=calc_pn();/>
		<a href="#zitisi_popup" role="button" class="btn btn-warning" data-toggle="modal" title="Υπολογισμός"><i class="glyphicon glyphicon-question-sign"></i></a>
		<a href="Javascript:newPopup('?nav=calc_synthikes');" role="button" class="btn btn-info" title="Σε νέο παράθυρο"><i class="glyphicon glyphicon-upload"></i></a>
	</td>
	</tr>
	
	<tr>
	<td>Μέσος χρόνος απόδοσης θερμικής ενέργειας H (h)</td>
	<td><input class="form-control" type="text" id="znxp_h" value="5" onkeyup=calc_pn(); /></td>
	</tr>
	
	<tr>
	<td>Θερμοκρασία νερού δικτύου T<sub>1</sub> (<sup>o</sup>C)</td>
	<td>
	<select class="form-control" id="znxp_zone" onchange="calc_t1();calc_pn();" >
	<option value=0>Ζώνη</option>
	<option value=12.8>Α</option>
	<option value=10.1>Β</option>
	<option value=6.5>Γ</option>
	<option value=4.2>Δ</option>
	</select>
	<input class="form-control" type="text" id="znxp_t1" onkeyup=calc_pn(); /></td>
	</tr>
	
	<tr>
	<td>Θερμοκρασία σχεδιασμού T<sub>2</sub> (<sup>o</sup>C)</td>
	<td><input class="form-control" type="text" id="znxp_t2" value="45" onkeyup=calc_pn(); /></td>
	</tr>
	
	<tr>
	<td>Χωρητικότητα θερμαντήρα V<sub>store</sub>=V<sub>d</sub>/H (l)</td>
	<td><input class="form-control" type="text" id="znxp_vstore" disabled="disabled" /></td>
	</tr>
	<tr>
	<td>Ημερήσιο απαιτούμενο θερμικό φορτίο Q<sub>d</sub>=V<sub>d</sub>*(c/3600)*ρ*ΔΤ (kWh/d)</td>
	<td><input class="form-control" type="text" id="znxp_qd" disabled="disabled" /></td>
	</tr>
	<tr>
	<td>Θερμική ισχύς P<sub>n</sub>=Q<sub>d</sub>/H (KW)</td>
	<td><input class="form-control" type="text" id="znxp_pn" disabled="disabled" /></td>
	</tr>
</table>
	
<blockquote>
<small>
Πυκνότητα του νερού: ρ = 1Kg/l
</small>
<small>
Ειδική θερμότητα: c = 4.18KJ/(Kg.K)
</small>
<small>
Θερμοκρασία σχεδιασμού: Τ<sub>2</sub> = 45<sup>o</sup>C
</small>
<small>
ΔΤ: Τ<sub>2</sub> - Τ<sub>1</sub>
</small>
</blockquote>

<!-- ###################### Κρυφό zitisi_popup για εμφάνιση ###################### -->
<div id="zitisi_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h4 id="myModalLabel">
		<?php
		echo APPLICATION_NAME." - v.".APPLICATION_VERSION." Ημερήσια κατανάλωση ΖΝΧ";
		?>
		</h4>
	</div>

	<div class="modal-body">
		<p>
			<table class="table table-bordered">
			<tr>
			<td>Επιλέξτε χρήση για τη θερμική ζώνη:</td>
			<td>
			<select class="form-control" id="znx_xrisi" name="xrisi" onchange="get_synth_zwnis();allow_options();">
				<option value=0>Επιλέξτε χρήση...</option>
				<?php
				echo create_select_optionsid("vivliothiki_conditions_zone","name");
				?>
			</select>
			</td>
			</tr>
			
			<tr>
			<td><span id="emvadon_title">Εμβαδόν θερμικής ζώνης (m<sup>2</sup>):</span></td>
			<td><input class="form-control" type="text" id="znx_emvadon" onkeyup=get_synth_zwnis(); /></td>
			</tr>
			
			<tr>
			<td>Επιπλέον επιλογές: </td>
			<td>
			<div class="input-group" id="znx_div_klines" style="display: none;">
				<span class="input-group-addon" style="background-color: #C1FFC1"><i class="fa fa-bed" aria-hidden="true"></i> Κλίνες/ΥΔ</span>
				<input class="form-control" type="text" id="znx_klines" name="klines" onkeyup=get_synth_zwnis(); />
			</div>
			<div class="input-group" id="znx_div_hotel" style="display: none;">
				<span class="input-group-addon" style="background-color: #ffcfdf"><i class="fa fa-plane" aria-hidden="true"></i> Ξενοδοχείο</span>
				<select class="form-control" id="znx_hotel_cat" onchange=get_synth_zwnis();>
					<option value=1>LUX</option>
					<option value=2>Α ή Β</option>
					<option value=3>Γ</option>
				</select>
			</div>
			<div class="input-group" id="znx_div_hospital" style="display: none;">
				<span class="input-group-addon" style="background-color: #eed9fa"><i class="fa fa-hospital-o" aria-hidden="true"></i> Νοσοκομείο</span>
				<select class="form-control" id="znx_hospital_cat" onchange=get_synth_zwnis();>
					<option value=1>Νοσοκομείο <500 κλίνες</option>
					<option value=2>Νοσοκομείο >500 κλίνες</option>
					<option value=3>Κλινική</option>
				</select>
			</div>
			</td>
			</tr>
			
			<tr>	
				<td>lt/άτομο * άτομα/100m<sup>2</sup> * m<sup>2</sup> [ανά ημέρα]</td>	
				<td><input class="form-control" type="text" id="znx_lt_perperson" /></td>
			</tr>	
			<tr>	
				<td>lt/m<sup>2</sup> * m<sup>2</sup> [ανά ημέρα]</td>	
				<td><input class="form-control" type="text" id="znx_lt_perm2" /></td>
			</tr>	
			<tr>	
				<td>m3/κλίνη * κλίνες [ανά έτος]</td>
				<td>
				<input class="form-control" type="text" id="znx_m3_perroom" />
				</td>
			</tr>
			<tr>	
				<td>m<sup>3</sup>/m<sup>2</sup> * m<sup>2</sup> [ανά έτος]</td>
				<td>
				<input class="form-control" type="text" id="znx_m3_perm2"/>
				</td>
			</tr>
			</table>
		</p>
	</div>

	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">ΟΚ</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

		
			</div>
			<!--Μονάδα παραγωγής-->
<script>
function allow_options(){
var xrisi = document.getElementById('znx_xrisi').value;
var div_klines = document.getElementById('znx_div_klines');
var div_hotel = document.getElementById('znx_div_hotel');
var div_hospital = document.getElementById('znx_div_hospital');
	
	if(xrisi!=0){
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","includes/functions_calc.php?id_xrisi="+xrisi ,true);
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
	
	}else{//xrisi!=0
		div_klines.style.display = "none";
		div_hotel.style.display = "none";
		div_hospital.style.display = "none";
	}
	get_synth_zwnis();
}

function get_synth_zwnis(){
	var xrisi = document.getElementById('znx_xrisi').value;
	var e = document.getElementById("znx_emvadon").value;
	var klines = document.getElementById("znx_klines").value;
	var hotel = document.getElementById('znx_hotel_cat').value;
	var hospital = document.getElementById('znx_hospital_cat').value;
	
	if(klines==""){klines=0;}
	
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","includes/functions_calc.php?id_xrisi="+xrisi+"&hotel="+hotel+"&hospital="+hospital ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	var arr = JSON.parse(xmlhttp.responseText);
		
		var persons=arr["air_persons"]*(e/100);
		document.getElementById("znx_lt_perperson").value=arr["znx_lt_perperson"]*persons;
		document.getElementById("znx_lt_perm2").value=arr["znx_lt_perm2"]*e;
		document.getElementById("znx_m3_perroom").value=arr["znx_m3_perroom"]*klines;
		document.getElementById("znx_m3_perm2").value=arr["znx_m3_perm2"]*e;
		
		var has_znx=arr["has_znx"];
		var znx_calc_type=arr["znx_calc_type"];
		var znx_calctype_txt,znx,znx_lt;
		if(has_znx!=0){
			if(znx_calc_type==0){
				znx_calctype_txt="Με βάση δομημένη επιφάνεια";
				znx=arr["znx_m3_perm2"]*e;
			}
			if(znx_calc_type==1){
				znx_calctype_txt="Με βάση κλίνες";
				znx=arr["znx_m3_perroom"]*klines;
			}
			if(znx_calc_type==2){
				znx_calctype_txt="Με βάση κλίνες και τύπο ξενοδοχείου";
				znx=arr["znx_m3_perroom"]*klines;
			}
			if(znx_calc_type==3){
				znx_calctype_txt="Με βάση κλίνες και τύπο κλινικής";
				znx=arr["znx_m3_perroom"]*klines;
			}
		}else{
			znx_calctype_txt="Δεν υπάρχει απαίτηση";
			znx=0;
		}
		znx_lt = znx*1000/365
		
		document.getElementById("znxp_vd").value=number_format(znx_lt,3,".","");
		document.getElementById('dianomi_znx_lt').value = number_format(znx_lt,3,".","");
		calc_pn();
		
	}}
}

// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=600,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes')
}

function calc_t1(){
var t1 = document.getElementById('znxp_zone').value;
	if(t1==0){
		document.getElementById('znxp_t1').disabled = false;
	}else{
		document.getElementById('znxp_t1').disabled = true;
		document.getElementById('znxp_t1').value = t1;
	}
}

function calc_pn(){
var znxp_vd = document.getElementById('znxp_vd').value;
var znxp_h = document.getElementById('znxp_h').value;
var znxp_t1 = document.getElementById('znxp_t1').value;
var znxp_t2 = document.getElementById('znxp_t2').value;

var v_store = znxp_vd/znxp_h;
var qd = znxp_vd*(4.18/3600)*1*(znxp_t2-znxp_t1);
var pn = qd/znxp_h;

document.getElementById('znxp_vstore').value = number_format(v_store,3);
document.getElementById('znxp_qd').value = number_format(qd,3);
document.getElementById('znxp_pn').value = number_format(pn,3);

}

</script>
			
			<!--Δίκτυο διανομής-->
			<div class="tab-pane" id="tabs-2">

<table class="table table-bordered">
	<tr class="info">
	<td colspan="2">Βαθμός απόδοσης δικτύου διανομής</td>
	</tr>
	
	<tr>
	<th>Παράμετρος</th>
	<th>Τιμή</th>
	</tr>
	
	<tr>
	<td>Ημερήσια ζήτηση ΖΝΧ (lt)</td>
	<td>
	<input class="form-control" type="text" id="dianomi_znx_lt" onkeyup=get_dianomi_znx_n(); />
	</td>
	</tr>
	
	<tr>
	<td>Ανακυκλοφορία</td>
	<td>
	<select class="form-control" id="dianomi_znx_ana" onchange=get_dianomi_znx_n(); >
	<option value=0>Επιλέξτε...</option>
	<option value=1>Χωρίς ανακυκλοφορία</option>
	<option value=2>Με ανακυκλοφορία</option>
	</select>
	</td>
	</tr>
	
	<tr>
	<td>Μόνωση</td>
	<td>
	<select class="form-control" id="dianomi_znx_monwsi" onchange=get_dianomi_znx_n(); >
	<option value=0>Επιλέξτε...</option>
	<option value=1>Μόνωση κτηρίου αναφοράς</option>
	<option value=2>Ανεπαρκής μόνωση</option>
	<option value=3>Χωρίς μόνωση</option>
	</select>
	</td>
	</tr>
	
	<tr>
	<th>Βαθμός απόδοσης Δικτύου διανομής</th>
	<td>
	<input class="form-control" type="text" id="dianomi_znx_n" disabled="disabled" onchange=get_dianomi_znx_n(); />
	</td>
	</tr>
	
</table>
<span id="distribution_bar"></span>


<blockquote>
	<small>			
	Σε περίπτωση τοπικών μονάδων παραγωγής Ζ.Ν.Χ. (π.χ. σε κτήρια κατοικιών), όπου το δίκτυο διανομής είναι μικρό, οι απώλειες δικτύου λαμβάνονται μηδενικές.
	</small>
	<small>
	Σε περίπτωση θερμικής ζώνης με περισσότερους του ενός κλάδους διανομής Ζ.Ν.Χ. και με διαφορετικές θερμικές αποδόσεις των κλάδων, για τους υπολογισμούς λαμβάνεται 
	υπόψη η χαμηλότερη θερμική απόδοση μεταξύ των δύο κλάδων.
	</small>
	<small>
	Σε περίπτωση μη ύπαρξης συστήματος παραγωγής Ζ.Ν.Χ. θεωρείται ότι το κτήριο διαθέτει σύστημα παραγωγής Ζ.Ν.Χ. όπως το κτήριο αναφοράς, με διέλευση από εσωτερικούς 
	χώρους και χωρίς ανακυκλοφορία. Στις χρήσεις κτηρίων κατά τις οποίες το κτήριο αναφοράς διαθέτει κεντρικό σύστημα παραγωγής Ζ.Ν.Χ., τότε και το εξεταζόμενο κτήριο 
	θα διαθέτει κεντρικό σύστημα παραγωγής Ζ.Ν.Χ. και με απώλειες δικτύου διανομής, ανάλογα με την ημερήσια ζήτηση Ζ.Ν.Χ.
	</small>
</blockquote>	
			</div>
			<!--Δίκτυο διανομής-->

<script>
function get_dianomi_znx_n(){
	var dianomi_znx_lt = document.getElementById('dianomi_znx_lt').value;
	var dianomi_znx_ana = document.getElementById('dianomi_znx_ana').value;
	var dianomi_znx_monwsi = document.getElementById('dianomi_znx_monwsi').value;
	
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","includes/functions_calc.php?dianomi_znx_lt="+dianomi_znx_lt+"&dianomi_znx_ana="+dianomi_znx_ana+"&dianomi_znx_monwsi="+dianomi_znx_monwsi ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		var n = xmlhttp.responseText;
		var n100 = number_format(n*100,2);
		document.getElementById("dianomi_znx_n").value=n;
		var result ="Το δίκτυο διανομής αποδίδει στις τερματικές μονάδες το "+n100+"% της θερμικής ενέργειας για τα "+dianomi_znx_lt+"lt ZNX.<br/>";
		if(n100<=96){
		result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-info\" style=\"width: "+n100+"%;\">"+n100+"%</div></div>";
		}else{
		result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-info\" style=\"width: "+n100+"%;\"></div></div>";
		}
		document.getElementById("distribution_bar").innerHTML = result;
	}}
}
</script>			
			
			<!--ΑΠΟΘΗΚΕΥΤΙΚΕΣ μονάδες-->
			<div class="tab-pane" id="tabs-3">

<table class="table table-bordered">
	<tr class="info">
	<td colspan="4">Βαθμός απόδοσης τερματικών μονάδων</td>
	</tr>
	
	<tr>
	<th>Παράμετρος</th>
	<th>Υπολογισμός</th>
	<th>Απώλειες [%]</th>
	</tr>
	
	<tr>
	<td>
	Θερμικές απώλειες
	</td>
	<td>
	<select class="form-control" id="type_thermikes" onchange=calc_thermikes(); >
	<option value=0>Επιλέξτε...</option>
	<option value=5>Τοπικοί ή κεντρικοί θερμαντήρες (boiler)</option>
	<option value=0>Ηλεκτρικοί θερμαντήρες (θερμοσίφωνες)</option>
	</select>
	</td>
	<td><input class="form-control" type="text" id="thermikes" disabled="disabled" /></td>
	</tr>
	
	
	<tr>
	<td>
	Πλευρικές απώλειες
	</td>
	<td>
	<select class="form-control" id="type_pleyrikes" onchange=calc_pleyrikes(); >
	<option value=0>Επιλέξτε...</option>
	<option value=2>Εσωτερικά</option>
	<option value=7>Εξωτερικά</option>
	</select>
	</td>
	<td><input class="form-control" type="text" id="pleyrikes" disabled="disabled" /></td>
	</tr>
	
	<tr>
	<td colspan="2">
	Σύνολο απωλειών
	</td>
	<td><input class="form-control" type="text" id="znxa_n" disabled="disabled" /></td>
	</tr>
	
</table>	

<span id="termatikes_bar"></span>			
	
			</div>
			<!--ΑΠΟΘΗΚΕΥΤΙΚΕΣ μονάδες-->

<script>			
function calc_thermikes(){
var x = document.getElementById('type_thermikes').value;
document.getElementById('thermikes').value =x;
calc_znxa();
}

function calc_pleyrikes(){
var x = document.getElementById('type_pleyrikes').value;
document.getElementById('pleyrikes').value =x;
calc_znxa();
}

function calc_znxa(){
var x = document.getElementById('type_thermikes').value;
var y = document.getElementById('type_pleyrikes').value;
var n = +x + +y;
var apodosi = 100-n;
document.getElementById('znxa_n').value = n;
	var result ="Οι αποθηκευτικές μονάδες αποδίδουν το "+apodosi+"% της ισχύος που παραλαμβάνουν<br/>";
	if(apodosi<=96){
	result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-info active\" style=\"width: "+apodosi+"%;\">"+apodosi+"%</div></div>";
	}else{
	result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-info\" style=\"width: "+apodosi+"%;\"></div></div>";
	}
	document.getElementById("termatikes_bar").innerHTML=result;
}
</script>
	
			<!--Πίνακες ΤΟΤΕΕ-->
			<div class="tab-pane" id="tabs-4">
				<?php
				include("accordions_znx.php");
				?>
			</div>
			<!--Πίνακες ΤΟΤΕΕ-->			
<script>
function number_format (number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
</script>		
		
	</div><!--tab content-->
			</div><!--tabs-->
</div><!--col-md-12-->
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

