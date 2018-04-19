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
	<small>Ύγρανση</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li><a href="#"><i class="fa fa-industry"></i> Συστήματα</a></li>
	<li class="active"> Ύγρανση</li>
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
			<li class="active"><a href="#tabs-1" data-toggle="tab">Μονάδα ύγρανσης</a></li>
		</ul>
		<div class="tab-content">	
			<!--Μονάδα ύγρανσης-->
			<div class="tab-pane active" id="tabs-1">
			
<table class="table table-bordered">
	<tr class="warning">
	<td colspan="2">Βαθμός απόδοσης μονάδας ύγρανσης</td>
	</tr>
	
	<tr>
	<th>Παράμετρος</th>
	<th>Τιμή</th>
	</tr>
	
	<tr>
	<td>Τύπος μονάδας</td>
	<td>
	<select class="form-control" id="ygransi_type" onchange=calc_ygransi(); >
	<option value=0>Επιλέξτε...</option>
	<option value=1>Ατμολέβητας κεντρικής παροχής</option>
	<option value=2>Τοπική μονάδα ψεκασμού/ατμού</option>
	</select>
	</td>
	</tr>
	
	<tr>
	<td>Ισχύς μονάδας ύγρανσης P<sub>υγρανσης</sub></td>
	<td><input class="form-control" type="text" id="ygransi_p" onkeyup=calc_ygransi(); /></td>
	</tr>
	<tr>
	<td>Ισχύς μονάδας ύγρανσης P<sub>υγρανσης</sub></td>
	<td><input class="form-control" type="text" id="ygransi_n" disabled="disabled" /></td>
	</tr>
	
</table>
	
<blockquote>
<small>
Οι απώλειες διανομής για ατμολέβητα κεντρικής παροχής ή άλλη κεντρική μονάδα υπολογίζονται όπως 
σε δίκτυα διανομής θέρμανσης για υψηλές Τ. Για τοπικά συστήματα θεωρούνται αμελητέες.
</small>
<small>
Οι απώλειες εκπομπής στις τερματικές μονάδες (σύστημα διοχέτευσης) θεωρούνται αμελητέες.
</small>
</blockquote>			
	
			</div>
			<!--Μονάδα ύγρανσης-->
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

function calc_ygransi(){
	var type = document.getElementById('ygransi_type').value;
	var p = document.getElementById('ygransi_p').value;
	var n;
	
	if(type==2){
	n = 1;
	document.getElementById('ygransi_p').disabled = true;
	}else{
	document.getElementById('ygransi_p').disabled = false;
		if(p<4){
		n = "Εισάγετε ισχύ P";
		}
		if(p>=4 && p<=25){
		n = 0.919;
		}
		if(p>25 && p<=50){
		n = 0.925;
		}
		if(p>50 && p<=100){
		n = 0.93;
		}
		if(p>100 && p<=200){
		n = 0.934;
		}
		if(p>200 && p<=300){
		n = 0.938;
		}
		if(p>300 && p<=400){
		n = 0.941;
		}
		if(p>400){
		n = 0.944;
		}
	}
	
	document.getElementById('ygransi_n').value = n;
}
</script>
			
		
	</div><!--tab content-->
			</div><!--tabs-->
</div><!--col-md-12-->
</div>
 <!-- /.row (main row) -->
<script>
	$("input").alphanum();	
</script>	
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

