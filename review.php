<!doctype html>
<html lang=en>
<head>
<title>View participation Details</title>
<meta charset=utf-8><link rel="stylesheet" type="text/css" href="new.css">
<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<style type="text/css">
	body {
		background: url("3.jpg") center fixed;
	}
</style>

</head>

<body><a href="index.php" class="top"><img src="download1.jpg" width="40" height="40" class="logo">
		<p class="logotext">Event Management</p></a>
<div id="container">

<div id="content"><!-- Start of the content of the table of users page. -->
<h2 class = "page">participation details</h2>


<?php
// This script retrieves all the records from the users table.
require('connect-mysql.php'); // Connect to the database.
// Make the query: 

$q = "SELECT firstname AS firstname ,lastname AS lastname, email_id AS email_id, USNno AS USNno,
conatct_no as conatct_no ,did  FROM participants";

$result = @mysqli_query ($dbcon, $q); // Run the query.

if ($result) { // If it ran OK, display the records

					// Table header. 
		
echo '<table class="table">
				<tr class="heading">
				<td class="col head"><b>First Name</b></td>
				<td class="col head"><b>Last Name</b></td>
				<td class="col head"><b>Email id</b></td>
				<td class="col head"><b>USN NO</b></td>
				<td class="col head"><b>Contact No</b></td>
				
				</tr>';					// Fetch and print all the records: 
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	echo '<tr class="heading2">
				<td class="col">' . $row['firstname'] . '</td>
				<td class="col">'.  $row['lastname'] . '</td>
				<td class="col">'.  $row['email_id'] . '</td>
				<td class="col">' . $row['USNno'] . '</td>
				<td class="col">'.  $row['conatct_no'] . '</td>
				</tr>'; } // Close the table so that it is ready for displaying.
				mysqli_free_result ($result); // Free up the resources.
			   } 

else { // If it did not run OK.
		// Error message:
		echo '<p class="error">The current users could not be retrieved. We apologize 
		for any inconvenience.</p>';
		// Debug message:
		echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
     } // End of if ($result)

mysqli_close($dbcon); // Close the database connection.
?>

</div><!-- End of the user’s table page content -->


<p>
<p align ="right">
<button onclick="window.print()">Print</button>
</p>
</div>
</body>
</html>