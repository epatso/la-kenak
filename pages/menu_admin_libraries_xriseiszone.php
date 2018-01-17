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
if(confirm_admin()){
?>
<div id="xriseiszone_table"></div>
<div id="xriseiszone_info"></div>

<script>
	get_xriseiszone();
	
//Εμφάνιση πίνακα με όλες τις ΘΕΡΜΟΓΕΦΥΡΕΣ για τη ζώνη
function get_xriseiszone(page){
page = typeof page !== 'undefined' ? page : 1;
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","includes/functions_admin_libraries.php?get_xriseiszone=1&page="+page ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("xriseiszone_table").innerHTML=xmlhttp.responseText;
		document.getElementById('wait').style.display="none";
	}}
}
	
//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές
function form_xriseiszone(id,page){
page = typeof page !== 'undefined' ? page : 1;
var prefix = "editxriseiszone_";

	if(id==0){
		document.getElementById(prefix+"gen_id").SelectedIndex = 0;
		document.getElementById(prefix+"name").value = "";
		document.getElementById(prefix+"t_h").value = "";
		document.getElementById(prefix+"t_d").value = "";
		document.getElementById(prefix+"t_m").value = "";
		document.getElementById(prefix+"ti_h").value = "";
		document.getElementById(prefix+"ti_c").value = "";
		document.getElementById(prefix+"xi_h").value = "";
		document.getElementById(prefix+"xi_c").value = "";
		document.getElementById(prefix+"air_persons").value = "";
		document.getElementById(prefix+"air_perperson").value = "";
		document.getElementById(prefix+"air_perm2").value = "";
		
		document.getElementById(prefix+"light_kw").value = "";
		document.getElementById(prefix+"light_lux").value = "";
		document.getElementById(prefix+"light_height").value = "";
		document.getElementById(prefix+"light_ugr").value = "";
		document.getElementById(prefix+"light_uo").value = "";
		
		document.getElementById(prefix+"w_perperson").value = "";
		document.getElementById(prefix+"w_perm2").value = "";
		document.getElementById(prefix+"w_f").value = "";
		
		document.getElementById(prefix+"eq_w_perm2").value = "";
		document.getElementById(prefix+"eq_ft").value = "";
		document.getElementById(prefix+"eq_wt_perm2").value = "";
		document.getElementById(prefix+"eq_f").value = "";
		
		document.getElementById(prefix+"has_znx").SelectedIndex = 0;
		document.getElementById(prefix+"znx_calc_type").SelectedIndex = 0;
		document.getElementById(prefix+"znx_lt_perperson").value = "";
		document.getElementById(prefix+"znx_lt_perm2").value = "";
		document.getElementById(prefix+"znx_m3_perroom").value = "";
		document.getElementById(prefix+"znx_m3_perm2").value = "";
	}
	if(id!=0){
		var link = "includes/functions_admin_libraries.php?get_id=1&table=vivliothiki_conditions_zone&id="+id;
	
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var arr = JSON.parse(xmlhttp.responseText);
				document.getElementById(prefix+"gen_id").value = arr["gen_id"];
				document.getElementById(prefix+"name").value = arr["name"];
				document.getElementById(prefix+"t_h").value = arr["t_h"];
				document.getElementById(prefix+"t_d").value = arr["t_d"];
				document.getElementById(prefix+"t_m").value = arr["t_m"];
				document.getElementById(prefix+"ti_h").value = arr["ti_h"];
				document.getElementById(prefix+"ti_c").value = arr["ti_c"];
				document.getElementById(prefix+"xi_h").value = arr["xi_h"];
				document.getElementById(prefix+"xi_c").value = arr["xi_c"];
				document.getElementById(prefix+"air_persons").value = arr["air_persons"];
				document.getElementById(prefix+"air_perperson").value = arr["air_perperson"];
				document.getElementById(prefix+"air_perm2").value = arr["air_perm2"];
				
				document.getElementById(prefix+"light_kw").value = arr["light_kw"];
				document.getElementById(prefix+"light_lux").value = arr["light_lux"];
				document.getElementById(prefix+"light_height").value = arr["light_height"];
				document.getElementById(prefix+"light_ugr").value = arr["light_ugr"];
				document.getElementById(prefix+"light_uo").value = arr["light_uo"];
				
				document.getElementById(prefix+"w_perperson").value = arr["w_perperson"];
				document.getElementById(prefix+"w_perm2").value = arr["w_perm2"];
				document.getElementById(prefix+"w_f").value = arr["w_f"];
				
				document.getElementById(prefix+"eq_w_perm2").value = arr["eq_w_perm2"];
				document.getElementById(prefix+"eq_ft").value = arr["eq_ft"];
				document.getElementById(prefix+"eq_wt_perm2").value = arr["eq_wt_perm2"];
				document.getElementById(prefix+"eq_f").value = arr["eq_f"];
				
				document.getElementById(prefix+"has_znx").value = arr["has_znx"];
				document.getElementById(prefix+"znx_calc_type").value = arr["znx_calc_type"];
				document.getElementById(prefix+"znx_lt_perperson").value = arr["znx_lt_perperson"];
				document.getElementById(prefix+"znx_lt_perm2").value = arr["znx_lt_perm2"];
				document.getElementById(prefix+"znx_m3_perroom").value = arr["znx_m3_perroom"];
				document.getElementById(prefix+"znx_m3_perm2").value = arr["znx_m3_perm2"];

			document.getElementById('wait').style.display="none";
		}}
		
	}
	
	var button,edit_header;
	if(id!=0){
		button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_xriseiszone('+id+','+page+');">Επεξεργασία</button>';
		edit_header = 'Επεξεργασία';
	}else{
		button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_xriseiszone('+id+','+page+');">Προσθήκη</button>';
		edit_header = 'Προσθήκη';
	}
	document.getElementById("edit_button_xriseiszone").innerHTML = button;
	document.getElementById("edit_header_xriseiszone").innerHTML = edit_header;
	$("#modal_form_xriseiszone").modal("show");
}


function formdel_xriseiszone(id,page){
	var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_xriseiszone('+id+','+page+');">Διαγραφή</button>';
	document.getElementById("del_button_xriseiszone").innerHTML = button;
	$("#modal_del_xriseiszone").modal("show");
}

//Υποβολή της φόρμας
//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
function submit_xriseiszone(id,page){
var prefix = "editxriseiszone_";
	var gen_id = document.getElementById(prefix+"gen_id").value;
	var name = document.getElementById(prefix+"name").value;
	var t_h = document.getElementById(prefix+"t_h").value;
	var t_d = document.getElementById(prefix+"t_d").value;
	var t_m = document.getElementById(prefix+"t_m").value;
	var ti_h = document.getElementById(prefix+"ti_h").value;
	var ti_c = document.getElementById(prefix+"ti_c").value;
	var xi_h = document.getElementById(prefix+"xi_h").value;
	var xi_c = document.getElementById(prefix+"xi_c").value;
	var air_persons = document.getElementById(prefix+"air_persons").value;
	var air_perperson = document.getElementById(prefix+"air_perperson").value;
	var air_perm2 = document.getElementById(prefix+"air_perm2").value;
	
	var light_kw = document.getElementById(prefix+"light_kw").value;
	var light_lux = document.getElementById(prefix+"light_lux").value;
	var light_height = document.getElementById(prefix+"light_height").value;
	var light_ugr = document.getElementById(prefix+"light_ugr").value;
	var light_uo = document.getElementById(prefix+"light_uo").value;
	
	var w_perperson = document.getElementById(prefix+"w_perperson").value;
	var w_perm2 = document.getElementById(prefix+"w_perm2").value;
	var w_f = document.getElementById(prefix+"w_f").value;
	
	var eq_w_perm2 = document.getElementById(prefix+"eq_w_perm2").value;
	var eq_ft = document.getElementById(prefix+"eq_ft").value;
	var eq_wt_perm2 = document.getElementById(prefix+"eq_wt_perm2").value;
	var eq_f = document.getElementById(prefix+"eq_f").value;
	
	var has_znx = document.getElementById(prefix+"has_znx").value;
	var znx_calc_type = document.getElementById(prefix+"znx_calc_type").value;
	var znx_lt_perperson = document.getElementById(prefix+"znx_lt_perperson").value;
	var znx_lt_perm2 = document.getElementById(prefix+"znx_lt_perm2").value;
	var znx_m3_perroom = document.getElementById(prefix+"znx_m3_perroom").value;
	var znx_m3_perm2 = document.getElementById(prefix+"znx_m3_perm2").value;
	
		if(id==0){
		var action="create";
		}else{
		action="update";
		}
	var link = "includes/functions_admin_libraries.php?insert_id=1";
	link += "&table=vivliothiki_conditions_zone";
	link += "&action="+action;
	link += "&id="+id;
	link += "&values="+gen_id+"|"+name+"|"+t_h+"|"+t_d+"|"+t_m+"|"+ti_h+"|"+ti_c+"|"+xi_h+"|"+xi_c;
	link += "|"+air_persons+"|"+air_perperson+"|"+air_perm2+"|"+light_kw+"|"+light_lux+"|"+light_height+"|"+light_ugr+"|"+light_uo;
	link += "|"+w_perperson+"|"+w_perm2+"|"+w_f+"|"+eq_w_perm2+"|"+eq_ft+"|"+eq_wt_perm2+"|"+eq_f;
	link += "|"+has_znx+"|"+znx_calc_type+"|"+znx_lt_perperson+"|"+znx_lt_perm2+"|"+znx_m3_perroom+"|"+znx_m3_perm2;
	
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("xriseiszone_info").innerHTML=xmlhttp.responseText;
		document.getElementById('wait').style.display="none";
		get_xriseiszone(page);
	}}
}

//Διαγραφή ΟΙΚΟΔΟΜΙΚΩΝ ΑΔΕΙΩΝ
function del_xriseiszone(id,page){
	var link = "includes/functions_admin_libraries.php?del_id=1&table=vivliothiki_conditions_zone&id="+id;
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("xriseiszone_info").innerHTML=xmlhttp.responseText;
		document.getElementById('wait').style.display="none";
		get_xriseiszone(page);
	}}
}
	
</script>
				
<!-- ###################### Κρυφό modal_form_xriseiszone για εμφάνιση ###################### -->
<div id="modal_form_xriseiszone" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_xriseiszone"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info">
			<td width=50%>Παράμετρος</td>
			<td width=50%>Τιμή</td>
		</tr>
		<tr>
		<tr>
			<td>Κατηγορία</td>
			<td>
				<select class="form-control" id="editxriseiszone_gen_id">
					<?php
						echo create_select_optionsid("vivliothiki_conditions_general","name");
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Όνομα</td>
			<td>
				<input type="text" class="form-control input-sm" id="editxriseiszone_name">
			</td>
		</tr>
		<tr>
			<td>Ωράριο</td>
			<td>
				<div class="input-group">
				<span class="input-group-addon">Ώρες</span>
				<input class="form-control input-sm" id="editxriseiszone_t_h">
				</div>
				<div class="input-group">
				<span class="input-group-addon">Ημέρες</span>
				<input class="form-control input-sm" id="editxriseiszone_t_d">
				</div>
				<div class="input-group">
				<span class="input-group-addon">Μήνες</span>
				<input class="form-control input-sm" id="editxriseiszone_t_m">
				</div>
			</td>
		</tr>
		<tr>
			<td>Θερμοκρασία</td>
			<td>
				<div class="input-group">
				<span class="input-group-addon">T<sub>h</sub></span>
				<input class="form-control input-sm" id="editxriseiszone_ti_h">
				</div>
				<div class="input-group">
				<span class="input-group-addon">T<sub>c</sub></span>
				<input class="form-control input-sm" id="editxriseiszone_ti_c">
				</div>
			</td>
		</tr>
		<tr>
			<td>Υγρασία</td>
			<td>
				<div class="input-group">
				<span class="input-group-addon">X<sub>h</sub></span>
				<input class="form-control input-sm" id="editxriseiszone_xi_h">
				</div>
				<div class="input-group">
				<span class="input-group-addon">X<sub>c</sub></span>
				<input class="form-control input-sm" id="editxriseiszone_xi_c">
				</div>
			</td>
		</tr>
		<tr>
			<td>Νωπός αέρας</td>
			<td>
				<div class="input-group">
				<span class="input-group-addon">άτομα</span>
				<input class="form-control input-sm" id="editxriseiszone_air_persons">
				</div>
				<div class="input-group">
				<span class="input-group-addon">m<sup>3</sup>/h/άτ.</span>
				<input class="form-control input-sm" id="editxriseiszone_air_perperson">
				</div>
				<div class="input-group">
				<span class="input-group-addon">m<sup>3</sup>/h/m<sup>2</sup></span>
				<input class="form-control input-sm" id="editxriseiszone_air_perm2">
				</div>
			</td>
		</tr>
		<tr>
			<td>Απαιτήσεις φωτισμού</td>
			<td>
				<div class="input-group">
				<span class="input-group-addon">Ισχύς (W)</span>
				<input class="form-control input-sm" id="editxriseiszone_light_kw">
				</div>
				<div class="input-group">
				<span class="input-group-addon">Στάθμη (lx)</span>
				<input class="form-control input-sm" id="editxriseiszone_light_lux">
				</div>
				<div class="input-group">
				<span class="input-group-addon">Στάθμη</span>
				<input class="form-control input-sm" id="editxriseiszone_light_height">
				</div>
				<div class="input-group">
				<span class="input-group-addon">UGR</span>
				<input class="form-control input-sm" id="editxriseiszone_light_ugr">
				</div>
				<div class="input-group">
				<span class="input-group-addon">U<sub>o</sub></span>
				<input class="form-control input-sm" id="editxriseiszone_light_uo">
				</div>
			</td>
		</tr>
		<tr>
			<td>Χρήστες</td>
			<td>
				<div class="input-group">
				<span class="input-group-addon">W/ατ.</span>
				<input class="form-control input-sm" id="editxriseiszone_w_perperson">
				</div>
				<div class="input-group">
				<span class="input-group-addon">W/m<sup>3</sup></span>
				<input class="form-control input-sm" id="editxriseiszone_w_perm2">
				</div>
				<div class="input-group">
				<span class="input-group-addon">f<sub>παρουσίας</sub></span>
				<input class="form-control input-sm" id="editxriseiszone_w_f">
				</div>
			</td>
		</tr>
		<tr>
			<td>Εξοπλισμός</td>
			<td>
				<div class="input-group">
				<span class="input-group-addon">W/m<sup>2</sup></span>
				<input class="form-control input-sm" id="editxriseiszone_eq_w_perm2">
				</div>
				<div class="input-group">
				<span class="input-group-addon">Συντ. ετ.</span>
				<input class="form-control input-sm" id="editxriseiszone_eq_ft">
				</div>
				<div class="input-group">
				<span class="input-group-addon">W/m<sup>2</sup>(ετ.)</span>
				<input class="form-control input-sm" id="editxriseiszone_eq_wt_perm2">
				</div>
				<div class="input-group">
				<span class="input-group-addon">Συντ. λειτ.</span>
				<input class="form-control input-sm" id="editxriseiszone_eq_f">
				</div>
			</td>
		</tr>
		<tr>
			<td>ZNX</td>
			<td>
				<div class="input-group">
					<select class="form-control" id="editxriseiszone_has_znx">
						<option value=0>ΟΧΙ</option>
						<option value=1>ΝΑΙ</option>
					</select>
				</div>
				<div class="input-group">
					<select class="form-control" id="editxriseiszone_znx_calc_type">
						<option value=0>Δομημένη επιφάνεια</option>
						<option value=1>Υπνοδωμάτια/Κλίνες</option>
						<option value=2>Κατηγορία ξενοδοχείου</option>
						<option value=3>Κατηγορία νοσοκομείου</option>
					</select>
				</div>
				<div class="input-group">
				<span class="input-group-addon">lt/άτομο/ημέρα</span>
				<input class="form-control input-sm" id="editxriseiszone_znx_lt_perperson">
				</div>
				<div class="input-group">
				<span class="input-group-addon">lt/m<sup>2</sup>/ημέρα</span>
				<input class="form-control input-sm" id="editxriseiszone_znx_lt_perm2">
				</div>
				<div class="input-group">
				<span class="input-group-addon">m<sup>3</sup>/κλίνη/έτος</span>
				<input class="form-control input-sm" id="editxriseiszone_znx_m3_perroom">
				</div>
				<div class="input-group">
				<span class="input-group-addon">m<sup>3</sup>/m<sup>2</sup>/έτος</span>
				<input class="form-control input-sm" id="editxriseiszone_znx_m3_perm2">
				</div>
			</td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_xriseiszone"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_sith για εμφάνιση ###################### -->
<div id="modal_del_xriseiszone" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_xriseiszone"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<?php
}
?>