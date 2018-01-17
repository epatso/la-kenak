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
Εκτύπωση του φύλλου υπολογισμού δομικού στοιχείου σε pdf              *
Καλείται από image_creation_wall και image_creation_floor             *
Χρησιμοποιείται η βιβλιοθήκη TCPDF                                    *
                                                                      *
***********************************************************************
*/

define('INCLUDE_CHECK',true);
//require_once('./tcpdf/config/lang/eng.php');
require_once('./tcpdf/tcpdf.php');
require_once('session.php');

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
		$this->Cell(0, 15, 'Μελέτη ενεργειακής απόδοσης', 'B', false, 'C', 0, '', 0, false, 'M', 'B');
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
$pdf->Write($h=0, $txt='Έλεγχος θερμομονωτικής επάρκειας κτιρίου', $link='', $fill=0, $align='L', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
$pdf->SetXY(100,15,true);
$pdf->Write($h=0, $txt='υπολογισμός συντελεστή θερμοπερατότητας δομικού στοιχείου', $link='', $fill=0, $align='R', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
$pdf->SetFont('dejavusans', 'B', 10);
$pdf->Ln();
$pdf->Write($h=0, $txt='ΔΟΜΙΚΟ ΣΤΟΙΧΕΙΟ: '.$descr, $link='', $fill=0, $align='L', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
$pdf->SetFont('dejavusans', 'N', 10);
$pdf->SetXY(100,30,true);
$pdf->Cell(0, 0, 'ΥΠΟΛΟΓΙΣΜΟΣ ΑΝΤΙΣΤΑΣΗΣ ΘΕΡΜΟΔΙΑΦΥΓΗΣ (RΛ)', 0, 0, 'L', 0, '', 0, false, 'T', 'B');
$pdf->SetFont('dejavusans', 'N', 8);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFillColor(220,220,220);
$pdf->MultiCell(10, 10, 'α/α',$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(80, 10, 'Στρώσεις δομικού στοιχείου',$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 10, 'Πάχος στρώσης (m)',$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 10, 'Συντ. θερμ. αγωγιμ. λ (W/mK)',$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 10, 'Θερμ. αντίστ. d/λ (m²K/W)',$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 10,$valign = 'M',$fitcell = false);
$pdf->Ln();
$sp=0;
$sdl=0;
for ($i = 1; $i <= 10; $i++) {
	if (${"paxos".$i}>0){
		$l=number_format(${"strwsi".$i},3,".",",");
		$p=number_format(${"paxos".$i},3,".",",");
		$sp+=$p;
//		$t1=explode("|",${"strwsi".$i});
		$t1=${"strwsin".$i};
		$dl=number_format($p/$l,3,".",",");
		$sdl+=$dl;
$pdf->MultiCell(10, 7, $i,$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(80, 7, $t1,$border = 'LTRB',$align = 'L',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, $p,$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, $l,$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, $dl,$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
		$pdf->Ln();
	}
}
$sdl=number_format($sdl,3,".",",");
$sp=number_format($sp,3,".",",");
$pdf->MultiCell(10, 7, "",$border = '',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(80, 7, "Σd=",$border = '',$align = 'R',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, $sp,$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, "RΛ=",$border = '',$align = 'R',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, $sdl,$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);

$pdf->Ln();
//$pdf->Ln();
$pdf->SetFont('dejavusans', 'N', 10);
$pdf->Cell(0, 0, 'ΥΠΟΛΟΓΙΣΜΟΣ ΣΥΝΤΕΛΕΣΤΗ ΘΕΡΜΟΠΕΡΑΤΟΤΗΤΑΣ (U)', 0, 0, 'L', 0, '', 0, false, 'T', 'B');
$pdf->SetFont('dejavusans', 'N', 8);
$pdf->Ln();
$pdf->Ln();

$sol=$sdl+$ri+$ra+$rd+$ru;

$pdf->MultiCell(10, 7, "1",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(80, 7, "Αντίσταση θερμικής μετάβασης (εσωτερικά)",$border = 'LTRB',$align = 'L',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, "Ri",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, "(m²K)/W",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, $ri,$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->Ln();
$pdf->MultiCell(10, 7, "2",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(80, 7, "Αντίσταση θερμοδιαφυγής",$border = 'LTRB',$align = 'L',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, "R",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, "(m²K)/W",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, $sdl,$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->Ln();
$pdf->MultiCell(10, 7, "3",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(80, 7, "Αντίσταση θερμικής μετάβασης (εξωτερικά)",$border = 'LTRB',$align = 'L',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, "Ra",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, "(m²K)/W",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, $ra,$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->Ln();
$aa=3;
if ($rd>0){
$aa+=1;
$pdf->MultiCell(10, 7, $aa,$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(80, 7, "Θερμική αντίσταση στρώματος αέρα",$border = 'LTRB',$align = 'L',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, "Rδ",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, "(m²K)/W",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, $rd,$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->Ln();
}
if ($ru>0){
$aa+=1;
$pdf->MultiCell(10, 7, $aa,$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(80, 7, "Θερμική αντίσταση κεραμοσκεπής",$border = 'LTRB',$align = 'L',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, "Ru",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, "(m²K)/W",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, $ru,$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->Ln();
}
$pdf->MultiCell(10, 7, "",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(80, 7, "Αντίσταση θερμοπερατότητας",$border = 'LTRB',$align = 'L',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, "Rολ",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, "(m²K)/W",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, number_format($sol,3,".",","),$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);

$pdf->Ln();
$pdf->Ln();

$pdf->MultiCell(90, 7, "Συντελεστής θερμοπερατότητας",$border = 'LTRB',$align = 'L',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, "U",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, "W/(m²K)",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell(30, 7, number_format(1/$sol,3,".",","),$border = 'LTRB',$align = 'C',$fill = true,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->SetFont('dejavusans', 'N', 8);
$pdf->Ln();
if ($zwni==0)$zwni="Α";
if ($zwni==1)$zwni="Β";
if ($zwni==2)$zwni="Γ";
if ($zwni==3)$zwni="Δ";
$pdf->MultiCell(90, 7, "Μέγιστος επιτρ. συντ. θερμοπερατότητας (Ζώνη ".$zwni.")",$border = 'LTRB',$align = 'L',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, "Umax",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, "W/(m²K)",$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$pdf->MultiCell(30, 7, number_format($umax,3,".",","),$border = 'LTRB',$align = 'C',$fill = false,$ln = 0,$x = '',$y = '',$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 7,$valign = 'M',$fitcell = false);
$y=$pdf->GetY();
//$pdf->SetXY(15,$y+$imh,true);
$pdf->Image("./temp.png", 15, $y+10, 140, 0, 'PNG', '', 'T', true, 600, '', false, false, 0, true, false, false);

ob_end_clean();
// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output("./../PDF/user".$_SESSION['user_id']."-printout.pdf", 'F');
?>

<script type="text/javascript">
window.open("./../PDF/user" + <?php echo $_SESSION['user_id']?> + "-printout.pdf","La-kenak");
window.close();
</script>

