<?php
    // session is a way to temporarily store the user information on the server-side, 
    // whereas cookies store the information on the user's computer until it expires.
    session_start();
    include 'header.php';
    include 'dbconn.php';

    // Confirming that the person accessing the page is admin
    if($_SESSION['roleName'] == 'Admin'){
            // Do nothing
        }else{
            header("Location: mainPage.php");
        }
?>
<head>
    <style>
        table, th, td{
            border :1px solid #FE852B;
            padding:5px;
            text-align:center;
            color: #0038a8;
        }
        .container{
            text-align: center;
        }
        .container a{
            text-decoration: none;
            color: #FE852B;
        }
        .productType{
            text-align:center;
            background-color:#0038a8;
        }
        .productType button{
            border: 2px solid #FE852B;
            border-radius:5px;
            padding:10px;/* padding is the space between the element's content and the element's border */
            color:#0038a8;
        }
        .table{/* Helps resize both the height and width of a <div> element */
            resize:both;
            /* The overflow property specifies what should happen if content overflows an element's box.
            auto - a scroll-bar is added to see the rest of the content */
            overflow:auto;
        }
        @media all and (min-width:320px) and (max-width:2560px){
            .productType{
                margin:10px;/* margin is the space between an element and any other element around it */
                padding:20px 0px;/* padding is the space between the element's content and the element's border */
            }
            .productType button{
                margin:10px;
            }
        }

        /* Responsiveness */
        /* @media - property used in media queries to apply different styles for different media types/devices 
            all - includes both screen and print media */
        @media all and (min-width:897px) and (max-width:1024px){
            .container a, th, td, p{ font-size: 20px; }
        }
        @media all and (min-width:1025px) and (max-width:1232px){
            .container a, th, td, p{ font-size: 22px; }
        }
        @media all and (min-width:1233px) and (max-width:1440px){
            .container a, th, td, p{ font-size: 24px; }
        }
        @media all and (min-width:1441px) and (max-width:2000px){
            .container a, th, td, p{ font-size: 28px; }
            .productType button{
                padding: 20px;
                font-size: 28px;
            }
        }
        @media all and (min-width:2001px) and (max-width:2560px){
            .container a, th, td, p{ font-size: 34px; }
            .productType button{
                padding: 20px;
                font-size: 32px;
            }
        }
    </style>
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</head> <br>

    <body>
    <div class="container">
            <!-- View tables -->
        <a href="viewtbls.php">View Tables<span style="color:#0038a8;" ><b> | </b></span></a>
        <!-- Edit Record -->
        <a href="editRecord.php">Edit Record<span style="color:#0038a8;"><b> | </b></span></a>
        <!-- Insert new record -->
        <a href="insertRecord.php">Add a New Record<span style="color:#0038a8;"><b> | </b></span></a>
        <!-- Delete Record -->
        <a href="deleteRecord.php">Delete Record<span style="color:#0038a8;"><b> | </b></span></a>
        <!-- Reports -->
        <a href="reports.php">Reports</a><br><br>
        
    </div>
         

    <form class="productType" name="productType" action="viewtbls.php" method="post">
        <!-- Accommodation-->
        <input type="hidden" name="inputsearch" value="accommodation"/> 
        <button name="asearch" class="asearch" id="asearch">View accommodation table</button><br>
        
        <!-- Packages-->
        <input type="hidden" name="inputsearch" value="packages"/> 
        <button name="psearch" class="psearch" id="psearch">View packages table</button><br>

        <!-- Flights-->
        <input type="hidden" name="inputsearch" value="flights"/> 
        <button name="fsearch" class="fsearch" id="fsearch">View flights table</button><br>

        <!-- Users  -->
        <input type="hidden" name="inputsearch" value="users"/>
        <button name="usearch" class="usearch" id="usearch">View users table</button> <br>
    </form> <br>

<?php
    // Accommodation display
    // The isset() function checks whether a variable is set, 
    // which means that it has to be declared and is not NULL
    if (isset($_POST["asearch"])){
        // mysqli_query()...Perform query against a database
        $sql=mysqli_query($conn,"SELECT * FROM accommodation");
        if(mysqli_num_rows($sql)==0)
        {
            echo "Sorry, no results to show yet!";
        }
        else
        {
            ?>
            <p style="text-align:center; color: #FE852B;"><b>Accommodation</b></p>
            <div class="table">
                <table>
                    <tr>
                        <th>Accommodation Id</th>
                        <th>Accommodation Name</th>
                        <th>No. Of Rooms</th>
                        <th>Price Per Night</th>
                        <th>ratings</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>imageId</th>
                        <th>Created-at</th>
                    </tr>
                    <?php
                    // function fetches a result row as an associative array
                    // associative arrays - are an abstract data type that use named keys that you assign to them
                    while($row=mysqli_fetch_assoc($sql)){
                    ?>
                        <tr>
                            <td> <?php echo $row['accommId']; ?> </td>
                            <td> <?php echo $row['accommName']; ?> </td>
                            <td> <?php echo $row['noOfRooms']; ?> </td>
                            <td> <?php echo $row['pricePerNight']; ?> </td>
                            <td> <?php echo $row['ratings']; ?> </td>
                            <td> <?php echo $row['description']; ?> </td>
                            <td> <?php echo $row['location']; ?> </td>
                            <td> <?php echo $row['imageId']; ?> </td>
                            <td> <?php echo $row['created_at']; ?> </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            
            <?php
        }
        
    }
// ---------------------------------------------------------------------------------------------------------------
    // Flights display
    // The isset() function checks whether a variable is set, 
    // which means that it has to be declared and is not NULL
    if (isset($_POST["fsearch"])){
        // mysqli_query()...Perform query against a database
        $sql=mysqli_query($conn,"SELECT * FROM flights");
        if(mysqli_num_rows($sql) == 0)
        {
            echo "Sorry, no results to show yet!";
        }
        else
        {
            ?>
            <p style="text-align:center; color: #FE852B;"><b>Flights</b></p>
            <div class="table">
            <table>
                    <tr>
                    <th>Flight Id</th>
                    <th>Category</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Airline</th>
                    <th>Depart Date</th>
                    <th>Price</th>
                    <th>Return Date</th>
                    <th>Arrival Date</th>
                    <th>Layover</th>
                    <th>Through-city</th>
                    <th>Created-at</th>
                    </tr>
                <?php
                // function fetches a result row as an associative array
                // associative arrays - are an abstract data type that use named keys that you assign to them
                while($row=mysqli_fetch_assoc($sql)){
                ?>
                    <tr>
                        <td> <?php echo $row['flightId']; ?> </td>
                        <td> <?php echo $row['category']; ?> </td>
                        <td> <?php echo $row['origin']; ?> </td>
                        <td> <?php echo $row['destination']; ?> </td>
                        <td> <?php echo $row['airline']; ?> </td>
                        <td> <?php echo $row['departDate']; ?> </td>
                        <td> <?php echo $row['price']; ?> </td>
                        <td> <?php echo $row['returnDate']; ?> </td>
                        <td> <?php echo $row['arrivalDate']; ?> </td>
                        <td> <?php echo $row['layover']; ?> </td>
                        <td> <?php echo $row['throughcity']; ?> </td>
                        <td> <?php echo $row['created_at']; ?> </td>
                    </tr>
                <?php
                }
                ?>
            </table>
            </div>
            <?php
        }
        
    }
// ---------------------------------------------------------------------------------------------------------
    // Packages display
    // The isset() function checks whether a variable is set, 
    // which means that it has to be declared and is not NULL
    else if (isset($_POST["psearch"])){
        // mysqli_query()...Perform query against a database
        $sql2=mysqli_query($conn,"SELECT * FROM packages");
        if(mysqli_num_rows($sql2)==0)
        {
            echo "Sorry, no results to show yet!";
        }
        else
        {
            ?>
            <p style="text-align:center; color: #FE852B;"><b>Packages</b></p>
            <div class="table">
            <table>
                    <tr>
                        <th>Package Id</th>
                        <th>Package Name</th>
                        <th>Price Per Person</th>
                        <th>Location</th>
                        <th>Description</th>
                        <th>Ratings</th>
                        <th>Category</th>
                        <!-- <th>image</th> -->
                        <th>created_at</th>
                    </tr>
                <?php   
                // function fetches a result row as an associative array
                // associative arrays - are an abstract data type that use named keys that you assign to them
                while($row=mysqli_fetch_assoc($sql2)){
                ?>
                    <tr>
                        <td> <?php echo $row['pkgId']; ?> </td>
                        <td> <?php echo $row['pkgName']; ?> </td>
                        <td> <?php echo $row['pricePerPerson']; ?> </td>
                        <td> <?php echo $row['location']; ?> </td>
                        <td> <?php echo $row['description']; ?> </td>
                        <td> <?php echo $row['ratings']; ?> </td>
                        <td> <?php echo $row['category']; ?> </td>
                        <!-- <td> <?php //echo $row['image']; ?> </td> -->
                        <td> <?php echo $row['created_at']; ?> </td>
                    </tr>
                <?php
                 }
                ?>
            </table>
            </div>
            <?php
        }
    }
// ------------------------------------------------------------------------------------------------------------
    // Users display
    // The isset() function checks whether a variable is set, 
    // which means that it has to be declared and is not NULL
    else if (isset($_POST["usearch"])){
        // mysqli_query()...Perform query against a database
        $sql5=mysqli_query($conn,"SELECT * FROM users");
        if(mysqli_num_rows($sql5)==0)
        {
            echo "Sorry, no results to show yet!";
        }
        else
        {
            ?>
            <p style="text-align:center; color: #FE852B;"><b>Users</b></p>
            <div class="table">
            <table>
                    <tr>
                        <th>User Id</th>
                        <th>First Name</th>
                        <th>Other Names</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Role Name</th>
                        <th>isLoggedIn</th>
                        <th>ID/Passport</th>
                        <th>created_at</th>
                    </tr>
                <?php  
                // function fetches a result row as an associative array
                // associative arrays - are an abstract data type that use named keys that you assign to them 
                while($row=mysqli_fetch_assoc($sql5)){
                ?>
                    <tr>
                        <td> <?php echo $row['userId']; ?> </td>
                        <td> <?php echo $row['fName']; ?> </td>
                        <td> <?php echo $row['lName']; ?> </td>
                        <td> <?php echo $row['telephone']; ?> </td>
                        <td> <?php echo $row['email']; ?> </td>
                        <td> <?php echo $row['userName']; ?> </td>
                        <td> <?php echo $row['passwd']; ?> </td>
                        <td> <?php echo $row['roleName']; ?> </td>
                        <td> <?php echo $row['loggedIn']; ?> </td>
                        <td> <?php echo $row['IDPass']; ?> </td><!--Id or passport-->
                        <td> <?php echo $row['created_at']; ?> </td>
                    </tr>
                <?php
                 }
                ?>
            </table>
            </div>
            <?php
        }
    }
?>

<?php 
    include 'footer.php';
?>
