<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Blood Bank</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="register-container">
        <form method="POST" action="register_action.php" class="register-form">
            <h2>Register</h2>

            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit" class="register-btn">Register</button>

            <div class="login-link">
                <p>Already have an account? <a href="login.php">Login here</a></p>
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

.register-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f8f9fa;
}

.register-form {
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

input[type="text"], input[type="email"], input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

button.register-btn {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
}

button.register-btn:hover {
    background-color: #0056b3;
}

.login-link {
    text-align: center;
    margin-top: 10px;
}

.login-link p {
    font-size: 14px;
}

.login-link a {
    color: #007bff;
    text-decoration: none;
}

.login-link a:hover {
    text-decoration: underline;
}
</style>