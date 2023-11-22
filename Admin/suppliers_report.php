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
    <title>Products</title>
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
        <a href="users_report.php" class="active">Users</a>
        <a href="product_report.php">Products</a>
        <a href="orders_report.php">Orders</a>
        <a href="categories_report.php">Categories</a>
        <a href="feedback_report.php">Feedback</a>
        <a href="admin_profile.php">Admin Profile</a>
      </div>
    </div>

	<?php
	include('../helpers/DbHelpers.php');
  // fetch data of all suppliers
	$value = $db_helpers->getUsers('supplier');
	?>

<div class="container">
  <div class="table">
    <div class="supplierTable">
      <table>
        <tr>
          <div class="clearfix">
            <div class="img2" style="padding: 2px; margin-right: 20px; height: 50px;">
              <a href="addUser.php"><button type="" class="addUser" name="add_user" style="width: 150px;">+ &nbsp; Add Supplier</button></a>
              <p></p>
            </div>
              <p style="display: inline-block; margin: 0px; font-size: xxx-large; margin-left: 10px; padding-bottom: 10px; padding-top: 10px;">Suppliers</p> 
          </div>
          
        </tr>

        <tr>
            <th>#</th>
            <th>Company name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>
              <label class="dropdown">
                <div class="dd-button">Account Type </div><div class="triangle"></div>
                <input type="checkbox" class="dd-input" id="test">
                <ul class="dd-menu">
                  <li> <a href="customers_report.php">Customer</a> </li>
                  <li> <a href="suppliers_report.php">Supplier</a> </li>
                  <hr>
                  <li> <a href="users_report.php">All</a> </li>
                </ul>
              </label>
            </th>
            <th>Date Created</th> 
            <th>
              <label class="dropdown">
                <div class="dd-button">status </div><div class="triangle"></div>
                <input type="checkbox" class="dd-input" id="test">
                <ul class="dd-menu">
                  <li> <a href="online_users.php">Online Users</a> </li>
                  <li> <a href="offline_users.php">Offline Users</a> </li>
                </ul>
              </label>
            </th>  
            <th>Action</th>
        </tr>
        <?php 
          // create a while loop to fetch all the array values and display in a table
          while($detail = mysqli_fetch_assoc($value)) :
        ?>
        <tr>
          <td><?= $detail['id']; ?></td>
          <td><?= $detail['cname']; ?></td>
          <td><?= $detail['email']; ?></td>
          <td><?= $detail['phoneno']; ?></td>
          <td><?= $detail['address']; ?></td>
          <td><?= $detail['account']; ?></td>
          <td><?= $detail['date_created']; ?></td>       
          <td>
            <?php
              // check whether the specific user is online/offline and show the respective image
              if ($detail['status'] == "online") {?>
                <img src="../public/images/online1.png" alt="" style="height: 20px; width: 20px; margin:auto;">
            <?php  
              }else{?>
                <img src="../public/images/offline.png" alt="" style="height: 20px; width: 20px;margin:auto;">
            <?php  
              }
            ?>
          </td>
          <td>
            <form action="AdminClass.php" method="post">
              <input type="hidden" name="id" value="<?= $detail['id'] ?>"/>
              <input type="hidden" name="table" value="users" />
              <input type="hidden" name="redirect_to" value="users_report.php" />
              <button type="submit" name="deleteSubmit" class="btn">Delete</button>
            </form>
          </td>
        </tr>
        <?php endwhile; ?>
      </table>
    </div>
  </div>
</div>

</body>
</html>
