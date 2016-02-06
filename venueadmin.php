<!doctype html>
<html lang=en>
<head>
<title>View Venue Details</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="venueadmin22.css">
<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<style type="text/css">
	body {
		background: url("3.jpg") center fixed;
	}
</style>

</head>

<body>
	<a href="index1.html" class="top"><img src="download1.jpg" width="40" height="40" class="logo">
		<p class="logotext">Event Management</p></a>
<div id="container">

<div id="content"><!-- Start of the content of the table of users page. -->
<h2 class= "page">Venue Details</h2>


<?php
// This script retrieves all the records from the users table.
require('connect-mysql.php'); // Connect to the database.
// Make the query: 

$q = "SELECT venueid AS venueid,name AS name ,regdate AS regdate, address AS address ,did  FROM venue";

$result = @mysqli_query ($dbcon, $q); // Run the query.

if ($result) { // If it ran OK, display the records

					// Table header. 
				echo '<table class="table">
				<tr class="heading">
				<td class="col head"><b>Venueid</b></td>
				<td class="col head"><b>Name</b></td>
				<td class="col head"><b>Regdate</b></td>
				<td class="col head"><b>Address</b></td>
				
                                <td class="col head"><b>Edit</b></td>
                                <td class="col head"><b>Delete</b></td>
				
				</tr>';						// Fetch and print all the record
				// Fetch and print all the records: 
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				echo '<tr class="heading2">                                                               
				<td class="col">'.  $row['venueid'] . '</td>
				<td class="col">'.  $row['name'] . '</td>
				<td class="col">' . $row['regdate'] . '</td>
				<td class="col">'.  $row['address'] . '</td>						
				<td class="col"><a href="editvenuedetails.php?id=' . $row['did'] . '">Edit</a></td>
                <td class="col"><a href="delete2.php?id=' . $row['did'] . '">Delete</a></td></tr>'; }
				echo '</table>';
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