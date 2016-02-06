<!doctype html>
<html lang=en>
<head>
<title>View Event Details</title>
<meta charset=utf-8>

<link rel="stylesheet" type="text/css" href="useradmin22.css">
<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<style type="text/css">
	body {
		background: url("3.jpg") center fixed;
	}
</style></head>

<body><a href="index1.html" class="top"><img src="download1.jpg" width="40" height="40" class="logo">
		<p class="logotext">Event Management</p></a>
<div id="container">

<div id="content"><!-- Start of the content of the table of users page. -->
<h2 class ="page">User Details</h2>


<?php
// This script retrieves all the records from the users table.
require('connect-mysql.php'); // Connect to the database.
// Make the query: 

$q = "SELECT faculty_ID AS faculty_ID,firstname AS firstname ,lastname AS lastname, workexperience AS workexperience  
FROM userdetails";

$result = @mysqli_query ($dbcon, $q); // Run the query.

if ($result) { // If it ran OK, display the records

					// Table header. 
	echo '<table class="table">
				<tr class="heading">
				<td class="col head"><b>faculty_ID</b></td>
				<td class="col head"><b>Firstname</b></td>
				<td class="col head"><b>Lastname</b></td>
				<td class="col head"><b>Workexperience</b></td>
                                <td class="col head"><b>Delete</b></td>
				
				</tr>';						// Fetch and print all the records: 
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	echo '<tr class="heading2">                                                           
				<td class="col">'.  $row['faculty_ID'] . '</td>
				<td class="col">'.  $row['firstname'] . '</td>
				<td class="col">' . $row['lastname'] . '</td>
				<td class="col">'.  $row['workexperience'] . '</td>						
				
                <td class="col"><a href="delete3.php?id=' . $row['faculty_ID'] . '">Delete</a></td></tr>'; }
				echo '</table>'; // Close the table so that it is ready for displaying.
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

</div>
</body>
</html>