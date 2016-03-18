<?
include "../data/config.php";
$voting = "";
if($_POST["select_voting"]) {
    $voting = $_POST["voting"];
}
?>

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
                    if($voting == $id) {
                        echo "<option value='$id' selected='selected'>$title</option>";
                    }
                    else{
                        echo "<option value='$id'>$title</option>";
                    }
                }

            }

            ?>

        </select>
        <input type="submit" name="select_voting" value="Vali">
</form>
<?php


        if($voting) {


            ?>
            <table>
                <tr>
                    <td><b>Nimi</b></td>
                    <td><b>Erakond</b></td>
                    <td><b>Number</b></td>
                </tr>
                <?php


                if ($db) {
                    $result1 = pg_query($db, "SELECT firstname, lastname, voting, votenumber, party FROM candidate WHERE voting=$voting");
                    while ($row = pg_fetch_assoc($result1)) {
                        $firstname = $row["firstname"];
                        $lastname = $row["lastname"];
                        $votenumber = $row["votenumber"];
                        $party = $row["party"];

                        echo "<tr>
                <td>$firstname $lastname</td>
                <td>$party</td>
                <td>$votenumber</td>
                </tr>";
                    }
                    echo pg_last_error($db);

                }
                ?>

            </table>
            <?php

    }
pg_close($db);
?>

