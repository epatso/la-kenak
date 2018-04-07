<?php
/*
Copyright (C) 2012 - Labros KENAK v.4.0 
Author: Labros Karoyntzos 

Labros KENAK v.4.0 from Labros Karountzos is free software: 
you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, version 3 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License version 3
along with this program.  If not, see http://www.gnu.org/licenses/gpl-3.0.html.

Το παρόν με την ονομασία Labros KENAK v.4.0. με δημιουργό τον Λάμπρο Καρούντζο
στοιχεία επικοινωνίας info@chem-lab.gr www.chem-lab.gr
είναι δωρεάν λογισμικό. Μπορείτε να το τροποποιήσετε και επαναδιανείμετε υπό τους
όρους της άδειας GNU General Public License όπως δίδεται από το Free Software Foundation
στην έκδοση 3 αυτής της άδειας.
Το παρόν σχόλιο πρέπει να παραμένει ως έχει ώστε να τηρείται η παραπάνω άδεια κατά τη διανομή.
*/
require("include_check.php");
confirm_logged_in();
?>

			<br/>
			<div id="thermp_table"></div>
			<div id="thermp_info"></div>
			<script>
			get_thermp();
			
			//Εμφάνιση πίνακα με όλες τις μονάδες παραγωγής του χρήστη
			function get_thermp(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getthermp=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("thermp_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function thermp_getzones(zone_id){
			var prefix = "editthermp_";
			
			//Εμφάνιση select ανάλογα με τον τύπο (ΖΩΝΕΣ η ΜΘΧ). Εδώ ενδιαφέρουν οι ζώνες
			var link1 = "includes/functions_meleti_general.php?getavailablezones=1&type="+0;
			var xmlhttp1=new XMLHttpRequest();
			xmlhttp1.open("GET",link1 ,true);
			xmlhttp1.send();
			xmlhttp1.onreadystatechange=function()  {
			if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
				document.getElementById(prefix+"zone_id").innerHTML = xmlhttp1.responseText;
				if(zone_id!=0){
				document.getElementById(prefix+"zone_id").value = zone_id;
				}
			}}
			}
			
			
			//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές ΘΕΡΜΟΓΕΦΥΡΑΣ
			function form_thermp(id){
			var prefix = "editthermp_";

				if(id==0){
				thermp_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"type").selectedIndex = 0;
				thermp_changetype();
				document.getElementById(prefix+"pigi").selectedIndex = 0;
				document.getElementById(prefix+"w").value = "";
				document.getElementById(prefix+"n").value = "";
				document.getElementById(prefix+"cop").value = "";
				document.getElementById(prefix+"jan").value = 1;
				document.getElementById(prefix+"feb").value = 1;
				document.getElementById(prefix+"mar").value = 1;
				document.getElementById(prefix+"apr").value = 1;
				document.getElementById(prefix+"may").value = 1;
				document.getElementById(prefix+"jun").value = 1;
				document.getElementById(prefix+"jul").value = 1;
				document.getElementById(prefix+"aug").value = 1;
				document.getElementById(prefix+"sep").value = 1;
				document.getElementById(prefix+"okt").value = 1;
				document.getElementById(prefix+"nov").value = 1;
				document.getElementById(prefix+"dec").value = 1;
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_thermp&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);	
							
							thermp_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"type").selectedIndex = arr["type"];
							thermp_changetype();
							document.getElementById(prefix+"pigi").selectedIndex = arr["pigi"];
							document.getElementById(prefix+"w").value = arr["w"];
							document.getElementById(prefix+"n").value = arr["n"];
							document.getElementById(prefix+"cop").value = arr["cop"];
							document.getElementById(prefix+"jan").value = arr["jan"];
							document.getElementById(prefix+"feb").value = arr["feb"];
							document.getElementById(prefix+"mar").value = arr["mar"];
							document.getElementById(prefix+"apr").value = arr["apr"];
							document.getElementById(prefix+"may").value = arr["may"];
							document.getElementById(prefix+"jun").value = arr["jun"];
							document.getElementById(prefix+"jul").value = arr["jul"];
							document.getElementById(prefix+"aug").value = arr["aug"];
							document.getElementById(prefix+"sep").value = arr["sep"];
							document.getElementById(prefix+"okt").value = arr["okt"];
							document.getElementById(prefix+"nov").value = arr["nov"];
							document.getElementById(prefix+"dec").value = arr["dec"];
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_thermp('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία μονάδας παραγωγής';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_thermp('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη μονάδας παραγωγής';
				}
				document.getElementById("edit_button_thermp").innerHTML = button;
				document.getElementById("edit_header_thermp").innerHTML = edit_header;
				$("#modal_form_thermp").modal("show");
			}
			
			//ΔΙΑΓΡΑΦΗ ΜΟΝΑΔΑΣ ΠΑΡΑΓΩΓΗΣ
			function formdel_thermp(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_thermp('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_thermp").innerHTML = button;
				$("#modal_del_thermp").modal("show");
			}
			
			//Υποβολή της φόρμας για ΜΟΝΑΔΑ ΠΑΡΑΓΩΓΗΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_thermp(id){
			var prefix = "editthermp_";
				var zone_id = document.getElementById(prefix+"zone_id").value;
				var type = document.getElementById(prefix+"type").value;
				var pigi = document.getElementById(prefix+"pigi").value;
				var w = document.getElementById(prefix+"w").value;
				var n = document.getElementById(prefix+"n").value;
				var cop = document.getElementById(prefix+"cop").value;
				var jan = document.getElementById(prefix+"jan").value;
				var feb = document.getElementById(prefix+"feb").value;
				var mar = document.getElementById(prefix+"mar").value;
				var apr = document.getElementById(prefix+"apr").value;
				var may = document.getElementById(prefix+"may").value;
				var jun = document.getElementById(prefix+"jun").value;
				var jul = document.getElementById(prefix+"jul").value;
				var aug = document.getElementById(prefix+"aug").value;
				var sep = document.getElementById(prefix+"sep").value;
				var okt = document.getElementById(prefix+"okt").value;
				var nov = document.getElementById(prefix+"nov").value;
				var dec = document.getElementById(prefix+"dec").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_zone_sys_thermp";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+zone_id+","+type+","+pigi+","+w+","+n+","+cop+","+jan+","+feb+","+mar+","+apr+","+may+","+jun+","+jul+","+aug+","+sep+","+okt+","+nov+","+dec;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("thermp_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_thermp();
				}}
			}
			
			//Διαγραφή
			function del_thermp(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_thermp&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("thermp_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_thermp();
				}}
			}
			
			function thermp_changetype(){
			var prefix = "editthermp_";
			var type = document.getElementById(prefix+"type").value;
				document.getElementById(prefix+"help0").style.display="none";
				document.getElementById(prefix+"help1").style.display="none";
				for (var i=7;i<=12;i++){
					document.getElementById(prefix+"help"+i).style.display="none";
					}
				if(type>=1 && type<=6){
					document.getElementById(prefix+"help1").style.display="inline";
					thermp_copdivs();
				}	
				if(type==0 || type>=7){
					document.getElementById(prefix+"help"+type).style.display="inline";
				}
			}
			</script>

<!-- ###################### Κρυφό modal_form_thermp για εμφάνιση ###################### -->
<div id="modal_form_thermp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_thermp"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="danger"><td width=50%>Εισαγωγή</td><td width=50%>Βοήθεια</td></tr>
		<tr>
			<td>
				<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="Θερμική ζώνη που ανήκει ο τοίχος"><i class="fa fa-cubes"></i> Ζώνη</span>
					</span>
					<select class="form-control input-sm" id="editthermp_zone_id">
						<option value=0></option>
					</select>
				</div>
			</td>
			<td rowspan="6" style="background-color:#f2dede;">
			<span id="editthermp_help"></span>
			
			<div id="editthermp_help0" style="display:none;">
			<table class="table table-bordered table-condensed" style="background-color:#f2dede;">
			<tr><td>Παράμετρος</td><td>Επιλογή</td></tr>
			<tr>
			<td>P<sub>n</sub></td>
			<td><input type="text" class="form-control input-sm" id="editthermp_help0_pn" onkeyup="calc_ngm();calc_ng1();calc_ng2();" /></td>
			</tr>
			<tr>
			<td>P<sub>gen</sub></td>
			<td><input type="text" class="form-control input-sm" id="editthermp_help0_pgen" onkeyup="calc_ngm();calc_ng1();calc_ng2();" /></td>
			</tr>
			<tr>
			<td>n<sub>gm</sub></td>
			<td>
			<div class="row">
				<div class="col-md-6">
				<select class="form-control input-sm" id="editthermp_help0_type_ngm" onchange=calc_ngm();>
				<option value=0>Επιλέξτε...</option>
				<option value=1>Συνήθεις λέβητες</option>
				<option value=2>Λέβητες χαμηλής θερμοκρασίας ή συμπύκνωσης υγρών καυσίμων</option>
				<option value=3>Λέβητες συμπύκνωσης αερίων καυσίμων</option>
				</select>
				</div>
				<div class="col-md-6">
				<input type="text" class="form-control input-sm" id="editthermp_help0_ngm" onchange=calc_ngen(); onkeyup=calc_ngen(); />
				</div>
			</div>	
			</td>
			</tr>
			<tr>
			<td>n<sub>g1</sub></td>
			<td>
			<div class="row">
				<div class="col-md-6">
				<select  class="form-control input-sm" id="editthermp_help0_type_ng1" onchange=calc_ng1(); >
				<option value=0> - </option>
				<option value=1>Λέβητας με υπερδιπλάσια ισχύ από τη μέγιστη υπολογιζόμενη</option>
				<option value=2>Λέβητας με ισχύ μεγαλύτερη από 50% μέχρι και 100% από τη μέγιστη υπολογιζόμενη</option>
				<option value=3>Λέβητας με ισχύ μεγαλύτερη από 25% μέχρι και 50% από τη μέγιστη υπολογιζόμενη</option>
				<option value=4>Λέβητας με ισχύ μέχρι και 25% μεγαλύτερη από τη μέγιστη υπολογιζόμενη</option>
				</select>
				</div>
				<div class="col-md-6">
				<input type="text" class="form-control input-sm" id="editthermp_help0_ng1" disabled="disabled" onchange=calc_ngen(); />
				</div>
			</div>
			</td>
			</tr>
			<tr>
			<td>n<sub>g2</sub></td>
			<td>
			<div class="row">
				<div class="col-md-6">
					<select class="form-control input-sm" id="editthermp_help0_type_ng2" onchange=calc_ng2(); >
					<option value=0>Επιλέξτε...</option>
					<option value=1>Λέβητας με μόνωση Σε καλή κατάσταση μόνωσης</option>
					<option value=2>Λέβητας γυμνός ή με κατεστραμμένη μόνωση</option>
					</select>
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control input-sm" id="editthermp_help0_ng2" disabled="disabled" onchange=calc_ngen(); />
				</div>
			</div>
			</td>
			</tr>
			<tr>
			<td><button type="button" class="btn btn-default" onclick=calc_ngen(); >n<sub>gen</sub></button></td>
			<td>
				<div id="editthermp_help0_bar"></div>
			</td>
			</tr>
			</table>
				<script>
				function calc_ngm(){
				var prefix = "editthermp_";
				var pn = document.getElementById(prefix+"help0_pn").value;
				var type_ngm = document.getElementById(prefix+"help0_type_ngm").value;
				var ngm_a, ngm_b, ngm;
					if(type_ngm==1){
					ngm_a = 84;ngm_b = 2;
					}
					if(type_ngm==2){
					ngm_a = 87.5;ngm_b = 1.5;
					}
					if(type_ngm==3){
					ngm_a = 91;ngm_b = 1;
					}

					ngm=( ( ngm_a+ngm_b*(Math.log(pn)/Math.LN10) )/100 );
					if(type_ngm==0){
					ngm=0;
					}
					document.getElementById(prefix+"help0_ngm").value = number_format(ngm,4);
				calc_ngen();	
				}
				function calc_ng1(){
				var prefix = "editthermp_";
				var pn = document.getElementById(prefix+"help0_pn").value;
				var pgen = document.getElementById(prefix+"help0_pgen").value;
				var logos = pn/pgen;
				var x;
				var y;
						
					if(logos>2){
					x=0.75;
					y=1;
					}
					if(logos>1.5 && logos<=2){
					x=0.85;
					y=2;
					}
					if(logos>1.25 && logos<=1.5){
					x=0.95;
					y=3;
					}
					if(logos<=1.25){
					x=1;
					y=4;
					}
					document.getElementById(prefix+"help0_ng1").value=x;
					document.getElementById(prefix+"help0_type_ng1").selectedIndex=y;
				calc_ngen();
				}
				function calc_ng2(){
				var prefix = "editthermp_";
				var pn = document.getElementById(prefix+"help0_pn").value;
				var type_ng2 = document.getElementById(prefix+"help0_type_ng2").value;
				var x;

					if(pn==0){
					x=0;
					}
					if(type_ng2==0){
					x=0;
					}
					if(type_ng2==1){
					x=1;
					}
					if(type_ng2==2){
						if(pn>0 && pn<100){
						x=0.936;
						}
						if(pn>=100 && pn<200){
						x=0.949;
						}
						if(pn>=200 && pn<300){
						x=0.948;
						}
						if(pn>=300 && pn<400){
						x=0.951;
						}
						if(pn>=400){
						x=0.952;
						}
					}
					document.getElementById(prefix+"help0_ng2").value = x;
				calc_ngen();	
				}
				function calc_ngen(){
				var prefix = "editthermp_";
					var pn = document.getElementById(prefix+"help0_pn").value;
					var ngm = document.getElementById(prefix+"help0_ngm").value;
					var ng1 = document.getElementById(prefix+"help0_ng1").value;
					var ng2 = document.getElementById(prefix+"help0_ng2").value;
					var ngen = ngm*ng1*ng2;
					var ngen100 = number_format(ngen*100,3);
					var pn100 = number_format(pn*ngen,3);
					var result ="Η μονάδα παραγωγής μπορεί να αποδώσει σε ιδανικές συνθήκες το "+ngen100+"% της ονομαστικής ισχύος ("+pn+"KW) δηλαδή: "+pn100+"KW.<br/>";
						if(ngen100<=96){
						result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-danger\" style=\"width: "+ngen100+"%;\">"+ngen100+"%</div></div>";
						}else{
						result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-danger\" style=\"width: "+ngen100+"%;\"></div></div>";
						}
					
					document.getElementById(prefix+"cop").value = 1;
					document.getElementById(prefix+"n").value = number_format(ngen,4);
					document.getElementById(prefix+"help0_bar").innerHTML = result;
				}
				</script>
			</div>

			<div id="editthermp_help1" style="display:none;">
			<label class="radio-inline">
			<input type="radio" name="editthermp_help1_radios" id="editthermp_help1_copck4" value="1" onclick=thermp_copdivs();>SCOP (ΕΕ 626/2011)</label>
			<label class="radio-inline">
			<input type="radio" name="editthermp_help1_radios" id="editthermp_help1_copck1" value="1" onclick=thermp_copdivs();>COP (ΕΝ 15316.4.2:2008)</label>
			<label class="radio-inline">
			<input type="radio" name="editthermp_help1_radios" id="editthermp_help1_copck2" value="1" onclick=thermp_copdivs();>SCOP (Έτος εγκ.)</label>
			<label class="radio-inline">
			<input type="radio" name="editthermp_help1_radios" id="editthermp_help1_copck3" value="2" onclick=thermp_copdivs();>COP (κατανάλωση)</label>
			
			<div id="editthermp_help1_div1">
			<table class="table table-bordered table-condensed" style="background-color:#f2dede;">
			<tr>
			<td colspan=2><font color="red">Προσοχή: Προηγούμενος ΚΕΝΑΚ</font></td>
			<td>
			<tr>
			<td>Πηγή θερμότητας:</td>
			<td>
			<select class="form-control input-sm" id="editthermp_cop1_type" onchange=calc_cop1t(); >
			<option value=0>Επιλέξτε...</option>
			<option value=1>Εξωτερικός αέρας</option>
			<option value=2>Έδαφος</option>
			<option value=3>Θερμότητα από καυσαέρια (πχ ΣΗΘ)</option>
			<option value=4>Υπόγειο ή θαλασσινό νερό</option>
			<option value=5>Επιφανειακά νερά</option>
			</select>
			</td>
			</tr>
			
			<tr>
			<td>Χρήση:</td>
			<td>
			<select class="form-control input-sm" id="editthermp_cop1_xrisi" onchange=calc_cop1t();>
			<option value=0>Επιλέξτε...</option>
			<option value=1>Κτήρια κατοικιών</option>
			<option value=2>Κτήρια τριτογενούς τομέα</option>
			</select>
			</td>
			</tr>
			
			<tr>
			<td>Θερμοκρασίες θερμικού μέσου:</td>
			<td>
			<select class="form-control input-sm" id="editthermp_cop1_t" onchange=calc_cop1(); >
			<option value=0>Επιλέξτε...</option>
			</select>
			</td>
			</tr>
			</table>
			</div>
			
			<div id="editthermp_help1_div2" style="display:none;">
			<table class="table table-bordered table-condensed" style="background-color:#f2dede;">
				<tr>
					<td colspan=2>SCOP χωρίς στοιχεία με βάση έτος εγκατάστασης</td>
				</tr>
				<tr>
				<td>Τύπος:</td>
				<td>
				<select class="form-control input-sm" id="editthermp_cop2_type" onchange=calc_cop2old(); >
				<option value=0>Επιλέξτε...</option>
				<option value=1>Αερόψυκτη αντλία</option>
				<option value=2>Υδρόψυκτη αντλία</option>
				</select>
				</td>
				</tr>
				
				<tr>
				<td>Παλαιότητα:</td>
				<td>
				<select class="form-control input-sm" id="editthermp_cop2_old" onchange=calc_cop2();>
				<option value=0>Επιλέξτε...</option>
				</select>
				</td>
				</tr>
			</table>
			</div>
			
			<div id="editthermp_help1_div3" style="display:none;">
			<table class="table table-bordered table-condensed" style="background-color:#f2dede;">
				<tr>
					<td colspan=2>SCOP=COP (Χωρίς ΕΕ 626/2011) για Τ όπως παρακάτω</td>
				</tr>
				<tr>
				<td>Αποδιδόμενη ισχύς (θέρμανσης):</td>
				<td>
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label class="control-label col-sm-3" for="editthermp_cop_kw_out">KW</label>
						<div class="col-sm-9">
						<input class="form-control input-sm" type="text" id="editthermp_cop_kw_out" onkeyup=calc_kcal() />
						</div>
					</div>	
					<div class="form-group">
						<label class="control-label col-sm-3" for="editthermp_cop_kcal_out">Kcal</label>
						<div class="col-sm-9">
						<input class="form-control" type="text" id="editthermp_cop_kcal_out" onkeyup=calc_kw() />
						</div>
					</div>
				</form>
				</td>
				</tr>
				
				<tr>
				<td>Καταναλισκόμενη ισχύς (ηλεκτρική):</td>
				<td>
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label class="control-label col-sm-3" for="editthermp_cop_kw_in">KW</label>
						<div class="col-sm-9">
						<input class="form-control input-sm" type="text" id="editthermp_cop_kw_in" onkeyup=calc_cop3() />
						</div>
					</div>
				</form>
				</td>
				</tr>
				
				<tr>
					<td>Θερμαινόμενο μέσο αέρας (χωρίς ΕΕ 626/2011)</td>
					<td>Τ<sub>εξ</sub>:7<sub>o</sub>C - Τ<sub>εσ</sub>:20<sub>o</sub></td>
				</tr>
				<tr>
					<td>Θερμαινόμενο μέσο νερό (χωρίς ΕΕ 626/2011)</td>
					<td>Τ<sub>εξ</sub>:7<sub>o</sub>C - Τ<sub>θερμ. μέσου</sub>:45<sub>o</sub></td>
				</tr>
				<tr>
					<td>Γεωθερμική αντλία (χωρίς ΕΕ 626/2011)</td>
					<td>Τ<sub>εξ</sub>:15<sub>o</sub>C - Τ<sub>θερμ. μέσου</sub>:45<sub>o</sub></td>
				</tr>
				</table>
			</div>
			
			<div id="editthermp_help1_div4" style="display:none;">
			<table class="table table-bordered table-condensed" style="background-color:#f2dede;">
				<tr>
					<td colspan=2>SCOP με ενεργειακή σήμανση (ΕΕ 626/2011)</td>
				</tr>
				<tr>
				<td>SCOP<sub>ΕΣ</sub> (από σήμανση):</td>
				<td>
					<input class="form-control" type="text" id="editthermp_scopes" onkeyup=calc_cop4() />				
				</td>
				</tr>
				
				<tr>
				<td>SCOP=0.93 x SCOP<sub>ΕΣ</sub></td>
				<td>
					<input class="form-control" type="text" id="editthermp_scop4" disabled />				
				</td>
				</tr>
			</table>
			</div>
			
			<script>
			function thermp_copdivs(){
			var prefix = "editthermp_";
			var i;
				for (var i=1;i<=4;i++){
				document.getElementById(prefix+"help1_div"+i).style.display="none";
					if(document.getElementById(prefix+"help1_copck"+i).checked){
						document.getElementById(prefix+"help1_div"+i).style.display="inline";
					}
				}
			}
			function calc_cop1t(){
			var prefix = "editthermp_";
			var type = document.getElementById(prefix+"cop1_type").value;
			var xrisi = document.getElementById(prefix+"cop1_xrisi").value;
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
				
				document.getElementById(prefix+"cop1_t").innerHTML = x;
				calc_cop1();
			}

			function calc_cop1(){
			var prefix = "editthermp_";
			var x = document.getElementById(prefix+"cop1_t").value;
			
			document.getElementById(prefix+"n").value = 1;
			document.getElementById(prefix+"cop").value =x;
			}

			function calc_cop2old(){
			var prefix = "editthermp_";
			var type = document.getElementById(prefix+"cop2_type").value;
			var x;

				if(type==0){
				x="<option value=0>Επιλέξτε πρώτα τύπο...</option>";
				}
				if(type==1){
					x="<option value=1.7>Χωρίς γνωστή χρονολογία</option>";
					x+="<option value=1.7>Πριν το 1990</option>";
					x+="<option value=2.2>Μεταξύ 1990 και 2000</option>";
					x+="<option value=2.5>Μετά το 2001</option>";
				}
				if(type==2){
					x="<option value=2.2>Χωρίς γνωστή χρονολογία</option>";
					x+="<option value=2.2>Πριν το 1990</option>";
					x+="<option value=2.7>Μεταξύ 1990 και 2000</option>";
					x+="<option value=3.0>Μετά το 2001</option>";
				}
				
				document.getElementById(prefix+"cop2_old").innerHTML = x;
				calc_cop2();
			}

			function calc_cop2(){
			var prefix = "editthermp_";
			var x = document.getElementById(prefix+"cop2_old").value;
			
			document.getElementById(prefix+"n").value = 1;
			document.getElementById(prefix+"cop").value =x;
			}

			function calc_cop3(){
			var prefix = "editthermp_";
			var kw_out = document.getElementById(prefix+"cop_kw_out").value;
			var kw_in = document.getElementById(prefix+"cop_kw_in").value;
			var cop3;
				if(kw_in!=0 && kw_out!=0){
				cop3 = kw_out / kw_in;
				}else{
				cop3 = 0;
				}
			
			document.getElementById(prefix+"n").value = 1;			
			document.getElementById(prefix+"cop").value = number_format(cop3,3);
			}
			
			function calc_cop4(){
				var prefix = "editthermp_";
				var scopes = document.getElementById(prefix+"scopes").value;
				document.getElementById(prefix+"scop4").value=0.93*scopes;
				
				document.getElementById(prefix+"n").value = 1;
				document.getElementById(prefix+"cop").value = 0.93*scopes;
			}
			
			function calc_kcal(){
			var prefix = "editthermp_";
			var kw_out = document.getElementById(prefix+"cop_kw_out").value;
			var kcal = kw_out*859.845227859;
			document.getElementById(prefix+"cop_kcal_out").value = number_format(kcal,1,".","");
			calc_cop3();
			}
			function calc_kw(){
			var prefix = "editthermp_";
			var kcal_out = document.getElementById(prefix+"cop_kcal_out").value;
			var kw = kcal_out*0.001163;
			document.getElementById(prefix+"cop_kw_out").value = number_format(kw,3,".","");
			calc_cop3();
			}
			</script>
			</div>
			
			<div id="editthermp_help7" style="display:none;">
			Τοπικές ηλεκτρικές μονάδες<br/>
			<select class="form-control input-sm" id="editthermp_help7_select" onchange=calc_thermp_ilektrikes();>
				<option value=0>Επιλέξτε...</option>
				<option value=1>Καλοσυντηρημένες μονάδες με μόνωση</option>
				<option value=0.95>Κακοσυντηρημένες μονάδες χωρίς μόνωση</option>
			</select>
			
			<script>
			function calc_thermp_ilektrikes(){
				var prefix = "editthermp_";
				var select = document.getElementById(prefix+"help7_select").value;
				document.getElementById(prefix+"n").value = select;
			}	
			</script>
			</div>
			
			<div id="editthermp_help8" style="display:none;">
			Τοπικές μονάδες αερίου ή υγρού καυσίμου<br/>
			<select class="form-control input-sm" id="editthermp_help8_select" onchange=calc_thermp_aeriou();>
				<option value=0>Επιλέξτε...</option>
				<option value=1>Χωρίς καπνοδόχο</option>
				<option value=0.7>Με καπνοδόχο</option>
			</select>
			
			<script>
			function calc_thermp_aeriou(){
				var prefix = "editthermp_";
				var select = document.getElementById(prefix+"help8_select").value;
				document.getElementById(prefix+"n").value = select;
			}	
			</script>
			</div>
			
			<div id="editthermp_help9" style="display:none;">
			Ανοικτές εστίες καύσης<br/>
			<select class="form-control input-sm" id="editthermp_help9_select" onchange=calc_thermp_esties();>
				<option value=0>Επιλέξτε...</option>
				<option value=0.25>Τζάκια</option>
				<option value=0.50>Ενεργειακά τζάκια, σόμπες</option>
			</select>
			
			<script>
			function calc_thermp_esties(){
				var prefix = "editthermp_";
				var select = document.getElementById(prefix+"help9_select").value;
				document.getElementById(prefix+"n").value = select;
			}	
			</script>
			</div>
			
			<div id="editthermp_help10" style="display:none;">
			Τηλεθέρμανση - Ανατρέξτε στην ΤΟΤΕΕ-20701-5
			</div>
			
			<div id="editthermp_help11" style="display:none;">
			ΣΗΘ - Ανατρέξτε στην ΤΟΤΕΕ-20701-5
			</div>
			
			<div id="editthermp_help12" style="display:none;">
			Μονάδα παραγωγής άλλου τύπου - Χειροκίνητη εισαγωγή χωρίς εργαλείο
			</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Τύπος μονάδας παραγωγής"><i class="fa fa-keyboard-o"></i> Τύπος</span>
				</span>
				<select class="form-control input-sm" id="editthermp_type" onchange="thermp_changetype();">
					<option value=0>Λέβητας</option>
					<option value=1>Κεντρική υδρόψυκτη Α.Θ.</option>
					<option value=2>Κεντρική αερόψυκτη Α.Θ.</option>
					<option value=3>Τοπική αερόψυκτη Α.Θ.</option>
					<option value=4>Γεωθερμική Α.Θ. με οριζόντιο εναλλάκτη</option>
					<option value=5>Γεωθερμική Α.Θ. με κατακόρυφο εναλλάκτη</option>
					<option value=6>Κεντρική άλλου τύπου Α.Θ.</option>
					<option value=7>Τοπικές ηλεκτρικές μονάδες (καλοριφέρ ή θερμοπομποί ή άλλο)</option>
					<option value=8>Τοπικές μονάδες αερίου ή υγρού καυσίμου</option>
					<option value=9>Ανοικτές εστίες καύσης</option>
					<option value=10>Τηλεθέρμανση</option>
					<option value=11>ΣΗΘ</option>
					<option value=12>Μονάδα παραγωγής άλλου τύπου</option>
				</select>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Πηγή ενέργειας της μονάδας παραγωγής"><i class="fa fa-cog"></i> Πηγή</span>
				</span>
				<select class="form-control input-sm" id="editthermp_pigi">
					<option value=0>Υγραέριο</option>
					<option value=1>Φυσικό αέριο</option>
					<option value=2>Ηλεκτρισμός</option>
					<option value=3>Πετρέλαιο θέρμανσης</option>
					<option value=4>Πετρέλαιο κίνησης</option>
					<option value=5>Τηλεθέρμανση (ΔΕΗ)</option>
					<option value=6>Τηλεθέρμανση (ΑΠΕ)</option>
					<option value=7>Βιομάζα</option>
					<option value=8>Βιομάζα τυποποιημένη</option>
					<option value=9>ΣΗΘ1</option>
					<option value=10>ΣΗΘ2</option>
					<option value=11>ΣΗΘ3</option>
					<option value=12>ΣΗΘ4</option>
					<option value=13>ΣΗΘ5</option>
					<option value=14>ΣΗΘ6</option>
					<option value=15>ΣΗΘ7</option>
					<option value=16>ΣΗΘ8</option>
					<option value=17>ΣΗΘ9</option>
					<option value=18>ΣΗΘ10</option>
				</select>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Ισχύς (KW)"><i class="fa fa-fire"></i> Ισχύς</span>
				</span>
				<input class="form-control input-sm" type="text" id="editthermp_w">
				<span class="input-group-addon">KW</span>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Εποχιακός βαθμός απόδοσης n (-)"><i class="fa fa-line-chart"></i> n</span>
				</span>
				<input class="form-control input-sm" type="text" id="editthermp_n">
				<span class="input-group-addon">-</span>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Εποχιακός βαθμός επίδοσης SCOP (-)"><i class="fa fa-line-chart"></i> SCOP</span>
				</span>
				<input class="form-control input-sm" type="text" id="editthermp_cop">
				<span class="input-group-addon">-</span>
				</div>
			</td>
		</tr>
	</table>
		<font size="1" style="font-size: 2px;">
		<div class="row">
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f67f7f;">I</span>
					<input type="text" class="form-control input-sm" style="background-color:#f67f7f;text-align:center;" id="editthermp_jan">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f89999;">Φ</span>
					<input type="text" class="form-control input-sm" style="background-color:#f89999;text-align:center;" id="editthermp_feb">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f9b2b2;">Μ</span>
					<input type="text" class="form-control input-sm" style="background-color:#f9b2b2;text-align:center;" id="editthermp_mar">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#fbcccc;">Α</span>
					<input type="text" class="form-control input-sm" style="background-color:#fbcccc;text-align:center;" id="editthermp_apr">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#edf6ff;">Μ</span>
					<input type="text" class="form-control input-sm" style="background-color:#edf6ff;text-align:center;" id="editthermp_may">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#e2f0ff;">Ι</span>
					<input type="text" class="form-control input-sm" style="background-color:#e2f0ff;text-align:center;" id="editthermp_jun">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#d7eaff;">Ι</span>
					<input type="text" class="form-control input-sm" style="background-color:#d7eaff;text-align:center;" id="editthermp_jul">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#e2f0ff;">Α</span>
					<input type="text" class="form-control input-sm" style="background-color:#e2f0ff;text-align:center;" id="editthermp_aug">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#edf6ff;">Σ</span>
					<input type="text" class="form-control input-sm" style="background-color:#edf6ff;text-align:center;" id="editthermp_sep">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f9b2b2;">Ο</span>
					<input type="text" class="form-control input-sm" style="background-color:#f9b2b2;text-align:center;" id="editthermp_okt">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f89999;">Ν</span>
					<input type="text" class="form-control input-sm" style="background-color:#f89999;text-align:center;" id="editthermp_nov">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f67f7f;">Δ</span>
					<input type="text" class="form-control input-sm" style="background-color:#f67f7f;text-align:center;" id="editthermp_dec">
				</div>
			</div>
		</div>
		</font>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_thermp"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_thermp για εμφάνιση ###################### -->
<div id="modal_del_thermp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή μονάδας παραγωγής</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_thermp"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

			
			<div id="thermd_table"></div>
			<div id="thermd_info"></div>
			
			<script>
			get_thermd();
			
			//Εμφάνιση πίνακα με όλες τις μονάδες παραγωγής του χρήστη
			function get_thermd(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getthermd=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("thermd_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function thermd_getzones(zone_id){
			var prefix = "editthermd_";
			
			//Εμφάνιση select ανάλογα με τον τύπο (ΖΩΝΕΣ η ΜΘΧ). Εδώ ενδιαφέρουν οι ζώνες
			var link1 = "includes/functions_meleti_general.php?getavailablezones=1&type="+0;
			var xmlhttp1=new XMLHttpRequest();
			xmlhttp1.open("GET",link1 ,true);
			xmlhttp1.send();
			xmlhttp1.onreadystatechange=function()  {
			if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
				document.getElementById(prefix+"zone_id").innerHTML = xmlhttp1.responseText;
				if(zone_id!=0){
				document.getElementById(prefix+"zone_id").value = zone_id;
				}
			}}
			}
				
			//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές ΘΕΡΜΟΓΕΦΥΡΑΣ
			function form_thermd(id){
			var prefix = "editthermd_";

				if(id==0){
				thermd_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"d_w").value = "";
				document.getElementById(prefix+"d_type").selectedIndex = 0;
				document.getElementById(prefix+"a_type").selectedIndex = 0;
				document.getElementById(prefix+"d_n").value = "";
				document.getElementById(prefix+"a_insulation").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_thermd&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
						var ischecked;
							
							thermd_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"d_type").selectedIndex = arr["d_type"];
							document.getElementById(prefix+"a_type").selectedIndex = arr["a_type"];
							document.getElementById(prefix+"d_w").value = arr["d_w"];
							document.getElementById(prefix+"d_n").value = arr["d_n"];
							if(arr["a_insulation"]==1){ischecked=true;}
							if(arr["a_insulation"]==0){ischecked=false;}
							document.getElementById(prefix+"a_insulation").checked = ischecked;
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
			var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_thermd('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία δικτύου διανομής';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_thermd('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη δικτύου διανομής';
				}
				document.getElementById("edit_button_thermd").innerHTML = button;
				document.getElementById("edit_header_thermd").innerHTML = edit_header;
				$("#modal_form_thermd").modal("show");
			}
			
			//Εμφάνιση διαγραφής
			function formdel_thermd(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_thermd('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_thermd").innerHTML = button;
				$("#modal_del_thermd").modal("show");
			}
			
			//Υποβολή της φόρμας για ΔΙΚΤΥΟ ΔΙΑΝΟΜΗΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_thermd(id){
			var prefix = "editthermd_";
			var a_insulation;
				var zone_id = document.getElementById(prefix+"zone_id").value;
				var d_w = document.getElementById(prefix+"d_w").value;
				var d_type = document.getElementById(prefix+"d_type").value;
				var d_n = document.getElementById(prefix+"d_n").value;
				var a_type = document.getElementById(prefix+"a_type").value;
				if(document.getElementById(prefix+"a_insulation").checked == true){
					a_insulation = 1;
				}else{
					a_insulation = 0;
				}
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_zone_sys_thermd";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+zone_id+","+d_w+","+d_type+","+d_n+","+a_type+","+a_insulation;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("thermd_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_thermd();
				}}
			}
			
			//Διαγραφή
			function del_thermd(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_thermd&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("thermd_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_thermd();
				}}
			}
			</script>
<!-- ###################### Κρυφό modal_form_thermd για εμφάνιση ###################### -->
<div id="modal_form_thermd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_thermd"></span></h6>
	</div>

	<div class="modal-body">	
	<table class="table table-bordered table-condensed">
			<tr class="danger">
			<td width=25%>Δίκτυο διανομής</td>
			<td width=25%>Αεραγωγοί</td>
			<td width=50%>Βοήθεια</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="input-group">
						<span class="input-group-addon">
							<span class="tip-top" href="#" title="Θερμική ζώνη που ανήκει το δίκτυο διανομής θέρμανσης"><i class="fa fa-building-o"></i> Ζώνη</span>
						</span>
					<select class="form-control input-sm" id="editthermd_zone_id">
						<option value=0></option>
					</select>
					</div>
				</td>
				<td rowspan="5" style="background-color:#f2dede;">
					
					
				<table class="table table-bordered table-condensed" style="background-color:#f2dede;">					
					<tr>
						<td>Θερμοκρασία προσαγωγής θερμού μέσου</td>
						<td>
							<select class="form-control input-sm" id="editthermd_t" onchange=get_thermd_n(); >
								<option value=0>Επιλέξτε...</option>
								<option value=1>Υψηλές Τ>60<sup>o</sup>C</option>
								<option value=2>Χαμηλές Τ<60<sup>o</sup>C</option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>Μόνωση</td>
						<td>
							<select class="form-control input-sm" id="editthermd_monwsi" onchange=get_thermd_n(); >
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
							<input type="checkbox" id="editthermd_ducts" onchange=get_thermd_n();>
							Αεραγωγοί
							</label>
							</div>
						</td>
					</tr>
				</table>
				<div id="editthermd_bar"></div>
				<script>
				function get_thermd_n(){
					var prefix = "editthermd_";
					var dianomi_p = document.getElementById(prefix+"d_w").value;
					var dianomi_t = document.getElementById(prefix+"t").value;
					var dianomi_dieleysi = parseInt(document.getElementById(prefix+"d_type").value) + 1;
					var dianomi_monwsi = document.getElementById(prefix+"monwsi").value;
					var dianomi_ducts = document.getElementById(prefix+'ducts');
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
						document.getElementById(prefix+"d_n").value=number_format(n,3);
						var result ="Το δίκτυο διανομής αποδίδει στις τερματικές μονάδες το "+n100+"% της ονομαστικής ισχύος ("+dianomi_p+"KW) δηλαδή: "+pn+"KW.<br/>";
						if(n100<=96){
						result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-danger\" style=\"width: "+n100+"%;\">"+n100+"%</div></div>";
						}else{
						result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-danger\" style=\"width: "+n100+"%;\"></div></div>";
						}
						document.getElementById(prefix+"bar").innerHTML = result;
					}}
				}
				</script>
				
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="Ισχύς που μεταφέρει το δίκτυο διανομής"><i class="fa fa-cog"></i> Ισχύς</span>
					</span>
				<input class="form-control input-sm" type="text" id="editthermd_d_w" onchange=get_dianomi_n(); >
				</div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="Διέλευση δικτύου διανομής"><i class="fa fa-exchange"></i> Διέλευση ΔΔ:</span>
					</span>
				<select class="form-control input-sm" id="editthermd_d_type" onchange=get_dianomi_n(); >
					<option value=0>Εσωτερικοί ή έως 20% σε εξωτερικούς</option>
					<option value=1>Πάνω από 20% σε εξωτερικούς</option>
				</select>
				</div>
			</td>
			<td>
				<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="Διέλευση αεραγωγών"><i class="fa fa-exchange"></i> Διέλευση Αερ:</span>
					</span>
				<select class="form-control input-sm" id="editthermd_a_type">
					<option value=0>Εσωτερικοί ή έως 20% σε εξωτερικούς</option>
					<option value=1>Πάνω από 20% σε εξωτερικούς</option>
				</select>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="Βαθμός απόδοσης δικτύου διανομής n (-)"><i class="fa fa-line-chart"></i> n</span>
					</span>
				<input class="form-control input-sm" type="text" id="editthermd_d_n">
				</div>
			</td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<div class="row">
					<div class="col-md-1">
					
					</div>
					<div class="col-md-10">
					<div class="input-group">
					<label class="checkbox">
					<input type="checkbox" id="editthermd_a_insulation">
					 Μόνωση</label>
					</div>
					</div>
				</div>
			</td>
		</tr>
	</table>
	<span id="editthermd_zone_id_info"></span>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_thermd"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_thermd για εμφάνιση ###################### -->
<div id="modal_del_thermd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή δικτύου διανομής</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_thermd"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->	

			
			<div id="thermt_table"></div>
			<div id="thermt_info"></div>
			
			<script>
			get_thermt();
			
			//Εμφάνιση πίνακα με όλες τις ΤΕΡΜΑΤΙΚΕΣ ΜΟΝΑΔΕΣ του χρήστη
			function get_thermt(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getthermt=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("thermt_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function thermt_getzones(zone_id){
			var prefix = "editthermt_";
			
			//Εμφάνιση select ανάλογα με τον τύπο (ΖΩΝΕΣ η ΜΘΧ). Εδώ ενδιαφέρουν οι ζώνες
			var link1 = "includes/functions_meleti_general.php?getavailablezones=1&type="+0;
			var xmlhttp1=new XMLHttpRequest();
			xmlhttp1.open("GET",link1 ,true);
			xmlhttp1.send();
			xmlhttp1.onreadystatechange=function()  {
			if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
				document.getElementById(prefix+"zone_id").innerHTML = xmlhttp1.responseText;
				if(zone_id!=0){
				document.getElementById(prefix+"zone_id").value = zone_id;
				}
			}}
			}
				
			//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			function form_thermt(id){
			var prefix = "editthermt_";

				if(id==0){
				thermt_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"type").value = "";
				document.getElementById(prefix+"n").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_thermt&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
						var ischecked;
							
							thermt_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"type").value = arr["type"];
							document.getElementById(prefix+"n").value = arr["n"];
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
			var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_thermt('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία τερματικών μονάδων';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_thermt('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη τερματικών μονάδων';
				}
				document.getElementById("edit_button_thermt").innerHTML = button;
				document.getElementById("edit_header_thermt").innerHTML = edit_header;
				$("#modal_form_thermt").modal("show");
			}
			
			//Εμφάνιση διαγραφής
			function formdel_thermt(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_thermt('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_thermt").innerHTML = button;
				$("#modal_del_thermt").modal("show");
			}
			
			//Υποβολή της φόρμας για ΤΕΡΜΑΤΙΚΕΣ ΜΟΝΑΔΕΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_thermt(id){
			var prefix = "editthermt_";

				var zone_id = document.getElementById(prefix+"zone_id").value;
				var type = document.getElementById(prefix+"type").value;
				var n = document.getElementById(prefix+"n").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_zone_sys_thermt";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+zone_id+","+type+","+n;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("thermt_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_thermt();
				}}
			}
			
			//Διαγραφή
			function del_thermt(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_thermt&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("thermt_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_thermt();
				}}
			}
			</script>
<!-- ###################### Κρυφό modal_form_thermt για εμφάνιση ###################### -->
<div id="modal_form_thermt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_thermt"></span></h6>
	</div>

	<div class="modal-body">	
	<table class="table table-bordered table-condensed">
		<tr class="danger">
		<td width=50%>Τιμή</td>
		<td width=50%>Βοήθεια</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Θερμική ζώνη που ανήκει η τερματική μονάδα"><i class="fa fa-building-o"></i> Ζώνη</span>
				</span>
				<select class="form-control input-sm" id="editthermt_zone_id">
					<option value=0></option>
				</select>
				</div>
			</td>
			<td rowspan="3" style="background-color:#f2dede;">
			
			<table class="table table-bordered table-condensed" style="background-color:#f2dede;">
				
				<tr>
				<td rowspan="3">
					n<sub>em</sub><br/>
					(Aπόδοση εκπομπής)
				</td>
				<td>
					Τύπος τερματικής μονάδας:
				</td>
				<td>
					<select class="form-control input-sm" id="type_nem" onchange=calc_nem(); >
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
				<td rowspan="2"><input class="form-control" type="text" id="nem" disabled="disabled" /></td>
				</tr>
				
				<tr>
				<td>
				T (Θερμοκρασία μέσου <sup>o</sup>C):
				</td>
				<td>
					<select class="form-control input-sm" id="type_t" onchange=calc_type_t(); >
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
				<select class="form-control input-sm" id="type_frad" onchange=calc_frad(); >
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
				<select class="form-control input-sm" id="type_fim" onchange=calc_fim(); >
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
				<select class="form-control input-sm" id="type_fhydr" onchange=calc_fhydr(); >
				<option value=0>Επιλέξτε...</option>
				<option value=1>Με υδραυλικά εξισορροπημένο σύστημα</option>
				<option value=1.03>Με συστήματα εκτός ισορροπίας</option>
				</select>
				</td>
				<td><input class="form-control" type="text" id="fhydr" disabled="disabled" /></td>
				</tr>
				
			</table>
			<div id="editthermt_bar"></div>
			<script>

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
			var nemt100 = number_format(nemt*100,3);

				document.getElementById('editthermt_n').value =nemt;
				
				var result ="Οι τερματικές μονάδες αποδίδουν στο χώρο το "+nemt100+"% της ισχύος του δικτύου διανομής<br/>";
				if(nemt100<=96){
				result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-danger\" style=\"width: "+nemt100+"%;\">"+nemt100+"%</div></div>";
				}else{
				result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-danger\" style=\"width: "+nemt100+"%;\"></div></div>";
				}
				document.getElementById("editthermt_bar").innerHTML=result;
				

			}
			</script>
			
			
			
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Σύντομη περιγραφή τερματικής μονάδας"><i class="fa fa-keyboard-o"></i> Τύπος</span>
				</span>
				<input class="form-control input-sm" type="text" id="editthermt_type">
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Βαθμ. απόδοσης <br/> ΕΛΟΤ ΕΝ 15316.2.1:2008 <br/> n<sub>em,t</sub>=n<sub>em</sub>/(f<sub>rad</sub>×f<sub>im</sub>×f<sub>hydr</sub>"><i class="fa fa-line-chart"></i> n</span>
				</span>
				<input class="form-control input-sm" type="text" id="editthermt_n">
				</div>
			</td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_thermt"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_thermt για εμφάνιση ###################### -->
<div id="modal_del_thermt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή τερματικών μονάδων</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_thermt"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

			
			<div id="thermv_table"></div>
			<div id="thermv_info"></div>
			
			<script>
			get_thermv();
			
			//Εμφάνιση πίνακα με όλες τις ΒΟΗΘΗΤΙΚΕΣ ΜΟΝΑΔΕΣ του χρήστη
			function get_thermv(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getthermv=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("thermv_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function thermv_getzones(zone_id){
			var prefix = "editthermv_";
			
			//Εμφάνιση select ανάλογα με τον τύπο (ΖΩΝΕΣ η ΜΘΧ). Εδώ ενδιαφέρουν οι ζώνες
			var link1 = "includes/functions_meleti_general.php?getavailablezones=1&type="+0;
			var xmlhttp1=new XMLHttpRequest();
			xmlhttp1.open("GET",link1 ,true);
			xmlhttp1.send();
			xmlhttp1.onreadystatechange=function()  {
			if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
				document.getElementById(prefix+"zone_id").innerHTML = xmlhttp1.responseText;
				if(zone_id!=0){
				document.getElementById(prefix+"zone_id").value = zone_id;
				}
			}}
			}
				
			//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			function form_thermv(id){
			var prefix = "editthermv_";

				if(id==0){
				thermv_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"type").selectedIndex = "";
				document.getElementById(prefix+"n").value = "";
				document.getElementById(prefix+"w").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_thermv&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
							
							thermv_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"type").selectedIndex = arr["type"];
							document.getElementById(prefix+"n").value = arr["n"];
							document.getElementById(prefix+"w").value = arr["w"];
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
			var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_thermv('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία βοηθητικών μονάδων';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_thermv('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη βοηθητικών μονάδων';
				}
				document.getElementById("edit_button_thermv").innerHTML = button;
				document.getElementById("edit_header_thermv").innerHTML = edit_header;
				$("#modal_form_thermv").modal("show");
			}
			
			//Εμφάνιση διαγραφής
			function formdel_thermv(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_thermv('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_thermv").innerHTML = button;
				$("#modal_del_thermv").modal("show");
			}
			
			//Υποβολή της φόρμας για ΒΟΗΘΗΤΙΚΕΣ ΜΟΝΑΔΕΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_thermv(id){
			var prefix = "editthermv_";

				var zone_id = document.getElementById(prefix+"zone_id").value;
				var type = document.getElementById(prefix+"type").value;
				var n = document.getElementById(prefix+"n").value;
				var w = document.getElementById(prefix+"w").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_zone_sys_thermv";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+zone_id+","+type+","+n+","+w;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("thermv_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_thermv();
				}}
			}
			
			//Διαγραφή
			function del_thermv(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_thermv&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("thermv_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_thermv();
				}}
			}
			</script>
<!-- ###################### Κρυφό modal_form_thermv για εμφάνιση ###################### -->
<div id="modal_form_thermv" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_thermv"></span></h6>
	</div>

	<div class="modal-body">	
	<table class="table table-bordered table-condensed">
		<tr class="danger">
		<td width=50%>Τιμή</td>
		<td width=50%>Βοήθεια</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Θερμική ζώνη που ανήκει η βοηθητική μονάδα"><i class="fa fa-building-o"></i> Ζώνη</span>
				</span>
				<select class="form-control input-sm" id="editthermv_zone_id">
					<option value=0></option>
				</select>
				</div>
			</td>
			<td rowspan="4" style="background-color:#f2dede;">
			ΠΡΟΣΟΧΗ:<br/>
			Οι τιμές εισάγονται σε KW.
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Τύπος βοηθητικής μονάδας"><i class="fa fa-keyboard-o"></i> Τύπος</span>
				</span>
				<select class="form-control input-sm" id="editthermv_type">
					<option value=0>Αντλίες</option>
					<option value=1>Κυκλοφορητές</option>
					<option value=2>Ηλεκτροβάνες</option>
					<option value=3>Ανεμιστήρες</option>
				</select>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Πλήθος παρόμοιων βοηθητικών μονάδων"><i class="fa fa-keyboard-o"></i> Πλήθος</span>
				</span>
				<input class="form-control input-sm" type="text" id="editthermv_n">
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Ισχύς βοηθητικής μονάδας <br/> (Προσοχή: Η τιμή είναι σε KW)"><i class="fa fa-cog"></i> Ισχύς</span>
				</span>
				<input class="form-control input-sm" type="text" id="editthermv_w">
				</div>
			</td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_thermv"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_thermv για εμφάνιση ###################### -->
<div id="modal_del_thermv" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή βοηθητικών μονάδων</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_thermv"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

	