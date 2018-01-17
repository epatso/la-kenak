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
	<small>U Αδιαφανών</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li class="active"> U Αδιαφανών</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
	<div class="col-md-2">	
		<?php
		if(logged_in()){
		?>
		    <div class="btn-group">
			<button class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			<span class="fa fa-download"></span>  Ενέργειες χρήστη 
			<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" role="menu">
			<li><a tabindex="-1" href="#save_popup" data-toggle="modal" onclick=adiafani_find();><i class="fa fa-download"></i> Αποθήκευση</a></li>
			<li><a tabindex="-1" href="#open_popup" data-toggle="modal" onclick=adiafani_makeselect();><i class="fa fa-upload"></i> Ανάκτηση</a></li>
			<li><a tabindex="-1" href="#" onclick=adiafani_clear();><i class="fa fa-file-o"></i> Νέος Υπολογισμός</a></li>
			<li><a tabindex="-1" href="#" onclick=showgraph(1); ><i class="fa fa-file-pdf-o"></i> Δημιουργία PDF</a></li>
			<li><a tabindex="-1" href="#help_popup" data-toggle="modal"><i class="fa fa-question"></i> Βοήθεια</a></li>
			</ul>
			</div>
		<?php
		}
		?>	
			
			
		<br/><br/>
			<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Βοήθεια</h4>
			<ul>
			<li>Δώστε όνομα στο δομικό στοιχείο και επιλέξτε κλιματική ζώνη</li>
			<li>Eπιλέξτε έως 10 στρώσεις υλικών</li>
			<li>επιλέξτε αντιστάσεις θερμικής μετάβασης</li>
			</ul>
			<br/>
			Ο συντελεστής θερμοπερατότητας (U) και το σκαρίφημα δημιουργούνται αυτόματα. 
			<br/><br/>
			Οι επιλογές αποθήκευσης, εκτύπωσης και βοήθειας δεν επηρρεάζουν την σελίδα. 
			Ανοίγουν σε νέο παράθυρο/καρτέλα.<br/>
			Τα αρχεία pdf κατά την εκτύπωση δημιουργούνται στο φάκελο /PDF/{Όνομα χρήστη}/ της διανομής.
			</div>

	</div>


<!-- ###################### Κρυφό help_popup για εμφάνιση ###################### -->
<div id="help_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h5 id="myModalLabel">
		<?php
		echo APPLICATION_NAME." - v.".APPLICATION_VERSION." - Βοήθεια (Αδιαφανή)";
		?>
		</h5>
	</div>
	<div class="modal-body">
		<p>
		<strong>Υπολογισμός U Δομικών Στοιχείων</strong><hr/>
		Στη σελίδα αυτή γίνονται οι υπολογισμοί της θερμοπερατότητας τοίχων, δαπέδων και οροφών.<br/> 
		<ul>
		<li>Επιλέξτε για κάθε στρώση πρώτα την κατηγορία (είδος) της στρώσης και έπειτα το υλικό (τύπο) της στρώσης.</li>
		<li>Συμπληρώνοντας τα πάχη (σε μέτρα) των στρώσεων, το πρόγραμμα εκτελεί τους απαραίτητους υπολογισμούς.</li>
		<li>Για να υπολογιστεί το U πρέπει να επιλεγούν τουλάχιστον οι συντελεστές θερμικής μετάβασης.</li>
		<li>Είναι δυνατή επίσης η επιλογή τυχόν κεραμοσκεπής πάνω από μονωμένη οροφή καθώς και κενού στρώματος αέρα.</li>
		</ul>
		<hr />
		<ul>
		<li>Με το πλήκτρο (ανάκτηση) ανακτούνται από το αρχείο τα στοιχεία του δομικού στοιχείου που θα επιλεγεί στο παράθυρο που ανοίγει.</li>
		<li>Με το πλήκτρο (αποθήκευση) αποθηκεύονται οι αλλαγές που ενδεχομένως έγιναν στο στοιχείο.</li>
		<li>Με το πλήκτρο (εκτύπωση) δημιουργείται αρχείο PDF με τους υπολογισμούς και το σκαρίφημα του δομικού στοιχείου.</li>
		</ul>
		</p>
	</div>
	<div class="modal-footer">
	<button class="btn" data-dismiss="modal" aria-hidden="true">Κλείσιμο</button>
	</div>
</div>
</div>
</div>
<!-- ###################### Κρυφό help_popup για εμφάνιση ###################### -->

<!-- ###################### Κρυφό save_popup για εμφάνιση ###################### -->
<div id="save_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick=save_close();>×</button>
	<h5 id="myModalLabel">
	<?php
	echo APPLICATION_NAME." - v.".APPLICATION_VERSION." - Αποθήκευση-Επεξεργασία (Αδιαφανή)";
	?>
	</h5>
	</div>
	<div class="modal-body">
	<p>
	<strong><span id="save_found"></span></strong><br/>
	<blockquote><small>
	Μετά την επιτυχή αποθήκευση ο υπολογισμός είναι διαθέσιμος στις βιβλιοθήκες χρήστη και μπορείτε να τον ανακτήσετε από το μενού χρήστη 
	ή από το μενού ανάκτηση αυτού του υπολογισμού. Μπορείτε να διαγράψετε τον υπολογισμό μόνο από τις βιβλιοθήκες χρήστη. 
	</small></blockquote>
	<span id="save_alert"></span>
	</p>
	</div>
	<div class="modal-footer">
	<button class="btn" data-dismiss="modal" aria-hidden="true" onclick=save_close();>Κλείσιμο</button>
	<button class="btn btn-primary" id="save_button" onclick=adiafani_save();><div id="save_btn_txt"></div></button>
	</div>
</div>
</div>
</div>
<!-- ###################### Κρυφό save_popup για εμφάνιση ###################### -->

<!-- ###################### Κρυφό open_popup για εμφάνιση ###################### -->
<div id="open_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick=load_close();>×</button>
	<h5 id="myModalLabel">
	<?php
	echo APPLICATION_NAME." - v.".APPLICATION_VERSION." - Ανάκτηση (Αδιαφανή)";
	?>
	</h5>
	</div>
	<div class="modal-body">
	<p>
	<strong><span id="load_found"></span></strong><br/>
	Επιλέξτε το στοιχείο που θέλετε να ανακτήσετε:<br/><br/>
	<select class="form-control" id="load_select" name="load_select">
	<option value=0></option>
	</select>
	<span id="load_alert"></span>
	<blockquote><small>
	ΠΡΟΣΟΧΗ: Κατά την ανάκτηση στα κελιά του υπολογισμού φορτώνουν νέα στοιχεία αντικαθιστώντας ότι έχετε προσθέσει μέχρι αυτό το σημείο.
	</small></blockquote>
	</p>
	</div>
	<div class="modal-footer">
	<button class="btn" data-dismiss="modal" aria-hidden="true" onclick=load_close();>Κλείσιμο</button>
	<button class="btn btn-primary" id="load_button" onclick=adiafani_load();>Ανάκτηση</button>
	</div>
</div>
</div>	
</div>
<!-- ###################### Κρυφό open_popup για εμφάνιση ###################### -->

	
	<div class="col-md-10">
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab"><i class="fa fa-leaf"></i> Αδιαφανή δομικά στοιχεία</a></li>
		</ul>
		<div class="tab-content">
			<!--tab-->
			<div class="tab-pane active" id="tabs-1">
					
					<form class="form-inline has-success" role="form">
					<input type="hidden" class="form-control" id="calcu_id" disabled="disabled" />
					<div class="input-group">
						<span class="input-group-addon">Όνομα</span>
						<input type="text" class="form-control" placeholder="Όνομα δομικού στοιχείου" id="calcu_name" size="70" />
					</div>
					<div class="input-group">
						<span class="input-group-addon">Ζώνη</span>
						<select class="form-control input-sm" id="calcu_zwni" onchange=get_umax(); >
							<option value=0>Α</option>
							<option value=1>Β</option>
							<option value=2>Γ</option>
							<option value=3>Δ</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">Τύπος</span>
						<select class="form-control input-sm" id="calcu_type" onchange=get_umax();>
							<option value=1>Νέο</option>
							<option value=2>Ριζική ανακαίνιση</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon">Umax</span>
						<input type="text" class="form-control input-sm" id="calcu_umax" disabled="disabled"/>
						<span class="input-group-addon">W/m2</span>
					</div>
					</form>
					
					<br/>
						
					<table class="table table-condensed">
						<tr bgcolor="#e35f8f">
						<td style="text-align:center;width:5%;">A/A</td>
						<td style="text-align:center;width:7%;">Πάχος (m)</td>
						<td style="text-align:center;width:20%;">Κατηγορία</td>
						<td style="text-align:center;width:25%">Υποκατηγορία</td>
						<td style="text-align:center;width:23%">Tύπος στρώσης</td>
						<td style="text-align:center;width:10%">Συντ. λ</td>
						<td style="text-align:center;width:10%">d/λ</td>
						</tr>
						<tr bgcolor="#e7769f"><td style="text-align:center;" colspan="7">Θέση - (Τοίχοι/Δάπεδα:ΜΕΣΑ , Οροφές: ΕΞΩ)</td>
						
						<?php 
						for ($i = 1; $i <= 10; $i++) {
						?>
						<tr bgcolor="#f7d1df">
							<td style="text-align:center;"><?php echo $i; ?></td>
							<td style="text-align:center;">
								<input class="form-control input-sm" type="text" style="text-align:center;" id="paxos<?php echo $i; ?>" value="" onkeyup=getcl(<?php echo $i; ?>) />
							</td>
							<td style="text-align:center;">
								<select class="form-control input-sm" id="category<?php echo $i; ?>" onchange=getsubcategory(<?php echo $i; ?>)>
								<option value=""></option>
								<?php
									echo create_select_optionsid("vivliothiki_domika_category","name");
								?>
								<option value=10>Υλικά χρήστη</option>
								</select>
							</td>
							<td style="text-align:center;">
								<select class="form-control input-sm" id="subcategory<?php echo $i; ?>" disabled="disabled" onchange=getylika(<?php echo $i; ?>)>
								<option value="" selected="selected"></option>
								</select>
							</td>
							<td style="text-align:center;">
								<select class="form-control input-sm" id="strwsi<?php echo $i; ?>" onchange=getylika_cl(<?php echo $i; ?>);>
								<option value="" selected="selected"></option>
								</select>
							</td>
							<td style="text-align:center;">
								<input class="form-control input-sm" type="text" id="cl<?php echo $i; ?>" style="text-align:center;" disabled="disabled"/>
							</td>
							<td style="text-align:center;" bgcolor="#f3bacf">
								<input class="form-control input-sm" type="text" id="dl<?php echo $i; ?>" style="text-align:center;" disabled="disabled"/>
							</td>
						</tr>
						<?php
						}
						?>
						
						<tr bgcolor="#e7769f"><td style="text-align:center;" colspan="7">Θέση - (Τοίχοι/Δάπεδα:ΕΞΩ , Οροφές: ΜΕΣΑ)</td>
						<tr bgcolor="#e35f8f">
							<td style="text-align:center;">
								Σ<sub>d</sub>= 
							</td>
							<td style="text-align:center;">
								<input class="form-control" type="text" id="calcu_sdl" style="text-align:center;font-weight:bold;" disabled="disabled" value="0.000" />
							</td>
							<td colspan="3" align="center">
							</td> 
							<td style="text-align:center;vertical-align:middle;">
								R<sub>Λ</sub>= 
							</td>
							<td style="text-align:center;vertical-align:middle;">
								<input class="form-control" type="text" id="calcu_scl" style="text-align:center;font-weight:bold;" disabled="disabled" value="0.000" />
							</td>
						</tr>
						
						<tr bgcolor="#f3bacf">
						<td style="text-align:center;vertical-align:middle;" colspan="3" rowspan="2">
							αντιστάσεις θερμικής μετάβασης:
						</td>
						<td align="center" colspan="2" rowspan="2" id="myHeader1" style="vertical-align:middle;">
							<select class="form-control input-sm" id="calcu_rira_type" onchange=get_rira();>
							<option value=0></option>
							<?php
							echo create_select_optionsid("vivliothiki_u_rira","name");
							?>
							</select>
							<input class="form-control" type="hidden" id="calcu_rira_t" disabled="disabled" />
							<input class="form-control" type="hidden" id="calcu_rira_e" disabled="disabled" />
						</td>
						<td style="text-align:center;vertical-align:middle;">
							R<sub>i</sub>=
						</td>
						<td style="text-align:center;vertical-align:middle;">
							<input class="form-control" type="text" id="calcu_ri" style="text-align:center;font-weight:bold;" disabled="disabled" />
						</td>
						</tr>
						
						<tr bgcolor="#f3bacf">
						<td style="text-align:center;vertical-align:middle;">
							R<sub>a</sub>=
						</td>
						<td style="text-align:center;vertical-align:middle;">
							<input class="form-control" type="text" id="calcu_ra" style="text-align:center;font-weight:bold;" disabled="disabled" />
						</td>
						</tr>
						
						<tr bgcolor="#f7d1df">
						<td style="text-align:center;vertical-align:middle;" colspan="3">
							θερμική αντίσταση κεραμοσκεπής:
						</td>
						<td align="center" colspan="2" style="vertical-align:middle;">
							<select class="form-control input-sm" id="calcu_ru_type" onchange=get_ru()>
								<option value=0></option>
								<?php
								echo create_select_optionsval("vivliothiki_u_ru","name","ru");
								?>
							</select>
						</td>
						<td style="text-align:center;vertical-align:middle;">
							R<sub>u</sub>=
						</td>
						<td style="text-align:center;vertical-align:middle;">
							<input class="form-control" type="text" id="calcu_ru" style="text-align:center;font-weight:bold;" disabled="disabled"/>
						</td>
						</tr>
						
						<tr bgcolor="#f3bacf">
						<td style="text-align:center;vertical-align:middle;" colspan="3">στρώμα αέρα πάχους [mm]:</td>
						<td colspan="2">
							<select class="form-control input-sm" id="calcu_rd_d" onchange=get_rd()>
								<option value=0></option>
								<option value=5>5</option>
								<option value=7>7</option>
								<option value=10>10</option>
								<option value=15>15</option>
								<option value=25>25</option>
								<option value=50>50</option>
								<option value=100>100</option>
								<option value=300>300</option>
							</select>
						<td style="text-align:center;vertical-align:middle;" rowspan="3">
							R<sub>δ</sub>=
						</td>
						<td style="text-align:center;vertical-align:middle;" rowspan="3">
							<input class="form-control" type="text" id="calcu_rd" style="text-align:center;font-weight:bold;" disabled="disabled" class="disabled" />
						</td>
						</tr>
						
						<tr bgcolor="#f3bacf">
						<td style="text-align:center;vertical-align:middle;" colspan="3">
							Ροή: 
						</td>
						<td colspan="2">
							<select class="form-control input-sm" id="calcu_rd_flow" onchange=get_rd()>
								<option value=0></option>
								<option value=1>Οριζόντια ροή</option>
								<option value=2>Από πάνω προς τα κάτω</option>
								<option value=3>Από κάτω προς τα πάνω</option>
							</select>						
						</td>
						</tr>
						
						<tr bgcolor="#f3bacf">
						<td style="text-align:center;vertical-align:middle;" colspan="3">
							ανακλαστική επιφάνεια με ε = 
						</td>
						<td colspan="2">
							<select class="form-control input-sm" id="calcu_rd_e" onchange=get_rd()>
								<option value=0></option>
								<option value=1>Χωρίς ανακλαστική επιφάνεια (ε = 0.80)</option>
								<option value=2>Με ανακλαστική επιφάνεια (ε = 0.05)</option>
								<option value=3>Με ανακλαστική επιφάνεια (ε = 0.10)</option>
								<option value=4>Με ανακλαστική επιφάνεια (ε = 0.20)</option>
							</select>	
						</td>
						</tr>
						
						<tr bgcolor="#e7769f" style="vertical-align:middle;">
						<td colspan="3" style="text-align:center;vertical-align:middle;">
						U = 
						</td>
						<td style="text-align:center;vertical-align:middle;">
						<input class="form-control" type="text" id="calcu_u" style="text-align:center;font-weight:bold;" />
						</td>
						<td style="text-align:center;vertical-align:middle;">
						<img id="imgok" src="images/interface/edithelp/blank.png" style="vertical-align:middle;"></img>
						</td> 
						<td style="text-align:center;vertical-align:middle;">R<sub>ολ</sub>=</td>
						<td style="text-align:center;vertical-align:middle;"><input class="form-control" type="text" id="calcu_r" style="text-align:center;font-weight:bold;" disabled="disabled"/>
						</tr>
					</table>

					<div id="graph"> </div>
					
					
<script>
function trim(s) {
	return s.replace(/^\s+|\s+$/g,"");
}
function ltrim(s) {
	return s.replace(/^\s+/,"");
}
function rtrim(s) {
	return s.replace(/\s+$/,"");
}

//ΕΙΝΑΙ ΣΥΝΔΕΔΕΜΕΝΟΣ Ο ΧΡΗΣΤΗΣ
//Εύρεση αν πρόκειται για αντικατάσταση ή προσθήκη
function adiafani_find(){
	var id=document.getElementById("calcu_id").value;
	var x="includes/functions_calc.php?adiafani_find=1&id="+id;
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",x ,true);
		xmlhttp.send();

		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var returned = xmlhttp.responseText;
			document.getElementById("save_btn_txt").innerHTML = returned;
		}}
}

//Δημιουργία υπολογισμού
function adiafani_save(){
	var id=document.getElementById("calcu_id").value;
	var name=document.getElementById("calcu_name").value;
	var zwni=document.getElementById("calcu_zwni").value;
	var type=document.getElementById("calcu_type").value;
	var rira=parseFloat(document.getElementById("calcu_rira_type").value);
	var ru=parseFloat(document.getElementById("calcu_ru_type").value);
	var rd1=parseFloat(document.getElementById("calcu_rd_d").value);
	var rd2=parseFloat(document.getElementById("calcu_rd_flow").value);
	var rd3=parseFloat(document.getElementById("calcu_rd_e").value);
	var u=document.getElementById("calcu_u").value;
	var paxos="";
	var category="";
	var subcategory="";
	var strwsi=""; 
	var i;
	var date = new Date();
	
	for (i=1;i<=10;i++){
		paxos += document.getElementById("paxos"+i).value+"|";
		category += document.getElementById("category"+i).value+"|";
		subcategory += document.getElementById("subcategory"+i).value+"|";
		strwsi += document.getElementById("strwsi"+i).value+"|";
	}
	
	var x="includes/functions_calc.php?adiafani_save=1&id="+id;
	x+="&name="+name;
	x+="&zwni="+zwni;
	x+="&type="+type;
	x+="&rira="+rira;
	x+="&ru="+ru;
	x+="&rd1="+rd1;
	x+="&rd2="+rd2;
	x+="&rd3="+rd3;
	x+="&paxos="+paxos;
	x+="&category="+category;
	x+="&subcategory="+subcategory;
	x+="&strwsi="+strwsi;
	x+="&u="+u;
		
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",x ,true);
		xmlhttp.send();

		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var returned = xmlhttp.responseText;
			var save_alert = "<div class=\"alert alert-info\">";
			save_alert += "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
			save_alert += "Το στοιχείο "+name+" "+returned+" στη βάση δεδομένων! "+date+"</div>";
			document.getElementById("save_alert").innerHTML=save_alert;
		}}
}

//Δημιουργία του select με τους υπολογισμούς αδιαφανών του χρήστη
function adiafani_makeselect(){
var x="includes/functions_calc.php?adiafani_makeselect=1";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",x ,true);
		xmlhttp.send();

		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		
		var returned = xmlhttp.responseText;
			if(returned==""){
				document.getElementById("load_button").disabled = true;
				document.getElementById("load_select").disabled = true;
				document.getElementById("load_found").innerHTML = "Δεν βρέθηκαν υπολογισμοί ανοιγμάτων στη βιβλιοθήκη σας";
			}else{
				document.getElementById("load_button").disabled = false;
				document.getElementById("load_select").disabled = false;
				document.getElementById("load_select").innerHTML = returned;
			}
			
		}}
}

//Φόρτωση στοιχείων υπολογισμού
function adiafani_load(){
var x="includes/functions_calc.php?adiafani_load=1";
x+="&id="+document.getElementById("load_select").value;

	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET",x ,true);
	xmlhttp.send();

	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		var returned = xmlhttp.responseText;
		var load_alert = "";

		if(returned==""){
			load_alert += "<div class=\"alert alert-error\">";
			load_alert += "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
			load_alert += "Υπήρξε κάποιο πρόβλημα με την ανάκτηση!";
		}else{
			returned = JSON.parse(returned);
			load_alert += "<div class=\"alert alert-success\">";
			load_alert += "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
			load_alert += "Επιτυχής φόρτωση!";
			
				document.getElementById("calcu_id").value = returned["id"];
				document.getElementById("calcu_name").value = returned["name"];
				document.getElementById("calcu_zwni").value = returned["zwni"];
				document.getElementById("calcu_type").value = returned["type"];
				document.getElementById("calcu_rira_type").value = returned["rira"];
				get_rira();
				document.getElementById("calcu_ru_type").value = returned["ru"];
				get_ru();
				document.getElementById("calcu_rd_d").value = returned["rd1"];
				document.getElementById("calcu_rd_flow").value = returned["rd2"];
				document.getElementById("calcu_rd_flow").value = returned["rd2"];
				document.getElementById("calcu_rd_e").value = returned["rd3"];
				get_rd();
				
				var paxos=returned["paxos"].split("|");
				var category=returned["category"].split("|");
				var subcategory=returned["subcategory"].split("|");
				var strwsi=returned["strwsi"].split("|");
				
				for (i=1;i<=10;i++){
				if(paxos[i-1]=="undefined"){paxos[i-1]="";}
					document.getElementById("paxos"+i).value = paxos[i-1];
					if(paxos[i-1]!=""){
						get_allselects(i,category[i-1],subcategory[i-1],strwsi[i-1]);
					}else{
						get_allselects(i,category[i-1],subcategory[i-1],strwsi[i-1]);
						document.getElementById("cl"+i).value = "";
						document.getElementById("dl"+i).value = "";
					}
				}
		}
		load_alert += "</div>";
		document.getElementById("load_alert").innerHTML = load_alert;
		
	}}
}

//Άδειασμα του υπολογισμού και προσθήκη τιμής ID=""
function adiafani_clear(){
				
	for (var i=1;i<=10;i++){
		get_allselects(i,0,0,0);
		document.getElementById("paxos"+i).value = "";
		document.getElementById("cl"+i).value = "";
		document.getElementById("dl"+i).value = "";
	}
	document.getElementById("calcu_id").value = "";
	document.getElementById("calcu_name").value = "";
	document.getElementById("calcu_zwni").selectedIndex = 0;
	document.getElementById("calcu_type").selectedIndex = 0;
	document.getElementById("calcu_umax").value = "";
	document.getElementById("calcu_sdl").value = "";
	document.getElementById("calcu_scl").value = "";
	document.getElementById("calcu_rira_type").selectedIndex = 0;
	document.getElementById("calcu_ru_type").selectedIndex = 0;
	document.getElementById("calcu_rd_d").selectedIndex = 0;
	document.getElementById("calcu_rd_flow").selectedIndex = 0;
	document.getElementById("calcu_rd_e").selectedIndex = 0;
	document.getElementById("calcu_ri").value = "";
	document.getElementById("calcu_ra").value = "";
	document.getElementById("calcu_ru").value = "";
	document.getElementById("calcu_rd").value = "";
	document.getElementById("calcu_r").value = "";
	document.getElementById("calcu_u").value = "";
	document.getElementById("graph").innerHTML = "";

}

//Στη φόρτωση με βάση το ID του υλικού φτιάχνει τα select των κατηγοριών και υποκατηγοριών
//Δεν επιβαρύνεται η βάση από select σε select. Φορτώνει όλη η γραμμή του υλικού
function get_allselects(i,cat,subcat,id){
	
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","includes/functions_calc.php?adiafani_getselectsid=1&category="+cat+"&subcategory="+subcat+"&material_id="+id ,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		arr = JSON.parse(xmlhttp.responseText);
		document.getElementById('subcategory'+i).disabled = false;
		document.getElementById("subcategory"+i).innerHTML=arr[0];
		document.getElementById("strwsi"+i).innerHTML=arr[1];
		document.getElementById("cl"+i).value=arr[2];
		document.getElementById("category"+i).value = cat;
		document.getElementById("subcategory"+i).value = subcat;
		document.getElementById("strwsi"+i).value = id;
		getcl(i);
	}}
}

function load_close(){
document.getElementById("load_alert").innerHTML="";
}
function save_close(){
document.getElementById("save_alert").innerHTML="";
}


//AKOMA KAI AN ΔΕΝ ΕΙΝΑΙ ΣΥΝΔΕΔΕΜΕΝΟΣ Ο ΧΡΗΣΤΗΣ
//Στην αλλαγή της κατηγορίας φόρτωση υποκατηγοριών
function getsubcategory(i,id) {
	var category = document.getElementById('category'+i).value;

		if (category!=0){//Έχει επιλεγεί κατηγορία
		//Αφαίρεση της απενεργοποίησης από το select της υποκατηγορίας
		document.getElementById('subcategory'+i).disabled = false;
		
		//Εύρεση υποκατηγοριών από βάση δεδομένων
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","includes/functions_calc.php?adiafani_find_subcategory=1&category="+category ,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("subcategory"+i).innerHTML=xmlhttp.responseText;
			if(id!=null){
			document.getElementById('subcategory'+i).value=id;
			}
			getylika(i);//Φόρτωση και των υλικών για την υποκατηγορία
		}}
		
		}else{//Δεν έχει επιλεγεί κατηγορία
			document.getElementById('subcategory'+i).innerHTML = "<option value=\"0\">Επιλέξτε πρώτα κατηγορία</option>";
			document.getElementById('strwsi'+i).innerHTML = "<option value=\" \" selected=\"selected\"></option>";
			document.getElementById('subcategory'+i).disabled = true;
		}
}

//Στην αλλαγή υποκατηγορίας φόρτωση υλικών - Φορτώνει άμεσα στο getsubcategory(i)
function getylika(i,id){
	id = typeof id !== 'undefined' ? id : null;
	var category = document.getElementById('category'+i).value;
	var subcategory = document.getElementById('subcategory'+i).value;
	
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","includes/functions_calc.php?adiafani_find_ylika=1&category="+category+"&subcategory="+subcategory ,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("strwsi"+i).innerHTML=xmlhttp.responseText;
		if(id!=null){
			document.getElementById('strwsi'+i).value=id;
			getylika_cl(i);
		}
	}}
	if(id!=null){
		get_sums(i);
	}
}

//Στην αλλαγή υποκατηγορίας φόρτωση υλικών - Φορτώνει άμεσα στο getsubcategory(i)
function getylika_cl(i){
	var category = document.getElementById('category'+i).value;
	var strwsi = document.getElementById('strwsi'+i).value;
	
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","includes/functions_calc.php?adiafani_find_ylikacl=1&category="+category+"&material_id="+strwsi ,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("cl"+i).value=xmlhttp.responseText;
		getcl(i);
	}}
	get_u();
}

//Στην αλλαγή αντιστάσεων θερμικής μετάβασης εύρεση του Ri και Ra
function get_rira(){
	var calcu_rira_type = document.getElementById('calcu_rira_type').value;
	var type,epafi;
	
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","includes/functions_calc.php?adiafani_find_rira=1&rira_type="+calcu_rira_type ,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		var arr = JSON.parse(xmlhttp.responseText);
		 document.getElementById('calcu_ri').value=arr["ri"];
		 document.getElementById('calcu_ra').value=arr["ra"];
	}}
	get_umax();
}

//Εύρεση του Umax
function get_umax(){
	var calcu_rira_type = document.getElementById('calcu_rira_type').value;
	var calcu_zwni = document.getElementById('calcu_zwni').value;
	var calcu_type = document.getElementById('calcu_type').value;
	
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","includes/functions_calc.php?adiafani_find_umax=1&rira_type="+calcu_rira_type+"&zwni="+calcu_zwni+"&type="+calcu_type ,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		 document.getElementById('calcu_umax').value=xmlhttp.responseText;
		 get_u();
	}}
}

//Εύρεση του ru (θερμική αντίσταση κεραμοσκεπής)
function get_ru(){
	var calcu_ru_type = document.getElementById('calcu_ru_type').value;
	document.getElementById('calcu_ru').value=calcu_ru_type;
	get_u();
}

//Εύρεση του Rd
function get_rd(){
	var calcu_rd_d = document.getElementById('calcu_rd_d').value;
	var calcu_rd_flow = document.getElementById('calcu_rd_flow').value;
	var calcu_rd_e = document.getElementById('calcu_rd_e').value;
	
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","includes/functions_calc.php?adiafani_find_rd=1&rd_d="+calcu_rd_d+"&rd_flow="+calcu_rd_flow+"&rd_e="+calcu_rd_e ,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		 document.getElementById('calcu_rd').value=xmlhttp.responseText;
		 get_u();
	}}
}

//Εύρεση d/λ
function getcl(v){
	var x;
	var y;
	x = parseFloat(document.getElementById("cl"+v).value);
	x = x.toFixed(3)
	if (isNaN(x)) {x="";}

	y = parseFloat(document.getElementById("paxos"+v).value);
	y = y/x;
	y = y.toFixed(3)
	if (!isFinite(y)) {y="";}
	document.getElementById("dl"+v).value=y;

	get_sums();
	get_u();
}

//Εμφάνιση σκαριφήματος ή εκτύπωση
function showgraph(pout){
	var x;
	var i;
	var n;
	var w;
	n=document.getElementById("calcu_rira_type").value;
	if (n>0){//Έχει δηλωθεί Ri και Ra
		if (n<4){//Τοιχοποιία
			x="includes/adiafani_image_creation_wall.php?descr="+document.getElementById("calcu_name").value;
		}else{//Δάπεδα - Οροφές
			x="includes/adiafani_image_creation_floor.php?descr="+document.getElementById("calcu_name").value;
		}
		x+="&floor=1"
		x+="&zwni="+document.getElementById("calcu_zwni").selectedIndex;
		x+="&roof="+document.getElementById("calcu_ru_type").value;
		x+="&ria="+document.getElementById("calcu_rira_type").selectedIndex;
		w=document.getElementById('calcu_sdl').value*500+600;
		if (w<300){w=300;}
		document.getElementById('graph').style.height=w;
		for (i=1;i<=10;i++)
		{
		x+="&pax"+i+"="+document.getElementById("paxos"+i).value;
		x+="&str"+i+"="+document.getElementById("cl"+i).value;
		if(document.getElementById("strwsi"+i).value!=0){
			x+="&strn"+i+"="+document.getElementById("strwsi"+i).options[document.getElementById("strwsi"+i).selectedIndex].text;
		}else{
			x+="&strn"+i+"=";
		}
		x+="&eid"+i+"="+document.getElementById("category"+i).value;
		}
		x+="&imh="+w;
		x+="&ri="+document.getElementById("calcu_ri").value;
		x+="&ra="+document.getElementById("calcu_ra").value;
		x+="&ru="+document.getElementById("calcu_ru").value;
		x+="&rd="+document.getElementById("calcu_rd").value;
		x+="&umax="+document.getElementById("calcu_umax").value;
		if (pout==1){
			x+="&print=1";
			window.open(x,"La-Kenak");
		}else{
			document.getElementById('graph').innerHTML="<img src=\""+x+"\"></img>";
		}
	}else{
		if (pout==1){
			alert("Δεν έχετε δηλώσει αντιστάσεις θερμικής μετάβασης (Ra και Ri)");
		}
	}
}

//Εύρεση της πρόσθεσης Σdl και Σd/λ
function get_sums(){
	//Πάχη στρώσεων - Σύνολο
	var s1=0;
	for (i=1;i<=10;i++){
		s = parseFloat(document.getElementById("dl"+i).value);
		if (!isNaN(s)) {s1 += s ;}
	}
	s1 = s1.toFixed(3);
	if (isNaN(s1)) {s1=0;}
	document.getElementById("calcu_scl").value=s1;

	var s2=0;
	for (i=1;i<=10;i++){
		s = parseFloat(document.getElementById("paxos"+i).value);
		if (!isNaN(s)) {s2 += s ;}
	}
	s2 = s2.toFixed(3)
	if (isNaN(s2)) {s2=0;}
	document.getElementById("calcu_sdl").value=s2;
}

//Εύρεση U
function get_u(){
	var scl=parseFloat(document.getElementById("calcu_scl").value);
	var ri=parseFloat(document.getElementById("calcu_ri").value);
	var ra=parseFloat(document.getElementById("calcu_ra").value);
	var ru=parseFloat(document.getElementById("calcu_ru").value);
	var rd=parseFloat(document.getElementById("calcu_rd").value);
	var umax=parseFloat(document.getElementById("calcu_umax").value);
	
	if (isNaN(scl)) {scl=0;}
	if (isNaN(ri)) {ri=0;}
	if (isNaN(ra)) {ra=0;}
	if (isNaN(ru)) {ru=0;}
	if (isNaN(rd)) {rd=0;}
	
	var rol=scl+ri+ra+ru+rd;
	var u=1/rol;
	
	document.getElementById("calcu_r").value=number_format(rol,3);
	document.getElementById("calcu_u").value=number_format(u,4);
	
	if (u<=umax){
		document.getElementById('imgok').src="images/interface/edithelp/yes.png";
	}else{
		document.getElementById('imgok').src="images/interface/edithelp/no.png";
	}
	showgraph(0);
}

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
</script>
		</div>
		</div>
	</div><!--tab content-->
			</div><!--tabs-->

</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

