<?php
session_start();
include('connection.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Your Profile</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>

        <section class="profile-info">
            <p><strong>Name:</strong> <?php echo $user['username']; ?></p>
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            <!-- Add other profile information here -->
        </section>
    </div>
</body>
</html>

<?php
$conn->close();
?>
<style>
    /* General Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f7f6;
    color: #333;
    line-height: 1.6;
}

.container {
    width: 80%;
    margin: 0 auto;
    padding: 30px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

header {
    background-color: #354f52;
    color: white;
    text-align: center;
    padding: 20px 0;
    border-radius: 10px;
}

header h1 {
    font-size: 2.5rem;
    letter-spacing: 1px;
}

nav ul {
    list-style: none;
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-top: 20px;
}

nav ul li {
    display: inline-block;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    font-size: 1.2rem;
    padding: 12px 24px;
    border-radius: 5px;
    background-color: #52796f;
    transition: background-color 0.3s, transform 0.3s;
}

nav ul li a:hover {
    background-color: #2f3e46;
    transform: scale(1.1);
}

/* Profile Section */
.profile-info {
    margin-top: 30px;
    padding: 20px;
    background-color: #e8f2f0;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.profile-info p {
    font-size: 1.2rem;
    margin: 15px 0;
}

.profile-info strong {
    font-weight: bold;
    color: #354f52;
}

.profile-info span {
    font-size: 1.1rem;
    color: #52796f;
}

.profile-info .btn {
    display: inline-block;
    background-color: #84a98c;
    color: white;
    padding: 12px 30px;
    font-size: 1.2rem;
    border-radius: 5px;
    text-decoration: none;
    margin-top: 20px;
    text-align: center;
    transition: background-color 0.3s, transform 0.3s;
}

.profile-info .btn:hover {
    background-color: #52796f;
    transform: scale(1.05);
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        width: 95%;
        padding: 20px;
    }

    nav ul {
        flex-direction: column;
        align-items: center;
    }

    nav ul li {
        margin-bottom: 15px;
    }

    .profile-info p {
        font-size: 1rem;
    }

    .profile-info .btn {
        padding: 10px 20px;
    }
}
</style>