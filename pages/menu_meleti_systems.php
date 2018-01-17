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
	<small>Συστήματα</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-university"></i> Βιβλιοθήκες</a></li>
	<li class="active"> Συστήματα</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
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
		
		<div class="col-md-1">
			       <div class="btn-group">
						<button class="btn btn-solar dropdown-toggle" data-toggle="dropdown"><i class="fa fa-life-ring"></i> Βοήθεια
						<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li>
								<a tabindex="-1" href="#popup_theoretical_insert" onclick=systems_theoretical();>
								<font color=green><i class="fa fa-plus"></i> ΠΕΑ - Προσθήκη θεωρητικών</a></font>
							</li>
							<li>
								<a tabindex="-1" href="#popup_theoretical_insert" onclick=systems_mea();>
								<font color=green><i class="fa fa-plus"></i> ΜΕΑ - Προσθήκη ελάχιστων</a></font>
							</li>
							<li>
								<a tabindex="-1" href="#popup_theoretical_insert" onclick=systems_mea();>
								<font color="#d25577"><i class="fa fa-bath"></i> ΖΝΧ - Προσθήκη τοπικού θερμαντήρα</a></font>
							</li>
							<li>
								<a tabindex="-1" href="#popup_theoretical_insert" onclick=systems_mea();>
								<font color="#d25577"><i class="fa fa-sun-o"></i> Ηλιακός - Προσθήκη 60% κάλυψης</a></font>
							</li>
							<li>
								<a tabindex="-1" href="#popup_theoretical_insert" onclick=systems_mea();>
								<font color="#52bf90"><i class="fa fa-lightbulb-o"></i> Φωτισμός - Θεωρητικό σύστημα</a></font>
							</li>
							<li>
								<a tabindex="-1" href="#popup_theoretical_insert" onclick=systems_mea();>
								<font color="#52bf90"><i class="fa fa-flag"></i> Αερισμός - Θεωρητικό σύστημα</a></font>
							</li>
							<li>
								<a tabindex="-1" href="#popup_theoretical_remove" onclick=systems_remove();>
								<font color=red><i class="fa fa-ban"></i> Συστήματα - Καθαρισμός όλων</a></font>
							</li>
							<li>
								<a tabindex="-1" href="#help_popup" data-toggle="modal">
								<font color=red><i class="fa fa-life-ring"></i> Συστήματα - Βοήθεια</a></font>
							</li>
						</ul>
					</div>
					<br/><br/>
					<div id="systems_info"></div>
			
			<?php
				$bld_info = systems_calc_ea();
				$bld_e=$bld_info[0];
				$bld_a=$bld_info[1];
			?>
			
			<!-- info-box -->
			 <div class="info-box bg-red">
				<a class="tip-top" href="#" title="E:Συνολικό εμβαδόν ζωνών<br/>A:Εμβαδόν παράπλευρης επιφάνειας ζωνών (τοίχοι εκτός μεσοτοιχίας, δάπεδα, οροφές)"><i class="fa fa-cog fa-2x"></i></a>
				<br/><br/>
				Ε: <?php echo round($bld_e,2);?> m<sup>2</sup><br/>
				A: <?php echo round($bld_a,2);?> m<sup>2</sup><br/>
				U<sub>m</sub>:  W/m<sup>2</sup>.K<br/>
				P<sub>gen</sub>:  KW<br/>
				P<sub>n</sub> (ZNX):  KW<br/>
				P<sub>light</sub>:  KW<br/>
          </div>
          <!-- /.info-box -->
		  
		</div>

<!-- ######################### Κρυφή ΒΟΗΘΕΙΑ για εμφάνιση ######################### -->			
<div id="help_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h6 id="myModalLabel">Βοήθεια</h6>
	</div>
	<div class="modal-body">
	<p>
			<div class="tabbable tabs">
				<ul class="nav nav-pills">
				<li class="active"><a href="#tabshelp1" data-toggle="tab"><i class="fa fa-fire"></i> Θέρμανση</a></li>
				<li><a href="#tabshelp2" data-toggle="tab"><i class="fa fa-fire-extinguisher"></i> Ψύξη</a></li>
				<li><a href="#tabshelp3" data-toggle="tab"><i class="fa fa-compass"></i> ZNX</a></li>
				<li><a href="#tabshelp4" data-toggle="tab"><i class="fa fa-sun-o"></i> Ηλιακός</a></li>
				<li><a href="#tabshelp5" data-toggle="tab"><i class="fa fa-lightbulb-o"></i> Φωτισμός</a></li>
				<li><a href="#tabshelp6" data-toggle="tab"><i class="fa fa-flag"></i> Αερισμός</a></li>
				<li><a href="#tabshelp7" data-toggle="tab"><i class="fa fa-tint"></i> Ύγρανση</a></li>
				<li><a href="#tabshelp8" data-toggle="tab"><i class="fa fa-life-ring"></i> Βοήθεια</a></li>
				</ul>
				
				<div class="tab-content">
				<div class="tab-pane active" id="tabshelp1"><!-- Βοήθεια θέρμανση -->
				<?php
				include("accordions_therm.php");
				?>
				</div><!-- Βοήθεια θέρμανση -->
				
				<div class="tab-pane" id="tabshelp2"><!-- Βοήθεια Ψύξη -->
				<?php
				include("accordions_cold.php");
				?>
				</div><!-- Βοήθεια Ψύξη -->
		
				<div class="tab-pane" id="tabshelp3"><!-- Βοήθεια ZNX -->
				<?php
				include("accordions_znx.php");
				?>
				</div><!-- Βοήθεια ZNX -->
				
				<div class="tab-pane" id="tabshelp4"><!-- Βοήθεια Ηλιακός -->
				<?php
				include("accordions_solar.php");
				?>
				</div><!-- Βοήθεια Ηλιακός -->
				
				<div class="tab-pane" id="tabshelp5"><!-- Βοήθεια Φωτισμός -->
				<?php
				include("accordions_light.php");
				?>
				</div><!-- Βοήθεια Φωτισμός -->
				
				<div class="tab-pane" id="tabshelp6"><!-- Βοήθεια Αερισμός -->
					Υπό κατασκευή
				</div><!-- Βοήθεια Αερισμός -->
				
				<div class="tab-pane" id="tabshelp7"><!-- Βοήθεια Ύγρανση -->
					Υπό κατασκευή
				</div><!-- Βοήθεια Ύγρανση -->
				
				<div class="tab-pane" id="tabshelp8"><!-- Βοήθεια Γενικά -->
					<br/>
					<font color="red"><i class="fa fa-life-ring fa-2x"></i></font><br/>
					Προσθέστε μονάδα παραγωγής, δίκτυα διανομής, τερματικές και βοηθητικές μονάδες. <br/>
					Προσοχή: Κάθε ζώνη μπορεί να περιλαμβάνει μόνο 1 δίκτυο διανομής για τα συστήματα θέρμανσης, ψύξης και ζνχ και δεν 
					υποστηρίζεται η προσθήκη δεύτερου ώστε το λογισμικό να κάνει τους υπολογισμούς για εσάς. 
				</div><!-- Βοήθεια Ύγρανση -->
				</div>
			</div>
	</p>
	</div>
	<div class="modal-footer">
	<button class="btn" data-dismiss="modal" aria-hidden="true">OK</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφή ΒΟΗΘΕΙΑ για εμφάνιση ######################### -->		
		
		<div class="col-md-11">
			<div class="nav-tabs-custom">
			<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs-1" data-toggle="tab"><i class="fa fa-fire"></i> Θέρμανση</a></li>
				<li><a href="#tabs-2" data-toggle="tab"><i class="fa fa-snowflake-o"></i> Ψύξη</a></li>
				<li><a href="#tabs-3" data-toggle="tab"><i class="fa fa-bath"></i> ΖΝΧ</a></li>
				<li><a href="#tabs-4" data-toggle="tab"><i class="fa fa-sun-o"></i> Ηλιακός</a></li>
				<li><a href="#tabs-5" data-toggle="tab"><i class="fa fa-lightbulb-o"></i> Φωτισμός</a></li>
				<li><a href="#tabs-6" data-toggle="tab"><i class="fa fa-flag"></i> Αερισμός</a></li>
				<li><a href="#tabs-7" data-toggle="tab"><i class="fa fa-tint"></i> Ύγρανση</a></li>
			</ul>
			
			<script>
			function number_format (number, decimals, dec_point, thousands_sep) {
				number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
				var n = !isFinite(+number) ? 0 : +number,
					prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
					sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
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
			function systems_theoretical(){
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?systems_theoretical=1" ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("systems_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
				reprint_all();
				}}
			}
			function systems_remove(){
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_systems.php?systems_remove=1" ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("systems_info").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
					reprint_all();
				}}
			}
			function reprint_all(){
				var timeout = 500;
				setTimeout(timeout);
				get_thermp();
				setTimeout(timeout);
				get_thermd();
				setTimeout(timeout);
				get_thermt();
				setTimeout(timeout);
				get_thermv();
				setTimeout(timeout);
				get_coldp();
				setTimeout(timeout);
				get_coldd();
				setTimeout(timeout);
				get_coldt();
				setTimeout(timeout);
				get_coldv();
				setTimeout(timeout);
				get_znxp();
				setTimeout(timeout);
				get_znxd();
				setTimeout(timeout);
				get_znxt();
				setTimeout(timeout);
				get_znxv();
				setTimeout(timeout);
				get_solar();
				setTimeout(timeout);
				get_light();
				setTimeout(timeout);
				get_aerp();
				setTimeout(timeout);
				get_ygrp();
				setTimeout(timeout);
				get_ygrd();
				setTimeout(timeout);
				get_ygrt();
				setTimeout(timeout);
			}
			</script>
			<div class="tab-content">
			<div class="tab-pane active" id="tabs-1"><!-- ΘΕΡΜΑΝΣΗ -->
			<?php
				include("menu_meleti_systems_therm.php");
			?>  
			</div><!-- ΘΕΡΜΑΝΣΗ -->
			
			<div class="tab-pane" id="tabs-2"><!-- ΨΥΞΗ -->
			<?php
				include("menu_meleti_systems_cold.php");
			?> 
			</div><!-- ΨΥΞΗ -->
			
			
			<div class="tab-pane" id="tabs-3"><!-- ΖΝΧ -->
			<?php
				include("menu_meleti_systems_znx.php");
			?> 
			</div><!-- ΖΝΧ -->
			
			
			<div class="tab-pane" id="tabs-4"><!-- ΗΛΙΑΚΟΣ -->
			<?php
				include("menu_meleti_systems_solar.php");
			?> 
			</div><!-- ΗΛΙΑΚΟΣ -->
			
			
			<div class="tab-pane" id="tabs-5"><!-- ΦΩΤΙΣΜΟΣ -->
			<?php
				include("menu_meleti_systems_light.php");
			?> 
			</div><!-- ΦΩΤΙΣΜΟΣ -->
			
			<div class="tab-pane" id="tabs-6"><!-- ΜΗΧΑΝΙΚΟΣ ΑΕΡΙΣΜΟΣ -->
			<?php
				include("menu_meleti_systems_kkm.php");
			?> 
			</div><!-- ΜΗΧΑΝΙΚΟΣ ΑΕΡΙΣΜΟΣ -->
			
			
			<div class="tab-pane" id="tabs-7"><!-- ΥΓΡΑΝΣΗ -->
			<?php
				include("menu_meleti_systems_ygr.php");
			?> 	
			</div><!-- ΥΓΡΑΝΣΗ -->
			
					</div><!--tab content-->
				</div><!--tabs-->
			</div><!--col-md-10-->
		</div>
		 <!-- /.row (main row) -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
