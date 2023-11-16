<?php 
    include_once('topnav.php');
    include('../helpers/DbHelpers.php');
    if (!isset($_SESSION['id'])) {
        header('Location: ../events/index.php?error=error');
    }
    if (isset($_GET['error'])) {
        if($_GET['error']== "empty") {
        echo "<p class='err'>No such email exists</p>";
        }if($_GET['error']== "notsaved") {
            echo "<p class='err' style='font-size: 24px;'>Not saved</p>";
            }
    }
    
    $profile = mysqli_fetch_assoc($db_helpers->getSpecifics('users', $_SESSION['id']));
?>

<head>
    <link rel="stylesheet" type="text/css" href="../public/css/events.css">
    <link rel="stylesheet" type="text/css" href="../public/css/styles.css">
</head>

<div class="container">
    <div class="table1" >
        <div class="table2">
            <div class="table3">
                <img src="../public/images/admin.png" alt=""><br>
                <p><?=  $profile['name'];?></p><br>
            </div>

            <div class="table3" style="background-color: #fff; color: black; width: 100%;  border-radius: 0px 20px 20px 0px;">
                <h2 style="margin-top: 50px;">Information</h2>
                <hr style="margin-bottom: 100px;">
                <label for="" class="label">ID: &nbsp;</label>
                <input class="profile" value="<?=  $profile['id'];?>"><br>
                <label for="" class="label">Date Created: &nbsp;</label>
                <input class="profile" value="<?=  $profile['created_at'];?>"><br>
                <label for="" class="label">Role:&nbsp;</label>
                <input class="profile" value="<?=  $profile['role'] === 0 ? 'Attendee' : 'Organizer';?>"><br>
            
                <form method="post" action="logout.php">
                    <input type="hidden" name="redirect" value="admin_profile.php">
                    <button type="submit" name="logout" class="logout">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>