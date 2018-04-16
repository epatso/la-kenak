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
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

<?php
if (isset($_SESSION['username'])){
?>
  <!-- Sidebar user panel -->
  <div class="user-panel">
	<div class="pull-left image">
	  <?php
		echo $user_image_tag1;
	  ?>
	</div>
	<div class="pull-left info">
	<p>
		<?php 
			echo $user_name." ".$user_lastname;
		?>
	</p>
	<a href="#"><i class="fa fa-circle text-success"></i> 
	<?php
	if(confirm_admin()){
		echo "Διαχειριστής";
	}else{
		echo "Συνδεδεμένος";
	}
	?>
	</a>
	</div>
  </div>
<?php
}
?>

	<!-- search form -->
	<form action="#" method="get" class="sidebar-form">
		<div class="input-group">
			<input type="text" name="q" class="form-control" placeholder="Αναζήτηση...">
			<span class="input-group-btn">
				<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
				</button>
			</span>
		</div>
	</form>
	<!-- /.search form -->
  
  
	<ul class="sidebar-menu" data-widget="tree">
<?php
	if($offline!=1){//Ανοικτό λογισμικό
	
	//function_interface.php menu_array();
	$menudata = menu_array();
	
	$menutxt="";
	$class_tree="";
	$class_active="";
	$tree="treeview";
	$active="active ";
	$right="<span class=\"pull-right-container\">
	<i class=\"fa fa-angle-left pull-right\"></i>
	</span>";
	$class_tree="";
	$btn="";
	
	//Εάν δεν έχει επιλεγεί τίποτα πήγαινε στην αρχική
	if(!isset($_GET["nav"])){$_GET["nav"]="index";}
		
	//Μενού
	foreach($menudata as $level0){
		if("?nav=".$_GET["nav"]==$level0["link"]){$class_active="active ";}else{$class_active="";}//επιλέγχθηκε κάποιο level0
		if($level0["children_count"]>0){$class_tree=$tree;$btn=$right;}else{$class_tree="";$btn="";}//υπάρχει δέντρο
			
		if ($level0["children_count"]>0) {
			$act=0;//εάν γίνει 1 το μενού είναι active
			foreach ($level0["children"] as $level1) {
				if("?nav=".$_GET["nav"]==$level1["link"]){$act++;}//επιλέγχθηκε κάποιο level1
				
				if ($level1["children_count"]>0) {
					foreach ($level1["children"] as $level2) {
						if("?nav=".$_GET["nav"]==$level2["link"]){$act++;}//επιλέγχθηκε κάποιο level2
					}//Για κάθε level2 (στοιχεία μόνο)
				}
				
			}//Για κάθε level1 (υποκατηγορίες και στοιχεία)
			if($act>0){$class_active="active ";}//επιλέγχθηκε κάποιο οπουδήποτε στο level0
		}
		
		if($level0["active"]==1){
		if( $level0["accesslevel"]==0 OR ($level0["accesslevel"]==1 AND isset($_SESSION['username'])) OR ($level0["accesslevel"]==2 AND confirm_admin()) OR ($level0["accesslevel"]==3 AND isset($_SESSION['meleti_id'])) ){
			//Κεντρικές κατηγορίες
			$menutxt.="<li class=\"".$class_active.$class_tree."\">";
			$menutxt.="<a href=\"".$level0["link"]."\">";
			$menutxt.="<i class=\"".$level0["icon"]."\"></i>";
			$menutxt.="<span>".$level0["name"]."</span>";
			$menutxt.=$btn;
			$menutxt.="</a>";
			
			if ($level0["children_count"]>0) {
				$menutxt.="<ul class=\"treeview-menu\">";
				
				foreach ($level0["children"] as $level1) {
					if("?nav=".$_GET["nav"]==$level1["link"]){$class_active="active ";}else{$class_active="";}//επιλέγχθηκε κάποιο level1
					if($level1["children_count"]>0){$class_tree=$tree;$btn=$right;}else{$class_tree="";$btn="";}//υπάρχει δέντρο
					
					if ($level1["children_count"]>0) {
						$act=0;//εάν γίνει 1 το υπομενού είναι active
						foreach ($level1["children"] as $level2) {
							if("?nav=".$_GET["nav"]==$level2["link"]){$act++;}//επιλέγχθηκε κάποιο level2
							//if($level2["children_count"]>0){$class_tree=$tree;}else{$class_tree="";}
							
						}//Για κάθε level2 (στοιχεία μόνο)
						if($act>0){$class_active="active ";}
					}
					
					if($level1["active"]==1){
					if( $level1["accesslevel"]==0 OR ($level1["accesslevel"]==1 AND isset($_SESSION['username'])) OR ($level1["accesslevel"]==2 AND confirm_admin()) OR ($level1["accesslevel"]==3 AND isset($_SESSION['meleti_id'])) ){	
						//Εκτύπωση στοιχείων κατηγοριών και υποκατηγορίες
						$menutxt.="<li class=\"".$class_active.$class_tree."\">";
						$menutxt.="<a href=\"".$level1["link"]."\">";
						$menutxt.="<i class=\"".$level1["icon"]."\"></i>";
						$menutxt.="<span>".$level1["name"]."</span>";
						$menutxt.=$btn;
						$menutxt.="</a>";
						
						if ($level1["children_count"]>0) {
							
							$menutxt.="<ul class=\"treeview-menu\">";
							
							foreach ($level1["children"] as $level2) {
								if($level2["active"]==1){
								if( $level2["accesslevel"]==0 OR ($level2["accesslevel"]==1 AND isset($_SESSION['username'])) OR ($level2["accesslevel"]==2 AND confirm_admin()) OR ($level2["accesslevel"]==3 AND isset($_SESSION['meleti_id'])) ){	
								if("?nav=".$_GET["nav"]==$level2["link"]){$class_active="active ";}else{$class_active="";}
								
								//Εκτύπωση στοιχείων υποκατηγορίων
								$menutxt.="<li class=\"".$class_active."\">";
								$menutxt.="<a href=\"".$level2["link"]."\">";
								$menutxt.="<i class=\"".$level2["icon"]."\"></i>";
								$menutxt.="<span>".$level2["name"]."</span>";
								$menutxt.="</a>";
								
								}//έλεγχος access level για level2
								}//level2==active
							}//Για κάθε level2 (στοιχεία μόνο)
						
							$menutxt.="</ul>";
						}//Υπάρχουν στοιχεία στην υποκατηγορία level1
					}//έλεγχος access level για level1
					}//level1==active
				}//Για κάθε level1 (υποκατηγορίες και στοιχεία)
				$menutxt.="</ul>";
				
			}//Υπάρχουν στοιχεία στην κεντρική κατηγορία level0
		}//έλεγχος access level για level0
		}//level0==active
	}//Για κάθε level0 (κεντρική κατηγορία και στοιχεία)

	echo $menutxt;
	
	}//Online - Ανοικτό λογισμικό
?>

	
	<li class="header">ΣΧΕΤΙΚΑ</li>
	<li><a href="https://github.com/ks1f14s/la-kenak" target="_blank"><i class="fa fa-code-fork text-red"></i> <span>Download</span></a></li>
	<li><a href="http://www.chem-lab.gr" target="_blank"><i class="fa fa-id-card-o text-yellow"></i> <span>Contact</span></a></li>
	<li><a href="#peri_popup" data-toggle="modal"><i class="fa fa-life-ring text-aqua"></i> <span>About...</span></a></li>
  </ul>
</section>
<!-- /.sidebar -->
</aside>

<!-- ###################### Κρυφό peri_popup για εμφάνιση ###################### -->
<div id="peri_popup" class="modal modal-info fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">
			<?php
			echo APPLICATION_NAME." - v.".APPLICATION_VERSION;
			?>
			</h3>
			</div>
			
			<div class="modal-body">
			Λάμπρος Καρούντζος - Χημικός Μηχανικός ΕΜΠ ( chemlabros @ gmail . com )<br/><br/>
			Το παρόν λογισμικό διανέμεται με βάση την άδεια GPLv3 ή οποιαδήποτε μεταγενέστερη και παρέχεται χωρίς υποστήριξη. 
			Ο δημιουργός δεν ευθύνεται για τυχόν λάθη, παραλείψεις κλπ τα οποία μπορεί να οδηγήσουν σε μη ορθή παραγωγή του τεύχους 
			ή άλλων δεδομένων εξόδου από το λογισμικό. Οι χρήστες πρέπει να ελέγχουν τα αποτελέσματα και να τα διασταυρώνουν.
			<br/><br/>
			Κάθε τμηματικό αρχείο του λογισμικού φέρει στην κορυφή του την άδεια, την προέλευση, την τροποποίηση, τους δημιουργούς ή όσους 
			πραγματοποίησαν αλλαγές καθώς και την άδεια διανομής και χρήσης. Οι άδειες αυτές βρίσκονται ως αρχεία κειμένου (txt) στον 
			κεντρικό φάκελο της διανομής είτε στους φακέλους των βιβλιοθηκών. <br/><br/>
			<p>
			<h4><span class="label label-success">Χρήσιμοι σύνδεσμοι</span></h4>
			<h5><span class="label label-warning"><i class="fa fa-github"></i>  Github</span></h5>
			<a class="btn btn-info" type="button" href="https://github.com/ks1f14s/la-kenak" target="_blank"><i class="fa fa-github"></i> Repo</a>
			<a class="btn btn-info" type="button" href="https://github.com/ks1f14s/la-kenak/releases" target="_blank"><i class="fa fa-github"></i> Releases</a>
			<a class="btn btn-info" type="button" href="http://ks1f14s.github.io/la-kenak/" target="_blank"><i class="fa fa-github-square"></i> Site</a>
			<a class="btn btn-info" type="button" href="https://github.com/ks1f14s/la-kenak/wiki/_pages" target="_blank"><i class="fa fa-github-alt"></i> Wiki</a>
			<a class="btn btn-info" type="button" href="https://github.com/ks1f14s/la-kenak/issues?state=open" target="_blank"><i class="fa fa-gratipay"></i> Issues</a>

			<p>
			<h5><span class="label label-warning"><i class="fa fa-code"></i> Sourceforge</span></h5>
			<a class="btn btn-info" type="button" href="http://sourceforge.net/projects/lakenak/" target="_blank"><i class="fa fa-code"></i> Repo</a>
			<a class="btn btn-info" type="button" href="http://lakenak.sourceforge.net/" target="_blank"><i class="fa fa-code"></i> Demo site (v5.0)</a>
			</p>

			<p>
			<h5><span class="label label-warning"><i class="fa fa-comment"></i> Michanikos.gr</span></h5>
			<a class="btn btn-info" type="button" href="http://www.michanikos.gr/topic/26135-kenak-freeware/" target="_blank"><i class="fa fa-comment"></i> Forum</a>
			</p>

			<h5><span class="label label-success"><i class="fa fa-unlock"></i> Lisence</span></h5>
			<img src="images/libraries/gpl3.png" width="100" height="50">
			<br/><br/>



			</p>
			</div>
			
			<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Το 'πιασα!</button>
			</div>
		</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ######################### Κρυφό div για εμφάνιση ######################### -->
