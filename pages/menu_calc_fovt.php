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
	<small>Σκιάσεις τέντας (F<sub>ovt</sub>)</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li><a href="#"><i class="fa fa-industry"></i> Σκιάσεις</a></li>
	<li class="active"> Fovt</li>
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
			<li><a tabindex="-1" href="#" onclick="calc_ovt(1);"><span class="fa fa-file-pdf-o"></span> Δημιουργία PDF</a></li>
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
			Kατά τη διάρκεια της χειμερινής περιόδου θεωρείται ότι δεν υπάρχει σκίαση λόγω τέντας. Κατά τη διάρκεια της θερινής περιόδου, 
			όταν υπάρχει παράλληλη σκίαση λόγω τέντας και λόγω προβόλου, η σκίαση λόγω προβόλου αγνοείται.<br/><br/>
			<img class="img-responsive" src="images/shading/tentes.png"></img><br/>
			</div>

	</div>
		
	<div class="col-md-10">
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab">Τέντες (Fovt)</a></li>
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
							<a class="tooltipui" href="#" title="Ύψος τοίχου κάτω από τέντα (m) ">H</a><br/><br/>
							<input class="form-control input-sm" id="default_ovt_a" type="text" onkeyup="set_ovt_a();calc_ovt();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Ύψος πόρτας (m)">H<sub>w</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_ovt_b" type="text" onkeyup="set_ovt_b();calc_ovt();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Ύψος παραθύρου (m)">H<sub>w1</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_ovt_c" type="text" onkeyup="set_ovt_c();calc_ovt();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Ύψος ποδιάς (m)">d<sub>1</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_ovt_d" type="text" onkeyup="set_ovt_d();calc_ovt();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Απόστ. υαλοστασίων (m) ">g</a><br/><br/>
							<input class="form-control input-sm" id="default_ovt_g" type="text" onkeyup="set_ovt_g();calc_ovt();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Μήκος τέντας L (m)">L<sub>t</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_ovt_e" type="text" onkeyup="set_ovt_e();calc_ovt();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Ύψος τέντας H (m)">H<sub>t</sub></a><br/><br/>
							<input class="form-control input-sm" id="default_ovt_f" type="text" onkeyup="set_ovt_f();calc_ovt();">
						</td>
						<td>
							<a class="tooltipui" href="#" title="Προσανατολισμός (μοίρες)">γ</a><br/><br/>
							<input class="form-control input-sm" id="default_ovt_pros" type="text" onkeyup="set_ovt_pros();calc_ovt();">
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
						<td><input class="form-control input-sm" type="text" id="ovt_name<?php echo $i; ?>" value="Τ-<?php echo $i; ?>" /></td>
						<td><input class="form-control input-sm" type="text" id="ovt_a<?php echo $i; ?>" onchange="calc_ovt();" /></td>
						<td><input class="form-control input-sm" type="text" id="ovt_b<?php echo $i; ?>" onchange="calc_ovt();" /></td>
						<td><input class="form-control input-sm" type="text" id="ovt_c<?php echo $i; ?>" onchange="calc_ovt();" /></td>
						<td><input class="form-control input-sm" type="text" id="ovt_d<?php echo $i; ?>" onchange="calc_ovt();" /></td>
						<td><input class="form-control input-sm" type="text" id="ovt_g<?php echo $i; ?>" onchange="calc_ovt();" /></td>
						<td><input class="form-control input-sm" type="text" id="ovt_e<?php echo $i; ?>" onchange="calc_ovt();" /></td>
						<td><input class="form-control input-sm" type="text" id="ovt_f<?php echo $i; ?>" onchange="calc_ovt();" /></td>
						<td><input class="form-control input-sm" type="text" id="ovt_pros<?php echo $i; ?>" onchange="calc_ovt();" /></td>
						<td><input class="form-control input-sm" type="text" id="ovt_deg_t<?php echo $i; ?>" disabled="disabled" class="disabled"></td>
						<td><input class="form-control input-sm" type="text" id="ovt_deg_door<?php echo $i; ?>" disabled="disabled" class="disabled"></td>
						<td><input class="form-control input-sm" type="text" id="ovt_deg_an<?php echo $i; ?>" disabled="disabled" class="disabled"></td>
						</tr>
						<?php } ?>
						
					</table>
				</font>		
					<input class="form-control" type="hidden" name="min" value="<?php echo $min; ?>" /> 
					
					<div id='f_ovt_h_general' style='padding:15px; background:#ebf9c9;'></div>
					
					<br/><br/> Πίνακας σκίασης για τέντες: Πίνακας 3.19 (Συντελεστές προβόλου) της ΤΟΤΕΕ 20701-1.
			
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

<!--######################## ovt scripts ########################### -->
//θέσε όλα τα ύψη των τοίχων -ovt
function set_ovt_a(){
var default_ovt_a=document.getElementById("default_ovt_a").value;
	for (i=1;i<=10;i++){
	document.getElementById("ovt_a"+i).value=default_ovt_a;
	}
}
//θέσε όλα Ύψος πόρτας -ovt
function set_ovt_b(){
var default_ovt_b=document.getElementById("default_ovt_b").value;
	for (i=1;i<=10;i++){
	document.getElementById("ovt_b"+i).value=default_ovt_b;
	}
}
//θέσε όλα Ύψος παραθύρου -ovt
function set_ovt_c(){
var default_ovt_c=document.getElementById("default_ovt_c").value;
	for (i=1;i<=10;i++){
	document.getElementById("ovt_c"+i).value=default_ovt_c;
	}
}
//θέσε όλα Ύψος ποδιάς -ovt
function set_ovt_d(){
var default_ovt_d=document.getElementById("default_ovt_d").value;
	for (i=1;i<=10;i++){
	document.getElementById("ovt_d"+i).value=default_ovt_d;
	}
}
//θέσε όλες τις αποστάσεις υαλοστασίων -ovt
function set_ovt_g(){
var default_ovt_g=document.getElementById("default_ovt_g").value;
	for (i=1;i<=10;i++){
	document.getElementById("ovt_g"+i).value=default_ovt_g;
	}
}
//θέσε όλα Μήκος τέντας -ovt
function set_ovt_e(){
var default_ovt_e=document.getElementById("default_ovt_e").value;
	for (i=1;i<=10;i++){
	document.getElementById("ovt_e"+i).value=default_ovt_e;
	}
}
//θέσε όλα Μήκος τέντας -ovt
function set_ovt_f(){
var default_ovt_f=document.getElementById("default_ovt_f").value;
	for (i=1;i<=10;i++){
	document.getElementById("ovt_f"+i).value=default_ovt_f;
	}
}
//θέσε όλους τους προσανατολισμούς -ovt
function set_ovt_pros(){
var default_ovt_pros=document.getElementById("default_ovt_pros").value;
	for (i=1;i<=10;i++){
	document.getElementById("ovt_pros"+i).value=default_ovt_pros;
	}
}

function calc_ovt(print=0){

var x="includes/calc_skiaseis_f.php?skiasi=5&print="+print;

for (k=1;k<=10;k++){
var ovt_name=document.getElementById("ovt_name"+k).value;
var ovt_a=parseFloat(document.getElementById("ovt_a"+k).value);
var ovt_b=parseFloat(document.getElementById("ovt_b"+k).value);
var ovt_c=parseFloat(document.getElementById("ovt_c"+k).value);
var ovt_d=parseFloat(document.getElementById("ovt_d"+k).value);
var ovt_g=parseFloat(document.getElementById("ovt_g"+k).value);
var ovt_e=parseFloat(document.getElementById("ovt_e"+k).value);
var ovt_f=parseFloat(document.getElementById("ovt_f"+k).value);
var ovt_pros=parseFloat(document.getElementById("ovt_pros"+k).value);

var tan_toixoy, deg_toixoy, tan_door, deg_door, tan_an, deg_an;

if( ovt_f-(ovt_a/2) > 0){
	tan_toixoy =  (ovt_e / (ovt_f-(ovt_a/2)));
	deg_toixoy = Math.atan(tan_toixoy) *  180 / Math.PI;
}else{
	deg_toixoy = 90;
}

if( ovt_f - (ovt_b/2) > 0){
	tan_door = ((ovt_e+ovt_g) / (ovt_f - (ovt_b/2)));
	deg_door = Math.atan(tan_door) *  180 / Math.PI;
}else{
	deg_door = 90;
}

if( ovt_f - ovt_d - (ovt_c/2) >0 ){
	tan_an = ((ovt_e+ovt_g) / (ovt_f - ovt_d - (ovt_c/2)));
	deg_an = Math.atan(tan_an) *  180 / Math.PI;
}else{
	deg_an = 90;
}

document.getElementById("ovt_deg_t"+k).value=number_format(deg_toixoy,2);
document.getElementById("ovt_deg_door"+k).value=number_format(deg_door,2);
document.getElementById("ovt_deg_an"+k).value=number_format(deg_an,2);

x += "&name"+k+"=" + ovt_name + "&deg_toixoy"+k+"=" + deg_toixoy + "&deg_door"+k+"=" + deg_door + "&deg_an"+k+"=" + deg_an + "&pros"+k+"=" + ovt_pros;
x += "&ovt_a"+k+"=" + ovt_a + "&ovt_b"+k+"=" + ovt_b + "&ovt_c"+k+"=" + ovt_c + "&ovt_d"+k+"=" + ovt_d + "&ovt_g"+k+"=" + ovt_g + "&ovt_e"+k+"=" + ovt_e + "&ovt_f"+k+"=" + ovt_f;
}//τέλος επαναληψης

	if(print==0){
	//json result
	jQuery.ajax({
			url: x,
			type: "POST",
			async: true, //αλλαγή σε false δουλεύει πάντοτε αλλά επιβραδύνει τον browser
			success: function (data) {
				var html = data;
				document.getElementById("f_ovt_h_general").innerHTML=html;
			}
		});
	}
	
	if(print==1){
	window.open(x,"La-Kenak");
	}
}


<!--######################## ovt scripts ########################### -->


			</script>
	</div><!--tab content-->
	</div><!--tabs-->

</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->