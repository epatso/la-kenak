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
	<small>Ηλιακός</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li><a href="#"><i class="fa fa-industry"></i> Συστήματα</a></li>
	<li class="active"> Ηλιακός</li>
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
			<li class="active"><a href="#tabs-1" data-toggle="tab">Συντελεστής αξιοποίησης syna</a></li>
			<li><a href="#tabs-2" data-toggle="tab">Μηνιαία κάλυψη f</a></li>
			<li><a href="#tabs-3" data-toggle="tab">Πίνακες ΤΟΤΕΕ</a></li>
		</ul>
		<div class="tab-content">	
			<!--Ηλιακός συλλέκτης-->
			<div class="tab-pane active" id="tabs-1">

<table class="table table-bordered">
	<tr class="success">
	<td colspan="3">Συντελεστής αξιοποίησης ηλιακής ακτινοβολίας για ΖΝΧ</td>
	</tr>
	
	<tr>
	<th>Παράμετρος</th>
	<th>Τιμή</th>
	</tr>
	
	<tr>
	<td>Χρήση κτιρίου</td>
	<td>
	<select class="form-control" id="solar_xrisi" onchange=get_syna(); >
	<option value=1>Κατοικίες</option>
	<option value=2>Τριτογενής τομέας</option>
	</select>
	</td>
	</tr>
	
	<tr>
	<td>Τύπος συλλέκτη:</td>
	<td>
	<select class="form-control" id="solar_type" onchange=get_syna(); >
	<option value=1>Απλός</option>
	<option value=2>Επιλεκτικός</option>
	<option value=3>Κενού</option>
	</select>
	</tr>
	
	<tr>
	<td>Κλίση ηλιακού συλλέκτη (β,<sup>o</sup>)</td>
	<td>
	<input class="form-control" type="text" id="solar_deg" onkeyup=get_syna(); />
	</td>
	</tr>
	
	<tr>
	<td>Περιοχή εγκατάστασης (κοντινότερη)</td>
	<td>
	<select class="form-control" id="solar_place" onchange=get_syna(); >
	<?php
	echo create_select_optionsid("vivliothiki_syna_ktiria","place");
	?>
	</select>
	</td>
	</tr>
	
	<tr>
	<td>Κατάσταση συλλέκτη</td>
	<td>
	<div class="control-group warning">
	<label class="checkbox"><input id="solar_katastasi" type="checkbox" value="" onclick=get_syna();>
	Κακοσυντηρημένες μονάδες (φθορές στη συλλεκτική επιφάνεια ή διαρροή)</label>
	</div>
	</td>
	</tr>
	
	<tr>
	<td>Συντελεστής αξιοποίησης (συνα, -)</td>
	<td>
	<input class="form-control" type="text" id="syna" disabled="disabled" />
	</td>
	</tr>
	
</table>

<span id="solar_bar">			

			
			</div>
			<!--Ηλιακός συλλέκτης-->
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

function get_syna(){
	var solar_xrisi = document.getElementById('solar_xrisi').value;
	var solar_type = document.getElementById('solar_type').value;
	var solar_deg = document.getElementById('solar_deg').value;
	var solar_place = document.getElementById('solar_place').value;
	
	var katastasi;
	var solar_katastasi = document.getElementById('solar_katastasi').checked;
	if(solar_katastasi == true){
		katastasi = 0.8;
	}else{
		katastasi = 1;
	}
	
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","includes/functions_calc.php?solar_xrisi="+solar_xrisi+"&solar_type="+solar_type+"&solar_deg="+solar_deg+"&solar_place="+solar_place ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		var syna = xmlhttp.responseText;
		syna = syna * katastasi;
		var syna100 = number_format(syna*100,3);
		document.getElementById("syna").value=number_format(syna,3);
		var result ="Ο ηλιακός συλλέκτης αξιοποιεί το "+syna100+"% της προσπίπτουσας ηλιακής ακτινοβολίας<br/>";
		if(syna100<=96){
		result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-success\" style=\"width: "+syna100+"%;\">"+syna100+"%</div></div>";
		}else{
		result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-success\" style=\"width: "+syna100+"%;\"></div></div>";
		}
		document.getElementById("solar_bar").innerHTML = result;
	}}
}
</script>		

	
			<!--ΜΕΘΟΔΟΣ ΚΑΜΠΥΛΩΝ F-->
			<div class="tab-pane" id="tabs-2">
			
			<table class="table table-bordered">
				
				<tr class="success">
				<th>Παράμετρος</th>
				<th>Τιμή</th>
				</tr>
				
				<tr class="success">
				<th colspan="2">Βασικές παράμετροι</th>
				</tr>
				<tr>
				<td>Επιφάνεια συλλέκτη A<sub>c</sub> (m<sup>2</sup>)</td>
				<td><input class="form-control" type="text" id="f_ac" onkeyup="" /></td>
				</tr>
				<tr>
				<td>Θέση τοποθέτησης (Κλιματικά δεδομένα)</td>
				<td>
					<select class="form-control" id="f_climate" onchange="" >
						<option value="no" selected="selected">Επιλέξτε περιοχή....</option>
						<option value="Αθήνα (Ελληνικό)">Αθήνα (Ελληνικό)</option>
						<option value="Αθήνα (Φιλαδέλφεια)">Αθήνα (Φιλαδέλφεια)</option>
						<option value="Αγρίνιο">Αγρίνιο</option>
						<option value="Αγχίαλος">Αγχίαλος</option>
						<option value="Αλεξανδρούπολη">Αλεξανδρούπολη</option>
						<option value="Αλίαρτος">Αλίαρτος</option>
						<option value="Ανδραβίδα">Ανδραβίδα</option>
						<option value="Άραξος">Άραξος</option>
						<option value="Άργος (Πυργέλα)">Άργος (Πυργέλα)</option>
						<option value="Αργοστόλι">Αργοστόλι</option>
						<option value="Άρτα">Άρτα</option>
						<option value="Ζάκυνθος">Ζάκυνθος</option>
						<option value="Ηράκλειο">Ηράκλειο</option>
						<option value="Θεσαλλονίκη">Θεσαλλονίκη</option>
						<option value="Ιεράπετρα">Ιεράπετρα</option>
						<option value="Ιωάννινα">Ιωάννινα</option>
						<option value="Καλαμάτα">Καλαμάτα</option>
						<option value="Καστοριά">Καστοριά</option>
						<option value="Κέρκυρα">Κέρκυρα</option>
						<option value="Κομοτηνή">Κομοτηνή</option>
						<option value="Κόνιτσα">Κόνιτσα</option>
						<option value="Κόρινθος">Κόρινθος</option>
						<option value="Κύθηρα">Κύθηρα</option>
						<option value="Λαμία">Λαμία</option>
						<option value="Λάρισα">Λάρισα</option>
						<option value="Λήμνος">Λήμνος</option>
						<option value="Μεθώνη">Μεθώνη</option>
						<option value="Μήλος">Μήλος</option>
						<option value="Μυτιλήνη">Μυτιλήνη</option>
						<option value="Νάξος">Νάξος</option>
						<option value="Πάρος">Πάρος</option>
						<option value="Πάτρα">Πάτρα</option>
						<option value="Πύργος">Πύργος</option>
						<option value="Ρέθυμνο">Ρέθυμνο</option>
						<option value="Ρόδος">Ρόδος</option>
						<option value="Σάμος">Σάμος</option>
						<option value="Σέρρες">Σέρρες</option>
						<option value="Σητεία">Σητεία</option>
						<option value="Σκύρος">Σκύρος</option>
						<option value="Σούδα">Σούδα</option>
						<option value="Σύρος">Σύρος</option>
						<option value="Τανάγρα">Τανάγρα</option>
						<option value="Τρίκαλα">Τρίκαλα</option>
						<option value="Τρίπολη">Τρίπολη</option>
						<option value="Τυμπάκιο">Τυμπάκιο</option>
						<option value="Χανιά">Χανιά</option>
						<option value="Χίος">Χίος</option>
						<option value="Χρυσούπολη">Χρυσούπολη</option>
					</select>
				</td>
				</tr>
				<tr>
				<td>Προσανατολισμός συλλέκτη (deg) Θεωρείται η βέλτιστη 180ο</td>
				<td><input class="form-control" type="text" id="f_g" value="180" /></td>
				</tr>
				<tr>
				<td>Κλίση συλλέκτη (deg)</td>
				<td>
					<select class="form-control" id="f_b" onchange="" >
						<option value=0>0</option>
						<option value=10>10</option>
						<option value=20>20</option>
						<option value=30>30</option>
						<option value=40>40</option>
						<option value=45 selected>45</option>
						<option value=50>50</option>
						<option value=60>60</option>
						<option value=70>70</option>
						<option value=80>80</option>
						<option value=90>90</option>
					</select>
				</td>
				</tr>
				<tr>
				<td>Χρήση κτιρίου</td>
				<td>
				<select class="form-control" id="f_xrisi" name="f_xrisi" onchange="f_klines();">
					<option value=0>Επιλέξτε χρήση...</option>
					<?php
					echo create_select_optionsid("vivliothiki_conditions","xrisi");
					?>
				</select>
				</td>
				</tr>
				
				<tr>
					<td>Εμβαδόν θερμικής ζώνης (m<sup>2</sup>):</td>
					<td><input class="form-control" type="text" id="f_zone_e"/></td>
				</tr>
				<tr>
					<td>Κλίνες:</td>
					<td><input class="form-control" type="text" id="f_klines" disabled="disabled"/></td>
				</tr>
				
				<tr>
				<td>Επιθυμητή θερμοκρασία ΖΝΧ (<sup>o</sup>C)</td>
				<td><input class="form-control" type="text" id="f_t_znx" value="50" /></td>
				</tr>
				
				<tr class="success">
				<th colspan="2">Δευτερεύουσες παράμετροι (Χαρακτηριστικά συλλέκτη από κατασκευαστή)</th>
				</tr>
				<tr>
				<td>Υπολογισμός για</td>
				<td>
					<select class="form-control" id="f_calctype" onchange="" >
						<option value=1>ZNX</option>
						<option value=2>Θέρμανση (υπό κατασκευή)</option>
					</select>
				</td>
				</tr>
				
				<tr>
				<td>Τύπος συλλέκτη</td>
				<td>
					<select class="form-control" id="f_solartype" onchange="" >
						<option value=1>Μαύρο χρώμα, 1 υαλοπίνακας</option>
						<option value=2>Μαύρο χρώμα, 2 υαλοπίνακες ή επιλεκτική επιφάνεια με 1 υαλοπίνακα</option>
						<option value=3>Σωλήνες κενού-αέρος</option>
						<option value=4>Απλός συλλέκτης (πλαστικοί σωλήνες) χωρίς κάλυμμα και μόνωση (ταχύτητα ανέμου 2.2m/s)</option>
					</select>
				</td>
				</tr>
				
				<tr>
				<td>Εναλλάκτης (F<sub>R</sub>')/(F<sub>R</sub>, k<sub>3</sub>)</td>
				<td>
					<label class="checkbox"><input id="f_enallaktis" type="checkbox" value="">Ύπαρξη εναλλάκτη</label>
				</td>
				</tr>
				
				<tr>
				<td>Όγκος δεξαμενής (boiler) σε λίτρα</td>
				<td><input class="form-control" type="text" id="f_m" onkeyup="" /></td>
				</tr>
				
				<tr>
				<td>U*A κτιρίου (για θέρμανση</td>
				<td><input class="form-control" type="text" id="f_ua" onkeyup="" /></td>
				</tr>
			</table>
			<br/>
			<a class="btn btn-default" title="Υπολογισμός" role="button" onclick=calc_fcharts();><i class="fa fa-compass"></i> Υπολογισμός</a><br/>
			<br/>
			<hr>
			<div id="fcharts_table"></div>
			
			</div>
			<!--ΜΕΘΟΔΟΣ ΚΑΜΠΥΛΩΝ F-->
			
<script>
function f_klines(){
var xrisi = document.getElementById('f_xrisi').value;
var klines = document.getElementById('f_klines');

	if(xrisi==0){klines.value=0;klines.disabled = true;}
	
	if(xrisi>=1 && xrisi<=17){klines.disabled = false;}
	if(xrisi>=18 && xrisi<=33){klines.value=0;klines.disabled = true;}
	if(xrisi>=34 && xrisi<=40){klines.disabled = false;}
	if(xrisi==41){klines.value=0;klines.disabled = true;}
	if(xrisi==42){klines.disabled = false;}
	if(xrisi>=42){klines.value=0;klines.disabled = true;}
}

function calc_fcharts(){
	var f_ac = document.getElementById('f_ac').value;
	var f_climate = document.getElementById('f_climate').value;
	var f_g = document.getElementById('f_g').value;
	var f_b = document.getElementById('f_b').value;
	var f_xrisi = document.getElementById('f_xrisi').value;
	var f_zone_e = document.getElementById('f_zone_e').value;
	var f_klines = document.getElementById('f_klines').value;
	var f_t_znx = document.getElementById('f_t_znx').value;
	var f_calctype = document.getElementById('f_calctype').value;
	var f_solartype = document.getElementById('f_solartype').value;
	var f_m = document.getElementById('f_m').value;
	
	var f_enallaktis;
	var f_enallaktis = document.getElementById('f_enallaktis').checked;
	if(f_enallaktis == true){
		f_enallaktis = 1;
	}else{
		f_enallaktis = 0;
	}
	
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	var link = "includes/functions_calc.php?get_fcharts_table=1";
	link += "&f_ac="+f_ac+"&f_climate="+f_climate+"&f_g="+f_g+"&f_b="+f_b+"&f_xrisi="+f_xrisi+"&f_zone_e="+f_zone_e+"&f_klines="+f_klines;
	link += "&f_t_znx="+f_t_znx+"&f_calctype="+f_calctype+"&f_solartype="+f_solartype+"&f_enallaktis="+f_enallaktis+"&f_m="+f_m;
	
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		var result = xmlhttp.responseText;
		document.getElementById("fcharts_table").innerHTML=result;
	}}
	
	gotoBottom("fcharts_table");
}

function gotoBottom(id){
   var element = document.getElementById(id);
   element.scrollTop = element.scrollHeight - element.clientHeight;
}
</script>
			
			
			
			<!--Πίνακες ΤΟΤΕΕ-->
			<div class="tab-pane" id="tabs-3">
				<?php
				include("accordions_solar.php");
				?>
			</div>
			<!--Πίνακες ΤΟΤΕΕ-->
			
		
	</div><!--tab content-->
			</div><!--tabs-->
</div><!--col-md-12-->
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

