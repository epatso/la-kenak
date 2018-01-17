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

	// Εύρεση από τους πίνακες των πλευρικών σκιάσεων
function get_skiaseis_toixoy_pleyrika($prosanatolismos, $sqltable, $gwnia_skiasis){
	
	$database = new medoo(DB_NAME);
	$table = $sqltable;
	$columns = $prosanatolismos;
	$where = array("deg"=>$gwnia_skiasis);
	
	$data_table = $database->select($table,$columns,$where);	
	return $data_table;
		
}

	// Εύρεση από τους πίνακες των πλευρικών σκιάσεων
function get_skiaseis_toixoy_fsh($prosanatolismos, $sqltable, $gwnia_skiasis, $type){
	$database = new medoo(DB_NAME);
	$table = $sqltable;
	$columns = $prosanatolismos;
	$where = array("AND"=>array("type"=>$type,"deg"=>$gwnia_skiasis,));
	
	$data_table = $database->select($table,$columns,$where);	
	return $data_table;
		
}

function get_prosanatolismo_pleyrika($pros){
//Εύρεση των στηλών στη βάση δεδομένων που θα χρησιμοποιηθούν είτε για απ' ευθείας τιμές είτε για παρεμβολή.
		if ($pros == 0){
		$stili1 = "b";
		$prosanatolismos_epif = "Βόρεια";
		$timi_stili1 = 0;
		}
		if ($pros == 45){
		$stili1 = "ba";
		$prosanatolismos_epif = "Βορειοανατολικά";
		$timi_stili1 = 45;
		}
		if ($pros == 90){
		$stili1 = "a";
		$prosanatolismos_epif = "Ανατολικά";
		$timi_stili1 = 90;
		}
		if ($pros == 135){
		$stili1 = "na";
		$prosanatolismos_epif = "Νοτιοανατολικά";
		$timi_stili1 = 135;
		}
		if ($pros == 180){
		$stili1 = "n";
		$prosanatolismos_epif = "Νότια";
		$timi_stili1 = 180;
		}
		if ($pros == 225){
		$stili1 = "nd";
		$prosanatolismos_epif = "Νοτιοδυτικά";
		$timi_stili1 = 225;
		}
		if ($pros == 270){
		$stili1 = "d";
		$prosanatolismos_epif = "Δυτικά";
		$timi_stili1 = 270;
		}
		if ($pros == 315){
		$stili1 = "bd";
		$prosanatolismos_epif = "Βορειοδυτικά";
		$timi_stili1 = 315;
		}
		if ($pros > 0 && $pros < 45){
		$stili1 = "b";
		$stili2 = "ba";
		$prosanatolismos_epif = "Βόρεια - Βορειοανατολικά";
		$timi_stili1 = 0;
		$timi_stili2 = 45;
		}
		if ($pros > 45 && $pros < 90){
		$stili1 = "ba";
		$stili2 = "a";
		$prosanatolismos_epif = "Βορειοανατολικά - Ανατολικά";
		$timi_stili1 = 45;
		$timi_stili2 = 90;
		}
		if ($pros > 90 && $pros < 135){
		$stili1 = "a";
		$stili2 = "na";
		$prosanatolismos_epif = "Ανατολικά - Νοτιοανατολικά";
		$timi_stili1 = 90;
		$timi_stili2 = 135;
		}
		if ($pros > 135 && $pros < 180){
		$stili1 = "na";
		$stili2 = "n";
		$prosanatolismos_epif = "Νοτιοανατολικά - Νότια";
		$timi_stili1 = 135;
		$timi_stili2 = 180;
		}
		if ($pros > 180 && $pros < 225){
		$stili1 = "n";
		$stili2 = "nd";
		$prosanatolismos_epif = "Νότια - Νοτιοδυτικά";
		$timi_stili1 = 180;
		$timi_stili2 = 225;
		}
		if ($pros > 225 && $pros < 270){
		$stili1 = "nd";
		$stili2 = "d";
		$prosanatolismos_epif = "Νοτιοδυτικά - Δυτικά";
		$timi_stili1 = 225;
		$timi_stili2 = 270;
		}
		if ($pros > 270 && $pros < 315){
		$stili1 = "d";
		$stili2 = "bd";
		$prosanatolismos_epif = "Δυτικά - Βορειοδυτικά";
		$timi_stili1 = 270;
		$timi_stili2 = 315;
		}
		if ($pros > 315){
		$stili1 = "bd";
		$stili2 = "b";
		$prosanatolismos_epif = "Βορειοδυτικά - Βόρεια";
		$timi_stili1 = 315;
		$timi_stili2 = 360;
		}
		
		if(!isset($stili2)){$stili2="";}
		if(!isset($timi_stili2)){$timi_stili2="";}
		return array ($stili1,$stili2,$prosanatolismos_epif,$timi_stili1,$timi_stili2);
}
// Εύρεση της σκίασης του τοίχου ή του ανοίγματος
function get_skiasi_pleyrika($degtoixoy){
		if ($degtoixoy == 0) {
		$grammi1 = 0;
		}
		if ($degtoixoy == 10) {
		$grammi1 = 10;
		}
		if ($degtoixoy == 20) {
		$grammi1 = 20;
		}
		if ($degtoixoy == 30) {
		$grammi1 = 30;
		}
		if ($degtoixoy == 40) {
		$grammi1 = 40;
		}
		if ($degtoixoy == 50) {
		$grammi1 = 50;
		}
		if ($degtoixoy == 60) {
		$grammi1 = 60;
		}
		if ($degtoixoy >= 70) {
		$grammi1 = 70;
		}
		if ($degtoixoy > 0 && $degtoixoy < 10) {
		$grammi1 = 0;
		$grammi2 = 10;
		}
		if ($degtoixoy > 10 && $degtoixoy < 20) {
		$grammi1 = 10;
		$grammi2 = 20;
		}
		if ($degtoixoy > 20 && $degtoixoy < 30) {
		$grammi1 = 20;
		$grammi2 = 30;
		}
		if ($degtoixoy > 30 && $degtoixoy < 40) {
		$grammi1 = 30;
		$grammi2 = 40;
		}
		if ($degtoixoy > 40 && $degtoixoy < 50) {
		$grammi1 = 40;
		$grammi2 = 50;
		}
		if ($degtoixoy > 50 && $degtoixoy < 60) {
		$grammi1 = 50;
		$grammi2 = 60;
		}
		if ($degtoixoy > 60 && $degtoixoy < 70) {
		$grammi1 = 60;
		$grammi2 = 70;
		}
		
		if(!isset($grammi2)){$grammi2="";}
		return array ($grammi1,$grammi2);
}

// Εύρεση της σκίασης του τοίχου ή του ανοίγματος από ορίζοντα
function get_skiasi_orizonta($degtoixoy){
		if ($degtoixoy == 0) {
		$grammi1 = 0;
		}
		if ($degtoixoy == 5) {
		$grammi1 = 5;
		}
		if ($degtoixoy == 10) {
		$grammi1 = 10;
		}
		if ($degtoixoy == 15) {
		$grammi1 = 15;
		}
		if ($degtoixoy == 20) {
		$grammi1 = 20;
		}
		if ($degtoixoy == 25) {
		$grammi1 = 25;
		}
		if ($degtoixoy == 30) {
		$grammi1 = 30;
		}
		if ($degtoixoy == 35) {
		$grammi1 = 35;
		}
		if ($degtoixoy == 40) {
		$grammi1 = 40;
		}
		if ($degtoixoy == 45) {
		$grammi1 = 45;
		}
		if ($degtoixoy == 50) {
		$grammi1 = 50;
		}
		if ($degtoixoy == 55) {
		$grammi1 = 55;
		}
		if ($degtoixoy == 60) {
		$grammi1 = 60;
		}
		if ($degtoixoy == 65) {
		$grammi1 = 65;
		}
		if ($degtoixoy >= 70) {
		$grammi1 = 70;
		}
		if ($degtoixoy > 0 && $degtoixoy < 5) {
		$grammi1 = 0;
		$grammi2 = 5;
		}
		if ($degtoixoy > 5 && $degtoixoy < 10) {
		$grammi1 = 5;
		$grammi2 = 10;
		}
		if ($degtoixoy > 10 && $degtoixoy < 15) {
		$grammi1 = 10;
		$grammi2 = 15;
		}
		if ($degtoixoy > 15 && $degtoixoy < 20) {
		$grammi1 = 15;
		$grammi2 = 20;
		}
		if ($degtoixoy > 20 && $degtoixoy < 25) {
		$grammi1 = 20;
		$grammi2 = 25;
		}
		if ($degtoixoy > 25 && $degtoixoy < 30) {
		$grammi1 = 25;
		$grammi2 = 30;
		}
		if ($degtoixoy > 30 && $degtoixoy < 35) {
		$grammi1 = 30;
		$grammi2 = 35;
		}
		if ($degtoixoy > 35 && $degtoixoy < 40) {
		$grammi1 = 35;
		$grammi2 = 40;
		}
		if ($degtoixoy > 40 && $degtoixoy < 45) {
		$grammi1 = 40;
		$grammi2 = 45;
		}
		if ($degtoixoy > 45 && $degtoixoy < 50) {
		$grammi1 = 45;
		$grammi2 = 50;
		}
		if ($degtoixoy > 50 && $degtoixoy < 55) {
		$grammi1 = 50;
		$grammi2 = 55;
		}
		if ($degtoixoy > 55 && $degtoixoy < 60) {
		$grammi1 = 55;
		$grammi2 = 60;
		}
		if ($degtoixoy > 60 && $degtoixoy < 65) {
		$grammi1 = 60;
		$grammi2 = 65;
		}
		if ($degtoixoy > 65 && $degtoixoy < 70) {
		$grammi1 = 65;
		$grammi2 = 70;
		}
		
		if(!isset($grammi2)){$grammi2="";}
		return array ($grammi1,$grammi2);
}


//Υπολογισμός συντελεστών σκίασης ορίζοντα
function calc_skiasi_hor($deg, $pros){
$sqltable = "vivliothiki_f_hor";
//Εύρεση των στηλών στη βάση δεδομένων που θα χρησιμοποιηθούν είτε για απ' ευθείας τιμές είτε για παρεμβολή.ΠΡΟΣΑΝΑΤΟΛΙΣΜΟΣ ΕΠΙΦΑΝΕΙΑΣ
$arrayprosanatolismoy = get_prosanatolismo_pleyrika($pros);
$stili1 = $arrayprosanatolismoy[0];
$stili2 = $arrayprosanatolismoy[1];
$prosanatolismos_epif = $arrayprosanatolismoy[2];
$timi_stili1 = $arrayprosanatolismoy[3];
$timi_stili2 = $arrayprosanatolismoy[4];

//Εύρεση των γραμμών στη βάση δεδομένων που θα χρησιμοποιηθούν είτε για απ' ευθείας τιμές είτε για παρεμβολή
$arrayskiasis = get_skiasi_orizonta($deg);
$grammi1 = $arrayskiasis[0];
$grammi2 = $arrayskiasis[1];


		//υπολογισμός
		if ($stili2=="") {	//δεν έχει οριστεί ενδιάμεσος προσανατολισμός πλευράς
				if ($grammi2=="") { //η σκίαση έχει πέσει σε στάνταρ τιμή
				$timesf = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi1);
				$f_h = $timesf[0];
				$f_c = $timesf[1];
				}
				if ($grammi2!="") { //η σκίαση δεν πέφτει σε στάνταρ τιμή.παλινδρόμιση ανάμεσα στις γραμμές με τη γωνία σκίασης
				$timesf1 = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi1);
				$f_h1 = $timesf1[0];
				$f_c1 = $timesf1[1];
				$timesf2 = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi2);
				$f_h2 = $timesf2[0];
				$f_c2 = $timesf2[1];
				$f_h = paremvoli($grammi1, $grammi2, $f_h1, $f_h2, $deg);
				$f_c = paremvoli($grammi1, $grammi2, $f_c1, $f_c2, $deg);
				}
				
		}
		else{ //έχει οριστεί ενδιάμεσος προσανατολισμός
				if ($grammi2=="") { //η σκίαση έχει πέσει σε στάνταρ τιμή.παλινδρόμιση ανάμεσα στις στηλες (προσανατολισμός) με τον προσανατολισμό
				$timesf1 = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi1);
				$f_h1 = $timesf1[0];
				$f_c1 = $timesf1[1];
				$timesf2 = get_skiaseis_toixoy_pleyrika($stili2, $sqltable, $grammi1);
				$f_h2 = $timesf2[0];
				$f_c2 = $timesf2[1];
				$f_h = paremvoli($timi_stili1, $timi_stili2, $f_h1, $f_h2, $pros);
				$f_c = paremvoli($timi_stili1, $timi_stili2, $f_c1, $f_c2, $pros);
				//echo "Για ".$stili1."-".$grammi1." : ".$f_h1 . "-". $f_c1 . "<br/>Για ".$stili2."-".$grammi1." : ".$f_h2 . "-". $f_c2 . "<br/>";
				}
				if ($grammi2!="") { // η σκιαση έχει πέσει ενδιάμεσα. ο προσανατολισμός έχει πέσει ενδιάμεσα
				$timesf71 = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi1);
				$f_h71 = $timesf71[0];
				$f_c71 = $timesf71[1];
				$timesf81 = get_skiaseis_toixoy_pleyrika($stili2, $sqltable, $grammi1);
				$f_h81 = $timesf81[0];
				$f_c81 = $timesf81[1];
				// παλινδρόμηση ανάμεσα στις τιμές της πρώτης γραμμής για στήλη 1 και 2
				$f_h11 = paremvoli($timi_stili1, $timi_stili2, $f_h71, $f_h81, $pros);
				$f_c11 = paremvoli($timi_stili1, $timi_stili2, $f_c71, $f_c81, $pros);
				
				$timesf72 = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi2);
				$f_h72 = $timesf72[0];
				$f_c72 = $timesf72[1];
				$timesf82 = get_skiaseis_toixoy_pleyrika($stili2, $sqltable, $grammi2);
				$f_h82 = $timesf82[0];
				$f_c82 = $timesf82[1];
				// παλινδρόμηση ανάμεσα στις τιμές της δεύτερης γραμμής για στήλη 1 και 2
				$f_h12 = paremvoli($timi_stili1, $timi_stili2, $f_h72, $f_h82, $pros);
				$f_c12 = paremvoli($timi_stili1, $timi_stili2, $f_c72, $f_c82, $pros);
				// παλινδρόμηση ανάμεσα στις τιμές των δύο γραμμών που βρέθηκαν με την γωνία σκίασης.
				$f_h = paremvoli($grammi1, $grammi2, $f_h11, $f_h12, $deg);
				$f_c = paremvoli($grammi1, $grammi2, $f_c11, $f_c12, $deg);
				}
		}
$array = array(round($f_h,3), round($f_c,3));
return $array;
}


//Υπολογισμός συντελεστών σκίασης προβόλου
function calc_skiasi_ov($deg, $pros){
$sqltable = "vivliothiki_f_ov";
//Εύρεση των στηλών στη βάση δεδομένων που θα χρησιμοποιηθούν είτε για απ' ευθείας τιμές είτε για παρεμβολή.ΠΡΟΣΑΝΑΤΟΛΙΣΜΟΣ ΕΠΙΦΑΝΕΙΑΣ
		$arrayprosanatolismoy = get_prosanatolismo_pleyrika($pros);
		$stili1 = $arrayprosanatolismoy[0];
		$stili2 = $arrayprosanatolismoy[1];
		$prosanatolismos_epif = $arrayprosanatolismoy[2];
		$timi_stili1 = $arrayprosanatolismoy[3];
		$timi_stili2 = $arrayprosanatolismoy[4];
		
		//Εύρεση των γραμμών στη βάση δεδομένων που θα χρησιμοποιηθούν είτε για απ' ευθείας τιμές είτε για παρεμβολή
		$arrayskiasis = get_skiasi_orizonta($deg);
		$grammi1 = $arrayskiasis[0];
		$grammi2 = $arrayskiasis[1];
		
		
		//Παρεμβολή εαν είμαστε ενδιάμεσα σε τιμές προσανατολισμού.
		//Αν όχι πάρε τις στάνταρ τιμές από τον πίνακα
		
		//υπολογισμός τοίχου
		if ($stili2=="") {	//δεν έχει οριστεί ενδιάμεσος προσανατολισμός πλευράς
				if ($grammi2=="") { //η σκίαση έχει πέσει σε στάνταρ τιμή
				$timesf = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi1);
				$f_h = $timesf[0];
				$f_c = $timesf[1];
				}
				if ($grammi2!="") { //η σκίαση δεν πέφτει σε στάνταρ τιμή.παλινδρόμιση ανάμεσα στις γραμμές με τη γωνία σκίασης
				$timesf1 = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi1);
				$f_h1 = $timesf1[0];
				$f_c1 = $timesf1[1];
				$timesf2 = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi2);
				$f_h2 = $timesf2[0];
				$f_c2 = $timesf2[1];
				$f_h = paremvoli($grammi1, $grammi2, $f_h1, $f_h2, $deg);
				$f_c = paremvoli($grammi1, $grammi2, $f_c1, $f_c2, $deg);
				}
				
		}
		else{ //έχει οριστεί ενδιάμεσος προσανατολισμός
				if ($grammi2=="") { //η σκίαση έχει πέσει σε στάνταρ τιμή.παλινδρόμιση ανάμεσα στις στηλες (προσανατολισμός) με τον προσανατολισμό
				$timesf1 = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi1);
				$f_h1 = $timesf1[0];
				$f_c1 = $timesf1[1];
				$timesf2 = get_skiaseis_toixoy_pleyrika($stili2, $sqltable, $grammi1);
				$f_h2 = $timesf2[0];
				$f_c2 = $timesf2[1];
				$f_h = paremvoli($timi_stili1, $timi_stili2, $f_h1, $f_h2, $pros);
				$f_c = paremvoli($timi_stili1, $timi_stili2, $f_c1, $f_c2, $pros);
				}
				if ($grammi2!="") { // η σκιαση έχει πέσει ενδιάμεσα. ο προσανατολισμός έχει πέσει ενδιάμεσα
				$timesf71 = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi1);
				$f_h71 = $timesf71[0];
				$f_c71 = $timesf71[1];
				$timesf81 = get_skiaseis_toixoy_pleyrika($stili2, $sqltable, $grammi1);
				$f_h81 = $timesf81[0];
				$f_c81 = $timesf81[1];
				// παλινδρόμηση ανάμεσα στις τιμές της πρώτης γραμμής για στήλη 1 και 2
				$f_h11 = paremvoli($timi_stili1, $timi_stili2, $f_h71, $f_h81, $pros);
				$f_c11 = paremvoli($timi_stili1, $timi_stili2, $f_c71, $f_c81, $pros);
				
				$timesf72 = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi2);
				$f_h72 = $timesf72[0];
				$f_c72 = $timesf72[1];
				$timesf82 = get_skiaseis_toixoy_pleyrika($stili2, $sqltable, $grammi2);
				$f_h82 = $timesf82[0];
				$f_c82 = $timesf82[1];
				// παλινδρόμηση ανάμεσα στις τιμές της δεύτερης γραμμής για στήλη 1 και 2
				$f_h12 = paremvoli($timi_stili1, $timi_stili2, $f_h72, $f_h82, $pros);
				$f_c12 = paremvoli($timi_stili1, $timi_stili2, $f_c72, $f_c82, $pros);
				// παλινδρόμηση ανάμεσα στις τιμές των δύο γραμμών που βρέθηκαν με την γωνία σκίασης.
				$f_h = paremvoli($grammi1, $grammi2, $f_h11, $f_h12, $deg);
				$f_c = paremvoli($grammi1, $grammi2, $f_c11, $f_c12, $deg);
				}
		}
$array = array(round($f_h,3), round($f_c,3));
return $array;
}


//Υπολογισμός συντελεστών σκίασης πλευρικών
function calc_skiasi_fin($deg, $pros, $thesi){
if ($thesi == 1) { 
		$pinakasthesis = "320a";
		$sqltable = "vivliothiki_f_fin_left";
		}
		else {
		$pinakasthesis = "320b";
		$sqltable = "vivliothiki_f_fin_right";
		}
//Εύρεση των στηλών στη βάση δεδομένων που θα χρησιμοποιηθούν είτε για απ' ευθείας τιμές είτε για παρεμβολή.ΠΡΟΣΑΝΑΤΟΛΙΣΜΟΣ ΕΠΙΦΑΝΕΙΑΣ
		$arrayprosanatolismoy = get_prosanatolismo_pleyrika($pros);
		$stili1 = $arrayprosanatolismoy[0];
		$stili2 = $arrayprosanatolismoy[1];
		$prosanatolismos_epif = $arrayprosanatolismoy[2];
		$timi_stili1 = $arrayprosanatolismoy[3];
		$timi_stili2 = $arrayprosanatolismoy[4];			
		
		//Εύρεση των γραμμών στη βάση δεδομένων που θα χρησιμοποιηθούν είτε για απ' ευθείας τιμές είτε για παρεμβολή
		$arrayskiasis = get_skiasi_pleyrika($deg);
		$grammi1 = $arrayskiasis[0];
		$grammi2 = $arrayskiasis[1];
		
		
		//Παρεμβολή εαν είμαστε ενδιάμεσα σε τιμές προσανατολισμού.
		//Αν όχι πάρε τις στάνταρ τιμές από τον πίνακα
		if ($stili2=="") {	//δεν έχει οριστεί ενδιάμεσος προσανατολισμός πλευράς
				if ($grammi2=="") { //η σκίαση έχει πέσει σε στάνταρ τιμή
				$timesf = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi1);
				$f_h = $timesf[0];
				$f_c = $timesf[1];
				}
				if ($grammi2!="") { //η σκίαση δεν πέφτει σε στάνταρ τιμή.παλινδρόμιση ανάμεσα στις γραμμές με τη γωνία σκίασης
				$timesf1 = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi1);
				$f_h1 = $timesf1[0];
				$f_c1 = $timesf1[1];
				$timesf2 = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi2);
				$f_h2 = $timesf2[0];
				$f_c2 = $timesf2[1];
				$f_h = paremvoli($grammi1, $grammi2, $f_h1, $f_h2, $deg);
				$f_c = paremvoli($grammi1, $grammi2, $f_c1, $f_c2, $deg);
				}
				
		}
		else{ //έχει οριστεί ενδιάμεσος προσανατολισμός
				if ($grammi2=="") { //η σκίαση έχει πέσει σε στάνταρ τιμή.παλινδρόμιση ανάμεσα στις στηλες (προσανατολισμός) με τον προσανατολισμό
				$timesf1 = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi1);
				$f_h1 = $timesf1[0];
				$f_c1 = $timesf1[1];
				$timesf2 = get_skiaseis_toixoy_pleyrika($stili2, $sqltable, $grammi1);
				$f_h2 = $timesf2[0];
				$f_c2 = $timesf2[1];
				$f_h = paremvoli($timi_stili1, $timi_stili2, $f_h1, $f_h2, $pros);
				$f_c = paremvoli($timi_stili1, $timi_stili2, $f_c1, $f_c2, $pros);
				}
				if ($grammi2!="") { // η σκιαση έχει πέσει ενδιάμεσα. ο προσανατολισμός έχει πέσει ενδιάμεσα
				$timesf71 = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi1);
				$f_h71 = $timesf71[0];
				$f_c71 = $timesf71[1];
				$timesf81 = get_skiaseis_toixoy_pleyrika($stili2, $sqltable, $grammi1);
				$f_h81 = $timesf81[0];
				$f_c81 = $timesf81[1];
				// παλινδρόμηση ανάμεσα στις τιμές της πρώτης γραμμής για στήλη 1 και 2
				$f_h11 = paremvoli($timi_stili1, $timi_stili2, $f_h71, $f_h81, $pros);
				$f_c11 = paremvoli($timi_stili1, $timi_stili2, $f_c71, $f_c81, $pros);
				
				$timesf72 = get_skiaseis_toixoy_pleyrika($stili1, $sqltable, $grammi2);
				$f_h72 = $timesf72[0];
				$f_c72 = $timesf72[1];
				$timesf82 = get_skiaseis_toixoy_pleyrika($stili2, $sqltable, $grammi2);
				$f_h82 = $timesf82[0];
				$f_c82 = $timesf82[1];
				// παλινδρόμηση ανάμεσα στις τιμές της δεύτερης γραμμής για στήλη 1 και 2
				$f_h12 = paremvoli($timi_stili1, $timi_stili2, $f_h72, $f_h82, $pros);
				$f_c12 = paremvoli($timi_stili1, $timi_stili2, $f_c72, $f_c82, $pros);
				// παλινδρόμηση ανάμεσα στις τιμές των δύο γραμμών που βρέθηκαν με την γωνία σκίασης.
				$f_h = paremvoli($grammi1, $grammi2, $f_h11, $f_h12, $deg);
				$f_c = paremvoli($grammi1, $grammi2, $f_c11, $f_c12, $deg);
				}
		}
$array = array(round($f_h,3), round($f_c,3));
return $array;
}


//Υπολογισμός συντελεστών σκίασης περσίδων
function calc_skiasi_fsh($deg, $pros, $type){
$sqltable = "vivliothiki_f_per";
if ($type == 1) { 
$type = "Σταθερές";
}
else {
$type = "Κινητές";
}
//Εύρεση των στηλών στη βάση δεδομένων που θα χρησιμοποιηθούν είτε για απ' ευθείας τιμές είτε για παρεμβολή.ΠΡΟΣΑΝΑΤΟΛΙΣΜΟΣ ΕΠΙΦΑΝΕΙΑΣ
		$arrayprosanatolismoy = get_prosanatolismo_pleyrika($pros);
		$stili1 = $arrayprosanatolismoy[0];
		$stili2 = $arrayprosanatolismoy[1];
		$prosanatolismos_epif = $arrayprosanatolismoy[2];
		$timi_stili1 = $arrayprosanatolismoy[3];
		$timi_stili2 = $arrayprosanatolismoy[4];
		
		//Εύρεση των γραμμών στη βάση δεδομένων που θα χρησιμοποιηθούν είτε για απ' ευθείας τιμές είτε για παρεμβολή
		if ($type=="Σταθερές" AND $deg>30 AND $deg<45){
		$grammi1 = 30;
		$grammi2 = 45;
		}
		if ($type=="Σταθερές" AND $deg<=30){
		$grammi1 = 30;
		}
		if ($type=="Σταθερές" AND $deg>=45){
		$grammi1 = 45;
		}
		if ($type=="Κινητές"){
		$grammi1 = 45;
		}
		
		
		//Παρεμβολή εαν είμαστε ενδιάμεσα σε τιμές προσανατολισμού.
		//Αν όχι πάρε τις στάνταρ τιμές από τον πίνακα
		if ($stili2=="") {	//δεν έχει οριστεί ενδιάμεσος προσανατολισμός πλευράς
				if ($grammi2=="") { //η σκίαση έχει πέσει σε στάνταρ τιμή
				$timesf = get_skiaseis_toixoy_fsh($stili1, $sqltable, $grammi1, $type);
				$f_h = $timesf[0];
				$f_c = $timesf[1];
				}
				if ($grammi2!="") { //η σκίαση δεν πέφτει σε στάνταρ τιμή.παλινδρόμιση ανάμεσα στις γραμμές με τη γωνία σκίασης
				$timesf1 = get_skiaseis_toixoy_fsh($stili1, $sqltable, $grammi1, $type);
				$f_h1 = $timesf1[0];
				$f_c1 = $timesf1[1];
				$timesf2 = get_skiaseis_toixoy_fsh($stili1, $sqltable, $grammi2, $type);
				$f_h2 = $timesf2[0];
				$f_c2 = $timesf2[1];
				$f_h = paremvoli($grammi1, $grammi2, $f_h1, $f_h2, $deg);
				$f_c = paremvoli($grammi1, $grammi2, $f_c1, $f_c2, $deg);
				}
				
		}
		else{ //έχει οριστεί ενδιάμεσος προσανατολισμός
				if ($grammi2=="") { //η σκίαση έχει πέσει σε στάνταρ τιμή.παλινδρόμιση ανάμεσα στις στηλες (προσανατολισμός) με τον προσανατολισμό
				$timesf1 = get_skiaseis_toixoy_fsh($stili1, $sqltable, $grammi1, $type);
				$f_h1 = $timesf1[0];
				$f_c1 = $timesf1[1];
				$timesf2 = get_skiaseis_toixoy_fsh($stili2, $sqltable, $grammi1, $type);
				$f_h2 = $timesf2[0];
				$f_c2 = $timesf2[1];
				$f_h = paremvoli($timi_stili1, $timi_stili2, $f_h1, $f_h2, $pros);
				$f_c = paremvoli($timi_stili1, $timi_stili2, $f_c1, $f_c2, $pros);
				}
				if ($grammi2!="") { // η σκιαση έχει πέσει ενδιάμεσα. ο προσανατολισμός έχει πέσει ενδιάμεσα
				$timesf71 = get_skiaseis_toixoy_fsh($stili1, $sqltable, $grammi1, $type);
				$f_h71 = $timesf71[0];
				$f_c71 = $timesf71[1];
				$timesf81 = get_skiaseis_toixoy_fsh($stili2, $sqltable, $grammi1, $type);
				$f_h81 = $timesf81[0];
				$f_c81 = $timesf81[1];
				// παλινδρόμηση ανάμεσα στις τιμές της πρώτης γραμμής για στήλη 1 και 2
				$f_h11 = paremvoli($timi_stili1, $timi_stili2, $f_h71, $f_h81, $pros);
				$f_c11 = paremvoli($timi_stili1, $timi_stili2, $f_c71, $f_c81, $pros);
				
				$timesf72 = get_skiaseis_toixoy_fsh($stili1, $sqltable, $grammi2, $type);
				$f_h72 = $timesf72[0];
				$f_c72 = $timesf72[1];
				$timesf82 = get_skiaseis_toixoy_fsh($stili2, $sqltable, $grammi2, $type);
				$f_h82 = $timesf82[0];
				$f_c82 = $timesf82[1];
				// παλινδρόμηση ανάμεσα στις τιμές της δεύτερης γραμμής για στήλη 1 και 2
				$f_h12 = paremvoli($timi_stili1, $timi_stili2, $f_h72, $f_h82, $pros);
				$f_c12 = paremvoli($timi_stili1, $timi_stili2, $f_c72, $f_c82, $pros);
				// παλινδρόμηση ανάμεσα στις τιμές των δύο γραμμών που βρέθηκαν με την γωνία σκίασης.
				$f_h = paremvoli($grammi1, $grammi2, $f_h11, $f_h12, $deg);
				$f_c = paremvoli($grammi1, $grammi2, $f_c11, $f_c12, $deg);
				}
		}
$array = array(round($f_h,3), round($f_c,3));
return $array;
}


?>