<?php
// Number of records to show per page:
$display = 15;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(custid) FROM customers";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Make the query:
$q = "SELECT lastname, firstname, address, city, state, zip, custId FROM customers ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.

/* gmj20100406 DEBUG TODO: What do I do here if mysqli_query() totaly fails?
 * If I don't check for r==0 then I get a message.  If I do leave it in I get
 * a notice that r can't be converted to an int.
 */
if(mysqli_affected_rows($dbc) == 0) {
    echo '<p class="error">Sorry, having problems accesing database at this time.</p>';
} else if(mysqli_num_rows($r)>0) {

    // Table header:
    if ($page_title == 'Sort the Current Users') {
	echo '<table align="center" cellspacing="0" cellpadding="5" width="100%">
	<tr>
	    <th><a href="view_userssort.php?sort=ln">Last Name</a></th>
	    <th><a href="view_userssort.php?sort=fn">First Name</a></th>
	    <th align="left">Address</th>
	    <th><a href="view_userssort.php?sort=ct">City</a></th>
	    <th><a href="view_userssort.php?sort=st">State</a></th>
	    <th><a href="view_userssort.php?sort=zp">Zip</a></th>
	</tr>';
    } else {
	echo '<table align="center" cellspacing="0" cellpadding="5" width="100%"><tr>';
	if($page_title == 'Edit/Delete Current Users') {
	    echo '<th>Edit</th>
		<th>Delete</th>';
	}
	echo '<th>Last Name</th>
	    <th>First Name</th>
	    <th align="left">Address</th>
	    <th>City</th>
	    <th>State</th>
	    <th>Zip</th>
	</tr>';
    }

    // Fetch and print all the records....
    $bg = '#eeeeee'; 
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	    $bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
	    echo '<tr bgcolor="' . $bg . '">';
	    if($page_title == 'Edit/Delete Current Users') {
		echo '<td align="left"><a href="edit_user.php?id=' . $row['custId'] .'">Edit</a></td>
		    <td align="left"><a href="delete_user.php?id=' . $row['custId'] .'">Delete</a></td>';
	    }
	    echo '<td align="left">' . $row['lastname'] . '</td>
		<td align="left">' . $row['firstname'] . '</td>
		<td align="left">' . $row['address'] . '</td>
		<td align="left">' . $row['city'] . '</td>
		<td align="left">' . $row['state'] . '</td>
		<td align="left">' . $row['zip'] . '</td>
	    </tr>';
    } // End of WHILE loop.

    echo '</table>';
    mysqli_free_result ($r);
    mysqli_close($dbc);

    // Make the links to other pages, if necessary.
    if ($pages > 1) {
	    
	    echo '<br /><p>';
	    $current_page = ($start/$display) + 1;
	    
	    // If it's not the first page, make a Previous button:
	    if ($current_page != 1) {
		    echo '<a href="'.$myscript.'?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	    }
	    
	    // Make all the numbered pages:
	    for ($i = 1; $i <= $pages; $i++) {
		    if ($i != $current_page) {
			    echo '<a href="'.$myscript.'?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		    } else {
			    echo $i . ' ';
		    }
	    } // End of FOR loop.
	    
	    // If it's not the last page, make a Next button:
	    if ($current_page != $pages) {
		    echo '<a href="'.$myscript.'?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	    }
	    
	    echo '</p>'; // Close the paragraph.
	    
    } // End of links section.
} else {  // End if r>0, no records returned.
	echo '<p class="error">There are currently no registered users.</p>';
}
?>
