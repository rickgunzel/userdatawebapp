<?php
// Check if the form has been submitted:
if (isset($_POST['submitted'])) {

	$errors = array();
	
	// Check for a first name:
	if (empty($_POST['firstname'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$firstname = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
	}
	
	// Check for a last name:
	if (empty($_POST['lastname'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$lastname = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
	}
	
	// Check for an street address:
	if (empty($_POST['address'])) {
		$errors[] = 'You forgot to enter your street address.';
	} else {
		$address = mysqli_real_escape_string($dbc, trim($_POST['address']));
	}

	// Check for an City:
	if (empty($_POST['city'])) {
		$errors[] = 'You forgot to enter your city.';
	} else {
		$city = mysqli_real_escape_string($dbc, trim($_POST['city']));
	}

	// Check for an state:
	if (empty($_POST['state'])) {
		$errors[] = 'You forgot to enter your state.';
	} else {
		$state = mysqli_real_escape_string($dbc, trim($_POST['state']));
	}

	// Check for an zip:
	if (empty($_POST['zip'])) {
		$errors[] = 'You forgot to enter your zip.';
	} else {
		$zip = mysqli_real_escape_string($dbc, trim($_POST['zip']));
	}

	if (empty($errors)) { // If everything's OK.
	
		//  Test for unique email address:
		$q = "SELECT username FROM customers WHERE custId='$id'";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 1) {

			// Make the query:
			$q = "UPDATE customers SET firstname='$firstname', lastname='$lastname', address='$address', city='$city', state='$state', zip='$zip' WHERE custId=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
			
				// Print a message:
?>
			    <h1>Thank you!</h1>
			    <p class="update">The user has been changed.</p><br />
			    <h2>Changes are shown</h2>
			    <script type="text/javascript">
				var f=document.getElementById("editForm");
				f.firstname.disabled=true;
			    </script>
<?php
			} else if($r==TRUE) {
				echo '<p class="update">Nothing to update, no changes were made.</p>';
			} else { // If it did not run OK.
				echo "<!-- r=$r -->\n";
				echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
				
		} else { // Already registered.
			echo '<p class="error">Customer '.$firstname." ".$lastname ." custId=".$id." has never been registered.</p>";
		}
		
	}

} else {
    echo $mytitle;
    $q="SELECT * FROM customers WHERE custId='$id';";
    $r = mysqli_query ($dbc, $q); // Run the query.
    $num = @mysqli_num_rows($r);
    if ($num > 0) { // The person exists
	$row=mysqli_fetch_array($r, MYSQLI_ASSOC);
	$firstname=$row['firstname'];
	$lastname=$row['lastname'];
	$address=$row['address'];
	$city=$row['city'];
	$state=$row['state'];
	$zip=$row['zip'];
    } else {
	$error='<p class="error">This page has been accessed in error.</p>';
    }

}  // End of submit conditional.

// Always show the form...

// Retrieve the user's information:

if (empty($errors)) { // If everything's OK.

    /*
     * N E W 
     * F O R M
     */
    if (isset($_POST['submitted'])) {
	$ro='" readonly="readonly';
	$submitButton='';
    } else {
	$ro='';
	$submitButton='<p><input type="submit" name="submit" value="Submit" /></p>';
    }
    if ($myform == "current.php") {
	echo '<p>User Name:<input type="text" size="10" maxlength="20" disabled="disabled" value="' . $name . '" ></input></p>'."\n";
    }
    echo '<form id="editForm" action="' . $myform . '" method="post" >
	<p>First Name:
	<input type="text" id="firstname" name="firstname" size="15" maxlength="20" value="'.$firstname.$ro.'" /></p>
	<p>Last Name:
	<input type="text" name="lastname" size="15" maxlength="30" value="'.$lastname.$ro.'" /></p>
	<p>Street:
	<input type="text" name="address" size="20" maxlength="40" value="'.$address.$ro.'"  /> </p>
	<p>City:
	<input type="text" name="city" size="20" maxlength="40" value="' . $city . $ro . '"  /> </p>
	<p>State:
	<input type="text" name="state" size="2" maxlength="2" value="' . $state . $ro . '"  /> </p>
	<p>Zip:
	<input type="text" name="zip" size="5" maxlength="5" value="' . $zip . $ro . '"  /> </p>';
	echo $submitButton;
	echo '<input type="hidden" name="submitted" value="TRUE" />
	<input type="hidden" name="id" value="' . $id . '" />
	</form>';

} else { // Not a valid user ID.
    echo '<p class="error">The following error(s) occurred:<br />';
    foreach ($errors as $msg) { // Print each error.
	    echo " - $msg<br />\n";
    }
    echo '</p><p>Please try again.</p>';
}

mysqli_close($dbc);

?>
