<?php
/*
Copyright (C) 2013 - Labros Asfaleia v.1.0 beta
Author: Labros Karoyntzos 

Labros Asfaleia v.1.0 beta from Labros Karountzos is free software: 
you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, version 3 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License version 3
along with this program.  If not, see http://www.gnu.org/licenses/gpl-3.0.html.

Το παρόν με την ονομασία Labros Asfaleia v.1.0 beta με δημιουργό τον Λάμπρο Καρούντζο
στοιχεία επικοινωνίας info@chem-lab.gr www.chem-lab.gr
είναι δωρεάν λογισμικό. Μπορείτε να το τροποποιήσετε και επαναδιανείμετε υπό τους
όρους της άδειας GNU General Public License όπως δίδεται από το Free Software Foundation
στην έκδοση 3 αυτής της άδειας.
Το παρόν σχόλιο πρέπει να παραμένει ως έχει ώστε να τηρείται η παραπάνω άδεια κατά τη διανομή.
*/
//error_reporting(E_ALL);
require("include_check.php");
confirm_logged_in();
confirm_meleti_isset();

	$database = new medoo(DB_NAME);
	$admin_prefs = $database->select("core_preferences","*",array("id" => "1"));
	$admin_menu_xml = $admin_prefs[0]["menu_xml"];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
	<h1>
	La-kenak
	<small>Παραγωγή XML</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-edit"></i> Μελέτη ΚΕΝΑΚ</a></li>
	<li class="active"> Παραγωγή XML</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
<?php
	if($admin_menu_xml!=0){//Έχει οριστεί να φαίνεται το μενού XML στις γενικές ρυθμίσεις
?>
<!-- Main row -->
<div class="row">
	
		<div class="col-md-2">

			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>XML</h4>
				Παραγωγή αρχείου xml για ΤΕΕ ΚΕΝΑΚ <?php echo VERSION_ΤΕΕ; ?> .
			</div>
			
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Εργαλεία XML</h4>
				Βοηθητικά εργαλεία προβολής ενός xml και εξαγωγής σεναρίου ως νέο xml.
			</div>
		</div>
		
		<div class="col-md-10">
		<div id='wait' style="display:none;position:absolute;top:130px;left:500px;z-index:9999;"><img src="images/interface/ajax-loader.gif"></div>
			<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs-1" data-toggle="tab"><i class="fa fa-file-code-o"></i> Παραγωγή XML</a></li>
					<li><a href="#tabs-2" data-toggle="tab"><i class="fa fa-eye"></i> Προβολή XML</a></li>
					<li><a href="#tabs-3" data-toggle="tab"><i class="fa fa-random"></i> Εξαγωγή σεναρίου</a></li>
					<li><a href="#tabs-4" data-toggle="tab"><i class="fa fa-reorder"></i> Αλλαγή σεναρίων</a></li>
					<li><a href="#tabs-5" data-toggle="tab"><i class="fa fa-file-archive-o"></i> zip Σκαριφημάτων</a></li>
				</ul>
			
		<!-- ########################## XML TEE KENAK ################################# -->
		<div class="tab-content">
			<div class="tab-pane active" id="tabs-1">
			<br/>
			<img src="images/interface/filetypes/xml-tee-kenak.png">
			<button type="submit" class="btn btn-znx" onclick=save_teexml();>
				<i class="fa fa-file-code-o"></i> Παραγωγή xml (tee kenak)
			</button>
			<br/><br/>
			<div id="txt_xmlteekenak"></div>
		</div><!--tabs-1-->
<script>						
function save_teexml(){

	document.getElementById('wait').style.display="inline";
	var link="includes/functions_xml.php?save_teexml=1";
	//AJAX call
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open('GET', link, true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById('wait').style.display="none";
			document.getElementById('txt_xmlteekenak').innerHTML = xmlhttp.responseText;
		}
	}
}
</script>
			
		<!-- ########################## XML TEE KENAK ################################# -->
		
		
		<!--tabs2-->
		<div class="tab-pane" id="tabs-2">
			<br/>
			<div class="form-group">
				<label for="teexmlfile">Αρχείο για προβολή...</label>
				<input type="file" id="teexmlfile">
				<p class="help-block">Επιτρέπονται μόνο xml. Δείτε τα περιεχόμενα ενός xml πινακοποιημένα (υπό κατασκευή).</p>
			</div>
			<button type="submit" class="btn btn-znx" onclick=read_teexml();><i class="fa fa-file-code-o"></i> Ανάγνωση τιμών αρχείου</button>
			<hr>
			<div id="txt_xmlsenario"></div>
<script>						
function read_teexml(){

document.getElementById('wait').style.display="inline";
var link="includes/functions_xml.php?read_teexml=1";
//AJAX call
	var fileInput = document.getElementById('teexmlfile');
	var file = fileInput.files[0];
	var formData = new FormData();
	formData.append('file', file);
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open('POST', link, true);
	xmlhttp.send(formData);
	
	xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById('wait').style.display="none";
			document.getElementById('txt_xmlsenario').innerHTML = xmlhttp.responseText;
		}
	}
}
</script>
			</div><!--tab-->
				
				
			<div class="tab-pane" id="tabs-3"><!--tab-->
				<br/>
				<div class="form-group">
					<label for="teexmlfile1">Αρχείο προς εξαγωγή...</label>
					<input type="file" id="teexmlfile1">
					<p class="help-block">Επιτρέπονται μόνο xml. Σε ένα xml με το υπάρχον κτίριο και 3 σενάρια. Σώζει ένα νέο xml 
					με υπάρχον κτίριο το επιλεγμένο σενάριο. (Ισχύει για 10Ζώνες, 10ΜΘΧ, 10Ηλιακούς χώρους)</p>
				</div>
				<div class="input-group">
					<span class="input-group-addon">Σενάριο προς εξαγωγή</span>
					<select class="form-control" id="teexmlfile1_senario">
					<option value=0></option>
					<option value=1>Υπάρχον</option>
					<option value=2>Σενάριο 1</option>
					<option value=3>Σενάριο 2</option>
					<option value=4>Σενάριο 3</option>
					</select>
				</div>
				<br/><br/>
				<button type="submit" class="btn btn-znx" onclick=export_senario();><i class="fa fa-file-code-o"></i> Εξαγωγή xml σεναρίου</button>
				<hr>
				<div id="xml_fulltxt1"></div>
						
<script>						
function export_senario(){

document.getElementById('wait').style.display="inline";
//AJAX call
	var bldrid = document.getElementById('teexmlfile1_senario').value;
	var fileInput = document.getElementById('teexmlfile1');
	var file = fileInput.files[0];
	var formData = new FormData();
	formData.append('file', file);
	
	var link="includes/functions_xml.php?export_senario=1&bldrid="+bldrid;
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open('POST', link, true);
	xmlhttp.send(formData);
	
	xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById('wait').style.display="none";
			document.getElementById('xml_fulltxt1').innerHTML = xmlhttp.responseText;
		}
	}
}
</script>
			</div><!--tabs-3-->
			
			<div class="tab-pane" id="tabs-4"><!--tab-->
				<br/>
				<div class="form-group">
					<label for="teexmlfile2">Αρχείο προς ταξινόμηση...</label>
					<input type="file" id="teexmlfile2">
					<p class="help-block">Επιτρέπονται μόνο xml. Σε ένα xml αλλάζει σειρά στα σενάρια 
					(Ισχύει για 10Ζώνες, 10ΜΘΧ, 10Ηλιακούς χώρους)</p>
				</div>
				<div class="input-group">
					<span class="input-group-addon">Σενάριο 1</span>
					<select class="form-control" id="teexmlfile2_senario1">
					<option value=0></option>
					<option value=2>1ο</option>
					<option value=3>2ο</option>
					<option value=4>3ο</option>
					</select>
				</div>
				<div class="input-group">
					<span class="input-group-addon">Σενάριο 2</span>
					<select class="form-control" id="teexmlfile2_senario2">
					<option value=0></option>
					<option value=2>1ο</option>
					<option value=3>2ο</option>
					<option value=4>3ο</option>
					</select>
				</div>
				<div class="input-group">
					<span class="input-group-addon">Σενάριο 3</span>
					<select class="form-control" id="teexmlfile2_senario3">
					<option value=0></option>
					<option value=2>1ο</option>
					<option value=3>2ο</option>
					<option value=4>3ο</option>
					</select>
				</div>
				<br/><br/>
				<button type="submit" class="btn btn-znx" onclick=reorder_senario();><i class="fa fa-file-code-o"></i> Εξαγωγή διορθωμένου xml</button>
				<hr>
				<div id="xml_fulltxt2"></div>
			</div><!--tab-->
						
<script>						
function reorder_senario(){

document.getElementById('wait').style.display="inline";
//AJAX call
	var bld2rid = document.getElementById('teexmlfile2_senario1').value;
	var bld3rid = document.getElementById('teexmlfile2_senario2').value;
	var bld4rid = document.getElementById('teexmlfile2_senario3').value;
	var fileInput = document.getElementById('teexmlfile2');
	var file = fileInput.files[0];
	var formData = new FormData();
	formData.append('file', file);
	
	var link="includes/functions_xml.php?reorder_senario=1&bld2rid="+bld2rid+"&bld3rid="+bld3rid+"&bld4rid="+bld4rid;
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open('POST', link, true);
	xmlhttp.send(formData);
	
	xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById('wait').style.display="none";
			document.getElementById('xml_fulltxt2').innerHTML = xmlhttp.responseText;
		}
	}
}
</script>
			
			<div class="tab-pane" id="tabs-5"><!--tab-->
				<br/><br/>
				Μεταβείτε πρώτα στη σχεδίαση ώστε να δημιουργηθούν οι εικόνες στο φάκελο χρήστη. 
				Εάν έχετε δει τις εικόνες και σας ικανοποιούν πατήστε παραγωγή σκαριφημάτων. 
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
				
			</div><!--tabs-5-->
			
					</div><!--tab content-->
				</div><!--tabs-->
			</div><!--col-md-10-->
		</div>
		 <!-- /.row (main row) -->
		 <?php
			}else{//έχει οριστεί να μην φαίνεται το μενού xml στις γενικές ρυθμίσεις
		?>
			
			<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Προσοχή!</h4>
			Ο διαχειριστής του λογισμικού έχει απενεργοποιήσει το μενού εργαλείων XML. :( <br/>
			Αυτό συνήθως είναι μια φυσιολογική συμπεριφορά όταν αλλάζει ή διορθώνεται η παραγωγή XML ώστε να μην κατεβάσετε κάτι λάθος. 
			</div>
			
		<?php
			}
		?>
	</section>
	<!-- /.content -->
<script>
	$("input").alphanum({
		allow:  '-_.?=/@:',
		disallow:  ','}
	);	
</script>
</div>
<!-- /.content-wrapper -->