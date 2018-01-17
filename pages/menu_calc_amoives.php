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
	<small>Αμοιβές</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li><a href="#"><i class="fa fa-industry"></i> Συστήματα</a></li>
	<li class="active"> Αμοιβές</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
<div class="col-md-12">
	
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab">Αμοιβές μηχανικών</a></li>
		</ul>
		<div class="tab-content">	
			<!--tab-->
			<div class="tab-pane active" id="tabs-1">

<script type="text/javascript">
function showhideoptions() {
document.getElementById("katoikia").style.display = "none"; 
document.getElementById("levitas").style.display = "none"; 
document.getElementById("levitaspalaios").style.display = "none"; 
document.getElementById("klimatismos").style.display = "none"; 
document.getElementById("emvadon").style.display = "none";
if (document.getElementById("xrisi").selectedIndex == 0) {document.getElementById("katoikia").style.display = "";}
if (document.getElementById("xrisi").selectedIndex == 2) {document.getElementById("levitas").style.display = "";document.getElementById("levitaspalaios").style.display = "";}
if (document.getElementById("xrisi").selectedIndex == 3) {document.getElementById("klimatismos").style.display = "";}
if (document.getElementById("xrisi").selectedIndex < 2) {document.getElementById("emvadon").style.display = "";}
}
</script>		
			
<h6>Υπολογισμός Κόστους Ενεργειακής Επιθεώρησης (Π.Δ. 100/2010 ΦΕΚ177Α)</h6>
<table align='center' class="tabdiv1">

	<tr><td>Τύπος επιθεώρησης</td><td>
		<select class="form-control" id="xrisi" onchange="calc(); showhideoptions();">
		<option value="1">Κατοικία</option>
		<option value="2.5">Διαφορετική χρήση</option>
		<option value="50">Λέβητας / εγκατάσταση θέρμανσης</option>
		<option value="100">Εγκατάσταση Κλιματισμού</option>
		</select>
	</td></tr>
	
	
	
	<tr><td>&nbsp;</td><td></td></tr>
	
	<tr id="katoikia" onchange="calc();"><td>Κατοικία</td><td>
		<select class="form-control" id="spiti" onchange="calc();">
		<option value="1.5">Μονοκατοικία</option>
		<option value="2">Διαμέρισμα</option>
		<option value="1">Οικοδομή</option></select>
	</td></tr>

	<tr id="emvadon"><td>Εμβαδόν</td><td>
		<input class="form-control" type="text" value="" size="5" id="emv" onkeypress='validate(event);' onKeyUp='calc();'/> m&sup2;
	</td></tr>		
	
	<tr id="levitas" style="display:none"><td>Συνολική θερμική ισχύς&nbsp;</td><td>
		<select class="form-control" id="HkW" onchange="calc();">
		<option value="3"> Απο 20 έως 100 kW	</option>
		<option value="5"> Περισσότερο απο 100 kW</option></select>
	</td></tr>

	<tr id="levitaspalaios" style="display:none"><td>Συνολική θερμική ισχύς&nbsp;</td><td>
		<select class="form-control" id="Hage" onchange="calc();">
		<option value="1"> Εγκατάσταση νεότερη των 15 ετών</option>
		<option value="1.2"> Εγκατάσταση παλαιότερη των 15 ετών</option></select>
	</td></tr>
	
	<tr id="klimatismos" style="display:none">
	<td>Συνολική ψυκτική ισχύς&nbsp;</td>
	<td>
		<select class="form-control" id="klimatismoskW" onchange="calc();">
		<option value="3"> Απο 12 έως 100 kW	</option>
		<option value="5"> Περισσότερο απο 100 kW</option>
		</select>
	</td>
	</tr>

	<tr>
	<td>Φ.Π.Α.</td>
	<td><input class="form-control" type="text" size="5" value="24" id="vat" onkeypress='validate(event);' onKeyUp='calc();'/> %</td>
	</tr>

</table>

<table align="center" class="tabdiv1">
<tr><td>Αμοιβή μηχανικού&nbsp;</td><td id="apotelesmata">0.00</td><td>€</td></tr>
<tr><td>Φ.Π.Α.</td><td id="fpa">0.00</td><td>€</td></tr>
<tr><th>ΣΥΝΟΛΟ</th><th id="sum">0.00</th><th>€</th></tr>
<tr><td colspan=3>
<div id="min" style="display:none;">
<br><i>* Ελάχιστη αμοιβή</i>
</div>
</td></tr></table>
<br/><br/><br/>
<div align="center">
Ο συκγκεκριμένος υπολογισμός αναρτήθηκε σε παρόμοια μορφή για πρώτη φορά <a href="http://meleth.gr/Energy.html">ΕΔΩ</a>.  Γράφτηκε από την αρχή με νέο τρόπο εδώ (ΠΔ100).
</div>

<br/>
<blockquote>
<small>Οι ελάχιστες αμοιβές σε Πιστοποιητικά ενεργειακής απόδοσης καταργήθηκαν με βάση το μεσοπρόθεσμο πρόγραμμα. Πλέον η αμοιβή μπορεί να καθορίζεται με ιδιωτικό 
συμφωνητικό το οποίο αναρτάται στο σύστημα αμοιβών ιδιωτικών έργων του ΤΕΕ.</small>
<small>Παρ' όλα αυτά ο υπολογισμός στο σύστημα αμοιβών ιδιωτικών έργων του ΤΕΕ πραγματοποιείται με βάση το ΠΔ 100/2010.</small>
</blockquote>
			

<script type="text/javascript">
function calc() 
{
xrisi = document.getElementById("xrisi"); 
var katoikiaMin = new Array(200,150,200);
if (xrisi.selectedIndex == 0) {document.getElementById("apotelesmata").innerHTML = Math.max((xrisi.options[xrisi.selectedIndex].value*document.getElementById("spiti").options[document.getElementById("spiti").selectedIndex].value*document.getElementById("emv").value),katoikiaMin[document.getElementById("spiti").selectedIndex]).toFixed(2);}
if (xrisi.selectedIndex == 1) {document.getElementById("apotelesmata").innerHTML = Math.max((xrisi.options[xrisi.selectedIndex].value*Math.min(1000,document.getElementById("emv").value) + 1.5*Math.max(0,document.getElementById("emv").value-1000)),300).toFixed(2);}
if (xrisi.selectedIndex == 2) {document.getElementById("apotelesmata").innerHTML = (xrisi.options[xrisi.selectedIndex].value*document.getElementById("HkW").options[document.getElementById("HkW").selectedIndex].value*document.getElementById("Hage").options[document.getElementById("Hage").selectedIndex].value).toFixed(2);}
if (xrisi.selectedIndex == 3) {document.getElementById("apotelesmata").innerHTML = (xrisi.options[xrisi.selectedIndex].value*document.getElementById("klimatismoskW").options[document.getElementById("klimatismoskW").selectedIndex].value).toFixed(2);}
document.getElementById("fpa").innerHTML=(parseFloat(document.getElementById("apotelesmata").innerHTML)*(document.getElementById("vat").value/100)).toFixed(2);
document.getElementById("sum").innerHTML=(parseFloat(document.getElementById("apotelesmata").innerHTML)+parseFloat(document.getElementById("fpa").innerHTML)).toFixed(2);
}
	
// Ρουτίνα ελέγχου για κείμενο στα κελιά που απαιτείται αριθμός 

function validate(evt) 

{
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
	if ( key != 46 && key != 8 ) {
	key = String.fromCharCode( key );
	var regex = /[0-9]|\./;
		if( !regex.test(key) ) {
		theEvent.returnValue = false;
		theEvent.preventDefault();
		}
	}
}

</script>
			</div>
			<!--tab-1-->
		
	</div><!--tab content-->
			</div><!--tabs-->
</div><!--col-md-12-->
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

