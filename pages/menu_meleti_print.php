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
confirm_meleti_isset();

	$database = new medoo(DB_NAME);
	$admin_prefs = $database->select("core_preferences","*",array("id" => "1"));
	$admin_menu_teyxos = $admin_prefs[0]["menu_teyxos"];
	$admin_teyxos_tcpdf = $admin_prefs[0]["teyxos_tcpdf"];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
	<h1>
	La-kenak
	<small>Εκτύπωση τεύχους</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-university"></i> Βιβλιοθήκες</a></li>
	<li class="active"> Τεύχος</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
<?php
	if($admin_menu_teyxos!=0){//Έχει οριστεί να φαίνεται το τεύχος στις γενικές ρυθμίσεις	
?>
<!-- Main row -->
<div class="row">
	
		<div class="col-md-2">
		<br/>
		<?php
		$database = new medoo(DB_NAME);
		$teyxos_table = "meletes_teyxos";
		$protypo_table = "meletes_teyxos_p";
		$db_columns = "*";
		$where_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
		
		//Μέτρηση γραμμών με τα τεύχη
		$count_protypo = $database->count($protypo_table, $where_parameters);
		$count_teyxos = $database->count($teyxos_table, $where_parameters);
		
		//εάν δεν υπάρχουν οι γραμμές του τεύχους για τη μελέτη->δημιουργία
		if($count_protypo==0){
			recreate_meleti_protypo();
		}
		if($count_teyxos==0){
			//update_meleti_teyxos();
			insert_meleti_teyxos_blank();
			echo "Είναι η 1η φορά που βρίσκεστε εδώ. Δημιουργήστε το τεύχος πατώντας \"Δημιουργία τεύχους\"";
			echo "<a class=\"btn btn-default\" href=\"#\" role=\"button\" onclick=\"update_teyxos();\">Δημιουργία τεύχους</a>";
		}
		?>
		<br/>
		<div class="btn-group">
			<button class="btn btn-solar dropdown-toggle" data-toggle="dropdown">
			<span class="fa fa-download"></span>  Ενέργειες χρήστη 
			<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><a tabindex="-1" href="#" onclick="save_teyxos();">
					<i class="fa fa-save"></i>  Αποθήκευση</a>
				</li>
				<li><a tabindex="-1" href="#" onclick="print_teyxos();">
					<i class="fa fa-file-pdf-o"></i>  Δημιουργία PDF (fast)</a>
				</li>
				<?php
					if($admin_teyxos_tcpdf!=0){//Έχει οριστεί να χρησιμοποιείται η TCPDF (ανάλογη ρύθμιση υπάρχει στο αρχείο)
				?>
				<li><a tabindex="-1" href="includes/print_teyxos.php" target="_blank">
					<i class="fa fa-file-pdf-o"></i>  Δημιουργία PDF (slow - tcpdf)</a>
				</li>
				<?php
					}//Έχει οριστεί να χρησιμοποιείται η TCPDF (ανάλογη ρύθμιση υπάρχει στο αρχείο)
				?>
				<li><a tabindex="-1" href="#" onclick="update_teyxos();">
					<i class="fa fa-cog"></i>  Επανυπολογισμός</a>
				</li>
				<li><a tabindex="-1" href="#" role="button" onclick="show_protypo();">
					<i class="fa fa-database"></i>  Πρότυπο τεύχος μελέτης</a>
				</li>
				<li><a tabindex="-1" href="#help_popup" role="button" data-toggle="modal">
					<i class="fa fa-life-ring"></i>  Βοήθεια</a>
				</li>
			</ul>
		</div>
		
		<br/><br/>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Προσοχή!</h4>
			Εάν κάνατε αλλαγές στη μελέτη σε κάποιο άλλο σημείο πατήστε πρώτα το πλήκτρο "Δημιουργία από πρότυπο" ώστε να επανυπολογιστεί το τεύχος.
		</div>
		<div id="info"></div>
	
		</div>
		
		<div class="col-md-10">
		
		<?php
		//Επιλογή του πρότυπου τεύχους
		$select_protypo = $database->select($protypo_table, $db_columns, $where_parameters);
		$protypo = $select_protypo[0];
		
		//Επιλογή του αποθηκευμένου τεύχους
		$select_teyxos = $database->select($teyxos_table,$db_columns,$where_parameters);
		$teyxos = $select_teyxos[0];
		?>
		<div class="nav-tabs-custom">
		<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>
			<ul class="nav nav-tabs">
		<?php
		
			for($i=1;$i<=8;$i++){
				if($i==1){$li_class="class=\"active\"";}else{$li_class="";}
				echo "<li ".$li_class."><a href=\"#kefalaio-".$i."\"  data-toggle=\"tab\">Κεφ. ".$i."</a></li>";
			}
			echo "</ul>";
			
			echo "<div class=\"tab-content\">";
			for($i=1;$i<=8;$i++){
				if($i==1){$div_class="class=\"tab-pane active\"";}else{$div_class="class=\"tab-pane\"";}
			echo "<div ".$div_class." id=\"kefalaio-".$i."\">";
			echo "<div id=\"container\" style=\"background:#eee;border:1px solid #000000;padding:3px;width:99%;height:610px;\">";
			echo "<textarea name=\"text_kef".$i."\" id=\"text_kef".$i."\" >".$teyxos["kef".$i]."</textarea>";
			echo "<script type=\"text/javascript\">CKEDITOR.replace('text_kef".$i."');</script>";
			echo "</div></div>";
			}
		?>	
			<button type="submit" name="submit" value="save-teyxos" class="btn btn-primary" onclick="save_teyxos();">Αποθήκευση</button>
			<input type "button" value="Εκτύπωση (browser)" onclick="print_teyxos();" class="btn btn-success" />
			<?php
				if($admin_teyxos_tcpdf!=0){//Έχει οριστεί να χρησιμοποιείται η TCPDF (ανάλογη ρύθμιση υπάρχει στο αρχείο)
			?>
			<a class="btn btn-success" href="includes/print_teyxos.php" target="_blank">Εκτύπωση (tcpdf)</a>
			<?php
				}//Έχει οριστεί να χρησιμοποιείται η TCPDF (ανάλογη ρύθμιση υπάρχει στο αρχείο)
			?>
			
		<br/><br/>
<!-- ######################### Κρυφό ΤΕΥΧΟΣ για εμφάνιση ######################### -->			
<div id="help_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h3 id="myModalLabel">Σχετικά με το τεύχος</h3>
	</div>
	<div class="modal-body">
	<p>
		<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Εκτύπωση</h4>
		Το τεύχος λειτουργεί με τον εξής τρόπο: <br/><br/>
		Κάθε μελέτη περιέχει 2 τεύχη. Ένα πρότυπο και ένα τελικό. Το τελικό δημιουργείται από το πρότυπο. 
		Σε κάθε μελέτη δημιουργείται αυτόματα ένα πρότυπο τεύχος. Αυτό περιέχει κάποια γενικά στοιχεία τα οποία ισχύουν σε κάθε μελέτη και για 
		οποιαδήποτε περίπτωση κτιρίου. Σε αυτό υπάρχουν θέσεις όπου προστίθονται κείμενα ανάλογα με τα στοιχεία της μελέτης. Αυτές οι θέσεις εμφανίζονται με 
		μια χαρακτηριστική λέξη σε αγκύλες. Αυτές οι θέσεις είναι προκαθορισμένες και δεν χρειάζεται να τις αλλάξετε. <br/><br/>
		Επίσης σε κάθε μελέτη δημιουργείται αυτόματα το τελικό τεύχος ως εξής: Προστίθενται στο πρότυπο τεύχος της μελέτης στις προκαθορισμένες θέσεις όλα τα 
		στοιχεία, δημιουργείται το τελικό κείμενο και αποθηκεύεται. Κάθε φορά που κάνετε κάποια αλλαγή σε άλλο σημείο του λογισμικού (πχ αλλάξετε κάποιο δομικό 
		στοιχείο) θα πρέπει να επαναδημιουργήσετε το τεύχος ώστε στις προκαθορισμένες θέσεις να εμφανιστούν και τα νέα στοιχεία. <br/><br/>
		Σε οποιαδήποτε χρονική στιγμή μπορείτε να αποθηκεύσετε το τελικό τεύχος.
		</div>
		<div class="alert alert-error">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Προσοχή!</h4>
		Πατώντας στο κουμπί "Δημιουργία από πρότυπο" το τελικό τεύχος επαναδημιουργείται ξανά από το πρότυπο 
		τεύχος επαναυπολογίζοντας ξανά σε αυτό όλα τα στοιχεία της μελέτης σας. Εάν θέλετε μπορείτε να επαναφέρετε το πρότυπο τεύχος στην αρχική του μορφή. 
		</div>
	</p>
	</div>
	<div class="modal-footer">
	<button class="btn" data-dismiss="modal" aria-hidden="true">OK</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό ΤΕΥΧΟΣ για εμφάνιση ######################### -->

<!-- ######################### Κρυφό ΠΡΟΤΥΠΟ για εμφάνιση ######################### -->			
<div id="protypo_popup" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">	
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h6 id="myModalLabel">Πρότυπο τεύχος μελέτης</h6>
	</div>
	
	<div class="modal-body">
		<div class="tabbable tabs-left">
			<ul class="nav nav-pills">
			<?php
			for($i=1;$i<=8;$i++){
				if($i==1){
				echo "<li class=\"active\"><a href=\"#protypo".$i."\" data-toggle=\"tab\">Κεφ. ".$i."</a></li>";
				}else{
				echo "<li><a href=\"#protypo".$i."\" data-toggle=\"tab\">Κεφ. ".$i."</a></li>";
				}
			}
			?>
			</ul>
			<div class="tab-content">
				<?php
				for($i=1;$i<=8;$i++){
					if($i==1){
						echo "<div class=\"tab-pane active\" id=\"protypo".$i."\">";
					}else{
						echo "<div class=\"tab-pane\" id=\"protypo".$i."\">";
					}					
				echo "<div id=\"container\" style=\"background:#eee;border:1px solid #000000;padding:3px;width:99%;height:610px;\">";
				echo "<textarea name=\"text_p_kef".$i."\" id=\"text_p_kef".$i."\" >".$protypo["kef".$i]."</textarea>";
				echo "<script type=\"text/javascript\">CKEDITOR.replace('text_p_kef".$i."');</script>";
				echo "</div>";
				//echo $i;
				echo "</div>";
				}
				?>
			</div>	
		</div>
	</div>
	
	<div class="modal-footer">
	<button class="btn btn-warning" data-dismiss="modal" aria-hidden="true" onclick="recreate_protypo();">Επαναφορά</button>
	<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true" onclick="save_protypo();">Αποθήκευση</button>
	<button class="btn" data-dismiss="modal" aria-hidden="true">Κλείσιμο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό ΠΡΟΤΥΠΟ για εμφάνιση ######################### -->
			<script>
			function print_teyxos(){
				var i;
				var html="";
				var x=window.open('','','width=600, height=600');
				html += "<html>";
				html += "<head>";
				html += '<link type="text/css" rel="stylesheet" href="javascripts/bootstrap3/css/bootstrap.css" >';
				html += "</head>";
				html += "<body>";
				for(i=1; i<=8; i++){
					html += document.getElementById("text_kef"+i).value;
				}
				html += "</body>";
				html += "</html>";
				x.document.open().write( html );
				x.focus();
				x.print();
			}

			function show_protypo(){
			$('#protypo_popup').modal('show');
			modal_height();
			}
			function modal_height(){
				//var y = $(window).height()-250;
				//var styles = {'max-height': y};
				//$(document).find('.modal-body').css(styles);
			}
			
			function update_teyxos(){
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/update_teyxos.php?updateteyxos=1" ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById('wait').style.display="none";
					//alert("teyxos updated");
					window.location.reload();
				}}
			}
			
			function recreate_protypo(){
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/update_teyxos.php?recreateprotypo=1" ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById('wait').style.display="none";
					//alert("protypo recreated");
					window.location.reload();
				}}
			}
			
			function save_protypo(){
				document.getElementById('wait').style.display="inline";
			
			var kef1 = "&kef1="+encodeURIComponent(CKEDITOR.instances.text_p_kef1.getData());
			var kef2 = "&kef2="+encodeURIComponent(CKEDITOR.instances.text_p_kef2.getData());
			var kef3 = "&kef3="+encodeURIComponent(CKEDITOR.instances.text_p_kef3.getData());
			var kef4 = "&kef4="+encodeURIComponent(CKEDITOR.instances.text_p_kef4.getData());
			var kef5 = "&kef5="+encodeURIComponent(CKEDITOR.instances.text_p_kef5.getData());
			var kef6 = "&kef6="+encodeURIComponent(CKEDITOR.instances.text_p_kef6.getData());
			var kef7 = "&kef7="+encodeURIComponent(CKEDITOR.instances.text_p_kef7.getData());
			var kef8 = "&kef8="+encodeURIComponent(CKEDITOR.instances.text_p_kef8.getData());
			var s = "saveprotypo=1";
			
			//AJAX call
			var xmlhttp=new XMLHttpRequest();
			var link = "includes/update_teyxos.php";
			xmlhttp.open("POST",link ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send(s+kef1+kef2+kef3+kef4+kef5+kef6+kef7+kef8);
			
			xmlhttp.onreadystatechange=function()  {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById('wait').style.display="none";
			}}
			}
			
			function save_teyxos(){
				document.getElementById('wait').style.display="inline";
			
			var kef1 = "&kef1="+encodeURIComponent(CKEDITOR.instances.text_kef1.getData());
			var kef2 = "&kef2="+encodeURIComponent(CKEDITOR.instances.text_kef2.getData());
			var kef3 = "&kef3="+encodeURIComponent(CKEDITOR.instances.text_kef3.getData());
			var kef4 = "&kef4="+encodeURIComponent(CKEDITOR.instances.text_kef4.getData());
			var kef5 = "&kef5="+encodeURIComponent(CKEDITOR.instances.text_kef5.getData());
			var kef6 = "&kef6="+encodeURIComponent(CKEDITOR.instances.text_kef6.getData());
			var kef7 = "&kef7="+encodeURIComponent(CKEDITOR.instances.text_kef7.getData());
			var kef8 = "&kef8="+encodeURIComponent(CKEDITOR.instances.text_kef8.getData());
			var s = "saveteyxos=1";
			
			//AJAX call
			var xmlhttp=new XMLHttpRequest();
			var link = "includes/update_teyxos.php";
			xmlhttp.open("POST",link ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send(s+kef1+kef2+kef3+kef4+kef5+kef6+kef7+kef8);
			
			xmlhttp.onreadystatechange=function()  {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById('wait').style.display="none";
				document.getElementById('info').innerHTML=xmlhttp.responseText;
			}}
			}
			</script>
		
		</div>
					</div><!--tab content-->
				</div><!--tabs-->
			</div><!--col-md-10-->
		</div>
		 <!-- /.row (main row) -->
		 <?php
			}else{//έχει οριστεί να μην φαίνεται το τεύχος στις γενικές ρυθμίσεις
		?>
			
			<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Προσοχή!</h4>
			Ο διαχειριστής του λογισμικού έχει απενεργοποιήσει την παραγωγή τεύχους. :( <br/>
			Αυτό συνήθως είναι μια φυσιολογική συμπεριφορά όταν αλλάζει το πρότυπο τεύχος για όλους τους χρήστες ώστε να μην δημιουργηθούν προβλήματα. 
			</div>
			
		<?php
			}
		?>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
