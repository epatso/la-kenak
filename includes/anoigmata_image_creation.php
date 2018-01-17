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
/*
***********************************************************************
tsak mods - Κώστας Τσακίρης - πολιτικός μηχανικός - ktsaki@tee.gr     *
                                                                      *
Ρουτίνα που σχεδιάζει το σκαρίφημα των δομικών στοιχείων              *
Καλείται από το menu_calc_diafani και τυπώνει το άνοιγμα              *
                                                                      *
***********************************************************************
*/
//Στο φάκελο includes πρέπει να περιέχεται η γραμματοσειρά. 
//ini_set('display_errors',1); 
//error_reporting(E_ALL);
//πάρε τις τιμές
define('INCLUDE_CHECK',true);
require("medoo.php");
require("session.php");

	$name=$_GET["name"];
	$aw=$_GET["aw"];
	$ah=$_GET["ah"];
	$af=$_GET["af"];
	$mpp=$_GET["mpp"];
	$p=$_GET["p"];
	
	$mpp=0.01*$mpp;
	$fw = $aw/$af;
	$fh = $ah;
	

$hatch_yalopinaka='../images/hatch/glass.png';
if($p<=6){
	$hatch_plaisioy='../images/hatch/granitis.png';
}else{
	$hatch_plaisioy='../images/hatch/wood1.png';
}	

// Θέσε το πλάτος και μήκος της εικόνας σε pixels
$width = $aw*100;
$height = $ah*100; 
// Θέσε την εικόνα
$im = ImageCreateTrueColor($width, $height); 
// switch on image antialising if it is available
if (function_exists('imageantialias')) ImageAntiAlias($im, true);

// Θέσε το background σε άσπρο
$white = ImageColorAllocate($im, 255, 255, 255); 
// Όρισε χρώματα για να το βάλεις στις γραμμές
$black = ImageColorAllocate($im, 0, 0, 0);
$blue = ImageColorAllocate($im, 0, 0, 255);
$grey = imagecolorallocate($im, 62, 62, 62);
$magenda = imagecolorallocate($im, 174, 49, 194);
$roz = imagecolorallocate($im, 103, 16, 81);
$font = './verdana.ttf';
	
	
	imagefill($im, 0, 0, $black);


	$image_plaisioy = imageCreateFromPNG ($hatch_plaisioy);
	imageSetTile ($im, $image_plaisioy);
	
	$values = array(
		0, 0,  // Point 1 (x, y)
		100*$aw,  0, // Point 2 (x, y)
		100*$aw,  100*$ah,  // Point 3 (x, y)
		0, 100*$ah,  // Point 4 (x, y)
	);
	imagefilledpolygon($im, $values, 4, IMG_COLOR_TILED);
	imagedestroy ($image_plaisioy);
	
	$image_yalopinaka = imageCreateFromPNG ($hatch_yalopinaka);
	imageSetTile ($im, $image_yalopinaka);
	
	
	for($i=1; $i<=$af; $i++){
		$values = array(
			($i-1)*100*$fw+100*$mpp, 100*$mpp,  // Point 1 (x, y)
			$i*100*$fw-100*$mpp,  100*$mpp, // Point 2 (x, y)
			$i*100*$fw-100*$mpp,  100*$ah-100*$mpp,  // Point 3 (x, y)
			($i-1)*100*$fw+100*$mpp, 100*$ah-100*$mpp,  // Point 4 (x, y)
		);
		imagefilledpolygon($im, $values, 4, IMG_COLOR_TILED);
	}	
	
	imagedestroy ($image_yalopinaka);

// θέσε HTTP header type σε PNG
header("Content-type: image/png");
// στείλε την PNG εικόνα στο browser
ob_clean();
ImagePNG($im);

// κατέστρεψε τον pointer για την εικόνα στη μνήμη για να απελευθερώσεις πόρους
ImageDestroy($im);			
?>