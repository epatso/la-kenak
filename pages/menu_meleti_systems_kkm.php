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
			<div id="aerp_table"></div>
			<div id="aerp_info"></div>
			<script>
			get_aerp();
			
			//Εμφάνιση πίνακα με όλες τις μονάδες παραγωγής του χρήστη
			function get_aerp(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getaerp=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("aerp_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function aerp_getzones(zone_id){
			var prefix = "editaerp_";
			
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
			function form_aerp(id){
			var prefix = "editaerp_";

				if(id==0){
				aerp_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"type").value = "";
				document.getElementById(prefix+"active_h").checked = false;
				document.getElementById(prefix+"f_h").value = "";
				document.getElementById(prefix+"r_h").value = "";
				document.getElementById(prefix+"q_r_h").value = "";
				document.getElementById(prefix+"active_c").checked = false;
				document.getElementById(prefix+"f_c").value = "";
				document.getElementById(prefix+"r_c").value = "";
				document.getElementById(prefix+"q_r_c").value = "";
				document.getElementById(prefix+"active_y").checked = false;
				document.getElementById(prefix+"h_r").value = "";
				document.getElementById(prefix+"filters").checked = false;
				document.getElementById(prefix+"e_vent").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_aerp&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);	
						var ischecked_h;
						var ischecked_c;
						var ischecked_y;
						var ischecked_f;
						
							aerp_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"type").value = arr["type"];
							if(arr["active_h"]==1){ischecked_h=true;}
							if(arr["active_h"]==0){ischecked_h=false;}
							document.getElementById(prefix+"active_h").checked = ischecked_h;
							document.getElementById(prefix+"f_h").value = arr["f_h"];
							document.getElementById(prefix+"r_h").value = arr["r_h"];
							document.getElementById(prefix+"q_r_h").value = arr["q_r_h"];
							if(arr["active_c"]==1){ischecked_c=true;}
							if(arr["active_c"]==0){ischecked_c=false;}
							document.getElementById(prefix+"active_c").checked = ischecked_c;
							document.getElementById(prefix+"f_c").value = arr["f_c"];
							document.getElementById(prefix+"r_c").value = arr["r_c"];
							document.getElementById(prefix+"q_r_c").value = arr["q_r_c"];
							if(arr["active_y"]==1){ischecked_y=true;}
							if(arr["active_y"]==0){ischecked_y=false;}
							document.getElementById(prefix+"active_y").checked = ischecked_y;
							document.getElementById(prefix+"h_r").value = arr["h_r"];
							if(arr["filters"]==1){ischecked_f=true;}
							if(arr["filters"]==0){ischecked_f=false;}
							document.getElementById(prefix+"filters").checked = ischecked_f;
							document.getElementById(prefix+"e_vent").value = arr["e_vent"];
							
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_aerp('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία μηχανικού αερισμού';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_aerp('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη μηχανικού αερισμού';
				}
				document.getElementById("edit_button_aerp").innerHTML = button;
				document.getElementById("edit_header_aerp").innerHTML = edit_header;
				$("#modal_form_aerp").modal("show");
			}
			
			//ΔΙΑΓΡΑΦΗ ΜΟΝΑΔΑΣ ΠΑΡΑΓΩΓΗΣ
			function formdel_aerp(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_aerp('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_aerp").innerHTML = button;
				$("#modal_del_aerp").modal("show");
			}
			
			//Υποβολή της φόρμας για ΜΟΝΑΔΑ ΠΑΡΑΓΩΓΗΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_aerp(id){
			var prefix = "editaerp_";
			var active_h;
			var active_c;
			var active_y;
			var active_f;
			
				var zone_id = document.getElementById(prefix+"zone_id").value;
				var type = document.getElementById(prefix+"type").value;
				
				if(document.getElementById(prefix+"active_h").checked == true){
					active_h = 1;
				}else{
					active_h = 0;
				}
				var f_h = document.getElementById(prefix+"f_h").value;
				var r_h = document.getElementById(prefix+"r_h").value;
				var q_r_h = document.getElementById(prefix+"q_r_h").value;
				
				if(document.getElementById(prefix+"active_c").checked == true){
					active_c = 1;
				}else{
					active_c = 0;
				}
				var f_c = document.getElementById(prefix+"f_c").value;
				var r_c = document.getElementById(prefix+"r_c").value;
				var q_r_c = document.getElementById(prefix+"q_r_c").value;
				
				if(document.getElementById(prefix+"active_y").checked == true){
					active_y = 1;
				}else{
					active_y = 0;
				}
				var h_r = document.getElementById(prefix+"h_r").value;
				
				if(document.getElementById(prefix+"filters").checked == true){
					active_f = 1;
				}else{
					active_f = 0;
				}
				var e_vent = document.getElementById(prefix+"e_vent").value;
				
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_zone_sys_aerp";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+zone_id+","+type+","+active_h+","+f_h+","+r_h+","+q_r_h+","+active_c+","+f_c+","+r_c+","+q_r_c+","+active_y+","+h_r+","+active_f+","+e_vent;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("aerp_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_aerp();
				}}
			}
			
			//Διαγραφή
			function del_aerp(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_aerp&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("aerp_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_aerp();
				}}
			}
			
			</script>

<!-- ###################### Κρυφό modal_form_aerp για εμφάνιση ###################### -->
<div id="modal_form_aerp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_aerp"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="kkm"><td width=30%>Παράμετρος</td><td width=30%>Τιμή</td><td width=50%>Βοηθητικοί υπολογισμοί</td></tr>
		<tr>
			<td>Ζώνη</td>
			<td>
			<select class="form-control input-sm" id="editaerp_zone_id">
				<option value=0></option>
			</select>
			</td>
			<td rowspan="14" style="background-color:#b2cc9e;">
			<span id="editaerp_help"></span>

			</td>
		</tr>
		<tr><td>Τύπος</td><td><input class="form-control input-sm" type="text" id="editaerp_type"></td></tr>
		<tr><td>Τμ. θέρμανσης</td><td><input type="checkbox" id="editaerp_active_h"></td></tr>
		<tr><td>Παροχή αέρα - τμήμα θέρμανσης F_h</td><td><input class="form-control input-sm" type="text" id="editaerp_f_h"></td></tr>
		<tr><td>Συντελεστής ανακυκλοφορίας αέρα - τμήμα θέρμανσης R_h</td><td><input class="form-control input-sm" type="text" id="editaerp_r_h"></td></tr>
		<tr><td>Συντελεστής ανάκτησης θερμότητας - τμήμα θέρμανσης Q_R_h</td><td><input class="form-control input-sm" type="text" id="editaerp_q_r_h"></td></tr>
		<tr><td>Τμ. Ψύξης</td><td><input type="checkbox" id="editaerp_active_c"></td></tr>
		<tr><td>Παροχή αέρα - τμήμα Ψύξης F_h</td><td><input class="form-control input-sm" type="text" id="editaerp_f_c"></td></tr>
		<tr><td>Συντελεστής ανακυκλοφορίας αέρα - τμήμα Ψύξης R_h</td><td><input class="form-control input-sm" type="text" id="editaerp_r_c"></td></tr>
		<tr><td>Συντελεστής ανάκτησης θερμότητας - τμήμα Ψύξης Q_R_h</td><td><input class="form-control input-sm" type="text" id="editaerp_q_r_c"></td></tr>
		<tr><td>Τμ. Ύγρανσης</td><td><input type="checkbox" id="editaerp_active_y"></td></tr>
		<tr><td>Συντελεστής ανάκτησης υγρασίας - τμήμα ύγρανσης H_r</td><td><input class="form-control input-sm" type="text" id="editaerp_h_r"></td></tr>
		<tr><td>Φίλτρα</td><td><input type="checkbox" id="editaerp_filters"></td></tr>
		<tr><td>Ειδική ηλεκτρική ισχύς Ε_vent</td><td><input class="form-control input-sm" type="text" id="editaerp_e_vent"></td></tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_aerp"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_aerp για εμφάνιση ###################### -->
<div id="modal_del_aerp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή μηχανικού αερισμού</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_aerp"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->