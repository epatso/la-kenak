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

if (isset($_GET['get_meletes_n'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$return = get_meletes_n();
	echo $return;
	exit;
}

if (isset($_GET['get_meletes_stats'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$return = get_meletes_stats();
	echo $return;
	exit;
}

if (isset($_GET['get_meletes_preview'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require("functions_math.php");
	require("functions_skiaseis.php");
	confirm_logged_in();
		$type = $_GET['type'];
		$id = $_GET['id'];
	$return = get_meletes_preview($type,$id);
	echo $return;
	exit;
}


if (isset($_GET['insert_generaldata'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	
		$name = $_GET['name'];
		$perigrafi = $_GET['perigrafi'];
		$type = $_GET['type'];
		$symptiksi = $_GET['symptiksi'];
		$address = $_GET['address'];
		$address_x = $_GET['address_x'];
		$address_y = $_GET['address_y'];
		$address_z = $_GET['address_z'];
		$ktirio = $_GET['ktirio'];
		$kaek = $_GET['kaek'];
		$tmima = $_GET['tmima'];
		$tmima_ar = $_GET['tmima_ar'];
		$xrisi = $_GET['xrisi'];
		$climate = $_GET['climate'];
		$height = $_GET['height'];
		$zone = $_GET['zone'];
		$pros = $_GET['pros'];
		$idioktitis = $_GET['idioktitis'];
		$idio_kathestos = $_GET['idio_kathestos'];
		$ypeythinos_type = $_GET['ypeythinos_type'];
		$ypeythinos_name = $_GET['ypeythinos_name'];
		$ypeythinos_tel = $_GET['ypeythinos_tel'];
		$ypeythinos_mail = $_GET['ypeythinos_mail'];
	
	$return = insert_meleti_generaldata($name,$perigrafi,$type,$symptiksi,$address,$address_x,$address_y,$address_z,$ktirio,$kaek,$tmima,$tmima_ar,$xrisi,$climate,$height,$zone,$pros,$idioktitis,$idio_kathestos,$ypeythinos_type,$ypeythinos_name,$ypeythinos_tel,$ypeythinos_mail);
	echo $return;
	exit;
}

if (isset($_GET['load_generaldata'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	
	$return = load_meleti_generaldata();
	echo $return;
	exit;
}

//ajax call για την επιστροφή των διαθέσιμων θερμογεφυρών
if (isset($_GET['getthermoselect'])){
	$type = $_GET['type'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require("functions_interface.php");
	confirm_logged_in();
	$tb = meletes_getthermoselect($type);
	echo $tb;
	exit;
}
//ajax call για την επιστροφή των διαθέσιμων θερμικών ζωνών
if (isset($_GET['getavailablezones'])){
	$type = $_GET['type'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require("functions_interface.php");
	confirm_logged_in();
	$tb = meletes_getavailablezones($type);
	echo $tb;
	exit;
}

//ajax call για την επιστροφή των διαθέσιμων τοίχων
if (isset($_GET['getavailablewalls'])){
	$type = $_GET['type'];
	$zone_id = $_GET['zone_id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require("functions_interface.php");
	confirm_logged_in();
	$tb = meletes_getavailablewalls($type, $zone_id);
	echo $tb;
	exit;
}
//ajax call για την επιστροφή των διαθέσιμων οροφών
if (isset($_GET['getavailableroofs'])){
	$type = $_GET['type'];
	$zone_id = $_GET['zone_id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require("functions_interface.php");
	confirm_logged_in();
	$tb = meletes_getavailableroofs($type, $zone_id);
	echo $tb;
	exit;
}
//ajax call για την επιστροφή των διαθέσιμων ανοιγμάτων από τον υπολογισμό
if (isset($_GET['getavailablewindows'])){
	$u_id = $_GET['u_id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = meletes_getavailablewindows($u_id);
	echo $tb;
	exit;
}

//ajax call για την επιστροφή U από τοίχο
if (isset($_GET['findu_adiafani'])){
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = findu_adiafani($id);
	echo $tb;
	exit;
}

//ajax call για την επιστροφή g από προσανατολισμό κτιρίου
if (isset($_GET['findg_adiafani'])){
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = findg_adiafani();
	echo $tb;
	exit;
}

//ajax call για την επιστροφή U από άνοιγμα
if (isset($_GET['findu_diafani'])){
	$type = $_GET['type'];
	$parameters = explode("|", $_GET['parameters']);
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = findu_diafani($type,$parameters);
	echo $tb;
	exit;
}

//ajax call για την επιστροφή συντελεστή αερισμού για το άνοιγμα
if (isset($_GET['findwind_diafani'])){
	$parameters = explode("|", $_GET['parameters']);
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = findwind_diafani($parameters);
	echo $tb;
	exit;
}


//ajax call για την επιστροφή τιμών μιας γραμμής
if (isset($_GET['get_iddata'])){
	$table = $_GET['table'];
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = get_iddata($table, $id);
	echo $tb;
	exit;
}
//ajax call για την προσθήκη μιας γραμμής
if (isset($_GET['insert_iddata'])){
	$table = $_GET['table'];
	$action = $_GET['action'];
	$id = $_GET['id'];
	$values = explode(",", $_GET['values']);
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = insert_iddata($table,$action,$id,$values);
	echo $tb;
	exit;
}
//ajax call για την διαγραφή μιας γραμμής
if (isset($_GET['del_iddata'])){
	$table = $_GET['table'];
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	confirm_logged_in();
	$tb = del_iddata($table, $id);
	echo $tb;
	exit;
}

require("include_check.php");

// ######################################### ΓΕΝΙΚΕΣ ###############################################

//Καλείται στη φόρτωση του μενού κελύφους για την εύρεση του αριθμού των στοιχείων
function get_meletes_n(){
	$database = new medoo(DB_NAME);
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$count_zone_dapeda = $database->count("meletes_zone_dapeda",$where);
	$count_zone_orofes = $database->count("meletes_zone_orofes",$where);
	$count_zone_adiafani = $database->count("meletes_zone_adiafani",$where);
	$count_zone_diafani = $database->count("meletes_zone_diafani",$where);
	$count_mthx_dapeda = $database->count("meletes_mthx_dapeda",$where);
	$count_mthx_orofes = $database->count("meletes_mthx_orofes",$where);
	$count_mthx_adiafani = $database->count("meletes_mthx_adiafani",$where);
	$count_mthx_diafani = $database->count("meletes_mthx_diafani",$where);
	
	$return = array(
		$count_zone_dapeda,
		$count_zone_orofes,
		$count_zone_adiafani,
		$count_zone_diafani,
		$count_mthx_dapeda,
		$count_mthx_orofes,
		$count_mthx_adiafani,
		$count_mthx_diafani
	);
	//επιστρέφει array για javascript
	return json_encode($return);
}

//Καλείται στη φόρτωση του μενού κελύφους για την εύρεση του αριθμού των στοιχείων
function get_meletes_stats(){
	$database = new medoo(DB_NAME);
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_wall = $database->select("meletes_zone_adiafani","*",$where);
	$data_window = $database->select("meletes_zone_diafani","*",$where);
	$data_dapeda = $database->select("meletes_zone_dapeda","*",$where);
	$data_orofes = $database->select("meletes_zone_orofes","*",$where);
	
	$m2_wall=0;
	$m2_wall_b=0;
	$m2_wall_a=0;
	$m2_wall_n=0;
	$m2_wall_d=0;
	
	$m2_window=0;
	$m2_window_b=0;
	$m2_window_a=0;
	$m2_window_n=0;
	$m2_window_d=0;
	
	$m2_window_doors=0;
	$m2_window_wins=0;
	
	foreach($data_window as $window){
		$m2_window += $window["w"]*$window["h"];
	}
	
	foreach($data_wall as $wall){
		$m2_wall += $wall["l"]*$wall["h"] + ($wall["l"]*$wall["dy"])/2;
		if($wall["g_type"]==0 OR $wall["g_type"]==1){$m2_wall_b += $wall["l"]*$wall["h"] + ($wall["l"]*$wall["dy"])/2;}
		if($wall["g_type"]==2){$m2_wall_a += $wall["l"]*$wall["h"] + ($wall["l"]*$wall["dy"])/2;}
		if($wall["g_type"]==3){$m2_wall_n += $wall["l"]*$wall["h"] + ($wall["l"]*$wall["dy"])/2;}
		if($wall["g_type"]==4){$m2_wall_d += $wall["l"]*$wall["h"] + ($wall["l"]*$wall["dy"])/2;}
		
		$data_windows = $database->select("meletes_zone_diafani","*",array("wall_id"=>$wall["id"]) );
			foreach($data_windows as $window){
			$m2_wall -= $window["w"]*$window["h"];
				if($wall["g_type"]==0 OR $wall["g_type"]==1){$m2_window_b += $window["w"]*$window["h"];$m2_wall_b -= $window["w"]*$window["h"];}
				if($wall["g_type"]==2){$m2_window_a += $window["w"]*$window["h"];$m2_wall_a -= $window["w"]*$window["h"];}
				if($wall["g_type"]==3){$m2_window_n += $window["w"]*$window["h"];$m2_wall_n -= $window["w"]*$window["h"];}
				if($wall["g_type"]==4){$m2_window_d += $window["w"]*$window["h"];$m2_wall_d -= $window["w"]*$window["h"];}
				
				if($window["type"]==0 OR $window["type"]==2){
					$m2_window_doors += $window["w"]*$window["h"];
				}
				if($window["type"]==1){
					$m2_window_wins += $window["w"]*$window["h"];
				}
							
			}
	}
	
	$m2_dap=0;
	$m2_dap_mthx=0;
	$m2_dap_air=0;
	$m2_dap_edafos=0;
	
	foreach($data_dapeda as $dapeda){
		$m2_dap += $dapeda["e"];
		if($dapeda["type"]==0){$m2_dap_edafos += $dapeda["e"];}
		if($dapeda["type"]==1){$m2_dap_mthx += $dapeda["e"];}
		if($dapeda["type"]==2){$m2_dap_air += $dapeda["e"];}
	}
	
	$m2_oro=0;
	$m2_oro_mthx=0;
	$m2_oro_air=0;
	
	foreach($data_orofes as $orofes){
		$m2_oro += $orofes["e"];
		if($orofes["type"]==0){$m2_oro_air += $orofes["e"];}
		if($orofes["type"]==1){$m2_oro_mthx += $orofes["e"];}
	}
	
	$data_dap = $database->select("meletes_zone_adiafani","*",$where);
	
	$return = array(
		$m2_wall,
		$m2_window,
		$m2_dap,
		$m2_oro,
		$m2_wall_b,
		$m2_wall_a,
		$m2_wall_n,
		$m2_wall_d,
		$m2_window_b,
		$m2_window_a,
		$m2_window_n,
		$m2_window_d,
		$m2_dap_mthx,
		$m2_dap_air,
		$m2_dap_edafos,
		$m2_oro_mthx,
		$m2_oro_air,
		$m2_window_doors,
		$m2_window_wins
	);
	//επιστρέφει array για javascript
	return json_encode($return);
}

//Καλείται στη φόρτωση του μενού κελύφους για την προεπισκόπηση των στοιχείων
//type: 0:Κτίριο, 1:ζώνη, 2:κέλυφος ζώνης, 3:διαχωριστικές ζώνης, 4:συστήματα ζώνης, 5:κέλυφος μθχ/ηλιακού χώρου
//id: Το id της ζώνης ή του μθχ που ζητάμε. 
//Ανάλογα με τον τύπο επιστρέφονται οι επόμενες function του τύπου preview_tables_*******
function get_meletes_preview($type, $id){

	//Σύνδεση με τη βάση
	$database = new medoo(DB_NAME);
	
	$txt = "";
	
	if($type==9){
		$txt.= preview_tables_general();
	}
	
	if($type==0){
		$txt.= preview_tables_ktirio();
	}
	
	if($type==1){
		$txt.= preview_tables_zone($id);
	}
	
	if($type==3){
		$txt.= "Διαχωριστικές";
	}
	
	if($type==4){//Συστήματα
		$txt.= preview_tables_systems($id);
	}//Συστήματα
	
	if($type==2 OR $type==5){//Κέλυφος ζώνης ή ΜΘX
		$txt.= preview_tables_kelyfos($type,$id);
	}//Κέλυφος ζώνης ή ΜΘΧ
	
	return $txt;
}


//preview - Καρτέλα: Γενικά στοιχεία
function preview_tables_general(){
	$database = new medoo(DB_NAME);
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$data = $database->select("user_meletes","*",$where);
	$data=$data[0];
	
	//Χρήση κτιρίου
	$xrisi_id=$data["xrisi"];
	$xrisi = $database->select("vivliothiki_conditions","xrisi",array("id"=>$xrisi_id));
	$xrisi = $xrisi[0];
	
	//Τμήμα
	if($data["tmima"]==1){
		$tmima="checked";
	}else{
		$tmima="";
	}
	$tmima="<input type=\"checkbox\" ".$tmima." disabled>";
	
	//Κλιματική ζώνη
	$climate_id=$data["climate"]+1;
	$climate = $database->select("vivliothiki_climate_places","place",array("id"=>$climate_id));
	$climate=$climate[0];
	
	//Ύψος
	if($data["height"]==1){
		$height="checked";
	}else{
		$height="";
	}
	$height="<input type=\"checkbox\" ".$height." disabled>";
	
	//Κλιματική ζώνη
	$climate_zone = $database->select("vivliothiki_climate_places","zone",array("id"=>$climate_id));
	$climate_zone = $climate_zone[0];
	if($climate_zone=="a"){$climate_zone="A";}
	if($climate_zone=="b"){$climate_zone="Β";}
	if($climate_zone=="c"){$climate_zone="Γ";}
	if($climate_zone=="d"){$climate_zone="Δ";}
	
	$array_kathestos=array(
		0=>"Δημόσιο",
		1=>"Ιδιωτικό",
		2=>"Δημόσιο ιδιωτικού ενδιαφέροντος",
		3=>"Ιδιωτικό δημοσίου ενδιαφέροντος"
	);
	$array_ypeythinos=array(
		0=>"Ιδιοκτήτης",
		1=>"Διαχειριστής",
		2=>"Ενοικιαστής",
		3=>"Τεχνικός Υπεύθυνος",
		4=>"Άλλο"
	);
	
	$txt.= "<div class=\"row\">
		<div class=\"row\">
		<div class=\"col-md-5\">Χρήση κτιρίου: </div>
		<div class=\"col-md-7 bg-warning\">".$xrisi."</div>
		</div><br/>
		<div class=\"row\">
		<div class=\"col-md-5\">Τμήμα κτιρίου: </div>
		<div class=\"col-md-7 bg-warning\">".$tmima." - ".$data["tmima_ar"]."</div>
		</div>
		<div class=\"row\">
		<div class=\"col-md-5\">ΚΑΕΚ: </div>
		<div class=\"col-md-7 bg-warning\">".$data["kaek"]."</div>
		</div>
		<div class=\"row\">
		<div class=\"col-md-5\">Όνομα ιδιοκτήτη: </div>
		<div class=\"col-md-7 bg-warning\">".$data["idioktitis"]."</div>
		</div>
		<div class=\"row\">
		<div class=\"col-md-5\">Ιδιοκτησιακό καθεστώς: </div>
		<div class=\"col-md-7 bg-warning\">".$array_kathestos[$data["idio_kathestos"]]."</div>
		</div>
		<div class=\"row\">
		<div class=\"col-md-5\">Ταχυδρομική διεύθυνση: </div>
		<div class=\"col-md-7 bg-warning\">".$data["address"]."</div>
		</div>
		<div class=\"row\">
		<div class=\"col-md-5\">Στοιχεία επικοινωνίας υπευθύνου: </div>
		<div class=\"col-md-7 bg-warning\">".$array_ypeythinos[$data["ypeythinos_type"]]."</div>
		</div>
		<div class=\"row\">
		<div class=\"col-md-5\">Ονοματεπώνυμο: </div>
		<div class=\"col-md-7 bg-warning\">".$data["ypeythinos_name"]."</div>
		</div>
		<div class=\"row\">
		<div class=\"col-md-5\">Τηλέφωνο/Fax: </div>
		<div class=\"col-md-7 bg-warning\">".$data["ypeythinos_tel"]."</div>
		</div>
		<div class=\"row\">
		<div class=\"col-md-5\">Ηλεκτρονικό ταχυδρομείο: </div>
		<div class=\"col-md-7 bg-warning\">".$data["ypeythinos_mail"]."</div>
		</div>
		</div>
		<hr/>";
	
	//Οικοδομικές άδειες
	$data_adeies = $database->select("meletes_oikad","*",array("meleti_id"=>$_SESSION['meleti_id']));
	$txt.= "<div class=\"panel panel-warning\">";
	$txt .= "<div class=\"panel-heading\">Οικοδομικές άδειες</div>";
	$txt .= "<table class=\"table table-bordered table-hover\">";
	$txt .= "<tr class=\"warning\">
		<td>Κατάσταση κατασκευής</td>
		<td>Σύντομη περιγραφή</td>
		<td>Πηγή</td>
		<td>Έτος οικ. αδ.</td>
		<td>Έτος</td>
		</tr>";
		foreach($data_adeies as $adeia){
			$txt .= "<tr>
			<td>".$adeia["condition"]."</td>
			<td>".$adeia["desc"]."</td>
			<td>".$adeia["datasource"]."</td>
			<td>".$adeia["yearpermit"]."</td>
			<td>".$adeia["year"]."</td>
			</tr>";
		}
	$txt.="</table>";
	$txt.="<div class=\"panel-footer\">Στοιχεία αδειών</div>";//panel footer
	$txt.="</div>";//panel
	
	$txt.= "<hr/>
		<div class=\"col-md-12\">Κλιματολογικά δεδομένα: ".$climate." / Υψόμετρο πάνω από 500m ".$height." / Ζώνη: ".$climate_zone."</div>
		<br/><hr/>";
	
	
	
	$piges_data = $database->select("meletes_stoixeiapea","piges",array("meleti_id"=>$_SESSION['meleti_id']));
	$piges_data = $piges_data[0];
	$piges_check=array();
	for ($i=0; $i<=9; $i++){
		if($piges_data[$i]==1){$checked[$i]="checked";}else{$checked[$i]="";}
	}
		
	$txt.= "Πηγές δεδομένων:<br/>
	<div class=\"row\">
			<div class=\"col-md-4\">
			<div class=\"checkbox\"><label><input type=\"checkbox\" ".$checked[0]." disabled> Αρχιτεκτονικά σχέδια</label></div>
			<div class=\"checkbox\"><label><input type=\"checkbox\" ".$checked[1]." disabled> Η/Μ Σχέδια</label></div>
			</div>
			<div class=\"col-md-4\">
			<div class=\"checkbox\"><label><input type=\"checkbox\" ".$checked[2]." disabled> Φύλλο συντήρησης λέβητα</label></div>
			<div class=\"checkbox\"><label><input type=\"checkbox\" ".$checked[3]." disabled> Φύλλο συντήρησης συστήματος κλιματισμού</label></div>
			<div class=\"checkbox\"><label><input type=\"checkbox\" ".$checked[4]." disabled> Τιμολόγια ενεργειακών καταναλώσεων</label></div>
			<div class=\"checkbox\"><label><input type=\"checkbox\" ".$checked[9]." disabled> Δελτίο αποστολής ή τιμολόγια αγοράς υλικών</label></div>
			</div>
			<div class=\"col-md-4\">
			<div class=\"checkbox\"><label><input type=\"checkbox\" ".$checked[7]." disabled> Έντυπο ενεργειακής επιθεώρησης λέβητα</label></div>
			<div class=\"checkbox\"><label><input type=\"checkbox\" ".$checked[6]." disabled> Έντυπο ενεργειακής επιθεώρησης Συστήματος Θέρμανσης</label></div>
			<div class=\"checkbox\"><label><input type=\"checkbox\" ".$checked[5]." disabled> Έντυπο ενεργειακής επιθεώρησης Συστήματος Κλιματισμού</label></div>
			<div class=\"checkbox\"><label><input type=\"checkbox\" ".$checked[8]." disabled> Πληροφορίες από Ιδιοκτήτη/Διαχειριστή</label></div>
			</div>
		</div>";
	return $txt;
}


//preview - Καρτέλα: Κτίριο
function preview_tables_ktirio(){
	
	$database = new medoo(DB_NAME);
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$building_xwroi = $database->select("meletes_xwroi","*",$where);
	
	//Εμβαδόν και Όγκος κτιρίου
	$building_e=0;
	$building_v=0;
	$building_e_heat=0;
	$building_v_heat=0;
	foreach($building_xwroi as $xwros){
		if($xwros["type"]==0){//Μετράει και εμβαδόν και όγκος
			$xwros_e=$xwros["l"]*$xwros["w"];
			$xwros_v=$xwros_e*$xwros["h"];
		}else{//Μετράει μόνο όγκος (4κλινής σκεπή)
			$xwros_e=0;
			$xwros_v=(1/6)*$xwros["w"]*$xwros["h"]*(2*$xwros["w"]+3*($xwros["l"]-$xwros["w"]));
		}
		$building_e+=$xwros_e;
		$building_v+=$xwros_v;
		if($xwros["zone_id"]!=0){
			$building_e_heat+=$xwros_e;
			$building_v_heat+=$xwros_v;
		}
	}
	
	//Χρήση και μισός όγκος αν το κτίριο είναι κατοικία
	$building_data = $database->select("user_meletes","*",array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id'])));
	$building_data = $building_data[0];
	$building_xrisi = $database->select("vivliothiki_conditions_building","name",array("id"=>$building_data["xrisi"]));
	$building_xrisi = $building_xrisi[0];
	
	if($building_data["xrisi"]==1 OR $building_data["xrisi"]==2){
		$building_e_cold=$building_e_heat/2;
		$building_v_cold=$building_v_heat/2;
	}else{
		$building_e_cold=$building_e_heat;
		$building_v_cold=$building_v_heat;
	}
	
	//Ύψος ορόφων, συνθήκες άνεσης, κλπ
	$building_datapea = $database->select("meletes_stoixeiapea","*",$where);
	$building_datapea = $building_datapea[0];
	
	$building_thermokat = $building_datapea["thermo_kat"];
	$building_levels = $building_datapea["levels"];
	$building_typicalh = $building_datapea["typical_h"];
	$building_floorh = $building_datapea["floor_h"];
	$building_ekthesi = $building_datapea["ekthesi"];
	$building_synthikes = $building_datapea["synthikes"];
	$array_ekthesi=array(
		0=>"Εκτεθειμένο",
		1=>"Ενδιάμεσο",
		2=>"Προστατευμένο",
	);
	//Αριθμός ζωνών, ΜΘΧ, Ηλιακών
	$where_mthxs=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'], "type"=>"0"));
	$where_solars=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'], "type"=>"1"));
	$building_zones = $database->count("meletes_zones",$where);
	$building_mthxs = $database->count("meletes_mthx",$where_mthxs);
	$building_solars = $database->count("meletes_mthx",$where_solars);
	
	$txt = "";
	$txt.= "<div class=\"tabbable tabs-left\">";
	$txt.= "<ul class=\"nav nav-pills red\">
			<li class=\"active\"><a href=\"#ktiriotab_1\" data-toggle=\"tab\"><i class=\"fa fa-fire\"></i> Γενικά</a></li>
			<li><a href=\"#ktiriotab_2\" data-toggle=\"tab\"><i class=\"fa fa-snowflake-o\"></i> Ύδρευση</a></li>
			<li><a href=\"#ktiriotab_3\" data-toggle=\"tab\"><i class=\"fa fa-bath\"></i> Ανελκυστήρες</a></li>
			<li><a href=\"#ktiriotab_4\" data-toggle=\"tab\"><i class=\"fa fa-sun-o\"></i> ΣΗΘ</a></li>
			<li><a href=\"#ktiriotab_5\" data-toggle=\"tab\"><i class=\"fa fa-lightbulb-o\"></i> Φωτοβολταϊκά</a></li>
			<li><a href=\"#ktiriotab_6\" data-toggle=\"tab\"><i class=\"fa fa-flag\"></i> Ανεμογεννήτριες</a></li></ul>";
	
	$txt.= "<div class=\"tab-content\">";
	
	$txt.= "<div class=\"tab-pane active\" id=\"ktiriotab_1\">";//Γενικά
		$txt.= "<br/>";
		
		$txt.= "<div class=\"row\">
				<div class=\"col-md-2\">Περιγραφή: </div>
				<div class=\"col-md-2\"><span class=\"bg-warning\">Υπάρχον κτίριο</span></div>
				</div><br/>";
		$txt.= "<div class=\"row\">
				<div class=\"col-md-2\">Χρήση κτιρίου: </div>
				<div class=\"col-md-4\"><span class=\"bg-warning\">".$building_xrisi."</span></div>
				</div><br/>";
		$txt.= "<div class=\"row\">
				<div class=\"col-md-2\">Συνολική επιφάνεια (m<sup>2</sup>): </div>
				<div class=\"col-md-1\"><span class=\"bg-warning\">".$building_e."</span></div>
				<div class=\"col-md-2\">Συνολικός όγκος (m<sup>3</sup>): </div>
				<div class=\"col-md-1\"><span class=\"bg-warning\">".$building_v."</span></div>
				</div>";
		$txt.= "<div class=\"row\">
				<div class=\"col-md-2\">Ωφέλιμη επιφάνεια (m<sup>2</sup>): </div>
				<div class=\"col-md-1\"><span class=\"bg-warning\">".$building_e_heat."</span></div>
				<div class=\"col-md-2\">Ωφέλιμος όγκος (m<sup>3</sup>): </div>
				<div class=\"col-md-1\"><span class=\"bg-warning\">".$building_v_heat."</span></div>
				</div>";
		$txt.= "<div class=\"row\">
				<div class=\"col-md-2\">Ψυχόμενη επιφάνεια (m<sup>2</sup>): </div>
				<div class=\"col-md-1\"><span class=\"bg-warning\">".$building_e_cold."</span></div>
				<div class=\"col-md-2\">Ψυχόμενος όγκος (m<sup>3</sup>): </div>
				<div class=\"col-md-1\"><span class=\"bg-warning\">".$building_v_cold."</span></div>
				</div>";
		$txt.= "<div class=\"row\">
				<div class=\"col-md-2\">Αριθμός ορόφων: </div>
				<div class=\"col-md-1\"><span class=\"bg-warning\">".$building_levels."</span></div>
				<div class=\"col-md-2\">Ύψος τυπικού ορόφου (m): </div>
				<div class=\"col-md-1\"><span class=\"bg-warning\">".$building_typicalh."</span></div>
				<div class=\"col-md-2\">Ύψος ισογείου (m): </div>
				<div class=\"col-md-1\"><span class=\"bg-warning\">".$building_floorh."</span></div>
				</div>";
		$txt.= "<div class=\"row\">
				<div class=\"col-md-2\">Έκθεση κτιρίου: </div>
				<div class=\"col-md-2\"><span class=\"bg-warning\">".$array_ekthesi[$building_ekthesi]."</span></div>
				</div><br/>";
		$txt.= "<div class=\"row\">
				<div class=\"col-md-2\">Αριθμός θερμικών ζωνών: </div>
				<div class=\"col-md-1\"><span class=\"bg-warning\">".$building_zones."</span></div>
				</div>";
		$txt.= "<div class=\"row\">
				<div class=\"col-md-2\">Αριθμός μη θερμαινόμενων χώρων: </div>
				<div class=\"col-md-1\"><span class=\"bg-warning\">".$building_mthxs."</span></div>
				<div class=\"col-md-2\">Αριθμός ηλιακών χώρων: </div>
				<div class=\"col-md-1\"><span class=\"bg-warning\">".$building_solars."</span></div>
				</div>";
		$txt.= "<hr>";
	
	$building_katanalwsi = $database->select("meletes_katanalwseis","*",$where);
	$array_katanalwsi=array(
	0=>"Ηλεκτρική",
	1=>"Πετρέλαιο θέρμανσης",
	2=>"Πετρέλαιο κίνησης",
	3=>"Φυσικο αέριο",
	4=>"Υγραέριο",
	5=>"Βιομάζα",
	6=>"Τηλεθέρμανση"
	);
	$array_monades=array(
	0=>"kWh",
	1=>"lt",
	2=>"lt",
	3=>"Nm<sup>3</sup>",
	4=>"Nm<sup>3</sup>",
	5=>"Kg",
	6=>"kWh"
	);
	$txt.= "<div class=\"panel panel-warning\">";
	$txt .= "<div class=\"panel-heading\">Στοιχεία καταναλώσεων</div>";
	$txt .= "<table class=\"table table-bordered table-hover\">";
	$txt .= "<tr class=\"warning\">
		<td>Τύπος</td>
		<td>Θέρμανση</td>
		<td>Ψύξη</td>
		<td>Αερισμός</td>
		<td>ΖΝΧ</td>
		<td>Φωτισμός</td>
		<td>Συσκευές</td>
		<td>Κατανάλωση</td>
		<td>Μονάδες</td>
		<td>Περίοδος κατανάλωσης</td>
		</tr>";
		foreach($building_katanalwsi as $katanalwsi){
			$txt .= "<tr>
			<td>".$array_katanalwsi[$katanalwsi["pigi"]]."</td>
			<td>".$katanalwsi["therm"]."</td>
			<td>".$katanalwsi["cold"]."</td>
			<td>".$katanalwsi["air"]."</td>
			<td>".$katanalwsi["znx"]."</td>
			<td>".$katanalwsi["lights"]."</td>
			<td>".$katanalwsi["syskeyes"]."</td>
			<td>".$katanalwsi["katanalwsi"]."</td>
			<td>".$array_monades[$katanalwsi["pigi"]]."</td>
			<td>".$katanalwsi["periodos"]."</td>
			</tr>";
		}
	$txt.="</table>";
	$txt.="<div class=\"panel-footer\">Στοιχεία καταναλώσεων</div>";//panel footer
	$txt.="</div>";//panel
		
		
		if($building_synthikes[0]==1){$building_synthikes0="checked";}else{$building_synthikes0="";}
		if($building_synthikes[1]==1){$building_synthikes1="checked";}else{$building_synthikes1="";}
		if($building_synthikes[2]==1){$building_synthikes2="checked";}else{$building_synthikes2="";}
		if($building_synthikes[3]==1){$building_synthikes3="checked";}else{$building_synthikes3="";}
		$txt.= "<div class=\"row\">
				<div class=\"col-md-3\"><input type=\"checkbox\" disabled ".$building_synthikes0.">Συνθήκες θερμικής άνεσης</div>
				<div class=\"col-md-3\"><input type=\"checkbox\" disabled ".$building_synthikes1.">Συνθήκες ακουστικής άνεσης</div>
				<div class=\"col-md-3\"><input type=\"checkbox\" disabled ".$building_synthikes2.">Συνθήκες οπτικής άνεσης</div>
				<div class=\"col-md-3\"><input type=\"checkbox\" disabled ".$building_synthikes3.">Ποιότητα εσωτερικού αέρα</div>
				</div>";
	$txt.= "</div>";//Γενικά
	
	$txt.= "<div class=\"tab-pane\" id=\"ktiriotab_2\">";//Ύδρευση
		$txt.= "<br/>";
		$building_ydreysi = $database->select("meletes_ydreysi","*",$where);
		$array_ydreysi=array(
		0=>"Ύδρευση",
		1=>"Άρδευση",
		2=>"Αποχέτευση"
		);
		$txt.= "<div class=\"panel panel-warning\">";
		$txt .= "<div class=\"panel-heading\">Ύδρευση, Άρδευση, Αποχέτευση</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"warning\">
			<td>Τύπος δικτύου</td>
			<td>Αριθμός</td>
			<td>Ισχύς (kW)</td>
			<td>Χρόνος λειτουργίας (hr)</td>
			<td>Ρυθμ. στροφών</td>
			</tr>";
			foreach($building_ydreysi as $ydreysi){
				$txt .= "<tr>
				<td>".$array_ydreysi[$ydreysi["type"]]."</td>
				<td>".$ydreysi["n"]."</td>
				<td>".$ydreysi["p"]."</td>
				<td>".$ydreysi["t"]."</td>
				<td>".$ydreysi["s"]."</td>
				</tr>";
			}
		$txt.="</table>";
		$txt.="<div class=\"panel-footer\">Στοιχεία ύδατος/ακαθάρτων</div>";//panel footer
		$txt.="</div>";//panel
	$txt.= "</div>";//Ύδρευση
	
	$txt.= "<div class=\"tab-pane\" id=\"ktiriotab_3\">";//Ανελκυστήρες
		$txt.= "<br/>";
		$building_anelkystires = $database->select("meletes_anelkystires","*",$where);
		$array_anelkystires=array(
		0=>"Μηχανικός ανελκυστήρας",
		1=>"Υδραυλικός ανελκυστήρας",
		2=>"Κυλιόμενες σκάλες",
		3=>"Κυλιόμενοι διάδρομοι"
		);
		$txt.= "<div class=\"panel panel-warning\">";
		$txt .= "<div class=\"panel-heading\">Ανελκυστήρες</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"warning\">
			<td>Τύπος δικτύου</td>
			<td>Αριθμός</td>
			<td>Ισχύς (kW)</td>
			<td>Χρόνος λειτουργίας (hr)</td>
			<td>Αυτοματισμοί</td>
			</tr>";
			foreach($building_anelkystires as $anelkystires){
				$txt .= "<tr>
				<td>".$array_anelkystires[$anelkystires["type"]]."</td>
				<td>".$anelkystires["n"]."</td>
				<td>".$anelkystires["p"]."</td>
				<td>".$anelkystires["t"]."</td>
				<td>".$anelkystires["a"]."</td>
				</tr>";
			}
		$txt.="</table>";
		$txt.="<div class=\"panel-footer\">Στοιχεία ανελκυστήρων</div>";//panel footer
		$txt.="</div>";//panel
	$txt.= "</div>";//Ανελκυστήρες
	
	$txt.= "<div class=\"tab-pane\" id=\"ktiriotab_4\">";//Σηθ
		$txt.= "<br/>";
		$building_sith = $database->select("meletes_sith","*",$where);
		$array_sith_type=array(
			0=>"Κυψέλες καυσίμου",
			1=>"Μηχανή Stirling",
			2=>"Μηχανή OTTO",
			3=>"Μηχανή DIESEL",
			4=>"Μικροτουρμπίνα",
			5=>"Ατμοστρόβιλος απομάστευσης",
			6=>"Αεριοστρόβιλος με λέβητα ανάκτησης"
		);
		$array_sith_pigi=array(
			0=>"Υγραέριο (LPG)",
			1=>"Φυσικο αέριο",
			2=>"Ηλεκτρισμός",
			3=>"Πετρέλαιο θέρμανσης",
			4=>"Πετρέλαιο κίνησης",
			5=>"Τηλεθέρμανση (ΑΠΕ)",
			6=>"Τηλεθέρμανση (ΔΕΗ)",
			7=>"Βιομάζα",
			8=>"Βιομάζα τυποποιημένη"
		);
		$txt.= "<div class=\"panel panel-warning\">";
		$txt .= "<div class=\"panel-heading\">Μονάδες συμπαραγωγής</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"warning\">
			<td>Μονάδα</td>
			<td>Πηγή Ενέργειας</td>
			<td>Βαθμ. απόδοσης ηλεκτρικής ενέργειας</td>
			<td>Βαθμ. απόδοσης θερμικής ενέργειας</td>
			</tr>";
			foreach($building_sith as $sith){
				$txt .= "<tr>
				<td>".$array_sith_type[$sith["type"]]."</td>
				<td>".$array_sith_pigi[$sith["pigi"]]."</td>
				<td>".$anelkystires["n_elec"]."</td>
				<td>".$anelkystires["n_therm"]."</td>
				</tr>";
			}
		$txt.="</table>";
		$txt.="<div class=\"panel-footer\">Μονάδες συμπαραγωγής</div>";//panel footer
		$txt.="</div>";//panel
	$txt.= "</div>";//Σηθ
	
	$txt.= "<div class=\"tab-pane\" id=\"ktiriotab_5\">";//PV
		$txt.= "<br/>";
		$building_pv = $database->select("meletes_pv","*",$where);
		$array_pv=array(
		0=>"Μονοκρυσταλλικό",
		1=>"Πολυκρυσταλλικό",
		2=>"Λεπτού υμένα άμορφο a-S",
		3=>"Λεπτού υμένα μικρομορφικό μ-Si",
		4=>"Λεπτού υμένα CIS-CIGS",
		5=>"Λεπτού υμένα Cd-Te",
		6=>"Τριπλής επαφής (Triple junction)"
		);
		$txt.= "<div class=\"panel panel-warning\">";
		$txt .= "<div class=\"panel-heading\">Φωτοβολταϊκά</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"warning\">
			<td>Τύπος</td>
			<td>Συν. Α. (-)</td>
			<td>Επιφάνεια (m<sup>2</sup>)</td>
			<td>Ισχύς (kW)</td>
			<td>γ (deg)</td>
			<td>β (deg)</td>
			<td>F_s (-)</td>
			</tr>";
			foreach($building_pv as $pv){
				$txt .= "<tr>
				<td>".$array_pv[$pv["type"]]."</td>
				<td>".$pv["n"]."</td>
				<td>".$pv["e"]."</td>
				<td>".$pv["p"]."</td>
				<td>".$pv["g"]."</td>
				<td>".$pv["b"]."</td>
				<td>".$pv["f_s"]."</td>
				</tr>";
			}
		$txt.="</table>";
		$txt.="<div class=\"panel-footer\">Φωτοβολταϊκά (αυτόνομα)</div>";//panel footer
		$txt.="</div>";//panel
	$txt.= "</div>";//PV
	
	$txt.= "<div class=\"tab-pane\" id=\"ktiriotab_6\">";//WIND
		$txt.= "<br/>";
		$building_wind = $database->select("meletes_anemogenitries","*",$where);
		$array_wind=array(
		0=>"Αυτόνομο",
		1=>"Διασυνδεδεμένο"
		);
		$txt.= "<div class=\"panel panel-warning\">";
		$txt .= "<div class=\"panel-heading\">Ανεμογεννήτριες</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"warning\">
			<td>Τύπος</td>
			<td>Ισχύς (kW)</td>
			<td>Συντελεστής Ισχύος (-)</td>
			<td>Χώρος τοποθέτησης</td>
			</tr>";
			foreach($building_wind as $wind){
				$txt .= "<tr>
				<td>".$array_wind[$wind["type"]]."</td>
				<td>".$wind["p"]."</td>
				<td>".$wind["p"]."</td>
				<td>".$wind["xwros"]."</td>
				</tr>";
			}
		$txt.="</table>";
		$txt.="<div class=\"panel-footer\">Ανεμογεννήτριες αστικού περιβάλλοντος (δεν λαμβάνονται υπ' όψη)</div>";//panel footer
		$txt.="</div>";//panel
	$txt.= "</div>";//WIND
	
	$txt.= "</div>";//tabs
	
	return $txt;
}


//preview - Καρτέλα: Ζώνη με $id
function preview_tables_zone($id){
	
	$database = new medoo(DB_NAME);
	$where_id=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'], "id"=>$id));
	$data_zone = $database->select("meletes_zones","*",$where_id);
	$data_zone=$data_zone[0];
	
	$where_zoneid=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'], "zone_id"=>$id));
	$data_xwroi = $database->select("meletes_xwroi","*",$where_zoneid);
	
	//Όνομα χρήσης
	$zone_name = $database->select("vivliothiki_conditions_zone","name",array("id"=>$data_zone["xrisi"]));
	$zone_name = $zone_name[0];
	
	//Εμβαδά ζώνης
	$zone_e=0;
	foreach($data_xwroi as $xwros){
		if($xwros["type"]==0){//Μετράει και εμβαδόν και όγκος
			$xwros_e=$xwros["l"]*$xwros["w"];
			$xwros_v=$xwros_e*$xwros["h"];
		}else{//Μετράει μόνο όγκος (4κλινής σκεπή)
			$xwros_e=0;
			$xwros_v=(1/6)*$xwros["w"]*$xwros["h"]*(2*$xwros["w"]+3*($xwros["l"]-$xwros["w"]));
		}
		$zone_e+=$xwros_e;
	}
	
	//Μέση κατανάλωση ΖΝΧ με βάση τη χρήση
	//Υπολογισμός με εμβαδόν, κλίνες, κλίνες και τύπο ξενοδοχείου, κλίνες και τύπο κλινικής
	//Εάν ο τύπος ΖΝΧ είναι υπολογισμός με βάση τον τύπο του ξενοδοχείου
	if($zone_data[0]["znx_calc_type"]==0){//ΜΕ ΒΑΣΗ ΔΟΜΗΜΕΝΗ ΕΠΙΦΑΝΕΙΑ
		$znx_year=$zone_e*$zone_data[0]["znx_m3_perm2"];
	}
	
	if($zone_data[0]["znx_calc_type"]==1){//ΜΕ ΒΑΣΗ ΚΛΙΝΕΣ (πχ ΜΟΝΟΚΑΤΟΙΚΙΕΣ)
		$znx_year=$zones["klines"]*$zone_data[0]["znx_m3_perroom"];
	}
	
	if($zone_data[0]["znx_calc_type"]==2){//ΜΕ ΒΑΣΗ ΚΛΙΝΕΣ ΚΑΙ ΤΥΠΟ ΞΕΝΟΔΟΧΕΙΟΥ
		if($zone_data[0]["id"]==2 OR $zone_data[0]["id"]==3){//Ξενοδοχείο ετήσιας λειτουργίας
			$hotel_type=1;
		}
		if($zone_data[0]["id"]==5 OR $zone_data[0]["id"]==6){//Ξενοδοχείο θερινής λειτουργίας
			$hotel_type=2;
		}
		if($zone_data[0]["id"]==8 OR $zone_data[0]["id"]==9){//Ξενοδοχείο χειμερινής λειτουργίας
			$hotel_type=3;
		}
		$where_hotel=array("AND"=>array("hotel_type"=>$hotel_type,"category"=>$zones["hotel"]));
		$data_hotels = $database->select("vivliothiki_conditions_znx_hotels",$columns,$where_hotel);
		$zone_data[0]["znx_lt_perperson"]=$data_hotels[0]["znx_lt_perperson"];
		$zone_data[0]["znx_lt_perm2"]=$data_hotels[0]["znx_lt_perm2"];
		$zone_data[0]["znx_m3_perroom"]=$data_hotels[0]["znx_m3_perroom"];
		$zone_data[0]["znx_m3_perm2"]=$data_hotels[0]["znx_m3_perm2"];
		
		$znx_year=$zones["klines"]*$zone_data[0]["znx_m3_perroom"];
	}
	
	//Εάν ο τύπος ΖΝΧ είναι υπολογισμός με βάση τον τύπο κλινικής - νοσοκομείου
	if($zone_data[0]["znx_calc_type"]==3){//ΜΕ ΒΑΣΗ ΚΛΙΝΕΣ ΚΑΙ ΤΥΠΟ ΚΛΙΝΙΚΗΣ
		$where_hospital=array("id"=>$zones["hospital"]);
		$data_hospitals = $database->select("vivliothiki_conditions_znx_hospitals",$columns,$where_hospital);
		$zone_data[0]["znx_lt_perperson"]=$data_hospitals[0]["znx_lt_perperson"];
		$zone_data[0]["znx_lt_perm2"]=$data_hospitals[0]["znx_lt_perm2"];
		$zone_data[0]["znx_m3_perroom"]=$data_hospitals[0]["znx_m3_perroom"];
		$zone_data[0]["znx_m3_perm2"]=$data_hospitals[0]["znx_m3_perm2"];
		
		$znx_year=$zones["klines"]*$zone_data[0]["znx_m3_perroom"];
	}
	
	
	//Διατάξεις ΖΝΧ
	if($data_zone["auto_znx"]==1){
		$auto_znx="checked";
	}else{
		$auto_znx="";
	}
	
	$txt = "";
	$txt.= "<div class=\"row\">";
	$txt.= "<div class=\"col-md-2\">Χρήση: </div>
		<div class=\"col-md-8\"><span class=\"bg-warning\">".$zone_name."</span></div>
		</div><hr>";
		
	$txt.="<div class=\"row\">
		<div class=\"col-md-2\">Συνολική επιφάνεια (m<sup>2</sup>): </div>
		<div class=\"col-md-1\">".$zone_e." </div>
		<div class=\"col-md-2\">Μέση κατανάλωση ΖΝΧ (m<sup>3</sup>/έτος): </div>
		<div class=\"col-md-1\">".$znx_year." </div>
		<div class=\"col-md-2\">Διατάξεις αυτόματου ελέγχου ΖΝΧ: </div>
		<div class=\"col-md-1\"><input type=\"checkbox\" disabled ".$auto_znx."> </div>
		</div>";
	
	$txt.="<div class=\"row\">
		<div class=\"col-md-2\">Ανηγμένη θερμοχωρητικότητα (KJ/m<sup>2</sup>*K): </div>
		<div class=\"col-md-1\">".$data_zone["thermo"]." </div>
		</div>";
	
	$array_auto=array(
		0=>"Τύπος Α",
		1=>"Τύπος Β",
		2=>"Τύπος Γ",
		3=>"Τύπος Δ",
	);
	$txt.="<div class=\"row\">
		<div class=\"col-md-2\">Κατηγορία διατάξεων ελέγχου - αυτοματισμών: </div>
		<div class=\"col-md-1\">Θέρμανση </div>
		<div class=\"col-md-1\">".$array_auto[$data_zone["auto_heat"]]." </div>
		<div class=\"col-md-1\">Ψύξη </div>
		<div class=\"col-md-1\">".$array_auto[$data_zone["auto_cold"]]." </div>
		</div><hr>";
	
	//Αερισμός από κουφώματα
	$aerismos=0;
	$data_diafani = $database->select("meletes_zone_diafani","*",$where_zoneid);
	foreach($data_diafani as $diafanes){
		$diafanes_wind = $diafanes["w"]*$diafanes["h"]*$diafanes["wind"];
		$aerismos+=$diafanes_wind;
	}
	$txt.="<div class=\"row\">
		Διείσδυση αέρα<br/><br/>
		<div class=\"col-md-2\">Διείσδυση αέρα από κουφώματα (m<sub>3</sub>/h): </div>
		<div class=\"col-md-1\">".$aerismos." </div>
		</div>
		<div class=\"row\">
		<div class=\"col-md-2\">Αρ. καμινάδων: </div>
		<div class=\"col-md-1\">".$data_zone["kaminades"]." </div>
		<div class=\"col-md-2\">Αρ. θυρίδων εξαερισμού: </div>
		<div class=\"col-md-1\">".$data_zone["thyrides"]." </div>
		<div class=\"col-md-2\">Αρ. εξώθυρων: </div>
		<div class=\"col-md-1\">".$data_zone["thyrides"]." </div>
		</div><hr>";
	$txt.="<div class=\"row\">
		Υβριδικό σύστημα δροσισμού<br/><br/>
		<div class=\"col-md-2\">Αριθμός ανεμιστήρων οροφής: </div>
		<div class=\"col-md-1\">".$data_zone["anemistires"]." </div>
		</div><hr>";		
	
		
	$txt.="</div>";
	
	return $txt;
}


//preview - Καρτέλα: Πίνακες κελύφους ζώνης ή ΜΘΧ
//Να προστεθούν οι διαχωριστικές
function preview_tables_kelyfos($type,$id){
	
	$database = new medoo(DB_NAME);
	//στοιχεία κτιρίου γενικά
	$building_data = $database->select("user_meletes","*",array("id"=>$_SESSION['meleti_id']));
	$building_g = $building_data[0]["pros"];
	
	if($type==2){//Ζώνης
		$where_zone=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$id));
		$zone_wall = $database->select("meletes_zone_adiafani","*",$where_zone);
		$zone_window = $database->select("meletes_zone_diafani","*",$where_zone);
		$zone_dapeda = $database->select("meletes_zone_dapeda","*",$where_zone);
		$zone_orofes = $database->select("meletes_zone_orofes","*",$where_zone);
		$table_windows="meletes_zone_diafani";
	}
	if($type==5){//ΜθΧ
		$where_mthx=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"mthx_id"=>$id));
		$zone_wall = $database->select("meletes_mthx_adiafani","*",$where_mthx);
		$zone_window = $database->select("meletes_mthx_diafani","*",$where_mthx);
		$zone_dapeda = $database->select("meletes_mthx_dapeda","*",$where_mthx);
		$zone_orofes = $database->select("meletes_mthx_orofes","*",$where_mthx);
		$table_windows="meletes_mthx_diafani";
	}
	
	$txt = "";
	
	if($type==2){//Ζώνης
	$txt .= "<form class=\"form-inline\">Αριθμός εσωτερικών διαχωριστικών επιφανειών: / ";
		$passive_data = $database->select("meletes_zone_diafani","passive",array("zone_id"=>$id) );//όλα τα ανοίγματα ζώνης
		$passive_no = $database->count("meletes_zone_diafani",array("AND"=>array("zone_id"=>$id, "passive"=>1)) );//όλα τα ανοίγματα ζώνης

		if($passive_no>=1){
			$passive_checked="checked";
		}else{
			$passive_checked="";
		}
	$txt .= "<div class=\"checkbox disabled\"><label><input type=\"checkbox\" value=\"\" ".$passive_checked." disabled> Παθητικά ηλιακά</label></div></form><br/>";
	}
	if($type==3){//Διαχωριστικές
		
	}
	if($type==5){//ΜθΧ
		$mthx_data = $database->select("meletes_xwroi","*",$where_mthx);
		$mthx_e=0;
		foreach($mthx_data as $mthx){
			if($mthx["type"]==0){//Μετράει και εμβαδόν και όγκος
				$mthx_xwros_e=$mthx["l"]*$mthx["w"];
			}else{//Μετράει μόνο όγκος (4κλινής σκεπή)
				$mthx_xwros_e=0;
			}
			$mthx_e+=$mthx_xwros_e;
		}
		$mthx_window_data = $database->select("meletes_mthx_diafani","*",$where_mthx);
		
		$mthx_air=0;
		foreach($mthx_window_data as $mthx_window){
			$mthx_window_air = $mthx_window["w"]*$mthx_window["h"]*$mthx_window["wind"];
			$mthx_air+=$mthx_window_air;
		}
		$txt .= "<form class=\"form-inline\">Συνολική επιφάνεια: ".$mthx_e." / Διείσδυση αέρα: ".$mthx_air." </form><br/>";
	}
	
	
	
	$txt_adiafani = "";
	$txt_adiafani .= "<div class=\"panel panel-warning\">";
	$txt_adiafani .= "<div class=\"panel-heading\">Αδιαφανείς επιφάνειες</div>";
	$txt_adiafani .= "<table class=\"table table-bordered table-hover\">";
	$txt_adiafani .= "<tr class=\"warning\">
	<td><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
	<td><a href=\"#\" title=\"Όνομα στοιχείου\">Όνομα</a></td>
	<td><a href=\"#\" title=\"Προσανατολισμός\">γ</a></td>
	<td><a href=\"#\" title=\"Κλίση\">β</a></td>
	<td><a href=\"#\" title=\"Εμβαδόν\">Ε</a></td>
	<td><a href=\"#\" title=\"Συντ. θερμοπερατότητας\">U</a></td>
	<td><a href=\"#\" title=\"Απορροφητικότητα\">α</a></td>
	<td><a href=\"#\" title=\"Συντ. εκπομπής\">ε</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο ορίζοντα θέρμανσης\">Fhor_h</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο ορίζοντα ψύξης\">Fhor_c</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο πρόβολο θέρμανσης\">Fov_h</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο πρόβολο ψύξης\">Fov_c</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο πλευρικά εμπόδια θέρμανσης\">Ffin_h</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο πλευρικά εμπόδια ψύξης\">Ffin_c</a></td>
	</tr>
	";
	
	$txt_window = "";
	$txt_window .= "<div class=\"panel panel-warning\">";
	$txt_window .= "<div class=\"panel-heading\">Διαφανείς επιφάνειες</div>";
	$txt_window .= "<table class=\"table table-bordered table-hover\">";
	$txt_window .= "<tr class=\"warning\">
	<td><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
	<td><a href=\"#\" title=\"Περιγραφή\">Περιγραφή</a></td>
	<td><a href=\"#\" title=\"Προσανατολισμός\">γ</a></td>
	<td><a href=\"#\" title=\"Κλίση\">β</a></td>
	<td><a href=\"#\" title=\"Εμβαδόν\">Ε</a></td>
	<td><a href=\"#\" title=\"Τύπος ανοίγματος\">Τύπος ανοίγματος*</a></td>
	<td><a href=\"#\" title=\"Συντ. θερμοπερατότητας\">U</a></td>
	<td><a href=\"#\" title=\"Συντελεστής διαπερατότητας στην ηλιακή ακτινοβολία\">gw</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο ορίζοντα θέρμανσης\">Fhor_h</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο ορίζοντα ψύξης\">Fhor_c</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο πρόβολο θέρμανσης\">Fov_h</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο πρόβολο ψύξης\">Fov_c</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο πλευρικά εμπόδια θέρμανσης\">Ffin_h</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο πλευρικά εμπόδια ψύξης\">Ffin_c</a></td>
	</tr>
	";
	
	$txt_passive = "";
	$txt_passive .= "<div class=\"panel panel-warning\">";
	$txt_passive .= "<div class=\"panel-heading\">Άμεσου ηλιακού κέρδους</div>";
	$txt_passive .= "<table class=\"table table-bordered table-hover\">";
	$txt_passive .= "<tr class=\"warning\">
	<td><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
	<td><a href=\"#\" title=\"Περιγραφή\">Περιγραφή</a></td>
	<td><a href=\"#\" title=\"Προσανατολισμός\">γ</a></td>
	<td><a href=\"#\" title=\"Κλίση\">β</a></td>
	<td><a href=\"#\" title=\"Εμβαδόν\">Ε</a></td>
	<td><a href=\"#\" title=\"Τύπος ανοίγματος\">Τύπος ανοίγματος*</a></td>
	<td><a href=\"#\" title=\"Συντ. θερμοπερατότητας\">U</a></td>
	<td><a href=\"#\" title=\"Συντελεστής διαπερατότητας στην ηλιακή ακτινοβολία\">gw</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο ορίζοντα θέρμανσης\">Fhor_h</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο ορίζοντα ψύξης\">Fhor_c</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο πρόβολο θέρμανσης\">Fov_h</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο πρόβολο ψύξης\">Fov_c</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο πλευρικά εμπόδια θέρμανσης\">Ffin_h</a></td>
	<td><a href=\"#\" title=\"Συντελεστής σκίασης απο πλευρικά εμπόδια ψύξης\">Ffin_c</a></td>
	</tr>
	";
	
	$txt_edafos = "";
	$txt_edafos .= "<div class=\"panel panel-warning\">";
	$txt_edafos .= "<div class=\"panel-heading\">Σε επαφή με το έδαφος</div>";
	$txt_edafos .= "<table class=\"table table-bordered table-hover\">";
	$txt_edafos .= "<tr class=\"warning\">
	<td><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
	<td><a href=\"#\" title=\"Περιγραφή\">Περιγραφή</a></td>
	<td><a href=\"#\" title=\"Εμβαδόν\">Ε</a></td>
	<td><a href=\"#\" title=\"Συντ. θερμοπερατότητας\">U</a></td>
	<td><a href=\"#\" title=\"Κατώτερο βάθος\">Κ. Βάθος (m)</a></td>
	<td><a href=\"#\" title=\"Ανώτερο βάθος\">Α. Βάθος (m)</a></td>
	<td><a href=\"#\" title=\"Περίμετρος\">Περίμετρος (m)</a></td>
	</tr>
	";
	
	$data_prefs = $database->select("user_meletes","symptiksi",array("id"=>$_SESSION["meleti_id"]) );
	$symptiksi = $data_prefs[0];
	
	$aa=1;
	foreach($zone_wall as $wall){
	$adiafani_row = "";
		//Διαστάσεις τοίχου
		$wall_l = $wall["l"];
		$wall_h = $wall["h"];
		$wall_dy = $wall["dy"];
		$wall_dx = $wall["dx"];
		
		if($wall["g_type"]==0){
			$wall_g = $wall["g"];
		}else{
			if($wall["g_type"]==1){
			$wall_g = $building_g;
			}
			if($wall["g_type"]==2){
			$wall_g = $building_g+90;
			}
			if($wall["g_type"]==3){
			$wall_g = $building_g+180;
			}
			if($wall["g_type"]==4){
			$wall_g = $building_g+270;
			}
			
			if($wall_g>=360){
				$wall_g=$wall_g-360;
			}
		}
		
		$wall_e_sum = $wall_l*$wall_h + ($wall_l*$wall_dy)/2;
		
		// u τοίχων
			if($wall["u"]!=0){
				$u=$wall["u"];
			}else{
				$data_u = $database->select("user_adiafani","u",array("id"=>$wall['u_id']) );
				$u=$data_u[0];
			}
		// u υποστυλωμάτων
			if($wall["yp_u"]!=0){
				$yp_u=$wall["yp_u"];
			}else{
				$data_yp_u = $database->select("user_adiafani","u",array("id"=>$wall['yp_u_id']) );
				$yp_u=$data_yp_u[0];
			}
		// u δοκών	
			if($wall["dok_u"]!=0){
				$dok_u=$wall["dok_u"];
			}else{
				$data_dok_u = $database->select("user_adiafani","u",array("id"=>$wall['dok_u_id']) );
				$dok_u=$data_dok_u[0];
			}
		// u συρομένων	
			if($wall["syr_u"]!=0){
				$syr_u=$wall["syr_u"];
			}else{
				$data_syr_u = $database->select("user_adiafani","u",array("id"=>$wall['syr_u_id']) );
				$syr_u=$data_syr_u[0];
			}		
			
		// α/ε
			$data_ap = $database->select("vivliothiki_adiafani_a","a",array("id"=>$wall['ap']) );
			$ap=$data_ap[0];
			$data_ek = $database->select("vivliothiki_adiafani_e","e",array("id"=>$wall['ek']) );
			$ek=$data_ek[0];
			
		//Φέρων οργανισμός
			$per = $wall["per"];
		if($per==0){
			//Δοκοί	
			$data_dok = explode("^", $wall["dok"]);
			$dok_e = 0;//Εμβαδόν της δοκού
			$dok_h = 0;//Ύψος της δοκού
			$dok_h_sum = 0;//Συνολικό ύψος δοκών για να αφαιρεθεί στα υποστυλώματα
				for($doki=1; $doki<=count($data_dok)-1; $doki++){
				$dok = explode("|", $data_dok[$doki-1]);
					$dok_h = $dok[0];
					$dok_ar = $dok[1];
					$dok_e += $dok_h*$wall_l;
					$dok_h_sum += $dok_h;//Συνολικό ύψος δοκών για να αφαιρεθεί στα υποστυλώματα
				}	
			
			//Υποστηλώματα
			$data_yp = explode("^", $wall["yp"]);
			$yp_e = 0;
				for($ypi=1; $ypi<=(count($data_yp)-1); $ypi++){
				$yp = explode("|", $data_yp[$ypi-1]);
					$yp_l = $yp[0];
					$yp_e += $yp_l*($wall_h-$dok_h_sum);
				}
		}
		
		//Συρόμενα
		$data_syr = explode("^", $wall["syr"]);
		$syr_e = 0;
			for($syri=1; $syri<=count($data_syr)-1; $syri++){
			$syr = explode("|", $data_syr[$syri-1]);
				$syr_e += $syr[0]*$syr[1];
			}
		
		//με ποσοστό φέρων οργανισμού
		if($per!=0){
			$dok_e=0;
			$yp_e=$wall_e_sum*$per/100;
		}
			
		//Σκιάσεις τοίχου
			$f_type = $wall["f_type"];
			$data_fhor = explode("|", $wall["fhor"]);
			$data_fov = $wall["fov"];
			$data_fovt = explode("|", $wall["fovt"]);
			$data_ffin_l = explode("|", $wall["ffin_l"]);
			$data_ffin_r = explode("|", $wall["ffin_r"]);
			$data_fsh = explode("|", $wall["fsh"]);
			$pros = $wall_g;
			
		if($f_type==0){
			//Σκίαση ορίζοντα
			if( $data_fhor[1]!=0 ){
				$fhor_deg = atan(($data_fhor[1]-$wall["h"]/2) / $data_fhor[0])*180/pi();
				$fhor = calc_skiasi_hor($fhor_deg, $pros);
				$fhor_h = $fhor[0];
				$fhor_c = $fhor[1];
			}else{
				$fhor_h = 1;
				$fhor_c = 1;
			}
			
			//Σκίαση προβόλου
			if( $data_fov!=0 ){
				$fov_deg = atan($data_fov / ($wall["h"]/2))*180/pi();
				$fov = calc_skiasi_ov($fov_deg, $pros);
				$fov_h = $fov[0];
				$fov_c = $fov[1];
			}else{
				$fov_h = 1;
				$fov_c = 1;
			}
			
			//Σκίαση τέντας
			if( $data_fovt[0]!=0 ){
				if( ($data_fovt[1]-($wall["h"]/2))>0 ){
					$fovt_deg = atan($data_fovt_w[0] / ($data_fovt[1]-($wall["h"]/2)) )*180/pi();
				}else{
					$fovt_deg=90;
				}
				
				$fovt = calc_skiasi_ov($fovt_deg, $pros);
				$fov_c = $fovt[1];
			}
			
			//Πλευρικές σκιάσεις
			if( $data_ffin_l[1]!=0 ){
				$ffin_l_deg = atan( $data_ffin_l[1] / ($data_ffin_l[0]+$wall["l"]/2) )*180/pi();
				$ffin_l = calc_skiasi_fin($ffin_l_deg, $pros, 1);
				$ffin_l_h = $ffin_l[0];
				$ffin_l_c = $ffin_l[1];
			}else{
				$ffin_l_h = 1;
				$ffin_l_c = 1;
			}
			if( $data_ffin_r[1]!=0 ){
				$ffin_r_deg = atan( $data_ffin_r[1] / ($data_ffin_r[0]+$wall["l"]/2) )*180/pi();
				$ffin_r = calc_skiasi_fin($ffin_r_deg, $pros, 2);
				$ffin_r_h = $ffin_r[0];
				$ffin_r_c = $ffin_r[1];
			}else{
				$ffin_r_h = 1;
				$ffin_r_c = 1;
			}
			
			$ffin_h = $ffin_l_h*$ffin_r_h;
			$ffin_c = $ffin_l_c*$ffin_r_c;
			$ffin_h = round($ffin_h,3);
			$ffin_c = round($ffin_c,3);
		}//αναλυτικές σκιάσεις
		
		if($f_type==1){
			$fhor_h=0;
			$fhor_c=0;
			$fov_h=0;
			$fov_c=0;
			$ffin_h=0;
			$ffin_c=0;
		}
		if($f_type==2){
			$fhor_h=1;
			$fhor_c=1;
			$fov_h=1;
			$fov_c=1;
			$ffin_h=1;
			$ffin_c=1;
		}
		if($f_type==3){
			$fhor_h=0.9;
			$fhor_c=0.9;
			$fov_h=1;
			$fov_c=1;
			$ffin_h=1;
			$ffin_c=1;
		}
		
		$window_sume=0;
		//Παράθυρα
		$data_window = $database->select($table_windows,"*",array("wall_id"=>$wall['id']) );
		foreach($data_window as $window){
		$window_row = "";
			$window_name=$window["name"];
			$window_w=$window["w"];
			$window_h=$window["h"];
			$window_p=$window["p"];
			$window_apoar=$window["apoar"];
			$window_e=$window["w"]*$window["h"];
			$window_u=$window["u"];
			$window_gw=$window["g_w"];
			$window_ftype=$window["f_type"];
			
			$window_sume += $window_e;
			
			$pros_w = $wall_g;
			
		//σκιάσεις ανοιγμάτων
		if($window_ftype==0 OR $window_ftype==3){//Σκιάσεις αναλυτικά ή από τοίχο
		
			if($window_ftype==0){//αναλυτικά στο άνοιγμα
				$data_fhor_w = explode("|", $window["fhor"]);
				$data_fov_w = $window["fov"];
				$data_fovt_w = explode("|", $window["fovt"]);
				$data_ffin_l_w = explode("|", $window["ffin_l"]);
				$data_ffin_r_w = explode("|", $window["ffin_r"]);
				$data_fsh_w = explode("|", $window["fsh"]);
				
				//Σκίαση ορίζοντα
				if( $data_fhor_w[1]!=0 ){
					$fhor_deg_w = atan(($data_fhor_w[1]-$window_p-$window_h/2) / $data_fhor_w[0])*180/pi();
					$fhor_w = calc_skiasi_hor($fhor_deg_w, $pros_w);
					$fhor_h_w = $fhor_w[0];
					$fhor_c_w = $fhor_w[1];
				}else{
					$fhor_h_w = 1;
					$fhor_c_w = 1;
				}
				
				//Σκίαση προβόλου
				if( $data_fov_w!=0 ){
					$fov_deg_w = atan($data_fov_w / ($wall["h"]-$window_p-$window_h/2) )*180/pi();
					$fov_w = calc_skiasi_ov($fov_deg_w, $pros_w);
					$fov_h_w = $fov_w[0];
					$fov_c_w = $fov_w[1];
				}else{
					$fov_h_w = 1;
					$fov_c_w = 1;
				}
				
				//Σκίαση τέντας
				if( $data_fovt_w[0]!=0 ){
					if( ($data_fovt_w[1]-$window_p-$window_h/2)>0 ){
						$fovt_deg_w = atan($data_fovt_w[0] / ($data_fovt_w[1]-$window_p-$window_h/2) )*180/pi();
					}else{
						$fovt_deg_w=90;
					}
					
					$fovt_w = calc_skiasi_ov($fovt_deg_w, $pros_w);
					$fov_c_w = $fovt_w[1];
				}
				
				//Πλευρικές σκιάσεις
				if( $data_ffin_l_w[1]!=0 ){
					$ffin_l_deg_w = atan( $data_ffin_l_w[1] / ($data_ffin_l_w[0]+$window_w/2) )*180/pi();
					$ffin_l_w = calc_skiasi_fin($ffin_l_deg_w, $pros_w, 1);
					$ffin_l_h_w = $ffin_l_w[0];
					$ffin_l_c_w = $ffin_l_w[1];
				}else{
					$ffin_l_h_w = 1;
					$ffin_l_c_w = 1;
				}
				if( $data_ffin_r_w[1]!=0 ){
					$ffin_r_deg_w = atan( $data_ffin_r_w[1] / ($data_ffin_r_w[0]+$window_w/2) )*180/pi();
					$ffin_r_w = calc_skiasi_fin($ffin_r_deg_w, $pros_w, 2);
					$ffin_r_h_w = $ffin_r_w[0];
					$ffin_r_c_w = $ffin_r_w[1];
				}else{
					$ffin_r_h_w = 1;
					$ffin_r_c_w = 1;
				}
				$ffin_h_w = $ffin_l_h_w*$ffin_r_h_w;
				$ffin_c_w = $ffin_l_c_w*$ffin_r_c_w;
				$ffin_h_w = round($ffin_h_w,3);
				$ffin_c_w = round($ffin_c_w,3);
			}
			
			if($window_ftype==3){//από τοίχο
				if($f_type==1){//πλήρης σκίαση τοίχου
					$fhor_h_w=0;
					$fhor_c_w=0;
					$fov_h_w=0;
					$fov_c_w=0;
					$ffin_h_w=0;
					$ffin_c_w=0;
				}
				if($f_type==2){//ασκίαστος τοίχος
					$fhor_h_w=1;
					$fhor_c_w=1;
					$fov_h_w=1;
					$fov_c_w=1;
					$ffin_h_w=1;
					$ffin_c_w=1;
				}
				if($f_type==3){//U<0.6 τοίχου - ΠΡΟΣΟΧΗ
					$fhor_h_w=0.9;
					$fhor_c_w=0.9;
					$fov_h_w=1;
					$fov_c_w=1;
					$ffin_h_w=1;
					$ffin_c_w=1;
				}
				if($f_type==0){//Αναλυτικές σκιάσεις τοίχου
					$data_fhor_w = explode("|", $wall["fhor"]);
					$data_fov_w = $wall["fov"];
					$data_fovt_w = explode("|", $wall["fovt"]);
					$data_ffin_l_w = explode("|", $wall["ffin_l"]);
					$data_ffin_l_w[0] = $data_ffin_l_w[0] + $window_apoar;
					$data_ffin_r_w = explode("|", $wall["ffin_r"]);
					$data_ffin_r_w[0] = $data_ffin_r_w[0] - $window_apoar;
					$data_fsh_w = explode("|", $wall["fsh"]);
					
					//Σκίαση ορίζοντα
					if( $data_fhor_w[1]!=0 ){
						$fhor_deg_w = atan(($data_fhor_w[1]-$window_p-$window_h/2) / $data_fhor_w[0])*180/pi();
						$fhor_w = calc_skiasi_hor($fhor_deg_w, $pros_w);
						$fhor_h_w = $fhor_w[0];
						$fhor_c_w = $fhor_w[1];
					}else{
						$fhor_h_w = 1;
						$fhor_c_w = 1;
					}
					
					//Σκίαση προβόλου
					if( $data_fov_w!=0 ){
						$fov_deg_w = atan($data_fov_w / ($wall["h"]-$window_p-$window_h/2) )*180/pi();
						$fov_w = calc_skiasi_ov($fov_deg_w, $pros_w);
						$fov_h_w = $fov_w[0];
						$fov_c_w = $fov_w[1];
					}else{
						$fov_h_w = 1;
						$fov_c_w = 1;
					}
					
					//Σκίαση τέντας
					if( $data_fovt_w[0]!=0 ){
						if( ($data_fovt_w[1]-$window_p-$window_h/2)>0 ){
							$fovt_deg_w = atan($data_fovt_w[0] / ($data_fovt_w[1]-$window_p-$window_h/2) )*180/pi();
						}else{
							$fovt_deg_w=90;
						}
						
						$fovt_w = calc_skiasi_ov($fovt_deg_w, $pros_w);
						$fov_c_w = $fovt_w[1];
					}
					
					//Πλευρικές σκιάσεις
					if( $data_ffin_l_w[1]!=0 ){
						$ffin_l_deg_w = atan( $data_ffin_l_w[1] / ($data_ffin_l_w[0]+$window_apoar+$window_w/2) )*180/pi();
						$ffin_l_w = calc_skiasi_fin($ffin_l_deg_w, $pros_w, 1);
						$ffin_l_h_w = $ffin_l_w[0];
						$ffin_l_c_w = $ffin_l_w[1];
					}else{
						$ffin_l_h_w = 1;
						$ffin_l_c_w = 1;
					}
					if( $data_ffin_r_w[1]!=0 ){
						$ffin_r_deg_w = atan( $data_ffin_r_w[1] / ($data_ffin_r_w[0]+($wall["h"]-$window_apoar-$window_w)+$window_w/2) )*180/pi();
						$ffin_r_w = calc_skiasi_fin($ffin_r_deg_w, $pros_w, 2);
						$ffin_r_h_w = $ffin_r_w[0];
						$ffin_r_c_w = $ffin_r_w[1];
					}else{
						$ffin_r_h_w = 1;
						$ffin_r_c_w = 1;
					}
					$ffin_h_w = $ffin_l_h_w*$ffin_r_h_w;
					$ffin_c_w = $ffin_l_c_w*$ffin_r_c_w;
					$ffin_h_w = round($ffin_h_w,3);
					$ffin_c_w = round($ffin_c_w,3);
				}//Αναλυτικά ο τοίχος
				
			}//από τοίχο
				
		}//Σκιάσεις αναλυτικά ή από τοίχο
		
		if($window_ftype==1){//Πλήρης σκίαση ανοίγματος
			$fhor_h_w=0;
			$fhor_c_w=0;
			$fov_h_w=0;
			$fov_c_w=0;
			$ffin_h_w=0;
			$ffin_c_w=0;
		}
		
		if($window_ftype==2){//Ασκίαστο άνοιγμα
			$fhor_h_w=1;
			$fhor_c_w=1;
			$fov_h_w=1;
			$fov_c_w=1;
			$ffin_h_w=1;
			$ffin_c_w=1;
		}
		
		if($window["u_id"]=="u_bytype" AND $window["type"]==0){//Με τύπο αδιαφανές και u από επιλογές ΠΕΑ (στα αδιαφανή)
				$window_row .= "<tr>";
				$window_row .= "<td>Πόρτα</td>";
				$window_row .= "<td>".$window_name."</td>";
				$window_row .= "<td>".$wall_g."</td>";
				$window_row .= "<td>".$wall["b"]."</td>";
				$window_row .= "<td>".$window_e."</td>";
				$window_row .= "<td>".$window_u."</td>";
				$window_row .= "<td>".$ap."</td>";
				$window_row .= "<td>".$ek."</td>";
				$window_row .= "<td>".$fhor_h_w."</td>";
				$window_row .= "<td>".$fhor_c_w."</td>";
				$window_row .= "<td>".$fov_h_w."</td>";
				$window_row .= "<td>".$fov_c_w."</td>";
				$window_row .= "<td>".$ffin_h_w."</td>";
				$window_row .= "<td>".$ffin_c_w."</td>";
				$window_row .= "</tr>";
				
				$adiafani_row .= $window_row;
		}else{//Αλλιώς στα διαφανή
			$window_row .= "<tr>";
			$window_row .= "<td>Ανοιγόμενο κούφωμα</td>";
			$window_row .= "<td>".$window_name."</td>";
			$window_row .= "<td>".$wall_g."</td>";
			$window_row .= "<td>".$wall["b"]."</td>";
			$window_row .= "<td>".$window_e."</td>";
			$window_row .= "<td></td>";
			$window_row .= "<td>".$window_u."</td>";
			$window_row .= "<td>".$window_gw."</td>";
			$window_row .= "<td>".$fhor_h_w."</td>";
			$window_row .= "<td>".$fhor_c_w."</td>";
			$window_row .= "<td>".$fov_h_w."</td>";
			$window_row .= "<td>".$fov_c_w."</td>";
			$window_row .= "<td>".$ffin_h_w."</td>";
			$window_row .= "<td>".$ffin_c_w."</td>";
			$window_row .= "</tr>";
			
			if($window["passive"]==1){
				$txt_passive .= $window_row;
			}else{
				$txt_window .= $window_row;
			}
		}//Επιλογή καρτέλας
		
		}//Παράθυρα
		
	
		//Καθαρό εμβαδόν τοίχου
		$wall_e_adiafanes = $wall_e_sum - $window_sume;//Ο τοίχος χωρίς παράθυρα
		$wall_e = $wall_e_sum - $syr_e - $yp_e - $dok_e - $window_sume;//Ο τοίχος χωρίς φέρων/παράθυρα
		$u_sum = ($wall_e*$u + $syr_e*$syr_u + $yp_e*$yp_u + $dok_e*$dok_u)/$wall_e_adiafanes;//Μέσος συντελεστής
		
		if($wall_e<=0){$class="class=\"danger\"";}else{$class="";}
		
		//Για ζώνη ($type==2) και τύπος τοίχου σε αέρα ($wall["type"]==0) ή διαχωριστική ($wall["type"]==3)
		//Για ΜΘΧ ($type==5) και τύπος τοίχου σε αέρα ($wall["type"]==0) ή διαχωριστική ($wall["type"]==2)
		if( ($type==2 AND ($wall["type"]==0 OR $wall["type"]==3)) OR ($type==5 AND ($wall["type"]==0 OR $wall["type"]==2)) ){//εάν ο τοίχος ανήκει στα αδιαφανή της ζώνης	
			if($wall["type"]==0){$toixos_per="Τοίχος";}
			if( ($type==2 AND $wall["type"]==3) OR ($type==5 AND $wall["type"]==2) ){$toixos_per="Μεσοτοιχία";}
			if($symptiksi==1){//1 γραμμή για τον τοίχο
			//Εκτύπωση γραμμής τοίχου
				$adiafani_row .= "<tr>";
				$adiafani_row .= "<td>".$toixos_per."</td>";
				$adiafani_row .= "<td>".$wall["name"]."</td>";
				$adiafani_row .= "<td>".$wall_g."</td>";
				$adiafani_row .= "<td>".$wall["b"]."</td>";
				$adiafani_row .= "<td>".$wall_e_adiafanes."</td>";
				$adiafani_row .= "<td>".$u_sum."</td>";
				$adiafani_row .= "<td>".$ap."</td>";
				$adiafani_row .= "<td>".$ek."</td>";
				$adiafani_row .= "<td>".$fhor_h."</td>";
				$adiafani_row .= "<td>".$fhor_c."</td>";
				$adiafani_row .= "<td>".$fov_h."</td>";
				$adiafani_row .= "<td>".$fov_c."</td>";
				$adiafani_row .= "<td>".$ffin_h."</td>";
				$adiafani_row .= "<td>".$ffin_c."</td>";
				$adiafani_row .= "</tr>";
			$aa++;
			}else{
			//Εκτύπωση γραμμής τοίχου
				$adiafani_row .= "<tr ".$class.">";
				$adiafani_row .= "<td>".$toixos_per."</td>";
				$adiafani_row .= "<td>".$wall["name"]."</td>";
				$adiafani_row .= "<td>".$wall_g."</td>";
				$adiafani_row .= "<td>".$wall["b"]."</td>";
				$adiafani_row .= "<td>".$wall_e."</td>";
				$adiafani_row .= "<td>".$u."</td>";
				$adiafani_row .= "<td>".$ap."</td>";
				$adiafani_row .= "<td>".$ek."</td>";
				$adiafani_row .= "<td>".$fhor_h."</td>";
				$adiafani_row .= "<td>".$fhor_c."</td>";
				$adiafani_row .= "<td>".$fov_h."</td>";
				$adiafani_row .= "<td>".$fov_c."</td>";
				$adiafani_row .= "<td>".$ffin_h."</td>";
				$adiafani_row .= "<td>".$ffin_c."</td>";
				$adiafani_row .= "</tr>";
				$aa++;
				
				if($yp_e!=0){
					if($per!=0){
						$txt_ypost="[Φέρων-".$per."%]-";
					}else{
						$txt_ypost="Υποστηλώματα-";
					}
				//Εκτύπωση γραμμής υποστηλωμάτων
				$adiafani_row .= "<tr>";
				$adiafani_row .= "<td>".$toixos_per."</td>";
				$adiafani_row .= "<td>".$txt_ypost.$wall["name"]."</td>";
				$adiafani_row .= "<td>".$wall_g."</td>";
				$adiafani_row .= "<td>".$wall["b"]."</td>";
				$adiafani_row .= "<td>".$yp_e."</td>";
				$adiafani_row .= "<td>".$yp_u."</td>";
				$adiafani_row .= "<td>".$ap."</td>";
				$adiafani_row .= "<td>".$ek."</td>";
				$adiafani_row .= "<td>".$fhor_h."</td>";
				$adiafani_row .= "<td>".$fhor_c."</td>";
				$adiafani_row .= "<td>".$fov_h."</td>";
				$adiafani_row .= "<td>".$fov_c."</td>";
				$adiafani_row .= "<td>".$ffin_h."</td>";
				$adiafani_row .= "<td>".$ffin_c."</td>";
				$adiafani_row .= "</tr>";
				$aa++;
				}
				
				if($dok_e!=0){
					if($per==0){//μόνο εάν δεν υπάρχει % φέρων
					//Εκτύπωση γραμμής δοκών
					$adiafani_row .= "<tr>";
					$adiafani_row .= "<td>".$toixos_per."</td>";
					$adiafani_row .= "<td>Δοκοί-".$wall["name"]."</td>";
					$adiafani_row .= "<td>".$wall_g."</td>";
					$adiafani_row .= "<td>".$wall["b"]."</td>";
					$adiafani_row .= "<td>".$dok_e."</td>";
					$adiafani_row .= "<td>".$dok_u."</td>";
					$adiafani_row .= "<td>".$ap."</td>";
					$adiafani_row .= "<td>".$ek."</td>";
					$adiafani_row .= "<td>".$fhor_h."</td>";
					$adiafani_row .= "<td>".$fhor_c."</td>";
					$adiafani_row .= "<td>".$fov_h."</td>";
					$adiafani_row .= "<td>".$fov_c."</td>";
					$adiafani_row .= "<td>".$ffin_h."</td>";
					$adiafani_row .= "<td>".$ffin_c."</td>";
					$adiafani_row .= "</tr>";
					$aa++;
					}
				}
				
				if($syr_e!=0){
				//Εκτύπωση γραμμής συρομένων
				$adiafani_row .= "<tr>";
				$adiafani_row .= "<td>".$toixos_per."</td>";
				$adiafani_row .= "<td>Με διάκενο-".$wall["name"]."</td>";
				$adiafani_row .= "<td>".$wall_g."</td>";
				$adiafani_row .= "<td>".$wall["b"]."</td>";
				$adiafani_row .= "<td>".$syr_e."</td>";
				$adiafani_row .= "<td>".$syr_u."</td>";
				$adiafani_row .= "<td>".$ap."</td>";
				$adiafani_row .= "<td>".$ek."</td>";
				$adiafani_row .= "<td>".$fhor_h."</td>";
				$adiafani_row .= "<td>".$fhor_c."</td>";
				$adiafani_row .= "<td>".$fov_h."</td>";
				$adiafani_row .= "<td>".$fov_c."</td>";
				$adiafani_row .= "<td>".$ffin_h."</td>";
				$adiafani_row .= "<td>".$ffin_c."</td>";
				$adiafani_row .= "</tr>";
				$aa++;
				}
				
			}//4 γραμμές τοίχου
			$txt_adiafani .= $adiafani_row;
		}//εάν ο τοίχος ανήκει στα αδιαφανή της ζώνης
		
		
		if( ($type==2 AND $wall["type"]==2) OR ($type==5 AND $wall["type"]==1) ){ //ο τοίχος ανήκει σε έδαφος
			if($symptiksi==1){//1 γραμμή για τον τοίχο
				//Εκτύπωση γραμμής τοίχου
				$adiafani_row .= "<tr>";
				$adiafani_row .= "<td>Τοίχος</td>";
				$adiafani_row .= "<td>".$wall["name"]."</td>";
				$adiafani_row .= "<td>".$wall_e_sum."</td>";
				$adiafani_row .= "<td>".$u_sum."</td>";
				$adiafani_row .= "<td>".$wall["z1"]."</td>";
				$adiafani_row .= "<td>".$wall["z2"]."</td>";
				$adiafani_row .= "<td></td>";
				$adiafani_row .= "</tr>";
			$aa++;
			}else{
			//Εκτύπωση γραμμής τοίχου
				$adiafani_row .= "<tr ".$class.">";
				$adiafani_row .= "<td>Τοίχος</td>";
				$adiafani_row .= "<td>".$wall["name"]."</td>";
				$adiafani_row .= "<td>".$wall_e."</td>";
				$adiafani_row .= "<td>".$u."</td>";
				$adiafani_row .= "<td>".$wall["z1"]."</td>";
				$adiafani_row .= "<td>".$wall["z2"]."</td>";
				$adiafani_row .= "<td></td>";
				$adiafani_row .= "</tr>";
				$aa++;
				
				if($yp_e!=0){
					if($per!=0){
						$txt_ypost="[Φέρων-".$per."%]-";
					}else{
						$txt_ypost="Υποστηλώματα-";
					}
				//Εκτύπωση γραμμής υποστηλωμάτων
				$adiafani_row .= "<tr>";
				$adiafani_row .= "<td>Τοίχος</td>";
				$adiafani_row .= "<td>".$txt_ypost.$wall["name"]."</td>";
				$adiafani_row .= "<td>".$yp_e."</td>";
				$adiafani_row .= "<td>".$yp_u."</td>";
				$adiafani_row .= "<td>".$wall["z1"]."</td>";
				$adiafani_row .= "<td>".$wall["z2"]."</td>";
				$adiafani_row .= "<td></td>";
				$adiafani_row .= "</tr>";
				$aa++;
				}
				
				if($dok_e!=0){
					if($per==0){//μόνο εάν δεν υπάρχει % φέρων
					//Εκτύπωση γραμμής δοκών
					$adiafani_row .= "<tr>";
					$adiafani_row .= "<td>Τοίχος</td>";
					$adiafani_row .= "<td>Δοκοί-".$wall["name"]."</td>";
					$adiafani_row .= "<td>".$dok_e."</td>";
					$adiafani_row .= "<td>".$dok_u."</td>";
					$adiafani_row .= "<td>".$wall["z1"]."</td>";
					$adiafani_row .= "<td>".$wall["z2"]."</td>";
					$adiafani_row .= "<td></td>";
					$adiafani_row .= "</tr>";
					$aa++;
					}
				}
				
				if($syr_e!=0){
				//Εκτύπωση γραμμής συρομένων
				$adiafani_row .= "<tr>";
				$adiafani_row .= "<td>Τοίχος</td>";
				$adiafani_row .= "<td>Με διάκενο-".$wall["name"]."</td>";
				$adiafani_row .= "<td>".$syr_e."</td>";
				$adiafani_row .= "<td>".$syr_u."</td>";
				$adiafani_row .= "<td>".$wall["z1"]."</td>";
				$adiafani_row .= "<td>".$wall["z2"]."</td>";
				$adiafani_row .= "<td></td>";
				$adiafani_row .= "</tr>";
				$aa++;
				}
				
			}//4 γραμμές τοίχου
			$txt_edafos .= $adiafani_row;
		}//ο τοίχος σε έδαφος
		
		/*
		if($wall["type"]==1){ //ο τοίχος σε επαφή με ΜΘΧ - Διαχωριστική
			if($symptiksi==1){//1 γραμμή για τον τοίχο
				
			}
		}//ο τοίχος σε επαφή με ΜΘΧ - Διαχωριστική
		*/
	}//για κάθε τοίχο
	
	
	//ΟΡΟΦΕΣ - 0 σε αέρα, 1 σε ΜΘΧ
	$aa=1;
	foreach($zone_orofes as $orofi){
		if($orofi["u"]!=0){
			$orofi_u=$orofi["u"];
		}else{
			$orofi_u_data = $database->select("user_adiafani","u",array("id"=>$orofi["u_id"]) );
			$orofi_u=$orofi_u_data[0];
		}
		// α/ε
		$orofi_ap = $database->select("vivliothiki_adiafani_a","a",array("id"=>$orofi['ap']) );
		$orofi_ap=$orofi_ap[0];
		$orofi_ek = $database->select("vivliothiki_adiafani_e","e",array("id"=>$orofi['ek']) );
		$orofi_ek=$orofi_ek[0];		
		
		$window_sume=0;
		//Παράθυρα
		$data_windowor = $database->select($table_windows,"*",array("roof_id"=>$orofi['id']) );
		foreach($data_windowor as $window){
			$window_row = "";
				$window_name=$window["name"];
				$window_w=$window["w"];
				$window_h=$window["h"];
				$window_p=$window["p"];
				$window_apoar=$window["apoar"];
				$window_e=$window["w"]*$window["h"];
				$window_u=$window["u"];
				$window_gw=$window["g_w"];
				$window_ftype=$window["f_type"];
				
				$window_sume+=$window_e;
			
			if($window["u_id"]=="u_bytype" AND $window["type"]==0){//Με τύπο αδιαφανές και u από επιλογές ΠΕΑ (στα αδιαφανή)
				$window_row .= "<tr>";
				$window_row .= "<td>Πόρτα</td>";
				$window_row .= "<td>".$window_name."</td>";
				$window_row .= "<td>".$orofi["g"]."</td>";
				$window_row .= "<td>".$orofi["b"]."</td>";
				$window_row .= "<td>".$window_e."</td>";
				$window_row .= "<td>".$window_u."</td>";
				$window_row .= "<td>".$orofi_ap."</td>";
				$window_row .= "<td>".$orofi_ek."</td>";
				$window_row .= "<td>".$orofi["fhor_h"]."</td>";
				$window_row .= "<td>".$orofi["fhor_c"]."</td>";
				$window_row .= "<td>".$orofi["fov_h"]."</td>";
				$window_row .= "<td>".$orofi["fov_c"]."</td>";
				$window_row .= "<td>".$orofi["ffin_h"]."</td>";
				$window_row .= "<td>".$orofi["ffin_c"]."</td>";
				$window_row .= "</tr>";
				
				$txt_adiafani .= $window_row;
			}else{//Αλλιώς στα διαφανή
				$window_row .= "<tr>";
				$window_row .= "<td>Ανοιγόμενο κούφωμα</td>";
				$window_row .= "<td>".$window_name."</td>";
				$window_row .= "<td>".$orofi["g"]."</td>";
				$window_row .= "<td>".$orofi["b"]."</td>";
				$window_row .= "<td>".$window_e."</td>";
				$window_row .= "<td></td>";
				$window_row .= "<td>".$window_u."</td>";
				$window_row .= "<td>".$window_gw."</td>";
				$window_row .= "<td>".$orofi["fhor_h"]."</td>";
				$window_row .= "<td>".$orofi["fhor_c"]."</td>";
				$window_row .= "<td>".$orofi["fov_h"]."</td>";
				$window_row .= "<td>".$orofi["fov_c"]."</td>";
				$window_row .= "<td>".$orofi["ffin_h"]."</td>";
				$window_row .= "<td>".$orofi["ffin_c"]."</td>";
				$window_row .= "</tr>";
				
				if($window["passive"]==1){
					$txt_passive .= $window_row;
				}else{
					$txt_window .= $window_row;
				}
			}//Επιλογή καρτέλας
			
		}//Παράθυρα
		
		$orofi_e=0;
		$orofi_e=$orofi["e"]-$window_sume;
		$orofi_row="";
		
		if($orofi["type"]==0){ //Οροφή σε αέρα	
			//Γραμμή οροφής
			$orofi_row .= "<tr>";
			$orofi_row .= "<td>Οροφή</td>";
			$orofi_row .= "<td>".$orofi["name"]."</td>";
			$orofi_row .= "<td>".$orofi["g"]."</td>";
			$orofi_row .= "<td>".$orofi["b"]."</td>";
			$orofi_row .= "<td>".$orofi_e."</td>";
			$orofi_row .= "<td>".$orofi_u."</td>";
			$orofi_row .= "<td>".$orofi_ap."</td>";
			$orofi_row .= "<td>".$orofi_ek."</td>";
			$orofi_row .= "<td>".$orofi["fhor_h"]."</td>";
			$orofi_row .= "<td>".$orofi["fhor_c"]."</td>";
			$orofi_row .= "<td>".$orofi["fov_h"]."</td>";
			$orofi_row .= "<td>".$orofi["fov_c"]."</td>";
			$orofi_row .= "<td>".$orofi["ffin_h"]."</td>";
			$orofi_row .= "<td>".$orofi["ffin_c"]."</td>";
			$orofi_row .= "</tr>";
			
		$txt_adiafani .= $orofi_row;
		$aa++;
		}
		
		
		if($orofi["type"]==2){ //Οροφή σε έδαφος	
			$orofi_row .= "<tr>";
			$orofi_row .= "<td>Δάπεδο - Οροφή</td>";
			$orofi_row .= "<td>".$orofi["name"]."</td>";
			$orofi_row .= "<td>".$orofi_e."</td>";
			$orofi_row .= "<td>".$orofi_u."</td>";
			$orofi_row .= "<td>".$orofi["z"]."</td>";
			$orofi_row .= "<td></td>";
			$orofi_row .= "<td>".$orofi["p"]."</td>";
			$orofi_row .= "</tr>";
		
		$txt_edafos .= $orofi_row;
		$aa++;
		}//Οροφή σε αέρα
	}
	
	
	//ΔΑΠΕΔΑ - 0 επί εδάφους, 1 σε ΜΘΧ, 2 σε πυλωτή
	$aa=1;
	foreach($zone_dapeda as $dapedo){
		$dapedo_row="";
		if($dapedo["u"]!=0){
			$dapedo_u=$dapedo["u"];
		}else{
			$dapedo_u_data = $database->select("user_adiafani","u",array("id"=>$dapedo["u_id"]) );
			$dapedo_u=$dapedo_u_data[0];
		}	
		if($dapedo["type"]==0){ //Δάπεδο σε έδαφος
			//Εκτύπωση δαπέδου στις γραμμές επαφής με έδαφος
			$dapedo_row .= "<tr>";
			$dapedo_row .= "<td>Δάπεδο-Οροφή</td>";
			$dapedo_row .= "<td>".$dapedo["name"]."</td>";
			$dapedo_row .= "<td>".$dapedo["e"]."</td>";
			$dapedo_row .= "<td>".$dapedo_u."</td>";
			$dapedo_row .= "<td>".$dapedo["z"]."</td>";
			$dapedo_row .= "<td></td>";
			$dapedo_row .= "<td>".$dapedo["p"]."</td>";
			$dapedo_row .= "</tr>";
		$txt_edafos .= $dapedo_row;
		}//Δάπεδο σε έδαφος
		if($dapedo["type"]==2){//Δάπεδο σε πυλωτή
			$dapedo_ap = $database->select("vivliothiki_adiafani_a","a",array("id"=>$dapedo['ap']) );
			$dapedo_ap=$dapedo_ap[0];
			$dapedo_ek = $database->select("vivliothiki_adiafani_e","e",array("id"=>$dapedo['ek']) );
			$dapedo_ek=$dapedo_ek[0];
			
			$dapedo_row .= "<tr>";
			$dapedo_row .= "<td>Πυλωτή</td>";
			$dapedo_row .= "<td>".$dapedo["name"]."</td>";
			$dapedo_row .= "<td>180</td>";
			$dapedo_row .= "<td>180</td>";
			$dapedo_row .= "<td>".$dapedo["e"]."</td>";
			$dapedo_row .= "<td>".$dapedo_u."</td>";
			$dapedo_row .= "<td>".$dapedo_ap."</td>";
			$dapedo_row .= "<td>".$dapedo_ek."</td>";
			$dapedo_row .= "<td>".$dapedo["fhor_h"]."</td>";
			$dapedo_row .= "<td>".$dapedo["fhor_c"]."</td>";
			$dapedo_row .= "<td>".$dapedo["fov_h"]."</td>";
			$dapedo_row .= "<td>".$dapedo["fov_c"]."</td>";
			$dapedo_row .= "<td>".$dapedo["ffin_h"]."</td>";
			$dapedo_row .= "<td>".$dapedo["ffin_c"]."</td>";
			$dapedo_row .= "</tr>";
		$txt_adiafani .= $dapedo_row;
		}//Δάπεδο σε πυλωτή
		$aa++;
	}//Για κάθε δάπεδο
	
	
	
	$txt_adiafani .= "</table>";
	$txt_adiafani .= "<div class=\"panel-footer\">Αδιαφανή</div>";
	$txt_adiafani .= "</div>";
	
	$txt_window .= "</table>";
	$txt_window .= "<div class=\"panel-footer\">Διαφανή</div>";
	$txt_window .= "</div>";
	
	$txt_passive .= "</table>";
	$txt_passive .= "<div class=\"panel-footer\">Παθητικά ηλιακά άμεσου κέρδους</div>";
	$txt_passive .= "</div>";
	
	$txt_edafos .= "</table>";
	$txt_edafos .= "<div class=\"panel-footer\">Επαφή με έδαφος</div>";
	$txt_edafos .= "</div>";
	
	$txt.= "<div class=\"tabbable tabs-left\">";
	$txt.= "<ul class=\"nav nav-pills red\">
			<li class=\"active\"><a href=\"#kelyfostab_1\" data-toggle=\"tab\"><i class=\"fa fa-square\"></i> Αδιαφανείς επιφάνειες</a></li>
			<li><a href=\"#kelyfostab_2\" data-toggle=\"tab\"><i class=\"fa fa-dot-circle-o\"></i> Σε επαφή με το έδαφος</a></li>
			<li><a href=\"#kelyfostab_3\" data-toggle=\"tab\"><i class=\"fa fa-square-o\"></i> Διαφανείς επιφάνειες</a></li>";
	if($type==2 AND $passive_no>=1){
		$txt.="<li><a href=\"#kelyfostab_4\" data-toggle=\"tab\"><i class=\"fa fa-plus-square-o\"></i> Παθητικά ηλιακά</a></li>";
	}	
	
	$txt.="</ul>";
	
	$txt.= "<div class=\"tab-content\">";
	
	$txt.= "<div class=\"tab-pane active\" id=\"kelyfostab_1\">";//Αδιαφανή
	$txt .= "<br/>";
	$txt .= $txt_adiafani;
	$txt.= "</div>";//Αδιαφανή
	
	$txt.= "<div class=\"tab-pane\" id=\"kelyfostab_2\">";//Έδαφος
	$txt .= "<br/>";
	$txt .= $txt_edafos;
	$txt.= "</div>";//Έδαφος
	
	$txt.= "<div class=\"tab-pane\" id=\"kelyfostab_3\">";//Διαφανή
	$txt .= "<br/>";
	$txt .= $txt_window;
	$txt.= "</div>";//Διαφανή
	
	if($type==2 AND $passive_no>=1){
	$txt.= "<div class=\"tab-pane\" id=\"kelyfostab_4\">";//Παθητικά
	$txt .= "<br/>";
	$txt .= $txt_passive;
	$txt.= "</div>";//Παθητικά
	}
	
	$txt.= "</div>";//tab-content
	$txt.= "</div>";//tabs
	
	return $txt;
}


//preview - Καρτέλα: Πίνακες συστημάτων ζώνης
function preview_tables_systems($id){
	
	$database = new medoo(DB_NAME);
	$tb_sys_thermp="meletes_zone_sys_thermp";
	$tb_sys_thermd="meletes_zone_sys_thermd";
	$tb_sys_thermt="meletes_zone_sys_thermt";
	$tb_sys_thermv="meletes_zone_sys_thermv";
	$tb_sys_coldp="meletes_zone_sys_coldp";
	$tb_sys_coldd="meletes_zone_sys_coldd";
	$tb_sys_coldt="meletes_zone_sys_coldt";
	$tb_sys_coldv="meletes_zone_sys_coldv";
	$tb_sys_znxp="meletes_zone_sys_znxp";
	$tb_sys_znxd="meletes_zone_sys_znxd";
	$tb_sys_znxt="meletes_zone_sys_znxt";
	$tb_sys_znxv="meletes_zone_sys_znxv";
	$tb_sys_solar="meletes_zone_sys_solar";
	$tb_sys_light="meletes_zone_sys_light";
	$tb_sys_aerp="meletes_zone_sys_aerp";
	$tb_sys_ygrp="meletes_zone_sys_ygrp";
	$tb_sys_ygrd="meletes_zone_sys_ygrd";
	$tb_sys_ygrt="meletes_zone_sys_ygrt";
	
	$where_zone=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$id));
	$sys_thermp = $database->select($tb_sys_thermp,"*",$where_zone);
	$sys_thermd = $database->select($tb_sys_thermd,"*",$where_zone);
	$sys_thermt = $database->select($tb_sys_thermt,"*",$where_zone);
	$sys_thermv = $database->select($tb_sys_thermv,"*",$where_zone);
	
	$sys_coldp = $database->select($tb_sys_coldp,"*",$where_zone);
	$sys_coldd = $database->select($tb_sys_coldd,"*",$where_zone);
	$sys_coldt = $database->select($tb_sys_coldt,"*",$where_zone);
	$sys_coldv = $database->select($tb_sys_coldv,"*",$where_zone);
	
	$sys_znxp = $database->select($tb_sys_znxp,"*",$where_zone);
	$sys_znxd = $database->select($tb_sys_znxd,"*",$where_zone);
	$sys_znxt = $database->select($tb_sys_znxt,"*",$where_zone);
	$sys_znxv = $database->select($tb_sys_znxv,"*",$where_zone);
	
	$sys_solar = $database->select($tb_sys_solar,"*",$where_zone);
	$sys_light = $database->select($tb_sys_light,"*",$where_zone);
	
	$sys_aerp = $database->select($tb_sys_aerp,"*",$where_zone);
	
	$sys_ygrp = $database->select($tb_sys_ygrp,"*",$where_zone);
	$sys_ygrd = $database->select($tb_sys_ygrd,"*",$where_zone);
	$sys_ygrt = $database->select($tb_sys_ygrt,"*",$where_zone);
	
	$months_en = array(
		0=>"jan",
		1=>"feb",
		2=>"mar",
		3=>"apr",
		4=>"may",
		5=>"jun",
		6=>"jul",
		7=>"aug",
		8=>"sep",
		9=>"okt",
		10=>"nov",
		11=>"dec"
	);
	$months_gr = array(
		0=>"Ιαν",
		1=>"Φεβ",
		2=>"Μαρ",
		3=>"Απρ",
		4=>"Μαι",
		5=>"Ιούν",
		6=>"Ιούλ",
		7=>"Αυγ",
		8=>"Σεπ",
		9=>"Οκτ",
		10=>"Νοε",
		11=>"Δεκ"
	);
	$array_thermp_type=array(
		0=>"Λέβητας",
		1=>"Κεντρική υδρόψυκτη Α.Θ.",
		2=>"Κεντρική αερόψυκτη Α.Θ.",
		3=>"Τοπική αερόψυκτη Α.Θ.",
		4=>"Γεωθερμική Α.Θ. με οριζόντιο εναλλάκτη",
		5=>"Γεωθερμική Α.Θ. με κατακόρυφο εναλλάκτη",
		6=>"Κεντρική άλλου τύπου Α.Θ.",
		7=>"Τοπικές ηλεκτρικές μονάδες",
		8=>"Τοπικές μονάδες αερίου ή υγρού καυσίμου",
		9=>"Ανοικτές εστίες καύσης",
		10=>"Τηλεθέρμανση",
		11=>"ΣΗΘ",
		12=>"Μονάδα παραγωγής άλλου τύπου"
	);
	$array_pigi=array(
		0=>"Υγραέριο",
		1=>"Φυσικό αέριο",
		2=>"Ηλεκτρισμός",
		3=>"Πετρέλαιο θέρμανσης",
		4=>"Πετρέλαιο κίνησης",
		5=>"Τηλεθέρμανση (ΔΕΗ)",
		6=>"Τηλεθέρμανση (ΑΠΕ)",
		7=>"Βιομάζα",
		8=>"Βιομάζα τυποποιημένη",
		9=>"ΣΗΘ1",
		10=>"ΣΗΘ2",
		11=>"ΣΗΘ3",
		12=>"ΣΗΘ4",
		13=>"ΣΗΘ5",
		14=>"ΣΗΘ6",
		15=>"ΣΗΘ7",
		16=>"ΣΗΘ8",
		17=>"ΣΗΘ9",
		18=>"ΣΗΘ10"
	);
	$array_dtype = array(
		0=>"Εσωτερικοί ή έως 20% σε εξωτερικούς",
		1=>"Πάνω από 20% σε εξωτερικούς"
	);
	$array_thermv_type = array(
		0=>"Αντλίες",
		1=>"Κυκλοφορητές",
		2=>"Ηλεκτροβάνες",
		3=>"Ανεμιστήρες"
	);
	$array_coldp_type = array(
		0=>"Αερόψυκτος ψύκτης",
		1=>"Υδρόψυκτος ψύκτης",
		2=>"Υδρόψυκτη Α.Θ.",
		3=>"Αερόψυκτη Α.Θ.",
		4=>"Γεωθερμική Α.Θ. με οριζόντιο εναλλάκτη",
		5=>"Γεωθερμική Α.Θ. με κατακόρυφο εναλλάκτη",
		6=>"Προσρόφησης Απορρόφησης Α.Θ.",
		7=>"Κεντρική άλλου τύπου Α.Θ.",
		8=>"Μονάδα παραγωγής άλλου τύπου"
	);
	$array_coldv_type = array(
		0=>"Αντλίες",
		1=>"Κυκλοφορητές",
		2=>"Ηλεκτροβάνες",
		3=>"Ανεμιστήρες",
		4=>"Πύργος ψύξης"
	);
	$array_znxp_type = array(
		0=>"Λέβητας",
		1=>"Τηλεθέρμανση",
		2=>"ΣΗΘ",
		3=>"Αντλία θερμότητας (Α.Θ.)",
		4=>"Τοπικός ηλεκτρικός θερμαντήρας",
		5=>"Τοπική μονάδα φυσικού αερίου",
		6=>"Μονάδα παραγωγής (κεντρική) άλλου τύπου"
	);
	$array_znxv_type = array(
		0=>"Αντλίες",
		1=>"Κυκλοφορητές",
		2=>"Ηλεκτροβάνες",
		3=>"Άλλου τύπου"
	);
	$array_ygrp_type = array(
		0=>"Ατμολέβητας κεντρικής παροχής",
		1=>"Τοπική μονάδα ψεκασμού",
		2=>"Τοπική μονάδα παραγωγής ατμού",
		3=>"Τοπική μονάδα άλλου τύπου"
	);
	$array_solar_type = array(
		0=>"Χωρίς κάλυμα",
		1=>"Απλός επίπεδος",
		2=>"Επιλεκτικός επίπεδος",
		3=>"Κενού",
		4=>"Συγκεντρωτικός"
	);
	$array_light_ff = array(
		0=>"1. Αυτόματος",
		1=>"2. Χειροκίνητος"
	);
	$array_light_move = array(
		0=>"1. Χειροκίνητος διακόπτης (αφής/σβέσης)",
		1=>"2. Χειροκίνητος διακόπτης (αφής/σβέσης) και αισθητήρας παρουσίας",
		2=>"3. Ανίχνευση με αυτόματη έναυση / ρύθμιση φωτεινής ροής (dimming)",
		3=>"4. Ανίχνευση με αυτόματη έναυση και σβέση",
		4=>"5. Ανίχνευση με χειροκίνητη έναυση / ρύθμιση φωτεινής ροής (dimming)",
		5>"6. Ανίχνευση με χειροκίνητη έναυση / αυτόματη σβέση"
	);
	
	$txt = "";
	
	$txt.= "<div class=\"tabbable tabs-left\">";
	$txt.= "<ul class=\"nav nav-pills red\">
			<li class=\"active\"><a href=\"#systemtab_1\" data-toggle=\"tab\"><i class=\"fa fa-fire\"></i> Θέρμανση</a></li>
			<li><a href=\"#systemtab_2\" data-toggle=\"tab\"><i class=\"fa fa-snowflake-o\"></i> Ψύξη</a></li>
			<li><a href=\"#systemtab_3\" data-toggle=\"tab\"><i class=\"fa fa-bath\"></i> ZNX</a></li>
			<li><a href=\"#systemtab_4\" data-toggle=\"tab\"><i class=\"fa fa-sun-o\"></i> Ηλιακός</a></li>
			<li><a href=\"#systemtab_5\" data-toggle=\"tab\"><i class=\"fa fa-lightbulb-o\"></i> Φωτισμός</a></li>
			<li><a href=\"#systemtab_6\" data-toggle=\"tab\"><i class=\"fa fa-flag\"></i> Αερισμός</a></li>
			<li><a href=\"#systemtab_7\" data-toggle=\"tab\"><i class=\"fa fa-tint\"></i> Ύγρανση</a></li></ul>";
	
	$txt.= "<div class=\"tab-content\">";
	
	$txt.= "<div class=\"tab-pane active\" id=\"systemtab_1\">";//Θέρμανση
	
	$txt .= "<br/>";
	
		//ΘΕΡΜΑΝΣΗ - Μονάδες παραγωγής
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Παραγωγή</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
		<td><a href=\"#\" title=\"Πηγή ενέργειας\">Πηγή ενέργειας</a></td>
		<td><a href=\"#\" title=\"Ισχύς\">P</a></td>
		<td><a href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>
		<td><a href=\"#\" title=\"Βαθμός επίδοσης\">COP</a></td>";
		foreach($months_gr as $monthgr){
			$txt .= "<td><a href=\"#\">".$monthgr."</a></td>";
		}
		$txt .= "</tr>";
		
		foreach($sys_thermp as $thermp){
			$txt.= "<tr>
			<td>".$array_thermp_type[$thermp["type"]]."</td>
			<td>".$array_pigi[$thermp["pigi"]]."</td>
			<td>".$thermp["w"]."</td>
			<td>".$thermp["n"]."</td>
			<td>".$thermp["cop"]."</td>";
			foreach($months_en as $monthen){
				$txt.="<td>".$thermp[$monthen]."</td>";
			}
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Μονάδα παραγωγής θέρμανσης</div>";
		$txt .= "</div>";
		//ΘΕΡΜΑΝΣΗ - Μονάδες παραγωγής
		
		//ΘΕΡΜΑΝΣΗ - Διανομή
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Διανομή</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td width=15%><a href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
		<td width=5%><a href=\"#\" title=\"Ισχύς\">P</a></td>
		<td width=20%><a href=\"#\" title=\"Χώρος διέλευσης δικτύου διανομής\">Διέλευση</a></td>
		<td width=5%><a href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>
		<td width=5%><a href=\"#\" title=\"Μόνωση δικτύου διανομής\">Μόνωση</a></td>";
		$txt .= "</tr>";
		
		foreach($sys_thermd as $thermd){
			$txt.= "<tr>
			<td>Δίκτυο διανονομής θερμ. μέσου</td>
			<td>".$thermd["d_w"]."</td>
			<td>".$array_dtype[$thermd["d_type"]]."</td>
			<td>".$thermd["d_n"]."</td>
			<td style=\"background-color:#E8E8E8;\"></td>
			</tr>";
			$txt .= "<tr>
			<td>Αεραγωγοί</td>
			<td style=\"background-color:#E8E8E8;\"></td>
			<td>".$array_dtype[$thermd["a_type"]]."</td>
			<td style=\"background-color:#E8E8E8;\"></td>";
			if($thermd["a_insulation"]==1){
				$a_insulation="checked";
			}else{
				$a_insulation="";
			}
			$txt .= "<td><input type=\"checkbox\" disabled ".$a_insulation."></td>";
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Δίκτυο διανομής θερμού μέσου</div>";
		$txt .= "</div>";//ΘΕΡΜΑΝΣΗ - Διανομή
		
		//ΘΕΡΜΑΝΣΗ - Τερματικές
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Τερματικές μονάδες</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td width=20%><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
		<td width=15%><a href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>";
		$txt .= "</tr>";
		
		foreach($sys_thermt as $thermt){
			$txt.= "<tr>
			<td>".$thermt["type"]."</td>
			<td>".$thermt["n"]."</td>";
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Τερματικές μονάδες Θέρμανσης</div>";
		$txt .= "</div>";//ΘΕΡΜΑΝΣΗ - Τερματικές
		
		//ΘΕΡΜΑΝΣΗ - Βοηθητικές
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Βοηθητικές μονάδες</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td width=20%><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
		<td width=20%><a href=\"#\" title=\"Πλήθος\">Πλήθος</a></td>
		<td width=15%><a href=\"#\" title=\"Ισχύς\">n</a></td>";
		$txt .= "</tr>";
		
		foreach($sys_thermv as $thermv){
			$txt.= "<tr>
			<td>".$array_thermv_type[$thermv["type"]]."</td>
			<td>".$thermv["n"]."</td>
			<td>".$thermv["w"]."</td>";
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Βοηθητικές μονάδες Θέρμανσης</div>";
		$txt .= "</div>";//ΘΕΡΜΑΝΣΗ - Βοηθητικές
	
	$txt.= "</div>";//Θέρμανση
	
	//Ψύξη
	$txt.= "<div class=\"tab-pane\" id=\"systemtab_2\">";
		$txt .= "<br/>";
		//ΨΥΞΗ - Μονάδες παραγωγής
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Παραγωγή</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
		<td><a href=\"#\" title=\"Πηγή ενέργειας\">Πηγή ενέργειας</a></td>
		<td><a href=\"#\" title=\"Ισχύς\">P</a></td>
		<td><a href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>
		<td><a href=\"#\" title=\"Βαθμός επίδοσης\">EER</a></td>";
		foreach($months_gr as $monthgr){
			$txt .= "<td><a href=\"#\">".$monthgr."</a></td>";
		}
		$txt .= "</tr>";
		
		foreach($sys_coldp as $coldp){
			$txt.= "<tr>
			<td>".$array_coldp_type[$coldp["type"]]."</td>
			<td>".$array_pigi[$coldp["pigi"]]."</td>
			<td>".$coldp["w"]."</td>
			<td>".$coldp["n"]."</td>
			<td>".$coldp["eer"]."</td>";
			foreach($months_en as $monthen){
				$txt.="<td>".$coldp[$monthen]."</td>";
			}
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Μονάδα παραγωγής ψύξης</div>";
		$txt .= "</div>";
		//ΨΥΞΗ - Μονάδες παραγωγής
		
		//ΨΥΞΗ - Διανομή
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Διανομή</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td width=15%><a href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
		<td width=5%><a href=\"#\" title=\"Ισχύς\">P</a></td>
		<td width=20%><a href=\"#\" title=\"Χώρος διέλευσης δικτύου διανομής\">Διέλευση</a></td>
		<td width=5%><a href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>
		<td width=5%><a href=\"#\" title=\"Μόνωση δικτύου διανομής\">Μόνωση</a></td>";
		$txt .= "</tr>";
		
		foreach($sys_coldd as $coldd){
			$txt.= "<tr>
			<td>Δίκτυο διανονομής ψυχρού μέσου</td>
			<td>".$coldd["d_w"]."</td>
			<td>".$array_dtype[$coldd["d_type"]]."</td>
			<td>".$coldd["d_n"]."</td>
			<td style=\"background-color:#E8E8E8;\"></td>
			</tr>";
			$txt .= "<tr>
			<td>Αεραγωγοί</td>
			<td style=\"background-color:#E8E8E8;\"></td>
			<td>".$array_dtype[$coldd["a_type"]]."</td>
			<td style=\"background-color:#E8E8E8;\"></td>";
			if($coldd["a_insulation"]==1){
				$a_insulation="checked";
			}else{
				$a_insulation="";
			}
			$txt .= "<td><input type=\"checkbox\" disabled ".$a_insulation."></td>";
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Δίκτυο διανομής ψυχρού μέσου</div>";
		$txt .= "</div>";//ΨΥΞΗ - Διανομή
		
		//ΨΥΞΗ - Τερματικές
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Τερματικές μονάδες</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td width=20%><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
		<td width=15%><a href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>";
		$txt .= "</tr>";
		
		foreach($sys_coldt as $coldt){
			$txt.= "<tr>
			<td>".$coldt["type"]."</td>
			<td>".$coldt["n"]."</td>";
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Τερματικές μονάδες Ψύξης</div>";
		$txt .= "</div>";//ΨΥΞΗ - Τερματικές
		
		//ΨΥΞΗ - Βοηθητικές
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Βοηθητικές μονάδες</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td width=20%><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
		<td width=20%><a href=\"#\" title=\"Πλήθος\">Πλήθος</a></td>
		<td width=15%><a href=\"#\" title=\"Ισχύς\">n</a></td>";
		$txt .= "</tr>";
		
		foreach($sys_coldv as $coldv){
			$txt.= "<tr>
			<td>".$array_coldv_type[$coldv["type"]]."</td>
			<td>".$coldv["n"]."</td>
			<td>".$coldv["w"]."</td>";
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Βοηθητικές μονάδες Ψύξης</div>";
		$txt .= "</div>";//ΨΥΞΗ - Βοηθητικές
	$txt.= "</div>";//Ψύξη
	
	//ΖΝΧ
	$txt.= "<div class=\"tab-pane\" id=\"systemtab_3\">";
		$txt .= "<br/>";
		//ΖΝΧ - Μονάδες παραγωγής
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Παραγωγή</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
		<td><a href=\"#\" title=\"Πηγή ενέργειας\">Πηγή ενέργειας</a></td>
		<td><a href=\"#\" title=\"Ισχύς\">P</a></td>
		<td><a href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>";
		foreach($months_gr as $monthgr){
			$txt .= "<td><a href=\"#\">".$monthgr."</a></td>";
		}
		$txt .= "</tr>";
		
		foreach($sys_znxp as $znxp){
			$txt.= "<tr>
			<td>".$array_znxp_type[$znxp["type"]]."</td>
			<td>".$array_pigi[$znxp["pigi"]]."</td>
			<td>".$znxp["w"]."</td>
			<td>".$znxp["n"]."</td>";
			foreach($months_en as $monthen){
				$txt.="<td>".$znxp[$monthen]."</td>";
			}
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Μονάδα παραγωγής ΖΝΧ</div>";
		$txt .= "</div>";
		//ΖΝΧ - Μονάδες παραγωγής
		
		//ΖΝΧ - Διανομή
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Διανομή</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td width=15%><a href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
		<td width=5%><a href=\"#\" title=\"Ανακυκλοφορία\">Ανακυκλοφορία</a></td>
		<td width=20%><a href=\"#\" title=\"Χώρος διέλευσης δικτύου διανομής\">Διέλευση</a></td>
		<td width=5%><a href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>";
		$txt .= "</tr>";
		
		foreach($sys_znxd as $znxd){
			$txt.= "<tr>
			<td>".$znxd["type"]."</td>";
			if($znxd["ana"]==1){
				$znx_ana="checked";
			}else{
				$znx_ana="";
			}
			$txt .= "<td><input type=\"checkbox\" disabled ".$znx_ana."></td>
				<td>".$array_dtype[$znxd["dieleysi"]]."</td>
			<td>".$znxd["n"]."</td>
			</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Δίκτυο διανομής ΖΝΧ</div>";
		$txt .= "</div>";//ΖΝΧ - Διανομή
		
		//ΖΝΧ - Σύστημα αποθήκευσης
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Σύστημα αποθήκευσης</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td width=20%><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
		<td width=15%><a href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>";
		$txt .= "</tr>";
		
		foreach($sys_znxt as $znxt){
			$txt.= "<tr>
			<td>".$znxt["type"]."</td>
			<td>".$znxt["n"]."</td>";
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Αποθηκευτικές μονάδες ΖΝΧ</div>";
		$txt .= "</div>";//ΖΝΧ - Σύστημα αποθήκευσης
		
		//ΖΝΧ - Βοηθητικές
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Βοηθητικές μονάδες</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td width=20%><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
		<td width=20%><a href=\"#\" title=\"Πλήθος\">Πλήθος</a></td>
		<td width=15%><a href=\"#\" title=\"Ισχύς\">n</a></td>";
		$txt .= "</tr>";
		
		foreach($sys_znxv as $znxv){
			$txt.= "<tr>
			<td>".$array_znxv_type[$znxv["type"]]."</td>
			<td>".$znxv["n"]."</td>
			<td>".$znxv["w"]."</td>";
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Βοηθητικές μονάδες ΖΝΧ</div>";
		$txt .= "</div>";//ΖΝΧ - Βοηθητικές
	$txt.= "</div>";//ΖΝΧ
	
	//Ηλιακός
	$txt.= "<div class=\"tab-pane\" id=\"systemtab_4\">";
		$txt .= "<br/>";
		//Ηλιακός - Μονάδες παραγωγής
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Ηλιακός</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td width=20%><a href=\"#\" title=\"Τύπος συλλέκτη\">Τύπος</a></td>
		<td width=5%><a href=\"#\" title=\"Χρήση για Θέρμανση\">Θέρμανση</a></td>
		<td width=5%><a href=\"#\" title=\"Χρήση για ΖΝΧ\">ΖΝΧ</a></td>
		<td width=5%><a href=\"#\" title=\"Συντελεστής αξιοποίησης για ΖΝΧ\">συνα</a></td>
		<td width=5%><a href=\"#\" title=\"Συντελεστής αξιοποίησης για Θέρμανση\">συνβ</a></td>
		<td width=10%><a href=\"#\" title=\"Επιφάνεια συλλέκτη\">E</a></td>
		<td width=10%><a href=\"#\" title=\"Προσανατολισμός\">γ</a></td>
		<td width=10%><a href=\"#\" title=\"Κλίση συλλέκτη\">β</a></td>
		<td width=10%><a href=\"#\" title=\"Σκίαση συλλέκτη\">fs</a></td>";
		$txt .= "</tr>";
		
		foreach($sys_solar as $solar){
			$txt.= "<tr>
			<td width=20%>".$array_solar_type[$solar["type"]]."</td>";
			if($solar["active_h"]==1){
				$solar_h.= "checked";
			}else{
				$solar_h.= "";
			}
			if($solar["active_z"]==1){
				$solar_z.= "checked";
			}else{
				$solar_z.= "";
			}
			$txt.= "<td width=10%><input type=\"checkbox\" disabled ".$solar_h."></td>
			<td width=10%><input type=\"checkbox\" disabled ".$solar_z."></td>
			<td width=5%>".$solar["syna"]."</td>
			<td width=5%>".$solar["synb"]."</td>
			<td width=10%>".$solar["e"]."</td>
			<td width=10%>".$solar["g"]."</td>
			<td width=10%>".$solar["b"]."</td>
			<td width=10%>".$solar["fs"]."</td>";
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Ηλιοθερμικά συστήματα</div>";
		$txt .= "</div>";
		//Ηλιακός - Μονάδες παραγωγής
	$txt.= "</div>";//Ηλιακός
	
	
	//Φωτισμός
	$txt.= "<div class=\"tab-pane\" id=\"systemtab_5\">";
		$txt .= "<br/>";
		//Φωτισμός - Μονάδες παραγωγής
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Φωτισμός</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td width=10%><a href=\"#\" title=\"Εγκατεστημένη ισχύς φωτιστικών σωμάτων\">Ισχύς</a></td>
		<td width=10%><a href=\"#\" title=\"Περιοχή ΦΦ\">Περιοχή ΦΦ</a></td>
		<td width=20%><a href=\"#\" title=\"Αυτοματισμοί ελέγχου\">Αυτ. ελέγχου</a></td>
		<td width=20%><a href=\"#\" title=\"Αυτοματισμοί ανίχνευσης κίνησης\">Αυτ. αν. κίνησης</a></td>
		<td width=5%><a href=\"#\" title=\"Σύστημα απομάκρυνσης θερμότητας\">Απομ. θερμότητας</a></td>
		<td width=5%><a href=\"#\" title=\"Φωτισμός ασφαλείας\">Φωτισμός ασφαλείας</a></td>
		<td width=5%><a href=\"#\" title=\"Σύστημα εφεδρείας\">Σύστημα εφεδρείας</a></td>";
		$txt .= "</tr>";
		
		foreach($sys_light as $light){
			$txt.= "<tr>
			<td width=20%>".$light["w"]."</td>
			<td width=5%>".$light["e_per"]."</td>
			<td width=5%>".$array_light_ff[$light["auto_ff"]]."</td>
			<td width=5%>".$array_light_move[$light["auto_move"]]."</td>";
			if($light["active_heat"]==1){
				$active_heat.= "checked";
			}else{
				$active_heat.= "";
			}
			if($light["active_safety"]==1){
				$active_safety.= "checked";
			}else{
				$active_safety.= "";
			}
			if($light["active_backup"]==1){
				$active_backup.= "checked";
			}else{
				$active_backup.= "";
			}
			
			$txt.= "<td width=5%><input type=\"checkbox\" disabled ".$active_heat."></td>
				<td width=5%><input type=\"checkbox\" disabled ".$active_safety."></td>
				<td width=5%><input type=\"checkbox\" disabled ".$active_backup."></td>";
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Φωτιστικά σώματα</div>";
		$txt .= "</div>";
		//Ηλιακός - Μονάδες παραγωγής
	$txt.= "</div>";//Φωτισμός
	
	
	//Αερισμός
	$txt.= "<div class=\"tab-pane\" id=\"systemtab_6\">";
		$txt .= "<br/>";
		//Αερισμός - Μονάδες παραγωγής
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Μηχανικός αερισμός</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td width=10%><a href=\"#\" title=\"Τύπος (ονομασία)\">Τύπος</a></td>
		<td width=7%><a href=\"#\" title=\"Ενεργό τμήμα θέρμανσης\">Τμ. θέρμανσης</a></td>
		<td width=5%><a href=\"#\" title=\"Παροχή αέρα - τμήμα θέρμανσης\">F_h</a></td>
		<td width=5%><a href=\"#\" title=\"Συντελεστής ανακυκλοφορίας αέρα - τμήμα θέρμανσης\">R_h</a></td>
		<td width=5%><a href=\"#\" title=\"Συντελεστής ανάκτησης θερμότητας - τμήμα θέρμανσης\">Q_R_h</a></td>
		<td width=7%><a href=\"#\" title=\"Ενεργό τμήμα θέρμανσης\">Τμ. ψύξης</a></td>
		<td width=5%><a href=\"#\" title=\"Παροχή αέρα - τμήμα ψύξης\">F_c</a></td>
		<td width=5%><a href=\"#\" title=\"Συντελεστής ανακυκλοφορίας αέρα - τμήμα ψύξης\">R_c</a></td>
		<td width=5%><a href=\"#\" title=\"Συντελεστής ανάκτησης θερμότητας - τμήμα ψύξης\">Q_R_c</a></td>
		<td width=7%><a href=\"#\" title=\"Ενεργό τμήμα ύγρανσης\">Τμ. ύγρανσης</a></td>
		<td width=5%><a href=\"#\" title=\"Συντελεστής ανάκτησης υγρασίας - τμήμα ύγρανσης\">H_r</a></td>
		<td width=5%><a href=\"#\" title=\"Φίλτρα\">Φίλτρα</a></td>
		<td width=5%><a href=\"#\" title=\"Ειδική ηλεκτρική ισχύς\">E_vent</a></td>";
		$txt .= "</tr>";
		
		foreach($sys_aerp as $aerp){
			$txt.= "<tr>
			<td width=20%>".$aerp["type"]."</td>";
			if($aerp["active_h"]==1){
				$active_h.= "checked";
			}else{
				$active_h.= "";
			}
			$txt.= "<td width=10%><input type=\"checkbox\" disabled ".$active_h."></td>";
			$txt.= "<td width=5%>".$aerp["f_h"]."</td>
			<td width=5%>".$aerp["r_h"]."</td>
			<td width=5%>".$aerp["q_r_h"]."</td>";
			if($aerp["active_c"]==1){
				$active_c.= "checked";
			}else{
				$active_c.= "";
			}
			$txt.= "<td width=10%><input type=\"checkbox\" disabled ".$active_c."></td>";
			$txt.= "<td width=10%>".$aerp["f_c"]."</td>
			<td width=10%>".$aerp["r_c"]."</td>
			<td width=10%>".$aerp["q_r_c"]."</td>";
			if($aerp["active_y"]==1){
				$active_y.= "checked";
			}else{
				$active_y.= "";
			}
			$txt.= "<td width=10%><input type=\"checkbox\" disabled ".$active_y."></td>";
			$txt.= "<td width=10%>".$aerp["h_r"]."</td>
			<td width=10%>".$aerp["filters"]."</td>
			<td width=10%>".$aerp["e_vent"]."</td>";
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Μονάδες μηχανικού αερισμού</div>";
		$txt .= "</div>";
		//Αερισμός - Μονάδες παραγωγής
	$txt.= "</div>";//Αερισμός
	
	
	//Ύγρανση
	$txt.= "<div class=\"tab-pane\" id=\"systemtab_7\">";
		$txt .= "<br/>";
		//Ύγρανση - Μονάδες παραγωγής
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Παραγωγή</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td><a href=\"#\" title=\"Τύπος\">Τύπος</a></td>
		<td><a href=\"#\" title=\"Πηγή ενέργειας\">Πηγή ενέργειας</a></td>
		<td><a href=\"#\" title=\"Ισχύς\">P</a></td>
		<td><a href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>";
		foreach($months_gr as $monthgr){
			$txt .= "<td><a href=\"#\">".$monthgr."</a></td>";
		}
		$txt .= "</tr>";
		
		foreach($sys_ygrp as $ygrp){
			$txt.= "<tr>
			<td>".$array_ygrp_type[$ygrp["type"]]."</td>
			<td>".$array_pigi[$ygrp["pigi"]]."</td>
			<td>".$ygrp["w"]."</td>
			<td>".$ygrp["n"]."</td>";
			foreach($months_en as $monthen){
				$txt.="<td>".$ygrp[$monthen]."</td>";
			}
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Μονάδα παραγωγής Ύγρανσης</div>";
		$txt .= "</div>";//Ύγρανση - Μονάδες παραγωγής
		
		//Ύγρανση - Διανομή
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Δίκτυο διανομής</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td width=20%><a href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
		<td width=30%><a href=\"#\" title=\"Χώρος διέλευσης δικτύου διανομής\">Διέλευση</a></td>
		<td width=15%><a href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>";
		$txt .= "</tr>";
		
		foreach($sys_ygrd as $ygrd){
			$txt.= "<tr>
			<td>".$ygrd["type"]."</td>
			<td>".$array_dtype[$ygrd["dieleysi"]]."</td>
			<td>".$ygrd["n"]."</td>";
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Μονάδα διανομής Ύγρανσης</div>";
		$txt .= "</div>";//Ύγρανση - Διανομή
		
		//Ύγρανση - Διοχέτευση
		$txt .= "<div class=\"panel panel-danger\">";
		$txt .= "<div class=\"panel-heading\">Διοχέτευση</div>";
		$txt .= "<table class=\"table table-bordered table-hover\">";
		$txt .= "<tr class=\"danger\">
		<td width=20%><a href=\"#\" title=\"Τύπος συστήματος\">Τύπος</a></td>
		<td width=15%><a href=\"#\" title=\"Βαθμός απόδοσης\">n</a></td>";
		$txt .= "</tr>";
		
		foreach($sys_ygrt as $ygrt){
			$txt.= "<tr>
			<td>".$ygrt["type"]."</td>
			<td>".$ygrt["n"]."</td>";
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		$txt .= "<div class=\"panel-footer\">Μονάδα διοχέτευσης Ύγρανσης</div>";
		$txt .= "</div>";//Ύγρανση - Διοχέτευση
		
	$txt.= "</div>";//Ύγρανση
	$txt.= "</div>";//tabs content
	
	$txt.= "</div>";//tabs
	
	return $txt;
}



//ΔΗΜΙΟΥΡΓΙΑ ARRAY ΚΕΛΥΦΟΥΣ ΓΙΑ ΤΕΕ-ΚΕΝΑΚ
//Επιστρέφει array με τις τιμές του τοίχου
function array_wall($wallid, $type=1){
	$database = new medoo(DB_NAME);
	if($type==1){$table="meletes_zone_adiafani";}//εάν πρόκειται για ζώνη
	if($type==2){$table="meletes_mthx_adiafani";}//εάν πρόκειται για ΜΘΧ
	$wall_data = $database->select($table,"*",array("id"=>$wallid));//Εύρεση γραμμής στη βάση δεδομένων
	
	//Όνομα/Περιγραφή
	if($wall_data[0]["type"]==3){
		$wall_type = "Μεσοτοιχία";
	}else{
		$wall_type = "Τοίχος";
	}
	$wall_name = $wall_data[0]["name"];
	
	//Προσανατολισμός/Κλίση
	$wall_g = $wall_data[0]["g"];
	$wall_b = $wall_data[0]["b"];
	
	//U
	if($wall_data[0]["u"]!=0){
		$wall_u = $wall_data[0]["u"];
	}else{
		$data_u = $database->select("user_adiafani","u",array("id"=>$wall_data[0]['u_id']) );
		$wall_u=$data_u[0];
	}
	
	//Απορροφητικότητα/Εκπεμπτικότητα
	$data_ap = $database->select("vivliothiki_adiafani_a","a",array("id"=>$wall_data[0]['ap']) );
		$wall_ap=$data_ap[0];
	$data_ek = $database->select("vivliothiki_adiafani_e","e",array("id"=>$wall_data[0]['ek']) );
		$wall_ek=$data_ek[0];
	
}

//Επιστρέφει array με τις τιμές του παραθύρου
function array_window($windowid){

}

//Επιστρέφει array με τις τιμές του δαπέδου
function array_floor($wallid){

}

//Επιστρέφει array με τις τιμές της οροφής
function array_roof($wallid){

}
//########################################

//Αποθηκεύει τα γενικά στοιχεία της μελέτης στον πίνακα user_meletes με UPDATE
function insert_meleti_generaldata($name,$perigrafi,$type,$symptiksi,$address,$address_x,$address_y,$address_z,$ktirio,$kaek,$tmima,$tmima_ar,$xrisi,$climate,$height,$zone,$pros,$idioktitis,$idio_kathestos,$ypeythinos_type,$ypeythinos_name,$ypeythinos_tel,$ypeythinos_mail){
	$database = new medoo(DB_NAME);
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$query_update = array(
		"name"=>$name,
		"perigrafi"=>$perigrafi,
		"type"=>$type,
		"symptiksi"=>$symptiksi,
		"address"=>$address,
		"address_x"=>$address_x,
		"address_y"=>$address_y,
		"address_z"=>$address_z,
		"ktirio"=>$ktirio,
		"kaek"=>$kaek,
		"tmima"=>$tmima,
		"tmima_ar"=>$tmima_ar,
		"xrisi"=>$xrisi,
		"climate"=>$climate,
		"height"=>$height,
		"zone"=>$zone,
		"pros"=>$pros,
		"idioktitis"=>$idioktitis,
		"idio_kathestos"=>$idio_kathestos,
		"ypeythinos_type"=>$ypeythinos_type,
		"ypeythinos_name"=>$ypeythinos_name,
		"ypeythinos_tel"=>$ypeythinos_tel,
		"ypeythinos_mail"=>$ypeythinos_mail
	);
	$update = $database->update("user_meletes", $query_update, $where);
	
	return $update;
}

//Φορτώνει τα γενικά στοιχεία της μελέτης από τον πίνακα user_meletes
function load_meleti_generaldata(){
	$database = new medoo(DB_NAME);
	$table = "user_meletes";
	$columns = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$data = $database->select($table,$columns,$where);
	
	return json_encode($data[0]);
}

//Δέχεται τον πίνακα και το id και επιστρέφει σε json φορματ την array της γραμμής
//Καλείται με το πλήκτρο "επεξεργασία" για την φόρτωση των τιμών της γραμμής στα κελιά.
function get_iddata($table, $id){
	$database = new medoo(DB_NAME);
	$columns = "*";
	if($id!=0){
		$where_user=array("AND"=>array("id"=>$id,"user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	}else{
		$where_user=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	}
	$data_inuser = $database->select($table,$columns,$where_user);
	
	if(count($data_inuser)!=0){
		//επιστρέφει array για javascript
		return json_encode($data_inuser[0]);
	}
}

//Δέχεται τον πίνακα, την μεταβλητή action με τιμές create/update και το id και την $array τιμών
//Προσθέτει η κάνει update την array τιμών στις στήλες μετά το id,user_id,meleti_id.
function insert_iddata($table,$action,$id,$array){
	$database = new medoo(DB_NAME);
	$columns = "*";
	$tables_limited = array(
		"meletes_zone_sys_thermd",
		"meletes_zone_sys_thermt",
		"meletes_zone_sys_coldd",
		"meletes_zone_sys_coldt",
		"meletes_zone_sys_znxd",
		"meletes_zone_sys_znxt",
		"meletes_zone_sys_ygrd",
		"meletes_zone_sys_ygrt",
		"meletes_zone_sys_solar",
		"meletes_zone_sys_light"
	);
	
	$column_names = array_slice(get_columnnames($table), 3);
	
	$query = array();
	$session_array=array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']);
	
	for($i=0; $i<count($column_names); $i++){
		if($array[$i]==""){$array[$i]=0;}
		$query[$column_names[$i]] = $array[$i];
	}
	$query_update = $query;
	$query_insert=array_merge($session_array,$query);
	
	
	if($action == "create" AND $id==0){
		if(in_array($table, $tables_limited)){
		$select = $database->select($table,$columns,array("zone_id"=>$query["zone_id"]));
		$count_select = count($select);
		}
		if($count_select==0){
		$insert = $database->insert($table, $query_insert);
		$txt = "Επιτυχής προσθήκη";
		}else{
		$txt = "Έχει ήδη προστεθεί ".$count_select." στοιχείο για αυτή τη θερμική ζώνη. Σε αυτή την επιλογή δεν μπορείτε να προσθέσετε περισσότερα.";
		}
		$return = "<div class=\"alert alert-success alert-dismissable\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				".$txt."</div>";
	}
	
	if($action == "update"){
		if($id!=0){
			$where_user=array("AND"=>array("id"=>$id,"user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
		}else{
			$where_user=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
		}
		$data_inuser = $database->select($table,$columns,$where_user);
		
		if(count($data_inuser)!=0){
			$update = $database->update($table, $query_update, $where_user);
			$return = "<div class=\"alert alert-warning alert-dismissable\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				Επιτυχής επεξεργασία</div>";
		}
	
	}
	return $return;
}

//Δέχεται τον πίνακα και το id και διαγράφει την γραμμή που βρίσκεται το id
//Ελέγχει αν η γραμμή ανήκει στο συνδεδεμένο χρήστη πρώτα
function del_iddata($table, $id){
	$database = new medoo(DB_NAME);
	$where_user=array("AND"=>array("id"=>$id,"user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_inuser = $database->select($table,$columns,$where_user);
	
	if(count($data_inuser)!=0){
		$where_id = array("id"=>$id);
		$data_table = $database->delete($table,$where_id);
		return "<div class=\"alert alert-danger alert-dismissable\">
				<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				Επιτυχής διαγραφή</div>";
	}
}

//Δέχεται τον πίνακα επιστρέφει τα ονόματα των στηλών
function get_columnnames($table){
	$columns = array();
	$database = new medoo(DB_NAME);
	$data_columns = $database->query("SHOW COLUMNS FROM $table;")->fetchAll();
	
	foreach($data_columns as $data){
		array_push($columns, $data["Field"]);
	}
	return $columns;
}

//Εύρεση διαθέσιμων ζωνών και ΜΘΧ και δημιουργία επιλογών για select
//0 για ΖΩΝΗ, 1 για ΜΘΧ
function meletes_getavailablezones($type){

	confirm_logged_in();
	if($type==0){
		$table="meletes_zones";
	}
	if($type==1){
		$table="meletes_mthx";
	}
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$return = create_select_optionsid($table,"name",$where);
	
	return $return;
}

//Εύρεση τοίχων ανάλογα με τη ζώνη (δημιουργία select)
function meletes_getavailablewalls($type, $zone_id){

	confirm_logged_in();
	if($type==0){
		$prefix="meletes_zone_";
		$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$zone_id));
	}
	if($type==1){
		$prefix="meletes_mthx_";
		$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"mthx_id"=>$zone_id));
	}
	$table=$prefix."adiafani";
	
	$return = create_select_optionsid($table,"name",$where);
	
	return $return;
}
//Εύρεση τοίχων ανάλογα με τη ζώνη (δημιουργία select)
function meletes_getavailableroofs($type, $zone_id){

	confirm_logged_in();
	if($type==0){
		$prefix="meletes_zone_";
		$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$zone_id));
	}
	if($type==1){
		$prefix="meletes_mthx_";
		$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"mthx_id"=>$zone_id));
	}
	$table=$prefix."orofes";
	
	$return = create_select_optionsid($table,"name",$where);
	
	return $return;
}

//Εύρεση ανοιγμάτων στον κάθε υπολογισμό ανοιγμάτων του χρήστη
function meletes_getavailablewindows($u_id){

confirm_logged_in();
	
if($u_id=="u_bytype" OR $u_id=="u_manual"){$return="<option value=\"0\">Άνοιγμα</option>";}
if($u_id!="u_bytype" AND $u_id!="u_manual"){
	$database = new medoo(DB_NAME);
	$table="user_diafani";
	$return = "";
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$u_id));
	$data_table = $database->select($table,"a",$where);
	
	$names_array = explode("|",$data_table[0]);
	
	
	$i=0;
	foreach($names_array as $name){
		if($name!=""){
		$return .= "<option value=\"".$i."\">".$name."</option>";
		}
		$i++;
	}
	
	//$return = $data_table;
}	
	return $return;
}

//Δέχεται τον πίνακα και το zone_id και επιστρέφει τις γραμμές που βρέθηκαν
function meletes_checkfullzone($table, $zone_id){
	$database = new medoo(DB_NAME);
	$columns = "*";
	$where=array("AND"=>array("zone_id"=>$zone_id,"user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data = $database->select($table,$columns,$where);
	
	return count($data);
}


//Εύρεση διαθέσιμων ΘΕΡΜΟΓΕΦΥΡΩΝ και δημιουργία επιλογών για select
function meletes_getthermoselect($type){

	confirm_logged_in();
	$array_dbs = array(
		0=>"ksg",
		1=>"sg",
		2=>"ss",
		3=>"ds",
		4=>"dp",
		5=>"oe",
		6=>"dy",
		7=>"ed",
		8=>"df",
		9=>"pr",
		10=>"lp",
		11=>"yp",
	);
	$table = "vivliothiki_thermo_".$array_dbs[$type];
	
	$return = create_select_optionsid($table,"name");
	
	return $return;
}

//Εύρεση U από υπολογισμό τοίχου
function findu_adiafani($id){
	$database = new medoo(DB_NAME);
	$where=array("AND"=>array("id"=>$id,"user_id"=>$_SESSION['user_id']));
	$u = $database->select("user_adiafani","u",$where);

	return $u[0];
}

//Εύρεση προσανατολισμό από γενικά στοιχεία
function findg_adiafani(){
	$database = new medoo(DB_NAME);
	$where=array("AND"=>array("id"=>$_SESSION['meleti_id'],"user_id"=>$_SESSION['user_id']));
	$meleti = $database->select("user_meletes","pros",$where);

	return $meleti[0];
}

//Εύρεση U από υπολογισμό παραθύρου
//Type: 1-για πεα από τύπο, 2-για μελέτη από id
function findu_diafani($type,$parameters){
	
	if($type==2){
	$id = $parameters[0];
	$no = $parameters[1];
		$database = new medoo(DB_NAME);
		$where=array("AND"=>array("id"=>$id,"user_id"=>$_SESSION['user_id']));
		$data = $database->select("user_diafani","*",$where);
		
		$aw = explode("|", $data[0]["aw"]);
		$ah = explode("|", $data[0]["ah"]);
		$af = explode("|", $data[0]["af"]);
		$uw = explode("|", $data[0]["uwr"]);
		$gw = explode("|", $data[0]["gw"]);
		
		$return = array(
			$aw[$no],
			$ah[$no],
			$af[$no],
			$uw[$no],
			$gw[$no]
		);
		//επιστρέφει array για javascript
		return json_encode($return);
	}
	
	if($type==1){
	
	$array_yalopinakas = array(
		1=>"door",
		2=>"door_mthx",
		3=>"single_u",
		4=>"double6mm_u",
		5=>"double12mm_u",
		6=>"double6mm_lowe_u",
		7=>"double12mm_lowe_u"
	);
	$array_tb = array(
		0=>"vivliothiki_diafani_uw",
		1=>"vivliothiki_diafani_uw_rola",
		2=>"vivliothiki_diafani_uw_ekswfylla"
	);
	
		$typew = $parameters[0];
		$prostasia = $parameters[1];
		$plaisio = $parameters[2];
		$plaisioper = $parameters[3];
		$yalopinakas = $parameters[4];
		
		$database = new medoo(DB_NAME);
		$table=$array_tb[$prostasia];
		$select = $array_yalopinakas[$yalopinakas];
		
		//u
		if($typew==0){
		$where=array("type"=>$plaisio);
		$data = $database->select($table,$select,$where);
		$u = $data[0];
		}
		
		if($typew>=1 AND $typew<=9){
			$where=array("AND"=>array("type"=>$plaisio,"percent_f"=>$plaisioper));
			$data = $database->select($table,$select,$where);
			$u = $data[0];
		}
		
		if($typew==4){
			$u = "3.5";
		}
		if($typew==5){
			$u = "5.7";
		}
		
		//gw
		$select = "f".$plaisioper;
		if($yalopinakas<=2){
			$gw=0;
		}else{
			if($yalopinakas==3){
				$gw_name="Μονός υαλοπίνακας";
			}
			if($yalopinakas==4 OR $yalopinakas==5){
				$gw_name="Διπλός υαλοπίνακας";
			}
			if($yalopinakas==6 OR $yalopinakas==7){
				$gw_name="Διπλός υαλοπίνακας χαμηλής ικανότητας εκπομπής επίστρωση";
			}
			if($plaisio==6){
				$gw_name="Διπλό παράθυρο";
			}
			$data = $database->select("vivliothiki_diafani_gw",$select,array("name"=>$gw_name));
			$gw  = $data[0];
		}
		if($typew==4){
			$gw = "0.3";
		}
		if($typew==5){
			$gw = "0.85";
		}
		
		$return = array(
			$u,
			$gw
		);	
		//επιστρέφει array για javascript
		return json_encode($return);
	}
}

//Εύρεση συντελεστή αερισμού από τύπο ανοίγματος
function findwind_diafani($parameters){
	$typew = $parameters[0];
	$plaisio = $parameters[1];
	$yalopinakas = $parameters[2];
	$pistopoiisi = $parameters[3];
	
	if( ($plaisio>=1 AND $plaisio<=4) OR ($plaisio>=7 AND $plaisio<=9) ){
		$plaisio_name = "Μεταλλικό";
	}
	if( ($plaisio>=5 AND $plaisio<=6) OR ($plaisio==10) ){
		$plaisio_name = "Ξύλινο";
	}
	
	if( $yalopinakas>=1 AND $yalopinakas<=3 ){
		$yalopinakas_name = "Μονός";
	}
	if( $yalopinakas>3 ){
		$yalopinakas_name = "Διπλός";
	}
	
	if($typew==0 OR $typew==2){
		$select = "door";
	}else{
		$select = "window";
	}
	
	$database = new medoo(DB_NAME);
	if($pistopoiisi==1 OR $pistopoiisi==2){
		$where=array("AND"=>array("plaisio"=>$plaisio_name,"yalopinakas"=>$yalopinakas_name,"pistopoiisi"=>$pistopoiisi));
	}else{
		$where=array("pistopoiisi"=>$pistopoiisi);
	}
	$data = $database->select("vivliothiki_diafani_aerismos",$select,$where);
	$return = $data[0];
	
	return $return;
}	

?>