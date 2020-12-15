<?php

//to check the submit button is clicked
if(isset($_POST['signup'])){
    require 'dbh.in.php';  //connect to db

    // fetch data from form
    $username = $_POST['username'];
    $fullname = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd_repeat'];

    //error handlers
    if(empty($username) || empty($fullname) || empty($email) || empty($password) || empty($passwordRepeat)){
        header("location: ../signup.php?error=emptyfields&username=".$username."&email=".$email."&fullname=".$fullname);
        exit(); //exit the function if error is made here
    } 

    else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("location: ../signup.php?error=invalidusernameemail&fullname=".$fullname);
        exit();
    }

    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("location: ../signup.php?error=invalidemail&username=".$username."&fullname=".$fullname);
        exit();
    }

    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("location: ../signup.php?error=invalidusername&fullname=".$fullname."&email=".$email);
        exit();
    }

    //if passwords doesn't matches 
    else if($password !== $passwordRepeat){
        header("Location: ../signup.php?error=passwordCheck&email=".$email."&fullname=".$fullname."&username=".$username);
        // exit();
    }

    //if username is already taken
    else{

        $sql = "SELECT USERNAME FROM signup WHERE USERNAME=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../signup.php?error=sqlerror");
            exit();
        }

        else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("location: ../signup.php?error=usertaken&email=".$email); 
                exit();
            }

            else{
                $sql = "INSERT INTO signup (USERNAME, FULLNAME, EMAIL, PWD) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: ../signup.php?error=sqlerror");
                    exit();
                }

                else{
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "ssss", $username, $fullname, $email, $hashedPwd);
                    
                    if(mysqli_stmt_execute($stmt))
                    {                        
                        header("location: ../signup.php?signup=success");    
                    }
                    else {
                        header("location: ../signup.php?signup=error");    
                    }
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt); //closing statement
    mysqli_close($conn);


}
else{
    header("Location: ../index.php");
}

?>