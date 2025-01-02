<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header('Location: login.php');
    exit(); // Stop further script execution
}

include('connection.php'); // Include the database connection file

// Get available blood donations from the database
$query = "SELECT * FROM blood_donations WHERE status = 'available'"; // Query to get available donations
$result = $conn->query($query); // Execute the query and get the result

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donations</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <header>
            <h1>Available Blood Donations</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="profile.php">View Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>

        <section class="donation-list">
            <h2>List of Available Blood Donations</h2>
            <?php if ($result->num_rows > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Blood Type</th>
                            <th>Location</th>
                            <th>Quantity (in Liters)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['blood_type']); ?></td>
                                <td><?php echo htmlspecialchars($row['location']); ?></td>
                                <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                                <td>
                                    <!-- Link to request blood, which will allow users to request the blood donation -->
                                    <a href="request_blood.php?donation_id=<?php echo $row['id']; ?>" class="btn">Request Blood</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>No available blood donations at the moment.</p>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
<style>
    /* General Styles */
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

.donation-list {
    margin-top: 30px;
    text-align: center;
}

.donation-list table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.donation-list th, .donation-list td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
}

.donation-list th {
    background-color: #354f52;
    color: white;
}

.donation-list tr:nth-child(even) {
    background-color: #f2f2f2;
}

.donation-list .btn {
    background-color: #84a98c;
    color: white;
    font-size: 1rem;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.donation-list .btn:hover {
    background-color: #52796f;
}
    </style>