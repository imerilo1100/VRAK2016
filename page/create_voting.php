<?php
	//include "../data/config.php";
	$logged_user = "";
	if(isset($_SESSION["login_user"])) {$logged_user = pg_escape_string($_SESSION["login_user"]);}
	$id = "";
	if($db){
		$res = pg_query($db, "SELECT id, username FROM person WHERE username ='".$logged_user."'");
		$rw = pg_fetch_assoc($res);
		$user = $rw["username"];
		$id = $rw["id"];
	}
	if(!isset($user)){
		echo "<span class='error'>Selle lehe nägemiseks pead olema sisse loginud <a href='?to=create_voting'>Logi sisse</a></span>";
	}
	else{
		$voting_error = "";
		$title = "";
		$start_date ="";
		$start_time = "";
		$finish_date = "";
		$finish_time = "";
		$regions = "";
		if(isset($_POST["new_voting"])){
			$person = 1;
			$title = pg_escape_string($_POST["title"]);
			$start_date = pg_escape_string($_POST["start_date"]);
			$start_time = pg_escape_string($_POST["start_time"]);
			$finish_date = pg_escape_string($_POST["finish_date"]);
			$finish_time = pg_escape_string($_POST["finish_time"]);
			$regions = pg_escape_string($_POST["regions"]);
			if($title && $start_date && $start_time && $finish_date && $finish_time && $regions) {
				$start = date("d.m.Y H:i:s", strtotime($start_date . " " . $start_time));
				$finish = date("d.m.Y H:i:s", strtotime($finish_date . " " . $finish_time));
				if ($start >= $finish) {$voting_error = "Algus aeg ei tohi olla suurem lõpu ajast!";} 
				else {
				    $result0 = pg_query($db, "SELECT title FROM voting WHERE title = '".$title."'");
				    $row0 = pg_fetch_assoc($result0);
				    if($row0["title"]){$voting_error = "Antud pealkiri on juba kasutusel!";} 
					else {
				    	if ($db) {
							$result = pg_query($db, 
											"INSERT INTO voting(title, person, start_date, finish_date, regions) 
											VALUES('" . $title . "', '" . $id . "', '" . $start . "', '" . $finish . 
											"', '" . $regions ."')");
				            if ($result) {
				                $title = "";
				                $start_date = "";
				                $start_time = "";
				                $finish_date = "";
				                $finish_time = "";
				                $regions = "";
				                $voting_error = "Lisatud!";
				            }
				        }
				    }
				}
			}else{$voting_error = "Kõik väljad peavad olema täidetud!";}
	}
?>

<form action="" method="post" name="create_voting">
    <span id="titleck"><?php echo $voting_error; ?></span><br>
    <label for="title"><strong>Pealkiri: </strong></label><br>
    <input type="text" id="title" name="title" value="<?php echo $title;?>"><br>
    <label for="start"><strong>Algus aeg:</strong></label><br>
    <input type="date" id="start" name="start_date" value="<?php echo $start_date;?>"><input type="time" id="start" name="start_time" value="<?php echo $start_time?>"><br>
    <label for="finish"><strong>Lõpu aeg:</strong></label><br>
    <input type="date" id="finish" name="finish_date" value="<?php echo $finish_date?>"><input type="time" id="finish" name="finish_time" value="<?php echo $finish_time;?>"><br>
    <label for="regions"><strong>Piirkonnad (Tuleb kirjutada üks piirkond ühele reale!): </strong></label><br>
    <textarea id="regions" name="regions"><?php echo $regions;?></textarea>
    <input type="submit" name="new_voting" value="Lisa">
</form>
<?php pg_close($db); }?>
