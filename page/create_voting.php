<?php
include "../data/config.php";
session_start();
$logged_user = pg_escape_string($_SESSION["login_user"]);
$id = "";
if($db){
    $res = pg_query($db, "SELECT id, username FROM person WHERE username ='".$logged_user."'");
    $rw = pg_fetch_assoc($res);
    $user = $rw["username"];
    $id = $rw["id"];

}

if(!isset($user)){
    echo "<span class='error'>Selle lehe nägemiseks pead olema sisse loginud</span>";
}
else{

$voting_error = "";
$title = "";
$start_date ="";
$start_time = "";
$finish_date = "";
$finish_time = "";
if($_POST["new_voting"]){

    $person = 1;
    $title = $_POST["title"];
    $start_date = pg_escape_string($_POST["start_date"]);
    $start_time = pg_escape_string($_POST["start_time"]);
    $finish_date = pg_escape_string($_POST["finish_date"]);
    $finish_time = pg_escape_string($_POST["finish_time"]);
    if($title && $start_date && $start_time && $finish_date && $finish_time){
        $start = date("d.m.Y H:i:s", strtotime($start_date." ".$start_time));
        $finish = date("d.m.Y H:i:s", strtotime($finish_date." ".$finish_time));
            if($db){

                $result = pg_query($db, "INSERT INTO voting(title, person, start_date, finish_date) VALUES('" . $title . "', '" . $id . "', '" . $start . "', '" . $finish . "')");
                if($result){
                    $title = "";
                    $start_date ="";
                    $start_time = "";
                    $finish_date = "";
                    $finish_time = "";
                    $voting_error = "Lisaud!";
                }
                pg_close($db);
            }
    }
    else{
        $voting_error = "Kõik väljad peavad olema täidetud!";
    }
}
?>

<form action="" method="post" name="create_voting">
    <span><?php echo $voting_error; ?></span><br>
    <b>Pealkiri: </b><br>
    <input type="text" name="title" value="<?php echo $title;?>"><br>
    <b>Algus aeg:</b><br>
    <input type="date" name="start_date" value="<?php echo $start_date;?>"><input type="time" name="start_time" value="<?php echo $start_time?>"><br>
    <b>Lõpu aeg:</b><br>
    <input type="date" name="finish_date" value="<?php echo $finish_date?>"><input type="time" name="finish_time" value="<?php echo $finish_time;?>"><br>
    <input type="submit" name="new_voting" value="Lisa">
</form>
<?php }?>