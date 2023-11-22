<?php
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
    /* body{
        text-align:center;
    } */
    .container a{
        text-decoration:none;
        color:#FE852B;
    }
    label{
        color: #0038a8;
    }
    input{
        border: 1px solid #0038a8;
    }
    .a input, input::placeholder{
        color:#FE852B;
        text-align:center; 
    }
    .editbtn,.update{
        border: 2px solid #FE852B;
        /* border-radius:5px; */
        /* padding:10px; */
        background-color:#FE852B;
        color:white;
    }
    form{
        text-align:center;
    }
    @media all and (min-width:320px) and (max-width:2560px){
        .a, .container{ text-align:center;}
        .container a, th, td, p, span{ font-size: 18px; }
    }
    @media all and (min-width:897px) and (max-width:2560px){
        input::placeholder, input{ font-size: 18px; }
        .container a, label, span{ font-size: 20px; }
        input{ padding:8px; }
        .editbtn, .update{ padding:5px 10px; }
    }
    @media all and (min-width:1025px) and (max-width:1232px){
        input::placeholder, input{ font-size: 20px; }
        .container a, label, span{ font-size: 22px; }
    }
    @media all and (min-width:1233px) and (max-width:1440px){
        input::placeholder, input{ font-size: 22px; }
        .container a, label, span{ font-size: 24px; }
        .editbtn, .update{ font-size: 22px; }
    }
    @media all and (min-width:1441px) and (max-width:2000px){
        input::placeholder, input{ font-size: 24px; }
        .container a, label, span{ font-size: 28px; }
        .productType button{
            padding: 20px;
            font-size: 28px;
        }
        input{ padding:10px; }
        .editbtn, .update{ padding:10px 15px; font-size: 24px; }
    }
    @media all and (min-width:2001px) and (max-width:2560px){
        input::placeholder, input{ font-size: 30px; }
        .container a, label, span{ font-size: 34px; }
        .productType button{
            padding: 20px;
            font-size: 32px;
        }
        input{ padding:20px; }
        .editbtn, .update{ padding:20px 25px; font-size:32px; }
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
</head><br>

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
        <a href="reports.php">Reports<br><br></a>
    </div>

    <div class="a" id="a">
        <form action = "editRecord.php" method = "post" onsubmit = "return validation()">
            <label for="producttype">Product Type: <br><i>flights, packages, accommodation</i></label><br><br>
            <input type="text" class= "producttype"  id="producttype" name="producttype" placeholder="Eg: flights"><br><br>

            <span id="error" class="error" style="font-weight:bold;color:#FE852B;"></span><br><br>

            <label for="pid">Product Id: <br><i>flightId, pkgsId, rentalId, destId, userId</i></label><br><br>
            <input type="text" name="pid" class="pid" id="pid" placeholder="Eg: 3"><br><br>
            
            <button class = "editbtn" name = "editbtn" id = "editbtn">EDIT</button><br>
        </form>
    </div><br>

<?php
    if(isset($_POST['editbtn'])){ 
                $product = filter_input(INPUT_POST, 'producttype');
                $id = filter_input(INPUT_POST, 'pid');
        
                ?>
                <!-- Hide div a -->
                <script type="text/javascript">
                    var a = document.getElementById('a');
                    a.style.display = 'none';
                </script>
                <?php
    
                if($product == 'flights'){
                    // Prepared stmt to get record of the entered flight Id
                    $queryf = "SELECT * FROM flights WHERE flightId = ?";
                    mysqli_query($conn, $queryf);
                    $statement = mysqli_stmt_init($conn);
                    $prep = mysqli_stmt_prepare($statement, $queryf);
                    mysqli_stmt_bind_param($statement, "i", $id);
                    mysqli_stmt_execute($statement);
    
                    $result = mysqli_stmt_get_result($statement);
                    $count = mysqli_num_rows($result);
                    if($count == 1){
                        while($rowf = mysqli_fetch_assoc($result)){//using while loop to loop through n display all search results
                            $_SESSION['id'] = $rowf['flightId'];
                            ?>
                            <div class="b" id="b">
                            <form action="editRecord2.php" method="post" onsubmit = "return validation1()">

                            <span id="errorAll" class="errorAll" style="font-weight:bold;color:#FE852B;"></span><br>

                                    <!-- <label for="edit">Flight Id</label><br>
                                    <input name= "edit" class= "edit" id= "edit" placeholder= "<?php  //echo $rowf['flightId']; ?>"><br><br> -->
                                    <label for="category">Category: <br><i>Input either oneway, roundtrip or multicity</i></label><br>
                                    <input name= "category" class= "edit" id= "category" placeholder= "<?php  echo $rowf['category']; ?>"><br><br>

                                    <label for="origin">Origin</label><br>
                                    <input name= "origin" class= "edit" id= "origin" placeholder= "<?php  echo $rowf['origin']; ?>"><br><br>

                                    <label for="destination">Destination</label><br>
                                    <input name= "destination" class= "edit" id= "destination" placeholder= "<?php  echo $rowf['destination']; ?>"><br><br>

                                    <!-- <input name= "edit" class= "edit" id= "edit" placeholder= "<?php // echo $rowf['created_at']; ?>"><br><br> -->
                                    <label for="airline">Airline</label><br>
                                    <input name= "airline" class= "edit" id= "airline" placeholder= "<?php  echo $rowf['airline']; ?>"><br><br>

                                    <label for="departDate">Depart Date</label><br>
                                    <input name= "departDate" class= "edit" id= "departDate" placeholder= "<?php  echo $rowf['departDate']; ?>"><br><br>

                                    <label for="price">Price</label><br>
                                    <input name= "price" class= "edit" id= "price" placeholder= "<?php  echo $rowf['price']; ?>"><br><br>

                                    <label for="returnDate">Return Date</label><br>
                                    <input name= "returnDate" class= "edit" id= "returnDate" placeholder= "<?php  echo $rowf['returnDate']; ?>"><br><br>

                                    <label for="arrivalDate">Arrival Date</label><br>
                                    <input name= "arrivalDate" class= "edit" id= "arrivalDate" placeholder= "<?php  echo $rowf['arrivalDate']; ?>"><br><br>

                                    <label for="layover">Layover</label><br>
                                    <input name= "layover" class= "edit" id= "layover" placeholder= "<?php  echo $rowf['layover']; ?>"><br><br>

                                    <label for="throughcity">Through-city</label><br>
                                    <input name= "throughcity" class= "edit" id= "throughcity" placeholder= "<?php  echo $rowf['throughcity']; ?> "><br><br> 
                            
                                <?php
                        
                                ?>
                                    <button class="update" id="f" name="updatef">UPDATE</button><br><br>
                                </form>
                            </div>
                            <?php
                        }
                    }else{
                        ?>
                            <script> alert("Sorry, the record cannot be found!")</script>
                        <?php
                    }
                }
                // --------------------------------------------------------------------------------------
                if( $product == 'accommodation'){
                    // Prepared stmt to get record of the entered flight Id
                    $querya = "SELECT * FROM accommodation WHERE accommId = ?";
                    mysqli_query($conn, $querya);
                    $statement = mysqli_stmt_init($conn);
                    $prep = mysqli_stmt_prepare($statement, $querya);
                    mysqli_stmt_bind_param($statement, "i", $id);
                    mysqli_stmt_execute($statement);
    
                    $result = mysqli_stmt_get_result($statement);
                    $count = mysqli_num_rows($result);
                    if($count == 1){
                        while($rowf = mysqli_fetch_assoc($result)){//using while loop to loop through n display all search results
                            $_SESSION['id'] = $rowf['accommId'];
                            ?>
                            <div class="b" id="b">
                            <form action="editRecord2.php" method="post" onsubmit = "return validation2()">

                            <span id="errorAll2" class="errorAll2" style="font-weight:bold;color:#FE852B;"></span><br>

                                    <!-- <label for="edit">Accommodation Id</label><br>
                                    <input name= "edit" class= "edit" id= "edit" placeholder= "<?php  //echo $rowf['accommId']; ?>"><br><br> -->
                                    <label for="accommName">Accommodation Name<br></label><br>
                                    <input name= "accommName" class= "edit" id= "accommName" placeholder= "<?php  echo $rowf['accommName']; ?>"><br><br>

                                    <label for="noOfRooms">Number of Rooms</label><br>
                                    <input name= "noOfRooms" class= "edit" id= "noOfRooms" placeholder= "<?php  echo $rowf['noOfRooms']; ?>"><br><br>

                                    <label for="pricePerNight">Price Per Night</label><br>
                                    <input name= "pricePerNight" class= "edit" id= "pricePerNight" placeholder= "<?php  echo $rowf['pricePerNight']; ?>"><br><br>

                                    <!-- <input name= "edit" class= "edit" id= "edit" placeholder= "<?php // echo $rowf['created_at']; ?>"><br><br> -->
                                    <label for="ratings">Ratings</label><br>
                                    <input name= "ratings" class= "edit" id= "ratings" placeholder= "<?php  echo $rowf['ratings']; ?>"><br><br>
                                    
                                    <label for="description">Description</label><br>
                                    <input name= "description" class= "edit" id= "description" placeholder= "<?php  echo $rowf['description']; ?>"><br><br>

                                    <label for="location">Location</label><br>
                                    <input name= "location" class= "edit" id= "location" placeholder= "<?php  echo $rowf['location']; ?>"><br><br>

                                    <label for="accommType">Accommodation Type: <br><i>Input either traditional hotel, airbnb or camping</i></label><br>
                                    <input name= "accommType" class= "edit" id= "accommType" placeholder= "<?php  echo $rowf['accommType']; ?>"><br><br> 
                            
                                <?php
                        
                                ?>
                                    <button class="update" id="a" name="updatea">UPDATE</button><br><br>
                                </form>
                            </div>
                            <?php
                        }
                    }else{
                        ?>
                            <script> alert("Sorry, the record cannot be found!")</script>
                        <?php
                    }
                }
                // ------------------------------------------------------------------------------------------------------
                if( $product == 'packages'){
                    // Prepared stmt to get record of the entered flight Id
                    $querya = "SELECT * FROM packages WHERE pkgId = ?";
                    mysqli_query($conn, $querya);
                    $statement = mysqli_stmt_init($conn);
                    $prep = mysqli_stmt_prepare($statement, $querya);
                    mysqli_stmt_bind_param($statement, "i", $id);
                    mysqli_stmt_execute($statement);
    
                    $result = mysqli_stmt_get_result($statement);
                    $count = mysqli_num_rows($result);
                    if($count == 1){
                        while($rowf = mysqli_fetch_assoc($result)){//using while loop to loop through n display all search results
                            $_SESSION['id'] = $rowf['pkgId'];
                            ?>
                            <div class="b" id="b">
                            <form action="editRecord2.php" method="post" onsubmit = "return validation3()">

                            <span id="errorAll3" class="errorAll3" style="font-weight:bold;color:#FE852B;"></span><br>

                                    <!-- <label for="edit">Package Id</label><br>
                                    <input name= "edit" class= "edit" id= "edit" placeholder= "<?php  //echo $rowf['flightId']; ?>"><br><br> -->
                                    <label for="pkgName">Package Name<br></label><br>
                                    <input name= "pkgName" class= "edit" id= "pkgName" placeholder= "<?php  echo $rowf['pkgName']; ?>"><br><br>

                                    <label for="pricePerPerson">Price Per Person</label><br>
                                    <input name= "pricePerPerson" class= "edit" id= "pricePerPerson" placeholder= "<?php  echo $rowf['pricePerPerson']; ?>"><br><br>

                                    <label for="category">Category <br><i>Input either solo, food or mobility</i></label><br>
                                    <input name= "category" class= "edit" id= "category" placeholder= "<?php  echo $rowf['category']; ?>"><br><br>

                                    <!-- <input name= "edit" class= "edit" id= "edit" placeholder= "<?php // echo $rowf['created_at']; ?>"><br><br> -->
                                    <label for="ratings">Ratings</label><br>
                                    <input name= "ratings" class= "edit" id= "ratings" placeholder= "<?php  echo $rowf['ratings']; ?>"><br><br>
                                    
                                    <label for="description">Description</label><br>
                                    <input name= "description" class= "edit" id= "description" placeholder= "<?php  echo $rowf['description']; ?>"><br><br>

                                    <label for="location">Location</label><br>
                                    <input name= "location" class= "edit" id= "location" placeholder= "<?php  echo $rowf['location']; ?>"><br><br>
                            
                                <?php
                        
                                ?>
                                    <button class="update" id="p" name="updatep">UPDATE</button><br><br>
                                </form>
                            </div>
                            <?php
                        }
                    }else{
                        ?>
                            <script> alert("Sorry, the record cannot be found!")</script>
                        <?php
                    }
                }
            }
                
        ?>
    <script>
            function validation(){
                var producttype = document.getElementById('producttype').value;
                var pid = document.getElementById('pid').value;

                // if empty
                if(producttype == "" || pid == ""){
                    document.getElementById('error').innerHTML = "Both fields are required!";
                    return false;
                }
                // if pid isNaN
                if(isNaN(pid)){
                    document.getElementById('error').innerHTML = "Product id can only be a number!";
                    return false;
                }else{
                    document.getElementById('error').innerHTML ="";
                }
            }
            function validation1(){//flights
                // if empty category, origin, destination, airline, price, departDate
                // If price isNan
                // if category, origin, destination, airline isNan
                // validate dates: depart...return, arrival
                // Fields that can be empty: return, arrival, layover, throughcity
                var category = document.getElementById('category').value;
                var origin = document.getElementById('origin').value;
                var destination = document.getElementById('destination').value;
                var airline = document.getElementById('airline').value;
                var price = document.getElementById('price').value;
                var departDate = document.getElementById('departDate').value;
                var arrivalDate = document.getElementById('arrivalDate').value;
                var returnDate = document.getElementById('returnDate').value;
                var layover = document.getElementById('layover').value;
                var throughcity = document.getElementById('throughcity').value;

                var arrdepart = departDate.split("-");
                var arrreturn = returnDate.split("-");
                var arrarrival = arrivalDate.split("-");

                var currentDate = new Date();
                currentDate.setHours(0,0,0,0);

                setdDate = new Date(departDate);
                setrDate = new Date(returnDate);
                setaDate = new Date(arrivalDate);
                // test .trim() - trim is working
                // , test echo setradDate()....will test later checking also with moment();  
                // test date validations...all validations are working
                
                
                // if empty
                if(category == "" || origin == "" || destination == "" || airline == "" || price == "" || departDate == ""){
                    document.getElementById('errorAll').innerHTML = "The fields Category, Origin, Destination, Airline, Depart Date and Price are required!";
                    return false;
                }
                if (!isNaN(category) || !isNaN(origin) || !isNaN(destination) || !isNaN(airline)){
                    document.getElementById('errorAll').innerHTML = "Only letters expected for category, origin, destination and airline!";
                    return false;
                }

                //throughcity
                if(throughcity.trim() !== "" && !isNaN(throughcity)){
                    document.getElementById('errorAll').innerHTML = "Only letters expected for throughcity!";
                    return false;
                }else{
                    document.getElementById('errorAll').innerHTML = "";   
                }

                // Depart Date
                if(departDate.indexOf("-") == -1){//checking if "-" exists in the input
                    document.getElementById("errorAll").innerHTML = "Depart Date format must be in the form: yyyy-mm-dd!";
                    return false;
                }
                if(setdDate < currentDate )  {
                    document.getElementById("errorAll").innerHTML = "Depart date cannot be earlier than today's date";
                    return false;
                }
                // checking the length of the arrays of substrings produced after using the split method on departDate
                if(arrdepart[0].length !== 4 || arrdepart[1].length !== 2 || arrdepart[2].length !== 2){
                    document.getElementById("errorAll").innerHTML = "Depart Date format must be in the form: yyyy-mm-dd!";
                    return false;
                }

                // If price isNaN
                if (isNaN(price)){
                    document.getElementById('errorAll').innerHTML = "Only numbers expected for Price";
                    return false;
                }

                // Validate return and arrival Dates
                if( returnDate !== "" && returnDate.indexOf("-") == -1){//checking if "-" exists in the input
                    document.getElementById("errorAll").innerHTML = "Return Date format must be in the form: yyyy-mm-dd!";
                    return false;
                }
                // checking the length of the arrays of substrings produced after using the split method on departDate
                if(returnDate !== "" && arrreturn[0].length !== 4 || arrreturn[1].length !== 2 || arrreturn[2].length !== 2){
                    document.getElementById("errorAll").innerHTML = "Return Date format must be in the form: yyyy-mm-dd!";
                    return false;
                }
                 //If return date is less than today and if it is less than depart date
                 if(setrDate < currentDate || setrDate < setdDate) {
                    document.getElementById("errorAll").innerHTML = "Return Date cannot be earlier than today's date or depart date";
                    return false;
                }
                
                if( arrivalDate !== "" && arrivalDate.indexOf("-") == -1){//checking if "-" exists in the input
                    document.getElementById("errorAll").innerHTML = "Arrival Date format must be in the form: yyyy-mm-dd!";
                    return false;
                }
                // checking the length of the arrays of substrings produced after using the split method on departDate
                if(arrivalDate !== "" && arrarrival[0].length !== 4 || arrarrival[1].length !== 2 || arrarrival[2].length !== 2){
                    document.getElementById("errorAll").innerHTML = "Arrival Date format must be in the form: yyyy-mm-dd!";
                    return false;
                }
                //If return date is less than today and if it is less than depart date
                if(setaDate < currentDate || setaDate < setdDate) {
                    document.getElementById("errorAll").innerHTML = "Arrival Date cannot be earlier than today's date or depart date";
                    return false;
                }else{
                    document.getElementById("errorAll").innerHTML = "";

                }
            }
            // -------------------------------------------------------------------------------------------------
            function validation2(){//accommodation
                var accommName = document.getElementById('accommName').value;
                var noOfRooms = document.getElementById('noOfRooms').value;
                var pricePerNight = document.getElementById('pricePerNight').value;
                var ratings = document.getElementById('ratings').value;
                var description = document.getElementById('description').value;
                var location = document.getElementById('location').value;
                var accommType = document.getElementById('accommType').value;

                if (accommName.trim() == "" || noOfRooms.trim() == "" || pricePerNight.trim() == "" || 
                    description.trim() == "" || location.trim() == "" || accommType.trim() == ""){
                        document.getElementById('errorAll2').innerHTML = "The fields Accommodation Name, Number Of Rooms, Price Per Night, Description, Location and Accommodation Type cannot be empty!";
                        return false;
                    }
                if(isNaN(noOfRooms) || isNaN(pricePerNight)){
                    document.getElementById('errorAll2').innerHTML = "Only numbers expected for Price Per Night and Number Of Rooms!";
                    return false;
                }
                else{
                    document.getElementById('errorAll2').innerHTML = "";
                }
            }
            // ---------------------------------------------------------------------------------------------------
            function validation3(){//packages
                var pkgName = document.getElementById('pkgName').value;
                var pricePerPerson = document.getElementById('pricePerPerson').value;
                var category = document.getElementById('category').value;
                var ratings = document.getElementById('ratings').value;
                var description = document.getElementById('description').value;
                var location = document.getElementById('pkgName').value;

                if(pkgName.trim() == "" || pricePerPerson.trim() == "" || category.trim() == "" ||
                    description.trim() == "" || location.trim() == ""){
                        document.getElementById('errorAll3').innerHTML = "The fields Package Name, Price Per Person, Category, Description and location cannot be empty!";
                        return false;
                }
                if(isNaN(pricePerPerson)){
                    document.getElementById('errorAll3').innerHTML = "Only numbers expected for Price Per Person!";
                    return false;
                }else{
                    document.getElementById('errorAll3').innerHTML = "";
                }
            }
        </script>
    <?php 
        include 'footer.php';
    ?>
