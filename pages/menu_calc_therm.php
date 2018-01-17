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
	<small>Θέρμανση</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li><a href="#"><i class="fa fa-industry"></i> Συστήματα</a></li>
	<li class="active"> Θέρμανση</li>
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
			<li class="active"><a href="#tabs-1" data-toggle="tab">Λέβητας - Καυστήρας</a></li>
			<li><a href="#tabs-2" data-toggle="tab">Αντλία θερμότητας</a></li>
			<li><a href="#tabs-3" data-toggle="tab">Άλλες μονάδες</a></li>
			<li><a href="#tabs-4" data-toggle="tab">Δίκτυο διανομής</a></li>
			<li><a href="#tabs-5" data-toggle="tab">Τερματικές μονάδες</a></li>
			<li><a href="#tabs-6" data-toggle="tab">Πίνακες ΤΟΤΕΕ</a></li>
		</ul>
			<div class="tab-content">
			<!--Μονάδα παραγωγής-->
			<div class="tab-pane active" id="tabs-1">


<table class="table table-bordered">
	<tr class="danger">
	<td colspan="3">Βαθμός απόδοσης λέβητα-καυστήρα</td>
	</tr>

	<tr>
		<td>P<sub>n</sub></td>
		<td>Ονομαστική ισχύς της μονάδας παραγωγής (η μικρότερη βαθμίδα) σε KW</td>
		<td><input class="form-control" type="text" id="calctherm_pn" onchange=get_thermp_ng(); /></td>
	</tr>

	<tr bgcolor="#f4684d">
		<th colspan="3">Νέος λέβητας του κανονισμού Ενεργειακής Επισήμανσης 811/2013 της ΕΕ</th>
	</tr>

	<tr bgcolor="#f79582">
		<td>
			n<sub>sΑΘ</sub><br/>Ενεργειακή Απόδοση Εποχιακής Θέρμανσης Χώρου
		</td>
		<td>
			Αναγράφονται στον φάκελο προϊόντος βάση του κανονισμού Ενεργειακής Επισήμανσης 811/2013 της ΕΕ.
		</td>
		<td>
			<input class="form-control" type="text" id="calctherm_nsath" onkeyup=get_thermp_ng(); />
		</td>
	</tr>

	<tr bgcolor="#f79582">
		<td>
		 ΣΜΘΔ<br/>Συντελεστής μετατροπής εποχιακού βαθμού απόδοσης ΣΜΘΔ για υγρά, αέρια και στερεά καύσιμα
		</td>
		<td>
			<div class="input-group">
			<span class="input-group-addon">ΣΜΘΔ</span>
			<select class="form-control" id="calctherm_nsthd_type" onchange=calc_smthd();>
				<option value=0>Επιλέξτε...</option>
				<?php
					echo create_select_optionsval("vivliothiki_therm_p_nsthd","name","nsthd");
				?>
			</select>
			</div>
		</td>
		<td>
			<input class="form-control" type="text" id="calctherm_nsthd" onchange=get_thermp_ng(); />
		</td>
	</tr>

	<tr bgcolor="#f9b3a6">
		<th colspan="3">Υφιστάμενος λέβητας εκτός Κανονισμού Ενεργειακής Επισήμανσης 811/2013 της ΕΕ (Χωρίς οικολογικό σχεδιασμό ή Ενεργειακή Σήμανση)</th>
	</tr>


	<tr bgcolor="#f9b3a6">
		<td>
			P<sub>gen</sub><br/>
			Απαιτούμενο θερμικό φορτίο (KW)
		</td>
		<td>
			<table class="table table-bordered">
				<tr>
					<td rowspan="2">
						P<sub>gen</sub>=
					</td>
					<td>
						<div class="input-group">
							<span class="input-group-addon">(Α</span>
							<input type="text" class="form-control" id="calctherm_pgen_a" onkeyup=calc_pgen(); />
							<span class="input-group-addon">x</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<span class="input-group-addon">U<sub>m</sub></span>
							<input type="text" class="form-control" id="calctherm_pgen_um" onkeyup=calc_pgen(); />
							<span class="input-group-addon">x1.5 + </span>
							</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<span class="input-group-addon">V</span>
							<input type="text" class="form-control" id="calctherm_pgen_v" onkeyup=calc_pgen(); />
							<span class="input-group-addon">/3) x</span>
						</div>
					</td>
					<td>
						<div class="input-group">
							<span class="input-group-addon">ΔΤ</span>
							<input type="text" class="form-control" id="calctherm_pgen_dt" onkeyup=calc_pgen(); />
							<span class="input-group-addon">=</span>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						(m2)
					</td>
					<td>
						<div class="input-group">
							<span class="input-group-addon">Um</span>
							<select class="form-control" id="calctherm_pgen_periodos" onchange=calc_pgen_um(); >
								<option value=0>Επιλέξτε...</option>
								<option value=1>Πριν τον ΚΘΚ</option>
								<option value=2>Στον ΚΘΚ</option>
								<option value=3>Κατά ΚΕΝΑΚ</option>
							</select>
						</div>
					</td>
					<td>
						<div class="input-group">
							<span class="input-group-addon">Χρήση ΘΖ</span>
							<select class="form-control" id="calctherm_pgen_zonexrisi" onchange=calc_pgen_v(); >
								<?php
									echo create_select_optionsval("vivliothiki_conditions_zone","name","air_perm2");
								?>
							</select>
						</div>
						<div class="input-group">
							<span class="input-group-addon">Ε (m<sup>2</sup>)</span>
							<input type="text" class="form-control" id="calctherm_pgen_zonee" onkeyup=calc_pgen_v(); />
						</div>
					</td>
					<td>
						<div class="input-group">
							<span class="input-group-addon">Ζώνη</span>
							<select class="form-control" id="calctherm_pgen_zone" onchange="calc_pgen_um();calc_pgen_dt();" >
								<option value=0>Επιλέξτε...</option>
								<option value=1>Α</option>
								<option value=2>Β</option>
								<option value=3>Γ</option>
								<option value=4>Δ</option>
							</select>
						</div>
					</td>
				</tr>
			</table>			
		</td>
		<td>
			<input class="form-control" type="text" id="calctherm_pgen" onchange=get_thermp_ng(); />
		</td>
	</tr>
	
	<tr bgcolor="#f9b3a6">
		<td>
			n<sub>gm</sub><br/>
			πραγματικός βαθμός απόδοσης της μονάδας λέβητα-καυστήρα
		</td>
		<td>
			Από ανάλυση καυσαερίων, η οποία είναι υποχρεωτική σύμφωνα με την Κ.Υ.Α.189533/07-11-2011 (ΦΕΚ 2654Β/2011) και φύλλο ελέγχου ή χωρίς φύλλο από Πίν. 4.2β - ΤΟΤΕΕ-20701-1: <br/>
			<div class="input-group">
			<span class="input-group-addon">ngm (άγνωστο)</span>
			<select class="form-control" id="calctherm_ngm1" onchange=get_thermp_ng(); >
				<option value=0>Επιλέξτε...</option>
				<?php
					echo create_select_optionsid("vivliothiki_therm_p_ngm","name");
				?>
			</select>
			</div>
			<div class="input-group">
				<span class="input-group-addon">ngm (φύλλο)</span>
				<input type="text" class="form-control" id="calctherm_ngm2" />
			</div>
		</td>
		<td>
			<input type="text" class="form-control" id="calctherm_ngm" />
		</td>
	</tr>

	<tr bgcolor="#f9b3a6">
		<td>
			n<sub>go</sub><br/>
			συντελεστής μετατροπής σε εποχιακό βαθμό απόδοσης
		</td>
		<td>
			Πίνακας 4.2γ - ΤΟΤΕΕ-20701-1
		</td>
		<td>
			<input type="text" class="form-control" id="calctherm_ngo" disabled="disabled" />
		</td>
	</tr>

	<tr bgcolor="#f79582">
		<td>
		 n<sub>sΚΘ</sub><br/>Εποχιακός βαθμός απόδοσης λέβητα - καυστήρα
		</td>
		<td>
			<div id="calctherm_info"></div>
		</td>
		<td>
			<input class="form-control" type="text" id="calctherm_nskth" disabled="disabled" />
		</td>
	</tr>

	<tr bgcolor="#f9b3a6">
		<td>
			n<sub>g1</sub>
		</td>
		<td>
			Πίνακας 4.3 - ΤΟΤΕΕ-20701-1<div id="calctherm_ng1info"></div>
			<br/>
			<div class="input-group">
				<span class="input-group-addon">Υπερδιαστασιολόγηση</span>
				<input type="text" class="form-control" id="calctherm_ng1_diastasi"  disabled="disabled"/>
				<span class="input-group-addon">%</span>
			</div>
		</td>
		<td>
			<input type="text" class="form-control" id="calctherm_ng1" disabled="disabled" />
		</td>
	</tr>

	<tr bgcolor="#f9b3a6">
		<td>
			n<sub>g2</sub>
		</td>
		<td>
			Πίνακας 4.4 - ΤΟΤΕΕ-20701-1
			<div class="input-group">
			<span class="input-group-addon">Μόνωση λέβητα</span>
			<select class="form-control" id="calctherm_insulation" onchange=get_thermp_ng(); >
				<option value=1>Καλή</option>
				<option value=2>Μέτρια</option>
				<option value=3>Κακή</option>
			</select>
			</div>
			<div class="input-group">
				<span class="input-group-addon">α</span>
				<input type="text" class="form-control" id="calctherm_ng2_a"  disabled="disabled"/>
			</div>
			<div class="input-group">
				<span class="input-group-addon">β</span>
				<input type="text" class="form-control" id="calctherm_ng2_b"  disabled="disabled"/>
			</div>
		</td>
		<td>
			<input type="text" class="form-control" id="calctherm_ng2" disabled="disabled" />
		</td>
	</tr>

	<tr>
	<th>n<sub>gen</sub></th>
	<td>n<sub>gen</sub> = n<sub>sΚΘ</sub> × ng<sub>1</sub> × ng<sub>2</sub></td>
	<td><input class="form-control" type="text" id="calctherm_ngen" disabled="disabled" /></td>
	</tr>
</table>

<span id="production_bar">


<script>
function calc_smthd(){
	var nsthd = document.getElementById("calctherm_nsthd_type").value;
	document.getElementById("calctherm_nsthd").value = nsthd;
	get_thermp_ng();
}

function calc_pgen_v(){
	var airperm2 = document.getElementById("calctherm_pgen_zonexrisi").value;
	var e = document.getElementById("calctherm_pgen_zonee").value;
	var v=airperm2*e;
	document.getElementById("calctherm_pgen_v").value = number_format(v,4);
	calc_pgen();
}

function calc_pgen_um(){
	var periodos = document.getElementById("calctherm_pgen_periodos").value;
	var zone = document.getElementById("calctherm_pgen_zone").value;
	var um;
	var um_kthk=[0,1.55,1.20,0.95,0.95];
	
	if(periodos==0){
			um=0;
	}
	if(periodos==1){
			um=3.5;
	}
	if(periodos==2){
		um = um_kthk[zone];
	}
	if(periodos==3){
		um=0;
	}
	document.getElementById("calctherm_pgen_um").value = um;
	calc_pgen();
}

function calc_pgen_dt(){
	var zone = document.getElementById("calctherm_pgen_zone").value;
	var dt=[0,18,20,23,28];

	document.getElementById("calctherm_pgen_dt").value = dt[zone];
	calc_pgen();
}
function calc_pgen(){
	var a = document.getElementById("calctherm_pgen_a").value;
	var um = document.getElementById("calctherm_pgen_um").value;
	var v = document.getElementById("calctherm_pgen_v").value;
	var dt = document.getElementById("calctherm_pgen_dt").value;
	var pgen=((a*um*1.5)+v/3)*dt;
	document.getElementById("calctherm_pgen").value =  pgen/1000;
	 get_thermp_ng();
}

function get_thermp_ng(){
	var nsath = document.getElementById("calctherm_nsath").value*1;
	var nsthd = document.getElementById("calctherm_nsthd").value;
	var pgen = document.getElementById('calctherm_pgen').value;
	var pn = document.getElementById('calctherm_pn').value;
	var boilertype = document.getElementById('calctherm_ngm1').value;
	var nmg2 = document.getElementById('calctherm_ngm2').value;
	var instype = document.getElementById('calctherm_insulation').value;

	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	var x = "includes/functions_calc.php?thermp_ng=1&pgen="+pgen+"&pn="+pn+"&boilertype="+boilertype+"&instype="+instype;
	x+="&nsath="+nsath+"&nsthd="+nsthd+"&nmg2="+nmg2;
	xmlhttp.open("GET", x ,true);
	xmlhttp.send();

	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		
		var arr = JSON.parse(xmlhttp.responseText);
		
		if(nsthd!=0){//Έχει δηλωθεί τιμή για καινούργιο λέβητα με Ε.Κ.
			nskth =nsthd*(nsath+0.03);
			document.getElementById("calctherm_ngm").value = "";
			document.getElementById("calctherm_ngo").value = "";
			document.getElementById("calctherm_info").innerHTML = "Υπολογίστηκε ως ΣΜΘΔ x (n<sub>sΑΘ</sub>+ 3%) με βάση Ε.Κ. (Έχετε επιλέξει τιμή στο ΣΜΘΔ)";
			document.getElementById("calctherm_nskth").value = number_format(nskth,4);
		}else{
			if(nmg2!="" && nmg2!=0){//Έχει δηλωθεί τιμή από φύλλο ελέγχου
				document.getElementById("calctherm_info").innerHTML = "Υπολογίστηκε ως n<sub>go</sub> x n<sub>gm</sub> για λέβητα με φύλλο με ngm="+nmg2+" (Έχετε εισάγει τιμή στο ngm φύλλου)";
				document.getElementById("calctherm_ngm").value=document.getElementById("calctherm_ngm2").value;
			}else{//δεν έχει δηλωθεί τιμή από φύλλο ελέγχου
				document.getElementById("calctherm_info").innerHTML = "Υπολογίστηκε ως n<sub>go</sub> x n<sub>gm</sub> για λέβητα χωρίς στοιχεία και ngm="+arr[0]+" από πίνακα 4.2β.";
				document.getElementById("calctherm_ngm").value=arr[0];
			}
			document.getElementById("calctherm_ngo").value=arr[1];
			document.getElementById("calctherm_nskth").value=document.getElementById("calctherm_ngm").value*arr[1];
		}
		
		//Τιμές από την υπερδιαστασιολόγηση ng1
		document.getElementById("calctherm_ng1_diastasi").value=arr[2]*100;
		document.getElementById("calctherm_ng1").value=arr[3];
		document.getElementById("calctherm_ng1info").innerHTML=arr[7];
		//Τιμές από κατάσταση μόνωσης ng2
		document.getElementById("calctherm_ng2_a").value=arr[4];
		document.getElementById("calctherm_ng2_b").value=arr[5];
		document.getElementById("calctherm_ng2").value=arr[6];
		calc_ngen();
	}}
}

function calc_ngen(){
	var pn = document.getElementById("calctherm_pn").value;
	var nskth = document.getElementById("calctherm_nskth").value;
	var ng1 = document.getElementById("calctherm_ng1").value;
	var ng2 = document.getElementById("calctherm_ng2").value;
	var ngen = nskth*ng1*ng2;
	var ngen100 = number_format(ngen*100,3);
	var pn100 = number_format(pn*ngen,3);
	var result ="Η μονάδα παραγωγής μπορεί να αποδώσει σε ιδανικές συνθήκες το "+ngen100+"% της ονομαστικής ισχύος ("+pn+"KW) δηλαδή: "+pn100+"KW.<br/>";
		if(ngen100<=96){
		result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-danger\" style=\"width: "+ngen100+"%;\">"+ngen100+"%</div></div>";
		}else{
		result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-danger\" style=\"width: "+ngen100+"%;\"></div></div>";
		}


	document.getElementById("calctherm_ngen").value = number_format(ngen,4);
	document.getElementById("production_bar").innerHTML = result;
}
</script>
			</div>
			<!--ΛΕΒΗΤΑΣ - ΚΑΥΣΤΗΡΑΣ-->
			
			<!--ΑΝΤΛΙΕΣ ΘΕΡΜΟΤΗΤΑΣ-->
			<div class="tab-pane" id="tabs-2">
<table class="table table-bordered">
	<tr class="danger">
	<td colspan="3">Βαθμός επίδοσης (COP) αντλιών θερμότητας</td>
	</tr>

	<tr>
	<th colspan="2">Με βάση τα χαρακτηριστικά</th>
	<th>SCOP ΕΛΟΤ ΕΝ 15316.4.2:2008</th>
	</tr>
	<tr>
	<td>Πηγή θερμότητας:</td>
	<td>
	<select class="form-control" id="therm_cop1_type" onchange=therm_cop1t(); >
	<option value=0>Επιλέξτε...</option>
	<option value=1>Εξωτερικός αέρας</option>
	<option value=2>Έδαφος</option>
	<option value=3>Θερμότητα από καυσαέρια (πχ ΣΗΘ)</option>
	<option value=4>Υπόγειο ή θαλασσινό νερό</option>
	<option value=5>Επιφανειακά νερά</option>
	</select>
	</td>
	<td rowspan="3">
	<input class="form-control" type="text" id="therm_cop1" disabled="disabled" />
	</td>
	</tr>
	<tr>
	<td>Χρήση:</td>
	<td>
	<select class="form-control" id="therm_cop1_xrisi" onchange=therm_cop1t();>
	<option value=0>Επιλέξτε...</option>
	<option value=1>Κτήρια κατοικιών</option>
	<option value=2>Κτήρια τριτογενούς τομέα</option>
	</select>
	</td>
	</tr>
	<tr>
	<td>Θερμοκρασίες θερμικού μέσου:</td>
	<td>
	<select class="form-control" id="therm_cop1_t" onchange=therm_cop1(); >
	<option value=0>Επιλέξτε...</option>
	</select>
	</td>
	</tr>
	
	<tr>
		<th colspan="2">Εάν τηρεί τον κανονισμό Ενεργειακής Επισήμανσης της ΕΕ</th>
		<th>SCOP</th>
	</tr>
	<tr>
		<td>Αερόψυκτη αντλία ΕΕ 626/2011</td>
		<td>
			<div class="input-group">
				<span class="input-group-addon">SCOP<sub>ΕΣ</sub></span>
				<input class="form-control" type="text" id="therm_cop2type"  onkeyup=therm_cop2(); />
			</div>
		</td>
		<td>
			<div class="input-group">
				<span class="input-group-addon">SCOP=0.93 x SCOP<sub>ΕΣ</sub></span>
				<input class="form-control" type="text" id="therm_cop2" disabled="disabled" />
			</div>
		</td>
	</tr>
	<tr>
		<td>Υδρόψυκτη αντλία ΕΕ 811/2011</td>
		<td>
			<div class="input-group">
				<span class="input-group-addon">Τύπος</span>
				<select class="form-control" id="therm_cop2watertype" onchange=therm_cop2water();>
					<option value=0>Επιλέξτε...</option>
					<option value=2.35>Ενδοδαπέδια, ενδοτοίχια, οροφής</option>
					<option value=2.55>Στοιχεία νερού με ανεμιστήρα FCU</option>
					<option value=2.75>Θερμαντικά σώματα, κονβέκτορες</option>
				</select>
			</div>
			<div class="input-group">
				<span class="input-group-addon">η<sub>s35<sup>o</sup>CΘΚ</sub> ή n<sub>s55<sup>o</sup>CΘΚ</sub></span>
				<input class="form-control" type="text" id="therm_cop2waterns"  onkeyup=therm_cop2water(); />
			</div>
		</td>
		<td>
			<div class="input-group">
				<span class="input-group-addon">SCOP=Α x (η<sub>s</sub> +3%)</span>
				<input class="form-control" type="text" id="therm_cop2water" disabled="disabled" />
			</div>
			<div class="input-group">
				<span class="input-group-addon">Όπου Α=</span>
				<input class="form-control" type="text" id="therm_cop2watera" disabled="disabled" />
			</div>
		</td>
	</tr>
	
	<tr>
	<th colspan="2">Αν δεν είναι γνωστά τα χαρακτηριστικά</th>
	<th>SCOP</th>
	</tr>

	<tr>
		<td>Τύπος:</td>
		<td>
		<select class="form-control" id="therm_cop3type" onchange=therm_cop3(); >
		<option value=0>Επιλέξτε...</option>
		<option value=1>Αερόψυκτη αντλία</option>
		<option value=2>Υδρόψυκτη αντία</option>
		</select>
		</td>
		<td rowspan="2">
		<input class="form-control" type="text" id="therm_cop3" disabled="disabled" />
		</td>
	</tr>
	<tr>
		<td>Χρόνος εγκατάστασης:</td>
		<td>
		<select class="form-control" id="therm_cop3year" onchange=therm_cop3(); >
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
	<th>COP</th>
	</tr>

	<tr>
	<td>Αποδιδόμενη ισχύς (θέρμανσης):</td>
	<td>
	<form class="form-horizontal" role="form">
		<div class="form-group">
			<label class="control-label col-sm-3" for="therm_cop4_out">KW</label>
			<div class="col-sm-9">
			<input class="form-control" type="text" id="therm_cop4_out" onkeyup=therm_kcal() />
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="therm_cop4_kcal">Kcal</label>
			<div class="col-sm-9">
			<input class="form-control" type="text" id="therm_cop4_kcal" onkeyup=therm_kw() />
			</div>
		</div>
	</form>
	</td>
	<td rowspan="2">
	<input class="form-control" type="text" id="therm_cop4" disabled="disabled" />
	</td>
	</tr>

	<tr>
	<td>Καταναλισκόμενη ισχύς (ηλεκτρική):</td>
	<td>
	<form class="form-horizontal" role="form">
		<div class="form-group">
			<label class="control-label col-sm-3" for="therm_cop4_in">KW</label>
			<div class="col-sm-9">
			<input class="form-control" type="text" id="therm_cop4_in" onkeyup=therm_cop4() />
			</div>
		</div>
	</form>
	</td>
	</tr>

</table>
<br/>
<blockquote>
	<small>
		<ul>
			<li>
				Για τις αντλίες θερμότητας <font color="red">με θερμαινόμενο μέσο τον αέρα</font> οι οποίες δεν συνοδεύονται από 
				Ενεργειακή Σήμανση λαμβάνεται υπόψη ο Συντελεστής Απόδοσης Θέρμανσης της μονάδας 
				COP για εξωτερική θερμοκρασία <font color="red">7<sup>ο</sup>C</font> και εσωτερική θερμοκρασία <font color="red">20<sup>ο</sup>C</font>.
			</li>
			<li>
				Για τις αντλίες θερμότητας <font color="red">με θερμαινόμενο μέσο το νερό</font> οι οποίες δεν συνοδεύονται από Ενεργειακή Σήμανση 
				λαμβάνεται κατά τη μελέτη ή την επιθεώρηση ως τελική θερμική απόδοση ο ονομαστικός συντελεστής απόδοσης COP για 
				ονομαστικές συνθήκες λειτουργίας θερμοκρασίας εξωτερικού αέρα <font color="red">7<sup>ο</sup>C</font> και θερμοκρασία μέσου <font color="red">45<sup>ο</sup>C</font> σύμφωνα με το 
				ευρωπαϊκό πρότυπο ΕΝ 14511:2007
			</li>
			<li>
				Στην περίπτωση <font color="red">γεωθερμικών αντλιών θερμότητας</font>, ως συντελεστής απόδοσης COP λαμβάνεται κατά τους 
				υπολογισμούς η τιμή που αναφέρεται σε συνθήκες λειτουργίας για θερμοκρασία γεωεναλλάκτη <font color="red">15<sup>ο</sup>C</font> και 
				θερμοκρασία μέσου <font color="red">45<sup>ο</sup>C</font>.
			</li>
		</ul>
	</small>
</blockquote>
<blockquote>
	<small>
		Αναζήτηση ενεργειακής σήμανσης για αντλίες Daikin <i class="fa fa-3x fa-snowflake-o" aria-hidden="true" onclick=newPopup("http://gr.intpre.daikineurope.com/energylabel/")></i>
	</small>
<blockquote>
<script>
function therm_cop1t(){
var type = document.getElementById('therm_cop1_type').value;
var xrisi = document.getElementById('therm_cop1_xrisi').value;
var x;

	if(type==0){
	x="<option value=0>Επιλέξτε πρώτα πηγή θερμότητας...</option>";
	}
	if(type==1){
		if(xrisi==1){
		x="<option value=3.7>Τ<35<sup>o</sup>C</option>";
		x+="<option value=3.3>35<sup>o</sup>C<Τ<45<sup>o</sup>C</option>";
		}
		if(xrisi==2){
		x="<option value=3.4>Τ<35<sup>o</sup>C</option>";
		x+="<option value=3.1>35<sup>o</sup>C<Τ<45<sup>o</sup>C</option>";
		x+="<option value=2.8>45<sup>o</sup>C<Τ<55<sup>o</sup>C</option>";
		}
	}
	if(type==2){
		if(xrisi==1){
		x="<option value=3.8>Τ<35<sup>o</sup>C</option>";
		x+="<option value=3.4>35<sup>o</sup>C<Τ<45<sup>o</sup>C</option>";
		}
		if(xrisi==2){
		x="<option value=5.5>Τ<35<sup>o</sup>C</option>";
		x+="<option value=5.1>35<sup>o</sup>C<Τ<45<sup>o</sup>C</option>";
		x+="<option value=4.7>45<sup>o</sup>C<Τ<55<sup>o</sup>C</option>";
		}
	}
	if(type==3){
		if(xrisi==1){
		x="<option value=0></option>";
		}
		if(xrisi==2){
		x="<option value=6.1>Τ<35<sup>o</sup>C</option>";
		x+="<option value=5.1>35<sup>o</sup>C<Τ<45<sup>o</sup>C</option>";
		x+="<option value=4.4>45<sup>o</sup>C<Τ<55<sup>o</sup>C</option>";
		}
	}
	if(type==4){
		if(xrisi==1){
		x="<option value=4.5>Τ<35<sup>o</sup>C</option>";
		x+="<option value=4.1>35<sup>o</sup>C<Τ<45<sup>o</sup>C</option>";
		}
		if(xrisi==2){
		x="<option value=4.7>Τ<35<sup>o</sup>C</option>";
		x+="<option value=4.2>35<sup>o</sup>C<Τ<45<sup>o</sup>C</option>";
		x+="<option value=3.6>45<sup>o</sup>C<Τ<55<sup>o</sup>C</option>";
		}
	}
	if(type==5){
		if(xrisi==1){
		x="<option value=0></option>";
		}
		if(xrisi==2){
		x="<option value=4.1>Τ<35<sup>o</sup>C</option>";
		x+="<option value=3.7>35<sup>o</sup>C<Τ<45<sup>o</sup>C</option>";
		x+="<option value=3.3>45<sup>o</sup>C<Τ<55<sup>o</sup>C</option>";
		}
	}

	document.getElementById('therm_cop1_t').innerHTML = x;
	therm_cop1();
}

function therm_cop1(){
var x = document.getElementById('therm_cop1_t').value;
document.getElementById('therm_cop1').value =x;
}

function therm_cop2(){
var x = document.getElementById('therm_cop2type').value;
document.getElementById('therm_cop2').value =x*0.93;
}

function therm_cop2water(){
var x = document.getElementById('therm_cop2watertype').value;
var cop2ns = document.getElementById('therm_cop2waterns').value*1;
document.getElementById('therm_cop2water').value =x*(cop2ns+0.03);
document.getElementById('therm_cop2watera').value =x;
}

function therm_cop3(){
var type = document.getElementById('therm_cop3type').value;
var year = document.getElementById('therm_cop3year').value;
var x;
var air_pump=[0,1.7,1.7,2.2,2.5];
var water_pump=[0,2.2,2.2,2.7,3.0];
if(type==1){x=air_pump[year];}
if(type==2){x=water_pump[year];}
document.getElementById('therm_cop3').value =x;
}

function therm_cop4(){
var kw_out = document.getElementById('therm_cop4_out').value;
var kw_in = document.getElementById('therm_cop4_in').value;
var cop4;
	if(kw_in!=0 && kw_out!=0){
	cop4 = kw_out / kw_in;
	}else{
	cop4 = 0;
	}
document.getElementById('therm_cop4').value = number_format(cop4,3);
}
function therm_kcal(){
var kw_out = document.getElementById('therm_cop4_out').value;
var kcal = kw_out*859.845227859;
document.getElementById('therm_cop4_kcal').value = number_format(kcal,1,".","");
therm_cop4();
}
function therm_kw(){
var kcal_out = document.getElementById('therm_cop4_kcal').value;
var kw = kcal_out*0.001163;
document.getElementById('therm_cop4_out').value = number_format(kw,3,".","");
therm_cop4();
}
</script>
			</div>
			<!--ΑΝΤΛΙΕΣ ΘΕΡΜΟΤΗΤΑΣ-->
			
			<!--ΑΛΛΕΣ ΜΟΝΑΔΕΣ-->
			<div class="tab-pane" id="tabs-3">
<table class="table table-bordered">
	<tr class="danger">
	<td colspan="3">Βαθμός απόδοσης άλλων μονάδων</td>
	</tr>

	<tr>
	<th>Μονάδα παραγωγής</th>
	<th>Τύπος</th>
	<th>Βαθμ. απόδοσης</th>
	</tr>

	<tr>
	<td>
	<select class="form-control" id="therm_alli" onchange="therm_other();therm_other_ngen();" >
	<option value=0>Επιλέξτε...</option>
	<option value=1>Ηλεκτρικές μονάδες</option>
	<option value=2>Μονάδες τηλεθέρμανσης ή σε σύνδεση με ΣΗΘ</option>
	<option value=3>Τοπικές μονάδες αερίων ή υγρών καυσίμων</option>
	<option value=4>Ανοικτές εστίες καύσης</option>
	</select>
	</td>
	<td>
	<select class="form-control" id="therm_alli_type" onchange=therm_other_ngen(); >
	<option value=0>Επιλέξτε...</option>
	</select>
	</td>
	<td>
	<input class="form-control" type="text" id="therm_alli_ngen" disabled="disabled" />
	</td>
	</tr>

</table>
<br/>
<blockquote>
<small>
	Όπου:
	<ul>
	<li>Ηλεκτρικές μονάδες:ηλεκτρικά σώματα άμεσης απόδοσης, θερμοπομποί, μονάδες επαγωγής, ηλεκτρικοί θερμοσυσσωρευτές</li>
	<li>Τοπικές μονάδες αερίων ή υγρών καυσίμων: θερμάστρες υγραερίου, φυσικού αερίου, πετρελαίου κλπ</li>
	<li>Ανοιχτές εστίες καύσης: Σόμπες, τζάκια (Συνήθως μια εστία καύσης έχει τη δυνατότητα κάλυψης του θερμικού φορτίου ενός χώρου 30 m<sup>2</sup>.)</li>
	</small>
</blockquote>

<script>
function therm_other(){
var alli = document.getElementById('therm_alli').value;
var x;
var y;

	if(alli==0){
	x="<option value=0>Επιλέξτε μονάδα παραγωγής...</option>";
	}
	if(alli==1){
	x="<option value=1>Καλοσυντηρημένες μονάδες με μόνωση</option>";
	x+="<option value=0.95>Κακοσυντηρημένες μονάδες χωρίς μόνωση</option>";
	}
	if(alli==2){
	x="<option value=\"Ονομαστική απόδοση εναλλάκτη\">Με εναλλάκτη σε καλή κατάσταση</option>";
	x+="<option value=\"Ονομαστική απόδοση εναλλάκτη-10%\">Κακοσυντηρημένες μονάδες χωρίς μόνωση</option>";
	}
	if(alli==3){
	x="<option value=1>Χωρίς καπνοδόχο</option>";
	x+="<option value=0.7>Με καπνοδόχο</option>";
	}
	if(alli==4){
	x="<option value=0.25>Τζάκια</option>";
	x+="<option value=0.5>Ενεργειακά τζάκια, σόμπες</option>";
	}

	document.getElementById('therm_alli_type').innerHTML = x;
}

function therm_other_ngen(){
var x = document.getElementById('therm_alli_type').value;
document.getElementById('therm_alli_ngen').value =x;
}
</script>
			</div>
			<!--ΑΛΛΕΣ ΜΟΝΑΔΕΣ-->
			
			<!--Δίκτυο διανομής-->
			<div class="tab-pane" id="tabs-4">
<table class="table table-bordered">
	<tr class="danger">
	<td colspan="2">Βαθμός απόδοσης δικτύου διανομής</td>
	</tr>

	<tr>
	<th>Παράμετρος</th>
	<th>Τιμή</th>
	</tr>

	<tr>
	<td>Θερμική ή ψυκτική ισχύς του δικτύου διανομής</td>
	<td>
	<input class="form-control" type="text" id="dianomi_p" onkeyup=get_dianomi_n(); />
	</td>
	</tr>

	<tr>
	<td>Θερμοκρασία προσαγωγής θερμού μέσου</td>
	<td>
	<select class="form-control" id="dianomi_t" onchange=get_dianomi_n(); >
	<option value=0>Επιλέξτε...</option>
	<option value=1>Υψηλές Τ>60<sup>o</sup>C</option>
	<option value=2>Χαμηλές Τ<60<sup>o</sup>C</option>
	</select>
	</td>
	</tr>

	<tr>
	<td>Διέλευση</td>
	<td>
	<select class="form-control" id="dianomi_dieleysi" onchange=get_dianomi_n(); >
	<option value=0>Επιλέξτε...</option>
	<option value=1>Διέλευση σε εσωτερικούς χώρους ή/και 20% σε εξωτερικούς χώρους</option>
	<option value=2>Διέλευση > 20% σε εξωτερικούς χώρους</option>
	</select>
	</td>
	</tr>

	<tr>
	<td>Μόνωση</td>
	<td>
	<select class="form-control" id="dianomi_monwsi" onchange=get_dianomi_n(); >
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
		<input type="checkbox" id="dianomi_ducts" onchange=get_dianomi_n();>
		Αεραγωγοί
		</label>
		</div>
	</td>
	</tr>

	<tr>
	<th>Βαθμός απόδοσης Δικτύου διανομής</th>
	<td>
	<input class="form-control" type="text" id="dianomi_n" disabled="disabled" onchange=get_dianomi_n(); />
	</td>
	</tr>

</table>

	<span id="distribution_bar"></span>
<br/>
<blockquote>
	<small>
	<ul>
	<li>
	Σε περίπτωση ύπαρξης άνω του ενός δικτύων διανομής στο κτήριο ή στη θερμική ζώνη, απαιτείται ο προσδιορισμός μίας μόνο απόδοσης δικτύου,
	η οποία θα είναι σταθμισμένη. Κατά συνέπεια αν υπάρχουν άνω του ενός δίκτυα διανομής (που τροφοδοτούνται από διαφορετικές μονάδες παραγωγής)
	στο κτήριο ή στη θερμική ζώνη και παρουσιάζουν διαφορετική ποιότητα και επάρκεια (ποσότητα) θερμομόνωσης, τότε η απόδοσή τους λαμβάνεται
	ενιαία και ίση με αυτήν του τμήματος που βρίσκεται στη χειρότερη ποιοτικά κατάσταση.
	</li>
	<li>
	Για αεραγωγούς που διέρχονται από εξωτερικούς χώρους και είναι μονωμένοι σύμφωνα 
	με τις ελάχιστες απαιτήσεις του Κ.Εν.Α.Κ., που αναφέρονται στην παράγραφο 4.3.1, τα ποσοστά 
	απωλειών του πίνακα 4.11. λαμβάνονται αυξημένα κατά 2% για θέρμανση και 1% για ψύξη, κατά 
	περίπτωση. Για αεραγωγούς χωρίς ή με ανεπαρκή μόνωση (δηλαδή όταν δεν πληρούνται οι ελάχιστες 
	απαιτήσεις), τα ποσοστά θερμικών απωλειών του πίνακα 4.11. λαμβάνονται αυξημένα κατά 5% για 
	θέρμανση και 3,5% για ψύξη, κατά περίπτωση
	</li>
	</ul>
	</small>
</blockquote>

<script>
function get_dianomi_n(){
	var dianomi_p = document.getElementById('dianomi_p').value;
	var dianomi_t = document.getElementById('dianomi_t').value;
	var dianomi_dieleysi = document.getElementById('dianomi_dieleysi').value;
	var dianomi_monwsi = document.getElementById('dianomi_monwsi').value;
	var dianomi_ducts = document.getElementById('dianomi_ducts');
	var ducts;

	//AJAX call
	var xmlhttp=new XMLHttpRequest();

	xmlhttp.open("GET","includes/functions_calc.php?dianomi_p="+dianomi_p+"&dianomi_t="+dianomi_t+"&dianomi_dieleysi="+dianomi_dieleysi+"&dianomi_monwsi="+dianomi_monwsi ,true);
	xmlhttp.send();

	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		var n = xmlhttp.responseText;
		if(dianomi_ducts.checked){
			if(dianomi_monwsi==1){
				ducts=0.98;
			}else{
				ducts=0.95;
			}
		}else{
			ducts=1;
		}
		n=n*ducts;
		var n100 = number_format(n*100,2);
		var pn = number_format(dianomi_p*n,3);
		document.getElementById("dianomi_n").value=number_format(n,3);
		var result ="Το δίκτυο διανομής αποδίδει στις τερματικές μονάδες το "+n100+"% της ονομαστικής ισχύος ("+dianomi_p+"KW) δηλαδή: "+pn+"KW.<br/>";
		if(n100<=96){
		result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-danger\" style=\"width: "+n100+"%;\">"+n100+"%</div></div>";
		}else{
		result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-danger\" style=\"width: "+n100+"%;\"></div></div>";
		}
		document.getElementById("distribution_bar").innerHTML = result;
	}}
}
</script>
			</div>
			<!--Δίκτυο διανομής-->


			<!--Τερματικές μονάδες-->
			<div class="tab-pane" id="tabs-5">


<table class="table table-bordered">
	<tr class="danger">
	<td colspan="4">Βαθμός απόδοσης τερματικών μονάδων</td>
	</tr>

	<tr>
	<th class="span5">Παράμετρος</th>
	<th colspan="2">Υπολογισμός</th>
	<th>Τιμή</th>
	</tr>

	<tr>
		<td rowspan="3">
		n<sub>em</sub><br/>
		(Aπόδοση εκπομπής)
		</td>
		<td>
		Τύπος τερματικής μονάδας:
		</td>
		<td>
		<select class="form-control" id="type_nem" onchange=calc_nem(); >
		<option value=0>Επιλέξτε...</option>
		<option value=1>Άμεσης απόδοσης σε εσωτερικό τοίχο</option>
		<option value=2>Άμεσης απόδοσης σε εξωτερικό τοίχο</option>
		<option value=3>Ενδοδαπέδιο σύστημα θέρμανσης</option>
		<option value=4>Ενδοτοίχιο σύστημα θέρμανσης</option>
		<option value=5>Σύστημα θέρμανσης οροφής</option>
		<option value=6>Τοπικές ηλεκτρικές μονάδες σε εσωτερικό τοίχο</option>
		<option value=7>Τοπικές ηλεκτρικές μονάδες σε εξωτερικό τοίχο</option>
		</select>
		</td>
		<td rowspan="3"><input class="form-control" type="text" id="nem" disabled="disabled" /></td>
	</tr>

	<tr>
		<td>
		T (Θερμοκρασία μέσου <sup>o</sup>C):
		</td>
		<td>
		<select class="form-control" id="type_t" onchange=calc_type_t(); >
		<option value=0>Επιλέξτε τύπο τερματικής...</option>
		</select>
		</td>
	</tr>
	
	<tr>
	<td>Κακοσυντηρημένες μονάδες</td>
	<td>
		<div class="checkbox">
		<label>
		<input type="checkbox" id="type_t_fault" onchange=calc_type_t();>
		κατεστραμμένα τμήματα, διαβρώσεις, διαρροές κ.ά.
		</label>
		</div>
	</td>
	</tr>


	<tr>
	<td>
	f<sub>rad</sub><br/>
	(Παράγοντας για την αποτελεσματικότητα της ακτινοβολίας)
	</td>
	<td colspan="2">
	<select class="form-control" id="type_frad" onchange=calc_frad(); >
	<option value=0>Επιλέξτε...</option>
	<option value=1>Χώρος με ύψος μικρότερο από 4 m</option>
	<option value=0.95>Χώρος με ύψος ίσο ή μεγαλύτερο από 4 m</option>
	<option value=1>Με ανακυκλοφορία αέρα για μεγάλα ύψη χώρων</option>
	</select>
	</td>
	<td><input class="form-control" type="text" id="frad" disabled="disabled" /></td>
	</tr>

	<tr>
	<td>
	f<sub>im</sub><br/>
	(Παράγοντας της διακοπτόμενης λειτουργίας)
	</td>
	<td colspan="2">
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
	<td colspan="2">
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
	<td colspan="2">
	ΕΛΟΤ ΕΝ 15316.2.1:2008 :
	n<sub>em,t</sub>=n<sub>em</sub>/(f<sub>rad</sub>×f<sub>im</sub>×f<sub>hydr</sub>)
	</td>
	<td><input class="form-control" type="text" id="nemt" disabled="disabled" /></td>
	</tr>

</table>

<span id="termatikes_bar"></span>
<br/>

<blockquote>
	<small>
	<ul>
	<li>
		Όταν σε ένα κτήριο ή σε μια θερμική ζώνη υπάρχουν περισσότεροι του ενός τύποι τερματικών μονάδων, τότε η συνολική απόδοση εκπομπής λαμβάνεται ως μια μέση
		σταθμισμένη τιμή, ανάλογα με την απόδοση της κάθε τερματικής μονάδας και του ποσοστού συμμετοχής της στο σύνολο του καλυπτόμενου φορτίου (από το σύνολο των
		τερματικών μονάδων). Σε περίπτωση προφανών βλαβών και κακοσυντήρησης των τερματικών μονάδων (κατεστραμμένα τμήματα, διαβρώσεις, διαρροές κ.ά.), η απόδοση
		των τερματικών μονάδων εκπομπής λαμβάνεται μειωμένη κατά 10%.
	</li>
	<li>
		Οι θερμάστρες αερίου ή πετρελαίου και τα τυποποιημένα--πιστοποιημένα ενεργειακά τζάκια ή τα κοινά τζάκια ή οι σόμπες θεωρούνται άμεσης απόδοσης σε θερμοκρασία 
		λειτουργίας (90 - 70oC) και για τους υπολογισμούς λαμβάνονται οι αποδόσεις εκπομπής του πίνακα 4.12.
	</li>
	<li>
		Για τις τοπικές αντλίες θερμότητας η απόδοση εκπομπής των εσωτερικών μονάδων στους υπολογισμούς λαμβάνεται ίση προς 93% (0.93).
	</li>
	</ul>
	</small>
</blockquote>

<script>
// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=600,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes')
}

function calc_nem(){
var type_nem = document.getElementById('type_nem').value;
var x;
var y;

	if(type_nem==0){
	x="<option value=0>Επιλέξτε τύπο τερματικής...</option>";
	}
	if(type_nem==1){
	x="<option value=0.85>90-70</option>";
	x+="<option value=0.89>70-50</option>";
	x+="<option value=0.91>50-35</option>";
	}
	if(type_nem==2){
	x="<option value=0.89>90-70</option>";
	x+="<option value=0.93>70-50</option>";
	x+="<option value=0.95>50-35</option>";
	}
	if(type_nem==3){
	x+="<option value=0.90>50-35</option>";
	}
	if(type_nem==4){
	x+="<option value=0.87>50-35</option>";
	}
	if(type_nem==5){
	x+="<option value=0.85>50-35</option>";
	}
	if(type_nem==6){
	x+="<option value=0.91>Ανεξάρτητο Τ</option>";
	}
	if(type_nem==7){
	x+="<option value=0.94>Ανεξάρτητο Τ</option>";
	}

	document.getElementById('type_t').innerHTML = x;
	calc_type_t();
	calc_nemt();
}

function calc_type_t(){
var x = document.getElementById('type_t').value;
var fault = document.getElementById('type_t_fault');
if(fault.checked){x=x*0.90;}
document.getElementById('nem').value =number_format(x,3);
calc_nemt();
}

function calc_frad(){
var x = document.getElementById('type_frad').value;
document.getElementById('frad').value =x;
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
var frad = document.getElementById('frad').value;
var fim = document.getElementById('fim').value;
var fhydr = document.getElementById('fhydr').value;
var nemt = number_format(nem/(frad*fim*fhydr),3);
var nemt100 = nemt*100;

	document.getElementById('nemt').value =nemt;

	var result ="Οι τερματικές μονάδες αποδίδουν στο χώρο το "+nemt100+"% της ισχύος του δικτύου διανομής<br/>";
	if(nemt100<=96){
	result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-danger\" style=\"width: "+nemt100+"%;\">"+nemt100+"%</div></div>";
	}else{
	result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-danger\" style=\"width: "+nemt100+"%;\"></div></div>";
	}
	document.getElementById("termatikes_bar").innerHTML=result;


}
</script>
			</div>
			<!--Τερματικές μονάδες-->

			<!--Πίνακες ΤΟΤΕΕ-->
			<div class="tab-pane" id="tabs-6">
				<?php
				include("accordions_therm.php");
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