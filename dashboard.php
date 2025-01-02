<?php
session_start();
include('connection.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}

$user_id = $_SESSION['user_id'];


<h1>Welcome to the Blood Bank</h1>
<p><a href="donor.php">Manage Donors</a></p>
<p><a href="request.php">Request Blood</a></p>
<p><a href="logout.php">Logout</a></p>

session_start(); // Start the session at the top of the page

// Check if the user is logged in (session variable exists)
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header('Location: login.php');
    exit(); // Stop further script execution
}

// If the user is logged in, continue displaying the page content
echo "Welcome to the Dashboard!";
?>
