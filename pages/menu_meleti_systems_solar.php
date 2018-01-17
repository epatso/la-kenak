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
			<div id="solar_table"></div>
			<div id="solar_info"></div>
			<script>
			get_solar();
			
			//Εμφάνιση πίνακα με όλες τις μονάδες παραγωγής του χρήστη
			function get_solar(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getsolar=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("solar_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function solar_getzones(zone_id){
			var prefix = "editsolar_";
			
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
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές
			function form_solar(id){
			var prefix = "editsolar_";

				if(id==0){
				solar_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"type").selectedIndex = 0;
				document.getElementById(prefix+"active_h").checked = false;
				document.getElementById(prefix+"active_z").checked = false;
				document.getElementById(prefix+"syna").value = "";
				document.getElementById(prefix+"synb").value = "";
				document.getElementById(prefix+"e").value = "";
				document.getElementById(prefix+"g").value = 180;
				document.getElementById(prefix+"b").value = 45;
				document.getElementById(prefix+"fs").value = 1;
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_solar&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);	
						var ischecked_h;
						var ischecked_z;
						
							solar_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"type").selectedIndex = arr["type"];
							if(arr["active_h"]==1){ischecked_h=true;}
							if(arr["active_h"]==0){ischecked_h=false;}
							document.getElementById(prefix+"active_h").checked = ischecked_h;
							if(arr["active_z"]==1){ischecked_z=true;}
							if(arr["active_z"]==0){ischecked_z=false;}
							document.getElementById(prefix+"active_z").checked = ischecked_z;
							document.getElementById(prefix+"syna").value = arr["syna"];
							document.getElementById(prefix+"synb").value = arr["synb"];
							document.getElementById(prefix+"e").value = arr["e"];
							document.getElementById(prefix+"g").value = arr["g"];
							document.getElementById(prefix+"b").value = arr["b"];
							document.getElementById(prefix+"fs").value = arr["fs"];
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_solar('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία ηλιακού';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_solar('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη ηλιακού';
				}
				document.getElementById("edit_button_solar").innerHTML = button;
				document.getElementById("edit_header_solar").innerHTML = edit_header;
				$("#modal_form_solar").modal("show");
			}
			
			//ΔΙΑΓΡΑΦΗ ΜΟΝΑΔΑΣ ΠΑΡΑΓΩΓΗΣ
			function formdel_solar(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_solar('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_solar").innerHTML = button;
				$("#modal_del_solar").modal("show");
			}
			
			//Υποβολή της φόρμας για ΜΟΝΑΔΑ ΠΑΡΑΓΩΓΗΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_solar(id){
			var prefix = "editsolar_";
			var active_h;
			var active_z;
			
				var zone_id = document.getElementById(prefix+"zone_id").value;
				var type = document.getElementById(prefix+"type").selectedIndex;
				if(document.getElementById(prefix+"active_h").checked == true){
					active_h = 1;
				}else{
					active_h = 0;
				}
				if(document.getElementById(prefix+"active_z").checked == true){
					active_z = 1;
				}else{
					active_z = 0;
				}
				var syna = document.getElementById(prefix+"syna").value;
				var synb = document.getElementById(prefix+"synb").value;
				var e = document.getElementById(prefix+"e").value;
				var g = document.getElementById(prefix+"g").value;
				var b = document.getElementById(prefix+"b").value;
				var fs = document.getElementById(prefix+"fs").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_zone_sys_solar";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+zone_id+","+type+","+active_h+","+active_z+","+syna+","+synb+","+e+","+g+","+b+","+fs;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("solar_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_solar();
				}}
			}
			
			//Διαγραφή
			function del_solar(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_solar&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("solar_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_solar();
				}}
			}
			
			function get_syna(){
				var solar_xrisi = document.getElementById('editsolar_helpxrisi').value;
				var solar_type = document.getElementById('editsolar_type').value;
				if(solar_type<1){solar_type=1;}
				if(solar_type>3){solar_type=3;}
				var solar_deg = document.getElementById('editsolar_b').value;
				var solar_place = document.getElementById('editsolar_helpplace').value;
				
				var katastasi;
				var solar_katastasi = document.getElementById('editsolar_helpkatastasi').checked;
				if(solar_katastasi == true){
					katastasi = 0.8;
				}else{
					katastasi = 1;
				}
				
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_calc.php?solar_xrisi="+solar_xrisi+"&solar_type="+solar_type+"&solar_deg="+solar_deg+"&solar_place="+solar_place ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					var syna = xmlhttp.responseText;
					syna = syna * katastasi;
					var syna100 = number_format(syna*100,3);
					document.getElementById("editsolar_syna").value=number_format(syna,3);
					var result ="Ο ηλιακός συλλέκτης αξιοποιεί το "+syna100+"% της προσπίπτουσας ηλιακής ακτινοβολίας για ΖΝΧ<br/>";
					if(syna100<=96){
					result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-success\" style=\"width: "+syna100+"%;\">"+syna100+"%</div></div>";
					}else{
					result +="<div class=\"progress progress-striped active\"><div class=\"progress-bar progress-bar-success\" style=\"width: "+syna100+"%;\"></div></div>";
					}
					document.getElementById("solar_bar").innerHTML = result;
				}}
			}
			</script>

<!-- ###################### Κρυφό modal_form_solar για εμφάνιση ###################### -->
<div id="modal_form_solar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_solar"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="solar"><td width=30%>Παράμετρος</td><td width=30%>Τιμή</td><td width=50%>Υπολογισμός συντελεστή αξιοποίησης</td></tr>
		<tr>
			<td>Ζώνη</td>
			<td>
			<select class="form-control input-sm" id="editsolar_zone_id">
				<option value=0></option>
			</select>
			</td>
			<td rowspan="9" style="background-color:#b9e5d2;">
				<table class="table table-bordered" style="background-color:#b9e5d2;">
				<tr>
				<td>Χρήση κτιρίου</td>
				<td>
					<select class="form-control" id="editsolar_helpxrisi" onchange=get_syna(); >
					<option value=1>Κατοικίες</option>
					<option value=2>Τριτογενής τομέας</option>
					</select>
				</td>
				</tr>
				<tr>
					<td>Περιοχή εγκατάστασης (κοντινότερη)</td>
				<td>
					<select class="form-control" id="editsolar_helpplace" onchange=get_syna(); >
					<?php
					echo create_select_optionsid("vivliothiki_syna_ktiria","place");
					?>
					</select>
				</td>
				</tr>
				<tr>
					<td>Κατάσταση συλλέκτη</td>
				<td>
					<div class="control-group warning">
					<label class="checkbox"><input id="editsolar_helpkatastasi" type="checkbox" value="" onclick=get_syna();>
					Κακοσυντηρημένες μονάδες (φθορές στη συλλεκτική επιφάνεια ή διαρροή)</label>
					</div>
				</td>
				</tr>
				</table>
				<div id="solar_bar"></div>
			</td>
		</tr>
		<tr>
			<td>Τύπος</td>
			<td>
			<select class="form-control input-sm" id="editsolar_type" onchange=get_syna();>
			<option value=0>Χωρίς κάλυμα</option>
			<option value=1>Απλός επίπεδος</option>
			<option value=2>Επιλεκτικός επίπεδος</option>
			<option value=3>Κενού</option>
			<option value=4>Συγκεντρωτικός</option>
			</select>
			</td>
		</tr>
		<tr><td>Θέρμανση</td><td><input type="checkbox" id="editsolar_active_h"></td></tr>
		<tr><td>ZNX</td><td><input type="checkbox" id="editsolar_active_z"></td></tr>
		<tr><td>συνα</td><td><input class="form-control input-sm" type="text" id="editsolar_syna"></td></tr>
		<tr><td>συνβ</td><td><input class="form-control input-sm" type="text" id="editsolar_synb"></td></tr>
		<tr><td>Εμβαδόν (Ε)</td><td><input class="form-control input-sm" type="text" id="editsolar_e"></td></tr>
		<tr>
			<td>Προσανατολισμός (γ) <br/><small>(Μελέτη: Προσθέστε εδώ 180 για βέλτιστη τοποθέτηση)</td>
			<td><input class="form-control input-sm" type="text" id="editsolar_g"></td></tr>
		<tr>
			<td>Κλίση (β) <br/><small>(Μελέτη: Προσθέστε εδώ τιμές 0,10,20,30,40,45,50,60,70,80,90)</small></td>
			<td><input class="form-control input-sm" type="text" id="editsolar_b" onchange=get_syna();></td></tr>
		<tr><td>Συντ. σκίασης (Fs)</td><td><input class="form-control input-sm" type="text" id="editsolar_fs"></td></tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_solar"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_solar για εμφάνιση ###################### -->
<div id="modal_del_solar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή ηλιακού</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_solar"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->