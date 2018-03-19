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
<!-- /.content-wrapper -->
<footer class="main-footer">
<div class="pull-right hidden-xs">
<?php
echo APPLICATION_NAME." <b>Version</b> ".APPLICATION_VERSION;
?>
</div>
Το λογισμικό αυτό διατίθεται δωρεάν με τους όρους της <a href="http://fsfe.org/projects/gplv3/gplv3.el.html" target="_blank">GPLv3 αδείας</a>.<br/>

<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
echo "Η σελίδα φόρτωσε σε ".$total_time." δευτερόλεπτα.";

	//Δεν υπάρχει internet
		if(is_connected()==false){

    echo "<br/>Δεν βρέθηκε σύνδεση στο διαδίκτυο. Συγκεκριμένες επιλογές δεν λειτουργούν (πχ υπόβαθρα χαρτών).";


		}
	
?>
</footer>
<script type="text/javascript" src="javascripts/bootstrap-treenav.js" /></script>