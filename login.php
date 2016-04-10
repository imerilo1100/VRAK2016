<div id="logininfo">
</div>
<div id="loginfields">
	<div id="togglebuttons">
		<button class="togglebtn">Kohalik</button>
		<button class="togglebtn">ID-Kaart</button>
		<button class="togglebtn">Digi-ID</button>
		<button class="togglebtn">Mobiil-ID</button>
	</div>
	<form action="func/log_in.php" method="post" name="login">
		<div class="error"><?php echo $login_error."<br>"; ?></div>
		<div><b>Kasutajanimi: </b></div>
		<input type="text" name="username"><br>
		<div><b>Salasõna: </b></div>
		<input type="password" name="password"><br><br>
		<input type="hidden" name="lang" value="">
		<input type="submit" value="Sisene" name="check_login">
	</form>
</div>
