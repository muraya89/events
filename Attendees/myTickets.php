<?php
    //  include the navigation bar
    include_once('./topnav.php');
    include('../helpers/DbHelpers.php');
    if (!isset($_SESSION['id'])) {
        header('Location: ../index.php?error=error');
    }

    $bookings = $db_helpers->fetchBookings($_SESSION['id']);
    // var_dump(mysqli_fetch_assoc($bookings));
?>

<head>
    <link rel="stylesheet" type="text/css" href="../public/css/events.css">
    <link rel="stylesheet" type="text/css" href="../public/css/styles.css">
</head>

<div>
    <button onclick="goBack()" class="goBack" style="margin-left:15px; float: left; margin-right: 20px;">
        <i class="fa fa-arrow-left" aria-hidden="true" style="margin-right: 15px;"></i>
        Go back
    </button>
    <h1>My Tickets</h1>
</div>
<div class="supplierTable" style="overflow-x: hidden;">
    <table>
        <tr>
            <th>#</th>
            <th>Event Name</th>
            <th>Tickets Purchased</th>
            <th>Location</th>
            <th>Date</th>
            <th>Start time</th>
            <th>End time</th>
            <th>Pricing</th>
            <th>Total amount (kes)</th>
            <th>Actions</th>
        </tr>

        <?php 
            // create a while loop to fetch all the array values and display in a table
            while($myBookings = mysqli_fetch_assoc($bookings)) :
        ?>

        <tr>
            <td><?= $myBookings['id']; ?></td>
            <td><?= $myBookings['name']; ?></td>
            <td><?= $myBookings['tickets_purchased']; ?></td>
            <td><?= $myBookings['location']; ?></td>
            <td><?= $myBookings['date']; ?></td>
            <td><?= $myBookings['start_time']; ?></td>
            <td><?= $myBookings['end_time']; ?></td>
            <td><?= $myBookings['pricing']; ?></td>
            <td><?= number_format($myBookings['total_amount']); ?></td>
            <td>
                <div class="td1">
                    <form action="AdminClass.php" method="post" class=action1>
                        <!-- ensure that the product being deleted is the one with the id being selected -->
                        <input type="hidden" name="id" value="<?= $myBookings['bookings_id'] ?>"/>
                        <!-- and from the bookingss table -->
                        <input type="hidden" name="table" value="bookingss" />
                        <!-- after deleting the redirect should go to the page and refreshed -->
                        <input type="hidden" name="redirect_to" value="bookingss_report.php" />
                        <button type="submit" name="deleteSubmit" class="btn">Delete</button>
                    </form>
                    <form action="../app/supplier/Products.php" method="post" class="action2">
                        <!-- ensure that the product being edited is the one with the id being selected -->
                        <input type="hidden" name="id" value="<?= $myBookings['bookings_id'] ?>"/>
                        <!-- and from the categories table -->
                        <input type="hidden" name="table" value="categories" />
                        <!-- after editing the redirect should go to the specific page and refreshed -->
                        <input type="hidden" name="redirect_to" value="bookingss_report.php" />
                        <button type="submit" name="supply_submit" class="edit_btn">Edit</button>
                    </form>
                </div>
            </td>
        </tr>

        <?php endwhile; ?>
    </table>
</div>