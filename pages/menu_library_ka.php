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
			</div>
			</div>
			</div>
	</div><!--col-md-12-->	
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

