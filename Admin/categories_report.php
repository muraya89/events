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

    <?php
      include('../helpers/DbHelpers.php');
      // using the the variable category call the function from the db_helpers file to fetch all the values from the category table
      $category = $db_helpers->getAll('categories');
    ?>

    <div class="container">
      <div class="table">
        <div class="supplierTable">
          <table>
          <tr>
            <div class="clearfix">
              <div class="img2" style="padding: 2px; margin-right: 20px; height: 50px;">
                <a href="addCategories.php"><button type="" class="addUser" name="add_user" style="width: 150px;">+ &nbsp; Add Category</button></a>
                <p></p>
              </div>
                <p style="display: inline-block; margin: 0px; font-size: xxx-large; margin-left: 10px; padding-bottom: 10px; padding-top: 10px;">Categories</p> 
            </div>
            
          </tr>

            <tr>
              <th>#</th>
              <th>Breed name</th>
              <th>Type</th>
              <th>Added on</th>
              <th>Actions</th>
            </tr>
            <?php 
            // create a while loop to fetch all the array values and display in a table
            while($detail = mysqli_fetch_assoc($category)) :?>
            <tr>
              <td><?= $detail['id']; ?></td>
              <td><?= $detail['name']; ?></td>
              <td><?= $detail['type']; ?></td>
              <td><?= $detail['date_created']; ?></td>
              <td >
                <div class="td">
                  <form action="AdminClass.php" method="post" class=action1>
                    <input type="hidden" name="id" value="<?= $detail['id'] ?>"/>
                    <input type="hidden" name="table" value="categories" />
                    <input type="hidden" name="redirect_to" value="categories_report.php" />
                    <button type="submit" name="deleteSubmit" class="btn">Delete</button>
                  </form>
                  <!-- <form action="../app/supplier/Products.php" method="post" class="action2">
                    <input type="hidden" name="id" value="<?= $detail['id'] ?>"/>
                    <input type="hidden" name="table" value="categories" />
                    <input type="hidden" name="redirect_to" value="categories_report.php" />
                    <button type="submit" name="supply_submit" class="edit_btn">Edit</button>
                  </form> -->
                      <?php 
                          // when the edit button is selected the information is displayed as a string and then encoded 
                          $base64UrlString = base64_encode(json_encode(array_merge($detail, ['isEdit' => true]))); 
                      ?>
                      <div class="flex-box action2">
                          <a href="addCategories.php?edit=<?=$base64UrlString;?>"><button class= "edit_btn" name="edit"> Edit</button></a>
                      </div>
                </div>
              </td>
            </tr>
            <?php endwhile; ?>
          </table>
        </div>
      </div>

    </div>



</body>
</html>