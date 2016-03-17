<?php

	//$db = pg_connect("dbname=d8m5d1ggv02dvb 
	//					host=ec2-54-247-167-90.eu-west-1.compute.amazonaws.com 
	//					port=5432 user=mcnptqegvzaixb 
	//					password=lGS_pncoLTlIx5DzMybQxA4_R2 sslmode=require");
	//
	
	//Andmebaasi andmed
	$db_server = "localhost";
	$db_andmebaas = "kandidaadid";
	$db_kasutaja = "root";
	$db_salasona = "";
	
	//Loome ühendust andmebaasiga
	$yhendus = mysqli_connect($db_server,
								$db_kasutaja,
								$db_salasona,
								$db_andmebaas);
	
	//Ühenduse kontroll
	if(!$yhendus) {
		die("Ei saa ühendust andmebaasiga");
	}