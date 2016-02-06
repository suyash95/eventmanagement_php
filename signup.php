<!doctype html>
<html lang=en>
<head>
<title>Register page</title>
<meta charset=utf-8><!--important prerequisite for escaping problem characters-->
<link rel="stylesheet" type="text/css" href="signup.css">
<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
<style type="text/css">
	body {
		background: url("login1.png") center fixed;
	}
</style>
<body>

	<a href="index.php" class="top"><img src="download1.jpg" width="40" height="40" class="logo">
		<p class="logotext"> Event Management</p></a>

<div id="container">

<div id="content"><!-- Registration handler content starts here -->
<p>
<?php
// The link to the database is moved to the top of the PHP code.
require ('connect-mysql.php'); // Connect to the db.
// This query INSERTs a record in the users table.
// Has the form been submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$errors = array(); // Initialize an error array.
// Check for a name:
if (empty($_POST['fname'])) {
$errors[] = 'You forgot to enter your Name.';
} else {
$fname = mysqli_real_escape_string($dbcon, trim($_POST['fname']));
}
// Check for phone number
if (empty($_POST['lname'])) {
$errors[] = 'You forgot to enter your phone number.';
} else {
$lname = mysqli_real_escape_string($dbcon, trim($_POST['lname']));
}
// Check for age
if (empty($_POST['id'])) {
$errors[] = 'You forgot to enter your email address.';
} else {
$id= mysqli_real_escape_string($dbcon, trim($_POST['id']));
}
// Check for an address
if (empty($_POST['worke'])) {
$errors[] = 'You forgot to enter your address.';
} else {
$worke = mysqli_real_escape_string($dbcon, trim($_POST['worke']));
}

// Check for a password and match it against the confirmed password
if (!empty($_POST['psword1'])) {
if ($_POST['psword1'] != $_POST['psword2']) {
$errors[] = 'Your two passwords did not match.';
} else {
$p = mysqli_real_escape_string($dbcon, trim($_POST['psword1']));
}
} else {
$errors[] = 'You forgot to enter your password.';
}
if (empty($errors)) { // If it runs
// Register the user in the database...
// Make the query:
$q = "INSERT INTO userdetails (ser,faculty_ID, firstname, lastname, workexperience, password, registration_date)
VALUES ('','$id', '$fname', '$lname','$worke', '$p', NOW() )";
$result = @mysqli_query ($dbcon, $q); // Run the query.
if ($result) { // If it runs
header ("location: index.php");
exit();
} else { // If it did not run
// Message:
echo '<h2>System Error</h2>
<p class="error">You could not be registered due to a system error. We apologize 
for any inconvenience.</p>';
// Debugging message:
echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
} // End of if ($result)
mysqli_close($dbcon); // Close the database connection.
// Include the footer and quit the script:
include ('footer.php');
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

<h2 class="page">Register Users</h2>
<form action="signup.php" method="post" class="form">
<p><label class="label" for="fname">firstname:</label> 
<input id="fname" type="text" pattern ="[a-z][a-z][29]" name="fname" size="30" maxlength="30" 
value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>"></p>
<p><label class="label" for="lname">lastname:</label>
<input id="lname" type="text" pattern="[a-z][a-z][29]" name="lname" size="30" maxlength="40" 
value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>"></p>
<p><label class="label" for="id">facultyid:</label>
<input id="lname" type="text" name="id" size="30" maxlength="40" 
value="<?php if (isset($_POST['id'])) echo $_POST['id']; ?>"></p>
<p><label class="label" for="worke">workexperience:</label>
<input id="lname" type="text" name="worke" size="30" maxlength="40" 
value="<?php if (isset($_POST['worke'])) echo $_POST['worke']; ?>"></p>

<p><label class="label" for="psword1">Password:</label>
<input id="psword1" type="password" name="psword1" size="12" maxlength="12"
value="<?php if (isset($_POST['psword1'])) echo $_POST['psword1']; ?>" ></p>
<p><label class="label" for="psword2">Confirm Password:</label>
<input id="psword2" type="password" name="psword2" size="12" maxlength="12" 
value="<?php if (isset($_POST['psword2'])) echo $_POST['psword2']; ?>" ></p>
<p><input id="submit" type="submit" name="submit" value="Register"></p>
</form>

</p>
</div>
</div>
</body>
</html>