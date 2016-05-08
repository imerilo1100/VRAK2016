<?php
	include "data/config.php";
	if (isset($_SESSION["login_user"])) {
		$logged_user = pg_escape_string($_SESSION["login_user"]);
		if($db){
			$res = pg_query($db, "SELECT username FROM person WHERE username ='".$logged_user."'");
			$rw = pg_fetch_assoc($res);
			$user = $rw["username"];
		}
	}
	if(!isset($user)&&$db) {
		$to = "";
		if(isset($_GET["to"])){$to = "?page=".$_GET["to"];}
		$login_error = "";
		if (isset($_POST["check_login"])) {
			$username = pg_escape_string($_POST["username"]);
			$password = pg_escape_string($_POST["password"]);
			if ($username && $password) {
				if ($db) {
					$result = pg_query($db, "SELECT password FROM person WHERE username = '" . $username . "'");
					$row = pg_fetch_assoc($result);
					$passworddb = $row["password"];
					if (hash("sha256", $password) == $passworddb) {
						$login_error = "õige!";
						$_SESSION["login_user"] = $username;
						header("Location: /".$to);
					} else {$login_error = "Kasutajanimi ja/või parool on vale(d)!";}
				}
			} else {$login_error = "Kasutajanimi ja/või parool on vale(d)!";}
		}
?>
	<div id="logininfo"><p>
			Sisse loginutele:
			<nav>
				<ul>
					<li><a href="?page=create_voting">Lisa valimine</a></li>
					<li><a href="?page=create_candidate">Lisa kandidaat</a></li>
				</ul>
			</nav>
		</p></div>
	<div id="loginfields">
		<div id="togglebuttons">
			<button class="togglebtn">ID-Kaart</button>
			<button class="togglebtn">Digi-ID</button>
			<button class="togglebtn">Mobiil-ID</button>
			<div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
			<script>
				function onSignIn(googleUser) {
					// Useful data for your client-side scripts:
					var profile = googleUser.getBasicProfile();
					console.log("ID: " + profile.getId()); // Don't send this directly to your server!
					console.log('Full Name: ' + profile.getName());
					$(".error").text(profile.getName());
					console.log('Given Name: ' + profile.getGivenName());
					console.log('Family Name: ' + profile.getFamilyName());
					console.log("Image URL: " + profile.getImageUrl());
					console.log("Email: " + profile.getEmail());
					// The ID token you need to pass to your backend:
					var id_token = googleUser.getAuthResponse().id_token;
					console.log("ID Token: " + id_token);
					$.post("/function/googlelogin.php", {
						email : profile.getEmail(),
						id : id_token
					}).done(function(value){
						if(value){document.getElementById("titleck").innerHTML=title+" on saadaval!";}
						else{document.getElementById("titleck").innerHTML=title+" ei ole saadaval!";}
					});
				};
			</script>
		</div>
		<form action="" method="post" name="login">
			<br>
			<span class="error"><?php echo $login_error; ?></span><br>
			<strong><label for="username">Kasutajanimi: </label></strong><br>
			<input type="text" id="username" name="username"><br>
			<strong><label for="password">Salasõna: </label></strong><br>
			<input type="password" id="password" name="password"><br><br>
			<input type="submit" value="Sisene" name="check_login">
		</form>
	</div>
	<?php }else{ ?>
	<div id="logininfo"><p>
			Sisse loginutele:
			<a href="?page=create_voting">Lisa valimine</a>
			<a href="?page=create_candidate">Lisa kandidaat</a>
	</p></div>
	<div id="loginfields">
		<b>Oled sisse loginud, <?php echo $logged_user;?></b>
		<a href="#" onclick="signOut();">Sign out</a>
		<script>
			function signOut() {
				var auth2 = gapi.auth2.getAuthInstance();
				auth2.signOut().then(function () {
					console.log('User signed out.');
				});
			}
		</script>
	<a href="data/logout.php" onclick="signOut()">Logi välja</a>
	</div>
<?php }	?>
