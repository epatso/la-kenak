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
require("includes/suncalc/suncalc.php");
require("includes/XY_Plot/XY_Plot.php");
confirm_logged_in();
confirm_meleti_isset();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
	<h1>
	La-kenak
	<small>Σχεδίαση κτιρίου / Σκαριφήματα</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-edit"></i> Μελέτη ΚΕΝΑΚ</a></li>
	<li class="active"> Σχεδίαση</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
		
		<div class="col-md-12">
		<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>
			<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs-1" data-toggle="tab"><i class="fa fa-crosshairs" aria-hidden="true"></i> Κατόψεις</a></li>
				<li><a href="#tabs-2" data-toggle="tab"><i class="fa fa-cube" aria-hidden="true"></i> Όψεις</a></li>
				<li><a href="#tabs-3" data-toggle="tab"><i class="fa fa-cubes" aria-hidden="true"></i> 3D</a></li>
				<li><a href="#tabs-4" data-toggle="tab"><i class="fa fa-file-code-o" aria-hidden="true"></i> DXF</a></li>
				<li><a href="#tabs-5" data-toggle="tab"><i class="fa fa-map" aria-hidden="true"></i> Οδοιπορικό</a></li>
				<li><a href="#tabs-6" data-toggle="tab"><i class="fa fa-file-archive-o" aria-hidden="true"></i> zip</a></li>
				<li><a href="#tabs-7" data-toggle="tab"><i class="fa fa-info-circle" aria-hidden="true"></i> Βοήθεια</a></li>
			</ul>
			
			<div class="tab-content">
			
<!-- ######################### ΚΑΤΟΨΕΙΣ ############################ -->
<div class="tab-pane active" id="tabs-1">
	
<style>
.dg.a { position: absolute; margin-left:1em; margin-top:100px; height: 1400px;!important; }
</style>
	
	<h2>Θερμικές ζώνες</h2>
	<div id="tb_draworder"></div>
	<hr/>
	<h2>ΜΘΧ-Ηλιακοί χώροι</h2>
	<div id="tb_draworder_mthx"></div>

	<script>
	//Εμφάνιση των στοιχείων αδιαφανών σε πίνακα με λίστα
	function get_meleti_preview(){
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		
		xmlhttp.open("GET","includes/functions_meleti_draw.php?create_draworder=1",true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var arr = xmlhttp.responseText;
			document.getElementById("tb_draworder").innerHTML=arr;
			document.getElementById('wait').style.display="none";
		}}	
	}
	
	function get_meleti_preview_mthx(){
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		
		xmlhttp.open("GET","includes/functions_meleti_draw.php?create_draworder_mthx=1",true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var arr = xmlhttp.responseText;
			document.getElementById("tb_draworder_mthx").innerHTML=arr;
			document.getElementById('wait').style.display="none";
		}}	
	}
	
	get_meleti_preview();
	get_meleti_preview_mthx();
	</script>
</div><!-- tabs1 -->


<!-- ######################### ΟΨΕΙΣ ############################ -->
<div class="tab-pane" id="tabs-2">
<br/><br/>
Οι όψεις των δομικών στοιχείων των ζωνών παράγονται σταδιακά παρακάτω. Τα δομικά στοιχεία δεν εμφανίζονται σε σειρά, ούτε κατ' όροφο. 
<?php
//include("includes/webgl_solar_path.php");
	confirm_logged_in();
	$database = new medoo(DB_NAME);
	$table="meletes_zone_adiafani";
	$table_win="meletes_zone_diafani";
	$columns="*";
	
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_allwalls = $database->select($table,$columns,$where);
	
	echo "<div class=\"row\">";
	foreach($data_allwalls as $wall){
		$wall_img=teyxos_img_wall($wall["id"]);//functions_teyxos.php (επιστρέφει img tag
		//$wall_img = substr_replace($wall_img, "<img height=\"250px\"", 0, 4);//αλλάζει το '<img ' σε '<img height="200px"'
		
		echo "<div class=\"col-md-6\" style=\"text-align:center;\">";
		echo "<div class=\"img-responsive\">".$wall_img."</div>";
		echo "</div>";
	}
	echo "</div>";
?>


</div><!-- tabs2 -->


<!-- ######################### 3D - WEBGL ############################ -->
<div class="tab-pane" id="tabs-3">

<?php	
	//Βρίσκω τους ορόφους και τους βάζω σε σειρά από μικρότερο σε μεγαλύτερο
	$array_floors=array();
	foreach($data_allwalls as $wall){
		array_push($array_floors, $wall["roof"]);
	}
	$array_floors = array_unique($array_floors);
?>	

	<div class="row">
	<div class="col-md-6">
		<form class="form-inline" role="form" action="" method="post">
			<div class="input-group has-primary">
				<span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i> Όροφος</span>
				<select class="form-control input-sm" id="floor" name="floor">
					<option value="">Επιλέξτε όροφο...</option>
					<?php
					foreach($array_floors as $floors){
						if(isset($_POST["floor"]) AND $_POST["floor"]==$floors){
							$selected="selected";
						}else{
							$selected="";
						}
						echo "<option value=\"".$floors."\" ".$selected.">Όροφος ".$floors."</option>";
					}
					?>
				</select>
			</div>	
			<div class="form-group">	
				<button type="submit" name="submit" value="webgl" class="btn btn-success"><span class="fa fa-pencil"></span> Plot</button>
			</div>
		</form>
	</div>
	
	<div class="col-md-4">
		<a type="button" class="btn btn-info" onclick="savecanvas();">Εξαγωγή (png)</a>
	</div>
	
	<div class="col-md-2">
		Επιλέξτε όροφο για να εμφανιστεί το τρισδιάστατο μοντέλο.
	</div>
	</div><!--row-->
	
	<br/>
	
	<div class="row">
	<div class="col-md-2">
		<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i> Μήνας</span>
		<input class="form-control input-sm" type="range" id="month" min="1" max="12" value="1" oninput="document.getElementById('month_txt').innerHTML=this.value;getData(1);"/>
		<span class="input-group-addon" id="month_txt">1</span>
		</div>
	</div>
	
	<div class="col-md-2">
		<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i> Ημέρα</span>
		<input class="form-control input-sm" type="range" id="day" min="1" max="31" value="21" oninput="document.getElementById('day_txt').innerHTML=this.value;getData(1);"/>
		<span class="input-group-addon" id="day_txt">21</span>
		</div>
	</div>	
	
	<div class="col-md-2">
		<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i> Ώρα</span>
		<input class="form-control input-sm" type="range" id="hour" min="0" max="23" value="12" oninput="document.getElementById('hour_txt').innerHTML=this.value;getData(1);"/>
		<span class="input-group-addon" id="hour_txt">12</span>
		</div>
	</div>
	
	<div class="col-md-2">
		<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i> Λεπτά</span>
		<input class="form-control input-sm" type="range" id="sec" min="0" max="59" value="0" oninput="document.getElementById('sec_txt').innerHTML=this.value;getData(1);"/>
		<span class="input-group-addon" id="sec_txt">0</span>
		</div>
	</div>
	
	<div class="col-md-1">
		<a class="btn btn-warning" onclick="start_animate();"><i class="fa fa-forward" aria-hidden="true"></i></a>
		<a class="btn btn-warning" onclick="stop_animate();"><i class="fa fa-stop-circle-o" aria-hidden="true"></i></a>
	</div>
	
	<div class="col-md-2">
		<div id="console"></div>
	</div>
	</div><!--row-->
<?php
	if(isset($_POST["floor"])){
		$floor=$_POST["floor"];
	}else{
		$floor=1;
	}
	
	$building_data = $database->select("user_meletes","*",array("id"=>$_SESSION['meleti_id']));
	$building_g = $building_data[0]["pros"];
	$lat = $building_data[0]["address_x"];
	$lon = $building_data[0]["address_y"];
	
	$where=array(
		"AND"=>array(
			"user_id"=>$_SESSION['user_id'],
			"meleti_id"=>$_SESSION['meleti_id'],
			"roof"=>$floor
			),
		"ORDER"=>array(
			"draw_order"=>"ASC"
			)
		);
	$data_wall = $database->select($table,$columns,$where);
	?>
	<br/>

	<div id="3dCanvas"></div>
	<style>
		#datgui { position: absolute; top: -2px; right: 2px;opacity:0.8; }
		#statsgui { position: absolute; top: 2px; right: 15px }
	</style>
	
	<br/>
	Η WebGL βασίζεται στην υπολογιστική ισχύ του επεξεργαστή σας και της GPU. Τα αποτελέσματα μπορεί να διαφέρουν. <br/>
	Συντομεύσεις: "h"=Εναλλαγή μενού επιλογών δεξιά (DAT - Gui).<br/><br/>
	<div id="info">
		<a href="http://threejs.org" target="_blank" rel="noopener">three.js</a> - Physically accurate lighting example using a incandescent bulb<br />
		Using Reinhard inline tonemapping with real-world light falloff (decay = 2).
	</div>
	
	<script>
	var camera, scene, renderer,
	bulbLight, bulbMat, hemiLight,
	object, loader, stats, light, sun, sun1;
	var winMat, doorMat, cubeMat, floorMat, horMat, ovMat, finMat;
	var lat=<?php echo $lat;?>;
	var lon=<?php echo $lon;?>;
	</script>
	
		<script src="includes/three.js/build/three.js"></script>
		<script src="includes/three.js/js/libs/stats.min.js"></script>
		<script src="includes/three.js/js/libs/dat.gui.min.js"></script>
		<script src="includes/three.js/js/controls/OrbitControls.js"></script>
		<script src="includes/three.js/js/geometries/ConvexGeometry.js"></script>
		<script src="includes/three.js/js/Detector.js"></script>
		<script src="includes/three.js/ThreeCSG1.js"></script>
		<script src="includes/three.js/SolarSystem.js"></script>
		<script src="includes/three.js/sunCalc.js"></script>
		<!--fonts και text-->
		<script src="includes/three.js/THREE.TextTexture.js"></script>
		<script src="includes/three.js/THREE.TextSprite.js"></script>

		<script>
		
		
		
function savecanvas() {
	render();
	window.open( renderer.domElement.toDataURL('image/png'), 'mywindow' );
	return false;
}

			if ( ! Detector.webgl ) Detector.addGetWebGLMessage();

			var animation_id;
			// ref for lumens: http://www.power-sure.com/lumens.htm
			var bulbLuminousPowers = {
				"110000 lm (1000W)": 110000,
				"3500 lm (300W)": 3500,
				"1700 lm (100W)": 1700,
				"800 lm (60W)": 800,
				"400 lm (40W)": 400,
				"180 lm (25W)": 180,
				"20 lm (4W)": 20,
				"Off": 0
			};

			// ref for solar irradiances: https://en.wikipedia.org/wiki/Lux
			var hemiLuminousIrradiances = {
				"0.0001 lx (Moonless Night)": 0.0001,
				"0.002 lx (Night Airglow)": 0.002,
				"0.5 lx (Full Moon)": 0.5,
				"3.4 lx (City Twilight)": 3.4,
				"50 lx (Living Room)": 50,
				"100 lx (Very Overcast)": 100,
				"350 lx (Office Room)": 350,
				"400 lx (Sunrise/Sunset)": 400,
				"1000 lx (Overcast)": 1000,
				"18000 lx (Daylight)": 18000,
				"50000 lx (Direct Sun)": 50000
			};

			var params = {
				shadows: true,
				exposure: 0.68,
				bulbPower: Object.keys( bulbLuminousPowers )[ 7 ],
				hemiIrradiance: Object.keys( hemiLuminousIrradiances )[3],
				toggle_Fhor: true,
				toggle_Fov: true,
				toggle_sun: true,
				toggle_Ffinl: true,
				toggle_Ffinr: true,
				toggle_triangle: true
			};
			
			var group_walls = new THREE.Group();
			var group_wins = new THREE.Group();
			var group_hors = new THREE.Group();
			var group_ovs = new THREE.Group();
			var group_triangles = new THREE.Group();

			var clock = new THREE.Clock();

			init();
			animate();

			function init() {

				var container = document.getElementById( '3dCanvas' );

				stats = new Stats();
				stats.domElement.id = "statsgui";
				container.appendChild( stats.dom );


				camera = new THREE.PerspectiveCamera( 50, window.innerWidth / window.innerHeight, 0.1, 1000 );
				camera.position.x = 75;
				camera.position.z = 0;
				camera.position.y = 35;
				//camera.rotation.y = -Math.PI / 2.0

				scene = new THREE.Scene();
				scene.background = new THREE.Color().setHSL( 0.6, 0, 1 );
				scene.fog = new THREE.Fog( scene.background, 1, 5000 );

				var bulbGeometry = new THREE.SphereGeometry( 0.02, 16, 8 );
				bulbLight = new THREE.PointLight( 0xffee88, 1, 100, 2 );

				bulbMat = new THREE.MeshStandardMaterial( {
					emissive: 0xffffee,
					emissiveIntensity: 1,
					color: 0x000000
				});
				bulbLight.add( new THREE.Mesh( bulbGeometry, bulbMat ) );
				bulbLight.position.set( 0, 2, 0 );
				bulbLight.castShadow = true;
				scene.add( bulbLight );

				//Φως ημισφαίριο
				hemiLight = new THREE.HemisphereLight( 0xddeeff, 0x0f0e0d, 0.02 );
				scene.add( hemiLight );

				//Υλικό δαπέδου
				floorMat = new THREE.MeshStandardMaterial( {
					roughness: 0.8,
					color: 0xF3F8F2,
					metalness: 0.2,
					bumpScale: 0.0005
				});
				var textureLoader = new THREE.TextureLoader();
				
				//ΥΛΙΚΟ ΤΟΙΧΟΠΟΙΙΑΣ
				cubeMat = new THREE.MeshStandardMaterial( {
					roughness: 0.7,
					color: 0xEBE1DB,
					bumpScale: 0.002,
					metalness: 0.2
				});
				
				var wall_ap = [
					"0xffffff",
					"0xF1F2F1",
					"0xC0C1C0",
					"0x4A4A49",
					"0xA52A2A",
					"0xE4BFBF",
					"0xFDB1D5",
					"0xFEF7FA",
					"0x00FF00"
				];
				
				textureLoader.load( "includes/three.js/textures/brick_diffuse.jpg", function( map ) {
					map.wrapS = THREE.RepeatWrapping;
					map.wrapT = THREE.RepeatWrapping;
					map.anisotropy = 4;
					map.repeat.set( 1, 1 );
					cubeMat.map = map;
					cubeMat.needsUpdate = true;
				} );
				/*
				textureLoader.load( "includes/three.js/textures/brick_bump.jpg", function( map ) {
					map.wrapS = THREE.RepeatWrapping;
					map.wrapT = THREE.RepeatWrapping;
					map.anisotropy = 4;
					map.repeat.set( 1, 1 );
					cubeMat.bumpMap = map;
					cubeMat.needsUpdate = true;
				} );
				*/
				//ΥΛΙΚΟ ΤΟΙΧΟΠΟΙΙΑΣ
				
				//ΥΛΙΚΟ ΕΜΠΟΔΙΩΝ ΟΡΙΖΟΝΤΑ
				horMat = new THREE.MeshStandardMaterial( {
					roughness: 0.7,
					color: 0xffffff,
					bumpScale: 0.002,
					metalness: 0.2,
					opacity: 0.5,
					transparent: true,
					alphaTest: 0.5
				});
				textureLoader.load( "includes/three.js/textures/concrete.jpg", function( map ) {
					map.wrapS = THREE.RepeatWrapping;
					map.wrapT = THREE.RepeatWrapping;
					map.anisotropy = 4;
					map.repeat.set( 1, 1 );
					horMat.map = map;
					horMat.needsUpdate = true;
				} );
				textureLoader.load( "includes/three.js/textures/concrete.jpg", function( map ) {
					map.wrapS = THREE.RepeatWrapping;
					map.wrapT = THREE.RepeatWrapping;
					map.anisotropy = 4;
					map.repeat.set( 1, 1 );
					horMat.bumpMap = map;
					horMat.needsUpdate = true;
				} );
				//ΥΛΙΚΟ ΕΜΠΟΔΙΩΝ ΟΡΙΖΟΝΤΑ
				
				//ΥΛΙΚΟ ΑΝΟΙΓΜΑΤΩΝ
				winMat = new THREE.MeshStandardMaterial( {
					color: 0x00ffff,
					roughness: 0.5,
					metalness: 1.0,
					opacity: 0.5,
					transparent: true,
					alphaTest: 0.5
				});
				textureLoader.load( "includes/three.js/textures/glass.png", function( map ) {
					map.anisotropy = 4;
					winMat.map = map;
					winMat.needsUpdate = true;
				} );
				textureLoader.load( "includes/three.js/textures/glass.png", function( map ) {
					map.anisotropy = 4;
					winMat.metalnessMap = map;
					winMat.needsUpdate = true;
				} );
				//ΥΛΙΚΟ ΑΝΟΙΓΜΑΤΩΝ
				
				//ΥΛΙΚΟ ΠΟΡΤΑΣ
				//var texture = new THREE.TextureLoader().load( 'textures/land_ocean_ice_cloud_2048.jpg' );
				//var material = new THREE.MeshBasicMaterial( { map: texture } );
				doorMat = new THREE.MeshStandardMaterial( {
					roughness: 0.5,
					bumpScale: 0.1,
					metalness: 0.1,
					transparent: false
				});
				textureLoader.load( "includes/three.js/textures/hardwood2_diffuse.jpg", function( map ) {
					map.wrapS = THREE.RepeatWrapping;
					map.wrapT = THREE.RepeatWrapping;
					map.anisotropy = 4;
					map.repeat.set( 1, 2 );
					doorMat.map = map;
					doorMat.needsUpdate = true;
				} );
				//ΥΛΙΚΟ ΠΟΡΤΑΣ
				
				//Άξονες
				var grid = new THREE.GridHelper( 100, 100, 0xffffff, 0x555555 );
				var gridAxis = new THREE.AxisHelper(2);
				grid.add(gridAxis);
				scene.add( grid );
				
				//Δάπεδο
				var floorGeometry = new THREE.PlaneBufferGeometry( 100, 100 );
				var floorMesh = new THREE.Mesh( floorGeometry, floorMat );
				floorMesh.receiveShadow = true;
				floorMesh.rotation.x = -Math.PI / 2.0;
				scene.add( floorMesh );
				
//ΣΧΕΔΙΑΣΗ ΤΟΙΧΟΠΟΙΙΑΣ
//draw_wall(x1, y1, x2, y2, h, d, material);
//draw_window(x1, y1, x2, y2, h, p, d, material);
	
	(function() {
		var start_time = (new Date()).getTime();
		
		var wallMesh,windowMesh, hor_mesh, ov_mesh, wall_bsp, hor_bsp, ov_bsp, window_bsp, subtract_bsp, result, result1, result_hor, result_ov;
		
<?php
		
	$current_x =0;
	$current_y =0;
	
	foreach ($data_wall as $wall){
		$wall_l=$wall["l"];
		$h=$wall["h"];
		$d=$wall["d"];
		$wall_dy=$wall["dy"];
		$wall_dx=$wall["dx"];
		
		$fhor=explode("|",$wall["fhor"]);
		$fov=$wall["fov"];
		$ffin_l=explode("|",$wall["ffin_l"]);
		$ffin_r=explode("|",$wall["ffin_r"]);
		
		if($wall["g_type"]==0){
				$wall_g = $wall["g"];
			}else{
				if($wall["g_type"]==1){
				$wall_g = $building_g;
				}
				if($wall["g_type"]==2){
				$wall_g = $building_g+90;
				}
				if($wall["g_type"]==3){
				$wall_g = $building_g+180;
				}
				if($wall["g_type"]==4){
				$wall_g = $building_g+270;
				}
			}
			if($wall_g>=360){
				$wall_g=$wall_g-360;
			}
			
			$wall_b = deg2rad(90-$wall["b"]);
			
			$wall_ap = $wall["ap"];
			
			$x1=$current_x;
			$y1=$current_y;
			$x2=$current_x+$wall_l* cos(deg2rad($wall_g));
			$y2=$current_y-$wall_l* sin(deg2rad($wall_g));
			$tri_x2=$x2-$wall_dx* cos(deg2rad($wall_g));
			$tri_y2=$y2+$wall_dx* sin(deg2rad($wall_g));
			
			if($fhor[0]!=0){
				$x1_hor=$x1 + $fhor[0] * cos(deg2rad( (90-$wall_g) ) );
				$y1_hor=$y1 + $fhor[0] * sin(deg2rad( (90-$wall_g) ) );
				$x2_hor=$x2 + $fhor[0] * cos(deg2rad( (90-$wall_g) ) );
				$y2_hor=$y2 + $fhor[0] * sin(deg2rad( (90-$wall_g) ) );
				$fhor_h=$fhor[1];
			}
			if($fov!=0){
				$x1_ov=$x1 - $fov * cos(deg2rad( ($wall_g)-270 ) );
				$y1_ov=$y1 + $fov * sin(deg2rad( ($wall_g)-270 ) );
				$x2_ov=$x2 - $fov * cos(deg2rad( ($wall_g)-270 ) );
				$y2_ov=$y2 + $fov * sin(deg2rad( ($wall_g)-270 ) );
			}
?>
			
			var x1=<?php echo $x1;?>;
			var y1=<?php echo $y1;?>;
			var x2=<?php echo $x2;?>;
			var y2=<?php echo $y2;?>;
			var h=<?php echo $h;?>;
			var d=<?php echo $d;?>;
			var tri_h=<?php echo $wall_dy;?>;
			var tri_x2=<?php echo $tri_x2;?>;
			var tri_y2=<?php echo $tri_y2;?>;
			var b=<?php echo $wall_b;?>;
			
			/*
			//Γραμμή τριγώνου
			if(tri_y2!==0){
				var material = new THREE.LineBasicMaterial({
					color: 0x0000ff
				});
				var geometry = new THREE.Geometry();
				geometry.vertices.push(
					new THREE.Vector3( y2, h, x2 ),
					new THREE.Vector3( tri_y2, h+tri_h, tri_x2 ),
					new THREE.Vector3( y1, h, x1 )
				);
				var line = new THREE.Line( geometry, material );
				group_triangles.add( line );
			}
			*/
			
			
			//Γεωμετρία τοίχου - παραθύρων - μετατροπή σε BSP
			wallMesh = draw_wall(x1, y1, x2, y2, h, d, tri_h, tri_x2, tri_y2, b, cubeMat);//το υλικό είναι πλεονασμός. Δεν παίζει ρόλο
			wall_bsp = new ThreeBSP( wallMesh );

<?php
if($fhor[0]!=0){//Ορίζοντας
?>
			
			var x1_hor=<?php echo $x1_hor;?>;
			var y1_hor=<?php echo $y1_hor;?>;
			var x2_hor=<?php echo $x2_hor;?>;
			var y2_hor=<?php echo $y2_hor;?>;
			var fhor_h=<?php echo $fhor_h;?>;
			
			horMesh = draw_wall(x1_hor, y1_hor, x2_hor, y2_hor, fhor_h, d,0,0,0, 0, cubeMat);//το υλικό είναι πλεονασμός. Δεν παίζει ρόλο
			hor_bsp = new ThreeBSP( horMesh );
			
<?php
}//Ορίζοντας
?>

<?php
if($fov!=0){//Πρόβολος
?>
			
			var x1_ov=<?php echo $x1_ov;?>;
			var y1_ov=<?php echo $y1_ov;?>;
			var x2_ov=<?php echo $x2_ov;?>;
			var y2_ov=<?php echo $y2_ov;?>;
			
			ovMesh = draw_ov(x1, y1, x1_ov, y1_ov, x2_ov, y2_ov, h, d, cubeMat);//το υλικό είναι πλεονασμός. Δεν παίζει ρόλο
			ov_bsp = new ThreeBSP( ovMesh );

<?php
}//Πρόβολος
			$current_x = $x2;
			$current_y = $y2;
			
			//ΑΝΟΙΓΜΑΤΑ ΤΟΙΧΟΥ
			$where_win=array(
			"AND"=>array(
				"user_id"=>$_SESSION['user_id'],
				"meleti_id"=>$_SESSION['meleti_id'],
				"wall_id"=>$wall["id"]
				)
			);
			$data_win = $database->select($table_win,$columns,$where_win);
			$count_win = $database->count($table_win,$where_win);
			$i=1;
			foreach($data_win as $window){
				$leftside_x=$x2;
				$leftside_y=$y2;

				$win_name=$window["name"];
				$win_l=$window["w"];
				$win_h=$window["h"];
				$win_p=$window["p"];
				$win_apoar=$window["apoar"];
				
				$win_type=$window["type"];
				$win_gw=$window["g_w"];
				
				$win_x1=$leftside_x+$win_apoar* cos(deg2rad($wall_g-180));
				$win_y1=$leftside_y-$win_apoar* sin(deg2rad($wall_g-180));
				$win_x2=$win_x1+$win_l* cos(deg2rad($wall_g-180));
				$win_y2=$win_y1-$win_l* sin(deg2rad($wall_g-180));
				
?>
				windowMesh = draw_window(<?php echo $win_x1;?>, <?php echo $win_y1;?>, <?php echo $win_x2;?>, <?php echo $win_y2;?>, <?php echo $win_h;?>, <?php echo $win_p;?>, <?php echo $d;?>, b, doorMat);//το υλικό είναι πλεονασμός. Δεν παίζει ρόλο
				window_bsp = new ThreeBSP( windowMesh );
				
				//αξονας z
				var axis_z = new THREE.Vector3( 0, 0, 1 ).normalize();
				
<?php 
if($i==1){//Την 1η φορά αφαιρεί από τον τοίχο
?>
				subtract_bsp = wall_bsp.subtract( window_bsp );
<?php 
}else{//Από το 2ο παράθυρο και μετά αφαιρεί από το αποτέλεσμα του προηγούμενου
?>
				subtract_bsp = subtract_bsp.subtract( window_bsp );
<?php 
}//τέλος if
 
	if($win_type==0){//αδιαφανής πόρτα
?>
			//σχεδίαση πόρτας
			result1 = window_bsp.toMesh( doorMat );//Εδώ το υλικό παίζει ρόλο. Πόρτα

<?php
	}else{//παράθυρο
?>
			//σχεδίαση παραθύρου
			winMat.opacity = <?php echo $win_gw;?>;
			result1 = window_bsp.toMesh( winMat );//Εδώ το υλικό παίζει ρόλο. Παράθυρο
<?php 
}//τέλος if
?>
			
			//κλιση παραθύρου ως προς κατακόρυφο
			if(b!=0){
				result1.geometry.translate( 1, 0, 0 );
				result1.rotateOnAxis( axis_z, -b );
			}
			
			result1.castShadow = true;
			result1.receiveShadow = true;
			result1.geometry.computeVertexNormals();
			scene.add( result1 );
				
<?php		
			$i++;
			}//για κάθε άνοιγμα
if($count_win!=0){//εάν υπάρχουν παράθυρα (με τις αφαιρέσεις) - σχεδίαση
?>
			//cubeMat.color = wall_ap[<?php echo $wall_ap-1;?>];
			result = subtract_bsp.toMesh( cubeMat );//Εδώ το υλικό παίζει ρόλο. Τοίχος
<?php 
}else{//δεν υπάρχουν παράθυρα (χωρίς τις αφαιρέσεις) - σχεδίαση
?>		
			result = wall_bsp.toMesh( cubeMat );//Εδώ το υλικό παίζει ρόλο. Τοίχος
<?php 
}//τέλος if (εάν μετρώνται ανοίγματα) - σχεδίαση
?>

			//κλιση τοίχου ως προς κατακόρυφο
			if(b!=0){
				result.geometry.translate( -1, 0, 0 );
				result.rotateOnAxis( axis_z, b );
			}
			
			result.castShadow = true;
			result.receiveShadow = true;
			result.geometry.computeVertexNormals();
			scene.add( result );

<?php 
if($fhor[0]!=0){//υπάρχει ορίζοντας - σχεδίαση
?>			
			result_hor = hor_bsp.toMesh( horMat );//Εδώ το υλικό παίζει ρόλο. Εμπόδιο ορίζοντα
			result_hor.castShadow = true;
			result_hor.receiveShadow = true;
			result_hor.geometry.computeVertexNormals();
			//scene.add( result_hor );
			group_hors.add( result_hor );
<?php
}//εαν υπαρχει οριζοντας - σχεδίαση	
?>

<?php 
if($fov!=0){//υπάρχει πρόβολος - σχεδίαση
?>			
			result_ov = ov_bsp.toMesh( horMat );//Εδώ το υλικό παίζει ρόλο. Εμπόδιο ορίζοντα
			result_ov.castShadow = true;
			result_ov.receiveShadow = true;
			result_ov.geometry.computeVertexNormals();
			//scene.add( result_ov );
			group_ovs.add( result_ov );
<?php
}//εαν υπαρχει πρόβολος - σχεδίαση	
?>

	var textsprite = new THREE.TextSprite({
	  textSize: 0.3,
	  redrawInterval: 250,
	  texture: {
		text: '<?php echo $wall["name"];?>',
		fontFamily: 'Arial, Helvetica, sans-serif',
		autoRedraw: 1
	  },
	  material: {
		color: 0x669933,
		fog: true,
	  },
	});
	var wall_pos=wall_txtposition(<?php echo $x1;?>, <?php echo $y1;?>, <?php echo $x2;?>, <?php echo $y2;?>, <?php echo $h+$wall_dy;?>, <?php echo $d;?>);
	textsprite.position.set(wall_pos[0], wall_pos[1], wall_pos[2]);
	scene.add(textsprite);

<?php	
}//για κάθε τοίχο
?>
		
		/*
		ΠΡΩΤΟΤΥΠΟ
		//Γεωμετρία τοίχου - παραθύρων - μετατροπή σε BSP
		wallMesh = draw_wall(1, 1, 5, 5, 3, 0.2, cubeMat);//το υλικό είναι πλεονασμός. Δεν παίζει ρόλο
		windowMesh = draw_window(2, 2, 4, 4, 1, 1.5, 0.2, winMat);//το υλικό είναι πλεονασμός. Δεν παίζει ρόλο
		wall_bsp = new ThreeBSP( wallMesh );
		window_bsp = new ThreeBSP( windowMesh );
		
		//Τοίχος χωρίς παράθυρα
		subtract_bsp = wall_bsp.subtract( window_bsp );
		result = subtract_bsp.toMesh( cubeMat );//Εδώ το υλικό παίζει ρόλο. Τοίχος
		result.castShadow = true;
		result.geometry.computeVertexNormals();
		scene.add( result );
		
		//Άνοιγμα
		result1 = window_bsp.toMesh( winMat );//Εδώ το υλικό παίζει ρόλο. Παράθυρο
		result1.castShadow = true;
		result1.geometry.computeVertexNormals();
		scene.add( result1 );
		*/
		
		console.log( 'Example 1: ' + ((new Date()).getTime() - start_time) + 'ms' );
	})();

/*
//GRID - GEOMETRY - EXPERIMENTAL	
	//γραμμες
	var wall=new THREE.Geometry();
	wall.vertices.push(
		new THREE.Vector3(0,0,1),//(y, z, x) = (y προς το βάθος, z προς τα πάνω, x προς τα δεξιά)
		new THREE.Vector3(0,0,5),
		new THREE.Vector3(0,3,5),
		new THREE.Vector3(0,3,1),
		new THREE.Vector3(0,0,1)
	);
	

	var line_mat = new THREE.LineBasicMaterial( { color:0x660033 } );
	var wallmesh = new THREE.Line(wall, line_mat );
	//mesh.position.z = 0;
	scene.add( wallmesh );
	
	//points test
	var point_mat = new THREE.PointsMaterial( { size:.1 } );
	var points3d = new THREE.Points(wall, point_mat);
	scene.add(points3d);
	//wallMesh.castShadow = true;
	//scene.add( wallMesh );
*/	

//ΣΧΕΔΙΑΣΗ ΤΟΙΧΟΠΟΙΙΑΣ

//Εισαγωγή εμποδίων μαζικά στη σκηνή
scene.add( group_hors );
scene.add( group_ovs );
scene.add( group_triangles );

// Ηλιακό φως
light = new THREE.SpotLight( 0xffffff, 15 );
light.position.set(10, 10, 10);
light.shadowDarkness = 0.5;
light.castShadow = true;
light.shadow.mapSize.width = 2048;
light.shadow.mapSize.height = 2048;
scene.add(light);
//var spotLightHelper = new THREE.SpotLightHelper( light );
//scene.add( spotLightHelper );


// Σφαίρα ήλιου
var sphere = new THREE.SphereGeometry(1);
sun1 = new THREE.Mesh(sphere, new THREE.MeshBasicMaterial({
	color : 0xFFFF22
}));
sun1.position.set(10, 10, 10);
scene.add(sun1);


//ΗΛΙΑΚΗ ΤΡΟΧΙΑ
getLatLong(lat,lon);


//Κείμενο La-kenak
/*
var textsprite = new THREE.TextSprite({
  textSize: 10,
  redrawInterval: 1,
  texture: {
    text: 'La-kenak v.5.0',
    fontFamily: 'Arial, Helvetica, sans-serif',
	autoRedraw: 1
  },
  material: {
    color: 0xffbbff,
    fog: true,
  },
});
textsprite.position.set(-50, 50, 2);
scene.add(textsprite);
*/

				//Μέγεθος καμβά (3dCanvad DIV)
				var canvasWidth = window.innerWidth*0.75;
				var canvasHeight = window.innerHeight*0.75;
				
				renderer = new THREE.WebGLRenderer();
				renderer.physicallyCorrectLights = true;
				renderer.gammaInput = true;
				renderer.gammaOutput = true;
				renderer.shadowMap.enabled = true;
				renderer.toneMapping = THREE.ReinhardToneMapping;
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );
				container.appendChild( renderer.domElement );
				renderer.setSize( canvasWidth, canvasHeight );


				var controls = new THREE.OrbitControls( camera, renderer.domElement );

				window.addEventListener( 'resize', onWindowResize, false );


				var gui = new dat.GUI();
				gui.domElement.id = "datgui";
				
				gui.add( params, 'hemiIrradiance', Object.keys( hemiLuminousIrradiances ) );
				gui.add( params, 'bulbPower', Object.keys( bulbLuminousPowers ) );
				gui.add( params, 'exposure', 0, 1 );
				gui.add( params, 'shadows' );
				gui.add( params, 'toggle_Fhor' );
				gui.add( params, 'toggle_Fov' );
				gui.add( params, 'toggle_Ffinl' );
				gui.add( params, 'toggle_Ffinr' );
				gui.add( params, 'toggle_sun' );
				gui.add( params, 'toggle_triangle' );
				gui.close();
			}

			function onWindowResize() {

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

			}

			function animate() {
				/*
				var speedInUnitsPerSecond=5000;
				var time = Date.now()*speedInUnitsPerSecond;
				var date = new Date(time);
				var month = date.getMonth();
				var day = date.getDate();
				var hour = date.getHours();
				var second = date.getSeconds();
				
				var delta = clock.getDelta();
				//document.getElementById("month").value=month+1;
				document.getElementById("day").value=day;
				document.getElementById('day_txt').innerHTML=day;
				document.getElementById("hour").value=hour;
				document.getElementById('hour_txt').innerHTML=hour;
				//document.getElementById("sec").value=second;
				//document.getElementById('sec_txt').innerHTML=second;
				//document.getElementById("seconds").value=second;
				
				getData(1);
				*/
				animation_id=requestAnimationFrame( animate );
				render();
			}
			
			function stop_animate() {
				/*
				clock.stop();
				cancelAnimationFrame( animation_id );	
				*/
			}
			function start_animate() {
				/*
				animate();
				*/
			}

			var previousShadowMap = false;

			function render() {

				renderer.toneMappingExposure = Math.pow( params.exposure, 5.0 ); // to allow for very bright scenes.
				renderer.shadowMap.enabled = params.shadows;
				bulbLight.castShadow = params.shadows;
				if( params.shadows !== previousShadowMap ) {
					winMat.needsUpdate = true;
					cubeMat.needsUpdate = true;
					floorMat.needsUpdate = true;
					previousShadowMap = params.shadows;
				}
				
				if( params.toggle_sun == true ) {
					sun1.visible = true;
				}else{
					sun1.visible = false;
				}
				
				if( params.toggle_Fhor == true ) {
					group_hors.visible = true;
				}else{
					group_hors.visible = false;
				}
				
				if( params.toggle_Fov == true ) {
					group_ovs.visible = true;
				}else{
					group_ovs.visible = false;
				}
				
				if( params.toggle_triangle == true ) {
					group_triangles.visible = true;
				}else{
					group_triangles.visible = false;
				}
				
				bulbLight.power = bulbLuminousPowers[ params.bulbPower ];
				bulbMat.emissiveIntensity = bulbLight.intensity / Math.pow( 0.02, 2.0 ); // convert from intensity to irradiance at bulb surface

				hemiLight.intensity = hemiLuminousIrradiances[ params.hemiIrradiance ];
				//var time = Date.now() * 0.0005;
				//var month = time.getMonth();
				//var month = time.getMonth();
				//var delta = clock.getDelta();

				//bulbLight.position.z = Math.cos( time ) * 10 + 1.25;
				//bulbLight.position.y = 3;

				renderer.render( scene, camera );

				stats.update();

			}
			
			var rotWorldMatrix;
			
			function draw_wall(x1, y1, x2, y2, h, d, tri_h, tri_x2, tri_y2, b, mat){
				var dx=x2-x1;
				var dy=y2-y1;
				var l=Math.sqrt(Math.pow(dy,2)+Math.pow(dx,2));
				var radians = Math.atan2(y2 - y1, x2 - x1);
				
				var wallGeometry = new THREE.BoxGeometry( d, h, l );
				var wallMesh = new THREE.Mesh( wallGeometry, mat );
				wallMesh.rotation.y = radians ;
				wallMesh.position.set( y1+dy/2, h/2, x1+dx/2 );//(y, z, x) = (y προς το βάθος, z προς τα πάνω, x προς τα δεξιά)
				//wallMesh.rotation.z=THREE.Math.degToRad( 30 );κλίση προς την κατακόρυφο - Θέλει διόρθωση η θέση
				
				wallMesh.castShadow = true;
				wallMesh.receiveShadow = true;
				
					//Άξονας περιστροφής (όπως έχει στηθεί ο τοίχος κατά x)
					var axis_x = new THREE.Vector3( 1, 0, 0 ).normalize();
					var axis_z = new THREE.Vector3( 0, 0, 1 ).normalize();
					
				if(tri_h!==0){
					//Ο τοίχος σε γεωμετρία BSP για join-substract
					wall_bsp = new ThreeBSP( wallMesh );
					
					
					//Αφαιρέσεις
					//ορθογώνιο πάνω από τοίχο
					var topGeometry = new THREE.BoxGeometry( d, tri_h, l );
					var topMesh = new THREE.Mesh( topGeometry, mat );
					topMesh.rotation.y = radians ;
					topMesh.position.set( y1+dy/2, h+tri_h/2, x1+dx/2 );
					var top_bsp = new ThreeBSP( topMesh );
					var wallwithtop = wall_bsp.union( top_bsp );
					
					//Αριστερά
					var left_dx = x2-tri_x2;
					var left_dy = y2-tri_y2;
					var left_l = dist(x2,y2,h,tri_x2,tri_y2,h+tri_h);
					var left_lx = dist(x2,y2,h,tri_x2,tri_y2,h);
					var radians_left = Math.atan2(tri_h , left_lx );
					
					var leftGeometry = new THREE.BoxGeometry( d, tri_h, left_l*2 );
					var leftMesh = new THREE.Mesh( leftGeometry, mat );
					//Ίδιο με προσανατολισμό τοίχου
					leftMesh.rotation.y = radians ;
					
					//Το μετακινώ από την αριστερή άκρη και όχι από το κέντρο του (με βάση διαστάσεις)
					leftMesh.geometry.translate( 0, tri_h/2, -left_l );
					//Το βάζω στη γωνία με βάση την αριστερή του γωνία
					leftMesh.position.set( y2, h, x2 );
					
					//Μετά την τοποθέτηση και τον προσανατολισμό (rotate.y) - Περιστροφή στον x άξονα
					leftMesh.rotateOnAxis( axis_x, radians_left );
					
					var left_bsp = new ThreeBSP( leftMesh );
					var wallwithtop1 = wallwithtop.subtract( left_bsp );
					
					
					//Δεξιά
					var right_dx = tri_x2-x1;
					var right_dy = tri_y2-y1;
					var right_l = dist(x1,y1,h,tri_x2,tri_y2,h+tri_h);
					var right_lx = dist(x1,y1,h,tri_x2,tri_y2,h);
					var radians_right = -Math.atan2( tri_h , right_lx );
					
					var rightGeometry = new THREE.BoxGeometry( d, tri_h, right_l*2 );
					var rightMesh = new THREE.Mesh( rightGeometry, mat );
					rightMesh.rotation.y = radians ;
					
					//Το μετακινώ από την δεξιά άκρη και όχι από το κέντρο του (με βάση διαστάσεις)
					rightMesh.geometry.translate( 0, tri_h/2, right_l );
					//Το βάζω στη γωνία με βάση την δεξιά του γωνία
					rightMesh.position.set( y1, h, x1 );
					
					//Μετά την τοποθέτηση και τον προσανατολισμό (rotate.y) - Περιστροφή στον x άξονα
					rightMesh.rotateOnAxis( axis_x, radians_right );
					
					var right_bsp = new ThreeBSP( rightMesh );
					var wallwithtop2 = wallwithtop1.subtract( right_bsp );
					
					result = wallwithtop2.toMesh( mat );
					if(b!=0){
						//result.geometry.translate( -1, 0, 0 );
						//result.rotateOnAxis( axis_z, b );
					}
					return result;
					
					
					//return wallMesh;
				}else{
					//result = wallMesh.toMesh( mat );
					if(b!=0){
						//wallMesh.geometry.translate( -1, 0, 0 );
						//wallMesh.rotateOnAxis( axis_z, b );
					}
					return wallMesh;
				}
			}
			
			function draw_window(x1, y1, x2, y2, h, p, d, b, mat){
					//Άξονας περιστροφής (όπως έχει στηθεί ο τοίχος κατά x)
					var axis_x = new THREE.Vector3( 1, 0, 0 ).normalize();
					var axis_z = new THREE.Vector3( 0, 0, 1 ).normalize();
					
				var dx=x2-x1;
				var dy=y2-y1;
				var l=Math.sqrt(Math.pow(dy,2)+Math.pow(dx,2));
				var radians = Math.atan2(y2 - y1, x2 - x1);
				
				var windowGeometry = new THREE.BoxGeometry( d, h, l );
				var windowMesh = new THREE.Mesh( windowGeometry, mat );
				windowMesh.rotation.y = radians ;
				windowMesh.position.set( y1+dy/2, p+h/2, x1+dx/2 );//(y, z, x) = (y προς το βάθος, z προς τα πάνω, x προς τα δεξιά)
				
				windowMesh.castShadow = true;
				windowMesh.receiveShadow = true;
				//scene.add( windowMesh );
					if(b!=0){
						//windowMesh.geometry.translate( 1, 0, 0 );
						//windowMesh.rotateOnAxis( axis_z, -b );
					}
				return windowMesh;
			}
			
			function draw_ov(x1, y1, x1_ov, y1_ov, x2_ov, y2_ov, h, d, mat){
				var dx=x2_ov-x1_ov;
				var dy=y2_ov-y1_ov;
				var dx_offset=x1_ov-x1;
				var dy_offset=y1_ov-y1;
				var offset=Math.sqrt(Math.pow(dy_offset,2)+Math.pow(dx_offset,2));
				var l=Math.sqrt(Math.pow(dy,2)+Math.pow(dx,2));
				var radians = Math.atan2(dy, dx);
				
				var ovGeometry = new THREE.BoxGeometry( offset, d, l );
				var ovMesh = new THREE.Mesh( ovGeometry, mat );
				ovMesh.rotation.y = radians ;
				ovMesh.position.set( y1+dy_offset/2+dy/2, h+d/2, x1+dx_offset/2+dx/2 );//(y, z, x) = (y προς το βάθος, z προς τα πάνω, x προς τα δεξιά)
				
				ovMesh.castShadow = true;
				ovMesh.receiveShadow = true;
				return ovMesh;
			}
			
			function wall_txtposition(x1, y1, x2, y2, h, d){
				var dx=x2-x1;
				var dy=y2-y1;
				var l=Math.sqrt(Math.pow(dy,2)+Math.pow(dx,2));
				var radians = Math.atan2(y2 - y1, x2 - x1);
				return [y1+dy/2, h+0.4, x1+dx/2];
			}
			
			// Rotate an object around an arbitrary axis in world space       
			function rotateAroundWorldAxis(object, axis, radians) {
				rotWorldMatrix = new THREE.Matrix4();
				rotWorldMatrix.makeRotationAxis(axis.normalize(), radians);
				rotWorldMatrix.multiply(object.matrix);        // pre-multiply
				object.matrix = rotWorldMatrix;
				object.rotation.setFromRotationMatrix(object.matrix);
			}
			
			function dist(x0,y0,z0,x1,y1,z1){
				var deltaX = x1 - x0;
				var deltaY = y1 - y0;
				var deltaZ = z1 - z0;
				var distance = Math.sqrt(deltaX * deltaX + deltaY * deltaY + deltaZ * deltaZ);
				return distance;
			}
			

		</script>
	<br/>
	</div><!--tab2-->
	
	<div class="tab-pane" id="tabs-4">
		<br/>
		<blackquote>
			Υπό κατασκευή:<br/>
			Σχεδιάζονται οι γραμμές των τοίχων, τα ανοίγματα, τα εμπόδια ορίζοντα και τα εμπόδια προβόλου.<br/>
			Προσωρινά τα κείμενα εμφανίζονται χωρίς κωδικοποίηση. 
		</blackquote>
		<br/><br/><br/>
		<button type="submit" class="btn btn-znx" onclick=save_dxf();>
			<i class="fa fa-file-code-o"></i> Παραγωγή dxf (2010)
		</button>
		<br/><br/>
		<div id="txt_dxf"></div>

<script>		
function save_dxf(){

	document.getElementById('wait').style.display="inline";
	var link="includes/functions_dxf.php?save_dxf=1&floor=0";
	//AJAX call
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open('GET', link, true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById('wait').style.display="none";
			document.getElementById('txt_dxf').innerHTML = xmlhttp.responseText;
		}
	}
}
</script>
	</div><!--tab4-->
	
	<div class="tab-pane" id="tabs-5">
		<?php
		//TO ΙΔΙΟ ΚΑΙ ΣΕ FUNCTION_TEYXOS.PHP - > teyxos_imgzone(){}
			$database = new medoo(DB_NAME);
			$tb_meleti = "user_meletes";
			$col = "*";
			$where_meleti=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
			$select_meleti = $database->select($tb_meleti,$col,$where_meleti);
			
			$meleti_zone = $select_meleti[0]["zone"];
			$meleti_climate = $select_meleti[0]["climate"];
			$meleti_address_x = $select_meleti[0]["address_x"];
			$meleti_address_y = $select_meleti[0]["address_y"];
			$meleti_address_z = $select_meleti[0]["address_z"];
			
			
		//Εικόνες κλιματικής ζώνης και τοπογραφικό
		$image_location = 'http://staticmap.openstreetmap.de/staticmap.php?center='.$meleti_address_x.','.$meleti_address_y.'&zoom=14&size=512x512&maptype=mapnik';
		$image_location .= '&markers='.$meleti_address_x.','.$meleti_address_y.',lightblue1';
		$image_dest = 'includes/file_upload/server/php/files/user_'.$_SESSION['user_id'].'/meleti_'.$_SESSION['meleti_id'].'/location_osm.jpg';
		if(file_exists($image_dest)){
			
		}else{
			copy($image_location , $image_dest );
		}
		$imgzone = "Θέση κτιρίου:<br/>";
		$imgzone .= "<img src=\"".APPLICATION_FOLDER.$image_dest."\"><br/><br/>";
		$imgzone .= "(Lat:".$meleti_address_x." ,Lon:".$meleti_address_y.")<br/><br/>";
		echo $imgzone;
		?>
	</div><!--tab5-->
	
	<div class="tab-pane" id="tabs-6">
		<br/><br/>
		Το αρχείο ZIP θα περιλαμβάνει τις κατόψεις, τις όψεις και τη θέση του ακινήτου σε χάρτη. 
		<br/><br/>
		<button type="submit" class="btn btn-znx" onclick=save_ziparchive();>
		<i class="fa fa-file-archive-o"></i> Παραγωγή σκαριφημάτων 
		</button>
		<br/><br/>
		<div id="txt_ziparchive"></div>
		
		<script>				
			
			function save_ziparchive(){

				document.getElementById('wait').style.display="inline";
				var link="includes/functions_xml.php?export_ziparchive=1";
				//AJAX call
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.open('GET', link, true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						document.getElementById('wait').style.display="none";
						document.getElementById('txt_ziparchive').innerHTML = xmlhttp.responseText;
					}
				}
			}
		</script>
	
	</div><!--tab6-->
	
	
	<div class="tab-pane" id="tabs-7">
	
		<br/>
		Στην 1η καρτέλα σχεδιάζεται ο τοίχος με έναν εξειδικευμένο αλγόριθμο ο οποίος με δεδομένα:
		<ul>
			<li>Το μήκος του τοίχου (l)</li>
			<li>Τον προσανατολισμό του (γ)</li>
			<li>Τα ανοίγματα που περιέχει ο τοίχος (το μήκος τους, την απόσταση από το αρ. άκρο του τοίχου)</li>
			<li>Τη σειρά εμφάνισης των τοίχων ανά όροφο</li>
		</ul>
		σχεδιάζει το σκαρίφημα του ορόφου ονοματίζοντας τους τοίχους, εισάγοντας την επαφή τους, το μήκος τους και τον προσανατολισμός τους (χρήση της βιβλιοθήκης GD της php). 
		<br/><br/>
		
		Η βασική γεωμετρία των σχημάτων είναι σχετικά απλή και αφορά: 
		<ul>
			<li>Το μήκος του τοίχου προκύπτει: l=sqrt( (x<sub>2</sub>-x<sub>1</sub>)^2 + (y<sub>2</sub>-y<sub>1</sub>)^2 )</li>
			<li>Το εμβαδόν μεταξύ γνωστών σημείων x,y προκύπτει: E=| ( x<sub>1</sub>*y<sub>2</sub> - y<sub>1</sub>*x<sub>2</sub> + ... + x<sub>ν</sub>*y<sub>1</sub> - y<sub>ν</sub>*x<sub>1</sub>)/2 |</li>
		</ul>
		Ο βασικός περιορισμός της παραπάνω μεθόδου είναι ότι δεν δίνει ακριβείς μετρήσεις εμβαδού στην περίπτωση που κάποια γραμμή τοίχου τέμνει κάποια άλλη. πχ<br/>
		<img src="images/help/polycrossed.gif"></img><br/>
		Αυτό όμως είναι κάτι που δεν μπορεί να συμβεί πραγματικά σε 1 θερμική ζώνη και έτσι για αυτό το λογισμικό ο υπολογισμός λειτουργεί σωστά.
		<br/><br/>
		
		Στη 2<sup>η</sup> καρτέλα σχεδιάζονται τυπικές όψεις των τοίχων. 
		<br/><br/>
		
		Στη 3<sup>η</sup> καρτέλα σχεδιάζεται το κέλυφος σε τρισδιάστατο καμβά δημιουργώντας "τρύπες" στους τοίχους εκεί που βρίσκονται τα διαφανή στοιχεία. Για να γίνει αυτό 
		χρησιμοποιείται ένας εξειδικευμένος αλγόριθμος:
		<ul>
			<li>ένας εξειδικευμένος αλγόριθμος 4 προγραμματιστικών γλωσσών (php, mysql για τα δεδομένα, js και webgl για τη σχεδίαση)</li>
			<li>three.js ως βιβλιοθήκη της WebGL</li>
			<li>dat-gui.js για τον έλεγχο των συνθηκών (πχ φωτισμού, κ.α.)</li>
			<li>csg.js και η σύνδεση με τη three.js για τις τομές τοίχων - παραθύρων</li>
			<li>Προς το παρόν δεν εμφανίζεται ο φέρων οργανισμός, δάπεδα, οροφές καθώς και τα τρίγωνα πάνω από τους τοίχους. Παράγεται δηλαδή μόνο το κυβικό περίγραμμα του κελύφους. </li>
		</ul>
		<br/><br/>
		
		Στη 4<sup>η</sup> καρτέλα παράγεται αρχείο dxf με το σκαρίφημα για περαιτέρω ενέργειες:
		<ul>
			<li>Το λογισμικό γράφει το αρχείο σε μορφή κειμένου χωρίς χρήση βιβλιοθηκών</li>
			<li>Προς το παρόν δεν υποστηρίζονται Ελληνικοί χαρακτήρες στο DXF</li>
		</ul>
		<br/><br/>
		
		Η δημιουργία κατόψεων δεν υποστηρίζει ακόμη τοιχοποιία την οποία έχετε προσθέσει και "κοιτά" προς το εσωτερικό του κτιρίου (πχ φωταγωγός στο κέντρο του κτιρίου με 4 τοίχους να κοιτούν 
		προς τα μέσα. Αυτός είναι ένας περιορισμός μόνο της σχεδίασης. Στο μενού κέλυφος μπορείτε να προσθέσετε κανονικά τέτοιες περιπτώσεις. Ιδιαίτερη προσοχή πρέπει να δίνεται στα σκαριφήματα 
		για ΠΕΑ σε αυτή την περίπτωση καθώς το εμβαδόν στο σκαρίφημα δεν είναι το πραγματικό και πρέπει να αφαιρεθεί το αίθριο ή ο εσωτερικός φωταγωγός. Σε αυτό μπορεί να βοηθήσει το 
		παραγόμενο DXF.
		<br/><br/>
		Η απαίτηση σκαριφημάτων για την έκδοση ΠΕΑ αφορά τυπική κάτοψη με τους προσανατολισμούς των τοίχων, την επαφή τους, τα εμπόδια και την εμβαδομέτρηση και ογκομέτρηση του κάθε 
		ορόφου. Έτσι το La-kenak σας δίνει όλα τα στοιχεία εκτός του υπολογισμού όγκου ορόφου (ο οποίος πρέπει να περιγράφεται κατ' όροφο). Αντίθετα σας δίνει τον υπολογισμό του συνολικού και 
		στην προεπισκόπιση και στο τελικό xml. 
		<br/><br/>
		Σε αυτή τη φάση δεν υποστηρίζονται σε κανένα τμήμα του λογισμικού καμπύλα τμήματα. Σε τέτοιες περιπτώσεις θα πρέπει να προσεγγίσετε το κέλυφος με ευθύγραμμα τμήματα έως ότου αυτό 
		εφαρμοστεί. 
	</div><!--tab4-->

					</div><!--tab content-->
				</div><!--tabs-->
			</div><!--col-md-10-->
		</div>
		 <!-- /.row (main row) -->
	</section> 
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
