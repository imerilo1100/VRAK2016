<?php
	//include "../data/config.php";
	$logged_user = "";
	if(isset($_SESSION["login_user"])) {
		$logged_user = pg_escape_string($_SESSION["login_user"]);
	}
	if($db){
		$res = pg_query($db, "SELECT username FROM person WHERE username ='".$logged_user."'");
		$rw = pg_fetch_assoc($res);
		$user = $rw["username"];
	}
	if(!isset($user)){
		echo "<span class='error'>Selle lehe nägemiseks pead olema sisse loginud <a href='?to=create_candidate'>Logi sisse</a></span>";
	}
	else{
	$candidate_error = "";
	$firstname = "";
	$lastname = "";
	$voting = "";
	$party = "";
	$region = "";
        $select_vote = "";
	//include "../data/config.php";
    if(isset($_POST["select_vote"])) {
        $voting = pg_escape_string($_POST["voting"]);
        $select_vote = true;
    }
    if(isset($_POST["add_candidate"])){
        $select_vote = true;
		$firstname = pg_escape_string($_POST["firstname"]);
		$lastname = pg_escape_string($_POST["lastname"]);
		$voting = pg_escape_string($_POST["voting"]);
		$party = pg_escape_string($_POST["party"]);
		$region = pg_escape_string($_POST["region"]);
		if($firstname && $lastname && $voting && $party && $region){
		    if($db){
		        $result = pg_query($db, "INSERT INTO candidate(firstname, lastname, votenumber, voting, party, region) VALUES('" .$firstname."', '" .$lastname. "', nextval('vote_number'), '" .$voting. "', '" .$party."', '".$region."')");
		        if($result){
		            $firstname = "";
		            $lastname = "";
		            $party = "";
                    $region = "";
		            $candidate_error = "Lisatud!";
		        }
		    }
		}
		else{$candidate_error = "Kõik väljad peavad olema täidetud!";}
	}
?>

<form name="create_candidate" method="post" action="">
	<select id="voting" name="voting">
		<option value="0" <?php if(!$voting)echo"selected='selected'"?> disabled="disabled">Vali</option>
        <?php
		    if($db){
				$result = pg_query($db, "SELECT * FROM voting");
				while($row = pg_fetch_assoc($result)){
					$id = $row["id"];
					$title = $row["title"];
					$start_date = $row["start_date"];
					$finish_date = $row["finish_date"];
					$start_date = str_replace("/", ".", $start_date);
					$current = time();
					if(strtotime($start_date) > $current) { //kontrollib kas hääletus ei ole aktiivne!!!!
						if ($voting == $id) {echo "<option value='$id' selected='selected'>$title</option>";} 
						else {echo "<option value='$id'>$title</option>";}
					}
				}
			}
        ?>
    </select><br>
    <input type="submit" value="Vali" name="select_vote">
    <?php if($select_vote){ ?>
    <span><?php echo $candidate_error;?></span><br>
    <label for="firstname"><strong>Kandidaadid eesnimi:</strong></label><br>
    <input type="text" id="firstname" name="firstname" value="<?php echo $firstname;?>"><br>
    <label for="lastname"><strong>Kandidaadi perenimi:</strong></label><br>
    <input type="text" id="lastname" name="lastname" value="<?php echo $lastname;?>"><br>
    <label for="party"><strong>Erakond</strong></label><br>
    <input type="text" id="party" name="party" value="<?php echo $party;?>"><br>
	<label for="voting"><strong>Piirkond:</strong></label><br>
    <select id="voting" name="region">
        <option value="0" <?php if(!$region)echo"selected='selected'"?> disabled="disabled">Vali</option>
        <?php
		    if($db){
                $result = pg_query($db, "SELECT * FROM voting WHERE id='$voting'");
                while($row = pg_fetch_assoc($result)){
                    $id = $row["id"];
                    $region_text = $row["regions"];;
                    $regs = explode(PHP_EOL, $region_text);
                    for ($i = 0; $i < count($regs); $i++){
                        if ($region == $regs[$i]) {echo "<option value='$regs[$i]' selected='selected'>$regs[$i]</option>";} 
						else {echo "<option value='$regs[$i]'>$regs[$i]</option>";}
					}
		        }
		    }
        ?>
    </select><br>
    <input type="submit" name="add_candidate" value="Lisa">
    <?php }?>
</form>
<?php } pg_close($db);?>
