<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./public/css/styles.css">
	<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title id="title"></title>
</head>
<body class="body">
   
<div class="nav" id="nav">
	<input type="checkbox" id="nav-check">
	<div class="nav-header">
		<div class="nav-title" id="nav-title">
		</div>
		<div class="nav-links">
			<a href="./events.php" class="" style="margin-left: 0%; width: 100px; text-align:center; color: white; font-size: 18px;"> Events</a>	
			<a href="./myTickets.php" class="" style="margin-left: 0%; width: 100px; text-align:center; color: white; font-size: 18px;"> My Tickets</a>	
			<a href="./profile.php" class="" style="margin-left: 0%; width: 100px; text-align:center; color: white; font-size: 18px;"> Profile</a>		
			<form method="post" action="./auth/Logout.php">
				<button type="submit" name="logout" class="" style="margin-right: 20px; cursor: pointer; background-color: black; border:none; color: white; font-size: 18px;">Logout</button>
			</form>
			<div>
				<img class="rounded-circle" src="../public/images/lary-avatar.svg" alt="avatar">
			</div>	
			<!-- <div class="dropdown">
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
					<a href="./events.php" class="user_name logout" style="margin: 10%; margin-left: 5%;"> Events</a>	
					<a href="./myTickets.php" class="user_name logout" style="margin: 10%; margin-left: 5%;"> My Tickets</a>	
					<a href="./profile.php" class="user_name logout" style="margin: 10%; margin-left: 5%;"> profile</a>			
					<form method="post" action="./auth/Logout.php">
						<button type="submit" name="logout" class="logout">Logout</button>
					</form>
				</div>
			</div> -->
		</div>
	</div>			
</div>

<script>
	
    document.getElementsByTagName.innerHTML = window.confirmationStyle();
    function confirmationStyle () {
        document.getElementById("nav-title").textContent = "Events Management";

    };
    function closeNav () {
        document.querySelector(".dd-content").style.display = "none";
    };

    function openNav () {
        document.querySelector("#dd-content").style.display = "block";
    };
    
    const myFun = (element) => {
      element.getElementsByClassName('expanded-row-content')[0].classList.toggle('hide-row');
    }

	function goBack(){
		window.history.back();
	}
    
</script>