<?php include_once('main.php'); ?>
		<div class="nav-links">
			<a href="admin.php">Dashboard</a>
			<a href="users_report.php" style="background-color: #007bff; color: #FFF">Users</a>
			<a href="product_report.php">Products</a>
			<a href="orders_report.php">Orders</a>
			<a href="categories_report.php">Categories</a>
			<a href="feedback_report.php">Feedback</a>
			<a href="admin_profile.php">Admin Profile</a>
		</div>
	</div>
    

	<?php
	include('../helpers/DbHelpers.php');
	$value = $db_helpers->getOnlineusers('online');
      
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

    <div class="box1">
        <div class="left">
            <a href="addUser.php"><button type="" class="addUser" name="add_user">+</button></a>
            <p>Add User</p>
        </div>
    </div>


    <div class="table">
	 <div class="supplierTable">
        <table>
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
                </ul>
              </label>
            </th>
            <th>Date Created</th>
            <th>
              <label class="dropdown">
                <div class="dd-button"> Online Users</div><div class="triangle"></div>
                <input type="checkbox" class="dd-input" id="test">
                <ul class="dd-menu">
                  <li> <a href="offline_users.php">Offline Users</a> </li>
                  <hr>
                  <li> <a href="users_report.php">All</a> </li>
                </ul>
              </label></th>
            <th>Action</th>
         </tr>
         <?php 
          // create a while loop to display all the array values and display in a table
          while($detail = mysqli_fetch_assoc($value)) : ?>
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
