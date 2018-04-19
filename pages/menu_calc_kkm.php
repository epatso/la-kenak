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
	<small>Αερισμός</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li><a href="#"><i class="fa fa-industry"></i> Συστήματα</a></li>
	<li class="active"> Αερισμός</li>
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
			<li class="active"><a href="#tabs-1" data-toggle="tab">Εξαναγκασμένος αερισμός</a></li>
		</ul>
		<div class="tab-content">
			<!--Εξαναγκασμένος αερισμός-->
			<div class="tab-pane active" id="tabs-1">
			

<table class="table table-bordered">
	<tr class="warning">
	<td colspan="2">Βαθμός απόδοσης εναλλάκτη θερμότητας με μερική ανακυκλοφορία αέρα</td>
	</tr>
	
	<tr>
	<th>Παράμετρος</th>
	<th>Τιμή</th>
	</tr>
	
	<tr>
	<td>Βαθμός απόδοσης (συντελεστής ανάκτησης θερμότητας) του εναλλάκτη n<sub>he</sub> (-)</td>
	<td><input class="form-control" type="text" id="kkm_nhe" onkeyup=calc_he(); /></td>
	</tr>
	
	<tr>
	<td>Ποσοστό ανακυκλοφορίας του αέρα R (%)</td>
	<td><input class="form-control" type="text" id="kkm_r" onkeyup=calc_he(); /></td>
	</tr>
	
	<tr>
	<td>Συντελεστής ανάκτησης θερμότητας n<sub>he_total</sub> (-)</td>
	<td><input class="form-control" type="text" id="kkm_nhe_total" disabled="disabled" /></td>
	</tr>
</table>
	
<blockquote>
<small>
Ενδεικτική τιμή βαθμού απόδοσης εναλλάκτη θερμότητας: 50% - 70%.
</small>
<small>
Ενδεικτική τιμή ηλεκτρικής ισχύος του ανεμιστήρα (kw/μονάδα παρεχόμενου αέρα): 
0.5-2.5KW/m<sup>3</sup>/s για απλές ΚΚΜ και 2.5-6.5KW/m<sup>3</sup>/s για σύνθετα συστήματα ΚΚΜ
</small>
<small>
Η ειδική υγρασία του αέρα κατά τους υπολογισμούς: 7g/Kg
</small>
</blockquote>	

			</div>
			<!--Εξαναγκασμένος αερισμός-->
			
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

function calc_he(){
	var kkm_nhe = document.getElementById('kkm_nhe').value;
	var kkm_r = document.getElementById('kkm_r').value;
	var kkm_nhe_total = kkm_r/100 + kkm_nhe*(1-kkm_r/100);
	
	document.getElementById('kkm_nhe_total').value = number_format(kkm_nhe_total,3);
}
</script>

		
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