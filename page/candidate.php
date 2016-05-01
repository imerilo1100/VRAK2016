<?php
	$db = pg_connect("dbname=d8m5d1ggv02dvb 
					  host=ec2-54-247-167-90.eu-west-1.compute.amazonaws.com 
					  port=5432 
					  user=mcnptqegvzaixb 
					  password=lGS_pncoLTlIx5DzMybQxA4_R2 
					  sslmode=require");
	$voting = "";
	if(isset($_POST["select_voting"])) {$voting = $_POST["voting"];}
?>

<div class="candidateSelect">
    <b>Valimised:</b>
    <form method="post" action="" name="show_voting">
        <select name="voting">
            <option value="0" <?php if(!$voting)echo"selected='selected'"?> disabled="disabled">Vali</option>
            <?php
		        if($db){
		            $result = pg_query($db, "SELECT * FROM voting");
		            while($row = pg_fetch_assoc($result)){
		                $id = $row["id"];
		                $title = $row["title"];
		                if($voting == $id) {echo "<option value='$id' selected='selected'>$title</option>";}
		                else{echo "<option value='$id'>$title</option>";}
		            }
		        }
            ?>
        </select>
        <input type="submit" name="select_voting" value="Vali">
        <div class="frmSearch">
            <input type="text" id="search" size="25">
            <div id="suggestion-box"></div>
        </div>
	</form>
</div>

<?php
	if($voting) {
		$candidateSum = 0;
		$voteSum = 0;
		if($db){
			$res = pg_query($db, "SELECT sumOfCandidates($voting)");
			$value1 = pg_fetch_result($res, 0);
			$res1 = pg_query($db, "SELECT sumOfVotes($voting)");
			$value2 = pg_fetch_result($res1, 0);
			if($value1){$candidateSum = $value1;}
            if($value2){$voteSum = $value2;}
        }
	}
?>

<div class="candidateInfo">
	Kandidaate kokku: <?php echo $candidateSum;?><br>
    Hääletanuid kokku: <?php echo $voteSum;?>
</div>
<table>
	<tr>
		<td><b>Nimi</b></td>
		<td><b>Erakond</b></td>
		<td><b>Number</b></td>
	</tr>
    <?php
		if ($db) {
			$result1 = pg_query($db, "SELECT id, firstname, lastname, voting, votenumber, party FROM candidate WHERE voting=$voting ORDER BY id DESC LIMIT 2");
			while ($row = pg_fetch_assoc($result1)) {
				$id = $row["id"];
				$firstname = $row["firstname"];
				$lastname = $row["lastname"];
				$votenumber = $row["votenumber"];
				$party = $row["party"];
				$candID = "CD". $voting . "-" . $id;
				echo "<tr id='$candID' class='candidateList'>
                		<td>$firstname $lastname</td>
                		<td>$party</td>
                		<td>$votenumber</td>
                	  </tr>";
            }
            echo pg_last_error($db);
		}
		pg_close($db);
	?>
    <tr><td colspan="3"><div id="last_cand_loader"></div></td></tr>
</table>
