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
	<small>Συντελεστές θερμοπερατότητας</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-university"></i> Βιβλιοθήκες</a></li>
	<li class="active"> Συντελεστές θερμοπερατότητας</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
<div class="col-md-12">

		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs-1" data-toggle="tab">Ανώτατα U</a></li>
				<li><a href="#tabs-2" data-toggle="tab">Αδιαφανή</a></li>
				<li><a href="#tabs-3" data-toggle="tab">Διαφανή</a></li>
				<li><a href="#tabs-4" data-toggle="tab">a/e</a></li>
				<li><a href="#tabs-5" data-toggle="tab">% φέρων</a></li>
			</ul>
			
			<div class="tab-content">
			<div class="tab-pane active" id="tabs-1">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tabs-21" data-toggle="tab">U<sub>max</sub>/Um<sub>max</sub> (Υφιστάμενα)</a></li>
						<li><a href="#tabs-22" data-toggle="tab">U<sub>max</sub>/Um<sub>max</sub> (Nέα)</a></li>
						<li><a href="#tabs-23" data-toggle="tab">Umax (ΚΘΧ)</a></li>
					</ul>
			
				<div class="tab-content">
					<div class="tab-pane active" id="tabs-21">
						<?php
							echo create_library_umax(2);
							echo create_library_ummax(2);
						?>
					</div>
					<div class="tab-pane" id="tabs-22">
						<?php
							echo create_library_umax(1);
							echo create_library_ummax(1);
						?>
					</div>
					<div class="tab-pane" id="tabs-23">
						<?php
							echo create_library_umax_kthk();
						?>
					</div>
				</div>
				</div>
			</div><!--tabs1-->
			
			<div class="tab-pane" id="tabs-2">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tabs-11" data-toggle="tab">Περίοδος U</a></li>
						<li><a href="#tabs-12" data-toggle="tab">Κατακόρυφα</a></li>
						<li><a href="#tabs-13" data-toggle="tab">Οριζόντια</a></li>
					</ul>
			
				<div class="tab-content">
					<div class="tab-pane active" id="tabs-11">
						<?php
							include("accordions_u.php");
						?>
					</div>
					<div class="tab-pane" id="tabs-12">
						<?php
							echo create_library_adiafani_katakorifa();
						?>
					</div>
					<div class="tab-pane" id="tabs-13">
						<?php
							echo create_library_adiafani_orizontia();
						?>
					</div>
				</div>
				</div>
			</div><!--tabs2-->
			
			<div class="tab-pane" id="tabs-3">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tabs-31" data-toggle="tab">U<sub>w</sub> (χωρίς προστατευτικά)</a></li>
						<li><a href="#tabs-32" data-toggle="tab">U<sub>w</sub> (με ρολά)</a></li>
						<li><a href="#tabs-33" data-toggle="tab">U<sub>w</sub> (με εξώφυλλα)</a></li>
						<li><a href="#tabs-34" data-toggle="tab">g<sub>w</sub></a></li>
					</ul>
			
				<div class="tab-content">
					<div class="tab-pane active" id="tabs-31">
						<?php
							echo create_library_diafani_uw();
						?>
					</div>
					<div class="tab-pane" id="tabs-32">
						<?php
							echo create_library_diafani_uw_rola();
						?>
					</div>
					<div class="tab-pane" id="tabs-33">
						<?php
							echo create_library_diafani_uw_ekswfylla();
						?>
					</div>
					<div class="tab-pane" id="tabs-34">
						<?php
							echo create_library_diafani_gw();
						?>
					</div>
				</div>
				</div>
			</div><!--tabs3-->
			
			
			<div class="tab-pane" id="tabs-4">
				<?php
					echo create_library_adiafani_a();
					echo create_library_adiafani_e();
				?>
			</div><!--tabs5-->
			
			<div class="tab-pane" id="tabs-5">
				<?php
					echo create_library_ferwn();
				?>
			</div>
			
			</div>
			</div><!--tab content-->
			</div><!--tabs-->
</div><!--col-md-12-->
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

