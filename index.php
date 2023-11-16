<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./public/css/styles.css">
    <title>Login</title>
    <style>
        .btnLogin{
            background-color: #000000;
            padding: 20px 20px;
            border: none;
            border-radius: 98px;
            font-size: 18px;
            width:100%;
            height:10%;
            color: #fff;
        }
        a{
            color: #000000;

        }
        input{
            border: 2px solid white;
            border-color:#fff;
            padding: 5px 10px;
            position: inherit;
            /* background-color: #FC9E01; */
           

        }
        form{
            margin: 5%;
            font-size: 20px;
        }
    </style>
</head>
<body>
  <div style="display: flex; height: 100vh;">
    <div style="flex:50%">
        <img src="public/images/loginimage2.jpg" height= "100%" width= "100%" alt="Flowers in Chania">
    </div>
    <div class="login" style="flex-grow: 9">
        <form action="./auth/Login.php" onsubmit="validateLogin();" method="post">
        <!-- create an error message if the user made an error trying to create an account -->
        <?php
            if(isset($_GET['error'])) {
                if($_GET['error']== "emptyEmail") {
                    echo '<p class = "err">Email does not exist! Please signup</p>';  
                }
                elseif ($_GET['error'] == "403") {
                    // code...
                    echo '<p class = "err"> Password does not match the account </p>';
                }elseif ($_GET['error'] == "error") {
                    // code...
                    echo '<p class = "err"> Please login to continue </p>';
                }
            }
        ?>
        <h2 style="text-align: center; margin-bottom: 80px;">Login</h2>
        <!-- <label for="username">Username</label><br>
        <input type="text"><br><br> -->
        <label for="email">Email</label><br>
        <input type="text" id="email" name="email"><br><br>
        <label for="password">Password</label><br>
        <input type="password" id="pass" name="pass"><br>
        <div style="margin-top: 50px; text-align: center">
            <a href="forgotpassword.php">Forgot password?</a><br><br>
            <button name="login_submit" type="submit" class="btnLogin">LOGIN</button><br>
            <p>Don't have an account?<a href="signup.php"> &nbsp; Sign up here</a></p>
        </div>
        
        
    </div> 
  </div>
  
    </form>
    <script>
        function validateLogin(){
            var email=document.getElementById("email").value;
            var pass= document.getElementById("pass").value;
            //check if email is empty
            if (email==""){
                alert("please enter your email");
                document.getElementById("email").focus();
                return false;
            }
            //check if password is empty
            if (pass==""){
                alert("Enter password");
                document.getElementById("pass").focus();
                return false;   
            }
           
        }
    </script>
</body>
</html>
<!-- #bc9087 -->