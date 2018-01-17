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
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
	<h1>
	La-kenak
	<small>Χρήστης</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-user"></i> Χρήστης</a></li>
	<li class="active">Σύνδεση</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- Main row -->
<div class="row">
	
		<div class="col-md-2">
		<?php
		$database = new medoo(DB_NAME);
		$select_prefs = $database->select("core_preferences","*",array("id" => "1"));
		$registration = $select_prefs[0]["registration"];
		$Client_ID = $select_prefs[0]["Client_ID"];
		$Client_Secret = $select_prefs[0]["Client_Secret"];
		$Client_Redirect = $select_prefs[0]["Client_Redirect"];
		
		if(!isset($_SESSION['user_id'])){//Ο χρήστης δεν είναι συνδεδεμένος
			
			//Δεν επιστρέφεται τίποτα στο session από φόρμα εγγραφής ή φόρμα εισόδου
			if (!isset($_SESSION['msg']['login-err']) && !isset($_SESSION['msg']['reg-err']) && !isset($_SESSION['msg']['reg-success'])){
			
				echo "<div class=\"alert alert-info\" role=\"alert\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				<strong>Βοήθεια!</strong><br/>
				Συνδεθείτε εισάγοντας το όνομα χρήστη και τον κωδικό σας. <br/><br/>
				Πρότυπα συνθηματικά: admin/admin <br/><br/>";
				if($prefs_registration==1){
				echo "Εάν δεν έχετε ακόμα εγγραφεί εισάγετε το όνομα χρήστη 
				και το e-mail σας για να σας στείλουμε ένα κωδικό.";
				}else{
					echo "<font color=\"red\">Οι εγγραφές προσωρινά είναι κλειστές για το κοινό</font>";
				}
					echo "</div>";
			}
			
			//Επιστροφή λάθους μέσω session από φόρμα εισόδου
			if(isset($_SESSION['msg']['login-err'])){
				echo "<div class=\"alert alert-error\" role=\"alert\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				<strong>Προσοχή!</strong><br/>".$_SESSION['msg']['login-err']."</div>";
				unset($_SESSION['msg']['login-err']);
			}
			
			//Επιστροφή λάθους μέσω session από φόρμα εγγραφής
			if(isset($_SESSION['msg']['reg-err'])){
				echo "<div class=\"alert alert-error\" role=\"alert\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				<strong>Προσοχή!</strong><br/>".$_SESSION['msg']['reg-err']."</div>";
				unset($_SESSION['msg']['reg-err']);
			}
			
			//Επιτυχής εγγραφή
			if(isset($_SESSION['msg']['reg-success'])){
				echo "<div class=\"alert alert-success\" role=\"alert\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				<strong>Συγχαρητήρια!</strong><br/>".$_SESSION['msg']['reg-success']."</div>";
				unset($_SESSION['msg']['reg-success']);
			}
			
		}else{//Ο χρήστης είναι συνδεδεμένος
				
				if(isset($_SESSION['msg']['login-err'])){
				echo "<div class=\"alert alert-success\" role=\"alert\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				<strong>Συγχαρητήρια!</strong><br/>".$_SESSION['msg']['login-err']."</div>";
				unset($_SESSION['msg']['login-err']);
				}
			
			$db_table = "user_meletes";
			$db_columns = array ("id","user_id","name","perigrafi","address","address_x","address_y","xrisi");
			$db_parameters = array("user_id" => $_SESSION['user_id']);
			$data_meletes = $database->select($db_table,$db_columns,$db_parameters);
			$count_meletes = $database->count($db_table, $db_parameters);
			
			//μεταβλητές της μορφής $meletes_id1, $meletes_name2 κλπ
				$i=1;
				foreach($data_meletes as $data)
				{
					for ($j=0; $j<=count($db_columns)-1; $j++){
					${$db_table."_".$db_columns[$j].$i}=$data[$db_columns[$j]];
					}
				$i++;
				}	
		?>
			
			<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Βοήθεια!</strong><br/>
			Προσθέστε νέα μελέτη δίνοντας το όνομά της. Έπειτα πατήστε το πλήκτρο "Νέα μελέτη". <br/><br/>
			Στον πίνακα δεξιά εμφανίζονται όλες οι μελέτες που έχετε προσθέσει. Για να εργαστείτε σε μία μελέτη επιλέξτε την.<br/><br/>
			Αφού επιλέξετε τη μελέτη εργασίας σας θα δείτε το όνομά της να εμφανίζεται στο μενού κορυφής. Το όνομα της μελέτης μπορείτε να το 
			τροποποιήσετε στο μενού <a href="index.php?nav=meleti_general">Γενικά στοιχεία</a> μαζί με τα υπόλοιπα δεδομένα της μελέτης.
			</div>
			
			<div class="alert alert-warning" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4><i class="fa fa-map-marker" aria-hidden="true"></i> Χάρτης:</h4>
			<?php
			if($count_meletes==0){
			echo "Δεν βρέθηκε καμία μελέτη στο λογαριασμό σας.";
			}
			if($count_meletes==1){
			echo "Βρέθηκε ".$count_meletes." μελέτη στο λογαριασμό χρήστη";
			}
			if($count_meletes>1){
			echo "Βρέθηκαν ".$count_meletes." μελέτες στο λογαριασμό χρήστη";
			}
			?>
			</div>
		<?php
		}
		?>
		
		</div><!-- /span2 -->
		
		<div class="col-md-10">
			
		<?php
		//Ο χρήστης δεν είναι συνδεδεμένος
		if(!isset($_SESSION['user_id'])){
		
		
		$google_link='https://accounts.google.com/o/oauth2/auth?scope=';
		$google_link.=urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me');
		$google_link.='&redirect_uri=' . urlencode($prefs_Client_Redirect);
		$google_link.='&response_type=code&client_id=' . $prefs_Client_ID;
		$google_link.='&access_type=online';
		
		
		?>
			
			<!-- Εμφάνιση της φόρμας εισόδου -->
			<div class="login-box" id="login_box">
				<div class="login-logo">
					<a href="?nav=user_login"><i class="fa fa-user-o" aria-hidden="true"></i> <b>La</b>Kenak</a>
				</div>
				<!-- /.login-logo -->
				<div class="login-box-body">
					<p class="login-box-msg">Συνδεθείτε για να ξεκινήσετε :)</p>

					<form action="" method="post">
						<div class="form-group has-feedback">
							<input type="text" class="form-control" placeholder="Username"  id="username" name="username">
							<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
						</div>
						<div class="form-group has-feedback">
							<input type="password" class="form-control" placeholder="Password" id="password" name="password">
							<span class="glyphicon glyphicon-lock form-control-feedback"></span>
						</div>
						<div class="row">
							<div class="col-xs-8">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="rememberMe" id="rememberMe" checked="checked" value="1"> Να με θυμάσαι
									</label>
								</div>
							</div>
							<!-- /.col -->
							<div class="col-xs-4">
							<button type="submit" name="submit" value="Login" class="btn btn-primary btn-block btn-flat">Σύνδεση</button>
							</div>
							<!-- /.col -->
						</div>
					</form>

					<div class="social-auth-links text-center">
						<p>- OR -</p>
						<a href="<?php echo $google_link;?>" class="btn btn-block btn-social btn-google btn-flat">
							<i class="fa fa-google-plus"></i> Σύνδεση με Google+
						</a>
					</div>
					<!-- /.social-auth-links -->

					<a href="#">Ξέχασα τον κωδικό μου</a><br>
					<a href="http://localhost/kenakv5/?nav=library_help#tabs-4">Πολιτική Χρήσης στοιχείων</a><br>
					<?php
					if($prefs_registration==1){
					?>
					<a href="#" class="text-center" onclick=toggle_forms(1);>Εγγραφή νέου χρήστη</a>
					<?php
					}
					?>
				</div>
				<!-- /.login-box-body -->
			</div>
			<!-- /.login-box -->
			
			<?php
			//Εάν από το μενού διαχείρισης έχουν δηλωθεί οι εγγραφές "ΑΝΟΙΚΤΕΣ" εμφάνιση και της φόρμας εγγραφής
			if($prefs_registration==1){
			?>
			<script>
			function toggle_forms(z){
				var div_login = document.getElementById('login_box');
				var div_register = document.getElementById('register_box');
				if(z==1){
					div_login.style.display = "none";
					div_register.style.display = "block";
				}
				if(z==0){
					div_login.style.display = "block";
					div_register.style.display = "none";
				}
			}
			</script>
			<!-- Register Form -->
			<div class="register-box" id="register_box" style="display: none;">
				<div class="register-logo">
					<a href="?nav=user_login"><i class="fa fa-user-plus" aria-hidden="true"></i> <b>La</b>Kenak</a>
				</div>

			<div class="register-box-body">
				<p class="login-box-msg">
				Εγγραφείτε στο La-kenak<br/>
				<?php
				$dt_start = date("Y-m-d H:i:s");//ΤΩΡΑ
				echo $dt_start;
				?>
				</p>
		
				<form action="" method="post">
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="Username" name="username" id="username">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="email" class="form-control" placeholder="Email" name="email" id="email">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" placeholder="Password" name="pass1" id="pass1">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" placeholder="Retype password" name="pass2" id="pass2">
						<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
					</div>
					<div class="row">
						<div class="col-xs-8">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="reg_terms" id="reg_terms"> Συμφωνώ με τους <a href="#">όρους</a>
								</label>
							</div>
						</div>
						<!-- /.col -->
						<div class="col-xs-4">
							<button type="submit" name="submit" value="Register"  class="btn btn-primary btn-block btn-flat">Εγγραφή</button>
						</div>
						<!-- /.col -->
					</div>
				</form>

				<div class="social-auth-links text-center">
					
				</div>

				<a href="#" class="text-center" onclick=toggle_forms(0);>Έχω ήδη λογαριασμό.</a>
			</div>
			<!-- /.form-box -->
			</div>
			<!-- /.register-box -->
			
            <?php
			}//ενεργοποιημένες εγγραφές
			?>
			
			
            <?php
			}else{ //Ο χρήστης είναι συνδεδεμένος
			?>
			
			<h1>Μελέτες χρήστη</h1>
			<div class="box">
				
			<div class="box-header">

			<form class="form-inline" role="form" action="" method="post">
			<div class="form-group has-primary">
				<input class="form-control input-sm" type="text" name="onoma_meletis" id="onoma_meletis" size="50" placeholder="Όνομα νέας μελέτης">
			</div>	
			<div class="form-group">	
				<div class="col-md-12">
				<button type="submit" name="submit" value="neameleti" class="btn btn-success"><span class="fa fa-pencil"></span> Δημιουργία</button>
				</div>
			</div>
			<div class="form-group has-primary has-feedback pull-right">
				<input class="form-control input-sm" type="text" id="meleti_like" placeholder="Αναζήτηση..." onkeyup="get_meletes();">
				<span class="fa fa-search"></span>
			</div>
			</form>

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
			}
			</script>
			<!-- /.box-header -->
				<div class="box-body table-responsive no-padding">
					<div id="meletes_table"></div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
			
			<hr>
			<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>
			
			<script>
			function get_meletes(page){
			page = typeof page !== 'undefined' ? page : 1;
				document.getElementById('wait').style.display="inline";
				var like = document.getElementById('meleti_like').value;
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_vivliothikes.php?getmeletes=1&page="+page+"&like="+like ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("meletes_table").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					setUpToolTipHelpers();
				}}
			}
			get_meletes();
			</script>
			
			
			<?php
				$xmltxt = "";
			
				// array σε μορφή javascript
				$i=1;
				foreach($data_meletes as $data){
					if($xmltxt!=""){
						$xmltxt.=",";
					}
					$xmltxt .= "[".$data["id"].",'".$data["name"]."','".$data["perigrafi"]."','".$data["address"]."',".$data["address_x"].",".$data["address_y"].",'".$data["xrisi"]."']";
					$php_points[$i][0]=$data["id"];
					$php_points[$i][1]=$data["name"];
					$php_points[$i][2]=$data["perigrafi"];
					$php_points[$i][3]=$data["address"];
					$php_points[$i][4]=$data["address_x"];
					$php_points[$i][5]=$data["address_y"];
					$php_points[$i][6]=$data["xrisi"];
					$i++;
				}			
			?>
			<style>
			  #mapCanvas {
				width: 100%;
				height: 500px;
				padding: 3px;
				border: 5px solid #ddd;
			  }
			  #infoPanel {
				float: left;
				margin-left: 10px;
			  }
			  #infoPanel div {
				margin-bottom: 5px;
			  }
			</style>
			
			<style type="text/css">
				#mapdiv {
				width:100%; height:100%; margin:0;
				}
			</style>
			<style>
		/* popup style */
		.ol-popup
		{	max-width:300px;
			min-width:100px;
			min-height:1em;
		}
		/* Image on popup */
		.ol-popup img 
		{	float: left;
			margin: 0 0.5em 0 0;
			max-width: 100px;
			max-height: 100px;
		}
		/* no image content tooltips */
		.ol-popup.tooltips img
		{	display:none;
		}

		/* Custom orange style (tips) */
		.ol-popup.tips.orange
		{	border-color:#da7;
			background-color:#eca;
		}
		.ol-popup.tips.orange .anchor::before
		{	border-color: #da7 transparent;
		}
		.ol-popup-middle.tips.orange .anchor::before
		{	border-color: transparent #da7;
		}

		/* orange style (default) */
		.ol-popup.default.orange
		{	border:4px solid #f96;
		}
		.ol-popup.default.orange .anchor::after
		{	margin: 6px /*border:4 +2 px */ -9px; 
		}
		.ol-popup-middle.default.orange .anchor::after
		{	margin: -9px 6px /*border:4 +2 px */; 
		}
		.ol-popup.default.orange .anchor::before
		{	border-color: #f96 transparent;
		}
		.ol-popup-middle.default.orange .anchor::before
		{	border-color: transparent #da7;
		}
		.ol-popup.default.orange .closeBox
		{	background-color: rgba(255, 153, 102, 0.7);
		}
		.ol-popup.default.orange .closeBox:hover
		{	background-color: rgba(255, 153, 102, 1);
		}

		
		#osminfo {
        z-index: 1;
        opacity: 0;
        position: absolute;
        bottom: 0;
        left: 0;
        margin: 0;
        background: rgba(0,60,136,0.7);
        color: white;
        border: 0;
        transition: opacity 100ms ease-in;
      }
    </style>
		
			<?php
				if($prefs_googlemaps==1){//Έχουν οριστεί χάρτες google. Φόρτωση GOOGLE MAPS
			?>
			<div id="mapCanvas"></div>
			<?php
				}//Έχουν οριστεί χάρτες google. Φόρτωση GOOGLE MAPS
			?>
			
			
			<?php
				if($prefs_googlemaps==0){//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
			?>
			<div id="osmmap" class="map"><div id="popup"></div></div>
			<div id="osminfo"></div>
			<?php
				}//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
			?>
			
			
			<script>
			//ΜΕΛΕΤΕΣ ΣΕ JSON
			var points = [<?php echo $xmltxt; ?>];
			</script>
			
			<?php
				if($prefs_googlemaps==0){//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
			?>
			<!--OSM MAPS-->
			<script>
			//ΕΙΚΟΝΙΔΙΑ
				var vectorSource = new ol.source.Vector({
					//create empty vector
				});
				var markers = [];
				//var positions = [];
				
				
				function AddMarkers() {
					
					//Εικονίδιο κατοικίας
					var style_house = new ol.style.Style({
						image: new ol.style.Icon(({
							anchor: [0.3, 24],
							anchorXUnits: 'fraction',
							anchorYUnits: 'pixels',
							opacity: 0.75,
							src: 'images/map_pins/home.png'
						}))
					});
					//Εικονίδιο άλλη χρήση
					var style_industry = new ol.style.Style({
						image: new ol.style.Icon(({
							anchor: [0.3, 24],
							anchorXUnits: 'fraction',
							anchorYUnits: 'pixels',
							opacity: 0.75,
							src: 'images/map_pins/house.png'
						}))
					});
					
					//Μελέτες
					for (var i=0;i<points.length;i++){
						var x= points[i][5];
						var y= points[i][4];

						var iconFeature = new ol.Feature({
							geometry: new ol.geom.Point([x,y]),
							name: points[i][1],
							perigrafi: points[i][2],
							address: points[i][3],
							type_m: points[i][6]
						});
						markers[i]= [x,y];
							if(points[i][6]=="1" || points[i][6]=="2" ){
								iconFeature.setStyle(style_house);
							}else{
								iconFeature.setStyle(style_industry);
							}
						
						vectorSource.addFeature(iconFeature);
					}
					
					//add the feature vector to the layer vector, and apply a style to whole layer
					var vectorLayer = new ol.layer.Vector({
						title: "Μελέτες",
						source: vectorSource
					});
						return vectorLayer;
				}

				
				//ΣΤΡΩΣΕΙΣ
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
						},
						attributions: [
							new ol.Attribution({
								html: 'Base map  © <a href="https://www.ktimanet.gr/CitizenWebApp/Orthophotographs_Page.aspx">Κτηματολόγιο Base MAP</a>'
							})
						]
						})
					}),
					new ol.layer.Tile({
						title: "Όρια ΟΤΑ (Καποδίστριας)",
						baseLayer: false,
						visible: false,
						opacity: 0.5,
						source: new ol.source.TileWMS({
						url: 'http://geodata.gov.gr/geoserver/ows?service=WMS&request=GetCapabilities',
						params: {
						  'LAYERS': 'geodata.gov.gr:0adb0521-2223-43cd-96d3-d816ad7a193c',
						  'TILED': true
						},
						attributions: [
							new ol.Attribution({
								html: 'Layer  © <a href="http://geodata.gov.gr">Geodata.gov.gr</a>'
							})
						]
						})
					}),
					new ol.layer.Tile({
						title: "Δήμοι (Καλλικράτης)",
						baseLayer: false,
						visible: false,
						opacity: 0.5,
						source: new ol.source.TileWMS({
						url: 'http://geodata.gov.gr/geoserver/ows?service=WMS&request=GetCapabilities',
						params: {
						  'LAYERS': 'geodata.gov.gr:c7b5978b-aca9-4d74-b8a5-d3a48d02f6d0',
						  'TILED': true
						},
						attributions: [
							new ol.Attribution({
								html: 'Layer  © <a href="http://geodata.gov.gr">Geodata.gov.gr</a>'
							})
						]
						})
					}),
					new ol.layer.Tile({
						title: "Οικισμοί",
						baseLayer: false,
						visible: false,
						source: new ol.source.TileWMS({
						url: 'http://geodata.gov.gr/geoserver/ows?service=WMS&request=GetCapabilities',
						params: {
						  'LAYERS': 'geodata.gov.gr:f45c73bd-d733-4fe0-871b-49f270c56a75',
						  'TILED': true
						},
						attributions: [
							new ol.Attribution({
								html: 'Layer  © <a href="http://geodata.gov.gr">Geodata.gov.gr</a>'
							})
						]
						})
					})
				];
				
				
				//ΓΕΩΔΑΙΤΙΚΟ ΣΥΣΤΗΜΑ ΑΝΑΦΟΡΑΣ - (Κτηματολόγιο)
				var myProjection = new ol.proj.Projection({
					code: 'EPSG:2100',
					extent: [104022.946289, 3850785.500488, 1007956.563293, 4624047.765686],
					units: 'm'
				});   

				ol.proj.addProjection(myProjection);
				
				//ΧΑΡΤΗΣ
				var osmmap = new ol.Map({
					controls: ol.control.defaults().extend([
						new ol.control.ScaleLine(),
						new ol.control.OverviewMap(),
						new ol.control.LayerPopup()
					]),
					layers: layers,
					target: 'osmmap',
					view: new ol.View({
						projection: 'EPSG:4326',
						center: [22, 37],
						zoom: 8
					})
				});
				
				//ΣΤΡΩΣΗ ΜΕΛΕΤΩΝ (VECTOR)
				var layerMarkers = AddMarkers();
				osmmap.addLayer(layerMarkers);
				console.log(points);
				
				zoomslider = new ol.control.ZoomSlider();
				osmmap.addControl(zoomslider);
		
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
				
				//ΑΝΑΖΗΤΗΣΗ
				//Τοποθεσίες
				<?php
				echo "var positions = [";
					foreach ($php_points as $points){
						echo "{ name:\"".$points[1]."\", pos:[".$points[5].", ".$points[4]."], zoom:20 },";
					}
				echo "];";
				?>
				/*
				var positions = [	
					{ name:"Paris", pos:ol.proj.transform([2.351828, 48.856578], 'EPSG:4326', 'EPSG:2100'), zoom:11 },
					{ name:"London", pos:ol.proj.transform([-0.1275,51.507222], 'EPSG:4326', 'EPSG:2100'), zoom:11 }
				];
				*/
				
				
				//ΑΝΑΖΗΤΗΣΗ ΣΕ ΜΕΛΕΤΕΣ
				
				//SELECT ΜΕ ΒΑΣΗ ΤΟ OS.EXT
				var select = new ol.interaction.Select({});
				osmmap.addInteraction(select);

				// Set the control grid reference
				var search = new ol.control.SearchFeature(
					{	//target: $(".options").get(0),
						source: vectorSource,
						property: $(".options select").val()
					});
				osmmap.addControl (search);

				// Select feature when click on the reference index
				search.on('select', function(e){
						select.getFeatures().clear();
						select.getFeatures().push (e.search);
						var p = e.search.getGeometry().getFirstCoordinate();
						osmmap.getView().animate({ center:p, zoom:20 });
					});
				/*
				//SELECT ΜΕ ΒΑΣΗ PLAIN JAVASCRIPT
				var search = new ol.control.Search({
				// Title to use in the list
					getTitle: function(f) { return f.name; },
					// Search result
					autocomplete: function (s, cback){	
						var result = [];
						// New search RegExp
						var	rex = new RegExp(s.replace("*","")||"\.*", "i");
						for (var i=0; i<positions.length; i++){
							if (rex.test(positions[i].name)) result.push (positions[i]);
						}
						return result;
					}
				});
				osmmap.addControl (search);
				// Center when click on the reference index
				search.on('select', function(e){
					osmmap.getView().animate({
					center: e.search.pos,
					zoom: e.search.zoom,
					easing: ol.easing.easeOut
					})
				});
				*/
				
				//ΣΥΝΤΕΤΑΓΜΕΝΕΣ INFO
				var mouse_position = new ol.control.MousePosition({
					coordinateFormat: ol.coordinate.createStringXY(4),
					projection: 'EPSG:4326'
				});
				osmmap.addControl(mouse_position);
				
				
				//POPUP ΒΟΗΘΕΙΑ ΣΕ MARKER
				var element = document.getElementById('popup');

				var popup = new ol.Overlay({
					element: element,
					positioning: 'bottom-center',
					stopEvent: false,
					offset: [0, -50]
				});
				osmmap.addOverlay(popup);

				// display popup on click
				osmmap.on('click', function(evt) {
					var feature;
					feature = osmmap.forEachFeatureAtPixel(evt.pixel,
					function(feature, layer) {
						return feature;
					});
					if (feature) {
						var geometry = feature.getGeometry();
						var coord = geometry.getCoordinates();
						popup.setPosition(coord);
						$(element).popover({
							'placement': 'top',
							'html': true,
							'content': feature.get('name')+'<br/>'+feature.get('perigrafi')+'<br/>'+feature.get('address')
						});
						$(element).popover('show');
					} else {
						$(element).popover('destroy');
					}
				});

				// change mouse cursor when over marker
				osmmap.on('pointermove', function(e) {
					if (e.dragging) {
						$(element).popover('destroy');
						return;
					}
					var pixel = osmmap.getEventPixel(e.originalEvent);
					var hit = osmmap.hasFeatureAtPixel(pixel);
					//osmmap.getTarget().style.cursor = hit ? 'pointer' : '';
				});
				
				 osmmap.on('pointermove', showInfo);
				var info = document.getElementById('osminfo');
				  function showInfo(event) {
					var features = osmmap.getFeaturesAtPixel(event.pixel);
					if (!features) {
					  info.innerText = '';
					  info.style.opacity = 0;
					  return;
					}
					var properties = features[0].getProperties();
					info.innerHTML = JSON.stringify(properties, null, 2);
					info.style.opacity = 1;
				  }
				
			</script>
			<?php
				}//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
			?>
			
			<?php
				if($prefs_googlemaps==1){//Έχουν οριστεί χάρτες google.
			?>
			<script type="text/javascript">
			
			var map = new google.maps.Map(document.getElementById('mapCanvas'), {
			  zoom: 11,
			  center: new google.maps.LatLng(37.56, 22.8),
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			});

			var infowindow = new google.maps.InfoWindow();

			var marker, i;
			var html = new Array();

			for (i = 0; i < points.length; i++) {
			
				var id = points[i][0];
				var name = points[i][1];
				var perigrafi = points[i][2];
				var address = points[i][3];
				if(points[i][6]>0){
				var type = points[i][6];
				}else{
				var type=0;
				}
				var lat = points[i][4];
				var lon = points[i][5];
				html[i] = "<b>Meleti_id:</b>"+id+"<br/>" + "<b>Μελέτη:</b>"+name+"<br/>" + "<b>Περιγραφή:</b>"+perigrafi+"<br/>" + "<b>Διεύθυνση:</b>"+address+"<br/>" +
				"<b>Τύπος:</b>"+type+"<br/>" + "<b>lat:</b>"+lat+"<br/>" + "<b>lon:</b>"+lon+"<br/>";
			

				var myLatLng = 	new google.maps.LatLng(lat, lon);

				  marker = new google.maps.Marker({
					position: myLatLng,
					map: map
				  });

				  google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
					  infowindow.setContent(html[i]);
					  infowindow.open(map, marker);
					}
				  })(marker, i));

			}
			
			</script>
			<?php
				}//Έχουν οριστεί χάρτες google.
			?>
			
            <?php
			}//Ο χρήστης είναι συνδεδεμένος
			?>
		</div><!-- /span10 -->

</div>
 <!-- /.row (main row) -->
	
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->