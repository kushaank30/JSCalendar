<?php
require 'dbh.in.php';
session_start();
if(isset($_POST['event-add'])){
    $event_name = $_POST['event_name'];
    $event_desc = $_POST['event_desc'];
    $event_date = $_POST['event_date'];
    $query = "INSERT INTO `events`(`user_id`,`event_date`, `event_name`, `event_desc`) VALUES (?,?,?,?)";

    $stmt = mysqli_stmt_init($conn);   //initialize connection with database
    if(!mysqli_stmt_prepare($stmt, $query)){
        // header("Location: ../index.php?error=sqlerror");
        // exit();
    }
    else{
        try{
        mysqli_stmt_bind_param($stmt, "ssss", $_SESSION['userId'], $event_date , $event_name, $event_desc);
        mysqli_stmt_execute($stmt);
        echo "Event Added";
        } catch(Error $e){
            exit();
        }
    }
}


if(isset($_POST['event-retrieve'])){
    $event_date = $_POST['event_date'];
    $query = "SELECT * FROM `events` WHERE event_date = ? AND user_id = ?;";

    $stmt = mysqli_stmt_init($conn);   //initialize connection with database
    if(!mysqli_stmt_prepare($stmt, $query)){
        // header("Location: ../index.php?error=sqlerror");
        // exit();
    }
    else{
        try{
            mysqli_stmt_bind_param($stmt, "ss", $event_date, $_SESSION['userId']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                header('Content-type: application/json');
                echo json_encode($row);
            }else{
                throw Error('No');
            }
        } catch(Error $e){
            exit();
        }
    }
}

?>