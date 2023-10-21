<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="./public/css/styles.css">
        <title>Forgot Password</title>
        <style>
            #body{
                font-size: 25px;
                margin: 10%;
            }
            .col{
                width: 100%;
            }
            .col input{
                border: 2px solid #FC9E01;
                padding: 5px 10px;
                margin: 30px 0px 20px 10px;
                position: inherit;
                background-color: transparent;
                width: 70%;
                height: 50px;
                color: white;
                font-size: 20px;
            }
            label{
                color: white;
            }
            form{
                margin: 5%;
            }
            .forgotpassword{
                margin-top: 3%;
                text-align: center;
            }
            h1{
                color: white;
            }
            .confirm{
                background-color: #FC9E01;
                padding: 10px 20px;
                border: none;
                font-size: 18px;
                width: 20%;
                /* height: 30%;             */
                color: #ffffff;
                margin: 5%;
            }
        </style>
    </head>
    <body>
        <div id="body">
            <form method="POST" action="./auth/forgotPassword.php" onsubmit= "return valFriend();">
                <div class="forgotpassword">
                    <h1>Forgot Password</h1>
                    <div class="container">
                        <div class="col">
                            <label for="email">Email</label><br>
                            <input type="text" id="email" name="email">
                            <?php
                                // create an error message if the user made an error
                                if (isset($_GET['error'])) {
                                    if($_GET['error']== "empty") {
                                    echo "<p class='err'>No such email exists</p>";
                                    }if($_GET['error']== "notsaved") {
                                        echo "<p class='err'>Not saved</p>";
                                        }
                                }
                            ?>
                        </div>
                        <div class="col" >
                            <label for="Who was your first friend">Who was your first friend?</label><br>
                            <input type="text" id="question" name="question">
                            <?php
                                // create an error message if the user made an error when trying to login
                                if (isset($_GET['error'])) {
                                    if ($_GET['error'] == "wrong") {
                                        echo "<p class='err'>wrong answer! Please try again</p>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                <button class="confirm" type="submit" name="firstFriend">CONFIRM </button>
                </div>
            </form>
        </div>
        <script>
            
            document.getElementsByTagName.innerHTML = window.confirmationStyle();
            function confirmationStyle () {
                document.body.style.backgroundColor = "#015351";
                document.getElementById("dd-content").style.backgroundColor = "#FC9E01";
                document.getElementById("id").style.color = "#015351";

            };

        </script>
        <script>
         function valFriend(){
            var friend= document.getElementById("question").value();

                if (friend==""){
                    alert("Please enter your friends name");
                    document.getElementById("question").focus();
                    return false;
                }
         }
          
        </script> 
    </body>
</html>