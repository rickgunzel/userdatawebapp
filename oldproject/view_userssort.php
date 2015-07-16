<?php # Script 9.5 - #5

// This script retrieves all the records from the users table.
// This new version allows the results to be sorted in different ways.

$myscript='view_userssort.php';
$page_title = 'Sort the Current Users';
include ('includes/loggedin.php');
echo '<h1>Registered Users</h1>'.
	'<h2>Click on blue titles to sort your data</h2><br />';

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
	case 'ln':
		$order_by = 'lastname ASC';
		break;
	case 'fn':
		$order_by = 'firstname ASC';
		break;
	case 'ct':
		$order_by = 'city ASC';
		break;
	case 'st':
		$order_by = 'state ASC';
		break;
	case 'zp':
		$order_by = 'zip ASC';
		break;

	default:
		$order_by = 'lastname ASC';
		$sort = 'ln';
		break;
}

include ('includes/table.inc.php');

include ('includes/footer.php');
?>
