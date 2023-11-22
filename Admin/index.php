<!DOCTYPE html>
<html>
<head>
	<title>ADMIN PAGE</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../public/css/adminstyles.css">
</head>
<body class="body">


	<div class="effect1">

		<div class="login">
			<h1>Login</h1>
			<p>Welcome admin</p>
		</div>
		<!-- form for admin login -->
		<?php 
			// create an error message if the user made an error when trying to login
			if (isset($_GET['error'])) {
				// code...
				if ($_GET['error']=="emptyfields") {
					// code...
					echo "<p class='err'>Fill in all fields</p>";
				}elseif ($_GET['error']== "pwderr") {
					echo "<p class='err'>Wrong password</p>";
				}elseif ($_GET['error']== "403") {
					echo "<p class='err'>Unauthorized</p>";
				}
			}

		?>
		<form action="../app/auth/adminlogin.php" method="post">
			<label for="username" class="label">Username</label>
			<input type="text" name="username"class="input-box">
			<br>
			<label for="password" class="label">Password</label>
			<input type="password" name="password" class="input-box">
			<br>
			<button name="login_submit" class="sendbtn" type="submit">Login</button>
		</form>
</div>
</body>
</html>