<!doctype html>
<html lang=en>
<head>
<title>View dental codes</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="pnext.css">
<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<style type="text/css">
	body {
		background: url("3.jpg") center fixed;
	}
</style>
</head>

<body>
<a href="index.php" class="top"><img src="download.png" width="40" height="40" class="logo">
		<p class="logotext"> Conference Management</p></a>
<div id="container">

<div id="content"><!-- Start of the content of the table of users page. -->
<h2 class="page">Conference Information</h2>


<?php
// This script retrieves all the records from the users table.
require('connect-mysql.php'); // Connect to the database.
// Make the query: 

//$q = "SELECT oeventid,title,type,summary FROM eventconf";
$q = "SELECT eventconf.oeventid,eventconf.title,eventconf.type,eventconf.summary,venue.name,venue.dates,venue.time,venue.address 
FROM eventconf 
INNER JOIN venue 
ON eventconf.oeventid=venue.oeventid";


$result = @mysqli_query ($dbcon, $q); // Run the query.

if ($result) { // If it ran OK, display the records

					// Table header. 
				echo '<table class="table">
				<tr class="heading">
				<td class="col head"><b>Title</b></td>
				<td class="col head"><b>Type</b></td>
				<td class="col head"><b>Summary</b></td>
				<td class="col head"><b>Venue Name</b></td>
				<td class="col head"><b>Date</b></td>
				<td class="col head"><b>Time</b></td>
				<td class="col head"><b>Address</b></td>
				<td class="col head"><b>More</b></td>
				</tr>';
				// Fetch and print all the records: 
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				echo '<tr class="heading2">
				<td class="col">' . $row['title'] . '</td>
				<td class="col">'.  $row['type'] . '</td>
				<td class="col">'.  $row['summary'] . '</td>
				<td class="col">' . $row['name'] . '</td>
				<td class="col">'.  $row['dates'] . '</td>
				<td class="col">'.  $row['time'] . '</td>
				<td class="col">'.  $row['address'] . '</td>

				<td class="col"><a href="upload.php">Enter</a></td>
                </tr>'; }
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
<p>

<center>
<a href = "index.php"><input type="submit" name="submit" value="Logout"></a>
</center></p>
</div>
</body>
</html>