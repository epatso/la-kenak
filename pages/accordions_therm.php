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
			<div class="panel box box-danger">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#therm_collapse1">
							n<sub>gm</sub>
						</a>
					</h4>
				</div>
			<div id="therm_collapse1" class="panel-collapse collapse">
				<div class="box-body">
					<?php
					echo create_library_therm_p_ngm();
					?>
				</div>
			</div>
			</div>
			
			<div class="panel box box-danger">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#therm_collapse11">
							n<sub>go</sub>
						</a>
					</h4>
				</div>
			<div id="therm_collapse11" class="panel-collapse collapse">
				<div class="box-body">
					<?php
					echo create_library_therm_p_ngo();
					?>
				</div>
			</div>
			</div>
		
			<div class="panel box box-danger">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#therm_collapse2">
						n<sub>g1</sub>
					</a>
					</h4>
				</div>
			<div id="therm_collapse2" class="panel-collapse collapse">
				<div class="box-body">
					<?php
					echo create_library_therm_p_ng1();
					?>
				</div>
			</div>
			</div>
			
			<div class="panel box box-danger">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#therm_collapse3">
						n<sub>g2</sub>
					</a>
					</h4>
				</div>
				<div id="therm_collapse3" class="panel-collapse collapse">
					<div class="box-body">
						<?php
						echo create_library_therm_p_ng2();
						?>
					</div>
				</div>
			</div>	
			
			<div class="panel box box-danger">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#therm_collapse4">
						Άλλες n<sub>gm</sub>
					</a>
					</h4>
				</div>
				<div id="therm_collapse4" class="panel-collapse collapse">
					<div class="box-body">
						<?php
						echo create_library_therm_p_other();
						?>
					</div>
				</div>
			</div>		
			
			<div class="panel box box-danger">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#therm_collapse5">
						SCOP Με βάση το μέσο
					</a>
					</h4>
				</div>
				<div id="therm_collapse5" class="panel-collapse collapse">
					<div class="box-body">
						<?php
						echo create_library_therm_p_cop1();
						?>
					</div>
				</div>
			</div>
			
			<div class="panel box box-danger">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#therm_collapse6">
						SCOP με σήμανση ή χωρίς στοιχεία
					</a>
					</h4>
				</div>
				<div id="therm_collapse6" class="panel-collapse collapse">
					<div class="box-body">
						<?php
						echo create_library_therm_p_cop2();
						?>
					</div>
				</div>
			</div>
			
			<div class="panel box box-danger">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#therm_collapse61">
						COP n<sub>g1</sub>
					</a>
					</h4>
				</div>
				<div id="therm_collapse61" class="panel-collapse collapse">
					<div class="box-body">
						<?php
						echo create_library_therm_p_copng1();
						?>
					</div>
				</div>
			</div>
			
			<div class="panel box box-danger">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#therm_collapse7">
						Δίκτυα διανομής
					</a>
					</h4>
				</div>
				<div id="therm_collapse7" class="panel-collapse collapse">
					<div class="box-body">
						<?php
						echo create_library_therm_d();
						?>
					</div>
				</div>
			</div>
			
			<div class="panel box box-danger">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#therm_collapse8">
						n<sub>em</sub>
					</a>
					</h4>
				</div>
				<div id="therm_collapse8" class="panel-collapse collapse">
					<div class="box-body">
						<?php
						echo create_library_therm_p_nem();
						?>
					</div>
				</div>
			</div>
			
			<div class="panel box box-danger">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#therm_collapse9">
						Άλλες n<sub>em</sub>
					</a>
					</h4>
				</div>
				<div id="therm_collapse9" class="panel-collapse collapse">
					<div class="box-body">
						<?php
						echo create_library_therm_p_nem_elec();
						?>
					</div>
				</div>
			</div>
			
			<div class="panel box box-danger">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#therm_collapse10">
						f<sub>rad</sub>
					</a>
					</h4>
				</div>
				<div id="therm_collapse10" class="panel-collapse collapse">
					<div class="box-body">
						<?php
						echo create_library_therm_p_frad();
						?>
					</div>
				</div>
			</div>
			
			<div class="panel box box-danger">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#therm_collapse11">
						f<sub>im</sub>
					</a>
					</h4>
				</div>
				<div id="therm_collapse11" class="panel-collapse collapse">
					<div class="box-body">
						<?php
						echo create_library_therm_p_fim();
						?>
					</div>
				</div>
			</div>
			
			<div class="panel box box-danger">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#therm_collapse12">
						f<sub>hydr</sub>
					</a>
					</h4>
				</div>
				<div id="therm_collapse12" class="panel-collapse collapse">
					<div class="box-body">
						<?php
						echo create_library_therm_p_fhydr();
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