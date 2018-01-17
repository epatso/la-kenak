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
		<h3 class="box-title">Βιβλιοθήκες ηλιοθερμικών συστημάτων</h3>
	</div>
	
	<!-- /.box-header -->
	<div class="box-body">
		<div class="box-group" id="accordion">
		<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
			<div class="panel box box-success">
				<div class="box-header with-border">
					<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#solar_collapse1">
							συνα - Κατοικίες
						</a>
					</h4>
				</div>
			<div id="solar_collapse1" class="panel-collapse collapse">
				<div class="box-body">
					Πίνακας 5.8. Συντελεστής αξιοποίησης ηλιακής ακτινοβολίας για παραγωγή ΖΝΧ σε κατοικίες
					<?php
					echo create_library_syna("ktiria");
					?>
				</div>
			</div>
			</div>
		
			<div class="panel box box-success">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#solar_collapse2">
						συνα - 3<sub>γενής</sub> τομέας
					</a>
					</h4>
				</div>
			<div id="solar_collapse2" class="panel-collapse collapse">
				<div class="box-body">
					Πίνακας 5.9. Συντελεστής αξιοποίησης ηλιακής ακτινοβολίας για παραγωγή ΖΝΧ σε κτίρια 3γενούς τομέα
					<?php
					echo create_library_syna("3genis");
					?>
				</div>
			</div>
			</div>
			
			<div class="panel box box-success">
				<div class="box-header with-border">
					<h4 class="box-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#solar_collapse3">
						Μεθοδολογία καμπυλών f
					</a>
					</h4>
				</div>
				<div id="solar_collapse3" class="panel-collapse collapse">
					<div class="box-body">
						<img src="images/interface/f.jpg"></img><br/>
						Η μέθοδος των καμπυλών f είναι μία προσεγγιστική μέθοδος υπολογισμού της μηνιαίας και της ετήσιας θερμικής απόδοσης ενεργητικών ηλιακών συστημάτων 
							υπολογίζοντας το ποσοστό του ολικού θερμικού φορτίου που θα καλυφθεί από την ηλιακή ενέργεια. <br/>
							Η βασική παράμετρος είναι η επιφάνεια των συλλεκτών ενώ δευτερεύουσες ο τύπος του συλλέκτη, η δυνατότητα αποθήκευσης, ο ρυθμός ροής μάζας και το μέγεθος 
							των εναλλακτών που χρησιμοποιούνται στην πλευρά του συλλέκτη και του φορτίου. <br/>
							Υπολογίζεται μέσω των συντελεστών "X" και "Y" από τη σχέση:<br/><br/>
							f = 1.029Y - 0.065X - 0.245Y<sup>2</sup> + 0.0018X<sup>2</sup> + 0.0215Y<sup>3</sup> <br/>
							,όπου:<br/><br/>
							Ο συντελεστής Χ εκφράζει το ποσό των ενεργειακών απωλειών προς το συνολικό θερμικό φορτίο του μήνα και υπολογίζεται ως:<br/>
							X=(A<sub>c</sub>/L) F<sub>R</sub> U<sub>L</sub> (F<sup>'</sup><sub>R</sub>/F<sub>R</sub>) (T<sub>αναφ</sub>-T<sub>a</sub>) Δt k<sub>1</sub> k<sub>2</sub> <br/>
							Ο συντελεστής Υ εκφράζει το ποσό της ενέργειας που μπορεί να αξιοποιήσει ο ηλιακός συλλέκτης προς το συνολικό θερμικό φορτίο του μήνα και υπολογίζεται ως:<br/>
							Υ=(A<sub>c</sub>/L) F<sub>R</sub> (τα)<sub>n</sub> (F<sup>'</sup><sub>R</sub>/F<sub>R</sub>) (τα/(τα)<sub>n</sub>) H<sub>β</sub> k<sub>3</sub> <br/>
							,όπου:
							<ul>
							<li>A<sub>c</sub>: Επιφάνεια ηλιακών συλεκτών (m<sup>2</sup>)</li>
							<li>
							L: Μέσο μηνιαίο φορτίο (J) για την παραγωγή ΖΝΧ ή/και θέρμανση χώρων το οποίο υπολογίζεται από τη σχέση:<br/>
							L<sub>ΖΝΧ</sub>=N HK<sub>ΖΝΧ</sub> ρ C<sub>p</sub> (T<sub>ΖΝΧ</sub>-Τ<sub>Κ</sub>) <br/>
							,όπου:<br/>
								<ul>
									<li>Ν: Αριθμός ημερών εκάστοτε μήνα</li>
									<li>HK<sub>ΖΝΧ</sub>: Μέση ημερήσια κατανάλωση ζεστού νερού (l/ημέρα) σύμφωνα με την ΤΟΤΕΕ-20701-1/2012</li>
									<li>ρ: Πυκνότητα νερού (περίπου 1Kg/l αν και μεταβάλλεται με την Τ) </li>
									<li>C<sub>p</sub>: Ειδική θερμότητα νερού (419KJ/Kg/<sup>o</sup>C)</li>
									<li>Τ<sub>ΖΝΧ</sub>: Επιθυμητή θερμοκρασία ζεστού νερού (<sup>o</sup>C) σύμφωνα με ΤΟΤΕΕ-20701-1</li>
									<li>Τ<sub>κ</sub>: Θερμοκρασία νερού δικτύου (<sup>o</sup>C) σύμφωνα με ΤΟΤΕΕ-20701-3</li>
								</ul>
							<br/>
							L<sub>Θ</sub>=24 3600 (U A) DD k <br/>
							,όπου:<br/>
								<ul>
									<li>(U A): Το γινόμενο του συντελεστή θερμοπερατότητας U επί το εμβαδό της επιφάνειας του κελύφους (W/<sup>o</sup>C</li>
									<li>DD: Βαθμοημέρες θέρμανσης του κάθε μήνα με βάση την επιθυμητή θερμοκρασία θέρμανσης χώρων (<sup>o</sup>C ημέρα)</li>
									<li>k: Συντελεστής λειτουργίας του κτιρίου (Για 24ωρη λειτουργία k=1, για διακοπτόμενη k<1)</li>
								</ul>	
							</li>
							<li>F<sub>R</sub>,U<sub>L</sub>,F<sub>R</sub>,(τα)<sub>n</sub>: Χαρακτηριστικά μεγέθη του συλλέκτη. Δίνονται από τον κατασκευαστή ή από τον παρακάτω πίνακα</li>
							<li>F<sup>'</sup><sub>R</sub>/F<sub>R</sub>: Διορθωτικό συντελεστής συλλέκτη - εναλλάκτη σε περίπτωση που παρεμβάλεται τέτοιος. Συνήθης τιμή 0.80-0.95</li>
							<li>T<sub>αναφ</sub>: Θερμοκρασία αναφοράς (100<sup>o</sup>C)</li>
							<li>T<sub>a</sub>: Μέση μηνιαία θερμοκρασία κατά τη διάρκεια της ημέρας (<sup>o</sup>C) σύμφωνα με την ΤΟΤΕΕ-20701-3</li>
							<li>Δt: Χρονική περίοδος κάθε μήνα (s)</li>
							<li>τα/(τα)<sub>n</sub>: Διορθωτικός συντελεστής λόγω της θέσης του συλλέκτη και της εποχής του έτους που ορίζεται ως το πηλίκο του γινομένου της μέσης μηνιαίας 
							τιμής της διαπερατότητας "τ" και απορροφήτικότητας "α" προς την αντίστοιχη τιμή με δείκτη "n" που αναφέρεται σε επίπεδο κάθετο στις ακτίνες του ηλίου και υπολογίζεται ως:<br/>
							<ul>
								<li>τα/(τα)<sub>n</sub>= 1 - 0.0044θ + 0.00022θ<sup>2</sup> - 3.31*10<sup>-6</sup>θ<sup>3</sup> (Μονό τζάμι)</li>
								<li>τα/(τα)<sub>n</sub>= 0.99065 - 0.000567θ + 8.2488*10<sup>-5</sup> θ<sup>2</sup> - 2.26787*10<sup>-6</sup>θ<sup>3</sup> (Διπλό τζάμι)</li>
								<li>τα/(τα)<sub>n</sub>= 0.99 (Χωρίς κάλυμμα και κενού)</li>
							</ul>
							</li>
							<li>H<sub>β</sub>: Μέση μηνιαία ηλιακή ακτινοβολία που προσπίπτει στο επίπεδο του συλλέκτη ανά μονάδα επιφάνειας (J/m<sup>2</sup>/μήνα)</li>
							<li>k<sub>1</sub>: Διορθωτικός συντελεστής χωρητικότητας δεξαμενής αποθήκευσης. Ισχύει κ<sub>1</sub>=1 για 75l/m<sup>2</sup>. Σε άλλη χωρητικότητα: κ<sub>1</sub>=(75/Μ)<sup>0.25</sup>, όπου 
							Μ: ο ανηγμένος όγκος της δεξαμενής ανά τετραγωνικό μέτρο συλλεκτικής επιφάνειας (l/m<sup>2</sup></li>
							<li>k<sub>2</sub>: Διορθωτικός συντελεστής ζεστού νερού. Εάν το φορτίο για ΖΝΧ πολύ μικρό σε σχέση με το θερμικό φορτίο για θέρμανση τότε ισούται με 1. Αλλιώς:<br/>
							k<sub>2</sub>=(11.6 + 1.18Τ<sub>ΖΝΧ</sub> + 3.86T<sub>k</sub> - 2.32T<sub>a</sub>) / (100-T<sub>a</sub>), οπου:
							<ul>
								<li>Τ<sub>α</sub>: Μέση μηνιαία θερμοκρασία περιβάλλοντος</li>
								<li>Τ<sub>ΖΝΧ</sub>: Επιθυμητή θερμοκρασία ζεστού νερού</li>
								<li>Τ<sub>κ</sub>: Θερμοκρασία νερού δικτύου</li>
							</ul>
							</li>
							<li>k<sub>3</sub>: Διορθωτικός συντελεστής για τον εναλλάκτη θερμότητας φορτίου. Για παραγωγή ΖΝΧ χωρίς παρεμβολή εναλλάκτη ισούται με 1. </li>
							</ul>
							<br/>
							Αντιπροσωπευτικές τιμές για τις παραμέτρους απόδοσης διάφορων τύπων ηλιακών συλλεκτών
							<table class="table table-bordered">				
							<tr class="success">
								<th>Περιγραφή ηλιακού συλλέκτη νερού</th>
								<th>F<sub>r</sub>(τα)<sub>n</sub></th>
								<th>F<sub>r</sub>U<sub>L</sub> (W/m<sup>2</sup>.<sup>o</sup>C)</th>
							</tr>
							<tr>
								<td>Μαύρο χρώμα, 1 υαλοπίνακας</td>
								<td>0.82</td>
								<td>7.5</td>
							</tr>
							<tr>
								<td>Μαύρο χρώμα, 2 υαλοπίνακες ή επιλεκτική επιφάνεια με 1 υαλοπίνακα</td>
								<td>0.75</td>
								<td>5</td>
							</tr>
							<tr>
								<td>Σωλήνες κενού-αέρος</td>
								<td>0.57</td>
								<td>1.82</td>
							</tr>
							<tr>
								<td>Απλός συλλέκτης (πλαστικοί σωλήνες) χωρίς κάλυμμα και μόνωση (ταχύτητα ανέμου 2.2m/s)</td>
								<td>0.86</td>
								<td>21.5</td>
							</tr>
							</table>	
					</div>
				</div>
			</div>	
			
		</div>
		<!-- /.box-group -->
	</div>
<!-- /.box-body -->
</div>
<!-- /.box -->