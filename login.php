<div id="logininfo">
</div>
<div id="loginfields">
	<div id="togglebuttons">
    	<script src="/js/loginselection.js"></script>
		<button class="togglebtn" onclick="set_local_login();">Kohalik</button>
		<button class="togglebtn" onclick="set_google_login();">Google'i kasutaja</button>
	</div>
	<form action="func/log_in.php" method="post" name="login">
		<div class="error">
			<?php if(isset($login_error)&&!empty($login_error)) echo $login_error;?>
		</div><br>
		<div><b>Kasutajanimi: </b></div>
		<input type="text" name="username"><br>
		<div><b>Salasõna: </b></div>
		<input type="password" name="password"><br><br>
		<input type="hidden" name="lang" value="">
		<input type="submit" value="Sisene" name="check_login">
	</form>
</div>
