<?php
/*
Copyright (C) 2013 - Labros Asfaleia v.1.0 beta
Author: Labros Karoyntzos 

Labros Asfaleia v.1.0 beta from Labros Karountzos is free software: 
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
	<small>Παραγωγή XML</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-edit"></i> Χρήστης</a></li>
	<li class="active"> Ημερολόγιο</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
	<!-- Main row -->
	<div class="row">
			
		<div class="col-md-12">
			<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tabs-1" data-toggle="tab"><i class="fa fa-file-code-o"></i> Ημερολόγιο</a></li>
			</ul>
			
		<!-- ########################## XML TEE KENAK ################################# -->
		<div class="tab-content">
			<div class="tab-pane active" id="tabs-1">
			<br/>


<!-- Calendar -->
	  <div class="box box-solid bg-green-gradient">
		<div class="box-header">
		  <i class="fa fa-calendar"></i>

		  <h3 class="box-title">Γεγονότα Χρήστη</h3>
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
			<!--<button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
			</button>-->
		  </div>
		  <!-- /. tools -->
		</div>
		<!-- /.box-header -->
		<div class="box-body no-padding">
		  <!--The calendar -->
		  <div id="calendar" style="width: 100%"></div>
		  
		<script>
			$(document).ready(function() {

			// page is now ready, initialize the calendar...

			$('#calendar').fullCalendar({
				customButtons: {
					myCustomButton: {
						text: 'La-Kenak!',
						click: function() {
							alert('La-kenak Ημερολόγιο!');
						}
					}
				},
				header: { // buttons for switching between views
					center: 'title', 
					left: 'listYear,month,agendaWeek,agendaDay',
					right: 'myCustomButton today prev,next'
				}, 
				 height: 450,
				 themeSystem: 'bootstrap3',
				 weekNumbers: true,
				 columnHeader: true,
				 locale: 'el',
				 businessHours: [ // specify an array instead
					{
						dow: [ 1, 2, 3 ], // Monday, Tuesday, Wednesday
						start: '08:00', // 8am
						end: '18:00' // 6pm
					},
					{
						dow: [ 4, 5 ], // Thursday, Friday
						start: '10:00', // 10am
						end: '16:00' // 4pm
					}
				],
				events: 'includes/functions_userlibraries.php?get_usercalendar=1',
				eventClick: function(event) {
					if (event.address) {
						alert(event.title+" - "+event.address);
						return false;
					}
				}//end event click
			})

			});
		</script>
		  
		  
		  
		</div>
		<!-- /.box-body -->
		<div class="box-footer text-black">
		Πρόοδος La-kenak: (<?php echo (new \DateTime())->format('Y-m-d H:i:s');?>)<br/>
		  <div class="row">
			<div class="col-sm-6">
			  <!-- Progress bars -->
			  <div class="clearfix">
				<span class="pull-left">Τεύχος μελέτης</span>
				<small class="pull-right">50%</small>
			  </div>
			  <div class="progress xs">
				<div class="progress-bar progress-bar-green" style="width: 50%;"></div>
			  </div>

			  <div class="clearfix">
				<span class="pull-left">Μελέτη</span>
				<small class="pull-right">90%</small>
			  </div>
			  <div class="progress xs">
				<div class="progress-bar progress-bar-green" style="width: 90%;"></div>
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
				<small class="pull-right">95%</small>
			  </div>
			  <div class="progress xs">
				<div class="progress-bar progress-bar-green" style="width: 95%;"></div>
			  </div>
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</div>
	  </div>
	  <!-- /.box -->

			
			
			</div><!--tabs-1-->
			
					</div><!--tab content-->
				</div><!--tabs-->
		</div><!--col-md-10-->
	</div>
	 <!-- /.row (main row) -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->