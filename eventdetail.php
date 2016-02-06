<!doctype html>
<html lang=en>
<head>
<title>ENTER EVENT DETAILS</title>
<meta charset=utf-8><!--important prerequisite for escaping problem characters-->
<link rel="stylesheet" type="text/css" href="participate.css">
<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
<body>

	<a href="index.php" class="top"><img src="download1.jpg" width="40" height="40" class="logo">
		<p class="logotext"> Event Management</p></a>

<div id="container">

<div id="content"><!-- Registration handler content starts here -->

<?php
// The link to the database is moved to the top of the PHP code.
require ('connect-mysql.php'); // Connect to the db.
// This query INSERTs a record in the users table.
// Has the form been submitted?

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
		$errors = array(); // Initialize an error array.
		// Check for a first name:
		if (empty($_POST['event_id'])) {
		$errors[] = 'You forgot to enter your id.';
		} else {
		$event_id = mysqli_real_escape_string($dbcon, trim($_POST['event_id']));
		}

		

		// Check for age
		if (empty($_POST['title'])) {
		$errors[] = 'You forgot to enter title.';
		} else {
		$title = mysqli_real_escape_string($dbcon, trim($_POST['title']));
		}

		// Check for sex
		if (empty($_POST['summary'])) {
		$errors[] = 'You forgot to enter Summary.';
		} else {
		$summary= mysqli_real_escape_string($dbcon, trim($_POST['summary']));
		}

		// Check for an address
		if (empty($_POST['stype1'])) {
		$errors[] = 'You forgot to enter type.';
		} else {
		$stype1 = mysqli_real_escape_string($dbcon, trim($_POST['stype1']));
		}


		// Check for phone no.
		if (empty($_POST['stype2'])) {
		$errors[] = 'You forgot to enter your type.';
		} else {
		$stype2 = mysqli_real_escape_string($dbcon, trim($_POST['stype2']));
		}

                if (empty($_POST['reg_date'])) {
		$errors[] = 'You forgot to enter date.';
		} else {
		$reg_date = mysqli_real_escape_string($dbcon, trim($_POST['reg_date']));
		}

		

		
		if (empty($errors)) { // If it runs
		// Register the user in the database...
		// Make the query:
		$q = "INSERT INTO eventdetails (event_id, title, summary, type, type2,reg_date)
		VALUES ('$event_id', '$title', '$summary', '$stype1', '$stype2' ,'$reg_date')";
		$result = @mysqli_query ($dbcon, $q); // Run the query.
		if ($result) { // If it runs
		header ("location: venuedetail.php");
		exit();
		} else { // If it did not run
		// Message:
		echo '<h2>System Error</h2>
		<p class="error">You could not be registered due to a system error. We apologize 
		for any inconvenience.</p>';
		// Debugging message:
		echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
		} // End of if ($result)
		mysqli_close($dbcon); // Close the database connection.
		// Include the footer and quit the script:
		
		exit();
		} else { // Report the errors.
			echo '<h2>Error!</h2>
		<p class="error">The following error(s) occurred:<br>';
		foreach ($errors as $msg) { // Extract the errors from the array and echo them
		echo " - $msg<br>\n";
		}
		echo '</p><h3>Please try again.</h3><p><br></p>';
		}// End of if (empty($errors))
} // End of the main Submit conditional.
?>

<h2 class="page">Insert Event Information</h2>

<form action="eventdetail.php" method="post" class ="form">

<p><label class="label" for="event_id">Event ID:</label> 
<input  type="text" name="event_id" size="30" maxlength="30" 
value="<?php if (isset($_POST['event_id'])) echo $_POST['event_id']; ?>"></p>

<p><label class="label" for="title">Title:</label>
<input  type="text" name="title" size="30" maxlength="60" 
value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>" > </p>

<p><label class="label" for="summary">Summary:</label>
<input  type="text" name="summary" size="30" maxlength="60" 
value="<?php if (isset($_POST['summary'])) echo $_POST['summary']; ?>" > </p>




<p><label class="label" for="stype1">Select Type1:</label><select name="stype1" value="<?php if (isset($_POST['stype1'])) echo $_POST['stype1']; ?>">
  <option size="30" maxlength="60">techincal details</option>
  <option>workshop</option>
  
  
</select></p>

<p><label class="label" for="stype2">Select Type2:</label><select name="stype2"  value="<?php if (isset($_POST['stype2'])) echo $_POST['stype2']; ?>">
  <option size="30" maxlength="60">conducted</option>
  <option>attended</option>
  
  
</select></p>

<p><label for="reg_date" class="label">Date:</label>
	<input type="date" size="30" maxlength="60" name="reg_date" value="<?php if (isset($_POST['reg_date'])) echo $_POST['ingres_result_seek(result, position)date']; ?>"> </p>



<p><input id="submit" type="submit" name="submit" value="next"></p>
</form>

</p>
</div>
</div>
</body>
</html>