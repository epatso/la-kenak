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
	<small>Σκίαση ανοίγματος (pdf)</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li><a href="#"><i class="fa fa-industry"></i> Σκιάσεις</a></li>
	<li class="active"> Φύλλο ανοίγματος (pdf)</li>
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
			<li><a tabindex="-1" href="#" onclick="calc_fyllo(1);"><span class="fa fa-file-pdf-o"></span> Δημιουργία PDF</a></li>
			<li><a tabindex="-1" href="#" onclick="clear_fyllo();"><span class="fa fa-trash"></span> Καθαρισμός</a></li>
			<li><a tabindex="-1" href="#" onclick="load_help();"><span class="fa fa-question"></span> Βοήθεια</a></li>
			</ul>
			</div>
		<?php
		}
		?>	
			
		<br/><br/>
			<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Βοήθεια</h4>
			Στη συγκεκριμένη ενότητα υπολογίζονται και οι 3 συντελεστές σκίασης και δίνεται το γινόμενο του συνολικού συντελεστή σκίασης 
			για τη χειμερινή και θερινή περίοδο. 
			</div>

	</div>
		
	<div class="col-md-10">
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab">Φύλλο ελέγχου ανοίγματος</a></li>
		</ul>
			<div class="tab-content">
			<div class="tab-pane active" id="tabs-1">
			<script>
			$(function() {
				$('.tooltipui').popover();
			});
			</script>
			
				<font size="1">
				Φύλλο ελέγχου: <input class="form-control input-sm" id="fyllo_name" type="text"><br/>
					<table class="table table-bordered">
						<tr class="warning">
							<td colspan="6">Στοιχεία ανοίγματος</td>
						</tr>
						
						<tr>
						<td>Ύψος τοίχου (m)</td><td>Μήκος (m)</td><td>Ύψος (m)</td>
						<td>Ποδιά (m)</td><td>Απόσταση υαλ. από παρειά (m)</td>
						<td>Προσ. (deg)</td></tr>
						<tr>
							<td><input class="form-control input-sm" id="fyllo_th" type="text" onkeyup="calc_fyllo();"></td>
							<td><input class="form-control input-sm" id="fyllo_l" type="text" onkeyup="calc_fyllo();"></td>
							<td><input class="form-control input-sm" id="fyllo_h" type="text" onkeyup="calc_fyllo();"></td>
							<td><input class="form-control input-sm" id="fyllo_p" type="text" onkeyup="calc_fyllo();"></td>	
							<td><input class="form-control input-sm" id="fyllo_g" type="text" onkeyup="calc_fyllo();"></td>	
							<td><input class="form-control input-sm" id="fyllo_pros" type="text" onkeyup="calc_fyllo();"></td>								
						</tr>
					</table>	
					
					<div class="container-fluid">
					<div class="row">
					<div class="col-md-6">
					<table class="table table-bordered">
						<tr class="success">
							<td colspan="2">Σκίαση ορίζοντα</td>
						</tr>
						
						<tr>
						<td>Απόσταση εμποδίου (m)</td><td>Ύψος εμποδίου (m)</td></tr>
						<tr>
							<td><input class="form-control input-sm" id="fyllo_hor_l" type="text" onkeyup="calc_fyllo();"></td>
							<td><input class="form-control input-sm" id="fyllo_hor_h" type="text" onkeyup="calc_fyllo();"></td>							
						</tr>
					</table>	
					</div>
					
					<div class="col-md-6">
					<table class="table table-bordered">
						<tr class="success">
							<td colspan="2">Σκίαση προβόλου</td>
						</tr>
						
						<tr><td>Μήκος προβόλου (m)</td>
							<td><input class="form-control input-sm" id="fyllo_ov_l" type="text" onkeyup="calc_fyllo();"></td>						
						</tr>
					</table>
					</div>
					</div>
					
					<div class="row">
					<div class="col-md-6">
					<table class="table table-bordered">
						<tr class="success">
							<td colspan="2">Σκίαση αριστερά</td>
						</tr>
						
						<tr>
						<td>Απόσταση εμποδίου (m)</td><td>Μήμος εμποδίου (m)</td></tr>
						<tr>
							<td><input class="form-control input-sm" id="fyllo_finl_l" type="text" onkeyup="calc_fyllo();"></td>
							<td><input class="form-control input-sm" id="fyllo_finl_h" type="text" onkeyup="calc_fyllo();"></td>							
						</tr>
					</table>	
					</div>
					
					<div class="col-md-6">
					<table class="table table-bordered">
						<tr class="success">
							<td colspan="2">Σκίαση δεξιά</td>
						</tr>
						
						<tr>
						<td>Απόσταση εμποδίου (m)</td><td>Μήμος εμποδίου (m)</td></tr>
						<tr>
							<td><input class="form-control input-sm" id="fyllo_finr_l" type="text" onkeyup="calc_fyllo();"></td>
							<td><input class="form-control input-sm" id="fyllo_finr_h" type="text" onkeyup="calc_fyllo();"></td>							
						</tr>
					</table>
					</div>
					</div>
					</div>
					
				</font>
					<input class="form-control" type="hidden" name="min" value="" /> 

					
					<div id='f_fyllo_general' style='padding:15px; background:#ebf9c9;'></div>

			
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

function calc_fyllo(print=0){

var x="includes/calc_skiaseis_f.php?skiasi=7&print="+print;

var fyllo_name=document.getElementById("fyllo_name").value;
var fyllo_th=parseFloat(document.getElementById("fyllo_th").value);
var fyllo_l=parseFloat(document.getElementById("fyllo_l").value);
var fyllo_h=parseFloat(document.getElementById("fyllo_h").value);
var fyllo_p=parseFloat(document.getElementById("fyllo_p").value);
var fyllo_g=parseFloat(document.getElementById("fyllo_g").value);
var fyllo_pros=parseFloat(document.getElementById("fyllo_pros").value);
//hor
var fyllo_hor_l=parseFloat(document.getElementById("fyllo_hor_l").value);
var fyllo_hor_h=parseFloat(document.getElementById("fyllo_hor_h").value);
//ov
var fyllo_ov_l=parseFloat(document.getElementById("fyllo_ov_l").value);
//finl
var fyllo_finl_l=parseFloat(document.getElementById("fyllo_finl_l").value);
var fyllo_finl_h=parseFloat(document.getElementById("fyllo_finl_h").value);
//finr
var fyllo_finr_l=parseFloat(document.getElementById("fyllo_finr_l").value);
var fyllo_finr_h=parseFloat(document.getElementById("fyllo_finr_h").value);


x += "&fyllo_name=" + fyllo_name + "&fyllo_th=" + fyllo_th + "&fyllo_l=" + fyllo_l;
x += "&fyllo_h=" + fyllo_h + "&fyllo_p=" + fyllo_p + "&fyllo_g=" + fyllo_g + "&fyllo_pros=" + fyllo_pros;
x += "&fyllo_hor_l=" + fyllo_hor_l + "&fyllo_hor_h=" + fyllo_hor_h;
x += "&fyllo_ov_l=" + fyllo_ov_l;
x += "&fyllo_finl_l=" + fyllo_finl_l + "&fyllo_finl_h=" + fyllo_finl_h;
x += "&fyllo_finr_l=" + fyllo_finr_l + "&fyllo_finr_h=" + fyllo_finr_h;

	if(print==0){
	//json result
	jQuery.ajax({
			url: x,
			type: "POST",
			async: true, //αλλαγή σε false δουλεύει πάντοτε αλλά επιβραδύνει τον browser
			success: function (data) {
				var html = data;
				document.getElementById("f_fyllo_general").innerHTML=html;
			}
		});
	}
	
	if(print==1){
	window.open(x,"La-Kenak");
	}
}

function clear_fyllo(){
	document.getElementById("fyllo_name").value="";
	document.getElementById("fyllo_th").value="";
	document.getElementById("fyllo_l").value="";
	document.getElementById("fyllo_h").value="";
	document.getElementById("fyllo_p").value="";
	document.getElementById("fyllo_g").value="";
	document.getElementById("fyllo_pros").value="";
	
	document.getElementById("fyllo_hor_l").value="";
	document.getElementById("fyllo_hor_h").value="";
	document.getElementById("fyllo_ov_l").value="";
	document.getElementById("fyllo_finl_l").value="";
	document.getElementById("fyllo_finl_h").value="";
	document.getElementById("fyllo_finr_l").value="";
	document.getElementById("fyllo_finr_h").value="";
	document.getElementById("f_fyllo_general").innerHTML="";
}

function load_help(){
	var help="";
	help += "<div class=\"alert alert-success\">";
	help += "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
	help += "Εισάγουμε το ύψος του τοίχου που εδράζεται το άνοιγμα.<br/>";
	help += "Έπειτα το καθαρό πλάτος και ύψος καθώς και την ποδιά του ανοίγματος, την εσοχή του ανοίγματος από την εξωτερική παρειά του τοίχου και τον προσανατολισμό.<br/>";
	help += "Εάν κάποια σκίαση δεν εμφανίζεται την αφήνουμε κενή και οι συντελεστές σκίασης εμφανίζονται ως 1 για περίοδο θέρμανσης και ψύξης.<br/><br/>";
	help += "Το πλήκτρο καθαρισμού <span class=\"glyphicon glyphicon-trash\"></span> μηδενίζει όλα τα κελιά και επαναφέρει τη σελίδα στην αρχική μορφή.<br/><br/>";
	help += "Στο κάτω μέρος της σελίδας γίνεται αυτόματα ο υπολογισμό συντελεστών και η προεπισκόπηση του υπολογισμού ";
	help += "ενώ πατώντας στο πλήκτρο εκτύπωσης <span class=\"glyphicon glyphicon-print\"></span> δημιουργείται pdf με τα αποτελέσματα.<br/><br/>";
	help += "Το φύλλο σκιάσεων δεν χρειάζεται να το αποθηκεύσετε καθώς στη μελέτη υπολογίζονται αυτόματα οι συντελεστές.";
	help += "</div>";
	
	document.getElementById("help").innerHTML=help;
}
<!--######################## fsh scripts ########################### -->


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