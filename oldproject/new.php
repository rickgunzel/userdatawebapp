<?php
$page_title = "New User";
include ('includes/header.php');

$user= $_COOKIE["username"];
$pass= $_COOKIE["password"];

// Check if the form has been submitted:
if (isset($_POST['submitted'])) {
	$tablename="customers";

		
	$errors = array(); // Initialize an error array.
	
	// Check for a first name:
	if (empty($_POST['firstname'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
	}
	
	// Check for a last name:
	if (empty($_POST['lastname'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
	}
	// Check for an street address:
	if (empty($_POST['street'])) {
		$errors[] = 'You forgot to enter your street address.';
	} else {
		$street = mysqli_real_escape_string($dbc, trim($_POST['street']));
	}
	// Check for an city:
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
	
	// Check for a zip code:
	if (!empty($_POST['zip'])) {
	    $zip = mysqli_real_escape_string($dbc, trim($_POST['zip']));
	} else {
	    $errors[] = 'You forgot to enter your zip code.';
	}
	
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		// Make the query:
	    $q = "INSERT INTO $tablename (firstname, lastname, username, pass, address, city, state, zip) VALUES ('$fn', '$ln', '$user', SHA1('$pass'), '$street', '$city', '$state', '$zip')";
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '<h1>Thank you!</h1>
		<p class="update">You are now registered. You may now login with username and password.</p><p><br /></p>';	
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include ('includes/footer.php'); 
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

}
?>


<form name="login" action = "new.php"  method = "post">
    <h2>Fill in your New Login Information</h2>

    <!-- A borderless table of text widgets for name and address -->
    
    <table>
        <tr>
            <td> User Name: </td>
            <td> <input type = "text" name = "username" disabled = "true" id = "username"  value = "<?php echo $user ?>" /> </td>
        </tr>
        <tr>
            <td> First Name: </td>
            <td> <input type = "text"  name = "firstname" id="firstname" value = ""
                        size = "30" value="" /> </td>
            <td> Last Name: </td>
            <td> <input type = "text"  name = "lastname" id="lastname"
                        size = "30" value=""/> </td>

        </tr>
        <tr>
            <td> Street Address: </td>
            <td> <input type = "text"  name = "street" id="street"
                        size = "30" /> </td>
        
            <td> City: </td>
            <td> <input type = "text"  name = "city" id="city"
                        size = "30" /> </td>
        
            <td> State: </td>
            <td>
                <select name="state">
                    <option value="">Select a State</option>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
            </td>
        </tr>
        <tr>
            <td> Zip (5 digit): </td>
            <td> <input type = "text"  name = "zip" id="zip"
                        size = "5" /> </td>
        </tr>
        
        
    </table>
    <p />


    

    <!-- The submit and reset buttons -->
    <p>
        <input type = "submit"  value = "Complete Registration" />
        <input type="hidden" name="submitted" value="TRUE" />
    </p>
</form>


<?php

include ('includes/footer.php');
?>
