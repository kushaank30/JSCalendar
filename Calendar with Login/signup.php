<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <div class="signupbox">
        
        <form method="POST" action="includes/signup.inc.php">
            <div class="formBG"></div>

            <p id="signup">Signup</p>

            <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == "emptyfields"){
                        echo '<p id="signupError">Fill in all Details!</p>';
                    }
                    else if($_GET['error'] == "invalidusernameemail"){
                        echo '<p id="signupError">Invalid Username and Email!</p>';
                    }
                    else if($_GET['error'] == "invalidemail"){
                        echo '<p id="signupError">Invalid Email!</p>';
                    }
                    else if($_GET['error'] == "invalidusername"){
                        echo '<p id="signupError">Invalid Username!</p>';
                    }
                    else if($_GET['error'] == "passwordCheck"){
                        echo '<p id="signupError">Password does not match!</p>';
                    }
                    else if($_GET['error'] == "usertaken"){
                        echo '<p id="signupError">Username is already taken!</p>';
                    }
                }
                else if(isset($_GET['signup']) == "success"){
                    echo '<p id="signupSuccess">Signup Successful! Please Login</p>';
                }
            ?>

            <div class="form-group_username" >
                <input type="text" name="username" placeholder="Username">
                <label for="username">Username</label>
            </div> 

            <div class="form-group_fullName" >
                <input type="text" name="fullName" placeholder="Full Name">
                <label for="username">Full Name</label>
            </div>

            <div class="form-group_email" >
                <input type="text" name="email" placeholder="Email">
                <label for="email">Email</label>
            </div>
            
            <div class="form-group_pwd">
                <input type="password" name="pwd" placeholder="Password">
                <label for="pwd">Password</label>
             </div> 

            <div class="form-group_pwd_repeat">
                <input type="password" name="pwd_repeat" placeholder="Repeat Password">
                <label for="pwd_repeat">Repeat Password</label>
            </div>
            
            <button type="submit" name="signup" value="signup">
                Sign Up
            </button>

            <a href="login.php" class="oldUser">Already Have an Account? Login</a>
               
        </form>

    </div>
</body>
</html>