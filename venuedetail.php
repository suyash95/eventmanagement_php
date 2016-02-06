<!doctype html>
<html lang=en>
<head>
<title>ENTER VENUE DETAILS</title>
<meta charset=utf-8><!--important prerequisite for escaping problem characters-->


<link rel="stylesheet" type="text/css" href="participate.css">
</head>
<body>
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
		if (empty($_POST['venueid'])) {
		$errors[] = 'You forgot to enter id.';
		} else {
		$venueid= mysqli_real_escape_string($dbcon, trim($_POST['venueid']));
		}

		

		// Check for age
		if (empty($_POST['name'])) {
		$errors[] = 'You forgot to enter your title.';
		} else {
		$name = mysqli_real_escape_string($dbcon, trim($_POST['name']));
		}

		// Check for sex
		
		// Check for an address
		if (empty($_POST['ressdate'])) {
		$errors[] = 'You forgot to enter date.';
		} else {
		$ressdate = mysqli_real_escape_string($dbcon, trim($_POST['ressdate']));
		}


		// Check for phone no.
		if (empty($_POST['saddress'])) {
		$errors[] = 'You forgot to enter address.';
		} else {
		$saddress = mysqli_real_escape_string($dbcon, trim($_POST['saddress']));
		}

		

		
		if (empty($errors)) { // If it runs
		// Register the user in the database...
		// Make the query:
		$q = "INSERT INTO venue (venueid, name, regdate, address)
		VALUES ('$venueid', '$name', '$ressdate', '$saddress')";
		$result = @mysqli_query ($dbcon, $q); // Run the query.
		if ($result) { // If it runs
			echo '<script type="text/javascript">';
           echo 'alert("submitted successfully");
           window.location.href = "venuedetail.php"';
           echo '</script>';
		//header ("location: venuedetail.php");
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

 <h2 class ="page">venue Information</h2>

<form action="venuedetail.php" method="post" class="form">

<p><label class="label" for="venueid">Venue ID:</label> 
<input  type="text" name="venueid" size="30" maxlength="30" 
value="<?php if (isset($_POST['venueid'])) echo $_POST['venueid']; ?>"></p>

<p><label class="label" for="name">Name:</label>
<input  type="text" name="name" size="30" maxlength="60" 
value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" > </p>

<p><label class ="label" for="ressdate">Date:</label><input type="date" name="ressdate" value="<?php if (isset($_POST['ressdate'])) echo $_POST['ingres_result_seek(result, position)date']; ?>"  > </p>

<p><label class="label" for="saddress">Address:</label>
<input  type="text" name="saddress" size="30" maxlength="60" 
value="<?php if (isset($_POST['saddress'])) echo $_POST['saddress']; ?>" > </p>



<p><input id="submit" type="submit" name="submit" value="submit"></p>
</form>

</p><p>


<a href = "index.php" class="logout">Logout</a>
</p>
</div>
</div>
</body>
</html>