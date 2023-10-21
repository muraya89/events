<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./public/css/styles.css">
    <title id="title"></title>
</head>
<body class="body">
   
<div class="nav" id="nav">
	<input type="checkbox" id="nav-check">
	<div class="nav-header">
		<div class="nav-title" id="nav-title">
		</div>
		<div class="nav-links">
			<!-- search bar -->
			<!-- <div class="search">
					<form action="">
						<input type="text" placeholder="Search...">
					<div class="searchbtn">
						<button type="submit" name="Submit">Submit</button>
					</div>
					</form>
			</div> -->
			<div>
				<img class="rounded-circle" src="./public/images/lary-avatar.svg" alt="avatar">
			</div>
			<div class="dropdown">
				<input type="checkbox" class="dd-input" id="test" hidden>
				<label class="dropdown" for="test">
					<button onclick="openNav()" class="button">
						<div class="triangle"></div>
					</button>
				</label>
				<div class="dd-content" id="dd-content">
					<div class="container">
						<h2 class="user_name" id="user_name"><?= isset($_SESSION['name']) ? $_SESSION['name'] : 'not logged in'?></h2>
						<button id="navBtn" onclick="closeNav()">x</button>
					</div>
					<hr>			
					<a href="./leaveApplication.php" class="user_name logout" style="margin: 10%; margin-left: 5%;"> leave application</a>			
					<a href="./leaveApphis.php" class="user_name logout" style="margin: 10%; margin-left: 5%;"> Leave History</a>			
					<a href="./leaveStatus.php" class="user_name logout" style="margin: 10%; margin-left: 5%;">
						<?= $_SESSION['role'] === 'Lecturer' ? '' : 'leave reviews'; ?>
						
					</a>			
					<a href="./profile.php" class="user_name logout" style="margin: 10%; margin-left: 5%;"> profile</a>			
					<form method="post" action="./auth/Logout.php">
						<button type="submit" name="logout" class="logout">Logout</button>
					</form>
				</div>
			</div>
		</div>
	</div>			
</div>
