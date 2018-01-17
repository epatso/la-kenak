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
require("include_check.php");
//confirm_logged_in();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
	<h1>
	La-kenak
	<small>Κλιματικά δεδομένα</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-university"></i> Βιβλιοθήκες</a></li>
	<li class="active"> Κλιματικά δεδομένα</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
<div class="col-md-12">
		
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs-inside-map" data-toggle="tab">
					<i class="fa fa-map"></i> Σταθμοί μέτρησης</a>
				</li>
				<li><a href="#tabs-inside-1" data-toggle="tab">
					<i class="fa fa-thermometer-full"></i> Θερμοκρασία</a>
				</li>
				<li><a href="#tabs-inside-2" data-toggle="tab">
					<i class="fa fa-thermometer"></i> Βαθμοημέρες</a>
				</li>
				<li><a href="#tabs-inside-3" data-toggle="tab">
					<i class="fa fa-tint"></i> Υγρασία</a>
				</li>
				<li><a href="#tabs-inside-4" data-toggle="tab">
					<i class="fa fa-flag"></i> Άνεμος</a>
				</li>
				<li><a href="#tabs-inside-5" data-toggle="tab">
					<i class="fa fa-sun-o"></i> Ηλιακή ακτινοβολία</a>
				</li>
				<li><a href="#tabs-inside-6" data-toggle="tab">
					<i class="fa fa-tint"></i> Νερό δικτύου</a>
				</li>
				<li><a href="#tabs-inside-7" data-toggle="tab">
					<i class="fa fa-sun-o"></i> συνα</a>
				</li>
				<li><a href="#tabs-inside-8" data-toggle="tab">
					<i class="fa fa-tint"></i> Βροχόπτωση (ΕΜΥ)</a>
				</li>
				<li><a href="#tabs-inside-9" data-toggle="tab">
					<i class="fa fa-sun-o"></i> Μέση μηνιαία ηλιακή ακτινοβολία</a>
				</li>
			</ul>
		<div class="tab-content">
			<div class="tab-pane" id="tabs-inside-1">
				<div class="tabbable tabs-left"> <!-- Only required for left/right tabs -->
					<ul class="nav nav-tabs">
					<li class="active"><a href="#tab11" data-toggle="tab">Μέση μηνιαία Τ 24ώρου</a></li>
					<li><a href="#tab12" data-toggle="tab">Μέση μηνιαία Τ (περ. ηλιοφάνειας)</a></li>
					<li><a href="#tab13" data-toggle="tab">Μέση μηνιαία μέγιστη Τ</a></li>
					<li><a href="#tab14" data-toggle="tab">Μέση μηνιαία ελάχιστη Τ</a></li>
					<li><a href="#tab15" data-toggle="tab">Μέση μηνιαία απολύτως μέγιστη Τ</a></li>
					<li><a href="#tab16" data-toggle="tab">Μέση μηνιαία απολύτως ελάχιστη Τ</a></li>
					</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="tab11">
					Πίνακας 3.1. Μέση μηνιαία θερμοκρασία 24ώρου [<sup>o</sup>C] 
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
					<?php
					echo create_library_climate("vivliothiki_climate31");
					?>
					</div>
					
					<div class="tab-pane" id="tab12">
					Πίνακας 3.2. Μέση μηνιαία θερμοκρασία κατά τη διάρκεια της ημέρας [<sup>o</sup>C] (μέση θερμοκρασία για την περίοδο ηλιοφάνειας της ημέρας)
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
					<?php
					echo create_library_climate("vivliothiki_climate32");
					?>
					</div>
					
					<div class="tab-pane" id="tab13">
					Πίνακας 3.3. Μέση μέγιστη μηνιαία θερμοκρασία [<sup>o</sup>C]
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
					<?php
					echo create_library_climate("vivliothiki_climate33");
					?>
					</div>
					
					<div class="tab-pane" id="tab14">
					Πίνακας 3.4. Μέση ελάχιστη μηνιαία θερμοκρασία [<sup>o</sup>C]
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
					<?php
					echo create_library_climate("vivliothiki_climate34");
					?>
					</div>
					
					<div class="tab-pane" id="tab15">
					Πίνακας 3.5. Μέση απολύτως μέγιστη μηνιαία θερμοκρασία [<sup>o</sup>C]
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
					<?php
					echo create_library_climate("vivliothiki_climate35");
					?>
					</div>
					
					<div class="tab-pane" id="tab16">
					Πίνακας 3.6. Μέση απολύτως ελάχιστη μηνιαία θερμοκρασία [<sup>o</sup>C]
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
					<?php
					echo create_library_climate("vivliothiki_climate36");
					?>
					</div>
				</div>	
				</div>
			</div>
			
			<div class="tab-pane" id="tabs-inside-2">
				<div class="tabbable tabs-left"> <!-- Only required for left/right tabs -->
					<ul class="nav nav-tabs">
					<li class="active"><a href="#tab21" data-toggle="tab">Βαθμοημέρες θέρμανσης</a></li>
					<li><a href="#tab22" data-toggle="tab">Βαθμοώρες ψύξης</a></li>
					</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="tab21">
					Πίνακας 3.7. Βαθμοημέρες θέρμανσης DD με θερμοκρασίες αναφοράς 18<sup>o</sup>C
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
					<?php
					echo create_library_climate("vivliothiki_climate37");
					?>
					</div>
					
					<div class="tab-pane" id="tab22">
					Πίνακας 3.8. Βαθμοώρες ψύξης CDH με θερμοκρασίες αναφοράς 26<sup>o</sup>C
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
					<?php
					echo create_library_climate("vivliothiki_climate38");
					?>
					</div>
					
				</div>
				</div>
			</div>
			
			<div class="tab-pane" id="tabs-inside-3">
				<div class="tabbable tabs-left"> <!-- Only required for left/right tabs -->
					<ul class="nav nav-tabs">
					<li class="active"><a href="#tab31" data-toggle="tab">Μέση μηνιαία σχετική υγρασία</a></li>
					<li><a href="#tab32" data-toggle="tab">Μέση μηνιαία ειδική υγρασία</a></li>
					</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="tab31">
					Πίνακας 3.9. Μέση μηνιαία σχετική υγρασία [%]
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
					<?php
					echo create_library_climate("vivliothiki_climate39");
					?>
					</div>
					
					<div class="tab-pane" id="tab32">
					Πίνακας 3.10. Μέση μηνιαία ειδική υγρασία [%]
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
					<?php
					echo create_library_climate("vivliothiki_climate310");
					?>
					</div>
					
				</div>
				</div>
			</div>
			
			<div class="tab-pane" id="tabs-inside-4">
				<div class="tabbable tabs-left"> <!-- Only required for left/right tabs -->
					<ul class="nav nav-tabs">
					<li class="active"><a href="#tab41" data-toggle="tab">Μέση ταχύτητα ανέμου</a></li>
					</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="tab41">
					Πίνακας 3.11. Μέση ταχύτητα του ανέμου [m/s]
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
					<?php
					echo create_library_climate("vivliothiki_climate311");
					?>
					</div>
					
				</div>
				</div>
			</div>
			
			<div class="tab-pane" id="tabs-inside-5">
				<div class="tabbable tabs-left"> <!-- Only required for left/right tabs -->
					<ul class="nav nav-tabs">
					<li class="active"><a href="#tab51" data-toggle="tab">Μέση μηνιαία ολική ηλιακή ακτινοβολία (οριζόντιο)</a></li>
					<li><a href="#tab52" data-toggle="tab">Μέση μηνιαία διάχυτη ηλιακή ακτινοβολία (οριζόντιο)</a></li>
					<li><a href="#tab53" data-toggle="tab">Μέσος μηνιαίος συντελεστής αιθριότητας</a></li>
					<li><a href="#tab54" data-toggle="tab">Μηνιαία ηλιακή ακτινοβολία (Βέλτιστη κλίση)</a></li>
					</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="tab51">
					Πίνακας 4.1. Μέση μηνιαία ολική ηλιακή ακτινοβολία στο οριζόντιο επίπεδο [kWh/m<sup>2</sup>.mo]
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
					<?php
					echo create_library_climate("vivliothiki_climate41");
					?>
					</div>
					
					<div class="tab-pane" id="tab52">
					Πίνακας 4.2. Μέση μηνιαία διάχυτη ηλιακή ακτινοβολία στο οριζόντιο επίπεδο [kWh/m<sup>2</sup>.mo]
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
					<?php
					echo create_library_climate("vivliothiki_climate42");
					?>
					</div>
					
					<div class="tab-pane" id="tab53">
					Πίνακας 4.3. Μέσος μηνιαίος συντελεστής αιθριότητας k<sub>t</sub>
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
					<?php
					echo create_library_climate("vivliothiki_climate43");
					?>
					</div>
					
					<div class="tab-pane" id="tab54">
					Πίνακας 4.4. Μηνιαία ηλιακή ακτινοβολία για τις βέλτιστες γωνίες κλίσης β των Φ/Β (kWh/m<sup>2</sup>.mo), και 
					βέλτιστη κλίση σε ετήσια (Ε) βάση, χειμερινή (Χ) και θερινή (Θ) περίοδο για διάφορες περιοχές της Ελλάδας
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
					<?php
					echo create_library_climate("vivliothiki_climate44");
					?>
					</div>
					
				</div>	
				</div>
			</div>
			
			<div class="tab-pane" id="tabs-inside-6">
				<div class="tabbable tabs-left"> <!-- Only required for left/right tabs -->
					<ul class="nav nav-tabs">
					<li class="active"><a href="#tab61" data-toggle="tab">Μέση θερμοκρασία νερού δικτύου (ΕΛΟΤ)</a></li>
					<li><a href="#tab62" data-toggle="tab">Μέση θερμοκρασία νερού δικτύου (ΚΕΝΑΚ)</a></li>
					</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="tab61">
					Πίνακας 6.1. Μέση θερμοκρασία νερού δικτύου [<sup>o</sup>C] σύμφωνα με ΕΛΟΤ 1291
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
					<?php
					echo create_library_climate("vivliothiki_climate61");
					?>
					</div>
					
					<div class="tab-pane" id="tab62">
					Πίνακας 6.2. Μέση μηνιαία θερμοκρασία νερού δικτύου [<sup>o</sup>C] για τις διάφορες κλιματικές ζώνες
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
					<?php
					echo create_library_climate("vivliothiki_climate62");
					?>
					</div>
					
				</div>
				</div>
			</div>
			
			
			<div class="tab-pane" id="tabs-inside-7">
				<div class="tabbable tabs-left"> <!-- Only required for left/right tabs -->
					<ul class="nav nav-tabs">
					<li class="active"><a href="#tab71" data-toggle="tab">Κατοικίες</a></li>
					<li><a href="#tab72" data-toggle="tab">3γενής τομέας</a></li>
					</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="tab71">
					Πίνακας 5.8. Συντελεστής αξιοποίησης ηλιακής ακτινοβολίας για παραγωγή ΖΝΧ σε κατοικίες
					<?php
					echo create_library_syna("ktiria");
					?>
					</div>
					
					<div class="tab-pane" id="tab72">
					Πίνακας 5.9. Συντελεστής αξιοποίησης ηλιακής ακτινοβολίας για παραγωγή ΖΝΧ σε κτίρια 3γενούς τομέα
					<?php
					echo create_library_syna("3genis");
					?>
					</div>
					
				</div>
				</div>
			</div>
			
			<div class="tab-pane" id="tabs-inside-8">
				<div class="tabbable tabs-left"> <!-- Only required for left/right tabs -->
					<ul class="nav nav-tabs">
					<li class="active"><a href="#tab81" data-toggle="tab">Μέση μηνιαία βροχόπτωση</a></li>
					<li><a href="#tab82" data-toggle="tab">Ομβροθερμικό διάγραμμα</a></li>
					</ul>

				<div class="tab-content">
					<div class="tab-pane active" id="tab81">
					Μέση μηνιαία βροχόπτωση [mm]
					<br/> <i>Πατήστε σε κάθε γραμμή για διάγραμμα</i>
						<?php
						echo create_library_climate("vivliothiki_climate999");
						?>
					</div>
				
					<div class="tab-pane" id="tab82">
					Σχεδιάστε το ομβροθερμικό διάγραμμα χρησιμοποιώντας τη μέση θερμοκρασία 24ώρου και τη μέση μηνιαία βροχόπτωση. 
					<br/>
					<br/>
					
					Επιλέξτε περιοχή:
					<select id="place_omvrotherm" name="place_omvrotherm" onchange="get_climate_omvrotherm();">
						<option value="no" selected="selected">Επιλέξτε περιοχή....</option>
						<?php
						echo create_select_optionsid("vivliothiki_climate999","place");
						?>
					</select>
					<br/><br/>
					<br/><br/>
					<div id="img_omvrotherm"></div>
					</div>
					
				</div>
					
				</div>
			</div>
			
			<div class="tab-pane" id="tabs-inside-9">
				<select id="place_solar" name="place_solar" onchange="get_climate_b();">
					<option value="no" selected="selected">Επιλέξτε περιοχή....</option>
					<option value="Αθήνα (Ελληνικό)">Αθήνα (Ελληνικό)</option>
					<option value="Αθήνα (Φιλαδέλφεια)">Αθήνα (Φιλαδέλφεια)</option>
					<option value="Αγρίνιο">Αγρίνιο</option>
					<option value="Αγχίαλος">Αγχίαλος</option>
					<option value="Αλεξανδρούπολη">Αλεξανδρούπολη</option>
					<option value="Αλίαρτος">Αλίαρτος</option>
					<option value="Ανδραβίδα">Ανδραβίδα</option>
					<option value="Άραξος">Άραξος</option>
					<option value="Άργος (Πυργέλα)">Άργος (Πυργέλα)</option>
					<option value="Αργοστόλι">Αργοστόλι</option>
					<option value="Άρτα">Άρτα</option>
					<option value="Ζάκυνθος">Ζάκυνθος</option>
					<option value="Ηράκλειο">Ηράκλειο</option>
					<option value="Θεσαλλονίκη">Θεσαλλονίκη</option>
					<option value="Ιεράπετρα">Ιεράπετρα</option>
					<option value="Ιωάννινα">Ιωάννινα</option>
					<option value="Καλαμάτα">Καλαμάτα</option>
					<option value="Καστοριά">Καστοριά</option>
					<option value="Κέρκυρα">Κέρκυρα</option>
					<option value="Κομοτηνή">Κομοτηνή</option>
					<option value="Κόνιτσα">Κόνιτσα</option>
					<option value="Κόρινθος">Κόρινθος</option>
					<option value="Κύθηρα">Κύθηρα</option>
					<option value="Λαμία">Λαμία</option>
					<option value="Λάρισα">Λάρισα</option>
					<option value="Λήμνος">Λήμνος</option>
					<option value="Μεθώνη">Μεθώνη</option>
					<option value="Μήλος">Μήλος</option>
					<option value="Μυτιλήνη">Μυτιλήνη</option>
					<option value="Νάξος">Νάξος</option>
					<option value="Πάρος">Πάρος</option>
					<option value="Πάτρα">Πάτρα</option>
					<option value="Πύργος">Πύργος</option>
					<option value="Ρέθυμνο">Ρέθυμνο</option>
					<option value="Ρόδος">Ρόδος</option>
					<option value="Σάμος">Σάμος</option>
					<option value="Σέρρες">Σέρρες</option>
					<option value="Σητεία">Σητεία</option>
					<option value="Σκύρος">Σκύρος</option>
					<option value="Σούδα">Σούδα</option>
					<option value="Σύρος">Σύρος</option>
					<option value="Τανάγρα">Τανάγρα</option>
					<option value="Τρίκαλα">Τρίκαλα</option>
					<option value="Τρίπολη">Τρίπολη</option>
					<option value="Τυμπάκιο">Τυμπάκιο</option>
					<option value="Χανιά">Χανιά</option>
					<option value="Χίος">Χίος</option>
					<option value="Χρυσούπολη">Χρυσούπολη</option>
				</select>
				
				<select id="b_solar" name="b_solar" onchange="get_climate_b()">
					<option value="no" selected="selected">Επιλέξτε κλίση....</option>
					<option value="0">Οριζόντιος 0<sup>o</sup></option>
					<option value="45">Κεκλιμένος 45<sup>o</sup></option>
					<option value="90">Κατακόρυφος 90<sup>o</sup></option>
				</select>
				
				<select id="g_solar" name="g_solar" disabled="disabled" onchange="get_climate_b()">
					<option value="no" selected="selected">Επιλέξτε προσανατολισμό....</option>
					<option value="0">Β 0<sup>o</sup></option>
					<option value="45">ΒΑ / ΒΔ 45/315<sup>o</sup></option>
					<option value="90">Α / Δ 90/270<sup>o</sup></option>
					<option value="135">ΝΑ / ΝΔ 135/225<sup>o</sup></option>
					<option value="180">Ν 180<sup>o</sup></option>
				</select>
			<br/>
			<i>Επιλέξτε περιοχή, κλίση συλλέκτη και προσανατολισμό και πατήστε πάνω σε κάθε γραμμή για το διάγραμμα</i>
				
			<div id="climate_b_text"></div>
			<div id='wait' style="display:none;position:absolute;top:130px;left:500px;">
				<img src="images/interface/ajax-loader.gif">
				<span class="label label-info" id="wait_info"></span>
			</div>

			<script>
			function get_climate_b(){
				var place = document.getElementById('place_solar').value;
				var b = document.getElementById('b_solar').value;
				
				document.getElementById('wait_info').innerHTML="Φόρτωση:"+place;
				document.getElementById('wait').style.display="inline";
				
				if(b!="no" && b!=0){
					document.getElementById('g_solar').disabled=false;
				}else{
					document.getElementById('g_solar').value="no";
					document.getElementById('g_solar').disabled=true;
				}
				if(place=="no"){
					document.getElementById('b_solar').value="no";
					document.getElementById('g_solar').value="no";
					document.getElementById('g_solar').disabled=true;
				}
				var g = document.getElementById('g_solar').value;
				
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_vivliothikes.php?place="+place+"&b="+b+"&g="+g ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("climate_b_text").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
				}}
			}
			get_climate_b();
			</script>	
			</div>
			
			
			
			<div class="tab-pane active" id="tabs-inside-map">
			
			<?php
			$database = new medoo(DB_NAME);
			$db_table = "vivliothiki_climate_places";
			$db_columns = array ("id","place","region","zone","x","y","z");
			$data_places = $database->select($db_table,$db_columns);
			$count_places = $database->count($db_table);
			
			$xmltxt = "";
			$cattxt = "";
			
			$i=1;
				// array σε μορφή javascript
				foreach($data_places as $data){
					if($xmltxt!=""){
						$xmltxt.=",";
					}
				$xmltxt .= "[".$data["id"].",'".$data["place"]."','".$data["region"]."','".$data["zone"]."',".$data["x"].",'".$data["y"]."',".$data["z"]."]";
				$php_points[$i][0]=$data["id"];
				$php_points[$i][1]=$data["place"];
				$php_points[$i][2]=$data["region"];
				$php_points[$i][3]=$data["zone"];
				$php_points[$i][4]=$data["x"];
				$php_points[$i][5]=$data["y"];
				$php_points[$i][6]=$data["z"];
				$i++;
				}		
			?>
			
			
			<style>
			  #mapCanvas {
				width: 100%;
				height: 500px;
				padding: 3px;
				border: 5px solid #ddd;
			  }
			  #infoPanel {
				float: left;
				margin-left: 10px;
			  }
			  #infoPanel div {
				margin-bottom: 5px;
			  }
			</style>
			<style>
		/* popup style */
		.ol-popup
		{	max-width:300px;
			min-width:100px;
			min-height:1em;
		}
		/* Image on popup */
		.ol-popup img 
		{	float: left;
			margin: 0 0.5em 0 0;
			max-width: 100px;
			max-height: 100px;
		}
		/* no image content tooltips */
		.ol-popup.tooltips img
		{	display:none;
		}

		/* Custom orange style (tips) */
		.ol-popup.tips.orange
		{	border-color:#da7;
			background-color:#eca;
		}
		.ol-popup.tips.orange .anchor::before
		{	border-color: #da7 transparent;
		}
		.ol-popup-middle.tips.orange .anchor::before
		{	border-color: transparent #da7;
		}

		/* orange style (default) */
		.ol-popup.default.orange
		{	border:4px solid #f96;
		}
		.ol-popup.default.orange .anchor::after
		{	margin: 6px /*border:4 +2 px */ -9px; 
		}
		.ol-popup-middle.default.orange .anchor::after
		{	margin: -9px 6px /*border:4 +2 px */; 
		}
		.ol-popup.default.orange .anchor::before
		{	border-color: #f96 transparent;
		}
		.ol-popup-middle.default.orange .anchor::before
		{	border-color: transparent #da7;
		}
		.ol-popup.default.orange .closeBox
		{	background-color: rgba(255, 153, 102, 0.7);
		}
		.ol-popup.default.orange .closeBox:hover
		{	background-color: rgba(255, 153, 102, 1);
		}

		
		#osminfo {
        z-index: 1;
        opacity: 0;
        position: absolute;
        bottom: 0;
        left: 0;
        margin: 0;
        background: rgba(0,60,136,0.7);
        color: white;
        border: 0;
        transition: opacity 100ms ease-in;
      }
    </style>
			
			Πόλεις (ΚΕΝΑΚ) / Νομοί (ΟΚΧΕ - geodata.gov.gr - Google Fusion Tables) 
			Ζώνες: Α<img src="images/map_pins/icon_green.png">, 
			Β<img src="images/map_pins/icon_cyan.png">, 
			Γ<img src="images/map_pins/icon_magenta.png">, 
			Δ<img src="images/map_pins/icon_red.png">, 
			
			<?php
				if($prefs_googlemaps==1){//Έχουν οριστεί χάρτες google. Φόρτωση GOOGLE MAPS
			?>
			<div id="mapCanvas"></div>
			<?php
				}//Έχουν οριστεί χάρτες google. Φόρτωση GOOGLE MAPS
			?>
			
			<?php
				if($prefs_googlemaps==0){//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
			?>
			<div id="osmmap" class="map" style="width: 100%; height: 500px;"><div id="popup"></div></div>
			<div id="osminfo"></div>
			<?php
				}//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
			?>
			
			
			<script type="text/javascript">
			var points = [
			<?php echo $xmltxt; ?>
			];
			</script>
			
			
			<?php
				if($prefs_googlemaps==0){//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
			?>
			<!--OSM MAPS-->
			<script>
			
			//ΕΙΚΟΝΙΔΙΑ
				var vectorSource = new ol.source.Vector({
					//create empty vector
				});
				var markers = [];
				//var positions = [];
				
				
				function AddMarkers() {
					
					//Εικονίδιο ΖΩΝΗ Α
					var style_zonea = new ol.style.Style({
						image: new ol.style.Icon(({
							anchor: [0.3, 24],
							anchorXUnits: 'fraction',
							anchorYUnits: 'pixels',
							opacity: 0.95,
							src: 'images/map_pins/icon_green.png'
						}))
					});
					//Εικονίδιο ΖΩΝΗ Β
					var style_zoneb = new ol.style.Style({
						image: new ol.style.Icon(({
							anchor: [0.3, 24],
							anchorXUnits: 'fraction',
							anchorYUnits: 'pixels',
							opacity: 0.95,
							src: 'images/map_pins/icon_cyan.png'
						}))
					});
					//Εικονίδιο ΖΩΝΗ Β
					var style_zonec = new ol.style.Style({
						image: new ol.style.Icon(({
							anchor: [0.3, 24],
							anchorXUnits: 'fraction',
							anchorYUnits: 'pixels',
							opacity: 0.95,
							src: 'images/map_pins/icon_magenta.png'
						}))
					});
					//Εικονίδιο ΖΩΝΗ Β
					var style_zoned = new ol.style.Style({
						image: new ol.style.Icon(({
							anchor: [0.3, 24],
							anchorXUnits: 'fraction',
							anchorYUnits: 'pixels',
							opacity: 0.95,
							src: 'images/map_pins/icon_red.png'
						}))
					});
					
					//Σταθμοί ΕΜΥ
					for (var i=0;i<points.length;i++){
						var x= points[i][5];
						var y= points[i][4];

						var iconFeature = new ol.Feature({
							geometry: new ol.geom.Point([x,y]),
							name: points[i][1],
							region: points[i][2],
							zone: points[i][3],
							z: points[i][6]
						});
						markers[i]= [x,y];
							if(points[i][3]=="a"){
								iconFeature.setStyle(style_zonea);
							}
							if(points[i][3]=="b"){
								iconFeature.setStyle(style_zoneb);
							}
							if(points[i][3]=="c"){
								iconFeature.setStyle(style_zonec);
							}
							if(points[i][3]=="d"){
								iconFeature.setStyle(style_zoned);
							}
						
						vectorSource.addFeature(iconFeature);
					}
					
					//add the feature vector to the layer vector, and apply a style to whole layer
					var vectorLayer = new ol.layer.Vector({
						title: "Σταθμοί κλιματικών",
						source: vectorSource
					});
						return vectorLayer;
				}

				
				//ΣΤΡΩΣΕΙΣ
				var layers = [
					new ol.layer.Tile({
						title: "OSM",
						baseLayer: true,
						source: new ol.source.OSM()
					}),
					new ol.layer.Tile({
						title: "Κτηματολόγιο",
						baseLayer: true,
						visible: false,
						source: new ol.source.TileWMS({
						url: 'http://gis.ktimanet.gr/wms/wmsopen/wmsserver.aspx',
						params: {
						  'LAYERS': 'KTBASEMAP',
						  'TILED': true
						},
						attributions: [
							new ol.Attribution({
								html: 'Base map  © <a href="https://www.ktimanet.gr/CitizenWebApp/Orthophotographs_Page.aspx">Κτηματολόγιο Base MAP</a>'
							})
						]
						})
					}),
					new ol.layer.Tile({
						title: "Όρια ΟΤΑ (Καποδίστριας)",
						baseLayer: false,
						visible: false,
						opacity: 0.3,
						source: new ol.source.TileWMS({
						url: 'http://geodata.gov.gr/geoserver/ows?service=WMS&request=GetCapabilities',
						params: {
						  'LAYERS': 'geodata.gov.gr:0adb0521-2223-43cd-96d3-d816ad7a193c',
						  'TILED': true
						},
						attributions: [
							new ol.Attribution({
								html: 'Layer  © <a href="http://geodata.gov.gr">Geodata.gov.gr</a>'
							})
						]
						})
					}),
					new ol.layer.Tile({
						title: "Δήμοι (Καλλικράτης)",
						baseLayer: false,
						visible: false,
						opacity: 0.3,
						source: new ol.source.TileWMS({
						url: 'http://geodata.gov.gr/geoserver/ows?service=WMS&request=GetCapabilities',
						params: {
						  'LAYERS': 'geodata.gov.gr:c7b5978b-aca9-4d74-b8a5-d3a48d02f6d0',
						  'TILED': true
						},
						attributions: [
							new ol.Attribution({
								html: 'Layer  © <a href="http://geodata.gov.gr">Geodata.gov.gr</a>'
							})
						]
						})
					}),
					new ol.layer.Tile({
						title: "Νομοί (Ελ.Στατ)",
						baseLayer: false,
						visible: false,
						opacity: 0.5,
						source: new ol.source.TileWMS({
						url: 'http://geodata.gov.gr/geoserver/ows?service=WMS&request=GetCapabilities',
						params: {
						  'LAYERS': 'geodata.gov.gr:0d8c1236-b1dc-4823-85ef-35de6feb07cc',
						  'TILED': true
						},
						attributions: [
							new ol.Attribution({
								html: 'Layer  © <a href="http://geodata.gov.gr">Geodata.gov.gr</a>'
							})
						]
						})
					}),
					new ol.layer.Tile({
						title: "Σταθμοί μέτρησης ατμ. ρύπ.",
						baseLayer: false,
						visible: false,
						opacity: 0.5,
						source: new ol.source.TileWMS({
						url: 'http://geodata.gov.gr/geoserver/ows?service=WMS&request=GetCapabilities',
						params: {
						  'LAYERS': 'geodata.gov.gr:36bb763a-245d-4ada-9fb7-7304c1146fbc',
						  'TILED': true
						},
						attributions: [
							new ol.Attribution({
								html: 'Layer  © <a href="http://geodata.gov.gr">Geodata.gov.gr</a>'
							})
						]
						})
					}),
					new ol.layer.Tile({
						title: "Οικισμοί",
						baseLayer: false,
						visible: false,
						source: new ol.source.TileWMS({
						url: 'http://geodata.gov.gr/geoserver/ows?service=WMS&request=GetCapabilities',
						params: {
						  'LAYERS': 'geodata.gov.gr:f45c73bd-d733-4fe0-871b-49f270c56a75',
						  'TILED': true
						},
						attributions: [
							new ol.Attribution({
								html: 'Layer  © <a href="http://geodata.gov.gr">Geodata.gov.gr</a>'
							})
						]
						})
					})
				];
				
				
				//ΓΕΩΔΑΙΤΙΚΟ ΣΥΣΤΗΜΑ ΑΝΑΦΟΡΑΣ - (Κτηματολόγιο)
				var myProjection = new ol.proj.Projection({
					code: 'EPSG:2100',
					extent: [104022.946289, 3850785.500488, 1007956.563293, 4624047.765686],
					units: 'm'
				});   

				ol.proj.addProjection(myProjection);
				
				//ΧΑΡΤΗΣ
				var osmmap = new ol.Map({
					controls: ol.control.defaults().extend([
						new ol.control.ScaleLine(),
						new ol.control.OverviewMap(),
						new ol.control.LayerSwitcher({
							show_progress:true,
							extent: true,
							reordering: false
						})
						//new ol.control.LayerPopup()
					]),
					layers: layers,
					target: 'osmmap',
					view: new ol.View({
						projection: 'EPSG:4326',
						center: [22, 39],
						zoom: 7
					})
				});
				
				//ΣΤΡΩΣΗ ΜΕΛΕΤΩΝ (VECTOR)
				var layerMarkers = AddMarkers();
				osmmap.addLayer(layerMarkers);
				console.log(points);
				
				zoomslider = new ol.control.ZoomSlider();
				osmmap.addControl(zoomslider);
		
				//ΠΛΕΓΜΑ
				var graticule = new ol.Graticule({
					// the style to use for the lines, optional.
					strokeStyle: new ol.style.Stroke({
						color: 'rgba(255,120,0,0.9)',
						width: 2,
						lineDash: [0.5, 4]
					}),
					showLabels: true
				});
				graticule.setMap(osmmap);
				
				//ΑΝΑΖΗΤΗΣΗ
				//Τοποθεσίες
				<?php
				echo "var positions = [";
					foreach ($php_points as $points){
						echo "{ name:\"".$points[1]."\", pos:[".$points[5].", ".$points[4]."], zoom:20 },";
					}
				echo "];";
				?>
				
				
				//ΑΝΑΖΗΤΗΣΗ ΣΕ ΜΕΛΕΤΕΣ
				
				//SELECT ΜΕ ΒΑΣΗ ΤΟ OS.EXT
				var select = new ol.interaction.Select({});
				osmmap.addInteraction(select);

				// Set the control grid reference
				var search = new ol.control.SearchFeature(
					{	//target: $(".options").get(0),
						source: vectorSource,
						property: $(".options select").val()
					});
				osmmap.addControl (search);

				// Select feature when click on the reference index
				search.on('select', function(e){
						select.getFeatures().clear();
						select.getFeatures().push (e.search);
						var p = e.search.getGeometry().getFirstCoordinate();
						osmmap.getView().animate({ center:p, zoom:12 });
					});
				
				//ΣΥΝΤΕΤΑΓΜΕΝΕΣ INFO
				var mouse_position = new ol.control.MousePosition({
					coordinateFormat: ol.coordinate.createStringXY(4),
					projection: 'EPSG:4326'
				});
				osmmap.addControl(mouse_position);
				
				
				//POPUP ΒΟΗΘΕΙΑ ΣΕ MARKER
				var element = document.getElementById('popup');

				var popup = new ol.Overlay({
					element: element,
					positioning: 'bottom-center',
					stopEvent: false,
					offset: [0, -50]
				});
				osmmap.addOverlay(popup);

				// display popup on click
				osmmap.on('click', function(evt) {
					var feature;
					feature = osmmap.forEachFeatureAtPixel(evt.pixel,
					function(feature, layer) {
						return feature;
					});
					if (feature) {
						var geometry = feature.getGeometry();
						var coord = geometry.getCoordinates();
						popup.setPosition(coord);
						$(element).popover({
							'placement': 'top',
							'html': true,
							'content': 'Σταθμός: '+feature.get('name')+'<br/>Νομός: '+feature.get('region')+'<br/>Ζώνη: '+feature.get('zone')
						});
						$(element).popover('show');
					} else {
						$(element).popover('destroy');
					}
				});

				// change mouse cursor when over marker
				osmmap.on('pointermove', function(e) {
					if (e.dragging) {
						$(element).popover('destroy');
						return;
					}
					var pixel = osmmap.getEventPixel(e.originalEvent);
					var hit = osmmap.hasFeatureAtPixel(pixel);
					//osmmap.getTarget().style.cursor = hit ? 'pointer' : '';
				});
				
				 osmmap.on('pointermove', showInfo);
				var info = document.getElementById('osminfo');
				  function showInfo(event) {
					var features = osmmap.getFeaturesAtPixel(event.pixel);
					if (!features) {
					  info.innerText = '';
					  info.style.opacity = 0;
					  return;
					}
					var properties = features[0].getProperties();
					info.innerHTML = JSON.stringify(properties, null, 2);
					info.style.opacity = 1;
				  }
				
			</script>
			<!--OSM MAPS-->
			<?php
				}//Δεν έχουν οριστεί χάρτες google. Φόρτωση OSM
			?>
			
			
			<?php
				if($prefs_googlemaps==1){//Έχουν οριστεί χάρτες google. Φόρτωση GOOGLE MAPS
			?>
			<!--GOOGLE MAPS-->
			<script>
			var map = new google.maps.Map(document.getElementById('mapCanvas'), {
			  zoom: 6,
			  center: new google.maps.LatLng(39, 22),
			  mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			
			
			layer = new google.maps.FusionTablesLayer({
				query: {
				  select: '\'geometry\'',
				  from: '1A__i2XmEPB8k5dCHUxNtYyJfAqI8ueRQIfmjhqI'
				}
			});
			layer.setMap(map);

			var infowindow = new google.maps.InfoWindow();

			var marker, i;
			var html = new Array();
			var array_icons = new Array("icon_green.png", "icon_cyan.png", "icon_magenta.png", "icon_red.png");
			var icon;

			for (i = 0; i < points.length; i++) {
			
				var id = points[i][0];
				var place = points[i][1];
				var region = points[i][2];
				var zone = points[i][3];
				var x = points[i][4];
				var y = points[i][5];
				var z = points[i][6];
				html[i] = "<b>id:</b>"+id+"<br/>" + "<b>Όνομα:</b>"+place+"<br/>" + "<b>Περιοχή:</b>"+region+"<br/>" + "<b>Ζώνη:</b>"+zone+"<br/>" + "<b>x:</b>"+x+"<br/>" +
				"<b>y:</b>"+y+"<br/>" + "<b>z:</b>"+z+"<br/>";
			
				if(zone=="a"){icon = array_icons[0];}
				if(zone=="b"){icon = array_icons[1];}
				if(zone=="c"){icon = array_icons[2];}
				if(zone=="d"){icon = array_icons[3];}

				var myLatLng = 	new google.maps.LatLng(x, y);

				  marker = new google.maps.Marker({
					position: myLatLng,
					map: map,
					icon: 'images/map_pins/'+icon
				  });

				  google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
					  infowindow.setContent(html[i]);
					  infowindow.open(map, marker);
					}
				  })(marker, i));

			}
			
			</script>
			<!--GOOGLE MAPS-->
			<?php
				}//Έχουν οριστεί χάρτες google. Φόρτωση GOOGLE MAPS
			?>
			
			</div><!--tabs-inside-map-->
			
			
			
			
			
			<script>
			function open_popup_climate(table,id){
				
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_create_image.php?getchartclimate=1&table="+table+"&id="+id ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("climate_modal_body").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
				}}
				
				$("#modal_climate").modal("show");
			}

			function open_popup_climateb(place, column){
				
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_create_image.php?getchartclimate_b=1&place="+place+"&column="+column ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("climate_modal_body").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
				}}
				
				$("#modal_climate").modal("show");
			}
			
			//Χωρίς χρήση
			function moveToLocation(){
				var center = new google.maps.LatLng(38, 42);
				//var select = document.getElementById("place_solar").selectedIndex-1;
				//map.panTo(center);
			}
			
			//Επιστρέφει με ajax το ομβροθερμικό διάγραμμα
			function get_climate_omvrotherm(){
				var id=document.getElementById("place_omvrotherm").value;
				
				//AJAX call
				var xmlhttp=new XMLHttpRequest();
				
				xmlhttp.open("GET","includes/functions_create_image.php?getchartclimate_omvrotherm=1&id="+id ,true);
				xmlhttp.send();
				
				xmlhttp.onreadystatechange=function()  {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("img_omvrotherm").innerHTML=xmlhttp.responseText;
					document.getElementById('wait').style.display="none";
				}}
				
			}
			</script>
			<!-- ###################### Κρυφό modal_climate για εμφάνιση ###################### -->
			<div id="modal_climate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h6 id="myModalLabel">Εμφάνιση κλιματικών διαγραμμάτων περιοχής</h6>
				</div>

				<div class="modal-body">
				<span id="climate_modal_body"></span>
				</div>	
				
				<div class="modal-footer">	
					<button class="btn" data-dismiss="modal" aria-hidden="true">OK</button>
				</div>
				</div>
			</div>
			</div>
			<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
			</div>
			<!--tabs content-->
		</div>
		<!--tabs-->
			
	</div><!--col-md-12-->			
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

