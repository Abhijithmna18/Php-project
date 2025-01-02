<?php
session_start(); // Start the session at the top of the page

// Check if the user is logged in (session variable exists)
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header('Location: login.php');
    exit(); // Stop further script execution
}

// If the user is logged in, continue displaying the page content
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Blood Bank</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome to the Blood Bank</h1>
            <nav>
                <ul>
                    <li><a href="profile.php">View Profile</a></li>
                    <li><a href="blood_donations.php">View Blood Donations</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>

        <section class="content">
            <h2>Available Actions:</h2>
            <div class="options">
                <div class="option">
                    <a href="profile.php" class="btn">View Profile</a>
                </div>
                <div class="option">
                    <a href="blood_donations.php" class="btn">View Blood Donations</a>
                </div>
                <div class="option">
                    <a href="donate_blood.php" class="btn">Donate Blood</a>
                </div>
                <div class="option">
                    <a href="request_blood.php" class="btn">Request Blood</a>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
<style>
    /* General Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f7f6;
    color: #333;
}

.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
}

header {
    background-color: #354f52;
    color: white;
    padding: 10px 0;
    text-align: center;
}

header h1 {
    font-size: 2.5rem;
    margin-bottom: 10px;
}

nav ul {
    list-style: none;
    display: flex;
    justify-content: center;
    gap: 20px;
}

nav ul li {
    display: inline-block;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    font-size: 1.2rem;
    padding: 10px 20px;
    background-color: #52796f;
    border-radius: 5px;
    transition: background-color 0.3s;
}

nav ul li a:hover {
    background-color: #2f3e46;
}

.content {
    margin-top: 30px;
    text-align: center;
}

.content h2 {
    font-size: 2rem;
    margin-bottom: 20px;
}

.options {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.option {
    margin: 10px;
}

.option .btn {
    background-color: #84a98c;
    color: white;
    font-size: 1.2rem;
    padding: 15px 30px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.option .btn:hover {
    background-color: #52796f;
}

/* Media Query for smaller screens */
@media (max-width: 768px) {
    .container {
        width: 90%;
    }

    .options {
        flex-direction: column;
    }

    .option .btn {
        width: 100%;
        padding: 20px;
        font-size: 1.5rem;
    }
}
</style>