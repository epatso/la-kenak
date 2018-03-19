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
define('INCLUDE_CHECK',true);
//include ('database.php');
require_once("connection.php");
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
	$roof=$_GET["roof"];	
	$pout=$_GET["print"];	
	$imh=$_GET["imh"];
	$ri=$_GET["ri"];
	$ra=$_GET["ra"];
	$ru=$_GET["ru"];
	$rd=$_GET["rd"];
	$umax=$_GET["umax"];
	$floor=$_GET["floor"];
	
if ($pout==1){

?>
<body style="background:#eaeaea;">
<div id="loading" style="position:absolute; width:100%; text-align:center; top:300px;">

<table style="width:50%;margin-left:auto;margin-right:auto;border:2px solid black;font-size: 13px; line-height: 15px;background: #ebf9c9;"><tr>
<td style="text-align:center;font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 13px; line-height: 15px;">
<br><h2>La-Kenak v<?php echo VERSION; ?> - Αδιαφανή δομικά στοιχεία</h2>
Εκτυπώνεται ο πίνακας δομικού στοιχείου. Παρακαλώ περιμένετε... &nbsp;&nbsp;<img src="../images/interface/ajax-loader.GIF" border=0 /><br/>&nbsp;
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
	
// θέσε HTTP header type σε PNG
header("Content-type: image/png");
// Θέσε το πλάτος και μήκος της εικόνας σε pixels
$width = 960;
if ($pout==1){$width = 960;}
$height = 300;
$sp=0;
for ($i = 1; $i <= 10; $i++) {
	$sp += ${"paxos".$i};
}	
$sp = $sp * 500 +200;
if ($sp>300) $height=$sp;

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
ImageFillToBorder($im, 0, 0,  $black, $black);
imagefilledrectangle ($im,1,1,$width-2,$height-2,$white);

$l=$height-20;
$tl=60;
$linev = @imagecreatefromjpeg('../images/domika/lineH.jpg');
for ($i = 1; $i <= 10; $i++) {
	$tl += ${"paxos".$i}*500;
}

for ($i = 10; $i >= 1; $i--) {
	if (${"paxos".$i}>0){
		$l -= ${"paxos".$i}*500;
		
		/*
		$strSQL = "SELECT * FROM vivliothiki_domika WHERE material='".${"strwsin".$i}."'";
		$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
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
		$values[0]=30;
		$values[1]=$l;
		$values[2]=230;
		$values[3]=$l;
		$values[4]=230;
		$values[5]=$l+${"paxos".$i}*500;
		$values[6]=30;
		$values[7]=$l+${"paxos".$i}*500;
		imagefilledpolygon($im, $values, 4, IMG_COLOR_TILED);
		imagepolygon($im, $values, 4, $black);
		imagedestroy ($imagebg);
	}
}

$l=$height-20;
$c=250;
imagecopyresized($im, $linev, 30,$l, 0, 0, 200,1,200,1);
for ($i = 10; $i >= 1; $i--) {
	if (${"paxos".$i}>0){
		$l -= ${"paxos".$i}*500;
		$tl -= ${"paxos".$i}*250;
		$c -= 30;
		$src = @imagecreatefrompng('../images/domika/pointerV.png');
		imagecopyresized($im, $src, $c, $l+${"paxos".$i}*250-147, 0, 0, 200, 150,200,150);
		imagecopyresized($im, $linev, 30, $l, 0, 0,  200,1,200,1);
		ImageDestroy($src);
		$text=$i.". ".${"strwsin".$i}.", d=".number_format(${"paxos".$i}*100,1,".",",")."cm". ", λ=".number_format(${"strwsi".$i},3,".",",");
		imagefttext($im, 10, 0, $c+100, $l+${"paxos".$i}*250-150, $black, $font, $text);
	}
}

$l1=$l-10;
$l2=$l1;
if ($ria==4 || $ria==5)$l1=$height-5;
if ($ria>5)$l2=$height-5;
imagefttext($im, 12, 0, 30, $l1, $black, $font, "ΜΕΣΑ");
if ($ria==4) $x="ΕΞΩ";
if ($ria==4 && $roof>0) $x="ΚΕΡΑΜΟΣΚΕΠΗ";
if ($ria==5 || $ria==7) $x="ΜΘΧ";
if ($ria==8) $x="ΕΔΑΦΟΣ";
if ($ria==6) $x="ΠΥΛΩΤΗ";
imagefttext($im, 12, 0, 30, $l2, $black, $font, $x);

if ($pout==1){

$s=imagepng($im,"./temp.png");
ImageDestroy($im);
ImageDestroy($linev);
ob_clean();
include "adiafani_print.php";
exit;
}else{
// θέσε HTTP header type σε PNG
header("Content-type: image/png");
// στείλε την PNG εικόνα στο browser
ob_clean();
ImagePNG($im);
}

// κατέστρεψε τον pointer για την εικόνα στη μνήμη για να απελευθερώσεις πόρους
ImageDestroy($im);
ImageDestroy($linev);
			
?>