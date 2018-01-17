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
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
	<h1>
	La-kenak
	<small>Έντυπα</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-edit"></i> Μελέτη ΚΕΝΑΚ</a></li>
	<li class="active"> Έντυπα</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
	
				<div class="col-md-2">
				<br/><br/>
				<button class="btn btn-solar" onclick="update_entypa();">Δημιουργία από πρότυπα</button>
				<br/><br/>
			    <div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Έντυπα</h4>
				Οποιαδήποτε στιγμή σας ικανοποιεί το αποτέλεσμα μπορείτε να τυπώσετε τα έντυπα πατώντας στο πλήκτρο 
				"Εκτύπωση" ή "Προεπισκόπηση".
				</div>
				<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Προσοχή!</h4>
				Πατώντας στο κουμπί "Δημιουργία από πρότυπα" τα έντυπα επαναδημιουργείται ξανά από τα πρότυπα 
				έντυπα προσθέτοντας σε αυτά όλα τα στοιχεία της μελέτης σας. Όσες αλλαγές πραγματοποιήσατε στα 
				έντυπα πριν από αυτή την ενέργεια θα χαθούν και θα ξεκινήσετε να επεξεργάζεστε τα έντυπα από 
				την αρχή.
				</div>
		</div>
		
		<div class="col-md-10">
		
		<?php
		
		$database = new medoo(DB_NAME);
		$table = "meletes_entypa";
		$protypo_table = "vivliothiki_entypa";
		$db_columns = "*";
		$where_parameters = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
		
		//Μέτρηση γραμμών με τα έντυπα
		$count = $database->count($table, $where_parameters);
		
		//εάν δεν υπάρχουν οι γραμμές των εντύπων για τη μελέτη->δημιουργία
		if($count==0){
		update_meleti_entypa();
		}
		
		//Επιλογή των αποθηκευμένων εντύπων
		$entypa = $database->select($table,$db_columns,$where_parameters);
		$entypa = $entypa[0];
		?>
		
		
			<div class="nav-tabs-custom">
			<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>
				<ul class="nav nav-tabs">
			<?php
			
				for($i=1;$i<=3;$i++){
					if($i==1){$tab_name="<i class=\"fa fa-folder-o\"></i> Φάκελος</span></a>";}
					if($i==2){$tab_name="<i class=\"fa fa-file-text\"></i> Συμφωνητικό</a>";}
					if($i==3){$tab_name="<i class=\"fa fa-file-text\"></i> Εξοικονομώ</a>";}
					if($i==1){$li_class="class=\"active\"";}else{$li_class="";}
					echo "<li ".$li_class."><a href=\"#entypo-".$i."\"  data-toggle=\"tab\">".$tab_name."</a></li>";
				}
				echo "</ul>";
				
				echo "<div class=\"tab-content\">";
				for($i=1;$i<=3;$i++){
					if($i==1){$div_class="class=\"tab-pane active\"";}else{$div_class="class=\"tab-pane\"";}
				echo "<div ".$div_class." id=\"entypo-".$i."\">";
				echo "<div id=\"container\" style=\"background:#eee;border:1px solid #000000;padding:3px;width:99%;height:610px;\">";
				echo "<textarea name=\"text_entypo".$i."\" id=\"text_entypo".$i."\" >".$entypa["entypo".$i]."</textarea>";
				echo "<script type=\"text/javascript\">CKEDITOR.replace('text_entypo".$i."');</script>";
				echo "</div></div>";
				}
			?>	
				<button type="submit" name="submit" value="save-entypa" class="btn btn-primary" onclick="save_entypa();">Αποθήκευση</button>
				<div id="info"></div>
				
			<br/><br/>
			</div><!--tab-content-->
			</div><!--tabs-->
			
			
			<script>
			function update_entypa(){
				document.getElementById('wait').style.display="inline";
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/update_entypa.php?updateentypa=1" ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById('wait').style.display="none";
					//alert("entypa updated");
					window.location.reload();
				}}
			}
			
			function save_entypa(){
				document.getElementById('wait').style.display="inline";
			
			var entypo1 = "&entypo1="+encodeURIComponent(CKEDITOR.instances.text_entypo1.getData());
			var entypo2 = "&entypo2="+encodeURIComponent(CKEDITOR.instances.text_entypo2.getData());
			var entypo3 = "&entypo3="+encodeURIComponent(CKEDITOR.instances.text_entypo3.getData());
			var s = "saveentypa=1";
			
			//AJAX call
			var xmlhttp=new XMLHttpRequest();
			var link = "includes/update_entypa.php";
			xmlhttp.open("POST",link ,true);
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send(s+entypo1+entypo2+entypo3);
			
			xmlhttp.onreadystatechange=function()  {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById('wait').style.display="none";
				document.getElementById('info').innerHTML=xmlhttp.responseText;
				}
			}
			}
			</script>
					</div><!--tab content-->
				</div><!--tabs-->
			</div><!--col-md-10-->
		</div>
		 <!-- /.row (main row) -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->