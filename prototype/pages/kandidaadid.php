

<html>
	<head>
		<title>E-H‰‰letus</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<style type="text/css">
		@import "../style/defaultstyle.css";
		</style>
	</head>

	<div id="header">
		<h1>Tere tulemast e-h‰‰letamiste lehele!</h1>	
		<table><tr>
				<td><a href="./textpage.html">Valimistest</a></td>
				<td><a href="./kandidaadid.html">Kandidaatide nimekiri</a></td>
				<td><a href="./textpage.html">Abi</a></td>
				<td><a href="/">Eesti</a></td>
				<td><a href="./englishindex.html">English</a></td>
		</tr></table>
	</div>
	
	<div>
		<?php include("../data/config.php"); ?>
					<?php
						if (!empty($_GET["nimi"]) && !empty($_GET["erakond"])) {
							
							$nimi = htmlspecialchars(trim($_GET["nimi"]));
							$erakond = htmlspecialchars(trim($_GET["erakond"]));
							
							//P‰ring
							$paring = "INSERT INTO kandidaadid(nimi, erakond) VALUES ('".$nimi.", ".$erakond."')";
							$valjund = mysqli_query($yhendus, $paring);
							
							//P‰ringu vastus
							$tulemus = mysqli_affected_rows($yhendus);
							if ($tulemus == 1) {
								"Kirje lisatud edukalt";
							}
							else {
								"Kirjet ei lisatud";
							}
							
							//‹henduse sulgemine
							mysqli_close($yhendus);
						}
					?>
		<h2>Kandidaatide lisamine</h2>
		<form action="" method="get">
			<table>
				<tr>
					<td>Nimi: </td><td><input type="text" name="nimi" required></td>
					<td>Erakond: </td><td><input type="text" name="erakond" required></td>
					<td><input type="submit" value="Lisa"</td><td><input type="reset" value="T¸hjenda"</td>
				</tr>
			</table>
		</form>
	</div>
	
	<h2>Kandidaatide nimekiri</h2>
	<div id="contentcontainer">
		<table>
			<tr>
				<td><b>Number</b></td>
				<td><b>Nimi</b></td>
				<td><b>Erakond</b></td>
			</tr>
			<?php
				//Andmebaasi paroolid ja ¸hendus
				include("../data/config.php"); 
				
				//P‰ring
				$paring = "SELECT * FROM kandidaadid";
				$valjund = mysqli_query($yhendus, $paring);
				
				while($rida = mysqli_fetch_row($valjund)) {
					//echo "Number: ".$rida[0]." Nimi: ".$rida[1]." Erakond: ".$rida[2]."<br>";
					echo "\t<tr><td>".$rida[0]."</td><td>".$rida[1]."</td><td>".$rida[2]."</td></tr>\n";
				}
				
				mysqli_free_result($valjund);
				mysqli_close($yhendus);
			?>	
		</table>
	</div> 
</html>
