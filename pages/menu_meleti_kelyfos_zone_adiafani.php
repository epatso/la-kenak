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
<div id="zone_adiafani_table"></div>
<div id="zone_adiafani_info"></div>
<script>
get_zone_adiafani();

//Εμφάνιση πίνακα με όλες τις μονάδες παραγωγής του χρήστη
function get_zone_adiafani(page){
page = typeof page !== 'undefined' ? page : 1;
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","includes/functions_meleti_kelyfos.php?getzoneadiafani=1&page="+page ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("zone_adiafani_table").innerHTML=xmlhttp.responseText;
		document.getElementById('wait').style.display="none";
		setUpToolTipHelpers();
	}}
}

//Εύρεση διαθέσιμων θερμικών ζωνών ή ΜΘΧ
function zone_adiafani_getzones(type,zone_id){
type = typeof type !== 'undefined' ? type : 0;
var prefix = "editzone_adiafani_";

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
function form_zone_adiafani(id,page){
	page = typeof page !== 'undefined' ? page : 1;
var prefix = "editzone_adiafani_";
var yp,dok,syr;
	if(id==0){
	zone_adiafani_getzones(0);
	zone_adiafani_getzones(1);
	document.getElementById(prefix+"zone_id").selectedIndex = 0;
	document.getElementById(prefix+"name").value = "";
	
	document.getElementById(prefix+"g_type").selectedIndex = 1;
	zone_adiafani_gtype();
	document.getElementById(prefix+"b_type").value = 1;
	zone_adiafani_btype();
	
	document.getElementById(prefix+"type").selectedIndex = 0;
	zone_adiafani_changetype();
	document.getElementById(prefix+"mthx_id").selectedIndex = 0;
	
	document.getElementById(prefix+"l").value = <?php echo $wall_l;?>;
	document.getElementById(prefix+"h").value = <?php echo $wall_h;?>;
	document.getElementById(prefix+"d").value = <?php echo $wall_d;?>;
	document.getElementById(prefix+"dy").value = 0;
	document.getElementById(prefix+"dx").value = 0;
	document.getElementById(prefix+"roof").value = 1;
	document.getElementById(prefix+"draw_order").value = 1;
	
	document.getElementById(prefix+"u").value = "";
	document.getElementById(prefix+"u_id").selectedIndex = <?php echo $wall_u_id;?>;
	zone_adiafani_u();
	document.getElementById(prefix+"ap").value = <?php echo $wall_a;?>;
	document.getElementById(prefix+"ek").value = <?php echo $wall_e;?>;
	
	document.getElementById(prefix+"z1").value = "";
	document.getElementById(prefix+"z2").value = "";
	
	document.getElementById(prefix+"per").value = <?php echo $wall_per;?>;
	zone_adiafani_per();
	
	//Υποστυλώματα
	document.getElementById(prefix+"yp_u").value = "";
	document.getElementById(prefix+"yp_u_id").selectedIndex = <?php echo $yp_u_id;?>;
	zone_adiafani_yp_u();
	var yp_counter = document.getElementById(prefix+"yp_counter").value;
	for(var i=2;i<=yp_counter;i++){
		rem_yp(i);
	}
	document.getElementById(prefix+"yp_1").value = <?php echo $yp_l;?>;
	document.getElementById(prefix+"yp_ar_1").value = "";
	yp=1;
	document.getElementById(prefix+"yp_counter").value = 1;
	
	//Δοκοί
	document.getElementById(prefix+"dok_u").value = "";
	document.getElementById(prefix+"dok_u_id").selectedIndex = <?php echo $dok_u_id;?>;
	zone_adiafani_dok_u();
	var dok_counter = document.getElementById(prefix+"dok_counter").value;
	for(var i=2;i<=dok_counter;i++){
		rem_dok(i);
	}
	document.getElementById(prefix+"dok_1").value = <?php echo $dok_h;?>;
	document.getElementById(prefix+"dok_top_1").value = "";
	dok=1;
	document.getElementById(prefix+"dok_counter").value = 1;
	
	//Συρόμενα
	document.getElementById(prefix+"syr_u").value = "";
	document.getElementById(prefix+"syr_u_id").selectedIndex = <?php echo $syr_u_id;?>;
	zone_adiafani_syr_u();
	var syr_counter = document.getElementById(prefix+"syr_counter").value;
	for(var i=2;i<=syr_counter;i++){
		rem_syr(i);
	}
	document.getElementById(prefix+"syr_w_1").value = <?php echo $syr_l;?>;
	document.getElementById(prefix+"syr_h_1").value = <?php echo $syr_h;?>;
	document.getElementById(prefix+"syr_p_1").value = "";
	document.getElementById(prefix+"syr_ar_1").value = "";
	syr=1;
	document.getElementById(prefix+"syr_counter").value = 1;
	
	
	document.getElementById(prefix+"f_type").selectedIndex = 2;
	
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
	zone_adiafani_changef();
	
	document.getElementById(prefix+"psi_dap_type").value = 7;//ΕΔ
	zone_adiafani_psi_type(1,1);//ΕΔ-1
	document.getElementById(prefix+"psi_or_type").value = 7;//ΕΔ
	zone_adiafani_psi_type(2, 1);//ΕΔ-1
	document.getElementById(prefix+"psi_yp_type").value =2;//ΣΣ
	zone_adiafani_psi_type(3, 1);//ΣΣ-1
	document.getElementById(prefix+"psi_dok_type").value = 2;//ΣΣ
	zone_adiafani_psi_type(4, 1);//ΣΣ-1
	document.getElementById(prefix+"psi_syr_type").value = 2;//ΣΣ
	zone_adiafani_psi_type(5, 1);//ΣΣ-1
	
	$('.tabs-left a[href="#tab_modal_1"]').tab('show');
	
	//document.getElementById(prefix+"psi").selectedIndex = 0;
	}
	if(id!=0){
		var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_zone_adiafani&id="+id;
	
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var arr = JSON.parse(xmlhttp.responseText);	
				
				zone_adiafani_getzones(0,arr["zone_id"]);
				document.getElementById(prefix+"name").value = arr["name"];
				
				document.getElementById(prefix+"g").value = arr["g"];
				document.getElementById(prefix+"g_type").selectedIndex = arr["g_type"];
				zone_adiafani_gtype();
				document.getElementById(prefix+"b").value = arr["b"];
				document.getElementById(prefix+"type").selectedIndex = arr["type"];
				zone_adiafani_changetype();
				zone_adiafani_getzones(1,arr["mthx_id"]);
				
				document.getElementById(prefix+"l").value = arr["l"];
				document.getElementById(prefix+"h").value = arr["h"];
				document.getElementById(prefix+"d").value = arr["d"];
				document.getElementById(prefix+"dy").value = arr["dy"];
				document.getElementById(prefix+"dx").value = arr["dx"];
				document.getElementById(prefix+"roof").value = arr["roof"];
				document.getElementById(prefix+"draw_order").value = arr["draw_order"];
				
				document.getElementById(prefix+"u").value = arr["u"];
				document.getElementById(prefix+"u_id").value = arr["u_id"];
				if(arr["u_id"]!=0){
					zone_adiafani_u();
				}
				document.getElementById(prefix+"ap").value = arr["ap"];
				document.getElementById(prefix+"ek").value = arr["ek"];
				
				document.getElementById(prefix+"z1").value = arr["z1"];
				document.getElementById(prefix+"z2").value = arr["z2"];
				
				document.getElementById(prefix+"per").value = arr["per"];
				zone_adiafani_per();
				
				//Υποστυλώματα
				document.getElementById(prefix+"yp_u").value = arr["yp_u"];
				document.getElementById(prefix+"yp_u_id").value = arr["yp_u_id"];
				if(arr["yp_u_id"]!=0){
					zone_adiafani_yp_u();
				}
	
				yp=1;
				var yp_counter = document.getElementById(prefix+"yp_counter").value;
					for(var i=2;i<=yp_counter;i++){
						rem_yp(i);
					}
				document.getElementById(prefix+"yp_counter").value=1;
				var yp_arr = arr["yp"].split("^");
				var yp_values;
					for(var i=1;i<=yp_arr.length-1;i++){
						if(i>1){
							if(document.getElementById(prefix+"yp_"+i) == undefined){
							add_yp();
							}
						}
						yp_values = yp_arr[i-1].split("|");
						document.getElementById(prefix+"yp_"+i).value = yp_values[0];
						document.getElementById(prefix+"yp_ar_"+i).value = yp_values[1];
					}
					
				//Δοκοί
				document.getElementById(prefix+"dok_u").value = arr["dok_u"];
				document.getElementById(prefix+"dok_u_id").value = arr["dok_u_id"];
				if(arr["dok_u_id"]!=0){
					zone_adiafani_dok_u();
				}
				
				dok=1;
				var dok_counter = document.getElementById(prefix+"dok_counter").value;
					for(var i=2;i<=dok_counter;i++){
						rem_dok(i);
					}
				document.getElementById(prefix+"dok_counter").value=1;
				var dok_arr = arr["dok"].split("^");
				var dok_values;
					for(i=1;i<=dok_arr.length-1;i++){
						if(i>1){
							if(document.getElementById(prefix+"dok_"+i) == undefined){
							add_dok();
							}
						}
						dok_values = dok_arr[i-1].split("|");
						document.getElementById(prefix+"dok_"+i).value = dok_values[0];
						document.getElementById(prefix+"dok_top_"+i).value = dok_values[1];
					}
					
				//Συρόμενα
				document.getElementById(prefix+"syr_u").value = arr["syr_u"];
				document.getElementById(prefix+"syr_u_id").value = arr["syr_u_id"];
				if(arr["syr_u_id"]!=0){
					zone_adiafani_syr_u();
				}
				
				syr=1;
				var syr_counter = document.getElementById(prefix+"syr_counter").value;
					for(var i=2;i<=syr_counter;i++){
						rem_syr(i);
					}
				document.getElementById(prefix+"syr_counter").value=1;
				var syr_arr = arr["syr"].split("^");
				var syr_values;
					for(i=1;i<=syr_arr.length-1;i++){
						if(i>1){
							if(document.getElementById(prefix+"syr_w_"+i) == undefined){
							add_syr();
							}
						}
						syr_values = syr_arr[i-1].split("|");
						document.getElementById(prefix+"syr_w_"+i).value = syr_values[0];
						document.getElementById(prefix+"syr_h_"+i).value = syr_values[1];
						document.getElementById(prefix+"syr_p_"+i).value = syr_values[2];
						document.getElementById(prefix+"syr_ar_"+i).value = syr_values[3];
					}
				
				
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
				
				zone_adiafani_showf();
				
				document.getElementById(prefix+"f_type").selectedIndex = arr["f_type"];
				zone_adiafani_changef();
				
				var psi = arr["psi"].split("^");
				
				var psi_dap = psi[0].split("|");
				document.getElementById(prefix+"psi_dap_type").value = psi_dap[0];
				zone_adiafani_psi_type(1, psi_dap[1]);
				
				var psi_or = psi[1].split("|");
				document.getElementById(prefix+"psi_or_type").value = psi_or[0];
				zone_adiafani_psi_type(2, psi_or[1]);
				
				var psi_yp = psi[2].split("|");
				document.getElementById(prefix+"psi_yp_type").value = psi_yp[0];
				zone_adiafani_psi_type(3, psi_yp[1]);
				
				var psi_dok = psi[3].split("|");
				document.getElementById(prefix+"psi_dok_type").value = psi_dok[0];
				zone_adiafani_psi_type(4, psi_dok[1]);
				
				var psi_syr = psi[4].split("|");
				document.getElementById(prefix+"psi_syr_type").value = psi_syr[0];
				zone_adiafani_psi_type(5, psi_syr[1]);
				
				zone_adiafani_draw(id);
			document.getElementById('wait').style.display="none";
		}}
	$('.tabs-left a[href="#tab_modal_1"]').tab('show');	
	}
	
	var button,edit_header;
	if(id!=0){
		button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_zone_adiafani('+id+','+page+');">Επεξεργασία</button>';
		edit_header = 'Επεξεργασία τοίχου';
	}else{
		button = '<button class="btn btn-solar" data-dismiss="modal" aria-hidden="true" onclick="submit_zone_adiafani('+id+','+page+');">Προσθήκη</button>';
		edit_header = 'Προσθήκη τοίχου';
	}
	document.getElementById("edit_button_zone_adiafani").innerHTML = button;
	document.getElementById("edit_header_zone_adiafani").innerHTML = edit_header;
	$("#modal_form_zone_adiafani").modal("show");
	modal_height();
}

//Εμφάνιση του modal διαγραφής
function formdel_zone_adiafani(id,page){
	var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_zone_adiafani('+id+','+page+');">Διαγραφή</button>';
	document.getElementById("del_button_zone_adiafani").innerHTML = button;
	$("#modal_del_zone_adiafani").modal("show");
}

//Υποβολή της φόρμας
//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
function submit_zone_adiafani(id,page){
var prefix = "editzone_adiafani_";
	var zone_id = document.getElementById(prefix+"zone_id").value;
	var name = document.getElementById(prefix+"name").value;
				
	var g = document.getElementById(prefix+"g").value;
	var g_type = document.getElementById(prefix+"g_type").selectedIndex;
	var b = document.getElementById(prefix+"b").value;
	
	var type = document.getElementById(prefix+"type").value;
	var mthx_id = document.getElementById(prefix+"mthx_id").value;
	
	var l = document.getElementById(prefix+"l").value;
	var h = document.getElementById(prefix+"h").value;
	var d = document.getElementById(prefix+"d").value;
	var dy = document.getElementById(prefix+"dy").value;
	var dx = document.getElementById(prefix+"dx").value;
	var roof = document.getElementById(prefix+"roof").value;
	var draw_order = document.getElementById(prefix+"draw_order").value;
	
	var u = document.getElementById(prefix+"u").value;
	var u_id = document.getElementById(prefix+"u_id").value;
	
	var ap = document.getElementById(prefix+"ap").value;
	var ek = document.getElementById(prefix+"ek").value;
	
	var z1 = document.getElementById(prefix+"z1").value;
	var z2 = document.getElementById(prefix+"z2").value;
	
	var per = document.getElementById(prefix+"per").value;
	
	//Υποστυλώματα
	var yp_u = document.getElementById(prefix+"yp_u").value;
	var yp_u_id = document.getElementById(prefix+"yp_u_id").value;
	
	var yp_counter = document.getElementById(prefix+"yp_counter").value;
	var yp_txt = "";
	var yp_l,yp_ar;
		for(var i=1;i<=yp_counter;i++){
			if (document.getElementById(prefix+"yp_"+i) != undefined){
				yp_l = document.getElementById(prefix+"yp_"+i).value;
				yp_ar = document.getElementById(prefix+"yp_ar_"+i).value;
				yp_txt += yp_l+"|"+yp_ar+"^";
			}
		}
		
	//Δοκοί
	var dok_u = document.getElementById(prefix+"dok_u").value;
	var dok_u_id = document.getElementById(prefix+"dok_u_id").value;
	
	var dok_counter = document.getElementById(prefix+"dok_counter").value;
	var dok_txt = "";
	var dok_l,dok_top;
		for(var i=1;i<=dok_counter;i++){
			if (document.getElementById(prefix+"dok_"+i) != undefined){
				dok_l = document.getElementById(prefix+"dok_"+i).value;
				dok_top = document.getElementById(prefix+"dok_top_"+i).value;
				dok_txt += dok_l+"|"+dok_top+"^";
			}
		}
		
	//Συρόμενα
	var syr_u = document.getElementById(prefix+"syr_u").value;
	var syr_u_id = document.getElementById(prefix+"syr_u_id").value;
	
	var syr_counter = document.getElementById(prefix+"syr_counter").value;
	var syr_txt = "";
	var syr_w,syr_h,syr_p,syr_ar;
		for(var i=1;i<=syr_counter;i++){
			if (document.getElementById(prefix+"syr_w_"+i) != undefined){
				syr_w = document.getElementById(prefix+"syr_w_"+i).value;
				syr_h = document.getElementById(prefix+"syr_h_"+i).value;
				syr_p = document.getElementById(prefix+"syr_p_"+i).value;
				syr_ar = document.getElementById(prefix+"syr_ar_"+i).value;
				syr_txt += syr_w+"|"+syr_h+"|"+syr_p+"|"+syr_ar+"^";
			}
		}
	
	
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
		
	var psi_dap_type = document.getElementById(prefix+"psi_dap_type").value;
	var psi_dap_u = document.getElementById(prefix+"psi_dap_u").value;
	
	var psi_or_type = document.getElementById(prefix+"psi_or_type").value;
	var psi_or_u = document.getElementById(prefix+"psi_or_u").value;
	
	var psi_yp_type = document.getElementById(prefix+"psi_yp_type").value;
	var psi_yp_u = document.getElementById(prefix+"psi_yp_u").value;
	
	var psi_dok_type = document.getElementById(prefix+"psi_dok_type").value;
	var psi_dok_u = document.getElementById(prefix+"psi_dok_u").value;
	
	var psi_syr_type = document.getElementById(prefix+"psi_syr_type").value;
	var psi_syr_u = document.getElementById(prefix+"psi_syr_u").value;
	
	if(type!=1){mthx_id=0;}
	if(u_id!=0){u=0;}
	if(yp_u_id!=0){yp_u=0;}
	if(dok_u_id!=0){dok_u=0;}
	if(syr_u_id!=0){syr_u=0;}
	
		if(id==0){
		var action="create";
		}else{
		action="update";
		}
	var link = "includes/functions_meleti_general.php?insert_iddata=1";
	link += "&table=meletes_zone_adiafani";
	link += "&action="+action;
	link += "&id="+id;
	link += "&values="+zone_id+","+name+","+g+","+g_type+","+b+","+type+","+mthx_id+","+l+","+h+","+d+","+dy+","+dx;
	link += ","+u+","+u_id+","+ap+","+ek+","+z1+","+z2+","+per;
	link += ","+yp_txt+","+yp_u+","+yp_u_id;
	link += ","+dok_txt+","+dok_u+","+dok_u_id;
	link += ","+syr_txt+","+syr_u+","+syr_u_id;
	link += ","+f_type+","+fhor_e+"|"+fhor_h;
	link += ","+fov_l;
	link += ","+fovt_l+"|"+fovt_h;
	link += ","+ffin_l_dx+"|"+ffin_l_w;
	link += ","+ffin_r_dx+"|"+ffin_r_w;
	link += ","+fsh_type+"|"+fsh_l+"|"+fsh_h;
	link += ","+psi_dap_type+"|"+psi_dap_u+"^"+psi_or_type+"|"+psi_or_u+"^"+psi_yp_type+"|"+psi_yp_u+"^"+psi_dok_type+"|"+psi_dok_u+"^"+psi_syr_type+"|"+psi_syr_u;
	link += ","+roof+","+draw_order;
	
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("zone_adiafani_info").innerHTML=xmlhttp.responseText;
		document.getElementById('wait').style.display="none";
		get_zone_adiafani(page);
		get_meleti_n();
	}}
}

//Διαγραφή
function del_zone_adiafani(id,page){
	var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_zone_adiafani&id="+id;
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("zone_adiafani_info").innerHTML=xmlhttp.responseText;
		document.getElementById('wait').style.display="none";
		get_zone_adiafani(page);
		get_meleti_n();
	}}
}


function zone_adiafani_changetype(){
var prefix = "editzone_adiafani_";
var type = document.getElementById(prefix+"type").value;
	
	if(type==1){
	//επιλογή επαφής με ΜΘΧ
	document.getElementById(prefix+"mthx_id").disabled = false;
	}else{
	document.getElementById(prefix+"mthx_id").disabled = true;
	}
	
	document.getElementById(prefix+"div_edafos").style.display="none";
	if(type==2){
	document.getElementById(prefix+"div_edafos").style.display="inline";
	}

}

function zone_adiafani_gtype(){
	var prefix = "editzone_adiafani_";
	var g_type = document.getElementById(prefix+"g_type").value;
	if(g_type==0){
		document.getElementById(prefix+"g").disabled = false;
	}else{
		document.getElementById(prefix+"g").disabled = true;
		var pros, g;
		var link = "includes/functions_meleti_general.php?findg_adiafani=1";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			
			pros=parseInt(xmlhttp.responseText);
			if(g_type==1){g=pros;}
			if(g_type==2){g=pros+90;}
			if(g_type==3){g=pros+180;}
			if(g_type==4){g=pros+270;}
			if(g>=360){g=g-360;}
			document.getElementById(prefix+"g").value = g;
		}}
	}
}

function zone_adiafani_btype(){
	var prefix = "editzone_adiafani_";
	var b_type = document.getElementById(prefix+"b_type").value;
	if(b_type==0){
		document.getElementById(prefix+"b").disabled = false;
	}else{
		document.getElementById(prefix+"b").disabled = true;
		document.getElementById(prefix+"b").value = 90;
	}
}
 
 
function zone_adiafani_u(){
var prefix = "editzone_adiafani_";
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
function zone_adiafani_yp_u(){
var prefix = "editzone_adiafani_";
var u = document.getElementById(prefix+"yp_u_id").value;
	
	if(u!=0){
		var link = "includes/functions_meleti_general.php?findu_adiafani=1&id="+u;
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById(prefix+"yp_u").value=xmlhttp.responseText;
		}}
	
		document.getElementById(prefix+"yp_u").disabled = true;
	}else{
		document.getElementById(prefix+"yp_u").value="";
		document.getElementById(prefix+"yp_u").disabled = false;
	}
	
}
function zone_adiafani_dok_u(){
var prefix = "editzone_adiafani_";
var u = document.getElementById(prefix+"dok_u_id").value;
	
	if(u!=0){
		var link = "includes/functions_meleti_general.php?findu_adiafani=1&id="+u;
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById(prefix+"dok_u").value=xmlhttp.responseText;
		}}
	
		document.getElementById(prefix+"dok_u").disabled = true;
	}else{
		document.getElementById(prefix+"dok_u").value="";
		document.getElementById(prefix+"dok_u").disabled = false;
	}
	
}
function zone_adiafani_syr_u(){
var prefix = "editzone_adiafani_";
var u = document.getElementById(prefix+"syr_u_id").value;
	
	if(u!=0){
		var link = "includes/functions_meleti_general.php?findu_adiafani=1&id="+u;
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById(prefix+"syr_u").value=xmlhttp.responseText;
		}}
	
		document.getElementById(prefix+"syr_u").disabled = true;
	}else{
		document.getElementById(prefix+"syr_u").value="";
		document.getElementById(prefix+"syr_u").disabled = false;
	}
	
}

function zone_adiafani_showf(){
var prefix = "editzone_adiafani_";

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

function zone_adiafani_changef(){
var prefix = "editzone_adiafani_";
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
	zone_adiafani_showf();
}

//Αλλαγή εικόνας θερμογεφυρών ανάλογα με την θερμογέφυρα
function zone_adiafani_psi_img(typos){
	var prefix;
	if(typos==1){
	prefix = "editzone_adiafani_psi_dap_";
	}
	if(typos==2){
	prefix = "editzone_adiafani_psi_or_";
	}
	if(typos==3){
	prefix = "editzone_adiafani_psi_yp_";
	}
	if(typos==4){
	prefix = "editzone_adiafani_psi_dok_";
	}
	if(typos==5){
	prefix = "editzone_adiafani_psi_syr_";
	}
	var type_array=["ksg","sg","ss","ds","dp","oe","dy","ed","df","pr","lp","yp"];
	
	var type = document.getElementById(prefix+"type").value;
	var u = document.getElementById(prefix+"u").value;
	var img = "<img src=\"images/thermo/"+type_array[type]+"/"+type_array[type]+u+".jpg\">";
	document.getElementById("editzone_adiafani_psi_img").innerHTML = img;	
}

//Αλλαγή διαθέσιμων θερμογεφυρών ανάλογα με τον τύπο
function zone_adiafani_psi_type(typos, u){
	var prefix;
	if(typos==1){
	prefix = "editzone_adiafani_psi_dap_";
	}
	if(typos==2){
	prefix = "editzone_adiafani_psi_or_";
	}
	if(typos==3){
	prefix = "editzone_adiafani_psi_yp_";
	}
	if(typos==4){
	prefix = "editzone_adiafani_psi_dok_";
	}
	if(typos==5){
	prefix = "editzone_adiafani_psi_syr_";
	}
	var type = document.getElementById(prefix+"type").selectedIndex;
	var link1 = "includes/functions_meleti_general.php?getthermoselect=1&type="+type;
	var xmlhttp1=new XMLHttpRequest();
	xmlhttp1.open("GET",link1 ,true);
	xmlhttp1.send();
	xmlhttp1.onreadystatechange=function()  {
	if (xmlhttp1.readyState==4 && xmlhttp1.status==200) {
		document.getElementById(prefix+"u").innerHTML = xmlhttp1.responseText;
		
		if(u!=0){
			document.getElementById(prefix+"u").value = u;
			zone_adiafani_psi_img(typos);
		}
	}}	
}


function zone_adiafani_draw(id){
	var prefix = "editzone_adiafani_";
	var x1="includes/draw_wall.php?draw=3&zone=0&wall_id="+id;
	document.getElementById(prefix+"preview3").innerHTML = "<img height=300px src=\""+x1+"\" ></img>";
	
	var x2="includes/draw_wall.php?draw=1&zone=0&wall_id="+id;
	document.getElementById(prefix+"preview1").innerHTML = "<img width=300px src=\""+x2+"\" ></img>";
}

function zone_adiafani_showimg(id){
	var x1="includes/draw_wall.php?draw=3&zone=0&wall_id="+id;
	document.getElementById("kelyfosimg").innerHTML = "<img height=300px src=\""+x1+"\" ></img>";
	$("#help_kelyfosimg").modal("show");
}

function zone_adiafani_per(){
var prefix = "editzone_adiafani_";
var per =  document.getElementById(prefix+"per").value;
	if(per==0){
		document.getElementById(prefix+"ypostylwmata").style.display="block";
		document.getElementById(prefix+"dokoi").style.display="block";
		document.getElementById(prefix+"dok_u").disabled=false;
		document.getElementById(prefix+"dok_u_id").disabled=false;
	}else{
		document.getElementById(prefix+"ypostylwmata").style.display="none";
		document.getElementById(prefix+"dokoi").style.display="none";
		document.getElementById(prefix+"dok_u").disabled=true;
		document.getElementById(prefix+"dok_u_id").disabled=true;
	}
}

function zone_adiafani_help_per() {
var prefix = "editzone_adiafani_";
var per1 =  document.getElementById(prefix+"per1").value;
var per2 =  document.getElementById(prefix+"per2").value;
var per4;
	if(per1==1){
		if(per2==1){
			per4=15;
		}
		if(per2==2){
			per4=20;
		}
		if(per2==3){
			per4=23;
		}
	}
	if(per1==2){
		if(per2==1){
			per4=18;
		}
		if(per2==2){
			per4=23;
		}
		if(per2==3){
			per4=28;
		}
	}
	document.getElementById(prefix+"per4").value = per4;
}

function zone_adiafani_use_per4() {
var prefix = "editzone_adiafani_";
var per4=document.getElementById(prefix+"per4").value;
document.getElementById(prefix+"per").value = per4;
}
</script>

<!-- ###################### Κρυφό modal_form_zone_adiafani για εμφάνιση ###################### -->
<div id="modal_form_zone_adiafani" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_zone_adiafani"></span></h6>
	</div>

	<div class="modal-body">
<div class="tabbable tabs-left">
		<ul class="nav nav-zone">
		<li class="active"><a href="#tab_modal_1" data-toggle="tab">Τοίχος</a></li>
		<li><a href="#tab_modal_2" data-toggle="tab">Φέρων</a></li>
		<li><a href="#tab_modal_3" data-toggle="tab">Συρόμενα</a></li>
		<li><a href="#tab_modal_4" data-toggle="tab">Σκιάσεις</a></li>
		<li><a href="#tab_modal_5" data-toggle="tab">Ψ</a></li>
		<li><a href="#tab_modal_6" data-toggle="tab">Προεπισκόπηση</a></li>
		</ul>
		
		<div class="tab-content">
			
			<div class="tab-pane active" id="tab_modal_1">
				<table class="table table-bordered table-condensed">
					<tr class="info">
						<td>Στοιχεία θέσης / Uπλήρωσης</td>
						<td>Διαστάσεις / Υφή</td>
					</tr>
					<tr>
						<td>
							<table class="table table-bordered table-condensed">
								<tr class="warning">
									<td>
										Θέση τοίχου 
										<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#help_epilogi_zone"><i class="fa fa-cubes"></i></button> 
										<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#help_gb"><i class="fa fa-compass"></i></button> 
									</td>
								</tr>
								<tr>
									<td>
										<div class="input-group">
										<span class="input-group-addon">
											<span class="tip-top" href="#" title="Θερμική ζώνη που ανήκει ο τοίχος"><i class="fa fa-cubes"></i> Ζώνη</span>
										</span>
										<select class="form-control input-sm" id="editzone_adiafani_zone_id">
											<option value=0></option>
										</select>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="input-group">
										<span class="input-group-addon">
											<span class="tip-top" href="#" title="Ένα χαρακτηριστικό όνομα για τον τοίχο"><i class="fa fa-keyboard-o"></i> Όνομα</span>
										</span>
										<input type="text" id="editzone_adiafani_name" class="form-control input-sm" />
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="input-group">
										<span class="input-group-addon">
											<span class="tip-top" href="#" title="Τύπος επαφής τοιχοποιίας<br/>Σε τμήμα κτιρίου επιλέγεται: σε αέρα και U=U/2"><i class="fa fa-braille"></i> Τύπος</span>
										</span>
										<select class="form-control input-sm" id="editzone_adiafani_type" onchange="zone_adiafani_changetype();">
											<option value=0>Σε αέρα</option>
											<option value=1>Σε ΜΘΧ/Ηλιακό χώρο (διαχ. επιφάνεια)</option>
											<option value=2>Σε έδαφος</option>
											<option value=3>Μεσοτοιχία</option>
										</select>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="input-group">
										<span class="input-group-addon">
											<span class="tip-top" href="#" title="Ο ΜΘΧ/Ηλιακός χώρος που έρχεται σε επαφή η τοιχοποιία εάν έχει δηλωθεί Σε ΜΘΧ/Ηλιακό χώρο ο τύπος">
											<i class="fa fa-cube"></i> ΜΘΧ</span>
										</span>
										<select class="form-control input-sm" id="editzone_adiafani_mthx_id">
											<option value=0></option>
										</select>
										</div>
									</td>
								</tr>
								<tr>
									<td>
									<div class="row">
										<div class="col-md-6">
											<div class="input-group">
											<span class="input-group-addon">
												<span class="tip-top" href="#" title="Προσανατολισμός τοιχοποιίας (αζιμούθιο)"><i class="fa fa-compass"></i> Προσ. (γ)</span>
											</span>
												<input type="text" id="editzone_adiafani_g" class="form-control input-sm" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-group">
											<span class="input-group-addon">
												<span class="tip-top" href="#" title="Επιλογή ανάλογα με τον προσανατολισμό του κτιρίου που δηλώθηκε στην καρτέλα γενικά.">
												<i class="fa fa-calculator"></i> Κτίριο (γ)</span>
											</span>
											<select class="form-control input-sm" id="editzone_adiafani_g_type" onchange="zone_adiafani_gtype();">
												<option value=0>Χειροκίνητα</option>
												<option value=1>B</option>
												<option value=2>A</option>
												<option value=3>N</option>
												<option value=4>Δ</option>
											</select>
											</div>
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
												<span class="tip-top" href="#" title="Κλίση τοιχοποιίας (β) ως προς την κατακόρυφο.">
												<i class="fa fa-eraser"></i> Κλίση (β)</span>
											</span>
												<input type="text" id="editzone_adiafani_b" class="form-control input-sm" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-group">
											<span class="input-group-addon">
												<span class="tip-top" href="#" title="Βοηθητική επιλογή για κατακόρυφο στοιχείο ή χειροκίνητη επιλογή.">
												<i class="fa fa-calculator"></i> Τύπος (β)</span>
											</span>
											<select class="form-control input-sm" id="editzone_adiafani_b_type" onchange="zone_adiafani_btype();">
												<option value=0>Χειροκίνητα</option>
												<option value=1>Κατακόρυφο</option>
											</select>
										</div>
									</div>	
									</td>
							</tr>
							</table>
							
							<table class="table table-bordered table-condensed">
								<tr class="warning">
									<td>U πλήρωσης</td>
								</tr>
								<tr>
									<td>
									<div class="row">
										<div class="col-md-5">
											<div class="input-group">
												<span class="input-group-addon">
													<span class="tip-top" href="#" title="Συντελεστής θερμοπερατότητας"><i class="fa fa-thermometer-half"></i> U</span>
												</span>
												<input type="text" id="editzone_adiafani_u" class="form-control input-sm" />
												<span class="input-group-addon"> W/m<sup>2</sup>.K</span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="input-group">
												<span class="input-group-addon">
													<span class="tip-top" href="#" title="Αποθηκευμένος υπολογισμός αδιαφανών"><i class="fa fa-calculator"></i> Υπολογισμός</span>
												</span>
												<select class="form-control input-sm" id="editzone_adiafani_u_id" onchange="zone_adiafani_u();">
													<option value=0>Χωρίς υπολογισμό</option>
													<?php
													echo create_select_optionsid("user_adiafani","name",array("user_id"=>$_SESSION["user_id"]) );
													?>
												</select>
											</div>
										</div>
										<div class="col-md-1">
											<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#help_u_katakoryfa"><i class="fa fa-exchange text-danger"></i></button>
										</div>
									</div>	
									</td>
								</tr>
							</table>
							
							<div id="editzone_adiafani_div_edafos" style="display:inline;">
							<table class="table table-bordered table-condensed">
								<tr class="info">
									<td colspan="3">
										Έδαφος 
										<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#help_edafos">
										<i class="fa fa-arrows-v"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>
										<div class="input-group">
										<span class="input-group-addon">
											<span class="tip-top" href="#" title="Κατώτερο βάθος έδρασης (m)<br/><img src='images/word-images/utbz1z2.png' width='180px'/>"><i class="fa fa-arrow-circle-down"></i> z1</span>
										</span>
										<input type="text" id="editzone_adiafani_z1" class="form-control input-sm" />
										</div>
									</td>
									<td style="vertical-align:middle;text-align:center;">
										<b>></b>
									</td>
									<td>
										<div class="input-group">
										<span class="input-group-addon">
											<span class="tip-top" href="#" title="Ανώτερο βάθος έδρασης (m)<br/><img src='images/word-images/utbz1z2.png' width='180px'/>"><i class="fa fa-arrow-down"></i> z2</span>
										</span>
											<input type="text" id="editzone_adiafani_z2" class="form-control input-sm" />
										</div>
									</td>
								</tr>
							</table>
						</div>
						</td>
						
						
						<td>
						
							<table class="table table-bordered table-condensed">
								<tr class="info">
									<td>
										Διαστάσεις 
										<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#help_dimensions">
											<i class="fa fa-arrows-h"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>
										<div class="input-group">
											<span class="input-group-addon">
												<span class="tip-top" href="#" title="Μήκος τοίχου σε μέτρα"><i class="fa fa-arrows-h"></i> Μήκος</span>
											</span>
												<input type="text" id="editzone_adiafani_l" class="form-control input-sm" />
											<span class="input-group-addon">m</span>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="input-group">
											<span class="input-group-addon">
												<span class="tip-top" href="#" title="Ύψος τοίχου σε μέτρα"><i class="fa fa-arrows-v"></i> Ύψος</span>
											</span>
												<input type="text" id="editzone_adiafani_h" class="form-control input-sm" />
											<span class="input-group-addon">m</span>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="input-group">
											<span class="input-group-addon">
												<span class="tip-top" href="#" title="Πάχος τοίχου σε μέτρα. Δεν λαμβάνεται υπόψη σε κανένα υπολογισμό. ">
												<i class="fa fa-pause"></i> Πάχος</span>
											</span>
												<input type="text" id="editzone_adiafani_d" class="form-control input-sm" />
											<span class="input-group-addon">m</span>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="input-group">
											<span class="input-group-addon">
												<span class="tip-top" href="#" title="Εάν υπάρχει επιπλέον τρίγωνο πάνω από τον τοίχο δηλώνεται εδώ το ύψος του">
												<i class="fa fa-arrow-up"></i> Ύψος τριγώνου</span>
											</span>
												<input type="text" id="editzone_adiafani_dy" class="form-control input-sm" />
											<span class="input-group-addon">m</span>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="input-group">
											<span class="input-group-addon">
												<span class="tip-top" href="#" title="Απόσταση κορυφής τριγώνου από αριστερό άκρο">
												<i class="fa fa-arrow-left"></i> Απ. τριγώνου από αρ.</span>
											</span>
												<input type="text" id="editzone_adiafani_dx" class="form-control input-sm" />
											<span class="input-group-addon">m</span>
										</div>
									</td>
								</tr>
								<tr class="info">
									<td>
										<div class="input-group">
											<span class="input-group-addon">
												<span class="tip-top" href="#" title="Δηλώστε τον όροφο (πχ 0 για υπόγειο, 1 για ισόγειο, κ.λπ.)<br/><img src='images/style/building/floor.png' width='180px'/>">
												<i class="fa fa-server"></i> Όροφος</span>
											</span>
												<input type="text" id="editzone_adiafani_roof" class="form-control input-sm" />
										</div>
									</td>
								</tr>
								<tr class="info">
									<td>
										<div class="input-group">
											<span class="input-group-addon">
												<span class="tip-top" href="#" title="Δηλώστε τη σειρά εμφάνισης των δομικών στοιχείων.πχ 1, 2, 3, κ.λπ.">
												<i class="fa fa-sort-numeric-asc"></i> Σειρά</span>
											</span>
												<input type="text" id="editzone_adiafani_draw_order" class="form-control input-sm" />
										</div>
									</td>
								</tr>
							</table>
							
						<div id="editzone_adiafani_div_ae">
							<table class="table table-bordered table-condensed">
								<tr class="info">
									<td>
										Ακτινοβολία 
										<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#help_ae">
										<i class="fa fa-sun-o"></i></button>
									</td>
								</tr>
								<tr>
									<td>
										<div class="input-group">
											<span class="input-group-addon">
												<span class="tip-top" href="#" title="Απορροφητικότητα"><i class="fa fa-certificate"></i> α</span>
											</span>
											<select class="form-control input-sm" id="editzone_adiafani_ap">
												<?php
												echo create_select_optionsid("vivliothiki_adiafani_a","name",array("type"=>1) );
												?>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="input-group">
											<span class="input-group-addon">
												<span class="tip-top" href="#" title="Συντελεστής εκπομπής"><i class="fa fa-sun-o"></i> ε</span>
											</span>
											<select class="form-control input-sm" id="editzone_adiafani_ek">
												<?php
												echo create_select_optionsid("vivliothiki_adiafani_e","name");
												?>
											</select>
										</div>
									</td>
								</tr>
							</table>
						</div>
						
						<script>
						$('#editzone_adiafani_div_edafos a').popover({ html:true, trigger:'click' });
						</script>
						</td>
					</tr>
				</table>
			</div>
			
			<div class="tab-pane" id="tab_modal_2">
				<table class="table table-bordered table-condensed">
					
					<tr class="info">
						<td colspan="2" width=55%>
							<i class="fa fa-building"></i> Διαστάσεις
						</td>
						<td width=45%>
							<i class="fa fa-building"></i> U
						</td>
					</tr>
					<tr>
						<td>
							% της όψης
						</td>
						<td>
							<div class="row">
								<div class="col-md-8">
									<div class="input-group">
									<span class="input-group-addon">
										<span class="tip-top" href="#" title="Ποσοστό % της όψης του τοίχου που καταλαμβάνει ο φέρων οργανισμός"><i class="fa fa-arrows-v"></i> Ποσοστό</span>
									</span>
									<input type="text" id="editzone_adiafani_per" class="form-control input-sm" onchange="zone_adiafani_per()"/>
									<span class="input-group-addon">%</span>
									</div>
								</div>
								<div class="col-md-4">
									<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#help_per">
										<i class="fa fa-percent"></i>
									</button>
								</div>
							</div>
						</td>
						<td>
							U φέρων 
							<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#help_u_katakoryfa">
								<i class="fa fa-exchange text-danger"></i>
							</button>
						</td>
					</tr>
					
					<tr>
					<td>Αναλυτικά Υποστυλώματα</td>
					<td>
						<input type="hidden" id="editzone_adiafani_yp_counter">
						<div id="editzone_adiafani_ypostylwmata">
							<div id="row_yp_1">
							<div class="row">
								<div class="col-md-5">
									<div class="input-group">
										<span class="input-group-addon">
											<span class="tip-top" href="#" title="Μήκος υποστυλώματος σε m"><i class="fa fa-arrows-h"></i> Μήκος</span>
										</span>
									<input type="text" id="editzone_adiafani_yp_1" class="form-control input-sm" value="" />
									<span class="input-group-addon">m</span>
									</div>
								</div>
								<div class="col-md-5">
									<div class="input-group">
										<span class="input-group-addon">
											<span class="tip-top" href="#" title="Απόσταση από αριστερό άκρο του τοίχου σε m"><i class="fa fa-arrow-left"></i> Απ. αριστερά</span>
										</span>
										<input type="text" id="editzone_adiafani_yp_ar_1" class="form-control input-sm" value="" />
										<span class="input-group-addon">m</span>
									</div>
								</div>
								<div class="col-md-2">
									<button class="btn btn-success btn-sm" type="button" onclick="add_yp()"><i class="fa fa-plus"></i></button>
								</div>	
							</div>
							</div>
						</div>
					</td>
					<td>
						<div class="row">
							<div class="col-md-6">
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Συντελεστής θερμοπερατότητας"><i class="fa fa-thermometer-half"></i> U</span>
								</span>
									<input type="text" id="editzone_adiafani_yp_u" class="form-control input-sm" />
								<span class="input-group-addon"> W/m<sup>2</sup>.K</span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Αποθηκευμένος υπολογισμός αδιαφανών"><i class="fa fa-calculator"></i> Υπολογισμός</span>
								</span>
								<select class="form-control input-sm" id="editzone_adiafani_yp_u_id" onchange="zone_adiafani_yp_u();">
									<option value=0>Χωρίς υπολογισμό</option>
									<?php
									echo create_select_optionsid("user_adiafani","name",array("user_id"=>$_SESSION["user_id"]) );
									?>
								</select>
								</div>
							</div>
						</div>
					</td>
					</tr>
					
					<tr>
					<td>Αναλυτικά Δοκοί</td>
					<td>
						<input type="hidden" id="editzone_adiafani_dok_counter">
						<div id="editzone_adiafani_dokoi">
							<div id="row_dok_1">
								<div class="row">
									<div class="col-md-5">
										<div class="input-group">
										<span class="input-group-addon">
											<span class="tip-top" href="#" title="Το καθαρό ύψος δοκού σε m"><i class="fa fa-arrows-v"></i> Ύψος</span>
										</span>
											<input type="text" id="editzone_adiafani_dok_1" class="form-control input-sm" value="" />
											<span class="input-group-addon">m</span>
										</div>
									</div>
									<div class="col-md-5">
										<div class="input-group">
										<span class="input-group-addon">
											<span class="tip-top" href="#" title="Απόσταση του άνω τμήματος της δοκού από την κορυφή του τοίχου"><i class="fa fa-arrow-up"></i> Απ. πάνω</span>
										</span>
											<input type="text" id="editzone_adiafani_dok_top_1" class="form-control input-sm" value="" />
											<span class="input-group-addon">m</span>
										</div>
									</div>
									<div class="col-md-2">
										<button class="btn btn-success btn-sm" type="button" onclick="add_dok()"><i class="fa fa-plus"></i></button>
									</div>
								</div>
							</div>
						</div>
					</td>
					<td>
						<div class="row">
							<div class="col-md-6">
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Συντελεστής θερμοπερατότητας"><i class="fa fa-thermometer-half"></i> U</span>
								</span>
									<input type="text" id="editzone_adiafani_dok_u" class="form-control input-sm" />
								<span class="input-group-addon"> W/m<sup>2</sup>.K</span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon">
										<span class="tip-top" href="#" title="Αποθηκευμένος υπολογισμός αδιαφανών"><i class="fa fa-calculator"></i> Υπολογισμός</span>
									</span>
								<select class="form-control input-sm" id="editzone_adiafani_dok_u_id" onchange="zone_adiafani_dok_u();">
									<option value=0>Χωρίς υπολογισμό</option>
									<?php
									echo create_select_optionsid("user_adiafani","name",array("user_id"=>$_SESSION["user_id"]) );
									?>
								</select>
								</div>
							</div>
						</div>
					</td>
					</tr>
					
				</table>
			</div>
			
			<div class="tab-pane" id="tab_modal_3">
				<table class="table table-bordered table-condensed">
					<tr class="info">
						<td width=60%>
							<i class="fa fa-caret-square-o-right"></i> Διαστάσεις τμημάτων με διάκενο
						</td>
						<td width=40%>
							U συρομένων 
							<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#help_u_katakoryfa">
								<i class="fa fa-exchange text-danger"></i>
							</button>
						</td>
					</tr>
					<tr>
						<td>
							<input type="hidden" id="editzone_adiafani_syr_counter">
							<div id="editzone_adiafani_syromena">
								<div id="row_syr_1">
									<div class="row">
										<div class="col-md-5">
											<div class="input-group">
												<span class="input-group-addon">
													<span class="tip-top" href="#" title="Μήκος τμήματος σε m"><i class="fa fa-arrows-h"></i> Μήκος</span>
												</span>
												<input type="text" id="editzone_adiafani_syr_w_1" class="form-control input-sm" value="" />
												<span class="input-group-addon">m</span>
											</div>
											<div class="input-group">
												<span class="input-group-addon">
													<span class="tip-top" href="#" title="Ύψος τμήματος σε m"><i class="fa fa-arrows-v"></i> Ύψος</span>
												</span>
												<input type="text" id="editzone_adiafani_syr_h_1" class="form-control input-sm" value="" />
												<span class="input-group-addon">m</span>
											</div>
										</div>
										<div class="col-md-5">
											<div class="input-group">
												<span class="input-group-addon">
													<span class="tip-top" href="#" title="Ποδιά τμήματος σε m"><i class="fa fa-arrows-v"></i> Ποδιά</span>
												</span>
												<input type="text" id="editzone_adiafani_syr_p_1" class="form-control input-sm" value="" placeholder="Ποδιά" />
												<span class="input-group-addon">m</span>
											</div>
											<div class="input-group">
												<span class="input-group-addon">
													<span class="tip-top" href="#" title="Απόσταση τμήματος από αριστερό άκρο τοίχου σε m"><i class="fa fa-arrow-left"></i> Απ. αριστερά</span>
												</span>
												<input type="text" id="editzone_adiafani_syr_ar_1" class="form-control input-sm" value="" />
												<span class="input-group-addon">m</span>
											</div>
										</div>
										<div class="col-md-2" style="text-align:center; vertical-align:middle;">
											<button class="btn btn-success btn-sm" type="button" onclick="add_syr()"><i class="fa fa-plus"></i></button>
										</div>
									</div>
								</div>
							</div>
						</td>
						<td>
						<div class="row">
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon">
										<span class="tip-top" href="#" title="Συντελεστής θερμοπερατότητας"><i class="fa fa-thermometer-half"></i> U</span>
									</span>
									<input type="text" id="editzone_adiafani_syr_u" class="form-control input-sm" />
									<span class="input-group-addon"> W/m<sup>2</sup>.K</span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon">
										<span class="tip-top" href="#" title="Αποθηκευμένος υπολογισμός αδιαφανών"><i class="fa fa-calculator"></i> Υπολογισμός</span>
									</span>
									<select class="form-control input-sm" id="editzone_adiafani_syr_u_id" onchange="zone_adiafani_syr_u();">
										<option value=0>Χωρίς υπολογισμό</option>
										<?php
										echo create_select_optionsid("user_adiafani","name",array("user_id"=>$_SESSION["user_id"]) );
										?>
									</select>
								</div>
							</div>
						</div>	
						</td>
					</tr>
				</table>
			</div>
			
			<div class="tab-pane" id="tab_modal_4">
			<div id="adiafani_ck_f">
			<form class="form-inline">
				<label class="checkbox inline"><input type="checkbox" id="editzone_adiafani_ck_fhor" onchange="zone_adiafani_showf();">F<sub>hor</sub></label>
				<label class="checkbox inline"><input type="checkbox" id="editzone_adiafani_ck_fov" onchange="zone_adiafani_showf();">F<sub>ov</sub></label>
				<label class="checkbox inline"><input type="checkbox" id="editzone_adiafani_ck_fovt" onchange="zone_adiafani_showf();">F<sub>ovt</sub></label>
				<label class="checkbox inline"><input type="checkbox" id="editzone_adiafani_ck_ffin_l" onchange="zone_adiafani_showf();">F<sub>fin_l</sub></label>
				<label class="checkbox inline"><input type="checkbox" id="editzone_adiafani_ck_ffin_r" onchange="zone_adiafani_showf();">F<sub>fin_r</sub></label>
				<label class="checkbox inline"><input type="checkbox" id="editzone_adiafani_ck_fsh" onchange="zone_adiafani_showf();">F<sub>sh</sub></label>
			</form>
			</div>
			<div id="adiafani_ck_f1">
				<select class="form-control input-sm" id="editzone_adiafani_f_type" onchange="zone_adiafani_changef();" >
					<option value=0>Με υπολογισμό</option>
					<option value=1>Ολική</option>
					<option value=2>Ασκίαστος</option>
					<option value=3>U<0.6</option>
				</select>
			</div>
				<div id="editzone_adiafani_fhor" style="display:none;">
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
								<input type="text" id="editzone_adiafani_fhor_e" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Ύψος εμποδίου ορίζοντα σε m"><i class="fa fa-arrows-h"></i> Ύψος εμποδίου</span>
								</span>
								<input type="text" id="editzone_adiafani_fhor_h" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
						</tr>
					</table>
				</div>
				
				<div id="editzone_adiafani_fov" style="display:none;">
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
								<input type="text" id="editzone_adiafani_fov_l" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
						</tr>
					</table>
				</div>
				
				<div id="editzone_adiafani_fovt" style="display:none;">
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
								<input type="text" id="editzone_adiafani_fovt_l" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Ύψος τέντας σε m"><i class="fa fa-arrows-h"></i> Ύψος τέντας</span>
								</span>
								<input type="text" id="editzone_adiafani_fovt_h" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
						</tr>
					</table>
				</div>
				
				<div id="editzone_adiafani_ffin_l" style="display:none;">
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
								<input type="text" id="editzone_adiafani_ffin_l_dx" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Μήκος πλευρικού εμποδίου"><i class="fa fa-eraser"></i> Μήκος εμποδίου</span>
								</span>
								<input type="text" id="editzone_adiafani_ffin_l_w" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
						</tr>
					</table>
				</div>
				
				<div id="editzone_adiafani_ffin_r" style="display:none;">
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
								<input type="text" id="editzone_adiafani_ffin_r_dx" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Μήκος πλευρικού εμποδίου"><i class="fa fa-eraser"></i> Μήκος εμποδίου</span>
								</span>
								<input type="text" id="editzone_adiafani_ffin_r_w" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
						</tr>
					</table>
				</div>
				
				<div id="editzone_adiafani_fsh" style="display:none;">
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
								<select id="editzone_adiafani_fsh_type" class="form-control input-sm" />
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
								<input type="text" id="editzone_adiafani_fsh_l" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
							<td>
								<div class="input-group">
								<span class="input-group-addon">
									<span class="tip-top" href="#" title="Μήκος πλευρικού εμποδίου"><i class="fa fa-arrows-h"></i> Απόσταση περσίδων</span>
								</span>
								<input type="text" id="editzone_adiafani_fsh_h" class="form-control input-sm" />
								<span class="input-group-addon">m</span>
								</div>
							</td>
						</tr>
					</table>
				</div>
				
			</div>
			
			<div class="tab-pane" id="tab_modal_5">
				<table class="table table-bordered table-condensed">
					<tr class="info">
						<td colspan="2">
							Θερμογέφυρες 
							<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#help_psi">
							<i class="fa fa-exchange"></i></button>
						</td>
					</tr>
					<tr>
						<td width=70%>
							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
									<span class="input-group-addon">
										<span class="tip-top" href="#" title="Κατηγορία θερμογέφυρας στη βάση του τοίχου"><i class="fa fa-briefcase"></i> Δαπέδου</span>
									</span>
									<select class="form-control input-sm" id="editzone_adiafani_psi_dap_type" onchange="zone_adiafani_psi_type(1);">
										<option value=""></option>
									</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
									<span class="input-group-addon">
										<span class="tip-top" href="#" title="θερμογέφυρα στη βάση του τοίχου"><i class="fa fa-briefcase"></i> Ψ</span>
									</span>
									<select class="form-control input-sm" id="editzone_adiafani_psi_dap_u" onchange="zone_adiafani_psi_img(1);" onkeyup="zone_adiafani_psi_img(1);">
										<option value=0></option>
									</select>
									</div>
								</div>
							</div>
						</td>
						<td rowspan="5" width=30%>
						<div id="editzone_adiafani_psi_img">
							<div class="thumbnail">
								<img src="images/style/help_wall.png">
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
										<span class="tip-top" href="#" title="Κατηγορία θερμογέφυρας στην κορυφή του τοίχου"><i class="fa fa-briefcase"></i> Οροφής</span>
									</span>
									<select class="form-control input-sm" id="editzone_adiafani_psi_or_type" onchange="zone_adiafani_psi_type(2);">
										<option value=""></option>
									</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
									<span class="input-group-addon">
										<span class="tip-top" href="#" title="θερμογέφυρα στη βάση του τοίχου"><i class="fa fa-briefcase"></i> Ψ</span>
									</span>
									<select class="form-control input-sm" id="editzone_adiafani_psi_or_u" onchange="zone_adiafani_psi_img(2);" onkeyup="zone_adiafani_psi_img(2);">
										<option value=0></option>
									</select>
									</div>
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
										<span class="tip-top" href="#" title="Κατηγορία θερμογέφυρας στις ενώσεις υποστυλωμάτων"><i class="fa fa-briefcase"></i> Υποστυλωμάτων</span>
									</span>
									<select class="form-control input-sm" id="editzone_adiafani_psi_yp_type" onchange="zone_adiafani_psi_type(3);">
										<option value=""></option>
									</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<span class="tip-top" href="#" title="Θερμογέφυρα στις ενώσεις υποστυλωμάτων"><i class="fa fa-briefcase"></i> Ψ</span>
										</span>
									<select class="form-control input-sm" id="editzone_adiafani_psi_yp_u" onchange="zone_adiafani_psi_img(3);" onkeyup="zone_adiafani_psi_img(3);">
										<option value=0></option>
									</select>
									</div>
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
										<span class="tip-top" href="#" title="Κατηγορία θερμογέφυρας στη δοκό"><i class="fa fa-briefcase"></i> Δοκών</span>
									</span>
								<select class="form-control input-sm" id="editzone_adiafani_psi_dok_type" onchange="zone_adiafani_psi_type(4);">
									<option value=""></option>
								</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon">
										<span class="tip-top" href="#" title="θερμογέφυρα στη δοκό"><i class="fa fa-briefcase"></i> Ψ</span>
									</span>
								<select class="form-control input-sm" id="editzone_adiafani_psi_dok_u" onchange="zone_adiafani_psi_img(4);" onkeyup="zone_adiafani_psi_img(4);">
									<option value=0></option>
								</select>
								</div>
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
										<span class="tip-top" href="#" title="Κατηγορία θερμογέφυρας στις ενώσεις του τμήματος με διάκενο"><i class="fa fa-briefcase"></i> Συρομένων</span>
									</span>
								<select class="form-control input-sm" id="editzone_adiafani_psi_syr_type" onchange="zone_adiafani_psi_type(5);">
									<option value=""></option>
								</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon">
										<span class="tip-top" href="#" title="Θερμογέφυρα στις ενώσεις του τμήματος με διάκενο"><i class="fa fa-briefcase"></i> Ψ</span>
									</span>
								<select class="form-control input-sm" id="editzone_adiafani_psi_syr_u" onchange="zone_adiafani_psi_img(5);" onkeyup="zone_adiafani_psi_img(5);">
									<option value=0></option>
								</select>
								</div>
							</div>
						</div>	
						</td>
					</tr>
				</table>	
			</div>
			
			<div class="tab-pane" id="tab_modal_6">
				<table class="table table-bordered">
				<tr class="info">
					<td class="span4">Κάτοψη</td>
					<td class="span4">Τομή</td>
					<td class="span4">Όψη</td>
				</tr>	
				<tr>
					<td>
						<div class="thumbnail">
							<div id="editzone_adiafani_preview1">
								<img src="images/shading/fov.png">
							</div>
						</div>
					</td>
					<td>
						<div class="thumbnail">
							<div id="editzone_adiafani_preview2">
								<img src="images/shading/fov.png">
							</div>
						</div>
					</td>
					<td>
						<div class="thumbnail">
							<div id="editzone_adiafani_preview3">
								<img src="images/shading/fov.png">
							</div>
						</div>
					</td>
				</tr>	
				</table>	
			</div>
			
		</div>
	</div>
</div>	

<div class="modal-footer">	
	<span id="edit_button_zone_adiafani"></span>
	<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->	
<!-- ###################### Κρυφό modal_del_zone_adiafani για εμφάνιση ###################### -->
<div id="modal_del_zone_adiafani" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h6 id="myModalLabel">Διαγραφή τοίχου</h6>
</div>

<div class="modal-body">
Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
</div>	

<div class="modal-footer">	
	<span id="del_button_zone_adiafani"></span>
	<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- Modal -->
<div id="help_per" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">Ποσοστό φέροντα οργανισμού στο κτίριο</h4>
		</div>
		<div class="modal-body">
			Έτος κατασκευής:
			<select class="form-control input-sm"  id="editzone_adiafani_per1" onchange="zone_adiafani_help_per() ">
				<option value=1>Πριν το 1981</option>
				<option value=2>1981-1999</option>
			</select>
			Όροφοι:
			<select class="form-control input-sm"  id="editzone_adiafani_per2" onchange="zone_adiafani_help_per() ">
				<option value=1>Έως 2</option>
				<option value=2>2<οροφοι<5</option>
				<option value=3>>=5</option>
			</select>
			%:
			<input  class="form-control input-sm" id="editzone_adiafani_per4"/>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Κλείσιμο</button>
			<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="zone_adiafani_use_per4()">Προσθήκη</button>
		</div>
	</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<script>
document.getElementById("editzone_adiafani_yp_counter").value=1;
document.getElementById("editzone_adiafani_dok_counter").value=1;
document.getElementById("editzone_adiafani_syr_counter").value=1;

function add_yp() {
var yp = document.getElementById("editzone_adiafani_yp_counter").value;
yp ++;
//γραμμή υποστυλώματος
var row = '<div id="row_yp_'+yp+'"><div class="row">';
//Μήκος υποστυλώματος
row += '<div class="col-md-5">';
row += '<div class="input-group">';
row += '<span class="input-group-addon">';
row += '<span class="tip-top" href="#" title="Μήκος υποστυλώματος σε m"><i class="fa fa-arrows-h"></i> Μήκος</span>';
row += '</span>';
row += '<input type="text" id="editzone_adiafani_yp_'+yp+'" class="form-control input-sm" value="">';
row += '<span class="input-group-addon">m</span>';
row += '</div>';
row += '</div>';
//Απόσταση από αριστερό άκρο υποστυλώματος
row += '<div class="col-md-5">';
row += '<div class="input-group">';
row += '<span class="input-group-addon">';
row += '<span class="tip-top" href="#" title="Απόσταση από αριστερό άκρο του τοίχου σε m"><i class="fa fa-arrow-left"></i> Απ. αριστερά</span>';
row += '</span>';
row += '<input type="text" id="editzone_adiafani_yp_ar_'+yp+'" class="form-control input-sm" value="">';
row += '<span class="input-group-addon">m</span>';
row += '</div>';
row += '</div>';
//Κουμπί προσθήκης
row += '<div class="col-md-2">';
row += '<span class="help-inline">';
row += '<button class="btn btn-danger btn-sm" type="button" onclick="rem_yp('+yp+')"><i class="glyphicon glyphicon-remove"></i></button>';
row += '</span>';
row += '</div>';
row += '</div></div>';
jQuery('#editzone_adiafani_ypostylwmata').append(row);
$('#editzone_adiafani_yp_counter').val(yp);
}

function rem_yp(yp) {
jQuery('#row_yp_'+yp).remove();
}

function add_dok() {
var dok = document.getElementById("editzone_adiafani_dok_counter").value;
dok ++;
var row = '<div id="row_dok_'+dok+'"><div class="row">';
row += '<div class="col-md-5">';
row += '<div class="input-group">';
row += '<span class="input-group-addon">';
row += '<span class="tip-top" href="#" title="Το καθαρό ύψος της δοκού σε m"><i class="fa fa-arrows-v"></i> Ύψος</span>';
row += '</span>';
row += '<input type="text" id="editzone_adiafani_dok_'+dok+'" class="form-control input-sm" value="">';
row += '<span class="input-group-addon">m</span>';
row += '</div>';
row += '</div>';
row += '<div class="col-md-5">';
row += '<div class="input-group">';
row += '<span class="input-group-addon">';
row += '<span class="tip-top" href="#" title="Απόσταση του άνω τμήματος της δοκού από την κορυφή του τοίχου"><i class="fa fa-arrow-up"></i> Απ. πάνω</span>';
row += '</span>';
row += '<input type="text" id="editzone_adiafani_dok_top_'+dok+'" class="form-control input-sm" value="">';
row += '<span class="input-group-addon">m</span>';
row += '</div>';
row += '</div>';
row += '<div class="col-md-2">';
row += '<button class="btn btn-danger btn-sm" type="button" onclick="rem_dok('+dok+')"><i class="glyphicon glyphicon-remove"></i></button>';
row += '</div>';
row += '</div></div>';
jQuery('#editzone_adiafani_dokoi').append(row);
$('#editzone_adiafani_dok_counter').val(dok);
}

function rem_dok(dok) {
jQuery('#row_dok_'+dok).remove();
}

function add_syr() {
var syr = document.getElementById("editzone_adiafani_syr_counter").value;
syr ++;
var row = '<div id="row_syr_'+syr+'"><div class="row">';
row += '<hr/>';
row += '<div class="col-md-5">';
//Μήκος συρόμενου
row += '<div class="input-group">';
row += '<span class="input-group-addon">';
row += '<span class="tip-top" href="#" title="Μήκος τμήματος σε m"><i class="fa fa-arrows-h"></i> Μήκος</span>';
row += '</span>';
row += '<input type="text" id="editzone_adiafani_syr_w_'+syr+'" class="form-control input-sm" value="">';
row += '</div>';
//Ύψος συρόμενου
row += '<div class="input-group">';
row += '<span class="input-group-addon">';
row += '<span class="tip-top" href="#" title="Ύψος τμήματος σε m"><i class="fa fa-arrows-v"></i> Ύψος</span>';
row += '</span>';
row += '<input type="text" id="editzone_adiafani_syr_h_'+syr+'" class="form-control input-sm" value="">';
row += '</div>';
row += '</div>';
row += '<div class="col-md-5">';
//Ποδιά συρόμενου
row += '<div class="input-group">';
row += '<span class="input-group-addon">';
row += '<span class="tip-top" href="#" title="Ποδιά τμήματος σε m"><i class="fa fa-arrow-down"></i> Ποδιά</span>';
row += '</span>';
row += '<input type="text" id="editzone_adiafani_syr_p_'+syr+'" class="form-control input-sm" value="">';
row += '</div>';
//απόσταση από αριστερό άκρο συρόμενου
row += '<div class="input-group">';
row += '<span class="input-group-addon">';
row += '<span class="tip-top" href="#" title="Απόσταση τμήματος από αριστερό άκρο τοίχου σε m"><i class="fa fa-arrow-left"></i> Απ. αριστερά</span>';
row += '</span>';
row += '<input type="text" id="editzone_adiafani_syr_ar_'+syr+'" class="form-control input-sm" value="">';
row += '</div>';
row += '</div>';
row += '<div class="col-md-2">';
row += '<button class="btn btn-danger btn-sm" type="button" onclick="rem_syr('+syr+')"><i class="glyphicon glyphicon-remove"></i></button>';
row += '</div>';
row += '</div></div>';
jQuery('#editzone_adiafani_syromena').append(row);
$('#editzone_adiafani_syr_counter').val(syr);
}

function rem_syr(syr) {
jQuery('#row_syr_'+syr).remove();
}

var thermotype = "<option value=0>Εξωτερικές γωνίες-ΞΓ</option><option value=1>Εσωτερικές γωνίες-ΣΓ</option>";
thermotype += "<option value=2>Ενώσεις δομικών-ΣΣ</option><option value=3>Δώμα-Οροφή σε προεξοχή-ΔΣ</option>";
thermotype += "<option value=4>Δαπέδου σε προεξοχή/πυλωτή-ΔΠ</option><option value=5>Οροφή σε εσοχή-ΟΕ</option>";
thermotype += "<option value=6>Δάπεδο σε εσοχή-ΔΥ</option><option value=7>Ενδιάμεσο δάπεδο-ΕΔ</option>";
thermotype += "<option value=8>Δάπεδο σε έδαφος-ΔΦ</option><option value=9>Περιδέσμου ενίσχυσης-ΠΡ</option>";
thermotype += "<option value=10>Λαμπάς-ΛΠ</option><option value=11>Ανωκάσι/Κατωκάσι-ΥΠ</option>";

document.getElementById("editzone_adiafani_psi_dap_type").innerHTML=thermotype;
document.getElementById("editzone_adiafani_psi_or_type").innerHTML=thermotype;
document.getElementById("editzone_adiafani_psi_yp_type").innerHTML=thermotype;
document.getElementById("editzone_adiafani_psi_dok_type").innerHTML=thermotype;
document.getElementById("editzone_adiafani_psi_syr_type").innerHTML=thermotype;
</script>

