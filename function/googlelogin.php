<?php
	if(isset($_GET['email']) && isset($_GET['id'])){
		session_start();
		$_SESSION['login_user'] = $_GET['email'];
		header("Location: /");
	}
?>
