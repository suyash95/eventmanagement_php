<!doctype html>
<html lang=en>
<head>
<title>Edit Venue Details</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes.css">

</head>

<body>
	<body>
	<a href="venueadmin.php" class="top"><img src="download1.jpg" width="40" height="40" class="logo">
		<p class="logotext">Admin Page</p></a>
<div id="container">

	
<div id="content"><!--Start of the edit page content-->
<h2>Edit Venue Details</h2>

<?php
		// After clicking the Edit link in the found_record.php page, the editing interface appears
		// The code looks for a valid user ID, either through GET or POST #1
		if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
		$id = $_GET['id'];
		} 
		elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission
		$id = $_POST['id'];
		} 
		else { // If no valid ID, stop the script
		echo '<p class="error">This page has been accessed in error</p>';
		exit();
		}

require ('connect-mysql.php');
// Has the form been submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
		$errors = array();


		// Look for the dental codes
        if (empty($_POST['venueid'])) {
		$errors[] = 'You forgot to enter id';
		} else {
		$venueid = mysqli_real_escape_string($dbcon, trim($_POST['venueid']));
		}


		
		// Look for the descriptions
		if (empty($_POST['name'])) {
		$errors[] = 'You forgot to enter type.';
		} else {
		$name = mysqli_real_escape_string($dbcon, trim($_POST['name']));
		}


		// Look for the descriptions
		if (empty($_POST['regdate'])) {
		$errors[] = 'You forgot to enter the type2';
		} else {
		$regdate = mysqli_real_escape_string($dbcon, trim($_POST['regdate']));
		}


       // Look for the descriptions
		if (empty($_POST['address'])) {
		$errors[] = 'You forgot to enter the title';
		} else {
		$address = mysqli_real_escape_string($dbcon, trim($_POST['address']));
		}
		


		if (empty($errors)) 
		{ // If everything is OK, make the update query 
		// Check that the email is not already in the users table
		$q = "UPDATE venue SET venueid='$venueid', name='$name' , regdate='$regdate' ,address='$address' 
		WHERE did=$id LIMIT 1";
		$result = @mysqli_query ($dbcon, $q);
		if (mysqli_affected_rows($dbcon) == 1) { // If it ran OK
		// Echo a message if the edit was satisfactory
		echo '<h3>The user has been edited.</h3>';
		} else { // Echo a message if the query failed
		echo '<p class="error">The user could not be edited due to a system error. 
		We apologize for any inconvenience.</p>'; // Error message.
		echo '<p>' . mysqli_error($dbcon) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		} // End of if ($result)
		mysqli_close($dbcon); // Close the database connection.
		// Include the footer and quit the script:
		
		exit();
		} else   { // Display the errors.
		echo '<p class="error">The following error(s) occurred:<br />';
        
		foreach ($errors as $msg) { // Extract the errors from the array and echo them
		echo " - $msg<br>\n";
	    }
		echo '</p><p>Please try again.</p>';
		} // End of if (empty($errors))section
}        // End of the conditionals
         // Select the record 


$q = "SELECT venueid,name,regdate,address FROM venue WHERE did=$id";
$result = @mysqli_query ($dbcon, $q);
if (mysqli_num_rows($result) == 1) 
{   // Valid user ID, display the form.
	// Get the user's information
	$row = mysqli_fetch_array ($result, MYSQLI_NUM);
	// Create the form
	echo '<form action="editvenuedetails.php" method="post">
	<p><label class="label" for="venueid">Venue id:</label>
	<input class="fl-left" id="venueid" type="text" name="venueid" size="30" maxlength="30" 
	value="' . $row[0] . '"></p>
	
	<br><p><label class="label" for="name">Name:</label>
	<input class="fl-left" type="text" name="name" size="30" maxlength="50" 
	value="' . $row[1] . '"></p>
	<br><p><label class="label" for="regdate">Reg Date:</label>
	<input class="fl-left" type="date" name="regdate" size="30" maxlength="50" 
	value="' . $row[2] . '"></p>
	<br><p><label class="label" for="address">Address:</label>
	<input class="fl-left" type="text" name="address" size="30" maxlength="50" 
	value="' . $row[3] . '"></p>
	<br><p><input id="submit" type="submit" name="submit" value="Edit"></p>
	<br><input type="hidden" name="id" value="' . $id . '" /> 
	</form>';
} 
else { // The record could not be validated
	  echo '<p class="error">This page has been accessed in error</p>';
	 }
mysqli_close($dbcon);

?>
</div>
</div>
</body>
</html>