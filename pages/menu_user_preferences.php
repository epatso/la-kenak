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
	<small>Λογαριασμός χρήστη</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-user"></i> Χρήστης</a></li>
	<li class="active">Λογαριασμός χρήστη</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- Main row -->
<div class="row">
<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>
	<?php
		$database = new medoo(DB_NAME);
		$db_table = "core_users";
		$db_columns = "*";
		$where_id = array("id" => $_SESSION['user_id']);
		$select_user = $database->select($db_table,$db_columns,$where_id);
		
		$email = $select_user[0]["email"];
		$onoma = $select_user[0]["onoma"];
		$epwnymo = $select_user[0]["epwnymo"];
		$eidikotita = $select_user[0]["eidikotita"];
		$address = $select_user[0]["address"];
		$address_x = $select_user[0]["address_x"];
		$address_y = $select_user[0]["address_y"];
		$address_z = $select_user[0]["address_z"];
		$tel = $select_user[0]["tel"];
		$fax = $select_user[0]["fax"];
		$taytotita = $select_user[0]["taytotita"];
		$afm = $select_user[0]["afm"];
		
		//Συνδρομή
		$subscribtion_start = $select_user[0]["subscribtion_start"];
		$subscribtion_end = $select_user[0]["subscribtion_end"];
		//php >5.3
		$date1 = new DateTime($subscribtion_start);
		$date2 = new DateTime($subscribtion_end);
		$datenow = new DateTime();
		$subscribtion_days = $date2->diff($date1)->format("%a");
		$days_left = $date2->diff($datenow)->format("%a");
		if($days_left<0){$days_left=0;}
		//Percent % μελετών
		$percent_days=round(100-($days_left/$subscribtion_days)*100,2);
		
		//Όριο μελετών
		$count_meletes = $database->count("user_meletes",array("user_id"=>$_SESSION['user_id']));
		$meletes_max = $select_user[0]["meletes_max"];
		$meletes_left = $meletes_max-$count_meletes;
		if($meletes_left<0){$meletes_left=0;}
		//Percent % μελετών
		$percent_meletes=round(100-($meletes_left/$meletes_max)*100,2);
		
		if($address_x==0 AND $address_y==0){
			$address_zoom=6;
		}else{
			$address_zoom=14;
		}
		if($address_x==0){$address_x=37.56;}
		if($address_y==0){$address_y=22.78;}
		
	$where_eidikotita=array("id"=>$eidikotita);
	$user_eidikotita = $database->select("core_eidikotitesmhx","*",$where_eidikotita);
	$user_eidikotita=$user_eidikotita[0]["name"];
		
	?>
	
		<div class="col-md-4">
		
<!-- Widget: user widget style 1 -->
<div class="box box-widget widget-user">
	<!-- Add the bg color to the header using any of the bg-* classes -->
	<div class="widget-user-header bg-aqua-active">
		<h3 class="widget-user-username"><?php echo $onoma." ".$epwnymo;?></h3>
		<h5 class="widget-user-desc"><?php echo $user_eidikotita;?></h5>
	</div>
	<div class="widget-user-image">
		<?php
		echo $user_image_tag1;
		?>
	</div>
	<div class="box-footer">
		<div class="row">
			<div class="col-sm-4 border-right">
				<div class="description-block">
					<h5 class="description-header"><i class="fa fa-globe" aria-hidden="true"></i></h5>
					<span class="description-text"><?php echo $address;?></span>
				</div>
			<!-- /.description-block -->
			</div>
			<!-- /.col -->
			
			<div class="col-sm-4 border-right">
				<div class="description-block">
					<h5 class="description-header"><i class="fa fa-phone" aria-hidden="true"></i></h5>
					<span class="description-text"><?php echo $tel;?></span>
				</div>
			<!-- /.description-block -->
			</div>
			<!-- /.col -->
			
			<div class="col-sm-4">
				<div class="description-block">
					<h5 class="description-header"><i class="fa fa-fax" aria-hidden="true"></i></h5>
					<span class="description-text"><?php echo $fax;?></span>
				</div>
			<!-- /.description-block -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
</div>
<!-- /.widget-user -->
			
			<!-- meletes-box -->
			 <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-building-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Μελετες</span>
              <span class="info-box-number">
				Απομένουν: <?php echo $meletes_left;?> μελέτες
			  </span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php echo $percent_meletes;?>%"></div>
              </div>
                  <span class="progress-description">
                    <i class="fa fa-building-o" aria-hidden="true"></i> <?php echo $count_meletes;?> από <?php echo $meletes_max;?> μελέτες.
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.meletes-box -->
			
			 <!-- subscription-box -->
			<div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-diamond"></i></span>
			
            <div class="info-box-content">
              <span class="info-box-text">Συνδρομη</span>
              <span class="info-box-number">
				Απομένουν: <?php echo $days_left;?> ημέρες
			  </span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php echo $percent_days;?>%"></div>
              </div>
                  <span class="progress-description">
					Από <?php echo $subscribtion_start;?> 
					έως <?php echo $subscribtion_end;?> .
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.subscription-box -->

			<a href="includes/filemanager/" target="_blank" role="button" class="btn btn-default" title="Φάκελος χρήστη">
			<i class="fa fa-folder-o"></i> 
			 Φάκελος - <?php echo $_SESSION['username'];?></a>
			<br/><br/>
			
			<?php			
			if(isset($_SESSION['msg']['pass-err'])){
				echo "<div class=\"alert alert-error\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				<strong>Προσοχή!</strong><br/>".$_SESSION['msg']['pass-err']."</div>";
				unset($_SESSION['msg']['pass-err']);
			}
			?>
			
		</div>
		
		<div class="col-md-8">
			<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs-1" data-toggle="tab"><i class="fa fa-id-badge"></i> Στοιχεία μηχανικού</a></li>
				<li><a href="#tabs-2" data-toggle="tab"><i class="fa fa-key"></i> Αλλαγή κωδικού</a></li>
				<li><a href="#tabs-3" data-toggle="tab"><i class="fa fa-user-secret"></i> Χρήση</a></li>
				<li><a href="#tabs-4" data-toggle="tab"><i class="fa fa-eye"></i> Εμφάνιση</a></li>
				<li><a href="#tabs-5" data-toggle="tab"><i class="fa fa-trash"></i> Διαγραφή δεδομένων</a></li>
			</ul>
			
			<div class="tab-content">
			<div class="tab-pane active" id="tabs-1">
			
				<form name="user_pref" action="" method="POST" data-toggle="validator">
				
					<table class="table table-bordered">
					<tr class="info">
						<td colspan="2"><i class="fa fa-user"></i> Στοιχεία μηχανικού</td>
					<tr>
					<tr>
						<td>
							<b>e-mail:</b>
						</td>
						<td>
							<div class="form-group has-feedback">
								<input class="form-control input-sm" type="text" id="email" name="email" value="<?php echo $email;?>" required>
								<div class="help-block with-errors"></div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<b>Όνομα:</b>
						</td>
						<td>
							<div class="form-group has-feedback">
								<input class="form-control input-sm" type="text" id="onoma" name="onoma" value="<?php echo $onoma;?>" required>
								<div class="help-block with-errors"></div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<b>Επώνυμο:</b>
						</td>
						<td>
							<div class="form-group has-feedback">
								<input class="form-control input-sm" type="text" id="epwnymo" name="epwnymo" value="<?php echo $epwnymo;?>" required>
								<div class="help-block with-errors"></div>
							</div>
						</td>
					</tr>
					<tr>
					<td>
						<b>Ειδικότητα:</b>
					</td>
						<td>
							<div class="form-group has-feedback">
								<select class="form-control input-sm" id="eidikotita" name="eidikotita" required>
								<?php
								echo create_select_optionsid("core_eidikotitesmhx","name");
								?>
								</select>
								<div class="help-block with-errors"></div>
								
								<script language="JavaScript">
									document.getElementById("eidikotita").selectedIndex=<?php echo $eidikotita-1;?>;
								</script>
							</div>
						</td>
					</tr>
					<tr>
					<tr class="info">
						<td colspan="2"><i class="fa fa-map"></i> Έδρα μηχανικού</td>
					<tr>
					<td>
						<b>Δ/νση:</b></td><td>
						<div class="col-sm-10">
							<input class="form-control input-sm" type="text" id="address" name="address" value="<?php echo $address;?>">
						</div>
						<div class="col-sm-2">
							<a href="#map_popup" role="button" class="btn btn-warning" data-toggle="modal" title="Χάρτης"><i class="fa fa-map"></i></a>
						</div>
					</td>
					</tr>
					<tr><td><b>Lat:</b></td><td><input class="form-control input-sm" type="text" id="address_x" name="address_x" value="<?php echo $address_x;?>"></td></tr>
					<tr><td><b>Lon:</b></td><td><input class="form-control input-sm" type="text" id="address_y" name="address_y" value="<?php echo $address_y;?>"></td></tr>
					<tr><td><b>z:</b></td><td><input class="form-control input-sm" type="text" id="address_z" name="address_z" value="<?php echo $address_z;?>"></td></tr>
					<tr class="info">
						<td colspan="2"><i class="fa fa-briefcase"></i> Πρόσθετα στοιχεία</td>
					<tr>
					<tr><td><b>Τηλέφωνο:</b></td><td><input class="form-control input-sm" type="text" id="tel" name="tel" value="<?php echo $tel;?>"></td></tr>
					<tr><td><b>Fax:</b></td><td><input class="form-control input-sm" type="text" id="fax" name="fax" value="<?php echo $fax;?>"></td></tr>
					<tr><td><b>Α.Δ.Τ.:</b></td><td><input class="form-control input-sm" type="text" id="taytotita" name="taytotita" value="<?php echo $taytotita;?>"></td></tr>
					<tr><td><b>Α.Φ.Μ.:</b></td><td><input class="form-control input-sm" type="text" id="afm" name="afm" value="<?php echo $afm;?>"></td></tr>
					</table>

					
<!-- ###################### Κρυφό map_popup για εμφάνιση ###################### -->
<div id="map_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h4 id="myModalLabel">
		<?php
		echo APPLICATION_NAME." - v.".APPLICATION_VERSION." - Έδρα μηχανικού";
		?>
		</h4>
	</div>

	<div class="modal-body">		
			<b>Έδρα μηχανικού:</b>
			
			<?php
				if($prefs_googlemaps==0){//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
			?>
			<div id="osmmap" style="width: 100%; height: 300px;"><div id="popup"></div></div>
			<?php
				}//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
			?>
			
			<?php
				if($prefs_googlemaps==1){//Έχουν οριστεί χάρτες google. Φόρτωση GOOGLE MAPS
			?>
			<div id="mapCanvas" style="width: 100%; height: 300px;"></div>
			<?php
				}//Έχουν οριστεί χάρτες google. Φόρτωση GOOGLE MAPS
			?>
			
			
			<span id="infoPanel"></span><span id="osminfo"></span>
			
			<span id="markerStatus"></span><br/>
			<b>Θέση:</b><input class="form-control input-sm" type="text" id="address_frommap" value="<?php echo $address;?>"><br/>
			<b>Lat:</b><input class="form-control input-sm" type="text" id="address_x_frommap" value="<?php echo $address_x;?>"><br/>
			<b>Lon:</b><input class="form-control input-sm" type="text" id="address_y_frommap" value="<?php echo $address_y;?>"><br/>
			<b>z:</b><input class="form-control input-sm" type="text" id="address_z_frommap" value="<?php echo $address_y;?>"><br/>
	</div>	
	<div class="modal-footer">			
		<button class="btn" data-dismiss="modal" aria-hidden="true" onclick="close_map();">ΟΚ</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->

<?php
	if($prefs_googlemaps==1){//Έχουν οριστεί χάρτες google. Φόρτωση GOOGLE MAPS
?>
<script type="text/javascript">
	
	//var map;
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
			if (results[0]) {
		   // Open an info window indicating the elevation at the clicked position
				document.getElementById("address_z_frommap").value = number_format(results[0].elevation,2);
			  } else {
				document.getElementById("address_z_frommap").value = "Δεν βρέθηκε";
			  }
			} else {
			  alert("Λάθος: " + status);
			}
		  });
	}

	function updateMarkerStatus(str) {
	  document.getElementById('markerStatus').innerHTML = str;
	}

	function updateMarkerPosition(latLng) {
		document.getElementById("address_x_frommap").value = number_format(latLng.lat(),5);
		document.getElementById("address_y_frommap").value = number_format(latLng.lng(),5);
	}

	function updateMarkerAddress(str) {
	  document.getElementById('address_frommap').value = str;
	}

	function initialize() {
	  var latLng = new google.maps.LatLng(<?php echo $address_x;?>, <?php echo $address_y;?>);
	  var mapzoom = <?php echo $address_zoom; ?>;
	  map = new google.maps.Map(document.getElementById('mapCanvas'), {
		zoom: mapzoom,
		center: latLng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	  });
	  var marker = new google.maps.Marker({
		position: latLng,
		title: 'Έδρα μηχανικού',
		map: map,
		draggable: true
	  });
	  
	  // Update current position info.
	  updateMarkerPosition(latLng);
	  geocodePosition(latLng);
	  
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
			src: 'images/map_pins/home.png'
		}))
	});
	iconFeature.setStyle(style_house);
	var vectorLayer = new ol.layer.Vector({
		title: "Έδρα",
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
			},
			attributions: [
				new ol.Attribution({
					html: 'Base map  © <a href="https://www.ktimanet.gr/CitizenWebApp/Orthophotographs_Page.aspx">Κτηματολόγιο Base MAP</a>'
				})
			]
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
	
	/*
	osmmap.addControl(new OpenLayers.Control.DragFeature(vectorLayer, {
		autoActivate: true,
		onComplete: function (feature) {
			alert('x=' + feature.geometry.x + ', y=' + feature.geometry.x);
		}
	}
	));
	*/
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
		document.getElementById('address_x_frommap').value = lat;
		document.getElementById('address_y_frommap').value = lon;
	},iconFeature);
	osmmap.addInteraction(dragInteraction);
	
	
</script>
<style>
	img.olTileImage {
		max-width: none;
	}
</style>
<?php
	}//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
?>

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


$('#map_popup').on('shown.bs.modal', function () {
	
	<?php
		if($prefs_googlemaps==1){
	?>
	//Για να εμφανίζεται σωστά στο modal ο χάρτης με Google Map
	var latLng = new google.maps.LatLng(<?php echo $address_x;?>, <?php echo $address_y;?>);
	var mapdiv = document.getElementById('mapCanvas');
	google.maps.event.trigger(mapdiv, "resize");
	<?php
		}else{
	?>
	//Για να εμφανίζεται σωστά στο modal ο χάρτης με OpenLayers
	osmmap.updateSize();
	<?php
		}
	?>
});

<?php
	if($prefs_googlemaps==0){//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
?>
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
			document.getElementById('address_frommap').value = address;
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
			document.getElementById('address_z_frommap').value = z;
			document.getElementById('wait').style.display="none";
		}
	}
}
<?php
	}//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
?>

function close_map(){
var address = document.getElementById('address_frommap').value;
var x = document.getElementById('address_x_frommap').value;
var y = document.getElementById('address_y_frommap').value;
var z = document.getElementById('address_z_frommap').value;
document.getElementById('address').value=address;
document.getElementById('address_x').value=number_format(x,5);
document.getElementById('address_y').value=number_format(y,5);
document.getElementById('address_z').value=number_format(z,2);
}
</script>
				<br/>
				<button type="submit" name="submit" value="save-userpref" class="btn btn-primary">Τροποποίηση στοιχείων</button>
				</form>
				
			
			</div>
			
			<div class="tab-pane" id="tabs-2"> 
			<form class="clearfix" action="" method="post" data-toggle="validator">
				<table>
				<tr>
					<td>
						<b>Παλαιός κωδικός:</b>
					</td>
					<td>
						<div id="control1" class="form-group has-feedback">
							<input class="form-control input-sm" type="password" id="password1" name="password1" onkeyup=check_pass() required />
							<div class="help-block with-errors"></div>
						</div>
					</td>
					<td rowspan="2">
						<span id="oldpass_help" class="help-inline"></span>
					</td>
				</tr>
				<tr>
					<td>
						<b>Παλαιός κωδικός (επιβεβαίωση):</b>
					</td>
					<td>
						<div id="control2" class="form-group has-feedback">
							<input class="form-control input-sm" type="password" id="password2" name="password2" onkeyup=check_pass() 
							data-match="#password1" data-match-error="Οι 2 υφιστάμενοι κωδικοί δε συμβαδίζουν" required />
							<div class="help-block with-errors"></div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<b>Νέος κωδικός:</b>
					</td>
					<td>
						<div id="control3" class="form-group has-feedback">
							<input class="form-control input-sm" type="password" id="newpassword1" name="newpassword1" onkeyup=check_pass() required />
							<div class="help-block with-errors"></div>
						</div>
					</td>
					<td rowspan="2">
					<span id="newpass_help" class="help-inline"></span>
					</td>
				</tr>
				<tr>
					<td>
						<b>Νέος κωδικός (επιβεβαίωση):</b>
					</td>
					<td>
						<div id="control4" class="form-group has-feedback">
							<input class="form-control input-sm" type="password" id="newpassword2" name="newpassword2" onkeyup=check_pass() 
							data-match="#newpassword1" data-match-error="Οι 2 νέοι κωδικοί δε συμβαδίζουν" required />
							<div class="help-block with-errors"></div>
						</div>
					</td>
				</tr>
				</table>
				<button type="submit" id="passsubmit" name="submit" value="update-password" class="btn btn-primary">Αλλαγή κωδικού</button>
				
				
			</form>
			</div>
			
			<div class="tab-pane" id="tabs-3">
			<?php
			$db_table = "user_logs";
			$db_columns = "*";
			$where_id=array("ORDER"=>array("dt" => "DESC"),"LIMIT"=>20,"user_id" => $_SESSION['user_id']);
			$select_logs = $database->select($db_table,$db_columns,$where_id);
			
			foreach($select_logs as $logs){
			echo "Στις : <span class=\"label label-info\">".$logs["dt"]."</span> από <span class=\"badge\">".$logs["regIP"]."</span><br/>";
			}
			?>
				<font color="red"><h5><i class="fa fa-trash"></i> Διαγραφή στοιχείων σύνδεσης χρήστη</h5></font>
				<form class="clearfix" action="" method="post">
					<div class="row">
						<div class="col-md-12">
							<button type="submit" id="deleteuserlogs_submit" name="submit" value="delete_userlogs" class="btn btn-danger">Διαγραφή στοιχείων σύνδεσης</button>
							<div id="dellogs_result"></div>
						</div>
					</div>
				</form>
			</div>
			
			<div class="tab-pane" id="tabs-4">
				<legend>Πίνακες λογισμικού (beta)</legend>
				<div class="row">
					<div class="col-md-4">
						Αριθμός στοιχείων στους πίνακες:
					</div>
					<div class="col-md-4">
						<input class="form-control input-sm" type="text" id="numberofelements" name="numberofelements" />
					</div>	
				</div>
				
				<legend>Εικόνα χρήστη</legend>
				<p>Επιλέξτε εικόνα και πατήστε "Αποστολή" </p>
				<form name="form5" enctype="multipart/form-data" method="post" action="includes/functions_userlibraries.php" />
					<div class="row">
						<div class="col-md-12">
							<input class="form-control input-sm" type="file" id="xhr_field" name="my_field"/><br/>
							<div id="xhr_status"></div>
							<input type="hidden" name="action" value="xhr" />
							<button class="btn btn-primary" name="Submit" type="submit" value="upload" id="xhr_upload">Αποστολή</button>
							<div id="file_result"></div>
						</div>
					</div>
				</form>
				
			</div>
					
<script type="text/javascript">

window.onload = function () {

  function xhr_send(f, e) {
	if (f) {
	  xhr.onreadystatechange = function(){
		if(xhr.readyState == 4){
		  document.getElementById("file_result").innerHTML = xhr.responseText;
		}
	  }
	  xhr.open("POST", "includes/functions_userlibraries.php?action=xhr");
	  xhr.setRequestHeader("Cache-Control", "no-cache");
	  xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	  xhr.setRequestHeader("X-File-Name", f.name);
	  xhr.send(f);
	}
  }

  function xhr_parse(f, e) {
	if (f) {
	  document.getElementById(e).innerHTML = "File selected : " + f.name + "(" + f.type + ", " + f.size + ")";
	} else {
	  document.getElementById(e).innerHTML = "No file selected!";
	}
  }

  var xhr = new XMLHttpRequest();

  if (xhr && window.File && window.FileList) {

	// xhr example
	var xhr_file = null;
	document.getElementById("xhr_field").onchange = function () {
	  xhr_file = this.files[0];
	  xhr_parse(xhr_file, "xhr_status");
	}
	document.getElementById("xhr_upload").onclick = function (e) {
	  e.preventDefault();
	  xhr_send(xhr_file, "xhr_result");
	}


  }
}
</script>
		
		
		<div class="tab-pane" id="tabs-5">
		
		<font color="red"><h4><i class="fa fa-trash"></i> ΠΡΟΣΟΧΗ: Διαγραφή δεδομένων</h4></font>
		Ο συγκεκριμένος τομέας αφορά τη διαγραφή μελετών, δεδομένων και στοιχείων χρήστη από το λογισμικό. <br/>
		Η επιλογή αυτή δίνεται σε περίπτωση που ο χρήστης επιθυμεί τη διαγραφή των προσωπικών του στοιχείων από το λογαριασμό του (δικαίωμα στη λήθη). <br/>
		Τα δεδομένα δεν μπορούν να ανακτηθούν. Έτσι οι συγκεκριμένες επιλογές θα πρέπει να χρησιμοποιείται με προσοχή. <br/>
		
		<font color="red"><h5><i class="fa fa-trash"></i> Διαγραφή όλων των μελετών</h5></font>
		<form class="clearfix" action="" method="post">
			<div class="row">
				<div class="col-md-12">
					<button type="submit" id="deletemeletes_submit" name="submit" value="delete_meletesall" class="btn btn-danger">Διαγραφή μελετών</button>
					<div id="delall_result"></div>
				</div>
			</div>
		</form>
		
		</div>


	
<script>
function check_pass(){
var pass1 = document.getElementById('password1').value;
var pass2 = document.getElementById('password2').value;
var pass3 = document.getElementById('newpassword1').value;
var pass4 = document.getElementById('newpassword2').value;
	
	if(pass1 != pass2){//Δεν συμπίπτει ο παλιός κωδικός
	document.getElementById('control1').className = "control-group error";
	document.getElementById('control2').className = "control-group error";
	document.getElementById('passsubmit').disabled = true;
	document.getElementById('oldpass_help').innerHTML = "Οι 2 κωδικοί πρέπει να συμπίπτουν";
	}else{//Συμπίπτει ο παλιός κωδικός
	document.getElementById('control1').className = "control-group";
	document.getElementById('control2').className = "control-group";
	document.getElementById('passsubmit').disabled = false;
	document.getElementById('oldpass_help').innerHTML = "";
	
		if(pass3 != pass4){//δεν συμπίπτει ο νέος κωδικός
		document.getElementById('control3').className = "control-group error";
		document.getElementById('control4').className = "control-group error";
		document.getElementById('passsubmit').disabled = true;
		document.getElementById('newpass_help').innerHTML = "Οι 2 κωδικοί πρέπει να συμπίπτουν";
		}else{//Συμπίπτει ο νέος κωδικός
		document.getElementById('control3').className = "control-group";
		document.getElementById('control4').className = "control-group";
		document.getElementById('passsubmit').disabled = false;
		document.getElementById('newpass_help').innerHTML = "";
		}
		
	}
}
</script>


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