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
	<small>Κτίριο αναφοράς</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-university"></i> Βιβλιοθήκες</a></li>
	<li class="active"> Κτίριο αναφοράς</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
	<div class="col-md-12">	
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs-1" data-toggle="tab">Ζώνη (KA)</a></li>
				<li><a href="#tabs-2" data-toggle="tab">Κέλυφος (KA)</a></li>
				<li><a href="#tabs-3" data-toggle="tab">Συστήματα (Θεωρητικά)</a></li>
				<li><a href="#tabs-4" data-toggle="tab">K.EN.A.K. Απαιτήσεις</a></li>
				<li><a href="#tabs-5" data-toggle="tab">K.EN.A.K. MEA</a></li>
			</ul>
			
			<div class="tab-content">
			<div class="tab-pane active" id="tabs-1">
			
			<table class="table table-bordered">
				<tr class="info">
				<td colspan="3">Θερμική ζώνη</td>
				</tr>
				
				<tr>
				<th>Μέγεθος</th>
				<th>Τιμή</th>
				<th>Μονάδες</th>
				</tr>
				
				<tr>
				<td>Ανηγμένη θερμοχωρητικότητα (ΚΑ)</td>
				<td>250</td>
				<td>KJ/m<sup>2</sup>.K</td>
				</tr>
				
				<tr>
				<td>Αυτοματισμοί θέρμανσης - ψύξης (Θεωρητικό)</td>
				<td colspan="2">Κατηγορία Δ </td>
				</tr>
				
				<tr>
				<td>Αερισμός από κουφώματα (ΚΑ)</td>
				<td>5.5 </td>
				<td>m<sup>3</sup>/h/m<sup>2</sup> </td>
				</tr>
			</table>
			
			</div>
			
			<div class="tab-pane" id="tabs-2">
			
			<table class="table table-bordered">
				<tr class="info">
				<td colspan="3">Αδιαφανή</td>
				</tr>
				
				<tr>
				<th>Μέγεθος</th>
				<th>Τιμή</th>
				</tr>
				
				<tr>
				<td>Συντελεστής θερμοπερατότητας U</td>
				<td>U<sub>max</sub> κατά Κ.ΕΝ.Α.Κ</td>
				</tr>
				
				<tr>
				<td>Απορροφητικότητα (α)</td>
				<td>κατακόρυφα: 0.40 <br/> δώματα: 0.40 <br/> στέγες: 0.60</td>
				</tr>
				
				<tr>
				<td>Συντελεστής εκπομπής (ε)</td>
				<td>0.80</td>
				</tr>
				
				<tr>
				<td>Μέσος συντελεστής σκίασης θέρους (F_h)</td>
				<td>0.90 <br/> 1 για κατακόρυφα ή κεκλιμένα </td>
				</tr>
				
				<tr>
				<td>Μέσος συντελεστής σκίασης χειμώνα (F_c)</td>
				<td>0.90 <br/> 1 για κατακόρυφα ή κεκλιμένα</td>
				</tr>
				
				<tr>
				<td>Συντελεστής σκίασης ορίζοντα (Fhor,h / Fhor,c)</td>
				<td>Όπως στο υπάρχον </td>
				</tr>
			</table>
			
			<table class="table table-bordered">
				<tr class="info">
				<td colspan="2">Διαφανή</td>
				</tr>
				
				<tr>
				<th>Μέγεθος</th>
				<th>Τιμή</th>
				</tr>
				
				<tr>
				<td>Συντελεστής θερμοπερατότητας U</td>
				<td>U<sub>max</sub> κατά Κ.ΕΝ.Α.Κ</td>
				</tr>
				
				<tr>
				<td>Ποσοστό πλαισίου</td>
				<td>20%</td>
				</tr>
				
				<tr>
				<td>Διαπερατότητα (g<sub>w</sub>)</td>
				<td>0.55</td>
				</tr>
				
				<tr>
				<td>Μέσος συντελεστής σκίασης θέρους (F_h)</td>
				<td>Β: 1.00 <br/> ΒΑ/ΒΔ: 0.80<br/> Α/Δ: 0.75 <br/> Ν: 0.70 <br/> ΝΑ/ΝΔ: 0.73<br/> 1 για κατακόρυφα ή κεκλιμένα</td>
				</tr>
				
				<tr>
				<td>Μέσος συντελεστής σκίασης χειμώνα (F_c)</td>
				<td>Όπως στο υπάρχον<br/> 1 για κατακόρυφα ή κεκλιμένα</td>
				</tr>
				
				<tr>
				<td>Συντελεστής σκίασης ορίζοντα (Fhor,h / Fhor,c)</td>
				<td>Όπως στο υπάρχον </td>
				</tr>
				
			</table>
			
			
			
			</div>
			
			<div class="tab-pane" id="tabs-3">

<table class="table table-bordered">
<tr class="info">
<td colspan="2">Θέρμανση</td>
</tr>

<tr>
<th>Είδος</th>
<th>Προδιαγραφές</th>
</tr>

<tr>
<td>Μονάδα παραγωγής<br/>(παρ. 4.1.1δ)</td>
<td>
Τύπος: τοπικές ηλεκτρικές μονάδες<br/>
Πηγή ενέργειας: Ηλεκτρισμός<br/>
Ισχύς: 0 kW<br/>
Β.Απ.: 1.000<br/>
COP: 1.000<br/>
Συντελεστές: <br/>
Ζώνη Α/Β:Ιαν-Φεβ-Μαρ-Απρ-Νοε-Δεκ = 1<br/>
Ζώνη Γ/Δ:Ιαν-Φεβ-Μαρ-Απρ-Οκτ-Νοε-Δεκ = 1<br/>
</td>
</tr>

<tr><td>Δίκτυο διανομής<br/>(παρ. 4.3.1)</td>
<td>
Δίκτυο διανομής θερμού μέσου<br/>
Ισχύς: 0 kW<br/>
Χώρος διέλευσης: "Εσωτερικοί ή έως και 20% σε εξωτερικούς"<br/>
Β.Απ.: 1.00<br/>
Μόνωση: Χωρίς μόνωση<br/>
</td></tr>
<tr><td>Τερματικές μονάδες<br/>(παρ. 4.4.1)</td>
<td>
Τύπος: κενό<br/>
Β.Απ.: 0.94<br/>
</td></tr>
<tr><td>Βοηθητικές μονάδες<br/>(παρ. 4.5)</td>
<td>
Τύπος: κενό<br/>
Αριθμός: 1<br/>
Ισχύς: 0.00 W/m<sup>2</sup><br/>
<font color="red">Οι τιμές εισάγονται σε KW</font>
</td></tr>
</table><br/><br/>


<table class="table table-bordered">
<tr class="info">
<td colspan="2">Ψύξη</td>
</tr>

<tr><th>Είδος</th><th>Προδιαγραφές</th></tr>
<tr><td>Μονάδα παραγωγής<br/>(παρ. 4.2.1)</td>
<td>
Τύπος: Αερόψυκτη Α.Θ.<br/>
Πηγή ενέργειας: Ηλεκτρισμός<br/>
Ισχύς: 0KW<br/>
Β.Απ.: 1.00<br/>
SEER: <br/>
Κατοικίες: 1.70<br/>
Τριτογενής τομέας: 2.20<br/>
Συντελεστές: <br/>
Κατοικίες:<br/>
Ζώνη Α/Β:Μαι-Ιουν-Ιουλ-Αυγ-Σεπ = 0.5<br/>
Ζώνη Γ/Δ:Μαι-Ιουν-Ιουλ-Αυγ-Σεπ = 0<br/>
Τριτογενής τομέας:<br/>
Ζώνη Α/Β:Μαι-Ιουν-Ιουλ-Αυγ-Σεπ = 1<br/>
Ζώνη Γ/Δ:Μαι-Ιουν-Ιουλ-Αυγ-Σεπ = 0<br/>
</td></tr>
<tr><td>Δίκτυο διανομής<br/>(παρ. 4.3.1)</td>
<td>
Ισχύς: 0 ΚW<br/>
Χώρος διέλευσης: "Εσωτερικοί ή έως και 20% σε εξωτερικούς"<br/>
Β.Απ.: <br/>
Κατοικίες: 1.00<br/>
Τριτογενής τομέας:0.95<br/>
Μόνωση: Χωρίς μόνωση<br/>
</td></tr>
<tr><td>Τερματικές μονάδες<br/>(παρ. 4.4.1)</td>
<td>
Τύπος: κενό<br/>
Β.Απ.: 0.93<br/>
</td></tr>
<tr><td>Βοηθητικές μονάδες<br/>(παρ. 4.5)</td>
<td>
Τύπος: κενό<br/>
Αρ.: 1<br/>
Ισχύς: <br/>
Κατοικίες: 0ΚW<br/>
Τριτογενής τομέας: εμβαδόν θερμικής ζώνης x  5 W/m<sup>2</sup><br/>
<font color="red">Οι τιμές εισάγονται σε KW</font>
</td></tr>
</table><br/><br/>


<table class="table table-bordered">
<tr class="info">
<td colspan="2">ΖΝΧ</td>
</tr>

<tr><th>Είδος</th><th>Προδιαγραφές</th></tr>
<tr><td>Μονάδα παραγωγής<br/>(παρ. 4.8.1.1)</td>
<td>
Τύπος: Τοπικός ηλεκτρικός θερμαντήρας<br/>
Πηγή ενέργειας: Ηλεκτρισμός<br/>
Ισχύς: 0 kW<br/>
Β.Απ.: 1.000<br/>
Συντελεστές: Ιαν-Φεβ-Μαρ-Απρ-Μαι-Ιου-Ιουλ-Αυγ-Σεπ-Οκτ-Νοε-Δεκ=1<br/>
</td></tr>
<tr><td>Δίκτυο διανομής<br/>(παρ. 4.8.3)</td>
<td>
Τύπος: κενό<br/>
Ανακυκλοφορία: Χωρίς ανακυκλοφορία<br/>
Χώρος διέλευσης: "Εσωτερικοί ή έως και 20% σε εξωτερικούς"<br/>
Β.Απ.: 1.00<br/>
</td></tr>
<tr><td>Αποθηκευτικές μονάδες<br/>(παρ. 4.8.4)</td>
<td>
Τύπος: κενό<br/>
Β.Απ.: 0.98<br/>
</td></tr>
<tr><td>Βοηθητικές μονάδες<br/>(παρ. 4.8.5)</td>
<td>
Τύπος: κενό<br/>
Αριθμός: 1<br/>
Ισχύς: 0ΚW<br/>
<font color="red">Οι τιμές εισάγονται σε KW</font>
</td></tr>
</table><br/><br/>

<table class="table table-bordered">
<tr class="info">
<td colspan="2">Φωτισμός (παρ. 5.1.3.1)</td>
</tr>

<tr>
<th>Παράμετρος</th>
<th>Τιμή</th>
</tr>

<tr><td>Εγκατεστημένη Ισχύς:</td><td>εμβαδόν θερμικής ζώνης x ισχύς φωτισμού κτιρίου αναφοράς από συνθήκες λειτουργίας ζώνης</td></tr>
<tr><td>Περιοχή ΦΦ:</td><td>κενό</td></tr>
<tr><td>Αυτοματισμοί ελέγχου ΦΦ.:</td><td>Χειροκίνητος</td></tr>
<tr><td>Αυτοματισμοί ανίχνευσης κίνησης:</td><td>Χειροκίνητος διακόπτης αφής/σβέσης</td></tr>
<tr><td>Σύστημα απομάκρυνσης θερμότητας:</td><td>Χωρίς σύστημα απομάκρυνσης θερμότητας</td></tr>
<tr><td>Φωτισμός ασφαλείας:</td><td>Με φωτισμό ασφαλείας</td></tr>
<tr><td>Σύστημα εφεδρείας:</td><td>Χωρίς εφεδρικό σύστημα</td></tr>
</table><br/><br/>


<table class="table table-bordered">
<tr class="info">
<td colspan="2">Μηχανικός αερισμός (παρ. 4.6γ)</td>
</tr>

<tr>
<th>Παράμετρος</th>
<th>Τιμή</th>
</tr>

<tr><td>Τύπος:</td><td>κενό</td></tr>
<tr><td>Τμήμα Θέρμανσης:</td><td>Χωρίς τμήμα θέρμανσης</td></tr>
<tr><td>F_h:</td><td>εμβαδόν θερμικής ζώνης x απαιτούμενο νωπό αέρα από συνθήκες λειτουργίας ζώνης</td></tr>
<tr><td>R_h:</td><td>0</td></tr>
<tr><td>Q_r_h:</td><td>0</td></tr>
<tr><td>Τμήμα Ψυξης:</td><td>Χωρίς τμήμα ψύξης</td></tr>
<tr><td>F_c:</td><td>εμβαδόν θερμικής ζώνης x απαιτούμενο νωπό αέρα από συνθήκες λειτουργίας ζώνης</td></tr>
<tr><td>R_c:</td><td>0</td></tr>
<tr><td>Q_r_c:</td><td>0</td></tr>
<tr><td>Τμήμα Ύγρανσης:</td><td>Χωρίς τμήμα Ύγρανσης</td></tr>
<tr><td>H_r:</td><td>0</td></tr>
<tr><td>Φίλτρα:</td><td>Χωρίς φίλτρα</td></tr>
<tr><td>E_vent:</td><td>1 (με ανεμιστήρες ειδικής ηλεκτρικής ισχύος 1)</td></tr>
</table><br/><br/>
			</div><!--tabs-3-->	
			
			<div class="tab-pane" id="tabs-4">
			<h4>Αριθμ. ΔΕΠΕΑ/οικ.178581 (ΦΕΚ2367Β/12-7-2017) - Έγκριση Κανονισμού Ενεργειακής Απόδοσης Κτιρίων</h4>
			<h5>Άρθρο 8 - Ελάχιστες προδιαγραφές κτιρίων</h5>
			<hr/>
			<ul>
				<li>1. Σχεδιασμός κτιρίου
					<ul>
					<li>1.1 Στο σχεδιασμό του κτιρίου λαμβάνονται υπόψη οικάτωθι παράμετροι:
						<ul>
							<li>1.1.1 Η κατάλληλη χωροθέτηση και προσανατολισμός του κτιρίου για τη μέγιστη αξιοποίηση των τοπικών κλιματικών συνθηκών.</li>
							<li>1.1.2 Η διαμόρφωση του περιβάλλοντα χώρου για τη βελτίωση του μικροκλίματος.</li>
							<li>1.1.3 Ο κατάλληλος σχεδιασμός και χωροθέτηση των ανοιγμάτων ανά προσανατολισμό ανάλογα με τις απαιτήσεις ηλιασμού, 
							φυσικού φωτισμού και αερισμού.</li>
							<li>1.1.4 Η χωροθέτηση των λειτουργιών ανάλογα με τη χρήση και τις απαιτήσεις άνεσης (θερμικές, φυσικού αερισμού και φωτισμού).</li>
							<li>1.1.5 Η ενσωμάτωση τουλάχιστον ενός εκ των παθητικών ηλιακών συστημάτων (ΠΗΣ), όπως άμεσου ηλιακού κέρδους 
							(νότια ανοίγματα), τοίχος μάζας, τοίχος Trombe, θερμοκήπιο - ηλιακός χώρος κ.ά., εφόσον αυτό είναι λειτουργικά εφικτό.</li>
							<li>1.1.6 Η ηλιοπροστασία.</li>
							<li>1.1.7 Η ένταξη τεχνικών φυσικού αερισμού.</li>
							<li>1.1.8 Η εξασφάλιση οπτικής άνεσης μέσω τεχνικών και συστημάτων φυσικού φωτισμού.</li>
						</ul>
					</li>
					<li>1.2 Αδυναμία εφαρμογής των ανωτέρω απαιτεί επαρκή τεχνική τεκμηρίωση σύμφωνα με την ισχύουσα νομοθεσία και τις επικρατούσες συνθήκες.</li>
					</ul>
				</li>
				<li>2. Κτιριακό κέλυφος
					<ul>
					<li>2.1 Θερμοφυσικά χαρακτηριστικά των δομικών στοιχείων του κτιριακού κελύφους:
						<ul>
							<li>2.1.1 Τα επιμέρους δομικά στοιχεία του κελύφους του εξεταζόμενου κτιρίου ή κτιριακής μονάδας, πληρούν τους περιορισμούς θερμομόνωσης 
							των πινάκων Γ.1 και Γ.2.</li>
							<li>2.1.2 Για τα δομικά στοιχεία που αποτελούν παθητικά ηλιακά συστήματα δεν ισχύει ο περιορισμός του μέγιστου επιτρεπόμενου συντελεστή 
							θερμοπερατότητας, με την εξαίρεση του συστήματος άμεσου ηλιακού κέρδους.</li>
							<li>2.1.3 Η τιμή του μέσου συντελεστή θερμοπερατότητας (Um) του εξεταζόμενου κτιρίου δεν υπερβαίνει τα όρια που δίδονται στους πίνακες 
							Γ.3 και Γ.4 και στα διαγράμματα Γ.1 και Γ.2</li>
							<li>2.1.4 Η απαίτηση τήρησης του μέγιστου επιτρεπόμενου μέσου συντελεστή θερμοπερατότητας Um, δεν ισχύει στην περίπτωση κτιριακών μονάδων.</li>
						</ul>
					</li>
					<li>2.2 Για τα κτίρια ή κτιριακές μονάδες που ενσωματώνουν στο κέλυφος παθητικά συστήματα, πέραν αυτών του άμεσου κέρδους (νότια ανοίγματα), 
					τα συστήματα αυτά δε λαμβάνονται υπόψη στους υπολογισμούς του μέσου συντελεστή θερμοπερατότητας (Um) ως έχουν, αλλά αντικαθίστανται με αντίστοιχα 
					συμβατικά δομικά μη διαφανή στοιχεία με θερμικά χαρακτηριστικά, όπως ορίζονται στους πίνακες Γ.1 και Γ.2 για τους εξωτερικούς τοίχους σε επαφή με 
					τον εξωτερικό αέρα.</li>
					<li>2.3 Η διαδικασία υπολογισμού των συντελεστών θερμοπερατότητας των δομικών στοιχείων, των γραμμικών συντελεστών θερμοπερατότητας (θερμογεφυρών), 
					καθώς και του μέγιστου επιτρεπόμενου μέσου συντελεστή θερμοπερατότητας (Um) του κτιρίου, καθορίζεται με σχετική ΤΟΤΕΕ.</li>
					</ul>
				</li>
				<li>3. Τεχνικά συστήματα
					<ul>
						<li>3.1 Τα επιμέρους τεχνικά συστήματα του εξεταζόμενου κτιρίου ή κτιριακής μονάδας, πληρούν τους ακόλουθους περιορισμούς:
							<ul>
								<li>3.1.1 Όλα τα δίκτυα διανομής (νερού ή αλλού μέσου) των τεχνικών συστημάτων ΘΨΚ και ΖΝΧ διαθέτουν θερμομόνωση που καθορίζεται με 
								σχετική ΤΟΤΕΕ. Ιδιαίτερα οι εγκαταστάσεις δικτύων που διέρχονται από εξωτερικούς χώρους διαθέτουν κατ’ ελάχιστον πάχος θερμομόνωσης 
								19mm για θέρμανση ή/και ψύξη χώρων και 13mm για ΖΝΧ, με αγωγιμότητα θερμομονωτικού υλικού λ=0,040 W/(m.K) (στους 20οC). Τα δίκτυα 
								διανομής, θερμού και ψυχρού μέσου, διαθέτουν σύστημα αντιστάθμισης για την αντιμετώπιση των μερικών φορτίων ή άλλο ισοδύναμο σύστημα 
								μείωσης της κατανάλωσης ενέργειας υπό μερικό φορτίο.</li>
								<li>3.1.2 Οι απαιτήσεις για νωπό αέρα στα κτίρια του τριτογενούς τομέα καλύπτονται μέσω μηχανικού αερισμού [προσαγωγής νωπού αέρα ή 
								κεντρικής κλιματιστικής μονάδας διαχείρισης αέρα (ΚΚΜ) κ.τ.λ.]. Κάθε σύστημα μηχανικού αερισμού που εγκαθίσταται στο κτίριο είναι σύμφωνο 
								με τα οριζόμενα στον Κανονισμό (ΕΕ) αριθμ. 1253/2014 και ιδίως τα Παραρτήματα ΙΙ και ΙΙΙ αυτού. Οι αεραγωγοί διανομής κλιματιζόμενου αέρα 
								(προσαγωγής και ανακυκλοφορίας) που διέρχονται από εξωτερικούς χώρους των κτιρίων διαθέτουν θερμομόνωση με αγωγιμότητα θερμομονωτικού 
								υλικού λ=0,040 W/(m.K) και πάχος θερμομόνωσης τουλάχιστον 40mm, ενώ για διέλευση σε εσωτερικούς χώρους το αντίστοιχο πάχος είναι 30mm.</li>
								<li>3.1.3 Σε όλα τα νέα κτίρια ή κτιριακές μονάδες είναι υποχρεωτική η κάλυψη μέρους των αναγκών σε ζεστό νερό χρήσης από ηλιοθερμικά συστήματα. 
								Το ελάχιστο ποσοστό του ηλιακού μεριδίου σε ετήσια βάση καθορίζεται σε 60%. Στα υφιστάμενα κτίρια ή κτιριακές μονάδες που ανακαινίζονται ριζικά, η 
								ως άνω υποχρέωση ισχύει στο βαθμό που αυτό είναι τεχνικά, λειτουργικά και οικονομικά εφικτό. Η υποχρέωση αυτή δεν ισχύει: 
									<ul>
										<li>- όταν οι ανάγκες σε ΖΝΧ καλύπτονται από άλλα συστήματα παροχής ενέργειας που βασίζονται σε ΑΠΕ, ΣΗΘ, συστήματα τηλεθέρμανσης 
										σε κλίμακα περιοχής ήοικοδομικού τετραγώνου, καθώς και από αντλίες θερμό τητας που προσφέρουν σημαντικά μεγαλύτερο ποσοστό θερμικής 
										ενέργειας από αυτό που καταναλώνουν για τη λειτουργία τους. Στις εν λόγω αντλίες θερμότητας ο εποχιακός βαθμός απόδοσης (SPF) πρέπει 
										να είναι μεγαλύτερος από (1,15x1/η), όπου "η" είναι ο λόγος της συνολικής ακαθάριστης παραγωγής ηλεκτρικής ενέργειας προς την κατανάλωση 
										πρωτογενούς ενέργειας για την παραγωγή ηλεκτρικής ενέργειας, σύμφωνα με την κοινοτική οδηγία 2009/28/ ΕΚ, και σε κάθε περίπτωση μεγαλύτερος από 
										3,3.</li>
										<li>- για κατηγορίες χρήσεων κτιρίων χαμηλής ζήτησης σε ΖΝΧ, σύμφωνα με τα οριζόμενα στο πρότυπο ΕΛΟΤ ΕΝ/15316-3.1.2008, όπως ισχύει 
										κάθε φορά, καθώς και στις σχετικές ΤΟΤΕΕ. Σε περίπτωση μεγάλου κυκλώματος με επανακυκλοφορία του ΖΝΧ εφαρμόζεται κυκλοφορία με σταθερό 
										Δp και κυκλοφορητή με ρύθμιση στροφών βάσει της ζήτησης σε ΖΝΧ.</li>
									</ul>
								</li>
								<li>3.1.4 Όπου απαιτείται κατανομή δαπανών, επιβάλλεται αυτονομία θέρμανσης και ψύξης. Όπου απαιτείται κατανομή δαπανών για τη θέρμανση 
								χώρων, καθώς επίσης και σε κεντρικά συστήματα παραγωγής ΖΝΧ, εφαρμόζεται θερμιδομέτρηση. Σε όλα τα κτίρια απαιτείται ανεξάρτητος αυτόματος 
								έλεγχος της λειτουργίας των τερματικών μονάδων σε επίπεδο αυτόνομων χώρων (ανά λειτουργικό χώρο) με την ύπαρξη, κατ' ελάχιστον, θερμοστάτη και 
								θερμοστατικών βαλβίδων.</li>
								<li>3.1.5 Τα συστήματα γενικού φωτισμού στα κτίρια του τριτογενούς τομέα έχουν ελάχιστη φωτιστική απόδοση 60 ℓm/W. Για επιφάνεια μεγαλύτερη από 
								15m2 ο τεχνητός φωτισμός ελέγχεται με χωριστούς διακόπτες. Στους χώρους με φυσικό φωτισμό εξασφαλίζεται η δυνατότητα σβέσης τουλάχιστον του 50% 
								των λαμπτήρων που βρίσκονται εντός αυτών. Σε όλα τα κτίρια του τριτογενούς τομέα απαιτείται η εγκατάσταση κατάλληλου εξοπλισμού αντιστάθμισης 
								της άεργου ισχύος των ηλεκτρικών τους καταναλώσεων, για την αύξηση του συντελεστή ισχύος τους (συνφ) σε επίπεδο κατ’ ελάχιστον 0,95. </li>
								<li>3.1.6 Διατάξεις ελέγχου τεχνικών συστημάτων: Τα κτίρια κατοικίας και τα κτίρια του τριτογενούς τομέα με ωφέλιμη επιφάνεια μικρότερη των 
								3.500 m2, διαθέτουν τις διατάξεις αυτομάτου ελέγχου που περιλαμβάνονται στην κατηγορία Γ, όπως αυτή ορίζεται στο πρότυπο ΕΛΟΤ ΕΝ 15232:2007 
								και εξειδικεύονται σε σχετική ΤΟΤΕΕ. Τα κτίρια του τριτογενούς τομέα με ωφέλιμη επιφάνεια μεγαλύτερη των 3.500 m2, διαθέτουν τις διατάξεις αυτομάτου 
								ελέγχου που περιλαμβάνονται στην κατηγορία Β, όπως αυτή ορίζεται στο πρότυπο ΕΛΟΤ ΕΝ15232:2007 και εξειδικεύονται σε σχετική ΤΟΤΕΕ. Τα κτίρια του 
								τριτογενούς τομέα, με ωφέλιμη επιφάνεια μεγαλύτερη από 3.500 m2, διαθέτουν σύστημα ενεργειακής διαχείρισης κτιρίου (BΕMS), για τον κεντρικό έλεγχο 
								της λειτουργίας των τεχνικών συστημάτων. Τα κτίρια με χρήσεις "ξενοδοχείο"/"ξενώνας" διαθέτουν σύστημα ελέγχου ηλεκτροδότησης δωματίων μέσω 
								ηλεκτρονικών καρτών.</li>
							</ul>
						</li>
						<li>3.2 Σε κάθε περίπτωση, τα επιμέρους τεχνικά συστήματα του εξεταζόμενου κτιρίου ή κτιριακής μονάδας, συμμορφώνονται με τις απαιτήσεις που 
						ορίζονται στους εφαρμοστικούς κανονισμούς που εκδόθηκαν στο πλαίσιο των Κοινοτικών Οδηγιών 2009/125/ΕΚ και 2010/30/ΕΕ, όπως αυτές τροποποιήθηκαν 
						με την Οδηγία 2012/27/ΕΕ.</li>
					</ul>
				</li>
				<li>4. Κατά τα λοιπά ισχύουν οι προδιαγραφές του κτιρίου αναφοράς, όπως αυτές καθορίζονται στο άρθρο 9 της παρούσας και εξειδικεύονται περαιτέρω σε σχετική ΤΟΤΕΕ.</li>
				<li>5. Αδυναμία εφαρμογής των ανωτέρω απαιτεί επαρκή τεχνική τεκμηρίωση σύμφωνα με την ισχύουσα νομοθεσία και τις επικρατούσες συνθήκες.</li>
			</ul>
			<?php
				echo create_library_umax(1);
				echo create_library_ummax(1);
			?>
			<img src="images/help/umax_new.png"></img><br/>
			<?php
				echo create_library_umax(2);
				echo create_library_ummax(2);
			?>
			<img src="images/help/umax_old.png"></img><br/>
			
			</div><!--tabs-4-->
			
			<div class="tab-pane" id="tabs-5">
			
			<h4>Αριθμ. ΔΕΠΕΑ/οικ.178581 (ΦΕΚ2367Β/12-7-2017) - Έγκριση Κανονισμού Ενεργειακής Απόδοσης Κτιρίων</h4>
			<h5>Άρθρο 12 - Περιεχόμενα ΜΕΑ</h5>
			<hr/>
			Το τεύχος της ΜΕΑ περιλαμβάνει τα εξής:
			<ul>
				<li>1. Γενικές πληροφορίες
					<ul>
						<li>1.1 Γενικά στοιχεία κτιρίου: τοποθεσία, χρήση κτιρίου (κατοικία, γραφεία, κ.ά.), πρόγραμμα λειτουργίας (ωράριο), αριθμός χρηστών (συνολικός και ανά βάρδια 
						για κτίρια με 24ώρη λειτουργία).</li>
						<li>1.2 Επιθυμητές συνθήκες εσωτερικού περιβάλλοντος (θερμοκρασία, σχετική υγρασία, αερισμός, φωτισμός). Αν υπάρχουν χώροι με διαφορετικές συνθήκες, 
						όπως στα κτίρια νοσοκομείων, αναφέρονται αναλυτικά.</li>
						<li>1.3 Δεδομένα και παραδοχές για τους παράγοντες που λαμβάνονται υπόψη για τον υπολογισμό της ενεργειακής απόδοσης του κτιρίου σύμφωνα με το άρθρο 5 
						τηςπαρούσας.</li>
						<li>1.4 Τα κλιματικά δεδομένα της περιοχής (θερμοκρασία, υγρασία, ηλιακή ακτινοβολία, διεύθυνση, ένταση και ταχύτητα ανέμου κ.ά.), όπως ορίζονται με σχετική ΤΟΤΕΕ.</li>
						<li>1.5 Σύντομη περιγραφή και τεκμηρίωση του ενεργειακού σχεδιασμού του κτιρίου όσον αφορά στον αρχιτεκτονικό σχεδιασμό, τα θερμικά χαρακτηριστικά των δομικών 
						στοιχείων του κτιριακού κελύφους και το σχεδιασμό των τεχνικών συστημάτων, καθώς και στα προτεινόμενα συστήματα εξοικονόμησης ενέργειας / ορθολογικής χρήσης 
						ενέργειας και ΑΠΕ.</li>
						<li>1.6 Αναφορά του λογισμικού που χρησιμοποιήθηκε για την εκτίμηση της ενεργειακής απόδοσης του κτιρίου, καθώς και των παραδοχών που λαμβάνονται υπόψη 
						για την εφαρμογή της μεθοδολογίας όπως:
						<ul>
							<li>α) Οι θερμικές ζώνες, όπως καθορίζονται στο άρθρο 3 της παρούσας. Στην περίπτωση που για την εκπόνηση της μελέτης απαιτείται ο διαχωρισμός του κτιρίου σε 
							ζώνες (λόγω διαφοροποίησης της χρήσης των χώρων του), για τις ζώνες που καθορίζονται στους υπολογισμούς θα πρέπει να υπάρχει σχηματική και αναλυτική 
							περιγραφή και όλα τα δεδομένα ή/και οι παραδοχές – εκτός των κλιματικών – πρέπει να αναφέρονται ανά ζώνη.</li>
							<li>β) Οι θερμογέφυρες στα διάφορα στοιχεία του κτιριακού κελύφους.</li>
						</ul>
						</li>
					</ul>
				</li>
				<li>2. Σχεδιασμός κτιρίου
					<ul>
						<li>2.1 Γεωμετρικά χαρακτηριστικά του κτιρίου και των ανοιγμάτων (κάτοψη, όγκος, επιφάνεια, προσανατολισμός, συντελεστές σκίασης κ.ά.).<li>
						<li>2.2 Τεκμηρίωση της χωροθέτησης και προσανατολισμού του κτιρίου για τη μέγιστη αξιοποίηση των τοπικών κλιματικών συνθηκών, με διαγράμματα ηλιασμού, 
						λαμβάνοντας υπόψη την περιβάλλουσα δόμηση.</li>
						<li>2.3 Τεκμηρίωση της επιλογής και χωροθέτησης φύτευσης και άλλων στοιχείων βελτίωσης του μικροκλίματος.</li>
						<li>2.4 Τεκμηρίωση του σχεδιασμού και χωροθέτησης των ανοιγμάτων ανά προσανατολισμό ανάλογα με τις απαιτήσεις ηλιασμού, φωτισμού και αερισμού (ποσοστό, 
						τύπος και εμβαδό διαφανών επιφανειών ανά προσανατολισμό).</li>
						<li>2.5 Χωροθέτηση των λειτουργιών ανάλογα με τη χρήση και τις απαιτήσεις άνεσης (θερμικές, φυσικού αερισμού και φωτισμού).</li>
						<li>2.6 Περιγραφή λειτουργίας των παθητικών συστημάτων για τη χειμερινή και θερινή περίοδο: υπολογισμός επιφάνειας παθητικών ηλιακών συστημάτων άμεσου 
						και έμμεσου κέρδους (κατακόρυφης / κεκλιμένης / οριζόντιας επιφάνειας), για τα συστήματα με μέγιστη απόκλιση έως 30ο από το νότο, καθώς και του ποσοστού 
						αυτής επί της αντίστοιχης συνολικής επιφάνειας της όψης.</li>
						<li>2.7 Περιγραφή των συστημάτων ηλιοπροστασίας του κτιρίου ανά προσανατολισμό: διαστάσεις και υλικά κατασκευής, τύπος (σταθερά / κινητά, οριζόντια / 
						κατακόρυφα, συμπαγή / διάτρητα) και ένδειξη του προκύπτοντος ποσοστού σκίασης για την 21η Δεκεμβρίου και την 21η Ιουνίου.</li>
						<li>2.8 Γενική περιγραφή των τεχνικών εκμετάλλευσης του φυσικού φωτισμού.</li>
						<li>2.9 Σχεδιαστική απεικόνιση με κατασκευαστικές λεπτομέρειες της θερμομονωτικής στρώσης, των παθητικών συστημάτων και των συστημάτων 
						ηλιοπροστασίας στα αρχιτεκτονικά σχέδια του κτιρίου (κατόψεις, όψεις, τομές).</li>
					</ul>
				</li>
				<li>3. Κτιριακό κέλυφος
					<ul>
						<li>3.1 Θερμοφυσικά χαρακτηριστικά του κτιριακού κελύφους και των ανοιγμάτων (θερμοπερατότητα, ανακλαστικότητα, διαπερατότητα, απορροφητικότητα στην 
						ηλιακή ακτινοβολία κ.ά.).</li>
						<li>3.2 Περιγραφή της θέσης, των θερμοφυσικών ιδιοτήτων και του τύπου της θερμομόνωσης, όπου αυτή προβλέπεται (οροφές, δάπεδα, τοιχοποιία).</li>
						<li>3.3 Συντελεστής θερμοπερατότητας και εμβαδόν αδιαφανών στοιχείων του εξωτερικού κελύφους (τοιχοποιίας, οροφής, δαπέδων, φέροντα οργανισμού), έλεγχος 
						αυτών βάσει των απαιτούμενων ορίων ανά προσανατολισμό.</li>
						<li>3.4 Συντελεστής θερμοπερατότητας των εσωτερικών χωρισμάτων που διαχωρίζουν θερμαινόμενες και μη θερμαινόμενες ζώνες του κτιρίου.</li>
						<li>3.5 Συντελεστής θερμοπερατότητας και εμβαδό ανοιγμάτων και γυάλινων προσόψεων, έλεγχος αυτών βάσει των απαιτούμενων ορίων ανά προσανατολισμό.</li>
					</ul>
				</li>
				<li>4. Τεχνικά συστήματα
					<ul>
						<li>4.1 Τεχνικά χαρακτηριστικά των συστημάτων ΘΨΚ (απόδοση συστημάτων, είδος καυσίμου, χρόνος λειτουργίας, είδος και ισχύς τερματικών μονάδων, είδος 
						και ισχύς βοηθητικών συστημάτων διανομής, απώλειες δικτύου κ.ά.).</li>
						<li>4.2 Τεχνικά χαρακτηριστικά των κεντρικών μονάδων διαχείρισης αέρα και συστήματος μηχανικού αερισμού (διατάξεις συστήματος, φίλτρα, ύγρανση, στοιχεία 
						ψύξης/θέρμανσης, ισχύς ανεμιστήρων κ.ά.).</li>
						<li>4.3 Τεχνικά χαρακτηριστικά του συστήματος παραγωγής και διανομής ΖΝΧ (τύπος, ισχύς, ημερήσια κατανάλωση νερού, επιθυμητή θερμοκρασία ΖΝΧ, 
						απώλειες δικτύου, ποσοστό ηλιακών συλλεκτών κ.ά.).</li>
						<li>4.4 Τεχνικά χαρακτηριστικά ηλιακών συλλεκτών για παραγωγή ΖΝΧ (τύπος, συντελεστές απόδοσης κ.ά.).</li>
						<li>4.5 Τεχνικά χαρακτηριστικά του συστήματος τεχνητού φωτισμού για τα κτίρια του τριτογενούς τομέα (ζώνες φυσικού φωτισμού, ώρες χρήσης φυσικού φωτισμού, 
						αυτοματισμοί, διάταξη διακοπτών, είδος φωτιστικών, φωτιστική ικανότητα λαμπτήρων κ.ά.). Αναφορά στα συστήματα σύζευξης φυσικού και τεχνητού φωτισμού 
						και άλλα συστήματα εξοικονόμησης ενέργειας.</li>
						<li>4.6 Περιγραφή κεντρικού συστήματος παρακολούθησης και ενεργειακού ελέγχου (BΕMS), των προβλεπόμενων αυτοματισμών και ελέγχων και το αναμενόμενο 
						όφελος τους στη μείωση της κατανάλωσης ενέργειας, εφόσον προβλέπεται η εγκατάσταση και χρήση τους.</li>
						<li>4.7 Τεχνικά χαρακτηριστικά λοιπών συστημάτων, όπου προβλέπονται, και αντίστοιχη αποτύπωσή τους στα αρχιτεκτονικά και Η/Μ σχέδια, όπως: ΑΠΕ, (φωτοβολταϊκά, 
						γεωθερμικές αντλίες θέρμανσης/ψύξης), ΣΗΘ (τύπος και ισχύς συστήματος, καύσιμο, ηλεκτρικά και θερμικά φορτία κάλυψης κ.ά.), κεντρικά συστήματα θέρμανσης 
						και ψύξης σε κλίμακα περιοχής ή οικοδομικού τετραγώνου (τηλεθέρμανση).</li>
					</ul>
				</li>	
				<li>5. Αποτελέσματα υπολογισμών
					<ul>
						<li>5.1 Αναλυτικά αποτελέσματα των υπολογισμών με σαφή αναφορά των μονάδων μέτρησης των μεγεθών, όπως:
							<ul>
								<li>-Θερμικές απώλειες κελύφους και αερισμού, ηλιακά και εσωτερικά κέρδη κλιματιζόμενων χώρων.</li>
								<li>- Ετήσια τελική ενεργειακή κατανάλωση (kWh/m2), συνολική και ανά χρήση (ΘΨΚ, ΖΝΧ, φωτισμό), ανά θερμική ζώνη και ανά πηγή χρησιμοποιούμενης ενέργειας 
								(ηλεκτρισμό, πετρέλαιο κ.ά.).</li>
								<li>- Ετήσια κατανάλωση πρωτογενούς ενέργειας (kWh/m2) ανά χρήση (ΘΨΚ, ΖΝΧ, φωτισμό) και αντίστοιχες εκπομπές διοξειδίου του άνθρακα.</li>
							</ul>
						</li>
						<li>5.2 Την ενεργειακή κατηγορία στην οποία κατατάσσεται το κτίριο ή η κτιριακή μονάδα.</li>
					</ul>
				</li>
			</ul>
			</div><!--tabs-5-->
			
			</div>
			</div>
	</div><!--col-md-12-->	
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

