<?php # Script 8.7 - password.php
// This page lets a user change their password.

$page_title = 'Change Your Password';
    
    include ('includes/loggedin.php');
    
        
// Check if the form has been submitted:
if (isset($_POST['submitted'])) {

	$errors = array(); // Initialize an error array.
	
	// Check for an username:
	if (empty($_POST['username'])) {
		$errors[] = 'You forgot to enter your username.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['username']));
	}
	
	// Check for the current password:
	if (empty($_POST['pass'])) {
		$errors[] = 'You forgot to enter your current password.';
	} else {
		$p = mysqli_real_escape_string($dbc, trim($_POST['pass']));
	}

	// Check for a new password and match 
	// against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your new password did not match the confirmed password.';
		} else {
			$np = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your new password.';
	}
	
	if (empty($errors)) { // If everything's OK.
	
		// Check that they've entered the right username/password combination:
		$q = "SELECT custId FROM customers WHERE (username='$e' AND pass=SHA1('$p') )";
		$r = @mysqli_query($dbc, $q);
		$num = @mysqli_num_rows($r);
		if ($num >= 1) { // Match was made.
		
			// Get the user_id:
			$row = mysqli_fetch_array($r, MYSQLI_NUM);

			// Make the UPDATE query:
			//secure with sha1()
			$q = "UPDATE customers SET pass=SHA1('$np') WHERE custId=$row[0]";
			$r = @mysqli_query($dbc, $q);
			
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
			
				// Print a message.
				echo '<h1>Thank you!</h1>
				<p class="update">Your password has been updated.</p><p><br /></p>';	
			
			} else { // If it did not run OK.
			
				// Public message:
				echo '<h1>System Error</h1>
				<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>'; 
				
				// Debugging message:
				echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
				
			}

			// Include the footer and quit the script (to not show the form).
			include ('includes/footer.php'); 
			exit();
				
		} else { // Invalid username/password combination.
			echo '<h1>Error!</h1>
			<p class="error">The username and password do not match those on file.</p>';
		}
		
	} else { // Report the errors.
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.

	mysqli_close($dbc); // Close the database connection.
		
} // End of the main Submit conditional.
?>
<h2>Change Your Password</h2>
<br/>
<form action="changepassword.php" method="post">
	<p>User Name: <input type="text" name="username" size="20" maxlength="80" value="
	<?php echo (isset($_POST['username']) ? $_POST['username'] : '');?> "  /> </p>
	<p>Current Password: <input type="password" name="pass" size="10" maxlength="20" /></p>
	<p>New Password: <input type="password" name="pass1" size="10" maxlength="20" /></p>
	<p>Confirm New Password: <input type="password" name="pass2" size="10" maxlength="20" /></p>
	<p><input type="submit" name="submit" value="Change Password" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>
<?php
include ('includes/footer.php');
?>
