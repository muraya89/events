<?php 
	session_start();

	if (!isset($_SESSION['id'])) {
		header('Location: ../admin/index.php?error=403');
	}

	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="./adminstyles.css">
</head>
<body style="margin: 0px;">

	<!-- navigation bar -->
	<div class="nav">
		<input type="checkbox" id="nav-check">
		<div class="nav-header">
			<div class="nav-title" style="color: #fff;">
				Slaughterhouse
			</div>
			<br>
		</div>
		<div class="nav-links">
			<a href="admin.php" class="active">Dashboard</a>
			<a href="users_report.php">Users</a>
			<a href="product_report.php">Products</a>
			<a href="orders_report.php">Orders</a>
			<a href="categories_report.php">Categories</a>
			<a href="feedback_report.php">Feedback</a>
			<a href="admin_profile.php">Admin Profile</a>
		</div>
	</div>
<!-- </body>
</html> -->