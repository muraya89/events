<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Dashboard</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./adminstyles.css">
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body class="body">
	<?php
		include('./dashboard.php');
		include('../helpers/DbHelpers.php');
		// variable to call a function which fetches all data from the orders table
		$value = $db_helpers->getAll('bookings');
		$revenue = mysqli_fetch_assoc($db_helpers->sumRevenue());
		$orders = mysqli_fetch_assoc($db_helpers->countData('bookings'));
		$products = mysqli_fetch_assoc($db_helpers->countData('events'));
		$customers = mysqli_fetch_assoc($db_helpers->countUsers('users'));
		// $most_ordered = $db_helpers->ordering();
		// $onlineUsers = $db_helpers->getOnlineusers('online');
		
		$months = ['Jan', 'Feb', 'March', 'April', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
	?>
	
	<div class="container">
		<div class="item7">
			<div class="item">
				<b><?=$products['count'];?></b> &nbsp; Product(s)
				<a href="product_report.php"><button type="button" class="button-1"><i class='fas fa-arrow-right'></i></button></a>
			</div>

			<div class="item">
				<b><?=$orders['count'];?></b> &nbsp; order(s)
				<a href="orders_report.php"><button type="button" class="button-1"><i class='fas fa-arrow-right'></i></button></a>
			</div>

			<div class="item">
				<b> <?=$customers['count'];?></b> &nbsp; Customer(s)
				<a href="customers_report.php"><button type="button" class="button-1"><i class='fas fa-arrow-right'></i></button></a>
			</div>

			<!-- <div class="item">
				<b><?=$suppliers['count'];?></b> &nbsp; Supplier(s)
				<a href="suppliers_report.php"><button type="button" class="button-1"><i class='fas fa-arrow-right'></i></button></a>
			</div>
			
			<div class="item">
				<b>kshs&nbsp;<?=number_format($revenue['sum(total_price)'])?></b> &nbsp; Revenue
				<a href="salesreport.php"><button type="button" class="button-1"></button></a>
			</div> -->
		</div>

		<div class="item">
			<table>
				<tr>
					<div>
						<span style="font-size: 20px;">Most Ordered Breeds</span>
					</div>
				</tr>
				<tr>
					<th>Breed</th>
					<th>Quantity</th>
				</tr>
				<?php 
					// create a while loop to fetch all the array values and display in a table
					// var_dump($most_ordered);die();
					while($value = mysqli_fetch_assoc($most_ordered)):
				?>
				<tr>
					<td><?= $value['breed']; ?></td>
					<td><?= $value['sum(quantity)']; ?></td>
				</tr>
				<?php endwhile; ?>
			</table> 
		</div>

		<div class="item" style="margin-top: 5%;">
			<table>
				<tr>
					<div>
						<span style="font-size: 20px;">Online Users</span>
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
				while($detail = mysqli_fetch_assoc($onlineUsers)) : ?>
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
</body>
</html>