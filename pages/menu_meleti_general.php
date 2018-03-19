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
confirm_meleti_isset();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
	<h1>
	La-kenak
	<small>Γενικά στοιχεία μελέτης</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-edit"></i> Μελέτη ΚΕΝΑΚ</a></li>
	<li class="active"> Γενικά στοιχεία μελέτης</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
	
		<div class="col-md-2">
				<button id= 'save-location' class="btn btn-default" onclick="save('save-all')"><i class="fa fa-save"></i> Αποθήκευση</button>
				<button id= 'load-xml' class="btn btn-default" data-toggle="modal" data-target="#xmluploadmodal"><i class="fa fa-file-code-o"></i> XML από BC</button>
				<br/><br/>
				<div class="alert alert-success" id="AJAX_save">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Αποθήκευση</h4>
				Επιτυχής αποθήκευση
				</div>
				<div class="alert alert-error" id="AJAX_nosave">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Προσοχή</h4>
				Δεν ήταν δυνατή η αποθήκευση!
				</div>


<!-- xml upload modal -->
<div class="modal fade" id="xmluploadmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Κλείσιμο</span></button>
        <h4 class="modal-title" id="myModalLabel">XML από Buildingcert</h4>
	</div>
	<div class="modal-body">
	Ανεβάστε το xml αρικών τιμών από το buildingcert για να δείτε τα στοιχεία του. Εάν συμφωνείτε μπορείτε να τα φορτώσετε στα κελιά 
	της μελέτης.<br/>
	<table class="table table-striped">
	<tr><td>
	<div class="form-group">
		<label for="bcxmlfile">Ανέβασε αρχείο...</label>
		<input type="file" id="bcxmlfile">
		<p class="help-block">Επιτρέπονται μόνο xml.</p>
	</div>
	<button type="submit" class="btn btn-default" onclick=read_bcxml();>Ανάγνωση τιμών αρχείου</button>
	</td>
	<td>
		<table class="table table-condensed">
		<tr><td>α/α</td><td><input id="bcxml_id"></td></tr>
		<tr><td>Κατηγορία κτιρίου</td><td><input id="bcxml_blg_type"></td></tr>
		<tr><td>Χρήση</td><td><input id="bcxml_blg_use"></td></tr>
		<tr><td>Τμήμα κτιρίου</td><td><input id="bcxml_blg_part"></td></tr>
		<tr><td>Αρ. ιδιοκτησίας</td><td><input id="bcxml_building_num"></td></tr>
		<tr><td>KAEK</td><td><input id="bcxml_blg_kaek"></td></tr>
		<tr><td>Ιδιοκτήτης</td><td><input id="bcxml_blg_owner"></td></tr>
		<tr><td>Ιδ. Καθεστώς</td><td><input id="bcxml_blg_ownership"></td></tr>
		<tr><td>Διεύθυνση</td><td><input id="bcxml_blg_address"></td></tr>
		<tr><td>Είδος υπευθύνου</td><td><input id="bcxml_blg_resp"></td></tr>
		<tr><td>Όνομα υπευθύνου</td><td><input id="bcxml_blg_resp_name"></td></tr>
		<tr><td>Τηλ υπευθύνου</td><td><input id="bcxml_blg_resp_phone"></td></tr>
		<tr><td>mail υπευθύνου</td><td><input id="bcxml_blg_resp_mail"></td></tr>
		</table>
	</td></tr></table>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Κλείσιμο</button>
		<button type="button" class="btn btn-primary" data-dismiss="modal" onclick=load_bcxml();>Φόρτωση τιμών</button>
	</div>
</div>
</div>
</div>
<!--xml upload modal-->
<script>
function number_format (number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? '' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

function read_bcxml(){

document.getElementById('wait').style.display="inline";
var link="includes/functions_xml.php?read_bcxml=1";

		//AJAX call
		var fileInput = document.getElementById('bcxmlfile');
		var file = fileInput.files[0];
		var formData = new FormData();
		formData.append('file', file);
		
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open('POST', link, true);
		xmlhttp.send(formData);
		
		xmlhttp.onreadystatechange=function()  {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById('wait').style.display="none";
				var arr = JSON.parse(xmlhttp.responseText);
				document.getElementById('bcxml_id').value=arr["id"];
				document.getElementById('bcxml_blg_type').value=arr["blg_type"];
				document.getElementById('bcxml_blg_use').value=arr["blg_use"];
				document.getElementById('bcxml_blg_part').value=arr["blg_part"];
				document.getElementById('bcxml_building_num').value=arr["building_num"];
				document.getElementById('bcxml_blg_kaek').value=arr["blg_kaek"];
				document.getElementById('bcxml_blg_owner').value=arr["blg_owner"];
				document.getElementById('bcxml_blg_ownership').value=arr["blg_ownership"];
				document.getElementById('bcxml_blg_address').value=arr["blg_address"];
				document.getElementById('bcxml_blg_resp').value=arr["blg_resp"];
				document.getElementById('bcxml_blg_resp_name').value=arr["blg_resp_name"];
				document.getElementById('bcxml_blg_resp_phone').value=arr["blg_resp_phone"];
				document.getElementById('bcxml_blg_resp_mail').value=arr["blg_resp_mail"];
			}
		}
}

function load_bcxml(){
	var bcxml_id = document.getElementById('bcxml_id').value;
	var bcxml_blg_type = document.getElementById('bcxml_blg_type').value;
	var bcxml_blg_use = document.getElementById('bcxml_blg_use').value;
	var bcxml_blg_part = document.getElementById('bcxml_blg_part').value;
	var bcxml_building_num = document.getElementById('bcxml_building_num').value;
	var bcxml_blg_kaek = document.getElementById('bcxml_blg_kaek').value;
	var bcxml_blg_owner = document.getElementById('bcxml_blg_owner').value;
	var bcxml_blg_ownership = document.getElementById('bcxml_blg_ownership').value;
	var bcxml_blg_address = document.getElementById('bcxml_blg_address').value;
	var bcxml_blg_resp = document.getElementById('bcxml_blg_resp').value;
	var bcxml_blg_resp_name = document.getElementById('bcxml_blg_resp_name').value;
	var bcxml_blg_resp_phone = document.getElementById('bcxml_blg_resp_phone').value;
	var bcxml_blg_resp_mail = document.getElementById('bcxml_blg_resp_mail').value;
	
	document.getElementById('type').value = bcxml_blg_type;
	document.getElementById('perigrafi').value = bcxml_id;
	document.getElementById('xrisi').value = bcxml_blg_use;
	if(bcxml_blg_part==1){
		document.getElementById('tmima').checked = true;
	}else{
		document.getElementById('tmima').checked = false;
	}
	document.getElementById('tmima_ar').value = bcxml_building_num;
	document.getElementById('kaek').value = bcxml_blg_kaek;
	document.getElementById('idioktitis').value = bcxml_blg_owner;
	document.getElementById('idio_kathestos').value = bcxml_blg_ownership;
	document.getElementById('address').value = bcxml_blg_address;
	document.getElementById('ypeythinos_type').value = bcxml_blg_resp;
	document.getElementById('ypeythinos_name').value = bcxml_blg_resp_name;
	document.getElementById('ypeythinos_tel').value = bcxml_blg_resp_phone;
	document.getElementById('ypeythinos_mail').value = bcxml_blg_resp_mail;

}

</script>
				
				<div class="alert alert-success">
					<div id="fuel_info">
					
					<img src="images/interface/other/map.png">:<span id="apostasi_apo_edra"></span>
					<a href="#" data-content="Απόσταση από έδρα μελετητή σε ευθεία γραμμή" title="Απόσταση" data-toggle="hover">?</a>
					<br/>
					
					<img src="images/interface/other/fuel.png">:<span id="fuel"></span>
					<a href="#" data-content="D:Diesel με κατανάλωση 3.1lt/100km<br/>Β:Βενζίνη με κατανάλωση 5lt/100km" title="Κατανάλωση" data-toggle="hover">?</a>
					<br/>
					
					<img src="images/interface/other/price.png">:<span id="fuel_price"></span>
					<a href="#" data-content="D:Diesel με κατανάλωση 3.1lt/100km<br/>Β:Βενζίνη με κατανάλωση 5lt/100km" title="Κόστος μετακίνησης" data-toggle="hover">?</a>
					</div>
				</div>
				
				<div class="panel panel-success">
					<div class="panel-heading">Εργαλεία χάρτη</div>
					<div class="panel-body">
						<div id="weather_info"></div>
						<a id="climatelink1" title="Κλιματικά δεδομένα" href="#" target="_blank"><img src="images/interface/weather/climate.png"></a>
						<a id="climatelink2" title="Πρόγνωση" href="#" target="_blank"><img src="images/interface/weather/forecast.png"></a>
						<a id="climatelink3" title="Μετεώγραμμα" href="#" target="_blank"><img src="images/interface/weather/data.png"></a>
						<a href="#" data-content="Εξωτερικοί σύνδεσμοι προς ΕΜΥ" title="Σύνδεσμοι - Καιρός" data-toggle="hover">?</a>
						<br/><br/>
						<a class="btn btn-default" href="#" title="Μοιρογνωμόνιο" role="button" onclick="toggle_moirognwmonio();"><i class="fa fa-compass"></i></a>
						<a class="btn btn-default" href="#" title="Περιστροφή χάρτη αριστερά" role="button" onclick=rotatemap("left");><i class="fa fa-undo"></i></a>
						<a class="btn btn-default" href="#" title="Περιστροφή χάρτη δεξιά" role="button" onclick=rotatemap("right");><i class="fa fa-repeat"></i></a>
						<input id="newdeg" value=0 title="Περιστροφή" disabled/>
					</div>
				</div>
				
				
			    <div class="alert alert-success" id="genika_help_1">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4><i class="fa fa-map-signs"></i> Γενικά στοιχεία</h4>
				Τα στοιχεία έχουν φορτώσει όπως τα έχετε αποθηκεύσει για τη μελέτη σας.<br/>
				<i class="fa fa-map-marker text-danger" aria-hidden="true"></i> Τα στοιχεία αλλάζουν με μετακίνηση του χάρτη.<br/>
				<i class="fa fa-file-excel-o text-danger" aria-hidden="true"></i> Τα στοιχεία φορτώνουν από το xml του BC.<br/>
				<br/>
				<h4><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
				Ο υπολογισμός της απόστασης του ακινήτου από την έδρα του επιθεωρητή καθώς και των κλιματικών δεδομένων από τη 
				θέση του ακινήτου υπολογίζονται σε ευθεία γραμμή χωρίς να λαμβάνονται υπ' όψη τα υψόμετρα ενώ στηρίζονται στην 
				παραδοχή σταθερής ακτίνας της Γης:<br/>R = 6372.797km.<br/>
				</div>
				
				<div class="alert alert-success" id="genika_help_2" >
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4><i class="fa fa-suitcase"></i> Βιβλιοθήκες</h4>
				Επιλέξτε τη χρήση του κτιρίου, τα κοντινότερα κλιματολογικά δεδομένα, και την κλιματική ζώνη. <br/><br/>
				Με βάση τη θέση του κτιρίου που δηλώσατε στην 1<sup>η</sup> καρτέλα επιλέγονται αυτόματα οι κοντινότερες περιοχές.
				</div>
				
				<div class="alert alert-success" id="genika_help_3" >
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4><i class="fa fa-address-card"></i> Ιδιοκτήτης</h4>
				Συμπληρώστε τα στοιχεία όπως θα εμφανιστούν στο xml. <br/><br/>
				Επιπλέον μπορείτε να δηλώσετε επιπλέον στοιχεία που αφορούν τα ΠΕΑ. 
				</div>
				
				<div class="alert alert-success" id="genika_help_4" >
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4><i class="fa fa-cog"></i> Συστήματα</h4>
				Συμπληρώστε τις οικοδομικές άδειες του ακινήτου όπως θα εμφανίζονται στο xml.
				</div>
				
				<div class="alert alert-success" id="genika_help_5" >
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4><i class="fa fa-certificate"></i> Πιστοποιητικό</h4>
				Εάν ο τύπος της μελέτης που δηλώθηκε στην 1<sup>η</sup> καρτέλα είναι "ΠΕΑ" ή "ΕΞΟΙΚΟΝΟΜΩ" το λογισμικό θα έχει έτοιμες 
				για εισαγωγή τις τιμές για U,ψ,φέρων οργανισμό, αερισμό ανοιγμάτων στην προσθήκη δομικών στοιχείων.
				</div>
				
				<div class="alert alert-success" id="genika_help_6" >
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4><i class="fa fa-building"></i> Μελέτη ΚΕΝΑΚ</h4>
				Εάν ο τύπος της μελέτης που δηλώθηκε στην 1<sup>η</sup> καρτέλα είναι "ΜΕΛΕΤΗ" το λογισμικό θα έχει έτοιμες 
				για εισαγωγή τιμές για U,ψ, αερισμό ανοιγμάτων στην προσθήκη δομικών στοιχείων.<br/><br/>
				Επιπλέον θα εμφανίσει αυτόματα τους υπολογισμούς και τα σκαριφήματα των δομικών στοιχείων στο τεύχος. 
				</div>
				
				<div class="alert alert-success" id="genika_help_7" >
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4><i class="fa fa-arrows-h"></i> Διαστάσεις</h4>
				Οι πρότυπες διαστάσεις εμφανίζονται έτοιμες προς εισαγωγή στις φόρμες εισαγωγής των δομικών στοιχείων.
				</div>
		</div>
		
		<div class="col-md-10">
			<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs-1" data-toggle="tab" onclick="show_help(1);"><i class="fa fa-map-signs"></i> Γενικά στοιχεία</a></li>
				<li><a href="#tabs-2" data-toggle="tab" onclick="show_help(2);"><i class="fa fa-suitcase"></i> Βιβλιοθήκες</a></li>
				<li><a href="#tabs-3" data-toggle="tab" onclick="show_help(3);"><i class="fa fa-address-card"></i> Πληροφορίες</a></li>
				<li><a href="#tabs-4" data-toggle="tab" onclick="show_help(4);"><i class="fa fa-cog"></i> Συστήματα</a></li>
				<li><a href="#tabs-5" data-toggle="tab" onclick="show_help(5);"><i class="fa fa-certificate"></i> ΠΕΑ</a></li>
				<li><a href="#tabs-6" data-toggle="tab" onclick="show_help(6);"><i class="fa fa-building"></i> Μελέτη</a></li>
				<li><a href="#tabs-7" data-toggle="tab" onclick="show_help(7);"><i class="fa fa-arrows-h"></i> Διαστάσεις</a></li>
				<li><a href="#tabs-8" data-toggle="tab" onclick="show_help(8);"><i class="fa fa-file-image-o"></i> Αρχεία</a></li>
			</ul>
<script>
$('#tabs-1').on('show', function () {
var map = document.getElementById('mapCanvas');
	google.maps.event.trigger(map, "resize");
	osmmap.updateSize();
});
$('#fuel_info a').popover({ html:true, trigger:'hover' });
$('#weather_info a').popover({ html:true, trigger:'hover' });
</script>			
			<div id='wait' style="display:none;position:absolute;top:130px;left:500px;z-index:9999;"><img src="images/interface/ajax-loader.gif"></div>       

			<div class="tab-content">
			<div class="tab-pane active" id="tabs-1">
			<?php
			$database = new medoo(DB_NAME);

			//Εύρεση των αποθηκευμένων επιλογών της μελέτης
			$db_table = "user_meletes";
			$db_columns = "*";
			$where_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"id" => $_SESSION['meleti_id']));
			$select_meleti = $database->select($db_table,$db_columns,$where_parameters);

			$name = $select_meleti[0]["name"];
			$perigrafi = $select_meleti[0]["perigrafi"];
			$type = $select_meleti[0]["type"];
			$symptiksi = $select_meleti[0]["symptiksi"];
			$address = $select_meleti[0]["address"];
			$address_x = $select_meleti[0]["address_x"];
			$address_y = $select_meleti[0]["address_y"];
			$address_z = $select_meleti[0]["address_z"];
			$ktirio = $select_meleti[0]["ktirio"];
			$kaek = $select_meleti[0]["kaek"];
			$tmima = $select_meleti[0]["tmima"];
			$tmima_ar = $select_meleti[0]["tmima_ar"];
			$xrisi = $select_meleti[0]["xrisi"];
			$climate = $select_meleti[0]["climate"];
			$height = $select_meleti[0]["height"];
			$zone = $select_meleti[0]["zone"];
			$idioktitis = $select_meleti[0]["idioktitis"];
			$idio_kathestos = $select_meleti[0]["idio_kathestos"];
			$ypeythinos_type = $select_meleti[0]["ypeythinos_type"];
			$ypeythinos_name = $select_meleti[0]["ypeythinos_name"];
			$ypeythinos_tel = $select_meleti[0]["ypeythinos_tel"];
			$ypeythinos_mail = $select_meleti[0]["ypeythinos_mail"];
			
			if($address_x==0 AND $address_y==0){
				$address_zoom=6;
			}else{
				$address_zoom=14;
			}
			
			//Εύρεση της έδρας του μελετητή
			$db_table = "core_users";
			$db_columns = "*";
			$where_user = array("id" => $_SESSION['user_id']);
			$select_user = $database->select($db_table,$db_columns,$where_user);
			
			$edra_x = $select_user[0]["address_x"];
			$edra_y = $select_user[0]["address_y"];
			$edra_z = $select_user[0]["address_z"];
			
			//εάν στη μελέτη δεν υπάρχει ακόμα θέση τότε ξεκινάμε από την έδρα του μελετητή
			if($address_x==0 AND $edra_x!=0){$address_x=$edra_x;}
			if($address_y==0 AND $edra_y!=0){$address_y=$edra_y;}
			?>
			
			<script type="text/javascript">
			
			function calc_distanse_edra(lat, lon){
				var pi80 = Math.PI / 180;
				var r = 6372.797;
				
				var edra_x = <?php echo $edra_x; ?>;
				var edra_y = <?php echo $edra_y; ?>;
				var lat1 = edra_x * pi80;
				var lon1 = edra_y * pi80;
				var lat2 = lat * pi80;
				var lon2 = lon * pi80;
				
				var dlat = lat2 - lat1;
				var dlon =  lon2 - lon1;
				
				var a = Math.sin(dlat/2) * Math.sin(dlat/2) + Math.cos(lat2) * Math.cos(lat1) * Math.sin(dlon/2) * Math.sin(dlon/2);
				var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

				var km = r * c;
				var m = km*1000;
				
				document.getElementById("apostasi_apo_edra").innerHTML = number_format(km, 2, ".", ",")+" Km - "+number_format(m, 3, ".", ",")+" m";
				
				var diesel = number_format(3.1 * km/100 , 3);
				var petrol = number_format(5 * km/100 , 3);
				var price_diesel = number_format(1.4 * diesel , 3);
				var price_petrol = number_format(5 * petrol , 3);
				
				document.getElementById("fuel").innerHTML = "D:"+diesel+"lt , B:"+petrol+"lt";
				document.getElementById("fuel_price").innerHTML = "D:"+price_diesel+"€ , B:"+price_petrol+"€";
			}
			</script>
			
			<?php
				if($prefs_googlemaps==1){//Έχουν οριστεί χάρτες google. Φόρτωση GOOGLE MAPS
			?>
			<script>
				
				//GOOGLE MAPS
				var geocoder = new google.maps.Geocoder();
				var elevator = new google.maps.ElevationService();

				function geocodePosition(pos) {
				  geocoder.geocode({
					latLng: pos
				  }, function(responses) {
					if (responses && responses.length > 0) {
					  updateMarkerAddress(responses[0].formatted_address);
					} else {
					  updateMarkerAddress('Άγνωστη τοποθεσία');
					}
				  });
				}
				
				function getElevation(pos) {
					var locations = [];
					locations.push(pos);
					var positionalRequest = {
						'locations': locations
					}
					 // Initiate the location request
					elevator.getElevationForLocations(positionalRequest, function(results, status) {
						if (status == google.maps.ElevationStatus.OK) {

						// Retrieve the first result
						if (results[0]) {//εμφάνιση υψομέτρου
							document.getElementById("address_z").value = number_format(results[0].elevation,2);
							//Αλλαγή του τσεκ στο υψόμετρο με βάση την επιστροφή
							if(results[0].elevation>500){
								document.getElementById("height").checked = true;
							}else{
								document.getElementById("height").checked = false;
							}
							help_height();
						  }else{//δεν βρέθηκε υψόμετρο
							document.getElementById("address_z").value = "Δεν βρέθηκε";
						  }
						}else{//υπάρχει λάθος
						  alert("Λάθος: " + status);
						}
					  });
				}

				function updateMarkerStatus(str) {
				  document.getElementById('markerStatus').innerHTML = str;
				}

				function updateMarkerPosition(latLng) {
					document.getElementById("address_x").value = number_format(latLng.lat(),5);
					document.getElementById("address_y").value = number_format(latLng.lng(),5);
					//calc_distance(latLng.lat(),latLng.lng(),lat_user,lon_user);
				}

				function updateMarkerAddress(str) {
				  document.getElementById('address').value = str;
				}

				function initialize() {
				var mapcontainer = $('#mapcontainer');
				var mapdiv = $('#mapCanvas');
				  var latLng = new google.maps.LatLng(<?php echo $address_x;?>, <?php echo $address_y;?>);
				  var HomelatLng = new google.maps.LatLng(<?php echo $edra_x;?>, <?php echo $edra_y;?>);
				  var image = 'images/map_pins/Home.png';
				  
				  var mapzoom = <?php echo $address_zoom; ?>;
				  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
					zoom: mapzoom,
					center: latLng,
					mapTypeId: google.maps.MapTypeId.SATELLITE,
					panControl:true,
					rotateControl:true,
					zoomControl:true,
					mapTypeControl:true,
					streetViewControl:false,
					overviewMapControl:true
				  });
				  var marker = new google.maps.Marker({
					position: latLng,
					title: 'Κτίριο μελέτης',
					map: map,
					draggable: true
				  });
				  var edra = new google.maps.Marker({
					position: HomelatLng,
					title: 'Έδρα μελετητή',
					map: map,
					draggable: false,
					icon: image
				  });
				  
				  // Update current position info.
				  updateMarkerPosition(latLng);
				  calc_distanse_edra(latLng.lat(), latLng.lng());
				  //geocodePosition(latLng);
				  //getElevation(latLng);
				  
				  // Add dragging event listeners.
				  google.maps.event.addListener(marker, 'dragstart', function() {
					updateMarkerAddress('Τοποθετήστε το δείκτη...');
				  });
				  
				  google.maps.event.addListener(marker, 'drag', function() {
					updateMarkerStatus('Τοποθετήστε το δείκτη...');
					updateMarkerPosition(marker.getPosition());
				  });
				  
				  google.maps.event.addListener(marker, 'dragend', function() {
					updateMarkerStatus('Τοποθετήθηκε ο δείκτης');
					geocodePosition(marker.getPosition());
					getElevation(marker.getPosition());
					calc_distanse_edra(marker.getPosition().lat(), marker.getPosition().lng());
					get_closer_climate();
				  });
				  google.maps.event.addDomListener(map, 'resize', function() {
					map.setCenter(latLng);
				  });
				}
				
				// Onload handler to fire off the app.
				google.maps.event.addDomListener(window, 'load', initialize);
				
			</script>
			<?php
				}//Έχουν οριστεί χάρτες google. Φόρτωση GOOGLE MAPS
			?>
			
				<div id="mapcontainer" style="tabindex: -1"><!--Βρίσκεται πίσω από το μοιρογνωμόνιο-->
					
					<?php
						if($prefs_googlemaps==0){//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
					?>
					<div id="osmmap" style="width: 100%; height: 400px;"><div id="popup"></div></div>
					<?php
						}//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
					?>
					
					<?php
						if($prefs_googlemaps==1){//Έχουν οριστεί χάρτες google. Φόρτωση GOOGLE MAPS
					?>
					<div id="mapCanvas" style="background-color: rgb(229, 227, 223); overflow: hidden; transform: rotate(0deg);"></div>
					<?php
						}//Έχουν οριστεί χάρτες google. Φόρτωση GOOGLE MAPS
					?>
					
					
				</div><!--Βρίσκεται πίσω από το μοιρογνωμόνιο-->
				
				<div id="overmapdiv" style="display:none; text-align:center;"><img src="images/interface/moirognwmonio.png" width="400px" height="400px"></div>
				<span id="infoPanel"></span>
				
<script type="text/javascript">
function toggle_moirognwmonio(){
	if(document.getElementById("overmapdiv").style.display == "none"){
		document.getElementById("overmapdiv").style.display = "block";
	}else{
		document.getElementById("overmapdiv").style.display = "none";
	}
}
</script>

<?php
	if($prefs_googlemaps==0){//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
?>
<script>
	//ΓΕΩΔΑΙΤΙΚΟ ΣΥΣΤΗΜΑ ΑΝΑΦΟΡΑΣ - (Κτηματολόγιο)
	var myProjection = new ol.proj.Projection({
		code: 'EPSG:2100',
		extent: [104022.946289, 3850785.500488, 1007956.563293, 4624047.765686],
		units: 'm'
	}); 
	ol.proj.addProjection(myProjection);
	
	var iconFeature = new ol.Feature(new ol.geom.Point([<?php echo $address_y;?>, <?php echo $address_x;?>]));
	var vectorSource = new ol.source.Vector({
		features: [iconFeature]
	});
	//Εικονίδιο κατοικίας
	var style_house = new ol.style.Style({
		image: new ol.style.Icon(({
			anchor: [0.3, 24],
			anchorXUnits: 'fraction',
			anchorYUnits: 'pixels',
			opacity: 0.75,
			src: 'images/map_pins/icon_magenta.png'
		}))
	});
	iconFeature.setStyle(style_house);
	var vectorLayer = new ol.layer.Vector({
		title: "Μελέτη",
		source: vectorSource
	});
	
	var layers = [
		new ol.layer.Tile({
			title: "OSM",
			baseLayer: true,
			source: new ol.source.OSM()
		}),
		new ol.layer.Tile({
			title: "Κτηματολόγιο",
			baseLayer: true,
			visible: false,
			source: new ol.source.TileWMS({
			url: 'http://gis.ktimanet.gr/wms/wmsopen/wmsserver.aspx',
				params: {
				  'LAYERS': 'KTBASEMAP',
				  'TILED': true
				}
			})
		}),
		vectorLayer
	];
	
	//MAP OSM
	var osmmap = new ol.Map({
		controls: ol.control.defaults().extend([
			new ol.control.ScaleLine(),
			new ol.control.LayerPopup()
		]),
		layers: layers,
		target: 'osmmap',
		view: new ol.View({
			projection: 'EPSG:4326',
			center: [<?php echo $address_y;?>, <?php echo $address_x;?>],
			zoom: 14
		})
	});
	
	//ΠΛΕΓΜΑ
	var graticule = new ol.Graticule({
		// the style to use for the lines, optional.
		strokeStyle: new ol.style.Stroke({
			color: 'rgba(255,120,0,0.9)',
			width: 2,
			lineDash: [0.5, 4]
		}),
		showLabels: true
	});
	graticule.setMap(osmmap);
	
	//ΣΥΝΤΕΤΑΓΜΕΝΕΣ INFO
	var mouse_position = new ol.control.MousePosition({
		coordinateFormat: ol.coordinate.createStringXY(4),
		projection: 'EPSG:4326'
	});
	osmmap.addControl(mouse_position);
	
	// Drag and drop feature
	var dragInteraction = new ol.interaction.Modify({
		features: new ol.Collection([iconFeature]),
		style: null,
		pixelTolerance: 20
	});

	// Add the event to the drag and drop feature
	dragInteraction.on('modifyend',function(){
		var geometry = this.getGeometry().getCoordinates();
		var lon = geometry[0];
		var lat = geometry[1];
		osm_address(lat,lon);
		osm_z(lat,lon);
		document.getElementById('address_x').value = number_format(lat,5);
		document.getElementById('address_y').value = number_format(lon,5);
		calc_distanse_edra(lat, lon);
		get_closer_climate();
	},iconFeature);
	osmmap.addInteraction(dragInteraction);
	
	calc_distanse_edra(<?php echo $address_x;?>, <?php echo $address_y;?>);
	
function osm_address(lat,lon){
	var link = "http://nominatim.openstreetmap.org/reverse?format=jsonv2&lat="+lat+"&lon="+lon+<?php echo $prefs_osmmail_query;?>;
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var arr = JSON.parse(xmlhttp.responseText);
			var road = arr["address"]["road"];
			var town = arr["address"]["county"];
			var village = arr["address"]["village"];
			var state = arr["address"]["state_district"];
			var postcode = arr["address"]["postcode"];
			var country = arr["address"]["country"];
			
			var address = "";
			if(road==null){
				road = "Ανώνυμη οδός";
			}
			address+=road+",";
			if(town!=null){
				address+=town+",";
			}
			if(village!=null){
				address+=village+",";
			}
			if(state!=null){
				address+=state+",";
			}
			if(postcode!=null){
				address+=postcode+",";
			}
			address+=country;
			document.getElementById('address').value = address;
			document.getElementById('wait').style.display="none";
		}
	}
}

function osm_z(lat,lon){
	var link = "https://api.open-elevation.com/api/v1/lookup?locations="+lat+","+lon;
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var arr = JSON.parse(xmlhttp.responseText);
			var z = arr["results"][0]["elevation"];
			
			document.getElementById("address_z").value = number_format(z,2);
			//Αλλαγή του τσεκ στο υψόμετρο με βάση την επιστροφή
			if(z>500){
				document.getElementById("height").checked = true;
			}else{
				document.getElementById("height").checked = false;
			}
			help_height();
			
			document.getElementById('wait').style.display="none";
		}
	}
}
</script>
<?php
	}//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
?>

<script>
function rotatemap(how){
	var tool = document.getElementById('overmapdiv');
	var newdeg = document.getElementById('newdeg').value;
	var deg;
	if(how=="left"){deg=parseFloat(newdeg)-1;}
	if(how=="right"){deg=parseFloat(newdeg)+1;}
	document.getElementById('newdeg').value=deg;
	 
	tool.style.webkitTransform = 'rotate('+deg+'deg)'; /* Safari and Chrome */
	tool.style.mozTransform    = 'rotate('+deg+'deg)'; /* Firefox */
	tool.style.msTransform     = 'rotate('+deg+'deg)'; /* IE 9 */
	tool.style.oTransform      = 'rotate('+deg+'deg)'; /* Opera */
	tool.style.transform       = 'rotate('+deg+'deg)'; 

}
</script>
				
				<table class="table table-bordered table-condensed">
				<tr class="info">
					<td colspan="3">
					<i class="fa fa-book" aria-hidden="true"></i> Γενικά στοιχεία μελέτης
					</td>
				</tr>
				<tr class="warning">
					<td style="width:20%">
						<b>Όνομα μελέτης:</b>
					</td>
					<td style="width:50%">
						<input class="form-control input-sm" type="text" id="name">
					</td>
					<td style="width:30%">	
						<span class="help-inline">*Όνομα μελέτης όπως εμφανίζεται στο μενού</span>
					</td>
				</tr>
				<tr class="warning">
					<td>
						<b><i class="fa fa-file-excel-o text-danger" aria-hidden="true"></i> Περιγραφή:</b>
					</td>
					<td>
						<input class="form-control input-sm" type="text" id="perigrafi">
					</td>
					<td>	
						<span class="help-inline">*Σύντομη χαρακτηριστική περιγραφή</span>
					</td>
				</tr>
				<tr class="warning">
					<td>
						<b><i class="fa fa-file-excel-o text-danger" aria-hidden="true"></i> Τύπος:</b>
					</td>
					<td>
						<select class="form-control input-sm" id="type" name="type">
							<option value=0>Παλιό</option>
							<option value=1>Ριζ. Ανακαινιζόμενο (Κ.Εν.Α.Κ.)</option>
							<option value=2>Νέο (Κ.Εν.Α.Κ.)</option>
							<option value=3>Ριζ. Ανακαινιζόμενο (Αναθ. Κ.Εν.Α.Κ.)</option>
							<option value=4>Νέο (Αναθ. Κ.Εν.Α.Κ.)</option>
						</select>
					</td>
					<td>	
						<span class="help-inline">*Τύπος κτιρίου (Αναθεωρημένος Κ.Εν.Α.Κ.)</span>						
					</td>
				</tr>
				<tr class="warning">
					<td>
						<b>Σύμπτυξη γραμμών τοίχων:</b>
					</td>
					<td>
						<input type="checkbox" id="symptiksi" name="symptiksi">
					</td>
					<td>	
						<span class="help-inline">*Γίνεται σύμπτυξη σύνθετων δομικών</span>						
					</td>
				</tr>

				
				<tr class="info">
					<td colspan="3">
						<i class="fa fa-globe" aria-hidden="true"></i> Θέση ακινήτου - 	
						<span id="markerStatus"><i>Αλλάξτε τη θέση του δείκτη στο χάρτη</i></span>
					</td>
				</tr>	
				<tr>
					<td>
						<b>
						<i class="fa fa-map-marker text-danger" aria-hidden="true"></i>
						<i class="fa fa-file-excel-o text-danger" aria-hidden="true"></i>  Διεύθυνση:</b>
					</td>
					<td>
						<input class="form-control input-sm" type="text" id="address">
					</td>
					<td rowspan="4">
						<span class="help-inline">Τα δεδομένα εμφανίζονται όπως έχουν αποθηκευτεί στη βάση δεδομένων.<br/> 
						Η τροποποίηση του χάρτη αλλάζει αυτά τα δεδομένα. 
						Εάν η διεύθυνση δεν επιστρέφεται σωστά από το χάρτη μπορείτε να την προσθέσετε και χειροκίνητα.<br/>
						Για διευκόλυνση σημείο εκκίνησης σε νέα μελέτη ορίζεται η έδρα του μελετητή.</span>	
					</td>
				</tr>
				<tr>
					<td>
						<b><i class="fa fa-map-marker text-danger" aria-hidden="true"></i> Γ. μήκος:</b>
					</td>
					<td>
						<input class="form-control input-sm" type="text" class="span4" id="address_x">
					</td>
				</tr>
				<tr>
					<td>
						<b><i class="fa fa-map-marker text-danger" aria-hidden="true"></i> Γ. πλάτος:</b>
					</td>
					<td>
						<input class="form-control input-sm" type="text" class="span4" id="address_y">
					</td>
				</tr>
				<tr>
					<td>
						<b><i class="fa fa-map-marker text-danger" aria-hidden="true"></i> Υψόμετρο:</b>
					</td>
					<td>
						<input class="form-control input-sm" type="text" class="span4" id="address_z">
					</td>
				</tr>
				
				<tr>
					<td>
						<b><i class="fa fa-file-excel-o text-danger" aria-hidden="true"></i> Αρ. κτιρίου:</b>
					</td>
					<td>
						<input class="form-control input-sm" type="text" class="span4" id="ktirio">
					</td>
					<td>
						<span class="help-inline">*Αριθμός κτιρίου</span>
					</td>
				</tr>
				<tr>
					<td>
						<b><i class="fa fa-file-excel-o text-danger" aria-hidden="true"></i> ΚΑΕΚ:</b>
					</td>
					<td>
						<input class="form-control input-sm" type="text" class="span4" id="kaek">
					</td>
					<td>
						<span class="help-inline">*Κωδικός Αριθμός Εθνικού Κτηματολογίου</span>
					</td>
				</tr>
				<tr>
					<td>
						<b><i class="fa fa-file-excel-o text-danger" aria-hidden="true"></i> Τμήμα κτιρίου:</b>
					</td>
					<td>
						<input type="checkbox" id="tmima" name="tmima" onclick="help_tmima();">
					</td>
					<td>
						<span id="tmima_inline"></span>
					</td>
				</tr>
				<script language="JavaScript">
				
				function help_tmima(){
					var tmima = document.getElementById("tmima").checked;
					if(tmima==false){
					document.getElementById("tmima_inline").innerHTML="ΟΧΙ";
					}else{
					document.getElementById("tmima_inline").innerHTML="ΝΑΙ";
					}
				}
				</script>
				
				<tr>
					<td>
						<b><i class="fa fa-file-excel-o text-danger" aria-hidden="true"></i> Τίτλος:</b>
					</td>
					<td>
						<input class="form-control input-sm" type="text" class="span2" id="tmima_ar">
					</td>
					<td>	
						<span class="help-inline">*Αρ. οριζόντιας ή τίτλος</span>
					</td>
				</tr>
				
				</table>
				
				<hr>
				<h4>Θέαση χάρτη</h4>
				<a href="Javascript:newPopup('http://gis.ktimanet.gr/wms/ktbasemap/default.aspx');" role="button" class="btn btn-znx" title="Κτηματολόγιο σε νέο παράθυρο">
				<i class="glyphicon glyphicon-globe"></i> 
				GIS Ktimanet</a>
				<a href="Javascript:newPopup('http://maps.google.com');" role="button" class="btn btn-znx" title="google maps σε νέο παράθυρο">
				<i class="glyphicon glyphicon-globe"></i> 
				Google maps</a>
				<a href="Javascript:newPopup('http://www.bing.com/maps/');" role="button" class="btn btn-znx" title="Bing maps σε νέο παράθυρο">
				<i class="glyphicon glyphicon-globe"></i> 
				Bing maps</a>
				<a href="Javascript:newPopup('http://maps.yahoo.com/');" role="button" class="btn btn-znx" title="Yahoo maps σε νέο παράθυρο">
				<i class="glyphicon glyphicon-globe"></i> 
				Yahoo maps</a>
			</div>
			
			
			
			
			
			<div class="tab-pane" id="tabs-2"> 
				<table class="table table-bordered table-condensed">
				<tr class="info">
					<td colspan="3">
					<i class="fa fa-database" aria-hidden="true"></i> Βιβλιοθήκες μελέτης
					</td>
				</tr>
				<tr>
					<th style="width:20%"><i class="fa fa-file-excel-o text-danger" aria-hidden="true"></i> Χρήση κτιρίου:</th>
					<td style="width:50%">
						<select class="form-control input-sm" id="xrisi" name="xrisi" onchange="showimg_xrisi();">
						<?php
						echo create_select_optionsid("vivliothiki_conditions_building","name");
						?>
						</select>
						<script language="JavaScript">
							document.getElementById("xrisi").selectedIndex=<?php echo $xrisi;?>;
							//showimg_xrisi();
						</script>
					</td>
					<td style="width:30%">
						<span class="help-inline"><span class="widget-user-image" id="img_xrisi"></span></span>
					</td>
				</tr>
				<tr>
					<th><i class="fa fa-map-marker text-danger" aria-hidden="true"></i> Κλιματικά δεδομένα:</th>
					<td>
						<select class="form-control input-sm" id="climate" name="climate" onchange="get_distanse_climate();get_zone();" >
						<?php
						echo create_select_optionsid("vivliothiki_climate_places","place");
						?>
						</select>
						
						<script language="JavaScript">
						document.getElementById("climate").selectedIndex=<?php echo $climate;?>;
						get_distanse_climate();
						
						function get_distanse_climate(){
							var climate_id = document.getElementById('climate').value;
							var address_x = document.getElementById('address_x').value;
							var address_y = document.getElementById('address_y').value;
							//AJAX call
							var xmlhttp=new XMLHttpRequest();
							
							xmlhttp.open("GET","includes/functions_math.php?get_climatedistance=1&climate_id="+climate_id+"&address_x="+address_x+"&address_y="+address_y ,true);
							xmlhttp.send();
							
							xmlhttp.onreadystatechange=function()  {
							if (xmlhttp.readyState==4 && xmlhttp.status==200) {
							var response = xmlhttp.responseText;
							var text = number_format(response,2) + "km - " + number_format(response*1000,2) + "m";
								document.getElementById("apostasi_apo_climate").innerHTML=text;
							}}
						}	
						
						function get_zone(){
							var climate_id = document.getElementById('climate').value;						
							//AJAX call
							var xmlhttp=new XMLHttpRequest();
							
							xmlhttp.open("GET","includes/functions_math.php?get_zoneofclimate=1&climate_id="+climate_id ,true);
							xmlhttp.send();
							
							xmlhttp.onreadystatechange=function()  {
							if (xmlhttp.readyState==4 && xmlhttp.status==200) {
							var zone = xmlhttp.responseText;
								document.getElementById("zone").selectedIndex=zone;
								showimg_zone();
							}}
						}
						
						function get_closer_climate(){
							var address_x = document.getElementById('address_x').value;
							var address_y = document.getElementById('address_y').value;
							//AJAX call
							var xmlhttp=new XMLHttpRequest();
							
							xmlhttp.open("GET","includes/functions_math.php?closer_climate=1&address_x="+address_x+"&address_y="+address_y ,true);
							xmlhttp.send();
							
							xmlhttp.onreadystatechange=function()  {
							if (xmlhttp.readyState==4 && xmlhttp.status==200) {
							var response = JSON.parse(xmlhttp.responseText);
							var climate_id = response[0];
							var place = response[1];
							var emy = response[2];
								document.getElementById("closer_climate").innerHTML=place;
								document.getElementById("climate").selectedIndex=climate_id-1;
								get_distanse_climate();
								get_zone();
								
							var link1="http://www.hnms.gr/hnms/greek/climatology/climatology_region_diagrams_html?dr_city="+emy;
							var link2="http://www.hnms.gr/hnms/greek/forecast/forecast_city_html?dr_city="+emy;
							var link3="http://www.hnms.gr/hnms/greek/components/popup_meteogram_map_html?dr_city="+emy;
								document.getElementById("climatelink1").href=link1;
								document.getElementById("climatelink2").href=link2;
								document.getElementById("climatelink3").href=link3;
							}}
						}
						
						</script>
					</td>
					<td>	
						Κοντινότερη περιοχή:<br/><span id="closer_climate">
						<?php
						$closer_arr = find_closer_climate($address_x, $address_y);
						echo $closer_arr[1];
						?>
						</span><br/>
						Απόσταση επιλεγμένων από το κτίριο:<br/><span id="apostasi_apo_climate"></span>
					</td>
				</tr>
				
				<tr>
					<th><i class="fa fa-map-marker text-danger" aria-hidden="true"></i> Υψόμετρο >500m:</th>
					<td>
						<input type="checkbox" id="height" name="height" onclick="help_height();">
					</td>
					<td>	
						<span id="height_inline"></span>
					</td>
				</tr>
				<script language="JavaScript">
				function help_height(){
					var height = document.getElementById("height").checked;
					if(height==false){
					document.getElementById("height_inline").innerHTML="ΟΧΙ";
					}else{
					document.getElementById("height_inline").innerHTML="ΝΑΙ";
					}
				}
				</script>
				
				<tr>
					<th><i class="fa fa-map-marker text-danger" aria-hidden="true"></i> Κλιματική ζώνη:</th>
					<td>
						<select class="form-control input-sm" id="zone" name="zone" onchange="showimg_zone();">
							<option value=0>Ζώνη Α</option>
							<option value=1>Ζώνη Β</option>
							<option value=2>Ζώνη Γ</option>
							<option value=3>Ζώνη Δ</option>
						</select>		
					</td>
					<td>
						<span class="help-inline"><span class="widget-user-image" id="img_zone"></span></span>
					</td>
				</tr>
				<tr>
					<th>Προσανατολισμός κτιρίου:</th>
					<td>
						<input class="form-control input-sm" type="text" class="span3" id="pros">
					</td>
					<td>
						<a href="#pros_popup" role="button" class="btn btn-warning" data-toggle="modal" title="Προσανατολισμός"><i class="fa fa-compass"></i></a>
					</td>
				</tr>
				
				</table>
				
					<script language="JavaScript">
					function showimg_xrisi(){
						var xrisi = document.getElementById("xrisi").value;
						document.getElementById("img_xrisi").innerHTML = "<img class=\"img-circle\" width=\"128\" src=\"images/xrisi/"+xrisi+".png\" alt=\"Χρήση Image\">";
					}
					function showimg_zone(){
						var zone = document.getElementById("zone").value;
						document.getElementById("img_zone").innerHTML = "<img class=\"img-circle\" width=\"128\" src=\"images/zwni/"+zone+".jpg\" alt=\"Ζώνη Image\">";
					}
					</script>
					
				
				<script language="JavaScript">
				showimg_xrisi();
				showimg_zone();
				</script>
				
			</div>
<!-- ###################### Κρυφό pros_popup για εμφάνιση ###################### -->
<div id="pros_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h4 id="myModalLabel">
		<?php
		echo APPLICATION_NAME." - v.".APPLICATION_VERSION." - Προσανατολισμός κτιρίου";
		?>
		</h4>
	</div>

	<div class="modal-body">
		 <script>
            $(function($) {

                $(".knob").knob({
                    change : function (value) {
                        //document.getElementById("data").innerHTML = value;
                    },
                    release : function (value) {
                        //console.log(this.$.attr('value'));
                        console.log("release : " + value);
                    },
                    cancel : function () {
                        console.log("cancel : ", this);
                    },
                    draw : function () {

                        // "tron" case
                        if(this.$.data('skin') == 'tron') {

                            var a = this.angle(this.cv)  // Angle
                                , sa = this.startAngle          // Previous start angle
                                , sat = this.startAngle         // Start angle
                                , ea                            // Previous end angle
                                , eat = sat + a                 // End angle
                                , r = 1;

                            this.g.lineWidth = this.lineWidth;

                            this.o.cursor
                                && (sat = eat - 0.05)
                                && (eat = eat + 0.05);

                            if (this.o.displayPrevious) {
                                ea = this.startAngle + this.angle(this.v);
                                this.o.cursor
                                    && (sa = ea - 0.05)
                                    && (ea = ea + 0.05);
                                this.g.beginPath();
                                this.g.strokeStyle = this.pColor;
                                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                                this.g.stroke();
                            }

                            this.g.beginPath();
                            this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                            this.g.stroke();

                            this.g.lineWidth = 2;
                            this.g.beginPath();
                            this.g.strokeStyle = this.o.fgColor;
                            this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                            this.g.stroke();

                            return false;
                        }
                    }
                });

                
            });
			function close_pros(){
				var x = document.getElementById("knob").value;
				document.getElementById("pros").value = x;
			}
        </script>
		<div class="knob_div" style="background-color:#222; color:#FFF;">
        <input id="knob" class="knob" data-width="150" data-displayPrevious=true data-fgColor="#ffec03" data-skin="tron" data-cursor=true value="0" data-thickness=".2" data-min="0" data-max="359" onchange="show_data();">
		<br/>
		Χρησιμοποιήστε την ροδέλα του ποντικιού ή αλλάξτε την τιμή.
        </div>
	</div>	
	<div class="modal-footer">			
		<button class="btn" data-dismiss="modal" aria-hidden="true" onclick="close_pros();">ΟΚ</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

	
			<div class="tab-pane" id="tabs-3">
				<table class="table table-bordered">
				<tr class="info">
					<td colspan="2">
					<i class="fa fa-user-circle-o" aria-hidden="true"></i> Ιδιοκτήτης
					</td>
				</tr>
				<tr>
					<td>
						<b><i class="fa fa-file-excel-o text-danger" aria-hidden="true"></i> Ιδιοκτήτης:</b>
					</td>
					<td>
						<input class="form-control input-sm" type="text" class="span5" id="idioktitis" name="idioktitis" value="<?php echo $idioktitis;?>">
					</td>
				</tr>
				
				<tr>
					<td>
						<b><i class="fa fa-file-excel-o text-danger" aria-hidden="true"></i> Ιδιοκτησιακό καθεστώς:</b>
					</td>
					<td>
						<select class="form-control input-sm" id="idio_kathestos" name="idio_kathestos">
							<option value=0>Δημόσιο</option>
							<option value=1>Ιδιωτικό</option>
							<option value=2>Δημόσιο ιδιωτικού ενδιαφέροντος</option>
							<option value=3>Ιδιωτικό δημοσίου ενδιαφέροντος</option>
					</td>
				</tr>
				<script language="JavaScript">
					document.getElementById("idio_kathestos").selectedIndex=<?php echo $idio_kathestos;?>;
				</script>
				
				<tr class="info">
					<td colspan="2">
					<i class="fa fa-phone-square" aria-hidden="true"></i> Υπεύθυνος επικοινωνίας
					</td>
				</tr>
				<tr>
					<td>
						<b><i class="fa fa-file-excel-o text-danger" aria-hidden="true"></i> Είδος υπευθύνου:</b>
					</td>
					<td>
						<select class="form-control input-sm" id="ypeythinos_type" name="ypeythinos_type">
							<option value=0>Ιδιοκτήτης</option>
							<option value=1>Διαχειριστής</option>
							<option value=2>Ενοικιαστής</option>
							<option value=3>Τεχνικός υπεύθυνος</option>
							<option value=4>Άλλο</option>
						</select>	
					</td>
				</tr>
				<script language="JavaScript">
					document.getElementById("ypeythinos_type").selectedIndex=<?php echo $ypeythinos_type;?>;
				</script>
				
				<tr>
					<td><b><i class="fa fa-file-excel-o text-danger" aria-hidden="true"></i> Όνομα υπευθύνου:</b></td>
					<td><input class="form-control input-sm" type="text" id="ypeythinos_name" name="ypeythinos_name" value="<?php echo $ypeythinos_name;?>"></td>
				</tr>
				<tr>
					<td><b><i class="fa fa-file-excel-o text-danger" aria-hidden="true"></i> Τηλέφωνο υπευθύνου:</b></td>
					<td><input class="form-control input-sm" type="text" id="ypeythinos_tel" name="ypeythinos_tel" value="<?php echo $ypeythinos_tel;?>"></td>
				</tr>
				<tr>
					<td><b><i class="fa fa-file-excel-o text-danger" aria-hidden="true"></i> Mail υπευθύνου:</b></td>
					<td><input class="form-control input-sm" type="text" id="ypeythinos_mail" name="ypeythinos_mail" value="<?php echo $ypeythinos_mail;?>"></td>
				</tr>
				</table>
				<hr>
				
				<p class="bg-info">Στοιχεία αδειών</p>
				<div id="oikad_table"></div>
				<div id="oikad_info"></div>
				<script>
				get_oikad();
				
				//Εμφάνιση πίνακα με όλες τις ΘΕΡΜΟΓΕΦΥΡΕΣ για τη ζώνη
				function get_oikad(page){
				page = typeof page !== 'undefined' ? page : 1;
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					
					xmlhttp.open("GET","includes/functions_meleti_gendata.php?getadeies=1&page="+page ,true);
					xmlhttp.send();
					
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						document.getElementById("oikad_table").innerHTML=xmlhttp.responseText;
						document.getElementById('wait').style.display="none";
					}}
				}
				
				//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές ΘΕΡΜΟΓΕΦΥΡΑΣ
			function form_oikad(id,page){
			page = typeof page !== 'undefined' ? page : 1;
			var prefix = "editoikad_";

				if(id==0){
				document.getElementById(prefix+"condition").value = "";
				document.getElementById(prefix+"desc").value = "";
				document.getElementById(prefix+"datasource").value = "";
				document.getElementById(prefix+"yearpermit").value = "";
				document.getElementById(prefix+"year").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_oikad&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
							document.getElementById(prefix+"condition").value = arr["condition"];							
							document.getElementById(prefix+"desc").value = arr["desc"];
							document.getElementById(prefix+"datasource").value = arr["datasource"];
							document.getElementById(prefix+"yearpermit").value = arr["yearpermit"];
							document.getElementById(prefix+"year").value = arr["year"];
	
						document.getElementById('wait').style.display="none";
					}}
					
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_oikad('+id+','+page+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_oikad('+id+','+page+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη';
				}
				document.getElementById("edit_button_oikad").innerHTML = button;
				document.getElementById("edit_header_oikad").innerHTML = edit_header;
				$("#modal_form_oikad").modal("show");
			}
			
			
			function formdel_oikad(id,page){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_oikad('+id+','+page+');">Διαγραφή</button>';
				document.getElementById("del_button_oikad").innerHTML = button;
				$("#modal_del_oikad").modal("show");
			}
			
			//Υποβολή της φόρμας για ΘΕΡΜΟΓΕΦΥΡΑ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_oikad(id,page){
			var prefix = "editoikad_";
				var condition = document.getElementById(prefix+"condition").value;
				var desc = document.getElementById(prefix+"desc").value;
				var datasource = document.getElementById(prefix+"datasource").value;
				var yearpermit = document.getElementById(prefix+"yearpermit").value;
				var year = document.getElementById(prefix+"year").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_oikad";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+condition+","+desc+","+datasource+","+yearpermit+","+year;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("oikad_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_oikad(page);
				}}
			}
			
			//Διαγραφή ΟΙΚΟΔΟΜΙΚΩΝ ΑΔΕΙΩΝ
			function del_oikad(id,page){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_oikad&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("oikad_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_oikad(page);
				}}
			}
				
				</script>
				
<!-- ###################### Κρυφό modal_form_oikad για εμφάνιση ###################### -->
<div id="modal_form_oikad" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_oikad"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info">
			<td width=50%>Παράμετρος</td>
			<td width=50%>Τιμή</td>
		</tr>
		<tr>
			<td>Κατάσταση κατασκευής</td>
			<td><input type="text" class="form-control input-sm" id="editoikad_condition"></td>
		</tr>
		<tr>
			<td>Σύντομη περιγραφή</td>
			<td><input type="text" class="form-control input-sm" id="editoikad_desc"></td>
		</tr>
		<tr>
			<td>Πηγή</td>
			<td><input type="text" class="form-control input-sm" id="editoikad_datasource"></td>
		</tr>
		<tr>
			<td>Έτος οικ. άδειας</td>
			<td><input type="text" class="form-control input-sm" id="editoikad_yearpermit"></td>
		</tr>
		<tr>
			<td>Έτος</td>
			<td><input type="text" class="form-control input-sm" id="editoikad_year"></td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_oikad"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_oikad για εμφάνιση ###################### -->
<div id="modal_del_oikad" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή άδειας</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_oikad"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
				
				<hr>
				
					<div class="container-fluid">
				    <div class="row">
					<p class="bg-info">Πηγές δεδομένων</p>
						<div class="col-md-2">
						<div class="checkbox">
						<label><input type="checkbox" id="pea_datasource0">Αρχιτεκτονικά σχέδια</label>
						<label><input type="checkbox" id="pea_datasource1">Η/Μ σχέδια</label>
						</div>
						</div>
						<div class="col-md-3">
						<div class="checkbox">
						<label><input type="checkbox" id="pea_datasource2">Φύλλο Συντήρησης Λέβητα</label>
						<label><input type="checkbox" id="pea_datasource3">Φύλλο Συντήρησης Συστήματος Κλιματισμού</label>
						<label><input type="checkbox" id="pea_datasource4">Τιμολόγια ενεργειακών καταναλώσεων</label>
						<label><input type="checkbox" id="pea_datasource9">Δελτία αποστολής ή τιμολόγια αγοράς υλικών</label>
						</div>
						</div>
						<div class="col-md-4">
						<div class="checkbox">
						<label><input type="checkbox" id="pea_datasource7">Φωτομετρικά αρχεία φωτιστικών σωμάτων, μελέτη φωτισμού</label>
						<label><input type="checkbox" id="pea_datasource6">Έντυπο Ενεργειακής Επιθεώρησης Συστήματος Θέρμανσης</label>
						<label><input type="checkbox" id="pea_datasource5">Έντυπο Ενεργειακής Επιθεώρησης Συστήματος Κλιματισμού</label>
						<label><input type="checkbox" id="pea_datasource8">Πληροφορίες από Ιδιοκτήτη / Διαχειριστή</label>
						</div>
						</div>
					</div>
					</div>
					<hr>
					
					<div class="container-fluid">
				    <div class="row">
						<p class="bg-info">Συνθήκες άνεσης</p>
						<div class="row">
							<div class="col-md-3">
								<label><input type="checkbox" id="pea_synthikes0">Συνθήκες θερμικής άνεσης</label>
							</div>
							<div class="col-md-3">
								<label><input type="checkbox" id="pea_synthikes1">Συνθήκες ακουστικής άνεσης</label>
							</div>
							<div class="col-md-3">
								<label><input type="checkbox" id="pea_synthikes2">Συνθήκες οπτικής άνεσης</label>
							</div>
							<div class="col-md-3">
								<label><input type="checkbox" id="pea_synthikes3">Ποιότητα εσωτερικού αέρα</label>
							</div>
						</div>
					</div>
					<hr>
					
					<div class="row">
					<p class="bg-info">Γενικά στοιχεία κτιρίου</p>
					<div class="row">
						<div class="col-md-4">
							<div class="input-group">
								<span class="input-group-addon">Αριθμός ορόφων:</span>
								<input class="form-control input-sm" id="pea_levels">
							</div>
						</div>
						<div class="col-md-4">	
							<div class="input-group">
								<span class="input-group-addon">Ύψος τυπικού ορόφου:</span>
								<input class="form-control input-sm" id="pea_typical_h">
							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
								<span class="input-group-addon">Ύψος ισογείου:</span>
								<input class="form-control input-sm" id="pea_floor_h">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="input-group">
								<span class="input-group-addon">Έκθεση κτιρίου:</span>
								<select class="form-control input-sm" id="pea_ekthesi">
									<option value=0>Εκτεθειμένο</option>
									<option value=1>Ενδιάμεσο</option>
									<option value=3>Προστατευμένο</option>
								</select>
							</div>
						</div>
					</div>
					</div>
					
					</div>
				
				<br/><br/>
			</div>
				
		

			<div class="tab-pane" id="tabs-4">
			<div class="tabbable tabs-left"> <!-- Only required for left/right tabs -->
					<ul class="nav nav-pills">
					<li class="active"><a href="#bsys1" data-toggle="tab"><i class="fa fa-industry"></i> ΣΗΘ</a></li>
					<li><a href="#bsys2" data-toggle="tab"><i class="fa fa-paper-plane-o"></i> Φ/Β</a></li>
					<li><a href="#bsys3" data-toggle="tab"><i class="fa fa-flag-checkered"></i> Ανεμογεννήτριες</a></li>
					<li><a href="#bsys4" data-toggle="tab"><i class="fa fa-bolt"></i> Καταναλώσεις</a></li>
					<li><a href="#bsys5" data-toggle="tab"><i class="fa fa-shower"></i> Νερό/Λύματα</a></li>
					<li><a href="#bsys6" data-toggle="tab"><i class="fa fa-sort-amount-desc"></i> Ανελκυστήρες</a></li>
					</ul>
					
					<div class="tab-content">
						<div class="tab-pane active" id="bsys1"><!-- ΣΗΘ -->
				<br/>
				<div id="sith_table"></div>
				<div id="sith_info"></div>
				<script>
				get_sith();
				
				//Εμφάνιση πίνακα με όλες τις ΘΕΡΜΟΓΕΦΥΡΕΣ για τη ζώνη
				function get_sith(page){
				page = typeof page !== 'undefined' ? page : 1;
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					
					xmlhttp.open("GET","includes/functions_meleti_gendata.php?getsith=1&page="+page ,true);
					xmlhttp.send();
					
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						document.getElementById("sith_table").innerHTML=xmlhttp.responseText;
						document.getElementById('wait').style.display="none";
					}}
				}
				
				//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές ΘΕΡΜΟΓΕΦΥΡΑΣ
			function form_sith(id,page){
			page = typeof page !== 'undefined' ? page : 1;
			var prefix = "editsith_";

				if(id==0){
				document.getElementById(prefix+"type").selectedIndex = 0;
				document.getElementById(prefix+"pigi").selectedIndex = 0;
				document.getElementById(prefix+"n_elec").value = "";
				document.getElementById(prefix+"n_therm").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_sith&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
							document.getElementById(prefix+"type").value = arr["type"];							
							document.getElementById(prefix+"pigi").value = arr["pigi"];
							document.getElementById(prefix+"n_elec").value = arr["n_elec"];
							document.getElementById(prefix+"n_therm").value = arr["n_therm"];
	
						document.getElementById('wait').style.display="none";
					}}
					
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_sith('+id+','+page+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_sith('+id+','+page+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη';
				}
				document.getElementById("edit_button_sith").innerHTML = button;
				document.getElementById("edit_header_sith").innerHTML = edit_header;
				$("#modal_form_sith").modal("show");
			}
			
			
			function formdel_sith(id,page){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_sith('+id+','+page+');">Διαγραφή</button>';
				document.getElementById("del_button_sith").innerHTML = button;
				$("#modal_del_sith").modal("show");
			}
			
			//Υποβολή της φόρμας για ΘΕΡΜΟΓΕΦΥΡΑ
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_sith(id,page){
			var prefix = "editsith_";
				var type = document.getElementById(prefix+"type").value;
				var pigi = document.getElementById(prefix+"pigi").value;
				var n_elec = document.getElementById(prefix+"n_elec").value;
				var n_therm = document.getElementById(prefix+"n_therm").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_sith";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+type+","+pigi+","+n_elec+","+n_therm;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("sith_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_sith(page);
				}}
			}
			
			//Διαγραφή ΟΙΚΟΔΟΜΙΚΩΝ ΑΔΕΙΩΝ
			function del_sith(id,page){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_sith&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("sith_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_sith(page);
				}}
			}
				
				</script>
				
<!-- ###################### Κρυφό modal_form_sith για εμφάνιση ###################### -->
<div id="modal_form_sith" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_sith"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info">
			<td width=50%>Παράμετρος</td>
			<td width=50%>Τιμή</td>
		</tr>
		<tr>
			<td>Τύπος</td>
			<td>
				<select class="form-control input-sm" id="editsith_type">
				<option value=0>Κυψέλες καυσίμου</option>
				<option value=1>Μηχανή Stirling</option>
				<option value=2>Μηχανή OTTO</option>
				<option value=3>Μηχανή DIESEL</option>
				<option value=4>Μικροτουρμπίνα</option>
				<option value=5>Ατμοστρόβιλος απομάστευσης</option>
				<option value=6>Αεριοστρόβιλος με λέβητα ανάκτησης</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Πηγή</td>
			<td>
				<select class="form-control input-sm" id="editsith_pigi">
				<option value=0>Υγραέριο (LPG)</option>
				<option value=1>Φυσικο αέριο</option>
				<option value=2>Ηλεκτρισμός</option>
				<option value=3>Πετρέλαιο θέρμανσης</option>
				<option value=4>Πετρέλαιο κίνησης</option>
				<option value=5>Τηλεθέρμανση (ΑΠΕ)</option>
				<option value=6>Τηλεθέρμανση (ΔΕΗ)</option>
				<option value=7>Βιομάζα</option>
				<option value=8>Βιομάζα τυποποιημένη</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Βαθμός ηλεκτρικής απόδοσης συστήματος (-)</td>
			<td>
				<input type="text" class="form-control input-sm" id="editsith_n_elec">
			</td>
		</tr>
		<tr>
			<td>Βαθμός θερμικής απόδοσης συστήματος (-)</td>
			<td>
				<input type="text" class="form-control input-sm" id="editsith_n_therm">
			</td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_sith"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_sith για εμφάνιση ###################### -->
<div id="modal_del_sith" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή ΣΗΘ</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_sith"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
						</div><!-- ΣΗΘ -->
						
						<div class="tab-pane" id="bsys2"><!-- Φ/Β -->
							<br/>
				<div id="pv_table"></div>
				<div id="pv_info"></div>
				<script>
				get_pv();
				
				//Εμφάνιση πίνακα
				function get_pv(page){
				page = typeof page !== 'undefined' ? page : 1;
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					
					xmlhttp.open("GET","includes/functions_meleti_gendata.php?getpv=1&page="+page ,true);
					xmlhttp.send();
					
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						document.getElementById("pv_table").innerHTML=xmlhttp.responseText;
						document.getElementById('wait').style.display="none";
					}}
				}
				
				//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές
			function form_pv(id,page){
			page = typeof page !== 'undefined' ? page : 1;
			var prefix = "editpv_";

				if(id==0){
				document.getElementById(prefix+"type").selectedIndex = 0;
				document.getElementById(prefix+"n").value = "";
				document.getElementById(prefix+"e").value = "";
				document.getElementById(prefix+"p").value = "";
				document.getElementById(prefix+"g").value = "";
				document.getElementById(prefix+"b").value = "";
				document.getElementById(prefix+"f_s").value = "";
				document.getElementById(prefix+"connection").value = 0;
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_pv&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
							document.getElementById(prefix+"type").value = arr["type"];							
							document.getElementById(prefix+"n").value = arr["n"];
							document.getElementById(prefix+"e").value = arr["e"];
							document.getElementById(prefix+"p").value = arr["p"];
							document.getElementById(prefix+"g").value = arr["g"];
							document.getElementById(prefix+"b").value = arr["b"];
							document.getElementById(prefix+"f_s").value = arr["f_s"];
							document.getElementById(prefix+"connection").value = arr["connection"];
	
						document.getElementById('wait').style.display="none";
					}}
					
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_pv('+id+','+page+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_pv('+id+','+page+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη';
				}
				document.getElementById("edit_button_pv").innerHTML = button;
				document.getElementById("edit_header_pv").innerHTML = edit_header;
				$("#modal_form_pv").modal("show");
			}
			
			
			function formdel_pv(id,page){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_pv('+id+','+page+');">Διαγραφή</button>';
				document.getElementById("del_button_pv").innerHTML = button;
				$("#modal_del_pv").modal("show");
			}
			
			//Υποβολή της φόρμας
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_pv(id,page){
			var prefix = "editpv_";
				var type = document.getElementById(prefix+"type").value;
				var n = document.getElementById(prefix+"n").value;
				var e = document.getElementById(prefix+"e").value;
				var p = document.getElementById(prefix+"p").value;
				var g = document.getElementById(prefix+"g").value;
				var b = document.getElementById(prefix+"b").value;
				var f_s = document.getElementById(prefix+"f_s").value;
				var connection = document.getElementById(prefix+"connection").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_pv";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+type+","+n+","+e+","+p+","+g+","+b+","+f_s+","+connection;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("pv_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_pv(page);
				}}
			}
			
			//Διαγραφή
			function del_pv(id,page){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_pv&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("pv_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_pv(page);
				}}
			}
				
				</script>
				
<!-- ###################### Κρυφό modal_form_pv για εμφάνιση ###################### -->
<div id="modal_form_pv" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_pv"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info">
			<td width=50%>Παράμετρος</td>
			<td width=50%>Τιμή</td>
		</tr>
		<tr>
			<td>Τύπος</td>
			<td>
				<select class="form-control input-sm" id="editpv_type">
					<option value=0>Μονοκρυσταλλικό</option>
					<option value=1>Πολυκρυσταλλικό</option>
					<option value=2>Λεπτού υμένα άμορφο a-S</option>
					<option value=3>Λεπτού υμένα μικρομορφικό μ-Si</option>
					<option value=4>Λεπτού υμένα CIS-CIGS</option>
					<option value=5>Λεπτού υμένα Cd-Te</option>
					<option value=6>Τριπλής επαφής (Triple junction)</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Συντελεστής αξιοποίησης ηλιακής ακτινοβολίας (-)</td>
			<td>
				<input type="text" class="form-control input-sm" id="editpv_n">
			</td>
		</tr>
		<tr>
			<td>Επιφάνεια (m<sup>2</sup>)</td>
			<td>
				<input type="text" class="form-control input-sm" id="editpv_e">
			</td>
		</tr>
		<tr>
			<td>Ισχύς (kW)</td>
			<td>
				<input type="text" class="form-control input-sm" id="editpv_p">
			</td>
		</tr>
		<tr>
			<td>Προσανατολισμός</td>
			<td>
				<input type="text" class="form-control input-sm" id="editpv_g">
			</td>
		</tr>
		<tr>
			<td>Κλίση</td>
			<td>
				<input type="text" class="form-control input-sm" id="editpv_b">
			</td>
		</tr>
		<tr>
			<td>F_s</td>
			<td>
				<input type="text" class="form-control input-sm" id="editpv_f_s">
			</td>
		</tr>
		<tr>
			<td>Σύνδεση</td>
			<td>
				<select class="form-control input-sm" id="editpv_connection">
					<option value=0>Με συμψηφισμό</option>
					<option value=1>Χωρίς συμψηφισμό</option>
				</select>
			</td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_pv"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_pv για εμφάνιση ###################### -->
<div id="modal_del_pv" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή Φ/Β</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_pv"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
						</div><!-- Φ/Β -->
						
						<div class="tab-pane" id="bsys3"><!-- Ανεμογεννήτριες -->
						<br/>
				<div id="windturbine_table"></div>
				<div id="windturbine_info"></div>
				<script>
				get_windturbine();
				
				//Εμφάνιση πίνακα
				function get_windturbine(page){
				page = typeof page !== 'undefined' ? page : 1;
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					
					xmlhttp.open("GET","includes/functions_meleti_gendata.php?getwindturbine=1&page="+page ,true);
					xmlhttp.send();
					
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						document.getElementById("windturbine_table").innerHTML=xmlhttp.responseText;
						document.getElementById('wait').style.display="none";
					}}
				}
				
				//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές
			function form_windturbine(id,page){
			page = typeof page !== 'undefined' ? page : 1;
			var prefix = "editwindturbine_";

				if(id==0){
				document.getElementById(prefix+"type").selectedIndex = 0;
				document.getElementById(prefix+"p").value = "";
				document.getElementById(prefix+"n").value = "";
				document.getElementById(prefix+"xwros").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_anemogenitries&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
							document.getElementById(prefix+"type").value = arr["type"];							
							document.getElementById(prefix+"p").value = arr["p"];
							document.getElementById(prefix+"n").value = arr["n"];
							document.getElementById(prefix+"xwros").value = arr["xwros"];
	
						document.getElementById('wait').style.display="none";
					}}
					
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_windturbine('+id+','+page+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_windturbine('+id+','+page+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη';
				}
				document.getElementById("edit_button_windturbine").innerHTML = button;
				document.getElementById("edit_header_windturbine").innerHTML = edit_header;
				$("#modal_form_windturbine").modal("show");
			}
			
			
			function formdel_windturbine(id,page){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_windturbine('+id+','+page+');">Διαγραφή</button>';
				document.getElementById("del_button_windturbine").innerHTML = button;
				$("#modal_del_windturbine").modal("show");
			}
			
			//Υποβολή της φόρμας
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_windturbine(id,page){
			var prefix = "editwindturbine_";
				var type = document.getElementById(prefix+"type").value;
				var p = document.getElementById(prefix+"p").value;
				var n = document.getElementById(prefix+"n").value;
				var xwros = document.getElementById(prefix+"xwros").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_anemogenitries";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+type+","+p+","+n+","+xwros;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("windturbine_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_windturbine(page);
				}}
			}
			
			//Διαγραφή
			function del_windturbine(id,page){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_anemogenitries&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("windturbine_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_windturbine(page);
				}}
			}
				
				</script>
				
<!-- ###################### Κρυφό modal_form_windturbine για εμφάνιση ###################### -->
<div id="modal_form_windturbine" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_windturbine"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info">
			<td width=50%>Παράμετρος</td>
			<td width=50%>Τιμή</td>
		</tr>
		<tr>
			<td>Τύπος</td>
			<td>
				<select class="form-control input-sm" id="editwindturbine_type">
				<option value=0>Αυτόνομο</option>
				<option value=1>Διασυνδεδεμένο</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Ισχύς (KW)</td>
			<td>
				<input type="text" class="form-control input-sm" id="editwindturbine_p">
			</td>
		</tr>
		<tr>
			<td>Συντελεστής ισχύος (-)</td>
			<td>
				<input type="text" class="form-control input-sm" id="editwindturbine_n">
			</td>
		</tr>
		<tr>
			<td>Χώρος τοποθέτησης</td>
			<td>
				<input type="text" class="form-control input-sm" id="editwindturbine_xwros">
			</td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_windturbine"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_windturbine για εμφάνιση ###################### -->
<div id="modal_del_windturbine" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή Ανεμογεννήτριας</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_windturbine"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->	
						</div><!-- Ανεμογεννήτριες -->
						
						<div class="tab-pane" id="bsys4"><!-- Καταναλώσεις -->
						<br/>
				<div id="katanalwseis_table"></div>
				<div id="katanalwseis_info"></div>
				<script>
				get_katanalwseis();
				
				//Εμφάνιση πίνακα
				function get_katanalwseis(page){
				page = typeof page !== 'undefined' ? page : 1;
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					
					xmlhttp.open("GET","includes/functions_meleti_gendata.php?getkatanalwseis=1&page="+page ,true);
					xmlhttp.send();
					
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						document.getElementById("katanalwseis_table").innerHTML=xmlhttp.responseText;
						document.getElementById('wait').style.display="none";
					}}
				}
				
				//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές
			function form_katanalwseis(id,page){
			page = typeof page !== 'undefined' ? page : 1;
			var prefix = "editkatanalwseis_";

				if(id==0){
				document.getElementById(prefix+"pigi").selectedIndex = 0;
				document.getElementById(prefix+"therm").checked=false;
				document.getElementById(prefix+"cold").checked=false;
				document.getElementById(prefix+"air").checked=false;
				document.getElementById(prefix+"znx").checked=false;
				document.getElementById(prefix+"lights").checked=false;
				document.getElementById(prefix+"syskeyes").checked=false;
				document.getElementById(prefix+"katanalwsi").value = "";
				document.getElementById(prefix+"periodos").value = "01/01/2017 - 31/12/2017";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_katanalwseis&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
							document.getElementById(prefix+"pigi").value = arr["pigi"];
							if(arr["therm"]==1){
								document.getElementById(prefix+"therm").checked=true;
							}else{
								document.getElementById(prefix+"therm").checked=false;
							}
							if(arr["cold"]==1){
								document.getElementById(prefix+"cold").checked=true;
							}else{
								document.getElementById(prefix+"cold").checked=false;
							}
							if(arr["air"]==1){
								document.getElementById(prefix+"air").checked=true;
							}else{
								document.getElementById(prefix+"air").checked=false;
							}
							if(arr["znx"]==1){
								document.getElementById(prefix+"znx").checked=true;
							}else{
								document.getElementById(prefix+"znx").checked=false;
							}
							if(arr["lights"]==1){
								document.getElementById(prefix+"lights").checked=true;
							}else{
								document.getElementById(prefix+"lights").checked=false;
							}
							if(arr["syskeyes"]==1){
								document.getElementById(prefix+"syskeyes").checked=true;
							}else{
								document.getElementById(prefix+"syskeyes").checked=false;
							}
							document.getElementById(prefix+"katanalwsi").value = arr["katanalwsi"];
							document.getElementById(prefix+"periodos").value = arr["periodos"];
	
						document.getElementById('wait').style.display="none";
					}}
					
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_katanalwseis('+id+','+page+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_katanalwseis('+id+','+page+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη';
				}
				document.getElementById("edit_button_katanalwseis").innerHTML = button;
				document.getElementById("edit_header_katanalwseis").innerHTML = edit_header;
				$("#modal_form_katanalwseis").modal("show");
			}
			
			
			function formdel_katanalwseis(id,page){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_katanalwseis('+id+','+page+');">Διαγραφή</button>';
				document.getElementById("del_button_katanalwseis").innerHTML = button;
				$("#modal_del_katanalwseis").modal("show");
			}
			
			//Υποβολή της φόρμας
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_katanalwseis(id,page){
			var prefix = "editkatanalwseis_";
				var pigi = document.getElementById(prefix+"pigi").value;
					var therm;
					if(document.getElementById(prefix+"therm").checked==true){
						therm=1;
					}else{
						therm=0;
					}
					var cold;
					if(document.getElementById(prefix+"cold").checked==true){
						cold=1;
					}else{
						cold=0;
					}
					var air;
					if(document.getElementById(prefix+"air").checked==true){
						air=1;
					}else{
						air=0;
					}
					var znx;
					if(document.getElementById(prefix+"znx").checked==true){
						znx=1;
					}else{
						znx=0;
					}
					var lights;
					if(document.getElementById(prefix+"lights").checked==true){
						lights=1;
					}else{
						lights=0;
					}
					var syskeyes;
					if(document.getElementById(prefix+"syskeyes").checked==true){
						syskeyes=1;
					}else{
						syskeyes=0;
					}
					
				var katanalwsi = document.getElementById(prefix+"katanalwsi").value;
				var periodos = document.getElementById(prefix+"periodos").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_katanalwseis";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+pigi+","+therm+","+cold+","+air+","+znx+","+lights+","+syskeyes+","+katanalwsi+","+periodos;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("katanalwseis_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_katanalwseis(page);
				}}
			}
			
			//Διαγραφή
			function del_katanalwseis(id,page){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_katanalwseis&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("katanalwseis_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_katanalwseis(page);
				}}
			}
				
				</script>
				
<!-- ###################### Κρυφό modal_form_katanalwseis για εμφάνιση ###################### -->
<div id="modal_form_katanalwseis" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_katanalwseis"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info">
			<td width=50%>Παράμετρος</td>
			<td width=50%>Τιμή</td>
		</tr>
		<tr>
			<td>Τύπος</td>
			<td>
				<select class="form-control input-sm" id="editkatanalwseis_pigi" onchange="katanalwseis_changeunits();">
				<option value=0>Ηλεκτρική</option>
				<option value=1>Πετρέλαιο θέρμανσης</option>
				<option value=2>Πετρέλαιο κίνησης</option>
				<option value=3>Φυσικο αέριο</option>
				<option value=4>Υγραέριο</option>
				<option value=5>Βιομάζα</option>
				<option value=6>Τηλεθέρμανση</option>
				</select>
			</td>
		</tr>
		<script>
			function katanalwseis_changeunits(){
				var x = document.getElementById("editkatanalwseis_pigi").value;
				var array=["kWh","lt","lt","Nm<sup>3</sup>","Nm<sup>3</sup>","Kg","kWh"];
				document.getElementById("katanalwseis_units").innerHTML = array[x];
			}
		</script>
		<tr>
			<td>Θέρμανση</td>
			<td>
				<div class="checkbox">
				<label>
					<input type="checkbox" id="editkatanalwseis_therm">
				Θέρμανση
				</label>
				</div>
			</td>
		</tr>
		<tr>
			<td>Ψύξη</td>
			<td>
				<div class="checkbox">
				<label>
					<input type="checkbox" id="editkatanalwseis_cold">
				Ψύξη
				</label>
				</div>
			</td>
		</tr>
		<tr>
			<td>Αερισμός</td>
			<td>
				<div class="checkbox">
				<label>
					<input type="checkbox" id="editkatanalwseis_air">
				Αερισμός
				</label>
				</div>
			</td>
		</tr>
		<tr>
			<td>ΖΝΧ</td>
			<td>
				<div class="checkbox">
				<label>
					<input type="checkbox" id="editkatanalwseis_znx">
				ΖΝΧ
				</label>
				</div>
			</td>
		</tr>
		<tr>
			<td>Φωτισμός</td>
			<td>
				<div class="checkbox">
				<label>
					<input type="checkbox" id="editkatanalwseis_lights">
				Φωτισμός
				</label>
				</div>
			</td>
		</tr>
		<tr>
			<td>Συσκευές</td>
			<td>
				<div class="checkbox">
				<label>
					<input type="checkbox" id="editkatanalwseis_syskeyes">
				Συσκευές
				</label>
				</div>
			</td>
		</tr>
		<tr>
			<td>Κατανάλωση</td>
			<td>
				<div class="input-group">
					<span class="input-group-addon">
						<span class="tip-top" href="#" title="Πραγματική κατανάλωση με βάση λογαριασμό.">
						<i class="fa fa-battery-half" aria-hidden="true"></i> Κατανάλωση</span>
					</span>
					<input type="text" class="form-control input-sm" id="editkatanalwseis_katanalwsi">
					<span class="input-group-addon" id="katanalwseis_units">kWh</span>
				</div>
			</td>
		</tr>
		<tr>
			<td>Περίοδος</td>
			<td>
				<input type="text" class="form-control input-sm" id="editkatanalwseis_periodos" value="01/01/2017 - 31/12/2017">
			</td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_katanalwseis"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_katanalwseis για εμφάνιση ###################### -->
<div id="modal_del_katanalwseis" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή Κατανάλωσης</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_katanalwseis"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->	
						</div><!-- Καταναλώσεις -->
						
						<div class="tab-pane" id="bsys5"><!-- Νερό/Λύματα -->
						<br/>
				<div id="ydreysi_table"></div>
				<div id="ydreysi_info"></div>
				<script>
				get_ydreysi();
				
				//Εμφάνιση πίνακα
				function get_ydreysi(page){
				page = typeof page !== 'undefined' ? page : 1;
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					
					xmlhttp.open("GET","includes/functions_meleti_gendata.php?getydreysi=1&page="+page ,true);
					xmlhttp.send();
					
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						document.getElementById("ydreysi_table").innerHTML=xmlhttp.responseText;
						document.getElementById('wait').style.display="none";
					}}
				}
				
				//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές
			function form_ydreysi(id,page){
			page = typeof page !== 'undefined' ? page : 1;
			var prefix = "editydreysi_";

				if(id==0){
				document.getElementById(prefix+"type").selectedIndex = 0;
				document.getElementById(prefix+"n").value = "";
				document.getElementById(prefix+"p").value = "";
				document.getElementById(prefix+"t").value = "";
				document.getElementById(prefix+"s").checked=false;
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_ydreysi&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
							document.getElementById(prefix+"type").value = arr["type"];							
							document.getElementById(prefix+"n").value = arr["n"];
							document.getElementById(prefix+"p").value = arr["p"];
							document.getElementById(prefix+"t").value = arr["t"];
							if(arr["s"]==1){
								document.getElementById(prefix+"s").checked=true;
							}else{
								document.getElementById(prefix+"s").checked=false;
							}
	
						document.getElementById('wait').style.display="none";
					}}
					
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_ydreysi('+id+','+page+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_ydreysi('+id+','+page+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη';
				}
				document.getElementById("edit_button_ydreysi").innerHTML = button;
				document.getElementById("edit_header_ydreysi").innerHTML = edit_header;
				$("#modal_form_ydreysi").modal("show");
			}
			
			
			function formdel_ydreysi(id,page){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_ydreysi('+id+','+page+');">Διαγραφή</button>';
				document.getElementById("del_button_ydreysi").innerHTML = button;
				$("#modal_del_ydreysi").modal("show");
			}
			
			//Υποβολή της φόρμας
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_ydreysi(id,page){
			var prefix = "editydreysi_";
				var type = document.getElementById(prefix+"type").value;
				var n = document.getElementById(prefix+"n").value;
				var p = document.getElementById(prefix+"p").value;
				var t = document.getElementById(prefix+"t").value;
				var s;
					if(document.getElementById(prefix+"s").checked==true){
						s=1;
					}else{
						s=0;
					}
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_ydreysi";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+type+","+n+","+p+","+t+","+s;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("ydreysi_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_ydreysi(page);
				}}
			}
			
			//Διαγραφή
			function del_ydreysi(id,page){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_ydreysi&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("ydreysi_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_ydreysi(page);
				}}
			}
				
				</script>
				
<!-- ###################### Κρυφό modal_form_ydreysi για εμφάνιση ###################### -->
<div id="modal_form_ydreysi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_ydreysi"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info">
			<td width=50%>Παράμετρος</td>
			<td width=50%>Τιμή</td>
		</tr>
		<tr>
			<td>Τύπος δικτύου</td>
			<td>
				<select class="form-control input-sm" id="editydreysi_type">
				<option value=0>Ύδρευση</option>
				<option value=1>Άρδευση</option>
				<option value=2>Αποχέτευση</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Αριθμός</td>
			<td>
				<input type="text" class="form-control input-sm" id="editydreysi_n">
			</td>
		</tr>
		<tr>
			<td>Ισχύς (kW)</td>
			<td>
				<input type="text" class="form-control input-sm" id="editydreysi_p">
			</td>
		</tr>
		<tr>
			<td>Χρόνος λειτουργίας (hr)</td>
			<td>
				<input type="text" class="form-control input-sm" id="editydreysi_t">
			</td>
		</tr>
		<tr>
			<td>Ρυθμ. στροφών</td>
			<td>
				<div class="checkbox">
				<label>
					<input type="checkbox" id="editydreysi_s">
				Ρυθμ. στροφών
				</label>
				</div>
			</td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_ydreysi"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_ydreysi για εμφάνιση ###################### -->
<div id="modal_del_ydreysi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή Νερό/αποχέτευση</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_ydreysi"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->	
						</div><!-- Νερό/Λύματα -->
						
						<div class="tab-pane" id="bsys6"><!-- Ανελκυστήρες -->
						<br/>
				<div id="anelkystires_table"></div>
				<div id="anelkystires_info"></div>
				<script>
				get_anelkystires();
				
				//Εμφάνιση πίνακα
				function get_anelkystires(page){
				page = typeof page !== 'undefined' ? page : 1;
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					
					xmlhttp.open("GET","includes/functions_meleti_gendata.php?getanelkystires=1&page="+page ,true);
					xmlhttp.send();
					
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						document.getElementById("anelkystires_table").innerHTML=xmlhttp.responseText;
						document.getElementById('wait').style.display="none";
					}}
				}
				
				//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές
			function form_anelkystires(id,page){
			page = typeof page !== 'undefined' ? page : 1;
			var prefix = "editanelkystires_";

				if(id==0){
				document.getElementById(prefix+"type").selectedIndex = 0;
				document.getElementById(prefix+"n").value = "";
				document.getElementById(prefix+"p").value = "";
				document.getElementById(prefix+"t").value = "";
				document.getElementById(prefix+"a").checked=false;
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_anelkystires&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
							document.getElementById(prefix+"type").value = arr["type"];							
							document.getElementById(prefix+"n").value = arr["n"];
							document.getElementById(prefix+"p").value = arr["p"];
							document.getElementById(prefix+"t").value = arr["t"];
							if(arr["a"]==1){
								document.getElementById(prefix+"a").checked=true;
							}else{
								document.getElementById(prefix+"a").checked=false;
							}
	
						document.getElementById('wait').style.display="none";
					}}
					
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_anelkystires('+id+','+page+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_anelkystires('+id+','+page+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη';
				}
				document.getElementById("edit_button_anelkystires").innerHTML = button;
				document.getElementById("edit_header_anelkystires").innerHTML = edit_header;
				$("#modal_form_anelkystires").modal("show");
			}
			
			
			function formdel_anelkystires(id,page){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_anelkystires('+id+','+page+');">Διαγραφή</button>';
				document.getElementById("del_button_anelkystires").innerHTML = button;
				$("#modal_del_anelkystires").modal("show");
			}
			
			//Υποβολή της φόρμας
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_anelkystires(id,page){
			var prefix = "editanelkystires_";
				var type = document.getElementById(prefix+"type").value;
				var n = document.getElementById(prefix+"n").value;
				var p = document.getElementById(prefix+"p").value;
				var t = document.getElementById(prefix+"t").value;
				var a;
					if(document.getElementById(prefix+"a").checked==true){
						a=1;
					}else{
						a=0;
					}
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_anelkystires";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+type+","+n+","+p+","+t+","+a;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("anelkystires_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_anelkystires(page);
				}}
			}
			
			//Διαγραφή
			function del_anelkystires(id,page){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_anelkystires&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("anelkystires_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_anelkystires(page);
				}}
			}
				
				</script>
				
<!-- ###################### Κρυφό modal_form_anelkystires για εμφάνιση ###################### -->
<div id="modal_form_anelkystires" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_anelkystires"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info">
			<td width=50%>Παράμετρος</td>
			<td width=50%>Τιμή</td>
		</tr>
		<tr>
			<td>Τύπος</td>
			<td>
				<select class="form-control input-sm" id="editanelkystires_type">
				<option value=0>Μηχανικός ανελκυστήρας</option>
				<option value=1>Υδραυλικός ανελκυστήρας</option>
				<option value=2>Κυλιόμενες σκάλες</option>
				<option value=3>Κυλιόμενοι διάδρομοι</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Αριθμός</td>
			<td>
				<input type="text" class="form-control input-sm" id="editanelkystires_n">
			</td>
		</tr>
		<tr>
			<td>Ισχύς (kW)</td>
			<td>
				<input type="text" class="form-control input-sm" id="editanelkystires_p">
			</td>
		</tr>
		<tr>
			<td>Χρόνος λειτουργίας (hr)</td>
			<td>
				<input type="text" class="form-control input-sm" id="editanelkystires_t">
			</td>
		</tr>
		<tr>
			<td>Αυτοματισμοί</td>
			<td>
				<div class="checkbox">
				<label>
					<input type="checkbox" id="editanelkystires_a">
				Αυτοματισμοί
				</label>
				</div>
			</td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_anelkystires"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_anelkystires για εμφάνιση ###################### -->
<div id="modal_del_anelkystires" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή Ανελκυστήρα</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_anelkystires"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->		
						</div><!-- Ανελκυστήρες -->
					</div>
				</div>
		
			</div>
			
			
			
			<div class="tab-pane" id="tabs-5">
				<table class="table table-bordered table-condensed">
				<tr class="info">
					<td colspan="2">
					<i class="fa fa-building" aria-hidden="true"></i> Αδιαφανή δομικά <i>(Επιλογές ΠΕΑ)</i></i>
					</td>
				</tr>
		
				<tr>
					<th>Συντελεστές U 
					<button class="btn btn-warning" data-toggle="modal" data-target="#help_u"><i class="fa fa-life-ring"></i></button>
					</th>
					<td>
						<select class="form-control input-sm" id="pea_adeia" name="pea_adeia">
							<option value=0>Χωρίς θερμομονωτική προστασία</option>
							<option value=1>Ελλιπής θερμομονωτική προστασία</option>
							<option value=2>Κατά Κ.Θ.Κ.</option>
							<option value=3>Κατά Κ.ΕΝ.Α.Κ.</option>
						</select>
					</td>
				</tr>
				<tr>				
					<th>Υπολογισμός θερμογεφυρών</th>
					<td>
						<select class="form-control input-sm" id="pea_thermo" name="pea_thermo">
							<option value=0>Χωρίς υπολογισμό</option>
							<option value=1>U+0.2</option>
							<option value=2>Κατά Κ.ΕΝ.Α.Κ.</option>
						</select>
					</td>
				</tr>
				<tr>	
					<th>Ποσοστό φέροντα [%]
					<button class="btn btn-warning" data-toggle="modal" data-target="#help_per"><i class="fa fa-life-ring"></i></button>
					</th>
					<td>
						<input class="form-control input-sm" type="text" class="span3" id="pea_ferwn" name="pea_ferwn" value="<?php echo $idioktitis;?>">
					</td>
				</tr>
				<th>Αυτόματη προσθήκη θερμογεφυρών στα U του xml (+0.20)</th>
					<td>
						<input type="checkbox" id="pea_thermomonwsi" name="pea_thermomonwsi">
					</td>
				</table>
				
				<table class="table table-bordered table-condensed">
				<tr class="info">
					<td colspan="2">
					<i class="fa fa-building-o" aria-hidden="true"></i> Διαφανή δομικά <i>(Επιλογές ΠΕΑ)</i></i>
					</td>
				</tr>
				<tr>
					<th>Προστασία
					<button class="btn btn-warning" data-toggle="modal" data-target="#help_diafani"><i class="fa fa-life-ring"></i></button>
					</th>
					<td>
						<select class="form-control input-sm" id="pea_an_prostasia" name="pea_an_prostasia">
							<option value=0>Χωρίς εξωτερική προστασία</option>
							<option value=1>Με ρολά</option>
							<option value=2>Με εξώφυλλα</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>Πλαίσιο
					</th>
					<td>
						<select class="form-control input-sm" id="pea_an_plaisio" name="pea_an_plaisio" onchange="changeplaisio();">
							<option value=1>Μεταλλικό χωρίς θερμοδιακοπή</option>
							<option value=2>Μεταλλικό με θερμοδιακοπή 12mm</option>
							<option value=3>Μεταλλικό με θερμοδιακοπή 24mm</option>
							<option value=4>Συνθετικό</option>
							<option value=5>Ξύλινο</option>
							<option value=6>Διπλό (ξύλινο)</option>
							<option value=7>Διπλό (αλουμινίου)</option>
							<option value=8>Μεταλλική πόρτα</option>
							<option value=9>Συνθετική πόρτα</option>
							<option value=10>Ξύλινη πόρτα</option>
						</select>
					</td>
				</tr>
				<tr>
					<th>% πλαισίου</th>
					<td>
						<select class="form-control input-sm" id="pea_an_plaisioper" name="pea_an_plaisioper">
							<option value=0>20%</option>
							<option value=1>30%</option>
							<option value=2>40%</option>
						</select>
					</td>
				</tr>
				<tr>	
					<th>Υαλοπίνακας</th>
					<td>
						<select class="form-control input-sm" id="pea_an_yalo" name="pea_an_yalo">
							<option value=1>Χωρίς υαλοπίνακα σε αέρα</option>
							<option value=2>Χωρίς υαλοπίνακα σε ΜΘΧ</option>
							<option value=3>Μονός</option>
							<option value=4>Δίδυμος υαλοπίνακας με διάκενο αέρα 6mm</option>
							<option value=5>Δίδυμος υαλοπίνακας με διάκενο αέρα 12mm</option>
							<option value=6>Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 6mm</option>
							<option value=7>Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 12mm</option>
						</select>
					</td>
				</tr>
				<script>
				function changeplaisio(){
					var plaisio = document.getElementById("pea_an_plaisio").value;
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
						//Διπλό
						if(plaisio>=6 && plaisio<=7){
							yalo_txt = "<option value=3>Μονός</option>";
						}
						if(plaisio>=8 && plaisio<=10){
							yalo_txt = "<option value=1>Χωρίς υαλοπίνακα σε αέρα</option>";
							yalo_txt += "<option value=2>Χωρίς υαλοπίνακα σε ΜΘΧ</option>";
						}
						
						document.getElementById("pea_an_yalo").innerHTML=yalo_txt;

				}
				
				</script>
				<tr>
					<th>Αερισμός</th>
					<td>
						<select class="form-control input-sm" id="pea_an_aerismos" name="pea_an_aerismos">
							<option value=1>Χωρίς αεροστεγανότητα</option>
							<option value=2>Χωρίς πιστοποίηση αεροστεγανότητας</option>
							<option value=3>Με πιστοποίηση αεροστεγανότητας</option>
						</select>
					</td>
				</tr>
				</table>
				
				<hr>
				<p class="bg-info"><i class="fa fa-users" aria-hidden="true"></i> Στοιχεία Ιδιοκτητών - (Χρησιμοποιείται στα έντυπα / Συμφωνητικά)</p>
				<div id="owners_table"></div>
				<div id="owners_info"></div>
				<script>
				get_owners();
				
				//Εμφάνιση πίνακα με όλες για τη ζώνη
				function get_owners(page){
				page = typeof page !== 'undefined' ? page : 1;
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					
					xmlhttp.open("GET","includes/functions_meleti_gendata.php?getowners=1&page="+page ,true);
					xmlhttp.send();
					
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						document.getElementById("owners_table").innerHTML=xmlhttp.responseText;
						document.getElementById('wait').style.display="none";
					}}
				}
				
				//Εμφάνιση του modal για την εισαγωγή ή επεξεργασία
			//Ανάλογα με το id τα input εμφανίζονται μηδενικά (εισαγωγή) ή με τις τιμές
			function form_owners(id,page){
			page = typeof page !== 'undefined' ? page : 1;
			var prefix = "editowners_";

				if(id==0){
				document.getElementById(prefix+"pososto").value = "";
				document.getElementById(prefix+"firstname").value = "";
				document.getElementById(prefix+"lastname").value = "";
				document.getElementById(prefix+"fathername").value = "";
				document.getElementById(prefix+"mothername").value = "";
				document.getElementById(prefix+"address").value = "";
				document.getElementById(prefix+"afm").value = "";
				document.getElementById(prefix+"doy").value = "";
				document.getElementById(prefix+"taytotita").value = "";
				document.getElementById(prefix+"tel").value = "";
				document.getElementById(prefix+"mail").value = "";
				}
				if(id!=0){
					var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_owners&id="+id;
				
					document.getElementById('wait').style.display="inline";
					//AJAX call
					var xmlhttp=new XMLHttpRequest();
					xmlhttp.open("GET",link ,true);
					xmlhttp.send();
					xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						var arr = JSON.parse(xmlhttp.responseText);
							document.getElementById(prefix+"pososto").value = arr["pososto"];							
							document.getElementById(prefix+"firstname").value = arr["firstname"];
							document.getElementById(prefix+"lastname").value = arr["lastname"];
							document.getElementById(prefix+"fathername").value = arr["fathername"];
							document.getElementById(prefix+"mothername").value = arr["mothername"];
							document.getElementById(prefix+"address").value = arr["address"];
							document.getElementById(prefix+"afm").value = arr["afm"];
							document.getElementById(prefix+"doy").value = arr["doy"];
							document.getElementById(prefix+"taytotita").value = arr["taytotita"];
							document.getElementById(prefix+"tel").value = arr["tel"];
							document.getElementById(prefix+"mail").value = arr["mail"];
	
						document.getElementById('wait').style.display="none";
					}}
					
				}
				
				var button,edit_header;
				if(id!=0){
					button = '<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="submit_owners('+id+','+page+');">Επεξεργασία</button>';
					edit_header = 'Επεξεργασία οικ. άδειας';
				}else{
					button = '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="submit_owners('+id+','+page+');">Προσθήκη</button>';
					edit_header = 'Προσθήκη οικ. άδειας';
				}
				document.getElementById("edit_button_owners").innerHTML = button;
				document.getElementById("edit_header_owners").innerHTML = edit_header;
				$("#modal_form_owners").modal("show");
			}
			
			
			function formdel_owners(id,page){
				var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="del_owners('+id+','+page+');">Διαγραφή</button>';
				document.getElementById("del_button_owners").innerHTML = button;
				$("#modal_del_owners").modal("show");
			}
			
			//Υποβολή της φόρμας
			//Ανάλογα με το id γίνεται προσθήκη ή επεξεργασία
			function submit_owners(id,page){
			var prefix = "editowners_";
				var pososto = document.getElementById(prefix+"pososto").value;
				var firstname = document.getElementById(prefix+"firstname").value;
				var lastname = document.getElementById(prefix+"lastname").value;
				var fathername = document.getElementById(prefix+"fathername").value;
				var mothername = document.getElementById(prefix+"mothername").value;
				var address = document.getElementById(prefix+"address").value;
				var afm = document.getElementById(prefix+"afm").value;
				var doy = document.getElementById(prefix+"doy").value;
				var taytotita = document.getElementById(prefix+"taytotita").value;
				var tel = document.getElementById(prefix+"tel").value;
				var mail = document.getElementById(prefix+"mail").value;
				
					if(id==0){
					var action="create";
					}else{
					action="update";
					}
				var link = "includes/functions_meleti_general.php?insert_iddata=1";
				link += "&table=meletes_owners";
				link += "&action="+action;
				link += "&id="+id;
				link += "&values="+pososto+","+firstname+","+lastname+","+fathername+","+mothername;
				link += ","+address+","+afm+","+doy+","+taytotita+","+tel+","+mail;
				
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("owners_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_owners(page);
				}}
			}
			
			//Διαγραφή ΟΙΚΟΔΟΜΙΚΩΝ ΑΔΕΙΩΝ
			function del_owners(id,page){
				var link = "includes/functions_meleti_general.php?del_iddata=1&table=meletes_owners&id="+id;
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET",link ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("owners_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					get_owners(page);
				}}
			}
				
				</script>
				
<!-- ###################### Κρυφό modal_form_owners για εμφάνιση ###################### -->
<div id="modal_form_owners" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel"><span id="edit_header_owners"></span></h6>
	</div>

	<div class="modal-body">
	<table class="table table-bordered table-condensed">
		<tr class="info">
			<td width=50%>Παράμετρος</td>
			<td width=50%>Τιμή</td>
		</tr>
		<tr>
			<td>% Συμμετοχή</td>
			<td><input type="text" class="form-control input-sm" id="editowners_pososto"></td>
		</tr>
		<tr>
			<td>Όνομα</td>
			<td><input type="text" class="form-control input-sm" id="editowners_firstname"></td>
		</tr>
		<tr>
			<td>Επώνυμο</td>
			<td><input type="text" class="form-control input-sm" id="editowners_lastname"></td>
		</tr>
		<tr>
			<td>Όνομα πατέρα</td>
			<td><input type="text" class="form-control input-sm" id="editowners_fathername"></td>
		</tr>
		<tr>
			<td>Όνομα μητέρας</td>
			<td><input type="text" class="form-control input-sm" id="editowners_mothername"></td>
		</tr>
		<tr>
			<td>Δ/νση</td>
			<td><input type="text" class="form-control input-sm" id="editowners_address"></td>
		</tr>
		<tr>
			<td>ΑΦΜ</td>
			<td><input type="text" class="form-control input-sm" id="editowners_afm"></td>
		</tr>
		<tr>
			<td>ΔΟΥ</td>
			<td><input type="text" class="form-control input-sm" id="editowners_doy"></td>
		</tr>
		<tr>
			<td>ΑΔΤ</td>
			<td><input type="text" class="form-control input-sm" id="editowners_taytotita"></td>
		</tr>
		<tr>
			<td>Τηλέφωνο</td>
			<td><input type="text" class="form-control input-sm" id="editowners_tel"></td>
		</tr>
		<tr>
			<td>e-mail</td>
			<td><input type="text" class="form-control input-sm" id="editowners_mail"></td>
		</tr>
	</table>
	</div>	
	
	<div class="modal-footer">	
		<span id="edit_button_owners"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_del_owners για εμφάνιση ###################### -->
<div id="modal_del_owners" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαγραφή ιδιοκτήτη</h6>
	</div>

	<div class="modal-body">
	Η ενέργεια αυτή δεν μπορεί να αναιρεθεί. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="del_button_owners"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

			</div>
			
			
			
			
			<div class="tab-pane" id="tabs-6">
				<table class="table table-bordered table-condensed">
				<tr class="info">
					<td colspan="2">
					<i class="fa fa-map-o" aria-hidden="true"></i> Τοπογραφία <i>(Επιλογές μελέτης)</i>
					</td>
				</tr>
				
				<tr>
					<th>Σχέδιο πόλης</th>
					<td>
						<select class="form-control input-sm" id="meleti_sxedio" name="meleti_sxedio">
							<option value=0>Εντός</option>
							<option value=1>Εκτός</option>
						</select>	
					</td>
				</tr>
				<tr>
					<th>Παρακείμενη οδός:</th>
					<td>
						<select class="form-control input-sm" id="meleti_odos" name="meleti_odos">
							<option value=0>Αγροτική</option>
							<option value=1>Δημοτική</option>
							<option value=2>Κοινοτική</option>
							<option value=3>Επαρχιακή</option>
							<option value=4>Εθνική</option>
						</select>	
					</td>
				</tr>
				<tr>
					<th>Αποστάσεις από όρια:</th>
					<td>
						<input class="form-control input-sm" type="text" class="span3" id="meleti_apostaseis" name="meleti_apostaseis" value="<?php echo $idioktitis;?>">
					</td>
				</tr>
				</table>
				
				<table class="table table-bordered table-condensed">
				<tr class="info">
					<td colspan="2">
					<i class="fa fa-cube" aria-hidden="true"></i> Συντελεστές προσθήκης δομικών <i>(Επιλογές μελέτης)</i></i>
					</td>
				</tr>
				<tr class="info">
					<td style="width:50%">U</td><td style="width:50%">Θερμογέφυρες *(υπό κατασκευή)</td>
				</tr>
				
				<tr>
					<td>
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label for="meleti_t_u" class="col-md-2 control-label">Δρομικός τοίχος</label>
							<div class="col-md-10">
							<select class="form-control input-sm" id="meleti_t_u" name="meleti_t_u">
								<option value=0></option>
								<?php
								echo create_select_optionsid("user_adiafani","name",array("user_id"=>$_SESSION["user_id"]) );
								?>
							</select>	
							</div>
						</div>
						<div class="form-group">
							<label for="meleti_yp_u" class="col-md-2 control-label">Υποστύλωμα</label>
							<div class="col-md-10">
							<select class="form-control input-sm" id="meleti_yp_u" name="meleti_yp_u">
								<option value=0></option>
								<?php
								echo create_select_optionsid("user_adiafani","name",array("user_id"=>$_SESSION["user_id"]) );
								?>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label for="meleti_dok_u" class="col-md-2 control-label">Δοκός</label>
							<div class="col-md-10">
							<select class="form-control input-sm" id="meleti_dok_u" name="meleti_dok_u">
								<option value=0></option>
								<?php
								echo create_select_optionsid("user_adiafani","name",array("user_id"=>$_SESSION["user_id"]) );
								?>
							</select>	
							</div>
						</div>
						<div class="form-group">
							<label for="meleti_syr_u" class="col-md-2 control-label">Συρόμενα</label>
							<div class="col-md-10">
							<select class="form-control input-sm" id="meleti_syr_u" name="meleti_syr_u">
								<option value=0></option>
								<?php
								echo create_select_optionsid("user_adiafani","name",array("user_id"=>$_SESSION["user_id"]) );
								?>
							</select>	
							</div>
						</div>
						<div class="form-group">
							<label for="meleti_dap_u" class="col-md-2 control-label">Δάπεδα</label>
							<div class="col-md-10">
							<select class="form-control input-sm" id="meleti_dap_u" name="meleti_dap_u">
								<option value=0></option>
								<?php
								echo create_select_optionsid("user_adiafani","name",array("user_id"=>$_SESSION["user_id"]) );
								?>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label for="meleti_oro_u" class="col-md-2 control-label">Οροφές</label>
							<div class="col-md-10">
							<select class="form-control input-sm" id="meleti_oro_u" name="meleti_oro_u">
								<option value=0></option>
								<?php
								echo create_select_optionsid("user_adiafani","name",array("user_id"=>$_SESSION["user_id"]) );
								?>
						</select>
							</div>
						</div>
						<div class="form-group">
							<label for="meleti_an_u" class="col-md-2 control-label">Ανοίγματα</label>
							<div class="col-md-10">
							<select class="form-control input-sm" id="meleti_an_u" name="meleti_an_u">
								<option value=0></option>
								<?php
								echo create_select_optionsid("user_diafani","name",array("user_id"=>$_SESSION["user_id"]) );
								?>
							</select>
							</div>
						</div>
					</form>	
					</td>
					<td>
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label for="meleti_thermo_dap" class="col-md-2 control-label">Δαπέδου</label>
							<div class="col-md-10">
							<select class="form-control input-sm" id="meleti_thermo_dap" name="meleti_thermo_dap">
								<option value=0></option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label for="meleti_thermo_or" class="col-md-2 control-label">Οροφής</label>
							<div class="col-md-10">
							<select class="form-control input-sm" id="meleti_thermo_or" name="meleti_thermo_or">
								<option value=0></option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label for="meleti_thermo_yp" class="col-md-2 control-label">Υποστηλωμάτων</label>
							<div class="col-md-10">
							<select class="form-control input-sm" id="meleti_thermo_yp" name="meleti_thermo_yp">
								<option value=0></option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label for="meleti_thermo_dok" class="col-md-2 control-label">Δοκών</label>
							<div class="col-md-10">
							<select class="form-control input-sm" id="meleti_thermo_dok" name="meleti_thermo_dok">
								<option value=0></option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label for="meleti_thermo_syr" class="col-md-2 control-label">Συρομένων</label>
							<div class="col-md-10">
							<select class="form-control input-sm" id="meleti_thermo_syr" name="meleti_thermo_syr">
								<option value=0></option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label for="meleti_thermo_an" class="col-md-2 control-label">Ανωκάσι</label>
							<div class="col-md-10">
							<select class="form-control input-sm" id="meleti_thermo_an" name="meleti_thermo_an">
								<option value=0></option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label for="meleti_thermo_kat" class="col-md-2 control-label">Κατωκάσι</label>
							<div class="col-md-10">
							<select class="form-control input-sm" id="meleti_thermo_kat" name="meleti_thermo_kat">
								<option value=0></option>
							</select>
							</div>
						</div>
						<div class="form-group">
							<label for="meleti_thermo_l" class="col-md-2 control-label">Λαμπάς</label>
							<div class="col-md-10">
							<select class="form-control input-sm" id="meleti_thermo_l" name="meleti_thermo_l">
								<option value=0></option>
							</select>
							</div>
						</div>
					</form>
					</td>
				</tr>
				</table>
				
				
			</div>
			
			
			
			<div class="tab-pane" id="tabs-7">
			<table class="table table-bordered table-condensed">
				<tr class="info">
					<td colspan="4">
					<i class="icon-map-marker"></i>Διαστάσεις τοιχοποιίας (αφήστε κενό όποιο δεν χρειάζεται να προσθέτετε συνεχώς)</i>
					</td>
				</tr>
				<tr>
					<th style="width:25%">Στοιχείο</th>
					<th style="width:25%">Μήκος</th>
					<th style="width:25%">Ύψος</th>
					<th style="width:25%">Πάχος</th>
				</tr>
				<tr>
					<td>Δρομικός τοίχος</td>
					<td><input type="text" class="form-control input-sm" id="meleti_t_l" name="t_l" value="<?php echo $idioktitis;?>"></td>
					<td><input type="text" class="form-control input-sm" id="meleti_t_h" name="t_h" value="<?php echo $idioktitis;?>"></td>
					<td><input type="text" class="form-control input-sm" id="meleti_t_d" name="t_d" value="<?php echo $idioktitis;?>"></td>
				</tr>
				<tr>
					<td>Υποστύλωμα</td>
					<td><input type="text" class="form-control input-sm" id="meleti_yp_l" name="yp_l" value="<?php echo $idioktitis;?>"></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Δοκός</td>
					<td></td>
					<td><input type="text" class="form-control input-sm" id="meleti_dok_h" name="dok_h" value="<?php echo $idioktitis;?>"></td>
					<td></td>
				</tr>
				<tr>
					<td>Συρόμενα</td>
					<td><input type="text" class="form-control input-sm" id="meleti_syr_l" name="syr_l" value="<?php echo $idioktitis;?>"></td>
					<td><input type="text" class="form-control input-sm" id="meleti_syr_h" name="syr_h" value="<?php echo $idioktitis;?>"></td>
					<td></td>
				</tr>
				<tr class="info">
					<td colspan="4">
					<i class="icon-map-marker"></i>Απορροφητικότητα/Συντελεστής εκπομπής τοιχοποιίας</i>
					</td>
				</tr>
				<tr>
					<td>Απορροφητικότητα (a)</td>
					<td>
						<select class="form-control input-sm" id="meleti_t_a" name="t_a">
							<?php
								echo create_select_optionsid("vivliothiki_adiafani_a","name" );
							?>
						</select>
					</td>
					<td>Συντελεστής εκπομπής (ε)</td>
					<td>
						<select class="form-control input-sm" id="meleti_t_e" name="t_e">
							<?php
								echo create_select_optionsid("vivliothiki_adiafani_e","name");
							?>
						</select>
					</td>
				</tr>
				
				<tr class="info">
					<td colspan="4">
					<i class="icon-map-marker"></i>Διαστάσεις Διαφανών (αφήστε κενό όποιο δεν χρειάζεται να προσθέτετε συνεχώς)</i>
					</td>
				</tr>
				<tr>
					<th style="width:25%">Στοιχείο</th>
					<th style="width:25%">Μήκος</th>
					<th style="width:25%">Πρέκι</th>
					<th style="width:25%">Ποδιά</th>
				</tr>
				<tr>
					<td>Ανοίγματα</td>
					<td><input type="text" class="form-control input-sm" id="meleti_an_l" name="meleti_an_l" value="<?php echo $idioktitis;?>"></td>
					<td><input type="text" class="form-control input-sm" id="meleti_an_h" name="meleti_an_h" value="<?php echo $idioktitis;?>"></td>
					<td><input type="text" class="form-control input-sm" id="meleti_an_p" name="meleti_an_p" value="<?php echo $idioktitis;?>"></td>
				</tr>
				</table>

				</div>

<!-- ###################### Κρυφό help_u για εμφάνιση ###################### -->
<div id="help_u" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Απαιτήσεις συντελεστή θερμοπερατότητας</h6>
	</div>
	<div class="modal-body">
	<?php
	include("accordions_u.php");
	?>
	</div>	
	<div class="modal-footer">			
		<button class="btn" data-dismiss="modal" aria-hidden="true">ΟΚ</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό help_u για εμφάνιση ######################### -->
<!-- ######################### Κρυφό help_per για εμφάνιση ######################### -->
<!-- Modal -->
<div id="help_per" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">Ποσοστό φέροντα οργανισμού στο κτίριο</h4>
		</div>
		<div class="modal-body">
		<?php
			echo create_library_ferwn();
		?>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
		</div>
	</div>
</div>
</div>
<!-- ######################### Κρυφό help_per για εμφάνιση ######################### -->
<!-- ######################### Κρυφό help_diafani για εμφάνιση ######################### -->
<!-- Modal -->
<div id="help_diafani" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel">Θεώρηση συντελεστή θερμοπερατότητας διαφανών</h4>
		</div>
		<div class="modal-body">
					<div class="tabbable tabs-left">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_uw1" data-toggle="tab">Χωρίς προστασία</a></li>
							<li><a href="#tab_uw2" data-toggle="tab">Με ρολά</a></li>
							<li><a href="#tab_uw3" data-toggle="tab">Με εξώφυλλα</a></li>
							<li><a href="#tab_uw4" data-toggle="tab">g<sub>w</sub></a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_uw1">
								<?php
									echo create_library_diafani_uw();
								?>
							</div><!--tab_uw1-->
							<div class="tab-pane" id="tab_uw2">
								<?php
									echo create_library_diafani_uw_rola();
								?>
							</div><!--tab_uw2-->
							<div class="tab-pane" id="tab_uw3">
								<?php
									echo create_library_diafani_uw_ekswfylla();
								?>
							</div><!--tab_uw3-->
							<div class="tab-pane" id="tab_uw4">
								<?php
									echo create_library_diafani_gw();
								?>
							</div><!--tab_uw4-->
						</div><!--"tabbable tabs-left-->
				</div><!--"tab inside-->
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
		</div>
	</div>
</div>
</div>
<!-- ######################### Κρυφό help_diafani για εμφάνιση ######################### -->

				
				<div class="tab-pane" id="tabs-8">
				
<!-- JQUERY FILE UPLOAD PLUGIN ##################### -->
<div class="row-fluid">
<div class="span1"></div>
<div class="span11">
   <form id="fileupload" action="includes/file_upload/server/php/" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="includes/file_upload/server/php/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
					<i class="fa fa-upload"></i>
                    <span>Ανέβασμα</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="fa fa-times"></i>
                    <span>Ακύρωση</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="fa fa-ban"></i>
                    <span>Διαγραφή</span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Σημείωση</h3>
        </div>
        <div class="panel-body">
            <ul>
                <li>Επιτρέπονται μόνο φωτογραφίες της μορφής (<strong>JPG, GIF, PNG</strong>) μέγιστου μεγέθους 500Kb. 
				<b><span class="error">Χρησιμοποιήστε MONO αγγλικούς χαρακτήρες ώστε να βλέπετε τα αρχεία σας. </span></b>.</li>
                <li>Μπορείτε να σύρετε αρχεία από τον υπολογιστή σας με drag and drop εδώ.
				(<a href="https://github.com/blueimp/jQuery-File-Upload/wiki/Browser-support" target="_blank">Υποστηριζόμενοι περιηγητές</a>)</li>
				 <li>Χρησιμοποιήστε τη μορφή pea_img.jpg για να εμφανιστεί η εικόνα του ΠΕΑ στα μενού.</li>
				 <li>Χρησιμοποιήστε τη μορφή pea_topo.jpg για να εμφανιστεί η εικόνα τοπογραφικού στο μενού.</li>
            </ul>
        </div>
    </div>
<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="fa fa-upload"></i>
                    <span>Ανέβασμα</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="fa fa-ban"></i>
                    <span>Ακύρωση</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Λάθος</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="fa fa-trash"></i>
                    <span>Διαγραφή</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="fa fa-ban"></i>
                    <span>Ακύρωση</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="includes/file_upload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="includes/file_upload/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="includes/file_upload/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="includes/file_upload/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="includes/file_upload/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="includes/file_upload/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="includes/file_upload/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="includes/file_upload/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="includes/file_upload/js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
</div></div>
<!-- ############################################### -->
				
				</div>
			</div><!--tab content-->
			</div><!--tabs-->

</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=600,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes')
}


function show_help(n){
	document.getElementById('genika_help_1').style.display="none";
	document.getElementById('genika_help_2').style.display="none";
	document.getElementById('genika_help_3').style.display="none";
	document.getElementById('genika_help_4').style.display="none";
	document.getElementById('genika_help_5').style.display="none";
	document.getElementById('genika_help_6').style.display="none";
	document.getElementById('genika_help_7').style.display="none";
	document.getElementById('genika_help_'+n).style.display="block";
	document.getElementById('AJAX_save').style.display="none";
	document.getElementById('AJAX_nosave').style.display="none";
}
show_help(1);

/*
function load(){
load_general();
load_pea();
load_meleti();
load_diastaseis();
}
*/

function load(){
//ΓΕΝΙΚΕΣ ΚΑΡΤΕΛΕΣ
var link = "includes/functions_meleti_general.php?load_generaldata=1";

	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById('wait').style.display="none";
			var arr = JSON.parse(xmlhttp.responseText);
			
			document.getElementById("name").value = arr["name"];
			document.getElementById("perigrafi").value = arr["perigrafi"];
			document.getElementById("type").selectedIndex = arr["type"];
				if(arr["symptiksi"] == 1){
					document.getElementById("symptiksi").checked = true;
				}else{
					document.getElementById("symptiksi").checked = false;
				}
			document.getElementById("address").value = arr["address"];
			document.getElementById("address_x").value = arr["address_x"];
			document.getElementById("address_y").value = arr["address_y"];
			document.getElementById("address_z").value = arr["address_z"];
			document.getElementById("ktirio").value = arr["ktirio"];
			document.getElementById("kaek").value = arr["kaek"];
				if(arr["tmima"] == 1){
					document.getElementById("tmima").checked = true;
				}else{
					document.getElementById("tmima").checked = false;
				}
				help_tmima();
			document.getElementById("tmima_ar").value = arr["tmima_ar"];
			document.getElementById("xrisi").value = arr["xrisi"];
			document.getElementById("climate").selectedIndex = arr["climate"];
				if(arr["height"] == 1){
					document.getElementById("height").checked = true;
				}else{
					document.getElementById("height").checked = false;
				}
			document.getElementById("zone").selectedIndex = arr["zone"];
			document.getElementById("pros").value = arr["pros"];
			document.getElementById("idioktitis").value = arr["idioktitis"];
			document.getElementById("idio_kathestos").value = arr["idio_kathestos"];
			document.getElementById("ypeythinos_type").value = arr["ypeythinos_type"];
			document.getElementById("ypeythinos_name").value = arr["ypeythinos_name"];
			document.getElementById("ypeythinos_tel").value = arr["ypeythinos_tel"];
			document.getElementById("ypeythinos_mail").value = arr["ypeythinos_mail"];
		
			load_pea();
			load_meleti();
			load_diastaseis();
		}
	}
}

function load_pea(){
	//ΚΑΡΤΕΛΑ ΠΕΑ
	var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_stoixeiapea&id=0";
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById('wait').style.display="none";
			var arr = JSON.parse(xmlhttp.responseText);
			
			document.getElementById("pea_adeia").value = arr["type_u"];
			document.getElementById("pea_thermo").value = arr["type_psi"];
			document.getElementById("pea_ferwn").value = arr["percent"];
			if(arr["thermo_kat"]==1){
				document.getElementById("pea_thermomonwsi").checked = true;
			}else{
				document.getElementById("pea_thermomonwsi").checked = false;
			}
			//document.getElementById("pea_thermomonwsi").value = arr["thermo_kat"];
			document.getElementById("pea_an_prostasia").value = arr["prostasia"];
			document.getElementById("pea_an_plaisio").value = arr["plaisio"];
			document.getElementById("pea_an_plaisioper").value = arr["per_plaisio"];
			document.getElementById("pea_an_yalo").value = arr["yalosi"];
			document.getElementById("pea_an_aerismos").value = arr["aerismos"];
			var piges = arr["piges"];
			piges = piges.split("");
			var i;
			for (i = 0; i<=9; i++) {
				if(piges[i]==1){
					document.getElementById("pea_datasource"+i).checked = true;
				}else{
					document.getElementById("pea_datasource"+i).checked = false;
				}
			}
			var synthikes = arr["synthikes"];
			synthikes = synthikes.split("");
			for (i = 0; i<=3; i++) {
				if(synthikes[i]==1){
					document.getElementById("pea_synthikes"+i).checked = true;
				}else{
					document.getElementById("pea_synthikes"+i).checked = false;
				}
			}
			document.getElementById("pea_levels").value = arr["levels"];
			document.getElementById("pea_typical_h").value = arr["typical_h"];
			document.getElementById("pea_floor_h").value = arr["floor_h"];
			document.getElementById("pea_ekthesi").value = arr["ekthesi"];
		}
	}
}

function load_meleti(){
	//ΚΑΡΤΕΛΑ ΜΕΛΕΤΗ
	var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_stoixeiameleti&id=0";
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById('wait').style.display="none";
			var arr = JSON.parse(xmlhttp.responseText);
			
			document.getElementById("meleti_sxedio").value = arr["sxedio"];
			document.getElementById("meleti_odos").value = arr["odos"];
			document.getElementById("meleti_apostaseis").value = arr["apostaseis"];
			document.getElementById("meleti_t_u").value = arr["u_t"];
			document.getElementById("meleti_yp_u").value = arr["u_yp"];
			document.getElementById("meleti_dok_u").value = arr["u_dok"];
			document.getElementById("meleti_syr_u").value = arr["u_syr"];
			document.getElementById("meleti_dap_u").value = arr["u_dap"];
			document.getElementById("meleti_oro_u").value = arr["u_or"];
			document.getElementById("meleti_an_u").value = arr["u_an"];
			document.getElementById("meleti_thermo_dap").value = arr["therm_dap"];
			document.getElementById("meleti_thermo_or").value = arr["therm_or"];
			document.getElementById("meleti_thermo_yp").value = arr["therm_yp"];
			document.getElementById("meleti_thermo_dok").value = arr["therm_dok"];
			document.getElementById("meleti_thermo_syr").value = arr["therm_syr"];
			document.getElementById("meleti_thermo_an").value = arr["therm_an"];
			document.getElementById("meleti_thermo_kat").value = arr["therm_kat"];
			document.getElementById("meleti_thermo_l").value = arr["therm_l"];
		}
	}
}

function load_diastaseis(){
	//ΚΑΡΤΕΛΑ ΔΙΑΣΤΑΣΕΙΣ
	var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_stoixeiadiastaseis&id=0";
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById('wait').style.display="none";
			var arr = JSON.parse(xmlhttp.responseText);
			
			document.getElementById("meleti_t_l").value = arr["t_l"];
			document.getElementById("meleti_t_h").value = arr["t_h"];
			document.getElementById("meleti_t_d").value = arr["t_d"];
			document.getElementById("meleti_yp_l").value = arr["yp_l"];
			document.getElementById("meleti_dok_h").value = arr["dok_h"];
			document.getElementById("meleti_syr_l").value = arr["syr_l"];
			document.getElementById("meleti_syr_h").value = arr["syr_h"];
			document.getElementById("meleti_t_a").value = arr["a"];
			document.getElementById("meleti_t_e").value = arr["e"];
			document.getElementById("meleti_an_l").value = arr["an_l"];
			document.getElementById("meleti_an_h").value = arr["an_h"];
			document.getElementById("meleti_an_p").value = arr["an_pod"];
		}
	}
}

load();

/*
function save(){
save_general();
save_pea();
save_meleti();
save_diastaseis();
load();
}
*/

function save(){

	var name = document.getElementById("name").value;
	var perigrafi = document.getElementById("perigrafi").value;
	var type = document.getElementById("type").selectedIndex;
	var symptiksi; 
		if(document.getElementById("symptiksi").checked == true){
			symptiksi = 1;
		}else{
			symptiksi = 0;
		}
	var address = document.getElementById("address").value;
	var address_x = document.getElementById("address_x").value;
	var address_y = document.getElementById("address_y").value;
	var address_z = document.getElementById("address_z").value;
	var ktirio = document.getElementById("ktirio").value;
	var kaek = document.getElementById("kaek").value;
	var tmima; 
		if(document.getElementById("tmima").checked == true){
			tmima = 1;
		}else{
			tmima = 0;
		}
	var tmima_ar = document.getElementById("tmima_ar").value;
	var xrisi = document.getElementById("xrisi").value;
	var climate = document.getElementById("climate").selectedIndex;
	var height; 
		if(document.getElementById("height").checked == true){
			height = 1;
		}else{
			height = 0;
		}
	var zone = document.getElementById("zone").selectedIndex;
	var pros = document.getElementById("pros").value;
	var idioktitis = document.getElementById("idioktitis").value;
	var idio_kathestos = document.getElementById("idio_kathestos").selectedIndex;
	var ypeythinos_type = document.getElementById("ypeythinos_type").selectedIndex;
	var ypeythinos_name = document.getElementById("ypeythinos_name").value;
	var ypeythinos_tel = document.getElementById("ypeythinos_tel").value;
	var ypeythinos_mail = document.getElementById("ypeythinos_mail").value;	
		
		var link = "includes/functions_meleti_general.php?insert_generaldata=1";
			link += "&name="+name+"&perigrafi="+perigrafi+"&type="+type+"&symptiksi="+symptiksi+"&address="+address+"&address_x="+address_x+"&address_y="+address_y+"&address_z="+address_z;
			link += "&ktirio="+ktirio+"&kaek="+kaek+"&tmima="+tmima+"&tmima_ar="+tmima_ar+"&xrisi="+xrisi+"&climate="+climate+"&height="+height+"&zone="+zone+"&pros="+pros;
			link += "&idioktitis="+idioktitis+"&idio_kathestos="+idio_kathestos+"&ypeythinos_type="+ypeythinos_type+"&ypeythinos_name="+ypeythinos_name;
			link += "&ypeythinos_tel="+ypeythinos_tel+"&ypeythinos_mail="+ypeythinos_mail;

		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()  {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById('wait').style.display="none";
				if(xmlhttp.responseText==1){
				document.getElementById('AJAX_save').style.display="block";
				}
			
				save_pea();
				save_meleti();
				save_diastaseis();
				load();
			}
		}
}

function save_pea(){
	
	var type_u = document.getElementById("pea_adeia").value;
	var type_psi = document.getElementById("pea_thermo").value;
	var percent = document.getElementById("pea_ferwn").value;
	var thermo_kat;
	if(document.getElementById("pea_thermomonwsi").checked){
		thermo_kat = 1;
	}else{
		thermo_kat = 0;
	}
	//var thermo_kat = document.getElementById("pea_thermomonwsi").value;
	var prostasia = document.getElementById("pea_an_prostasia").value;
	var plaisio = document.getElementById("pea_an_plaisio").value;
	var per_plaisio = document.getElementById("pea_an_plaisioper").value;
	var yalosi = document.getElementById("pea_an_yalo").value;
	var aerismos = document.getElementById("pea_an_aerismos").value;
	var piges = "";
	var synthikes = "";
	var i;
	for (i = 0; i<=9; i++) {
		if(document.getElementById("pea_datasource"+i).checked){
			piges += "1";
		}else{
			piges += "0";
		}
	}
	for (i = 0; i<=3; i++) {
		if(document.getElementById("pea_synthikes"+i).checked){
			synthikes += "1";
		}else{
			synthikes += "0";
		}
	}
	var levels = document.getElementById("pea_levels").value;
	var typical_h = document.getElementById("pea_typical_h").value;
	var floor_h = document.getElementById("pea_floor_h").value;
	var ekthesi = document.getElementById("pea_ekthesi").value;
	
	var link = "includes/functions_meleti_general.php?insert_iddata=1";
	link += "&table=meletes_stoixeiapea&action=update&id=0";
	link += "&values="+type_u+","+type_psi+","+percent+","+thermo_kat+","+prostasia+","+plaisio+","+per_plaisio+","+yalosi+","+aerismos;
	link += ","+piges+","+synthikes+","+levels+","+typical_h+","+floor_h+","+ekthesi;
	
	document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()  {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById('wait').style.display="none";
				if(xmlhttp.responseText==1){
				document.getElementById('AJAX_save').style.display="block";
				}
			}
		}
}

function save_meleti(){
	
	var sxedio = document.getElementById("meleti_sxedio").value;
	var odos = document.getElementById("meleti_odos").value;
	var apostaseis = document.getElementById("meleti_apostaseis").value;
	var u_t = document.getElementById("meleti_t_u").value;
	var u_yp = document.getElementById("meleti_yp_u").value;
	var u_dok = document.getElementById("meleti_dok_u").value;
	var u_syr = document.getElementById("meleti_syr_u").value;
	var u_dap = document.getElementById("meleti_dap_u").value;
	var u_or = document.getElementById("meleti_oro_u").value;
	var u_an = document.getElementById("meleti_an_u").value;
	var therm_dap = document.getElementById("meleti_thermo_dap").value;
	var therm_or = document.getElementById("meleti_thermo_or").value;
	var therm_yp = document.getElementById("meleti_thermo_yp").value;
	var therm_dok = document.getElementById("meleti_thermo_dok").value;
	var therm_syr = document.getElementById("meleti_thermo_syr").value;
	var therm_an = document.getElementById("meleti_thermo_an").value;
	var therm_kat = document.getElementById("meleti_thermo_kat").value;
	var therm_l = document.getElementById("meleti_thermo_l").value;
	
	var link = "includes/functions_meleti_general.php?insert_iddata=1";
	link += "&table=meletes_stoixeiameleti&action=update&id=0";
	link += "&values="+sxedio+","+odos+","+apostaseis+","+u_t+","+u_yp+","+u_dok+","+u_syr+","+u_dap;
	link += ","+u_or+","+u_an+","+therm_dap+","+therm_or+","+therm_yp+","+therm_dok+","+therm_syr+","+therm_an+","+therm_kat+","+therm_l;
	
	document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()  {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById('wait').style.display="none";
				if(xmlhttp.responseText==1){
				document.getElementById('AJAX_save').style.display="block";
				}
			}
		}
}

function save_diastaseis(){
	
	var t_l = document.getElementById("meleti_t_l").value;
	var t_h = document.getElementById("meleti_t_h").value;
	var t_d = document.getElementById("meleti_t_d").value;
	var yp_l = document.getElementById("meleti_yp_l").value;
	var dok_h = document.getElementById("meleti_dok_h").value;
	var syr_l = document.getElementById("meleti_syr_l").value;
	var syr_h = document.getElementById("meleti_syr_h").value;
	var ak = document.getElementById("meleti_t_a").value;
	var ek = document.getElementById("meleti_t_e").value;
	var an_l = document.getElementById("meleti_an_l").value;
	var an_h = document.getElementById("meleti_an_h").value;
	var an_pod = document.getElementById("meleti_an_p").value;
	
	var link = "includes/functions_meleti_general.php?insert_iddata=1";
	link += "&table=meletes_stoixeiadiastaseis&action=update&id=0";
	link += "&values="+t_l+","+t_h+","+t_d+","+yp_l+","+dok_h+","+syr_l+","+syr_h+","+ak;
	link += ","+ek+","+an_l+","+an_h+","+an_pod;
	
	document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()  {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById('wait').style.display="none";
				if(xmlhttp.responseText==1){
				document.getElementById('AJAX_save').style.display="block";
				}
			}
		}
}

</script>