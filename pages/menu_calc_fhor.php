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
	<small>Σκιάσεις Ορίζοντα (F<sub>hor</sub>)</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li><a href="#"><i class="fa fa-industry"></i> Σκιάσεις</a></li>
	<li class="active"> Fhor</li>
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
			<li><a tabindex="-1" href="#" onclick="calc_hor(1);"><span class="fa fa-file-pdf-o"></span> Δημιουργία PDF</a></li>
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
			Ο συντελεστής προσδιορίζει τη σκίαση που προκύπτει στις επιφάνειες του κτηρίου από την ύπαρξη φυσικών εμποδίων 
			(π.χ. λόφων) ή τεχνητών (π.χ. υψηλών κτηρίων). Όταν ο ορίζοντας είναι ελεύθερος ο συντελεστής ισούται με τη μονάδα 
			(Fhor =1), ενώ για πλήρη σκίαση παίρνει την τιμή μηδέν (Fhor=0).<br/><br/>
			<img class="img-responsive" src="images/shading/orizontas.png"></img><br/>
			</div>

	</div>
		
	<div class="col-md-10">
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab">Ορίζοντα (Fhor)</a></li>
		</ul>
		<div class="tab-content">	
			<div class="tab-pane active" id="tabs-1">
			
			<style>
			label {
			display: inline-block;
			width: 5em;
			}
			</style>
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
							<input class="form-control input-sm" id="default_hor_a" type="text" onkeyup="set_hor_a();calc_hor();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Ύψος πόρτας (m)">H<sub>w</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_hor_b" type="text" onkeyup="set_hor_b();calc_hor();">
							</td>
						<td>
							<a class="tooltipui" href="#" title="Ύψος παραθύρου (m)">H<sub>w1</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_hor_c" type="text" onkeyup="set_hor_c();calc_hor();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Ύψος ποδιάς (m)">d<sub>1</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_hor_d" type="text" onkeyup="set_hor_d();calc_hor();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Απόσταση υαλοστασίων από εξωτερική παρειά (m)">g</a><br/><br/>
							<input class="form-control input-sm" id="default_hor_g" type="text" onkeyup="set_hor_g();calc_hor();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Απόσταση εμποδίου (m)">e</a><br/><br/>
							<input class="form-control input-sm" id="default_hor_e" type="text" onkeyup="set_hor_e();calc_hor();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Ύψος εμποδίου (m)">f</a><br/><br/>
							<input class="form-control input-sm" id="default_hor_f" type="text" onkeyup="set_hor_f();calc_hor();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Προσανατολισμός">γ</a><br/><br/>
							<input class="form-control input-sm" id="default_hor_pros" type="text" onkeyup="set_hor_pros();calc_hor();">
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
						<td><input class="form-control input-sm" type="text" id="hor_name<?php echo $i; ?>" value="Τ-<?php echo $i; ?>" onchange="calc_hor();"/></td>
						<td><input class="form-control input-sm" type="text" id="hor_a<?php echo $i; ?>" onchange="calc_hor();"/></td>
						<td><input class="form-control input-sm" type="text" id="hor_b<?php echo $i; ?>" onchange="calc_hor();"/></td>
						<td><input class="form-control input-sm" type="text" id="hor_c<?php echo $i; ?>" onchange="calc_hor();"/></td>
						<td><input class="form-control input-sm" type="text" id="hor_d<?php echo $i; ?>" onchange="calc_hor();"/></td>
						<td><input class="form-control input-sm" type="text" id="hor_g<?php echo $i; ?>" onchange="calc_hor();"/></td>
						<td><input class="form-control input-sm" type="text" id="hor_e<?php echo $i; ?>" onchange="calc_hor();"/></td>
						<td><input class="form-control input-sm" type="text" id="hor_f<?php echo $i; ?>" onchange="calc_hor();"/></td>
						<td><input class="form-control input-sm" type="text" id="hor_pros<?php echo $i; ?>" onchange="calc_hor();"/></td>
						<td><input class="form-control input-sm" type="text" id="hor_deg_t<?php echo $i; ?>" disabled="disabled" class="disabled"></td>
						<td><input class="form-control input-sm" type="text" id="hor_deg_door<?php echo $i; ?>" disabled="disabled" class="disabled"></td>
						<td><input class="form-control input-sm" type="text" id="hor_deg_an<?php echo $i; ?>" disabled="disabled" class="disabled"></td>
						</tr>
						<?php } ?>
							
						
					</table>
				</font>	
					<input class="form-control" type="hidden" name="min" value="<?php echo $min; ?>" /> 
					<div id='f_hor_h_general' style='padding:15px; background:#ebf9c9;'></div>
					
					<br/>
					Στην περίπτωση ύπαρξης πολλών φυσικών ή τεχνητών εμποδίων με διαφορετικό ύψος, τότε ως
					ανώτερη παρειά εμποδίου λαμβάνεται το μέσο ύψος όλων των εμποδίων, σταθμισμένο με το
					αντίστοιχο μήκος καθενός εμποδίου. (Παρ. 3.3.2 ΤΟΤΕΕ-20701-1.2nd edition)
					<br/><br/> Πίνακας σκίασης ορίζοντα: Πίνακας 3.18 της ΤΟΤΕΕ 20701-1.
			
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

<!--######################## Hor scripts ########################### -->
//θέσε όλα τα ύψη των τοίχων -hor
function set_hor_a(){
var default_hor_a=document.getElementById("default_hor_a").value;
	for (i=1;i<=10;i++){
	document.getElementById("hor_a"+i).value=default_hor_a;
	}
}
//θέσε όλα Ύψος πόρτας -hor
function set_hor_b(){
var default_hor_b=document.getElementById("default_hor_b").value;
	for (i=1;i<=10;i++){
	document.getElementById("hor_b"+i).value=default_hor_b;
	}
}
//θέσε όλα Ύψος παραθύρου -hor
function set_hor_c(){
var default_hor_c=document.getElementById("default_hor_c").value;
	for (i=1;i<=10;i++){
	document.getElementById("hor_c"+i).value=default_hor_c;
	}
}
//θέσε όλα Ύψος ποδιάς -hor
function set_hor_d(){
var default_hor_d=document.getElementById("default_hor_d").value;
	for (i=1;i<=10;i++){
	document.getElementById("hor_d"+i).value=default_hor_d;
	}
}
//θέσε όλες τις αποστάσεις υαλοστασίων -hor
function set_hor_g(){
var default_hor_g=document.getElementById("default_hor_g").value;
	for (i=1;i<=10;i++){
	document.getElementById("hor_g"+i).value=default_hor_g;
	}
}
//θέσε όλα Απόσταση εμποδίου -hor
function set_hor_e(){
var default_hor_e=document.getElementById("default_hor_e").value;
	for (i=1;i<=10;i++){
	document.getElementById("hor_e"+i).value=default_hor_e;
	}
}
//θέσε όλα Ύψος εμποδίου -hor
function set_hor_f(){
var default_hor_f=document.getElementById("default_hor_f").value;
	for (i=1;i<=10;i++){
	document.getElementById("hor_f"+i).value=default_hor_f;
	}
}
//θέσε όλους τους προσανατολισμούς -hor
function set_hor_pros(){
var default_hor_pros=document.getElementById("default_hor_pros").value;
	for (i=1;i<=10;i++){
	document.getElementById("hor_pros"+i).value=default_hor_pros;
	}
}
function calc_hor(print=0){

var x="includes/calc_skiaseis_f.php?skiasi=1&print="+print;

for (k=1;k<=10;k++){
var hor_name=document.getElementById("hor_name"+k).value;
var hor_a=parseFloat(document.getElementById("hor_a"+k).value);
var hor_b=parseFloat(document.getElementById("hor_b"+k).value);
var hor_c=parseFloat(document.getElementById("hor_c"+k).value);
var hor_d=parseFloat(document.getElementById("hor_d"+k).value);
var hor_g=parseFloat(document.getElementById("hor_g"+k).value);
var hor_e=parseFloat(document.getElementById("hor_e"+k).value);
var hor_f=parseFloat(document.getElementById("hor_f"+k).value);
var hor_pros=parseFloat(document.getElementById("hor_pros"+k).value);

var tan_toixoy = ((hor_f-(hor_a/2)) / hor_e);
var deg_toixoy = Math.atan(tan_toixoy) *  180 / Math.PI;

var tan_door = (hor_f-(hor_b/2)) / (hor_e + hor_g);
var deg_door = Math.atan(tan_door) *  180 / Math.PI;

var tan_an = (hor_f-(hor_c/2)-hor_d) / (hor_e + hor_g);
var deg_an = Math.atan(tan_an) *  180 / Math.PI;

document.getElementById("hor_deg_t"+k).value=number_format(deg_toixoy,2);
document.getElementById("hor_deg_door"+k).value=number_format(deg_door,2);
document.getElementById("hor_deg_an"+k).value=number_format(deg_an,2);

x += "&name"+k+"=" + hor_name + "&deg_toixoy"+k+"=" + deg_toixoy + "&deg_door"+k+"=" + deg_door + "&deg_an"+k+"=" + deg_an + "&pros"+k+"=" + hor_pros;
x += "&hor_a"+k+"=" + hor_a + "&hor_b"+k+"=" + hor_b + "&hor_c"+k+"=" + hor_c + "&hor_d"+k+"=" + hor_d + "&hor_g"+k+"=" + hor_g + "&hor_e"+k+"=" + hor_e + "&hor_f"+k+"=" + hor_f;
}//τέλος επαναληψης

	if(print==0){
	//json result
	jQuery.ajax({
			url: x,
			type: "POST",
			async: true, //αλλαγή σε false δουλεύει πάντοτε αλλά επιβραδύνει τον browser
			success: function (data) {
				var html = data;
				document.getElementById("f_hor_h_general").innerHTML=html;
			}
		});
	}
	
	if(print==1){
	window.open(x,"La-Kenak");
	}
}

<!--######################## Hor scripts ########################### -->


			</script>
	</div><!--tab content-->
	</div><!--tabs-->

</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

