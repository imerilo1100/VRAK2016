<?php if (session_status()==PHP_SESSION_NONE){session_start();} ?>
<!DOCTYPE html> <!--HTML 5: http://www.w3schools.com/tags/tag_doctype.asp -->

<html lang="et">
	<?php require("header.php");?> 
	<?php require("banner.php");?>
	<div id="contentcontainer">
		<select name="election_select" class="select_left" action="">
		  	<?php 
				error_reporting(E_ALL);
				error_reporting(-1);
				include "../db/conninfo.php" 
			?>
		</select>
		<span class=overview_right>
			Kandidaate kokku:
			<br>
			Hääletanuid kokku:
		</span>
		<table>
			<tr>
				<td>Nimi</td> 
				<td>Erakond</td> 
				<td>Number</td> 
			</tr>
		</table>
	</div>
	<?php require("fin.php");?> 
</html>
