<!doctype html>
<html lang=en>
<head>
<title>Edit Event Details</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes.css">

</head>
	<body>
	<a href="eventadmin.php" class="top"><img src="download1.jpg" width="40" height="40" class="logo">
		<p class="logotext">Admin Page</p></a>

<body>
<div id="container">

	
<div id="content"><!--Start of the edit page content-->
<h2>Edit Event Details</h2>

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
        if (empty($_POST['event_id'])) {
		$errors[] = 'You forgot to enter id';
		} else {
		$event_id = mysqli_real_escape_string($dbcon, trim($_POST['event_id']));
		}


		
		// Look for the descriptions
		if (empty($_POST['type'])) {
		$errors[] = 'You forgot to enter type.';
		} else {
		$type = mysqli_real_escape_string($dbcon, trim($_POST['type']));
		}


		// Look for the descriptions
		if (empty($_POST['type2'])) {
		$errors[] = 'You forgot to enter the type2';
		} else {
		$type2 = mysqli_real_escape_string($dbcon, trim($_POST['type2']));
		}


       // Look for the descriptions
		if (empty($_POST['title'])) {
		$errors[] = 'You forgot to enter the title';
		} else {
		$title = mysqli_real_escape_string($dbcon, trim($_POST['title']));
		}


        // Look for the descriptions
		if (empty($_POST['summary'])) {
		$errors[] = 'You forgot to enter the summary.';
		} else {
		$summary = mysqli_real_escape_string($dbcon, trim($_POST['summary']));
		}



		if (empty($errors)) 
		{ // If everything is OK, make the update query 
		// Check that the email is not already in the users table
		$q = "UPDATE eventdetails SET event_id='$event_id', type='$type' , type2='$type2' ,
		title='$title' , summary='$summary' WHERE did=$id LIMIT 1";
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


$q = "SELECT event_id,type,type2,title,summary FROM eventdetails WHERE did=$id";
$result = @mysqli_query ($dbcon, $q);
if (mysqli_num_rows($result) == 1) 
{   // Valid user ID, display the form.
	// Get the user's information
	$row = mysqli_fetch_array ($result, MYSQLI_NUM);
	// Create the form
	echo '<form action="editeventdetails.php" method="post">
	<p><label class="label" for="event_id">Event id:</label>
	<input class="fl-left" id="event_id" type="text" name="event_id" size="30" maxlength="30" 
	value="' . $row[0] . '"></p>
	<br><p><label class="label" for="type">Type:</label>
	<input class="fl-left" type="text" name="type" size="30" maxlength="50" 
	value="' . $row[1] . '"></p>

	
	
	<br><p><label class="label" for="type2">Type2:</label>
	<input class="fl-left" type="text" name="type2" size="30" maxlength="50" 
	value="' . $row[2] . '"></p>
	<br><p><label class="label" for="title">Title:</label>
	<input class="fl-left" type="text" name="title" size="30" maxlength="50" 
	value="' . $row[3] . '"></p>
	<br><p><label class="label" for="summary">Summary:</label>
	<input class="fl-left" type="text" name="summary" size="30" maxlength="50" 
	value="' . $row[4] . '"></p>
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