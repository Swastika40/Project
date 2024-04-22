<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "a1";

// Create connection
$link = mysqli_connect($servername, $username, $password,$database);

// Check connection
if ($link->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>