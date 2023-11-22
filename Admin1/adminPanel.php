<?php
    session_start();
    include 'header.php';
    // echo $_SESSION['roleName'];

    // Confirming that the person accessing the page is admin
    $role = $_SESSION['roleName'];
    if($role == 'Admin'){
    ?>
        <script> 
            var username ='<?php echo $_SESSION['userName']; ?>';
            alert("Welcome, " + username);
        </script>
    <?php
        }else{
            header("Location: mainPage.php");
        }
?>
    <head>
        <style>
        table, th, td{
            border :1px solid red;
            /* padding:5px; */
            text-align:center;
        }
        @media all and (min-width:320px) and (max-width:2560px){
            body{
                align-items:center;
            }
            .container{
                width:50%;
                margin:auto;
                margin-top:50px;
                text-align: center;
                /* width:150px;
                height:150px; */
                display:grid;
            }
            .container a{
                text-decoration:none;
                background-color:#FE852B;
                color:white;
                padding:10px;
                border-radius:5px;
            }
            /* .container{
            margin:200px 100px;
            text-align:center;
            border: 1px solid red;
            width:150px;
            height:150px;
            }
            .container a{
                text-decoration:none;
                /* border: 2px solid #FE852B; *
                background-color:#FE852B;
                color:white;
                padding:5px;
                /* border-radius:5px; *
            }
            .container .view{
                padding:5px;
            } */
        }
        @media all and (min-width:597px) and (max-width:2560px){
            .container{
                background-color:#FE852B;
                padding:10px;
            }
            .container a{
                background-color:white;
                color:#0038a8;
                font-size: 20px;
            }
        }
        @media all and (min-width:1233px) and (max-width:2560px){
            .container a{ font-size: 25px; }
        }
        @media all and (min-width:1441px) and (max-width:2000px){
            .container a{ font-size: 28px; }
        }
        @media all and (min-width:2001px) and (max-width:2560px){
            .container a{ font-size: 30px; }
        }
        
            /* .productType{
                display:flex;
                justify-content: center;
            }
            input{border:none;color:#1034A6;}
            @media all and (min-width:320px) and (max-width:2560px){
                .flightType{margin:10px;}
                .flighttype{
                    margin-right:15px;
                    text-align:center;
                    border:none;
                }
            }
            @media all and (min-width:430px) and (max-width:2560px){
                input{padding:5px;}
            } */
        </style>
    </head>

    
    <body>
        <div class="container">
            <!-- Product Types -->
            <!-- <form class="productType" name="productType" action="adminServer.php" method="GET"> -->
            
            <!-- View tables -->
                <a  class="view" href="viewtbls.php">View Tables</a><br><br>
            <!-- Edit Record -->
                <a href="editRecord.php">Edit Record</a><br><br>
            <!-- Insert new record -->
                <a href="insertRecord.php">Add a New Record</a><br><br>
            <!-- Delete Record -->
                <a href="deleteRecord.php">Delete Record</a><br><br>
            <!-- Reports -->
                <a href="reports.php">Reports</a><br><br>
        </div>
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
</body>
    </html>
            

            


                <!-- <button class="btnflights" id="btnflights">Flights</button>
                <button class="btnpackages" id="btnpackages">Packages</button>
                <button class="btnrentals" id="btnrentals">Rentals</button>
                <button class="btndestinations" id="btndestinations">Destinations</button>
                <button class="btnusers" id="btnusers">Users</button> -->

                    <!-- <label for="producttype">Flights</label>
                    <input type="radio" class= "producttype"  id="producttype1" name="producttype" value="flight"><br>

                    <label for="producttype">Packages</label>
                    <input type="radio" class= "producttype" id="producttype2" name="producttype" value="packages"><br>

                    <label for="producttype">Rentals</label>
                    <input type="radio" class= "producttype" id="producttype3" name="producttype" value="rentals"><br>

                    <label for="producttype">Destination</label>
                    <input type="radio" class= "producttype" id="producttype3" name="producttype" value="destination"><br> -->
            <!-- </form><br>

            <form  name = "crud" class = "crud" id = "crud" action="adminCrud.php" method="GET"> 
                <input type="hidden" name="inputsearch" value="crudlink"/>
                <button name="btncrud" class="btncrud" id="btncrud">CRUD</button>
            </form>

            

            </div>
        </div> -->

<?php
    // include 'footer.php';
?> 