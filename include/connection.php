<?php
$servername = "localhost";
$username = "trigouser";
$password = "MyoXnCgpf7nBr2Em!";
$dbname = "RAVTO";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
