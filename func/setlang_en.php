<?php 
	if (session_status()==PHP_SESSION_NONE){session_start();} 
	setcookie("e_election_lang", "en", time()+(86400*30));
	header("Location: ../en/index.php");
	exit(); 
?>
