<!DOCTYPE html lang="en"> <!--HTML 5: http://www.w3schools.com/tags/tag_doctype.asp -->

<html>

	<?php
		$lang_file = '';
		$language = '';
		if (session_status()==PHP_SESSION_NONE){session_start();}
		header('Cache-control: private'); // IE 6 FIX
		if(isSet($_GET['lang'])) {
			$language = $_GET['lang'];
			// register the session and set the cookie
			$_SESSION['lang'] = $language;
			setcookie('lang', $language, time() + (3600 * 24 * 30));
		}
		else if(isSet($_SESSION['lang'])) {$language = $_SESSION['lang'];}
		else if(isSet($_COOKIE['lang'])) {$language = $_COOKIE['lang'];}
		else {$language = 'en';}
		switch ($language) {
			case 'en': $lang_file = 'lang.en.php'; break;
			case 'et': $lang_file = 'lang.et.php'; break;
			default: $lang_file = 'lang.et.php';
		}
		include "lang/".$lang_file;
	?>

	<?php require "data/config.php";?>
	<?php require("header.php");?> 
	<?php require("banner.php");?>

	<div id="contentcontainer">
		<?php
			//Testing only BEGIN
			error_reporting(E_ALL);
			ini_set('display_errors', 1);
			//Testing only END
			if (isset($_GET['page'])) {
				if (file_exists('page/' . $_GET['page'] . '.php')) {require('page/' . $_GET['page'] . '.php');} 
				else if($_GET['page'] = "login"){require "content_login.php";} 
				else {echo '<span class="error">Viga! Sellist lehte ei leidu!</span>';}
			}else{require("content_login.php");}
		?>
	</div>

	<?php require("fin.php");?> 

</html>
