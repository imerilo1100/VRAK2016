<!DOCTYPE html> <!--HTML 5: http://www.w3schools.com/tags/tag_doctype.asp -->
<?php require "data/config.php";?>
<?php require("header.php");?> 
<?php require("banner.php");?>
<div id="contentcontainer">
<?php

if (isset($_GET['page'])) {

    if (file_exists('page/' . $_GET['page'] . '.php')) {

        require('page/' . $_GET['page'] . '.php');

    } else {

        echo '<span class="error">Viga! Sellist lehte ei leidu!</span>';

    }
}
else{
    require("content_login.php");
}

?>
</div>
<?php require("fin.php");?> 
</html>
