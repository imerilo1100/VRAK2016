<?php 
	if (session_status()==PHP_SESSION_NONE){session_start();} 
	if(1==1){$_SESSION["username"]=$_POST["username"];}
	header("Location: ../".$_POST["lang"]);
	exit(); 
?>
