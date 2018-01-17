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
//error_reporting(0);

if (isset($_GET['gen_xrisi'])){
	$gen_xrisi = $_GET['gen_xrisi'];
	$type = $_GET['type'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$tb_synthikes = create_library_synthikes($gen_xrisi,$type);
	echo $tb_synthikes;
	exit;
}

if (isset($_GET['climate'])){
	$table = $_GET['table'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$tb_climateb = create_library_climate($table);
	echo $tb_climateb;
	exit;
}

if (isset($_GET['place'])){
	$place = $_GET['place'];
	$b = $_GET['b'];
	$g = $_GET['g'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$tb_climateb = create_library_climateb($place,$b,$g);
	echo $tb_climateb;
	exit;
}

if (isset($_GET['law_type'])){
	$type = $_GET['law_type'];
	$page = $_GET['page'];
	$like = $_GET['like'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$tb_laws = create_library_laws($type,$page,$like);
	echo $tb_laws;
	exit;
}
if (isset($_GET['get_materials'])){
	$category = $_GET['category'];
	$subcategory = $_GET['subcategory'];
	$page = $_GET['page'];
	$like = $_GET['like'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$tb_laws = create_library_materials($category,$subcategory,$page,$like);
	echo $tb_laws;
	exit;
}
if (isset($_GET['get_heatpumpsex'])){
	$manufacturer = $_GET['manufacturer'];
	$outdoor = $_GET['outdoor'];
	$page = $_GET['page'];
	$like = $_GET['like'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$tb_laws = create_library_heatpumpsex($manufacturer,$outdoor,$page,$like);
	echo $tb_laws;
	exit;
}

if (isset($_GET['get_help'])){
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$help = create_library_help();
	echo $help;
	exit;
}

if (isset($_GET['getmeletes'])){
	$page = $_GET['page'];
	$like = $_GET['like'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	require_once("functions_interface.php");
	confirm_logged_in();
	$tb_laws = create_user_meletes($page,$like);
	echo $tb_laws;
	exit;
}

require("include_check.php");

//Εκτύπωση μελετών χρήστη
function create_user_meletes($page=1,$like=""){
	
	$database = new medoo(DB_NAME);
	$tb = "user_meletes";
	$col = "*";
	
	if($like!=""){
		$where=array("AND"=>array("user_id"=>$_SESSION['user_id']),"LIKE"=>array("name"=>$like));
		$data_meletes = $database->select($tb,$col,$where);
	}
	if($like==""){
		$where=array("user_id"=>$_SESSION['user_id']);
		$data_meletes = $database->select($tb,$col,$where);
	}
	$count_meletes = count($data_meletes);
	$total_pages = ceil($count_meletes/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_meletes<$count_end){$count_end=$count_meletes;}
	$new_page=ceil(($count_meletes+1)/10);
	
	$meletes = "<table class=\"table table-bordered table-condensed table-hover\">
	<tr class=\"active\">
	<th width=10%><span class=\"tip-top\" href=\"#\" title=\"Αρίθμηση και σε σημείωση το id του πίνακα meletes (εάν ζητηθεί από το διαχειριστή για υποστήριξη)\">α/α</span></th>
	<th width=25%><span class=\"tip-top\" href=\"#\" title=\"Χαρακτηριστικό όνομα της μελέτης\">Όνομα</span></th>
	<th width=25%><span class=\"tip-top\" href=\"#\" title=\"Η διεύθυνση του ακινήτου\">Διεύθυνση</span></th>
	<th width=10%><span class=\"tip-top\" href=\"#\" title=\"Χρήση κτιρίου\">Χρήση κτιρίου</span></th>
	<th width=10%><span class=\"tip-top\" href=\"#\" title=\"Τύπος μελέτης\">Τύπος</span></th>
	<th width=10%><span class=\"tip-top\" href=\"#\" title=\"Επιλογές για την επιλογή/διαγραφή μελέτης\">Ενέργειες</span></th>
	<th width=10%><span class=\"tip-top\" href=\"#\" title=\"Εάν έχει δημιουργηθεί το τεύχος εμφανίζεται εικονίδιο για κατέβασμα.\">Εικόνα/Τεύχος</span></th>
	</tr>";
	
	$i=1;
	foreach($data_meletes as $data){
		if($i<=$page*10 AND $i>$page*10-10){
	$meletes .= "<tr>";
	$meletes .= "<td><span class=\"label label-default\">".$i."</span><span class=\"label label-info\">".$data["datetime"]."</span></td>
	<td>".$data["name"]."</td>
	<td>".$data["address"]."</td>";
	
		$data_xrisi = $database->select("vivliothiki_conditions_building","name",array("id"=>$data["xrisi"]));
	$meletes .= "<td>".$data_xrisi[0]."</td>";
		if($data["type"]==0){$type="Παλιό";}
		if($data["type"]==1){$type="Ριζ. Ανακαινιζόμενο (Κ.Εν.Α.Κ.)";}
		if($data["type"]==2){$type="Νέο (Κ.Εν.Α.Κ.)";}
		if($data["type"]==3){$type="Ριζ. Ανακαινιζόμενο (Αναθ. Κ.Εν.Α.Κ.)";}
		if($data["type"]==4){$type="Νέο (Αναθ. Κ.Εν.Α.Κ.)";}
	$meletes .= "<td>".$type."</td>";
	$meletes .= "<td>";
	$meletes .= "<div class=\"btn-group\">";
	$meletes .= "<a type=\"button\" class=\"btn btn-default btn-sm\" href=\"?nav=user_login&action=select_meleti&meleti_id=".$data["id"]."\"><i class=\"fa fa-check-square-o\"></i> Επιλογή</a>";
	$meletes .= "<button type=\"button\" class=\"btn btn-default btn-sm dropdown-toggle\" data-toggle=\"dropdown\">";
	$meletes .= "<span class=\"caret\"></span>";
	$meletes .= "</button>";
	$meletes .= "<ul class=\"dropdown-menu\">";
	$meletes .= "<li><a tabindex=\"1\" href=\"?nav=user_login&action=select_meleti&meleti_id=".$data["id"]."\"><i class=\"fa fa-check-square-o\"></i> Επιλογή</a></li>";
	$meletes .= "<li><a tabindex=\"2\" href=\"?nav=user_login&action=copy_meleti&meleti_id=".$data["id"]."\"><i class=\"fa fa-files-o\"></i> Αντιγραφή</a></li>";
	$meletes .= "<li><a tabindex=\"3\" href=\"?nav=user_login&action=delete_meleti&meleti_id=".$data["id"]."\"><i class=\"fa fa-times\"></i> Διαγραφή</a></li>";
	$meletes .= "</ul>";
	$meletes .= "</div></td>";
	$filename = "PDF/user".$_SESSION['user_id']."-meleti".$data["id"]."-teyxos.pdf";
	$meletes .= "<td>";
	
	$pea_img_file = "file_upload/server/php/files/user_".$_SESSION['user_id']."/meleti_".$data["id"]."/thumbnail/pea_img.jpg";
	if(file_exists($pea_img_file)){
		$meleti_image="includes/".$pea_img_file;
		$tip_image="includes/file_upload/server/php/files/user_".$_SESSION['user_id']."/meleti_".$data["id"]."/pea_img.jpg";
		$meletes .= "<span class=\"tip-top\" title=\"<img src='".$tip_image."' width='180px'>\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></span>";
		//$meletes .= "<img src=\"".$meleti_image."\" class=\"img-circle\" alt=\"Meleti Image\">";
	}else{
		$meleti_image="images/xrisi/18.png";
		$meletes .= "<i class=\"fa fa-ban\" aria-hidden=\"true\"></i>";
	}
	
		if(file_exists($filename)){
		$meletes .= " / <a href=\"".$filename."\" target=\"_blank\"><i src=\"fa fa-files-pdf-o\"></i></a> ";
		}else{
		$meletes .= " / <i class=\"fa fa-ban\"></i> ";
		}
		
	$meletes .= "</td>";
	$meletes .= "</tr>";
		}
	$i++;
	}
	$meletes .= "</table><div class=\"box-footer clearfix\">";
	
	if($count_meletes!=0){
		$meletes .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_meletes." μελετών.";
	}else{
		$meletes .= "Δεν βρέθηκαν αποτελέσματα με βάση το όνομα που δηλώσατε.";
	}
	
	//PAGINATION
	$meletes .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_meletes(".$previous_page.")\"";}
	$meletes .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
	if($total_pages<=10){
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$meletes .= "<li".$disabled."><a href=\"#\" onclick=\"get_meletes(".$j.")\">".$j."</a></li>";
		}
	}else{
		if($page>3){
			$meletes .= "<li><a href=\"#\" onclick=\"get_meletes(1)\">1</a></li>";
			$meletes .= "<li class=\"disabled\"><a href=\"#\">...</a></li>";
		}
		for($j=$page-2; $j<=$page+2; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			if($j>0 AND $j<=$total_pages){
				$meletes .= "<li".$disabled."><a href=\"#\" onclick=\"get_meletes(".$j.")\">".$j."</a></li>";
			}
		}
		if($page<$total_pages-3){
			$meletes .= "<li class=\"disabled\"><a href=\"#\">...</a></li>";
			$meletes .= "<li><a href=\"#\" onclick=\"get_meletes(".$total_pages.")\">".$total_pages."</a></li>";
		}
	}
		
	if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_meletes(".$next_page.")\"";}
	$meletes .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$meletes .= "</ul></div>";
	//PAGINATION
	
	return $meletes;
	
}


//Εκτύπωση βοήθειας
function create_library_help(){

	$database = new medoo(DB_NAME);
	$tb = "vivliothiki_help";
	$col = "*";
	$data_help = $database->select($tb,$col);
	$count_help = count($data_help);
	
	$help = "<div class=\"box box-solid\">";
	$help = "<div class=\"box-header with-border\">";
	$help = "<h3 class=\"box-title\">Βοήθεια - FAQ</h3>";
	$help = "</div>";
	$help = "<div class=\"box-body\">";
	$help = "<div class=\"box-group\" id=\"accordion\">";
	
		$i=1;
		foreach($data_help as $data){
			$help .= "<div class=\"panel box box-primary\">";
			$help .= "<div class=\"box-header with-border\">";
			$help .= "<h4 class=\"box-title\">";
			$help .= "<a data-toggle=\"collapse\" data-parent=\"accordion\" href=\"#collapse".$i."\">";
			$help .= $data["name"];
			$help .= "</a>";
			$help .= "</h4></div>";//box-header
			$help .= "<div id=\"collapse".$i."\" class=\"panel-collapse collapse\">";
			$help .= "<div class=\"box-body\">";
			$help .= $data["text"];
			$help .= "</div>";//box-body
			$help .= "</div>";//box-body
			$help .= "</div>";//panel
		$i++;	
		}
	$help .= "</div>";//box-group
	$help .= "</div>";//box-body
	$help .= "</div>";//box	
		
	return $help;
}

//Εκτύπωση τεκμηρίωσης
function create_library_peri(){
	
	$peri = '<div class="tabbable tabs-left">
					<ul class="nav nav-pills">
						<li class="active"><a href="#tab11" data-toggle="tab">Προγραμματισμός</a></li>
						<li><a href="#tab12" data-toggle="tab">Εμφάνιση</a></li>
						<li><a href="#tab13" data-toggle="tab">Αποθήκευση</a></li>
						<li><a href="#tab14" data-toggle="tab">Βιβλιοθήκες</a></li>
						<li><a href="#tab15" data-toggle="tab">Λοιπά</a></li>
					</ul>
					
					
					<div class="tab-content">
						<div class="tab-pane active" id="tab11">
							<ul>
								<li>
									<a href="http://www.php.net" target="_blank">
									<img src="images/libraries/php.png" width="24px" height="24px"> PHP
									</a>
								</li>
								<li>
									<a href="http://el.wikipedia.org/wiki/JavaScript" target="_blank">
									<img src="images/libraries/javascript.png" width="24px" height="24px"> Javascript
									</a>
								</li>
								<li>
									<a href="http://www.mysql.com" target="_blank">
									<img src="images/libraries/mysql.png" width="24px" height="24px"> Mysql
									</a>
								</li>
								<li>
									<a href="http://www.jquery.com" target="_blank">
									<img src="images/libraries/jquery.png" width="24px" height="24px"> Jquery
									</a>
								</li>
							</ul>
						</div>
						
						<div class="tab-pane" id="tab12">
							<ul>
								<li>
									<a href="http://getbootstrap.com/" target="_blank">
									<img src="images/libraries/bootstrap.png" width="24px" height="24px"> Bootstrap v3 - MIT License
									</a>
								</li>
								<li>
									<a href="http://www.jqueryui.com" target="_blank">
									<img src="images/libraries/jqueryui.png" width="24px" height="24px"> Jquery UI - MIT License
									</a>
								</li>
							</ul>
						</div>
						
						<div class="tab-pane" id="tab13">
							<ul>
								<li>
									<a href="http://www.mysql.com" target="_blank">
									<img src="images/libraries/mysql.png" width="24px" height="24px"> Mysql
									</a>
								</li>
								<li>
									<a href="http://www.phpmyadmin.com" target="_blank">
									<img src="images/libraries/phpmyadmin.png" width="24px" height="24px"> Phpmyadmin
									</a>
								</li>
							</ul>
						</div>
						
						<div class="tab-pane" id="tab14">
							<ul>
								<li>
									<a href="http://medoo.in/" target="_blank">
									<img src="images/libraries/medoo.png" width="24px" height="24px"> Medoo - MIT License
									</a>
								</li>
								<li>
									<a href="https://github.com/ckeditor/ckeditor-releases" target="_blank">
									<img src="images/libraries/ckeditor.png" width="24px" height="24px"> ckeditor - GPL/LGPL/MPL License
									</a>
								</li>
								<li>
									<a href="https://github.com/PHPOffice/PHPWord" target="_blank">
									PHPWord - LGPL
									</a>
								</li>
								<li>
									<a href="https://github.com/PHPOffice/PHPExcel" target="_blank">
									PHPExcel - LGPL
									</a>
								</li>
								<li>
									<a href="http://htmltodocx.codeplex.com/" target="_blank">
									HTMLtodocx - GPL
									</a>
								</li>
								<li>
									<a href="http://www.tcpdf.org/" target="_blank">
									<img src="images/libraries/tcpdf.png" width="24px" height="24px"> tcPDF - GNU-GPL v3
									</a>
								</li>
								<li>
									<a href="https://github.com/lsolesen/fpdi" target="_blank">
									fpdi - Apache License, Version 2.0
									</a>
								</li>
								<li>
									<a href="http://pchart.sourceforge.net/" target="_blank">
									pChart - GNU-GPL v3
									</a>
								</li>
								<li>
									<a href="https://github.com/simogeo/Filemanager" target="_blank">
									Filemanager - MIT License
									</a>
								</li>
								<li>
									<a href="https://github.com/juanbrujo/jQuery-Timelinr" target="_blank">
									jQuery Timelinr - MIT License
									</a>
								</li>
								<li>
									<a href="https://github.com/aterrien/jQuery-Knob" target="_blank">
									jQuery Knob - MIT License
									</a>
								</li>
								<li>
									<a href="https://github.com/trentrichardson/jQuery-Timepicker-Addon" target="_blank">
									jQuery Time picker addon - GPL/MIT License
									</a>
								</li>
							</ul>
						</div>
						
						<div class="tab-pane" id="tab15">
							<ul>
								<li>Fonts - Όπως διανέμονται με τις βιβλιοθήκες</li>
								<li>PNG Icons - iconarchive.com</li>
								<li>Παραγωγή εικόνων (λογισμικά που χρησιμοποιήθηκαν - PHPMATHPUBLISHER (Δεν περιέχεται στη διανομή) - GNU General Public License, GIMP2, Archimedes free cad.</li>
							</ul>
						</div>
						
					</div>
				</div>';	
		
	return $peri;
}


//Εκτύπωση υλικών τοτεε
function create_library_materials($category=0,$subcategory=0,$page=1,$like=""){
	
	$database = new medoo(DB_NAME);
	$tb = "vivliothiki_domika";
	$col = "*";
	
	if($category==0 AND $subcategory==0 AND $like==""){
		$tb_data = $database->select($tb,$col);
	}
	if($category!=0 OR $subcategory!=0 OR $like!=""){
		if($category==0 AND $subcategory==0 AND $like!=""){
			$where=array("LIKE"=>array("material"=>$like));
		}
		if($category==0 AND $subcategory!=0 AND $like!=""){
			$where=array("LIKE"=>array("AND"=>array("material"=>$like,"subcategory"=>$subcategory)) );
		}
		if($category!=0 AND $subcategory==0 AND $like!=""){
			$where=array("LIKE"=>array("AND"=>array("material"=>$like,"category"=>$category)) );
		}
		if($category!=0 AND $subcategory!=0 AND $like!=""){
			$where=array("LIKE"=>array("AND"=>array("material"=>$like,"category"=>$category,"subcategory"=>$subcategory)) );
		}
		if($category!=0 AND $subcategory==0 AND $like==""){
			$where=array("category"=>$category);
		}
		if($category==0 AND $subcategory!=0 AND $like==""){
			$where=array("subcategory"=>$subcategory);
		}
		if($category!=0 AND $subcategory!=0 AND $like==""){
			$where=array("AND"=>array("category"=>$category,"subcategory"=>$subcategory));
		}
		$tb_data = $database->select($tb,$col,$where);
	}
	
	$category_array=array(
		1=>"1.Ανόργανα δομικά υλικά",
		2=>"2.Ξύλα",
		3=>"3.Μέταλλα/Γυαλί",
		4=>"4.Υποστρώματα/Επιστρώσεις",
		5=>"5.Συνθετικά/ρητίνες/σιλικόνες",
		6=>"6.Βερνίκια και βαφές",
		7=>"7.Θερμομονωτικά",
		8=>"8.Αέρια",
		9=>"9.Νερό"
	);
	$subcategory1_array=array(
		1=>"1.1.Φυσικοί λίθοι και γαιές",
		2=>"1.2.Γαιώδη υλικά και υλικά πλήρωσης διακένων, οροφών, τοίχων",
		3=>"1.3.Κατεργασμένη άργιλος (πηλός)",
		4=>"1.4.Επιχρίσματα/Κονιάματα",
		5=>"1.5.Σκυροδέματα",
		6=>"1.6.Λιθοσώματα",
		7=>"1.7.Τοιχοποιίες",
		8=>"1.8.Υαλότουβλα",
		9=>"1.9.Κεραμίδια"
	);
	$subcategory2_array=array(
		1=>"2.1.Συμπαγής ξυλεία",
		2=>"2.2.Προϊόντα ξύλου"
	);
	$subcategory3_array=array(
		1=>"3.1.Γυαλί",
		2=>"3.2.Μέταλλα"
	);
	$subcategory4_array=array(
		1=>"4.1.Λινέλαιο",
		2=>"4.2.Υποστρώματα",
		3=>"4.3.Πλακίδια φελλού",
		4=>"4.4.Μοκέτα",
		5=>"4.5.Καουτσούκ/λάστιχο",
		6=>"4.6.Ασφαλτικά υλικά",
		7=>"4.7.Κεραμικά/Με βάση τσιμέντο",
		8=>"4.8.Συνθετικά (πλαστικά) πλακίδια",
		9=>"4.9.Πλάκες πεζοδρομίου"
	);
	$subcategory5_array=array(
		1=>"5.1.Πλαστικά",
		2=>"5.2.Ρητίνες",
		3=>"5.3.Σιλικόνες"
	);
	$subcategory6_array=array(
		1=>"6.1.Βερνίκια",
		2=>"6.2.Βαφές"
	);
	$subcategory7_array=array(
		1=>"7.1.Ινώδη ανόργανα υλικά",
		2=>"7.2.Ανόργανα υλικά κυψελωτής δομής",
		3=>"7.3.Συνθετικά υλικά κυψελωτής δομής",
		4=>"7.4.Υλικά φυτικής και ζωικής προέλευσης"
	);
	$subcategory8_array=array(
		1=>"8.1.Αέρια"
	);
	$subcategory9_array=array(
		1=>"9.1.Νερό στην υγρή φάση",
		2=>"9.2.Νερό στην στερεά φάση"
	);
	
	$count = count($tb_data);
	$total_pages = ceil($count/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count<$count_end){$count_end=$count;}
	$new_page=ceil(($count+1)/10);
	
	$txt = "<div class=\"box panel-info\">";
	$txt .= "<div class=\"box-header\"> Πίνακας 2 - ΤΟΤΕΕ-20701-2: Δομικά υλικά (τυπικές τιμές) </div>";
	$txt .= "<div class=\"box-body table-responsive no-padding\">";
	$txt .= "<table class=\"table table-bordered table-hover table-condensed\">
	<tr class=\"info\">
	<td width=10%>α/α</td>
	<td width=10%>Κατηγορία</td>
	<td width=10%>Υποκατηγορία</td>
	<td width=10%>Ονομασία</td>
	<td width=10%>ρ</td>
	<td width=10%>λ</td>
	<td width=10%>cp</td>
	<td width=10%>μ (ξηρό)</td>
	<td width=10%>μ (υγρό)</td>
	</tr>";
	
	$i=1;
	foreach($tb_data as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$txt .= "<tr>";
		$txt .= "<td><span class=\"label label-info\">".$i."</span></td>";
		$txt .= "<td>".$category_array[$data["category"]]."</td>";
		$txt .= "<td>".${"subcategory".$data["category"]."_array"}[$data["subcategory"]]."</td>";
		$txt .= "<td>".$data["material"]."</td>";		
		$txt .= "<td>".$data["r"]."</td>";
		$txt .= "<td bgcolor=\"#eeeeee\">".$data["l"]."</td>";
		$txt .= "<td>".$data["cp"]."</td>";
		$txt .= "<td>".$data["m_dry"]."</td>";
		$txt .= "<td>".$data["m_liquid"]."</td>";
		$txt .= "</tr>";
		}
	$i++;
	}
	$txt .= "</table></div><div class=\"box-footer clearfix no-border\">";
	
	if($count!=0){
		$txt .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count." υλικών χρήστη.";
	}else{
		$txt .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	//PAGINATION
	$txt .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_materials(".$previous_page.")\"";}
	$txt .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
	if($total_pages<=10){
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_materials(".$j.")\">".$j."</a></li>";
		}
	}else{
		if($page>3){
			$txt .= "<li><a href=\"#\" onclick=\"get_materials(1)\">1</a></li>";
			$txt .= "<li class=\"disabled\"><a href=\"#\">...</a></li>";
		}
		for($j=$page-2; $j<=$page+2; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			if($j>0 AND $j<=$total_pages){
				$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_materials(".$j.")\">".$j."</a></li>";
			}
		}
		if($page<$total_pages-3){
			$txt .= "<li class=\"disabled\"><a href=\"#\">...</a></li>";
			$txt .= "<li><a href=\"#\" onclick=\"get_materials(".$total_pages.")\">".$total_pages."</a></li>";
		}
	}
		
	if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_materials(".$next_page.")\"";}
	$txt .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$txt .= "</ul></div>";
	//PAGINATION
	
	$txt .= "</div>";
	
	return $txt;	
}

//Εκτύπωση αντλιών θερμότητας εξοικονομώ
function create_library_heatpumpsex($manufacturer="",$outdoor="",$page=1,$like=""){
	
	$database = new medoo(DB_NAME);
	$tb = "vivliothiki_exoikonomw_heatpumps";
	$col = "*";
	
	if($manufacturer=="" AND $outdoor=="" AND $like==""){
		$tb_data = $database->select($tb,$col);
	}
	if($manufacturer!="" OR $outdoor!="" OR $like!=""){
		if($manufacturer=="" AND $outdoor=="" AND $like!=""){
			$where=array("LIKE"=>array("name"=>$like));
		}
		if($manufacturer=="" AND $outdoor!="" AND $like!=""){
			$where=array("LIKE"=>array("AND"=>array("name"=>$like,"outdoor"=>$outdoor)) );
		}
		if($manufacturer!="" AND $outdoor=="" AND $like!=""){
			$where=array("LIKE"=>array("AND"=>array("name"=>$like,"company"=>$manufacturer)) );
		}
		if($manufacturer!="" AND $outdoor!="" AND $like!=""){
			$where=array("LIKE"=>array("AND"=>array("name"=>$like,"company"=>$manufacturer,"outdoor"=>$outdoor)) );
		}
		if($manufacturer!="" AND $outdoor=="" AND $like==""){
			$where=array("company"=>$manufacturer);
		}
		if($manufacturer=="" AND $outdoor!="" AND $like==""){
			$where=array("LIKE"=>array("outdoor"=>$outdoor));
		}
		if($manufacturer!="" AND $outdoor!="" AND $like==""){
			$where=array("LIKE"=>array("AND"=>array("company"=>$manufacturer,"outdoor"=>$outdoor)) );
		}
		$tb_data = $database->select($tb,$col,$where);
	}
	
	$count = count($tb_data);
	$total_pages = ceil($count/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count<$count_end){$count_end=$count;}
	$new_page=ceil(($count+1)/10);
	
	$txt = "<div class=\"box panel-info\">";
	$txt .= "<div class=\"box-header\"> Επιλέξιμες αντλίες θερμότητας (Εξοικονομώ) </div>";
	$txt .= "<div class=\"box-body table-responsive no-padding\">";
	$txt .= "<table class=\"table table-bordered table-hover table-condensed\">
	<tr class=\"info\">
	<td width=10%>α/α</td>
	<td width=10%>Εταιρία</td>
	<td width=10%>Καύσιμο</td>
	<td width=10%>Ονομασία</td>
	<td width=10%>Εξωτερική μονάδα</td>
	<td width=10%>Εσωτερική μονάδα</td>
	<td width=10%>Τεχνολογία</td>
	<td width=10%>COP 35<sup>0</sup>C</td>
	<td width=10%>COP 45<sup>0</sup>C</td>
	</tr>";
	
	$i=1;
	foreach($tb_data as $data){
		if($i<=$page*10 AND $i>$page*10-10){
		$txt .= "<tr>";
		$txt .= "<td><span class=\"label label-info\">".$i."</span></td>";
		$txt .= "<td>".$data["company"]."</td>";
		$txt .= "<td>".$data["fuel"]."</td>";
		$txt .= "<td>".$data["name"]."</td>";	
		$txt .= "<td>".$data["outdoor"]."</td>";
		$txt .= "<td>".$data["indoor"]."</td>";
		$txt .= "<td>".$data["tech"]."</td>";
		$txt .= "<td>".$data["cop35"]."</td>";
		$txt .= "<td>".$data["cop45"]."</td>";
		$txt .= "</tr>";
		}
	$i++;
	}
	$txt .= "</table></div><div class=\"box-footer clearfix no-border\">";
	
	if($count!=0){
		$txt .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count." αποτελεσμάτων.";
	}else{
		$txt .= "Δεν βρέθηκαν αποτελέσματα.";
	}
	
	//PAGINATION
	$txt .= "<ul class=\"pagination pagination-sm pull-right\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_heatpumps_ex(".$previous_page.")\"";}
	$txt .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
	if($total_pages<=10){
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_heatpumps_ex(".$j.")\">".$j."</a></li>";
		}
	}else{
		if($page>3){
			$txt .= "<li><a href=\"#\" onclick=\"get_heatpumps_ex(1)\">1</a></li>";
			$txt .= "<li class=\"disabled\"><a href=\"#\">...</a></li>";
		}
		for($j=$page-2; $j<=$page+2; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			if($j>0 AND $j<=$total_pages){
				$txt .= "<li".$disabled."><a href=\"#\" onclick=\"get_heatpumps_ex(".$j.")\">".$j."</a></li>";
			}
		}
		if($page<$total_pages-3){
			$txt .= "<li class=\"disabled\"><a href=\"#\">...</a></li>";
			$txt .= "<li><a href=\"#\" onclick=\"get_heatpumps_ex(".$total_pages.")\">".$total_pages."</a></li>";
		}
	}
		
	if($page==$total_pages OR $total_pages==0){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_heatpumps_ex(".$next_page.")\"";}
	$txt .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$txt .= "</ul></div>";
	//PAGINATION
	
	$txt .= "</div>";
	
	return $txt;	
}


//Εκτύπωση νομοθεσίας
function create_library_laws($type=0,$page=1,$like=""){
	
	$database = new medoo(DB_NAME);
	$tb = "vivliothiki_laws";
	$col = "*";
	
	
	if($type==0 AND $like!=""){
		$where=array("LIKE"=>array("name"=>$like));
		$data_laws = $database->select($tb,$col,$where);
	}
	if($type!=0 AND $like==""){
		$where=array("type"=>$type);		
		$data_laws = $database->select($tb,$col,$where);
	}
	if($type!=0 AND $like!=""){
		$where=array("LIKE"=>array("AND"=>array("name"=>$like,"type"=>$type)) );
		$data_laws = $database->select($tb,$col,$where);
	}
	if($like=="" AND $type==0){
		$data_laws = $database->select($tb,$col);
	}
	
	$count_laws = count($data_laws);
	$total_pages = ceil($count_laws/10);
	$count_start = $page*10-9;
	$count_end = $page*10;
	$previous_page=$page-1;
	$next_page=$page+1;
		if($page==$total_pages AND $count_laws<$count_end){$count_end=$count_laws;}
	
	
	$laws = "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$laws .= "<tr><th width=\"5%\">α/α</th><th>Τύπος</th><th>Όνομα (σύνδεσμος)</th><th>Περιγραφή</th></tr>";
	
		$i=1;
		foreach($data_laws as $data){
			if($i<=$page*10 AND $i>$page*10-10){
			$laws .= "<tr>";
			$laws .= "<td>".$i."</td>";
			
				if($data["type"]==1){$type="Νομοθεσία";}
				if($data["type"]==2){$type="ΤΟΤΕΕ";}
				if($data["type"]==3){$type="Πρότυπο";}
				if($data["type"]==4){$type="Σύνδεσμος";}

			$laws .= "<td>".$type."</td>";
				if($data["link"]==""){
				$laws .= "<td>".$data["name"]."</td>";
				}else{
				$laws .= "<td><a href=\"".$data["link"]."\" target=\"_blank\">".$data["name"]."</a></td>";
				}
			$laws .= "<td>".$data["perigrafi"]."</td>";
			$laws .= "</tr>";
			
			}$i++;
		}
		
	$laws .= "</table>";
	$laws .= "Αποτελέσματα από ".$count_start." έως ".$count_end." σε σύνολο ".$count_laws." αποτελεσμάτων.";
	
	$laws .= "<div class=\"text-center\"><ul class=\"pagination pagination-sm\">";
		if($page==1){$disabled_prev=" class=\"disabled\"";$onclick="";}else{$disabled_prev="";$onclick="\"get_laws(".$previous_page.")\"";}
	$laws .= "<li".$disabled_prev."><a href=\"#\" onclick=".$onclick.">Προηγούμενο</a></li>";
	
		for($j=1; $j<=$total_pages; $j++){
			if($page==$j){$disabled=" class=\"active\"";}else{$disabled="";}
			$laws .= "<li".$disabled."><a href=\"#\" onclick=\"get_laws(".$j.")\">".$j."</a></li>";
		}
		
		if($page==$total_pages){$disabled_next=" class=\"disabled\"";$onclick="";}else{$disabled_next="";$onclick="\"get_laws(".$next_page.")\"";}
	$laws .= "<li".$disabled_next."><a href=\"#\" onclick=".$onclick.">Επόμενο</a></li>";		
	$laws .= "</ul></div>";
	
	return $laws;
}

//ΣΥΝΘΗΚΕΣ ΛΕΙΤΟΥΡΓΙΑΣ
//Κατασκευή πίνακα συνθηκών λειτουργίας
function create_library_synthikes($gen_xrisi=0,$type=1){
	
	$database = new medoo(DB_NAME);
	$table = "vivliothiki_conditions_zone";
	$columns = "*";
	
	if($gen_xrisi!=0){
		$where=array("gen_id"=>$gen_xrisi);
		$data_table = $database->select($table,$columns,$where);
	}else{
	$data_table = $database->select($table,$columns);
	}
	
	$znx_calc_type=array(
		0=>"Δομημένη επιφάνεια",
		1=>"Υπνοδωμάτια/Κλίνες",
		2=>"Κατηγορία ξενοδοχείου",
		3=>"Κατηγορία νοσοκομείου",
	);
	$synthikes = "";
	
	$synthikes .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$synthikes .= "<tr>
	<th width=\"5%\">α/α</th>
	<th>Κατηγορία</th>
	<th>Χρήση ζώνης</th>";
	if($type==1){
		$synthikes .= "<th>Ώρες λειτ. (h)</th>
		<th>Ημέρες λειτ. (d)</th>
		<th>Μήνες λειτ. (m)</th>";
	}
	if($type==2){
		$synthikes .= "<th>θ,i,h (<sup>o</sup>C)</th>
		<th>θ,i,c (<sup>o</sup>C)</th>
		<th>X,i,h (<sup>o</sup>C)</th>
		<th>X,i,c (<sup>o</sup>C)</th>";
	}
	if($type==3){
		$synthikes .= "<th>Άτομα / 100 m<sup>2</sup></th>
		<th>Νωπός αέρας (m<sup>3</sup> / h / person)</th>
		<th>Νωπός αέρας (m<sup>3</sup> / h / m2)</th>";
	}
	if($type==4){
		$synthikes .= "<th>Στάθμη φωτισμού (lx)</th>
		<th>Επίπεδο αναφοράς μέτρησης (m)</th>
		<th>Δείκτης θάμβωσης UGR</th>
		<th>Ομοιομορφία φωτισμού U<sub>o</sub> (min/μέση τιμή)</th>";
	}
	if($type==5){
		$synthikes .= "<th>ΖΝΧ</th>
		<th>Τρόπος υπολογισμού*</th>
		<th>ΖΝΧ (lt/άτομο/ημέρα)</th>
		<th>ΖΝΧ (lt/m<sup>2</sup>/ημέρα)</th>
		<th>ΖΝΧ (m<sup>3</sup>/κλίνη/έτος)</th>
		<th>ΖΝΧ (m<sup>3</sup>/m<sup>2</sup>/έτος)</th>";
	}
	if($type==6){
		$synthikes .= "<th>Θερμική ισχύς ανά άτομο (W/άτομο)</th>
		<th>Θερμική ισχύς ανά μονάδα δομημένης επιφάνειας (W/m<sup>2</sup>)</th>
		<th>Μέσος συντελεστής παρουσίας</th>";
	}
	if($type==7){
		$synthikes .= "<th>Ισχύς εξοπλισμού (W/m<sup>2</sup>)</th>
	<th>Μέσος συντελεστής ετεροχρονισμού</th>
	<th>Ετεροχρον ισχύς εξοπλισμού (W/m<sup>2</sup>)</th>
	<th>Μέσος συντελεστής λειτουργίας</th>";
	}
	$synthikes .= "</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$synthikes .= "<tr>";
		$synthikes .= "<td>".$i."</td>";
			$data_gen = $database->select("vivliothiki_conditions_general","name",array("id"=>$data["gen_id"]));
		$synthikes .= "<td>".$data_gen[0]."</td>";
		$synthikes .= "<td>".$data["name"]."</td>";
		if($type==1){
			$synthikes .= "<td>".$data["t_h"]."</td>";
			$synthikes .= "<td>".$data["t_d"]."</td>";
			$synthikes .= "<td>".$data["t_m"]."</td>";
		}
		if($type==2){
			$synthikes .= "<td>".$data["ti_h"]."</td>";
			$synthikes .= "<td>".$data["ti_c"]."</td>";
			$synthikes .= "<td>".$data["xi_h"]."</td>";
			$synthikes .= "<td>".$data["xi_c"]."</td>";
		}
		if($type==3){
			$synthikes .= "<td>".$data["air_persons"]."</td>";
			$synthikes .= "<td>".$data["air_perperson"]."</td>";
			$synthikes .= "<td>".$data["air_perm2"]."</td>";
		}
		if($type==4){
			$synthikes .= "<td>".$data["light_lux"]."</td>";
			$synthikes .= "<td>".$data["light_height"]."</td>";
			$synthikes .= "<td>".$data["light_ugr"]."</td>";
			$synthikes .= "<td>".$data["light_uo"]."</td>";
		}
		if($type==5){
			if($data["has_znx"]==1){
				$synthikes .= "<td><i class=\"fa fa-check-square-o text-success\" aria-hidden=\"true\"></i></td>";
			}else{
				$synthikes .= "<td><i class=\"fa fa-square-o text-danger\" aria-hidden=\"true\"></i></td>";
			}
			$synthikes .= "<td>".$znx_calc_type[$data["znx_calc_type"]]."</td>";
			$synthikes .= "<td>".$data["znx_lt_perperson"]."</td>";
			$synthikes .= "<td>".$data["znx_lt_perm2"]."</td>";
			$synthikes .= "<td>".$data["znx_m3_perroom"]."</td>";
			$synthikes .= "<td>".$data["znx_m3_perm2"]."</td>";
		}
		if($type==6){
			$synthikes .= "<td>".$data["w_perperson"]."</td>";
			$synthikes .= "<td>".$data["w_perm2"]."</td>";
			$synthikes .= "<td>".$data["w_f"]."</td>";
		}
		if($type==7){
			$synthikes .= "<td>".$data["eq_w_perrm2"]."</td>";
			$synthikes .= "<td>".$data["eq_ft"]."</td>";
			$synthikes .= "<td>".$data["eq_wt_perm2"]."</td>";
			$synthikes .= "<td>".$data["eq_f"]."</td>";
		}
		$synthikes .= "</tr>";
		$i++;
		}
	$synthikes .= "</table>";
	
	if($type==4){
		$synthikes .= "<br/>".create_library_lightzones();
	}
	if($type==5 AND $gen_xrisi==2){
		$synthikes .= "<br/>".create_library_znxhotels();
	}
	if($type==5 AND $gen_xrisi==5){
		$synthikes .= "<br/>".create_library_znxhospitals();
	}
	
	return $synthikes;
}

//Δημιουργία πίνακα 2.4.α - Στάθμες φωτισμού
function create_library_lightzones(){
	$database = new medoo(DB_NAME);
	$table="vivliothiki_conditions_lightzones";
	$columns = "*";
	$data_table = $database->select($table,$columns);	
	
	$array_color = array(
		1=>"#e9a3a3",
		2=>"#ebacac",
		3=>"#edb5b5",
		4=>"#efbebe",
		5=>"#f1c7c7",
		6=>"#f4d1d1",
		7=>"#f6dada",
	);
	
	$txt = "<div class=\"box\">";
	$txt .= "<div class=\"box-header\">Πίνακας 2.4.α Εγκατεστημένη ισχύς φωτισμού  (W/m<sup>2</sup>) κτιρίου αναφοράς ανάλογα της στάθμης φωτισμού για τον υπολογισμό της ενεργειακής του απόδοσης.</div>";
	$txt .= "<div class=\"box-body table-responsive no-padding\">";
	$txt .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$txt .= "<tr bgcolor=\"#d19292\">
	<th width=\"5%\">α/α</th>
	<th>Ζώνη τεχνητού φωτισμού / Στάθμη φωτισμού (lx)</th>
	<th>Ισχύς για κτίριο αναφοράς (W/m<sup>2</sup>)</th>
	<th>Ισχύς για ελάχιστες απαιτήσεις ενεργειακής απόδοσης κτιρίων (W/m<sup>2</sup>)</th>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$txt .= "<tr bgcolor=\"".$array_color[$i]."\">";
		$txt .= "<td>".$i."</td>";
		$txt .= "<td>".$data["zone_lux"]."</td>";
		$txt .= "<td>".$data["ka_watt"]."</td>";
		$txt .= "<td>".$data["watt"]."</td>";
		$txt .= "</tr>";
		$i++;
		}
	$txt .= "</table>";
	$txt .= "</div>";//box-body
	$txt .= "</div>";//box
	
	return $txt;
}

//ΚΥΑ 14826-2008 ΠΑΡΑΡΤΗΜΑ 1
function create_library_lightplaces(){
	$database = new medoo(DB_NAME);
	$table="vivliothiki_lightplaces";
	$columns = "*";
	$data_table = $database->select($table,$columns);	
	
	$txt = "<div class=\"box\">";
	$txt .= "<div class=\"box-header\">ΚΥΑ 14826-2008 ΠΑΡΑΡΤΗΜΑ Ι - Επίπεδα φωτισμού χώρων κτιρίου σύμφωνα με το πρότυπο ΕΝ 12464-1</div>";
	$txt .= "<div class=\"box-body table-responsive no-padding\">";
	$txt .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$txt .= "<tr bgcolor=\"#d19292\">
	<th width=\"5%\">α/α</th>
	<th>Κατηγορία χώρου</th>
	<th>Χώρος</th>
	<th>Lux</th>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$txt .= "<tr>";
		$txt .= "<td>".$i."</td>";
		$txt .= "<td>".$data["category"]."</td>";
		$txt .= "<td>".$data["name"]."</td>";
		$txt .= "<td>".$data["lux"]."</td>";
		$txt .= "</tr>";
		$i++;
		}
	$txt .= "</table>";
	$txt .= "</div>";//box-body
	$txt .= "</div>";//box
	
	return $txt;
}

//Δημιουργία πίνακα 2.5 - Ξενοδοχεία
function create_library_znxhospitals(){
	$database = new medoo(DB_NAME);
	$table="vivliothiki_conditions_znx_hospitals";
	$columns = "*";
	$data_table = $database->select($table,$columns);	
	
	$array_color=array(
		1=>"#e2e2bf",
		2=>"#ededd8",
		3=>"#f9f9f2"
	);
	
	$txt = "<div class=\"box\">";
	$txt .= "<div class=\"box-header\">Πίνακας 2.5 Τυπική κατανάλωση ζεστού νερού χρήσης (σε θερμοκρασίες 45<sup>ο</sup>C) ανά χρήση κτιρίου για τον υπολογισμό της κατανάλωσης ενέργειας (Νοσοκομεία-Κλινικές).</div>";
	$txt .= "<div class=\"box-body table-responsive no-padding\">";
	$txt .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$txt .= "<tr bgcolor=\"#d6d6a5\">
	<th width=\"5%\">α/α</th>
	<th>Κατηγορία</th>
	<th>lt/άτομο/ημέρα</th>
	<th>lt/m<sup>2</sup>/ημέρα</th>
	<th>m<sup>3</sup>/κλίνη/έτος</th>
	<th>m<sup>3</sup>/m<sup>2</sup>/έτος</th>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$txt .= "<tr bgcolor=\"".$array_color[$i]."\">";
		$txt .= "<td>".$i."</td>";
		$txt .= "<td>".$data["name"]."</td>";
		$txt .= "<td>".$data["znx_lt_perperson"]."</td>";
		$txt .= "<td>".$data["znx_lt_perm2"]."</td>";
		$txt .= "<td>".$data["znx_m3_perroom"]."</td>";
		$txt .= "<td>".$data["znx_m3_perm2"]."</td>";
		$txt .= "</tr>";
		$i++;
		}
	$txt .= "</table>";
	$txt .= "</div>";//box-body
	$txt .= "</div>";//box
	
	return $txt;
}

//Δημιουργία πίνακα 2.5 - Ξενοδοχεία
function create_library_znxhotels(){
	$database = new medoo(DB_NAME);
	$table="vivliothiki_conditions_znx_hotels";
	$columns = "*";
	$data_table = $database->select($table,$columns);	
	
	$array_hotel = array(
		1=>"Ξενοδοχείο ετήσιας λειτουργίας",
		2=>"Ξενοδοχείο θερινής λειτουργίας",
		3=>"Ξενοδοχείο χειμερινής λειτουργίας"
	);
	$array_category = array(
		1=>"LUX",
		2=>"Α ή Β",
		3=>"Γ"
	);
	
	$array_color=array(
		1=>"#b2b2dc",
		2=>"#cbcbe7",
		3=>"#e5e5f3"
	);
	
	
	$txt = "<div class=\"box\">";
	$txt .= "<div class=\"box-header\">Πίνακας 2.5 Τυπική κατανάλωση ζεστού νερού χρήσης (σε θερμοκρασίες 45<sup>ο</sup>C) ανά χρήση κτιρίου για τον υπολογισμό της κατανάλωσης ενέργειας (Ξενοδοχεία - Κατάταξη).</div>";
	$txt .= "<div class=\"box-body table-responsive no-padding\">";
	$txt .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$txt .= "<tr bgcolor=\"#9898d0\">
	<th width=\"5%\">α/α</th>
	<th>Χρήσεις ξενοδοχείων</th>
	<th>Κατηγορία ξενοδοχείου</th>
	<th>lt/άτομο/ημέρα</th>
	<th>lt/m<sup>2</sup>/ημέρα</th>
	<th>m<sup>3</sup>/κλίνη/έτος</th>
	<th>m<sup>3</sup>/m<sup>2</sup>/έτος</th>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$txt .= "<tr bgcolor=\"".$array_color[$data["hotel_type"]]."\">";
		$txt .= "<td>".$i."</td>";
		$txt .= "<td>".$array_hotel[$data["hotel_type"]]."</td>";
		$txt .= "<td>".$array_category[$data["category"]]."</td>";
		$txt .= "<td>".$data["znx_lt_perperson"]."</td>";
		$txt .= "<td>".$data["znx_lt_perm2"]."</td>";
		$txt .= "<td>".$data["znx_m3_perroom"]."</td>";
		$txt .= "<td>".$data["znx_m3_perm2"]."</td>";
		$txt .= "</tr>";
		$i++;
		}
	$txt .= "</table>";
	$txt .= "</div>";//box-body
	$txt .= "</div>";//box
	
	return $txt;
}

//ΒΙΒΛΙΟΘΗΚΕΣ - U
//Κατασκευή πίνακα vivliothiki_umax
function create_library_umax($category){
	
	$database = new medoo(DB_NAME);
	$columns = "*";
	
	if($category==1){
		$table="vivliothiki_umax_new";
		$header="Πίνακας 3.3.α. Μέγιστες επιτρεπόμενες τιμές του συντελεστή θερμοπερατότητας των επί μέρους δομικών 
		στοιχείων ανά κλιματική ζώνη σε περίπτωση ανέγερσης νέου κτηρίου.";
	}
	if($category==2){
		$table="vivliothiki_umax_old";
		$header="Πίνακας 3.4.α. Μέγιστες επιτρεπόμενες τιμές του συντελεστή θερμοπερατότητας των επί μέρους δομικών 
		στοιχείων ανά κλιματική ζώνη σε περίπτωση ριζικής ανακαίνισης υφιστάμενου κτηρίου.";
	}
	
	$array_type = array(
		1=>"Οροφή",
		2=>"Τοίχος",
		3=>"Δάπεδο",
		4=>"Κούφωμα",
		5=>"Γ. πρόσοψη",
	);
	$array_epafi = array(
		1=>"Αέρας",
		2=>"Έδαφος",
		3=>"ΜΘΧ",
	);
	
	$data_table = $database->select($table,$columns);	
	
	$domika41 = "<div class=\"box\">";
	$domika41 .= "<div class=\"box-header\">".$header."</div>";
	$domika41 .= "<div class=\"box-body table-responsive no-padding\">";
	$domika41 .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$domika41 .= "<tr>
	<th width=\"5%\">α/α</th>
	<th>Τύπος στοιχείου</th>
	<th>Σύμβολο</th>
	<th>Επαφή</th>
	<th>Τύπος</th>
	<th>Ζώνη Α</th>
	<th>Ζώνη Β</th>
	<th>Ζώνη Γ</th>
	<th>Ζώνη Δ</th>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$domika41 .= "<tr>";
		$domika41 .= "<td>".$i."</td>";
		$domika41 .= "<td>".$data["stoixeio"]."</td>";
		$domika41 .= "<td>".$data["symbol"]."</td>";
		$domika41 .= "<td>".$array_epafi[$data["epafi"]]."</td>";
		$domika41 .= "<td>".$array_type[$data["type"]]."</td>";
		$domika41 .= "<td>".$data["a"]."</td>";
		$domika41 .= "<td>".$data["b"]."</td>";
		$domika41 .= "<td>".$data["g"]."</td>";
		$domika41 .= "<td>".$data["d"]."</td>";
		$domika41 .= "</tr>";
		$i++;
		}
	$domika41 .= "</table>";
	$domika41 .= "</div>";//box-body
	$domika41 .= "<div class=\"box-footer\"><span class=\"no-margin pull-right\">TOTEE-20701 (Κεφ.4.2)</span></div>";//box-footer
	$domika41 .= "</div>";//box
	
	return $domika41;
}

//Κατασκευή πίνακα vivliothiki_ummax
function create_library_ummax($category){
	
	$database = new medoo(DB_NAME);
	$columns = "*";
	if($category==1){
		$table="vivliothiki_ummax_new";
		$header="Πίνακας 3.3.β. Μέγιστες επιτρεπόμενες τιμές του μέσου συντελεστή θερμοπερατότητας ενός κτηρίου ανά 
		κλιματική ζώνη συναρτήσει του λόγου της περιβάλλουσας επιφάνειας του κτηρίου προς τον όγκο 
		του σε περίπτωση ανέγερσης νέου κτηρίου.";
	}
	if($category==2){
		$table="vivliothiki_ummax_old";
		$header="Πίνακας 3.4.β. Μέγιστες επιτρεπόμενες τιμές του μέσου συντελεστή θερμοπερατότητας ενός κτηρίου ανά 
		κλιματική ζώνη συναρτήσει του λόγου της περιβάλλουσας επιφάνειας του κτηρίου προς τον όγκο 
		του σε περίπτωση ριζικής ανακαίνισης υφιστάμενου κτηρίου.";
	}
	
	$data_table = $database->select($table,$columns);	
	
	$eparkeia_u = "<div class=\"box\">";
	$eparkeia_u .= "<div class=\"box-header\">".$header."</div>";
	$eparkeia_u .= "<div class=\"box-body table-responsive no-padding\">";
	$eparkeia_u .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$eparkeia_u .= "<tr>
	<th width=\"5%\">α/α</th>
	<th>A/V</th>
	<th>Ζώνη Α</th>
	<th>Ζώνη Β</th>
	<th>Ζώνη Γ</th>
	<th>Ζώνη Δ</th>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$eparkeia_u .= "<tr>";
		$eparkeia_u .= "<td>".$i."</td>";
		$eparkeia_u .= "<td>".$data["a_pros_v"]."</td>";
		$eparkeia_u .= "<td>".$data["a"]."</td>";
		$eparkeia_u .= "<td>".$data["b"]."</td>";
		$eparkeia_u .= "<td>".$data["g"]."</td>";
		$eparkeia_u .= "<td>".$data["d"]."</td>";
		$eparkeia_u .= "</tr>";
		$i++;
		}
	$eparkeia_u .= "</table>";
	$eparkeia_u .= "</div>";//box-body
	$eparkeia_u .= "<div class=\"box-footer\"><span class=\"no-margin pull-right\">TOTEE-20701 (Κεφ.4.2)</span></div>";//box-footer
	$eparkeia_u .= "</div>";//box
	
	return $eparkeia_u;
}

//Κατασκευή πίνακα vivliothiki_umax_kthk
function create_library_umax_kthk(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_umax_kthk";
	$columns = "*";
	
	$data_table = $database->select($table,$columns);	
	
	$kthk = "<div class=\"box\">";
	$kthk .= "<div class=\"box-header\">Πίνακας 3.6 (TOTEE-20701-1). Μέγιστες επιτρεπόμενος συντελεστής θερμοπερατότητας δομικών στοιχείων σύμφωνα με τον Κανονισμό 
			Θερμομόνωσης Κτιρίων (1980) για τις τρεις κλιματικές ζώνες στην Ελλάδα.</div>";
	$kthk .= "<div class=\"box-body table-responsive no-padding\">";
	$kthk .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$kthk .= "<tr>
	<th width=\"5%\">α/α</th>
	<th>Δομικό στοιχείο</th>
	<th>Ζώνη Α</th>
	<th>Ζώνη Β</th>
	<th>Ζώνη Γ</th>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$kthk .= "<tr>";
		$kthk .= "<td>".$i."</td>";
		$kthk .= "<td>".$data["stoixeio"]."</td>";
		$kthk .= "<td>".$data["a"]."</td>";
		$kthk .= "<td>".$data["b"]."</td>";
		$kthk .= "<td>".$data["g"]."</td>";
		$kthk .= "</tr>";
		$i++;
		}
	$kthk .= "</table>";
	$kthk .= "</div>";//box-body
	$kthk .= "<div class=\"box-footer\"><span class=\"no-margin pull-right\">TOTEE-20701 (Κεφ.4.2.2)</span></div>";//box-footer
	$kthk .= "</div>";//box
	
	return $kthk;
}

//Κατασκευή πίνακα ισοδύναμων
function create_library_domika9a(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_domika9a";
	$columns = "*";
	
	$data_table = $database->select($table,$columns);	
	
	$domika9a = "<div class=\"box\">";
	$domika9a .= "<div class=\"box-header\">Πίνακας 8α. Ισοδύναμος συντελεστής θερμοπερατότητας οριζόντιου δομικού στοιχείου σε επαφή με το έδαφος.</div>";
	$domika9a .= "<div class=\"box-body table-responsive no-padding\">";
	$domika9a .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$domika9a .= "<tr>
	<th width=\"5%\">α/α</th>
	<th>Ονομαστικός (Ufb)</th>
	<th>Βάθος έδρασης (z)</th>
	<th>2</th>
	<th>3</th>
	<th>4</th>
	<th>5</th>
	<th>6</th>
	<th>7</th>
	<th>8</th>
	<th>9</th>
	<th>10</th>
	<th>12</th>
	<th>14</th>
	<th>18</th>
	<th>22</th>
	<th>26</th>
	<th>30</th>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$domika9a .= "<tr>";
		$domika9a .= "<td>".$i."</td>";
		$domika9a .= "<td>".$data["Ufb"]."</td>";
		$domika9a .= "<td>".$data["z"]."</td>";
		$domika9a .= "<td>".$data["2"]."</td>";
		$domika9a .= "<td>".$data["3"]."</td>";
		$domika9a .= "<td>".$data["4"]."</td>";
		$domika9a .= "<td>".$data["5"]."</td>";
		$domika9a .= "<td>".$data["6"]."</td>";
		$domika9a .= "<td>".$data["7"]."</td>";
		$domika9a .= "<td>".$data["8"]."</td>";
		$domika9a .= "<td>".$data["9"]."</td>";
		$domika9a .= "<td>".$data["10"]."</td>";
		$domika9a .= "<td>".$data["12"]."</td>";
		$domika9a .= "<td>".$data["14"]."</td>";
		$domika9a .= "<td>".$data["18"]."</td>";
		$domika9a .= "<td>".$data["22"]."</td>";
		$domika9a .= "<td>".$data["26"]."</td>";
		$domika9a .= "<td>".$data["30"]."</td>";
		$domika9a .= "</tr>";
		$i++;
		}
	$domika9a .= "</table>";
	$domika9a .= "</div>";//box-body
	$domika9a .= "</div>";//box
	
	return $domika9a;
}

//Κατασκευή πίνακα ισοδύναμων
function create_library_domika9b(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_domika9b";
	$columns = "*";
	
	$data_table = $database->select($table,$columns);	
	
	$domika9b = "<div class=\"box\">";
	$domika9b .= "<div class=\"box-header\">Πίνακας 8β. Ισοδύναμος συντελεστής θερμοπερατότητας UTB' (W-(m2·K)) ενός κατακόρυφου δομικού στοιχείου.</div>";
	$domika9b .= "<div class=\"box-body table-responsive no-padding\">";
	$domika9b .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$domika9b .= "<tr>
	<th width=\"5%\">α/α</th>
	<th>Βάθος έδρασης (z)</th>
	<th>Utb=4.50</th>
	<th>Utb=3.00</th>
	<th>Utb=2.00</th>
	<th>Utb=1.50</th>
	<th>Utb=1.00</th>
	<th>Utb=0.90</th>
	<th>Utb=0.80</th>
	<th>Utb=0.70</th>
	<th>Utb=0.60</th>
	<th>Utb=0.50</th>
	<th>Utb=0.40</th>
	<th>Utb=0.30</th>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$domika9b .= "<tr>";
		$domika9b .= "<td>".$i."</td>";
		$domika9b .= "<td>".$data["z"]."</td>";
		$domika9b .= "<td>".$data["4.5"]."</td>";
		$domika9b .= "<td>".$data["3"]."</td>";
		$domika9b .= "<td>".$data["2"]."</td>";
		$domika9b .= "<td>".$data["1.5"]."</td>";
		$domika9b .= "<td>".$data["1"]."</td>";
		$domika9b .= "<td>".$data["0.9"]."</td>";
		$domika9b .= "<td>".$data["0.8"]."</td>";
		$domika9b .= "<td>".$data["0.7"]."</td>";
		$domika9b .= "<td>".$data["0.6"]."</td>";
		$domika9b .= "<td>".$data["0.5"]."</td>";
		$domika9b .= "<td>".$data["0.4"]."</td>";
		$domika9b .= "<td>".$data["0.3"]."</td>";
		$domika9b .= "</tr>";
		$i++;
		}
	$domika9b .= "</table>";
	$domika9b .= "</div>";//box-body
	$domika9b .= "</div>";//box
	
	return $domika9b;
}

//Κατασκευή U τυπικών παραθύρων χωρίς εξώφυλλα
function create_library_diafani_uw(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_diafani_uw";
	$columns = "*";
	
	$data_table = $database->select($table,$columns);	
	
	$diafaniu = "<div class=\"box\">";
	$diafaniu .= "<div class=\"box-header\">Πίνακας 3.13.α. Τυπικές τιμές συντελεστή θερμοπερατότητας κουφωμάτων 
	U<sub>w</sub> [W/(m<sup>2</sup>.K)] χωρίς εξωτερικά προστατευτικά φύλλα.</div>";
	$diafaniu .= "<div class=\"box-body table-responsive no-padding\">";
	$diafaniu .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$diafaniu .= "<tr>
	<th width=\"5%\">α/α</th>";
	$diafaniu .= "<th>Τύπος πλαισίου</th>
	<th>% πλαισίου</th>
	<th>Πόρτα (εξ. αέρας)</th>
	<th>Πόρτα (ΜΘΧ)</th>
	<th>Υαλοπίνακας μονός</th>
	<th>Δίδυμος υαλοπίνακας με διάκενο αέρα 6mm</th>
	<th>Δίδυμος υαλοπίνακας με διάκενο αέρα 12mm</th>
	<th>Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 6mm</th>
	<th>Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 12mm</th>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$diafaniu .= "<tr>";
		$diafaniu .= "<td>".$i."</td>";
		$diafaniu .= "<td>".$data["type_f"]."</td>";
		$diafaniu .= "<td>".$data["percent_f"]."</td>";
		$diafaniu .= "<td>".$data["door"]."</td>";
		$diafaniu .= "<td>".$data["door_mthx"]."</td>";
		$diafaniu .= "<td>".$data["single_u"]."</td>";
		$diafaniu .= "<td>".$data["double6mm_u"]."</td>";
		$diafaniu .= "<td>".$data["double12mm_u"]."</td>";
		$diafaniu .= "<td>".$data["double6mm_lowe_u"]."</td>";
		$diafaniu .= "<td>".$data["double12mm_lowe_u"]."</td>";
		$diafaniu .= "</tr>";
		$i++;
		}
	$diafaniu .= "</table>";
	$diafaniu .= "</div>";//box-body
	$diafaniu .= "<div class=\"box-footer\"><span class=\"no-margin pull-right\">TOTEE-20701 (Κεφ.4.2.3.6)</span></div>";//box-footer
	$diafaniu .= "</div>";//box
	
	return $diafaniu;
}

//Κατασκευή U τυπικών παραθύρων με ρολλα
function create_library_diafani_uw_rola(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_diafani_uw_rola";
	$columns = "*";
	
	$data_table = $database->select($table,$columns);	
	
	$diafaniu = "<div class=\"box\">";
	$diafaniu .= "<div class=\"box-header\">Πίνακας 3.13.β. Τυπικές τιμές συντελεστή θερμοπερατότητας κουφωμάτων 
	U<sub>w</sub> [W/(m<sup>2</sup>.K)] με χρήση ρολών, ανεξαρτήτως της αεροστεγανότητας των ρολών.</div>";
	$diafaniu .= "<div class=\"box-body table-responsive no-padding\">";
	$diafaniu .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$diafaniu .= "<tr>
	<th width=\"5%\">α/α</th>";
	$diafaniu .= "<th>Τύπος πλαισίου</th>
	<th>% πλαισίου</th>
	<th>Υαλοπίνακας μονός</th>
	<th>Δίδυμος υαλοπίνακας με διάκενο αέρα 6mm</th>
	<th>Δίδυμος υαλοπίνακας με διάκενο αέρα 12mm</th>
	<th>Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 6mm</th>
	<th>Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 12mm</th>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$diafaniu .= "<tr>";
		$diafaniu .= "<td>".$i."</td>";
		$diafaniu .= "<td>".$data["type_f"]."</td>";
		$diafaniu .= "<td>".$data["percent_f"]."</td>";
		$diafaniu .= "<td>".$data["single_u"]."</td>";
		$diafaniu .= "<td>".$data["double6mm_u"]."</td>";
		$diafaniu .= "<td>".$data["double12mm_u"]."</td>";
		$diafaniu .= "<td>".$data["double6mm_lowe_u"]."</td>";
		$diafaniu .= "<td>".$data["double12mm_lowe_u"]."</td>";
		$diafaniu .= "</tr>";
		$i++;
		}
	$diafaniu .= "</table>";
	$diafaniu .= "</div>";//box-body
	$diafaniu .= "<div class=\"box-footer\"><span class=\"no-margin pull-right\">TOTEE-20701 (Κεφ.4.2.3.6)</span></div>";//box-footer
	$diafaniu .= "</div>";//box
	
	return $diafaniu;
}

//Κατασκευή U τυπικών παραθύρων με ρολλα
function create_library_diafani_uw_ekswfylla(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_diafani_uw_ekswfylla";
	$columns = "*";
	
	$data_table = $database->select($table,$columns);	
	
	$diafaniu = "<div class=\"box\">";
	$diafaniu .= "<div class=\"box-header\">Πίνακας 3.13.γ. Τυπικές τιμές συντελεστή θερμοπερατότητας κουφωμάτων 
	U<sub>w</sub> [W/(m<sup>2</sup>.K)] με χρήση εξωφύλλων, αδιαφόρως της αεροστεγανότητάς τους.</div>";
	$diafaniu .= "<div class=\"box-body table-responsive no-padding\">";
	$diafaniu .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$diafaniu .= "<tr>
	<th width=\"5%\">α/α</th>";
	$diafaniu .= "<th>Τύπος πλαισίου</th>
	<th>% πλαισίου</th>
	<th>Υαλοπίνακας μονός</th>
	<th>Δίδυμος υαλοπίνακας με διάκενο αέρα 6mm</th>
	<th>Δίδυμος υαλοπίνακας με διάκενο αέρα 12mm</th>
	<th>Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 6mm</th>
	<th>Δίδυμος υαλοπίνακας low-e με διάκενο αέρα 12mm</th>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$diafaniu .= "<tr>";
		$diafaniu .= "<td>".$i."</td>";
		$diafaniu .= "<td>".$data["type_f"]."</td>";
		$diafaniu .= "<td>".$data["percent_f"]."</td>";
		$diafaniu .= "<td>".$data["single_u"]."</td>";
		$diafaniu .= "<td>".$data["double6mm_u"]."</td>";
		$diafaniu .= "<td>".$data["double12mm_u"]."</td>";
		$diafaniu .= "<td>".$data["double6mm_lowe_u"]."</td>";
		$diafaniu .= "<td>".$data["double12mm_lowe_u"]."</td>";
		$diafaniu .= "</tr>";
		$i++;
		}
	$diafaniu .= "</table>";
	$diafaniu .= "</div>";//box-body
	$diafaniu .= "<div class=\"box-footer\"><span class=\"no-margin pull-right\">TOTEE-20701 (Κεφ.4.2.3.6)</span></div>";//box-footer
	$diafaniu .= "</div>";//box
	
	return $diafaniu;
}

//Κατασκευή gw τυπικών παραθύρων
function create_library_diafani_gw(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_diafani_gw";
	$columns = "*";
	
	$data_table = $database->select($table,$columns);
	
	$diafanig = "<div class=\"box\">";
	$diafanig .= "<div class=\"box-header\">Πίνακας 3.18. Τυπικές τιμές της συνολικής διαπερατότητας ηλιακής ακτινοβολίας κουφωμάτων</div>";
	$diafanig .= "<div class=\"box-body table-responsive no-padding\">";
	$diafanig .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$diafanig .= "<tr>
	<th width=\"5%\">α/α</th>";
	$diafanig .= "<th>Τύπος υαλοπίνακα</th>
	<th>F<sub>T</sub> 10%</th>
	<th>F<sub>T</sub> 20%</th>
	<th>F<sub>T</sub> 30%</th>
	<th>F<sub>T</sub> 40%</th>
	<th>F<sub>T</sub> 50%</th>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$diafanig .= "<tr>";
		$diafanig .= "<td>".$i."</td>";
		$diafanig .= "<td>".$data["name"]."</td>";
		$diafanig .= "<td>".$data["f10"]."</td>";
		$diafanig .= "<td>".$data["f20"]."</td>";
		$diafanig .= "<td>".$data["f30"]."</td>";
		$diafanig .= "<td>".$data["f40"]."</td>";
		$diafanig .= "<td>".$data["f50"]."</td>";
		$diafanig .= "</tr>";
		$i++;
		}
	$diafanig .= "</table>";
	$diafanig .= "</div>";//box-body
	$diafanig .= "<div class=\"box-footer\"><span class=\"no-margin pull-right\">TOTEE-20701 (Κεφ.4.2.7)</span></div>";//box-footer
	$diafanig .= "</div>";//box
	
	return $diafanig;
}

//Κατασκευή U κατακόρυφων αδιαφανών vivliothiki_adiafani_katakorifa
function create_library_adiafani_katakorifa(){
	$database = new Medoo(DB_NAME);
	$table="vivliothiki_adiafani_katakorifa";
	$columns = "*";
	
	$where1 = array("type"=>1);
	$where2 = array("type"=>2);
	$where3 = array("type"=>3);
	$where4 = array("type"=>4);
	
	$data_table1 = $database->select($table,$columns,$where1);
	$data_table2 = $database->select($table,$columns,$where2);
	$data_table3 = $database->select($table,$columns,$where3);
	$data_table4 = $database->select($table,$columns,$where4);
	
	$adiafani = "<div class=\"box\">";
	$adiafani .= "<div class=\"box-header\">Πίνακας 3.5α. Τυπικές τιμές του συντελεστή θερμοπερατότητας για υφιστάμενα κατακόρυφα αδιαφανή δομικά 
			στοιχεία που συναντώνται σε κτήρια η οικοδομική άδεια των οποίων εκδόθηκε πριν από την 
			εφαρμογή του Κ.Εν.Α.Κ. (2010). [W/(m<sup>2</sup>*K)]</div>";
	$adiafani .= "<div class=\"box-body table-responsive no-padding\">";
	$adiafani .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$adiafani .= "<tr>
	<th rowspan=\"2\" width=\"5%\" style=\"background-color:#daf1eb;\">α/α</th>";
	$adiafani .= "<th style=\"background-color:#daf1eb;\">Περιγραφή στοιχείου</th>
	<th colspan=\"3\" style=\"background-color:#c4d8d3;\">Χωρίς θερμομονωτική προστασία</th>
	<th colspan=\"3\" style=\"background-color:#aec0bc;\">Με ανεπαρκή θερμομονωτική προστασία κατά Κ.Θ.Κ.</th>
	</tr><tr>
	<th style=\"background-color:#daf1eb;\">Κατακόρυφα δομικά στοιχεία</th>
	<th style=\"background-color:#f7fcfb;\">Σε επαφή με αέρα</th>
	<th style=\"background-color:#e5f5f1;\">Σε επαφή με μη θερμαινόμ. χώρο</th>
	<th style=\"background-color:#daf1eb;\">Σε επαφή με έδαφος</th>
	<th style=\"background-color:#f7fcfb;\">Σε επαφή με αέρα</th>
	<th style=\"background-color:#e5f5f1;\">Σε επαφή με μη θερμαινόμ. χώρο</th>
	<th style=\"background-color:#daf1eb;\">Σε επαφή με έδαφος</th>
	</tr>";
	
	$adiafani .= "<tr class=\"info\"><td colspan=\"8\">Στοιχείο φέροντος οργανισμού οπλισμένου σκυροδέματος (πάχους μικρότερου των 80 cm)</td></tr>";
		foreach($data_table1 as $data){
		$adiafani .= "<tr>";
		$adiafani .= "<td>".$data["subtype"]."</td>";
		$adiafani .= "<td>".$data["name"]."</td>";
		$adiafani .= "<td>".$data["xwris_aeras"]."</td>";
		$adiafani .= "<td>".$data["xwris_mthx"]."</td>";
		$adiafani .= "<td>".$data["xwris_edafos"]."</td>";
		$adiafani .= "<td>".$data["aneparki_aeras"]."</td>";
		$adiafani .= "<td>".$data["aneparki_mthx"]."</td>";
		$adiafani .= "<td>".$data["aneparki_edafos"]."</td>";
		$adiafani .= "</tr>";
		}
		
	$adiafani .= "<tr class=\"info\"><td colspan=\"8\">Οπτοπλινθοδομή, φέρουσα ή πλήρωσης (με ή χωρίς κλειστό διάκενο αέρος)</td></tr>";
	
	$adiafani .= "<tr class=\"info\"><td colspan=\"8\">Μπατική ή δικέλυφη δρομική οπτοπλινθοδομή</td></tr>";
		foreach($data_table2 as $data){
		$adiafani .= "<tr>";
		$adiafani .= "<td>".$data["subtype"]."</td>";
		$adiafani .= "<td>".$data["name"]."</td>";
		$adiafani .= "<td>".$data["xwris_aeras"]."</td>";
		$adiafani .= "<td>".$data["xwris_mthx"]."</td>";
		$adiafani .= "<td>".$data["xwris_edafos"]."</td>";
		$adiafani .= "<td>".$data["aneparki_aeras"]."</td>";
		$adiafani .= "<td>".$data["aneparki_mthx"]."</td>";
		$adiafani .= "<td>".$data["aneparki_edafos"]."</td>";
		$adiafani .= "</tr>";
		}
	
	$adiafani .= "<tr class=\"info\"><td colspan=\"8\">Δρομική οπτοπλινθοδομή</td></tr>";
		foreach($data_table3 as $data){
		$adiafani .= "<tr>";
		$adiafani .= "<td>".$data["subtype"]."</td>";
		$adiafani .= "<td>".$data["name"]."</td>";
		$adiafani .= "<td>".$data["xwris_aeras"]."</td>";
		$adiafani .= "<td>".$data["xwris_mthx"]."</td>";
		$adiafani .= "<td>".$data["xwris_edafos"]."</td>";
		$adiafani .= "<td>".$data["aneparki_aeras"]."</td>";
		$adiafani .= "<td>".$data["aneparki_mthx"]."</td>";
		$adiafani .= "<td>".$data["aneparki_edafos"]."</td>";
		$adiafani .= "</tr>";
		}

	$adiafani .= "<tr class=\"info\"><td colspan=\"8\">Αργολιθοδομή</td></tr>";
		foreach($data_table4 as $data){
		$adiafani .= "<tr>";
		$adiafani .= "<td>".$data["subtype"]."</td>";
		$adiafani .= "<td>".$data["name"]."</td>";
		$adiafani .= "<td>".$data["xwris_aeras"]."</td>";
		$adiafani .= "<td>".$data["xwris_mthx"]."</td>";
		$adiafani .= "<td>".$data["xwris_edafos"]."</td>";
		$adiafani .= "<td>".$data["aneparki_aeras"]."</td>";
		$adiafani .= "<td>".$data["aneparki_mthx"]."</td>";
		$adiafani .= "<td>".$data["aneparki_edafos"]."</td>";
		$adiafani .= "</tr>";
		}
		
	$adiafani .= "</table>";
	$adiafani .= "</div>";//box-body
	$adiafani .= "<div class=\"box-footer\"><span class=\"no-margin pull-right\">TOTEE-20701 (Κεφ.4.2.2)</span></div>";//box-footer
	$adiafani .= "</div>";//box
	
	return $adiafani;
}

//Κατασκευή U κατακόρυφων αδιαφανών vivliothiki_adiafani_katakorifa
function create_library_adiafani_orizontia(){
	$database = new medoo(DB_NAME);
	$table="vivliothiki_adiafani_orizontia";
	$columns = "*";
	
	$where1 = array("type"=>1);
	$where2 = array("type"=>2);
	
	$data_table1 = $database->select($table,$columns,$where1);
	$data_table2 = $database->select($table,$columns,$where2);
	
	$adiafani = "<div class=\"box\">";
	$adiafani .= "<div class=\"box-header\">Πίνακας 3.5β. Τυπικές τιμές του συντελεστή θερμοπερατότητας για υφιστάμενα οριζόντια αδιαφανή δομικά 
			στοιχεία που συναντώνται σε κτήρια η οικοδομική άδεια των οποίων εκδόθηκε πριν από την 
			εφαρμογή του Κ.Εν.Α.Κ. (2010). [W/(m<sup>2</sup>*K)]</div>";
	$adiafani .= "<div class=\"box-body table-responsive no-padding\">";
	$adiafani .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$adiafani .= "<tr>
	<th rowspan=\"2\" width=\"5%\" style=\"background-color:#daf1eb;\">α/α</th>";
	$adiafani .= "<th style=\"background-color:#daf1eb;\">Περιγραφή στοιχείου</th>
	<th colspan=\"3\" style=\"background-color:#c4d8d3;\">Χωρίς θερμομονωτική προστασία</th>
	<th colspan=\"3\" style=\"background-color:#aec0bc;\">Με ανεπαρκή θερμομονωτική προστασία κατά Κ.Θ.Κ.</th>
	</tr><tr>
	<th style=\"background-color:#daf1eb;\">Κατακόρυφα δομικά στοιχεία</th>
	<th style=\"background-color:#f7fcfb;\">Σε επαφή με αέρα</th>
	<th style=\"background-color:#e5f5f1;\">Σε επαφή με μη θερμαινόμ. χώρο</th>
	<th style=\"background-color:#daf1eb;\">Σε επαφή με έδαφος</th>
	<th style=\"background-color:#f7fcfb;\">Σε επαφή με αέρα</th>
	<th style=\"background-color:#e5f5f1;\">Σε επαφή με μη θερμαινόμ. χώρο</th>
	<th style=\"background-color:#daf1eb;\">Σε επαφή με έδαφος</th>
	</tr>";
	
	$adiafani .= "<tr class=\"info\"><td colspan=\"8\">Επιστεγάσεις (με ή χωρίς ψευδοροφή)</td></tr>";
		foreach($data_table1 as $data){
		$adiafani .= "<tr>";
		$adiafani .= "<td>".$data["subtype"]."</td>";
		$adiafani .= "<td>".$data["name"]."</td>";
			if($data["subtype"]==1 OR $data["subtype"]==2 OR $data["subtype"]==4 OR $data["subtype"]==5 OR $data["subtype"]==7 OR $data["subtype"]==8){
			$adiafani .= "<td>".$data["xwris"]."</td><td></td><td></td>";
			$adiafani .= "<td>".$data["aneparki"]."</td><td></td><td></td>";
			}
			if($data["subtype"]==3){
			$adiafani .= "<td></td><td>".$data["xwris"]."</td><td></td>";
			$adiafani .= "<td>".$data["aneparki"]."</td><td></td><td></td>";
			$adiafani .= "</tr>";
			}
			if($data["subtype"]==6){
			$adiafani .= "<td></td><td>".$data["xwris"]."</td><td></td>";
			$adiafani .= "<td></td><td>".$data["aneparki"]."</td><td></td>";
			}
		$adiafani .= "</tr>";
		}
		
	$adiafani .= "<tr class=\"info\"><td colspan=\"8\">Δάπεδα με επικάλυψη παντός τύπου (ξύλο, μάρμαρο, πλακάκι, μωσαϊκό κ.τ.λ.)</td></tr>";
		foreach($data_table2 as $data){
		$adiafani .= "<tr>";
		$adiafani .= "<td>".$data["subtype"]."</td>";
		$adiafani .= "<td>".$data["name"]."</td>";
			if($data["subtype"]==1){
			$adiafani .= "<td>".$data["xwris"]."</td><td></td><td></td>";
			$adiafani .= "<td>".$data["aneparki"]."</td><td></td><td></td>";
			}
			if($data["subtype"]==2){
			$adiafani .= "<td></td><td></td><td>".$data["xwris"]."</td>";
			$adiafani .= "<td></td><td></td><td>".$data["aneparki"]."</td>";
			$adiafani .= "</tr>";
			}
			if($data["subtype"]==3){
			$adiafani .= "<td></td><td>".$data["xwris"]."</td><td></td>";
			$adiafani .= "<td></td><td>".$data["aneparki"]."</td><td></td>";
			$adiafani .= "</tr>";
			}
		$adiafani .= "</tr>";
		}	
	
	$adiafani .= "</table>";
	$adiafani .= "</div>";//box-body
	$adiafani .= "<div class=\"box-footer\"><span class=\"no-margin pull-right\">TOTEE-20701 (Κεφ.4.2.2)</span></div>";//box-footer
	$adiafani .= "</div>";//box
	
	return $adiafani;
}

//Κατασκευή adiafani_a
function create_library_adiafani_a(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_adiafani_a";
	$columns = "*";
	
	$adiafania = "<div class=\"box\">";
	$adiafania .= "<div class=\"box-header\">Πίνακας 3.15. Τυπικές τιμές ανακλαστικότητας και απορροφητικότητας στην ηλιακή ακτινοβολία</div>";
	$adiafania .= "<div class=\"box-body table-responsive no-padding\">";
	$adiafania .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$adiafania .= "<tr bgcolor=\"#ecf8f5\">
	<th width=\"5%\">α/α</th>";
	$adiafania .= "<th>Περιγραφή</th>
	<th>Ανακλαστικότητα</th>
	<th>Απορροφητικότητα (a)</th>
	</tr>";
	
	$i=1;
	
	$data_table = $database->select($table,$columns,array("type"=>1));
	$adiafania .= "<tr><td colspan=\"4\" bgcolor=\"#ecf8f5\">Κατακόρυφα δομικά στοιχεία</td></tr>";
		foreach($data_table as $data){
		$adiafania .= "<tr>";
		$adiafania .= "<td>".$i."</td>";
		$adiafania .= "<td>".$data["name"]."</td>";
		$adiafania .= "<td>".$data["ana"]."</td>";
		$adiafania .= "<td>".$data["a"]."</td>";
		$adiafania .= "</tr>";
		$i++;
		}
	
	$data_table = $database->select($table,$columns,array("type"=>2));
	$adiafania .= "<tr><td colspan=\"4\" bgcolor=\"#ecf8f5\">Οριζόντια δομικά στοιχεία (οροφές)</td></tr>";
		foreach($data_table as $data){
		$adiafania .= "<tr>";
		$adiafania .= "<td>".$i."</td>";
		$adiafania .= "<td>".$data["name"]."</td>";
		$adiafania .= "<td>".$data["ana"]."</td>";
		$adiafania .= "<td>".$data["a"]."</td>";
		$adiafania .= "</tr>";
		$i++;
		}
	$adiafania .= "</table>";
	$adiafania .= "</div>";//box-body
	$adiafania .= "<div class=\"box-footer\"><span class=\"no-margin pull-right\">TOTEE-20701 (Κεφ.4.2.5)</span></div>";//box-footer
	$adiafania .= "</div>";//box
	
	return $adiafania;
}

//Κατασκευή adiafani_e
function create_library_adiafani_e(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_adiafani_e";
	$columns = "*";
	
	$data_table = $database->select($table,$columns);	
	
	$adiafanie = "<div class=\"box\">";
	$adiafanie .= "<div class=\"box-header\">Πίνακας 3.16. Τιμές του συντελεστή εκπομπής (εκπεμπτικότητα) θερμικής ακτινοβολίας</div>";
	$adiafanie .= "<div class=\"box-body table-responsive no-padding\">";
	$adiafanie .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$adiafanie .= "<tr>
	<th width=\"5%\">α/α</th>";
	$adiafanie .= "<th>Περιγραφή</th>
	<th>Συντελεστής εκπομπής (e)</th>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$adiafanie .= "<tr>";
		$adiafanie .= "<td>".$i."</td>";
		$adiafanie .= "<td>".$data["name"]."</td>";
		$adiafanie .= "<td>".$data["e"]."</td>";
		$adiafanie .= "</tr>";
		$i++;
		}
	$adiafanie .= "</table>";
	$adiafanie .= "</div>";//box-body
	$adiafanie .= "<div class=\"box-footer\"><span class=\"no-margin pull-right\">TOTEE-20701 (Κεφ.4.2.6)</span></div>";//box-footer
	$adiafanie .= "</div>";//box
	
	return $adiafanie;
}

//Κατασκευή φέρων οργανισμός
function create_library_ferwn(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_ferwn";
	$columns = "*";
	
	$data_year1 = $database->select($table,$columns,array("year"=>1));
	$data_year2 = $database->select($table,$columns,array("year"=>2));
	
	$txt = "<div class=\"box\">";
	$txt .= "<div class=\"box-header\">Πίνακας 3.1. Συμβατικός τρόπος υπολογισμού του εμβαδού που καταλαμβάνει ο φέρων οργανισμός του 
	κτηρίου ως ποσοστό επί της επιφάνειας της όψης του σε περίπτωση που δεν είναι εφικτή η αποτύπωσή του φέροντος οργανισμού.</div>";
	$txt .= "<div class=\"box-body table-responsive no-padding\">";
	$txt .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$txt .= "<tr>
	<th>Έτος έκδοσης οικοδομικής άδειας</th>
	<th>έως 2 όροφοι</th>
	<th>2<όροφοι<5</th>
	<th>5 και πάνω όροφοι</th>
	</tr>";
	
	$txt .= "<tr>";
	$txt .= "<td>Προ του 1980</td>";
		foreach($data_year1 as $data){
		$txt .= "<td>".$data["percent"]."%</td>";
		}
	$txt .= "</tr>";
	
	$txt .= "<tr>";
	$txt .= "<td>1980 έως 1999</td>";
		foreach($data_year2 as $data){
		$txt .= "<td>".$data["percent"]."%</td>";
		}
	$txt .= "</tr>";
	
	$txt .= "</table>";
	$txt .= "</div>";//box-body
	$txt .= "<div class=\"box-footer\"><span class=\"no-margin pull-right\">TOTEE-20701 (Κεφ.4.1.2)</span></div>";//box-footer
	$txt .= "</div>";//box
	
	return $txt;
}


//ΒΙΒΛΙΟΘΗΚΕΣ - ΣΚΙΑΣΕΙΣ
//Κατασκευή πίνακα σκιάσεων
function create_library_shading($from="hor"){
	
	$database = new medoo(DB_NAME);
	if($from=="hor"){$table="vivliothiki_f_hor";}
	if($from=="ov"){$table="vivliothiki_f_ov";}
	if($from=="left"){$table="vivliothiki_f_fin_left";}
	if($from=="right"){$table="vivliothiki_f_fin_right";}
	if($from=="per"){$table="vivliothiki_f_per";}
	$columns = "*";
	
	$data_table = $database->select($table,$columns);
	
	$shadetable = "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$shadetable .= "<tr>
	<th width=\"5%\">α/α</th>";
	if($from=="per"){$shadetable .= "<th>Τύπος</th>";}
	$shadetable .= "<th>Γωνία σκίασης</th>
	<th>Περίοδος</th>
	<th>Β (0) <button type=\"button\" onclick=\"create_chart_shade('b','".$from."');\"><i class=\"fa fa-pie-chart\"></i></button></th>
	<th>ΒΑ (45) <button type=\"button\" onclick=\"create_chart_shade('ba','".$from."');\"><i class=\"fa fa-pie-chart\"></i></button></th>
	<th>Α (90) <button type=\"button\" onclick=\"create_chart_shade('a','".$from."');\"><i class=\"fa fa-pie-chart\"></i></button></th>
	<th>ΝΑ (135) <button type=\"button\" onclick=\"create_chart_shade('na','".$from."');\"><i class=\"fa fa-pie-chart\"></i></button></th>
	<th>Ν (180) <button type=\"button\" onclick=\"create_chart_shade('n','".$from."');\"><i class=\"fa fa-pie-chart\"></i></button></th>
	<th>ΝΔ (235) <button type=\"button\" onclick=\"create_chart_shade('nd','".$from."');\"><i class=\"fa fa-pie-chart\"></i></button></th>
	<th>Δ (270) <button type=\"button\" onclick=\"create_chart_shade('d','".$from."');\"><i class=\"fa fa-pie-chart\"></i></button></th>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$shadetable .= "<tr>";
		$shadetable .= "<td>".$i."</td>";
		if($from=="per"){$shadetable .= "<th>".$data["type"]."</th>";}
		$shadetable .= "<td>".$data["deg"]."</td>";
		$shadetable .= "<td>".$data["periode"]."</td>";
		$shadetable .= "<td>".$data["b"]."</td>";
		$shadetable .= "<td>".$data["ba"]."</td>";
		$shadetable .= "<td>".$data["a"]."</td>";
		$shadetable .= "<td>".$data["na"]."</td>";
		$shadetable .= "<td>".$data["n"]."</td>";
		$shadetable .= "<td>".$data["nd"]."</td>";
		$shadetable .= "<td>".$data["d"]."</td>";
		$shadetable .= "</tr>";
		$i++;
		}
	$shadetable .= "</table>";
	
	return $shadetable;
}


//ΒΙΒΛΙΟΘΗΚΕΣ ΚΛΙΜΑΤΙΚΑ
//Κατασκευή πινάκων κλιματικών δεδομένων
function create_library_climate($table="vivliothiki_climate31"){
	
	$database = new medoo(DB_NAME);
	$columns = "*";
	
	$data_table = $database->select($table,$columns);	
	
	$climate = "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$climate .= "<tr><th width=\"5%\">α/α</th>";
	
	if($table=="vivliothiki_climate44"){$climate .= "<th>Κλίση β (<sup>o</sup>)</th>";}
	
	$climate .= "<th>Τοποθεσία</th>";	
	$climate .= "<th>ΙΑΝ</th>
	<th>ΦΕΒ</th>
	<th>ΜΑΡ</th>
	<th>ΑΠΡ</th>
	<th>ΜΑΙ</th>
	<th>ΙΟΥΝ</th>
	<th>ΙΟΥΛ</th>
	<th>ΑΥΓ</th>
	<th>ΣΕΠ</th>
	<th>ΟΚΤ</th>
	<th>ΝΟΕ</th>
	<th>ΔΕΚ</th>";
	
	if($table=="vivliothiki_climate44"){$climate .= "<th>Ε</th><th>Χ</th><th>Θ</th>";}
	
	$climate .= "</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$climate .= "<tr onclick=\"open_popup_climate(".trim($table,"vivliothiki_climate").", ".$data["id"].");\">";
		$climate .= "<td>".$i."</td>";
		
		if($table=="vivliothiki_climate44"){$climate .= "<td>".$data["deg"]."</td>";}
		
		if($data["place"]=="a"){$data["place"] = "Ζώνη Α";}
		if($data["place"]=="b"){$data["place"] = "Ζώνη Β";}
		if($data["place"]=="g"){$data["place"] = "Ζώνη Γ";}
		if($data["place"]=="d"){$data["place"] = "Ζώνη Δ";}
		
		$climate .= "<td>".$data["place"]."</td>";
		$climate .= "<td>".$data["jan"]."</td>";
		$climate .= "<td>".$data["feb"]."</td>";
		$climate .= "<td>".$data["mar"]."</td>";
		$climate .= "<td>".$data["apr"]."</td>";
		$climate .= "<td>".$data["may"]."</td>";
		$climate .= "<td>".$data["jun"]."</td>";
		$climate .= "<td>".$data["jul"]."</td>";
		$climate .= "<td>".$data["aug"]."</td>";
		$climate .= "<td>".$data["sep"]."</td>";
		$climate .= "<td>".$data["okt"]."</td>";
		$climate .= "<td>".$data["nov"]."</td>";
		$climate .= "<td>".$data["dec"]."</td>";
		
		if($table=="vivliothiki_climate44"){$climate .= "<td>".$data["e"]."</td><td>".$data["x"]."</td><td>".$data["th"]."</td>";}
		
		$climate .= "</tr>";
		$i++;
		}
	$climate .= "</table>";
	
	return $climate;
}


//Κατασκευή climate_b
function create_library_climateb($place="Άργος (Πυργέλα)",$b="no",$g="no"){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_climate_b";
	//$place = str_replace("%20", " ", $place);
	$where = array("place"=>"$place");
	$array_months_en = array("jan","feb","mar","apr","may","jun","jul","aug","sep","okt","nov","dec");
	$array_months_gr = array("ΙΑΝ","ΦΕΒ","ΜΑΡ","ΑΠΡ","ΜΑΙ","ΙΟΥΝ","ΙΟΥΛ","ΑΥΓ","ΣΕΠ","ΟΚΤ","ΝΟΕ","ΔΕΚ");
	
	if($g=="no"){
		if($b=="no"){
			$columns = array("b0","b90g0","b90g45","b90g90","b90g135","b90g180","b45g0","b45g45","b45g90","b45g135","b45g180");
			$columns_gr = array("β=0",
				"β=90 γ=0","β=90 γ=45/315","β=90 γ=90/270","β=90 γ=135/225","β=90 γ=180",
				"β=45 γ=0","β=45 γ=45","β=45 γ=90","β=45 γ=135","β=45 γ=180");
		}
		if($b=="0"){
			$columns = array("b0");
			$columns_gr = array("β=0");
		}
		if($b=="45"){
			$where = array("place"=>"$place");
			$columns = array("b45g0","b45g45","b45g90","b45g135","b45g180");
			$columns_gr = array("β=45 γ=0","β=45 γ=45","β=45 γ=90","β=45 γ=135","β=45 γ=180");
		}
		if($b=="90"){
			$columns = array("b90g0","b90g45","b90g90","b90g135","b90g180");
			$columns_gr = array("β=90 γ=0","β=90 γ=45/315","β=90 γ=90/270","β=90 γ=135/225","β=90 γ=180");
		}
	}else{
		$columns = array("b".$b."g".$g);
		$columns_gr = array("β=".$b." γ=".$g);
	}
	
	$data_table = $database->select($table,$columns,$where);	
	
	$climateb = "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$climateb .= "<tr><th colspan=\"13\">".$place."</th></tr>";
	$climateb .= "<tr><th>Κλίση/Προσανατολισμός</th>";
		foreach($array_months_gr as $months_gr){
			$climateb .= "<th>".$months_gr."</th>";
		}
	$climateb .= "</tr>";
	
	if($place!="no"){
		$key=0;
		foreach($columns as $column){
			$climateb .= "<tr onclick=\"open_popup_climateb('".$place."', '".$column."');\">";
			$climateb .= "<td>".$columns_gr[$key]."</td>";
				for($i=0; $i<=11; $i++){
					$climateb .= "<td>";
					$climateb .= $data_table[$i][$column];
					$climateb .= "</td>";
				}
			$climateb .= "</tr>";	
			$key++;	
		}
	}
	$climateb .= "</table>";
	$climateb .= "<br/>";
	$climateb .= "β: Κλίση επιφάνειας (<sup>o</sup>), γ: Προσανατολισμός επιφάνειας (<sup>o</sup>), Όλες οι τιμές είναι σε kWh/m<sup>2</sup>";
	
	return $climateb;
}


//ΒΙΒΛΙΟΘΗΚΕΣ - ΣΥΣΤΗΜΑΤΑ
//Κατασκευή συνα
function create_library_syna($type="ktiria"){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_syna_".$type;
	$columns = "*";
	
	$data_table = $database->select($table,$columns);	
	
	$syna = "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$syna .= "<tr>
	<th width=\"5%\">α/α</th>
	<th>Πόλη</th>
	<th>Απλός (15<sup>o</sup>)</th>
	<th>Απλός (45<sup>o</sup>)</th>
	<th>Απλός (65<sup>o</sup>)</th>
	<th>Επιλεκτικός (15<sup>o</sup>)</th>
	<th>Επιλεκτικός (45<sup>o</sup>)</th>
	<th>Επιλεκτικός (65<sup>o</sup>)</th>
	<th>Κενού (15<sup>o</sup>)</th>
	<th>Κενού (45<sup>o</sup>)</th>
	<th>Κενού (65<sup>o</sup>)</th>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$syna .= "<tr>";
		$syna .= "<td>".$i."</td>";
		$syna .= "<td>".$data["place"]."</td>";
		$syna .= "<td>".$data["simple15"]."</td>";
		$syna .= "<td>".$data["simple45"]."</td>";
		$syna .= "<td>".$data["simple65"]."</td>";
		$syna .= "<td>".$data["select15"]."</td>";
		$syna .= "<td>".$data["select45"]."</td>";
		$syna .= "<td>".$data["select65"]."</td>";
		$syna .= "<td>".$data["vacum15"]."</td>";
		$syna .= "<td>".$data["vacum45"]."</td>";
		$syna .= "<td>".$data["vacum65"]."</td>";
		$syna .= "</tr>";
		$i++;
		}
	$syna .= "</table>";
	
	return $syna;
}

//Κατασκευή πίνακα vivliothiki_therm_d
function create_library_therm_d(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_therm_d";
	$columns = "*";
	$where1 = array("t"=>1);
	$where2 = array("t"=>2);
	$p_array = array("0", "20 - 100", "100 - 200", "200 - 300", "300 - 400", ">400");
	$categories = "<td>Μόνωση κτηρίου αναφοράς [%]</td>
	<td>Μόνωση ίση με την ακτίνα σωλήνων [%]</td>
	<td>Ανεπαρκής μόνωση [%]</td>
	<td>Χωρίς μόνωση [%]</td>";
	
	$data_table1 = $database->select($table,$columns,$where1);
	$data_table2 = $database->select($table,$columns,$where2);
	
	$therm = "<h6>Βαθμός απόδοσης δικτύου διανομής θέρμανσης (Ποσοστό θερμικών απωλειών)</h6>";
	$therm .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$therm .= "<tr class=\"error\">
	<td rowspan=\"2\" width=\"5%\">α/α</td>
	<td rowspan=\"2\">Θερμική ή ψυκτική ισχύς δικτύου διανομής [kW]</td>
	<td colspan=\"4\">Διέλευση σε εσωτερικούς χώρους ή/και 20% σε εξωτερικούς χώρους</td>
	<td colspan=\"4\">Διέλευση > 20% σε εξωτερικούς χώρους</td>
	</tr><tr class=\"error\">".$categories.$categories."</tr>";
	
	$therm .= "<tr class=\"error\"><td colspan=\"10\">Δίκτυα διανομής θέρμανσης με υψηλές θερμοκρασίες προσαγωγής θερμικού μέσου (≥60oC)</td></tr>";
	
		$i=1;
		foreach($data_table1 as $data){		
		$therm .= "<tr>";
		$therm .= "<td>".$i."</td>";
		$therm .= "<td>".$p_array[$data["p"]]."</td>";
		$therm .= "<td>".$data["esw1"]."</td>";
		$therm .= "<td>".$data["esw2"]."</td>";
		$therm .= "<td>".$data["esw3"]."</td>";
		$therm .= "<td>".$data["esw4"]."</td>";
		$therm .= "<td>".$data["eksw1"]."</td>";
		$therm .= "<td>".$data["eksw2"]."</td>";
		$therm .= "<td>".$data["eksw3"]."</td>";
		$therm .= "<td>".$data["eksw4"]."</td>";
		$therm .= "</tr>";
		$i++;
		}
		
	$therm .= "<tr class=\"error\"><td colspan=\"10\">Δίκτυα διανομής θέρμανσης με χαμηλές θερμοκρασίες προσαγωγής θερμικού μέσου (<60oC)</td></tr>";	
		
		$i=1;
		foreach($data_table2 as $data){		
		$therm .= "<tr>";
		$therm .= "<td>".$i."</td>";
		$therm .= "<td>".$p_array[$data["p"]]."</td>";
		$therm .= "<td>".$data["esw1"]."</td>";
		$therm .= "<td>".$data["esw2"]."</td>";
		$therm .= "<td>".$data["esw3"]."</td>";
		$therm .= "<td>".$data["esw4"]."</td>";
		$therm .= "<td>".$data["eksw1"]."</td>";
		$therm .= "<td>".$data["eksw2"]."</td>";
		$therm .= "<td>".$data["eksw3"]."</td>";
		$therm .= "<td>".$data["eksw4"]."</td>";
		$therm .= "</tr>";
		$i++;
		}
	$therm .= "</table>";
	
	return $therm;
}


//Κατασκευή πίνακα vivliothiki_therm_p_ngm
function create_library_therm_p_ngm(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_therm_p_ngm";
	$columns = "*";
	$data_table = $database->select($table,$columns);
	
	$therm = "<h6>Πίνακας 4.2β. Μέγιστες τιμές πραγματικού βαθμού απόδοσης σε περίπτωση έλλειψης άλλων φ.ε και ενεργειακής σήμανσης.</h6><br/>";
	$therm .= "<table class=\"table table-bordered table-hover\">";
	$therm .= "<tr class=\"error\">
	<td width=\"5%\">α/α</td>
	<td>Τύπος λέβητα</td>
	<td>Βαθμός απόδοσης</td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$therm .= "<tr>";
		$therm .= "<td>".$i."</td>";
		$therm .= "<td>".$data["name"]."</td>";
		$therm .= "<td>".$data["ngm"]."</td>";
		$therm .= "</tr>";
		$i++;
		}
	$therm .= "</table>";
	
	return $therm;
}	

//Κατασκευή πίνακα vivliothiki_therm_p_ngm
function create_library_therm_p_ngo(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_therm_p_ngm";
	$columns = "*";
	$data_table = $database->select($table,$columns);
	
	$therm = "<h6>Πίνακας 4.2γ Συντελεστής μετατροπής σε εποχιακό βαθμό απόδοσης (ng<sub>0</sub>)</h6><br/>";
	$therm .= "<table class=\"table table-bordered table-hover\">";
	$therm .= "<tr class=\"error\">
	<td colspan=\"2\"></td>
	<td colspan=\"4\">Συντελεστής μετατροπής σε εποχιακό β.α.ng<sub>0</sub></td>
	</tr>";
	$therm .= "<tr class=\"error\">
	<td width=\"5%\">α/α</td>
	<td>Ονομαστική ισχύς (kW)</td>
	<td>P≤25</td>
	<td>25>P≤100</td>
	<td>100>P≤400</td>
	<td>P>400</td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$therm .= "<tr>";
		$therm .= "<td>".$i."</td>";
		$therm .= "<td>".$data["name"]."</td>";
		$therm .= "<td>".$data["ngo_1"]."</td>";
		$therm .= "<td>".$data["ngo_2"]."</td>";
		$therm .= "<td>".$data["ngo_3"]."</td>";
		$therm .= "<td>".$data["ngo_4"]."</td>";
		$therm .= "</tr>";
		$i++;
		}
	$therm .= "</table>";
	
	return $therm;
}	


//Κατασκευή πίνακα vivliothiki_therm_p_ng1
function create_library_therm_p_ng1(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_therm_p_ng1";
	$columns = "*";
	$data_table = $database->select($table,$columns);
	
	$therm = "<h6>Πίνακας 4.3. Συντελεστής υπερδιαστασιολόγησης ng<sub>1</sub> μονάδας λέβητα - καυστήρα.</h6>
	Γίνεται υπολογισμός της μέγιστης απαιτούμενης θερμικής ισχύος της μονάδας P<sub>gen</sub> προς την πραγματική P<sub>m</sub>.<br/>";
	$therm .= "<table class=\"table table-bordered table-hover\">";
	$therm .= "<tr class=\"error\">
	<td colspan=\"2\"></td>
	<td colspan=\"6\">Συντελεστής υπερδιαστασιολόγησης</td>
	</tr>";
	$therm .= "<tr class=\"error\">
	<td width=\"5%\">α/α</td>
	<td>Σχέση πραγματικής προς υπολογιζόμενη ισχύ μονάδας θέρμανσης(P<sub>m</sub> / P<sub>gen</sub>)</td>
	<td>100%</td>
	<td>125%</td>
	<td>150%</td>
	<td>200%</td>
	<td>400%</td>
	<td>500%</td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$therm .= "<tr>";
		$therm .= "<td>".$i."</td>";
		$therm .= "<td>".$data["type"]."</td>";
		$therm .= "<td>".$data["ng100"]."</td>";
		$therm .= "<td>".$data["ng125"]."</td>";
		$therm .= "<td>".$data["ng150"]."</td>";
		$therm .= "<td>".$data["ng200"]."</td>";
		$therm .= "<td>".$data["ng400"]."</td>";
		$therm .= "<td>".$data["ng500"]."</td>";
		
		$therm .= "</tr>";
		$i++;
		}
	$therm .= "</table>";
	
	return $therm;
}	

//Κατασκευή πίνακα vivliothiki_therm_p_ng2
function create_library_therm_p_ng2(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_therm_p_ng2";
	$columns = "*";
	$data_table = $database->select($table,$columns);
	
	$therm = "<h6>Πίνακας 4.4. Συντελεστές υπολογισμού συντελεστή κατάστασης μόνωσης ng<sub>2</sub> μονάδας λέβητα - καυστήρα.</h6>";
	$therm .= "<table class=\"table table-bordered table-hover\">";
	$therm .= "<tr class=\"error\">
	<td width=\"5%\">α/α</td>
	<td>Κατάσταση μόνωσης</td>
	<td>Τύπος λέβητα</td>
	<td>a</td>
	<td>b</td>
	</tr>";
	
	$insulation=array(0,"Καλή","Μέτρια","Κακή");
	
		$i=1;
		foreach($data_table as $data){		
		$therm .= "<tr>";
		$therm .= "<td>".$i."</td>";
		$therm .= "<td>".$insulation[$data["type_insulation"]]."</td>";
		$therm .= "<td>".$data["name_boiler"]."</td>";
		$therm .= "<td>".$data["a"]."</td>";
		$therm .= "<td>".$data["b"]."</td>";
		$therm .= "</tr>";
		$i++;
		}
	$therm .= "</table>";
	
	return $therm;
}

//Κατασκευή πίνακα vivliothiki_therm_p_other
function create_library_therm_p_other(){

	$therm = "<h6>Άλλες μονάδες παραγωγής</h6>";

	$therm .= "Ηλεκτρικές μονάδες (ηλεκτρικά σώματα άμεσης απόδοσης:θερμοπομποί, μονάδες επαγωγής, ηλεκτρικοί θερμοσυσσωρευτές)<br/>
	Θερμική ισχύς: Ίση με την αναγραφόμενη σε KW<br/>
	Βαθμός απόδοσης: 1 (θεωρείται πως δε μεταβάλλεται λόγω γήρανσης. Κακοσυντηρημένες μονάδες, χωρίς μόνωση κλπ 0.95)<br/><br/>
	
	Τοπικές μονάδες αερίων ή υγρών καυσίμων (θερμάστρες υγραερίου, φυσικού αερίου, πετρελαίου κλπ)<br/>
	Θερμική ισχύς: Ίση με την αναγραφόμενη σε KW<br/>
	Βαθμός απόδοσης: Η αναγραφόμενη ή για συστήματα χωρίς καπνοδόχο=1 και με καπνοδόχο=0,7<br/><br/>
	
	Ανοιχτές εστίες καύσης (Σόμπες, τζάκια)<br/>
	Βαθμός απόδοσης: <br/>
	Συνήθως μια εστία καύσης έχει τη δυνατότητα κάλυψης του θερμικού φορτίου ενός χώρου 30 m<sup>2</sup>. 
	Ο μέσος θερμικός βαθμός απόδοσης για τα παραδοσιακά τζάκια εκτιμάται σε 25%, ενώ για τα ενεργειακά τζάκια και τις σόμπες 50%.
	<br/><br/>";
return $therm;
}

//Κατασκευή πίνακα vivliothiki_therm_p_ng2
function create_library_therm_p_cop1(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_therm_p_cop1";
	$columns = "*";
	$data_table = $database->select($table,$columns);
	
	$therm = "<h6>Μέσος ολικός εποχικός συντελεστής επίδοσης SCOP για μονάδες αντλιών θερμότητας για 
	διάφορες θερμοκρασίες θερμικού μέσου (ΕΛΟΤ ΕΝ 15316.4.2:2008).</h6>";
	$therm .= "Η τιμή του COP προσδιορίζεται σε συγκεκριμένες συνθήκες εξωτερικού περιβάλλοντος και 
	θερμοκρασίας παροχής και επιστροφής θερμικού μέσου. Η απόδοση των αντλιών θερμότητας 
	εξαρτάται επίσης και από την πηγή θερμότητας που αξιοποιούν για τη λειτουργία τους και η οποία 
	μπορεί να είναι ο αέρας, το έδαφος, τα υπόγεια και επιφανειακά νερά, το θαλασσινό νερό, τα καυσαέρια 
	κινητήρων (π.χ. Σ.Η.Θ.), η ηλιακή ενέργεια κ.ά.
	<br/>
	Λαμβάνεται για ονομαστικές συνθήκες λειτουργίας θερμοκρασίας εξωτερικού αέρα 7<sup>ο</sup>C και θερμοκρασία 
	μέσου 45οC σύμφωνα με το ευρωπαϊκό πρότυπο ΕΝ 14511:2007, όπως δίνεται από τον κατασκευαστή και 
	αναγράφεται στις τεχνικές προδιαγραφές ή/και στο πλαίσιο της αντλίας θερμότητας.<br/>";
	$therm .= "<table class=\"table table-bordered table-hover\">";
	$therm .= "<tr class=\"error\">
	<td rowspan=\"2\" width=\"5%\">α/α</td>
	<td rowspan=\"2\">Πηγή θερμότητας</td>
	<td colspan=\"3\">Κτήρια τριτογενούς τομέα</td>
	<td colspan=\"2\">100 - 200</td>
	</tr>
	<tr class=\"error\">
	<td>Τ<35<sup>o</sup>C</td>
	<td>35<sup>o</sup>C<Τ<45<sup>o</sup>C</td>
	<td>45<sup>o</sup>C<Τ<55<sup>o</sup>C</td>
	<td>Τ<35<sup>o</sup>C</td>
	<td>35<sup>o</sup>C<Τ<45<sup>o</sup>C</td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$therm .= "<tr>";
		$therm .= "<td>".$i."</td>";
		$therm .= "<td>".$data["type"]."</td>";
		$therm .= "<td>".$data["tritogenis_t1"]."</td>";
		$therm .= "<td>".$data["tritogenis_t2"]."</td>";
		$therm .= "<td>".$data["tritogenis_t3"]."</td>";
		$therm .= "<td>".$data["katoikia_t1"]."</td>";
		$therm .= "<td>".$data["katoikia_t2"]."</td>";
		$therm .= "</tr>";
		$i++;
		}
	$therm .= "</table>";
	
	return $therm;
}


//Κατασκευή πίνακα vivliothiki_therm_p_other
function create_library_therm_p_cop2(){

	$therm = "<h6>Αντλίες θερμότητας (SCOP)</h6>";

	$therm .= "Α:Τοπικές ή ημικεντρικές μονάδες απ’ευθείας εκτόνωσης με θερμαινόμενο μέσο τον αέρα:
	<ol>
	<li>SCOP = 0,93 ∙ SCOPΕΣ (αν πληρούν τον κανονισμό Ενεργειακής Επισήμανσης της ΕΕ 626/2011)</li>
	<li>SCOP = COP για εξωτερική θερμοκρασία 7<sup>o</sup>Cκαι εσωτερική θερμοκρασία 20<sup>o</sup>C. (εάν δεν πληρούν τον κανονισμό Ενεργειακής Επισήμανσης της ΕΕ 626/2011)</li>
	<li>SCOP = 1.7 για συστήματα εγκατεστημένα πριν το 1990 ή αν δεν είναι γνωστή η εγκατάσταση</li>
	<li>SCOP = 2.2 για συστήματα εγκατεστημένα μεταξύ του 1990 και του 2000</li>
	<li>SCOP = 2.5 για συστήματα εγκατεστημένα μετά το 2001.</li>
	</ol>
	Β. Αντλίες θερμότητας με θερμαινόμενο μέσο το νερό:
	<ol>
	<li>SCOP = 2,35 ∙ (ηs35<sup>oCΘΚ</sup> + 3%) (αν πληρούν τον κανονισμό Ενεργειακής Επισήμανσης της ΕΕ 626/2011 για ενδοδαπέδια, ενδοτοίχια ή θέρμανση οροφής)</li>
	<li>SCOP = 2,35 ∙ (ηs35<sup>oCΘΚ</sup> + 3%) (αν πληρούν τον κανονισμό Ενεργειακής Επισήμανσης της ΕΕ 626/2011 στην περίπτωση στοιχείων νερού με ανεμιστήρα FCU)</li>
	<li>SCOP = 2,35 ∙ (ηs35<sup>oCΘΚ</sup> + 3%) (αν πληρούν τον κανονισμό Ενεργειακής Επισήμανσης της ΕΕ 626/2011 σε κάθε άλλη περίπτωση όπως θερμαντικά σώματα,, κονβέκτορες, κλπ)</li>
	<li>SCOP = COP για εξωτερική θερμοκρασία 7<sup>o</sup>Cκαι εσωτερική θερμοκρασία 45<sup>o</sup>C για θερμαινόμενο μέσο νερό (εάν δεν πληρούν τον κανονισμό Ενεργειακής Επισήμανσης της ΕΕ 626/2011)</li>
	<li>SCOP = COP για εξωτερική θερμοκρασία 15<sup>o</sup>Cκαι εσωτερική θερμοκρασία 45<sup>o</sup>C για γεωθερμική αντλία (εάν δεν πληρούν τον κανονισμό Ενεργειακής Επισήμανσης της ΕΕ 626/2011)</li>
	<li>SCOP = 2.2 για συστήματα εγκατεστημένα πριν το 1990 ή αν δεν είναι γνωστή η εγκατάσταση</li>
	<li>SCOP = 2.7 για συστήματα εγκατεστημένα μεταξύ του 1990 και του 2000</li>
	<li>SCOP = 3.0 για συστήματα εγκατεστημένα μετά το 2001.</li>
	</ol>";
return $therm;
}

//Κατασκευή πίνακα vivliothiki_therm_cop_ng1
function create_library_therm_p_copng1(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_therm_p_copng1";
	$columns = "*";
	$data_table = $database->select($table,$columns);
	
	$therm = "<h6>Πίνακας 4.5β: Συντελεστής υπερδιαστασιολόγησης αντλιών θερμότητας</h6>
	Γίνεται υπολογισμός της μέγιστης απαιτούμενης θερμικής ισχύος της μονάδας P<sub>gen</sub> προς την πραγματική P<sub>m</sub>.<br/>";
	$therm .= "<table class=\"table table-bordered table-hover\">";
	$therm .= "<tr class=\"error\">
	<td colspan=\"2\"></td>
	<td colspan=\"6\">Συντελεστής υπερδιαστασιολόγησης</td>
	</tr>";
	$therm .= "<tr class=\"error\">
	<td width=\"5%\">α/α</td>
	<td>Σχέση πραγματικής προς υπολογιζόμενη ισχύ μονάδας θέρμανσης</td>
	<td>100%</td>
	<td>150%</td>
	<td>200%</td>
	<td>300%</td>
	<td>500%</td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$therm .= "<tr>";
		$therm .= "<td>".$i."</td>";
		$therm .= "<td>".$data["type"]."</td>";
		$therm .= "<td>".$data["ng100"]."</td>";
		$therm .= "<td>".$data["ng150"]."</td>";
		$therm .= "<td>".$data["ng200"]."</td>";
		$therm .= "<td>".$data["ng300"]."</td>";
		$therm .= "<td>".$data["ng500"]."</td>";
		
		$therm .= "</tr>";
		$i++;
		}
	$therm .= "</table>";
	
	return $therm;
}	

//Κατασκευή πίνακα vivliothiki_therm_p_nem
function create_library_therm_p_nem(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_therm_p_nem";
	$columns = "*";
	$data_table = $database->select($table,$columns);
	
	$therm = "<h6>Απόδοση εκπομπής n<sub>em</sub> τερματικών μονάδων θέρμανσης</h6>";

	$therm .= "<table class=\"table table-bordered table-hover\">";
	$therm .= "<tr class=\"error\">
	<td rowspan=\"2\" width=\"5%\">α/α</td>
	<td rowspan=\"2\">Τύπος τερματικής μονάδας</td>
	<td colspan=\"3\">Θερμοκρασία μέσου Τ [<sup>ο</sup>C]</td>
	</tr>
	<tr class=\"error\">
	<td>90 - 70</td>
	<td>70 - 50</td>
	<td>50 - 35</td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$therm .= "<tr>";
		$therm .= "<td>".$i."</td>";
		$therm .= "<td>".$data["type"]."</td>";
		$therm .= "<td>".$data["t1"]."</td>";
		$therm .= "<td>".$data["t2"]."</td>";
		$therm .= "<td>".$data["t3"]."</td>";
		$therm .= "</tr>";
		$i++;
		}
	$therm .= "</table>";
return $therm;
}

//Κατασκευή πίνακα vivliothiki_therm_p_nem_elec
function create_library_therm_p_nem_elec(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_therm_p_nem_elec";
	$columns = "*";
	$data_table = $database->select($table,$columns);
	
	$therm = "<h6>Απόδοση εκπομπής n<sub>em</sub> τερματικών μονάδων θέρμανσης (Άλλες μονάδες)</h6>";

	$therm .= "<table class=\"table table-bordered table-hover\">";
	$therm .= "<tr class=\"error\">
	<td>α/α</td>
	<td>Τύπος τερματικής μονάδας</td>
	<td>n<sub>em</sub></td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$therm .= "<tr>";
		$therm .= "<td>".$i."</td>";
		$therm .= "<td>".$data["type"]."</td>";
		$therm .= "<td>".$data["nem"]."</td>";
		$therm .= "</tr>";
		$i++;
		}
	$therm .= "</table>";
return $therm;
}

//Κατασκευή πίνακα vivliothiki_therm_p_frad
function create_library_therm_p_frad(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_therm_p_frad";
	$columns = "*";
	$data_table = $database->select($table,$columns);
	
	$therm = "<h6>Παράγοντας για την αποτελεσματικότητα της ακτινοβολίας f<sub>rad</sub></h6>";
	
	$therm .= "Με βάση τον παρακάτω πίνακα για σώματα ακτινοβολίας. Στις υπόλοιπες περιπτώσεις =1.";
	$therm .= "<table class=\"table table-bordered table-hover\">";
	$therm .= "<tr class=\"error\">
	<td>α/α</td>
	<td>Τύπος τερματικής μονάδας</td>
	<td>f<sub>rad</sub></td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$therm .= "<tr>";
		$therm .= "<td>".$i."</td>";
		$therm .= "<td>".$data["type"]."</td>";
		$therm .= "<td>".$data["frad"]."</td>";
		$therm .= "</tr>";
		$i++;
		}
	$therm .= "</table>";
return $therm;
}

//Κατασκευή πίνακα vivliothiki_therm_p_fim
function create_library_therm_p_fim(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_therm_p_fim";
	$columns = "*";
	$data_table = $database->select($table,$columns);
	
	$therm = "<h6>Παράγοντας της διακοπτόμενης λειτουργίας f<sub>im</sub></h6>";
	
	$therm .= "<table class=\"table table-bordered table-hover\">";
	$therm .= "<tr class=\"error\">
	<td>α/α</td>
	<td>Τύπος τερματικής μονάδας</td>
	<td>f<sub>im</sub></td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$therm .= "<tr>";
		$therm .= "<td>".$i."</td>";
		$therm .= "<td>".$data["type"]."</td>";
		$therm .= "<td>".$data["fim"]."</td>";
		$therm .= "</tr>";
		$i++;
		}
	$therm .= "</table>";
return $therm;
}

//Κατασκευή πίνακα vivliothiki_therm_p_fhydr
function create_library_therm_p_fhydr(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_therm_p_fhydr";
	$columns = "*";
	$data_table = $database->select($table,$columns);
	
	$therm = "<h6>Παράγοντας για την υδραυλική ισορροπία f<sub>hydr</sub></h6>";
	
	$therm .= "<table class=\"table table-bordered table-hover\">";
	$therm .= "<tr class=\"error\">
	<td>α/α</td>
	<td>Τύπος τερματικής μονάδας</td>
	<td>f<sub>hydr</sub></td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$therm .= "<tr>";
		$therm .= "<td>".$i."</td>";
		$therm .= "<td>".$data["type"]."</td>";
		$therm .= "<td>".$data["fhydr"]."</td>";
		$therm .= "</tr>";
		$i++;
		}
	$therm .= "</table>";
return $therm;
}


//Κατασκευή πίνακα vivliothiki_cold_eer
function create_library_cold_p_eer(){

	$cold = "<h6>Δείκτης ενεργειακής αποδοτικότητας (EER)</h6>";

	$cold .= "Η τιμή του SEER προσδιορίζεται σε συγκεκριμένες συνθήκες εξωτερικού περιβάλλοντος και θερμοκρασίας προσαγωγής και επιστροφής ψυκτικού μέσου. 
	Η απόδοση των ψυκτών και αντλιών θερμότητας εξαρτάται επίσης και από την πηγή θερμότητας που αξιοποιούν για τη λειτουργία τους και μπορεί να είναι ο αέρας, 
	το έδαφος, τα υπόγεια & επιφανειακά νερά, το θαλασσινό νερό, τα καυσαέρια κινητήρων (π.χ. Σ.Η.Θ.), η ηλιακή ενέργεια κ.ά.. Για τις τοπικές αερόψυκτες μονάδες 
	αντλιών θερμότητας (διαιρούμενου ή ενιαίου τύπου), για τις οποίες δεν υπάρχουν διαθέσιμα στοιχεία, ο δείκτης αποδοτικότητας EER για του υπολογισμούς 
	της ενεργειακής απόδοσης του προς επιθεώρηση κτηρίου λαμβάνεται: 
	Α:Τοπικές ή ημικεντρικές μονάδες απ’ευθείας εκτόνωσης με θερμαινόμενο μέσο τον αέρα:
	<ol>
	<li>SEER = 0,60 ∙ SEER<sub>ΕΣ</sub> (αν πληρούν τον κανονισμό Ενεργειακής Επισήμανσης της ΕΕ 626/2011)</li>
	<li>SEER = EER για εξωτερική θερμοκρασία 35<sup>o</sup>Cκαι εσωτερική θερμοκρασία 26<sup>o</sup>C. (εάν δεν πληρούν τον κανονισμό Ενεργειακής Επισήμανσης της ΕΕ 626/2011)</li>
	<li>SEER = 1.7 για συστήματα εγκατεστημένα πριν το 1990 ή αν δεν είναι γνωστή η εγκατάσταση</li>
	<li>SEER = 2.2 για συστήματα εγκατεστημένα μεταξύ του 1990 και του 2000</li>
	<li>SEER = 2.5 για συστήματα εγκατεστημένα μετά το 2001.</li>
	</ol>
	Β. Αντλίες θερμότητας με θερμαινόμενο μέσο το νερό:
	<ol>
	<li>SEER/EER = a x Y<sup>b</sup> (ως δύναμη) (Συντελεστή υπερδιαστασιολόγησης Υ για Screw πιν 4.5γ ΤΟΤΕΕ-20701-1)</li>
	<li>SEER/EER = a x ln(Y) + b (ως λογαριθμικός) (Συντελεστή υπερδιαστασιολόγησης Υ για Recipr,WCA,WCB πιν 4.5γ ΤΟΤΕΕ-20701-1)</li>
	<li>SCOP = 2,35 ∙ (ηs35<sup>oCΘΚ</sup> + 3%) (αν πληρούν τον κανονισμό Ενεργειακής Επισήμανσης της ΕΕ 626/2011 σε κάθε άλλη περίπτωση όπως θερμαντικά σώματα,, κονβέκτορες, κλπ)</li>
	<li>SEER = EER για εξωτερική θερμοκρασία 35<sup>o</sup>Cκαι ψυχόμενου μέσου 7<sup>o</sup>C για θερμαινόμενο μέσο νερό (εάν δεν πληρούν τον κανονισμό Ενεργειακής Επισήμανσης της ΕΕ 626/2011)</li>
	<li>SEER = EER για εξωτερική θερμοκρασία 15<sup>o</sup>Cκαι ψυχόμενου μέσου 7<sup>o</sup>C για γεωθερμική αντλία (εάν δεν πληρούν τον κανονισμό Ενεργειακής Επισήμανσης της ΕΕ 626/2011)</li>
	<li>SEER = 2.2 για συστήματα εγκατεστημένα πριν το 1990 ή αν δεν είναι γνωστή η εγκατάσταση</li>
	<li>SEER = 2.7 για συστήματα εγκατεστημένα μεταξύ του 1990 και του 2000</li>
	<li>SEER = 3.0 για συστήματα εγκατεστημένα μετά το 2001.</li>
	</ol>";
return $cold;
}


//Κατασκευή πίνακα vivliothiki_cold_d
function create_library_cold_d(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_cold_d";
	$columns = "*";
	$where1 = array("t"=>1);
	$where2 = array("t"=>2);
	$p_array = array("0", "20 - 100", "100 - 200", "200 - 300", "300 - 400", ">400");
	$categories = "<td>Μόνωση κτηρίου αναφοράς [%]</td>
	<td>Μόνωση ίση με την ακτίνα σωλήνων [%]</td>
	<td>Ανεπαρκής μόνωση [%]</td>
	<td>Χωρίς μόνωση [%]</td>";
	
	$data_table = $database->select($table,$columns);
	
	$cold = "<h6>Βαθμός απόδοσης δικτύου διανομής ψύξης (Ποσοστό θερμικών απωλειών)</h6>";
	$cold .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$cold .= "<tr class=\"info\">
	<td rowspan=\"2\" width=\"5%\">α/α</td>
	<td rowspan=\"2\">Θερμική ή ψυκτική ισχύς δικτύου διανομής [kW]</td>
	<td colspan=\"4\">Διέλευση σε εσωτερικούς χώρους ή/και 20% σε εξωτερικούς χώρους</td>
	<td colspan=\"4\">Διέλευση > 20% σε εξωτερικούς χώρους</td>
	</tr><tr class=\"info\">".$categories.$categories."</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$cold .= "<tr>";
		$cold .= "<td>".$i."</td>";
		$cold .= "<td>".$p_array[$data["p"]]."</td>";
		$cold .= "<td>".$data["esw1"]."</td>";
		$cold .= "<td>".$data["esw2"]."</td>";
		$cold .= "<td>".$data["esw3"]."</td>";
		$cold .= "<td>".$data["esw4"]."</td>";
		$cold .= "<td>".$data["eksw1"]."</td>";
		$cold .= "<td>".$data["eksw2"]."</td>";
		$cold .= "<td>".$data["eksw3"]."</td>";
		$cold .= "<td>".$data["eksw4"]."</td>";
		$cold .= "</tr>";
		$i++;
		}
		
	$cold .= "</table>";
	
	return $cold;
}

//Κατασκευή πίνακα vivliothiki_cold_p_nem_elec
function create_library_cold_p_nem(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_cold_p_nem";
	$columns = "*";
	$data_table = $database->select($table,$columns);
	
	$cold = "<h6>Απόδοση εκπομπής n<sub>em</sub> τερματικών μονάδων ψύξης</h6>";

	$cold .= "<table class=\"table table-bordered table-hover\">";
	$cold .= "<tr class=\"info\">
	<td>α/α</td>
	<td>Τύπος τερματικής μονάδας</td>
	<td>n<sub>em</sub></td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$cold .= "<tr>";
		$cold .= "<td>".$i."</td>";
		$cold .= "<td>".$data["type"]."</td>";
		$cold .= "<td>".$data["nem"]."</td>";
		$cold .= "</tr>";
		$i++;
		}
	$cold .= "</table>";
return $cold;
}

//Κατασκευή πίνακα vivliothiki_cold_p_fim
function create_library_cold_p_fim(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_cold_p_fim";
	$columns = "*";
	$data_table = $database->select($table,$columns);
	
	$cold = "<h6>Παράγοντας της διακοπτόμενης λειτουργίας f<sub>im</sub></h6>";
	
	$cold .= "<table class=\"table table-bordered table-hover\">";
	$cold .= "<tr class=\"info\">
	<td>α/α</td>
	<td>Τύπος τερματικής μονάδας</td>
	<td>f<sub>im</sub></td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$cold .= "<tr>";
		$cold .= "<td>".$i."</td>";
		$cold .= "<td>".$data["type"]."</td>";
		$cold .= "<td>".$data["fim"]."</td>";
		$cold .= "</tr>";
		$i++;
		}
	$cold .= "</table>";
return $cold;
}

//Κατασκευή πίνακα vivliothiki_cold_p_fhydr
function create_library_cold_p_fhydr(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_cold_p_fhydr";
	$columns = "*";
	$data_table = $database->select($table,$columns);
	
	$cold = "<h6>Παράγοντας για την υδραυλική ισορροπία f<sub>hydr</sub></h6>";
	
	$cold .= "<table class=\"table table-bordered table-hover\">";
	$cold .= "<tr class=\"info\">
	<td>α/α</td>
	<td>Τύπος τερματικής μονάδας</td>
	<td>f<sub>hydr</sub></td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$cold .= "<tr>";
		$cold .= "<td>".$i."</td>";
		$cold .= "<td>".$data["type"]."</td>";
		$cold .= "<td>".$data["fhydr"]."</td>";
		$cold .= "</tr>";
		$i++;
		}
	$cold .= "</table>";
return $cold;
}

//Κατασκευή πίνακα vivliothiki_znx_d
function create_library_znx_d(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_znx_d";
	$columns = "*";
	$p_array = array("0", "50 - 200", "200 - 1000", "1000 - 4000", "4000 - 7000", ">7000");
	$categories = "<td>Μόνωση κτηρίου αναφοράς [%]</td>
	<td>Ανεπαρκής μόνωση [%]</td>
	<td>Χωρίς μόνωση [%]</td>";
	
	$data_table = $database->select($table,$columns);
	
	$znx = "<h6>Βαθμός απόδοσης δικτύου διανομής ZNX</h6>";
	$znx .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$znx .= "<tr class=\"info\">
	<td rowspan=\"2\" width=\"5%\">α/α</td>
	<td rowspan=\"2\">Ημερήσια ζήτηση ΖΝΧ (l)</td>
	<td colspan=\"3\">Χωρίς ανακυκλοφορία</td>
	<td colspan=\"3\">Με ανακυκλοφορία</td>
	</tr><tr class=\"info\">".$categories.$categories."</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$znx .= "<tr>";
		$znx .= "<td>".$i."</td>";
		$znx .= "<td>".$p_array[$data["p"]]."</td>";
		$znx .= "<td>".$data["xwris1"]."</td>";
		$znx .= "<td>".$data["xwris2"]."</td>";
		$znx .= "<td>".$data["xwris3"]."</td>";
		$znx .= "<td>".$data["me1"]."</td>";
		$znx .= "<td>".$data["me2"]."</td>";
		$znx .= "<td>".$data["me3"]."</td>";
		$znx .= "</tr>";
		$i++;
		}
		
	$znx .= "</table>";
	
	return $znx;
}

//Κατασκευή πίνακα vivliothiki_znx_a
function create_library_znx_a(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_znx_a";
	$columns = "*";
	
	$data_table = $database->select($table,$columns);
	
	$znx = "<h6>Απώλειες τερματικών μονάδων ΖΝΧ</h6>";
	$znx .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$znx .= "<tr class=\"info\">
	<td rowspan=\"2\" width=\"5%\">α/α</td>
	<td rowspan=\"2\">Τύπος</td>
	<td rowspan=\"2\">Θερμικές απώλειες</td>
	<td colspan=\"2\">Πλευρικές απώλειες</td>
	</tr>
	<tr class=\"info\">
	<td>Τοποθέτηση εσωτερικά</td>
	<td>Τοποθέτηση εξωτερικά</td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$znx .= "<tr>";
		$znx .= "<td>".$i."</td>";
		$znx .= "<td>".$data["type"]."</td>";
		$znx .= "<td>".$data["t"]."</td>";
		$znx .= "<td>".$data["in_s"]."</td>";
		$znx .= "<td>".$data["out_s"]."</td>";
		$znx .= "</tr>";
		$i++;
		}
		
	$znx .= "</table>";
	
	return $znx;
}


//Κατασκευή πίνακα vivliothiki_lights_lm
function create_library_lights_lm(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_lights_lm";
	$columns = "*";
	
	$data_table = $database->select($table,$columns);
	
	$lights = "<h6>Πίνακας 5.1 - Τυπικές τιμές (όχι μέγιστες) φωτεινής δραστικότητας (απόδοσης) λαμπτήρων</h6>";
	$lights .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$lights .= "<tr class=\"info\">
	<td width=\"5%\">α/α</td>
	<td>Τύπος</td>
	<td>Φωτεινή δραστικότητα [lm/W]</td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$lights .= "<tr>";
		$lights .= "<td>".$i."</td>";
		$lights .= "<td>".$data["type"]."</td>";
		$lights .= "<td>".$data["lm_min"]." - ".$data["lm_max"]."</td>";
		$lights .= "</tr>";
		$i++;
		}
		
	$lights .= "</table>";
	
	return $lights;
}

//Κατασκευή πίνακα vivliothiki_lights_density
function create_library_lights_density(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_lights_density";
	$columns = "*";
	
	$data_table = $database->select($table,$columns);
	
	$lights = "<h6>Πίνακας 5.1α - Τυπικές τιμές πυκνότητας ισχύος φωτισμού ανά 100lux, για επιθεώρηση κτιρίων</h6>";
	$lights .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$lights .= "<tr class=\"info\">
	<td width=\"5%\">α/α</td>
	<td>Τύπος</td>
	<td>Πυκνότητα ισχύος /100lux [W/m<sup>2</sup>/100lx]</td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$lights .= "<tr>";
		$lights .= "<td>".$i."</td>";
		$lights .= "<td>".$data["type"]."</td>";
		$lights .= "<td>".$data["d"]."</td>";
		$lights .= "</tr>";
		$i++;
		}
		
	$lights .= "</table>";
	
	return $lights;
}

//Κατασκευή πίνακα vivliothiki_lights_fd
function create_library_lights_fd(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_lights_fd";
	$columns = "*";
	
	$data_table = $database->select($table,$columns);
	
	$lights = "<h6>Πίνακας 5.3 - Τυπικές τιμές συντελεστή επίδρασης φυσικού φωτισμού λόγω χρήσης αυτοματισμών ελέγχου</h6>";
	$lights .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$lights .= "<tr class=\"info\">
	<td width=\"5%\">α/α</td>
	<td>Διατάξεις αυτοματισμών ελέγχου για την αξιοποίηση φυσικού φωτισμού</td>
	<td>F<sub>D</sub></td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$lights .= "<tr>";
		$lights .= "<td>".$i."</td>";
		$lights .= "<td>".$data["type"]."</td>";
		$lights .= "<td>".$data["fd"]."</td>";
		$lights .= "</tr>";
		$i++;
		}
		
	$lights .= "</table>";
	
	return $lights;
}

//Κατασκευή πίνακα vivliothiki_lights_fο
function create_library_lights_fο(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_lights_fo";
	$columns = "*";
	
	$data_table = $database->select($table,$columns);
	
	$lights = "<h6>Πίνακας 5.3 - Τυπικές τιμές συντελεστή επίδρασης παρουσίας ή απουσίας χρηστών</h6>";
	$lights .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$lights .= "<tr class=\"info\">
	<td width=\"5%\">α/α</td>
	<td>Συστήματα</td>
	<td>F<sub>ο</sub></td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$lights .= "<tr>";
		$lights .= "<td>".$i."</td>";
		$lights .= "<td>".$data["type"]."</td>";
		$lights .= "<td>".$data["fo"]."</td>";
		$lights .= "</tr>";
		$i++;
		}
		
	$lights .= "</table>";
	
	return $lights;
}

//Κατασκευή πίνακα διατάξεων αυτόματου ελέγχου
function create_library_aytomatismoi(){

	$database = new medoo(DB_NAME);
	$table="vivliothiki_auto";
	$columns = "*";
	
	$array_type=array(1,2,3);
	$array_typename=array(
		1=>"Συστήματα παραγωγής, διανομής & εκπομπής θέρμανσης / ψύξης με θερμική αδράνεια 
		(θερμαντικά σώματα, ενδοδαπέδια – ενδοτοίχια θέρμανση, ψυχόμενες οροφές)",
		2=>"Λοιπά συστήματα παραγωγής, διανομής & εκπομπής θέρμανσης / ψύξης (fancoils, συστήματα αέρα)",
		3=>"Συστήματα αερισμού κτηρίων τριτογενή τομέα"
	);
	$array_auto=array("A","B","C","D");
	$array_autogr=array("Α","Β","Γ","Δ");
	
	$txt = "<div class=\"box\">";
	$txt .= "<div class=\"box-header\">Πίνακας 5.5. Κατηγορίες διατάξεων ελέγχου & αυτοματισμών</div>";
	$txt .= "<div class=\"box-body table-responsive no-padding\">";
	$txt .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$txt .= "<tr>
	<th>Περιγραφή διατάξεων ελέγχου ανά κατηγορία</th>
	<th>Κατηγορία</th>
	</tr>";
	
	$i=0;
	foreach($array_auto as $auto){
		$txt .= "<tr><td>";
		foreach($array_type as $type){
			$where=array("AND"=>array("auto"=>$auto,"category"=>$type));
			$data_tb = $database->select($table,$columns,$where);
			
			$txt .= "<b>".$array_typename[$type]."</b><br/>";
			$txt .= "<ol>";
				foreach($data_tb as $data){
					$txt .= "<li>".$data["name"]."</li>";
				}
			$txt .= "</ol>";
		}
		$txt .= "</td><td>".$array_autogr[$i]."</td></tr>";
		$i++;
	}
	
	$txt .= "</table>";
	$txt .= "</div>";//box-body
	$txt .= "<div class=\"box-footer\"><span class=\"no-margin pull-right\">TOTEE-20701 (Κεφ.6.2)</span></div>";//box-footer
	$txt .= "</div>";//box
	
	return $txt;
}

//Κατασκευή πίνακα ανηγμένης θερμοχωρητικότητας
function create_library_ktiriocm(){
	$database = new medoo(DB_NAME);
	$table="vivliothiki_thermocm";
	$columns = "*";
	
	$data_table = $database->select($table,$columns);
	
	$txt = "<h6>Πίνακας 3.14. Ανηγμένη θερμοχωρητικότητα για τυπικές κατασκευές ανά m<sup>2</sup> δαπέδου.</h6>";
	$txt .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$txt .= "<tr class=\"info\">
	<td>Κατηγορία</td>
	<td>Περιγραφή</td>
	<td>Ανηγμένη θερμοχωρητικότητα [kJ/(m<sup>2</sup>.K)]</td>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){		
		$txt .= "<tr>";
		$txt .= "<td>".$data["id"]."</td>";
		$txt .= "<td>".$data["name"]."</td>";
		$txt .= "<td>".$data["cm"]."</td>";
		$txt .= "</tr>";
		$i++;
		}
		
	$txt .= "</table>";
	
	return $txt;
}


//ΒΙΒΛΙΟΘΗΚΕΣ - ΠΑΡΕΜΒΑΣΕΙΣ
//Κατασκευή πίνακα vivliothiki_ummax
function create_library_parembvaseis(){
	
	$database = new medoo(DB_NAME);
	$table="vivliothiki_paremvaseis";
	$columns = "*";
	
	$data_table = $database->select($table,$columns);	
	
	$type = array(
	"",
	"1. Αντικατάσταση κουφωμάτων και συστημάτων σκίασης",
	"2.Τοποθέτηση θερμομόνωσης στο κέλυφος του κτηρίου συμπεριλαμβανομένου του δώματος / στέγης και της πιλοτής",
	"3.Αναβάθμιση συστήματος θέρμανσης και συστήματος παροχής ζεστού νερού χρήσης"
	);
	
	$peremvaseis = "<div class=\"box\">";
	$peremvaseis .= "<div class=\"box-header\">Πίνακας επιλέξιμων παρεμβάσεων εξοικονομώ Ι.</div>";
	$peremvaseis .= "<div class=\"box-body table-responsive no-padding\">";
	$peremvaseis .= "<table border=\"1\" class=\"table table-bordered table-hover\">";
	$peremvaseis .= "<tr>
	<th width=\"5%\">α/α</th>
	<th width=\"25%\">Κατηγορία</th>
	<th width=\"20%\">Παρέμβαση</th>
	<th width=\"40%\">Περιγραφή</th>
	<th width=\"10%\">Κόστος</th>
	</tr>";
	
		$i=1;
		foreach($data_table as $data){
		$peremvaseis .= "<tr>";
		$peremvaseis .= "<td>".$i."</td>";
		$peremvaseis .= "<td>".$type[$data["category"]]."</td>";
		$peremvaseis .= "<td>".$data["name"]."</td>";
		$peremvaseis .= "<td>".$data["desc"]."</td>";
		$peremvaseis .= "<td>".$data["value"]."</td>";
		$peremvaseis .= "</tr>";
		$i++;
		}
	$peremvaseis .= "</table>";
	$peremvaseis .= "</div>";//box-body
	$peremvaseis .= "</div>";//box
	
	return $peremvaseis;
}

?>