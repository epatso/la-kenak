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
if (isset($_GET['teyxos_img_u'])){
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$img = teyxos_img_u($id);
	echo $img;
	exit;
}

if (isset($_GET['teyxos_img_wall'])){
	$id = $_GET['id'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$img = teyxos_img_wall($id);
	echo $img;
	exit;
}


require("include_check.php");


//Δημιουργία κειμένου για ΚΕΦ5 (Συστήματα που χρησιμοποιούνται στο κτίριο: Θέρμανση)
function teyxos_kef5_therm(){
	$database = new medoo(DB_NAME);
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$tb_zones = "meletes_zones";
	$tb_zones_thermp = "meletes_zone_sys_thermp";
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$array_type=array(
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
	
	$thermp_type="";
	$thermp_pigi="";
	$thermp_n="";
	$thermp_cop="";
	$thermp_kw="";
	$thermp_kcal="";
	
	foreach($select_zones as $zone){
		$thermp_type .= "(Ζώνη:".$zone["name"].": ";
		$thermp_pigi .= "(Ζώνη:".$zone["name"].": ";
		$thermp_n .= "(Ζώνη:".$zone["name"].": ";
		$thermp_cop .= "(Ζώνη:".$zone["name"].": ";
		$thermp_kw .= "(Ζώνη:".$zone["name"].": ";
		$thermp_kcal .= "(Ζώνη:".$zone["name"].": ";
		$select_thermp = $database->select($tb_zones_thermp, $col, array("zone_id"=>$zone["id"]));
		foreach($select_thermp as $thermp){
			$thermp_type .= $array_type[$thermp["type"]].",";
			$thermp_pigi .= $array_pigi[$thermp["pigi"]].",";
			$thermp_n .= $thermp["n"].",";
			$thermp_cop .= $thermp["cop"].",";
			$thermp_kw .= $thermp["w"].",";
			$thermp_kcal= round($thermp_kw*859.845).",";
		}
		$thermp_type .= ") ";
		$thermp_pigi .= ") ";
		$thermp_n .= ") ";
		$thermp_cop .= ") ";
		$thermp_kw .= ") ";
		$thermp_kcal .= ") ";
	}
	return array($thermp_type,$thermp_pigi,$thermp_n,$thermp_cop,$thermp_kw,$thermp_kcal);
}

//Δημιουργία κειμένου για ΚΕΦ5 (Συστήματα που χρησιμοποιούνται στο κτίριο: ΨΥΞΗ)
function teyxos_kef5_cold(){
	$database = new medoo(DB_NAME);
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$tb_zones = "meletes_zones";
	$tb_zones_coldp = "meletes_zone_sys_coldp";
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$array_type = array(
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
	
	$cold_type="";
	$cold_pigi="";
	$cold_n="";
	$cold_eer="";
	$cold_kw="";
	$cold_btu="";
	
	foreach($select_zones as $zone){
		$cold_type .= "(Ζώνη:".$zone["name"].": ";
		$cold_pigi .= "(Ζώνη:".$zone["name"].": ";
		$cold_n .= "(Ζώνη:".$zone["name"].": ";
		$cold_eer .= "(Ζώνη:".$zone["name"].": ";
		$cold_kw .= "(Ζώνη:".$zone["name"].": ";
		$cold_btu .= "(Ζώνη:".$zone["name"].": ";
		$select_coldp = $database->select($tb_zones_coldp, $col, array("zone_id"=>$zone["id"]));
		foreach($select_coldp as $coldp){
			$cold_type .= $array_type[$coldp["type"]].",";
			$cold_pigi .= $array_pigi[$coldp["pigi"]].",";
			$cold_n .= $coldp["n"].",";
			$cold_eer .= $coldp["eer"].",";
			$cold_kw .= $coldp["w"].",";
			$cold_btu= round($cold_kw*3412.142).",";
		}
		$cold_type .= ") ";
		$cold_pigi .= ") ";
		$cold_n .= ") ";
		$cold_eer .= ") ";
		$cold_kw .= ") ";
		$cold_btu .= ") ";
	}
	return array($cold_type,$cold_pigi,$cold_n,$cold_eer,$cold_kw,$cold_btu);
}

//Δημιουργία κειμένου για ΚΕΦ5 (Συστήματα που χρησιμοποιούνται στο κτίριο: ΗΛΙΑΚΟΣ)
function teyxos_kef5_solar(){
	$database = new medoo(DB_NAME);
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$tb_zones = "meletes_zones";
	$tb_zones_solar = "meletes_zone_sys_solar";
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$solar_b="";
	$solar_g="";
	$solar_e="";
	$solar_syna="";
	
	foreach($select_zones as $zone){
		$solar_b .= "(Ζώνη:".$zone["name"].": ";
		$solar_g .= "(Ζώνη:".$zone["name"].": ";
		$solar_e .= "(Ζώνη:".$zone["name"].": ";
		$solar_syna .= "(Ζώνη:".$zone["name"].": ";
		$select_solar = $database->select($tb_zones_solar, $col, array("zone_id"=>$zone["id"]));
		foreach($select_solar as $solar){
			$solar_b .= $solar["b"].",";
			$solar_g .= $solar["g"].",";
			$solar_e .= $solar["e"].",";
			$solar_syna .= $solar["syna"].",";
		}
		$solar_b .= ") ";
		$solar_g .= ") ";
		$solar_e .= ") ";
		$solar_syna .= ") ";
		
	}
	return array($solar_b,$solar_g,$solar_e,$solar_syna);
}

//Δημιουργία κειμένου για ΚΕΦ5 (Συστήματα που χρησιμοποιούνται στο κτίριο: ΖΝΧ)
function teyxos_kef5_znx(){
	$database = new medoo(DB_NAME);
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$tb_zones = "meletes_zones";
	$tb_zones_znxp = "meletes_zone_sys_znxp";
	$tb_zones_znxt = "meletes_zone_sys_znxt";
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$t_znx=45;
	$array_type = array(
		0=>"Λέβητας",
		1=>"Τηλεθέρμανση",
		2=>"ΣΗΘ",
		3=>"Αντλία θερμότητας (Α.Θ.)",
		4=>"Τοπικός ηλεκτρικός θερμαντήρας",
		5=>"Τοπική μονάδα φυσικού αερίου",
		6=>"Μονάδα παραγωγής (κεντρική) άλλου τύπου"
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
	
	$znx_type="";
	$znx_pigi="";
	$znx_znxm3m2="";
	$znx_vd="";
	$znx_vstore="";
	$znx_qd="";
	$znx_boiler="";
	$znx_pnkw="";
	$znx_pnkw13="";
	$znx_pnkcal="";
	
	foreach($select_zones as $zone){
		//Άνοιγμα παρενθέσεων
		$znx_type .= "(Ζώνη:".$zone["name"].": ";
		$znx_pigi .= "(Ζώνη:".$zone["name"].": ";
		$znx_znxm3m2 .= "(Ζώνη:".$zone["name"].": ";
		$znx_vd .= "(Ζώνη:".$zone["name"].": ";
		$znx_vstore .= "(Ζώνη:".$zone["name"].": ";
		$znx_qd .= "(Ζώνη:".$zone["name"].": ";
		$znx_boiler .= "(Ζώνη:".$zone["name"].": ";
		$znx_pnkw .= "(Ζώνη:".$zone["name"].": ";
		$znx_pnkw13 .= "(Ζώνη:".$zone["name"].": ";
		$znx_pnkcal .= "(Ζώνη:".$zone["name"].": ";
	
		//μονάδα παραγωγής και πηγή ενέργειας
		$select_znxp = $database->select($tb_zones_znxp, $col, array("zone_id"=>$zone["id"]));
		foreach($select_znxp as $znxp){
			$znx_type .= $array_type[$znxp["type"]].", ";
			$znx_pigi .= $array_pigi[$znxp["pigi"]].", ";
		}
		
		//Συντελεστές ΖΝΧ
		$zone_e=teyxos_zone_ev($zone["id"]);
		$zone_e=$zone_e[0];
		$data_conditions = $database->select("vivliothiki_conditions","*",array("id"=>$zone["xrisi"]) );
		
		$xrisi=$zone["xrisi"];
	
		$znx_m2 = ($data_conditions[0]["atoma"]*$zone_e/100) * $data_conditions[0]["znx_l_p_d"]; //υπολογισμός με m2 και άτομα/100m2 σε lt/d
		$znx_klines = round(($data_conditions[0]["znx_m3_sq_y"]*$zone["klines"]) * (1000/365),2); //Υπολογισμός με κλίνες και m3/y και μετατροπή σε lt/d
		
		if($xrisi>=1 && $xrisi<=17){$hkznx = $znx_klines;$znx_znxm3m2 .= $data_conditions[0]["znx_m3_sq_y"]."m3/m2/y, ";}
		if($xrisi>=18 && $xrisi<=33){$hkznx = $znx_m2;$znx_znxm3m2 .= $data_conditions[0]["znx_l_p_d"]."lt/m2/ημέρα, ";}
		if($xrisi>=34 && $xrisi<=40){$hkznx = $znx_klines;$znx_znxm3m2 .= $data_conditions[0]["znx_m3_sq_y"]."m3/m2/y, ";}
		if($xrisi==41){$hkznx = $znx_m2;$znx_znxm3m2 .= $data_conditions[0]["znx_l_p_d"]."lt/m2/ημέρα, ";}
		if($xrisi==42){$hkznx = $znx_klines;$znx_znxm3m2 .= $data_conditions[0]["znx_m3_sq_y"]."m3/m2/y, ";}
		if($xrisi>=42){$hkznx = $znx_m2;$znx_znxm3m2 .= $data_conditions[0]["znx_l_p_d"]."lt/m2/ημέρα, ";}
		
		$znx_vd .= $hkznx.", ";
		$vstore=$hkznx/5;
		$znx_vstore .= $vstore.", ";
		
		$where_meleti=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
		$climatezone = $database->select("user_meletes","zone",$where_meleti);
		$climatezone=$select_place[0];
		if($climatezone==0){$dt=$t_znx-12.8;}
		if($climatezone==1){$dt=$t_znx-10.1;}
		if($climatezone==2){$dt=$t_znx-6.5;}
		if($climatezone==1){$dt=$t_znx-4.2;}
		$qd=($hkznx*0.998*4.18*$dt)/3600;
		$znx_qd .= $qd;
		

		//boiler - επιλογή
		$count_boilers=$database->count($tb_zones_znxt, array("zone_id"=>$zone["id"]));
		if($count_boilers>0){
			$select_znxt = $database->select($tb_zones_znxt, $col, array("zone_id"=>$zone["id"]));
		}
		if($select_znxt[0]["type"]>0){
			$znx_boiler.=$select_znxt[0]["type"].", ";
		}else{
			$znx_boiler.="160, ";
		}

		$pn=$qd/5;
		$pn13=$pn*1.3;
		$znx_pnkw .= $pn.", ";
		$znx_pnkw13 .= $pn13.", ";
		$znx_pnkcal .= round(($pn*859.845),0).", ";
		
		//κλείσιμο παρενθέσεων
		$znx_type .= ") ";
		$znx_pigi .= ") ";
		$znx_znxm3m2.=") ";
		$znx_vd.=") ";
		$znx_vstore.=") ";
		$znx_qd.=") ";
		$znx_boiler.=") ";
		$znx_pnkw.=") ";
		$znx_pnkw13.=") ";
		$znx_pnkcal.=") ";
	}
	return array($znx_type,$znx_pigi,$znx_znxm3m2,$znx_vd,$znx_vstore,$znx_qd,$znx_boiler,$znx_pnkw,$znx_pnkw13,$znx_pnkcal);
}

//Δημιουργία εικόνας από υπολογισμό u
function teyxos_img_u($id){
	
$url="../images/hatch/";
$ha =array(
	0=>$url."blank.png",
	1=>$url."bricks.png",
	2=>$url."sand.png",
	3=>$url."insul.png",
	4=>$url."concr.png",
	5=>$url."metal.png",
	6=>$url."wood.png",
	7=>$url."stone.png",
	8=>$url."tile.png",
	9=>$url."keramidia.png",
	10=>$url."concrete.png",
	11=>$url."extruded_polystyrene.png",
	12=>$url."petrovamvakas.png",
	13=>$url."polyourethani.png",
	14=>$url."granitis.png",
	15=>$url."granitis1.png",
	16=>$url."wood1.png",
	17=>$url."dirt.png"
	);

	$database = new medoo(DB_NAME);
	$table = "user_adiafani";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$id));
	$data = $database->select($table, $col, $where );
	$data=$data[0];
	
//EIKONA
//Array τιμών
$values = array();
// Θέσε το πλάτος και μήκος της εικόνας σε pixels
$width = 800;
$height = 300; 
$im = ImageCreateTrueColor($width, $height); 
if (function_exists('imageantialias')){ImageAntiAlias($im, true);}

//Χρώματα
$white = ImageColorAllocate($im, 255, 255, 255); 
$black = ImageColorAllocate($im, 0, 0, 0);
$blue = ImageColorAllocate($im, 0, 0, 255);
$grey = imagecolorallocate($im, 62, 62, 62);
$magenda = imagecolorallocate($im, 174, 49, 194);
$roz = imagecolorallocate($im, 103, 16, 81);
$font = './verdana.ttf';
ImageFillToBorder($im, 0, 0, $black, $black);
imagefilledrectangle ($im,1,1,$width-2,$height-2,$white);

$l=50;
$c=30;
$tl=60;
$linev = @imagecreatefromjpeg('../images/domika/lineV.jpg');
	
	$category=explode("|",$data["category"]);
	$subcategory=explode("|",$data["subcategory"]);
	$strwsi=explode("|",$data["strwsi"]);
	$paxos=explode("|",$data["paxos"]);
	$rira=$data["rira"];
	
	for($i=1;$i<=10;$i++){
		$tl += $yliko_paxos*500;
		if($paxos[$i-1]!=""){
		
		$yliko_paxos=$paxos[$i-1];
		
		$l += $yliko_paxos*500;
		
		$hatch = $ha[$category[$i-1]];
		$imagebg = imageCreateFromPNG ($hatch);
		imageSetTile ($im, $imagebg);
		$values[0]=$l-$yliko_paxos*500;
		$values[1]=250;
		$values[2]=$l;
		$values[3]=250;
		$values[4]=$l;
		$values[5]=50;
		$values[6]=$l-$yliko_paxos*500;
		$values[7]=50;
		imagefilledpolygon($im, $values, 4, IMG_COLOR_TILED);
		imagepolygon($im, $values, 4, $black);
		imagedestroy ($imagebg);
		
		}
	}
	
	$l=50;
	imagecopyresized($im, $linev, $l, 50, 0, 0, 1, 200,1,200);
	
	for($i=1;$i<=10;$i++){
		if($paxos[$i-1]!=""){
			$id_yliko=$strwsi[$i-1];
			if($category[$i-1]>0 AND $category[$i-1]<9 ){
				$tb_ylika = "vivliothiki_domika";
				$where_yliko = array(
					"AND"=>array(
						"category"=>$category[$i-1],
						"subcategory"=>$subcategory[$i-1]
					)	
				);
			}else{
				$tb_ylika = "user_domika";
				$where_yliko = array(
						"user_id"=>$_SESSION['user_id'],
				);
			}
		$yliko = $database->select($tb_ylika,$col,$where_yliko);
		
		$yliko_name=$yliko[$id_yliko-1]["material"];
		$yliko_l=$yliko[$id_yliko-1]["l"];
		$yliko_paxos=$paxos[$i-1];
		
		$l += $yliko_paxos*500;
		$tl += $yliko_paxos*250;
		$c += 30;
		$src = @imagecreatefrompng('../images/domika/pointerH.png');
		imagecopyresized($im, $src, $l-$yliko_paxos*250, $c, 0, 0, 300, 5,300,5);
		imagecopyresized($im, $linev, $l, 50, 0, 0, 1, 200,1,200);
		ImageDestroy($src);
		$text=$i.". ".$yliko_name.", d=".number_format($yliko_paxos*100,1,".",",")."cm". ", λ=".number_format($yliko_l,3,".",",");
		imagefttext($im, 10, 0, $tl, $c, $black, $font, $text);
		}
	}
	imagefttext($im, 12, 90, 30, 250, $black, $font, "ΜΕΣΑ");
	if ($rira==1) $x="ΕΞΩ";
	if ($rira==2) $x="ΜΘΧ";
	if ($rira==3) $x="ΕΔΑΦΟΣ";
	imagefttext($im, 12, 90, $l+30, 250, $black, $font, $x);
	
$path = "file_upload/server/php/files/user_".$_SESSION["user_id"]."/meleti_".$_SESSION["meleti_id"]."/adiafaniu_user".$_SESSION['user_id']."_uid".$id.".png";	
	$create=imagepng ($im,$path);
	ImageDestroy($im);
	ImageDestroy($linev);
	$img="<img src=\"".APPLICATION_FOLDER."includes/".$path."\"></img>";
	
	return $img;
	
}


//Δημιουργία εικόνας για τοίχο
function teyxos_img_wall($id){
	//confirm_logged_in();
	
	$hatch1=APPLICATION_FOLDER.'images/hatch/brick3.png';
	$hatch2=APPLICATION_FOLDER.'images/hatch/concrete2.png';
	$hatch3=APPLICATION_FOLDER.'images/hatch/tile.png';
	$hatch4=APPLICATION_FOLDER.'images/hatch/glass.png';
	$hatch5=APPLICATION_FOLDER.'images/hatch/granitis.png';
	$font = APPLICATION_FOLDER.'verdana.ttf';
	if(file_exists('verdana.ttf')){
		$font = 'verdana.ttf';
	}else{
		$font = 'includes/verdana.ttf';
	}
	$table_wall="meletes_zone_adiafani";
	$table_window="meletes_zone_diafani";
	$database = new medoo(DB_NAME);
	$data_wall = $database->select($table_wall,"*",array("id"=>$id));
	$l=$data_wall[0]["l"]*100;
	$h=$data_wall[0]["h"]*100;
	$d=$data_wall[0]["d"]*100;
	$dy=$data_wall[0]["dy"]*100;
	$dx=$data_wall[0]["dx"]*100;
	$epafi=$data_wall[0]["type"];
	
	$yp_txt=$data_wall[0]["yp"];
	$dok_txt=$data_wall[0]["dok"];
	$syr_txt=$data_wall[0]["syr"];
	
	$name=$data_wall[0]["name"];
	
	$dW = $l;
    $dH = $h+$dy;
	$values = array();
	$image = imageCreateTrueColor ($dW, $dH+100);//100 είναι το μαύρο κενό κάτω
	$imagebg = imageCreateFromPNG ($hatch1); 
	$bg   = imagecolorallocate($image, 255, 255, 255);
	$fg = imagecolorallocate($image, 0, 0, 0);
	$grey = imagecolorallocate($image, 62, 62, 62);
	$magenda = imagecolorallocate($image, 103, 16, 81);
	
	//ορθογώνιος τοίχος
	imagefilledrectangle($image, 0, 0, $dW, $dH, $bg);
	imageSetTile ($image, $imagebg);
	$values[0]=0;
	$values[1]=$dy;
	$values[2]=$l;
	$values[3]=$dy;
	$values[4]=$l;
	$values[5]=$dH;
	$values[6]=0;
	$values[7]=$dH;
	imagefilledpolygon($image, $values, 4, IMG_COLOR_TILED);
	imagepolygon($image, $values, 4, $fg);
	
	
	imagedestroy ($imagebg);
	$imagebg = imageCreateFromPNG ($hatch2);
	imageSetTile ($image, $imagebg);
	
	//δοκοί
	$dok = explode("^",$dok_txt);
	for($i=0;$i<count($dok)-1;$i++){
	
		$dok_values = explode("|",$dok[$i]);
		
		$values[0]=0;
		$values[1]=$dok_values[1]*100+$dy;
		$values[2]=0;
		$values[3]=$dok_values[1]*100+$dok_values[0]*100+$dy;
		$values[4]=$l;
		$values[5]=$dok_values[1]*100+$dok_values[0]*100+$dy;
		$values[6]=$l;
		$values[7]=$dok_values[1]*100+$dy;
		imagefilledpolygon($image, $values, 4, IMG_COLOR_TILED);
		//imagepolygon($image, $values, 4, $fg);
	}
	
	//υποστυλώματα
	$yp = explode("^",$yp_txt);
	for($i=0;$i<count($yp)-1;$i++){
	
		$yp_values = explode("|",$yp[$i]);
		
		$values[0]=$yp_values[1]*100;
		$values[1]=$dy;
		$values[2]=$yp_values[1]*100+$yp_values[0]*100;
		$values[3]=$dy;
		$values[4]=$yp_values[1]*100+$yp_values[0]*100;
		$values[5]=$dH;
		$values[6]=$yp_values[1]*100;
		$values[7]=$dH;
		imagefilledpolygon($image, $values, 4, IMG_COLOR_TILED);
		//imagepolygon($image, $values, 4, $fg);
	}
	
	$style = array($bg, $bg, $bg, $bg, $bg, $fg, $fg, $fg, $fg, $fg);
	imagesetstyle($image, $style);
	
	//συρόμενα
	$syr = explode("^",$syr_txt);
	for($i=0;$i<count($syr)-1;$i++){
	
		$syr_values = explode("|",$syr[$i]);
		
		$values[0]=$syr_values[3]*100;
		$values[1]=$h-$syr_values[2]*100+$dy;
		$values[2]=$syr_values[3]*100;
		$values[3]=$h-$syr_values[2]*100-$syr_values[1]*100+$dy;
		$values[4]=$syr_values[3]*100+$syr_values[0]*100;
		$values[5]=$h-$syr_values[2]*100-$syr_values[1]*100+$dy;
		$values[6]=$syr_values[3]*100+$syr_values[0]*100;
		$values[7]=$h-$syr_values[2]*100+$dy;
		//imagefilledpolygon($image, $values, 4, IMG_COLOR_TILED);
		imagepolygon($image, $values, 4, IMG_COLOR_STYLED);
	}
	
	//τρίγωνο πάνω από τοίχο εάν υπάρχει
	$imagebg = imageCreateFromPNG ($hatch1);
	//imagefilledrectangle($image, 0, 0, $dW, $dH, $bg);
	imageSetTile ($image, $imagebg);
	$values[0]=0;
	$values[1]=$dy;
	$values[2]=$dx;
	$values[3]=0;
	$values[4]=$l;
	$values[5]=$dy;
	$values[6]=0;
	$values[7]=$dy;
	imagefilledpolygon($image, $values, 4, IMG_COLOR_TILED);
	imagepolygon($image, $values, 4, $fg);
	
	
	//Παράθυρα
	$data_window = $database->select($table_window,"*",array("wall_id"=>$id) );
		foreach($data_window as $window){
		$wname=$window["name"];
		$ww=$window["w"]*100;
		$wh=$window["h"]*100;
		$wp=$window["p"]*100;
		$apoar=$window["apoar"]*100;
		
		
		$values[0]=$apoar;
		$values[1]=$dH-$wh-$wp;
		$values[2]=$apoar+$ww;
		$values[3]=$dH-$wh-$wp;
		$values[4]=$apoar+$ww;
		$values[5]=$dH-$wp;
		$values[6]=$apoar;
		$values[7]=$dH-$wp;
		
		$imagebg = imageCreateFromPNG ($hatch4);
		imageSetTile ($image, $imagebg);
		imagefilledpolygon($image, $values, 4, IMG_COLOR_TILED);
		$imagebg = imageCreateFromPNG ($hatch5);
		imageSetTile ($image, $imagebg);
		imagepolygon($image, $values, 4, IMG_COLOR_TILED);
		
		imagefttext($image, 8, 0, $apoar+10, $dH-$wh-$wp+15, $magenda, $font, $wname);
		imagefttext($image, 8, 0, $apoar+10, $dH-$wh-$wp+30, $magenda, $font, "Μήκος:".$ww/100);
		imagefttext($image, 8, 0, $apoar+10, $dH-$wh-$wp+45, $magenda, $font, "Ύψος:".$wh/100);
		imagefttext($image, 8, 0, $apoar+10, $dH-$wh-$wp+60, $magenda, $font, "Ποδιά:".$wp/100);
		
		}
	
	//Ονομασίες
	//μήκος
	imagefttext($image, 12, 0, $l/2, $dH-5, $magenda, $font, $l/100);
	imageline ($image, 0, $dH-10, ($l/2)-20, $dH-10, $magenda);
	imageline ($image, ($l/2)+20, $dH-10, $dW, $dH-10, $magenda);
	//ύψος ορθογωνίου
	imagefttext($image, 12, 90, $l-5, $dy+$h/2, $magenda, $font, $h/100);
	imageline ($image, $l-5, $dy, $l-5, $dy+$h/2-10, $magenda);
	imageline ($image, $l-5, $dy+$h/2+10, $l-5, $dH, $magenda);
	//ύψος σκεπής
	imagefttext($image, 12, 90, $l-5, $dy/2, $magenda, $font, $dy/100);
	imageline ($image, $l-5, 0, $l-5, $dy/2-10, $magenda);
	imageline ($image, $l-5, $dy/2+10, $l-5, $dy, $magenda);
	
	//απόσταση από αριστερό άκρο σκεπής (αριστερά)
	imagefttext($image, 12, 0, $dx/2, 15, $magenda, $font, $dx/100);
	imageline ($image, 0, 15, $dx/2-10, 15, $magenda);
	imageline ($image, $dx/2+10, 15, $dx, 15, $magenda);
	
	//απόσταση από αριστερό άκρο σκεπής (δεξιά)
	imagefttext($image, 12, 0, $dx+($l-$dx)/2, 15, $magenda, $font, ($l-$dx)/100);
	imageline ($image, $dx, 15, $dx+($l-$dx)/2-10, 15, $magenda);
	imageline ($image, $dx+($l-$dx)/2+10, 15, $l, 15, $magenda);
	
	//Επαφή με:
	if($epafi==0){$epafi="Σε αέρα";}
	if($epafi==1){$epafi="Σε ΜΘΧ";}
	if($epafi==2){$epafi="Σε έδαφος";}
	if($epafi==3){$epafi="Μεσοτοιχία";}
	imagefttext($image, 11, 0, 15, $dH+18, $grey, $font, "Ονομασία:".$name);
	imagefttext($image, 11, 0, 15, $dH+36, $grey, $font, "Επαφή:".$epafi);
	imagefttext($image, 11, 0, 15, $dH+54, $grey, $font, "Μήκος:".$l/100);
	imagefttext($image, 11, 0, 15, $dH+72, $grey, $font, "Ύψος:".$h/100);
	imagefttext($image, 11, 0, 15, $dH+90, $grey, $font, "Ύψος πάνω από τοίχο:".$dy/100);
	
	
	$path = "file_upload/server/php/files/user_".$_SESSION["user_id"]."/meleti_".$_SESSION["meleti_id"]."/";
	
	if(file_exists($path)){
		$path=$path;
		$path_tag="includes/".$path;
	}else{
		$path="includes/".$path;
		$path_tag=$path;
	}
	$file = "wallid_".$id.".png";
	
	$create=imagepng ($image,$path.$file);
	ImageDestroy($image);
	$img="<img style=\"height: 300px;\" src=\"".APPLICATION_FOLDER.$path_tag.$file."\"></img>";
	
	return $img;
	
}


//Επιστροφή εμβαδού και όγκου ζώνης
function teyxos_zone_ev($id){
	$database = new medoo(DB_NAME);
	$tb_xwroi = "meletes_xwroi";
	$col = "*";
	$zone_e = 0;
	$zone_v = 0;
	
	$select_xwroi = $database->select($tb_xwroi, $col, array("zone_id"=>$id));
	foreach($select_xwroi as $xwroi){
		if($xwroi["type"]==0){//Μετράει και εμβαδόν και όγκος
			$xwros_e = $xwroi["l"]*$xwroi["w"];
			$xwros_v = $xwros_e*$xwroi["h"];
		}else{//Μετράει μόνο όγκος (4κλινής σκεπή)
			$xwros_e=0;
			$xwros_v=(1/6)*$xwroi["w"]*$xwroi["h"]*(2*$xwroi["w"]+3*($xwroi["l"]-$xwroi["w"]));
		}
	$zone_e += $xwros_e;
	$zone_v += $xwros_v;
	}
	return array($zone_e,$zone_v);
}


//Επιστροφή πίνακα καμπυλών f
//$ac : επιφάνεια συλλέκτη
//$place : το όνομα από τον πίνακα κλιματικών δεδομένων
//$xrisi : Χρήση κτιρίου
//$zone_synt : Εμβαδόν ζώνης ή κλίνες ζώνης
//$deg , $pros : προσανατολισμός, κλίση
//$xrisi_syl = χρήση συλλέκτη, 1-ΖΝΧ, 2-Θέρμανση
//$t : θερμοκρασία
//$m : μέγεθος μποιλερ (το τραβάει από συστήματα ΤΥΠΟΣ ΒΟΗΘΗΤΙΚΗΣ ΑΝ >0
//$b και $g (τα τραβάει από συστήματα ΗΛΙΑΚΟΣ) Χρειάζεται επικαιροποίηση - στον υπολογισμό αναφέρεται αλλά υπολογίζεται για τη βέλτιστη γ=180 και β=45
//$fr , $ul , $fr , $type , $tan : χαρακτηριστικά συλλέκτη
function teyxos_fcharts($place="Άργος (Πυργέλα)", $xrisi, $klines=1, $zone_e=100, $g=180, $b=45, $t_znx=45, $ac=1, $m=160, $solar_type=1){
	
	//require_once("functions_math");
	$ennalaktis=0;
	$nmonths = array(0,"Ιαν","Φεβ","Μαρ","Απρ","Μαι","Ιουν","Ιούλ","Αυγ","Σεπ","Οκτ","Νοε","Δεκ");
	$nmonths_en = array(0,"jan","feb","mar","apr","may","jun","jul","aug","sep","okt","nov","dec");
	$ndays = array(0,31,28,31,30,31,30,31,31,30,31,30,31);
	$water_r=1;//Πυκνότητα νερού
	$water_cp=4.19;//Ειδική θερμότητα νερού
	$t_anaf=100;
	if($m==0){$m=75;}
	$k1=pow((75/$m),0.25);
	
	$database = new medoo(DB_NAME);
	
	if($solar_type==1){
		$frtan = 0.82;
		$frul = 7.5;
		for($i=1;$i<=12;$i++){
			$data_tatan = $database->select("vivliothiki_solarta_single",$b,array("id"=>$i) );
			${"tatan".$i} = $data_tatan[0];
		}
	}
	
	if($solar_type==2){
		$frtan = 0.75;
		$frul = 5;
		for($i=1;$i<=12;$i++){
			$data_tatan = $database->select("vivliothiki_solarta_double",$b,array("id"=>$i) );
			${"tatan".$i} = $data_tatan[0];
		}
	}
	
	if($solar_type==3){
		$frtan = 0.57;
		$frul = 1.82;
		for($i=0;$i<=11;$i++){
			${"tatan".$i}=0.99;
		}
	}
	
	if($solar_type==4){
		$frtan = 0.86;
		$frul = 21.5;
		for($i=0;$i<=11;$i++){
			${"tatan".$i}=0.99;
		}
	}
	
	if($ennalaktis==0){$frfr = 1;}
	if($ennalaktis==1){$frfr = 0.85;}
	
	
	//Υπολογισμός κατανάλωσης ζεστού νερού με βάση τη χρήση κτιρίου
	//$xrisi=intval($xrisi);
	$data_conditions = $database->select("vivliothiki_conditions","*",array("id"=>$xrisi) );
	
	$znx_m2 = ($data_conditions[0]["atoma"]*$zone_e/100) * $data_conditions[0]["znx_l_p_d"]; //υπολογισμός με m2 και άτομα/100m2 σε lt/d
	$znx_klines = round(($data_conditions[0]["znx_m3_sq_y"]*$klines) * (1000/365),2); //Υπολογισμός με κλίνες και m3/y και μετατροπή σε lt/d
	
	if($xrisi>=1 && $xrisi<=17){$hkznx = $znx_klines;}
	if($xrisi>=18 && $xrisi<=33){$hkznx = $znx_m2;}
	if($xrisi>=34 && $xrisi<=40){$hkznx = $znx_klines;}
	if($xrisi==41){$hkznx = $znx_m2;}
	if($xrisi==42){$hkznx = $znx_klines;}
	if($xrisi>=42){$hkznx = $znx_m2;}
	
	
	//Εύρεση ζώνης από την περιοχή
	$data_zone = $database->select("vivliothiki_climate_places","*",array("place"=>$place) );
	$zone = $data_zone[0]["zone"];
	$zone_name = $data_zone[0]["place"];
	
	$data_t_water = $database->select("vivliothiki_nerodiktyoy","*",array("zwni"=>$zone) );
	$data_t_mesi = $database->select("vivliothiki_climate31","*",array("place"=>$zone_name) );
	$data_solar_mesi = $database->select("vivliothiki_climate_b","*",array("place"=>$zone_name) );
	
	$data_dd = $database->select("vivliothiki_climate37","*",array("place"=>$zone_name) );
	
	$xrisi_name = $database->select("vivliothiki_conditions", "xrisi", array("id"=>$xrisi) );
	$xrisi_name=$xrisi_name[0];
	$txt = "";
	
	$txt .= "Περιοχή τοποθέτησης: ".$place."<br/>";
	$txt .= "Χρήση: ".$xrisi_name." (".$data_conditions[0]["znx_m3_sq_y"]."m3/κλίνη/y ή ".$data_conditions[0]["znx_l_p_d"]."l/άτομο/d)<br/>";
	$txt .= "Ac (επιφάνεια συλλέκτη): ".$ac." m<sup>2</sup><br/>";
	$txt .= "Προσανατολισμός συλλέκτη (γ): ".$g." <sup>o</sup><br/>";
	$txt .= "Κλίση συλλέκτη (β): ".$b." <sup>o</sup><br/>";
	$txt .= "Μ (Χωρητικότητα θερμαντήρα): ".$m." l<br/>";
	$txt .= "Κλίνες / m2: ".$klines." / ".$zone_e." <br/>";
	$txt .= "HKznx (Μέση ημερήσια κατανάλωση ΖΝΧ): ".$hkznx." l/day <br/>";
	$txt .= "Tznx (Επιθυμητή θερμοκρασία ΖΝΧ): ".$t_znx." <sup>o</sup>C<br/>";
	$txt .= "Χαρακτηριστικά μεγέθη συλλέκτη: FRUL=".$frul." , FR(τα)n=".$frtan." , (τα)/(τα)n=ανά μήνα<br/>";
	$txt .= "FR'/FR (εάν παρεμβάλλεται εναλλάκτης): ".$frfr."<br/>";
	$txt .= "k<sub>1</sub> (διορθωτικός συντελεστής δεξαμενής)= (75/".$m.")<sup>0.25</sup>=".round($k1,2)."<br/>";
	$txt .= "k<sub>3</sub> (διορθωτικός συντελεστής εναλλάκτη): 1 (για ΖΝΧ)<br/><br/>";
	$txt .="<table>				
		<tr>";
	$txt .="<th style=\"text-align:center; background-color: #CCCCCC;\">Παράμετρος</th>";
		for($i=1;$i<=12;$i++){
			$txt .="<th style=\"text-align:center; background-color: #CCCCCC;\">".$nmonths[$i]."</th>";
		}
	$txt .="<th style=\"text-align:center; background-color: #CCCCCC;\">ΣΥΝ</th>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td style=\"background-color: #eaeaea;\">Ημέρες μήνα</td>";
	for($i=1;$i<=12;$i++){
			$txt .="<td>".$ndays[$i]."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td style=\"background-color: #eaeaea;\">Τκ Νερό δικτύου</td>";
		for($i=1;$i<=12;$i++){
			$txt .="<td>".$data_t_water[0][$nmonths_en[$i]]."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	
	$txt .="<tr>";
	$txt .="<td style=\"background-color: #eaeaea;\">Ta Μέση θερμοκρασία 24ώρου</td>";
		for($i=1;$i<=12;$i++){
			$txt .="<td>".$data_t_mesi[0][$nmonths_en[$i]]."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td style=\"background-color: #eaeaea;\">Ηβ Μέση μηνιαία ηλιακή ακτινοβολία (κλιση 45 - προς 180)</td>";
		for($i=0;$i<=11;$i++){
			$txt .="<td>".$data_solar_mesi[$i]["b45g180"]."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td style=\"background-color: #eaeaea;\">Lznx (Μέσο μηνιαίο θερμικό φορτίο) (J)</td>";
		$lznx=0;
		for($i=1;$i<=12;$i++){
		${"lznx".$i} = $ndays[$i]*$hkznx*$water_r*$water_cp*($t_znx-$data_t_water[0][$nmonths_en[$i]])*1000;
		$lznx += ${"lznx".$i};

			$txt .="<td>".sprintf("%.2g",${"lznx".$i})."</td>";
		}
	$txt .="<td>".sprintf("%.2g",$lznx)."</td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td style=\"background-color: #eaeaea;\">DD Βαθμοημέρες θέρμανσης</td>";
		for($i=1;$i<=12;$i++){
			$txt .="<td>".$data_dd[0][$nmonths_en[$i]]."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	
	$txt .="<tr>";
	$txt .="<td style=\"background-color: #eaeaea;\">k<sub>2</sub> (διορθωτικός συντελεστής)</td>";
		//Υπολογισμός Κ2 για μεγάλες καταναλώσεις
		for($i=1;$i<=12;$i++){
			${"k2".$i}=(11.6 + 1.18*$t_znx + 3.86*$data_t_water[0][$nmonths_en[$i]] - 2.32*$data_t_mesi[0][$nmonths_en[$i]]) / (100-$data_t_mesi[0][$nmonths_en[$i]]);
			${"k2".$i} = round(${"k2".$i},2);
			$txt .="<td>".${"k2".$i}."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td style=\"background-color: #eaeaea;\">(τα)/(τα)n</td>";
		for($i=1;$i<=12;$i++){
			$txt .="<td>".${"tatan".$i}."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	
	$txt .="<tr>";
	$txt .="<td style=\"background-color: #eaeaea;\">Χ</td>";
		for($i=1;$i<=12;$i++){
		${"x".$i} = ($ac/${"lznx".$i}) * $frul * $frfr * ($t_anaf-$data_t_mesi[0][$nmonths_en[$i]]) * ($ndays[$i]*24*60*60) * $k1 * ${"k2".$i};
		${"x".$i} = round(${"x".$i},2);
			$txt .="<td>".${"x".$i}."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td style=\"background-color: #eaeaea;\">Υ</td>";
		for($i=1;$i<=12;$i++){
		${"y".$i} = ($ac/${"lznx".$i}) * $frtan * $frfr * ${"tatan".$i} * ($data_solar_mesi[$i-1]["b45g180"]*3600*1000) * 1;
		${"y".$i} = round(${"y".$i},2);
			$txt .="<td>".${"y".$i}."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td style=\"background-color: #eaeaea;\">f (Ποσοστό κάλυψης από ηλιακά)</td>";
		for($i=1;$i<=12;$i++){
		${"f".$i} = 1.029*${"y".$i} - 0.065*${"x".$i} - 0.245*pow(${"y".$i},2) + 0.0018*pow(${"x".$i},2) + 0.0215*pow(${"y".$i},3);
		${"f".$i} = round(${"f".$i},2);
			if(${"f".$i}>1){${"f".$i}=1;}
			$txt .="<td>".${"f".$i}."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td style=\"background-color: #eaeaea;\">1-f (Υπόλοιπο από σύστημα)</td>";
		for($i=1;$i<=12;$i++){
		${"flev".$i} = 1-${"f".$i};
			$txt .="<td class=\"warning\">".${"flev".$i}."</td>";
		}
	$txt .="<td></td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td style=\"background-color: #eaeaea;\">f*l</td>";
		$fl=0;
		for($i=1;$i<=12;$i++){
		${"fl".$i} = ${"f".$i}*${"lznx".$i};
		$fl += ${"fl".$i};
		
			$txt .="<td>".sprintf("%.2g",${"fl".$i})."</td>";
		
		}
	$txt .="<td >".sprintf("%.2g",$fl)."</td>";
	$txt .="</tr>";
	
	$txt .="<tr>";
	$txt .="<td colspan=\"13\" style=\"text-align:center; background-color: #CCCCCC;\">Κάλυψη f</td>";
	$f = $fl / $lznx;
	$f = round($f,2);
	$f_percent = $f*100;
	if($f_percent>=60){
		$color="style=\"background-color:#cce5cc;\"";
	}else{
		$color="style=\"background-color:#ffcccc;\"";
	}
	$txt .="<td ".$color.">".$f." ή ".$f_percent."%</td>";
	$txt .="</tr>";
	
	$txt .="</table><br/>";

	return $txt;
}


//Εκτύπωση πίνακα οριζόντιων στοιχείων (Δάπεδα - Οροφές)
//$type: 0:Όλα, 1:Μόνο δάπεδα, 2:Μόνο Οροφές
function teyxos_daporo(){
	$database = new medoo(DB_NAME);
	//$tb_meleti = "user_meletes";
	$tb_zones = "meletes_zones";
	$col = "*";
	//$where_meleti=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	//$select_meleti = $database->select($tb_meleti,$col,$where_meleti);
	$select_zones = $database->select($tb_zones, $col, $where);
	
	//Δημιουργία πίνακα δαπέδων - οροφών
	$tb_zone_dapeda = "meletes_zone_dapeda";
	$dapeda_type = array(
			0=>"Επί εδάφους",
			1=>"Σε ΜΘΧ/Ηλιακό χώρο (διαχ. επιφάνεια)",
			2=>"Σε αέρα (πυλωτή)"
		);
	$tb_zone_orofes = "meletes_zone_orofes";
	$orofes_type = array(
			0=>"Σε αέρα",
			1=>"Σε ΜΘΧ/Ηλιακό χώρο (διαχ. επιφάνεια)"
		);
	$tb_zone_windows = "meletes_zone_diafani";
	$f2 = "";	
		
	foreach($select_zones as $zone){
		
		$zone_orizontia_ua=0;
		$f2 .= "<table>
		<tr><td style=\"text-align:center; background-color: #CCCCCC;\" colspan=\"11\">Οριζόντια στοιχεία θερμικής ζώνης: ".$zone["name"]."</td></tr>";
		$f2 .= "
		<tr><td style=\"width: 10%; background-color: #eaeaea;\">Τύπος</td>
		<td style=\"width: 12%; background-color: #eaeaea;\">Όνομα</td>
		<td style=\"width: 10%; background-color: #eaeaea;\">Εμβαδόν (m<sup>2</sup>)</td>
		<td style=\"width: 8%; background-color: #eaeaea;\">U (W/m<sup>2</sup>)</td>
		<td style=\"width: 8%; background-color: #eaeaea;\">U' (W/m<sup>2</sup>)</td>
		<td style=\"width: 8%; background-color: #eaeaea;\">U'x A (W/m)</td>
		<td style=\"width: 10%; background-color: #eaeaea;\">α (-)/ε (-)/g_w<sup>1</sup></td>
		<td style=\"width: 10%; background-color: #eaeaea;\">z (m) /Π (m)<sup>2</sup></td>
		<td style=\"width: 8%; background-color: #eaeaea;\">Fhor</td>
		<td style=\"width: 8%; background-color: #eaeaea;\">Fov</td>
		<td style=\"width: 8%; background-color: #eaeaea;\">Ffin</td>
		</tr>";
	//ΔΑΠΕΔΑ ΖΩΝΗΣ
	$select_zone_dapeda = $database->select($tb_zone_dapeda, $col, array("zone_id"=>$zone["id"]));
	$count_zone_dapeda = $database->count($tb_zone_dapeda, array("zone_id"=>$zone["id"]));
		if($count_zone_dapeda!=0){
		$f2 .= "<tr><td style=\"text-align:center; background-color: #e5f2e5;\" colspan=\"11\">Δάπεδα</td></tr>";
			foreach($select_zone_dapeda as $dapeda){
				
				if($dapeda["u"]!=0){
					$dapeda_u=$dapeda["u"];
				}else{
					$dapeda_u_data = $database->select("user_adiafani","u",array("id"=>$dapeda["u_id"]) );
					$dapeda_u=$dapeda_u_data[0];
				}
				$dapeda_ap = $database->select("vivliothiki_adiafani_a","a",array("id"=>$dapeda['ap']) );
				$dapeda_ap=$dapeda_ap[0];
				$dapeda_ek = $database->select("vivliothiki_adiafani_e","e",array("id"=>$dapeda['ek']) );
				$dapeda_ek=$dapeda_ek[0];
				
				if($dapeda["type"]==1){
					$b=0.5;
				}else{
					$b=1;
				}
				$dapeda_ub=$dapeda_u*$b;
				if($dapeda["type"]==0){
					$z=$dapeda["z"];
					$har=2*$dapeda["e"]/$dapeda["p"];
					$dapeda_ub=isodynamos_dapedoy($dapeda_u, $z, $har);
				}
				$dapeda_ua=$dapeda_ub*$dapeda["e"];
				$zone_orizontia_ua+=$dapeda_ua;
				
				$f2 .= "<tr><td>".$dapeda_type[$dapeda["type"]]."</td>
				<td>".$dapeda["name"]."</td>
				<td>".$dapeda["e"]."</td>
				<td>".$dapeda_u."</td>
				<td>".round($dapeda_ub,3)."</td>
				<td>".round($dapeda_ua,3)."</td>
				<td>".$dapeda_ap."-".$dapeda_ek."</td>
				<td>".$dapeda["z"]."-".$dapeda["p"]."</td>
				<td>".$dapeda["fhor_h"]."-".$dapeda["fhor_c"]."</td>
				<td>".$dapeda["fov_h"]."-".$dapeda["fov_c"]."</td>
				<td>".$dapeda["ffin_h"]."-".$dapeda["ffin_c"]."</td>
				</tr>";
			}//Για κάθε δάπεδο
			
		}//Υπάρχουν δάπεδα
		
	//ΟΡΟΦΕΣ ΖΩΝΗΣ
	$select_zone_orofes = $database->select($tb_zone_orofes, $col, array("zone_id"=>$zone["id"]));
	$count_zone_orofes = $database->count($tb_zone_orofes, array("zone_id"=>$zone["id"]));
		if($count_zone_orofes!=0){
		$f2 .= "<tr><td style=\"text-align:center; background-color: #e5f2e5;\" colspan=\"11\">Οροφές</td></tr>";
			foreach($select_zone_orofes as $orofes){
				if($orofes["u"]!=0){
					$orofes_u=$orofes["u"];
				}else{
					$orofes_u_data = $database->select("user_adiafani","u",array("id"=>$orofes["u_id"]) );
					$orofes_u=$orofes_u_data[0];
				}
				$orofes_ap = $database->select("vivliothiki_adiafani_a","a",array("id"=>$orofes['ap']) );
				$orofes_ap=$orofes_ap[0];
				$orofes_ek = $database->select("vivliothiki_adiafani_e","e",array("id"=>$orofes['ek']) );
				$orofes_ek=$orofes_ek[0];
				
				if($orofes["type"]==1){
					$b=0.5;
				}else{
					$b=1;
				}
				
			$window_sume=0;
			//Παράθυρα οροφών
			$data_windowor = $database->select($tb_zone_windows,"*",array("roof_id"=>$orofes['id']) );
			foreach($data_windowor as $window){
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
				
				$window_ub=$window_u*$b;
				$window_ua=$window_ub*$window_e;
				$zone_orizontia_ua+=$window_ua;
				
				$f2 .= "<tr><td>".$orofes_type[$orofes["type"]]."</td>
				<td>".$window_name."</td>
				<td>".$window_e."</td>
				<td>".$window_u."</td>
				<td>".round($window_ub,3)."</td>
				<td>".round($window_ua,3)."</td>
				<td>".$orofes_ap."-".$orofes_ek."-".$window_gw."</td>
				<td></td>
				<td>".$orofes["fhor_h"]."-".$orofes["fhor_c"]."</td>
				<td>".$orofes["fov_h"]."-".$orofes["fov_c"]."</td>
				<td>".$orofes["ffin_h"]."-".$orofes["ffin_c"]."</td>
				</tr>";
			
			}//Παράθυρα οροφών
				
				$roof_e=0;
				$roof_e=$orofes["e"]-$window_sume;
				
				$orofes_ub=$orofes_u*$b;
				$orofes_ua=$orofes_ub*$roof_e;
				$zone_orizontia_ua+=$orofes_ua;
				
				$f2 .= "<tr><td>".$orofes_type[$orofes["type"]]."</td>
				<td>".$orofes["name"]."</td>
				<td>".$roof_e."</td>
				<td>".$orofes_u."</td>
				<td>".round($orofes_ub,3)."</td>
				<td>".round($orofes_ua,3)."</td>
				<td>".$orofes_ap."-".$orofes_ek."</td>
				<td></td>
				<td>".$orofes["fhor_h"]."-".$orofes["fhor_c"]."</td>
				<td>".$orofes["fov_h"]."-".$orofes["fov_c"]."</td>
				<td>".$orofes["ffin_h"]."-".$orofes["ffin_c"]."</td>
				</tr>";
			}//για κάθε οροφή
		}//Υπάρχουν οροφές
		
		$f2 .= "<tr>
			<td colspan=\"5\">Ζώνη: ".$zone["name"]." - UxA Οριζόντιων</td>
			<td style=\"background-color: #eaeaea;\">".round($zone_orizontia_ua,3)."</td>
			<td colspan=\"5\"></td>
			</tr>";
		$f2 .= "</table>";
	}//Για κάθε ζώνη

	$f2 .= "<br/>1: α/ε/g_w: Απορροφητικότητα / Συντελεστής εκπομπής / g_w ανοιγμάτων οροφής<br/>";
	$f2 .= "<br/>2: z/Π: Βάθος έδρασης / Περίμετρος<br/>";
	
	return $f2;
	
}


//Εκτύπωση πίνακα στοιχείων ζώνης
function teyxos_zones(){
	$database = new medoo(DB_NAME);
	$tb_zones = "meletes_zones";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_zones = $database->select($tb_zones, $col, $where);
	
	//Δημιουργία πίνακα θερμικών ζωνών
	$array_thermo = array(
			80=>"Πολύ Ελαφριά κατασκευή (80 KJ/m2.K)",
			110=>"Ελαφριά κατασκευή (110 KJ/m2.K)",
			165=>"Μέτρια κατασκευή (165 KJ/m2.K)",
			260=>"Βαριά κατασκευή (260 KJ/m2.K)",
			370=>"Πολύ βαριά κατασκευή (370 KJ/m2.K)"
		);
	$array_auto = array(
		0=>"Τύπος Α",
		1=>"Τύπος Β",
		2=>"Τύπος Γ",
		3=>"Τύπος Δ"
	);
		
	$f1 = "<table>
	<tr><td style=\"text-align:center; background-color: #CCCCCC;\" colspan=\"8\">Θερμικές ζώνες κτιρίου</td></tr>
	<tr><td style=\"width: 20%; background-color: #eaeaea;\">Όνομα</td>
	<td style=\"width: 20%; background-color: #eaeaea;\">Χρήση</td>
	<td style=\"width: 10%; background-color: #eaeaea;\">Κλίνες*</td>
	<td style=\"width: 10%; background-color: #eaeaea;\">Αν. θέρμο.</td>
	<td style=\"width: 10%; background-color: #eaeaea;\">Αυτοματισμοί</td>
	<td style=\"width: 10%; background-color: #eaeaea;\">Καμινάδες</td>
	<td style=\"width: 10%; background-color: #eaeaea;\">Θυρίδες</td>
	<td style=\"width: 10%; background-color: #eaeaea;\">Ανεμιστήρες</td></tr>";
	foreach($select_zones as $zone){
		$f1 .= "<tr><td>".$zone["name"]."</td>";
		$zone_xrisi = $database->select("vivliothiki_conditions", "xrisi", array("id"=>$zone["xrisi"]) );
		$f1 .= "<td>".$zone_xrisi[0]."</td>";
		$f1 .= "<td>".$zone["klines"]."</td>".
		"<td>".$array_thermo[$zone["thermo"]]."</td>".
		"<td>".$array_auto[$zone["auto"]]."</td>".
		"<td>".$zone["kaminades"]."</td>".
		"<td>".$zone["thyrides"]."</td>".
		"<td>".$zone["anemistires"]."</td></tr>";
	}
	$f1 .= "</table>";
	$f1 .= "<br/>*Εάν απαιτούνται βάση της χρήσης.<br/>";
	
	return $f1;
}


//Εκτύπωση πίνακα στοιχείων ΜΘΧ
function teyxos_mthx(){
	$database = new medoo(DB_NAME);
	$tb_mthx = "meletes_mthx";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_mthx = $database->select($tb_mthx, $col, $where);
	
	$f1="";
	
	$array_type = array(
			0=>"ΜΘΧ",
			1=>"Ηλιακός χώρος"
		);
	$f1 .= "<table>
	<tr>
	<td style=\"text-align:center; background-color: #CCCCCC;\" colspan=\"2\">ΜΘΧ/Ηλιακοί χώροι κτιρίου</td>
	</tr>
	<tr>
	<td style=\"width: 50%; background-color: #eaeaea;\">Τύπος</td>
	<td style=\"width: 50%; background-color: #eaeaea;\">Όνομα</td>
	</tr>";
	foreach($select_mthx as $mthx){
		$f1 .= "<tr>
		<td>".$array_type[$mthx["type"]]."</td>".
		"<td>".$mthx["name"]."</td>
		</tr>";
	}
	$f1 .= "</table><br/><br/>";
	
	return $f1;
}


//Εκτύπωση πίνακα εμβαδών
function teyxos_buildinge(){
	$database = new medoo(DB_NAME);
	$tb_zones = "meletes_zones";
	$tb_mthx = "meletes_mthx";
	$tb_xwroi = "meletes_xwroi";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_zones = $database->select($tb_zones, $col, $where);
	$select_mthx = $database->select($tb_mthx, $col, $where);
	
	$f1="";
	
	$f1 .= "<table>
	<tr><td style=\"text-align:center; background-color: #CCCCCC;\" colspan=\"6\">Εμβαδόν/Όγκος κτιρίου</td></tr>
	<tr>
	<td style=\"width: 30%; background-color: #eaeaea;\">Όνομα</td>
	<td style=\"width: 10%; background-color: #eaeaea;\">Μήκος*</td>
	<td style=\"width: 10%; background-color: #eaeaea;\">Πλάτος*</td>
	<td style=\"width: 10%; background-color: #eaeaea;\">Ύψος</td>
	<td style=\"width: 20%; background-color: #eaeaea;\">Ε</td>
	<td style=\"width: 20%; background-color: #eaeaea;\">V</td>
	</tr>";

	$zones_e = 0;
	$zones_v = 0;
	foreach($select_zones as $zone){
	$select_xwroi = $database->select($tb_xwroi, $col, array("zone_id"=>$zone["id"]));
	$zone_e = 0;
	$zone_v = 0;
	$f1 .= "<tr><td style=\"text-align:center; background-color: #e5f2e5;\" colspan=\"6\">".$zone["name"]."</td></tr>";
		foreach($select_xwroi as $xwroi){
		$f1 .= "<tr><td>".$xwroi["name"]."</td>".
		"<td>".$xwroi["l"]."</td>".
		"<td>".$xwroi["w"]."</td>".
		"<td>".$xwroi["h"]."</td>";
			if($xwroi["type"]==0){//Μετράει και εμβαδόν και όγκος
				$xwros_e = $xwroi["l"]*$xwroi["w"];
				$xwros_v = $xwros_e*$xwroi["h"];
			}else{//Μετράει μόνο όγκος (4κλινής σκεπή)
				$xwros_e=0;
				$xwros_v=(1/6)*$xwroi["w"]*$xwroi["h"]*(2*$xwroi["w"]+3*($xwroi["l"]-$xwroi["w"]));
			}
		$f1 .="<td>".$xwros_e."</td>".
		"<td>".$xwros_v."</td></tr>";
		$zone_e += $xwros_e;
		$zone_v += $xwros_v;
		}
		
		$f1 .= "<tr><td colspan=\"4\">Σύνολο</td>".
		"<td style=\"background-color: #e5f2e5;\">".$zone_e."</td>".
		"<td style=\"background-color: #e5f2e5;\">".$zone_v."</td></tr>";
		
		$zones_e += $zone_e;
		$zones_v += $zone_v;
	}
	$f1 .= "<tr><td colspan=\"4\">Σύνολο ζωνών κτιρίου</td>".
		"<td style=\"background-color: #cce5cc;\">".$zones_e."</td>".
		"<td style=\"background-color: #cce5cc;\">".$zones_v."</td></tr>";

	$mthxs_e = 0;
	$mthxs_v = 0;
	foreach($select_mthx as $mthx){
	$select_xwroi = $database->select($tb_xwroi, $col, array("mthx_id"=>$mthx["id"]));
	$mthx_e = 0;
	$mthx_v = 0;
	$f1 .= "<tr><td style=\"text-align:center; background-color: #ffe5ff;\" colspan=\"6\">".$mthx["name"]."</td></tr>";
		foreach($select_xwroi as $xwroi){
		$f1 .= "<tr><td>".$xwroi["name"]."</td>".
		"<td>".$xwroi["l"]."</td>".
		"<td>".$xwroi["w"]."</td>".
		"<td>".$xwroi["h"]."</td>";
			if($xwroi["type"]==0){//Μετράει και εμβαδόν και όγκος
				$xwros_e = $xwroi["l"]*$xwroi["w"];
				$xwros_v = $xwros_e*$xwroi["h"];
			}else{//Μετράει μόνο όγκος (4κλινής σκεπή)
				$xwros_e=0;
				$xwros_v=(1/6)*$xwroi["w"]*$xwroi["h"]*(2*$xwroi["w"]+3*($xwroi["l"]-$xwroi["w"]));
			}
		$f1 .="<td>".$xwros_e."</td>".
		"<td>".$xwros_v."</td></tr>";
		$mthx_e += $xwros_e;
		$mthx_v += $xwros_v;
		}
		
		$f1 .= "<tr><td colspan=\"4\">Σύνολο</td>".
		"<td style=\"background-color: #ffe5ff;\">".$mthx_e."</td>".
		"<td style=\"background-color: #ffe5ff;\">".$mthx_v."</td></tr>";
		
		$mthxs_e += $mthx_e;
		$mthxs_v += $mthx_v;
	}
	$f1 .= "<tr><td colspan=\"4\">Σύνολο ΜΘΧ/ηλιακών χώρων κτιρίου</td>".
	"<td style=\"background-color: #ffccff;\">".$mthxs_e."</td>".
	"<td style=\"background-color: #ffccff;\">".$mthxs_v."</td></tr>";
	$ktirio_e = $zones_e+$mthxs_e;
	$ktirio_v = $zones_v+$mthxs_v;
	$f1 .= "<tr><td colspan=\"4\">ΣΥΝΟΛΟ</td>".
	"<td style=\"background-color: #CCCCCC;\">".$ktirio_e."</td>".
	"<td style=\"background-color: #CCCCCC;\">".$ktirio_v."</td></tr>";
	$f1 .= "</table><br/>";
	$f1 .= "<br/>*Σε περίπτωση προσθήκης μόνο του εμβαδού αυτό έχει προστεθεί σε μία από τις δύο τιμές (μήκους ή πλάτους) με τη 
	δεύτερη να έχει την τιμή 1. Σε κάθε περίπτωση ο υπολογισμός μήκους x πλάτους δίνει το πραγματικό εμβαδόν της ζώνης/μθχ ή ηλιακού χώρου<br/>";
	
	return $f1;
}


//Εκτύπωση πίνακα θερμογεφυρών ζώνης
function teyxos_thermo(){
	$database = new medoo(DB_NAME);
	$tb_zones = "meletes_zones";
	$tb_thermo = "meletes_zone_thermo";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_zones = $database->select($tb_zones, $col, $where);
	
	//ΘΕΡΜΟΓΕΦΥΡΕΣ 
	$array_type = array(
		0=>"ΞΓ",
		1=>"ΣΓ",
		2=>"ΣΣ",
		3=>"ΔΣ",
		4=>"ΔΠ",
		5=>"ΟΕ",
		6=>"ΔΥ",
		7=>"ΕΔ",
		8=>"ΔΦ",
		9=>"ΠΡ",
		10=>"ΛΠ",
		11=>"ΥΠ"
	);
	$thermo_dbs = array(
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
		11=>"yp"
	);
	$thermo_fullnames = array(
		0=>"Θερμογέφυρες εξωτερικής γωνίας (οριζόντια τομή)",
		1=>"Θερμογέφυρες εσωτερικής γωνίας (οριζόντια τομή)",
		2=>"Θερμογέφυρες ενώσεων δομικών στοιχείων (οριζόντια τομή)",
		3=>"Θερμογέφυρες δώματος / οροφής σε προεξοχή (κατακόρυφη τομή)",
		4=>"Θερμογέφυρες δαπέδου σε προεξοχή / δαπέδου επάνω από πυλωτή (κατακόρυφη τομή)",
		5=>"Θερμογέφυρες σε οροφή σε εσοχή (κατακόρυφη τομή)",
		6=>"Θερμογέφυρες σε δάπεδο σε εσοχή (κατακόρυφη τομή)",
		7=>"Θερμογέφυρες σε ενδιάμεσο δάπεδο (κατακόρυφη τομή)",
		8=>"Θερμογέφυρες δαπέδου που εδράζεται στο έδοφος (κατακόρυφη τομή)",
		9=>"Θερμογέφυρες περιδέσμου ενίσχυσης (κατακόρυφη τομή)",
		10=>"Θερμογέφυρες σε λαμπά κουφώματος (οριζόντια τομή)",
		11=>"Θερμογέφυρες σε ανωκάσι/κατωκάσι κουφώματος (κατακόρυφη τομή)"
	);
	$f3 = "<table>
	<tr><td style=\"text-align:center; background-color: #CCCCCC;\" colspan=\"6\">Θερμογέφυρες</td></tr>
	<tr><td style=\"width: 20%; background-color: #eaeaea;\">Παράσταση</td>
	<td style=\"width: 20%; background-color: #eaeaea;\">Τύπος</td>
	<td style=\"width: 20%; background-color: #eaeaea;\">U</td>
	<td style=\"width: 10%; background-color: #eaeaea;\">Πλήθος</td>
	<td style=\"width: 10%; background-color: #eaeaea;\">Διάσταση</td>
	<td style=\"width: 20%; background-color: #eaeaea;\">ψxL</td>
	</tr>";

	$yl = 0;
	foreach($select_zones as $zone){
		$select_zone_thermo = $database->select($tb_thermo, $col, array("zone_id"=>$zone["id"]) );
		$count_zone_thermo = $database->count($tb_thermo, array("zone_id"=>$zone["id"]));
		$zone_yl = 0;
		if($count_zone_thermo!=0){
			$f3 .= "<tr><td style=\"text-align:center; background-color: #e5f2e5;\" colspan=\"6\">".$zone["name"]."</td></tr>";
			foreach($select_zone_thermo as $thermo){
				$vivliothiki_thermo = "vivliothiki_thermo_".$thermo_dbs[$thermo["type"]];
				$data_u = $database->select($vivliothiki_thermo,"*",array("id"=>$thermo["u"]) );
				$data_yl = $data_u[0]["y"]*$thermo["n"]*$thermo["h"];
				$f3 .= "<tr>";
				$f3 .= "<td><img src=\"".APPLICATION_FOLDER."images/thermo/".$thermo_dbs[$thermo["type"]]."/".$thermo_dbs[$thermo["type"]].$thermo["u"].".jpg\"></td>";
				$f3 .= "<td>".$thermo_names[$thermo["type"]]."</td>";
				$f3 .= "<td>".$data_u[0]["name"]."</td>";
				$f3 .= "<td>".$thermo["n"]."</td>";
				$f3 .= "<td>".$thermo["h"]."</td>";
				$f3 .= "<td>".$data_yl."</td>";
				$f3 .= "</tr>";
				
				$zone_yl += $data_yl;
			}//για κάθε θερμογέφυρα
			$f3 .= "<tr><td colspan=\"5\">".$zone["name"]." - Σύνολο ψ x L</td><td style=\"background-color: #e5f2e5;\">".$zone_yl."</td></tr>";
			$yl += $zone_yl;
		}//έλεγχος μήπως δεν υπάρχει καμία
	}//για κάθε ζώνη
	$f3 .= "<tr><td colspan=\"5\">Σύνολο ψ x L</td><td style=\"background-color: #e5f2e5;\">".$yl."</td></tr>";
	$f3 .= "</table>";
	$f3 .= "<br/><br/>";
	$f3 .= "Τύποι θερμογεφυρών:";
	$f3 .= "<ul>";
	for($i=0; $i<=11; $i++){
		$f3 .= "<li>".$thermo_names[$i]." : ".$thermo_fullnames[$i]."</li>";
	}
	$f3 .= "</ul>";
	
	return $f3;
	
}


//Εκτύπωση εικόνων κλιματικών δεδομένων
function teyxos_imgzone(){
	$database = new medoo(DB_NAME);
	$tb_meleti = "user_meletes";
	$col = "*";
	$where_meleti=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$select_meleti = $database->select($tb_meleti,$col,$where_meleti);
	
	$meleti_zone = $select_meleti[0]["zone"];
	$meleti_climate = $select_meleti[0]["climate"];
	$meleti_address_x = $select_meleti[0]["address_x"];
	$meleti_address_y = $select_meleti[0]["address_y"];
	$meleti_address_z = $select_meleti[0]["address_z"];
	
	
//Εικόνες κλιματικής ζώνης και τοπογραφικό
$image_location = 'http://staticmap.openstreetmap.de/staticmap.php?center='.$meleti_address_x.','.$meleti_address_y.'&zoom=14&size=512x512&maptype=mapnik';
$image_dest = 'file_upload/server/php/files/user_'.$_SESSION['user_id'].'/meleti_'.$_SESSION['meleti_id'].'/location_osm.jpg';
if(file_exists($image_dest)){
	
}else{
	copy($image_location , $image_dest );
}

	$imgzone = "Θέση κτιρίου:<br/>";
	$imgzone .= "<img src=\"".APPLICATION_FOLDER."images/zwni/".$meleti_zone.".jpg\"><br/>";
	$imgzone .= "<img src=\"".APPLICATION_FOLDER."includes/".$image_dest."\"><br/><br/>";
	$imgzone .= "(Lat:".$meleti_address_x." ,Lon:".$meleti_address_y.")<br/><br/>";

	//Διαθέσιμα κλιματικά δεδομένα από τους πίνακες
	$imgzone .= "Κλιματολογικά δεδομένα περιοχής<br/><br/>";
	require("functions_create_image.php");
	require_once("pchart/class/pData.class.php");
	require_once("pchart/class/pDraw.class.php");
	require_once("pchart/class/pImage.class.php");

	$place_id = $meleti_climate+1; //selectedIndex+1
	$data_place = $database->select("vivliothiki_climate_places","place",array("id"=>$place_id));
	$place = $data_place[0];
	$climate_tables = array(31,32,33,34,35,36,37,38,39,310,311,41,42,43,61);
		foreach($climate_tables as $table){
			$data_id = $database->select("vivliothiki_climate".$table,"id",array("place"=>$place));
			$climate_id = $data_id[0];
				if(isset($climate_id)){
				$img = create_image_climate($table,$climate_id);
				$imgzone .= "<img src=\"".APPLICATION_FOLDER."images/climate/".$table."/climate_table".$table."_id".$climate_id.".png\"><br/>";
				}
		}
	$imgzone .= "<img src=\"".APPLICATION_FOLDER."images/climate/solar/id".$place_id."_1.png\"><br/>";
	$imgzone .= "<img src=\"".APPLICATION_FOLDER."images/climate/solar/id".$place_id."_2.png\"><br/>";

	$img = create_image_climate_b($place,"b45g180");
	$imgzone .= "Δεδομένα ηλιακής ακτινοβολίας για κλίση συλλέκτη 45 μοιρών και Νότιο προσανατολισμό:<br/>";
	$imgzone .= "<img src=\"".APPLICATION_FOLDER."images/climate/b/climate".$place_id."_columnb45g180.png\"><br/><br/>";
	require_once("functions_vivliothikes.php");

	$imgzone .= create_library_climateb($place,$b=45,$g=180);
	
	return $imgzone;
}


//Εύρεση των U αδιαφανών που χρησιμοποιούνται σε κάθε μελέτη
function teyxos_getadiafaniuids(){
	$database = new medoo(DB_NAME);
	$col="*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$array_adiafani_uids = array();
	$tb_adiafani = "meletes_zone_adiafani";
	$tb_dapeda = "meletes_zone_dapeda";
	$tb_orofes = "meletes_zone_orofes";
	
	$select_dapeda = $database->select($tb_dapeda, $col, $where);
	foreach($select_dapeda as $dapeda){
		if($dapeda["u_id"]!=0){
			array_push($array_adiafani_uids, $dapeda["u_id"]);
		}
	}
	$select_orofes = $database->select($tb_orofes, $col, $where);
	foreach($select_orofes as $orofes){
		if($orofes["u_id"]!=0){
			array_push($array_adiafani_uids, $orofes["u_id"]);
		}
	}
	$select_adiafani = $database->select($tb_adiafani, $col, $where);
	foreach($select_adiafani as $adiafani){
		if($adiafani["u_id"]!=0){
			array_push($array_adiafani_uids, $adiafani["u_id"]);
		}
		if($adiafani["yp_u_id"]!=0){
			array_push($array_adiafani_uids, $adiafani["yp_u_id"]);
		}
		if($adiafani["dok_u_id"]!=0){
			array_push($array_adiafani_uids, $adiafani["dok_u_id"]);
		}
		if($adiafani["syr_u_id"]!=0){
			array_push($array_adiafani_uids, $adiafani["syr_u_id"]);
		}
	}
	$array_adiafani_uids = array_unique($array_adiafani_uids);
	return $array_adiafani_uids;
}

//Εύρεση των U διαφανών που χρησιμοποιούνται σε κάθε μελέτη
function teyxos_getdiafaniuids(){
	$database = new medoo(DB_NAME);
	$col="*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$array_diafani_uids = array();
	$tb_diafani = "meletes_zone_diafani";
	
	$select_diafani = $database->select($tb_diafani, $col, $where);
	foreach($select_diafani as $diafani){
		if($diafani["u_id"]!=0){
			array_push($array_diafani_uids, $diafani["u_id"]);
		}
	}
	$array_diafani_uids = array_unique($array_diafani_uids);
	return $array_diafani_uids;
}


//Εκτύπωση υπολογισμού αδιαφανών με βάση το $id του πίνακα user_adiafani
function teyxos_adiafaniu($id){
	$database = new medoo(DB_NAME);
	$col="*";
	$tb_useradiafani="user_adiafani";
	
	$where_useradiafani=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$id));
	$adiafani_data = $database->select($tb_useradiafani, $col, $where_useradiafani );
	$adiafani_data=$adiafani_data[0];
	
	$analysiu = "";
	
$array_umax=array(
	0=>"0.60|1.50|1.50|0.50|0.50|0.50|1.20|1.20",
	1=>"0.50|1.00|1.00|0.45|0.45|0.45|0.90|0.90",
	2=>"0.45|0.80|0.80|0.40|0.40|0.40|0.75|0.75",
	3=>"0.40|0.70|0.70|0.35|0.35|0.35|0.70|0.70"
);
$array_rira = array(
	1=>array(
		"ri"=>0.13,
		"ra"=>0.04,
		"desc"=>"Εξωτερικοί τοίχοι και παράθυρα (προς εξωτ. αέρα)"
	),
	2=>array(
		"ri"=>0.13,
		"ra"=>0.13,
		"desc"=>"Τοίχος που συνορεύει με μη θερμαινόμενο χώρο"
	),
	3=>array(
		"ri"=>0.13,
		"ra"=>0.00,
		"desc"=>"Τοίχος σε επαφή με το έδαφος"
	),
	4=>array(
		"ri"=>0.10,
		"ra"=>0.04,
		"desc"=>"Στέγες, δώματα (ανερχόμενη ροή θερμότητας)"
	),
	5=>array(
		"ri"=>0.10,
		"ra"=>0.10,
		"desc"=>"Οροφή που συνορεύει με μη θερμαινόμενο χώρο"
	),
	6=>array(
		"ri"=>0.17,
		"ra"=>0.04,
		"desc"=>"Δάπεδο επάνω από ανοικτή διάβαση (pilotis)"
	),
	7=>array(
		"ri"=>0.17,
		"ra"=>0.17,
		"desc"=>"Δάπεδο επάνω από μη θερμαινόμενο χώρο (κατερχόμενη ροή)"
	),
	8=>array(
		"ri"=>0.17,
		"ra"=>0.00,
		"desc"=>"Δάπεδο σε επαφή με το έδαφος"
	)
);
$array_ru = array(
	0=>0,
	1=>0.06,
	2=>0.20,
	3=>0.30,
	4=>0.30
);
$array_rd = array(
	1=>".11|.11|.11|.19|.19|.19|.18|.18|.18|.17|.17|.17",
	2=>".13|.13|.13|.26|.26|.26|.25|.25|.25|.22|.22|.22",
	3=>".15|.15|.15|.36|.36|.36|.33|.33|.33|.29|.29|.29",
	4=>".17|.16|.17|.52|.45|.52|.46|.41|.46|.38|.34|.38",
	5=>".18|.16|.19|.67|.45|.80|.57|.41|.66|.44|.34|.50",
	6=>".18|.16|.21|.67|.45|.80|.57|.41|.66|.44|.34|.67",
	7=>".18|.16|.22|.67|.45|.80|.57|.41|.66|.44|.34|.75",
	8=>".18|.16|.23|.67|.45|.80|.57|.41|.66|.44|.34|.75"
);
$array_text_ru=array(
	0=>"",
	1=>"Κεραμοσκεπή επί τεγίδων χωρίς σανίδωμα",
	2=>"Κεραμοσκεπή με σανίδωμα ή μεμβράνη",
	3=>"Κεραμοσκεπή με σανίδωμα ή μεμβράνη και φύλλο αλουμινίου",
	4=>"Κεραμοσκεπή με σανίδωμα και μεμβράνη",
);
$array_text_rd1=array(
	0=>"",
	1=>"Στρώμα πάχους:5mm",
	2=>"Στρώμα πάχους:7mm",
	3=>"Στρώμα πάχους:10mm",
	4=>"Στρώμα πάχους:15mm",
	5=>"Στρώμα πάχους:25mm",
	6=>"Στρώμα πάχους:50mm",
	7=>"Στρώμα πάχους:100mm",
	8=>"Στρώμα πάχους:300mm"
);
$array_text_rd2=array(
	0=>"",
	1=>"οριζόντια",
	2=>"από κάτω προς τα πάνω",
	3=>"από πάνω προς τα κάτω ",
	4=>"Στρώμα πάχους:15mm"
);
$array_text_rd3=array(
	0=>"",
	1=>"ανακλαστική επιφάνεια e=0.80",
	2=>"ανακλαστική επιφάνεια e=0.05",
	3=>"ανακλαστική επιφάνεια e=0.10",
	4=>"ανακλαστική επιφάνεια e=0.20"
);
	
	
	$analysiu .= "<table>
	<tr><td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"5\">
	Κωδ. Φύλλου αδιαφανών: ".$adiafani_data["id"]." - Δομικό στοιχείο: ".$adiafani_data["name"]."</td></tr>
	<tr><td style=\"width: 5%; background-color:#eaeaea;\">α/α</td>
	<td style=\"width: 65%; background-color:#eaeaea;\">Υλικό</td>
	<td style=\"width: 10%; background-color:#eaeaea;\">Πάχος (m)</td>
	<td style=\"width: 10%; background-color:#eaeaea;\">λ (W/m.K)</td>
	<td style=\"width: 10%; background-color:#eaeaea;\">d/λ (m<sup>2</sup>.K/W)</td>
	</tr>";
	$category=explode("|",$adiafani_data["category"]);
	$subcategory=explode("|",$adiafani_data["subcategory"]);
	$strwsi=explode("|",$adiafani_data["strwsi"]);
	$paxos=explode("|",$adiafani_data["paxos"]);
	
	$sdl=0;
	for($i=1;$i<=10;$i++){
		if($paxos[$i-1]!=""){
			
			$id_yliko=$strwsi[$i-1];
			
			if($category[$i-1]>0 AND $category[$i-1]<9 ){
				$tb_ylika = "vivliothiki_domika";
				$where_yliko = array(
					"AND"=>array(
						"category"=>$category[$i-1],
						"subcategory"=>$subcategory[$i-1]
					)	
				);
			}else{
				$tb_ylika = "user_domika";
				$where_yliko = array(
						"user_id"=>$_SESSION['user_id'],
				);
			}
		$yliko = $database->select($tb_ylika,$col,$where_yliko);
		$yliko_name=$yliko[$id_yliko-1]["material"];
		$yliko_l=$yliko[$id_yliko-1]["l"];
		
		$dl=$paxos[$i-1]/$yliko_l;
		$sdl+=$paxos[$i-1]/$yliko_l;
			
			$analysiu .= "
			<tr><td style=\"width: 5%;\">".$i."</td>
			<td style=\"width: 65%;\">".$yliko_name."</td>
			<td style=\"width: 10%;\">".round($paxos[$i-1],3)."</td>
			<td style=\"width: 10%;\">".round($yliko_l,3)."</td>
			<td style=\"width: 10%;\">".round($dl,3)."</td>
			</tr>";
		}
	}
	$rl=round($sdl,3);
	$ru=$array_ru[$adiafani_data["ru"]];
	$ri=$array_rira[$adiafani_data["rira"]]["ri"];
	$ra=$array_rira[$adiafani_data["rira"]]["ra"];
	if($adiafani_data["rd1"]!=0){
		$rd_values=explode("|",$array_rd[$adiafani_data["rd1"]]);
		$rd_key=($adiafani_data["rd3"]-1)*3+$adiafani_data["rd2"]-1;
		$rd=$rd_values[$rd_key];
		$txt_rd = "Τύπος:".$array_text_rd1[$adiafani_data["rd1"]]." / Ροή:".
				$array_text_rd2[$adiafani_data["rd2"]]." / ".$array_text_rd3[$adiafani_data["rd3"]];
	}else{
		$rd=0;
		$txt_rd = "Χωρίς αντιστάσεις ενδιάμεσου στρώματος αέρα";
	}
	
	$sr=$sdl+$ri+$ra+$ru+$rd;
	$umax=explode("|",$array_umax[$adiafani_data["zwni"]]);
	$umax=round($umax[$adiafani_data["rira"]-1],2);
		if($adiafani_data["u"]<=$umax){
			$umax_t = "&#8924;";
			$u_color="style=\"background-color:#cce5cc;\"";
		}else{
			$umax_t = ">";
			$u_color="style=\"background-color:#ffcccc;\"";
		}
	$analysiu .= "<tr>
	<td style=\"background-color:#eaeaea;\" colspan=\"2\">Σύνολο θερμικών αντιστάσεων στρώσεων</td>
	<td style=\"background-color:#eaeaea;\" colspan=\"2\">R<sub>Λ</sub> (Σd/λ)</td>
	<td>".round($sdl,3)."</td>
	</tr>
	<tr>
	<td style=\"background-color:#eaeaea;\" colspan=\"2\" rowspan=\"2\">Θερμικές αντιστάσεις εσωτερικά-εξωτερικά: ".
	$array_rira[$adiafani_data["rira"]]["desc"]."</td>
	<td style=\"background-color:#eaeaea;\" colspan=\"2\">R<sub>i</sub> (m<sup>2</sup>.K/W)</td>
	<td>".$ri."</td>
	</tr>
	<tr>
	<td style=\"background-color:#eaeaea;\" colspan=\"2\">R<sub>a</sub> (m<sup>2</sup>.K/W)</td>
	<td>".$ra."</td>
	</tr>
	<tr>
	<td style=\"background-color:#eaeaea;\" colspan=\"2\">Θερμικές αντιστάσεις κεραμοσκεπής:".$array_text_ru[$adiafani_data["ru"]]."</td>
	<td style=\"background-color:#eaeaea;\" colspan=\"2\">R<sub>u</sub> (m<sup>2</sup>.K/W)</td>
	<td>".$ru."</td>
	</tr>
	<tr>
	<td style=\"background-color:#eaeaea;\" colspan=\"2\">".$txt_rd."</td>
	<td style=\"background-color:#eaeaea;\" colspan=\"2\">R<sub>δ</sub> (m<sup>2</sup>.K/W)</td>
	<td>".round($rd,2)."</td>
	</tr>
	<tr>
	<td style=\"background-color:#eaeaea;\" colspan=\"2\">Σύνολο θερμικών αντιστάσεων στοιχείου</td>
	<td style=\"background-color:#eaeaea;\" colspan=\"2\">R<sub>sum</sub> - 1/U (m<sup>2</sup>.K/W)</td>
	<td>".round($sr,3)."</td>
	</tr>";
	$analysiu .= "<tr>
	<td style=\"background-color:#eaeaea;\" colspan=\"2\">Συντελεστής θερμοπερατότητας</td>
	<td style=\"background-color:#CCCCCC;\" colspan=\"2\">U (W/m<sup>2</sup>.K) ".$umax_t." U<sub>max</sub></td>
	<td ".$u_color.">".round($adiafani_data["u"],3).$umax_t.$umax."</td>
	</tr>";
	
	$img=teyxos_img_u($id);
	
	//$analysiu.="<tr><td colspan=\"5\">".$img."</td></tr>";
	$analysiu .= "</table>";
	$analysiu .= $img;
	$analysiu .= "<p style=\"page-break-before:always;\"></p>";
	
	return $analysiu;
	
}


//Εκτύπωση υπολογισμού διαφανών με βάση το $id του πίνακα user_diafani
function teyxos_diafaniu($id){
	$database = new medoo(DB_NAME);
	$col="*";
	
	$analysiu_win = "";
	
$zonename_win = array(
	0=>"Ζώνη Α",
	1=>"Ζώνη Β",
	2=>"Ζώνη Γ",
	3=>"Ζώνη Δ"
);
$umax_win = array(
	0=>3.2,
	1=>3.0,
	2=>2.8,
	3=>2.6
);
$array_plaisio_yliko= array(
	0=>0,
	1=>"Μεταλλικό πλαίσιο",
	2=>"Συνθετικό πλαίσιο",
	3=>"Ξύλινο πλαίσιο"
);
$array_plaisio_type= array(
	0=>0,
	1=>array(
		1=>" χωρίς θερμοδιακοπή",
		2=>" με θερμοδιακοπή"
	),
	2=>array(
		1=>" Πολυουρεθάνη",
		2=>" PVC - 2 θάλαμοι",
		3=>" PVC - 3 θάλαμοι",
		4=>" PVC - πολυθαλαμικό"
	),
	3=>array(
		1=>" σκληρή ξυλεία - μέσο πλάτος 5cm",
		2=>" μαλακή ξυλεία - μέσο πλάτος 5cm",
		3=>" σκληρή ξυλεία - μέσο πλάτος 10cm",
		4=>" μαλακη ξυλεία - μέσο πλάτος 10cm"
	)
);
$array_ug_ekp= array(
	0=>0,
	1=>"0.89",
	2=>"<0.10",
	3=>"<0.05"
);
$array_ug_dims= array(
	0=>0,
	1=>"4-6-4",
	2=>"4-8-4",
	3=>"4-12-4",
	4=>"4-16-4",
	5=>"4-20-4",
	6=>"4-6-4-6-4",
	7=>"4-8-4-8-4",
	8=>"4-12-4-12-4"
);
$array_ug_diak= array(
	0=>0,
	1=>"Αέρας",
	2=>"Αργό",
	3=>"Κρυπτό"
);

	$tb_userdiafani="user_diafani";
	$tb_uf="vivliothiki_uf";
	$tb_ug="vivliothiki_ug";
	$tb_ug_psi="vivliothiki_ug_psi";
	
	$where_userdiafani=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$id));
	$diafani_data = $database->select($tb_userdiafani, $col, $where_userdiafani );
	$diafani_data=$diafani_data[0];
	
	$name=$diafani_data["name"];
	$zone=$diafani_data["zwni"];
	$plaisio_uf=$diafani_data["plaisio_uf"];
	$mpp=$diafani_data["plaisio_mpp"];
	$yalo_ekp=$diafani_data["yalo_ekp"];
	$yalo_dias=$diafani_data["yalo_dias"];
	$yalo_aer=$diafani_data["yalo_aer"];
	$names=explode("|",$diafani_data["a"]);
	$aw=explode("|",$diafani_data["aw"]);
	$ah=explode("|",$diafani_data["ah"]);
	$af=explode("|",$diafani_data["af"]);
	$yw=explode("|",$diafani_data["yw"]);
	$yh=explode("|",$diafani_data["yh"]);
	$gw=explode("|",$diafani_data["gw"]);
	$uw=explode("|",$diafani_data["uw"]);
	
	//Μεταλλικό πλαίσιο
	if($plaisio_uf==1){$plaisio_yliko=1;$plaisio_type=1;}
	if($plaisio_uf==2){$plaisio_yliko=1;$plaisio_type=2;}
	//Συνθετικό πλαίσιο
	if($plaisio_uf==3){$plaisio_yliko=2;$plaisio_type=1;}
	if($plaisio_uf==4){$plaisio_yliko=2;$plaisio_type=2;}
	if($plaisio_uf==5){$plaisio_yliko=2;$plaisio_type=3;}
	if($plaisio_uf==6){$plaisio_yliko=2;$plaisio_type=4;}
	//Ξύλινο πλαίσιο
	if($plaisio_uf==7){$plaisio_yliko=3;$plaisio_type=1;}
	if($plaisio_uf==8){$plaisio_yliko=3;$plaisio_type=2;}
	if($plaisio_uf==9){$plaisio_yliko=3;$plaisio_type=3;}
	if($plaisio_uf==10){$plaisio_yliko=3;$plaisio_type=4;}
	
	$analysiu_win .= "
	<table>
	<tr>
	<td colspan=\"13\" style=\"text-align:center; background-color:#CCCCCC;\">
	Κωδ. Φύλλου ανοιγμάτων: ".$diafani_data["id"]." - Υπολογισμός: ".$diafani_data["name"]."</td>
	</tr>
	<tr>
	<td colspan=\"5\" style=\"width: 40%; background-color:#eaeaea;\">Τύπος</td>
	<td colspan=\"6\" style=\"width: 40%; background-color:#eaeaea;\">Περιγραφή</td>
	<td colspan=\"2\" style=\"width: 20%; background-color:#eaeaea;\">Τιμή</td>
	</tr>";
	
	
	//Κλιματική ζώνη - Umax
	$umax_win=$umax_win[$zone];
	$analysiu_win .= "
	<tr>
	<td colspan=\"5\">Κλιματική ζώνη (Umax)</td>
	<td colspan=\"6\">".$zonename_win[$zone]."</td>
	<td colspan=\"2\">".$umax_win."</td>
	</tr>";
	
	//Πλαίσιο - τύπος πλαισίου
	$where_uf=array("AND"=>array("plaisio_yliko"=>$plaisio_yliko,"plaisio_type"=>$plaisio_type));
	$uf_data = $database->select($tb_uf, $col, $where_uf );
	$uf=$uf_data[0]["uf"];
	
	$analysiu_win .= "
	<tr>
	<td colspan=\"5\">Τύπος πλαισίου (Uf) - Πιν. 11 ΤΟΤΕΕ-20701-2</td>
	<td colspan=\"6\">".$array_plaisio_yliko[$plaisio_yliko].$array_plaisio_type[$plaisio_yliko][$plaisio_type]." - Μέσο πλάτος:".$mpp."</td>
	<td colspan=\"2\">".$uf."</td>
	</tr>";
	
	//Υάλωση
	if($yalo_aer==1){$column_ug="air";}
	if($yalo_aer==2){$column_ug="ar";}
	if($yalo_aer==3){$column_ug="kr";}
	$where_ug=array("AND"=>array("type_ekmp"=>$yalo_ekp,"diastasi"=>$yalo_dias));
	$ug_data = $database->select($tb_ug, $col, $where_ug );
	$ug=$ug_data[0][$column_ug];
	$ekp_name=$ug_data[0]["type_yalopinakas"];
	$dias_name=$ug_data[0]["typos_yalosi"];
	if($dias_name==1){$dias_name=" (διπλή)";}
	if($dias_name==2){$dias_name=" (τριπλή)";}
	
	//Υάλωση-Συντελεστής εκπομπής
	$analysiu_win .= "
	<tr>
	<td colspan=\"5\">Συντελεστής εκπομπής (Ug) - Πιν. 12 ΤΟΤΕΕ-20701-2</td>
	<td colspan=\"6\">".$array_ug_ekp[$yalo_ekp]." - ".$ekp_name."</td>
	<td colspan=\"2\" rowspan=\"3\">".$ug."</td>
	</tr>";
	//Υάλωση-Διαστάσεις
	$analysiu_win .= "
	<tr>
	<td colspan=\"5\">Διαστάσεις</td>
	<td colspan=\"6\">".$array_ug_dims[$yalo_dias].$dias_name."</td>
	</tr>";
	//Υάλωση-Διάκενο
	$analysiu_win .= "
	<tr>
	<td colspan=\"5\">Υλικό διακένου</td>
	<td colspan=\"6\">".$array_ug_diak[$yalo_aer]."</td>
	</tr>";
	
	//Θερμογέφυρα συναρμογής πλαισίου-υαλοπίνακα
	if($plaisio_uf==1){$ug_psi_type=1;}
	if($plaisio_uf==2){$ug_psi_type=2;}
	if($plaisio_uf>=3 AND $plaisio_uf>=6){$ug_psi_type=3;}
	if($plaisio_uf>=7 AND $plaisio_uf>=10){$ug_psi_type=4;}
	
	if($yalo_ekp==1){$column_ug_psi="lowe";}
	if($yalo_ekp>1){$column_ug_psi="nolowe";}
	$where_ug_psi=array("type"=>$ug_psi_type);
	$ugpsi_data = $database->select($tb_ug_psi, $col, $where_ug_psi );
	$ug_psi=$ugpsi_data[0][$column_ug_psi];
	
	$analysiu_win .= "
	<tr>
	<td colspan=\"5\">Γραμμική θερμοπερατότητα (Ψg) - Πιν. 13 ΤΟΤΕΕ-20701-2</td>
	<td colspan=\"6\">".$array_plaisio_yliko[$plaisio_yliko].$array_plaisio_type[$plaisio_yliko][$plaisio_type]."</td>
	<td colspan=\"2\">".$ug_psi."</td>
	</tr>";
	
	
	//Ανοίγματα - Διαστάσεις - Υπολογισμός
	$analysiu_win .= "
	<tr>
	<td colspan=\"5\" style=\"width: 40%; background-color:#eaeaea;\">Άνοιγμα</td>
	<td colspan=\"3\" style=\"width: 20%; background-color:#eaeaea;\">Υαλοπίνακας</td>
	<td colspan=\"2\" style=\"width: 20%; background-color:#eaeaea;\">Πλαίσιο</td>
	<td rowspan=\"2\" style=\"width: 5%; background-color:#eaeaea;\">Ψ (Lg)</td>
	<td colspan=\"2\" style=\"width: 15%; background-color:#eaeaea;\">Χαρακτηριστικά</td>
	</tr>";
	$analysiu_win .= "
	<tr>
	<td style=\"background-color:#eaeaea;\">Όνομα</td>
	<td style=\"background-color:#eaeaea;\">l</td>
	<td style=\"background-color:#eaeaea;\">h</td>
	<td style=\"background-color:#eaeaea;\">f</td>
	<td style=\"background-color:#eaeaea;\">Esum</td>
	<td style=\"background-color:#eaeaea;\">L</td>
	<td style=\"background-color:#eaeaea;\">h</td>
	<td style=\"background-color:#eaeaea;\">Ε</td>
	<td style=\"background-color:#eaeaea;\">Ε</td>
	<td style=\"background-color:#eaeaea;\">%</td>
	<td style=\"background-color:#eaeaea;\">gw</td>
	<td style=\"background-color:#eaeaea;\">Uw</td>
	</tr>";
	
	$i=0;
	foreach($names as $name){
		if($aw[$i]!=""){
			
		$esum=$aw[$i]*$ah[$i];
		$ey=($yw[$i]*$yh[$i])*$af[$i];
		$ep=$esum-$ey;
		$epper=($ep/$esum)*100;
		$epper=round($epper,2);
		$lg=2*($yw[$i]+$yh[$i])*$af[$i];
		if($uw[$i]<=$umax_win){
			$u_color="style=\"background-color:#cce5cc;\"";
		}else{
			$u_color="style=\"background-color:#ffcccc;\"";
		}
			
		$analysiu_win .= "
		<tr>
		<td>".$name."</td>
		<td>".$aw[$i]."</td>
		<td>".$ah[$i]."</td>
		<td>".$af[$i]."</td>
		<td>".$esum."</td>
		<td>".$yw[$i]."</td>
		<td>".$yh[$i]."</td>
		<td>".$ey."</td>
		<td>".$ep."</td>
		<td>".$epper."</td>
		<td>".$lg."</td>
		<td>".$gw[$i]."</td>
		<td ".$u_color.">".$uw[$i]."</td>
		</tr>";
	
		$i++;
		}
	}
	
	$analysiu_win .= "</table>";
	
	return $analysiu_win;
	
}


//Εκτύπωση πίνακα τοίχων (γ,β,α,ε)
function teyxos_wallsbg(){
	$database = new medoo(DB_NAME);
	$tb_zones = "meletes_zones";
	$tb_walls="meletes_zone_adiafani";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$building_data = $database->select("user_meletes","*",array("id"=>$_SESSION['meleti_id']));
	$building_g = $building_data[0]["pros"];
	$txt_gbae = "";
	$array_wall_type=array(
		0=>"Σε αέρα",
		1=>"Σε ΜΘ/Ηλιακό χώρο",
		2=>"Σε έδαφος",
		3=>"Μεσοτοιχία"
	);
	
	foreach($select_zones as $zone){
		$i=1;
		$where_zone=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$zone["id"]));
		$walls = $database->select($tb_walls, $col, $where_zone );
		$count_walls = $database->count($tb_walls, $where_zone );
		
		if($count_walls>0){
		$txt_gbae .= "<table>
		<tr><td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"10\">
		Προσανατολισμός δομικών - Ζώνη ".$zone["name"]."</td></tr>
		<tr><td style=\"width: 5%; background-color:#eaeaea;\">α/α</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">Όνομα</td>
		<td style=\"width: 20%; background-color:#eaeaea;\">Επαφή</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">γ (deg)</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">β (deg)</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">α</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">ε</td>
		</tr>";
		
		foreach($walls as $wall){
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
			$wall_b=$wall["b"];
			// α/ε
			$data_ap = $database->select("vivliothiki_adiafani_a","a",array("id"=>$wall['ap']) );
			$ap=$data_ap[0];
			$data_ek = $database->select("vivliothiki_adiafani_e","e",array("id"=>$wall['ek']) );
			$ek=$data_ek[0];
			
			$txt_gbae .= "<tr>
			<td style=\"width: 5%;\">".$i."</td>
			<td style=\"width: 15%;\">".$wall["name"]."</td>
			<td style=\"width: 20%;\">".$array_wall_type[$wall["type"]]."</td>
			<td style=\"width: 15%;\">".$wall_g."</td>
			<td style=\"width: 15%;\">".$wall_b."</td>
			<td style=\"width: 15%;\">".$ap."</td>
			<td style=\"width: 15%;\">".$ek."</td>
			</tr>";
			$i++;
		
		}//για κάθε τοίχο
		
		$txt_gbae .= "</table>";
		}//Υπάρχουν τοίχοι
	}//για κάθε ζώνη

	return $txt_gbae;
	
}


//Εκτύπωση πίνακα τοίχων (Εμβαδά)
function teyxos_wallse(){
	$database = new medoo(DB_NAME);
	$tb_zones = "meletes_zones";
	$tb_walls="meletes_zone_adiafani";
	$table_windows="meletes_zone_diafani";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$txt_walls = "";
	foreach($select_zones as $zone){
		$i=1;
		$where_zone=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$zone["id"]));
		$walls = $database->select($tb_walls, $col, $where_zone );
		$count_walls = $database->count($tb_walls, $where_zone );
		
		if($count_walls>0){
		$txt_walls .= "<table>
		<tr><td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"10\">
		Εμβαδομέτρηση δομικών - Ζώνη  - ".$zone["name"]."</td></tr>
		<tr><td style=\"width: 5%; background-color:#eaeaea;\">α/α</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">Όνομα</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">Μήκος (m)</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">Ύψος (m)</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">Πάχος (m)</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">dx τρ. (m)</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">dy τρ. (m)</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">E (m<sup>2</sup>)</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">U (W/m<sup>2</sup>)</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">UxA (W/m)</td>
		</tr>";
		$zone_ua_adiafani=0;
		$zone_ua_diafani=0;
		$zone_ua=0;
		
		foreach($walls as $wall){
			
			$wall_l = $wall["l"];
			$wall_h = $wall["h"];
			$wall_d = $wall["d"];
			$wall_dy = $wall["dy"];
			$wall_dx = $wall["dx"];
			//Συντελεστές U - Χρειάζεται διόρθωση
			// u δρομικό
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
				if($wall["yp_u_id"]!=0){
					$data_yp_u = $database->select("user_adiafani","u",array("id"=>$wall['yp_u_id']) );
					$yp_u=$data_yp_u[0];
				}
			}
			// u δοκών	
			if($wall["dok_u"]!=0){
				$dok_u=$wall["dok_u"];
			}else{
				if($wall["dok_u_id"]!=0){
					$data_dok_u = $database->select("user_adiafani","u",array("id"=>$wall['dok_u_id']) );
					$dok_u=$data_dok_u[0];
				}
			}
			// u συρομένων	
			if($wall["syr_u"]!=0){
				$syr_u=$wall["syr_u"];
			}else{
				if($wall["syr_u_id"]!=0){
					$data_syr_u = $database->select("user_adiafani","u",array("id"=>$wall['syr_u_id']) );
					$syr_u=$data_syr_u[0];
				}	
			}
			
			//Εμβαδόν σύνολο
			$wall_e_sum = $wall_l*$wall_h + ($wall_l*$wall_dy)/2;
			
			$txt_walls .= "<tr>
			<td style=\"width: 5%; background-color:#f6f6f6;\">".$i."</td>
			<td style=\"width: 15%; background-color:#f6f6f6;\">Σύνολο ".$wall["name"]."</td>
			<td style=\"width: 10%; background-color:#f6f6f6;\">".$wall_l."</td>
			<td style=\"width: 10%; background-color:#f6f6f6;\">".$wall_h."</td>
			<td style=\"width: 10%; background-color:#f6f6f6;\">".$wall_d."</td>
			<td style=\"width: 10%; background-color:#f6f6f6;\">".$wall_dx."</td>
			<td style=\"width: 10%; background-color:#f6f6f6;\">".$wall_dy."</td>
			<td style=\"width: 10%; background-color:#f6f6f6;\">".$wall_e_sum."</td>
			<td style=\"width: 10%; background-color:#f6f6f6;\">-</td>
			<td style=\"width: 10%; background-color:#f6f6f6;\">-</td>
			</tr>";
			
			//Φέρων οργανισμός
			$per = $wall["per"];
			if($per==0){
				//Δοκοί	
				$data_dok = explode("^", $wall["dok"]);
				$dok_e_sum = 0;
				$dok_h_sum = 0;
					for($doki=1; $doki<=count($data_dok)-1; $doki++){
					$dok = explode("|", $data_dok[$doki-1]);
						$dok_h = $dok[0];
						$dok_ar = $dok[1];
						$dok_e = $dok_h*$wall_l;
						$dok_ua = $dok_u*$dok_e;
						$dok_e_sum += $dok_e;
						$dok_h_sum += $dok_h;
						$zone_ua_adiafani+=$dok_ua;
						
						if($dok_e!=0){
						$txt_walls .= "<tr>
						<td style=\"width: 5%;\"></td>
						<td style=\"width: 15%;\">Δοκός ".$wall["name"]."</td>
						<td style=\"width: 10%;\">".$wall_l."</td>
						<td style=\"width: 10%;\">".$dok_h."</td>
						<td style=\"width: 10%;\">".$wall_d."</td>
						<td style=\"width: 10%;\">-</td>
						<td style=\"width: 10%;\">-</td>
						<td style=\"width: 10%;\">".$dok_e."</td>
						<td style=\"width: 10%;\">".$dok_u."</td>
						<td style=\"width: 10%;\">".round($dok_ua,3)."</td>
						</tr>";
						}
					}
				
				//Υποστηλώματα
				$data_yp = explode("^", $wall["yp"]);
				$yp_e_sum = 0;
					for($ypi=1; $ypi<=(count($data_yp)-1); $ypi++){
					$yp = explode("|", $data_yp[$ypi-1]);
						$yp_l = $yp[0];
						$yp_h = ($wall_h-$dok_h_sum);
						$yp_e = $yp_l*($wall_h-$dok_h_sum);
						$yp_ua = $yp_u*$yp_e;
						$yp_e_sum += $yp_e;
						$zone_ua_adiafani+=$yp_ua;
						
						if($yp_e!=0){
						$txt_walls .= "<tr>
						<td style=\"width: 5%;\"></td>
						<td style=\"width: 15%;\">Υποστήλωμα ".$wall["name"]."</td>
						<td style=\"width: 10%;\">".$yp_l."</td>
						<td style=\"width: 10%;\">".$yp_h."</td>
						<td style=\"width: 10%;\">".$wall_d."</td>
						<td style=\"width: 10%;\">-</td>
						<td style=\"width: 10%;\">-</td>
						<td style=\"width: 10%;\">".$yp_e."</td>
						<td style=\"width: 10%;\">".$yp_u."</td>
						<td style=\"width: 10%;\">".round($yp_ua,3)."</td>
						</tr>";
						}
					}
			}
			
			//Συρόμενα
			$data_syr = explode("^", $wall["syr"]);
			$syr_e_sum = 0;
				for($syri=1; $syri<=count($data_syr)-1; $syri++){
				$syr = explode("|", $data_syr[$syri-1]);
					$syr_e = $syr[0]*$syr[1];
					$syr_ua = $syr_u*$syr_e;
					$syr_e_sum += $syr_e;
					$zone_ua_adiafani+=$syr_ua;
					
					if($syr_e!=0){
					$txt_walls .= "<tr>
					<td style=\"width: 5%;\"></td>
					<td style=\"width: 15%;\">Συρόμενο ".$wall["name"]."</td>
					<td style=\"width: 10%;\">".$syr[0]."</td>
					<td style=\"width: 10%;\">".$syr[1]."</td>
					<td style=\"width: 10%;\">".$wall_d."</td>
					<td style=\"width: 10%;\">-</td>
					<td style=\"width: 10%;\">-</td>
					<td style=\"width: 10%;\">".$syr_e."</td>
					<td style=\"width: 10%;\">".$syr_u."</td>
					<td style=\"width: 10%;\">".round($syr_ua,3)."</td>
					</tr>";
					}
				}
			
			//με ποσοστό φέρων οργανισμού
			if($per!=0){
				$dok_e_sum=0;
				$yp_e_sum=$wall_e_sum*$per/100;
				$yp_ua=$yp_u*$yp_e_sum;
				$syr_e_sum=0;
				$zone_ua_adiafani+=$yp_ua;
				
				$txt_walls .= "<tr>
				<td style=\"width: 5%;\"></td>
				<td style=\"width: 15%;\">Φέρων ".$per."%</td>
				<td style=\"width: 10%;\">-</td>
				<td style=\"width: 10%;\">-</td>
				<td style=\"width: 10%;\">".$wall_d."</td>
				<td style=\"width: 10%;\">-</td>
				<td style=\"width: 10%;\">-</td>
				<td style=\"width: 10%;\">".$yp_e_sum."</td>
				<td style=\"width: 10%;\">".$yp_u."</td>
				<td style=\"width: 10%;\">".round($yp_ua,3)."</td>
				</tr>";
			}
			
			$window_sume=0;
			//Παράθυρα
			$data_window = $database->select($table_windows,"*",array("wall_id"=>$wall['id']) );
			foreach($data_window as $window){
				$window_w=$window["w"];
				$window_h=$window["h"];
				$window_e=$window["w"]*$window["h"];
				$window_u=$window["u"];
				$window_ua=$window_u*$window_e;
				$window_sume += $window_e;
				
				if($window["u_id"]=="u_bytype" AND $window["type"]==0){//αδιαφανής πόρτα
					$zone_ua_adiafani+=$window_ua;
				}else{
					$zone_ua_diafani+=$window_ua;
				}
				
				$txt_walls .= "<tr>
				<td style=\"width: 5%;\"></td>
				<td style=\"width: 15%;\">Άνοιγμα ".$window["name"]."</td>
				<td style=\"width: 10%;\">".$window_w."</td>
				<td style=\"width: 10%;\">".$window_h."</td>
				<td style=\"width: 10%;\">-</td>
				<td style=\"width: 10%;\">-</td>
				<td style=\"width: 10%;\">-</td>
				<td style=\"width: 10%;\">".$window_e."</td>
				<td style=\"width: 10%;\">".$window_u."</td>
				<td style=\"width: 10%;\">".round($window_ua,3)."</td>
				</tr>";
			}
			
			//Καθαρό εμβαδόν τοίχου
			$wall_e_adiafanes = $wall_e_sum - $window_sume;//Ο τοίχος χωρίς παράθυρα
			$wall_e = $wall_e_sum - $syr_e_sum - $yp_e_sum - $dok_e_sum - $window_sume;//Ο τοίχος χωρίς φέρων/παράθυρα
			$u_sum = ($wall_e*$u + $syr_e_sum*$syr_u + $yp_e_sum*$yp_u + $dok_e_sum*$dok_u)/$wall_e_adiafanes;//Μέσος συντελεστής
			$wall_ua=$u*$wall_e;
			$zone_ua_adiafani+=$wall_ua;
			
			$txt_walls .= "<tr>
			<td style=\"width: 5%;\"></td>
			<td style=\"width: 15%;\">Δρομικό ".$wall["name"]."</td>
			<td style=\"width: 10%;\">-</td>
			<td style=\"width: 10%;\">-</td>
			<td style=\"width: 10%;\">".$wall_d."</td>
			<td style=\"width: 10%;\">-</td>
			<td style=\"width: 10%;\">-</td>
			<td style=\"width: 10%;\">".$wall_e."</td>
			<td style=\"width: 10%;\">".$u."</td>
			<td style=\"width: 10%;\">".round($wall_ua,3)."</td>
			</tr>";
			$i++;
		
		}//για κάθε τοίχο
		
		$zone_ua=$zone_ua_adiafani+$zone_ua_diafani;
		
		$txt_walls .= "<tr>
		<td colspan=\"9\">Zώνη: ".$zone["name"]." UxA Αδιαφανών</td>
		<td style=\"width: 10%;\">".round($zone_ua_adiafani,3)."</td>
		</tr>
		<tr>
		<td colspan=\"9\">Zώνη: ".$zone["name"]." UxA Διαφανών</td>
		<td style=\"width: 10%;\">".round($zone_ua_diafani,3)."</td>
		</tr>
		<tr>
		<td colspan=\"9\">Zώνη: ".$zone["name"]." UxA</td>
		<td style=\"width: 10%;\">".round($zone_ua,3)."</td>
		</tr>";
		$txt_walls .= "</table>";
		
		}//Υπάρχουν τοίχοι
		
	}//για κάθε ζώνη
	
	return $txt_walls;
}


//Εκτύπωση πίνακα τοίχων (θερμογέφυρες)
function teyxos_wallspsi(){
	$database = new medoo(DB_NAME);
	$tb_zones = "meletes_zones";
	$tb_walls="meletes_zone_adiafani";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$txt_wallpsi = "";
	
	$array_thermo_dbs = array(
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
		11=>"yp"
	);
	$array_thermo = array(
		0=>"ΔΑΠ:",
		1=>"ΟΡ:",
		2=>"ΥΠ:",
		3=>"ΔΟΚ:",
		4=>"ΣΥΡ:"
	);
	
	foreach($select_zones as $zone){
		$psi_zone_walls=0;
		$i=1;
		$where_zone=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$zone["id"]));
		$walls = $database->select($tb_walls, $col, $where_zone );
		$count_walls = $database->count($tb_walls, $where_zone );
		
		if($count_walls>0){
		$txt_wallpsi .= "<table>
		<tr>
		<td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"18\">
		Αναλυτικός υπολογισμός θερμογεφυρών τοιχοποιίας - Ζώνη  - ".$zone["name"]."</td></tr>
		<tr>
		<td rowspan=\"2\" style=\"width: 5%; background-color:#eaeaea;\">α/α</td>
		<td rowspan=\"2\" style=\"width: 5%; background-color:#eaeaea;\">Τοίχος</td>
		<td colspan=\"3\" style=\"width: 20%; background-color:#eaeaea;\">Δαπέδου</td>
		<td colspan=\"3\" style=\"width: 20%; background-color:#eaeaea;\">Οροφής</td>
		<td colspan=\"3\" style=\"width: 15%; background-color:#eaeaea;\">Υποστυλωμάτων</td>
		<td colspan=\"3\" style=\"width: 15%; background-color:#eaeaea;\">Δοκών</td>
		<td colspan=\"3\" style=\"width: 15%; background-color:#eaeaea;\">Συρομένων</td>
		<td rowspan=\"2\" style=\"width: 5%; background-color:#eaeaea;\">ΣΥΝ</td>
		</tr>";
		$txt_wallpsi .= "
		<tr>
		<td style=\"background-color:#eaeaea;\">Ψ</td>
		<td style=\"background-color:#eaeaea;\">L</td>
		<td style=\"background-color:#eaeaea;\">ΨxL</td>
		<td style=\"background-color:#eaeaea;\">Ψ</td>
		<td style=\"background-color:#eaeaea;\">L</td>
		<td style=\"background-color:#eaeaea;\">ΨxL</td>
		<td style=\"background-color:#eaeaea;\">Ψ</td>
		<td style=\"background-color:#eaeaea;\">L</td>
		<td style=\"background-color:#eaeaea;\">ΨxL</td>
		<td style=\"background-color:#eaeaea;\">Ψ</td>
		<td style=\"background-color:#eaeaea;\">L</td>
		<td style=\"background-color:#eaeaea;\">ΨxL</td>
		<td style=\"background-color:#eaeaea;\">Ψ</td>
		<td style=\"background-color:#eaeaea;\">L</td>
		<td style=\"background-color:#eaeaea;\">ΨxL</td>
		</tr>";
		
		foreach($walls as $wall){
			
			$wall_name = $wall["name"];
			$wall_l = $wall["l"];
			$wall_h = $wall["h"];
			$wall_d = $wall["d"];
			$wall_dy = $wall["dy"];
			$wall_dx = $wall["dx"];
			
			$psi_array = explode("^", $wall["psi"]);
			$psi_array_dap = explode("|", $psi_array[0]);
			$psi_array_or = explode("|", $psi_array[1]);
			$psi_array_dok = explode("|", $psi_array[2]);
			$psi_array_yp = explode("|", $psi_array[3]);
			$psi_array_syr = explode("|", $psi_array[4]);
			
			$tb_thermo_dap = "vivliothiki_thermo_".$array_thermo_dbs[$psi_array_dap[0]];
			$tb_thermo_or = "vivliothiki_thermo_".$array_thermo_dbs[$psi_array_or[0]];
			$tb_thermo_dok = "vivliothiki_thermo_".$array_thermo_dbs[$psi_array_dok[0]];
			$tb_thermo_yp = "vivliothiki_thermo_".$array_thermo_dbs[$psi_array_yp[0]];
			$tb_thermo_syr = "vivliothiki_thermo_".$array_thermo_dbs[$psi_array_syr[0]];
			
			$data_psi_dap = $database->select($tb_thermo_dap,"*",array("id"=>$psi_array_dap[1]) );
			$data_psi_or = $database->select($tb_thermo_or,"*",array("id"=>$psi_array_or[1]) );
			$data_psi_dok = $database->select($tb_thermo_dok,"*",array("id"=>$psi_array_dok[1]) );
			$data_psi_yp = $database->select($tb_thermo_yp,"*",array("id"=>$psi_array_yp[1]) );
			$data_psi_syr = $database->select($tb_thermo_syr,"*",array("id"=>$psi_array_syr[1]) );
			
			$psi_dap_name=$data_psi_dap[0]["name"];
			$psi_dap_y=$data_psi_dap[0]["y"];
			$psi_or_name=$data_psi_or[0]["name"];
			$psi_or_y=$data_psi_or[0]["y"];
			$psi_dok_name=$data_psi_dok[0]["name"];
			$psi_dok_y=$data_psi_dok[0]["y"];
			$psi_yp_name=$data_psi_yp[0]["name"];
			$psi_yp_y=$data_psi_yp[0]["y"];
			$psi_syr_name=$data_psi_syr[0]["name"];
			$psi_syr_y=$data_psi_syr[0]["y"];
			
			//Φέρων οργανισμός - Δοκός - Υποστύλωμα - Συρόμενα
			$per = $wall["per"];
			if($per==0){
				//Δοκοί	
				$data_dok = explode("^", $wall["dok"]);
				$psi_dok_l = 0;
				$dok_h_sum = 0;
					for($doki=1; $doki<=count($data_dok)-1; $doki++){
					$dok = explode("|", $data_dok[$doki-1]);
						$dok_h = $dok[0];
						$dok_h_sum += $dok_h;
						if($dok_h!=0){
							$psi_dok_l+=$wall_l*2;
						}
					}
				
				//Υποστηλώματα
				$data_yp = explode("^", $wall["yp"]);
				$psi_yp_l=0;
					for($ypi=1; $ypi<=(count($data_yp)-1); $ypi++){
					$yp = explode("|", $data_yp[$ypi-1]);
						$yp_l = $yp[0];
						$yp_h = ($wall_h-$dok_h_sum);
						if($yp_l!=0){
							$psi_yp_l+=$yp_h*2;
							$psi_dok_l-=$yp_l*2;
						}
					}
			}else{//Με ποσοστό φέρων
				$psi_yp_l=0;
				$psi_dok_l=0;
			}
			
				//Συρόμενα
				$data_syr = explode("^", $wall["syr"]);
				$psi_syr_l=0;
					for($syri=1; $syri<=count($data_syr)-1; $syri++){
					$syr = explode("|", $data_syr[$syri-1]);
						$syr_l = $syr[0];
						$syr_h = $syr[1];
						if($syr_l!=0){
							$psi_syr_l=2*$syr_l + 2*$syr_h;
						}
					}
			
			
			$psi_dap=$psi_dap_y*$wall_l;
			$psi_or=$psi_or_y*$wall_l;
			$psi_yp=$psi_yp_y*$psi_yp_l;
			$psi_dok=$psi_dok_y*$psi_dok_l;
			$psi_syr=$psi_syr_y*$psi_syr_l;
			$psi_wall=$psi_dap+$psi_or+$psi_yp+$psi_dok+$psi_syr;
			$psi_zone_walls+=$psi_wall;
			
			$txt_wallpsi .= "
			<tr>
			<td>".$i."</td>
			<td>".$wall_name."</td>
			<td>".$psi_dap_name."</td>
			<td>".$wall_l."</td>
			<td>".$psi_dap."</td>
			<td>".$psi_or_name."</td>
			<td>".$wall_l."</td>
			<td>".$psi_or."</td>
			<td>".$psi_yp_name."</td>
			<td>".$psi_yp_l."</td>
			<td>".$psi_yp."</td>
			<td>".$psi_dok_name."</td>
			<td>".$psi_dok_l."</td>
			<td>".$psi_dok."</td>
			<td>".$psi_syr_name."</td>
			<td>".$psi_syr_l."</td>
			<td>".$psi_syr."</td>
			<td>".$psi_wall."</td>
			</tr>";
			$i++;
		}//Για κάθε τοίχο
		
		$txt_wallpsi .= "
		<tr>
		<td colspan=\"17\">Ζώνη: ".$zone["name"]."</td>
		<td>".$psi_zone_walls."</td>
		</tr>";
		$txt_wallpsi .= "</table>";
		
		}//Εάν υπάρχουν τοίχοι στη ζώνη
		
	}//Για κάθε ζώνη

	return $txt_wallpsi;

}


//Εκτύπωση πίνακα ανοιγμάτων (θερμογέφυρες)
function teyxos_windowspsi(){
	$database = new medoo(DB_NAME);
	$tb_zones = "meletes_zones";
	$table_windows="meletes_zone_diafani";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$txt_windowpsi = "";
	
	foreach($select_zones as $zone){
		$i=1;
		$psi_zone_windows=0;
		$where_zone=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$zone["id"]));
		$windows = $database->select($table_windows, $col, $where_zone );
		$count_windows = $database->count($table_windows, $where_zone );
		
		if($count_windows>0){
		$txt_windowpsi .= "<table>
		<tr>
		<td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"9\">
		Αναλυτικός υπολογισμός θερμογεφυρών ανοιγμάτων - Ζώνη  - ".$zone["name"]."</td></tr>
		<tr>
		<td rowspan=\"2\" style=\"width: 10%; background-color:#eaeaea;\">α/α</td>
		<td rowspan=\"2\" style=\"width: 20%; background-color:#eaeaea;\">Άνοιγμα</td>
		<td colspan=\"3\" style=\"width: 30%; background-color:#eaeaea;\">Λαμπάδες</td>
		<td colspan=\"3\" style=\"width: 30%; background-color:#eaeaea;\">Ανωκάσι/Κατωκάσι</td>
		<td rowspan=\"2\" style=\"width: 10%; background-color:#eaeaea;\">Σύνολο</td>
		</tr>";
		$txt_windowpsi .= "
		<tr>
		<td style=\"background-color:#eaeaea;\">Ψ</td>
		<td style=\"background-color:#eaeaea;\">L</td>
		<td style=\"background-color:#eaeaea;\">ΨxL</td>
		<td style=\"background-color:#eaeaea;\">Ψ</td>
		<td style=\"background-color:#eaeaea;\">L</td>
		<td style=\"background-color:#eaeaea;\">ΨxL</td>
		</tr>";
		
		foreach($windows as $window){
			
			$window_name = $window["name"];
			$window_w = $window["w"];
			$window_h = $window["h"];
			$window_psi_l = $window["psi_l"];
			$window_psi_a = $window["psi_a"];
			
			$data_thermo_l = $database->select("vivliothiki_thermo_l","*",array("id"=>$window_psi_l) );
			$data_thermo_ak = $database->select("vivliothiki_thermo_ak","*",array("id"=>$window_psi_a) );
			
			$psi_lam_name=$data_thermo_l[0]["name"];
			$psi_lam=$data_thermo_l[0]["y"];
			$psi_anw_name=$data_thermo_ak[0]["name"];
			$psi_anw=$data_thermo_ak[0]["y"];
			
			$psi_lam_l=2*$window_h;
			$psi_anw_l=2*$window_w;
			
			$psi_lampas = $psi_lam_l*$psi_lam;
			$psi_anwkasi = $psi_anw_l*$psi_anw;
			$psi_window = $psi_lampas+$psi_anwkasi;
			
			$psi_zone_windows+=$psi_window;
			
			$txt_windowpsi .= "
			<tr>
			<td>".$i."</td>
			<td>".$window_name."</td>
			<td>".$psi_lam_name."</td>
			<td>".$psi_lam_l."</td>
			<td>".$psi_lampas."</td>
			<td>".$psi_anw_name."</td>
			<td>".$psi_anw_l."</td>
			<td>".$psi_anwkasi."</td>
			<td>".$psi_window."</td>
			</tr>";
			$i++;
		}//Για κάθε άνοιγμα
			$txt_windowpsi .= "
			<tr>
			<td colspan=\"8\">Ζώνη: ".$zone["name"]."</td>
			<td>".$psi_zone_windows."</td>
			</tr>";
			$txt_windowpsi .= "</table>";
		}//Εάν υπάρχουν ανοίγματα
			
	}//Για κάθε ζώνη
	
	return $txt_windowpsi;
	
}


//Εκτύπωση τιμών με τους πίνακες Fhor,ov,fin
//$type: 0:hor 1:ov 3:fin
function teyxos_wallsf($type){
	$database = new medoo(DB_NAME);
	$tb_zones = "meletes_zones";
	$tb_walls="meletes_zone_adiafani";
	$table_windows="meletes_zone_diafani";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_zones = $database->select($tb_zones, $col, $where);
	
	//ΣΚΙΑΣΕΙΣ
	$txt_fhor = "";
	$txt_fov = "";
	$txt_ffin = "";
	foreach($select_zones as $zone){
		$i=1;
		$where_zone=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$zone["id"]));
		$walls = $database->select($tb_walls, $col, $where_zone );
		$count_walls = $database->count($tb_walls, $where_zone );
		
		if($count_walls>0){
		$txt_fhor .= "<table>
		<tr><td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"7\">
		Εμπόδια ορίζοντα - Ζώνη: ".$zone["name"]."</td></tr>
		<tr><td rowspan=\"2\" style=\"width: 5%; text-align:center; background-color:#eaeaea;\">α/α</td>
		<td rowspan=\"2\" style=\"width: 20%; text-align:center; background-color:#eaeaea;\">Όνομα</td>
		<td colspan=\"5\" style=\"width: 75%; text-align:center; background-color:#eaeaea;\">Fhor</td>
		</tr>
		<tr>
		<td style=\"width: 15%; text-align:center; background-color:#eaeaea;\">Απόσταση εμποδίου (m)</td>
		<td style=\"width: 15%; text-align:center; background-color:#eaeaea;\">Ύψος εμποδίου (m)</td>
		<td style=\"width: 15%; text-align:center; background-color:#eaeaea;\">Γωνία σκίασης (deg)</td>
		<td style=\"width: 15%; text-align:center; background-color:#eaeaea;\">hor_h (-)</td>
		<td style=\"width: 15%; text-align:center; background-color:#eaeaea;\">hor_c (-)</td>
		</tr>";
		$txt_fov .= "<table>
		<tr><td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"9\">
		Εμπόδια προβόλου-τέντας - Ζώνη: ".$zone["name"]."</td></tr>
		<tr><td rowspan=\"2\" style=\"width: 5%; text-align:center; background-color:#eaeaea;\">α/α</td>
		<td rowspan=\"2\" style=\"width: 20%; text-align:center; background-color:#eaeaea;\">Όνομα</td>
		<td colspan=\"2\" style=\"width: 25%; text-align:center; background-color:#eaeaea;\">Fov</td>
		<td colspan=\"3\" style=\"width: 30%; text-align:center; background-color:#eaeaea;\">Fovt</td>
		<td colspan=\"2\" style=\"width: 20%; text-align:center; background-color:#eaeaea;\">Fov sum</td>
		</tr>
		<tr>
		<td style=\"width: 15%; text-align:center; background-color:#eaeaea;\">Μήκος προβόλου (m)</td>
		<td style=\"width: 10%; text-align:center; background-color:#eaeaea;\">Γωνία προβόλου (deg)</td>
		<td style=\"width: 10%; text-align:center; background-color:#eaeaea;\">Μήκος τέντας (m)</td>
		<td style=\"width: 10%; text-align:center; background-color:#eaeaea;\">Ύψος τέντας (m)</td>
		<td style=\"width: 10%; text-align:center; background-color:#eaeaea;\">Γωνία τέντας (deg)</td>
		<td style=\"width: 10%; text-align:center; background-color:#eaeaea;\">ov_h (-)</td>
		<td style=\"width: 10%; text-align:center; background-color:#eaeaea;\">ov_c (-)</td>
		</tr>";
		$txt_ffin .= "<table>
		<tr><td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"10\">
		Πλευρικά εμπόδια - Ζώνη: ".$zone["name"]."</td></tr>
		<tr><td rowspan=\"2\" style=\"width: 5%; text-align:center; background-color:#eaeaea;\">α/α</td>
		<td rowspan=\"2\" style=\"width: 15%; text-align:center; background-color:#eaeaea;\">Όνομα</td>
		<td colspan=\"3\" style=\"width: 30%; text-align:center; background-color:#eaeaea;\">Ffin_l</td>
		<td colspan=\"3\" style=\"width: 30%; text-align:center; background-color:#eaeaea;\">Ffin_r</td>
		<td colspan=\"2\" style=\"width: 20%; text-align:center; background-color:#eaeaea;\">Ffin sum</td>
		</tr>
		<tr>
		<td style=\"width: 10%; text-align:center; background-color:#eaeaea;\">Από. αριστερά (m)</td>
		<td style=\"width: 10%; text-align:center; background-color:#eaeaea;\">εμπόδιο αριστερά (m)</td>
		<td style=\"width: 10%; text-align:center; background-color:#eaeaea;\">Γωνία αριστερά (deg)</td>
		<td style=\"width: 10%; text-align:center; background-color:#eaeaea;\">Από. δεξιά (m)</td>
		<td style=\"width: 10%; text-align:center; background-color:#eaeaea;\">εμπόδιο δεξιά (m)</td>
		<td style=\"width: 10%; text-align:center; background-color:#eaeaea;\">Γωνία δεξιά (deg)</td>
		<td style=\"width: 10%; text-align:center; background-color:#eaeaea;\">fin_h (-)</td>
		<td style=\"width: 10%; text-align:center; background-color:#eaeaea;\">fin_c (-)</td>
		</tr>";
		
		foreach($walls as $wall){
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
			
			$f_type = $wall["f_type"];
			$data_fhor = explode("|", $wall["fhor"]);
			$data_fov = $wall["fov"];
			$data_fovt = explode("|", $wall["fovt"]);
			$data_ffin_l = explode("|", $wall["ffin_l"]);
			$data_ffin_r = explode("|", $wall["ffin_r"]);
			$data_fsh = explode("|", $wall["fsh"]);
			$pros = $wall_g;
			
			$wall_hor_ap="-";
			$wall_hor_h="-";
			$wall_hor_deg="-";
			
			$wall_ov_l="-";
			$wall_ov_deg="-";
			$wall_ovt_l="-";
			$wall_ovt_h="-";
			$wall_ovt_deg="-";
			
			$wall_finl_ap="-";
			$wall_finl_l="-";
			$wall_finl_deg="-";
			$wall_finr_ap="-";
			$wall_finr_l="-";
			$wall_finr_deg="-";
			
			if($f_type==0){
				//Σκίαση ορίζοντα
				if( $data_fhor[1]!=0 ){
					$fhor_deg = atan(($data_fhor[1]-$wall["h"]/2) / $data_fhor[0])*180/pi();
					$fhor = calc_skiasi_hor($fhor_deg, $pros);
					$fhor_h = $fhor[0];
					$fhor_c = $fhor[1];
					
					$wall_hor_ap=$data_fhor[0];
					$wall_hor_h=$data_fhor[1];
					$wall_hor_deg=round($fhor_deg,2);
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
					
					$wall_ov_l=$data_fov;
					$wall_ov_deg=round($fov_deg,2);
				}else{
					$fov_h = 1;
					$fov_c = 1;
				}
				
				//Πλευρικές σκιάσεις
				if( $data_ffin_l[1]!=0 ){
					$ffin_l_deg = atan( $data_ffin_l[1] / ($data_ffin_l[0]+$wall["l"]/2) )*180/pi();
					$ffin_l = calc_skiasi_fin($ffin_l_deg, $pros, 1);
					$ffin_l_h = $ffin_l[0];
					$ffin_l_c = $ffin_l[1];
					
					$wall_finl_ap=$data_ffin_l[0];
					$wall_finl_l=$data_ffin_l[1];
					$wall_finl_deg=round($ffin_l_deg,2);
				}else{
					$ffin_l_h = 1;
					$ffin_l_c = 1;
				}
				if( $data_ffin_r[1]!=0 ){
					$ffin_r_deg = atan( $data_ffin_r[1] / ($data_ffin_r[0]+$wall["l"]/2) )*180/pi();
					$ffin_r = calc_skiasi_fin($ffin_r_deg, $pros, 2);
					$ffin_r_h = $ffin_r[0];
					$ffin_r_c = $ffin_r[1];
					
					$wall_finr_ap=$data_ffin_r[0];
					$wall_finr_l=$data_ffin_r[1];
					$wall_finr_deg=round($ffin_r_deg,2);
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
			
			
		$txt_fhor .= "<tr>
		<td style=\"width: 5%; text-align:center;\">".$i."</td>
		<td style=\"width: 20%; text-align:center;\">".$wall["name"]."</td>
		<td style=\"width: 15%; text-align:center;\">".$wall_hor_ap."</td>
		<td style=\"width: 15%; text-align:center;\">".$wall_hor_h."</td>
		<td style=\"width: 15%; text-align:center;\">".$wall_hor_deg."</td>
		<td style=\"width: 15%; text-align:center;\">".$fhor_h."</td>
		<td style=\"width: 15%; text-align:center;\">".$fhor_c."</td>
		</tr>";
		
		$txt_fov .= "<tr>
		<td style=\"width: 5%; text-align:center;\">".$i."</td>
		<td style=\"width: 20%; text-align:center;\">".$wall["name"]."</td>
		<td style=\"width: 15%; text-align:center;\">".$wall_ov_l."</td>
		<td style=\"width: 10%; text-align:center;\">".$wall_ov_deg."</td>
		<td style=\"width: 10%; text-align:center;\">".$wall_ovt_l."</td>
		<td style=\"width: 10%; text-align:center;\">".$wall_ovt_h."</td>
		<td style=\"width: 10%; text-align:center;\">".$wall_ovt_deg."</td>
		<td style=\"width: 10%; text-align:center;\">".$fov_h."</td>
		<td style=\"width: 10%; text-align:center;\">".$fov_c."</td>
		</tr>";
		
		$txt_ffin .= "<tr>
		<td style=\"width: 5%; text-align:center;\">".$i."</td>
		<td style=\"width: 15%; text-align:center;\">".$wall["name"]."</td>
		<td style=\"width: 10%; text-align:center;\">".$wall_finl_ap."</td>
		<td style=\"width: 10%; text-align:center;\">".$wall_finl_l."</td>
		<td style=\"width: 10%; text-align:center;\">".$wall_finl_deg."</td>
		<td style=\"width: 10%; text-align:center;\">".$wall_finr_ap."</td>
		<td style=\"width: 10%; text-align:center;\">".$wall_finr_l."</td>
		<td style=\"width: 10%; text-align:center;\">".$wall_finr_deg."</td>
		<td style=\"width: 10%; text-align:center;\">".$ffin_h."</td>
		<td style=\"width: 10%; text-align:center;\">".$ffin_c."</td>
		</tr>";
		
		$i++;
		}//για κάθε τοίχο
		
		$txt_fhor .= "</table>";
		$txt_fov .= "</table>";
		$txt_ffin .= "</table>";
		}//Υπάρχουν τοίχοι
	}//για κάθε ζώνη
	
	if($type==0){return $txt_fhor;}
	if($type==1){return $txt_fov;}
	if($type==2){return $txt_ffin;}
}


//Εκτύπωση πίνακα φυσικού αερισμού ζώνης
function teyxos_zoneswind(){
	$database = new medoo(DB_NAME);
	$tb_zones = "meletes_zones";
	$table_windows="meletes_zone_diafani";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$f14 = "<table>";
	$i=1;
	$wind_building=0;
	foreach($select_zones as $zone){
		$wind_zone=0;
		$where_zone=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$zone["id"]));
		$windows = $database->select($table_windows, $col, $where_zone );
		$count_windows = $database->count($table_windows, $where_zone );
		
		$f14 .= "
		<tr><td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"7\">
		Φυσικός αερισμός- Ζώνη: ".$zone["name"]."</td></tr>
		<tr><td style=\"width: 5%; background-color:#eaeaea;\">α/α</td>
		<td style=\"width: 25%; background-color:#eaeaea;\">Άνοιγμα</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">Μήκος (m)</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">Ύψος (m)</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">Εμβαδό (m<sup>2</sup>)</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">Συντελεστής αερισμού (m<sup>3</sup>/h/m<sup>2</sup>)</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">ΣΥΝ (m<sup>3</sup>/h)</td>
		</tr>";
		
		foreach($windows as $window){
			$window_e=$window["w"]*$window["h"];
			$wind_window=$window_e*$window["wind"];
			$wind_zone+=$wind_window;
			$f14 .= "
			<tr>
			<td>".$i."</td>
			<td>".$window["name"]."</td>
			<td>".$window["w"]."</td>
			<td>".$window["h"]."</td>
			<td>".$window_e."</td>
			<td>".$window["wind"]."</td>
			<td>".$wind_window."</td>
			</tr>";
			$i++;
		}//για κάθε άνοιγμα
		$f14 .= "
		<tr>
		<td colspan=\"6\">Ζώνη: ".$zone["name"]."</td>
		<td>".$wind_zone."</td>
		</tr>";
		$wind_building+=$wind_zone;
	}//για κάθε ζώνη
	$f14 .= "
	<tr>
	<td colspan=\"6\">Σύνολο κτιρίου</td>
	<td>".$wind_building."</td>
	</tr>";
	$f14 .= "</table>";
	
	return $f14;
}


//Εκτύπωση πίνακα φυσικού φωτισμού ζώνης
function teyxos_zoneslight(){
	$database = new medoo(DB_NAME);
	$tb_zones = "meletes_zones";
	$table_windows="meletes_zone_diafani";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$f15 = "<table>";
	$i=1;
	$light_building=0;
	foreach($select_zones as $zone){
		$light_zone=0;
		$where_zone=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$zone["id"]));
		$windows = $database->select($table_windows, $col, $where_zone );
		$count_windows = $database->count($table_windows, $where_zone );
		
		if($count_windows>0){
		$f15 .= "
		<tr><td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"7\">
		Φυσικός φωτισμός- Ζώνη: ".$zone["name"]."</td></tr>
		<tr><td style=\"width: 5%; background-color:#eaeaea;\">α/α</td>
		<td style=\"width: 25%; background-color:#eaeaea;\">Άνοιγμα</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">Μήκος (m)</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">Ύψος (m)</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">Βάθος ζώνης φωτισμού L<sub>ΖΦΦ</sub> / 
		Διάμετρος D<sub>ΖΦΦ</sub> (m)</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">Πλάτος ζώνης φωτισμού 
		W<sub>ΖΦΦ</sub> (m)</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">Elight (m<sup>2</sup>)</td>
		</tr>";
		
		foreach($windows as $window){
			$window_w=$window["w"];
			$window_h=$window["h"];
			$window_p=$window["p"];
			if($window["roof_id"]!=0){
				$window_type="Οροφής";
				$window_lzff = $window_w + 2*(3-1)*tan(30*(180/M_PI));
				$window_wzff = "-";
				$window_ezff = M_PI*pow(($window_lzff/2),2);
			}
			if($window["wall_id"]!=0){
				$window_type="Κατακόρυφο";
				$window_lzff = 2.5*($window_h+$window_p-1);
				$window_wzff = $window_w + 0.5*$window_lzff;
				$window_ezff = $window_lzff*$window_wzff;
			}
			
			$light_zone+=$window_ezff;
			
			$f15 .= "
			<tr>
			<td>".$i."</td>
			<td>".$window["name"]." - [".$window_type."]</td>
			<td>".$window_w."</td>
			<td>".$window_h."</td>
			<td>".round($window_lzff,2)."</td>
			<td>".round($window_wzff,2)."</td>
			<td>".round($window_ezff,2)."</td>
			</tr>";
			
			$i++;
		}//για κάθε άνοιγμα
		
		$zone_dims=teyxos_zone_ev($zone["id"]);
		$zone_e=$zone_dims[0];
		$zone_v=$zone_dims[1];
		$light_zone_per = round(($light_zone/$zone_e)*100,2);
		
		$f15 .= "
		<tr>
		<td colspan=\"6\">Ζώνη: ".$zone["name"]." - Ε=".$zone_e.".m<sup>2</sup></td>
		<td>".round($light_zone,2)." / ".round($light_zone_per,2)."%</td>
		</tr>";
		
		$light_building+=$light_zone;
		}
		
	}//για κάθε ζώνη
	$f15 .= "
	<tr>
	<td colspan=\"6\">Σύνολο κτιρίου</td>
	<td>".round($light_building,2)."</td>
	</tr>";
	$f15 .= "</table><br/>";
	/*
	$f15 .= "<p>Θεωρείται ύψος επιφάνειας εργασίας = 1m και ύψος χώρου 3m ενώ τα σχεδιαγράμματα 
	υπολογισμού δίνονται ενδεικτικά παρακάω:<br/>
	Βάθος ζώνης φωτισμού: L<sub>ΖΦΦ</sub>=2,5 x h<sub>ΖΦΦ</sub>=2,5 x (h<sub>Π</sub>-h<sub>ΕΕ</sub>) (m)<br/>
	Πλάτος ζώνης φωτισμού: W<sub>ΖΦΦ</sub>=W<sub>Π</sub> + 0,5 x L<sub>ΖΦΦ</sub> (m)<br/>
	Διάμετρος ζώνης φωτισμού (οροφής): D<sub>ΖΦΦ</sub>=W<sub>ΑΟ</sub> + 2 x (h<sub>K</sub> - h<sub>EE</sub>) x εφ(30<sup>o</sup>) (m)<br/></p>";
	*/
	$f15 .= "<p><img src=\"".APPLICATION_FOLDER."images/style/light_platos.png\"></img><br/>";
	$f15 .= "<img src=\"".APPLICATION_FOLDER."images/style/light_orofis.png\"></img><br/></p>";
	
	return $f15;
}


//Εκτύπωση πίνακα U αδιαφανών
//type: 1: Επαφή σε άερα, 2: Επαφή με ΜΘΧ, 3: Επαφή σε έδαφος
function teyxos_adiafani_u($type=1){
	$database = new medoo(DB_NAME);
	$col = "*";
	
	//Γενικά στοιχεία μελέτης
	$where_meleti=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$tb_meleti = "user_meletes";
	$select_meleti = $database->select($tb_meleti, $col, $where_meleti);
	$zwni = $select_meleti[0]["zone"];
	
	//Στοιχεία ζώνης
	$tb_zones = "meletes_zones";
	$tb_walls="meletes_zone_adiafani";
	$table_windows="meletes_zone_diafani";
	$tb_zone_dapeda = "meletes_zone_dapeda";
	$tb_zone_orofes = "meletes_zone_orofes";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$txt_walls = "";
	
	$tb_umax = "vivliothiki_umax";
	$where_umax_wall = array("type"=>"wall".$type);
	$where_umax_daporo = array("type"=>"daporo".$type);
	$where_umax_win = array("type"=>"win");
	if($zwni==0){$col_umax="a";}
	if($zwni==1){$col_umax="b";}
	if($zwni==2){$col_umax="c";}
	if($zwni==3){$col_umax="d";}
	$umax_wall = $database->select($tb_umax, $col_umax, $where_umax_wall);
	$umax_wall=$umax_wall[0];
	$umax_daporo = $database->select($tb_umax, $col_umax, $where_umax_wall);
	$umax_daporo=$umax_daporo[0];
	$umax_win = $database->select($tb_umax, $col_umax, $where_umax_win);
	$umax_win=$umax_win[0];
	
	$u_color_green="style=\"background-color:#cce5cc;\"";
	$u_color_red="style=\"background-color:#ffcccc;\"";

	foreach($select_zones as $zone){
		
		$zone_ua_adiafani=0;
		$zone_ua_diafani=0;
		$zone_orizontia_ua=0;
		$zone_ua=0;
		
		if($type==1){
			$table_desc="U δομικών στοιχείων σε αέρα";
			$epafi="Σε αέρα";
		}
		if($type==2){
			$table_desc="U' δομικών στοιχείων σε ΜΘΧ";
			$epafi="Σε ΜΘΧ";
		}
		if($type==3){
			$table_desc="U' δομικών στοιχείων σε έδαφος";
			$epafi="Σε Έδαφος";
		}
		
		$txt_walls .= "<table>
		<tr><td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"9\">
		".$table_desc." - Ζώνη  - ".$zone["name"]."</td></tr>
		<tr><td style=\"width: 10%; background-color:#eaeaea;\">α/α</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">Στοιχείο</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">Όνομα</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">Επαφή</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">Εμβαδόν (m<sup>2</sup>)</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">U (W/m<sup>2</sup>)</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">U<sub>max</sub> (W/m<sup>2</sup>)</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">U' (W/m<sup>2</sup>)</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">U'xA (W/m)</td>
		</tr>";
		
		if($type==1){
			$type_wall=0;
		}
		if($type==2){
			$type_wall=1;
		}
		if($type==3){
			$type_wall=2;
		}
		
		$i=1;
		$where_walls=array(
			"AND"=>array(
				"user_id"=>$_SESSION['user_id'],
				"meleti_id"=>$_SESSION['meleti_id'],
				"zone_id"=>$zone["id"],
				"type"=>$type_wall
			)
		);
		$walls = $database->select($tb_walls, $col, $where_walls );
		$count_walls = $database->count($tb_walls, $where_walls );
		
		if($count_walls>0){
		
		foreach($walls as $wall){
			
			$wall_l = $wall["l"];
			$wall_h = $wall["h"];
			$wall_d = $wall["d"];
			$wall_dy = $wall["dy"];
			$wall_dx = $wall["dx"];
			
			//Συντελεστές U - Χρειάζεται διόρθωση
			// u δρομικό
			if($wall["u"]!=0){
				$u=$wall["u"];
			}else{
				$data_u = $database->select("user_adiafani","u",array("id"=>$wall['u_id']) );
				$u=$data_u[0];
			}
			if($u<=$umax_wall){
				$color_dr=$u_color_green;
			}else{
				$color_dr=$u_color_red;
			}
			
			// u υποστυλωμάτων
			if($wall["yp_u"]!=0){
				$yp_u=$wall["yp_u"];
			}else{
				if($wall["yp_u_id"]!=0){
					$data_yp_u = $database->select("user_adiafani","u",array("id"=>$wall['yp_u_id']) );
					$yp_u=$data_yp_u[0];
				}
			}
			if($yp_u<=$umax_wall){
				$color_yp=$u_color_green;
			}else{
				$color_yp=$u_color_red;
			}
			
			// u δοκών	
			if($wall["dok_u"]!=0){
				$dok_u=$wall["dok_u"];
			}else{
				if($wall["dok_u_id"]!=0){
					$data_dok_u = $database->select("user_adiafani","u",array("id"=>$wall['dok_u_id']) );
					$dok_u=$data_dok_u[0];
				}
			}
			if($dok_u<=$umax_wall){
				$color_dok=$u_color_green;
			}else{
				$color_dok=$u_color_red;
			}
			
			// u συρομένων	
			if($wall["syr_u"]!=0){
				$syr_u=$wall["syr_u"];
			}else{
				if($wall["syr_u_id"]!=0){
					$data_syr_u = $database->select("user_adiafani","u",array("id"=>$wall['syr_u_id']) );
					$syr_u=$data_syr_u[0];
				}	
			}
			if($syr_u<=$umax_wall){
				$color_syr=$u_color_green;
			}else{
				$color_syr=$u_color_red;
			}
			
			if($type==1){
				$uis=$u;
				$dok_uis=$dok_u;
				$yp_uis=$yp_u;
				$syr_uis=$syr_u;
			}
			if($type==2){
				$b=0.5;
				$uis=$u*$b;
				$dok_uis=$dok_u*$b;
				$yp_uis=$yp_u*$b;
				$syr_uis=$syr_u*$b;
			}
			if($type==3){
				$z1=$wall['z1'];
				$z2=$wall['z2'];
				$uis=isodynamos_katakoryfoy($u, $z1, $z2);
				$dok_uis=isodynamos_katakoryfoy($dok_u, $z1, $z2);
				$yp_uis=isodynamos_katakoryfoy($yp_u, $z1, $z2);
				$syr_uis=isodynamos_katakoryfoy($syr_u, $z1, $z2);
			}
			
			//Εμβαδόν σύνολο
			$wall_e_sum = $wall_l*$wall_h + ($wall_l*$wall_dy)/2;
			
			//Φέρων οργανισμός
			$per = $wall["per"];
			if($per==0){
				//Δοκοί	
				$data_dok = explode("^", $wall["dok"]);
				$dok_e_sum = 0;
				$dok_h_sum = 0;
					for($doki=1; $doki<=count($data_dok)-1; $doki++){
					$dok = explode("|", $data_dok[$doki-1]);
						$dok_h = $dok[0];
						$dok_ar = $dok[1];
						$dok_e = $dok_h*$wall_l;
						$dok_ua = $dok_uis*$dok_e;
						$dok_e_sum += $dok_e;
						$dok_h_sum += $dok_h;
						$zone_ua_adiafani+=$dok_ua;
						
						if($dok_e!=0){
						$txt_walls .= "<tr>
						<td></td>
						<td>Τοίχος</td>
						<td>Δοκός ".$wall["name"]."</td>
						<td>".$epafi."</td>
						<td>".$dok_e."</td>
						<td ".$color_dok.">".round($dok_u,3)."</td>
						<td>".$umax_wall."</td>
						<td>".round($dok_uis,3)."</td>
						<td>".round($dok_ua,3)."</td>
						</tr>";
						}
					}
				
				//Υποστηλώματα
				$data_yp = explode("^", $wall["yp"]);
				$yp_e_sum = 0;
					for($ypi=1; $ypi<=(count($data_yp)-1); $ypi++){
					$yp = explode("|", $data_yp[$ypi-1]);
						$yp_l = $yp[0];
						$yp_h = ($wall_h-$dok_h_sum);
						$yp_e = $yp_l*($wall_h-$dok_h_sum);
						$yp_ua = $yp_uis*$yp_e;
						$yp_e_sum += $yp_e;
						$zone_ua_adiafani+=$yp_ua;
						
						if($yp_e!=0){
						$txt_walls .= "<tr>
						<td></td>
						<td>Τοίχος</td>
						<td>Υποστύλωμα ".$wall["name"]."</td>
						<td>".$epafi."</td>
						<td>".$yp_e."</td>
						<td ".$color_yp.">".round($yp_u,3)."</td>
						<td>".$umax_wall."</td>
						<td>".round($yp_uis,3)."</td>
						<td>".round($yp_ua,3)."</td>
						</tr>";
						}
					}
			}
			
			//Συρόμενα
			$data_syr = explode("^", $wall["syr"]);
			$syr_e_sum = 0;
				for($syri=1; $syri<=count($data_syr)-1; $syri++){
				$syr = explode("|", $data_syr[$syri-1]);
					$syr_e = $syr[0]*$syr[1];
					$syr_ua = $syr_uis*$syr_e;
					$syr_e_sum += $syr_e;
					$zone_ua_adiafani+=$syr_ua;
					
					if($syr_e!=0){
					$txt_walls .= "<tr>
						<td></td>
						<td>Τοίχος</td>
						<td>Με διάκενο ".$wall["name"]."</td>
						<td>".$epafi."</td>
						<td>".$syr_e."</td>
						<td ".$color_syr.">".round($syr_u,3)."</td>
						<td>".$umax_wall."</td>
						<td>".round($syr_uis,3)."</td>
						<td>".round($syr_ua,3)."</td>
						</tr>";
					}
				}
			
			//με ποσοστό φέρων οργανισμού
			if($per!=0){
				$dok_e_sum=0;
				$yp_e_sum=$wall_e_sum*$per/100;
				$yp_ua=$yp_uis*$yp_e_sum;
				$syr_e_sum=0;
				$zone_ua_adiafani+=$yp_ua;
				
				$txt_walls .= "<tr>
					<td></td>
					<td>Τοίχος</td>
					<td>Φέρων ".$wall["name"]."</td>
					<td>".$epafi."</td>
					<td>".$yp_e_sum."</td>
					<td ".$color_yp.">".round($yp_u,3)."</td>
					<td>".$umax_wall."</td>
					<td>".round($yp_uis,3)."</td>
					<td>".round($yp_ua,3)."</td>
					</tr>";
			}
			
			$window_sume=0;
			//Παράθυρα
			$data_window = $database->select($table_windows,"*",array("wall_id"=>$wall['id']) );
			foreach($data_window as $window){
				if($window["u_id"]=="u_bytype" AND $window["type"]==0){//αδιαφανής πόρτα
				$window_w=$window["w"];
				$window_h=$window["h"];
				$window_e=$window["w"]*$window["h"];
				$window_u=$window["u"];
				if($type==1){
					$window_uis=$window_u;
				}
				if($type==2){
					$b=0.5;
					$window_uis=$window_u*$b;
				}
				if($type==3){
					$b=0.5;
					$window_uis=$window_u*$b;
				}
				$window_ua=$window_uis*$window_e;
				$window_sume += $window_e;
				$zone_ua_adiafani+=$window_ua;
				
				if($window_u<=$umax_win){
					$color_win=$u_color_green;
				}else{
					$color_win=$u_color_red;
				}
				
				$txt_walls .= "<tr>
					<td></td>
					<td>Άνοιγμα</td>
					<td>".$window["name"]."</td>
					<td>".$epafi."</td>
					<td>".$window_e."</td>
					<td ".$color_win.">".round($window_u,3)."</td>
					<td>".$umax_win."</td>
					<td>".round($window_uis,3)."</td>
					<td>".round($window_ua,3)."</td>
					</tr>";
				}
			}
			
			//Καθαρό εμβαδόν τοίχου
			$wall_e_adiafanes = $wall_e_sum - $window_sume;//Ο τοίχος χωρίς παράθυρα
			$wall_e = $wall_e_sum - $syr_e_sum - $yp_e_sum - $dok_e_sum - $window_sume;//Ο τοίχος χωρίς φέρων/παράθυρα
			$u_sum = ($wall_e*$u + $syr_e_sum*$syr_u + $yp_e_sum*$yp_u + $dok_e_sum*$dok_u)/$wall_e_adiafanes;//Μέσος συντελεστής
			$wall_ua=$uis*$wall_e;
			$zone_ua_adiafani+=$wall_ua;
			
			$txt_walls .= "<tr>
				<td>".$i."</td>
				<td>Τοίχος</td>
				<td>Δρομικό ".$wall["name"]."</td>
				<td>".$epafi."</td>
				<td>".$wall_e."</td>
				<td ".$color_dr.">".round($u,3)."</td>
				<td>".$umax_wall."</td>
				<td>".round($uis,3)."</td>
				<td>".round($wall_ua,3)."</td>
				</tr>";
			$i++;
		
		}//για κάθε τοίχο
		
		}//Υπάρχουν τοίχοι
		
		//ΔΑΠΕΔΑ ΖΩΝΗΣ
		if($type==1){
			$type_dap=2;
		}
		if($type==2){
			$type_dap=1;
		}
		if($type==3){
			$type_dap=0;
		}
		$where_dapeda=array(
			"AND"=>array(
				"user_id"=>$_SESSION['user_id'],
				"meleti_id"=>$_SESSION['meleti_id'],
				"zone_id"=>$zone["id"],
				"type"=>$type_dap
			)
		);
		$select_zone_dapeda = $database->select($tb_zone_dapeda, $col, $where_dapeda);
		$count_zone_dapeda = $database->count($tb_zone_dapeda, $where_dapeda);
		if($count_zone_dapeda!=0){
			foreach($select_zone_dapeda as $dapeda){
				
				if($dapeda["u"]!=0){
					$dapeda_u=$dapeda["u"];
				}else{
					$dapeda_u_data = $database->select("user_adiafani","u",array("id"=>$dapeda["u_id"]) );
					$dapeda_u=$dapeda_u_data[0];
				}
				
				if($type==1){
					$b=1;
					$dapeda_uis=$dapeda_u;
				}
				if($type==2){
					$b=0.5;
					$dapeda_uis=$dapeda_u*$b;
				}
				if($type==3){
					$z=$dapeda['z'];
					$xar=2*$dapeda["e"]/$dapeda['p'];
					$dapeda_uis=isodynamos_dapedoy($dapeda_u, $z, $xar);
				}
				
				$dapeda_ua=$dapeda_uis*$dapeda["e"];
				$zone_orizontia_ua+=$dapeda_ua;
				
				if($dapeda_u<=$umax_daporo){
					$color_dap=$u_color_green;
				}else{
					$color_dap=$u_color_red;
				}
				
				$txt_walls .= "<tr>
				<td>".$i."</td>
				<td>Δάπεδο</td>
				<td>".$dapeda["name"]."</td>
				<td>".$epafi."</td>
				<td>".$dapeda["e"]."</td>
				<td ".$color_dap.">".round($dapeda_u,3)."</td>
				<td>".$umax_daporo."</td>
				<td>".round($dapeda_uis,3)."</td>
				<td>".round($dapeda_ua,3)."</td>
				</tr>";
				
				$i++;
			}//Για κάθε δάπεδο
			
		}//Υπάρχουν δάπεδα
		
		//ΟΡΟΦΕΣ ΖΩΝΗΣ
		if($type==1){
			$type_or=0;
		}
		if($type==2){
			$type_or=1;
		}
		if($type==3){
			$type_or=2;
		}
		$where_orofes=array(
			"AND"=>array(
				"user_id"=>$_SESSION['user_id'],
				"meleti_id"=>$_SESSION['meleti_id'],
				"zone_id"=>$zone["id"],
				"type"=>$type_or
			)
		);
		$select_zone_orofes = $database->select($tb_zone_orofes, $col, $where_orofes);
		$count_zone_orofes = $database->count($tb_zone_orofes, $where_orofes);
		if($count_zone_orofes!=0){
			foreach($select_zone_orofes as $orofes){
				if($orofes["u"]!=0){
					$orofes_u=$orofes["u"];
				}else{
					$orofes_u_data = $database->select("user_adiafani","u",array("id"=>$orofes["u_id"]) );
					$orofes_u=$orofes_u_data[0];
				}
				
				if($type==1){
					$b=1;
					$orofes_uis=$orofes_u;
				}
				if($type==2){
					$b=0.5;
					$orofes_uis=$orofes_u*$b;
				}
				if($type==3){
					$b=0.5;
					$orofes_uis=$orofes_u*$b;
				}
				
				$window_sume=0;
				//Παράθυρα οροφών
				$data_windowor = $database->select($table_windows,"*",array("roof_id"=>$orofes['id']) );
				foreach($data_windowor as $window){
					$window_name=$window["name"];
					$window_w=$window["w"];
					$window_h=$window["h"];
					$window_e=$window["w"]*$window["h"];
					$window_u=$window["u"];
					
					$window_sume+=$window_e;
					
					if($window["u_id"]=="u_bytype" AND $window["type"]==0){//αδιαφανής πόρτα
					$window_ub=$window_u*$b;
					$window_ua=$window_ub*$window_e;
					$zone_orizontia_ua+=$window_ua;
						
						if($window_u<=$umax_win){
							$color_orwin=$u_color_green;
						}else{
							$color_orwin=$u_color_red;
						}
					$txt_walls .= "<tr>
					<td>".$i."</td>
					<td>Άνοιγμα οροφής (αδιαφανές)</td>
					<td>".$window_name."</td>
					<td>".$epafi."</td>
					<td>".$window_e."</td>
					<td ".$color_orwin.">".round($window_u,3)."</td>
					<td>".$umax_win."</td>
					<td>".round($window_ub,3)."</td>
					<td>".round($window_ua,3)."</td>
					</tr>";
					$i++;
					}
				}//Παράθυρα οροφών
				
				$roof_e=0;
				$roof_e=$orofes["e"]-$window_sume;
				
				$orofes_ua=$orofes_uis*$roof_e;
				$zone_orizontia_ua+=$orofes_ua;
				
				if($orofes_u<=$umax_daporo){
					$color_or=$u_color_green;
				}else{
					$color_or=$u_color_red;
				}
				
				$txt_walls .= "<tr>
				<td>".$i."</td>
				<td>Οροφή</td>
				<td>".$orofes["name"]."</td>
				<td>".$epafi."</td>
				<td>".$roof_e."</td>
				<td ".$color_or.">".round($orofes_u,3)."</td>
				<td>".$umax_daporo."</td>
				<td>".round($orofes_uis,3)."</td>
				<td>".round($orofes_ua,3)."</td>
				</tr>";
				
				$i++;
			}//για κάθε οροφή
		}//Υπάρχουν οροφές
		
		$zone_ua=$zone_ua_adiafani+$zone_orizontia_ua;
		
		$txt_walls .= "<tr>
		<td style=\"text-align:left;\" colspan=\"8\">Zώνη: ".$zone["name"]." UxA Κατακόρυφων αδιαφανών</td>
		<td style=\"width: 10%;\">".round($zone_ua_adiafani,2)."</td>
		</tr>
		<tr>
		<td style=\"text-align:left;\" colspan=\"8\">Zώνη: ".$zone["name"]." UxA οριζόντιων αδιαφανών</td>
		<td style=\"width: 10%;\">".round($zone_orizontia_ua,2)."</td>
		</tr>
		<tr>
		<td style=\"text-align:left;\" colspan=\"8\">Zώνη: ".$zone["name"]." UxA [".$epafi."]</td>
		<td style=\"width: 10%;\">".round($zone_ua,2)."</td>
		</tr>";
		$txt_walls .= "</table>";
		
	}//για κάθε ζώνη
	
	return $txt_walls;
}


//Εκτύπωση πίνακα U αδιαφανών
function teyxos_diafani_u(){
	$database = new medoo(DB_NAME);
	$col = "*";
	
	$epafi="Σε αέρα";
	
	//Γενικά στοιχεία μελέτης
	$where_meleti=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$tb_meleti = "user_meletes";
	$select_meleti = $database->select($tb_meleti, $col, $where_meleti);
	$zwni = $select_meleti[0]["zone"];
	
	//Στοιχεία ζώνης
	$tb_zones = "meletes_zones";
	$table_windows="meletes_zone_diafani";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$txt_win = "";
	
	$tb_umax = "vivliothiki_umax";
	$where_umax_win = array("type"=>"win");
	if($zwni==0){$col_umax="a";}
	if($zwni==1){$col_umax="b";}
	if($zwni==2){$col_umax="c";}
	if($zwni==3){$col_umax="d";}
	$umax_win = $database->select($tb_umax, $col_umax, $where_umax_win);
	$umax_win=$umax_win[0];
	
	$u_color_green="style=\"background-color:#cce5cc;\"";
	$u_color_red="style=\"background-color:#ffcccc;\"";

	foreach($select_zones as $zone){
		$zone_ua_diafani=0;
		
		$txt_win .= "<table>
		<tr><td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"8\">
		U ανοιγμάτων - Ζώνη  - ".$zone["name"]."</td></tr>
		<tr><td style=\"width: 10%; background-color:#eaeaea;\">α/α</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">Στοιχείο</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">Όνομα</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">Επαφή</td>
		<td style=\"width: 15%; background-color:#eaeaea;\">Εμβαδόν (m<sup>2</sup>)</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">U (W/m<sup>2</sup>)</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">U<sub>max</sub> (W/m<sup>2</sup>)</td>
		<td style=\"width: 10%; background-color:#eaeaea;\">UxA (W/m)</td>
		</tr>";
		
		$i=1;
		$window_sume=0;
		//Παράθυρα
		$data_window = $database->select($table_windows,"*",array("zone_id"=>$zone['id']) );
		foreach($data_window as $window){
			$window_w=$window["w"];
			$window_h=$window["h"];
			$window_e=$window["w"]*$window["h"];
			$window_u=$window["u"];
			$window_ua=$window_u*$window_e;
			$window_sume += $window_e;
			$zone_ua_diafani+=$window_ua;
			
			if($window_u<=$umax_win){
				$color_win=$u_color_green;
			}else{
				$color_win=$u_color_red;
			}
			
			if($window["wall_id"]!=0){
				$typetxt_an="Άνοιγμα τοίχου";
			}
			if($window["roof_id"]!=0){
				$typetxt_an="Άνοιγμα οροφής";
			}
			$txt_win .= "<tr>
				<td>".$i."</td>
				<td>".$typetxt_an."</td>
				<td>".$window["name"]."</td>
				<td>".$epafi."</td>
				<td>".$window_e."</td>
				<td ".$color_win.">".round($window_u,3)."</td>
				<td>".$umax_win."</td>
				<td>".round($window_ua,3)."</td>
				</tr>";
			$i++;
		}
		$txt_win .= "<tr>
		<td style=\"text-align:left;\" colspan=\"7\">Zώνη: ".$zone["name"]." UxA Κατακόρυφων διαφανών [".$epafi."]</td>
		<td style=\"width: 10%;\">".round($zone_ua_diafani,2)."</td>
		</tr>";
		$txt_win .= "</table>";
		
	}//για κάθε ζώνη
	
	return $txt_win;
}


//Εύρεση στοιχείων από τον υπολογισμό που δηλώθηκε στα στοιχεία μελέτης για τα ανοίγματα
function teyxos_win_standar(){
	$database = new medoo(DB_NAME);
	$col = "*";
	$tb_meleti = "user_meletes";
	$tb_meleti_mel = "meletes_stoixeiameleti";
	$tb_zones = "meletes_zones";
	$tb_umax = "vivliothiki_umax";
	
	$where_umax_win = array("type"=>"win");
	$where_meleti=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	
	//Γενικά στοιχεία μελέτης
	$select_meleti = $database->select($tb_meleti, $col, $where_meleti);
	$zwni = $select_meleti[0]["zone"];
	
	//Γενικά στοιχεία - στοιχεία μελέτης (στάνταρ υπολογισμοί
	$select_meleti_mel = $database->select($tb_meleti_mel, $col, $where);
	$u_an = $select_meleti_mel[0]["u_an"];
	
	//Στοιχεία ζώνης
	$select_zones = $database->select($tb_zones, $col, $where);
	
	//Μέγιστος U ανοιγμάτων
	if($zwni==0){$col_umax="a";}
	if($zwni==1){$col_umax="b";}
	if($zwni==2){$col_umax="c";}
	if($zwni==3){$col_umax="d";}
	
	//Στοιχεία Umax ανοιγμάτων
	$umax_win = $database->select($tb_umax, $col_umax, $where_umax_win);
	$umax_win=$umax_win[0];
	
	//Array στοιχείων
	$array_plaisio_yliko= array(
		0=>0,
		1=>"Μεταλλικό πλαίσιο",
		2=>"Συνθετικό πλαίσιο",
		3=>"Ξύλινο πλαίσιο"
	);
	$array_plaisio_type= array(
		0=>0,
		1=>array(
			1=>" χωρίς θερμοδιακοπή",
			2=>" με θερμοδιακοπή"
		),
		2=>array(
			1=>" Πολυουρεθάνη",
			2=>" PVC - 2 θάλαμοι",
			3=>" PVC - 3 θάλαμοι",
			4=>" PVC - πολυθαλαμικό"
		),
		3=>array(
			1=>" σκληρή ξυλεία - μέσο πλάτος 5cm",
			2=>" μαλακή ξυλεία - μέσο πλάτος 5cm",
			3=>" σκληρή ξυλεία - μέσο πλάτος 10cm",
			4=>" μαλακη ξυλεία - μέσο πλάτος 10cm"
		)
	);
	$array_ug_ekp= array(
		0=>0,
		1=>"0.89",
		2=>"<0.10",
		3=>"<0.05"
	);
	$array_ug_dims= array(
		0=>0,
		1=>"4-6-4",
		2=>"4-8-4",
		3=>"4-12-4",
		4=>"4-16-4",
		5=>"4-20-4",
		6=>"4-6-4-6-4",
		7=>"4-8-4-8-4",
		8=>"4-12-4-12-4"
	);
	$array_ug_diak= array(
		0=>0,
		1=>"Αέρας",
		2=>"Αργό",
		3=>"Κρυπτό"
	);

	$tb_userdiafani="user_diafani";
	$tb_uf="vivliothiki_uf";
	$tb_ug="vivliothiki_ug";
	$tb_ug_psi="vivliothiki_ug_psi";
	
	$where_userdiafani=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$u_an));
	$diafani_data = $database->select($tb_userdiafani, $col, $where_userdiafani );
	$diafani_data=$diafani_data[0];
	
	$name=$diafani_data["name"];
	$zone=$diafani_data["zwni"];
	$plaisio_uf=$diafani_data["plaisio_uf"];
	$mpp=$diafani_data["plaisio_mpp"];
	$yalo_ekp=$diafani_data["yalo_ekp"];
	$yalo_dias=$diafani_data["yalo_dias"];
	$yalo_aer=$diafani_data["yalo_aer"];
	
	//Μεταλλικό πλαίσιο
	if($plaisio_uf==1){$plaisio_yliko=1;$plaisio_type=1;}
	if($plaisio_uf==2){$plaisio_yliko=1;$plaisio_type=2;}
	//Συνθετικό πλαίσιο
	if($plaisio_uf==3){$plaisio_yliko=2;$plaisio_type=1;}
	if($plaisio_uf==4){$plaisio_yliko=2;$plaisio_type=2;}
	if($plaisio_uf==5){$plaisio_yliko=2;$plaisio_type=3;}
	if($plaisio_uf==6){$plaisio_yliko=2;$plaisio_type=4;}
	//Ξύλινο πλαίσιο
	if($plaisio_uf==7){$plaisio_yliko=3;$plaisio_type=1;}
	if($plaisio_uf==8){$plaisio_yliko=3;$plaisio_type=2;}
	if($plaisio_uf==9){$plaisio_yliko=3;$plaisio_type=3;}
	if($plaisio_uf==10){$plaisio_yliko=3;$plaisio_type=4;}
	
	//Πλαίσιο - τύπος πλαισίου
	$where_uf=array("AND"=>array("plaisio_yliko"=>$plaisio_yliko,"plaisio_type"=>$plaisio_type));
	$uf_data = $database->select($tb_uf, $col, $where_uf );
	$uf=$uf_data[0]["uf"];
	
	$plaisio=$array_plaisio_yliko[$plaisio_yliko].$array_plaisio_type[$plaisio_yliko][$plaisio_type];
	
	//Υάλωση
	if($yalo_aer==1){$column_ug="air";}
	if($yalo_aer==2){$column_ug="ar";}
	if($yalo_aer==3){$column_ug="kr";}
	$where_ug=array("AND"=>array("type_ekmp"=>$yalo_ekp,"diastasi"=>$yalo_dias));
	$ug_data = $database->select($tb_ug, $col, $where_ug );
	$ug=$ug_data[0][$column_ug];
	$ekp_name=$ug_data[0]["type_yalopinakas"];
	$dias_name=$ug_data[0]["typos_yalosi"];
	if($dias_name==1){$dias_name=" (διπλή)";}
	if($dias_name==2){$dias_name=" (τριπλή)";}
	
	$yalopinkas = "Συντ. εκπομπής: ".$array_ug_ekp[$yalo_ekp]." - ".$ekp_name.
	", Διαστάσεων: ".$array_ug_dims[$yalo_dias].$dias_name.
	", Υλικό διακένου: ".$array_ug_diak[$yalo_aer];
	
	
	//Θερμογέφυρα συναρμογής πλαισίου-υαλοπίνακα
	if($plaisio_uf==1){$ug_psi_type=1;}
	if($plaisio_uf==2){$ug_psi_type=2;}
	if($plaisio_uf>=3 AND $plaisio_uf>=6){$ug_psi_type=3;}
	if($plaisio_uf>=7 AND $plaisio_uf>=10){$ug_psi_type=4;}
	if($yalo_ekp==1){$column_ug_psi="lowe";}
	if($yalo_ekp>1){$column_ug_psi="nolowe";}
	$where_ug_psi=array("type"=>$ug_psi_type);
	$ugpsi_data = $database->select($tb_ug_psi, $col, $where_ug_psi );
	$ug_psi=$ugpsi_data[0][$column_ug_psi];
	
	//$array_plaisio_yliko[$plaisio_yliko].$array_plaisio_type[$plaisio_yliko][$plaisio_type]
	//$ug_psi
	
	$array = array($umax_win,$plaisio,$uf,$mpp,$yalopinkas,$ug);
	
	return $array;
	
}


//Εκτύπωση πίνακα U αδιαφανών
//type: 1: Επαφή σε άερα, 2: Επαφή με ΜΘΧ, 3: Επαφή σε έδαφος
function teyxos_adiafani_checkum(){
	$database = new medoo(DB_NAME);
	$col = "*";
	
	//Γενικά στοιχεία μελέτης
	$where_meleti=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$tb_meleti = "user_meletes";
	$select_meleti = $database->select($tb_meleti, $col, $where_meleti);
	$zwni = $select_meleti[0]["zone"];
	
	//Στοιχεία ζώνης
	$tb_zones = "meletes_zones";
	$tb_walls="meletes_zone_adiafani";
	$table_windows="meletes_zone_diafani";
	$tb_zone_dapeda = "meletes_zone_dapeda";
	$tb_zone_orofes = "meletes_zone_orofes";
	$tb_zone_thermo = "meletes_zone_thermo";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$txt_check = "";
	
	$tb_ummax = "vivliothiki_ummax";
	if($zwni==0){$col_umax="a";}
	if($zwni==1){$col_umax="b";}
	if($zwni==2){$col_umax="c";}
	if($zwni==3){$col_umax="d";}
	
	$array_thermo_dbs = array(
		0=>"ak",
		1=>"d",
		2=>"de",
		3=>"dp",
		4=>"ed",
		5=>"edp",
		6=>"eds",
		7=>"eksg",
		8=>"esg",
		9=>"l",
		10=>"oe",
		11=>"pr",
		12=>"yp"
	);
	
	$u_color_green="style=\"background-color:#cce5cc;\"";
	$u_color_red="style=\"background-color:#ffcccc;\"";

	$txt_check .= "<table>
	<tr><td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"9\">
	Έλεγχος θερμομονωτικής επάρκειας (Κτίριο)</td></tr>
	<tr><td style=\"width: 20%; background-color:#eaeaea;\">Ζώνη</td>
	<td style=\"width: 15%; background-color:#eaeaea;\">UxA Κατακόρυφων αδιαφανών</td>
	<td style=\"width: 15%; background-color:#eaeaea;\">UxA Κατακόρυφων διαφανών</td>
	<td style=\"width: 15%; background-color:#eaeaea;\">UxA Οριζόντιων</td>
	<td style=\"width: 15%; background-color:#eaeaea;\">ΨxL</td>
	<td style=\"width: 20%; background-color:#eaeaea;\">Σύνολο</td>
	</tr>";
	
	$bld_ua_adiafani=0;
	$bld_ua_diafani=0;
	$bld_ua_orizontia=0;
	$bld_psi=0;
	$bld_ua=0;
	$bld_a=0;
	$bld_e=0;
	$bld_v=0;
	
	$i=1;	
	
	foreach($select_zones as $zone){
		
		$zone_ua_adiafani=0;
		$zone_ua_diafani=0;
		$zone_ua_orizontia=0;
		$zone_ua_psi=0;
		$zone_ua=0;
		
		$where_walls=array(
			"AND"=>array(
				"user_id"=>$_SESSION['user_id'],
				"meleti_id"=>$_SESSION['meleti_id'],
				"zone_id"=>$zone["id"]
			)
		);
		$walls = $database->select($tb_walls, $col, $where_walls );
		$count_walls = $database->count($tb_walls, $where_walls );
		
		if($count_walls>0){
		
		foreach($walls as $wall){
			
			$wall_l = $wall["l"];
			$wall_h = $wall["h"];
			$wall_d = $wall["d"];
			$wall_dy = $wall["dy"];
			$wall_dx = $wall["dx"];
			
			$psi_dok_l = 0;
			$psi_yp_l = 0;
			$psi_syr_l = 0;
			$psi_array = explode("^", $wall["psi"]);
			$psi_array_dap = explode("|", $psi_array[0]);
			$psi_array_or = explode("|", $psi_array[1]);
			$psi_array_dok = explode("|", $psi_array[2]);
			$psi_array_yp = explode("|", $psi_array[3]);
			$psi_array_syr = explode("|", $psi_array[4]);
			
			$tb_thermo_dap = "vivliothiki_thermo_".$array_thermo_dbs[$psi_array_dap[0]];
			$tb_thermo_or = "vivliothiki_thermo_".$array_thermo_dbs[$psi_array_or[0]];
			$tb_thermo_dok = "vivliothiki_thermo_".$array_thermo_dbs[$psi_array_dok[0]];
			$tb_thermo_yp = "vivliothiki_thermo_".$array_thermo_dbs[$psi_array_yp[0]];
			$tb_thermo_syr = "vivliothiki_thermo_".$array_thermo_dbs[$psi_array_syr[0]];
			
			$data_psi_dap = $database->select($tb_thermo_dap,"*",array("id"=>$psi_array_dap[1]) );
			$data_psi_or = $database->select($tb_thermo_or,"*",array("id"=>$psi_array_or[1]) );
			$data_psi_dok = $database->select($tb_thermo_dok,"*",array("id"=>$psi_array_dok[1]) );
			$data_psi_yp = $database->select($tb_thermo_yp,"*",array("id"=>$psi_array_yp[1]) );
			$data_psi_syr = $database->select($tb_thermo_syr,"*",array("id"=>$psi_array_syr[1]) );
			
			$psi_dap_name=$data_psi_dap[0]["name"];
			$psi_dap_y=$data_psi_dap[0]["y"];
			$psi_or_name=$data_psi_or[0]["name"];
			$psi_or_y=$data_psi_or[0]["y"];
			$psi_dok_name=$data_psi_dok[0]["name"];
			$psi_dok_y=$data_psi_dok[0]["y"];
			$psi_yp_name=$data_psi_yp[0]["name"];
			$psi_yp_y=$data_psi_yp[0]["y"];
			$psi_syr_name=$data_psi_syr[0]["name"];
			$psi_syr_y=$data_psi_syr[0]["y"];
			
			//Συντελεστές U - Χρειάζεται διόρθωση
			// u δρομικό
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
				if($wall["yp_u_id"]!=0){
					$data_yp_u = $database->select("user_adiafani","u",array("id"=>$wall['yp_u_id']) );
					$yp_u=$data_yp_u[0];
				}
			}
			
			// u δοκών	
			if($wall["dok_u"]!=0){
				$dok_u=$wall["dok_u"];
			}else{
				if($wall["dok_u_id"]!=0){
					$data_dok_u = $database->select("user_adiafani","u",array("id"=>$wall['dok_u_id']) );
					$dok_u=$data_dok_u[0];
				}
			}
			
			// u συρομένων	
			if($wall["syr_u"]!=0){
				$syr_u=$wall["syr_u"];
			}else{
				if($wall["syr_u_id"]!=0){
					$data_syr_u = $database->select("user_adiafani","u",array("id"=>$wall['syr_u_id']) );
					$syr_u=$data_syr_u[0];
				}	
			}
			
			if($wall["type"]==0){
				$uis=$u;
				$dok_uis=$dok_u;
				$yp_uis=$yp_u;
				$syr_uis=$syr_u;
			}
			if($wall["type"]==1){
				$b=0.5;
				$uis=$u*$b;
				$dok_uis=$dok_u*$b;
				$yp_uis=$yp_u*$b;
				$syr_uis=$syr_u*$b;
			}
			if($wall["type"]==2){
				$z1=$wall['z1'];
				$z2=$wall['z2'];
				$uis=isodynamos_katakoryfoy($u, $z1, $z2);
				$dok_uis=isodynamos_katakoryfoy($dok_u, $z1, $z2);
				$yp_uis=isodynamos_katakoryfoy($yp_u, $z1, $z2);
				$syr_uis=isodynamos_katakoryfoy($syr_u, $z1, $z2);
			}
			
			//Εμβαδόν σύνολο
			$wall_e_sum = $wall_l*$wall_h + ($wall_l*$wall_dy)/2;
			$bld_a+=$wall_e_sum;
			
			//Φέρων οργανισμός
			$per = $wall["per"];
			if($per==0){
				//Δοκοί	
				$data_dok = explode("^", $wall["dok"]);
				$dok_e_sum = 0;
				$dok_h_sum = 0;
				$dok_ua=0;
					for($doki=1; $doki<=count($data_dok)-1; $doki++){
					$dok = explode("|", $data_dok[$doki-1]);
						$dok_h = $dok[0];
						$dok_ar = $dok[1];
						$dok_e = $dok_h*$wall_l;
						$dok_ua = $dok_uis*$dok_e;
						$dok_e_sum += $dok_e;
						$dok_h_sum += $dok_h;
						$zone_ua_adiafani+=$dok_ua;
						
						$psi_dok_l+=$wall_l*2;
						
					}
				
				//Υποστηλώματα
				$data_yp = explode("^", $wall["yp"]);
				$yp_e_sum = 0;
				$yp_ua=0;
					for($ypi=1; $ypi<=(count($data_yp)-1); $ypi++){
					$yp = explode("|", $data_yp[$ypi-1]);
						$yp_l = $yp[0];
						$yp_h = ($wall_h-$dok_h_sum);
						$yp_e = $yp_l*($wall_h-$dok_h_sum);
						$yp_ua = $yp_uis*$yp_e;
						$yp_e_sum += $yp_e;
						$zone_ua_adiafani+=$yp_ua;
						
						$psi_yp_l+=$yp_h*2;
						$psi_dok_l-=$yp_l*2;
					}
			}
			
			//Συρόμενα
			$data_syr = explode("^", $wall["syr"]);
			$syr_e_sum = 0;
			$syr_ua = 0;
				for($syri=1; $syri<=count($data_syr)-1; $syri++){
				$syr = explode("|", $data_syr[$syri-1]);
					$syr_l = $syr[0];
					$syr_h = $syr[1];
					$syr_e = $syr[0]*$syr[1];
					$syr_ua = $syr_uis*$syr_e;
					$syr_e_sum += $syr_e;
					$zone_ua_adiafani+=$syr_ua;
					
					$psi_syr_l=2*$syr_l + 2*$syr_h;
				}
			
			//με ποσοστό φέρων οργανισμού
			if($per!=0){
				$dok_e_sum=0;
				$dok_ua=0;
				$yp_e_sum=$wall_e_sum*$per/100;
				$yp_ua=$yp_uis*$yp_e_sum;
				$syr_e_sum=0;
				$syr_ua=0;
				$zone_ua_adiafani+=$yp_ua;
				
				$psi_dok_l=0;
				$psi_syr_l=0;
			}
			
			$window_sume=0;
			//Παράθυρα
			$data_window = $database->select($table_windows,"*",array("wall_id"=>$wall['id']) );
			foreach($data_window as $window){
				$window_ua=0;
				$window_w=$window["w"];
				$window_h=$window["h"];
				$window_e=$window["w"]*$window["h"];
				$window_u=$window["u"];
				$window_psi_l = $window["psi_l"];
				$window_psi_a = $window["psi_a"];
				
					if($wall["type"]==0){
						$window_uis=$window_u;
					}
					if($wall["type"]==1){
						$b=0.5;
						$window_uis=$window_u*$b;
					}
					if($wall["type"]==2){
						$b=0.5;
						$window_uis=$window_u*$b;
					}
					$window_ua=$window_uis*$window_e;
					$window_sume += $window_e;			
			
					$data_thermo_l = $database->select("vivliothiki_thermo_l","*",array("id"=>$window_psi_l) );
					$data_thermo_ak = $database->select("vivliothiki_thermo_ak","*",array("id"=>$window_psi_a) );
					
					$psi_lam_name=$data_thermo_l[0]["name"];
					$psi_lam=$data_thermo_l[0]["y"];
					$psi_anw_name=$data_thermo_ak[0]["name"];
					$psi_anw=$data_thermo_ak[0]["y"];
					
					$psi_lam_l=2*$window_h;
					$psi_anw_l=2*$window_w;
					
					$psi_lampas = $psi_lam_l*$psi_lam;
					$psi_anwkasi = $psi_anw_l*$psi_anw;
					$psi_window = $psi_lampas+$psi_anwkasi;
					
					$zone_ua_psi+=$psi_window;
					
					//Χρειάζεται διόρθωση για τις αδιαφανείς πόρτες
					$zone_ua_diafani+=$window_ua;
			}
			
			//Καθαρό εμβαδόν τοίχου
			$wall_e_adiafanes = $wall_e_sum - $window_sume;//Ο τοίχος χωρίς παράθυρα
			$wall_e = $wall_e_sum - $syr_e_sum - $yp_e_sum - $dok_e_sum - $window_sume;//Ο τοίχος χωρίς φέρων/παράθυρα
			$u_sum = ($wall_e*$u + $syr_e_sum*$syr_u + $yp_e_sum*$yp_u + $dok_e_sum*$dok_u)/$wall_e_adiafanes;//Μέσος συντελεστής
			$wall_ua=$uis*$wall_e;
			$zone_ua_adiafani+=$wall_ua;
			
			//Θερμογέφυρες
			if($wall["type"]==1){
				$psi_b=0.5;
			}else{
				$psi_b=1;
			}
			$psi_dap=$psi_dap_y*$wall_l*$psi_b;
			$psi_or=$psi_or_y*$wall_l*$psi_b;
			$psi_yp=$psi_yp_y*$psi_yp_l*$psi_b;
			$psi_dok=$psi_dok_y*$psi_dok_l*$psi_b;
			$psi_syr=$psi_syr_y*$psi_syr_l*$psi_b;
			$psi_wall=$psi_dap+$psi_or+$psi_yp+$psi_dok+$psi_syr;
			$zone_ua_psi+=$psi_wall;
		}//για κάθε τοίχο
		
		}//Υπάρχουν τοίχοι
		
		//ΔΑΠΕΔΑ ΖΩΝΗΣ
		$where_dapeda=array(
			"AND"=>array(
				"user_id"=>$_SESSION['user_id'],
				"meleti_id"=>$_SESSION['meleti_id'],
				"zone_id"=>$zone["id"]
			)
		);
		$select_zone_dapeda = $database->select($tb_zone_dapeda, $col, $where_dapeda);
		$count_zone_dapeda = $database->count($tb_zone_dapeda, $where_dapeda);
		if($count_zone_dapeda!=0){
			foreach($select_zone_dapeda as $dapeda){
				$dapeda_ua=0;
				if($dapeda["u"]!=0){
					$dapeda_u=$dapeda["u"];
				}else{
					$dapeda_u_data = $database->select("user_adiafani","u",array("id"=>$dapeda["u_id"]) );
					$dapeda_u=$dapeda_u_data[0];
				}
				
				if($dapeda["type"]==2){
					$dapeda_uis=$dapeda_u;
				}
				if($dapeda["type"]==1){
					$b=0.5;
					$dapeda_uis=$dapeda_u*$b;
				}
				if($dapeda["type"]==0){
					$z=$dapeda['z'];
					$xar=2*$dapeda["e"]/$dapeda['p'];
					$dapeda_uis=isodynamos_dapedoy($dapeda_u, $z, $xar);
				}
				
				$dapeda_ua=$dapeda_uis*$dapeda["e"];
				$zone_ua_orizontia+=$dapeda_ua;
				
				$bld_a+=$dapeda["e"];
			}//Για κάθε δάπεδο
			
		}//Υπάρχουν δάπεδα
		
		//ΟΡΟΦΕΣ ΖΩΝΗΣ
		$where_orofes=array(
			"AND"=>array(
				"user_id"=>$_SESSION['user_id'],
				"meleti_id"=>$_SESSION['meleti_id'],
				"zone_id"=>$zone["id"]
			)
		);
		$select_zone_orofes = $database->select($tb_zone_orofes, $col, $where_orofes);
		$count_zone_orofes = $database->count($tb_zone_orofes, $where_orofes);
		if($count_zone_orofes!=0){
			foreach($select_zone_orofes as $orofes){
				$orofes_ua=0;
				if($orofes["u"]!=0){
					$orofes_u=$orofes["u"];
				}else{
					$orofes_u_data = $database->select("user_adiafani","u",array("id"=>$orofes["u_id"]) );
					$orofes_u=$orofes_u_data[0];
				}
				
				if($orofes["type"]==0){
					$b=1;
				}
				if($orofes["type"]==1){
					$b=0.5;
				}
				
				$window_sume=0;
				//Παράθυρα οροφών
				$data_windowor = $database->select($table_windows,"*",array("roof_id"=>$orofes['id']) );
				foreach($data_windowor as $window){
					$window_name=$window["name"];
					$window_w=$window["w"];
					$window_h=$window["h"];
					$window_e=$window["w"]*$window["h"];
					$window_u=$window["u"];
					
					$window_sume+=$window_e;
					
					$window_ub=$window_u*$b;
					$window_ua=$window_ub*$window_e;
					$zone_ua_orizontia+=$window_ua;
					$zone_ua_orizontia_diaf+=$window_ua;
				}//Παράθυρα οροφών
				
				$roof_e=0;
				$roof_e=$orofes["e"]-$window_sume;
				
				$orofes_uis=$orofes_u*$b;
				$orofes_ua=$orofes_uis*$roof_e;
				$zone_ua_orizontia+=$orofes_ua;
				
				$bld_a+=$orofes["e"];
			}//για κάθε οροφή
		}//Υπάρχουν οροφές
		
		//ΘΕΡΜΟΓΕΦΥΡΕΣ ΣΤΟ ΜΕΝΟΥ ΖΩΝΗΣ - ΕΚΤΟΣ ΤΟΙΧΩΝ ΟΡΟΦΩΝ
		$select_zone_thermo = $database->select($tb_zone_thermo, $col, array("zone_id"=>$zone["id"]) );
		$count_zone_thermo = $database->count($tb_zone_thermo, array("zone_id"=>$zone["id"]));
		$zone_yl = 0;
		if($count_zone_thermo!=0){
			foreach($select_zone_thermo as $thermo){
				$vivliothiki_thermo = "vivliothiki_thermo_".$array_thermo_dbs[$thermo["type"]];
				$data_u = $database->select($vivliothiki_thermo,"*",array("id"=>$thermo["u"]) );
				$data_yl = $data_u[0]["y"]*$thermo["n"]*$thermo["h"];
				
				$zone_yl += $data_yl;
			}//για κάθε θερμογέφυρα
		}//έλεγχος μήπως δεν υπάρχει καμία
		$zone_ua_psi+=$zone_yl;
		//ΘΕΡΜΟΓΕΦΥΡΕΣ ΣΤΟ ΜΕΝΟΥ ΖΩΝΗΣ - ΕΚΤΟΣ ΤΟΙΧΩΝ ΟΡΟΦΩΝ
		
		
		$zone_ua=$zone_ua_adiafani+$zone_ua_diafani+$zone_ua_orizontia+$zone_ua_psi;
		
		$txt_check .= "
		<tr>
		<td>Ζώνη: ".$zone["name"]."</td>
		<td>".round($zone_ua_adiafani,3)."</td>
		<td>".round($zone_ua_diafani,3)."</td>
		<td>".round($zone_ua_orizontia,3)."</td>
		<td>".round($zone_ua_psi,3)."</td>
		<td>".round($zone_ua,3)."</td>
		</tr>";
		
		
		$bld_ua_adiafani+=$zone_ua_adiafani;
		$bld_ua_diafani+=$zone_ua_diafani;
		$bld_ua_orizontia+=$zone_ua_orizontia;
		$bld_psi+=$zone_ua_psi;
		$bld_ua+=$zone_ua;
		
		$data_zone_ev=teyxos_zone_ev($zone["id"]);
		$zone_e=$data_zone_ev[0];
		$zone_v=$data_zone_ev[1];
		$bld_e+=$zone_e;
		$bld_v+=$zone_v;
	
		$i++;
	}//για κάθε ζώνη
	
	$bld_um = $bld_ua/$bld_a;
	$bld_av = $bld_a/$bld_v;
	$ummax=get_ummax($col_umax, $bld_av);
	
	if($bld_um<=$ummax){
		$color=$u_color_green;
	}else{
		$color=$u_color_red;
	}
	
	$txt_check .= "
	<tr>
	<td>Κτίριο ΣUxA</td>
	<td>".round($bld_ua_adiafani,3)."</td>
	<td>".round($bld_ua_diafani,3)."</td>
	<td>".round($bld_ua_orizontia,3)."</td>
	<td>".round($bld_psi,3)."</td>
	<td>".round($bld_ua,3)."</td>
	</tr>";
	$txt_check .= "
	<tr>
	<td colspan=\"5\">ΣA (Επιφάνεια κτιριακού κελύφου σε m<sup>2</sup>)</td>
	<td style=\"background-color:#eaeaea;\">".round($bld_a,3)."</td>
	</tr>";
	$txt_check .= "
	<tr>
	<td colspan=\"5\">Um = Μέσο συντελεστής θερμοπερατότητας κτιρίου [(ΣbxUxA + ΣbxΨxl)/ΣA]</td>
	<td ".$color.">".round($bld_um,3)."</td>
	</tr>";
	$txt_check .= "
	<tr>
	<td colspan=\"5\">A/V (m<sup>-1</sup>) [A:".round($bld_a,3).",V:".round($bld_v,3)."]</td>
	<td style=\"background-color:#eaeaea;\">".round($bld_av,3)."</td>
	</tr>";
	$txt_check .= "
	<tr>
	<td colspan=\"5\">Um,max - Μέγιστος συντελεστής θερμοπερατότητας</td>
	<td style=\"background-color:#FFF8DD;\">".round($ummax,3)."</td>
	</tr>";
	$txt_check .= "</table>";
	$txt_check .= "<br/>Υπολογίζεται για U=U' για στοιχεία σε έδαφος και για U=Uxb=0.5xU για στοιχεία σε ΜΘΧ/Ηλιακούς χώρους.";
	
	return $txt_check;
}


//Εκτύπωση ΚΕΦ 6 - Χρήση κτιρίου, θερμικών ζωνών
function teyxos_bld_xrisi(){
	$database = new medoo(DB_NAME);
	$tb_meleti = "user_meletes";
	$tb_bld_xrisi = "vivliothiki_conditions_building";
	$col = "*";
	$where_meleti=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$select_meleti = $database->select($tb_meleti, $col, $where_meleti);
	
	$building_xrisi = $database->select($tb_bld_xrisi,"name",array("id"=>$select_meleti[0]["xrisi"]));
	$building_xrisi = $building_xrisi[0];
	
	return $building_xrisi;
}



//Εκτύπωση ΚΕΦ 6 - Χρήση κτιρίου, θερμικών ζωνών
function teyxos_kef6ktirio(){
	$database = new medoo(DB_NAME);
	$tb_meleti = "user_meletes";
	$tb_zones = "meletes_zones";
	$tb_bld_xrisi = "vivliothiki_conditions_building";
	$tb_zone_xrisi = "vivliothiki_conditions";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$where_meleti=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$select_meleti = $database->select($tb_meleti, $col, $where_meleti);
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$txt = "<table>";
	$txt .= "
	<tr><td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"6\">
	Χρήση κτιρίου - Χρήσεις θερμικών ζωνών</td></tr>
	<tr>
	<td style=\"width: 20%; background-color:#eaeaea;\">Θερμική ζώνη</td>
	<td style=\"width: 20%; background-color:#eaeaea;\">Χρήση</td>
	<td style=\"width: 15%; background-color:#eaeaea;\">Ε<sub>θερμαινόμενος</sub> (m<sup>2</sup>)</td>
	<td style=\"width: 15%; background-color:#eaeaea;\">V<sub>θερμαινόμενος</sub> (m<sup>3</sup>)</td>
	<td style=\"width: 15%; background-color:#eaeaea;\">Ε<sub>ψυχόμενος</sub> (m<sup>2</sup>)</td>
	<td style=\"width: 15%; background-color:#eaeaea;\">V<sub>ψυχόμενος</sub> (m<sup>3</sup>)</td>
	</tr>";
	
	$bld_e=0;
	$bld_v=0;
	$bld_e_cold=0;
	$bld_v_cold=0;
	
	foreach($select_zones as $zone){
		$zone_ev=teyxos_zone_ev($zone["id"]);
		$zone_e=$zone_ev[0];
		$zone_v=$zone_ev[1];
		
		if($zone["xrisi"]==1 OR $zone["xrisi"]==2){
			$zone_e_cold=$zone_e/2;
			$zone_v_cold=$zone_v/2;
		}else{
			$zone_e_cold=$zone_e;
			$zone_v_cold=$zone_v;
		}
		
		$bld_e+=$zone_e;
		$bld_v+=$zone_v;
		$bld_e_cold+=$zone_e_cold;
		$bld_v_cold+=$zone_v_cold;
		
		$zone_xrisi = $database->select($tb_zone_xrisi, "xrisi", array("id"=>$zone["xrisi"]) );
		$zone_xrisi = $zone_xrisi[0];
	
		$txt .= "
		<tr>
		<td>".$zone["name"]."</td>
		<td>".$zone_xrisi."</td>
		<td>".$zone_e."</td>
		<td>".$zone_v."</td>
		<td>".$zone_e_cold."</td>
		<td>".$zone_v_cold."</td>
		</tr>";
	}
	
	$building_xrisi = $database->select($tb_bld_xrisi,"name",array("id"=>$select_meleti[0]["xrisi"]));
	$building_xrisi = $building_xrisi[0];
	
	$txt .= "
	<tr>
	<td>Κτίριο (σύν. θερμαινόμενων)</td>
	<td>".$building_xrisi."</td>
	<td>".$bld_e."</td>
	<td>".$bld_v."</td>
	<td>".$bld_e_cold."</td>
	<td>".$bld_v_cold."</td>
	</tr>";
	
	$txt .= "</table>";
	$txt .= "<br/>";
	$txt .= "*Δεν περιλαμβάνονται οι μη-θερμαινόμενοι χώροι οι οποίοι εμφανίζονται στο τεύχος αναλυτικών υπολογισμών. 
	Εμφανίζεται η επικρατούσα χρήση του κτιρίου όπως δηλώνεται στο λογισμικό ΤΕΕ-ΚΕΝΑΚ και λαμβάνεται υπ όψη στους υπολογισμούς.";
	
	
	return $txt;
	
}


//Εκτύπωση ΚΕΦ 6 - Αερισμός θερμικών ζωνών
function teyxos_kef6air(){
	$database = new medoo(DB_NAME);
	$tb_zones = "meletes_zones";
	$tb_zone_xrisi = "vivliothiki_conditions";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$txt = "";
	
	foreach($select_zones as $zone){
		$txt .= "<table>";
		$txt .= "
		<tr><td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"3\">
		Αερισμός θερμικής ζώνης ".$zone["name"]."</td>
		</tr>";
		
		$synt_air=$database->select($tb_zone_xrisi, "nwpos_aeras_m2", array("id"=>$zone["xrisi"]) );
		$synt_air=$synt_air[0];
		$txt .= "<tr>
		<td style=\"width: 50%; background-color:#eaeaea;\">Συντελεστής φυσικού αερισμού (m<sup>3</sup>/h/m<sup>2</sup>)</td>
		<td style=\"width: 25%;\">".$synt_air."</td>
		<td style=\"width: 25%;\">ΤΟΤΕΕ 20701-1</td>
		</tr>";
		
		//Αερισμός από κουφώματα
		$aerismos=0;
		$data_diafani = $database->select("meletes_zone_diafani","*",array("id"=>$zone["id"]));
		foreach($data_diafani as $diafanes){
			$diafanes_wind = $diafanes["w"]*$diafanes["h"]*$diafanes["wind"];
			$aerismos+=$diafanes_wind;
		}
		$txt .= "<tr>
		<td style=\"width: 50%; background-color:#eaeaea;\">Διείσδυση αέρα από κουφώματα (m<sup>3</sup>/h)</td>
		<td style=\"width: 25%;\">".$aerismos."</td>
		<td style=\"width: 25%;\">Τεύχος αναλυτικών υπολογισμών</td>
		</tr>";
		
		if($zone["xrisi"]==1 OR $zone["xrisi"]==1){$aerismos_per=1;}else{$aerismos_per=0;}
		$txt .= "<tr>
		<td style=\"width: 50%; background-color:#eaeaea;\">Συντελεστής χρήσης φυσικού αερισμού (%)</td>
		<td style=\"width: 25%;\">".$aerismos_per."</td>
		<td style=\"width: 25%;\">100% για κατοικίες, 0% για τριτογενή τομέα</td>
		</tr>";
		
		$txt .= "<tr>
		<td style=\"width: 50%; background-color:#eaeaea;\">Αριθμός θυρίδων εξαερισμού (-)</td>
		<td style=\"width: 25%;\">".$zone["thyrides"]."</td>
		<td style=\"width: 25%;\">-</td>
		</tr>";
		$txt .= "<tr>
		<td style=\"width: 50%; background-color:#eaeaea;\">Αριθμός καμινάδων (-)</td>
		<td style=\"width: 25%;\">".$zone["kaminades"]."</td>
		<td style=\"width: 25%;\">20m<sup>3</sup>/h/καμινάδα</td>
		</tr>";
		$txt .= "<tr>
		<td style=\"width: 50%; background-color:#eaeaea;\">Αριθμός ανεμιστήρων οροφής (-)</td>
		<td style=\"width: 25%;\">".$zone["anemistires"]."</td>
		<td style=\"width: 25%;\">-</td>
		</tr>";
		$txt .= "<tr>
		<td style=\"width: 50%; background-color:#eaeaea;\">Χώρος κάλυψης ανεμιστήρων (-)</td>
		<td style=\"width: 25%;\">Τουλάχιστον το 50%</td>
		<td style=\"width: 25%;\">Εφόσον χρησιμοποιούνται</td>
		</tr>";
		
		$zone_air=$aerismos+20*$zone["kaminades"]+10*$zone["thyrides"];
		$txt .= "<tr>
		<td style=\"width: 50%; background-color:#eaeaea;\">Συνολική διείσδυση αέρα (m<sup>3</sup>/h)</td>
		<td style=\"width: 25%;\">".$zone_air."</td>
		<td style=\"width: 25%;\"></td>
		</tr>";
		
		$zone_ev=teyxos_zone_ev($zone["id"]);
		$zone_e=$zone_ev[0];
		$zone_air_min=$zone_e*$synt_air;
		$txt .= "<tr>
		<td style=\"width: 50%; background-color:#eaeaea;\">Ελάχιστη διείσδυση αέρα (m<sup>3</sup>/h)</td>
		<td style=\"width: 25%;\">".$zone_air_min."</td>
		<td style=\"width: 25%;\">ΤΟΤΕΕ 20701-1 (".$synt_air."m<sup>3</sup>/h/m<sup>2</sup> x ".$zone_e."m<sup>2</sup>)</td>
		</tr>";
	$txt .= "</table>";
	}
	
	return $txt;
}



//Εκτύπωση ΚΕΦ 6 - Εσωτερικές συνθήκες λειτουργίας
function teyxos_kef6conditions(){
	$database = new medoo(DB_NAME);
	$tb_zones = "meletes_zones";
	$tb_zone_xrisi = "vivliothiki_conditions";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$array_xrisi = array();
	$txt = "";
	
	foreach($select_zones as $zone){
		array_push($array_xrisi, $zone["xrisi"]);
	}
	$array_xriseis=array_unique($array_xriseis);
	
	foreach($array_xrisi as $xrisi){
		$conditions=$database->select($tb_zone_xrisi, $col, array("id"=>$xrisi) );
		$conditions=$conditions[0];
		$txt .= "<table>";
		$txt .= "
		<tr>
		<td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"2\">
		Εσωτερικές συνθήκες λειτουργίας: ".$conditions["gen_xrisi"].",".$conditions["xrisi"]."</td>
		</tr>
		<tr>
		<td style=\"width: 50%; background-color:#eaeaea;\">Παράμετρρος</td>
		<td style=\"width: 50%; background-color:#eaeaea;\">Τιμή</td>
		</tr>";
		
		$txt .= "<tr>
		<td style=\"background-color:#eaeaea;\">Ώρες λειτουργίας (h)</td>
		<td>".$conditions["hours"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Ημέρες λειτουργίας (d)</td>
		<td>".$conditions["days"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Μήνες λειτουργίας (m)</td>
		<td>".$conditions["months"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">θ,i,h (C)</td>
		<td>".$conditions["tih"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">θ,i,c (C)</td>
		<td>".$conditions["tic"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Χ,i,h (%)</td>
		<td>".$conditions["xih"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Χ,i,c (%)</td>
		<td>".$conditions["xic"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Άτομα/100m<sup>2</sup></td>
		<td>".$conditions["atoma"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Νωπός αέρας (m<sup>3</sup>/h/άτομο)</td>
		<td>".$conditions["nwpos_aeras_per"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Νωπός αέρας (m<sup>3</sup>/h/m<sup>2</sup>)</td>
		<td>".$conditions["nwpos_aeras_m2"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Στάθμη φωτισμού κτιρίου αναφοράς (lux)</td>
		<td>".$conditions["fwtismos"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Ισχύς φωτισμού κτιρίου αναφοράς (W/m²)</td>
		<td>".$conditions["isxys_anaf"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Ώρες λειτουργίας ημέρας (h)</td>
		<td>".$conditions["hours_day"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Ώρες λειτουργίας νύχτας (h)</td>
		<td>".$conditions["hours_night"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Κατανάλωση ΖΝΧ (lt/άτομο/ημέρα)</td>
		<td>".$conditions["znx_l_p_d"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Κατανάλωση ΖΝΧ (lt/m<sup>2</sup>/ημέρα)</td>
		<td>".$conditions["znx_l_sq_d"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Κατανάλωση ΖΝΧ (m<sup>3</sup>/m<sup>2</sup>/year)</td>
		<td>".$conditions["znx_m3_sq_y"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Ισχύς (W/άτομο)</td>
		<td>".$conditions["w_persons"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Ισχύς (W/m<sup>2</sup>)</td>
		<td>".$conditions["w_m2"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Συντελεστής παρουσίας f</td>
		<td>".$conditions["synt_parousias"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Ισχύς εξοπλισμού (W/m<sup>2</sup>)</td>
		<td>".$conditions["eks_w"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Μέσος συντελεστής ετεροχρονισμού</td>
		<td>".$conditions["eks_synt"]."</td>
		</tr>
		<tr>
		<td style=\"background-color:#eaeaea;\">Ισχύς εξοπλισμού (ετεροχρονισμός)</td>
		<td>".$conditions["eks_w_eter"]."</td>
		</tr>";
	$txt .= "</table>";	
	}

	return $txt;
}


//Εκτύπωση ΚΕΦ 6 - Κεφάλαιο ζώνης ξεκινώντας από το 6.3.3.
function teyxos_kef6zonechapter(){
	$database = new medoo(DB_NAME);
	$tb_zones = "meletes_zones";
	$tb_zone_xrisi = "vivliothiki_conditions";
	$col = "*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id']));
	$select_zones = $database->select($tb_zones, $col, $where);
	
	$txt = "";
	$pagebreak="<p style=\"page-break-before:always;\">&nbsp;</p>";
	
	$zi=4;
	foreach($select_zones as $zone){
		//ΚΕΛΥΦΟΣ ΖΩΝΗΣ
		$txt .= "<h3>6.".$zi.". Θερμική ζώνη: ".$zone["name"]."</h3>";
		
		$txt .= "<h3>6.".$zi.".1. Δεδομένα για αδιαφανή δομικά στοιχεία σε επαφή με τον εξωτερικό αέρα</h3>";
		$txt .= teyxos_kelyfostables(1,1,$zone["id"]);
		
		$txt .= "<h3>6.".$zi.".2. Δεδομένα για αδιαφανή δομικά στοιχεία σε επαφή με το έδαφος</h3>";
		$txt .= teyxos_kelyfostables(1,5,$zone["id"]);
		
		$txt .= "<h3>6.".$zi.".3. Δεδομένα για αδιαφανή δομικά στοιχεία σε επαφή με μη θερμαινόμενους χώρους</h3>";
		$txt .= teyxos_kelyfostables(1,3,$zone["id"]);
		
		$txt .= "<h3>6.".$zi.".4. Δεδομένα για διαφανή δομικά στοιχεία</h3>";
		$txt .= teyxos_kelyfostables(1,2,$zone["id"]);
		$txt .= teyxos_kelyfostables(1,4,$zone["id"]);
		
		$txt .= "<h3>6.".$zi.".5. Δεδομένα για παθητικά ηλιακά</h3>";
		$txt .= teyxos_kelyfostables(1,6,$zone["id"]);
		
		//ΗΜ ΣΥΣΤΗΜΑΤΑ
		$txt .= "<h3>6.".$zi.".6. Ηλεκτρομηχανολογικές Εγκαταστάσεις</h3>";
		$txt .= "<p>Τα δεδομένα που χρησιμοποιήθηκαν στους υπολογισμούς της ενεργειακής απόδοσης του υπό μελέτη κτιρίου και 
		σχετίζονται με τις ηλεκτρομηχανολογικές εγκαταστάσεις του, αφορούν στα εξής:</p>
		<ul>
			<li>Σύστημα θέρμανσης χώρων (Υποχρεωτικά σε όλα τα κτίρια),</li>
			<li>Σύστημα ψύξης χώρων (Υποχρεωτικά σε όλα τα κτίρια),</li>
			<li>Σύστημα παραγωγής ζεστού νερού χρήσης (Υποχρεωτικά σε όλα τα κτίρια. Εισάγεται στο ΤΕΕ-ΚΕΝΑΚ ασχέτως 
			εάν απαιτούνται καταναλώσεις ΖΝΧ),</li>
			<li>Σύστημα ηλιακών συλλεκτών για την παραγωγή ζεστού νερού χρήσης (Υποχρεωτικά σε όλα τα κτίρια που 
			απαιτούνται καταναλώσεις ΖΝΧ και κάλυψη τουλάχιστον του 60%),</li>
			<li>Σύστημα αερισμού (Υποχρεωτικά μόνο σε κτίρια τριτογενούς τομέα)</li>
			<li>Σύστημα φωτισμού (Υποχρεωτικά μόνο σε κτίρια τριτογενούς τομέα)</li>
			<li>Σύστημα ύγρανσης (Εφόσον υπάρχει τέτοιο και μόνο σε κτίρια τριτογενούς τομέα)</li>
		</ul>
		<p>Στις παραγράφους που ακολουθούν, δίνονται αναλυτικά τα δεδομένα που χρησιμοποιήθηκαν κατά τους υπολογισμούς 
		της ενεργειακής απόδοσης του τμήματος, στο λογισμικό.</p>";
		
		$txt.=$pagebreak;
		
		//ΣΥΣΤΗΜΑ ΘΕΡΜΑΝΣΗΣ
		$txt .= "<h3>6.".$zi.".6.1. Δεδομένα για το σύστημα θέρμανσης</h3>
		<p>Παρακάτω παρουσιάζονται οι εξής μονάδες από τις οποίες αποτελείται το σύστημα θέρμανσης της ζώνης:</p>
		<ul>
			<li>Η μονάδα παραγωγής θέρμανσης</li>
			<li>Το δίκτυο διανομής</li>
			<li>Οι τερματικές μονάδες</li>
			<li>Οι βοηθητικές μονάδες</li>
		</ul>
		<p style=\"text-align: left;\"><strong>Μονάδα Παραγωγής Θερμότητας</strong><br />";
		$txt .= teyxos_therm($zone["id"]);
		
		$txt .= "</p>
		<p>Η υπολογισμένη θερμική ισχύς, ελέγχθηκε εφόσον υπάρχει απαίτηση για υπερδιαστασιολόγηση σύμφωνα με την σχέση 
		4.1 της Τ.Ο.Τ.Ε.Ε. 20701-1/2010. Η τελική απόδοση είναι ίδια με αυτή που δίνει ο κατασκευαστής, σύμφωνα με την μελέτη θέρμανσης.</p>";
		
		$txt.=$pagebreak;
		
		//ΣΥΣΤΗΜΑ ΨΥΞΗΣ
		$txt .= "<h3>6.".$zi.".6.2. Δεδομένα για το σύστημα ψύξης</h3>
		<p>Παρακάτω παρουσιάζονται οι εξής μονάδες από τις οποίες αποτελείται το σύστημα ψύξης της ζώνης:</p>
		<ul>
			<li>Η μονάδα παραγωγής θέρμανσης</li>
			<li>Το δίκτυο διανομής</li>
			<li>Οι τερματικές μονάδες</li>
			<li>Οι βοηθητικές μονάδες</li>
		</ul>

		<p>Η χρήση μονάδων ψύξης, παρατηρείται κυρίως τις μεσημεριανές ώρες, κατά τις ημέρες με θερμοκρασίες πάνω από 30<sup>ο</sup>C. 
		Η πιθανότητα εμφάνισης θερμοκρασιών πάνω 30<sup>ο</sup>C, είναι περίπου 22%, σύμφωνα με την&nbsp; Τ.Ο.Τ.Ε.Ε. 20701-3/2010 (Κλιματικά 
		Δεδομένα Ελληνικών Περιοχών). Τις βραδινές ώρες, η χρήση των τοπικών μονάδων ψύξης είναι&nbsp; περιορισμένη, εκτός τις ημέρες που η 
		εξωτερική θερμοκρασία υπερβαίνει τους 37<sup>ο</sup>C) (κατάσταση καύσωνα).</p>

		<p>Η συνολική ψυκτική ικανότητα (ισχύς) εκτιμάται με δυνατότητα κάλυψης 50% ψυκτικού φορτίου σε συνθήκες σχεδιασμού για κτίρια 
		κατοικιών και 100% για κτίρια του τριτογενούς τομέα.</p>

		<p style=\"text-align: left;\"><strong>Μονάδα παραγωγής ψύξης</strong><br />";
		$txt .= teyxos_cold($zone["id"]);
		$txt .= "</p>";
		
		$txt.=$pagebreak;
		
		//ΣΥΣΤΗΜΑ ΑΕΡΙΣΜΟΥ
		$txt .= "<h3>6.".$zi.".6.3. Δεδομένα για το σύστημα αερισμού</h3>
		<p>Ο αερισμός που εφαρμόζεται σε όλους τους χώρους του κτιρίου είναι καταρχήν φυσικός και σύμφωνα με την Τ.Ο.Τ.Ε.Ε. 20701-1, 
		η παροχή του αέρα θα είναι ίση με τον απαιτούμενο νωπό αέρα. Από τον πίνακα 2.3 της Τ.Ο.Τ.Ε.Ε. 20701-1 λαμβάνεται συντελεστής 
		φυσικού αερισμού σε m<sup>3</sup>/h/m<sup>2</sup>. Επιπλέον του φυσικού αερισμού παρουσιάζονται παρακάτω επιπλέον συστήματα μηχανικού 
		αερισμού εφόσον απαιτούνται (πχ κτίρια τριτογενούς τομέα).</p>
		<p>Παρακάτω παρουσιάζονται οι εξής μονάδες από τις οποίες αποτελείται το σύστημα ψύξης της ζώνης:</p>
		<ul>
			<li>Η μονάδα παραγωγής θέρμανσης</li>
			<li>Το δίκτυο διανομής</li>
			<li>Οι τερματικές μονάδες</li>
			<li>Οι βοηθητικές μονάδες</li>
		</ul>
		<p><strong>Μονάδα αερισμού</strong>";
		$txt .= teyxos_aerp($zone["id"]);
		$txt .= "</p>";
		
		$txt.=$pagebreak;
		
		//ΖΕΣΤΑ ΝΕΡΑ ΧΡΗΣΗΣ
		$txt .= "<h3>6.".$zi.".6.4. Δεδομένα για το σύστημα ΖΝΧ</h3>
		<p>Για την παραγωγή ζεστού νερού χρήσης, χρησιμοποιείται το παρακάτω σύστημα όπως εμφανίζεται. Ο θερμαντήρας 
		τροφοδοτείται ταυτόχρονα με θερμική ενέργεια από τους ηλιακούς συλλέκτες στο δώμα και&nbsp; διαθέτει και εφεδρικό σύστημα 
		ηλεκτρικών αντιστάσεων.</p>
		<p>Το δίκτυο διανομής είναι μονωμένο σύμφωνα με τις ελάχιστες προδιαγραφές της Τ.Ο.Τ.Ε.Ε. 20701-1 και με ποσοστό απωλειών με 
		βάση τον πίνακα 4.16. Οι πλευρικές απώλειες των θερμαντήρων λαμβάνονται σύμφωνα με την Τ.Ο.Τ.Ε.Ε. 20701-1 (παρ. 4.8.4) με βάση 
		την τοποθέτηση και οι απώλειες λόγω εναλλάκτη θερμότητας λαμβάνονται επίσης από την ΤΟΤΕΕ-20701-1 εφόσον παρεμβάλεται 
		τέτοιος. Τα δεδομένα για το σύστημα ζεστού νερού χρήσης δίνονται στον πίνακα παρακάτω συνολικά όπως χρησιμοποιούνται στο λογισμικό 
		κατάταξης (ΤΕΕ-ΚΕΝΑΚ). </p>
		<p>Παρακάτω παρουσιάζονται οι εξής μονάδες από τις οποίες αποτελείται το σύστημα ΖΝΧ της ζώνης:</p>
		<ul>
			<li>Η μονάδα παραγωγής θέρμανσης</li>
			<li>Το δίκτυο διανομής</li>
			<li>Οι μονάδες αποθήκευσης</li>
			<li>Οι βοηθητικές μονάδες</li>
		</ul>

		<p style=\"text-align: left;\"><strong>Μονάδα αερισμού</strong><br />";
		$txt .= teyxos_znx($zone["id"]);
		$txt .= "</p>";
		
		$txt.=$pagebreak;
		
		//ΗΛΙΑΚΟΣ ΣΥΛΛΕΚΤΗΣ
		$txt .= "<h3>6.".$zi.".6.5. Δεδομένα για το σύστημα ηλιακών συλλεκτών</h3>
		<p>Οι ηλιακοί συλλέκτες που θα εγκατασταθούν στο δώμα, έχουν την δυνατότητα κάλυψης τουλάχιστον του 60% του συνολικού ΖΝΧ του 
		κτιρίου όπως παρουσιάζεται και στο τέυχος αναλυτικών υπολογισμών (μέθοδος f-charts). Παρακάτω παρουσιάζεται το σύνολο των 
		ηλιακών συλλεκτών που καλύπτουν την κάθε θερμική ζώνη.</p>

		<p style=\"text-align: left;\"><strong>Ηλιακοί Συλλέκτες</strong><br />";
		$txt .= teyxos_solar($zone["id"]);
		$txt .= "</p>";
		
		$txt.=$pagebreak;
		
		//ΥΣΤΗΜΑ ΦΩΤΙΣΜΟΥ
		$txt .= "<h3>6.".$zi.".6.6. Δεδομένα για το σύστημα φωτισμού</h3>
		<p>Ο φωτισμός σε κτίρια κατοικιών δεν λαμβάνεται υπ όψη στους υπολογισμούς (λογισμικό ΤΕΕ-ΚΕΝΑΚ) αν και παίζουν ρόλο στην ημερήσια 
		ενεργειακή κατανάλωση της θερμικής ζώνης. Αντίθετα στα κτίρια τριτογενούς τομέα λαμβάνεται υπ όψη και παρουσιάζεται εφόσον υπάρχει 
		παρακάτω με βάση την ΤΟΤΕΕ-20701-1 για κάθε ζώνη:</p>

		<p><strong>Σύστημα φωτισμού</strong><br/>";
		$txt .= teyxos_light($zone["id"]);
		$txt .= "</p>";
		
		$txt.=$pagebreak;
		
		//ΥΣΤΗΜΑ ΥΓΡΑΝΣΗΣ
		$txt .= "<h3>6.".$zi.".6.7. Δεδομένα για το σύστημα ύγρανσης</h3>
		<p>Εάν υπάρχει συμοληρωματικό σύστημα ύγρανσης για τη θερμική ζώνη παρουσιάζεται παρακάτω με βάση τα οριζόμενα στην 
		ΤΟΤΕΕ-20701-1 για κάθε ζώνη:</p>
		<p><strong>Σύστημα ύγρανσης</strong><br/>";
		$txt .= teyxos_ygr($zone["id"]);
		$txt .= "</p>";
		
		$txt.=$pagebreak;
		$zi++;
	}//Για κάθε ζώνη
	
	$txt .= "<h3>6.".$zi.". Δεδομένα κτιρίου αναφοράς</h3>

	<p>Τα δεδομένα του κτιρίου αναφοράς εισάγονται αυτόματα από το λογισμικό, παράλληλα με την εισαγωγή&nbsp; δεδομένων και 
	ανάλογα την χρήση και την λειτουργία του κτιρίου ή των θερμικών ζωνών και σύμφωνα με τα όσα ορίζονται&nbsp; στο άρθρο 9 
	του Κ.Εν.Α.Κ. και στην Τ.Ο.Τ.Ε.Ε. 20701-1. Σε κάθε περίπτωση το μοντέλο του κτιρίου αναφοράς εισάγεται αυτόματα από το 
	λογισμικό και ξεφεύγει από τα όρια της παρούσης.</p>";
	
	
	return $txt;
}


//ΚΕΦ 6 ΤΕΥΧΟΣ: Πίνακες κελύφους ζώνης ή ΜΘΧ
//Να προστεθούν οι διαχωριστικές
//$type: 1 για ζώνες, 2 για ΜΘΧ
//$contact: 1 αδιαφανή σε άερα, 2 διαφανή σε αέρα, 3 αδιαφανή σε ΜΘΧ, 4 διαφανή σε ΜΘΧ, 5 επαφή με έδαφος, 6 παθητικά ηλιακά
function teyxos_kelyfostables($type,$contact,$id){
	
	$database = new medoo(DB_NAME);
	//στοιχεία κτιρίου γενικά
	$building_data = $database->select("user_meletes","*",array("id"=>$_SESSION['meleti_id']));
	$building_g = $building_data[0]["pros"];
	$where=array(
		"AND"=>array(
			"user_id"=>$_SESSION['user_id'],
			"meleti_id"=>$_SESSION['meleti_id']
		)
	);
	
	if($type==1){//Στοιχεία που ανήκουν σε ζώνη
		$tb_walls="meletes_zone_adiafani";
		$tb_windows="meletes_zone_diafani";
		$tb_floors="meletes_zone_dapeda";
		$tb_roofs="meletes_zone_orofes";
		$where["AND"]["zone_id"]=$id;
	}
	if($type==2){//Στοιχεία που ανήκουν σε ΜΘΧ
		$tb_walls="meletes_mthx_adiafani";
		$tb_windows="meletes_mthx_diafani";
		$tb_floors="meletes_mthx_dapeda";
		$tb_roofs="meletes_mthx_orofes";
		$where["AND"]["mthx_id"]=$id;
	}
	$zone_wall = $database->select($tb_walls,"*",$where);
	$zone_window = $database->select($tb_windows,"*",$where);
	$zone_dapeda = $database->select($tb_floors,"*",$where);
	$zone_orofes = $database->select($tb_roofs,"*",$where);
	
	$txt = "";
	
	$txt_adiafani_air = "";
	$txt_adiafani_air .= "<table>
	<tr>
	<td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"14\">Αδιαφανή σε αέρα</td>
	</tr>
	<tr>
	<td style=\"background-color:#eaeaea;\">Τύπος</td>
	<td style=\"background-color:#eaeaea;\">Όνομα</td>
	<td style=\"background-color:#eaeaea;\">γ</td>
	<td style=\"background-color:#eaeaea;\">β</td>
	<td style=\"background-color:#eaeaea;\">Ε</td>
	<td style=\"background-color:#eaeaea;\">U</td>
	<td style=\"background-color:#eaeaea;\">α</td>
	<td style=\"background-color:#eaeaea;\">ε</td>
	<td style=\"background-color:#eaeaea;\">Fhor_h</td>
	<td style=\"background-color:#eaeaea;\">Fhor_c</td>
	<td style=\"background-color:#eaeaea;\">Fov_h</td>
	<td style=\"background-color:#eaeaea;\">Fov_c</td>
	<td style=\"background-color:#eaeaea;\">Ffin_h</td>
	<td style=\"background-color:#eaeaea;\">Ffin_c</td>
	</tr>
	";
	
	$txt_adiafani_mthx = "";
	$txt_adiafani_mthx .= "<table>
	<tr>
	<td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"14\">Αδιαφανή σε επαφή με ΜΘΧ</td>
	</tr>
	<tr>
	<td style=\"background-color:#eaeaea;\">Τύπος</td>
	<td style=\"background-color:#eaeaea;\">Όνομα</td>
	<td style=\"background-color:#eaeaea;\">γ</td>
	<td style=\"background-color:#eaeaea;\">β</td>
	<td style=\"background-color:#eaeaea;\">Ε</td>
	<td style=\"background-color:#eaeaea;\">U</td>
	<td style=\"background-color:#eaeaea;\">α</td>
	<td style=\"background-color:#eaeaea;\">ε</td>
	<td style=\"background-color:#eaeaea;\">Fhor_h</td>
	<td style=\"background-color:#eaeaea;\">Fhor_c</td>
	<td style=\"background-color:#eaeaea;\">Fov_h</td>
	<td style=\"background-color:#eaeaea;\">Fov_c</td>
	<td style=\"background-color:#eaeaea;\">Ffin_h</td>
	<td style=\"background-color:#eaeaea;\">Ffin_c</td>
	</tr>
	";
	
	$txt_diafani_air = "";
	$txt_diafani_air .= "<table>
	<tr>
	<td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"14\">Διαφανή σε επαφή με αέρα</td>
	</tr>
	<tr>
	<td style=\"background-color:#eaeaea;\">Τύπος</td>
	<td style=\"background-color:#eaeaea;\">Περιγραφή</td>
	<td style=\"background-color:#eaeaea;\">γ</td>
	<td style=\"background-color:#eaeaea;\">β</td>
	<td style=\"background-color:#eaeaea;\">Ε</td>
	<td style=\"background-color:#eaeaea;\">Τύπος ανοίγματος</td>
	<td style=\"background-color:#eaeaea;\">U</td>
	<td style=\"background-color:#eaeaea;\">gw</td>
	<td style=\"background-color:#eaeaea;\">Fhor_h</td>
	<td style=\"background-color:#eaeaea;\">Fhor_c</td>
	<td style=\"background-color:#eaeaea;\">Fov_h</td>
	<td style=\"background-color:#eaeaea;\">Fov_c</td>
	<td style=\"background-color:#eaeaea;\">Ffin_h</td>
	<td style=\"background-color:#eaeaea;\">Ffin_c</td>
	</tr>
	";
	
	$txt_diafani_mthx = "";
	$txt_diafani_mthx .= "<table>
	<tr>
	<td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"14\">Διαφανή σε επαφή με ΜΘΧ</td>
	</tr>
	<tr>
	<td style=\"background-color:#eaeaea;\">Τύπος</td>
	<td style=\"background-color:#eaeaea;\">Περιγραφή</td>
	<td style=\"background-color:#eaeaea;\">γ</td>
	<td style=\"background-color:#eaeaea;\">β</td>
	<td style=\"background-color:#eaeaea;\">Ε</td>
	<td style=\"background-color:#eaeaea;\">Τύπος ανοίγματος</td>
	<td style=\"background-color:#eaeaea;\">U</td>
	<td style=\"background-color:#eaeaea;\">gw</td>
	<td style=\"background-color:#eaeaea;\">Fhor_h</td>
	<td style=\"background-color:#eaeaea;\">Fhor_c</td>
	<td style=\"background-color:#eaeaea;\">Fov_h</td>
	<td style=\"background-color:#eaeaea;\">Fov_c</td>
	<td style=\"background-color:#eaeaea;\">Ffin_h</td>
	<td style=\"background-color:#eaeaea;\">Ffin_c</td>
	</tr>
	";
	
	$txt_passive = "";
	$txt_passive .= "<table>
	<tr>
	<td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"14\">Διαφανή - Παθητικά ηλιακά</td>
	</tr>
	<tr>
	<td style=\"background-color:#eaeaea;\">Τύπος</td>
	<td style=\"background-color:#eaeaea;\">Περιγραφή</td>
	<td style=\"background-color:#eaeaea;\">γ</td>
	<td style=\"background-color:#eaeaea;\">β</td>
	<td style=\"background-color:#eaeaea;\">Ε</td>
	<td style=\"background-color:#eaeaea;\">Τύπος ανοίγματος</td>
	<td style=\"background-color:#eaeaea;\">U</td>
	<td style=\"background-color:#eaeaea;\">gw</td>
	<td style=\"background-color:#eaeaea;\">Fhor_h</td>
	<td style=\"background-color:#eaeaea;\">Fhor_c</td>
	<td style=\"background-color:#eaeaea;\">Fov_h</td>
	<td style=\"background-color:#eaeaea;\">Fov_c</td>
	<td style=\"background-color:#eaeaea;\">Ffin_h</td>
	<td style=\"background-color:#eaeaea;\">Ffin_c</td>
	</tr>
	";
	
	$txt_edafos = "";
	$txt_edafos .= "<table>
	<tr>
	<td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"7\">Επαφή με έδαφος</td>
	</tr>
	<tr>
	<td style=\"background-color:#eaeaea;\">Τύπος</td>
	<td style=\"background-color:#eaeaea;\">Περιγραφή</td>
	<td style=\"background-color:#eaeaea;\">Ε</td>
	<td style=\"background-color:#eaeaea;\">U</td>
	<td style=\"background-color:#eaeaea;\">Κ. Βάθος (m)</td>
	<td style=\"background-color:#eaeaea;\">Α. Βάθος (m)</td>
	<td style=\"background-color:#eaeaea;\">Περίμετρος (m)</td>
	</tr>
	";
	
	
	$data_prefs = $database->select("user_meletes","symptiksi",array("id"=>$_SESSION["meleti_id"]) );
	$symptiksi = $data_prefs[0];
	
	
	$aa=1;
	foreach($zone_wall as $wall){
	$adiafani_row = "";
	$diafani_row = "";
	$passive_row = "";
	$wall_edafos="";
	$wall_air="";
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
			$dok_h = 0;
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
		$data_window = $database->select($tb_windows,"*",array("wall_id"=>$wall['id']) );
		foreach($data_window as $window){
		$win = "";
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
				$win = "<tr>";
				$win .= "<td>Πόρτα</td>";
				$win .= "<td>".$window_name."</td>";
				$win .= "<td>".$wall_g."</td>";
				$win .= "<td>".$wall["b"]."</td>";
				$win .= "<td>".$window_e."</td>";
				$win .= "<td>".$window_u."</td>";
				$win .= "<td>".$ap."</td>";
				$win .= "<td>".$ek."</td>";
				$win .= "<td>".$fhor_h_w."</td>";
				$win .= "<td>".$fhor_c_w."</td>";
				$win .= "<td>".$fov_h_w."</td>";
				$win .= "<td>".$fov_c_w."</td>";
				$win .= "<td>".$ffin_h_w."</td>";
				$win .= "<td>".$ffin_c_w."</td>";
				$win .= "</tr>";
				
				if($wall["type"]==0 OR $wall["type"]==3){//εάν ο τοίχος έχει επαφή σε αέρα
					$txt_adiafani_air .= $win;
				}
				if($wall["type"]==1){//εάν ο τοίχος έχει επαφή σε ΜΘΧ
					$txt_adiafani_mthx .= $win;
				}
		}else{//Αλλιώς στα διαφανή
			$win = "<tr>";
			$win .= "<td>Ανοιγόμενο κούφωμα</td>";
			$win .= "<td>".$window_name."</td>";
			$win .= "<td>".$wall_g."</td>";
			$win .= "<td>".$wall["b"]."</td>";
			$win .= "<td>".$window_e."</td>";
			$win .= "<td></td>";
			$win .= "<td>".$window_u."</td>";
			$win .= "<td>".$window_gw."</td>";
			$win .= "<td>".$fhor_h_w."</td>";
			$win .= "<td>".$fhor_c_w."</td>";
			$win .= "<td>".$fov_h_w."</td>";
			$win .= "<td>".$fov_c_w."</td>";
			$win .= "<td>".$ffin_h_w."</td>";
			$win .= "<td>".$ffin_c_w."</td>";
			$win .= "</tr>";
			
			if($window["passive"]==1){
				$txt_passive .= $win;
			}else{
				if($wall["type"]==0 OR $wall["type"]==3){//εάν ο τοίχος έχει επαφή σε αέρα
					$txt_diafani_air .= $win;
				}
				if($wall["type"]==1){//εάν ο τοίχος έχει επαφή σε ΜΘΧ
					$txt_diafani_mthx .= $win;
				}
			}
		}//Επιλογή καρτέλας
		
		}//Παράθυρα
		
	
		//Καθαρό εμβαδόν τοίχου
		$wall_e_adiafanes = $wall_e_sum - $window_sume;//Ο τοίχος χωρίς παράθυρα
		$wall_e = $wall_e_sum - $syr_e - $yp_e - $dok_e - $window_sume;//Ο τοίχος χωρίς φέρων/παράθυρα
		$u_sum = ($wall_e*$u + $syr_e*$syr_u + $yp_e*$yp_u + $dok_e*$dok_u)/$wall_e_adiafanes;//Μέσος συντελεστής
		
		if($wall["type"]==3){
			$toixos_per="Μεσοτοιχία";
		}else{
			$toixos_per="Τοίχος";
		}
		
		if($wall["type"]!=2){//εάν ο τοίχος έχει επαφή σε αέρα ή σε ΜΘΧ έχει τη μορφή με σκιάσεις	
			if($symptiksi==1){//1 γραμμή για τον τοίχο
			//Εκτύπωση γραμμής τοίχου
				$wall_air = "<tr>
				<td>".$toixos_per."</td>
				<td>".$wall["name"]."</td>
				<td>".$wall_g."</td>
				<td>".$wall["b"]."</td>
				<td>".$wall_e_adiafanes."</td>
				<td>".$u_sum."</td>
				<td>".$ap."</td>
				<td>".$ek."</td>
				<td>".$fhor_h."</td>
				<td>".$fhor_c."</td>
				<td>".$fov_h."</td>
				<td>".$fov_c."</td>
				<td>".$ffin_h."</td>
				<td>".$ffin_c."</td>
				</tr>";
			$aa++;
			}else{
			//Εκτύπωση γραμμής τοίχου
				$wall_air = "<tr>
				<td>".$toixos_per."</td>
				<td>".$wall["name"]."</td>
				<td>".$wall_g."</td>
				<td>".$wall["b"]."</td>
				<td>".$wall_e."</td>
				<td>".$u."</td>
				<td>".$ap."</td>
				<td>".$ek."</td>
				<td>".$fhor_h."</td>
				<td>".$fhor_c."</td>
				<td>".$fov_h."</td>
				<td>".$fov_c."</td>
				<td>".$ffin_h."</td>
				<td>".$ffin_c."</td>
				</tr>";
				$aa++;
				
				if($yp_e!=0){
					if($per!=0){
						$txt_ypost="[Φέρων-".$per."%]-";
					}else{
						$txt_ypost="Υποστηλώματα-";
					}
				//Εκτύπωση γραμμής υποστηλωμάτων
				$wall_air .= "<tr>
				<td>".$toixos_per."</td>
				<td>".$txt_ypost.$wall["name"]."</td>
				<td>".$wall_g."</td>
				<td>".$wall["b"]."</td>
				<td>".$yp_e."</td>
				<td>".$yp_u."</td>
				<td>".$ap."</td>
				<td>".$ek."</td>
				<td>".$fhor_h."</td>
				<td>".$fhor_c."</td>
				<td>".$fov_h."</td>
				<td>".$fov_c."</td>
				<td>".$ffin_h."</td>
				<td>".$ffin_c."</td>
				</tr>";
				$aa++;
				}
				
				if($dok_e!=0){
					if($per==0){//μόνο εάν δεν υπάρχει % φέρων
					//Εκτύπωση γραμμής δοκών
					$wall_air .= "<tr>
					<td>".$toixos_per."</td>
					<td>Δοκοί-".$wall["name"]."</td>
					<td>".$wall_g."</td>
					<td>".$wall["b"]."</td>
					<td>".$dok_e."</td>
					<td>".$dok_u."</td>
					<td>".$ap."</td>
					<td>".$ek."</td>
					<td>".$fhor_h."</td>
					<td>".$fhor_c."</td>
					<td>".$fov_h."</td>
					<td>".$fov_c."</td>
					<td>".$ffin_h."</td>
					<td>".$ffin_c."</td>
					</tr>";
					$aa++;
					}
				}
				
				if($syr_e!=0){
				//Εκτύπωση γραμμής συρομένων
				$wall_air .= "<tr>
				<td>".$toixos_per."</td>
				<td>Με διάκενο-".$wall["name"]."</td>
				<td>".$wall_g."</td>
				<td>".$wall["b"]."</td>
				<td>".$syr_e."</td>
				<td>".$syr_u."</td>
				<td>".$ap."</td>
				<td>".$ek."</td>
				<td>".$fhor_h."</td>
				<td>".$fhor_c."</td>
				<td>".$fov_h."</td>
				<td>".$fov_c."</td>
				<td>".$ffin_h."</td>
				<td>".$ffin_c."</td>
				</tr>";
				$aa++;
				}
				
			}//4 γραμμές τοίχου
			
			if($wall["type"]==0 OR $wall["type"]==3){//εάν ο τοίχος έχει επαφή σε αέρα
				$txt_adiafani_air .= $wall_air;
			}
			if($wall["type"]==1){//εάν ο τοίχος έχει επαφή σε ΜΘΧ
				$txt_adiafani_mthx .= $wall_air;
			}
		}//εάν ο τοίχος έχει τη μορφή πίνακα με σκιάσεις
		
		
		if($wall["type"]==2){ //ο τοίχος έχει τη μορφή επαφής σε έδαφος
			if($symptiksi==1){//1 γραμμή για τον τοίχο
				//Εκτύπωση γραμμής τοίχου
				$wall_edafos = "<tr>
				<td>".$toixos_per."</td>
				<td>".$wall["name"]."</td>
				<td>".$wall_e_sum."</td>
				<td>".$u_sum."</td>
				<td>".$wall["z1"]."</td>
				<td>".$wall["z2"]."</td>
				<td></td>
				</tr>";
			$aa++;
			}else{
			//Εκτύπωση γραμμής τοίχου
				$wall_edafos = "<tr>
				<td>".$toixos_per."</td>
				<td>".$wall["name"]."</td>
				<td>".$wall_e."</td>
				<td>".$u."</td>
				<td>".$wall["z1"]."</td>
				<td>".$wall["z2"]."</td>
				<td></td>
				</tr>";
				$aa++;
				
				if($yp_e!=0){
					if($per!=0){
						$txt_ypost="[Φέρων-".$per."%]-";
					}else{
						$txt_ypost="Υποστηλώματα-";
					}
				//Εκτύπωση γραμμής υποστηλωμάτων
				$wall_edafos .= "<tr>
				<td>".$toixos_per."</td>
				<td>".$txt_ypost.$wall["name"]."</td>
				<td>".$yp_e."</td>
				<td>".$yp_u."</td>
				<td>".$wall["z1"]."</td>
				<td>".$wall["z2"]."</td>
				<td></td>
				</tr>";
				$aa++;
				}
				
				if($dok_e!=0){
					if($per==0){//μόνο εάν δεν υπάρχει % φέρων
					//Εκτύπωση γραμμής δοκών
					$wall_edafos .= "<tr>
					<td>".$toixos_per."</td>
					<td>Δοκοί-".$wall["name"]."</td>
					<td>".$dok_e."</td>
					<td>".$dok_u."</td>
					<td>".$wall["z1"]."</td>
					<td>".$wall["z2"]."</td>
					<td></td>
					</tr>";
					$aa++;
					}
				}
				
				if($syr_e!=0){
				//Εκτύπωση γραμμής συρομένων
				$wall_edafos .= "<tr>
				<td>".$toixos_per."</td>
				<td>Με διάκενο-".$wall["name"]."</td>
				<td>".$syr_e."</td>
				<td>".$syr_u."</td>
				<td>".$wall["z1"]."</td>
				<td>".$wall["z2"]."</td>
				<td></td>
				</tr>";
				$aa++;
				}
				
			}//4 γραμμές τοίχου
			
		$txt_edafos .= $wall_edafos;
		}//ο τοίχος έχει τη μορφή πίνακα σε έδαφος
		
	}//για κάθε τοίχο
	
	
	//ΟΡΟΦΕΣ - 0 σε αέρα, 1 σε ΜΘΧ
	$aa=1;
	foreach($zone_orofes as $orofi){
		
		$adiafani_row="";
		$diafani_row="";
		$passive_row="";
	
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
		$data_windowor = $database->select($tb_windows,"*",array("roof_id"=>$orofi['id']) );
		foreach($data_windowor as $window){
			$win = "";
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
				$win = "<tr>";
				$win .= "<td>Πόρτα</td>";
				$win .= "<td>".$window_name."</td>";
				$win .= "<td>".$orofi["g"]."</td>";
				$win .= "<td>".$orofi["b"]."</td>";
				$win .= "<td>".$window_e."</td>";
				$win .= "<td>".$window_u."</td>";
				$win .= "<td>".$orofi_ap."</td>";
				$win .= "<td>".$orofi_ek."</td>";
				$win .= "<td>".$orofi["fhor_h"]."</td>";
				$win .= "<td>".$orofi["fhor_c"]."</td>";
				$win .= "<td>".$orofi["fov_h"]."</td>";
				$win .= "<td>".$orofi["fov_c"]."</td>";
				$win .= "<td>".$orofi["ffin_h"]."</td>";
				$win .= "<td>".$orofi["ffin_c"]."</td>";
				$win .= "</tr>";
				
				if($orofi["type"]==0){ //Οροφή σε αέρα	
					$txt_adiafani_air .= $win;
				}//Οροφή σε αέρα
				if($orofi["type"]==1){ //Οροφή σε ΜΘΧ	
					$txt_adiafani_mthx .= $win;
				}//Οροφή σε ΜΘΧ
			}else{//Αλλιώς στα διαφανή
				$win = "<tr>";
				$win .= "<td>Ανοιγόμενο κούφωμα</td>";
				$win .= "<td>".$window_name."</td>";
				$win .= "<td>".$orofi["g"]."</td>";
				$win .= "<td>".$orofi["b"]."</td>";
				$win .= "<td>".$window_e."</td>";
				$win .= "<td></td>";
				$win .= "<td>".$window_u."</td>";
				$win .= "<td>".$window_gw."</td>";
				$win .= "<td>".$orofi["fhor_h"]."</td>";
				$win .= "<td>".$orofi["fhor_c"]."</td>";
				$win .= "<td>".$orofi["fov_h"]."</td>";
				$win .= "<td>".$orofi["fov_c"]."</td>";
				$win .= "<td>".$orofi["ffin_h"]."</td>";
				$win .= "<td>".$orofi["ffin_c"]."</td>";
				$win .= "</tr>";
				
				if($window["passive"]==1){
					$txt_passive .= $win;
				}else{
					if($orofi["type"]==0){ //Οροφή σε αέρα
						$txt_diafani_air .= $win;
					}//Οροφή σε αέρα
					if($orofi["type"]==1){ //Οροφή σε ΜΘΧ	
						$txt_diafani_mthx .= $win;
					}//Οροφή σε ΜΘΧ
				}
			}//Επιλογή καρτέλας
			
		}//Παράθυρα
		
		$orofi_e=0;
		$orofi_e=$orofi["e"]-$window_sume;
		$orofi_row="";
		
		//Γραμμή οροφής
		$orofi_row = "<tr>";
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
		
		if($orofi["type"]==0){ //Οροφή σε αέρα	
			$txt_adiafani_air .= $orofi_row;
		}//Οροφή σε αέρα
		if($orofi["type"]==1){ //Οροφή σε ΜΘΧ	
			$txt_adiafani_mthx .= $orofi_row;
		}//Οροφή σε ΜΘΧ
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
		if($dapedo["type"]==0){ //Δάπεδο σε έδαφος - Μορφή εδάφους
			//Εκτύπωση δαπέδου στις γραμμές επαφής με έδαφος
			$dapedo_row .= "<tr>";
			$dapedo_row .= "<td>Δάπεδο</td>";
			$dapedo_row .= "<td>".$dapedo["name"]."</td>";
			$dapedo_row .= "<td>".$dapedo["e"]."</td>";
			$dapedo_row .= "<td>".$dapedo_u."</td>";
			$dapedo_row .= "<td>".$dapedo["z"]."</td>";
			$dapedo_row .= "<td></td>";
			$dapedo_row .= "<td>".$dapedo["p"]."</td>";
			$dapedo_row .= "</tr>";
			
		$txt_edafos .= $dapedo_row;
		
		}//Δάπεδο σε έδαφος
		if($dapedo["type"]!=0){//Μορφή με σκιάσεις - Δάπεδο σε αέρα ή ΜΘΧ
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
			
			if($dapedo["type"]==1){//Δάπεδο σε ΜΘΧ
				$txt_adiafani_mthx .= $dapedo_row;
			}//Δάπεδο σε ΜΘΧ
			if($dapedo["type"]==2){//Δάπεδο σε πυλωτή
				$txt_adiafani_air .= $dapedo_row;
			}//Δάπεδο σε πυλωτή
			
		}//Δάπεδο σε αέρα ή ΜΘΧ
		$aa++;
	}//Για κάθε δάπεδο
	
	
	
	$txt_adiafani_air .= "</table>";
	$txt_adiafani_mthx .= "</table>";
	$txt_diafani_air .= "</table>";
	$txt_diafani_mthx .= "</table>";
	$txt_passive .= "</table>";
	$txt_edafos .= "</table>";
	
	$txt="";
	if($contact==1){
		$txt=$txt_adiafani_air;
	}
	if($contact==2){
		$txt=$txt_diafani_air;
	}
	if($contact==3){
		$txt=$txt_adiafani_mthx;
	}
	if($contact==4){
		$txt=$txt_diafani_mthx;
	}
	if($contact==5){
		$txt=$txt_edafos;
	}
	if($contact==6){
		$txt=$txt_passive;
	}
	return $txt;
}


//ΚΕΦ 6 ΤΕΥΧΟΣ: Σύστημα θέρμανσης
function teyxos_therm($id){
	
	$database = new medoo(DB_NAME);

	$tb_sys_thermp="meletes_zone_sys_thermp";
	$tb_sys_thermd="meletes_zone_sys_thermd";
	$tb_sys_thermt="meletes_zone_sys_thermt";
	$tb_sys_thermv="meletes_zone_sys_thermv";
	$col="*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$id));
	$sys_thermp = $database->select($tb_sys_thermp,"*",$where);
	$sys_thermd = $database->select($tb_sys_thermd,"*",$where);
	$sys_thermt = $database->select($tb_sys_thermt,"*",$where);
	$sys_thermv = $database->select($tb_sys_thermv,"*",$where);
	
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
		0=>"Εσωτερικοί  ή έως και 20% σε εξωτερικούς",
		1=>"Πάνω από 20% σε εξωτερικούς"
	);
	$array_thermv_type = array(
		0=>"Αντλίες",
		1=>"Κυκλοφορητές",
		2=>"Ηλεκτροβάνες",
		3=>"Ανεμιστήρες"
	);
	
	$txt = "";
	
	$txt .= "<table>
	<tr>
	<td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"2\">Σύστημα θέρμανσης</td>
	</tr>
	<tr>
	<td style=\"text-align:center; background-color:#eaeaea;\" colspan=\"2\">Μονάδες παραγωγής</td>
	</tr>";
	foreach($sys_thermp as $thermp){
	$txt .= "
	<tr>
		<td style=\"background-color:#eaeaea;\">Τύπος</td>
		<td>".$array_thermp_type[$thermp["type"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Πηγή ενέργειας</td>
		<td>".$array_pigi[$thermp["pigi"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Ισχύς (KW)</td>
		<td>".$thermp["w"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Βαθμός απόδοσης n (-)</td>
		<td>".$thermp["n"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Βαθμός επίδοσης COP (-)</td>
		<td>".$thermp["cop"]."</td>
	</tr>";
	}
	
	$thermd = $sys_thermd[0];
	$txt .= "
	<tr>
	<td style=\"text-align:center; background-color:#eaeaea;\" colspan=\"2\">Δίκτυο διανομής</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Ισχύς δικτύου διανομής</td>
		<td>".$thermd["d_w"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Χώρος διέλευσης δικτύου διανομής</td>
		<td>".$array_dtype[$thermd["d_type"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Βαθμός απόδοσης δικτύου διανομής</td>
		<td>".$thermd["d_n"]."</td>
	</tr>";
	
	$thermt = $sys_thermt[0];
	$txt .= "
	<tr>
	<td style=\"text-align:center; background-color:#eaeaea;\" colspan=\"2\">Τερματικές μονάδες</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Είδος τερματικών μονάδων θέρμανσης χώρων</td>
		<td>".$thermt["type"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Θερμική απόδοση τερματικών μονάδων</td>
		<td>".$thermt["n"]."</td>
	</tr>";
	
	foreach($sys_thermv as $thermv){
		$txt .= "
	<tr>
	<td style=\"text-align:center; background-color:#eaeaea;\" colspan=\"2\">Βοηθητικές μονάδες</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Τύπος βοηθητικών συστημάτων</td>
		<td>".$array_thermv_type[$thermv["type"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Αριθμός συστημάτων</td>
		<td>".$thermv["n"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Ισχύς βοηθητικών συστημάτων (kW)</td>
		<td>".$thermv["w"]."</td>
	</tr>";
	}
	
	$txt .= "</table>";
	
	return $txt;
	
}


//ΚΕΦ 6 ΤΕΥΧΟΣ: Σύστημα Ψύξης
function teyxos_cold($id){
	
	$database = new medoo(DB_NAME);

	$tb_sys_coldp="meletes_zone_sys_coldp";
	$tb_sys_coldd="meletes_zone_sys_coldd";
	$tb_sys_coldt="meletes_zone_sys_coldt";
	$tb_sys_coldv="meletes_zone_sys_coldv";
	$col="*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$id));
	$sys_coldp = $database->select($tb_sys_coldp,"*",$where);
	$sys_coldd = $database->select($tb_sys_coldd,"*",$where);
	$sys_coldt = $database->select($tb_sys_coldt,"*",$where);
	$sys_coldv = $database->select($tb_sys_coldv,"*",$where);
	
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
		0=>"Εσωτερικοί  ή έως και 20% σε εξωτερικούς",
		1=>"Πάνω από 20% σε εξωτερικούς"
	);
	$array_coldv_type = array(
		0=>"Αντλίες",
		1=>"Κυκλοφορητές",
		2=>"Ηλεκτροβάνες",
		3=>"Ανεμιστήρες",
		4=>"Πύργος ψύξης"
	);
	
	$txt = "";
	
	$txt .= "<table>
	<tr>
	<td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"2\">Σύστημα ψύξης</td>
	</tr>
	<tr>
	<td style=\"text-align:center; background-color:#eaeaea;\" colspan=\"2\">Μονάδες παραγωγής</td>
	</tr>";
	foreach($sys_coldp as $coldp){
	$txt .= "
	<tr>
		<td style=\"background-color:#eaeaea;\">Τύπος</td>
		<td>".$array_coldp_type[$coldp["type"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Πηγή ενέργειας</td>
		<td>".$array_pigi[$coldp["pigi"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Ισχύς (KW)</td>
		<td>".$coldp["w"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Βαθμός απόδοσης n (-)</td>
		<td>".$coldp["n"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Βαθμός επίδοσης EER (-)</td>
		<td>".$coldp["eer"]."</td>
	</tr>";
	}
	
	$coldd = $sys_coldd[0];
	$txt .= "
	<tr>
	<td style=\"text-align:center; background-color:#eaeaea;\" colspan=\"2\">Δίκτυο διανομής</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Ισχύς δικτύου διανομής</td>
		<td>".$coldd["d_w"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Χώρος διέλευσης δικτύου διανομής</td>
		<td>".$array_dtype[$coldd["d_type"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Βαθμός απόδοσης δικτύου διανομής</td>
		<td>".$coldd["d_n"]."</td>
	</tr>";
	
	$coldt = $sys_coldt[0];
	$txt .= "
	<tr>
	<td style=\"text-align:center; background-color:#eaeaea;\" colspan=\"2\">Τερματικές μονάδες</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Είδος τερματικών μονάδων ψύξης χώρων</td>
		<td>".$coldt["type"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Ψυκτική απόδοση τερματικών μονάδων</td>
		<td>".$coldt["n"]."</td>
	</tr>";
	
	foreach($sys_coldv as $coldv){
		$txt .= "
	<tr>
	<td style=\"text-align:center; background-color:#eaeaea;\" colspan=\"2\">Βοηθητικές μονάδες</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Τύπος βοηθητικών συστημάτων</td>
		<td>".$array_coldv_type[$coldv["type"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Αριθμός συστημάτων</td>
		<td>".$coldv["n"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Ισχύς βοηθητικών συστημάτων (kW)</td>
		<td>".$coldv["w"]."</td>
	</tr>";
	}
	
	$txt .= "</table>";
	
	return $txt;
	
}


//ΚΕΦ 6 ΤΕΥΧΟΣ: Σύστημα Αερισμού
function teyxos_aerp($id){
	
	$database = new medoo(DB_NAME);

	$tb_zone_xrisi = "vivliothiki_conditions";
	$tb_sys_aerp="meletes_zone_sys_aerp";
	$col="*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$id));
	$sys_aerp = $database->select($tb_sys_aerp,"*",$where);
	
	$tb_zones="meletes_zones";
	$select_zone=$database->select($tb_zones,"*",array("id"=>$id));
	$zone=$select_zone[0];
	
	$conditions=$database->select($tb_zone_xrisi, $col, array("id"=>$zone["xrisi"]) );
	$conditions=$conditions[0];
		
	$array_true=array(
		0=>"NAI",
		1=>"OXI"
	);
	
	$txt = "";
	
	$txt .= "<br/><table>
	<tr>
	<td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"2\">Σύστημα αερισμού</td>
	</tr>
	<tr>
	<td style=\"text-align:center; background-color:#eaeaea;\" colspan=\"2\">Μονάδες παραγωγής</td>
	</tr>";
	foreach($sys_aerp as $aerp){
	$txt .= "
	<tr>
		<td style=\"background-color:#eaeaea;\">Άτομα/100 m<sup>2</sup> (-)</td>
		<td>".$conditions["atoma"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Νωπός αέρας (m<sup>3</sup>/h/άτομο)</td>
		<td>".$conditions["nwpos_aeras_per"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Νωπός αέρας (m<sup>3</sup>/h/m<sup>2</sup>)</td>
		<td>".$conditions["nwpos_aeras_m2"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Τύπος</td>
		<td>".$aerp["type"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Τμήμα θέρμανσης</td>
		<td>".$array_true[$aerp["active_h"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">F_h (m<sup>3</sup>/h)</td>
		<td>".$aerp["f_h"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">R_h (Συντελεστής ανακυκλοφορίας αέρα-Τμήμα Θέρμανσης)</td>
		<td>".$aerp["r_h"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Q_r_h (Συντελεστής ανάκτησης θερμότητας-Τμήμα Θέρμανσης)</td>
		<td>".$aerp["q_r_h"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Τμήμα Ψύξης</td>
		<td>".$array_true[$aerp["active_c"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">F_c (m<sup>3</sup>/h)</td>
		<td>".$aerp["f_c"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">R_c (Συντελεστής ανακυκλοφορίας αέρα-Τμήμα Ψύξης)</td>
		<td>".$aerp["r_c"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Q_r_c (Συντελεστής ανάκτησης θερμότητας-Τμήμα Ψύξης)</td>
		<td>".$aerp["q_r_c"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Τμήμα Ύγρανσης</td>
		<td>".$array_true[$aerp["active_y"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">H_r (Συντελεστής ανάκτησης υγρασίας-Τμήμα Ύγρανσης)</td>
		<td>".$aerp["h_r"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Φίλτρα</td>
		<td>".$aerp["filters"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Ειδική ηλεκτρική ισχύς E_vent (kW/m<sup>3</sup>/s)</td>
		<td>".$aerp["e_vent"]."</td>
	</tr>";
	}
	
	
	$txt .= "</table><br/>";
	
	return $txt;
	
}


//ΚΕΦ 6 ΤΕΥΧΟΣ: Σύστημα ZNX
function teyxos_znx($id){
	
	$database = new medoo(DB_NAME);

	$tb_sys_znxp="meletes_zone_sys_znxp";
	$tb_sys_znxd="meletes_zone_sys_znxd";
	$tb_sys_znxt="meletes_zone_sys_znxt";
	$tb_sys_znxv="meletes_zone_sys_znxv";
	$col="*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$id));
	$sys_znxp = $database->select($tb_sys_znxp,"*",$where);
	$sys_znxd = $database->select($tb_sys_znxd,"*",$where);
	$sys_znxt = $database->select($tb_sys_znxt,"*",$where);
	$sys_znxv = $database->select($tb_sys_znxv,"*",$where);
	
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
	$array_znxp_type = array(
		0=>"Λέβητας",
		1=>"Τηλεθέρμανση",
		2=>"ΣΗΘ",
		3=>"Αντλία θερμότητας (Α.Θ.)",
		4=>"Τοπικός ηλεκτρικός θερμαντήρας",
		5=>"Τοπική μονάδα φυσικού αερίου",
		6=>"Μονάδα παραγωγής (κεντρική) άλλου τύπου"
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
		0=>"Εσωτερικοί  ή έως και 20% σε εξωτερικούς",
		1=>"Πάνω από 20% σε εξωτερικούς"
	);
	$array_znxv_type = array(
		0=>"Αντλίες",
		1=>"Κυκλοφορητές",
		2=>"Ηλεκτροβάνες",
		3=>"Άλλου τύπου"
	);
	
	$txt = "";
	
	$txt .= "<table>
	<tr>
	<td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"2\">Σύστημα θέρμανσης</td>
	</tr>
	<tr>
	<td style=\"text-align:center; background-color:#eaeaea;\" colspan=\"2\">Μονάδες παραγωγής</td>
	</tr>";
	foreach($sys_znxp as $znxp){
	$txt .= "
	<tr>
		<td style=\"background-color:#eaeaea;\">Τύπος</td>
		<td>".$array_znxp_type[$znxp["type"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Πηγή ενέργειας</td>
		<td>".$array_pigi[$znxp["pigi"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Ισχύς (KW)</td>
		<td>".$znxp["w"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Βαθμός απόδοσης n (-)</td>
		<td>".$znxp["n"]."</td>
	</tr>";
	}
	
	$znxd = $sys_znxd[0];
	$txt .= "
	<tr>
	<td style=\"text-align:center; background-color:#eaeaea;\" colspan=\"2\">Δίκτυο διανομής</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Τύπος δικτύου διανομής ΖΝΧ</td>
		<td>".$znxd["type"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Ανακυκλοφορία δικτύου ΖΝΧ</td>
		<td>".$array_true[$znxd["ana"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Χώρος διέλευσης δικτύου ΖΝΧ</td>
		<td>".$array_dtype[$znxd["dieleysi"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Βαθμός απόδοσης δικτύου ΖΝΧ</td>
		<td>".$znxd["n"]."</td>
	</tr>";
	
	$znxt = $sys_znxt[0];
	$txt .= "
	<tr>
	<td style=\"text-align:center; background-color:#eaeaea;\" colspan=\"2\">Τερματικές μονάδες</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Είδος αποθηκευτικών μονάδων ΖΝΧ</td>
		<td>".$znxt["type"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Θερμική απόδοση αποθηκευτικών μονάδων</td>
		<td>".$znxt["n"]."</td>
	</tr>";
	
	foreach($sys_znxv as $znxv){
	$txt .= "
	<tr>
	<td style=\"text-align:center; background-color:#eaeaea;\" colspan=\"2\">Βοηθητικές μονάδες</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Τύπος βοηθητικών συστημάτων</td>
		<td>".$array_znxv_type[$znxv["type"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Αριθμός συστημάτων</td>
		<td>".$znxv["n"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Ισχύς βοηθητικών συστημάτων (kW)</td>
		<td>".$znxv["w"]."</td>
	</tr>";
	}
	
	$txt .= "</table><br/>";
	
	return $txt;
	
}


//ΚΕΦ 6 ΤΕΥΧΟΣ: Σύστημα ηλιακών συλλεκτών
function teyxos_solar($id){
	
	$database = new medoo(DB_NAME);

	$tb_zone_xrisi = "vivliothiki_conditions";
	$tb_sys_solar="meletes_zone_sys_solar";
	$col="*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$id));
	$sys_solar = $database->select($tb_sys_solar,"*",$where);
	$sys_solar = $sys_solar[0];
	
	$tb_zones="meletes_zones";
	$select_zone=$database->select($tb_zones,"*",array("id"=>$id));
	$zone=$select_zone[0];
	
	$conditions=$database->select($tb_zone_xrisi, $col, array("id"=>$zone["xrisi"]) );
	$conditions=$conditions[0];
	
	$array_solar_type = array(
		0=>"Χωρίς κάλυμα",
		1=>"Απλός επίπεδος",
		2=>"Επιλεκτικός επίπεδος",
		3=>"Κενού",
		4=>"Συγκεντρωτικός"
	);
	$array_true=array(
		0=>"NAI",
		1=>"OXI"
	);
	
	$txt = "";
	
	$txt .= "<table>
	<tr>
	<td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"2\">Ηλιοθερμικά συστήματα</td>
	</tr>";
	$txt .= "
	<tr>
		<td style=\"background-color:#eaeaea;\">Είδος ηλιακού συλλέκτη</td>
		<td>".$array_solar[$solar["type"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Χρήση ηλιακού συλλέκτη για ΖΝΧ</td>
		<td>".$array_true[$solar["active_h"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Χρήση ηλιακού συλλέκτη για Θέρμανση</td>
		<td>".$array_true[$solar["active_z"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Βαθμός ηλιακής αξιοποίησης για ΖΝΧ</td>
		<td>".$solar["syna"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Βαθμός ηλιακής αξιοποίησης για θέρμανση χώρων</td>
		<td>".$solar["synb"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Επιφάνεια ηλιακών συλλεκτών (m<sup>2</sup>)</td>
		<td>".$solar["e"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Κλίση τοποθέτησης ηλιακών συλλεκτών(<sup>ο</sup>)</td>
		<td>".$solar["g"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Προσανατολισμός ηλιακών συλλεκτών (<sup>ο</sup>)</td>
		<td>".$solar["b"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Συντελεστής σκίασης F-s</td>
		<td>".$solar["fs"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Κάλυψη αναγκών ΖΝΧ</td>
		<td>βλ. Πίνακα (f-charts), τουλάχιστον 60%</td>
	</tr>";
	
	
	$txt .= "</table><br/>";
	
	//Γενικά στοιχεία μελέτης
	$where_meleti=array("AND"=>array("user_id"=>$_SESSION['user_id'],"id"=>$_SESSION['meleti_id']));
	$tb_meleti = "user_meletes";
	$select_meleti = $database->select($tb_meleti, $col, $where_meleti);
	$meleti_climate = $select_meleti[0]["climate"];
	
	$place_id = $meleti_climate+1; //selectedIndex+1
	$data_place = $database->select("vivliothiki_climate_places","place",array("id"=>$place_id));
	$place = $data_place[0];
	
	$zone_ev=teyxos_zone_ev();
	$zone_e=$zone_ev[0];
	
	$txt .= teyxos_fcharts($place, $zone["xrisi"], $zone["klines"], $zone_e, $solar["g"], $solar["b"], 45, 1, 160, 1);
	
	return $txt;
	
}

//ΚΕΦ 6 ΤΕΥΧΟΣ: Σύστημα φωτισμού
function teyxos_light($id){
	
	$database = new medoo(DB_NAME);

	$tb_zone_xrisi = "vivliothiki_conditions";
	$tb_sys_light="meletes_zone_sys_light";
	$col="*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$id));
	$light = $database->select($tb_sys_light,"*",$where);
	$light = $light[0];
	
	$tb_zones="meletes_zones";
	$select_zone=$database->select($tb_zones,"*",array("id"=>$id));
	$zone=$select_zone[0];
	
	$conditions=$database->select($tb_zone_xrisi, $col, array("id"=>$zone["xrisi"]) );
	$conditions=$conditions[0];
	
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
	$array_true=array(
		0=>"NAI",
		1=>"OXI"
	);
	
	$txt = "";
	
	$txt .= "<table>
	<tr>
	<td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"2\">Σύστημα φωτισμού</td>
	</tr>";
	$txt .= "
	<tr>
		<td style=\"background-color:#eaeaea;\">Ισχύς φωτιστικών σωμάτων (kW)</td>
		<td>".$light["w"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Ποσοστό (%) φυσικού φωτισμού</td>
		<td>".$light["e_per"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Διακόπτες ελέγχου φωτιστικών</td>
		<td>".$array_light_ff[$light["auto_ff"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Αυτοματισμοί κίνησης φωτισμού</td>
		<td>".$array_light_move[$light["auto_move"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Σύστημα απομάκρυνσης θερμότητας</td>
		<td>".$array_true[$light["active_heat"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Φωτισμός ασφαλείας</td>
		<td>".$array_true[$light["active_safety"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Φωτισμός εφεδρείας</td>
		<td>".$array_true[$light["active_backup"]]."</td>
	</tr>";
	
	
	$txt .= "</table><br/>";
	
	$zone_ev=teyxos_zone_ev();
	$zone_e=$zone_ev[0];
	
	
	return $txt;
	
}


//ΚΕΦ 6 ΤΕΥΧΟΣ: Σύστημα Ύγρανσης
function teyxos_ygr($id){
	
	$database = new medoo(DB_NAME);

	$tb_sys_ygrp="meletes_zone_sys_ygrp";
	$tb_sys_ygrd="meletes_zone_sys_ygrd";
	$tb_sys_ygrt="meletes_zone_sys_ygrt";
	$col="*";
	$where=array("AND"=>array("user_id"=>$_SESSION['user_id'],"meleti_id"=>$_SESSION['meleti_id'],"zone_id"=>$id));
	$sys_ygrp = $database->select($tb_sys_ygrp,"*",$where);
	$sys_ygrd = $database->select($tb_sys_ygrd,"*",$where);
	$sys_ygrt = $database->select($tb_sys_ygrt,"*",$where);
	
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
	$array_ygrp_type = array(
		0=>"Ατμολέβητας κεντρικής παροχής",
		1=>"Τοπική μονάδα ψεκασμού",
		2=>"Τοπική μονάδα παραγωγής ατμού",
		3=>"Τοπική μονάδα άλλου τύπου"
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
		0=>"Εσωτερικοί  ή έως και 20% σε εξωτερικούς",
		1=>"Πάνω από 20% σε εξωτερικούς"
	);
	
	$txt = "";
	
	$txt .= "<table>
	<tr>
	<td style=\"text-align:center; background-color:#CCCCCC;\" colspan=\"2\">Σύστημα Ύγρανσης</td>
	</tr>
	<tr>
	<td style=\"text-align:center; background-color:#eaeaea;\" colspan=\"2\">Μονάδες παραγωγής</td>
	</tr>";
	foreach($sys_ygrp as $ygrp){
	$txt .= "
	<tr>
		<td style=\"background-color:#eaeaea;\">Τύπος</td>
		<td>".$array_ygrp_type[$ygrp["type"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Πηγή ενέργειας</td>
		<td>".$array_pigi[$ygrp["pigi"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Ισχύς (KW)</td>
		<td>".$ygrp["w"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Βαθμός απόδοσης n (-)</td>
		<td>".$ygrp["n"]."</td>
	</tr>";
	}
	
	$ygrd = $sys_ygrd[0];
	$txt .= "
	<tr>
	<td style=\"text-align:center; background-color:#eaeaea;\" colspan=\"2\">Δίκτυο διανομής</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Περιγραφή δικτύου διανομής</td>
		<td>".$ygrd["type"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Χώρος διέλευσης δικτύου διανομής</td>
		<td>".$array_dtype[$ygrd["dieleysi"]]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Βαθμός απόδοσης δικτύου διανομής</td>
		<td>".$ygrd["n"]."</td>
	</tr>";
	
	$ygrt = $sys_ygrt[0];
	$txt .= "
	<tr>
	<td style=\"text-align:center; background-color:#eaeaea;\" colspan=\"2\">Σύστημα διοχέτευσης</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Είδος τερματικών μονάδων θέρμανσης χώρων</td>
		<td>".$ygrt["type"]."</td>
	</tr>
	<tr>
		<td style=\"background-color:#eaeaea;\">Θερμική απόδοση τερματικών μονάδων</td>
		<td>".$ygrt["n"]."</td>
	</tr>";
	
	$txt .= "</table><br/>";
	
	return $txt;
	
}


?>