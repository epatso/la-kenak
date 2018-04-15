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


if (isset($_GET['get_mthx'])){
	$type = $_GET['type'];
	define('INCLUDE_CHECK',true);
	require("medoo.php");
	require("session.php");
	$response = jtable_mthx($type);
	echo $response;
	exit;
}

require("include_check.php");

//Κατασκευή μενού από βάση δεδομένων (έως 3 επίπεδα)
function menu_array(){
	//Σύνδεση στη βάση - Πίνακας μενού
	$database = new medoo(DB_NAME);
	$tb = "core_menu";
	$col = "*";
	$menu=array();
	
	//Κεντρικές κατηγορίες (είναι κατηγορία και δεν έχει parent δηλαδή: category_id==0)
	$where_categories=array(
		"AND"=>array("is_category"=>1,"category_id"=>0),
		"ORDER"=>array(
			"order"=>"ASC"
		)
	);
	$data_categories=$database->select($tb,$col,$where_categories);
	
	//Για κάθε κεντρική κατηγορία
	$i=0;
	foreach($data_categories as $category){
		$menu[$i]=array(
			"id"=>$category["id"],
			"is_category"=>$category["is_category"],
			"category_id"=>$category["category_id"],
			"order"=>$category["order"],
			"name"=>$category["name"],
			"link"=>$category["link"],
			"link_type"=>$category["link_type"],
			"icon"=>$category["icon"],
			"accesslevel"=>$category["accesslevel"],
			"active"=>$category["active"]
		);
		$where_category=array(
		"AND"=>array("category_id"=>$category["id"]),
		"ORDER"=>array(
			"order"=>"ASC"
			)
		);
		$count_category=$database->count($tb,$where_category);
		$menu[$i]["children_count"]=$count_category;
		if($count_category>0){
			
			$menu[$i]["children"]=array();
			
			$data_category=$database->select($tb,$col,$where_category);
			$j=0;
			foreach($data_category as $datacategory){
				$menu[$i]["children"][$j]=array(
					"id"=>$datacategory["id"],
					"is_category"=>$datacategory["is_category"],
					"category_id"=>$datacategory["category_id"],
					"order"=>$datacategory["order"],
					"name"=>$datacategory["name"],
					"link"=>$datacategory["link"],
					"link_type"=>$datacategory["link_type"],
					"icon"=>$datacategory["icon"],
					"accesslevel"=>$datacategory["accesslevel"],
					"active"=>$category["active"]
				);
			
				$where_subcategory=array(
				"AND"=>array("category_id"=>$datacategory["id"]),
				"ORDER"=>array(
					"order"=>"ASC"
					)
				);
				$count_subcategory=$database->count($tb,$where_subcategory);
				$menu[$i]["children"][$j]["children_count"]=$count_subcategory;
				if($count_subcategory>0){
					$menu[$i]["children"][$j]["children"]=array();
					
					$data_subcategory=$database->select($tb,$col,$where_subcategory);
					$z=0;
					foreach($data_subcategory as $datasubcategory){
						$menu[$i]["children"][$j]["children"][$z]=array(
							"id"=>$datasubcategory["id"],
							"is_category"=>$datasubcategory["is_category"],
							"category_id"=>$datasubcategory["category_id"],
							"order"=>$datasubcategory["order"],
							"name"=>$datasubcategory["name"],
							"link"=>$datasubcategory["link"],
							"link_type"=>$datasubcategory["link_type"],
							"icon"=>$datasubcategory["icon"],
							"accesslevel"=>$datasubcategory["accesslevel"],
							"active"=>$category["active"],
							"children_count"=>0
						);
					$z++;
					}//για κάθε στοιχείο στην υπό κατηγορία
				}//υπάρχουν στοιχεία στην υπό κατηγορία
				$j++;
			}//για κάθε στοιχείο στην κεντρική κατηγορία
		}//υπάρχουν στοιχεία στην κεντρική κατηγορία
		$i++;
	}//κεντρικές κατηγορίες
	
	return $menu;
}


function checkEmail($str){
	return preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $str);
}

function send_mail($from,$to,$subject,$body){
	$headers = '';
	$headers .= "From: $from\n";
	$headers .= "Reply-to: $from\n";
	$headers .= "Return-Path: $from\n";
	$headers .= "Message-ID: <" . md5(uniqid(time())) . "@" . $_SERVER['SERVER_NAME'] . ">\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Date: " . date('r', time()) . "\n";

	mail($to,$subject,$body,$headers);
}


//Ανακατευθυνση σε διαδρομη
function redirect_to( $location = NULL ){
	if ($location != NULL) {//Εάν δηλώθηκε διεύθυνση
		if (headers_sent() === false){//Έχουν πέσει τα header στη σελίδα - χρήση PHP
			header("Location: ".$location);
			exit;
		}else{//Δεν έχουν πέσει τα header - χρήση JS
			echo '<script type="text/javascript">window.location = "'.$location.'";</script>';
		}
	}
}


//Κατασκευή <option value="column_value">column_value</option>
function create_select_options($table,$column){
	
	$database = new medoo(DB_NAME);
	$tb = $table;
	$col = "*";
	$data_table = $database->select($tb,$col);
	
	//Κατασκευή μιας array
	$column_array = array();
	
		//Προσθήκη όλων των τιμών της στήλης του πίνακα στην array
		foreach($data_table as $data){
		array_push($column_array, $data[$column]);
		}	
		
	//Αφαίρεση διπλότυπων τιμών από την array
	$column_array_unique = array_unique($column_array);
	
	//Αλφαριθμητική ταξινόμηση
	sort($column_array_unique);
	
	$i = 0;
	$return = "";
		foreach($column_array_unique as $array){
		$return .= "<option value=\"".$array."\">".$array."</option>";
		$i++;
		}
	
return $return;
}

//Κατασκευή <option value="id">column</option>
function create_select_optionsid($table,$column,$where=""){
	
	$database = new medoo(DB_NAME);
	$tb = $table;
	$col = "*";
	if($where==""){
	$data_table = $database->select($tb,$col);
	}else{
	$data_table = $database->select($tb,$col,$where);
	}
	
	$i = 0;
	$return = "";
		foreach($data_table as $data){
		$return .= "<option value=\"".$data["id"]."\">".$data[$column]."</option>";
		$i++;
		}
	
return $return;
}

//Κατασκευή <option value="column_value">column_value</option>
function create_select_optionsval($table,$column,$val,$where=""){
	
	$database = new medoo(DB_NAME);
	$tb = $table;
	$col = "*";
	if($where==""){
	$data_table = $database->select($tb,$col);
	}else{
	$data_table = $database->select($tb,$col,$where);
	}
	
	$i = 0;
	$return = "";
		foreach($data_table as $data){
		$return .= "<option value=\"".$data[$val]."\">".$data[$column]."</option>";
		$i++;
		}
	
return $return;
}

//Δημιουργία select του jtable σε format json για την επιλογή χρήσης
function jtable_xrisi(){
	
	$database = new medoo(DB_NAME);
	$db_table = "vivliothiki_conditions";
	$db_columns = array ("id","xrisi");
	$select_table = $database->select($db_table,$db_columns);
	$count_table = $database->count($db_table);
	
	$ret=array();
	//για κάθε γραμμή $ret[id]=name
	foreach($select_table as $data)
	{
	$ret[$data["id"]] =  $data["xrisi"];
	}
	
return json_encode($ret);
}

//Δημιουργία select του jtable σε format json για την επιλογή ζώνης
function jtable_zones(){
	
	$user_id = $_SESSION['user_id'];
	$meleti_id = $_SESSION['meleti_id'];
	
	$database = new medoo(DB_NAME);
	$db_table = "meletes_zones";
	$db_columns = array ("id","name");
	$where_parameters = array("AND" => array("user_id" => $user_id,"meleti_id" => $meleti_id));
	$select_table = $database->select($db_table,$db_columns,$where_parameters);
	$count_table = $database->count($db_table, $where_parameters);
	
	$ret=array();
	//για κάθε γραμμή $ret[id]=name
	foreach($select_table as $data)
	{
	$ret[$data["id"]] = $data["name"];
	}
	
return json_encode($ret);
}

//Δημιουργία select του jtable σε format json για την επιλογή ΜΘΧ
function jtable_mthx($type=1){
	$ret=array();
	
	if($type==1){
		$user_id = $_SESSION['user_id'];
		$meleti_id = $_SESSION['meleti_id'];
		
		$database = new medoo(DB_NAME);
		$db_table = "meletes_mthx";
		$db_columns = array ("id","name");
		$where_parameters = array("AND" => array("user_id" => $user_id,"meleti_id" => $meleti_id));
		$select_table = $database->select($db_table,$db_columns,$where_parameters);
		$count_table = $database->count($db_table, $where_parameters);
		
		//για κάθε γραμμή $ret[id]=name
		foreach($select_table as $data)
		{
		$ret[$data["id"]] = $data["name"];
		}
		$ret["0"] = "Όχι";
	}else{
	$ret[1] = "Χωρίς";
	}
	
return json_encode($ret);
}

//Δημιουργία select του jtable σε format json για την επιλογή υπολογισμού U
function jtable_adiafani_uid(){
	
	$user_id = $_SESSION['user_id'];
	
	$database = new medoo(DB_NAME);
	$db_table = "user_adiafani";
	$db_columns = array ("id","name");
	$where_parameters = array("user_id" => $user_id);
	$select_table = $database->select($db_table,$db_columns,$where_parameters);
	$count_table = $database->count($db_table, $where_parameters);
	
	$ret=array();
	//για κάθε γραμμή $ret[id]=name
	foreach($select_table as $data)
	{
	$ret[$data["id"]] = $data["name"];
	}
	$ret["0"] = "Όχι";
	
return json_encode($ret);
}

//Διαθέσιμοι μήνες για επεξεργασία στα συστήματα ανάλογα με την κλιματική ζώνη και τη χρήση της ΘΖ
//Επιστρέφει array με 12 τιμές. Κάθε μία 0 ή 1 για κάθε μήνα
function systems_availablemonths($zone,$xrisi,$system){

	if($system=="therm"){
		if($zone==0 OR $zone==1){
			if($xrisi>=1 AND $xrisi<=4){
				$array = array(1,1,1,1,0,0,0,0,0,0,1,1);
			}
			if($xrisi>=5 AND $xrisi<=7){
				$array = array(0,0,0,1,0,0,0,0,0,0,0,0);
			}
			if($xrisi>=8 AND $xrisi<=13){
				$array = array(1,1,1,1,0,0,0,0,0,0,1,1);
			}
			if($xrisi>=14 AND $xrisi<=16){
				$array = array(0,0,0,1,0,0,0,0,0,0,0,0);
			}
			if($xrisi>=17 AND $xrisi<=57){
				$array = array(1,1,1,1,0,0,0,0,0,0,1,1);
			}
		}
		if($zone==2 OR $zone==3){
			if($xrisi>=1 AND $xrisi<=4){
				$array = array(1,1,1,1,0,0,0,0,0,1,1,1);
			}
			if($xrisi>=5 AND $xrisi<=7){
				$array = array(0,0,0,1,0,0,0,0,0,1,0,0);
			}
			if($xrisi>=8 AND $xrisi<=13){
				$array = array(1,1,1,1,0,0,0,0,0,1,1,1);
			}
			if($xrisi>=14 AND $xrisi<=16){
				$array = array(0,0,0,1,0,0,0,0,0,1,0,0);
			}
			if($xrisi>=17 AND $xrisi<=57){
				$array = array(1,1,1,1,0,0,0,0,0,1,1,1);
			}
		}
	}
	if($system=="cold"){
		if($xrisi>=1 AND $xrisi<=7){
			$array = array(0,0,0,0,0,1,1,1,1,0,0,0);
		}
		if($xrisi>=8 AND $xrisi<=10){
			$array = array(0,0,0,0,0,0,0,0,1,0,0,0);
		}
		if($xrisi>=11 AND $xrisi<=16){
			$array = array(0,0,0,0,0,1,1,1,1,0,0,0);
		}
		if($xrisi>=17 AND $xrisi<=19){
			$array = array(0,0,0,0,0,0,0,0,1,0,0,0);
		}
		if($xrisi>=20 AND $xrisi<=33){
			$array = array(0,0,0,0,0,1,1,1,1,0,0,0);
		}
		if($xrisi==34){
			$array = array(0,0,0,0,0,0,0,0,0,0,0,0);
		}
		if($xrisi==35){
			$array = array(0,0,0,0,0,0,0,0,1,0,0,0);
		}
		if($xrisi==36){
			$array = array(0,0,0,0,0,1,0,0,1,0,0,0);
		}
		if($xrisi==37){
			$array = array(0,0,0,0,0,0,0,0,1,0,0,0);
		}
		if($xrisi>=38 AND $xrisi<=57){
			$array = array(0,0,0,0,0,1,1,1,1,0,0,0);
		}
	}
	return $array;
}

?>