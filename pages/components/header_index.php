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
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>La-kenak | v<?php echo APPLICATION_VERSION; ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	   folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="bower_components/morris.js/morris.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
	<!-- iCheck for checkboxes and radio inputs -->
	<!--<link rel="stylesheet" href="plugins/iCheck/all.css"> -->
	<link rel="stylesheet" href="stylesheets/bootstrap-treenav.css">
	
	<!--full calendar-->
	<link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	
	<!--
	<link rel="stylesheet" href="stylesheets/jquery-ui-1.9.2.custom.css" type="text/css" />
	<link rel="stylesheet" href="stylesheets/jtable_grey.css" type="text/css" />
	<link rel="stylesheet" href="stylesheets/calendar.css" type="text/css" />
	<link rel="stylesheet" href="stylesheets/PrintArea.css" type="text/css" />
	-->
	<script type="text/javascript" src="includes/ckeditor/ckeditor.js"></script>
	<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>

<!--Alphanum validator for single inputs-->
<script type="text/javascript" src="javascripts/jquery.alphanum.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
	
<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="stylesheets/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<!-- <link rel="stylesheet" href="includes/file_upload/css/jquery.fileupload.css"> -->
<!-- <link rel="stylesheet" href="includes/file_upload/css/jquery.fileupload-ui.css"> -->
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="css/jquery.fileupload-ui-noscript.css"></noscript>

<script type="text/javascript" src="bower_components/bootstrap/js/transition.js" /></script>
<script type="text/javascript" src="bower_components/bootstrap/js/tooltip.js" /></script>
<script type="text/javascript" src="bower_components/bootstrap/js/collapse.js" /></script>
<script type="text/javascript" src="bower_components/bootstrap/js/popover.js" /></script>
<script type="text/javascript" src="javascripts/validator.js" /></script>
<script type="text/javascript" src="javascripts/datetime.js" /></script>

    <?php
	//Προτιμήσεις λογισμικού
		$database = new medoo(DB_NAME);
		$prefs = $database->select("core_preferences","*",array("id" => "1"));
		$prefs_registration = $prefs[0]["registration"];
		$prefs_offline = $prefs[0]["offline"];
		$prefs_offline_text = $prefs[0]["offline_text"];
		$prefs_googlemaps = $prefs[0]["googlemaps"];
		$prefs_googleapi = $prefs[0]["googleapi"];
		$prefs_osmmail = $prefs[0]["osmmail"];
		$prefs_googleid_on = $prefs[0]["googleid_on"];
		$prefs_Client_ID = $prefs[0]["Client_ID"];
		$prefs_Client_Secret = $prefs[0]["Client_Secret"];
		$prefs_Client_Redirect = $prefs[0]["Client_Redirect"];
		$prefs_meletes_max = $prefs[0]["meletes_max"];
		$prefs_table_nums = $prefs[0]["table_nums"];
		$prefs_menu_xml = $prefs[0]["menu_xml"];
		$prefs_menu_teyxos = $prefs[0]["menu_teyxos"];
		$prefs_teyxos_tcpdf = $prefs[0]["teyxos_tcpdf"];
		
		if($prefs_osmmail != 0 OR $prefs_osmmail != ""){//Έχει οριστεί e-mail
			$prefs_osmmail_query="\"&email=".$prefs_osmmail."\"";
		}else{//Δεν εχει οριστεί e-mail
			$prefs_osmmail_query="";
		}
		
	//Υπάρχει internet - Φόρτωση βιβλιοθηκών μέσω internet (Κυρίως χάρτες)
		if(is_connected()==true){
	?>
		<!--OSM MAPS-->
		<link rel="stylesheet" href="https://openlayers.org/en/v4.6.4/css/ol.css" type="text/css">
		<!-- The line below is only needed for old environments like Internet Explorer and Android 4.x -->
		<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
		<script src="https://openlayers.org/en/v4.6.4/build/ol.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.4.4/proj4.js"></script>
		<!-- OL-ext -->
		<link rel="stylesheet" href="https://cdn.rawgit.com/Viglino/ol-ext/gh-pages/dist/ol-ext.min.css" />
		<script type="text/javascript" src="https://cdn.rawgit.com/Viglino/ol-ext/gh-pages/dist/ol-ext.min.js"></script>
		<!--GOOGLE MAPS-->
		<?php
		if($prefs_googlemaps==1){//Να χρησιμοποιούνται χάρτες google
			if($prefs_googleapi != 0 OR $prefs_googleapi != ""){//Έχει οριστεί Google Api
		?>
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=<?php echo $prefs_googleapi; ?>"></script>
		<?php
			}else{//Δεν έχει οριστεί Google Api
		?>
			<script src="http://maps.google.com/maps/api/js?v=3"></script>
		<?php 
			}//Δεν έχει οριστεί Google api
		?>
	 <?php
			}//Να χρησιμοποιούνται χάρτες google
		}//Υπάρχει internet - Φόρτωση βιβλιοθηκών μέσω internet (Κυρίως χάρτες)
	?>
	<!--Style vertical-->
	<style>
	.ui-tabs-vertical { width: 99%; }
	.ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 20%; }
	.ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
	.ui-tabs-vertical .ui-tabs-nav li a { display:block; }
	.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
	.ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 75%;}
	</style>
</head>