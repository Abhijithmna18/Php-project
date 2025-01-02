<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Blood Bank</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="login-container">
        <form method="POST" action="login_action.php" class="login-form">
            <h2>Login</h2>
            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit" class="login-btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Register here</a></p>
            </div>
        </form>
    </div>

</body>
</html>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f8f9fa;
}

.login-form {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

input[type="email"], input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

button.login-btn {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
}

button.login-btn:hover {
    background-color: #0056b3;
}

.register-link {
    text-align: center;
    margin-top: 10px;
}

.register-link p {
    font-size: 14px;
}

.register-link a {
    color: #007bff;
    text-decoration: none;
}

.register-link a:hover {
    text-decoration: underline;
}
</style>