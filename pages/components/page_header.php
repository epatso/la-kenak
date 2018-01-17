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
<header class="main-header">
<!-- Logo -->
<a href="?nav=index" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>La</b></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>La</b> kenak  <i id='wait' style="display:none;" class="fa fa-spinner fa-spin fa-fw"></i></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
	<span class="sr-only">Εναλλαγή μενού</span>
  </a>

  <div class="navbar-custom-menu">
	<ul class="nav navbar-nav">

<?php 
	if (isset($_SESSION['username'])){
		
	$database = new medoo(DB_NAME);
	$columns = array("id","usr","email","onoma","epwnymo","eidikotita","address","address_x","address_y","address_z","tel","fax","taytotita","afm");
	$where=array("id"=>$_SESSION['user_id']);
	$user_data = $database->select("core_users","*",$where);
	
	$user_name=$user_data[0]["onoma"];
	$user_lastname=$user_data[0]["epwnymo"];
	$user_mail=$user_data[0]["email"];
	
	$user_image_location = "includes/file_upload/server/php/files/user_".$_SESSION['user_id']."/user_image.jpg";
	if(file_exists($user_image_location)){
		$user_image_tag="<img src=\"".$user_image_location."\" class=\"user-image\" alt=\"User Image\">";
		$user_image_tag1="<img src=\"".$user_image_location."\" class=\"img-circle\" alt=\"User Image\">";
	}else{
		$user_image_tag="<img src=\"dist/img/avatar5.png\" class=\"user-image\" alt=\"User Image\">";
		$user_image_tag1="<img src=\"dist/img/avatar5.png\" class=\"img-circle\" alt=\"User Image\">";
	}
	
	$where_eidikotita=array("id"=>$user_data[0]["eidikotita"]);
	$user_eidikotita = $database->select("core_eidikotitesmhx","*",$where_eidikotita);
	$user_eidikotita=$user_eidikotita[0]["name"];
?>


<?php 
	if (isset($_SESSION['meleti_id'])){
?>	
	<!-- User Account: style can be found in dropdown.less -->
	<li class="dropdown user user-menu">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">	
	<img src="images/xrisi/1.png" class="user-image" alt="Meleti Image">
	  
	<span class="hidden-xs">
		<?php 
		echo $_SESSION['meleti_name'];
		?>
	  </span>
	</a>
	
	<?php
	$pea_img_file = "includes/file_upload/server/php/files/user_".$_SESSION['user_id']."/meleti_".$_SESSION['meleti_id']."/medium/pea_img.jpg";
	if(file_exists($pea_img_file)){
		$meleti_image=$pea_img_file;
	}else{
		$meleti_image="images/xrisi/1.png";
	}
	
	$data_meleti = $database->select("user_meletes","*",array("id"=>$_SESSION['meleti_id']));
	if($data_meleti[0]["xrisi"]!=0){
		$meleti_xrisi = $database->select("vivliothiki_conditions_building","name",array("id"=>$data_meleti[0]["xrisi"]));
		$meleti_xrisi = $meleti_xrisi[0];
	}else{
		$meleti_xrisi = "Προστέθηκε τώρα!";
	}
	?>
	
	<ul class="dropdown-menu">
	  <!-- User image -->
	  <li class="user-header">
		<img src="<?php echo $meleti_image;?>" class="user-image" alt="Meleti Image">
		<p>
		<?php 
		echo $_SESSION['meleti_name'];
		echo "<small>".$meleti_xrisi."</small>";
		echo "<small>".$data_meleti[0]["idioktitis"]."</small><br/>";
		echo "<small class=\"bg-primary color-palette\">".$data_meleti[0]["address"]."</small>";
		?>
		</p>
	  </li>
	  <!-- Menu Body -->
	  <li class="user-body">
		<div class="row">
		  <div class="col-xs-4 text-center">
			<a href="?nav=meleti_general">Γενικά</a>
		  </div>
		  <div class="col-xs-4 text-center">
			<a href="?nav=meleti_zones">Ζώνες</a>
		  </div>
		  <div class="col-xs-4 text-center">
			<a href="?nav=meleti_kelyfos">Κέλυφος</a>
		  </div>
		</div>
		<!-- /.row -->
	  </li>
	  <!-- Menu Footer-->
	  <li class="user-footer">
		<?php
			if(confirm_admin()){
		?>
		<div class="pull-left">
		<a href="?nav=meleti_print" class="btn btn-default btn-flat"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
		Τεύχος
		</a>
		</div>
		<?php
			}
		?>
		<div class="pull-right">
		  <a href="?nav=meleti_xml" class="btn btn-default btn-flat"><i class="fa fa-file-code-o" aria-hidden="true"></i>
		  xml
		  </a>
		</div>
	  </li>
	</ul>

	</li>
	<!-- User Account: style can be found in dropdown.less -->
<?php 
	}
?>

		
	<!-- User Account: style can be found in dropdown.less -->
	<li class="dropdown user user-menu">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">	
		<?php 
		echo $user_image_tag;
		?>
	  
	<span class="hidden-xs">
		<?php 
		echo $_SESSION['username'];
		?>
	  </span>
	</a>

	<ul class="dropdown-menu">
	  <!-- User image -->
	  <li class="user-header">
		<?php 
			echo $user_image_tag;
		?>

		<p>
		<?php 
		echo $user_name." ".$user_lastname;
		echo "<small>".$user_eidikotita."</small>";
		echo "<small>".$user_mail."</small>";
		?>
		</p>
	  </li>
	  <!-- Menu Body -->
	  <li class="user-body">
		<div class="row">
		  <div class="col-xs-4 text-center">
			<a href="?nav=user_preferences">Λογαριασμός</a>
		  </div>
		  <div class="col-xs-4 text-center">
			<a href="?nav=user_libraries">Βιβλιοθήκες</a>
		  </div>
		  <div class="col-xs-4 text-center">
			<a href="?nav=user_login">Μελέτες</a>
		  </div>
		</div>
		<!-- /.row -->
	  </li>
	  <!-- Menu Footer-->
	  <li class="user-footer">
		<?php
			if(confirm_admin()){
		?>
		<div class="pull-left">
		<a href="?nav=admin" class="btn btn-success btn-flat">
			<i class="fa fa-black-tie" aria-hidden="true"></i>
			Διαχειριστής
		</a>
		</div>
		<?php
			}
		?>
		<div class="pull-right">
		<a href="?logoff" class="btn btn-danger btn-flat">
			<i class="fa fa-power-off" aria-hidden="true"></i>
			Αποσύνδεση
		</a>
		</div>
	  </li>
	</ul>

	</li>
	<!-- User Account: style can be found in dropdown.less -->
	<?php
	}
	?>
	  <!-- Control Sidebar Toggle Button -->
	  <li>
		<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
	  </li>
	</ul>
  </div>
</nav>
</header>