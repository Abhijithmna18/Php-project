<?php
session_start();
include('connection.php'); // Include your database connection

$email = trim($_POST['email']);
$password = $_POST['password'];

// Prepare the SQL query to prevent SQL injection
$query = $conn->prepare("SELECT * FROM users WHERE email = ?");
$query->bind_param("s", $email); // Bind the email parameter
$query->execute(); // Execute the query
$result = $query->get_result(); // Get the result

// Check if a user was found
if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc(); // Fetch the user data

    // Verify the password
    if (password_verify($password, $user['password'])) {
        // Password is correct, start the session
        $_SESSION['user_id'] = $user['id']; // Store user ID in session
        header('Location: index.php'); // Redirect to index.php after login
        exit(); // Stop further script execution after redirection
    } else {
        // Password is incorrect
        echo "Invalid password.";
    }
} else {
    // No user found with the provided email
    echo "No user found with that email.";
}
?>

