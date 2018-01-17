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
	<div id="mthx_dapeda_table"></div>
	<div id="mthx_dapeda_info"></div>
	<script>
	get_mthx_dapeda();
	
	//Εμφάνιση πίνακα με όλα τα δάπεδα
	function get_mthx_dapeda(page){
	page = typeof page !== 'undefined' ? page : 1;
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		
		xmlhttp.open("GET","includes/functions_meleti_kelyfos.php?getmthxdapeda=1&page="+page ,true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("mthx_dapeda_table").innerHTML=xmlhttp.responseText;
			document.getElementById('wait').style.display="none";
			setUpToolTipHelpers();
		}}
	}
	
	//Εύρεση διαθέσιμων ΜΘΧ
	function mthx_dapeda_getmthx(type,mthx_id){
	type = typeof type !== 'undefined' ? type : 0;
	var prefix = "editmthx_dapeda_";
	
	//Εμφάνιση select ανάλογα με τον τύπο (ΜΘΧ). Εδώ ενδιαφέρουν οι μΘΧ
	var link1 = "includes/functions_meleti_general.php?getavailablezones=1&type="+type;
	var xmlhttp1=new XMLHttpRequest();
	xmlhttp1.open("GET",link1 ,true);
	xmlhttp1.send();
	xmlhttp1.onreadystatechange=function()  {
	if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
		var place = "mthx_id";
		document.getElementById(prefix+place).innerHTML = xmlhttp1.responseText;
		document.getElementById(prefix+place).value = mthx_id;
	}}
	}
	
	
	//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
	function form_mthx_dapeda(id,page){
		page = typeof page !== 'undefined' ? page : 1;
	var prefix = "editmthx_dapeda_";

		if(id==0){
		mthx_dapeda_getmthx(1);
		document.getElementById(prefix+"mthx_id").selectedIndex = 0;
		document.getElementById(prefix+"type").selectedIndex = 0;
		mthx_dapeda_changetype();
		document.getElementById(prefix+"name").value = "";
		document.getElementById(prefix+"e").value = "";
		document.getElementById(prefix+"u").value = "";
		document.getElementById(prefix+"u_id").selectedIndex = 0;
		mthx_dapeda_u();
		document.getElementById(prefix+"ap").selectedIndex = 0;
		document.getElementById(prefix+"ek").selectedIndex = 0;
		document.getElementById(prefix+"z").value = "";
		document.getElementById(prefix+"p").value = "";
		document.getElementById(prefix+"fhor_h").value = "";
		document.getElementById(prefix+"fhor_c").value = "";
		document.getElementById(prefix+"fov_h").value = "";
		document.getElementById(prefix+"fov_c").value = "";
		document.getElementById(prefix+"ffin_h").value = "";
		document.getElementById(prefix+"ffin_c").value = "";
		document.getElementById(prefix+"f").selectedIndex = 0;
		}
		if(id!=0){
			var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_mthx_dapeda&id="+id;
		
			document.getElementById('wait').style.display="inline";
			//AJAX call
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.open("GET",link ,true);
			xmlhttp.send();
			xmlhttp.onreadystatechange=function()  {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				var arr = JSON.parse(xmlhttp.responseText);	
					
					mthx_dapeda_getmthx(1,arr["mthx_id"]);
					document.getElementById(prefix+"type").selectedIndex = arr["type"];
					mthx_dapeda_changetype();
					document.getElementById(prefix+"name").value = arr["name"];
					document.getElementById(prefix+"e").value = arr["e"];
					document.getElementById(prefix+"u").value = arr["u"];
					document.getElementById(prefix+"u_id").value = arr["u_id"];
					if(arr["u_id"]!=0){
						mthx_dapeda_u();
					}
					document.getElementById(prefix+"ap").value = arr["ap"];
					document.getElementById(prefix+"ek").value = arr["ek"];
					document.getElementById(prefix+"z").value = arr["z"];
					document.getElementById(prefix+"p").value = arr["p"];
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
			button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_mthx_dapeda('+id+','+page+');">Επεξεργασία</button>';
			edit_header = 'Επεξεργασία δαπέδου ΜΘΧ';
		}else{
			button = '<button class="btn btn-znx" data-dismiss="modal" aria-hidden="true" onclick="submit_mthx_dapeda('+id+','+page+');">Προσθήκη</button>';
			edit_header = 'Προσθήκη δαπέδου ΜΘΧ';
		}
		document.getElementById("edit_button_mthx_dapeda").innerHTML = button;
		document.getElementById("edit_header_mthx_dapeda").innerHTML = edit_header;
		$("#modal_form_mthx_dapeda").modal("show");
		modal_height();
	}
	
	//ΔΙΑΓΡΑΦΗ
	function formdel_mthx_dapeda(id){
		var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_mthx_dapeda('+id+','+page+');">Διαγραφή</button>';
		document.getElementById("del_button_mthx_dapeda").innerHTML = button;
		$("#modal_del_mthx_dapeda").modal("show");
	}
	
	//Υποβολή της φόρμας
	//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
	function submit_mthx_dapeda(id,page){
	var prefix = "editmthx_dapeda_";
		var mthx_id = document.getElementById(prefix+"mthx_id").value;
		var type = document.getElementById(prefix+"type").value;
		var name = document.getElementById(prefix+"name").value;
		var e = document.getElementById(prefix+"e").value;
		var u = document.getElementById(prefix+"u").value;
		var u_id = document.getElementById(prefix+"u_id").value;
		var ap = document.getElementById(prefix+"ap").value;
		var ek = document.getElementById(prefix+"ek").value;
		var z = document.getElementById(prefix+"z").value;
		var p = document.getElementById(prefix+"p").value;
		var fhor_h = document.getElementById(prefix+"fhor_h").value;
		var fhor_c = document.getElementById(prefix+"fhor_c").value;
		var fov_h = document.getElementById(prefix+"fov_h").value;
		var fov_c = document.getElementById(prefix+"fov_c").value;
		var ffin_h = document.getElementById(prefix+"ffin_h").value;
		var ffin_c = document.getElementById(prefix+"ffin_c").value;
		
		if(u_id!=0){u=0;}
		
			if(id==0){
			var action="create";
			}else{
			action="update";
			}
		var link = "includes/functions_meleti_general.php?insert_iddata=1";
		link += "&table=meletes_mthx_dapeda";
		link += "&action="+action;
		link += "&id="+id;
		link += "&values="+mthx_id+","+type+","+name+","+e+","+u+","+u_id+","+ap+","+ek+","+z+","+p+","+fhor_h+","+fhor_c+","+fov_h+","+fov_c+","+ffin_h+","+ffin_c;
		
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("mthx_dapeda_info").innerHTML=xmlhttp.responseText;
			document.getElementById('wait').style.display="none";
			get_mthx_dapeda(page);
			get_meleti_n();
		}}
	}
	
	//Διαγραφή
	function del_mthx_dapeda(id,page){
		var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_mthx_dapeda&id="+id;
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("mthx_dapeda_info").innerHTML=xmlhttp.responseText;
			document.getElementById('wait').style.display="none";
			get_mthx_dapeda(page);
			get_meleti_n();
		}}
	}
	
	function mthx_dapeda_changetype(){
	var prefix = "editmthx_dapeda_";
	var type = document.getElementById(prefix+"type").value;
	
		//πρόσθετα
		for (var i=0;i<=1;i++){
			document.getElementById(prefix+"help"+i).style.display="none";
			}
		if(type==0){
		document.getElementById(prefix+"help0").style.display="inline";
		}else{
		document.getElementById(prefix+"help1").style.display="inline";
		}

	}
	
	function mthx_dapeda_f(){
	var prefix = "editmthx_dapeda_";
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
	
	function mthx_dapeda_u(){
	var prefix = "editmthx_dapeda_";
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

	<!-- ###################### Κρυφό modal_form_mthx_dapeda για εμφάνιση ###################### -->
	<div id="modal_form_mthx_dapeda" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h6 id="myModalLabel"><span id="edit_header_mthx_dapeda"></span></h6>
		</div>

		<div class="modal-body">
		<table class="table table-bordered table-condensed">
			<tr class="warning"><td width=50%>Στοιχεία δαπέδου</td><td width=50%>Επιλογές επαφής</td></tr>
			<tr>
				<td>
					<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="ΜΘΧ που ανήκει το δάπεδο"><i class="fa fa-cube"></i> ΜΘΧ</span>
					</span>
					<select class="form-control input-sm" id="editmthx_dapeda_mthx_id">
						<option value=0></option>
					</select>
					</div>
				</td>
				<td rowspan="6">
				<span id="editmthx_dapeda_help"></span>
					<div id="editmthx_dapeda_help0" style="display:none;">
					<table class="table table-bordered table-condensed">
						<tr>
							<td>Βάθος έδρασης</td>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Βάθος έδρασης (θετική τιμή) από τη θέση +0.00"><i class="fa fa-arrow-down"></i> Β. έδρασης</span>
								</span>
								<input class="form-control input-sm" type="text" id="editmthx_dapeda_z">
								</div>
							</td>
						</tr>
						<tr>
							<td>Περίμετρος</td>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Η ελεύθερη περίμετρος (σε αέρα) του δαπέδου"><i class="fa fa-retweet"></i> Περίμετρος</span>
								</span>
								<input class="form-control input-sm" type="text" id="editmthx_dapeda_p">
								</div>
							</td>
						</tr>
					</table>
					</div>
					<div id="editmthx_dapeda_help1" style="display:none;">
					<table class="table table-bordered table-condensed">
						<tr>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Επιλέξτε τύπο σκίασης για αυτόματη προσθήκη συντελεστών"><i class="fa fa-sun-o"></i> Τύπος σκίασης</span>
								</span>
								<select class="form-control input-sm" id="editmthx_dapeda_f" onchange="mthx_dapeda_f();">
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
						<tr><td>Fhor_h</td><td><input class="form-control input-sm" type="text" id="editmthx_dapeda_fhor_h"></td></tr>
						<tr><td>Fhor_c</td><td><input class="form-control input-sm" type="text" id="editmthx_dapeda_fhor_c"></td></tr>
						<tr><td>Fov_h</td><td><input class="form-control input-sm" type="text" id="editmthx_dapeda_fov_h"></td></tr>
						<tr><td>Fov_c</td><td><input class="form-control input-sm" type="text" id="editmthx_dapeda_fov_c"></td></tr>
						<tr><td>Ffin_h</td><td><input class="form-control input-sm" type="text" id="editmthx_dapeda_ffin_h"></td></tr>
						<tr><td>Ffin_c</td><td><input class="form-control input-sm" type="text" id="editmthx_dapeda_ffin_c"></td></tr>
					</table>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="Τύπος επαφής δαπέδου"><i class="fa fa-braille"></i> Τύπος</span>
					</span>
					<select class="form-control input-sm" id="editmthx_dapeda_type" onchange="mthx_dapeda_changetype();">
					<option value=0>Επί εδάφους</option>
					<option value=1>Σε πυλωτή</option>
					</select>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="Ένα χαρακτηριστικό όνομα για το δάπεδο"><i class="fa fa-keyboard-o"></i> Όνομα</span>
					</span>
					<input class="form-control input-sm" type="text" id="editmthx_dapeda_name">
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="Εμβαδόν δαπέδου<br/>Συμπεριλαμβάνει όλα τα δομικά στοιχεία"><i class="fa fa-area-chart"></i> Εμβαδόν</span>
					</span>
					<input class="form-control input-sm" type="text" id="editmthx_dapeda_e">
					<span class="input-group-addon"> m<sup>2</sup></span>
					</div>
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
						<input class="form-control input-sm" type="text" id="editmthx_dapeda_u">
						<span class="input-group-addon"> W/m<sup>2</sup>.K</span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group">
						<span class="input-group-addon">
							<span class="tip-top" href="#" title="Αποθηκευμένος υπολογισμός αδιαφανών"><i class="fa fa-calculator"></i> Υπολογισμός</span>
						</span>
						<select class="form-control input-sm" id="editmthx_dapeda_u_id" onchange="mthx_dapeda_u();">
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
						<select class="form-control input-sm" id="editmthx_dapeda_ap">
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
						<select class="form-control input-sm" id="editmthx_dapeda_ek">
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
		<span id="edit_button_mthx_dapeda"></span>
		<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->	
<!-- ###################### Κρυφό modal_del_mthx_dapeda για εμφάνιση ###################### -->
<div id="modal_del_mthx_dapeda" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή δαπέδου ΜΘΧ</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_mthx_dapeda"></span>
		<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

