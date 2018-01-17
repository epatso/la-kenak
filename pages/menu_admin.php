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
if(confirm_admin()){
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<section class="content-header">
	<h1>
	La-kenak
	<small>Διαχειριστής</small>
	</h1>
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> La-kenak</a></li>
	<li><a href="#"><i class="fa fa-black-tie"></i> Διαχειριστής</a></li>
	<li class="active">Σύνοψη</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- Main row -->
<div class="row">
	
		<div class="col-md-2">
		
		
			<div class="panel panel-primary">
				<div class="panel-heading"><span class="glyphicon glyphicon-signal"></span> Σύνδεση <?php echo $_SESSION['username'];?> από:</div>
				<div class="panel-body">
					<div id="ip"></div>
<?php

$ipaddress = get_client_ip();

echo "Access from: ".$ipaddress." <br/>";

//Μέτρηση γραμμών κώδικα
$files = scandir("includes/");

$count = 0;
foreach($files as $file){
	if(strpos($file,".php") == true){
	$c = count(file("includes/".$file));
	//echo $file.": ".$c."<br/>";
	$count += $c;
	}
}
echo "ΣΥΝΟΛΟ ΚΩΔΙΚΑ: ".$count." γραμμές.";

?>
				</div>
				<div class="panel-footer">http://ip-api.com/json</div>
			</div>


<?php
$database = new medoo(DB_NAME);
$data_xwroi = $database->select("meletes_xwroi","*");

$emvadon=0;
$volume=0;
foreach($data_xwroi as $xwroi){
	$emvadon += $xwroi["l"]*$xwroi["w"];
	$volume += $xwroi["l"]*$xwroi["w"]*$xwroi["h"];
}

$users = $database->count("core_users");
$meletes = $database->count("user_meletes");
$materials = $database->count("user_domika");
$laws = $database->count("vivliothiki_laws");

$building_xriseis_data = $database->select("vivliothiki_conditions_building","*");
foreach($building_xriseis_data as $xriseis){
	$xrisi_count = $database->count("user_meletes", array("xrisi"=>$xriseis["id"]));
	$xriseis_count[$xriseis["id"]] = $xrisi_count;
	$xriseis_persent[$xriseis["id"]] = ($xrisi_count/$meletes)*100;
}

$count_type1 = $database->count("user_meletes", array("type"=>0));
$count_type2 = $database->count("user_meletes", array("type"=>1));
$count_type3 = $database->count("user_meletes", array("type"=>2));
$count_type4 = $database->count("user_meletes", array("type"=>3));
$count_type5 = $database->count("user_meletes", array("type"=>4));
$percent_type1 = ($count_type1/$meletes)*100;
$percent_type2 = ($count_type2/$meletes)*100;
$percent_type3 = ($count_type3/$meletes)*100;
$percent_type4 = ($count_type4/$meletes)*100;
$percent_type5 = ($count_type5/$meletes)*100;

?>

			
			<div class="alert alert-info">
			<h4>Ανά είδος</h4>
			Παλιό
			    <div class="progress">
				<div class="progress-bar progress-bar-warning" style="width: <?php echo $percent_type1;?>%"></div>
				</div>
			Ριζ. Ανακαινιζόμενο (Κ.Εν.Α.Κ.)
				<div class="progress">
				<div class="progress-bar progress-bar-warning" style="width: <?php echo $percent_type2;?>%"></div>
				</div>
			Νέο (Κ.Εν.Α.Κ.)	
				<div class="progress">
				<div class="progress-bar progress-bar-warning" style="width: <?php echo $percent_type3;?>%"></div>
				</div>
			Ριζ. Ανακαινιζόμενο (Αναθ. Κ.Εν.Α.Κ.)
				<div class="progress">
				<div class="progress-bar progress-bar-warning" style="width: <?php echo $percent_type4;?>%"></div>
				</div>
			Νέο (Αναθ. Κ.Εν.Α.Κ.)
				<div class="progress">
				<div class="progress-bar progress-bar-warning" style="width: <?php echo $percent_type5;?>%"></div>
				</div>
			</div>	
			
			<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Γενική εικόνα</h4>
			Εμφανίζεται μια γενική εικόνα μεγεθών για το la-kenak.<br/><br/>
			Από το μενού <span class="label label-info">διαχειριστής</span> μπορείτε να επεξεργαστείτε τμήματα του λογισμικού και τους εγγεγραμμένους χρήστες. <br/><br/>
			</div>
			
			
		<script>
		var link = "http://ip-api.com/json";
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET",link ,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function()  {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			var array=JSON.parse(xmlhttp.responseText);
			var result = "IP:"+array["query"]+"<br/>";
			result += "Country:"+array["country"]+"/"+array["countryCode"]+"/"+array["city"]+"<br/>";
			result += "ISP:"+array["isp"]+"<br/>";
			document.getElementById("ip").innerHTML = result;
		}}
		</script>
		</div>		
		
		<div class="col-md-10">
			<div class="row">
				
				<div class="col-md-6">
					<div class="panel panel-success">
					<div class="panel-heading">Χρήστες</div>
					<div class="panel-body">
						<input type="text" value="<?php echo $users;?>" class="knob" data-readOnly=true data-fgColor="#006633" data-min="0000" data-max="1000">
					</div>
					 <div class="panel-footer">Εγγεγραμένοι χρήστες</div>
					</div>
				</div>
				
				
				<div class="col-md-3">
					<div class="panel panel-warning">
					<div class="panel-heading">Βιβλιοθήκη χρηστών</div>
					<div class="panel-body">
						<input type="text" value="<?php echo $materials;?>" class="knob" data-readOnly=true data-fgColor="#FF9933" data-min="0000" data-max="1000" data-skin="tron">
					</div>
					 <div class="panel-footer">Σύνολο υλικών</div>
					</div>
				</div>
				
				<div class="col-md-3">
					<div class="panel panel-danger">
					<div class="panel-heading">Νομοθεσία</div>
					<div class="panel-body">
						<input type="text" value="<?php echo $laws;?>" class="knob" data-readOnly=true data-fgColor="#990033" data-min="0000" data-max="1000" data-skin="tron">
					</div>
					 <div class="panel-footer">Σύνολο νομοθεσίας</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				
				<div class="col-md-6">
					<div class="panel panel-info">
					<div class="panel-heading">Μελέτες</div>
					<div class="panel-body">
						<input type="text" value="<?php echo $meletes;?>" class="knob" data-readOnly=true data-fgColor="#0066CC" data-min="0000" data-max="1000">
					</div>
					 <div class="panel-footer">Σύνολο μελετών</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="panel panel-warning">
					<div class="panel-heading">Εμβαδόν</div>
					<div class="panel-body">
						<input type="text" value="<?php echo $emvadon;?>" class="knob" data-readOnly=true data-fgColor="#FF9933" data-min="0000" data-max="100000" data-skin="tron">
					</div>
					 <div class="panel-footer">m<sup>2</sup></sup></div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="panel panel-danger">
					<div class="panel-heading">Όγκος</div>
					<div class="panel-body">
						<input type="text" value="<?php echo $volume;?>" class="knob" data-readOnly=true data-fgColor="#990033" data-min="0000" data-max="100000" data-skin="tron">
					</div>
					 <div class="panel-footer">m<sup>3</sup></div>
					</div>
				</div>
			</div>
			
			<div class="row">
				
				<div class="col-md-12">
					<div class="panel panel-success">
					<div class="panel-heading">Κατανομή ανά χρήση</div>
					<div class="panel-body">
						Κατανομή μελετών ανά χρήση κτιρίου.
					
					</div>
						<table class="table">
						<tr><td style="width:40%">Χρήση</td><td>Αριθμός μελετών</td><td style="width:40%">Ποσοστό</td></tr>
						<?php
						foreach($building_xriseis_data as $xriseis){
							if($xriseis_count[$xriseis["id"]]!=0){
							echo "<tr><td>".$xriseis["name"]."</td>";
							echo "<td>".$xriseis_count[$xriseis["id"]]."</td>";
							echo "<td><div class=\"progress\"><div class=\"progress-bar progress-bar-info\" style=\"width: ".$xriseis_persent[$xriseis["id"]]."%\"></div></div></td></tr>";
							}
						}
						?>
						</table>
					
					<div class="panel-footer">Σύνολο μελετών: <?php echo $meletes;?></div>
					</div>
				</div>
			</div>
			
		<script>
            $(function($) {

                $(".knob").knob({
                    change : function (value) {
                        //document.getElementById("data").innerHTML = value;
                    },
                    release : function (value) {
                        //console.log(this.$.attr('value'));
                        console.log("release : " + value);
                    },
                    cancel : function () {
                        console.log("cancel : ", this);
                    },
                    draw : function () {
						
                        // "tron" case
                        if(this.$.data('skin') == 'tron') {

                            var a = this.angle(this.cv)  // Angle
                                , sa = this.startAngle          // Previous start angle
                                , sat = this.startAngle         // Start angle
                                , ea                            // Previous end angle
                                , eat = sat + a                 // End angle
                                , r = 1;

                            this.g.lineWidth = this.lineWidth;

                            this.o.cursor
                                && (sat = eat - 0.05)
                                && (eat = eat + 0.05);

                            if (this.o.displayPrevious) {
                                ea = this.startAngle + this.angle(this.v);
                                this.o.cursor
                                    && (sa = ea - 0.05)
                                    && (ea = ea + 0.05);
                                this.g.beginPath();
                                this.g.strokeStyle = this.pColor;
                                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                                this.g.stroke();
                            }

                            this.g.beginPath();
                            this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                            this.g.stroke();

                            this.g.lineWidth = 2;
                            this.g.beginPath();
                            this.g.strokeStyle = this.o.fgColor;
                            this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                            this.g.stroke();

                            return false;
                        }
                    }
                });    
            });
		</script>
		
	</div>
	<!--/tab-content-->
		
	</div>
	<!--/tabbable tabs-->
	</div>
	<!--/col-md-10-->
</div>
 <!-- /.row (main row) -->
	
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
}
?>