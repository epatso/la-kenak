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
	<small>U διαφανών</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-cogs"></i> Υπολογισμοί</a></li>
	<li class="active"> U διαφανών</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
	<div class="col-md-2">	
		<?php
		if(logged_in()){
		?>
		    <div class="btn-group">
			<button class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			<span class="fa fa-download"></span>  Ενέργειες χρήστη 
			<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
			<li><a tabindex="-1" href="#save_popup" data-toggle="modal" onclick=anoigmata_find();><i class="fa fa-download"></i> Αποθήκευση</a></li>
			<li><a tabindex="-1" href="#open_popup" data-toggle="modal" onclick=anoigmata_makeselect();><i class="fa fa-upload"></i> Ανάκτηση</a></li>
			<li><a tabindex="-1" href="#" onclick=anoigmata_print(); ><i class="fa fa-file-pdf-o"></i> Δημιουργία PDF</a></li>
			<li><a tabindex="-1" href="#help_popup" data-toggle="modal" ><i class="fa fa-question"></i> Βοήθεια</a></li>
			</ul>
			</div>
		<?php
		}
		?>	
			
		<br/><br/>
			<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Βοήθεια</h4>
			<ul>
			<li>Εισάγετε χαρακτηριστικό όνομα ανοιγμάτων (πχ {μελέτη 1 - Βόρεια ανοίγματα})</li>
			<li>Επιλέξτε τον τύπο πλαισίου, υαλοπίνακα και θερμογέφυρας συναρμογής</li>
			<li>Δώστε τις διαστάσεις και τα φύλλα των ανοιγμάτων</li>
			</ul>
			<br/>
			Ο συντελεστής θερμοπερατότητας (U) και το σκαρίφημα για το κάθε άνοιγμα δημιουργούνται αυτόματα. 
			<br/><br/>
			Οι επιλογές αποθήκευσης, εκτύπωσης και βοήθειας δεν επηρρεάζουν την σελίδα. 
			Ανοίγουν σε νέο παράθυρο/καρτέλα.<br/>
			Τα αρχεία pdf κατά την εκτύπωση δημιουργούνται στο φάκελο /PDF/{Όνομα χρήστη}/ της διανομής.
			</div>

	</div><!--col-md-2-->

	
	
<!-- ###################### Κρυφό help_popup για εμφάνιση ###################### -->
<div id="help_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h5 id="myModalLabel">
		<?php
		echo APPLICATION_NAME." - v.".APPLICATION_VERSION." - Βοήθεια (Διαφανή)";
		?>
		</h5>
	</div>
	<div class="modal-body">
		<p>
			<strong>Υπολογισμός U Ανοιγμάτων</strong>
			<hr/>
			Ο συντελεστής θερμοπερατότητας ενός κουφώματος με μονό, διπλό ή τριπλό υαλοπίνακα επί ενιαίου πλαισίου (μονού κουφώματος) 
			που περιλαμβάνει επικαθήμενο ρολό προκύπτει από τον τύπο:<br/>Uw=(A<sub>f</sub>xU<sub>f</sub> + A<sub>g</sub>xU<sub>g</sub> 
			+ l<sub>g</sub>xΨ<sub>g</sub> + A<sub>rb</sub>xU<sub>rb</sub>)/(A<sub>f</sub> + A<sub>g</sub> + A<sub>rb</sub>), όπου: 
			<ul>
			<li>U<sub>w</sub>: ο συντελεστής θερμοπερατότητας όλου του κουφώματος</li>
			<li>U<sub>f</sub>: ο συντελεστής θερμοπερατότητας του πλαισίου του κουφώματος</li>
			<li>U<sub>g</sub>: ο συντελεστής θερμοπερατότητας του υαλοπίνακα του κουφώματος (μονού, διπλού ή περισσότερων φύλλων)</li>
			<li>U<sub>rb</sub>: ο συντελεστής θερμοπερατότητας του κυτίου περιέλιξης του επικαθήμενου ρολού</li>
			<li>A<sub>f</sub>: το εμβαδό επιφάνειας του πλαισίου του κουφώματος</li>
			<li>A<sub>g</sub>: το εμβαδό επιφάνειας του υαλοπίνακα του κουφώματος</li>
			<li>A<sub>rb</sub>: το εμβαδό επιφάνειας του επικαθήμενου ρολού</li>
			<li>l<sub>g</sub>: το μήκος της θερμογέφυρας του υαλοπίνακα του κουφώματος (το μήκος συναρμογής πλαισίου - υαλοπίνακα, 
			δηλαδή η περίμετρος του υαλοπίνακα)</li>
			<li>Ψ<sub>g</sub>: ο συντελεστής γραμμικής θερμοπερατότητας του υαλοπίνακα του κουφώματος</li>
			</ul>
			Εάν δεν υπάρχει ρολό μηδενίζεται ο συντελεστής A<sub>rb</sub>xU<sub>rb</sub> και ο τύπος μεταφράζεται στον τύπο της ενότητας 2.2.1 της ΤΟΤΕΕ-20701-1 
			για μονό κούφωμα χωρίς ρολό. <br /><br/>
			Ο συντελεστής θερμοπερατότητας κουφώματος με ρολό ή εξώφυλλο (παντζούρι) σε <b>κλειστή θέση</b> προκύπτει από τον τύπο:<br/>
			U<sub>w,rb</sub>=1/( 1/U<sub>w</sub> + R<sub>rb</sub>), όπου:
			<ul>
				<li>U<sub>w,rb</sub>: συντελεστής θερμοπερατότητας του κουφώματος με το ρολό ή το εξώφυλλο σε κλειστή θέση</li>
				<li>U<sub>w</sub>: ο συντελεστής θερμοπερατότητας του κουφώματος</li>
				<li>R<sub>rb</sub>: η θερμική αντίσταση, που προσφέρει η χρήση του ρολού ή του εξωφύλλου</li>
			</ul>
			<br/><br/>
			Ωστόσο, τα ρολά και τα εξώφυλλα συνήθως παραμένουν κλειστά κατά τη διάρκεια της νύκτας και ανοικτά τις υπόλοιπες ώρες της ημέρας. 
			Γι' αυτό και η πραγματική ενεργειακή συμπεριφορά του κουφώματος είναι απόρροια μιας ενδιάμεσης κατάστασης του κουφώματος, δηλαδή 
			αυτής με το ρολό ή το εξώφυλλο σε ανοικτή θέση και εκείνης σε κλειστή θέση και εκφράζεται με ένα διορθωμένο συντελεστή θερμοπερατότητας 
			κουφώματος (U<sub>w,διορθ.</sub>), για τον υπολογισμό του οποίου λαμβάνεται υπόψη ο χρόνος χρήσης του ρολού ή του εξωφύλλου σύμφωνα με τη σχέση:
			<br/><br/>
			U<sub>w,διορθ.</sub> = U<sub>w</sub> x (1 - f<sub>rb</sub>) + U<sub>w,rb</sub> x f<sub>rb</sub>, όπου:
			<ul>
				<li>U<sub>w,διορθ.</sub>: ο διορθωμένος συντελεστής θερμοπερατότητας του κουφώματος με χρήση ρολού ή εξωφύλλου,</li>
				<li>U<sub>w,rb</sub>: ο συντελεστής θερμοπερατότητας του κουφώματος με το ρολό ή το εξώφυλλο σε κλειστή θέση</li>
				U<sub>w</sub>: ο συντελεστής θερμοπερατότητας του κουφώματος</li>
				<li>R<sub>rb</sub>: ο συντελεστής χρήσης του ρολού ή του εξωφύλλου ίσος με 0.5 βάση της παρ. 2.2.4 της ΤΟΤΕΕ-20701-1</li>
			</ul>
			<br/><br/>
			Οι τιμές λαμβάνονται από τον πίνακα 9, 10, 11α, 11β κατά το ΕΝ ISO 10077-1.
		</p>
	</div>
	<div class="modal-footer">
	<button class="btn" data-dismiss="modal" aria-hidden="true">Κλείσιμο</button>
	</div>
</div>
</div>
</div>
<!-- ###################### Κρυφό help_popup για εμφάνιση ###################### -->

<!-- ###################### Κρυφό save_popup για εμφάνιση ###################### -->
<div id="save_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick=save_close();>×</button>
	<h5 id="myModalLabel">
	<?php
	echo APPLICATION_NAME." - v.".APPLICATION_VERSION." - Αποθήκευση (Διαφανή)";
	?>
	</h5>
	</div>
	<div class="modal-body">
	<p>
	<strong><span id="save_found"></span></strong><br/>
	Ονομασία: <strong><span id="save_found_name"></span></strong>
	<blockquote><small>
	Μετά την επιτυχή αποθήκευση ο υπολογισμός είναι διαθέσιμος στις βιβλιοθήκες χρήστη και μπορείτε να τον ανακτήσετε από το μενού χρήστη 
	ή από το μενού ανάκτηση αυτού του υπολογισμού.
	</small></blockquote>
	<span id="save_alert"></span>
	</p>
	</div>
	<div class="modal-footer">
	<button class="btn" data-dismiss="modal" aria-hidden="true" onclick=save_close();>Κλείσιμο</button>
	<button class="btn btn-primary" id="save_button" class="btn btn-primary" onclick=anoigmata_save();><div id="save_btn_txt"></div></button>
	</div>
</div>
</div>
</div>
<!-- ###################### Κρυφό save_popup για εμφάνιση ###################### -->

<!-- ###################### Κρυφό open_popup για εμφάνιση ###################### -->
<div id="open_popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick=load_close();>×</button>
	<h5 id="myModalLabel">
	<?php
	echo APPLICATION_NAME." - v.".APPLICATION_VERSION." - Ανάκτηση (Διαφανή)";
	?>
	</h5>
	</div>
	<div class="modal-body">
	<p>
	<strong><span id="load_found"></span></strong><br/>
	Επιλέξτε το στοιχείο που θέλετε να ανακτήσετε:<br/><br/>
	<select class="form-control" id="load_select" name="load_select">
	<option value=0></option>
	</select>
	<span id="load_alert"></span>
	<blockquote><small>
	ΠΡΟΣΟΧΗ: Κατά την ανάκτηση στα κελιά του υπολογισμού φορτώνουν νέα στοιχεία αντικαθιστώντας ότι έχετε προσθέσει μέχρι αυτό το σημείο.
	</small></blockquote>
	</p>
	</div>
	<div class="modal-footer">
	<button class="btn" data-dismiss="modal" aria-hidden="true" onclick=load_close();>Κλείσιμο</button>
	<button class="btn btn-primary" id="load_button" onclick=anoigmata_load();>Ανάκτηση</button>
	</div>
</div>
</div>
</div>
<!-- ###################### Κρυφό open_popup για εμφάνιση ###################### -->


	
	<div class="col-md-10">	
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tabs-1" data-toggle="tab"><i class="fa fa-lemon-o"></i> Μονό κούφωμα (με ή χωρίς προστασία)</a></li>
		</ul>
		<div class="tab-content">
			<!--tab-->
			<div class="tab-pane active" id="tabs-1">
			
			<form class="form-inline has-success" role="form">
				<input type="hidden" class="form-control" id="an_id" disabled="disabled" />
				<div class="input-group">
					<span class="input-group-addon">Όνομα</span>
					<input type="text" class="form-control" placeholder="Όνομα ανοιγμάτων" id="name" size="70" />
				</div>
				<div class="input-group">
					<span class="input-group-addon">Επαφή</span>
					<select class="form-control" id="an_epafi" onchange=get_umax(); >
					<option value=0></option>
					<option value=1>Κούφωμα σε αέρα</option>
					<option value=2>Γυάλινη πρόσοψη σε αέρα</option>
					<option value=3>Κούφωμα σε ΜΘΧ</option>
					<option value=4>Γυάλινη πρόσοψη σε ΜΘΧ</option>
					</select>
				</div>
				<br/>
				<div class="input-group">
					<span class="input-group-addon">Ζώνη</span>
					<select class="form-control" id="an_zwni" onchange=get_umax(); >
					<option value=0>Α</option>
					<option value=1>Β</option>
					<option value=2>Γ</option>
					<option value=3>Δ</option>
					</select>
				</div>
				<div class="input-group">
					<span class="input-group-addon">Τύπος</span>
					<select class="form-control" id="an_type" onchange=get_umax(); >
					<option value=1>Νέο</option>
					<option value=2>Ριζική ανακαίνιση</option>
					</select>
				</div>
				<div class="input-group">
					<span class="input-group-addon">Umax</span>
					<input type="text" class="form-control" id="an_umax" />
					<span class="input-group-addon">W/m2</span>
				</div>
			</form>
			<br/>
			
			<table class="table table-bordered">
			
			<tr bgcolor="#c7e375">
				<td class="span1" style="vertical-align: middle;">Πλαίσιο</td>
				<td>
					<div class="input-group">
					<span class="input-group-addon" style="background-color: #c7e375">Tύπος πλαισίου</span>
					<select class="form-control input-sm" id="an_pl_type" onchange="get_uf();get_cg();">
						<option value=0></option>
						<?php
							echo create_select_optionsid("vivliothiki_uf","name");
						?>
					</select>	
					</div>
				</td>
				<td>
					<div class="input-group">
						<span class="input-group-addon" style="background-color: #c7e375">Πλάτος πλαισίου</span>
						<input class="form-control input-sm" type="text" id="an_pl_cm" value="" onkeyup=checkall();>
						<span class="input-group-addon" style="background-color: #c7e375">cm</span>
					</div>
				</td>
				<td colspan="2">
					<div class="input-group">
						<span class="input-group-addon" style="background-color: #c7e375">Uf</span>
						<input class="form-control input-sm" type="text" id="an_uf" style="font-weight:bold;text-align:center;"/>
						<span class="input-group-addon" style="background-color: #c7e375">[W/(m<sup>2</sup>K)]</span>
					</div>
				</td>
			</tr>
			
			<tr style="background-color: #ecf5d1">
				<td rowspan=2 style="vertical-align: middle;">Υαλοπίνακας</td>
				<td>
					<div class="input-group">
					<span class="input-group-addon" style="background-color: #ecf5d1">Συντ. εκπομπής</span>
					<select class="form-control input-sm" id="an_yal_ekp" onchange="get_ug();get_cg();">
						<option value=0></option>
						<option value=1>Χωρίς επίστρωση low-e &nbsp;0.89</option>
						<option value=2>Με επίστρωση low-e &#8804;0.10</option>
						<option value=3>Με επίστρωση low-e &#8804;0.05</option>
					</select>
					</div>
				</td>
				<td>
					<div class="input-group">
					<span class="input-group-addon" style="background-color: #ecf5d1">Διαστάσεις</span>
					<select class="form-control input-sm" id="an_yal_dims" onchange=get_ug();>
						<option value=0></option>
						<option value=1>4-6-4</option>
						<option value=2>4-8-4</option>
						<option value=3>4-12-4</option>
						<option value=4>4-16-4</option>
						<option value=5>4-20-4</option>
						<option value=6>4-6-4-6-4</option>
						<option value=7>4-8-4-8-4</option>
						<option value=8>4-12-4-12-4</option>
					</select>
					</div>
				</td>
				<td>
					<div class="input-group">
					<span class="input-group-addon" style="background-color: #ecf5d1">Υλικό διακένου</span>
					<select class="form-control input-sm" id="an_yal_air" onchange=get_ug();>
						<option value=0></option>
						<option value=1>Αέρας</option>
						<option value=2>Αργό</option>
						<option value=3>Κρυπτό</option>
					</select>
					</div>
				</td>
			</tr>
			<tr style="background-color: #ecf5d1">
				<td>
					<div class="input-group">
					<span class="input-group-addon" style="background-color: #ecf5d1">Υάλωση</span>
					<select class="form-control input-sm" id="an_yal_type" disabled="disabled">
						<option value=0></option>
						<option value=1>Διπλή</option>
						<option value=2>Τριπλή</option>
					</select>
					</div>
				</td>
				<td>
					<div class="input-group">
					<span class="input-group-addon" style="background-color: #ecf5d1">Τύπος</span>
					<input class="form-control input-sm" type="text" id="an_yal_desc" disabled="disabled"/>
					</div>
				</td>
				<td>
					<div class="input-group">
					<span class="input-group-addon" style="background-color: #ecf5d1">Ug</span>
					<input class="form-control input-sm" type="text" id="an_ug" style="font-weight:bold;text-align:center;" disabled="disabled"/>
					<span class="input-group-addon" style="background-color: #ecf5d1">[W/(m<sup>2</sup>K)]</span>
					</div>
				</td>
			</tr>
			
			<tr style="background-color: #f5ecd1" style="vertical-align: middle;">
				<td style="vertical-align: middle;">Συναρμογή</td>
				<td colspan="2" style="vertical-align: middle;text-align:center;">
					<div class="form-group has-success">
					<label>
						<input type="checkbox" id="an_cg_best" onchange=get_cg();>
						Θερμ. βελτιωμένος τύπος αποστάτη
					</label> 
				</td>
				<td>
					<div class="input-group">
					<span class="input-group-addon" style="background-color: #f5ecd1">Ψg</span>
					<input class="form-control input-sm" type="text" id="an_cg" style="font-weight:bold;text-align:center;" disabled="disabled" class="disabled"/>
					<span class="input-group-addon" style="background-color: #f5ecd1">[W/(m<sup>2</sup>K)]</span>
					</div>
				</td>
			</tr>
			
			<tr style="background-color: #daeca3">
				<td rowspan=2 style="vertical-align: middle;">Εξ. προστασία</td>
				<td>
					<div class="input-group">
						<span class="input-group-addon" style="background-color: #daeca3">Κουτί ρολού</span>
						<select class="form-control input-sm" id="an_roll_type" onchange=get_urb();>
							<option value=0></option>
							<option value=1>Μεταλλικό χωρίς θερμοδιακοπή</option>
							<option value=2>Μεταλλικό με θερμοδιακοπή και θερμομόνωση</option>
							<option value=3>Συνθετικό</option>
						</select>
					</div>
				</td>
				<td>
					<div class="input-group">
						<span class="input-group-addon" style="background-color: #daeca3">Ύψος ρολού</span>
						<input class="form-control input-sm" type="text" id="an_roll_h" onkeyup=checkall();>
						<span class="input-group-addon" style="background-color: #daeca3">m</span>
					</div>
				</td>
				<td>
					<div class="input-group">
						<span class="input-group-addon" style="background-color: #daeca3">U<sub>rb</sub></span>
						<input class="form-control input-sm" type="text" id="an_urb" style="font-weight:bold;text-align:center;"/>
					</div>
				</td>
			</tr>
			
			<tr style="background-color: #daeca3">
				<td>
					<div class="input-group">
						<span class="input-group-addon" style="background-color: #daeca3">Τύπος περσίδας</span>
						<select class="form-control input-sm" id="an_eks_type" onchange=get_rrb();>
							<option value=0></option>
							<option value=1>Αλουμινίου</option>
							<option value=2>Ξύλινες</option>
							<option value=3>Συνθετικές</option>
							<option value=4>Συνθετικές με γέμισμα αφρού</option>
						</select>
					</div>
				</td>
				<td>
					<div class="input-group">
						<span class="input-group-addon" style="background-color: #daeca3">Αεροστεγανότητα</span>
						<select class="form-control input-sm" id="an_eks_ekp" onchange=get_rrb();>
							<option value=0></option>
							<option value=1>Χαμηλή</option>
							<option value=2>Μέση</option>
							<option value=3>Υψηλή</option>
						</select>
					</div>
				</td>
				<td>
					<div class="input-group">
						<span class="input-group-addon" style="background-color: #daeca3">R<sub>rb</sub></span>
						<input class="form-control input-sm" type="text" id="an_rrb" style="font-weight:bold;text-align:center;" disabled="disabled"/>
					</div>
				</td>
			</tr>
			
			</table>
			
			<script>
			$(function() {
				$('.tooltipui').popover();
			});
			</script>
			
			<table class="table table-condenced">
				<tr>
					<td rowspan="2" style="vertical-align: middle;text-align:center;">
						Όνομα
					</td>
					<td rowspan="2" style="vertical-align: middle;text-align:center;">
						<img src="images/interface/edithelp/help.png">
					</td>
					<td colspan="4" style="vertical-align: middle;text-align:center;">
						Άνοιγμα
					</td>
					<td colspan="3" style="background-color:#ecf5d1;vertical-align: middle;text-align:center;">
						Υαλοπίνακας
					</td>
					<td colspan="2" style="background-color:#c7e375;vertical-align: middle;text-align:center;">
						Πλαίσιο
					</td>
					<td rowspan="2" style="background-color:#daeca3;vertical-align: middle;text-align:center;">
						<a class="tooltipui" href="#" title="Ρολό (εμβαδόν)">A<sub>rb</sub></a>
					</td>
					<td rowspan="2" style="background-color:#f5ecd1;vertical-align: middle;text-align:center;">
						<a class="tooltipui" href="#" title="Μήκος θερμογέφυρας (m)">L<sub>g</sub></a>
					</td>
					<td rowspan="2" style="vertical-align: middle;text-align:center;">
						<a class="tooltipui" href="#" title="Συντελεστής ηλιακού θερμικού κέρδους">g<sub>w</sub></a>
					</td>
					<td rowspan="2" style="vertical-align: middle;text-align:center;">
						<a class="tooltipui" href="#" title="U Κουφώματος [W/(m²K)]">Uw</a>
					</td>
					<td rowspan="2" style="vertical-align: middle;text-align:center;">
						<a class="tooltipui" href="#" title="U Κουφώματος μαζί με το ρολό [W/(m²K)]">Uw,rb</a>
					</td>
					<td rowspan="2" style="vertical-align: middle;text-align:center;">
						<a class="tooltipui" href="#" title="U Κουφώματος νύχτας-ημέρας [W/(m²K)]">Uw,r</a>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: middle;text-align:center;"><a class="tooltipui" href="#" title="Μήκος παραθύρου (m)">W</a></td>
					<td style="vertical-align: middle;text-align:center;"><a class="tooltipui" href="#" title="Ύψος παραθύρου (m)">Η</a></td>
					<td style="vertical-align: middle;text-align:center;"><a class="tooltipui" href="#" title="Εμβαδόν παραθύρου (m)">E</a></td>
					<td style="vertical-align: middle;text-align:center;"><a class="tooltipui" href="#" title="Φύλλα παραθύρου (m)">f</a></td>
					<td style="background-color:#ecf5d1;vertical-align: middle;text-align:center;">
						<a class="tooltipui" href="#" title="Πλάτος κάθε φύλλου υαλοπίνακα (m)">W<sub>g</sub></a>
					</td>
					<td style="background-color:#ecf5d1;vertical-align: middle;text-align:center;">
						<a class="tooltipui" href="#" title="Ύψος κάθε φύλλου υαλοπίνακα (m)">Η<sub>g</sub></a>
					</td>
					<td style="background-color:#ecf5d1;vertical-align: middle;text-align:center;">
						<a class="tooltipui" href="#" title="Εμβαδόν υαλοπίνακα (m)">A<sub>g</sub></a>
					</td>
					<td style="background-color:#c7e375;vertical-align: middle;text-align:center;">
						<a class="tooltipui" href="#" title="Εμβαδόν πλαισίου (m)">A<sub>f</sub></a>
					</td>
					<td style="background-color:#c7e375;vertical-align: middle;text-align:center;">
						<a class="tooltipui" href="#" title="Ποσοστό πλαισίου (m)">%</a>
					</td>
				</tr>
				<?php for ($i = 1; $i <= 10; $i++) { 
				?>
				<tr>
					<td width=5%>
					<input class="form-control input-sm" type="text" id="name<?php echo $i; ?>" value="<?php echo "ΑΝ-".$i; ?>">
					</td>
					<td width=5%>
					<a href="#" id="diafani_img<?php echo $i; ?>" data-toggle="popover" title="<?php echo "ΑΝ-".$i; ?>" data-content=""><img src="images/interface/edithelp/help.png"></a>
					</td>
					<td width=5%><input class="form-control input-sm" type="text" id="aw<?php echo $i; ?>" onchange="get_u(<?php echo $i; ?>,1);"/></td>
					<td width=5%><input class="form-control input-sm" type="text" id="ah<?php echo $i; ?>" onchange="get_u(<?php echo $i; ?>,1);"/></td>
					<td width=5%><input class="form-control input-sm" type="text" id="ae<?php echo $i; ?>" disabled="disabled"/></td>
					<td width=5%><input class="form-control input-sm" type="text" id="af<?php echo $i ;?>" onchange="get_u(<?php echo $i; ?>,1);"/></td>
					<td width=5%><input class="form-control input-sm" type="text" id="yw<?php echo $i ;?>" onchange="get_u(<?php echo $i; ?>,1);"/></td>
					<td width=5%><input class="form-control input-sm" type="text" id="yh<?php echo $i ;?>" onchange="get_u(<?php echo $i; ?>,1);"/></td>
					<td width=5%><input class="form-control input-sm" type="text" id="ye<?php echo $i ;?>" disabled="disabled"/></td>
					<td width=5%><input class="form-control input-sm" type="text" id="pe<?php echo $i ;?>" disabled="disabled"/></td>
					<td width=5%><input class="form-control input-sm" type="text" id="pp<?php echo $i ;?>" disabled="disabled"/></td>
					<td width=5%><input class="form-control input-sm" type="text" id="re<?php echo $i ;?>" disabled="disabled"/></td>
					<td width=5%><input class="form-control input-sm" type="text" id="lg<?php echo $i ;?>" disabled="disabled"/></td>
					<td width=5%><input class="form-control input-sm" type="text" id="gw<?php echo $i ;?>" disabled="disabled"/></td>
					<td width=5%><input class="form-control input-sm" type="text" id="uw<?php echo $i ;?>" disabled="disabled"/></td>
					<td width=5%><input class="form-control input-sm" type="text" id="uwrb<?php echo $i ;?>" disabled="disabled"/></td>
					<td width=5%><input class="form-control input-sm" type="text" id="uwr<?php echo $i ;?>" disabled="disabled"/></td>
				</tr>
				<script>
				$('#diafani_img<?php echo $i; ?>').popover({ html:true, trigger:'hover' });
				</script>
				<?php
				}
				?>
				
			</table>
			<blockquote>
			<small>
				<p>g<sub>w</sub>=g<sub>gl</sub>*(1-F<sub>f</sub>)</p>
				<p>όπου:</p>
				<p>F<sub>f</sub>: ποσοστό πλαισίου στο άνοιγμα</p>
				<p>g<sub>gl</sub>: συντελεστής ηλιακού θερμικού κέρδους του υαλοπίνακα (πιν. 3.16 - ΤΟΤΕΕ-20701-1), 0.68 χωρίς low-e, 0.60 με low-e</p>
			</small>
			</blockquote>

			<br/>
			<div id="window_img">
			
<script>
//Εύρεση αν το άνοιγμα που πρόκειται να αποθηκευτεί υπάρχει στη βάση
function anoigmata_find(){
	var id=document.getElementById("an_id").value;
	var x="includes/functions_calc.php?diafani_find=1&id="+id;
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",x ,true);
		xmlhttp.send();

		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var returned = xmlhttp.responseText;
			document.getElementById("save_btn_txt").innerHTML = returned;
		}}
}

//Αποθήκευση υπολογισμού
function anoigmata_save(){
var name=document.getElementById("name").value;
var date = new Date();
var x="includes/functions_calc.php?diafani_save=1";
x+="&id="+document.getElementById("an_id").value;
x+="&name="+document.getElementById("name").value;
x+="&epafi="+document.getElementById("an_epafi").value;
x+="&zwni="+document.getElementById("an_zwni").value;
x+="&type="+document.getElementById("an_type").value;
x+="&plaisio_uf="+document.getElementById("an_pl_type").value;
x+="&plaisio_mpp="+document.getElementById("an_pl_cm").value;
x+="&yalo_ekp="+document.getElementById("an_yal_ekp").value;
x+="&yalo_dias="+document.getElementById("an_yal_dims").value;
x+="&yalo_aer="+document.getElementById("an_yal_air").value;
	if(document.getElementById("an_cg_best").checked){
		x+="&cg_best=1";
	}else{
		x+="&cg_best=0";
	}
x+="&roll_type="+document.getElementById("an_roll_type").value;
x+="&roll_h="+document.getElementById("an_roll_h").value;
x+="&eks_type="+document.getElementById("an_eks_type").value;
x+="&eks_ekp="+document.getElementById("an_eks_ekp").value;

var a="";
var aw="";
var ah="";
var af="";
var yw="";
var yh="";
var gw="";
var uw="";
var uwrb="";
var uwr="";
	for (i=1;i<=10;i++){
		a += document.getElementById("name"+i).value+"|";
		aw += document.getElementById("aw"+i).value+"|";
		ah += document.getElementById("ah"+i).value+"|";
		af += document.getElementById("af"+i).value+"|";
		yw += document.getElementById("yw"+i).value+"|";
		yh += document.getElementById("yh"+i).value+"|";
		gw += document.getElementById("gw"+i).value+"|";
		uw += document.getElementById("uw"+i).value+"|";
		uwrb += document.getElementById("uwrb"+i).value+"|";
		uwr += document.getElementById("uwr"+i).value+"|";
	}
x+="&a="+a+"&aw="+aw+"&ah="+ah+"&af="+af+"&yw="+yw+"&yh="+yh+"&gw="+gw+"&uw="+uw+"&uwrb="+uwrb+"&uwr="+uwr;

	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET",x ,true);
	xmlhttp.send();

	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		var returned = xmlhttp.responseText;
		var save_alert = "<div class=\"alert alert-info\">";
		save_alert += "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
		save_alert += "Τα ανοίγματα "+name+" "+returned+" στη βάση δεδομένων! "+date+"</div>";
		document.getElementById("save_alert").innerHTML=save_alert;
	}}
}

//Εύρεση αποθηκευμένων ανοιγμάτων
function anoigmata_makeselect(){
var x="includes/functions_calc.php?diafani_makeselect=1";

		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",x ,true);
		xmlhttp.send();

		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		
		var returned = xmlhttp.responseText;
			if(returned==""){
				document.getElementById("load_button").disabled = true;
				document.getElementById("load_select").disabled = true;
				document.getElementById("load_found").innerHTML = "Δεν βρέθηκαν υπολογισμοί ανοιγμάτων στη βιβλιοθήκη σας";
			}else{
				document.getElementById("load_button").disabled = false;
				document.getElementById("load_select").disabled = false;
				document.getElementById("load_select").innerHTML = returned;
			}
			
		}}
}

//Φόρτωση ανοίγματος
function anoigmata_load(){
var x="includes/functions_calc.php?diafani_load=1";
x+="&id="+document.getElementById("load_select").value;

	//AJAX call
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET",x ,true);
	xmlhttp.send();

	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		var returned = xmlhttp.responseText;
		var load_alert = "";

		if(returned==""){
			load_alert += "<div class=\"alert alert-error alert-dismissable\">";
			load_alert += "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
			load_alert += "Υπήρξε κάποιο πρόβλημα με την ανάκτηση!";
		}else{
			returned = JSON.parse(returned);
			load_alert += "<div class=\"alert alert-success alert-dismissable\">";
			load_alert += "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
			load_alert += "Επιτυχής φόρτωση!";
			
				document.getElementById("an_id").value = returned["id"];
				document.getElementById("name").value = returned["name"];
				document.getElementById("an_epafi").value = returned["epafi"];
				document.getElementById("an_zwni").value = returned["zwni"];
				document.getElementById("an_type").value = returned["type"];
				
				get_umax();
				
				document.getElementById("an_pl_type").value = returned["plaisio_uf"];
				document.getElementById("an_pl_cm").value = returned["plaisio_mpp"];
				document.getElementById("an_yal_ekp").value = returned["yalo_ekp"];
				document.getElementById("an_yal_dims").value = returned["yalo_dias"];
				document.getElementById("an_yal_air").value = returned["yalo_aer"];
				
				if(returned["cg_best"]==1){document.getElementById("an_cg_best").checked=true;}
				if(returned["cg_best"]==0){document.getElementById("an_cg_best").checked=false;}
				
				document.getElementById("an_roll_type").value = returned["roll_type"];
				document.getElementById("an_roll_h").value = returned["roll_h"];
				
				document.getElementById("an_eks_type").value = returned["eks_type"];
				document.getElementById("an_eks_ekp").value = returned["eks_ekp"];
				
				var name=returned["a"].split("|");
				var aw=returned["aw"].split("|");
				var ah=returned["ah"].split("|");
				var af=returned["af"].split("|");
				var yw=returned["yw"].split("|");
				var yh=returned["yh"].split("|");
				
				var gw=returned["gw"].split("|");
				var uw=returned["uw"].split("|");
				var uwrb=returned["uwrb"].split("|");
				var uwr=returned["uwr"].split("|");
				
				for (i=1;i<=10;i++){
				if(name[i-1]=="undefined"){name[i-1]="";}
					document.getElementById("name"+i).value = name[i-1];
				if(aw[i-1]=="undefined"){aw[i-1]="";}	
					document.getElementById("aw"+i).value = aw[i-1];
				if(ah[i-1]=="undefined"){ah[i-1]="";}	
					document.getElementById("ah"+i).value = ah[i-1];
				if(af[i-1]=="undefined"){af[i-1]="";}	
					document.getElementById("af"+i).value = af[i-1];
				if(yw[i-1]=="undefined"){yw[i-1]="";}	
					document.getElementById("yw"+i).value = yw[i-1];
				if(yh[i-1]=="undefined"){yh[i-1]="";}
					document.getElementById("yh"+i).value = yh[i-1];
				
				if(yh[i-1]=="undefined"){gw[i-1]="";}
					document.getElementById("gw"+i).value = yh[i-1];
				if(yh[i-1]=="undefined"){uw[i-1]="";}
					document.getElementById("uw"+i).value = yh[i-1];
				if(yh[i-1]=="undefined"){uwrb[i-1]="";}
					document.getElementById("uwrb"+i).value = yh[i-1];
				if(yh[i-1]=="undefined"){uwr[i-1]="";}
					document.getElementById("uwr"+i).value = yh[i-1];
				}
				get_allselects(returned["plaisio_uf"], returned["yalo_ekp"], returned["yalo_dias"], returned["yalo_aer"], returned["cg_best"], returned["eks_type"], returned["eks_ekp"]);
		}
		load_alert += "</div>";
		document.getElementById("load_alert").innerHTML = load_alert;
		
	}}
}

//Στη φόρτωση με βάση το ID του υλικού φτιάχνει τα select των κατηγοριών και βρίσκει τα UF,G κλπ
//Δεν επιβαρύνεται η βάση από select σε select. Φορτώνει όλη η γραμμή του ανοίγματος
function get_allselects(pl_type,yal_ekp,yal_dims,yal_air,cg_best,eks_type,eks_ekp){
	
	var xmlhttp=new XMLHttpRequest();
	var x="includes/functions_calc.php?diafani_getselectsid=1&pl_type="+pl_type+"&yal_ekp="+yal_ekp;
	x+="&yal_dims="+yal_dims+"&yal_air="+yal_air+"&cg_best="+cg_best+"&eks_type="+eks_type+"&eks_ekp="+eks_ekp;
	xmlhttp.open("GET", x ,true);
	xmlhttp.send();
	xmlhttp.onreadystatechange=function()  {
	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		arr = JSON.parse(xmlhttp.responseText);
		document.getElementById("an_uf").value=arr[0];
		document.getElementById("an_ug").value=arr[1];
		document.getElementById("an_cg").value=arr[2];
		document.getElementById("an_rrb").value = arr[3];
		get_urb();//από select εσωτερικά
		get_yal_desc();//από select εσωτερικά
		checkall();//πράξεις
	}}
}

//Κλείσιμο και άνοιγμα των modal
function load_close(){
	document.getElementById("load_alert").innerHTML="";
}
function save_close(){
	document.getElementById("save_alert").innerHTML="";
}

//Εύρεση του umax από ζώνη και τύπο
function get_umax(){
	var zwni= parseFloat(document.getElementById("an_zwni").value);
	var type= parseFloat(document.getElementById("an_type").value);
	var epafi= parseFloat(document.getElementById("an_epafi").value);
	
	var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","includes/functions_calc.php?diafani_get_umax=1&zwni="+zwni+"&type="+type+"&epafi="+epafi ,true);
		xmlhttp.send();

		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var umax = xmlhttp.responseText;
			document.getElementById("an_umax").value=umax;
			checkall();
		}}
}

//Εύρεση του συντελεστή Uf από το select
function get_uf(){
	var uf_type= parseFloat(document.getElementById("an_pl_type").value);
	
	var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","includes/functions_calc.php?diafani_get_uf=1&uf_type="+uf_type ,true);
		xmlhttp.send();

		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var uf = xmlhttp.responseText;
			document.getElementById("an_uf").value=uf;
			checkall();
		}}
}

//Εύρεση του συντελεστή Ψg από τον τύπο εκπομπής, τη βελτίωση και το μέταλλο
function get_cg(){
	var plaisio= parseFloat(document.getElementById("an_pl_type").value);
	var an_yal_ekp= parseFloat(document.getElementById("an_yal_ekp").value);
	var an_cg_best= document.getElementById("an_cg_best");
	var type_apostati;
	if(an_cg_best.checked){
		type_apostati=2;
	}else{
		type_apostati=1;
	}
	
	var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","includes/functions_calc.php?diafani_get_cg=1&plaisio="+plaisio+"&type_apostati="+type_apostati+"&ekp="+an_yal_ekp ,true);
		xmlhttp.send();

		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var cg = xmlhttp.responseText;
			document.getElementById("an_cg").value=cg;
			checkall();
		}}
}

//Εύρεση περιγραφής υάλωσης από τις 3 επιλογές υάλωσης
function get_yal_desc(){
	var x="";
	var yal_ekp= parseFloat(document.getElementById("an_yal_ekp").value);
	var yal_dims= parseFloat(document.getElementById("an_yal_dims").value);
	var yal_air= parseFloat(document.getElementById("an_yal_air").value);
	
	if(yal_dims>0 && yal_dims<=5){
		yal_type=1;//Διπλή υάλωση
		x+="Διπλή υάλωση"
	}
	if(yal_dims>6){
		yal_type=2;//Τριπλή υάλωση
		x+="Τριπλή υάλωση"
	}
	if(yal_dims==0){
		yal_type=0;
	}
	document.getElementById("an_yal_type").value=yal_type;
	
	if(yal_ekp==1){x+=" χωρίς επίστρωση χαμηλής εκπομπής";}
	if(yal_ekp==2){x+="  με επίστρωση low-e <0.10";}
	if(yal_ekp==3){x+="  με επίστρωση low-e <0.05";}
	
	if(yal_air==1){x+=" και αέρα στο διάκενο";}
	if(yal_air==2){x+=" και αργό στο διάκενο";}
	if(yal_air==3){x+=" και κρυπτό στο διάκενο";}
	document.getElementById("an_yal_desc").value=x;
}

//Εύρεση του Ug από τη βάση
function get_ug(){
	type_ekp=parseFloat(document.getElementById("an_yal_ekp").value);
	diastasi=parseFloat(document.getElementById("an_yal_dims").value);
	air=parseFloat(document.getElementById("an_yal_air").value);
	
	var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","includes/functions_calc.php?diafani_get_ug=1&type_ekp="+type_ekp+"&diastasi="+diastasi+"&air="+air ,true);
		xmlhttp.send();

		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var ug = xmlhttp.responseText;
			document.getElementById("an_ug").value = ug;
			checkall();
			get_yal_desc();
		}}
}

//Εύρεση του Urb - Οι επιλογές είναι 3. Κατευθείαν και όχι βάση. 
function get_urb(){
	an_roll_type=parseFloat(document.getElementById("an_roll_type").value);
	var x;
	if(an_roll_type==1){x=7;}
	if(an_roll_type==2){x=1.5;}
	if(an_roll_type==3){x=1.25;}
	if(an_roll_type==0){x="";}
	
	document.getElementById("an_urb").value=x;
	checkall();
}

//Εύρεση του Rrb από τη βάση
function get_rrb(){
	type=parseFloat(document.getElementById("an_eks_type").value);
	ekp=parseFloat(document.getElementById("an_eks_ekp").value);
	
	var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","includes/functions_calc.php?diafani_get_rrb=1&type="+type+"&ekp="+ekp ,true);
		xmlhttp.send();

		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var rrb = xmlhttp.responseText;
			document.getElementById("an_rrb").value = rrb;
			checkall();
		}}
}

//Εύρεση U
function get_u(n){
	//Τιμές γραμμής
	var aw=parseFloat(document.getElementById("aw"+n).value);
	var ah=parseFloat(document.getElementById("ah"+n).value);
	var af=parseFloat(document.getElementById("af"+n).value);
	
	if(aw && aw !== '0'){//να υπάρχει τιμή στο πλάτος
	//Τιμές γενικές για όλα
	var umax=document.getElementById("an_umax").value;
	var an_yal_ekp=parseFloat(document.getElementById("an_yal_ekp").value);
	var mpp=parseFloat(document.getElementById("an_pl_cm").value);
	var roll_h=parseFloat(document.getElementById("an_roll_h").value);
	var uf=parseFloat(document.getElementById("an_uf").value);
	var ug=parseFloat(document.getElementById("an_ug").value);
	var cg=parseFloat(document.getElementById("an_cg").value);
	var urb=parseFloat(document.getElementById("an_urb").value);
	var rrb=parseFloat(document.getElementById("an_rrb").value);
	
	//Έλεγχος αν δεν έχει προστεθεί κάτι
	if (!mpp || mpp === '0') {mpp=0;}
	if (!roll_h || roll_h === '0') {roll_h=0;}
	if (!uf || uf === '0') {uf=0;}
	if (!ug || ug === '0') {ug=0;}
	if (!cg || cg === '0') {cg=0;}
	if (!urb || urb === '0') {urb=0;}
	if (!rrb || rrb === '0') {rrb=0;}
	
	//Έλεγχος αν δεν έχει προστεθεί κάτι
	if (!aw || aw === '0') {aw=0;}
	if (!ah || ah === '0') {ah=0;}
	if (!af || af === '0') {af=0;}
	
	var yw, yw, ae, yw, yh, ye, pe, pp, re, lg, ggl, gw, uw, uwrb, uwr;
	
		mpp/=100;//πλαίσιο σε m
		ae=aw*ah;//συνολικό εμβαδό
		
		re=aw*roll_h;//εμβαδό ρολού
		ahh=ah-roll_h;//πραγματικό ύψος παραθύρου χωρίς το ρολό
		
		yw=aw/af - 2*mpp;//μήκος φύλλου υαλοπίνακα
		yh=ahh-2*mpp;//ύψος φύλλου υαλοπίνακα
		ye=yw*yh*af;//εμβαδό υαλοπίνακα
		
		pe=ae-(aw*roll_h)-ye;//εμβαδό πλαισίου χωρίς το ρολό και υαλοπίνακα
		pp=(pe/ae)*100;//ποσοστό πλαισίου
		
		lg=2*(yw+yh)*af;//μήκος θερμογέφυρας
		
		//g - TOTEE 1 - σελ. 83
		if(an_yal_ekp==1){//χωρίς low-e
			ggl = 0.68;
		}else{//με low-e
			ggl = 0.6;
		}
		gw = ggl*(1-(pp/100));
		
		//U ΚΟΥΦΩΜΑΤΟΣ
		uw=(pe*uf+ye*ug+lg*cg+re*urb)/ae;//uw μαζί με ρολό (εάν δε δηλωθεί ρολό υπολογίζει μονό κούφωμα)
		
		if(rrb==0){
			uwrb=uw;
			uwr=uw;
		}else{
			uwrb=1/((1/uw)+rrb);
			uwr=uw*0.5+uwrb*0.5;
		}
		
		if (uwr>umax){
			document.getElementById("uwr"+n).style.backgroundColor="#ffc6d0";
		}else{
			document.getElementById("uwr"+n).style.backgroundColor="#99d6ff";
		}

		document.getElementById("ae"+n).value=number_format(ae,2);
		document.getElementById("yw"+n).value=number_format(yw,2);
		document.getElementById("yh"+n).value=number_format(yh,2);
		document.getElementById("ye"+n).value=number_format(ye,2);
		document.getElementById("pe"+n).value=number_format(pe,2);
		document.getElementById("pp"+n).value=number_format(pp,2);
		document.getElementById("re"+n).value=number_format(re,2);
		document.getElementById("lg"+n).value=number_format(lg,2);
		document.getElementById("gw"+n).value=number_format(gw,2);
		document.getElementById("uw"+n).value=number_format(uw,2);
		document.getElementById("uwrb"+n).value=number_format(uwrb,2);
		document.getElementById("uwr"+n).value=number_format(uwr,2);
	}//να έχει πλάτος το άνοιγμα
}

//Υπολογισμός όλων των U σε 10 γραμμές
function checkall(){

	for (i=1;i<=10;i++){
		document.getElementById("ae"+i).value="";
		document.getElementById("ye"+i).value="";
		document.getElementById("pe"+i).value="";
		document.getElementById("pp"+i).value="";
		document.getElementById("re"+i).value="";
		document.getElementById("lg"+i).value="";
		document.getElementById("gw"+i).value="";
		document.getElementById("uw"+i).value="";
		document.getElementById("uwrb"+i).value="";
		document.getElementById("uwr"+i).value="";
	}
		for (i=1;i<=10;i++){
			get_u(i);
			construct_window(i);
		}
}

//Κατασκευή εικόνας ανοίγματος
function construct_window(n){
	var x="includes/anoigmata_image_creation.php?";
	x+="name="+document.getElementById("name"+n).value;
	x+="&aw="+document.getElementById("aw"+n).value;
	x+="&ah="+document.getElementById("ah"+n).value;
	x+="&af="+document.getElementById("af"+n).value;
	x+="&mpp="+document.getElementById("an_pl_cm").value;
	x+="&p="+document.getElementById("an_pl_type").selectedIndex;

	document.getElementById("diafani_img"+n).setAttribute("data-content","<img src=\""+x+"\"></img>");
}

//Εκτύπωση ανοίγματος
function anoigmata_print(){

	var x="includes/anoigmata_print.php?name="+document.getElementById("name").value;
	x+="&type="+document.getElementById("an_type").options[document.getElementById("an_type").selectedIndex].text;
	x+="&epafi="+document.getElementById("an_epafi").options[document.getElementById("an_epafi").selectedIndex].text;
		x+="&descr="+document.getElementById("an_yal_type").options[document.getElementById("an_yal_type").selectedIndex].text+" υάλωση ";
		x+=" ["+document.getElementById("an_yal_dims").options[document.getElementById("an_yal_dims").selectedIndex].text+"]";
		x+=", "+document.getElementById("an_yal_ekp").options[document.getElementById("an_yal_ekp").selectedIndex].text;
		x+=", Υλικό διακένου: "+document.getElementById("an_yal_air").options[document.getElementById("an_yal_air").selectedIndex].text;
	x+="&mpp="+document.getElementById("an_pl_cm").value;
	x+="&sp="+document.getElementById("an_uf").value;
	x+="&tp="+document.getElementById("an_pl_type").options[document.getElementById("an_pl_type").selectedIndex].text;
	x+="&ug="+document.getElementById("an_ug").value;
	x+="&cg="+document.getElementById("an_cg").value;
	x+="&z1="+document.getElementById("an_umax").value;
	x+="&z2="+document.getElementById("an_zwni").options[document.getElementById("an_zwni").selectedIndex].text;
	x+="&roll_type="+document.getElementById("an_roll_type").options[document.getElementById("an_roll_type").selectedIndex].text;
	x+="&roll_h="+document.getElementById("an_roll_h").value;
	x+="&roll_urb="+document.getElementById("an_urb").value;
	x+="&eks_type="+document.getElementById("an_eks_type").options[document.getElementById("an_eks_type").selectedIndex].text;
	x+="&eks_ekp="+document.getElementById("an_eks_ekp").options[document.getElementById("an_eks_ekp").selectedIndex].text;
	x+="&eks_rrb="+document.getElementById("an_rrb").value;

	for (i=1;i<=10;i++){
		if (document.getElementById("aw"+i).value!=""){
		x+="&name"+i+"="+document.getElementById("name"+i).value;
		x+="&aw"+i+"="+document.getElementById("aw"+i).value;
		x+="&ah"+i+"="+document.getElementById("ah"+i).value;
		x+="&ae"+i+"="+document.getElementById("ae"+i).value;
		x+="&af"+i+"="+document.getElementById("af"+i).value;
		x+="&yw"+i+"="+document.getElementById("yw"+i).value;
		x+="&yh"+i+"="+document.getElementById("yh"+i).value;
		x+="&ye"+i+"="+document.getElementById("ye"+i).value;
		x+="&pe"+i+"="+document.getElementById("pe"+i).value;
		x+="&pp"+i+"="+document.getElementById("pp"+i).value;
		x+="&re"+i+"="+document.getElementById("re"+i).value;
		x+="&lg"+i+"="+document.getElementById("lg"+i).value;
		x+="&gw"+i+"="+document.getElementById("gw"+i).value;
		x+="&uw"+i+"="+document.getElementById("uw"+i).value;
		x+="&uwrb"+i+"="+document.getElementById("uwrb"+i).value;
		x+="&uwr"+i+"="+document.getElementById("uwr"+i).value;
		}
	}

window.open(x,"La-Kenak");
}




//ΧΩΡΙΣ ΧΡΗΣΗ - ΑΠΟ ΠΡΟΗΓΟΥΜΕΝΗ ΕΚΔΟΣΗ
function get_par_e(v){
	var parath_platos= parseFloat(document.getElementById("platos"+v).value);
	var parath_ipsos= parseFloat(document.getElementById("ipsos"+v).value);
	var platos_plaisio= parseFloat(document.getElementById("platos_plaisio"+v).value);
	var emvadon= parath_platos * parath_ipsos;
	var mikos_plaisio= (parath_platos+parath_ipsos)*2;
	var emvadon_plaisio= mikos_plaisio * platos_plaisio;

	document.getElementById("parath_e"+v).value=emvadon;
	document.getElementById("mikos_plaisio"+v).value=mikos_plaisio;
	document.getElementById("emvadon_plaisio"+v).value=emvadon_plaisio;
}

function getpane(){

	var p=document.getElementById("an_pl_type").value;
	if (p==""){
		document.getElementById('an_uf').value="";
	}else{
		document.getElementById('an_uf').value=p;
	}
	document.getElementById("an_yal_desc").value="";
	document.getElementById("an_ug").value="";
	document.getElementById("an_cg").value="";
	var t=document.getElementById("an_yal_type").value;
	var e=document.getElementById("an_yal_ekp").value;
	var d1=document.getElementById("an_yal_dims").value;
	var a=document.getElementById("an_yal_air").value;
	d=document.getElementById("an_yal_dims").selectedIndex;
	if (d==0){return;}
	if (d<6){t=1;}
	if (d>5){t=2;}
	document.getElementById("an_yal_type").selectedIndex=t;
	if (e==""){return;}
	if (a==""){return;}
	var x="υαλοπίνακας ";
	if (t=="1"){x="Διπλός "+x+" "+d1;}
	if (t=="2"){x="Τριπλός "+x+" "+d1;}
	if (e=="1"){x+="  χωρίς επίστρωση χαμηλής εκπομπής";}
	if (e=="2"){x+="  με επίστρωση low-e <0.10 ";}
	if (e=="3"){x+="  με επίστρωση low-e <0.05 ";}
	if (a=="1"){x+=" και αέρα στο διάκενο";}
	if (a=="2"){x+=" και αργό στο διάκενο";}
	if (a=="3"){x+=" και κρυπτό στο διάκενο";}
	t=document.getElementById("an_yal_type").selectedIndex;
	e=document.getElementById("an_yal_ekp").selectedIndex;
	d=document.getElementById("an_yal_dims").selectedIndex;
	a=document.getElementById("an_yal_air").selectedIndex;
	if (t==2 && d<6){return;}
	if (t==1 && d>5){return;}
	document.getElementById("an_yal_desc").value=x;
	if (t==1){
	var s="3.3|3.0|2.8|3.1|2.9|2.7|2.8|2.7|2.6|2.7|2.6|2.6|2.7|2.6|2.6|";
	   s+="2.6|2.2|1.7|2.2|1.9|1.4|1.8|1.5|1.3|1.6|1.4|1.3|1.6|1.4|1.4|";
	   s+="2.5|2.1|1.5|2.1|1.7|1.3|1.7|1.3|1.1|1.4|1.2|1.2|1.5|1.2|1.2";
	var t=s.split("|");
	var n=((e-1)*5+d-1)*3+a;
	x=t[n-1];
	}
	if (t==2){
	var s="2.3|2.1|1.8|2.1|1.9|1.7|1.9|1.8|1.6|1.7|1.3|1.0|1.4|1.1|0.8|1.1|0.9|0.6|1.6|1.2|0.9|1.3|.0|0.7|1.0|0.8|0.5";
	var t=s.split("|");
	d-=5;
	var n=((e-1)*3+d-1)*3+a;
	x=t[n-1];
	}
	document.getElementById("an_ug").value=x;
	p=document.getElementById("an_pl_type").selectedIndex;
	if (p==0){return;}
	if (p>2 && p<7){p=3;}
	if (p>6){p=4;}
	if (e==3){e=2;}
	s="0.02|0.05|0.08|0.11|0.06|0.08|0.06|0.08";
	t=s.split("|");
	n=(p-1)*2+e;
	x=t[n-1];
	document.getElementById("an_cg").value=x;
	checkall();
}

//Εύρεση U ανοίγματος
function get_u1(n,m){
	if (!m){m=0;}
	var mpp=parseFloat(document.getElementById("mpp").value);
	if (!isFinite(mpp)){mpp=0;}
	document.getElementById("ae"+n).value="";
	document.getElementById("ye"+n).value="";
	document.getElementById("pe"+n).value="";
	document.getElementById("pp"+n).value="";
	document.getElementById("lg"+n).value="";
	document.getElementById("uw"+n).value="";
	var aw=parseFloat(document.getElementById("aw"+n).value);
	if (!isFinite(aw)){document.getElementById("aw"+n).focus();return 1;}
	var ah=parseFloat(document.getElementById("ah"+n).value);
	if (!isFinite(ah)){document.getElementById("ah"+n).focus();return 1;}
	var af=parseFloat(document.getElementById("af"+n).value);
	if (!isFinite(af)){document.getElementById("af"+n).focus();return 1;}
	var yw=parseFloat(document.getElementById("yw"+n).value);
	var yh=parseFloat(document.getElementById("yh"+n).value);
	if (mpp>0){
	mpp/=100;
	if ((!isFinite(yw) && !isFinite(yh)) || m==1 ){
	yw=aw/af-2*mpp;
	yh=ah-2*mpp;
	}}
	if (!isFinite(yw)){document.getElementById("yw"+n).focus();return 1;}
	if (!isFinite(yh)){document.getElementById("yh"+n).focus();return 1;}
	document.getElementById("aw"+n).value=number_format(aw,2,".",",");
	document.getElementById("ah"+n).value=number_format(ah,2,".",",");
	document.getElementById("yw"+n).value=number_format(yw,2,".",",");
	document.getElementById("yh"+n).value=number_format(yh,2,".",",");
	document.getElementById("ae"+n).value=number_format(aw*ah,2,".",",");
	document.getElementById("ye"+n).value=number_format(yw*yh*af,2,".",",");
	document.getElementById("pe"+n).value=number_format(aw*ah-yw*yh*af,2,".",",");
	document.getElementById("pp"+n).value=number_format((aw*ah-yw*yh*af)/(aw*ah)*100,0,".",",")+"%";
	document.getElementById("lg"+n).value=number_format(2*(yw+yh)*af,2,".",",");

	document.getElementById("uw"+n).value="";

	var lg=2*(yw+yh)*af;
	var ae=aw*ah;
	var ye=yw*yh*af;
	var pe=ae-ye;

	var ch=0;
	var uf=parseFloat(document.getElementById("syntel_plaisio").value);
	if (isNaN(uf)){ch=1;}
	var cg=parseFloat(document.getElementById("CG").value);
	if (isNaN(cg)){ch=1;}
	var ug=parseFloat(document.getElementById("UG").value);
	if (isNaN(ug)){ch=1;}

	if (ch==0){
	var uw=(pe*uf+ye*ug+lg*cg)/ae;
	document.getElementById("uw"+n).value=number_format(uw,2,".",",");
	var umax=document.getElementById("an_zwni").value;

	//Συντελεστής εκπομπής υαλοπίνακα - ΤΟΤΕΕ-20701-1-πιν. 3.16
	e=document.getElementById("ekp").selectedIndex;
	var ggl;
		if(e==1){//χωρίς low-e
			ggl = 0.68;
		}else{//με low-e
			ggl = 0.6;
		}
	var gw = ggl*(1- (aw*ah-yw*yh*af)/(aw*ah) );
	document.getElementById("gw"+n).value=number_format(gw,2,".",",");

	if (uw>umax){
	document.getElementById("uw"+n).style.backgroundColor="#ff0000";
	}else{
	document.getElementById("uw"+n).style.backgroundColor="#fff1d7";
	}
	contruct_window(n);
	}

	if (n==10){n=0;}
	n+=1;
	document.getElementById("aw"+n).focus();
	return 0;

}


function trim(s) {
	return s.replace(/^\s+|\s+$/g,"");
}
function ltrim(s) {
	return s.replace(/^\s+/,"");
}
function rtrim(s) {
	return s.replace(/\s+$/,"");
}
function number_format (number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
</script>			
			</div>
			<!--tab-->
		
	</div><!--tab content-->
			</div><!--tabs-->

</div>
 <!-- /.row (main row) -->
<script>
	$("input").alphanum();	
</script>	
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

