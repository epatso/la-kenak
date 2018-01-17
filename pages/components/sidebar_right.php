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
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
<!-- Create the tabs -->
<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
  <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
  <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
  <!-- Home tab content -->
  <div class="tab-pane" id="control-sidebar-home-tab">
	<h3 class="control-sidebar-heading">Πρόσφατες αλλαγές λογισμικού</h3>
	<ul class="control-sidebar-menu">
	  <li>
		<a href="javascript:void(0)">
		  <i class="menu-icon fa fa-birthday-cake bg-red"></i>

		  <div class="menu-info">
			<h4 class="control-sidebar-subheading">Νέες ΤΟΤΕΕ</h4>

			<p>Ενσωμάτωση βιβλιοθηκών, υπολογισμών, κελύφους, συστημάτων , xml. </p>
		  </div>
		</a>
	  </li>
	  <li>
		<a href="javascript:void(0)">
		  <i class="menu-icon fa fa-user bg-yellow"></i>

		  <div class="menu-info">
			<h4 class="control-sidebar-subheading">Νέο Interface</h4>

			<p>Βελτιωμένη εμφάνιση με χρήση του AdminLTE, bootstrap, ajax calls.</p>
		  </div>
		</a>
	  </li>
	  <li>
		<a href="javascript:void(0)">
		  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

		  <div class="menu-info">
			<h4 class="control-sidebar-subheading">Σενάρια</h4>

			<p>Ενσωμάτωση σεναρίων με βάση Εξοικονομώ.</p>
		  </div>
		</a>
	  </li>
	  <li>
		<a href="javascript:void(0)">
		  <i class="menu-icon fa fa-file-code-o bg-green"></i>

		  <div class="menu-info">
			<h4 class="control-sidebar-subheading">Μενού χρήστη/διαχειριστή</h4>

			<p>Ενσωμάτωση διεπαφής επεξεργασίας.</p>
		  </div>
		</a>
	  </li>
	</ul>
	<!-- /.control-sidebar-menu -->

	<h3 class="control-sidebar-heading">Εν αναμονή</h3>
	<ul class="control-sidebar-menu">
	  <li>
		<a href="javascript:void(0)">
		  <h4 class="control-sidebar-subheading">
			Τεύχος μελέτης
			<span class="label label-danger pull-right">70%</span>
		  </h4>

		  <div class="progress progress-xxs">
			<div class="progress-bar progress-bar-danger" style="width: 80%"></div>
		  </div>
		</a>
	  </li>
	  <li>
		<a href="javascript:void(0)">
		  <h4 class="control-sidebar-subheading">
			Σενάρια
			<span class="label label-success pull-right">95%</span>
		  </h4>

		  <div class="progress progress-xxs">
			<div class="progress-bar progress-bar-success" style="width: 95%"></div>
		  </div>
		</a>
	  </li>
	  <li>
		<a href="javascript:void(0)">
		  <h4 class="control-sidebar-subheading">
			Σχεδίαση-WebGL
			<span class="label label-warning pull-right">50%</span>
		  </h4>

		  <div class="progress progress-xxs">
			<div class="progress-bar progress-bar-warning" style="width: 50%"></div>
		  </div>
		</a>
	  </li>
	  <li>
		<a href="javascript:void(0)">
		  <h4 class="control-sidebar-subheading">
			Βοήθειες συστημάτων
			<span class="label label-primary pull-right">68%</span>
		  </h4>

		  <div class="progress progress-xxs">
			<div class="progress-bar progress-bar-primary" style="width: 90%"></div>
		  </div>
		</a>
	  </li>
	</ul>
	<!-- /.control-sidebar-menu -->

  </div>
  <!-- /.tab-pane -->
  <!-- Stats tab content -->
  <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
  <!-- /.tab-pane -->
  <!-- Settings tab content -->
  <div class="tab-pane" id="control-sidebar-settings-tab">
  <h3 class="control-sidebar-heading">Περί...</h3>
	<p>
		La - kenak v<?php echo APPLICATION_VERSION; ?> 2017<br/>
		Λάμπρος Καρούντζος <br/>
		Χημικός Μηχανικός ΕΜΠ <br/>
		
		<br/><br/>
		Το λογισμικό αυτό διανέμεται δωρεάν. Για προτάσεις, παρατηρήσεις, διορθώσεις ή γενικά οτιδήποτε άλλο επικοινωνήστε με το δημιουργό στο : <br/>
		chemlabros @ gmail . com 
	</p>
  </div>
  <!-- /.tab-pane -->
</div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>