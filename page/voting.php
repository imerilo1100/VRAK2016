<?php
	include "../data/config.php";
	$voting_error = "";
	if(isset($_POST["vote"])){
		if($db){
		    /**+1 to candidate*/
		    $result = pg_query($db, "");
		    /**add user to voted*/
		    $result1 = pg_query($db, "");
		    if($result){$voting_error ="Hääl on antud!";}
		}
	}
	pg_close($db);
?>

<div id="logininfo">List of candidates:</div>

<div id="loginfields">
    <form action="" method="post" name="voting">
        <b>Vali kandidaat: </b>
        <span><?php echo $voting_error;?></span><br>
        <input type="text" name="candidate_nr"><br>
        <input type="submit" name="vote" value="Hääleta">
    </form>
</div>
