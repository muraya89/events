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
    <title>Admin Profile</title>
    <link rel="stylesheet" type="text/css" href="./adminstyles.css">
	<style>
		img {
			width: 200px;
			height: 200px;
			border-radius: 50%;
		}
	</style>
  </head>
  <body class="body">

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
        <a href="admin.php">Dashboard</a>
        <a href="users_report.php">Users</a>
        <a href="product_report.php">Products</a>
        <a href="orders_report.php">Orders</a>
        <a href="categories_report.php">Categories</a>
        <a href="feedback_report.php">Feedback</a>
        <a href="admin_profile.php" class="active">Admin Profile</a>
      </div>
    </div>
<?php

include('../helpers/DbHelpers.php');
// insert function to call the specific profile of the logged in user using the session ID
$value = $db_helpers->showAdmin('admin', ['id' => $_SESSION['id']]);

?>
</div>

<div class="container">
	<div class="table1" >
		<div class="table2">
			<div class="table3">		
				<?php 
				// fetch the values within the specific array object
					$admin_details = mysqli_fetch_assoc($value);
				?>
				<img src="../public/images/admin.png" alt=""><br>
				<p><?=  $admin_details['username'];?></p><br>

			</div>

			<div class="table3" style="background-color: #fff; color: black; width: 100%">
				<p>Information</p>
				<hr>
				<label for="" class="label">ID: &nbsp;</label>
				<input class="profile" value="<?=  $admin_details['id'];?>"><br>
				<label for="" class="label">Date Created: &nbsp;</label>
				<input class="profile" value="<?=  $admin_details['date_created'];?>"><br>
				<label for="" class="label">Role:&nbsp;</label>
				<input class="profile" value="<?=  $admin_details['role'];?>"><br>
			
				<form method="post" action="logout.php">
					<input type="hidden" name="redirect" value="admin_profile.php">
					<button type="submit" name="logout" class="logout">Logout</button>
				</form>
			</div>
		</div>
	</div>
</div>



</body>
</html>