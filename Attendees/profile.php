<?php 
    include_once('topnav.php');
    include('./helpers/DbHelpers.php');
    if (!isset($_SESSION['id'])) {
        header('Location: ./login.php?error=error');
    }
    if (isset($_GET['error'])) {
        if($_GET['error']== "empty") {
        echo "<p class='err'>No such email exists</p>";
        }if($_GET['error']== "notsaved") {
            echo "<p class='err' style='font-size: 24px;'>Not saved</p>";
            }
    }
    
    $profile = mysqli_fetch_assoc($db_helpers->getSpecifics('employees', $_SESSION['id']));
?>
        <div class="profile">
            <form action="./auth/changeProfile.php" method="POST">
                <div class="container">

                    <div class="item">
                        <div class="item">
                            <label for="firstname"> First Name</label><br>
                            <input type="text" name="firstname" value="<?= $profile['fName']?>" disabled/><br>
                        </div>
                        <div class="item">
                            <label for="othernames"> Other Names</label><br>
                            <input type="text" name="othernames" value="<?= $profile['mName'] . ' '. $profile['lName']?>" disabled/><br>
                        </div>
                        <div class="item">
                            <label for="email"> Email</label><br>
                            <input type="text" name="email" value="<?= $profile['email']?>" disabled/><br>
                        </div>
                        <div class="item">
                            <label for="address"> Address</label><br>
                            <input type="text" name="address" value="<?= $profile['address']?>" disabled/><br>
                        </div>
                        <div class="item">
                            <label for="phone"> Phone</label><br>
                            <input type="text" name="Phone" value="<?= $profile['phone']?>" disabled/><br>
                        </div>                                      
                    </div>

                    <div class="item">
                        <div class="item">
                            <label for="gender"> Gender </label><br>
                            <input type="text" name="gender" value="<?= $profile['gender']?>" disabled/><br>
                        </div>
                        <div class="item">
                            <label for="dateofbirth"> Date of Birth </label><br>
                            <input type="text" name="dateofbirth" value="<?= $profile['dob']?>" disabled/><br>
                        </div>
                        <div class="item">
                            <label for="nationalid"> National Id </label><br>
                            <input type="text" id="nationalid" name="nationalid" value="<?= $profile['natid']?>" onmouseout="valNatID()"/><br>
                        </div>
                        <div class="item">
                            <label for="kinname"> Next of Kin: Fullname</label><br>
                            <input type="text" name="kinname" value="<?= $profile['kinDetails']?>" disabled/><br>
                        </div> 
                        <div style="width: 20%;margin-right: 70%;">
                            <button type="submit" class="yellowBtn" name="save">save</button>
                        </div>   
                                
                    </div>

                    <div class="item">
                        <div class="item">
                            <label for="kinphone"> Next of Kin: Phone</label><br>
                            <input type="text" name="kinphone" value="<?= $profile['kphone']?>" disabled/><br>
                        </div>
                        <div class ="item"> 
                            <label for="employee id"> Employee ID</label><br>
                            <input type="text" name="empid" id="empid" value="<?= $profile['empID']?>"/><br>
                        </div>
                        <div class="item">
                            <label for="department"> Department</label><br>
                            <input type="text" name="department" value="<?= $profile['department']?>" disabled/><br>
                        </div>
                        <div class="item">
                            <label for="position"> Position</label><br>
                            <input type="text" name="position" value="<?= $profile['role']?>" disabled/><br>
                        </div>
                        <div class="item">
                            <label for="password"> Password</label><br>
                            <input type="password" name="password" value="<?= $profile['password']?>" disabled/><br>
                        </div>
                    </div>
                    
                </div>         
            </form>
        </div>
        <script>
            //change nav and background colour according to the pages
            document.getElementsByTagName.innerHTML = window.confirmationStyle();
            function confirmationStyle () {
                document.body.style.backgroundColor = "#015351";
                document.getElementById("nav-title").textContent = "User Profile ";
                document.getElementById("nav-title").style.color = "#ffff";
                document.getElementById("dd-content").style.backgroundColor = "#FC9E01";
                document.getElementById("dd-content").style.color = "#015351";
                document.getElementById("user_name").style.color = "#015351";

            };

            function back(){
                window.history.back();
            };

            function closeNav () {
                document.querySelector(".dd-content").style.display = "none";
            };

            function openNav () {
                document.querySelector("#dd-content").style.display = "block";
            };

        </script>
        <script>
            function valNatID(){
                var natid= document.getElementById("nationalid").value();
                if( natid==""){
                    alert("What is your ID number");
                    document.getElementById("nationalid").focus();
                    return false;
                }
                if (id.length<7||id.length>8){
                   alert("Enter valid ID number");
                   document.getElementById("nationalid").focus();
                   return false;
               }
            }
        </script>
    </body>
</html>