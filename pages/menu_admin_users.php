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
confirm_admin();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
	<h1>
	La-kenak
	<small>Διαχειριστής</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-black-tie"></i> Διαχειριστής</a></li>
	<li class="active">Χρήστες</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- Main row -->
<div class="row">
<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>
	<div class="col-md-2">
		<?php
		if(isset($_SESSION['msg']['admin-err']))
		{
			echo "<div class=\"alert alert-error\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
			<strong>Προσοχή!</strong>".$_SESSION['msg']['admin-err']."</div>";
			unset($_SESSION['msg']['admin-err']);
		}
		?>
	
		<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Βοήθεια!</strong><br/>
		Εδώ εμφανίζονται οι εγγεγραμμένοι χρήστες στο λογισμικό.<br/><br/>
		Μπορείτε να επεξεργαστείτε και να ενημερώσετε τα στοιχεία του χρήστη ή να διαγράψετε κάποιο εγγεγραμμένο χρήστη.<br/><br/>
		Στην επεξεργασία του κάθε χρήστη ο κωδικός εμφανίζεται κρυπτογραφημένος. Εάν δεν αλλάξετε το κελί δεν μεταβάλλεται στη βάση δεδομένων και 
		μεταβάλλονται μόνο τα υπόλοιπα στοιχεία
		Εάν χρειάζεται να αλλάξετε τον κωδικό του χρήστη εισάγετε τον κωδικό που θέλετε να πληκτρολογεί ο χρήστης κατά τη σύνδεση. Ο κωδικός που εισάγετε 
		κρυπτογραφείται αυτόματα κατά την προσθήκη στη βάση δεδομένων.
		</div>
		
	</div>
	
	<script>
	function setUpToolTipHelpers() {
		$(".tip-top").tooltip({
			placement: 'top',
			html: true,
			animation: true
		});
		$(".tip-right").tooltip({
			placement: 'right',
			html: true,
			animation: true
		});
		$(".tip-bottom").tooltip({
			placement: 'bottom',
			html: true,
			animation: true
		});
		$(".tip-left").tooltip({
			placement: 'left',
			html: true,
			animation: true
		});
		$('.box-widget').boxWidget();
	}
	</script>
	
	
	<div class="col-md-10">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs-1" data-toggle="tab"><i class="fa fa-users"></i> Χρήστες</a></li>
				<li><a href="#tabs-2" data-toggle="tab"><i class="fa fa-life-ring"></i> Κέντρο υποστήριξης</a></li>
			</ul>
		
		
		<!-- ########################## XML TEE KENAK ################################# -->
		<div class="tab-content">
			<div class="tab-pane active" id="tabs-1">
			<br/>
		
		<div id="allusers"></div>
		<div id="allusers_info"></div>
		
		
		<!-- ###################### Κρυφό user_edit για εμφάνιση ###################### -->
		<div id="modal_user_edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h5 id="myModalLabel"><span id="modal_user_edit_header"></span></h5>
			</div>

			<div class="modal-body">
			<p>
			
			<table class="table table-condensed">
			<tr class="info">
				<td width="30%">
					<b>Όνομα χρήστη:</b>
				</td>
				<td width="70%">
					<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="Όνομα χρήστη σε plain text όπως θα τον εισάγει ο χρήστης στη σύνδεση"><i class="fa fa-user-secret"></i> Όνομα χρήστη</span>
					</span>
					<input class="form-control input-sm" type="text" id="esitusers_usr">
					</div>
				</td>
			</tr>
			<tr class="danger">
				<td>
					<b>Κωδικός:</b>
				</td>
				<td>
					<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="Κωδικός σε plain text όπως θα τον εισάγει ο χρήστης στη σύνδεση"><i class="fa fa-key"></i> Κωδικός</span>
					</span>
					<input class="form-control input-sm" type="text" id="esitusers_pass">
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<b>e-mail:</b>
				</td>
				<td>
					<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="E-mail του χρήστη"><i class="fa fa-envelope-o"></i> e-mail</span>
					</span>
					<input class="form-control input-sm" type="text" id="esitusers_email">
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<b>Όνομα/Επώνυμο:</b>
				</td>
				<td>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="E-mail του χρήστη"><i class="fa fa-user-o"></i> Όνομα</span>
							</span>
							<input class="form-control input-sm" type="text" id="esitusers_onoma">
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="E-mail του χρήστη"><i class="fa fa-user"></i> Επώνυμο</span>
							</span>
							<input class="form-control input-sm" type="text" id="esitusers_epwnymo">
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<b>Ειδικότητα:</b>
				</td>
				<td>
					<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="E-mail του χρήστη"><i class="fa fa-user-md"></i> Ειδικότητα</span>
					</span>
					<select class="form-control input-sm" id="esitusers_eidikotita">
					<?php
					echo create_select_optionsid("core_eidikotitesmhx","name");
					?>
					</select>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<b>Διεύθυνση:</b>
				</td>
				<td>
					<div class="input-group">
						<span class="input-group-addon">
							<span class="tip-top" href="#" title="E-mail του χρήστη"><i class="fa fa-address"></i> Δ/νση</span>
						</span>
						<input class="form-control input-sm" type="text" id="esitusers_address">
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<b>Lat x/y/z:</b>
				</td>
				<td>
					<div class="row">
						<div class="col-md-4">
							<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="E-mail του χρήστη"><i class="fa fa-map"></i> lat</span>
							</span>
							<input class="form-control input-sm" type="text" id="esitusers_address_x">
							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="E-mail του χρήστη"><i class="fa fa-map"></i> lon</span>
							</span>
							<input class="form-control input-sm" type="text" id="esitusers_address_y">
							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="E-mail του χρήστη"><i class="fa fa-globe"></i> z</span>
							</span>
							<input class="form-control input-sm" type="text" id="esitusers_address_z">
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<b>Τηλέφωνο/Fax:</b>
				</td>
				<td>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="E-mail του χρήστη"><i class="fa fa-phone"></i> Τηλ</span>
							</span>
							<input class="form-control input-sm" type="text" id="esitusers_tel">
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="E-mail του χρήστη"><i class="fa fa-fax"></i> Fax</span>
							</span>
							<input class="form-control input-sm" type="text" id="esitusers_fax">
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<b>ΑΔΤ/ΑΦΜ:</b>
				</td>
				<td>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="E-mail του χρήστη"><i class="fa fa-id-card-o"></i> ΑΔΤ</span>
							</span>
							<input class="form-control input-sm" type="text" id="esitusers_taytotita">
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="E-mail του χρήστη"><i class="fa fa-exclamation-circle"></i> ΑΦΜ</span>
							</span>
							<input class="form-control input-sm" type="text" id="esitusers_afm">
							</div>
						</div>
					</div>
				</td>
			</tr>
			
			<tr>
				<td>
					<b>Συνδρομή:</b>
				</td>
				<td>
					<div class="row">
						<div class="col-md-4">
							<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="Όριο μελετών στο λογαριασμό χρήστη"><i class="fa fa-building-o"></i> Μελέτες<sub>max</sub></span>
							</span>
							<input class="form-control input-sm" type="text" id="esitusers_meletes_max">
							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="E-mail του χρήστη"><i class="fa fa-calendar"></i> Αρχή</span>
							</span>
							<input class="form-control input-sm" type="text" id="esitusers_subscription_start">
							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="E-mail του χρήστη"><i class="fa fa-calendar"></i> Τέλος</span>
							</span>
							<input class="form-control input-sm" type="text" id="esitusers_subscription_end">
							</div>
						</div>
					</div>
				</td>
			</tr>
			</table>
			
			<style>
			#daterangepicker{
			  position: fixed;
			  z-index: 10000;
			}
			</style>
			<script>
			$(function () {
				 $('#esitusers_subscription_start').daterangepicker({ 
					container: 'body',
					showDropdowns: true,
					singleDatePicker: true,
					timePicker: true,
					timePicker24Hour: true,
					timePickerSeconds: true,
					locale: {
						format: 'YYYY-MM-DD HH:mm:ss'
					},
					parentEl: $('#modal_user_edit')
				})
				 $('#esitusers_subscription_end').daterangepicker({ 
					container: 'body',
					showDropdowns: true,
					singleDatePicker: true,
					timePicker: true,
					timePicker24Hour: true,
					timePickerSeconds: true,
					locale: {
						format: 'YYYY-MM-DD HH:mm:ss'
					},
					parentEl: $('#modal_user_edit')
				})
			})
			//$('#esitusers_subscription_start').on('click', function(e){
			//	var modalZindex = $(e.target).closest('.modal').css('z-index');
			//	$('.daterangepicker').css('z-index', modalZindex+1);
			//});
			</script>
			
			</p>
			</div>
		
			<div class="modal-footer">
			<span id="modal_user_edit_button"></span>
			<button class="btn" data-dismiss="modal" aria-hidden="true">Ακύρωση</button>
			</div>
		</div>	
		</div>
		</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->	

<!-- ###################### Κρυφό modal_del_user για εμφάνιση ###################### -->
<div id="modal_del_user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή ΧΡΗΣΤΗ</h6>
	</div>

	<div class="modal-body">
	<i class="fa fa-exclamation-triangle fa-3x"></i>
	Προσοχή! Ο χρήστης θα διαγραφεί εντελώς από τη βάση δεδομένων. Οι μελέτες του παραμένουν αλλά δεν υπάρχει πρόσβαση σε αυτές. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_userbutton"></span>
		<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

<script>
get_usertable();
//Εμφάνιση του πίνακα χρηστών
	function get_usertable(){
		var link = "includes/functions_admin.php?get_allusers=1";
		
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			
			document.getElementById('allusers').innerHTML = xmlhttp.responseText;
			document.getElementById('wait').style.display="none";
		}}
			
	}

//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία	
	function modal_useredit(id){
	var prefix = "esitusers_";

		if(id==0){
		document.getElementById(prefix+"usr").value = "";
		document.getElementById(prefix+"pass").value = "";
		document.getElementById(prefix+"email").value = "";
		document.getElementById(prefix+"onoma").value = "";
		document.getElementById(prefix+"epwnymo").value = "";
		document.getElementById(prefix+"eidikotita").selectedIndex = 0;
		document.getElementById(prefix+"address").value = "";
		document.getElementById(prefix+"address_x").value = "";
		document.getElementById(prefix+"address_y").value = "";
		document.getElementById(prefix+"address_z").value = "";
		document.getElementById(prefix+"tel").value = "";
		document.getElementById(prefix+"fax").value = "";
		document.getElementById(prefix+"taytotita").value = "";
		document.getElementById(prefix+"afm").value = "";
		document.getElementById(prefix+"meletes_max").value = "";
		document.getElementById(prefix+"subscription_start").value = "";
		document.getElementById(prefix+"subscription_end").value = "";
		}
		if(id!=0){
			var link = "includes/functions_admin.php?get_userdata=1&id="+id;
		
			document.getElementById('wait').style.display="inline";
			//AJAX call
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.open("GET",link ,true);
			xmlhttp.send();
			xmlhttp.onreadystatechange=function()  {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				var arr = JSON.parse(xmlhttp.responseText);	
					
					document.getElementById(prefix+"usr").value = arr["usr"];
					document.getElementById(prefix+"pass").value = "";
					document.getElementById(prefix+"email").value = arr["email"];
					document.getElementById(prefix+"onoma").value = arr["onoma"];
					document.getElementById(prefix+"epwnymo").value = arr["epwnymo"];
					document.getElementById(prefix+"eidikotita").value = arr["eidikotita"];
					document.getElementById(prefix+"address").value = arr["address"];
					document.getElementById(prefix+"address_x").value = arr["address_x"];
					document.getElementById(prefix+"address_y").value = arr["address_y"];
					document.getElementById(prefix+"address_z").value = arr["address_z"];
					document.getElementById(prefix+"tel").value = arr["tel"];
					document.getElementById(prefix+"fax").value = arr["fax"];
					document.getElementById(prefix+"taytotita").value = arr["taytotita"];
					document.getElementById(prefix+"afm").value = arr["afm"];
					document.getElementById(prefix+"meletes_max").value = arr["meletes_max"];
					document.getElementById(prefix+"subscription_start").value = arr["subscribtion_start"];
					document.getElementById(prefix+"subscription_end").value = arr["subscribtion_end"];
					
				document.getElementById('wait').style.display="none";
			}}
			
		}
		
		var button,edit_header;
		if(id!=0){
			button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_user('+id+');">Επεξεργασία</button>';
			edit_header = 'Επεξεργασία χρήστη';
		}else{
			button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_user('+id+');">Προσθήκη</button>';
			edit_header = 'Προσθήκη χρήστη';
		}
		document.getElementById("modal_user_edit_button").innerHTML = button;
		document.getElementById("modal_user_edit_header").innerHTML = edit_header;
		$("#modal_user_edit").modal("show");
	}
	
	
	//Υποβολή της φόρμας
	//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
	function submit_user(id){
	var prefix = "esitusers_";
		var usr = document.getElementById(prefix+"usr").value;
		var pass = document.getElementById(prefix+"pass").value;
		var email = document.getElementById(prefix+"email").value;
		var onoma = document.getElementById(prefix+"onoma").value;
		var epwnymo = document.getElementById(prefix+"epwnymo").value;
		var eidikotita = document.getElementById(prefix+"eidikotita").value;
		var address = document.getElementById(prefix+"address").value;
		var address_x = document.getElementById(prefix+"address_x").value;
		var address_y = document.getElementById(prefix+"address_y").value;
		var address_z = document.getElementById(prefix+"address_z").value;
		var tel = document.getElementById(prefix+"tel").value;
		var fax = document.getElementById(prefix+"fax").value;
		var taytotita = document.getElementById(prefix+"taytotita").value;
		var afm = document.getElementById(prefix+"afm").value;
		var meletes_max = document.getElementById(prefix+"meletes_max").value;
		var subscription_start = document.getElementById(prefix+"subscription_start").value;
		var subscription_end = document.getElementById(prefix+"subscription_end").value;
		
			if(id==0){
			var action="create";
			}else{
			action="update";
			}
		var link = "includes/functions_admin.php?update_userdata=1";
		link += "&action="+action;
		link += "&id="+id;
		link += "&values="+usr+"|"+pass+"|"+email+"|"+onoma+"|"+epwnymo+"|"+eidikotita+"|"+address;
		link += "|"+address_x+"|"+address_y+"|"+address_z+"|"+tel+"|"+fax+"|"+taytotita+"|"+afm;
		link += "|"+meletes_max+"|"+subscription_start+"|"+subscription_end;
		
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("allusers_info").innerHTML=xmlhttp.responseText;
			document.getElementById('wait').style.display="none";
			get_usertable();
		}}
	}
	
	//modal ΔΙΑΓΡΑΦΗ
	function modal_userdelete(id){
		var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_user('+id+');">Διαγραφή</button>';
		document.getElementById("del_userbutton").innerHTML = button;
		$("#modal_del_user").modal("show");
	}
	
	//Διαγραφη υποβολή
	function del_user(id){
		var link = "includes/functions_admin.php?delete_user=1&id="+id;
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("allusers_info").innerHTML=xmlhttp.responseText;
			document.getElementById('wait').style.display="none";
			get_usertable();
		}}
	}
		
</script>
	
	</div><!--tabs-1-->
	
	
	<div class="tab-pane" id="tabs-2">
		<br/>
		
		<?php
			$database = new medoo(DB_NAME);
			$tb_tickets= "user_tickets";
			$where_open=array("state"=>1);
			$where_close=array("state"=>2);
			$count_open = $database->count($tb_tickets,$where_open);
			$count_close = $database->count($tb_tickets,$where_close);
			$count_total = $count_open + $count_close;
		?>
		
		<a class="btn btn-app" onclick="get_admin_tickets(0);">
			<span class="badge bg-teal" id="admintickets_total"><?php echo $count_total;?></span>
			<i class="fa fa-database"></i> Όλα
		</a>
		
		<a class="btn btn-app" onclick="get_admin_tickets(1);">
			<span class="badge bg-red" id="admintickets_open"><?php echo $count_open;?></span>
			<i class="fa fa-envelope-open-o"></i> Ανοικτά
		</a>
		
		<a class="btn btn-app" onclick="get_admin_tickets(2);">
			<span class="badge bg-green" id="admintickets_close"><?php echo $count_close;?></span>
			<i class="fa fa-envelope-o"></i> Κλειστά
		</a>
		
		<div id="admin_tickets"></div>
		<div id="admin_tickets_info"></div>
		
<script>
	get_admin_tickets();
	//Εμφάνιση του πίνακα χρηστών
	function get_admin_tickets(state){
		state = typeof state !== 'undefined' ? state : 0;
		var link = "includes/functions_admin.php?get_admin_tickets=1&state="+state;
		
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			
			document.getElementById('admin_tickets').innerHTML = xmlhttp.responseText;
			document.getElementById('wait').style.display="none";
			setUpToolTipHelpers();
			admintickets_stats();
		}}	
	}
	
	//Στατιστικά
	function admintickets_stats(){
		var link = "includes/functions_admin.php?admintickets_stats=1";
		
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var stats=JSON.parse(xmlhttp.responseText);
			document.getElementById("admintickets_total").innerHTML= stats[0];
			document.getElementById("admintickets_open").innerHTML= stats[1];
			document.getElementById("admintickets_close").innerHTML= stats[2];
			document.getElementById('wait').style.display="none";
			setUpToolTipHelpers();
		}}	
	}

	//Κλείσιμο ticket
	function admintickets_toggle(id){
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","includes/functions_admin.php?admintickets_toggle=1&id="+id ,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("admin_tickets_info").innerHTML=xmlhttp.responseText;
			document.getElementById('wait').style.display="none";
			get_admin_tickets(0);
			setUpToolTipHelpers();
		}}
	}
	
	//Σχολιασμός ticket
	function admintickets_comment(id){
		var text = document.getElementById("admintickets_comment"+id).value;
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","includes/functions_admin.php?admintickets_comment=1&id="+id+"&text="+text ,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("admin_tickets_info").innerHTML=xmlhttp.responseText;
			document.getElementById('wait').style.display="none";
			get_admin_tickets(0);
			setUpToolTipHelpers();
		}}
	}
	
	//Διαγραφή σχολιασμού ticket
	function admintickets_delcomment(id){
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","includes/functions_admin.php?admintickets_delcomment=1&id="+id ,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("admin_tickets_info").innerHTML=xmlhttp.responseText;
			document.getElementById('wait').style.display="none";
			get_admin_tickets(0);
			setUpToolTipHelpers();
		}}
	}
		
</script>		
		
		
		
	</div><!--tabs-2-->
	
	
			
	</div><!--tab content-->
	</div><!--tabs-->
	
	</div><!-- col-md-10 -->
</div>
 <!-- /.row (main row) -->
	
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->