<?php
$page_title = "Current Information";
include ('includes/header.php');
$id= $_COOKIE["userid"];
$name= $_COOKIE["username"];
require_once ('includes/mysqli_connect.php'); // Connect to the db.
$mytitle='<h2>Current Information: Edit any and press submit</h2>';
$myform="current.php";
include ('includes/edit.inc.php');
include ('includes/footer.php');
?>
