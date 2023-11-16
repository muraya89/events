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
    <button onclick="goBack()" class="goBack" style="margin-left:43px; float: left; margin-right: 20px;">
        <i class="fa fa-arrow-left" aria-hidden="true" style="margin-right: 15px;"></i>
        Go back
    </button>
    <h1>My Tickets</h1>
</div>
<table>
    <thead>
        <tr>
            <td>#</td>
            <td>Event Name</td>
            <td>Tickets Purchased</td>
            <td>Location</td>
            <td>Date</td>
            <td>Start time</td>
            <td>End time</td>
            <td>Pricing</td>
            <td>Total amount (kes)</td>
            <td>Actions</td>
        </tr>
    </thead>
    <?php 
        // create a while loop to fetch all the array values and display in a table
        $rowNumber = 1;
        while($myBookings = mysqli_fetch_assoc($bookings)) :
    ?>
    <tr>
        <td><?= $rowNumber++; ?></td>
        <td><?= $myBookings['name']; ?></td>
        <td><?= $myBookings['tickets_purchased']; ?></td>
        <td><?= $myBookings['location']; ?></td>
        <td><?= $myBookings['date']; ?></td>
        <td><?= $myBookings['start_time']; ?></td>
        <td><?= $myBookings['end_time']; ?></td>
        <td><?= $myBookings['pricing']; ?></td>
        <td><?= number_format($myBookings['total_amount']); ?></td>
        <td>
            <div class="dropdown">
                    <div class="verticalDots"></div>
                <div class="td1 dropdown-content">
                    <form action="booking.php" method="post" class="action1">
                        <!-- ensure that the product being edited is the one with the id being selected -->
                        <input type="hidden" name="id" value="<?= $myBookings['id'] ?>"/>
                        <!-- and from the bookings table -->
                        <input type="hidden" name="table" value="bookings" />
                        <!-- after editing the redirect should go to the specific page and refreshed -->
                        <input type="hidden" name="redirect_to" value="myTickets.php" />
                        <button type="submit" name="deleteSubmit" class="actions">Delete</button>
                    </form>
                    <form action="../app/supplier/Products.php" method="post" class="action2">
                        <!-- ensure that the product being edited is the one with the id being selected -->
                        <input type="hidden" name="id" value="<?= $myBookings['id'] ?>"/>
                        <!-- and from the bookings table -->
                        <input type="hidden" name="table" value="bookings" />
                        <!-- after editing the redirect should go to the specific page and refreshed -->
                        <input type="hidden" name="redirect_to" value="myTickets.php" />
                        <button type="submit" name="editSubmit" class="actions">Edit</button>
                    </form>
                </div>
            </div>
            
        </td>
    </tr>
    <?php endwhile; ?>
</table>