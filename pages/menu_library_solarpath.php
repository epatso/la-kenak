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
//confirm_logged_in();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
	<h1>
	La-kenak
	<small>Ηλιακή τροχιά</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-university"></i> Βιβλιοθήκες</a></li>
	<li class="active"> Ηλιακή τροχιά</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
	<div class="col-md-12">	
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab">Έτος - Maps</a></li>
			<li><a href="#tabs-2" data-toggle="tab">Έτος - ΚΕΝΑΚ</a></li>
			<li><a href="#tabs-3" data-toggle="tab">Σήμερα</a></li>
			<li><a href="#tabs-4" data-toggle="tab">Θεωρητικό υπόβαθρο</a></li>
		</ul>
		<div class="tab-content">	
			<div class="tab-pane active" id="tabs-1">
			<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>
			<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
				
				
				<?php
					if($prefs_googlemaps==1){//Έχουν οριστεί χάρτες google. Φόρτωση GOOGLE MAPS
				?>
				<div id="mapcontainer" style="tabindex: -1">
					<div id="mapCanvas" style="background-color: rgb(229, 227, 223); overflow: hidden; transform: rotate(0deg);">
					</div>
				</div>
				<?php
					}//Έχουν οριστεί χάρτες google. Φόρτωση GOOGLE MAPS
				?>
				
				<?php
					if($prefs_googlemaps==0){//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
				?>
				<div id="osmmap" style="width: 100%; height: 600px;"><div id="popup"></div></div>
				<?php
					}//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
				?>
				
				
				<div id="infoPanel"></div>
				
				<script>
				function get_solarpath(lat,lon){

					document.getElementById('wait').style.display="inline";
					var link="includes/functions_meleti_draw.php?create_solarpath=1&lat="+lat+"&lon="+lon;
					//AJAX call
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.open('GET', link, true);
					xmlhttp.send();
					
					xmlhttp.onreadystatechange=function()  {
						if (xmlhttp.readyState==4 && xmlhttp.status==200) {
							document.getElementById('solarpath_img').innerHTML = xmlhttp.responseText;
							document.getElementById('wait').style.display="none";
						}
					}
				}
				</script>
				
				<?php
					if($prefs_googlemaps==1){//Έχουν οριστεί χάρτες google. Φόρτωση GOOGLE MAPS
				?>
				<script>
				//Google Maps
				function updateMarkerPosition(latLng) {
					document.getElementById('infoPanel').innerHTML = "Lat:"+latLng.lat()+" - Lon:"+latLng.lng();
				}
				
				function initialize() {
				var mapcontainer = $('#mapcontainer');
				var mapdiv = $('#mapCanvas');
				  var latLng = new google.maps.LatLng(37, 22);
				  var HomelatLng = new google.maps.LatLng(37, 22);
				  var image = 'images/map_pins/Home.png';
				  
				  var mapzoom = 5;
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
					title: 'Ηλιακή τροχιά',
					map: map,
					draggable: true,
					icon: 'images/map_pins/icon_cyan2.png'
				  });
				  
				  // Update current position info.
				  updateMarkerPosition(latLng);
				  get_solarpath(marker.getPosition().lat(),marker.getPosition().lng());
				  
				  google.maps.event.addListener(marker, 'dragend', function() {
					get_solarpath(marker.getPosition().lat(),marker.getPosition().lng());
					updateMarkerPosition(marker.getPosition());				
				  });
				  google.maps.event.addDomListener(map, 'resize', function() {
					map.setCenter(latLng);
				  });
				}
				
				// Onload handler to fire off the app.
				google.maps.event.addDomListener(window, 'load', initialize);
				//Google Maps
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
	
	var iconFeature = new ol.Feature(new ol.geom.Point([22.736,37.619]));
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
		title: "Solar place",
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
			center: [22.736,37.619],
			zoom: 8
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
		get_solarpath(lat,lon);
	},iconFeature);
	osmmap.addInteraction(dragInteraction);
	
	 get_solarpath(37.619,22.736);
</script>
<?php
	}//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
?>


				<br/><br/>
				Χρήσιμοι σύνδεσμοι:
				<ul>
					<li><a href="https://github.com/mourner/suncalc" target="_blank">suncalc σε συνδυασμό με google maps.</a></li>
					<li><a href="http://www.suncalc.org/#/37.5425,22.7625,5/2017.04.28/15:36/1/0" target="_blank">Suncalc online app</a></li>
					<li><a href="http://aa.quae.nl/en/reken/zonpositie.html" target="_blank">Άρθρο αστρονομικών υπολογισμών</a></li>
					<li><a href="http://oscar6echo.blogspot.gr/2012/11/sun-motion-3-analemma.html" target="_blank">Άρθρο (analema,elevation)</a></li>
					<li><a href="http://andrewmarsh.com/apps/releases/sunpath3d.html" target="_blank">3D Solar study από τον Andrew Marsh</a></li>
					<li><a href="https://github.com/gregseth/suncalc-php" target="_blank">Suncalc PHP Github repo</a></li>
					<li><a href="http://xyplot.drque.net/" target="_blank">XY Plot php class</a></li>
					<li><a href="http://www.compadre.org/osp/search/search.cfm?gs=222&SS=860&SE1=1266&b=1" target="_blank">Solar studies - Open source JSEE</a></li>
					<li><a href="https://bl.ocks.org/mbostock/7784f4b2c7838b893e9b" target="_blank">Sun chart open source resource</a></li>
					<li><a href="https://gist.github.com/mbostock/7784f4b2c7838b893e9b" target="_blank">Sun chart now - Github</a></li>
				</ul>
				<br/>
				<a href="#video_popup" role="button" class="btn btn-default" data-toggle="modal"><i class="fa fa-life-ring"></i> Βίντεο - Τροχιά Γης</a>
				</div>
				<div class="col-md-6">
					<div id="solarpath_img"></div>
				</div>
			
			</div><!--row-->
			</div><!--container-->
<!-- ###################### Κρυφό peri_popup για εμφάνιση ###################### -->
<div id="video_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">
				<?php
				echo APPLICATION_NAME." - v.".APPLICATION_VERSION;
				?>
				- Ηλιακή τροχιά
				</h3>
			</div>
			
			<div class="modal-body">
				<iframe width="100%" height="400" src="https://www.youtube.com/embed/82p-DYgGFjI" frameborder="0" allowfullscreen></iframe>
			</div>
			
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Κλείσιμο</button>
			</div>
		</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->			
			
			
			</div>
			<!--tab-->
			
			<!--tab-->
			<div class="tab-pane" id="tabs-2">
			<h4>Εμφάνιση διαγραμμάτων ηλιακής τροχιάς:</h4>
			<select id="place" onchange="show_solar();" onkeyup="show_solar();">
				<option value=0>Επιλέξτε περιοχή...</option>
				<?php
				$database = new medoo(DB_NAME);
				$db_table = "vivliothiki_climate_places";
				$db_columns = array ("id","place");
				$data_places = $database->select($db_table,$db_columns);
				
				foreach($data_places as $data){
				echo "<option value=\"".$data["id"]."\">".$data["place"]."</option>";
				}
				?>
			</select>
			
			<br/>
			<div id="diagrammata"></div>
			
			<script>
			function show_solar(){
				var id = document.getElementById('place').value;
				html = "<img src=\"images/climate/solar/id"+id+"_1.png\"><img src=\"images/climate/solar/id"+id+"_2.png\">";
				document.getElementById('diagrammata').innerHTML = html;
			}
			</script>
			<br/><br/>
			</div>
			<!--tab-->
			
			<!--tab-->
			<div class="tab-pane" id="tabs-3">
				<style>

				path {
				fill: none;
				stroke-linecap: round;
				stroke-linejoin: round;
				}

				text {
				font: 10px sans-serif;
				}

				.horizon {
				stroke: #000;
				stroke-width: 1.5px;
				}

				.graticule {
				stroke: #000;
				stroke-opacity: .15;
				}

				.solar-path {
				stroke: #f00;
				stroke-width: 2px;
				}

				.sun circle {
				fill: red;
				stroke: #000;
				}

				.sun text {
				text-anchor: middle;
				}

				.ticks--sun circle {
				fill: red;
				stroke: #fff;
				stroke-width: 2px;
				}

				.ticks--sun text {
				text-shadow: 0 1px 0 #fff, 0 -1px 0 #fff, 1px 0 0 #fff, -1px 0 0 #fff;
				}

				.ticks line {
				stroke: #000;
				}

				.ticks text {
				text-anchor: middle;
				}

				.ticks--azimuth text:nth-of-type(9n + 1) {
				font-weight: bold;
				font-size: 14px;
				}

				#waiting {
				font: 14px sans-serif;
				position: absolute;
				top: 540px;
				left: 240px;
				width: 480px;
				margin: auto;
				text-align: center;
				}

				#waiting b {
				font-size: 24px;
				line-height: 1.5em;
				}

				</style>
				<svg width="960" height="960"></svg>
				<div id="waiting">
				  <b>Determining your location… please wait.</b>
				  <br>(If prompted, please allow this page to access your location.)
				</div>
				<script src="//d3js.org/d3.v3.min.js"></script>
				<script src="includes/suncalc/sunchart-top/solar-calculator.js"></script>
				<script>

				var svg = d3.select("svg"),
					width = +svg.attr("width"),
					height = +svg.attr("height"),
					scale = width * .45;

				var formatTime = d3.time.format("%-I %p"),
					formatNumber = d3.format(".1f"),
					formatAngle = function(d) { return formatNumber(d) + "°"; };

				var projection = d3.geo.projection(flippedStereographic)
					.scale(scale)
					.clipAngle(130)
					.rotate([0, -90])
					.translate([width / 2 + .5, height / 2 + .5])
					.precision(.1);

				var path = d3.geo.path()
					.projection(projection);

				svg.append("path")
					.datum(d3.geo.circle().origin([0, 90]).angle(90))
					.attr("class", "horizon")
					.attr("d", path);

				svg.append("path")
					.datum(d3.geo.graticule())
					.attr("class", "graticule")
					.attr("d", path);

				var ticksAzimuth = svg.append("g")
					.attr("class", "ticks ticks--azimuth");

				ticksAzimuth.selectAll("line")
					.data(d3.range(360))
				  .enter().append("line")
					.each(function(d) {
					  var p0 = projection([d, 0]),
						  p1 = projection([d, d % 10 ? -1 : -2]);

					  d3.select(this)
						  .attr("x1", p0[0])
						  .attr("y1", p0[1])
						  .attr("x2", p1[0])
						  .attr("y2", p1[1]);
					});

				ticksAzimuth.selectAll("text")
					.data(d3.range(0, 360, 10))
				  .enter().append("text")
					.each(function(d) {
					  var p = projection([d, -4]);

					  d3.select(this)
						  .attr("x", p[0])
						  .attr("y", p[1]);
					})
					.attr("dy", ".35em")
					.text(function(d) { return d === 0 ? "N" : d === 90 ? "E" : d === 180 ? "S" : d === 270 ? "W" : d + "°"; });

				svg.append("g")
					.attr("class", "ticks ticks--elevation")
				  .selectAll("text")
					.data(d3.range(10, 91, 10))
				  .enter().append("text")
					.each(function(d) {
					  var p = projection([0, d]);

					  d3.select(this)
						  .attr("x", p[0])
						  .attr("y", p[1]);
					})
					.attr("dy", ".35em")
					.text(function(d) { return d + "°"; });

				navigator.geolocation.getCurrentPosition(located);

				function located(geolocation) {
				  var solar = solarCalculator([geolocation.coords.longitude, geolocation.coords.latitude]);

				  d3.select("#waiting").transition()
					  .style("opacity", 0)
					  .remove();

				  svg.insert("path", ".sphere")
					  .attr("class", "solar-path");

				  var sun = svg.insert("g", ".sphere")
					  .attr("class", "sun");

				  sun.append("circle")
					  .attr("r", 5);

				  sun.append("text")
					  .attr("class", "sun-label sun-label--azimuth")
					  .attr("dy", ".71em")
					  .attr("y", 10);

				  sun.append("text")
					  .attr("class", "sun-label sun-label--elevation")
					  .attr("dy", "1.81em")
					  .attr("y", 10);

				  var tickSun = svg.insert("g", ".sphere")
					  .attr("class", "ticks ticks--sun")
					.selectAll("g");

				  refresh();

				  setInterval(refresh, 1000);

				  function refresh() {
					var now = new Date,
						start = d3.time.day.floor(now),
						end = d3.time.day.offset(start, 1);

					svg.select(".solar-path")
						.datum({type: "LineString", coordinates: d3.time.minutes(start, end).map(solar.position)})
						.attr("d", path);

					sun
						.datum(solar.position(now))
						.attr("transform", function(d) { return "translate(" + projection(d) + ")"; });

					sun.select(".sun-label--azimuth")
						.text(function(d) { return formatAngle(d[0]) + " φ"; });

					sun.select(".sun-label--elevation")
						.text(function(d) { return formatAngle(d[1]) + " θ"; });

					tickSun = tickSun
					  .data(d3.time.hours(start, end), function(d) { return +d; });

					tickSun.exit().remove();

					var tickSunEnter = tickSun.enter().append("g")
						.attr("transform", function(d) { return "translate(" + projection(solar.position(d)) + ")"; });

					tickSunEnter.append("circle")
						.attr("r", 2.5);

					tickSunEnter.append("text")
						.attr("dy", "-.31em")
						.attr("y", -6)
						.text(formatTime);
				  }
				}

				d3.select(self.frameElement).style("height", height + "px");

				function flippedStereographic(λ, φ)  {
				  var cosλ = Math.cos(λ),
					  cosφ = Math.cos(φ),
					  k = 1 / (1 + cosλ * cosφ);
				  return [
					k * cosφ * Math.sin(λ),
					-k * Math.sin(φ)
				  ];
				}

				</script>
			
			</div>
			<!--tab-->
			
			<!--tab-->
			<div class="tab-pane" id="tabs-4">
				<h4>Εξισώσεις που περιγράφουν την ηλιακή τροχιά:</h4><br/>
				Ηλιακό ύψος: sin(α) = sin(δ)*sin(φ) + cos(δ)*cos(φ)*cos(ω) = cos(θz) [TOTEE-20701-3, σελ 48, σχ 4.11]<br/>
				,όπου:<br/>
				ω: ωριαία γωνία για δεδομένη ώρα της μέρας<br/>
				δ: ηλιακή απόκλιση<br/>
				φ: γεωγραφικό πλάτος περιοχής<br/>
				<br/>
				Ηλιακό αζιμούθιο: γ<sub>s</sub> = C<sub>1</sub>*C<sub>2</sub>*[(sin(ω)*cos(δ))/sin(θz)] + C<sub>3</sub>*180*(1-C<sub>1</sub>*C<sub>2</sub>)/2  [TOTEE-20701-3, σελ 48, σχ 4.12]<br/>
				,όπου:<br/>
				C<sub>1</sub>: 1 αν ω&#8804;ω<sub>ew</sub> ή -1 αν ω>ω<sub>ew</sub><br/>
				C<sub>2</sub>: 1 αν (φ-δ)&#8805;0 ή -1 αν (φ-δ)<0<br/>
				C<sub>3</sub>: 1 αν ω&#8805;ω<sub>ew</sub> ή -1 αν ω<ω<sub>ew</sub><br/>
				cos(ω<sub>ew</sub>)=tan(δ)/tan(φ)<br/>
			</div>
			<!--tab-->
		</div><!--tab content-->
			</div><!--tabs-->
</div><!--col-md-12-->	
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
	$("input").alphanum();	
</script>	