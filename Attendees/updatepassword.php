<?php session_start();
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <link rel="stylesheet" type="text/css" href="./public/css/styles.css">
        <style>
            .update{
                background-color: #015351;
                padding: 10px 20px;
                border: none;
                font-size: 18px;
                width:10%;
                height:10%;
                color: #fff;
                
            }
            .updatepassword{
                margin-top: 3%;
                text-align: center;
            }
            a{
                color: #015351;

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
            }
        </style>
    </head>
    <body style="background-color: #FC9E01; color: #015351;">    
        <form action="./auth/updatePassword.php" method="POST" onsubmit=" return passwordValidate();" name="updatepass" >
            <div class="updatepassword">
                <h1>Update Password</h1>
                <label for="Enter new password">New Password</label><br>
                <input type="password" id="newpassword" name="newpassword"><br><br>
                <label for="Confirm new password">Confirm Password</label><br>
                <input type="password" id="confpassword" name="confpassword"><br><br>
                <input type="hidden" id="id" name="id" value="<?=$id?>"><br><br>
                <button class="update" onclick="back()">BACK</button >
                <button class="update" type="submit" name="update">UPDATE </button>
            </div>        
        </form>
<script>
      //    validate password
      function passwordValidate(){
               //declare variales
                newpass=document.updatepass.newpassword.value;
                confpass=document.updatepass.confpassword.value;
               
        
                //loop
                // check if password is empty
                if (newpass==""){
                    alert("fill new password");
                    document.getElementById("newpassword").focus();
                    return false;
                   
                }
                // check if length is less than 8 characters
                if (newpass.length<8){
                    alert("password should be at least 8 characters");
                    document.getElementById("newpassword").focus();
                    return false;
                }

                
                // check if the password has a lowercase letter
                //search() method uses an expression to search for a match, and returns the position of the match. Syntax :`/pattern/modifiers;`
                //[] range check for any of the values in the range of values/characters in the square brackets
                // `/pattern/`used to capture the pattern
                //poistion -1 indicates that the position is empty i.e positions start from 0
                if (newpass.search(/[a-z]/)==-1){
                    alert("Your password needs a lower case letter")
                    return false;
                }
                // check if the password has an uppercase letters
                if (newpass.search(/[A-Z]/)==-1){
                    alert("Your password needs an uppercase letter")
                    return false;
                }
                // check if the password contains numbers
                if (newpass.search(/[0-9]/)==-1){
                    alert("Your password needs atleast one number")
                    return false;
                }
                //check the confirm password field is not empty
                 if (confpass==""){
                   alert("fill confirm password");
                   document.getElementById("confpassword").focus();
                   return false; 
                }
                // confirm password match
                if (newpass != confpass ){
                    alert("Please enter matching passwords");
                    document.getElementById("confpassword").focus();
                    return false;
                } else if (newpass == confpass) {
                    alert("new password created");
                    return true;
                } 
                
        }

        function back(){
                window.history.back();
            };
</script>
</body>
</html>