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
        <a href="users_report.php">Users</a>
        <a href="product_report.php">Products</a>
        <a href="orders_report.php">Orders</a>
        <a href="categories_report.php" class="active">Categories</a>
        <a href="feedback_report.php">Feedback</a>
        <a href="admin_profile.php">Admin Profile</a>
      </div>
    </div>

  <div class="box2">    
    <h1><?= isset($_GET['edit']) ? 'Edit' : 'Add'; ?>&nbsp;Category</h1>  
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
        $data = [];
        if (isset($_GET['edit'])) {
          //for decoding stored data when the edit button is selected
          $data = json_decode(base64_decode($_GET['edit']));
        }
      ?>
    <form method="POST" action="categories.php">
        <label for="name">Name<span style="color: red;">*</span></label>
        <input type="text" name="name" placeholder="Enter the name of the category" class="input" value="<?= isset($_GET['edit']) && isset($data->name) ? $data->name : ''; ?>" >
        <br>
        <label for="type">Type <span style="color: red;">*</span> </label>
        <input type="text" name="type" class="input" placeholder="Enter the type of animal" value="<?= isset($_GET['edit']) && isset($data->type) ? $data->type : ''; ?>" >
        <br>
  			<input type="hidden" value="<?= isset($_GET['edit']) && isset($data->id) ? $data->id : ''; ?>" name="id" />
		  	<input type="hidden" value="<?= isset($_GET['edit']) ? 'edit' : 'add'; ?>" name="submitType" />
        <!-- <input type="hidden" name="redirect_to" value="../../admin/addCategories.php" /> -->
      <button type="submit" class="sendbtn" name="supply_submit"><?= isset($_GET['edit']) ? 'Edit' : 'Submit'; ?></button>
    </form>
  </div>
</body>


</html>

