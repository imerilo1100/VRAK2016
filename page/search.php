<?php
	
	include "../data/config.php";
	
	$voting = "";
	
	if(!$db) {
		echo "Error : Unable to open database\n";
	} 
	
	$key = $_GET['term'];
	
	$array = array();
	
	//SQL localserveris testimiseks
	/*$sql = "SELECT * 
			FROM person 
			WHERE firstname 
			LIKE '".$key."%'";
	*/
	
	//Õige SQL lause andmebaasiste andmete kätte saamiseks
	//LAUSE TÖÖTAB HEROKUS ÕIGESTI
	$sql = "SELECT id, firstname, lastname
			FROM candidate
			WHERE firstname 
			ILIKE '".$key."%'";
	
	$result = pg_query($db, $sql);
	
	if (!$result) { 
		echo "Problem with query " . $query . "<br/>"; 
		echo pg_last_error(); 
		exit(); 
	} 
	
	while($row = pg_fetch_assoc($result)) {
		$array[$row['id']] = $row["firstname"]." ".$row["lastname"];
	}
	
	echo json_encode($array);
	
