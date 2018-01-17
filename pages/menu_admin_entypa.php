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
if(confirm_admin()){
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
	<h1>
	La-kenak
	<small>Διαχειριστής</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-black-tie"></i> Διαχειριστής</a></li>
	<li class="active">Έντυπα</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- Main row -->
<div class="row">

	<div class="col-md-2">
		<button type="submit" name="submit" value="save-protypo" class="btn btn-default" onclick=save_entypa();>Αποθήκευση εντύπων</button>

	<br/><br/>
	<div class="alert alert-znx">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Προσοχή!</h4>
		Τα έντυπα χρησιμοποιούνται από όλους τους χρήστες σε όλες τις μελέτες τους.
	</div>
	<div id="info"></div>
	
	</div>
	
	<div class="col-md-10">
	<?php
	$database = new medoo(DB_NAME);
	$protypo_table = "vivliothiki_entypa";
	$db_columns = "*";
	$select_entypa = $database->select($protypo_table,$db_columns);
	?>
		<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>
		
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
		<?php
		$i=1;
		foreach($select_entypa as $entypo){
			if($entypo["entypo"]==1){$tab_name="<i class=\"fa fa-folder-o\"></i> Φάκελος";}
			if($entypo["entypo"]==2){$tab_name="<i class=\"fa fa-file-text\"></i> Συμφωνητικό";}
			if($entypo["entypo"]==3){$tab_name="<i class=\"fa fa-file-text\"></i> Εξοικονομώ";}
			if($i==1){$class=" class=\"active\"";}else{$class="";}
		echo "<li".$class."><a href=\"#entypo-".$entypo["entypo"]."\" data-toggle=\"tab\">".$tab_name."</a></li>";
		$i++;
		}
		echo "</ul>";
		echo "<form id=\"form_entypa\" action=\"\" method=\"post\">";
		echo "<div class=\"tab-content\">";
		
		$i=1;
		foreach($select_entypa as $entypo){
			if($i==1){$class=" active";}else{$class="";}
			echo "<div class=\"tab-pane".$class."\"  id=\"entypo-".$entypo["entypo"]."\">";
			echo "<br/><div id=\"container\" style=\"background:#eee;border:1px solid #000000;padding:3px;width:98%;height:610px;\">";
			echo "<textarea name=\"text_entypo".$entypo["entypo"]."\" id=\"text_entypo".$entypo["entypo"]."\" >".$entypo["text"]."</textarea>";
			echo "<script type=\"text/javascript\">CKEDITOR.replace('text_entypo".$entypo["entypo"]."');</script>";
			echo "</div>";//container
			echo "</div>";//tab
		$i++;
		}
		
	?>
	
	<script>
	function save_entypa(){
		document.getElementById('wait').style.display="inline";
		
		var entypo1 = "&entypo1="+encodeURIComponent(CKEDITOR.instances.text_entypo1.getData());
		var entypo2 = "&entypo2="+encodeURIComponent(CKEDITOR.instances.text_entypo2.getData());
		var entypo3 = "&entypo3="+encodeURIComponent(CKEDITOR.instances.text_entypo3.getData());
		var s = "savepentypa=1";
		
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		var link = "includes/functions_admin.php";
		xmlhttp.open("POST",link ,true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(s+entypo1+entypo2+entypo3);
		
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById('info').innerHTML=xmlhttp.responseText;
			document.getElementById('wait').style.display="none";
		}}
	}
	</script>
	
	</div>
	<!--/tab-content-->
	</form>
		
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
<?php
}
?>