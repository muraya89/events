<!DOCTYPE html>
<html lang="en">
<head>    
    <link rel="stylesheet" type="text/css" href="./public/css/styles.css">
    <title>Signup</title>
    <style>
        .signin-container{
            display: flex;
            height: 100vh;
        }
        .row{
            display: grid;
            grid: gap 20px;
            grid-template-columns: auto auto auto;/* defines the line names and track sizing functions of the grid columns.*/
            margin-top: 0%;
            padding: 0% 3%;


        }
        .col{
            text-align: left;
        }
        .col2{
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            /* padding-top: 2%; */
        }
        .btnCreate{
            background-color: #000000;
            padding: 20px 20px;
            width:90%;
            height:10%;
            border: none;
            font-size: 18px;
            border-radius: 98px;
            color: #fff;
        }
        select {
            width: 100%;
            background-color: #fff;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: none;
            border-bottom: 2px solid #000000;
        }
        
    </style>
</head>
<body>
    <div class="signin-container">
        <div style="flex:50%">
            <img src="public/images/loginimage2.jpg" height= "100%" width= "100%" alt="Flowers in Chania">
        </div>
        <div style="flex-grow: 9; margin: auto;">
            <form action="./auth/Register.php" name="registration" onsubmit="return validateRegistration(); " method="post" style="font-size:20px">
                <!-- create an error message if the user made an error trying to create an account -->
                <?php
                    if(isset($_GET['error'])) {
                    if($_GET['error']=="emptyfields"){
                        echo '<p class = "err">Fill in all fields!</p>';
                    }
                    elseif($_GET['error']== "invalidemail") {
                        echo '<p class = "err">Provide a valid email!</p>';  
                    }
                    elseif ($_GET['error'] == "invalidpassword") {
                        // code...
                        echo '<p class = "err">Enter password!</p>';
                    }
                    elseif ($_GET['error'] == "invalidPassword") {
                        // code...
                        echo '<p class = "err"> Password should be atleast 8 characters long and should include at least one number, one uppercase letter and one special character </p>';
                    }
                    elseif($_GET['error']== "passwordCheck") {
                        echo '<p class = "err">Your passwords do not match!</p>';
                    }
                    }
                ?>
                <h1 style="text-align: center; margin-bottom: 130px">Sign Up</h1>
                <div class="row" style="column-gap: 30px; ">
                    <div class="col">
                        <label for="othername">Name</label><br>
                        <input type="text" name="name" id="name"><br><br>
                        <label for="email">Email</label><br>
                        <input type="text" name="email" id="email"><br><br>
                        <label for="address">Address</label><br>
                        <input type="text" name="address" id="address"><br><br>
                        <label for="">Role</label><br>
                        <select name="role" id="role">
                            <option value="">Select role</option>
                            <option value="Organizers">Event Organizer</option>
                            <option value="Attendees">Attendee</option>
                        </select><br><br>
                        <label for="">New password</label><br>
                        <input type="password" name="newpass" id="newpass"><br><br>
                    </div>
                    <div class="col" style="">
                        <label for="Gender">Gender</label><br>
                        <select name="gender" id="gender">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select><br><br>
                        <label for="dob">Date of Birth</label><br>
                        <input type="text" name="dob" id=dob  placeholder="yyyy-mm-dd" onmouseout="valDate();"><br><br>
                        <label for="nationalid">National ID</label><br>
                        <input type="text" name="natid" id="natid"><br><br>
                        <label for="phone">Phone</label><br>
                        <input type="text" id="phone" name="phone"><br/><br/>
                        <label for="">Confirm password</label><br>
                        <input type="password" name="confpass" id="confpass">
                        <input type="hidden" name="table" value="universityleavems" />
                        <input type="hidden" name="redirect_to" value="../index.php" />
                    </div>
                </div> 
                <div class="col2">
                    <button type="submit" class="btnCreate" name="signup_submit">SIGN UP</button><br>
                    <p >Already have an account?<a href="index.php" style="text-decoration: none;">&nbsp;Sign in</a></p>
                </div>
            </form>
        </div>
    </div>
    <script>
        //validate date of birth
        function valDate(){
                var dob=document.getElementById("dob").value;   
                //Checking Whether it is of the format yyyy-mm-dd and also if it is empty( Implied)
                if(dob.indexOf("-")==-1){
                    alert("Date should be in the format (yyyy-mm-dd)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          )");
                    document.getElementById("dob").focus();
                    return false;
                }
                compdate=dob.split("-")
                // ensuring the date length is correct
                if (compdate[0].length<4||compdate[1].length<1||compdate[2].length<1) {
                    alert("Date should be in the format (yyyy-mm-dd)");
                    document.getElementById("dob").focus();
                    return false; 
                } 
                // validating that the start date is acceptable
                var today =new Date();
                // Creating a date using the entered data
                var givendt=new Date();
                //s
                givendt.setFullYear(compdate[0],compdate[1],compdate[2]);//The function setFullYear Set the year 
                //Comparing the dates
                if(givendt>today){
                alert("Only dates before today are acceptable");
                document.getElementById("dob").focus();
                return false;
                }    //End of validating the date field
        }
        // validate email
        function valEmail(){
            email=document.getElementById("email").value;

            if(email.length==0 || email.indexOf("@")==-1|| email.indexOf(".")==-1){
            alert("You must enter a valid email");
            document.getElementById("email").focus();
            return false;
            } else {
                return true;
            }
        }
        //    validate password
        function passValidate(){
               //declare variales
                newpass=document.registration.newpass.value;
                confpass=document.registration.confpass.value;
               
        
                //loop
                // check if password is empty
                if (newpass==""){
                    alert("fill new password");
                    document.getElementById("newpass").focus();
                    return false;
                   
                }
                // check if length is less than 8 characters
                if (newpass.length<8){
                    alert("password should be at least 8 characters");
                    document.getElementById("newpass").focus();
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
                   document.getElementById("confpass").focus();
                   return false; 
                }
                // confirm password match
                if (newpass != confpass ){
                    alert("Please enter matching passwords");
                    document.getElementById("confpass").focus();
                    return false;
                } else if (newpass == confpass) {
                    alert("new password created");
                    return true;
                } 
                
        } 
        function validateRegistration(){
            fname=document.registration.fname.value;
            oname=document.registration.oname.value;
            address=document.registration.address.value;
            phone=document.registration.phone.value;
            gender=document.registration.gender.options.selectedIndex;
            // dob=document.registration.dob.value;
            natid=document.registration.natid.value;
            kname=document.registration.kname.value;
            kphone=document.registration.kphone.value;
            role=document.registration.role.options.selectedIndex;
            ans=document.registration.ans.value;

            if (fname==""){
                alert("Please enter your first name");
                document.getElementById(fname).focus();
                return false;
            }
            if (oname==""){
                alert("Please enter your other name(s)");
                document.getElementById(oname).focus();
                return false;
            }
            if (address==""){
                alert("Please enter your address name");
                document.getElementById(address).focus();
                return false;
            }
            if (phone==""){
                alert("Enter a valid phone number");
                document.getElementById(phone).focus();
                return false;
            }
            if (phone.length<10||phone.length>10){
                alert("Enter a valid phone number");
                document.getElementById("phone").focus();
                return false;
            }
            if (gender==0){// 0 is the index of the first option which has no value set
                alert("Please select your gender");
                return false;
            }
            if (natid==""){
                   alert("Enter valid ID number");
                   document.getElementById("natid").focus();
                   return false;
            }
            if (id.length<7||id.length>8){
                alert("Enter valid ID number");
                document.getElementById("natid").focus();
                return false;
            }
            if (kname==""){
                alert("Please enter your first name");
                document.getElementById(kname).focus();
                return false;
            }
            if (kphone==""){
                alert("Enter a valid kin phone number");
                document.getElementById("kphone").focus();
                return false;
            }
            if (kphone.length<10||kphone.length>10){
                alert("Enter a valid phone number");
                document.getElementById("kphone").focus();
                return false;
            }
            if (role==0){// 0 is the index of the first option which has no value set
                alert("Please select your gender");
                return false;
            }

            var returned= true;
            returned=valEmail();
            if( returned==true)
            returned=passValidate();
            return returned; 
        }
    </script>
</body>
</html>