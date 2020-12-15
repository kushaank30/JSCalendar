<?php

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "signup_minor";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    die("Connnection Failed: ".mysqli_connect_error());
}

?>