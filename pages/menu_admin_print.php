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
confirm_admin();
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
		<button type="submit" name="submit" value="save-protypo" class="btn btn-default" onclick=save_protypo();>Αποθήκευση Προτύπου</button>

	<br/><br/>
	<div class="alert alert-znx">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Προσοχή!</h4>
		Το τεύχος αυτό χρησιμοποιείται από όλους τους χρήστες σε όλες τις μελέτες τους.
	</div>
	<div id="info"></div>
	
	</div>
	
	<div class="col-md-10">
	<?php
	$database = new medoo(DB_NAME);
	$protypo_table = "vivliothiki_teyxos";
	$db_columns = "*";
	$select_protypo = $database->select($protypo_table,$db_columns);
	?>
		<div class="nav-tabs-custom">
		<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>
		<ul class="nav nav-tabs">
		<?php
		
		$i=1;
		foreach($select_protypo as $teyxos){
			if($i==1){$class=" class=\"active\"";}else{$class="";}
			echo "<li".$class."><a href=\"#kefalaio-".$teyxos["kefalaio"]."\" data-toggle=\"tab\">Κεφ. ".$teyxos["kefalaio"]."</a></li>";
		$i++;
		}
		echo "</ul>";
		echo "<form id=\"form_kefalaia\" action=\"\" method=\"post\">";
		echo "<div class=\"tab-content\">";
		
		$i=1;
		foreach($select_protypo as $teyxos){
			if($i==1){$class=" active";}else{$class="";}
			echo "<div class=\"tab-pane".$class."\"  id=\"kefalaio-".$teyxos["kefalaio"]."\">";
			echo "<br/><div id=\"container\" style=\"background:#eee;border:1px solid #000000;padding:3px;width:98%;height:610px;\">";
			echo "<textarea name=\"text_kef".$teyxos["kefalaio"]."\" id=\"text_kef".$teyxos["kefalaio"]."\" >".$teyxos["text"]."</textarea>";
			echo "<script type=\"text/javascript\">CKEDITOR.replace('text_kef".$teyxos["kefalaio"]."');</script>";
			echo "</div>";//container
			echo "</div>";//tab
		$i++;
		}
		
	?>
	
	<script>
	function save_protypo(){
		document.getElementById('wait').style.display="inline";
		
		var kef1 = "&kef1="+encodeURIComponent(CKEDITOR.instances.text_kef1.getData());
		var kef2 = "&kef2="+encodeURIComponent(CKEDITOR.instances.text_kef2.getData());
		var kef3 = "&kef3="+encodeURIComponent(CKEDITOR.instances.text_kef3.getData());
		var kef4 = "&kef4="+encodeURIComponent(CKEDITOR.instances.text_kef4.getData());
		var kef5 = "&kef5="+encodeURIComponent(CKEDITOR.instances.text_kef5.getData());
		var kef6 = "&kef6="+encodeURIComponent(CKEDITOR.instances.text_kef6.getData());
		var kef7 = "&kef7="+encodeURIComponent(CKEDITOR.instances.text_kef7.getData());
		var kef8 = "&kef8="+encodeURIComponent(CKEDITOR.instances.text_kef8.getData());
		var s = "saveprotypo=1";
		
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		var link = "includes/functions_admin.php";
		xmlhttp.open("POST",link ,true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(s+kef1+kef2+kef3+kef4+kef5+kef6+kef7+kef8);
		
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
