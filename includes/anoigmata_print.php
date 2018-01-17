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
Tsak mods - Κώστας Τσακίρης - πολιτικός μηχανικός - ktsaki@tee.gr     *
                                                                      *
Εκτύπωση του φύλλου υπολογισμού ανοιγμάτων σε pdf                     *
Καλείται από menu_calc_diafani                                        *
Χρησιμοποιείται η βιβλιοθήκη TCPDF                                    *
                                                                      *
***********************************************************************
*/
define('INCLUDE_CHECK',true);
include ('database.php');
require_once('session.php');

	for ($i = 1; $i <= 10; $i++) {
		${"name".$i}=$_GET["name".$i];
		${"aw".$i}=$_GET["aw".$i];
		${"ah".$i}=$_GET["ah".$i];
		${"ae".$i}=$_GET["ae".$i];
		${"af".$i}=$_GET["af".$i];
		${"yw".$i}=$_GET["yw".$i];
		${"yh".$i}=$_GET["yh".$i];
		${"ye".$i}=$_GET["ye".$i];
		${"pe".$i}=$_GET["pe".$i];
		${"pp".$i}=$_GET["pp".$i];
		${"re".$i}=$_GET["re".$i];
		${"lg".$i}=$_GET["lg".$i];
		${"gw".$i}=$_GET["gw".$i];
		${"uw".$i}=$_GET["uw".$i];
		${"uwrb".$i}=$_GET["uwrb".$i];
		${"uwr".$i}=$_GET["uwr".$i];
	}
	$name=$_GET["name"];
	$type=$_GET["type"];
	$epafi=$_GET["epafi"];
	$descr=$_GET["descr"];
	$mpp=$_GET["mpp"];
	$sp=$_GET["sp"];
	$tp=$_GET["tp"];
	$ug=$_GET["ug"];
	$cg=$_GET["cg"];
	$z1=$_GET["z1"];
	$z2=$_GET["z2"];
	
	$roll_type=$_GET["roll_type"];
	$roll_h=$_GET["roll_h"];
	$roll_urb=$_GET["roll_urb"];
	$eks_type=$_GET["eks_type"];
	$eks_ekp=$_GET["eks_ekp"];
	$eks_rrb=$_GET["eks_rrb"];
	

ob_start();

for($i=0;$i<7;$i++)
{	
echo'
<body style="background:#eaeaea;">
<div id="loading" style="position:absolute; width:100%; text-align:center; top:300px;">
<table style="width:50%;margin-left:auto;margin-right:auto;border:2px solid black;font-size: 13px; line-height: 15px;background: #ebf9c9;"><tr>
<td style="text-align:center;font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 13px; line-height: 15px;">
<br><h2>La-Kenak v'. VERSION .' - Διαφανή δομικά στοιχεία</h2>
Εκτυπώνεται ο πίνακας διαφανών. Παρακαλώ περιμένετε...&nbsp;&nbsp; <img src="../images/interface/ajax-loader2.gif" border=0 /><br/>&nbsp;
</td></tr></table>
</div>

</body>
';
   // unsleep(300000);
}

    @ob_flush();
    @flush();
ob_start();

//require_once('./tcpdf/config/lang/eng.php');
require_once('./tcpdf/tcpdf.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
	//Page header
	public function Header() {
		// Logo
		$image_file = '../images/interface/home-s.png';
		$this->Image($image_file, 10, 5, 8, 8, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('dejavusans', 'B', 10);
		// Title
		$this->Cell(0, 15, 'Έλεγχος Θερμομονωτικής επάρκειας Διαφανών' , 'B', false, 'C', 0, '', 0, false, 'M', 'B');
	}
	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('dejavusans', 'N', 8);
		// Page number
//		$this->Cell(0, 10, 'Σελ. '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 'T', false, 'R', 0, '', 0, false, 'T', 'M');
		$this->Cell(0, 10, '', 'T', false, 'R', 0, '', 0, false, 'T', 'M');
	}
}
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('La-Kenak');
$pdf->SetSubject('');
$pdf->SetKeywords('');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//set some language-dependent strings
$pdf->setLanguageArray($l);
// ---------------------------------------------------------
// set font
$pdf->SetFont('dejavusans', 'N', 8);
// add a page
$pdf->AddPage();
// print a block of text using Write()
$pdf->SetXY(100,15,true);
$pdf->Write($h=0, $txt='Έλεγχος θερμομονωτικής επάρκειας κτιρίου', $link='', $fill=0, $align='R', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
$pdf->Write($h=0, $txt='υπολογισμός συντελεστή θερμοπερατότητας ανοιγμάτων', $link='', $fill=0, $align='R', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
$pdf->Write($h=0, $txt="Όνομα: ".$name, $link='', $fill=0, $align='R', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('dejavusans', 'B', 10);
$pdf->MultiCell(60, 10, 'ΖΩΝΗ:',$border = '',$align = 'R',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->SetFont('dejavusans', 'N', 10);
$pdf->MultiCell(90, 10, $z2."  --> Umax = ".$z1." W/(m²K)",$border = '',$align = 'L',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->Ln();

$pdf->SetFont('dejavusans', 'B', 10);
$pdf->MultiCell(60, 10, 'Τύπος κτιρίου / Επαφή:',$border = '',$align = 'R',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->SetFont('dejavusans', 'N', 10);
$pdf->MultiCell(90, 10, $type." / ".$epafi,$border = '',$align = 'L',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->Ln();

$pdf->SetFont('dejavusans', 'B', 10);
$pdf->MultiCell(60, 10, 'Πλαίσιο:',$border = '',$align = 'R',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->SetFont('dejavusans', 'N', 10);
$pdf->MultiCell(120, 10, $tp." μέσου πλάτους δ=".$mpp."cm, με Uf=".$sp." W/(m²K)",$border = '',$align = 'L',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->Ln();

$pdf->SetFont('dejavusans', 'B', 10);
$pdf->MultiCell(60, 10, 'Υαλοπίνακας:',$border = '',$align = 'R',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'T',$fitcell = false);
$pdf->SetFont('dejavusans', 'N', 10);
$pdf->MultiCell(120, 10, $descr." με Ug=".$ug." W/(m²K)",$border = '',$align = 'L',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'T',$fitcell = false);
$pdf->Ln();

$pdf->SetFont('dejavusans', 'B', 10);
$pdf->MultiCell(60, 15, 'γραμμική θερμοπερατότητα συναρμογής υαλοπινάκων και πλαισίου Ψg:',$border = '',$align = 'R',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 15,$valign = 'B',$fitcell = false);
$pdf->SetFont('dejavusans', 'N', 10);
$pdf->MultiCell(90, 15, $cg." W/(mK)",$border = '',$align = 'L',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 15,$valign = 'B',$fitcell = false);
$pdf->Ln();

$pdf->SetFont('dejavusans', 'B', 10);
$pdf->MultiCell(60, 10, 'Ρολά:',$border = '',$align = 'R',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->SetFont('dejavusans', 'N', 10);
$pdf->MultiCell(90, 10, "Τύπος:".$roll_type." - μέσου ύψους: ".$roll_h."m - Urb=".$roll_urb." W/(m²K)",$border = '',$align = 'L',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->Ln();

$pdf->SetFont('dejavusans', 'B', 10);
$pdf->MultiCell(60, 10, 'Εξώφυλλα:',$border = '',$align = 'R',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->SetFont('dejavusans', 'N', 10);
$pdf->MultiCell(90, 10, "Περσίδες:".$eks_type." - Αεροστεγανότητα: ".$eks_ekp." - Rrb=".$eks_rrb." W/(m²K)",$border = '',$align = 'L',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('dejavusans', 'N', 8);
$pdf->SetFillColor(220,220,220);

$pdf->MultiCell(15, 20, 'α/α',$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 20,$valign = 'M',$fitcell = false);
$pdf->SetFillColor(153,254,250);
$pdf->MultiCell(40, 10, 'Ανοιγμα',$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);

$pdf->SetFillColor(236,245,209);
$pdf->MultiCell(30, 10, 'Υαλοπίνακας',$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);

$pdf->SetFillColor(199,227,117);
$pdf->MultiCell(25, 10, 'Πλαίσιο',$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);

$pdf->SetFillColor(218,136,163);
$pdf->MultiCell(10, 20, "Arb",$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 20,$valign = 'M',$fitcell = false);

$pdf->SetFillColor(245,236,209);
$pdf->MultiCell(10, 20, "Lg",$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 20,$valign = 'M',$fitcell = false);

$pdf->SetFillColor(240,240,240);
$pdf->MultiCell(10, 20, "gw",$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 20,$valign = 'M',$fitcell = false);

$pdf->SetFillColor(240,240,240);
$pdf->MultiCell(15, 20, "Uw \nW/(m²K)",$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 20,$valign = 'M',$fitcell = false);
$pdf->MultiCell(15, 20, "Uwrb \nW/(m²K)",$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 20,$valign = 'M',$fitcell = false);

$pdf->SetFont('dejavusans', 'N', 8);
$pdf->MultiCell(15, 20, "Uwr \nW/(m²K)",$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 20,$valign = 'M',$fitcell = false);

$pdf->Ln();
$pdf->SetXY(30,$pdf->GetY()-10);

$pdf->SetFont('dejavusans', 'N', 5);
$pdf->SetFillColor(153,254,250);
$pdf->MultiCell(10, 10, 'Πλάτος',$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(10, 10, 'Υψος',$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(10, 10, 'Εμβαδό',$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(10, 10, "αριθμός\nφύλλων",$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);

$pdf->SetFillColor(236,245,209);
$pdf->MultiCell(10, 10, 'Πλάτος',$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(10, 10, 'Υψος',$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(10, 10, 'Εμβαδό',$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);

$pdf->SetFillColor(199,227,117);
$pdf->MultiCell(10, 10, 'Εμβαδό',$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(15, 10, 'Ποσοστό',$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);

$pdf->Ln();
$pdf->SetFont('dejavusans', 'N', 8);

for ($i = 1; $i <= 10; $i++) {

if (${"aw".$i}==0){${"aw".$i}="";}else{${"aw".$i}=number_format(${"aw".$i},2,".",",");}
if (${"ah".$i}==0){${"ah".$i}="";}else{${"ah".$i}=number_format(${"ah".$i},2,".",",");}
if (${"af".$i}==0){${"af".$i}="";}else{${"af".$i}=number_format(${"af".$i},0,".",",");}
if (${"ae".$i}==0){${"ae".$i}="";}else{${"ae".$i}=number_format(${"ae".$i},2,".",",");}
if (${"yw".$i}==0){${"yw".$i}="";}else{${"yw".$i}=number_format(${"yw".$i},2,".",",");}
if (${"yh".$i}==0){${"yh".$i}="";}else{${"yh".$i}=number_format(${"yh".$i},2,".",",");}
if (${"ye".$i}==0){${"ye".$i}="";}else{${"ye".$i}=number_format(${"ye".$i},2,".",",");}
if (${"pe".$i}==0){${"pe".$i}="";}else{${"pe".$i}=number_format(${"pe".$i},2,".",",");}
if (${"pp".$i}==0){${"pp".$i}="";}else{${"pp".$i}=number_format(${"pp".$i},2,".",",");}
if (${"re".$i}==0){${"re".$i}="";}else{${"re".$i}=number_format(${"re".$i},2,".",",");}
if (${"lg".$i}==0){${"lg".$i}="";}else{${"lg".$i}=number_format(${"lg".$i},2,".",",");}
if (${"gw".$i}==0){${"gw".$i}="";}else{${"gw".$i}=number_format(${"gw".$i},2,".",",");}
if (${"uw".$i}==0){${"uw".$i}="";}else{${"uw".$i}=number_format(${"uw".$i},2,".",",");}
if (${"uwrb".$i}==0){${"uwrb".$i}="";}else{${"uwrb".$i}=number_format(${"uwrb".$i},2,".",",");}
if (${"uwr".$i}==0){${"uwr".$i}="";}else{${"uwr".$i}=number_format(${"uwr".$i},2,".",",");}


$pdf->SetFillColor(240,240,240);
$pdf->MultiCell(15, 10, ${"name".$i}, $border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->SetFillColor(250,250,250);
$pdf->SetFont('dejavusans', 'N', 5);
$pdf->MultiCell(10, 10, ${"aw".$i},$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(10, 10, ${"ah".$i},$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(10, 10,  ${"ae".$i},$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(10, 10, ${"af".$i},$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);

$pdf->SetFillColor(240,240,240);
$pdf->MultiCell(10, 10, ${"yw".$i},$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(10, 10, ${"yh".$i},$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(10, 10, ${"ye".$i},$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);

$pdf->SetFillColor(250,250,250);
$pdf->MultiCell(10, 10, ${"pe".$i},$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(15, 10, ${"pp".$i},$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);

$pdf->SetFillColor(240,240,240);
$pdf->MultiCell(10, 10, ${"re".$i},$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(10, 10, ${"lg".$i},$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);

$pdf->SetFont('dejavusans', 'B', 8);
$pdf->SetFillColor(250,250,250);
$pdf->MultiCell(10, 10, ${"gw".$i},$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->SetFont('dejavusans', 'N', 7);
$pdf->MultiCell(15, 10, ${"uw".$i},$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(15, 10, ${"uwrb".$i},$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);

if ($z1<${"uwr".$i})$pdf->SetTextColor(220,0,0);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell(15, 10,${"uwr".$i},$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('dejavusans', 'N', 8);
$pdf->Ln();


}


ob_end_clean();
// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output("./../PDF/user".$_SESSION['user_id']."-printout-an.pdf", 'F');

?>

<script type="text/javascript">
window.open("./../PDF/user" + <?php echo $_SESSION['user_id']?> + "-printout-an.pdf","La-kenak");
window.close();
</script>



