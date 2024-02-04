<?php 
$servername = "localhost";
$username = "u874864342_CCStodolist";
$password = "CCStodolist2024"; 
$dbname = "u874864342_CCStodolist";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>