<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $blood_group = $_POST['blood_group'];
    $contact_number = $_POST['contact_number'];
    $location = $_POST['location'];

    $query = "INSERT INTO donors (name, blood_group, contact_number, location) 
              VALUES ('$name', '$blood_group', '$contact_number', '$location')";
    $conn->query($query);
}

?>

<form method="POST">
    <label for="name">Donor Name:</label>
    <input type="text" name="name" required>

    <label for="blood_group">Blood Group:</label>
    <input type="text" name="blood_group" required>

    <label for="contact_number">Contact Number:</label>
    <input type="text" name="contact_number" required>

    <label for="location">Location:</label>
    <input type="text" name="location" required>

    <button type="submit">Add Donor</button>
</form>
