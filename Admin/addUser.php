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
    <title>Categories</title>
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



  <div class="box2">    
    <h1>Add User</h1>  
    <!-- create an error message if the user made an error trying to create an account -->
      <?php
        if(isset($_GET['error'])) {
          if($_GET['error']=="emptyfields"){
            echo '<p class = "err">Fill in all fields!</p>';
          }
          elseif($_GET['error']== "invalidemail") {
            echo '<p class = "err">Provide a valid email!</p>';  
          }
          elseif ($_GET['error'] == "invalidpassword") {
            // code...
            echo '<p class = "err">Enter password!</p>';
          }
          elseif ($_GET['error'] == "invalidPassword") {
            // code...
            echo '<p class = "err"> Password should be atleast 8 characters long and should include at least one number, one uppercase letter and one special character </p>';
          }
          elseif($_GET['error']== "passwordCheck") {
            echo '<p class = "err">Your passwords do not match!</p>';
          }elseif($_GET['error'] == "dberror") {
              // code...
          echo '<p class = "err">Unsuccessful Signup!</p>';
          } elseif ($_GET['error'] == "accountError") {
            echo '<p class = "err">Account type required!</p>';
          } elseif($_GET['signup']== "success") {
            echo '<p class = "err">Signup Successful!</p>';
          }
        }
      ?>
    <form method="POST" action="../app/auth/Register.php">
        <label for="cname">Company name/First name *</label><br>
        <input type="text" name="cname" class="input" >
        <br>
        <label for="email">Email *</label><br>
        <input type="text" name="email" class="input" >
        <br>
        <label for="phoneno">Phone Number *</label><br>
        <input type="text" name="phoneno" class="input" >
        <br>
        <label for="address">Address</label><br>
        <input type="text" name="address" class="input" >
        <br>
        <div class="radio">
            <div class="radio1">
                <input type="radio" value="supplier" name="accounttype">
                <label for="supplier" class="role">Supplier</label>
            </div>
            <div class="radio1">
                <input type="radio" value="customer" name="accounttype" >
                <label for="customer" class="role">Customer</label>
            </div>
        </div>
        <label for="password">Pasword *</label>
        <input type="password" name="password" class="input" >
        <br>
        <label for="cpassword">Confirm Password *</label><br>
        <input type="password" name="cpassword" class="input" >
        <br>
        <input type="hidden" name="table" value="users" />
        <input type="hidden" name="redirect_to" value="../../admin/addUser.php" />
      <button type="submit" class="sendbtn" name="signup_submit">Add</button>
    </form>
  </div>
</body>


</html>

