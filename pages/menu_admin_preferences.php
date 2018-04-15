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
	<li class="active">Προτιμήσεις</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- Main row -->
<div class="row">
	
	<div class="col-md-2">			
		<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Γενικές ρυθμίσεις</h4>
		Ορίστε γενικές ρυθμίσεις για το λογισμικό. Αφορά όλους τους χρήστες<br/><br/>
		</div>
		
		<div id="coreprefs_info"></div>
	</div>
	
	<script>
		$(function() {
			$('.tooltipui').tooltip({
				track: true,
				html: true,
				animation: true
			});
			$('.tooltip').tooltip({
				track: true,
				html: true,
				animation: true
			});
			$('.popover').popover();
			$('.popoverui').popover({ placement:'top',html:true, trigger:'click' });
			setUpToolTipHelpers();
		});
		
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
		}
	</script>
	
	<div class="col-md-10">
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab">Προτιμήσεις</a></li>
			<li><a href="#tabs-2" data-toggle="tab">Στοιχεία μενού</a></li>
			<li><a href="#tabs-3" data-toggle="tab">Στατιστικά σύνδεσης</a></li>
		</ul>
		
		<div class="tab-content">
		<div class="tab-pane active" id="tabs-1">
			
			<table class="table table-bordered table-condensed">
				<tr>
					<td colspan="2" class="info">
						<i class="fa fa-key"></i> Διαχείριση χρηστών
					</td>
				</tr>
				<tr>
					<td width="30%">
						<font color="red">
						<i class="fa fa-registered"></i> 
						<span class="tip-top" href="#" title="Επιτρέπει την εγγραφή νέων χρηστών στο La-kenak 
						μέσω της φόρμας εγγραφής. <br/>Δεν επηρρεάζει τη σύνδεση με Google ID.">Να επιτρέπονται οι εγγραφές</span>
						</font>
					</td>
					<td width="70%">
						<div class="checkbox">
							<label>
							<input type="checkbox" id="adminprefs_registration"> Εγγραφές χρηστών
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="info">
						<i class="fa fa-archive"></i> Online
					</td>
				</tr>
				<tr>
					<td>
						<font color="red">
						<i class="fa fa-truck"></i> 
						<span class="tip-top" href="#" title="Βγάζει το λογισμικό offline. Κανένας χρήστης δεν 
						έχει πρόσβαση πέραν των διαχειριστών.">Offline για λόγους συντήρησης;</span>
						</font>
					</td>
					<td>
						<div class="checkbox">
							<label>
							<input type="checkbox" id="adminprefs_offline"> Συντήρηση λογισμικού
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<i class="fa fa-truck"></i>  
						<span class="tip-top" href="#" title="Δίνει ένα σύντομο κείμενο στους χρήστες που 
						δε μπορούν πλέον να συνδεθούν.">Κείμενο σε κατάσταση συντήρησης</span>
					</td>
					<td>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-truck"></i> 
							</span>
							<input type="text" class="form-control input-sm" id="adminprefs_offlinetxt" placeholder="offline text">
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="info">
						<i class="fa fa-google"></i> Maping Services / Login Services
					</td>
				</tr>
				<tr>
					<td>
						<font>
						<i class="fa fa-rocket"></i> 
						<span class="tip-top" href="#" title="Προσοχή: <br/>Εάν το λογισμικό αποκτήσει συνδρομή 
						οι χάρτες google απαιτούν πληρωμένο api. Οι χάρτες Openstreetmap δεν έχουν τέτοια απαίτηση. <br/>
						Εάν δεν επιλεγεί χρησιμοποιούνται αυτόματα OpenLayers με χρήση Nominatim για την εύρεση διεύθυνσης και 
						Open-Elevation για την εύρεση του υψομέτρου. <br/> Εάν το λογισμικό χρησιμοποιηθεί σε επίπεδο χώρας θα 
						πρέπει να στηθεί server με το Nominatim (γύρω στα 300Mb για την Ελλαδα) και open-elevation server με DEM Files.">
						Χρήση Google Maps (εάν όχι χρηση του OSM)
						</span>
						</font>
					</td>
					<td>
						<div class="checkbox">
							<label>
							<input type="checkbox" id="adminprefs_googleapion"> Ενεργοποίηση Google Maps
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<i class="fa fa-key"></i> 
						<span class="tip-top" href="#" title="Το κλειδί για τους χάρτες Google Maps. <br/> 
						Απαιτείται κυρίως για την εύρεση τοποθεσίας και την εύρεση υψομέτρου. ">Google Maps Api Key (Χάρτες)
						</span>
					</td>
					<td>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-key"></i> 
							</span>
							<input type="text" class="form-control input-sm" id="adminprefs_googleapi">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<i class="fa fa-envelope-o"></i> 
						<span class="tip-top" href="#" title="Στους χάρτες OSM χρησιμοποιείται τo Nominatim για την επιστροφή της διεύθυνσης 
						από συντεταγμένες (reverse geocoding).<br/>Σε μεγάλο όγκο επιστροφών απαιτεί την κλήση του url με ένα valid e-mail. ">Nominatim e-mail
						</span>
					</td>
					<td>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-envelope-o"></i> 
							</span>
							<input type="text" class="form-control input-sm" id="adminprefs_osmmail">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<font>
						<i class="fa fa-rocket"></i> 
						<span class="tip-top" href="#" title="Οι χρήστες θα μπορούν να συνδεθούν μέσω του gmail τους. ">
						Να επιτρέπονται οι συνδέσεις με Google ID
						</span>
						</font>
					</td>
					<td>
						<div class="checkbox">
							<label>
							<input type="checkbox" id="adminprefs_googleidon"> Ενεργή σύνδεση Google ID
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<i class="fa fa-rocket"></i> 
						<span class="tip-top" href="#" title="Το Client ID της εφαρμογής από το Google Αuth της Google. ">
						Client ID
						</span>
					</td>
					<td>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-rocket"></i>  
							</span>
							<input type="text" class="form-control input-sm" id="adminprefs_clientid">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<i class="fa fa-unlock"></i> 
						<span class="tip-top" href="#" title="Το Client Secret της εφαρμογής από το Google Αuth της Google. ">
						Client Secret
						</span>
					</td>
					<td>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-unlock"></i> 
							</span>
							<input type="text" class="form-control input-sm" id="adminprefs_clientsecret">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<i class="fa fa-globe"></i> 
						<span class="tip-top" href="#" title="Η διεύθυνση ανακατεύθυνσης μετά τη σύνδεση για την εφαρμογής από το Google Αuth της Google. ">
						Διεύθυνση ανακατεύθυνσης
						</span>
					</td>
					<td>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-globe"></i>  
							</span>
							<input type="text" class="form-control input-sm" id="adminprefs_redirecturl">
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="info">
						<i class="fa fa-eye"></i> Εμφάνιση - Διεπαφή
					</td>
				</tr>
				<tr>
					<td>
						<i class="fa fa-table"></i> 
						<span class="tip-top" href="#" title="Προστίθεται μέγιστος αριθμός μελετών στην εγγραφή για λόγους προστασίας. <br/>
						Το ίδιο κυρίως συμβαίνει και με το χρόνο ισχύος μιας εγγραφής από - έως. Ο χρόνος αυτός μπορεί πχ να είναι ο χρόνος ισχύος του ΚΕΝΑΚ.">
						Μέγιστες μελέτες ανά χρήστη
						</span>
					</td>
					<td>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-building-o"></i> 
							</span>
							<input type="text" class="form-control input-sm" id="adminprefs_meletesmax">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<i class="fa fa-table"></i> 
						<span class="tip-top" href="#" title="Στοιχεία που θα εμφανίζονται σε κάθε πίνακα πχ τοίχοι, δάπεδα κλπ.">
						Στοιχεία για εμφάνιση (πίνακες - pagination)
						</span>
					</td>
					<td>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-table"></i> 
							</span>
							<input type="text" class="form-control input-sm" id="adminprefs_tablenum">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<i class="fa fa-file-code-o"></i> 
						<span class="tip-top" href="#" title="Να εμφανίζεται το μενού xml ώστε να παράγει ο χρήστης xml αρχεία. <br/>
						Μπορεί να απενεργοποιηθεί σε περιόδους συντήρησης ή διόρθωσης των ΤΟΤΕΕ, ΚΕΝΑΚ ή σε αναβαθμίσεις.">
						Εμφάνιση μενού XML
						</span>
					</td>
					<td>
						<div class="checkbox">
							<label>
							<input type="checkbox" id="adminprefs_menuxml"> Μενού XML
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<i class="fa fa-file-text-o"></i> 
						<span class="tip-top" href="#" title="Να εμφανίζεται το μενού τεύχους ώστε να παράγει ο χρήστης το τεύχος μελέτης. <br/>
						Μπορεί να απενεργοποιηθεί σε περιόδους συντήρησης ή διόρθωσης των ΤΟΤΕΕ, ΚΕΝΑΚ ή σε αναβαθμίσεις ή σε περιορισμένες βάσεις δεδομένων.">
						Εμφάνιση μενού τεύχος
						</span>
					</td>
					<td>
						<div class="checkbox">
							<label>
							<input type="checkbox" id="adminprefs_menuteyxos"> Μενού Τεύχος
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<i class="fa fa-file-pdf-o"></i>
						<span class="tip-top" href="#" title="Προσοχή:<br/> H TCPDF απαιτεί αρκετούς υπολογιστικούς πόρους. Για τοπικά συστήματα δεν 
						προκύπτουν ιδιαίτερα προβλήματα αλλά σε περιβάλλον server μπορεί να επιβαρύνει αρκετά τον server και τη διαθέσιμη μνήμη του.">
						Χρήση TcPDF στο τεύχος
						</span>
					</td>
					<td>
						<div class="checkbox">
							<label>
							<input type="checkbox" id="adminprefs_teyxostcpdf"> TCPDF Εκτύπωση
							</label>
						</div>
					</td>
				</tr>
			</table>
			
			<button class="btn btn-default" onclick="save_coreprefs();"><i class="fa fa-save"></i> Αποθήκευση</button>
			
		<script>
		//Στη φόρτωση καλεί την συνάρτηση παρακάτω για να φορτώσει τις τιμές
		get_coreprefs();
		
		//Επιστρέφει τις γενικές ρυθμίσεις
		function get_coreprefs(){
			var link = "includes/functions_admin_libraries.php?get_id=1&table=core_preferences&id=1";
	
			document.getElementById('wait').style.display="inline";
			//AJAX call
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.open("GET",link ,true);
			xmlhttp.send();
			xmlhttp.onreadystatechange=function()  {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				var arr = JSON.parse(xmlhttp.responseText);
					
					if(arr["registration"]!=0){
						document.getElementById("adminprefs_registration").checked = true;
					}else{
						document.getElementById("adminprefs_registration").checked = false;
					}
					
					if(arr["offline"]!=0){
						document.getElementById("adminprefs_offline").checked = true;
					}else{
						document.getElementById("adminprefs_offline").checked = false;
					}
					document.getElementById("adminprefs_offlinetxt").value = arr["offline_text"];
					if(arr["googlemaps"]!=0){
						document.getElementById("adminprefs_googleapion").checked = true;
					}else{
						document.getElementById("adminprefs_googleapion").checked = false;
					}
					document.getElementById("adminprefs_googleapi").value = arr["googleapi"];
					document.getElementById("adminprefs_osmmail").value = arr["osmmail"];
					
					if(arr["googleid_on"]!=0){
						document.getElementById("adminprefs_googleidon").checked = true;
					}else{
						document.getElementById("adminprefs_googleidon").checked = false;
					}
					document.getElementById("adminprefs_clientid").value = arr["Client_ID"];
					document.getElementById("adminprefs_clientsecret").value = arr["Client_Secret"];
					document.getElementById("adminprefs_redirecturl").value = arr["Client_Redirect"];
					
					document.getElementById("adminprefs_meletesmax").value = arr["meletes_max"];
					document.getElementById("adminprefs_tablenum").value = arr["table_nums"];
					if(arr["menu_xml"]!=0){
						document.getElementById("adminprefs_menuxml").checked = true;
					}else{
						document.getElementById("adminprefs_menuxml").checked = false;
					}
					if(arr["menu_teyxos"]!=0){
						document.getElementById("adminprefs_menuteyxos").checked = true;
					}else{
						document.getElementById("adminprefs_menuteyxos").checked = false;
					}
					if(arr["teyxos_tcpdf"]!=0){
						document.getElementById("adminprefs_teyxostcpdf").checked = true;
					}else{
						document.getElementById("adminprefs_teyxostcpdf").checked = false;
					}

				document.getElementById('wait').style.display="none";
			}}
		}
		
		function save_coreprefs(){
			var registration;
			if(document.getElementById("adminprefs_registration").checked==true){
				registration=1;
			}else{
				registration=0;
			}
			
			var offline;
			if(document.getElementById("adminprefs_offline").checked==true){
				offline=1;
			}else{
				offline=0;
			}
			var offline_txt = document.getElementById("adminprefs_offlinetxt").value;
			
			var googleapi_on;
			if(document.getElementById("adminprefs_googleapion").checked==true){
				googleapi_on=1;
			}else{
				googleapi_on=0;
			}
			var googleapi = document.getElementById("adminprefs_googleapi").value;
			var osmmail = document.getElementById("adminprefs_osmmail").value;
			
			var googleid_on;
			if(document.getElementById("adminprefs_googleidon").checked==true){
				googleid_on=1;
			}else{
				googleid_on=0;
			}
			var clientid = document.getElementById("adminprefs_clientid").value;
			var clientsecret = document.getElementById("adminprefs_clientsecret").value;
			var redirecturl = document.getElementById("adminprefs_redirecturl").value;
			
			var meletesmax = document.getElementById("adminprefs_meletesmax").value;
			var tablenum = document.getElementById("adminprefs_tablenum").value;
			
			var menu_xml;
			if(document.getElementById("adminprefs_menuxml").checked==true){
				menu_xml=1;
			}else{
				menu_xml=0;
			}
			var menu_teyxos;
			if(document.getElementById("adminprefs_menuteyxos").checked==true){
				menu_teyxos=1;
			}else{
				menu_teyxos=0;
			}
			var menu_teyxostcpdf;
			if(document.getElementById("adminprefs_teyxostcpdf").checked==true){
				menu_teyxostcpdf=1;
			}else{
				menu_teyxostcpdf=0;
			}
			
			var link = "includes/functions_admin_libraries.php?insert_id=1";
			link += "&table=core_preferences";
			link += "&action=update";
			link += "&id=1";
			link += "&values="+registration+"|"+offline+"|"+offline_txt;
			link += "|"+googleapi_on+"|"+googleapi+"|"+osmmail+"|"+googleid_on+"|"+clientid+"|"+clientsecret+"|"+redirecturl;
			link += "|"+meletesmax+"|"+tablenum+"|"+menu_xml+"|"+menu_teyxos+"|"+menu_teyxostcpdf;
			
			document.getElementById('wait').style.display="inline";
			//AJAX call
			var xmlhttp=new XMLHttpRequest();
			
			xmlhttp.open("GET",link ,true);
			xmlhttp.send();
			
			xmlhttp.onreadystatechange=function()  {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById("coreprefs_info").innerHTML=xmlhttp.responseText;
				document.getElementById('wait').style.display="none";
				get_coreprefs();
			}}
		}
		</script>
		</div>
		<!--tabs-1-->
		
		<div class="tab-pane" id="tabs-2">
		
		
		
			<div id="menudata_table"></div>
			<div id="menudata_info"></div>
			<script>
			get_menudata();
			
		//Εμφάνιση πίνακα
		function get_menudata(page){
		page = typeof page !== 'undefined' ? page : 1;
			document.getElementById('wait').style.display="inline";
			//AJAX call
			var xmlhttp=new XMLHttpRequest();
			
			xmlhttp.open("GET","includes/functions_admin_libraries.php?get_menudata=1&page="+page ,true);
			xmlhttp.send();
			
			xmlhttp.onreadystatechange=function()  {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById("menudata_table").innerHTML=xmlhttp.responseText;
				document.getElementById('wait').style.display="none";
				setUpToolTipHelpers();
			}}
		}
			
		//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
		//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές
		function form_menudata(id,page){
		page = typeof page !== 'undefined' ? page : 1;
		var prefix = "editmenudata_";

			if(id==0){
				document.getElementById(prefix+"name").value = "";
				document.getElementById(prefix+"is_category").checked = false;
				document.getElementById(prefix+"category_id").value = 0;
				document.getElementById(prefix+"order").value = "";
				document.getElementById(prefix+"link").value = "";
				document.getElementById(prefix+"link_type").value = 0;
				document.getElementById(prefix+"icon").SelectedIndex = 0;
				document.getElementById(prefix+"accesslevel").value = 0;
				document.getElementById(prefix+"active").checked = false;
			}
			if(id!=0){
				var link = "includes/functions_admin_libraries.php?get_id=1&table=core_menu&id="+id;
			
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					var arr = JSON.parse(xmlhttp.responseText);
						document.getElementById(prefix+"name").value = arr["name"];
						if(arr["is_category"]!=0){
							document.getElementById(prefix+"is_category").checked = true;
						}else{
							document.getElementById(prefix+"is_category").checked = false;
						}
						
						//document.getElementById(prefix+"category_id").value = arr["category_id"];
						//$(prefix+"category_id").select2().trigger('change');
						$("#"+prefix+"category_id").val(arr["category_id"]).trigger("change");
						
						document.getElementById(prefix+"order").value = arr["order"];
						document.getElementById(prefix+"link").value = arr["link"];
						document.getElementById(prefix+"link_type").value = arr["link_type"];
						
						//document.getElementById(prefix+"icon").value = arr["icon"];
						//$(prefix+"icon").select2().trigger('change');
						$("#"+prefix+"icon").val(arr["icon"]).trigger("change");
						
						document.getElementById(prefix+"accesslevel").value = arr["accesslevel"];
						if(arr["active"]!=0){
							document.getElementById(prefix+"active").checked = true;
						}else{
							document.getElementById(prefix+"active").checked = false;
						}
					document.getElementById('wait').style.display="none";
				}}
				
			}
			
			var button,edit_header;
			if(id!=0){
				button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_menudata('+id+','+page+');">Επεξεργασία</button>';
				edit_header = 'Επεξεργασία';
			}else{
				button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_menudata('+id+','+page+');">Προσθήκη</button>';
				edit_header = 'Προσθήκη';
			}
			document.getElementById("edit_button_menudata").innerHTML = button;
			document.getElementById("edit_header_menudata").innerHTML = edit_header;
			$("#modal_form_menudata").modal("show");
		}


		function formdel_menudata(id,page){
			var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_menudata('+id+','+page+');">Διαγραφή</button>';
			document.getElementById("del_button_menudata").innerHTML = button;
			$("#modal_del_menudata").modal("show");
		}

		//Υποβολή της φόρμας
		//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
		function submit_menudata(id,page){
		var prefix = "editmenudata_";
			var is_category;
				if(document.getElementById(prefix+"is_category").checked==true){
					is_category=1;
				}else{
					is_category=0;
				}
			var category_id = document.getElementById(prefix+"category_id").value;
			var order = document.getElementById(prefix+"order").value;
			var name = document.getElementById(prefix+"name").value;
			var link2 = document.getElementById(prefix+"link").value;
			var link_type = document.getElementById(prefix+"link_type").value;
			var icon = document.getElementById(prefix+"icon").value;
			var accesslevel = document.getElementById(prefix+"accesslevel").value;
			var active;
			if(document.getElementById(prefix+"active").checked==true){
					active=1;
				}else{
					active=0;
				}
			
				if(id==0){
				var action="create";
				}else{
				action="update";
				}
			var link = "includes/functions_admin_libraries.php?insert_id=1";
			link += "&table=core_menu";
			link += "&action="+action;
			link += "&id="+id;
			link += "&values="+is_category+"|"+category_id+"|"+order+"|"+name+"|"+link2+"|";
			link += link_type+"|"+icon+"|"+accesslevel+"|"+active;
			
			document.getElementById('wait').style.display="inline";
			//AJAX call
			var xmlhttp=new XMLHttpRequest();
			
			xmlhttp.open("GET",link ,true);
			xmlhttp.send();
			
			xmlhttp.onreadystatechange=function()  {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById("menudata_info").innerHTML=xmlhttp.responseText;
				document.getElementById('wait').style.display="none";
				get_menudata(page);
			}}
		}

		//Διαγραφή
		function del_menudata(id,page){
			var link = "includes/functions_admin_libraries.php?del_id=1&table=core_menu&id="+id;
			document.getElementById('wait').style.display="inline";
			//AJAX call
			var xmlhttp=new XMLHttpRequest();
			
			xmlhttp.open("GET",link ,true);
			xmlhttp.send();
			
			xmlhttp.onreadystatechange=function()  {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById("menudata_info").innerHTML=xmlhttp.responseText;
				document.getElementById('wait').style.display="none";
				get_menudata(page);
			}}
		}
			
		</script>
						
		<!-- ###################### Κρυφό modal_form_genxriseis για εμφάνιση ###################### -->
		<div id="modal_form_menudata" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h6 id="myModalLabel"><span id="edit_header_menudata"></span></h6>
			</div>

			<div class="modal-body">
			<form action="" method="post" data-toggle="validator">
			<table class="table table-bordered table-condensed">
				<tr class="info" style="text-align: center;">
					<th style="text-align: center;" colspan=2>Στοιχεία ελέγχου μενού</th>
				</tr>
				<tr>
				<tr>
					<td width=50%>
						<div class="form-group has-feedback">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="Όνομα όπως θα εμφανίζεται στο μενού"><i class="fa fa-keyboard-o"></i> Όνομα μενού</span>
							</span>
							<input type="text" class="form-control input-sm"  id="editmenudata_name" data-error="Το όνομα του μενού είναι απαραίτητο" required>
							<span class="glyphicon glyphicon-cog form-control-feedback"></span>
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group has-feedback">
							<label>
							<input type="checkbox" id="editmenudata_active"> Ενεργό μενού (εμφανίζεται στο μενού)</label>
						</div>
						
						<div class="form-group has-feedback">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="Που οδηγεί το μενού.<br/>Για κεντρική κατηγορία: #<br/>Για εσωτερική σελίδα: nav?menu_index (οδηγεί στο menu_index.php)<br/>
								Για εξωτερικό σύνδεσμο: http://σύνδεσμος"><i class="fa fa-link"></i> Σύνδεσμος</span>
							</span>
							<input type="text" class="form-control input-sm"  id="editmenudata_link" data-error="Ο σύνδεσμος είναι απαραίτητος. Εάν είναι κεντρικό προσθέστε #" required>
							<span class="glyphicon glyphicon-cog form-control-feedback"></span>
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group has-feedback">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="Εσωτερικός ή εξωτερικός σύνδεσμος<br/>Ο εξωτερικός ανοίγει σε νέο παράθυρο."><i class="fa fa-anchor"></i> Τύπος συνδέσμου</span>
							</span>
							<select class="form-control input-sm"  id="editmenudata_link_type" data-error="Ο τύπος συνδέσμου είναι απαραίτητη. " required>
								<option value=0>Εσωτερικός</option>
								<option value=1>Εξωτερικός</option>
							</select>
							<span class="glyphicon glyphicon-cog form-control-feedback"></span>
							<div class="help-block with-errors"></div>
						</div>
						
					</td>
					<td width=50%>
						
						
						<div class="form-group has-feedback">
							<label>
							<input type="checkbox" id="editmenudata_is_category"> Είναι κατηγορία/κύριο μενού (πχ αρχική)</label>
						</div>
						
						<div class="form-group has-feedback">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="Κατηγορία που ανήκει"><i class="fa fa-cubes"></i> Ανήκει σε κατηγορία</span>
							</span>
							<select class="form-control select2"  id="editmenudata_category_id" data-error="Η κατηγορία που ανήκει το μενού" required>
								<option value="0">Μητρική</option>
								<?php
								echo create_select_optionsid("core_menu","name");
								?>
							</select>
							<span class="glyphicon glyphicon-cog form-control-feedback"></span>
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group has-feedback">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="Σχετική σειρά. πχ εάν το στοιχείο ανήκει σε άλλο μενού πρόκειται για την εσωτερική σειρά"><i class="fa fa-sort-numeric-desc"></i> Σειρά εμφάνισης</span>
							</span>
							<input type="text" class="form-control input-sm"  id="editmenudata_order" data-error="Η σειρά είναι απαραίτητη για το μενού" required>
							<span class="glyphicon glyphicon-cog form-control-feedback"></span>
							<div class="help-block with-errors"></div>
						</div>
						
						<div class="form-group has-feedback">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="Ποιός βλέπει το μενού (δικαιώματα και επιλογές μελέτης)"><i class="fa fa-user"></i> Επίπεδο πρόσβασης</span>
							</span>
							<select class="form-control input-sm"  id="editmenudata_accesslevel" data-error="Το επίπεδο πρόσβασης είναι απαραίτητο" required>
								<option value=0>Μη συνδεδεμένος</option>
								<option value=1>Χρήστης</option>
								<option value=2>Διαχειριστής</option>
								<option value=3>Επιλεγμένη μελέτη</option>
							</select>
							<span class="glyphicon glyphicon-cog form-control-feedback"></span>
							<div class="help-block with-errors"></div>
						</div>
			<style>
				select{
				font-family: 'FontAwesome', 'sans-serif';
				}
			</style>
						<div class="form-group has-feedback">
							<span class="input-group-addon">
								<span class="tip-top" href="#" title="Εικονίδιο fontawasome που θα χρησιμοποποιηθεί στο μενού"><i class="fa fa-sun"></i> Εικονίδιο συνδέσμου</span>
							</span>
							<select class="form-control select2" id="editmenudata_icon" data-error="Το εικονίδιο δεν είναι απαραίτητο αλλά καλό είναι να προστεθεί" required>
								<option value='fa fa-500px'>fa fa-500px</option>
								<option value='fa fa-address-book'>fa fa-address-book</option>
								<option value='fa fa-address-book-o'>fa fa-address-book-o</option>
								<option value='fa fa-address-card'>fa fa-address-card</option>
								<option value='fa fa-address-card-o'>fa fa-address-card-o</option>
								<option value='fa fa-adjust'>fa fa-adjust</option>
								<option value='fa fa-adn'>fa fa-adn</option>
								<option value='fa fa-align-center'>fa fa-align-center</option>
								<option value='fa fa-align-justify'>fa fa-align-justify</option>
								<option value='fa fa-align-left'>fa fa-align-left</option>
								<option value='fa fa-align-right'>fa fa-align-right</option>
								<option value='fa fa-amazon'>fa fa-amazon</option>
								<option value='fa fa-ambulance'>fa fa-ambulance</option>
								<option value='fa fa-american-sign-language-interpreting'>fa fa-american-sign-language-interpreting</option>
								<option value='fa fa-anchor'>fa fa-anchor</option>
								<option value='fa fa-android'>fa fa-android</option>
								<option value='fa fa-angellist'>fa fa-angellist</option>
								<option value='fa fa-angle-double-down'>fa fa-angle-double-down</option>
								<option value='fa fa-angle-double-left'>fa fa-angle-double-left</option>
								<option value='fa fa-angle-double-right'>fa fa-angle-double-right</option>
								<option value='fa fa-angle-double-up'>fa fa-angle-double-up</option>
								<option value='fa fa-angle-down'>fa fa-angle-down</option>
								<option value='fa fa-angle-left'>fa fa-angle-left</option>
								<option value='fa fa-angle-right'>fa fa-angle-right</option>
								<option value='fa fa-angle-up'>fa fa-angle-up</option>
								<option value='fa fa-apple'>fa fa-apple</option>
								<option value='fa fa-archive'>fa fa-archive</option>
								<option value='fa fa-area-chart'>fa fa-area-chart</option>
								<option value='fa fa-arrow-circle-down'>fa fa-arrow-circle-down</option>
								<option value='fa fa-arrow-circle-left'>fa fa-arrow-circle-left</option>
								<option value='fa fa-arrow-circle-o-down'>fa fa-arrow-circle-o-down</option>
								<option value='fa fa-arrow-circle-o-left'>fa fa-arrow-circle-o-left</option>
								<option value='fa fa-arrow-circle-o-right'>fa fa-arrow-circle-o-right</option>
								<option value='fa fa-arrow-circle-o-up'>fa fa-arrow-circle-o-up</option>
								<option value='fa fa-arrow-circle-right'>fa fa-arrow-circle-right</option>
								<option value='fa fa-arrow-circle-up'>fa fa-arrow-circle-up</option>
								<option value='fa fa-arrow-down'>fa fa-arrow-down</option>
								<option value='fa fa-arrow-left'>fa fa-arrow-left</option>
								<option value='fa fa-arrow-right'>fa fa-arrow-right</option>
								<option value='fa fa-arrow-up'>fa fa-arrow-up</option>
								<option value='fa fa-arrows'>fa fa-arrows</option>
								<option value='fa fa-arrows-alt'>fa fa-arrows-alt</option>
								<option value='fa fa-arrows-h'>fa fa-arrows-h</option>
								<option value='fa fa-arrows-v'>fa fa-arrows-v</option>
								<option value='fa fa-asl-interpreting'>fa fa-asl-interpreting</option>
								<option value='fa fa-assistive-listening-systems'>fa fa-assistive-listening-systems</option>
								<option value='fa fa-asterisk'>fa fa-asterisk</option>
								<option value='fa fa-at'>fa fa-at</option>
								<option value='fa fa-audio-description'>fa fa-audio-description</option>
								<option value='fa fa-automobile'>fa fa-automobile</option>
								<option value='fa fa-backward'>fa fa-backward</option>
								<option value='fa fa-balance-scale'>fa fa-balance-scale</option>
								<option value='fa fa-ban'>fa fa-ban</option>
								<option value='fa fa-bandcamp'>fa fa-bandcamp</option>
								<option value='fa fa-bank'>fa fa-bank</option>
								<option value='fa fa-bar-chart'>fa fa-bar-chart</option>
								<option value='fa fa-bar-chart-o'>fa fa-bar-chart-o</option>
								<option value='fa fa-barcode'>fa fa-barcode</option>
								<option value='fa fa-bars'>fa fa-bars</option>
								<option value='fa fa-bath'>fa fa-bath</option>
								<option value='fa fa-bathtub'>fa fa-bathtub</option>
								<option value='fa fa-battery'>fa fa-battery</option>
								<option value='fa fa-battery-0'>fa fa-battery-0</option>
								<option value='fa fa-battery-1'>fa fa-battery-1</option>
								<option value='fa fa-battery-2'>fa fa-battery-2</option>
								<option value='fa fa-battery-3'>fa fa-battery-3</option>
								<option value='fa fa-battery-4'>fa fa-battery-4</option>
								<option value='fa fa-battery-empty'>fa fa-battery-empty</option>
								<option value='fa fa-battery-full'>fa fa-battery-full</option>
								<option value='fa fa-battery-half'>fa fa-battery-half</option>
								<option value='fa fa-battery-quarter'>fa fa-battery-quarter</option>
								<option value='fa fa-battery-three-quarters'>fa fa-battery-three-quarters</option>
								<option value='fa fa-bed'>fa fa-bed</option>
								<option value='fa fa-beer'>fa fa-beer</option>
								<option value='fa fa-behance'>fa fa-behance</option>
								<option value='fa fa-behance-square'>fa fa-behance-square</option>
								<option value='fa fa-bell'>fa fa-bell</option>
								<option value='fa fa-bell-o'>fa fa-bell-o</option>
								<option value='fa fa-bell-slash'>fa fa-bell-slash</option>
								<option value='fa fa-bell-slash-o'>fa fa-bell-slash-o</option>
								<option value='fa fa-bicycle'>fa fa-bicycle</option>
								<option value='fa fa-binoculars'>fa fa-binoculars</option>
								<option value='fa fa-birthday-cake'>fa fa-birthday-cake</option>
								<option value='fa fa-bitbucket'>fa fa-bitbucket</option>
								<option value='fa fa-bitbucket-square'>fa fa-bitbucket-square</option>
								<option value='fa fa-bitcoin'>fa fa-bitcoin</option>
								<option value='fa fa-black-tie'>fa fa-black-tie</option>
								<option value='fa fa-blind'>fa fa-blind</option>
								<option value='fa fa-bluetooth'>fa fa-bluetooth</option>
								<option value='fa fa-bluetooth-b'>fa fa-bluetooth-b</option>
								<option value='fa fa-bold'>fa fa-bold</option>
								<option value='fa fa-bolt'>fa fa-bolt</option>
								<option value='fa fa-bomb'>fa fa-bomb</option>
								<option value='fa fa-book'>fa fa-book</option>
								<option value='fa fa-bookmark'>fa fa-bookmark</option>
								<option value='fa fa-bookmark-o'>fa fa-bookmark-o</option>
								<option value='fa fa-braille'>fa fa-braille</option>
								<option value='fa fa-briefcase'>fa fa-briefcase</option>
								<option value='fa fa-btc'>fa fa-btc</option>
								<option value='fa fa-bug'>fa fa-bug</option>
								<option value='fa fa-building'>fa fa-building</option>
								<option value='fa fa-building-o'>fa fa-building-o</option>
								<option value='fa fa-bullhorn'>fa fa-bullhorn</option>
								<option value='fa fa-bullseye'>fa fa-bullseye</option>
								<option value='fa fa-bus'>fa fa-bus</option>
								<option value='fa fa-buysellads'>fa fa-buysellads</option>
								<option value='fa fa-cab'>fa fa-cab</option>
								<option value='fa fa-calculator'>fa fa-calculator</option>
								<option value='fa fa-calendar'>fa fa-calendar</option>
								<option value='fa fa-calendar-check-o'>fa fa-calendar-check-o</option>
								<option value='fa fa-calendar-minus-o'>fa fa-calendar-minus-o</option>
								<option value='fa fa-calendar-o'>fa fa-calendar-o</option>
								<option value='fa fa-calendar-plus-o'>fa fa-calendar-plus-o</option>
								<option value='fa fa-calendar-times-o'>fa fa-calendar-times-o</option>
								<option value='fa fa-camera'>fa fa-camera</option>
								<option value='fa fa-camera-retro'>fa fa-camera-retro</option>
								<option value='fa fa-car'>fa fa-car</option>
								<option value='fa fa-caret-down'>fa fa-caret-down</option>
								<option value='fa fa-caret-left'>fa fa-caret-left</option>
								<option value='fa fa-caret-right'>fa fa-caret-right</option>
								<option value='fa fa-caret-square-o-down'>fa fa-caret-square-o-down</option>
								<option value='fa fa-caret-square-o-left'>fa fa-caret-square-o-left</option>
								<option value='fa fa-caret-square-o-right'>fa fa-caret-square-o-right</option>
								<option value='fa fa-caret-square-o-up'>fa fa-caret-square-o-up</option>
								<option value='fa fa-caret-up'>fa fa-caret-up</option>
								<option value='fa fa-cart-arrow-down'>fa fa-cart-arrow-down</option>
								<option value='fa fa-cart-plus'>fa fa-cart-plus</option>
								<option value='fa fa-cc'>fa fa-cc</option>
								<option value='fa fa-cc-amex'>fa fa-cc-amex</option>
								<option value='fa fa-cc-diners-club'>fa fa-cc-diners-club</option>
								<option value='fa fa-cc-discover'>fa fa-cc-discover</option>
								<option value='fa fa-cc-jcb'>fa fa-cc-jcb</option>
								<option value='fa fa-cc-mastercard'>fa fa-cc-mastercard</option>
								<option value='fa fa-cc-paypal'>fa fa-cc-paypal</option>
								<option value='fa fa-cc-stripe'>fa fa-cc-stripe</option>
								<option value='fa fa-cc-visa'>fa fa-cc-visa</option>
								<option value='fa fa-certificate'>fa fa-certificate</option>
								<option value='fa fa-chain'>fa fa-chain</option>
								<option value='fa fa-chain-broken'>fa fa-chain-broken</option>
								<option value='fa fa-check'>fa fa-check</option>
								<option value='fa fa-check-circle'>fa fa-check-circle</option>
								<option value='fa fa-check-circle-o'>fa fa-check-circle-o</option>
								<option value='fa fa-check-square'>fa fa-check-square</option>
								<option value='fa fa-check-square-o'>fa fa-check-square-o</option>
								<option value='fa fa-chevron-circle-down'>fa fa-chevron-circle-down</option>
								<option value='fa fa-chevron-circle-left'>fa fa-chevron-circle-left</option>
								<option value='fa fa-chevron-circle-right'>fa fa-chevron-circle-right</option>
								<option value='fa fa-chevron-circle-up'>fa fa-chevron-circle-up</option>
								<option value='fa fa-chevron-down'>fa fa-chevron-down</option>
								<option value='fa fa-chevron-left'>fa fa-chevron-left</option>
								<option value='fa fa-chevron-right'>fa fa-chevron-right</option>
								<option value='fa fa-chevron-up'>fa fa-chevron-up</option>
								<option value='fa fa-child'>fa fa-child</option>
								<option value='fa fa-chrome'>fa fa-chrome</option>
								<option value='fa fa-circle'>fa fa-circle</option>
								<option value='fa fa-circle-o'>fa fa-circle-o</option>
								<option value='fa fa-circle-o-notch'>fa fa-circle-o-notch</option>
								<option value='fa fa-circle-thin'>fa fa-circle-thin</option>
								<option value='fa fa-clipboard'>fa fa-clipboard</option>
								<option value='fa fa-clock-o'>fa fa-clock-o</option>
								<option value='fa fa-clone'>fa fa-clone</option>
								<option value='fa fa-close'>fa fa-close</option>
								<option value='fa fa-cloud'>fa fa-cloud</option>
								<option value='fa fa-cloud-download'>fa fa-cloud-download</option>
								<option value='fa fa-cloud-upload'>fa fa-cloud-upload</option>
								<option value='fa fa-cny'>fa fa-cny</option>
								<option value='fa fa-code'>fa fa-code</option>
								<option value='fa fa-code-fork'>fa fa-code-fork</option>
								<option value='fa fa-codepen'>fa fa-codepen</option>
								<option value='fa fa-codiepie'>fa fa-codiepie</option>
								<option value='fa fa-coffee'>fa fa-coffee</option>
								<option value='fa fa-cog'>fa fa-cog</option>
								<option value='fa fa-cogs'>fa fa-cogs</option>
								<option value='fa fa-columns'>fa fa-columns</option>
								<option value='fa fa-comment'>fa fa-comment</option>
								<option value='fa fa-comment-o'>fa fa-comment-o</option>
								<option value='fa fa-commenting'>fa fa-commenting</option>
								<option value='fa fa-commenting-o'>fa fa-commenting-o</option>
								<option value='fa fa-comments'>fa fa-comments</option>
								<option value='fa fa-comments-o'>fa fa-comments-o</option>
								<option value='fa fa-compass'>fa fa-compass</option>
								<option value='fa fa-compress'>fa fa-compress</option>
								<option value='fa fa-connectdevelop'>fa fa-connectdevelop</option>
								<option value='fa fa-contao'>fa fa-contao</option>
								<option value='fa fa-copy'>fa fa-copy</option>
								<option value='fa fa-copyright'>fa fa-copyright</option>
								<option value='fa fa-creative-commons'>fa fa-creative-commons</option>
								<option value='fa fa-credit-card'>fa fa-credit-card</option>
								<option value='fa fa-credit-card-alt'>fa fa-credit-card-alt</option>
								<option value='fa fa-crop'>fa fa-crop</option>
								<option value='fa fa-crosshairs'>fa fa-crosshairs</option>
								<option value='fa fa-css3'>fa fa-css3</option>
								<option value='fa fa-cube'>fa fa-cube</option>
								<option value='fa fa-cubes'>fa fa-cubes</option>
								<option value='fa fa-cut'>fa fa-cut</option>
								<option value='fa fa-cutlery'>fa fa-cutlery</option>
								<option value='fa fa-dashboard'>fa fa-dashboard</option>
								<option value='fa fa-dashcube'>fa fa-dashcube</option>
								<option value='fa fa-database'>fa fa-database</option>
								<option value='fa fa-deaf'>fa fa-deaf</option>
								<option value='fa fa-deafness'>fa fa-deafness</option>
								<option value='fa fa-dedent'>fa fa-dedent</option>
								<option value='fa fa-delicious'>fa fa-delicious</option>
								<option value='fa fa-desktop'>fa fa-desktop</option>
								<option value='fa fa-deviantart'>fa fa-deviantart</option>
								<option value='fa fa-diamond'>fa fa-diamond</option>
								<option value='fa fa-digg'>fa fa-digg</option>
								<option value='fa fa-dollar'>fa fa-dollar</option>
								<option value='fa fa-dot-circle-o'>fa fa-dot-circle-o</option>
								<option value='fa fa-download'>fa fa-download</option>
								<option value='fa fa-dribbble'>fa fa-dribbble</option>
								<option value='fa fa-drivers-license'>fa fa-drivers-license</option>
								<option value='fa fa-drivers-license-o'>fa fa-drivers-license-o</option>
								<option value='fa fa-dropbox'>fa fa-dropbox</option>
								<option value='fa fa-drupal'>fa fa-drupal</option>
								<option value='fa fa-edge'>fa fa-edge</option>
								<option value='fa fa-edit'>fa fa-edit</option>
								<option value='fa fa-eercast'>fa fa-eercast</option>
								<option value='fa fa-eject'>fa fa-eject</option>
								<option value='fa fa-ellipsis-h'>fa fa-ellipsis-h</option>
								<option value='fa fa-ellipsis-v'>fa fa-ellipsis-v</option>
								<option value='fa fa-empire'>fa fa-empire</option>
								<option value='fa fa-envelope'>fa fa-envelope</option>
								<option value='fa fa-envelope-o'>fa fa-envelope-o</option>
								<option value='fa fa-envelope-open'>fa fa-envelope-open</option>
								<option value='fa fa-envelope-open-o'>fa fa-envelope-open-o</option>
								<option value='fa fa-envelope-square'>fa fa-envelope-square</option>
								<option value='fa fa-envira'>fa fa-envira</option>
								<option value='fa fa-eraser'>fa fa-eraser</option>
								<option value='fa fa-etsy'>fa fa-etsy</option>
								<option value='fa fa-eur'>fa fa-eur</option>
								<option value='fa fa-euro'>fa fa-euro</option>
								<option value='fa fa-exchange'>fa fa-exchange</option>
								<option value='fa fa-exclamation'>fa fa-exclamation</option>
								<option value='fa fa-exclamation-circle'>fa fa-exclamation-circle</option>
								<option value='fa fa-exclamation-triangle'>fa fa-exclamation-triangle</option>
								<option value='fa fa-expand'>fa fa-expand</option>
								<option value='fa fa-expeditedssl'>fa fa-expeditedssl</option>
								<option value='fa fa-external-link'>fa fa-external-link</option>
								<option value='fa fa-external-link-square'>fa fa-external-link-square</option>
								<option value='fa fa-eye'>fa fa-eye</option>
								<option value='fa fa-eye-slash'>fa fa-eye-slash</option>
								<option value='fa fa-eyedropper'>fa fa-eyedropper</option>
								<option value='fa fa-fa fa'>fa fa-fa fa</option>
								<option value='fa fa-fa facebook'>fa fa-fa facebook</option>
								<option value='fa fa-fa facebook-f'>fa fa-fa facebook-f</option>
								<option value='fa fa-fa facebook-official'>fa fa-fa facebook-official</option>
								<option value='fa fa-fa facebook-square'>fa fa-fa facebook-square</option>
								<option value='fa fa-fa fast-backward'>fa fa-fa fast-backward</option>
								<option value='fa fa-fa fast-forward'>fa fa-fa fast-forward</option>
								<option value='fa fa-fa fax'>fa fa-fa fax</option>
								<option value='fa fa-feed'>fa fa-feed</option>
								<option value='fa fa-female'>fa fa-female</option>
								<option value='fa fa-fighter-jet'>fa fa-fighter-jet</option>
								<option value='fa fa-file'>fa fa-file</option>
								<option value='fa fa-file-archive-o'>fa fa-file-archive-o</option>
								<option value='fa fa-file-audio-o'>fa fa-file-audio-o</option>
								<option value='fa fa-file-code-o'>fa fa-file-code-o</option>
								<option value='fa fa-file-excel-o'>fa fa-file-excel-o</option>
								<option value='fa fa-file-image-o'>fa fa-file-image-o</option>
								<option value='fa fa-file-movie-o'>fa fa-file-movie-o</option>
								<option value='fa fa-file-o'>fa fa-file-o</option>
								<option value='fa fa-file-pdf-o'>fa fa-file-pdf-o</option>
								<option value='fa fa-file-photo-o'>fa fa-file-photo-o</option>
								<option value='fa fa-file-picture-o'>fa fa-file-picture-o</option>
								<option value='fa fa-file-powerpoint-o'>fa fa-file-powerpoint-o</option>
								<option value='fa fa-file-sound-o'>fa fa-file-sound-o</option>
								<option value='fa fa-file-text'>fa fa-file-text</option>
								<option value='fa fa-file-text-o'>fa fa-file-text-o</option>
								<option value='fa fa-file-video-o'>fa fa-file-video-o</option>
								<option value='fa fa-file-word-o'>fa fa-file-word-o</option>
								<option value='fa fa-file-zip-o'>fa fa-file-zip-o</option>
								<option value='fa fa-files-o'>fa fa-files-o</option>
								<option value='fa fa-film'>fa fa-film</option>
								<option value='fa fa-filter'>fa fa-filter</option>
								<option value='fa fa-fire'>fa fa-fire</option>
								<option value='fa fa-fire-extinguisher'>fa fa-fire-extinguisher</option>
								<option value='fa fa-firefox'>fa fa-firefox</option>
								<option value='fa fa-first-order'>fa fa-first-order</option>
								<option value='fa fa-flag'>fa fa-flag</option>
								<option value='fa fa-flag-checkered'>fa fa-flag-checkered</option>
								<option value='fa fa-flag-o'>fa fa-flag-o</option>
								<option value='fa fa-flash'>fa fa-flash</option>
								<option value='fa fa-flask'>fa fa-flask</option>
								<option value='fa fa-flickr'>fa fa-flickr</option>
								<option value='fa fa-floppy-o'>fa fa-floppy-o</option>
								<option value='fa fa-folder'>fa fa-folder</option>
								<option value='fa fa-folder-o'>fa fa-folder-o</option>
								<option value='fa fa-folder-open'>fa fa-folder-open</option>
								<option value='fa fa-folder-open-o'>fa fa-folder-open-o</option>
								<option value='fa fa-font'>fa fa-font</option>
								<option value='fa fa-font-awesome'>fa fa-font-awesome</option>
								<option value='fa fa-fonticons'>fa fa-fonticons</option>
								<option value='fa fa-fort-awesome'>fa fa-fort-awesome</option>
								<option value='fa fa-forumbee'>fa fa-forumbee</option>
								<option value='fa fa-forward'>fa fa-forward</option>
								<option value='fa fa-foursquare'>fa fa-foursquare</option>
								<option value='fa fa-free-code-camp'>fa fa-free-code-camp</option>
								<option value='fa fa-frown-o'>fa fa-frown-o</option>
								<option value='fa fa-futbol-o'>fa fa-futbol-o</option>
								<option value='fa fa-gamepad'>fa fa-gamepad</option>
								<option value='fa fa-gavel'>fa fa-gavel</option>
								<option value='fa fa-gbp'>fa fa-gbp</option>
								<option value='fa fa-ge'>fa fa-ge</option>
								<option value='fa fa-gear'>fa fa-gear</option>
								<option value='fa fa-gears'>fa fa-gears</option>
								<option value='fa fa-genderless'>fa fa-genderless</option>
								<option value='fa fa-get-pocket'>fa fa-get-pocket</option>
								<option value='fa fa-gg'>fa fa-gg</option>
								<option value='fa fa-gg-circle'>fa fa-gg-circle</option>
								<option value='fa fa-gift'>fa fa-gift</option>
								<option value='fa fa-git'>fa fa-git</option>
								<option value='fa fa-git-square'>fa fa-git-square</option>
								<option value='fa fa-github'>fa fa-github</option>
								<option value='fa fa-github-alt'>fa fa-github-alt</option>
								<option value='fa fa-github-square'>fa fa-github-square</option>
								<option value='fa fa-gitlab'>fa fa-gitlab</option>
								<option value='fa fa-gittip'>fa fa-gittip</option>
								<option value='fa fa-glass'>fa fa-glass</option>
								<option value='fa fa-glide'>fa fa-glide</option>
								<option value='fa fa-glide-g'>fa fa-glide-g</option>
								<option value='fa fa-globe'>fa fa-globe</option>
								<option value='fa fa-google'>fa fa-google</option>
								<option value='fa fa-google-plus'>fa fa-google-plus</option>
								<option value='fa fa-google-plus-circle'>fa fa-google-plus-circle</option>
								<option value='fa fa-google-plus-official'>fa fa-google-plus-official</option>
								<option value='fa fa-google-plus-square'>fa fa-google-plus-square</option>
								<option value='fa fa-google-wallet'>fa fa-google-wallet</option>
								<option value='fa fa-graduation-cap'>fa fa-graduation-cap</option>
								<option value='fa fa-gratipay'>fa fa-gratipay</option>
								<option value='fa fa-grav'>fa fa-grav</option>
								<option value='fa fa-group'>fa fa-group</option>
								<option value='fa fa-h-square'>fa fa-h-square</option>
								<option value='fa fa-hacker-news'>fa fa-hacker-news</option>
								<option value='fa fa-hand-grab-o'>fa fa-hand-grab-o</option>
								<option value='fa fa-hand-lizard-o'>fa fa-hand-lizard-o</option>
								<option value='fa fa-hand-o-down'>fa fa-hand-o-down</option>
								<option value='fa fa-hand-o-left'>fa fa-hand-o-left</option>
								<option value='fa fa-hand-o-right'>fa fa-hand-o-right</option>
								<option value='fa fa-hand-o-up'>fa fa-hand-o-up</option>
								<option value='fa fa-hand-paper-o'>fa fa-hand-paper-o</option>
								<option value='fa fa-hand-peace-o'>fa fa-hand-peace-o</option>
								<option value='fa fa-hand-pointer-o'>fa fa-hand-pointer-o</option>
								<option value='fa fa-hand-rock-o'>fa fa-hand-rock-o</option>
								<option value='fa fa-hand-scissors-o'>fa fa-hand-scissors-o</option>
								<option value='fa fa-hand-spock-o'>fa fa-hand-spock-o</option>
								<option value='fa fa-hand-stop-o'>fa fa-hand-stop-o</option>
								<option value='fa fa-handshake-o'>fa fa-handshake-o</option>
								<option value='fa fa-hard-of-hearing'>fa fa-hard-of-hearing</option>
								<option value='fa fa-hashtag'>fa fa-hashtag</option>
								<option value='fa fa-hdd-o'>fa fa-hdd-o</option>
								<option value='fa fa-header'>fa fa-header</option>
								<option value='fa fa-headphones'>fa fa-headphones</option>
								<option value='fa fa-heart'>fa fa-heart</option>
								<option value='fa fa-heart-o'>fa fa-heart-o</option>
								<option value='fa fa-heartbeat'>fa fa-heartbeat</option>
								<option value='fa fa-history'>fa fa-history</option>
								<option value='fa fa-home'>fa fa-home</option>
								<option value='fa fa-hospital-o'>fa fa-hospital-o</option>
								<option value='fa fa-hotel'>fa fa-hotel</option>
								<option value='fa fa-hourglass'>fa fa-hourglass</option>
								<option value='fa fa-hourglass-1'>fa fa-hourglass-1</option>
								<option value='fa fa-hourglass-2'>fa fa-hourglass-2</option>
								<option value='fa fa-hourglass-3'>fa fa-hourglass-3</option>
								<option value='fa fa-hourglass-end'>fa fa-hourglass-end</option>
								<option value='fa fa-hourglass-half'>fa fa-hourglass-half</option>
								<option value='fa fa-hourglass-o'>fa fa-hourglass-o</option>
								<option value='fa fa-hourglass-start'>fa fa-hourglass-start</option>
								<option value='fa fa-houzz'>fa fa-houzz</option>
								<option value='fa fa-html5'>fa fa-html5</option>
								<option value='fa fa-i-cursor'>fa fa-i-cursor</option>
								<option value='fa fa-id-badge'>fa fa-id-badge</option>
								<option value='fa fa-id-card'>fa fa-id-card</option>
								<option value='fa fa-id-card-o'>fa fa-id-card-o</option>
								<option value='fa fa-ils'>fa fa-ils</option>
								<option value='fa fa-image'>fa fa-image</option>
								<option value='fa fa-imdb'>fa fa-imdb</option>
								<option value='fa fa-inbox'>fa fa-inbox</option>
								<option value='fa fa-indent'>fa fa-indent</option>
								<option value='fa fa-industry'>fa fa-industry</option>
								<option value='fa fa-info'>fa fa-info</option>
								<option value='fa fa-info-circle'>fa fa-info-circle</option>
								<option value='fa fa-inr'>fa fa-inr</option>
								<option value='fa fa-instagram'>fa fa-instagram</option>
								<option value='fa fa-institution'>fa fa-institution</option>
								<option value='fa fa-internet-explorer'>fa fa-internet-explorer</option>
								<option value='fa fa-intersex'>fa fa-intersex</option>
								<option value='fa fa-ioxhost'>fa fa-ioxhost</option>
								<option value='fa fa-italic'>fa fa-italic</option>
								<option value='fa fa-joomla'>fa fa-joomla</option>
								<option value='fa fa-jpy'>fa fa-jpy</option>
								<option value='fa fa-jsfiddle'>fa fa-jsfiddle</option>
								<option value='fa fa-key'>fa fa-key</option>
								<option value='fa fa-keyboard-o'>fa fa-keyboard-o</option>
								<option value='fa fa-krw'>fa fa-krw</option>
								<option value='fa fa-language'>fa fa-language</option>
								<option value='fa fa-laptop'>fa fa-laptop</option>
								<option value='fa fa-lastfm'>fa fa-lastfm</option>
								<option value='fa fa-lastfm-square'>fa fa-lastfm-square</option>
								<option value='fa fa-leaf'>fa fa-leaf</option>
								<option value='fa fa-leanpub'>fa fa-leanpub</option>
								<option value='fa fa-legal'>fa fa-legal</option>
								<option value='fa fa-lemon-o'>fa fa-lemon-o</option>
								<option value='fa fa-level-down'>fa fa-level-down</option>
								<option value='fa fa-level-up'>fa fa-level-up</option>
								<option value='fa fa-life-bouy'>fa fa-life-bouy</option>
								<option value='fa fa-life-buoy'>fa fa-life-buoy</option>
								<option value='fa fa-life-ring'>fa fa-life-ring</option>
								<option value='fa fa-life-saver'>fa fa-life-saver</option>
								<option value='fa fa-lightbulb-o'>fa fa-lightbulb-o</option>
								<option value='fa fa-line-chart'>fa fa-line-chart</option>
								<option value='fa fa-link'>fa fa-link</option>
								<option value='fa fa-linkedin'>fa fa-linkedin</option>
								<option value='fa fa-linkedin-square'>fa fa-linkedin-square</option>
								<option value='fa fa-linode'>fa fa-linode</option>
								<option value='fa fa-linux'>fa fa-linux</option>
								<option value='fa fa-list'>fa fa-list</option>
								<option value='fa fa-list-alt'>fa fa-list-alt</option>
								<option value='fa fa-list-ol'>fa fa-list-ol</option>
								<option value='fa fa-list-ul'>fa fa-list-ul</option>
								<option value='fa fa-location-arrow'>fa fa-location-arrow</option>
								<option value='fa fa-lock'>fa fa-lock</option>
								<option value='fa fa-long-arrow-down'>fa fa-long-arrow-down</option>
								<option value='fa fa-long-arrow-left'>fa fa-long-arrow-left</option>
								<option value='fa fa-long-arrow-right'>fa fa-long-arrow-right</option>
								<option value='fa fa-long-arrow-up'>fa fa-long-arrow-up</option>
								<option value='fa fa-low-vision'>fa fa-low-vision</option>
								<option value='fa fa-magic'>fa fa-magic</option>
								<option value='fa fa-magnet'>fa fa-magnet</option>
								<option value='fa fa-mail-forward'>fa fa-mail-forward</option>
								<option value='fa fa-mail-reply'>fa fa-mail-reply</option>
								<option value='fa fa-mail-reply-all'>fa fa-mail-reply-all</option>
								<option value='fa fa-male'>fa fa-male</option>
								<option value='fa fa-map'>fa fa-map</option>
								<option value='fa fa-map-marker'>fa fa-map-marker</option>
								<option value='fa fa-map-o'>fa fa-map-o</option>
								<option value='fa fa-map-pin'>fa fa-map-pin</option>
								<option value='fa fa-map-signs'>fa fa-map-signs</option>
								<option value='fa fa-mars'>fa fa-mars</option>
								<option value='fa fa-mars-double'>fa fa-mars-double</option>
								<option value='fa fa-mars-stroke'>fa fa-mars-stroke</option>
								<option value='fa fa-mars-stroke-h'>fa fa-mars-stroke-h</option>
								<option value='fa fa-mars-stroke-v'>fa fa-mars-stroke-v</option>
								<option value='fa fa-maxcdn'>fa fa-maxcdn</option>
								<option value='fa fa-meanpath'>fa fa-meanpath</option>
								<option value='fa fa-medium'>fa fa-medium</option>
								<option value='fa fa-medkit'>fa fa-medkit</option>
								<option value='fa fa-meetup'>fa fa-meetup</option>
								<option value='fa fa-meh-o'>fa fa-meh-o</option>
								<option value='fa fa-mercury'>fa fa-mercury</option>
								<option value='fa fa-microchip'>fa fa-microchip</option>
								<option value='fa fa-microphone'>fa fa-microphone</option>
								<option value='fa fa-microphone-slash'>fa fa-microphone-slash</option>
								<option value='fa fa-minus'>fa fa-minus</option>
								<option value='fa fa-minus-circle'>fa fa-minus-circle</option>
								<option value='fa fa-minus-square'>fa fa-minus-square</option>
								<option value='fa fa-minus-square-o'>fa fa-minus-square-o</option>
								<option value='fa fa-mixcloud'>fa fa-mixcloud</option>
								<option value='fa fa-mobile'>fa fa-mobile</option>
								<option value='fa fa-mobile-phone'>fa fa-mobile-phone</option>
								<option value='fa fa-modx'>fa fa-modx</option>
								<option value='fa fa-money'>fa fa-money</option>
								<option value='fa fa-moon-o'>fa fa-moon-o</option>
								<option value='fa fa-mortar-board'>fa fa-mortar-board</option>
								<option value='fa fa-motorcycle'>fa fa-motorcycle</option>
								<option value='fa fa-mouse-pointer'>fa fa-mouse-pointer</option>
								<option value='fa fa-music'>fa fa-music</option>
								<option value='fa fa-navicon'>fa fa-navicon</option>
								<option value='fa fa-neuter'>fa fa-neuter</option>
								<option value='fa fa-newspaper-o'>fa fa-newspaper-o</option>
								<option value='fa fa-object-group'>fa fa-object-group</option>
								<option value='fa fa-object-ungroup'>fa fa-object-ungroup</option>
								<option value='fa fa-odnoklassniki'>fa fa-odnoklassniki</option>
								<option value='fa fa-odnoklassniki-square'>fa fa-odnoklassniki-square</option>
								<option value='fa fa-opencart'>fa fa-opencart</option>
								<option value='fa fa-openid'>fa fa-openid</option>
								<option value='fa fa-opera'>fa fa-opera</option>
								<option value='fa fa-optin-monster'>fa fa-optin-monster</option>
								<option value='fa fa-outdent'>fa fa-outdent</option>
								<option value='fa fa-pagelines'>fa fa-pagelines</option>
								<option value='fa fa-paint-brush'>fa fa-paint-brush</option>
								<option value='fa fa-paper-plane'>fa fa-paper-plane</option>
								<option value='fa fa-paper-plane-o'>fa fa-paper-plane-o</option>
								<option value='fa fa-paperclip'>fa fa-paperclip</option>
								<option value='fa fa-paragraph'>fa fa-paragraph</option>
								<option value='fa fa-paste'>fa fa-paste</option>
								<option value='fa fa-pause'>fa fa-pause</option>
								<option value='fa fa-pause-circle'>fa fa-pause-circle</option>
								<option value='fa fa-pause-circle-o'>fa fa-pause-circle-o</option>
								<option value='fa fa-paw'>fa fa-paw</option>
								<option value='fa fa-paypal'>fa fa-paypal</option>
								<option value='fa fa-pencil'>fa fa-pencil</option>
								<option value='fa fa-pencil-square'>fa fa-pencil-square</option>
								<option value='fa fa-pencil-square-o'>fa fa-pencil-square-o</option>
								<option value='fa fa-percent'>fa fa-percent</option>
								<option value='fa fa-phone'>fa fa-phone</option>
								<option value='fa fa-phone-square'>fa fa-phone-square</option>
								<option value='fa fa-photo'>fa fa-photo</option>
								<option value='fa fa-picture-o'>fa fa-picture-o</option>
								<option value='fa fa-pie-chart'>fa fa-pie-chart</option>
								<option value='fa fa-pied-piper'>fa fa-pied-piper</option>
								<option value='fa fa-pied-piper-alt'>fa fa-pied-piper-alt</option>
								<option value='fa fa-pied-piper-pp'>fa fa-pied-piper-pp</option>
								<option value='fa fa-pinterest'>fa fa-pinterest</option>
								<option value='fa fa-pinterest-p'>fa fa-pinterest-p</option>
								<option value='fa fa-pinterest-square'>fa fa-pinterest-square</option>
								<option value='fa fa-plane'>fa fa-plane</option>
								<option value='fa fa-play'>fa fa-play</option>
								<option value='fa fa-play-circle'>fa fa-play-circle</option>
								<option value='fa fa-play-circle-o'>fa fa-play-circle-o</option>
								<option value='fa fa-plug'>fa fa-plug</option>
								<option value='fa fa-plus'>fa fa-plus</option>
								<option value='fa fa-plus-circle'>fa fa-plus-circle</option>
								<option value='fa fa-plus-square'>fa fa-plus-square</option>
								<option value='fa fa-plus-square-o'>fa fa-plus-square-o</option>
								<option value='fa fa-podcast'>fa fa-podcast</option>
								<option value='fa fa-power-off'>fa fa-power-off</option>
								<option value='fa fa-print'>fa fa-print</option>
								<option value='fa fa-product-hunt'>fa fa-product-hunt</option>
								<option value='fa fa-puzzle-piece'>fa fa-puzzle-piece</option>
								<option value='fa fa-qq'>fa fa-qq</option>
								<option value='fa fa-qrcode'>fa fa-qrcode</option>
								<option value='fa fa-question'>fa fa-question</option>
								<option value='fa fa-question-circle'>fa fa-question-circle</option>
								<option value='fa fa-question-circle-o'>fa fa-question-circle-o</option>
								<option value='fa fa-quora'>fa fa-quora</option>
								<option value='fa fa-quote-left'>fa fa-quote-left</option>
								<option value='fa fa-quote-right'>fa fa-quote-right</option>
								<option value='fa fa-ra'>fa fa-ra</option>
								<option value='fa fa-random'>fa fa-random</option>
								<option value='fa fa-ravelry'>fa fa-ravelry</option>
								<option value='fa fa-rebel'>fa fa-rebel</option>
								<option value='fa fa-recycle'>fa fa-recycle</option>
								<option value='fa fa-reddit'>fa fa-reddit</option>
								<option value='fa fa-reddit-alien'>fa fa-reddit-alien</option>
								<option value='fa fa-reddit-square'>fa fa-reddit-square</option>
								<option value='fa fa-refresh'>fa fa-refresh</option>
								<option value='fa fa-registered'>fa fa-registered</option>
								<option value='fa fa-remove'>fa fa-remove</option>
								<option value='fa fa-renren'>fa fa-renren</option>
								<option value='fa fa-reorder'>fa fa-reorder</option>
								<option value='fa fa-repeat'>fa fa-repeat</option>
								<option value='fa fa-reply'>fa fa-reply</option>
								<option value='fa fa-reply-all'>fa fa-reply-all</option>
								<option value='fa fa-resistance'>fa fa-resistance</option>
								<option value='fa fa-retweet'>fa fa-retweet</option>
								<option value='fa fa-rmb'>fa fa-rmb</option>
								<option value='fa fa-road'>fa fa-road</option>
								<option value='fa fa-rocket'>fa fa-rocket</option>
								<option value='fa fa-rotate-left'>fa fa-rotate-left</option>
								<option value='fa fa-rotate-right'>fa fa-rotate-right</option>
								<option value='fa fa-rouble'>fa fa-rouble</option>
								<option value='fa fa-rss'>fa fa-rss</option>
								<option value='fa fa-rss-square'>fa fa-rss-square</option>
								<option value='fa fa-rub'>fa fa-rub</option>
								<option value='fa fa-ruble'>fa fa-ruble</option>
								<option value='fa fa-rupee'>fa fa-rupee</option>
								<option value='fa fa-s15'>fa fa-s15</option>
								<option value='fa fa-safa fari'>fa fa-safa fari</option>
								<option value='fa fa-save'>fa fa-save</option>
								<option value='fa fa-scissors'>fa fa-scissors</option>
								<option value='fa fa-scribd'>fa fa-scribd</option>
								<option value='fa fa-search'>fa fa-search</option>
								<option value='fa fa-search-minus'>fa fa-search-minus</option>
								<option value='fa fa-search-plus'>fa fa-search-plus</option>
								<option value='fa fa-sellsy'>fa fa-sellsy</option>
								<option value='fa fa-send'>fa fa-send</option>
								<option value='fa fa-send-o'>fa fa-send-o</option>
								<option value='fa fa-server'>fa fa-server</option>
								<option value='fa fa-share'>fa fa-share</option>
								<option value='fa fa-share-alt'>fa fa-share-alt</option>
								<option value='fa fa-share-alt-square'>fa fa-share-alt-square</option>
								<option value='fa fa-share-square'>fa fa-share-square</option>
								<option value='fa fa-share-square-o'>fa fa-share-square-o</option>
								<option value='fa fa-shekel'>fa fa-shekel</option>
								<option value='fa fa-sheqel'>fa fa-sheqel</option>
								<option value='fa fa-shield'>fa fa-shield</option>
								<option value='fa fa-ship'>fa fa-ship</option>
								<option value='fa fa-shirtsinbulk'>fa fa-shirtsinbulk</option>
								<option value='fa fa-shopping-bag'>fa fa-shopping-bag</option>
								<option value='fa fa-shopping-basket'>fa fa-shopping-basket</option>
								<option value='fa fa-shopping-cart'>fa fa-shopping-cart</option>
								<option value='fa fa-shower'>fa fa-shower</option>
								<option value='fa fa-sign-in'>fa fa-sign-in</option>
								<option value='fa fa-sign-language'>fa fa-sign-language</option>
								<option value='fa fa-sign-out'>fa fa-sign-out</option>
								<option value='fa fa-signal'>fa fa-signal</option>
								<option value='fa fa-signing'>fa fa-signing</option>
								<option value='fa fa-simplybuilt'>fa fa-simplybuilt</option>
								<option value='fa fa-sitemap'>fa fa-sitemap</option>
								<option value='fa fa-skyatlas'>fa fa-skyatlas</option>
								<option value='fa fa-skype'>fa fa-skype</option>
								<option value='fa fa-slack'>fa fa-slack</option>
								<option value='fa fa-sliders'>fa fa-sliders</option>
								<option value='fa fa-slideshare'>fa fa-slideshare</option>
								<option value='fa fa-smile-o'>fa fa-smile-o</option>
								<option value='fa fa-snapchat'>fa fa-snapchat</option>
								<option value='fa fa-snapchat-ghost'>fa fa-snapchat-ghost</option>
								<option value='fa fa-snapchat-square'>fa fa-snapchat-square</option>
								<option value='fa fa-snowflake-o'>fa fa-snowflake-o</option>
								<option value='fa fa-soccer-ball-o'>fa fa-soccer-ball-o</option>
								<option value='fa fa-sort'>fa fa-sort</option>
								<option value='fa fa-sort-alpha-asc'>fa fa-sort-alpha-asc</option>
								<option value='fa fa-sort-alpha-desc'>fa fa-sort-alpha-desc</option>
								<option value='fa fa-sort-amount-asc'>fa fa-sort-amount-asc</option>
								<option value='fa fa-sort-amount-desc'>fa fa-sort-amount-desc</option>
								<option value='fa fa-sort-asc'>fa fa-sort-asc</option>
								<option value='fa fa-sort-desc'>fa fa-sort-desc</option>
								<option value='fa fa-sort-down'>fa fa-sort-down</option>
								<option value='fa fa-sort-numeric-asc'>fa fa-sort-numeric-asc</option>
								<option value='fa fa-sort-numeric-desc'>fa fa-sort-numeric-desc</option>
								<option value='fa fa-sort-up'>fa fa-sort-up</option>
								<option value='fa fa-soundcloud'>fa fa-soundcloud</option>
								<option value='fa fa-space-shuttle'>fa fa-space-shuttle</option>
								<option value='fa fa-spinner'>fa fa-spinner</option>
								<option value='fa fa-spoon'>fa fa-spoon</option>
								<option value='fa fa-spotify'>fa fa-spotify</option>
								<option value='fa fa-square'>fa fa-square</option>
								<option value='fa fa-square-o'>fa fa-square-o</option>
								<option value='fa fa-stack-exchange'>fa fa-stack-exchange</option>
								<option value='fa fa-stack-overflow'>fa fa-stack-overflow</option>
								<option value='fa fa-star'>fa fa-star</option>
								<option value='fa fa-star-half'>fa fa-star-half</option>
								<option value='fa fa-star-half-empty'>fa fa-star-half-empty</option>
								<option value='fa fa-star-half-full'>fa fa-star-half-full</option>
								<option value='fa fa-star-half-o'>fa fa-star-half-o</option>
								<option value='fa fa-star-o'>fa fa-star-o</option>
								<option value='fa fa-steam'>fa fa-steam</option>
								<option value='fa fa-steam-square'>fa fa-steam-square</option>
								<option value='fa fa-step-backward'>fa fa-step-backward</option>
								<option value='fa fa-step-forward'>fa fa-step-forward</option>
								<option value='fa fa-stethoscope'>fa fa-stethoscope</option>
								<option value='fa fa-sticky-note'>fa fa-sticky-note</option>
								<option value='fa fa-sticky-note-o'>fa fa-sticky-note-o</option>
								<option value='fa fa-stop'>fa fa-stop</option>
								<option value='fa fa-stop-circle'>fa fa-stop-circle</option>
								<option value='fa fa-stop-circle-o'>fa fa-stop-circle-o</option>
								<option value='fa fa-street-view'>fa fa-street-view</option>
								<option value='fa fa-strikethrough'>fa fa-strikethrough</option>
								<option value='fa fa-stumbleupon'>fa fa-stumbleupon</option>
								<option value='fa fa-stumbleupon-circle'>fa fa-stumbleupon-circle</option>
								<option value='fa fa-subscript'>fa fa-subscript</option>
								<option value='fa fa-subway'>fa fa-subway</option>
								<option value='fa fa-suitcase'>fa fa-suitcase</option>
								<option value='fa fa-sun-o'>fa fa-sun-o</option>
								<option value='fa fa-superpowers'>fa fa-superpowers</option>
								<option value='fa fa-superscript'>fa fa-superscript</option>
								<option value='fa fa-support'>fa fa-support</option>
								<option value='fa fa-table'>fa fa-table</option>
								<option value='fa fa-tablet'>fa fa-tablet</option>
								<option value='fa fa-tachometer'>fa fa-tachometer</option>
								<option value='fa fa-tag'>fa fa-tag</option>
								<option value='fa fa-tags'>fa fa-tags</option>
								<option value='fa fa-tasks'>fa fa-tasks</option>
								<option value='fa fa-taxi'>fa fa-taxi</option>
								<option value='fa fa-telegram'>fa fa-telegram</option>
								<option value='fa fa-television'>fa fa-television</option>
								<option value='fa fa-tencent-weibo'>fa fa-tencent-weibo</option>
								<option value='fa fa-terminal'>fa fa-terminal</option>
								<option value='fa fa-text-height'>fa fa-text-height</option>
								<option value='fa fa-text-width'>fa fa-text-width</option>
								<option value='fa fa-th'>fa fa-th</option>
								<option value='fa fa-th-large'>fa fa-th-large</option>
								<option value='fa fa-th-list'>fa fa-th-list</option>
								<option value='fa fa-themeisle'>fa fa-themeisle</option>
								<option value='fa fa-thermometer'>fa fa-thermometer</option>
								<option value='fa fa-thermometer-0'>fa fa-thermometer-0</option>
								<option value='fa fa-thermometer-1'>fa fa-thermometer-1</option>
								<option value='fa fa-thermometer-2'>fa fa-thermometer-2</option>
								<option value='fa fa-thermometer-3'>fa fa-thermometer-3</option>
								<option value='fa fa-thermometer-4'>fa fa-thermometer-4</option>
								<option value='fa fa-thermometer-empty'>fa fa-thermometer-empty</option>
								<option value='fa fa-thermometer-full'>fa fa-thermometer-full</option>
								<option value='fa fa-thermometer-half'>fa fa-thermometer-half</option>
								<option value='fa fa-thermometer-quarter'>fa fa-thermometer-quarter</option>
								<option value='fa fa-thermometer-three-quarters'>fa fa-thermometer-three-quarters</option>
								<option value='fa fa-thumb-tack'>fa fa-thumb-tack</option>
								<option value='fa fa-thumbs-down'>fa fa-thumbs-down</option>
								<option value='fa fa-thumbs-o-down'>fa fa-thumbs-o-down</option>
								<option value='fa fa-thumbs-o-up'>fa fa-thumbs-o-up</option>
								<option value='fa fa-thumbs-up'>fa fa-thumbs-up</option>
								<option value='fa fa-ticket'>fa fa-ticket</option>
								<option value='fa fa-times'>fa fa-times</option>
								<option value='fa fa-times-circle'>fa fa-times-circle</option>
								<option value='fa fa-times-circle-o'>fa fa-times-circle-o</option>
								<option value='fa fa-times-rectangle'>fa fa-times-rectangle</option>
								<option value='fa fa-times-rectangle-o'>fa fa-times-rectangle-o</option>
								<option value='fa fa-tint'>fa fa-tint</option>
								<option value='fa fa-toggle-down'>fa fa-toggle-down</option>
								<option value='fa fa-toggle-left'>fa fa-toggle-left</option>
								<option value='fa fa-toggle-off'>fa fa-toggle-off</option>
								<option value='fa fa-toggle-on'>fa fa-toggle-on</option>
								<option value='fa fa-toggle-right'>fa fa-toggle-right</option>
								<option value='fa fa-toggle-up'>fa fa-toggle-up</option>
								<option value='fa fa-trademark'>fa fa-trademark</option>
								<option value='fa fa-train'>fa fa-train</option>
								<option value='fa fa-transgender'>fa fa-transgender</option>
								<option value='fa fa-transgender-alt'>fa fa-transgender-alt</option>
								<option value='fa fa-trash'>fa fa-trash</option>
								<option value='fa fa-trash-o'>fa fa-trash-o</option>
								<option value='fa fa-tree'>fa fa-tree</option>
								<option value='fa fa-trello'>fa fa-trello</option>
								<option value='fa fa-tripadvisor'>fa fa-tripadvisor</option>
								<option value='fa fa-trophy'>fa fa-trophy</option>
								<option value='fa fa-truck'>fa fa-truck</option>
								<option value='fa fa-try'>fa fa-try</option>
								<option value='fa fa-tty'>fa fa-tty</option>
								<option value='fa fa-tumblr'>fa fa-tumblr</option>
								<option value='fa fa-tumblr-square'>fa fa-tumblr-square</option>
								<option value='fa fa-turkish-lira'>fa fa-turkish-lira</option>
								<option value='fa fa-tv'>fa fa-tv</option>
								<option value='fa fa-twitch'>fa fa-twitch</option>
								<option value='fa fa-twitter'>fa fa-twitter</option>
								<option value='fa fa-twitter-square'>fa fa-twitter-square</option>
								<option value='fa fa-umbrella'>fa fa-umbrella</option>
								<option value='fa fa-underline'>fa fa-underline</option>
								<option value='fa fa-undo'>fa fa-undo</option>
								<option value='fa fa-universal-access'>fa fa-universal-access</option>
								<option value='fa fa-university'>fa fa-university</option>
								<option value='fa fa-unlink'>fa fa-unlink</option>
								<option value='fa fa-unlock'>fa fa-unlock</option>
								<option value='fa fa-unlock-alt'>fa fa-unlock-alt</option>
								<option value='fa fa-unsorted'>fa fa-unsorted</option>
								<option value='fa fa-upload'>fa fa-upload</option>
								<option value='fa fa-usb'>fa fa-usb</option>
								<option value='fa fa-usd'>fa fa-usd</option>
								<option value='fa fa-user'>fa fa-user</option>
								<option value='fa fa-user-circle'>fa fa-user-circle</option>
								<option value='fa fa-user-circle-o'>fa fa-user-circle-o</option>
								<option value='fa fa-user-md'>fa fa-user-md</option>
								<option value='fa fa-user-o'>fa fa-user-o</option>
								<option value='fa fa-user-plus'>fa fa-user-plus</option>
								<option value='fa fa-user-secret'>fa fa-user-secret</option>
								<option value='fa fa-user-times'>fa fa-user-times</option>
								<option value='fa fa-users'>fa fa-users</option>
								<option value='fa fa-vcard'>fa fa-vcard</option>
								<option value='fa fa-vcard-o'>fa fa-vcard-o</option>
								<option value='fa fa-venus'>fa fa-venus</option>
								<option value='fa fa-venus-double'>fa fa-venus-double</option>
								<option value='fa fa-venus-mars'>fa fa-venus-mars</option>
								<option value='fa fa-viacoin'>fa fa-viacoin</option>
								<option value='fa fa-viadeo'>fa fa-viadeo</option>
								<option value='fa fa-viadeo-square'>fa fa-viadeo-square</option>
								<option value='fa fa-video-camera'>fa fa-video-camera</option>
								<option value='fa fa-vimeo'>fa fa-vimeo</option>
								<option value='fa fa-vimeo-square'>fa fa-vimeo-square</option>
								<option value='fa fa-vine'>fa fa-vine</option>
								<option value='fa fa-vk'>fa fa-vk</option>
								<option value='fa fa-volume-control-phone'>fa fa-volume-control-phone</option>
								<option value='fa fa-volume-down'>fa fa-volume-down</option>
								<option value='fa fa-volume-off'>fa fa-volume-off</option>
								<option value='fa fa-volume-up'>fa fa-volume-up</option>
								<option value='fa fa-warning'>fa fa-warning</option>
								<option value='fa fa-wechat'>fa fa-wechat</option>
								<option value='fa fa-weibo'>fa fa-weibo</option>
								<option value='fa fa-weixin'>fa fa-weixin</option>
								<option value='fa fa-whatsapp'>fa fa-whatsapp</option>
								<option value='fa fa-wheelchair'>fa fa-wheelchair</option>
								<option value='fa fa-wheelchair-alt'>fa fa-wheelchair-alt</option>
								<option value='fa fa-wifi'>fa fa-wifi</option>
								<option value='fa fa-wikipedia-w'>fa fa-wikipedia-w</option>
								<option value='fa fa-window-close'>fa fa-window-close</option>
								<option value='fa fa-window-close-o'>fa fa-window-close-o</option>
								<option value='fa fa-window-maximize'>fa fa-window-maximize</option>
								<option value='fa fa-window-minimize'>fa fa-window-minimize</option>
								<option value='fa fa-window-restore'>fa fa-window-restore</option>
								<option value='fa fa-windows'>fa fa-windows</option>
								<option value='fa fa-won'>fa fa-won</option>
								<option value='fa fa-wordpress'>fa fa-wordpress</option>
								<option value='fa fa-wpbeginner'>fa fa-wpbeginner</option>
								<option value='fa fa-wpexplorer'>fa fa-wpexplorer</option>
								<option value='fa fa-wpforms'>fa fa-wpforms</option>
								<option value='fa fa-wrench'>fa fa-wrench</option>
								<option value='fa fa-xing'>fa fa-xing</option>
								<option value='fa fa-xing-square'>fa fa-xing-square</option>
								<option value='fa fa-y-combinator'>fa fa-y-combinator</option>
								<option value='fa fa-y-combinator-square'>fa fa-y-combinator-square</option>
								<option value='fa fa-yahoo'>fa fa-yahoo</option>
								<option value='fa fa-yc'>fa fa-yc</option>
								<option value='fa fa-yc-square'>fa fa-yc-square</option>
								<option value='fa fa-yelp'>fa fa-yelp</option>
								<option value='fa fa-yen'>fa fa-yen</option>
								<option value='fa fa-yoast'>fa fa-yoast</option>
								<option value='fa fa-youtube'>fa fa-youtube</option>
								<option value='fa fa-youtube-play'>fa fa-youtube-play</option>
								<option value='fa fa-youtube-square'>fa fa-youtube-square</option>
							</select>
							<span class="glyphicon glyphicon-cog form-control-feedback"></span>
							<div class="help-block with-errors"></div>
						</div>
					</td>
				</tr>
			</table>
			</form>
			</div>	
			
			<div class="modal-footer">	
				<span id="edit_button_menudata"></span>
				<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
			</div>
		</div>
		</div>
		</div>
		<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
		<!-- ###################### Κρυφό modal_del_sith για εμφάνιση ###################### -->
		<div id="modal_del_menudata" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
				<span id="del_button_menudata"></span>
				<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
			</div>
		</div>
		</div>
		</div>
		<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
			
			
			
			
		</div>
		<!--/tabs-2-->
		
		
		<div class="tab-pane" id="tabs-3">
		<?php
		$database = new medoo(DB_NAME);
		
			$db_table = "user_logs";
			$db_columns = "*";
			$where_id=array("ORDER"=>array("dt" => "DESC"),"LIMIT"=>40);
			$select_logs = $database->select($db_table,$db_columns,$where_id);
			
			foreach($select_logs as $logs){
				$select_username = $database->select("core_users","usr",array("id"=>$logs["user_id"]) );
			echo "Ο χρήστης <i class=\"fa fa-user-o\" aria-hidden=\"true\"></i><b>".
			$select_username[0]."</b> συνδέθηκε στις : <i class=\"fa fa-calendar-times-o\" aria-hidden=\"true\"></i><b>".
			$logs["dt"]."</b> από <i class=\"fa fa-globe\" aria-hidden=\"true\"></i><b>".
			$logs["regIP"]."</b><br/>";
			}
		?>
		
		</div>
		<!--/tabs-3-->
		
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
<?php
}
?>