<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'user_registration';

$conn = new mysqli($hostname , $username , $password , $dbname);
//check if connection true or false 
if($conn){
    echo "connection successfully";
}else{
    die("Connection error" . $conn->connect_error);
}

?>