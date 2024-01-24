<?php


$con = mysqli_connect('localhost','root','','user_db');
$host = "localhost";
$dbname = "user_db";
$user = "root";
$password = "";

// chech the connection
if($con->error){
    die("connecting to the database failed: " . $con->error);
}


?>
