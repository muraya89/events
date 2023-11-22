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
    .container, form{
        text-align:center;
    }
    .container a{
        text-decoration:none;
        color:#FE852B;
    }
    label{
        color: #0038a8;
    }
    .a input, input::placeholder{
        color:#FE852B;
        text-align:center; 
    }
    input{
        border: 1px solid #FE852B;
    }
    .productType{
        text-align:center;
        background-color:#0038a8;
    }
    .productType button{
        border: 2px solid #FE852B;
        border-radius:5px;
        padding:10px;
        /* background-color:#FE852B; */
        color:#0038a8;

    }
    .insertbtn{
        border: 2px solid #FE852B;
        /* border-radius:5px; */
        /* padding:10px; */
        background-color:#FE852B;
        color:white;
    }
    @media all and (min-width:320px) and (max-width:2560px){
        .productType{
            margin:10px;
            padding:20px 0px;
        }
        .productType button{
            margin:10px;
        }
    }
    @media all and (min-width:897px) and (max-width:1024px){
        .container a, label, input, span{ font-size: 20px; }
    }
    @media all and (min-width:1025px) and (max-width:1232px){
        .container a, label, input, span{ font-size: 22px; }
    }
    @media all and (min-width:1233px) and (max-width:2560px){
        .container a, label, input, span{ font-size: 24px; }
        input{ border: 1.5px solid #FE852B; }
        .insertbtn{ font-size: 24px; padding: 10px 15px;}
    }
    @media all and (min-width:1441px) and (max-width:2000px){
        .container a, label, input, span{ font-size: 28px; }
        .productType button{
            padding: 20px;
            font-size: 28px;
        }
    }
    @media all and (min-width:2001px) and (max-width:2560px){
        .container a, label, input, span{ font-size: 36px; }
        .productType button{
            padding: 20px;
            font-size: 32px;
        }
        input{ border: 2px solid #FE852B; }
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
        <form  class="productType" action = "insertRecord.php" method = "post">
            <button class = "accommbtn" name = "accommbtn" id = "accommbtn">Accommodation</button><br>
            <button class = "pkgbtn" name = "pkgbtn" id = "pkgbtn">Packages</button><br>
            <button class = "flightsbtn" name = "flightsbtn" id = "flightsbtn">Flights</button><br>
        </form>
    </div><br>

        <?php 
        if(isset($_POST['flightsbtn'])){ 
                // Prepared stmt to insert flight records
                $sql=mysqli_query($conn,"SELECT * FROM flights");
                if(mysqli_num_rows($sql)==0)
                {
                    echo "Sorry, we encountered an error displaying the fields!";
                }
                else
                {
                    ?>
                    <div class="b" id="b">
                    <form action="insertRecord2.php" method="post" onsubmit = "return validation1()">

                    <span id="errorAll" class="errorAll" style="font-weight:bold;color:#FE852B;"></span><br>

                        <!-- <label for="edit">Flight Id</label><br>
                        <input name= "edit" class= "insert" id= "edit" placeholder= "<?php  //echo $rowf['flightId']; ?>"><br><br> -->
                        <label for="category">Category: <br><i>Input either oneway, roundtrip or multicity</i></label><br>
                        <input name= "category" class= "insert" id= "category"><br><br>

                        <label for="origin">Origin</label><br>
                        <input name= "origin" class= "insert" id= "origin"><br><br>

                        <label for="destination">Destination</label><br>
                        <input name= "destination" class= "insert" id= "destination"><br><br>

                        <!-- <input name= "edit" class= "insert" id= "edit" placeholder= "<?php // echo $rowf['created_at']; ?>"><br><br> -->
                        <label for="airline">Airline</label><br>
                        <input name= "airline" class= "insert" id= "airline"><br><br>

                        <label for="departDate">Depart Date</label><br>
                        <input name= "departDate" class= "insert" id= "departDate" placeholder= "yyyy-mm-dd"><br><br>

                        <label for="price">Price</label><br>
                        <input name= "price" class= "insert" id= "price"><br><br>

                        <label for="returnDate">Return Date</label><br>
                        <input name= "returnDate" class= "insert" id= "returnDate" placeholder= "yyyy-mm-dd"><br><br>

                        <label for="arrivalDate">Arrival Date</label><br>
                        <input name= "arrivalDate" class= "insert" id= "arrivalDate" placeholder= "yyyy-mm-dd"><br><br>

                        <label for="layover">Layover</label><br>
                        <input name= "layover" class= "insert" id= "layover"><br><br>

                        <label for="throughcity">Through-city</label><br>
                        <input name= "throughcity" class= "insert" id= "throughcity"><br><br> 
                    
                        <?php
                
                        ?>
                            <button class="insertbtn" id="f" name="insertf">INSERT</button><br><br>
                        </form>
                    </div>
                    <?php
                    }
                }
            // --------------------------------------------------------------------------------------
            if(isset($_POST['accommbtn'])){ 
                // Prepared stmt to insert flight records
                $sql=mysqli_query($conn,"SELECT * FROM accommodation");
                if(mysqli_num_rows($sql)==0)
                {
                    echo "Sorry, we encountered an error displaying the fields!";
                }
                else
                {
                    ?>
                    <div class="b" id="b">
                    <form action="insertRecord2.php" method="post" onsubmit = "return validation2()">

                    <span id="errorAll2" class="errorAll2" style="font-weight:bold;color:#FE852B;"></span><br>

                            <!-- <label for="edit">Accommodation Id</label><br>
                            <input name= "edit" class= "insert" id= "edit" placeholder= "<?php  //echo $rowf['accommId']; ?>"><br><br> -->
                            <label for="accommName">Accommodation Name<br></label><br>
                            <input name= "accommName" class= "insert" id= "accommName"><br><br>

                            <label for="noOfRooms">Number of Rooms</label><br>
                            <input name= "noOfRooms" class= "insert" id= "noOfRooms"><br><br>

                            <label for="pricePerNight">Price Per Night</label><br>
                            <input name= "pricePerNight" class= "insert" id= "pricePerNight"><br><br>

                            <!-- <input name= "edit" class= "insert" id= "edit" placeholder= "<?php // echo $rowf['created_at']; ?>"><br><br> -->
                            <label for="ratings">Ratings</label><br>
                            <input name= "ratings" class= "insert" id= "ratings"><br><br>
                            
                            <label for="description">Description</label><br>
                            <input name= "description" class= "insert" id= "description"><br><br>

                            <label for="location">Location</label><br>
                            <input name= "location" class= "insert" id= "location"><br><br>

                            <label for="accommType">Accommodation Type: <br><i>Input either traditional hotel, airbnb or camping</i></label><br>
                            <input name= "accommType" class= "insert" id= "accommType"><br><br> 
                    
                        <?php
                
                        ?>
                            <button class="insertbtn" id="a" name="inserta">INSERT</button><br><br>
                        </form>
                    </div>
                    <?php
                    }
                }
            // ------------------------------------------------------------------------------------------------------
            if(isset($_POST['pkgbtn'])){ 
                // Prepared stmt to insert flight records
                $sql=mysqli_query($conn,"SELECT * FROM packages");
                if(mysqli_num_rows($sql)==0)
                {
                    echo "Sorry, we encountered an error displaying the fields!";
                }
                else
                {
                    ?>
                    <div class="b" id="b">
                    <form action="insertRecord2.php" method="post" onsubmit = "return validation3()">

                    <span id="errorAll3" class="errorAll3" style="font-weight:bold;color:#FE852B;"></span><br>

                            <!-- <label for="edit">Package Id</label><br>
                            <input name= "edit" class= "insert" id= "edit" placeholder= "<?php  //echo $rowf['flightId']; ?>"><br><br> -->
                            <label for="pkgName">Package Name<br></label><br>
                            <input name= "pkgName" class= "insert" id= "pkgName"><br><br>

                            <label for="pricePerPerson">Price Per Person</label><br>
                            <input name= "pricePerPerson" class= "insert" id= "pricePerPerson"><br><br>

                            <label for="category">Category <br><i>Input either solo, food or mobility</i></label><br>
                            <input name= "category" class= "insert" id= "category"><br><br>

                            <!-- <input name= "edit" class= "insert" id= "edit" placeholder= "<?php // echo $rowf['created_at']; ?>"><br><br> -->
                            <label for="ratings">Ratings</label><br>
                            <input name= "ratings" class= "insert" id= "ratings"><br><br>
                            
                            <label for="description">Description</label><br>
                            <input name= "description" class= "insert" id= "description"><br><br>

                            <label for="location">Location</label><br>
                            <input name= "location" class= "insert" id= "location"><br><br>
                    
                        <?php
                
                        ?>
                            <button class="insertbtn" id="p" name="insertp">INSERT</button><br><br>
                        </form>
                    </div>
                    <?php
                    }
                }
        ?>

        <script>
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

                // throughcity
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
                }else{
                    document.getElementById("errorAll").innerHTML = "";
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
            // -----------------------------------------------------------------------------------------------
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
            // --------------------------------------------------------------------------------------------------------
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
