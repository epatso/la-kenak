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
		<h3 class="box-title">Βιβλιοθήκες φωτισμού</h3>
	</div>
		
		
	<div class="box-body">
	<div class="box-group" id="accordion">
	<!-- /.box-header -->

	<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#light_colapse0">
							Ζώνες φωτισμού
						</a>
					</h4>
				</div>
			<div id="light_colapse0" class="panel-collapse collapse">
				<div class="box-body">
					<?php
					echo create_library_lightzones();
					?>
				</div>
			</div>
			</div>
			
			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#light_colapse00">
							ΚΥΑ 14826-2008 Παράρτημα I
						</a>
					</h4>
				</div>
			<div id="light_colapse00" class="panel-collapse collapse">
				<div class="box-body">
					<?php
					echo create_library_lightplaces();
					?>
				</div>
			</div>
			</div>
			
			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#light_colapse1">
							Απόδοση λαμπτήρων
						</a>
					</h4>
				</div>
			<div id="light_colapse1" class="panel-collapse collapse">
				<div class="box-body">
					<?php
					echo create_library_lights_lm();
					?>
				</div>
			</div>
			</div>
		
			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#light_colapse2">
						Πυκνότητα ισχύος φωτισμού ανά 100lux
					</a>
					</h4>
				</div>
			<div id="light_colapse2" class="panel-collapse collapse">
				<div class="box-body">
					<?php
					echo create_library_lights_density();
					?>
				</div>
			</div>
			</div>
			
			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#light_colapse3">
						Συντελεστής επίδρασης φυσικού φωτισμού F<sub>D</sub>
					</a>
					</h4>
				</div>
				<div id="light_colapse3" class="panel-collapse collapse">
					<div class="box-body">
						<?php
						echo create_library_lights_fd();
						?>
					</div>
				</div>
			</div>	
			
			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#light_colapse4">
						Συντελεστής επίδρασης παρουσίας F<sub>ο</sub>
					</a>
					</h4>
				</div>
				<div id="light_colapse4" class="panel-collapse collapse">
					<div class="box-body">
						<?php
						echo create_library_lights_fο();
						?>
					</div>
				</div>
			</div>		
			
			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#light_colapse5">
						Σύστημα απομάκρυνσης θερμότητας
					</a>
					</h4>
				</div>
				<div id="light_colapse5" class="panel-collapse collapse">
					<div class="box-body">
						Η θερμότητα φωτισμού που παραμένει στη ζώνη είναι το ποσοστό της θερμότητας που
						εκπέμπεται από το σύστημα φωτισμού, το οποίο δεν απομακρύνεται άμεσα μέσω συστήματος
						τεχνητού εξαερισμού. Όταν απομακρύνεται όλη η θερμότητα από το χώρο, ο συντελεστής παίρνει τιμή
						ίση με το μηδέν (0), ενώ όταν δεν προβλέπεται καμία απομάκρυνση της θερμότητας από τη ζώνη ο
						συντελεστής ισούται με τη μονάδα (1). Σε περίπτωση ύπαρξης συστήματος απομάκρυνσης της
						θερμότητας που εκλύεται από τα φωτιστικά, για τους υπολογισμούς λαμβάνεται τιμή ίση με 0,4.	
					</div>
				</div>
			</div>
			
			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#light_colapse6">
						Φωτισμός ασφαλείας
					</a>
					</h4>
				</div>
				<div id="light_colapse6" class="panel-collapse collapse">
					<div class="box-body">
						Ο δείκτης ύπαρξης συστήματος φωτισμού ασφαλείας είναι μια τυπική τιμή κατανάλωσης
						ενέργειας. Σε περίπτωση ύπαρξης συστήματος φωτισμού ασφαλείας και σύμφωνα με το πρότυπο
						ΕΛΟΤ ΕΝ 15193:2008, λαμβάνεται για τους υπολογισμούς τιμή ίση με 1 kWh/(m2.έτος). Το κτήριο
						αναφοράς διαθέτει σύστημα ασφαλείας φωτισμού.
					</div>
				</div>
			</div>
			
			<div class="panel box box-primary">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#light_colapse7">
						Εφεδρικό σύστημα για φωτισμό
					</a>
					</h4>
				</div>
				<div id="light_colapse7" class="panel-collapse collapse">
					<div class="box-body">
						Ο δείκτης ύπαρξης εφεδρικού συστήματος για φωτισμό, είναι μια τυπική τιμή κατανάλωσης
						ενέργειας. Σε περίπτωση ύπαρξης συστήματος φωτισμού εφεδρείας και σύμφωνα με το πρότυπο
						ΕΛΟΤ ΕΝ 15193:2008, λαμβάνεται για τους υπολογισμούς τιμή ίση με 5 kWh/(m2.έτος). Το κτήριο
						αναφοράς για τα κτήρια υγείας και κοινωνικής πρόνοιας καθώς και προσωρινής διαμονής διαθέτει
						σύστημα εφεδρείας.
					</div>
				</div>
			</div>
			
		</div>
		<!-- /.box-group -->
	</div>
<!-- /.box-body -->
</div>
<!-- /.box -->