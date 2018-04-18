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
//error_reporting(E_ALL);
if (isset($_GET['export_ziparchive'])){
	define('INCLUDE_CHECK',true);
	require("session.php");
	require("medoo.php");
	$response = save_ziparchive();
	echo $response;
	exit;
}
if (isset($_GET['read_bcxml'])){
	define('INCLUDE_CHECK',true);
	require("session.php");
	$file = $_FILES['file'];
	/*
	//Για αποθήκευση του αρχείου στο server
	$path = "filemanager/userfiles/".$_SESSION["username"]."/meleti_".$_SESSION["meleti_id"]."/";
	move_uploaded_file($_FILES["file"]["tmp_name"], $path.$_FILES["file"]["name"]);
	$response = xml_load_bc($path.$_FILES["file"]["name"]);
	*/
	$response = xml_read_bc($_FILES["file"]["tmp_name"]);
	echo $response;
	exit;
}
if (isset($_GET['read_teexml'])){
	define('INCLUDE_CHECK',true);
	require("session.php");
	require("medoo.php");
	$file = $_FILES['file'];
	$response = xml_read_tee($_FILES["file"]["tmp_name"]);
	echo $response;
	exit;
}
if (isset($_GET['export_senario'])){
	define('INCLUDE_CHECK',true);
	require("session.php");
	$file = $_FILES['file'];
	$bldrid = $_GET['bldrid'];
	$file_bldrid=$bldrid-1;
	
	if (isset($_SESSION['username'])){
		$path = "file_upload/server/php/files/user_".$_SESSION["user_id"]."/meleti_".$_SESSION["meleti_id"]."/senario".$file_bldrid.".xml";
	}else{
		$path = "file_upload/server/php/files/guests/senario/senario_".date("dmY_His").".xml";
	}
	
	$response = xml_save_senario($_FILES["file"]["tmp_name"],$bldrid);
	file_put_contents($path, $response);
	
	$return = "<a href=\"includes/".$path."\">XML με σενάριο</a>";
	$return .= "<br/><font color=\"red\">ΠΡΟΣΟΧΗ: Εξαιτίας της κωδικοποίησης στην php είναι απαραίτητο να ξανα-ανοίξετε 
	το xml στο TEE-KENAK και να το σώσετε πατώντας \"Αποθήκευση\"!</font>";
	echo $return;
	exit;
}
if (isset($_GET['reorder_senario'])){
	define('INCLUDE_CHECK',true);
	require("session.php");
	$file = $_FILES['file'];
	$bld2rid = $_GET['bld2rid'];
	$bld3rid = $_GET['bld3rid'];
	$bld4rid = $_GET['bld4rid'];

	if (isset($_SESSION['username'])){
		$path = "file_upload/server/php/files/user_".$_SESSION["user_id"]."/meleti_".$_SESSION["meleti_id"]."/senario_reordered.xml";
	}else{
		$path = "file_upload/server/php/files/guests/senario/senario_reordered_".date("dmY_His").".xml";
	}
	
	$response = xml_reorder_senario($_FILES["file"]["tmp_name"],$bld2rid,$bld3rid,$bld4rid);
	file_put_contents($path, $response);
	
	$return = "<a href=\"includes/".$path."\">XML με ανακατανομή σεναρίων</a>";
	$return .= "<br/><font color=\"red\">ΠΡΟΣΟΧΗ: Εξαιτίας της κωδικοποίησης στην php είναι απαραίτητο να ξανα-ανοίξετε 
	το xml στο TEE-KENAK και να το σώσετε πατώντας \"Αποθήκευση\"!</font>";
	echo $return;
	exit;
}
if (isset($_GET['save_teexml'])){
	define('INCLUDE_CHECK',true);
	require("session.php");
	require("medoo.php");
	confirm_logged_in();
	require("functions_math.php");
	require("functions_skiaseis.php");
	$response = xml_save_tee();
	echo $response;
	exit;
}
require("include_check.php");


//Αποθήκευση εικόνα σε JPEG
function save_image($inPath,$outPath){ //Download images from remote server
    $in=    fopen($inPath, "rb");
    $out=   fopen($outPath, "wb");
    while ($chunk = fread($in,8192))
    {
        fwrite($out, $chunk, 8192);
    }
    fclose($in);
    fclose($out);
}

//Αποθήκευση σκαριφημάτων
function save_ziparchive(){
	
	confirm_logged_in();
	
	$zip = new ZipArchive();
	$folder="file_upload/server/php/files/user_".$_SESSION["user_id"]."/meleti_".$_SESSION["meleti_id"]."/";
	$filename = $folder."meleti".$_SESSION["meleti_id"]."_".date("dmY_His").".zip";
	
	if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
		return "cannot open <$filename>\n";
	}
	
	$database = new medoo(DB_NAME);
	$tb = "meletes_zone_adiafani";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$data_allwalls = $database->select($tb,$col,$where);
	
	//Βρίσκω τους ορόφους και τους βάζω σε σειρά από μικρότερο σε μεγαλύτερο
	$array_floors=array();
	foreach($data_allwalls as $wall){
		array_push($array_floors, $wall["roof"]);
		
		if(file_exists($folder."wallid_".$wall["id"].".png")){
			$zip->addFile($folder."wallid_".$wall["id"].".png", "wallid_".$wall["id"].".png");
		}
	}
	$array_floors = array_unique($array_floors);
	
	$txt = "";
	foreach($array_floors as $floor){
		
		$url = "draw_floor.php?floor=".$floor;
		$img = $folder."floor_".$floor.".png";
		
		//Προσθήκη στο zip
		$zip->addFile($img, "floor_".$floor.".png");
	}
	
	if(file_exists($folder."location_osm.jpg")){
		$zip->addFile($folder."location_osm.jpg", "location_osm.jpg");
	}
	
	//$zip->addFromString("testfilephp.txt" . time(), "#1 This is a test string added as testfilephp.txt.\n");
	//$zip->addFromString("testfilephp2.txt" . time(), "#2 This is a test string added as testfilephp2.txt.\n");
	//$zip->addFile($thisdir . "/too.php","/testfromfile.php");
	$return = "Σύνολο αρχείων στο zip: " . $zip->numFiles . "\n";
	$return .= "Κατάσταση:" . $zip->status . "\n";
	$zip->close();
	
	$return .= "<a href=\"includes/".$filename."\">Συμπιεσμένο αρχείο σκαριφημάτων</a>";
	return $return;
}

//Ανάγνωση αρχείου xml από BC. Παραγωγή array
function xml_read_bc($file){
	$xml = simplexml_load_file($file);
	$return = array(
		"id"=>$xml->EPA_NR_PROJECT->id->__toString(),
		"blg_type"=>$xml->EPA_NR_PROJECT->blg_type->__toString(),
		"blg_use"=>$xml->EPA_NR_PROJECT->blg_use->__toString(),
		"blg_part"=>$xml->EPA_NR_PROJECT->blg_part->__toString(),
		"building_num"=>$xml->EPA_NR_PROJECT->building_num->__toString(),
		"blg_kaek"=>$xml->EPA_NR_PROJECT->blg_kaek->__toString(),
		"blg_owner"=>$xml->EPA_NR_PROJECT->blg_owner->__toString(),
		"blg_ownership"=>$xml->EPA_NR_PROJECT->blg_ownership->__toString(),
		"blg_address"=>$xml->EPA_NR_PROJECT->blg_address->__toString(),
		"blg_resp"=>$xml->EPA_NR_PROJECT->blg_resp->__toString(),
		"blg_resp_name"=>$xml->EPA_NR_PROJECT->blg_resp_name->__toString(),
		"blg_resp_phone"=>$xml->EPA_NR_PROJECT->blg_resp_phone->__toString(),
		"blg_resp_mail"=>$xml->EPA_NR_PROJECT->blg_resp_mail->__toString()
	);
	return json_encode($return);
}

//Ανάγνωση αρχείου xml. Παραγωγή html
function xml_read_tee($file){

	$array_checkbox = array(
	0=>"Όχι",
	1=>"Ναί"
	);
	$array_blg_ownership = array(
	0=>"Δημόσιο",
	1=>"Ιδιωτικό",
	2=>"Δημόσιο ιδιωτικού ενδιαφέροντος",
	3=>"Ιδιωτικό δημοσίου ενδιαφέροντος"
	);
	$array_blg_resp = array(
	0=>"Ιδιοκτήτης",
	1=>"Διαχειριστής",
	2=>"Ενοικιαστής",
	3=>"Τεχνικός υπεύθυνος",
	4=>"Άλλο"
	);
	$array_blg_zone = array(
	0=>"Α",
	1=>"Β",
	2=>"Γ",
	3=>"Δ"
	);
	
	$database = new medoo(DB_NAME);
	$tb = "vivliothiki_xml";
	$col = "*";
	$elements_general = $database->select($tb,$col,array("parent"=>"EPA_NR_PROJECT") );
	$elements_building = $database->select($tb,$col,array("parent"=>"BUILDING") );
	$elements_zone = $database->select($tb,$col,array("parent"=>"ZONE") );
	$elements_adiafani = $database->select($tb,$col,array("parent"=>"ENVELOPE") );

	$xml = simplexml_load_file($file);
	
	//για κάθε element φτιάχνω μια array με ονόματα τα ονόματα των element και τις τιμές τους.
	$values = array();
	foreach($elements_general as $element){
	$values[$element["element"]]=$xml->$element["parent"]->$element["element"]->__toString();
	}
	
	$count_buildings=0;
	$count_zones = 0;
	foreach($xml->BUILDING as $BUILDING){
	$count_buildings++;
		if($BUILDING["rid"]=="1"){
			$yparxon = $BUILDING;
			$count_zones = $BUILDING->blg_parameter11;
		}
	}
	$count_senaria = $count_buildings-1;
	
	$txt = "<div class=\"panel panel-success\">
	<div class=\"panel-heading\">Γενικά</div>
	<div class=\"panel-body\">";
	$txt .= "<b>Α/Α αρχείου:</b> ".$values["id"]."<br/>";
	$txt .= "<b>Χρήση κτιρίου:</b> ".$values["blg_use"]."<br/>";
	$txt .= "<b>Τμήμα κτιρίου:</b> ".$array_checkbox[$values["blg_part"]]."<br/>";
	$txt .= "<b>Αρ. ιδιοκτησίας:</b> ".$values["building_num"]."<br/>";
	$txt .= "<b>ΚΑΕΚ:</b> ".$values["blg_kaek"]."<br/>";
	$txt .= "<b>Ιδιοκτήτης:</b> ".$values["blg_owner"]."<br/>";
	$txt .= "<b>Ιδιοκτησία:</b> ".$array_blg_ownership[$values["blg_ownership"]]."<br/>";
	$txt .= "<b>Διεύθυνση ακινήτου:</b> ".$values["blg_address"]."<br/>";
	$txt .= "<b>Είδος υπευθύνου:</b> ".$array_blg_resp[$values["blg_resp"]]."<br/>";
	$txt .= "<b>Υπεύθυνος:</b> ".$values["blg_resp_name"]."<br/>";
	$txt .= "<b>Τηλέφωνο υπευθύνου:</b> ".$values["blg_resp_phone"]."<br/>";
	$txt .= "<b>Mail υπευθύνου:</b> ".$values["blg_resp_mail"]."<br/>";
	$txt .= "<b>Κλιματική ζώνη:</b> ".$array_blg_zone[$values["blg_zone"]]."<br/>";
	$txt .= "<b>Υψόμετρο >500m:</b> ".$array_checkbox[$values["blg_height"]]."<br/>";
	$txt .= "<b>Κλιματολογικά δεδομένα:</b> ".$values["blg_climate"]."<br/>";
	$txt .= "<b>Πηγές δεδομένων:</b> ".$values["blg_datasource"]."<br/>";
	$txt .= "<b>Οικ. Άδειες:</b> ".$values["blg_licence_data"]."<br/>";
	$txt .= "<b>Έκδοση τεε-κενακ:</b> ".$values["version_tee_kenak_dll"]."<br/>";
	$txt .= "<b>Σενάρια:</b> ".$count_senaria."<br/><br/>";
	$txt .= "</div><div class=\"panel-footer\">Γενικά στοιχεία μελέτης / επιθεώρησης.</div></div>";
	
	$txt .= "<div class=\"panel panel-success\">
	<div class=\"panel-heading\">Αντίγραφα κτιρίων</div>
	<div class=\"panel-body\">";
	$txt .= "<ul class=\"nav nav-pills\">";
	foreach($xml->BUILDING as $BUILDING){
		if($BUILDING["rid"]==1){
		$txt .= "<li class=\"active\"><a href=\"#ktirio".$BUILDING["rid"]."\" data-toggle=\"tab\">Κτίριο ".$BUILDING["rid"]."- Υπάρχον κτίριο</a></li>";
		}else{
		$txt .= "<li><a href=\"#ktirio".$BUILDING["rid"]."\" data-toggle=\"tab\">Κτίριο ".$BUILDING["rid"]." - Σενάριο</a></li>";
		}
	}
	$txt .= "</ul>";
	$txt .= "<div class=\"tab-content\">";
	
	foreach($xml->BUILDING as $BUILDING){
		
		if($BUILDING["rid"]==1){
			$txt .= "<div class=\"tab-pane active\" id=\"ktirio".$BUILDING["rid"]."\">";
		}else{
			$txt .= "<div class=\"tab-pane\" id=\"ktirio".$BUILDING["rid"]."\">";
		}
		
		foreach($elements_building as $element){
			$txt .= "<b>".$element["gr_name"].":</b> ".$BUILDING->$element["element"]."<br/>";
			$zone_count = $BUILDING->blg_parameter11;
			$mthx_count = $BUILDING->blg_parameter12;
			$solar_count = $BUILDING->blg_parameter13;
		}
		
		
		//ΘΕΡΜΙΚΕΣ ΖΩΝΕΣ		
		$txt .= "<div class=\"panel-group\" id=\"accordionzones_building".$BUILDING["rid"]."\">";
		
		for($i=1; $i<=$zone_count; $i++){
			
			$txt .= "<div class=\"panel panel-default\">
			<div class=\"panel-heading\">
			<a data-toggle=\"collapse\" data-parent=\"#accordionzones_building".$BUILDING["rid"]."\" href=\"#b".$BUILDING["rid"]."zone".$i."\">Ζώνη ".$i."</a>
			</div>
			<div id=\"b".$BUILDING["rid"]."zone".$i."\" class=\"panel-collapse collapse\">";
			
			foreach($elements_zone as $element){
				$txt .= "<b>".$element["gr_name"].":</b> ".$BUILDING->{"ZONE".$i}->$element["element"]."<br/>";
			}
			$txt  .= "<br/><br/>Αδιαφανή<hr>";
			$txt  .= "<table class=\"table table-bordered\">";
			$txt .= "<tr>";
			for($z=1; $z<=16; $z++){
			$txt .= "<td>".$elements_adiafani[$z]["gr_name"]."</td>";
			}
			$txt .= "</tr>";
			
				for($k=1;$k<=$BUILDING->{"ZONE".$i}->ENVELOPE->opaque_rows; $k++){
				$txt  .= "<tr>";
					for($kk=1;$kk<=16;$kk++){
						$adiafani_val = explode(",", $BUILDING->{"ZONE".$i}->ENVELOPE->{"opaque_column".$kk});
						$txt .= "<td>".$adiafani_val[$k]."</td>";
					}
				$txt  .= "</tr>";	
				}
			$txt  .= "</table>";
			$txt  .= "</div></div>";//accordion
		}
		//ΘΕΡΜΙΚΕΣ ΖΩΝΕΣ
		
		$txt .= "</div>";//accordions
		$txt .= "</div>";//tab
	}
	$txt .= "</div>";//tab-content (ζωνες)
	$txt .= "</div></div>";//panel (κτίρια)
	return $txt;
}


//Εξαγωγή σεναρίου
function xml_save_senario($file,$bldrid=4){
	
	$xml = simplexml_load_file($file);
	for ($i=1; $i<=4; $i++){
		foreach($xml->BUILDING as $BUILDING){
			if($BUILDING['rid'] != "$bldrid") {
				$dom=dom_import_simplexml($BUILDING);
				$dom->parentNode->removeChild($dom);
			}
		}
	}
	foreach($xml->BUILDING as $BUILDING){
		$BUILDING['rid'] = 1;
		for($i=1; $i<=10; $i++){
			if(isset($BUILDING->{"ZONE".$i})){
			$BUILDING->{'ZONE'.$i}["rid"]=1;
			$BUILDING->{'ZONE'.$i}->ENVELOPE["rid"]=1;
				for($z=1;$z<=10;$z++){
				$BUILDING->{'ZONE'.$i}->ENVELOPE->{'internal'.$z}["rid"]=1;
				}
			$BUILDING->{'ZONE'.$i}->SYSTEM["rid"]=1;
			$BUILDING->{'ZONE'.$i}->SYSTEM->heating["rid"]=1;
			$BUILDING->{'ZONE'.$i}->SYSTEM->cooling["rid"]=1;
			$BUILDING->{'ZONE'.$i}->SYSTEM->humidification["rid"]=1;
			$BUILDING->{'ZONE'.$i}->SYSTEM->ahu["rid"]=1;
			$BUILDING->{'ZONE'.$i}->SYSTEM->dhw["rid"]=1;
			$BUILDING->{'ZONE'.$i}->SYSTEM->solar_collector["rid"]=1;
			$BUILDING->{'ZONE'.$i}->SYSTEM->lighting["rid"]=1;
			}
			if(isset($BUILDING->{"UNHEATED".$i})){
			$BUILDING->{'UNHEATED'.$i}["rid"]=1;
			$BUILDING->{'UNHEATED'.$i}->ENVELOPE["rid"]=1;
			}
			if(isset($BUILDING->{"SOLAR".$i})){
			$BUILDING->{'SOLAR'.$i}["rid"]=1;
			$BUILDING->{'SOLAR'.$i}->ENVELOPE["rid"]=1;
			}
		}
	}
	return $xml->asXml();
}

//Ανακατανομή σεναρίων
function xml_reorder_senario($file,$bld2rid=4,$bld3rid=3,$bld4rid=2){

	$xml = simplexml_load_file($file);
	
	foreach($xml->BUILDING as $BUILDING){
		if($BUILDING['rid'] == 1){$bldrid = 1;}//Θέση σεναρίου
		if($BUILDING['rid'] == 2){$bldrid = $bld2rid;}//Θέση σεναρίου 1
		if($BUILDING['rid'] == 3){$bldrid = $bld3rid;}//Θέση σεναρίου 2
		if($BUILDING['rid'] == 4){$bldrid = $bld4rid;}//Θέση σεναρίου 3
		
		$BUILDING['rid'] = $bldrid;
		
		for($i=1; $i<=10; $i++){//για 10 θερμικές ζώνες
			if(isset($BUILDING->{"ZONE".$i})){
			$BUILDING->{'ZONE'.$i}["rid"]=$bldrid;
			$BUILDING->{'ZONE'.$i}->ENVELOPE["rid"]=$bldrid;
				for($z=1;$z<=10;$z++){//Εάν υπάρχουν διαχωριστικές
				$BUILDING->{'ZONE'.$i}->ENVELOPE->{'internal'.$z}["rid"]=$bldrid;
				}
			$BUILDING->{'ZONE'.$i}->SYSTEM["rid"]=$bldrid;
			$BUILDING->{'ZONE'.$i}->SYSTEM->heating["rid"]=$bldrid;
			$BUILDING->{'ZONE'.$i}->SYSTEM->cooling["rid"]=$bldrid;
			$BUILDING->{'ZONE'.$i}->SYSTEM->humidification["rid"]=$bldrid;
			$BUILDING->{'ZONE'.$i}->SYSTEM->ahu["rid"]=$bldrid;
			$BUILDING->{'ZONE'.$i}->SYSTEM->dhw["rid"]=$bldrid;
			$BUILDING->{'ZONE'.$i}->SYSTEM->solar_collector["rid"]=$bldrid;
			$BUILDING->{'ZONE'.$i}->SYSTEM->lighting["rid"]=$bldrid;
			}
			if(isset($BUILDING->{"UNHEATED".$i})){//εάν υπάρχουν ΜΘΧ
			$BUILDING->{'UNHEATED'.$i}["rid"]=$bldrid;
			$BUILDING->{'UNHEATED'.$i}->ENVELOPE["rid"]=$bldrid;
			}
			if(isset($BUILDING->{"SOLAR".$i})){//εάν υπάρχουν ηλιακοί χώροι
			$BUILDING->{'SOLAR'.$i}["rid"]=$bldrid;
			$BUILDING->{'SOLAR'.$i}->ENVELOPE["rid"]=$bldrid;
			}
		}//για κάθε ζώνη
	}//για κάθε κτίριο (υπάρχον, σενάριο1, σενάριο2, σενάριο3
	return $xml->asXml();
}


//ΠΑΡΑΓΩΓΗ ΑΡΧΕΙΟΥ XML ΣΤΗ ΜΟΡΦΗ ΤΟΥ ΤΕΕ-ΚΕΝΑΚ ΓΙΑ ΝΑ ΤΟ ΑΝΟΙΞΩ ΕΚΕΙ. 
function xml_save_tee(){
	
	$database = new medoo(DB_NAME);
	//Στοιχεία μελέτης
	$where_id=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$data_general = $database->select("user_meletes","*",$where_id);
	$data_general=$data_general[0];
	
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	
	//Στοιχεία ΠΕΑ
	$data_pea = $database->select("meletes_stoixeiapea","*",$where);
	$data_pea = $data_pea[0];
	
	//ΟΙΚΟΔΟΜΙΚΕΣ ΑΔΕΙΕΣ
	$data_oikad = $database->select("meletes_oikad","*",$where);
	$count_oikad = $database->count("meletes_oikad",$where);
	$blg_licence_data = "";
	foreach($data_oikad as $adeia){
		$blg_licence_data .= $adeia["condition"].",";
		$blg_licence_data .= $adeia["desc"].",";
		$blg_licence_data .= $adeia["datasource"].",";
		$blg_licence_data .= $adeia["yearpermit"].",";
		$blg_licence_data .= $adeia["year"].",";
	}
	//ΚΑΤΑΝΑΛΩΣΕΙΣ
	$array_katanalwsi=array(
		0=>"Ηλεκτρική",
		1=>"Πετρέλαιο θέρμανσης",
		2=>"Πετρέλαιο κίνησης",
		3=>"Φυσικο αέριο",
		4=>"Υγραέριο",
		5=>"Βιομάζα",
		6=>"Τηλεθέρμανση"
	);
	$array_bldtrue=array(
		0=>"false",
		1=>"true"
	);
	$data_katanalwseis = $database->select("meletes_katanalwseis","*",$where);
	$count_katanalwseis = $database->count("meletes_katanalwseis",$where);
	$blg_katanalwseis = "";
	foreach($data_katanalwseis as $katanalwsi){
		$blg_katanalwseis .= $array_katanalwsi[$katanalwsi["pigi"]].",";
		$blg_katanalwseis .= $array_bldtrue[$katanalwsi["therm"]].",";
		$blg_katanalwseis .= $array_bldtrue[$katanalwsi["cold"]].",";
		$blg_katanalwseis .= $array_bldtrue[$katanalwsi["air"]].",";
		$blg_katanalwseis .= $array_bldtrue[$katanalwsi["znx"]].",";
		$blg_katanalwseis .= $array_bldtrue[$katanalwsi["lights"]].",";
		$blg_katanalwseis .= $array_bldtrue[$katanalwsi["syskeyes"]].",";
		$blg_katanalwseis .= $katanalwsi["katanalwsi"].",";
		$blg_katanalwseis .= $katanalwsi["periodos"].",";
	}
	
	//ΥΔΡΕΥΣΗ - ΑΡΔΕΥΣΗ
	$array_ydreysi=array(
		0=>"Ύδρευση",
		1=>"Άρδευση",
		2=>"Αποχέτευση"
	);
	$data_water = $database->select("meletes_ydreysi","*",$where);
	$count_water = $database->count("meletes_ydreysi",$where);
	$blg_water = "";
	foreach($data_water as $water){
		$blg_water .= $array_ydreysi[$water["type"]].",";
		$blg_water .= $water["n"].",";
		$blg_water .= $water["p"].",";
		$blg_water .= $water["t"].",";
		$blg_water .=$array_bldtrue[$water["s"]].",";
	}
	
	//ΑΝΕΛΚΥΣΤΗΡΕΣ
	$array_anelkystires=array(
		0=>"Μηχανικός ανελκυστήρας",
		1=>"Υδραυλικός ανελκυστήρας",
		2=>"Κυλιόμενες σκάλες",
		3=>"Κυλιόμενοι διάδρομοι"
	);
	$data_lifts = $database->select("meletes_anelkystires","*",$where);
	$count_lifts = $database->count("meletes_anelkystires",$where);
	$blg_lifts = "";
	foreach($data_lifts as $lift){
		$blg_lifts .= $array_anelkystires[$lift["type"]].",";
		$blg_lifts .= $lift["n"].",";
		$blg_lifts .= $lift["p"].",";
		$blg_lifts .= $lift["t"].",";
		$blg_lifts .=$array_bldtrue[$lift["a"]].",";
	}
	
	//ΑΝΕΜΟΓΕΝΝΗΤΡΙΕΣ
	$array_wind=array(
		0=>"Αυτόνομο",
		1=>"Διασυνδεδεμένο"
	);
	$data_wind = $database->select("meletes_anemogenitries","*",$where);
	$count_wind = $database->count("meletes_anemogenitries",$where);
	if($count_wind>0){
		$exist_wind = 1;
	}else{
		$exist_wind = 0;
	}
	$blg_wind = "";
	foreach($data_wind as $wind){
		$blg_wind .= $array_wind[$wind["type"]].",";
		$blg_wind .= $wind["p"].",";
		$blg_wind .= $wind["n"].",";
		$blg_wind .= $wind["xwros"].",";
	}
	
	//ΣΗΘ
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
	$data_sith = $database->select("meletes_sith","*",$where);
	$count_sith = $database->count("meletes_sith",$where);
	if($count_sith>0){
		$exist_sith = 1;
	}else{
		$exist_sith = 0;
	}
	$blg_sith = "";
	foreach($data_sith as $sith){
		$blg_sith .= $array_sith_type[$sith["type"]].",";
		$blg_sith .= $array_sith_pigi[$sith["pigi"]].",";
		$blg_sith .= $sith["n_elec"].",";
		$blg_sith .= $sith["n_therm"].",";
	}
	
	//ΦΩΤΟΒΟΛΤΑΙΚΑ
	$array_pv=array(
		0=>"Μονοκρυσταλλικό",
		1=>"Πολυκρυσταλλικό",
		2=>"Λεπτού υμένα άμορφο a-S",
		3=>"Λεπτού υμένα μικρομορφικό μ-Si",
		4=>"Λεπτού υμένα CIS-CIGS",
		5=>"Λεπτού υμένα Cd-Te",
		6=>"Τριπλής επαφής (Triple junction)"
	);
	$array_connection=array(
		0=>"Με συμψηφισμό",
		1=>"Χωρίς συμψηφισμό"
	);
	$data_pv = $database->select("meletes_pv","*",$where);
	$count_pv = $database->count("meletes_pv",$where);
	if($count_pv>0){
		$exist_pv = 1;
	}else{
		$exist_pv = 0;
	}
	$blg_pv = "";
	foreach($data_pv as $pv){
		$blg_pv .= $array_pv[$pv["type"]].",";
		$blg_pv .= $pv["n"].",";
		$blg_pv .= $pv["e"].",";
		$blg_pv .= $pv["p"].",";
		$blg_pv .= $pv["g"].",";
		$blg_pv .= $pv["b"].",";
		$blg_pv .= $pv["f_s"].",";
		$blg_pv .= $array_connection[$pv["connection"]].",";
	}
	
	
	$array_window_type = array(
		0=>"Αδιαφανής πόρτα",
		1=>"Παράθυρο",
		2=>"Πόρτα",
		3=>"Μη ανοιγόμενο κούφωμα",
		4=>"Υαλότουβλα",
		5=>"Ανοιγόμενη γυάλινη πρόσοψη"
	);
	
	
	//Στοιχεία - Γενικά στοιχεία (χώροι, εμβαδά)
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
	if($data_general["xrisi"]==1 OR $data_general["xrisi"]==2){
		$building_e_cold=$building_e_heat/2;
		$building_v_cold=$building_v_heat/2;
	}else{
		$building_e_cold=$building_e_heat;
		$building_v_cold=$building_v_heat;
	}
	
	//Προσανατολισμός κτιρίου
	$building_g = $data_general["pros"];
	//Σύμπτυξη γραμμών
	$symptiksi = $data_general["symptiksi"];
	
	//Ύψος ορόφων, συνθήκες άνεσης, κλπ
	$building_datapea = $database->select("meletes_stoixeiapea","*",$where);
	$building_datapea = $building_datapea[0];
	
	$building_thermokat = $building_datapea["thermo_kat"];
	$building_levels = $building_datapea["levels"];
	$building_typicalh = $building_datapea["typical_h"];
	$building_floorh = $building_datapea["floor_h"];
	$building_ekthesi = $building_datapea["ekthesi"];
	$building_synthikes = $building_datapea["synthikes"];
	
	//Αριθμός ζωνών, ΜΘΧ, Ηλιακών
	$where_mthxs=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'], "type"=>"0"));
	$where_solars=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'], "type"=>"1"));
	$building_zones = $database->count("meletes_zones",$where);
	$building_mthxs = $database->count("meletes_mthx",$where_mthxs);
	$building_solars = $database->count("meletes_mthx",$where_solars);
	
	//Χρήση-όνομα
	$building_xrisi = $database->select("vivliothiki_conditions_building","name",array("id"=>$data_general["xrisi"]));
	$building_xrisi = $building_xrisi[0];
	
	
	//Συντελεστές μηνών από πίνακες - Επιλογή πινάκων με βάση κλιματική ζώνη
	if($data_general["zone"]==0 OR $data_general["zone"]==1){
		$tb_months_heat = "vivliothiki_monthsoff_heat_a";
		$tb_months_cold = "vivliothiki_monthsoff_cold_a";
	}else{
		$tb_months_heat = "vivliothiki_monthsoff_heat_c";
		$tb_months_cold = "vivliothiki_monthsoff_cold_c";
	}
	
	if($building_thermokat==1){
		$u_plus=0.2;
	}else{
		$u_plus=0.0;
	}
	
	
	//################################### ΑΡΧΗ XML ###################################
	//ΔΗΜΙΟΥΡΓΙΑ XML ΤΗΣ ΜΟΡΦΗΣ ΤΕΕ-ΚΕΝΑΚ
	$domtree = new DOMDocument('1.0', 'UTF-8');
	//Αρχή
    //create the root element of the xml tree
    $xmlRoot = $domtree->createElement("ENR_IN");
    //append it to the document created
    $xmlRoot = $domtree->appendChild($xmlRoot);

    $epa_nr_project = $domtree->createElement("EPA_NR_PROJECT");
    $epa_nr_project = $xmlRoot->appendChild($epa_nr_project);
	$epa_nr_project->setAttribute('rid', '#1');
	
    //Ενεργειακή μελέτη/επιθεώρηση
	$epa_nr_project->appendChild($domtree->createElement('id',""));
    $epa_nr_project->appendChild($domtree->createElement('blg_use',$data_general["xrisi"]));//id χρήσης κτιρίου
    $epa_nr_project->appendChild($domtree->createElement('blg_part',$data_general["tmima"]));//Τμήμα κτιρίου
	$epa_nr_project->appendChild($domtree->createElement('building_num',$data_general["tmima_ar"]));//Αριθμός τμήματος
	$epa_nr_project->appendChild($domtree->createElement('blg_kaek',$data_general["kaek"]));//ΚΑΕΚ
	$epa_nr_project->appendChild($domtree->createElement('blg_owner',$data_general["idioktitis"]));//Ιδιοκτήτης
	$epa_nr_project->appendChild($domtree->createElement('blg_ownership',$data_general["idio_kathestos"]));//Ιδιοκτησιακό καθεστώς
	$epa_nr_project->appendChild($domtree->createElement('blg_address',$data_general["address"]));//Διεύθυνση ακινήτου
	$epa_nr_project->appendChild($domtree->createElement('blg_resp',$data_general["ypeythinos_type"]));//Τύπος υπευθύνου
	$epa_nr_project->appendChild($domtree->createElement('blg_resp_name',$data_general["ypeythinos_name"]));//Όνομα υπευθύνου
	$epa_nr_project->appendChild($domtree->createElement('blg_resp_phone',$data_general["ypeythinos_tel"]));//Τηλέφωνο υπευθύνου
	$epa_nr_project->appendChild($domtree->createElement('blg_resp_mail',$data_general["ypeythinos_mail"]));//Μειλ υπευθύνου
	$epa_nr_project->appendChild($domtree->createElement('blg_zone',$data_general["zone"]));//Κλιματική ζώνη Α,Β,Γ,Δ
	$epa_nr_project->appendChild($domtree->createElement('blg_height',$data_general["height"]));//Υψόμετρο >500m
	$epa_nr_project->appendChild($domtree->createElement('blg_climate',$data_general["climate"]));//Κλιματικά δεδομένα
	$epa_nr_project->appendChild($domtree->createElement('blg_datasource',$data_pea["piges"]));//Πηγές δεδομένων λίστα
	$epa_nr_project->appendChild($domtree->createElement('blg_licence_data',$blg_licence_data));//Άδειες
	$epa_nr_project->appendChild($domtree->createElement('version_tee_kenak_dll','1.31.1.9'));//Έκδοση ΤΕΕ-ΚΕΝΑΚ
	$epa_nr_project->appendChild($domtree->createElement('blg_type',$data_general["type"]));//Τύπος κτιρίου (παλιό, ριζ. ανακ.)
	
	//Βιβλιοθήκες
	$libraries = $domtree->createElement("LIBRARIES");
    $libraries = $xmlRoot->appendChild($libraries);
	$libraries->setAttribute('rid', '#2');
	
	$libraries->appendChild($domtree->createElement('id','Lib'));
	$libraries->appendChild($domtree->createElement('lib_const','C:\Program Files (x86)\TEE\TEE_KENAK_1_31\EnrConstGr.xml'));
	$libraries->appendChild($domtree->createElement('lib_clim','C:\Program Files (x86)\TEE\TEE_KENAK_1_31\EnrClimateGR.xml'));
	$libraries->appendChild($domtree->createElement('lib_fuel','C:\Program Files (x86)\TEE\TEE_KENAK_1_31\EnrFuelGr.xml'));
	
	//##########################################
	//ΧΩΡΟΣ ΓΙΑ ΣΕΝΑΡΙΑ
	//Επιλογή σεναρίων - Επιλογές
	$data_senaria = $database->select("meletes_senaria","*",$where);
	$data_senaria = $data_senaria[0];
	
	$senaria_active=explode("|",$data_senaria["active"]);
	$senaria_names=explode("|",$data_senaria["perigrafi"]);
	
	$senaria_u=explode("^",$data_senaria["u"]);
	$senaria_u_walls=explode("|",$senaria_u[0]);
	$senaria_u_roofs=explode("|",$senaria_u[1]);
	$senaria_u_floors=explode("|",$senaria_u[2]);
	$senaria_u_wins=explode("|",$senaria_u[3]);
	
	$senaria_therm=explode("^",$data_senaria["thermp"]);
	$senaria_therm_type=explode("|",$senaria_therm[0]);
	$senaria_therm_pigi=explode("|",$senaria_therm[1]);
	$senaria_therm_n=explode("|",$senaria_therm[2]);
	$senaria_therm_cop=explode("|",$senaria_therm[3]);
	
	$senaria_cold=explode("^",$data_senaria["coldp"]);
	$senaria_cold_type=explode("|",$senaria_cold[0]);
	$senaria_cold_pigi=explode("|",$senaria_cold[1]);
	$senaria_cold_n=explode("|",$senaria_cold[2]);
	$senaria_cold_eer=explode("|",$senaria_cold[3]);
	
	$senaria_solar=explode("^",$data_senaria["znxp"]);
	$senaria_solar_type=explode("|",$senaria_solar[0]);
	$senaria_solar_e=explode("|",$senaria_solar[1]);
	
	$senaria_light=explode("|",$data_senaria["light"]);
	//Array Υπάρχον κτίριο, σενάριο 1, 2, 3
	
	//##########################################
	
	//Ονόματα σεναρίων - Υπάρχοντος κτιρίου
	$bld_name=array(
		1=>"Υπάρχον κτίριο",
		2=>$senaria_names[0],
		3=>$senaria_names[1],
		4=>$senaria_names[2]
	);
	$walls_cost=50;
	$roofs_cost=40;
	$floors_cost=50;
	$wins_cost=280;
	
	//##################### ΑΡΧΗ ΚΤΙΡΙΟΥ ###########################
	$rid=1;//μετράει από το 1 έως το 4. Μπορεί να σταματάει στο 2 ή 3 εάν δεν είναι όλα τα σενάρια ενεργά
	for($zzz=1;$zzz<=4;$zzz++){//Για κάθε σενάριο ($zzz είναι η μέτρηση του loop για να γίνει 4 φορές, διαφορετικό από το $rid)
		
	$senaria_u_walls_cost="";
	$senaria_u_roofs_cost="";
	$senaria_u_floors_cost="";
	$senaria_u_wins_cost="";
	
		
		//Να εκτελείται μόνο όταν:
		//Το κτίριο είναι το υπάρχον ή είναι ενεργό σενάριο δηλαδή:
		//$zzz==1 (υπάρχον κτίριο) Ή ($zzz>=2 (είναι σενάριο) και $senaria_active[0], [1], [2]==1 (ενεργό σενάριο) )
		if($zzz==1 OR ($zzz>=2 AND $senaria_active[$zzz-2]==1)){
	//ΑΡΧΗ ΚΤΙΡΙΟΥ
	//Κτίριο
	$building = $domtree->createElement("BUILDING");
    $building = $xmlRoot->appendChild($building);
	$building->setAttribute('rid', $rid);
	
		$building->appendChild($domtree->createElement('blg_parameter1',$building_e));//Συνολική επιφάνεια
		$building->appendChild($domtree->createElement('blg_parameter2',$building_e_heat));//Ωφέλιμη επιφάνεια
		$building->appendChild($domtree->createElement('blg_parameter3',$building_e_cold));//Ψυχόμενη επιφάνεια
		$building->appendChild($domtree->createElement('blg_parameter4',$building_v));//Συνολικός όγκος
		$building->appendChild($domtree->createElement('blg_parameter5',$building_v_heat));//Ωφέλιμος όγκος
		$building->appendChild($domtree->createElement('blg_parameter6',$building_v_cold));//Ψυχόμενος όγκος
		$building->appendChild($domtree->createElement('blg_parameter7',$building_levels));//Αριθμός ορόφων
		$building->appendChild($domtree->createElement('blg_parameter8',$building_typicalh));//Ύψος τυπικού ορόφου
		$building->appendChild($domtree->createElement('blg_parameter9',$building_floorh));//Ύψος ισογείου
		$building->appendChild($domtree->createElement('blg_parameter10',$building_ekthesi));//Έκθεση κτιρίου
		$building->appendChild($domtree->createElement('blg_parameter11',$building_zones));//Αριθμός θερμικών ζωνών
		$building->appendChild($domtree->createElement('blg_parameter12',$building_mthxs));//Αριθμός ΜΘΧ
		$building->appendChild($domtree->createElement('blg_parameter13',$building_solars));//Αριθμός ηλιακών χώρων
		$building->appendChild($domtree->createElement('blg_parameter14',$building_xrisi));//Χρήση κτιρίου (Όνομα)
		$building->appendChild($domtree->createElement('blg_parameter15',$building_synthikes));//Συνθήκες θερμικής άνεσης
		$building->appendChild($domtree->createElement('blg_parameter16',$building_thermokat));//Από παλιό ΚΕΝΑΚ (+0.1), δεν παίζει ρόλο
		$building->appendChild($domtree->createElement('blg_parameter17',$count_katanalwseis));//Αριθμός γραμμών πίνακα καταναλώσεων
		$building->appendChild($domtree->createElement('blg_parameter18',$blg_katanalwseis));//Καταναλώσεις
		$building->appendChild($domtree->createElement('blg_parameter19',$count_water));//Αριθμός γραμμών πίνακα ύδρευσης
		$building->appendChild($domtree->createElement('blg_parameter20',$blg_water));//Ύδρευση, αποχέτευση
		$building->appendChild($domtree->createElement('blg_parameter21',$count_lifts));//Αριθμός γραμμών πίνακα ανελκυστήρων
		$building->appendChild($domtree->createElement('blg_parameter22',$blg_lifts));//Ανελκυστήρες
		$building->appendChild($domtree->createElement('blg_parameter23',$exist_wind));//Υπάρχουν ανεμογεννήτριες
		$building->appendChild($domtree->createElement('blg_parameter24',$count_wind));//Αριθμός γραμμών πίνακα ανεμογεννητριών
		$building->appendChild($domtree->createElement('blg_parameter25',$blg_wind));//Ανεμογεννήτριες
		$building->appendChild($domtree->createElement('blg_parameter26',$exist_sith));//Υπάρχει ΣΗΘ
		$building->appendChild($domtree->createElement('blg_parameter27',$count_sith));//Αριθμός γραμμών πίνακα ΣΗΘ
		$building->appendChild($domtree->createElement('blg_parameter28',$blg_sith));//ΣΗΘ
		$building->appendChild($domtree->createElement('blg_parameter29',$exist_pv));//Υπάρχει φωτοβολταικό
		$building->appendChild($domtree->createElement('blg_parameter30',$count_pv));//Αριθμός γραμμών πίνακα Φ/Β
		$building->appendChild($domtree->createElement('blg_parameter31',$blg_pv));//Φωτοβολταικά
		$building->appendChild($domtree->createElement('blg_parameter32',0));//ΚΕΝΟ
		$building->appendChild($domtree->createElement('blg_parameter33',$building_xrisi));//Χρήση κτιρίου (Όνομα)
		$building->appendChild($domtree->createElement('blg_parameter34',$bld_name[$zzz]));//Υπάρχον κτίριο ή σενάριο (μέχρι 80 χαρακτήρες)
	
	
	$data_zones = $database->select("meletes_zones","*",$where);
	$data_allmthxs = $database->select("meletes_mthx","*",$where);
	$data_mthxs = $database->select("meletes_mthx","*",$where_mthxs);
	$data_solars = $database->select("meletes_mthx","*",$where_solars);
	
	
	//Array με key το id του ΜΘΧ και τιμή αρίθμηση από το 0
	//Πρώτα οι ΜΘΧ και μετά οι ηλιακοί χώροι
	$z=0;
	//Array [ΜΘΧ id] => Συνολική Αρίθμηση στο κτίριο, ώστε σε κάθε διαχωριστική εάν έχω το ΜΘΧ id να ξέρω με ποιό χώρο έρχεται σε επαφή
	$array_mthx_ids=array();
	foreach($data_allmthxs as $mthxs){
		if($mthxs["type"]==0){
			$array_mthx_ids[$mthxs["id"]]=$z;
			$z++;
		}
		if($mthxs["type"]==1){
			$array_mthx_ids[$mthxs["id"]]=$z;
			$z++;
		}
	}
	
	
	//ΓΙΑ ΚΑΘΕ ΖΩΝΗ
	$num=1;
	foreach($data_zones as $zones){
		$id = $zones["id"];
		$where_zoneid=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'], "zone_id"=>$id));
		$data_xwroi = $database->select("meletes_xwroi","*",$where_zoneid);
		
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
	
	//Όνομα χρήσης
	$zone_data = $database->select("vivliothiki_conditions_zone","*",array("id"=>$zones["xrisi"]));
	$zone_name = $zone_data[0]["name"];
	
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
		$data_hotels = $database->select("vivliothiki_conditions_znx_hotels","*",$where_hotel);
		$zone_data[0]["znx_lt_perperson"]=$data_hotels[0]["znx_lt_perperson"];
		$zone_data[0]["znx_lt_perm2"]=$data_hotels[0]["znx_lt_perm2"];
		$zone_data[0]["znx_m3_perroom"]=$data_hotels[0]["znx_m3_perroom"];
		$zone_data[0]["znx_m3_perm2"]=$data_hotels[0]["znx_m3_perm2"];
		
		$znx_year=$zones["klines"]*$zone_data[0]["znx_m3_perroom"];
	}
	
	//Εάν ο τύπος ΖΝΧ είναι υπολογισμός με βάση τον τύπο κλινικής - νοσοκομείου
	if($zone_data[0]["znx_calc_type"]==3){//ΜΕ ΒΑΣΗ ΚΛΙΝΕΣ ΚΑΙ ΤΥΠΟ ΚΛΙΝΙΚΗΣ
		$where_hospital=array("id"=>$zones["hospital"]);
		$data_hospitals = $database->select("vivliothiki_conditions_znx_hospitals","*",$where_hospital);
		$zone_data[0]["znx_lt_perperson"]=$data_hospitals[0]["znx_lt_perperson"];
		$zone_data[0]["znx_lt_perm2"]=$data_hospitals[0]["znx_lt_perm2"];
		$zone_data[0]["znx_m3_perroom"]=$data_hospitals[0]["znx_m3_perroom"];
		$zone_data[0]["znx_m3_perm2"]=$data_hospitals[0]["znx_m3_perm2"];
		
		$znx_year=$zones["klines"]*$zone_data[0]["znx_m3_perroom"];
	}
	
	
	//Διατάξεις αυτόματου ελέγχου ΖΝΧ
	if($zones["auto_znx"]==1){
		$auto_znx="True";
	}else{
		$auto_znx="False";
	}
	
	//Αερισμός από κουφώματα
	$aerismos=0;
	$data_diafani = $database->select("meletes_zone_diafani","*",$where_zoneid);
	foreach($data_diafani as $diafanes){
		$diafanes_wind = $diafanes["w"]*$diafanes["h"]*$diafanes["wind"];
		$aerismos+=$diafanes_wind;
	}
	
	
	//Θερμικές ζώνες
	$zone = $domtree->createElement("ZONE".$num);
    $zone = $building->appendChild($zone);
	$zone->setAttribute('rid', $rid);
	
	//Γενικά στοιχεία ζώνης
		$zone->appendChild($domtree->createElement('zn_parameter1',$zone_name));//Όνομα ζώνης αλφαριθμητικό
		$zone->appendChild($domtree->createElement('zn_parameter2',''));//Κενό
		$zone->appendChild($domtree->createElement('zn_parameter3',$zone_e));//Εμβαδόν ζώνης
		$zone->appendChild($domtree->createElement('zn_parameter4',$zones["thermo"]));//Ανηγμένη θέρμο
		$zone->appendChild($domtree->createElement('zn_parameter5',$zones["auto_heat"]));//Αυτοματισμοί θέρμανση
		$zone->appendChild($domtree->createElement('zn_parameter6',$aerismos));//Διεύσδηση από κουφώματα
		$zone->appendChild($domtree->createElement('zn_parameter7',$zones["kaminades"]));//Καμινάδες
		$zone->appendChild($domtree->createElement('zn_parameter8',$zones["thyrides"]));//Θυρίδες
		$zone->appendChild($domtree->createElement('zn_parameter9',$zones["anemistires"]));//Ανεμιστήρες
		$zone->appendChild($domtree->createElement('zn_parameter10',''));//Κόστος ανεμιστήρων (σενάρια)
		$zone->appendChild($domtree->createElement('zn_parameter11',$zones["xrisi"]));//Χρήση id
		$zone->appendChild($domtree->createElement('zn_parameter12',$znx_year));//Μέση κατανάλωση ΖΝΧ
		$zone->appendChild($domtree->createElement('zn_parameter13',$auto_znx));//Αυτοματισμοί ΖΝΧ
		$zone->appendChild($domtree->createElement('zn_parameter14',$zones["auto_cold"]));//Αυτοματισμοί ψύξη
		$zone->appendChild($domtree->createElement('zn_parameter15',$zones["ekswthyres"]));//Εξώθυρες
		
	
	//ΚΕΛΥΦΟΣ
	for($i=1;$i<=16;$i++){
		${"opaque_column".$i}="";
	}
	for($i=1;$i<=8;$i++){
		${"ground_column".$i}="";
	}
	for($i=1;$i<=16;$i++){
		${"transparent_column".$i}="";
	}
	for($i=1;$i<=16;$i++){
		${"direct_benefit_column".$i}="";
	}
	
	
	//################################ SCRIPT ΚΕΛΥΦΟΥΣ ΟΠΩΣ ΣΤΟ FUNCTIONS_MELETI_GENERAL preview_tables_kelyfos ###############
		$where_zone=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$id));
		$zone_wall = $database->select("meletes_zone_adiafani","*",$where_zone);
		$zone_window = $database->select("meletes_zone_diafani","*",$where_zone);
		$zone_dapeda = $database->select("meletes_zone_dapeda","*",$where_zone);
		$zone_orofes = $database->select("meletes_zone_orofes","*",$where_zone);
	
		$passive_data = $database->select("meletes_zone_diafani","passive",array("zone_id"=>$id) );//όλα τα ανοίγματα ζώνης passive=1
		$passive_count = $database->count("meletes_zone_diafani",array("AND"=>array("zone_id"=>$id, "passive"=>1)) );//όλα τα ανοίγματα ζώνης passive

		if($passive_count>=1){
			$direct_benefit_exist=1;
		}else{
			$direct_benefit_exist=0;
		}
	
	//στοιχεία επαφών με κάθε ΜΘΧ
	$e=0;
	//Αριθμός διαχωριστικών στη ζώνη
	$internals_zone=0;
	//Array [ΜΘΧ id] => Αρίθμηση, ώστε σε κάθε τοίχο εάν έχω το ΜΘΧ id να ξέρω σε ποιά α/α διαχωριστική να μπει
	${"array_internals".$id} = array();
	//Array [ΜΘΧ id] => Αρίθμηση, ώστε σε κάθε διαχωριστική έχω την αρίθμηση ζώνης να ξέρω με ποιό χώρο έρχεται σε επαφή
	${"array_internals_inv".$id} = array();
	foreach($data_allmthxs as $mthxs){
		$wallstomthx_count = $database->count("meletes_zone_adiafani",array("AND"=>array("zone_id"=>$id, "type"=>1, "mthx_id"=>$mthxs["id"])) );
		$floorstomthx_count = $database->count("meletes_zone_dapeda",array("AND"=>array("zone_id"=>$id, "type"=>1, "mthx_id"=>$mthxs["id"])) );
		$roofstomthx_count = $database->count("meletes_zone_orofes",array("AND"=>array("zone_id"=>$id, "type"=>1, "mthx_id"=>$mthxs["id"])) );
		$epafesmthx=$wallstomthx_count+$floorstomthx_count+$roofstomthx_count;
		
		if($epafesmthx>0){
			$e++;
			$internals_zone++;
			${"array_internals".$id}[$mthxs["id"]]=$e;
			${"array_internals_inv".$id}[$e] = $mthxs["id"];
			//ΚΕΛΥΦΟΣ
			for($i=1;$i<=16;$i++){
				${"internal".$e."_opaque_column".$i}="";
			}
			for($i=1;$i<=16;$i++){
				${"internal".$e."_transparent_column".$i}="";
			}
			${"internal".$e."_count_opaque"}=0;
			${"internal".$e."_count_transparent"}=0;
			
			
		}
	}
		
	$count_opaque=0;
	$count_ground=0;
	$count_transparent=0;
	$count_direct=0;
	foreach($zone_wall as $wall){
		
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
		}
		if($wall_g>=360){
				$wall_g=$wall_g-360;
			}
		
		$wall_e_sum = $wall_l*$wall_h + ($wall_l*$wall_dy)/2;
		
		//ΣΥΝΤΕΛΕΣΤΕΣ ΘΕΡΜΟΠΕΡΑΤΟΤΗΤΑΣ
		// u τοίχων
			if($wall["u_id"]!=0){
				$data_u = $database->select("user_adiafani","u",array("id"=>$wall['u_id']) );
				$u=$data_u[0];
			}else{
				$u=$wall["u"];
			}
		// u υποστυλωμάτων
			if($wall["yp_u_id"]!=0){
				$data_yp_u = $database->select("user_adiafani","u",array("id"=>$wall['yp_u_id']) );
				$yp_u=$data_yp_u[0];
			}else{
				$yp_u=$wall["yp_u"];
			}
		// u δοκών	
			if($wall["dok_u_id"]!=0){
				$data_dok_u = $database->select("user_adiafani","u",array("id"=>$wall['dok_u_id']) );
				$dok_u=$data_dok_u[0];
			}else{
				$dok_u=$wall["dok_u"];
			}
		// u συρομένων	
			if($wall["syr_u_id"]!=0){
				$data_syr_u = $database->select("user_adiafani","u",array("id"=>$wall['syr_u_id']) );
				$syr_u=$data_syr_u[0];
			}else{
				$syr_u=$wall["syr_u"];
			}
		
		//Προσαύξηση μόνο σε αέρα
		if($wall["type"]==0 OR $wall["type"]==3){//εάν ο τοίχος ανήκει στα αδιαφανή της ζώνης	
			//Προσθήκη 0.2 σε περίπτωση που έχει επιλεγεί το tik
			$u=$u+$u_plus;
			$yp_u=$yp_u+$u_plus;
			$dok_u=$dok_u+$u_plus;
			$syr_u=$syr_u+$u_plus;
		}
		//Προσαύξηση μόνο σε αέρα
		
		//ΣΥΝΤΕΛΕΣΤΕΣ ΘΕΡΜΟΠΕΡΑΤΟΤΗΤΑΣ ΣΕΝΑΡΙΑ
		if($zzz>=2 AND $senaria_active[$zzz-2]==1){//είναι σενάριο και είναι ενεργό
			if($senaria_u_walls[$zzz-2]!="" AND $senaria_u_walls[$zzz-2]!=$u){
				$u=$senaria_u_walls[$zzz-2];
				$senaria_u_walls_cost=$walls_cost;
			}
			if($senaria_u_walls[$zzz-2]!="" AND $senaria_u_walls[$zzz-2]!=$yp_u){
				$yp_u=$senaria_u_walls[$zzz-2];
				$senaria_u_walls_cost=$walls_cost;
			}
			if($senaria_u_walls[$zzz-2]!="" AND $senaria_u_walls[$zzz-2]!=$dok_u){
				$dok_u=$senaria_u_walls[$zzz-2];
				$senaria_u_walls_cost=$walls_cost;
			}
			if($senaria_u_walls[$zzz-2]!="" AND $senaria_u_walls[$zzz-2]!=$syr_u){
				$syr_u=$senaria_u_walls[$zzz-2];
				$senaria_u_walls_cost=$walls_cost;
			}
		}//είναι σενάριο και είναι ενεργό
		
		
		//α/ε
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
		$data_window = $database->select("meletes_zone_diafani","*",array("wall_id"=>$wall['id']) );
		foreach($data_window as $window){
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
			
			//ΣΥΝΤΕΛΕΣΤΕΣ ΘΕΡΜΟΠΕΡΑΤΟΤΗΤΑΣ ΣΕΝΑΡΙΑ
			if($zzz>=2 AND $senaria_active[$zzz-2]==1){//είναι σενάριο και είναι ενεργό
				if($senaria_u_wins[$zzz-2]!="" AND $senaria_u_wins[$zzz-2]!=$window_u){
					$window_u=$senaria_u_wins[$zzz-2];
					$senaria_u_wins_cost=$wins_cost;
				}
			}//είναι σενάριο και είναι ενεργό
			
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
		
		if($window_ftype==1){
			$fhor_h_w=0;
			$fhor_c_w=0;
			$fov_h_w=0;
			$fov_c_w=0;
			$ffin_h_w=0;
			$ffin_c_w=0;
		}
		
		if($window_ftype==2){
			$fhor_h_w=1;
			$fhor_c_w=1;
			$fov_h_w=1;
			$fov_c_w=1;
			$ffin_h_w=1;
			$ffin_c_w=1;
		}
		
		if($wall["type"]!=1){//στο κέλυφος της ζώνης
			if($window["u_id"]=="u_bytype" AND $window["type"]==0){//αδιαφανής πόρτα
				$opaque_column1 .= "Πόρτα,";
				$opaque_column2 .= $window_name.",";
				$opaque_column3 .= $wall_g.",";
				$opaque_column4 .= $wall["b"].",";
				$opaque_column5 .= $window_e.",";
				$opaque_column6 .= $window_u.",";
				$opaque_column7 .= ",";
				$opaque_column8 .= $ap.",";
				$opaque_column9 .= $ek.",";
				$opaque_column10 .= $fhor_h_w.",";
				$opaque_column11 .= $fhor_c_w.",";
				$opaque_column12 .= $fov_h_w.",";
				$opaque_column13 .= $fov_c_w.",";
				$opaque_column14 .= $ffin_h_w.",";
				$opaque_column15 .= $ffin_c_w.",";
				$opaque_column16 .= $senaria_u_wins_cost.",";
				$count_opaque++;
			}else{//ΔΕΝ είναι αδιαφανής πόρτα
				if($window["passive"]==1){//Καρτέλα - Παθητικά ηλιακά
					$direct_benefit_column1 .= "Ανοιγόμενο κούφωμα,";
					$direct_benefit_column2 .= $window_name.",";
					$direct_benefit_column3 .= $wall_g.",";
					$direct_benefit_column4 .= $wall["b"].",";
					$direct_benefit_column5 .= $window_e.",";
					$direct_benefit_column6 .= $array_window_type[$window["type"]].",";
					$direct_benefit_column7 .= $window_u.",";
					$direct_benefit_column8 .= $window_gw.",";
					$direct_benefit_column9 .= $fhor_h_w.",";
					$direct_benefit_column10 .= $fhor_c_w.",";
					$direct_benefit_column11 .= $fov_h_w.",";
					$direct_benefit_column12 .= $fov_c_w.",";
					$direct_benefit_column13 .= $ffin_h_w.",";
					$direct_benefit_column14 .= $ffin_c_w.",";
					$direct_benefit_column15 .= ",";
					$direct_benefit_column16 .= $senaria_u_wins_cost.",";
					$count_direct++;
				}else{//Καρτέλα - Διαφανή
					$transparent_column1 .= "Ανοιγόμενο κούφωμα,";
					$transparent_column2 .= $window_name.",";
					$transparent_column3 .= $wall_g.",";
					$transparent_column4 .= $wall["b"].",";
					$transparent_column5 .= $window_e.",";
					$transparent_column6 .= $array_window_type[$window["type"]].",";
					$transparent_column7 .= $window_u.",";
					$transparent_column8 .= $window_gw.",";
					$transparent_column9 .= $fhor_h_w.",";
					$transparent_column10 .= $fhor_c_w.",";
					$transparent_column11 .= $fov_h_w.",";
					$transparent_column12 .= $fov_c_w.",";
					$transparent_column13 .= $ffin_h_w.",";
					$transparent_column14 .= $ffin_c_w.",";
					$transparent_column15 .= $senaria_u_wins_cost.",";
					$count_transparent++;
				}
			}//Είναι διαφανές
		}//Ο τοίχος δεν είναι διαχωριστική
		
		if($wall["type"]==1){//Στο κέλυφος διαχωριστικής
			$diax_e= ${"array_internals".$id}[$wall["mthx_id"]];
				if($window["u_id"]=="u_bytype" AND $window["type"]==0){//αδιαφανής πόρτα
				${"internal".$diax_e."_opaque_column1"} .= "Πόρτα,";
				${"internal".$diax_e."_opaque_column2"} .= $window_name.",";
				${"internal".$diax_e."_opaque_column3"} .= $wall_g.",";
				${"internal".$diax_e."_opaque_column4"} .= $wall["b"].",";
				${"internal".$diax_e."_opaque_column5"} .= $window_e.",";
				${"internal".$diax_e."_opaque_column6"} .= $window_u.",";
				${"internal".$diax_e."_opaque_column7"} .= ",";
				${"internal".$diax_e."_opaque_column8"} .= $ap.",";
				${"internal".$diax_e."_opaque_column9"} .= $ek.",";
				${"internal".$diax_e."_opaque_column10"} .= $fhor_h_w.",";
				${"internal".$diax_e."_opaque_column11"} .= $fhor_c_w.",";
				${"internal".$diax_e."_opaque_column12"} .= $fov_h_w.",";
				${"internal".$diax_e."_opaque_column13"} .= $fov_c_w.",";
				${"internal".$diax_e."_opaque_column14"} .= $ffin_h_w.",";
				${"internal".$diax_e."_opaque_column15"} .= $ffin_c_w.",";
				${"internal".$diax_e."_opaque_column16"} .= $senaria_u_wins_cost.",";
			${"internal".$diax_e."_count_opaque"}++;
			}else{//ΔΕΝ είναι αδιαφανής πόρτα
				//Καρτέλα - Διαφανή
				${"internal".$diax_e."_transparent_column1"} .= "Κούφωμα,";
				${"internal".$diax_e."_transparent_column2"} .= $window_name.",";
				${"internal".$diax_e."_transparent_column3"} .= $wall_g.",";
				${"internal".$diax_e."_transparent_column4"} .= $wall["b"].",";
				${"internal".$diax_e."_transparent_column5"} .= $window_e.",";
				${"internal".$diax_e."_transparent_column6"} .= $array_window_type[$window["type"]].",";
				${"internal".$diax_e."_transparent_column7"} .= $window_u.",";
				${"internal".$diax_e."_transparent_column8"} .= $window_gw.",";
				${"internal".$diax_e."_transparent_column9"} .= $fhor_h_w.",";
				${"internal".$diax_e."_transparent_column10"} .= $fhor_c_w.",";
				${"internal".$diax_e."_transparent_column11"} .= $fov_h_w.",";
				${"internal".$diax_e."_transparent_column12"} .= $fov_c_w.",";
				${"internal".$diax_e."_transparent_column13"} .= $ffin_h_w.",";
				${"internal".$diax_e."_transparent_column14"} .= $ffin_c_w.",";
				${"internal".$diax_e."_transparent_column15"} .= $senaria_u_wins_cost.",";
			${"internal".$diax_e."_count_transparent"}++;
			}//Είναι διαφανές
		}//Στο κέλυφος διαχωριστικής
		
		}//Για κάθε άνοιγμα
		
		//Καθαρό εμβαδόν τοίχου
		$wall_e_adiafanes = $wall_e_sum - $window_sume;//Ο τοίχος χωρίς παράθυρα
		$wall_e = $wall_e_sum - $syr_e - $yp_e - $dok_e - $window_sume;//Ο τοίχος χωρίς φέρων/παράθυρα
		$u_sum = ($wall_e*$u + $syr_e*$syr_u + $yp_e*$yp_u + $dok_e*$dok_u)/$wall_e_adiafanes;//Μέσος συντελεστής
	
		if($wall["type"]==0 OR $wall["type"]==3){//εάν ο τοίχος ανήκει στα αδιαφανή της ζώνης	
			if($wall["type"]==0){$toixos_per="Τοίχος";}
			if($wall["type"]==3){$toixos_per="Μεσοτοιχία";}
			if($symptiksi==1){//1 γραμμή για τον τοίχο
			//Εκτύπωση γραμμής τοίχου
				$opaque_column1 .= $toixos_per.",";
				$opaque_column2 .= $wall["name"].",";
				$opaque_column3 .= $wall_g.",";
				$opaque_column4 .= $wall["b"].",";
				$opaque_column5 .= $wall_e_adiafanes.",";
				$opaque_column6 .= $u_sum.",";
				$opaque_column7 .= ",";
				$opaque_column8 .= $ap.",";
				$opaque_column9 .= $ek.",";
				$opaque_column10 .= $fhor_h.",";
				$opaque_column11 .= $fhor_c.",";
				$opaque_column12 .= $fov_h.",";
				$opaque_column13 .= $fov_c.",";
				$opaque_column14 .= $ffin_h.",";
				$opaque_column15 .= $ffin_c.",";
				$opaque_column16 .= $senaria_u_walls_cost.",";
			$count_opaque++;
			}else{//Δεν υπάρχει σύμπτυξη. 4 γραμμες (δρομικο, υπ, δοκ, συρ) ή 3 με % φέρων + συρόμενα
			//Εκτύπωση γραμμής τοίχου
				$opaque_column1 .= $toixos_per.",";
				$opaque_column2 .= $wall["name"].",";
				$opaque_column3 .= $wall_g.",";
				$opaque_column4 .= $wall["b"].",";
				$opaque_column5 .= $wall_e.",";
				$opaque_column6 .= $u.",";
				$opaque_column7 .= ",";
				$opaque_column8 .= $ap.",";
				$opaque_column9 .= $ek.",";
				$opaque_column10 .= $fhor_h.",";
				$opaque_column11 .= $fhor_c.",";
				$opaque_column12 .= $fov_h.",";
				$opaque_column13 .= $fov_c.",";
				$opaque_column14 .= $ffin_h.",";
				$opaque_column15 .= $ffin_c.",";
				$opaque_column16 .= $senaria_u_walls_cost.",";
				
				$count_opaque++;
				
				if($yp_e!=0){
					if($per!=0){
						$txt_ypost="[Φέρων-".$per."%]-";
					}else{
						$txt_ypost="Υποστηλώματα-";
					}
					//Εκτύπωση γραμμής υποστηλωμάτων ή φέρων
					$opaque_column1 .= $toixos_per.",";
					$opaque_column2 .= $txt_ypost.$wall["name"].",";
					$opaque_column3 .= $wall_g.",";
					$opaque_column4 .= $wall["b"].",";
					$opaque_column5 .= $yp_e.",";
					$opaque_column6 .= $yp_u.",";
					$opaque_column7 .= ",";
					$opaque_column8 .= $ap.",";
					$opaque_column9 .= $ek.",";
					$opaque_column10 .= $fhor_h.",";
					$opaque_column11 .= $fhor_c.",";
					$opaque_column12 .= $fov_h.",";
					$opaque_column13 .= $fov_c.",";
					$opaque_column14 .= $ffin_h.",";
					$opaque_column15 .= $ffin_c.",";
					$opaque_column16 .= $senaria_u_walls_cost.",";
				$count_opaque++;
				}
				
				if($dok_e!=0){
					if($per==0){//μόνο εάν δεν υπάρχει % φέρων
						//Εκτύπωση γραμμής δοκών
						$opaque_column1 .= $toixos_per.",";
						$opaque_column2 .= "Δοκοί-".$wall["name"].",";
						$opaque_column3 .= $wall_g.",";
						$opaque_column4 .= $wall["b"].",";
						$opaque_column5 .= $dok_e.",";
						$opaque_column6 .= $dok_u.",";
						$opaque_column7 .= ",";
						$opaque_column8 .= $ap.",";
						$opaque_column9 .= $ek.",";
						$opaque_column10 .= $fhor_h.",";
						$opaque_column11 .= $fhor_c.",";
						$opaque_column12 .= $fov_h.",";
						$opaque_column13 .= $fov_c.",";
						$opaque_column14 .= $ffin_h.",";
						$opaque_column15 .= $ffin_c.",";
						$opaque_column16 .= $senaria_u_walls_cost.",";
					$count_opaque++;
					}
				}
				
				if($syr_e!=0){
				//Εκτύπωση γραμμής συρομένων
				$opaque_column1 .= $toixos_per.",";
				$opaque_column2 .= "Με διάκενο-".$wall["name"].",";
				$opaque_column3 .= $wall_g.",";
				$opaque_column4 .= $wall["b"].",";
				$opaque_column5 .= $syr_e.",";
				$opaque_column6 .= $syr_u.",";
				$opaque_column7 .= ",";
				$opaque_column8 .= $ap.",";
				$opaque_column9 .= $ek.",";
				$opaque_column10 .= $fhor_h.",";
				$opaque_column11 .= $fhor_c.",";
				$opaque_column12 .= $fov_h.",";
				$opaque_column13 .= $fov_c.",";
				$opaque_column14 .= $ffin_h.",";
				$opaque_column15 .= $ffin_c.",";
				$opaque_column16 .= $senaria_u_walls_cost.",";
				
				$count_opaque++;
				}
				
			}//4 γραμμές τοίχου
		}//εάν ο τοίχος ανήκει στα αδιαφανή της ζώνης
		
		if($wall["type"]==1){//εάν ο τοίχος ανήκει σε διαχωριστική
		
		$diax_e= ${"array_internals".$id}[$wall["mthx_id"]];
		
		$toixos_per="Τοίχος";
			if($symptiksi==1){//1 γραμμή για τον τοίχο
			//Εκτύπωση γραμμής τοίχου
				${"internal".$diax_e."_opaque_column1"} .= $toixos_per.",";
				${"internal".$diax_e."_opaque_column2"} .= $wall["name"].",";
				${"internal".$diax_e."_opaque_column3"} .= $wall_g.",";
				${"internal".$diax_e."_opaque_column4"} .= $wall["b"].",";
				${"internal".$diax_e."_opaque_column5"} .= $wall_e_adiafanes.",";
				${"internal".$diax_e."_opaque_column6"} .= $u_sum.",";
				${"internal".$diax_e."_opaque_column7"} .= ",";
				${"internal".$diax_e."_opaque_column8"} .= $ap.",";
				${"internal".$diax_e."_opaque_column9"} .= $ek.",";
				${"internal".$diax_e."_opaque_column10"} .= $fhor_h.",";
				${"internal".$diax_e."_opaque_column11"} .= $fhor_c.",";
				${"internal".$diax_e."_opaque_column12"} .= $fov_h.",";
				${"internal".$diax_e."_opaque_column13"} .= $fov_c.",";
				${"internal".$diax_e."_opaque_column14"} .= $ffin_h.",";
				${"internal".$diax_e."_opaque_column15"} .= $ffin_c.",";
				${"internal".$diax_e."_opaque_column16"} .= $senaria_u_walls_cost.",";
			${"internal".$diax_e."_count_opaque"}++;
			}else{//Δεν υπάρχει σύμπτυξη. 4 γραμμες (δρομικο, υπ, δοκ, συρ) ή 3 με % φέρων + συρόμενα
			//Εκτύπωση γραμμής τοίχου
				${"internal".$diax_e."_opaque_column1"} .= $toixos_per.",";
				${"internal".$diax_e."_opaque_column2"} .= $wall["name"].",";
				${"internal".$diax_e."_opaque_column3"} .= $wall_g.",";
				${"internal".$diax_e."_opaque_column4"} .= $wall["b"].",";
				${"internal".$diax_e."_opaque_column5"} .= $wall_e.",";
				${"internal".$diax_e."_opaque_column6"} .= $u.",";
				${"internal".$diax_e."_opaque_column7"} .= ",";
				${"internal".$diax_e."_opaque_column8"} .= $ap.",";
				${"internal".$diax_e."_opaque_column9"} .= $ek.",";
				${"internal".$diax_e."_opaque_column10"} .= $fhor_h.",";
				${"internal".$diax_e."_opaque_column11"} .= $fhor_c.",";
				${"internal".$diax_e."_opaque_column12"} .= $fov_h.",";
				${"internal".$diax_e."_opaque_column13"} .= $fov_c.",";
				${"internal".$diax_e."_opaque_column14"} .= $ffin_h.",";
				${"internal".$diax_e."_opaque_column15"} .= $ffin_c.",";
				${"internal".$diax_e."_opaque_column16"} .= $senaria_u_walls_cost.",";
				
				${"internal".$diax_e."_count_opaque"}++;
				
				if($yp_e!=0){
					if($per!=0){
						$txt_ypost="[Φέρων-".$per."%]-";
					}else{
						$txt_ypost="Υποστηλώματα-";
					}
					//Εκτύπωση γραμμής υποστηλωμάτων ή φέρων
					${"internal".$diax_e."_opaque_column1"} .= $toixos_per.",";
					${"internal".$diax_e."_opaque_column2"} .= $txt_ypost.$wall["name"].",";
					${"internal".$diax_e."_opaque_column3"} .= $wall_g.",";
					${"internal".$diax_e."_opaque_column4"} .= $wall["b"].",";
					${"internal".$diax_e."_opaque_column5"} .= $yp_e.",";
					${"internal".$diax_e."_opaque_column6"} .= $yp_u.",";
					${"internal".$diax_e."_opaque_column7"} .= ",";
					${"internal".$diax_e."_opaque_column8"} .= $ap.",";
					${"internal".$diax_e."_opaque_column9"} .= $ek.",";
					${"internal".$diax_e."_opaque_column10"} .= $fhor_h.",";
					${"internal".$diax_e."_opaque_column11"} .= $fhor_c.",";
					${"internal".$diax_e."_opaque_column12"} .= $fov_h.",";
					${"internal".$diax_e."_opaque_column13"} .= $fov_c.",";
					${"internal".$diax_e."_opaque_column14"} .= $ffin_h.",";
					${"internal".$diax_e."_opaque_column15"} .= $ffin_c.",";
					${"internal".$diax_e."_opaque_column16"} .= $senaria_u_walls_cost.",";
				${"internal".$diax_e."_count_opaque"}++;
				}
				
				if($dok_e!=0){
					if($per==0){//μόνο εάν δεν υπάρχει % φέρων
						//Εκτύπωση γραμμής δοκών
						${"internal".$diax_e."_opaque_column1"} .= $toixos_per.",";
						${"internal".$diax_e."_opaque_column2"} .= "Δοκοί-".$wall["name"].",";
						${"internal".$diax_e."_opaque_column3"} .= $wall_g.",";
						${"internal".$diax_e."_opaque_column4"} .= $wall["b"].",";
						${"internal".$diax_e."_opaque_column5"} .= $dok_e.",";
						${"internal".$diax_e."_opaque_column6"} .= $dok_u.",";
						${"internal".$diax_e."_opaque_column7"} .= ",";
						${"internal".$diax_e."_opaque_column8"} .= $ap.",";
						${"internal".$diax_e."_opaque_column9"} .= $ek.",";
						${"internal".$diax_e."_opaque_column10"} .= $fhor_h.",";
						${"internal".$diax_e."_opaque_column11"} .= $fhor_c.",";
						${"internal".$diax_e."_opaque_column12"} .= $fov_h.",";
						${"internal".$diax_e."_opaque_column13"} .= $fov_c.",";
						${"internal".$diax_e."_opaque_column14"} .= $ffin_h.",";
						${"internal".$diax_e."_opaque_column15"} .= $ffin_c.",";
						${"internal".$diax_e."_opaque_column16"} .= $senaria_u_walls_cost.",";
					${"internal".$diax_e."_count_opaque"}++;
					}
				}
				
				if($syr_e!=0){
				//Εκτύπωση γραμμής συρομένων
				${"internal".$diax_e."_opaque_column1"} .= $toixos_per.",";
				${"internal".$diax_e."_opaque_column2"} .= "Με διάκενο-".$wall["name"].",";
				${"internal".$diax_e."_opaque_column3"} .= $wall_g.",";
				${"internal".$diax_e."_opaque_column4"} .= $wall["b"].",";
				${"internal".$diax_e."_opaque_column5"} .= $syr_e.",";
				${"internal".$diax_e."_opaque_column6"} .= $syr_u.",";
				${"internal".$diax_e."_opaque_column7"} .= ",";
				${"internal".$diax_e."_opaque_column8"} .= $ap.",";
				${"internal".$diax_e."_opaque_column9"} .= $ek.",";
				${"internal".$diax_e."_opaque_column10"} .= $fhor_h.",";
				${"internal".$diax_e."_opaque_column11"} .= $fhor_c.",";
				${"internal".$diax_e."_opaque_column12"} .= $fov_h.",";
				${"internal".$diax_e."_opaque_column13"} .= $fov_c.",";
				${"internal".$diax_e."_opaque_column14"} .= $ffin_h.",";
				${"internal".$diax_e."_opaque_column15"} .= $ffin_c.",";
				${"internal".$diax_e."_opaque_column16"} .= $senaria_u_walls_cost.",";
				
				${"internal".$diax_e."_count_opaque"}++;
				}
				
			}//4 γραμμές τοίχου
		}//εάν ο τοίχος ανήκει σε διαχωριστική
		
		
		if($wall["type"]==2){ //ο τοίχος ανήκει σε έδαφος
			if($symptiksi==1){//1 γραμμή για τον τοίχο
				//Εκτύπωση γραμμής τοίχου
				$ground_column1 .= "Τοίχος,";
				$ground_column2 .= $wall["name"].",";
				$ground_column3 .= $wall_e_sum.",";
				$ground_column4 .= $u_sum.",";
				$ground_column5 .= $wall["z1"].",";
				$ground_column6 .= $wall["z2"].",";
				$ground_column7 .= ",";
				$ground_column8 .= $senaria_u_walls_cost.",";
			$count_ground++;
			}else{
			//Εκτύπωση γραμμής τοίχου
				$ground_column1 .= "Τοίχος,";
				$ground_column2 .= $wall["name"].",";
				$ground_column3 .= $wall_e.",";
				$ground_column4 .= $u.",";
				$ground_column5 .= $wall["z1"].",";
				$ground_column6 .= $wall["z2"].",";
				$ground_column7 .= ",";
				$ground_column8 .= $senaria_u_walls_cost.",";
			$count_ground++;
				
				if($yp_e!=0){
					if($per!=0){
						$txt_ypost="[Φέρων-".$per."%]-";
					}else{
						$txt_ypost="Υποστηλώματα-";
					}
				//Εκτύπωση γραμμής υποστηλωμάτων
				$ground_column1 .= "Τοίχος,";
				$ground_column2 .= $txt_ypost.$wall["name"].",";
				$ground_column3 .= $yp_e.",";
				$ground_column4 .= $yp_u.",";
				$ground_column5 .= $wall["z1"].",";
				$ground_column6 .= $wall["z2"].",";
				$ground_column7 .= ",";
				$ground_column8 .= $senaria_u_walls_cost.",";
				
				$count_ground++;
				}
				
				if($dok_e!=0){
					if($per==0){//μόνο εάν δεν υπάρχει % φέρων
					//Εκτύπωση γραμμής δοκών
					$ground_column1 .= "Τοίχος,";
					$ground_column2 .= "Δοκοί-".$wall["name"].",";
					$ground_column3 .= $dok_e.",";
					$ground_column4 .= $dok_u.",";
					$ground_column5 .= $wall["z1"].",";
					$ground_column6 .= $wall["z2"].",";
					$ground_column7 .= ",";
					$ground_column8 .= $senaria_u_walls_cost.",";
					
					$count_ground++;
					}
				}
				
				if($syr_e!=0){
				//Εκτύπωση γραμμής συρομένων
				$ground_column1 .= "Τοίχος,";
				$ground_column2 .= "Με διάκενο-".$wall["name"].",";
				$ground_column3 .= $syr_e.",";
				$ground_column4 .= $syr_u.",";
				$ground_column5 .= $wall["z1"].",";
				$ground_column6 .= $wall["z2"].",";
				$ground_column7 .= ",";
				$ground_column8 .= $senaria_u_walls_cost.",";
				
				$count_ground++;
				}
				
			}//4 γραμμές τοίχου
		}//ο τοίχος σε έδαφος
		
	}//για κάθε τοίχο
	
	
	
	//ΟΡΟΦΕΣ - 0 σε αέρα, 1 σε ΜΘΧ, 2 σε έδαφος
	foreach($zone_orofes as $orofi){
		if($orofi["u"]!=0){
			$orofi_u=$orofi["u"];
		}else{
			$orofi_u_data = $database->select("user_adiafani","u",array("id"=>$orofi["u_id"]) );
			$orofi_u=$orofi_u_data[0];
		}
		
		//Προσαύξηση μόνο σε αέρα
		if($orofi["type"]==0){ //Οροφή σε αέρα
			$orofi_u=$orofi_u+$u_plus;
		}
		
		//α-ε
		$orofi_ap = $database->select("vivliothiki_adiafani_a","a",array("id"=>$orofi['ap']) );
		$orofi_ap=$orofi_ap[0];
		$orofi_ek = $database->select("vivliothiki_adiafani_e","e",array("id"=>$orofi['ek']) );
		$orofi_ek=$orofi_ek[0];
		
			//ΣΥΝΤΕΛΕΣΤΕΣ ΘΕΡΜΟΠΕΡΑΤΟΤΗΤΑΣ ΣΕΝΑΡΙΑ
			if($zzz>=2 AND $senaria_active[$zzz-2]==1){//είναι σενάριο και είναι ενεργό
				if($senaria_u_roofs[$zzz-2]!="" AND $senaria_u_roofs[$zzz-2]!=$orofi_u){
					$orofi_u=$senaria_u_roofs[$zzz-2];
					$senaria_u_roofs_cost=$roofs_cost;
				}
			}//είναι σενάριο και είναι ενεργό
		
		$window_sume=0;
		//Παράθυρα
		$data_window = $database->select("meletes_zone_diafani","*",array("roof_id"=>$orofi['id']) );
		foreach($data_window as $window){
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
			
			//ΣΥΝΤΕΛΕΣΤΕΣ ΘΕΡΜΟΠΕΡΑΤΟΤΗΤΑΣ ΣΕΝΑΡΙΑ
			if($zzz>=2 AND $senaria_active[$zzz-2]==1){//είναι σενάριο και είναι ενεργό
				if($senaria_u_wins[$zzz-2]!="" AND $senaria_u_wins[$zzz-2]!=$window_u){
					$window_u=$senaria_u_wins[$zzz-2];
					$senaria_u_wins_cost=$wins_cost;
				}
			}//είναι σενάριο και είναι ενεργό
			
			if($orofi["type"]==0){ //Οροφή σε αέρα
			
			if($window["u_id"]=="u_bytype" AND $window["type"]==0){//αδιαφανής πόρτα
				$opaque_column1 .= "Πόρτα,";
				$opaque_column2 .= $window_name.",";
				$opaque_column3 .= $orofi["g"].",";
				$opaque_column4 .= $orofi["b"].",";
				$opaque_column5 .= $window_e.",";
				$opaque_column6 .= $window_u.",";
				$opaque_column7 .= ",";
				$opaque_column8 .= $orofi_ap.",";
				$opaque_column9 .= $orofi_ek.",";
				$opaque_column10 .= $orofi["fhor_h"].",";
				$opaque_column11 .= $orofi["fhor_c"].",";
				$opaque_column12 .= $orofi["fov_h"].",";
				$opaque_column13 .= $orofi["fov_c"].",";
				$opaque_column14 .= $orofi["ffin_h"].",";
				$opaque_column15 .= $orofi["ffin_c"].",";
				$opaque_column16 .= $senaria_u_wins_cost.",";
				$count_opaque++;
			}else{//ΔΕΝ είναι αδιαφανής πόρτα
				if($window["passive"]==1){//Καρτέλα - Παθητικά ηλιακά
					$direct_benefit_column1 .= "Ανοιγόμενο κούφωμα,";
					$direct_benefit_column2 .= $window_name.",";
					$direct_benefit_column3 .= $orofi["g"].",";
					$direct_benefit_column4 .= $orofi["b"].",";
					$direct_benefit_column5 .= $window_e.",";
					$direct_benefit_column6 .= ",";
					$direct_benefit_column7 .= $window_u.",";
					$direct_benefit_column8 .= $window_gw.",";
					$direct_benefit_column9 .= $orofi["fhor_h"].",";
					$direct_benefit_column10 .= $orofi["fhor_c"].",";
					$direct_benefit_column11 .= $orofi["fov_h"].",";
					$direct_benefit_column12 .= $orofi["fov_c"].",";
					$direct_benefit_column13 .= $orofi["ffin_h"].",";
					$direct_benefit_column14 .= $orofi["ffin_c"].",";
					$direct_benefit_column15 .= ",";
					$direct_benefit_column16 .= $senaria_u_wins_cost.",";
					$count_direct++;
				}else{//Καρτέλα - Διαφανή
					$transparent_column1 .= "Ανοιγόμενο κούφωμα,";
					$transparent_column2 .= $window_name.",";
					$transparent_column3 .= $orofi["g"].",";
					$transparent_column4 .= $orofi["b"].",";
					$transparent_column5 .= $window_e.",";
					$transparent_column6 .= $array_window_type[$window["type"]].",";
					$transparent_column7 .= $window_u.",";
					$transparent_column8 .= $window_gw.",";
					$transparent_column9 .= $orofi["fhor_h"].",";
					$transparent_column10 .= $orofi["fhor_c"].",";
					$transparent_column11 .= $orofi["fov_h"].",";
					$transparent_column12 .= $orofi["fov_c"].",";
					$transparent_column13 .= $orofi["ffin_h"].",";
					$transparent_column14 .= $orofi["ffin_c"].",";
					$transparent_column15 .= $senaria_u_wins_cost.",";
					$count_transparent++;
				}
			}//Είναι διαφανές
			}//Οροφή σε αέρα
			
			if($orofi["type"]==1){//Στο κέλυφος διαχωριστικής
			$diax_e= ${"array_internals".$id}[$orofi["mthx_id"]];
				if($window["u_id"]=="u_bytype" AND $window["type"]==0){//αδιαφανής πόρτα
				${"internal".$diax_e."_opaque_column1"} .= "Πόρτα,";
				${"internal".$diax_e."_opaque_column2"} .= $window_name.",";
				${"internal".$diax_e."_opaque_column3"} .= $orofi["g"].",";
				${"internal".$diax_e."_opaque_column4"} .= $orofi["b"].",";
				${"internal".$diax_e."_opaque_column5"} .= $window_e.",";
				${"internal".$diax_e."_opaque_column6"} .= $window_u.",";
				${"internal".$diax_e."_opaque_column7"} .= ",";
				${"internal".$diax_e."_opaque_column8"} .= $ap.",";
				${"internal".$diax_e."_opaque_column9"} .= $ek.",";
				${"internal".$diax_e."_opaque_column10"} .= $orofi["fhor_h"].",";
				${"internal".$diax_e."_opaque_column11"} .= $orofi["fhor_c"].",";
				${"internal".$diax_e."_opaque_column12"} .= $orofi["fov_h"].",";
				${"internal".$diax_e."_opaque_column13"} .= $orofi["fov_c"].",";
				${"internal".$diax_e."_opaque_column14"} .= $orofi["ffin_h"].",";
				${"internal".$diax_e."_opaque_column15"} .= $orofi["ffin_c"].",";
				${"internal".$diax_e."_opaque_column16"} .= $senaria_u_wins_cost.",";
			${"internal".$diax_e."_count_opaque"}++;
			}else{//ΔΕΝ είναι αδιαφανής πόρτα
				//Καρτέλα - Διαφανή
				${"internal".$diax_e."_transparent_column1"} .= "Κούφωμα,";
				${"internal".$diax_e."_transparent_column2"} .= $window_name.",";
				${"internal".$diax_e."_transparent_column3"} .= $orofi["g"].",";
				${"internal".$diax_e."_transparent_column4"} .= $orofi["b"].",";
				${"internal".$diax_e."_transparent_column5"} .= $window_e.",";
				${"internal".$diax_e."_transparent_column6"} .= $array_window_type[$window["type"]].",";
				${"internal".$diax_e."_transparent_column7"} .= $window_u.",";
				${"internal".$diax_e."_transparent_column8"} .= $window_gw.",";
				${"internal".$diax_e."_transparent_column9"} .= $orofi["fhor_h"].",";
				${"internal".$diax_e."_transparent_column10"} .= $orofi["fhor_c"].",";
				${"internal".$diax_e."_transparent_column11"} .= $orofi["fov_h"].",";
				${"internal".$diax_e."_transparent_column12"} .= $orofi["fov_c"].",";
				${"internal".$diax_e."_transparent_column13"} .= $orofi["ffin_h"].",";
				${"internal".$diax_e."_transparent_column14"} .= $orofi["ffin_c"].",";
				${"internal".$diax_e."_transparent_column15"} .= $senaria_u_wins_cost.",";
			${"internal".$diax_e."_count_transparent"}++;
			}//Είναι διαφανές
			}//Στο κέλυφος διαχωριστικής
		}//Για κάθε παράθυρο οροφής
		
		$roof_e=0;
		$roof_e=$orofi["e"]-$window_sume;
		
		if($orofi["type"]==0){ //Οροφή σε αέρα
			$opaque_column1 .= "Οροφή,";
			$opaque_column2 .= $orofi["name"].",";
			$opaque_column3 .= $orofi["g"].",";
			$opaque_column4 .= $orofi["b"].",";
			$opaque_column5 .= $roof_e.",";
			$opaque_column6 .= $orofi_u.",";
			$opaque_column7 .= ",";
			$opaque_column8 .= $orofi_ap.",";
			$opaque_column9 .= $orofi_ek.",";
			$opaque_column10 .= $orofi["fhor_h"].",";
			$opaque_column11 .= $orofi["fhor_c"].",";
			$opaque_column12 .= $orofi["fov_h"].",";
			$opaque_column13 .= $orofi["fov_c"].",";
			$opaque_column14 .= $orofi["ffin_h"].",";
			$opaque_column15 .= $orofi["ffin_c"].",";
			$opaque_column16 .= $senaria_u_roofs_cost.",";
		$count_opaque++;
		}//Οροφή σε αέρα
		if($orofi["type"]==1){ //Οροφή σε ΜΘΧ
		$diax_e= ${"array_internals".$id}[$orofi["mthx_id"]];
			${"internal".$diax_e."_opaque_column1"} .= "Οροφή,";
			${"internal".$diax_e."_opaque_column2"} .= $orofi["name"].",";
			${"internal".$diax_e."_opaque_column3"} .= $orofi["g"].",";
			${"internal".$diax_e."_opaque_column4"} .= $orofi["b"].",";
			${"internal".$diax_e."_opaque_column5"} .= $roof_e.",";
			${"internal".$diax_e."_opaque_column6"} .= $orofi_u.",";
			${"internal".$diax_e."_opaque_column7"} .= ",";
			${"internal".$diax_e."_opaque_column8"} .= $orofi_ap.",";
			${"internal".$diax_e."_opaque_column9"} .= $orofi_ek.",";
			${"internal".$diax_e."_opaque_column10"} .= $orofi["fhor_h"].",";
			${"internal".$diax_e."_opaque_column11"} .= $orofi["fhor_c"].",";
			${"internal".$diax_e."_opaque_column12"} .= $orofi["fov_h"].",";
			${"internal".$diax_e."_opaque_column13"} .= $orofi["fov_c"].",";
			${"internal".$diax_e."_opaque_column14"} .= $orofi["ffin_h"].",";
			${"internal".$diax_e."_opaque_column15"} .= $orofi["ffin_c"].",";
			${"internal".$diax_e."_opaque_column16"} .= $senaria_u_roofs_cost.",";
		${"internal".$diax_e."_count_opaque"}++;
		}
		if($orofi["type"]==2){//οροφή σε έδαφος
			//Εκτύπωση γραμμής οροφής σε έδαφος
			$ground_column1 .= "Δάπεδο - Οροφή,";
			$ground_column2 .= $orofi["name"].",";
			$ground_column3 .= $roof_e.",";
			$ground_column4 .= $orofi_u.",";
			$ground_column5 .= $orofi["z"].",";
			$ground_column6 .= ",";
			$ground_column7 .= $orofi["p"].",";
			$ground_column8 .= $senaria_u_roofs_cost.",";
			
			$count_ground++;
		}
	}
	
	
	//ΔΑΠΕΔΑ - 0 επί εδάφους, 1 σε ΜΘΧ, 2 σε πυλωτή
	foreach($zone_dapeda as $dapedo){
		if($dapedo["u"]!=0){
			$dapedo_u=$dapedo["u"];
		}else{
			$dapedo_u_data = $database->select("user_adiafani","u",array("id"=>$dapedo["u_id"]) );
			$dapedo_u=$dapedo_u_data[0];
			$senaria_u_floors_cost=$floors_cost;
		}
		
		
		//Προσαύξηση μόνο σε αέρα
		if($dapedo["type"]==2){ //Δάπεδο σε αέρα
			$dapedo_u=$dapedo_u+$u_plus;
		}
		
			//ΣΥΝΤΕΛΕΣΤΕΣ ΘΕΡΜΟΠΕΡΑΤΟΤΗΤΑΣ ΣΕΝΑΡΙΑ
			if($zzz>=2 AND $senaria_active[$zzz-2]==1){//είναι σενάριο και είναι ενεργό
				if($senaria_u_floors[$zzz-2]!="" AND $senaria_u_floors[$zzz-2]!=$dapedo_u){
					$dapedo_u=$senaria_u_floors[$zzz-2];
				}
			}//είναι σενάριο και είναι ενεργό
		
		
		if($dapedo["type"]==0){//Δάπεδο σε έδαφος
			//Εκτύπωση δαπέδου στις γραμμές επαφής με έδαφος			
			$ground_column1 .= "Δάπεδο - Οροφή,";
			$ground_column2 .= $dapedo["name"].",";
			$ground_column3 .= $dapedo["e"].",";
			$ground_column4 .= $dapedo_u.",";
			$ground_column5 .= $dapedo["z"].",";
			$ground_column6 .= ",";
			$ground_column7 .= $dapedo["p"].",";;
			$ground_column8 .= $senaria_u_floors_cost.",";
		$count_ground++;
		}//Δάπεδο σε έδαφος
		
		if($dapedo["type"]==1){//Δάπεδο σε ΜΘΧ
		$diax_e= ${"array_internals".$id}[$dapedo["mthx_id"]];
			${"internal".$diax_e."_opaque_column1"} .= "Δάπεδο,";
			${"internal".$diax_e."_opaque_column2"} .= $dapedo["name"].",";
			${"internal".$diax_e."_opaque_column3"} .= "180,";
			${"internal".$diax_e."_opaque_column4"} .= "180,";
			${"internal".$diax_e."_opaque_column5"} .= $dapedo["e"].",";
			${"internal".$diax_e."_opaque_column6"} .= $dapedo_u.",";
			${"internal".$diax_e."_opaque_column7"} .= ",";
			${"internal".$diax_e."_opaque_column8"} .= "0,";
			${"internal".$diax_e."_opaque_column9"} .= "0,";
			${"internal".$diax_e."_opaque_column10"} .= "0,";
			${"internal".$diax_e."_opaque_column11"} .= "0,";
			${"internal".$diax_e."_opaque_column12"} .= "0,";
			${"internal".$diax_e."_opaque_column13"} .= "0,";
			${"internal".$diax_e."_opaque_column14"} .= "0,";
			${"internal".$diax_e."_opaque_column15"} .= "0,";
			${"internal".$diax_e."_opaque_column16"} .= $senaria_u_floors_cost.",";
		${"internal".$diax_e."_count_opaque"}++;
		}//Δάπεδο σε ΜΘΧ
		
		if($dapedo["type"]==2){//Δάπεδο σε πυλωτή
			$opaque_column1 .= "Πυλωτή,";
			$opaque_column2 .= $dapedo["name"].",";
			$opaque_column3 .= "180,";
			$opaque_column4 .= "180,";
			$opaque_column5 .= $dapedo["e"].",";
			$opaque_column6 .= $dapedo_u.",";
			$opaque_column7 .= ",";
			$opaque_column8 .= "0,";
			$opaque_column9 .= "0,";
			$opaque_column10 .= "0,";
			$opaque_column11 .= "0,";
			$opaque_column12 .= "0,";
			$opaque_column13 .= "0,";
			$opaque_column14 .= "0,";
			$opaque_column15 .= "0,";
			$opaque_column16 .= $senaria_u_floors_cost.",";
		$count_opaque++;
		}//Δάπεδο σε πυλωτή
			
	}//Για κάθε δάπεδο
	
	
	//################################ SCRIPT ΚΕΛΥΦΟΥΣ ΟΠΩΣ ΣΤΟ FUNCTIONS_MELETI_GENERAL preview_tables_kelyfos ###############
	
	
	//Κέλυφος
	$envelope = $domtree->createElement("ENVELOPE");
    $envelope = $zone->appendChild($envelope);
	$envelope->setAttribute('rid', $rid);
	
	//Στοιχεία αδιαφανών
	$envelope->appendChild($domtree->createElement('opaque_rows',$count_opaque));//αριθμός γραμμων
	for($i=1;$i<=16;$i++){
		$envelope->appendChild($domtree->createElement('opaque_column'.$i,${"opaque_column".$i}));
	}
	
	//Στοιχεία εδάφους
	$envelope->appendChild($domtree->createElement('ground_rows',$count_ground));
	for($i=1;$i<=8;$i++){
		$envelope->appendChild($domtree->createElement('ground_column'.$i,${"ground_column".$i}));
	}
	
	//Στοιχεία διαφανών
	$envelope->appendChild($domtree->createElement('transparent_rows',$count_transparent));
	for($i=1;$i<=15;$i++){
		$envelope->appendChild($domtree->createElement('transparent_column'.$i,${"transparent_column".$i}));
	}
	
	$envelope->appendChild($domtree->createElement('opaque_tb_rows',''));
	$envelope->appendChild($domtree->createElement('opaque_tb_column1',''));
	$envelope->appendChild($domtree->createElement('opaque_tb_column2',''));
	$envelope->appendChild($domtree->createElement('opaque_tb_column3',''));
	
	//Παθητικά ηλιακά
	$envelope->appendChild($domtree->createElement('internal_nodes',$internals_zone));
	$envelope->appendChild($domtree->createElement('direct_benefit_exist',$direct_benefit_exist));
	$envelope->appendChild($domtree->createElement('direct_benefit_rows',$count_direct));
	
	for($i=1;$i<=16;$i++){
		$envelope->appendChild($domtree->createElement('direct_benefit_column'.$i,${"direct_benefit_column".$i}));
	}
	
	//Διαχωριστικές ζώνης
	for($inter=1;$inter<=$internals_zone;$inter++){
		$internal = $domtree->createElement("internal".$inter);
		$internal = $envelope->appendChild($internal);
		$internal->setAttribute('rid', $rid);
		
		$internal->appendChild($domtree->createElement('space_between',$array_mthx_ids[${"array_internals_inv".$id}[$inter]]));
		
		$internal->appendChild($domtree->createElement('opaque_rows',${"internal".$inter."_count_opaque"}));
		for($i=1;$i<=16;$i++){
			$internal->appendChild($domtree->createElement('opaque_column'.$i,${"internal".$inter."_opaque_column".$i}));
		}
		$internal->appendChild($domtree->createElement('transparent_rows',${"internal".$inter."_count_transparent"}));
		for($i=1;$i<=15;$i++){
			$internal->appendChild($domtree->createElement('transparent_column'.$i,${"internal".$inter."_transparent_column".$i}));
		}
		
	$internal->appendChild($domtree->createElement('opaque_tb_rows',''));
	$internal->appendChild($domtree->createElement('opaque_tb_column1',''));
	$internal->appendChild($domtree->createElement('opaque_tb_column2',''));
	$internal->appendChild($domtree->createElement('opaque_tb_column3',''));
	}
	
	
	
	//################### SCRIPT ΣΥΣΤΗΜΑΤΩΝ ΟΠΩΣ ΣΤΟ FUNCTIONS_MELETI_GENERAL preview_tables_systems ###############
	
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
		7=>"Τοπικές ηλεκτρικές μονάδες (καλοριφέρ ή θερμοπομποί ή άλλο)",
		8=>"Τοπικές μονάδες αερίου ή υγρού καυσίμου",
		9=>"Ανοικτές εστίες καύσης",
		10=>"Τηλεθέρμανση",
		11=>"ΣΗΘ",
		12=>"Μονάδα παραγωγής άλλου τύπου"
	);
	$array_pigi=array(
		0=>"Bottle gas (LPG)",
		1=>"Natural gas",
		2=>"Electricity",
		3=>"Fuel oil",
		4=>"Fuel oil with taxis",
		5=>"District heating",
		6=>"District heating res",
		7=>"Biomass",
		8=>"Biomasst",
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
		0=>"Εσωτερικοί  ή έως και 20% σε εξωτερικούς",
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
		1=>"2. Ανίχνευση με αυτόματη έναυση και σβέση",
		2>"3. Ανίχνευση με χειροκίνητη έναυση / αυτόματη σβέση"
	);
	$array_true=array(
		0=>"False",
		1=>"True"
	);
	
	//Συντελεστές μηνών σε array με βάση τη χρήση
	$month_values_heat = $database->select($tb_months_heat,"*",array("xrisi"=>$zones["xrisi"]));
	$month_values_cold = $database->select($tb_months_cold,"*",array("xrisi"=>$zones["xrisi"]));
	$month_values_heat=$month_values_heat[0];
	$month_values_cold=$month_values_cold[0];
	
	//ΘΕΡΜΑΝΣΗ
	for($i=1;$i<=18;$i++){
		${"therm_production_column".$i}="";
	}
	for($i=1;$i<=8;$i++){
		${"therm_distribution_column".$i}="";
	}
	for($i=1;$i<=3;$i++){
		${"therm_termatic_column".$i}="";
	}
	for($i=1;$i<=3;$i++){
		${"therm_auxiliary_column".$i}="";
	}
	$count_therm_production=0;
	$count_therm_auxiliary=0;
	
	
	//ΘΕΡΜΑΝΣΗ - Παραγωγή
	foreach($sys_thermp as $thermp){			
		$therm_production_column1 .= $array_thermp_type[$thermp["type"]].",";
		$therm_production_column2 .= $array_pigi[$thermp["pigi"]].",";
		$therm_production_column3 .= $thermp["w"].",";
		$therm_production_column4 .= $thermp["n"].",";
		$therm_production_column5 .= $thermp["cop"].",";
			$i=6;
			foreach($months_en as $month){
				${"therm_production_column".$i} .= $thermp[$month].",";
			$i++;
			}
		$therm_production_column18 .= ",";//κόστος
	$count_therm_production++;
	}//ΘΕΡΜΑΝΣΗ - Μονάδες παραγωγής
	
	//ΘΕΡΜΑΝΣΗ - διανομή
	foreach($sys_thermd as $thermd){			
		$therm_distribution_column1 .= "Δίκτυο διανομής θερμού μέσου,Αεραγωγοί,";
		$therm_distribution_column2 .= $thermd["d_w"].",,";
		$therm_distribution_column3 .= $array_dtype[$thermd["d_type"]].",".$array_dtype[$thermd["a_type"]].",";
		$therm_distribution_column4 .= ",,";
		$therm_distribution_column5 .= ",,";
		$therm_distribution_column6 .= $thermd["d_n"].",,";
		$therm_distribution_column7 .= "False,".$array_true[$thermd["a_insulation"]].",";
		$therm_distribution_column8 .= ",,";//κόστος
	}//ΘΕΡΜΑΝΣΗ διανομή
	
	//ΘΕΡΜΑΝΣΗ - Τερματικές
	foreach($sys_thermt as $thermt){			
		$therm_termatic_column1 .= $thermt["type"].",";
		$therm_termatic_column2 .= $thermt["n"].",";
		$therm_termatic_column3 .= ",";//κόστος
	}//ΘΕΡΜΑΝΣΗ - Τερματικές
	
	//ΘΕΡΜΑΝΣΗ - βοηθητικές
	foreach($sys_thermv as $thermv){			
		$therm_auxiliary_column1 .= $array_thermv_type[$thermv["type"]].",";
		$therm_auxiliary_column2 .= $thermv["n"].",";
		$therm_auxiliary_column3 .= round($thermv["w"],4).",";
	$count_therm_auxiliary++;
	}//ΘΕΡΜΑΝΣΗ - βοηθητικές
	//ΘΕΡΜΑΝΣΗ
	
	//ΨΥΞΗ
	for($i=1;$i<=18;$i++){
		${"cold_production_column".$i}="";
	}
	for($i=1;$i<=6;$i++){
		${"cold_distribution_column".$i}="";
	}
	for($i=1;$i<=3;$i++){
		${"cold_termatic_column".$i}="";
	}
	for($i=1;$i<=3;$i++){
		${"cold_auxiliary_column".$i}="";
	}
	$count_cold_production=0;
	$count_cold_auxiliary=0;
	
	
	//ΨΥΞΗ - Παραγωγή
	foreach($sys_coldp as $coldp){			
		$cold_production_column1 .= $array_coldp_type[$coldp["type"]].",";
		$cold_production_column2 .= $array_pigi[$coldp["pigi"]].",";
		$cold_production_column3 .= $coldp["w"].",";
		$cold_production_column4 .= $coldp["n"].",";
		$cold_production_column5 .= $coldp["eer"].",";
			$i=6;
			foreach($months_en as $month){
				${"cold_production_column".$i} .= $coldp[$month].",";
			$i++;
			}
		$cold_production_column18 .= ",";//κόστος
	$count_cold_production++;
	}//ΨΥΞΗ - Μονάδες παραγωγής
	
	//ΨΥΞΗ - διανομή
	foreach($sys_coldd as $coldd){			
		$cold_distribution_column1 .= "Δίκτυο διανομής ψυχρού μέσου,Αεραγωγοί,";
		$cold_distribution_column2 .= $coldd["d_w"].",,";
		$cold_distribution_column3 .= $array_dtype[$coldd["d_type"]].",".$array_dtype[$coldd["a_type"]].",";
		$cold_distribution_column4 .= $coldd["d_n"].",,";
		$cold_distribution_column5 .= "False,".$array_true[$coldd["a_insulation"]].",";
		$cold_distribution_column6 .= ",,";//κόστος
	}//ΨΥΞΗ διανομή
	
	//ΨΥΞΗ - Τερματικές
	foreach($sys_coldt as $coldt){			
		$cold_termatic_column1 .= $coldt["type"].",";
		$cold_termatic_column2 .= $coldt["n"].",";
		$cold_termatic_column3 .= ",";//κόστος
	}//ΨΥΞΗ - Τερματικές
	
	//ΨΥΞΗ - βοηθητικές
	foreach($sys_coldv as $coldv){			
		$cold_auxiliary_column1 .= $array_coldv_type[$coldv["type"]].",";
		$cold_auxiliary_column2 .= $coldv["n"].",";
		$cold_auxiliary_column3 .= round($coldv["w"],4).",";
	$count_cold_auxiliary++;
	}//ΨΥΞΗ - βοηθητικές
	//ΨΥΞΗ
	
	//ZNX
	for($i=1;$i<=17;$i++){
		${"znx_production_column".$i}="";
	}
	for($i=1;$i<=5;$i++){
		${"znx_distribution_column".$i}="";
	}
	for($i=1;$i<=3;$i++){
		${"znx_termatic_column".$i}="";
	}
	for($i=1;$i<=3;$i++){
		${"znx_auxiliary_column".$i}="";
	}
	$count_znx_production=0;
	$count_znx_auxiliary=0;
	
	//ZNX - Παραγωγή
	foreach($sys_znxp as $znxp){			
		$znx_production_column1 .= $array_znxp_type[$znxp["type"]].",";
		$znx_production_column2 .= $array_pigi[$znxp["pigi"]].",";
		$znx_production_column3 .= $znxp["w"].",";
		$znx_production_column4 .= $znxp["n"].",";
			$i=5;
			foreach($months_en as $month){
				${"znx_production_column".$i} .= $znxp[$month].",";
			$i++;
			}
		$znx_production_column17 .= ",";//κόστος
	$count_znx_production++;
	}//ZNX - Μονάδες παραγωγής
	
	//ZNX - διανομή
	foreach($sys_znxd as $znxd){			
		$znx_distribution_column1 .= $znxd["type"].",";
		$znx_distribution_column2 .= $array_true[$znxd["ana"]].",";
		$znx_distribution_column3 .= $array_dtype[$znxd["dieleysi"]].",";
		$znx_distribution_column4 .= $znxd["n"].",";
		$znx_distribution_column5 .= ",";//κόστος
	}//ZNX διανομή
	
	//ZNX - Τερματικές
	foreach($sys_znxt as $znxt){			
		$znx_termatic_column1 .= $znxt["type"].",";
		$znx_termatic_column2 .= $znxt["n"].",";
		$znx_termatic_column3 .= ",";//κόστος
	}//ZNX - Τερματικές
	
	//ZNX - βοηθητικές
	foreach($sys_znxv as $znxv){			
		$znx_auxiliary_column1 .= $array_znxv_type[$znxv["type"]].",";
		$znx_auxiliary_column2 .= $znxv["n"].",";
		$znx_auxiliary_column3 .= round($znxv["w"],4).",";
	$count_znx_auxiliary++;
	}//ZNX - βοηθητικές
	
	if($count_znx_production>0){
		$znx_exists=1;
	}else{
		$znx_exists=0;
	}
	//ZNX
	
	
	//ΥΓΡΑΝΣΗ
	for($i=1;$i<=17;$i++){
		${"ygr_production_column".$i}="";
	}
	for($i=1;$i<=4;$i++){
		${"ygr_distribution_column".$i}="";
	}
	for($i=1;$i<=3;$i++){
		${"ygr_termatic_column".$i}="";
	}
	$count_ygr_production=0;
	
	//ΥΓΡΑΝΣΗ - Παραγωγή
	foreach($sys_ygrp as $ygrp){			
		$ygr_production_column1 .= $array_ygrp_type[$ygrp["type"]].",";
		$ygr_production_column2 .= $array_pigi[$ygrp["pigi"]].",";
		$ygr_production_column3 .= $ygrp["w"].",";
		$ygr_production_column4 .= $ygrp["n"].",";
			$i=5;
			foreach($months_en as $month){
				${"ygr_production_column".$i} .= $ygrp[$month].",";
			$i++;
			}
		$ygr_production_column17 .= ",";//κόστος
	$count_ygr_production++;
	}//ΥΓΡΑΝΣΗ - Μονάδες παραγωγής
	
	//ΥΓΡΑΝΣΗ - διανομή
	foreach($sys_ygrd as $ygrd){			
		$ygr_distribution_column1 .= $ygrd["type"].",";
		$ygr_distribution_column2 .= $array_dtype[$ygrd["dieleysi"]].",";
		$ygr_distribution_column3 .= $ygrd["n"].",";
		$ygr_distribution_column4 .= ",";//κόστος
	}//ΥΓΡΑΝΣΗ διανομή
	
	//ΥΓΡΑΝΣΗ - Τερματικές
	foreach($sys_ygrt as $ygrt){			
		$ygr_termatic_column1 .= $ygrt["type"].",";
		$ygr_termatic_column2 .= $ygrt["n"].",";
		$ygr_termatic_column3 .= ",";//κόστος
	}//ΥΓΡΑΝΣΗ - Τερματικές
	
	if($count_ygr_production>0){
		$ygr_exists=1;
	}else{
		$ygr_exists=0;
	}
	//ΥΓΡΑΝΣΗ
	
	//ΑΕΡΙΣΜΟΣ
	for($i=1;$i<=16;$i++){
		${"ahu_column".$i}="";
	}
	$count_ahu=0;
	//ΑΕΡΙΣΜΟΣ - Παραγωγή
	foreach($sys_aerp as $aerp){			
		$ahu_column1 .= $aerp["type"].",";
		$ahu_column2 .= $array_true[$aerp["active_h"]].",";
		$ahu_column3 .= $aerp["f_h"].",";
		$ahu_column4 .= ",";
		$ahu_column5 .= $aerp["r_h"].",";
		$ahu_column6 .= $aerp["q_r_h"].",";
		$ahu_column7 .= $array_true[$aerp["active_c"]].",";
		$ahu_column8 .= $aerp["f_c"].",";
		$ahu_column9 .= ",";
		$ahu_column10 .= $aerp["r_c"].",";
		$ahu_column11 .= $aerp["q_r_c"].",";
		$ahu_column12 .= $array_true[$aerp["active_y"]].",";
		$ahu_column13 .= $aerp["h_r"].",";
		$ahu_column14 .= $aerp["filters"].",";
		$ahu_column15 .= $aerp["e_vent"].",";
		$ahu_column16 .= ",";//κόστος
	$count_ahu++;
	}//ΑΕΡΙΣΜΟΣ - παραγωγή
	if($count_ahu>0){
		$ahu_exists=1;
	}else{
		$ahu_exists=0;
	}
	//ΑΕΡΙΣΜΟΣ
	
	//ΗΛΙΑΚΟΣ
	for($i=1;$i<=10;$i++){
		${"solar_collector_column".$i}="";
	}
	$count_solar=0;
	//ΗΛΙΑΚΟΣ - Συλλέκτης
	foreach($sys_solar as $solar){
		$solar_collector_column1 .= $array_solar_type[$solar["type"]].",";
		$solar_collector_column2 .= $array_true[$solar["active_h"]].",";
		$solar_collector_column3 .= $array_true[$solar["active_z"]].",";
		$solar_collector_column4 .= $solar["syna"].",";
		$solar_collector_column5 .= $solar["synb"].",";
		$solar_collector_column6 .= $solar["e"].",";
		$solar_collector_column7 .= $solar["g"].",";
		$solar_collector_column8 .= $solar["b"].",";
		$solar_collector_column9 .= $solar["fs"].",";
		$solar_collector_column10 .= ",";//κόστος
	$count_solar++;
	}//ΗΛΙΑΚΟΣ - Συλλέκτης
	if($count_solar>0){
		$solar_exists=1;
	}else{
		$solar_exists=0;
	}
	//ΗΛΙΑΚΟΣ
	
	//ΦΩΤΙΣΜΟΣ
	for($i=1;$i<=12;$i++){
		${"lighting_parameter".$i}="";
	}
	$count_light=0;
	
	//ΦΩΤΙΣΜΟΣ - 1 γραμμή κανονικά
	if($database->count($tb_sys_light,$where_zone)>0){//γραμμές φωτισμού
		
	$data_lightzones=explode("^", $sys_light[0]["zoneper"]);
	if( is_array($data_lightzones) ){//isarray() Κυρίως για παλιές μελέτες που δεν είχαν προστεθεί οι ζώνες φωτισμού
	$lightzones="";
	for($i=0;$i<=6;$i++){
		if(array_key_exists($i,$data_lightzones)){
			$lightzones .= $data_lightzones[$i].",";
		}
	}
	}//isarray()
	
	foreach($sys_light as $light){
		
		$lighting_parameter1 .= $light["w"];
		$lighting_parameter2 .= $light["e_per"];
		$lighting_parameter3 .= $light["auto_ff"];
		$lighting_parameter4 .= $light["auto_move"];
		$lighting_parameter5 .= ",";//κόστος
		$lighting_parameter6 .= $light["active_heat"];
		$lighting_parameter7 .= $light["active_safety"];
		$lighting_parameter8 .= $light["active_backup"];
		$lighting_parameter9 .= $lightzones;
		$lighting_parameter10 .= $light["wff"];
		$lighting_parameter11 .= $light["wpar"];
		$lighting_parameter12 .= $light["wffpar"];
	$count_light++;
	}//ΦΩΤΙΣΜΟΣ - 1 γραμμή
	
	}//γραμμές φωτισμού
	
	if($count_light>0){
		$light_exists=1;
	}else{
		$light_exists=0;
	}
	//ΦΩΤΙΣΜΟΣ
	
	
	//################### SCRIPT ΣΥΣΤΗΜΑΤΩΝ ΟΠΩΣ ΣΤΟ FUNCTIONS_MELETI_GENERAL preview_tables_systems ###############
	
	//ΣΥΣΤΗΜΑΤΑ ΖΩΝΗΣ
	$system = $domtree->createElement("SYSTEM");
    $system = $zone->appendChild($system);
	$system->setAttribute('rid', $rid);
	
	//ΘΕΡΜΑΝΣΗ
	$heating = $domtree->createElement("heating");
    $heating = $system->appendChild($heating);
	$heating->setAttribute('rid', $rid);
	
	$heating->appendChild($domtree->createElement('heating_exists',1));
	
	$heating->appendChild($domtree->createElement('production_rows',$count_therm_production));
		for($i=1;$i<=18;$i++){
			$heating->appendChild($domtree->createElement("production_column".$i,${"therm_production_column".$i}));
		}
	$heating->appendChild($domtree->createElement("distribution_rows",2));
		for($i=1;$i<=8;$i++){
			$heating->appendChild($domtree->createElement("distribution_column".$i,${"therm_distribution_column".$i}));
		}
	$heating->appendChild($domtree->createElement("termatic_rows", 1));
		for($i=1;$i<=3;$i++){
			$heating->appendChild($domtree->createElement("termatic_column".$i,${"therm_termatic_column".$i}));
		}
	$heating->appendChild($domtree->createElement('auxiliary_rows', $count_therm_auxiliary));
		for($i=1;$i<=3;$i++){
		$heating->appendChild($domtree->createElement("auxiliary_column".$i,${"therm_auxiliary_column".$i}));
		}
	
	//ΨΥΞΗ
	$cooling = $domtree->createElement("cooling");
    $cooling = $system->appendChild($cooling);
	$cooling->setAttribute('rid', $rid);
	
	$cooling->appendChild($domtree->createElement('cooling_exists',1));
	
	$cooling->appendChild($domtree->createElement('production_rows',$count_cold_production));
		for($i=1;$i<=18;$i++){
			$cooling->appendChild($domtree->createElement("production_column".$i,${"cold_production_column".$i}));
		}
	$cooling->appendChild($domtree->createElement("distribution_rows",2));
		for($i=1;$i<=6;$i++){
			$cooling->appendChild($domtree->createElement("distribution_column".$i,${"cold_distribution_column".$i}));
		}
	$cooling->appendChild($domtree->createElement("termatic_rows", 1));
		for($i=1;$i<=3;$i++){
			$cooling->appendChild($domtree->createElement("termatic_column".$i,${"cold_termatic_column".$i}));
		}
	$cooling->appendChild($domtree->createElement('auxiliary_rows', $count_cold_auxiliary));
		for($i=1;$i<=3;$i++){
			$cooling->appendChild($domtree->createElement("auxiliary_column".$i,${"cold_auxiliary_column".$i}));
		}
	
	//HUMIDIFICATION
	$humidification = $domtree->createElement("humidification");
    $humidification = $system->appendChild($humidification);
	$humidification->setAttribute('rid', $rid);
	
	$humidification->appendChild($domtree->createElement('humidification_exists',$ygr_exists));
	
	$humidification->appendChild($domtree->createElement('production_rows',$count_ygr_production));
		for($i=1;$i<=17;$i++){
			$humidification->appendChild($domtree->createElement("production_column".$i,${"ygr_production_column".$i}));
		}
	$humidification->appendChild($domtree->createElement("distribution_rows",1));
		for($i=1;$i<=4;$i++){
			$humidification->appendChild($domtree->createElement("distribution_column".$i,${"ygr_distribution_column".$i}));
		}
	$humidification->appendChild($domtree->createElement("termatic_rows", 1));
		for($i=1;$i<=3;$i++){
			$humidification->appendChild($domtree->createElement("termatic_column".$i,${"ygr_termatic_column".$i}));
		}
	
	//AHU - ΑΕΡΙΣΜΟΣ
	$ahu = $domtree->createElement("ahu");
    $ahu = $system->appendChild($ahu);
	$ahu->setAttribute('rid', $rid);
	
	$ahu->appendChild($domtree->createElement('ahu_exists',$ahu_exists));
	$ahu->appendChild($domtree->createElement('ahu_rows',$count_ahu));
		for($i=1;$i<=16;$i++){
			$ahu->appendChild($domtree->createElement("ahu_column".$i,${"ahu_column".$i}));
		}
	
	//DHW - ZNX
	$dhw = $domtree->createElement("dhw");
    $dhw = $system->appendChild($dhw);
	$dhw->setAttribute('rid', $rid);
	
	$dhw->appendChild($domtree->createElement('dhw_exists',$znx_exists));
	
	
	$dhw->appendChild($domtree->createElement('production_rows',$count_znx_production));
		for($i=1;$i<=17;$i++){
			$dhw->appendChild($domtree->createElement("production_column".$i,${"znx_production_column".$i}));
		}
	$dhw->appendChild($domtree->createElement("distribution_rows",2));
		for($i=1;$i<=5;$i++){
			$dhw->appendChild($domtree->createElement("distribution_column".$i,${"znx_distribution_column".$i}));
		}
	$dhw->appendChild($domtree->createElement("termatic_rows", 1));
		for($i=1;$i<=3;$i++){
			$dhw->appendChild($domtree->createElement("termatic_column".$i,${"znx_termatic_column".$i}));
		}
	$dhw->appendChild($domtree->createElement('auxiliary_rows', $count_znx_auxiliary));
		for($i=1;$i<=3;$i++){
			$dhw->appendChild($domtree->createElement("auxiliary_column".$i,${"znx_auxiliary_column".$i}));
		}
	
	//ΗΛΙΑΚΟΣ ΣΥΛΛΕΚΤΗΣ
	$solar_collector = $domtree->createElement("solar_collector");
    $solar_collector = $system->appendChild($solar_collector);
	$solar_collector->setAttribute('rid', $rid);
	
	$solar_collector->appendChild($domtree->createElement('solar_collector_exists',$solar_exists));
	$solar_collector->appendChild($domtree->createElement('solar_collector_rows',$count_solar));
		for($i=1;$i<=10;$i++){
			$solar_collector->appendChild($domtree->createElement("solar_collector_column".$i,${"solar_collector_column".$i}));
		}
	
	//ΦΩΤΙΣΜΟΣ
	$lighting = $domtree->createElement("lighting");
    $lighting = $system->appendChild($lighting);
	$lighting->setAttribute('rid', $rid);
	
	$lighting->appendChild($domtree->createElement('lighting_exists',$light_exists));
		for($i=1;$i<=12;$i++){
			$lighting->appendChild($domtree->createElement("lighting_parameter".$i,${"lighting_parameter".$i}));
		}
	
	$num++;
	}//Για κάθε ζώνη
	
	
	//Για κάθε ΜΘΧ - UNHEATED - Για κάθε Ηλιακό χώρο - SOLAR
	$num_mthx=1;
	$num_solar=1;
	foreach($data_allmthxs as $mthxs){
		$id = $mthxs["id"];
		$where_mthx=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'], "mthx_id"=>$id));
		$data_xwroi = $database->select("meletes_xwroi","*",$where_mthx);
		
		//Εμβαδά
		$mthx_e=0;
		foreach($data_xwroi as $xwros){
			if($xwros["type"]==0){//Μετράει και εμβαδόν και όγκος
				$xwros_e=$xwros["l"]*$xwros["w"];
				$xwros_v=$xwros_e*$xwros["h"];
			}else{//Μετράει μόνο όγκος (4κλινής σκεπή)
				$xwros_e=0;
				$xwros_v=(1/6)*$xwros["w"]*$xwros["h"]*(2*$xwros["w"]+3*($xwros["l"]-$xwros["w"]));
			}
			$mthx_e+=$xwros_e;
		}
		
		//Αερισμός
		$mthx_window_data = $database->select("meletes_mthx_diafani","*",$where_mthx);
		$mthx_air=0;
		foreach($mthx_window_data as $mthx_window){
			$mthx_window_air = $mthx_window["w"]*$mthx_window["h"]*$mthx_window["wind"];
			$mthx_air+=$mthx_window_air;
		}
		
		$mthx_wall = $database->select("meletes_mthx_adiafani","*",$where_mthx);
		$mthx_window = $database->select("meletes_mthx_diafani","*",$where_mthx);
		$mthx_dapeda = $database->select("meletes_mthx_dapeda","*",$where_mthx);
		$mthx_orofes = $database->select("meletes_mthx_orofes","*",$where_mthx);
	
	$count_opaque=0;
	$count_ground=0;
	$count_transparent=0;
	
	//ΚΕΛΥΦΟΣ
	for($i=1;$i<=16;$i++){
		${"opaque_column".$i}="";
	}
	for($i=1;$i<=8;$i++){
		${"ground_column".$i}="";
	}
	for($i=1;$i<=16;$i++){
		${"transparent_column".$i}="";
	}
	
	foreach($mthx_wall as $wall){
		
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
			$dok_e = 0;
			$dok_h_sum = 0;
				for($doki=1; $doki<=count($data_dok)-1; $doki++){
				$dok = explode("|", $data_dok[$doki-1]);
					$dok_h = $dok[0];
					$dok_ar = $dok[1];
					$dok_e += $dok_h*$wall_l;
					$dok_h_sum += $dok_h;
				}
			
			//Υποστηλώματα
			$data_yp = explode("^", $wall["yp"]);
			$yp_e = 0;
				for($ypi=1; $ypi<=(count($data_yp)-1); $ypi++){
				$yp = explode("|", $data_yp[$ypi-1]);
					$yp_l = $yp[0];
					$yp_e += $yp_l*($wall_h-$dok_h_sum);
				}
				
			//Συρόμενα
			$data_syr = explode("^", $wall["syr"]);
			$syr_e = 0;
				for($syri=1; $syri<=count($data_syr)-1; $syri++){
				$syr = explode("|", $data_syr[$syri-1]);
					$syr_e += $syr[0]*$syr[1];
				}
		}
		
		//με ποσοστό φέρων οργανισμού
		if($per!=0){
			$dok_e=0;
			$yp_e=$wall_e_sum*$per/100;
			$syr_e=0;
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
				$fov_deg = atan($data_fov / $wall["h"])*180/pi();
				$fov = calc_skiasi_ov($fov_deg, $pros);
				$fov_h = $fov[0];
				$fov_c = $fov[1];
			}else{
				$fov_h = 1;
				$fov_c = 1;
			}
			
			//Πλευρικές σκιάσεις
			if( $data_ffin_l[1]!=0 ){
				$ffin_l_deg = atan( $data_ffin_l[1] / ($data_ffin_l[0]+$wall["l"]/2) )*180/pi();
				$ffin_l = calc_skiasi_fin($ffin_l_deg, $pros, 1);
			}
			if( $data_ffin_r[1]!=0 ){
				$ffin_r_deg = atan( $data_ffin_r[1] / ($data_ffin_r[0]+$wall["l"]/2) )*180/pi();
				$ffin_r = calc_skiasi_fin($ffin_r_deg, $pros, 2);
			}
			if( !isset($ffin_l[0]) ){
				$ffin_l = array();
				$ffin_l[0] = 1;$ffin_l[1] = 1;
			}
			if( !isset($ffin_r[0]) ){
				$ffin_r = array();
				$ffin_r[0] = 1;$ffin_r[1] = 1;
			}
			$ffin_h = $ffin_l[0]*$ffin_r[0];
			$ffin_c = $ffin_l[1]*$ffin_r[1];
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
		$data_window = $database->select("meletes_mthx_diafani","*",array("wall_id"=>$wall['id']) );
		foreach($data_window as $window){
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
					$fhor = calc_skiasi_hor($fhor_deg_w, $pros_w);
					$fhor_h_w = $fhor[0];
					$fhor_c_w = $fhor[1];
				}else{
					$fhor_h_w = 1;
					$fhor_c_w = 1;
				}
				
				//Σκίαση προβόλου
				if( $data_fov_w!=0 ){
					$fov_deg_w = atan($data_fov_w / ($wall["h"]-$window_p-$window_h/2) )*180/pi();
					$fov_w = calc_skiasi_ov($fov_deg_w, $pros_w);
					$fov_h_w = $fov[0];
					$fov_c_w = $fov[1];
				}else{
					$fov_h_w = 1;
					$fov_c_w = 1;
				}
				
				//Πλευρικές σκιάσεις
				if( $data_ffin_l_w[1]!=0 ){
					$ffin_l_deg_w = atan( $data_ffin_l_w[1] / ($data_ffin_l_w[0]+$window_apoar+$window_w/2) )*180/pi();
					$ffin_l_w = calc_skiasi_fin($ffin_l_deg_w, $pros_w, 1);
				}
				if( $data_ffin_r_w[1]!=0 ){
					$ffin_r_deg_w = atan( $data_ffin_r_w[1] / ($data_ffin_r_w[0]+($wall["h"]-$window_apoar-$window_w)+$window_w/2) )*180/pi();
					$ffin_r_w = calc_skiasi_fin($ffin_r_deg_w, $pros_w, 2);
				}
				if( !isset($ffin_l_w[0]) ){
					$ffin_l_w = array();
					$ffin_l_w[0] = 1;$ffin_l_w[1] = 1;
				}
				if( !isset($ffin_r_w[0]) ){
					$ffin_r_w = array();
					$ffin_r_w[0] = 1;$ffin_r_w[1] = 1;
				}
				$ffin_h_w = $ffin_l_w[0]*$ffin_r_w[0];
				$ffin_c_w = $ffin_l_w[1]*$ffin_r_w[1];
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
						$fhor = calc_skiasi_hor($fhor_deg_w, $pros_w);
						$fhor_h_w = $fhor[0];
						$fhor_c_w = $fhor[1];
					}else{
						$fhor_h_w = 1;
						$fhor_c_w = 1;
					}
					
					//Σκίαση προβόλου
					if( $data_fov_w!=0 ){
						$fov_deg_w = atan($data_fov_w / ($wall["h"]-$window_p-$window_h/2) )*180/pi();
						$fov_w = calc_skiasi_ov($fov_deg_w, $pros_w);
						$fov_h_w = $fov[0];
						$fov_c_w = $fov[1];
					}else{
						$fov_h_w = 1;
						$fov_c_w = 1;
					}
					
					//Πλευρικές σκιάσεις
					if( $data_ffin_l_w[1]!=0 ){
						$ffin_l_deg_w = atan( $data_ffin_l_w[1] / ($data_ffin_l_w[0]+$window_apoar+$window_w/2) )*180/pi();
						$ffin_l_w = calc_skiasi_fin($ffin_l_deg_w, $pros_w, 1);
					}
					if( $data_ffin_r_w[1]!=0 ){
						$ffin_r_deg_w = atan( $data_ffin_r_w[1] / ($data_ffin_r_w[0]+($wall["h"]-$window_apoar-$window_w)+$window_w/2) )*180/pi();
						$ffin_r_w = calc_skiasi_fin($ffin_r_deg_w, $pros_w, 2);
					}
					if( !isset($ffin_l_w[0]) ){
						$ffin_l_w = array();
						$ffin_l_w[0] = 1;$ffin_l_w[1] = 1;
					}
					if( !isset($ffin_r_w[0]) ){
						$ffin_r_w = array();
						$ffin_r_w[0] = 1;$ffin_r_w[1] = 1;
					}
					$ffin_h_w = $ffin_l_w[0]*$ffin_r_w[0];
					$ffin_c_w = $ffin_l_w[1]*$ffin_r_w[1];
				}//Αναλυτικά ο τοίχος
				
			}//από τοίχο
				
		}//Σκιάσεις αναλυτικά ή από τοίχο
		
		if($window_ftype==1){
			$fhor_h_w=0;
			$fhor_c_w=0;
			$fov_h_w=0;
			$fov_c_w=0;
			$ffin_h_w=0;
			$ffin_c_w=0;
		}
		
		if($window_ftype==2){
			$fhor_h_w=1;
			$fhor_c_w=1;
			$fov_h_w=1;
			$fov_c_w=1;
			$ffin_h_w=1;
			$ffin_c_w=1;
		}
		
		if($window["u_id"]=="u_bytype" AND $window["type"]==0){//αδιαφανής πόρτα
			$opaque_column1 .= "Πόρτα,";
			$opaque_column2 .= $window_name.",";
			$opaque_column3 .= $wall_g.",";
			$opaque_column4 .= $wall["b"].",";
			$opaque_column5 .= $window_e.",";
			$opaque_column6 .= $window_u.",";
			$opaque_column7 .= ",";
			$opaque_column8 .= $ap.",";
			$opaque_column9 .= $ek.",";
			$opaque_column10 .= $fhor_h_w.",";
			$opaque_column11 .= $fhor_c_w.",";
			$opaque_column12 .= $fov_h_w.",";
			$opaque_column13 .= $fov_c_w.",";
			$opaque_column14 .= $ffin_h_w.",";
			$opaque_column15 .= $ffin_c_w.",";
			$opaque_column16 .= ",";
		$count_opaque++;
		}else{//ΔΕΝ είναι αδιαφανής πόρτα
			$transparent_column1 .= "Κούφωμα,";
			$transparent_column2 .= $window_name.",";
			$transparent_column3 .= $wall_g.",";
			$transparent_column4 .= $wall["b"].",";
			$transparent_column5 .= $window_e.",";
			$transparent_column6 .= ",";
			$transparent_column7 .= $window_u.",";
			$transparent_column8 .= $window_gw.",";
			$transparent_column9 .= $fhor_h_w.",";
			$transparent_column10 .= $fhor_c_w.",";
			$transparent_column11 .= $fov_h_w.",";
			$transparent_column12 .= $fov_c_w.",";
			$transparent_column13 .= $ffin_h_w.",";
			$transparent_column14 .= $ffin_c_w.",";
			$transparent_column15 .= ",";
		$count_transparent++;
		}//Είναι διαφανές

		}//Για κάθε άνοιγμα
		
		//Καθαρό εμβαδόν τοίχου
		$wall_e_adiafanes = $wall_e_sum - $window_sume;//Ο τοίχος χωρίς παράθυρα
		$wall_e = $wall_e_sum - $syr_e - $yp_e - $dok_e - $window_sume;//Ο τοίχος χωρίς φέρων/παράθυρα
		$u_sum = ($wall_e*$u + $syr_e*$syr_u + $yp_e*$yp_u + $dok_e*$dok_u)/$wall_e_adiafanes;//Μέσος συντελεστής
	
		if($wall["type"]==0 OR $wall["type"]==2){//εάν ο τοίχος ανήκει στα αδιαφανή
			$toixos_per="Τοίχος";
			if($symptiksi==1){//1 γραμμή για τον τοίχο
			//Εκτύπωση γραμμής τοίχου
				$opaque_column1 .= $toixos_per.",";
				$opaque_column2 .= $wall["name"].",";
				$opaque_column3 .= $wall_g.",";
				$opaque_column4 .= $wall["b"].",";
				$opaque_column5 .= $wall_e_adiafanes.",";
				$opaque_column6 .= $u_sum.",";
				$opaque_column7 .= ",";
				$opaque_column8 .= $ap.",";
				$opaque_column9 .= $ek.",";
				$opaque_column10 .= $fhor_h.",";
				$opaque_column11 .= $fhor_c.",";
				$opaque_column12 .= $fov_h.",";
				$opaque_column13 .= $fov_c.",";
				$opaque_column14 .= $ffin_h.",";
				$opaque_column15 .= $ffin_c.",";
				$opaque_column16 .= ",";
			$count_opaque++;
			}else{//Δεν υπάρχει σύμπτυξη. 4 γραμμες (δρομικο, υπ, δοκ, συρ) ή 3 με % φέρων + συρόμενα
			//Εκτύπωση γραμμής τοίχου
				$opaque_column1 .= $toixos_per.",";
				$opaque_column2 .= $wall["name"].",";
				$opaque_column3 .= $wall_g.",";
				$opaque_column4 .= $wall["b"].",";
				$opaque_column5 .= $wall_e.",";
				$opaque_column6 .= $u.",";
				$opaque_column7 .= ",";
				$opaque_column8 .= $ap.",";
				$opaque_column9 .= $ek.",";
				$opaque_column10 .= $fhor_h.",";
				$opaque_column11 .= $fhor_c.",";
				$opaque_column12 .= $fov_h.",";
				$opaque_column13 .= $fov_c.",";
				$opaque_column14 .= $ffin_h.",";
				$opaque_column15 .= $ffin_c.",";
				$opaque_column16 .= ",";
				
				$count_opaque++;
				
				if($yp_e!=0){
					if($per!=0){
						$txt_ypost="[Φέρων-".$per."%]-";
					}else{
						$txt_ypost="Υποστηλώματα-";
					}
					//Εκτύπωση γραμμής υποστηλωμάτων ή φέρων
					$opaque_column1 .= $toixos_per.",";
					$opaque_column2 .= $txt_ypost.$wall["name"].",";
					$opaque_column3 .= $wall_g.",";
					$opaque_column4 .= $wall["b"].",";
					$opaque_column5 .= $yp_e.",";
					$opaque_column6 .= $yp_u.",";
					$opaque_column7 .= ",";
					$opaque_column8 .= $ap.",";
					$opaque_column9 .= $ek.",";
					$opaque_column10 .= $fhor_h.",";
					$opaque_column11 .= $fhor_c.",";
					$opaque_column12 .= $fov_h.",";
					$opaque_column13 .= $fov_c.",";
					$opaque_column14 .= $ffin_h.",";
					$opaque_column15 .= $ffin_c.",";
					$opaque_column16 .= ",";
				$count_opaque++;
				}
				
				if($dok_e!=0){
					if($per==0){//μόνο εάν δεν υπάρχει % φέρων
						//Εκτύπωση γραμμής δοκών
						$opaque_column1 .= $toixos_per.",";
						$opaque_column2 .= "Δοκοί-".$wall["name"].",";
						$opaque_column3 .= $wall_g.",";
						$opaque_column4 .= $wall["b"].",";
						$opaque_column5 .= $dok_e.",";
						$opaque_column6 .= $dok_u.",";
						$opaque_column7 .= ",";
						$opaque_column8 .= $ap.",";
						$opaque_column9 .= $ek.",";
						$opaque_column10 .= $fhor_h.",";
						$opaque_column11 .= $fhor_c.",";
						$opaque_column12 .= $fov_h.",";
						$opaque_column13 .= $fov_c.",";
						$opaque_column14 .= $ffin_h.",";
						$opaque_column15 .= $ffin_c.",";
						$opaque_column16 .= ",";
					$count_opaque++;
					}
				}
				
				if($syr_e!=0){
				//Εκτύπωση γραμμής συρομένων
				$opaque_column1 .= $toixos_per.",";
				$opaque_column2 .= "Με διάκενο-".$wall["name"].",";
				$opaque_column3 .= $wall_g.",";
				$opaque_column4 .= $wall["b"].",";
				$opaque_column5 .= $syr_e.",";
				$opaque_column6 .= $syr_u.",";
				$opaque_column7 .= ",";
				$opaque_column8 .= $ap.",";
				$opaque_column9 .= $ek.",";
				$opaque_column10 .= $fhor_h.",";
				$opaque_column11 .= $fhor_c.",";
				$opaque_column12 .= $fov_h.",";
				$opaque_column13 .= $fov_c.",";
				$opaque_column14 .= $ffin_h.",";
				$opaque_column15 .= $ffin_c.",";
				$opaque_column16 .= ",";
				
				$count_opaque++;
				}
				
			}//4 γραμμές τοίχου
		}//εάν ο τοίχος ανήκει στα αδιαφανή
		
		
		if($wall["type"]==1){ //ο τοίχος ανήκει σε έδαφος
			if($symptiksi==1){//1 γραμμή για τον τοίχο
				//Εκτύπωση γραμμής τοίχου
				$ground_column1 .= "Τοίχος,";
				$ground_column2 .= $wall["name"].",";
				$ground_column3 .= $wall_e_sum.",";
				$ground_column4 .= $u_sum.",";
				$ground_column5 .= $wall["z1"].",";
				$ground_column6 .= $wall["z2"].",";
				$ground_column7 .= ",";
				$ground_column8 .= ",";
			$count_ground++;
			}else{
			//Εκτύπωση γραμμής τοίχου
				$ground_column1 .= "Τοίχος,";
				$ground_column2 .= $wall["name"].",";
				$ground_column3 .= $wall_e.",";
				$ground_column4 .= $u.",";
				$ground_column5 .= $wall["z1"].",";
				$ground_column6 .= $wall["z2"].",";
				$ground_column7 .= ",";
				$ground_column8 .= ",";
			$count_ground++;
				
				if($yp_e!=0){
					if($per!=0){
						$txt_ypost="[Φέρων-".$per."%]-";
					}else{
						$txt_ypost="Υποστηλώματα-";
					}
				//Εκτύπωση γραμμής υποστηλωμάτων
				$ground_column1 .= "Τοίχος,";
				$ground_column2 .= $txt_ypost.$wall["name"].",";
				$ground_column3 .= $yp_e.",";
				$ground_column4 .= $yp_u.",";
				$ground_column5 .= $wall["z1"].",";
				$ground_column6 .= $wall["z2"].",";
				$ground_column7 .= ",";
				$ground_column8 .= ",";
				
				$count_ground++;
				}
				
				if($dok_e!=0){
					if($per==0){//μόνο εάν δεν υπάρχει % φέρων
					//Εκτύπωση γραμμής δοκών
					$ground_column1 .= "Τοίχος,";
					$ground_column2 .= "Δοκοί-".$wall["name"].",";
					$ground_column3 .= $dok_e.",";
					$ground_column4 .= $dok_u.",";
					$ground_column5 .= $wall["z1"].",";
					$ground_column6 .= $wall["z2"].",";
					$ground_column7 .= ",";
					$ground_column8 .= ",";
					
					$count_ground++;
					}
				}
				
				if($syr_e!=0){
				//Εκτύπωση γραμμής συρομένων
				$ground_column1 .= "Τοίχος,";
				$ground_column2 .= "Με διάκενο-".$wall["name"].",";
				$ground_column3 .= $syr_e.",";
				$ground_column4 .= $syr_u.",";
				$ground_column5 .= $wall["z1"].",";
				$ground_column6 .= $wall["z2"].",";
				$ground_column7 .= ",";
				$ground_column8 .= ",";
				
				$count_ground++;
				}
				
			}//4 γραμμές τοίχου
		}//ο τοίχος σε έδαφος
		
	}//για κάθε τοίχο
	
	
	//ΟΡΟΦΕΣ - 0 σε αέρα
	foreach($mthx_orofes as $orofi){
		
		$window_sume=0;
		//Παράθυρα
		$data_window = $database->select("meletes_mthx_diafani","*",array("roof_id"=>$orofi['id']) );
		foreach($data_window as $window){
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
			
			if($orofi["type"]==0){ //Οροφή σε αέρα
			
			if($window["u_id"]=="u_bytype" AND $window["type"]==0){//αδιαφανής πόρτα
				$opaque_column1 .= "Πόρτα,";
				$opaque_column2 .= $window_name.",";
				$opaque_column3 .= $orofi["g"].",";
				$opaque_column4 .= $orofi["b"].",";
				$opaque_column5 .= $window_e.",";
				$opaque_column6 .= $window_u.",";
				$opaque_column7 .= ",";
				$opaque_column8 .= $orofi_ap.",";
				$opaque_column9 .= $orofi_ek.",";
				$opaque_column10 .= $orofi["fhor_h"].",";
				$opaque_column11 .= $orofi["fhor_c"].",";
				$opaque_column12 .= $orofi["fov_h"].",";
				$opaque_column13 .= $orofi["fov_c"].",";
				$opaque_column14 .= $orofi["ffin_h"].",";
				$opaque_column15 .= $orofi["ffin_c"].",";
				$opaque_column16 .= $senaria_u_wins_cost.",";
				$count_opaque++;
			}else{//Καρτέλα - Διαφανή
				$transparent_column1 .= "Ανοιγόμενο κούφωμα,";
				$transparent_column2 .= $window_name.",";
				$transparent_column3 .= $orofi["g"].",";
				$transparent_column4 .= $orofi["b"].",";
				$transparent_column5 .= $window_e.",";
				$transparent_column6 .= $array_window_type[$window["type"]].",";
				$transparent_column7 .= $window_u.",";
				$transparent_column8 .= $window_gw.",";
				$transparent_column9 .= $orofi["fhor_h"].",";
				$transparent_column10 .= $orofi["fhor_c"].",";
				$transparent_column11 .= $orofi["fov_h"].",";
				$transparent_column12 .= $orofi["fov_c"].",";
				$transparent_column13 .= $orofi["ffin_h"].",";
				$transparent_column14 .= $orofi["ffin_c"].",";
				$transparent_column15 .= $senaria_u_wins_cost.",";
				$count_transparent++;
			}//Είναι διαφανές
			}//Οροφή σε αέρα
			
		}//Για κάθε παράθυρο οροφής
		
		$roof_e=0;
		$roof_e=$orofi["e"]-$window_sume;
		
		
		if($orofi["type"]==0){ //Οροφή σε αέρα
			$opaque_column1 .= "Οροφή,";
			$opaque_column2 .= $orofi["name"].",";
			$opaque_column3 .= $orofi["g"].",";
			$opaque_column4 .= $orofi["b"].",";
			$opaque_column5 .= $roof_e.",";
			if($orofi["u"]!=0){
				$orofi_u=$orofi["u"];
			}else{
				$orofi_u_data = $database->select("user_adiafani","u",array("id"=>$orofi["u_id"]) );
				$orofi_u=$orofi_u_data[0];
			}
			$opaque_column6 .= $orofi_u.",";
			$opaque_column7 .= ",";
				//α-ε
				$orofi_ap = $database->select("vivliothiki_adiafani_a","a",array("id"=>$orofi['ap']) );
				$orofi_ap=$orofi_ap[0];
				$orofi_ek = $database->select("vivliothiki_adiafani_e","e",array("id"=>$orofi['ek']) );
				$orofi_ek=$orofi_ek[0];
			$opaque_column8 .= $orofi_ap.",";
			$opaque_column9 .= $orofi_ek.",";
			$opaque_column10 .= $orofi["fhor_h"].",";
			$opaque_column11 .= $orofi["fhor_c"].",";
			$opaque_column12 .= $orofi["fov_h"].",";
			$opaque_column13 .= $orofi["fov_c"].",";
			$opaque_column14 .= $orofi["ffin_h"].",";
			$opaque_column15 .= $orofi["ffin_c"].",";
			$opaque_column16 .= ",";
			
			$count_opaque++;
		}//Οροφή σε αέρα
		
		if($orofi["type"]==1){//οροφή σε έδαφος
			//Εκτύπωση γραμμής οροφής σε έδαφος
			$ground_column1 .= "Δάπεδο - Οροφή,";
			$ground_column2 .= $orofi["name"].",";
			$ground_column3 .= $roof_e.",";
			$ground_column4 .= $orofi_u.",";
			$ground_column5 .= $orofi["z"].",";
			$ground_column6 .= ",";
			$ground_column7 .= $orofi["p"].",";
			$ground_column8 .= $senaria_u_roofs_cost.",";
			
			$count_ground++;
		}
	}
	
	
	//ΔΑΠΕΔΑ - 0 επί εδάφους, 1 σε πυλωτή
	foreach($mthx_dapeda as $dapedo){
		if($dapedo["u"]!=0){
			$dapedo_u=$dapedo["u"];
		}else{
			$dapedo_u_data = $database->select("user_adiafani","u",array("id"=>$dapedo["u_id"]) );
			$dapedo_u=$dapedo_u_data[0];
		}
		if($dapedo["type"]==0){//Δάπεδο σε έδαφος
			//Εκτύπωση δαπέδου στις γραμμές επαφής με έδαφος			
			$ground_column1 .= "Δάπεδο - Οροφή,";
			$ground_column2 .= $dapedo["name"].",";
			$ground_column3 .= $dapedo["e"].",";
			$ground_column4 .= $dapedo_u.",";
			$ground_column5 .= $dapedo["z"].",";
			$ground_column6 .= ",";
			$ground_column7 .= $dapedo["p"].",";;
			$ground_column8 .= ",";
		
		$count_ground++;
		}//Δάπεδο σε έδαφος
		
		if($dapedo["type"]==1){//Δάπεδο σε πυλωτή
		$dapedo_ap = $database->select("vivliothiki_adiafani_a","a",array("id"=>$dapedo['ap']) );
		$dapedo_ap=$dapedo_ap[0];
		$dapedo_ek = $database->select("vivliothiki_adiafani_e","e",array("id"=>$dapedo['ek']) );
		$dapedo_ek=$dapedo_ek[0];
			$opaque_column1 .= "Πυλωτή,";
			$opaque_column2 .= $dapedo["name"].",";
			$opaque_column3 .= "180,";
			$opaque_column4 .= "180,";
			$opaque_column5 .= $dapedo["e"].",";
			$opaque_column6 .= $dapedo_u.",";
			$opaque_column7 .= ",";
			$opaque_column8 .= $dapedo_ap."0,";
			$opaque_column9 .= $dapedo_ek."0,";
			$opaque_column10 .= $dapedo["fhor_h"]."0,";
			$opaque_column11 .= $dapedo["fhor_c"]."0,";
			$opaque_column12 .= $dapedo["fov_h"]."0,";
			$opaque_column13 .= $dapedo["fov_c"]."0,";
			$opaque_column14 .= $dapedo["ffin_h"]."0,";
			$opaque_column15 .= $dapedo["ffin_c"]."0,";
			$opaque_column16 .= ",";
		
		$count_opaque++;
		}//Δάπεδο σε πυλωτή
			
	}//Για κάθε δάπεδο
	
	//UNHEATED
	if($mthxs["type"]==0){
		//ΜΘΧ
		$mthx = $domtree->createElement("UNHEATED".$num_mthx);
		$mthx = $building->appendChild($mthx);
		$mthx->setAttribute('rid', $rid);
		
		//Γενικά στοιχεία ΜΘΧ
		$mthx->appendChild($domtree->createElement('un_parameter1',$mthx_e));//Εμβαδόν ΜΘΧ
		$mthx->appendChild($domtree->createElement('un_parameter2',$mthx_air));//αερισμός
			
		$num_mthx++;
	}
	//UNHEATED
	
	//SOLAR
	if($mthxs["type"]==1){
		//ΜΘΧ
		$mthx = $domtree->createElement("SOLAR".$num_solar);
		$mthx = $building->appendChild($mthx);
		$mthx->setAttribute('rid', $rid);
		
		//Γενικά στοιχεία ΜΘΧ
		$mthx->appendChild($domtree->createElement('sl_parameter1',$mthx_e));//Εμβαδόν ηλιακού χώρου
		$mthx->appendChild($domtree->createElement('sl_parameter2',$mthx_air));//αερισμός
			
		$num_solar++;
	}
	//SOLAR
	
	
	//Κέλυφος
	$envelope = $domtree->createElement("ENVELOPE");
    $envelope = $mthx->appendChild($envelope);
	$envelope->setAttribute('rid', $rid);
	
	//Στοιχεία αδιαφανών
		$envelope->appendChild($domtree->createElement('opaque_rows',$count_opaque));//αριθμός γραμμων
	for($i=1;$i<=16;$i++){
		$envelope->appendChild($domtree->createElement('opaque_column'.$i,${"opaque_column".$i}));
	}
	
	//Στοιχεία εδάφους
	$envelope->appendChild($domtree->createElement('ground_rows',$count_ground));
	for($i=1;$i<=8;$i++){
		$envelope->appendChild($domtree->createElement('ground_column'.$i,${"ground_column".$i}));
	}
	
	//Στοιχεία διαφανών
	$envelope->appendChild($domtree->createElement('transparent_rows',$count_transparent));
	for($i=1;$i<=15;$i++){
		$envelope->appendChild($domtree->createElement('transparent_column'.$i,${"transparent_column".$i}));
	}
	
	$envelope->appendChild($domtree->createElement('opaque_tb_rows',''));
	$envelope->appendChild($domtree->createElement('opaque_tb_column1',''));
	$envelope->appendChild($domtree->createElement('opaque_tb_column2',''));
	$envelope->appendChild($domtree->createElement('opaque_tb_column3',''));
	
	
	}//Για κάθε ΜΘΧ - Για κάθε Ηλιακό χώρο - SOLAR
	//ΤΕΛΟΣ ΠΡΟΣΘΗΚΗΣ ΣΤΟ DOMTREE
	
		}//Εάν είναι σενάριο και εάν το σενάριο είναι ενεργό (να εκτελείται).
	$rid++;
	}//Για το υπάρχον και 3 σενάρια
	//##################### ΤΕΛΟΣ ΚΤΙΡΙΟΥ ###########################
	
	//Αποθήκευση αρχείου σε xml
	$path = "file_upload/server/php/files/user_".$_SESSION["user_id"]."/meleti_".$_SESSION["meleti_id"]."/";
	$filename = "u".$_SESSION["user_id"]."_m".$_SESSION["meleti_id"]."_xml_teekenak.xml";
	$domtree->save($path.$filename);
	
	$txt = "";
	$txt .= "<div class=\"row\">";
	$txt .= "<div class=\"col-md-2\">";
	$txt .= "<a href=\"includes/".$path.$filename."\" download><i class=\"fa fa-download\"></i> Κατέβασμα</a>";
	$txt .= "</div>";
	$txt .= "<div class=\"col-md-2\">";
	$txt .= "<a href=\"includes/filemanager/\"><i class=\"fa fa-folder\"></i> Τα αρχεία μου</a>";
	$txt .= "</div>";
	$txt .= "<div class=\"col-md-2\">";
	$txt .= "<a href=\"includes/".$path.$filename."\"><i class=\"fa fa-eye\"></i> Δείτε το xml</a>";
	$txt .= "</div>";
	$txt .= "</div>";
	
	return $txt;

}
?>