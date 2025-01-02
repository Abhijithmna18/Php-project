<?php
session_start();
include('connection.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch the user details (Optional: If needed to display user info)
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the blood request form
    $blood_type = $_POST['blood_type'];
    $hospital_name = $_POST['hospital_name'];
    $request_date = $_POST['request_date'];
    $patient_name = $_POST['patient_name'];

    $query = "INSERT INTO blood_requests (user_id, blood_type, hospital_name, request_date, patient_name) 
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issss", $user_id, $blood_type, $hospital_name, $request_date, $patient_name);
    if ($stmt->execute()) {
        $message = "Blood request submitted successfully.";
    } else {
        $message = "There was an error submitting your request.";
    }
}
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_bank";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming this is where the request is being processed
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id']; // Replace with actual user ID retrieval
    $blood_type = $_POST['blood_type'];
    $hospital_name = $_POST['hospital_name'];
    $request_date = $_POST['request_date'];
    $patient_name = $_POST['patient_name']; // Ensure this field exists in the form and database

    try {
        $query = "INSERT INTO blood_requests (user_id, blood_type, hospital_name, request_date, patient_name) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("issss", $user_id, $blood_type, $hospital_name, $request_date, $patient_name);
        $stmt->execute();

        echo "Blood request submitted successfully.";
    } catch (mysqli_sql_exception $e) {
        die("Error: " . $e->getMessage());
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Blood</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Request Blood</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>

        <section class="request-form">
            <h2>Fill out the form to request blood</h2>

            <?php if (isset($message)) { echo "<p class='message'>$message</p>"; } ?>

            <form method="POST" action="request_blood.php">
                <label for="blood_type">Blood Type:</label>
                <select name="blood_type" required>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>

                <label for="hospital_name">Hospital Name:</label>
                <input type="text" name="hospital_name" required>

                <label for="request_date">Request Date:</label>
                <input type="date" name="request_date" required>

                <label for="patient_name">Patient Name:</label>
                <input type="text" name="patient_name" required>

                <button type="submit">Submit Request</button>
            </form>
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

/* Request Form Section */
.request-form {
    margin-top: 30px;
    padding: 20px;
    background-color: #e8f2f0;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.request-form h2 {
    text-align: center;
    font-size: 2rem;
    color: #354f52;
    margin-bottom: 20px;
}

.request-form label {
    display: block;
    font-weight: bold;
    margin: 10px 0 5px;
}

.request-form input, .request-form select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
    margin-bottom: 20px;
    transition: border-color 0.3s ease-in-out;
}

.request-form input:focus, .request-form select:focus {
    border-color: #52796f;
    outline: none;
}

.request-form button {
    background-color: #84a98c;
    color: white;
    font-size: 1.2rem;
    padding: 15px 30px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
}

.request-form button:hover {
    background-color: #52796f;
    transform: scale(1.05);
}

.message {
    text-align: center;
    padding: 10px;
    background-color: #e0f7fa;
    border: 1px solid #26c6da;
    border-radius: 5px;
    color: #00796b;
    margin-bottom: 20px;
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

    .request-form h2 {
        font-size: 1.5rem;
    }

    .request-form input, .request-form select, .request-form button {
        font-size: 1rem;
        padding: 12px;
    }
}
</style>