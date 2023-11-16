<?php
    //  include the navigation bar
    include_once('./topnav.php');
    include('../helpers/DbHelpers.php');
    if (!isset($_SESSION['id'])) {
        header('Location: ../index.php?error=error');
    }

    $event = mysqli_fetch_assoc($db_helpers->getSpecifics('events', $_GET['event']));
    $date = new DateTime($event['date']);
    $user_id = $_SESSION['id'];
    // var_dump($event);
?>

<head>
    <link rel="stylesheet" type="text/css" href="../public/css/events.css">
    <link rel="stylesheet" type="text/css" href="../public/css/styles.css">
   <style>
    input[type=text] {
        width: 100%;
        padding: 9px 10px;
        box-sizing: border-box;
        border: none;
        border: 1px solid #a5a3a3;
    }
    label{
        font-size: medium;
    }
   </style>
</head>

<div id="container">	
            <?php
                if(isset($_GET['error'])) {
                    if($_GET['error']== "invalidemail") {
                        echo '<p class = "err">Invalid Email!</p>';  
                    }
                    elseif ($_GET['error'] == "emptyName") {
                        echo '<p class = "err"> Fill in this required field </p>';
                    }elseif ($_GET['error'] == "validAmount") {
                        echo '<p class = "err"> Please fill in a valid ticket purchasing amount </p>';
                    }
                }
            ?>
    <div class="product-details">
        <h1><?= $event['name']?></h1>
        <span class="hint-star star">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star-o" aria-hidden="true"></i>
        </span>
            
        <p class="information"><?= $event['description']?></p>

        <h2>Location</h2>
        <p class="information"><?= $event['location']?></p>

        <h2>Date & Time</h2>
        <p class="information">
            <?=  $date->format("F j, Y")?> <br>
            From: &nbsp; <?= date("g:i A", strtotime($event['start_time'])) ?> &nbsp; To: &nbsp; <?= date("g:i A", strtotime($event['end_time']))?>
        </p>

        <div class="control" id="openModal">
            <button class="btn" name="putAmount">
                <span class="price"><?=$event['pricing']?></span>
                <span class="shopping-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                <span class="buy">Get now</span>
            </button>
        </div>
                    
    </div>
            
    <div class="product-image">
        <img src="https://images.unsplash.com/photo-1606830733744-0ad778449672?ixid=MXwxMjA3fDB8MHxzZWFyY2h8Mzl8fGNocmlzdG1hcyUyMHRyZWV8ZW58MHx8MHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">

        <div class="info">
            <h2> Description</h2>
            <ul>
                <li><strong>Height : </strong>5 Ft </li>
                <li><strong>Shade : </strong>Olive green</li>
                <li><strong>Decoration: </strong>balls and bells</li>
                <li><strong>Material: </strong>Eco-Friendly</li>
                
            </ul>
        </div>
    </div>

    <div id="myModal" class="modal">
        <form action="../auth/booking.php" name="booking" onsubmit="return validateBooking(); " method="post" style="font-size:20px">
            <button class="close" onclick="closeModal()" aria-label="Close"> x </button> 
            <h2>Purchase a ticket</h2>
            <label for="name">Name</label><br>
            <input type="text" name="name" id="name"><br>
            <label for="email">Email</label><br>
            <input type="text" name="email" id="email"><br>
            <label for="tickets_purchased">Number of tickets</label>
            <input type="number" name="tickets_purchased" id="tickets_purchased" placeholder="--amount--" min="1">
            <input type="hidden" name="event_id" value="<?=$event['id']?>">
            <input type="hidden" name="user_id" value="<?=$user_id?>">
            <input type="hidden" name="available_tickets" value="<?=$event['available_tickets']?>">
            <input type="hidden" name="redirect_to" value="../Attendees/event.php?event=<?=$event['id']?>" />
            <button class="submit" type="submit" name="booking_submit">submit</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('openModal').addEventListener('click', function () {
        showModal()
    })
    // Function to show the modal
    function showModal() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'block';
    }

    // Function to close the modal
    function closeModal() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'none';
    }
</script>