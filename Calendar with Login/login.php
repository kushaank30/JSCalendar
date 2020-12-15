<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="loginbox">
        
        <form method="POST" action="includes/login.inc.php">
            <div class="formBG"></div>

            <p id="login">Login</p>

            <?php
            
                if(isset($_GET['error'])){
                    if($_GET['error'] == "emptyFields"){
                        echo '<p id="loginError">Fill in all Details!</p>';
                    }
                    else if($_GET['error'] == "wrongpassword"){
                        echo '<p id="loginError">Please Check your Password!</p>';
                    }
                    else if($_GET['error'] == "nouser"){
                        echo '<p id="loginError">No user found! Please Signup.</p>';
                    }
                }
            
            ?>

            <div class="form-group_username" >
                <input type="text" name="username" placeholder="Username">
                <label for="username">Username</label>
            </div> 

            <div class="form-group_email" >
                <input type="text" name="email" placeholder="Email">
                <label for="email">Email</label>
            </div> 

            <div class="form-group_pwd">
                <input type="password" name="pwd" placeholder="Password">
                <label for="pwd">Password</label>
             </div> 
            
            <button type="submit" name="login-submit" value="Login">
                Log In
            </button>

            <a href="#" class="lostPassword">Lost your password?</a>
            <a href="signup.php" class="newUser">Don't Have an Account? Sign Up</a>
               
        </form>

    </div>
</body>
</html>