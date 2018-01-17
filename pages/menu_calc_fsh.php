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
	<small>Σκιάσεις περσίδων (F<sub>sh</sub>)</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li><a href="#"><i class="fa fa-industry"></i> Σκιάσεις</a></li>
	<li class="active"> Fsh</li>
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
			<li><a tabindex="-1" href="#" onclick="calc_fsh(1);"><span class="fa fa-file-pdf-o"></span> Δημιουργία PDF</a></li>
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
			Στην περίπτωση ύπαρξης μόνιμων ή κινητών εξωτερικών περσίδων θα πρέπει να ληφθεί υπόψη η προστασία που προσφέρουν 
			κατά τη θερινή περίοδο αλλά και κατά τη χειμερινή περίοδο με χρήση του συντελεστή σκίασης Fbl.<br/><br/>
			<img class="img-responsive" src="images/shading/persides.png"></img><br/>
			</div>

	</div>
		
	<div class="col-md-10">
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab">Περσίδων (Fsh)</a></li>
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
							<a class="tooltipui" href="#" title="Τύπος περσίδων (m) (1:Σταθερές 2:Κινητές)">Τύπος</a><br/><br/>
							<input class="form-control input-sm" id="default_fsh_a" type="text" onkeyup="set_fsh_a();calc_fsh();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Μήκος περσίδων (m)">L</a><br/><br/>
							<input class="form-control input-sm" id="default_fsh_b" type="text" onkeyup="set_fsh_b();calc_fsh();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Απόσταση περσίδων (m)">Η</a><br/><br/>
							<input class="form-control input-sm" id="default_fsh_c" type="text" onkeyup="set_fsh_c();calc_fsh();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Προσανατολισμός (μοίρες)">γ</a><br/><br/>
							<input class="form-control input-sm" id="default_fsh_pros" type="text" onkeyup="set_fsh_pros();calc_fsh();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Γωνία σκίασης τοίχου">Deg<sub>Τ</sub></a><br/><br/>
						</td>
						
						</tr>
						<?php for ($i=1;$i<=10;$i++){ ?>
						<tr style="border:1px #6699CC dotted;">
						<td><?=$i;?></td>
						<td><input class="form-control input-sm" type="text" id="fsh_name<?php echo $i; ?>" value="Τ-<?php echo $i; ?>" /></td>
						<td><input class="form-control input-sm" type="text" id="fsh_a<?php echo $i; ?>" onchange="calc_fin2();" /></td>
						<td><input class="form-control input-sm" type="text" id="fsh_b<?php echo $i; ?>" onchange="calc_fsh();" /></td>
						<td><input class="form-control input-sm" type="text" id="fsh_c<?php echo $i; ?>" onchange="calc_fsh();" /></td>
						<td><input class="form-control input-sm" type="text" id="fsh_pros<?php echo $i; ?>" onchange="calc_fsh();" /></td>
						<td><input class="form-control input-sm" type="text" id="fsh_deg_t<?php echo $i; ?>" disabled="disabled" class="disabled"></td
						
						</tr>
						<?php } ?>
						
					</table>
				</font>
					<input class="form-control" type="hidden" name="min" value="<?php echo $min; ?>" /> 

					
					<div id='f_fsh_h_general' style='padding:15px; background:#ebf9c9;'></div>
					
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

<!--######################## fsh scripts ########################### -->
//θέσε όλα τον τύπο περσίδων -fsh
function set_fsh_a(){
var default_fsh_a=document.getElementById("default_fsh_a").value;
	for (i=1;i<=10;i++){
	document.getElementById("fsh_a"+i).value=default_fsh_a;
	}
}
//θέσε όλα το μήκος περσίδων -fsh
function set_fsh_b(){
var default_fsh_b=document.getElementById("default_fsh_b").value;
	for (i=1;i<=10;i++){
	document.getElementById("fsh_b"+i).value=default_fsh_b;
	}
}
//θέσε όλα την απόσταση περσίδων -fsh
function set_fsh_c(){
var default_fsh_c=document.getElementById("default_fsh_c").value;
	for (i=1;i<=10;i++){
	document.getElementById("fsh_c"+i).value=default_fsh_c;
	}
}
//θέσε όλους τους προσανατολισμούς -fsh
function set_fsh_pros(){
var default_fsh_pros=document.getElementById("default_fsh_pros").value;
	for (i=1;i<=10;i++){
	document.getElementById("fsh_pros"+i).value=default_fsh_pros;
	}
}

function calc_fsh(print=0){

var x="includes/calc_skiaseis_f.php?skiasi=6&print="+print;

for (k=1;k<=10;k++){
var fsh_name=document.getElementById("fsh_name"+k).value;
var fsh_a=parseFloat(document.getElementById("fsh_a"+k).value);
var fsh_b=parseFloat(document.getElementById("fsh_b"+k).value);
var fsh_c=parseFloat(document.getElementById("fsh_c"+k).value);
var fsh_pros=parseFloat(document.getElementById("fsh_pros"+k).value);

var tan_toixoy =  fsh_b / fsh_c;
var deg_toixoy = Math.atan(tan_toixoy) *  180 / Math.PI;


document.getElementById("fsh_deg_t"+k).value=number_format(deg_toixoy,2);

x += "&name"+k+"=" + fsh_name + "&deg_toixoy"+k+"=" + deg_toixoy + "&pros"+k+"=" + fsh_pros;
x += "&fsh_a"+k+"=" + fsh_a + "&fsh_b"+k+"=" + fsh_b + "&fsh_c"+k+"=" + fsh_c;
}//τέλος επαναληψης

	if(print==0){
	//json result
	jQuery.ajax({
			url: x,
			type: "POST",
			async: true, //αλλαγή σε false δουλεύει πάντοτε αλλά επιβραδύνει τον browser
			success: function (data) {
				var html = data;
				document.getElementById("f_fsh_h_general").innerHTML=html;
			}
		});
	}
	
	if(print==1){
	window.open(x,"La-Kenak");
	}
}


<!--######################## fsh scripts ########################### -->


			</script>
	</div><!--tab content-->
	</div><!--tabs-->

</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->