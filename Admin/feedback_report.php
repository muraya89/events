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
    <title>Feedback</title>
    <link rel="stylesheet" type="text/css" href="./adminstyles.css">
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
        <a href="feedback_report.php" class="active">Feedback</a>
        <a href="admin_profile.php">Admin Profile</a>
      </div>
    </div>
    <?php
      include('../helpers/DbHelpers.php');
      // using the the contact value call the function from the db_helpers file to fetch all the values from the contact table
      $contact = $db_helpers->getAll('contact');

    ?>
	</div>
</div>


<div class="container">
  <div class="table">
    <div class="supplierTable">
      <table>
        <tr>
          <th>#</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Feedback</th>
        </tr>
        <?php       
        // create a while loop to fetch all the array values and display in a table
        while($detail = mysqli_fetch_assoc($contact)) :?>
        <tr>
          <td><?= $detail['id']; ?></td>
          <td><?= $detail['fname']; ?></td>
          <td><?= $detail['lname']; ?></td>
          <td><?= $detail['email']; ?></td>
          <td><?= $detail['input']; ?></td>
        </tr>
        <?php endwhile; ?>
      </table>
    </div>
  </div>
</div>


</body>
</html>