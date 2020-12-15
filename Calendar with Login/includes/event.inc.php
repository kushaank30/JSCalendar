<?php
    require 'dbh.in.php';
    session_start();
  if(isset($_SESSION['userId'])){
      $is_loggedin = true;
  } else{
      $is_loggedin = false;
  }

 if($is_loggedin){
    $mydate = gmdate("Y-m-d");
    $query = "SELECT * FROM events WHERE event_date = ? AND user_id = ?;";
    $stmt = mysqli_stmt_init($conn);   //initialize connection with database
    if(!mysqli_stmt_prepare($stmt, $query)){
        // header("Location: ../index.php?error=sqlerror");
        // exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "ss", $mydate, $_SESSION['userId']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)){
            $event_found = true;
            $event_name = $row['event_name'];
            $event_desc = $row['event_desc'];
        }
      }
  }

?>