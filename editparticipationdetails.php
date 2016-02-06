<!doctype html>
<html lang=en>
<head>
<title>Edit participation Details</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes.css">

</head>
<body>
	<body>
	<a href="index1.html" class="top"><img src="download1.jpg" width="40" height="40" class="logo">
		<p class="logotext">Admin Page</p></a>
<div id="container">

	
<div id="content"><!--Start of the edit page content-->
<h2>Edit Participation Details</h2>

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
       if (empty($_POST['reg_id'])) {
		$errors[] = 'You forgot to enter type.';
		} else {
		$reg_id = mysqli_real_escape_string($dbcon, trim($_POST['reg_id']));
		}


		
		// Look for the descriptions
		if (empty($_POST['firstname'])) {
		$errors[] = 'You forgot to enter type.';
		} else {
		$firstname = mysqli_real_escape_string($dbcon, trim($_POST['firstname']));
		}


		// Look for the descriptions
		if (empty($_POST['lastname'])) {
		$errors[] = 'You forgot to enter the type2';
		} else {
		$lastname = mysqli_real_escape_string($dbcon, trim($_POST['lastname']));
		}


       if (empty($_POST['email_id'])) {
		$errors[] = 'You forgot to enter email';
		} else {
		$email_id = mysqli_real_escape_string($dbcon, trim($_POST['email_id']));
		}
		
		if (empty($_POST['USNno'])) {
		$errors[] = 'You forgot to enter the USN';
		} else {
		$USNno = mysqli_real_escape_string($dbcon, trim($_POST['USNno']));

		if (empty($_POST['conatct_no'])) {
		$errors[] = 'You forgot to enter the conatct';
		} else {
		$conatct_no= mysqli_real_escape_string($dbcon, trim($_POST['conatct_no']));
		}
		}

		


		if (empty($errors)) 
		{ // If everything is OK, make the update query 
		// Check that the email is not already in the users table
		$q = "UPDATE participants SET reg_id = '$reg_id' firstname='$firstname' ,
		lastname = '$lastname',email_id='$email_id',USNno='$USNno' ,conatct_no='$conatct_no' WHERE did=$id";
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


$q = "SELECT reg_id,firstname,lastname,email_id,USNno,conatct_no FROM participants WHERE did=$id";
$result = @mysqli_query ($dbcon, $q);
if (mysqli_num_rows($result) == 1) 
{   // Valid user ID, display the form.
	// Get the user's information
	$row = mysqli_fetch_array ($result, MYSQLI_NUM);
	// Create the form
	echo '<form action="editparticipationdetails.php" method="post">
	<br><p><label class="label" for="reg_id">Reg id:</label>
	<input class="fl-left" type="text" name="reg_id" size="30" maxlength="50" 
	value="' . $row[0] . '"></p>
	
	<br><p><label class="label" for="firstname">First Name:</label>
	<input class="fl-left" type="text" name="firstname" size="30" maxlength="50" 
	value="' . $row[1] . '"></p>
	<br><p><label class="label" for="lastname">Last Name:</label>
	<input class="fl-left" type="text" name="lastname" size="30" maxlength="50" 
	value="' . $row[2] . '"></p>
	<br><p><label class="label" for="email_id">Email:</label>
	<input class="fl-left" type="text" name="email_id" size="30" maxlength="50" 
	value="' . $row[3] . '"></p>

	<br><p><label class="label" for="USNno">USN:</label>
	<input class="fl-left" type="text" name="USNno" size="30" maxlength="50" 
	value="' . $row[4] . '"></p>
	<br><p><label class="label" for="conatct_no">Contact:</label>
	<input class="fl-left" type="text" name="conatct_no	" size="30" maxlength="50" 
	value="' . $row[5] . '"></p>
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