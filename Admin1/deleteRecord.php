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
    .container, form, .b{
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
    .deletebtn{
        border: 2px solid #FE852B;
        /* border-radius:5px; */
        /* padding:10px; */
        background-color:#FE852B;
        color:white;
    }
    .b p{
        color: #0038a8;
    }
    .no{
        background-color: #0038a8;
        color:white;
        border: none;
        padding:10px;
        margin:10px;
    }
    .yes{
        background-color:#FE852B;
        color:white;
        border: none;
        padding:10px;
        margin:10px;
    }
    input{
        border: 1px solid #0038a8;
    }
    @media all and (min-width:597px) and (max-width:896px){
        input{ padding:10px 5px; }
    }
    @media all and (min-width:897px) and (max-width:2560px){
        .container a, label, input, span, .b p, .deletebtn{ font-size: 20px; }
        input{ padding:10px 5px; }
        .deletebtn{ padding: 5px 10px; }

    }
    @media all and (min-width:1025px) and (max-width:2560px){
        .container a, label, input, span, .b p, .deletebtn{ font-size: 22px; }
        input{ padding:10px 5px; }
        .yes, .no{ padding: 5px 10px; }
    }
    @media all and (min-width:1233px) and (max-width:1440px){
        .container a, label, input, span, .b p, .deletebtn{ font-size: 24px; }
        .yes, .no{ padding: 8px 13px; }
    }
    @media all and (min-width:1441px) and (max-width:2000px){
        .container a, label, input, span, .b p, .deletebtn{ font-size: 28px; }
        .yes, .no, .deletebtn{ padding: 10px 15px; }
    }
    @media all and (min-width:2001px) and (max-width:2560px){
        .container a, label, input, span, .b p, .deletebtn, .yes, .no{ font-size: 38px; }
        .yes, .no, .deletebtn{ padding: 15px 20px; }
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
        <a href="viewtbls.php">View Tables</a><span style="color:#0038a8;" ><b> | </b></span>
        <!-- Edit Record -->
        <a href="editRecord.php">Edit Record</a><span style="color:#0038a8;"><b> | </b></span>
        <!-- Insert new record -->
        <a href="insertRecord.php">Add a New Record</a><span style="color:#0038a8;"><b> | </b></span>
        <!-- Delete Record -->
        <a href="deleteRecord.php">Delete Record</a><span style="color:#0038a8;"><b> | </b></span>
        <!-- Reports -->
        <a href="reports.php">Reports</a><br><br>
    </div>


    <div class="a" id="a">
    <form action = "deleteRecord.php" method = "post" onsubmit = "return validation()">
        <label for="producttype">Product Type: <br><i>flights, packages, accommodation</i></label><br><br>
        <input type="text" class= "producttype"  id="producttype" name="producttype" placeholder="Eg: flights"><br><br>

        <span id="error" class="error" style="font-weight:bold;color:#FE852B;"></span><br><br>

        <label for="pid">Product Id: <br><i>flightId, pkgsId, accommId</i></label><br><br>
        <input type="text" name="pid" class="pid" id="pid" placeholder="Eg: 3"><br><br>
        
        <button class = "deletebtn" name = "deletebtn" id = "deletebtn">DELETE</button><br>
    </form>
    </div><br>

        <?php
            //  $product = $id = "";

            if(isset($_POST['deletebtn'])){ 
                $product = filter_input(INPUT_POST, 'producttype');
                $id = filter_input(INPUT_POST, 'pid');
            


                ?>
                <!-- Hide div a -->
                <script type="text/javascript">
                    var a = document.getElementById('a');
                    a.style.display = 'none';
                </script>
                <?php
    
                if( $product == 'flights'){
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
                                    <!-- <label for="flightid"></label>  -->
                                    <p><b>Flight Id:</b> <br><span style="color:#FE852B;"> <?php  echo $rowf['flightId']; ?> </span> </p>

                                    <!-- <label for="category"></label> -->
                                    <p><b>Category: </b> <br><span style="color:#FE852B;"> <?php  echo $rowf['category']; ?> </span></p>

                                    <!-- <label for="origin"></label> -->
                                    <p><b>Origin: </b> <br><span style="color:#FE852B;"> <?php  echo $rowf['origin']; ?> </span> </p>

                                    <!-- <label for="destination"></label> -->
                                    <p><b>Destination: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['destination']; ?> </span> </p>

                                    <!-- <label for="created_at"></label> -->
                                    <p><b>Created_at: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['created_at']; ?> </span> </p>

                                    <!-- <label for="airline"></label> -->
                                    <p><b>Airline: </b> <br><span style="color:#FE852B;"> <?php  echo $rowf['airline']; ?> </span> </p>

                                    <!-- <label for="departDate"></label> -->
                                    <p><b>Depart Date: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['departDate']; ?> </span> </p>

                                    <!-- <label for="price"></label> -->
                                    <p><b>Price: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['price']; ?> </span> </p>

                                    <!-- <label for="returnDate"></label>  -->
                                    <p><b>Return Date: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['returnDate']; ?> </span> </p>

                                    <!-- <label for="arrivalDate"></label> -->
                                    <p><b>Arrival Date: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['arrivalDate']; ?> </span> </p>

                                    <!-- <label for="layover"></label> -->
                                    <p><b>Layover: </b> <br><span style="color:#FE852B;"> <?php  echo $rowf['layover']; ?> </span></p>

                                    <!-- <label for="throughcity"></label> -->
                                    <p><b>Through-city: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['throughcity']; ?> </span> </p> 
                            
                                <?php
                        
                                ?>
                                <form action="deleteRecord2.php" method="post">
                                    <p style="font-weight:bold;color:#FE852B;"> <b>Are you sure you want to continue and delete this record?</b></p>
                                    <button class="yes" id="yes" name="yesf">YES</button>
                                    <button class="no" id="no" name="nof">NO</button>
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
            

                if( $product == 'accommodation'){
                    // Prepared stmt to get record of the entered flight Id
                    $queryf = "SELECT * FROM accommodation WHERE accommId = ?";
                    mysqli_query($conn, $queryf);
                    $statement = mysqli_stmt_init($conn);
                    $prep = mysqli_stmt_prepare($statement, $queryf);
                    mysqli_stmt_bind_param($statement, "i", $id);
                    mysqli_stmt_execute($statement);

                    $result = mysqli_stmt_get_result($statement);
                    $count = mysqli_num_rows($result);
                    if($count == 1){
                        while($rowf = mysqli_fetch_assoc($result)){//using while loop to loop through n display all search results
                            $_SESSION['id'] = $rowf['accommId'];
                            ?>
                            <div class="b" id="b">
                                    <!-- <label for="flightid"></label>  -->
                                    <p><b>Accommodation Id:</b> <br><span style="color:#FE852B;"> <?php  echo $rowf['accommId']; ?> </span> </p>

                                    <!-- <label for="category"></label> -->
                                    <p><b>Accommodation Name: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['accommName']; ?> </span></p>

                                    <!-- <label for="origin"></label> -->
                                    <p><b>Number Of Rooms: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['noOfRooms']; ?> </span> </p>

                                    <!-- <label for="destination"></label> -->
                                    <p><b>Price Per Night: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['pricePerNight']; ?> </span> </p>

                                    <!-- <label for="created_at"></label> -->
                                    <p><b>Created_at: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['created_at']; ?> </span> </p>

                                    <!-- <label for="airline"></label> -->
                                    <p><b>Description: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['description']; ?> </span> </p>

                                    <!-- <label for="departDate"></label> -->
                                    <p><b>Location </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['location']; ?> </span> </p>

                                    <!-- <label for="price"></label> -->
                                    <p><b>Accommodation Type: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['accommType']; ?> </span> </p> 
                            
                                <?php
                        
                                ?>
                                <form action="deleteRecord2.php" method="post">
                                    <p style="font-weight:bold;color:#FE852B;"> <b>Are you sure you want to continue and delete this record?</b></p>
                                    <button class="yes" id="yes" name="yesa">YES</button>
                                    <button class="no" id="no" name="noa">NO</button>
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
                if( $product == 'packages'){
                    // Prepared stmt to get record of the entered flight Id
                    $queryf = "SELECT * FROM packages WHERE pkgId = ?";
                    mysqli_query($conn, $queryf);
                    $statement = mysqli_stmt_init($conn);
                    $prep = mysqli_stmt_prepare($statement, $queryf);
                    mysqli_stmt_bind_param($statement, "i", $id);
                    mysqli_stmt_execute($statement);

                    $result = mysqli_stmt_get_result($statement);
                    $count = mysqli_num_rows($result);
                    if($count == 1){
                        while($rowf = mysqli_fetch_assoc($result)){//using while loop to loop through n display all search results
                            $_SESSION['id'] = $rowf['pkgId'];
                            ?>
                            <div class="b" id="b">
                                    <!-- <label for="flightid"></label>  -->
                                    <p><b>Package Id:</b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['pkgId']; ?> </span> </p>

                                    <!-- <label for="category"></label> -->
                                    <p><b>Package Name: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['pkgName']; ?> </span></p>

                                    <!-- <label for="destination"></label> -->
                                    <p><b>Price Per Person: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['pricePerPerson']; ?> </span> </p>

                                    <!-- <label for="created_at"></label> -->
                                    <p><b>Created_at: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['created_at']; ?> </span> </p>

                                    <!-- <label for="airline"></label> -->
                                    <p><b>Category: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['category']; ?> </span> </p>

                                    <!-- <label for="departDate"></label> -->
                                    <p><b>Location </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['location']; ?> </span> </p>

                                    <!-- <label for="price"></label> -->
                                    <p><b>Description: </b> <br> <span style="color:#FE852B;"> <?php  echo $rowf['description']; ?> </span> </p> 
                            
                                <?php
                        
                                ?>
                                <form action="deleteRecord2.php" method="post">
                                    <p style="font-weight:bold;color:#FE852B;"> <b>Are you sure you want to continue and delete this record?</b></p>
                                    <button class="yes" id="yes" name="yesp">YES</button>
                                    <button class="no" id="no" name="nop">NO</button>
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
        </script>
<?php
    include 'footer.php';
?>
