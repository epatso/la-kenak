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
confirm_logged_in();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
	<h1>
	La-kenak
	<small>Βιβλιοθήκες χρήστη</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-user"></i> Χρήστης</a></li>
	<li class="active">Βιβλιοθήκες χρήστη</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- Main row -->
<div class="row">
	
		<div class="col-md-2">
			    <div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4><i class="fa fa-book" aria-hidden="true"></i> Βιβλιοθήκες χρήστη</h4>
				Επισκόπηση βιβλιοθήκης του χρήστη. <br/>Εμφανίζονται οι υπολογισμοί που έχετε προσθέσει στην καρτέλα 
				υπολογισμοί. <br/><br/>Επίσης μπορείτε να προσθέσετε υλικά (πχ εάν έχετε την πιστοποίηση ενός νέου υλικού) ώστε 
				να το χρησιμοποιείτε στην καρτέλα υπολογισμών. 
				</div>
		</div>
		
		<div class="col-md-10">
			<div class="nav-tabs-custom">
			<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs-1" data-toggle="tab"><i class="fa fa-clone"></i> Υλικά</a></li>
				<li><a href="#tabs-2" data-toggle="tab"><i class="fa fa-leaf"></i> Αδιαφανή</a></li>
				<li><a href="#tabs-3" data-toggle="tab"><i class="fa fa-lemon-o"></i> Διαφανή</a></li>
			</ul>
			
			<div class="tab-content">
			<div class="tab-pane active" id="tabs-1">
			<?php
			/*
				$ped="user_domika";
				$dig="0|0|0|0|3|2|2|2|0|0|0|0|0";
				$tb_name="user_domika";
				$tb_title = "Δομικά υλικά χρήστη";
				$fields="fields: {
					id: {key: true,create: false,edit: false,list: false},
					user_id: {create: false,edit: false,list: false},
					material: {title: 'Όνομα',width: '20%',listClass: 'center'},
					r: {title: 'Πυκνότητα (Kg/m<sup>3</sup>)',width: '20%',listClass: 'center'},
					l: {title: 'λ (W/m.K)',width: '20%',listClass: 'center'},
					cp: {title: 'cp (J/kg.K)',width: '20%',listClass: 'center'},
					m_dry: {title: 'μ (ξηρό)',width: '10%',listClass: 'center'},
					m_liquid: {title: 'μ (υγρό)',width: '10%',listClass: 'center'}
				}";
				include('includes/jtable_justuser.php');
			*/
			?>
			<br/>
			
			<div id="usermaterials_table"></div>
			<div id="usermaterials_info"></div>
			<script>
			get_usermaterials();
			
			//Εμφάνιση πίνακα με όλες τις μονάδες παραγωγής του χρήστη
			function get_usermaterials(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_userlibraries.php?getusermaterials=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("usermaterials_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
				}}
			}
			
			//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές
			function form_usermaterials(id,page){
			var prefix = "editusermaterials_";

				if(id==0){
				document.getElementById(prefix+"material").value = "";
				document.getElementById(prefix+"r").value = "";
				document.getElementById(prefix+"l").value = "";
				document.getElementById(prefix+"cp").value = "";
				document.getElementById(prefix+"m_dry").value = "";
				document.getElementById(prefix+"m_liquid").value = "";
				}
				if(id!=0){
					var link = "includes/functions_userlibraries.php?get_iddata_user=1&type=material&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);	

							document.getElementById(prefix+"material").value = arr["material"];
							document.getElementById(prefix+"r").value = arr["r"];
							document.getElementById(prefix+"l").value = arr["l"];
							document.getElementById(prefix+"cp").value = arr["cp"];
							document.getElementById(prefix+"m_dry").value = arr["m_dry"];
							document.getElementById(prefix+"m_liquid").value = arr["m_liquid"];
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_usermaterials('+id+','+page+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία υλικού';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_usermaterials('+id+','+page+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη υλικού';
				}
				document.getElementById("edit_button_usermaterials").innerHTML = button;
				document.getElementById("edit_header_usermaterials").innerHTML = edit_header;
				$("#modal_form_usermaterials").modal("show");
			}
			
			//ΔΙΑΓΡΑΦΗ ΜΟΝΑΔΑΣ ΠΑΡΑΓΩΓΗΣ
			function formdel_usermaterials(id,page){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_usermaterials('+id+','+page+');">Διαγραφή</button>';
				document.getElementById("del_button_usermaterials").innerHTML = button;
				$("#modal_del_usermaterials").modal("show");
			}
			
			//Υποβολή της φόρμας για ΜΟΝΑΔΑ ΠΑΡΑΓΩΓΗΣ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_usermaterials(id,page){
			var prefix = "editusermaterials_";
			
				var material = document.getElementById(prefix+"material").value;
				var r = document.getElementById(prefix+"r").value;
				var l = document.getElementById(prefix+"l").value;
				var cp = document.getElementById(prefix+"cp").value;
				var m_dry = document.getElementById(prefix+"m_dry").value;
				var m_liquid = document.getElementById(prefix+"m_liquid").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_userlibraries.php?insert_iddata_user=1";
				link += "&type=material";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+material+","+r+","+l+","+cp+","+m_dry+","+m_liquid;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("usermaterials_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_usermaterials(page);
				}}
			}
			
			//Διαγραφή
			function del_usermaterials(id,page){
				var link = "includes/functions_userlibraries.php?del_iddata_user=1";
				link += "&type=material";
				link += "&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("usermaterials_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_usermaterials(page);
				}}
			}
			</script>

<!-- ###################### Κρυφό modal_form_usermaterials για εμφάνιση ###################### -->
<div id="modal_form_usermaterials" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_usermaterials"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info"><td width=50%>Παράμετρος</td><td width=50%>Τιμή</td></tr>
		<tr>
			<td>Ονομασία υλικού</td>
			<td>
			<input class="form-control input-sm" type="text" id="editusermaterials_material">
			</td>
		</tr>
		<tr>
			<td>ρ (Kg/m<sup>3</sup>)</td>
			<td>
			<input class="form-control input-sm" type="text" id="editusermaterials_r">
			</td>
		</tr>
		<tr>
			<td>λ (W/m.K)</td>
			<td>
			<input class="form-control input-sm" type="text" id="editusermaterials_l">
			</td>
		</tr>
		<tr>
			<td>cp (J/kg.K)</td>
			<td>
			<input class="form-control input-sm" type="text" id="editusermaterials_cp">
			</td>
		</tr>
		<tr>
			<td>μ (ξηρό)</td>
			<td>
			<input class="form-control input-sm" type="text" id="editusermaterials_m_dry">
			</td>
		</tr>
		<tr>
			<td>μ (υγρό)</td>
			<td>
			<input class="form-control input-sm" type="text" id="editusermaterials_m_liquid">
			</td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_usermaterials"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_usermaterials για εμφάνιση ###################### -->
<div id="modal_del_usermaterials" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή υλικού</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_usermaterials"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->			
			
			<blockquote>
				<small>
				Κάθε υλικό που προστίθεται είναι διαθέσιμο ως υλικό στρώσεων στο μενού "Υλικά χρήστη" στον 
				<a href="?nav=calc_adiafani">υπολογισμό αδιαφανών</a>.
				</small>
			</blockquote>
			</div>
			
			
			<div class="tab-pane" id="tabs-2"> 
			<br/>
			
			<div id="useradiafani_table"></div>
			<div id="useradiafani_info"></div>
			<script>
			get_useradiafani();
			
			//Εμφάνιση πίνακα με όλες τις μονάδες παραγωγής του χρήστη
			function get_useradiafani(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_userlibraries.php?getuseradiafani=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("useradiafani_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
				}}
			}
			
			//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές
			function form_useradiafani(id,page){
			var prefix = "edituseradiafani_";

				if(id==0){
				document.getElementById(prefix+"name").value = "";
				document.getElementById(prefix+"zwni").selectedIndex = 0;
				}
				if(id!=0){
					var link = "includes/functions_userlibraries.php?get_iddata_user=1&type=adiafani&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);	

							document.getElementById(prefix+"name").value = arr["name"];
							document.getElementById(prefix+"zwni").value = arr["zwni"];
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_useradiafani('+id+','+page+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία ηλιακού';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_useradiafani('+id+','+page+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη ηλιακού';
				}
				document.getElementById("edit_button_useradiafani").innerHTML = button;
				document.getElementById("edit_header_useradiafani").innerHTML = edit_header;
				$("#modal_form_useradiafani").modal("show");
			}
			
			//ΔΙΑΓΡΑΦΗ
			function formdel_useradiafani(id,page){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_useradiafani('+id+','+page+');">Διαγραφή</button>';
				document.getElementById("del_button_useradiafani").innerHTML = button;
				$("#modal_del_useradiafani").modal("show");
			}
			
			//Υποβολή της φόρμας
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_useradiafani(id,page){
			var prefix = "edituseradiafani_";
			
				var name = document.getElementById(prefix+"name").value;
				var zwni = document.getElementById(prefix+"zwni").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_userlibraries.php?insert_iddata_user=1";
				link += "&type=adiafani";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+name+","+zwni;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("useradiafani_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_useradiafani(page);
				}}
			}
			
			//Διαγραφή
			function del_useradiafani(id,page){
				var link = "includes/functions_userlibraries.php?del_iddata_user=1";
				link += "&type=adiafani";
				link += "&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("useradiafani_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_useradiafani(page);
				}}
			}
			</script>

<!-- ###################### Κρυφό modal_form_useradiafani για εμφάνιση ###################### -->
<div id="modal_form_useradiafani" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_useradiafani"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info"><td width=50%>Παράμετρος</td><td width=50%>Τιμή</td></tr>
		<tr>
			<td>Ονομασία υπολογισμού αδιαφανών</td>
			<td>
			<input class="form-control input-sm" type="text" id="edituseradiafani_name">
			</td>
		</tr>
		<tr>
			<td>Κλιματική ζώνη</td>
			<td>
			<select class="form-control input-sm" type="text" id="edituseradiafani_zwni">
				<option value=0>Ζώνη Α</option>
				<option value=1>Ζώνη Β</option>
				<option value=2>Ζώνη Γ</option>
				<option value=3>Ζώνη Δ</option>
			</select>
			</td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_useradiafani"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_useradiafani για εμφάνιση ###################### -->
<div id="modal_del_useradiafani" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή υπολογισμού αδιαφανών</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_useradiafani"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->	
			
			<a href="?nav=calc_adiafani" role="button" class="btn btn-default" data-toggle="modal"><i class="fa fa-calculator"></i> Μετάβαση στον υπολογισμό</a>
			</div>
			
			<div class="tab-pane" id="tabs-3"> 
			<br/>
			
			<div id="userdiafani_table"></div>
			<div id="userdiafani_info"></div>
			<script>
			get_userdiafani();
			
			//Εμφάνιση πίνακα με όλες τις μονάδες παραγωγής του χρήστη
			function get_userdiafani(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_userlibraries.php?getuserdiafani=1&page="+page ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("userdiafani_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
				}}
			}
			
			//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές
			function form_userdiafani(id,page){
			var prefix = "edituserdiafani_";

				if(id==0){
				document.getElementById(prefix+"name").value = "";
				document.getElementById(prefix+"zwni").selectedIndex = 0;
				}
				if(id!=0){
					var link = "includes/functions_userlibraries.php?get_iddata_user=1&type=diafani&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);	

							document.getElementById(prefix+"name").value = arr["name"];
							document.getElementById(prefix+"zwni").value = arr["zwni"];
							
						document.getElementById('wait').style.display="none";
					}}
					
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_userdiafani('+id+','+page+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία ηλιακού';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_userdiafani('+id+','+page+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη ηλιακού';
				}
				document.getElementById("edit_button_userdiafani").innerHTML = button;
				document.getElementById("edit_header_userdiafani").innerHTML = edit_header;
				$("#modal_form_userdiafani").modal("show");
			}
			
			//ΔΙΑΓΡΑΦΗ
			function formdel_userdiafani(id,page){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_userdiafani('+id+','+page+');">Διαγραφή</button>';
				document.getElementById("del_button_userdiafani").innerHTML = button;
				$("#modal_del_userdiafani").modal("show");
			}
			
			//Υποβολή της φόρμας
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_userdiafani(id,page){
			var prefix = "edituserdiafani_";
			
				var name = document.getElementById(prefix+"name").value;
				var zwni = document.getElementById(prefix+"zwni").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_userlibraries.php?insert_iddata_user=1";
				link += "&type=diafani";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+name+","+zwni;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("userdiafani_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_userdiafani(page);
				}}
			}
			
			//Διαγραφή
			function del_userdiafani(id,page){
				var link = "includes/functions_userlibraries.php?del_iddata_user=1";
				link += "&type=diafani";
				link += "&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("userdiafani_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_userdiafani(page);
				}}
			}
			</script>

<!-- ###################### Κρυφό modal_form_userdiafani για εμφάνιση ###################### -->
<div id="modal_form_userdiafani" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_userdiafani"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info"><td width=50%>Παράμετρος</td><td width=50%>Τιμή</td></tr>
		<tr>
			<td>Ονομασία υπολογισμού αδιαφανών</td>
			<td>
			<input class="form-control input-sm" type="text" id="edituserdiafani_name">
			</td>
		</tr>
		<tr>
			<td>Κλιματική ζώνη</td>
			<td>
			<select class="form-control input-sm" type="text" id="edituserdiafani_zwni">
				<option value=0>Ζώνη Α</option>
				<option value=1>Ζώνη Β</option>
				<option value=2>Ζώνη Γ</option>
				<option value=3>Ζώνη Δ</option>
			</select>
			</td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_userdiafani"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_userdiafani για εμφάνιση ###################### -->
<div id="modal_del_userdiafani" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή υπολογισμού αδιαφανών</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_userdiafani"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->	
			
			
			<a href="?nav=calc_diafani" role="button" class="btn btn-default" data-toggle="modal"><i class="fa fa-calculator"></i> Μετάβαση στον υπολογισμό</a>
			</div>

	</div>
	<!--/tab-content-->
		
	</div>
	<!--/tabbable tabs-->
	</div>
	<!--/col-md-10-->
</div>
 <!-- /.row (main row) -->
	
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
