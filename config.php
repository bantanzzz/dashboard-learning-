<?php
$host = "localhost";
$user = "root";  // change if needed
$pass = "2005";      // change if needed
$db   = "auth_system";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
?>
