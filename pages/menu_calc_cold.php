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
	<small>Ψύξη</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li><a href="#"><i class="fa fa-industry"></i> Συστήματα</a></li>
	<li class="active"> Ψύξη</li>
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
			<li class="active"><a href="#tabs-1" data-toggle="tab">Μονάδα παραγωγής</a></li>
			<li><a href="#tabs-2" data-toggle="tab">P>100 Έλεγχος</a></li>
			<li><a href="#tabs-3" data-toggle="tab">Δίκτυο διανομής</a></li>
			<li><a href="#tabs-4" data-toggle="tab">Τερματικές μονάδες</a></li>
			<li><a href="#tabs-5" data-toggle="tab">Πίνακες ΤΟΤΕΕ</a></li>
		</ul>
		<div class="tab-content">	
				
			<!--Μονάδα παραγωγής-->
			<div class="tab-pane active" id="tabs-1">
			
<table class="table table-bordered">
	<tr class="info">
	<td colspan="3">Βαθμός επίδοσης (EER) αντλιών θερμότητας και ψυκτών</td>
	</tr>
	
	<tr>
		<th colspan="2">Εάν τηρεί τον κανονισμό Ενεργειακής Επισήμανσης της ΕΕ και με βάση θερμαινόμενο μέσο: </th>
		<th>SEER</th>
	</tr>
	<tr>
		<td>Α. Αέρας (ΕΕ 626/2011)</td>
		<td>
			<div class="input-group">
				<span class="input-group-addon">SEER<sub>ΕΣ</sub></span>
				<input class="form-control" type="text" id="calcold_seeres"  onkeyup=cold_eer1(); />
			</div>
		</td>
		<td>
			<div class="input-group">
				<span class="input-group-addon">SEER=0.60 x SEER<sub>ΕΣ</sub></span>
				<input class="form-control" type="text" id="calcold_eer1" disabled="disabled" />
			</div>
		</td>
	</tr>
	<tr>
	
	
	<tr>
	<th colspan="2">Αν δεν είναι γνωστά τα χαρακτηριστικά</th>
	<th>SEER</th>
	</tr>

	<tr>
		<td>Τύπος:</td>
		<td>
		<select class="form-control" id="calcold_eer2type" onchange=cold_eer2(); >
		<option value=0>Επιλέξτε...</option>
		<option value=1>Αερόψυκτη αντλία</option>
		<option value=2>Υδρόψυκτη αντία</option>
		</select>
		</td>
		<td rowspan="2">
		<input class="form-control" type="text" id="calcold_eer2" disabled="disabled" />
		</td>
	</tr>
	<tr>
		<td>Χρόνος εγκατάστασης:</td>
		<td>
		<select class="form-control" id="calcold_eer2year" onchange=cold_eer2(); >
		<option value=0>Επιλέξτε...</option>
		<option value=1>Χωρίς γνωστή χρονολογία</option>
		<option value=2>πριν το 1990</option>
		<option value=3>μεταξύ 1990 και 2000</option>
		<option value=4>Μετά το 2001</option>
		</select>
		</td>
	</tr>
	
	
	<tr>
	<th colspan="2">Με βάση την ισχύ</th>
	<th>EER</th>
	</tr>
	
	<tr>
	<td>Αποδιδόμενη ισχύς (ψύξης):</td>
	<td>
	<input class="form-control" type="text" id="calcold_eer3out" onkeyup=cold_btu(); />KW
	<input class="form-control" type="text" id="calcold_eer3btu" onkeyup=cold_kw(); />BTU
	</td>
	<td rowspan="2">
	<input class="form-control" type="text" id="calcold_eer3" disabled="disabled" />
	</td>
	</tr>
	
	<tr>
	<td>Καταναλισκόμενη ισχύς (ηλεκτρική):</td>
	<td>
	<input class="form-control" type="text" id="calcold_eer3in" onkeyup=cold_eer4(); />KW
	</td>
	</tr>
	
</table>

<blockquote>
	<small>
	Screw : αερόψυκτος ψύκτης / Α.Θ με κοχλιωτό συμπιεστή και με δυνατότητα εκφόρτισης
	</small>
	<small>
	Scroll : αερόψυκτος ψύκτης / Α.Θ. με σπειροειδή συμπιεστή και με δυνατότητα εκφόρτισης
	</small>
	<small>
	Recipr: αερόψυκτος ψύκτης / Α.Θ με παλινδρομικό συμπιεστή χωρίς δυνατότητα εκφόρτισης
	</small>
	<small>
	WCA: υδρόψυκτος ψύκτης / Α.Θ χωρίς δυνατότητα εκφόρτισης (χαμηλής απόδοσης)
	</small>
	<small>
	WCΒ: υδρόψυκτος ψύκτης / Α.Θ με δυνατότητα εκφόρτισης (υψηλής απόδοσης)
	</small>
	<small>
	όπου ο όρος «εκφρότιση» (unloading) εκφράζει την δυνατότητα του συμπιεστή να προσαρμόζεται στο ψυκτικό μερικό 
	φορτίο είτε με ρύθμιση στροφών (inverter) είτε με στραγγαλισμό τής ροής του ψυκτικού μέσου υπό αέρια μορφή εις 
	την είσοδο του συμπιεστή.
	</small>
	<small>
		Αναζήτηση ενεργειακής σήμανσης για αντλίες Daikin <i class="fa fa-3x fa-snowflake-o" aria-hidden="true" onclick=newPopup("http://gr.intpre.daikineurope.com/energylabel/")></i>
	</small>
</blockquote>

			</div>
			<!--Μονάδα παραγωγής-->

			
<script>
function cold_eer1(){
var seeres = document.getElementById('calcold_seeres').value;
var eer1=seeres*0.60;
document.getElementById('calcold_eer1').value = number_format(eer1,3,".","");
}


function cold_eer2(){
var type = document.getElementById('calcold_eer2type').value;
var year = document.getElementById('calcold_eer2year').value;
var x;
var air_pump=[0,1.7,1.7,2.2,2.5];
var water_pump=[0,2.2,2.2,2.7,3.0];
if(type==1){x=air_pump[year];}
if(type==2){x=water_pump[year];}
document.getElementById('calcold_eer2').value =x;
}


function cold_eer3(){
var kw_out = document.getElementById('calcold_eer3out').value;
var kw_in = document.getElementById('calcold_eer3in').value;
var eer3;
	if(kw_in!=0 && kw_out!=0){
	eer3 = kw_out / kw_in;
	}else{
	eer3 = 0;
	}
document.getElementById('calcold_eer3').value = number_format(eer3,3);
}

function cold_btu(){
var kw_out = document.getElementById('calcold_eer3out').value;
var btu = kw_out*3412.141633128;
document.getElementById('calcold_eer3btu').value = number_format(btu,1,".","");
cold_eer4();
}
function cold_kw(){
var btu_out = document.getElementById('calcold_eer3btu').value;
var kw = btu_out*0.000293071;
document.getElementById('calcold_eer3out').value = number_format(kw,3,".","");
cold_eer3();
}


</script>			
			
			<!--ΕΛΕΓΧΟΣ ΥΠΕΡΔΙΑΣΤΑΣΙΟΛΟΓΗΣΗΣ-->
			<div class="tab-pane" id="tabs-2">
				Υπό κατασκευή. <br/><br/>
				Για τις αντλίες θερμότητας ή/και τους ψύκτες με συνολική ψυκτική ικανότητα άνω των 100 kW, πρέπει να ελέγχεται η κάθε ψυκτική 
				εγκατάσταση ως προς την υπερδιαστασιολόγηση της και των επιπτώσεων αυτής στο μέσο εποχιακό δείκτη αποδοτικότητας (SEER). 
				Η ισχύς των 100 kW αφορά τη συνολική ψυκτική εγκατάσταση που εξυπηρετεί το κτήριο και όχι την κάθε μονάδα ξεχωριστά.
				<br/><br/>
				Ο έλεγχος πραγματοποιείται βάση του τύπου: 
				<br/><br/>
				P<sub>gen</sub> = Σ(U<sub>A</sub> x A<sub>A</sub> x CLTD<sub>A</sub>) + 
				Σ(Α<sub>Δ</sub> x GLF<sub>Δ</sub>) + P<sub>Π</sub> + P<sub>ΕΦ</sub> + V/3 x ΔΤ, όπου:
				<br/><br/>
				<ul>
				<li>P<sub>gen</sub>: η υπολογιζόμενη μέγιστη απαιτούμενη ψυκτική ισχύς της μονάδας ψύξεως/κλιματισμού του κτηρίου,</li>
				<li> A<sub>A</sub>: Εξωτερική επιφάνεια αδιαφανούς δομικού στοιχείου ή θυρών ανά προσανατολισμό</li>
				<li>Α<sub>Δ</sub>: Εξωτερική επιφάνεια διαφανούς στοιχείου ανά προσανατολισμό</li>
				<li>
					CLTD<sub>A</sub>: Μέση θερμοκρασιακή διαφορά ψυκτικού φορτίου μέσω αδιαφανών στοιχείων ή θυρών του κελύφους, 
					η οποία λαμβάνεται κατά ASHRAE ή απλουστευτικά ανά προσανατολισμό ως εξής : Β : 9°C, ΒΑ, ΒΔ : 14°C, A, Δ : 17 °C, Ν, ΝΑ, ΝΔ : 15°C, 
					οροφές-δώματα: 13 °C, δάπεδο κάτω από κλιματιζόμενο χώρο και πάνω από μη κλιματιζόμενο χώρο: 7, χωρίσματα εσωτερικά ή σκιαζόμενα: 7°C.
				</li>
				<li>
					GLF<sub>Δ</sub>: Παράγοντας φορτίου υαλοπίνακα σε W/m2 ο οποίος λαμβάνεται κατά ASHRAE ή απλουστευτικά 
					και ανά προσανατολισμό ως εξής: Β:82, ΒΑ: 140, Α, ΝΑ: 200, Ν: 148, ΝΔ, Δ: 250, ΒΔ 199, Οριζόντια: 378
				</li>
				<li>
					P<sub>Π</sub>: Η εκλυόμενη θερμότητα των φυσικών προσώπων σε W, λαμβανομένη από τον Πίνακα 2.7 
					(θερμική ισχύς ανά μονάδα δομημένης επιφάνειας) επί την επιφάνεια δαπέδου
				</li>
				<li>
					P<sub>ΕΦ</sub>: Εσωτερικά φορτία φωτιστικών και συσκευών σε W, τα οποία λαμβάνονται από τους Πίνακες 2.4α 
					(φωτισμός – στήλη ισχύος για το κτίριο αναφοράς) και 2.8 (ετεροχρονισμένη ισχύς εξοπλισμού) επί την επιφάνεια δαπέδου.
				</li>
				<li>
					U<sub>A</sub>: ο μέγιστος επιτρεπόμενος μέσος συντελεστής θερμοπερατότητας για τοσύνολο της επιφάνειας Α.<br/>
					Ανάλογα με την ηλικία του κτηρίου ο Um λαμβάνει τις τιμές:
					<ol>
						<li>
							3,5 W/(m2.K) ή όπως υπολογίζεται από τον επιθεωρητή, για κτήρια πριν την εφαρμογή του Κανονισμού Θερμομόνωσης 
							Κτηρίων (οικοδομικές άδειες πριν από το 1980),
						</li>
						<li>
							1,55 W/(m2.K) για την Α κλιματική ζώνη,<br/>
							1,20 W/(m2.K) για τη Β κλιματική ζώνη και<br/>
							0,95 W/(m2.K) για τη Γ κλιματική ζώνη,<br/>
							για κτήρια μετά την εφαρμογή του κανονισμού θερμομόνωσης (έγκριση οικοδομικής άδειας μετά το 1980), καθώς και 
							για κτήρια πριν από την ισχύ του κανονισμού, τα οποία πιστοποιημένα έχουν εφαρμόσει θερμομόνωση σε όλο το κτηριακό κέλυφος.
						</li>
						<li>
							Σύμφωνα με τη μελέτη θερμομόνωσης (μελέτη ενεργειακής απόδοσης) για κτήρια μετά την εφαρμογή του Κ.Εν.Α.Κ.
						</li>
					</ol>
				</li>
				<li>ΔΤ: η διαφορά της θερμοκρασίας για τη διαστασιολόγηση του συστήματος η οποία λαμβάνεται ίση με 10°C για όλες τις κλιματικές ζώνες.</li>
				<li>V: η συνολική προσαγωγή νωπού αέρα στον κλιματιζόμενο χώρο σε (m<sup>3</sup>/h) και υπολογίζεται βάσει του Πίνακα 2.3, στήλη 3.</li>
				</ul>
			</div>
			<!--ΕΛΕΓΧΟΣ ΥΠΕΡΔΙΑΣΤΑΣΙΟΛΟΓΗΣΗΣ-->
			
			<!--Δίκτυο διανομής-->
			<div class="tab-pane" id="tabs-3">

<table class="table table-bordered">
	<tr class="info">
	<td colspan="2">Βαθμός απόδοσης δικτύου διανομής</td>
	</tr>
	
	<tr>
		<th>Παράμετρος</th>
		<th>Τιμή</th>
	</tr>
	
	<tr>
		<td>Ψυκτική ισχύς του δικτύου διανομής</td>
		<td>
		<input class="form-control" type="text" id="dianomi_cold_p" onkeyup=get_dianomi_cold_n(); />
		</td>
	</tr>
	
	<tr>
		<td>Διέλευση</td>
		<td>
		<select class="form-control" id="dianomi_cold_dieleysi" onchange=get_dianomi_cold_n(); >
		<option value=0>Επιλέξτε...</option>
		<option value=1>Διέλευση σε εσωτερικούς χώρους ή/και 20% σε εξωτερικούς χώρους</option>
		<option value=2>Διέλευση > 20% σε εξωτερικούς χώρους</option>
		</select>
		</td>
	</tr>
	
	<tr>
		<td>Μόνωση</td>
		<td>
		<select class="form-control" id="dianomi_cold_monwsi" onchange=get_dianomi_cold_n(); >
		<option value=0>Επιλέξτε...</option>
		<option value=1>Μόνωση κτηρίου αναφοράς</option>
		<option value=2>Μόνωση ίση με την ακτίνα σωλήνων</option>
		<option value=3>Ανεπαρκής μόνωση</option>
		<option value=4>Χωρίς μόνωση</option>
		</select>
		</td>
	</tr>
	
	<tr>
	<td>Αεραγωγοί που διέρχονται από εξ. χώρους</td>
	<td>
		<div class="checkbox">
		<label>
		<input type="checkbox" id="dianomi_cold_ducts" onchange=get_dianomi_cold_n();>
		Αεραγωγοί
		</label>
		</div>
	</td>
	</tr>
	
	<tr>
	<th>Βαθμός απόδοσης Δικτύου διανομής</th>
	<td>
	<input class="form-control" type="text" id="dianomi_cold_n" disabled="disabled"/>
	</td>
	</tr>
	
</table>
<span id="distribution_bar"></span>

<blockquote>
	<small>
	Σε περίπτωση ύπαρξης άνω του ενός δικτύων διανομής στο κτήριο ή στη θερμική ζώνη, απαιτείται ο προσδιορισμός μίας μόνο απόδοσης δικτύου, η οποία θα είναι σταθμισμένη. 
	Κατά συνέπεια αν υπάρχουν άνω του ενός δίκτυα διανομής (που τροφοδοτούνται από διαφορετικές μονάδες παραγωγής) στο κτήριο ή στη θερμική ζώνη και παρουσιάζουν διαφορετική 
	ποιότητα και επάρκεια (ποσότητα) θερμομόνωσης, τότε η απόδοσή τους λαμβάνεται ενιαία και ίση με αυτήν του τμήματος που βρίσκεται στη χειρότερη ποιοτικά κατάσταση. 
	</small>
</blockquote>			
			</div>
			<!--Δίκτυο διανομής-->


<script>
function get_dianomi_cold_n(){
	var cold_p = document.getElementById('dianomi_cold_p').value;
	var dieleysi = document.getElementById('dianomi_cold_dieleysi').value;
	var monwsi = document.getElementById('dianomi_cold_monwsi').value;
	var dianomi_ducts = document.getElementById('dianomi_cold_ducts');
	var ducts;
	
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","includes/functions_calc.php?dianomi_cold_p="+cold_p+"&dianomi_cold_dieleysi="+dieleysi+"&dianomi_cold_monwsi="+monwsi ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		var n = xmlhttp.responseText;
		if(dianomi_ducts.checked){
			if(monwsi==1){
				ducts=0.99;
			}else{
				ducts=0.965;
			}
		}else{
			ducts=1;
		}
		n=n*ducts;
		var n100 = number_format(n*100,2);
		var pn = number_format(cold_p*n,3);
		document.getElementById("dianomi_cold_n").value=n;
		var result ="Το δίκτυο διανομής αποδίδει στις τερματικές μονάδες το "+n100+"% της ονομαστικής ισχύος ("+cold_p+"KW) δηλαδή: "+pn+"KW.<br/>";
		if(n100<=96){
		result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-info\" style=\"width: "+n100+"%;\">"+n100+"%</div></div>";
		}else{
		result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-info\" style=\"width: "+n100+"%;\"></div></div>";
		}
		document.getElementById("distribution_bar").innerHTML = result;
	}}
}
</script>			
			
			<!--Τερματικές μονάδες-->
			<div class="tab-pane" id="tabs-4">


<table class="table table-bordered">
	<tr class="info">
	<td colspan="4">Βαθμός απόδοσης τερματικών μονάδων</td>
	</tr>
	
	<tr>
	<th>Παράμετρος</th>
	<th>Υπολογισμός</th>
	<th>Τιμή</th>
	</tr>
	
	<tr>
	<td>
	n<sub>em</sub><br/>
	(Aπόδοση εκπομπής)
	</td>
	<td>
	<select class="form-control" id="type_nem" onchange=calc_nem(); >
	<option value=0>Επιλέξτε...</option>
	<option value=0.93>Άμεσα συστήματα</option>
	<option value=0.90>Ενσωματωμένες τερματικές μονάδες</option>
	<option value=0.93>Τοπικές αντλίες θερμότητας</option>
	</select>
	<div class="control-group warning">
	<label><input id="type_nem1" type="checkbox" value="" onclick=calc_nem();>Κακοσυντηρημένες μονάδες (εμφανείς φθορές)</label>
	</div>
	</td>
	<td><input class="form-control" type="text" id="nem" disabled="disabled" /></td>
	</tr>
	
	
	<tr>
	<td>
	f<sub>im</sub><br/>
	(Παράγοντας της διακοπτόμενης λειτουργίας)
	</td>
	<td>
	<select class="form-control" id="type_fim" onchange=calc_fim(); >
	<option value=0>Επιλέξτε...</option>
	<option value=1>Mε συνεχή λειτουργία</option>
	<option value=0.97>Mε διακοπτόμενη λειτουργία με δυνατότητα αυτόματης ρύθμισης λειτουργίας σε επίπεδο τερματικής μονάδας</option>
	</select>
	</td>
	<td><input class="form-control" type="text" id="fim" disabled="disabled" /></td>
	</tr>
	
	<tr>
	<td>
	f<sub>hydr</sub><br/>
	(Παράγοντας για την υδραυλική ισορροπία)
	</td>
	<td>
	<select class="form-control" id="type_fhydr" onchange=calc_fhydr(); >
	<option value=0>Επιλέξτε...</option>
	<option value=1>Με υδραυλικά εξισορροπημένο σύστημα</option>
	<option value=1.03>Με συστήματα εκτός ισορροπίας</option>
	</select>
	</td>
	<td><input class="form-control" type="text" id="fhydr" disabled="disabled" /></td>
	</tr>
	
	<tr>
	<th>
	n<sub>em,t</sub><br/>
	(Βαθμός απόδοσης)
	</th>
	<td>
	ΕΛΟΤ ΕΝ 15316.2.1:2008 : 
	n<sub>em,t</sub>=n<sub>em</sub>/(f<sub>im</sub>×f<sub>hydr</sub>)
	</td>
	<td><input class="form-control" type="text" id="nemt" disabled="disabled" /></td>
	</tr>
	
</table>	

<span id="termatikes_bar"></span>
<br/>

<blockquote>
	<small>	
	Άμεσα συστήματα: π.χ. μονάδες ανεμιστήρα στοιχείου (fan-coils), δαπέδου ή οροφής, 
	εσωτερικές μονάδες τοπικών συστημάτων άμεσης εξάτμισης, τερματικά στοιχεία διανομής αέρα κ.ά.
	</small>
	<small>
	Ενσωματωμένες τερματικές μονάδες: π.χ. ενδοτοίχιο, ενδοδαπέδιο, ψυχόμενες οροφές<br/>
	</small>	
</blockquote>			
<blockquote>
	<small>			
	Όταν σε ένα κτήριο ή σε θερμική ζώνη υπάρχουν περισσότεροι του ενός τύποι τερματικών μονάδων, ως απόδοση εκπομπής λαμβάνεται μια μέση σταθμισμένη τιμή, 
	ανάλογα με την απόδοση κάθε τερματικής μονάδας και του ποσοστού συμμετοχής (ψυκτική ικανότητα) της στο σύνολο του καλυπτόμενου φορτίου (των τερματικών μονάδων). 
	Σε περίπτωση προφανών βλαβών και κακοσυντήρησης (κατεστραμμένα τμήματα, διαβρώσεις, διαρροές κ.ά.) των τερματικών μονάδων, η απόδοση τερματικών μονάδων εκπομπής 
	λαμβάνεται μειωμένη κατά 10%. 	
	</small>
</blockquote>	
			</div>
			<!--Τερματικές μονάδες-->
			
<script>
// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=600,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes')
}

function calc_nem(){
var x = document.getElementById('type_nem').value;
var y = document.getElementById('type_nem1').checked;
	if(y == true){
	x = number_format(x*0.9,3);
	}
document.getElementById('nem').value =x;
calc_nemt();
}

function calc_fim(){
var x = document.getElementById('type_fim').value;
document.getElementById('fim').value =x;
calc_nemt();
}

function calc_fhydr(){
var x = document.getElementById('type_fhydr').value;
document.getElementById('fhydr').value =x;
calc_nemt();
}

function calc_nemt(){
var nem = document.getElementById('nem').value;
var fim = document.getElementById('fim').value;
var fhydr = document.getElementById('fhydr').value;
var nemt = number_format(nem/(fim*fhydr),3);
var nemt100 = nemt*100;

	document.getElementById('nemt').value =nemt;
	
	var result ="Οι τερματικές μονάδες αποδίδουν στο χώρο το "+nemt100+"% της ισχύος του δικτύου διανομής<br/>";
	if(nemt100<=96){
	result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-info active\" style=\"width: "+nemt100+"%;\">"+nemt100+"%</div></div>";
	}else{
	result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-info\" style=\"width: "+nemt100+"%;\"></div></div>";
	}
	document.getElementById("termatikes_bar").innerHTML=result;

}

</script>			
			
			
			
			<!--Πίνακες ΤΟΤΕΕ-->
			<div class="tab-pane" id="tabs-5">
				<?php
				include("accordions_cold.php");
				?>
			</div>
			<!--Πίνακες ΤΟΤΕΕ-->
			
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

