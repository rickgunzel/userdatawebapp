<?php
/*  This worked fine with FreeBSD.
 echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="includes/style.css" type="text/css"  />
</head>
<body>
    <div id="header">
	<h1>Bike for fun</h1>
	<h2><b>Privacy policy:</b><em>None</em></h2>
    </div>
    <div id="content">'."\n";
 * 
 */
include('includes/header.php');

function absolute_url ($page = 'start.php') {

	// Start defining the URL...
	// URL is http:// plus the host name plus the current directory:
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

	// Remove any trailing slashes:
	$url = rtrim($url, '/\\');

	// Add the page:
	$url .= '/' . $page;

	// Return the URL:
	return $url;

} // End of absolute_url() function.
 /*$page_title = '';
  *include ('header.php'); Not used due to direct links of page? */

// Check if the form has been submitted:
if (isset($_POST['submitted'])) {
	
	$errors = array(); // Initialize an error array.

	// Check for a first name:
	if (empty($_POST['user_name'])) {
		$errors[] = 'You forgot to enter your user name.';
	} else {
		$user = mysqli_real_escape_string($dbc, trim($_POST['user_name']));

	}

	
	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$pass = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}

	if (empty($errors)) { // If everything's OK.

		// Register the user in the database...

		// Make the query:
		$q = "SELECT custId FROM customers WHERE username = '$user' AND pass =SHA1('$pass')";
		$r = mysqli_query ($dbc, $q); // Run the query.
		$num = @mysqli_num_rows($r);
		if ($num >=1) { // The person exists
		    $row = @mysqli_fetch_array ($r, MYSQLI_NUM);
		    setcookie("userid", $row[0]);
		    setcookie("username", $user);

		    //Redirect
		    $url=absolute_url('current.php');
		    header("Location:$url");
		    exit();
		
		} else { // Person does not exist

		    //Redirect
		    setcookie("username", $user);
		    setcookie("password", $pass);
		    $url=absolute_url('new.php');
		    header("Location:$url");
		    exit();
			
		} // End of if ($r) IF.

		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		//include ('includes/footer.html');
		exit();

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
if (!isset($_POST['submitted'])||!empty($errors)) {
    ?>
    <h1>Register</h1>
<form action="start.php" method="post">
	<p>User Name: <input type="text" name="user_name" size="15" maxlength="20" value="
	<?php echo (isset($_POST['username']) ? $_POST['username'] : '');?> "  /> </p>
	<p>Password: <input type="password" name="pass1" size="10" maxlength="20" /></p>
	<p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" /></p>
	<p><input type="submit" name="submit" value="Register" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>
<?php
}
include ('includes/footer.php');
?>
