<?php # Script 8.6 - view_users.php #2
// This script retrieves all the records from the users table.

$myscript='edit_deleteusers.php';
$page_title = 'Edit/Delete Current Users';
include ('includes/loggedin.php');

require_once ('includes/mysqli_connect.php'); // Connect to the db.

// Page header:
$q='SELECT COUNT(custId) FROM customers';
$r = @mysqli_query ($dbc, $q);
$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
$num = $row[0];
echo '<h1>Registered Users</h1>'.
    "<p class=usercount>There are currently $num registered users.</p>\n";

$order_by='lastname';	// Define this var for table.inc.php.
$sort='ln';		// Define this var for table.inc.php.
include ('includes/table.inc.php');

include ('includes/footer.php');
?>
