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
//ini_set('display_errors',1); 
//error_reporting(E_ALL);
define('INCLUDE_CHECK',true);
require_once('tcpdf/config/tcpdf_config.php');
require_once('tcpdf/tcpdf.php');
require("session.php");
require("medoo.php");

confirm_logged_in();
confirm_meleti_isset();

$printteyxos = new medoo(DB_NAME);

	$admin_prefs = $printteyxos->select("core_preferences","*",array("id" => "1"));
	$admin_menu_teyxos = $admin_prefs[0]["menu_teyxos"];
	$admin_teyxos_tcpdf = $admin_prefs[0]["teyxos_tcpdf"];
	
	if($admin_teyxos_tcpdf!=0){//Έχει οριστεί να χρησιμοποιείται η TCPDF

$teyxos = "";
//$teyxos .= "<style>".file_get_contents(APPLICATION_FOLDER."javascripts/bootstrap3/css/bootstrap.css")."</style>";

//επιλογή στοιχείων μελέτης
$tb_teyxos = "meletes_teyxos";
$col_teyxos = "*";
$where_teyxos = array("AND" => array("user_id" => $_SESSION['user_id'],"meleti_id" => $_SESSION['meleti_id']));
$kefalaia = $printteyxos->select($tb_teyxos,$col_teyxos,$where_teyxos);
$kefalaio = $kefalaia[0];

$date_creation = date("d-m-Y H:i:s");

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
	//Page header
	public function Header() {
		// Logo
		//$image_file = '../images/home-s.png';
		//$this->Image($image_file, 10, 5, 8, 8, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('dejavusans', 'B', 10);
		// Title
		$this->Cell(0, 15, 'Μελέτη ενεργειακής απόδοσης κτιρίου', 'B', false, 'C', 0, '', 0, false, 'M', 'B');
	}
	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('dejavusans', 'N', 8);
		$this->Cell(0, 10,$date_creation, 'T', false, 'L', 0, '', 0, false, 'T', 'M');
		// Page number
		$this->Cell(0, 10, 'Κεφάλαιο - Σελ. '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 'T', false, 'R', 0, '', 0, false, 'T', 'M');
		//$this->Cell(0, 10, date("Y-m-d H:i:s"), 'T', false, 'R', 0, '', 0, false, 'T', 'M');
	}
}

//ΚΕΦΑΛΑΙΑ ΤΕΥΧΟΥΣ
for($i=1;$i<=8;$i++){
$teyxos = $kefalaio["kef".$i];
$teyxos .= "<p style=\"page-break-before:always;\">&nbsp;</p>";
//}


//set_time_limit (180);
//ob_end_flush();
//ob_flush();
//flush();
ob_start();

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('La-kenak');
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
//$pdf->setLanguageArray($l);
$pdf->setFontSubsetting(false);
// ---------------------------------------------------------
// set font
$pdf->SetFont('dejavusans', 'N', 8);
// add a page
$pdf->AddPage();
$pdf->SetY(15);
$pdf->writeHTML($teyxos, $ln = true, $fill = false, $reseth = true, $cell = false, $align = '' ) ;
// define barcode style
$style = array(
	'position' => '',
	'align' => 'C',
	'stretch' => false,
	'fitwidth' => true,
	'cellfitalign' => '',
	'border' => true,
	'hpadding' => 'auto',
	'vpadding' => 'auto',
	'fgcolor' => array(0,0,0),
	'bgcolor' => false, //array(255,255,255),
	'text' => true,
	'font' => 'helvetica',
	'fontsize' => 8,
	'stretchtext' => 4
);
// CODE 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9.
//$pdf->Cell(0, 0, "La Kenak - Χρήστης: ".$_SESSION['user_id']." - Μελέτη: ".$_SESSION['meleti_id'], 0, 1);
//$pdf->write1DBarcode("lakenak".$_SESSION['user_id'].$_SESSION['meleti_id'], 'C39', '', '', '', 18, 0.4, $style, 'N');

// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output("file_upload/server/php/files/user_".$_SESSION['user_id']."/meleti_".$_SESSION['meleti_id']."/teyxos_kef".$i.".pdf", 'F');
echo "Επιτυχής δημιουργία αρχείου : teyxos_kef".$i.".pdf<br/>";
//sleep(1);
}



ob_end_flush();
ob_flush();
flush();
ob_end_clean();




include('PDFMerger/PDFMerger.php');
$pdfunit = new PDFMerger;

$pdfunit->addPDF("file_upload/server/php/files/user_".$_SESSION['user_id']."/meleti_".$_SESSION['meleti_id']."/teyxos_kef1.pdf", "all")
	->addPDF("file_upload/server/php/files/user_".$_SESSION['user_id']."/meleti_".$_SESSION['meleti_id']."/teyxos_kef2.pdf", "all")
	->addPDF("file_upload/server/php/files/user_".$_SESSION['user_id']."/meleti_".$_SESSION['meleti_id']."/teyxos_kef3.pdf", "all")
	->addPDF("file_upload/server/php/files/user_".$_SESSION['user_id']."/meleti_".$_SESSION['meleti_id']."/teyxos_kef4.pdf", "all")
	->addPDF("file_upload/server/php/files/user_".$_SESSION['user_id']."/meleti_".$_SESSION['meleti_id']."/teyxos_kef5.pdf", "all")
	->addPDF("file_upload/server/php/files/user_".$_SESSION['user_id']."/meleti_".$_SESSION['meleti_id']."/teyxos_kef6.pdf", "all")
	->addPDF("file_upload/server/php/files/user_".$_SESSION['user_id']."/meleti_".$_SESSION['meleti_id']."/teyxos_kef7.pdf", "all")
	->addPDF("file_upload/server/php/files/user_".$_SESSION['user_id']."/meleti_".$_SESSION['meleti_id']."/teyxos_kef8.pdf", "all")
	->merge("file", "file_upload/server/php/files/user_".$_SESSION['user_id']."/meleti_".$_SESSION['meleti_id']."/teyxos.pdf");
?>

<script type="text/javascript">
window.open("file_upload/server/php/files/user_" + <?php echo $_SESSION['user_id']?> + "/meleti_" + <?php echo $_SESSION['meleti_id']?> + "/teyxos.pdf");
window.close();
</script>

<?php
	}//Έχει οριστεί να χρησιμοποιείται η TCPDF
?>