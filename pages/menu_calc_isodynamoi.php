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
	<small>U Ισοδύναμοι</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li class="active"> U Ισοδύναμοι</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
<div class="col-md-12">
	
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab"><i class="fa fa-plus-square-o"></i> Οριζόντια</a></li>
			<li><a href="#tabs-2" data-toggle="tab"><i class="fa fa-plus-square-o"></i> Κατακόρυφα</a></li>
			<li><a href="#tabs-3" data-toggle="tab"><i class="fa fa-plus-square-o"></i> Πίνακες ΤΟΤΕΕ-20701-2</a></li>
		</ul>
			
			<div class="tab-content">	
			<!--tabs-1-->
			<div class="tab-pane active" id="tabs-1">
			
			<h6>Ισοδύναμος συντελεστής θερμοπερατότητας U'<sub>FB</sub> [W/(m<sup>2</sup>K)] οριζόντιου δομικού στοιχείου 
			ονομαστικού συντελεστή θερμοπερατότητας U<sub>fb</sub> [W/(m<sup>2</sup>K)] με χαρακτηριστική διάσταση πλάκας Β' που εκτείνεται σε βάθος z [m] </h6>
			<img src="images/word-images/ufb.png">
				<table class="table table-condensed">
					<tr>
						<th>Ονομαστικός συντελεστής U<sub>fb</sub> <br/>[W/(m<sup>2</sup>K)]</th>
						<th>Βάθος z <br/>(m)</th>
						<th>Χαρακτηριστική διάσταση πλάκας B' <br/>(m)</th>
						<th>Ισοδύναμος συντελεστής U'<sub>fb</sub> <br/>[W/(m<sup>2</sup>K)] (Πίνακας 3.8 ΤΟΤΕΕ-20701-1)</th>
					</tr>
					<tr>
						<td>
							<select class="form-control" id="orizontio_ufb" onchange=calc_isu_oriz(); >
								<option value=4.5>4.5</option>
								<option value=4>4</option>
								<option value=3.5>3.5</option>
								<option value=3>3</option>
								<option value=2.5>2.5</option>
								<option value=2>2</option>
								<option value=1.5>1.5</option>
								<option value=1>1</option>
								<option value=0.9>0.9</option>
								<option value=0.8>0.8</option>
								<option value=0.7>0.7</option>
								<option value=0.6>0.6</option>
								<option value=0.5>0.5</option>
								<option value=0.4>0.4</option>
								<option value=0.3>0.3</option>
							</select>
							<!--<input class="form-control" type="text" id="orizontio_ufb" onkeyup=calc_isu_oriz(); />-->
						</td>
						<td>
							<select class="form-control" id="orizontio_z" onchange=calc_isu_oriz(); >
								<option value=0>0</option>
								<option value=0.5>0.5</option>
								<option value=1>1.0</option>
								<option value=1.5>1.5</option>
								<option value=2>2</option>
								<option value=2.5>2.5</option>
								<option value=3>3</option>
								<option value=4>4</option>
								<option value=5>5</option>
								<option value=6>6</option>
								<option value=9>9</option>
							</select>
							<!--<input class="form-control" type="text" id="orizontio_z" onkeyup=calc_isu_oriz(); />-->
						</td>
						<td>
							<select class="form-control" id="orizontio_b" onchange=calc_isu_oriz(); >
								<option value=2>2</option>
								<option value=3>3</option>
								<option value=4>4</option>
								<option value=5>5</option>
								<option value=6>6</option>
								<option value=7>7</option>
								<option value=8>8</option>
								<option value=9>9</option>
								<option value=10>10</option>
								<option value=12>12</option>
								<option value=14>14</option>
								<option value=18>18</option>
								<option value=22>22</option>
								<option value=26>26</option>
								<option value=30>30</option>
							</select>
							<!--<input class="form-control" type="text" id="orizontio_b" onkeyup=calc_isu_oriz(); />-->
						</td>
						<td>
							<input class="form-control" type="text" id="isu_oriz" name="isu_oriz" disabled="disabled"/>
						</td>
					</tr>
				</table>
			<blockquote>
			<small>Η χαρακτηριστική διάσταση της οριζόντιας πλάκας (B') ισούται με το διπλάσιο του εμβαδού της προς την περίμετρο (B'=2A/Π).</small>
			</blockquote>
			</div>
			<!--tabs-1-->
			
			
			<!--tabs-2-->
			<div class="tab-pane" id="tabs-2">
			<h6>Ισοδύναμος συντελεστής θερμοπερατότητας U'<sub>TB</sub> [W/(m<sup>2</sup>K)] ενός κατακόρυφου δομικού στοιχείου 
			ονομαστικού συντελεστή θερμοπερατότητας U<sub>tb</sub> [W/(m<sup>2</sup>K)] που εκτείνεται σε βάθος z [m]</h6>
			<img src="images/word-images/utbz1z2.png">
			<img src="images/word-images/ufbz1z2_equation.png">
				<table class="table table-condensed">
					<tr>
						<th>Ονομαστικός συντελεστής U<sub>tb</sub> <br/>[W/(m<sup>2</sup>K)]</th>
						<th>Βάθος z<sub>1</sub> (κατώτερο) <br/>(m)</th>
						<th>Βάθος z<sub>2</sub> (ανώτερο) <br/>(m)</th>
						<th>Ισοδύναμος συντελεστής U'<sub>tb</sub> <br/>[W/(m<sup>2</sup>K)]Πίνακας 3.7<br/>ΤΟΤΕΕ-20701-1</th>
					</tr>
					<tr>
						<td>
							<input class="form-control" type="text" id="katakoryfo_utb" onkeyup=calc_isu_katak(); />
						</td>
						<td>
							<input class="form-control" type="text" id="katakoryfo_z1" onkeyup=calc_isu_katak(); />
						</td>
						<td>
							<input class="form-control" type="text" id="katakoryfo_z2" onkeyup=calc_isu_katak(); />
						</td>
						<td>
							<input class="form-control" type="text" id="isu_kat" name="isu_kat" disabled="disabled">
						</td>
					</tr>
				</table>
			
			<blockquote>
			<small>Εάν θέλετε να υπολογίσετε τον ισοδύναμο συντελεστή δομικού στοιχείου ευρισκόμενο σε βάθος z1 σε όλο του το μήκος 
			εισάγετε μόνο το z1 είτε την ίδια τιμή στο z1 και z2.</small>
			<small>Σε περίπτωση διαφοροποίησης των z1 και z2 υπολογίζεται ισοδύναμος συντελεστής για το κάθε βάθος ξεχωριστά και η 
			τελική τιμή για τον ισοδύναμο συντελεστή προκύπτει από τον παραπάνω τύπο.</small>
			</blockquote>
				
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
	

//Υπολογίζει τον ισοδύναμο συντελεστή κατακόρυφου δομικού σε βάθος z
function calc_isu_katak(){
	var utb = document.getElementById('katakoryfo_utb').value;
	var z1 = document.getElementById('katakoryfo_z1').value;
	var z2 = document.getElementById('katakoryfo_z2').value;
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","includes/functions_calc.php?utb="+utb+"&z1="+z1+"&z2="+z2 ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("isu_kat").value=xmlhttp.responseText;
	}}
}


//Υπολογίζει τον ισοδύναμο συντελεστή οριζόντιου δομικού σε βάθος z, με χαρ διάσταση B.
function calc_isu_oriz(){
	var ufb = document.getElementById('orizontio_ufb').value;
	var z = document.getElementById('orizontio_z').value;
	var b = document.getElementById('orizontio_b').value;
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","includes/functions_calc.php?ufb="+ufb+"&z="+z+"&b="+b ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("isu_oriz").value=xmlhttp.responseText;
	}}
}
</script>	
			</div>
			<!--tabs-2-->
		
			<!--tabs-3-->
			<div class="tab-pane" id="tabs-3">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tabs-41" data-toggle="tab">Κατακόρυφα</a></li>
						<li><a href="#tabs-42" data-toggle="tab">Οριζόντια</a></li>
					</ul>
			
				<div class="tab-content">
					<div class="tab-pane active" id="tabs-41">
						<?php
							echo create_library_domika9b();
						?>
					</div>
					<div class="tab-pane" id="tabs-42">
						<?php
							echo create_library_domika9a();
						?>
					</div>
				</div>
				</div>
			</div>
			<!--tabs-3-->
	</div><!--tab content-->
			</div><!--tabs-->
</div><!--col-md-12-->
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->