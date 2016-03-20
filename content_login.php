<?php
include "data/config.php";
session_start();
$logged_user = pg_escape_string($_SESSION["login_user"]);

if($db){
	$res = pg_query($db, "SELECT username FROM person WHERE username ='".$logged_user."'");
	$rw = pg_fetch_assoc($res);
	$user = $rw["username"];

}

if(!isset($user)) {
	$to = "";
	if(isset($_GET["to"])){
		$to = "?page=".$_GET["to"];
	}

	$login_error = "";
	if ($_POST["check_login"]) {
		$username = pg_escape_string($_POST["username"]);
		$password = pg_escape_string($_POST["password"]);

		if ($username && $password) {
			if ($db) {
				$result = pg_query($db, "SELECT password FROM person WHERE username = '" . $username . "'");
				$row = pg_fetch_assoc($result);
				$passworddb = $row["password"];
				if (hash("sha256", $password) == $passworddb) {
					$login_error = "õige!";
					//session_start();
					$_SESSION["login_user"] = $username;
					header("Location: /".$to);
				} else {
					$login_error = "Kasutajanimi ja/või parool on vale(d)!";
				}
			}
		} else {
			$login_error = "Kasutajanimi ja/või parool on vale(d)!";
		}
	}
	?>
	<div id="logininfo"><p>
			Sisse loginutele:
			<a href="?page=create_voting">Lisa valimine</a>
			<a href="?page=create_candidate">Lisa kandidaat</a>
		</p></div>
	<div id="loginfields">
		<div id="togglebuttons">
			<button class="togglebtn">ID-Kaart</button>
			<button class="togglebtn">Digi-ID</button>
			<button class="togglebtn">Mobiil-ID</button>
		</div>
		<form action="" method="post" name="login">
			<br>
			<span class="error"><?php echo $login_error; ?></span><br>
			<b>Kasutajanimi: </b><br>
			<input type="text" name="username"><br>
			<b>Salasõna: </b><br>
			<input type="password" name="password"><br><br>
			<input type="submit" value="Sisene" name="check_login">
		</form>
	</div>
	<?php
}else{ ?>
	<div id="logininfo"><p>
			Sisse loginutele:
			<a href="?page=create_voting">Lisa valimine</a>
			<a href="?page=create_candidate">Lisa kandidaat</a>
		</p></div>
	<div id="loginfields">
<b>Oled sisse loginud, <?php echo $logged_user;?></b>
	<a href="data/logout.php">Logi välja</a>
	</div>
<?php
}
	?>