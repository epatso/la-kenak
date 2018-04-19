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
<div id="genxriseis_table"></div>
<div id="genxriseis_info"></div>

<script>
	get_genxriseis();
	
//Εμφάνιση πίνακα
function get_genxriseis(page){
page = typeof page !== 'undefined' ? page : 1;
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET","includes/functions_admin_libraries.php?get_genxriseis=1&page="+page ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("genxriseis_table").innerHTML=xmlhttp.responseText;
		document.getElementById('wait').style.display="none";
	}}
}
	
//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές
function form_genxriseis(id,page){
page = typeof page !== 'undefined' ? page : 1;
var prefix = "editgenxriseis_";

	if(id==0){
	document.getElementById(prefix+"name").value = "";
	}
	if(id!=0){
		var link = "includes/functions_admin_libraries.php?get_id=1&table=vivliothiki_conditions_general&id="+id;
	
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var arr = JSON.parse(xmlhttp.responseText);
				document.getElementById(prefix+"name").value = arr["name"];

			document.getElementById('wait').style.display="none";
		}}
		
	}
	
	var button,edit_header;
	if(id!=0){
		button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_genxriseis('+id+','+page+');">Επεξεργασία</button>';
		edit_header = 'Επεξεργασία';
	}else{
		button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_genxriseis('+id+','+page+');">Προσθήκη</button>';
		edit_header = 'Προσθήκη';
	}
	document.getElementById("edit_button_genxriseis").innerHTML = button;
	document.getElementById("edit_header_genxriseis").innerHTML = edit_header;
	$("#modal_form_genxriseis").modal("show");
}


function formdel_genxriseis(id,page){
	var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_genxriseis('+id+','+page+');">Διαγραφή</button>';
	document.getElementById("del_button_genxriseis").innerHTML = button;
	$("#modal_del_genxriseis").modal("show");
}

//Υποβολή της φόρμας
//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
function submit_genxriseis(id,page){
var prefix = "editgenxriseis_";
	var name = document.getElementById(prefix+"name").value;
	
		if(id==0){
		var action="create";
		}else{
		action="update";
		}
	var link = "includes/functions_admin_libraries.php?insert_id=1";
	link += "&table=vivliothiki_conditions_general";
	link += "&action="+action;
	link += "&id="+id;
	link += "&values="+name+"|";
	
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("genxriseis_info").innerHTML=xmlhttp.responseText;
		document.getElementById('wait').style.display="none";
		get_genxriseis(page);
	}}
}

//Διαγραφή
function del_genxriseis(id,page){
	var link = "includes/functions_admin_libraries.php?del_id=1&table=vivliothiki_conditions_general&id="+id;
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("genxriseis_info").innerHTML=xmlhttp.responseText;
		document.getElementById('wait').style.display="none";
		get_genxriseis(page);
	}}
}
	
</script>
				
<!-- ###################### Κρυφό modal_form_genxriseis για εμφάνιση ###################### -->
<div id="modal_form_genxriseis" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_genxriseis"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info">
			<td width=50%>Παράμετρος</td>
			<td width=50%>Τιμή</td>
		</tr>
		<tr>
		<tr>
			<td>Όνομα</td>
			<td>
				<input type="text" class="form-control input-sm" id="editgenxriseis_name">
			</td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_genxriseis"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_sith για εμφάνιση ###################### -->
<div id="modal_del_genxriseis" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
		<span id="del_button_genxriseis"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<?php
}
?>