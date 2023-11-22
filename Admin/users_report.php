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
    <title>Users</title>
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
      // variable with function to fetch all data from the users table
      $value = $db_helpers->getAll('users');
      $orders_by_month = mysqli_fetch_assoc($db_helpers->countData('users'));
          
      // <!-- create an error message if the user made an error trying to create an account -->
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
            echo '<p> class = "err"Signup Successful!</p>';
          }
        }
    ?>

    <div class="container">
      <div class="clearfix">
          <div class="img2">
              <?= 
                  date('Y-M-D');
              /**$months[(int)$orders_by_month['month']-1];*/
              ?>
          </div>

          <div class="item itemAdmin">
              <?= $orders_by_month['count'];?>  Users
          </div>
          
      </div>

      <!-- <div class="box1">
          <div class="left">
              <a href="addUser.php"><button type="" class="addUser" name="add_user">+</button></a>
              <p>Add User</p>
          </div>
      </div> -->


      <div class="table">
        <div class="supplierTable">
          <table>
            <tr>
              <div class="clearfix">
                <div class="img2" style="padding: 2px; margin-right: 20px; height: 50px;">
                  <a href="addUser.php"><button type="" class="addUser" name="add_user">+ &nbsp; Add User</button></a>
                  <p></p>
                </div>
                  <p style="display: inline-block; margin: 0px; font-size: xxx-large; margin-left: 10px; padding-bottom: 10px; padding-top: 10px;">USERS</p> 
              </div>
              
            </tr>

            <tr>
                <th>#</th>
                <th>Company name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>
                  <!-- dropdown button for types of customers -->
                  <label class="dropdown">
                    <div class="dd-button">Account Type </div><div class="triangle"></div>
                    <input type="checkbox" class="dd-input" id="test">
                    <ul class="dd-menu">
                      <li> <a href="customers_report.php">Customer</a> </li>
                      <li> <a href="suppliers_report.php">Supplier</a> </li>
                    </ul>
                  </label>
                </th>
                <th>Date Created</th>
                <!-- dropdown button to show online or offline users -->
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
                    <!-- ensure that the product being deleted is the one with the id being selected -->
                    <input type="hidden" name="id" value="<?= $detail['id'] ?>"/>
                    <!-- and from the orders table -->
                    <input type="hidden" name="table" value="users" />
                    <!-- after deleting the redirect should go to the page and refreshed -->
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

    
    <!-- <div class="pagination">
        <a href="#">&laquo;</a>
        <a href="" class="active">1</a>
        <a href="">2</a>
        <a href="">3</a>
        <a href="">4</a>
        <a href="">5</a>
        <a href="">6</a>
        <a href="">7</a>
        <a href="#">&raquo</a>
    </div> -->
  </body>
</html>
