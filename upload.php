<!doctype html>
<html lang=en>
<head>
<title>Register page</title>
<meta charset=utf-8><!--important prerequisite for escaping problem characters-->
<link rel="stylesheet" type="text/css" href="signup.css">
<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
<body>

	<a href="index.php" class="top"><img src="download.png" width="40" height="40" class="logo">
		<p class="logotext"> Conference Management</p></a>
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
// Check for Name:
if (empty($_POST['fname'])) {
$errors[] = 'You forgot to enter your Name.';
} else {
$fname = mysqli_real_escape_string($dbcon, trim($_POST['fname']));
}
// Check for topic
if (empty($_POST['topic'])) {
$errors[] = 'You forgot to enter topic.';
} else {
$topic = mysqli_real_escape_string($dbcon, trim($_POST['topic']));
}

// Check for Summary
if (empty($_POST['sum'])) {
$errors[] = 'You forgot to enter summary.';
} else {
$sum = mysqli_real_escape_string($dbcon, trim($_POST['sum']));
}
// Check for Your email address
if (empty($_POST['id'])) {
$errors[] = 'You forgot to enter your email address.';
} else {
$id = mysqli_real_escape_string($dbcon, trim($_POST['id']));
}
if (empty($_POST['file'])) {
$errors[] = 'You forgot to enter your file url.';
} else {
$file = mysqli_real_escape_string($dbcon, trim($_POST['file']));
}
/*// Check for an email address
if (empty($_POST['file'])) {
$errors[] = 'You forgot to enter your file.';
} else {
$file = mysqli_real_escape_string($dbcon, trim($_POST['file']));
}*/


if (empty($errors)) { // If it runs
// Register the user in the database...
// Make the query:
$q = "INSERT INTO paper (rid, name, topic, summary,file)
VALUES ('$id', '$fname', '$topic', '$sum','$file')";
$result = @mysqli_query ($dbcon, $q); // Run the query.
if ($result) { // If it runs
header ("location: pnext.php");
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
	echo '<h2 class="error">Error!</h2>
<p class="error">The following error(s) occurred:<br>';
foreach ($errors as $msg) { // Extract the errors from the array and echo them
echo "<p class='error'> - $msg<br></p>\n";
}
echo '</p><h3 class="error">Please try again.</h3><p><br></p>';
}// End of if (empty($errors))
} // End of the main Submit conditional.
?>
<div class="outer">
<div class="wrap">
<h2 class="title">Present Paper</h2>
<form action="upload.php" method="post" class="form" enctype="multipart/form-data">

<p><label class="label" for="fname">Participant Name:</label> 
<input id="fname" type="text" name="fname" size="30" maxlength="30" 
value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>"></p>

<p><label class="label" for="id">Registration ID:</label>
<input id="lname" type="text" name="id" size="30" maxlength="40" 
value="<?php if (isset($_POST['id'])) echo $_POST['id']; ?>"></p>

<p><label class="label" for="topic">Topic:</label>
<input id="lname" type="text" name="topic" size="30" maxlength="40" 
value="<?php if (isset($_POST['topic'])) echo $_POST['topic']; ?>"></p>

<p><label class="label" for="sum">Summary:</label>
<input id="lname" type="text" name="sum" size="30" maxlength="40" 
value="<?php if (isset($_POST['sum'])) echo $_POST['sum']; ?>"></p>

<p><label class="label" for="file">File:</label>
<input id="lname" type="text" name="file" size="30" maxlength="80" 
value="<?php if (isset($_POST['file'])) echo $_POST['file']; ?>"></p>

<!-- <input type="hidden" name="MAX_FILE_SIZE" value="20000000000">
<p><label class="label" for="file">file:</label>
<input id="lname" type="file" name="file" size="30" maxlength="40" 
value="<?php if (isset($_POST['file'])) echo $_POST['file']; ?>"></p> -->


<p><input id="submit" type="submit" name="submit" value="Submit"></p>
</form>
</div>
</div>
</p>
</div>
</div>
</body>
</html>