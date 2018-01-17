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
?>
<div class="box box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Βιβλιοθήκες θέρμανσης</h3>
	</div>
	
	<!-- /.box-header -->
	<div class="box-body">
		<div class="box-group" id="accordion">
		<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#znx_collapse1">
							Δίκτυα Διανομής
						</a>
					</h4>
				</div>
			<div id="znx_collapse1" class="panel-collapse collapse">
				<div class="box-body">
					<?php
					echo create_library_znx_d();
					?>
				</div>
			</div>
			</div>
		
			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#znx_collapse2">
						Αποθηκευτικές μονάδες
					</a>
					</h4>
				</div>
			<div id="znx_collapse2" class="panel-collapse collapse">
				<div class="box-body">
					<?php
					echo create_library_znx_a();
					?>
				</div>
			</div>
			</div>
			
		</div>
		<!-- /.box-group -->
	</div>
<!-- /.box-body -->
</div>
<!-- /.box -->