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
<div id="zone_orofes_table"></div>
<div id="zone_orofes_info"></div>
<script>
get_zone_orofes();

//Εμφάνιση πίνακα με όλες τις μονάδες παραγωγής του χρήστη
function get_zone_orofes(page){
page = typeof page !== 'undefined' ? page : 1;
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","includes/functions_meleti_kelyfos.php?getzoneorofes=1&page="+page ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("zone_orofes_table").innerHTML=xmlhttp.responseText;
		document.getElementById('wait').style.display="none";
		setUpToolTipHelpers();
	}}
}

//Εύρεση διαθέσιμων θερμικών ζωνών ή ΜΘΧ
function zone_orofes_getzones(type,zone_id){
type = typeof type !== 'undefined' ? type : 0;
var prefix = "editzone_orofes_";

//Εμφάνιση select ανάλογα με τον τύπο (ΖΩΝΕΣ η ΜΘΧ). Εδώ ενδιαφέρουν οι ζώνες ή οι μΘΧ
var link1 = "includes/functions_meleti_general.php?getavailablezones=1&type="+type;
var xmlhttp1=new XMLHttpRequest();
xmlhttp1.open("GET",link1 ,true);
xmlhttp1.send();
xmlhttp1.onreadystatechange=function()  {
if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
	var place;
	if(type==0){
		place = "zone_id";
	}else{
		place = "mthx_id";
	}
	
	document.getElementById(prefix+place).innerHTML = xmlhttp1.responseText;
	if(zone_id!=0){
	document.getElementById(prefix+place).value = zone_id;
	}
}}
}


//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
function form_zone_orofes(id,page){
	page = typeof page !== 'undefined' ? page : 1;
var prefix = "editzone_orofes_";

	if(id==0){
	zone_orofes_getzones(0);
	zone_orofes_getzones(1);
	document.getElementById(prefix+"zone_id").selectedIndex = 0;
	document.getElementById(prefix+"type").selectedIndex = 0;
	zone_orofes_changetype();
	document.getElementById(prefix+"mthx_id").selectedIndex = 0;
	document.getElementById(prefix+"name").value = "";
	document.getElementById(prefix+"g").value = "";
	document.getElementById(prefix+"b").value = "";
	zone_orofes_change_g();
	document.getElementById(prefix+"e").value = "";
	document.getElementById(prefix+"u").value = "";
	document.getElementById(prefix+"u_id").selectedIndex = <?php echo $or_u_id;?>;
	zone_orofes_u();
	document.getElementById(prefix+"ap").selectedIndex = 0;
	document.getElementById(prefix+"ek").selectedIndex = 0;
	document.getElementById(prefix+"fhor_h").value = "";
	document.getElementById(prefix+"fhor_c").value = "";
	document.getElementById(prefix+"fov_h").value = "";
	document.getElementById(prefix+"fov_c").value = "";
	document.getElementById(prefix+"ffin_h").value = "";
	document.getElementById(prefix+"ffin_c").value = "";
	document.getElementById(prefix+"f").selectedIndex = 0;
	}
	if(id!=0){
		var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_orofes&id="+id;
	
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var arr = JSON.parse(xmlhttp.responseText);	
				
				zone_orofes_getzones(0,arr["zone_id"]);
				document.getElementById(prefix+"type").selectedIndex = arr["type"];
				zone_orofes_changetype();
				zone_orofes_getzones(1,arr["mthx_id"]);
				document.getElementById(prefix+"name").value = arr["name"];
				document.getElementById(prefix+"g").value = arr["g"];
				document.getElementById(prefix+"b").value = arr["b"];
				zone_orofes_change_g();
				document.getElementById(prefix+"e").value = arr["e"];
				document.getElementById(prefix+"u").value = arr["u"];
				document.getElementById(prefix+"u_id").value = arr["u_id"];
					if(arr["u_id"]!=0){
					zone_orofes_u();
					}
				document.getElementById(prefix+"ap").value = arr["ap"];
				document.getElementById(prefix+"ek").value = arr["ek"];
				document.getElementById(prefix+"fhor_h").value = arr["fhor_h"];
				document.getElementById(prefix+"fhor_c").value = arr["fhor_c"];
				document.getElementById(prefix+"fov_h").value = arr["fov_h"];
				document.getElementById(prefix+"fov_c").value = arr["fov_c"];
				document.getElementById(prefix+"ffin_h").value = arr["ffin_h"];
				document.getElementById(prefix+"ffin_c").value = arr["ffin_c"];
				
			document.getElementById('wait').style.display="none";
		}}
		
	}
	
	var button,edit_header;
	if(id!=0){
		button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_zone_orofes('+id+','+page+');">Επεξεργασία</button>';
		edit_header = 'Επεξεργασία οροφής';
	}else{
		button = '<button class="btn btn-solar" data-dismiss="modal" aria-hidden="true" onclick="submit_zone_orofes('+id+','+page+');">Προσθήκη</button>';
		edit_header = 'Προσθήκη οροφής';
	}
	document.getElementById("edit_button_zone_orofes").innerHTML = button;
	document.getElementById("edit_header_zone_orofes").innerHTML = edit_header;
	$("#modal_form_zone_orofes").modal("show");
	modal_height();
}

//ΔΙΑΓΡΑΦΗ
function formdel_zone_orofes(id,page){
	var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_zone_orofes('+id+','+page+');">Διαγραφή</button>';
	document.getElementById("del_button_zone_orofes").innerHTML = button;
	$("#modal_del_zone_orofes").modal("show");
}

//Υποβολή της φόρμας
//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
function submit_zone_orofes(id,page){
var prefix = "editzone_orofes_";
	var zone_id = document.getElementById(prefix+"zone_id").value;
	var type = document.getElementById(prefix+"type").value;
	var mthx_id = document.getElementById(prefix+"mthx_id").value;
	var name = document.getElementById(prefix+"name").value;
	var g = document.getElementById(prefix+"g").value;
	var b = document.getElementById(prefix+"b").value;
	var e = document.getElementById(prefix+"e").value;
	var u = document.getElementById(prefix+"u").value;
	var u_id = document.getElementById(prefix+"u_id").value;
	var ap = document.getElementById(prefix+"ap").value;
	var ek = document.getElementById(prefix+"ek").value;
	var fhor_h = document.getElementById(prefix+"fhor_h").value;
	var fhor_c = document.getElementById(prefix+"fhor_c").value;
	var fov_h = document.getElementById(prefix+"fov_h").value;
	var fov_c = document.getElementById(prefix+"fov_c").value;
	var ffin_h = document.getElementById(prefix+"ffin_h").value;
	var ffin_c = document.getElementById(prefix+"ffin_c").value;
	
	if(type!=1){mthx_id=0;}
	if(u_id!=0){u=0;}
	
		if(id==0){
		var action="create";
		}else{
		action="update";
		}
	var link = "includes/functions_meleti_general.php?insert_iddata=1";
	link += "&table=meletes_zone_orofes";
	link += "&action="+action;
	link += "&id="+id;
	link += "&values="+zone_id+","+type+","+mthx_id+","+name+","+g+","+b+","+e+","+u+","+u_id+","+ap+","+ek+","+fhor_h+","+fhor_c+","+fov_h+","+fov_c+","+ffin_h+","+ffin_c;
	
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("zone_orofes_info").innerHTML=xmlhttp.responseText;
		document.getElementById('wait').style.display="none";
		get_zone_orofes(page);
		get_meleti_n();
	}}
}

//Διαγραφή
function del_zone_orofes(id,page){
	var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_orofes&id="+id;
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("zone_orofes_info").innerHTML=xmlhttp.responseText;
		document.getElementById('wait').style.display="none";
		get_zone_orofes(page);
		get_meleti_n();
	}}
}

function zone_orofes_changetype(){
var prefix = "editzone_orofes_";
var type = document.getElementById(prefix+"type").value;
	
	if(type==1){
	//επιλογή επαφής με ΜΘΧ
	document.getElementById(prefix+"mthx_id").disabled = false;
	}else{
	document.getElementById(prefix+"mthx_id").disabled = true;
	}

}

function zone_orofes_change_g(){
var prefix = "editzone_orofes_";
var b = document.getElementById(prefix+"b").value;
	
	if(b==0 || b==180){
	//επιλογή επαφής με ΜΘΧ
	document.getElementById(prefix+"g").value = 0;
	document.getElementById(prefix+"g").disabled = true;
	}else{
	document.getElementById(prefix+"g").disabled = false;
	}

}

function zone_orofes_f(){
var prefix = "editzone_orofes_";
var f = document.getElementById(prefix+"f").value;
var f_hor, f_ov, f_fin;
	if(f==0){
	f_hor = 0;f_ov = 0;f_fin = 0;
	}
	if(f==""){
	f_hor = "";f_ov = "";f_fin = "";
	}
	if(f!=0 && f!=""){
	f_hor = f;f_ov = 1;f_fin = 1;
	}
	document.getElementById(prefix+"fhor_h").value = f_hor;
	document.getElementById(prefix+"fhor_c").value = f_hor;
	document.getElementById(prefix+"fov_h").value = f_ov;
	document.getElementById(prefix+"fov_c").value = f_ov;
	document.getElementById(prefix+"ffin_h").value = f_fin;
	document.getElementById(prefix+"ffin_c").value = f_fin;
}

function zone_orofes_u(){
var prefix = "editzone_orofes_";
var u = document.getElementById(prefix+"u_id").value;
	if(u!=0){
		var link = "includes/functions_meleti_general.php?findu_adiafani=1&id="+u;
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById(prefix+"u").value=xmlhttp.responseText;
		}}
	
		document.getElementById(prefix+"u").disabled = true;
	}else{
		document.getElementById(prefix+"u").value="";
		document.getElementById(prefix+"u").disabled = false;
	}
}
</script>

<!-- ###################### Κρυφό modal_form_zone_orofes για εμφάνιση ###################### -->
<div id="modal_form_zone_orofes" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_zone_orofes"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info"><td width=50%>Στοιχεία οροφής</td><td width=50%>Επιλογές σκίασης</td></tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Θερμική ζώνη που ανήκει η οροφή"><i class="fa fa-cubes"></i> Ζώνη</span>
				</span>
				<select class="form-control input-sm" id="editzone_orofes_zone_id">
					<option value=0></option>
				</select>
				</div>
			</td>
			<td rowspan="9">
			<span id="editzone_orofes_help"></span>
				<table class="table table-bordered table-condensed">
					<tr>
						<td>
							<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="Επιλέξτε τύπο σκίασης για αυτόματη προσθήκη συντελεστών"><i class="fa fa-sun-o"></i> Τύπος σκίασης</span>
							</span>
							<select class="form-control input-sm" id="editzone_orofes_f" onchange="zone_orofes_f();">
								<option value="">Επιλέξτε τύπο σκίασης</option>
								<option value=1>Χωρίς σκίαση</option>
								<option value=0.9>Περιορισμένη σκίαση ή U<0.6</option>
								<option value=0.6>Μερική σκίαση</option>
								<option value=0.3>Σημαντική σκίαση</option>
								<option value=0>Πλήρης σκίαση</option>
							</select>
							</div>
						</td>
					</tr>	
					<tr><td>Fhor_h</td><td><input class="form-control input-sm" type="text" id="editzone_orofes_fhor_h"></td></tr>
					<tr><td>Fhor_c</td><td><input class="form-control input-sm" type="text" id="editzone_orofes_fhor_c"></td></tr>
					<tr><td>Fov_h</td><td><input class="form-control input-sm" type="text" id="editzone_orofes_fov_h"></td></tr>
					<tr><td>Fov_c</td><td><input class="form-control input-sm" type="text" id="editzone_orofes_fov_c"></td></tr>
					<tr><td>Ffin_h</td><td><input class="form-control input-sm" type="text" id="editzone_orofes_ffin_h"></td></tr>
					<tr><td>Ffin_c</td><td><input class="form-control input-sm" type="text" id="editzone_orofes_ffin_c"></td></tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Τύπος επαφής οροφής<br/>Σε τμήμα κτιρίου επιλέγεται: σε αέρα και U=U/2"><i class="fa fa-braille"></i> Τύπος</span>
				</span>
				<select class="form-control input-sm" id="editzone_orofes_type" onchange="zone_orofes_changetype();">
				<option value=0>Σε αέρα</option>
				<option value=1>Σε ΜΘΧ/Ηλιακό χώρο (διαχ. επιφάνεια)</option>
				</select>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Ο ΜΘΧ/Ηλιακός χώρος που έρχεται σε επαφή η οροφή"><i class="fa fa-cube"></i> ΜΘΧ</span>
				</span>
				<select class="form-control input-sm" id="editzone_orofes_mthx_id">
					<option value=0></option>
				</select>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Ένα χαρακτηριστικό όνομα για την οροφή"><i class="fa fa-keyboard-o"></i> Όνομα</span>
				</span>
				<input class="form-control" type="text" id="editzone_orofes_name">
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Προσανατολισμός οροφής.<br/>Εάν β<>0 τότε μπορείτε να επιλέξετε."><i class="fa fa-compass"></i> Προσ. (γ)</span>
				</span>
				<input class="form-control input-sm" type="text" id="editzone_orofes_g">
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Κλίση οροφής (β) ως προς την κατακόρυφο.<br/>Εάν έχει κλίση έχει και προσανατολισμό."><i class="fa fa-eraser"></i> Κλίση (β)</span>
				</span>
				<input class="form-control input-sm" type="text" id="editzone_orofes_b" onkeyup="zone_orofes_change_g();">
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="input-group">
				<span class="input-group-addon">
					<span class="tip-top" href="#" title="Εμβαδόν οροφής<br/>Συμπεριλαμβάνει όλα τα δομικά στοιχεία"><i class="fa fa-area-chart"></i> Εμβαδόν</span>
				</span>
				<input class="form-control" type="text" id="editzone_orofes_e">
			</td>
		</tr>
		<tr>
			<td>
			<div class="row">
				<div class="col-md-5">
					<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="Συντελεστής θερμοπερατότητας"><i class="fa fa-thermometer-half"></i> U</span>
					</span>
					<input class="form-control input-sm" type="text" id="editzone_orofes_u">
					</div>
				</div>
				<div class="col-md-6">
					<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="Αποθηκευμένος υπολογισμός αδιαφανών"><i class="fa fa-calculator"></i> Υπολογισμός</span>
					</span>
					<select class="form-control input-sm" id="editzone_orofes_u_id" onchange="zone_orofes_u();">
						<option value=0>Χωρίς υπολογισμό</option>
						<?php
						echo create_select_optionsid("user_adiafani","name",array("user_id"=>$_SESSION["user_id"]) );
						?>
					</select>
					</div>
				</div>
				<div class="col-md-1">
					<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#help_u_orizontia"><i class="fa fa-exchange text-danger"></i></button>
				</div>
			</div>	
			</td>
		</tr>
		<tr>
			<td>
			<div class="row">
				<div class="col-md-6">
					<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="Απορροφητικότητα"><i class="fa fa-certificate"></i> α</span>
					</span>
					<select class="form-control input-sm" id="editzone_orofes_ap">
						<?php
						echo create_select_optionsid("vivliothiki_adiafani_a","name",array("type"=>2) );
						?>
					</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="Συντελεστής εκπομπής"><i class="fa fa-sun-o"></i> ε</span>
					</span>
					<select class="form-control input-sm" id="editzone_orofes_ek">
						<?php
						echo create_select_optionsid("vivliothiki_adiafani_e","name");
						?>
					</select>
					</div>
				</div>
			</div>
			</td>
		</tr>
		
	</table>
</div>	

<div class="modal-footer">	
	<span id="edit_button_zone_orofes"></span>
	<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->	
<!-- ###################### Κρυφό modal_del_zone_orofes για εμφάνιση ###################### -->
<div id="modal_del_zone_orofes" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h6 id="myModalLabel">Διαγραφή οροφής</h6>
</div>

<div class="modal-body">
Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
</div>	

<div class="modal-footer">	
	<span id="del_button_zone_orofes"></span>
	<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->