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
			<div id="znxp_table"></div>
			<div id="znxp_info"></div>
			<script>
			get_znxp();
			
			//Εμφάνιση πίνακα με όλες τις μονάδες παραγωγής του χρήστη
			function get_znxp(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getznxp=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("znxp_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function znxp_getzones(zone_id){
			var prefix = "editznxp_";
			
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
			function form_znxp(id){
			var prefix = "editznxp_";

				if(id==0){
				znxp_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"type").selectedIndex = 0;
				znxp_changetype();
				document.getElementById(prefix+"pigi").selectedIndex = 3;
				document.getElementById(prefix+"w").value = "";
				document.getElementById(prefix+"n").value = "";
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
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_znxp&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);	
							
							znxp_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"type").selectedIndex = arr["type"];
							znxp_changetype();
							document.getElementById(prefix+"pigi").selectedIndex = arr["pigi"];
							document.getElementById(prefix+"w").value = arr["w"];
							document.getElementById(prefix+"n").value = arr["n"];
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
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_znxp('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία μονάδας παραγωγής';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_znxp('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη μονάδας παραγωγής';
				}
				document.getElementById("edit_button_znxp").innerHTML = button;
				document.getElementById("edit_header_znxp").innerHTML = edit_header;
				$("#modal_form_znxp").modal("show");
			}
			
			//ΔΙΑΓΡΑΦΗ ΜΟΝΑΔΑΣ ΠΑΡΑΓΩΓΗΣ
			function formdel_znxp(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_znxp('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_znxp").innerHTML = button;
				$("#modal_del_znxp").modal("show");
			}
			
			//Υποβολή της φόρμας για ΜΟΝΑΔΑ ΠΑΡΑΓΩΓΗΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_znxp(id){
			var prefix = "editznxp_";
				var zone_id = document.getElementById(prefix+"zone_id").value;
				var type = document.getElementById(prefix+"type").value;
				var pigi = document.getElementById(prefix+"pigi").value;
				var w = document.getElementById(prefix+"w").value;
				var n = document.getElementById(prefix+"n").value;
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
				link += "&table=meletes_zone_sys_znxp";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+zone_id+","+type+","+pigi+","+w+","+n+","+jan+","+feb+","+mar+","+apr+","+may+","+jun+","+jul+","+aug+","+sep+","+okt+","+nov+","+dec;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("znxp_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_znxp();
				}}
			}
			
			//Διαγραφή
			function del_znxp(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_znxp&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("znxp_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_znxp();
				}}
			}
			
			function znxp_changetype(){
			var prefix = "editznxp_";
			var type = document.getElementById(prefix+"type").value;
				for (var i=0;i<=6;i++){
					document.getElementById(prefix+"help"+i).style.display="none";
					}
				document.getElementById(prefix+"help"+type).style.display="inline";

			}
			</script>

<!-- ###################### Κρυφό modal_form_znxp για εμφάνιση ###################### -->
<div id="modal_form_znxp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_znxp"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="znx"><td width=30%>Παράμετρος</td><td width=30%>Τιμή</td><td width=50%>Υπολογισμός βαθμ. απόδοσης</td></tr>
		<tr>
			<td>Ζώνη</td>
			<td>
			<select class="form-control input-sm" id="editznxp_zone_id">
				<option value=0></option>
			</select>
			</td>
			<td rowspan="5" style="background-color:#eab1c1;">
			<span id="editznxp_help"></span>
			
			<div id="editznxp_help0" style="display:none;">
				<table class="table table-bordered table-condensed" style="background-color:#eab1c1;">
					<tr class="znx">
					<td colspan="2">Θερμική ισχύς P<sub>n</sub> ZNX</td>
					</tr>
					
					<tr>
					<th>Παράμετρος</th>
					<th>Τιμή</th>
					</tr>
					
					<tr>
					<td>Ζητούμενο ημερήσιο φορτίο V<sub>d</sub> (l/day)</td>
					<td>
						<input class="form-control input-sm" type="text" id="znxp_vd" onkeyup=calc_pn(); />
						<a href="#zitisi_popup" role="button" class="btn btn-warning" data-toggle="modal" title="Υπολογισμός"><i class="glyphicon glyphicon-question-sign"></i></a>
					</td>
					</tr>
					
					<tr>
					<td>Μέσος χρόνος απόδοσης θερμικής ενέργειας H (h)</td>
					<td><input class="form-control" type="text" id="znxp_h" value="5" onkeyup=calc_pn(); /></td>
					</tr>
					
					<tr>
					<td>Θερμοκρασία νερού δικτύου T<sub>1</sub> (<sup>o</sup>C)</td>
					<td>
					<select class="form-control input-sm" id="znxp_zone" onchange="calc_t1();calc_pn();" >
					<option value=0>Ζώνη</option>
					<option value=12.8>Α</option>
					<option value=10.1>Β</option>
					<option value=6.5>Γ</option>
					<option value=4.2>Δ</option>
					</select>
					<input class="form-control" type="text" id="znxp_t1" onkeyup=calc_pn(); /></td>
					</tr>
					
					<tr>
					<td>Θερμοκρασία σχεδιασμού T<sub>2</sub> (<sup>o</sup>C)</td>
					<td><input class="form-control input-sm" type="text" id="znxp_t2" value="45" onkeyup=calc_pn(); /></td>
					</tr>
					
					<tr>
					<td>Χωρητικότητα θερμαντήρα V<sub>store</sub>=V<sub>d</sub>/H (l)</td>
					<td><input class="form-control input-sm" type="text" id="znxp_vstore" disabled="disabled" /></td>
					</tr>
					<tr>
					<td>Ημερήσιο απαιτούμενο θερμικό φορτίο Q<sub>d</sub>=V<sub>d</sub>*(c/3600)*ρ*ΔΤ (kWh/d)</td>
					<td><input class="form-control input-sm" type="text" id="znxp_qd" disabled="disabled" /></td>
					</tr>
					<tr>
					<td>Θερμική ισχύς P<sub>n</sub>=Q<sub>d</sub>/H (KW)</td>
					<td><input class="form-control input-sm" type="text" id="znxp_pn" disabled="disabled" /></td>
					</tr>
				</table>
			</div>

			<div id="editznxp_help1" style="display:none;">
			Τηλεθέρμανση
			</div>
			
			<div id="editznxp_help2" style="display:none;">
			ΣΗΘ
			</div>
			
			<div id="editznxp_help3" style="display:none;">
			Αντλία θερμότητας (Α.Θ.)
			</div>
			
			<div id="editznxp_help4" style="display:none;">
			Τοπικός ηλεκτρικός θερμαντήρας
			</div>
			
			<div id="editznxp_help5" style="display:none;">
			Τοπική μονάδα φυσικού αερίου
			</div>
			
			<div id="editznxp_help6" style="display:none;">
			Μονάδα παραγωγής (κεντρική) άλλου τύπου
			</div>
			
			</td>
		</tr>
		<tr>
			<td>Τύπος</td>
			<td>
			<select class="form-control input-sm" id="editznxp_type" onchange="znxp_changetype();">
			<option value=0>Λέβητας</option>
			<option value=1>Τηλεθέρμανση</option>
			<option value=2>ΣΗΘ</option>
			<option value=3>Αντλία θερμότητας (Α.Θ.)</option>
			<option value=4>Τοπικός ηλεκτρικός θερμαντήρας</option>
			<option value=5>Τοπική μονάδα φυσικού αερίου</option>
			<option value=6>Μονάδα παραγωγής (κεντρική) άλλου τύπου</option>
			</select>
			</td>
		</tr>
		<tr>
			<td>Πηγή ενέργειας</td>
			<td>
			<select class="form-control input-sm" id="editznxp_pigi">
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
			</td>
		</tr>
		<tr><td>Ισχύς (KW)</td><td><input class="form-control input-sm" type="text" id="editznxp_w"></td></tr>
		<tr><td>Βαθμός απόδοσης (n)</td><td><input class="form-control input-sm" type="text" id="editznxp_n"></td></tr>
	</table>
	<font size="1" style="font-size: 2px;">
		<div class="row">
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f67f7f;">I</span>
					<input type="text" class="form-control input-sm" style="background-color:#f67f7f;text-align:center;" id="editznxp_jan">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f89999;">Φ</span>
					<input type="text" class="form-control input-sm" style="background-color:#f89999;text-align:center;" id="editznxp_feb">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f9b2b2;">Μ</span>
					<input type="text" class="form-control input-sm" style="background-color:#f9b2b2;text-align:center;" id="editznxp_mar">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#fbcccc;">Α</span>
					<input type="text" class="form-control input-sm" style="background-color:#fbcccc;text-align:center;" id="editznxp_apr">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#edf6ff;">Μ</span>
					<input type="text" class="form-control input-sm" style="background-color:#edf6ff;text-align:center;" id="editznxp_may">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#e2f0ff;">Ι</span>
					<input type="text" class="form-control input-sm" style="background-color:#e2f0ff;text-align:center;" id="editznxp_jun">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#d7eaff;">Ι</span>
					<input type="text" class="form-control input-sm" style="background-color:#d7eaff;text-align:center;" id="editznxp_jul">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#e2f0ff;">Α</span>
					<input type="text" class="form-control input-sm" style="background-color:#e2f0ff;text-align:center;" id="editznxp_aug">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#edf6ff;">Σ</span>
					<input type="text" class="form-control input-sm" style="background-color:#edf6ff;text-align:center;" id="editznxp_sep">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f9b2b2;">Ο</span>
					<input type="text" class="form-control input-sm" style="background-color:#f9b2b2;text-align:center;" id="editznxp_okt">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f89999;">Ν</span>
					<input type="text" class="form-control input-sm" style="background-color:#f89999;text-align:center;" id="editznxp_nov">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f67f7f;">Δ</span>
					<input type="text" class="form-control input-sm" style="background-color:#f67f7f;text-align:center;" id="editznxp_dec">
				</div>
			</div>
		</div>
		</font>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_znxp"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_znxp για εμφάνιση ###################### -->
<div id="modal_del_znxp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
		<span id="del_button_znxp"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

			<br/>
			<div id="znxd_table"></div>
			<div id="znxd_info"></div>
			
			<script>
			get_znxd();
			
			//Εμφάνιση πίνακα με όλες τις μονάδες παραγωγής του χρήστη
			function get_znxd(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getznxd=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("znxd_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function znxd_getzones(zone_id){
			var prefix = "editznxd_";
			
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
			function form_znxd(id){
			var prefix = "editznxd_";

				if(id==0){
				znxd_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"type").value = "";
				document.getElementById(prefix+"ana").checked = false;
				document.getElementById(prefix+"dieleysi").selectedIndex = 0;
				document.getElementById(prefix+"n").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_znxd&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
						var ischecked;
							
							znxd_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"type").value = arr["type"];
							document.getElementById(prefix+"dieleysi").selectedIndex = arr["dieleysi"];
							document.getElementById(prefix+"n").value = arr["n"];
							if(arr["ana"]==1){ischecked=true;}
							if(arr["ana"]==0){ischecked=false;}
							document.getElementById(prefix+"ana").checked = ischecked;
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
			var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_znxd('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία δικτύου διανομής';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_znxd('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη δικτύου διανομής';
				}
				document.getElementById("edit_button_znxd").innerHTML = button;
				document.getElementById("edit_header_znxd").innerHTML = edit_header;
				$("#modal_form_znxd").modal("show");
			}
			
			//Εμφάνιση διαγραφής
			function formdel_znxd(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_znxd('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_znxd").innerHTML = button;
				$("#modal_del_znxd").modal("show");
			}
			
			//Υποβολή της φόρμας για ΔΙΚΤΥΟ ΔΙΑΝΟΜΗΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_znxd(id){
			var prefix = "editznxd_";
			var ana;
				var zone_id = document.getElementById(prefix+"zone_id").value;
				var type = document.getElementById(prefix+"type").value;
				var dieleysi = document.getElementById(prefix+"dieleysi").selectedIndex;
				var n = document.getElementById(prefix+"n").value;
				if(document.getElementById(prefix+"ana").checked == true){
					ana = 1;
				}else{
					ana = 0;
				}
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_zone_sys_znxd";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+zone_id+","+type+","+ana+","+dieleysi+","+n;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("znxd_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_znxd();
				}}
			}
			
			//Διαγραφή
			function del_znxd(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_znxd&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("znxd_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_znxd();
				}}
			}
			
			function get_znxd_n(){
				var dianomi_znx_lt = document.getElementById('dianomi_znx_lt').value;
				var dianomi_znx_ana = document.getElementById('dianomi_znx_ana').value;
				var dianomi_znx_monwsi = document.getElementById('dianomi_znx_monwsi').value;
				
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_calc.php?dianomi_znx_lt="+dianomi_znx_lt+"&dianomi_znx_ana="+dianomi_znx_ana+"&dianomi_znx_monwsi="+dianomi_znx_monwsi ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					var n = xmlhttp.responseText;
					var n100 = number_format(n*100,2);
					document.getElementById("dianomi_znx_n").value=n;
					document.getElementById("editznxd_n").value=n;
					if(document.getElementById("dianomi_znx_ana").value==1){
						document.getElementById("editznxd_ana").checked = false;
					}
					if(document.getElementById("dianomi_znx_ana").value==2){
						document.getElementById("editznxd_ana").checked = true;
					}
					var result ="Το δίκτυο διανομής αποδίδει στις τερματικές μονάδες το "+n100+"% της θερμικής ενέργειας για τα "+dianomi_znx_lt+"lt ZNX.<br/>";
					if(n100<=96){
					result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-info\" style=\"width: "+n100+"%;\">"+n100+"%</div></div>";
					}else{
					result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-info\" style=\"width: "+n100+"%;\"></div></div>";
					}
					document.getElementById("distribution_bar").innerHTML = result;
				}}
			}
			</script>
<script>
function allow_options(){
var xrisi = document.getElementById('znx_xrisi').value;
var div_klines = document.getElementById('znx_div_klines');
var div_hotel = document.getElementById('znx_div_hotel');
var div_hospital = document.getElementById('znx_div_hospital');
var klines = document.getElementById("znx_klines").value;
var hotel = document.getElementById('znx_hotel_cat').value;
var hospital = document.getElementById('znx_hospital_cat').value;
	
	if(xrisi!=0){
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","includes/functions_calc.php?id_xrisi="+xrisi+"&hotel="+hotel+"&hospital="+hospital ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var arr = JSON.parse(xmlhttp.responseText);
			var has_znx=arr["has_znx"];
			var znx_calc_type=arr["znx_calc_type"];
				if(znx_calc_type==0){//Τρόπος υπολογισμού != δομημένη επιφάνεια
					div_klines.style.display = "none";
					div_hotel.style.display = "none";
					div_hospital.style.display = "none";
				}
				if(znx_calc_type==1){//Τρόπος υπολογισμού = Ξενοδοχεία
					div_klines.style.display = "block";
					div_hotel.style.display = "none";
					div_hospital.style.display = "none";
				}
				if(znx_calc_type==2){//Τρόπος υπολογισμού = Ξενοδοχεία
					div_klines.style.display = "block";
					div_hotel.style.display = "block";
					div_hospital.style.display = "none";
				}
				if(znx_calc_type==3){//Τρόπος υπολογισμού = Νοσοκομεία
					div_klines.style.display = "block";
					div_hotel.style.display = "none";
					div_hospital.style.display = "block";
				}

		}//Return OK
	}//ajax call
	
	}else{//xrisi!=0
		div_klines.style.display = "none";
		div_hotel.style.display = "none";
		div_hospital.style.display = "none";
	}
	get_synth_zwnis();
}

function get_synth_zwnis(){
	var xrisi = document.getElementById('znx_xrisi').value;
	var e = document.getElementById("znx_emvadon").value;
	var klines = document.getElementById("znx_klines").value;
	var hotel = document.getElementById('znx_hotel_cat').value;
	var hospital = document.getElementById('znx_hospital_cat').value;
	
	if(klines==""){klines=0;}
	
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","includes/functions_calc.php?id_xrisi="+xrisi+"&hotel="+hotel+"&hospital="+hospital ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	var arr = JSON.parse(xmlhttp.responseText);
		
		var persons=arr["air_persons"]*(e/100);
		document.getElementById("znx_lt_perperson").value=arr["znx_lt_perperson"]*persons;
		document.getElementById("znx_lt_perm2").value=arr["znx_lt_perm2"]*e;
		document.getElementById("znx_m3_perroom").value=arr["znx_m3_perroom"]*klines;
		document.getElementById("znx_m3_perm2").value=arr["znx_m3_perm2"]*e;
		
		var has_znx=arr["has_znx"];
		var znx_calc_type=arr["znx_calc_type"];
		var znx_calctype_txt,znx,znx_lt;
		if(has_znx!=0){
			if(znx_calc_type==0){
				znx_calctype_txt="Με βάση δομημένη επιφάνεια";
				znx=arr["znx_m3_perm2"]*e;
			}
			if(znx_calc_type==1){
				znx_calctype_txt="Με βάση κλίνες";
				znx=arr["znx_m3_perroom"]*klines;
			}
			if(znx_calc_type==2){
				znx_calctype_txt="Με βάση κλίνες και τύπο ξενοδοχείου";
				znx=arr["znx_m3_perroom"]*klines;
			}
			if(znx_calc_type==3){
				znx_calctype_txt="Με βάση κλίνες και τύπο κλινικής";
				znx=arr["znx_m3_perroom"]*klines;
			}
		}else{
			znx_calctype_txt="Δεν υπάρχει απαίτηση";
			znx=0;
		}
		znx_lt = znx*1000/365
		
		document.getElementById("znxp_vd").value=number_format(znx_lt,3,".","");
		document.getElementById('dianomi_znx_lt').value = number_format(znx_lt,3,".","");
		calc_pn();
		
	}}
}


function calc_t1(){
var t1 = document.getElementById('znxp_zone').value;
	if(t1==0){
		document.getElementById('znxp_t1').disabled = false;
	}else{
		document.getElementById('znxp_t1').disabled = true;
		document.getElementById('znxp_t1').value = t1;
	}
}

function calc_pn(){
var znxp_vd = document.getElementById('znxp_vd').value;
var znxp_h = document.getElementById('znxp_h').value;
var znxp_t1 = document.getElementById('znxp_t1').value;
var znxp_t2 = document.getElementById('znxp_t2').value;

var v_store = znxp_vd/znxp_h;
var qd = znxp_vd*(4.18/3600)*1*(znxp_t2-znxp_t1);
var pn = qd/znxp_h;

document.getElementById('znxp_vstore').value = number_format(v_store,3);
document.getElementById('znxp_qd').value = number_format(qd,3);
document.getElementById('znxp_pn').value = number_format(pn,3);
document.getElementById('editznxp_w').value = number_format(pn,3);
}

</script>
<!-- ###################### Κρυφό modal_form_znxd για εμφάνιση ###################### -->
<div id="modal_form_znxd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_znxd"></span></h6>
	</div>

	<div class="modal-body">	
	<table class="table table-bordered table-condensed">
		<tr class="znx">
		<td width=10%>Παράμετρος</td>
		<td width=40%>Δίκτυο διανομής</td>
		<td width=50%>Βοήθεια</td>
		</tr>
		<tr>
			<td>Ζώνη</td>
			<td>
			<select class="form-control input-sm" id="editznxd_zone_id">
				<option value=0></option>
			</select>
			</td>
			<td rowspan="5" style="background-color:#eab1c1;">
				<table class="table table-bordered" style="background-color:#eab1c1;">
					<tr class="znx">
					<td colspan="2">Βαθμός απόδοσης δικτύου διανομής</td>
					</tr>
					
					<tr>
					<th>Παράμετρος</th>
					<th>Τιμή</th>
					</tr>
					
					<tr>
					<td>
					Ημερήσια ζήτηση ΖΝΧ (lt)
					<a href="#zitisi_popup" role="button" class="btn btn-warning" data-toggle="modal" title="Υπολογισμός"><i class="glyphicon glyphicon-question-sign"></i></a>
					</td>
					<td>
					<input class="form-control" type="text" id="dianomi_znx_lt" onkeyup=get_znxd_n(); />
					</td>
					</tr>
					
					<tr>
					<td>Ανακυκλοφορία</td>
					<td>
					<select class="form-control" id="dianomi_znx_ana" onchange=get_znxd_n(); >
					<option value=0>Επιλέξτε...</option>
					<option value=1>Χωρίς ανακυκλοφορία</option>
					<option value=2>Με ανακυκλοφορία</option>
					</select>
					</td>
					</tr>
					
					<tr>
					<td>Μόνωση</td>
					<td>
					<select class="form-control" id="dianomi_znx_monwsi" onchange=get_znxd_n(); >
					<option value=0>Επιλέξτε...</option>
					<option value=1>Μόνωση κτηρίου αναφοράς</option>
					<option value=2>Ανεπαρκής μόνωση</option>
					<option value=3>Χωρίς μόνωση</option>
					</select>
					</td>
					</tr>
					
					<tr>
					<th>Βαθμός απόδοσης Δικτύου διανομής</th>
					<td>
					<input class="form-control" type="text" id="dianomi_znx_n" disabled="disabled" onchange=get_znxd_n(); />
					</td>
					</tr>
					
				</table>
				<span id="distribution_bar"></span>
			</td>
		</tr>
		<tr>
			<td>Τύπος</td>
			<td><input class="form-control input-sm" type="text" id="editznxd_type"></td>
		</tr>
		<tr>
			<td>Ανακυκλοφορία</td>
			<td><input type="checkbox" id="editznxd_ana"></td>
		</tr>
		<tr>
			<td>Διέλευση</td>
			<td>
			<select class="form-control input-sm" id="editznxd_dieleysi">
			<option value=0>Εσωτερικοί ή έως 20% σε εξωτερικούς</option>
			<option value=1>Πάνω από 20% σε εξωτερικούς</option>
			</select>
			</td>
		</tr>
		<tr>
			<td>Βαθμ. απόδοσης</td>
			<td><input class="form-control input-sm" type="text" id="editznxd_n"></td>
		</tr>
		
	</table>
	<span id="editznxd_zone_id_info"></span>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_znxd"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_znxd για εμφάνιση ###################### -->
<div id="modal_del_znxd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
		<span id="del_button_znxd"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->	
<!-- ###################### Κρυφό zitisi_popup για εμφάνιση ###################### -->
<div id="zitisi_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h4 id="myModalLabel">
		<?php
		echo APPLICATION_NAME." - v.".APPLICATION_VERSION." Ημερήσια κατανάλωση ΖΝΧ";
		?>
		</h4>
	</div>

	<div class="modal-body">
		<p>
			<table class="table table-bordered">
			<tr>
			<td>Επιλέξτε χρήση για τη θερμική ζώνη:</td>
			<td>
			<select class="form-control input-sm" id="znx_xrisi" name="xrisi" onchange="get_synth_zwnis();allow_options();">
				<option value=0>Επιλέξτε χρήση...</option>
				<?php
				echo create_select_optionsid("vivliothiki_conditions_zone","name");
				?>
			</select>
			</td>
			</tr>
			
			<tr>
			<td><span id="emvadon_title">Εμβαδόν θερμικής ζώνης (m<sup>2</sup>):</span></td>
			<td><input class="form-control input-sm" type="text" id="znx_emvadon" onkeyup=get_synth_zwnis(); /></td>
			</tr>
			<tr>
			<td>Επιπλέον επιλογές:</td>
			<td>
				<div class="input-group" id="znx_div_klines" style="display: none;">
				<span class="input-group-addon" style="background-color: #C1FFC1"><i class="fa fa-bed" aria-hidden="true"></i> Κλίνες/ΥΔ</span>
				<input class="form-control" type="text" id="znx_klines" name="klines" onkeyup=get_synth_zwnis(); />
			</div>
			<div class="input-group" id="znx_div_hotel" style="display: none;">
				<span class="input-group-addon" style="background-color: #ffcfdf"><i class="fa fa-plane" aria-hidden="true"></i> Ξενοδοχείο</span>
				<select class="form-control" id="znx_hotel_cat" onchange=get_synth_zwnis();>
					<option value=1>LUX</option>
					<option value=2>Α ή Β</option>
					<option value=3>Γ</option>
				</select>
			</div>
			<div class="input-group" id="znx_div_hospital" style="display: none;">
				<span class="input-group-addon" style="background-color: #eed9fa"><i class="fa fa-hospital-o" aria-hidden="true"></i> Νοσοκομείο</span>
				<select class="form-control" id="znx_hospital_cat" onchange=get_synth_zwnis();>
					<option value=1>Νοσοκομείο <500 κλίνες</option>
					<option value=2>Νοσοκομείο >500 κλίνες</option>
					<option value=3>Κλινική</option>
				</select>
			</div>
			</td>
			</tr>
			<tr>	
				<td>lt/άτομο * άτομα/100m<sup>2</sup> * m<sup>2</sup> [ανά ημέρα]</td>	
				<td><input class="form-control input-sm" type="text" id="znx_lt_perperson" /></td>
			</tr>	
			<tr>	
				<td>lt/m<sup>2</sup> * m<sup>2</sup> [ανά ημέρα]</td>	
				<td><input class="form-control input-sm" type="text" id="znx_lt_perm2" /></td>
			</tr>	
			<tr>	
				<td>m3/κλίνη * κλίνες [ανά έτος]</td>
				<td>
				<input class="form-control input-sm" type="text" id="znx_m3_perroom" />
				</td>
			</tr>
			<tr>	
				<td>m<sup>3</sup>/m<sup>2</sup> * m<sup>2</sup> [ανά έτος]</td>
				<td>
				<input class="form-control input-sm" type="text" id="znx_m3_perm2"/>
				</td>
			</tr>
			</table>
		</p>
	</div>

	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">ΟΚ</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

			<br/>
			<div id="znxt_table"></div>
			<div id="znxt_info"></div>
			
			<script>
			get_znxt();
			
			//Εμφάνιση πίνακα με όλες τις ΤΕΡΜΑΤΙΚΕΣ ΜΟΝΑΔΕΣ του χρήστη
			function get_znxt(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getznxt=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("znxt_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function znxt_getzones(zone_id){
			var prefix = "editznxt_";
			
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
			function form_znxt(id){
			var prefix = "editznxt_";

				if(id==0){
				znxt_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"type").value = "";
				document.getElementById(prefix+"n").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_znxt&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
						var ischecked;
							
							znxt_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"type").value = arr["type"];
							document.getElementById(prefix+"n").value = arr["n"];
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
			var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_znxt('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία αποθηκευτικών μονάδων';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_znxt('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη αποθηκευτικών μονάδων';
				}
				document.getElementById("edit_button_znxt").innerHTML = button;
				document.getElementById("edit_header_znxt").innerHTML = edit_header;
				$("#modal_form_znxt").modal("show");
			}
			
			//Εμφάνιση διαγραφής
			function formdel_znxt(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_znxt('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_znxt").innerHTML = button;
				$("#modal_del_znxt").modal("show");
			}
			
			//Υποβολή της φόρμας για ΤΕΡΜΑΤΙΚΕΣ ΜΟΝΑΔΕΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_znxt(id){
			var prefix = "editznxt_";

				var zone_id = document.getElementById(prefix+"zone_id").value;
				var type = document.getElementById(prefix+"type").value;
				var n = document.getElementById(prefix+"n").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_zone_sys_znxt";
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
					document.getElementById("znxt_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_znxt();
				}}
			}
			
			//Διαγραφή
			function del_znxt(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_znxt&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("znxt_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_znxt();
				}}
			}
			
			function calc_thermikes(){
				var x = document.getElementById('editznxt_type_thermikes').value;
				document.getElementById('editznxt_thermikes').value =x;
				calc_znxa();
			}

			function calc_pleyrikes(){
				var x = document.getElementById('editznxt_type_pleyrikes').value;
				document.getElementById('editznxt_pleyrikes').value =x;
				calc_znxa();
			}

			function calc_znxa(){
				var x = document.getElementById('editznxt_type_thermikes').value;
				var y = document.getElementById('editznxt_type_pleyrikes').value;
				var txt="";
				if(document.getElementById('editznxt_type_thermikes').selectedIndex==1){
					txt+="boiler ";
				}
				if(document.getElementById('editznxt_type_thermikes').selectedIndex==2){
					txt+="θερμοσίφωνας ";
				}
				if(document.getElementById('editznxt_type_pleyrikes').selectedIndex==1){
					txt+="Εσωτερικά";
				}
				if(document.getElementById('editznxt_type_pleyrikes').selectedIndex==2){
					txt+="Εξωτερικά";
				}
				var n = +x + +y;
				var apodosi = 100-n;
				var n_a = (100-n)/100;
				document.getElementById('editznxt_znxa_n').value = n;
				document.getElementById('editznxt_n').value = n_a;
				document.getElementById('editznxt_type').value = txt;
					var result ="Οι αποθηκευτικές μονάδες αποδίδουν το "+apodosi+"% της ισχύος που παραλαμβάνουν<br/>";
					if(apodosi<=96){
					result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-info active\" style=\"width: "+apodosi+"%;\">"+apodosi+"%</div></div>";
					}else{
					result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-info\" style=\"width: "+apodosi+"%;\"></div></div>";
					}
					document.getElementById("termatikes_bar").innerHTML=result;
			}
			</script>
<!-- ###################### Κρυφό modal_form_znxt για εμφάνιση ###################### -->
<div id="modal_form_znxt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_znxt"></span></h6>
	</div>

	<div class="modal-body">	
	<table class="table table-bordered table-condensed">
		<tr class="znx">
		<td width=25%>Παράμετρος</td>
		<td width=25%>Τιμή</td>
		<td width=50%>Βοήθεια</td>
		</tr>
		<tr>
			<td>Ζώνη</td>
			<td>
			<select class="form-control input-sm" id="editznxt_zone_id">
				<option value=0></option>
			</select>
			</td>
			<td rowspan="4" style="background-color:#eab1c1;">
				<table class="table table-bordered table-condensed" style="background-color:#eab1c1;">
					<tr class="znx">
					<td colspan="4">Βαθμός απόδοσης τερματικών μονάδων</td>
					</tr>
					
					<tr>
					<th>Παράμετρος</th>
					<th>Υπολογισμός</th>
					<th>Απώλειες [%]</th>
					</tr>
					
					<tr>
					<td>
					Θερμικές απώλειες
					</td>
					<td>
					<select class="form-control" id="editznxt_type_thermikes" onchange=calc_thermikes(); >
					<option value=0>Επιλέξτε...</option>
					<option value=5>Τοπικοί ή κεντρικοί θερμαντήρες (boiler με εναλλάκτη)</option>
					<option value=0>Ηλεκτρικοί θερμαντήρες (θερμοσίφωνες)</option>
					</select>
					</td>
					<td><input class="form-control" type="text" id="editznxt_thermikes" disabled="disabled" /></td>
					</tr>
					
					
					<tr>
					<td>
					Πλευρικές απώλειες
					</td>
					<td>
					<select class="form-control" id="editznxt_type_pleyrikes" onchange=calc_pleyrikes(); >
					<option value=0>Επιλέξτε...</option>
					<option value=2>Εσωτερικά</option>
					<option value=7>Εξωτερικά</option>
					</select>
					</td>
					<td><input class="form-control" type="text" id="editznxt_pleyrikes" disabled="disabled" /></td>
					</tr>
					
					<tr>
					<td colspan="2">
					Σύνολο απωλειών
					</td>
					<td><input class="form-control" type="text" id="editznxt_znxa_n" disabled="disabled" /></td>
					</tr>
					
				</table>
				<div id="termatikes_bar"></div>
			</td>
		</tr>
		<tr>
			<td>Τύπος <br/><small>Μελέτη: Προσθέστε εδώ τον όγκο σε λίτρα του δοχείου αποθήκευσης</small></td>
			<td><input class="form-control input-sm" type="text" id="editznxt_type"></td>
		</tr>
		<tr>
			<td>Βαθμ. απόδοσης</td>
			<td><input class="form-control input-sm" type="text" id="editznxt_n"></td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_znxt"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_znxt για εμφάνιση ###################### -->
<div id="modal_del_znxt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή μονάδας αποθήκευσης</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_znxt"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

			<br/>
			<div id="znxv_table"></div>
			<div id="znxv_info"></div>
			
			<script>
			get_znxv();
			
			//Εμφάνιση πίνακα με όλες τις ΒΟΗΘΗΤΙΚΕΣ ΜΟΝΑΔΕΣ του χρήστη
			function get_znxv(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getznxv=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("znxv_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function znxv_getzones(zone_id){
			var prefix = "editznxv_";
			
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
			function form_znxv(id){
			var prefix = "editznxv_";

				if(id==0){
				znxv_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"type").selectedIndex = "";
				document.getElementById(prefix+"n").value = "";
				document.getElementById(prefix+"w").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_znxv&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
							
							znxv_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"type").selectedIndex = arr["type"];
							document.getElementById(prefix+"n").value = arr["n"];
							document.getElementById(prefix+"w").value = arr["w"];
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
			var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_znxv('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία βοηθητικών μονάδων';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_znxv('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη βοηθητικών μονάδων';
				}
				document.getElementById("edit_button_znxv").innerHTML = button;
				document.getElementById("edit_header_znxv").innerHTML = edit_header;
				$("#modal_form_znxv").modal("show");
			}
			
			//Εμφάνιση διαγραφής
			function formdel_znxv(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_znxv('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_znxv").innerHTML = button;
				$("#modal_del_znxv").modal("show");
			}
			
			//Υποβολή της φόρμας για ΒΟΗΘΗΤΙΚΕΣ ΜΟΝΑΔΕΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_znxv(id){
			var prefix = "editznxv_";

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
				link += "&table=meletes_zone_sys_znxv";
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
					document.getElementById("znxv_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_znxv();
				}}
			}
			
			//Διαγραφή
			function del_znxv(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_znxv&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("znxv_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_znxv();
				}}
			}
			
			</script>
<!-- ###################### Κρυφό modal_form_znxv για εμφάνιση ###################### -->
<div id="modal_form_znxv" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_znxv"></span></h6>
	</div>

	<div class="modal-body">	
	<table class="table table-bordered table-condensed">
		<tr class="znx">
		<td width=25%>Παράμετρος</td>
		<td width=25%>Τιμή</td>
		<td width=50%>Βοήθεια</td>
		</tr>
		<tr>
			<td>Ζώνη</td>
			<td>
			<select class="form-control input-sm" id="editznxv_zone_id">
				<option value=0></option>
			</select>
			</td>
			<td rowspan="4" style="background-color:#eab1c1;">
				ΠΡΟΣΟΧΗ:
				Οι τιμές εισάγονται σε KW. 
			</td>
		</tr>
		<tr>
			<td>Τύπος</td>
			<td>
				<select class="form-control input-sm" id="editznxv_type">
					<option value=0>Αντλίες</option>
					<option value=1>Κυκλοφορητές</option>
					<option value=2>Ηλεκτροβάνες</option>
					<option value=3>Άλλου τύπου</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Πλήθος</td>
			<td><input class="form-control input-sm" type="text" id="editznxv_n"></td>
		</tr>
		<tr>
			<td>Ισχύς (KW)</td>
			<td><input class="form-control input-sm" type="text" id="editznxv_w"></td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_znxv"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_znxv για εμφάνιση ###################### -->
<div id="modal_del_znxv" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
		<span id="del_button_znxv"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

