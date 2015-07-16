<?php # Script 9.3 - edit_user.php

// This page is for editing a user record.
// This page is accessed through view_users.php.

$page_title = 'Edit a User';
include ('includes/loggedin.php');

// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('includes/footer.php'); 
	exit();
}

$mytitle= '<h1>Edit a User</h1>';
$myform="edit_user.php";
require_once ('includes/mysqli_connect.php'); 

include ('includes/edit.inc.php');
include ('includes/footer.php');
?>
