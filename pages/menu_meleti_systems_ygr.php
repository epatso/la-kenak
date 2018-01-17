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
			<div id="ygrp_table"></div>
			<div id="ygrp_info"></div>
			<script>
			get_ygrp();
			
			//Εμφάνιση πίνακα με όλες τις μονάδες παραγωγής του χρήστη
			function get_ygrp(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getygrp=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("ygrp_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function ygrp_getzones(zone_id){
			var prefix = "editygrp_";
			
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
			function form_ygrp(id){
			var prefix = "editygrp_";

				if(id==0){
				ygrp_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"type").selectedIndex = 0;
				ygrp_changetype();
				document.getElementById(prefix+"pigi").selectedIndex = 0;
				document.getElementById(prefix+"w").value = "";
				document.getElementById(prefix+"n").value = "";
				document.getElementById(prefix+"jan").value = "";
				document.getElementById(prefix+"feb").value = "";
				document.getElementById(prefix+"mar").value = "";
				document.getElementById(prefix+"apr").value = "";
				document.getElementById(prefix+"may").value = "";
				document.getElementById(prefix+"jun").value = "";
				document.getElementById(prefix+"jul").value = "";
				document.getElementById(prefix+"aug").value = "";
				document.getElementById(prefix+"sep").value = "";
				document.getElementById(prefix+"okt").value = "";
				document.getElementById(prefix+"nov").value = "";
				document.getElementById(prefix+"dec").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_ygrp&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);	
							
							ygrp_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"type").selectedIndex = arr["type"];
							ygrp_changetype();
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
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_ygrp('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία μονάδας παραγωγής';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_ygrp('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη μονάδας παραγωγής';
				}
				document.getElementById("edit_button_ygrp").innerHTML = button;
				document.getElementById("edit_header_ygrp").innerHTML = edit_header;
				$("#modal_form_ygrp").modal("show");
			}
			
			//ΔΙΑΓΡΑΦΗ ΜΟΝΑΔΑΣ ΠΑΡΑΓΩΓΗΣ
			function formdel_ygrp(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_ygrp('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_ygrp").innerHTML = button;
				$("#modal_del_ygrp").modal("show");
			}
			
			//Υποβολή της φόρμας για ΜΟΝΑΔΑ ΠΑΡΑΓΩΓΗΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_ygrp(id){
			var prefix = "editygrp_";
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
				link += "&table=meletes_zone_sys_ygrp";
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
					document.getElementById("ygrp_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_ygrp();
				}}
			}
			
			//Διαγραφή
			function del_ygrp(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_ygrp&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("ygrp_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_ygrp();
				}}
			}
			
			function ygrp_changetype(){
			var prefix = "editygrp_";
			var type = document.getElementById(prefix+"type").value;
				for (var i=0;i<=3;i++){
					document.getElementById(prefix+"help"+i).style.display="none";
					}
				document.getElementById(prefix+"help"+type).style.display="inline";

			}
			</script>

<!-- ###################### Κρυφό modal_form_ygrp για εμφάνιση ###################### -->
<div id="modal_form_ygrp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_ygrp"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="success"><td width=30%>Παράμετρος</td><td width=30%>Τιμή</td><td width=50%>Υπολογισμός βαθμ. απόδοσης</td></tr>
		<tr>
			<td>Ζώνη</td>
			<td>
			<select class="form-control input-sm" id="editygrp_zone_id">
				<option value=0></option>
			</select>
			</td>
			<td rowspan="5" style="background-color:#dff0d8;">
			<span id="editygrp_help"></span>
			
			<div id="editygrp_help0" style="display:none;">
			Ατμολέβητας κεντρικής παροχής
			</div>

			<div id="editygrp_help1" style="display:none;">
			Τοπική μονάδα ψεκασμού
			</div>
			
			<div id="editygrp_help2" style="display:none;">
			Τοπική μονάδα παραγωγής ατμού
			</div>
			
			<div id="editygrp_help3" style="display:none;">
			Τοπική μονάδα άλλου τύπου
			</div>
			
			</td>
		</tr>
		<tr>
			<td>Τύπος</td>
			<td>
			<select class="form-control input-sm" id="editygrp_type" onchange="ygrp_changetype();">
			<option value=0>Ατμολέβητας κεντρικής παροχής</option>
			<option value=1>Τοπική μονάδα ψεκασμού</option>
			<option value=2>Τοπική μονάδα παραγωγής ατμού</option>
			<option value=3>Τοπική μονάδα άλλου τύπου</option>
			</select>
			</td>
		</tr>
		<tr>
			<td>Πηγή ενέργειας</td>
			<td>
			<select class="form-control input-sm" id="editygrp_pigi">
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
		<tr><td>Ισχύς (KW)</td><td><input class="form-control input-sm" type="text" id="editygrp_w"></td></tr>
		<tr><td>Βαθμός απόδοσης (n)</td><td><input class="form-control input-sm" type="text" id="editygrp_n"></td></tr>
	</table>
	<font size="1" style="font-size: 2px;">
		<div class="row">
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f67f7f;">I</span>
					<input type="text" class="form-control input-sm" style="background-color:#f67f7f;text-align:center;" id="editygrp_jan">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f89999;">Φ</span>
					<input type="text" class="form-control input-sm" style="background-color:#f89999;text-align:center;" id="editygrp_feb">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f9b2b2;">Μ</span>
					<input type="text" class="form-control input-sm" style="background-color:#f9b2b2;text-align:center;" id="editygrp_mar">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#fbcccc;">Α</span>
					<input type="text" class="form-control input-sm" style="background-color:#fbcccc;text-align:center;" id="editygrp_apr">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#edf6ff;">Μ</span>
					<input type="text" class="form-control input-sm" style="background-color:#edf6ff;text-align:center;" id="editygrp_may">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#e2f0ff;">Ι</span>
					<input type="text" class="form-control input-sm" style="background-color:#e2f0ff;text-align:center;" id="editygrp_jun">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#d7eaff;">Ι</span>
					<input type="text" class="form-control input-sm" style="background-color:#d7eaff;text-align:center;" id="editygrp_jul">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#e2f0ff;">Α</span>
					<input type="text" class="form-control input-sm" style="background-color:#e2f0ff;text-align:center;" id="editygrp_aug">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#edf6ff;">Σ</span>
					<input type="text" class="form-control input-sm" style="background-color:#edf6ff;text-align:center;" id="editygrp_sep">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f9b2b2;">Ο</span>
					<input type="text" class="form-control input-sm" style="background-color:#f9b2b2;text-align:center;" id="editygrp_okt">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f89999;">Ν</span>
					<input type="text" class="form-control input-sm" style="background-color:#f89999;text-align:center;" id="editygrp_nov">
				</div>
			</div>
			<div class="col-md-1">
				<div class="input-group">
				<span class="input-group-addon" style="background-color:#f67f7f;">Δ</span>
					<input type="text" class="form-control input-sm" style="background-color:#f67f7f;text-align:center;" id="editygrp_dec">
				</div>
			</div>
		</div>
		</font>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_ygrp"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_ygrp για εμφάνιση ###################### -->
<div id="modal_del_ygrp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
		<span id="del_button_ygrp"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

			<br/>
			<div id="ygrd_table"></div>
			<div id="ygrd_info"></div>
			
			<script>
			get_ygrd();
			
			//Εμφάνιση πίνακα με όλες τις μονάδες παραγωγής του χρήστη
			function get_ygrd(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getygrd=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("ygrd_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function ygrd_getzones(zone_id){
			var prefix = "editygrd_";
			
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
			function form_ygrd(id){
			var prefix = "editygrd_";

				if(id==0){
				ygrd_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"type").value = "";
				document.getElementById(prefix+"dieleysi").selectedIndex = 0;
				document.getElementById(prefix+"n").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_ygrd&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
							
							ygrd_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"type").value = arr["type"];
							document.getElementById(prefix+"dieleysi").selectedIndex = arr["dieleysi"];
							document.getElementById(prefix+"n").value = arr["n"];
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
			var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_ygrd('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία δικτύου διανομής';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_ygrd('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη δικτύου διανομής';
				}
				document.getElementById("edit_button_ygrd").innerHTML = button;
				document.getElementById("edit_header_ygrd").innerHTML = edit_header;
				$("#modal_form_ygrd").modal("show");
			}
			
			//Εμφάνιση διαγραφής
			function formdel_ygrd(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_ygrd('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_ygrd").innerHTML = button;
				$("#modal_del_ygrd").modal("show");
			}
			
			//Υποβολή της φόρμας για ΔΙΚΤΥΟ ΔΙΑΝΟΜΗΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_ygrd(id){
			var prefix = "editygrd_";
			var a_insulation;
				var zone_id = document.getElementById(prefix+"zone_id").value;
				var type = document.getElementById(prefix+"type").value;
				var dieleysi = document.getElementById(prefix+"dieleysi").selectedIndex;
				var n = document.getElementById(prefix+"n").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_zone_sys_ygrd";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+zone_id+","+type+","+dieleysi+","+n;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("ygrd_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_ygrd();
				}}
			}
			
			//Διαγραφή
			function del_ygrd(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_ygrd&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("ygrd_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_ygrd();
				}}
			}
			</script>
<!-- ###################### Κρυφό modal_form_ygrd για εμφάνιση ###################### -->
<div id="modal_form_ygrd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_ygrd"></span></h6>
	</div>

	<div class="modal-body">	
	<table class="table table-bordered table-condensed">
		<tr class="success">
		<td width=10%>Παράμετρος</td>
		<td width=40%>Δίκτυο διανομής</td>
		<td width=50%>Βοήθεια</td>
		</tr>
		<tr>
			<td>Ζώνη</td>
			<td>
			<select class="form-control input-sm" id="editygrd_zone_id">
				<option value=0></option>
			</select>
			</td>
			<td rowspan="4" style="background-color:#dff0d8;">
			Κείμενο βοήθειας
			</td>
		</tr>
		<tr>
			<td>Τύπος</td>
			<td><input class="form-control input-sm" type="text" id="editygrd_type"></td>
		</tr>
		<tr>
			<td>Διέλευση</td>
			<td>
			<select class="form-control input-sm" id="editygrd_dieleysi">
			<option value=0>Εσωτερικοί ή έως 20% σε εξωτερικούς</option>
			<option value=1>Πάνω από 20% σε εξωτερικούς</option>
			</select>
			</td>
		</tr>
		<tr>
			<td>Βαθμ. απόδοσης</td>
			<td><input class="form-control input-sm" type="text" id="editygrd_n"></td>
		</tr>
		
	</table>
	<span id="editygrd_zone_id_info"></span>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_ygrd"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_ygrd για εμφάνιση ###################### -->
<div id="modal_del_ygrd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
		<span id="del_button_ygrd"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->	

			<br/>
			<div id="ygrt_table"></div>
			<div id="ygrt_info"></div>
			
			<script>
			get_ygrt();
			
			//Εμφάνιση πίνακα με όλες τις ΤΕΡΜΑΤΙΚΕΣ ΜΟΝΑΔΕΣ του χρήστη
			function get_ygrt(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?getygrt=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("ygrt_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			
			//Εύρεση διαθέσιμων θερμικών ζωνών
			function ygrt_getzones(zone_id){
			var prefix = "editygrt_";
			
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
			function form_ygrt(id){
			var prefix = "editygrt_";

				if(id==0){
				ygrt_getzones();
				document.getElementById(prefix+"zone_id").selectedIndex = 0;
				document.getElementById(prefix+"type").value = "";
				document.getElementById(prefix+"n").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_sys_ygrt&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
						var ischecked;
							
							ygrt_getzones(arr["zone_id"]);
							
							document.getElementById(prefix+"type").value = arr["type"];
							document.getElementById(prefix+"n").value = arr["n"];
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
			var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_ygrt('+id+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία συστήματος διοχέτευσης';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_ygrt('+id+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη συστήματος διοχέτευσης';
				}
				document.getElementById("edit_button_ygrt").innerHTML = button;
				document.getElementById("edit_header_ygrt").innerHTML = edit_header;
				$("#modal_form_ygrt").modal("show");
			}
			
			//Εμφάνιση διαγραφής
			function formdel_ygrt(id){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_ygrt('+id+');">Διαγραφή</button>';
				document.getElementById("del_button_ygrt").innerHTML = button;
				$("#modal_del_ygrt").modal("show");
			}
			
			//Υποβολή της φόρμας για ΤΕΡΜΑΤΙΚΕΣ ΜΟΝΑΔΕΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_ygrt(id){
			var prefix = "editygrt_";

				var zone_id = document.getElementById(prefix+"zone_id").value;
				var type = document.getElementById(prefix+"type").value;
				var n = document.getElementById(prefix+"n").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_zone_sys_ygrt";
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
					document.getElementById("ygrt_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_ygrt();
				}}
			}
			
			//Διαγραφή
			function del_ygrt(id){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_sys_ygrt&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("ygrt_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_ygrt();
				}}
			}
			</script>
<!-- ###################### Κρυφό modal_form_ygrt για εμφάνιση ###################### -->
<div id="modal_form_ygrt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_ygrt"></span></h6>
	</div>

	<div class="modal-body">	
	<table class="table table-bordered table-condensed">
		<tr class="success">
		<td width=25%>Παράμετρος</td>
		<td width=25%>Τιμή</td>
		<td width=50%>Βοήθεια</td>
		</tr>
		<tr>
			<td>Ζώνη</td>
			<td>
			<select class="form-control input-sm" id="editygrt_zone_id">
				<option value=0></option>
			</select>
			</td>
			<td rowspan="3" style="background-color:#dff0d8;">
			Κείμενο βοήθειας
			</td>
		</tr>
		<tr>
			<td>Τύπος</td>
			<td><input class="form-control input-sm" type="text" id="editygrt_type"></td>
		</tr>
		<tr>
			<td>Βαθμ. απόδοσης</td>
			<td><input class="form-control input-sm" type="text" id="editygrt_n"></td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_ygrt"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_ygrt για εμφάνιση ###################### -->
<div id="modal_del_ygrt" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή συστήματος διοχέτευσης</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_ygrt"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

