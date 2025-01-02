<?php
include('connection.php');

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
$conn->query($query);

header('Location: login.php');
?>
