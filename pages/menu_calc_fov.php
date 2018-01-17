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
	<small>Σκιάσεις προβόλου (F<sub>ov</sub>)</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li><a href="#"><i class="fa fa-industry"></i> Σκιάσεις</a></li>
	<li class="active"> Fov</li>
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
			<li><a tabindex="-1" href="#" onclick="calc_ov(1);"><i class="fa fa-file-pdf-o"></i>Δημιουργία PDF</a></li>
			<li><a tabindex="-1" href="#"><i class="fa fa-question"></i>Βοήθεια</a></li>
			</ul>
			</div>
		<?php
		}
		?>	
			
		<br/><br/>
			<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Βοήθεια</h4>
			Ο συντελεστής σκίασης οριζόντιων προστεγασμάτων (Fov) προσδιορίζει τη σκίαση των επιφανειών του κτηρίου λόγω 
			ύπαρξης οριζόντιων προεξοχών (εξωστών, προστεγασμάτων, υπέρθυρων ανοιγμάτων). Στην περίπτωση που δεν 
			υπάρχει οριζόντια προεξοχή ο συντελεστής ισούται με την μονάδα (Fov = 1), ενώ όταν η σκίαση είναι πλήρης ο 
			συντελεστής γίνεται ίσος με μηδέν (Fov = 0).<br/><br/>
			<img class="img-responsive" src="images/shading/provolos.png"></img><br/>
			</div>

	</div>
		
	<div class="col-md-10">
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab">Προβόλου (Fov)</a></li>
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
							<a class="tooltipui" href="#" title="Ύψος τοίχου (m)">H</a><br/><br/>
							<input class="form-control input-sm" id="default_ov_a" type="text" onkeyup="set_ov_a();calc_ov();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Ύψος πόρτας (m)">H<sub>w</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_ov_b" type="text" onkeyup="set_ov_b();calc_ov();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Ύψος παραθύρου (m)">H<sub>w1</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_ov_c" type="text" onkeyup="set_ov_c();calc_ov();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Ύψος ποδιάς (m)">d<sub>1</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_ov_d" type="text" onkeyup="set_ov_d();calc_ov();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Απόσταση υαλοστασίων από εξωτερική παρειά (m)">g</a><br/><br/>
							<input class="form-control input-sm" id="default_ov_g" type="text" onkeyup="set_ov_g();calc_ov();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Μήκος προβόλου (m)">L</a><br/><br/>
							<input class="form-control input-sm" id="default_ov_e" type="text" onkeyup="set_ov_e();calc_ov();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Προσανατολισμός">γ</a><br/><br/>
							<input class="form-control input-sm" id="default_ov_pros" type="text" onkeyup="set_ov_pros();calc_ov();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Γωνία σκίασης τοίχου">Deg<sub>Τ</sub></a><br/><br/>
						</td>
						<td>
							<a class="tooltipui" href="#" title="Γωνία σκίασης πόρτας">Deg<sub>πόρ.</sub></a><br/><br/>
						</td>
						<td>
							<a class="tooltipui" href="#" title="Γωνία σκίασης ανοίγματος">Deg<sub>αν.</sub></a><br/><br/>
						</td>
						</tr>
						<?php for ($i=1;$i<=10;$i++){ ?>
						<tr style="border:1px #6699CC dotted;">
						<td><?=$i;?></td>
						<td><input class="form-control input-sm" type="text" id="ov_name<?php echo $i; ?>" value="Τ-<?php echo $i; ?>" onchange="calc_ov();" /></td>
						<td><input class="form-control input-sm" type="text" id="ov_a<?php echo $i; ?>" onchange="calc_ov();" /></td>
						<td><input class="form-control input-sm" type="text" id="ov_b<?php echo $i; ?>" onchange="calc_ov();" /></td>
						<td><input class="form-control input-sm" type="text" id="ov_c<?php echo $i; ?>" onchange="calc_ov();" /></td>
						<td><input class="form-control input-sm" type="text" id="ov_d<?php echo $i; ?>" onchange="calc_ov();" /></td>
						<td><input class="form-control input-sm" type="text" id="ov_g<?php echo $i; ?>" onchange="calc_ov();" /></td>
						<td><input class="form-control input-sm" type="text" id="ov_e<?php echo $i; ?>" onchange="calc_ov();" /></td>
						<td><input class="form-control input-sm" type="text" id="ov_pros<?php echo $i; ?>" onchange="calc_ov();" /></td>
						<td><input class="form-control input-sm" type="text" id="ov_deg_t<?php echo $i; ?>" disabled="disabled" class="disabled"></td>
						<td><input class="form-control input-sm" type="text" id="ov_deg_door<?php echo $i; ?>" disabled="disabled" class="disabled"></td>
						<td><input class="form-control input-sm" type="text" id="ov_deg_an<?php echo $i; ?>" disabled="disabled" class="disabled"></td>
						</tr>
						<?php } ?>
						
					</table>
				</font>	
					<input class="form-control" type="hidden" name="min" value="<?php echo $min; ?>" /> 
					<div id='f_ov_h_general' style='padding:15px; background:#ebf9c9;'></div>
					
					<br/>
					Στην περίπτωση ύπαρξης πολλών φυσικών ή τεχνητών εμποδίων με διαφορετικό ύψος, τότε ως
					ανώτερη παρειά εμποδίου λαμβάνεται το μέσο ύψος όλων των εμποδίων, σταθμισμένο με το 
					αντίστοιχο μήκος καθενός εμποδίου. (Παρ. 3.3.3 ΤΟΤΕΕ-20701-1.2nd edition)
					<br/><br/> Πίνακας σκίασης για πρόβολο: Πίνακας 3.19 της ΤΟΤΕΕ 20701-1.
			
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

<!--######################## Ov scripts ########################### -->
//θέσε όλα τα ύψη των τοίχων -ov
function set_ov_a(){
var default_ov_a=document.getElementById("default_ov_a").value;
	for (i=1;i<=10;i++){
	document.getElementById("ov_a"+i).value=default_ov_a;
	}
}
//θέσε όλα Ύψος πόρτας -ov
function set_ov_b(){
var default_ov_b=document.getElementById("default_ov_b").value;
	for (i=1;i<=10;i++){
	document.getElementById("ov_b"+i).value=default_ov_b;
	}
}
//θέσε όλα Ύψος παραθύρου -ov
function set_ov_c(){
var default_ov_c=document.getElementById("default_ov_c").value;
	for (i=1;i<=10;i++){
	document.getElementById("ov_c"+i).value=default_ov_c;
	}
}
//θέσε όλα Ύψος ποδιάς -ov
function set_ov_d(){
var default_ov_d=document.getElementById("default_ov_d").value;
	for (i=1;i<=10;i++){
	document.getElementById("ov_d"+i).value=default_ov_d;
	}
}
//θέσε όλες τις αποστάσεις υαλοστασίων -ov
function set_ov_g(){
var default_ov_g=document.getElementById("default_ov_g").value;
	for (i=1;i<=10;i++){
	document.getElementById("ov_g"+i).value=default_ov_g;
	}
}
//θέσε όλα Μήκος προβόλου -ov
function set_ov_e(){
var default_ov_e=document.getElementById("default_ov_e").value;
	for (i=1;i<=10;i++){
	document.getElementById("ov_e"+i).value=default_ov_e;
	}
}
//θέσε όλους τους προσανατολισμούς -ov
function set_ov_pros(){
var default_ov_pros=document.getElementById("default_ov_pros").value;
	for (i=1;i<=10;i++){
	document.getElementById("ov_pros"+i).value=default_ov_pros;
	}
}

function calc_ov(print=0){

var x="includes/calc_skiaseis_f.php?skiasi=2&print="+print;

for (k=1;k<=10;k++){
var ov_name=document.getElementById("ov_name"+k).value;
var ov_a=parseFloat(document.getElementById("ov_a"+k).value);
var ov_b=parseFloat(document.getElementById("ov_b"+k).value);
var ov_c=parseFloat(document.getElementById("ov_c"+k).value);
var ov_d=parseFloat(document.getElementById("ov_d"+k).value);
var ov_g=parseFloat(document.getElementById("ov_g"+k).value);
var ov_e=parseFloat(document.getElementById("ov_e"+k).value);
var ov_pros=parseFloat(document.getElementById("ov_pros"+k).value);

var tan_toixoy =  (ov_e / (ov_a/2));
var deg_toixoy = Math.atan(tan_toixoy) *  180 / Math.PI;

var tan_door = ((ov_e+ov_g) / (ov_a -(ov_b/2)));
var deg_door = Math.atan(tan_door) *  180 / Math.PI;

var tan_an = ((ov_e+ov_g) / (ov_a - ov_d - (ov_c/2)));
var deg_an = Math.atan(tan_an) *  180 / Math.PI;

document.getElementById("ov_deg_t"+k).value=number_format(deg_toixoy,2);
document.getElementById("ov_deg_door"+k).value=number_format(deg_door,2);
document.getElementById("ov_deg_an"+k).value=number_format(deg_an,2);

x += "&name"+k+"=" + ov_name + "&deg_toixoy"+k+"=" + deg_toixoy + "&deg_door"+k+"=" + deg_door + "&deg_an"+k+"=" + deg_an + "&pros"+k+"=" + ov_pros;
x += "&ov_a"+k+"=" + ov_a + "&ov_b"+k+"=" + ov_b + "&ov_c"+k+"=" + ov_c + "&ov_d"+k+"=" + ov_d + "&ov_g"+k+"=" + ov_g + "&ov_e"+k+"=" + ov_e;
}//τέλος επαναληψης

	if(print==0){
	//json result
	jQuery.ajax({
			url: x,
			type: "POST",
			async: true, //αλλαγή σε false δουλεύει πάντοτε αλλά επιβραδύνει τον browser
			success: function (data) {
				var html = data;
				document.getElementById("f_ov_h_general").innerHTML=html;
			}
		});
	}
	
	if(print==1){
	window.open(x,"La-Kenak");
	}
}


<!--######################## Ov scripts ########################### -->


			</script>
	</div><!--tab content-->
	</div><!--tabs-->

</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->