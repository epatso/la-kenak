<?php
/*
Copyright (C) 2013 - Labros Asfaleia v.1.0 beta
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

Το παρόν με την ονομασία Labros Asfaleia v.1.0 beta με δημιουργό τον Λάμπρο Καρούντζο
στοιχεία επικοινωνίας info@chem-lab.gr www.chem-lab.gr
είναι δωρεάν λογισμικό. Μπορείτε να το τροποποιήσετε και επαναδιανείμετε υπό τους
όρους της άδειας GNU General Public License όπως δίδεται από το Free Software Foundation
στην έκδοση 3 αυτής της άδειας.
Το παρόν σχόλιο πρέπει να παραμένει ως έχει ώστε να τηρείται η παραπάνω άδεια κατά τη διανομή.
*/
//error_reporting(E_ALL);
require("include_check.php");
confirm_logged_in();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
	<h1>
	La-kenak
	<small>Κέντρο υποστήριξης</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-edit"></i> Χρήστης</a></li>
	<li class="active"> Υποστήριξη</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
	<!-- Main row -->
	<div class="row">
			
		<div class="col-md-12">
			<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs-1" data-toggle="tab"><i class="fa fa-life-ring"></i> Κέντρο υποστήριξης</a></li>
				<li><a href="#tabs-2" data-toggle="tab"><i class="fa fa-question-circle"></i> Βοήθεια</a></li>
			</ul>
			
		<!-- ########################## MESSAGING ################################# -->
		<div class="tab-content">
			<div class="tab-pane active" id="tabs-1">
			<br/>


	<div class="row">
		<div class="col-md-3">
		<a href="#" class="btn btn-primary btn-block margin-bottom" onclick="openmodal_newticket();">Νέο ticket</a>

		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Φάκελοι</h3>

				<div class="box-tools">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			
			<?php
				$database = new medoo(DB_NAME);
				$tb_tickets= "user_tickets";
				$where_open=array("AND"=>array("user_id"=>$_SESSION['user_id'],"state"=>1));
				$where_close=array("AND"=>array("user_id"=>$_SESSION['user_id'],"state"=>2));
				$count_open = $database->count($tb_tickets,$where_open);
				$count_close = $database->count($tb_tickets,$where_close);
				$count_total = $count_open + $count_close;
			?>
			<div class="box-body no-padding">
				<ul class="nav nav-pills nav-stacked">
					<li id="navtickets0" class="active">
						<a href="#" onclick="get_tickets(0);"><i class="fa fa-inbox"></i> Όλα
						<span class="label label-primary pull-right"><?php echo $count_total;?></span></a>
					</li>
					<li id="navtickets1">
						<a href="#" onclick="get_tickets(1);"><i class="fa fa-envelope-open-o"></i> Ανοικτά
						<span class="label label-primary pull-right"><?php echo $count_open;?></span></a>
					</li>
					<li id="navtickets2">
						<a href="#" onclick="get_tickets(2);"><i class="fa fa-envelope-o"></i> Κλειστό
						<span class="label label-primary pull-right"><?php echo $count_close;?></span></a>
					</li>
				</ul>
			</div><!-- /.box-body -->
		</div><!-- /. box -->
          
		
		</div><!-- /.col -->
		
		<div class="col-md-9">
			
			<div id="user_tickets"></div>
			<div id="user_tickets_info"></div>
          
		</div><!-- /.col -->

	</div><!-- /.row -->
      

	</div><!--tabs-1-->
	
	<script>
	function setUpToolTipHelpers() {
		$(".tip-top").tooltip({
			placement: 'top',
			html: true,
			animation: true
		});
		$(".tip-right").tooltip({
			placement: 'right',
			html: true,
			animation: true
		});
		$(".tip-bottom").tooltip({
			placement: 'bottom',
			html: true,
			animation: true
		});
		$(".tip-left").tooltip({
			placement: 'left',
			html: true,
			animation: true
		});
		$('.box-widget').boxWidget();
	}
	
	
	get_tickets();
	//Εμφάνιση των ticket του χρήστη
	function get_tickets(state){
	state = typeof state !== 'undefined' ? state : 0;
		document.getElementById('wait').style.display="inline";
		
		for(var i=0; i<=2; i++){
			if ( document.getElementById('navtickets'+i).classList.contains('active') ){
				document.getElementById('navtickets'+i).classList.remove('active');
			}
			if(state==i){
				document.getElementById('navtickets'+i).classList.add('active');
			}
		}
		
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","includes/functions_userlibraries.php?get_usertickets=1&state="+state ,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("user_tickets").innerHTML=xmlhttp.responseText;
			document.getElementById('wait').style.display="none";
			setUpToolTipHelpers();
		}}
		
	}
	
	
	//Άνοιγμα νέου ticket
	function open_ticket(){
		var title = document.getElementById("tickets_title").value;
		var text = document.getElementById("tickets_text").value;
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","includes/functions_userlibraries.php?insert_usertickets=1&title="+title+"&text="+text ,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("user_tickets_info").innerHTML=xmlhttp.responseText;
			document.getElementById('wait').style.display="none";
			get_tickets(0);
			setUpToolTipHelpers();
		}}
	}
	
	//Κλείσιμο ticket
	function close_ticket(id){
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","includes/functions_userlibraries.php?close_usertickets=1&id="+id ,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("user_tickets_info").innerHTML=xmlhttp.responseText;
			document.getElementById('wait').style.display="none";
			get_tickets(0);
			setUpToolTipHelpers();
		}}
	}
	
	//Σχολιασμός ticket
	function comment_ticket(id){
		var text = document.getElementById("tickets_comment"+id).value;
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","includes/functions_userlibraries.php?comment_usertickets=1&id="+id+"&text="+text ,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("user_tickets_info").innerHTML=xmlhttp.responseText;
			document.getElementById('wait').style.display="none";
			get_tickets(0);
			setUpToolTipHelpers();
		}}
	}
	
	//ΑΝΟΙΓΜΑ Modals
	//Εμφάνιση modal νέο ticket
	function openmodal_newticket(){
		document.getElementById("tickets_title").value="";
		document.getElementById("tickets_text").value="";
		$("#modal_openticket").modal("show");
	}
	
	//Εμφάνιση modal κλείσιμο ticket
	function openmodal_closeticket(id){
		var button = '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick="close_ticket('+id+');">Κλείσιμο ticket</button>';
		document.getElementById("btn_closeticket").innerHTML = button;
		$("#modal_closeticket").modal("show");
	}
	</script>
	
<!-- ###################### Κρυφό modal_openticket για εμφάνιση ###################### -->
<div id="modal_openticket" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h4 id="myModalLabel"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Ανοίξτε ένα νέο ticket</h4>
	</div>

	<div class="modal-body">
		<div class="input-group">
			<span class="input-group-addon">
				<span class="tip-top" href="#" title="Τίτλος ticket όπως θα εμφανίζεται"><i class="fa fa-font" aria-hidden="true"></i> Τίτλος ticket</span>
			</span>
			<input class="form-control input-sm" type="text" id="tickets_title">
		</div>
		<br/>
		<div class="input-group">
			<span class="input-group-addon">
				<span class="tip-top" href="#" title="Κείμενο προβλήματος (έως 250 χαρακτήρες)"><i class="fa fa-comment-o"></i> Κείμενο ticket</span>
			</span>
			<textarea class="form-control" rows="5" id="tickets_text"></textarea>
		</div>
		<br/>
		Δώστε ένα χαρατηριστικό τίτλο για εύκολη αναζήτηση. Περιγράψτε σύντομα το πρόβλημα ώστε να γίνεται κατανοητό. <br/>
		Αφού δημιουργήσετε το ticket δεν μπορείτε να το διαγράψετε. 
	</div>	
	
	<div class="modal-footer">	
		<span id="btn_openticket">
			<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="open_ticket();">Δημιουργία</button>
		</span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
<!-- ###################### Κρυφό modal_closeticket για εμφάνιση ###################### -->
<div id="modal_closeticket" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h6 id="myModalLabel">Κλείσιμο θέματος (ticket)</h6>
	</div>

	<div class="modal-body">
	Εάν το θέμα λύθηκε κλείστε το ticket. Οι διαχειριστές δεν απαντούν σε κλειστά ticket. <br/><br/>
	</div>	
	
	<div class="modal-footer">	
		<span id="btn_closeticket"></span>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Άκυρο</button>
	</div>
</div>
</div>
</div>
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->	
	
	
	
	
	
	
	<div class="tab-pane" id="tabs-2">
	
		<br/>
		Εδώ μπορείτε να κάνετε ερωτήσεις ανοίγοντας "tickets". <br/><br/>
		<h5>Σήμανση</h5>
		<ul>
			<li><span class="label label-default"><i class="fa fa-clock-o" aria-hidden="true"></i> Ημερομηνία δημιουργίας / απάντησης</span></li>
			<li><span class="label label-primary"><i class="fa fa-reply" aria-hidden="true"></i> Απαντήσεις των διαχειριστών στο ticket</span></li>
			<li><span class="badge bg-red"><i class="fa fa-envelope-open-o" aria-hidden="true"></i> Ανοικτό (μη επιλυμένο) ticket</span></li>
			<li><span class="badge bg-green"><i class="fa fa-envelope-o" aria-hidden="true"></i> Κλειστό (επιλυμένο) ticket</span></li>
			<li><i class="fa fa-plus"></i> : Άνοιγμα επιπλέον πληροφοριών ticket</li>
		</ul>
		<br/>
		Τα tickets είναι απλά ερωτήματα προς την ομάδα διαχείρισης τα οποία αφορούν κυρίως τη λειτουργία του λογισμικού, και του τρόπου εισόδου. <br/><br/>
		Τα ticket δεν αφορούν την υλοποίηση της μελέτης. Δεν απαντώνται δηλαδή ερωτήματα που αφορούν την ίδια την υλοποίηση της μελέτης. <br/>
		Απλά παραδείγματα ερωτήσεων που μπορούν να απαντηθούν είναι:<br/>
		<ul>
			<li>Που γίνεται η εισαγωγή του δομικού στοιχείου σε επαφή με ...; </li>
			<li>Που γίνεται η εισαγωγή του ... συντελεστή;</li>
			<li>Που βρίσκεται ο ... υπολογισμός;</li>
			<li>Πως εισάγεται το θεωρητικό σύστημα;</li>
		</ul>
		Παραδείγματα που δεν απαντώνται είναι:<br/>
		<ul>
			<li>
				Τι συντελεστή να επιλέξω; <br/>
				<i>Δεν αφορά το λογισμικό και αφορά την ίδια την εργασία του μηχανικού. Εάν ψάχνετε μηχανικό απευθυνθείτε σε συνάδελφο. </i>
			</li>
			<li>
				Γιατί δεν εμφανίζονται σωστά αποτελέσματα; <br/>
				<i>Μπορεί τα δεδομένα εισόδου να είναι λανθασμένα και το ερώτημα είναι πολύ γενικό.</i>
			</li>
			<li>
				Πως να κάνω αυτό τον υπολογισμό για να εισάγω το συντελστή ...; <br/>
				<i>Αφορά κάποια διαδικασία που προηγείται του La kenak. Βρίσκεται στην ΤΟΤΕΕ και προηγείται της εισόδου (πχ φύλλο ελέγχου λέβητα, μπεκ κ.λπ.)</i>
			</li>
			<li>
				Πως να πάρω τα δεδομένα και να τα προσθέσω στo TEE-KENAK ...; <br/>
				<i>Αφορά κάποια διαδικασία που έπεται του La kenak. Αφορά άλλο λογισμικό ή άλλο σύστημα ή επιπλέον εργασία. </i>
			</li>
		</ul>
		
		Γενικά γίνεται προσπάθεια να απαντώνται όλα τα ερωτήματα, ο χώρος όμως αυτός δημιουργήθηκε για προβλήματα, παραλείψεις και διορθώσεις του ίδιου 
		του λογισμικού και όχι ως χώρος ανταλλαγής απόψεων πάνω σε μελέτες, πιστοποιητικά ή τεχνικά θέματα. <br/><br/>
		
		Τα αιτήματα υποστήριξης δεν μπορείτε να τα διαγράψετε. Μπορείτε αντίθετα να τα κλείσετε και να θεωρηθούν ως επιλυμένα εάν δεν επιθυμείτε τη συνέχεια του 
		ερωτήματος. 
		
	</div><!--tabs-2-->
			
					</div><!--tab content-->
				</div><!--tabs-->
		</div><!--col-md-10-->
	</div>
	 <!-- /.row (main row) -->
</section>
<!-- /.content -->
<script>
	$("input").alphanum();	
</script>
</div>
<!-- /.content-wrapper -->