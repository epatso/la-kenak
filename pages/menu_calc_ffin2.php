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
	<small>Σκιάσεις 2 πλευρικών (F<sub>fin2</sub>)</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li><a href="#"><i class="fa fa-industry"></i> Σκιάσεις</a></li>
	<li class="active"> Ffin2</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
		
		<div class="col-md-2">
		<?php
		if(logged_in()){
		?>
		    <div class="btn-group">
			<button class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			<span class="fa fa-download"></span>  Ενέργειες χρήστη 
			<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
			<li><a tabindex="-1" href="#" onclick="calc_fin2(1);"><span class="fa fa-file-pdf-o"></span> Δημιουργία PDF</a></li>
			<li><a tabindex="-1" href="#"><span class="fa fa-question"></span> Βοήθεια</a></li>
			</ul>
			</div>
		<?php
		}
		?>	
			
		<br/><br/>
			<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Βοήθεια</h4>
			Στην περίπτωση που η επιφάνεια σκιάζεται και από τις δύο μεριές, λαμβάνονται και οι δύο συντελεστές ανεξάρτητα και γίνεται 
			χρήση του συνολικού συντελεστής σκίασης από πλευρικές προεξοχές, ο οποίος ισούται με το γινόμενο των δύο.<br/><br/>
			<img class="img-responsive" src="images/shading/pleyrika2.png"></img><br/>
			</div>

	</div>
		
	<div class="col-md-10">
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab">Πλευρικά x2 (Ffin2)</a></li>
		</ul>
			<div class="tab-content">
			<div class="tab-pane active" id="tabs-1">
			<script>
			$(function() {
				$('.tooltipui').popover();
			});
			</script>
			
				<font size="1">
					<table class="table table-bordered">
						<tr>
						<td>α/α</td>
						<td>Όνομα</td>
						<td>
							<a class="tooltipui" href="#" title="Πλάτος τοίχου ή ανοίγματος (m)">W</a><br/><br/>
							<input class="form-control input-sm" id="default_fin2_a" type="text" onkeyup="set_fin2_a();calc_fin2();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Απόσταση από εμπόδιο αριστερά (m)">dx<sub>αρ</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_fin2_b" type="text" onkeyup="set_fin2_b();calc_fin2();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Μήκος εμποδίου αριστερά (m)">W<sub>αρ</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_fin2_c" type="text" onkeyup="set_fin2_c();calc_fin2();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Απόσταση από εμπόδιο δεξιά (m)">dx<sub>δεξ</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_fin2_d" type="text" onkeyup="set_fin2_d();calc_fin2();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Μήκος εμποδίου δεξιά (m) ">W<sub>δεξ</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_fin2_e" type="text" onkeyup="set_fin2_e();calc_fin2();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Προσανατολισμός (μοίρες) ">γ</a><br/><br/>
							<input class="form-control input-sm" id="default_fin2_pros" type="text" onkeyup="set_fin2_pros();calc_fin2();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Γωνία σκίασης αριστερά">Deg<sub>αρ</sub></a><br/><br/>
						</td>
						<td>
							<a class="tooltipui" href="#" title="Γωνία σκίασης δεξιά">Deg<sub>δεξ</sub></a><br/><br/>
						</td>
						
						</tr>
						<?php for ($i=1;$i<=10;$i++){ ?>
						<tr style="border:1px #6699CC dotted;">
						<td><?=$i;?></td>
						<td><input class="form-control input-sm" type="text" id="fin2_name<?php echo $i; ?>" value="Τ-<?php echo $i; ?>" /></td>
						<td><input class="form-control input-sm" type="text" id="fin2_a<?php echo $i; ?>" onchange="calc_fin2();" /></td>
						<td><input class="form-control input-sm" type="text" id="fin2_b<?php echo $i; ?>" onchange="calc_fin2();" /></td>
						<td><input class="form-control input-sm" type="text" id="fin2_c<?php echo $i; ?>" onchange="calc_fin2();" /></td>
						<td><input class="form-control input-sm" type="text" id="fin2_d<?php echo $i; ?>" onchange="calc_fin2();" /></td>
						<td><input class="form-control input-sm" type="text" id="fin2_e<?php echo $i; ?>" onchange="calc_fin2();" /></td>
						<td><input class="form-control input-sm" type="text" id="fin2_pros<?php echo $i; ?>" onchange="calc_fin2();" /></td>
						<td><input class="form-control input-sm" type="text" id="fin2_deg_ar<?php echo $i; ?>" disabled="disabled" class="disabled"></td>
						<td><input class="form-control input-sm" type="text" id="fin2_deg_de<?php echo $i; ?>" disabled="disabled" class="disabled"></td>
						</tr>
						<?php } ?>
						
					</table>
				</font>
					<input class="form-control" type="hidden" name="min" value="<?php echo $min; ?>" /> 
					
					<div id='f_fin2_h_general' style='padding:15px; background:#ebf9c9;'></div>
					
					<br/><br/> Πίνακας σκίασης από αριστερές πλευρικές προεξοχές: Πίνακας 3.20α της ΤΟΤΕΕ 20701-1.
					<br/> Πίνακας σκίασης από δεξιές πλευρικές προεξοχές: Πίνακας 3.20β της ΤΟΤΕΕ 20701-1.
			
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

<!--######################## Fin x 2 scripts ########################### -->
//θέσε όλα τα μήκη των τοίχων -fin2
function set_fin2_a(){
var default_fin2_a=document.getElementById("default_fin2_a").value;
	for (i=1;i<=10;i++){
	document.getElementById("fin2_a"+i).value=default_fin2_a;
	}
}
//θέσε όλες τις αποστάσεις από αριστερά -fin2
function set_fin2_b(){
var default_fin2_b=document.getElementById("default_fin2_b").value;
	for (i=1;i<=10;i++){
	document.getElementById("fin2_b"+i).value=default_fin2_b;
	}
}
//θέσε όλα τα εμπόδια από αριστερά -fin2
function set_fin2_c(){
var default_fin2_c=document.getElementById("default_fin2_c").value;
	for (i=1;i<=10;i++){
	document.getElementById("fin2_c"+i).value=default_fin2_c;
	}
}
//θέσε όλες τις αποστάσεις από δεξία -fin2
function set_fin2_d(){
var default_fin2_d=document.getElementById("default_fin2_d").value;
	for (i=1;i<=10;i++){
	document.getElementById("fin2_d"+i).value=default_fin2_d;
	}
}
//θέσε όλα τα εμπόδια από δεξιά -fin2
function set_fin2_e(){
var default_fin2_e=document.getElementById("default_fin2_e").value;
	for (i=1;i<=10;i++){
	document.getElementById("fin2_e"+i).value=default_fin2_e;
	}
}
//θέσε όλους τους προσανατολισμούς -fin2
function set_fin2_pros(){
var default_fin2_pros=document.getElementById("default_fin2_pros").value;
	for (i=1;i<=10;i++){
	document.getElementById("fin2_pros"+i).value=default_fin2_pros;
	}
}


function calc_fin2(print=0){

var x="includes/calc_skiaseis_f.php?skiasi=3&print="+print;

for (k=1;k<=10;k++){
var fin2_name=document.getElementById("fin2_name"+k).value;
var fin2_a=parseFloat(document.getElementById("fin2_a"+k).value);
var fin2_b=parseFloat(document.getElementById("fin2_b"+k).value);
var fin2_c=parseFloat(document.getElementById("fin2_c"+k).value);
var fin2_d=parseFloat(document.getElementById("fin2_d"+k).value);
var fin2_e=parseFloat(document.getElementById("fin2_e"+k).value);
var fin2_pros=parseFloat(document.getElementById("fin2_pros"+k).value);

var tan_toixoy_ar =  (fin2_c / (fin2_b + (fin2_a/2)));
var deg_toixoy_ar = Math.atan(tan_toixoy_ar) *  180 / Math.PI;

var tan_toixoy_de = (fin2_e / (fin2_d + (fin2_a/2)));
var deg_toixoy_de = Math.atan(tan_toixoy_de) *  180 / Math.PI;


document.getElementById("fin2_deg_ar"+k).value=number_format(deg_toixoy_ar,2);
document.getElementById("fin2_deg_de"+k).value=number_format(deg_toixoy_de,2);

x += "&name"+k+"=" + fin2_name + "&deg_toixoy_ar"+k+"=" + deg_toixoy_ar + "&deg_toixoy_de"+k+"=" + deg_toixoy_de + "&pros"+k+"=" + fin2_pros;
x += "&fin2_a"+k+"=" + fin2_a + "&fin2_b"+k+"=" + fin2_b + "&fin2_c"+k+"=" + fin2_c + "&fin2_d"+k+"=" + fin2_d + "&fin2_e"+k+"=" + fin2_e;
}//τέλος επαναληψης

	if(print==0){
	//json result
	jQuery.ajax({
			url: x,
			type: "POST",
			async: true, //αλλαγή σε false δουλεύει πάντοτε αλλά επιβραδύνει τον browser
			success: function (data) {
				var html = data;
				document.getElementById("f_fin2_h_general").innerHTML=html;
			}
		});
	}
	
	if(print==1){
	window.open(x,"La-Kenak");
	}
}

<!--######################## Fin x 2 scripts ########################### -->


			</script>
	</div><!--tab content-->
	</div><!--tabs-->

</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->