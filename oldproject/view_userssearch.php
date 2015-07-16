<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    
    include('includes/loggedin.php');


if (!empty($_REQUEST['term'])&& empty($_REQUEST['stateSearch'])) {

$term = mysql_real_escape_string($_REQUEST['term']);     

$sql = "SELECT * FROM customers WHERE lastname LIKE '%".$term."%'"; 
$r_query = mysqli_query($dbc,$sql);
    echo '<h1>Name Results</h1><table align="center" cellspacing="0" cellpadding="5" width="100%"><tr>';
    echo '<th>Last Name</th>
	    <th>First Name</th>
	    <th align="left">Address</th>
	    <th>City</th>
	    <th>State</th>
	    <th>Zip</th>
	</tr>';

    $bg = '#eeeeee'; 
    while ($row = mysqli_fetch_array($r_query, MYSQLI_ASSOC)) {
	    $bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
	    echo '<tr bgcolor="' . $bg . '">';
	    echo '<td align="left">' . $row['lastname'] . '</td>
		<td align="left">' . $row['firstname'] . '</td>
		<td align="left">' . $row['address'] . '</td>
		<td align="left">' . $row['city'] . '</td>
		<td align="left">' . $row['state'] . '</td>
		<td align="left">' . $row['zip'] . '</td>
	    </tr>';
    } // End of WHILE loop. 
    echo '</table>';
}
if (!empty($_REQUEST['stateSearch'])&& empty($_REQUEST['term'])) {
    

$stateSearch = mysql_real_escape_string($_REQUEST['stateSearch']);     

$sql = "SELECT * FROM customers WHERE state LIKE '%".$stateSearch."%' "; 
$r_query = mysqli_query($dbc,$sql);
    echo '<h1>State Results</h1><table align="center" cellspacing="0" cellpadding="5" width="100%"><tr>';
    echo '<th>Last Name</th>
	    <th>First Name</th>
	    <th align="left">Address</th>
	    <th>City</th>
	    <th>State</th>
	    <th>Zip</th>
	</tr>';
   
    $bg = '#eeeeee'; 
    while ($row = mysqli_fetch_array($r_query, MYSQLI_ASSOC)) {
	    $bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
	    echo '<tr bgcolor="' . $bg . '">';
	    echo '<td align="left">' . $row['lastname'] . '</td>
		<td align="left">' . $row['firstname'] . '</td>
		<td align="left">' . $row['address'] . '</td>
		<td align="left">' . $row['city'] . '</td>
		<td align="left">' . $row['state'] . '</td>
		<td align="left">' . $row['zip'] . '</td>
	    </tr>';
    } // End of WHILE loop. 
    echo '</table>';
}
if (!empty($_REQUEST['stateSearch'])&&!empty($_REQUEST['term'])) {

$term = mysql_real_escape_string($_REQUEST['term']);      
$stateSearch = mysql_real_escape_string($_REQUEST['stateSearch']); 
$sql = "SELECT * FROM customers WHERE state LIKE '%".$stateSearch."%' AND lastname LIKE '%".$term."%' "; 
$r_query = mysqli_query($dbc,$sql);
    echo '<h1>State Results</h1><table align="center" cellspacing="0" cellpadding="5" width="100%"><tr>';
    echo '<th>Last Name</th>
	    <th>First Name</th>
	    <th align="left">Address</th>
	    <th>City</th>
	    <th>State</th>
	    <th>Zip</th>
	</tr>';
    
    $bg = '#eeeeee'; 
    while ($row = mysqli_fetch_array($r_query, MYSQLI_ASSOC)) {
	    $bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
	    echo '<tr bgcolor="' . $bg . '">';
	    echo '<td align="left">' . $row['lastname'] . '</td>
		<td align="left">' . $row['firstname'] . '</td>
		<td align="left">' . $row['address'] . '</td>
		<td align="left">' . $row['city'] . '</td>
		<td align="left">' . $row['state'] . '</td>
		<td align="left">' . $row['zip'] . '</td>
	    </tr>';
    } // End of WHILE loop. 
    echo '</table>';
}

?>
<br/>
<form action="" method="post">  
Search Last Name: <input type="text" name="term" /><br />
AND / OR <br/>
Search By State: 
                <select name="stateSearch">
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
 <br/><br/>           
<input type="submit" value="Submit" />  
</form>
<?php

include ('includes/footer.php');
?>
