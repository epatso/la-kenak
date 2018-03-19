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
//Στο φάκελο includes πρέπει να περιέχεται η γραμματοσειρά. 
//πάρε τις τιμές
//ini_set('display_errors',1); 
define('INCLUDE_CHECK',true);
//include ('database.php');
//require_once("connection.php");
require("medoo.php");
require("session.php");
	for ($i = 1; $i <= 10; $i++) {
		${"paxos".$i}=$_GET["pax".$i];
		${"strwsi".$i}=$_GET["str".$i];
		${"strwsin".$i}=$_GET["strn".$i];
		${"eidos".$i}=$_GET["eid".$i];
	}
	$zwni=$_GET["zwni"];
	$descr=$_GET["descr"];
	$ria=$_GET["ria"];	
	$pout=$_GET["print"];	
	$imh=$_GET["imh"];
	$ri=$_GET["ri"];
	$ra=$_GET["ra"];
	$ru=$_GET["ru"];
	$rd=$_GET["rd"];
	$umax=$_GET["umax"];
if ($pout==1){

?>
<body style="background:#eaeaea;">
<div id="loading" style="position:absolute; width:100%; text-align:center; top:300px;">

<table style="width:50%;margin-left:auto;margin-right:auto;border:2px solid black;font-size: 13px; line-height: 15px;background: #ebf9c9;"><tr>
<td style="text-align:center;font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 13px; line-height: 15px;">
<br><h2>La-Kenak v<?php echo APPLICATION_VERSION; ?> - Αδιαφανή δομικά στοιχεία</h2>
Εκτυπώνεται ο πίνακας δομικού στοιχείου. Παρακαλώ περιμένετε... &nbsp;&nbsp;<img src="../images/interface/loading.gif" border="0" /><br/>&nbsp;
</td></tr></table>
</div>

</body>
<?php
ob_end_flush();
ob_flush();
flush();	

}
include ('hatch.php');
$values = array();
// Θέσε το πλάτος και μήκος της εικόνας σε pixels
$width = 960;
if ($pout==1){$width = 960;}
$height = 300; 
// Θέσε την εικόνα
$im = ImageCreateTrueColor($width, $height); 
// switch on image antialising if it is available
if (function_exists('imageantialias')) ImageAntiAlias($im, true);
//imagealphablending($im, false);
//imagesavealpha($im, true);
// Θέσε το background σε άσπρο
$white = ImageColorAllocate($im, 255, 255, 255); 
// Όρισε χρώματα για να το βάλεις στις γραμμές
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
for ($i = 1; $i <= 10; $i++) {
	$tl += ${"paxos".$i}*500;
}
for ($i = 1; $i <= 10; $i++) {
	if (${"paxos".$i}>0){
		$l += ${"paxos".$i}*500;
		
		/*
		$strSQL = "SELECT * FROM vivliothiki_domika WHERE material='".${"strwsin".$i}."'";
		$objQuery = mysql_query($strSQL);
		while($objResult = mysql_fetch_array($objQuery)){$hatch=$ha[$objResult["category"]];}
		*/
		$database = new medoo(DB_NAME);
		$table = "vivliothiki_domika";
		$columns = "*";
		$where=array("material"=>${"strwsin".$i});
		$data = $database->select($table,$columns,$where);
		$hatch = $ha[$data[0]["category"]];
		
		$imagebg = imageCreateFromPNG ($hatch);
		imageSetTile ($im, $imagebg);
		$values[0]=$l-${"paxos".$i}*500;
		$values[1]=250;
		$values[2]=$l;
		$values[3]=250;
		$values[4]=$l;
		$values[5]=50;
		$values[6]=$l-${"paxos".$i}*500;
		$values[7]=50;
		imagefilledpolygon($im, $values, 4, IMG_COLOR_TILED);
		imagepolygon($im, $values, 4, $black);
		imagedestroy ($imagebg);
	}
}
$l=50;
imagecopyresized($im, $linev, $l, 50, 0, 0, 1, 200,1,200);
for ($i = 1; $i <= 10; $i++) {
	if (${"paxos".$i}>0){
		$l += ${"paxos".$i}*500;
		$tl += ${"paxos".$i}*250;
		$c += 30;
		$src = @imagecreatefrompng('../images/domika/pointerH.png');
		imagecopyresized($im, $src, $l-${"paxos".$i}*250, $c, 0, 0, 300, 5,300,5);
		imagecopyresized($im, $linev, $l, 50, 0, 0, 1, 200,1,200);
		ImageDestroy($src);
		$text=$i.". ".${"strwsin".$i}.", d=".number_format(${"paxos".$i}*100,1,".",",")."cm". ", λ=".number_format(${"strwsi".$i},3,".",",");
		imagefttext($im, 10, 0, $tl, $c, $black, $font, $text);
	}
}
imagefttext($im, 12, 90, 30, 250, $black, $font, "ΜΕΣΑ");
if ($ria==1) $x="ΕΞΩ";
if ($ria==2) $x="ΜΘΧ";
if ($ria==3) $x="ΕΔΑΦΟΣ";
imagefttext($im, 12, 90, $l+30, 250, $black, $font, $x);


if ($pout==1){
	$s=imagepng($im,"./temp.png");
	ImageDestroy($im);
	ImageDestroy($linev);
	ob_clean();
	include "adiafani_print.php";
	exit;
}else{
// θέσε HTTP header type σε PNG
//header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
//header('Expires: January 01, 2013'); // Date in the past
//header('Pragma: no-cache');
header("Content-Type: image/png");
// dump the picture and stop the script
ob_clean();
//στείλε την PNG εικόνα στο browser
ImagePng($im);
// κατέστρεψε τον pointer για την εικόνα στη μνήμη για να απελευθερώσεις πόρους
ImageDestroy($im);
ImageDestroy($linev);
}
?>