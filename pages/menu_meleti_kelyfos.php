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
	<small>Κέλυφος</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-university"></i> Βιβλιοθήκες</a></li>
	<li class="active"> Κέλυφος</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
		<!--
		<div class="span2">
				
				<div class="alert alert-success">
					<div id="errors_info">
					<h5>Έλεγχος για λάθη</h5>
					Όλες οι ζώνες : <img src="images/interface/test/yes.png"><br/>
					Όλοι οι ΜΘΧ : <img src="images/interface/test/yes.png"><br/>
					Δάπεδα-Οροφές : <img src="images/interface/test/yes.png"><br/>
					Προσανατολισμοί : <img src="images/interface/test/yes.png"><br/>
					Ε<sub>δρομικό</sub> > 0: <img src="images/interface/test/yes.png"><br/>
					U : <img src="images/interface/test/yes.png"><br/>
					Σκιάσεις : <img src="images/interface/test/yes.png"><br/>
					</div>
				</div>
				
				
				<div class="alert alert-success">
					<div id="stats_info">
					<h5>Επιφάνειες</h5>
					Δάπεδα: <br/>
					Οροφές: <br/>
					Τοιχοποιία: <br/>
					Φέρων: <br/>
					Ανοίγματα: <br/>
					
					</div>
				</div>
				
			    <div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h5>Κέλυφος</h5>
				
				Περιγράψτε το κέλυφος θερμικών ζωνών και μη θερμαινόμενων χώρων / ηλιακών χώρων.
				<br/><br/>
				Δίνονται οι επιλογές προσθήκης δαπέδων, οροφών, τοιχοποιίας και ανοιγμάτων. Σε κάθε περίπτωση 
				πρέπει να επιλέξετε την επαφή του δομικού στοιχείου ώστε να προστεθεί στη σωστή θέση στο xml.<br/>
				<i>(πχ αδιαφανές στοιχείο σε επαφή με αέρα προστίθεται στην καρτέλα "αδιαφανή" ενώ δάπεδο σε επαφή με ΜΘΧ 
				προστίθεται ως διαχωριστική επιφάνεια της ζώνης προς εκείνο το ΜΘΧ)</i>
				
				</div>
				
		</div>
		-->
		
	<?php
		$database = new medoo(DB_NAME);
		$table_mel="user_meletes";
		$table_pea="meletes_stoixeiapea";
		$table_mea="meletes_stoixeiameleti";
		$table_dim="meletes_stoixeiadiastaseis";
		$col = "*";
		$where_id=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
		$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
		$select_mel = $database->select($table_mel, $col, $where_id);
		$select_pea = $database->select($table_pea, $col, $where);
		$select_mea = $database->select($table_mea, $col, $where);
		$select_dim = $database->select($table_dim, $col, $where);
		
		$select_mel=$select_mel[0];
		$select_pea=$select_pea[0];
		$select_mea=$select_mea[0];
		$select_dim=$select_dim[0];
		
		//Τύπος μελέτης: 0-Παλιό, 1-Ριζικά ανακ., 2-Νέο,  3-Ριζικά ανακ., 4-Νέο, 
		$meleti_type=$select_mel["type"];
		
		//Διαστάσεις
		$wall_l=$select_dim["t_l"];
		$wall_h=$select_dim["t_h"];
		$wall_d=$select_dim["t_d"];
		$yp_l=$select_dim["yp_l"];
		$dok_h=$select_dim["dok_h"];
		$syr_l=$select_dim["syr_l"];
		$syr_h=$select_dim["syr_h"];
		$wall_a=$select_dim["a"];
		$wall_e=$select_dim["e"];
		$an_l=$select_dim["an_l"];
		$an_h=$select_dim["an_h"];
		$an_p=$select_dim["an_pod"];
		
		//Στοιχεία ΠΕΑ
		if($meleti_type==0){
			$wall_per=$select_pea["percent"];
		}else{
			$wall_per=0;
		}
		
		if($meleti_type!=0){
			$or_u_id=$select_mea["u_or"];
			$dap_u_id=$select_mea["u_dap"];
			$wall_u_id=$select_mea["u_t"];
			$yp_u_id=$select_mea["u_yp"];
			$dok_u_id=$select_mea["u_dok"];
			$syr_u_id=$select_mea["u_syr"];
			$an_u_id=$select_mea["u_an"];
			
			$an_prostasia=0;
			$an_plaisio=0;
			$an_plaisioper=20;
			$an_yalo=1;
		}else{
			$or_u_id=0;
			$dap_u_id=0;
			$wall_u_id=0;
			$yp_u_id=0;
			$dok_u_id=0;
			$syr_u_id=0;
			$an_u_id="u_bytype";
			
			$or_u=0;
			$dap_u=0;
			$wall_u=0;
			$yp_u=0;
			$dok_u=0;
			$syr_u=0;
			$an_u=0;
			
			$an_prostasia=$select_pea["prostasia"];
			$an_plaisio=$select_pea["plaisio"];
			if($select_pea["per_plaisio"]==0){$an_plaisioper=20;}
			if($select_pea["per_plaisio"]==1){$an_plaisioper=30;}
			if($select_pea["per_plaisio"]==2){$an_plaisioper=40;}
			$an_yalo=$select_pea["yalosi"];

		}
	?>
		
		<div class="col-md-12">
			<div class="nav-tabs-custom">
			<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs-1" data-toggle="tab"><i class="fa fa-cube"></i> Θερμική ζώνη</a></li>
				<li><a href="#tabs-2" data-toggle="tab"><i class="fa fa-cube"></i> ΜΘΧ/Ηλιακός χώρος</a></li>
				<li><a href="#tabs-3" data-toggle="tab" style="background-color:#CCFFFF;" onclick="get_meleti_stats();"><i class="fa fa-bar-chart"></i> Στατιστικά</a></li>
				<li><a href="#tabs-4" data-toggle="tab" style="background-color:#CCFFFF;"><i class="fa fa-tasks"></i> Προεπισκόπηση</a></li>
				<li><a href="#tabs-5" data-toggle="tab" style="background-color:#CCFFFF;"><i class="fa fa-life-ring"></i> Βοήθεια</a></li>
			</ul>
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
			<!-- ################# ΖΩΝΗ ###################### -->
			<div class="tab-content">
			<div class="tab-pane active" id="tabs-1" style="background-color:#F0F0F0;">
				<div class="nav-tabs-custom"> <!-- Only required for left/right tabs -->
					<ul class="nav nav-zone">
					<li class="active"><a href="#tab11" data-toggle="tab"><i class="fa fa-cubes"></i>  Δάπεδα <span class="badge" id="n_zone_dapeda"></span></a></li>
					<li><a href="#tab12" data-toggle="tab"><i class="fa fa-cubes"></i> Οροφές <span class="badge" id="n_zone_orofes"></span></a></li>
					<li><a href="#tab13" data-toggle="tab"><i class="fa fa-cubes"></i> Κατακόρυφα αδιαφανή <span class="badge" id="n_zone_adiafani"></span></a></li>
					<li><a href="#tab14" data-toggle="tab"><i class="fa fa-cubes"></i> Κατακόρυφα διαφανή <span class="badge" id="n_zone_diafani"></span></a></li>
					</ul>
					
					
					<div class="tab-content">
						<div class="tab-pane active" id="tab11"><!-- Δάπεδα -->
							<?php
							include("menu_meleti_kelyfos_zone_dapeda.php");
							?>
						</div><!-- Δάπεδα -->
						
						<div class="tab-pane" id="tab12"><!-- Οροφές -->
							<?php
							include("menu_meleti_kelyfos_zone_orofes.php");
							?>
						</div><!-- Οροφές -->
						
						<div class="tab-pane" id="tab13"><!-- Αδιαφανή -->
							<?php
							include("menu_meleti_kelyfos_zone_adiafani.php");
							?>
						</div><!-- Αδιαφανή -->
						
						<div class="tab-pane" id="tab14"><!-- Διαφανή -->
							<?php
							include("menu_meleti_kelyfos_zone_diafani.php");
							?>
						</div><!-- Διαφανή -->
						
					</div>
				</div>	
			</div>
			<!-- ################# ΖΩΝΗ ###################### -->
			
			<!-- ################# ΜΘΧ ###################### -->
			<div class="tab-pane" id="tabs-2" style="background-color:#D8D8D8;">
			
				<div class="nav-tabs-custom"> <!-- Only required for left/right tabs -->
					<ul class="nav nav-mthx">
					<li class="active"><a href="#tab21" data-toggle="tab"><i class="fa fa-cube"></i> Δάπεδα <span class="badge" id="n_mthx_dapeda"></span></a></li>
					<li><a href="#tab22" data-toggle="tab"><i class="fa fa-cube"></i> Οροφές <span class="badge" id="n_mthx_orofes"></span></a></li>
					<li><a href="#tab23" data-toggle="tab"><i class="fa fa-cube"></i> Κατακόρυφα αδιαφανή <span class="badge" id="n_mthx_adiafani"></span></a></li>
					<li><a href="#tab24" data-toggle="tab"><i class="fa fa-cube"></i> Κατακόρυφα διαφανή <span class="badge" id="n_mthx_diafani"></span></a></li>
					</ul>
					
					<div class="tab-content">
						<div class="tab-pane active" id="tab21"><!-- Δάπεδα -->
							<?php
							include("menu_meleti_kelyfos_mthx_dapeda.php");
							?>
						</div><!-- Δάπεδα -->
						
						<div class="tab-pane" id="tab22"><!-- Οροφές -->
							<?php
							include("menu_meleti_kelyfos_mthx_orofes.php");
							?>
						</div><!-- Οροφές -->
						
						<div class="tab-pane" id="tab23"><!-- Αδιαφανή -->
							<?php
							include("menu_meleti_kelyfos_mthx_adiafani.php");
							?>
						</div><!-- Αδιαφανή -->
						<div class="tab-pane" id="tab24"><!-- Διαφανή -->
							<?php
							include("menu_meleti_kelyfos_mthx_diafani.php");
							?>
						</div><!-- Διαφανή -->
					</div>
				</div>
			
			</div>
			<!-- ################# ΜΘΧ ###################### -->
			
			<!-- ################# ΣΤΑΤΙΣΤΙΚΑ ###################### -->
			<div class="tab-pane" id="tabs-3">
			
			<br/>
			<p class="text-info">Στατιστικά στοιχεία θερμικής ζώνης - Τοιχοποιία</p>
				<dl class="dl-horizontal">
					<dt>Τοιχοποιία - Β</dt>
					<dd>
						<div class="progress">
						<div id="bar_wall_b" class="progress-bar progress-bar-info" style="width: 0%"><span id="txtbar_wall_b"></span></div>
						</div>
					</dd>
					
					<dt>Τοιχοποιία - Α</dt>
					<dd>
						<div class="progress">
						<div id="bar_wall_a" class="progress-bar progress-bar-success" style="width: 0%"><span id="txtbar_wall_a"></span></div>
						</div>
					</dd>
					
					<dt>Τοιχοποιία - Ν</dt>
					<dd>
						<div class="progress">
						<div id="bar_wall_n" class="progress-bar progress-bar-warning" style="width: 0%"><span id="txtbar_wall_n"></span></div>
						</div>
					</dd>
					
					<dt>Τοιχοποιία - Δ</dt>
					<dd>
						<div class="progress">
						<div id="bar_wall_d" class="progress-bar progress-bar-danger" style="width: 0%"><span id="txtbar_wall_d"></span></div>
						</div>
					</dd>
					
					<dt>Τοιχοποιία ΣΥΝΟΛΟ</dt>
					<dd>
						<span id="txtbar_wall"></span>
					</dd>
				</dl>
				Τα δομικά στοιχεία που έχετε προσθέσει προσανατολισμό χειροκίνητα προστίθενται στο Βόρειο προσανατολισμό. 
				<hr/>
				
				<p class="text-info">Στατιστικά στοιχεία θερμικής ζώνης - Διαφανή</p>
				<dl class="dl-horizontal">					
					<dt>Ανοίγματα - Β</dt>
					<dd>
						<div class="progress">
						<div id="bar_window_b" class="progress-bar progress-bar-info" style="width: 0%"><span id="txtbar_window_b"></span></div>
						</div>
					</dd>
					
					<dt>Ανοίγματα - Α</dt>
					<dd>
						<div class="progress">
						<div id="bar_window_a" class="progress-bar progress-bar-success" style="width: 0%"><span id="txtbar_window_a"></span></div>
						</div>
					</dd>
					
					<dt>Ανοίγματα - Ν</dt>
					<dd>
						<div class="progress">
						<div id="bar_window_n" class="progress-bar progress-bar-warning" style="width: 0%"><span id="txtbar_window_n"></span></div>
						</div>
					</dd>
					
					<dt>Ανοίγματα - Δ</dt>
					<dd>
						<div class="progress">
						<div id="bar_window_d" class="progress-bar progress-bar-danger" style="width: 0%"><span id="txtbar_window_d"></span></div>
						</div>
					</dd>
					
					<dt>Ανοίγματα ΣΥΝΟΛΟ</dt>
					<dd>
						<span id="txtbar_window"></span>
					</dd>
				</dl>
				Τα δομικά στοιχεία που έχετε προσθέσει προσανατολισμό χειροκίνητα προστίθενται στο Βόρειο προσανατολισμό. 
				<hr/>
				
				<p class="text-info">Στατιστικά στοιχεία θερμικής ζώνης - Δάπεδα</p>
				<dl class="dl-horizontal">
					<dt>Δάπεδα σε ΜΘΧ</dt>
					<dd>
						<div class="progress">
						<div id="bar_dap_mthx" class="progress-bar progress-bar-info" style="width: 0%"><span id="txtbar_dap_mthx"></span></div>
						</div>
					</dd>
					
					<dt>Δάπεδα σε αέρα (πυλωτές)</dt>
					<dd>
						<div class="progress">
						<div id="bar_dap_air" class="progress-bar progress-bar-success" style="width: 0%"><span id="txtbar_dap_air"></span></div>
						</div>
					</dd>
					
					<dt>Δάπεδα σε έδαφος</dt>
					<dd>
						<div class="progress">
						<div id="bar_dap_edafos" class="progress-bar progress-bar-warning" style="width: 0%"><span id="txtbar_dap_edafos"></span></div>
						</div>
					</dd>
					
					<dt>Δάπεδα ΣΥΝΟΛΟ</dt>
					<dd>
						<span id="txtbar_dap"></span>
					</dd>
				</dl>
				
				<hr/>
				
				<p class="text-info">Στατιστικά στοιχεία θερμικής ζώνης - Οροφές</p>
				<dl class="dl-horizontal">
					<dt>Οροφές σε ΜΘΧ</dt>
					<dd>
						<div class="progress">
						<div id="bar_oro_mthx" class="progress-bar progress-bar-info" style="width: 0%"><span id="txtbar_oro_mthx"></span></div>
						</div>
					</dd>
					
					<dt>Οροφές σε αέρα (στέγες/δώματα)</dt>
					<dd>
						<div class="progress">
						<div id="bar_oro_air" class="progress-bar progress-bar-success" style="width: 0%"><span id="txtbar_oro_air"></span></div>
						</div>
					</dd>
					
					<dt>Οροφές ΣΥΝΟΛΟ</dt>
					<dd>
						<span id="txtbar_oro"></span>
					</dd>
				</dl>
			</div>
			<!-- ################# ΣΤΑΤΙΣΤΙΚΑ ###################### -->
			
			<!-- ################# ΠΡΟΕΠΙΣΚΟΠΙΣΗ ###################### -->
			<div class="tab-pane" id="tabs-4">
			
			<br/>
<div class="row">
<div class="col-md-3">
	<div id="tree_menu"></div>
	<?php
	echo create_treenav();//functions_meleti_kelyfos.php
	?>
	
	<br/><br/>
	<blackquote>Δεν εμφανίζονται προσωρινά οι διαχωριστικές επιφάνειες οι οποίες παράγονται μόνο στο xml.</blackquote>
	<br/><br/>
</div><!--col-md-3-->
<div class="col-md-9">
	<span id="stats_preview"></span>
	<div style="display:none" id="prevxml_building">Κτίριο</div>
	<div style="display:none" id="prevxml_zone1">Ζώνη 1</div>
	<div style="display:none" id="prevxml_zone1_kelyfos">Κέλυφος ζώνης 1</div>
	<div style="display:none" id="prevxml_zone1_dia">Διαχωριστική1 κελύφους ζώνης 1</div>
	<div style="display:none" id="prevxml_zone1_systems">Συστήματα ζώνης 1</div>
	<div style="display:none" id="prevxml_zone2">Ζώνη 2</div>
	<div style="display:none" id="prevxml_zone2_kelyfos">Κέλυφος ζώνης 2</div>
	<div style="display:none" id="prevxml_zone2_dia">Διαχωριστική1 κελύφους ζώνης 2</div>
	<div style="display:none" id="prevxml_zone2_systems">Συστήματα ζώνης 2</div>
	<div style="display:none" id="prevxml_mthx1">Μη θερμαινόμενος χώρος 1</div>
</div><!--col-md-9-->
</div><!--row-->
<script>
function show_tab(tab){
	var like_preview = document.querySelectorAll("[id^=prevxml]");
	for(var i=0; i<like_preview.length; i++){
	   like_preview[i].style.display = "none";
	}
	document.getElementById(tab).style.display = "inline";
}
</script>

			</div>
			<!-- ################# ΠΡΟΕΠΙΣΚΟΠΙΣΗ ###################### -->
			
			<!-- ################# ΒΟΗΘΕΙΑ ###################### -->
			<div class="tab-pane" id="tabs-5">
				<div class="nav-tabs-custom">
					<ul class="nav nav-pills">
					<li class="active"><a href="#tab41" data-toggle="tab"><i class="fa fa-lightbulb-o"></i> Γενικά</a></li>
					<li><a href="#tab42" data-toggle="tab"><i class="fa fa-lightbulb-o"></i> Δάπεδα</a></li>
					<li><a href="#tab43" data-toggle="tab"><i class="fa fa-lightbulb-o"></i> Οροφές</a></li>
					<li><a href="#tab44" data-toggle="tab"><i class="fa fa-lightbulb-o"></i> Αδιαφανή</a></li>
					<li><a href="#tab45" data-toggle="tab"><i class="fa fa-lightbulb-o"></i> Διαφανή</a></li>
					<li><a href="#tab46" data-toggle="tab"><i class="fa fa-lightbulb-o"></i> Παθητικά ηλιακά/Σκιάσεις</a></li>
					<li><a href="#tab47" data-toggle="tab"><i class="fa fa-copyright"></i> Τεκμηρίωση</a></li>
					</ul>
					
					<div class="tab-content">
					
						<div class="tab-pane active" id="tab41"><!-- Γενικά -->
						<br/>
							Κατά την προσθήκη δομικών στοιχείων πρέπει να ακολουθηθούν κάποιοι γενικοί κανόνες ώστε να εμφανιστούν αργότερα όλα τα δομικά στοιχεία εκεί 
							που πραγματικά ανήκουν. <br/><br/>
							Έτσι αρχικά επιλέγεται από τις καρτέλες που θέλετε να προσθέσετε δομικό στοιχείο δηλαδή σε θερμική ζώνη ή σε Μη θερμαινόμενο χώρο.<br/>
							Έπειτα επιλέγετε τι δομικό στοιχείο θέλετε να προσθέσετε δηλαδή επιλέγετε ανάμεσα στις καρτέλες δάπεδα, οροφές, αδιαφανή, διαφανή και παθητικά 
							ηλιακά. <br/>
							Σε κάθε καρτέλα εμφανίζονται τα δομικά στοιχεία που έχετε προσθέσει ενώ δίνεται η δυνατότητα επεξεργασίας και προσθήκης νέων. 
							<br/><br/>
							Κατά την προσθήκη ο γενικός κανόνας είναι πως:
							<ul>
								<li>Αρχικά δηλώνετε που ανηκει το δομικό στοιχείο. πχ ανήκει στη "Ζώνη 1"</li>
								<li>Δηλώνετε με τι έρχεται σε επαφή. πχ σε αέρα</li>
								<li>Δηλώνετε τα γεωμετρικά χαρακτηριστικά. πχ τοίχος με ύψος=3 και πλάτος=2 ...</li>
								<li>Επιλέγετε συντελεστές θερμοπερατότητας. πχ U από υπολογισμό</li>
								<li>Επιλέγετε συντελεστές σκίασης</li>
								<li>Επιλέγετε πρόσθετους συντελεστές κατά περίπτωση. πχ διαπερατότητα, βάθη έδρασης κλπ</li>
							</ul>
						</div><!-- Γενικά -->
						
						<div class="tab-pane" id="tab42"><!-- Δάπεδα -->
						<br/>
							<table class="table table-bordered">
								<tr class="info">
									<td>Επαφή</td>
									<td>Προσθήκη ΤΕΕ-ΚΕΝΑΚ</td>
									<td>Σκιάσεις</td>
									<td>Πρόσθετα</td>
								</tr>
								<tr>
									<td>Σε αέρα</td>
									<td>Αδιαφανή - Πυλωτή</td>
									<td>Ναι</td>
									<td>-</td>
								</tr>
								<tr>
									<td>Σε έδαφος</td>
									<td>Επαφή με έδαφος - Δάπεδο</td>
									<td>Όχι</td>
									<td>Περίμετρος, Βάθος έδρασης</td>
								</tr>
								<tr>
									<td>Σε ΜΘΧ</td>
									<td>Διαχωριστική επιφάνεια - Δάπεδο</td>
									<td>Ναι</td>
									<td>-</td>
								</tr>
							</table>
							<ul>
								<li>Εάν το δάπεδο έρχεται σε επαφή με αέρα (πυλωτή) δηλώνεται ως Πυλωτή στα αδιαφανή</li>
								<li>Εάν το δάπεδο έρχεται σε επαφή με το έδαφος δηλώνεται ως Δάπεδο στην επαφή με έδαφος</li>
								<li>Εάν το δάπεδο έρχεται σε επαφή με ΜΘΧ ή ηλιακό χώρο προστίθεται στη διαχωριστική επιφάνεια</li>
							</ul>
						</div><!-- Δάπεδα -->
						
						<div class="tab-pane" id="tab43"><!-- Οροφές -->
						<br/>
							<table class="table table-bordered">
								<tr class="info">
									<td>Επαφή</td>
									<td>Προσθήκη ΤΕΕ-ΚΕΝΑΚ</td>
									<td>Σκιάσεις</td>
									<td>Πρόσθετα</td>
								</tr>
								<tr>
									<td>Σε αέρα</td>
									<td>Αδιαφανή - Οροφή</td>
									<td>Ναι</td>
									<td>-</td>
								</tr>
								<tr>
									<td>Σε ΜΘΧ</td>
									<td>Διαχωριστική επιφάνεια - Οροφή</td>
									<td>Ναι</td>
									<td>-</td>
								</tr>
							</table>
							<ul>
								<li>Εάν η οροφή έρχεται σε επαφή με αέρα (οροφή) δηλώνεται ως Οροφή στα αδιαφανή</li>
								<li>Εάν η οροφή έρχεται σε επαφή με ΜΘΧ ή ηλιακό χώρο προστίθεται στη διαχωριστική επιφάνεια</li>
							</ul>
						</div><!-- Οροφές -->
						
						<div class="tab-pane" id="tab44"><!-- Αδιαφανή -->
						<br/>
							<table class="table table-bordered">
								<tr class="info">
									<td>Επαφή</td>
									<td>Προσθήκη ΤΕΕ-ΚΕΝΑΚ</td>
									<td>Σκιάσεις</td>
									<td>Πρόσθετα</td>
								</tr>
								<tr>
									<td>Σε αέρα</td>
									<td>Αδιαφανή - Τοίχος</td>
									<td>Ναι</td>
									<td>-</td>
								</tr>
								<tr>
									<td>Σε έδαφος</td>
									<td>Επαφή με έδαφος - Τοίχος</td>
									<td>Όχι</td>
									<td>Κατώτερο βάθος, Ανώτερο βάθος</td>
								</tr>
								<tr>
									<td>Σε ΜΘΧ</td>
									<td>Διαχωριστική επιφάνεια - Τοίχος</td>
									<td>Ναι</td>
									<td>-</td>
								</tr>
							</table>
							<ul>
								<li>Εάν ο τοίχος έρχεται σε επαφή με αέρα δηλώνεται ως Τοίχος στα αδιαφανή</li>
								<li>Εάν ο τοίχος έρχεται σε επαφή με το έδαφος δηλώνεται ως Τοίχος στην επαφή με έδαφος</li>
								<li>Εάν ο τοίχος έρχεται σε επαφή με ΜΘΧ ή ηλιακό χώρο προστίθεται στη διαχωριστική επιφάνεια</li>
							</ul>
						</div><!-- Αδιαφανή -->
						
						<div class="tab-pane" id="tab45"><!-- Διαφανή -->
						<br/>
							Τα ανοίγματα ακολουθούν την προσθήκη του τοίχου ή της οροφής που ανήκουν. Εάν ο τοίχος που ανήκουν έχει πχ επαφή με αέρα το άνοιγμα προστίθεται στα 
							διαφανή της ζώνης. Αν ο τοίχος βρίσκεται σε επαφή με ΜΘΧ το άνοιγμα θα προστεθεί στα διαφανή της διαχωριστικής επιφάνειας της ζώνης με το ΜΘΧ. 
							<br/><br/>
							Εάν δηλωθεί ως παθητικό ηλιακό ένα άνοιγμα προστίθεται στην καρτέλα παθητικά ηλιακά ως άμεσου ηλιακού κέρδους.
						</div><!-- Διαφανή -->
						
						<div class="tab-pane" id="tab46"><!-- Παθητικά ηλιακά -->
						<br/>
							<p class="text-info">Άμεσου ηλιακού κέρδους</p>
							<p class="muted">Προστίθονται μαζί με τα ΔΙΑΦΑΝΗ.</p>
						
							<p class="text-info">Έμμεσου ηλιακού κέρδους</p>
							<p class="muted">Η προσθήκη αυτού του τύπου δεν υποστηρίζεται ακόμα.</p>
						
							<p class="text-info">Τοίχος Trombe</p>
							<p class="muted">Η προσθήκη αυτού του τύπου δεν υποστηρίζεται ακόμα.</p>
							
							<p class="text-info">Παραδοχές σκιάσεων</p>
							<p class="muted">Κατά τον υπολογισμό σκιάσεων στην τοιχοποιία θεωρείται πως ο κάθε τοίχος έχει έναν ενιαίο συντελεστή σκίασης 
							θέρμανσης και ψύξης σε όλα τα τμήματα που τον αποτελούν. Υποστηλώματα, δοκοί, τμήματα συρομένων καθώς και το δρομικό τμήμα 
							της τοιχοποιία θα εμφανίζονται με τους ίδιους συντελεστές σκίασης. Η πραγματική κατάσταση διαφέρει καθώς πχ η δοκός μπορεί να 
							βρίσκεται ολόκληρη καλυμένη "πίσω" από ένα πρόβολο και στην πράξη να έχει μηδενικούς συντελεστές ως πλήρως σκιασμένη. </p>
							<p class="muted">Σε κάθε περίπτωση εάν χρειάζεται να προσθέσετε διαφορετικούς συντελεστές σκίασης σε κάποιο τμήμα του τοίχου 
							μπορείτε να επιλέξετε στα γενικά στοιχεία της μελέτης να μην "συμπτυχθούν" σε μία γραμμή στο κέλυφος όλα τα τμήματα του κάθε τοίχου και 
							χειροκίνητα να προσθέσετε πχ μηδενικούς συντελεστές σε μία δοκό. </p>
						</div><!-- Παθητικά ηλιακά -->
						
						<div class="tab-pane" id="tab47"><!-- Τεκμηρίωση -->
						<br/>
							<span class="label label-warning">Προσοχή!</span> Το la-kenak θα σας θυμίζει τις πρέπει να προσέξετε.
							<br/><br/>
							πχ Αν δηλώσετε την οικοδομική άδεια στην περίοδο ισχύος του ΚΘΚ και υπάρχει μελέτη σύμφωνα με τον ΚΘΚ κατατεθημένη στην πολεοδομία και 
							δεν υπάρχει εμφανής λόγος αμφισβήτησής της τότε πρέπει αναγκαστικά να λάβετε υπ' όψη τους συντελεστές θερμοπερατότητας που εμφανίζονται σε αυτή τη μελέτη. 
							<br/><br/>
							<span class="label label-success">Σωστή προσθήκη</span> To la-kenak δεν θα σας αφήσει να κάνετε λάθος. 
							<br/><br/>
							Παράλληλα με την προσθήκη το λογισμικό ελέγχει εάν υπάρχει ασυμφωνία ανάμεσα στις όψεις του κτιρίου. Με βάση τη σύγκριση δαπέδων και οροφών το 
							λογισμικό σας προειδοποιεί για τη διαφορά ενώ αν υπάρχει αδιαβατικό στοιχείο γνωρίζετε από πριν οτι αυτή η ασυμφωνία δεν προκύπτει από κάποιο λάθος 
							και προκύπτει μόνο εξαιτίας αυτής της αδιαβατικής επιφάνειας.<br/>
							Με βάση τη σύγκριση πχ Βόρειων και Νότιων τοίχων το λογισμικό θα σας προειδοποιήσει για παρόμοιες ασυμφωνίες μέσω ενός εξελιγμένου αλγορίθμου ο οποίος 
							ελέγχει τον προσανατολισμό των επιφανειών ως προς το αζιμούθιο αλλά και ασυμφωνίες που μπορεί να προκύπτουν εξαιτίας αδιαβατικών επιφανειών. 
							<br/><br/>
							Το λογισμικό θα σας ειδοποιήσει που βρίσκεται αυτό το αδιαβατικό στοιχείο (στο δάπεδο, στην οροφή ή σε ποιό προσανατολισμό για παράπλευρες επιφάνειες) 
							και έτσι μπορείτε να συνεχίσετε στα υπόλοιπα τμήματα του λογισμικού με ασφάλεια. <br/>
							Επίσης θα σας προειδοποιήσει εάν μια πλευρά δεν είναι κάθετη ή παράλληλη στις υπόλοιπες (περίπτωση μη ορθογώνιου κτιρίου) ώστε να αποφύγετε λάθη στους 
							προσανατολισμούς και αυτές οι ασυμφωνίες να εξηγούνται λογικά.
							<br/><br/>
							Επίσης έλεγχοι γίνονται και κατά τη διάρκεια της προσθήκης. Έτσι για παράδειγμα εάν προσθέσετε μία οροφή και επιλέξετε ότι αυτή είναι κατακόρυφη (κλίση = 0) 
							αυτομάτως δεν έχετε δικαίωμα επιλογής στον προσανατολισμό της προς τον ορίζοντα καθώς ένα δώμα δεν βρίσκεται προσανατολισμένο ως προς το αζιμούθιο προς 
							καμία κατεύθυνση. 
							<br/><br/>
							<span class="label label-info">Στατιστικά</span> Το la-kenak θα σας βοηθήσει να επιλέξετε τις παρεμβάσεις.
							<br/><br/>
							Σε προγράμματα Εξοικονομώ κατ' οίκον θα μπορείτε να δείτε με βάση τις προσθήκες στην καρτέλα ΣΤΑΤΙΣΤΙΚΑ τις επιφάνειες ανά προσανατολισμό και τύπο ώστε 
							να επιλέξετε που μπορεί να δοθεί το "βάρος" της κάθε παρέμβασης. Επίσης θα εμφανίζονται τα εμβαδά ώστε να ελέγχεται κάθε στιγμή αν υπάρχει κάποια ασυμφωνία. 
							<br/><br/>
							<span class="label label-info">Προεπισκόπηση</span> Το la-kenak αυτομάτως δημιουργεί τους πίνακες κελύφους.
							<br/><br/>
							Σε περίπτωση που δεν θέλετε να δημιουργήσετε το xml για τη μελέτη ή το πιστοποιητικό μέσω του la-kenak η προεπισκόπηση δηλαδή η εμφάνιση του κελύφους σε πίνακες 
							μπορεί να σας βοηθήσει να μεταφέρετε τους πίνακες χειροκίνητα στο τεε-κενακ.. Η διαδικασία είναι απλή και με απλή αντιγραφή των πινάκων της προεπισκόπησης μπορείτε 
							να μεταφέρετε τους πίνακες σε κάποιο λογιστικό φύλλο, εκεί να κάνετε αλλαγές ώστε η μορφή να είναι ίδια με το τεε-κενακ. και έπειτα να τους αντιγράψετε στο τεε-κενακ. 
						</div><!-- Τεκμηρίωση -->
					</div>
				</div>
			</div>
			<!-- ################# ΒΟΗΘΕΙΑ ###################### -->
		
		
			<script>
			//Εύρεση του συνολικού αριθμού των στοιχείων
			function get_meleti_n(){
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_general.php?get_meletes_n=1" ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					var arr = JSON.parse(xmlhttp.responseText);
					document.getElementById("n_zone_dapeda").innerHTML=arr[0];
					document.getElementById("n_zone_orofes").innerHTML=arr[1];
					document.getElementById("n_zone_adiafani").innerHTML=arr[2];
					document.getElementById("n_zone_diafani").innerHTML=arr[3];
					document.getElementById("n_mthx_dapeda").innerHTML=arr[4];
					document.getElementById("n_mthx_orofes").innerHTML=arr[5];
					document.getElementById("n_mthx_adiafani").innerHTML=arr[6];
					document.getElementById("n_mthx_diafani").innerHTML=arr[7];
					
					document.getElementById('wait').style.display="none";
				}}
			}
			
			//Εύρεση του συνολικού αριθμού των στοιχείων
			function get_meleti_stats(){
			document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_general.php?get_meletes_stats=1" ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					var arr = JSON.parse(xmlhttp.responseText);
					var stats_check;
					document.getElementById("txtbar_wall").innerHTML=arr[0]+"m<sup>2</sup>";
					document.getElementById("txtbar_window").innerHTML=arr[1]+"m<sup>2</sup>";
					document.getElementById("txtbar_dap").innerHTML=arr[2]+"m<sup>2</sup>";
					document.getElementById("txtbar_oro").innerHTML=arr[3]+"m<sup>2</sup>";
					
					var bar_wall_b = (arr[4]/arr[0])*100;
					var bar_wall_a = (arr[5]/arr[0])*100;
					var bar_wall_n = (arr[6]/arr[0])*100;
					var bar_wall_d = (arr[7]/arr[0])*100;
					document.getElementById("txtbar_wall_b").innerHTML=arr[4]+"m<sup>2</sup>";
					document.getElementById("txtbar_wall_a").innerHTML=arr[5]+"m<sup>2</sup>";
					document.getElementById("txtbar_wall_n").innerHTML=arr[6]+"m<sup>2</sup>";
					document.getElementById("txtbar_wall_d").innerHTML=arr[7]+"m<sup>2</sup>";
					document.getElementById("bar_wall_b").style.width=bar_wall_b+"%";
					document.getElementById("bar_wall_a").style.width=bar_wall_a+"%";
					document.getElementById("bar_wall_n").style.width=bar_wall_n+"%";
					document.getElementById("bar_wall_d").style.width=bar_wall_d+"%";
					
					var bar_window_b = (arr[8]/arr[1])*100;
					var bar_window_a = (arr[9]/arr[1])*100;
					var bar_window_n = (arr[10]/arr[1])*100;
					var bar_window_d = (arr[11]/arr[1])*100;
					document.getElementById("txtbar_window_b").innerHTML=arr[8]+"m<sup>2</sup>";
					document.getElementById("txtbar_window_a").innerHTML=arr[9]+"m<sup>2</sup>";
					document.getElementById("txtbar_window_n").innerHTML=arr[10]+"m<sup>2</sup>";
					document.getElementById("txtbar_window_d").innerHTML=arr[11]+"m<sup>2</sup>";
					document.getElementById("bar_window_b").style.width=bar_window_b+"%";
					document.getElementById("bar_window_a").style.width=bar_window_a+"%";
					document.getElementById("bar_window_n").style.width=bar_window_n+"%";
					document.getElementById("bar_window_d").style.width=bar_window_d+"%";
					
					var bar_dap_mthx = (arr[12]/arr[2])*100;
					var bar_dap_air = (arr[13]/arr[2])*100;
					var bar_dap_edafos = (arr[14]/arr[2])*100;
					document.getElementById("txtbar_dap_mthx").innerHTML=arr[12]+"m<sup>2</sup>";
					document.getElementById("txtbar_dap_air").innerHTML=arr[13]+"m<sup>2</sup>";
					document.getElementById("txtbar_dap_edafos").innerHTML=arr[14]+"m<sup>2</sup>";
					document.getElementById("bar_dap_mthx").style.width=bar_dap_mthx+"%";
					document.getElementById("bar_dap_air").style.width=bar_dap_air+"%";
					document.getElementById("bar_dap_edafos").style.width=bar_dap_edafos+"%";
					
					var bar_oro_mthx = (arr[15]/arr[3])*100;
					var bar_oro_air = (arr[16]/arr[3])*100;
					document.getElementById("txtbar_oro_mthx").innerHTML=arr[15]+"m<sup>2</sup>";
					document.getElementById("txtbar_oro_air").innerHTML=arr[16]+"m<sup>2</sup>";
					document.getElementById("bar_oro_mthx").style.width=bar_oro_mthx+"%";
					document.getElementById("bar_oro_air").style.width=bar_oro_air+"%";
					
					document.getElementById('wait').style.display="none";
				}}
			}
			
			//Προεπισκόπηση του κελύφους
			function get_meleti_preview(type,id){
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_meleti_general.php?get_meletes_preview=1&type="+type+"&id="+id ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					var arr = xmlhttp.responseText;
					document.getElementById("stats_preview").innerHTML=arr;
					document.getElementById('wait').style.display="none";
				}}	
			}
			
			get_meleti_n();
			get_meleti_stats();
			</script>
			<script>
			function modal_height(){
				//var y = $(window).height()-250;
				//var styles = {'max-height': y};
				//$(document).find('.modal-body').css(styles);
			}
			</script>
			
			
			<!-- MODALS ΒΟΗΘΕΙΑΣ -->
<!-- ###################### Κρυφό help_u_katakoryfa για εμφάνιση ###################### -->
<div id="help_u_katakoryfa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Επιλογή U - Κατακόρυφα στοιχεία</h6>
	</div>

	<div class="modal-body">
	<font size="1">
		<?php
		echo create_library_adiafani_katakorifa();
		?>
	</font>	
	</div>	
	
	<div class="modal-footer">	
		<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Κλείσιμο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό help_u_katakoryfa για εμφάνιση ###################### -->
<div id="help_u_orizontia" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Επιλογή U - Οριζόντια στοιχεία</h6>
	</div>

	<div class="modal-body">
	<font size="1">
		<?php
		echo create_library_adiafani_orizontia();
		?>
	</font>	
	</div>	
	
	<div class="modal-footer">	
		<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Κλείσιμο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό help_ae για εμφάνιση ###################### -->
<div id="help_ae" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Τυπικές τιμές απορροφητικότητας/εκπεμπτικότητας</h6>
	</div>

	<div class="modal-body">
	<font size="1">
		<?php
		echo create_library_adiafani_a();
		echo create_library_adiafani_e();
		?>
	</font>	
	</div>	
	
	<div class="modal-footer">	
		<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Κλείσιμο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό help_gb για εμφάνιση ###################### -->
<div id="help_gb" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Προσανατολισμός/κλίση κατακόρυφων - οριζόντιων στοιχείων</h6>
	</div>

	<div class="modal-body">
		<img src="images/help/azimuth.png"></img>
	</div>	
	
	<div class="modal-footer">	
		<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Κλείσιμο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό help_dimensions για εμφάνιση ###################### -->
<div id="help_dimensions" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Διαστάσεις τοιχοποιίας, ανοιγμάτων</h6>
	</div>

	<div class="modal-body">
		<img src="images/help/dimensions.png"></img>
	</div>	
	
	<div class="modal-footer">	
		<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Κλείσιμο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό help_epilogi_zone για εμφάνιση ###################### -->
<div id="help_epilogi_zone" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Επιλογή ζώνης - ΜΘΧ, επιλογή ορόφων</h6>
	</div>

	<div class="modal-body">
		<img src="images/word-images/epilogi_h.png"></img>
	</div>	
	
	<div class="modal-footer">	
		<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Κλείσιμο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό help_edafos για εμφάνιση ###################### -->
<div id="help_edafos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Ανώτερο - Κατώτερο βάθος επαφής σε έδαφος</h6>
	</div>

	<div class="modal-body">
		<img src="images/word-images/utbz1z2.png"></img>
	</div>	
	
	<div class="modal-footer">	
		<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Κλείσιμο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό help_psi για εμφάνιση ###################### -->
<div id="help_psi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Θερμογέφυρες</h6>
	</div>

	<div class="modal-body">
		<img src="images/help/psi.png"></img>
	</div>	
	
	<div class="modal-footer">	
		<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Κλείσιμο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal για εικόνες για εμφάνιση ###################### -->
<div id="help_kelyfosimg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Προβολή/Σχεδίαση δομικού στοιχείου</h6>
	</div>

	<div class="modal-body">
		<div id="kelyfosimg"></div>
	</div>	
	
	<div class="modal-footer">	
		<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Κλείσιμο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
			
					</div><!--tab content-->
				</div><!--tabs-->
			</div><!--col-md-10-->
		</div>
		 <!-- /.row (main row) -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->