<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $blood_group = $_POST['blood_group'];
    $location = $_POST['location'];

    $query = "INSERT INTO blood_requests (user_id, blood_group, location) 
              VALUES ('$user_id', '$blood_group', '$location')";
    $conn->query($query);
}

?>

<form method="POST">
    <label for="blood_group">Blood Group:</label>
    <input type="text" name="blood_group" required>

    <label for="location">Location:</label>
    <input type="text" name="location" required>

    <button type="submit">Request Blood</button>
</form>
