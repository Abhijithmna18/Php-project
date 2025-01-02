<?php
$servername = "localhost"; // Replace with your database server (e.g., 'localhost')
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "blood_bank"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

