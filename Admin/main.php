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
		<title>Landpage</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../public/css/adminstyles.css">

	</head>
	<body style="display: grid; grid-auto-columns: auto auto">
	<div class="nav">
			<input type="checkbox" id="nav-check">
			<div class="nav-header">
				<div class="nav-title">
					<a href=""><b><strong> The Meat Hook</strong></b></a>
				</div>
			</div>
			<div class="nav-btn">
				<label for="nav-check">
					<span></span>
					<span></span>
					<span></span>
				</label>
			</div>