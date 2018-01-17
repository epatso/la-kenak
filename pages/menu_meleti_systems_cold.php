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
			<div id="coldp_table"></div>
			<div id="coldp_info"></div>
			<script>
			get_coldp();
			
			//Εμφάνιση πίνακα με όλες τις μονάδες παραγωγής του χρήστη
			function get_coldp(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getcoldp=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("coldp_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function coldp_getzones(zone_id){
			var prefix = "editcoldp_";
			
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
			function form_coldp(id){
			var prefix = "editcoldp_";

				if(id==0){
				coldp_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"type").selectedIndex = 0;
				document.getElementById(prefix+"pigi").selectedIndex = 0;
				document.getElementById(prefix+"w").value = "";
				document.getElementById(prefix+"n").value = "";
				document.getElementById(prefix+"eer").value = "";
				document.getElementById(prefix+"jan").value = 1;
				document.getElementById(prefix+"feb").value = 1;
				document.getElementById(prefix+"mar").value = 1;
				document.getElementById(prefix+"apr").value = 1;
				document.getElementById(prefix+"may").value = 0.5;
				document.getElementById(prefix+"jun").value = 0.5;
				document.getElementById(prefix+"jul").value = 0.5;
				document.getElementById(prefix+"aug").value = 0.5;
				document.getElementById(prefix+"sep").value = 0.5;
				document.getElementById(prefix+"okt").value = 1;
				document.getElementById(prefix+"nov").value = 1;
				document.getElementById(prefix+"dec").value = 1;
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_coldp&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);	
							
							coldp_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"type").selectedIndex = arr["type"];
							document.getElementById(prefix+"pigi").selectedIndex = arr["pigi"];
							document.getElementById(prefix+"w").value = arr["w"];
							document.getElementById(prefix+"n").value = arr["n"];
							document.getElementById(prefix+"eer").value = arr["eer"];
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
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_coldp('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία μονάδας παραγωγής';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_coldp('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη μονάδας παραγωγής';
				}
				document.getElementById("edit_button_coldp").innerHTML = button;
				document.getElementById("edit_header_coldp").innerHTML = edit_header;
				$("#modal_form_coldp").modal("show");
			}
			
			//ΔΙΑΓΡΑΦΗ ΜΟΝΑΔΑΣ ΠΑΡΑΓΩΓΗΣ
			function formdel_coldp(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_coldp('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_coldp").innerHTML = button;
				$("#modal_del_coldp").modal("show");
			}
			
			//Υποβολή της φόρμας για ΜΟΝΑΔΑ ΠΑΡΑΓΩΓΗΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_coldp(id){
			var prefix = "editcoldp_";
				var zone_id = document.getElementById(prefix+"zone_id").value;
				var type = document.getElementById(prefix+"type").value;
				var pigi = document.getElementById(prefix+"pigi").value;
				var w = document.getElementById(prefix+"w").value;
				var n = document.getElementById(prefix+"n").value;
				var eer = document.getElementById(prefix+"eer").value;
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
				link += "&table=meletes_zone_sys_coldp";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+zone_id+","+type+","+pigi+","+w+","+n+","+eer+","+jan+","+feb+","+mar+","+apr+","+may+","+jun+","+jul+","+aug+","+sep+","+okt+","+nov+","+dec;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("coldp_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_coldp();
				}}
			}
			
			//Διαγραφή
			function del_coldp(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_coldp&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("coldp_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_coldp();
				}}
			}
			
			</script>
<!-- ###################### Κρυφό modal_form_coldp για εμφάνιση ###################### -->
<div id="modal_form_coldp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_coldp"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info"><td width=30%>Παράμετρος</td><td width=30%>Τιμή</td><td width=50%>Υπολογισμός βαθμ. επίδοσης</td></tr>
		<tr>
			<td>Ζώνη</td>
			<td>
			<select class="form-control input-sm" id="editcoldp_zone_id">
				<option value=0></option>
			</select>
			</td>
			
			<td rowspan="6" style="background-color:#d9edf7;">
			<!--################# ΒΟΗΘΕΙΑ ΨΥΞΗ #########################-->
				<div id="editcoldp_help1">
				<label class="radio-inline">
				<input type="radio" name="editcoldp_help1_radios" id="editcoldp_help1_eerck1" value="1" onclick=coldp_eerdivs(); checked>SEER (ΕΕ 626/2011)</label>
				<label class="radio-inline">
				<input type="radio" name="editcoldp_help1_radios" id="editcoldp_help1_eerck2" value="1" onclick=coldp_eerdivs();>SEER (έτος εγκ.)</label>
				<label class="radio-inline">
				<input type="radio" name="editcoldp_help1_radios" id="editcoldp_help1_eerck3" value="2" onclick=coldp_eerdivs();>EER κατανάλωση</label>
				
				<div id="editcoldp_help1_div1">
				<table class="table table-bordered table-condensed" style="background-color:#d9edf7;">
				<tr>
					<td colspan=2>SEER με ενεργειακή σήμανση (ΕΕ 626/2011)</td>
				</tr>
				<tr>
				<td>SEER<sub>ΕΣ</sub> (από σήμανση):</td>
				<td>
					<input class="form-control input-sm" type="text" id="editcoldp_seeres" onkeyup=calc_eer1() />				
				</td>
				</tr>
				
				<tr>
				<td>SEER=0.60 x SEER<sub>ΕΣ</sub>:</td>
				<td>
					<input class="form-control input-sm" type="text" id="editcoldp_seer" disabled />				
				</td>
				</tr>
				
				</table>
				</div>
				
				<div id="editcoldp_help1_div2" style="display:none;">
				<table class="table table-bordered table-condensed" style="background-color:#d9edf7;">
					<tr>
						<td colspan=2>SEER χωρίς στοιχεία με βάση έτος εγκατάστασης</td>
					</tr>
					<tr>
					<td>Τύπος:</td>
					<td>
					<select class="form-control input-sm" id="editcoldp_eer2_type" onchange=calc_eer2_type(); >
					<option value=0>Επιλέξτε...</option>
					<option value=1>Αερόψυκτη αντλία</option>
					<option value=2>Υδρόψυκτη αντλία</option>
					</select>
					</td>
					</tr>
					
					<tr>
					<td>Παλαιότητα:</td>
					<td>
					<select class="form-control input-sm" id="editcoldp_eer2_old" onchange=calc_eer2();>
					<option value=0>Επιλέξτε...</option>
					</select>
					</td>
					</tr>
				</table>
				</div>
				
				<div id="editcoldp_help1_div3" style="display:none;">
				<table class="table table-bordered table-condensed" style="background-color:#d9edf7;">
					<tr>
					<td colspan=2>SEER=EER (Χωρίς ΕΕ 626/2011) για Τ όπως παρακάτω</td>
					</tr>
					<tr>
					<td>Αποδιδόμενη ισχύς (Ψύξης):</td>
					<td>
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label class="control-label col-sm-3" for="editcoldp_eer_kw_out">KW</label>
							<div class="col-sm-9">
							<input class="form-control input-sm" type="text" id="editcoldp_eer_kw_out" onkeyup=calc_btu() />
							</div>
						</div>	
						<div class="form-group">
							<label class="control-label col-sm-3" for="editcoldp_eer_btu_out">Btu</label>
							<div class="col-sm-9">
							<input class="form-control input-sm" type="text" id="editcoldp_eer_btu_out" onkeyup=calc_eer_kw() />
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
							<label class="control-label col-sm-3" for="editcoldp_eer_kw_in">KW</label>
							<div class="col-sm-9">
							<input class="form-control input-sm" type="text" id="editcoldp_eer_kw_in" onkeyup=calc_eer3() />
							</div>
						</div>
					</form>
					</td>
					</tr>
					
					<tr>
					<td>Αερόψυκτη αντλία (χωρίς ΕΕ 626/2011)</td>
					<td>Τ<sub>εξ</sub>:35<sub>o</sub>C - Τ<sub>εσ</sub>:26<sub>o</sub></td>
					</tr>
					<tr>
					<td>Θερμαινόμενο μέσο νερό (χωρίς ΕΕ 626/2011)</td>
					<td>Τ<sub>εξ</sub>:35<sub>o</sub>C - Τ<sub>ψυχ. μέσο</sub>:7<sub>o</sub></td>
					</tr>
					<tr>
					<td>Γεωθερμική αντλία (χωρίς ΕΕ 626/2011)</td>
					<td>Τ<sub>εξ</sub>:15<sub>o</sub>C - Τ<sub>ψυχ. μέσο</sub>:7<sub>o</sub></td>
					</tr>
					</table>
				</div>
				<!--################# ΒΟΗΘΕΙΑ ΨΥΞΗ #########################-->
				<script>
				function coldp_eerdivs(){
					var prefix = "editcoldp_";
					var i;
						for (var i=1;i<=3;i++){
						document.getElementById(prefix+"help1_div"+i).style.display="none";
							if(document.getElementById(prefix+"help1_eerck"+i).checked){
								document.getElementById(prefix+"help1_div"+i).style.display="inline";
							}
						}
				}
				
				function calc_eer1(){
					var prefix = "editcoldp_";
					var seeres = document.getElementById(prefix+"seeres").value;
					var seer = 0.6*seeres;
					
					document.getElementById(prefix+"seer").value = seer;
					document.getElementById(prefix+"eer").value = number_format(seer,3,".","");
					document.getElementById(prefix+"n").value = 1;
				}
				function calc_eer2_type(){
					var prefix = "editcoldp_";
					var type = document.getElementById(prefix+"eer2_type").value;
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
						
						document.getElementById(prefix+"eer2_old").innerHTML = x;
						calc_eer2();
				}
				function calc_eer2(){
					var prefix = "editcoldp_";
					var x = document.getElementById(prefix+"eer2_old").value;
					
					document.getElementById(prefix+"n").value = 1;
					document.getElementById(prefix+"eer").value =x;
				}
				function calc_eer3(){
					var prefix = "editcoldp_";
					var kw_out = document.getElementById(prefix+"eer_kw_out").value;
					var kw_in = document.getElementById(prefix+"eer_kw_in").value;
					var eer3;
						if(kw_in!=0 && kw_out!=0){
						eer3 = kw_out / kw_in;
						}else{
						eer3 = 0;
						}
					
					document.getElementById(prefix+"n").value = 1;			
					document.getElementById(prefix+"eer").value = number_format(eer3,3);
				}
					
				function calc_btu(){
					var prefix = "editcoldp_";
					var kw_out = document.getElementById(prefix+"eer_kw_out").value;
					var btu = kw_out*3412.141633128;
					document.getElementById(prefix+"cop_kcal_out").value = number_format(btu,1,".","");
					calc_eer3();
				}
				function calc_eer_kw(){
					var prefix = "editcoldp_";
					var btu_out = document.getElementById(prefix+"eer_btu_out").value;
					var kw = btu_out*0.000293071;
					document.getElementById(prefix+"eer_kw_out").value = number_format(kw,3,".","");
					calc_eer3();
				}
				</script>
			</td>
		</tr>
		<tr>
			<td>Τύπος</td>
			<td>
			<select class="form-control input-sm" id="editcoldp_type">
			<option value=0>Αερόψυκτος ψύκτης</option>
			<option value=1>Υδρόψυκτος ψύκτης</option>
			<option value=2>Υδρόψυκτη Α.Θ.</option>
			<option value=3>Αερόψυκτη Α.Θ.</option>
			<option value=4>Γεωθερμική Α.Θ. με οριζόντιο εναλλάκτη</option>
			<option value=5>Γεωθερμική Α.Θ. με κατακόρυφο εναλλάκτη</option>
			<option value=6>Προσρόφησης Απορρόφησης Α.Θ.</option>
			<option value=7>Κεντρική άλλου τύπου Α.Θ.</option>
			<option value=8>Μονάδα παραγωγής άλλου τύπου</option>
			</select>
			</td>
		</tr>
		<tr>
			<td>Πηγή ενέργειας</td>
			<td>
			<select class="form-control input-sm" id="editcoldp_pigi">
			<option value=0>Υγραέριο (LPG)</option>
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
			</td>
		</tr>
		<tr><td>Ισχύς (KW)</td><td><input class="form-control input-sm" type="text" id="editcoldp_w"></td></tr>
		<tr><td>Βαθμός απόδοσης (n)</td><td><input class="form-control input-sm" type="text" id="editcoldp_n"></td></tr>
		<tr><td>Βαθμός επίδοσης (EER)</td><td><input class="form-control input-sm" type="text" id="editcoldp_eer"></td></tr>
	</table>
	<font size="1" style="font-size: 2px;">
		<div class="row">
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f67f7f;">I</span>
					<input type="text" class="form-control input-sm" style="background-color:#f67f7f;text-align:center;" id="editcoldp_jan">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f89999;">Φ</span>
					<input type="text" class="form-control input-sm" style="background-color:#f89999;text-align:center;" id="editcoldp_feb">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f9b2b2;">Μ</span>
					<input type="text" class="form-control input-sm" style="background-color:#f9b2b2;text-align:center;" id="editcoldp_mar">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#fbcccc;">Α</span>
					<input type="text" class="form-control input-sm" style="background-color:#fbcccc;text-align:center;" id="editcoldp_apr">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#edf6ff;">Μ</span>
					<input type="text" class="form-control input-sm" style="background-color:#edf6ff;text-align:center;" id="editcoldp_may">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#e2f0ff;">Ι</span>
					<input type="text" class="form-control input-sm" style="background-color:#e2f0ff;text-align:center;" id="editcoldp_jun">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#d7eaff;">Ι</span>
					<input type="text" class="form-control input-sm" style="background-color:#d7eaff;text-align:center;" id="editcoldp_jul">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#e2f0ff;">Α</span>
					<input type="text" class="form-control input-sm" style="background-color:#e2f0ff;text-align:center;" id="editcoldp_aug">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#edf6ff;">Σ</span>
					<input type="text" class="form-control input-sm" style="background-color:#edf6ff;text-align:center;" id="editcoldp_sep">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f9b2b2;">Ο</span>
					<input type="text" class="form-control input-sm" style="background-color:#f9b2b2;text-align:center;" id="editcoldp_okt">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f89999;">Ν</span>
					<input type="text" class="form-control input-sm" style="background-color:#f89999;text-align:center;" id="editcoldp_nov">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f67f7f;">Δ</span>
					<input type="text" class="form-control input-sm" style="background-color:#f67f7f;text-align:center;" id="editcoldp_dec">
				</div>
			</div>
		</div>
		</font>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_coldp"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_coldp για εμφάνιση ###################### -->
<div id="modal_del_coldp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
		<span id="del_button_coldp"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

			<br/>
			<div id="coldd_table"></div>
			<div id="coldd_info"></div>
			
			<script>
			get_coldd();
			
			//Εμφάνιση πίνακα με όλες τις μονάδες παραγωγής του χρήστη
			function get_coldd(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getcoldd=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("coldd_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function coldd_getzones(zone_id){
			var prefix = "editcoldd_";
			
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
			function form_coldd(id){
			var prefix = "editcoldd_";

				if(id==0){
				coldd_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"d_w").value = "";
				document.getElementById(prefix+"d_type").selectedIndex = 0;
				document.getElementById(prefix+"a_type").selectedIndex = 0;
				document.getElementById(prefix+"d_n").value = "";
				document.getElementById(prefix+"a_insulation").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_coldd&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
						var ischecked;
							
							coldd_getzones(arr["zone_id"]);
							
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
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_coldd('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία δικτύου διανομής';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_coldd('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη δικτύου διανομής';
				}
				document.getElementById("edit_button_coldd").innerHTML = button;
				document.getElementById("edit_header_coldd").innerHTML = edit_header;
				$("#modal_form_coldd").modal("show");
			}
			
			//Εμφάνιση διαγραφής
			function formdel_coldd(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_coldd('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_coldd").innerHTML = button;
				$("#modal_del_coldd").modal("show");
			}
			
			//Υποβολή της φόρμας για ΔΙΚΤΥΟ ΔΙΑΝΟΜΗΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_coldd(id){
			var prefix = "editcoldd_";
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
				link += "&table=meletes_zone_sys_coldd";
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
					document.getElementById("coldd_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_coldd();
				}}
			}
			
			//Διαγραφή
			function del_coldd(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_coldd&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("coldd_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_coldd();
				}}
			}
			</script>
<!-- ###################### Κρυφό modal_form_coldd για εμφάνιση ###################### -->
<div id="modal_form_coldd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_coldd"></span></h6>
	</div>

	<div class="modal-body">	
	<table class="table table-bordered table-condensed">
		<tr class="info">
		<td width=10%>Παράμετρος</td>
		<td width=25%>Δίκτυο διανομής</td>
		<td width=25%>Αεραγωγοί</td>
		<td width=40%>Βοήθεια</td>
		</tr>
		<tr>
			<td>Ζώνη</td>
			<td colspan="2">
			<select class="form-control input-sm" id="editcoldd_zone_id">
				<option value=0></option>
			</select>
			</td>
			<td rowspan="5" style="background-color:#d9edf7;">
					
					
				<table class="table table-bordered" style="background-color:#d9edf7;">			
					<tr>
						<td>Μόνωση</td>
						<td>
							<select class="form-control input-sm" id="editcoldd_monwsi" onchange=get_dianomi_cold(); >
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
							<input type="checkbox" id="editcoldd_ducts" onchange=get_dianomi_cold();>
							Αεραγωγοί
							</label>
							</div>
						</td>
					</tr>
				</table>
				<div id="editcoldd_bar"></div>
				<blackquote>
					Σε περίπτωση τοπικών μονάδων η ισχύς είναι μηδέν και ο βαθμός απόδοσης ισούται με 1. 
				</blackquote>
				<script>
				function get_dianomi_cold(){
					var prefix = "editcoldd_";
					var cold_p = document.getElementById(prefix+"d_w").value;
					var dieleysi = parseInt(document.getElementById(prefix+"d_type").value) + 1;
					var monwsi = document.getElementById(prefix+"monwsi").value;
					var dianomi_ducts = document.getElementById(prefix+"ducts");
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
						document.getElementById(prefix+"d_n").value=number_format(n,3);
						var result ="Το δίκτυο διανομής αποδίδει στις τερματικές μονάδες το "+n100+"% της ονομαστικής ισχύος ("+cold_p+"KW) δηλαδή: "+pn+"KW.<br/>";
						if(n100<=96){
						result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-info\" style=\"width: "+n100+"%;\">"+n100+"%</div></div>";
						}else{
						result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-info\" style=\"width: "+n100+"%;\"></div></div>";
						}
						document.getElementById(prefix+"bar").innerHTML = result;
					}}
				}
				</script>
				
			</td>
		</tr>
		<tr>
			<td>Ισχύς</td>
			<td><input class="form-control input-sm" type="text" id="editcoldd_d_w"></td>
			<td></td>
		</tr>
		<tr>
			<td>Διέλευση</td>
			<td>
			<select class="form-control input-sm" id="editcoldd_d_type">
			<option value=0>Εσωτερικοί ή έως 20% σε εξωτερικούς</option>
			<option value=1>Πάνω από 20% σε εξωτερικούς</option>
			</select>
			</td>
			<td>
			<select class="form-control input-sm" id="editcoldd_a_type">
			<option value=0>Εσωτερικοί ή έως 20% σε εξωτερικούς</option>
			<option value=1>Πάνω από 20% σε εξωτερικούς</option>
			</select>
			</td>
		</tr>
		<tr>
			<td>Βαθμ. απόδοσης</td>
			<td><input class="form-control input-sm" type="text" id="editcoldd_d_n"></td>
			<td></td>
		</tr>
		<tr>
			<td>Μόνωση</td>
			<td></td>
			<td><input type="checkbox" id="editcoldd_a_insulation"></td>
		</tr>
	</table>
	<span id="editcoldd_zone_id_info"></span>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_coldd"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_coldd για εμφάνιση ###################### -->
<div id="modal_del_coldd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
		<span id="del_button_coldd"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->	

			<br/>
			<div id="coldt_table"></div>
			<div id="coldt_info"></div>
			
			<script>
			get_coldt();
			
			//Εμφάνιση πίνακα με όλες τις ΤΕΡΜΑΤΙΚΕΣ ΜΟΝΑΔΕΣ του χρήστη
			function get_coldt(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getcoldt=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("coldt_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function coldt_getzones(zone_id){
			var prefix = "editcoldt_";
			
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
			function form_coldt(id){
			var prefix = "editcoldt_";

				if(id==0){
				coldt_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"type").value = "";
				document.getElementById(prefix+"n").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_coldt&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
						var ischecked;
							
							coldt_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"type").value = arr["type"];
							document.getElementById(prefix+"n").value = arr["n"];
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
			var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_coldt('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία τερματικών μονάδων';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_coldt('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη τερματικών μονάδων';
				}
				document.getElementById("edit_button_coldt").innerHTML = button;
				document.getElementById("edit_header_coldt").innerHTML = edit_header;
				$("#modal_form_coldt").modal("show");
			}
			
			//Εμφάνιση διαγραφής
			function formdel_coldt(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_coldt('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_coldt").innerHTML = button;
				$("#modal_del_coldt").modal("show");
			}
			
			//Υποβολή της φόρμας για ΤΕΡΜΑΤΙΚΕΣ ΜΟΝΑΔΕΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_coldt(id){
			var prefix = "editcoldt_";

				var zone_id = document.getElementById(prefix+"zone_id").value;
				var type = document.getElementById(prefix+"type").value;
				var n = document.getElementById(prefix+"n").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_zone_sys_coldt";
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
					document.getElementById("coldt_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_coldt();
				}}
			}
			
			//Διαγραφή
			function del_coldt(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_coldt&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("coldt_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_coldt();
				}}
			}
			</script>
<!-- ###################### Κρυφό modal_form_coldt για εμφάνιση ###################### -->
<div id="modal_form_coldt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_coldt"></span></h6>
	</div>

	<div class="modal-body">	
	<table class="table table-bordered table-condensed">
		<tr class="info">
		<td width=25%>Παράμετρος</td>
		<td width=25%>Τιμή</td>
		<td width=50%>Βοήθεια</td>
		</tr>
		<tr>
			<td>Ζώνη</td>
			<td>
			<select class="form-control input-sm" id="editcoldt_zone_id">
				<option value=0></option>
			</select>
			</td>
			<td rowspan="3" style="background-color:#d9edf7;">
			
			<table class="table table-bordered table-condensed" style="background-color:#d9edf7;">
				
				<tr>
				<td>
				n<sub>em</sub><br/>
				(Aπόδοση εκπομπής)
				</td>
				<td>
				<select class="form-control input-sm" id="type_cold_nem" onchange=calc_cold_nem(); >
					<option value=0>Επιλέξτε...</option>
					<option value=0.93>Άμεσα συστήματα</option>
					<option value=0.90>Ενσωματωμένες τερματικές μονάδες</option>
					<option value=0.93>Τοπικές αντλίες θερμότητας</option>
				</select>
				<div class="control-group warning">
				<label><input id="type_cold_nem1" type="checkbox" value="" onclick=calc_cold_nem();>Κακοσυντηρημένες μονάδες (εμφανείς φθορές)</label>
				</div>
				</td>
				<td><input class="form-control input-sm" type="text" id="cold_nem" disabled="disabled" /></td>
				</tr>
				
				<tr>
				<td>
				f<sub>im</sub><br/>
				(Παράγοντας της διακοπτόμενης λειτουργίας)
				</td>
				<td>
				<select class="form-control input-sm" id="type_cold_fim" onchange=calc_cold_fim(); >
					<option value=0>Επιλέξτε...</option>
					<option value=1>Mε συνεχή λειτουργία</option>
					<option value=0.97>Mε διακοπτόμενη λειτουργία</option>
				</select>
				</td>
				<td><input class="form-control input-sm" type="text" id="cold_fim" disabled="disabled" /></td>
				</tr>
				
				
				<tr>
				<td>
				f<sub>hydr</sub><br/>
				(Παράγοντας για την υδραυλική ισορροπία)
				</td>
				<td>
				<select class="form-control input-sm" id="type_cold_fhydr" onchange=calc_cold_fhydr(); >
					<option value=0>Επιλέξτε...</option>
					<option value=1>Με υδραυλικά εξισορροπημένο σύστημα</option>
					<option value=1.03>Με συστήματα εκτός ισορροπίας</option>
				</select>
				</td>
				<td><input class="form-control input-sm" type="text" id="cold_fhydr" disabled="disabled" /></td>
				</tr>
				
				
			</table>
			<div id="editcoldt_bar"></div>
			<script>
				function calc_cold_nem(){
					var x = document.getElementById('type_cold_nem').value;
					var y = document.getElementById('type_cold_nem1').checked;
						if(y == true){
						x = number_format(x*0.9,3);
						}
					document.getElementById('cold_nem').value =x;
					calc_cold_nemt();
				}

				function calc_cold_fim(){
					var x = document.getElementById('type_cold_fim').value;
					document.getElementById('cold_fim').value =x;
					calc_cold_nemt();
					}

				function calc_cold_fhydr(){
					var x = document.getElementById('type_cold_fhydr').value;
					document.getElementById('cold_fhydr').value =x;
					calc_cold_nemt();
				}

				function calc_cold_nemt(){
					var nem = document.getElementById('cold_nem').value;
					var fim = document.getElementById('cold_fim').value;
					var fhydr = document.getElementById('cold_fhydr').value;
					var nemt = number_format(nem/(fim*fhydr),3);
					var nemt100 = nemt*100;

					document.getElementById('editcoldt_n').value =nemt;
					
					var result ="Οι τερματικές μονάδες αποδίδουν στο χώρο το "+nemt100+"% της ισχύος του δικτύου διανομής<br/>";
					if(nemt100<=96){
					result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-info active\" style=\"width: "+nemt100+"%;\">"+nemt100+"%</div></div>";
					}else{
					result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-info\" style=\"width: "+nemt100+"%;\"></div></div>";
					}
					document.getElementById("editcoldt_bar").innerHTML=result;

				}
		
			</script>
			
			
			
			</td>
		</tr>
		<tr>
			<td>Τύπος</td>
			<td><input class="form-control input-sm" type="text" id="editcoldt_type"></td>
		</tr>
		<tr>
			<td>
				n<sub>em,t</sub><br/>
				(Βαθμός απόδοσης)<br/>
				ΕΛΟΤ ΕΝ 15316.2.1:2008 : <br/>
				n<sub>em,t</sub>=n<sub>em</sub>/(f<sub>im</sub>×f<sub>hydr</sub>)
			</td>
			<td><input class="form-control input-sm" type="text" id="editcoldt_n"></td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_coldt"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_coldt για εμφάνιση ###################### -->
<div id="modal_del_coldt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
		<span id="del_button_coldt"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

			<br/>
			<div id="coldv_table"></div>
			<div id="coldv_info"></div>
			
			<script>
			get_coldv();
			
			//Εμφάνιση πίνακα με όλες τις ΒΟΗΘΗΤΙΚΕΣ ΜΟΝΑΔΕΣ του χρήστη
			function get_coldv(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getcoldv=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("coldv_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function coldv_getzones(zone_id){
			var prefix = "editcoldv_";
			
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
			function form_coldv(id){
			var prefix = "editcoldv_";

				if(id==0){
				coldv_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"type").selectedIndex = "";
				document.getElementById(prefix+"n").value = "";
				document.getElementById(prefix+"w").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_coldv&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
							
							coldv_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"type").selectedIndex = arr["type"];
							document.getElementById(prefix+"n").value = arr["n"];
							document.getElementById(prefix+"w").value = arr["w"];
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
			var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_coldv('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία βοηθητικών μονάδων';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_coldv('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη βοηθητικών μονάδων';
				}
				document.getElementById("edit_button_coldv").innerHTML = button;
				document.getElementById("edit_header_coldv").innerHTML = edit_header;
				$("#modal_form_coldv").modal("show");
			}
			
			//Εμφάνιση διαγραφής
			function formdel_coldv(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_coldv('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_coldv").innerHTML = button;
				$("#modal_del_coldv").modal("show");
			}
			
			//Υποβολή της φόρμας για ΒΟΗΘΗΤΙΚΕΣ ΜΟΝΑΔΕΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_coldv(id){
			var prefix = "editcoldv_";

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
				link += "&table=meletes_zone_sys_coldv";
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
					document.getElementById("coldv_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_coldv();
				}}
			}
			
			//Διαγραφή
			function del_coldv(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_coldv&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("coldv_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_coldv();
				}}
			}
			</script>
<!-- ###################### Κρυφό modal_form_coldv για εμφάνιση ###################### -->
<div id="modal_form_coldv" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_coldv"></span></h6>
	</div>

	<div class="modal-body">	
	<table class="table table-bordered table-condensed">
		<tr class="info">
		<td width=25%>Παράμετρος</td>
		<td width=25%>Τιμή</td>
		<td width=50%>Βοήθεια</td>
		</tr>
		<tr>
			<td>Ζώνη</td>
			<td>
			<select class="form-control input-sm" id="editcoldv_zone_id">
				<option value=0></option>
			</select>
			</td>
			<td rowspan="4" style="background-color:#d9edf7;">
			ΠΡΟΣΟΧΗ:<br/>
			Οι τιμές εισάγονται σε KW.
			</td>
		</tr>
		<tr>
			<td>Τύπος</td>
			<td>
				<select class="form-control input-sm" id="editcoldv_type">
					<option value=0>Αντλίες</option>
					<option value=1>Κυκλοφορητές</option>
					<option value=2>Ηλεκτροβάνες</option>
					<option value=3>Ανεμιστήρες</option>
					<option value=4>Πύργος ψύξης</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Πλήθος</td>
			<td><input class="form-control input-sm" type="text" id="editcoldv_n"></td>
		</tr>
		<tr>
			<td>Ισχύς (KW)</td>
			<td><input class="form-control input-sm" type="text" id="editcoldv_w"></td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_coldv"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_coldv για εμφάνιση ###################### -->
<div id="modal_del_coldv" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
		<span id="del_button_coldv"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

