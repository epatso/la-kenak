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
			<div id="light_table"></div>
			<div id="light_info"></div>
			<script>
			get_light();
			
			//Εμφάνιση πίνακα με όλες τις μονάδες παραγωγής του χρήστη
			function get_light(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getlight=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("light_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function light_getzones(zone_id){
			var prefix = "editlight_";
			
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
			function form_light(id){
			var prefix = "editlight_";
			var i;

				if(id==0){
					light_getzones();
					document.getElementById(prefix+"zone_id").selectedIndex = 0;
					document.getElementById(prefix+"w").value = "";
					document.getElementById(prefix+"wff").value = "";
					document.getElementById(prefix+"wpar").value = "";
					document.getElementById(prefix+"wffpar").value = "";
					document.getElementById(prefix+"e_per").value = "";
					document.getElementById(prefix+"auto_ff").selectedIndex = 0;
					document.getElementById(prefix+"auto_move").selectedIndex = 0;
					document.getElementById(prefix+"active_heat").checked = false;
					document.getElementById(prefix+"active_safety").checked = false;
					document.getElementById(prefix+"active_backup").checked = false;
					for (i = 0; i <= 6; i++) {
						document.getElementById(prefix+"zoneper"+i).value = "";
						document.getElementById(prefix+"zonem"+i).value = "";
					}
					
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_light&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);	
						var ischecked_heat;
						var ischecked_safety;
						var ischecked_backup;
						
							light_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"w").value = arr["w"];
							document.getElementById(prefix+"wff").value = arr["wff"];
							document.getElementById(prefix+"wpar").value = arr["wpar"];
							document.getElementById(prefix+"wffpar").value = arr["wffpar"];
							document.getElementById(prefix+"e_per").value = arr["e_per"];
							document.getElementById(prefix+"auto_ff").selectedIndex = arr["auto_ff"];
							document.getElementById(prefix+"auto_move").selectedIndex = arr["auto_move"];
							if(arr["active_heat"]==1){ischecked_heat=true;}
							if(arr["active_heat"]==0){ischecked_heat=false;}
							document.getElementById(prefix+"active_heat").checked = ischecked_heat;
							if(arr["active_safety"]==1){ischecked_safety=true;}
							if(arr["active_safety"]==0){ischecked_safety=false;}
							document.getElementById(prefix+"active_safety").checked = ischecked_safety;
							if(arr["active_backup"]==1){ischecked_backup=true;}
							if(arr["active_backup"]==0){ischecked_backup=false;}
							document.getElementById(prefix+"active_backup").checked = ischecked_backup;
							
							var zoneper = arr["zoneper"].split("^");
							var zonem = arr["zonem"].split("^");
							for (i = 0; i <= 6; i++) {
								document.getElementById(prefix+"zoneper"+i).value = zoneper[i];
								document.getElementById(prefix+"zonem"+i).value = zonem[i];
							}
							light_pertotal();
							find_zone_e(arr["zone_id"]);
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_light('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία φωτισμού';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_light('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη φωτισμού';
				}
				document.getElementById("edit_button_light").innerHTML = button;
				document.getElementById("edit_header_light").innerHTML = edit_header;
				$("#modal_form_light").modal("show");
			}
			
			//ΔΙΑΓΡΑΦΗ ΜΟΝΑΔΑΣ ΠΑΡΑΓΩΓΗΣ
			function formdel_light(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_light('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_light").innerHTML = button;
				$("#modal_del_light").modal("show");
			}
			
			//Υποβολή της φόρμας για ΜΟΝΑΔΑ ΠΑΡΑΓΩΓΗΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_light(id){
			var prefix = "editlight_";
			var active_heat;
			var active_safety;
			var active_backup;
			var zoneper="";
			var zonem="";
			var i;
			
				var zone_id = document.getElementById(prefix+"zone_id").value;
				var w = document.getElementById(prefix+"w").value;
				var wff = document.getElementById(prefix+"wff").value;
				var wpar = document.getElementById(prefix+"wpar").value;
				var wffpar = document.getElementById(prefix+"wffpar").value;
				var e_per = document.getElementById(prefix+"e_per").value;
				var auto_ff = document.getElementById(prefix+"auto_ff").selectedIndex;
				var auto_move = document.getElementById(prefix+"auto_move").selectedIndex;
				if(document.getElementById(prefix+"active_heat").checked == true){
					active_heat = 1;
				}else{
					active_heat = 0;
				}
				if(document.getElementById(prefix+"active_safety").checked == true){
					active_safety = 1;
				}else{
					active_safety = 0;
				}
				if(document.getElementById(prefix+"active_backup").checked == true){
					active_backup = 1;
				}else{
					active_backup = 0;
				}
				for (i = 0; i <= 6; i++) {
					zoneper=zoneper+document.getElementById(prefix+"zoneper"+i).value+"^";
					zonem=zonem+document.getElementById(prefix+"zonem"+i).value+"^";
				}
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_zone_sys_light";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+zone_id+","+w+","+e_per+","+auto_ff+","+auto_move+","+active_heat+","+active_safety+","+active_backup+",";
				link += wff+","+wpar+","+wffpar+","+zoneper+","+zonem;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("light_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_light();
				}}
			}
			
			//Διαγραφή
			function del_light(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_light&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("light_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_light();
				}}
			}
			
			function find_zone_e(id){
				var prefix = "editlight_";
				document.getElementById('wait').style.display="inline";
				
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.open("GET","includes/functions_meleti_systems.php?systems_zonee=1&id="+id ,true);
				xmlhttp.send();
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					
					document.getElementById(prefix+"zonem_t").value =xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
				}}
			}
			
			function light_pertotal(){
				var prefix = "editlight_";
				var per=0;
				for (i = 0; i <= 6; i++) {
					per=per+(document.getElementById(prefix+"zoneper"+i).value*1);
				}
				document.getElementById(prefix+"zoneper_t").value=number_format(per,2);
			}
			
			function light_zoneper(z){
				var prefix = "editlight_";
				var zonem=document.getElementById(prefix+"zonem"+z).value;
				var totalm=document.getElementById(prefix+"zonem_t").value;
				var per = (zonem/totalm)*100;
				document.getElementById(prefix+"zoneper"+z).value=number_format(per,2);
				light_pertotal();
			}
			
			
			
			</script>

<!-- ###################### Κρυφό modal_form_light για εμφάνιση ###################### -->
<div id="modal_form_light" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_light"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="success"><td width=30%>Παράμετρος</td><td width=30%>Τιμή</td><td width=50%>Ζώνες τεχνητού φωτισμού</td></tr>
		<tr>
			<td>Ζώνη</td>
			<td>
			<select class="form-control input-sm" id="editlight_zone_id" onchange=find_zone_e(document.getElementById("editlight_zone_id").value);>
				<option value=0></option>
			</select>
			</td>
			<td rowspan="9" style="background-color:#dff0d8;">
				
				<table class="table table-bordered table-condensed">
					<tr class="success"><td width=40%>Στάθμη φωτισμού (lx)</td><td width=30%>m<sup>2</sup></td><td width=30%>%</td></tr>
					<tr>
						<td>1000</td>
						<td><input class="form-control input-sm" type="text" id="editlight_zonem0" onkeyup=light_zoneper(0);></td>
						<td><input class="form-control input-sm" type="text" id="editlight_zoneper0"></td>
					</tr>
					<tr>
						<td>500</td>
						<td><input class="form-control input-sm" type="text" id="editlight_zonem1" onkeyup=light_zoneper(1);></td>
						<td><input class="form-control input-sm" type="text" id="editlight_zoneper1"></td>
					</tr>
					<tr>
						<td>400</td>
						<td><input class="form-control input-sm" type="text" id="editlight_zonem2" onkeyup=light_zoneper(2);></td>
						<td><input class="form-control input-sm" type="text" id="editlight_zoneper2"></td>
					</tr>
					<tr>
						<td>300</td>
						<td><input class="form-control input-sm" type="text" id="editlight_zonem3" onkeyup=light_zoneper(3);></td>
						<td><input class="form-control input-sm" type="text" id="editlight_zoneper3"></td>
					</tr>
					<tr>
						<td>250</td>
						<td><input class="form-control input-sm" type="text" id="editlight_zonem4" onkeyup=light_zoneper(4);></td>
						<td><input class="form-control input-sm" type="text" id="editlight_zoneper4"></td>
					</tr>
					<tr>
						<td>200</td>
						<td><input class="form-control input-sm" type="text" id="editlight_zonem5" onkeyup=light_zoneper(5);></td>
						<td><input class="form-control input-sm" type="text" id="editlight_zoneper5"></td>
					</tr>
					<tr>
						<td>100</td>
						<td><input class="form-control input-sm" type="text" id="editlight_zonem6" onkeyup=light_zoneper(6);></td>
						<td><input class="form-control input-sm" type="text" id="editlight_zoneper6"></td>
					</tr>
					<tr>
						<td>Θερμική ζώνη:</td>
						<td><input class="form-control input-sm" type="text" id="editlight_zonem_t" disabled="disabled"></td>
						<td><input class="form-control input-sm" type="text" id="editlight_zoneper_t" disabled="disabled"></td>
					</tr>
				</table>

			</td>
		</tr>
		<tr>
			<td>Ισχύς (kW)</td>
			<td><input class="form-control input-sm" type="text" id="editlight_w"></td>
		</tr>
		<tr>
			<td>Εγκατεστημένη ισχύς που ελέγχεται μόνο με αισθητήρες ΦΦ (kW)</td>
			<td><input class="form-control input-sm" type="text" id="editlight_wff"></td>
		</tr>
		<tr>
			<td>Εγκατεστημένη ισχύς που ελέγχεται μόνο με αισθητήρες παρουσίας (kW)</td>
			<td><input class="form-control input-sm" type="text" id="editlight_wpar"></td>
		</tr>
		<tr>
			<td>Εγκατεστημένη ισχύς που ελέγχεται μόνο με αισθητήρες ΦΦ και παρουσίας (kW)</td>
			<td><input class="form-control input-sm" type="text" id="editlight_wffpar"></td>
		</tr>
		<tr>
			<td>Περιοχή φυσικού φωτισμού (%)</td>
			<td><input class="form-control input-sm" type="text" id="editlight_e_per">
		</td>
		<tr>
			<td>Αυτοματισμοί ελέγχου ΦΦ</td>
			<td>
			<select class="form-control input-sm" id="editlight_auto_ff">
			<option value=0>1. Αυτόματος</option>
			<option value=1>2. Χειροκίνητος</option>
			</select>
			</td>
		</tr>
		<tr>
			<td>Αυτοματισμοί ανίχνευσης κίνησης</td>
			<td>
			<select class="form-control input-sm" id="editlight_auto_move">
			<option value=0>1. Χειροκίνητος διακόπτης (αφής/σβέσης)</option>
			<option value=1>2. Ανίχνευση με αυτόματη έναυση και σβέση</option>
			<option value=2>3. Ανίχνευση με χειροκίνητη έναυση / αυτόματη σβέση</option>
			</select>
			</td>
		</tr>
		<tr><td>Σύστημα απομάκρυνσης θερμότητας</td><td><input type="checkbox" id="editlight_active_heat"></td></tr>
		<tr><td>Φωτισμός ασφαλείας</td><td><input type="checkbox" id="editlight_active_safety"></td></tr>
		<tr><td>Σύστημα εφεδρείας</td><td><input type="checkbox" id="editlight_active_backup"></td></tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_light"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_light για εμφάνιση ###################### -->
<div id="modal_del_light" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή συστήματος φωτισμού</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_light"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->