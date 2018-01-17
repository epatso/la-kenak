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
<div id="zone_diafani_table"></div>
<div id="zone_diafani_info"></div>
<script>
get_zone_diafani();

//Εμφάνιση πίνακα με όλα τα ανοίγματα
function get_zone_diafani(page){
page = typeof page !== 'undefined' ? page : 1;
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","includes/functions_meleti_kelyfos.php?getzonediafani=1&page="+page ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("zone_diafani_table").innerHTML=xmlhttp.responseText;
		document.getElementById('wait').style.display="none";
		setUpToolTipHelpers();
	}}
}

//Εύρεση διαθέσιμων θερμικών ζωνών
function zone_diafani_getzones(zone_id,wall_id,roof_id){
	zone_id = typeof zone_id !== 'undefined' ? zone_id : 0;
	wall_id = typeof wall_id !== 'undefined' ? wall_id : 0;
	roof_id = typeof roof_id !== 'undefined' ? roof_id : 0;
	var prefix = "editzone_diafani_";

	//Εμφάνιση select ανάλογα με τον τύπο (ΖΩΝΕΣ η ΜΘΧ). Εδώ ενδιαφέρουν οι ζώνες type=0
	var link1 = "includes/functions_meleti_general.php?getavailablezones=1&type=0";
	var xmlhttp1=new XMLHttpRequest();
	xmlhttp1.open("GET",link1 ,true);
	xmlhttp1.send();
	xmlhttp1.onreadystatechange=function()  {
	if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
		
		document.getElementById(prefix+"zone_id").innerHTML = xmlhttp1.responseText;
		if(zone_id!=0){
			document.getElementById(prefix+"zone_id").value = zone_id;
		}
		if(zone_id==0){
			document.getElementById(prefix+"zone_id").selectedIndex = 0;
		}
		if(wall_id!=0){
			zone_diafani_getwalls(document.getElementById(prefix+"zone_id").value,wall_id);
		}else{
			zone_diafani_getwalls(document.getElementById(prefix+"zone_id").value);
		}
		if(roof_id!=0){
			zone_diafani_getroofs(document.getElementById(prefix+"zone_id").value,roof_id);
		}else{
			zone_diafani_getroofs(document.getElementById(prefix+"zone_id").value);
		}
	}}
}

//Εύρεση διαθέσιμων τοίχων
function zone_diafani_getwalls(zone_id,wall_id){
	zone_id = typeof zone_id !== 'undefined' ? zone_id : 0;
	wall_id = typeof wall_id !== 'undefined' ? wall_id : 0;
	var prefix = "editzone_diafani_";
		if(zone_id==0){
			zone_id=document.getElementById(prefix+"zone_id").value;
		}

	//Εμφάνιση select για τους τοίχους ανάλογα με τον τύπο (ΖΩΝΕΣ η ΜΘΧ) και τη ζώνη. Εδώ ενδιαφέρουν οι ζώνες
	var link2 = "includes/functions_meleti_general.php?getavailablewalls=1&type=0&zone_id="+zone_id;
	var xmlhttp2=new XMLHttpRequest();
	xmlhttp2.open("GET",link2 ,true);
	xmlhttp2.send();
	xmlhttp2.onreadystatechange=function()  {
	if (xmlhttp2.readyState==4 && xmlhttp2.status==200) {
		document.getElementById(prefix+"wall_id").innerHTML = xmlhttp2.responseText;
		if(wall_id!=0){
		document.getElementById(prefix+"wall_id").value = wall_id;
		}
	}}
}

//Εύρεση διαθέσιμων οροφών
function zone_diafani_getroofs(zone_id,roof_id){
	zone_id = typeof zone_id !== 'undefined' ? zone_id : 0;
	roof_id = typeof roof_id !== 'undefined' ? roof_id : 0;
	var prefix = "editzone_diafani_";
		if(zone_id==0){
			zone_id=document.getElementById(prefix+"zone_id").value;
		}

	//Εμφάνιση select για τις οροφές ανάλογα με τον τύπο (ΖΩΝΕΣ η ΜΘΧ) και τη ζώνη. Εδώ ενδιαφέρουν οι ζώνες
	var link2 = "includes/functions_meleti_general.php?getavailableroofs=1&type=0&zone_id="+zone_id;
	var xmlhttp2=new XMLHttpRequest();
	xmlhttp2.open("GET",link2 ,true);
	xmlhttp2.send();
	xmlhttp2.onreadystatechange=function()  {
	if (xmlhttp2.readyState==4 && xmlhttp2.status==200) {
		document.getElementById(prefix+"roof_id").innerHTML = xmlhttp2.responseText;
		if(roof_id!=0){
		document.getElementById(prefix+"roof_id").value = roof_id;
		}
	}}
}

//Εύρεση διαθέσιμων ανοιγμάτων με βάση τον υπολογισμό
function zone_diafani_getwindows(u_id,u_id_no){
u_id = typeof u_id !== 'undefined' ? u_id : 0;
u_id_no = typeof u_id_no !== 'undefined' ? u_id_no : 0;
var prefix = "editzone_diafani_";
	if(u_id==0){
		u_id=document.getElementById(prefix+"u_id").value;
	}

//Εμφάνιση select για τα διαθέσιμα ανοίγματα ανάλογα με τον υπολογισμό
var link2 = "includes/functions_meleti_general.php?getavailablewindows=1&u_id="+u_id;
var xmlhttp2=new XMLHttpRequest();
xmlhttp2.open("GET",link2 ,true);
xmlhttp2.send();
xmlhttp2.onreadystatechange=function()  {
if (xmlhttp2.readyState==4 && xmlhttp2.status==200) {
	document.getElementById(prefix+"u_id_no").innerHTML = xmlhttp2.responseText;
	if(u_id_no!=0){
	document.getElementById(prefix+"u_id_no").value = u_id_no;
	}
}}
}

//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
function form_zone_diafani(id,page){
	page = typeof page !== 'undefined' ? page : 1;
var prefix = "editzone_diafani_";

	if(id==0){
	zone_diafani_getzones();
	document.getElementById(prefix+"zone_id").selectedIndex = 0;
	document.getElementById("radio1").checked = true;
	zone_diafani_getwalls();
	zone_diafani_getroofs();
	zone_diafani_belongs(1);
	
	document.getElementById(prefix+"name").value = "";
	
	document.getElementById(prefix+"w").value = <?php echo $an_l;?>;
	document.getElementById(prefix+"h").value = <?php echo $an_h;?>;
	document.getElementById(prefix+"p").value = <?php echo $an_p;?>;
	document.getElementById(prefix+"f").value = "";
	document.getElementById(prefix+"apoar").value = "";
	
	document.getElementById(prefix+"u_id").value = "<?php echo $an_u_id;?>";
	zone_diafani_u();
	if(document.getElementById(prefix+"u_id").value!="u_bytype" && document.getElementById(prefix+"u_id").value!="u_manual"){
		zone_diafani_getwindows(<?php echo $an_u_id;?>);
	}
	document.getElementById(prefix+"u").value = "";
	
	document.getElementById(prefix+"type").value = 0;
	zone_diafani_changetype();
	
	
	if(document.getElementById(prefix+"u_id").value=="u_bytype"){
		document.getElementById(prefix+"type").value = 1;
		zone_diafani_changetype();
		document.getElementById(prefix+"prostasia").value = <?php echo $an_prostasia;?>;
		document.getElementById(prefix+"plaisio").value = <?php echo $an_plaisio;?>;
		zone_diafani_changeplaisio();
		document.getElementById(prefix+"plaisioper").value = <?php echo $an_plaisioper;?>;
		document.getElementById(prefix+"yalopinakas").value = <?php echo $an_yalo;?>;
	}
	
	
	document.getElementById(prefix+"passive").checked = false;
	
	document.getElementById(prefix+"g_w").value = "";
	document.getElementById(prefix+"psil").selectedIndex = 12;
	document.getElementById(prefix+"psia").selectedIndex = 12;
	document.getElementById(prefix+"pistopoiisi").selectedIndex = 0;
	document.getElementById(prefix+"wind").value = "";
	
	document.getElementById(prefix+"f_type").selectedIndex = 2;
	zone_diafani_changef();
	document.getElementById(prefix+"fhor_e").value = "";
	document.getElementById(prefix+"fhor_h").value = "";
	
	document.getElementById(prefix+"fov_l").value = "";
	
	document.getElementById(prefix+"fovt_l").value = "";
	document.getElementById(prefix+"fovt_h").value = "";
	
	document.getElementById(prefix+"ffin_l_dx").value = "";
	document.getElementById(prefix+"ffin_l_w").value = "";
	
	document.getElementById(prefix+"ffin_r_dx").value = "";
	document.getElementById(prefix+"ffin_r_w").value = "";
	
	document.getElementById(prefix+"fsh_type").selectedIndex = 0;
	document.getElementById(prefix+"fsh_l").value = "";
	document.getElementById(prefix+"fsh_h").value = "";
	
	document.getElementById(prefix+"ck_fhor").checked = false;
	document.getElementById(prefix+"ck_fov").checked = false;
	document.getElementById(prefix+"ck_fovt").checked = false;
	document.getElementById(prefix+"ck_ffin_l").checked = false;
	document.getElementById(prefix+"ck_ffin_r").checked = false;
	document.getElementById(prefix+"ck_fsh").checked = false;
	zone_diafani_showf();
	
	
	$('.tabs-left a[href="#tab_modaldiafani_1"]').tab('show');
	}
	if(id!=0){
		var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_diafani&id="+id;
	
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var arr = JSON.parse(xmlhttp.responseText);	
				
				zone_diafani_getzones(arr["zone_id"],arr["wall_id"],arr["roof_id"]);
				if(arr["wall_id"]==0){
					zone_diafani_belongs(2);
					zone_diafani_getwalls(arr["zone_id"]);
					zone_diafani_getroofs(arr["zone_id"],arr["roof_id"]);
					document.getElementById("radio2").checked = true;
				}
				if(arr["roof_id"]==0){
					zone_diafani_belongs(1);
					zone_diafani_getroofs(arr["zone_id"]);
					zone_diafani_getwalls(arr["zone_id"],arr["wall_id"]);
					document.getElementById("radio1").checked = true;
				}
				document.getElementById(prefix+"name").value = arr["name"];
				
				document.getElementById(prefix+"w").value = arr["w"];
				document.getElementById(prefix+"h").value = arr["h"];
				document.getElementById(prefix+"p").value = arr["p"];
				document.getElementById(prefix+"f").value = arr["f"];
				document.getElementById(prefix+"apoar").value = arr["apoar"];
				
				document.getElementById(prefix+"u_id").value = arr["u_id"];
				zone_diafani_getwindows(arr["u_id"],arr["u_id_no"]);
				
				if(arr["u_id"]=="u_bytype"){
					document.getElementById(prefix+"divtype").style.display="block";
					document.getElementById(prefix+"u_id_no").disabled=true;
					document.getElementById(prefix+"u").disabled=false;
					document.getElementById(prefix+"w").disabled=false;
					document.getElementById(prefix+"h").disabled=false;
					document.getElementById(prefix+"p").disabled=false;
					document.getElementById(prefix+"f").disabled=false;
				}else{
					document.getElementById(prefix+"divtype").style.display="none";
				}
				if(arr["u_id"]!="u_bytype" && arr["u_id"]!="u_manual"){
					zone_diafani_u();
				}
				
				document.getElementById(prefix+"u").value = arr["u"];
				
				document.getElementById(prefix+"type").value = arr["type"];
				zone_diafani_changetype();
				document.getElementById(prefix+"prostasia").value = arr["prostasia"];
				document.getElementById(prefix+"plaisio").value = arr["plaisio"];
				document.getElementById(prefix+"plaisioper").value = arr["plaisioper"];
				document.getElementById(prefix+"yalopinakas").value = arr["yalopinakas"];
				
				if(arr["passive"]==1){
					document.getElementById(prefix+"passive").checked = true;
				}else{
					document.getElementById(prefix+"passive").checked = false;
				}
				
				document.getElementById(prefix+"g_w").value = arr["g_w"];
				document.getElementById(prefix+"psil").value = arr["psi_l"];
				document.getElementById(prefix+"psia").value = arr["psi_a"];
				document.getElementById(prefix+"pistopoiisi").value = arr["pistopoiisi"];
				document.getElementById(prefix+"wind").value = arr["wind"];
				
				
				//Σκιάσεις
				var fhor = arr["fhor"].split("|");
				document.getElementById(prefix+"fhor_e").value = fhor[0];
				document.getElementById(prefix+"fhor_h").value = fhor[1];
				if(fhor[1]!=0){
					document.getElementById(prefix+"ck_fhor").checked = true;
				}else{
					document.getElementById(prefix+"ck_fhor").checked = false;
				}
				
				document.getElementById(prefix+"fov_l").value = arr["fov"];
				if(arr["fov"]!=0){
					document.getElementById(prefix+"ck_fov").checked = true;
				}else{
					document.getElementById(prefix+"ck_fov").checked = false;
				}
				
				var fovt = arr["fovt"].split("|");
				document.getElementById(prefix+"fovt_l").value = fovt[0];
				document.getElementById(prefix+"fovt_h").value = fovt[1];
				if(fovt[0]!=0){
					document.getElementById(prefix+"ck_fovt").checked = true;
				}else{
					document.getElementById(prefix+"ck_fovt").checked = false;
				}
				
				var ffin_l = arr["ffin_l"].split("|");
				document.getElementById(prefix+"ffin_l_dx").value = ffin_l[0];
				document.getElementById(prefix+"ffin_l_w").value = ffin_l[1];
				if(ffin_l[1]!=0){
					document.getElementById(prefix+"ck_ffin_l").checked = true;	
				}else{
					document.getElementById(prefix+"ck_ffin_l").checked = false;
				}
				
				var ffin_r = arr["ffin_r"].split("|");
				document.getElementById(prefix+"ffin_r_dx").value = ffin_r[0];
				document.getElementById(prefix+"ffin_r_w").value = ffin_r[1];
				if(ffin_r[1]!=0){
					document.getElementById(prefix+"ck_ffin_r").checked = true;
				}else{
					document.getElementById(prefix+"ck_ffin_r").checked = false;
				}
				
				var fsh = arr["fsh"].split("|");
				document.getElementById(prefix+"fsh_type").selectedIndex = fsh[0];
				document.getElementById(prefix+"fsh_l").value = fsh[1];
				document.getElementById(prefix+"fsh_h").value = fsh[2];
				if(fsh[1]!=0){
					document.getElementById(prefix+"ck_fsh").checked = true;	
				}else{
					document.getElementById(prefix+"ck_fsh").checked = false;
				}
				
				zone_diafani_showf();
				
				document.getElementById(prefix+"f_type").selectedIndex = arr["f_type"];
				zone_diafani_changef();

				
			document.getElementById('wait').style.display="none";
		}}
		
	$('.tabs-left a[href="#tab_modaldiafani_1"]').tab('show');
	}
	
	var button,edit_header;
	if(id!=0){
		button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_zone_diafani('+id+','+page+');">Επεξεργασία</button>';
		edit_header = 'Επεξεργασία διαφανούς';
	}else{
		button = '<button class="btn btn-solar" data-dismiss="modal" aria-hidden="true" onclick="submit_zone_diafani('+id+','+page+');">Προσθήκη</button>';
		edit_header = 'Προσθήκη διαφανούς';
	}
	document.getElementById("edit_button_zone_diafani").innerHTML = button;
	document.getElementById("edit_header_zone_diafani").innerHTML = edit_header;
	$("#modal_form_zone_diafani").modal("show");
	modal_height();
}

//ΔΙΑΓΡΑΦΗ
function formdel_zone_diafani(id,page){
	var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_zone_diafani('+id+','+page+');">Διαγραφή</button>';
	document.getElementById("del_button_zone_diafani").innerHTML = button;
	$("#modal_del_zone_diafani").modal("show");
}

//Υποβολή της φόρμας
//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
function submit_zone_diafani(id,page){
var prefix = "editzone_diafani_";
	var zone_id = document.getElementById(prefix+"zone_id").value;
	var wall_id;
		if(document.getElementById(prefix+"wall_id").disabled==true){
		wall_id=0;
		}else{
		wall_id = document.getElementById(prefix+"wall_id").value;
		}
	var roof_id;
		if(document.getElementById(prefix+"roof_id").disabled==true){
		roof_id=0;
		}else{
		roof_id = document.getElementById(prefix+"roof_id").value;
		}
	var name = document.getElementById(prefix+"name").value;
	var w = document.getElementById(prefix+"w").value;
	var h = document.getElementById(prefix+"h").value;
	var p = document.getElementById(prefix+"p").value;
	var f = document.getElementById(prefix+"f").value;
	var apoar = document.getElementById(prefix+"apoar").value;
	var u_id = document.getElementById(prefix+"u_id").value;
	var u_id_no = document.getElementById(prefix+"u_id_no").value;
	var u = document.getElementById(prefix+"u").value;
	var type = document.getElementById(prefix+"type").value;
	var prostasia = document.getElementById(prefix+"prostasia").value;
	var plaisio = document.getElementById(prefix+"plaisio").value;
	var plaisioper = document.getElementById(prefix+"plaisioper").value;
	var yalopinakas = document.getElementById(prefix+"yalopinakas").value;
	var passive;
		if(document.getElementById(prefix+"passive").checked==true){
			passive=1;
		}else{
			passive=0;
		}
	var g_w = document.getElementById(prefix+"g_w").value;	
	var psil = document.getElementById(prefix+"psil").value;
	var psia = document.getElementById(prefix+"psia").value;
	var pistopoiisi = document.getElementById(prefix+"pistopoiisi").value;
	var wind = document.getElementById(prefix+"wind").value;
	
	
	//Σκιάσεις
	var f_type = document.getElementById(prefix+"f_type").selectedIndex;
	
	var fhor_e, fhor_e;
	var ck_fhor = document.getElementById(prefix+"ck_fhor").checked;
	if(ck_fhor==true){
		fhor_e = document.getElementById(prefix+"fhor_e").value;
		fhor_h = document.getElementById(prefix+"fhor_h").value;
	}else{
		fhor_e=0;
		fhor_h=0;
	}
	
	var fov_l;
	var ck_fov = document.getElementById(prefix+"ck_fov").checked;
	if(ck_fov==true){
		fov_l = document.getElementById(prefix+"fov_l").value;
	}else{
		fov_l=0;
	}
	
	var fovt_l, fovt_h;
	var ck_fovt = document.getElementById(prefix+"ck_fovt").checked;
	if(ck_fovt==true){
		fovt_l = document.getElementById(prefix+"fovt_l").value;
		fovt_h = document.getElementById(prefix+"fovt_h").value;
	}else{
		fovt_l=0;
		fovt_h=0;
	}
	
	var ffin_l_dx, ffin_l_w;
	var ck_ffin_l = document.getElementById(prefix+"ck_ffin_l").checked;
	if(ck_ffin_l==true){
		ffin_l_dx = document.getElementById(prefix+"ffin_l_dx").value;
		ffin_l_w = document.getElementById(prefix+"ffin_l_w").value;
	}else{
		ffin_l_dx=0;
		ffin_l_w=0;
	}
	
	var ffin_r_dx, ffin_r_w;
	var ck_ffin_r = document.getElementById(prefix+"ck_ffin_r").checked;
	if(ck_ffin_r==true){
		ffin_r_dx = document.getElementById(prefix+"ffin_r_dx").value;
		ffin_r_w = document.getElementById(prefix+"ffin_r_w").value;
	}else{
		ffin_r_dx=0;
		ffin_r_w=0;
	}
	
	var fsh_type, fsh_l, fsh_h;
	var ck_fsh = document.getElementById(prefix+"ck_fsh").checked;
	fsh_type = document.getElementById(prefix+"fsh_type").selectedIndex;
	if(ck_fsh==true){
		fsh_l = document.getElementById(prefix+"fsh_l").value;
		fsh_h = document.getElementById(prefix+"fsh_h").value;
	}else{
		fsh_l=0;
		fsh_h=0;
	}
	
	
	if(id==0){
	var action="create";
	}else{
	action="update";
	}
	var link = "includes/functions_meleti_general.php?insert_iddata=1";
	link += "&table=meletes_zone_diafani";
	link += "&action="+action;
	link += "&id="+id;
	link += "&values="+zone_id+","+wall_id+","+roof_id+","+name+","+w+","+h+","+p+","+f;
	link += ","+apoar+","+u+","+u_id+","+u_id_no+","+type+","+prostasia+","+plaisio+","+plaisioper+","+yalopinakas+","+g_w;
	link += ","+psil+","+psia+","+pistopoiisi+","+wind+","+passive;
	link += ","+f_type+","+fhor_e+"|"+fhor_h;
	link += ","+fov_l;
	link += ","+fovt_l+"|"+fovt_h;
	link += ","+ffin_l_dx+"|"+ffin_l_w;
	link += ","+ffin_r_dx+"|"+ffin_r_w;
	link += ","+fsh_type+"|"+fsh_l+"|"+fsh_h;
	
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("zone_diafani_info").innerHTML=xmlhttp.responseText;
		document.getElementById('wait').style.display="none";
		get_zone_diafani(page);
		get_meleti_n();
	}}
}

//Διαγραφή
function del_zone_diafani(id,page){
	var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_diafani&id="+id;
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("zone_diafani_info").innerHTML=xmlhttp.responseText;
		document.getElementById('wait').style.display="none";
		get_zone_diafani(page);
		get_meleti_n();
	}}
}

//Αλλαγή select τοίχων/οροφών με βάση τη ζώνη
function zone_diafani_changezone(){
var prefix = "editzone_diafani_";
var zone_id = document.getElementById(prefix+"zone_id").value;
	zone_diafani_getwalls(zone_id);
	zone_diafani_getroofs(zone_id);
}

//Αλλαγή select τοίχων/οροφών
function zone_diafani_belongs(n){
var prefix = "editzone_diafani_";
	if(n==1){
		document.getElementById(prefix+"wall_id").disabled=false;
		document.getElementById(prefix+"roof_id").disabled=true;
	}
	if(n==2){
		document.getElementById(prefix+"wall_id").disabled=true;
		document.getElementById(prefix+"roof_id").disabled=false;
	}
}

//Αλλαγή τρόπου υπολογισμού U ανοιγμάτων
function zone_diafani_u(){
var prefix = "editzone_diafani_";
var u_id = document.getElementById(prefix+"u_id").value;
	if(u_id=="u_manual"){
		document.getElementById(prefix+"u_id_no").disabled=true;
		document.getElementById(prefix+"u_id_no").innerHTML = "<option value=0>Άνοιγμα</option>";
		document.getElementById(prefix+"u").disabled=false;
		document.getElementById(prefix+"divtype").style.display="none";
		
		document.getElementById(prefix+"w").disabled=false;
		document.getElementById(prefix+"h").disabled=false;
		document.getElementById(prefix+"p").disabled=false;
		document.getElementById(prefix+"f").disabled=false;
		
		document.getElementById(prefix+"pistopoiisi").disabled=true;
	}
	if(u_id=="u_bytype"){
	var type = document.getElementById(prefix+"type").value;
	var plaisio = document.getElementById(prefix+"plaisio").value;
	var plaisioper = document.getElementById(prefix+"plaisioper").value;
	var yalopinakas = document.getElementById(prefix+"yalopinakas").value;
	
		document.getElementById(prefix+"u_id_no").disabled=true;
		document.getElementById(prefix+"u").disabled=false;
		document.getElementById(prefix+"divtype").style.display="block";
		
		document.getElementById(prefix+"w").disabled=false;
		document.getElementById(prefix+"h").disabled=false;
		document.getElementById(prefix+"p").disabled=false;
		document.getElementById(prefix+"f").disabled=false;
		
		zone_diafani_pistopoiisi();
		zone_diafani_findu();
	}
	if(u_id!="u_bytype" && u_id!="u_manual"){
		document.getElementById(prefix+"u_id_no").disabled=false;
		document.getElementById(prefix+"u").disabled=true;
		document.getElementById(prefix+"divtype").style.display="none";
		
		document.getElementById(prefix+"w").disabled=true;
		document.getElementById(prefix+"h").disabled=true;
		document.getElementById(prefix+"f").disabled=true;
		
		document.getElementById(prefix+"pistopoiisi").disabled=false;
		zone_diafani_findu();
	}	
}

//Εύρεση των στοιχείων του ανοίγματος από τον υπολογισμό
//1 με πινακα , 2 με αποθηκευμενο υπολογισμο
function zone_diafani_findu(){
var prefix = "editzone_diafani_";
var type;
var u_id = document.getElementById(prefix+"u_id").value;
if(u_id=="u_bytype"){type=1;}
if(u_id!="u_bytype" && u_id!="u_manual"){type=2;}

var parameters = "";
	if(type==2){
		var u_id_no = document.getElementById(prefix+"u_id_no").value;
		parameters += u_id+"|"+u_id_no;
	}
	if(type==1){
		var typew = document.getElementById(prefix+"type").value;
		var prostasia = document.getElementById(prefix+"prostasia").value;
		var plaisio = document.getElementById(prefix+"plaisio").value;
		var plaisioper = document.getElementById(prefix+"plaisioper").value;
		var yalopinakas = document.getElementById(prefix+"yalopinakas").value;
		parameters += typew+"|"+prostasia+"|"+plaisio+"|"+plaisioper+"|"+yalopinakas;
	}

	var link = "includes/functions_meleti_general.php?findu_diafani=1&type="+type+"&parameters="+parameters;
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		
		if(type==2){
		var arr = JSON.parse(xmlhttp.responseText);
		document.getElementById(prefix+"w").value=arr[0];
		document.getElementById(prefix+"h").value=arr[1];
		document.getElementById(prefix+"f").value=arr[2];
		document.getElementById(prefix+"u").value=arr[3];
		document.getElementById(prefix+"g_w").value=arr[4];
		}
		if(type==1){
		var arr = JSON.parse(xmlhttp.responseText);
		document.getElementById(prefix+"u").value=arr[0];
		document.getElementById(prefix+"g_w").value=arr[1];
		}
		document.getElementById('wait').style.display="none";
	}}
	if(type==1){
	zone_diafani_findwind();
	}
}

//Εύρεση συντελεστή αερισμού
function zone_diafani_findwind(){
var prefix = "editzone_diafani_";
	var typew = document.getElementById(prefix+"type").value;
	var plaisio = document.getElementById(prefix+"plaisio").value;
	var yalopinakas = document.getElementById(prefix+"yalopinakas").value;
	var pistopoiisi = document.getElementById(prefix+"pistopoiisi").value;
	
	parameters = typew+"|"+plaisio+"|"+yalopinakas+"|"+pistopoiisi;
	var link = "includes/functions_meleti_general.php?findwind_diafani=1&parameters="+parameters;
	
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById(prefix+"wind").value=xmlhttp.responseText;
		document.getElementById('wait').style.display="none";
	}}

}

function zone_diafani_changetype(){
var prefix = "editzone_diafani_";
var type = document.getElementById(prefix+"type").value;
var plaisio_txt;
	if(type==0){
		document.getElementById(prefix+"yalopinakas").disabled=false;
		document.getElementById(prefix+"plaisio").disabled=false;
		document.getElementById(prefix+"plaisioper").disabled=true;
		
		plaisio_txt = "<option value=8>Μεταλλική πόρτα</option>";
		plaisio_txt += "<option value=9>Συνθετική πόρτα</option>";
		plaisio_txt += "<option value=10>Ξυλινη πόρτα</option>";
	}
	if(type>=1 && type<=3){
		document.getElementById(prefix+"yalopinakas").disabled=false;
		document.getElementById(prefix+"plaisio").disabled=false;
		document.getElementById(prefix+"plaisioper").disabled=false;
		
		plaisio_txt = "<option value=1>Μεταλλικό πλαίσιο χωρίς θερμοδιακοπή</option>";
		plaisio_txt += "<option value=2>Μεταλλικό πλαίσιο με θερμοδιακοπή 12mm</option>";
		plaisio_txt += "<option value=3>Μεταλλικό πλαίσιο με θερμοδιακοπή 24mm</option>";
		plaisio_txt += "<option value=4>Συνθετικό πλαίσιο</option>";
		plaisio_txt += "<option value=5>Ξύλινο πλαίσιο</option>";
		plaisio_txt += "<option value=6>Διπλό κούφωμα (ξύλινο)</option>";
		plaisio_txt += "<option value=7>Διπλό κούφωμα (αλουμινίου)</option>";
	}
	if(type>=4){
		document.getElementById(prefix+"yalopinakas").disabled=true;
		document.getElementById(prefix+"plaisio").disabled=true;
		document.getElementById(prefix+"plaisioper").disabled=true;
	}
	
	document.getElementById(prefix+"plaisio").innerHTML=plaisio_txt;
	document.getElementById(prefix+"plaisio").selectedIndex=0;
	zone_diafani_changeplaisio();
}

function zone_diafani_changeplaisio(){
var prefix = "editzone_diafani_";
var plaisio = document.getElementById(prefix+"plaisio").value;
var yalo_txt, per_txt;

	if(plaisio==1){
		yalo_txt = "<option value=3>Μονός</option>";
		yalo_txt += "<option value=4>Δίδυμος υαλοπίνακας με διάκενο αέρα 6mm</option>";
		yalo_txt += "<option value=5>Δίδυμος υαλοπίνακας με διάκενο αέρα 12mm</option>";
		yalo_txt += "<option value=6>Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 6mm</option>";
		yalo_txt += "<option value=7>Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 12mm</option>";
	}
	if(plaisio>=2 && plaisio<=4){
		yalo_txt = "<option value=4>Δίδυμος υαλοπίνακας με διάκενο αέρα 6mm</option>";
		yalo_txt += "<option value=5>Δίδυμος υαλοπίνακας με διάκενο αέρα 12mm</option>";
		yalo_txt += "<option value=6>Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 6mm</option>";
		yalo_txt += "<option value=7>Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 12mm</option>";
	}
	//Ξύλινο πλαίσιο
	if(plaisio==5){
		yalo_txt = "<option value=3>Μονός</option>";
		yalo_txt += "<option value=4>Δίδυμος υαλοπίνακας με διάκενο αέρα 6mm</option>";
		yalo_txt += "<option value=5>Δίδυμος υαλοπίνακας με διάκενο αέρα 12mm</option>";
		yalo_txt += "<option value=6>Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 6mm</option>";
		yalo_txt += "<option value=7>Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 12mm</option>";
	}
	//Διπλό παράθυρο
	if(plaisio>=6 && plaisio<=7){
		yalo_txt = "<option value=3>Μονός</option>";
	}
	if(plaisio>=8 && plaisio<=10){
		yalo_txt = "<option value=1>Χωρίς υαλοπίνακα σε αέρα</option>";
		yalo_txt += "<option value=2>Χωρίς υαλοπίνακα σε ΜΘΧ</option>";
	}
	
	document.getElementById(prefix+"yalopinakas").innerHTML=yalo_txt;

}

//Αλλαγή select πιστοποίησης
function zone_diafani_pistopoiisi(){
var prefix = "editzone_diafani_";
	var yalopinakas = document.getElementById(prefix+"yalopinakas").value;
	document.getElementById(prefix+"pistopoiisi").disabled=false;
	if(yalopinakas>=4 && yalopinakas<=7){
		document.getElementById(prefix+"pistopoiisi").value=2;
	}else{
		document.getElementById(prefix+"pistopoiisi").value=1;
	}
}

//ΣΚΙΑΣΕΙΣ ΑΝΟΙΓΜΑΤΩΝ
function zone_diafani_showf(){
var prefix = "editzone_diafani_";

//divs
document.getElementById(prefix+"fhor").style.display="none";
document.getElementById(prefix+"fov").style.display="none";
document.getElementById(prefix+"fovt").style.display="none";
document.getElementById(prefix+"ffin_l").style.display="none";
document.getElementById(prefix+"ffin_r").style.display="none";
document.getElementById(prefix+"fsh").style.display="none";

	if(document.getElementById(prefix+"ck_fhor").checked==true){
	document.getElementById(prefix+"fhor").style.display="inline";
	}
	if(document.getElementById(prefix+"ck_fov").checked==true){
	document.getElementById(prefix+"fov").style.display="inline";
	}
	if(document.getElementById(prefix+"ck_fovt").checked==true){
	document.getElementById(prefix+"fovt").style.display="inline";
	}
	if(document.getElementById(prefix+"ck_ffin_l").checked==true){
	document.getElementById(prefix+"ffin_l").style.display="inline";
	}
	if(document.getElementById(prefix+"ck_ffin_r").checked==true){
	document.getElementById(prefix+"ffin_r").style.display="inline";
	}
	if(document.getElementById(prefix+"ck_fsh").checked==true){
	document.getElementById(prefix+"fsh").style.display="inline";
	}

}

function zone_diafani_changef(){
var prefix = "editzone_diafani_";
var type = document.getElementById(prefix+"f_type").selectedIndex;
	if(type > 0){
		document.getElementById(prefix+"ck_fhor").checked=false;
		document.getElementById(prefix+"ck_fov").checked=false;
		document.getElementById(prefix+"ck_fovt").checked=false;
		document.getElementById(prefix+"ck_ffin_l").checked=false;
		document.getElementById(prefix+"ck_ffin_r").checked=false;
		document.getElementById(prefix+"ck_fsh").checked=false;
		
		document.getElementById(prefix+"ck_fhor").disabled=true;
		document.getElementById(prefix+"ck_fov").disabled=true;
		document.getElementById(prefix+"ck_fovt").disabled=true;
		document.getElementById(prefix+"ck_ffin_l").disabled=true;
		document.getElementById(prefix+"ck_ffin_r").disabled=true;
		document.getElementById(prefix+"ck_fsh").disabled=true;
	}else{
		document.getElementById(prefix+"ck_fhor").disabled=false;
		document.getElementById(prefix+"ck_fov").disabled=false;
		document.getElementById(prefix+"ck_fovt").disabled=false;
		document.getElementById(prefix+"ck_ffin_l").disabled=false;
		document.getElementById(prefix+"ck_ffin_r").disabled=false;
		document.getElementById(prefix+"ck_fsh").disabled=false;
	}
	zone_diafani_showf();
}

//Αλλαγή εικόνας θερμογεφυρών ανάλογα με την θερμογέφυρα
function zone_diafani_psi_img(typos){
	var prefix,type;
	if(typos==1){
	prefix = "editzone_diafani_psil";
	type="lp";
	}
	if(typos==2){
	prefix = "editzone_diafani_psia";
	type="yp";
	}
	var no = document.getElementById(prefix).value;
	
	var img = "<img src=\"images/thermo/"+type+"/"+type+no+".jpg\">";
	document.getElementById("editzone_diafani_psi_img").innerHTML = img;	
}

function zone_diafani_draw(){
var prefix = "editzone_diafani_";
	var name = document.getElementById(prefix+"name").value;
	var aw = document.getElementById(prefix+"w").value;
	var ah = document.getElementById(prefix+"h").value;
	var af = document.getElementById(prefix+"f").value;
	
	var x="includes/anoigmata_image_creation.php?";
	x+="name="+name+"&aw="+aw+"&ah="+ah+"&af="+af+"&mpp=5&p=1";
	
	document.getElementById(prefix+"preview1").innerHTML = "<img src=\""+x+"\" ></img><br/>Θεωρείται μέσο πλάτος πλαισίου 5cm.";
}
</script>

<!-- ###################### Κρυφό modal_form_zone_diafani για εμφάνιση ###################### -->
<div id="modal_form_zone_diafani" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_zone_diafani"></span></h6>
	</div>

	<div class="modal-body">
	
	
	<div class="tabbable tabs-left">
		<ul class="nav nav-zone">
		<li class="active"><a href="#tab_modaldiafani_1" data-toggle="tab">Άνοιγμα</a></li>
		<li><a href="#tab_modaldiafani_2" data-toggle="tab">Ψ/Αερισμός</a></li>
		<li><a href="#tab_modaldiafani_3" data-toggle="tab">Σκιάσεις</a></li>
		<li><a href="#tab_modaldiafani_4" data-toggle="tab" onclick="zone_diafani_draw();">Προεπισκόπηση</a></li>
		</ul>
		
		<div class="tab-content">
			
			<div class="tab-pane active" id="tab_modaldiafani_1">
	
	<table class="table table-bordered table-condensed">
		<tr class="info"><td colspan="2">Διαφανή</td></tr>
		<tr>
		<td style="width:50%;">
			<div id="editzone_diafani_divthesi">
				<table class="table table-bordered table-condensed">
				<tr class="warning">
					<td><i class="fa fa-book"></i> Θέση</td>
				</tr>
				<tr>
					<td>
						<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="Επιλέξτε θερμική ζώνη για να εμφανιστούς οι διαθέσιμοι τοίχοι, οροφές"><i class="fa fa-cubes"></i> Ζώνη</span>
							</span>
							<select class="form-control input-sm" id="editzone_diafani_zone_id" onchange="zone_diafani_changezone();">
								<option value=0></option>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="row">
							<div class="col-md-6">
								<input class="radio-inline" type="radio" id="radio1" name="flowdir" value="1" onclick="zone_diafani_belongs(1);"/> 
								<a class="tooltipui" href="#" title="Ανήκει σε τοίχο"> Τοίχου</a>
							</div>
							<div class="col-md-6">
								<input class="radio-inline" type="radio" id="radio2" name="flowdir" value="2" onclick="zone_diafani_belongs(2);"/> 
								<a class="tooltipui" href="#" title="Ανήκει σε οροφή"> Οροφής</a>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group has-success">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Τοιχοποιία που ανήκει το άνοιγμα"><i class="fa fa-building"></i> Τοίχος</span>
								</span>
								<select class="form-control input-sm" id="editzone_diafani_wall_id">
									<option value=0></option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group has-warning">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Οροφή που ανήκει το άνοιγμα"><i class="fa fa-building"></i> Οροφή</span>
								</span>
								<select class="form-control input-sm" id="editzone_diafani_roof_id">
									<option value=0></option>
								</select>
							</div>
						</div>
					</div>	
					</td>
				</tr>
				<tr>
					<td>
						<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="Ένα χαρακτηριστικό όνομα για το άνοιγμα"><i class="fa fa-keyboard-o"></i> Όνομα</span>
							</span>
							<input class="form-control input-sm" type="text" id="editzone_diafani_name">
						</div>
					</td>
				</tr>
				</table>
			</div>
			
			<div id="editzone_diafani_divdimensions">
				<table class="table table-bordered table-condensed">
					<tr class="warning">
						<td><i class="fa fa-arrows-h"></i> Διαστάσεις</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Η οριζόντια διάσταση (μήκος) του παραθύρου/πόρτας"><i class="fa fa-arrows-h"></i> Μήκος</span>
								</span>
								<input class="form-control input-sm" type="text" id="editzone_diafani_w">
								<span class="input-group-addon">m</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Η κατακόρυφη διάσταση (καθαρό ύψος) του παραθύρου/πόρτας"><i class="fa fa-arrows-v"></i> Ύψος</span>
								</span>
								<input class="form-control input-sm" type="text" id="editzone_diafani_h">
								<span class="input-group-addon">m</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Η απόσταση της κάτω παρειάς από την κάτω παρειά της τοιχοποιίας"><i class="fa fa-arrow-down"></i> Ποδιά</span>
								</span>
								<input class="form-control input-sm" type="text" id="editzone_diafani_p">
								<span class="input-group-addon">m</span>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Ο αριθμός των ανοιγόμενων φύλλων του παραθύρου/πόρτας"><i class="fa fa-pause"></i> Φύλλα</span>
								</span>
								<input class="form-control input-sm" type="text" id="editzone_diafani_f">
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Απόσταση από αριστερό άκρο του τοίχου"><i class="fa fa-arrow-left"></i> Απ. αριστερά</span>
								</span>
								<input class="form-control input-sm" type="text" id="editzone_diafani_apoar">
								<span class="input-group-addon">m</span>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</td>
		<td>
			
			<div id="editzone_diafani_divu">
				<table class="table table-bordered table-condensed">
					<tr class="warning">
						<td><i class="fa fa-exchange text-danger"></i> U</td>
					</tr>
					<tr>
						<td>
						<div class="row">
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon">
										<span class="tip-top" href="#" title="Αποθηκευμένος υπολογισμός διαφανών"><i class="fa fa-calculator"></i> Υπολογισμός</span>
									</span>
									<select class="form-control input-sm" id="editzone_diafani_u_id" onchange="zone_diafani_u(); zone_diafani_getwindows();">
										<option value="u_manual">Χειροκίνητα</option>
										<option value="u_bytype">Από είδος (ΠΕΑ)</option>
										<?php
										echo create_select_optionsid("user_diafani","name",array("user_id"=>$_SESSION["user_id"]) );
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon">
										<span class="tip-top" href="#" title="Το άνοιγμα του αποθηκευμένου υπολογισμού από τα 10."><i class="fa fa-calculator"></i> Αν</span>
									</span>
									<select class="form-control input-sm" type="text" id="editzone_diafani_u_id_no" onchange="zone_diafani_u();"/>
										<option value=0>Στοιχείο...</option>
									</select>
								</div>
							</div>
						</div>	
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Συντελεστής θερμοπερατότητας"><i class="fa fa-thermometer-half"></i> U</span>
								</span>
								<input type="text" id="editzone_diafani_u" class="form-control input-sm" />
								<span class="input-group-addon"> W/m<sup>2</sup>.K</span>
							</div>
						</td>
					</tr>
				</table>
			</div>
			
			<div id="editzone_diafani_divtype">
				<table class="table table-bordered table-condensed">
					<tr style="background-color:#DCFFEB;">
						<td><i class="fa calculator"></i> Από είδος (ΠΕΑ)</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon" style="background-color:#DCFFEB;">
									<span class="tip-top" href="#" title="Γενικός τύπος του ανοίγματος (για επιπλέον επιλογές προσθήκης)"><i class="fa fa-tags"></i> Τύπος</span>
								</span>
								<select class="form-control input-sm" id="editzone_diafani_type" onchange="zone_diafani_changetype(); zone_diafani_u();">
									<option value=0>Αδιαφανης πόρτα</option>
									<option value=1>Παράθυρο</option>
									<option value=2>Πόρτα</option>
									<option value=3>Μη ανοιγόμενο κούφωμα</option>
									<option value=4>Υαλότουβλα</option>
									<option value=5>Ανοιγόμενη γυάλινη πρόσοψη</option>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon" style="background-color:#DCFFEB;">
									<span class="tip-top" href="#" title="Προστασία από εξώφυλλα/ρολά<br/><img src='images/style/building/roll.jpg' width='180px'/>"><i class="fa fa-tags"></i> Προστασία</span>
								</span>
								<select class="form-control input-sm" id="editzone_diafani_prostasia" onchange="zone_diafani_u();">
									<option value=0>Χωρίς προστασία</option>
									<option value=1>Με ρολά</option>
									<option value=2>Με εξώφυλλα</option>
								</select>
							</div>
						</td>
					</tr>
					<tr>	
						<td>
							<div class="input-group">
								<span class="input-group-addon" style="background-color:#DCFFEB;">
									<span class="tip-top" href="#" title="Τύπος πλαισίου<br/><img src='images/style/building/fylla.jpg' width='180px'/>"><i class="fa fa-tags"></i> Πλαίσιο</span>
								</span>
								<select class="form-control input-sm" id="editzone_diafani_plaisio" onchange="zone_diafani_changeplaisio(); zone_diafani_u();">
									<option value=0></option>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon" style="background-color:#DCFFEB;">
									<span class="tip-top" href="#" title="Ποσοστό πλαισίου στο άνοιγμα"><i class="fa fa-tags"></i> % πλαισίου</span>
								</span>
								<select class="form-control input-sm" id="editzone_diafani_plaisioper" onchange="zone_diafani_u();">
									<option value=20>20%</option>
									<option value=30>30%</option>
									<option value=40>40%</option>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon" style="background-color:#DCFFEB;">
									<span class="tip-top" href="#" title="Τύπος υαλοπίνακα"><i class="fa fa-tags"></i> Υαλοπίνακας</span>
								</span>
								<select class="form-control input-sm" id="editzone_diafani_yalopinakas" onchange="zone_diafani_u();">
									<option value=0></option>
								</select>
							</div>
						</td>
					</tr>
				</table>
			</div>
			
			<div id="editzone_diafani_divaktinovolia">
				<table class="table table-bordered table-condensed">
					<tr class="warning">
						<td><i class="fa fa-sun-o"></i> Ακτινοβολία / Παθητικά</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Διαπερατότητα της ηλιακής ακτινοβολίας"><i class="fa fa-sun-o"></i> g<sub>w</sub></span>
								</span>
								<input class="form-control input-sm" type="text" id="editzone_diafani_g_w">
							</div>
						</td>
					</tr>
					<tr>	
						<td style="text-align:center;">
							<div class="row">
								<div class="col-md-2">
								
								</div>
								<div class="col-md-10">
									<div class="input-group">
										<label class="checkbox"><input type="checkbox" id="editzone_diafani_passive">Παθητικά ηλιακά άμεσου κέρδους</label>
									</div>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
			
		</td>
		</tr>	
	</table>
	</div><!--tab_modaldiafani_1-->	
	
	<div class="tab-pane" id="tab_modaldiafani_2">
		
		<table class="table table-bordered table-condensed">
		<tr class="info"><td colspan="2">Ψ/Αερισμός</td></tr>
		<tr>
		<td style="width:50%;">
		
			<div id="editzone_diafani_divpsi">
				<table class="table table-bordered table-condensed">
				<tr class="warning">
					<td><i class="fa fa-fire"></i> Ψ</td>
				</tr>
				<tr>
					<td>
						<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="Θερμογέφυρα λαμπά (δεξιά/αριστερά του ανοίγματος)"><i class="fa fa-briefcase"></i> Ψ λαμπά</span>
							</span>
							<select class="form-control input-sm" id="editzone_diafani_psil" onchange="zone_diafani_psi_img(1);">
								<?php
								echo meletes_getthermoselect(10);
								?>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="Θερμογέφυρα ανωκάσι/κατωκάσι"><i class="fa fa-briefcase"></i> Ψ ανωκάσι/κατωκάσι</span>
							</span>
							<select class="form-control input-sm" id="editzone_diafani_psia" onchange="zone_diafani_psi_img(2);">
								<?php
								echo meletes_getthermoselect(11);
								?>
							</select>
						</div>
					</td>
				</tr>
				</table>
			</div>
			
			<div id="editzone_diafani_divwind">
				<table class="table table-bordered table-condensed">
				<tr class="warning">
					<td><i class="fa fa-flag"></i> Διείσδυση αέρα</td>
				</tr>
				<tr>
					<td>
						<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="Πιστοποιημένο ή μη κούφωμα. Επιλέγεται αυτόματα."><i class="fa fa-briefcase"></i> Πιστοποίηση</span>
							</span>
							<select class="form-control input-sm" id="editzone_diafani_pistopoiisi" onchange="zone_diafani_findwind();">
								<option value=1>Μονός/πόρτα χωρίς αεροστεγανότητα</option>
								<option value=2>Διπλός ή χωρίς πιστοποίηση</option>
								<option value=3>Κλάση 1 (7.7)</option>
								<option value=4>Κλάση 2 (4.1)</option>
								<option value=5>Κλάση 3 (1.4)</option>
								<option value=6>Κλάση 4 (0.5)</option>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="Συντελεστής αερισμού του κουφώματος σε m3/h ανά m2 κουφώματος"><i class="fa fa-briefcase"></i> Συντελεστής</span>
							</span>
							<input class="form-control input-sm" type="text" id="editzone_diafani_wind">
							<span class="input-group-addon">m3/h/m2</span>
						</div>
					</td>
				</tr>
				</table>
			</div>
			
		</td>
		<td style="width:50%;">
			<div id="editzone_diafani_psi_img"></div>
		</td>
		</tr>
		</table>
		
	</div><!--tab_modaldiafani_2-->
	
	<div class="tab-pane" id="tab_modaldiafani_3">
	<div id="adiafani_ck_f">
	<form class="form-inline">
		<label class="checkbox inline"><input type="checkbox" id="editzone_diafani_ck_fhor" onchange="zone_diafani_showf();">F<sub>hor</sub></label>
		<label class="checkbox inline"><input type="checkbox" id="editzone_diafani_ck_fov" onchange="zone_diafani_showf();">F<sub>ov</sub></label>
		<label class="checkbox inline"><input type="checkbox" id="editzone_diafani_ck_fovt" onchange="zone_diafani_showf();">F<sub>ovt</sub></label>
		<label class="checkbox inline"><input type="checkbox" id="editzone_diafani_ck_ffin_l" onchange="zone_diafani_showf();">F<sub>fin_l</sub></label>
		<label class="checkbox inline"><input type="checkbox" id="editzone_diafani_ck_ffin_r" onchange="zone_diafani_showf();">F<sub>fin_r</sub></label>
		<label class="checkbox inline"><input type="checkbox" id="editzone_diafani_ck_fsh" onchange="zone_diafani_showf();">F<sub>sh</sub></label>
	</form>
	</div>
	<div id="diafani_ck_f1">
		<select class="form-control input-sm" id="editzone_diafani_f_type" onchange="zone_diafani_changef();" >
			<option value=0>Με υπολογισμό</option>
			<option value=1>Ολική</option>
			<option value=2>Ασκίαστο</option>
			<option value=3>Από τοίχο</option>
		</select>
	</div>
				<div id="editzone_diafani_fhor" style="display:none;">
					<table class="table table-bordered table-condensed">
						<tr class="info">
							<td colspan=2>
								Σκίαση από εμπόδια ορίζοντα - F<sub>hor</sub>
							</td>
						</tr>
						<tr>
							<td width=50%>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Απόσταση εμποδίου ορίζοντα σε m"><i class="fa fa-arrows-v"></i> Απόσταση εμποδίου</span>
								</span>
								<input type="text" id="editzone_diafani_fhor_e" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Ύψος εμποδίου ορίζοντα σε m"><i class="fa fa-arrows-h"></i> Ύψος εμποδίου</span>
								</span>
								<input type="text" id="editzone_diafani_fhor_h" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
						</tr>
					</table>
				</div>
				
				<div id="editzone_diafani_fov" style="display:none;">
					<table class="table table-bordered table-condensed">
						<tr class="info">
							<td>
								Σκίαση από εμπόδια προβόλου - F<sub>ov</sub>
							</td>
						</tr>
						<tr>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Μήκος προβόλου σε m"><i class="fa fa-arrows-v"></i> Μήκος προβόλου</span>
								</span>
								<input type="text" id="editzone_diafani_fov_l" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
						</tr>
					</table>
				</div>
				
				<div id="editzone_diafani_fovt" style="display:none;">
					<table class="table table-bordered table-condensed">
						<tr class="info">
							<td colspan=2>
								Σκίαση από εμπόδια τεντών - F<sub>ovt</sub>
							</td>
						</tr>
						<tr>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Μήκος τέντας σε m"><i class="fa fa-arrows-v"></i> Μήκος τέντας</span>
								</span>
								<input type="text" id="editzone_diafani_fovt_l" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Ύψος τέντας σε m"><i class="fa fa-arrows-h"></i> Ύψος τέντας</span>
								</span>
								<input type="text" id="editzone_diafani_fovt_h" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
						</tr>
					</table>
				</div>
				
				<div id="editzone_diafani_ffin_l" style="display:none;">
					<table class="table table-bordered table-condensed">
						<tr class="info">
							<td colspan="2">
								Σκίαση από πλευρικά εμπόδια (από αριστερά) - F<sub>fin_l</sub>
							</td>
						</tr>
						<tr>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Απόσταση εμποδίου από τοίχο αριστερά"><i class="fa fa-eraser"></i> Απόσταση από αριστερά</span>
								</span>
								<input type="text" id="editzone_diafani_ffin_l_dx" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Μήκος πλευρικού εμποδίου"><i class="fa fa-eraser"></i> Μήκος εμποδίου</span>
								</span>
								<input type="text" id="editzone_diafani_ffin_l_w" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
						</tr>
					</table>
				</div>
				
				<div id="editzone_diafani_ffin_r" style="display:none;">
					<table class="table table-bordered table-condensed">
						<tr class="info">
							<td colspan="2">
								Σκίαση από πλευρικά εμπόδια (από δεξιά) - F<sub>fin_r</sub>
							</td>
						</tr>
						<tr>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Απόσταση εμποδίου από τοίχο δεξιά"><i class="fa fa-eraser"></i> Απόσταση από δεξιά</span>
								</span>
								<input type="text" id="editzone_diafani_ffin_r_dx" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Μήκος πλευρικού εμποδίου"><i class="fa fa-eraser"></i> Μήκος εμποδίου</span>
								</span>
								<input type="text" id="editzone_diafani_ffin_r_w" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
						</tr>
					</table>
				</div>
				
				<div id="editzone_diafani_fsh" style="display:none;">
					<table class="table table-bordered table-condensed">
						<tr class="info">
							<td colspan="3">
								Σκίαση από περσίδες - F<sub>sh</sub>
							</td>
						</tr>
						<tr>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Τύπος περσίδων (σταθερές ή κινητές)"><i class="fa fa-eraser"></i> Τύπος περσίδων</span>
								</span>
								<select id="editzone_diafani_fsh_type" class="form-control input-sm" />
									<option value="1">Σταθερές</option>
									<option value="2">Κινητές</option>
								</select>
								</div>
							</td>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Μήκος πλευρικού εμποδίου"><i class="fa fa-arrows-v"></i> Μήκος περσίδων</span>
								</span>
								<input type="text" id="editzone_diafani_fsh_l" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Μήκος πλευρικού εμποδίου"><i class="fa fa-arrows-h"></i> Απόσταση περσίδων</span>
								</span>
								<input type="text" id="editzone_diafani_fsh_h" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
						</tr>
					</table>
				</div>
	</div><!--tab_modaldiafani_3-->
	
	<div class="tab-pane" id="tab_modaldiafani_4">
		<div class="thumbnail">
		<div id="editzone_diafani_preview1">
			
		</div>
		</div>
	</div><!--tab_modaldiafani_4-->
</div>
</div>
	
</div><!--modal-body-->

<div class="modal-footer">	
	<span id="edit_button_zone_diafani"></span>
	<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->	
<!-- ###################### Κρυφό modal_del_zone_diafani για εμφάνιση ###################### -->
<div id="modal_del_zone_diafani" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h6 id="myModalLabel">Διαγραφή διαφανούς</h6>
</div>

<div class="modal-body">
Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
</div>	

<div class="modal-footer">	
	<span id="del_button_zone_diafani"></span>
	<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
