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
	<small>Σενάρια</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-university"></i> Βιβλιοθήκες</a></li>
	<li class="active"> Σενάρια</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
	
		<div class="col-md-2">
		
		<br/><br/>
				<div class="btn-group">
					<button class="btn btn-solar dropdown-toggle" data-toggle="dropdown"><i class="fa fa-life-ring"></i> Ενέργειες
					<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a tabindex="-1" href="#popup_theoretical_insert" data-toggle="modal" onclick=save_senaria();>
							<font color="#076643"><i class="fa fa-save"></i></font> Αποθήκευση</a>
						</li>
						<li>
							<a tabindex="-1" href="#popup_theoretical_remove" data-toggle="modal" onclick=insert_senaria();>
							<font color="#1269FF"><i class="fa fa-plus-circle"></i></font> Προσθήκη ενδεικτικών</a>
						</li>
						<li>
							<a tabindex="-1" href="#help_popup" data-toggle="modal">
							<font color=red><i class="fa fa-life-ring"></i></font> Βοήθεια</a>
						</li>
					</ul>
				</div>
				<br/><br/>
					
			    <div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<h4>Δημιουργία σεναρίων</h4>
				Κατά τη δημιουργία του xml μπορείτε να επιλέξετε να δημιουργηθούν έως 3 αντίγραφα του υπάρχοντος κτιρίου 
				με διαφορετικές συνθήκες. Το κέλυφος θεωρείται πως παραμένει το ίδιο ως προς τις διαστάσεις του. 
				<br/><br/>
				Εάν μετά την παρέμβαση αλλάζουν τα δομικά στοιχεία (πχ κάποιο παράθυρο αλλάζει σε θύρα) τότε τροποποιούνται 
				οι διαστάσεις και κατ' επέκταση τα εμβαδά. Τέτοιες αλλαγές δεν μπορούν να γίνουν μέσω του la-kenak παρά μόνο 
				χειροκίνητα στο ΤΕΕ-ΚΕΝΑΚ. 
				
				</div>
				<div id="info"></div>
		</div>
		
		<div class="col-md-10">
		<div id='wait' style="display:none;position:absolute;top:130px;left:500px;"><img src="images/interface/ajax-loader.gif"></div>
			<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs-1" data-toggle="tab">
					<i class="fa fa-sitemap"></i> Σενάριο <span class="label label-success">1ο</span></a>
				</li>
				<li><a href="#tabs-2" data-toggle="tab">
					<i class="fa fa-sitemap"></i> Σενάριο <span class="label label-success">2ο</span></a>
				</li>
				<li><a href="#tabs-3" data-toggle="tab">
					<i class="fa fa-sitemap"></i> Σενάριο <span class="label label-success">3ο</span></a>
				</li>
				<li><a href="#tabs-4" data-toggle="tab">
					<i class="fa fa-question-circle"></i> Βοήθεια </a>
				</li>
			</ul>
			
			<div class="tab-content">
			
<?php
for ($i=1; $i<=3; $i++){
	if($i==1){$tab_class="tab-pane active";}else{$tab_class="tab-pane";}
?>
<div class="<?php echo $tab_class;?>" id="tabs-<?php echo $i;?>">
	<div class="input-group" id="senario<?php echo $i;?>_groupname">
	  <span class="input-group-addon">
		<input type="checkbox" id="senario_on<?php echo $i;?>" onchange="change_on(<?php echo $i;?>);">
		Ενεργό σενάριο <?php echo $i;?>
	  </span>
	  <input type="text" class="form-control" id="senario_perigrafi<?php echo $i;?>" placeholder="Περιγραφή σεναρίου">
	</div><!-- /input-group -->
	
	<br/>
	
<div class="row"><!--row-->
	<div class="col-md-6">
	
	<div class="panel panel-default" id="senario<?php echo $i;?>_panelkelyfos">
		<div class="panel-heading">Κέλυφος</div>
		<div class="panel-body" id="senario<?php echo $i;?>_panelkelyfosb">
		
			<div class="input-group has-warning">
			  <span class="input-group-addon">
				Τοίχοι με U:
			  </span>
			  <input type="text" class="form-control" id="senario_wall_u<?php echo $i;?>" placeholder="U">
			</div><!-- /input-group -->
			<br/>
			
			 <div class="input-group has-warning">
			  <span class="input-group-addon">
				Οροφές με U:
			  </span>
			  <input type="text" class="form-control" id="senario_roof_u<?php echo $i;?>" placeholder="U">
			</div><!-- /input-group -->
			<br/>
			
			<div class="input-group has-warning">
			  <span class="input-group-addon">
				Δάπεδα με U:
			  </span>
			  <input type="text" class="form-control" id="senario_floor_u<?php echo $i;?>" placeholder="U">
			</div><!-- /input-group -->
			<br/>
			
			<span class="help-block">Θερμομόνωση τοιχοποιίας. Ο συντελεστής αφορά την τοιχοποιία (όλες οι στρώσεις) και το φέρων οργανισμό έπειτα από την παρέμβαση 
			και προστίθεται σε όλα τα στοιχεία αδιαφανών.</sup>
			</span>
			
			<div class="input-group has-warning">
			  <span class="input-group-addon">
				Διαφανή με U:
			  </span>
			  <input type="text" class="form-control" id="senario_u_an<?php echo $i;?>" placeholder="U">
			</div><!-- /input-group -->
			<span class="help-block">Αντικατάσταση κουφωμάτων. Ο συντελεστής θα προστεθεί σε όλα τα ανοίγματα.</span>
	
			
		</div><!--panel-body-->
	</div><!--panel-->
	
	
	</div><!--col-md-6-->
	<div class="col-md-6">
	
	<div class="panel panel-default" id="senario<?php echo $i;?>_panelsystems">
		<div class="panel-heading">Συστήματα</div>
		<div class="panel-body" id="senario<?php echo $i;?>_panelsystemsb">
		
			<div class="input-group has-warning">
			  <span class="input-group-addon">
				Θέρμανση
			  </span>
			  <select class="form-control" id="senario_thermp_type<?php echo $i;?>">
				<option value=0>Λέβητας</option>
				<option value=1>Κεντρική υδρόψυκτη Α.Θ.</option>
				<option value=2>Κεντρική αερόψυκτη Α.Θ.</option>
				<option value=3>Τοπική αερόψυκτη Α.Θ.</option>
				<option value=4>Γεωθερμική Α.Θ. με οριζόντιο εναλλάκτη</option>
				<option value=5>Γεωθερμική Α.Θ. με κατακόρυφο εναλλάκτη</option>
				<option value=6>Κεντρική άλλου τύπου Α.Θ.</option>
				<option value=7>Τοπικές ηλεκτρικές μονάδες</option>
				<option value=8>Τοπικές μονάδες αερίου ή υγρού καυσίμου</option>
				<option value=9>Ανοικτές εστίες καύσης</option>
				<option value=10>Τηλεθέρμανση</option>
				<option value=11>ΣΗΘ</option>
				<option value=12>Μονάδα παραγωγής άλλου τύπου</option>
			  </select>
			  <input type="text" class="form-control" id="senario_thermp_kw<?php echo $i;?>" placeholder="Ισχύς">
			  <input type="text" class="form-control" id="senario_thermp_n<?php echo $i;?>" placeholder="n">
			  <input type="text" class="form-control" id="senario_thermp_cop<?php echo $i;?>" placeholder="cop">
			</div><!-- /input-group -->
			
			<br/>
			
			<div class="input-group has-warning">
			  <span class="input-group-addon">
				Ψύξη
			  </span>
			  <select class="form-control" id="senario_coldp_type<?php echo $i;?>">
				<option value=0>Αερόψυκτος ψύκτης</option>
				<option value=1>Υδρόψυκτος ψύκτης</option>
				<option value=2>Υδρόψυκτη Α.Θ.</option>
				<option value=3>Αερόψυκτη Α.Θ.</option>
				<option value=4>Γεωθερμική Α.Θ. με οριζόντιο εναλλάκτη</option>
				<option value=5>Γεωθερμική Α.Θ. με κατακόρυφο εναλλάκτη</option>
				<option value=6>Προσρόφησης Απορρόφησης Α.Θ.</option>
				<option value=7>Κεντρική άλλου τύπου Α.Θ.</option>
				<option value=8>Μονάδα παραγωγής άλλου τύπου</option>
			  </select>
			  <input type="text" class="form-control" id="senario_coldp_kw<?php echo $i;?>" placeholder="Ισχύς">
			  <input type="text" class="form-control" id="senario_coldp_n<?php echo $i;?>" placeholder="n">
			  <input type="text" class="form-control" id="senario_coldp_eer<?php echo $i;?>" placeholder="EER">
			</div><!-- /input-group -->
			
			<br/>
			
			<div class="input-group has-warning">
			  <span class="input-group-addon">
				Ηλιακός
			  </span>
			  <select class="form-control" id="senario_znxp_type<?php echo $i;?>">
				<option value="1">Απλός επίπεδος</option>
				<option value="2">Επιλεκτικός</option>
				<option value="3">Κενού</option>
			  </select>
			  <input type="text" class="form-control" id="senario_znxp_e<?php echo $i;?>" placeholder="Επιφάνεια">
			</div><!-- /input-group -->
			<span class="help-block">Προσθήκη ηλιακού. Αν υπάρχει ήδη ηλιακός θα τροποποιηθεί.</span>
			
			<div class="input-group has-warning">
			  <span class="input-group-addon">
				Φωτισμός
			  </span>
			 <input type="text" class="form-control" id="senario_light_w<?php echo $i;?>" placeholder="Ισχύς (KW)">
			</div><!-- /input-group -->
		</div><!--panel-body-->
	</div><!--panel-->
	
	</div><!--col-md-6-->

</div><!--row-->
	
</div><!--tab-->
<?php
}
?>


<!--################## ΒΟΗΘΕΙΑ ##################### -->
<div class="tab-pane" id="tabs-4">
	<i class="fa fa-question-circle fa-3x"></i><br/>
	Τα ενεργά σενάρια προστίθενται ως αντίγραφο του υπάρχοντος κτιρίου. Προσωρινά στα σενάρια μεταφέρονται μόνο τα U των δομικών στοιχείων ως εξής:
	<br/>
	<ul>
		<li>Εφόσον προστεθεί U τοίχων: Όλη η τοιχοποιία της ζώνης ανεξάρτητα αν έχει επαφή σε αέρα, ΜΘΧ, ηλιακό χώρο, έδαφος</li>
		<li>Εφόσον προστεθεί U δαπέδων: Όλα τα δάπεδα της ζώνης ανεξάρτητα αν έχουν επαφή σε αέρα, ΜΘΧ, ηλιακό χώρο, έδαφος</li>
		<li>Εφόσον προστεθεί U οροφών: Όλες οι οροφές της ζώνης ανεξάρτητα αν έχουν επαφή σε αέρα, ΜΘΧ, ηλιακό χώρο, έδαφος</li>
		<li>Εφόσον προστεθεί U ανοιγμάτων: Όλα τα ανοίγματα της ζώνης ανεξάρτητα αν βρίσκονται στα αδιαφανή (πόρτες), στα διαφανή ή στα παθητικά ηλιακά και ανεξάρτητα από την επαφή (αέρα, ΜΘΧ)</li>
	</ul>
	<br/><br/>
	Οι τιμές που εφαρμόζονται όταν υπάρχει διαφορετικός συντελεστής είναι οι τυπικές τιμές του Εξοικονομώ Ι δηλαδή:
	<br/>
	<ul>
		<li>Τοιχοποιία: 50€/m<sup>2</sup></li>
		<li>Δάπεδα: 50€/m<sup>2</sup></li>
		<li>Οροφές: 40€/m<sup>2</sup></li>
		<li>Ανοίγματα: 280€/m<sup>2</sup></li>
	</ul>
</div><!--tab-->
<!--################## ΒΟΗΘΕΙΑ ##################### -->


					</div><!--tab content-->
				</div><!--tabs-->
			</div><!--col-md-10-->
		</div>
		 <!-- /.row (main row) -->
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

<script>

function save_senaria(){
	var link;
	var active ="";
	var perigrafi ="";
	var senario_wall_u ="";
	var senario_roof_u ="";
	var senario_floor_u ="";
	var senario_u_an ="";
	var u ="";
	var senario_thermp_type ="";
	var senario_thermp_kw ="";
	var senario_thermp_n ="";
	var senario_thermp_cop ="";
	var thermp ="";
	var senario_coldp_type ="";
	var senario_coldp_kw ="";
	var senario_coldp_n ="";
	var senario_coldp_eer ="";
	var coldp ="";
	var senario_znxp_type ="";
	var senario_znxp_e ="";
	var znxp ="";
	var light ="";
	var i;
	
	for (i = 1; i <= 3; i++) {
		
		if(document.getElementById("senario_on"+i).checked==true){
			active +=  "1|";
		}else{
			active += "0|";
		}
		perigrafi += document.getElementById("senario_perigrafi"+i).value + "|";
		
		senario_wall_u += document.getElementById("senario_wall_u"+i).value + "|";
		senario_roof_u += document.getElementById("senario_roof_u"+i).value + "|";
		senario_floor_u += document.getElementById("senario_floor_u"+i).value + "|";
		senario_u_an += document.getElementById("senario_u_an"+i).value + "|";
		
		senario_thermp_type += document.getElementById("senario_thermp_type"+i).value + "|";
		senario_thermp_kw += document.getElementById("senario_thermp_kw"+i).value + "|";
		senario_thermp_n += document.getElementById("senario_thermp_n"+i).value + "|";
		senario_thermp_cop += document.getElementById("senario_thermp_cop"+i).value + "|";
		
		senario_coldp_type += document.getElementById("senario_coldp_type"+i).value + "|";
		senario_coldp_kw += document.getElementById("senario_coldp_kw"+i).value + "|";
		senario_coldp_n += document.getElementById("senario_coldp_n"+i).value + "|";
		senario_coldp_eer += document.getElementById("senario_coldp_eer"+i).value + "|";
		
		senario_znxp_type += document.getElementById("senario_znxp_type"+i).value + "|";
		senario_znxp_e += document.getElementById("senario_znxp_e"+i).value + "|";
		
		light += document.getElementById("senario_light_w"+i).value + "|";
	}
	
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	
	link = "includes/functions_senaria.php?save_senaria=1";
	link += "&perigrafi="+perigrafi+"&active="+active;
	link += "&u="+senario_wall_u + "^" + senario_roof_u + "^" + senario_floor_u + "^" + senario_u_an;
	link += "&thermp="+senario_thermp_type + "^" + senario_thermp_kw + "^" + senario_thermp_n + "^" + senario_thermp_cop;
	link += "&coldp="+senario_coldp_type + "^" + senario_coldp_kw + "^" + senario_coldp_n + "^" + senario_coldp_eer;
	link += "&znxp="+senario_znxp_type + "^" + senario_znxp_e
	link += "&light="+light;
	
	
	
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		document.getElementById("info").innerHTML=xmlhttp.responseText;
		document.getElementById('wait').style.display="none";
		load_senaria();
	}}
}

function load_senaria(){
	var link = "includes/functions_meleti_general.php?get_iddata=1&table=meletes_senaria&id=0";
		
	document.getElementById('wait').style.display="inline";
	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET",link ,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		var arr = JSON.parse(xmlhttp.responseText);	
			
			var active = arr["active"].split("|");
			var perigrafi = arr["perigrafi"].split("|");
			var u_total = arr["u"].split("^");
			var u_walls = u_total[0].split("|");
			var u_roofs = u_total[1].split("|");
			var u_floors = u_total[2].split("|");
			var u_win = u_total[3].split("|");
			
			var thermp = arr["thermp"].split("^");
			var thermp_type = thermp[0].split("|");
			var thermp_kw = thermp[1].split("|");
			var thermp_n = thermp[2].split("|");
			var thermp_cop = thermp[3].split("|");
			
			var coldp = arr["coldp"].split("^");
			var coldp_type = coldp[0].split("|");
			var coldp_kw = coldp[1].split("|");
			var coldp_n = coldp[2].split("|");
			var coldp_eer = coldp[3].split("|");
			
			var znxp = arr["znxp"].split("^");
			var znxp_type = znxp[0].split("|");
			var znxp_e = znxp[1].split("|");
			
			var light = arr["light"].split("|");
			
			for (i = 1; i <= 3; i++) {
				if(active[i-1]==1){
					document.getElementById("senario_on"+i).checked = true;
				}else{
					document.getElementById("senario_on"+i).checked = false;
				}
				change_on(i);
				
				document.getElementById("senario_perigrafi"+i).value = perigrafi[i-1];
				document.getElementById("senario_wall_u"+i).value = u_walls[i-1];
				document.getElementById("senario_roof_u"+i).value = u_roofs[i-1];
				document.getElementById("senario_floor_u"+i).value = u_floors[i-1];
				document.getElementById("senario_u_an"+i).value = u_win[i-1];
				
				document.getElementById("senario_thermp_type"+i).value = thermp_type[i-1];
				document.getElementById("senario_thermp_kw"+i).value = thermp_kw[i-1];
				document.getElementById("senario_thermp_n"+i).value = thermp_n[i-1];
				document.getElementById("senario_thermp_cop"+i).value = thermp_cop[i-1];
				
				document.getElementById("senario_coldp_type"+i).value = coldp_type[i-1];
				document.getElementById("senario_coldp_kw"+i).value = coldp_kw[i-1];
				document.getElementById("senario_coldp_n"+i).value = coldp_n[i-1];
				document.getElementById("senario_coldp_eer"+i).value = coldp_eer[i-1];
				
				document.getElementById("senario_znxp_type"+i).value = znxp_type[i-1];
				document.getElementById("senario_znxp_e"+i).value = znxp_e[i-1];
				
				document.getElementById("senario_light_w"+i).value = light[i-1];
				
			}
			
		document.getElementById('wait').style.display="none";
	}}
	
}

function insert_senaria(){
	
}

function change_on(senario){
var checkbox = document.getElementById("senario_on"+senario).checked;
	if(checkbox == true){
		document.getElementById("senario"+senario+"_groupname").className = "input-group has-success";
		document.getElementById("senario"+senario+"_panelkelyfos").className = "panel panel-success";
		document.getElementById("senario"+senario+"_panelsystems").className = "panel panel-success";
		document.getElementById("senario"+senario+"_panelkelyfosb").style.backgroundColor = "#EAF0E5";
		document.getElementById("senario"+senario+"_panelsystemsb").style.backgroundColor = "#EAF0E5";
	}else{
		document.getElementById("senario"+senario+"_groupname").className = "input-group";
		document.getElementById("senario"+senario+"_panelkelyfos").className = "panel panel-default";
		document.getElementById("senario"+senario+"_panelsystems").className = "panel panel-default";
		document.getElementById("senario"+senario+"_panelkelyfosb").style.backgroundColor = "";
		document.getElementById("senario"+senario+"_panelsystemsb").style.backgroundColor = "";
	}
}

load_senaria();
</script>
