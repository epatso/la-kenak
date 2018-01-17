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
			<li><a href="#tabs-2" data-toggle="tab">Στατιστικά σύνδεσης</a></li>
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
		<!--/tabs-2-->
		
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