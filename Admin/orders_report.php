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
    <title>Orders</title>
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
        <a href="orders_report.php" class="active">Orders</a>
        <a href="categories_report.php">Categories</a>
        <a href="feedback_report.php">Feedback</a>
        <a href="admin_profile.php">Admin Profile</a>
      </div>
    </div>

	<?php
        include('../helpers/DbHelpers.php');
        // variable to call a function which fetches all data from the orders table
        $value = $db_helpers->getOrders('orders');
        // variable to call a function which gets the count of items in a specific month in the orders table
        $orders_by_month = mysqli_fetch_assoc($db_helpers->getByMonth('orders'));
        
        $months = ['Jan', 'Feb', 'March', 'April', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
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
                <?= $orders_by_month['count'];?>  Orders
            </div>
            
        </div>

        <!-- <div class="table orders"> -->
            <!-- <div>
                <ul>
                    <li>Month: <?php
                    //  $months[(int)$orders_by_month['month']-1]; 
                    ?>, Number of Orders: 
                    <?php 
                    //  $orders_by_month['count']; 
                    ?></li>
                </ul>
            </div> -->
            <div class="supplierTable" style="overflow-x: auto;">
                <table>
                    <tr>
                        <th>#</th>
                        <th>Product ID</th>
                        <th>Breed</th>
                        <th>Price Per Animal (kshs)</th>
                        <th>Quantity</th>
                        <th>Total Price (kshs)</th>
                        <th>Mode Of Payment</th>
                        <th>Delivery</th>
                        <th>address</th>
                        <th>Made on</th>
                        <th>Buyer Name</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        // create a while loop to fetch all the array values and display in a table
                        while($order = mysqli_fetch_assoc($value)) :
                    ?>

                    <tr>
                        <td><?= $order['order_id']; ?></td>
                        <td><?= $order['product_id']; ?></td>
                        <td><?= $order['breed']; ?></td>
                        <td><?= number_format($order['price']); ?></td>
                        <td><?= $order['quantity']; ?></td>
                        <td><?= number_format($order['total_price']); ?></td>
                        <td><?= $order['mode_of_payment']; ?></td>
                        <td><?= $order['delivery']; ?></td>
                        <td><?= $order['address']; ?></td>
                        <td><?= $order['made_on']; ?></td>
                        <td><?= $order['username']; ?></td>
                        <td>
                            <div class="td1">
                                <form action="AdminClass.php" method="post" class=action1>
                                    <!-- ensure that the product being deleted is the one with the id being selected -->
                                    <input type="hidden" name="id" value="<?= $order['order_id'] ?>"/>
                                    <!-- and from the orders table -->
                                    <input type="hidden" name="table" value="orders" />
                                    <!-- after deleting the redirect should go to the page and refreshed -->
                                    <input type="hidden" name="redirect_to" value="orders_report.php" />
                                    <button type="submit" name="deleteSubmit" class="btn">Delete</button>
                                </form>
                                <form action="../app/supplier/Products.php" method="post" class="action2">
                                    <!-- ensure that the product being edited is the one with the id being selected -->
                                    <input type="hidden" name="id" value="<?= $order['order_id'] ?>"/>
                                    <!-- and from the categories table -->
                                    <input type="hidden" name="table" value="categories" />
                                    <!-- after editing the redirect should go to the specific page and refreshed -->
                                    <input type="hidden" name="redirect_to" value="orders_report.php" />
                                    <button type="submit" name="supply_submit" class="edit_btn">Edit</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <?php endwhile; ?>
                </table>
            </div>
        <!-- </div> -->
    </div>
</body>
</html>
