<?php if (session_status()==PHP_SESSION_NONE){session_start();} ?>
<!DOCTYPE html> <!--HTML 5: http://www.w3schools.com/tags/tag_doctype.asp -->

<html lang="en">
	<?php require("header.php");?> 
	<?php require("banner.php");?>
	<div id="contentcontainer">
		<?php
			if (isset($_SESSION['username'])&&!empty($_SESSION['username'])){
				require("main.php");
			} else {require("login.php");}
		?> 
	</div>
	<?php require("../fin.php");?> 
</html>
