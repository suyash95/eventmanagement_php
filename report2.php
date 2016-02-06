<html>
<head>
<title>Report Page</title>
<style>
body {
		background-image: url("1.jpg");
		background-repeat: no-repeat;
		}

.mar-left {
	margin-left: 600px
}



</style>
</head>
<body><a href="index.php" class="top"><img src="download1.jpg" width="40" height="40" class="logo">
		<p class="logotext">Event Management</p></a>
<br>
<h2><center><u>Events based on dates</u></center></h2>
<br>
<h3 class="mar-left">Enter Two Dates:-</h3>
<br>
<form action = "eventrep.php" method = "POST" class="mar-left">
FROM <input type = "date" name= "fdate" required>
<br><br>
TO <input type = "date" name= "tdate" required>
<br><br>
<input type = "submit" name= "submit">
</form>



</body>
</html>