<?php

if(isset($_POST['login-submit'])){
    
    require 'dbh.in.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    if(empty($username) || empty($email) || empty($password)){
        header("Location: ../login.php?error=emptyFields");
        //exit();
    }
    else{
        $sql = "SELECT * from signup WHERE USERNAME=? AND EMAIL=?;";  //"?" is for prepared statements for privacy
        $stmt = mysqli_stmt_init($conn);   //initialize connection with database
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['PWD']);
                if($pwdCheck == false){
                    header("Location: ../login.php?error=wrongpassword");
                    exit();
                }
                else if($pwdCheck == true){
                    session_start();
                    $_SESSION['userId'] = $row['UID'];
                    $_SESSION['userName'] = $row['USERNAME'];

                    header("Location: ../index.php?login=success");
                    exit();
                }
                else{
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
            }
            else{
                header("Location: ../login.php?error=nouser");
                exit();
            }
        }
    }

}
else{
    header("Location: ../index.php");
    exit();
}

?>