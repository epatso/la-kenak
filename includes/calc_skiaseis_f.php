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
 
define('INCLUDE_CHECK',true);
require("medoo.php");
require("session.php");
require("functions_skiaseis.php");
require("functions_math.php");
require_once('./tcpdf/tcpdf.php');

if(isset($_GET['skiasi'])){$skiasi=$_GET["skiasi"];}
if(isset($_GET['print'])){$print=$_GET["print"];}

$result = "";
//#############################################################################
	if ($skiasi==1){//σκίαση ορίζοντα
	$prothema = "hor";
	$pdftitle = "Σκιάσεις Ορίζοντα";
		for ($i=1;$i<=10;$i++){
		${"deg_toixoy".$i}=$_GET["deg_toixoy".$i];
		${"deg_door".$i}=$_GET["deg_door".$i];
		${"deg_an".$i}=$_GET["deg_an".$i];
		${"pros".$i}=$_GET["pros".$i];
		${"name".$i}=$_GET["name".$i];
		${"hor_a".$i}=$_GET["hor_a".$i];
		${"hor_b".$i}=$_GET["hor_b".$i];
		${"hor_c".$i}=$_GET["hor_c".$i];
		${"hor_d".$i}=$_GET["hor_d".$i];
		${"hor_g".$i}=$_GET["hor_g".$i];
		${"hor_e".$i}=$_GET["hor_e".$i];
		${"hor_f".$i}=$_GET["hor_f".$i];
		
		${"array_toixoy".$i} = calc_skiasi_hor(${"deg_toixoy".$i}, ${"pros".$i});
		${"f_h_t".$i} = ${"array_toixoy".$i}[0];
		${"f_c_t".$i} = ${"array_toixoy".$i}[1];
		
		${"array_door".$i} = calc_skiasi_hor(${"deg_door".$i}, ${"pros".$i});
		${"f_h_door".$i} = ${"array_door".$i}[0];
		${"f_c_door".$i} = ${"array_door".$i}[1];
		
		${"array_an".$i} = calc_skiasi_hor(${"deg_an".$i}, ${"pros".$i});
		${"f_h_an".$i} = ${"array_an".$i}[0];
		${"f_c_an".$i} = ${"array_an".$i}[1];
		}
	
	
	$result .= "";
	if ($print==1){
	$result .= "<br/><img src=\"../images/shading/orizontas.png\"></img><br/>";
	}
	
	
	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">A/A</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Όνομα στοιχείου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ύψος τοίχου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ύψος πόρτας</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ύψος αν.</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ύψος ποδιάς</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Απόσταση υαλ.</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Απόσταση εμποδίου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ύψος εμποδίου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Προσ.</td>
	</tr>";
	for ($i=1;$i<=10;$i++){
	$result .= "<tr>
	<td>".$i."</td>";
	if (${"name".$i} != "NaN"){$result .= "<td>".${"name".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"hor_a".$i} != "NaN"){$result .= "<td>".${"hor_a".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"hor_b".$i} != "NaN"){$result .= "<td>".${"hor_b".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"hor_c".$i} != "NaN"){$result .= "<td>".${"hor_c".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"hor_d".$i} != "NaN"){$result .= "<td>".${"hor_d".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"hor_g".$i} != "NaN"){$result .= "<td>".${"hor_g".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"hor_e".$i} != "NaN"){$result .= "<td>".${"hor_e".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"hor_f".$i} != "NaN"){$result .= "<td>".${"hor_f".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"pros".$i} != "NaN"){$result .= "<td>".${"pros".$i}."</td>";}else{$result .= "<td></td>";}
	$result .= "</tr>";
	}
	$result .= "</table><br/>";
	

	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td rowspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Όνομα</td>
	<td colspan=\"3\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Γωνίες σκίασης</td>
	<td colspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Τοίχος</td>
	<td colspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Πόρτα</td>
	<td colspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Άνοιγμα</td>
	</tr>
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Τοίχου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Πόρτας</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ανοίγμ.</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_hor_h</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_hor_c</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_hor_h</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_hor_c</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_hor_h</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_hor_c</td>
	</tr>";

	for ($i=1;$i<=10;$i++){
	$result .= "<tr>
	<td>".${"name".$i}."</td>
	<td>".round(${"deg_toixoy".$i},2)."</td>
	<td>".round(${"deg_door".$i},2)."</td>
	<td>".round(${"deg_an".$i},2)."</td>
	<td>".${"f_h_t".$i}."</td>
	<td>".${"f_c_t".$i}."</td>
	<td>".${"f_h_door".$i}."</td>
	<td>".${"f_c_door".$i}."</td>
	<td>".${"f_h_an".$i}."</td>
	<td>".${"f_c_an".$i}."</td>
	</tr>";
	}
	$result .= "</table><br/>";
	
	/* Οι εικόνες πρέπει να αποθηκευτούν προσωρινά για να περάσουν στο pdf
		for ($i=1;$i<=10;$i++){
		$result .=  "<img src=\"includes/image_creation_orizonta.php" . 
		"?ipsost=" . ${"hor_a".$i} . "&ipsosp=" . ${"hor_b".$i} . "&ipsospar=" . 
		${"hor_c".$i} . "&ipsospod=" . ${"hor_d".$i} . "&apostyal=" . ${"hor_g".$i} . "&apostemp=" . 
		${"hor_e".$i} . "&ypsosemp=" . ${"hor_f".$i} . "&pros=" . ${"pros".$i} . "&name=" . ${"name".$i} . "\"></img><br/>";
		}
	*/
	}//Τέλος αποτελεσμάτων ορίζοντα (ΝΟ 1)
//#############################################################################	
	
	
	if ($skiasi==2){//σκίαση προβόλου
	$prothema = "ov";
	$pdftitle = "Σκιάσεις Προβόλου";
		for ($i=1;$i<=10;$i++){
		${"deg_toixoy".$i}=$_GET["deg_toixoy".$i];
		${"deg_door".$i}=$_GET["deg_door".$i];
		${"deg_an".$i}=$_GET["deg_an".$i];
		${"pros".$i}=$_GET["pros".$i];
		${"name".$i}=$_GET["name".$i];
		${"ov_a".$i}=$_GET["ov_a".$i];
		${"ov_b".$i}=$_GET["ov_b".$i];
		${"ov_c".$i}=$_GET["ov_c".$i];
		${"ov_d".$i}=$_GET["ov_d".$i];
		${"ov_g".$i}=$_GET["ov_g".$i];
		${"ov_e".$i}=$_GET["ov_e".$i];
		
		${"array_toixoy".$i} = calc_skiasi_ov(${"deg_toixoy".$i}, ${"pros".$i});
		${"f_h_t".$i} = ${"array_toixoy".$i}[0];
		${"f_c_t".$i} = ${"array_toixoy".$i}[1];
		
		${"array_door".$i} = calc_skiasi_ov(${"deg_door".$i}, ${"pros".$i});
		${"f_h_door".$i} = ${"array_door".$i}[0];
		${"f_c_door".$i} = ${"array_door".$i}[1];
		
		${"array_an".$i} = calc_skiasi_ov(${"deg_an".$i}, ${"pros".$i});
		${"f_h_an".$i} = ${"array_an".$i}[0];
		${"f_c_an".$i} = ${"array_an".$i}[1];
		}
	
	
	$result .= "";
	if ($print==1){
	$result .= "<br/><img src=\"../images/shading/provolos.png\"></img><br/>";
	}
	
	
	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">A/A</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Όνομα στοιχείου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ύψος τοίχου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ύψος πόρτας</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ύψος αν.</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ύψος ποδιάς</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Απόσταση υαλ.</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Μήκος προβόλ.</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Προσ.</td>
	</tr>";
	for ($i=1;$i<=10;$i++){
	$result .= "<tr>
	<td>".$i."</td>";
	if (${"name".$i} != "NaN"){$result .= "<td>".${"name".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"ov_a".$i} != "NaN"){$result .= "<td>".${"ov_a".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"ov_b".$i} != "NaN"){$result .= "<td>".${"ov_b".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"ov_c".$i} != "NaN"){$result .= "<td>".${"ov_c".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"ov_d".$i} != "NaN"){$result .= "<td>".${"ov_d".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"ov_g".$i} != "NaN"){$result .= "<td>".${"ov_g".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"ov_e".$i} != "NaN"){$result .= "<td>".${"ov_e".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"pros".$i} != "NaN"){$result .= "<td>".${"pros".$i}."</td>";}else{$result .= "<td></td>";}
	$result .= "</tr>";
	}
	$result .= "</table><br/>";
	

	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td rowspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Όνομα</td>
	<td colspan=\"3\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Γωνίες σκίασης</td>
	<td colspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Τοίχος</td>
	<td colspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Πόρτα</td>
	<td colspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Άνοιγμα</td>
	</tr>
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Τοίχου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Πόρτας</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ανοίγμ.</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_ov_h</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_ov_c</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_ov_h</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_ov_c</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_ov_h</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_ov_c</td>
	</tr>";

	for ($i=1;$i<=10;$i++){
	$result .= "<tr>
	<td>".${"name".$i}."</td>
	<td>".round(${"deg_toixoy".$i},2)."</td>
	<td>".round(${"deg_door".$i},2)."</td>
	<td>".round(${"deg_an".$i},2)."</td>
	<td>".${"f_h_t".$i}."</td>
	<td>".${"f_c_t".$i}."</td>
	<td>".${"f_h_door".$i}."</td>
	<td>".${"f_c_door".$i}."</td>
	<td>".${"f_h_an".$i}."</td>
	<td>".${"f_c_an".$i}."</td>
	</tr>";
	}
	$result .= "</table><br/>";
	
	/* Οι εικόνες πρέπει να αποθηκευτούν προσωρινά για να περάσουν στο pdf
		for ($i=1;$i<=10;$i++){
		$result_fin2 .=  "<img src=\"includes/image_creation_prfin2olou.php" . 
		"?ipsost=" . ${"fin2_a".$i} . "&ipsosp=" . ${"fin2_b".$i} . "&ipsospar=" . 
		${"fin2_c".$i} . "&ipsospod=" . ${"hor_d".$i} . "&apostyal=" . ${"fin2_g".$i} . "&mikos_prfin2=" . 
		${"fin2_e".$i} . "&pros=" . ${"pros".$i} . "&name=" . ${"name".$i} . "\"></img><br/>";
		}
	*/
	}//Τέλος αποτελεσμάτων προβόλου (ΝΟ 2)
//#############################################################################	
	
	
	if ($skiasi==3){//Πλευρική σκίαση από 2 μεριές
	$prothema = "fin2";
	$pdftitle = "Σκιάσεις αριστερά και δεξιά";
		for ($i=1;$i<=10;$i++){
		${"deg_toixoy_ar".$i}=$_GET["deg_toixoy_ar".$i];
		${"deg_toixoy_de".$i}=$_GET["deg_toixoy_de".$i];
		${"pros".$i}=$_GET["pros".$i];
		${"name".$i}=$_GET["name".$i];
		${"fin2_a".$i}=$_GET["fin2_a".$i];
		${"fin2_b".$i}=$_GET["fin2_b".$i];
		${"fin2_c".$i}=$_GET["fin2_c".$i];
		${"fin2_d".$i}=$_GET["fin2_d".$i];
		${"fin2_e".$i}=$_GET["fin2_e".$i];
		
		${"array_t_ar".$i} = calc_skiasi_fin(${"deg_toixoy_ar".$i}, ${"pros".$i}, 1);
		${"f_h_t_ar".$i} = ${"array_t_ar".$i}[0];
		${"f_c_t_ar".$i} = ${"array_t_ar".$i}[1];
		
		${"array_t_de".$i} = calc_skiasi_fin(${"deg_toixoy_de".$i}, ${"pros".$i}, 2);
		${"f_h_t_de".$i} = ${"array_t_de".$i}[0];
		${"f_c_t_de".$i} = ${"array_t_de".$i}[1];
		
		${"f_h_t".$i} = ${"f_h_t_ar".$i}*${"f_h_t_de".$i};
		${"f_c_t".$i} = ${"f_c_t_ar".$i}*${"f_c_t_de".$i};
		}
	
	
	$result .= "";
	if ($print==1){
	$result .= "<br/><img src=\"../images/shading/pleyrika.png\"></img><br/>";
	}
	
	
	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">A/A</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Όνομα στοιχείου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Πλ. τοίχου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Απόστ. αρ.</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Εμπόδιο αρ.</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Απόστ. δεξ.</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Εμπόδιο δεξ.</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Προσ.</td>
	</tr>";
	for ($i=1;$i<=10;$i++){
	$result .= "<tr>
	<td>".$i."</td>";
	if (${"name".$i} != "NaN"){$result .= "<td>".${"name".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"fin2_a".$i} != "NaN"){$result .= "<td>".${"fin2_a".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"fin2_b".$i} != "NaN"){$result .= "<td>".${"fin2_b".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"fin2_c".$i} != "NaN"){$result .= "<td>".${"fin2_c".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"fin2_d".$i} != "NaN"){$result .= "<td>".${"fin2_d".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"fin2_e".$i} != "NaN"){$result .= "<td>".${"fin2_e".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"pros".$i} != "NaN"){$result .= "<td>".${"pros".$i}."</td>";}else{$result .= "<td></td>";}
	$result .= "</tr>";
	}
	$result .= "</table><br/>";
	

	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td rowspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Όνομα</td>
	<td colspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Γωνίες σκίασης</td>
	<td colspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Αριστερά</td>
	<td colspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Δεξιά</td>
	<td colspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Σύνολο</td>
	</tr>
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Αριστερά</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Δεξιά</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_fin2_h Αρ</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_fin2_c Αρ</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_fin2_h Δε</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_fin2_c Δε</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_fin2_h</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_fin2_c</td>
	</tr>";

	for ($i=1;$i<=10;$i++){
	$result .= "<tr>
	<td>".${"name".$i}."</td>
	<td>".round(${"deg_toixoy_ar".$i},2)."</td>
	<td>".round(${"deg_toixoy_de".$i},2)."</td>
	<td>".${"f_h_t_ar".$i}."</td>
	<td>".${"f_c_t_ar".$i}."</td>
	<td>".${"f_h_t_de".$i}."</td>
	<td>".${"f_c_t_de".$i}."</td>
	<td>".${"f_h_t".$i}."</td>
	<td>".${"f_c_t".$i}."</td>
	</tr>";
	}
	$result .= "</table><br/>";
	
	}//Τέλος αποτελεσμάτων πλευρικών από 2 μεριές (ΝΟ 3)



//#############################################################################	
	
	
	if ($skiasi==4){//Πλευρική σκίαση από 1 μεριά
	$prothema = "fin";
	$pdftitle = "Σκιάσεις αριστερά ή δεξιά";
		for ($i=1;$i<=10;$i++){
		${"deg_toixoy".$i}=$_GET["deg_toixoy".$i];
		${"deg_an".$i}=$_GET["deg_an".$i];
		${"pros".$i}=$_GET["pros".$i];
		${"name".$i}=$_GET["name".$i];
		${"fin_a".$i}=$_GET["fin_a".$i];
		${"fin_b".$i}=$_GET["fin_b".$i];
		${"fin_c".$i}=$_GET["fin_c".$i];
		${"fin_d".$i}=$_GET["fin_d".$i];
		${"fin_g".$i}=$_GET["fin_g".$i];
		${"fin_e".$i}=$_GET["fin_e".$i];
		${"fin_f".$i}=$_GET["fin_f".$i];
		
		
		${"array_t".$i} = calc_skiasi_fin(${"deg_toixoy".$i}, ${"pros".$i}, ${"fin_f".$i});
		${"f_h_t".$i} = ${"array_t".$i}[0];
		${"f_c_t".$i} = ${"array_t".$i}[1];
		
		${"array_an".$i} = calc_skiasi_fin(${"deg_toixoy".$i}, ${"pros".$i}, ${"fin_f".$i});
		${"f_h_an".$i} = ${"array_an".$i}[0];
		${"f_c_an".$i} = ${"array_an".$i}[1];
		
		}
	
	
	$result .= "";
	if ($print==1){
	$result .= "<br/><img src=\"../images/shading/pleyrika.png\"></img><br/>";
	}
	
	
	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">A/A</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Όνομα στοιχείου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Πλάτος τοίχου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Απόσταση τοίχου από εμπ.</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Πλάτος αν.</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Απόσταση αν. από εμπ.</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Απόσταση υαλ. από εξ. παρειά</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Μήκος εμποδίου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Θέση εμποδίου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Προσ.</td>
	</tr>";
	for ($i=1;$i<=10;$i++){
	$result .= "<tr>
	<td>".$i."</td>";
	if (${"name".$i} != "NaN"){$result .= "<td>".${"name".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"fin_a".$i} != "NaN"){$result .= "<td>".${"fin_a".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"fin_b".$i} != "NaN"){$result .= "<td>".${"fin_b".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"fin_c".$i} != "NaN"){$result .= "<td>".${"fin_c".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"fin_d".$i} != "NaN"){$result .= "<td>".${"fin_d".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"fin_g".$i} != "NaN"){$result .= "<td>".${"fin_g".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"fin_e".$i} != "NaN"){$result .= "<td>".${"fin_e".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"fin_f".$i} != "NaN"){$result .= "<td>".${"fin_f".$i}."</td>";}else{$result .= "<td></td>";}
	if (${"pros".$i} != "NaN"){$result .= "<td>".${"pros".$i}."</td>";}else{$result .= "<td></td>";}
	$result .= "</tr>";
	}
	$result .= "</table><br/>";
	

	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td rowspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Όνομα</td>
	<td colspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Γωνίες σκίασης</td>
	<td colspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Τοίχος</td>
	<td colspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Άνοιγμα</td>
	</tr>
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Τοίχου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ανοίγματος</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_fin_h Τ</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_fin_c Τ</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_fin_h Αν</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_fin_c Αν</td>
	</tr>";

	for ($i=1;$i<=10;$i++){
	$result .= "<tr>
	<td>".${"name".$i}."</td>
	<td>".round(${"deg_toixoy".$i},2)."</td>
	<td>".round(${"deg_an".$i},2)."</td>
	<td>".${"f_h_t".$i}."</td>
	<td>".${"f_c_t".$i}."</td>
	<td>".${"f_h_an".$i}."</td>
	<td>".${"f_c_an".$i}."</td>
	</tr>";
	}
	$result .= "</table><br/>";
	
	}//Τέλος αποτελεσμάτων πλευρικών από 2 μεριές (ΝΟ 4)



	
//#############################################################################	
	
	
	if ($skiasi==5){//σκίαση τέντας
	$prothema = "ovt";
	$pdftitle = "Σκιάσεις τέντας";
		for ($i=1;$i<=10;$i++){
		${"deg_toixoy".$i}=$_GET["deg_toixoy".$i];
		${"deg_door".$i}=$_GET["deg_door".$i];
		${"deg_an".$i}=$_GET["deg_an".$i];
		${"pros".$i}=$_GET["pros".$i];
		${"name".$i}=$_GET["name".$i];
		${"ovt_a".$i}=$_GET["ovt_a".$i];
		${"ovt_b".$i}=$_GET["ovt_b".$i];
		${"ovt_c".$i}=$_GET["ovt_c".$i];
		${"ovt_d".$i}=$_GET["ovt_d".$i];
		${"ovt_g".$i}=$_GET["ovt_g".$i];
		${"ovt_e".$i}=$_GET["ovt_e".$i];
		${"ovt_f".$i}=$_GET["ovt_f".$i];
		
		${"array_toixoy".$i} = calc_skiasi_ov(${"deg_toixoy".$i}, ${"pros".$i});
		${"f_h_t".$i} = ${"array_toixoy".$i}[0];
		${"f_c_t".$i} = ${"array_toixoy".$i}[1];
		
		${"array_door".$i} = calc_skiasi_ov(${"deg_door".$i}, ${"pros".$i});
		${"f_h_door".$i} = ${"array_door".$i}[0];
		${"f_c_door".$i} = ${"array_door".$i}[1];
		
		${"array_an".$i} = calc_skiasi_ov(${"deg_an".$i}, ${"pros".$i});
		${"f_h_an".$i} = ${"array_an".$i}[0];
		${"f_c_an".$i} = ${"array_an".$i}[1];
		}
	
	
	$result .= "";
	if ($print==1){
	$result .= "<br/><img src=\"../images/shading/tentes.png\"></img><br/>";
	}
	
	
	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">A/A</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Όνομα στοιχείου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ύψος τοίχου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ύψος πόρτας</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ύψος αν.</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ύψος ποδιάς</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Απόσταση υαλ.</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Μήκος τέντας</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ύψος τέντας</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Προσ.</td>
	</tr>";
	for ($i=1;$i<=10;$i++){
	$result .= "<tr>
	<td>".$i."</td>
	<td>".${"name".$i}."</td>
	<td>".${"ovt_a".$i}."</td>
	<td>".${"ovt_b".$i}."</td>
	<td>".${"ovt_c".$i}."</td>
	<td>".${"ovt_d".$i}."</td>
	<td>".${"ovt_g".$i}."</td>
	<td>".${"ovt_e".$i}."</td>
	<td>".${"ovt_f".$i}."</td>
	<td>".${"pros".$i}."</td>
	</tr>";
	}
	$result .= "</table><br/>";
	

	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td rowspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Όνομα</td>
	<td colspan=\"3\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Γωνίες σκίασης</td>
	<td colspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Τοίχος</td>
	<td colspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Πόρτα</td>
	<td colspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Άνοιγμα</td>
	</tr>
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Τοίχου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Πόρτας</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Ανοίγμ.</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_ovt_h</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_ovt_c</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_ovt_h</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_ovt_c</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_ovt_h</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_ovt_c</td>
	</tr>";

	for ($i=1;$i<=10;$i++){
	$result .= "<tr>
	<td>".${"name".$i}."</td>
	<td>".round(${"deg_toixoy".$i},2)."</td>
	<td>".round(${"deg_door".$i},2)."</td>
	<td>".round(${"deg_an".$i},2)."</td>
	<td>".${"f_h_t".$i}."</td>
	<td>".${"f_c_t".$i}."</td>
	<td>".${"f_h_door".$i}."</td>
	<td>".${"f_c_door".$i}."</td>
	<td>".${"f_h_an".$i}."</td>
	<td>".${"f_c_an".$i}."</td>
	</tr>";
	}
	$result .= "</table><br/>";
	
	/* Οι εικόνες πρέπει να αποθηκευτούν προσωρινά για να περάσουν στο pdf
		for ($i=1;$i<=10;$i++){
		$result_fin2 .=  "<img src=\"includes/image_creation_prfin2olou.php" . 
		"?ipsost=" . ${"fin2_a".$i} . "&ipsosp=" . ${"fin2_b".$i} . "&ipsospar=" . 
		${"fin2_c".$i} . "&ipsospod=" . ${"hor_d".$i} . "&apostyal=" . ${"fin2_g".$i} . "&mikos_prfin2=" . 
		${"fin2_e".$i} . "&pros=" . ${"pros".$i} . "&name=" . ${"name".$i} . "\"></img><br/>";
		}
	*/
	}//Τέλος αποτελεσμάτων τέντας (ΝΟ 5)

	



//#############################################################################	
	
	
	if ($skiasi==6){//σκίαση περσίδων
	$prothema = "fsh";
	$pdftitle = "Σκιάσεις περσίδων";
		for ($i=1;$i<=10;$i++){
		${"deg_toixoy".$i}=$_GET["deg_toixoy".$i];
		${"pros".$i}=$_GET["pros".$i];
		${"name".$i}=$_GET["name".$i];
		${"fsh_a".$i}=$_GET["fsh_a".$i];
		${"fsh_b".$i}=$_GET["fsh_b".$i];
		${"fsh_c".$i}=$_GET["fsh_c".$i];
		
		${"array_toixoy".$i} = calc_skiasi_fsh(${"deg_toixoy".$i}, ${"pros".$i}, ${"fsh_a".$i});
		${"f_h_t".$i} = ${"array_toixoy".$i}[0];
		${"f_c_t".$i} = ${"array_toixoy".$i}[1];

		}
	
	
	$result .= "";
	if ($print==1){
	$result .= "<br/><img src=\"../images/shading/persides.png\"></img><br/>";
	}
	
	
	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">A/A</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Όνομα</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Τύπος</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Μήκος περσίδων</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Απόσταση περσίδων</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Προσ.</td>
	</tr>";
	for ($i=1;$i<=10;$i++){
	$result .= "<tr>
	<td>".$i."</td>
	<td>".${"name".$i}."</td>
	<td>".${"fsh_a".$i}."</td>
	<td>".${"fsh_b".$i}."</td>
	<td>".${"fsh_c".$i}."</td>
	<td>".${"pros".$i}."</td>
	</tr>";
	}
	$result .= "</table><br/>";
	

	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td rowspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Όνομα</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Γωνίες σκίασης</td>
	<td colspan=\"2\" style=\"border:1px #6699CC dotted;vertical-align:middle;\">Τοίχος</td>
	</tr>
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Περσίδων</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_fsh_h</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">f_fsh_c</td>
	</tr>";

	for ($i=1;$i<=10;$i++){
	$result .= "<tr>
	<td>".${"name".$i}."</td>
	<td>".round(${"deg_toixoy".$i},2)."</td>
	<td>".${"f_h_t".$i}."</td>
	<td>".${"f_c_t".$i}."</td>
	</tr>";
	}
	$result .= "</table><br/>";
	
	/* Οι εικόνες πρέπει να αποθηκευτούν προσωρινά για να περάσουν στο pdf
		for ($i=1;$i<=10;$i++){
		$result_fin2 .=  "<img src=\"includes/image_creation_prfin2olou.php" . 
		"?ipsost=" . ${"fin2_a".$i} . "&ipsosp=" . ${"fin2_b".$i} . "&ipsospar=" . 
		${"fin2_c".$i} . "&ipsospod=" . ${"hor_d".$i} . "&apostyal=" . ${"fin2_g".$i} . "&mikos_prfin2=" . 
		${"fin2_e".$i} . "&pros=" . ${"pros".$i} . "&name=" . ${"name".$i} . "\"></img><br/>";
		}
	*/
	}//Τέλος αποτελεσμάτων περσίδων (ΝΟ 6)
	

//#############################################################################	
	
	
	if ($skiasi==7){//Φύλλο υπολογισμού σκιάσεων
	$prothema = "fyllo";
	$pdftitle = "Φύλλο υπολογισμού σκιάσεων";
	
	//γενικά
	$fyllo_name=$_GET["fyllo_name"];
	$fyllo_th=$_GET["fyllo_th"];
	$fyllo_l=$_GET["fyllo_l"];
	$fyllo_h=$_GET["fyllo_h"];
	$fyllo_p=$_GET["fyllo_p"];
	$fyllo_g=$_GET["fyllo_g"];
	$fyllo_pros=$_GET["fyllo_pros"];
	
	//hor
	$fyllo_hor_l=$_GET["fyllo_hor_l"];
	$fyllo_hor_h=$_GET["fyllo_hor_h"];
	//ov
	$fyllo_ov_l=$_GET["fyllo_ov_l"];
	//finl
	$fyllo_finl_l=$_GET["fyllo_finl_l"];
	$fyllo_finl_h=$_GET["fyllo_finl_h"];
	//finr
	$fyllo_finr_l=$_GET["fyllo_finr_l"];
	$fyllo_finr_h=$_GET["fyllo_finr_h"];
	
	//Γενικά
	$result .= "Φύλλο υπολογισμού σκιάσεων:".$fyllo_name."<br/><br/><br/>";
	
	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#99FFCC;border:1px #99FFCC dotted;\">
	<td style=\"border:1px #99FFCC dotted;vertical-align:middle;\" colspan=\"6\">Στοιχεία ανοίγματος</td>
	</tr>
	<tr style=\"background-color:#99FFCC;border:1px #99FFCC dotted;\">
	<td style=\"border:1px #99FFCC dotted;vertical-align:middle;\">Ύψος τοίχου</td>
	<td style=\"border:1px #99FFCC dotted;vertical-align:middle;\">Μήκος (m)</td>
	<td style=\"border:1px #99FFCC dotted;vertical-align:middle;\">Ύψος (m)</td>
	<td style=\"border:1px #99FFCC dotted;vertical-align:middle;\">Ποδιά (m)</td>
	<td style=\"border:1px #99FFCC dotted;vertical-align:middle;\">Εσοχή (m)</td>
	<td style=\"border:1px #99FFCC dotted;vertical-align:middle;\">Προσ.</td>
	</tr>";
	$result .= "<tr>
	<td>".$fyllo_th."</td>
	<td>".$fyllo_l."</td>
	<td>".$fyllo_h."</td>
	<td>".$fyllo_p."</td>
	<td>".$fyllo_g."</td>
	<td>".$fyllo_pros."</td>
	</tr>";
	$result .= "</table><br/><br/><br/>";
	
	//HOR
	if($fyllo_hor_l!="NaN"){
	
	$fhor_deg = atan(($fyllo_hor_h-$fyllo_p-($fyllo_h/2)) / ($fyllo_hor_l + $fyllo_g) )*180/pi();
	$fhor = calc_skiasi_hor($fhor_deg, $fyllo_pros);
	$fhor_h = $fhor[0];
	$fhor_c = $fhor[1];
	
	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\" colspan=\"5\">Σκίαση ορίζοντα</td></tr>";
	if($print==1){
	$result .= "<tr><td style=\"border:1px #6699CC dotted;vertical-align:middle;\" colspan=\"5\"><img src=\"../images/shading/fhor.png\" height=\"100px\"></td></tr>";
	}
	
	$result .= "<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Απόσταση εμποδίου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Μήκος εμποδίου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Γωνία σκίασης</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">F_hor_h</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">F_hor_c</td>
	</tr>";
	$result .= "<tr>
	<td>".$fyllo_hor_l."</td>
	<td>".$fyllo_hor_h."</td>
	<td>".round($fhor_deg,2)."</td>
	<td>".$fhor_h."</td>
	<td>".$fhor_c."</td>
	</tr>";
	$result .= "</table><br/><br/><br/>";
	}else{
	$fhor_h=1;
	$fhor_c=1;
	}
	
	//OV
	if($fyllo_ov_l!="NaN"){
	
	$fov_deg = atan( ($fyllo_ov_l+$fyllo_g) / ($fyllo_th-$fyllo_p-($fyllo_h/2)) )*180/pi();
	$fov = calc_skiasi_ov($fov_deg, $fyllo_pros);
	$fov_h = $fov[0];
	$fov_c = $fov[1];
	
	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\" colspan=\"4\">Σκίαση προβόλου</td></tr>";
	if($print==1){
	$result .= "<tr><td style=\"border:1px #6699CC dotted;vertical-align:middle;\" colspan=\"5\"><img src=\"../images/shading/fov.png\" height=\"100px\"></td></tr>";
	}
	
	$result .= "<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Μήκος προβόλου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Γωνία σκίασης</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">F_ov_h</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">F_ov_c</td>
	</tr>";
	$result .= "<tr>
	<td>".$fyllo_ov_l."</td>
	<td>".round($fov_deg,2)."</td>
	<td>".$fov_h."</td>
	<td>".$fov_c."</td>
	</tr>";
	$result .= "</table><br/><br/><br/>";
	}else{
	$fov_h=1;
	$fov_c=1;
	}
	
	//FIN_L
	if($fyllo_finl_l!="NaN"){
		$ffin_l_deg = atan( ($fyllo_finl_h+$fyllo_g) / ($fyllo_finl_l+$fyllo_l/2) )*180/pi();
		$ffin_l = calc_skiasi_fin($ffin_l_deg, $fyllo_pros, 1);
	$ffin_l_h = $ffin_l[0];
	$ffin_l_c = $ffin_l[1];

	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\" colspan=\"5\">Σκίαση από αριστερά</td></tr>";
	if($print==1){
	$result .= "<tr><td style=\"border:1px #6699CC dotted;vertical-align:middle;\" colspan=\"5\"><img src=\"../images/shading/ffin_l.png\" height=\"100px\"></td></tr>";
	}
	
	$result .= "<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Απόσταση εμποδίου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Μήκος εμποδίου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Γωνία σκίασης</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">F_fin_l_h</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">F_fin_l_c</td>
	</tr>";
	$result .= "<tr>
	<td>".$fyllo_finl_l."</td>
	<td>".$fyllo_finl_h."</td>
	<td>".round($ffin_l_deg,2)."</td>
	<td>".$ffin_l_h."</td>
	<td>".$ffin_l_c."</td>
	</tr>";
	$result .= "</table><br/><br/>";
	}else{
	$ffin_l_h=1;
	$ffin_l_c=1;
	}
	
	
	//FIN_R
	if($fyllo_finr_l!="NaN"){
		$ffin_r_deg = atan( ($fyllo_finr_h+$fyllo_g) / ($fyllo_finr_l+$fyllo_l/2) )*180/pi();
		$ffin_r = calc_skiasi_fin($ffin_r_deg, $fyllo_pros, 2);
	$ffin_r_h = $ffin_r[0];
	$ffin_r_c = $ffin_r[1];
	
	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\" colspan=\"5\">Σκίαση από δεξιά</td></tr>";
	if($print==1){
	$result .= "<tr><td style=\"border:1px #6699CC dotted;vertical-align:middle;\" colspan=\"5\"><img src=\"../images/shading/ffin_r.png\" height=\"100px\"></td></tr>";
	}
	
	$result .= "<tr style=\"background-color:#ddd;border:1px #6699CC dotted;\">
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Απόσταση εμποδίου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Μήκος εμποδίου</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">Γωνία σκίασης</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">F_fin_r_h</td>
	<td style=\"border:1px #6699CC dotted;vertical-align:middle;\">F_fin_r_c</td>
	</tr>";
	$result .= "<tr>
	<td>".$fyllo_finr_l."</td>
	<td>".$fyllo_finr_h."</td>
	<td>".round($ffin_r_deg,2)."</td>
	<td>".$ffin_r_h."</td>
	<td>".$ffin_r_c."</td>
	</tr>";
	$result .= "</table><br/><br/>";
	}else{
	$ffin_r_h=1;
	$ffin_r_c=1;
	}
	$ffin_h = $ffin_r_h * $ffin_l_h;
	$ffin_c = $ffin_r_c * $ffin_l_c;
	
	//ΣΥΝΟΛΙΚΟΙ ΣΥΝΤΕΛΕΣΤΕΣ
	$result .= "<table style=\"width:100%;text-align:center;background-color:#ffffff;border:1px #6699CC dotted;\">
	<tr style=\"background-color:#99FF33;border:1px #99FF33 dotted;\">
	<td style=\"border:1px #99FF33 dotted;vertical-align:middle;\" colspan=\"6\">Συντελεστές σκίασης ανοίγματος</td>
	</tr>
	<tr style=\"background-color:#99FF33;border:1px #99FF33 dotted;\">
	<td style=\"border:1px #99FF33 dotted;vertical-align:middle;\">F_hor_h</td>
	<td style=\"border:1px #99FF33 dotted;vertical-align:middle;\">F_hor_c</td>
	<td style=\"border:1px #99FF33 dotted;vertical-align:middle;\">F_ov_h</td>
	<td style=\"border:1px #99FF33 dotted;vertical-align:middle;\">F_ov_c</td>
	<td style=\"border:1px #99FF33 dotted;vertical-align:middle;\">F_fin_h</td>
	<td style=\"border:1px #99FF33 dotted;vertical-align:middle;\">F_fin_c</td>
	</tr>";
	$result .= "<tr>
	<td><b>".$fhor_h."</b></td>
	<td><b>".$fhor_c."</b></td>
	<td><b>".$fov_h."</b></td>
	<td><b>".$fov_c."</b></td>
	<td><b>".round($ffin_h,3)."</b></td>
	<td><b>".round($ffin_c,3)."</b></td>
	</tr>";
	$result .= "</table><br/>";
	$f_h=$fhor_h*$fov_h*$ffin_h;
	$f_c=$fhor_c*$fov_c*$ffin_c;
	
	$result .= "<br/>Όλες οι διαστάσεις δίνονται σε μέτρα. Οι γωνίες σκίασης δίνονται σε μοίρες. Ο προσανατολισμός του ανοίγματος δίνεται σε μοίρες όπου:<br/>
	0=Βόρειος προσ., 90=Ανατολικός προσ., 180=Νότιος προσ., 270=Δυτικός προσ.<br/>
	Ο συνολικός συντελεστής σκίασης είναι το γινόμενο των 3ων συντελεστών. Στο συγκεκριμένο υπολογισμό:<br/>
	F_h=<b>".round($f_h,3)."</b>, F_c=<b>".round($f_c,3)."</b>";
	}//Τέλος αποτελεσμάτων φύλλου (ΝΟ 7)
	
	
	
	
//ΕΠΙΛΟΓΗ ΕΜΦΑΝΙΣΗΣ Η ΑΠΟΘΗΚΕΥΣΗΣ
//#############################################################################

		if($print==0){ //Δεν ορίστηκε εκτύπωση. Απλή εμφάνιση
		echo $result;
		}else{ //Ορίστηκε εκτύπωση
		
		
		ob_start();
		@ob_flush();
		@flush();
		ob_start();
		
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
				$this->Cell(0, 15, $pdftitle, 'B', false, 'C', 0, '', 0, false, 'M', 'B');
			}
			// Page footer
			public function Footer() {
				// Position at 15 mm from bottom
				$this->SetY(-15);
				// Set font
				$this->SetFont('dejavusans', 'N', 8);
				// Page number
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
		$pdf->writeHTML($result, $ln = true, $fill = false, $reseth = true, $cell = false, $align = '' ) ;
		
		ob_end_clean();
		// ---------------------------------------------------------
		//Close and output PDF document
		$pdf->Output("../PDF/user".$_SESSION['user_id']."-meleti".$_SESSION['meleti_id']."-f_".$prothema.".pdf", 'F');
		
		}
		?>
		<script type="text/javascript">
		window.open("<?php echo "../PDF/user".$_SESSION['user_id']."-meleti".$_SESSION['meleti_id']."-f_".$prothema.".pdf";?>", "La-kenak");
		window.close();
		</script>
<?php


?>