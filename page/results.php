<?php
	$voting = "";
	$stat = "";
?>

<div class="candidateSelect">
    <label for="voting_select"><strong>Valimised:</strong></label>
    <form method="post" name="show_stat">
        <select id="voting_select" name="voting">
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
        <select name="statistika">
            <option value="Piirkond">Piirkonna</option>
            <option value="Erakond">Erakonna</option>
            <option value="Kandidaat">Kandidaadi</option>
        </select>
        <input type="submit" name="select_voting" value="Vali">
    </form>
</div>
<?php
	if(isset($_POST["select_voting"])) {
	$voting = $_POST["voting"];
	$stat = $_POST["statistika"];
?>
<table>
    <tr>
        <td><strong><?php echo $stat;?></strong></td>
        <td><strong>Hääli</strong></td>
    </tr>
    <?php
		if ($db&&$voting!="") {
		    if($stat == "Piirkond"){
		        $result1 = pg_query($db, "SELECT region, SUM(votes) FROM candidate WHERE voting=$voting GROUP BY region");
		        while ($row = pg_fetch_assoc($result1)) {
		            $region = $row["region"];
		            $sum = $row["sum"];
		            echo"<tr><td>$region</td><td>$sum</td></tr>";
		        }
		    }elseif($stat == "Erakond"){
		        $result1 = pg_query($db, "SELECT party, SUM(votes) FROM candidate WHERE voting=$voting GROUP BY party");
		        while ($row = pg_fetch_assoc($result1)) {
		            $party = $row["party"];
		            $sum = $row["sum"];
		            echo"<tr><td>$party</td><td>$sum</td></tr>";
		        }
		    }elseif($stat == "Kandidaat"){
		        $result1 = pg_query($db, "SELECT firstname, lastname, SUM(votes) FROM candidate WHERE voting=$voting GROUP BY firstname, lastname");
		        while ($row = pg_fetch_assoc($result1)) {
		            $firstname = $row["firstname"];
		            $lastname = $row["lastname"];
		            $sum = $row["sum"];
		            echo"<tr><td>$firstname $lastname</td><td>$sum</td></tr>";
		        }
		    }
		    echo pg_last_error($db);
		}
		pg_close($db);
    ?>
    <tr><td colspan="3"><div id="last_cand_loader"></div></td></tr>
</table>
<?php }?>
