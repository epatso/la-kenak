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
	<small>Θερμογέφυρες</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-university"></i> Βιβλιοθήκες</a></li>
	<li class="active"> Θερμογέφυρες</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	
<!-- Main row -->
<div class="row">
	<div class="col-md-12">
		<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
		<li class="active"><a href="#tab1" data-toggle="tab">Θερμογέφυρες</a></li>
		</ul>

		<div class="tab-content">
		<div class="tab-pane active" id="tab1">
		
		<div class="tabbable tabs-left">
		<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#tabs-1">ΞΓ <span class="badge">40</span></a></li>
				<li><a data-toggle="tab" href="#tabs-2">ΣΓ <span class="badge">29</span></a></li>
				<li><a data-toggle="tab" href="#tabs-3">ΣΣ <span class="badge">22</span></a></li>
				<li><a data-toggle="tab" href="#tabs-4">ΔΣ <span class="badge">71</span></a></li>
				<li><a data-toggle="tab" href="#tabs-5">ΔΠ <span class="badge">44</span></a></li>
				<li><a data-toggle="tab" href="#tabs-6">ΟΕ <span class="badge">26</span></a></li>
				<li><a data-toggle="tab" href="#tabs-7">ΔΥ <span class="badge">13</span></a></li>
				<li><a data-toggle="tab" href="#tabs-8">ΕΔ <span class="badge">25</span></a></li>
				<li><a data-toggle="tab" href="#tabs-9">ΔΦ <span class="badge">16</span></a></li>
				<li><a data-toggle="tab" href="#tabs-10">ΠΡ <span class="badge">4</span></a></li>
				<li><a data-toggle="tab" href="#tabs-11">ΛΠ <span class="badge">26</span></a></li>
				<li><a data-toggle="tab" href="#tabs-12">ΥΠ<span class="badge">41</span></a></li>
			</ul>
			
		<div class="tab-content">	
			<div id="tabs-1" class="tab-pane active">
			<h3>Θερμογέφυρες εξωτερικής γωνίας (οριζόντια τομή</h3><br/>
			<button type="button" class="btn btn-default" onclick=action_thermo(0,"prev");> <span class="glyphicon glyphicon-chevron-left"> </span> </button>
			<span id="thermo_img_ksg"><img src="images/thermo/ksg/ksg1.jpg"></span>
			<button type="button" class="btn btn-default" onclick=action_thermo(0,"next");> <span class="glyphicon glyphicon-chevron-right"> </span> </button>
			</div>
			
			<div id="tabs-2" class="tab-pane">
			<h3>Θερμογέφυρες εσωτερικής γωνίας  (οριζόντια τομή)</h3><br/>
			<button type="button" class="btn btn-default" onclick=action_thermo(1,"prev");> <span class="glyphicon glyphicon-chevron-left"> </span> </button>
			<span id="thermo_img_sg"><img src="images/thermo/sg/sg1.jpg"></span>
			<button type="button" class="btn btn-default" onclick=action_thermo(1,"next");> <span class="glyphicon glyphicon-chevron-right"> </span> </button>
			</div>
			
			<div id="tabs-3" class="tab-pane">
			<h3>Θερμογέφυρες ενώσεων δομικών στοιχείων (οριζόντια τομή)</h3><br/>
			<button type="button" class="btn btn-default" onclick=action_thermo(2,"prev");> <span class="glyphicon glyphicon-chevron-left"> </span> </button>
			<span id="thermo_img_ss"><img src="images/thermo/ss/ss1.jpg"></span>
			<button type="button" class="btn btn-default" onclick=action_thermo(2,"next");> <span class="glyphicon glyphicon-chevron-right"> </span> </button>
			</div>
			
			<div id="tabs-4" class="tab-pane">
			<h3>Θερμογέφυρες δώματος / οροφής σε προεξοχή (κατακόρυφη τομή)</h3><br/>
			<button type="button" class="btn btn-default" onclick=action_thermo(3,"prev");> <span class="glyphicon glyphicon-chevron-left"> </span> </button>
			<span id="thermo_img_ds"><img src="images/thermo/ds/ds1.jpg"></span>
			<button type="button" class="btn btn-default" onclick=action_thermo(3,"next");> <span class="glyphicon glyphicon-chevron-right"> </span> </button>
			</div>
			
			<div id="tabs-5" class="tab-pane">
			<h3>Θερμογέφυρες δαπέδου σε προεξοχή / δαπέδου επάνω από πυλωτή (κατακόρυφη τομή)</h3><br/>
			<button type="button" class="btn btn-default" onclick=action_thermo(4,"prev");> <span class="glyphicon glyphicon-chevron-left"> </span> </button>
			<span id="thermo_img_dp"><img src="images/thermo/dp/dp1.jpg"></span>
			<button type="button" class="btn btn-default" onclick=action_thermo(4,"next");> <span class="glyphicon glyphicon-chevron-right"> </span> </button>
			</div>
			
			<div id="tabs-6" class="tab-pane">
			<h3>Θερμογέφυρες σε οροφή σε εσοχή (κατακόρυφη τομή)</h3><br/>
			<button type="button" class="btn btn-default" onclick=action_thermo(5,"prev");> <span class="glyphicon glyphicon-chevron-left"> </span> </button>
			<span id="thermo_img_oe"><img src="images/thermo/oe/oe1.jpg"></span>
			<button type="button" class="btn btn-default" onclick=action_thermo(5,"next");> <span class="glyphicon glyphicon-chevron-right"> </span> </button>
			</div>
			
			<div id="tabs-7" class="tab-pane">
			<h3>Θερμογέφυρες σε δάπεδο σε εσοχή (κατακόρυφη τομή)</h3><br/>
			<button type="button" class="btn btn-default" onclick=action_thermo(6,"prev");> <span class="glyphicon glyphicon-chevron-left"> </span> </button>
			<span id="thermo_img_dy"><img src="images/thermo/dy/dy1.jpg"></span>
			<button type="button" class="btn btn-default" onclick=action_thermo(6,"next");> <span class="glyphicon glyphicon-chevron-right"> </span> </button>
			</div>
			
			<div id="tabs-8" class="tab-pane">
			<h3>Θερμογέφυρες σε ενδιάμεσο δάπεδο (κατακόρυφη τομή)</h3><br/>
			<button type="button" class="btn btn-default" onclick=action_thermo(7,"prev");> <span class="glyphicon glyphicon-chevron-left"> </span> </button>
			<span id="thermo_img_ed"><img src="images/thermo/ed/ed1.jpg"></span>
			<button type="button" class="btn btn-default" onclick=action_thermo(7,"next");> <span class="glyphicon glyphicon-chevron-right"> </span> </button>
			</div>
			
			<div id="tabs-9" class="tab-pane">
			<h3>Θερμογέφυρες δαπέδου που εδράζεται στο έδοφος (κατακόρυφη τομή)</h3><br/>
			<button type="button" class="btn btn-default" onclick=action_thermo(8,"prev");> <span class="glyphicon glyphicon-chevron-left"> </span> </button>
			<span id="thermo_img_df"><img src="images/thermo/df/df1.jpg"></span>
			<button type="button" class="btn btn-default" onclick=action_thermo(8,"next");> <span class="glyphicon glyphicon-chevron-right"> </span> </button>
			</div>
			
			<div id="tabs-10" class="tab-pane">
			<h3>Θερμογέφυρες περιδέσμου ενίσχυσης (κατακόρυφη τομή)</h3><br/>
			<button type="button" class="btn btn-default" onclick=action_thermo(9,"prev");> <span class="glyphicon glyphicon-chevron-left"> </span> </button>
			<span id="thermo_img_pr"><img src="images/thermo/pr/pr1.jpg"></span>
			<button type="button" class="btn btn-default" onclick=action_thermo(9,"next");> <span class="glyphicon glyphicon-chevron-right"> </span> </button>
			</div>
			
			<div id="tabs-11" class="tab-pane">
			<h3>Θερμογέφυρες σε λαμπά κουφώματος (οριζόντια τομή)</h3><br/>
			<button type="button" class="btn btn-default" onclick=action_thermo(10,"prev");> <span class="glyphicon glyphicon-chevron-left"> </span> </button>
			<span id="thermo_img_lp"><img src="images/thermo/lp/lp1.jpg"></span>
			<button type="button" class="btn btn-default" onclick=action_thermo(10,"next");> <span class="glyphicon glyphicon-chevron-right"> </span> </button>
			</div>
			
			<div id="tabs-12" class="tab-pane">
			<h3>Θερμογέφυρες σε ανωκάσι/κατωκάσι κουφώματος (κατακόρυφη τομή)</h3><br/>
			<button type="button" class="btn btn-default" onclick=action_thermo(11,"prev");> <span class="glyphicon glyphicon-chevron-left"> </span> </button>
			<span id="thermo_img_yp"><img src="images/thermo/yp/yp1.jpg"></span>
			<button type="button" class="btn btn-default" onclick=action_thermo(11,"next");> <span class="glyphicon glyphicon-chevron-right"> </span> </button>
			</div>
			<script>
			
			function action_thermo(no,action){
			var array_type=[
				"ksg",
				"sg",
				"ss",
				"ds",
				"dp",
				"oe",
				"dy",
				"ed",
				"df",
				"pr",
				"lp",
				"yp"
			];
			var type = array_type[no];
			var array_type_count=[
				40,
				29,
				22,
				71,
				44,
				26,
				13,
				25,
				16,
				4,
				26,
				41
			];
			var max = array_type_count[no];
			var current = document.getElementById("thermo_img_"+type).innerHTML;
			current = current.replace(/^\D+/g,"");
			current = current.replace(type+'/'+type, "");
			current = current.replace(".jpg\">", "");
			current = parseFloat(current);
			var next = current + 1;
				if(next>max){
				next = 1;
				}
			
			var prev = current - 1;
				if(prev<=0){
				prev = max;
				}
			var number;
			if(action=="next"){
				number = next;
			}
			if(action=="prev"){
				number = prev;
			}
			
			document.getElementById("thermo_img_"+type).innerHTML = "<img src=\"images/thermo/"+type+"/"+type+number+".jpg\">";
			//alert(current);
			}
			
			</script>
			
			
		</div>
	</div>
	
	</div><!--tab1-->
	</div><!--tab-content-->
	</div><!--main-tabs-->
	</div><!--col-md-12-->	
</div>
 <!-- /.row (main row) -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->	

