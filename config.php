<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$servername = "localhost";
$username = "root";
$password = "";
$database = 'records';

// Create connection
$link = new mysqli($servername, $username, $password,$database);

// Check connection
if ($link->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully";

?>