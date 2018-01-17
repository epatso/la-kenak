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
//χώρος για class

require_once("medoo.php");
include_once("session.php");

class meleti{
	
	//στοιχεία χρήστη
	public $user_id;
	public $meleti_id;
	public $database;
	
	//παράμετροι ερωτήματος
	public $tb_allcolumns = "*";
	public $parameters;

	//function κατασκευής
	//Τιμές για user_id και meleti_id από το SESSION
	function __construct(){
        $this->user_id=$_SESSION['user_id'];
		$this->meleti_id=$_SESSION['meleti_id'];
		$this->parameters = array("AND" => array("user_id"=>$this->user_id,"meleti_id"=>$this->meleti_id));
    }
	
	
	//επιστροφή τιμών από τον πίνακα $table όπου user_id και meleti_id και (κατά περίπτωση) id
	public function get_data($table, $id = null){
		$database = new medoo(DB_NAME);
			if(isset($id)){
				$this->parameters["AND"]["id"]=$id;
			}
		$select = $database->select($table,$this->tb_allcolumns,$this->parameters);
		return $select;
	}
	
	
	//Στοιχεία ζώνης
	public function calculate_zone(){
	
	}
	
	
	//Στοιχεία δρομικού
	public function calculate_dromiko($table, $id){
		$database = new medoo(DB_NAME);
		$this->parameters["AND"]["id"]=$id;
		$select = $database->select($table,$this->tb_allcolumns,$this->parameters);
		$wall_e = $select["l"]*$select["h"];
		return $wall_e;
	}
	
	//Στοιχεία υποστυλώματος
	public function calculate_yp($table, $id){
		$database = new medoo(DB_NAME);
		$this->parameters["AND"]["id"]=$id;
		
		return $yp_e;
	}
	
	//Στοιχεία δοκού
	public function calculate_dok($table, $id){
		$database = new medoo(DB_NAME);
		$this->parameters["AND"]["id"]=$id;
		
		return $dok_e;
	}
	
	//Στοιχεία ανοίγματος
	public function an_e($table, $id){
		$database = new medoo(DB_NAME);
		$this->parameters["AND"]["id"]=$id;
		
		return $an_e;
	}
	
	//Σκίαση ορίζοντα
	public function fhor(){
	
	}
	
	//Σκίαση προβόλου
	public function fov(){
	
	}
	
	//Σκίαση τέντας
	public function fovt(){
	
	}
	
	//Σκίαση πλευρικών
	public function ffin(){
	
	}
	
	//Σκίαση περσίδων
	public function ffin2(){
	
	}
	
	//Σκίαση περσίδων
	public function fsh(){
	
	}


}


?>