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
	<small>Θερμική ζώνη</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li class="active"> Θερμική ζώνη</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
	<div class="col-md-12">	
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab">Ελάχιστες απαιτήσεις</a></li>
			<li><a href="#tabs-2" data-toggle="tab">Αερισμός</a></li>
			<li><a href="#tabs-3" data-toggle="tab">Αυτοματισμοί</a></li>
			<li><a href="#tabs-4" data-toggle="tab">Θερμοχωρητικότητα</a></li>
		</ul>
			
		<div class="tab-content">	
			<!--tab-->
			<div class="tab-pane active" id="tabs-1">
			
			<form class="form-horizontal has-success" role="form">
			<div class="form-group">
				<label for="xrisi" class="col-sm-2 control-label">Επιλέξτε χρήση για τη θερμική ζώνη:</label>
				<div class="col-sm-6">
				<select class="form-control" id="xrisi" name="xrisi" onchange="allow_options();">
					<option value=0>Επιλέξτε χρήση...</option>
					<?php
					echo create_select_optionsid("vivliothiki_conditions_zone","name");
					?>
				</select>
				</div>
			</div>
			
			<div class="form-group">
				<label for="emvadon" class="col-sm-2 control-label">Εμβαδόν θερμικής ζώνης (m<sup>2</sup>):</label>
				<div class="col-sm-6">
				<input class="form-control" type="text" id="emvadon" name="emvadon" onkeyup=get_synth_zwnis(); />
				</div>
			</div>
			
			<div class="form-group" id="div_klines" style="display: none;">
				<label for="klines" class="col-sm-2 control-label">Κλίνες/ΥΔ:</label>
				<div class="col-sm-6">
				<input class="form-control" type="text" id="klines" name="klines" onkeyup=get_synth_zwnis(); />
				</div>
			</div>
			<div class="form-group" id="div_hotel" style="display: none;">
				<label for="klines" class="col-sm-2 control-label">Κατηγορία ξενοδοχείου/ξενώνα:</label>
				<div class="col-sm-6">
					<select class="form-control" id="hotel_cat" onchange=get_synth_zwnis();>
						<option value=1>LUX</option>
						<option value=2>Α ή Β</option>
						<option value=3>Γ</option>
					</select>
				</div>
			</div>
			<div class="form-group" id="div_hospital" style="display: none;">
				<label for="klines" class="col-sm-2 control-label">Κατηγορία νοσοκομείου/κλινικής:</label>
				<div class="col-sm-6">
				<select class="form-control" id="hospital_cat" onchange=get_synth_zwnis();>
						<option value=1>Νοσοκομείο <500 κλίνες</option>
						<option value=2>Νοσοκομείο >500 κλίνες</option>
						<option value=3>Κλινική</option>
					</select>
				</div>
			</div>
			</form>
			
			<table class="table table-condensed">
			<th colspan="3">Γρήγορα αποτελέσματα θερμικής ζώνης</th>
			<tr>
				<th>Είδος</th>
				<th>Τιμή</th>
				<th>Μονάδες</th>
			</tr>
			<tr>
				<td>Κατηγορία</td>
				<td><input class="form-control input-sm" type="text" id="gen_xrisi" /></td>
				<td>-</td>
			</tr>
			<tr>
				<td>Χρήση</td>
				<td><input class="form-control input-sm" type="text" id="eid_xrisi" /></td>
				<td>-</td>
			</tr>
			<tr>			
				<td>Τύπος υπολογισμού ΖΝΧ</td>
				<td><input class="form-control input-sm" type="text" id="znxcalctype1" /></td>
				<td>-</td>
			</tr>
			<tr>			
				<td>Άτομα</td>
				<td><input class="form-control input-sm" type="text" id="persons" /></td>
				<td>-</td>
			</tr>
			<tr>			
				<td>Απαίτηση ΖΝΧ</td>
				<td><input class="form-control input-sm" type="text" id="znx" /></td>
				<td>m<sup>3</sup>/έτος</td>
			</tr>
			<tr>			
				<td>Απαίτηση νωπού αέρα</td>
				<td><input class="form-control input-sm" type="text" id="air" /></td>
				<td>m<sup>3</sup>/h</td>
			</tr>
			<tr>			
				<td>Ελάχιστη ισχύς φωτισμού (εάν όλη η ζώνη έχει την ίδια στάθμη φωτισμού σε lx)</td>
				<td><input class="form-control input-sm" type="text" id="light" /></td>
				<td>W</td>
			</tr>
			
			<tr><th colspan="3">Συνθήκες της θερμικής ζώνης</th></tr>
			<tr><th colspan="3" bgcolor="#eeeeee">Ωράριο λειτουργίας</th></tr>
			<tr>
				<td>Ώρες λειτουργίας</td>
				<td><input class="form-control input-sm" type="text" id="t_h" /></td>
				<td>h</td>
			</tr>
			<tr>	
				<td>Ημέρες λειτουργίας</td>
				<td><input class="form-control input-sm" type="text" id="t_d" /></td>
				<td>d</td>
			</tr>
			<tr>	
				<td>Μήνες λειτουργίας</td>
				<td><input class="form-control input-sm" type="text" id="t_m" /></td>
				<td>m</td>
			</tr>
			
			<tr><th colspan="3" bgcolor="#eeeeee">Θερμοκρασία/Σχετική υγρασία</th></tr>
			<tr>
				<td>Θερμοκρασια χειμερινή περίοδος (<sup>o</sup>C)</td>
				<td><input class="form-control input-sm" type="text" id="ti_h" /></td>
				<td>(<sup>o</sup>C)</td>
			</tr>
			<tr>	
				<td>Θερμοκρασια θερινή περίοδος (<sup>o</sup>C)</td>
				<td><input class="form-control input-sm" type="text" id="ti_c" /></td>
				<td>(<sup>o</sup>C)</td>
			</tr>
			<tr>	
				<td>Σχετική υγρασία χειμερινή περίοδος (%)</td>
				<td><input class="form-control input-sm" type="text" id="xi_h" /></td>
				<td>%</td>
			</tr>
			<tr>	
				<td>Σχετική υγρασία % θερινή περίοδος (%)</td>
				<td><input class="form-control input-sm" type="text" id="xi_c" /></td>
				<td>%</td>
			</tr>
			
			<tr><th colspan="3" bgcolor="#eeeeee">Νωπός αέρας</th></tr>
			<tr>			
				<td>Άτομα</td>
				<td><input class="form-control input-sm" type="text" id="air_persons" /></td>
				<td>-</td>
			</tr>
			<tr>			
				<td>Νωπός αέρας/άτομο [m<sup>3</sup>/h/άτομο]</td>
				<td><input class="form-control input-sm" type="text" id="air_perperson" /></td>
				<td>m<sup>3</sup>/h/άτομο</td>
			</tr>
			<tr>			
				<td>Νωπός αέρας/m<sup>2</sup> [m<sup>3</sup>/h/m<sup>2</sup>]</td>
				<td><input class="form-control input-sm" type="text" id="air_perm2" /></td>
				<td>m<sup>3</sup>/h/m<sup>2</sup></td>
			</tr>
			
			<tr><th colspan="3" bgcolor="#eeeeee">Φωτισμός</th></tr>
			<tr>
				<td>Στάθμη φωτισμού (lx)</td>
				<td><input class="form-control input-sm" type="text" id="light_lux" /></td>
				<td>lx</td>
			</tr>
			<tr>	
				<td>Στάθμη φωτισμού (m)</td>
				<td><input class="form-control input-sm" type="text" id="light_height" /></td>
				<td>m</td>
			</tr>
			<tr>	
				<td>UGR</td>
				<td><input class="form-control input-sm" type="text" id="light_ugr" /></td>
				<td>-</td>
			</tr>
			<tr>	
				<td>U<sub>o</sub></td>
				<td><input class="form-control input-sm" type="text" id="light_uo" /></td>
				<td>-</td>
			</tr>
			<!--
			<tr>
				<td>Ώρες λειτουργίας ημέρας</td>
				<td><input class="form-control input-sm" type="text" id="hours_day" /></td>
				<td>h</td>
			</tr>
			<tr>	
				<td>Ώρες λειτουργίας νύχτας</td>
				<td><input class="form-control input-sm" type="text" id="hours_night" /></td>
				<td>h</td>
			</tr>
			-->
			<tr><th colspan="3" bgcolor="#eeeeee">Ισχύς από χρήστες</th></tr>
			<tr>	
				<td>W/άτομο</td>
				<td><input class="form-control input-sm" type="text" id="w_perperson" /></td>
				<td>watt/άτομο</td>
			</tr>
			<tr>	
				<td>W/m<sup>2</sup></td>
				<td><input class="form-control input-sm" type="text" id="w_perm2" /></td>
				<td>watt/m<sup>2</sup></td>
			</tr>
			<tr>	
				<td>Συντελεστής παρουσίας</td>
				<td><input class="form-control input-sm" type="text" id="w_f" /></td>
				<td>-</td>
			</tr>
			
			<tr><th colspan="3" bgcolor="#eeeeee">Ισχύς από εξοπλισμό</th></tr>
			<tr>	
				<td>W/m<sup>2</sup></td>
				<td><input class="form-control input-sm" type="text" id="eq_w_perm2" /></td>
				<td>watt/m<sup>2</sup></td>
			</tr>
			<tr>	
				<td>Συντελεστής ετεροχρονισμού</td>
				<td><input class="form-control input-sm" type="text" id="eq_ft" /></td>
				<td>-</td>
			</tr>
			<tr>	
				<td>W/m<sup>2</sup> (ετερ.)</td>
				<td><input class="form-control input-sm" type="text" id="eq_wt_perm2" /></td>
				<td>watt/m<sup>2</sup></td>
			</tr>
			<tr>	
				<td>Συντελεστής λειτουργίας</td>
				<td><input class="form-control input-sm" type="text" id="eq_f" /></td>
				<td>-</td>
			</tr>
			
			<tr><th colspan="3" bgcolor="#eeeeee">ZNX</th></tr>
			<tr>	
				<td>lt/άτομο/ημέρα</td>
				<td><input class="form-control input-sm" type="text" id="znx_lt_perperson" /></td>
				<td>lt/άτομο/ημέρα</td>
			</tr>
			<tr>	
				<td>lt/m<sup>2</sup>/ημέρα</td>
				<td><input class="form-control input-sm" type="text" id="znx_lt_perm2" /></td>
				<td>lt/m<sup>2</sup>/ημέρα</td>
			</tr>
			<tr>	
				<td>m<sup>3</sup>/κλίνη/έτος</td>
				<td><input class="form-control input-sm" type="text" id="znx_m3_perroom" /></td>
				<td>m<sup>3</sup>/κλίνη/έτος</td>
			</tr>
			<tr>	
				<td>m<sup>3</sup>/m<sup>2</sup>/έτος</td>
				<td><input class="form-control input-sm" type="text" id="znx_m3_perm2" /></td>
				<td>m<sup>3</sup>/m<sup>2</sup>/έτος</td>
			</tr>
			</table>
			
			<br/>
			<blockquote>
			<small>Απαραίτητη προυπόθεση κατά την εφαρμογή του Κ.ΕΝ.Α.Κ. είναι η κάλυψη τουλάχιστον του 60% 
			των αναγκών για ΖΝΧ από ανανεώσιμες πηγές (ηλιακά).</small>
			</blockquote>

<script>
function allow_options(){
var xrisi = document.getElementById('xrisi').value;
var div_klines = document.getElementById('div_klines');
var div_hotel = document.getElementById('div_hotel');
var div_hospital = document.getElementById('div_hospital');
var klines = document.getElementById("klines").value;
var hotel = document.getElementById('hotel_cat').value;
var hospital = document.getElementById('hospital_cat').value;
	
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
	
	}else{//xrisi!=0
		div_klines.style.display = "none";
		div_hotel.style.display = "none";
		div_hospital.style.display = "none";
	}
	get_synth_zwnis();
}


function get_synth_zwnis(){
	var xrisi = document.getElementById('xrisi').value;
	var e = document.getElementById("emvadon").value;
	var klines = document.getElementById("klines").value;
	var hotel = document.getElementById('hotel_cat').value;
	var hospital = document.getElementById('hospital_cat').value;
	
	if(klines==""){klines=0;}
	
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","includes/functions_calc.php?id_xrisi="+xrisi+"&hotel="+hotel+"&hospital="+hospital ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	var arr = JSON.parse(xmlhttp.responseText);
		document.getElementById("gen_xrisi").value=arr["gen_id"];
		document.getElementById("eid_xrisi").value=arr["name"];
		
		document.getElementById("t_h").value=arr["t_h"];
		document.getElementById("t_d").value=arr["t_d"];
		document.getElementById("t_m").value=arr["t_m"];
		document.getElementById("ti_h").value=arr["ti_h"];
		document.getElementById("ti_c").value=arr["ti_c"];
		document.getElementById("xi_h").value=arr["xi_h"];
		document.getElementById("xi_c").value=arr["xi_c"];
		document.getElementById("light_lux").value=arr["light_lux"];
		document.getElementById("light_height").value=arr["light_height"];
		document.getElementById("light_ugr").value=arr["light_ugr"];
		document.getElementById("light_uo").value=arr["light_uo"];
		
		document.getElementById("air_persons").value=arr["air_persons"];
		document.getElementById("air_perperson").value=arr["air_perperson"];
		document.getElementById("air_perm2").value=arr["air_perm2"];
		
		document.getElementById("w_perperson").value=arr["w_perperson"];
		document.getElementById("w_perm2").value=arr["w_perm2"];
		document.getElementById("w_f").value=arr["w_f"];
		document.getElementById("eq_w_perm2").value=arr["eq_w_perm2"];
		document.getElementById("eq_ft").value=arr["eq_ft"];
		document.getElementById("eq_wt_perm2").value=arr["eq_wt_perm2"];
		document.getElementById("eq_f").value=arr["eq_f"];
		
		document.getElementById("znx_lt_perperson").value=arr["znx_lt_perperson"];
		document.getElementById("znx_lt_perm2").value=arr["znx_lt_perm2"];
		document.getElementById("znx_m3_perroom").value=arr["znx_m3_perroom"];
		document.getElementById("znx_m3_perm2").value=arr["znx_m3_perm2"];
		
		var has_znx=arr["has_znx"];
		var znx_calc_type=arr["znx_calc_type"];
		var znx_calctype_txt,znx,air,light,persons;
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
		light=arr["light_kw"]*e;
		air=arr["air_perm2"]*e;
		
		persons=arr["air_persons"]*(e/100);
		
		document.getElementById("znxcalctype1").value=znx_calctype_txt;
		document.getElementById("znx").value=znx;
		document.getElementById("air").value=air;
		document.getElementById("light").value=light;
		document.getElementById("persons").value=persons;
		
	}}
}
</script>
			</div>
			<!--tab-1-->
			
			
			
			<!--tab-2-->
			<div class="tab-pane" id="tabs-2">

<table class="table table-bordered">
	<tr bgcolor="#ecf8f5">
		<th colspan="2" width=50% style="text-align:center;vertical-align:middle;">Είδος ανοίγματος (υαλοστάσια, πόρτες κ.ά.)</th>
		<th width=25% style="text-align:center;">Πίνακας 3.24 <br/>Πόρτες <br/>(m<sup>3</sup>/h/m<sup>2</sup>)</th>
		<th width=25% style="text-align:center;">Πίνακας 3.24 <br/>Παράθυρα <br/>(m<sup>3</sup>/h/m<sup>2</sup>)</th>
	</tr>
	<tr bgcolor="#f1faf8"><th colspan="4" style="text-align:center;">Κουφώματα με ξύλινο πλαίσιο χωρίς πιστοποίηση</th></tr>
	<tr>
		<td style="text-align:left;" colspan="2">
			Κούφωμα με μονό υαλοπίνακα, μη αεροστεγές, χωνευτό, επάλληλο, ανοιγόμενο.<br/>
			Κούφωμα χωρίς υαλοπίνακα (πόρτα) και χωρίς αεροστεγανότητα.
		</td>
		<td>
			<div class="input-group">
				<input class="form-control input-sm" type="text" id="ed1" onkeyup=calc_aerismos(); />
				<span class="input-group-addon">x11.8</span>
			</div>
		</td>
		<td>
			<div class="input-group">
				<input class="form-control input-sm" type="text" id="an1" onkeyup=calc_aerismos(); />
				<span class="input-group-addon">x15.1</span>
			</div>
		</td>
	</tr>
	<tr>
		<td style="text-align:left;" colspan="2">
			Κούφωμα με διπλό υαλοπίνακα, επάλληλα συρόμενο, με ψήκτρες, χωνευτό.<br/>
			Ανοιγόμενο κούφωμα, με διπλό υαλοπίνακα, χωρίς πιστοποίηση.<br/>
			Κούφωμα χωρίς υαλοπίνακα (πόρτα), με αεροστεγανότητα μη πιστοποιημένη.
		</td>
		<td>
			<div class="input-group">
				<input class="form-control input-sm" type="text" id="ed2" onkeyup=calc_aerismos(); />
				<span class="input-group-addon">x9.8</span>
			</div>
		</td>
		<td>
			<div class="input-group">
				<input class="form-control input-sm" type="text" id="an2" onkeyup=calc_aerismos(); />
				<span class="input-group-addon">x12.5</span>
			</div>
		</td>
	</tr>
	
	<tr>
	<tr bgcolor="#f1faf8"><th colspan="4" style="text-align:center;">Κουφώματα με μεταλλικό ή συνθετικό πλαίσιο χωρίς πιστοποίηση</th></tr>
	<tr>
		<td style="text-align:left;" colspan="2">
			Κούφωμα με μονό υαλοπίνακα, μη αεροστεγές, χωνευτό, επάλληλο, ανοιγόμενο.<br/>
			Κούφωμα χωρίς υαλοπίνακα (πόρτα) και χωρίς αεροστεγανότητα.
		</td>
		<td>
			<div class="input-group">
				<input class="form-control input-sm" type="text" id="ed3" onkeyup=calc_aerismos(); />
				<span class="input-group-addon">x7.4</span>
			</div>
		</td>
		<td>
			<div class="input-group">
				<input class="form-control input-sm" type="text" id="an3" onkeyup=calc_aerismos(); />
				<span class="input-group-addon">x8.7</span>
			</div>
		</td>
	</tr>
	<tr>
		<td style="text-align:left;" colspan="2">
			Κούφωμα με διπλό υαλοπίνακα, επάλληλα συρόμενο, με ψήκτρες, χωνευτό.<br/>
			Ανοιγόμενο κούφωμα, με διπλό υαλοπίνακα, χωρίς πιστοποίηση.<br/>
			Κούφωμα χωρίς υαλοπίνακα (πόρτα), με αεροστεγανότητα μη πιστοποιημένη.
		</td>
		<td>
			<div class="input-group">
				<input class="form-control input-sm" type="text" id="ed4" onkeyup=calc_aerismos(); />
				<span class="input-group-addon">x5.3</span>
			</div>
		</td>
		<td>
			<div class="input-group">
				<input class="form-control input-sm" type="text" id="an4" onkeyup=calc_aerismos(); />
				<span class="input-group-addon">x6.8</span>
			</div>
		</td>
	</tr>
	<tr bgcolor="#f1faf8"><th colspan="4" style="text-align:center;">Κουφώματα με μεταλλικό, συνθετικό ή ξύλινο πλαίσιο με πιστοποίηση κατά EN 12207(*)</th></tr>
	<tr>
		<td style="text-align:left;vertical-align:middle;" rowspan="4" width=25%>
			Κλάση αεροπερατότητας με βάση τη συνολική επιφάνεια του κουφώματος:
		</td>
		<td width=25% bgcolor="#fbfbfb" style="text-align:center;">1</td>
		<td colspan="2" width=50%>
			<div class="input-group">
				<input class="form-control input-sm" type="text" id="ep1" onkeyup=calc_aerismos(); />
				<span class="input-group-addon">x7.7</span>
			</div>
		</td>
	</tr>
	<tr>
		<td bgcolor="#f1f1f1" style="text-align:center;">2</td>
		<td colspan="2">
			<div class="input-group">
				<input class="form-control input-sm" type="text" id="ep2" onkeyup=calc_aerismos(); />
				<span class="input-group-addon">x4.1</span>
			</div>
		</td>
	</tr>
	<tr>
		<td bgcolor="#e7e7e7" style="text-align:center;">3</td>
		<td colspan="2">
			<div class="input-group">
				<input class="form-control input-sm" type="text" id="ep3" onkeyup=calc_aerismos(); />
				<span class="input-group-addon">x1.4</span>
			</div>
		</td>
	</tr>
	<tr>
		<td bgcolor="#dddddd" style="text-align:center;">4</td>
		<td colspan="2">
			<div class="input-group">
				<input class="form-control input-sm" type="text" id="ep4" onkeyup=calc_aerismos(); />
				<span class="input-group-addon">x0.5</span>
			</div>
		</td>
	</tr>
	<tr bgcolor="#f1faf8"><th colspan="4" style="text-align:center;">Γυάλινες προσόψεις</th></tr>
	<tr>
		<td colspan="4">
			Για τα μερικώς ανοιγόμενα κουφώματα των γυάλινων προσόψεων (π.χ. με προβαλλόμενα τμήματα) 
			λαμβάνεται υπόψη μόνο το μη σταθερό τμήμα, ανάλογα προς τις παραπάνω κατηγορίες αυτού του πίνακα.
		</td>
	</tr>
	
	<tr>
	<tr bgcolor="#f1faf8">
		<th colspan="2">ΣΥΝΟΛΟ</th>
		<td>
			<div class="input-group">
				<input class="form-control input-sm" type="text" id="calcair_embadon"/>
				<span class="input-group-addon">m<sup>2</sup></span>
			</div>
		</td>
		<td>
			<div class="input-group">
				<input class="form-control input-sm" type="text" id="calcair_air"/>
				<span class="input-group-addon">m<sup>3</sup>/h</span>
			</div>
		</td>
	</tr>
</table>		
			<blockquote>
			<small>Σε μη ανοιγόμενα τμήματα δεν υπολογίζεται αερισμός από χαραμάδες.</small>
			</blockquote>
<script>
function calc_aerismos(){
var ed1 = document.getElementById('ed1').value;
var ed2 = document.getElementById('ed2').value;
var ed3 = document.getElementById('ed3').value;
var ed4 = document.getElementById('ed4').value;
if(ed1==""){ed1=0;}
if(ed2==""){ed2=0;}
if(ed3==""){ed3=0;}
if(ed4==""){ed4=0;}

var an1 = document.getElementById('an1').value;
var an2 = document.getElementById('an2').value;
var an3 = document.getElementById('an3').value;
var an4 = document.getElementById('an4').value;
if(an1==""){an1=0;}
if(an2==""){an2=0;}
if(an3==""){an3=0;}
if(an4==""){an4=0;}

var ep1 = document.getElementById('ep1').value;
var ep2 = document.getElementById('ep2').value;
var ep3 = document.getElementById('ep3').value;
var ep4 = document.getElementById('ep4').value;
if(ep1==""){ep1=0;}
if(ep2==""){ep2=0;}
if(ep3==""){ep3=0;}
if(ep4==""){ep4=0;}

var embadon = ed1*1 + ed2*1 + ed3*1 + ed4*1 + an1*1 + an2*1 + an3*1 + an4*1 + ep1*1 + ep2*1 + ep3*1 + ep4*1;
var air = ed1*11.8 + ed2*9.8 + ed3*7.4 + ed4*5.3 + an1*15.1 + an2*12.5 + an3*8.7 + an4*6.8 + ep1*7.7 + ep2*4.1 + ep3*1.4 + ep4*0.5;
	
	document.getElementById('calcair_embadon').value = embadon;
	document.getElementById('calcair_air').value = air;
}
</script>			
			</div>
			<!--tab-2-->
			
			
			
			
			<!--tab-3-->
			<div class="tab-pane" id="tabs-3">
			<?php
			echo create_library_aytomatismoi();
			?>
			
			</div>
			<!--tab-3-->
			
			<!--tab-4-->
			<div class="tab-pane" id="tabs-4">
			
			<table>
			<tr>
			<td>Φέρων οργανισμός:</td>
			<td>
			<select class="form-control input-sm" id="cp_ferwn" name="cp_ferwn" onchange=get_cp_ferwn();>
				<option value=0>Επιλέξτε...</option>
				<option value=1>Ξύλινος σκελετός</option>
				<option value=2>Ελαφριά μεταλλική κατασκευή</option>
				<option value=3>Σκυρόδεμα</option>
				<option value=4>Λιθοδομές ή πλινθοδομές με συμπαγείς οπτόπλινθους ή ωμόπλινθους</option>
			</select>
			</td>
			</tr>
			
			<tr>
			<td>Πλήρωση:</td>
			<td>
			<select class="form-control input-sm" id="cp_plirwsi" name="cp_plirwsi" disabled="disabled" onchange=get_cp_plirwsi(); >
				<option value=0></option>
			</select>
			</td>
			</tr>
			<tr>
			<td>Ανηγμένη θερμοχωρητικότητα:</td>
			<td><span id="cp"></td>
			</tr>
			<tr>
			<td>Επιλογή στο TEE-KENAK:</td>
			<td><span id="software_option_cp"></td>
			</tr>
			</table>
			
			<br/><br/>
			<blackquote>
				Εάν η θερμομόνωση έχει τοποθετηθεί εσωτερικά το κτίριο ανήκει στην Κατηγορία 3.
			</blackquote>
			<br/>
			<?php
				echo create_library_ktiriocm();
			?>

<script>
function get_cp_ferwn(){
	var ferwn = document.getElementById('cp_ferwn').value;
	var x;
	
	if(ferwn==0){
		document.getElementById('cp_plirwsi').disabled=true;
	}else{
		document.getElementById('cp_plirwsi').disabled=false;
	}
	if(ferwn==1){
		x="<option value=0>Επιλέξτε...</option>";
		x+="<option value=80>Γυψοσανίδα ή ξύλο και εσωτερική θερμομόνωση</option>";	
	}	
	if(ferwn==2){
		x="<option value=0>Επιλέξτε...</option>";
		x+="<option value=110>Υαλοπετάσματα ή ελαφριά πετάσματα με θερμομόνωση</option>";	
	}
	if(ferwn==3){
		x="<option value=0>Επιλέξτε...</option>";
		x+="<option value=165>Ελαφροβαρείς τσιμεντόλιθοι ή γυψοσανίδα και ύπαρξη ψευδοροφών</option>";
		x+="<option value=280>Διάτρητες οπτόπλινθοι</option>";
	}
	if(ferwn==4){
		x="<option value=0>Επιλέξτε...</option>";
		x+="<option value=230>με οριζόντια στοιχεία από ξύλο</option>";
		x+="<option value=300>με οριζόντια στοιχεία από σκυρόδεμα</option>";
	}
	
	document.getElementById('cp_plirwsi').innerHTML = x;
	get_cp_plirwsi();
}

function get_cp_plirwsi(){
	var plirwsi = document.getElementById('cp_plirwsi').value;
	var x;
	document.getElementById('cp').innerHTML = plirwsi + " [KJ/(m2.K)]";
	
	if(plirwsi==0){x="";}
	if(plirwsi==80){x="Κατηγορία 1 ";}
	if(plirwsi==110){x="Κατηγορία 2 ";}
	if(plirwsi==165){x="Κατηγορία 3 ";}
	if(plirwsi==230){x="Κατηγορία 4 ";}
	if(plirwsi==280){x="Κατηγορία 5 ";}
	if(plirwsi==300){x="Κατηγορία 6 ";}
	x+="("+plirwsi + " KJ/m2.K)";
	
	document.getElementById('software_option_cp').innerHTML = x;
}
</script>				
			</div>
			<!--tab-4-->
		
	</div><!--tab content-->
			</div><!--tabs-->
</div> <!-- /.div-col-md-12 -->
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
