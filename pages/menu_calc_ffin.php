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
	<small>Σκιάσεις πλευρικών (F<sub>fin</sub>)</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li><a href="#"><i class="fa fa-industry"></i> Σκιάσεις</a></li>
	<li class="active"> Ffin</li>
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
			<li><a tabindex="-1" href="#" onclick="calc_fin(1);"><span class="fa fa-file-pdf-o"></span> Δημιουργία PDF</a></li>
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
			Ο συντελεστής σκίασης από πλευρικές προεξοχές (Ffin) προσδιορίζει τη σκίαση των επιφανειών του κτηρίου λόγω ύπαρξης κατακόρυφων 
			προεξοχών (πλευρικών προεξοχών, τμημάτων του ιδίου του κτηρίου, διπλανών κτηρίων). Στην περίπτωση που δεν υπάρχει πλευρική 
			προεξοχή (γ = 0°) ο συντελεστής ισούται με μονάδα (Ffin = 1), ενώ όταν η σκίαση είναι πλήρης (γ = 90°) ο συντελεστής γίνεται ίσος με 
			μηδέν (Ffin = 0).<br/><br/>
			<img class="img-responsive" src="images/shading/pleyrika.png"></img><br/>
			</div>

	</div>
		
	<div class="col-md-10">
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab">Πλευρικά (Ffin)</a></li>
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
							<a class="tooltipui" href="#" title="Πλάτος τοίχου (m)">W</a><br/><br/>
							<input class="form-control input-sm" id="default_fin_a" type="text" onkeyup="set_fin_a();calc_fin();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Απόσταση τοίχου από εμπόδιο (m)">dx</a><br/><br/>
							<input class="form-control input-sm" id="default_fin_b" type="text" onkeyup="set_fin_b();calc_fin();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Πλάτος ανοίγματος (m)">W<sub>w</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_fin_c" type="text" onkeyup="set_fin_c();calc_fin();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Απόσταση ανοίγματος από εμπόδιο (m)">dx<sub>w</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_fin_d" type="text" onkeyup="set_fin_d();calc_fin();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Απόσταση υαλοστασίων από εξωτερική παρειά (m)">g</a><br/><br/>
							<input class="form-control input-sm" id="default_fin_g" type="text" onkeyup="set_fin_g();calc_fin();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Μήκος εμποδίου (m)">W<sub>1,2</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_fin_e" type="text" onkeyup="set_fin_e();calc_fin();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Θέση εμποδίου (1=αριστερά, 2=δεξιά)">1,2</a><br/><br/>
							<input class="form-control input-sm" id="default_fin_f" type="text" onkeyup="set_fin_f();calc_fin();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Προσανατολισμός">γ</a><br/><br/>
							<input class="form-control input-sm" id="default_fin_pros" type="text" onkeyup="set_fin_pros();calc_fin();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Γωνία σκίασης τοίχου">Deg<sub>Τ</sub></a><br/><br/>
						</td>
						<td>
							<a class="tooltipui" href="#" title="Γωνία σκίασης ανοίγματος">Deg<sub>αν.</sub></a><br/><br/>
						</td>
						</tr>
						<?php for ($i=1;$i<=10;$i++){ ?>
						<tr style="border:1px #6699CC dotted;">
						<td><?php echo $i;?></td>
						<td><input class="form-control input-sm" type="text" id="fin_name<?php echo $i; ?>" value="Τ-<?php echo $i; ?>" onchange="calc_fin();"/></td>
						<td><input class="form-control input-sm" type="text" id="fin_a<?php echo $i; ?>" onchange="calc_fin();"/></td>
						<td><input class="form-control input-sm" type="text" id="fin_b<?php echo $i; ?>" onchange="calc_fin();"/></td>
						<td><input class="form-control input-sm" type="text" id="fin_c<?php echo $i; ?>" onchange="calc_fin();"/></td>
						<td><input class="form-control input-sm" type="text" id="fin_d<?php echo $i; ?>" onchange="calc_fin();"/></td>
						<td><input class="form-control input-sm" type="text" id="fin_g<?php echo $i; ?>" onchange="calc_fin();"/></td>
						<td><input class="form-control input-sm" type="text" id="fin_e<?php echo $i; ?>" onchange="calc_fin();"/></td>
						<td><input class="form-control input-sm" type="text" id="fin_f<?php echo $i; ?>" onchange="calc_fin();"/></td>
						<td><input class="form-control input-sm" type="text" id="fin_pros<?php echo $i; ?>" onchange="calc_fin();"/></td>
						<td><input class="form-control input-sm" type="text" id="fin_deg_t<?php echo $i; ?>" disabled="disabled" class="disabled"></td>
						<td><input class="form-control input-sm" type="text" id="fin_deg_an<?php echo $i; ?>" disabled="disabled" class="disabled"></td>
						</tr>
						<?php } ?>
						
					</table>
				</font>	
					<input class="form-control" type="hidden" name="min" /> 
					<div id='f_fin_h_general' style='padding:15px; background:#ebf9c9;'></div>
					
					<br/><br/> Πίνακας σκίασης από αριστερές πλευρικές προεξοχές: Πίνακας 3.20a της ΤΟΤΕΕ 20701-1.
					<br/> Πίνακας σκίασης από δεξιές πλευρικές προεξοχές: Πίνακας 3.20b της ΤΟΤΕΕ 20701-1.
					
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


<!--######################## Fin scripts ########################### -->


//θέσε όλα τα πλάτη των τοίχων -fin
function set_fin_a(){
var default_fin_a=document.getElementById("default_fin_a").value;
	for (i=1;i<=10;i++){
	document.getElementById("fin_a"+i).value=default_fin_a;
	}
}
//θέσε όλες τις αποστάσεις τοίχου από εμπόδιο -fin
function set_fin_b(){
var default_fin_b=document.getElementById("default_fin_b").value;
	for (i=1;i<=10;i++){
	document.getElementById("fin_b"+i).value=default_fin_b;
	}
}
//θέσε όλα τα πλάτη ανοίγματος -fin
function set_fin_c(){
var default_fin_c=document.getElementById("default_fin_c").value;
	for (i=1;i<=10;i++){
	document.getElementById("fin_c"+i).value=default_fin_c;
	}
}
//θέσε όλες τις αποστάσεις από άνοιογμα -fin
function set_fin_d(){
var default_fin_d=document.getElementById("default_fin_d").value;
	for (i=1;i<=10;i++){
	document.getElementById("fin_d"+i).value=default_fin_d;
	}
}
//θέσε όλες τις αποστάσεις υαλοστασίων -fin
function set_fin_g(){
var default_fin_g=document.getElementById("default_fin_g").value;
	for (i=1;i<=10;i++){
	document.getElementById("fin_g"+i).value=default_fin_g;
	}
}
//θέσε όλα τα μήκη εμποδίων -fin
function set_fin_e(){
var default_fin_e=document.getElementById("default_fin_e").value;
	for (i=1;i<=10;i++){
	document.getElementById("fin_e"+i).value=default_fin_e;
	}
}
//θέσε όλες τις θέσεις εμποδίων -fin
function set_fin_f(){
var default_fin_f=document.getElementById("default_fin_f").value;
	for (i=1;i<=10;i++){
	document.getElementById("fin_f"+i).value=default_fin_f;
	}
}
//θέσε όλους τους προσανατολισμούς -fin
function set_fin_pros(){
var default_fin_pros=document.getElementById("default_fin_pros").value;
	for (i=1;i<=10;i++){
	document.getElementById("fin_pros"+i).value=default_fin_pros;
	}
}

function calc_fin(print=0){

var x="includes/calc_skiaseis_f.php?skiasi=4&print="+print;

for (k=1;k<=10;k++){
var fin_name=document.getElementById("fin_name"+k).value;
var fin_a=parseFloat(document.getElementById("fin_a"+k).value);
var fin_b=parseFloat(document.getElementById("fin_b"+k).value);
var fin_c=parseFloat(document.getElementById("fin_c"+k).value);
var fin_d=parseFloat(document.getElementById("fin_d"+k).value);
var fin_g=parseFloat(document.getElementById("fin_g"+k).value);
var fin_e=parseFloat(document.getElementById("fin_e"+k).value);
var fin_f=parseFloat(document.getElementById("fin_f"+k).value);
var fin_pros=parseFloat(document.getElementById("fin_pros"+k).value);

var tan_toixoy =  (fin_e / ((fin_a / 2) + fin_b));
var deg_toixoy = Math.atan(tan_toixoy) *  180 / Math.PI;

var tan_an = ((fin_e+fin_g) / ((fin_c / 2) + fin_d));
var deg_an = Math.atan(tan_an) *  180 / Math.PI;

document.getElementById("fin_deg_t"+k).value=number_format(deg_toixoy,2);
document.getElementById("fin_deg_an"+k).value=number_format(deg_an,2);

x += "&name"+k+"=" + fin_name + "&deg_toixoy"+k+"=" + deg_toixoy + "&deg_an"+k+"=" + deg_an + "&pros"+k+"=" + fin_pros;
x += "&fin_a"+k+"=" + fin_a + "&fin_b"+k+"=" + fin_b + "&fin_c"+k+"=" + fin_c + "&fin_d"+k+"=" + fin_d + "&fin_g"+k+"=" + fin_g + "&fin_e"+k+"=" + fin_e + "&fin_f"+k+"=" + fin_f;
}//τέλος επαναληψης

	if(print==0){
	//json result
	jQuery.ajax({
			url: x,
			type: "POST",
			async: true, //αλλαγή σε false δουλεύει πάντοτε αλλά επιβραδύνει τον browser
			success: function (data) {
				var html = data;
				document.getElementById("f_fin_h_general").innerHTML=html;
			}
		});
	}
	
	if(print==1){
	window.open(x,"La-Kenak");
	}
}


<!--######################## fin scripts ########################### -->
			</script>
	</div><!--tab content-->
	</div><!--tabs-->

</div>
 <!-- /.row (main row) -->
<script>
	$("input").alphanum();	
</script>	
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->