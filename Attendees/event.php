<?php
    //  include the navigation bar
    include_once('./topnav.php');
    include('../helpers/DbHelpers.php');
    if (!isset($_SESSION['id'])) {
        header('Location: ../index.php?error=error');
    }

    $event = mysqli_fetch_assoc($db_helpers->getSpecifics('events', $_GET['event']));
    $date = new DateTime($event['date']);
    // var_dump($event);
?>

<head>
    <link rel="stylesheet" type="text/css" href="../public/css/events.css">
    <link rel="stylesheet" type="text/css" href="../public/css/styles.css">
   
</head>

<div>
    <div id="container">	
	
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

		
		
<div class="control">
	
	<button class="btn">
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

</div>

</div>

<script>

</script>