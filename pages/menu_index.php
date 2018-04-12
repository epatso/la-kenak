<?php
/*
Copyright (C) 2013 - Labros kenak v.4.0 beta
Author: Labros Karoyntzos 

Labros kenak v.1.0 beta from Labros Karountzos is free software: 
you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, version 3 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License version 3
along with this program.  If not, see http://www.gnu.org/licenses/gpl-3.0.html.

Το παρόν με την ονομασία Labros kenak v.1.0 beta με δημιουργό τον Λάμπρο Καρούντζο
στοιχεία επικοινωνίας info@chem-lab.gr www.chem-lab.gr
είναι δωρεάν λογισμικό. Μπορείτε να το τροποποιήσετε και επαναδιανείμετε υπό τους
όρους της άδειας GNU General Public License όπως δίδεται από το Free Software Foundation
στην έκδοση 3 αυτής της άδειας.
Το παρόν σχόλιο πρέπει να παραμένει ως έχει ώστε να τηρείται η παραπάνω άδεια κατά τη διανομή.
*/
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	  <h1>
		La-kenak
		<small>Αρχική</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
		<li class="active">Αρχική</li>
	  </ol>
	</section>

	<!-- Main content -->
	<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">

	</div>
	<!-- /.row -->
  
<!-- Main row -->
<div class="row">
	<!-- Left col -->
	<section class="col-lg-7 connectedSortable">

	  <!-- TO DO List -->
	  <div class="box box-primary">
		<div class="box-header">
			<i class="ion ion-clipboard"></i>
			<h3 class="box-title">La - kenak v<?php echo APPLICATION_VERSION; ?></h3>
			<div class="box-tools pull-right">
				
			</div>
		</div>
		<!-- /.box-header -->
		
		<div class="box-body">
		
		<h1><i class="fa fa-building-o fa-5x" aria-hidden="true"></i></i> la-kenak v<?php echo APPLICATION_VERSION; ?>!</h1>
		<p>Ο Κ.ΕΝ.Α.Κ. ένα βήμα παραπέρα... </p>
		<br/>
		Το λογισμικό <span class="label label-danger">la-kenak</span> υλοποιήθηκε με στόχο την παροχή βοήθειας σε θέματα ενεργειακών επιθεωρήσεων, ενεργειακών μελετών (με βάση 
		τον Κανονισμό ΕΝεργειακής Απόδοσης Κτιρίων) και επιδοτούμενων προγραμμάτων εξοικονομώ. Το λογισμικό αυτό έχει στόχο:<br/><br/>

		<span class="badge badge-inverse">1</span>Την παρουσίαση συνολικά της νομοθεσίας, των τεχνικών οδηγιών, των ερωτοαπαντήσεων και διευκρινίσεων και η διαρκής ενημέρωση αυτής της 
		βιβλιοθήκης ώστε ο μελετητής να διευκολύνεται στην εργασία του. <br/>
		<span class="badge badge-inverse">2</span>Την εκτέλεση όλων εκείνων των υπολογισμών ή επιλογών που απαιτούνται σε ΜΕΑ και ΠΕΑ και την παρουσίαση των αποτελεσμάτων με τρόπο 
		κατανοητό και εύχρηστο. <br/>
		<span class="badge badge-inverse">3</span>Την συμμετοχή και συνεργασία συναδέλφων είτε σε επίπεδο μελέτης είτε στο ίδιο το λογισμικό. <br/>
		<span class="badge badge-inverse">4</span>Την ανάλυση των διαθέσιμων στοιχείων των ΤΟΤΕΕ ακόμη παραπέρα. πχ την παρουσίαση της μεταβολής των συντελεστών σκίασης 
		ανάλογα με τη γωνία σκίασης για κάποιο προσανατολισμό.<br/><br/>
		
		<h5>Δείτε <a href="?nav=library_help">εδώ</a> την πολιτική χρήσης προσωπικών δεδομένων.</h5>
		<h4>Συμφωνείτε με την πολιτική χρήσης δεδομένων; 
			<a href="#"><font color="blue">NAI <i class="fa fa-thumbs-up"></i></font></a>
			<a href="http://www.google.gr"><font color="red">OXI <i class="fa fa-thumbs-down"></i></font></a>
		</h4>
		</div>
		<!-- /.box-body -->
		
		<div class="box-footer clearfix no-border">
			
		</div>
	  </div>
	  <!-- /.box -->

	</section>
	<!-- /.Left col -->
	
	<!-- right col (We are only adding the ID to make the widgets sortable)-->
	<section class="col-lg-5 connectedSortable">

	  <!-- Chat box -->
	  <div class="box box-success">
		<div class="box-header">
		  <i class="fa fa-comments-o"></i>

		  <h3 class="box-title">Shoutbox</h3>

			<div class="box-tools pull-right">
				<span class="fa fa-clock-o"></span> <span id="date_time"></span>
			</div>
		<script type="text/javascript">window.onload = date_time('date_time');</script>
		</div>
		<div class="box-body chat" id="chat-box">
		
		  <!-- chat items -->
		  <div id="shoutbox_messages"></div>
		  
		  
		</div>
		<!-- /.chat -->
		<div class="box-footer">
		<?php
		if (isset($_SESSION['username'])){
		?>
		  <div class="input-group">
			<input id="shoutbox_message" class="form-control" placeholder="Type message...">

			<div class="input-group-btn">
			  <button type="button" class="btn btn-success" onclick="insert_shoutbox();"><i class="fa fa-plus"></i></button>
			   <button type="button" class="btn btn-success" onclick="get_shoutbox();"><i class="fa fa-refresh"></i></button>
			</div>
		  </div>
		<?php
		}
		?>
		</div>
	  </div>
	  <!-- /.box (chat box) -->
	  
<script>
	function insert_shoutbox(){
		document.getElementById('wait').style.display="inline";
		var shoutbox_message = document.getElementById('shoutbox_message').value;
		
		if(shoutbox_message!=""){
			//AJAX call
			var xmlhttp=new XMLHttpRequest();
			
			xmlhttp.open("GET","includes/functions_network.php?shoutbox=1&message="+shoutbox_message ,true);
			xmlhttp.send();
			
			xmlhttp.onreadystatechange=function()  {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById("shoutbox_messages").innerHTML=xmlhttp.responseText;
				document.getElementById('wait').style.display="none";
			}}
			get_shoutbox();
		}else{//κενή τιμή κειμένου
			document.getElementById('wait').style.display="none";
			alert("Πρέπει να προσθέσετε κείμενο για να στείλετε μήνυμα σε όλους");
		}
	}
	function get_shoutbox(){
		document.getElementById('wait').style.display="inline";
		//AJAX call
		var xmlhttp=new XMLHttpRequest();
		
		xmlhttp.open("GET","includes/functions_network.php?shoutbox=1&message=0" ,true);
		xmlhttp.send();
		
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("shoutbox_messages").innerHTML=xmlhttp.responseText;
			document.getElementById('wait').style.display="none";
		}}
	}
	get_shoutbox();
</script>
	  
	  <!-- Calendar -->
	  <div class="box box-solid bg-green-gradient">
		<div class="box-header">
		  <i class="fa fa-calendar"></i>

		  <h3 class="box-title">Ημερολόγιο</h3>
		  <!-- tools box -->
		  <div class="pull-right box-tools">
			<!-- button with a dropdown -->
			<div class="btn-group">
			  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
				<i class="fa fa-bars"></i></button>
			  <ul class="dropdown-menu pull-right" role="menu">
				<li><a href="#">Προσθήκη γεγονότος</a></li>
				<li><a href="#">Καθαρισμός</a></li>
				<li class="divider"></li>
				<li><a href="#">Δείτε το ημερολόγιο</a></li>
			  </ul>
			</div>
			<button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
			<button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
			</button>
		  </div>
		  <!-- /. tools -->
		</div>
		<!-- /.box-header -->
		<div class="box-body no-padding">
		  <!--The calendar -->
		  <div id="calendar1" style="width: 100%"></div>
		</div>
		<!-- /.box-body -->
		<div class="box-footer text-black">
		 <div class="row">
			<div class="col-sm-6">
			  <!-- Progress bars -->
			  <div class="clearfix">
				<span class="pull-left">Τεύχος μελέτης</span>
				<small class="pull-right">100%</small>
			  </div>
			  <div class="progress xs">
				<div class="progress-bar progress-bar-green" style="width: 100%;"></div>
			  </div>

			  <div class="clearfix">
				<span class="pull-left">Μελέτη</span>
				<small class="pull-right">100%</small>
			  </div>
			  <div class="progress xs">
				<div class="progress-bar progress-bar-green" style="width: 100%;"></div>
			  </div>
			</div>
			<!-- /.col -->
			<div class="col-sm-6">
			  <div class="clearfix">
				<span class="pull-left">XML</span>
				<small class="pull-right">100%</small>
			  </div>
			  <div class="progress xs">
				<div class="progress-bar progress-bar-green" style="width: 100%;"></div>
			  </div>

			  <div class="clearfix">
				<span class="pull-left">Βοήθεια συστήματα</span>
				<small class="pull-right">100%</small>
			  </div>
			  <div class="progress xs">
				<div class="progress-bar progress-bar-green" style="width: 100%;"></div>
			  </div>
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</div>
	  </div>
	  <!-- /.box -->

	</section>
	<!-- right col -->
  </div>
  <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->