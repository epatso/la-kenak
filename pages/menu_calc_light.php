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
	<small>Φωτισμός</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li><a href="#"><i class="fa fa-industry"></i> Συστήματα</a></li>
	<li class="active"> Φωτισμός</li>
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
			<li class="active"><a href="#tabs-1" data-toggle="tab">Κατακόρυφα ανοίγματα</a></li>
			<li><a href="#tabs-2" data-toggle="tab">Ανοίγματα οροφής</a></li>
			<li><a href="#tabs-3" data-toggle="tab">Απόδοση λαμπτήρων</a></li>
			<li><a href="#tabs-4" data-toggle="tab">Πίνακες ΤΟΤΕΕ</a></li>
		</ul>
		<div class="tab-content">	
			<!--Κατακόρυφα ανοίγματα-->
			<div class="tab-pane active" id="tabs-1">


<table class="table table-bordered">
	<tr class="warning">
	<td colspan="2">Υπολογισμός περιοχής φυσικού φωτισμού κατακόρυφου ανοίγματος</td>
	</tr>
	<tr class="warning">
	<td colspan="2"><img src="images/style/light_platos.png" height="160px"></td>
	</tr>
	
	<tr>
	<th>Παράμετρος</th>
	<th>Τιμή</th>
	</tr>
	
	<tr>
	<td>Ύψος επιφάνειας εργασίας h<sub>ΕΕ</sub> (m)</td>
	<td><input class="form-control" type="text" id="light_an_height" onkeyup="calc_lightan();"></td>
	</tr>
	
	<tr>
	<td>Ύψος πρεκιού ανοίγματος h<sub>Π</sub> (m)</td>
	<td><input class="form-control" type="text" id="light_an_preki" onkeyup="calc_lightan();"></td>
	</tr>
	
	<tr>
	<td>Πλάτος παραθύρου W<sub>Π</sub> (m)</td>
	<td><input class="form-control" type="text" id="light_an_platos" onkeyup="calc_lightan();"></td>
	</tr>
	
	<tr>
	<td>Βάθος ζώνης φωτισμού L<sub>ΖΦΦ</sub>=2,5 x h<sub>ΖΦΦ</sub>=2,5 x (h<sub>Π</sub>-h<sub>ΕΕ</sub>) (m)</td>
	<td><input class="form-control" type="text" id="light_anff_vathos" disabled="disabled"></td>
	</tr>
	
	<tr>
	<td>Πλάτος ζώνης φωτισμού W<sub>ΖΦΦ</sub>=W<sub>Π</sub> + 0,5 x L<sub>ΖΦΦ</sub> (m)</td>
	<td><input class="form-control" type="text" id="light_anff_platos" disabled="disabled"></td>
	</tr>
</table>
			
			</div>
			<!--Κατακόρυφα ανοίγματα-->
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

function calc_lightan(){
var an_height;
var an_platos;
var an_preki;
var anff_vathos;
var anff_platos;
an_height = document.getElementById('light_an_height').value;
an_platos = document.getElementById('light_an_platos').value;
an_preki = document.getElementById('light_an_preki').value;
anff_vathos = 2.5*(an_preki-an_height);
anff_platos = (0.5*anff_vathos)+parseFloat(an_platos);
document.getElementById('light_anff_vathos').value = anff_vathos.toFixed(2);
document.getElementById('light_anff_platos').value = anff_platos;
}
</script>			
			
			<!--Ανοίγματα οροφής-->
			<div class="tab-pane" id="tabs-2">

<table class="table table-bordered">
	<tr class="warning">
	<td colspan="2">Υπολογισμός περιοχής φυσικού φωτισμού οριζόντιου ανοίγματος (οροφής)</td>
	</tr>
	<tr class="warning">
	<td colspan="2"><img src="images/style/light_orofis.png" height="160px"></td>
	</tr>
	
	<tr>
	<th>Παράμετρος</th>
	<th>Τιμή</th>
	</tr>
	
	<tr>
	<td>Ύψος επιφάνειας εργασίας h<sub>ΕΕ</sub> (m)</td>
	<td><input class="form-control" type="text" id="light_or_height" onkeyup="calc_lightor();"></td>
	</tr>
	
	<tr>
	<td>Ύψος οροφής h<sub>k</sub> (m)</td>
	<td><input class="form-control" type="text" id="light_or_orofi" onkeyup="calc_lightor();"></td>
	</tr>
	
	<tr>
	<td>Πλάτος ανοίγματος W<sub>ΑΟ</sub> (m)</td>
	<td><input class="form-control" type="text" id="light_or_platos" onkeyup="calc_lightor();"></td>
	</tr>
	
	<tr>
	<td>Διάμετρος ζώνης φωτισμού D<sub>ΖΦΦ</sub>=W<sub>ΑΟ</sub> + 2 x (h<sub>K</sub> - h<sub>EE</sub>) x εφ(30<sup>o</sup>) (m)</td>
	<td><input class="form-control" type="text" id="light_orff_d" disabled="disabled"></td>
	</tr>
</table>

<blockquote>
	<small>
	Η περιοχή φυσικού φωτισμού από τα ανοίγματα οροφής υπολογίζεται ανάλογα το πλάτος του
	ανοίγματος W<sub>ΑΟ</sub>, το ύψος του χώρου h<sub>K</sub> και το ύψος της επιφάνειας 
	εργασίας h<sub>EE</sub>.
	</small>
</blockquote>
			
			</div>
			<!--Ανοίγματα οροφής-->
<script>
function calc_lightor(){
var or_height;
var or_orofi;
var or_platos;
var orff_d;
or_height = document.getElementById('light_or_height').value;
or_orofi = document.getElementById('light_or_orofi').value;
or_platos = document.getElementById('light_or_platos').value;
orff_d = parseFloat(or_platos) + 2*(parseFloat(or_orofi)-parseFloat(or_height))*Math.tan(30*(180/Math.PI));
document.getElementById('light_orff_d').value = orff_d.toFixed(2);
}
</script>			
			
			
			<!--Υπολογισμός απόδοσης-->
			<div class="tab-pane" id="tabs-3">
				<table class="table table-bordered">
					<tr class="warning">
					<td colspan="3">Υπολογισμός απόδοσης λαμπτήρων</td>
					</tr>
					
					<tr>
					<th>Παράμετρος</th>
					<th>Τιμή</th>
					<th>Πίνακας ΤΟΤΕΕ</th>
					</tr>
					
					<!--
					<tr>
					<td>Απόδοση λαμπτήρων (lm/m2)</td>
					<td>
						<select class="form-control" id="lamp_n" onchange=lamp_n(); >
							<option value="">Επιλέξτε...</option>
							<option value=10>Πυράκτωσης</option>
							<option value=15>Αλογόνου</option>
							<option value=50>Συμπαγής φθορισμού (συμπεριλαμβανομένου στραγγαλιστικού πηνίου - ballast)</option>
							<option value=60>Γραμμικός φθορισμού (συμπεριλαμβανομένου του στραγγαλιστικού πηνίου - ballast)</option>
							<option value=65>Αλογονιδίων μετάλλων (συμπεριλαμβανομένου του στραγγαλιστικού πηνίου - ballast)</option>
							<option value=30>Φωτοδίοδοι (led) (Συμπεριλαμβανομένου του οδηγού - driver)</option>
						</select>
					</td>
					<td><input class="form-control" type="text" id="lamp_n_val" onkeyup=""></td>
					</tr>
					-->
					
					<tr>
					<td>Πυκνότητα ισχύος λαμπτήρων (W/m2/100lux)</td>
					<td>
						<select class="form-control" id="lamp_p" onchange="lamp_p();lamp_zone();" >
							<option value="">Επιλέξτε...</option>
							<?php
							echo create_select_optionsval("vivliothiki_lights_density","type","d");
							?>
						</select>
					</td>
					<td><input class="form-control" type="text" id="lamp_p_val" onkeyup=""></td>
					</tr>
					
					<tr>
						<td>Χρήση κτιρίου</td>
						<td>
						<select class="form-control" id="lamp_xrisi" name="lamp_xrisi" onchange=lamp_zone();>
							<option value=0>Επιλέξτε χρήση...</option>
							<?php
							echo create_select_optionsid("vivliothiki_conditions_zone","name");
							?>
						</select>
						</td>
						<td></td>
					</tr>
				
					<tr>
					<td>Εμβαδόν ζώνης Ε (m<sub>2</sub>)</td>
					<td><input class="form-control" type="text" id="lamp_e" onkeyup=lamp_zone();></td>
					<td></td>
					</tr>
					
					<tr>
					<td>Απαίτηση W/m2 / Σύνολο W</td>
					<td><input class="form-control" type="text" id="lamp_w" onkeyup=""></td>
					<td><input class="form-control" type="text" id="lamp_w_tot" onkeyup=""></td>
					</tr>
					
					<tr>
					<td>Απαίτηση lux/m2</td>
					<td><input class="form-control" type="text" id="lamp_lux" onkeyup=""></td>
					<td></td>
					</tr>
					
					<tr>
					<td>Οι λαμπτήρες που επιλέχθηκαν για να καλύψουν <br/> την απαίτηση σε lux καταναλώνουν: (W) / %κατανάλωσης Κ.Α.</td>
					<td><input class="form-control" type="text" id="lamp_ap" onkeyup=""></td>
					<td><input class="form-control" type="text" id="lamp_apper" onkeyup=""></td>
					</tr>
					
				</table>
			</div>
			<!--Υπολογισμός απόδοσης-->
<script>

function lamp_p(){
var lamp_p;
lamp_p = document.getElementById('lamp_p').value;
document.getElementById('lamp_p_val').value = lamp_p;
}

function lamp_zone(){
	var xrisi = document.getElementById('lamp_xrisi').value;
	var e = document.getElementById("lamp_e").value;
	
	var lamp_p_val = document.getElementById("lamp_p_val").value;
	
	
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","includes/functions_calc.php?id_xrisi="+xrisi+"&hotel=0&hospital=0"  ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	var arr = JSON.parse(xmlhttp.responseText);
		
		document.getElementById("lamp_w").value=arr["light_kw"];
		document.getElementById("lamp_w_tot").value=arr["light_kw"]*e;
		document.getElementById("lamp_lux").value=arr["light_lux"];
		
		var lux_ka = arr["light_lux"];
		var apaitisi = (lux_ka/100)*lamp_p_val*e;
		document.getElementById("lamp_ap").value=apaitisi;
		var per = (apaitisi/(arr["light_kw"]*e))*100;
		document.getElementById("lamp_apper").value=per;
	}}
}
</script>			
			
			
			<!--Πίνακες ΤΟΤΕΕ-->
			<div class="tab-pane" id="tabs-4">
				<?php
				include("accordions_light.php");
				?>
			</div>

			
	</div><!--tab content-->
			</div><!--tabs-->
</div><!--col-md-12-->
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
	$("input").alphanum();	
</script>	