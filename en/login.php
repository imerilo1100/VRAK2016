<div id="logininfo">
</div>
<div id="loginfields">
	<div id="togglebuttons">
		<button class="togglebtn">Local user</button>
		<button class="togglebtn">ID-Card</button>
		<button class="togglebtn">Digi-ID</button>
		<button class="togglebtn">Mobile ID</button>
	</div>
	<form action="../func/log_in.php" method="post" name="login">
		<div class="error"><?php echo $login_error."<br>"; ?></div>
		<div><b>Username: </b></div>
		<input type="text" name="username"><br>
		<div><b>Password: </b></div>
		<input type="password" name="password"><br><br>
		<input type="hidden" name="lang" value="en">
		<input type="submit" value="Log in" name="check_login">
	</form>
</div>
