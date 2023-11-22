<?php
    // session is a way to temporarily store the user information on the server-side, 
    // whereas cookies store the information on the user's computer until it expires.
    include_once('../Attendees/topnav.php');
    include('../helpers/DbHelpers.php');

    // No access if not loggedIn
    // isset - checks if a variable has been set or declared 
    if(isset($_SESSION['id'])){
    ?>
        <script> 
            var username ='<?php echo $_SESSION['userName']; ?>';
            alert("Welcome, " + username);
        </script>
    <?php
    }else{
        header("Location: ../index.php");
    }
?>
    <head>
        <style>
            button{
                border:none;
                width:200px;
                height:200px;
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
</head>
            <p class="text1">Popular</p></br>
            <div class="popular">
                <form method = "GET" action = "landingAccomm.php">
                    <!-- Giraffe Manor -->
                    <button type = "submit" name = "accommbtn" class = "product1">
                        <?php
                            // Prepared statement to get all details of a specific accommId
                            // Create a template
                            $query = "SELECT * FROM accommodation WHERE accommId=?";
                            // mysqli_query() - is a ftn that passes a query against the db
                            mysqli_query($conn, $query);
                            // Initialize stmt object
                            $statement = mysqli_stmt_init($conn);
                            // Prepare stmt
                            $prep = mysqli_stmt_prepare($statement, $query);
                            $id = 5;
                            //Bind parameters
                            //Ftn that plugs/binds variables to a prepared stmt as parameters
                            //$statement = object rep the prepared stmt, "i"(integer) - a string specifying the types of variables expected
                            //$id = a variable rep the values to be passed where the ? is in the sql stmt
                            mysqli_stmt_bind_param($statement, "i", $id);
                            // Execute statement
                            mysqli_stmt_execute($statement);//Ftn that runs the previously prepared stmt in the db
            
                            //Get results and use it
                            //Ftn that accepts a stmt object as a parameter, retrieves result from the stmt if any & returns it
                            $result = mysqli_stmt_get_result($statement);
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                         
                        <input type="hidden" name="prdctId" value = "<?php $prdctId = $row['accommId'];  echo $prdctId;?>">
                        <p> <?php echo $row['accommName'];?> </p>
                        <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>
                        
                    
                <form method = "GET" action = "landingAccomm.php">
                    <!-- Sarova Salt Lick -->
                    <button type = "submit" name = "accommbtn" class="product2">
                        <?php
                            // The beginning of the prepared stmt is in pkgsprepstmt.php
                            //Bind parameters
                            $id = 4;
                            mysqli_stmt_bind_param($statement, "i", $id);
                            // Execute statement - run stmt in db
                            mysqli_stmt_execute($statement);
                            
                            //Get the results and use it
                            //mysqli_stmt_get_result() -Ftn that accepts a stmt object as a parameter, retrieves result from the stmt if any & returns it
                            $result = mysqli_stmt_get_result($statement);
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <input type="hidden" name="prdctId" value=" <?php $prdctId = $row['accommId'];  echo $prdctId; ?>">
                        <p> <?php echo $row['accommName'];?> </p>
                        <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>
                    
                <form method = "GET" action = "landingAccomm.php">
                    <!-- Kempinski**** -->
                    <button type = "submit" name = "accommbtn" class="product3">
                        <?php
                            // The beginning of the prepared stmt is in pkgsprepstmt.php
                            //Bind parameters
                            $id = 6;
                            mysqli_stmt_bind_param($statement, "i", $id);
                            // Execute statement - run stmt in db
                            mysqli_stmt_execute($statement);
                            
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            $result = mysqli_stmt_get_result($statement);
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <input type="hidden" name="prdctId" value = "<?php $prdctId = $row['accommId'];  echo $prdctId; ?>">
                        <p> <?php echo $row['accommName'];?> </p>
                        <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>

                <form method = "GET" action = "landingAccomm.php">
                    <!-- Watamu Tree House -->
                    <button type = "submit" name = "accommbtn" class="product4">
                        <?php
                            // The beginning of the prepared stmt is in pkgsprepstmt.php
                            //Bind parameters
                            $id = 7;
                            mysqli_stmt_bind_param($statement, "i", $id);
                            // Execute statement - run stmt in db
                            mysqli_stmt_execute($statement);
                            
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            $result = mysqli_stmt_get_result($statement);
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <input type="hidden" name="prdctId" value = " <?php $prdctId = $row['accommId'];  echo $prdctId;?>">
                        <p> <?php echo $row['accommName'];?> </p>
                        <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>
                  
                <form method = "GET" action = "landingAccomm.php">
                    <!-- Forodhani hse -->
                    <button type = "submit" name = "accommbtn" class="product5">
                        <?php
                            // The beginning of the prepared stmt is in pkgsprepstmt.php
                            //Bind parameters
                            $id = 8;
                            mysqli_stmt_bind_param($statement, "i", $id);
                            // Execute statement - run stmt in db
                            mysqli_stmt_execute($statement);
                            
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            $result = mysqli_stmt_get_result($statement);
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <input type="hidden" name="prdctId" value = " <?php $prdctId = $row['accommId'];  echo $prdctId; ?>">
                        <p> <?php echo $row['accommName'];?> </p>
                        <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>
                    
                <form method = "GET" action = "landingAccomm.php">
                    <!-- Mara Serena -->
                    <button type = "submit" name = "accommbtn" class="product6">
                        <?php
                            // The beginning of the prepared stmt is in pkgsprepstmt.php
                            //Bind parameters
                            $id = 13;
                            mysqli_stmt_bind_param($statement, "i", $id);
                            // Execute statement - run stmt in db
                            mysqli_stmt_execute($statement);
                            
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            $result = mysqli_stmt_get_result($statement);
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <input type="hidden" name="prdctId" value=" <?php $prdctId = $row['accommId'];  echo $prdctId; ?>">
                        <p> <?php echo $row['accommName'];?> </p>
                        <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>

                <form method = "GET" action = "landingAccomm.php">
                    <!-- Saruni Samburu -->
                    <button type = "submit" name = "accommbtn" class="product7">
                    <?php   
                            // The beginning of the prepared stmt is in pkgsprepstmt.php
                            //Bind parameters
                            $id = 14;
                            mysqli_stmt_bind_param($statement, "i", $id);
                            // Execute statement - run stmt in db
                            mysqli_stmt_execute($statement);
                            
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            $result = mysqli_stmt_get_result($statement);
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <input type="hidden" name="prdctId" value=" <?php $prdctId = $row['accommId'];  echo $prdctId; ?>">
                        <p> <?php echo $row['accommName'];?> </p>
                        <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>

                <form method = "GET" action = "landingAccomm.php">
                    <!-- Fairmont -->
                    <button type = "submit" name = "accommbtn" class="product8">
                    <?php
                            // The beginning of the prepared stmt is in pkgsprepstmt.php
                            //Bind parameters
                            $id = 16;
                            mysqli_stmt_bind_param($statement, "i", $id);
                            // Execute statement - run stmt in db
                            mysqli_stmt_execute($statement);
                            
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            $result = mysqli_stmt_get_result($statement);
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <input type="hidden" name="prdctId" value=" <?php $prdctId = $row['accommId'];  echo $prdctId; ?>">
                        <p> <?php echo $row['accommName'];?> </p>
                        <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>

                <form method = "GET" action = "landingAccomm.php">
                    <!-- Elsa's Kopje -->
                    <button type = "submit" name = "accommbtn" class="product9">
                    <?php
                            // The beginning of the prepared stmt is in pkgsprepstmt.php
                            //Bind parameters
                            $id = 17;
                            mysqli_stmt_bind_param($statement, "i", $id);
                            // Execute statement - run stmt in db
                            mysqli_stmt_execute($statement);
                            
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            $result = mysqli_stmt_get_result($statement);
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <input type="hidden" name="prdctId" value=" <?php $prdctId = $row['accommId'];  echo $prdctId; ?>">
                        <p> <?php echo $row['accommName'];?> </p>
                        <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>

                <form method = "GET" action = "landingAccomm.php">
                    <!-- Punda Milias Camp -->
                    <button type = "submit" name = "accommbtn" class="product10">
                    <?php
                            // The beginning of the prepared stmt is in pkgsprepstmt.php
                            //Bind parameters
                            $id = 15;
                            mysqli_stmt_bind_param($statement, "i", $id);
                            // Execute statement - run stmt in db
                            mysqli_stmt_execute($statement);

                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            $result = mysqli_stmt_get_result($statement);
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <input type="hidden" name="prdctId" value=" <?php $prdctId = $row['accommId'];  echo $prdctId; ?>">
                        <p> <?php echo $row['accommName'];?> </p>
                        <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>
            </div>
            

            <!-- Recommended prdct list ******************************************************************************** -->
            <p class="text2">Recommended</p>
            <div class="recommended">
                <form method = "GET" action = "landingAccomm.php">
                    <!-- Oloiden -->
                    <button type = "submit" name = "accommbtn" class="product11">
                        <?php
                            // The beginning of the prepared stmt is in pkgsprepstmt.php
                            //Bind parameters
                            $id = 18;
                            mysqli_stmt_bind_param($statement, "i", $id);
                            // Execute statement - run stmt in db
                            mysqli_stmt_execute($statement);
                            
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            $result = mysqli_stmt_get_result($statement);
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <input type="hidden" name="prdctId" value=" <?php $prdctId = $row['accommId'];  echo $prdctId; ?>">
                        <p> <?php echo $row['accommName'];?> </p>
                        <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>

                <form method = "GET" action = "landingAccomm.php">
                    <!-- Fourpoints -->
                    <button type = "submit" name = "accommbtn" class="product12">
                        <?php
                            // The beginning of the prepared stmt is in pkgsprepstmt.php
                            //Bind parameters
                            $id = 19;
                            mysqli_stmt_bind_param($statement, "i", $id);
                            // Execute statement - run stmt in db
                            mysqli_stmt_execute($statement);

                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            $result = mysqli_stmt_get_result($statement);
                            // function fetches a result row as an associative array
                            // associative arrays - are an abstract data type that use named keys that you assign to them
                            while($row = mysqli_fetch_assoc($result)){
                        ?>
                        <input type="hidden" name="prdctId" value=" <?php $prdctId = $row['accommId'];  echo $prdctId; ?>">
                        <p> <?php echo $row['accommName'];?> </p>
                        <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>

                <form method = "GET" action = "landingAccomm.php">
                    <!-- Sanakara -->
                    <button type = "submit" name = "accommbtn" class="product13">
                    <?php
                                // The beginning of the prepared stmt is in pkgsprepstmt.php
                                //Bind parameters
                                $id = 20;
                                mysqli_stmt_bind_param($statement, "i", $id);
                                // Execute statement - run stmt in db
                                mysqli_stmt_execute($statement);

                                // function fetches a result row as an associative array
                                // associative arrays - are an abstract data type that use named keys that you assign to them
                                $result = mysqli_stmt_get_result($statement);
                                // function fetches a result row as an associative array
                                // associative arrays - are an abstract data type that use named keys that you assign to them
                                while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <input type="hidden" name="prdctId" value=" <?php $prdctId = $row['accommId'];  echo $prdctId; ?>">
                            <p> <?php echo $row['accommName'];?> </p>
                            <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>

                <form method = "GET" action = "landingAccomm.php">
                    <!-- Jambo mutara -->
                    <button type = "submit" name = "accommbtn" class="product14">
                    <?php
                                // The beginning of the prepared stmt is in pkgsprepstmt.php
                                //Bind parameters
                                $id = 21;
                                mysqli_stmt_bind_param($statement, "i", $id);
                                // Execute statement - run stmt in db
                                mysqli_stmt_execute($statement);

                                // function fetches a result row as an associative array
                                // associative arrays - are an abstract data type that use named keys that you assign to them
                                $result = mysqli_stmt_get_result($statement);
                                // function fetches a result row as an associative array
                                // associative arrays - are an abstract data type that use named keys that you assign to them
                                while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <input type="hidden" name="prdctId" value=" <?php $prdctId = $row['accommId'];  echo $prdctId; ?>">
                            <p> <?php echo $row['accommName'];?> </p>
                            <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>

                <form method = "GET" action = "landingAccomm.php">
                    <!-- Hemingways -->
                    <button type = "submit" name = "accommbtn" class="product15">
                    <?php
                                // The beginning of the prepared stmt is in pkgsprepstmt.php
                                //Bind parameters
                                $id = 22;
                                mysqli_stmt_bind_param($statement, "i", $id);
                                // Execute statement - run stmt in db
                                mysqli_stmt_execute($statement);

                                // function fetches a result row as an associative array
                                // associative arrays - are an abstract data type that use named keys that you assign to them
                                $result = mysqli_stmt_get_result($statement);
                                // function fetches a result row as an associative array
                                // associative arrays - are an abstract data type that use named keys that you assign to them
                                while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <input type="hidden" name="prdctId" value=" <?php $prdctId = $row['accommId'];  echo $prdctId; ?>">
                            <p> <?php echo $row['accommName'];?> </p>
                            <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>

                <form method = "GET" action = "landingAccomm.php">
                    <!-- Voyager Ziwani -->
                    <button type = "submit" name = "accommbtn" class="product16">
                    <?php
                                // The beginning of the prepared stmt is in pkgsprepstmt.php
                                //Bind parameters
                                $id = 23;
                                mysqli_stmt_bind_param($statement, "i", $id);
                                // Execute statement - run stmt in db
                                mysqli_stmt_execute($statement);

                                // function fetches a result row as an associative array
                                // associative arrays - are an abstract data type that use named keys that you assign to them
                                $result = mysqli_stmt_get_result($statement);
                                // function fetches a result row as an associative array
                                // associative arrays - are an abstract data type that use named keys that you assign to them
                                while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <input type="hidden" name="prdctId" value=" <?php $prdctId = $row['accommId'];  echo $prdctId;?>">
                            <p> <?php echo $row['accommName'];?> </p>
                            <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>

                <form method = "GET" action = "landingAccomm.php">
                    <!-- Leopard Hill -->
                    <button type = "submit" name = "accommbtn" class="product17">
                    <?php
                                // The beginning of the prepared stmt is in pkgsprepstmt.php
                                //Bind parameters
                                $id = 24;
                                mysqli_stmt_bind_param($statement, "i", $id);
                                // Execute statement - run stmt in db
                                mysqli_stmt_execute($statement);

                                // function fetches a result row as an associative array
                                // associative arrays - are an abstract data type that use named keys that you assign to them
                                $result = mysqli_stmt_get_result($statement);
                                // function fetches a result row as an associative array
                                // associative arrays - are an abstract data type that use named keys that you assign to them
                                while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <input type="hidden" name="prdctId" value=" <?php $prdctId = $row['accommId'];  echo $prdctId;?>">
                            <p> <?php echo $row['accommName'];?> </p>
                            <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>

                <form method = "GET" action = "landingAccomm.php">
                    <!-- Radisson -->
                    <button type = "submit" name = "accommbtn" class="product18">
                    <?php
                                // The beginning of the prepared stmt is in pkgsprepstmt.php
                                //Bind parameters
                                $id = 25;
                                mysqli_stmt_bind_param($statement, "i", $id);
                                // Execute statement - run stmt in db
                                mysqli_stmt_execute($statement);

                                // function fetches a result row as an associative array
                                // associative arrays - are an abstract data type that use named keys that you assign to them
                                $result = mysqli_stmt_get_result($statement);
                                // function fetches a result row as an associative array
                                // associative arrays - are an abstract data type that use named keys that you assign to them
                                while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <input type="hidden" name="prdctId" value=" <?php $prdctId = $row['accommId'];  echo $prdctId; ?>">
                            <p> <?php echo $row['accommName'];?> </p>
                            <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>

                <form method = "GET" action = "landingAccomm.php">
                    <!-- EnglishPoint Marina -->
                    <button type = "submit" name = "accommbtn" class="product19">
                    <?php
                                // The beginning of the prepared stmt is in pkgsprepstmt.php
                                //Bind parameters
                                $id = 26;
                                mysqli_stmt_bind_param($statement, "i", $id);
                                // Execute statement - run stmt in db
                                mysqli_stmt_execute($statement);

                                // function fetches a result row as an associative array
                                // associative arrays - are an abstract data type that use named keys that you assign to them
                                $result = mysqli_stmt_get_result($statement);
                                // function fetches a result row as an associative array
                                // associative arrays - are an abstract data type that use named keys that you assign to them
                                while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <input type="hidden" name="prdctId" value=" <?php $prdctId = $row['accommId'];  echo $prdctId; ?>">
                            <p> <?php echo $row['accommName'];?> </p>
                            <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>

                <form method = "GET" action = "landingAccomm.php">
                    <!-- The lofts kilimani -->
                    <button type = "submit" name = "accommbtn" class="product20">
                    <?php
                                // The beginning of the prepared stmt is in pkgsprepstmt.php
                                //Bind parameters
                                $id = 27;
                                mysqli_stmt_bind_param($statement, "i", $id);
                                // Execute statement - run stmt in db
                                mysqli_stmt_execute($statement);

                                // function fetches a result row as an associative array
                                // associative arrays - are an abstract data type that use named keys that you assign to them
                                $result = mysqli_stmt_get_result($statement);
                                // function fetches a result row as an associative array
                                // associative arrays - are an abstract data type that use named keys that you assign to them
                                while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <input type="hidden" name="prdctId" value=" <?php $prdctId = $row['accommId'];  echo $prdctId; ?>">
                            <p> <?php echo $row['accommName'];?> </p>
                            <p> <?php echo $row['location'];}?> </p>
                    </button>
                </form>
            </div><br>
<?php
    include 'footer.php';
?>

       