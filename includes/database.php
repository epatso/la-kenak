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

include ('include_check.php');
// Για τη βάση δεδομένων
define("DB_SERVER", "localhost"); //το όνομα του διακομιστή.Για xampp,mamp κλπ χρησιμοποιείστε localhost
define("DB_USER", "root"); //το όνομα του χρήστη.
define("DB_PASS", "12345"); //το συνθηματικό για τον παραπάνω χρήστη. Το έχετε δηλώσει στο http://localhost/security/index.php για xampp
define("DB_NAME", "labros_kenakv5"); //το όνομα της βάσης δεδομένων

define("VERSION_ΤΕΕ", "1.31.1.9"); //Η τρέχουσα έκδοση του ΤΕΕ-ΚΕΝΑΚ
define("APPLICATION_VERSION", "5.0"); //Η τρέχουσα έκδοση της διανομής
define("APPLICATION_NAME", "La-kenak"); //Η ονομασία της διανομής
define("APPLICATION_FOLDER", "http://".$_SERVER["HTTP_HOST"]."/kenakv5/"); //Ο φάκελος της διανομής
define("APPLICATION_ADMIN", "admin"); //Το όνομα χρήστη του διαχειριστή
define("APPLICATION_ADMIN_ID", 1); //Το id του πίνακα users για το διαχειριστή (Ως επιπλέον δικλείδα ασφαλείας.Προτιμότερο να αλλάξει ο διαχειριστής με id=1)

?>