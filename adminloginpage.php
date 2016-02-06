<div class="outer">
<div class="wrap"><h2 class="page">Admin Login</h2>
<form action="adminlogin.php" method="post" class="form">
<p><label class="label" for="id">ID:</label>
<input id="email" type="text" name="id" size="30" maxlength="60" 
value="<?php if (isset($_POST['id'])) echo $_POST['id']; ?>" > </p>
<br>
<p><label class="label" for="password">password:</label>
<input id="psword" type="password" name="password" size="12" maxlength="12" 
value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" > 
<span></span></p>
<p>&nbsp;</p><p><input id="submit" type="submit" name="submit" value="Login"></p>
</form><br>	