<!doctype html>
<html lang=en>
<head>
<title>REGISTRATION FORM</title>
<meta charset=utf-8><!--important prerequisite for escaping problem characters-->
<link rel="stylesheet" type="text/css" href="participate.css">
</head>
<body><a href="index.php" class="top"><img src="download1.jpg" width="40" height="40" class="logo">
		<p class="logotext">Event Management</p></a>

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
		

		// Check for age
		if (empty($_POST['firstname'])) {
		$errors[] = 'You forgot to enter your name.';
		} else {
		$firstname = mysqli_real_escape_string($dbcon, trim($_POST['firstname']));
		}

		// Check for sex
		if (empty($_POST['lastname'])) {
		$errors[] = 'You forgot to enter your lastname.';
		} else {
		$lastname= mysqli_real_escape_string($dbcon, trim($_POST['lastname']));
		}

		// Check for an address
		if (empty($_POST['email_id'])) {
		$errors[] = 'You forgot to enter email.';
		} else {
		$email_id = mysqli_real_escape_string($dbcon, trim($_POST['email_id']));
		}


		// Check for phone no.
		if (empty($_POST['USNno'])) {
		$errors[] = 'You forgot to enter your usnno.';
		} else {
		$USNno = mysqli_real_escape_string($dbcon, trim($_POST['USNno']));
		}

		if (empty($_POST['contact_no'])) {
		$errors[] = 'You forgot to enter your conatct number.';
		} else {
		$contact_no = mysqli_real_escape_string($dbcon, trim($_POST['contact_no']));
        }

		

		
		if (empty($errors)) { // If it runs
		// Register the user in the database...
		// Make the query:
		$q = "INSERT INTO participants (firstname, lastname, email_id, USNno ,conatct_no)
		VALUES ('$firstname', '$lastname', '$email_id', '$USNno' ,'$contact_no')";
		$result = @mysqli_query ($dbcon, $q); // Run the query.
		if ($result) { // If it runs
			echo '<script type="text/javascript">';
           echo 'alert("submitted successfully");
           window.location.href = "index.php"';
           echo '</script>';
		//header ("location: index.php");
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

<form action="participation.php" method="post" class="form">




<p><label class="label" for="firstname">First Name:</label>
<input  type="text" name="firstname" size="30" maxlength="60" 
value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>" > </p>

<p><label class="label" for="lastname">Last Name:</label>
<input  type="text"  name="lastname" size="30" maxlength="60" 
value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>" > </p>

<p><label class="label" for="email_id">Email:</label>
<input  type="email" name="email_id" size="30" maxlength="60" 
value="<?php if (isset($_POST['email_id'])) echo $_POST['email_id']; ?>" > </p>

<p><label class="label" for="USNno">USN:</label>
<input  type="text" name="USNno" size="30" maxlength="60" 
value="<?php if (isset($_POST['USNno'])) echo $_POST['USNno']; ?>" > </p>


<p><label class="label" for="contact_no">Contact:</label>
<input  type="text"  pattern="[789][0-9]{9}" name="contact_no" size="30" maxlength="60" 
value="<?php if (isset($_POST['contact_no'])) echo $_POST['contact_no']; ?>" > </p>


<p><input id="submit" type="submit" name="submit" value="submit"></p>
</form>

</p>
</div>
</div>
</body>
</html>