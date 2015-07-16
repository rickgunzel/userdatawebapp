<?php
$page_title = "New User";
include ('includes/loggedin.php');
$tablename="customers";
$user= $_SESSION["username"];
$pass= $_SESSION['pass'];
if(!isset($_POST['submitted'])){// Initialize an error array.
	$profile = "SELECT * FROM $tablename where username='$user' AND pass=SHA1('$pass')";
		$result = @mysqli_query ($dbc, $profile);
                // Run the query.
		if ($result) { // If it ran OK.
                        echo '<h2>Current Profile</h2><table align="center" cellspacing="0" cellpadding="5" width="100%"><tr>';
   
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	   echo '<tr><h3>User Name:   ' . $row['username'] . '</h3></tr><br/>
            <tr><h3>Last Name:   ' . $row['lastname'] . '</h3></tr><br/>
	    <tr><h3>First Name:   ' . $row['firstname'] . '</h3></tr><br/>
	    <tr align="left"><h3>Address:   ' . $row['address'] . '</h3></tr><br/>
	    <tr><h3>City:   ' . $row['city'] . '</h3></tr><br/>
	    <tr><h3>State:   ' . $row['state'] . '</h3></tr><br/>
	    <tr><h3>Zip:   ' . $row['zip'] . '</h3></tr><br/>';
            $ln=$row['lastname'];
            $fn=$row['firstname'];
            $street=$row['address'];
            $city=$row['city'];
            $state=$row['state'];
            $zip=$row['zip'];
	    
    } // End of WHILE loop. 
    echo '</table>';
    }
}
// Check if the form has been submitted:
if (isset($_POST['submitted'])) {
	$tablename="customers";
        
		
	$errors = array();
       
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
		$errors[]= 'You forgot to enter your state.';
	} else {
		$state = mysqli_real_escape_string($dbc, trim($_POST['state']));
	}
	
	// Check for a zip code:
	if (!empty($_POST['zip'])) {
	    $zip = mysqli_real_escape_string($dbc, trim($_POST['zip']));
	} else {
	    $errors[] = 'You forgot to enter your zip code.';
	}
	
	if (empty($errors)&& $_SESSION['username']) { // If everything's OK.
	
		// Register the user in the database...
		
            // Update TABLE customers:
	    $q = "UPDATE $tablename SET firstname='$fn', lastname='$ln', username='$user', address='$street', city='$city', state='$state', zip=$zip where username='$user' AND pass=SHA1('$pass')";
		$r = @mysqli_query ($dbc, $q);
                // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '<h1>Thank you!</h1>
		<p class="update">Your profile is now updated.</p><p><br /></p>';	
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">Your profile could not be updated due to a system error. We apologize for any inconvenience.</p>'; 
			
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


<form name="login" action = "profile.php"  method = "post">
    
    <h2>Update Your Personal Information</h2>
    <br/>
    <!-- A borderless table of text widgets for name and address -->
    
    <table>
        <tr>
            <td> User Name: </td>
            <td> <input type = "text" name = "username" disabled = "true" id = "username"  value = "<?php echo $user ?>" /> </td>
        </tr>
        <tr>
            <td> First Name: </td>
            <td> <input type = "text"  name = "firstname" id="firstname" 
                        size = "30" value="<?php echo $fn ?>" /> </td>
            <td> Last Name: </td>
            <td> <input type = "text"  name = "lastname" id="lastname"
                        size = "30" value="<?php echo $ln ?>"/> </td>

        </tr>
        <tr>
            <td> Street Address: </td>
            <td> <input type = "text"  name = "street" id="street"
                        size = "30" value="<?php echo $street ?>"/> </td>
        
            <td> City: </td>
            <td> <input type = "text"  name = "city" id="city"
                        size = "30"  value="<?php echo $city ?>"/> </td>
        
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
                        size = "5" value="<?php echo $zip ?>"/> </td>
        </tr>
        
        
    </table>
    <p />


    

    <!-- The submit and reset buttons -->
    <p>
        <input type = "submit"  value = "Update Profile" />
        <input type="hidden" name="submitted" value="TRUE" />
    </p>
</form>


<?php

include ('includes/footer.php');
?>
